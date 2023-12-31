const forms = document.querySelectorAll('[data-needs-validation]');

forms.forEach((form) => {
  form.addEventListener(
    'submit',
    (event) => {
      event.preventDefault();
      event.stopPropagation();

      const valid = form.checkValidity();

      form.classList.add('was-validated');
    },
    false,
  );
});

const fields = document.querySelectorAll('[data-needs-validation] :is(input:not([type="button"]):not([type="submit"]), select)');

fields.forEach((field) => {
  field.addEventListener(
    'blur',
    (event) => {
      event.preventDefault();
      event.stopPropagation();

      field.classList.add('was-edited');
    },
    {once: true},
  );
});
