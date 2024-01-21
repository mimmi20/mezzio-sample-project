const forms = document.querySelectorAll<HTMLFormElement>('[data-needs-validation]');

forms.forEach((form: HTMLFormElement): void => {
  form.addEventListener(
    'submit',
    (event: SubmitEvent): void => {
      event.preventDefault();
      event.stopPropagation();

      form.checkValidity();
      form.classList.add('was-validated');
    },
    false,
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
      field.classList.remove('is-invalid');
      field.classList.remove('is-valid');
    },
    {once: true},
  );
});
