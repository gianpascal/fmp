/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var ventanasActivas = Array();
var pathRequestControl = "../../ccontrol/control/control.php";



function setOrdenesPersona(parametro, event, codigoPersona) {

    var patronModulo = "detalleOrden";
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoPersona;
    parametros += '&p3=' + parametro;
    var elemento = '';
    var nOrden = document.getElementById('txtOrden').value;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
           
            $('iddetalleOrden').update(respuesta);
            // seleccionaOrden(elemento, nOrden);

        }
    });

}
function seleccionaOrden(elemento, orden) {
    var nroOrden = trim(orden);

    var ordenEstaSeleccionada = true;

    if (document.getElementById(nroOrden).checked) {
        ordenEstaSeleccionada = true;
        //Falta evaluar el otro caso cuando se busca por orden de compra
        //Falta generalizar este caso para que seleccione multiples ordenes
        $("hdnNroOrdenCompraSeleccionado").value = nroOrden;

    } else {
        ordenEstaSeleccionada = false;
        $("hdnNroOrdenCompraSeleccionado").value = "";
    }



    if (elemento == '') {
        numeroOrden = document.getElementById(nroOrden).value;
        elemento = document.getElementById(nroOrden);
        document.getElementById(nroOrden).checked = true;
        ordenEstaSeleccionada = true;
    } else {
        numeroOrden = elemento.value;
    }

    detalleOrden = numeroOrden + '-1';
    exist = 1;
    num = 1;
    log = "inicio";
    x = 1;


    while (exist == 1) {
        detalleOrden = numeroOrden + "-" + String(num);

        num++;
        if (null == document.getElementById(detalleOrden)) {
            exist = 0;
        } else {
            document.getElementById(detalleOrden).checked = ordenEstaSeleccionada;
        }


    }
}

function seleccionarItem(numeroItem) {
    var nroOrden = numeroItem.substr(0, 12);

    if (document.getElementById(numeroItem).checked) {
        document.getElementById(nroOrden).checked = true;
    } else {
        var fin = true;
        var vacio = true;
        var contador = 1;
        var item = '';
        while (fin) {
            item = nroOrden + '-' + contador;
            if (document.getElementById(item).checked) {
                vacio = false;
                break;
            }
            contador++;
            item = nroOrden + '-' + contador;
            if (null == document.getElementById(item)) {
                fin = false;
                break;
            }
        }
        if (vacio) {
            document.getElementById(nroOrden).checked = false;
        }
    }


//alert(orden);
}

/* ======================================================================= */
/* ====================================== CAJA =========================== */
/* ======================================================================= */

