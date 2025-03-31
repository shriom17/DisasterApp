let currentSlide = 0;

function moveSlide(direction) {
    const slides = document.querySelector('.slider'); // Select the slider container
    const totalSlides = slides.children.length; // Get the total number of slides
    currentSlide = (currentSlide + direction + totalSlides) % totalSlides; // Update the current slide index
    slides.style.transform = `translateX(-${currentSlide * 100}%)`; // Correctly set the transform property
}
