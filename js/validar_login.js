document.getElementById("formLogin").addEventListener("submit", function (event) {
    event.preventDefault(); // Detiene envío para validar

    const usuario = document.querySelector("input[name='usuario']");
    const contrasena = document.querySelector("input[name='contrasena']");

    // Limpiar errores previos
    document.querySelectorAll(".error").forEach(e => e.remove());
    usuario.style.border = "";
    contrasena.style.border = "";

    let valido = true;

    // REGEX
    const regexUsuario = /^[A-Za-z0-9_]{4,20}$/;
    const regexPass = /^.{4,30}$/;

    // VALIDACIÓN USUARIO
    if (!regexUsuario.test(usuario.value)) {
        mostrarError(usuario, "El usuario debe tener entre 4 y 20 caracteres (letras, números o guiones bajos)");
        valido = false;
    }

    // VALIDACIÓN CONTRASEÑA
    if (!regexPass.test(contrasena.value)) {
        mostrarError(contrasena, "La contraseña debe tener mínimo 4 caracteres");
        valido = false;
    }


    if (!valido) return;

   
    this.submit();
});


function mostrarError(campo, mensaje) {
    campo.style.border = "2px solid red"; // DOM uso 1

    const error = document.createElement("p"); // DOM uso 2
    error.classList.add("error");
    error.style.color = "red";
    error.style.fontSize = "14px";
    error.textContent = mensaje;

    campo.parentNode.appendChild(error); // DOM uso 3
}
