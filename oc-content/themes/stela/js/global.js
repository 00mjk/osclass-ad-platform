$(document).ready(function(){


  // FANCYBOX - MOBILE SEARCH FILTERS
  $(document).on('click', '.search-mobile-filters', function(e){
    e.preventDefault();

    if (!!$.prototype.fancybox) {
      $.fancybox({
        'padding':  0,
        'width':    360,
        'height':   640,
        'autoSize': false,
        'autoDimensions': false,
        'wrapCSS':  'search-filters-box',
        'content':  '<div id="sidebar-search" class="fancy">' + $('#sidebar-search .form-wrap').html() + '</div>'
      });
    }
  });

 // LIGHTBOX GALLERY
  if(typeof $.fn.lightGallery !== 'undefined') {
    $('#images .swiper-container').lightGallery({
      mode: 'lg-slide',
      thumbnail: true,
      cssEasing : 'cubic-bezier(0.25, 0, 0.25, 1)',
      selector: 'li > a',
      getCaptionFromTitleOrAlt: true,
      download: false,
      thumbWidth: 90,
      thumbContHeight: 80,
      share: false
    }); 
  }

   // SWIPER INITIATE
   if(typeof(Swiper) !== 'undefined') { 
    var swiper = new Swiper(".swiper-container", {
      slideClass: "swiper-slide",
      navigation: {
        nextEl: ".swiper-next",
        prevEl: ".swiper-prev",
      },
      pagination: {
        el: ".swiper-pg",
        type: "fraction",
      },
      on: {
        afterInit: function () {
        }
      }
    });
  }
  
  
  // TOOLTIPS
  Tipped.create('.has-tooltip', { maxWidth: 200, radius: false, behavior: 'hide'});
  Tipped.create('.has-tooltip-left', { maxWidth: 200, radius: false, position: 'topleft', behavior: 'hide'});
  Tipped.create('.has-tooltip-right', { maxWidth: 360, radius: false, position: 'topright', behavior: 'hide'});


  // CHECK IF LOCATION BOX IS EMPTY
  if(!$('.content_only #itemMap *').length) {
    $('#itemMap').append('<span class="map-empty">' + locationNotFound + '</span>');
  }


  // SHOW HIDE CHANGE PASS, CHANGE EMAIL IN USER ACCOUNT
  $('body').on('click', '.box.change-email h3, .box.change-pass h3', function(e){
    e.preventDefault();

    $(this).find('i').toggleClass('fa-angle-down fa-angle-up');
    $(this).closest('.box').find('form').slideToggle(200);
  });


  // FILL PLACEHOLDER IF MISSING IN SELECT ON SEARCH SIDEBAR
  $('#sidebar-search select').each(function(){
    if($(this).find('option:first-child').text() == '') {
      $(this).find('option:first-child').text($(this).prev().text());
    }
  });



  // CREATE NICE CHECKBOXES FOR HOOKED CHECKBOXES ON SEARCH PAGE
  $('#sidebar-search input[type="checkbox"]').each(function(){
    if(!$(this).parent().hasClass('input-box-check')) {
      var cont = $(this).parent().html();
      $(this).parent().html('<div class="input-box-check">' + cont + '</div>');
    }
  });


  // CREATE NICE CHECKBOXES FOR HOOKED CHECKBOXES ON ITEM POST/EDIT
  $('#post-hooks input[type="checkbox"]').each(function(){
    if(!$(this).parent().hasClass('input-box-check')) {
      var cont = $(this).parent().html();
      $(this).parent().html('<div class="input-box-check">' + cont + '</div>');
    }
  });


  // CREATE NICE BOXES FOR HOOKED INPUTS
  $('#sidebar-search input[type="text"], #sidebar-search input[type="number"]').each(function(){
    if($(this).prop('placeholder') == '') {
      $(this).prop('placeholder', $(this).prev().text());
    }

    if(!$(this).parent().hasClass('input-box')) {
      var cont = $(this).parent().html();
      $(this).parent().html('<div class="input-box">' + cont + '</div>');
    }
  });



  // STICKY PAGES MENU
  if (($(window).width()+scrollCompensate()) >= 768) {
    $('.page-menu').stick_in_parent({
      parent: $(".page-wrap"), offset_top: 10
    }).on("sticky_kit:stick", function(e) {
      // Do something on stick
    });
  }


  // SHOW MORE FILTERS
  $('body').on('click', '.more-filters', function(e){
    e.preventDefault();

    $('.side-hide').fadeToggle(200);
    $(this).toggleClass('fa-angle-down fa-angle-up');

    if($(this).hasClass('fa-angle-down')) {
      $('input[name="iExtra"]').val('');
    } else {
      $('input[name="iExtra"]').val('1');
    }
  });


  // LOADING IMAGE ON BUTTON CLICK
  $('body').on('click', '#home-search .b3 button, #sidebar-search #search-button, .top-search button', function(e){
    var target = $(e.target);
    if(!target.hasClass('no-loader')){
      $(this).addClass('btn-loading').addClass('disabled');
    }
  });


  // LIST OR GRID VIEW
  $('body').on('click', '.list-grid a', function(e){
    e.preventDefault();

    if(!$(this).hasClass('active')) {
      var show = $(this).attr('data-view');

      $('.list-grid a').removeClass('active');
      $(this).addClass('active');

      $('.white').removeClass('list').removeClass('gallery').addClass(show);
      $('input[name="sShowAs"]').val(show);
    }

    if($('.paginate').length) {
      $('.paginate a').each(function() {
        var url = $(this).attr('href');

        if(!url.indexOf("index.php") >= 0 && url.match(/\/$/)) {
          url = url + '/'; 
        }

        if(url.indexOf("sShowAs") >= 0) {
          var newUrl = url.replace(/(sShowAs,).*?(\/)/,'$1' + show + '$2').replace(/(sShowAs,).*?(\/)/,'$1' + show + '$2');
        } else {
          if(url.indexOf("index.php") >= 0) {
            var newUrl = url + '&sShowAs=' + show;
          } else {
             var newUrl = url + '/sShowAs,' + show + '/';
          }
        }

        $(this).attr('href', newUrl);
      });
    }
  });


  // ITEM SIDEBAR - SHOW MORE
  $('body').on('click', '.show-more-item', function(e){
    e.preventDefault();

    $('#location .hidden-rows').slideToggle(200);
  });


  // CONTACT IN BOX
  $('body').on('click', '.box-contact', function(e){
    e.preventDefault();

    var url = this.href;
    var anchor = '';

    if (url.indexOf('#') != -1) {
      anchor = url.substring(url.indexOf('#'), url.length);
      url = url.substring(0, url.indexOf('#'));
    }

    if (url.indexOf('?') != -1) {
      url += '&';
    } else {
      url += '?';
    }


    if (!!$.prototype.fancybox) {
      $.fancybox({
        'padding':  0,
        'width':    480,
        'height':   540,
        'autoSize': false,
        'autoDimensions': false,
        'type':     'iframe',
        'href':     url + 'type=box' + anchor
      });
    }
  });


  // SIGN IN BOX
  $('body').on('click', '.profile.sign-in', function(e){
    e.preventDefault();

    var url = this.href;
    var anchor = '';

    if (url.indexOf('#') != -1) {
      anchor = url.substring(url.indexOf('#'), url.length);
      url = url.substring(0, url.indexOf('#'));
    }

    if (url.indexOf('?') != -1) {
      url += '&';
    } else {
      url += '?';
    }


    if (!!$.prototype.fancybox) {
      $.fancybox({
        'padding':  0,
        'width':    480,
        'height':   480,
        'autoSize': false,
        'autoDimensions': false,
        'type':     'iframe',
        'href':     url + 'type=box' + anchor
      });
    }
  });



  // NOTIFICATIONS
  $('body').on('click', '#header-bar .alerts', function(e){
    e.preventDefault();

    var url = this.href;
    var anchor = '';

    if (url.indexOf('#') != -1) {
      anchor = url.substring(url.indexOf('#'), url.length);
      url = url.substring(0, url.indexOf('#'));
    }

    if (url.indexOf('?') != -1) {
      url += '&';
    } else {
      url += '?';
    }


    if (!!$.prototype.fancybox) {
      $.fancybox({
        'padding':  0,
        'width':    480,
        'height':   480,
        'autoSize': false,
        'autoDimensions': false,
        'type':     'iframe',
        'href':     url + 'type=alerts' + anchor
      });
    }
  });



  // LOCATE ME - HOMEPAGE
  $('body').on('click', '.locate-me', function(e){
    e.preventDefault();
    $(this).siblings('input[name="term"]').val($(this).attr('data-location')).click();
    $(this).remove();
  });


  // CHECK IF ITEM PAGE - CONTENT ONLY
  if(stelaInFrame()) {
    try{
      parent.document;
      $('body').addClass('content_only');
    }catch(e){
    }
  }



  // AJAX ITEM CONTACT SELLER
  $('body').on('submit', '.ajax-submit form', function(){
    if(ajaxForms == 1) {
      $(this).find('button').addClass('disabled').attr('disabled', true);
      var box = $('.ajax-submit');
      var form = $(this).closest('form');

      var loadBox = $('.box-help .loading').html();
      var errorBox = $('.box-help .error').html();
      var successBox = $('.box-help .success').html();

      box.html('<div class="box-done"></div>');
      var boxHelp = box.find('.box-done');

      // Loading
      boxHelp.html(loadBox).addClass('loading');

      $.ajax({
        url: form.attr('action'),
        type: "POST",
        data: form.find(':input[value!=""]').serialize(),
        success: function(response){
          boxHelp.removeClass('loading');
          var type = $(response).contents().find('.flashmessage');

          var message = $(response).contents().find('.flash-wrap').text().trim();
          message = message.substring(1, message.length);

          if(type.hasClass('flashmessage-error')) {
            boxHelp.addClass('error').html(errorBox);
          } else {
            boxHelp.addClass('success').html(successBox);
          }

          boxHelp.find('.message').text(message);
        }
      });
    }
  });


  // CLOSE FANCYBOX
  $('body').on('click', '.close.exit', function(e){
    e.preventDefault();
    parent.$.fancybox.close();
  });


  // REPEAT MESSAGE
  $('body').on('click', '.close.repeat', function(e){
    e.preventDefault();
    location.reload();
  });



  // AJAX PUBLIC PROFILE CONTACT SELLER
  $('body').on('click', 'button#send-public-message', function(){
    if(ajaxForms == 1) {

      // Validate form first
      $('form#contact_form_public input, form#contact_form_public select').each(function(){
        $('form#contact_form_public').validate().element($(this));
      });


      if($('form#contact_form_public').valid()) {
        $('button#send-public-message').addClass('disabled').attr('disabled', true);

        $.ajax({
          url: $('form#contact_form_public').attr('action'),
          type: "POST",
          data: $('form#contact_form_public').find(':input[value!=""]').serialize(),
          success: function(response){
            $('button#send-public-message').removeClass('disabled').attr('disabled', false);
            var message = $(response).contents().find('.flash-wrap').html();
            $('.flash-wrap', window.parent.document).html(message);
            $('html, body', window.parent.document).animate({ scrollTop: $('body', window.parent.document).offset().top }, 300);

            parent.$.fancybox.close();
          }
        });
      }
    }
  });



  // AJAX SEND TO FRIEND
  $('body').on('click', 'button#send-message', function(){
    if(ajaxForms == 1 && 1==2) {

      // Validate form first
      $('form[name="sendfriend"] input, form[name="sendfriend"] select').each(function(){
        $('form[name="sendfriend"]').validate().element($(this));
      });


      if($('form[name="sendfriend"]').valid()) {
        $('button#send-message').addClass('disabled').attr('disabled', true);

        $.ajax({
          url: $('form#sendfriend').attr('action'),
          type: "POST",
          data: $('form#sendfriend').find(':input[value!=""]').serialize(),
          success: function(response){
            $('button#send-message').removeClass('disabled').attr('disabled', false);
            var message = $(response).contents().find('.flash-wrap').html();
            $('.flash-wrap', window.parent.document).html(message);
            $('html, body', window.parent.document).animate({ scrollTop: $('body', window.parent.document).offset().top }, 300);

            parent.$.fancybox.close();
          }
        });
      }
    }
  });



  // AJAX SEND COMMENT
  $('body').on('click', 'button#send-comment', function(){
    if(ajaxForms == 1) {

      // Validate form first
      $('form[name="comment_form"] input, form[name="comment_form"] select').each(function(){
        $('form[name="comment_form"]').validate().element($(this));
      });


      if($('form[name="comment_form"]').valid()) {
        $('button#send-comment').addClass('disabled').attr('disabled', true);

        $.ajax({
          url: $('form#comment_form').attr('action'),
          type: "POST",
          data: $('form#comment_form').find(':input[value!=""]').serialize(),
          success: function(response){
            $('button#send-comment').removeClass('disabled').attr('disabled', false);
            var message = $(response).contents().find('.flash-wrap').html();
            $('.flash-wrap', window.parent.document).html(message);
            $('html, body', window.parent.document).animate({ scrollTop: $('body', window.parent.document).offset().top }, 300);

            parent.$.fancybox.close();
          }
        });
      }
    }
  });


  // AJAX SEARCH
  $('body#body-search').on('change click', 'form.search-side-form input:not(.term), form.search-side-form select, .sort-it .sort-content a, #search-items .paginate a', function(event) {
    if (($(window).width() + scrollCompensate()) >= 768) {
      var block = $('form.search-side-form');
      var ajaxSearchUrl = '';

      if (event.type == 'click') {
        if(typeof $(this).attr('href') !== typeof undefined && $(this).attr('href') !== false) {
          ajaxSearchUrl = $(this).attr('href');
        }
      } else if (event.type == 'change') {
        ajaxSearchUrl = baseDir + "index.php?" + block.find(':input[value!=""]').serialize();
      }


      if(ajaxSearch == 1 && $('input[name="ajaxRun"]').val() != "1" && (ajaxSearchUrl != '#' && ajaxSearchUrl != '') ) {
        if(ajaxSearchUrl == $(location).attr('href')) {
          return false;
        }

        block.find('#search-button').addClass('btn-loading').addClass('disabled').attr('disabled', true);
        block.find('input[name="ajaxRun"]').val("1");
        block.find('input[name="cookieAction"]').val("done");
        $('#search-items').addClass('loading');


        $.ajax({
          url: ajaxSearchUrl,
          type: "GET",
          success: function(response){
            var length = response.length;

            var data = $(response).contents().find('#search-items').html();
            var title = $(response).contents().find('.search-title').html();
            var sidebar = $(response).contents().find('#sidebar').html();
            var markers = $(response).contents().find('#radius-items-array').html();
            //markers = JSON.parse(markers );
            markers = $.parseJSON(markers);

            var radiusMarkers = new Array();
            for(var i in markers) radiusMarkers[i] = markers[i];

            //console.log(topCat);
            //console.log(counter);
            //console.log(baseDir + "index.php?" + block.serialize());

            block.find('#search-button').removeClass('btn-loading').removeClass('disabled').attr('disabled', false);
            block.find('input[name="ajaxRun"]').val("");

            $('#search-items').fadeOut(200, function(){ 
              $('#search-items').removeClass('loading');
              $('#search-items').html(data).fadeIn(300); 
            });

            $('.search-title').html(title);
            $('#sidebar').html(sidebar);

            recreateMarkers(map, radiusMarkers);


            //$('.search-side-form input[name="sCategory"]').val( $(response).contents().find('input[name="sCategory"]').val() );            
           // $('.search-side-form input[name="sOrder"]').val( $(response).contents().find('input[name="sOrder"]').val() );            
           // $('.search-side-form input[name="iOrderType"]').val( $(response).contents().find('input[name="iOrderType"]').val() );            
            //$('.search-side-form input[name="sShowAs"]').val( $(response).contents().find('input[name="sShowAs"]').val() );            
           // $('.search-side-form input[name="iExtra"]').val( $(response).contents().find('input[name="iExtra"]').val() );            


            stelaAjaxReload();
            window.setTimeout(function(){ stelaAjaxReload(); }, 250);
            
            // Update URL
            window.history.pushState(null, null, ajaxSearchUrl);
          },

          error: function(response){
            block.find('#search-button').removeClass('btn-loading').removeClass('disabled').attr('disabled', false);
            block.find('input[name="ajaxRun"]').val("");

            response = response.responseText;
            var data = $(response).contents().find('#search-items').html();
            var title = $(response).contents().find('.search-title').html();
            var sidebar = $(response).contents().find('#sidebar').html();
            var markers = $(response).contents().find('#radius-items-array').html();
            markers = JSON.parse(markers )

            var radiusMarkers = new Array();
            for(var i in markers) radiusMarkers[i] = markers[i];

            $('#search-items').fadeOut(200, function(){ 
              $('#search-items').removeClass('loading');
              $('#search-items').html(data).fadeIn(300); 
            });

            $('.search-title').html(title);
            $('#sidebar').html(sidebar);

            recreateMarkers(map, radiusMarkers);


           // $('.search-side-form input[name="sCategory"]').val( $(response).contents().find('input[name="sCategory"]').val() );            
            //$('.search-side-form input[name="sOrder"]').val( $(response).contents().find('input[name="sOrder"]').val() );            
           // $('.search-side-form input[name="iOrderType"]').val( $(response).contents().find('input[name="iOrderType"]').val() );  
            //$('.search-side-form input[name="sShowAs"]').val( $(response).contents().find('input[name="sShowAs"]').val() );            
            //$('.search-side-form input[name="iExtra"]').val( $(response).contents().find('input[name="iExtra"]').val() );            

         
            stelaAjaxReload();
            window.setTimeout(function(){ stelaAjaxReload(); }, 250);

            // Update URL
            window.history.pushState(null, null, ajaxSearchUrl);
          }
        });

        $('html, body, .content-wrap').animate({ scrollTop: 0 }, 200);

        return false;
      }
    }
  });


 
  // NEXT MESSAGE SEND - TOGGLE BOXES
  $('body').on('click', '.next-message', function(e){
    e.preventDefault();

    $('.message-status').slideUp(300, function(){
      $('.message-block').slideDown(300);
    });

    return false;
  });


  // INITIALIZE IS TOUCH DEVICE
  if(is_touch_device()) {
    //$('body').addClass('is_touch');
  }

  // ADD BROWSER & DEVICE INFORMATION TO BODY CLASS
  $('body').addClass(getMobileOperatingSystem());


  // ITEM CONTACT SELLER - ENSURE TEL: IS WORKING
  $('.phone-block, .phone-show').click(function(e){
    var itemId = $(this).attr('data-item-id');
    var itemUserId = $(this).attr('data-item-user-id');

    if( $(this).attr('href') != '#' ) {
      window.location.href = $(this).attr('href');
    } else {
      $.ajax({
        url: baseAjaxUrl + "&ajaxPhoneClick=1&itemId=" + itemId + "&itemUserId=" + itemUserId,
        type: "GET",
        success: function(response){
          //console.log(response);
        }
      });
    }
  });



  // ELLIPSIS FUNCTION
  $('.ellipsis-h, .ellipsis-v').click(function(){
    var block = $(this);

    block.addClass('active');
    setTimeout(function(){ 
      block.removeClass('active');
    }, 600);
  });


  // ITEM PAGE FOR MOBILE VIEW - Details / Contact
  $('#swap a').click(function(e){
    e.preventDefault();

    $('#swap a').removeClass('active');
    $(this).addClass('active');

    if( $(this).hasClass('details') ) {
      $('.is_detail').show(0);
      $('.is_contact').hide(0);
    } else {
      $('.is_contact').show(0);
      $('.is_detail').hide(0);
    }
  });



  // SIMPLE SORT FOR MOBILE
  $('#orderSelect').change(function(){
    $('input[name="sOrder"]').val($('#orderSelect option:selected').attr('data-type'));
    $('input[name="iOrderType"]').val($('#orderSelect option:selected').attr('data-order'));
  });



  // PUBLISH - MOVE BETWEEN STEPS
  $('.post-navigation .btn').click(function(e){
    e.preventDefault();

    var current = $(this).attr('data-current-step');
    var next = $(this).attr('data-next-step');
    var prev = $(this).attr('data-prev-step');
    var total = parseInt($('fieldset.general .total-steps').text());


    $('html, body').animate({
      scrollTop: $('body').offset().top
    }, 300);


    if( $(this).hasClass('post-next') ) {

      // Check for required fields
      $('fieldset[data-step-id="' + current + '"] input, fieldset[data-step-id="' + current + '"] select, fieldset[data-step-id="' + current + '"] textarea').each(function(){
        if( $(this).attr('id') != 'ir_image_check') {
          $("form[name=item]").validate().element($(this));
        }
      });


      // Fix functionality of image required plugin
      if($('input#ir_image_check').length) {
        if(current != 2) {
          $('input#ir_image_check').attr('disabled', true);
        } else {
          $('input#ir_image_check').attr('disabled', false);
          $("form[name=item]").validate().element($('input#ir_image_check'));
        }
      }


      if($("form[name=item]").valid()) {
        $('fieldset[data-step-id="' + current + '"]').animate({marginLeft: "-1000px", opacity:0}, 300, function(){
          $('fieldset[data-step-id="' + current + '"]').hide(0);
          $('fieldset[data-step-id="' + next + '"]').css('display', 'inline-block').css('margin-left', '1000px').css('opacity', '0');
          $('fieldset[data-step-id="' + next + '"]').animate({marginLeft: "0px", opacity:1}, 300);

          // Show submit button
          if(parseInt(current) == (total-1) && parseInt(next) == total) {
            $('.buttons-block').css('display', 'inline-block').css('margin-left', '1000px').css('opacity', '0');
            $('.buttons-block').animate({marginLeft: "0px", opacity:1}, 300);
          }

          // If there are only 2 steps, hide next button on 2nd step
          if(total < 3) {
            $('fieldset.photos .post-next').hide(0);
          } else {
            $('fieldset.photos .post-next').show(0);
          }
        }); 
      }
    } else if ( $(this).hasClass('post-prev') ) {
      $('fieldset[data-step-id="' + current + '"]').animate({marginLeft: "1000px", opacity:0}, 300, function(){
        $('fieldset[data-step-id="' + current + '"]').hide(0);
        $('fieldset[data-step-id="' + prev + '"]').css('display', 'inline-block').css('margin-left', '-1000px').css('opacity', '0');
        $('fieldset[data-step-id="' + prev + '"]').animate({marginLeft: "0px", opacity:1}, 300);
      }); 

      // Hide submit button
      $('.buttons-block').animate({marginLeft: "1000px", opacity:1}, 300, function() {
        $('.buttons-block').hide(0);
      });
    }

  });



  // FLAT CATEGORY SELECT ON PUBLISH PAGE
  $('body').on('click', '.flat-wrap .single:not(.info)', function() {
    var id = $(this).attr('data-id');
    var sub = false;

    if( $('.flat-wrap[data-parent-id="' + id + '"]').length ) {

      // Has subcategories
      $('.flat-wrap[data-parent-id="' + id + '"]').show(0);
      $('.flat-wrap.root').animate({"left": '-=100%'}, 300, 'swing');

    } else {

      // No subcategories
      $('input#catId').val(id).trigger('click');;
      $('.flat-cat-box .single').removeClass('selected');
      $(this).addClass('selected');

      $('#flat-cat-fancy .single').removeClass('selected');
      $('#flat-cat-fancy .single[data-id="' + $(this).attr('data-id') + '"]').addClass('selected');

      $('.add_item #flat-cat .option').html( $(this).find('span').text() ).addClass('done');
      parent.$.fancybox.close();
    }

  });

  // Go back to parent category
  $('body').on('click', '.flat-wrap .back', function() {
    var hideId = parseInt($(this).closest('.flat-wrap').attr('data-parent-id'));

    $('.flat-wrap.root').animate({"left": '+=100%'}, 300, 'swing', function(){
      $('.flat-wrap[data-parent-id="' + hideId + '"]').hide(0);
    });
  });


  // On load go to category
  if( parseInt($('input[name="catId"]').val()) > 0 ) {
    var cat_id = parseInt($('input[name="catId"]').val());
    var parents_count = parseInt($('.flat-wrap .single[data-id="' + cat_id + '"]').parents('.flat-wrap').length) - 1;


    $('.flat-wrap .single[data-id="' + cat_id + '"]').parents('.flat-wrap').show(0);
    $('.flat-wrap.root').animate({"left": -(100*parents_count) + '%'}, 300, 'swing');
  }



  // ALERTS - SHOW PARAMETERS
  $('.alert-show-detail').click(function(e) {
    $(this).parent().parent().find('.hed-param').slideDown(200);
    $(this).fadeOut(200);
  });



  // SEARCH - PREMIUM LIST - SHOW MORE
  $('#premium-more .push').click(function(){
    $('.premium-list-block').slideUp(300, function() {
      $('.premium-list-block').css('height', 'auto').css('overflow', 'initial').css('max-height', 'initial');
      $('.premium-list-block').slideDown(300);
      $('#premium-more .push').fadeOut(200);
    });
  });  



  // LOGIN-REGISTER FUNCTIONALITY
  $('.swap-box-auth, .swap-log-reg').click(function(e){
    e.preventDefault();

    if( $(this).hasClass('to-reg') ) {
      $('.box#login, .box#lost').hide(0);
      $('.box#register').show(0);
    } else if($(this).hasClass('to-log')) {
      $('.box#register, .box#lost').hide(0);
      $('.box#login').show(0);
    
    } else if($(this).hasClass('to-lost')) {
      $('.box#register, .box#login').hide(0);
      $('.box#lost').show(0);
    }
  });



  // CONTACT SELLER - ITEM RIGHT SIDEBAR BUTTON
  $('.contact-button').click(function(e){
    e.preventDefault();

    $('html, body').animate({
      scrollTop: $('#more-info.contact-seller').offset().top - 30
    }, 1000);

    $('#contact_form input[type="text"]').first().focus();
    return false;
  });



  // CONTACT SELLER - FILE NAME
  $('input[name="attachment"]').change(function() {
    if( $(this)[0].files[0]['name'] != '' ) {
      $('.attachment .att-box .status .wrap span').text( $(this)[0].files[0]['name'] );
    }
  });



  // LOCATION PICKER FUNCTIONALITY
  $('body').on('click', '#location-picker .shower .option', function() {

    if( !$(this).hasClass('empty-pick') && !$(this).hasClass('more-pick') && !$(this).hasClass('service') ) {

      $('#location-picker .shower .option').removeClass('selected');
      $(this).addClass('selected');
      $('#location-picker .shower').fadeOut(200);
      $('#location-picker .term').removeClass('open');
      $('input[name="cookieAction"], input[name="cookieActionMobile"]').val('done');


      var term = $(this).html();
      term = term.replace('<span>', '');
      term = term.replace('</span>', '');
      $('input.term').val( term );

      if($('body#body-item-post').length || $('body#body-item-edit').length) {
        $('input[name="countryId"], input[name="regionId"], input[name="cityId"]').prop('disabled', false);
        $('input[name="country"], input[name="sCountry"], input[name="region"], input[name="sRegion"], input[name="city"], input[name="sCity"], input[name="sLon"], input[name="sLat"]').val('').prop('disabled', true);
      }

      $('input[name="countryId"], input.sCountry').val( $(this).attr('data-country') );
      $('input[name="regionId"], input.sRegion').val( $(this).attr('data-region') );
      $('input[name="cityId"], input.sCity').val( $(this).attr('data-city') );
      $('input[name="cityId"]').change();
    }
  });


  // ITEM AUTOCOMPLETE FUNCTIONALITY
  $('body').on('click', '#item-picker .shower .option', function(e) {
    if( !$(this).hasClass('empty-pick') && !$(this).hasClass('more-pick') && !$(this).hasClass('service') ) {
      $('#item-picker .shower').fadeOut(200);
      $('#item-picker .pattern').removeClass('open');
    }
  });


  // SIMPLE SELECT FUNCTIONALITY
  $('body').on('click', '.simple-select:not(.disabled) .option:not(.info)', function() {
    $(this).parent().parent().find('input.input-hidden').val( $(this).attr('data-id') ).change();
    $(this).parent().parent().find('.text span').html( $(this).text().trim() );
    $(this).parent().parent().find('.option').removeClass('selected');
    $(this).addClass('selected');
    $(this).parent().fadeOut(200);
    $('input[name="cookieAction"], input[name="cookieActionMobile"]').val('done');
  });


  $('body').on('mouseenter', '.simple-select', function() {
    if( !$(this).hasClass('disabled') ) {
      $(this).find('.list').fadeIn(200); 
    }
  }).on('mouseleave', '.simple-select', function() {
    if( !$(this).hasClass('disabled') ) {
      $(this).find('.list').fadeOut(200);
    }
  });




  // SHOW LIST OF LOCATIONS WHEN CLICK ON TERM
  $('body').on('click', '#location-picker .term', function() {
    $('#location-picker .shower').fadeIn(200);
    $('#location-picker .term').addClass('open');
  });


  // SHOW LIST OF ITEMS WHEN CLICK ON PATTERN
  $('body').on('click', '#item-picker .pattern', function() {
    $('#item-picker .shower').fadeIn(200);
    $('#item-picker .pattern').addClass('open');
  });


  // WHEN SIMPLE CATEGORY CLICKED, UPDATE ALL sCategory INPUTS
  $('body').on('change', 'select[name="sCategory"]', function() {
    $('input[name="sCategory"]').val( $(this).val() );
  });


  // WHEN CLICK OUTSIDE LOCATION PICKER, HIDE SELECTION
  $(document).mouseup(function (e){
    var container = $("#location-picker");
    var defVal = $('input[name="sCountry"]').val() + $('input[name="sRegion"]').val() + $('input[name="sCity"]').val();

    if (!container.is(e.target) && container.has(e.target).length === 0) {
      if($('#location-picker .term').val() == '' && ( $('input[name="sCountry"]').val() != '' || $('input.sCountry').val() != '' || $('input.sCountry').val() != '' || $('input[name="sRegion"]').val() != '' || $('input.sRegion').val() != '' || $('input[name="sCity"]').val() != '' || $('input.sCity').val() != '' )) {
        $('input[name="sCountry"], input.sCountry, input[name="sRegion"], input.sRegion, input[name="sCity"], input.sCity').val("");

        if(defVal != $('input[name="sCountry"]').val() + $('input[name="sRegion"]').val() + $('input[name="sCity"]').val()) {
          $('input[name="sCity"]').change();
        }
      }

      $('#location-picker .shower').fadeOut(200);
      $('#location-picker .term').removeClass('open');
    }
  });


  // WHEN CLICK OUTSIDE ITEM PICKER, HIDE SELECTION
  $(document).mouseup(function (e){
    var container = $("#item-picker");

    if (!container.is(e.target) && container.has(e.target).length === 0) {
      $('#item-picker .shower').fadeOut(200);
      $('#item-picker .pattern').removeClass('open');
    }
  });




  // STICKY SIDEBAR
  if (($(window).width()+scrollCompensate()) >= 768) {
    if (stelaItemStick == "1") {
      $('#body-item #side-right').stick_in_parent({
        parent: $("#listing"), offset_top: 0
      }).on("sticky_kit:stick", function(e) {
        // Do something on stick
      });
    }
  }



  // STICKY SEARCH SIDEBAR
  // if (($(window).width()+scrollCompensate()) >= 768) {
  //  if (stelaSearchStick == "1") {
  //    $('.list #sidebar').stick_in_parent({
  //      parent: $(".content"), offset_top: 0
  //    }).on("sticky_kit:stick", function(e) {
  //      // Do something on stick
  //    });
  //  }
  //}


  // SET COLOR OF SEARCH BUTTON AFTER IMAGE IS LOADED
  var image = new Image();

  image.onload = function () {
    $('.header-menu span').css('opacity', '1');
  }

  image.src = stelaHeaderImg;



  // HEADER FUNCTIONALITY
  $('#uniform-Locator, .top-my, #uniform-sCategory').hover(function(){
    $(this).css('z-index', 99999);
  }, function(){
    $(this).css('z-index', 9);
  });


  idTabsMultiLine();


  // -------------------------------------------------------
  // SCRIPTS FOR RESPONSIVE DESIGN: 0 - 767px
  // -------------------------------------------------------


  if (($(window).width() + scrollCompensate()) <= 767) { 

    // STICK DETAILS & CONTACT LINKS FOR MOBILE VIEW
    $('#swap').stick_in_parent({
      parent: $("#main"), offset_top: 50
    }).on("sticky_kit:stick", function(e) {
      // Do something on stick
    });



    var close_btn = true;


    // SHOW HIDE FUNCTIONALITY
    $('.sc-click').on('click', function(e){
      e.preventDefault();

      if(!$(this).hasClass('opened') || !$(this).hasClass('closed')) {
        $(this).addClass('closed');
      }

      $(this).toggleClass('opened closed');

      $(this).parent().find('.sc-block').slideToggle(300).toggleClass('is-opened');

      if($(this).parent('#location').length) {
        google.maps.event.trigger(map, 'resize');
      }
    });

  } 




//   // ITEM BX-SLIDER FOR CONTENT ONLY
//   if(contentOnly == 1 || ($(window).width() + scrollCompensate()) <= 767) {
//     $('.item-slider').bxSlider({
//       minSlides: 1,
//       maxSlides: 1,
//       moveSlides: 1,
//       slideWidth: $(window).outerWidth(),
//       infiniteLoop: false,
//       slideMargin: 0,
//       pager: true,
//       onSlidePrev: function($elem, oldIndex, newIndex) {
//         $('a.bx-next').css('opacity', '1').removeClass('disabled');

//         if( newIndex == 0 ) {
//           $('a.bx-prev').css('opacity', '0.4').addClass('disabled');
//         } else {
//           $('a.bx-prev').css('opacity', '1').removeClass('disabled');
//         }
//       },
//       onSlideNext: function($elem, oldIndex, newIndex) {
//         $('a.bx-prev').css('opacity', '1').removeClass('disabled');

//         if( newIndex == parseInt($('.item-slider').find('li').length) - 1 ) {
//           $('a.bx-next').css('opacity', '0.4').addClass('disabled');
//         } else {
//           $('a.bx-next').css('opacity', '1').removeClass('disabled');
//         }
//       },
//       onSliderLoad: function() {
//         $('a.bx-prev').css('opacity', '0.4').addClass('disabled');

//         if(parseInt($('.item-slider').find('li').length) <= 1) {
//           $('a.bx-next').css('opacity', '0.4').addClass('disabled');
//         }
//       }
//     });
//   }


 
//   stelaAjaxReload();


// if(typeof $.fn.bxSlider !== 'undefined') { 
//     $('.bx-slide').bxSlider({
//       slideWidth: $(window).outerWidth(),
//       infiniteLoop: false,
//       // slideMargin: 0,
//       pager: false,
//       // pagerCustom: '.item-bx-pager',
//       infiniteLoop: true,
//       nextText: '',
//       prevText: ''
//     });
//   }


  // SHOW HIDE HEADER MENU RESPONSIVE OPTIONS
  $('.header-menu#h-options').on('click', function(e){
    e.preventDefault();

    var id = $(this).attr('data-link-id');
    var otherOpened = false


    // Check if another menu is not already opened 

    if( $('.header-menu.opened').length && $('.header-menu.opened').attr('data-link-id') != id ) {
      otherOpened = true;
      $('.header-menu.opened').removeClass('opened').addClass('closed');
  

      $('.header-slide.opened').animate({right: '-70%'}, 500, function() { 
        $(this).css('width', '0'); 
      });

      $('.header-slide.opened').removeClass('opened').addClass('closed');

    }


    $(this).toggleClass('opened closed');
   
    if( $(id).hasClass('closed') ) {
      $(id).css('width', '80%');
      $(id).animate({right: '0px'}, 500);
      $('body').animate({marginLeft: '-80%'}, 500);
    } else {
      $(id).animate({right: '-80%'}, 500, function() { 
        $(id).css('width', '0'); 
      });
      $('body').animate({marginLeft: '0%'}, 500);
    }

    $(id).toggleClass('opened closed');

    if(!otherOpened) {
      $('#menu-cover').fadeToggle(200);
      $('body').toggleClass('no-scroll');
      $('html').toggleClass('no-scroll');
    }
  });


  $('.close-mobile-menu').on('click', function(e){
    e.preventDefault();

    $('#menu-options').animate({right: '-80%'}, 500, function() { 
      $('#menu-options').css('width', '0'); 
    });

    $('.header-menu#h-options, #menu-options').toggleClass('opened closed');
    $('body').animate({marginLeft: '0%'}, 500);
    $('#menu-cover').fadeOut(200);
    $('body').removeClass('no-scroll');
    $('html').removeClass('no-scroll');
  });


  $('.header-menu#h-search').on('click', function(e){
    e.preventDefault();
    $('.header-search-mobile').fadeIn(150).addClass('opened');
  });


  $('.header-search-mobile .close-box').on('click', function(e){
    e.preventDefault();
    $('.header-search-mobile').fadeOut(150).removeClass('opened');
  });

  $(document).mouseup(function (e){
    var container = $(".header-search-mobile");

    if (!container.is(e.target) && container.has(e.target).length === 0 && container.hasClass('opened')) {
      $('.header-search-mobile').fadeOut(150).removeClass('opened');
    }
  });


  $('#menu-cover').on('click', function(e){
    e.preventDefault();

    $(this).fadeOut(200);

    $('.header-slide.opened').animate({right: '-80%'}, 500, function() { 
      $('.header-slide.opened').css('width', '0'); 
    });
    $('body').animate({marginLeft: '0%'}, 500);

    $('.header-menu').removeClass('opened').addClass('closed');
    $('.header-slide').removeClass('opened').addClass('closed');
    $('body').removeClass('no-scroll');
    $('html').removeClass('no-scroll');
  });



  // FANCYBOX - ITEM CONTACT FUNCTIONALITY
  $(document).on('click', '.item-contact', function(e){
    e.preventDefault();
    var url = this.href;
    var anchor = '';

    if (url.indexOf('#') != -1) {
      anchor = url.substring(url.indexOf('#'), url.length);
      url = url.substring(0, url.indexOf('#'));
    }

    if (url.indexOf('?') != -1) {
      url += '&';
    } else {
      url += '?';
    }

    if (!!$.prototype.fancybox) {
      $.fancybox({
        'padding':  0,
        'width':    480,
        'height':   480,
        'wrapCSS':  'item-contact-func',
        'type':     'iframe',
        'href':     url + 'type=item_contact' + anchor
     });
    }
  });



  // FANCYBOX - SEND TO FRIEND FUNCTIONALITY
  $(document).on('click', '#send-friend', function(e){
    e.preventDefault();
    var url = this.href;
    var anchor = '';

    if (url.indexOf('#') != -1) {
      anchor = url.substring(url.indexOf('#'), url.length);
      url = url.substring(0, url.indexOf('#'));
    }

    if (url.indexOf('?') != -1) {
      url += '&';
    } else {
      url += '?';
    }

    if (!!$.prototype.fancybox) {
      $.fancybox({
        'padding':  0,
        'width':    480,
        'height':   480,
        'wrapCSS':  'send-friend-func',
        'type':     'iframe',
        'href':     url + 'type=send_friend' + anchor
     });
    }
  });



  // FANCYBOX - POST COMMENT FORM
  $(document).on('click', '.add-com', function(e){
    e.preventDefault();
    var url = this.href;
    var anchor = '';

    if (url.indexOf('#') != -1) {
      anchor = url.substring(url.indexOf('#'), url.length);
      url = url.substring(0, url.indexOf('#'));
    }

    if (url.indexOf('?') != -1) {
      url += '&';
    } else {
      url += '?';
    }

    if (!!$.prototype.fancybox) {
      $.fancybox({
        'padding':  0,
        'width':    480,
        'height':   480,
        'wrapCSS':  'add-com-func',
        'type':     'iframe',
        'href':     url + 'type=add_comment' + anchor
     });
    }
  });



  // FANCYBOX - PUBLIC PROFILE CONTACT SELLER FORM
  $(document).on('click', '#pub-contact', function(e){
    e.preventDefault();
    var url = this.href;
    var anchor = '';
    var user_id = $(this).attr('rel');

    if (url.indexOf('#') != -1) {
      anchor = url.substring(url.indexOf('#'), url.length);
      url = url.substring(0, url.indexOf('#'));
    }

    if (url.indexOf('?') != -1) {
      url += '&';
    } else {
      url += '?';
    }

    if (!!$.prototype.fancybox) {
      $.fancybox({
        'padding':  0,
        'width':    480,
        'height':   480,
        'wrapCSS':  'pub-contact-func',
        'type':     'iframe',
        'href':     url + 'type=public_contact&userId=' + user_id + anchor
     });
    }
  });

// OPEN REPORT BOX
  $('body').on('click', '.report-button', function(e) {
    e.preventDefault();

    epsModal({
      width: 420,
      height: 490,
      content: $('.report-wrap').html(),
      wrapClass: 'report-box',
      closeBtn: true,
      iframe: false,
    //   fullscreen: 'mobile',
      transition: 200,
      delay: 0,
      lockScroll: true
    });
  });
  
// OPEN REPORT BOX
  $('body').on('click', '.login-chat', function(e) {
    e.preventDefault();

    epsModal({
      width: 420,
      height: 490,
      content: $('.login-wrap').html(),
      wrapClass: 'report-box',
      closeBtn: true,
      iframe: false,
    //   fullscreen: 'mobile',
      transition: 200,
      delay: 0,
      lockScroll: true
    });
  });
  
  // FANCYBOX - OPEN CATEGORIES ON PUBLISH PAGE
  $(document).on('click', '#flat-cat .category-box', function(e){
    e.preventDefault();

    if (!!$.prototype.fancybox) {
      $.fancybox({
        'padding':  0,
        'width':    380,
        'height':   460,
        'autoSize': false,
        'autoDimensions': false,
        'wrapCSS':  'flat-cat-box',
        'content':  $('#flat-cat-fancy').html()
      });
    }
  });


  // FANCYBOX - UPATE PROFILE PICTURE
  $(document).on('click', '#pict-update, #pict-update-secondary', function(e){
    e.preventDefault();

    if (!!$.prototype.fancybox) {
      $.fancybox({
        'padding':  0,
        'width':    480,
        'height':   480,
        'autoSize': false,
        'autoDimensions': false,
        'closeBtn' : close_btn,
        'wrapCSS':  'pict-func',
        'content':  $('#show-update-picture-content').html()
      });
    }
  });




  // FANCYBOX - CLOSE BUTTON
  $(document).on('click', '.fw-close-button', function(e){
    e.preventDefault();

    parent.$.fancybox.close();
  });



  // FANCYBOX - QUICK VIEW FUNCTIONALITY FOR LISTINGS
  $(document).on('click', '.orange-but.open-image:not(.disabled)', function(e){
    e.preventDefault();
    var url = this.href;
    var anchor = '';

    if (url.indexOf('#') != -1) {
      anchor = url.substring(url.indexOf('#'), url.length);
      url = url.substring(0, url.indexOf('#'));
    }

    if (url.indexOf('?') != -1) {
      url += '&';
    } else {
      url += '?';
    }

    /*
    var windowsWidth = parseInt($(window).outerWidth()) - 50;
    var windowsHeight = parseInt($(window).outerHeight()) - 50;
    var adjustWidth = dimNormalWidth;
    var adjustHeight = dimNormalHeight;

    if( windowsWidth < adjustWidth ) {
      adjustHeight = dimNormalHeight / (dimNormalWidth / windowsWidth);
      adjustWidth = windowsWidth;
    }

    if( windowsHeight < adjustHeight ) {
      adjustWidth = adjustWidth / (adjustHeight / windowsHeight);
      adjustHeight = windowsHeight;
    }
    */

    if (!!$.prototype.fancybox) {
      $.fancybox({
        'padding':   0,
        //'width':     adjustWidth,
        //'height':    adjustHeight,
        'width':     800,
        'height':    640,
        'scrolling': 'no',
        'wrapCSS':   'quick-view',
        'type':      'iframe',
        'href':      url + 'contentOnly=1' + anchor
     });
    }
  });


  // Handle no pictures
  $(document).on('click', '.orange-but.open-image.disabled', function(e){
    e.preventDefault();
    return false;
  });



  if (($(window).width() + scrollCompensate()) > 767) {

    // NICE TOOLTIPS FOR DEMO BANNERS
    Tipped.create('.banner-theme.is-demo.blank', { maxWidth: 320, radius: false, behavior: 'hide'});

    // NICE TOOLTIPS FOR SMS PAYMENT BUTTONS
    Tipped.create('.sms-payments a', { maxWidth: 140, radius: false, behavior: 'hide'});
 }


  // FANCY BOX FUNCTIONALITY FOR IMAGES ON ITEM PAGE
  $("a[rel=image_group]").fancybox({
    'padding': 0,
    'openEffect' : 'elastic',
    'closeEffect' : 'elastic',
    'nextEffect' : 'fade',
    'prevEffect' : 'fade',
    'loop' : false,
    'margin': [20, 20, 55, 20],
    'helpers' : { title : {type : 'inside'} },
    'buttons': ["zoom","share","slideShow","fullScreen","download","thumbs","close"],
  });




  // RECAPTCHA WIDTH FIX
  var wi = $('#recaptcha_image').width();
  $('#recaptcha_image, #recaptcha_image img').css('max-width', wi + 'px');




  // SEARCH LIST IMG CLICK - CHANGE SOURCE
  $(document).on('click', '.small-img', function(e){
    // Without fade effect
    //$(this).parent().siblings('.big-img').find('img').attr('src', $(this).find('img').prop('src'));

    // With fade effect
    var small_img_wrapper = $(this).parent();
    var small_img = $(this).find('img');
    var small_img_src = $(this).find('img').prop('src');
    var big_img = $(this).parent().siblings('.big-img').find('img');

    big_img.fadeOut(200, function() { 
      big_img.attr('src', small_img_src);
    }).fadeIn(200);

    small_img_wrapper.find('.small-img').removeClass('selected');
    $(this).addClass('selected');
  });



  // --------------------------------------------------------
  // ADDITIONAL SCRIPTS FOR RESPONSIVE DESIGN: 0 - 1200px
  // --------------------------------------------------------

  if (($(window).width() + scrollCompensate()) <= 1200) {

    // // SEARCH PAGE - SORT FUNCTIONALITY
    // $('body').on('click', '.sort-it .sort-title', function(e) {
    //   $(this).stop( true, true ).toggleClass('hovered');
    //   $(this).find('#sort-wrap').stop(true,true).fadeToggle(0);
    //   $('.sort-it').toggleClass('opened');
    // });

    // $(document).click(function(event) { 
    //   if(!$(event.target).closest('.sort-it .sort-title').length) {
    //     if($('.sort-it .sort-title #sort-wrap').is(":visible")) {
    //       $('.sort-it .sort-title #sort-wrap').hide();
    //       $('.sort-it .sort-title').stop( true, true ).toggleClass('hovered');
    //       $('.sort-it').toggleClass('opened');
    //     }
    //   }        
    // });


    // CORRECT INPUT TYPES
    // $('input#zip, input#price').prop('type', 'number');
    $('input#contactEmail, input#yourEmail, input#friendEmail, input#s_email, input#new_email, input#authorEmail').prop('type', 'email');
    $('input#s_phone_mobile, input#s_phone_land').prop('type', 'tel');



    // ITEM PAGE - REPORT BUTTON
    $('#report').click(function(){
      $(this).stop( true, true ).toggleClass('hovered');
      $(this).find('.cont-wrap').stop(true,true).fadeToggle(0);
      $(this).toggleClass('opened');
    });

    $(document).click(function(event) { 
      if(!$(event.target).closest('#report').length) {
        if($('#report .cont-wrap').is(":visible")) {
          $('#report .cont-wrap').hide();
          $('#report').stop( true, true ).toggleClass('hovered');
          $('#report').toggleClass('opened');
        }
      }        
    });



    // MB TOOL BOX FUNCTIONALITY
    $('#lang-open-box, .top-info').click(function(){
      $(this).stop( true, true ).toggleClass('hovered');
      $(this).find('.mb-tool-wrap').stop(true,true).fadeToggle(0);
      $(this).toggleClass('opened');
    });

    $(document).click(function(event) { 
      if(!$(event.target).closest('#lang-open-box').length) {
        if($('#lang-open-box .mb-tool-wrap').is(":visible")) {
          $('#lang-open-box .mb-tool-wrap').hide();
          $('#lang-open-box').stop( true, true ).toggleClass('hovered');
          $('#lang-open-box').toggleClass('opened');
        }
      }        
    });

    $(document).click(function(event) { 
      if(!$(event.target).closest('.top-info').length) {
        if($('.top-info .mb-tool-wrap').is(":visible")) {
          $('.top-info .mb-tool-wrap').hide();
          $('.top-info').stop( true, true ).toggleClass('hovered');
          $('.top-info').toggleClass('opened');
        }
      }        
    });


    
    // USER LINKS - HEADER
    $('.top-my').click(function(){
      $(this).stop( true, true ).toggleClass('hovered');
      $(this).find('.my-wrap').stop(true,true).fadeToggle(0);
      $(this).toggleClass('opened');
    });

    $(document).click(function(event) { 
      if(!$(event.target).closest('.top-my').length) {
        if($('.top-my .my-wrap').is(":visible")) {
          $('.top-my .my-wrap').hide();
          $('.top-my').stop( true, true ).toggleClass('hovered');
          $('.top-my').toggleClass('opened');
        }
      }        
    });



    // HEADER FUNCTIONALITY
    $('#uniform-sCategory').click(function(){
      $(this).stop( true, true ).toggleClass('hovered');
      $(this).find('#inc-cat-box').stop(true,true).fadeToggle(0);
      $(this).find('#inc-cat-list').css('overflow-y', 'scroll');
      $(this).toggleClass('opened');
    });

    $(document).click(function(event) { 
      if(!$(event.target).closest('#uniform-sCategory').length) {
        if($('#uniform-sCategory #inc-cat-box').is(":visible")) {
          $('#uniform-sCategory #inc-cat-box').hide();
          $('#uniform-sCategory').stop( true, true ).toggleClass('hovered');
          $('#uniform-sCategory').toggleClass('opened');
        }
      }        
    });

  } 



  // --------------------------------------------------------
  // ADDITIONAL SCRIPTS FOR RESPONSIVE DESIGN: 1201px or more
  // --------------------------------------------------------

  if (($(window).width() + scrollCompensate()) > 1200) {

    // HEADER FUNCTIONALITY
    $('#uniform-sCategory').hover(function() {
      $(this).find('#inc-cat-box').stop(true, true).fadeIn(time);
      $(this).find('#inc-cat-list').css('overflow-y', 'scroll');
    }, function() {
      $(this).find('#inc-cat-box').stop(true, true).delay(delay).fadeOut(time);
    });



    // OPTION BUTTON IN HEADER
    $('.top-my').hover(function(){
      $(this).stop( true, true ).addClass('hovered');
      $(this).find('.my-wrap').stop(true,true).fadeIn(200);
      $(this).find('.my-wrap').css('overflow', 'visible');
      $(this).css('z-index', '99999');
      $(this).addClass('hovered');

    }, function(){
      $(this).find('.my-wrap').stop( true, true ).delay(700).fadeOut(200);
      $(this).find('.my-wrap').css('overflow', 'visible');
      $(this).css('z-index', '9999');

      $(this).delay(700).queue(function() { $(this).removeClass('hovered'); $(this).dequeue(); });
    });



    // SORTING FUNCTIONALITY
    $('#search-sort').on('mouseenter', '.sort-title', function() {
      $(this).stop( true, true ).addClass('hovered');
      $(this).find('#sort-wrap').stop(true,true).fadeIn(200);
      $(this).find('#sort-wrap').css('overflow', 'visible');
      $(this).css('z-index', '99999');
    }).on('mouseleave', '.sort-title', function() {
      $(this).find('#sort-wrap').stop( true, true ).delay(700).fadeOut(200);
      $(this).find('#sort-wrap').css('overflow', 'visible');
      $(this).css('z-index', '9999');

      $(this).delay(700).queue(function() { $(this).removeClass('hovered'); $(this).dequeue(); });
    });



    // MB TOOL BOX FUNCTIONALITY
    $('#lang-open-box, .top-info').hover(function(){
      $(this).stop( true, true ).addClass('hovered');
      $(this).find('.mb-tool-wrap').stop(true,true).fadeIn(200);
      $(this).find('.mb-tool-wrap').css('overflow', 'visible');
      $(this).css('z-index', '99999');
    }, function(){
      $(this).find('.mb-tool-wrap').stop( true, true ).delay(700).fadeOut(200);
      $(this).find('.mb-tool-wrap').css('overflow', 'visible');
      $(this).css('z-index', '9998');

      $(this).delay(700).queue(function() { $(this).removeClass('hovered'); $(this).dequeue(); });
    });



    // ITEM PAGE - REPORT BUTTON
    $('#report').hover(function(){
      $(this).stop( true, true ).addClass('hovered');
      $(this).find('.cont-wrap').stop(true,true).fadeIn(200);
      $(this).find('.cont-wrap').css('overflow', 'visible');
      $(this).css('z-index', '99999');
      $(this).addClass('hovered');

    }, function(){
      $(this).find('.cont-wrap').stop( true, true ).delay(700).fadeOut(200);
      $(this).find('.cont-wrap').css('overflow', 'visible');
      $(this).css('z-index', '9999');

      $(this).delay(700).queue(function() { $(this).removeClass('hovered'); $(this).dequeue(); });
    });

  }




  // --------------------------------------------------------
  // ADDITIONAL SCRIPTS FOR RESPONSIVE DESIGN: 0 - 767px
  // --------------------------------------------------------

  if (($(window).width() + scrollCompensate()) <= 767) {

    // HEADER OPTIONS BUTTON
    $('.top-my').hover(function(){
      $(this).stop( true, true ).addClass('hovered');
      $(this).find('.my-wrap').stop(true,true).fadeIn(0);
      $(this).find('.my-wrap').css('overflow', 'visible');
      $(this).css('z-index', '99999');
      $(this).addClass('hovered');

    }, function(){
      $(this).find('.my-wrap').stop( true, true ).delay(0).fadeOut(0);
      $(this).find('.my-wrap').css('overflow', 'visible');
      $(this).css('z-index', '9999');

      $(this).delay(0).queue(function() { $(this).removeClass('hovered'); $(this).dequeue(); });
    });



    // SIMPLE SELECT TRANSFORM TO CLASSIC SELECT
    $('.simple-select').each(function(){
      var block = $(this);
      var html = '';

      if( block.find('input[type="hidden"]').length ) {
        html += '<select class="text" name="' + block.find('input[type="hidden"]').attr('name') + '">';
      } else {
        html += '<select class="text">';
      }

      block.find('.list > div:not(.info)').each(function(){
        var selected = '';

        if($(this).hasClass('selected')) {
          selected = ' selected="selected"';
        }

        html += '<option value="' + $(this).attr('data-id') + '"' + selected + '>' + $(this).text() + '</option>';
      });

      html += '</select>';

      block.append(html);
      block.find('input[type="hidden"], span.text, div.list').remove();
      //block.prev('i').remove();
    });


    // ON MOBILE DEVICES WHEN CLICK ON HOMEPAGE CATEGORY, SCROLL TO SUBCATEGORY LIST
    $("#home-cat .top li a").click(function(event) {
      if(event.originalEvent !== undefined) {
        $('html, body').animate({
          scrollTop: $('.cat-box').offset().top
        }, 1000);
      }
    });


  // DISABLE CREATING FANCYBOX ON IMAGE CLICK FOR MOBILE VIEW
    $("").click(function(e){
      e.preventDefault();
      return false;
    });
  }


  // SEARCH PAGE - FILTER BY ALL / COMPANY / PERSONAL
  $('.user-company-change > div').click(function() {
    if($(this).hasClass('all')) {
      $('input#sCompany').val('').change();
    }

    if($(this).hasClass('individual')) {
      $('input#sCompany').val(0).change();
    }

    if($(this).hasClass('company')) {
      $('input#sCompany').val(1).change();
    }

    if( ajaxSearch == 1 ) {
      $('.user-company-change > div').removeClass('active');
      $(this).addClass('active');
    } 

    if( ajaxSearch != 1 ) {
      $('input#cookieAction').val('done');
      $('#sidebar-search form.search-side-form').submit();
    }
  });



  // RICHEDIT PLUGIN FIX FOR RESPONSIVE DESIGN AND ONE MORE FIX
  if($('.mceLayout').length) {
    $('.mceLayout').css('width', '100%');
  }

  $('a.MCtooltip').click(function(){
    return false;
  });

  $('a.MCtooltip').contents().filter(function(){ return this.nodeType === 3; }).remove();


  $('body').on('click', '#tip_close2, .ico-close', function(e){
    e.preventDefault();
    $("#flashmessage").fadeOut(200);
  });



  // USER MENU HIGHLIGHT ACTIVE
  var url = window.location.toString();

  $('.user_account #sidebar li a').each(function(){
    var myHref= $(this).attr('href');
    if( url == myHref) {
      $(this).parent('li').addClass('active');
    }
  });



  // ADD - EDIT LISTING - ALLOW ONLY DECIMALS IN PRICE INPUT
//   $('.add_item input#price').keypress(function(event) {
//     if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
//       event.preventDefault();
//     }
//   });



  // CHECK IF IS TOUCH DEVICE
  function is_touch_device() {
    return true == ("ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch);
  }


  
  // IDTABS - MULTI LINE FIX
  function idTabsMultiLine(){
    if( $('ul.tabbernav').height() > 55 ) {
      setTimeout(function(){ 
        $('ul.tabbernav').addClass('multi-line');
      }, 500);

      setTimeout(function(){ 
        $('ul.tabbernav').addClass('multi-line');
      }, 3000);
    }
  }



  // CALCULATE SCROLL WIDTH
  function scrollCompensate() {
    var inner = document.createElement('p');
    inner.style.width = "100%";
    inner.style.height = "200px";

    var outer = document.createElement('div');
    outer.style.position = "absolute";
    outer.style.top = "0px";
    outer.style.left = "0px";
    outer.style.visibility = "hidden";
    outer.style.width = "200px";
    outer.style.height = "150px";
    outer.style.overflow = "hidden";
    outer.appendChild(inner);

    document.body.appendChild(outer);
    var w1 = inner.offsetWidth;
    outer.style.overflow = 'scroll';
    var w2 = inner.offsetWidth;
    if (w1 == w2) w2 = outer.clientWidth;

    document.body.removeChild(outer);

    return (w1 - w2);
  }



  // SCROLL TOP PLUGIN
  if($("#back-top-left").length && ($(window).width() + scrollCompensate()) > 767) {
    $("#back-top-left").hide();
    $(function () {
      $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
          $('#back-top-left').fadeIn();
        } else {
          $('#back-top-left').fadeOut();
        }
      });
      $('#back-top-left a').click(function () {
        $('body,html').animate({
          scrollTop: 0
        }, 800);
        return false;
      });
    });
  }


  if($("#back-top-right").length && ($(window).width() + scrollCompensate()) > 767) {
    $("#back-top-right").stop(true, true).hide(0);

    $(function () {
      $(window).scroll(function(e) {
        if ($(this).scrollTop() > 100) {
          $('#back-top-right').stop(true, true).fadeIn(0);
        } else {
          $('#back-top-right').stop(true, true).fadeOut(0);
        }
      });

      $('#back-top-right a').click(function(e) {
        e.preventDefault();

        $('body,html').animate({
          scrollTop: 0
        }, 600);
        return false;
      });
    });
  }

  // DO NOT FADE WHEN RESPONSIVE
  if(($(window).width()+scrollCompensate()) > 767) {
    var time = 200;
    var delay = 500;
  } else {
    var time = 0;
    var delay = 0;
  }


  // SEARCH - CLEAR COOKIES AND INPUTS
  $('.clear-cookie').click(function(e){
    e.preventDefault()

    $.ajax({
      url: baseAjaxUrl + "&clearCookieAll=done",
      type: "GET",
      success: function(response){
        //alert(response);
        $("#location-picker, #item-picker").removeClass('searching');
      }
    });


    $('#header-search, #sidebar-search, #menu-search .search-mobile').find('input[name!="page"]').val("");
    $('#header-search .simple-select, #sidebar-search .simple-select, #menu-search .search-mobile .simple-select').each(function(){
      $(this).find('.text span').text( $(this).find('.list .option.bold').text() );
    });

    $('#header-search input[type="checkbox"], #sidebar-search input[type="checkbox"], #menu-search .search-mobile input[type="checkbox"]').attr('checked', false);
    $('#header-search select, #sidebar-search select, #menu-search .search-mobile select').val('');
    $('#header-search select, #sidebar-search select, #menu-search .search-mobile select').each(function(){
      $(this).find('option').attr('selected', false);
    });


    var originalUrl = window.location.href;
    var newUrl = baseDir;

    if( originalUrl.indexOf('?page=search') !== -1 ) {
      newUrl = baseSearchUrl;
    }

    if( originalUrl.indexOf(searchRewrite) !== -1 ) {
      newUrl = baseSearchUrl;
    }

    window.history.pushState(null, null, newUrl);

    $('#cookieAction, #cookieActionMobile').val('done');
  });

  // ITEM LIGHTBOX
