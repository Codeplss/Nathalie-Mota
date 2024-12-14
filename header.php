<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"> <!-- Définit le jeu de caractères pour le site -->
	<link rel="profile" href="https://gmpg.org/xfn/11"> <!-- Lien vers le profil XFN -->
	<?php wp_head(); ?> <!-- Appelle wp_head() pour inclure les scripts et styles nécessaires -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet"> <!-- Lien vers la police Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,500;1,400;1,500&display=swap" rel="stylesheet"> <!-- Lien vers la police Space Mono -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Inclusion de jQuery -->
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;,"> <!-- Définition de l'icône du site -->
	<title>Mota Photos</title> <!-- Titre de la page -->
</head>

<body>
<header>
<?php include get_template_directory() . '/template-parts/contact-modal.php'; ?> <!-- Inclut le modal de contact -->

<!-- Logo en dehors du menu -->
<div class="logo-container">
	<a href="<?php echo home_url(); ?>">  
		<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Logo <?php echo bloginfo('name'); ?>"> <!-- Affiche le logo du site -->
	</a>
</div>

<!-- Bouton | Menu Mobile -->
<div class="mobile-menu-button" id="open-fullscreen-menu-button">
	<span class="bar"></span> <!-- Première barre du menu burger -->
	<span class="bar"></span> <!-- Deuxième barre du menu burger -->
	<span class="bar"></span> <!-- Troisième barre du menu burger -->
</div>

<nav class="header-menu">
<div class="close-button-container">
<a href="<?php echo home_url(); ?>">  
<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Logo <?php echo bloginfo('name'); ?>"> <!-- Affiche le logo dans le menu -->
</a>
               </div>
                <button id="close-fullscreen-menu-button" class="close-button">X</button> <!-- Bouton pour fermer le menu -->
              </div>
<?php
                    wp_nav_menu(array( // Affiche le menu principal
                        'theme_location' => 'menu_principal',
                        'container' => false,
                        'menu_class' => 'header-menu',
                    ));
                ?>
 
</nav>	
	
</header>