$(document).ready(function() {
    
    const $carousel = $(".carousel");
    const $nextBtn = $(".next"); // Simulacion de clic
    const $sliderContainer = $(".slider-container"); // Contenedor para la pausa

    // Variables de control
    const SLIDE_WIDTH = 900; 
    const slideCount = $carousel.children().length;
    const maxOffset = -((slideCount - 1) * SLIDE_WIDTH);
    const INTERVAL_TIME = 3000; // ⭐ Tiempo de espera: 3 segundos
    
    let offset = 0; 
    let autoMoveInterval; 

    
    // Función para manejar el movimiento con animación
    function moveCarousel() {
        $carousel.stop().animate({
            left: offset + 'px'
        }, 400); 
    }

    // Función que simula el clic en "Siguiente"
    function nextSlide() {
        if (offset <= maxOffset) {
            offset = 0; 
        } else {
            offset -= SLIDE_WIDTH;
        }
        moveCarousel();
    }
    
    function startAutoMove() {
        // Establece un temporizador que llama a nextSlide() cada INTERVAL_TIME
        autoMoveInterval = setInterval(nextSlide, INTERVAL_TIME);
    }
    
    // Detiene el movimiento
    function stopAutoMove() {
        clearInterval(autoMoveInterval);
    }
    
    // Lógica de navegación manual 
    $(".next").on("click", function() {
        nextSlide();
        // Cuando hay interacción manual, reiniciamos el temporizador
        stopAutoMove();
        startAutoMove();
    });

    $(".prev").on("click", function() {
        if (offset >= 0) {
            offset = maxOffset; 
        } else {
            offset += SLIDE_WIDTH;
        }
        moveCarousel();
        // Cuando hay interacción manual, reiniciamos el temporizador
        stopAutoMove();
        startAutoMove();
    });

    // Pausar al poner el raton
    $sliderContainer.hover(
        // Mouse entra (mouseenter): Detener el movimiento
        function() {
            stopAutoMove();
        }, 
        // Mouse sale (mouseleave): Reanudar el movimiento
        function() {
            startAutoMove();
        }
    );
    
    startAutoMove();
});