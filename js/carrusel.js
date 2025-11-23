$(document).ready(function() {
    
    // Selectores globales
    const $carousel = $(".carousel");
    const $prevBtn = $(".prev");
    const $nextBtn = $(".next");
    const $sliderContainer = $(".slider-container");
    
    // Variables de control globales 
    let SLIDE_WIDTH;
    let slideCount;
    let maxOffset;
    let offset = 0; 
    let autoMoveInterval;
    
    const INTERVAL_TIME = 3000; // 3 segundos para el auto-movimiento
 
    function initializeCarousel() {
        // Recalcular el tamaño REAL basado en CSS (900px o 90vw)
        SLIDE_WIDTH = $sliderContainer.width(); 
        slideCount = $carousel.children().length;
        maxOffset = -((slideCount - 1) * SLIDE_WIDTH);
        
        //  Asegurarse de que el carrusel inicie correctamente en la posición 0
        offset = 0;
        $carousel.css('left', '0px');
    }
    
    // Función para manejar el movimiento con animación
    function moveCarousel() {
        $carousel.stop().animate({
            left: offset + 'px'
        }, 400); 
    }

    // Función que avanza al siguiente slide
    function nextSlide() {
        if (offset <= maxOffset) {
            offset = 0; 
        } else {
            offset -= SLIDE_WIDTH;
        }
        moveCarousel();
    }
    
    // Funciones de control de auto-movimiento
    function startAutoMove() {
        stopAutoMove(); // Siempre limpiamos antes de iniciar
        autoMoveInterval = setInterval(nextSlide, INTERVAL_TIME);
    }
    
    function stopAutoMove() {
        clearInterval(autoMoveInterval);
    }
    
    // --- Manejadores de Eventos Manuales ---
    $nextBtn.on("click", function() {
        nextSlide();
        startAutoMove(); // Reinicia el temporizador
    });

    $prevBtn.on("click", function() {
        if (offset >= 0) {
            offset = maxOffset; 
        } else {
            offset += SLIDE_WIDTH;
        }
        moveCarousel();
        startAutoMove(); // Reinicia el temporizador
    });

    // Pausa al pasar el ratón (Hover)
    $sliderContainer.hover(stopAutoMove, startAutoMove);
    
    // Recalcular en redimensionamiento y al iniciar
    $(window).on('resize', function() {
        // Detiene el movimiento durante el cambio de tamaño
        stopAutoMove(); 
        
        // Recalcula después de un breve retraso
        setTimeout(function() {
            initializeCarousel();
            startAutoMove();
        }, 50); // 50ms debería ser suficiente para que el navegador se asiente
    }).trigger('resize'); //  Forzamos el evento 'resize' al inicio

    // Inicialización con Retraso
    setTimeout(function() {
        initializeCarousel();
        startAutoMove(); 
    }, 100); 
});
