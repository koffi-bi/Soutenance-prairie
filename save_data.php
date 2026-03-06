<?php

$conn = new mysqli("localhost", "root", "", "aggression_db");

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

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

    // appel du script python
    $commande = "\"C:\\Users\\Nene(Jesus)\\AppData\\Local\\Programs\\Python\\Python313\\python.exe\" C:\\wamp64\\www\\Soutenance_prairie\\calcul_risque.py \"$commune\" \"$heure\" \"$eclairage\" \"$presence_pluie\" \"$je_suis_seule\"";

    $resultat_python = shell_exec($commande); // <-- assigner ici

} else {

    $resultat_python = "Erreur : " . $conn->error;

}

$conn->close();

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Résultat Analyse</title>

<style>
body{
font-family:Arial;
background:#f0f9ff;
text-align:center;
padding:40px;
}

.result{
background:white;
padding:30px;
border-radius:10px;
width:500px;
margin:auto;
box-shadow:0px 5px 15px rgba(0,0,0,0.2);
}

button{
padding:10px 20px;
background:#007bff;
color:white;
border:none;
border-radius:5px;
cursor:pointer;
margin-top:20px;
}
</style>

</head>

<body>

<div class="result">

<h2>Résultat de l'analyse</h2>

<pre>
<?php echo htmlspecialchars($resultat_python); // sécurise l'affichage ?>
</pre>

<a href="index.php">
<button>Retour au formulaire</button>
</a>

</div>

</body>
</html>