document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("editarJuego");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const nombre = document.querySelector("input[name='nombre']").value.trim();
        const descripcion = document.querySelector("textarea[name='descripcion']").value.trim();
        const precio = document.querySelector("input[name='precio']").value.trim();
        const stock = document.querySelector("input[name='stock']").value.trim();
        const imagen = document.querySelector("input[name='imagen']");

        //  VALIDACIONES
        if (nombre.length < 3) {
            alert("El nombre debe tener al menos 3 caracteres.");
            return;
        }

        if (descripcion.length < 10) {
            alert("La descripción debe tener mínimo 10 caracteres.");
            return;
        }

        if (isNaN(precio) || precio <= 0) {
            alert("Ingresa un precio válido mayor a 0.");
            return;
        }

        if (isNaN(stock) || stock < 0) {
            alert("El stock debe ser número mayor o igual a 0.");
            return;
        }

        // Validación de imagen opcional
        if (imagen.files.length > 0) {
            const archivo = imagen.files[0];

            const tiposValidos = ["image/jpeg", "image/png", "image/webp"];
            if (!tiposValidos.includes(archivo.type)) {
                alert("La imagen debe ser JPG, PNG o WEBP.");
                return;
            }

            if (archivo.size > 5 * 1024 * 1024) {
                alert("La imagen no debe superar 5MB.");
                return;
            }
        }

        // Si todo está bien → enviar
        form.submit();
    });

});
