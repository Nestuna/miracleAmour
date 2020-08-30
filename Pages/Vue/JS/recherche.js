$(document).ready(function() {

    const $valueSpan = $('.valueSpan');
    const $value = $('#customRange1');
    $valueSpan.html($value.val());
    $value.on('input change', () => {
  
      $valueSpan.html($value.val()) ;
    });
  });