//   if (typeof $.fn.lightGallery !== "undefined") {
//     $(".bx-slider").lightGallery({
//       mode: "lg-slide",
//       thumbnail: true,
//       cssEasing: "cubic-bezier(0.25, 0, 0.25, 1)",
//       selector: "a",
//       getCaptionFromTitleOrAlt: false,
//       download: false,
//       thumbWidth: 90,
//       thumbContHeight: 80,
//       share: false,
//     });
//   }

//   // ITEM BX SLIDER
//   if (typeof $.fn.bxSlider !== "undefined") {
//     $(".bx-slider").bxSlider({
//       slideWidth: $(window).outerWidth(),
//       infiniteLoop: false,
//       slideMargin: 0,
//       pager: true,
//       pagerCustom: ".item-bx-pager",
//       infiniteLoop: true,
//       nextText: "",
//       prevText: "",
//     });

//     if ($("ul.bx-slider").find("li").length <= 1) {
//       $(".bx-controls").hide(0);
//     }
//   }
});


function getMobileOperatingSystem() {
  var userAgent = navigator.userAgent || navigator.vendor || window.opera;
  var device = '';
  var browser = '';

  if (/windows phone/i.test(userAgent)) {
    device = "device-windows-phone";
  } else if (/android/i.test(userAgent)) {
    device = "device-android";
  } else if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
    device = "device-ios";
  } else {
    device = "device-other";
  }

  if($.browser.msie) {
    browser = "browser-msie";
  } else if($.browser.mozilla) {
    browser = "browser-mozilla";
  } else if($.browser.opera) {
    browser = "browser-opera";
  } else if($.browser.safari) {
    browser = "browser-safari";
  } else if($.browser.webkit) {
    browser = "browser-webkit";
  } else {
    browser = "browser-other";
  }

  return device + " " + browser;
}



