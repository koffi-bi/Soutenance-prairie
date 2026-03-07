import sys

commune = sys.argv[1]
heure = int(sys.argv[2])
eclairage = sys.argv[3]
pluie = sys.argv[4]
seule = sys.argv[5]

risque = 0

# heure dangereuse
if heure >= 22 or heure <= 4:
    risque += 40

# éclairage
if eclairage == "Faible":
    risque += 30
elif eclairage == "Moyen":
    risque += 15

# pluie
if pluie == "oui":
    risque += 10

# seule
if seule == "oui":
    risque += 20

# niveau de risque
if risque >= 70:
    niveau = "RISQUE ELEVE"
    
elif risque >= 40:
    niveau = "RISQUE MOYEN"
    conseil = "Soyez vigilant."
else:
    niveau = "RISQUE FAIBLE"

print("Commune :", commune)
print("Niveau de risque :", niveau)
print("Pourcentage :", risque, "%")
print("Conseil :", conseil)