function mostrarVentanaTesoreriaAperturaDeDocumentos() {
    vformname = 'popupVentanaTesoreriaAperturaDeDocumentos';
    vtitle = 'Apertura de Caja';
    vwidth = '850';
    vheight = '300';
    vcenter = 't';
    vresizable = 'false';
    vmodal = 'false';
    vstyle = '';
    vopacity = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';

    patronModulo = 'mostrarVentanaTesoreriaAperturaDeDocumentos';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    //parametros+='&p3='+rowId;
    //parametros+='&p4='+cellInd;
    posFuncion = 'initTablaTipoComprobantesAperturados';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function initTablaTipoComprobantesAperturados() {
    var codCaja = $("txtCodCaja").value;
    var fechaHoy = $("txtFechaActualServidorEnCaja").value;
    mostrarTablaTipoComprobantesAperturados(codCaja, fechaHoy);
}

function mostrarTablaTipoComprobantesAperturados(codCaja, fechaHoy) {
    patronModulo = 'mostrarTablaTipoComprobantesAperturados';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codCaja;
    parametros += '&p3=' + fechaHoy;

    tablaProductoServicioSOP = new dhtmlXGridObject('divTablaTipoComprobantesAperturados');
    tablaProductoServicioSOP.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaProductoServicioSOP.setSkin("dhx_skyblue");
    tablaProductoServicioSOP.init();
    tablaProductoServicioSOP.loadXML(pathRequestControl + '?' + parametros);
}

function cargarDatosCboSerieComprobante() {
    patronModulo = 'cargarDatosCboSerieComprobante';
    codCaja = $("txtCodCaja").value;
    codTipoComprobante = $("cboTipoComprobante").value;
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codCaja;
    parametros += '&p3=' + codTipoComprobante;

    new Ajax.Request(pathRequestControl,
            {
                method: 'post',
                parameters: parametros,
                onLoading: function (transport) {
                    micargador(1);
                },
                onComplete: function (transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    $('divSerieComprobante').update(respuesta);
                }
            }
    )
}

function agregarTipoComprobante() {
    var indiceCboTipoComprobante = $("cboTipoComprobante").selectedIndex;
    if (indiceCboTipoComprobante == 0) {
        alert("Seleccione tipo de comprobante");
    }
    else {
        var indiceCboSerieComprobante = $("cboSerieComprobante").selectedIndex;
        if (indiceCboSerieComprobante == 0) {
            alert("Seleccione serie de comprobante");
        }
        else {
            patronModulo = 'agregarTipoComprobante';
            codPerCajero = $("txtCodPerCajero").value;
            fechaHoy = $("txtFechaActualServidorEnCaja").value;

            codCaja = $("txtCodCaja").value;
            codTipoComprobante = $("cboTipoComprobante").value;
            //codSerieComprobante=$("cboSerieComprobante").value;
            datosSerieComprobante = $("cboSerieComprobante").value;
            arrayDatosSerieComprobante = datosSerieComprobante.split("|");
            codSerieComprobante = arrayDatosSerieComprobante[0];
            nroActualSerieComprobante = arrayDatosSerieComprobante[1];

            parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + codPerCajero;
            parametros += '&p3=' + fechaHoy;
            parametros += '&p4=' + codCaja;
            parametros += '&p5=' + codTipoComprobante;
            parametros += '&p6=' + codSerieComprobante;
            parametros += '&p7=' + nroActualSerieComprobante;

            new Ajax.Request(pathRequestControl,
                    {
                        method: 'post',
                        parameters: parametros,
                        onLoading: function (transport) {
                            micargador(1);
                        },
                        onComplete: function (transport) {
                            micargador(0);
                            respuesta = transport.responseText;
                            $('divRptAgregarTipoComprobante').update(respuesta);
                            //Refrescar combo de comprobantes, para que no muestre tipos de comprobante ya agregados
                            cargarDatosCboTipoComprobante(codCaja, fechaHoy);
                            //Blanqueamos combo de series
                            //Esto faltaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa!!!
                            mostrarTablaTipoComprobantesAperturados(codCaja, fechaHoy);
                        }
                    }
            )
        }
    }
}

function cargarDatosCboTipoComprobante(codCaja, fechaHoy) {
    patronModulo = 'cargarDatosCboTipoComprobante';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codCaja;
    parametros += '&p3=' + fechaHoy;

    new Ajax.Request(pathRequestControl,
            {
                method: 'post',
                parameters: parametros,
                onLoading: function (transport) {
                    micargador(1);
                },
                onComplete: function (transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    $('divTipoComprobante').update(respuesta);
                }
            }
    )
}

function salirVentanaTesoreriaAperturaDeDocumentos() {
    Windows.close("Div_popupVentanaTesoreriaAperturaDeDocumentos");
}

/*************************************************Cancelar orden***********************************************/
function cancelarOrdenesSeleccionadas() {
    var nroOrden = $("hdnNroOrdenCompraSeleccionado").value;
    var c_cod_per = $("txtCodPerDeOrdenGenerada").value;

    var funcionTabla = 'mostrarTablaProductoServicioFacturacion';

    var funcionCerrar = 'actualizarOrdenes()';
    mostrarVentanaFacturacionOrdenPaciente(nroOrden, c_cod_per, funcionTabla, funcionCerrar);

}

function anularItem(item) {

    if (window.confirm("Desea eliminar el item seleccionado?")) {
        var patronModulo = 'anularItem';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + item;
        new Ajax.Request(pathRequestControl,
                {
                    method: 'post',
                    parameters: parametros,
                    onLoading: function (transport) {
                        micargador(1);
                    },
                    onComplete: function (transport) {
                        micargador(0);

                        var respuesta = transport.responseText;
                        alert(respuesta);
                        var codigoPersona = $('txtCodPerDeOrdenGenerada').value;
                        
                        setOrdenesPersona('', '', codigoPersona);
                       
                    }
                }
        );
    }
}
function anularComprobantePago(idPago){
    if (window.confirm("Desea Anular el comprobante de Pago?")) {
        var patronModulo = 'anularComprobantePago';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + idPago;
        new Ajax.Request(pathRequestControl,
                {
                    method: 'post',
                    parameters: parametros,
                    onLoading: function (transport) {
                        micargador(1);
                    },
                    onComplete: function (transport) {
                        micargador(0);

                        var respuesta = transport.responseText;
                        alert(respuesta);
                        var codigoPersona = $('txtCodPerDeOrdenGenerada').value;
                        
                        setOrdenesPersona('', '', codigoPersona);
                       
                    }
                }
        );
    }
}
function mostrarVentanaFacturacionOrdenPaciente($nroOrden, c_cod_per, funcionTabla, funcionCerrar) {
    //Validacion incluida
    if ($nroOrden === "") {
        alert("No hay ordenes seleccionadas");
    }

    else {
        var nroOrdenCompra = $nroOrden;
        var codPerPaciente = c_cod_per;
        /*
         var nomCompletoPaciente = nombreCompleto;
         var dniPaciente = documentoPaciente;//txtDNIPerDeOrdenGenerada
         */
        var datos = nroOrdenCompra + "|" + codPerPaciente + "|" + funcionCerrar;
        datos = Base64.encode(datos);

        var vformname = 'popupVentanaFacturacionOrdenPaciente';
        var vtitle = 'Facturacion';
        var vwidth = '850';
        var vheight = '500';
        var vcenter = 't';
        var vresizable = 'false';
        var vmodal = 'false';
        var vstyle = '';
        var vopacity = '';
        var vposx1 = '';
        var vposx2 = '';
        var vposy1 = '';
        var vposy2 = '';

        var patronModulo = 'mostrarVentanaFacturacionOrdenPaciente';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + datos;
        var posFuncion = funcionTabla;
        CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
    }
}

function actualizaNumeroSerie() {
    var iIdSerieComprobante = $("cboTipoComprobanteFacturacion").value;
    var patronModulo = 'obtenerNumeroYSerie';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iIdSerieComprobante;

    new Ajax.Request(pathRequestControl,
            {
                method: 'post',
                parameters: parametros,
                onLoading: function (transport) {
                    micargador(1);
                },
                onComplete: function (transport) {
                    micargador(0);

                    var respuesta = transport.responseText;
                    //$('divTipoComprobante').update(respuesta);

                    var array = respuesta.split("-");

                    $("txtNroComprobanteFacturacion").value = array[0];

                    $("hdnTipoIgv").value = array[1];
                    $("hdnSerie").value = array[2];
                    calcularMontosProductoServicioFacturacion();
                }
            }
    );
}
function mostrarTablaProductoServicioFacturacion() {
    // alert ('entra');
    var fin = true;
    var cadenaItems = '';
    var cadenaItems2 = '';
    var contador = 1;
    var contadorAux = 1;
    var item = '';
    var item2;
    var nroOrdenCompra = $("hdnNroOrdenCompraSeleccionado").value;

    while (fin) {
        item = nroOrdenCompra + '-' + contador;
        // alert(item);

        //cadenaItems=cadenaItems+$(item).value;
        contador++;
        item2 = nroOrdenCompra + '-' + contador;
        if (null == document.getElementById(item2)) {
            fin = false;
            //alert('false');
            if (document.getElementById(item).checked == true) {

                if (document.getElementById(item).checked == true) {
                    if (cadenaItems == '') {
                        cadenaItems = cadenaItems + $(item).value;
                        cadenaItems2 = cadenaItems2 + '*' + $(item).value + '*';
                    } else {
                        cadenaItems = cadenaItems + "," + $(item).value;
                        cadenaItems2 = cadenaItems2 + ",*" + $(item).value + '*';
                    }

                }
            }
        } else {

            if (document.getElementById(item).checked == true) {
                if (cadenaItems == '') {
                    cadenaItems = cadenaItems + $(item).value;
                    cadenaItems2 = cadenaItems2 + '*' + $(item).value + '*';
                } else {
                    cadenaItems = cadenaItems + "," + $(item).value;
                    cadenaItems2 = cadenaItems2 + ",*" + $(item).value + '*';
                }

            }


        }
    }
    // alert(cadenaItems)    ;
    $('cadenaItem').value = cadenaItems2;
    var patronModulo = 'mostrarTablaProductoServicioFacturacion';
    //var nroOrdenCompra=$("hdnNroOrdenCompraSeleccionado").value;
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + nroOrdenCompra;
    parametros += '&p3=' + cadenaItems;

    tablaProductoServicioComprobanteFacturacion = new dhtmlXGridObject('divTablaProductoServicioComprobanteFacturacion');
    tablaProductoServicioComprobanteFacturacion.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaProductoServicioComprobanteFacturacion.setSkin("dhx_skyblue");
    tablaProductoServicioComprobanteFacturacion.attachEvent("onRowSelect", aplicarDescuento);
    tablaProductoServicioComprobanteFacturacion.init();
    tablaProductoServicioComprobanteFacturacion.loadXML(pathRequestControl + '?' + parametros, calcularMontosProductoServicioFacturacion);
}

function calcularMontosProductoServicioFacturacion() {
    var numFilas = tablaProductoServicioComprobanteFacturacion.getRowsNum();
    var cadenaCodServProd = tablaProductoServicioComprobanteFacturacion.getAllRowIds("|");
    var arrayCodServProd = cadenaCodServProd.split("|");
    var montoTotalProducto = 0;

    var opGrabada = 0;
    var igv = 0;
    var importeTotal = 0;

    var tipoIgv = $('hdnTipoIgv').value;

    for (i = 0; i < numFilas; i++) {
        montoTotalProducto = tablaProductoServicioComprobanteFacturacion.cells(arrayCodServProd[i], 8).getValue();
        if (tipoIgv == 1) {

            importeTotal = parseFloat(importeTotal) + parseFloat(montoTotalProducto);

        }
        if (tipoIgv == 2) {

            opGrabada = parseFloat(opGrabada) + parseFloat(montoTotalProducto);
        }
        if (tipoIgv == 3) {

            importeTotal = parseFloat(importeTotal) + parseFloat(montoTotalProducto);
            opGrabada = parseFloat(opGrabada) + parseFloat(montoTotalProducto);
        }

    }
    if (tipoIgv == 1) {

        opGrabada = parseFloat(importeTotal) / 1.18;
        igv = parseFloat(importeTotal) * 18 / 118;

    }
    if (tipoIgv == 2) {

        igv = 0.18 * parseFloat(opGrabada);
        importeTotal = parseFloat(opGrabada) + igv;
    }
    if (tipoIgv == 3) {

        igv = 0;
    }
    var efectivo = 0;
    $("txtOperacionGravada").value = opGrabada.toFixed(6);
    $("txtIGV").value = igv.toFixed(6);
    $("txtImporteTotal").value = importeTotal.toFixed(2);
    $("txtEfectivo").value = efectivo;
    $("txtVuelto").value = (efectivo - importeTotal).toFixed(2);

}

function verificarCajaNoCerrada() {
    //Verificamos que caja no este cerrada
    var patronModulo = 'verificarCajaNoCerrada';
    var codCaja = $("hdnCodCajaFacturacion").value;
    var fechaHoy = $("txtFechaEmisionComprobanteFacturacion").value;
    //fechaHoy="2011-11-18";

    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codCaja;
    parametros += '&p3=' + fechaHoy;

    new Ajax.Request(pathRequestControl,
            {
                method: 'post',
                parameters: parametros,
                onLoading: function (transport) {
                    micargador(1);
                },
                onComplete: function (transport) {
                    micargador(0);
                    var respuesta = transport.responseText;
                    //$('divTipoComprobante').update(respuesta);
                    if (respuesta.trim() == "ok") {
                        //alert("Se puede cobrar");
                        //cancelarMontoComprobanteFacturacion();
                        aplicarDescuentos();
                    }
                    else {
                        alert("La caja del dia ya fue cerrada!!!");
                    }
                }
            }
    )



}

function aplicarDescuentos() {
    var numFilas = tablaProductoServicioComprobanteFacturacion.getRowsNum();
    var cadenaItems = tablaProductoServicioComprobanteFacturacion.getAllRowIds("|");
    var arrayItems = cadenaItems.split("|");
    var descuento;
    var parametros = '';
    var patronModulo = 'descuentodxctacte';
    var item;
    var nuevoPrecio;
    var porcentaje;
    var nuevoTotal;
    var idAutoriza;
    var observacion;
    var cantidad;
    var precioIncial;
    for (var i = 0; i < numFilas; i++) {
        descuento = tablaProductoServicioComprobanteFacturacion.cells(arrayItems[i], 6).getValue();

        if (descuento > 0) {
            //asynchronous:false,
            item = arrayItems[i];
            precioIncial = tablaProductoServicioComprobanteFacturacion.cells(arrayItems[i], 4).getValue();
            nuevoPrecio = tablaProductoServicioComprobanteFacturacion.cells(arrayItems[i], 7).getValue();
            cantidad = tablaProductoServicioComprobanteFacturacion.cells(arrayItems[i], 5).getValue();
            porcentaje = tablaProductoServicioComprobanteFacturacion.cells(arrayItems[i], 9).getValue();
            nuevoTotal = tablaProductoServicioComprobanteFacturacion.cells(arrayItems[i], 8).getValue();
            idAutoriza = tablaProductoServicioComprobanteFacturacion.cells(arrayItems[i], 11).getValue();
            observacion = tablaProductoServicioComprobanteFacturacion.cells(arrayItems[i], 12).getValue();
            parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + item;
            parametros += '&p3=' + nuevoPrecio;
            parametros += '&p4=' + porcentaje;
            parametros += '&p5=' + nuevoTotal;
            parametros += '&p6=' + descuento;
            parametros += '&p7=' + cantidad;
            parametros += '&p8=' + precioIncial;
            parametros += '&p9=' + idAutoriza;
            parametros += '&p10=' + observacion;
            var idCargador = contadorCargador;
            new Ajax.Request(pathRequestControl,
                    {
                        method: 'get',
                        asynchronous: false,
                        parameters: parametros,
                        onLoading: cargadorpeche(1, idCargador),
                        onComplete: function (transport) {
                            cargadorpeche(0, idCargador);
                            var respuesta = transport.responseText;
                        }
                    }
            )
        } else {

        }
    }
    cancelarMontoComprobanteFacturacion();
}

function cancelarMontoComprobanteFacturacion() {
    var iIdCajaComprobante = $('cboTipoComprobanteFacturacion').value;
    var c_cod_per = $('txtCodPerPacienteDeFacturacion').value;
    var cIdTipoDocumento = $('hdncTipoDocumento').value;
    var iIdFormaPago = $('cboFormaPagoComprobanteFacturacion').value;
    var nBaseImponible = $('txtOperacionGravada').value;
    var nIgv = $('txtIGV').value;
    var nTotal = $('txtImporteTotal').value;
    var vNumeroDocumento = $('txtNroDocPacienteDeFacturacion').value;
    var dFechaEmision = $('txtFechaEmisionComprobanteFacturacion').value;
    var vNumeroComprobante = $('txtNroComprobanteFacturacion').value;
    var vSerie = $('hdnSerie').value;
    var descuento;
    var cadenaTotales = '';
    var cadenaDescuento = '';
    var cadenaiIdPuestoEmpleado = '';
    var cadenaObservacion = '';
    var cadenaPorcentaje = '';
    var cadenaNuevoPrecio = "";
    var cadenaCantidad = "";
    var cadenaNuevoTotal = '';

    var numFilas = tablaProductoServicioComprobanteFacturacion.getRowsNum();
    var cadenaItems = tablaProductoServicioComprobanteFacturacion.getAllRowIds("|");
    var arrayItems = cadenaItems.split("|");
    for (var i = 0; i < numFilas; i++) {
        cadenaTotales = cadenaTotales + "|" + tablaProductoServicioComprobanteFacturacion.cells(arrayItems[i], 8).getValue();
        cadenaDescuento = cadenaDescuento + "|" + tablaProductoServicioComprobanteFacturacion.cells(arrayItems[i], 6).getValue();
        cadenaiIdPuestoEmpleado = cadenaiIdPuestoEmpleado + "|" + tablaProductoServicioComprobanteFacturacion.cells(arrayItems[i], 11).getValue();
        cadenaObservacion = cadenaObservacion + "|" + tablaProductoServicioComprobanteFacturacion.cells(arrayItems[i], 12).getValue();
        cadenaPorcentaje = cadenaPorcentaje + "|" + tablaProductoServicioComprobanteFacturacion.cells(arrayItems[i], 9).getValue();
        cadenaNuevoPrecio = cadenaNuevoPrecio + "|" + tablaProductoServicioComprobanteFacturacion.cells(arrayItems[i], 7).getValue();
        cadenaCantidad = cadenaCantidad + "|" + parseInt(tablaProductoServicioComprobanteFacturacion.cells(arrayItems[i], 5).getValue());
        cadenaNuevoTotal = cadenaNuevoTotal + "|" + tablaProductoServicioComprobanteFacturacion.cells(arrayItems[i], 8).getValue();
    }


    var parametros = '';
    var patronModulo = "pagarOrdenes";
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iIdCajaComprobante;
    parametros += '&p3=' + c_cod_per;
    parametros += '&p4=' + cIdTipoDocumento;
    parametros += '&p5=' + iIdFormaPago;
    parametros += '&p6=' + nBaseImponible;
    parametros += '&p7=' + nIgv;
    parametros += '&p8=' + nTotal;
    parametros += '&p9=' + vNumeroDocumento;
    parametros += '&p10=' + dFechaEmision;
    parametros += '&p11=' + vNumeroComprobante;
    parametros += '&p12=' + vSerie;
    parametros += '&p13=' + cadenaTotales;
    parametros += '&p14=' + cadenaDescuento;
    parametros += '&p15=' + cadenaiIdPuestoEmpleado;
    parametros += '&p16=' + cadenaPorcentaje;
    parametros += '&p17=' + cadenaNuevoPrecio;
    parametros += '&p18=' + cadenaCantidad;
    parametros += '&p19=' + cadenaNuevoTotal;
    parametros += '&p20=' + cadenaItems;
    parametros += '&p21=' + cadenaObservacion;

    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl,
            {
                method: 'get',
                asynchronous: false,
                parameters: parametros,
                onLoading: cargadorpeche(1, idCargador),
                onComplete: function (transport) {
                    cargadorpeche(0, idCargador);
                    var respuesta = transport.responseText;
                    salirVentanaFacturacionOrdenPaciente();
                    eval($('hfuncionCerrar').value);
                    //imprimirRecibo(respuesta);
                }
            }
    )

}
function comprobantesEmitidos() {
    cbocomprobante = $('cboComprobante').value;
    cb_filtroCajas = $('cb_filtroCajas').value;//
    txtfecha = $('txtcalendario1').value;
    cboTipobusqueda = $('combo_tipobusqueda').value;
    txtrecibodesde = $('txtrecibodesde').value;
    txtrecibohasta = $('txtrecibohasta').value;
    //    alert(cbocomprobante+'  '+ txtfecha
    if (cboTipobusqueda == '') {
        alert("Seleccionar Tipo de busqueda")
    } else {
        if (cboTipobusqueda == 1) {
            parametros = "p1=comprobantesEmitidos&p2=" + txtfecha + '&p3=' + cbocomprobante + '&p4=' + cboTipobusqueda
                    + '&p5=' + '' + '&p6=' + '' + '&p7=' + '';
            div = "div_tablaComprobante";
            funcionClick = "";
            funcionDblClick = "";
            funcionLoad = "";
            generarTablax(div, parametros, funcionClick, funcionDblClick, funcionLoad);
        } else {
            if (cboTipobusqueda == 2) {
                parametros = "p1=comprobantesEmitidos&p2=" + txtfecha + '&p3=' + cbocomprobante + '&p4=' + cboTipobusqueda
                        + '&p5=' + txtrecibodesde + '&p6=' + txtrecibohasta + '&p7=' + cb_filtroCajas;
                div = "div_tablaComprobante";
                funcionClick = "";
                funcionDblClick = "";
                funcionLoad = "";
                generarTablax(div, parametros, funcionClick, funcionDblClick, funcionLoad);
            }

        }
    }
}
/*
 function seleccionaOrden(elemento,orden){
 codigo1=trim(orden);
 
 check=true;
 if(document.getElementById(codigo1).checked){
 check=true;
 
 }else{
 check=false;
 }
 
 
 
 if(elemento==''){
 numeroOrden=document.getElementById(codigo1).value;
 elemento=document.getElementById(codigo1);
 document.getElementById(codigo1).checked=true;
 check=true;
 }else{
 numeroOrden=elemento.value;
 }
 
 detalleOrden=numeroOrden+'-1';
 exist=1;
 num=1;
 log="inicio";
 x=1;
 
 
 while(exist==1){
 detalleOrden=numeroOrden+"-"+String(num);
 
 num++;
 if(null==document.getElementById(detalleOrden)){
 exist=0;
 }else{
 document.getElementById(detalleOrden).checked=check;
 }
 
 
 }
 
 
 }
 */
