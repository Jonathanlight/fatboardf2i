var $ = require('jquery');

$(document).ready(function () {
    var selectorPlace = document.getElementById('course_place');
    var price_min = document.getElementById('price_min');
    if (selectorPlace) {
        AutoSelect(selectorPlace, price_min);
    }

    bindCourseEnable();
});

function AutoSelect(cyble, price_min) {
    cyble.change(function() {
        $.ajax({
            type: 'GET',
            url: '/api/place/' + this.value + '/minPrice',
            success: function(data) {
                price_min.value = data;
            }
        });
    });
}

function bindCourseEnable() {
    $('input[type="checkbox"].slider').change(function() {
        if($(this).is(':checked')) {
            $.ajax({
                type: 'PUT',
                url: $(this).attr('data-url-course-enable')
            });
        } else {
            $.ajax({
                type: 'PUT',
                url: $(this).attr('data-url-course-disable')
            });
        }
    });
}
