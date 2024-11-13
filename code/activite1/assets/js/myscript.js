function verifierFormulaire() {
    // Sélectionner les éléments du formulaire
    const nom = document.querySelector('[name="name"]');
    const prénom = document.querySelector('[name="prénom"]');
    const email = document.querySelector('[name="email"]');
    const password = document.querySelector('[name="password"]');
    const message = document.querySelector('[name="message"]');
    const checkbox = document.getElementById('formCheck-1');
    const passwordError = document.querySelector('.text-danger');

    let isValid = true;

    // Validation du nom
    if (nom.value.trim() === '') {
        nom.classList.add('is-invalid');
        nom.classList.remove('is-valid');
        isValid = false;
    } else {
        nom.classList.add('is-valid');
        nom.classList.remove('is-invalid');
    }

    // Validation du prénom
    if (prénom.value.trim() === '') {
        prénom.classList.add('is-invalid');
        prénom.classList.remove('is-valid');
        isValid = false;
    } else {
        prénom.classList.add('is-valid');
        prénom.classList.remove('is-invalid');
    }

    // Validation de l'email
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailRegex.test(email.value.trim())) {
        email.classList.add('is-invalid');
        email.classList.remove('is-valid');
        isValid = false;
    } else {
        email.classList.add('is-valid');
        email.classList.remove('is-invalid');
    }

    // Validation du mot de passe
    if (password.value.length < 8) {
        password.classList.add('is-invalid');
        password.classList.remove('is-valid');
        passwordError.classList.remove('invisible');
        isValid = false;
    } else {
        password.classList.add('is-valid');
        password.classList.remove('is-invalid');
        passwordError.classList.add('invisible');
    }

    // Validation du message
    if (message.value.trim() === '') {
        message.classList.add('is-invalid');
        message.classList.remove('is-valid');
        isValid = false;
    } else {
        message.classList.add('is-valid');
        message.classList.remove('is-invalid');
    }

    // Validation de l'âge (checkbox)
    if (!checkbox.checked) {
        checkbox.classList.add('is-invalid');
        isValid = false;
    } else {
        checkbox.classList.remove('is-invalid');
    }

    // Mise à jour du bouton selon la validité
    const btn = document.querySelector('.btn-primary');
    if (isValid) {
        btn.classList.add('btn-success');
        btn.classList.remove('btn-danger');
    } else {
        btn.classList.add('btn-danger');
        btn.classList.remove('btn-success');
    }
}
