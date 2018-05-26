var ventanasActivas = Array();
var pathRequestControl = "../../ccontrol/control/control.php";
function formateaOpcionBusquedaTarifa(opc) {
    var etiqueta;

    switch (opc) {
        case 'descripcion':
        {
            textEtiqueta = "DESCRIPCI\xd3N : ";
            document.getElementById("txtPatronBusquedaProductos").className = "textPatronDescripcion";
            document.getElementById("txtPatronBusquedaProductos").value = "Buscar...";
            document.getElementById("hOpcBusquedaProductos").value = 1;
            document.getElementById("img_descripcion").src = "../../../../fastmedical_front/imagen/btn/btn_busqueda_descripcion_des.gif";
            document.getElementById("img_codigo").src = "../../../../fastmedical_front/imagen/btn/btn_cod_pro.gif";

            break;
        }
        case 'codigo':
        {
            textEtiqueta = "CODIGO : ";
            document.getElementById("txtPatronBusquedaProductos").className = "textPatronCodigo";
            document.getElementById("txtPatronBusquedaProductos").value = "Buscar...";
            document.getElementById("hOpcBusquedaProductos").value = 2;
            document.getElementById("img_descripcion").src = "../../../../fastmedical_front/imagen/btn/btn_busqueda_descripcion.gif";
            document.getElementById("img_codigo").src = "../../../../fastmedical_front/imagen/btn/btn_cod_pro_des.gif";
            break;
        }
    }
    document.getElementById("lblEtiquetaBusqueda").textContent = textEtiqueta;
}
function getProductos(event, tipo) {
    e = event;

    patronModulo = "productos";
    //opcion = document.getElementById("hOpcBusquedaProductos").value;
    patronNombre = document.getElementById("txPatronNombre").value;
    patronCodigo = document.getElementById("txPatronCodigo").value;
    patronCat = document.getElementById("categoria").value;
    patronAfi = document.getElementById("afiliacion").value;
    funcion = document.getElementById("funcion").value;
    evento = document.getElementById("evento").value;
    parametros = '';
    if (patronNombre == 'Buscar...') {
        patronNombre = "";
    }
    if (patronCodigo == 'Buscar...') {
        patronCodigo = "";
    }
    if (e.keyCode == 13 || tipo == 1) {
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + patronNombre;
        parametros += '&p3=' + patronCodigo;
        parametros += '&p4=' + patronCat;
        parametros += '&p5=' + evento;
        parametros += '&p6=' + funcion;
        path = "../../ccontrol/control/control.php?" + parametros;
        myajax.Link(path, 'resultadoTarifas');
    }
}
function getTarifasProductos(event, tipo) {
    getProductos(event, tipo);
//getPrecios('','','');
//getDetalleProducto('','','');
}
function onClickCateg(event, html, idCat) {

    document.getElementById("categoria").value = idCat;
    event = "";

    getTarifasProductos(event, 1);
//getPrecios(event,html,'');


}
function onClickAfiliacion(event, html, idAfi) {
    document.getElementById("afiliacion").value = idAfi;
    event = "";
    getTarifasProductos(event, 1);

}

function getPrecios(event, html, idAfi) {
    patronModulo = "precios";
    patronCodigo = idAfi;
    path2 = "../../ccontrol/control/control.php?p1=" + patronModulo + "&p2=" + patronCodigo;
    myajax2.Link(path2, 'div_precios');
}
function getDetalleProducto(event, html, c_cod_ser_pro) {
    getPrecios('', '', c_cod_ser_pro);
    getInfoProductos('', '', c_cod_ser_pro);
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=mostrar_detalle_prod&p2=' + c_cod_ser_pro;
    new Ajax.Request(url,
    {
        method: 'get',
        parameters: data,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            $('div_detalleProducto').update(transport.responseText);//Coloca el resultado en la capa "DATOS PERSONA"
        }
    }
    )


}
function getInfoProductos(event, html, c_cod_ser_pro) {
    patronModulo = "infoProductos";
    patronCodigo = c_cod_ser_pro;
    path3 = "../../ccontrol/control/control.php?p1=" + patronModulo + "&p2=" + patronCodigo;
    myajax3.Link(path3, 'div_infoProductos');
}

function seleccionaRadio() {
    var i
    for (i = 0; i < document.frmBusqueda.radio.length; i++) {
        if (document.frmBusqueda.radio[i].checked)
            break;
    }
    if (document.frmBusqueda.radio[i].value == "si") {
        $("div_categoriaActiva").show();
        $("div_categoriaPasiva").hide();
    } else {
        $("div_categoriaPasiva").show();
        $("div_categoriaActiva").hide();
    }

}