// PAGINATION FONTAWESOME FIX FOR NEXT, LAST, PREV AND FIRST
function stelaAjaxReload(){
  $('.searchPaginationNext').html('<i class="fa fa-angle-right"></i>');
  $('.searchPaginationLast').html('<i class="fa fa-angle-double-right"></i>');
  $('.searchPaginationPrev').html('<i class="fa fa-angle-left"></i>');
  $('.searchPaginationFirst').html('<i class="fa fa-angle-double-left"></i>');


  // CREATE NICE CHECKBOXES FOR HOOKED CHECKBOXES
  $('#sidebar-search input[type="checkbox"]').each(function(){
    if(!$(this).parent().hasClass('input-box-check')) {
      var cont = $(this).parent().html();
      $(this).parent().html('<div class="input-box-check">' + cont + '</div>');
    }
  });


  // CREATE NICE BOXES FOR HOOKED INPUTS
  $('#sidebar-search input[type="text"], #sidebar-search input[type="number"]').each(function(){
    if($(this).prop('placeholder') == '') {
      $(this).prop('placeholder', $(this).prev().text());
    }

    if(!$(this).parent().hasClass('input-box')) {
      var cont = $(this).parent().html();
      $(this).parent().html('<div class="input-box">' + cont + '</div>');
    }
  });


  // SELECT BOXES
  $('#sidebar-search select').each(function(){
    if($(this).find('option:first-child').text() == '') {
      $(this).find('option:first-child').text($(this).prev().text());
    }
  });
}


