$(document).ready(function() {
    console.log("Page chargée.");

    var buttonYes = $('#buttonYes')

    //Affecte la nouvelle image lorsque la souris survole l'élément
    function passageDeLaSouris(buttonYes) {
        element.setAttribute('src', 'Images/coeur.png');
        }
        //Affecte l'image de départ lorsque la souris ne survole plus l'élément
    function departDeLaSouris(buttonYes) {
    element.setAttribute('src', 'http://www.w3.org/2000/svg');
    }
});