function actualizarOrdenes() {
    var codigoPersona = $('txtCodPerPacienteDeFacturacion').value;
    setOrdenesPersona('', '', codigoPersona);
    Windows.close("Div_popupVentanaFacturacionOrdenPaciente");

}
function salirVentanaFacturacionOrdenPaciente() {
    Windows.close("Div_popupVentanaFacturacionOrdenPaciente");
}

function pagarCita() {
    var nroOrden = $("hidNroOrden").value;
    var codigoPersona = $('hCodigoPersonaParaCobro').value;


    //var arrayDatosCita = ($('hidDatosCita').value).split("|");
    //var nombreCompleto = arrayDatosCita[1];
    //var documentoPaciente = $('hdnipaciente').value;
    var funcion = 'mostrarTablaProductoServicioFacturacionTodo';
    var funcionCerrar = 'regresaracronogramacitas();';


    mostrarVentanaFacturacionOrdenPaciente(nroOrden, codigoPersona, funcion, funcionCerrar);
//CITA CARDIOLOGIA|ARROYO ESPIRITU GIANCARLO|GARCIA S. MARIO|Jueves 08 Marzo 2012|10:30AM |CARDIOLOGIA I
}
function pagarCitaInmediata() {
    var nroOrden = $("hidNroOrden").value; //falta
    var codigoPersona = $('hiCodigoPersona').value;
    var funcion = 'mostrarTablaProductoServicioFacturacionTodo'
    var funcionCerrar = 'volverDespuesPagar()';

    mostrarVentanaFacturacionOrdenPaciente(nroOrden, codigoPersona, funcion, funcionCerrar);
//CITA CARDIOLOGIA|ARROYO ESPIRITU GIANCARLO|GARCIA S. MARIO|Jueves 08 Marzo 2012|10:30AM |CARDIOLOGIA I
}

