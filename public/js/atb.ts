class AtbBase {
  handleError(headline: string, text: string): void {
    const dialog = document.getElementById('error-layer');

    if (!(dialog instanceof HTMLDialogElement)) {
      return;
    }

    const titles = dialog.querySelectorAll<HTMLElement>('.modal-title');

    titles.forEach((title: HTMLElement): void => {
      title.innerHTML = headline;
    });

    const bodies = dialog.querySelectorAll<HTMLElement>('.modal-body p');

    bodies.forEach((body: HTMLElement): void => {
      body.innerHTML = text;
    });
  }

  initSelect(): void {
    const thatScript = document.getElementById('functional-script');
    const form = document.getElementById('insuranceSelection');

    if (thatScript === null) {
      console.error('script not found');
      return;
    }

    if (!(form instanceof HTMLFormElement)) {
      console.error('form not found');
      return;
    }

    const selects = form.querySelectorAll<HTMLSelectElement>('select[data-next]');

    selects.forEach((select: HTMLSelectElement): void => {
      select.addEventListener('change', async (event: Event): Promise<void> => {
        event.preventDefault();
        event.stopPropagation();

        const next = select.getAttribute('data-next');

        if (next === null) {
          console.error(`attribute "data-next" is empty select ${select.id}`);
          return;
        }

        const nextElement = document.getElementById(next);

        if (nextElement === null) {
          console.error(`attribute "${next}" not found for select ${select.id}`);
          return;
        }

        // remove Checkboxes
        const productOptions = document.getElementById('prod-opt');

        if (productOptions !== null) {
          productOptions.innerHTML = '';
        }

        // clear Selects
        nextElement.parentElement?.setAttribute('disabled', 'disabled');
        nextElement.classList.remove('is-invalid');
        nextElement.classList.remove('is-valid');

        // const nextElementOptions = nextElement.querySelectorAll<HTMLOptionElement>('option:not([value=""])');
        // nextElementOptions.forEach((nextElementOption: HTMLOptionElement): void => {
        //   nextElementOption.remove();
        // });

        const allSelects = document.querySelectorAll<HTMLSelectElement>('.row select:not([id="productType"])');
        let nextSelectFound = false;

        allSelects.forEach((selectElement: HTMLSelectElement): void => {
          if (selectElement.id === next) {
            nextSelectFound = true;
            return;
          }

          if (!nextSelectFound || selectElement.disabled) {
            return;
          }

          selectElement.parentElement?.setAttribute('disabled', 'disabled');

          // const nextSelectOptions = selectElement.querySelectorAll<HTMLOptionElement>('option:not([value=""])');
          // nextSelectOptions.forEach((nextElementOption: HTMLOptionElement): void => {
          //   nextElementOption.remove();
          // });
        });

        const valid = select.checkValidity();

        if (!valid) {
          console.error('select is not valid');
          return;
        }

        const sleep = async function Sleep(milliseconds: number) {
          return new Promise((resolve) => setTimeout(resolve, milliseconds));
        };

        if (typeof thatScript.dataset.url === 'undefined') {
          nextElement.parentElement?.classList.add('has-spinner');

          await sleep(500); // Pausiert die Funktion für 0,5 Sekunden

          nextElement.parentElement?.classList.remove('has-spinner');
          nextElement.parentElement?.removeAttribute('disabled');

          return;
        }

        const urls = JSON.parse(thatScript.dataset.url);
        const submitter = document.querySelectorAll<HTMLButtonElement>('button[type="submit"]')[0];

        nextElement.parentElement?.classList.add('has-spinner');

        select.classList.remove('text-danger'); // indicate error

        await sleep(500); // Pausiert die Funktion für 0,5 Sekunden

        const results = await this.fetch(urls[next], form, submitter, (error: Error): void => {
          console.error(error);

          select.classList.add('text-danger'); // indicate error
        });

        if (typeof results === 'object') {
          Object.keys(results).forEach((key: string): void => {
            const option = document.createElement('option');

            option.setAttribute('value', key);
            option.innerHTML = results[key];

            nextElement.append(option);
          });
        }

        nextElement.parentElement?.removeAttribute('disabled');
        nextElement.parentElement?.classList.remove('has-spinner');
      });
    });
  }

  initForm(): void {
    const form = document.getElementById('insuranceSelection');

    if (!(form instanceof HTMLFormElement)) {
      return;
    }

    const fields = form.querySelectorAll<HTMLInputElement | HTMLSelectElement>('input, select');

    fields.forEach((field: HTMLInputElement | HTMLSelectElement): void => {
      field.addEventListener('blur', (event: Event): void => {
        event.preventDefault();
        event.stopPropagation();

        const valid = field.checkValidity();

        field.classList.remove(valid ? 'is-invalid' : 'is-valid');
        field.classList.add(valid ? 'is-valid' : 'is-invalid');
      });
    });

    form.addEventListener('submit', async (/* event: SubmitEvent */): Promise<boolean> => {
      // event.preventDefault();
      // event.stopPropagation();

      const valid = form.checkValidity();

      form.classList.add('was-validated');

      if (!valid) {
        return false;
      }

      await this.handleForm(form);

      return true;
    });
  }

  async fetch(action: string, form: HTMLFormElement, submitter: HTMLElement, cb: Function): Promise<any> {
    const formData = new FormData(form, submitter);

    let response: Response | null = null;

    try {
      response = await fetch(action, {
        method: 'POST', // *GET, POST, PUT, DELETE, etc.
        mode: 'cors', // no-cors, *cors, same-origin
        cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
        credentials: 'same-origin', // include, *same-origin, omit
        // headers: {
        //     // 'Content-Type': 'application/json',
        //     'Content-Type': 'application/x-www-form-urlencoded',
        // },
        redirect: 'follow', // manual, *follow, error
        referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
        body: formData, // body data type must match 'Content-Type' header
      });
    } catch (error) {
      cb(error);

      return null;
    }

    if (response === null || !response.ok) {
      console.error(new Error('Network response was not OK'));

      return null;
    }

    const results = await response.json();

    if (Object.prototype.hasOwnProperty.call(results, 'error')) {
      if (results.error === 'webservice error') {
        this.handleError('Keine Leistungsbewertung', 'Für den gewählten Tarif liegt keine Leistungsbewertung vor.');
      }

      return null;
    }

    return results;
  }

  getSelected(form: HTMLFormElement, name: string): any[] {
    const data: any[] = [];
    const options = form.querySelectorAll<HTMLOptionElement>('select[name="' + name + '"] option');

    options.forEach((option: HTMLOptionElement): void => {
      if (!option.selected) {
        return;
      }

      data.push(option.innerText);
    });

    return data;
  }

  getOptions(form: HTMLFormElement): any[] {
    const data: any[] = [];
    const options = form.querySelectorAll<HTMLInputElement>('input[name="prod-opt[]"]:checked');

    options.forEach((option: HTMLInputElement): void => {
      const optionLabel = form.querySelectorAll<HTMLLabelElement>('label[for="' + option.id + '"]')[0];

      data.push(optionLabel.innerText);
    });

    return data;
  }

  async handleForm(form: HTMLFormElement): Promise<void> {
    const action = form.getAttribute('action');

    if (action === null) {
      return;
    }

    const thatSubmitBtns = document.querySelectorAll<HTMLElement>('.loading-btn');

    thatSubmitBtns.forEach((button: HTMLElement): void => {
      button.classList.add('active');
      button.setAttribute('disabled', 'disabled');
    });

    const resultData = {
      type: this.getSelected(form, 'productType')[0],
      insurer: this.getSelected(form, 'company')[0],
      tariffgeneration: this.getSelected(form, 'year')[0],
      tariffname: this.getSelected(form, 'product')[0],
      options: this.getOptions(form),
      actualTariff: 0.0,
      bestTariff: 0.0,
    };

    setTimeout((): void => {
      const circles = form.querySelectorAll('.circle');
      circles.forEach((circle: Element): void => {
        circle.classList.add('animate');
      });

      this.setActiveClassForAccordion();

      const charts = document.querySelectorAll('.progress-chart .non-width');

      charts.forEach((chart: Element): void => {
        chart.classList.remove('non-width');
      });
    }, 500);

    const productType = form.querySelectorAll<HTMLSelectElement>('select[name="productType"]')[0];

    document.dispatchEvent(
      new CustomEvent('atb.result-event', {
        detail: productType.value,
      })
    );

    document.dispatchEvent(
      new CustomEvent('atb.data-event', {
        detail: resultData,
      })
    );

    this.setHistory('atb-result');

    thatSubmitBtns.forEach((button: HTMLElement): void => {
      button.classList.remove('active');
      button.removeAttribute('disabled');
    });
  }

  async handleCheckbox(element: HTMLElement, isCheckbox: boolean) {
    const thatScript = document.getElementById('functional-script');
    const form = document.getElementById('insuranceSelection');

    if (thatScript === null || !(form instanceof HTMLFormElement)) {
      return;
    }

    const productOptions = document.getElementById('prod-opt');
    const previousSelection: any[] = [];

    const submitter = form.querySelectorAll<HTMLButtonElement>('button[type="submit"]')[0];
    const formData = new FormData(form, submitter);

    if (!isCheckbox) {
      if (productOptions !== null) {
        const containers = productOptions.querySelectorAll<HTMLDivElement>('div');

        containers.forEach((container: HTMLDivElement): void => {
          container.remove();
        });
      }
    } else {
      for (const [key, value] of await formData.entries()) {
        previousSelection[parseInt(key, 10)] = value;
      }
    }

    if (typeof thatScript.dataset.url === 'undefined') {
      return;
    }

    const urls = await JSON.parse(thatScript.dataset.url);

    element.classList.remove('text-danger');

    const results = await this.fetch(urls['prod-opt'], form, submitter, (error: Error): void => {
      console.error(error);

      element.classList.add('text-danger'); // indicate error
    });

    if (typeof results === 'object' && Object.prototype.hasOwnProperty.call(results, 'elements')) {
      let htmlCheckbox = '';

      if (productOptions !== null) {
        productOptions.classList.remove('is-group');
        const containers = productOptions.querySelectorAll('div');

        containers.forEach((container: HTMLDivElement): void => {
          container.remove();
        });
      }

      Object.keys(results.elements).forEach((key: string): void => {
        const text = results.elements[key] + (results.required === true ? ' *' : '');
        let requiredText = '';

        if (results.required === true) {
          requiredText = 'Bitte wählen Sie mindestens einen Baustein.';
        }

        htmlCheckbox += this.getCheckboxHtml(
          'prod-opt_' + this.escape(key),
          'prod-opt[]',
          this.escape(key),
          this.escape(text),
          results.required === true,
          requiredText,
          this.wasChecked(previousSelection, 'prod-opt[]', key)
        );
      });

      if (productOptions !== null) {
        if (results.required === true) {
          productOptions.classList.add('is-group');
        }

        productOptions.innerHTML = htmlCheckbox;

        const inputs = productOptions.querySelectorAll('input');

        inputs.forEach((input: HTMLInputElement): void => {
          input.addEventListener('change', async (event: Event): Promise<void> => {
            event.preventDefault();
            event.stopPropagation();

            await this.handleCheckbox(input, true);
          });
        });
      }
    }
  }

  initCheckbox(): void {
    const elements = document.querySelectorAll<HTMLInputElement>('#product, #insuranceSelection input');

    elements.forEach((element: HTMLInputElement): void => {
      element.addEventListener('change', async (event): Promise<void> => {
        event.preventDefault();
        event.stopPropagation();

        await this.handleCheckbox(element, element instanceof HTMLInputElement);
      });
    });
  }

  setActiveClassForAccordion(): void {
    const accordionInputs = document.querySelectorAll<HTMLInputElement>('.accordion-input');
    const activeClass = 'active';

    accordionInputs.forEach((accordionInput: HTMLInputElement): void => {
      const thatParentTriggers = document.querySelectorAll<HTMLLabelElement>('label[for="' + accordionInput.id + '"]');

      thatParentTriggers.forEach((thatParentTrigger: HTMLLabelElement): void => {
        if (accordionInput.checked) {
          thatParentTrigger.classList.add(activeClass);
        } else {
          thatParentTrigger.classList.remove(activeClass);
        }
      });

      accordionInput.addEventListener('change', (event: Event): void => {
        event.preventDefault();
        event.stopPropagation();

        thatParentTriggers.forEach((thatParentTrigger: HTMLLabelElement): void => {
          if (accordionInput.checked) {
            thatParentTrigger.classList.add(activeClass);
          } else {
            thatParentTrigger.classList.remove(activeClass);
          }
        });
      });
    });
  }

  getCheckboxHtml(id: string, name: string, val: string, label: string, required: boolean, requiredMessage: string, checked: boolean): string {
    const isRequired = required ? 'required ' : '',
      isChecked = checked ? 'checked="checked" ' : '',
      isRequiredMessage = requiredMessage ? 'data-required-message="' + requiredMessage + '" ' : '';

    return (
      '<div class="form-check col-12 col-sm-6">\n' +
      '<input type="checkbox" ' +
      isChecked +
      'class="form-check-input" ' +
      isRequired +
      'name="' +
      name +
      '" ' +
      isRequiredMessage +
      'id="' +
      id +
      '" value="' +
      val +
      '">\n' +
      '<label class="form-check-label" for="' +
      id +
      '">' +
      label +
      '</label>\n' +
      '</div>' +
      (requiredMessage ? '<div class="invalid-tooltip">' + requiredMessage + '</div>' : '')
    );
  }

  setHistory(stepForHistory: string): void {
    window.location.hash = stepForHistory;
  }

  handleHistory(): void {
    const steps = ['atb-start', 'atb-result'];

    window.addEventListener('hashchange', (): void => {
      const cleanHash = window.location.hash.replace('#', '');
      const select = document.querySelectorAll<HTMLSelectElement>('[name="productType"]')[0];

      for (let i = 0; i <= steps.length; i++) {
        const stepName = steps[i];
        const dataSteps = document.querySelectorAll<HTMLElement>('[data-step="' + stepName + '"]');

        dataSteps.forEach((dataStep: HTMLElement): void => {
          dataStep.classList.add('d-none');
        });

        if (cleanHash === stepName) {
          dataSteps.forEach((dataStep: HTMLElement): void => {
            dataStep.classList.remove('d-none');
          });

          document.dispatchEvent(
            new CustomEvent('jdcgeld.step', {
              detail: {
                step: stepName,
                branch: select.value,
              },
            })
          );
        }
      }
    });

    this.dispatchHashchange();
  }

  dispatchHashchange(): void {
    if (typeof HashChangeEvent !== 'undefined') {
      window.dispatchEvent(new HashChangeEvent('hashchange'));
      return;
    }

    // HashChangeEvent is not available on all browsers. Use the plain Event.
    try {
      window.dispatchEvent(new Event('hashchange'));
      return;
    } catch (error) {
      // but that fails on IE
      console.error(error);
    }

    // IE workaround
    const ieEvent = document.createEvent('Event');
    ieEvent.initEvent('hashchange', true, true);
    window.dispatchEvent(ieEvent);
  }

  /**
   *
   * @param previousSelection
   * @param name {string}
   * @param value
   * @returns {boolean}
   */
  wasChecked(previousSelection: Array<any>, name: string, value: string): boolean {
    for (const key in previousSelection) {
      if (previousSelection[key]['name'] === name && previousSelection[key]['value'] === value) {
        return true;
      }
    }

    return false;
  }

  /**
   *
   * @param text {string}
   * @returns {string}
   */
  escape(text: string): string {
    const textNode = document.createTextNode(text);
    const p = document.createElement('p');
    p.appendChild(textNode);
    return p.innerHTML;
  }

  init(): void {
    this.initSelect();
    this.initForm();
    this.initCheckbox();
  }
}

((): void => {
  const atbBase = new AtbBase();

  atbBase.init();
})();