function getPrecioServicios() {

    if (document.getElementById("hiCodigoPersona").value != "") {

        $('divResultadoPrecioServicios').show();
        $('divPrecioServicio').hide();
        var patronModulo = 'getPrecioServicios';
        var c_cod_ser_pro = document.getElementById("hServicio").value;
        var codigoFiliacion = document.getElementById("hiCodigoFiliacionActiva").value;
        ventana_procedimiento(c_cod_ser_pro, codigoFiliacion);

    //        getVinculadosTratamientoPaciente(document.getElementById('txtcodigoPersona').value);

    //        var iid_persona=document.getElementById("txtcodigoPersona").value;
    //        getTratamientoPaciente(iid_persona);


    }

}

function ocultaProcedimientos() {
    $('divResultadoPrecioServicios').hide();
    $('divPrecioServicio').show();
    document.getElementById('divResultadoPrecioServicios').innerHTML = '';
    document.getElementById("rbtnconsulta").checked = true;
    document.getElementById("rbtnprocedimiento").checked = false;

//    //Agregado
//    var iid_persona=document.getElementById("txtcodigoPersona").value;
//    getTratamientoPaciente3(iid_persona);


}

function getTratamientoPaciente3(iid_persona) {
    alert('esssssssssssss' + iid_persona);

    var i;
    document.getElementsByName("grupotipocita");
    for (i = 0; i < document.getElementsByName("grupotipocita").length; i++) {
        if (document.getElementsByName("grupotipocita").item(i).checked) {
            var codigoTipoCita = document.getElementsByName("grupotipocita").item(i).value;
        }
    }
    //    alert("es:"+codigoTipoCita);

    //    contarRegistrosgetTratamientoPaciente(iid_persona);

    var patronModulo = 'getTratamientoPaciente';
    var hServicio = document.getElementById('hServicio').value;
    var arrayhServicio = hServicio.split("|");
    var arrayCod_Ser_Pro = arrayhServicio[0];
    var arrayDescrip_Producto = arrayhServicio[1];

    //    if(document.getElementById("hiCodigoFiliacionActiva").value!= null)
    //    {
    //       var hiCodigoFiliacionActiva = document.getElementById("hiCodigoFiliacionActiva").value; 
    //        
    //    }    

    //    alert(hiCodigoFiliacionActiva);

    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iid_persona;
    parametros += '&p3=' + arrayCod_Ser_Pro;

    TablagetTratamientoPaciente = new dhtmlXGridObject('divRecetas_Procedimientos_prueba');
    TablagetTratamientoPaciente.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    TablagetTratamientoPaciente.setSkin("dhx_skyblue");
    TablagetTratamientoPaciente.enableRowsHover(true, 'grid_hover');
    TablagetTratamientoPaciente.attachEvent("onRowSelect",
        function(fil, col) {

        }
        );

    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    TablagetTratamientoPaciente.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    TablagetTratamientoPaciente.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });

    /////////////fin cargador ///////////////////////
    TablagetTratamientoPaciente.enableMultiline(true);
    TablagetTratamientoPaciente.init();
    TablagetTratamientoPaciente.loadXML(pathRequestControl + '?' + parametros, function() {

        if (codigoTipoCita == '0001') {
            //            alert("entro al 0001");
            CargarBotonTablagetTratamientoPaciente();//doble comportamiento con tratamiento y sin tratamiento(bloqueado)

        }

        var cantidadRegistros = TablagetTratamientoPaciente.getRowsNum();
        if (trim(cantidadRegistros) == 1) {
            var idTratamientoUnico = TablagetTratamientoPaciente.cells(0, 9).getValue();
            var idReceta = TablagetTratamientoPaciente.cells(0, 0).getValue();

            $('hid_Recetas_Procedimientos_Tratamiento').value = idTratamientoUnico;
            document.getElementById("raTratamiento" + idReceta + idTratamientoUnico).checked = true;
            document.getElementById("raTratamiento" + idReceta + idTratamientoUnico).value = 1;
            document.getElementById("raTratamiento" + idReceta + idTratamientoUnico).disabled = true;

        }

    });

}