function volverDespuesPagar() {

    Windows.close("Div_popupVentanaFacturacionOrdenPaciente");
//regresaracronogramacitas();
}
function mostrarTablaProductoServicioFacturacionTodo() {
    // alert ('entra');

    var nroOrden = $("hidNroOrden").value;
    // alert(nroOrden);
    var cadenaItems = 'todo';
    // alert(cadenaItems)    ;
    $('cadenaItem').value = cadenaItems;
    var patronModulo = 'mostrarTablaProductoServicioFacturacion';
    //var nroOrdenCompra=$("hdnNroOrdenCompraSeleccionado").value;
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + nroOrden;
    parametros += '&p3=' + cadenaItems;

    tablaProductoServicioComprobanteFacturacion = new dhtmlXGridObject('divTablaProductoServicioComprobanteFacturacion');
    tablaProductoServicioComprobanteFacturacion.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaProductoServicioComprobanteFacturacion.setSkin("dhx_skyblue");
    tablaProductoServicioComprobanteFacturacion.attachEvent("onRowSelect", aplicarDescuento);
    tablaProductoServicioComprobanteFacturacion.init();

    tablaProductoServicioComprobanteFacturacion.loadXML(pathRequestControl + '?' + parametros, calcularMontosProductoServicioFacturacion);
}
function aplicarDescuento(event_id, native_event_object) {
    if (native_event_object == 13) {
        var c_item = tablaProductoServicioComprobanteFacturacion.cells(tablaProductoServicioComprobanteFacturacion.getSelectedId(), 0).getValue();
        var codigo = tablaProductoServicioComprobanteFacturacion.cells(tablaProductoServicioComprobanteFacturacion.getSelectedId(), 1).getValue();
        var nombre = tablaProductoServicioComprobanteFacturacion.cells(tablaProductoServicioComprobanteFacturacion.getSelectedId(), 3).getValue();
        var precioUnitario = tablaProductoServicioComprobanteFacturacion.cells(tablaProductoServicioComprobanteFacturacion.getSelectedId(), 4).getValue();
        var cantidad = tablaProductoServicioComprobanteFacturacion.cells(tablaProductoServicioComprobanteFacturacion.getSelectedId(), 5).getValue();
        var total = tablaProductoServicioComprobanteFacturacion.cells(tablaProductoServicioComprobanteFacturacion.getSelectedId(), 8).getValue();
        var idSeleccionado = tablaProductoServicioComprobanteFacturacion.getSelectedId();
        // alert(event_id);
        // alert(native_event_object); 
        //alert(c_item);

        //////////////////////////////////

        var vformname = 'ventanaDescuento'
        var vtitle = 'Descuento'
        var vwidth = '400'
        var vheight = '330'
        var vcenter = 't'
        var vresizable = ''
        var vmodal = 'false'
        var vstyle = ''
        var vopacity = ''

        var vposx1 = ''
        var vposx2 = ''
        var vposy1 = ''
        var vposy2 = ''
        var patronModulo = 'ventanaDescuento';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + c_item;
        parametros += '&p3=' + codigo;
        parametros += '&p4=' + nombre;
        parametros += '&p5=' + precioUnitario;
        parametros += '&p6=' + cantidad;
        parametros += '&p7=' + total;
        parametros += '&p8=' + idSeleccionado;


        posFuncion = '';
        CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)

        ////////////////////////////////////
    }

}

