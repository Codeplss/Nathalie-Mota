<?php
/**
 * Modèle de page : Photo unique.
 * Description : Modèle de page pour une photo unique.
 */

// Inclure l'en-tête de la page.
get_header();
?>
<!-- Section | Lightbox Photo -->
<div class='modal-container'>
    <!-- Bouton fermer -->
    <span class="btn-close">X</span> <!-- Bouton pour fermer la modale -->
    <!-- Fleche -->
    <div class="left-arrow"></div> <!-- Flèche gauche pour navigation -->
    <div>
        <!-- Image | Information de la Photo -->
        <img src="" class="middle-image" /> <!-- Image principale de la photo -->
        <div class="info-photo">
            <span id="modal-reference"></span> <!-- Affiche la référence de la photo -->
            <span id="modal-category"></span> <!-- Affiche la catégorie de la photo -->
        </div>
    </div>
    <!-- Fleche -->
    <div class="right-arrow"></div> <!-- Flèche droite pour navigation -->
</div>

<!-- Main - Single Photo -->
<main id="main" class="content-area">
    <div class="zone-contenu mobile-first">
        <!-- Section | Information de la Photo -->
        <div class="left-container">
            <div class="left-contenu">
                <h1><?php the_title(); ?></h1> <!-- Affiche le titre de la photo -->
                <?php
                // Référence de la photo
                // Récupère la valeur du champ personnalisé 'reference_photo' et l'affiche s'il existe.
                $reference_photo = get_field('reference');
                if ($reference_photo) {
                    echo '<p>Référence : <span id="ph-reference">' . esc_html($reference_photo) . '</span></p>'; // Affiche la référence
                }

                // Catégories de la photo
                // Récupère les catégories associées à la photo actuelle.
                $categories = get_the_terms(get_the_ID(), 'categorie');
                $current_category_slugs = array(); // Initialise un tableau vide pour les slugs de catégorie.

                if ($categories) {
                    // Parcourir les catégories et stocker leurs slugs dans le tableau.
                    foreach ($categories as $category) {
                        $current_category_slugs[] = $category->slug; // Ajoute le slug de la catégorie au tableau
                    }
                }

                if ($categories) {
                    // Si des catégories existent, les afficher.
                    echo '<p>Catégorie : <span id="ph-category">';
                    $category_names = array();
                    foreach ($categories as $category) {
                        $category_names[] = esc_html($category->name); // Ajoute le nom de la catégorie au tableau
                    }
                    echo implode(', ', $category_names); // Utilise implode pour joindre les noms de catégorie par une virgule.
                    echo '</span></p>'; // Ferme la balise span
                }

                // Format de la photo
                // Récupère les termes de format associés à la photo actuelle.
                $format_terms = get_the_terms(get_the_ID(), 'format');
                if ($format_terms) {
                    // Si des termes de format existent, les afficher.
                    echo '<p>Format : ';
                    $format_names = array();
                    foreach ($format_terms as $format_term) {
                        $format_names[] = esc_html($format_term->name); // Ajoute le nom du format au tableau
                    }
                    echo implode(', ', $format_names); // Utilise implode pour joindre les noms de format par une virgule.
                    echo '</p>'; // Ferme la balise p
                }

                // Type de la photo
                // Récupère la valeur du champ personnalisé 'type_de_photo' et l'affiche s'il existe.
                $type_de_photo = get_field('type_photos');
                if ($type_de_photo) {
                    echo '<p>Type : ' . esc_html($type_de_photo) . '</p>'; // Affiche le type de photo
                }

                // L'année de capture
                // Récupère l'année de capture et l'affiche si elle existe.
                $date_capture = get_the_date('Y');
                if ($date_capture) {
                    echo '<p>Année : ' . esc_html($date_capture) . '</p>'; // Affiche l'année de capture
                }
                ?>
            </div>
        </div>
        <!-- Section | Photo [data-lightbox="image-gallery"]-->
        <div class="right-container">
            <?php if (has_post_thumbnail()) : ?>
                <a data-href="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'large')[0]; ?>" class="photo"> <!-- Lien vers la photo -->
                    <?php the_post_thumbnail(); ?> <!-- Affiche la miniature de la photo -->
                </a>
            <?php endif; ?>
            
        </div>
    </div>
    <!-- Section | Contact & Navigation Photos -->
    <div class="zone-contact">
        <!-- Section | Contact - Bouton Modal avec reference -->
        <div class="left-contact">
            <div class="texte-contact">
                <p>Cette photo vous intéresse ?</p> <!-- Message incitant à contacter -->
            </div>
            <div class="bouton-contact">
                <?php include get_template_directory() . '/template-parts/contact-modal-photo.php'; ?> <!-- Inclut le fichier de modal de contact -->

                <?php
                // Récupère la valeur du champ personnalisé 'reference' et la définit comme une variable JavaScript.
                $reference_photo = get_field('reference');
                if ($reference_photo) {
                    echo '<script type="text/javascript">'; // Ouvre une balise script
                    echo 'var acfReferencePhoto = "' . esc_js($reference_photo) . '";'; // Définit la variable JavaScript avec la référence
                    echo '</script>'; // Ferme la balise script
                } else {
                    echo '<script type="text/javascript">'; // Ouvre une balise script
                    echo 'var acfReferencePhoto = "";'; // Définit la variable JavaScript vide si aucune référence
                    echo '</script>'; // Ferme la balise script
                    echo '<!-- Aucune valeur trouvée pour le champ "reference" -->'; // Commentaire pour indiquer l'absence de valeur
                }
                ?>
            </div>
        </div>
        <!-- Section | Contact - Navigation de photos - Fleches & Miniature -->
        <div class="right-contact">
            <?php
            // Récupère l'ID de la publication actuelle.
            $current_post_id = get_the_ID();

            // Récupère toutes les publications de type 'photo'.
            $args = array(
                'post_type' => 'photographie', // Type de publication à récupérer
                'posts_per_page' => -1, // Récupère toutes les publications
                'order' => 'ASC', // Ordre croissant
            );
            $all_photo_posts = get_posts($args); // Exécute la requête pour obtenir toutes les photos

            // Trouve l'index de la publication actuelle dans le tableau de toutes les publications de photos.
            $current_post_index = array_search($current_post_id, array_column($all_photo_posts, 'ID')); // Recherche l'index de la photo actuelle

            // Calcule les index des publications précédentes et suivantes.
            $prev_post_index = $current_post_index - 1; // Index de la photo précédente
            $next_post_index = $current_post_index + 1; // Index de la photo suivante

            // Récupère les publications précédentes et suivantes.
            $prev_post = ($prev_post_index >= 0) ? $all_photo_posts[$prev_post_index] : end($all_photo_posts); // Récupère la photo précédente ou la dernière si aucune
            $next_post = ($next_post_index < count($all_photo_posts)) ? $all_photo_posts[$next_post_index] : reset($all_photo_posts); // Récupère la photo suivante ou la première si aucune

            $prev_permalink = get_permalink($prev_post); // Récupère le lien permanent de la photo précédente
            $next_permalink = get_permalink($next_post); // Récupère le lien permanent de la photo suivante

            // Récupère les miniatures des publications précédentes et suivantes.
            $prev_thumbnail = get_the_post_thumbnail($prev_post, 'thumbnail'); // Miniature de la photo précédente
            $next_thumbnail = get_the_post_thumbnail($next_post, 'thumbnail'); // Miniature de la photo suivante
            ?>

            <!-- Conteneur de miniatures individuelles -->
            <div class="thumbnail-container">
                <div class="thumbnail-wrapper">
                    <!-- Initialement, le contenu de la miniature sera vide -->
                </div>
                <a href="<?php echo esc_url($prev_permalink); ?>" class="arrow-link" data-thumbnail="<?php echo esc_url(get_the_post_thumbnail_url($prev_post, 'thumbnail')); ?>" id="prev-arrow-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/fleche-gauche.png" alt="Précédent" class="arrow-img-gauche" id="prev-arrow" /> <!-- Flèche gauche -->
                </a>
                <a href="<?php echo esc_url($next_permalink); ?>" class="arrow-link" data-thumbnail="<?php echo esc_url(get_the_post_thumbnail_url($next_post, 'thumbnail')); ?>" id="next-arrow-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/fleche-droite.png" alt="Suivant" class="arrow-img-droite" id="next-arrow" /> <!-- Flèche droite -->
                </a>
            </div>
        </div>
    </div>

    <!-- Section Photos Apparentées -->
    <div class="related-images">
        <h3>VOUS AIMEREZ AUSSI</h3> <!-- Titre de la section des photos apparentées -->
        <div class="image-container">
            <?php
            // Récupère deux photos aléatoires de la même catégorie que la photo actuelle.
            $args_related_photos = array(
                'post_type' => 'photographie', // Type de publication à récupérer
                'posts_per_page' => 2, // Limite à deux photos
                'orderby' => 'rand', // Ordre aléatoire
                'tax_query' => array(
                    array(
                        'taxonomy' => 'categorie', // Taxonomie à interroger
                        'field' => 'slug', // Champ à utiliser pour la requête
                        'terms' => $current_category_slugs, // Utilise le slug de la catégorie de la photo actuelle
                    ),
                ),
            );

            $related_photos_query = new WP_Query($args_related_photos); // Exécute la requête pour obtenir les photos apparentées

            while ($related_photos_query->have_posts()) :
                $related_photos_query->the_post(); // Prépare la publication pour l'affichage
            ?>
                <div class="related-image">
                    <a href="<?php the_permalink(); ?>"> <!-- Lien vers la photo apparentée -->
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="image-wrapper">
                                <?php the_post_thumbnail(); ?> <!-- Affiche la miniature de la photo -->
                                <!-- Section | Overlay Catalogue -->
                                <div class="thumbnail-overlay-single">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/icon_eye.png" alt="Icône de l'œil"> <!-- Icône de l'œil | Information Photo -->
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/Icon_fullscreen.png" alt="Icône plein écran" class="fullscreen-icon"> <!-- Icône plein écran -->
                                    <?php
                                    // Récupère la référence et la catégorie de l'image associée.
                                    $related_reference_photo = get_field('reference'); // Récupère la référence de la photo
                                    $related_categories = get_the_terms(get_the_ID(), 'categorie'); // Récupère les catégories associées
                                    $related_category_names = array(); // Initialise un tableau vide pour les noms de catégorie

                                    if ($related_categories) {
                                        foreach ($related_categories as $category) {
                                            $related_category_names[] = esc_html($category->name); // Ajoute le nom de la catégorie au tableau
                                        }
                                    }
                                    ?>
                                    <div class="photo-info">
                                        <div class="photo-info-left">
                                            <p><?php echo esc_html($related_reference_photo); ?></p> <!-- Affiche la référence de la photo -->
                                        </div>
                                        <div class="photo-info-right">
                                            <p><?php echo implode(', ', $related_category_names); ?></p> <!-- Affiche les noms de catégorie -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </a>
                </div>
            <?php endwhile; ?>

            <?php wp_reset_postdata(); // Restaure les données originales des publications ?>
        </div>
        <!-- Ajouter un bouton pour la page d'accueil -->
        <div class="home-button">
            <a href="<?php echo home_url(); ?>" class="button">Toutes les photos</a> <!-- Bouton pour accéder à toutes les photos -->
        </div>
    </div>
</main>
<script src="<?php echo get_template_directory_uri(); ?>/js/modal-scripts-photo.js"></script> <!-- Inclut le script pour la modal photo -->

<?php get_footer(); // Inclut le pied de page ?>