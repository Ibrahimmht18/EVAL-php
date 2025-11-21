<?php
include 'config.php';

$tri = $_GET['tri'] ?? 'nom';
$page = $_GET['page'] ?? 1;
$limite = 10;
$debut = ($page - 1) * $limite;

$validTri = ['nom', 'ville', 'prix', 'proprietaire'];
$tri = in_array($tri, $validTri) ? $tri : 'nom';

$sql = "SELECT * FROM logements ORDER BY $tri LIMIT $debut, $limite";
$stmt = $dbh->query($sql);
$logements = $stmt->fetchAll();

$total = $dbh->query("SELECT COUNT(*) FROM logements")->fetchColumn();
$pages = ceil($total / $limite);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Airbnb Étudiant</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="get">
        <label>Trié par :</label>
        <select name="tri">
            <option value="nom" <?= $tri == 'nom' ? 'selected' : '' ?>>Nom</option>
            <option value="ville" <?= $tri == 'ville' ? 'selected' : '' ?>>Ville</option>
            <option value="prix" <?= $tri == 'prix' ? 'selected' : '' ?>>Prix</option>
            <option value="proprietaire" <?= $tri == 'proprietaire' ? 'selected' : '' ?>>Propriétaire</option>
        </select>
        <button type="submit">Valider</button>
    </form>

    <?php foreach ($logements as $logement): ?>
        <div class="card">
            <img src="<?= htmlspecialchars($logement['image']) ?>" alt="Image">
            <h3><?= htmlspecialchars($logement['nom']) ?></h3>
            <p><?= htmlspecialchars($logement['ville']) ?> · <?= htmlspecialchars($logement['prix']) ?> € / nuit</p>
            <p>⭐ <?= htmlspecialchars($logement['note']) ?> / 5</p>
            <p>👤 <?= htmlspecialchars($logement['proprietaire']) ?></p>
        </div>
    <?php endforeach; ?>

    <div class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <a href="?tri=<?= $tri ?>&page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>

    <a href="ajout.php">Ajouter une annonce</a>
</body>
</html>