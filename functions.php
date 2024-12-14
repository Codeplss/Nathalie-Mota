<?php
// Chargement du style CSS et des scripts
function theme_enqueue_styles()
{
    wp_enqueue_style('theme', get_template_directory_uri() . '/css/theme.css'); // Charge le style principal
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css'); // Charge le style général
    wp_enqueue_style('home', get_template_directory_uri() . '/css/home.css'); // Charge le style de la page d'accueil
    wp_enqueue_style('photo-block', get_template_directory_uri() . '/css/photo-block.css'); // Charge le style du bloc photo
    wp_enqueue_style('single-photo', get_template_directory_uri() . '/css/single-photo.css'); // Charge le style de la photo unique
    wp_enqueue_style('lightbox-single-photo', get_template_directory_uri() . '/css/lightbox-single-photo.css', array(), '1.0', 'all'); // Charge le style de la lightbox
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css', array(), null); // Charge Font Awesome pour les icônes
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles'); // Ajoute la fonction d'enqueue des styles à l'action wp_enqueue_scripts

// Ajout - Scripts (Modales Accueil - Page Photo Unique - Menu Burger)
function enqueue_custom_scripts() {
    wp_enqueue_script('header-scripts', get_template_directory_uri() . '/js/header-scripts.js', array('jquery'), '1.1.1', true); // Charge les scripts d'en-tête
    wp_enqueue_script('modal-scripts-index', get_template_directory_uri() . '/js/modal-scripts-index.js', array('jquery'), '1.0', true); // Charge les scripts de modal pour l'index
    wp_enqueue_script('modal-scripts-photo', get_template_directory_uri() . '/js/modal-scripts-photo.js', array('jquery'), '1.0', true); // Charge les scripts de modal pour la photo
    wp_enqueue_script('lightbox-single-photo', get_template_directory_uri() . '/js/lightbox-single-photo.js', array('jquery'), '1.0', true); // Charge les scripts de lightbox pour la photo unique
    wp_enqueue_script('custom-select', get_template_directory_uri() . '/js/custom-select.js', array('jquery'), '1.0', true); // Charge les scripts pour le sélecteur personnalisé
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts'); // Ajoute la fonction d'enqueue des scripts à l'action wp_enqueue_scripts

function register_custom_menus() {
    register_nav_menus(array( // Enregistre les menus personnalisés
        'menu_principal' => __('Menu principal', 'Photographe'), // Menu principal
        'menu_secondaire' => __('Menu secondaire', 'Photographe'), // Menu secondaire
    ));
}

add_action('init', 'register_custom_menus'); // Ajoute la fonction d'enregistrement des menus à l'action init

// Ajout du fichier JavaScript (Pagination infinie - Bloc Photo)
function enqueue_infinite_pagination_js() {
    wp_enqueue_script('infinite-pagination', get_template_directory_uri() . '/js/infinite-pagination.js', array('jquery'), ''); // Charge le script de pagination infinie
    wp_localize_script('infinite-pagination', 'wp_data', array('ajax_url' => admin_url('admin-ajax.php'))); // Localise le script pour utiliser l'URL AJAX
}

add_action('wp_enqueue_scripts', 'enqueue_infinite_pagination_js'); // Ajoute la fonction d'enqueue de pagination infinie à l'action wp_enqueue_scripts

// Créer une fonction pour charger des articles - Photo
function load_more_posts() {
    $page = $_GET['page']; // Récupère le numéro de page à charger à partir de la requête GET

    $args_custom_posts = array(
        'post_type' => 'photographie', // Type de publication personnalisée à charger
        'posts_per_page' => 5, // Nombre de publications à afficher par page
        'paged' => $page, // Spécifie la page actuelle à charger
    );

    // Vérification des paramètres de catégorie et de format dans la requête GET
    if( 
        $_GET['category'] != NULL && 
        $_GET['category'] != 'ALL' &&
        $_GET['format'] != NULL &&
        $_GET['format'] != 'ALL'
    ){
        // Si à la fois la catégorie et le format sont spécifiés, nous créons une requête complexe (opérateur logique "ET")
        $args_custom_posts['tax_query'] = array(
            'relation' => 'AND', // Opérateur logique "ET" pour s'assurer que les deux requêtes sont satisfaites
            array(
                'taxonomy' => 'categorie',
                'field'    => 'slug',
                'terms'    => $_GET['category']
            ),
            array(
                'taxonomy' => 'format',
                'field'    => 'slug',
                'terms'    => $_GET['format']
            )
        );
    }else{
        // Si seule la catégorie est spécifiée
        if( 
            $_GET['category'] != NULL && 
            $_GET['category'] != 'ALL'
        ){
            // Crée une requête pour filtrer par catégorie
            $args_custom_posts['tax_query'] = array(
                array(
                    'taxonomy' => 'categorie',
                    'field'    => 'slug',
                    'terms'    => $_GET['category']
                )
            );
        }
        // Si seul le format est spécifié
        if(
            $_GET['format'] != NULL &&
            $_GET['format'] != 'ALL' 
        ){
            // Crée une requête pour filtrer par format
            $args_custom_posts['tax_query'] = array(
                array(
                    'taxonomy' => 'format',
                    'field'    => 'slug',
                    'terms'    => $_GET['format']
                )
            );
        }
    }
    $args_custom_posts['orderby'] = 'date'; // Trie les publications par date
    $args_custom_posts['order'] = $_GET['dateSort'] != 'ALL' ? $_GET['dateSort'] : 'DESC'; // Ordonne par ordre descendant si le tri par date est spécifié
    $args_custom_posts['paged'] = $page; // Gère la pagination en fonction du numéro de page

    $custom_posts_query = new WP_Query($args_custom_posts); // Effectue une requête WordPress pour obtenir les publications personnalisées

    if ($custom_posts_query->have_posts()) {
        while ($custom_posts_query->have_posts()) :
            $custom_posts_query->the_post();
             // Contenu | Article - Même format que dans "photo-block.php"
            ?>
            <div class="custom-post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="thumbnail-wrapper">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail(); ?>
                                <!-- Section | Overlay Catalogue -->
                                <div class="thumbnail-overlay">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/icon_eye.png" alt="Icône de l'œil"> <!-- Icône de l'œil | Information Photo -->
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/Icon_fullscreen.png" alt="Icône plein écran" class="fullscreen-icon">
                                    <?php
                                    // Récupère la référence et la catégorie de l'image associée
                                    $related_reference_photo = get_field('reference');
                                    $related_categories = get_the_terms(get_the_ID(), 'categorie');
                                    $related_category_names = array();

                                    if ($related_categories) {
                                        foreach ($related_categories as $category) {
                                            $related_category_names[] = esc_html($category->name);
                                        }
                                    }
                                    ?>
                                    <div class="photo-info">
                                        <div class="photo-info-left">
                                            <p><?php echo esc_html($related_reference_photo); ?></p>
                                        </div>
                                        <div class="photo-info-right">
                                            <p><?php echo implode(', ', $related_category_names); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                </a>
            </div>
        <?php
            // Fin de la structure du contenu de l'article
        endwhile;
        wp_reset_postdata(); // Réinitialise les données des publications personnalisées
    } else {
        // Si aucune publication n'est trouvée, vous pouvez afficher un message ou un contenu alternatif ici.
    }
    die();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts'); // Associe la fonction 'load_more_posts' à l'action AJAX 'wp_ajax_load_more_posts'
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts'); // Associe la fonction 'load_more_posts' à l'action AJAX 'wp_ajax_nopriv_load_more_posts'