// ITEM POST FIX CHECKBOXES
function stelaPublishAjax() {
  // CREATE NICE CHECKBOXES FOR HOOKED CHECKBOXES ON ITEM POST/EDIT
  $('#post-hooks input[type="checkbox"]').each(function(){
    if(!$(this).parent().hasClass('input-box-check')) {
      var cont = $(this).parent().html();
      $(this).parent().html('<div class="input-box-check">' + cont + '</div>');
    }
  });
}

// text field empty check
function btnDisabled() {
$('#sPattern').on('keypress keyup keydown', function () { 
  if ($('#sPattern').val() == "" ) { 
    $('#home-button').prop('disabled', true); 
  } 
  else {   
    $('#home-button').prop('disabled', false); 
  } 
});}

// CHECK IF PAGE IS LOADED IN IFRAME
function stelaInFrame() {
  try {
    return window.self !== window.top;
  } catch (e) {
    return true;
  }
}

// CUSTOM MODAL BOX
function epsModal(opt) {
  width = (typeof opt.width !== 'undefined' ? opt.width : 480);
  height = (typeof opt.height !== 'undefined' ? opt.height : 480);
  content = (typeof opt.content !== 'undefined' ? opt.content : '');
  wrapClass = (typeof opt.wrapClass !== 'undefined' ? ' ' + opt.wrapClass : '');
  closeBtn = (typeof opt.closeBtn !== 'undefined' ? opt.closeBtn : true);
  iframe = (typeof opt.iframe !== 'undefined' ? opt.iframe : true);
  fullscreen = (typeof opt.fullscreen !== 'undefined' ? opt.fullscreen : false);
  transition = (typeof opt.transition !== 'undefined' ? opt.transition : 200);
  delay = (typeof opt.delay !== 'undefined' ? opt.delay : 0);
  lockScroll = (typeof opt.lockScroll !== 'undefined' ? opt.lockScroll : true);

  var id = Math.floor(Math.random() * 100) + 10;
  width = epsAdjustModalSize(width, 'width') + 'px';
  height = epsAdjustModalSize(height, 'height') + 'px';

  var fullscreenClass = '';
  if(fullscreen === 'mobile') {
    if (($(window).width() + scrollCompensate()) < 768) {
      width = 'auto'; height = 'auto'; fullscreenClass = ' modal-fullscreen';
    }
  } else if (fullscreen === true) {
    width = 'auto'; height = 'auto'; fullscreenClass = ' modal-fullscreen';
  }

  var html = '';
  html += '<div class="modal-cover" data-modal-id="' + id + '" onclick="epsModalClose(\'' + id + '\');"></div>';
  html += '<div id="epsModal" class="modal-box' + wrapClass + fullscreenClass + '" style="width:' + width + ';height:' + height + ';" data-modal-id="' + id + '">';

  if(closeBtn) {
    html += '<div class="modal-close-alt" onclick="epsModalClose(\'' + id + '\');"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="32px" height="32px"><path fill="currentColor" d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z" class=""></path></svg></div>';
  }

  html += '<div class="modal-inside">';

  if(closeBtn) {
    html += '<div class="modal-close" onclick="epsModalClose(\'' + id + '\');"></div>';
  }

  html += '<div class="modal-body ' + (iframe === true ? 'modal-is-iframe' : 'modal-is-inline') + '">';

  if(iframe === true) {
    html += '<div class="modal-content"><iframe class="modal-iframe" data-modal-id="' + id + '" src="' + content + '"/></div>';
  } else {
    html += '<div class="modal-content">' + content + '</div>';
  }

  html += '</div>';
  html += '</div>';
  html += '</div>';

  if(lockScroll) {
    $('body').css('overflow', 'hidden');
  }

  $('body').append(html);
  $('div[data-modal-id="' + id + '"].modal-cover').fadeIn(transition);
  $('div[data-modal-id="' + id + '"].modal-box').delay(delay).fadeIn(transition);
}


