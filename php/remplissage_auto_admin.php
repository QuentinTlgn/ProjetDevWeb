<?php
// Inclure la connexion à la base de données
include('db.php');

// Récupérer les informations de contact
$sql = "SELECT * FROM contacts";
$stmt = $pdo->query($sql);
$contacts = $stmt->fetchAll(PDO::FETCH_KEY_PAIR); // Récupère les contacts sous forme de tableau clé => valeur
?>

<script>
    // Pré-remplir les champs du formulaire avec les informations actuelles
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('editAdresse').value = "<?php echo $contacts['adresse']; ?>";
        document.getElementById('editNom').value = "<?php echo $contacts['nom']; ?>";
        document.getElementById('editMail').value = "<?php echo $contacts['mail']; ?>";
        document.getElementById('editTelephone').value = "<?php echo $contacts['telephone']; ?>";
    });

    const deleteButtons = document.querySelectorAll('.delete-btn');

deleteButtons.forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.dataset.id;

        // Rediriger vers un script PHP pour supprimer le produit
        window.location.href = `../php/supprimer_produit.php?id=${productId}`;
    });
});
</script>