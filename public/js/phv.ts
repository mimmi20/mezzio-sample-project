const hundn = document.getElementById('Hundn');

if (hundn instanceof HTMLSelectElement) {
  const handleMh = function (event: Event) {
    if (!(event.target instanceof HTMLSelectElement) && !(event.target instanceof HTMLInputElement)) {
      return;
    }

    const val = event.target.value;
    const dog = event.target.getAttribute('data-dog');

    const rta = document.getElementById('Rasse_Tier' + dog + 'a');

    if (val === 'ja') {
      rta?.setAttribute('required', 'required');
    } else {
      rta?.removeAttribute('required');
    }
  };

  hundn.addEventListener('change', (): void => {
    const anz = parseInt(hundn.value, 10);

    for (let i = 0; i <= anz; i++) {
      const rt = document.getElementById('Rasse_Tier' + i);
      const mhs = document.querySelectorAll<HTMLSelectElement | HTMLInputElement>('[name="mischling_hund' + i + '"]');

      if (rt instanceof HTMLSelectElement || rt instanceof HTMLInputElement) {
        rt.setAttribute('required', 'required');
      }

      mhs.forEach((mh: HTMLSelectElement | HTMLInputElement): void => {
        mh.setAttribute('required', 'required');
        mh.addEventListener('change', handleMh);
      });
    }

    for (let i = anz + 1; i <= 5; i++) {
      const rt = document.getElementById('Rasse_Tier' + i);
      const mhs = document.querySelectorAll<HTMLSelectElement | HTMLInputElement>('[name="mischling_hund' + i + '"]');

      if (rt instanceof HTMLSelectElement || rt instanceof HTMLInputElement) {
        rt.removeAttribute('required');
      }

      mhs.forEach((mh: HTMLSelectElement | HTMLInputElement): void => {
        mh.removeAttribute('required');
        mh.removeEventListener('change', handleMh);
      });
    }
  });
}