function cambioTipoDescuento() {
    var tipoDescuento = $('cboTipoDescuento').value;
    // alert(tipoDescuento)
    switch (tipoDescuento)
    {
        case '1':

            $('txtPorcentaje').readOnly = false;
            $('txtDescuento').readOnly = true;
            $('txtNuevoPrecio').readOnly = true;
            break;
        case '2':

            $('txtPorcentaje').readOnly = true;
            $('txtDescuento').readOnly = false;
            $('txtNuevoPrecio').readOnly = true;
            break;
        case '3':

            $('txtPorcentaje').readOnly = true;
            $('txtDescuento').readOnly = true;
            $('txtNuevoPrecio').readOnly = false;
            break;
        default:
            alert('casedef' + tipoDescuento)


    }
}

function cambioDescuento() {
    var precio = $('txtPrecio').value;
    var descuento = $('txtDescuento').value;
    var porcentaje = descuento * 100 / precio;
    var nuevoPrecio = precio - descuento;
    $('txtPorcentaje').value = porcentaje;
    $('txtNuevoPrecio').value = nuevoPrecio;
    $('txtTotalNuevo').value = nuevoPrecio * $('txtCantidad').value;


}

function cambioPorcentaje() {
    var precio = $('txtPrecio').value;
    var porcentaje = $('txtPorcentaje').value;
    var descuento = porcentaje * precio / 100;
    var nuevoPrecio = precio - descuento;
    $('txtDescuento').value = descuento;
    $('txtNuevoPrecio').value = nuevoPrecio;
    $('txtTotalNuevo').value = nuevoPrecio * $('txtCantidad').value;
}

function cambioPrecio() {
    var precio = $('txtPrecio').value;
    var nuevoPrecio = $('txtNuevoPrecio').value;
    var descuento = precio - nuevoPrecio;
    var porcentaje = (descuento * 100) / precio;
    $('txtDescuento').value = descuento;
    $('txtPorcentaje').value = porcentaje;
    $('txtTotalNuevo').value = nuevoPrecio * $('txtCantidad').value;
}

function ventanaBuscarAutoriza() {
    var idPuestoEmpleado = $('txtidPuestoEmpleado').value;
    //////////////////////////////////

    var vformname = 'ventanaBuscarAutoriza'
    var vtitle = 'Descuento'
    var vwidth = '500'
    var vheight = '500'
    var vcenter = 't'
    var vresizable = ''
    var vmodal = 'false'
    var vstyle = ''
    var vopacity = ''

    var vposx1 = ''
    var vposx2 = ''
    var vposy1 = ''
    var vposy2 = ''
    var patronModulo = 'ventanaBuscarAutoriza';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + idPuestoEmpleado;



    var posFuncion = '';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)

}

