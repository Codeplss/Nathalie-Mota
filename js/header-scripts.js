// MENU BURGER MOBILE
// Gérer le clic sur le bouton d'ouverture du menu
$('#open-fullscreen-menu-button').click(function(e) {
    e.stopPropagation(); // Empêche la propagation de l'événement de clic
    $('header').toggleClass('mobile-menu-opened'); // Ajoute ou supprime la classe pour ouvrir/fermer le menu mobile
});

// FERMER MENU - CLIQUER SUR LE BOUTON DE FERMETURE
$('#close-fullscreen-menu-button').click(function() {
    $('header').removeClass('mobile-menu-opened'); // Supprime la classe pour fermer le menu mobile
});

// Gérer le clic en dehors du menu pour le fermer
$(document).click(function(e) {
    if (!$(e.target).closest('header').length) { // Vérifie si le clic est en dehors de l'en-tête
        $('header').removeClass('mobile-menu-opened'); // Ferme le menu si le clic est en dehors
    }
});

// Gérer le clic sur le bouton d'ouverture de la modale
$('#open-modal-button-header').click(function() {
    $('#myModal').css('display', 'block'); // Affiche la modale
});

// Gérer le clic sur le bouton de fermeture de la modale
$('.close').click(function() {
    $('#myModal').css('display', 'none'); // Masque la modale
});

// Gérer le clic sur le bouton d'ouverture du menu
document.getElementById('open-fullscreen-menu-button').addEventListener('click', function() {
    this.classList.toggle('active'); // Ajoute ou supprime la classe active pour le bouton
    document.querySelector('.header-menu').classList.toggle('active'); // Ajoute ou supprime la classe active pour le menu
    document.body.classList.toggle('menu-open'); // Ajoute ou supprime la classe pour le corps
});

// Gestionnaire unique pour tous les liens de contact
$(document).on('click', '#contact-link, a[href="#contact"]', function(e) {
    e.preventDefault();
    e.stopPropagation();
    var modal = $('#myModal');
    modal.show();
    // Fermer le menu mobile si ouvert
    if ($('header').hasClass('mobile-menu-opened')) {
        $('header').removeClass('mobile-menu-opened');
    }
});

// Fermeture de la modal
$('.close, .close-button').click(function() {
    $('#myModal').hide();
    // S'assurer que le menu fullscreen est fermé aussi
    $('.header-menu').removeClass('active');
    $('.mobile-menu-button').removeClass('active');
    $('body').removeClass('menu-open');
});

// Fermeture en cliquant en dehors
$(window).click(function(e) {
    var modal = $('#myModal');
    if (e.target == modal[0]) {
        modal.hide();
        // S'assurer que le menu fullscreen est fermé aussi
        $('.header-menu').removeClass('active');
        $('.mobile-menu-button').removeClass('active');
        $('body').removeClass('menu-open');
    }
});

// PHOTO UNIQUE - NAVIGATION DES PHOTOS (SURVOL)
if( $('.right-container').length ){
    // Mise en cache des éléments fréquemment utilisés
    const wrapper = document.querySelector('.thumbnail-wrapper');
    const prevArrowLink = document.getElementById('prev-arrow-link');
    const nextArrowLink = document.getElementById('next-arrow-link');

    // Crée un objet Image pour précharger la vignette actuelle
    const currentThumbnailPreloader = new Image();
    const currentThumbnailURL = document.querySelector('.right-container a.photo img').getAttribute('src');
    currentThumbnailPreloader.src = currentThumbnailURL;
    currentThumbnailPreloader.onload = function () {
        preloadCurrentThumbnail(); // Déclenche le chargement initial après la prcharge
    };

    // Charge et affiche une vignette
    function loadThumbnail(thumbnailURL) {
        const thumbnail = document.createElement('img');
        thumbnail.src = thumbnailURL;
        
        // Efface le contenu existant dans le 'container'
        while (wrapper.firstChild) {
            wrapper.removeChild(wrapper.firstChild);
        }
        
        // Ajoute la vignette au 'container'
        wrapper.appendChild(thumbnail);
    }

    // Précharge et affiche la vignette de l'article actuel
    function preloadCurrentThumbnail() {
        loadThumbnail(currentThumbnailURL);
    }

    // Gestion des événements pour le survol de la souris
    function handleMouseover(direction) {
        const arrowLink = (direction === 'prev') ? prevArrowLink : nextArrowLink;
        const thumbnailURL = arrowLink.getAttribute('data-thumbnail');
        loadThumbnail(thumbnailURL);
    }

    // Gestion des événements pour le départ de la souris
    function handleMouseout() {
        preloadCurrentThumbnail();
    }

    // Déclenche la précharge de la vignette de l'article actuel lorsque la page se charge
    window.addEventListener('load', preloadCurrentThumbnail);

    // Attache des écouteurs d'événements en utilisant la délégation d'événements
    prevArrowLink.addEventListener('mouseover', () => handleMouseover('prev'));
    nextArrowLink.addEventListener('mouseover', () => handleMouseover('next'));
    prevArrowLink.addEventListener('mouseout', handleMouseout);
    nextArrowLink.addEventListener('mouseout', handleMouseout);
}

jQuery(document).ready(function($) {
    // Gestion du clic sur le bouton plein écran
    $('#fullscreen-button').click(function() {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen(); // Demande le mode plein écran
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen(); // Quitte le mode plein écran
            }
        }
    });

    // Gestion du clic sur le lien de contact
    $('#contact-link').click(function(event) {
        event.preventDefault(); // Empêche le comportement par défaut du lien
        $('#myModal').css('display', 'block'); // Affiche la modal
    });

    // Gestion du clic sur le bouton de fermeture de la modal
    $('.close-button').click(function() {
        $('#myModal').css('display', 'none'); // Masque la modal
    });
});
