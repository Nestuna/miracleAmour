console.log (" Profil JS Chargé.")
$(function() {
    console.log("Page chargée.");

    // VARIABLES GLOBALES
    var $editable = $('.editable'),
        $crayon = $('.editable-image');

    // INIT
    function init() {
        // recupDataProfil();
        modifierProfil();
        
    }     

    // FONCTIONS
    function modifierProfil() {
        $crayon.click(function() {
            console.log(".editable cliqué");
            $editable = $(this).parent().parent().find('.editable');
            
            modifierImage("show");
            $editable.attr('contenteditable', true);
            $editable.css('border-bottom', '#ccc 1px solid')
            $(this).css('background-image', 'url(./Images/validate.png)');
            $(this).addClass("validate");

            // On reclique sur l'icone pour valider
            $('.validate').click (function(event){
                // envoiProfil();
                $editable.attr('contenteditable', false);
                $editable.css('border-bottom', '')
                $(this).css('background-image', 'url(./Images/editable.png)');
                $(this).removeClass('validate');
                
                modifierImage("hide");
                modifierProfil();
            });
            
    
        });
    }
    function modifierImage (action) {
        if (action === "show") {
            $('.image_overlay').append('<a href="index.php?page=profil-image"><p>Modifier Photo</p></a>');
            $('.image_overlay').fadeIn();
            
        }
        else if (action === "hide") {
            $('.image_overlay').fadeOut();
        }

    }
    function recupModificationProfil() {
        let profil = [];

        let info_usr = $('#info-usr ul li').map(function(){
            let obj = {};
            obj [this.id] = $(this).text();
            return obj;
        }).get(),
            description = {description : $('#texte-description p').text()},
            interets = $('interets col-interets').map(function(){
                let obj = {};
                obj [this.id] = [$(this).find('li').text()];
                return obj;
            });
        profil = info_usr.concat(description, interets);
        return profil;
    }
    function envoiProfil() {
        let profil = recupModificationProfil();
        $.post(controller,
            {
                profil: profil
            },
            function(reponse){
                if (reponse.ok) {
                    popupModifOK();
                }
                else {
                    console.log("Oups la BDD ! :" + reponse);
                }
            } 
        );
    }
    function recupDataProfil() {
        let controller = "./Pages/Controller/controller_profil.php"
        $.get(controller,
            {},
            function (reponse) {
                $('.container').html(reponse);
            }
        ); 
    }


    // PROGRAMME
    init();

    


});