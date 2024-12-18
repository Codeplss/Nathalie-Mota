<?php
/**
 * Template Name: Post
 * Ce fichier définit un modèle de page pour afficher un article.
 */

// Inclut l'en-tête du site, qui contient généralement le logo, le menu de navigation, etc.
get_header();
?>

<main class="main-content-post"> <!-- Début de la section principale pour le contenu de l'article -->
    <?php
    // Vérifie s'il y a des articles à afficher.
    if (have_posts()) : 
        // Tant qu'il y a des articles à afficher, boucle.
        while (have_posts()) : 
            // Charge l'article actuel dans la boucle.
            the_post(); 
    ?>
        <div>
        <h2><?php the_title(); ?></h2>
            <?php the_content(); // Affiche le contenu de l'article. ?>
        </div>
    <?php
        endwhile; // Fin de la boucle des articles.
    endif; // Fin de la vérification de la présence d'articles.
    ?>
</main>

<?php
// Inclut le pied de page du site, qui contient généralement les informations de copyright, les liens vers les réseaux sociaux, etc.
get_footer();
