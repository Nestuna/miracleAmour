import json
import random

tab_nom_de_domaine = ['outlook.fr' , 'gmail.com' , 'yahoo.fr' , 'hotmail.fr']
tab_prenom = []
tab_email = []
tab_passwd = []


with open ('prenoms.json' , "r") as fichier:
    chaine = fichier.read()

prenoms = json.loads(chaine)
for i  in range(1,len(prenoms)) :
    tab_prenom.append(prenoms[i]["fields"]['prenom'])

i=0
while i<300 :
    tab_email.append( tab_prenom[i] +"@"+tab_nom_de_domaine[random.randint(0 , len(tab_nom_de_domaine)-1)])
    i+=1



element = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+-*/~$%&.:?!"
passwd = ""
for i in tab_email:
    passwd = ""
    for i in range(8):
        passwd = passwd + element[random.randint(0, len(element) - 1)]
    tab_passwd.append(passwd)


dico_profile = {}
i=0
while i < 300:
    dico_profile[i] = {
        'prenom' : tab_prenom[i],
        'email' : tab_email[i],
        'mot_de_passe': tab_passwd[i]
    }
    i+=1
with open ("profile.json", "x") as fichier:
    json.dump(dico_profile , fichier )
