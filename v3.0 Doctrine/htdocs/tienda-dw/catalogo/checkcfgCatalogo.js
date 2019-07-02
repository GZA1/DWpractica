(function($){

    $('.photo').change(function() {
        var tamMaxMB = 16; //MB
        var photo = $("#photo")[0].files[0];
        if(photo !== undefined){
            var tamPhoto = photo.size;
            var tamPhotoMB = tamPhoto / Math.pow(1024,2);
            if(tamPhotoMB > tamMaxMB){
                var errorMsg = 'El fichero ocupa demasiado. El tamaño máximo permitido es de ' + tamMaxMB + 'MB. El fichero elegido posee ' + tamPhotoMB.toFixed(2) + 'MB';
                alert(errorMsg);
                return false;
            }
            console.log("Tam fichero: "+tamPhotoMB.toFixed(2)+"MB");
        }
    });


    $('#aCAT').submit(function(){
        console.log("vamos a comprobar los campos de esta categoria");
        $("#errorCat").remove();
        var nombreCategoria = $("#nombreCatAdd").val(), 
            acronimoCategoria = $("#acrCatAdd").val(),
            descripcionCategoria = $("#descCatAdd").val(),
            passwdConfirm = $("#aCpasswdConfirm").val();
        var inputVal = [nombreCategoria, acronimoCategoria, descripcionCategoria, passwdConfirm],
            inputMessage = ["nombre catálogo", "acrónimo catálogo", "descripción catálogo", "contraseña de confirmación"],
            textId = ["#newNombre", "#newAcronimo", "#newDescripcion", "#aClPasswdConfirm"];
        for(var i=0;i<inputVal.length;i++){
            inputVal[i] = $.trim(inputVal[i]);
            console.log(inputVal[i]);
            if ( inputVal[i] == null || inputVal[i] === "") {
                console.log(inputVal[i] + ' incorrecto');
                invalidEntry(i);
                return false;
            }
        }
        function invalidEntry(i) {
            console.log(textId[i] + ' incorrecto');
            $(textId[i]).after("<p id='error' style='font-size: 14px; color: red' > El campo " + inputMessage[i] + " no es válido.</p>");
        }
        console.log("campos correctos - Categoria añadida");
        return true;

    });
    
    $("input[type='text']").change(function() {
        $("#error").remove();
    });




    
    $('#eCAT').submit(function(){
        console.log("vamos a comprobar la contraseña para poder editar categoria");
        $("#errorCat").remove();
        var passwdConfirm = $("#eCpasswdConfirm").val();
        var textId = "#eClPasswdConfirm";
        
        if ( passwdConfirm == null || passwdConfirm === "") {
            console.log('contraseña incorrecto');
            invalidEntry("contraseña");
            return false;
        }

        function invalidEntry(i) {
            console.log(i + ' incorrecta');
            $(textId).after("<p id='error' style='font-size: 14px; color: red' > El campo " + i + " no es válido.</p>");
        }  
        console.log("Pass correcta al editar categoria");
        return true;
    });





    $('#rCAT').submit(function(){
        console.log("vamos a comprobar la contraseña para poder eliminar categoria");
        $("#errorCat").remove();
        var passwdConfirm = $("#eCpasswdConfirm").val();
        var textId = "#eClPasswdConfirm"; 

        if ( passwdConfirm == null || passwdConfirm === "") {
            console.log(passwdConfirm + ' incorrecto');
            invalidEntry(4);
            return false;
        }

        function invalidEntry(i) {
            console.log(i + ' incorrecta');
            $(textId).after("<p id='error' style='font-size: 14px; color: red' > El campo " + i + " no es válido.</p>");
        }  

        console.log("Pass correcta al eliminar categoria");
        return true;
    });



    $('#aPROD').submit(function(){
        console.log("vamos a comprobar los campos de este empleado");
        $("#errorCat").remove();
        var nombreProducto = $("#nombrePrNuevo").val(), 
            marcaProducto = $("#marcaPrNuevo").val(),
            modeloProducto = $("#modeloPrNuevo").val(),
            precioProducto = $("#precioPrNuevo").val();
            descripcionProducto = $("#descripcionPrNuevo").val(),
            picpathProducto = $("#picpathPrNuevo").val();
            passwdConfirm = $("#aPlpasswdConfirm").val();
        var inputVal = [nombreProducto, marcaProducto, modeloProducto, precioProducto, passwdConfirm],
            inputMessage = ["nombre producto", "marca producto", "modelo producto", "precioProducto", "descripcionProducto", "picpathProducot"],
            textId = ["#nPrNombre", "#nPrMarca", "#nPrModelo", "nPrPrecio", "nPrDescripcion", "nPrPicPath", "#aPlPasswdConfirm"];
            

        for(var i=0;i<inputVal.length;i++){
            inputVal[i] = $.trim(inputVal[i]);
            console.log(inputVal[i]);
            if ( inputVal[i] == null || inputVal[i] === "") {
                console.log(inputVal[i] + ' incorrecto');
                invalidEntry(i);
                return false;
            }
        }
        
        function invalidEntry(i) {
            console.log(textId[i] + ' incorrecto');
            $(textId[i]).after("<p id='error' style='font-size: 14px; color: red' > El campo " + inputMessage[i] + " no es válido.</p>");
        }  
        console.log("campos correctos - Producto añadido");
        return true;
    });



    $('#ePROD').submit(function(){
        console.log("vamos a comprobar los campos de este empleado");
        $("#errorCat").remove();
        var passwdConfirm = $("#ePpasswdConfirm").val();
        var textId = "#ePPasswdConfirm";
            
            if ( passwdConfirm == null || passwdConfirm === "") {
                console.log(passwdConfirm + ' incorrecto');
                invalidEntry("contraseña");
                return false;
            }
    
            function invalidEntry(i) {
                console.log(i + ' incorrecta');
                $(textId).after("<p id='error' style='font-size: 14px; color: red' > El campo " + i + " no es válido.</p>");
            }  
            console.log("Pass correcta al editar Producto");
        return true;
    });




    $('#rPROD').submit(function(){
        console.log("vamos a comprobar los campos de este empleado");
        $("#errorCat").remove();
        var passwdConfirm = $("#aPpasswdConfirm").val();
        var textId = "#rPlPasswdConfirm";
            
            if ( passwdConfirm == null || passwdConfirm === "") {
                console.log(passwdConfirm + ' incorrecto');
                invalidEntry("contraseña");
                return false;
            }
    
            function invalidEntry(i) {
                console.log(i + ' incorrecta');
                $(textId).after("<p id='error' style='font-size: 14px; color: red' > El campo " + i + " no es válido.</p>");
            }  
            console.log("Pass correcta al eliminar Producto");
        return true;
    });



    $('#aSTOCK').submit(function(){
        console.log("vamos a comprobar los campos del aumento de Stock");
        $("#errorCat").remove();
        var passwdConfirm = $("#aPSpasswdConfirm").val(),
            cantAdd = $("#stockUPvalue").val();
        var inputval = [passwdConfirm, cantAdd];
        var textId = ["#aPSlPasswdConfirm", "#aPSlPasswdConfirm"] ;
            
            if ( passwdConfirm == null || passwdConfirm === "") {
                console.log(textId[0] + ' incorrecto');
                invalidEntry("contraseña");
                return false;
            }
            if ( cantAdd == null || cantAdd === "" || cantAdd < 0 || !is_numeric(cantAdd)) {
                console.log(textId[1] + ' incorrecto');
                invalidEntry("cantidad");
                return false;
            }
    
            function invalidEntry(i) {
                console.log(i + ' incorrecta');
                $(textId).after("<p id='error' style='font-size: 14px; color: red' > El campo " + i + " no es válido.</p>");
            }  
            console.log("Aumentado el stock");
        return true;
    });

    $('#rSTOCK').submit(function(){
        console.log("vamos a comprobar los campos del descenso de Stock");
        $("#errorCat").remove();
        var passwdConfirm = $("#rPSpasswdConfirm").val(),
            cantAdd = $("#stockDOWNvalue").val();
        
        var textId = ["#aPSlPasswdConfirm", "#rPSlPasswdConfirm"] ;
            
            if ( passwdConfirm == null || passwdConfirm === "") {
                console.log(textId[0] + ' incorrecto');
                invalidEntry("contraseña");
                return false;
            }
            if ( cantAdd == null || cantAdd === "" || cantAdd < 0 || !is_numeric(cantAdd)) {
                console.log(textId[1] + ' incorrecto');
                invalidEntry("cantidad");
                return false;
            }
    
            function invalidEntry(i) {
                console.log(i + ' incorrecta');
                $(textId).after("<p id='error' style='font-size: 14px; color: red' > El campo " + i + " no es válido.</p>");
            }  
            console.log("Reducido el stock");
        return true;
    });



    $('#tPROD').submit(function(){
        console.log("vamos a comprobar los campos del translado de Stock");
        $("#errorCat").remove();
        var passwdConfirm = $("#tPpasswdConfirm").val(),
            cantAdd = $("#prodTransValue").val();
        
        var textId = ["#tPlPasswdConfirm", "#tPlPasswdConfirm"] ;
            
            if ( passwdConfirm == null || passwdConfirm === "") {
                console.log(textId[0] + ' incorrecto');
                invalidEntry("contraseña");
                return false;
            }
            if ( cantAdd == null || cantAdd === "" || cantAdd < 0 || !is_numeric(cantAdd)) {
                console.log(textId[1] + ' incorrecto');
                invalidEntry("cantidad");
                return false;
            }
    
            function invalidEntry(i) {
                console.log(i + ' incorrecta');
                $(textId).after("<p id='error' style='font-size: 14px; color: red' > El campo " + i + " no es válido.</p>");
            }  
            console.log("Transladado producto");
        return true;
    });




});