from random import *
from json import *



with open ("profile_indiv.json" , "r") as fichier:
    chaine = fichier.read()

profil = loads(chaine)




with open("insert_musique.sql" , "w") as fichier :
    i = 0 
    while i<len(profil): 
        id_usr = str(profil[i]["id_usr"])
        id_pref = str(randint(1,4))
        insert = "INSERT INTO identifiant_musique (id_usr,id_musique) VALUES ( '" +id_usr+ "','"+id_pref+"');"+"\n"
        fichier.write(insert)
        i+=1


