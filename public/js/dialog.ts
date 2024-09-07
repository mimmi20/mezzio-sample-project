class Dialog {
  initLayer(): void {
    const layerTriggers = document.querySelectorAll<HTMLElement>('.info-layer-trigger');

    layerTriggers.forEach((layerTrigger: HTMLElement): void => {
      const layerId = layerTrigger.getAttribute('data-layer');

      if (layerId === null) {
        console.error('no layer-id');
        return;
      }

      const dialog = document.getElementById(layerId);

      if (!(dialog instanceof HTMLDialogElement)) {
        console.log(`layer ${layerId} not found`);
        return;
      }

      layerTrigger.addEventListener('click', (event: Event): void => {
        console.log('Button was clicked');

        event.preventDefault();
        event.stopPropagation();

        dialog.showModal();
        dialog.setAttribute('aria-hidden', 'false');
      });

      this.initDialog(dialog);
    });
  }

  initDialog(dialog: HTMLDialogElement): void {
    const closeButtons = dialog.querySelectorAll<HTMLButtonElement>('[data-bs-dismiss="modal"]');

    closeButtons.forEach(function (button: HTMLButtonElement): void {
      button.addEventListener('click', (event: MouseEvent): void => {
        event.preventDefault();
        event.stopPropagation();

        dialog.close();
        dialog.setAttribute('aria-hidden', 'true');
      });
    });
  }

  init(): void {
    this.initLayer();
  }
}

(function (): void {
  const dialog = new Dialog();

  dialog.init();
})();
