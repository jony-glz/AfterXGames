document.getElementById("formComentario").addEventListener("submit", function (event) {
    event.preventDefault(); 

    // Obtener datos
    const nombre = document.querySelector("input[name='nombre']");
    const telefono = document.querySelector("input[name='telefono']");
    const correo = document.querySelector("input[name='correo']");
    const comentario = document.querySelector("textarea[name='comentario']");

    // Limpiar mensajes previos (DOM)
    const erroresPrevios = document.querySelectorAll(".error");
    erroresPrevios.forEach(e => e.remove());

    let valido = true;

    // Expresiones regulares
    const regexNombre = /^[A-Za-zÁÉÍÓÚáéíóúñÑ ]{3,30}$/;
    const regexTelefono = /^[0-9]{10}$/;
    const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Validación Nombre
    if (!regexNombre.test(nombre.value)) {
        mostrarError(nombre, "Ingresa un nombre válido (solo letras, mínimo 3 caracteres)");
        valido = false;
    }

    // Validación Teléfono
    if (!regexTelefono.test(telefono.value)) {
        mostrarError(telefono, "El teléfono debe tener 10 números");
        valido = false;
    }

    // Validación Correo
    if (!regexCorreo.test(correo.value)) {
        mostrarError(correo, "Ingresa un correo válido");
        valido = false;
    }

    // Validación Comentario vacío
    if (comentario.value.trim() === "") {
        mostrarError(comentario, "El comentario no puede estar vacío");
        valido = false;
    }

    
    if (!valido) return;

    // Si es válido, enviar al PHP
    this.method = "POST";
    this.action = "..\php\enviar_comentario.php";
    this.submit();
});

function mostrarError(campo, mensaje) {
    campo.style.border = "2px solid red"; // DOM uso 1

    const error = document.createElement("p"); // DOM uso 2
    error.textContent = mensaje;
    error.classList.add("error");
    error.style.color = "red";
    error.style.fontSize = "14px";

    campo.parentNode.appendChild(error); // DOM uso 3
}
