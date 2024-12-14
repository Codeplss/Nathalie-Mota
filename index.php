<?php
get_header(); // Inclut l'en-tête du site
?>

<?php if (have_posts()) : ?> <!-- Vérifie s'il y a des publications disponibles -->
    <?php while (have_posts()) : the_post(); ?> <!-- Boucle à travers les publications -->
        <article> <!-- Début de l'article -->
            <h2><?php the_title(); ?></h2> <!-- Affiche le titre de la publication -->
            <?php if (is_singular()) : ?> <!-- Vérifie si la publication est singulière -->
                <?php the_content(); ?> <!-- Affiche le contenu de la publication -->
            <?php endif; ?> <!-- Fin de la vérification pour le contenu singulier -->
        </article> <!-- Fin de l'article -->
    <?php endwhile; ?> <!-- Fin de la boucle -->
<?php endif; ?> <!-- Fin de la vérification des publications -->

<?php get_footer(); // Inclut le pied de page du site ?>

</body>
</html>