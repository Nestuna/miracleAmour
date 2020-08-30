$(document).ready(function(){
    console.log("Page chargée.");   

    
    //AUTOMATISATION DE LA VERIFICATION 
    //verification = function() {
    //     $("input").
    // } 

    // Prenom , nom
    $('#prenom').blur(function(event){
        console.log("Prenom tapé");

        let txt_erreur = "Prenom non valide!",
            erreur = $('#prenom').parent().children().eq(2).text(txt_erreur),
            prenom = $('#prenom').val();
        erreur.toggle(/[^a-zA-Z'-]$/.test(prenom) || prenom === "");

    });
    $('#nom').blur(function(event){
        console.log("Nom tapé");
        let txt_erreur = "Nom non valide!",
            erreur = $('#nom').parent().children().eq(2).text(txt_erreur),
            nom = $('#nom').val();
        erreur.toggle(/[^a-zA-Z'-]$/.test(nom) || nom === ""); 
    });

    // Date de naissance
    $('#date_naissance').blur(function(event){
        console.log("Date de naissance tapé");
        let txt_erreur = "Vous êtes trop jeune, garçon/gamine!",
            erreur = $('#date_naissance').parent().children().eq(2).text(txt_erreur),
            date = new Date ($('#date_naissance').val());
            date = date.getYear();
        let mtn = new Date().getYear(),
            age = mtn - date;
        console.log(date);
        console.log(age);
        erreur.toggle(age <= 18  || date === ""); 
    });

    // Ville
    $('#ville').blur(function(event){
        console.log("ville tapé");

        let txt_erreur = "Ville non valide!",
            erreur = $('#ville').parent().children().eq(2).text(txt_erreur),
            ville = $('#ville').val();
        erreur.toggle(/[^a-zA-Z'-]$/.test(ville)  || ville === ""); 
    });
    // Email
    $('#email').blur(function(event){
        console.log("email tapé");

        let txt_erreur = "Email non valide!",
            erreur = $('#email').parent().children().eq(2).text(txt_erreur),
            email = $('#email').val();
        erreur.toggle(/^[a-z0-9\-_\.]+@[a-z0-9]+\.[a-z]{2,5}$/.test(email) == false
            || email === ""); 
    });
    $('#email-confirm').blur(function(event){
        console.log("email-confirm tapé");

        let txt_erreur = "Les adresses mail ne sont pas similaires!",
            erreur = $('#email-confirm').parent().children().eq(2).text(txt_erreur),
            email = $('#email').val(),
            email_confirm = $('#email-confirm').val();
        erreur.toggle(email_confirm !== email  || email_confirm === ""); 
    });

    // Mot de Passe
    $('#pwd').blur(function(event){
        console.log("pwd tapé");

        let txt_erreur = "Mot de passe non valide! (au moins 6 caractères)",
            erreur = $('#pwd').parent().children().eq(2).text(txt_erreur),
            pwd = $('#pwd').val();
        erreur.toggle(pwd.length < 6  || pwd === ""); 
    });
    $('#pwd-confirm').blur(function(event){
        console.log("pwd-confirm tapé");

        let txt_erreur = "Les mots de passe ne sont pas similaires!",
            erreur = $('#pwd-confirm').parent().children().eq(2).text(txt_erreur),
            pwd = $('#pwd').val(),
            pwd_confirm = $('#pwd-confirm').val();
        erreur.toggle(pwd !== pwd_confirm  || pwd_confirm === "" ); 
    });
    
    // Verication de tous les champs remplis
    $('form').submit(function(event) {
        if ($('.erreur:visible').length > 0) {
            event.preventDefault();
            alert("Merci de bien remplir le formulaire.");
        }
    });
});