from json import *



with open ('profile.json' , "r") as fichier:
    chaine = fichier.read()

profile = loads(chaine)



with open("insert_identifiant.sql" , "w") as fichier :
    i = 0 
    while i<50: 
        key = str(i)
        email = profile[key]["email"].lower()
        password = profile[key]["mot_de_passe"]
        insert = "INSERT INTO identifiant (password,email) VALUES ( '" +password+ "','"+email+"');"+"\n"
        fichier.write(insert)
        i+=1



        
