document.addEventListener("DOMContentLoaded", function () {
    const goUpButton = document.getElementById("goUpButton");

    // Show the button when scrolled down 100px from the top
    window.addEventListener("scroll", function () {
        if (window.scrollY > 100) {
            goUpButton.classList.add("show"); // Add the 'show' class
        } else {
            goUpButton.classList.remove("show"); // Remove the 'show' class
        }
    });

    // Scroll to top when the button is clicked
    goUpButton.addEventListener("click", function () {
        window.scrollTo({ top: 0, behavior: "smooth" });
    });

    // Carousel functionality
    const carousel = document.querySelector(".carousel-inner");
    const indicators = document.querySelectorAll(".indicator");
    let currentIndex = 0;

    function showSlide(index) {
        carousel.style.transform = `translateX(${-index * 100}%)`;
        indicators.forEach((indicator, i) => {
            indicator.classList.toggle("active", i === index);
        });
    }

    indicators.forEach((indicator, index) => {
        indicator.addEventListener("click", () => {
            showSlide(index);
            currentIndex = index;
        });
    });

    function autoSlide() {
        currentIndex = (currentIndex + 1) % indicators.length;
        showSlide(currentIndex);
    }

    setInterval(autoSlide, 3000); // Change slide every 3 seconds
});
