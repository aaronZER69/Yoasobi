document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('.carousel__slide');
    const prevButton = document.querySelector('.carousel__button.prev');
    const nextButton = document.querySelector('.carousel__button.next');
    let currentIndex = 0;

    const updateCarousel = () => {
        const offset = -currentIndex * 100; 
        document.querySelector('.carousel__slides').style.transform = `translateX(${offset}%)`;

        slides.forEach((slide, index) => {
            slide.classList.toggle('active', index === currentIndex);
        });
    };

    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : slides.length - 1;
        updateCarousel();
    });

    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex < slides.length - 1) ? currentIndex + 1 : 0;
        updateCarousel();
    });

    updateCarousel();
});