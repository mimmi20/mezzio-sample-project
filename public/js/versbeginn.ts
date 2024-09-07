const versbeginn = document.querySelectorAll<HTMLInputElement>('[name="versbeginn"]');
const versbeginnDatum = document.getElementById('versbeginn_datum');

if (versbeginn && versbeginnDatum) {
  versbeginn.forEach((element: HTMLInputElement): void => {
    element.addEventListener('click', (): void => {
      if (element.value === 'datum') {
        versbeginnDatum.setAttribute('required', 'required');
      } else {
        versbeginnDatum.removeAttribute('required');
      }
    });
  });
}
