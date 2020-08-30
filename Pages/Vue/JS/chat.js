$(document).ready(function() {
    console.log("Page chargée.");
    
    // VARIABLES GlOBALES
    var $chat = $('#chat'),
        id_usr_exp = "",
        id_usr_dest = "" ,
        controller = "./Pages/Controller/controller_chat.php";  

    //////// PROGRAMME -------------
    init();


    //////// FONCTIONS -------------
    // INIT
    function init(){
        usrList();
        openConversation();
        
    }


    // OUVERTURE CONVERSATION
    function openConversation() {
        $('#usr-list-chat').on('click', '.block-usr', function(event){
            id_usr_dest = $(this).attr('data-user');
           
            lastConversation(id_usr_dest);
            envoi(id_usr_dest);

            minuteur = setInterval(lastMessageSend, 3000);
            console.log("minuteur: " + minuteur);
            
        });
    } 

    function lastMessageSend() {
        let id_message = $('.message').eq(-1).attr('data-id');
        console.log("ID MESSAGE => " + id_message)
        lastMessage(id_usr_dest, id_message);
        console.log("lastMessageSens minuteur:" + minuteur);
    }
    //// AJAX ----------------------
    // DERNIERS MESSAGES DE LA CONVERSATION
    function lastConversation(/* id_usr_exp, */ id_usr_dest /* id_messages */) {
        /*
            Récupère les derniers messages d'une conversation, avec l'id de l'expéditeur
            et l'id du destinataire afin d'identifier la conversation
        */
        $.get(controller,
            {   
                methode: 'lastConversation',
                id_usr_dest: id_usr_dest,
                /* id_messages: id_messages, */
                nb_messages: 20
            },
            function(reponse) {
                console.log(reponse);
                $('#chat').html(reponse);
            }
        );
    }

    // DERNIER MESSAGE
    function lastMessage(/* id_usr_exp, */ id_usr_dest, id_dernier_message) {
        /* 
            Récupère le dernier message de l'utilisateur avec id de l'expéditeur
            et l'id du destinataire afin d'identifier le conversation
        */
        controller = "./Pages/Controller/controller_chat-lastMessage.php";
        $.get(controller,
            {
                methode: "lastMessage",
                // id_usr_exp : id_usr_exp,
                id_usr_dest: id_usr_dest,
                id_dernier_message: id_dernier_message, 
                nb_messages: 1
            },
            function(reponse){
                console.log(reponse);
                console.log("lastMessage refresh");
                $('#chat').append(reponse);
                $('#chat').scrollTop($('#chat')[0].scrollHeight)
                
                
            }
        );
    }

    // USER LIST
    function usrList(){
        /* 
            Récupère la liste des conversations de l'utilisateur courant
        */
        $.get(controller, 
            {
                methode: "usrList",
            },
            function(reponse) {
                $("#usr-list-chat").children().html(reponse)
            }
        );    
    }

    // ENVOI MESSAGE
    function envoi(id_usr_dest) {
        /*
            Envoi un message
        */
       $('#envoyer').click(function(event) {
            event.preventDefault();
            $.post("./Pages/Controller/controller_chat-envoi.php",
                {
                    id_usr_dest : id_usr_dest,
                    message : $('#form-message').val()
                },
                function(reponse) {
                    console.log(reponse);
                    $('#form-message').val("");
                    lastMessage(id_usr_dest);
                }
            );
        
        });
    }

    //// EVENTS

    
});