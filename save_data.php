<?php
$conn = new mysqli("localhost", "root", "", "aggression_db");
if ($conn->connect_error) { die("Connexion échouée : " . $conn->connect_error); }

$commune = $_POST['commune'];
$quartier = $_POST['quartier'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$age = $_POST['age'];
$genre = $_POST['genre'];
$heure = $_POST['heure'];
$jour = $_POST['jour'];
$mode_deplacement = $_POST['mode_deplacement'];
$eclairage = $_POST['eclairage'];
$presence_pluie = $_POST['presence_pluie'];
$je_suis_seule = $_POST['je_suis_seule'];

$sql = "INSERT INTO risques_agression
(commune, quartier, latitude, longitude, age, genre, heure, jour, mode_deplacement, eclairage, presence_pluie, je_suis_seule)
VALUES
('$commune','$quartier','$latitude','$longitude','$age','$genre','$heure','$jour','$mode_deplacement','$eclairage','$presence_pluie','$je_suis_seule')";

$resultat_python = "";

if ($conn->query($sql) === TRUE) {
    $commande = "\"C:\\Users\\Nene(Jesus)\\AppData\\Local\\Programs\\Python\\Python313\\python.exe\" C:\\wamp64\\www\\Soutenance_prairie\\calcul_risque.py \"$commune\" \"$heure\" \"$eclairage\" \"$presence_pluie\" \"$je_suis_seule\"";
    $resultat_python = shell_exec($commande);
} else {
    $resultat_python = "Erreur : " . $conn->error;
}

$conn->close();

// --- Traitement du résultat pour le chart ---
$lines = explode("\n", $resultat_python);
$niveau = $pourcentage = $conseil = "";
foreach ($lines as $line) {
    if (strpos($line, "Niveau de risque") !== false) {
        $niveau = trim(explode(":", $line)[1]);
    } elseif (strpos($line, "Pourcentage") !== false) {
        $pourcentage = (int)trim(str_replace("%","",explode(":", $line)[1]));
    } elseif (strpos($line, "Conseil") !== false) {
        $conseil = trim(explode(":", $line)[1]);
    }
}

// Définir couleur du diagramme et conseils améliorés
if ($niveau == "RISQUE FAIBLE") {
    $couleur_chart = "#28a745"; // vert
    $conseil = "Zone relativement sûre. Continuez à rester attentif(e) à votre environnement.";
} elseif ($niveau == "RISQUE MOYEN") {
    $couleur_chart = "#ffc107"; // orange
    $conseil = "Soyez vigilant(e). Évitez les zones peu éclairées et restez avec d'autres personnes.";
} else { // RISQUE ÉLEVÉ
    $couleur_chart = "#dc3545"; // rouge
    $conseil = "RISQUE ÉLEVÉ ! Évitez de rester seule, privilégiez les taxis sécurisés ou VTC, et informez quelqu'un de votre trajet.";
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Résultat Analyse</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
body{
    font-family:Arial;
    background:#f0f9ff;
    margin:0;
    padding:0;
    background:#9bc3ff;
    
}
.container{
    max-width: 700px;
    margin: 50px auto;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 8px 20px rgba(0,0,0,0.2);
    text-align:center;
}
h2{
    color:#007bff;
    margin-bottom:20px;
}
.pourcentage{
    font-size:36px;
    font-weight:bold;
    margin:15px 0;
    color: <?= $couleur_chart ?>;
}
.conseil{
    margin-top:20px;
    font-size:16px;
    padding:20px;
    border-radius:10px;
    font-weight:bold;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    background: <?= $couleur_chart ?>33;
    color: <?= $couleur_chart ?>;
}
.conseil .icon{
    font-size:22px;
}
button{
    padding:10px 25px;
    background:#007bff;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
    margin-top:25px;
    font-size:16px;
    transition:0.3s;
}
button:hover{
    background:#0056b3;
    transform:translateY(-2px);
}
.chart-container{
    width:200px;
    margin: 0 auto;
}
</style>
</head>
<body>

<div class="container">
<h2>Résultat de l'analyse pour <?= htmlspecialchars($commune) ?></h2>

<div class="pourcentage"><?= $pourcentage ?>%</div>

<div class="chart-container">
    <canvas id="risqueChart"></canvas>
</div>

<div class="conseil">
    <span class="icon">⚠️</span>
    <?= htmlspecialchars($conseil) ?>
</div>

<a href="index.php"><button>Retour au formulaire</button></a>
</div>

<script>
const ctx = document.getElementById('risqueChart').getContext('2d');
const risqueChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Risque', 'Sécurité'],
        datasets: [{
            data: [<?= $pourcentage ?>, <?= 100-$pourcentage ?>],
            backgroundColor: ['<?= $couleur_chart ?>', '#e0e0e0'],
            borderWidth: 1
        }]
    },
    options: {
        cutout: '70%',
        plugins:{
            legend:{ display:false },
            tooltip:{ enabled:true }
        }
    }
});
</script>

</body>
</html>