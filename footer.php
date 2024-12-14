<footer> <!-- Début de la section footer -->
<?php
    // Affiche le menu secondaire dans le pied de page
    wp_nav_menu(array(
        'theme_location' => 'menu_secondaire', // Emplacement du menu à afficher
        'container' => false, // Ne pas ajouter de conteneur autour du menu
        'menu_class' => 'footer-menu', // Classe CSS à appliquer au menu
    ));
?>	
</footer> <!-- Fin de la section footer -->
<?php wp_footer(); // Appelle wp_footer() pour inclure les scripts et styles nécessaires avant la fermeture de la balise body ?>
</body>
</html>
