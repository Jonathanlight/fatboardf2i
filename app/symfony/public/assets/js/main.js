$(document).ready(function(){
    loadAjaxForm();
});

function loadAjaxForm()
{
    $('body').on('submit', '.formGain', function (e) {
        e.preventDefault();

        var reference = $('#lot_user_reference').val();
        var code = $('#lot_user_code').val();
        var user = $('#lot_user').val();

        $.ajax({
            type: $(this).attr('method'),
            url: '/api/gains',
            data: {
                'reference': reference,
                'code': code,
                'user': user
            },
            success: function(data, status, xhr){

                if (xhr.status !== 204) {
                    $('#popMessages').html('<span id="msgError" class="red-text padding-4">' + JSON.stringify(data) + '</span>');
                    setInterval(function(){ $('#msgError').hide() }, 5000);
                } else {
                    $('#popMessages').html('<span id="msgSuccess" class="green-text padding-4"> Ticket Valide</span>');
                    setInterval(function(){ $('#msgSuccess').hide() }, 5000);
                }

                location.reload();
            }
        });
    });
}