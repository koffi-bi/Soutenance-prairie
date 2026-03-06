<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire Risque d'Agression</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        body { font-family: Arial, sans-serif; background-color: rgb(240, 252, 252);}
        #map { height: 400px; margin-top: 20px; }
        form { max-width: 600px; margin: 20px auto; }
        label { display: block; margin-top: 10px; }
        input, select { width: 100%; padding: 5px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px; width: 100%; background-color: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Reduire mon risque d'aggression</h2>

<form id="aggressionForm" method="POST" action="save_data.php">
    <label>Commune :</label>
    <select id="commune" name="commune" required>
        <option value="">--Choisir--</option>
        <option value="Cocody">Cocody</option>
        <option value="Yopougon">Yopougon</option>
        <option value="Abobo">Abobo</option>
        <option value="Adjamé">Adjamé</option>
        <option value="Marcory">Marcory</option>
        <option value="Koumassi">Koumassi</option>
        <option value="Treichville">Treichville</option>
    </select>

    <label>Quartier :</label>
    <input type="text" name="quartier" required>

    <label>Latitude :</label>
    <input type="number" step="0.0001" name="latitude" id="latitude" required>

    <label>Longitude :</label>
    <input type="number" step="-0.0001" name="longitude" id="longitude" required>

    <label>Age :</label>
    <input type="number" name="age" required>

    <label>Genre :</label>
    <select name="genre" required>
        <option value="">--Choisir--</option>
        <option value="Femme">Femme</option>
        <option value="Homme">Homme</option>
    </select>

    <label>Heure :</label>
    <input type="number" name="heure" min="0" max="23" required>

    <label>Jour :</label>
    <select name="jour" required>
        <option value="">--Choisir--</option>
        <option>Lundi</option><option>Mardi</option><option>Mercredi</option>
        <option>Jeudi</option><option>Vendredi</option><option>Samedi</option><option>Dimanche</option>
    </select>

    <label>Mode de déplacement :</label>
    <select name="mode_deplacement" required>
        <option value="">--Choisir--</option>
        <option>A pied</option><option>Taxi</option><option>Moto</option><option>VTC</option><option>Bus</option><option>Voiture</option>
    </select>

    <label>Éclairage :</label>
    <select name="eclairage" required>
        <option value="">--Choisir--</option>
        <option>Faible</option><option>Moyen</option><option>Élevé</option>
    </select>

    <label>Présence de pluie :</label>
    <select name="presence_pluie" required>
        <option value="">--Choisir--</option>
        <option>oui</option><option>non</option>
    </select>

    <label>Je suis seule :</label>
    <select name="je_suis_seule" required>
        <option value="">--Choisir--</option>
        <option>oui</option><option>non</option>
    </select>

    <button type="submit">Envoyer</button>
</form>

<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    // Coordonnées initiales centrées sur Abidjan
    var map = L.map('map').setView([5.360, -4.000], 11);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Quand l'utilisateur choisit une commune
    document.getElementById('commune').addEventListener('change', function() {
        var commune = this.value;
        var coords = {
            "Cocody": [5.400, -3.980],
            "Yopougon": [5.350, -4.080],
            "Abobo": [5.430, -4.010],
            "Adjamé": [5.370, -4.020],
            "Marcory": [5.290, -3.970],
            "Koumassi": [5.255, -3.960],
            "Treichville": [5.275, -3.985]
        };
        if(coords[commune]){
            map.setView(coords[commune], 14); // Zoom sur la commune
            document.getElementById('latitude').value = coords[commune][0];
            document.getElementById('longitude').value = coords[commune][1];
        }
    });
</script>

</body>
</html>