function ventana_procedimiento(c_cod_ser_pro, codigoFiliacion) {
    //   var cadenaProcedimientos = obtieneCadena();
    cadenaP = '';

    cont = 0;
    idnro = "nro0";
    aux = 0;
    while (null != document.getElementById(idnro)) {
        codigoProducto = document.getElementById(idnro).value;

        cadenaP = cadenaP + codigoProducto + "|";
        cadenaP = cadenaP + document.getElementById("no" + codigoProducto).value + "|";
        cadenaP = cadenaP + document.getElementById("pr" + codigoProducto).value + "|";
        cadenaP = cadenaP + document.getElementById("ca" + codigoProducto).value + "gxxxgr";
        cont = cont + 1;
        idnro = "nro" + cont.toString();
    }
    var cadenaProcedimientos= cadenaP;
    //    alert('continuar...');
    var vformname = 'formSeleccionaServicios';
    var vtitle = 'Procedimientos' ;
    var vwidth = '690';
    var vheight = '520';
    var vcenter = 't';
    var vresizable = '';
    var vmodal = 'false';
    var vstyle = '';
    var vopacity = '';

    var vposx1 = '';
    var vposx2 = '';
    var vposy1 = '';
    var vposy2 = '';

    var patronModulo = 'adicionaProcedimientos';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + c_cod_ser_pro;
    parametros += '&p3=' + codigoFiliacion;
    parametros += '&p4=' + cadenaProcedimientos;
    var posFuncion = 'cargatablaProcedimiento()';

    CargarVentanaPopPapJorge(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)   
}

function obtieneCadena() {
    cadenaP = '';

    cont = 0;
    idnro = "nro0";
    aux = 0;
    while (null != document.getElementById(idnro)) {
        codigoProducto = document.getElementById(idnro).value;

        cadenaP = cadenaP + codigoProducto + "|";
        cadenaP = cadenaP + document.getElementById("no" + codigoProducto).value + "|";
        cadenaP = cadenaP + document.getElementById("pr" + codigoProducto).value + "|";
        cadenaP = cadenaP + document.getElementById("ca" + codigoProducto).value + "gxxxgr";
        cont = cont + 1;
        idnro = "nro" + cont.toString();
    }

    return cadenaP;
}
function seleccionarCentroCosto(element, event, idCentroCosto) {
    document.getElementById("hiCodigoCCostosPrecio").value = idCentroCosto;
    getTarifasProcedimientos('', '04')
}

function getTarifasProcedimientos(event, opcion) {
    aux = 0;
    afiliacionActiva = document.getElementById('hiCodigoFiliacionActiva').value;
    cCosto = document.getElementById('hiCodigoCCostosPrecio').value;
    nombreProcedimiento = document.getElementById('txtNombreProcedimiento').value;
    cCodigoProcedimiento = document.getElementById('txtCodigo').value;
    if (opcion == '01') {
        document.getElementById('txtCodigo').value = 'Buscar...';
        cCodigoProcedimiento = '';
        if (event.keyCode == 13) {
            aux = 1;
        }
    }
    if (opcion == '02') {
        document.getElementById('txtNombreProcedimiento').value = 'Buscar...';
        cCosto = '01020609%';
        nombreProcedimiento = '';
        if (event.keyCode == 13) {
            aux = 1;
        }
    }
    if (opcion == '03') {
        if (nombreProcedimiento == 'Buscar...') {
            nombreProcedimiento = '';
        }
        if (cCodigoProcedimiento == 'Buscar...') {
            cCodigoProcedimiento = '';
        }
        aux = 1;
    }
    if (opcion == '04') {
        document.getElementById('txtCodigo').value = 'Buscar...';
        if (nombreProcedimiento == 'Buscar...') {
            nombreProcedimiento = '';
        }
        if (cCosto == '01020609') {
            cCosto = 'x';
        }
        cCodigoProcedimiento = '';
        aux = 1;
    }
    if (aux == 1) {
        patronModulo = 'precioProcedimeintos';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + afiliacionActiva;
        parametros += '&p3=' + cCosto;
        parametros += '&p4=' + nombreProcedimiento;
        parametros += '&p5=' + cCodigoProcedimiento;

        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                respuesta = transport.responseText;
                $('resultadoTarifasProcedimientos').update(respuesta);

            }
        })
    }




}

function agregarProcedimiento(codigo) {
    nombre = document.getElementById('no' + codigo).value;
    precio = document.getElementById('pr' + codigo).value;
    patronModulo = "agregarProcedimiento";
    var accion = "add";
    cadena = '';
    cont = 0;
    idnro = "nro0";
    aux = 0;
    while (null != document.getElementById(idnro)) {
        codigoProducto = document.getElementById(idnro).value;
        if (codigoProducto == codigo) {
            aux = 1;
        }
        cadena = cadena + codigoProducto + "|";
        cadena = cadena + document.getElementById("no" + codigoProducto).value + "|";
        cadena = cadena + document.getElementById("pr" + codigoProducto).value + "|";
        cadena = cadena + document.getElementById("ca" + codigoProducto).value + "gxxxgr";
        cont = cont + 1;
        idnro = "nro" + cont.toString();
    }

    if (aux == 1) {

    } else {
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + codigo;
        parametros += '&p3=' + nombre;
        parametros += '&p4=' + precio;
        parametros += '&p5=' + cadena;
        parametros += '&p6=' + accion;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                respuesta = transport.responseText;
                $('div_procedimientosSeleccionados').update(respuesta);
            //document.getElementById("hiCadenaProcedimientos").value="obtiene";
            }
        })
    }



}

