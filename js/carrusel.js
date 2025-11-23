const carousel = document.querySelector(".carousel");
const prevBtn = document.querySelector(".prev");
const nextBtn = document.querySelector(".next");

let offset = 0;

nextBtn.addEventListener("click", () => {
    if (offset > -((carousel.children.length - 1) * 470)) {
        offset -= 470;
        carousel.style.transform = `translateX(${offset}px)`;
    }
});

prevBtn.addEventListener("click", () => {
    if (offset < 0) {
        offset += 470;
        carousel.style.transform = `translateX(${offset}px)`;
    }
});
