(function($){

    $('.photo').change(function() {
        var tamMaxMB = 4; //MB
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
	
})(jQuery);