function eliminarProcedimientoSeleccionado(codigo) {
    cond = document.getElementById('hcCodigoServicioProducto').value;
    nombre = '';
    precio = '';
    patronModulo = "agregarProcedimiento";
    var accion = "delete";
    cadena = '';
    cont = 0;
    idnro = "nro0";
    aux = 0;
    while (null != document.getElementById(idnro)) {
        codigoProducto = document.getElementById(idnro).value ;
        if (codigoProducto == codigo) {
            aux = 1;
        } else {
            cadena = cadena + codigoProducto + "|";
            cadena = cadena + document.getElementById("no" + codigoProducto).value + "|";
            cadena = cadena + document.getElementById("pr" + codigoProducto).value + "|";
            cadena = cadena + document.getElementById("ca" + codigoProducto).value + "gxxxgr";

        }
        cont = cont + 1;
        idnro = "nro" + cont.toString();
    }
    document.getElementById("hcCodigoServicioProducto").value = cadena;
    if (document.getElementById("hcCodigoServicioProducto").value == '') {
        ocultaProcedimientos();
    }
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    parametros += '&p3=' + nombre;
    parametros += '&p4=' + precio;
    parametros += '&p5=' + cadena;
    parametros += '&p6=' + accion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            if (cond == 1) {
                $('div_procedimientosSeleccionados').update(respuesta);
            } else {
                $('divResultadoPrecioServicios').update(respuesta);
            }
            

        //$('divResultadoPrecioServicios').update(respuesta);
        //$('divResultadoPrecioServicios').update(respuesta);
        //document.getElementById("hiCadenaProcedimientos").value="obtiene";
        }
    })




}

function cerrarAgregaProcedimiento(opcion) {
    event = '';
    switch (opcion) {
        case '01':
        {
            patronModulo = "agregarProcedimiento";
            cadena = obtieneCadena();
            document.getElementById("hcCodigoServicioProducto").value = cadena;
            parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + '';
            parametros += '&p3=' + '';
            parametros += '&p4=' + '';
            parametros += '&p5=' + cadena;
            parametros += '&p6=' + 'delete';
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function(transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    $('divResultadoPrecioServicios').update(respuesta);
                //$('divResultadoPrecioServicios').update(respuesta);
                //document.getElementById("hiCadenaProcedimientos").value="obtiene";
                }
            })

            break;
        }
        case '02':
        {
            document.getElementById("rbtnconsulta").checked = true;
            $('divPrecioServicio').show();
        }
    }
    Windows.close("Div_formSeleccionaServicios", event);
    getVinculadosTratamientoPaciente(document.getElementById('txtcodigoPersona').value);

}


function filtroproductos(evento) {
    var nombre = $('buscadorProducto').value;
    var numero = nombre.length;
    var tecla = evento.keyCode
    var producto = document.getElementById('buscadorProducto').value;
    var patronModulo = 'filtrotextoProducto';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + producto;
    if (numero == 3 || tecla == 13) {
        tmn = 0;
        oTarifas = new dhtmlXGridObject('contenedorTablaServicios');
        oTarifas.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
        oTarifas.setSkin("");
        oTarifas.enableRowsHover(true, 'grid_hover');
        var header = ["#text_filter", "#text_filter", "#select_filter", "#select_filter", ""];
        oTarifas.attachHeader(header);
        contadorCargador++;
        var idCargador = contadorCargador;
        oTarifas.attachEvent("onXLS", function() {
            cargadorpeche(1, idCargador);
        });
        oTarifas.attachEvent("onXLE", function() {
            cargadorpeche(0, idCargador);
        });
        oTarifas.attachEvent("onRowSelect", function(x, y) {
            var bPaquete = oTarifas.cells(x, 4).getValue()
            var idPaquete = oTarifas.cells(x, 0).getValue()
            var nombrePaquete = oTarifas.cells(x, 1).getValue()
            $('idPaqueteAbajo').value = idPaquete;
            $('nombrePaqueteAbajo').value = nombrePaquete;
            if (bPaquete == 1) {
                $('contenedorPrecios').update('');
                $('contenedorStock').update('');
                abrirPopadConsultaTarifasPaquete();
            }
            else {

                detallealmacen(oTarifas.cells(x, 0).getValue());
            }
        });
        oTarifas.init();
        oTarifas.loadXML(pathRequestControl + '?' + parametros, function() {
            tmn = 1;
        });
    }
    if (numero > 3 && tmn == 1) {
        var palabra = $('buscadorProducto').value;
        var arrayPalabras = new Array();
        arrayPalabras = palabra.split(" ");
        var numeroPalabras = arrayPalabras.length;
        oTarifas.filterBy(1, arrayPalabras[0]);
        for (var i = 1; i < numeroPalabras; i++) {
            oTarifas.filterBy(1, arrayPalabras[i], true);
        }
    }
    if (numero == 0) {
        $('contenedorTablaServicios').update('<img src="../../../../fastmedical_front/imagen/fondo/almacen.jpg" style="width:100%;height: 100%">')
        $('contenedorPrecios').update('');
        $('contenedorStock').update('');
        $('nombrePaqueteAbajo').value = '';
        $('idPaqueteAbajo').value = '';
    }
}

