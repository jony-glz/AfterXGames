

document.addEventListener('DOMContentLoaded', () => {
    
    
    const inputBuscador = document.getElementById('buscador');
    const tabla = document.getElementById('tablaProductos');
    
    
    if (!inputBuscador || !tabla) {
        console.warn("Elementos HTML 'buscador' o 'tablaProductos' no encontrados.");
        return;
    }

    // Obtener todas las filas de la tabla 
    const filas = tabla.getElementsByTagName('tr');

    // evento 'keyup' (cuando el usuario escribe)
    inputBuscador.addEventListener('keyup', (e) => {
        
        
        const filtro = e.target.value.toLowerCase();
        
        // Iterar sobre cada fila de la tabla
        for (let i = 1; i < filas.length; i++) {
            
            let fila = filas[i];
            
            // Obtener el contenido de texto de toda la fila
            let textoFila = fila.textContent.toLowerCase();

            // Comparar y mostrar/ocultar
            if (textoFila.includes(filtro)) {
                // Mostrar la fila
                fila.style.display = ''; 
            } else {
                // Ocultar la fila
                fila.style.display = 'none';
            }
        }
    });
});