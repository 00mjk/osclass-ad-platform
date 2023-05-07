$(document).ready(function(){

  // HELP TOPICS
  $('#mb-help > .mb-inside > .mb-row.mb-help > div').each(function(){
    var cl = $(this).attr('class');
    $('label.' + cl + ' span').addClass('mb-has-tooltip').prop('title', $(this).text());
  });

  $('.mb-row label').click(function() {
    var cl = $(this).attr('class');
    var pos = $('#mb-help > .mb-inside > .mb-row.mb-help > div.' + cl).offset().top - $('.navbar').outerHeight() - 12;;
    $('html, body').animate({
      scrollTop: pos
    }, 1400, function(){
      $('#mb-help > .mb-inside > .mb-row.mb-help > div.' + cl).addClass('mb-help-highlight');
    });

    return false;
  });


  // ON-CLICK ANY ELEMENT REMOVE HIGHLIGHT
  $('body, body *').click(function(){
    $('.mb-help-highlight').removeClass('mb-help-highlight');
  });


  // GENERATE TOOLTIPS
  Tipped.create('.mb-has-tooltip', { maxWidth: 200, radius: false });


  // CHECKBOX & RADIO SWITCH
  $.fn.bootstrapSwitch.defaults.size = 'small';
  $.fn.bootstrapSwitch.defaults.labelWidth = '0px';
  $.fn.bootstrapSwitch.defaults.handleWidth = '50px';

  $(".element-slide").bootstrapSwitch();



  // IMAGES UPLOAD
  $('.add_img').click(function() {
    var id = $(this).attr('id');
    $(this).parent().html('<input type="file" name="' + id + '" />');
    return false;
  });

  $('.add_fa').click(function() {
    var id = $(this).attr('id');
    $(this).parent().html('<input type="text" name="' + id + '" placeholder="example: fa-star" />');
    return false;
  });

  $('.add_color').click(function() {
    var id = $(this).attr('id');
    $(this).parent().html('<input type="text" name="' + id + '" placeholder="example: #CCFFDD" />');
    return false;
  });
});