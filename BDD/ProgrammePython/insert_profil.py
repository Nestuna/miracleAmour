from json import *



with open ('BDD_profil.json' , "r") as fichier:
    chaine = fichier.read()

profil = loads(chaine)


with open("insert_profil.sql" , "w") as fichier :
    i = 1
    while i<100:
        key = str(i)
        id_usr = str(int(profil[key]["id_usr"])+1)
        prenom = profil[key]["prenom"].lower()
        nom = profil[key]["nom"].lower()
        sexe = profil[key]["sexe"].lower()
        orientation_sexe = profil[key]["orientation sexe"].lower()
        date_naissance = profil[key]["date de naissance"].lower()
        ville = profil[key]["ville"].lower()
        descritpion = profil[key]["description"]
        insert = "INSERT INTO profile_indiv (id_usr,prenom,nom,sexe,orientation_sexe,date_naissance,ville,description) VALUES ('" +id_usr+ "','" +prenom+ "','"+nom+"','"+sexe+"','"+orientation_sexe+"','"+date_naissance+"','"+ville+"','"+descritpion+"');"+"\n"
        fichier.write(insert)
        i+=1
