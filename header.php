
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="<?php echo esc_attr( $viewport_content ); ?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<title>Mota Photos</title>
</head>

<body>
<header>


<nav>
<a href="<?php echo home_url(); ?>">  
<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Logo <?php echo bloginfo('name'); ?>">
</a>
<?php
                    wp_nav_menu(array(
                        'theme_location' => 'menu_principal',
                        'container' => false,
                        'menu_class' => 'menu',
                    ));
                ?>
</nav>	
	
</header>





