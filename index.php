<?php
get_header(); // Inclut l'en-tête du site
?>

<main class="main-content-post"> <!-- Début de la section principale pour le contenu de l'article -->
    <div class="page-content">
        <?php
        if (have_posts()) : // Vérifie s'il y a des publications
            while (have_posts()) : the_post(); // Boucle à travers les publications
                the_title('<h2>', '</h2>'); // Affiche le titre de la publication
                the_content(); // Affiche le contenu de la publication
            endwhile;
        else :
            echo '<p>Aucune publication trouvée.</p>'; // Message si aucune publication n'est trouvée
        endif;
        ?>
    </div>
</main>

<?php get_footer(); // Inclut le pied de page du site ?>

</body>
</html>



