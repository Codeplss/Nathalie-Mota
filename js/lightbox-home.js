jQuery(document).ready(function($) {
    $('.fullscreen-icon').click(function(e) {
        e.preventDefault(); // Empêche le comportement par défaut du lien
        console.log("Icône plein écran cliquée");

        const imageSrc = $(this).closest('.thumbnail-wrapper').find('img').attr('src');
        $('.modal-container').addClass('opened');
        $('.middle-image').attr('src', imageSrc);
    });

    // Gestion de la fermeture de la boîte modale lorsque l'on clique sur le bouton de fermeture
    $('.btn-close').click(function() {
        $('#fullscreenModal').removeClass('opened'); // Ferme la modal
        console.log("Modal fermée");
    });
});