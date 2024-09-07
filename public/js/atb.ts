class AtbBase {
  handleError(headline: string, text: string): void {
    const dialog = document.getElementById('error-layer');

    if (!(dialog instanceof HTMLDialogElement)) {
      return;
    }

    this.initDialog(dialog);

    const titles = dialog.querySelectorAll<HTMLElement>('.modal-title');

    titles.forEach(function (title: HTMLElement): void {
      title.innerHTML = headline;
    });

    const bodies = dialog.querySelectorAll<HTMLElement>('.modal-body p');

    bodies.forEach(function (body: HTMLElement): void {
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
    const that = this;

    selects.forEach(function (select: HTMLSelectElement): void {
      select.addEventListener('change', async function (event: Event): Promise<void> {
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
        // nextElementOptions.forEach(function (nextElementOption: HTMLOptionElement): void {
        //   nextElementOption.remove();
        // });

        const allSelects = document.querySelectorAll<HTMLSelectElement>('.row select:not([id="productType"])');
        let nextSelectFound = false;

        allSelects.forEach(function (selectElement: HTMLSelectElement): void {
          if (selectElement.id === next) {
            nextSelectFound = true;
            return;
          }

          if (!nextSelectFound || selectElement.disabled) {
            return;
          }

          selectElement.parentElement?.setAttribute('disabled', 'disabled');

          // const nextSelectOptions = selectElement.querySelectorAll<HTMLOptionElement>('option:not([value=""])');
          // nextSelectOptions.forEach(function (nextElementOption: HTMLOptionElement): void {
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

        const results = await that.fetch(urls[next], form, submitter, function (error: Error): void {
          console.error(error);

          select.classList.add('text-danger'); // indicate error
        });

        if (typeof results === 'object') {
          Object.keys(results).forEach(function (key) {
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
    const that = this;

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

    form.addEventListener('submit', async function (event: SubmitEvent): Promise<boolean> {
      //event.preventDefault();
      // event.stopPropagation();

      const valid = form.checkValidity();

      form.classList.add('was-validated');

      if (!valid) {
        return false;
      }

      await that.handleForm(form);

      return true;
    });
  }

  async fetch(action: string, form: HTMLFormElement, submitter: HTMLElement, cb: Function): Promise<any> {
    const formData = new FormData(form, submitter);
    const that = this;

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

    if (results.hasOwnProperty('error')) {
      if (results.error === 'webservice error') {
        that.handleError('Keine Leistungsbewertung', 'Für den gewählten Tarif liegt keine Leistungsbewertung vor.');
      }

      return null;
    }

    return results;
  }

  getSelected(form: HTMLFormElement, name: string): any[] {
    const data: any[] = [];
    const options = form.querySelectorAll<HTMLOptionElement>('select[name="' + name + '"] option');

    options.forEach(function (option) {
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

    options.forEach(function (option) {
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
    const resultContainer = document.querySelectorAll<HTMLElement>('[data-step="result"]')[0];
    const submitter = form.querySelectorAll<HTMLButtonElement>('button[type="submit"]')[0];
    const that = this;

    thatSubmitBtns.forEach(function (button) {
      button.classList.add('active');
      button.setAttribute('disabled', 'disabled');
    });

    let resultData = {
      type: that.getSelected(form, 'productType')[0],
      insurer: that.getSelected(form, 'company')[0],
      tariffgeneration: that.getSelected(form, 'year')[0],
      tariffname: that.getSelected(form, 'product')[0],
      options: that.getOptions(form),
      actualTariff: 0.0,
      bestTariff: 0.0,
    };

    setTimeout(function () {
      const circles = form.querySelectorAll('.circle');
      circles.forEach(function (circle) {
        circle.classList.add('animate');
      });

      that.setActiveClassForAccordion();

      const charts = document.querySelectorAll('.progress-chart .non-width');

      charts.forEach(function (chart) {
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

    that.setHistory('atb-result');

    thatSubmitBtns.forEach(function (button) {
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

    const that = this;
    const productOptions = document.getElementById('prod-opt');
    let previousSelection: any[] = [];

    const submitter = form.querySelectorAll<HTMLButtonElement>('button[type="submit"]')[0];
    const formData = new FormData(form, submitter);

    if (!isCheckbox) {
      if (productOptions !== null) {
        const containers = productOptions.querySelectorAll<HTMLDivElement>('div');

        containers.forEach(function (container) {
          container.remove();
        });
      }
    } else {
      for (let [key, value] of await formData.entries()) {
        previousSelection[key] = value;
      }
    }

    if (typeof thatScript.dataset.url === 'undefined') {
      return;
    }

    const urls = await JSON.parse(thatScript.dataset.url);

    element.classList.remove('text-danger');

    const results = await that.fetch(urls['prod-opt'], form, submitter, function (error: Error): void {
      console.error(error);

      element.classList.add('text-danger'); // indicate error
    });

    if (typeof results === 'object' && results.hasOwnProperty('elements')) {
      let htmlCheckbox = '',
        index = 0;

      if (productOptions !== null) {
        productOptions.classList.remove('is-group');
        const containers = productOptions.querySelectorAll('div');

        containers.forEach(function (container) {
          container.remove();
        });
      }

      Object.keys(results.elements).forEach(function (key) {
        const text = results.elements[key] + (results.required === true ? ' *' : '');
        let requiredText = '';

        if (results.required === true) {
          requiredText = 'Bitte wählen Sie mindestens einen Baustein.';
        }

        htmlCheckbox += that.getCheckboxHtml(
          'prod-opt_' + that.escape(key),
          'prod-opt[]',
          that.escape(key),
          that.escape(text),
          results.required === true,
          requiredText,
          that.wasChecked(previousSelection, 'prod-opt[]', key)
        );
        index++;
      });

      if (productOptions !== null) {
        if (results.required === true) {
          productOptions.classList.add('is-group');
        }

        productOptions.innerHTML = htmlCheckbox;

        const inputs = productOptions.querySelectorAll('input');

        inputs.forEach(function (input) {
          input.addEventListener('change', async function (event) {
            event.preventDefault();
            event.stopPropagation();

            await that.handleCheckbox(input, true);
          });
        });
      }
    }
  }

  initCheckbox(): void {
    const elements = document.querySelectorAll<HTMLInputElement>('#product, #insuranceSelection input');
    const that = this;

    elements.forEach(function (element: HTMLInputElement): void {
      element.addEventListener('change', async function (event) {
        event.preventDefault();
        event.stopPropagation();

        await that.handleCheckbox(element, element instanceof HTMLInputElement);
      });
    });
  }

  setActiveClassForAccordion(): void {
    const accordionInputs = document.querySelectorAll<HTMLInputElement>('.accordion-input');
    const activeClass = 'active';

    accordionInputs.forEach(function (accordionInput: HTMLInputElement): void {
      const thatParentTriggers = document.querySelectorAll<HTMLLabelElement>('label[for="' + accordionInput.id + '"]');

      thatParentTriggers.forEach(function (thatParentTrigger: HTMLLabelElement): void {
        if (accordionInput.checked) {
          thatParentTrigger.classList.add(activeClass);
        } else {
          thatParentTrigger.classList.remove(activeClass);
        }
      });

      accordionInput.addEventListener('change', (event: Event): void => {
        event.preventDefault();
        event.stopPropagation();

        thatParentTriggers.forEach(function (thatParentTrigger: HTMLLabelElement): void {
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

    window.addEventListener('hashchange', function (): void {
      const cleanHash = this.location.hash.replace('#', '');
      const select = document.querySelectorAll<HTMLSelectElement>('[name="productType"]')[0];

      for (let i = 0; i <= steps.length; i++) {
        const stepName = steps[i];
        const dataSteps = document.querySelectorAll<HTMLElement>('[data-step="' + stepName + '"]');

        dataSteps.forEach(function (dataStep): void {
          dataStep.classList.add('d-none');
        });

        if (cleanHash === stepName) {
          dataSteps.forEach(function (dataStep): void {
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
    for (let key in previousSelection) {
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

(function (): void {
  const atbBase = new AtbBase();

  atbBase.init();
})();