function buscarAutoriza(txtCodigo, comboTipoEstados, comboTipoDocumentos, nroDoc, apellidoPaterno, apellidoMaterno, nombres) {
    var patronModulo = "buscarAutoriza";
    ;
    var estado = comboTipoEstados;
    if ((comboTipoEstados) == '0001' || (comboTipoEstados) == '0000') {
        estado = '';
    }
    if ((comboTipoEstados) == '0002') {
        estado = 1;
    }
    if (comboTipoEstados == '0003') {
        estado = 0;
    }

    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + txtCodigo;
    parametros += '&p3=' + estado;
    parametros += '&p4=' + comboTipoDocumentos;
    parametros += '&p5=' + nroDoc;
    parametros += '&p6=' + apellidoPaterno;
    parametros += '&p7=' + apellidoMaterno;
    parametros += '&p8=' + nombres;
    tablaAutoriza = new dhtmlXGridObject('divTablaAutoriza');
    tablaAutoriza.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaAutoriza.setSkin("dhx_skyblue");
    tablaAutoriza.attachEvent("onRowSelect", seleccionarAutoriza);
    tablaAutoriza.init();

    tablaAutoriza.loadXML(pathRequestControl + '?' + parametros, '');
}
function seleccionarAutoriza() {
    var idPuestoEmpleado = tablaAutoriza.cells(tablaAutoriza.getSelectedId(), 0).getValue();
    var nombre = tablaAutoriza.cells(tablaAutoriza.getSelectedId(), 2).getValue();
    $('txtidPuestoEmpleado').value = idPuestoEmpleado;
    $('divNombreAutoriza').update(nombre);
    Windows.close("Div_ventanaBuscarAutoriza");
}

function limpiaBusquedasAutoriza(opc, elemento, evento) {
    switch (opc)
    {
        case "01": //Busqueda por codigo

            //        document.getElementById('comboTipoEstados').selected="selected";
            //        document.getElementById('comboTipoEstados').value="0002" ;
            document.getElementById('comboTipoDocumentos').selected = "selected";
            document.getElementById('comboTipoDocumentos').value = "0001";
            document.getElementById('comboTipoDocumentos').value = '';
            document.getElementById('nroDoc').value = '';
            document.getElementById('apellidoPaterno').value = '';
            document.getElementById('apellidoMaterno').value = '';
            document.getElementById('nombres').value = '';
            break;

        case "02": //Busqueda pro estado
            document.getElementById('txtCodigo').value = '';

            //        document.getElementById('comboTipoDocumentos').selected="selected";
            //        document.getElementById('comboTipoDocumentos').value="0002" ;
            document.getElementById('nroDoc').value = '';
            document.getElementById('apellidoPaterno').value = '';
            document.getElementById('apellidoMaterno').value = '';
            document.getElementById('nombres').value = '';

            break;
        case "03": //Busqueda por docuemnto
            document.getElementById('txtCodigo').value = '';
            //        document.getElementById('comboTipoEstados').selected="selected";
            //        document.getElementById('comboTipoEstados').value="0002" ;

            document.getElementById('apellidoPaterno').value = '';
            document.getElementById('apellidoMaterno').value = '';
            document.getElementById('nombres').value = '';
            break;
        case "04": //busqeuda por nombre
            document.getElementById('txtCodigo').value = '';
            //        document.getElementById('comboTipoEstados').selected="selected";
            //        document.getElementById('comboTipoEstados').value="0002" ;
            document.getElementById('comboTipoDocumentos').selected = "selected";
            document.getElementById('comboTipoDocumentos').value = "0000";
            document.getElementById('nroDoc').value = '';

            break;
        case "0": //boton limpiar
            document.getElementById('txtCodigo').value = '';
            //        document.getElementById('comboTipoEstados').selected="selected";
            //        document.getElementById('comboTipoEstados').value="0001" ;
            document.getElementById('comboTipoDocumentos').selected = "selected";
            document.getElementById('comboTipoDocumentos').value = "0000";
            document.getElementById('nroDoc').value = '';
            document.getElementById('apellidoPaterno').value = '';
            document.getElementById('apellidoMaterno').value = '';
            document.getElementById('nombres').value = '';
            break;




    }
    if (evento == '') {
        tecla = 13;
    }
    else {
        tecla = evento.keyCode
    }
    if (tecla == 13) {
        var $cod = document.getElementById('txtCodigo').value;
        var $estado = document.getElementById('comboTipoEstados').value;
        var $tipoDoc = document.getElementById('comboTipoDocumentos').value;
        var $nDoc = document.getElementById('nroDoc').value;
        var $apPat = document.getElementById('apellidoPaterno').value;
        var $apMat = document.getElementById('apellidoMaterno').value;
        var $nombre = document.getElementById('nombres').value;
        buscarAutoriza($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre);
    }


}

function aceptarDescuento() {
    if ($('txtPorcentaje').value == '0') {
        alert('Ingrese Monto a Descontar');
        return false;
    }
    /*
     if ($('txtidPuestoEmpleado').value == '') {
     alert('Ingrese Quien Autoriza el Descuento')
     return false
     }
     */
    var idSeleccionado = $('hidProductoSeleccionado').value;
    var porcentaje = $('txtPorcentaje').value;
    var descuento = $('txtDescuento').value;
    var nuevoPrecio = $('txtNuevoPrecio').value;
    var nuevoTotal = $('txtTotalNuevo').value;
    var idPuestoEmpleado = $('txtidPuestoEmpleado').value;
    var observacion = $('txtObservacion').value;
    tablaProductoServicioComprobanteFacturacion.cells(idSeleccionado, 6).setValue(descuento);
    tablaProductoServicioComprobanteFacturacion.cells(idSeleccionado, 7).setValue(nuevoPrecio);
    tablaProductoServicioComprobanteFacturacion.cells(idSeleccionado, 8).setValue(nuevoTotal);
    tablaProductoServicioComprobanteFacturacion.cells(idSeleccionado, 9).setValue(porcentaje);
    tablaProductoServicioComprobanteFacturacion.cells(idSeleccionado, 10).setValue(nuevoTotal);
    tablaProductoServicioComprobanteFacturacion.cells(idSeleccionado, 11).setValue(idPuestoEmpleado);
    tablaProductoServicioComprobanteFacturacion.cells(idSeleccionado, 12).setValue(observacion);

    Windows.close("Div_ventanaDescuento");
    calcularMontosProductoServicioFacturacion();
}

/*=== CIERRE DE CAJA =====*/

function EliminacionComprobantePago(numeroComprobante, codigoEmpleado, nroOrden, bEstado) {
    $("hdnNroOrdenCompraSeleccionado").value = nroOrden;
    var c_cod_per = codigoEmpleado;   //$("txtCodPerDeOrdenGenerada").value;
    var nombreCompleto = $("txtNomPerDeOrdenGenerada").value
    var documentoPaciente = $("txtDNIPerDeOrdenGenerada").value;
    var funcionTabla = '';//'EliminacionComprobantePagoTabla';
    var funcionCerrar = 'actualizarOrdenes()';
    EliminacionComprobantePagoa(nroOrden, c_cod_per, nombreCompleto, documentoPaciente, funcionTabla, funcionCerrar, numeroComprobante, bEstado);

}

