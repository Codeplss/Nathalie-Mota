jQuery(document).ready(function($) {
    // Fonction pour créer un sélecteur personnalisé
    function createCustomSelect() {
        // Sélectionne les éléments de sélecteur avec les ID spécifiés
        const selects = document.querySelectorAll('#category-filter, #format-filter, #date-sort');
        
        // Boucle à travers chaque sélecteur trouvé
        selects.forEach(select => {
            // Crée un conteneur pour le sélecteur personnalisé
            const wrapper = document.createElement('div');
            wrapper.className = 'custom-select-container'; // Définit la classe du conteneur
            select.parentNode.insertBefore(wrapper, select); // Insère le conteneur avant le sélecteur d'origine
            wrapper.appendChild(select); // Déplace le sélecteur d'origine dans le conteneur

            // Crée un élément pour afficher la sélection actuelle
            const selectedDiv = document.createElement('div');
            selectedDiv.className = 'select-selected'; // Définit la classe pour l'élément sélectionné
            selectedDiv.textContent = select.options[select.selectedIndex].text; // Affiche le texte de l'option sélectionnée
            
            // Crée une liste pour les options
            const optionsDiv = document.createElement('div');
            optionsDiv.className = 'select-items select-hide'; // Définit la classe pour la liste des options et la cache

            // Boucle à travers les options du sélecteur
            for (let i = 0; i < select.options.length; i++) {
                // Crée un élément pour chaque option
                const optionDiv = document.createElement('div');
                optionDiv.textContent = select.options[i].text; // Définit le texte de l'option

                // Ajoute un événement au clic pour chaque option
                optionDiv.addEventListener('click', function() {
                    select.selectedIndex = i; // Met à jour l'index sélectionné du sélecteur d'origine
                    selectedDiv.textContent = this.textContent; // Met à jour le texte affiché
                    optionsDiv.classList.add('select-hide'); // Cache la liste des options
                    select.dispatchEvent(new Event('change')); // Déclenche un événement de changement sur le sélecteur
                });

                // Ajoute l'option à la liste
                optionsDiv.appendChild(optionDiv);
            }

            // Ajoute l'élément sélectionné et la liste des options au conteneur
            wrapper.appendChild(selectedDiv);
            wrapper.appendChild(optionsDiv);

            // Ajoute un événement au clic sur l'élément sélectionné
            selectedDiv.addEventListener('click', function(e) {
                e.stopPropagation(); // Empêche la propagation de l'événement
                closeAllSelect(this); // Ferme tous les autres sélecteurs ouverts
                this.nextSibling.classList.toggle('select-hide'); // Affiche ou cache la liste des options
                this.classList.toggle('select-arrow-active'); // Change l'état de l'icône de flèche
            });
        });

        // Fonction pour fermer tous les sélecteurs ouverts
        function closeAllSelect(elmnt) {
            const items = document.getElementsByClassName('select-items'); // Récupère tous les éléments de la liste
            const selected = document.getElementsByClassName('select-selected'); // Récupère tous les éléments sélectionnés
            for (let i = 0; i < selected.length; i++) {
                if (elmnt != selected[i]) {
                    selected[i].classList.remove('select-arrow-active'); // Retire l'état actif de la flèche
                }
            }
            for (let i = 0; i < items.length; i++) {
                if (elmnt != items[i]) {
                    items[i].classList.add('select-hide'); // Cache les listes des options
                }
            }
        }

        // Ajoute un événement au document pour fermer les sélecteurs
        document.addEventListener('click', closeAllSelect);
    }

    // Appelle la fonction pour initialiser les sélecteurs personnalisés
    createCustomSelect();
});