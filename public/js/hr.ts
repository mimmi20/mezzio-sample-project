const versbeginn = document.querySelectorAll<HTMLInputElement>('[name="versbeginn"]');
const versbeginnDatum = document.getElementById('versbeginn_datum');

if (versbeginn && versbeginnDatum) {
  versbeginn.forEach((element) => {
    element.addEventListener('click', (event) => {
      if (element.value === 'datum') {
        versbeginnDatum.setAttribute('required', 'required');
      } else {
        versbeginnDatum.removeAttribute('required');
      }
    });
  });
}

const verssummeauto = document.querySelectorAll<HTMLInputElement>('[name="verssummeauto"]');
const verssumme = document.getElementById('verssumme');

if (verssummeauto && verssumme) {
  verssummeauto.forEach((element) => {
    element.addEventListener('click', (event) => {
      if (element.value === 'manuell') {
        verssumme.setAttribute('required', 'required');
      } else {
        verssumme.removeAttribute('required');
      }
    });
  });
}
