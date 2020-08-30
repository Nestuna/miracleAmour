import json
import random 

sexe = ['homme', 'femme']

tab_date_naissance = []

ville = ['Paris', 'Dubai','Brest','Bordeaux','Toulouse','Montpellier','Sevran','Istanbul']

nom = ['Dupont','Martin','Bernard','Thomas','Petit','Robert','Dubois','Durand','Durex','Roche','Bonnet','Girard','Blanc','Rouge','Ricard']

desc = ["Je suis le plus beau des rebeus" , "Alper is the best" , "I LOVE TWIX"]


orientation_sexe = ['homme', 'femme']

tab_prenom = []

with open ("prenoms1.json" , "r") as fichier:
    chaine = fichier.read()

#creation tab prenom 

prenoms = json.loads(chaine)
for i  in range(1,len(prenoms)) :
    tab_prenom.append(prenoms[i]["fields"]['prenom'])


#creation tab date naissance

i=0
while i<300 :
    tab_date_naissance.append(str(random.randrange(1960,2002))+"-"+str(random.randrange(1,12))+"-"+str(random.randrange(1,31)))
    i+=1 


#creation du dictionnaire profil 

dico_profil = {}
i=1
while i < 300:
    dico_profil[i] = {
        'id_usr' : str(i),
        'prenom' : tab_prenom[i],
        'nom' : nom[random.randint(0,len(nom)-1)],
        'sexe' : sexe[random.randint(0,1)],
        'orientation sexe': orientation_sexe[random.randint(0,len(orientation_sexe)-1)],
        'date de naissance': tab_date_naissance[i],
        'ville': ville[random.randint(0,len(ville)-1)],
        'description': desc[random.randint(0,len(desc)-1)]
    }
    i+=1
with open ("BDD_profil.json", "x") as fichier:
    json.dump(dico_profil , fichier)