var $ = require('jquery');
var AOS = require('aos');
var Rellax = require('rellax');
var Course = require('./course');

// Main JS
$(document).ready(function () {
  $(function() {

    $('.cheaper-courses').each(function (){
        Course.geoSearch($(this));
    });

    // Responsive
    var jBody = $('body');
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
      jBody.addClass('touch-device');
    }

    // Fix Input Iphone
    if (/iPhone/.test(navigator.userAgent) && !window.MSStream) {
      $('input, textarea, select').mousedown(function(){
        $('meta[name=viewport]').remove();
        $('head').append('<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=0">');
      })

      $('input, textarea, select').focusout(function(){
        $('meta[name=viewport]').remove();
        $('head').append('<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">' );
      })
    }

    // CMS Nav
    var linkNav = $('.cms-nav a');
    linkNav.click(function(e) {
      e.preventDefault();

      $('html, body').animate({
        scrollTop: $($(this).attr('href')).offset().top - 10
      }, 500);
      linkNav.not(this).parent().removeClass('active');
      $(this).parent().toggleClass('active');
    });

    // AOS
    AOS.init();

    // Rellax
    if ($('.rellax').length > 0) {
      var rellax = new Rellax('.rellax', { speed: -0.5 });
    }

    // Datepicker
    $('.jsdatepicker').datetimepicker({
      locale: 'fr',
      format: 'DD.MM.YYYY'
    });

    // Timepicker
    $('.jstimepicker').datetimepicker({ format: 'HH:mm' });

    // Carousel Testimonials
    $('.carousel-testimonials').owlCarousel({
      loop:true,
      margin:60,
      nav:true,
      rtl:true,
      autoplay:true,
      responsive:{
        0:{
          items:1,
          autoWidth:false,
          rtl:false
        },
        768:{
          items:1,
          rtl:true
        },
        1024:{
          autoWidth:true,
          rtl:true
        }
      }
    });

    // CMS Table
    $( ".cms-wrap table" ).wrap('<div class="table-responsive"></div>');

    // Swipe Carousel
    $('#carousel').hammer().on('swipeleft', function(){
      $(this).carousel('next');
    });
    $('#carousel').hammer().on('swiperight', function(){
      $(this).carousel('prev');
    });

    // Btn back to top
    var scrollTrigger = 100, // px
    backToTop = function () {
        var scrollTop = $(window).scrollTop();
        if (scrollTop > scrollTrigger) {
            $('.btn-top').fadeIn();
        } else {
            $('.btn-top').fadeOut();
        }
    };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('.btn-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });

    // Tooltip
    $('[data-toggle="tooltip"]').tooltip({container: 'body'});

    // Btn Menu
    var btnMenu = $('.btn-menu');
    btnMenu.click(function() {
      $('.btn-menu').toggleClass('active');
      $('body').toggleClass('menu-open');
      $('.main-wrap').toggleClass('menu-open');
      $('.header-nav-mobile').toggleClass('menu-open');
    });

    // Btn Menu
    var linkDetail = $('.link-detail');
    linkDetail.click(function() {
      $(this).toggleClass('active');
      $(this).parent().parent().parent().parent().find('.search-detail-block').slideToggle();
      $(this).parent().parent().parent().parent().parent().toggleClass('active');

      if ($(this).hasClass('active') && $(window).width() < 768) {
        $('html, body').animate({
          scrollTop: $($(this).parent().parent().parent().parent().find('.search-detail-block')).offset().top
        }, 500);
      }

    });

    // Link Sorts
    var linkSorts = $('.link-sorts');
    linkSorts.click(function() {
      $('.link-filter').removeClass('active');
      $('.search-title-block .aside-block').hide();
      $(this).toggleClass('active');
      $('.form-sorts').slideToggle();
    });

    // Link Filter
    var linkFilters = $('.link-filter');
    linkFilters.click(function() {
      $('.link-sorts').removeClass('active');
      $('.form-sorts').hide();
      $(this).toggleClass('active');
      $('.search-title-block .aside-block').slideToggle();
    });

    // Permis
    var linkPermis = $('.permis-nav ul li:first-child label');
    linkPermis.click(function() {
      $('.row-new-format').hide();
      $('.row-old-format').show();
      if ($(window).width() < 768) {
        $('html, body').animate({
          scrollTop: $($('.row-old-format')).offset().top - 20
        }, 500);
      }
    });

    var linkPermisNew = $('.permis-nav ul li:last-child label');
    linkPermisNew.click(function() {
      $('.row-old-format').hide();
      $('.row-new-format').show();
      if ($(window).width() < 768) {
        $('html, body').animate({
          scrollTop: $($('.row-new-format')).offset().top - 20
        }, 500);
      }
    });

    // Hover Form
    // Input
    var formInput = $('.form-order-permis .form-control');
    formInput.hover(
      function() {
        $(this).parent().addClass( "hover" );
      }, function() {
        $(this).parent().removeClass( "hover" );
      }
    );

    formInput.focus(function(){
      $(this).parent().addClass( "selected" );
    }).blur(function(){
      $(this).parent().removeClass( "selected" );
    });


    // Select
    var formSelect = $('.form-order-permis select.form-control');

    formSelect.hover(
      function() {
        $( this ).parent().parent().parent().parent().parent().addClass( "hover" );
      }, function() {
        $( this ).parent().parent().parent().parent().parent().removeClass( "hover" );
      }
    );

    // Indicator
    var formIndicateur = $('.row-old-format .form-group .form-control');
    formIndicateur.hover(
      function() {
        var idLink = $(this).data('parent');
        $('.indicator-permis').each(function(){
          if( $(this).attr('data-child') == idLink ){
            $(this).addClass( "active" );
          }
        });
      }, function() {
        var idLink = $(this).data('parent');
        $('.indicator-permis').each(function(){
          if( $(this).attr('data-child') == idLink ){
            $(this).removeClass( "active" );
          }
        });
      }
    );

    formIndicateur.hover(
      function() {
        var idLink = $(this).data('parent');
        $('.indicator-permis').each(function(){
          if( $(this).attr('data-child') == idLink ){
            $(this).addClass( "selected" );
          }
        });
      }, function() {
        var idLink = $(this).data('parent');
        $('.indicator-permis').each(function(){
          if( $(this).attr('data-child') == idLink ){
            $(this).removeClass( "selected" );
          }
        });
      }
    );

    // Faq
    var linkFaq = $('.faq-link');
    linkFaq.click(function() {
      $(this).toggleClass('active');
      $(this).parent().find('.faq-text').slideToggle();
    });

    // Link Stage
    $('.form-order-stage-content input:radio:checked').parent().addClass("active");
    var inputStage = $('.form-order-stage-content input:radio');
    inputStage.change(function(){
      if($(this).is(":checked")) {
        $('.form-order-stage-content .form-radio.active').removeClass("active");
        $(this).parent().addClass("active");
      }
    });
  });
});
