<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $ville = $_POST['ville'];
    $prix = $_POST['prix'];
    $note = $_POST['note'];
    $proprietaire = $_POST['proprietaire'];
    $image = $_POST['image'];

    $sql = "INSERT INTO logements (nom, ville, prix, note, proprietaire, image)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$nom, $ville, $prix, $note, $proprietaire, $image]);

    header("Location: index.php");
}
?>

<form method="post">
    <input name="nom" placeholder="Nom" required>
    <input name="ville" placeholder="Ville" required>
    <input name="prix" type="number" placeholder="Prix" required>
    <input name="note" type="number" step="0.01" placeholder="Note" required>
    <input name="proprietaire" placeholder="Propriétaire" required>
    <input name="image" placeholder="URL de l'image" required>
    <button type="submit">Ajouter</button>
</form>