function EliminacionComprobantePagoa(nroOrden, c_cod_per, nombreCompleto, documentoPaciente, funcionTabla, funcionCerrar, numeroComprobante, bEstado) {
    if (nroOrden == "") {
        alert("No hay ordenes seleccionadas");
    }

    else {
        if (bEstado == 2) {
            var nroOrdenCompra = nroOrden;
            var codPerPaciente = c_cod_per;
            var nomCompletoPaciente = nombreCompleto;
            var dniPaciente = documentoPaciente;//txtDNIPerDeOrdenGenerada

            vformname = 'EliminarComprobante';
            vtitle = 'Facturacion';
            vwidth = '850';
            vheight = '500';
            vcenter = 't';
            vresizable = 'false';
            vmodal = 'false';
            vstyle = '';
            vopacity = '';
            vposx1 = '';
            vposx2 = '';
            vposy1 = '';
            vposy2 = '';

            patronModulo = 'popackEliminacionComprobantePago';
            parametros = '';
            parametros += 'p1=' + patronModulo + '&p2=' + numeroComprobante + '&p3=' + codPerPaciente + '&p4=' + nomCompletoPaciente
                    + '&p5=' + dniPaciente + '&p6=' + nroOrdenCompra;
            posFuncion = 'EliminacionComprobantePagoTablax()';//funcionTabla;
            CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
        } else {
            alert("El comprobante ya fue Emitido");
        }
    }
}
//
function EliminacionComprobantePagoTablax() {
    var numeroComprobante = $("hNumeroComprobante").value;
    parametros = "p1=EliminacionComprobantePagoTabla&p2=" + numeroComprobante;
    div = "divTablaProductoServicioComprobanteFacturacionx";
    funcionClick = "";
    funcionDblClick = "";
    funcionLoad = "";
    generarTablay(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}

function anularComprobanteDePago(numeroComprobante, codigoEmpleado) {
    numeroComprobante = $("hNumeroComprobante").value;
    if (window.confirm("Desea Eliminar Comprobante Nª  " + numeroComprobante + "?")) {
        patronModulo = 'anularComprobanteDePago';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + numeroComprobante;// o serieComprobante
        parametros += '&p3=' + codigoEmpleado;

        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                respuesta = transport.responseText;
            }
        })
    }
}
function salirVentanaAnulacionResibo() {
    Windows.close("Div_EliminarComprobante");
}

/* ======================================================================= */
/* =================================== FIN CAJA ========================== */
/* ======================================================================= */



//GENERACION DE ORDENES - ANGEL SAYES 06-09-12

function agregarOrdenes() {

    var codPersona = document.getElementById('txtCodPerDeOrdenGenerada').value;
    if (codPersona > 0) {
        var posFuncion = "funcionesdePopad";
        var vtitle = "";
        var vformname = 'GenerarOrden';
        var vwidth = '750';
        var vheight = '420';
        var patronModulo = 'PopadGenerarOrden';
        var vcenter = 't';
        var vresizable = '';
        var vmodal = 'true';
        var vstyle = '';
        var vopacity = '';
        var veffect = '';
        var vposx1 = '';
        var vposx2 = '';
        var vposy1 = '';
        var vposy2 = '';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);


    }
    else
    {
        alert("SELECCIONE UNA PERSONA..");
    }

}

function funcionesdePopad() {
    cargarTablaTemporal();
    obtenerAfiliacionPersona();
}

function obtenerAfiliacionPersona() {
    var codPersona = document.getElementById('txtCodPerDeOrdenGenerada').value;
    patronModulo = 'obtenerAfiliacionPersona';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codPersona;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            var arrayRespuesta = respuesta.split('*');
            $('txtAfiliacion').value = arrayRespuesta[1];
            $('txtCodAfiliacion').value = arrayRespuesta[0];

        }
    }
    )
}



function listartablaproductos(event) {
    var codAfiliacion = document.getElementById('txtCodAfiliacion').value;
    var productoBus = document.getElementById('txtBusqueda').value;
    if (productoBus.length == 4 ||event.keyCode==13) {
        sn = 0;
        document.getElementById('divTablaProductos');
        var patronModulo = 'tablaProductosxAfiliacion';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + codAfiliacion;
        parametros += '&p3=' + productoBus;
        aProductos = new dhtmlXGridObject('divTablaProductos');
        aProductos.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
        aProductos.setSkin("dhx_skyblue");
        aProductos.enableRowsHover(true, 'grid_hover');

        contadorCargador++;
        var idCargador = contadorCargador;
        aProductos.attachEvent("onXLS", function () {
            cargadorpeche(1, idCargador);
        });
        aProductos.attachEvent("onXLE", function () {
            cargadorpeche(0, idCargador);
            sn = 1;
        });
        aProductos.attachEvent("onCheckbox", clicenRadioButton);
        aProductos.init();
        aProductos.loadXML(pathRequestControl + '?' + parametros);
        aProductos.attachEvent("onRowSelect", function (rId, cInd) {
            if (cInd == 6) {
                //  var  IdProgramar =aProductos.cells(rId,5).getValue();
//                if (IdProgramar=="0001" || IdProgramar== "0003"|| IdProgramar=="0007"|| IdProgramar=="0018"|| IdProgramar=="0005"|| IdProgramar=="0024"){
//                    var  Cate =aProductos.cells(rId,4).getValue();
//                    alert("Este producto Pertenece a la Categorìa " + Cate + " Necesita Programacion Previa" );
//                }
//                else{
                var idnuevo = aProductos.cells(rId, 0).getValue();
                var Producto = aProductos.cells(rId, 0).getValue();
                var Cantidd = 1;
                var Precio = aProductos.cells(rId, 2).getValue();
                var Total = Precio * Cantidd;
                var Imagen = "../../../../fastmedical_front/imagen/icono/i_nomailappt.png";
                var Existe = 0;
                eOrdenGenerada.forEachRow(function (id) {
                    if (id == idnuevo) {
                        Existe = 1;
                    }
                });
                if (Existe == 0) {
                    verificarPaquete(idnuevo, Producto, Cantidd, Precio, Total, Imagen);
                }
            }
        }
        //}
        );
    }
    if (productoBus.length >= 4 && sn == 1) {
        var palabra = $('txtBusqueda').value;
        var arrayPalabras = new Array();
        arrayPalabras = palabra.split(" ");
        var numeroPalabras = arrayPalabras.length;
        aProductos.filterBy(1, arrayPalabras[0]);
        for (var i = 1; i < numeroPalabras; i++) {
            aProductos.filterBy(1, arrayPalabras[i], true);
        }
    }
}
function verificarPaquete(idnuevo, Producto, Cantidd, Precio, Total, Imagen) {
    var CodigoAfilili = document.getElementById('txtCodAfiliacion').value;
    var patronModulo = 'verificarPaquete';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + idnuevo;
    parametros += '&p3=' + CodigoAfilili;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            var arrayRespuesta1 = respuesta.split('|');
            var existe = 0;
            if (arrayRespuesta1.length > 1) {
                for (var i = 0; i < arrayRespuesta1.length; i++) {
                    existe = 0;
                    arrayRespuesta2 = arrayRespuesta1[i].split('[]')
                    var id2 = arrayRespuesta2[0];
                    var producto2 = arrayRespuesta2[1];
                    var cantidad2 = arrayRespuesta2[2];
                    var precio2 = arrayRespuesta2[3];
                    var total2 = arrayRespuesta2[4];
                    eOrdenGenerada.forEachRow(function (rId) {
                        if (rId == id2) {
                            existe = 1;
                        }

                    });
                    if (existe == 0) {
                        eOrdenGenerada.addRow(id2, [producto2, cantidad2, precio2, total2, Imagen])
                        contarTotal();
                    }
                    //                    eOrdenGenerada.addRow(id2, [idnuevo,producto2, cantidad2 ,precio2,total2,Imagen])
                    //                    contarTotal();
                }
            }
            else {
                eOrdenGenerada.addRow(idnuevo, [Producto, Cantidd, Precio, Total, Imagen]);
                contarTotal();
            }
        }
    }
    )
}




