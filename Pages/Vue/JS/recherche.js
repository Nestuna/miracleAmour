$(document).ready(function() {

    // Progress Bar - Selection Age
    const $valueSpan = $('.valueSpan');
    const $value = $('#customRange1');
    $valueSpan.html($value.val());
    $value.on('input change', () => {
  
      $valueSpan.html($value.val()) ;
    });

    // AJAX
    var controller = './Pages/Controller/test.php';
    $('button').mousedown(function(event) {
        $.post(controller,
          {
            cinema : recupCheckbox('cinema'),
            litte : recupCheckbox('litte'),
            musique: recupCheckbox('musique'),
            sport: recupCheckbox('sport'),
            sexe :$('input[name=infos]:checked').val(),
            age: $('.valueSpan').text()
          },
          function(reponse) {
              $('#profils').html(reponse);
          }
        )
    });


    function recupCheckbox(name) {
      let tab = [];
      for (let i=1; i < 5; i++) {
        let input = $('#col-' + name).find( $('input[name=' + i.toString() + ']'));
        console.log(input);
        if ( input.is(':checked') ) {
          tab.push( input.val() );
        }
      }
      return tab;
    }

  });