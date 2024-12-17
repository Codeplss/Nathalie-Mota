jQuery(document).ready(function($) {
    // Assurez-vous que la modal est cachée au départ
    $('#myModal-photo').hide(); // Utilisez l'ID correct pour la modal

    // Gestion du clic sur le bouton myBtn-photo
    $('#myBtn-photo').click(function() {
        $('#myModal-photo').css('display', 'block'); // Affiche la modal

        // Remplir le champ de référence avec la valeur de la référence
        var reference = $('#ph-reference').text(); // Récupère la référence de la photo
        $('#ref-photo').val(reference); // Met à jour le champ caché avec la référence
    });

    // Gestion du clic sur le bouton de fermeture de la modal
    $('.close-photo').click(function() {
        $('#myModal-photo').css('display', 'none'); // Masque la modal
    });

    // Gestion du clic en dehors de la modal pour la fermer
    $(window).click(function(e) {
        var modal = $('#myModal-photo');
        if (e.target == modal[0]) {
            modal.hide(); // Masque la modal
        }
    });
});