function contarTotal() {
    var sumar = 0
    eOrdenGenerada.forEachRow(function (rId) {
        sumar = sumar + parseFloat(eOrdenGenerada.cells(rId, 3).getValue());
    });
    $('txtTotalOrdenGenerada').value = Math.round(sumar * 100) / 100;

}

function cargarTablaTemporal() {
    document.getElementById('divDetalleOrdenGenerada');
    patronModulo = 'tablaTemporal';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    eOrdenGenerada = new dhtmlXGridObject('divDetalleOrdenGenerada');
    eOrdenGenerada.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    eOrdenGenerada.setSkin("dhx_skyblue");
    eOrdenGenerada.enableRowsHover(true, 'grid_hover');
    contadorCargador++;
    var idCargador = contadorCargador;
    eOrdenGenerada.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    eOrdenGenerada.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    eOrdenGenerada.attachEvent("onEditCell", doOnCellEdit);
    eOrdenGenerada.init();
    eOrdenGenerada.loadXML(pathRequestControl + '?' + parametros);
    eOrdenGenerada.attachEvent("onRowAdded", function (rId) {
        contarTotal();
    });
    eOrdenGenerada.attachEvent("onRowSelect", function (rId, cInd) {
        if (cInd == 4) {
            eOrdenGenerada.deleteRow(rId);
            contarTotal();
        }
    });
}

function doOnCellEdit(stage, rowId, cellInd) {
    if (stage == 0) {
    } else if (stage == 1) {
    } else if (stage == 2) {
        eOrdenGenerada.cells(rowId, 3).setValue(eOrdenGenerada.cells(rowId, 1).getValue() * eOrdenGenerada.cells(rowId, 2).getValue());
        contarTotal();
    }
    return true;
}

function cerrarPopadGenerarOrden() {
    Windows.close("Div_GenerarOrden")
}


function PopadBuscarActoMedico() {
    posFuncion = "puente";
    vtitle = "";
    vformname = 'ActoMedico';
    vwidth = '800';
    vheight = '450';
    patronModulo = 'PopadActoMedico';
    vcenter = 't';
    vresizable = ''
    vmodal = 'true';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function puente() {
    var cPersona = document.getElementById('txtCodPerDeOrdenGenerada').value;
    cargarTablaActoMedico(cPersona);
}


function cargarTablaActoMedico(cPersona) {
    var codPersona = cPersona;
    document.getElementById('divActoMedico');
    patronModulo = 'tablaActoMedico';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codPersona;
    vActoMedico = new dhtmlXGridObject('divActoMedico');
    vActoMedico.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    vActoMedico.setSkin("dhx_skyblue");
    vActoMedico.enableRowsHover(true, 'grid_hover');
    contadorCargador++;
    var idCargador = contadorCargador;
    vActoMedico.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    vActoMedico.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    vActoMedico.attachEvent("onEditCell", doOnCellEdit);
    vActoMedico.init();
    vActoMedico.loadXML(pathRequestControl + '?' + parametros);
    vActoMedico.attachEvent("onRowSelect", function (rId, cInd) {
        if (cInd >= 0 && cInd <= 5) {
            var CodigoActoMedico = vActoMedico.cells(rId, 1).getValue();
            var Medico = vActoMedico.cells(rId, 4).getValue();
            $('txtCodActoMedico').value = CodigoActoMedico;
            $('txtActoMedico').value = Medico;
            cerrarPopadActoMedico();
        }
    });
}

function cerrarPopadActoMedico() {
    Windows.close("Div_ActoMedico");
}


function cerrarPopapGenerarOrden() {
    Windows.close("Div_GenerarOrden");

}


function grabarOrdenGenerada() {
    var CodigoAfilili = document.getElementById('txtCodAfiliacion').value;
    var CodigoPer = document.getElementById('txtCodPerDeOrdenGenerada').value;
    var CodActoMedico = document.getElementById('txtCodActoMedico').value;
    if (CodigoAfilili === "0027" && CodActoMedico === "") {
        alert("Seleccione un Acto Medico");
    }
    else {
        var patronModulo = 'grabarOrgenGenerada';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + CodigoPer;
        parametros += '&p3=' + CodActoMedico;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                var respuesta = transport.responseText;
                var CodGenerado = $('txtGenerado').value = respuesta;
                grabarDetalleOrdenGenerada(CodGenerado);
            }
        }
        );
    }
}

function grabarDetalleOrdenGenerada(CodGenerado) {
    var CodigoAfil = document.getElementById('txtCodAfiliacion').value;
    var CodigoDetalle = CodGenerado;
    var CodigoPer = document.getElementById('txtCodPerDeOrdenGenerada').value;
    eOrdenGenerada.forEachRow(function (id) {
        var cantidad = 0;
        var precio = 0;
        var total = 0;
        var codigoPro = '';
        codigoPro = codigoPro + (eOrdenGenerada.cells(id, 0).getValue());
        cantidad = cantidad + parseInt(eOrdenGenerada.cells(id, 1).getValue());
        precio = precio + parseFloat(eOrdenGenerada.cells(id, 3).getValue());
//        alert(parseInt(eOrdenGenerada.cells(id,1).getValue()));
        total = total + parseInt(eOrdenGenerada.cells(id, 1).getValue());
        var patronModulo = 'grabarDetalleOrgenGenerada';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + CodigoAfil;
        parametros += '&p3=' + CodigoDetalle;
        parametros += '&p4=' + CodigoPer;
        parametros += '&p5=' + codigoPro;
        parametros += '&p6=' + precio;
        parametros += '&p7=' + cantidad;
        parametros += '&p8=' + total;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false,
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                var respuesta = transport.responseText;
            }
        }
        );
    });
    $('txtOrden').value = CodigoDetalle;
    cerrarPopapGenerarOrden();
    //buscarPersonas();
    setOrdenesPersona('', '', CodigoPer);

}


