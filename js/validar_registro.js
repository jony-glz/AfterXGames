document.getElementById("formRegistro").addEventListener("submit", function (e) {
    e.preventDefault(); // DETIENE el envío para validar

    let usuario = document.querySelector("input[name='usuario']").value.trim();
    let password = document.querySelector("input[name='password']").value.trim();
    let nombre = document.querySelector("input[name='nombre']").value.trim();
    let correo = document.querySelector("input[name='correo']").value.trim();
    let telefono = document.querySelector("input[name='telefono']").value.trim();

    // Expresiones regulares
    let regexUsuario = /^[a-zA-Z0-9_]{4,20}$/;
    let regexNombre = /^[a-zA-ZÀ-ÿ\s]{3,40}$/;
    let regexCorreo = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
    let regexTelefono = /^[0-9]{10}$/;

    // Validaciones
    if (!regexUsuario.test(usuario)) {
        alert(" Usuario inválido. Solo letras, números o _, mínimo 4 caracteres.");
        return;
    }

    if (password.length < 4) {
        alert(" La contraseña debe tener al menos 4 caracteres.");
        return;
    }

    if (!regexNombre.test(nombre)) {
        alert(" Nombre inválido. Solo letras y espacios.");
        return;
    }

    if (!regexCorreo.test(correo)) {
        alert(" Correo electrónico inválido.");
        return;
    }

    if (telefono !== "" && !regexTelefono.test(telefono)) {
        alert(" El teléfono debe tener exactamente 10 números.");
        return;
    }

    // Si pasa todo → enviamos el formulario al PHP
    this.submit();
});
