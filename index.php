<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Application prévention agressions</title>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<link rel="stylesheet" href="style.css"/>

</head>

<body>

<!-- HEADER -->

<header>

<div class="logo"><img src="e19ebf189256555.Y3JvcCwzMzQwLDI2MTMsNDksMA-removebg-preview.png"></div>

<nav>
<a href="#accueil">Accueil</a>
<a href="#analyse">Sécurise toi</a>
<a href="#contact">Contactez nous</a>
<a href="#">Connexion</a>
</nav>

</header>


<!-- SECTION 1 -->

<section id="accueil">

<div class="hero">

<div class="hero-text">

<h1>Réduis le risque d'agression</h1>

<p>
Analyse ton environnement, ta localisation et ton déplacement afin d'évaluer
ton niveau de sécurité dans la ville d'Abidjan.
</p>

</div>

<img src="télécharger-removebg-preview.png">

</div>

</section>



<!-- SECTION 2 -->

<section id="analyse">

<h2 style="margin-bottom:20px">Analyse du risque</h2>

<div class="container">

<form method="POST" action="save_data.php">

<label>Commune</label>

<select id="commune" name="commune" required>
<option value="">Choisir</option>
<option>Cocody</option>
<option>Yopougon</option>
<option>Abobo</option>
<option>Adjamé</option>
<option>Marcory</option>
<option>Koumassi</option>
<option>Plateau</option>
<option>Port-Bouët</option>
<option>Anyama</option>
<option>Attécoubé</option>
<option>Songon</option>
<option>Bingerville</option>
<option>Treichville</option>
</select>

<label>Quartier</label>

<input list="quartiers" name="quartier" required>

<datalist id="quartiers">

<option value="Angré">
<option value="Riviera">
<option value="Deux Plateaux">
<option value="Abobo Baoulé">
<option value="Niangon">
<option value="Gesco">
<option value="Anono">
<option value="Zone 4">
<option value="Biétry">
<option value="Vridi">
<option value="Port-Bouet centre">

</datalist>

<label>Latitude</label>
<input type="number" step="0.0001" id="latitude" name="latitude">

<label>Longitude</label>
<input type="number" step="0.0001" id="longitude" name="longitude">

<label>Age</label>
<input type="number" name="age">

<label>Genre</label>
<select name="genre">
<option>Femme</option>
<option>Homme</option>
</select>

<label>Heure</label>
<input type="number" name="heure">

<label>Jour</label>
<select name="jour">
<option value="Lundi">Lundi</option>
<option value="Mardi">Mardi</option>
<option value="Mercredi">Mercredi</option>
<option value="Jeudi">Jeudi</option>
<option value="Vendredi">Vendredi</option>
<option value="Samedi">Samedi</option>
<option value="Dimanche">Dimanche</option>
</select>

<label>Mode de déplacement</label>
<select name="mode_deplacement">
<option value="A pied">A pied</option>
<option value="Moto">Moto</option>
<option value="Voiture">Voiture</option>
<option value="Bus">Bus</option>
<option value="Taxi">Taxi</option>
</select>

<label>Eclairage</label>
<select name="eclairage">
<option value="Bon">Bon</option>
<option value="Moyen">Moyen</option>
<option value="Faible">Faible</option>
<option value="Aucun">Aucun</option>
</select>

<label>Présence pluie</label>
<select name="presence_pluie">
<option value="Oui">Oui</option>
<option value="Non">Non</option>
</select>

<label>Je suis seule</label>
<select name="je_suis_seule">
<option>oui</option>
<option>non</option>
</select>

<button type="submit">Analyser le risque</button>

</form>

<div id="map"></div>

</div>

</section>



<!-- SECTION 3 -->

<section id="contact">

<h2>Contactez nous</h2>

<div class="footer-container">

<div class="footer-col">

<h3>A propos</h3>
<hr>
<br>

<p class="apropo">
Application intelligente permettant d'évaluer le niveau de risque
d'agression dans la ville d'Abidjan grâce aux données environnementales.
<br>
<br>
Je m’appelle <strong>Yoh Bi Nene</strong>, Étudiant en informatique(IDA), passionné par le développement d’applications et la
Gestion de Bases de Données. J'ai un peu d'expérience pratique en développement
Web ( Back-end) surtout avec Php/MySQL. Sérieux, rigoureux et doté d’un bon esprit
d’analyse, je souhaite avoir plus experiences encore si vous m'accordez cette formation...<br>
            Cette application a été réalisée en PHP/MySQL dans le cadre d’un projet de Simplon.

</p>

</div>


<div class="footer-col">

<h3>Contact</h3>

<p class="apropo">Email : bibahboris@gmail.com</p>
<p class="apropo">Tel : +225 07 10 01 53 89</p>

</div>


<div class="footer-col">

<h3>Suivez nous</h3>

<div class="social">

<img src="https://cdn-icons-png.flaticon.com/512/733/733547.png">
<img src="https://cdn-icons-png.flaticon.com/512/733/733585.png">
<img src="https://cdn-icons-png.flaticon.com/512/733/733558.png">

</div>

</div>

</div>

</section>



<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>

/* CARTE */

var map = L.map('map').setView([5.360,-4.000],11);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
attribution:'OpenStreetMap'
}).addTo(map);


/* COMMUNES */

var communes = {

"Cocody":[5.400,-3.980],
"Yopougon":[5.350,-4.080],
"Abobo":[5.430,-4.010],
"Adjamé":[5.370,-4.020],
"Marcory":[5.290,-3.970],
"Koumassi":[5.255,-3.960],
"Plateau":[5.320,-4.010],
"Port-Bouët":[5.250,-3.950],
"Anyama":[5.500,-4.050],
"Attécoubé":[5.330,-4.040],
"Songon":[5.420,-4.200],
"Bingerville":[5.350,-3.900],
"Treichville":[5.290,-4.000]

};

for (var commune in communes) {

var lat = communes[commune][0];
var lon = communes[commune][1];

L.marker([lat, lon])
.addTo(map)
.bindPopup("Commune : " + commune);

}

var marker;

document.getElementById("commune").addEventListener("change",function(){

var commune=this.value;

if(communes[commune]){

var lat=communes[commune][0];
var lon=communes[commune][1];

map.setView([lat,lon],13);

document.getElementById("latitude").value=lat;
document.getElementById("longitude").value=lon;

if(marker){
map.removeLayer(marker);
}

marker=L.marker([lat,lon]).addTo(map);

}

});

</script>

</body>
</html>