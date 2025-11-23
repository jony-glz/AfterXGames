const carousel = document.querySelector(".carousel");
const prevBtn = document.querySelector(".prev");
const nextBtn = document.querySelector(".next");


const SLIDE_WIDTH = 900; 

let offset = 0;


const maxOffset = -((carousel.children.length - 1) * SLIDE_WIDTH);


nextBtn.addEventListener("click", () => {
    if (offset <= maxOffset) {
        offset = 0; 
    } else {
        offset -= SLIDE_WIDTH;
    }
    carousel.style.transform = `translateX(${offset}px)`;
});


prevBtn.addEventListener("click", () => {
    if (offset >= 0) {
        offset = maxOffset; 
    } else {
        offset += SLIDE_WIDTH;
    }
    carousel.style.transform = `translateX(${offset}px)`;
});