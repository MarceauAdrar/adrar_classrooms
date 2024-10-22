let currentSlide = 0;

// Get all the slides
const slides = document.querySelectorAll('.slide');

// Function to show a specific slide
function showSlide(index) {
    const slidesContainer = document.querySelector('.slides');
    
    // Adjust the index to stay within bounds
    if (index >= slides.length) {
        currentSlide = 0;
    } else if (index < 0) {
        currentSlide = slides.length - 1;
    } else {
        currentSlide = index;
    }
    
    // Move the slides container to show the current slide
    slidesContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
}

// Function to go to the next slide
function nextSlide() {
    showSlide(currentSlide + 1);
}

// Function to go to the previous slide
function prevSlide() {
    showSlide(currentSlide - 1);
}

// Initialize the slider by showing the first slide
showSlide(currentSlide);
