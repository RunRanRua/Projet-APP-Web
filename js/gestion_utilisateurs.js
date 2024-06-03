// Add this to your JS file (e.g., inscription-connexion.js or create a new file like gestion_utilisateurs.js)

document.addEventListener('DOMContentLoaded', (event) => {
    const forms = document.querySelectorAll('form');

    forms.forEach(form => {
        form.addEventListener('submit', (e) => {
            const inputs = form.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
            let isValid = true;

            inputs.forEach(input => {
                if (input.value.trim() === '') {
                    input.style.borderColor = 'red';
                    isValid = false;
                } else {
                    input.style.borderColor = '#ddd';
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Veuillez remplir tous les champs.');
            }
        });
    });
});

function confirmDelete(userId) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.")) {
        window.location.href = 'supprimer_utilisateur.php?id=' + userId;
    }
}
