/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.scss';


document.addEventListener("DOMContentLoaded", function () {
    const hamburger = document.querySelector(".hamburger");
    const navigation = document.getElementById("navigation");
    const dropdownToggles = document.querySelectorAll(".dropdown-toggle");

    // Gestion de l'ouverture/fermeture du menu mobile
    hamburger.addEventListener("click", function () {
      console.log("Hamburger clicked");
        // Toggle la classe "active" sur le hamburger et le menu de navigation
        this.classList.toggle("active");
        navigation.classList.toggle("active");
        document.body.classList.toggle("no-scroll"); // Empêche le scroll en arrière-plan
    });

    // Fermer le menu en cliquant en dehors
    document.addEventListener("click", function (event) {
        if (!hamburger.contains(event.target) && !navigation.contains(event.target)) {
            hamburger.classList.remove("active");
            navigation.classList.remove("active");
            document.body.classList.remove("no-scroll");
        }
    });

    // Gestion du menu déroulant "Événements"
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener("click", function (event) {
            event.stopPropagation();
            this.nextElementSibling.classList.toggle("show");
        });
    });

    // Fermer le dropdown si on clique ailleurs
    document.addEventListener("click", function (event) {
        if (!event.target.closest(".dropdown")) {
            document.querySelectorAll(".dropdown-menu").forEach(menu => {
                menu.classList.remove("show");
            });
        }
    });
});
