// Toggle de visualización de la contraseña en el formulario de registro
document.getElementById('toggleRegisterPassword').addEventListener('click', function () {
    const passwordField = document.getElementById('registerContrasena');
    const eyeIcon = document.getElementById('registerEyeIcon');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
});

// Toggle de visualización de la contraseña en el formulario de inicio de sesión
document.getElementById('toggleLoginPassword').addEventListener('click', function () {
    const passwordField = document.getElementById('contrasena');
    const eyeIcon = document.getElementById('loginEyeIcon');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
});

// Validar los requisitos de la contraseña en el registro
const passwordInput = document.getElementById('registerContrasena');
const lengthReq = document.getElementById('length-req');
const uppercaseReq = document.getElementById('uppercase-req');
const numberReq = document.getElementById('number-req');
const symbolReq = document.getElementById('symbol-req');

passwordInput.addEventListener('input', function () {
    const password = passwordInput.value;
    lengthReq.textContent = password.length >= 8 ? '✔ Longitud adecuada' : '✖ Mínimo 8 caracteres';
    uppercaseReq.textContent = /[A-Z]/.test(password) ? '✔ Contiene al menos una letra mayúscula' : '✖ Debe contener al menos una letra mayúscula';
    numberReq.textContent = /\d/.test(password) ? '✔ Contiene al menos un número' : '✖ Debe contener al menos un número';
    symbolReq.textContent = /[!@#$%^&*(),.?":{}|<>]/.test(password) ? '✔ Contiene al menos un símbolo' : '✖ Debe contener al menos un símbolo';
});

// Validar el formato del correo electrónico
const emailInput = document.getElementById('registerEmail');
const emailValid = document.getElementById('email-valid');

emailInput.addEventListener('input', function () {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    emailValid.textContent = emailPattern.test(emailInput.value) ? '✔ Correo válido' : '✖ Correo inválido';
});
