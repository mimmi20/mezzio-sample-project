const verssummeauto = document.querySelectorAll<HTMLInputElement>('[name="verssummeauto"]');
const verssumme = document.getElementById('verssumme');

if (verssummeauto && verssumme) {
  verssummeauto.forEach((element: HTMLInputElement): void => {
    element.addEventListener('click', (event: MouseEvent): void => {
      if (element.value === 'manuell') {
        verssumme.setAttribute('required', 'required');
      } else {
        verssumme.removeAttribute('required');
      }
    });
  });
}
