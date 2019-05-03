var catalogo = [
    {name: "Seagate-ExpansionSTEA4000400-4TB", precio: 109, cantidad: 0},
    {name: "Maxtor-STSHX-M101TCBM-1TB", precio: 44.5, cantidad: 0}
];
var cesta = document.getElementsByClassName("producto-container");
var precios = document.getElementsByClassName("producto-precio");
var cantidades = document.getElementsByClassName("producto-cantidad-input");
var subtotal = document.getElementById("subtotal-resultado");
var namePCesta, namePCat;
for(var i=0;i<cesta.length;i++){
    namePCesta = cesta[i].getAttribute("name");
    for(var j=0;j<catalogo.length;j++){
        namePCat = catalogo[j].name;
        if( namePCesta==namePCat ){
            precios[i].innerHTML = catalogo[j].precio.toLocaleString( 'es-ES', { style: 'currency', currency: 'EUR' });
            catalogo[j].cantidad = cantidades[i].value;
        }
    }
}
actualizarSubtotal();

function calcValue(){
    /*Inicializamos el resumen*/
    document.getElementById("resumen-pedido-tramitado").innerHTML = "";
    for(var i=0;i<cesta.length;i++){
        namePCesta = cesta[i].getAttribute("name");
        for(var j=0;j<catalogo.length;j++){
            namePCat = catalogo[j].name;
            if( namePCesta==namePCat ){
                catalogo[j].cantidad = cantidades[i].value;
            }
        }
    }
    actualizarSubtotal();
}

function actualizarSubtotal(){
    var tmp=0;
    for(var i=0;i<catalogo.length;i++){
        if( catalogo[i].cantidad != 0 ){
            tmp += catalogo[i].cantidad * catalogo[i].precio;
        }
    }
    subtotal.value = tmp.toLocaleString( 'es-ES', { style: 'currency', currency: 'EUR' });
}

function tramitarPedido(){
    var resumen = "Compra finalizada.";
    for(producto of catalogo){
        resumen += '<br><span class="resumen-producto">'+producto.name+". Cantidad: "+producto.cantidad+". A "+producto.precio.toLocaleString( 'es-ES', { style: 'currency', currency: 'EUR' })+" cada uno.</span>";
    }
    resumen += "<br>Total de "+subtotal.value;
        document.getElementById("resumen-pedido-tramitado").innerHTML = resumen;
}