function detallealmacen(cod) {
    var codigopro = cod;
    var patronModulo = 'mostrarDetalleAlmacen';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigopro;
    rDetalleAlmacen = new dhtmlXGridObject('contenedorStock');
    rDetalleAlmacen.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    rDetalleAlmacen.setSkin("");
    rDetalleAlmacen.enableRowsHover(true, 'grid_hover');
    contadorCargador++;
    var idCargador = contadorCargador;
    rDetalleAlmacen.attachEvent("onXLS", function() {
        cargadorpeche(0, idCargador);
    });
    rDetalleAlmacen.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    rDetalleAlmacen.init();
    rDetalleAlmacen.loadXML(pathRequestControl + '?' + parametros);
    cargarPrecios(codigopro);
}

function cargarPrecios(codigopro) {
    var patronModulo = 'cargarPreciosServiciosyProductos';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigopro;
    var cargarPrecios = new dhtmlXGridObject('contenedorPrecios');
    cargarPrecios.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    cargarPrecios.setSkin("");
    cargarPrecios.enableRowsHover(true, 'grid_hover');
    contadorCargador++;
    var idCargador = contadorCargador;
    cargarPrecios.attachEvent("onXLS", function() {
        cargadorpeche(0, idCargador);
    });
    cargarPrecios.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    cargarPrecios.init();
    cargarPrecios.loadXML(pathRequestControl + '?' + parametros);
}


function abrirPopadConsultaTarifasPaquete() {
    posFuncion = "cargarDatosPopad";
    vtitle = "";
    vformname = 'abrirPopadConsultaTarifasPaquete';
    vwidth = '800';
    vheight = '570';
    var patronModulo = 'abrirPopadConsultaTarifasPaquete';
    vcenter = 't';
    vresizable = '';
    vmodal = 'false';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}


function cargarDatosPopad() {
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            $('idPaquete').value = $('idPaqueteAbajo').value;
            $('nombrePaquete').value = $('nombrePaqueteAbajo').value;
            CargarPaquetes();
        }
    })
}




function CargarPaquetes() {
    var IdPaquete = $('idPaquete').value;
    var CodigoAfilili = $('cboAfiliaciones').value;
    var patronModulo = 'CargarPaquetes';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + IdPaquete;
    parametros += '&p3=' + CodigoAfilili;
    argarPaquetes = new dhtmlXGridObject('contenedorTablaProductosPaquete');
    argarPaquetes.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    argarPaquetes.setSkin("");
    argarPaquetes.enableRowsHover(true, 'grid_hover');
    contadorCargador++;
    var idCargador = contadorCargador;
    argarPaquetes.attachEvent("onXLS", function() {
        cargadorpeche(0, idCargador);
    });
    argarPaquetes.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    argarPaquetes.init();
    argarPaquetes.loadXML(pathRequestControl + '?' + parametros, function() {
        contarTotalPrecio();
    });
}


function contarTotalPrecio() {
    var sumar = 0
    argarPaquetes.forEachRow(function(rId) {
        sumar = sumar + parseFloat(argarPaquetes.cells(rId, 4).getValue());
    });
    $('txtTotal').value = 'S/.' + Math.round(sumar * 100) / 100;

}

