var $ = require('jquery');

$(document).ready(function () {
    $('#cancel-order').click(function(){
        var source = {};
        var dataSource = null;
        $('#lists-orders').find('tr').each(function () {
            var row = $(this);
            if(row.find('.checkbox_user_order').is(':checked')) {
                dataSource = parseInt(row.find('.checkbox_user_order').attr('data-id-cancel'));
                source[dataSource] = dataSource;
            }
        });

        $.ajax({
            type: 'PUT',
            url: $('#cancel-order').attr('data-url-cancel-order'),
            data: {ids: source},
            success: function() {
                window.location.reload();
            }
        });
        
    });


    $('#selectCssr').change(function(){
        var row = $(this);
        $.ajax({
            type: 'PUT',
            url: '/api/user/center/' + row.val()
        });
    });
});
