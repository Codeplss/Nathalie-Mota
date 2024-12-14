<?php
get_header(); // Inclut l'en-tête du site
?>

<div class="hero"> <!-- Section héro pour afficher une photo aléatoire -->
    <?php
    // Interrogation | Sélection d'une photo aléatoire de la même catégorie
    $args_related_photos = array(
        'post_type' => 'photographie', // Type de publication à récupérer
        'posts_per_page' => 1, // Limite à une seule photo
        'orderby' => 'rand', // Tri des résultats de manière aléatoire
    );

    $related_photos_query = new WP_Query($args_related_photos); // Exécute la requête pour obtenir une photo aléatoire
    // Boucle | Parcourir les résultats de la requête
    while ($related_photos_query->have_posts()) :
        $related_photos_query->the_post(); // Prépare la publication pour l'affichage
        $post_permalink = get_permalink(); // Lien permanent de la publication actuelle
    ?>
    <a href="<?php echo esc_url($post_permalink); ?>"> <!-- Lien vers la photo -->
        <div class="hero-image" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"> <!-- Image héro avec fond -->
        <h1 class="hero-title">Photographe Event</h1> <!-- Titre de la section héro -->
        </div>
    </a>
    <?php endwhile; ?>

    <?php wp_reset_postdata(); // Réinitialiser | Données de publication à leur état d'origine ?>
</div>
<!-- Section | Filtres -->
<div class="filters-and-sort"> <!-- Conteneur pour les filtres de sélection -->
    <!-- Filtre | Categorie -->
    <label for="category-filter"></label> <!-- Étiquette pour le filtre de catégorie -->
    <select name="category-filter" id="category-filter"> <!-- Sélecteur pour les catégories -->
        <option value="ALL">CATÉGORIE</option> <!-- Option par défaut -->
        <?php
        $photo_categories = get_terms('categorie'); // Récupère les termes de la taxonomie 'categorie'
        foreach ($photo_categories as $category) {
            echo '<option value="' . $category->slug . '">' . $category->name . '</option>'; // Affiche chaque catégorie dans le sélecteur
        }
        ?>
    </select>

    <!-- Filtre | Format -->
    <label for="format-filter"></label> <!-- Étiquette pour le filtre de format -->
    <select name="format-filter" id="format-filter"> <!-- Sélecteur pour les formats -->
        <option value="ALL">FORMAT</option> <!-- Option par défaut -->
        <?php
        $photo_formats = get_terms('format'); // Récupère les termes de la taxonomie 'format'
        foreach ($photo_formats as $format) {
            echo '<option value="' . $format->slug . '">' . $format->name . '</option>'; // Affiche chaque format dans le sélecteur
        }
        ?>
    </select>

    <!-- Filtre | Trier par date -->
    <label for="date-sort"></label> <!-- Étiquette pour le filtre de tri par date -->

    <select name="date-sort" id="date-sort"> <!-- Sélecteur pour trier par date -->
        <option value="ALL">TRIER PAR</option> <!-- Option par défaut -->
        <option value="DESC">Du plus récent au plus ancien</option> <!-- Option pour trier du plus récent -->
        <option value="ASC">Du plus ancien au plus récent</option> <!-- Option pour trier du plus ancien -->
    </select>
</div>

<div id="photo-container"> <!-- Conteneur pour afficher les photos -->
    <?php include get_template_directory() . '/template-parts/photo_block.php'; ?> <!-- Inclut le fichier de bloc photo -->
</div>

<?php
get_footer(); // Inclut le pied de page du site
?>