// Close modal by clicking on close button
function epsModalClose(id = '', elem = null) {
  if(id == '') {
    id = $(elem).closest('.modal-box').attr('data-modal-id');
  }

  $('body').css('overflow', 'initial');
  $('div[data-modal-id="' + id + '"]').fadeOut(200, function(e) {
    $(this).remove();
  });

  return false;
}


// Close modal by some action inside iframe
function epsModalCloseParent() {
  var boxId = $(window.frameElement, window.parent.document).attr('data-modal-id');
  window.parent.epsModalClose(boxId);
}


// Calculate maximum width/height of modal in case original width/height is larger than window width/height
function epsAdjustModalSize(size, type = 'width') {
  var size = parseInt(size);
  var windowSize = (type == 'width' ? $(window).width() : $(window).height());

  if(size <= 0) {
    size = (type == 'width' ? 640 : 480);
  }

  if(size*0.9 > windowSize) {
    size = windowSize*0.9;
  }

  return Math.floor(size);
}

// CALCULATE SCROLL WIDTH
function scrollCompensate() {
  var inner = document.createElement('p');
  inner.style.width = "100%";
  inner.style.height = "200px";

  var outer = document.createElement('div');
  outer.style.position = "absolute";
  outer.style.top = "0px";
  outer.style.left = "0px";
  outer.style.visibility = "hidden";
  outer.style.width = "200px";
  outer.style.height = "150px";
  outer.style.overflow = "hidden";
  outer.appendChild(inner);

  document.body.appendChild(outer);
  var w1 = inner.offsetWidth;
  outer.style.overflow = 'scroll';
  var w2 = inner.offsetWidth;
  if (w1 == w2) w2 = outer.clientWidth;

  document.body.removeChild(outer);

  return (w1 - w2);
}

