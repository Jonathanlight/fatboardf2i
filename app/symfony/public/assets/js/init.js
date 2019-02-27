$(document).ready(function(){
    $(".button-collapse").sideNav();

    $('.parallax').parallax();
    $('.collapsible').collapsible();
    $('.datepicker').datepicker();
    $('select').formSelect();

    $('.modal').modal();

    $('#modal_password_notFound').modal({
        dismissible: true, // Modal can be dismissed by clicking outside of the modal
        opacity: .5, // Opacity of modal background
        inDuration: 300, // Transition in duration
        outDuration: 200, // Transition out duration
        startingTop: '4%', // Starting top style attribute
        endingTop: '10%'
    });

    $('#listeBoutons').on('click', 'a', function(event) {
        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top
        }, 700);
    });

    $('#menu-presta').on('click', 'a', function(event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top
        }, 700);
    });

    $('.close').click(function() {
        $('.ad').hide();
    })
});