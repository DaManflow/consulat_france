document.addEventListener("DOMContentLoaded", function () {
    // Fonction pour afficher/masquer le mot de passe
    function togglePasswordVisibility(inputId, eyeIconId) {
        const input = document.getElementById(inputId);
        const eyeIcon = document.getElementById(eyeIconId);
        
        eyeIcon.addEventListener('click', function() {
            if (input.type === "password") {
                input.type = "text";
                eyeIcon.src = "https://img.icons8.com/ios-filled/50/000000/visible.png";  // Changer l'icône en "œil ouvert"
            } else {
                input.type = "password";
                eyeIcon.src = "https://img.icons8.com/ios-filled/50/000000/invisible.png";  // Changer l'icône en "œil fermé"
            }
        });
    }

    // Ajouter des écouteurs d'événements pour les champs de mot de passe
    togglePasswordVisibility('motdepasse', 'eye-icon-motdepasse');
    togglePasswordVisibility('motdepasse2', 'eye-icon-motdepasse2');

    // Fonction pour vérifier si le formulaire est valide
    function checkFormValidity() {
        const nom = document.getElementById('nom').value;
        const prenom = document.getElementById('prenom').value;
        const email = document.getElementById('email').value;
        const email2 = document.getElementById('email2').value;
        const motdepasse = document.getElementById('motdepasse').value;
        const motdepasse2 = document.getElementById('motdepasse2').value;

        const boutonValider = document.querySelector('button[type="submit"]');

        // Vérifier si tous les champs sont correctement remplis
        const isFormValid = (
            nom.length >= 2 && /^[A-Za-z]+(-[A-Za-z]+)*$/.test(nom) &&
            prenom.length >= 3 && /^[A-Za-z]+(-[A-Za-z]+)*$/.test(prenom) &&
            /^[a-zA-Z0-9!#$%&'*+/=?^_`{|}~.-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,}$/.test(email) &&
            email === email2 &&
            motdepasse.length >= 8 && motdepasse.length <= 12 &&
            /[A-Z]/.test(motdepasse) &&
            /[a-z]/.test(motdepasse) &&
            /[\W_]/.test(motdepasse) &&
            /\d/.test(motdepasse) &&
            motdepasse === motdepasse2
        );

        // Activer ou désactiver le bouton en fonction de la validité du formulaire
        if (isFormValid) {
            boutonValider.disabled = false;
            boutonValider.classList.remove('disabled');
        } else {
            boutonValider.disabled = true;
            boutonValider.classList.add('disabled');
        }
    }

    // Écouteurs pour vérifier la validité des champs en temps réel
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', checkFormValidity);
    });

    // Initialisation de l'état du bouton lors du chargement de la page
    checkFormValidity();
});
