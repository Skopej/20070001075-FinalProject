// Carousel functionality
function initializeCarousel() {
    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');
    const slides = document.querySelectorAll('.carousel-slide');
    let currentSlide = 0;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.style.transform = `translateX(${100 * (i - index)}%)`;
        });
    }

    prevButton.addEventListener('click', () => {
        currentSlide = (currentSlide > 0) ? currentSlide - 2 : slides.length + 1;
        showSlide(currentSlide);
    });

    nextButton.addEventListener('click', () => {
        currentSlide = (currentSlide < slides.length) ? currentSlide + 2 : 0;
        showSlide(currentSlide);
    });

    showSlide(currentSlide);
}

// Search functionality
document.addEventListener("DOMContentLoaded", function() {
    const searchButton = document.getElementById('search');
    const searchInput = document.querySelector('.search-box input');

    searchButton.addEventListener('click', () => {
        const query = searchInput.value.trim();
        if (query !== "") {
            window.location.href = `search.php?query=${encodeURIComponent(query)}`;
        }
    });
});

// Google Sign-In functionality
function onSignIn(googleUser) {
    const profile = googleUser.getBasicProfile();
    const profileLink = document.getElementById("profile-link");
    const profileText = document.getElementById("profile-text");

    if (profileLink && profileText) {
        profileLink.href = "user.php";
        profileText.textContent = "Profile";
    }

    console.log('ID: ' + profile.getId());
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail());
}
