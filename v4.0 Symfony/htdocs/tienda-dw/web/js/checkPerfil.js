(function($) {

    $('#cDF').submit(function() {
        $("#error").remove();
		console.log("cDF");
        var username = $("#username").val(),
            nombre = $("#nombre").val(),
            apell = $("#apell").val(),
            passwdConf = $("#passwdConf").val();

        var inputVal = [username, nombre, apell, passwdConf],
            inputMessage = ["username", "nombre", "apellidos", "contraseña de confirmación"],
            textId = ["#lUsername", "#lNombre", "#lApell", "#lPasswdConf"];

        for(var i=0;i<inputVal.length;i++){
            inputVal[i] = $.trim(inputVal[i]);
            if ( inputVal[i] == null || inputVal[i] === "") {
                console.log(inputVal[i] + ' incorrecto');
                invalidEntry(i);
                return false;
            }
        }
        return true;

        function invalidEntry(i) {
            console.log(textId[i] + ' incorrecto');
            $(textId[i]).after("<p id='error' style='font-size: 14px; color: red' > El campo " + inputMessage[i] + " no es válido.</p>");
        }
    });

    $("input[type='text']").change(function() {
        $("#error").remove();
    });
	
	$('#cambiarPass').submit(function() {
        $("#error").remove();
		console.log("CambPass");
        var oldPasswd = $("#oldPasswd").val(),
            newPasswd = $("#newPasswd").val(),
            newPasswd2 = $("#newPasswd2").val();

        var inputVal = [oldPasswd, newPasswd, newPasswd2],
            inputMessage = ["contraseña antigua", "contraseña nueva 1", "contraseña nueva 2"],
            textId = ["#lOldPasswd", "#lNewPasswd", "#lNewPasswd2"];

        for(var i=0;i<inputVal.length;i++){
            inputVal[i] = $.trim(inputVal[i]);
            if ( inputVal[i] == null || inputVal[i] === "") {
                console.log(inputVal[i] + ' incorrecto');
                invalidEntry(i);
                return false;
            }
        }
        return true;

        function invalidEntry(i) {
            console.log(textId[i] + ' incorrecto');
            $(textId[i]).after("<p id='error' style='font-size: 14px; color: red' > El campo " + inputMessage[i] + " no es válido.</p>");
        }
    });



})(jQuery);