function cargar_form() {
  //  myRand = parseInt(Math.random() * 999999999999999);
    //myajax.Link('default.php?rand=' + myRand, 'Contenido');
  
  var patInicio = "default.php";
    patronModulo = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(patInicio, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
           

        }
    })
    
}