function getTarifasProcedimientosProductos(event, opcion) {
    var arreglo = $('hServicio').value.split("|");
    var codigoservicio = arreglo[0];
       
    var aux = 0;    
    var afiliacionActiva = document.getElementById('hiCodigoFiliacionActiva').value;
    var nombreProcedimiento = document.getElementById('txtNombreProcedimiento').value;
    var longitudNombreProcedimiento =nombreProcedimiento.length;
    var tecla = event.keyCode
    if(longitudNombreProcedimiento==3||tecla == 13){
        if (opcion == '01') {
            aux = 1;           
        }    
        if (aux == 1) {
            tmnGetTarifa = 0;
            var patronModulo = 'getTarifasProcedimientosProductos';
            
            var parametros='';
            parametros+='p1='+patronModulo;
            parametros+='&p2='+afiliacionActiva;
            parametros+='&p3='+nombreProcedimiento;
            tablaTarifasProcedimientosProductos=new dhtmlXGridObject('resultadoTarifasProcedimientos');
            tablaTarifasProcedimientosProductos.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
            tablaTarifasProcedimientosProductos.setSkin("dhx_skyblue");
            tablaTarifasProcedimientosProductos.enableRowsHover(true,'grid_hover');
            tablaTarifasProcedimientosProductos.attachEvent("onRowSelect", function(rId,cInd){
                var codigo=tablaTarifasProcedimientosProductos.cells(rId,1).getValue();
                var nombre=tablaTarifasProcedimientosProductos.cells(rId,2).getValue();
                var  precio =tablaTarifasProcedimientosProductos.cells(rId,3).getValue();
                 var bEstadoServicio=validaServicionConProcedimiento(codigoservicio);
                //                if(cInd==5){
                agregarProcedimientoNuevo(codigo,nombre,precio,bEstadoServicio);
            //                }

            });  
            //////////para cargador peche////////////////
            contadorCargador++;
            var idCargador=contadorCargador;
            tablaTarifasProcedimientosProductos.attachEvent("onXLS", function(){
                cargadorpeche(1,idCargador);
            });
            tablaTarifasProcedimientosProductos.attachEvent("onXLE", function(){
                cargadorpeche(0,idCargador);
             
            });
            /////////////fin cargador ///////////////////////
            tablaTarifasProcedimientosProductos.setSkin("dhx_skyblue");
            tablaTarifasProcedimientosProductos.init();
            tablaTarifasProcedimientosProductos.loadXML(pathRequestControl+'?'+parametros,function(){
                var m=$("txtIndicador").value
                if(m==0){
                    agregarProcedimientoNuevoInicio();    
                } 
                tmnGetTarifa = 1;
            });
        }   
    }else{
        if (longitudNombreProcedimiento > 3 && tmnGetTarifa==1) {
            var palabra = nombreProcedimiento;
            var arrayPalabras = new Array();
            arrayPalabras = palabra.split(" ");
            var numeroPalabras = arrayPalabras.length;
            tablaTarifasProcedimientosProductos.filterBy(2, arrayPalabras[0]);
            for (var i = 1; i < numeroPalabras; i++) {
                tablaTarifasProcedimientosProductos.filterBy(2, arrayPalabras[i], true);
            }
        }
    }

}
function agregarProcedimientoNuevo(codigo,nombre,precio,bEstadoServicio){
    // bEstadoServicio --> indica si es 1 que se puede agregar procedimientos Obligatorio
    var  codigoProducto ;
    var bEstadoPro;
    var m=tablaAgregarProcedimientoNuevo.getRowsNum();
    //    alert(m);
    if(bEstadoServicio==1){
        if(m<1){
            bEstadoPro=0;
            for(i=0;i<m;i++){
                codigoProducto = tablaAgregarProcedimientoNuevo.cells(i,0).getValue();  
                if(codigoProducto==codigo){
                    bEstadoPro=1;  
                }
            }
            if(bEstadoPro==0){
                //        alert(1);
                tablaAgregarProcedimientoNuevo.addRow(m, codigo,0);
                //        alert(2);
                tablaAgregarProcedimientoNuevo.cells(m,0).setValue(codigo); 
                tablaAgregarProcedimientoNuevo.cells(m,1).setValue(nombre); 
   //             tablaAgregarProcedimientoNuevo.cells(m,2).setValue(precio); 
                tablaAgregarProcedimientoNuevo.cells(m,2).setValue('<input id="txtPrecio'+i+'" type="txt" title="Precio" size="10" name="grupoPrecio" value="'+precio+'">'); 
                tablaAgregarProcedimientoNuevo.cells(m,3).setValue('<input id="txtCantidad'+i+'" type="txt" title="Cantidad" size="3" name="grupoMuestra" value="1">');
                //        tablaAgregarProcedimientoNuevo.cells(m,5).setValue('<a href="#" onclick=\"javascript:eliminarProcedimientoSeleccionado();\"><img src="../../../../fastmedical_front/imagen/icono/borrar.png" title="Eliminar"/></a>'); 
                tablaAgregarProcedimientoNuevo.cells(m,5).setValue('../../../../fastmedical_front/imagen/icono/borrar.png');   
            //        alert(3);
            }     
        }      
    }else {
        bEstadoPro=0;
        for(i=0;i<m;i++){
            codigoProducto = tablaAgregarProcedimientoNuevo.cells(i,0).getValue();  
            if(codigoProducto==codigo){
                bEstadoPro=1;  
            }
        }
        if(bEstadoPro==0){
            //        alert(1);
            tablaAgregarProcedimientoNuevo.addRow(m, codigo,0);
            //        alert(2);
            tablaAgregarProcedimientoNuevo.cells(m,0).setValue(codigo); 
            tablaAgregarProcedimientoNuevo.cells(m,1).setValue(nombre); 
            //tablaAgregarProcedimientoNuevo.cells(m,2).setValue(precio); 
            tablaAgregarProcedimientoNuevo.cells(m,2).setValue('<input id="txtPrecio'+i+'" type="txt" title="Precio" size="10" name="grupoPrecio" value="'+precio+'">'); 
            tablaAgregarProcedimientoNuevo.cells(m,3).setValue('<input id="txtCantidad'+i+'" type="txt" title="Cantidad" size="3" name="grupoMuestra" value="1">');
            //        tablaAgregarProcedimientoNuevo.cells(m,5).setValue('<a href="#" onclick=\"javascript:eliminarProcedimientoSeleccionado();\"><img src="../../../../fastmedical_front/imagen/icono/borrar.png" title="Eliminar"/></a>'); 
            tablaAgregarProcedimientoNuevo.cells(m,5).setValue('../../../../fastmedical_front/imagen/icono/borrar.png');   
        //        alert(3);
        }  
    }  
}
function agregarProcedimientoNuevoInicio() {
    
    $("txtIndicador").value=1;
    patronModulo = 'agregarProcedimientoNuevoInicio';
    var parametros='';
    parametros+='p1='+patronModulo;

    tablaAgregarProcedimientoNuevo=new dhtmlXGridObject('div_procedimientosSeleccionados');
    tablaAgregarProcedimientoNuevo.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaAgregarProcedimientoNuevo.setSkin("dhx_skyblue");
    tablaAgregarProcedimientoNuevo.enableRowsHover(true,'grid_hover');

    tablaAgregarProcedimientoNuevo.attachEvent("onRowSelect", function(rId,cInd){
        eliminarRegistrodeProcedimiento(rId,cInd);
    });  
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaAgregarProcedimientoNuevo.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaAgregarProcedimientoNuevo.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
 
    });
    /////////////fin cargador ///////////////////////
    tablaAgregarProcedimientoNuevo.setSkin("dhx_skyblue");
    tablaAgregarProcedimientoNuevo.init();
    tablaAgregarProcedimientoNuevo.loadXML(pathRequestControl+'?'+parametros,function(){

        });

}
function eliminarRegistrodeProcedimiento(rId,cInd){
    if(cInd==5){
        var m=tablaAgregarProcedimientoNuevo.getRowsNum();
        if(m==1){
            tablaAgregarProcedimientoNuevo.deleteRow(rId);    
        }else{
            if(m==(rId+1)){
                tablaAgregarProcedimientoNuevo.deleteRow(rId);
            }else{
                for(i=rId;i<m;i++){
                    var j=parseInt(i)+1;
                    if(j!=m){
                        var codigo = tablaAgregarProcedimientoNuevo.cells(j,0).getValue();
                        var nombre = tablaAgregarProcedimientoNuevo.cells(j,1).getValue();
                        var precio = tablaAgregarProcedimientoNuevo.cells(j,2).getValue(); 
                        var cantidad=$('txtCantidad'+j).value;

                        tablaAgregarProcedimientoNuevo.cells(i,0).setValue(codigo); 
                        tablaAgregarProcedimientoNuevo.cells(i,1).setValue(nombre); 
                        //tablaAgregarProcedimientoNuevo.cells(i,2).setValue(precio); 
                        tablaAgregarProcedimientoNuevo.cells(m,2).setValue('<input id="txtPrecio'+i+'" type="txt" title="Precio" size="10" name="grupoPrecio" value="'+precio+'">'); 
                        tablaAgregarProcedimientoNuevo.cells(i,3).setValue('<input id="txtCantidad'+i+'" type="txt" title="Cantidad" size="3" name="grupoMuestra" value="'+cantidad+'">');
                        tablaAgregarProcedimientoNuevo.cells(i,5).setValue('../../../../fastmedical_front/imagen/icono/borrar.png'); 
                    }else{
                        tablaAgregarProcedimientoNuevo.deleteRow(m-1);   
                    }
                } 
            }        
        }
  
    // tablaAgregarProcedimientoNuevo.deleteRow(rId);  
    //  tablaAgregarProcedimientoNuevo.addRow(rId, 'melaa',0);
    }
   
}
function cerrarAgregaProcedimientoNuevo(opcion) {
    event = '';
    switch (opcion) {
        case '01':
        {
            var patronModulo = "agregarProcedimiento";
            var cadena = obtieneCadenaNueva();
            $("hcCodigoServicioProducto").value = cadena;
            var parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + '';
            parametros += '&p3=' + '';
            parametros += '&p4=' + '';
            parametros += '&p5=' + cadena;
            parametros += '&p6=' + 'delete';
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function(transport) {
                    micargador(0);
                    var respuesta = transport.responseText;
                    $('divResultadoPrecioServicios').update(respuesta);
                    obtenerTurnosProcedimientos();
                }
            })

            break;
        }
        case '02':
        {
            document.getElementById("rbtnconsulta").checked = true;
            $('divPrecioServicio').show();
        }
    }
    Windows.close("Div_formSeleccionaServicios", event);
    getVinculadosTratamientoPaciente(document.getElementById('txtcodigoPersona').value);

}
function obtieneCadenaNueva() {    
    var m=tablaAgregarProcedimientoNuevo.getRowsNum();
    cadenaP='';
    for(i=0;i<m;i++){
        var  codigoProducto = tablaAgregarProcedimientoNuevo.cells(i,0).getValue();  
        var  nombreProd = tablaAgregarProcedimientoNuevo.cells(i,1).getValue();  
       // var  precio = tablaAgregarProcedimientoNuevo.cells(i,2).getValue();
       var  precio =$('txtPrecio'+i).value;
        var cantidad=$('txtCantidad'+i).value;
  
        cadenaP = cadenaP + codigoProducto + "|";
        cadenaP = cadenaP + nombreProd + "|";
        cadenaP = cadenaP + precio+ "|";
        cadenaP = cadenaP + cantidad + "gxxxgr";

    }
    return cadenaP;
}
function cargatablaProcedimiento(){
    $('txtNombreProcedimiento').focus();
    var cadenaProcedimientos=$('txtCadena').value;
    document.getElementById('divResultadoPrecioServicios').innerHTML = '';
    if(cadenaProcedimientos!=''){
        
      agregarProcedimientoNuevoInicio7(cadenaProcedimientos);  

    }
}

