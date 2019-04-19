(function ($, Drupal) {

  /*Drupal.behaviors.responsiveDetails = {
    attach: function (context) {
      console.log('Could you improve me please?');
    }
  };*/

  $('.jobs-listing .more-info').click(function(){
    $(this).toggleClass('less');
    if ($(this).hasClass('less')) {
      $(this).text('Less info >');
    }
    else {
      $(this).text('More info >');
    }
    $(this).next().toggleClass('hidden');
  });

})(jQuery, Drupal);
