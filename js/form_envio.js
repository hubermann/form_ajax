function initContactForm() {

    $('#contactform').submit(function() { // atencion al nombre del ID que se dice aca

        var action = $(this).attr('action');
        var values = $(this).serialize(); // agarramos la informacion del form y cargamos en una sola variable
        $('#contactform #submit').attr('disabled', 'disabled').after('<img src="img/ajax-loader.gif" class="loader" />');
        $("#message").slideUp(750, function() { 
            $('#message').hide();
            $.post(action, values, function(data) {
			if (data == '1'){ // AcÃ¡ redireccionamos a la pÃ¡gina.
			window.location.href = 'gracias.php';
			}
                $('#message').html(data);
                $('#message').slideDown('slow'); // aca bajamos el mensaje de success o error
                $('#contactform img.loader').fadeOut('fast', function() {
                    $(this).remove()
                });
                $('#contactform #submit').removeAttr('disabled');
                if (data.match('success') != null){
                    // Comentar este si se quiere solo mostrar el mensaje y no hacer desaparecer el formulario
                    $('#contactform').slideUp('slow');
                }
            });
        });
        return false;
    })
}


function initInputFields(){
    var curVal;
    $('input[type=text]').each(function() {
        var ipt = $(this);
        ipt.attr('oValue', ipt.val());

        ipt.focus(function() {
            curVal = ipt.val();
            ipt.val('');
        });

        ipt.blur(function() {
            if (ipt.val() == '') {
                ipt.val(curVal);
            }
        });

    });

    $('textarea').each(function() {
        var ipt = $(this);
        ipt.attr('oValue', ipt.val());

        ipt.focus(function() {
            curVal = ipt.val();
            ipt.val('');
        });

        ipt.blur(function() {
            if (ipt.val() == '') {
                ipt.val(curVal);
            }
        });

    });

}


initInputFields();
initContactForm();