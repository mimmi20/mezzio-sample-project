const vermiet = document.getElementById('vermiet');

if (vermiet instanceof HTMLSelectElement) {
  vermiet.addEventListener('change', (): void => {
    const anz = parseInt(vermiet.value, 10);

    for (let i = 0; i <= anz; i++) {
      const ob = document.getElementById('OB' + i);

      if (ob instanceof HTMLSelectElement || ob instanceof HTMLInputElement) {
        ob.setAttribute('required', 'required');
      }
    }

    for (let i = anz + 1; i <= 5; i++) {
      const ob = document.getElementById('OB' + i);

      if (ob instanceof HTMLSelectElement || ob instanceof HTMLInputElement) {
        ob.removeAttribute('required');
      }
    }
  });
}

const famstand = document.getElementById('famstand');

if (famstand instanceof HTMLSelectElement) {
  famstand.addEventListener('change', (): void => {
    const getdatePartner = document.getElementById('geburtsdatumPartner');

    if (!(getdatePartner instanceof HTMLElement)) {
      return;
    }

    if (famstand.value === 'Familie' || famstand.value === 'Paar') {
      getdatePartner.setAttribute('required', 'required');
    } else {
      getdatePartner.removeAttribute('required');
    }
  });
}
