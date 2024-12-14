# Nathalie-Mota
# Projet WordPress - Thème Photographe pour Nathalie Mota

## Description du Projet
Ce projet consiste en un thème WordPress personnalisé pour le site de Nathalie Mota, un photographe. Le thème inclut des fonctionnalités telles qu'une galerie d'images, des modales pour afficher des photos, et un menu responsive.

## Étapes pour Ajouter le Thème Personnalisé

1. **Télécharger le Thème**
   - Clonez ou téléchargez le dépôt contenant le thème.

2. **Installation du Thème**
   - Placez le dossier du thème dans le répertoire `wp-content/themes/` de votre installation WordPress.

3. **Activation du Thème**
   - Connectez-vous à votre tableau de bord WordPress.
   - Allez dans **Apparence > Thèmes**.
   - Trouvez le thème "Photographe" et cliquez sur **Activer**.

4. **Configuration des Menus**
   - Allez dans **Apparence > Menus** pour configurer les menus principaux et secondaires.

5. **Ajout de Contenu**
   - Créez des publications et des pages pour remplir votre site avec du contenu.

## Structure des Fichiers

- **style.css** : Fichier principal de style du thème, contenant les styles globaux et les styles spécifiques pour les éléments du site.
- **single.php** : Modèle de page pour afficher une seule publication.
- **single-photographie.php** : Modèle de page spécifique pour afficher une photo unique, avec des informations et des options de navigation.
- **index.php** : Modèle principal du thème, utilisé pour afficher les publications lorsque rien d'autre ne correspond.
- **home.php** : Modèle de page d'accueil, affichant les photos et les filtres.
- **header.php** : Contient l'en-tête du site, y compris le logo et le menu de navigation.
- **functions.php** : Fichier crucial pour le thème, où sont enregistrés les styles, les scripts, et les menus personnalisés.
- **footer.php** : Contient le pied de page du site, y compris les informations de copyright et les liens vers les menus.
- **templates/template-post.php** : Modèle de publication personnalisé pour afficher des publications spécifiques.
- **template-parts/photo_block.php** : Fichier de modèle réutilisable pour afficher des blocs de photos dans différentes sections du site.

## Utilité de jQuery

jQuery est une bibliothèque JavaScript qui simplifie la manipulation du DOM, la gestion des événements, et les requêtes AJAX. Dans ce projet, jQuery est utilisé pour :

- Gérer les interactions avec le menu mobile (ouverture et fermeture).
- Afficher et masquer les modales pour les photos.
- Améliorer l'expérience utilisateur en rendant les éléments interactifs plus fluides.

## Organisation du Fichier functions.php

Le fichier `functions.php` est bien organisé pour faciliter la gestion des fonctionnalités du thème :

- **Enqueue des Styles et Scripts** : Utilisation de `wp_enqueue_style` et `wp_enqueue_script` pour charger les fichiers CSS et JavaScript de manière ordonnée, évitant ainsi les conflits.
- **Enregistrement des Menus** : Enregistrement des menus personnalisés pour une navigation facile.
- **Fonctions Personnalisées** : Création de fonctions pour charger des articles, gérer les requêtes AJAX, et d'autres fonctionnalités spécifiques au projet.

### Exemple de Code dans functions.php

```php
function theme_enqueue_styles() {
wp_enqueue_style('theme', get_template_directory_uri() . '/css/theme.css');
wp_enqueue_style('single-photo', get_template_directory_uri() . '/css/single-photo.css');
wp_enqueue_script('header-scripts', get_template_directory_uri() . '/js/header-scripts.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function register_custom_menus() {
register_nav_menus(array(
'menu_principal' => ('Menu principal', 'Photographe'),
'menu_secondaire' => ('Menu secondaire', 'Photographe'),
));
}
add_action('init', 'register_custom_menus');
```


## Conclusion

Ce projet démontre la capacité à créer un thème WordPress personnalisé, en utilisant des pratiques de développement modernes et en intégrant des fonctionnalités interactives. Le thème est conçu pour être responsive et convivial, offrant une expérience utilisateur agréable pour les visiteurs du site de Nathalie Mota.-