function agregarProcedimientoNuevoInicio7(cadenaProcedimientos) {
    
    $("txtIndicador").value=1;
    patronModulo = 'agregarProcedimientoNuevoInicio';
    var parametros='';
    parametros+='p1='+patronModulo;

    tablaAgregarProcedimientoNuevo=new dhtmlXGridObject('div_procedimientosSeleccionados');
    tablaAgregarProcedimientoNuevo.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaAgregarProcedimientoNuevo.setSkin("dhx_skyblue");
    tablaAgregarProcedimientoNuevo.enableRowsHover(true,'grid_hover');

    tablaAgregarProcedimientoNuevo.attachEvent("onRowSelect", function(rId,cInd){
        eliminarRegistrodeProcedimiento(rId,cInd);
    });  
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaAgregarProcedimientoNuevo.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaAgregarProcedimientoNuevo.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
 
    });
    /////////////fin cargador ///////////////////////
    tablaAgregarProcedimientoNuevo.setSkin("dhx_skyblue");
    tablaAgregarProcedimientoNuevo.init();
    tablaAgregarProcedimientoNuevo.loadXML(pathRequestControl+'?'+parametros,function(){
        var arrayPalabras = new Array();
        arrayPalabras = cadenaProcedimientos.split("gxxxgr");
        var numeroPalabras = arrayPalabras.length;
        for (var i = 0; i < numeroPalabras; i++) {
            var arrayPalabras1 = new Array();
            arrayPalabras1 = arrayPalabras[i].split("|");
            //                    alert(arrayPalabras1[0]);
            if(numeroPalabras!=i+1){
                var y=tablaAgregarProcedimientoNuevo.getRowsNum();
                tablaAgregarProcedimientoNuevo.addRow(y, '',0);
                tablaAgregarProcedimientoNuevo.cells(y,0).setValue(arrayPalabras1[0]); 
                tablaAgregarProcedimientoNuevo.cells(y,1).setValue(arrayPalabras1[1]); 
                //tablaAgregarProcedimientoNuevo.cells(y,2).setValue(arrayPalabras1[2]); 
                tablaAgregarProcedimientoNuevo.cells(y,2).setValue('<input id="txtPrecio'+y+'" type="txt" title="Precio" size="10" name="grupoPrecio" value="'+arrayPalabras1[2]+'">'); 
                tablaAgregarProcedimientoNuevo.cells(y,3).setValue('<input id="txtCantidad'+y+'" type="txt" title="Cantidad" size="3" name="grupoMuestra" value="'+arrayPalabras1[3]+'">');
                tablaAgregarProcedimientoNuevo.cells(y,5).setValue('../../../../fastmedical_front/imagen/icono/borrar.png');  
            }
                  
        }
        $('txtCadena').value='';

    });

}