(function (): void {
  const forms = document.querySelectorAll<HTMLFormElement>('[data-needs-validation]');

  forms.forEach((form: HTMLFormElement): void => {
    form.addEventListener(
      'submit',
      (event: SubmitEvent): void => {
        event.preventDefault();
        event.stopPropagation();

        const valid = form.checkValidity();

        form.classList.add('was-validated');

        if (valid) {
          const data = new FormData(form),
            netto = data.get('netto');

          if (null !== netto) {
            const bestehendeVorsorge = 100;
            const calculationResult = {
              valid: true,
              monatsBedarf: 1500,
              monatsRente: 1200,
              nettoRente: 900,
              kv: 50,
              steuer: 100,
            };

            if (!calculationResult.valid) {
              console.error('not valid');
              return;
            }

            const monatsBedarf = calculationResult.monatsBedarf || 0,
              monatsRente = calculationResult.monatsRente || 0,
              kv = calculationResult.kv || 0,
              steuer = calculationResult.steuer || 0;

            const erwarteteRente = calculationResult.nettoRente || 0;

            let rentenluecke = monatsBedarf - (erwarteteRente + bestehendeVorsorge);

            if (rentenluecke <= 0) {
              console.error('keine Rentenlücke');
              rentenluecke = 0;
            }

            const resultData = {
              type: 'rentenluecke',
              monatsBedarf: monatsBedarf,
              monatsRente: monatsRente,
              kv: kv,
              steuer: steuer,
            };

            document.dispatchEvent(
              new CustomEvent('rl.calculated', {
                detail: resultData,
                bubbles: true, // Whether the event will bubble up through the DOM or not
                cancelable: true, // Whether the event may be canceled or not
              })
            );

            const chart = document.querySelector('[data-chart]');

            if (null === chart) {
              console.error('no chart');
              return;
            }

            const infoText = chart.querySelector('.circle-info');

            if (infoText instanceof SVGTextElement) {
              infoText.textContent = new Intl.NumberFormat('de-DE', {
                style: 'currency',
                currency: 'EUR',
                maximumFractionDigits: 0,
              }).format(rentenluecke);
            }

            const chart1 = chart.querySelector('.secondary');

            if (chart1 instanceof SVGCircleElement) {
              const l = ((monatsBedarf - rentenluecke) / monatsBedarf) * 100;
              const o = (bestehendeVorsorge / monatsBedarf) * 100;
              chart1.style.strokeDasharray = `${l + o} 100`;
              chart1.style.strokeDashoffset = o.toString();
            }

            const chart2 = chart.querySelector('.primary');

            if (chart2 instanceof SVGCircleElement) {
              const l = (bestehendeVorsorge / monatsBedarf) * 100;
              chart2.style.strokeDasharray = `${l} 100`;
            }

            const pensionGapAmount = document.querySelector('[data-gap-amount]');
            const monthlyRequirementAmount = document.querySelector('[data-monthly-requirement-amount]');
            const pensionNetAmount = document.querySelector('[data-future-pension-amount]');
            const pensionActualAmount = document.querySelector('[data-actual-pension-amount]');

            if (pensionGapAmount instanceof HTMLOutputElement) {
              pensionGapAmount.value = new Intl.NumberFormat('de-DE', {
                style: 'currency',
                currency: 'EUR',
              }).format(rentenluecke);
            }

            if (monthlyRequirementAmount instanceof HTMLOutputElement) {
              monthlyRequirementAmount.value = new Intl.NumberFormat('de-DE', {
                style: 'currency',
                currency: 'EUR',
              }).format(monatsBedarf);
            }

            if (pensionNetAmount instanceof HTMLOutputElement && null !== pensionNetAmount.parentElement) {
              if (erwarteteRente > 0) {
                pensionNetAmount.value = new Intl.NumberFormat('de-DE', {
                  style: 'currency',
                  currency: 'EUR',
                }).format(erwarteteRente);
                pensionNetAmount.parentElement.classList.remove('d-none');
              } else {
                pensionNetAmount.parentElement.classList.add('d-none');
              }
            }

            if (pensionActualAmount instanceof HTMLOutputElement && null !== pensionActualAmount.parentElement) {
              if (bestehendeVorsorge >= 0) {
                pensionActualAmount.value = new Intl.NumberFormat('de-DE', {
                  style: 'currency',
                  currency: 'EUR',
                }).format(bestehendeVorsorge);
                pensionActualAmount.parentElement.classList.remove('d-none');
              } else {
                pensionActualAmount.parentElement.classList.add('d-none');
              }
            }
          }
        }
      },
      false
    );
  });

  const fields = document.querySelectorAll<HTMLInputElement | HTMLSelectElement>('[data-needs-validation] :is(input:not([type="button"]):not([type="submit"]), select)');

  fields.forEach((field: HTMLInputElement | HTMLSelectElement): void => {
    field.addEventListener(
      'blur',
      (event: Event): void => {
        event.preventDefault();
        event.stopPropagation();

        field.classList.add('was-edited');
      },
      { once: true }
    );
  });
})();
