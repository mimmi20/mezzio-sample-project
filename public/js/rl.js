const forms = document.querySelectorAll('[data-needs-validation]');

forms.forEach((form) => {
  form.addEventListener(
    'submit',
    (event) => {
    event.preventDefault();
    event.stopPropagation();

    const valid = form.checkValidity();

    form.classList.add('was-validated');

    if (valid) {
      const data = new FormData(form),
        state = data.get('state'),
        stkl = data.get('stkl'),
        netto = data.get('netto'),
        anzahl = data.get('anzahl'),
        geb = data.get('geb'),
        rente = data.get('rente'),
        alter = data.get('alter'),
        inflationsrate = data.get('inflationsrate'),
        inflationAn = data.get('inflationAn');

      if (null !== state && null !== stkl && null !== netto) {
        const calculationResult = Rentenluecke.calculate(
          !(state instanceof File) ? state.toString() || '' : '',
          !(stkl instanceof File) ? parseInt(stkl.toString(), 10) : 0,
          !(netto instanceof File) ? parseInt(netto.toString(), 10) : 0,
          !(anzahl instanceof File) ? parseInt((anzahl || 0).toString(), 10) : 0,
          !(geb instanceof File) ? parseInt((geb || 0).toString(), 10) : 0,
          !(rente instanceof File) ? parseInt((rente || 0).toString(), 10) : 0,
          !(alter instanceof File) ? parseInt((alter || 0).toString(), 10) : 0,
          !(inflationsrate instanceof File) ? parseFloat((inflationsrate || 0.0).toString()) : 0,
          !(inflationAn instanceof File) ? !!(inflationAn || false) : false,
          LZZ.LZZ_JAHR,
          KRV.KRV_TABELLE_ALLGEMEIN,
          true, // kinderlos u. über 23J.
          1, // Kirchensteuer berechnen
          0.0, // Anzahl Kinderfreibeträge
        );

        if (!calculationResult.valid) {
          return;
        }

        const monatsBedarf = calculationResult.monatsBedarf || 0,
          monatsRente = calculationResult.monatsRente || 0,
          kv = calculationResult.kv || 0,
          steuer = calculationResult.steuer || 0;

        erwarteteRente = calculationResult.nettoRente || 0;

        let rentenluecke = monatsBedarf - (erwarteteRente + bestehendeVorsorge);

        if (rentenluecke <= 0) {
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
          }),
        );

        const chart = this.root.getElementById('js-doughnut-chart');

        if (null === chart || !(chart instanceof HTMLCanvasElement)) {
          return;
        }

        //this.updateChart(erwarteteRente, bestehendeVorsorge, rentenluecke);

        const pensionGapAmount = this.root.getElementById('pension-gap-amount');
        const monthlyRequirementAmount = this.root.getElementById('monthly-requirement-amount');
        const pensionNetAmount = this.root.getElementById('future-net-pension-amount');
        const pensionActualAmount = this.root.getElementById('actual-pension-amount');

        if (null !== pensionGapAmount && pensionGapAmount instanceof HTMLOutputElement) {
          pensionGapAmount.value = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(rentenluecke);
        }

        if (null !== monthlyRequirementAmount && monthlyRequirementAmount instanceof HTMLOutputElement) {
          monthlyRequirementAmount.value = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(monatsBedarf);
        }

        if (null !== pensionNetAmount && pensionNetAmount instanceof HTMLOutputElement && null !== pensionNetAmount.parentElement) {
          if (erwarteteRente > 0) {
            pensionNetAmount.value = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(erwarteteRente);
            pensionNetAmount.parentElement.classList.remove('d-none');
          } else {
            pensionNetAmount.parentElement.classList.add('d-none');
          }
        }

        if (null !== pensionActualAmount && pensionActualAmount instanceof HTMLOutputElement && null !== pensionActualAmount.parentElement) {
          if (erwarteteRente > 0) {
            pensionActualAmount.value = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(bestehendeVorsorge);
            pensionActualAmount.parentElement.classList.remove('d-none');
          } else {
            pensionActualAmount.parentElement.classList.add('d-none');
          }
        }
      }
    }
  },
  false,
);
});

const fields = document.querySelectorAll('[data-needs-validation] :is(input, select)');

fields.forEach((field) => {
  field.addEventListener(
    'blur',
    (event) => {
      event.preventDefault();
      event.stopPropagation();

      field.classList.add('was-edited');
    },
    { once: true },
  );
});
