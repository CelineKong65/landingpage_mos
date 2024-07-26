document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("contactForm");
    const formMessage = document.getElementById("formMessage");
    const menuIcon = document.getElementById("menu-icon");
    const navbar = document.getElementById("navbar");

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch("contact.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            formMessage.textContent = data;
            form.reset();
        })
        .catch(error => {
            formMessage.textContent = "An error occurred. Please try again.";
            console.error("Error:", error);
        });
    });

    menuIcon.addEventListener("click", function() {
        navbar.querySelector("ul").classList.toggle("active");
    });
});
