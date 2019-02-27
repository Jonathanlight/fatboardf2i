var $ = require('jquery');
var AOS = require('aos');

// Main JS
$(document).ready(function () {
  $(function() {

    // AOS
    AOS.init();

    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Datepicker
    $('.jsdatepicker').datetimepicker({
      locale: 'fr',
      format: 'DD.MM.YYYY'
    });

    // Timepicker
    $('.jstimepicker').datetimepicker({ format: 'HH:mm' });

    // Menu
    var linkMenuMiddle = $('.link-menu-middle');
    linkMenuMiddle.click(function() {
      $('.aside-middle-wrap').toggleClass('active');
      $('.main-middle-wrap').toggleClass('active');
    });

    // Btn filter
    var linkFilterForm = $('.btn-filter');
    linkFilterForm.click(function() {
      $(this).toggleClass('active');
      $('.form-section').slideToggle();
    });

    var messageFlash = $('#messageFlash');
    messageFlash.css("display", "none");

    $("[data-delete-url]").click(function(){
        if (confirm("Confirmer la suppression")) {
            $.ajax({
                method: "DELETE",
                url: $(this).attr('data-delete-url'),
                success: function(data) {
                    messageFlash.html(data);
                    messageFlash.slideUp();
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error: ');
                    console.log(data);
                }
            });
        }
    });

  });
});
