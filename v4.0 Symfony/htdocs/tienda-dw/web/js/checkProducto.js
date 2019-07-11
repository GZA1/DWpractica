(function($) {

    $('#productoCompra').submit(function() {
        var cantidad = $("#dCShow").val(),
            enviar = $(".enviar").val(),
            tienda = $(".tienda").val();

        var inputVal = [cantidad, enviar, apell, passwdConf],
            inputMessage = ["cantidad", "enviar", "apellidos", "contraseña de confirmación"];

        for(var i=0;i<inputVal.length;i++){
            inputVal[i] = $.trim(inputVal[i]);
            if ( inputVal[i] == null || inputVal[i] === "") {
                console.log(inputVal[i] + ' incorrecto');
                alert(inputVal[i] + ' incorrecto');
                return false;
            }
        }
        return true;
    });


})(jQuery);