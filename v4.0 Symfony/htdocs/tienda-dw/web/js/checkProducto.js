(function($) {
	
	var precio = Number($('#precio').val());
	precio = precio.toFixed(2);
	$('#precio').val( precio );	

    $('#productoCompra').submit(function() {
        var cantidad = $("#dCShow").val(),
            enviar = $('input:radio[name=enviar]:checked').val(),
            tienda = $('input:radio[name=tienda]:checked').val();

        var inputVal = [cantidad, enviar, tienda],
            inputMessage = ["cantidad", "enviar", "tienda"];

        for(var i=0;i<inputVal.length;i++){
            inputVal[i] = $.trim(inputVal[i]);
            if ( inputVal[i] == null || inputVal[i] === "") {
                console.log('Campo ' + inputMessage[i] + ' incorrecto');
                alert('Campo ' + inputMessage[i] + ' incorrecto');
                return false;
            }
        }
        return true;
    });
	
	
	
	$("input[name=enviar]").change(function() {
		var enviar = $('input:radio[name=enviar]:checked').val();
		console.log(enviar);
		var precio = Number($("#precioOrig").val());
		console.log(precio);
		var recargo = 5/100;
		if(enviar==1){
			precio += Number($('#precioOrig').val()*recargo);
		}
		precio = precio.toFixed(2);
		$('#precio').val( precio );
		return true;
	});


})(jQuery);