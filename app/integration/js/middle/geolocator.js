var $ = require('jquery');

// locator JS
$(document).ready(function () {
    if (document.querySelector('.autocomplete') !== null) {
        initAutocomplete();
        offAutocomplet(document.querySelector('.autocomplete'));
    }
});

let autocomplete;
const componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    administrative_area_level_2: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
};

function offAutocomplet(cyble) {
    setTimeout(function(){ cyble.setAttribute("autocomplete", "null"); }, 1000);
}

function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(
        (document.getElementsByClassName('autocomplete')[0]),
        {
            types: ['geocode'],
            componentRestrictions: {country: 'fr'}
        }
    );

    autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
    var place = autocomplete.getPlace();

    var lat = place.geometry.location.lat(),
        lng = place.geometry.location.lng();

    $(".latitude").val(lat);
    $(".longitude").val(lng);

    for (var component in componentForm) {
        document.getElementsByClassName(component).value = '';
        document.getElementsByClassName(component).disabled = false;
    }

    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];

        if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            console.log(val);
            $("."+addressType).val(val);
            document.getElementsByClassName(addressType).value = val;
        }
    }
}

function geolocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
            });

            autocomplete.setBounds(circle.getBounds());
        });
    }
}