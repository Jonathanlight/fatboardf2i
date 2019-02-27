var Course = {
    geoSearch: function(container){
        let url = container.data('url');

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);

            function successCallback(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                    active: 1
                };

                $.post({
                    url: url,
                    data: geolocation,
                    context: container,
                })
                    .done(function (response) {
                        $(this).html(response);
                        initCarousel();
                    });
            }

            function errorCallback() {
                var geolocation = {
                    lat: 0,
                    lng: 0,
                    active: 0
                };

                $.post({
                    url: url,
                    data: geolocation,
                    context: container
                })
                    .done(function (response) {
                        $(this).html(response);
                        initCarousel();
                    });
            }
        }
    }
};

function initCarousel(){
    $('.carousel-proposition').owlCarousel({
        loop:true,
        margin:40,
        nav:true,
        autoplay:true,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
            768:{
                items:2
            },
            1024:{
                items:3
            },
            1280:{
                items:4
            }
        }
    });
}

module.exports = Course;