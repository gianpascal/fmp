
var pathRequestControl = "../../ccontrol/control/control.php";
var numEntrada = 0;
/******* FUNCION PARA HACER EVENTO AL CLICKEAR EL ARBOL DE LSO ACTIVOS *******/
function seleccionarArbolCCostos()
{
    myDiv = document.getElementById('menuActCCostos');
    myDiv.innerHTML = " ";
    tree = new dhtmlXTreeObject("menuActCCostos", "100%", "100%", 0);
    tree.setImagePath("../../../../fastmedical_front/imagen/icono/tree/");
    tree.attachEvent("onClick", function () {
        clickVerCcostos(tree.getSelectedItemId(), tree.getSelectedItemText());
        document.getElementById("divBotonNew").style.visibility = 'visible';
        document.getElementById("divBotonEditar").style.visibility = 'visible';
        document.getElementById("divBotonEliminar").style.visibility = 'visible';
        disableNuevoItem();
        return true;
    }
    )
    tree.loadXML("../../../../carpetaDocumentos/arbol_centroCostos.xml");
    tree.openAllItems(0);
    document.getElementById("txtArbol").value = "Activo";
}

/****** FUNCION PARA HACER EVENTO AL CLICKEAR EL ARBOL DE TODOS LOS ITEMS ******/
function seleccionarArbolCCostosCompleto()
{
    myDiv = document.getElementById('menuActCCostos');
    myDiv.innerHTML = " ";
    tree = new dhtmlXTreeObject("menuActCCostos", "100%", "100%", 0);
    tree.setImagePath("../../../../fastmedical_front/imagen/icono/tree/");
    tree.attachEvent("onClick", function () {
        clickVerCcostos(tree.getSelectedItemId(), tree.getSelectedItemText());
        document.getElementById("divBotonNew").style.visibility = 'visible';
        document.getElementById("divBotonEditar").style.visibility = 'visible';
        document.getElementById("divBotonEliminar").style.visibility = 'visible';
        disableNuevoItem();
        return true;
    }
    )
    tree.enableCheckBoxes(1);
    tree.loadXML("../../../../carpetaDocumentos/arbol_centroCostosCompleto.xml");
    tree.openAllItems(0);
    document.getElementById("txtArbol").value = "Completo";
}

/***** FUNCION PARA RECARGAR EL ARBOL *****/
function actualizarArbolCCostos()
{
    myDiv = document.getElementById('menuActCCostos');
    myDiv.innerHTML = " ";
    tree = new dhtmlXTreeObject("menuActCCostos", "100%", "100%", 0);
    tree.setImagePath("../../../../fastmedical_front/imagen/icono/tree/");
    tree.loadXML("../../../../carpetaDocumentos/arbol_centroCostos.xml");
    tree.openAllItems(0);
}

function consultaDatosPersonal() {
    patronModulo = 'consultaDatosPersonal';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            recargarArbolCCostos();
        }
    });
}

/*PERMITE MOSTRAR LOS DATOS DEL ITEM SELECCIONADO EN LOS TEXTS*/
function clickVerCcostos($id)
{

    patronModulo = 'mostrarDatosCC';
    cod = $id;
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + cod;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);

            respuesta = transport.responseText;
            var miarray = respuesta.split("|");

            //window.alert("codigo"+miarray[0]);
            document.getElementById("txtCodigo").value = miarray[0];
            document.getElementById("txtInsertar").value = miarray[1];
            document.getElementById("txtNivel").value = miarray[2];
            document.getElementById("txtAbrev").value = miarray[3];

            document.getElementById("txtObservacion").value = miarray[5];
            document.getElementById("txtUltimo").value = miarray[6];
            if (miarray[4] == 1) {
                document.getElementById("chkEstado").checked = true;
            } else {
                document.getElementById("chkEstado").checked = false;
            }
            document.getElementById("txtCod").value = miarray[7];
            document.getElementById("txtDesc").value = miarray[8];
            document.getElementById("txtNiv").value = miarray[9];

        }
    });

}

function recuperaNombre($codCC) {
    patronModulo = "getNombreCC";
    cod = $codCC;
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + cod;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            var miarray = respuesta.split("|");
            // $('divOpcInfActCCostos').update(respuesta);
            document.getElementById("txtInsertar").value = miarray[0];
            //clickVerCcostos(respuesta);//Se debe dar el id del nueo hijo
            disableNuevoItem();
        }
    })
}

function recuperaIdHijo($codCC) {
    patronModulo = "getIdCC";
    cod = $codCC;
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + cod;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            var miarray = respuesta.split("|"); //Recupera el ID

            clickVerCcostos(miarray[0]);
            disableNuevoItem();
        }
    })
}

/*** PERMITE ENVIAR EL ID PARA OBTENER EL CODIGO DEL NUEVO ITEM ***/
/************************ ACCIONES PARA LOS ITEM ********************/
function generaCodCCHijo($id, $descH, $abrevH, $observacion) {
    if (document.getElementById("txtInsertar").value == '') {
        window.alert("Debe ingresar por lo menos el nombre del Centro de Costos para agregarlo.");
        // actualizarArbolCCostos();
        if (document.getElementById("txtArbol").value == "Completo") {
            seleccionarArbolCCostosCompleto();
        } else {
            seleccionarArbolCCostos();
        }
    } else {
        patronModulo = "generaCodCCostoH";
        descripcion = $descH;
        abreviatura = $abrevH;

        observacion = $observacion;
        id = $id;
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + id;
        parametros += '&p3=' + descripcion;
        parametros += '&p4=' + abreviatura;
        parametros += '&p5=' + observacion;
        if (window.confirm("Desea insertar el Centro de Costo " + $descH + "?")) {
            //window.confirm("Desea insertar el item hijo "+$descH+"?");
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function (transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    if (document.getElementById("txtArbol").value == "Completo") {
                        seleccionarArbolCCostosCompleto();
                    } else {
                        seleccionarArbolCCostos();
                    }
                    document.getElementById("txtInsertar").value = $descH;
                    recuperaIdHijo(respuesta);
                }
            })
        } else {
            if (document.getElementById("txtArbol").value == "Completo") {
                seleccionarArbolCCostosCompleto();
            } else {
                seleccionarArbolCCostos();
            }
            disableNuevoItem();
            clickVerCcostos($id);//ID
        }
    }
}

function editaItem($id, $descC, $abrev, $observacion, $cod) {
    patronModulo = "editaCCosto";
    id = $id;
    descripcion = $descC;
    abreviatura = $abrev;
    codigo = $cod;
    if (document.getElementById("chkEstado").checked == true) {
        estado = 1;
    } else {
        estado = 0;
    }
    //estado=$estado;
    if (document.getElementById("txtInsertar").value == '') {
        window.alert("No puede dejar vacio el campo de nombre.");
        clickVerCcostos($id);
        if (document.getElementById("txtArbol").value == "Completo") {
            seleccionarArbolCCostosCompleto();
        } else {
            seleccionarArbolCCostos();
        }
        disableNuevoItem();

    } else {
        if (estado == 0 && document.getElementById("txtUltimo").value == 0) {
            window.alert("No puede inactivar el Centro de Costo porque tiene niveles dependientes.");
            if (document.getElementById("txtArbol").value == "Completo") {
                seleccionarArbolCCostosCompleto();
            } else {
                seleccionarArbolCCostos();
            }
            if ($id != '') {
                clickVerCcostos($id);
            } else {
                $var = $cod;
                //window.alert("codigo"+$var);
                clickVerCcostos($var);
            }
        } else {
            observacion = $observacion;
            parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + id;
            parametros += '&p3=' + descripcion;
            parametros += '&p4=' + abreviatura;
            parametros += '&p5=' + estado;
            parametros += '&p6=' + observacion;
            parametros += '&p7=' + codigo;
            if (window.confirm("Esta seguro que desea editar " + tree.getSelectedItemText(tree.getSelectedItemId()) + "?")) {
                new Ajax.Request(pathRequestControl, {
                    method: 'get',
                    parameters: parametros,
                    onLoading: micargador(1),
                    onComplete: function (transport) {
                        micargador(0);
                        respuesta = transport.responseText;
                        //  $('divOpcInfActCCostos').update(respuesta);
                        // actualizarArbolCCostos();
                        if (document.getElementById("txtArbol").value == "Completo") {
                            seleccionarArbolCCostosCompleto();
                            tree.enableThreeStateCheckboxes(true);//permite validar las selecciones entre hijos y padres
                        } else {
                            seleccionarArbolCCostos();
                            tree.enableThreeStateCheckboxes(true);//permite validar las selecciones entre hijos y padres
                        }
                        document.getElementById("txtInsertar").value = $descC;
                        //window.alert($id);
                        if ($id != '') {

                            clickVerCcostos($id);
                        } else {
                            $var = $cod;
                            //window.alert("codigo"+$var);
                            clickVerCcostos($var);

                        }
                        disableNuevoItem();
                    }
                });
            } else {
                // actualizarArbolCCostos();
                if (document.getElementById("txtArbol").value == "Completo") {
                    seleccionarArbolCCostosCompleto();
                } else {
                    seleccionarArbolCCostos();
                }
                disableNuevoItem();
            }
        }
    }
}

function eliminaItem($codCCH, $descC) {
    if (document.getElementById("txtInsertar").value == '') {
        window.alert("Debe tener los datos de un Centro de Costo seleccionado para eliminarlo.");
        //actualizarArbolCCostos();
        if (document.getElementById("txtArbol").value == "Completo") {
            seleccionarArbolCCostosCompleto();
        } else {
            seleccionarArbolCCostos();
        }
        disableNuevoItem();
        limpiaDatos();
    } else {
        if (document.getElementById("txtUltimo").value == 0) {
            window.alert("No puede elimininar Centro de Costos que tienen niveles dependientes.");
            if (document.getElementById("txtArbol").value == "Completo") {
                seleccionarArbolCCostosCompleto();
            } else {
                seleccionarArbolCCostos();
            }
        } else {
            if (tree.getItemText(tree.getSelectedItemId()) == '') {
                window.alert("Debe seleccionar el Centro de Costo para eliminarlo.");
                //  actualizarArbolCCostos();
                if (document.getElementById("txtArbol").value == "Completo") {
                    seleccionarArbolCCostosCompleto();
                } else {
                    seleccionarArbolCCostos();
                }
            } else {
                patronModulo = "eliminaCCosto";
                cod = $codCCH;
                parametros = '';
                parametros += 'p1=' + patronModulo;
                parametros += '&p2=' + cod;
                if (window.confirm("Esta seguro que desea eliminar " + $descC + "?")) {
                    contadorCargador++;
                    var idCargador = contadorCargador;
                    new Ajax.Request(pathRequestControl, {
                        method: 'get',
                        parameters: parametros,
                        onLoading: cargadorpeche(1, idCargador),
                        onComplete: function (transport) {
                            cargadorpeche(0, idCargador);
                            respuesta = transport.responseText;
                            //respuesta="holaaaaaaa generando codigo";
                            // $('divOpcInfActCCostos').update(respuesta);
                            //     actualizarArbolCCostos();
                            if (document.getElementById("txtArbol").value == "Completo") {
                                seleccionarArbolCCostosCompleto();
                            } else {
                                seleccionarArbolCCostos();
                            }
                            limpiaDatos();

                        }
                    });
                } else {

                    //  actualizarArbolCCostos();
                    if (document.getElementById("txtArbol").value == "Completo") {
                        seleccionarArbolCCostosCompleto();
                    } else {
                        seleccionarArbolCCostos();
                    }
                    limpiaDatos();
                }
            }
        }
    }
}

/*PERMITE EDITAR LAS CAJAS DE TEXTO PAR GRABAR O EDITAR UN ITEM*/
function enableNuevoItem($opc) {
    //Para agregar un nuevo hijo
    if ($opc == 1) {
        if (document.getElementById("txtNivel").value == 4) {
            window.alert("Ha llegado al máxmo nivel, no puede agregar más niveles. Si desea agregar el Centro de Costo consulte.")
            disableNuevoItem();
        } else {
            if (document.getElementById("chkEstado").checked == true) {
                estado = 1;
            } else {
                estado = 0;
            }
            if (estado == 0) {
                window.alert("Debe activar el Centro de Costo para aumentarle niveles dependientes.")
                disableNuevoItem();
            } else {
                // document.getElementById("txtDesc").value=tree.getItemText(tree.getSelectedItemId());
                if (tree.getItemText(tree.getSelectedItemId()) == '') {
                    window.alert("Debe seleccionar un Centro de Costo para agregarle otro Centro de Costo.");
                    //  actualizarArbolCCostos();
                    if (document.getElementById("txtArbol").value == "Completo") {
                        seleccionarArbolCCostosCompleto();
                    } else {
                        seleccionarArbolCCostos();
                    }
                } else {
                    document.getElementById("divBotonGrabar").style.visibility = 'visible';
                    document.getElementById("txtInsertar").value = "";
                    document.getElementById("txtAbrev").value = "";
                    document.getElementById("chkEstado").value = "";
                    document.getElementById("txtObservacion").value = "";
                    document.getElementById("txtCodigo").value = "";
                    document.getElementById("txtNivel").value = "";
                    document.getElementById("txtNiv").value = "";

                    patronModulo = 'mostrarDatosCC';
                    cod = tree.getSelectedItemId();
                    parametros = '';
                    parametros += 'p1=' + patronModulo;
                    parametros += '&p2=' + cod;

                    new Ajax.Request(pathRequestControl, {
                        method: 'get',
                        parameters: parametros,
                        onLoading: micargador(1),
                        onComplete: function (transport) {
                            micargador(0);
                            respuesta = transport.responseText;
                            var miarray = respuesta.split("|");
                            document.getElementById("txtCod").value = miarray[0];
                            document.getElementById("txtDesc").value = miarray[1];
                            document.getElementById("txtNiv").value = miarray[2];
                        }
                    })
                    document.getElementById("txtInsertar").disabled = false;
                    document.getElementById("txtAbrev").disabled = false;
                    document.getElementById("chkEstado").disabled = false;
                    document.getElementById("txtObservacion").disabled = false;
                    document.getElementById("divBotonNew").style.visibility = 'hidden';
                    document.getElementById("divBotonEditar").style.visibility = 'hidden';
                    document.getElementById("divBotonEliminar").style.visibility = 'hidden';
                    document.getElementById("divBotonCancelar").style.visibility = 'visible';
                }
            }
        }
    }

    //Para editar
    if ($opc == 2) {
        document.getElementById("divBotonActualizar").style.visibility = 'visible';

        document.getElementById("txtInsertar").disabled = false;
        document.getElementById("txtAbrev").disabled = false;
        document.getElementById("chkEstado").disabled = false;
        document.getElementById("txtObservacion").disabled = false;
        document.getElementById("divBotonNew").style.visibility = 'hidden';
        document.getElementById("divBotonEditar").style.visibility = 'hidden';
        document.getElementById("divBotonEliminar").style.visibility = 'hidden';
        document.getElementById("divBotonCancelar").style.visibility = 'visible';
    }



}
/*EVITA LA EDICION DE LOS TEXTS*/
function disableNuevoItem() {
    document.getElementById("txtInsertar").disabled = true;
    document.getElementById("txtAbrev").disabled = true;
    document.getElementById("chkEstado").disabled = true;
    document.getElementById("txtObservacion").disabled = true;
    //  document.getElementById("btnGrabar").style.visibility='hidden';
    document.getElementById("divBotonGrabar").style.visibility = 'hidden';
    document.getElementById("divBotonActualizar").style.visibility = 'hidden';
    document.getElementById("divBotonCancelar").style.visibility = 'hidden';

    //            document.getElementById("txtCod").value='';
    //            document.getElementById("txtNiv").value='';
    //            document.getElementById("txtDesc").value='';
    if (tree.getSelectedItemId() != '' || document.getElementById("txtCod").value != '') {
        document.getElementById("divBotonNew").style.visibility = 'visible';
        document.getElementById("divBotonEditar").style.visibility = 'visible';
        document.getElementById("divBotonEliminar").style.visibility = 'visible';
        //                if(document.getElementById("txtCod").value==''){
        //                    window.alert(document.getElementById("txtCod").value);
        //                    clickVerCcostos(tree.getSelectedItemId());
        //                }
    }
}

function limpiaDatos() {
    document.getElementById("txtCodigo").value = '';
    document.getElementById("txtInsertar").value = '';
    document.getElementById("txtNivel").value = '';
    document.getElementById("txtAbrev").value = '';
    document.getElementById("txtObservacion").value = '';

    document.getElementById("chkEstado").checked = false;
    document.getElementById("txtCod").value = '';
    document.getElementById("txtDesc").value = '';
    document.getElementById("txtNiv").value = '';

}

/****************************************************************************************************/

/****************************** REGISTRO DE NEUVO PERSONAL ******************************************/
/************************* MOSTRARA VENTANA PRINCIPAL PARA REGISTRO DE NUEVO PERSONAL ***************************/
function registroDatosPersonalDetalle(rId, cInd, tabla) {
    //alert(tabla);


    if (tabla == 'tablaEmpleados') {
        document.getElementById('txtcodigoEmpleado').value = tablaEmpleados.cells(rId, 0).getValue();
        document.getElementById('txtCodPer').value = tablaEmpleados.cells(rId, 1).getValue();
        document.getElementById('txtNomPer').value = tablaEmpleados.cells(rId, 2).getValue();


    }

    if (tabla == 'tablaEmpleadosCentroCostos') {
        document.getElementById('txtcodigoEmpleado').value = tablaEmpleadosCentroCostos.cells(rId, 0).getValue();
        document.getElementById('txtCodPer').value = tablaEmpleadosCentroCostos.cells(rId, 1).getValue();
        document.getElementById('txtNomPer').value = tablaEmpleadosCentroCostos.cells(rId, 2).getValue();

    }
    if (tabla == 'tablaEmpleadosArea') {
        document.getElementById('txtcodigoEmpleado').value = tablaEmpleadosArea.cells(rId, 0).getValue();
        document.getElementById('txtCodPer').value = tablaEmpleadosArea.cells(rId, 1).getValue();
        document.getElementById('txtNomPer').value = tablaEmpleadosArea.cells(rId, 2).getValue();
    }
    if (tabla == 'tablaVistaReporteContratoAVencer') {
        document.getElementById('txtcodigoEmpleado').value = tablaVistaReporteContratoAVencer.cells(rId, 1).getValue();
        document.getElementById('txtCodPer').value = tablaVistaReporteContratoAVencer.cells(rId, 0).getValue();
        document.getElementById('txtNomPer').value = tablaVistaReporteContratoAVencer.cells(rId, 2).getValue();
    }


    mostrarDatosPersonales();
    recargarArbolMenuRegistro();
    $('divDetallePersona').show();
    $('divConsulta').hide();

}
function regresarBuscarEmpleado() {
    $('divDetallePersona').hide();
    $('divConsulta').show();
//    recargarArbolCCostos();
//registroDatosPersonal();
}
function validarInicioFin(txtinicio, txtfin) {
    alert('peche')
}
/****** DEFINE TIPOS DE BUSQEUDAS *********/

function buscarEmpleadosHorario($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre) {
    //    alert("123 lobo");
    var dFechaInicio = $('txtFechaIni').value;
    var dFechaFin = $('txtFechaFinal').value;
    var patronModulo = "buscaEmpleadoHorario";
    var cod = $cod;
    var estado = $estado;
    if (($estado) == '0001' || ($estado) == '0000') {
        estado = '';
    }
    if (($estado) == '0002') {
        estado = 1;
    }
    if ($estado == '0003') {
        estado = 0;
    }
    var tipoDoc = $tipoDoc;
    var nDoc = $nDoc;
    var apPat = $apPat;
    var apMat = $apMat;
    var nombre = $nombre;
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + cod;
    parametros += '&p3=' + estado;
    parametros += '&p4=' + tipoDoc;
    parametros += '&p5=' + nDoc;
    parametros += '&p6=' + apPat;
    parametros += '&p7=' + apMat;
    parametros += '&p8=' + nombre;
    parametros += '&p9=' + dFechaInicio;
    parametros += '&p10=' + dFechaFin;

    //parametros="p1=datosExamenPrueba&p2="+idExamen;
    var ablaEmpleados = new dhtmlXGridObject('divTablaResultadosEmpleados');
    ablaEmpleados.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    ablaEmpleados.setSkin("dhx_skyblue");
    ablaEmpleados.enableRowsHover(true, 'grid_hover');

    ablaEmpleados.attachEvent("onRowDblClicked", function (rId, cInd) {
        var codEmpleado = ablaEmpleados.cells(rId, 0).getValue();
        var codPer = ablaEmpleados.cells(rId, 1).getValue();
        var idTipoModalidadContrato = ablaEmpleados.cells(rId, 4).getValue();

        var vNombreCompleto = ablaEmpleados.cells(rId, 2).getValue();
        $('txthnombreCompleto').value = vNombreCompleto;
        buscarEmpleadoHorario(codEmpleado, codPer, vNombreCompleto, idTipoModalidadContrato, rId, cInd);
    });
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    ablaEmpleados.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    ablaEmpleados.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        bgColorTablaEmpleados(ablaEmpleados);
    });
    /////////////fin cargador ///////////////////////
    ablaEmpleados.init();
    ablaEmpleados.loadXML(pathRequestControl + '?' + parametros);

}

function  bgColorTablaEmpleados(ablaEmpleados) {
    var m = ablaEmpleados.getRowsNum();

    for (var i = 0; i < m; i++) {
        var idTipoModalidadContrato = ablaEmpleados.cells(i, 4).getValue();
        if (idTipoModalidadContrato == 1) {
            ablaEmpleados.setRowTextStyle(i, 'background-color:#BDFF0A;color:black;border-top: 1px solid #BDFF0A;');
        } else {
            ablaEmpleados.setRowTextStyle(i, 'background-color:#E27A12;color:black;border-top: 1px solid #E27A12;');
        }

    }

}
function buscarEmpleadoHorario(codEmpleado, codPer, vNombreCompleto, idTipoModalidadContrato, fila, columna) {

    var txtFechaFinal = $('txtFechaFinal').value;
    var patronModulo = 'buscarEmpleadoHorarioSusAreas';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + codEmpleado;
    parametros += "&p3=" + codPer;
    parametros += "&p4=" + vNombreCompleto;
    contadorCargador++;
    var idCargador = contadorCargador;
    if (idTipoModalidadContrato == 1) {
        if (columna == 5) {
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                asynchronous: false, // Para que el ajax respete el orden de ejecucion
                parameters: parametros,
                onLoading: cargadorpeche(1, idCargador),
                onComplete: function (transport) {
                    cargadorpeche(0, idCargador);
                    var respuesta = transport.responseText;
                    $('div_nombreempleadoTrabajdor').update(respuesta);
                    BusquedaEmpleadoHorario(codEmpleado, codPer, vNombreCompleto);
                }
            }
            )
        }
    } else {
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false, // Para que el ajax respete el orden de ejecucion
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function (transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                $('div_nombreempleadoTrabajdor').update(respuesta);
                BusquedaEmpleadoHorario(codEmpleado, codPer, vNombreCompleto);
            }
        }
        )
    }

}
function buscarEmpleados($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre) {

    var patronModulo = "buscaEmpleado";
    var cod = $cod;
    var estado = $estado;
    if (($estado) == '0001' || ($estado) == '0000') {
        estado = '';
    }
    if (($estado) == '0002') {
        estado = 1;
    }
    if ($estado == '0003') {
        estado = 0;
    }
    var tipoDoc = $tipoDoc;
    var nDoc = $nDoc;
    var apPat = $apPat;
    var apMat = $apMat;
    var nombre = $nombre;
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + cod;
    parametros += '&p3=' + estado;
    parametros += '&p4=' + tipoDoc;
    parametros += '&p5=' + nDoc;
    parametros += '&p6=' + apPat;
    parametros += '&p7=' + apMat;
    parametros += '&p8=' + nombre;

    //parametros="p1=datosExamenPrueba&p2="+idExamen;
    tablaEmpleados = new dhtmlXGridObject('divTablaResultadosEmpleados');
    tablaEmpleados.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaEmpleados.setSkin("dhx_skyblue");
    tablaEmpleados.enableRowsHover(true, 'grid_hover');

    tablaEmpleados.attachEvent("onRowDblClicked", function (rId, cInd) {
        //   alert(123)
        registroDatosPersonalDetalle(rId, cInd, 'tablaEmpleados');
    });
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaEmpleados.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    tablaEmpleados.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        ;
    });
    /////////////fin cargador ///////////////////////
    tablaEmpleados.init();
    tablaEmpleados.loadXML(pathRequestControl + '?' + parametros);

}

function cargaArbolAreaBusqueda() {

    var sede = '';
    var parametros = "p1=arbolAreas";
    parametros += "&p2=" + sede;
    divMostrar = document.getElementById('divAreas');
    //alert('paso1');
    divMostrar.innerHTML = " ";
    //    alert('paso2');
    treex = new dhtmlXTreeObject("divAreas", "100%", "100%", 0);
    //    alert('paso3');
    treex.setSkin('dhx_skyblue');
    //   alert('paso4');
    treex.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    //   alert('paso5');
    treex.attachEvent("onClick", function () {
        buscarEmpleadosAreas(treex.getSelectedItemId(), treex.getSelectedItemText());
        return true;
    });
    treex.openAllItems(0);
    //    treex.setXMLAutoLoading(pathRequestControl+'?'+parametros);
    treex.loadXML(pathRequestControl + '?' + parametros);
}

function cargaArbolAreaBusquedaHorarios() {
    var sede = '';
    var parametros = "p1=arbolAreas";
    parametros += "&p2=" + sede;
    divMostrar = document.getElementById('divAreas');
    //alert('paso1');
    divMostrar.innerHTML = " ";
    //    alert('paso2');
    treex = new dhtmlXTreeObject("divAreas", "100%", "100%", 0);
    //    alert('paso3');
    treex.setSkin('dhx_skyblue');
    //   alert('paso4');
    treex.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    //   alert('paso5');
    treex.attachEvent("onClick", function () {
        buscarEmpleadosAreasHorarios(treex.getSelectedItemId(), treex.getSelectedItemText());
        return true;
    });
    treex.openAllItems(0);
    //    treex.setXMLAutoLoading(pathRequestControl+'?'+parametros);
    treex.loadXML(pathRequestControl + '?' + parametros);
}
//function 09Mayo 2012 JCQA




function cargaArbolCCosto() {


    var parametros = "p1=generaArbolCentroCostos";

    var divMostrar = document.getElementById('divCCostos');
    divMostrar.innerHTML = " ";
    treeCentroCostos = new dhtmlXTreeObject("divCCostos", "100%", "100%", 0);
    treeCentroCostos.setSkin('dhx_skyblue');
    treeCentroCostos.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    treeCentroCostos.attachEvent("onClick", function () {
        //  buscarEmpleadosCentroCostos();
        buscarEmpleadosCentroCostos(treeCentroCostos.getSelectedItemId(), treeCentroCostos.getSelectedItemText());
    });

    treeCentroCostos.openAllItems(0);
    //    treex.setXMLAutoLoading(pathRequestControl+'?'+parametros);
    treeCentroCostos.loadXML(pathRequestControl + '?' + parametros);
}


function cargaArbolCCostoHorarios() {


    var parametros = "p1=generaArbolCentroCostos";

    var divMostrar = document.getElementById('divCCostos');
    divMostrar.innerHTML = " ";
    treeCentroCostos = new dhtmlXTreeObject("divCCostos", "100%", "100%", 0);
    treeCentroCostos.setSkin('dhx_skyblue');
    treeCentroCostos.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    treeCentroCostos.attachEvent("onClick", function () {
        //  buscarEmpleadosCentroCostos();
        buscarEmpleadosCentroCostosHorarios(treeCentroCostos.getSelectedItemId(), treeCentroCostos.getSelectedItemText());
    });

    treeCentroCostos.openAllItems(0);
    //    treex.setXMLAutoLoading(pathRequestControl+'?'+parametros);
    treeCentroCostos.loadXML(pathRequestControl + '?' + parametros);
}
function buscarEmpleadosCentroCostosHorarios(id, nombre) {
    var estado = $('comboTipoEstados').value;
    var parametros = "p1=busquedaEmpleadosCentroCostos";
    parametros += "&p2=" + id;
    parametros += "&p3=" + estado;
    //alert("id:"+id+"*** nombre:"+nombre)
    var ablaEmpleadosCentroCostos = new dhtmlXGridObject('divTablaResultadosEmpleados');
    ablaEmpleadosCentroCostos.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    ablaEmpleadosCentroCostos.setSkin("dhx_skyblue");
    ablaEmpleadosCentroCostos.enableRowsHover(true, 'grid_hover');


    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    ablaEmpleadosCentroCostos.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    ablaEmpleadosCentroCostos.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    /////////////fin cargador ///////////////////////
    ablaEmpleadosCentroCostos.attachEvent("onRowDblClicked", function (rId, cInd) {

        var codEmpleado = ablaEmpleadosCentroCostos.cells(rId, 0).getValue();
        var codPer = ablaEmpleadosCentroCostos.cells(rId, 1).getValue();
        var vNombreCompleto = ablaEmpleadosCentroCostos.cells(rId, 2).getValue();
        //        alert(vNombreCompleto);
        document.getElementById("div_nombreempleadoTrabajdor").innerHTML = '<table > <thead>' +
                '<tr  bgcolor="#A2DF71"><th  style="width: 120px">Sede</th> <th style="width: 150px">Area</th>'
                + ' <th style="width: 400px">Nombre Ap.</th> <th style="width: 180px">Puesto</th><th style="width: 180px">Tipo Contrato</th>'
                + '</thead><tbody>'
                + '<tr align="center" bgcolor="#F7F7DD"><td><b>' + '' + '</b></td><td><b>' + 'vArea'
                + '</b></td><td><b>' + vNombreCompleto + '</b></td><td><b>' + '' + '</b></td><td><b>'
                + vTipoContrato + '</b></td></tr> </tbody></table>';
        BusquedaEmpleadoHorario(codEmpleado, codPer, vNombreCompleto);
    });
    ablaEmpleadosCentroCostos.init();
    ablaEmpleadosCentroCostos.loadXML(pathRequestControl + '?' + parametros);
}

function buscarEmpleadosCentroCostos(id, nombre) {
    var estado = $('comboTipoEstados').value;
    var parametros = "p1=busquedaEmpleadosCentroCostos";
    parametros += "&p2=" + id;
    parametros += "&p3=" + estado;
    //alert("id:"+id+"*** nombre:"+nombre)
    tablaEmpleadosCentroCostos = new dhtmlXGridObject('divTablaResultadosEmpleados');
    tablaEmpleadosCentroCostos.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaEmpleadosCentroCostos.setSkin("dhx_skyblue");
    tablaEmpleadosCentroCostos.enableRowsHover(true, 'grid_hover');


    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaEmpleadosCentroCostos.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    tablaEmpleadosCentroCostos.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaEmpleadosCentroCostos.attachEvent("onRowDblClicked", function (rId, cInd) {

        registroDatosPersonalDetalle(rId, cInd, 'tablaEmpleadosCentroCostos')
    });
    tablaEmpleadosCentroCostos.init();
    tablaEmpleadosCentroCostos.loadXML(pathRequestControl + '?' + parametros);
}

function buscarEmpleadosAreas(id, nombre) {
    var estado = $('comboTipoEstados').value;
    var parametros = "p1=busquedaEmpleadosAreas";
    parametros += "&p2=" + id;
    parametros += "&p3=" + estado;
    //alert("id:"+id+"*** nombre:"+nombre)
    tablaEmpleadosArea = new dhtmlXGridObject('divTablaResultadosEmpleados');
    tablaEmpleadosArea.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaEmpleadosArea.setSkin("dhx_skyblue");
    tablaEmpleadosArea.enableRowsHover(true, 'grid_hover');


    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaEmpleadosArea.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    tablaEmpleadosArea.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        ;
    });
    /////////////fin cargador ///////////////////////


    tablaEmpleadosArea.attachEvent("onRowDblClicked", function (rId, cInd) {
        // var c_cod_per=tablaEmpleadosArea.cells(rId, 1).getValue();
        registroDatosPersonalDetalle(rId, cInd, 'tablaEmpleadosArea');

    });
    tablaEmpleadosArea.init();
    tablaEmpleadosArea.loadXML(pathRequestControl + '?' + parametros);
}


function buscarEmpleadosAreasHorarios(id, nombre) {
    var estado = $('comboTipoEstados').value;
    var parametros = "p1=busquedaEmpleadosAreas";
    parametros += "&p2=" + id;
    parametros += "&p3=" + estado;
    //    alert("id:"+id+"*** nombre:"+nombre)
    var ablaEmpleadosArea = new dhtmlXGridObject('divTablaResultadosEmpleados');
    ablaEmpleadosArea.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    ablaEmpleadosArea.setSkin("dhx_skyblue");
    ablaEmpleadosArea.enableRowsHover(true, 'grid_hover');


    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    ablaEmpleadosArea.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    ablaEmpleadosArea.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        ;
    });
    /////////////fin cargador ///////////////////////
    ablaEmpleadosArea.attachEvent("onRowDblClicked", function (rId, cInd) {
        var codEmpleado = ablaEmpleadosArea.cells(rId, 0).getValue();
        var codPer = ablaEmpleadosArea.cells(rId, 1).getValue();
        var vNombreCompleto = ablaEmpleadosArea.cells(rId, 2).getValue();
        var vArea = ablaEmpleadosArea.cells(rId, 3).getValue();
        var vSede = ablaEmpleadosArea.cells(rId, 4).getValue();
        var vPuesto = ablaEmpleadosArea.cells(rId, 5).getValue();
        var vTipoContrato = ablaEmpleadosArea.cells(rId, 6).getValue();
        var iIdModalidadContrato = ablaEmpleadosArea.cells(rId, 7).getValue();
        //        alert(vArea);
        document.getElementById("div_nombreempleadoTrabajdor").innerHTML = '<table > <thead>' +
                '<tr  bgcolor="#A2DF71"><th  style="width: 120px">Sede</th> <th style="width: 150px">Area</th>'
                + ' <th style="width: 400px">Nombre Ap.</th> <th style="width: 180px">Puesto</th><th style="width: 180px">Tipo Contrato</th>'
                + '</thead><tbody>'
                + '<tr align="center" bgcolor="#F7F7DD"><td><b>' + vSede + '</b></td><td><b>' + vArea
                + '</b></td><td><b>' + vNombreCompleto + '</b></td><td><b>' + vPuesto + '</b></td><td><b>'
                + vTipoContrato + '</b></td></tr> </tbody></table>';
        BusquedaEmpleadoHorario(codEmpleado, codPer, vNombreCompleto, iIdModalidadContrato, cInd);
    });
    ablaEmpleadosArea.init();
    ablaEmpleadosArea.loadXML(pathRequestControl + '?' + parametros);
}

function buscarEmpleadosAreasNombreHorario() {
    alert(123456789);
    var c_cod_per = document.getElementById('txtCodigo').value;
    var comboTipoEstados = document.getElementById('comboTipoEstados').value;
    var comboTipoDocumentos = document.getElementById('comboTipoDocumentos').value;
    var nroDoc = document.getElementById('nroDoc').value;
    var apellidoPaterno = document.getElementById('apellidoPaterno').value;
    var apellidoMaterno = document.getElementById('apellidoMaterno').value;
    var nombres = document.getElementById('nombres').value;


    var parametros = "p1=buscarEmpleadosAreasNombre&p2=" + comboTipoEstados
            + "&p3=" + c_cod_per + "&p4=" + apellidoPaterno
            + "&p5=" + apellidoMaterno + "&p6=" + nombres + "&p7=" + comboTipoDocumentos
            + "&p8=" + nroDoc;
    //alert("id:"+id+"*** nombre:"+nombre)
    tablaEmpleadosArea = new dhtmlXGridObject('divTablaResultadosEmpleados');
    tablaEmpleadosArea.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaEmpleadosArea.setSkin("dhx_skyblue");
    tablaEmpleadosArea.enableRowsHover(true, 'grid_hover');


    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaEmpleadosArea.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    tablaEmpleadosArea.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        ;
    });
    /////////////fin cargador ///////////////////////


    tablaEmpleadosArea.attachEvent("onRowDblClicked", function (rId, cInd) {
        var codEmpleado = tablaEmpleadosArea.cells(rId, 0).getValue();
        var codPer = tablaEmpleadosArea.cells(rId, 1).getValue();
        var vNombreCompleto = tablaEmpleadosArea.cells(rId, 2).getValue();
        var vArea = tablaEmpleadosArea.cells(rId, 3).getValue();
        var vSede = tablaEmpleadosArea.cells(rId, 4).getValue();
        var vPuesto = tablaEmpleadosArea.cells(rId, 5).getValue();
        var vTipoContrato = tablaEmpleadosArea.cells(rId, 6).getValue();
        //        alert(vArea);
        document.getElementById("div_nombreempleadoTrabajdor").innerHTML = '<table > <thead>' +
                '<tr  bgcolor="#A2DF71"><th  style="width: 120px">Sede</th> <th style="width: 150px">Area</th>'
                + ' <th style="width: 400px">Nombre Ap.</th> <th style="width: 180px">Puesto</th><th style="width: 180px">Tipo Contrato</th>'
                + '</thead><tbody>'
                + '<tr align="center" bgcolor="#F7F7DD"><td><b>' + vSede + '</b></td><td><b>' + vArea
                + '</b></td><td><b>' + vNombreCompleto + '</b></td><td><b>' + vPuesto + '</b></td><td><b>'
                + vTipoContrato + '</b></td></tr> </tbody></table>';
        BusquedaEmpleadoHorario(codEmpleado, codPer, vNombreCompleto);
    });
    tablaEmpleadosArea.init();
    tablaEmpleadosArea.loadXML(pathRequestControl + '?' + parametros);
}
function ListadoFiltradoAreas($nombre) {
    //    alert("probando");

    patronModulo = "ListadoFiltradoAreas";

    parametros = '';
    parametros += 'p1=' + patronModulo;

    parametros += '&p2=' + $nombre;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            //respuesta="holaaaaaaa generando codigo";
            $('Div_BusquedaxArea').update(respuesta);
            // actualizarArbolCCostos();

        }
    })

}





function empleadosXPuestos(elemento, evento, idPuesto) {
    patronModulo1 = 'empleadosXPuestos';
    estado = document.getElementById('comboTipoEstados').value;

    if ((estado) == '0001' || (estado) == '0000') {
        estado = '';
    }
    if ((estado) == '0002') {
        estado = 1;
    }
    if (estado == '0003') {
        estado = 0;
    }

    parametros1 = '';
    parametros1 += 'p1=' + patronModulo1;
    parametros1 += '&p2=' + idPuesto;
    parametros1 += '&p3=' + estado;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros1,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('divdetallePersonal_1').update(respuesta);
        }
    })
}
function limpiaBusquedas(opc, elemento, evento) {
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
    } else {
        tecla = evento.keyCode
    }
    if (tecla == 13) {
        $cod = document.getElementById('txtCodigo').value;
        $estado = document.getElementById('comboTipoEstados').value;
        $tipoDoc = document.getElementById('comboTipoDocumentos').value;
        $nDoc = document.getElementById('nroDoc').value;
        $apPat = document.getElementById('apellidoPaterno').value;
        $apMat = document.getElementById('apellidoMaterno').value;
        $nombre = document.getElementById('nombres').value;
        buscarEmpleados($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre);
    }
}


function limpiaBusquedasHorarios(opc, elemento, evento) {
    //    alert(123456);
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
    } else {
        tecla = evento.keyCode
    }
    if (tecla == 13) {
        $cod = document.getElementById('txtCodigo').value;
        $estado = document.getElementById('comboTipoEstados').value;
        $tipoDoc = document.getElementById('comboTipoDocumentos').value;
        $nDoc = document.getElementById('nroDoc').value;
        $apPat = document.getElementById('apellidoPaterno').value;
        $apMat = document.getElementById('apellidoMaterno').value;
        $nombre = document.getElementById('nombres').value;
        buscarEmpleadosHorario($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre);
    }
}

function limpiaBusquedasPopap(opc, elemento, evento) {
    switch (opc)
    {
        case "01": //Busqueda por codigo

            //        document.getElementById('comboTipoEstados').selected="selected";
            //        document.getElementById('comboTipoEstados').value="0002" ;
            document.getElementById('comboTipoDocumentos').selected = "selected";
            document.getElementById('comboTipoDocumentos').value = "0000";
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

        case "10": //Busqueda por docuemnto
            //            document.getElementById('txtCodigo').value='';
            //        document.getElementById('comboTipoEstados').selected="selected";
            //        document.getElementById('comboTipoEstados').value="0002" ;

            document.getElementById('apellidoPaterno').value = '';
            document.getElementById('apellidoMaterno').value = '';
            document.getElementById('nombres').value = '';
            break;





    }
    if (evento == '') {
        tecla = 13;
    } else {
        tecla = evento.keyCode
    }
    if (tecla == 13) {
        $cod = document.getElementById('txtCodigo').value;
        $estado = document.getElementById('comboTipoEstados').value;
        $tipoDoc = document.getElementById('comboTipoDocumentos').value;
        $nDoc = document.getElementById('nroDoc').value;
        $apPat = document.getElementById('apellidoPaterno').value;
        $apMat = document.getElementById('apellidoMaterno').value;
        $nombre = document.getElementById('nombres').value;
        buscarEmpleadosPopap($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre);
    }


}

/*FUNCION PARA TRAER EL ARBOL ARMADO DE CETNRO DE COSTOS*/
function recargarArbolCCostos()
{
    myDiv = document.getElementById('divOpcPersonal');
    myDiv.innerHTML = " ";
    tree1 = new dhtmlXTreeObject("divOpcPersonal", "100%", "100%", 0);
    tree1.setImagePath("../../../../fastmedical_front/imagen/icono/tree/");
    tree1.attachEvent("onClick", function () {
        clickCargaCcostos(tree1.getSelectedItemId(), tree1.getSelectedItemText());
        return true;
    }
    )
    tree1.loadXML("../../../../carpetaDocumentos/arbol_centroCostos.xml");
    tree1.openAllItems(0);

}
function busquedaArbol1() {
    tree1.findItem($("txtBusquedaArbolx").value);
}
function clickCargaCcostos($id)
{
    $estado = $('comboTipoEstados').value;
    estado = $estado;
    if (($estado) == '0001' || ($estado) == '0000') {
        estado = '';
    }
    if (($estado) == '0002') {
        estado = 1;
    }
    if ($estado == '0003') {
        estado = 0;
    }
    patronModulo = 'mostrarEmpleadosCC';
    cod = $id;
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + cod;
    parametros += '&p3=' + estado;
    //
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('divdetallePersonal_1').update(respuesta);
        }
    })
    puestoCentroCosto($id);
}
function puestoCentroCosto(id) {
    patronModulo1 = 'puestoCentroCosto';

    parametros1 = '';
    parametros1 += 'p1=' + patronModulo1;
    parametros1 += '&p2=' + id;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros1,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('divPuestos').update(respuesta);
        }
    })
}

//function obtenerfecha($fecha){
//    document.getElementById('txtDesde').value=$fecha;
//   // mCal.minimize();
//    mDCal.hide();
//    mDCal.close();
//    document.getElementById('txtCalD').type='text';
//    document.getElementById('txtCalD').value='1';
//    document.getElementById('txtCalH').type='text';
//    document.getElementById('txtCalH').value='1';
//    //document.getElementById("DivTextDesde").style.visiblity='visible';
//}

/******************** MENU DE OPCIONES PARA LOS DATOS DEL PERSONAL ************************/
function recargarArbolMenuRegistro()
{
    myDiv = document.getElementById('divIzqSupRegistroP');
    myDiv.innerHTML = " ";
    tree = new dhtmlXTreeObject("divIzqSupRegistroP", "100%", "100%", 0);
    tree.setImagePath("../../../../fastmedical_front/imagen/icono/tree/");
    tree.attachEvent("onClick", function () {
        clickMenuRegistro(tree.getSelectedItemId(), tree.getSelectedItemText());
        return true;
    })
    tree.loadXML("../../../javascript/xml/arbolRegistraEmpleado.xml");
    //    myDiv=document.getElementById('divIzqInf');
    //    myDiv.innerHTML ="<a href='javascript:registroDatosPersonal();'><img border='0' title='Búsqueda Personal' style='width: 10px;' src='../../../../fastmedical_front/imagen/btn/b_regresar_on.gif'/></a>";

    tree.openAllItems(0);
}

function clickMenuRegistro(id)
{
    //    document.getElementById('divPersonal').style.height='600px';
    switch (id)
    {
        case "RRHH0002":
            mostrarDatosPersonales();
            break;
        case "RRHH0003":
            //mostrarPuestoAct();
            //document.getElementById('divPersonal').style.height='740px';
            mostrarContratos();
            break;
        case "RRHH0004":
            mostrarExperienciaLab();
            break;
        case "RRHH0005":
            mostrarEstudiosSup();
            break;
        case "RRHH0006":
            mostrarIdiomas();
            break;
        case "RRHH0007":
            mostrarConocimientos();
            break;

        case "RRHH0009":
            mostrarInvestigacion();
            break;

        case "RRHH0011":
            mostrarLogros();
            break;
        case "RRHH0012":
            mostrarReferenciasPers();
            break;
        case "RRHH0013":
            mostrarLegajo();
            break;
            //2012/02/09 12:pm    
        case "RRHH0014":
            mostrarUsuario();
            document.getElementById('divPersonal').style.height = '740px';
            break;
        case "RRHH0015":
            mantenimientoCaja();
            //           document.getElementById('divPersonal').style.height='740px';
            break;
        case "RRHH0016":
            programacionAsistenciaPersonalRRHH();
            //           document.getElementById('divPersonal').style.height='740px';
            break;
            //
    }
}


function mostrarContratos() {
    var c_cod_per = document.getElementById('txtCodPer').value;
    var nombre = document.getElementById('txtNomPer').value;
    var codigoEmpleado = document.getElementById('txtcodigoEmpleado').value;
    var patronModulo = 'mostrarContratos';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + c_cod_per;
    parametros += '&p3=' + nombre;
    parametros += '&p4=' + codigoEmpleado;

    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('divDerRegistroP').update(respuesta);
            cargarTablaContratos(codigoEmpleado);
        }
    })
}

function cargarTablaContratos(codigoEmpleado) {

    var parametros = "p1=cargarTablaContratos";
    parametros += "&p2=" + codigoEmpleado;


    tablaContratos = new dhtmlXGridObject('divTablaContrato');
    tablaContratos.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaContratos.setSkin("dhx_skyblue");
    tablaContratos.enableRowsHover(true, 'grid_hover');


    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaContratos.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    tablaContratos.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        var estado;
        for (var i = 0; i < tablaContratos.getRowsNum(); i++) {
            estado = tablaContratos.cells(i, 6).getValue();
            if (estado == '1')
                tablaContratos.setRowTextStyle(tablaContratos.getRowId(i), 'background-color:#C1E69D;color:black;border-top: 1px solid #DAEFC2;');
            else if (estado == '0')
                tablaContratos.setRowTextStyle(tablaContratos.getRowId(i), 'background-color:#D12521;color:black;border-top: 1px solid #FFD7BB;');

        }
    });
    /////////////fin cargador ///////////////////////
    tablaContratos.attachEvent("onRowDblClicked", function (rId, cInd) {
    });
    // JCDB 04/05/2012 --- VACACIONES
    tablaContratos.attachEvent("onRowSelect", function (x, y) {
        if (y == 9) {
            vacaciones();
        }
        if (y == 10) {
            verDetalleContrato(x, y);
        }
        //////agregado por peche
        if (y != 9 || y != 10) {

            var estadoContrato = tablaContratos.cells(x, 6).getValue();
            verTablaAreaPuestoEmpleado(tablaContratos.cells(x, 8).getValue(), estadoContrato);
            if (estadoContrato == 1) {
                $('btn_AsignarArea').show();
            } else {
                $('btn_AsignarArea').hide();
            }
        }

        /////////////////////////
    });
    //FIN VACACIONES
    tablaContratos.init();
    tablaContratos.loadXML(pathRequestControl + '?' + parametros);
}

function verTablaAreaPuestoEmpleado(idPuestoEmpleado, estadoContrato) {

    var parametros = "p1=verTablaAreasPuestoEmpleado";
    parametros += "&p2=" + idPuestoEmpleado;
    parametros += "&p3=" + estadoContrato;
    $('hPuestoEmpleado').value = idPuestoEmpleado;

    tablaPuestoEmpleadoArea = new dhtmlXGridObject('divTablaAreaPuestoEmpleado');
    tablaPuestoEmpleadoArea.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaPuestoEmpleadoArea.setSkin("dhx_skyblue");
    tablaPuestoEmpleadoArea.enableRowsHover(true, 'grid_hover');
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaPuestoEmpleadoArea.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    tablaPuestoEmpleadoArea.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        var estado;
        for (var i = 0; i < tablaPuestoEmpleadoArea.getRowsNum(); i++) {
            estado = tablaPuestoEmpleadoArea.cells(i, 3).getValue();
            if (estado == '1')
                tablaPuestoEmpleadoArea.setRowTextStyle(tablaPuestoEmpleadoArea.getRowId(i), 'background-color:#C1E69D;color:black;border-top: 1px solid #DAEFC2;');
            else if (estado == '0')
                tablaPuestoEmpleadoArea.setRowTextStyle(tablaPuestoEmpleadoArea.getRowId(i), 'background-color:#D12521;color:black;border-top: 1px solid #FFD7BB;');

        }

    });
    /////////////fin cargador ///////////////////////
    tablaPuestoEmpleadoArea.attachEvent("onRowSelect", function (x, y) {
        if (y == 4) {
            var idPuestoEmpleadoporArea = tablaPuestoEmpleadoArea.cells(x, 0).getValue();
            var estadoPuestoempleadoArea = tablaPuestoEmpleadoArea.cells(x, 3).getValue();
            cambiarEstadoPuestoempleadoArea(idPuestoEmpleadoporArea, estadoPuestoempleadoArea);
        }
        /////////////////////////
    });
    //FIN VACACIONES
    tablaPuestoEmpleadoArea.init();
    tablaPuestoEmpleadoArea.loadXML(pathRequestControl + '?' + parametros);
}
function cambiarEstadoPuestoempleadoArea(idPuestoEmpleadoporArea, estadoPuestoempleadoArea) {
    var mensaje = '';
    var mensajeRespuesta = ''
    if (estadoPuestoempleadoArea == 1) {
        mensaje = 'Está seguro de desactivar el area del puesto del Empleado?';
        mensajeRespuesta = 'se desactivó el area del puesto empleado: '
    } else {
        mensaje = 'Está seguro de activar el area del puesto del Empleado?';
        mensajeRespuesta = 'se Activó el area del puesto empleado: '
    }
    if (confirm(mensaje)) {
        var patronModulo = 'cambiarEstadoPuestoEmpleadoArea';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += "&p2=" + idPuestoEmpleadoporArea;
        parametros += "&p3=" + estadoPuestoempleadoArea;
        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false,
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function (transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                alert(mensajeRespuesta + respuesta);
                var idPuestoEmpleado = $('hPuestoEmpleado').value;
                verTablaAreaPuestoEmpleado(idPuestoEmpleado, 1);
            }
        })
    }

}

function getCodEmpleado()
{
    // document.getElementById("divRegistraP").style.visibility='visible';
    codigo = document.getElementById("txtCodPer").value;
    //document.getElementById("txtCopEmp").type='text';
    patronModulo = 'obtenerIdEmpleado';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            var miarray = respuesta.split("|");
            // alert("Sayes");
            $('txtcodigoEmpleado').value = miarray[0];

            //$('txtCopEmp').update(respuesta);
        }
    })
}


/************ Llamada a las categorias de datos de empleado ******************/
/******************** PRIEMRA CATEGORIA QUE SE MOSTRARA Y ADECUA LA INTERFAZ ***************/
function mostrarDatosPersonales() {
    path = '../../ccontrol/control/control.php?p1=mostrar_datos_paciente_admision&p2=' + document.getElementById("txtCodPer").value + '&p3=&funcionJSEjecutar=' + '';


    var parametros = '';
    new Ajax.Request(path, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            getCodEmpleado();
            var respuesta = transport.responseText;
            $('divDerRegistroP').update(respuesta);

        }
    })
}
//////////////puestos por emppleado





function grabarContrato() {
    ///creado por peche
    var valido = true;
    var mensaje = '';
    var idPuesto = $('txtidPuesto').value;
    var idContrato = $('txtNumeroContrato').value;
    var inicio = $('txtInicio').value;
    var fin = $('txtFin').value;
    var modalidadContrato = $('comboModalidadContrato').value;
    var tiposueldo = $('comboTipoSueldo').value;
    var sueldo = $('txtSueldo').value;
    var tipoProgramacion = $('comboTipoProgramacion').value;
    var estadoContrato = $('comboEstado').value;
    var icodigoEmpleado = $('txtcodigoEmpleado').value;
    var accion = $('txtAccion').value;
    var fechaAnulacion = $('textFechaAnulacion').value;
    var motivoAnulacion = $('textMotivoAnulacion').value;
    //var accion='';

    if (idPuesto == '') {
        valido = false;
        mensaje = mensaje + 'Ingrese Puesto Laboral';
    }
    if (inicio == '') {
        valido = false;
        mensaje = mensaje + ', Ingrese inicio del Contrato';
    }
    if (fin == '') {
        valido = false;
        mensaje = mensaje + ', Ingrese fin del Contrato';
    }
    if (modalidadContrato == '0000') {
        valido = false;
        mensaje = mensaje + ', Ingrese la modalidad del Contrato';
    }
    if (tiposueldo == '0000') {
        valido = false;
        mensaje = mensaje + ', Ingrese el tipo del sueldo';
    }
    if (sueldo == '') {
        valido = false;
        mensaje = mensaje + ', Ingrese sueldo';
    }
    if (tipoProgramacion == '0000') {
        valido = false;
        mensaje = mensaje + ', Ingrese Tipo de Programacion';
    }
    if (fin != '' && inicio != '') {

        var arrayInicio = inicio.split("/");
        var arrayFin = fin.split("/");
        var estadoFecha;
        //alert(arrayInicio[0]);//dia
        //alert(arrayInicio[1]);// mes
        //alert(arrayInicio[2]);// añño

        if (parseInt(arrayInicio[2]) < parseInt(arrayFin[2])) {
            estadoFecha = true;
        } else {
            if (parseInt(arrayInicio[2]) > parseInt(arrayFin[2])) {
                estadoFecha = false;
            } else {
                if (parseInt(arrayInicio[2]) == parseInt(arrayFin[2])) {
                    if (parseInt(arrayInicio[1]) < parseInt(arrayFin[1])) {
                        estadoFecha = true;
                    } else {
                        if (parseInt(arrayInicio[1]) > parseInt(arrayFin[1])) {
                            estadoFecha = false;
                        } else {
                            if (parseInt(arrayInicio[1]) == parseInt(arrayFin[1])) {
                                if (arrayInicio[0] < arrayFin[0]) {
                                    estadoFecha = true;
                                } else {
                                    estadoFecha = false;
                                }
                            }
                        }
                    }
                }
            }
        }

        if (estadoFecha == false) {
            valido = false;
            mensaje = 'La fecha inicio debe ser menor a la fecha fin';
        }

    }
    if (valido) {
        var patronModulo = 'grabarMantenimientoContrato';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + idContrato;
        parametros += '&p3=' + idPuesto;
        parametros += '&p4=' + inicio;
        parametros += '&p5=' + fin;
        parametros += '&p6=' + modalidadContrato;
        parametros += '&p7=' + tiposueldo;
        parametros += '&p8=' + sueldo;
        parametros += '&p9=' + tipoProgramacion;
        parametros += '&p10=' + estadoContrato;
        parametros += '&p11=' + icodigoEmpleado;
        parametros += '&p12=' + accion;
        parametros += '&p13=' + fechaAnulacion;
        parametros += '&p14=' + motivoAnulacion;
        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false,
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function (transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                alert('se registro el con exito Contrato nro: ' + respuesta);
                Windows.close("Div_formularioContrato");
                mostrarContratos();
                //$('Div_GeneralActoMedicoHC').update(respuesta);
            }
        })
    } else {
        alert(mensaje);
    }

}

function desactivarModatidadContrata(opt) {
    if ($("hidIdEmpModCon").value != "" || opt == 0) {
        var campoModalidad = ["cboModContrato", "txtSueldo", "txtFechaIni", "txtFechaFin", "cboTipoSueldo"];
        deshabilitarCampos(campoModalidad);
        $("btnGrabar").hide();
        $("btnEditar").show();
        $("btnModificar").hide();
    }
}
function verDetalleContrato(x, y) {
    var idContrato = tablaContratos.cells(x, 0).getValue();
    var accion = '2';
    var idPuestoEmpleado = tablaContratos.cells(x, 8).getValue();
    ventanaMantenimientoContrato(accion, idContrato, idPuestoEmpleado);

}

function ventanaMantenimientoContrato(accion, idContrato, idPuestoEmpleado) {
    var vformname = 'formularioContrato'
    var vtitle = 'Contrato de empleado'
    var vwidth = '500'
    var vheight = '480'
    var vcenter = 't'
    var vresizable = ''
    var vmodal = 'false'
    var vstyle = ''
    var vopacity = ''
    var vposx1 = ''
    var vposx2 = ''
    var vposy1 = ''
    var vposy2 = ''

    var patronModulo = 'mantenimientoContrato';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + accion;
    parametros += '&p3=' + idContrato;
    parametros += '&p4=' + idPuestoEmpleado;
    var posFuncion = '';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
}
function verBuscadorAreas() {
    var vformname = 'AreaSede'
    var vtitle = 'Buscar Area Sede'
    var vwidth = '500'
    var vheight = '480'
    var vcenter = 't'
    var vresizable = ''
    var vmodal = 'false'
    var vstyle = ''
    var vopacity = ''
    var vposx1 = ''
    var vposx2 = ''
    var vposy1 = ''
    var vposy2 = ''
    var funcionArbol = 'asignarAreaPuestoEmpleado';
    var patronModulo = 'buscarAreas';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + funcionArbol;

    var posFuncion = 'cargarArbolHMLO';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
}
function cargarArbolHMLO(sede) {
    sede = $('cboSede').value;
    var parametros = "p1=arbolAreas";
    parametros += "&p2=" + sede;
    divMostrar = document.getElementById('divArbolAreasSedes');
    divMostrar.innerHTML = " ";
    treeArbolAreaSede = new dhtmlXTreeObject("divArbolAreasSedes", "100%", "100%", 0);
    treeArbolAreaSede.setSkin('dhx_skyblue');
    treeArbolAreaSede.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    treeArbolAreaSede.attachEvent("onClick", function (idArea, nombre) {

        asignarAreaSedePuestoEmpleado(idArea, sede, $('hPuestoEmpleado').value);
    });
    treeArbolAreaSede.openAllItems(0);
    treeArbolAreaSede.loadXML(pathRequestControl + '?' + parametros);
}
function asignarAreaSedePuestoEmpleado(idArea, sede, idPuestoEmpleado) {
    if (window.confirm('Seguro de Asignar el Area?')) {
        var patronModulo = 'asignarPuestoEmpleadoArea';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += "&p2=" + idArea;
        parametros += "&p3=" + sede;
        parametros += "&p4=" + idPuestoEmpleado;
        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false,
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function (transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                alert('se registro el area por puesto del empleado nro: ' + respuesta);
                Windows.close("Div_AreaSede");
                var idPuestoEmpleado = $('hPuestoEmpleado').value;
                verTablaAreaPuestoEmpleado(idPuestoEmpleado, 1);
            }
        })
    }

}
function anularContrato() {
    //por peche para anular contratos
    //08-05-2012
    if (window.confirm('Si anula el contrato Desactivará las vacaciones y las programaciones que pueda tener el empleado, Esta realmente SEGURO de Realizar esta ANULACION')) {
        var campos = new Array();
        campos[0] = 'txtInicio';
        campos[1] = 'txtFin';
        campos[2] = 'comboModalidadContrato';
        campos[3] = 'comboTipoSueldo';
        campos[4] = 'txtSueldo';
        campos[5] = 'comboTipoProgramacion';
        campos[6] = 'comboEstado';


        $('divFechaAnulacion').show();
        $('divTextAnulacion').show();
        $('btn_grabarContrato').hide();
        $('btn_AnularContrato').hide()
        $('btn_grabarAnularContrato').show();
        $('textFechaAnulacion').value = $('txtFechaActual').value;
        deshabilitarCampos(campos);
    }
}


function confirmarAnulación() {
    var fechaAnulacion = $('textFechaAnulacion').value;
    var motivoAnulacion = $('textMotivoAnulacion').value;
    var valido = true;
    var mensaje = '';

    if (fechaAnulacion == '') {
        valido = false;
        mensaje = mensaje + 'Ingrese la Fecha de anulación';
    }
    if (motivoAnulacion == '') {
        valido = false;
        mensaje = mensaje + ', Ingrese el motivo de la anulación del contrato';
    }

    if (valido) {
        if (confirm('está realmente, recontra seguro de querer anular el contrato?')) {
            $('txtAccion').value = '3';
            var idPuesto = $('txtidPuesto').value;
            var idContrato = $('txtNumeroContrato').value;
            var inicio = $('txtInicio').value;
            var fin = $('txtFin').value;
            var modalidadContrato = $('comboModalidadContrato').value;
            var tiposueldo = $('comboTipoSueldo').value;
            var sueldo = $('txtSueldo').value;
            var tipoProgramacion = $('comboTipoProgramacion').value;
            var estadoContrato = $('comboEstado').value;
            var icodigoEmpleado = $('txtcodigoEmpleado').value;
            var accion = $('txtAccion').value;
            var patronModulo = 'grabarMantenimientoContrato';
            var parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + idContrato;
            parametros += '&p3=' + idPuesto;
            parametros += '&p4=' + inicio;
            parametros += '&p5=' + fin;
            parametros += '&p6=' + modalidadContrato;
            parametros += '&p7=' + tiposueldo;
            parametros += '&p8=' + sueldo;
            parametros += '&p9=' + tipoProgramacion;
            parametros += '&p10=' + estadoContrato;
            parametros += '&p11=' + icodigoEmpleado;
            parametros += '&p12=' + accion;
            parametros += '&p13=' + fechaAnulacion;
            parametros += '&p14=' + motivoAnulacion;
            contadorCargador++;
            var idCargador = contadorCargador;
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                asynchronous: false,
                parameters: parametros,
                onLoading: cargadorpeche(1, idCargador),
                onComplete: function (transport) {
                    cargadorpeche(0, idCargador);
                    var respuesta = transport.responseText;

                    Windows.close("Div_formularioContrato");
                    alert('se Anulo el con exito Contrato nro: ' + respuesta);
                    mostrarContratos();

                    //$('Div_GeneralActoMedicoHC').update(respuesta);
                }
            })

        } else {
            //alert('no');
        }
    } else {
        alert(mensaje);
    }
}
function editarContrato() {
    habilitarCampos(campoModContrato1);
    $("btnSedeEA").hide();
    $("btnEditar").hide();
    $("btnModificar").show();
}
function ventanaCambiarEstadoPuestoEmpleado() {
    idPuestoEmpleado = $('hIdPuestoEmpleado').value;

    vformname = 'cambiarEstadoPuestoEmpleado'
    vtitle = ''
    vwidth = '250'
    vheight = '200'
    vcenter = 't'
    vresizable = ''
    vmodal = 'false'
    vstyle = ''
    vopacity = ''

    vposx1 = ''
    vposx2 = ''
    vposy1 = ''
    vposy2 = ''

    patronModulo = 'ventanaCambiarEstadoPuestoEmpleado';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    var fechaIni = $("txtFechaIni").value;
    var fechaFin = $("txtFechaFin").value;
    parametros += '&p2=' + idPuestoEmpleado + '&p3=' + fechaIni + '&p4=' + fechaFin;

    posFuncion = '';
    //CargarVentana('formBuscadorPersonas','Edición de personas','../../ccontrol/control/control.php?p1=mostrar_datos_paciente_admision&p2='+c_cod_per,'900','650',false,true,'',1,'',10,10,10,10);
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
}

function ventanaEditarPeriodos(iidPeriodo) {



    vformname = 'ventanaEditarPeriodos'
    vtitle = ''
    vwidth = '250'
    vheight = '200'
    vcenter = 't'
    vresizable = ''
    vmodal = 'false'
    vstyle = ''
    vopacity = ''

    vposx1 = ''
    vposx2 = ''
    vposy1 = ''
    vposy2 = ''

    patronModulo = 'ventanaEditarPeriodos';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iidPeriodo;

    posFuncion = '';
    //CargarVentana('formBuscadorPersonas','Edición de personas','../../ccontrol/control/control.php?p1=mostrar_datos_paciente_admision&p2='+c_cod_per,'900','650',false,true,'',1,'',10,10,10,10);
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
}

function detallePeriodosPuestoEmpleados(idPuestoEmpleado) {
    patronModulo = 'detallePeriodosPuestoEmpleados';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + idPuestoEmpleado;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta1 = transport.responseText;
            //window.alert(respuesta);
            $('cell52').update(respuesta1);  // div que contiene los periodos
        }
    })

}

/**************************** EXPERIENCIA LABORAL **********************************/
function mostrarExperienciaLab() {
    var patronModulo = 'llenarExpLab';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            $('divDerRegistroP').update(respuesta);
            document.getElementById('txtAccion').value = 0;
            mostrarTExpLaboral(document.getElementById('txtCodPer').value);

        }
    })
}

function mostrarTExpLaboral($cod)
{
    //document.getElementById('txtCategoria').type='text';
    document.getElementById('txtCategoria').value = '02';
    var codigo = $cod;
    var patronModulo = 'mostrarExpLaboral';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;

    tExpLaboral = new dhtmlXGridObject('divDatosExperiencia');
    tExpLaboral.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tExpLaboral.setSkin("dhx_skyblue");
    tExpLaboral.enableRowsHover(true, 'grid_hover');

    contadorCargador++;
    var idCargador = contadorCargador;
    //tExpLaboral.attachEvent("onRowSelect",expLaboralDetalle );
    tExpLaboral.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);

    });
    tExpLaboral.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    tExpLaboral.attachEvent("onRowSelect", function (x, y) {

        expLaboralDetalle(tExpLaboral.cells(x, 4).getValue());



        /////////////////////////
    });
    tExpLaboral.init();
    tExpLaboral.loadXML(pathRequestControl + '?' + parametros);
}


function expLaboralDetalle(id)
{
    codigo = id;
    opc = '2';
    patronModulo = 'expLaboralDetalle';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    parametros += '&p3=' + opc;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            var miarray = respuesta.split("|");
            document.getElementById('txtInstitucion').disabled = true;
            document.getElementById('txtCargo').disabled = true;
            document.getElementById('txtDesde').disabled = true;
            document.getElementById('txtHasta').disabled = true;
            document.getElementById('txtInstitucion').value = miarray[0];
            document.getElementById('txtCargo').value = miarray[1];
            document.getElementById('txtDesde').value = miarray[2];
            document.getElementById('txtHasta').value = miarray[3];
            document.getElementById('txtId').value = miarray[4];
            document.getElementById('txtFunciones').value = miarray[5];
            // document.getElementById('txtId').type='text';
            document.getElementById('uno').style.visibility = 'visible';
            document.getElementById('dos').style.visibility = 'visible';
            document.getElementById('tres').style.visibility = 'visible';
            document.getElementById('cuatro').style.visibility = 'visible';
            document.getElementById('cinco').style.visibility = 'visible';
            document.getElementById('DivEliminar').style.visibility = 'visible';
            document.getElementById('DivEditar').style.visibility = 'visible';
            //$('divResultadoExperiencia').update(respuesta);
            // recargarArbolMenuRegistro();
        }
    })
// mostrarExperienciaLab();
}

/**************************** ESTUDIOS SUPERIORES **********************************/
function mostrarEstudiosSup() {
    patronModulo = 'llenarEstudiosSup';
    document.getElementById('divIzqRegistroP').style.height = '550px';
    document.getElementById('divDerRegistroP').style.height = '550px';
    parametros = '';
    opcion = 0;
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + opcion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);

            respuesta = transport.responseText;
            $('divDerRegistroP').update(respuesta);
            //llenarCombosEstudiosSup();
            document.getElementById('txtAccion').value = 0;
            mostrarTEstudiosSup(document.getElementById('txtCodPer').value);

        }
    })
}

function llenarInstitucion() {
    patronModulo = 'llenarEstudiosSup';
    parametros = '';
    opcion = document.getElementById('comboTipoEstudio').value;
    //opcion= 1;
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + opcion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            document.getElementById('divIzqRegistroP').disabled = false;
            document.getElementById('divIzqRegistroP').style.visibility = visible;
            $('DivSelectInstitucion').update(respuesta);
        }
    })
}

function mostrarTEstudiosSup($cod)
{
    //document.getElementById('txtCategoria').type='text';
    document.getElementById('txtCategoria').value = '03';
    codigo = $cod;
    patronModulo = 'mostrarEstudiosSup';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    //
    //    new Ajax.Request(pathRequestControl,{
    //        method : 'get',
    //        parameters : parametros,
    //        onLoading : micargador(1),
    //        onComplete : function(transport){
    //            micargador(0);
    //            myDiv=document.getElementById('divTitulo');
    //            myDiv.innerHTML =document.getElementById('txtNomPer').value;
    //            respuesta = transport.responseText;
    //            $('divDatosEstudios').update(respuesta);
    //
    //        }
    //    } )
    vDatosEstudios = new dhtmlXGridObject('divDatosEstudios');
    vDatosEstudios.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    vDatosEstudios.setSkin("dhx_skyblue");
    vDatosEstudios.enableRowsHover(true, 'grid_hover');

    contadorCargador++;
    var idCargador = contadorCargador;
    //tExpLaboral.attachEvent("onRowSelect",expLaboralDetalle );
    vDatosEstudios.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);

    });
    vDatosEstudios.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    vDatosEstudios.attachEvent("onRowSelect", function (x, y) {

        estSupDetalle(vDatosEstudios.cells(x, 5).getValue());



        /////////////////////////
    });
    vDatosEstudios.init();
    vDatosEstudios.loadXML(pathRequestControl + '?' + parametros);

}

function estSupDetalle(id)
{
    codigo = id;
    opc = '3';
    patronModulo = 'expLaboralDetalle';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    parametros += '&p3=' + opc;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            var miarray = respuesta.split("|");
            //window.alert("insititucion"+miarray[0]);
            document.getElementById('txtDesde').disabled = true;//reusado
            document.getElementById('txtHasta').disabled = true;//reusado
            document.getElementById('comboTipoEstudio').disabled = true;

            document.getElementById('txtInstitucion').disabled = true;//reusado
            document.getElementById('txtCargo').disabled = true; //profesion
            document.getElementById('comboEspecialidad').disabled = true;
            document.getElementById('comboEstado').disabled = true;
            document.getElementById('txtNivel').disabled = true;
            document.getElementById('comboTipoNivel').disabled = true;
            document.getElementById('txtFunciones').disabled = true;//reusado
            document.getElementById('txtDesde').value = miarray[0];//
            document.getElementById('txtHasta').value = miarray[1]; //
            document.getElementById('comboTipoEstudio').value = miarray[2];//
            document.getElementById('txtInstitucion').value = miarray[3];//
            document.getElementById('txtCargo').value = miarray[4]; //
            document.getElementById('comboEspecialidad').value = miarray[5]; //
            document.getElementById('comboEstado').value = miarray[6]; //
            document.getElementById('txtNivel').value = miarray[7];
            document.getElementById('comboTipoNivel').value = miarray[8]; //
            document.getElementById('txtFunciones').value = miarray[9]; //
            document.getElementById('txtId').value = miarray[10];
            //            window.alert(miarray[3]);
            //            window.alert(document.getElementById('txtInstitucion').value);
            //document.getElementById('txtId').type='text';
            document.getElementById('uno').style.visibility = 'visible';
            document.getElementById('dos').style.visibility = 'visible';
            document.getElementById('tres').style.visibility = 'visible';
            document.getElementById('cuatro').style.visibility = 'visible';
            document.getElementById('cinco').style.visibility = 'visible';
            document.getElementById('DivEliminar').style.visibility = 'visible';
            document.getElementById('DivEditar').style.visibility = 'visible';
            cambiaInstitucion(miarray[3]);
            cambiaEspecialidad(miarray[5]);
        }
    })
}

function cambiaInstitucion(cod) {
    //myajax.Link('../../ccontrol/control/control.php?p1=listaTipo&p2='+document.getElementById('comboTipoEstudio').value+'&p3='+document.getElementById('txtInstitucion').value,'dos');
    patronModulo = 'listaTipo';

    parametros = '';
    opcion = 3;
    if (document.getElementById('txtFunciones').disabled) {
        disabled = 'disabled';
    } else {
        disabled = '';
    }
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + document.getElementById('comboTipoEstudio').value;
    parametros += '&p3=' + document.getElementById('txtInstitucion').value;
    parametros += '&p4=' + disabled;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;

            $('divEtiquetaTipoEstudio').update(respuesta);
            document.getElementById('txtInstitucion').value = cod;
        }
    })
}

function cambiaEspecialidad(cod) {
    patronModulo = 'listaProf';
    parametros = '';
    opcion = 3;
    if (document.getElementById('txtFunciones').disabled) {
        disabled = 'disabled';
    } else {
        disabled = '';
    }
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + document.getElementById('txtCargo').value;
    parametros += '&p3=' + document.getElementById('comboEspecialidad').value;
    parametros += '&p4=' + disabled;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('divEtiquetaProfesion').update(respuesta);
            document.getElementById('comboEspecialidad').value = cod;
        }
    })
}
/**************************** IDIOMAS **********************************/
function mostrarIdiomas() {
    patronModulo = 'llenarIdiomas';
    document.getElementById('divIzqRegistroP').style.height = '550px';
    document.getElementById('divDerRegistroP').style.height = '550px';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {

        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('divDerRegistroP').update(respuesta);
            //llenarCombosEstudiosSup();
            document.getElementById('txtAccion').value = 0;
            mostrarTIidiomas(document.getElementById('txtCodPer').value);

        }
        //       $('divDerRegistroP').update(respuesta);
        //            document.getElementById('txtAccion').value=0;
        //            mostrarTExpLaboral(document.getElementById('txtCodPer').value);
    })

}

function mostrarTIidiomas($cod)
{
    //document.getElementById('txtCategoria').type='text';
    document.getElementById('txtCategoria').value = '04';
    patronModulo = 'mostrarIdiomas';
    parametros = '';
    codigo = $cod;
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    //    new Ajax.Request(pathRequestControl,{
    //        method : 'get',
    //        parameters : parametros,
    //        onLoading : micargador(1),
    //        onComplete : function(transport){
    //            micargador(0);
    //            myDiv=document.getElementById('divTitulo');
    //            myDiv.innerHTML =document.getElementById('txtNomPer').value;
    //            respuesta = transport.responseText;
    //            $('divDatosIdiomas').update(respuesta);
    //
    //        }
    //    } )
    vDatosIdiomas = new dhtmlXGridObject('divDatosIdiomas');
    vDatosIdiomas.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    vDatosIdiomas.setSkin("dhx_skyblue");
    vDatosIdiomas.enableRowsHover(true, 'grid_hover');

    contadorCargador++;
    var idCargador = contadorCargador;
    //tExpLaboral.attachEvent("onRowSelect",expLaboralDetalle );
    vDatosIdiomas.attachEvent("onXLS", function () {
        cargadorpeche(0, idCargador);

    });
    vDatosIdiomas.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    vDatosIdiomas.attachEvent("onRowSelect", function (x, y) {

        idiomaDetalle(vDatosIdiomas.cells(x, 3).getValue());



        /////////////////////////
    });
    vDatosIdiomas.init();
    vDatosIdiomas.loadXML(pathRequestControl + '?' + parametros);
}

function idiomaDetalle(id)
{
    codigo = id;
    opc = '4';
    patronModulo = 'expLaboralDetalle';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    parametros += '&p3=' + opc;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            var miarray = respuesta.split("|");
            document.getElementById('txtInstitucion').disabled = true;
            document.getElementById("txtCargo").disabled = true;
            //$especialidad."|".$Institucion."|".$id."|".$nivel."|
            //inistitucion->txtinsitucion-idioma->txtcargo-estado->txtfunciones-nivel->???
            document.getElementById('txtDesde').disabled = true;//reusado
            document.getElementById('txtHasta').disabled = true;//reusado
            document.getElementById('comboTipoEstudio').disabled = true;
            document.getElementById('txtInstitucion').disabled = true;//reusado
            document.getElementById('txtCargo').disabled = true; //profesion
            document.getElementById('comboEspecialidad').disabled = true;
            document.getElementById('comboEstado').disabled = true;
            document.getElementById('txtNivel').disabled = true;
            document.getElementById('comboTipoNivel').disabled = true;
            document.getElementById('txtFunciones').disabled = true;//reusado
            //$especialidad."|".$tipoEstudio."|".$Institucion."|".$Inicio."|".$Fin."|".$id
            //inicio->txtdesde-fin->txthasta-inistitucion->txtinsitucion-espcialidad->txtcargo-estado->txtfunciones-nivel->???
            document.getElementById('txtDesde').value = miarray[0];//
            document.getElementById('txtHasta').value = miarray[1]; //
            document.getElementById('comboTipoEstudio').value = miarray[2];//
            document.getElementById('txtInstitucion').value = miarray[3];//
            document.getElementById('txtCargo').value = miarray[4]; //
            document.getElementById('comboEspecialidad').value = miarray[5]; //
            document.getElementById('comboEstado').value = miarray[6]; //
            document.getElementById('txtNivel').value = miarray[7];
            document.getElementById('comboTipoNivel').value = miarray[8]; //
            document.getElementById('txtFunciones').value = miarray[9]; //
            document.getElementById('txtId').value = miarray[10];
            //document.getElementById('txtId').type='text';
            document.getElementById('uno').style.visibility = 'visible';
            document.getElementById('dos').style.visibility = 'visible';
            document.getElementById('tres').style.visibility = 'visible';
            document.getElementById('cuatro').style.visibility = 'visible';
            document.getElementById('cinco').style.visibility = 'visible';
            document.getElementById('DivEliminar').style.visibility = 'visible';
            document.getElementById('DivEditar').style.visibility = 'visible';
            //$('divResultadoExperiencia').update(respuesta);
        }
    })
// mostrarExperienciaLab();
}
/**************************** CONCOIMIENTOS **********************************/
function mostrarConocimientos() {
    patronModulo = 'llenarConocimientos';
    document.getElementById('divIzqRegistroP').style.height = '550px';
    document.getElementById('divDerRegistroP').style.height = '550px';
    parametros = '';
    opcion = 1;
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + opcion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);

            respuesta = transport.responseText;
            $('divDerRegistroP').update(respuesta);
            //llenarCombosEstudiosSup();
            document.getElementById('txtAccion').value = 0;
            mostrarTConocimientos(document.getElementById('txtCodPer').value);

        }
    })

// $('divDerRegistroP').update(respuesta);
//            //llenarCombosEstudiosSup();
//            document.getElementById('txtAccion').value=0;
//            mostrarTIidiomas(document.getElementById('txtCodPer').value);
}

function mostrarTConocimientos($cod)
{
    // document.getElementById("divRegistraP").style.visibility='visible';
    //document.getElementById('txtCategoria').type='text';
    document.getElementById('txtCategoria').value = '05';
    patronModulo = 'mostrarConocimientos';
    parametros = '';
    codigo = $cod;
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    //
    //    new Ajax.Request(pathRequestControl,{
    //        method : 'get',
    //        parameters : parametros,
    //        onLoading : micargador(1),
    //        onComplete : function(transport){
    //            micargador(0);
    //            myDiv=document.getElementById('divTitulo');
    //            myDiv.innerHTML =document.getElementById('txtNomPer').value;
    //            respuesta = transport.responseText;
    //            $('divDatosConocimientos').update(respuesta);
    //
    //        }
    //    } )
    vDatosConocimientos = new dhtmlXGridObject('divDatosConocimientos');
    vDatosConocimientos.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    vDatosConocimientos.setSkin("dhx_skyblue");
    vDatosConocimientos.enableRowsHover(true, 'grid_hover');

    contadorCargador++;
    var idCargador = contadorCargador;
    //tExpLaboral.attachEvent("onRowSelect",expLaboralDetalle );
    vDatosConocimientos.attachEvent("onXLS", function () {
        cargadorpeche(0, idCargador);

    });
    vDatosConocimientos.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    vDatosConocimientos.attachEvent("onRowSelect", function (x, y) {

        conocimientoDetalle(vDatosConocimientos.cells(x, 4).getValue());



        /////////////////////////
    });
    vDatosConocimientos.init();
    vDatosConocimientos.loadXML(pathRequestControl + '?' + parametros);
}

function conocimientoDetalle(id)
{
    codigo = id;
    opc = '5';
    patronModulo = 'expLaboralDetalle';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    parametros += '&p3=' + opc;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            var miarray = respuesta.split("|");
            document.getElementById('txtInstitucion').disabled = true;
            document.getElementById("txtCargo").disabled = true;
            //$especialidad."|".$Institucion."|".$id."|".$nivel."|
            //inistitucion->txtinsitucion-idioma->txtcargo-estado->txtfunciones-nivel->???
            document.getElementById('txtDesde').disabled = true;//reusado
            document.getElementById('txtHasta').disabled = true;//reusado
            document.getElementById('comboTipoEstudio').disabled = true;
            document.getElementById('txtInstitucion').disabled = true;//reusado
            document.getElementById('txtCargo').disabled = true; //profesion
            document.getElementById('comboEspecialidad').disabled = true;
            document.getElementById('comboEstado').disabled = true;
            document.getElementById('txtNivel').disabled = true;
            document.getElementById('comboTipoNivel').disabled = true;
            document.getElementById('txtFunciones').disabled = true;//reusado
            //$especialidad."|".$tipoEstudio."|".$Institucion."|".$Inicio."|".$Fin."|".$id
            //inicio->txtdesde-fin->txthasta-inistitucion->txtinsitucion-espcialidad->txtcargo-estado->txtfunciones-nivel->???
            //document.getElementById('txtDesde').value=miarray[0];//
            document.getElementById('txtHasta').value = miarray[6]; //
            document.getElementById('comboTipoEstudio').value = miarray[2];//
            if (document.getElementById('comboTipoEstudio').value == '3') {  //eventos
                $('divEtiquetaProfesion').hide();
                $('txtCargo').hide();
                document.getElementById('divEtiquetaHasta').style.width = '16%';
                document.getElementById('DivTextHasta').style.width = '20%';
            } else {
                $('divEtiquetaProfesion').show();
                $('txtCargo').show();
                document.getElementById('divEtiquetaHasta').style.width = '10%';
                document.getElementById('DivTextHasta').style.width = '18%';
            }
            if (document.getElementById('comboTipoEstudio').value == '2') {  //autoaprendizaje
                $('divEtiquetaCargo').hide();
                $('DivTextNivel').hide();
                $('divEtiquetaNivel').hide();
                $('DivSelectInstitucion').hide();
                $('divEtiquetainstitucion').hide();
            } else {
                $('divEtiquetaCargo').show();
                $('DivTextNivel').show();
                $('divEtiquetaNivel').show();
                $('DivSelectInstitucion').show();
                $('divEtiquetainstitucion').show();
            }
            document.getElementById('txtInstitucion').value = miarray[3];//
            document.getElementById('comboEspecialidad').value = miarray[0]; //
            //document.getElementById('comboEspecialidad').value=miarray[5]; //
            document.getElementById('comboEstado').value = miarray[6]; //
            document.getElementById('txtNivel').value = miarray[4];
            document.getElementById('txtFunciones').value = miarray[5]; //
            document.getElementById('txtId').value = miarray[7];
            //document.getElementById('txtId').type='text';
            document.getElementById('uno').style.visibility = 'visible';
            document.getElementById('dos').style.visibility = 'visible';
            document.getElementById('tres').style.visibility = 'visible';
            document.getElementById('cuatro').style.visibility = 'visible';
            document.getElementById('cinco').style.visibility = 'visible';
            document.getElementById('DivEliminar').style.visibility = 'visible';
            document.getElementById('DivEditar').style.visibility = 'visible';
            //$('divResultadoExperiencia').update(respuesta);
        }
    })
// mostrarExperienciaLab();
}

function cambiaConocimiento() {
    if (document.getElementById('comboTipoEstudio').value == '3') {
        $('divEtiquetaProfesion').hide();
        $('txtCargo').hide();
        document.getElementById('divEtiquetaHasta').style.width = '16%';
        document.getElementById('DivTextHasta').style.width = '20%';
    } else {
        $('divEtiquetaProfesion').show();
        $('txtCargo').show();
        document.getElementById('divEtiquetaHasta').style.width = '10%';
        document.getElementById('DivTextHasta').style.width = '18%';
    }
    if (document.getElementById('comboTipoEstudio').value == '2') {  //autoaprendizaje
        $('divEtiquetaCargo').hide();
        $('DivTextNivel').hide();
        $('divEtiquetaNivel').hide();
        $('DivSelectInstitucion').hide();
        $('divEtiquetainstitucion').hide();
    } else {
        $('divEtiquetaCargo').show();
        $('DivTextNivel').show();
        $('divEtiquetaNivel').show();
        $('DivSelectInstitucion').show();
        $('divEtiquetainstitucion').show();
    }
}
/**************************** INVESTIGACION **********************************/
function mostrarInvestigacion() {
    patronModulo = 'llenarInvestigacion';
    document.getElementById('divIzqRegistroP').style.height = '550px';
    document.getElementById('divDerRegistroP').style.height = '550px';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);

            respuesta = transport.responseText;
            $('divDerRegistroP').update(respuesta);
            //llenarCombosEstudiosSup();
            document.getElementById('txtAccion').value = 0;
            mostrarTInvestigacion(document.getElementById('txtCodPer').value);
        }
    })

}

function mostrarTInvestigacion($cod)
{
    //document.getElementById('txtCategoria').type='text';
    document.getElementById('txtCategoria').value = '06';
    // document.getElementById("divRegistraP").style.visibility='visible';
    patronModulo = 'mostrarInvestigacion';
    parametros = '';
    codigo = $cod;
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    //
    //    new Ajax.Request(pathRequestControl,{
    //        method : 'get',
    //        parameters : parametros,
    //        onLoading : micargador(1),
    //        onComplete : function(transport){
    //            micargador(0);
    //            myDiv=document.getElementById('divTitulo');
    //            myDiv.innerHTML =document.getElementById('txtNomPer').value;
    //            respuesta = transport.responseText;
    //            $('divDatosInvestigacion').update(respuesta);
    //
    //        }
    //    } )
    vDatosInvestigacion = new dhtmlXGridObject('divDatosInvestigacion');
    vDatosInvestigacion.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    vDatosInvestigacion.setSkin("dhx_skyblue");
    vDatosInvestigacion.enableRowsHover(true, 'grid_hover');

    contadorCargador++;
    var idCargador = contadorCargador;
    //tExpLaboral.attachEvent("onRowSelect",expLaboralDetalle );
    vDatosInvestigacion.attachEvent("onXLS", function () {
        cargadorpeche(0, idCargador);

    });
    vDatosInvestigacion.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    vDatosInvestigacion.attachEvent("onRowSelect", function (x, y) {

        investigacionDetalle(vDatosInvestigacion.cells(x, 4).getValue());



        /////////////////////////
    });
    vDatosInvestigacion.init();
    vDatosInvestigacion.loadXML(pathRequestControl + '?' + parametros);
}

function investigacionDetalle(id)
{
    codigo = id;
    opc = '6';
    patronModulo = 'expLaboralDetalle';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    parametros += '&p3=' + opc;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            var miarray = respuesta.split("|");

            document.getElementById('txtInstitucion').disabled = true;
            document.getElementById('txtCargo').disabled = true;
            document.getElementById('txtDesde').disabled = true;
            document.getElementById('txtHasta').disabled = true;
            document.getElementById('txtInstitucion').value = miarray[1];
            document.getElementById('txtCargo').value = miarray[0];
            document.getElementById('txtDesde').value = miarray[2];
            document.getElementById('txtHasta').value = miarray[4];
            document.getElementById('txtId').value = miarray[5];
            document.getElementById('txtFunciones').value = miarray[3];
            // document.getElementById('txtId').type='text';
            document.getElementById('uno').style.visibility = 'visible';
            document.getElementById('dos').style.visibility = 'visible';
            document.getElementById('tres').style.visibility = 'visible';
            document.getElementById('cuatro').style.visibility = 'visible';
            document.getElementById('cinco').style.visibility = 'visible';
            document.getElementById('DivEliminar').style.visibility = 'visible';
            document.getElementById('DivEditar').style.visibility = 'visible';
            //$('divResultadoExperiencia').update(respuesta);
            // recargarArbolMenuRegistro();
        }
    })
// mostrarExperienciaLab();
}

/*********************************** LOGROS ******************************************/
function mostrarLogros() {
    patronModulo = 'llenarLogros';
    document.getElementById('divIzqRegistroP').style.height = '550px';
    document.getElementById('divDerRegistroP').style.height = '550px';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);

            respuesta = transport.responseText;
            $('divDerRegistroP').update(respuesta);
            document.getElementById('txtAccion').value = 0;
            mostrarTLogros(document.getElementById('txtCodPer').value);

        }
    })

}

function mostrarTLogros($cod)
{
    // document.getElementById("divRegistraP").style.visibility='visible';
    //document.getElementById('txtCategoria').type='text';
    document.getElementById('txtCategoria').value = '07';
    patronModulo = 'mostrarLogros';
    parametros = '';
    codigo = $cod;
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    //
    //    new Ajax.Request(pathRequestControl,{
    //        method : 'get',
    //        parameters : parametros,
    //        onLoading : micargador(1),
    //        onComplete : function(transport){
    //            micargador(0);
    //            myDiv=document.getElementById('divTitulo');
    //            myDiv.innerHTML =document.getElementById('txtNomPer').value;
    //            respuesta = transport.responseText;
    //            $('divDatosLogros').update(respuesta);
    //
    //        }
    //    } )
    vDatosLogros = new dhtmlXGridObject('divDatosLogros');
    vDatosLogros.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    vDatosLogros.setSkin("dhx_skyblue");
    vDatosLogros.enableRowsHover(true, 'grid_hover');

    contadorCargador++;
    var idCargador = contadorCargador;
    //tExpLaboral.attachEvent("onRowSelect",expLaboralDetalle );
    vDatosLogros.attachEvent("onXLS", function () {
        cargadorpeche(0, idCargador);

    });
    vDatosLogros.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    vDatosLogros.attachEvent("onRowSelect", function (x, y) {

        logrosDetalle(vDatosLogros.cells(x, 3).getValue());



        /////////////////////////
    });
    vDatosLogros.init();
    vDatosLogros.loadXML(pathRequestControl + '?' + parametros);
}

function logrosDetalle(id)
{
    codigo = id;
    opc = '7';
    patronModulo = 'expLaboralDetalle';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    parametros += '&p3=' + opc;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            var miarray = respuesta.split("|");
            document.getElementById('txtInstitucion').disabled = true;
            document.getElementById('txtCargo').disabled = true;
            document.getElementById('txtDesde').disabled = true;
            document.getElementById('txtHasta').disabled = true;
            document.getElementById('txtInstitucion').value = miarray[2];
            document.getElementById('txtCargo').value = miarray[0];
            //document.getElementById('txtDesde').value=miarray[2];
            document.getElementById('txtHasta').value = miarray[3];
            document.getElementById('txtId').value = miarray[4];
            document.getElementById('txtFunciones').value = miarray[1];
            //   document.getElementById('txtId').type='text';
            document.getElementById('uno').style.visibility = 'visible';
            document.getElementById('dos').style.visibility = 'visible';
            document.getElementById('tres').style.visibility = 'visible';
            document.getElementById('cuatro').style.visibility = 'visible';
            document.getElementById('cinco').style.visibility = 'visible';
            document.getElementById('DivEliminar').style.visibility = 'visible';
            document.getElementById('DivEditar').style.visibility = 'visible';
            //$('divResultadoExperiencia').update(respuesta);
            // recargarArbolMenuRegistro();
        }
    })
// mostrarExperienciaLab();
}

/************************************* REFERENCIAS ***************************************/
function mostrarReferenciasPers() {
    patronModulo = 'llenarReferencias';
    document.getElementById('divIzqRegistroP').style.height = '550px';
    document.getElementById('divDerRegistroP').style.height = '550px';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);

            respuesta = transport.responseText;
            $('divDerRegistroP').update(respuesta);
            document.getElementById('txtAccion').value = 0;
            mostrarTReferencias(document.getElementById('txtCodPer').value);

        }
    })

}

function mostrarTReferencias($cod)
{
    // document.getElementById("divRegistraP").style.visibility='visible';
    // document.getElementById('txtCategoria').type='text';
    document.getElementById('txtCategoria').value = '08';
    patronModulo = 'mostrarReferencias';
    parametros = '';
    codigo = $cod;
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    //
    //    new Ajax.Request(pathRequestControl,{
    //        method : 'get',
    //        parameters : parametros,
    //        onLoading : micargador(1),
    //        onComplete : function(transport){
    //            micargador(0);
    //            myDiv=document.getElementById('divTitulo');
    //            myDiv.innerHTML =document.getElementById('txtNomPer').value;
    //            respuesta = transport.responseText;
    //            $('divDatosReferencias').update(respuesta);
    //        }
    //    } )
    vDatosReferencias = new dhtmlXGridObject('divDatosReferencias');
    vDatosReferencias.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    vDatosReferencias.setSkin("dhx_skyblue");
    vDatosReferencias.enableRowsHover(true, 'grid_hover');

    contadorCargador++;
    var idCargador = contadorCargador;
    //tExpLaboral.attachEvent("onRowSelect",expLaboralDetalle );
    vDatosReferencias.attachEvent("onXLS", function () {
        cargadorpeche(0, idCargador);

    });
    vDatosReferencias.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    vDatosReferencias.attachEvent("onRowSelect", function (x, y) {

        referenciaDetalle(vDatosReferencias.cells(x, 2).getValue());



        /////////////////////////
    });
    vDatosReferencias.init();
    vDatosReferencias.loadXML(pathRequestControl + '?' + parametros);
}

function referenciaDetalle(id)
{
    codigo = id;
    opc = '8';
    patronModulo = 'expLaboralDetalle';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    parametros += '&p3=' + opc;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            var miarray = respuesta.split("|");

            document.getElementById('txtInstitucion').disabled = true;
            document.getElementById('txtCargo').disabled = true;
            document.getElementById('txtDesde').disabled = true;
            document.getElementById('txtHasta').disabled = true;
            document.getElementById('txtInstitucion').value = miarray[1];
            document.getElementById('txtCargo').value = miarray[0];
            //document.getElementById('txtDesde').value=miarray[2];
            document.getElementById('txtHasta').value = miarray[3];
            document.getElementById('txtId').value = miarray[4];
            document.getElementById('txtFunciones').value = miarray[2];
            // document.getElementById('txtId').type='text';
            document.getElementById('uno').style.visibility = 'visible';
            document.getElementById('dos').style.visibility = 'visible';
            document.getElementById('tres').style.visibility = 'visible';
            document.getElementById('cuatro').style.visibility = 'visible';
            document.getElementById('cinco').style.visibility = 'visible';
            document.getElementById('DivEliminar').style.visibility = 'visible';
            document.getElementById('DivEditar').style.visibility = 'visible';

            //$('divResultadoExperiencia').update(respuesta);
            // recargarArbolMenuRegistro();
        }
    })
// mostrarExperienciaLab();
}

function mostrarLegajo() {
    patronModulo = 'llenarLegajo';
    document.getElementById('divIzqRegistroP').style.height = '550px';
    document.getElementById('divDerRegistroP').style.height = '550px';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('divDerRegistroP').update(respuesta);
            document.getElementById('txtAccion').value = 0;
            mostrarTLegajo(document.getElementById('txtCodPer').value, 1);
        }
    })
}

function mostrarTLegajo($cod, $vista)
{
    // document.getElementById("divRegistraP").style.visibility='visible';
    //document.getElementById('txtCategoria').type='text';
    document.getElementById('txtCategoria').value = '09';
    patronModulo = 'mostrarLegajo';
    parametros = '';
    codigo = $cod;
    vista = $vista;
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    parametros += '&p3=' + vista;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            myDiv = document.getElementById('divTitulo');
            myDiv.innerHTML = document.getElementById('txtNomPer').value;
            respuestas = transport.responseText;
            $('divDatosLegajo').update(respuestas);
        }
    })
}
function mostrarTLegajoModificado($cod, $vista)
{
    // document.getElementById("divRegistraP").style.visibility='visible';
    //document.getElementById('txtCategoria').type='text';
    document.getElementById('txtCategoria').value = '09';
    patronModulo = 'mostrarLegajo';
    parametros = '';
    codigo = $cod;
    vista = $vista;
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    parametros += '&p3=' + vista;

    //    new Ajax.Request(pathRequestControl,{
    //        method : 'get',
    //        parameters : parametros,
    //        onLoading : micargador(1),
    //        onComplete : function(transport){
    //            micargador(0);
    //            myDiv=document.getElementById('divTitulo');
    //            myDiv.innerHTML =document.getElementById('txtNomPer').value;
    //            respuestas = transport.responseText;
    //            $('divDatosLegajo').update(respuestas);
    //        }
    //    } )
    vDatosLegajo = new dhtmlXGridObject('divDatosLegajo');
    vDatosLegajo.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    vDatosLegajo.setSkin("dhx_skyblue");
    vDatosLegajo.enableRowsHover(true, 'grid_hover');

    contadorCargador++;
    var idCargador = contadorCargador;
    //tExpLaboral.attachEvent("onRowSelect",expLaboralDetalle );
    vDatosLegajo.attachEvent("onXLS", function () {
        cargadorpeche(0, idCargador);

    });
    vDatosLegajo.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    vDatosLegajo.attachEvent("onRowSelect", function (x, y) {

        // mostrarCV(vDatosLegajo.cells(x,7).getValue());
        legajoDetalle(idDocumentoEmpleado, iddocumento)
        // legajoDetalle(cadena);


        /////////////////////////
    });
    vDatosLegajo.init();
    vDatosLegajo.loadXML(pathRequestControl + '?' + parametros);
}
function mostrarCVModificado(id) {
    var patronModulo = 'mostrarcv';
    // idDocumentoEmpleado=$('documentoEmpleado').value;
    var idDocumentoEmpleado = id;
    var parametros = '';
    parametros += 'p1=' + patronModulo + '&p2=' + idDocumentoEmpleado;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            $('divAdjuntarDocumento').update(respuesta);
            //            $('divDerRegistroP').update(respuesta);
        }
    })
}
function mostrarCV() {
    var patronModulo = 'mostrarcv';
    var idDocumentoEmpleado = $('documentoEmpleado').value;
    var parametros = '';
    parametros += 'p1=' + patronModulo + '&p2=' + idDocumentoEmpleado;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            $('divAdjuntarDocumento').update(respuesta);
            //            $('divDerRegistroP').update(respuesta);
        }
    })
}
function adjuntarOtroFile() {
    patronModulo = 'adjuntarOtroFile';
    //     dirCompleto=$('txtDirCompleto').value;
    //comentado x jcqa
    //idDocumentoEmpleado=$('documentoEmpleado').value;

    //   idDocumentoEmpleado='2';//pruebita x JCQA
    //     echodoc=document.getElementById('txtnomDocumento').value;
    idDocumentoEmpleado = idDocumentoEmpleado
    //     echodoc=document.getElementById('txtnomDocumento').value;
    parametros = '';
    parametros += 'p1=' + patronModulo + '&p2=' + idDocumentoEmpleado;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            //            document.getElementById('txtAccion').value=0;
            respuesta = transport.responseText;
            //            mostrarTLegajo(document.getElementById('txtCodPer').value,1);
            $('divAdjuntarOtro').update(respuesta);
            //            $('divDerRegistroP').update(respuesta);
        }
    })

}


/*********************** ACCIONES PARA ADICION, EDICION Y ELIMIANCION DE LOS DATOS DEL EMPLEADO *****************************/
function accionAtributos($opc, $columna, $idpuesto, $idDocumento) {
    switch ($opc) {
        case 2:
        {
            $cadena = "¿Desea agregar el atributo?";
            break;
        }
        case 3:
        {
            $cadena = "¿Desea retirar el atriubto?";
            break;
        }
    }
    if (window.confirm($cadena)) {
        accion = $opc;
        codigo = document.getElementById('txtcodigoEmpleado').value;
        //1 Requerido, 2 Legalizable, 3 Legalizado,
        //"2"=>"REQUERIDO","4"=>"LEGALIZABLE","5"=>"LEGALIZADO","8"=>"ENTREGADO"
        switch ($columna) {
            case 2:
            {
                columna = 1;
                break;
            }
            case 4:
            {
                columna = 2;
                break;
            }
            case 5:
            {
                columna = 3;
                break;
            }
            case 8:
            {
                columna = 0;
                break;
            }
        }
        puesto = $idpuesto;
        documento = $idDocumento;
        if (columna != 0) {
            patronModulo = 'accionAtributo';
            parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + accion; //agreagar o eliminar atributos
            parametros += '&p3=' + codigo; //id Empleado
            parametros += '&p4=' + columna;
            parametros += '&p5=' + puesto;
            parametros += '&p6=' + documento;

            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function (transport) {
                    micargador(0);
                    mostrarTLegajo(document.getElementById('txtcodigoEmpleado').value, 2);
                    respuesta = transport.responseText;
                    //document.getElementById('txtNomPer').value=$('divTitulo').innerHTML;
                    //$('divConsultaP').update(respuesta);
                    //recargarArbolMenuRegistro();
                }
            })
        } else {
            //idPuestoEmpleado=$('hIdPuestoEmpleado').value;
            vformname = 'actualizaEntregaDeDocumentos'
            vtitle = 'ACTUALIZA FECHA DE ENTREGA'
            vwidth = '200'
            vheight = '130'
            vcenter = 't'
            vresizable = ''
            vmodal = 'false'
            vstyle = ''
            vopacity = ''

            vposx1 = ''
            vposx2 = ''
            vposy1 = ''
            vposy2 = ''
            patronModulo = 'ventanaActualizaEntregaDeDocumentos';
            parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + accion; //agreagar o eliminar atributos
            parametros += '&p3=' + codigo;
            parametros += '&p4=' + puesto;
            parametros += '&p5=' + documento;

            posFuncion = '';
            CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)

        }
    }

}

function grabarEntregaDocumento($accion, $codigo, $puesto, $documento, $fecha) {
    accion = $accion;
    codigo = $codigo;
    puesto = $puesto;
    documento = $documento;
    fecha = $fecha;
    patronModulo = 'grabarEntregaDocumento';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + accion; //agreagar o eliminar atributos
    parametros += '&p3=' + codigo; //id Empleado
    parametros += '&p4=' + puesto;
    parametros += '&p5=' + documento;
    parametros += '&p6=' + fecha;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            Windows.close("Div_actualizaEntregaDeDocumentos");
            mostrarTLegajo(document.getElementById('txtCodPer').value, 2);

            respuesta = transport.responseText;
        }
    })
}

function enableAccion($opc) {
    if ($opc != 2 && document.getElementById('txtId').value == '') { //editar o eliminar
        window.alert('Debe seleccionar un item de la tabla.');

    } else {
        switch (trim(document.getElementById('txtCategoria').value)) {
            case '02':
            {//experiencia laboral
                if (document.getElementById('txtInstitucion').value == '') {
                    switch ($opc) {
                        case 1:
                        {
                            expLaboralDetalle('', '', document.getElementById('txtId').value);
                            $cadena = "¿Desea editar la experiencia laboral en  " + document.getElementById("txtInstitucion").value + "?";
                            break;
                        }
                        case 2:
                        {
                            $cadena = "Desea agregar una nueva experiencia laboral?";
                            break;
                        }
                        case 3:
                        {
                            expLaboralDetalle('', '', document.getElementById('txtId').value);
                            $cadena = "¿Desea eliminar la experiencia laboral en  " + document.getElementById("txtInstitucion").value + "?";
                            break;
                        }
                    }
                } else {
                    switch ($opc) {
                        case 1:
                        {
                            $cadena = "¿Desea editar la experiencia laboral en  " + document.getElementById("txtInstitucion").value + "?";
                            break;
                        }
                        case 2:
                        {
                            $cadena = "Desea agregar una nueva experiencia laboral?";
                            break;
                        }
                        case 3:
                        {
                            $cadena = "¿Desea eliminar la experiencia laboral en  " + document.getElementById("txtInstitucion").value + "?";
                            break;
                        }
                    }
                }
                break;
            }
            case '03':
            {//estudios superiores
                //if(document.getElementById('txtInstitucion').value==''){
                switch ($opc) {
                    case 1:
                    {
                        estSupDetalle(document.getElementById('txtId').value);
                        $cadena = "¿Desea editar el estudio?";
                        break;
                    }
                    case 2:
                    {
                        $cadena = "Desea agregar un nuevo estudio?";
                        break;
                    }
                    case 3:
                    {
                        estSupDetalle(document.getElementById('txtId').value);
                        $cadena = "¿Desea eliminar el estudio?";
                        break;
                    }
                }

                break;
            }
            case '04':
            {//idiomas
                if (document.getElementById('txtInstitucion').value == '') {

                    switch ($opc) {
                        case 1:
                        {
                            idiomaDetalle('', '', document.getElementById('txtId').value);
                            // window.alert(document.getElementById("txtInstitucion").options[document.getElementById("txtInstitucion").value].text);
                            $cadena = "¿Desea editar el idioma?";
                            break;
                        }
                        case 2:
                        {
                            $cadena = "Desea agregar un nuevo idioma?";
                            break;
                        }
                        case 3:
                        {
                            window.alert(document.getElementById('comboEspecialidad').value);
                            idiomaDetalle('', '', document.getElementById('txtId').value);
                            $cadena = "¿Desea eliminar el idioma?";
                            break;
                        }
                    }
                } else {

                    switch ($opc) {
                        case 1:
                        {
                            $cadena = "¿Desea editar el idioma?";
                            break;
                        }
                        case 2:
                        {
                            $cadena = "Desea agregar un nuevo idioma?";
                            break;
                        }
                        case 3:
                        {
                            $cadena = "¿Desea eliminar el idioma?";
                            break;
                        }
                    }
                }
                break;
            }
            case '05':
            {//conocimientos
                if (document.getElementById('comboEspecialidad').value == '') {
                    switch ($opc) {
                        case 1:
                        {
                            conocimientoDetalle('', '', document.getElementById('txtId').value);
                            $cadena = "¿Desea editar el conocimiento " + document.getElementById('comboEspecialidad').value + "?";
                            break;
                        }
                        case 2:
                        {
                            $cadena = "Desea agregar un nuevo conocimiento?";
                            break;
                        }
                        case 3:
                        {
                            conocimientoDetalle('', '', document.getElementById('txtId').value);
                            $cadena = "¿Desea eliminar el conocimiento " + document.getElementById('comboEspecialidad').value + "?";
                            break;
                        }
                    }
                } else {
                    switch ($opc) {
                        case 1:
                        {
                            $cadena = "¿Desea editar el conocimiento " + document.getElementById('comboEspecialidad').value + "?";
                            break;
                        }
                        case 2:
                        {
                            $cadena = "Desea agregar un nuevo conocimiento?";
                            break;
                        }
                        case 3:
                        {
                            $cadena = "¿Desea eliminar el conocimiento " + document.getElementById('comboEspecialidad').value + "?";
                            break;
                        }
                    }
                }
                break;
            }
            case '06':
            {//Investigación
                if (document.getElementById('txtCargo').value == '') {
                    switch ($opc) {
                        case 1:
                        {
                            investigacionDetalle('', '', document.getElementById('txtId').value);
                            $cadena = "¿Desea editar la investigación de " + document.getElementById('txtCargo').value + "?";
                            break;
                        }
                        case 2:
                        {
                            $cadena = "Desea agregar una nueva investigación?";
                            break;
                        }
                        case 3:
                        {
                            investigacionDetalle('', '', document.getElementById('txtId').value);
                            $cadena = "¿Desea eliminar la investigación " + document.getElementById('txtCargo').value + "?";
                            break;
                        }
                    }
                } else {
                    switch ($opc) {
                        case 1:
                        {
                            $cadena = "¿Desea editar la investigación de " + document.getElementById('txtCargo').value + "?";
                            break;
                        }
                        case 2:
                        {
                            $cadena = "Desea agregar una nueva investigación?";
                            break;
                        }
                        case 3:
                        {
                            $cadena = "¿Desea eliminar la investigación " + document.getElementById('txtCargo').value + "?";
                            break;
                        }
                    }
                }
                break;
            }
            case '07':
            {//Logros
                if (document.getElementById('txtCargo').value == '') {
                    switch ($opc) {
                        case 1:
                        {
                            logrosDetalle('', '', document.getElementById('txtId').value);
                            $cadena = "¿Desea editar el logro " + document.getElementById('txtCargo').value + "?";
                            break;
                        }
                        case 2:
                        {
                            $cadena = "Desea agregar un nuevo logro?";
                            break;
                        }
                        case 3:
                        {
                            logrosDetalle('', '', document.getElementById('txtId').value);
                            $cadena = "¿Desea eliminar el logro " + document.getElementById('txtCargo').value + "?";
                            break;
                        }
                    }
                } else {
                    switch ($opc) {
                        case 1:
                        {
                            $cadena = "¿Desea editar el logro " + document.getElementById('txtCargo').value + "?";
                            break;
                        }
                        case 2:
                        {
                            $cadena = "Desea agregar un nuevo logro?";
                            break;
                        }
                        case 3:
                        {
                            $cadena = "¿Desea eliminar el logro " + document.getElementById('txtCargo').value + "?";
                            break;
                        }
                    }
                }
                break;
            }
            case '08':
            {//Referencias
                if (document.getElementById('txtCargo').value == '') {
                    switch ($opc) {
                        case 1:
                        {
                            referenciaDetalle('', '', document.getElementById('txtId').value);
                            $cadena = "¿Desea editar la referencia de " + document.getElementById('txtCargo').value + "?";
                            break;
                        }
                        case 2:
                        {
                            $cadena = "¿Desea agregar una nueva referencia?";
                            break;
                        }
                        case 3:
                        {
                            referenciaDetalle('', '', document.getElementById('txtId').value);
                            $cadena = "¿Desea eliminar la referencia de " + document.getElementById('txtCargo').value + "?";
                            break;
                        }
                    }
                } else {
                    switch ($opc) {
                        case 1:
                        {
                            $cadena = "¿Desea editar la referencia de " + document.getElementById('txtCargo').value + "?";
                            break;
                        }
                        case 2:
                        {
                            $cadena = "¿Desea agregar una nueva referencia?";
                            break;
                        }
                        case 3:
                        {
                            $cadena = "¿Desea eliminar la referencia de " + document.getElementById('txtCargo').value + "?";
                            break;
                        }
                    }
                }
                break;
            }
        }

        if (window.confirm($cadena)) {

            if (document.getElementById('txtcodigoEmpleado').value == '') { //obtener el codigo del empleado
                getCodEmpleado();
            }
            //Permitir visibilidad de los elementos de formulario
            document.getElementById("uno").style.visibility = 'visible';
            document.getElementById("dos").style.visibility = 'visible';
            document.getElementById("tres").style.visibility = 'visible';
            document.getElementById("cuatro").style.visibility = 'visible';
            document.getElementById("cinco").style.visibility = 'visible';
            document.getElementById("DivEliminar").style.visibility = 'visible';
            document.getElementById("DivEditar").style.visibility = 'visible';
            //Acciones
            switch ($opc) {
                case 1:
                { //edición
                    document.getElementById("DivBtnGrabar").style.visibility = 'visible';
                    document.getElementById("btnCancelar").style.visibility = 'visible';
                    document.getElementById("txtInstitucion").disabled = false;
                    document.getElementById("txtCargo").disabled = false;
                    document.getElementById("txtDesde").disabled = false;
                    document.getElementById("txtHasta").disabled = false;
                    document.getElementById("txtFunciones").disabled = false;

                    if (03 == document.getElementById('txtCategoria').value || 04 == document.getElementById('txtCategoria').value) {

                        document.getElementById('comboTipoEstudio').disabled = false;
                        document.getElementById('comboEspecialidad').disabled = false;
                        document.getElementById('comboEstado').disabled = false;
                        document.getElementById('txtNivel').disabled = false;
                        document.getElementById('comboTipoNivel').disabled = false;
                        //window.alert('buuuuu');
                    }
                    if (05 == document.getElementById('txtCategoria').value) {
                        document.getElementById('comboTipoEstudio').disabled = false;
                        document.getElementById('comboEspecialidad').disabled = false;
                        document.getElementById('txtNivel').disabled = false;
                    }
                    break;
                }
                case 2:
                { //Limpiar los datos para agregar
                    document.getElementById('txtInstitucion').value = '';
                    document.getElementById("txtCargo").value = '';
                    document.getElementById("txtDesde").value = '';
                    document.getElementById("txtHasta").value = '';
                    document.getElementById("txtFunciones").value = '';
                    document.getElementById("DivBtnGrabar").style.visibility = 'visible';
                    document.getElementById("btnCancelar").style.visibility = 'visible';
                    document.getElementById("txtInstitucion").disabled = false;
                    document.getElementById("txtCargo").disabled = false;
                    document.getElementById("txtDesde").disabled = false;
                    document.getElementById("txtHasta").disabled = false;
                    document.getElementById("txtFunciones").disabled = false;
                    if (03 == document.getElementById('txtCategoria').value || 04 == document.getElementById('txtCategoria').value) {
                        document.getElementById('comboTipoEstudio').value = '';
                        document.getElementById('comboEspecialidad').value = '';
                        document.getElementById('comboEstado').value = '';
                        document.getElementById('txtNivel').value = '';
                        document.getElementById('comboTipoNivel').value = '';
                        document.getElementById('comboTipoEstudio').disabled = false;
                        document.getElementById('comboEspecialidad').disabled = false;
                        document.getElementById('comboEstado').disabled = false;
                        document.getElementById('txtNivel').disabled = false;
                        document.getElementById('comboTipoNivel').disabled = false;
                    }
                    if (05 == document.getElementById('txtCategoria').value) {
                        document.getElementById('comboTipoEstudio').value = '';
                        document.getElementById('txtHasta').value = '';
                        document.getElementById('comboEspecialidad').value = '';
                        document.getElementById('txtNivel').value = '';
                        document.getElementById('txtCargo').value = '';
                        document.getElementById('comboTipoEstudio').disabled = false;
                        document.getElementById('txtHasta').disabled = false;
                        document.getElementById('comboEspecialidad').disabled = false;
                        document.getElementById('txtNivel').disabled = false;
                        document.getElementById('txtCargo').disabled = false;
                    }
                    break;
                }
                case 3:
                {
                    //document.getElementById("txtAccion").type='text';
                    document.getElementById("txtAccion").value = 3;
                    accionExpLaboral($opc);
                    break;
                }
            }
            // document.getElementById("txtAccion").type='text';
            document.getElementById("txtAccion").value = $opc;

        } else {
            document.getElementById("DivBtnGrabar").style.visibility = 'hidden';
            document.getElementById("btnCancelar").style.visibility = 'hidden';
        }
    }
}

function validaAccionCategoria() {

    $categoria = document.getElementById("txtCategoria").value;
    $enable = '';
    var txtDesdeFechai = document.getElementById("txtDesde").value;
    var txtHastaFechaf = document.getElementById("txtHasta").value;


    switch ($categoria) {
        case '02':
        { //experiencia
            if (validarFechaMenorMayor(txtDesdeFechai, txtHastaFechaf) == 1) {
                if (document.getElementById("txtInstitucion").value == '' || document.getElementById("txtCargo").value == '' || document.getElementById("txtDesde").value == '' || document.getElementById("txtHasta").value == '') {
                    window.alert('Los datos con * son obligatorios');
                    $enable = '1';
                }
            } else {
                alert("FECHA FINAL ES MENOR QUE LA FECHA INICIAL");
                $enable = '1';
            }
            break;
        }

        case '03':
        { //estudios
            //window.alert(document.getElementById("txtInstitucion").value);
            //if(document.getElementById("txtInstitucion").value=='0000' || document.getElementById("txtCargo").value=='0000' || document.getElementById("txtDesde").value=='' || document.getElementById("txtHasta").value=='' || document.getElementById("comboTipoEstudio").value=='0000' || document.getElementById("comboEspecialidad").value=='0000' || document.getElementById("comboEstado").value=='0000' || document.getElementById("txtNivel").value=='' || document.getElementById("comboTipoNivel").value=='0000' ){
            if (validarFechaMenorMayor(txtDesdeFechai, txtHastaFechaf) == 1) {
                if (document.getElementById("txtCargo").value == '0000' || document.getElementById("comboTipoEstudio").value == '0000' || document.getElementById("comboEspecialidad").value == '0000' || document.getElementById("comboEstado").value == '0000' || document.getElementById("txtNivel").value == '' || document.getElementById("comboTipoNivel").value == '0000') {
                    window.alert('Los datos con * son obligatorios');
                    $enable = '1';
                }
            } else {
                alert("FECHA FINAL ES MENOR QUE LA FECHA INICIAL");
                $enable = '1';
            }
            break;
        }

        case '04':
        { //idiomas
            //window.alert(document.getElementById("txtInstitucion").value);
            if (document.getElementById("comboEspecialidad").value == '0000' || document.getElementById("comboEstado").value == '0000' || document.getElementById("txtNivel").value == '' || document.getElementById("comboTipoEstudio").value == '0000' || document.getElementById("comboTipoNivel").value == '0000') {
                window.alert('Los datos con * son obligatorios');
                $enable = '1';
            }
            break;
        }

        case '05':
        { //conocimientos
            //window.alert(document.getElementById("txtInstitucion").value);
            if (document.getElementById("comboEspecialidad").value == '' || document.getElementById("txtHasta").value == '' || document.getElementById("comboTipoEstudio").value == '0000') {
                window.alert('Los datos con * son obligatorios');
                $enable = '1';
            }
            break;
        }

        case '06':
        { //investigacion
            if (document.getElementById("txtInstitucion").value == '' || document.getElementById("txtCargo").value == '' || document.getElementById("txtDesde").value == '0000' || document.getElementById("txtHasta").value == '') {
                window.alert('Los datos con * son obligatorios');
                $enable = '1';
            }
            break;
        }

        case '07':
        { //logros
            if (document.getElementById("txtInstitucion").value == '' || document.getElementById("txtCargo").value == '' || document.getElementById("txtHasta").value == '') {
                window.alert('Los datos con * son obligatorios');
                $enable = '1';
            }
            break;
        }

        case '08':
        { //referencia
            if (document.getElementById("txtInstitucion").value == '' || document.getElementById("txtCargo").value == '' || document.getElementById("txtHasta").value == '') {
                window.alert('Los datos con * son obligatorios');
                $enable = '1';
            }
            break;
        }
    }

    if ($enable != '1') {
        accionExpLaboral(document.getElementById('txtAccion').value);
    }

}

function accionExpLaboral($opc) {
    // alert("Angel");
    if (document.getElementById("txtAccion").value == 2) {// agregar
        id = '';
    } else {
        id = document.getElementById("txtId").value;
    }
    var desde = '';
    hasta = '';
    institucion = '';
    cargo = '';
    funciones = '';
    tipoestudio = '';
    especialidad = '';
    estado = '';
    nivel = '';
    tiponivel = '';
    var codigo = document.getElementById("txtcodigoEmpleado").value; //codgio del empleado
    accion = document.getElementById("txtAccion").value;
    categoria = document.getElementById("txtCategoria").value;

    institucion = document.getElementById("txtInstitucion").value;
    cargo = document.getElementById("txtCargo").value;
    desde = document.getElementById("txtDesde").value;
    hasta = document.getElementById("txtHasta").value;
    funciones = document.getElementById("txtFunciones").value;

    if (document.getElementById("txtCategoria").value == '03') {
        tipoestudio = document.getElementById('comboTipoEstudio').value;
        especialidad = document.getElementById('comboEspecialidad').value;
        estado = document.getElementById('comboEstado').value;
        nivel = document.getElementById('txtNivel').value;
        tiponivel = document.getElementById('comboTipoNivel').value;
    }

    if (04 == document.getElementById('txtCategoria').value) {
        tipoestudio = document.getElementById('comboTipoEstudio').value;
        especialidad = document.getElementById('comboEspecialidad').value;
        estado = document.getElementById('comboEstado').value;
        nivel = document.getElementById('txtNivel').value;
        tiponivel = document.getElementById('comboTipoNivel').value;
        cargo = '';
        desde = '';
    }

    if (05 == document.getElementById('txtCategoria').value) {
        hasta = document.getElementById('comboTipoEstudio').value;
        desde = document.getElementById('txtHasta').value;
        cargo = document.getElementById('comboEspecialidad').value;
        nivel = document.getElementById('txtNivel').value;
        tiponivel = document.getElementById('txtCargo').value;
        estado = '';
        especialidad = '';
    }

    if (06 == document.getElementById('txtCategoria').value) {
        estado = document.getElementById('txtDesde').value;
        desde = '';
    }

    patronModulo = 'accionExpLaboral';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + categoria;
    parametros += '&p3=' + accion;
    parametros += '&p4=' + codigo;
    parametros += '&p5=' + id;
    parametros += '&p6=' + desde;
    parametros += '&p7=' + hasta;
    parametros += '&p8=' + institucion;
    parametros += '&p9=' + cargo;
    parametros += '&p10=' + funciones;
    parametros += '&p11=' + tipoestudio;
    parametros += '&p12=' + especialidad;
    parametros += '&p13=' + estado;
    parametros += '&p14=' + nivel;
    parametros += '&p15=' + tiponivel;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            disableAccion($opc);
            switch (document.getElementById('txtCategoria').value) {
                case 1:
                { //

                    break;
                }
                case 2:
                { //
                    mostrarTExpLaboral(codigo);
                    break;
                }
                case 3:
                { //
                    mostrarTEstudiosSup(codigo);
                    break;
                }
                case 4:
                { //
                    mostrarTIidiomas(codigo);
                    break;
                }
                case 5:
                { //
                    mostrarTConocimientos(codigo);
                    break;
                }
                case 6:
                { //
                    mostrarTInvestigacion(codigo);
                    break;
                }
                case 7:
                { //
                    mostrarTLogros(codigo);
                    break;
                }
                case 8:
                { //
                    mostrarTReferencias(codigo);
                    break;
                }
            }
            respuesta = transport.responseText;
        }
    })
}

function disableAccion($opc) {
    document.getElementById('DivBtnGrabar').style.visibility = 'hidden';
    document.getElementById('btnCancelar').style.visibility = 'hidden';

    document.getElementById('txtInstitucion').disabled = true;
    document.getElementById('txtCargo').disabled = true;
    document.getElementById('txtDesde').disabled = true;
    document.getElementById('txtHasta').disabled = true;
    document.getElementById('txtFunciones').disabled = true;
    document.getElementById('txtInstitucion').value = '';
    document.getElementById('txtCargo').value = '';
    document.getElementById('txtDesde').value = '';
    document.getElementById('txtHasta').value = '';
    document.getElementById('txtFunciones').value = '';
    if (document.getElementById('txtCategoria').value == '02') { //Experiencia laboral

        mostrarExperienciaLab();
    }

    if ('03' == document.getElementById('txtCategoria').value) {

        document.getElementById('comboTipoEstudio').disabled = true;
        document.getElementById('comboEspecialidad').disabled = true;
        document.getElementById('comboEstado').disabled = true;
        document.getElementById('txtNivel').disabled = true;
        document.getElementById('comboTipoNivel').disabled = true;
        document.getElementById('comboTipoEstudio').value = '';
        document.getElementById('comboEspecialidad').value = '';
        document.getElementById('comboEstado').value = '';
        document.getElementById('txtNivel').value = '';
        document.getElementById('comboTipoNivel').value = '';
        mostrarEstudiosSup();
    }
    if ('04' == document.getElementById('txtCategoria').value) {
        document.getElementById('comboTipoEstudio').disabled = true;
        document.getElementById('comboEspecialidad').disabled = true;
        document.getElementById('comboEstado').disabled = true;
        document.getElementById('txtNivel').disabled = true;
        document.getElementById('comboTipoNivel').disabled = true;
        document.getElementById('comboTipoEstudio').value = '';
        document.getElementById('comboEspecialidad').value = '';
        document.getElementById('comboEstado').value = '';
        document.getElementById('txtNivel').value = '';
        document.getElementById('comboTipoNivel').value = '';
        mostrarIdiomas();
    }
    if ('05' == document.getElementById('txtCategoria').value) { //conocimiento
        mostrarConocimientos();
    }
    if ('06' == document.getElementById('txtCategoria').value) { //investigacion
        mostrarInvestigacion();
    }

    if ('07' == document.getElementById('txtCategoria').value) { //lgoro
        mostrarLogros();
    }
    if ('08' == document.getElementById('txtCategoria').value) { //referencia
        mostrarReferenciasPers();
    }


}

/********************* MANTENIMIENTO PROFESIONES **********************/
function buscarProfesiones(profesion, $elemento, evento) {
    if (evento == '') {
        tecla = 13;
    } else {
        tecla = evento.keyCode
    }
    if (tecla == 13) {
        if (profesion == '') {
            window.alert('Debe escribir un texto para la búsqueda');
        } else {
            patronModulo = "buscarProfesiones";
            parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + profesion;
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function (transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    $('divdetalleProfesion').update(respuesta);
                    $('divdetalleEspecialidad').hide();
                    document.getElementById("btnActual").style.visibility = 'hidden';
                }
            })
        }
    }
}
function profesionDetalle($object, $event, $codigo)
{
    document.getElementById('hProfesion').value = $codigo;
    profesion = $codigo;
    // mostrarDatosPersonales(document.getElementById("txtCodPer").value);
    patronModulo = 'profesionDetalle';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + profesion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            var miarray = respuesta.split("|");
            document.getElementById('txtNombre').value = miarray[1];
            myDiv = document.getElementById('DivEtiquetaTitulo');
            myDiv.innerHTML = '<h1>ESPECIALIDADES DE LA PROFESION ' + miarray[1] + ' - ' + miarray[0] + '</h1>';
            // document.getElementById('txtNomPer').value=$('divTitulo').innerHTML;
            //$('divConsultaP').update(respuesta);
            document.getElementById("btnActual").style.visibility = 'visible';
            mostrarEspecialidadesProfesion(document.getElementById('hProfesion').value);
        }
    })
}

function mostrarEspecialidadesProfesion(profesion) {
    patronModulo = "buscarEspecialidades";
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + profesion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('divdetalleEspecialidad').update(respuesta);
            $('divdetalleEspecialidad').show();
            document.getElementById("btnActual").style.visibility = 'visible';
        }
    })

}

function agregarProfesion() {

    vformname = 'agregarProfesion'

    vtitle = 'AGREGAR PROFESION'
    vwidth = '400'
    vheight = '180'
    vcenter = 't'
    vresizable = ''
    vmodal = 'false'
    vstyle = ''
    vopacity = ''

    vposx1 = ''
    vposx2 = ''
    vposy1 = ''
    vposy2 = ''

    patronModulo = 'ventanaAgregaProfesion';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    posFuncion = '';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)

}

function grabarProfesion($profesion) {
    if ($profesion == '') {
        window.alert('Los datos con * son olbigatorios');
    } else {
        patronModulo = "grabarProfesion";
        profesion = $profesion;
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + profesion;

        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                respuesta = transport.responseText;
                buscarProfesiones($profesion, '', '');
                Windows.close("Div_agregarProfesion");
                $('divdetalleProfesion').update(respuesta);
                //Windows.close("Div_agregaProfesion");
            }
        })
    }
}

function agregarEspecialidad(profesion) {
    if (profesion == '') {
        window.alert('Debe seleccionar una profesion para relacionarla a una especialidad.');
    } else {
        vformname = 'agregarEspecialidad'

        vtitle = 'AGREGAR ESPECIALIDAD'
        vwidth = '400'
        vheight = '180'
        vcenter = 't'
        vresizable = ''
        vmodal = 'false'
        vstyle = ''
        vopacity = ''

        vposx1 = ''
        vposx2 = ''
        vposy1 = ''
        vposy2 = ''
        patronModulo = 'ventanaAgregarEspecialidad';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + profesion;

        posFuncion = '';
        CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
    }
}

function grabarEspecialidad($documento, especialidad) {
    if (especialidad == '' || $documento == '') {
        window.alert('Debe seleccionar una especialidad para la profesion.');
    } else {
        patronModulo = "grabarEspecialidad";
        documento = $documento;
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + especialidad;
        parametros += '&p3=' + documento;

        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                respuesta = transport.responseText;
                mostrarEspecialidadesProfesion($documento)
                $('divdetalleEspecialidad').update(respuesta);
                Windows.close("Div_agregarEspecialidad");
            }
        })
    }
}

function eliminarEspecialidad(especialidad) {
    profesion = document.getElementById('hProfesion').value;
    if (especialidad == '' || profesion == '') {
        window.alert('Debe seleccionar un atributo para eliminarlo.');
    } else {
        if (window.confirm("¿Está seguro que desea eliminar el atributo?")) {
            patronModulo = "eliminarEspecialidad";
            parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + especialidad;
            parametros += '&p3=' + profesion;

            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function (transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    mostrarEspecialidadesProfesion(profesion)
                    $('divdetalleEspecialidad').update(respuesta);
                }
            })
        }
    }
}

function editaEspecialidad(especialidad, $nombre) {
    profesion = document.getElementById('hProfesion').value;
    if (especialidad == '' || $nombre == '') {
        window.alert('Debe seleccionar una especialidad para editarla.');
    } else {
        vformname = 'editarEspecialidad'
        vtitle = 'EDITAR ESPECIALIDAD'
        vwidth = '400'
        vheight = '180'
        vcenter = 't'
        vresizable = ''
        vmodal = 'false'
        vstyle = ''
        vopacity = ''

        vposx1 = ''
        vposx2 = ''
        vposy1 = ''
        vposy2 = ''
        patronModulo = 'ventanaEditarEspecialidad';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + especialidad;
        parametros += '&p3=' + $nombre;
        parametros += '&p4=' + profesion;

        posFuncion = '';
        CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
    }
}

function editarEspecialidad(especialidad, $descipcion, profesion) {
    if (especialidad == '' || $descipcion == '') {
        window.alert('Debe seleccionar una especialidad para la profesion.');
    } else {
        patronModulo = "editarEspecialidad";
        descipcion = $descipcion;
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + especialidad;
        parametros += '&p3=' + descipcion;

        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                respuesta = transport.responseText;
                mostrarEspecialidadesProfesion(profesion);
                $('divdetalleEspecialidad').update(respuesta);
                Windows.close("Div_editarEspecialidad");
            }
        })
    }
}

function editaProfesion($profesion) {
    if ($profesion == '') {
        window.alert('Debe seleccionar una profesion');
    } else {
        if (window.confirm('¿Está seguro que desea editar el nombre de la profesion?')) {
            enableEditar(2);
        }
    }
}

function editarProfesion(descripcion) {
    profesion = document.getElementById('hProfesion').value;
    //document.getElementById('txtNombre').style.visibility='visible';
    patronModulo = "editarProfesion";
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + profesion;
    parametros += '&p3=' + descripcion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            buscarProfesiones('*', '', ''); //para mostrar todos las profesiones
            disableEditar(2);
            profesionDetalle('', '', document.getElementById('hProfesion').value);
            $('divdetalleProfesion').update(respuesta);
            // $('divdetalleAtributo').show();
        }
    })
}

function desactivarProfesion($profesion) {
    if ($profesion == '') {
        window.alert('Debe seleccionar una profesion');
    } else {
        patronModulo = "desactivarProfesion";
        profesion = $profesion; //Nombre
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + profesion;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                respuesta = transport.responseText;
                var miarray = respuesta.split("|");
                if (miarray[0] != '') {
                    window.alert('No se puede desactivar la profesion porque se tienen algunos empleados que la han seguido.');
                } else {
                    if (document.getElementById('txtProfesion').value == '') {
                        buscarProfesiones('*', '', '');
                    } else {
                        buscarProfesiones(document.getElementById('txtProfesion').value, '', '');
                    }
                    $('divdetalleProfesion').update(respuesta);
                }
            }
        })
    }
}

function activarProfesion($profesion) {
    if ($profesion == '') {
        window.alert('Debe seleccionar una profesion');
    } else {
        patronModulo = "activarProfesion";
        profesion = $profesion; //Nombre
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + profesion;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                respuesta = transport.responseText;
                buscarProfesiones('*', '', '');
                $('divdetalleProfesion').update(respuesta);
            }
        })
    }
}


/********************* FIN MANTENIMIENTO PROFESIONES **********************/
/********************* MANTENIMIENTO PUESTO DOCUMENTOS **********************/
function cargarArbolCCostoPtoDoc()
{
    myDiv = document.getElementById('divOpcPtoDocumento');
    myDiv.innerHTML = " ";
    tree1 = new dhtmlXTreeObject("divOpcPtoDocumento", "100%", "100%", 0);
    tree1.setImagePath("../../../../fastmedical_front/imagen/icono/tree/");
    tree1.attachEvent("onClick", function () {
        verPuestosDocumento(tree1.getSelectedItemId(), '', 'detallePuestoCentro');
        return true;
    }
    )
    tree1.loadXML("../../../../carpetaDocumentos/arbol_centroCostos.xml");
    tree1.openAllItems(0);

}

function verPuestosDocumento(id, evento, funcion) {
    if (evento == '') {
        tecla = 13;
    } else {
        tecla = evento.keyCode
    }
    if (tecla == 13) {
        if (id == 'x') {
            ccosto = 1
        } else {
            document.getElementById('hCcosto').value = id;
            ccosto = id;
            document.getElementById('txtPuesto').value = 'Buscar...';
        }
        puesto = document.getElementById('txtPuesto').value;
        if (puesto == 'Buscar...') {
            puesto = '';
        }
        estado = $('comboEstados').value;
        categoria = document.getElementById('comboCategoriaPuestos').value
        patronModulo = "puestosBusquedaDoc";
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + ccosto;
        parametros += '&p3=' + puesto;
        parametros += '&p4=' + categoria;
        parametros += '&p5=' + estado;
        parametros += '&p6=' + funcion;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                respuesta = transport.responseText;
                //respuesta="holaaaaaaa generando codigo";
                $('divPuestos').update(respuesta);
                //$('divdetalleAtributo').hide();
            }
        })


    }
}

function documentoPuesto($object, $event, puesto)
{
    var miarray = puesto.split("|");
    id = miarray[0];
    nombre = miarray[1];
    document.getElementById('hPuesto').value = id;
    document.getElementById('hNombre').value = nombre;
    patronModulo = 'documentoDetalle';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + id;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            myDiv = document.getElementById('divTitulo');
            myDiv.innerHTML = '<h1>' + nombre + ' - ' + id + '</h1>';
            $('divdetalleDocumentos').hide();
            $('divdetallePuestoDocumento').update(respuesta);
        }
    })
}

function eliminarDocumentoPto(documentoPto) {
    if (documentoPto == '') {
        window.alert('Debe seleccionar un documento para eliminarlo.');
    } else {
        if (window.confirm("¿Está seguro que desea eliminar el documento?")) {
            patronModulo = "eliminarDocumentoPto";
            parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + documentoPto;

            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function (transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    documentoPuesto('', '', document.getElementById('hPuesto').value + '|' + document.getElementById('hNombre').value + '|');
                    $('divdetalleDocumentos').hide();
                    $('divdetallePuestoDocumento').update(respuesta);
                }
            })
        }
    }
}


function agregarDocumentoPuesto()
{
    if (document.getElementById('hPuesto').value == '') {
        window.alert('Debe seleccionar un puesto.')
    } else {
        puesto = document.getElementById('hPuesto').value;
        patronModulo = 'agregarDocumentoPuesto';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + puesto;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                respuesta = transport.responseText;
                $('divdetalleDocumentos').show();
                $('divdetalleDocumentos').update(respuesta);

            }
        })
    }
}

function grabarDocumentoPto(documento) {
    puesto = document.getElementById('hPuesto').value;
    if (puesto == '' || documento == '') {
        window.alert('Debe seleccionar un Documento y puesto.');
    } else {
        patronModulo = "grabarDocumentoPto";
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + puesto;
        parametros += '&p3=' + documento;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                respuesta = transport.responseText;
                $('divdetalleDocumentos').show();
                documentoPuesto('', '', document.getElementById('hPuesto').value + '|' + document.getElementById('hNombre').value + '|');
                agregarDocumentoPuesto();
                $('divdetallePuestoDocumento').update(respuesta);
            }
        })
    }
}

/********************* FIN MANTENIMIENTO PUESTO DOCUMENTOS **********************/

/********************* MANTENIMIENTO DOCUMENTOS **********************/
function buscarDocumentos($Documento, $elemento, evento) {
    funcion = $('funcionDocumento').value;
    if (evento == '') {
        tecla = 13;
    } else {
        tecla = evento.keyCode
    }
    if (tecla == 13) {
        if ($Documento == '') {
            window.alert('Debe escribir un texto para la búsqueda');
        } else {
            patronModulo = "buscarDocumentos";
            documento = $Documento;
            parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + documento;
            parametros += '&p3=' + funcion;
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function (transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    //respuesta="holaaaaaaa generando codigo";
                    $('divdetalleDocumento').update(respuesta);
                    //mostrarAtributosDocumento('');
                    $('divdetalleAtributo').hide();
                    document.getElementById("btnActual").style.visibility = 'hidden';

                }
            })

        }
    }
}
function documentoDetalle($object, $event, $codigo)
{
    document.getElementById('hDocumento').value = $codigo;
    documento = $codigo;
    // mostrarDatosPersonales(document.getElementById("txtCodPer").value);
    patronModulo = 'documentosDetalle';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + documento;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            var miarray = respuesta.split("|");
            document.getElementById('txtCDocumento').value = miarray[0];
            document.getElementById('txtNombre').value = miarray[1];
            document.getElementById('txtEstado').value = miarray[2];
            document.getElementById("btnActual").style.visibility = 'visible';
            // document.getElementById('txtNomPer').value=$('divTitulo').innerHTML;
            //$('divConsultaP').update(respuesta);
            mostrarAtributosDocumento(document.getElementById('hDocumento').value);
        }
    })
}

function mostrarAtributosDocumento($Documento) {
    patronModulo = "buscarAtributos";
    documento = $Documento;
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + documento;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            //respuesta="holaaaaaaa generando codigo";
            $('divdetalleAtributo').update(respuesta);
            $('divdetalleAtributo').show();
            document.getElementById("btnActual").style.visibility = 'visible';

        }
    })

}

function agregarDocumento() {

    vformname = 'agregaDocumento'

    vtitle = 'AGREGAR DOCUMENTO'
    vwidth = '400'
    vheight = '180'
    vcenter = 't'
    vresizable = ''
    vmodal = 'false'
    vstyle = ''
    vopacity = ''

    vposx1 = ''
    vposx2 = ''
    vposy1 = ''
    vposy2 = ''

    patronModulo = 'ventanaAgregaDocumento';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    posFuncion = '';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)

}

function grabarDocumento($Documento, $descripcion) {
    if ($Documento == '') {
        window.alert('Los datos con * son olbigatorios');
    } else {
        patronModulo = "grabarDocumento";
        documento = $Documento; //Nombre
        descripcion = $descripcion; //
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + documento;
        parametros += '&p3=' + descripcion;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                respuesta = transport.responseText;
                buscarDocumentos($Documento, '', '');
                $('divdetalleDocumento').update(respuesta);
                //echo("pq no cierra el pop");
                Windows.close("Div_agregaDocumento");
                // $('divdetalleAtributo').show();
            }
        })
    }
}

function agregarAtributo($documento) {
    if ($documento == '') {
        window.alert('Debe seleccionar un documento para agregarle atributos.');
    } else {
        vformname = 'agregarAtributo'

        vtitle = 'AGREGAR ATRIBUTO'
        vwidth = '520'
        vheight = '250'
        vcenter = 't'
        vresizable = ''
        vmodal = 'false'
        vstyle = ''
        vopacity = ''

        vposx1 = ''
        vposx2 = ''
        vposy1 = ''
        vposy2 = ''
        documento = $documento;
        patronModulo = 'ventanaAgregarAtributo';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + documento;

        posFuncion = '';
        CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
    }
}

function buscarAtributo($documento, $atributo, elemento, evento) {
    if (evento == '') {
        tecla = 13;
    } else {
        tecla = evento.keyCode
    }
    if (tecla == 13) {
        if ($atributo == '') {
            window.alert('Debe escribir un texto para la búsqueda');
        } else {
            patronModulo = "buscarAtributo";
            atributo = $atributo;
            documento = $documento;
            parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + documento;
            parametros += '&p3=' + atributo;
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function (transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    //respuesta="holaaaaaaa generando codigo";
                    $('divAtributo').update(respuesta);
                    //mostrarAtributosDocumento('');

                }
            })
        }
    }
}

function idAtributo($object, $event, $codigo) {
    document.getElementById('hAtributo').value = $codigo;

}

function grabarAtributo($documento, $atributo) {
    if ($atributo == '' || $documento == '') {
        window.alert('Debe seleccionar un atributo para asignarlo.');
    } else {
        patronModulo = "grabarAtributo";
        atributo = $atributo; //id
        documento = $documento;
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + atributo;
        parametros += '&p3=' + documento;

        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                respuesta = transport.responseText;
                mostrarAtributosDocumento($documento)
                $('divdetalleAtributo').update(respuesta);
                Windows.close("Div_agregarAtributo");
            }
        })
    }
}

function eliminarAtributo(atributo) {
    documento = document.getElementById('hDocumento').value;
    if (atributo == '' || documento == '') {
        window.alert('Debe seleccionar un atributo para eliminarlo.');
    } else {
        if (window.confirm("¿Está seguro que desea eliminar el atributo?")) {
            patronModulo = "eliminarAtributo";
            parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + atributo;
            parametros += '&p3=' + documento;

            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function (transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    mostrarAtributosDocumento(documento)
                    $('divdetalleAtributo').update(respuesta);
                }
            })
        }
    }
}

function ordenarAtributo(atributo, direccion, orden) {
    documento = document.getElementById('hDocumento').value;
    if (atributo == '' || documento == '') {
        window.alert('Debe seleccionar un atributo para ordenarlo.');

    } else {

        patronModulo = "ordenarAtributo";
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + documento;
        parametros += '&p3=' + direccion;
        parametros += '&p4=' + orden;
        parametros += '&p5=' + atributo;

        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                respuesta = transport.responseText;
                mostrarAtributosDocumento(documento)
                $('divdetalleAtributo').update(respuesta);
            }
        })

    }
}

function editaDocumento($Documento) {
    if ($Documento == '') {
        window.alert('Debe seleccionar un documento');
    } else {
        if (window.confirm('¿Está seguro que desea editar el nombre del documento?')) {
            enableEditar(1);
        }
    }
}

function enableEditar($opc) {
    document.getElementById("btnActualizar").style.visibility = 'visible';
    document.getElementById("btnCancelar").style.visibility = 'visible';
    document.getElementById("btnActual").style.visibility = 'hidden';
    document.getElementById("btnAgregar").style.visibility = 'hidden';
    document.getElementById('btnActual').disabled = true;
    document.getElementById('btnAgregar').disabled = true;
    if ($opc == '1') {
        document.getElementById('txtNombre').disabled = false;
        $('divBotonesDocumento1').style.visibility = 'hidden';
    } else {
        $('divBotonesProfesion1').style.visibility = 'hidden';
        document.getElementById('divBotonesProfesion1').style.width = '30%';
        document.getElementById('divBotonesProfesion2').style.width = '65%';
        document.getElementById('txtNombre').type = 'text';
        document.getElementById('txtNombre').style.visibility = 'visible';
        document.getElementById('DivEtiqueta').style.visibility = 'visible';
    }

}

function editarDocumento(descripcion) {
    documento = document.getElementById('hDocumento').value;
    document.getElementById('txtNombre').style.visibility = 'visible';
    patronModulo = "editarDocumento";
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + documento;
    parametros += '&p3=' + descripcion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            buscarDocumentos('*', '', ''); //para mostrar todos los documentos
            disableEditar(1);
            documentoDetalle('', '', document.getElementById('hDocumento').value);
            // mostrarAtributosDocumento(document.getElementById('hDocumento').value);
            $('divdetalleDocumento').update(respuesta);
            // $('divdetalleAtributo').show();
        }
    })
}

function disableEditar($opc) {
    document.getElementById("btnActualizar").style.visibility = 'hidden';
    document.getElementById("btnCancelar").style.visibility = 'hidden';
    document.getElementById("btnActual").style.visibility = 'visible';
    document.getElementById("btnAgregar").style.visibility = 'visible';
    document.getElementById('btnActual').disabled = false;
    document.getElementById('btnAgregar').disabled = false;
    if ($opc == '1') {
        document.getElementById('txtNombre').disabled = true;
    } else {
        document.getElementById('txtNombre').type = 'hidden';
        document.getElementById('DivEtiqueta').style.visibility = 'hidden';
        document.getElementById('divBotonesProfesion1').style.width = '60%';
        document.getElementById('divBotonesProfesion2').style.width = '36%';
    }
}

function eliminarDocumento($Documento) {
    if ($Documento == '') {
        window.alert('Debe seleccionar un documento');
    } else {
        patronModulo = "eliminarDocumento";
        documento = $Documento; //Nombre
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + documento;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                respuesta = transport.responseText;
                var miarray = respuesta.split("|");
                if (miarray[0] != '') {
                    window.alert('No se puede desactivar el documento porque se ha registrado como requisito para algunos empleados.');
                } else {
                    if (document.getElementById('txtDocumento').value == '') {
                        buscarDocumentos('*', '', '');
                    } else {
                        buscarDocumentos(document.getElementById('txtDocumento').value, '', '');
                    }
                    $('divdetalleDocumento').update(respuesta);
                }
                // $('divdetalleAtributo').show();
            }
        })
    }
}

function activarDocumento($Documento) {
    if ($Documento == '') {
        window.alert('Debe seleccionar un documento');
    } else {
        patronModulo = "activarDocumento";
        documento = $Documento; //Nombre
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + documento;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                respuesta = transport.responseText;
                buscarDocumentos('*', '', '');
                $('divdetalleDocumento').update(respuesta);
                // $('divdetalleAtributo').show();
            }
        })
    }
}

/********************* FIN MANTENIMIENTO DOCUMENTOS **********************/
//function selectTipoHorario(){
//    idSEA=$("hidIdSedeEmpresaArea").value;
//    idTipoHorario=$("cboTipoHorario").value;
//    if(idSEA==""){
//        alert("Por favor seleccione primero un Área");
//        return;
//    }
//    if(idTipoHorario=="1"){
//        var form="", funcion="",destino="divTurnoHorario";
//        var parametros="p1=mostrarTipoHorario&p2="+idSEA;
//        enviarFormulario(form,parametros,funcion,destino);
//    }else{
//        $("divTurnoHorario").update("");
//    }
//}
function asignarHorarioFijo() {
    var idEmpleado = $("hidIdEmpleado").value;
    if (idEmpleado == "") {
        alert("Por favor seleccione un empleado ...");
        return;
    }
    var datosx = $("cboArea").value;
    datosx = datosx.split("|");
    var iIdSedeEmpresaArea = datosx[0];
    var nomEmpleado = $("txtNomEmpleado").value;
    posFuncion = "";
    vtitle = "Asignar Horario Fijo";
    vformname = 'asignarHorarioFijo';
    vwidth = '300';
    vheight = '170';
    patronModulo = 'asignarHorarioFijo';
    vcenter = 't';
    vresizable = ''
    vmodal = 'false';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    parametros = '';
    parametros += 'p1=' + patronModulo + "&p2=" + iIdSedeEmpresaArea + "&p3=" + nomEmpleado;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

}
function grabarHorarioFijo() {
    var miFecha = new Date()
    var idEmpleado = $("hidIdEmpleado").value;
    var datosx = $("cboArea").value;
    datosx = datosx.split("|");
    var idProgramacionPersonal = $("hidIdProgramacionPersonal").value;
    var iIdSedeEmpresaAreaCentroCosto = datosx[1];
    var fechaInicio = $("txtFechaIni").value;
    var fechaFin = $("txtFechaFin").value;
    var datosy = $("cboTurnoHoras").value;
    var idSubArea = $("cboSubArea").value;
    datosy = datosy.split("|");
    var iIdTurnoSedeEmpresaArea = datosy[0];
    var horasTurno = datosy[1];
    //***********************************      Validar       ****************************************
    if (fechaInicio == "" || fechaFin == "") {
        alert("Por favor Ingrese fechas ...");
        return;
    }
    if (iIdTurnoSedeEmpresaArea == "") {
        alert("Por favor seleccione un turno ...");
        return;
    }
    /*+---------------------------------------------------------+
     +---capturar los meses y el año del la caja de texto -----+*/
    mes = $("cboMes").value;
    nomMes = $("cboMes").options[$("cboMes").selectedIndex].text;
    anio = $("cboAnio").value;

    var array1 = fechaInicio.split("/");
    var array2 = fechaFin.split("/");
    mes1 = array1[1];
    anio1 = array1[2];
    mes2 = array2[1];
    anio2 = array2[2];

    mes = "0" + mes;
    if (mes != mes1 || anio != anio1) {
        alert("Por favor ingresar correctamente la Fecha Inicio. Le sugerimos ingresar el mes => " + nomMes + " y el año => " + anio);
        return;
    }
    if (mes != mes2 || anio != anio2) {
        alert("Por favor ingresar correctamente la Fecha Fin. Le sugerimos ingresar el mes => " + nomMes + " y el año => " + anio);
        return;
    }
    if (parseInt(array1[0]) > parseInt(array2[0])) {
        alert("La < Fecha Fin > debe ser mayor respecto a la < Fecha Inicio >.");
        return;
    }
    //***********************************************************************************************
    form = "";
    funcion = "cargarTablaProgramacionHorarios(1)";
    destino = "";
    parametros = "p1=grabarHorarioFijo";
    parametros += "&p2=" + idProgramacionPersonal + "&p3=" + idEmpleado + "&p4=" + iIdSedeEmpresaAreaCentroCosto;
    parametros += "&p5=" + iIdTurnoSedeEmpresaArea + "&p6=" + horasTurno + "&p7=" + fechaInicio + "&p8=" + fechaFin + "&p9=" + idSubArea;
    enviarFormularioSincronizado(form, parametros, funcion, destino);
    Windows.close("Div_asignarHorarioFijo", "");
}

function ventanaBusquedaPuesto() {
    //var titulo='Busqueda...';
    var funcionBuscador = 'seleccionarPuesto';
    // var vFormaAbrir='VENTANA';
    var vformname = 'busquedaPersonas';
    var vtitle = 'Busqueda de Puestos Laborales';
    var vwidth = '900';
    var vheight = '440';
    var vcenter = 't';
    var vresizable = '';
    var vmodal = 'false';
    var vstyle = '';
    var vopacity = '';
    // var veffect='';
    var vposx1 = '';
    var vposx2 = '';
    var vposy1 = '';
    var vposy2 = '';
    var file01 = '';
    //var vfunctionjava='';
    var patronModulo = 'agregarPuestoEmpleado';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + funcionBuscador;
    var posFuncion = 'cargarArbolPop';

    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function seleccionarPuesto(fila, columna) {
    var nombrePuesto = tablaPuestosCentroCostos.cells(fila, 1).getValue();
    var nombreCentroCosto = tablaPuestosCentroCostos.cells(fila, 4).getValue();
    var codigoPuesto = tablaPuestosCentroCostos.cells(fila, 0).getValue();
    // alert(nombrePuesto);
    $('txtidPuesto').value = codigoPuesto;
    $('txtNombrePuesto').value = nombrePuesto;
    $('txtCentroCosto').value = nombreCentroCosto;
    Windows.close("Div_busquedaPersonas");
}
function agregarPuestoEmpleado() {
    idModalidadContrato = $("cboModContrato").value;
    //modalidadContrato=$("cboModContrato").options[$("cboModContrato").selectedIndex].text;
    //Modificado por Luis 15/09/2011
    modalidadContrato = $("cboModContrato").value;
    idSucursal = $("cboSucursal").value;
    idSedeEmpresaArea = $("hidIdSedeEmpresaArea").value;
    if (idModalidadContrato == "") {
        alert("Por favor registre primero la Modalidad de contrato.");
        return;
    }
    if (idSucursal == "") {
        alert("Por favor seleccione una Sede ...");
        return;
    }
    if (idSedeEmpresaArea == "") {
        alert("Por favor seleccione un Área ...");
        return;
    }
    //    if($("cboTipoSueldo").value==""){
    //        alert("Seleccione el tipo de sueldo ...");
    //        return;
    //    }
    //if(modalidadContrato=="Locatario" || modalidadContrato=="LOCATARIO" || modalidadContrato=="locatario"){
    //Modificado por Luis 15/09/2011
    if (modalidadContrato == 11 || modalidadContrato == 15) {
        titulo = 'Busqueda...';
        vFormaAbrir = 'VENTANA';
        vformname = 'busqueda_de_puestos';
        vtitle = 'Busqueda de Puestos Laborales';
        vwidth = '500';
        vheight = '400';
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
        file01 = '';
        vfunctionjava = '';
        patronModulo = 'abrirPuestoArea';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + idSedeEmpresaArea;
        posFuncion = '';

        CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
    } else {
        //        detallePuestoEmpleado('','','');
        titulo = 'Busqueda...';
        vFormaAbrir = 'VENTANA';
        vformname = 'busquedaPersonas';
        vtitle = 'Busqueda de Puestos Laborales';
        vwidth = '800';
        vheight = '440';
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
        file01 = '';
        vfunctionjava = '';
        patronModulo = 'agregarPuestoEmpleado';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + idSedeEmpresaArea;
        posFuncion = 'cargarArbolPop';

        CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
    }
}
function tblPuestosxCategoria(idSedeEmpresaArea) {
    idCategoriaPuesto = $("cboCategoriaPuesto").value;
    cboSucursal = $("cboSucursal").value;
    idArea = $("hidIdArea").value
    parametros = "p1=listPuestosxCategoria&p2=" + idCategoriaPuesto + "&p3=" + idSedeEmpresaArea + "&p4=" + cboSucursal + "&p5=" + idArea;
    div = "div_puestos_categoria";
    funcionClick = "";
    funcionDblClick = "asignarPuestoEmpleadoLocatario";
    funcionLoad = "";
    generarTablay(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}

//
//function CargarVentanaPopPap(vformname,vtitle,vwidth,vheight,vcenter,vresizable,vmodal,vstyle,vopacity,vposx1,vposx2,vposy1,vposy2,parametros,posFuncion)
//{
//    myRand = parseInt(Math.random()*999999999999999);
//    if(vwidth==undefined || vwidth==0) vwidth=700;
//    if(vheight==undefined || vheight==0) vheight=400;
//    if(vposx1==undefined || vposx1==0) vposx1=25;
//    if(vposy1==undefined || vposy1==0) vposy1=110;
//    if(vposx2==undefined || vposx2==0) vposx2=25;
//    if(vposy2==undefined || vposy2==0) vposy2=110;
//
//    if(vresizable==undefined || vresizable==0) vresizable=true;else vresizable=false;
//    if(vstyle==undefined || vstyle==0) vstyle="alphacube";   // fondo y estilo
//    //if(veffect==veffect || veffect==0) veffect="popup_effect";
//    if(vmodal==undefined || vmodal==0) vmodal=false;else vmodal=true;
//    if(vopacity==undefined || vopacity==0) vopacity=1;
//    if(vcenter==undefined || vcenter==0 || vcenter == 't') vcenter=true; else vcenter=false;
//    if(vtitle==undefined) vtitle=vformname;
//    if(!ExisteObjeto("Div_"+vformname))
//    {
//        var vidfrm;
//        // file02=decodeURIComponent(file02);
//        var vid="Div_"+vformname;
//        vidfrm="Frm_"+vformname;
//        var vzindex = 100;
//        var win;
//        if(vmodal==true || vmodal==1)
//            win = new Window({
//                id: vid,
//                className: vstyle,
//                title:vtitle,
//                width:vwidth,
//                height:vheight,
//                zIndex:vzindex,
//                opacity:vopacity,
//                resizable: vresizable
//            });
//        else
//            win = new Window({
//                id: vid,
//                className: vstyle,
//                title:vtitle,
//                width:vwidth,
//                height:vheight,
//                resizable: vresizable
//            });
//        win.getContent().innerHTML = "<div id='"+vidfrm+"'></div>";
//        //win.getContent().innerHTML = "<h1>No Constraint</h1>Wired mode<br><a href='#' onclick='Windows.getWindow(\"win3\").maximize()'>Maximize me</a>";
//        win.setDestroyOnClose();
//        if(vcenter==true || vcenter==1)
//            win.showCenter(vmodal);
//        else
//            win.show(vmodal);
//        win.setConstraint(true, {
//            left:vposx1,
//            right:vposx2,
//            top: vposy1,
//            bottom:'auto'
//        })
//        win.toFront();
//	  
//        new Ajax.Request(pathRequestControl,{
//            method : 'get',
//            parameters : parametros,
//            onLoading : micargador(1),
//            onComplete : function(transport){
//                micargador(0);
//
//                respuesta = transport.responseText;
//                $(vidfrm).update(respuesta);
//                posFuncion+="('')";
//                eval(posFuncion);
//            }
//        } )
//    }
//}
function cargarArbolPop() {
    //window.alert('holas');
    var funcion = 'funcionVerPuestos';
    recargarArbolCCostosPuestos(funcion);
}
function funcionVerPuestos(id) {

    verPuestos(id, '');
//seleccionarCentroCostoPuesto(id);
}
function asignarPuestoEmpleadoLocatario(fil, col) {
    idPuesto = mygridy.cells(fil, 0).getValue();
    codigoEmpleado = $('txtCopEmp').value;
    patronModulo = 'asignarPuestoEmpleado';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + idPuesto;
    parametros += '&p3=' + codigoEmpleado;
    /*===========     Modificado 10/05/2011      ===========*/
    idModContrato = $("cboModContrato").value;
    idSucursal = $("cboSucursal").value;
    idTipoSueldo = $("cboTipoSueldo").value;
    sueldo = $("txtSueldo").value;
    idSedeEmpresaArea = $("hidIdSedeEmpresaArea").value;
    fechaInicio = $("txtFechaIni").value;
    fechaFin = $("txtFechaFin").value;

    parametros += "&p4=" + idModContrato + "&p5=" + idSucursal + "&p6=" + sueldo;
    parametros += "&p7=" + idSedeEmpresaArea + "&p8=locatario&p9=" + idTipoSueldo + "&p10=" + fechaInicio + "&p11=" + fechaFin;
    /*==================    Fin Modificación   =============*/
    //    alert(idPuesto);
    if (idPuesto == 0) {
        alert('Seleccione puesto');
    } else {
        if (window.confirm("\xBFSeguro que desa Asignar este Puesto al Empleado?")) {

            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function (transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    if (respuesta == 'no') {
                        window.alert('no se puede agregar un puesto inactivo');
                    } else if (respuesta == "NO_SEA_CC") {
                        window.alert('El puesto que se quiere asignar al área no esta permitido. Usted primero tiene que asignar un centro de costo a un área');
                    } else {
                        // alert("codigo"+respuesta);
                        detallePuestoEmpleado('', '', respuesta);
                        //window.alert('El puesto se le asignará pero con estado INACTIVO, cambie el estado del puesto para el empleado ')
                        puestosPorEmpleados();
                        Windows.close("Div_busquedaPersonas", '');
                        //ventanaCambiarEstadoPuestoEmpleado();
                        //                        if(confirm('\xBFDesea generar usuario en el sistema?')){
                        //                            registrarEmpleadoComoUsuario(codigoEmpleado,idPuesto);
                        //                        }
                    }
                }


            }
            )
        }
    }
}

function asignarPuestoEmpleado(evento, elelmento, idPuesto) {
    codigoEmpleado = $('txtCopEmp').value;
    patronModulo = 'asignarPuestoEmpleado';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + idPuesto;
    parametros += '&p3=' + codigoEmpleado;
    /*===========      Modificado 10/05/2011     ===========*/
    idModContrato = $("cboModContrato").value;
    idSucursal = $("cboSucursal").value;
    idTipoSueldo = $("cboTipoSueldo").value;
    sueldo = $("txtSueldo").value;
    fechInicio = $("txtFechaIni").value;
    fechFin = $("txtFechaFin").value;
    idSedeEmpresaArea = $("hidIdSedeEmpresaArea").value;
    parametros += "&p4=" + idModContrato + "&p5=" + idSucursal + "&p6=" + sueldo + "&p7=" + idSedeEmpresaArea + "&p8=otros&p9=" + idTipoSueldo + "&p10=" + fechInicio + "&p11=" + fechFin;

    /*==================    Fin Modificación   =============*/
    if (idPuesto == 0) {
        alert('Seleccione puesto');
    } else {
        if (window.confirm("\xBFSeguro que desa Asignar este Puesto al Empleado?")) {
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function (transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    if (respuesta == 'no') {
                        window.alert('no se puede agregar un puesto inactivo');
                    } else if (respuesta == "NO_SEA_CC") {
                        window.alert('El puesto que se quiere asignar al área no esta permitido. Usted primero tiene que asignar un centro de costo a un área');
                    } else {
                        //alert("codigo"+respuesta);
                        detallePuestoEmpleado('', '', respuesta);
                        //window.alert('El puesto se le asignará pero con estado INACTIVO, cambie el estado del puesto para el empleado ')
                        puestosPorEmpleados();
                        Windows.close("Div_busquedaPersonas", '');
                        //ventanaCambiarEstadoPuestoEmpleado();
                        //                        if(confirm('\xBFDesea generar usuario en el sistema?')){
                        //                            registrarEmpleadoComoUsuario(codigoEmpleado,idPuesto);
                        //                        }
                    }
                }
            }
            )
        }
    }
}

function registrarEmpleadoComoUsuario(codigoEmpleado, idPuesto) {
    patronModulo = "registrarEmpleadoComoUsuario";
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoEmpleado;
    parametros += '&p3=' + idPuesto;
    new Ajax.Request(pathRequestControl,
            {
                method: 'post',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function (transport) {
                    micargador(0);
                    alert(transport.responseText);
                }
            }
    )
}

function cambiarEstadoPuestoEmpleado() {
    dInicio = $("textInicio").value;
    dFin = $("textFin").value;
    bEstado = $("chkEstado").value;
    if (bEstado == '1') {
        vEstado = 'No Activo';
    } else {

        vEstado = 'Activo';
    }
    iIdPuestoEmpleado = $("hIdPuestoEmpleado").value;
    periodoPuestoEmpleado = $("hPeriodoPuestoEmpleado").value;
    idSedeEmpresaArea = $("hIdSedeEmpresaArea").value;
    validado = 1;
    if (dFin == '') {
        validado = 0;
    }
    if (dInicio == '') {
        validado = 0;
    }
    if (validado == 0) {
        window.alert('Es necesario Ingresar las fechas de inicio y fin');
    } else {
        if (window.confirm("Esta seguro que desea el Puesto con el Estado: " + vEstado)) {
            patronModulo = 'cambiarEstadoPuestoEmpleado';
            parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + dInicio;
            parametros += '&p3=' + dFin;
            parametros += '&p4=' + bEstado;
            parametros += '&p5=' + iIdPuestoEmpleado;
            parametros += '&p6=' + periodoPuestoEmpleado;
            //parametros+='&p7='+idSedeEmpresaArea;


            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function (transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    //window.alert(respuesta);
                    //detallePeriodosPuestoEmpleados(iIdPuestoEmpleado);
                    puestosPorEmpleados();
                    detallePuestoEmpleado('', '', iIdPuestoEmpleado)
                }
            })
        } else {
            puestosPorEmpleados();
        }
        Windows.close("Div_cambiarEstadoPuestoEmpleado");
    }

}

function puestosPorEmpleados() {
    patronModulo = 'mostrarTablaPuestosEmpleados';
    icodigoEmpleado = $('txtCopEmp').value;
    parametro = '';
    parametro += 'p1=' + patronModulo;
    parametro += '&p2=' + icodigoEmpleado;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametro,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuestas = transport.responseText;
            $('divDatosPuesto').update(respuestas);
        }
    })
}
//modificado x 63
//function puestosPorEmpleados(){
//    patronModulo='mostrarTablaPuestosEmpleados';
//    icodigoEmpleado=$('txtCopEmp').value;
//    accion="";
//    modalidadContrato=$("cboModContrato").options[$("cboModContrato").selectedIndex].text;
//    if(modalidadContrato=="Locatario" || modalidadContrato=="LOCATARIO" || modalidadContrato=="locatario")
//        accion="NCC";
//
//    parametros='';
//    parametros+='p1='+patronModulo;
//    parametros+='&p2='+icodigoEmpleado;
//    parametros+='&p3='+accion;
//    div="divDatosPuesto";
//    funcionClick="detallePuestoEmpleado";
//    funcionDblClick="";
//    funcionLoad="";
//    generarTablaz(div,parametros,funcionClick,funcionDblClick,funcionLoad);
//}

function editarFechaPeriodos() {
    dInicio = $("textInicio").value;
    dFin = $("textFin").value;
    bEstado = $("chkEstado").value;
    iIdPuestoEmpleado = $("hIdPuestoEmpleado").value;
    periodoPuestoEmpleado = $("hPeriodoPuestoEmpleado").value;
    validado = 1;
    if (dFin == '') {
        validado = 0;
    }
    if (dInicio == '') {
        validado = 0;
    }
    if (validado == 0) {
        window.alert('Es necesario Ingresar las fechas de inicio y fin');
    } else {
        if (window.confirm("Esta seguro que desea cambair de Estado")) {
            patronModulo = 'editarPeriodoPuesto';
            parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + dInicio;
            parametros += '&p3=' + dFin;
            parametros += '&p4=' + bEstado;
            parametros += '&p5=' + iIdPuestoEmpleado;
            parametros += '&p6=' + periodoPuestoEmpleado


            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function (transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    //                    window.alert(respuesta);
                    detallePeriodosPuestoEmpleados(iIdPuestoEmpleado);
                    puestosPorEmpleados();
                    if (respuesta == "ok")
                        Windows.close("Div_ventanaEditarPeriodos", "");
                    else
                        $("div_msj_error").update(respuesta);
                }
            })
        }
        //        Windows.close("Div_ventanaEditarPeriodos");
    }
}

//function legajoDetalle(evento,elemnto,cadena){
function legajoDetalleModificado(idDocumentoEmpleado, iddocumento) {
    //posicion=cadena.indexOf('*',0);
    //tam=cadena.length;
    //idDocumentoEmpleado=cadena.substring(posicion+1,tam);
    //iddocumento=cadena.substring(0,posicion);
    // alert('documentoEmpleado:'+idDocumentoEmpleado+' documento:'+iddocumento)
    if (idDocumentoEmpleado == '-1') {
        agregarDocumentoEmpleado('', '', iddocumento)


    } else {
        var patronModulo = 'vistaLegajoDetalle';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + idDocumentoEmpleado;

        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                respuesta = transport.responseText;
                $('divResultadoLegajo').update(respuesta);
                if ($('imgEditar') != null)
                    $('imgEditar').show();

                //               nomDocumento=document.getElementById("txtnomDocumento").value;
                mostrarCV(); //lo mando el nombre de documento para pintarlo
            }
        })
    }


}
function legajoDetalle(evento, elemnto, cadena) {
    posicion = cadena.indexOf('*', 0);
    tam = cadena.length;
    idDocumentoEmpleado = cadena.substring(posicion + 1, tam);
    iddocumento = cadena.substring(0, posicion);
    // alert('documentoEmpleado:'+idDocumentoEmpleado+' documento:'+iddocumento)
    if (idDocumentoEmpleado == '-1') {
        agregarDocumentoEmpleado('', '', iddocumento)
    } else {
        patronModulo = 'vistaLegajoDetalle';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + idDocumentoEmpleado;

        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                respuesta = transport.responseText;
                $('divResultadoLegajo').update(respuesta);
                if ($('imgEditar') != null)
                    $('imgEditar').show();

                //               nomDocumento=document.getElementById("txtnomDocumento").value;
                mostrarCV(); //lo mando el nombre de documento para pintarlo
            }
        })
    }


}
function editarLegajo() {
    numero = $('longitud').value;
    $('fechaEntrega').readOnly = false;
    id = '';
    for (i = 0; i < numero; i++) {

        id = 'i' + i;
        $(id).readOnly = false;
        $(id).disabled = false;
    }
    $('imgGuardar').show();
    $('imgEditar').hide();
}

function guardarLegajo() {
    $('imgGuardar').hide();
    $('imgEditar').show();
    fecha = $('fechaEntrega').value;
    idDocumentoEmpleado = $('documentoEmpleado').value;
    guardarFechaDocumento(fecha, idDocumentoEmpleado);
    //para grabar los atributos
    numero = $('longitud').value;
    $('fechaEntrega').readOnly = true;
    id = '';
    valores = '';
    tipos = '';
    idAtributoDocuentoEmpleado = '';
    atributoDocumento = '';

    for (i = 0; i < numero; i++) {
        id = 'i' + i;
        tid = 't' + i;
        hid = 'h' + i;
        atri = 'atri' + i;
        valores = valores + $(id).value + '|';
        tipos = tipos + $(tid).value + '|';
        idAtributoDocuentoEmpleado = idAtributoDocuentoEmpleado + $(hid).value + '|';
        atributoDocumento = atributoDocumento + $(atri).value + '|';
    }
    patronModulo = 'mantemientoAtributosDocumentoEmpleados';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + valores;
    parametros += '&p3=' + tipos;
    parametros += '&p4=' + idAtributoDocuentoEmpleado;
    parametros += '&p5=' + atributoDocumento;
    parametros += '&p6=' + idDocumentoEmpleado;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            rs = transport.responseText;
            //window.alert(rs);
        }
    })
//   window.alert(valores);
//   window.alert('num:'+numero)
}

function bloquearDetalleLegajo() {
    numero = $('longitud').value;
    $('fechaEntrega').readOnly = true;
    id = '';
    for (i = 0; i < numero; i++) {

        id = 'i' + i;
        $(id).readOnly = true;
        $(id).disabled = true;
    }
    $('imgGuardar').hide();
    $('imgEditar').show();

}
function guardarFechaDocumento(fecha, idDocumentoEmpleado) {
    bloquearDetalleLegajo();
    patronModulo = 'actualizarFechaDocumento';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + fecha;
    parametros += '&p3=' + idDocumentoEmpleado;
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

function agregarDocumentoLegajo() {
    vformname = 'agregaDocumentoEmpleado'


    vtitle = 'AGREGAR DOCUMENTO AL EMPLEADO'
    vwidth = '700'
    vheight = '220'
    vcenter = 't'
    vresizable = ''
    vmodal = 'false'
    vstyle = ''
    vopacity = ''
    vposx1 = ''
    vposx2 = ''
    vposy1 = ''
    vposy2 = ''
    funcion = 'agregarDocumentoEmpleado'
    patronModulo = 'buscadorDocumento';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + funcion;
    posFuncion = '';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)

}

function agregarDocumentoEmpleado(elemeto, evento, codigoDocumento) {
    iCodigoEmplado = $('txtcodigoEmpleado').value;
    patronModulo = 'agregarDocumentoEmpleado';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iCodigoEmplado;
    parametros += '&p3=' + codigoDocumento;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            if (respuesta == 'not') {
                window.alert('El documentos ya fue Registrado Anteriomente');
            }
            mostrarLegajo();
        }
    })

}


function datosUsuario(c_cod_per) {
    patronModulo = 'datosUsuario';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);

            registroDatosPersonalDetalle('', '', c_cod_per)
        }
    })
}

function arbolCentroCosto() {
    parametros = "p1=arbolCentroCosto";
    funcionClick = "clickArbolCentroCosto";
    div = "divTreeCentroCosto";
    generarArbolx(div, parametros, funcionClick);
}

function cancelarLegajo() {
    mostrarLegajo();
}

function clickArbolCentroCosto(id, text) {
    $("hidCentroCosto").value = id;
    $("txtNombreCentroCosto").value = text;
//*********************************
//    $("btnGrabar").show();
}

function editarAreaCentroCosto() {
    habilitarCampos(campoArea);
    $("btnGrabar").hide();
    $("btnModificar").show();
    $("btnEditar").hide();
    $("btnNuevo").hide();
}

function buscarArea(opt) {
    $("divFilter").show();
    $("divTablaAreaCont").show();
    $("divMantenimientoArea").hide();
    $("divAsignarSede").show();
    nomArea = $("txtNombreArea").value;
    parametros = "p1=buscarArea&p2=" + nomArea;
    div = "divTablaArea";
    funcionClick = "clickTablaArea";
    funcionDblClick = "";
    funcionLoad = "setColorTablaArea";
    if (nomArea == "" || nomArea.length > 3 || opt == "all") {
        generarTablax(div, parametros, funcionClick, funcionDblClick, funcionLoad);
    }
}
//funcion original Viernes 27 Abril 2012
function buscarAreaModCoordinadoresTurnos2() {

    //    alert("se dispara un On key PR");

    //alert("valor Sede:"+IdcboSede);
    //     $("divFilter").show();
    //    $("divTablaAreaCont").show();
    //    $("divMantenimientoArea").hide();
    //    $("divAsignarSede").show();
    var txtNombreAreaAbuscar = $("txtNombreAreaAbuscar").value;
    var IdcboSede = $("cboSede").value;
    //parametros="p1=buscarArea&p2="+txtNombreAreaAbuscar;
    var parametros = "p1=buscarAreaModCoordinadoresTurnos&p2=" + txtNombreAreaAbuscar + "&p3=" + IdcboSede;
    //    alert("los Parametros"+parametros);
    var div = "Div_listadoTodosCordinadores";
    //    funcionClick="clickTablaArea";
    var funcionClick = "ClickCargarlistadoTodosCordinadores";
    var funcionDblClick = "";
    //    funcionLoad="setColorTablaArea";
    var funcionLoad = "setColorTablaAreaconCoordinador";
    //    alert('El valor es:'+parametros);


    //    
    //                  function CargarlistadoTodosCordinadores(){
    //                        var idSede=$("cboSede").value;
    //                        //alert(idSede);
    //                        var parametros="p1=CargarlistadoTodosCordinadores&p2="+idSede ;
    //                        var div="Div_listadoTodosCordinadores";
    //                        //var funcionClick="listarEmpleados";
    //                        var funcionClick="ClickCargarlistadoTodosCordinadores";
    //                        var funcionDblClick="";
    //                        var funcionLoad="";
    //                        generarTablaCoordinadores(div,parametros,funcionClick,funcionDblClick,funcionLoad);
    //                    }



    if (txtNombreAreaAbuscar == "" || txtNombreAreaAbuscar.length > 2) {
        generarTablaCoordinadores(div, parametros, funcionClick, funcionDblClick, funcionLoad);
    }





}

//nueva funcion viernes 12:55pm 27 Abril 2012
function buscarAreaModCoordinadoresTurnos() {
    //    var peru;
    //     peru=peru+3;
    //   // alert("ini"+peru+"fin");
    //    alert("ini"+laban+"fin");

    var txtNombreAreaAbuscar = $("txtNombreAreaAbuscar").value;
    var IdcboSede = $("cboSede").value;
    var numero = txtNombreAreaAbuscar.length;
    var parametros = "p1=buscarAreaModCoordinadoresTurnos&p2=" + txtNombreAreaAbuscar + "&p3=" + IdcboSede;

    //    var div="Div_listadoTodosCordinadores";

    //    var funcionClick="ClickCargarlistadoTodosCordinadores";
    //    var funcionDblClick="";

    //    var funcionLoad="setColorTablaAreaconCoordinador";

    if (numero == 3 || numero == 0) {
        //        alert("Nº de teclas presionadas: "+numero);
        dn = 0;
        mygridxcor = new dhtmlXGridObject('Div_listadoTodosCordinadores');
        mygridxcor.setImagePath("../../../../fastmedical_front/imagen/icono/");

        mygridxcor.attachEvent("onRowSelect", ClickCargarlistadoTodosCordinadores);

        //////////para cargador peche////////////////
        contadorCargador++;
        //        alert(contadorCargador);
        var idCargador = contadorCargador;
        mygridxcor.attachEvent("onXLS", function () {
            cargadorpeche(1, idCargador);

        });
        mygridxcor.attachEvent("onXLE", function () {
            cargadorpeche(0, idCargador);
            setColorTablaAreaconCoordinador();


        });
        /////////////fin cargador ///////////////////////


        mygridxcor.setSkin("dhx_skyblue");
        mygridxcor.init();
        //        tablaBusquedaPuestosEnCentroCostos.loadXML(pathRequestControl+'?'+parametros,function(){

        mygridxcor.loadXML(pathRequestControl + '?' + parametros, function () {
            dn = 1;
        });



        //tablaBusquedaPuestosEnCentroCostos.loadXML(pathRequestControl+'?'+parametros);
        //miTablaCie.clearAll();
    }
    if (numero > 3 && dn == 1) {
        //         alert("presiono mas de 3 osea: "+numero);
        mygridxcor.filterBy(1, $('txtNombreAreaAbuscar').value);
    }

//    if(numero==0){
//        //         alert("esta vacio ");
//        dn=0;
//        mygridxcor = new dhtmlXGridObject('Div_listadoTodosCordinadores');
//        mygridxcor.setImagePath("../../../../fastmedical_front/imagen/icono/");
//  
//        mygridxcor.attachEvent("onRowSelect",ClickCargarlistadoTodosCordinadores );
//        //////////para cargador peche////////////////
//        contadorCargador++;
//        var idCargador=contadorCargador;
//        mygridxcor.attachEvent("onXLS", function(){
//            cargadorpeche(1,idCargador);
//        
//        });
//        mygridxcor.attachEvent("onXLE", function(){
//            cargadorpeche(0,idCargador);
//            setColorTablaAreaconCoordinador();
//          
//        
//        });
//        /////////////fin cargador ///////////////////////
//       
//       
//        mygridxcor.setSkin("dhx_skyblue");
//        mygridxcor.init();
//        //        tablaBusquedaPuestosEnCentroCostos.loadXML(pathRequestControl+'?'+parametros,function(){
//        
//        mygridxcor.loadXML(pathRequestControl+'?'+parametros,function(){
//            dn=1;
//        });
//        
//   
//    }


//    if(txtNombreAreaAbuscar==""  || txtNombreAreaAbuscar.length>2){
//        generarTablaCoordinadores(div,parametros,funcionClick,funcionDblClick,funcionLoad);
//    }


}


function buscarAreaModSinCoordinadoresTurnos2() {

    //    alert("click en buscarArea");

    //     $("divFilter").show();
    //    $("divTablaAreaCont").show();
    //    $("divMantenimientoArea").hide();
    //    $("divAsignarSede").show();
    var txtNombreAreaAbuscar2 = $("txtNombreAreaAbuscar2").value;
    var IdcboSede = $("cboSede").value;
    //parametros="p1=buscarArea&p2="+txtNombreAreaAbuscar;
    var parametros = "p1=buscarAreaModSinCoordinadoresTurnos&p2=" + txtNombreAreaAbuscar2 + "&p3=" + IdcboSede;
    var div = "Div_listadoTodasAreasSinCoordinador";
    //    funcionClick="clickTablaArea";
    var funcionClick = "ClickCargarlistadoTodasAreasSinCoordinador";
    var funcionDblClick = "";
    //    funcionLoad="setColorTablaArea";
    var funcionLoad = "setColorTablaAreasinCoordinador";
    //    alert('El valor es:'+parametros);


    //    
    //                  function CargarlistadoTodosCordinadores(){
    //                        var idSede=$("cboSede").value;
    //                        //alert(idSede);
    //                        var parametros="p1=CargarlistadoTodosCordinadores&p2="+idSede ;
    //                        var div="Div_listadoTodosCordinadores";
    //                        //var funcionClick="listarEmpleados";
    //                        var funcionClick="ClickCargarlistadoTodosCordinadores";
    //                        var funcionDblClick="";
    //                        var funcionLoad="";
    //                        generarTablaCoordinadores(div,parametros,funcionClick,funcionDblClick,funcionLoad);
    //                    }



    if (txtNombreAreaAbuscar2 == "" || txtNombreAreaAbuscar2.length > 2) {
        generarTablax(div, parametros, funcionClick, funcionDblClick, funcionLoad);
    }





}
//funciones agregadas el 09Mayo 2012 JCQA
function PopPupArbolAreasConCoordinador(p) {

    //    alert("PopPupArbolAreasConCoordinador ...");

    var sede = $("cboSede").options[$("cboSede").selectedIndex].text;


    abrirPopPupArbolAreasConCoordinador(sede, p);



}

function PopPupArbolAreasSinCoordinador() {

    //    alert("PopPupArbolAreasSinCoordinador ...");
    abrirPopPupArbolAreasSinCoordinador();

}


function abrirPopPupArbolAreasConCoordinador(sede, p) {
    par_1 = '';
    par_1 = p;
    //    alert("el valor de par_1:"+par_1);
    posFuncion = "cargarArbolenPopPupArbolAreasConCoordinador";

    vtitle = " ";
    vformname = 'PopPupArbolAreasConCoordinador';
    vwidth = '350';
    vheight = '460';
    //    patronModulo='mantenimientoTurnoCordi';
    patronModulo = 'abrirPopPupArbolAreasConCoordinador';
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


    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + sede;
    //    parametros+='&p3='+area;
    //    parametros+='&p4='+cordinador;
    //    parametros+='&p5='+idSedeempresaArea;

    //    alert("Nombre Sede: "+sede);

    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);



}
//Div_TablaListaTurnosDisponibles



//pruebita 11 MAYO 2012 JCQA
function busquedaAreasEnArbolPopup() {

    treex.findItem($("txtBusquedaArbolxAreas").value);


}

//fin de 11Mayo 2012 JCQA


function cargarArbolenPopPupArbolAreasConCoordinador() {
    //    alert("paraaaaaaaaa11:"+par_1); 
    var sede = $("cboSede").value;
    if (sede.trim() == 'x') {
        //        alert("el Codigo es x");
        sede = '';

    } else {
        //        alert("diferente de x");

    }

    //     alert("El valor de la sede es: "+sede)
    //    var sede='';
    var parametros = "p1=arbolAreas";
    parametros += "&p2=" + sede;
    divMostrar = document.getElementById('Div_TablaListaTurnosDisponibles');
    //alert('paso1');
    divMostrar.innerHTML = " ";
    //    alert('paso2');
    treex = new dhtmlXTreeObject("Div_TablaListaTurnosDisponibles", "100%", "100%", 0);
    //    alert('paso3');
    treex.setSkin('dhx_skyblue');
    //   alert('paso4');
    treex.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    //   alert('paso5');
    treex.attachEvent("onClick", function () {


        //          alert("click en arbol");
        // implementar dos parametros: sede, area
        //          CargarlistadoTodosCordinadores();
        //          alert("parametro 1:"+treex.getSelectedItemId());

        //          alert("parametro 2:"+treex.getSelectedItemText());

        //        buscarEmpleadosAreas(treex.getSelectedItemId(),treex.getSelectedItemText());


        alert("click en arbol")

        return true;
    });


    treex.attachEvent("onDblClick", function () {

        //     alert("dobleclick en arbol");

        seleccionarAreaEnArbol();


        return true;
    });





    treex.openAllItems(0);
    //    treex.setXMLAutoLoading(pathRequestControl+'?'+parametros);
    treex.loadXML(pathRequestControl + '?' + parametros);
}

function seleccionarAreaEnArbol() {

    //    alert("seleccionaraAreaEnArbol::"+par_1);

    var nombreAreaArbol = treex.getSelectedItemText();
    //    alert("parametro1:"+ nombreAreaArbol);
    //    $("txtNombreAreaAbuscar").value=nombreAreaArbol;
    //    buscarAreasArbol();
    //    Windows.close("Div_PopPupArbolAreasConCoordinador", "");


    if (par_1 == 'conCordi') {

        $("txtNombreAreaAbuscar").value = nombreAreaArbol;

    } else if (par_1 == 'sinCordi') {

        //        alert("sinCordi");

        $("txtNombreAreaAbuscar2").value = nombreAreaArbol;

    }

    buscarAreasArbol();
    Windows.close("Div_PopPupArbolAreasConCoordinador", "");




}
//inicio 10Mayo2012
function  buscarAreasArbol() {


    var IdcboSede = $("cboSede").value;
    var parametros = "";
    var idCargador = "";


    if (par_1 == 'conCordi') {


        var txtNombreAreaAbuscar = $("txtNombreAreaAbuscar").value;

        //        var IdcboSede=$("cboSede").value;
        // var numero=txtNombreAreaAbuscar.length;
        parametros = "p1=buscarAreaModCoordinadoresTurnos&p2=" + txtNombreAreaAbuscar + "&p3=" + IdcboSede;


        mygridxcor = new dhtmlXGridObject('Div_listadoTodosCordinadores');
        mygridxcor.setImagePath("../../../../fastmedical_front/imagen/icono/");

        mygridxcor.attachEvent("onRowSelect", ClickCargarlistadoTodosCordinadores);

        //////////para cargador peche////////////////
        contadorCargador++;
        //        alert(contadorCargador);
        idCargador = contadorCargador;
        mygridxcor.attachEvent("onXLS", function () {
            cargadorpeche(1, idCargador);

        });
        mygridxcor.attachEvent("onXLE", function () {
            cargadorpeche(0, idCargador);
            setColorTablaAreaconCoordinador();


        });
        /////////////fin cargador ///////////////////////


        mygridxcor.setSkin("dhx_skyblue");
        mygridxcor.init();
        mygridxcor.loadXML(pathRequestControl + '?' + parametros, function () {

        });


    } else if (par_1 == 'sinCordi') {


        //        alert("sinCordi");
        var txtNombreAreaAbuscar2 = $("txtNombreAreaAbuscar2").value;
        //        $("txtNombreAreaAbuscar2").value=nombreAreaArbol;  

        //          var IdcboSede=$("cboSede").value;
        // var numero=txtNombreAreaAbuscar.length;
        parametros = "p1=buscarAreaModSinCoordinadoresTurnos&p2=" + txtNombreAreaAbuscar2 + "&p3=" + IdcboSede;


        mygridx = new dhtmlXGridObject('Div_listadoTodasAreasSinCoordinador');
        mygridx.setImagePath("../../../../fastmedical_front/imagen/icono/");

        mygridx.attachEvent("onRowSelect", ClickCargarlistadoTodasAreasSinCoordinador);

        //////////para cargador peche////////////////
        contadorCargador++;
        //        alert(contadorCargador);
        idCargador = contadorCargador;
        mygridx.attachEvent("onXLS", function () {
            cargadorpeche(1, idCargador);

        });
        mygridx.attachEvent("onXLE", function () {
            cargadorpeche(0, idCargador);
            setColorTablaAreasinCoordinador();


        });
        /////////////fin cargador ///////////////////////


        mygridx.setSkin("dhx_skyblue");
        mygridx.init();
        mygridx.loadXML(pathRequestControl + '?' + parametros, function () {

        });

    }


}
//fin de JCQA 10Mayo2012


function abrirPopPupArbolAreasSinCoordinador() {


    posFuncion = "cargarArbolenPopPupArbolAreasSinCoordinador";

    vtitle = "Area sin Coordinador en Arbol ";
    vformname = 'PopPupArbolAreasSinCoordinador';
    vwidth = '720';
    vheight = '470';
    //    patronModulo='mantenimientoTurnoCordi';
    patronModulo = 'abrirPopPupArbolAreasSinCoordinador';
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


    parametros = '';
    parametros += 'p1=' + patronModulo;
    //    parametros+='&p2='+sede;
    //    parametros+='&p3='+area;
    //    parametros+='&p4='+cordinador;
    //    parametros+='&p5='+idSedeempresaArea;

    //    alert(parametros);

    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

}


function cargarArbolenPopPupArbolAreasSinCoordinador() {

    var sede = $("cboSede").value;
    if (sede.trim() == 'x') {
        //        alert("el Codigo es x");
        sede = '';

    } else {
        //        alert("diferente de x");

    }

    //     alert("El valor de la sede es: "+sede)
    //    var sede='';
    var parametros = "p1=arbolAreas";
    parametros += "&p2=" + sede;
    divMostrar = document.getElementById('Div_TablaListaTurnosDisponibles');
    //alert('paso1');
    divMostrar.innerHTML = " ";
    //    alert('paso2');
    treex = new dhtmlXTreeObject("Div_TablaListaTurnosDisponibles", "100%", "100%", 0);
    //    alert('paso3');
    treex.setSkin('dhx_skyblue');
    //   alert('paso4');
    treex.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    //   alert('paso5');
    treex.attachEvent("onClick", function () {
        alert("click en arbol")
        //        buscarEmpleadosAreas(treex.getSelectedItemId(),treex.getSelectedItemText());
        return true;
    });
    treex.openAllItems(0);
    //    treex.setXMLAutoLoading(pathRequestControl+'?'+parametros);
    treex.loadXML(pathRequestControl + '?' + parametros);
}




//FIN de funciones agregadas el 09Mayo 2012 JCQA



//funtcion a modificar

function buscarAreaModSinCoordinadoresTurnos() {

    //    alert("click en buscarArea");

    //     $("divFilter").show();
    //    $("divTablaAreaCont").show();
    //    $("divMantenimientoArea").hide();
    //    $("divAsignarSede").show();
    var txtNombreAreaAbuscar2 = $("txtNombreAreaAbuscar2").value;
    var IdcboSede = $("cboSede").value;
    var numero2 = txtNombreAreaAbuscar2.length;
    //parametros="p1=buscarArea&p2="+txtNombreAreaAbuscar;
    var parametros = "p1=buscarAreaModSinCoordinadoresTurnos&p2=" + txtNombreAreaAbuscar2 + "&p3=" + IdcboSede;

    //  || numero==0
    if (numero2 == 3) {
        //        alert("Nº de teclas presionadas: "+numero);
        dn = 0;
        mygridx = new dhtmlXGridObject('Div_listadoTodasAreasSinCoordinador');
        mygridx.setImagePath("../../../../fastmedical_front/imagen/icono/");

        mygridx.attachEvent("onRowSelect", ClickCargarlistadoTodasAreasSinCoordinador);

        //////////para cargador peche////////////////
        contadorCargador++;
        //        alert(contadorCargador);
        var idCargador = contadorCargador;
        mygridx.attachEvent("onXLS", function () {
            cargadorpeche(1, idCargador);

        });
        mygridx.attachEvent("onXLE", function () {
            cargadorpeche(0, idCargador);
            setColorTablaAreasinCoordinador();



        });
        /////////////fin cargador ///////////////////////


        mygridx.setSkin("dhx_skyblue");
        mygridx.init();
        //        tablaBusquedaPuestosEnCentroCostos.loadXML(pathRequestControl+'?'+parametros,function(){

        mygridx.loadXML(pathRequestControl + '?' + parametros, function () {
            dn = 1;
        });

    }


    if (numero2 > 3 && dn == 1) {
        //         alert("presiono mas de 3 osea: "+numero);
        mygridx.filterBy(1, $('txtNombreAreaAbuscar2').value);
    }

    if (numero2 == 0) {
        //         alert("esta vacio ");
        //        dn=0;
        mygridx = new dhtmlXGridObject('Div_listadoTodasAreasSinCoordinador');
        mygridx.setImagePath("../../../../fastmedical_front/imagen/icono/");

        mygridx.attachEvent("onRowSelect", ClickCargarlistadoTodasAreasSinCoordinador);
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador = contadorCargador;
        mygridx.attachEvent("onXLS", function () {
            cargadorpeche(1, idCargador);

        });
        mygridx.attachEvent("onXLE", function () {
            cargadorpeche(0, idCargador);
            setColorTablaAreasinCoordinador();



        });
        /////////////fin cargador ///////////////////////


        mygridx.setSkin("dhx_skyblue");
        mygridx.init();
        //        tablaBusquedaPuestosEnCentroCostos.loadXML(pathRequestControl+'?'+parametros,function(){

        mygridx.loadXML(pathRequestControl + '?' + parametros, function () {
            //            dn=1;
        });


    }




//    if(txtNombreAreaAbuscar2==""  || txtNombreAreaAbuscar2.length>2){
//        generarTablax(div,parametros,funcionClick,funcionDblClick,funcionLoad);
//    }


}






//ejemplo de etiquetas avisos
function AsignarSede() {
    hidIdAreax = $("hidIdAreax").value.trim();
    if (hidIdAreax == "") {
        alert("Por favor seleccione o registre un Area");
        return;
    }
    cboSucursal = $("cboSucursal").value.trim();
    form = "";
    funcion = "";
    destino = "divResulAreaSede";
    parametros = "p1=asignarSedeArea&p2=" + hidIdAreax + "&p3=" + cboSucursal;
    enviarFormulario(form, parametros, funcion, destino);

//alert(hidIdAreax+' '+cboSucursal );
}
function setColorTablaArea() {
    for (i = 0; i < mygridx.getRowsNum(); i++) {
        estado = mygridx.cells(i, 3).getValue();
        if (estado == '1')
            mygridx.setRowTextStyle(mygridx.getRowId(i), 'background-color:#C1E69D;color:black;border-top: 1px solid #DAEFC2;');
        else if (estado == '0')
            mygridx.setRowTextStyle(mygridx.getRowId(i), 'background-color:#FFA66A;color:black;border-top: 1px solid #FFD7BB;');

    }
}
function abrirArea(opt, fil) {
    //    alert("Hola");
    posFuncion = "buscarArea('all')";
    vtitle = "Registrar Nueva Area";
    vformname = 'EtiquetaAtributo';
    vwidth = '600';
    vheight = '400';
    patronModulo = 'nuevaArea';
    vcenter = 't';
    vresizable = ''
    vmodal = 'false';
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

function clickTablaArea(fil, col) {
    if (col == 5) {// Editar
        $("hidIdAreax").value = mygridx.cells(fil, 0).getValue();
        $("txtDescripcionAreax").value = mygridx.cells(fil, 1).getValue();
        $("txtAbreviaturaAreax").value = mygridx.cells(fil, 2).getValue();
        $("txtEstadoAreax").value = mygridx.cells(fil, 3).getValue();
        $("btnModificar").show();
        $("divMantenimientoArea").show();
        $("btnGrabar").hide();
        $("divTablaAreaCont").hide();
        $("divFilter").hide();
        $("divAsignarSede").hide();
        //        abrirArea("editar",fil);
    } else if (col == 1 || col == 2 || col == 3 || col == 4) {
        estadoArea = mygridx.cells(fil, 3).getValue();
        idArea = mygridx.cells(fil, 0).getValue();
        if (estadoArea == '1') {
            $("hidIdAreax").value = idArea;
            $("txtDescripcionAreax").value = mygridx.cells(fil, 1).getValue();
            $("txtAbreviaturaAreax").value = mygridx.cells(fil, 2).getValue();
            $("btnGrabar").show();
            $("btnModificar").hide();
        } else if (estadoArea == '0') {
            $("hidIdAreax").value = "";
            $("txtDescripcionAreax").value = "";
            $("txtAbreviaturaAreax").value = "";
            alert("Por Favor Active el Área ...");
        }
        editarEncargado(idArea);
    }
}

function editarEncargado() {
    var idArea = $("hidIdAreax").value;
    var idSucursal = $("cboSucursal").value;
    if (idSucursal != "" && idArea != "") {
        parametros = "p1=editarEncargadoArea&p2=" + idArea + "&p3=" + idSucursal;
        datosx = traerData(parametros);
        $("txtNombres").value = datosx[1];
        $("hidIdPersona").value = datosx[0];
    }
}
function asignarEmpleadoArea() {
    idArea = $("hidIdAreax").value;
    idSucursal = $("cboSucursal").value;
    hidIdPersona = $("hidIdPersona").value;

    var parametros = "p1=asignarEmpleadoArea&p2=" + idArea + "&p3=" + idSucursal + "&p4=" + hidIdPersona;
    var datosx = traerData(parametros);
    if (datosx[0] == 'ok') {
        $('divMsmResultadoEncargado').innerHTML = '<p style="color: blue; font-weight: bold;">El coordinador fue asignado correctamente.</p>';
    } else if (datosx[0] != 'existe') {
        $('divMsmResultadoEncargado').innerHTML = '<p style="color: red; font-weight: bold;">Error al asignar,vuelva asignar nuevamente.</p>';
    }
}

//Creado el 29 Marzo 2012 es un funcion que se activa al pulsar el boton Modificar
//del pop pup de las areas con coordinador pero que contempla motivo de cese
//function asignarCoordinadorAlArea(){
//    
//    alert("click boton asignar");
//  
//    var fechaIni=$("txtFechaIni").value;
//    var fechaFin=$("txtFechaFin").value;
//    var NombreCoordinadorOculto=$("NombreCoordinadorOculto").value;
//    var nombresCoordinadorVisible=$("txtNombres").value;
//    var hiIdEncargadoProgramacionPersonal=$("hiIdEncargadoProgramacionPersonal").value;
//    var IdNuevoCoordinadorAsignado=$("hidIdPersona").value;
//    var hidSedeempresaArea=$("hidSedeempresaArea").value;
//    
//    var motivoCese=$("txtMotivoCese").value;
//
//    //    if($("txtNombres").value)  
//    //alert(fechaIni+fechaFin+NombreCoordinadorOculto+nombresCoordinadorVisible+IdNuevoCoordinadorAsignado+'ESP'+hidSedeempresaArea+'ESP'+hiIdEncargadoProgramacionPersonal);
//    
//    if(NombreCoordinadorOculto!=nombresCoordinadorVisible){
//        alert(" se modifico el nomb coordi" );
//      
//        //desactiva al coordinador y envia el motivo de cese
//        actualizarDescripcionCeseCoordinador(hiIdEncargadoProgramacionPersonal,motivoCese);
//        asignandoNuevoCoordinador(hidSedeempresaArea,IdNuevoCoordinadorAsignado,fechaIni,fechaFin);
//        
//
//       
//        
//    }else if(NombreCoordinadorOculto==nombresCoordinadorVisible) {
//        alert("NO se modifico el nom de coordi");
//        parametros='';
//        parametros+='p1=asignarsolofechasCoordinador';
//        parametros+='&p2='+fechaIni;
//        parametros+='&p3='+fechaFin;
//        parametros+='&p4='+hiIdEncargadoProgramacionPersonal;
//        var datosx=traerData(parametros);
//        
//        // alert(datosx[0].trim());
//        if(datosx[0].trim()=='ok'){
//            $('divMsmResultadoEncargado').innerHTML='<p style="color: blue; font-weight: bold;">Las fechas fueron insertadas correctamente</p>';
//            
//        }else if(datosx[0]!='existe'){
//            $('divMsmResultadoEncargado').innerHTML='<p style="color: red; font-weight: bold;">Error al enviar, vuelva asignar nuevamente.</p>';
//        }
//      
//    }
//   
//
//}
//


//*******************************************************************************************************************
//*******************************************************************************************************************
//Creado por Jose Carlos Quispe Araoz el 29 Marzo 2012 11:08am es un funcion que se activa al pulsar el boton Modificar
//del pop pup de las areas con coordinador, modificado.
//*******************************************************************************************************************
//*******************************************************************************************************************

//asignarNuevoCoordinadorAlArea

function asignarCoordinadorAlArea() {

    var NombreCoordinadorOculto = $("NombreCoordinadorOculto").value;
    var nombresCoordinadorVisible = $("txtNombres").value;
    var hiIdEncargadoProgramacionPersonal = $("hiIdEncargadoProgramacionPersonal").value;
    var IdNuevoCoordinadorAsignado = $("hidIdPersona").value;
    var hidSedeempresaArea = $("hidSedeempresaArea").value;
    var chkEstado = $("chkEstado").value;
    //    alert("/"+chkEstado +"/"+hiIdEncargadoProgramacionPersonal+"/" );

    if ($("chkEstado").value == '0') {
        //alert("usted quiere deshabilitar")

        if (window.confirm("Desea deshabilitar a este Coordinador?")) {

            parametros = '';
            parametros += 'p1=DesactivarCoordinadorDeArea';
            parametros += '&p2=' + hiIdEncargadoProgramacionPersonal;

            var datosx = traerData(parametros);

            if (datosx[0].trim() == 'ok') {
                $('divMsmResultadoEncargado').innerHTML = '<p style="color: blue; font-weight: bold;">Se Desactivo exitosamente</p>';
            } else if (datosx[0].trim() == 'existe') {
                $('divMsmResultadoEncargado').innerHTML = '<p style="color: red; font-weight: bold;">Error al desactivar al Coordinador.</p>';
            } else if (datosx[0].trim() == 'fallo') {
                $('divMsmResultadoEncargado').innerHTML = '<p style="color: red; font-weight: bold;">Error al desactivar al Coordinador.</p>';
            }

            //$("chkEstado").value='1';

            $("idbBuscarCoordinadores").show();//aparece el boton buscar
            //$("DivTextDescripcion").show();

            $("modificardiv").hide();//se oculta el modificar
            $("activardiv").show();//aparece boton guardarr
            limpiaCajaCoordinador();
            CargarlistadoTodosCordinadores();
            CargarlistadoTodasAreasSinCoordinador();

            //$("desactivardiv").show();

            //            $("txtNombres").value=='jose';

            //$('txtNombres').innerHTML='jose';

            //             document.getElementById("txtCodigo").value
            //            document.getElementById('txtNombres').value='';
            // $('txtNombres').value=='textoJose';

            //$("chkEstado").value=='1'


            ///fin
        }



    }



}

function limpiaCajaCoordinador() {
    // alert("entro a la funcion limpiajc");

    document.getElementById('txtNombres').value = '';

    document.getElementById("chkEstado").checked = true;

    document.getElementById('chkEstado').value = '1';



}

function salirModCoordiTurnos() {

    //    alert("click boton salir");
    var chkEstado = $("chkEstado").value;
    //alert("el valorInicio"+ chkEstado+"fin" );
    Windows.close("Div_MantenimientoCoordinadorArea", '');
    CargarlistadoTodasAreasSinCoordinador();

}

function asignandoNuevoCoordinador(hidSedeempresaArea, IdNuevoCoordinadorAsignado, fechaIni, fechaFin) {


    var form = "";
    var destino = "";
    //funcion="resultadoTablaTurnoxArea";
    var funcion = "";

    var parametros = '';
    parametros += 'p1=asignarNuevoCoordinador';
    parametros += '&p2=' + hidSedeempresaArea;
    parametros += '&p3=' + IdNuevoCoordinadorAsignado;
    parametros += '&p4=' + fechaIni;
    parametros += '&p5=' + fechaFin;


    if (window.confirm("Confirmar guardar el motivo y el nuevo coordinardor?")) {

        enviarFormulario(form, parametros, funcion, destino);


    }
}


function actualizarDescripcionCeseCoordinador(hiIdEncargadoProgramacionPersonal, motivoCese) {
    var form = "";
    var destino = "";
    //funcion="resultadoTablaTurnoxArea";
    var funcion = "";
    var parametros = "p1=actualizarDescripcionCeseCoordinador&p2=" + hiIdEncargadoProgramacionPersonal + "&p3=" + motivoCese;

    //        if(window.confirm("Confirmar la desactivacion del Coordinador?")){
    //        alert("Aqui proceso para desactivar al Coordi");

    enviarFormulario(form, parametros, funcion, destino);


}

//boton guardar pop pup
function asignandoNuevoCoordinadorAlArea() {

    asignarNuevoCoordinadorAlArea();


    if ($("hidIdPersona").value != '') {

        CargarlistadoTodosCordinadores();

    }



}

function asignarNuevoCoordinadorAlArea() {


    if ($("hidIdPersona").value == '' && $("chkEstado").value == "0") {

        alert("No ha sido seleccionado la activacion ni un nuevo Coordinador");

    } else {

        if ($("chkEstado").value == "1") {

            if ($("hidIdPersona").value != '') {

                if (window.confirm("Confirmar la Asignacion del Coordinador?")) {//inicio de confir

                    var IdCoordinadorAsignado = $("hidIdPersona").value;
                    var idSedeempresaArea = $("hidSedeempresaArea").value;

                    //alert("Cod.Empleado: "+IdCoordinadorAsignado+' area es:'+idSedeempresaArea);

                    //alert("se escogio algun nuevo coordi");

                    parametros = '';
                    parametros += 'p1=asignarNuevoCoordinadorAlArea';
                    parametros += '&p2=' + IdCoordinadorAsignado;
                    parametros += '&p3=' + idSedeempresaArea;

                    var datosx = traerData(parametros);
                    //alert("ini"+datosx[0].trim()+"fin");


                    if (datosx[0].trim() == 'ok') {
                        $('divMsmResultadoEncargado').innerHTML = '<p style="color: blue; font-weight: bold;">El Nuevo Coordinador se inserto exitosamente</p>';
                        //RefTaBlaAreasConCordi
                        CargarlistadoTodosCordinadores();

                    } else if (datosx[0].trim() == 'existe') {
                        $('divMsmResultadoEncargado').innerHTML = '<p style="color: red; font-weight: bold;">Error al enviar, vuelva asignar nuevamente.</p>';
                    } else if (datosx[0].trim() == 'fallo') {
                        $('divMsmResultadoEncargado').innerHTML = '<p style="color: red; font-weight: bold;">Esta Area ya tiene un coordinador asignado</p>';
                    }

                }


            } else {
                alert("seleccione algun coordinador");

            }


        } else if ($("chkEstado").value == "0") {

            alert("El check de activacion no ha sido seleccionado")



        }

    }

}


function desactivarCoordinadorAlArea() {
    //var hidSedeempresaArea=$("hidSedeempresaArea").value;
    var hiIdEncargadoProgramacionPersonal = $("hiIdEncargadoProgramacionPersonal").value;
    //   alert("holas");
    alert("El hiIdEncargadoProgramacionPersonal es: " + hiIdEncargadoProgramacionPersonal + "finn");

    //    //    $("hidIdPersona").value;
    //    //    alert($("hidIdPersona").value);
    //    //////////////////////////////////////////////
    //    
    //    //      idTSEA=mygridz.cells(fil,0).getValue();
    var form = "";
    var destino = "";
    //funcion="resultadoTablaTurnoxArea";
    var funcion = "";
    var parametros = "p1=desactivarCoordinadorAlArea&p2=" + hiIdEncargadoProgramacionPersonal;

    if (window.confirm("Confirmar la desactivacion del Coordinador?")) {
        alert("Aqui proceso para desactivar al Coordi");

        enviarFormulario(form, parametros, funcion, destino);

        $("idbBuscarCoordinadores").show();
        $("DivTextDescripcion").show();
        $("activardiv").show();
        $("desactivardiv").hide();



    } else {
        alert("adiosss");

    }
}
//********************************comentado Jose Quispe Araoz
//**********************************29 Marzo 12
//function actijc(){
//    
//    //     alert("click boton activar");
//   
//
//    $("idbBuscarCoordinadores").hide(); 
//    $("DivTextDescripcion").hide(); 
//    $("activardiv").hide(); 
//    $("desactivardiv").show();
//    
//}



function buscarEmpleadoAsignar() {
    posFuncion = "";
    vtitle = "Buscar Empleado";
    vformname = 'buscarEmpleado';
    vwidth = '800';
    vheight = '400';
    patronModulo = 'vbuscarEmpleado';
    vcenter = 't';
    vresizable = ''
    vmodal = 'false';
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



function buscarCoordinadoresAsignar() {
    posFuncion = "";
    vtitle = "Buscar Coordinadores";
    vformname = 'buscarCoordinadores';
    vwidth = '700';
    vheight = '400';
    patronModulo = 'vbuscarCoordinador';
    vcenter = 't';
    vresizable = ''
    vmodal = 'false';
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



function buscarEmpleadosPopap($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre) {
    patronModulo = "buscaEmpleadoPopap";
    cod = $cod;
    estado = $estado;
    if (($estado) == '0001' || ($estado) == '0000') {
        estado = '';
    }
    if (($estado) == '0002') {
        estado = 1;
    }
    if ($estado == '0003') {
        estado = 0;
    }
    tipoDoc = $tipoDoc;
    nDoc = $nDoc;
    apPat = $apPat;
    apMat = $apMat;
    nombre = $nombre;

    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + cod;
    parametros += '&p3=' + estado;
    parametros += '&p4=' + tipoDoc;
    parametros += '&p5=' + nDoc;
    parametros += '&p6=' + apPat;
    parametros += '&p7=' + apMat;
    parametros += '&p8=' + nombre;
    var funcionClick = "";
    var funcionDblClick = "seleccionarEmpleado";
    generarTablaBusquedaPopap("divResultadoEmpleados", parametros, funcionClick, funcionDblClick, "empleado_area");
}


function buscarCoordinadoresPopap($apPat, $apMat, $nombre) {

    patronModulo = "buscarCoordinadoresPopap";

    apPat = $apPat;
    apMat = $apMat;
    nombre = $nombre;

    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + apPat;
    parametros += '&p3=' + apMat;
    parametros += '&p4=' + nombre;
    //alert(parametros);
    var div = "divResultadoCoordinadores";
    var funcionClick = "";
    var funcionDblClick = "seleccionarCoordinador";
    var funcionLoad = "";
    //generarTablaBusquedaPopap(div,parametros,funcionClick,funcionDblClick,funcionLoad); vale
    //generarTablaBusquedaPopap(div,parametros,funcionClick,funcionDblClick,"coordinador_area");

    generarTablax(div, parametros, funcionClick, funcionDblClick, funcionLoad);


}


function seleccionarEmpleado(fil, col, accion) {
    var idPersona = mygridBusquedaPopap.cells(fil, 0).getValue();
    var nomEmpleado = mygridBusquedaPopap.cells(fil, 1).getValue();
    if (accion == "empleado_area") {
        $("txtNombres").value = nomEmpleado;
        $("hidIdPersona").value = idPersona;
    }
    Windows.close("Div_buscarEmpleado", "");
}

function seleccionarCoordinador(fil, col, accion) {
    //alert("presion la tabla resultados");
    var idEmpleado = mygridx.cells(fil, 0).getValue();
    var nomEmpleado = mygridx.cells(fil, 1).getValue();
    //    if(accion=="coordinador_area"){
    $("txtNombres").value = nomEmpleado;
    $("hidIdPersona").value = idEmpleado;
    //    }
    Windows.close("Div_buscarCoordinadores", "");
}
//buscarCoordinadores

function grabarCeCeSedeEmpresaArea() {
    idSEArea = $("hidIdAreaSede").value;
    idCCosto = $("hidCentroCosto").value;
    parametros = "p1=grabarCeCeSedeEmpresaArea";
    parametros += "&p2=" + idSEArea + "&p3=" + idCCosto;
    form = "";
    funcion = "listaSedeAreaCentroCosto(" + idSEArea + ")";
    destino = "";
    if (idCCosto == "") {
        alert("Por favor seleccione un Centro de Costo ...");
        return;
    }
    if (idSEArea == "") {
        alert("Por favor seleccione un Área de una Sede ...");
        return;
    }
    enviarFormulario(form, parametros, funcion, destino);
}

//function cargarDatosArea(fil){
//    $("hidArea").value=mygridx.cells(fil,0).getValue();
//    $("txtDescripcionAreax").value=mygridx.cells(fil,1).getValue();
//    $("txtAbreviaturaAreax").value=mygridx.cells(fil,2).getValue();
//    $("txtEstadoAreax").value=mygridx.cells(fil,3).getValue();
//    $("btnGrabar").hide();
//    $("btnModificar").show();
//
//}
function nuevoDatosArea() {
    $("btnGrabar").show();
    $("btnModificar").hide();
    $("divMantenimientoArea").show();
    $("divFilter").hide();
    $("divTablaAreaCont").hide();
    $("divAsignarSede").hide();
    $("hidIdAreax").value = "";
    $("txtDescripcionAreax").value = "";
    $("txtAbreviaturaAreax").value = "";
}
function grabarArea(opcion) {

    if (opcion == "grabar") {
        parametros = "p1=grabarArea";
        descripcion = $("txtDescripcionAreax").value;
        abrevia = $("txtAbreviaturaAreax").value;
        estado = $("txtEstadoAreax").value;
        parametros += "&p2=" + descripcion + "&p3=" + abrevia + "&p4=" + estado;
        funcion = "posModificarArea";
    } else if (opcion == "modificar") {
        parametros = "p1=modificarArea";
        idArea = $("hidIdAreax").value;
        descripcion = $("txtDescripcionAreax").value;
        abrevia = $("txtAbreviaturaAreax").value;
        estado = $("txtEstadoAreax").value;
        funcion = "posModificarArea";
        parametros += "&p2=" + idArea + "&p3=" + descripcion + "&p4=" + abrevia + "&p5=" + estado;
    }
    form = "";
    destino = "";
    enviarFormulario(form, parametros, funcion, destino);
//    buscarArea("all");
}
function posModificarArea() {
    $("divMantenimientoArea").hide();
    $("divFilter").show();
    $("divTablaAreaCont").show();
    $("divAsignarSede").show();
    buscarArea("all");
}

function refrescarTablaAreaCCosto() {
    idCC = $("hidCentroCosto").value;
    parametros = "p1=tablaAreaCCosto&p2=" + idCC;
    div = "divTablaArea";
    funcionClick = "";//"preEditarArea";
    funcionDblClick = "";
    funcionLoad = "";
    generarTablax(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}


//function puestoXarea(fil,col){
//    nomArea = mygridx.cells(fil,2).getValue();
//    $("hidFilaTablaArea").value=fil;
//    modalidadContrato=$("cboModContrato").options[$("cboModContrato").selectedIndex].text;
//    estilo=$("btnGrabar").getStyle('display');
//    //    alert(estilo);
//    if(modalidadContrato=='Seleccionar' &&  estilo=='block'){
//        alert("Por Favor Primero Registre la Modalidad de Contrato ... !");
//        return;
//    }
//    /*==================== tabla puesto area y centro de costo  ===========*/
//    if(modalidadContrato=="Locatario" || modalidadContrato=="LOCATARIO" || modalidadContrato=="locatario")
//        vwidth='460';
//    else  vwidth='750';
//    vformname='puestoxareayccosto';
//    vtitle='Seleccionar Puesto por Area';
//    vheight='400';
//    patronModulo='abrirAreaYccosto';
//    vcenter='t';
//    vresizable=''
//    vmodal='false';
//    vstyle='';
//    vopacity='';
//    veffect='';
//    vposx1='';
//    vposx2='';
//    vposy1='';
//    vposy2='';
//    parametros='';
//    parametros+='p1='+patronModulo+"&p2="+nomArea;
//    posFuncion = "listPuestoAreaYccosto";
//    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
///*=====================================================================*/
//}



//
//function listPuestoAreaYccosto(){
//    this.buscarPuestoAreaYccosto("all");
//}
//
//function buscarPuestoAreaYccosto(opt){
//    var fil=$("hidFilaTablaArea").value;
//    idsedeEmpresaArea = mygridx.cells(fil,0).getValue();
//    modalidadContrato=$("cboModContrato").options[$("cboModContrato").selectedIndex].text;
//    /**********************************************************************************/
//    var accion="";
//    if(modalidadContrato=="Locatario" || modalidadContrato=="LOCATARIO" || modalidadContrato=="locatario"){
//        document.getElementById('div_puestoAreaYccosto').style.width='410px';
//        accion="NCC";
//    }
//    else
//        document.getElementById('div_puestoAreaYccosto').style.width='700px';
//
//    /**********************************************************************************/
//    var nombrePuesto="";
//    if(opt != "all"){
//        nombrePuesto=$("txtNombrePuesto").value;
//    }
//    /**********************************************************************************/
//    parametros="p1=listPuestoAreaYccosto&p2="+idsedeEmpresaArea+"&p3="+accion+"&p4="+nombrePuesto;
//    div="div_puestoAreaYccosto";
//    funcionClick="selecionarPuestoXccosto";
//    funcionDblClick="";
//    funcionLoad="";
//    if(opt=="all" || (nombrePuesto.length>4 || nombrePuesto==""))
//        generarTablay(div,parametros,funcionClick,funcionDblClick,funcionLoad);
//}
//
//function selecionarPuestoXccosto(fil,col){
//    idPuesto = mygridx.cells(fil,0).getValue();
//    alert(idPuesto);
//    modalidadContrato=$("cboModContrato").options[$("cboModContrato").selectedIndex].text;
//    if(modalidadContrato=="Locatario" || modalidadContrato=="LOCATARIO" || modalidadContrato=="locatario"){
//
//    }else{
//        asignarPuestoEmpleado("", "",idPuesto)
//    }
//}

//function seletSegunSucursal(){
//    idSucursal=$("cboSucursal").value;
//    parametros="p1=listaTablaArea&p2="+idSucursal;
//    div="divListaTablaArea";
//    funcionClick="puestoXarea";
//    funcionDblClick="";
//    funcionLoad="";
//    generarTablax(div,parametros,funcionClick,funcionDblClick,funcionLoad);
//    $("divListaTablaArea").show();
//}

//function grabarModalidadContrato(accion){
//    idEmpModCon=$("hidIdEmpModCon").value;
//    idModContrato=$("cboModContrato").value;
//    idEmpleado=$("txtCopEmp").value;
//    if(idModContrato==""){
//        alert("Por Favor Seleccione un Tipo de Contrato");
//        return;
//    }
//    sueldo=$("txtSueldo").value;
//    fechaInicio=$("txtFechaInicio").value;
//    fechaFin=$("txtFechaFin").value;
//    form="";
//    destino="";
//    funcion="desactivarModatidadContrata(0)";
//    parametros="p1=grabarModalidadContrato&p2="+idModContrato;
//    parametros+="&p3="+sueldo+"&p4="+fechaInicio+"&p5="+fechaFin;
//    parametros+="&p6="+idEmpleado+"&p7="+idEmpModCon+"&p8="+accion;
//    enviarFormulario(form,parametros,funcion,destino);
//}


//function editarModalidadContrato(){
//    var campoModalidad=["cboModContrato","txtSueldo","txtFechaInicio","txtFechaFin"];
//    habilitarCampos(campoModalidad);
//    $("btnGrabar").hide();
//    $("btnEditar").hide();
//    $("btnModificar").show();
//}
//function nuevoModalidadContrato(){
//    var campoModalidad=["cboModContrato","txtSueldo","txtFechaInicio","txtFechaFin"];
//    habilitarCampos(campoModalidad);
//    $("btnGrabar").show();
//    $("btnEditar").hide();
//    $("btnModificar").hide();
//    for(i=0;i<campoModalidad.length;i++){
//        $(campoModalidad[i]).value="";
//    }
//}


function cargarArbolEmpresaSucursal() {
    parametros = "p1=arbolEmpresaSucursal";
    funcionClick = "selectEmpresaSucursal";
    div = "divTreeEmpresaSucursal";
    generarArbolx(div, parametros, funcionClick);
}
function selectEmpresaSucursal(id, text) {
    if (id != "0110073") { //0110073 --> id de empresa
        /*--------------------------*/
        $("hidIdEmpresaSedeArea").value = "";
        $("hidArea").value = "";
        $("hidSucursal").value = "";
        $("hidIdSucursal").value = id;
        $("div_MantenimientoTurnoArea").show();
        /*--------------------------*/
        div = "tablaAreaSucursal";
        parametros = "p1=listAreaSucursal&p2=" + id;
        funcionClick = "setHiddenEmpresaSucursal";
        funcionDblClick = "";
        funcionLoad = "mostrarTablaTurnoArea";
        generarTablax(div, parametros, funcionClick, funcionDblClick, funcionLoad);
    }
}

function mostrarTablaTurnoArea() {
    div = "tablaTurnoProgramar";
    parametros = "p1=listTurnoProgramar";//listTurnoArea
    funcionClick = "selectTurnoArea";
    funcionDblClick = "";
    funcionLoad = "resultadoTablaTurnoxArea";//Funcion callback que llama cuando termino de crear la anterior tabla: tablaTurnoProgramar
    generarTablay(div, parametros, funcionClick, funcionDblClick, funcionLoad);
    //tabsMantenimietoTurnoArea("men1");
    tabsMantenimietoTurnoArea($("hdnMenuActivo").value);
}
function tabsMantenimietoTurnoArea(activado) {
    var divTabs = ["mrTab1", "mrTab2"];
    var idMenu = ["men1", "men2"];
    iniTabs(divTabs, idMenu, activado);
}
function setHiddenEmpresaSucursal(fil, col) {
    var idEmpresaSedearea = mygridx.cells(fil, 0).getValue();
    $("hidIdEmpresaSedeArea").value = idEmpresaSedearea;
    $("hidArea").value = mygridx.cells(fil, 2).getValue();
    $("hidSucursal").value = mygridx.cells(fil, 4).getValue();
//    this.encargadosPorArea();
}
function selectTurnoArea(fil, col) {

    idEmpresaSedeArea = $("hidIdEmpresaSedeArea").value;
    //        area=$("hidArea").value;
    //        sucursal=$("hidSucursal").value;
    //        idTurno=mygridy.cells(fil,0).getValue();
    //        tipoTurno=mygridy.cells(fil,1).getValue();
    //        descTurno=mygridy.cells(fil,2).getValue();
    if (idEmpresaSedeArea == "") {
        alert("Por Favor Seleccione Un Area ...")
        return;
    }
    $("hidIdTurno").value = mygridy.cells(fil, 0).getValue(); //mygridy.cells(fil,1).getValue();
}
function asignarTurnoArea() {
    idEmpresaSedeArea = $("hidIdEmpresaSedeArea").value;
    idTurnoProgramar = $("hidIdTurno").value;
    if (idTurnoProgramar == "") {
        alert("Por favor seleccione un Turno ...");
        return;
    }
    form = "";
    destino = "";
    funcion = "resultadoTablaTurnoxArea";
    parametros = "p1=asignarTurnoSedeEmpresaArea&p2=" + idEmpresaSedeArea;
    parametros += "&p3=" + idTurnoProgramar; //+"&p4="+idLeyendaTurno;
    enviarFormulario(form, parametros, funcion, destino);
//        }

}

function resultadoTablaTurnoxArea() {
    idSucursal = $("hidIdSucursal").value;
    div = "tablaTurnoxArea";
    parametros = "p1=listTablaTurnoxArea&p2=" + idSucursal;
    funcionClick = "desactivarTSEA";
    funcionDblClick = "";
    funcionLoad = "";
    generarTablaz(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}
function desactivarTSEA(fil, col) {
    if (col == 7) {
        idTSEA = mygridz.cells(fil, 0).getValue();
        form = "";
        destino = "";
        funcion = "resultadoTablaTurnoxArea";
        parametros = "p1=desactivarTSEA&p2=" + idTSEA;
        if (window.confirm("Desea desactivar ?")) {
            enviarFormulario(form, parametros, funcion, destino);
        }
    }

}
function cargarCboArea() {
    idSucursal = $("cboSucursal").value;
    if (idSucursal == "") {
        alert("Por favor seleccionar una sucursal.");
        return;
    }
    tipoContrato = $("cboTipoContrato").value;
    form = "";
    destino = "div_cbo_area";
    funcion = "";
    parametros = "p1=cargarCboArea&p2=" + idSucursal + "&p3=" + tipoContrato;
    enviarFormulario(form, parametros, funcion, destino);
}

function cargarCboArea2() {
    idSucursal = $("cboSucursal").value;
    if (idSucursal == "") {
        alert("Por favor seleccionar una sucursal.");
        return;
    }
    destino = "div_cbo_area";
    parametros = "p1=cargarCboArea2&p2=" + idSucursal;
    enviarFormulario("", parametros, "", destino);
}

function cargarCboSubArea() {
    var cboDatos = $("cboArea").value;
    cboDatos = cboDatos.split("|");
    if (cboDatos[0] == "") {
        alert("Por favor seleccionar un área.");
        return;
    }
    destino = "div_cbo_subarea";
    parametros = "p1=cargarSubArea&p2=" + cboDatos[0];
    enviarFormulario("", parametros, "", destino);
}

function cargarCboSedeArea(combo, destino, nombre, onchange) {//puede ser llamado de cualquier combo
    idSucursal = combo.value;//recupera el value del combo seleccionado
    if (idSucursal == "") {
        alert("Por favor seleccionar una sucursal.");
        return;
    }
    parametros = "p1=cargarCboSedeArea&p2=" + idSucursal + "&p3=" + nombre + "&p4=" + onchange;
    enviarFormulario("", parametros, "", destino);
}
function comboSubAreas() {
    datos = $("cboAreay").value;
    datos = datos.split("|");
    idArea = datos[1];
    idSede = $("cboSucursaly").value;
    if (idArea == "") {
        alert("Por favor seleccionar un Área.");
        return;
    }
    destino = "div_cboSubAreas";
    parametros = "p1=cargarCboSubArea&p2=" + idSede + "&p3=" + idArea;
    enviarFormulario("", parametros, "", destino);
}

//function comboCategoriaSubArea(){
//    idSubArea=$("cboSubArea").value;
//    if(idSubArea==""){
//        alert("Por favor seleccionar una Sub Area.");
//        return;
//    }
//    destino="div_cboCategoriaSubArea";
//    parametros="p1=comboCategoriaSubArea&p2="+idSubArea;
//    funcion="cargarTablasSubareas"
//    enviarFormulario("",parametros,funcion,destino);
//}


//function encargadosPorArea(){
//    //hidIdEmpresaSedeArea
//    nuevaPersonaEncargada();
//    //    idSedeEmpresa=$("hidIdSucursal").value;
//    idSedeEmpresaArea=$("hidIdEmpresaSedeArea").value;
//    destino="divCboCategoriaPuesto";
//    form="";
//    funcion="";
//    parametros="p1=cargarCboPuestoCategoria&p2="+idSedeEmpresaArea;
//    enviarFormulario(form,parametros,funcion,destino);
//}

function listaEncargadosPorArea() {
    $("tablaEncargadosxArea").show();
    idEmpresaSedeArea = $("hidIdEmpresaSedeArea").value;
    if (idEmpresaSedeArea == "") {
        alert("Por favor seleccione un área .");
        return;
    }
    div = "tablaEncargadosxArea";
    parametros = "p1=tablaEncargadosxArea&p2=" + idEmpresaSedeArea;
    funcionClick = "editarEmpleadoCargo";
    funcionDblClick = "";
    funcionLoad = "";//resaltarEncargados
    generarTablap(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}
//function resaltarEncargados(){
//    for(i=0;i<mygridp.getRowsNum();i++){
//        var resaltar=mygridp.cells(i,5).getValue();
//        if(resaltar==1)
//            mygridp.setRowColor(mygridp.getRowId(i),"#FFB062");
//    }
//}

var camposPerEnc = ["txtFechIni", "txtFechFin", "cboEstado"];
function editarEmpleadoCargo(fil, col) {
    idEmpleado = mygridp.cells(fil, 0).getValue();
    $("hidCodigoEmpleado").value = idEmpleado;
    $("txtNombre").value = mygridp.cells(fil, 1).getValue() + " " + mygridp.cells(fil, 2).getValue() + " " + mygridp.cells(fil, 3).getValue();
    parametros = "p1=editarEmpleadoCargo&p2=" + idEmpleado;
    datos = traerData(parametros);
    if (datos[0] != "NO") {
        deshabilitarCampos(camposPerEnc);
        $("hidIdProgramacionPersonal").value = datos[0];
        $("txtFechIni").value = datos[1];
        $("txtFechFin").value = datos[2];
        $("cboEstado").value = datos[3];
        $("divEdita").show();
        $("divGraba").hide();
        $("divActualiza").hide();
    } else {
        nuevaPersonaEncargada();
    }
//    enviarFormularioTraerData(form,parametros,funcion)
}
function grabarPersonaEncargada(opt) {
    idEmpleado = $("hidCodigoEmpleado").value;
    if (idEmpleado == "") {
        alert("Por Favor Seleccione una Persona Encargada ...");
        return;
    }
    fechaIni = $("txtFechIni").value;
    fechaFin = $("txtFechFin").value;
    estado = $("cboEstado").value;
    idProgPer = $("hidIdProgramacionPersonal").value;
    parametros = "p1=grabarPersonaEncargada&p2=" + idEmpleado;
    parametros += "&p3=" + fechaIni + "&p4=" + fechaFin + "&p5=" + estado + "&p6=" + idProgPer + "&p7=" + opt;
    var respuesta = traerData(parametros);

    if (respuesta[0] != 'ok') {
        alert(respuesta[0]);
        return;
    } else {
        postGrabarPersonaEncargada();
    }

}
function postGrabarPersonaEncargada() {
    deshabilitarCampos(camposPerEnc);
    $("divEdita").show();
    $("divGraba").hide();
    $("divActualiza").hide();
    listaEncargadosPorArea();
}
function editarPersonaEncargada() {
    $("divEdita").hide();
    $("divGraba").hide();
    $("divActualiza").show();
    habilitarCampos(camposPerEnc);
}
function nuevaPersonaEncargada() {
    habilitarCampos(camposPerEnc);
    //    $("hidCodigoEmpleado").value="";
    //    $("txtNombre").value="";
    $("txtFechIni").value = "";
    $("txtFechFin").value = "";
    $("cboEstado").value = "";
    $("divEdita").hide();
    $("divGraba").show();
    $("divActualiza").hide();
}
function listaAreaPorSede() {
    $("divTablaAreaSede").show();
    idSede = $("cboSede").value;
    if (idSede == "") {
        alert("Por favor seleccione una Sede ...");
        return;
    }
    parametros = "p1=listAreaSucursal&p2=" + idSede;
    div = "divTablaAreaSede";
    funcionClick = "setAreaPorSede";
    funcionDblClick = "";
    funcionLoad = "";
    generarTablay(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}
function setAreaPorSede(fil, col) {
    idSedeEmpresaArea = mygridy.cells(fil, 0).getValue();
    $("hidIdAreaSede").value = idSedeEmpresaArea;
    listaSedeAreaCentroCosto(idSedeEmpresaArea);
}

function tblSedeEmpresaArea() {
    idSede = $("cboSucursal").value;
    parametros = "p1=listAreaSucursal&p2=" + idSede;
    div = "divTablaSedeEmpresaArea";
    funcionClick = "setTblSedeEmpresaArea";
    funcionDblClick = "";
    funcionLoad = "";
    generarTablax(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}
function setTblSedeEmpresaArea(fil, col) {
    $("hidIdSedeEmpresaArea").value = mygridx.cells(fil, 0).getValue();
    $("hidIdArea").value = mygridx.cells(fil, 1).getValue();
    //alert($("hidIdArea").value);
    $("txtSedeEmpresaArea").value = mygridx.cells(fil, 2).getValue();
    Windows.close("Div_SedeEmpresaArea", "");
}
function btnSetSedeEmpresaArea() {
    idSede = $("cboSucursal").value;
    nomSede = $("cboSucursal").options[$("cboSucursal").selectedIndex].text;
    if (idSede == "") {
        alert("Por favor seleccione una Sede ...");
        return;
    }
    vformname = 'SedeEmpresaArea';
    vtitle = 'Áreas de la sede ' + nomSede;
    vwidth = '510';
    vheight = '300';
    patronModulo = 'selectSedeEmpresaArea';
    vcenter = 't';
    vresizable = ''
    vmodal = 'false';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    posFuncion = "tblSedeEmpresaArea";
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
}

function listaSedeAreaCentroCosto(hidIdAreaSede) {
    parametros = "p1=listaSedeAreaCentroCosto&p2=" + hidIdAreaSede;
    div = "divSedeAreaCentroCosto";
    funcionClick = "eliminacionFisicaSedeAreaCentroCosto";
    funcionDblClick = "";
    funcionLoad = "";
    if (hidIdAreaSede != "")
        generarTablaz(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}
function eliminacionFisicaSedeAreaCentroCosto(fil, col) {
    if (col == "5") {
        if (confirm("Esta seguro de eliminar.")) {
            var idSedeAreaCentroCosto = mygridz.cells(fil, 0).getValue();
            var hidIdAreaSede = mygridz.cells(fil, 2).getValue();
            var parametros = "p1=eliminacionFisicaSedeAreaCentroCosto&p2=" + idSedeAreaCentroCosto;
            enviarFormularioSincronizado("", parametros, "", "");
            listaSedeAreaCentroCosto(hidIdAreaSede);
        }
    }

}


/******************************************************************************/
/********* Codigo más rayado que el tigre - Autor :(JCLM63-2011/04/29) ********/
/******************************************************************************/


function verTotalHorasProgramados(fil, col) {
    if (col == 1) {
        this.sumarHorasProgramadas(fil, col);
    } else if (col == 0) {
        this.grabarHorasProgramadas(fil, col);
    } else if (col == 2) {
        this.agregarTurnoAdicional(fil, col);
    }
    $("hidIdEmpleado").value = mygridSplitAt.cells(fil, 3).getValue();
    $("txtNomEmpleado").value = mygridSplitAt.cells(fil, 4).getValue();
}
function sumarHorasProgramadas(fil, col) {
    var cadenaImg = mygridSplitAt.cells(fil, 0).getValue();
    var colx = mygridSplitAt.getColumnsNum() - 2;// n columnas --> del 0 al n-1
    var numCol = colx - 1;//colunas con solo fechas
    var idDPPDias = mygridSplitAt.cells(fil, numCol).getValue();
    var dppdias = new Array();
    var idDPP = new Array();
    var diasEditadas = new Array();
    var horas = new Array();
    var newCadena = "";
    var id_totalHoras;
    var newTotalHoras = 0;
    var sumNewHora = 0;
    if (cadenaImg.indexOf('modificar') != -1) {
        /*================ dias que seran que ya estan registrados ================*/
        if (idDPPDias != "") {
            idDPPDias = idDPPDias.split("|");//datos a modificar
            for (i = 0; i < idDPPDias.length; i++) {
                dppdias = idDPPDias[i].split("_");
                idDPP[i] = dppdias[0];
                diasEditadas[i] = dppdias[1];//dia
                horas[i] = dppdias[2];//horas
            }
        }
        /*=============   Fin dias que seran que ya estan registrados =============*/
        var diax = 0;
        var newHora = 0;
        for (i = 6; i < numCol; i++) {
            diax = diax + 1;
            newHora = 0;
            id_totalHoras = mygridSplitAt.cells(fil, i).getValue();//capturo la concadenacion
            for (j = 0; j < diasEditadas.length; j++) {
                if (id_totalHoras != "Doble Click") {
                    var datos = id_totalHoras.split("|");
                    if (datos[0].length < 6) { //parseInt(datos[0]) > 0
                        if (diax == diasEditadas[j]) {
                            if (newCadena == "")
                                newCadena += idDPP[j] + "_" + diasEditadas[j] + "_" + datos[1];
                            else
                                newCadena += "|" + idDPP[j] + "_" + diasEditadas[j] + "_" + datos[1];
                        } else
                            newHora = datos[1];
                    } else if (id_totalHoras.search(/\(/i) > -1 && id_totalHoras.search(/\)/i) > -1) {
                        if (diax == diasEditadas[j]) {
                            if (newCadena == "")
                                newCadena += idDPP[j] + "_" + diasEditadas[j] + "_" + parseFloat(horas[j]);
                            else
                                newCadena += "|" + idDPP[j] + "_" + diasEditadas[j] + "_" + parseFloat(horas[j]);
                        }
                    }
                }
            }
            sumNewHora = sumNewHora + parseFloat(newHora);
        }
        mygridSplitAt.cells(fil, numCol).setValue(newCadena);
        /*======================  Leer el total de horas ==========================*/
        var newIdDPPDias = mygridSplitAt.cells(fil, numCol).getValue();
        var newDppdias = new Array();
        newTotalHoras = sumNewHora;
        if (newIdDPPDias != "") {
            newIdDPPDias = newIdDPPDias.split("|");//datos a modificar
            for (i = 0; i < newIdDPPDias.length; i++) {
                newDppdias = newIdDPPDias[i].split("_");
                newTotalHoras = newTotalHoras + parseFloat(newDppdias[2]);//horas
            }
        }
        /*=========================================================================*/
    } else if (cadenaImg.indexOf('grabar') != -1) {
        for (i = 6; i < numCol; i++) {
            id_totalHoras = mygridSplitAt.cells(fil, i).getValue();//capturo la concadenacion
            if (id_totalHoras != "Doble Click") {
                datos = id_totalHoras.split("|");
                if (datos[0].length < 6) {//parseInt(datos[0]) > 0
                    newTotalHoras = newTotalHoras + parseFloat(datos[1]);
                }
            }
        }
    } else if (cadenaImg.indexOf('adicionar') != -1) {
        for (i = 6; i < numCol; i++) {
            id_totalHoras = mygridSplitAt.cells(fil, i).getValue();//capturo la concadenacion
            if (id_totalHoras != "Doble Click") {
                datos = id_totalHoras.split("|");
                if (datos[0].length < 6) {//parseInt(datos[0]) > 0
                    newTotalHoras = newTotalHoras + parseFloat(datos[1]);
                }
            }
        }
    } else if (cadenaImg.indexOf('editar') != -1) {
        newTotalHoras = mygridSplitAt.cells(fil, colx).getValue();//capturo la concadenacion
    }

    mygridSplitAt.cells(fil, 5).setValue(newTotalHoras);
    mygridSplitAt.cells(fil, colx).setValue(newTotalHoras);
    if (newTotalHoras > 250) {//horas limites de cada vago
        alert("Sr(a) la cantidad de horas programadas sobrepasa las 250 Horas, por favor tiene que QUITAR " + (newTotalHoras - 250) + " Horas ...!");
        return;
    }
}


function canbiarIconoHorariosProgramados(opt, fil, col) {
    var modificar = "../../../../fastmedical_front/imagen/icono/modificar.png ^ Modificar";
    var editar = "../../../../fastmedical_front/imagen/icono/editar.png ^ Editar";
    switch (opt) {
        case 1://cambiar a editar
            mygridSplitAt.cells(fil, 0).setValue(editar);

            break;
        case 2://cambiar a modificar
            mygridSplitAt.cells(fil, 0).setValue(modificar);

            break;
    }
}


function colorTablaProgramacionHorarios() {
    var numCol = mygridSplitAt.getColumnsNum() - 3;// n columnas --> del 0 al n-1
    var idPacienteAnterior = "";
    var coloresBg1 = ["#CDD3DA", "#EEF0F2"];
    var coloresLt1 = ["#666666", "#000000"];
    var t = 0;
    for (i = 0; i < mygridSplitAt.getRowsNum(); i++) {
        //------------------------- colores ------------------------------------
        var idPaciente = mygridSplitAt.cells(i, 3).getValue();
        if (idPacienteAnterior == idPaciente) {
            t = (t - 1) * (-1);
            t = (t - 1) * (-1);

        } else {
            t = (t - 1) * (-1);
        }
        colorbg1 = coloresBg1[t];
        colorlt1 = coloresLt1[t];

        for (j = 0; j < 5; j++) {
            mygridSplitAt.setCellTextStyle(mygridSplitAt.getRowId(i), j, 'background-color:' + colorbg1 + ';color:' + colorlt1 + ';border-top: 0px solid #E8F3FD;');
        }
        idPacienteAnterior = idPaciente;
        //------------------------- fin colores --------------------------------
        //----------------------------------------------------------------------
        mygridSplitAt.setCellTextStyle(mygridSplitAt.getRowId(i), 5, 'background-color:' + colorbg1 + ';color:#FF0000; border-top: 0px solid #E8F3FD; font-weight: bold;');
        for (j = 6; j < numCol; j++) {
            var dataCell = mygridSplitAt.cells(i, j).getValue();
            if (dataCell.indexOf('V') != -1) {//dentro de la cadena Existe la letra V
                mygridSplitAt.setRowExcellType(mygridSplitAt.getRowId(i), "ro");
                mygridSplitAt.setCellTextStyle(mygridSplitAt.getRowId(i), j, 'background-color:#FF9977;color:#FF0000; border-top: 0px solid #E8F3FD;'); //font-weight: bold;
            } else if (dataCell.indexOf('Doble Click') != -1) { //Existe la palabra Doble Click
                mygridSplitAt.setCellTextStyle(mygridSplitAt.getRowId(i), j, 'color:#C3C3C3; border-top: 0px solid #E8F3FD;');
            } else {
                mygridSplitAt.setRowExcellType(mygridSplitAt.getRowId(i), "ro");
                mygridSplitAt.setCellTextStyle(mygridSplitAt.getRowId(i), j, 'color:#000;border-top: 0px solid #E8F3FD;');//font-weight: bold;
            }

        }
        //----------------------------------------------------------------------
        cadenaImg = mygridSplitAt.cells(i, 0).getValue();
        cadenaImg2 = mygridSplitAt.cells(i, 2).getValue();
        if (cadenaImg.indexOf('Editar') != -1)
            mygridSplitAt.cells(i, 0).setValue("../../../../fastmedical_front/imagen/icono/editar.png ^ Editar");
        else if (cadenaImg.indexOf('Grabar') != -1)
            mygridSplitAt.cells(i, 0).setValue("../../../../fastmedical_front/imagen/icono/modificar.png ^ Modificar");
        if (cadenaImg2.indexOf('no_add.png') != -1)
            mygridSplitAt.cells(i, 2).setValue("../../../../fastmedical_front/imagen/icono/no_add.png ^ ...");
        else
            mygridSplitAt.cells(i, 2).setValue("../../../../fastmedical_front/imagen/icono/abrir16.png ^ Agragar otro turno");

        mygridSplitAt.cells(i, 1).setValue("../../../../fastmedical_front/imagen/icono/timer.png ^ Ver total Horas");

        //----------------------------------------
    }
    mygridSplitAt.setColumnExcellType(0, "img");
    mygridSplitAt.setColumnExcellType(1, "img");
    mygridSplitAt.setColumnExcellType(2, "img");
}

function agregarTurnoAdicional(fil, col) {
    cadenaImg2 = mygridSplitAt.cells(fil, 2).getValue();
    if (cadenaImg2.indexOf('abrir16.png') != -1) {
        var datosx = $("cboArea").value;
        datosx = datosx.split("|");
        var iIdSedeEmpresaAreaCentroCosto = datosx[1];
        var idEmpleado = mygridSplitAt.cells(fil, 3).getValue();
        var idProgramacionPersonal = $("hidIdProgramacionPersonal").value;
        var mes = $("cboMes").value;
        var anio = $("cboAnio").value;
        //--------------------------------------------
        form = "";
        funcion = "cargarTablaProgramacionHorarios(1)";
        destino = "";
        parametros = "p1=agregarTurnoAdicional";
        parametros += "&p2=" + idProgramacionPersonal + "&p3=" + idEmpleado + "&p4=" + iIdSedeEmpresaAreaCentroCosto;
        parametros += "&p5=" + mes + "&p6=" + anio;
        enviarFormulario(form, parametros, funcion, destino);
    }
}

function cargarCboCategoria() {
    idSucursal = $("cboSucursal").value;
    form = "";
    destino = "div_cbo_area";
    funcion = "";
    parametros = "p1=cargarCboCategoria&p2=" + idSucursal;
    enviarFormulario(form, parametros, funcion, destino);
}

function cargarCboCategoria2() {
    var idSucursal = $("cboSucursal").value;
    var idArea = $("cboArea").value;
    if (idSucursal == "") {
        alert("Por favor seleccione una Sucursal");
        return;
    }
    if (idArea == "") {
        alert("Por favor seleccione un área");
        return;
    }
    destino = "div_cbo_categoria";
    parametros = "p1=cargarCboCategoria2&p2=" + idSucursal + "&p3=" + idArea;
    enviarFormulario("", parametros, "", destino);
}

function PresentarHorarioEmpleadoTrabjados() {
    cboSucursal = $("cboSucursal").value;
    cboCategoria = $("cboCategoria").value;
    cboTipoContrato = $("cboTipoContrato").value;
    cboTipoSueldo = $("cboTipoSueldo").value;
    txtFechaIni = $("txtFechaIni").value;
    txtFechaFin = $("txtFechaFin").value;
    iIdArea = $("cboArea").value;
    if (cboCategoria == "" || cboCategoria == "" || txtFechaIni == "" || txtFechaFin == "") {
        return;
    }
    //    alert(txtFechaIni+"--"+txtFechaFin+"--"+cboSucursal+"--"+cboCategoria+"--"+ cboTipoContrato );
    if (txtFechaIni != "" && txtFechaFin != "") {
        parametros = "p1=PresentarHorarioEmpleadoTrabjados&p2=" + cboCategoria
                + "&p3=" + txtFechaIni + "&p4=" + txtFechaFin + "&p5=" + cboTipoContrato + "&p6=" + cboSucursal + "&p7=" + cboTipoSueldo + "&p8=" + iIdArea;
        div = "div_tablaXempleados";
        funcionClick = "";
        funcionDblClick = "";
        funcionLoad = "";
        generarTablaz(div, parametros, funcionClick, funcionDblClick, funcionLoad);
        $("div_tablaXempleados_c").show();
    } else {
        alert("INGRESE LA FECHA ");
    }
}
function ExportarExcelHorasTrabajadas() {
    cboSucursal = $("cboSucursal").value;
    cboCategoria = $("cboCategoria").value;
    cboTipoContrato = $("cboTipoContrato").value;
    cboTipoSueldo = $("cboTipoSueldo").value;
    iIdArea = $("cboArea").value;
    if (cboTipoSueldo == "0") {
        cboTipoSueldo = 0;
    }

    txtFechaIni = $("txtFechaIni").value;
    txtFechaFin = $("txtFechaFin").value;
    descSucursal = $("cboSucursal").options[$("cboSucursal").selectedIndex].text;
    descContrato = $("cboTipoContrato").options[$("cboTipoContrato").selectedIndex].text;
    var datos = "p1=empleadosHorasTrabajadasExcel&p2=" + cboCategoria + "&p3=" + txtFechaIni;
    datos += "&p4=" + txtFechaFin + "&p5=" + cboTipoContrato + "&p6=" + cboSucursal + "&p7=" + cboTipoSueldo + "&p8=" + iIdArea;
    //-------------------------------
    datos += "&p9=" + descSucursal + "&p10=" + descContrato;
    //-------------------------------
    location.href = pathRequestControl + '?' + datos;
}

function exportarExcelHorarios() {
    mes = $("cboMes").value;
    anio = $("cboAnio").value;
    datos = $("cboArea").value;
    var idSubArea = $("cboSubArea").value;
    cboTipoContrato = $("cboTipoContrato").value;
    datos = datos.split("|");
    idSedeEmpresaArea = datos[0];
    idSEACC = datos[1];
    if (!$("hidIdProgramacionPersonal")) {
        return;
    }
    if (idSubArea == "") {
        alert("Por favor seleccione una Sub Area");
        return;
    }
    iIdProgramacionpersonal = $("hidIdProgramacionPersonal").value;
    descSucursal = $("cboSucursal").options[$("cboSucursal").selectedIndex].text;
    descArea = $("cboArea").options[$("cboArea").selectedIndex].text;
    if (idSedeEmpresaArea == "") {
        alert("Por favor seleccione un Area");
        return;
    }

    parametros = "p1=exportarExcelHorarios&p2=" + anio + "&p3=" + mes + "&p4=" + idSedeEmpresaArea;
    parametros += "&p5=" + iIdProgramacionpersonal + "&p6=" + descSucursal + "&p7=" + descArea + "&p8=" + idSEACC + "&p9=" + cboTipoContrato;
    parametros += "&p10=" + idSubArea;
    location.href = pathRequestControl + '?' + parametros;
}
function exportarExcelHorarioPersona() {
    mes = $("cboMes").value;
    anio = $("cboAnio").value;
    datos = $("cboArea").value;
    datos = datos.split("|");
    idSedeEmpresaArea = datos[0];
    iIdSedeEmpresaAreaCentroCosto = datos[1];
    if (!$("hidIdProgramacionPersonal")) {
        return;
    }
    iIdProgramacionpersonal = $("hidIdProgramacionPersonal").value;
    descSucursal = $("cboSucursal").options[$("cboSucursal").selectedIndex].text;
    descArea = $("cboArea").options[$("cboArea").selectedIndex].text;
    idEmpleado = $("hidIdEmpleado").value;
    nomEmpleado = $("txtNomEmpleado").value;
    cboTipoContrato = $("cboTipoContrato").value;
    if (idSedeEmpresaArea == "") {
        alert("Por favor seleccione un Area");
        return;
    }
    if (idEmpleado == "") {
        alert("Por favor seleccione un Empleado");
        return;
    }
    if (iIdSedeEmpresaAreaCentroCosto == "") {
        alert("ALERTA :: Esta Área no esta asignado aun Centro de Costo ...!. Comuniquese con RRHH o Informática");
        return;
    }

    div = "";
    parametros = "p1=exportarExcelHorarioPersona&p2=" + anio + "&p3=" + mes + "&p4=" + idSedeEmpresaArea;
    parametros += "&p5=" + iIdProgramacionpersonal + "&p6=" + idEmpleado + "&p7=" + descSucursal + "&p8=" + descArea;
    parametros += "&p9=" + iIdSedeEmpresaAreaCentroCosto + "&p10=" + nomEmpleado + "&p11=" + cboTipoContrato;
    location.href = pathRequestControl + '?' + parametros;
}



function BusquedaEmpleadoHorario(codEmpleado, codPer, vNombreCompleto, iIdModalidadContrato, cInd) {
    //        alert(vNombreCompleto+"  lobito");

    var c_cod_per = codPer;
    $("txthidCodigoPersona").value = c_cod_per;
    $("hiIdModalidadContrato").value = iIdModalidadContrato;
    $("hicInd").value = cInd;
    $("hicodEmpleado").value = codEmpleado;
    var idEmpleado = codEmpleado;
    var cboRegularizado = $("cboRegularizado").value;
    var txtFechaIni = $("txtFechaIni").value;
    var txtFechaFinal = $("txtFechaFinal").value;
    //window.alert(txtFechaFinal);
    //    var rs= validaFechaDentro30Dias(txtFechaFinal.trim(),txtFechaIni.trim());
    //    if(rs==1||rs==0){

    if (iIdModalidadContrato != 1) {
        var parametros = "p1=BusquedaEmpleado&p2=" + cboRegularizado
                + "&p3=" + txtFechaIni + "&p4=" + txtFechaFinal + "&p5=" + c_cod_per + "&p6=" + ''
                + "&p7=" + '' + "&p8=" + '' + "&p9=" + idEmpleado + "&p10=" + ''
                + "&p11=" + '';
        regularizacionEmpleadosRRHH = new dhtmlXGridObject('div_tablaXEmpleadosRegulados');
        regularizacionEmpleadosRRHH.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
        regularizacionEmpleadosRRHH.setSkin("dhx_skyblue");
        regularizacionEmpleadosRRHH.enableRowsHover(true, 'grid_hover');

        regularizacionEmpleadosRRHH.attachEvent("onRowSelect", function (fila, columna) {
            editarBusquedaEmpleado(fila, columna, c_cod_per)

        });
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador = contadorCargador;
        regularizacionEmpleadosRRHH.attachEvent("onXLS", function () {
            cargadorpeche(1, idCargador);
        });
        regularizacionEmpleadosRRHH.attachEvent("onXLE", function () {
            cargadorpeche(0, idCargador);

        });
        /////////////fin cargador ///////////////////////
        regularizacionEmpleadosRRHH.setSkin("dhx_skyblue");
        regularizacionEmpleadosRRHH.init();
        //    tablaBuscarPersona.loadXML(pathRequestControl+'?'+parametros);

        regularizacionEmpleadosRRHH.loadXML(pathRequestControl + '?' + parametros, function () {
            setColorTablaregularizacionEmpleadosRRHH();
            horaExtrasTrabajadas(txtFechaIni, txtFechaFinal, c_cod_per);
            //                CargarCkeck(); 

        });
        regularizacionEmpleadosRRHH.attachEvent("onEditCell", function (stage, rId, cInd, nValue, oValue) {

        });
    } else {
        if (iIdModalidadContrato == 1) {
            if (cInd == 8) {
                var parametros = "p1=BusquedaEmpleado&p2=" + cboRegularizado
                        + "&p3=" + txtFechaIni + "&p4=" + txtFechaFinal + "&p5=" + c_cod_per + "&p6=" + ''
                        + "&p7=" + '' + "&p8=" + '' + "&p9=" + idEmpleado + "&p10=" + ''
                        + "&p11=" + '';
                regularizacionEmpleadosRRHH = new dhtmlXGridObject('div_tablaXEmpleadosRegulados');
                regularizacionEmpleadosRRHH.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
                regularizacionEmpleadosRRHH.setSkin("dhx_skyblue");
                regularizacionEmpleadosRRHH.enableRowsHover(true, 'grid_hover');

                regularizacionEmpleadosRRHH.attachEvent("onRowSelect", function (fila, columna) {
                    editarBusquedaEmpleado(fila, columna, c_cod_per)

                });
                //////////para cargador peche////////////////
                contadorCargador++;
                var idCargador = contadorCargador;
                regularizacionEmpleadosRRHH.attachEvent("onXLS", function () {
                    cargadorpeche(1, idCargador);
                });
                regularizacionEmpleadosRRHH.attachEvent("onXLE", function () {
                    cargadorpeche(0, idCargador);

                });
                /////////////fin cargador ///////////////////////
                regularizacionEmpleadosRRHH.setSkin("dhx_skyblue");
                regularizacionEmpleadosRRHH.init();
                //    tablaBuscarPersona.loadXML(pathRequestControl+'?'+parametros);

                regularizacionEmpleadosRRHH.loadXML(pathRequestControl + '?' + parametros, function () {
                    setColorTablaregularizacionEmpleadosRRHH();
                    horaExtrasTrabajadas(txtFechaIni, txtFechaFinal, c_cod_per);
                    //                CargarCkeck(); 

                });
                regularizacionEmpleadosRRHH.attachEvent("onEditCell", function (stage, rId, cInd, nValue, oValue) {

                });
            }
        }

    }
}

function horaExtrasTrabajadas(txtFechaIni, txtFechaFinal, c_cod_per) {
    var size = regularizacionEmpleadosRRHH.getRowsNum();
    var diaI = txtFechaIni.substring(0, 2);
    var mesI = txtFechaIni.substring(3, 5);
    var annoI = txtFechaIni.substring(6, 10);
    var fechaI = new Date(annoI + '/' + mesI + '/' + diaI);

    var diaF = txtFechaFinal.substring(0, 2);
    var mesF = txtFechaFinal.substring(3, 5);
    var annoF = txtFechaFinal.substring(6, 10);
    var fechaF = new Date(annoF + '/' + mesF + '/' + diaF);
    var indocador;
    var i = 0;
    var k = 0;
    var arrayFecha = new Array();
    while (Date.parse(fechaI) <= Date.parse(fechaF)) {
        indocador = 0;
        for (var j = 0; j < size; j++) {
            var fechaTable = regularizacionEmpleadosRRHH.cells(j, 7).getValue();

            //            alert(fechaTable);
            var diaT = fechaTable.substring(0, 2);
            var mesT = fechaTable.substring(3, 5);
            var annoT = fechaTable.substring(6, 10);
            var fechaT = new Date(annoT + '/' + mesT + '/' + diaT);

            //            alert(Date.parse(fechaT) == Date.parse(fechaI));
            if (Date.parse(fechaT) == Date.parse(fechaI)) {
                indocador = 1;
                j = size;
            }
        }
        if (indocador == 0) {
            var yyyy = fechaI.getFullYear().toString();
            var mm = (fechaI.getMonth() + 1).toString();
            var dd = fechaI.getDate().toString();
            // CONVERT mm AND dd INTO chars
            var mmChars = mm.split('');
            var ddChars = dd.split('');
            var datestring = (ddChars[1] ? dd : "0" + ddChars[0]) + '/' + (mmChars[1] ? mm : "0" + mmChars[0]) + '/' + yyyy;
            //            alert('lobooo:   '+datestring);
            arrayFecha[k] = datestring;
            k = k + 1;
        }
        fechaI.setDate(fechaI.getDate() + 1);
        //        var dia= fechaI.getDate();
        i = i + 1;
    }

    var x = arrayFecha.length
    var cadenaStrin;
    for (var m = 0; m < x; m++) {
        //        alert('lobo array: '+arrayFecha[m]);
        if (m == 0) {
            cadenaStrin = arrayFecha[m];
        } else {
            cadenaStrin = cadenaStrin + '*' + arrayFecha[m];
        }
    }
    /*Cargar la tabla de PHP*/
    var parametros = "p1=horaExtrasTrabajadas&p2=" + cadenaStrin + "&p3=" + c_cod_per;
    tablahoraExtrasTrabajadas = new dhtmlXGridObject('div_tablahoraExtrasTrabajadas');
    tablahoraExtrasTrabajadas.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablahoraExtrasTrabajadas.setSkin("dhx_skyblue");
    tablahoraExtrasTrabajadas.enableRowsHover(true, 'grid_hover');

    tablahoraExtrasTrabajadas.attachEvent("onRowSelect", function (fila, columna) {
        abrirPopapAsignacionDeTurnosAsignados(fila, columna);
    });
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablahoraExtrasTrabajadas.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    tablahoraExtrasTrabajadas.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);

    });
    /////////////fin cargador ///////////////////////
    tablahoraExtrasTrabajadas.setSkin("dhx_skyblue");
    tablahoraExtrasTrabajadas.init();
    //    tablaBuscarPersona.loadXML(pathRequestControl+'?'+parametros);

    tablahoraExtrasTrabajadas.loadXML(pathRequestControl + '?' + parametros, function () {
        //        setColorTablaregularizacionEmpleadosRRHH();
        //        horaExtrasTrabajadas(txtFechaIni,txtFechaFinal);
        //                CargarCkeck(); 

    });
    tablahoraExtrasTrabajadas.attachEvent("onEditCell", function (stage, rId, cInd, nValue, oValue) {
    });
}

function  setColorTablaregularizacionEmpleadosRRHH() {
    //    regularizacionEmpleadosRRHH
    var size = regularizacionEmpleadosRRHH.getRowsNum() - 1;
    var TotalentradaTarde = 0;
    var TotalsalidaTarde = 0;
    var TotalhorasFaltas = 0;
    var TotalhorasTrabajadas = 0;
    for (var i = 0; i < regularizacionEmpleadosRRHH.getRowsNum(); i++) {
        //        var entradaTarde= parseInt(tablaBuscarPersona.cells(i,12).getValue());
        //        var salidaTarde= parseInt(tablaBuscarPersona.cells(i,13).getValue());
        //        var horasFaltas= parseInt(tablaBuscarPersona.cells(i,14).getValue());
        //        var horasTrabajadas= parseInt(tablaBuscarPersona.cells(i,15).getValue());
        if (i != size) {
            TotalentradaTarde = TotalentradaTarde + parseInt(regularizacionEmpleadosRRHH.cells(i, 12).getValue());
            TotalsalidaTarde = TotalsalidaTarde + parseInt(regularizacionEmpleadosRRHH.cells(i, 13).getValue());
            TotalhorasFaltas = TotalhorasFaltas + parseInt(regularizacionEmpleadosRRHH.cells(i, 14).getValue());
            TotalhorasTrabajadas = TotalhorasTrabajadas + parseInt(regularizacionEmpleadosRRHH.cells(i, 15).getValue());
        }
        var estado = regularizacionEmpleadosRRHH.cells(i, 17).getValue();
        var estadoEAI = regularizacionEmpleadosRRHH.cells(i, 20).getValue();

        if (estado == 0)
            regularizacionEmpleadosRRHH.setRowTextStyle(regularizacionEmpleadosRRHH.getRowId(i), 'background-color:#FF6969;color:black;border-top: 1px solid #FF6969');
        //         mygridx.setRowTextStyle(mygridx.getRowId(i)                                          ,'background-color:#8db1ff;color:black;border-top: 1px solid #FFD7BB;');
        else if (estado == 1)
            regularizacionEmpleadosRRHH.setRowTextStyle(regularizacionEmpleadosRRHH.getRowId(i), 'background-color:#D6E9FE;color:black;border-top: 1px solid #D6E9FE');
        if (estadoEAI == 2) {
            regularizacionEmpleadosRRHH.setRowTextStyle(regularizacionEmpleadosRRHH.getRowId(i), 'background-color:#FF7145;color:black;border-top: 1px solid #FF7145');

        } else {
            if (estadoEAI == 3) {
                regularizacionEmpleadosRRHH.setRowTextStyle(regularizacionEmpleadosRRHH.getRowId(i), 'background-color:#DBED17;color:black;border-top: 1px solid #DBED17');

            }
        }

        if (i == size) {
            regularizacionEmpleadosRRHH.setRowTextStyle(regularizacionEmpleadosRRHH.getRowId(i), 'background-color:#FFBF00;color:black;border-top: 1px solid #FFBF00');
            regularizacionEmpleadosRRHH.cells(i, 11).setValue('TOTAL');
            regularizacionEmpleadosRRHH.cells(i, 12).setValue(TotalentradaTarde);
            regularizacionEmpleadosRRHH.cells(i, 13).setValue(TotalsalidaTarde);
            regularizacionEmpleadosRRHH.cells(i, 14).setValue(TotalhorasFaltas);
            regularizacionEmpleadosRRHH.cells(i, 15).setValue(TotalhorasTrabajadas);
        }
    }
}
function buscarEmpleadosAreasNombre() {
    var c_cod_per = document.getElementById('txtCodigo').value;
    var comboTipoEstados = document.getElementById('comboTipoEstados').value;
    var comboTipoDocumentos = document.getElementById('comboTipoDocumentos').value;
    var nroDoc = document.getElementById('nroDoc').value;
    var apellidoPaterno = document.getElementById('apellidoPaterno').value;
    var apellidoMaterno = document.getElementById('apellidoMaterno').value;
    var nombres = document.getElementById('nombres').value;


    var parametros = "p1=buscarEmpleadosAreasNombre&p2=" + comboTipoEstados
            + "&p3=" + c_cod_per + "&p4=" + apellidoPaterno
            + "&p5=" + apellidoMaterno + "&p6=" + nombres + "&p7=" + comboTipoDocumentos
            + "&p8=" + nroDoc;
    //alert("id:"+id+"*** nombre:"+nombre)
    tablaEmpleadosArea = new dhtmlXGridObject('divTablaResultadosEmpleados');
    tablaEmpleadosArea.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaEmpleadosArea.setSkin("dhx_skyblue");
    tablaEmpleadosArea.enableRowsHover(true, 'grid_hover');


    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaEmpleadosArea.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    tablaEmpleadosArea.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        ;
    });
    /////////////fin cargador ///////////////////////


    tablaEmpleadosArea.attachEvent("onRowDblClicked", function (rId, cInd) {
        // var c_cod_per=tablaEmpleadosArea.cells(rId, 1).getValue();
        registroDatosPersonalDetalle(rId, cInd, 'tablaEmpleadosArea');

    });
    tablaEmpleadosArea.init();
    tablaEmpleadosArea.loadXML(pathRequestControl + '?' + parametros);
}
function BusquedaEmpleado() {//2
    //idEmpleado y txthidCodigoPersona
    //        alert(1123456);
    var c_cod_per = document.getElementById('txtCodigo').value;
    var comboTipoEstados = document.getElementById('comboTipoEstados').value;
    var comboTipoDocumentos = document.getElementById('comboTipoDocumentos').value;
    var nroDoc = document.getElementById('nroDoc').value;
    var apellidoPaterno = document.getElementById('apellidoPaterno').value;
    var apellidoMaterno = document.getElementById('apellidoMaterno').value;
    var nombres = document.getElementById('nombres').value;


    var cboRegularizado = $("cboRegularizado").value;
    var txtFechaIni = $("txtFechaIni").value;
    var txtFechaFinal = $("txtFechaFinal").value;
    //    window.alert(apellidoPaterno);
    if (cboRegularizado.trim() != '-1') {
        var rs = validaFechaDentro30Dias(txtFechaFinal.trim(), txtFechaIni.trim());
        if (rs == 1 || rs == 0) {
            var parametros = "p1=BusquedaEmpleado&p2=" + cboRegularizado
                    + "&p3=" + txtFechaIni + "&p4=" + txtFechaFinal + "&p5=" + c_cod_per + "&p6=" + apellidoPaterno
                    + "&p7=" + apellidoMaterno + "&p8=" + nombres + "&p9=" + '' + "&p10=" + comboTipoDocumentos
                    + "&p11=" + nroDoc;
            var div = "div_tablaXEmpleadosRegulados";
            var funcionClick = "editarBusquedaEmpleado";
            var funcionDblClick = "";
            var funcionLoad = "";
            generarTablaz(div, parametros, funcionClick, funcionDblClick, funcionLoad);
        }
    } else {
        alert('Seleccione un estado!!!')
    }
}


function uploadFotoEmpleado(idPersona, param2) {

    if (idPersona == "") {
        alert("Para adjuntar la foto, la persona debe estar registrado.");
        return;
    }
    var div = 'divAdjuntarFoto';
    var titulo = "Adjuntar Fotografía";
    var patronModulo = "p1=uploadFotoEmpleado&p2=" + idPersona + "&p3=" + param2;
    var nombreFile = idPersona;
    var opcion = "imagen";
    var arrayTipoFile = ["png", "jpg", "gif", "jpeg"];
    var rutaFile = "../../../../carpetaDocumentos";
    uploadFileHMLO(div, titulo, patronModulo, nombreFile, opcion, arrayTipoFile, rutaFile);
}





function abrirNuevoRegistroEmpleado() {
    window.open("../../cvista/inicio/inicio.php");
}



function editarBusquedaEmpleado(fil, col, c_cod_per) {//3
    var vNombreCompleto = regularizacionEmpleadosRRHH.cells(fil, 6).getValue();
    var iIdCodigoempleado = regularizacionEmpleadosRRHH.cells(fil, 1).getValue();
    var vSede = regularizacionEmpleadosRRHH.cells(fil, 2).getValue();
    var vArea = regularizacionEmpleadosRRHH.cells(fil, 3).getValue();
    var dFecha = regularizacionEmpleadosRRHH.cells(fil, 7).getValue()
    var vTurnos = regularizacionEmpleadosRRHH.cells(fil, 8).getValue() + '  --  ' + regularizacionEmpleadosRRHH.cells(fil, 9).getValue();
    var idProgramacionEmpleados = regularizacionEmpleadosRRHH.cells(fil, 0).getValue();
    var iIdTurnosAreaSede = regularizacionEmpleadosRRHH.cells(fil, 24).getValue();
    var fHoraInicio = regularizacionEmpleadosRRHH.cells(fil, 21).getValue();
    var fHoraFin = regularizacionEmpleadosRRHH.cells(fil, 22).getValue();
    var iIdSedeEmpresaArea = regularizacionEmpleadosRRHH.cells(fil, 25).getValue();
    var iIdTipoProgramacion = regularizacionEmpleadosRRHH.cells(fil, 26).getValue();
    //            alert(iIdTipoProgramacion);

    if (col == 18) { //7 

        posFuncion = "";
        //        posFuncion = "disableText";
        vtitle = "";
        vformname = 'EtiquetaAtributo';
        vwidth = '800';
        vheight = '425';
        patronModulo = 'ModificarRegularizacion';
        vcenter = 't';
        vresizable = ''
        vmodal = 'false';
        vstyle = '';
        vopacity = '';
        veffect = '';
        vposx1 = '';
        vposx2 = '';
        vposy1 = '';
        vposy2 = '';
        parametros = '';
        parametros += 'p1=' + patronModulo + '&p2=' + iIdCodigoempleado + '&p3=' + vNombreCompleto + '&p4=' + vSede + '&p5=' + vArea
                + '&p6=' + dFecha + '&p7=' + vTurnos + '&p8=' + idProgramacionEmpleados;
        CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
    }

    if (col == 23) {
        posFuncion = "CargarTabladePersonaReemplazo(" + iIdCodigoempleado + ',' + iIdTurnosAreaSede + ',' + fHoraInicio + ',' + fHoraFin + ")";
        //        posFuncion = "disableText";
        vtitle = "";
        vformname = 'EtiquetaAtributo';
        vwidth = '800';
        vheight = '425';
        patronModulo = 'RegularizacionAsistenciaPorCambioPersonal';
        vcenter = 't';
        vresizable = ''
        vmodal = 'false';
        vstyle = '';
        vopacity = '';
        veffect = '';
        vposx1 = '';
        vposx2 = '';
        vposy1 = '';
        vposy2 = '';
        parametros = '';
        parametros += 'p1=' + patronModulo + '&p2=' + iIdCodigoempleado + '&p3=' + vNombreCompleto + '&p4=' + vSede + '&p5=' + vArea
                + '&p6=' + dFecha + '&p7=' + vTurnos + '&p8=' + idProgramacionEmpleados + '&p9=' + iIdTurnosAreaSede + '&p10=' + iIdSedeEmpresaArea + '&p11=' + iIdTipoProgramacion + '&p12=' + c_cod_per;
        CargarVentanaPopPapJorge(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
    }
    if (col == 19) {
        alert("Eliminarlobito");
    }
}
function CargarTabladePersonaReemplazo(iIdCodigoempleado, iIdTurnosAreaSede, fHoraInicio, fHoraFin) {
    var dFechaProgramada = $("hFechaProgramada").value;
    var iIdTipoProgramacion = $("hiIdTipoProgramacion").value;
    var iIdSedeEmpresaArea = $("hiIdSedeEmpresaArea").value;
    //    alert(fHoraFin);
    var parametros = "p1=CargarTabladePersonaReemplazo&p2=" + iIdTurnosAreaSede
            + "&p3=" + iIdCodigoempleado + "&p4=" + fHoraInicio + "&p5=" + fHoraFin + "&p6=" + dFechaProgramada;
    //alert("id:"+id+"*** nombre:"+nombre)
    tabladePersonaReemplazo = new dhtmlXGridObject('div_tablaXEmpleadosReemplazo');
    tabladePersonaReemplazo.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tabladePersonaReemplazo.setSkin("dhx_skyblue");
    tabladePersonaReemplazo.enableRowsHover(true, 'grid_hover');

    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tabladePersonaReemplazo.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    tabladePersonaReemplazo.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        ;
    });
    /////////////fin cargador ///////////////////////
    tabladePersonaReemplazo.attachEvent("onRowSelect", function (fila, columna) {
        var iidPuestoEmpleado = tabladePersonaReemplazo.cells(fila, 4).getValue();
        guardarEmpleadoReemplazador(dFechaProgramada, iIdTurnosAreaSede, iIdSedeEmpresaArea, iidPuestoEmpleado, iIdTipoProgramacion);
    });
    tabladePersonaReemplazo.init();
    tabladePersonaReemplazo.loadXML(pathRequestControl + '?' + parametros);

}

function guardarEmpleadoReemplazador(dFechaProgramada, iIdTurnosAreaSede, iIdSedeEmpresaArea, iidPuestoEmpleado, iIdTipoProgramacion) {

    var parametros = "p1=guardarEmpleadoReemplazador&p2=" + iIdTurnosAreaSede
            + "&p3=" + dFechaProgramada + "&p4=" + iIdSedeEmpresaArea + "&p5=" + iidPuestoEmpleado + "&p6=" + iIdTipoProgramacion;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            //            $('divDetallePuntoControl').update(respuesta);
            //            $('btn_guardarPuntoControl').hide();
            //            $('btn_agregarPuntoControl').show();
            //            $('btn_habilitarFormularioPuntoControl').show();
            //            $('btn_cancelarPuntoControl').hide();
            //            cargarTablaUsuariosHabilitadosXPuntoControl();
            //            $('divAsignacionUsuariosXPuntosControl').show();
        }
    }
    )
}
function horaJavaScript(idTxt, idtxtHideen, elemento, evento) {
    var horaEntradahidden = $(idtxtHideen).value;
    var horaEntrada = $(idTxt).value;

    if (evento.keyCode > 64 && evento.keyCode < 91) {
        $(idTxt).value = $(idtxtHideen).value;
    } else {
        if (evento.keyCode == 37 || evento.keyCode == 39) {
            if (horaEntrada.length > 0) {
                var arrayRespuestaheddin = horaEntradahidden.split(":");
                var hh = arrayRespuestaheddin[0];
                var mm = arrayRespuestaheddin[1];
                var ss = arrayRespuestaheddin[2];

                var arrayRespuesta = horaEntrada.split(":");
                var h = parseInt(arrayRespuesta[0], 10);
                var m = parseInt(arrayRespuesta[1], 10);
                var s = parseInt(arrayRespuesta[2], 10);
                if (h <= 9) {
                    h = "0" + h;
                } else {
                    if (h < 25) {
                        h = h;
                    } else {
                        h = hh;
                    }
                }
                if (m <= 9) {
                    m = "0" + m;
                } else {
                    if (m < 61) {
                        m = m;
                    } else {
                        m = mm;
                    }
                }
                if (s <= 9) {
                    s = "0" + s;
                } else {
                    if (s < 61) {
                        s = s;
                    } else {
                        s = ss;
                    }
                }
                $(idTxt).value = h + ':' + m + ':' + s
            } else {
                $(idTxt).value = '00:00:00'
                $(idtxtHideen).value = '00:00:00'
            }
        }
    }
//    if(horaEntrada.length>8){
//        $(idTxt).value=$(idtxtHideen).value;
//    }

}

function horaJavaScriptclick(idTxt, idtxtHideen, elemento, evento) {
    //    alert(9);
    var horaEntrada = $(idTxt).value;

    if (evento.keyCode > 64 && evento.keyCode < 91) {
        $(idTxt).value = $(idtxtHideen).value;
    } else {
        if (horaEntrada.length > 0) {
        } else {
            $(idTxt).value = '00:00:00';
            $(idtxtHideen).value = '00:00:00';
        }
    }
}

function CheckTime(str)
{
    var hora = str.value
    //            alert(hora);
    if (hora == '') {
        $(str).value = '00:00:00';
        return
    }

    if (hora.length > 8) {
        alert("Introdujo una cadena mayor a 8 caracteres");
        return
    }
    if (hora.length != 8) {
        alert("Introducir HH:MM:SS");
        return
    }
    a = hora.charAt(0) //<=2
    b = hora.charAt(1) //<4
    c = hora.charAt(2) //:
    d = hora.charAt(3) //<=5
    e = hora.charAt(5) //:
    f = hora.charAt(6) //<=5
    if ((a == 2 && b > 3) || (a > 2)) {
        alert("El valor que introdujo en la Hora no corresponde, introduzca un digito entre 00 y 23");
        return
    }
    if (d > 5) {
        alert("El valor que introdujo en los minutos no corresponde, introduzca un digito entre 00 y 59");
        return
    }
    if (f > 5) {
        alert("El valor que introdujo en los segundos no corresponde");
        return
    }
    if (c != ':' || e != ':') {
        alert("Introduzca el caracter ':' para separar la hora, los minutos y los segundos");
        return
    }
}
function CargarDatosEmpleados() {

    NombreCompletoEmpleado = $("txthidNombreCompletoPersona").value
    horaEntrada = $("txthidHoraIni").value;
    horaSalida = $("txthidHoraFinal").value;
    c_cod_per = $("txthidCodigoPersonaX").value;
    txthidCodnsdHorarioRealesAsistencia = $("txthidHorarioAsistencia").value;
    //  window.alert(NombreCompletoEmpleado+'  '+ 'heeeeeeeeeeeee');
    $("txtDatosEmpleados").value = NombreCompletoEmpleado;
    $("txtdisabHoraEntrada").value = horaEntrada;
    $("txtdisabHoraSalida").value = horaSalida;
    //    $("txtHoraEntrada").value=horaEntrada;
    //    $("txtHoraSalida").value=horaSalida;

    $("txtHoraEntrada").value = getHora(horaEntrada);
    $("txtHoraSalida").value = getHora(horaSalida);
    document.getElementById('idDescripcionTurno').innerHTML = '<h2 style="color:blue;font-size: larger;font-weight: bold; text-align: center">Fecha Turno:' + $("txthidFecha").value + ' Turno:' + $('txthidTurno').value + '</h2>'
    $("txthidCodigoPersonaEmpleada").value = c_cod_per;
    $("txthidCodnsdHorarioRealesAsistencia").value = txthidCodnsdHorarioRealesAsistencia;
    tablaMarcacionEmpleadosAudiotira($("txthidFecha").value, $("txthidCodigoPersonaX").value, $('txthidCodigoEmpleadoX').value, $("txthidCodnsdHorarioRealesAsistencia").value);
//alert('Total Segundos Hora Entrada'+getSegundos($("txtHoraEntrada").value));
}
//JCDB 11/04/2012 12Pm
function CargarDatosEmpleadosX() {
    var NombreCompletoEmpleado = $("txthidNombreCompletoPersona").value;
    var codEmp = $("txthidCodigoEmpleadoX").value;
    var fecha = $("txthidFecha").value;
    var idProgramacionEmpleados = $("txthidProgramacionEmpleados").value;
    $("txtFecha").value = fecha;
    $("htxtidCodigoEmpleado").value = codEmp;
    $('txtNombreEmpleados').value = NombreCompletoEmpleado;
    $("htxtidProgramacionEmpleado").value = idProgramacionEmpleados;
    $('txtTurno').value = $('txthidTurno').value;
    document.getElementById('btnGuardarEmpleadoRegularizar').style.visibility = "visible";
    tablaMarcacionEmpleadosAudiotira($("txthidFecha").value, $("txthidCodigoPersonaX").value, $('txthidCodigoEmpleadoX').value, idProgramacionEmpleados);
}
//JCDB 18/04/2012 12Pm
function tablaMarcacionEmpleadosAudiotira(fecha, codPer, codEmp, idHorarioAsistencia) {
    var patronModulo = "tablaMarcacionEmpleadosAudiotira";
    var parametros;
    parametros = 'p1=' + patronModulo;
    parametros += '&fecha=' + fecha;
    parametros += '&codPer=' + codPer;
    parametros += '&codEmp=' + codEmp;
    parametros += '&idHorarioAsistencia=' + idHorarioAsistencia;
    var tablaMarcacionEmpleadosAudiotira = new dhtmlXGridObject('divReporteMarcacionEmpleadoAuditoria');
    tablaMarcacionEmpleadosAudiotira.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaMarcacionEmpleadosAudiotira.setSkin("dhx_skyblue");
    tablaMarcacionEmpleadosAudiotira.enableRowsHover(true, 'grid_hover');
    tablaMarcacionEmpleadosAudiotira.init();
    tablaMarcacionEmpleadosAudiotira.loadXML(pathRequestControl + '?' + parametros, function () {
        setColorTabla(3, tablaMarcacionEmpleadosAudiotira, '#1BE0F6', '#FF4B4B', 1, 0);
    });
}
//'#1BE0F6','#ff2267'
//JCDB 18/04/2012 12:20Pm
function setColorTabla(vCol, vGrid, color1, color2, e1, e2) {
    for (var i = 0; i < vGrid.getRowsNum(); i++) {
        var estado = vGrid.cells(i, vCol).getValue();
        if (estado == e1)
            vGrid.setRowTextStyle(vGrid.getRowId(i), 'background-color:' + color1 + ';color:black;border-top: 1px solid white');
        else if (estado == e2)
            vGrid.setRowTextStyle(vGrid.getRowId(i), 'background-color:' + color2 + ';color:black;border-top: 1px solid white');
    }
}

function ReportePersonaRegularizar(hmtl, event, codigopersona) {//1

    $("txthidCodigoPersona").value = codigopersona;
    //window.alert(codigopersona);
    parametros = "p1=BusquedaPersonaRegularizar&p2=" + codigopersona;
    form = "";
    funcion = "";
    destino = "div_NombreCompleto";
    enviarFormulario(form, parametros, funcion, destino);
}
function ActualizarTablansdHorarioRealesAsistencia() {

    var horaEntrada = $("txtHoraEntrada").value;
    var horaSalida = $("txtHoraSalida").value;
    var codigopersona = $("txthidCodigoPersonaEmpleada").value;
    var txthidCodnsdHorarioRealesAsistencia = $("txthidCodnsdHorarioRealesAsistencia").value;
    //window.alert(codigopersona);
    //    if(horaEntrada!='' ){
    //        if( horaSalida !=''){

    if (alertFechaHora() == 1) {
        parametros = "p1=ActualizarTablansdHorarioRealesAsistencia&p2=" + codigopersona +
                "&p3=" + horaEntrada + "&p4=" + horaSalida + "&p5=" + txthidCodnsdHorarioRealesAsistencia;
        form = "";
        funcion = "BusquedaEmpleado";
        destino = "";
        enviarFormulario(form, parametros, funcion, destino);
        Windows.close("Div_EtiquetaAtributo", '');
    }





//        }else{
//            alert("INGRESE LA HORA DE SALIDA")
//        }
//    }else
//    {
//        alert("INGRESE LA HORA DE ENTREDA")
//    }
}
function LimpiaTablansdHorarioRealesAsistenciaRefrescar() {
    $("txthidCodigoPersona").value = '';
    $('txthidCodigoEmpleado').value = '';
    //$("txthidCodigoPersonaX").value='';
    //    $("txtFechaIni").value='';
    //    $("txtFechaFinal").value='';
    //$("cboRegularizado").value=0;
    $("div_NombreCompleto").update("");
//cargaFechas();
}
/*=================================================================================================*/
/*====================================EMPLEADO SUB AREAS (LUIS)====================================*/
//function cargarTablaSubAreas(codigosede,codigoarea){
//
//    patronModulo='mostrarTablaSubAreas';
//    parametros='';
//    parametros+='p1='+patronModulo;
//    parametros+='&p2='+codigosede;
//    parametros+='&p3='+codigoarea;
//    tablaSubAreas = new dhtmlXGridObject('Div_TablaSubAreas');
//    tablaSubAreas.setImagePath("../../../../fastmedical_front/imagen/icono/");
//    tablaSubAreas.setSkin("dhx_skyblue");
//    tablaSubAreas.attachEvent("onRowSelect", function(rowId,cellInd){
//        $('hCodigoSubArea').value = rowId;
//    });
//    tablaSubAreas.init();
//    tablaSubAreas.loadXML(pathRequestControl+'?'+parametros);
//}

function asignarPuestoSedeArea() {
    datos = $("cboSedeEmpresaArea").value;
    idPuesto = $("hIdPuesto").value;
    datos = datos.split("|");
    idSedeEmpresaArea = datos[0];
    if (idPuesto == "") {
        alert("Por favor seleccione un PUESTO de la parte superior");
        return;
    }
    if (idSedeEmpresaArea == "") {
        alert("Por favor seleccione un Área");
        return;
    }
    if (confirm('¿Estás seguro de que quieres Asignar el Puesto seleccionado con el Area?')) {
        var form = "", funcion = "mostrarPuestoArea", destino = "divResultado";
        var parametros = "p1=asignarPuestoSedeArea&p2=" + idSedeEmpresaArea + "&p3=" + idPuesto;
        enviarFormulario(form, parametros, funcion, destino);
    }
}
function mostrarPuestoArea() {
    idPuesto = $("hIdPuesto").value;
    $("divPuestoSedeArea").show();
    var parametros = "p1=mostrarPuestoArea&p2=" + idPuesto;
    var div = "divPuestoSedeArea", funcionLoad = "", funcionDblClick = "", funcionClick = "eliminacionFisicaPuestoArea";
    generarTablax(div, parametros, funcionClick, funcionDblClick, funcionLoad)
}

function eliminacionFisicaPuestoArea(fil, col) {
    if (col == "6") {
        if (confirm("Esta seguro de eliminar.")) {
            var iidPuestoSedeEmpresa = mygridx.cells(fil, 0).getValue();
            var parametros = "p1=eliminacionFisicaPuestoArea&p2=" + iidPuestoSedeEmpresa;
            enviarFormularioSincronizado("", parametros, "", "");
            mostrarPuestoArea();
        }
    }
}

//function cargarTablaEmpleadosArea(codigosede,codigoarea){
//
//    patronModulo='mostrarTablaEmpleadosAreas';
//    parametros='';
//    parametros+='p1='+patronModulo;
//    parametros+='&p2='+codigosede;
//    parametros+='&p3='+codigoarea;
//
//    tablaEmpleadosAreas = new dhtmlXGridObject('Div_TablaEmpleadosArea');
//    tablaEmpleadosAreas.setImagePath("../../../../fastmedical_front/imagen/icono/");
//    tablaEmpleadosAreas.setSkin("dhx_skyblue");
//    tablaEmpleadosAreas.attachEvent("onRowSelect", function(rowId,cellInd){
//        $('hCodigoEmpleado').value = rowId;
//    });
//    tablaEmpleadosAreas.init();
//    tablaEmpleadosAreas.loadXML(pathRequestControl+'?'+parametros);
//}


function cargarTablaEmpleadosSubArea(codigosede, codigoarea) {

    patronModulo = 'mostrarTablaEmpleadosSubArea';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigosede;
    parametros += '&p3=' + codigoarea;

    tablaEmpleadosAreas = new dhtmlXGridObject('Div_TablaEmpleadosSubArea');
    tablaEmpleadosAreas.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaEmpleadosAreas.setSkin("dhx_skyblue");
    tablaEmpleadosAreas.attachEvent("onRowSelect", function (rowId, cellInd) {
        $('$hCodigoEmpleadoSubArea').value = tablaEmpleadosAreas.cells(rowId, 0).getValue();
        if (cellInd == 4)
            eliminarEmpleadoSubArea(tablaEmpleadosAreas.cells(rowId, 0).getValue());
    });
    tablaEmpleadosAreas.init();
    tablaEmpleadosAreas.loadXML(pathRequestControl + '?' + parametros);
}

function eliminarEmpleadoSubArea(codigoEmpleadoSubArea) {
    patronModulo = 'eliminarEmpleadoSubArea';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoEmpleadoSubArea;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            cargarTablaEmpleadosSubArea($('cboSede').value, $('cboArea').value);
        }
    })


}

function agregarSubAreas() {

    vformname = 'winAgregarSubAreas';
    vtitle = 'Agregar Nuevas Sub Areas';
    vwidth = '900';
    vheight = '450';
    patronModulo = 'agregarSubAreas';
    vcenter = 't';
    vresizable = ''
    vmodal = 'false';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    posFuncion = "cargarTablasSubareas";
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
}
function cargarTablaSubareasxx() {
    $("btnGrabar").show();
    $("btnModificar").hide();
    datos = $("cboAreax").value;
    datos = datos.split("|");
    idArea = datos[1];
    idSede = $("cboSucursalx").value;
    var parametrosx = "p1=mostrarTablaSubAreas&p2=" + idSede + "&p3=" + idArea;
    var divx = "listaSubAreas", funcionClickx = "editarSubAreas", funcionDblClickx = "", funcionLoadx = "";
    generarTablax(divx, parametrosx, funcionClickx, funcionDblClickx, funcionLoadx);
}
function cargarTablaCategoriasSubAreas() {
    idSubArea = $("cboSubArea").value;
    var parametrosy = "p1=mntTablaCategoriaArea&p2=" + idSubArea;
    var divy = "listaCategoriaArea", funcionClicky = "cambiarEstadoCategoriasSubArea", funcionDblClicky = "", funcionLoady = "";
    generarTablay(divy, parametrosy, funcionClicky, funcionDblClicky, funcionLoady);
}

//2012/02/17 esta funcion ahora esta en mantenimientoArea.js
//function grabarSubArea(opt){
//    datos=$("cboAreax").value;
//    datos=datos.split("|");
//    if(datos[1]==""){
//        alert("Por favor seleccione Un área.");
//        return;
//    }
//    var form="fromSubAreas",parametros="p1=grabarSubArea&p2="+opt,funcion="cargarTablaSubareasxx",destino="";
//    enviarFormulario(form,parametros,funcion,destino);
//}


function editarSubAreas(fil, col) {
    iIdSubAreas = mygridx.cells(fil, 0).getValue();
    vNombreSubArea = mygridx.cells(fil, 2).getValue();
    vDescripcionSubArea = mygridx.cells(fil, 3).getValue();
    bestado = mygridx.cells(fil, 3).getValue();
    $("hidIdSubArea").value = iIdSubAreas;
    $("txtNombre").value = vNombreSubArea;
    $("txtDescripcion").value = vDescripcionSubArea;
    $("cboEstadox").value = bestado;
    $("btnGrabar").hide();
    $("btnModificar").show();
}
function grabarCategoriaSubArea() {
    if ($("cboSubArea").value == "") {
        alert("Por favor seleccione una sub-area.");
        return;
    }
    if ($("cboCategoriaPuesto").value == "") {
        alert("Por favor seleccione una cxategoría puesto.");
        return;
    }
    var form = "fromCategoriaSubArea", parametros = "p1=grabarCategoriaSubArea", funcion = "cargarTablaCategoriasSubAreas", destino = "";
    enviarFormulario(form, parametros, funcion, destino);
}
function cambiarEstadoCategoriasSubArea(fil, col) {
    if (col == 5) {
        idCategoriaSubArea = mygridy.cells(fil, 0).getValue();
        var funcion = "cargarTablaCategoriasSubAreas";
        var parametros = "p1=cambiarEstadoCategoriasSubArea&p2=" + idCategoriaSubArea;
        enviarFormulario("", parametros, funcion, "");
    }
}

function mostrarContenidoEmpleadoSubAreas() {
    codigosede = $('cboSede').value;
    codigoarea = $('cboArea').value;
    cargarTablaSubAreas(codigosede, codigoarea);
    cargarTablaEmpleadosArea(codigosede, codigoarea);
    cargarTablaEmpleadosSubArea(codigosede, codigoarea);
}
function asignarEmpleadoaSubArea() {
    if ($('hCodigoSubArea').value == '') {
        window.alert('Seleccione una SubArea por favor!');
        return;
    }
    if ($('hCodigoEmpleado').value == '') {
        window.alert('Seleccione un Empleado por favor!');
        return;
    }
    codigoSubArea = $('hCodigoSubArea').value;
    codigoEmpleado = $('hCodigoEmpleado').value;

    patronModulo = 'asignacionEmpleadoaSubArea';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoSubArea;
    parametros += '&p3=' + codigoEmpleado;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            cargarTablaEmpleadosSubArea($('cboSede').value, $('cboArea').value);
        }
    })


}


/*=================================================================================================*/

/*+---------------------------------------------------------------------------------------------------+*/
/*|--------------------------     Modificacion del modulo de horarios     ----------------------------|*/
/*+---------------------------------------------------------------------------------------------------+*/


function generarFormatoUnificado() {
    if (document.getElementById("div_eventosProgAsist")) {
        var datos = $("div_eventosProgAsist").innerHTML;
        if (datos != "") {
            mes = $("cboMes").value;
            anio = $("cboAnio").value;
            descMes = $("cboMes").options[$("cboMes").selectedIndex].text;
            desArea = $("descArea").value;
            parametros = "p1=generarFormatoUnificado&p2=" + mes + "&p3=" + anio;
            parametros += "&p4=" + descMes + "&p5=" + datos + "&p6=" + desArea;
            location.href = pathRequestControl + '?' + parametros;
        }
    }
}




function masTurnosProgramar() {
    vformname = 'configurarHorarios';
    vtitle = 'Configurar nuevo horario';
    vwidth = '610';
    vheight = '330';
    patronModulo = 'configurarTurnosProgramar';
    vcenter = 't';
    vresizable = ''
    vmodal = 'false';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    posFuncion = "listaTurnos";//listaLeyendaTurno
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
}

function listaTurnos() {
    parametros = "p1=listaTurnos";
    div = "divTurnoMaestros";
    funcionClick = "asignarCodigoATurno";
    funcionDblClick = "";
    funcionLoad = "";
    generarTablap(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}

function asignarCodigoATurno(fil, col) {
    $("hidIdTurno").value = mygridp.cells(fil, 0).getValue();
    $("txtIdTurnoProgramar").value = "";
    $("overlayCodigoATurno").show();
    $("agregarCodigoATurno").show();
    $("div_respuesta").update("");

}

function grabarTurnoProgramar() {
    idTurno = $("hidIdTurno").value;
    idTurnoProgramar = $("txtIdTurnoProgramar").value;
    if (idTurnoProgramar == "")
    {
        alert("Por favor registre un código !");
        return;
    }
    if (idTurno == "") {
        alert("Por favor registre un turno !");
        return;
    }
    var form = "", funcion = "listaTurnos", destino = "div_respuesta";
    var parametros = "p1=grabarTurnoProgramar&p2=" + idTurno + "&p3=" + idTurnoProgramar
    enviarFormulario(form, parametros, funcion, destino);
}
function RegularizacionEspecial() {

    posFuncion = "";
    posFuncion = "";
    vtitle = "Caso Especial de Regularizacion";
    vformname = 'podPadRegularizacionEspecial';
    vwidth = '600';
    vheight = '150';
    patronModulo = 'RegularizacionEspecial';
    vcenter = 't';
    vresizable = ''
    vmodal = 'false';
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

function  busquedaEmpleadoRegularizado() {

    posFuncion = "";
    posFuncion = "";
    vtitle = "";
    vformname = 'busquedaEmpleadoRegularizado';
    vwidth = '600';
    vheight = '400';
    patronModulo = 'busquedaEmpleadoRegularizado';
    vcenter = 't';
    vresizable = ''
    vmodal = 'false';
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

function  busquedaEmpleadoRegularizar() {

    txtApePaternoPaciente = $("txtApePaternoPaciente").value;
    txtApeMaternoPaciente = $("txtApeMaternoPaciente").value;
    txtNombrePaciente = $("txtNombrePaciente").value;

    //    if(txtApePaternoPaciente!='' && txtApeMaternoPaciente!=''){
    parametros = "p1=busquedaEmpleadoRegularizar&p2=" + txtApePaternoPaciente + '&p3=' + txtApeMaternoPaciente + '&p4=' + txtNombrePaciente;
    div = "divTablaAreaPersonaRegularizar";
    funcionClick = "EnviaDatosPersonaRegularizada";
    funcionDblClick = "";
    funcionLoad = "setColorTablaArea";
    generarTablax(div, parametros, funcionClick, funcionDblClick, funcionLoad);
//    }
//    else{
//        alert("PORFAVOR INGRESE LOS DOS APELLIDOS");
//    }


}
function EnviaDatosPersonaRegularizada(fil, col) {
    $("txtNombreEmpleados").value = mygridx.cells(fil, 1).getValue() + '  ' + mygridx.cells(fil, 2).getValue() + '   ' + mygridx.cells(fil, 3).getValue();

    $("htxtidCodigoEmpleado").value = mygridx.cells(fil, 0).getValue();

    Windows.close("Div_busquedaEmpleadoRegularizado", '');
}


function guardarEmpleadoRegularizar() {

    var idCodigoEmpleado = $("htxtidCodigoEmpleado").value;
    var txtFecha = $("txtFecha").value;
    var horaInicio = $("txtHoraInicio").value.trim();
    var horaFin = $("txtHoraFin").value.trim();
    var idProgramacionEmpleados = $('htxtidProgramacionEmpleado').value.trim();
    if (idCodigoEmpleado != '') {
        if (horaInicio != '' && horaFin != '' && horaInicio != 'HH:MM' && horaFin != 'HH:MM') {
            if (txtFecha != '') {
                if (validaHoraMinuto(document.getElementById('txtHoraInicio').value) == 1 && validaHoraMinuto(document.getElementById('txtHoraFin').value) == 1) {
                    //                    var form="";
                    //                    funcion="";
                    //                    destino="";
                    var parametros = "p1=guardarEmpleadoRegularizar&p2=" + idCodigoEmpleado + "&p3=" + txtFecha + "&p4=" + horaInicio.trim().replace(":", ".") + "&p5=" + horaFin.trim().replace(":", ".") + "&p6=" + idProgramacionEmpleados;
                    //                    enviarFormulario(form,parametros,funcion,destino);
                    var datos = traerData(parametros);
                    //alert(datos[0].trim());
                    switch (datos[0].trim()) {
                        case "0":
                        {
                            $('resultadosRegularizacionEspecial').innerHTML = '<p style="color: red; font-weight: bold;">No existe programación para el empleado</p>';
                            break;
                        }
                        case "1":
                        case "2":
                        {
                            $('resultadosRegularizacionEspecial').innerHTML = '<p style="color: blue; font-weight: bold;">Registro Grabado</p>';
                            document.getElementById('btnGuardarEmpleadoRegularizar').style.visibility = "hidden";
                            //document.getElementById('infoGuardarEmpleadoRegularizar').style.visibility="visible";
                            BusquedaEmpleado();
                            break;
                        }
                        case "3":
                        case "4":
                        {
                            $('resultadosRegularizacionEspecial').innerHTML = '<p style="color: blue; font-weight: bold;">Registro Grabado</p>';
                            document.getElementById('btnGuardarEmpleadoRegularizar').style.visibility = "hidden";
                            //document.getElementById('infoGuardarEmpleadoRegularizar').style.visibility="visible";
                            BusquedaEmpleado();
                            break;
                        }
                        default:
                            $('resultadosRegularizacionEspecial').innerHTML = '<p style="color: red; font-weight: bold;">' + datos[0].trim() + '</p>';
                    }
                } else
                {
                    alert('Ingrese bien la Hora HH:MM (ejemplo 22:22)');
                }
            } else {
                alert('Porfavor Ingrese Fecha ');
            }
        } else {
            alert('Porfavor Ingrese Fecha Inicio o Fin');
        }
    } else {
        alert('Porfavor Ingrese Datos de Empleados');
    }
}

function Cerrar() {
    Windows.close("Div_busquedaEmpleadoRegularizado", '');
}


function desactivarEmpleadoArea(idCodigoEmpleado, idCodigoSEACC) {
    //alert(idCodigoEmpleado+"---"+idCodigoSEACC);
    if (window.confirm("Seguro que desea Desactivar")) {
        form = "";
        destino = "";
        //        funcion="";
        funcion = "RefrescarTabla(" + idCodigoEmpleado + ")";
        parametros = "p1=desactivarEmpleadoArea&p2=" + idCodigoEmpleado + '&p3=' + idCodigoSEACC;
        enviarFormulario(form, parametros, funcion, destino);
    }
}

function RefrescarTabla(idCodigoEmpleado) {

    patronModulo = 'mostrarTablaPuestosEmpleados';
    icodigoEmpleado = idCodigoEmpleado;
    parametro = '';
    parametro += 'p1=' + patronModulo;
    parametro += '&p2=' + icodigoEmpleado;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametro,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuestas = transport.responseText;
            $('divDatosPuesto').update(respuestas);
        }
    })
}

function exportarExcelArea() {
    mes = $("cboMes").value;
    anio = $("cboAnio").value;
    //    alert(mes+'  '+anio);
    div = "";
    parametros = "p1=exportarExcelArea&p2=" + anio + "&p3=" + mes;
    location.href = pathRequestControl + '?' + parametros;

}


function reecontratacionPersonal() {
    //    alert("heeeeeee");
    cboModContrato = $("cboModContrato").value = "";
    cboTipoSueldo = $("cboTipoSueldo").value = "";
    txtSueldo = $("txtSueldo").value = "";
    txtFechaIni = $("txtFechaIni").value = "";
    txtFechaFin = $("txtFechaFin").value = "";
    var campoModalidad = ["cboModContrato", "txtSueldo", "txtFechaIni", "txtFechaFin", "cboTipoSueldo"];
    habilitarCampos(campoModalidad);
    $("btnGrabar").hide();
    $("btnEditar").hide();
    $("btnModificar").hide();
    $("btnModificarFecha").show();

//     var tablax = $('Tabla1');
////    estadoCama = tablax.tBodies[0].rows[fila].cells[26].innerHTML;
//    tablax.hide();
}

function modificarContratoSoloFecha() {
    //    alert("heeeeeee");
    idEmpModCon = $("hidIdEmpModCon").value; //id ModalidadContrato
    idModContrato = $("cboModContrato").value;
    idTipoSueldo = $("cboTipoSueldo").value;
    sueldo = $("txtSueldo").value;
    fechaIni = $("txtFechaIni").value;
    fechaFin = $("txtFechaFin").value;
    form = "";
    parametros = "p1=modificarContratoSoloFecha&p2=" + idEmpModCon + "&p3=" + idModContrato + "&p4=" + sueldo + "&p5=" + idTipoSueldo;
    parametros += "&p6=" + fechaIni + "&p7=" + fechaFin;
    funcion = "";
    destino = "";
    enviarFormularioSincronizado(form, parametros, funcion, destino)
    /******************/
    deshabilitarCampos(campoModContrato);
    //    $("btnSedeEA").hide();
    $("btnEditar").show();
    $("btnModificar").hide();
    $("btnGrabar").hide();
    $("btnModificarFecha").hide();
    /******************/

}


function exportarExcelEncargadosMorosos() {
    //    alert('heeeeeee');
    mes = $("cboMes").value;
    anio = $("cboAnio").value;
    alert(mes + '  ' + anio);
    div = "";
    parametros = "p1=exportarExcelEncargadosMorosos&p2=" + anio + "&p3=" + mes;
    location.href = pathRequestControl + '?' + parametros;

}



function CargarPersonaArea() {
    idSede = $("cboSede").value;
    // alert(idSede);

    form = "";
    destino = "Div_TablaSubAreas";
    funcion = "";
    parametros = "p1=CargarPersonaArea&p2=" + idSede;
    enviarFormulario(form, parametros, funcion, destino);
}

/**************************** MENU USUARIO *********************************/
/******************************2012-02-09***********************************/
function mostrarUsuario() {
    patronModulo = 'mostrarMenuUsuario';
    icodigoEmpleado = $('txtCopEmp').value;
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + icodigoEmpleado;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('divDerRegistroP').update(respuesta);
            //            desactivarModatidadContrata(1);
            myDiv = document.getElementById('divTitulo');
            myDiv.innerHTML = document.getElementById('txtNomPer').value;
            puestosPorEmpleados();
            detalleModalidadContrato();
            botonesUsuario(0);
        }
    })
}
/*
 function desactivarEmpleadoArea(idCodigoEmpleado,idCodigoSEACC){
 //alert(idCodigoEmpleado+"---"+idCodigoSEACC);
 if(window.confirm("Seguro que desea Desactivar")){
 form="";
 destino="";
 //        funcion="";
 funcion="RefrescarTabla("+idCodigoEmpleado+")";
 parametros="p1=desactivarEmpleadoArea&p2="+idCodigoEmpleado+'&p3='+idCodigoSEACC ;
 enviarFormulario(form,parametros,funcion,destino);  
 }
 }
 
 */

/*******************************2012-02-10*******************************/
/**********************************Funciones de Los botones**************/
function crearUsuario() {
    //    alert("guarda");
    $("btnGrabarUsuario").show();
    $("btnCrearUsuario").hide();
}
function editarUsuario() {
    $("btnEditarUsuario").hide();
    $("btnModificarUsuario").show();
}
function modificarUsuario() {
    $("btnModificarUsuario").hide();

}

function botonesUsuario(hayUsuario) {
    if (hayUsuario == 1) {
        $("btnCrearUsuario").hide();
        $("btnGrabarUsuario").hide();
        $("btnEditarUsuario").hide();
        $("btnModificarUsuario").show();
    } else {
        $("btnCrearUsuario").show();
        $("btnGrabarUsuario").hide();
        $("btnEditarUsuario").hide();
        $("btnModificarUsuario").show();
    }
}


function CargarArea() {
    var idSede = $("cboSede").value;
    //alert(idSede);
    var parametros = "p1=CargarArea&p2=" + idSede;
    var div = "Div_TablaAreas";
    var funcionClick = "listarEmpleados";
    var funcionDblClick = "";
    var funcionLoad = "";
    generarTablax(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}

///////INICIO----LO SIGUIENTE SE CARGA INMEDIATAMENTE DESPUES DE CARGAR LA PAGINA --Miercoles 21 Marzo 10;44am

function CargarlistadoTodasAreasSinCoordinador() {
    var idSede = $("cboSede").value;
    //alert(idSede);
    var parametros = "p1=CargarlistadoTodasAreasSinCoordinador&p2=" + idSede;
    var div = "Div_listadoTodasAreasSinCoordinador";
    //var funcionClick="listarEmpleados";
    var funcionClick = "ClickCargarlistadoTodasAreasSinCoordinador";
    var funcionDblClick = "";
    var funcionLoad = "setColorTablaAreasinCoordinador";
    generarTablaAreasSinCoordinadores(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}





function setColorTablaAreasinCoordinador() {
    //    for(i=0;i<mygridx.getRowsNum();i++){
    //        var fechaInicial = mygridx.cells(i,4).getValue();
    //        var fechaFinal = mygridx.cells(i,5).getValue();
    //
    //        if(i%2!=0 )
    //            mygridx.setRowTextStyle(mygridx.getRowId(i) ,'background-color:#a3d7ff;color:black;border-top: 1px solid #DAEFC2;');
    //    //else if(estado !='')
    //    //        else if(i%2!=0  )
    //    //            mygridx.setRowTextStyle(mygridx.getRowId(i) ,'background-color:#lightsteelblue;color:black;border-top: 1px solid #FFD7BB;');
    //
    //    }
    //

    for (i = 0; i < mygridx.getRowsNum(); i++) {
        //        var fechaInicial = mygridxcor.cells(i,4).getValue();
        //        var fechaFinal = mygridxcor.cells(i,5).getValue();
        var tipoArea = mygridx.cells(i, 2).getValue();

        //        if(fechaInicial=='' || fechaFinal=='' )
        //            mygridxcor.setRowTextStyle(mygridxcor.getRowId(i) ,'background-color:#CCFF99;color:black;border-top: 1px solid #DAEFC2;');
        //        //else if(estado !='')
        //        else if(fechaInicial !='' && fechaFinal!='' )
        //            mygridxcor.setRowTextStyle(mygridxcor.getRowId(i) ,'background-color:#8db1ff;color:black;border-top: 1px solid #FFD7BB;');

        if (tipoArea == 'Area') {

            mygridx.setRowTextStyle(mygridx.getRowId(i), 'background-color:#CCFF99;color:black;border-top: 1px solid #DAEFC2;');


        } else if (tipoArea == 'Sub Area') {

            mygridx.setRowTextStyle(mygridx.getRowId(i), 'background-color:#8db1ff;color:black;border-top: 1px solid #FFD7BB;');


        }


    }




}




function ClickCargarlistadoTodasAreasSinCoordinador(fil, col) {

    if (col == 5) {

        //        alert("Click en la columna 4 jcber");
        //Accion Turno

        var sede = mygridx.cells(fil, 0).getValue();
        var area = mygridx.cells(fil, 1).getValue();
        var cordinador = mygridx.cells(fil, 3).getValue();
        var idSedeempresaArea = mygridx.cells(fil, 4).getValue();


        //alert(sede+area+cordinador+idSedeempresaArea);

        abrirMantenimientoTurnoCordi(sede, area, cordinador, idSedeempresaArea);

        //        alert("la ventana popap se cargo correctamente")



    } else if (col == 6) {

        //alert("Click en la columna 5");
        //Accion Coordinador

        var sede1 = mygridx.cells(fil, 0).getValue();
        var area1 = mygridx.cells(fil, 1).getValue();
        //var cordinador1=mygridx.cells(fil,2).getValue();
        var idSedeempresaArea1 = mygridx.cells(fil, 4).getValue();
        var accion = "NuevoCoordinador";

        //        var fechaInicio1=mygridx.cells(fil,4).getValue();
        //        var fechaFin1=mygridx.cells(fil,5).getValue();

        //alert(sede1+area1+cordinador1+idSedeempresaArea1+accion);
        //alert(sede1+area1+idSedeempresaArea1+accion);


        abrirMantenimientoEditarCordinador(sede1, area1, '', '', idSedeempresaArea1, '', '', accion);

        //abrirMantenimientoEditarCordinador(sede1,area1,cordinador1,iIdEncargadoProgramacionPersonal,idSedeempresaArea1,fechaInicio1,fechaFin1,accion);


    } else {
        //alert("difernte de 4 y 5");

    }

}

//////////////////////////////////////////////////////////////////////////

//11 Abril 2012 JCQA
function CargarlistadoPuestosXCentroCostos(idCentroDeCosto) {

    var div = "divResultadoPuestosCCostos";
    var parametros = "p1=CargarlistaPuestosXCentroCostos&p2=" + idCentroDeCosto;
    var funcionClick = "CapturaDetallePuestosCentroCostos";
    var funcionDblClick = "";
    //var funcionLoad="setColorTablaAreaconCoordinador";
    var funcionLoad = "setColorTablaPuestosDeCCostos";

    generarTablax(div, parametros, funcionClick, funcionDblClick, funcionLoad);
//    generarTablaCoordinadores(div,parametros,funcionClick,funcionDblClick,funcionLoad);

}
//cancelarGrabarDetallePuesto123();
//funcion 10Mayo2012
function CapturaDetallePuestosCentroCostos(fil, col) {
    cancelarGrabarDetallePuesto123();
    $('cell52').update('');

    $("iddetallePuestosCCostos").show();

    var idPuesto = mygridx.cells(fil, 0).getValue();

    $("hIdPuesto").value = idPuesto;
    var nombrePuesto = mygridx.cells(fil, 1).getValue();
    var IdCategoriaPuesto = mygridx.cells(fil, 6).getValue();
    var estadoPuesto = mygridx.cells(fil, 2).getValue();

    $("selectCategoriaPuestos").selectedIndex = IdCategoriaPuesto;
    $('txtNombrePuesto').value = nombrePuesto;

    if (estadoPuesto.trim() == 'ACTIVO') {

        document.getElementById("chkEstado").checked = true;
        $("chkEstado").value = 1;


    } else if (estadoPuesto.trim() == 'INACTIVO') {

        document.getElementById("chkEstado").checked = false;
        $("chkEstado").value = 0;


    }

}



function setColorTablaPuestosDeCCostos() {
    //    alert("hol");

    for (i = 0; i < mygridx.getRowsNum(); i++) {
        //        var fechaInicial = mygridxcor.cells(i,4).getValue();
        //        var fechaFinal = mygridxcor.cells(i,5).getValue();
        var tipoArea = mygridx.cells(i, 2).getValue();

        //        if(fechaInicial=='' || fechaFinal=='' )
        //            mygridxcor.setRowTextStyle(mygridxcor.getRowId(i) ,'background-color:#CCFF99;color:black;border-top: 1px solid #DAEFC2;');
        //        //else if(estado !='')
        //        else if(fechaInicial !='' && fechaFinal!='' )
        //            mygridxcor.setRowTextStyle(mygridxcor.getRowId(i) ,'background-color:#8db1ff;color:black;border-top: 1px solid #FFD7BB;');

        if (tipoArea == 'ACTIVO') {

            mygridx.setRowTextStyle(mygridx.getRowId(i), 'background-color:#CCFF99;color:black;border-top: 1px solid #DAEFC2;');

        } else if (tipoArea == 'INACTIVO') {

            mygridx.setRowTextStyle(mygridx.getRowId(i), 'background-color:#8db1ff;color:black;border-top: 1px solid #FFD7BB;');


        }


    }


}




//Viernes 27 de Abril 2012
////////////////////////////////////////////////////////////////////////////
function CargarlistadoTodosCordinadores() {
    //      alert("holitas");
    var idSede = $("cboSede").value;
    //alert(idSede);
    var parametros = "p1=CargarlistadoTodosCordinadores&p2=" + idSede;
    var div = "Div_listadoTodosCordinadores";
    //var funcionClick="listarEmpleados";
    var funcionClick = "ClickCargarlistadoTodosCordinadores";
    var funcionDblClick = "";
    var funcionLoad = "setColorTablaAreaconCoordinador";
    //var funcionLoad="ber";

    generarTablaCoordinadores(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}


//function ber(){
//
//    setColorTablaAreaconCoordinador();
//    CargarlistadoTodasAreasSinCoordinador();
//
//}
//


///////FIN----LO ANTERIOR SE CARGA INMEDIATAMENTE DESPUES DE CARGAR LA PAGINA


function setColorTablaAreaconCoordinador() {

    for (i = 0; i < mygridxcor.getRowsNum(); i++) {
        //        var fechaInicial = mygridxcor.cells(i,4).getValue();
        //        var fechaFinal = mygridxcor.cells(i,5).getValue();
        var tipoArea = mygridxcor.cells(i, 2).getValue();

        //        if(fechaInicial=='' || fechaFinal=='' )
        //            mygridxcor.setRowTextStyle(mygridxcor.getRowId(i) ,'background-color:#CCFF99;color:black;border-top: 1px solid #DAEFC2;');
        //        //else if(estado !='')
        //        else if(fechaInicial !='' && fechaFinal!='' )
        //            mygridxcor.setRowTextStyle(mygridxcor.getRowId(i) ,'background-color:#8db1ff;color:black;border-top: 1px solid #FFD7BB;');

        if (tipoArea == 'Area') {

            mygridxcor.setRowTextStyle(mygridxcor.getRowId(i), 'background-color:#CCFF99;color:black;border-top: 1px solid #DAEFC2;');


        } else if (tipoArea == 'Sub Area') {

            mygridxcor.setRowTextStyle(mygridxcor.getRowId(i), 'background-color:#8db1ff;color:black;border-top: 1px solid #FFD7BB;');


        }


    }

}


function ClickCargarlistadoTodosCordinadores(fil, col) {

    if (col == 9) {

        //        alert("Click en la columna 6 Accion Turno");

        //        var sede=mygridxcor.cells(fil,0).getValue();
        //        var area=mygridxcor.cells(fil,1).getValue();
        //        var cordinador=mygridxcor.cells(fil,2).getValue();
        //        var idSedeempresaArea=mygridxcor.cells(fil,3).getValue();


        var sede = mygridxcor.cells(fil, 0).getValue();
        var area = mygridxcor.cells(fil, 1).getValue();
        var cordinador = mygridxcor.cells(fil, 3).getValue();
        var idSedeempresaArea = mygridxcor.cells(fil, 5).getValue();



        //        alert(sede+area+cordinador+idSedeempresaArea);
        abrirMantenimientoTurnoCordi(sede, area, cordinador, idSedeempresaArea);

        //        alert("la ventana popap se cargo correctamente")



    } else if (col == 10) {

        //        alert("Click en la columna 7 Accion Cordi");

        //        var sede1=mygridxcor.cells(fil,0).getValue();
        //        var area1=mygridxcor.cells(fil,1).getValue();
        //        var cordinador1=mygridxcor.cells(fil,2).getValue();
        //        var iIdEncargadoProgramacionPersonal=mygridxcor.cells(fil,3).getValue();
        //        var idSedeempresaArea1=mygridxcor.cells(fil,4).getValue();
        //        var fechaInicio1=mygridxcor.cells(fil,5).getValue();
        //        var fechaFin1=mygridxcor.cells(fil,6).getValue();
        //        var accion="EditarCoordinador";


        //////

        var sede1 = mygridxcor.cells(fil, 0).getValue();
        var area1 = mygridxcor.cells(fil, 1).getValue();
        var cordinador1 = mygridxcor.cells(fil, 3).getValue();
        var iIdEncargadoProgramacionPersonal = mygridxcor.cells(fil, 4).getValue();
        var idSedeempresaArea1 = mygridxcor.cells(fil, 5).getValue();
        var fechaInicio1 = mygridxcor.cells(fil, 6).getValue();
        var fechaFin1 = mygridxcor.cells(fil, 7).getValue();
        var accion = "EditarCoordinador";




        //        alert(sede1+area1+cordinador1+iIdEncargadoProgramacionPersonal+idSedeempresaArea1+fechaInicio1+fechaFin1+accion);

        abrirMantenimientoEditarCordinador(sede1, area1, cordinador1, iIdEncargadoProgramacionPersonal, idSedeempresaArea1, fechaInicio1, fechaFin1, accion);


    } else if (col == 11) {
        var iCodigoEmpeladoCoordinador = mygridxcor.cells(fil, 8).getValue();

        posFuncion = "reporteEmpleado";
        // posFuncion ="josecito()";
        //vtitle="Seleccion o Edicion de Coordinador por Area";
        vtitle = "";
        vformname = 'Horarios';
        vwidth = '1200';//600
        vheight = '840';//400 //350 orif
        patronModulo = 'registroHorariosEmpleadosTotal';
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

        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + iCodigoEmpeladoCoordinador;
        CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);


    }

}

function abrirMantenimientoEditarCordinador(sede, area, cordinador, iIdEncargadoProgramacionPersonal, idSedeempresaArea, fechaInicio, fechaFin, accion) {

    //      alert("Hola");
    //posFuncion = "buscarArea('all')";

    //posFuncion ="desactivarCoordinadorAlArea";
    posFuncion = "ValidarFechaVaciaConColor";
    // posFuncion ="josecito()";
    //vtitle="Seleccion o Edicion de Coordinador por Area";
    vtitle = "Mantenimiento Coordinador";
    vformname = 'MantenimientoCoordinadorArea';
    vwidth = '440';//600
    vheight = '240';//400 //350 orif
    patronModulo = 'mantenimientoEditarCordinador';
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


    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + sede;
    parametros += '&p3=' + area;
    parametros += '&p4=' + cordinador;
    parametros += '&p5=' + iIdEncargadoProgramacionPersonal;
    parametros += '&p6=' + fechaInicio;
    parametros += '&p7=' + fechaFin;
    parametros += '&p8=' + accion;
    parametros += '&p9=' + idSedeempresaArea;
    //alert(parametros);

    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}


function ValidarFechaVaciaConColor() {

//Comentado 12 Abril 2012 JCQA        
//    if($("txtFechaIni").value==''){
//        //alert('entro af jose')
//
//        $('txtFechaIni').setStyle(  {
//            backgroundColor: 'lightgreen'
//        } );
//           
//    }
//
//    if($("txtFechaFin").value==''){
//        $('txtFechaFin').setStyle(  {
//            backgroundColor: 'lightgreen'
//        } );
//
//    }


}

// div_MantenimientoCoordinadorArea.
// mygridxcor.setRowTextStyle(mygridxcor.getRowId(i) ,'background-color:#CCFF99;color:black;border-top: 1px solid #DAEFC2;');
//else if(estado !='')
//             else if(fechaInicial !='' && fechaFinal!='' )
//        mygridxcor.setRowTextStyle(mygridxcor.getRowId(i) ,'background-color:#8db1ff;color:black;border-top: 1px solid #FFD7BB;');

//    }





//function abrirMantenimientoTurnoCordi(opt,fil){
function abrirMantenimientoTurnoCordi(sede, area, cordinador, idSedeempresaArea) {

    //      alert("Hola");
    //posFuncion = "buscarArea('all')";

    posFuncion = "CargarlistadoTodosTurnosDisponibles";
    // posFuncion ="josecito()";
    vtitle = "Seleccion de Turno por Area";
    vformname = 'EtiquetaAtributo';
    vwidth = '720';
    vheight = '450';
    patronModulo = 'mantenimientoTurnoCordi';
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


    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + sede;
    parametros += '&p3=' + area;
    parametros += '&p4=' + cordinador;
    parametros += '&p5=' + idSedeempresaArea;

    //    alert(parametros);

    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}
///////////////////// jose 13marzo 2:56pm


function CargarlistadoTodosTurnosDisponibles() {
    var nomSedeEmpresaArea = $("nomSedeEmpresaArea").value;
    //alert(nomSedeEmpresaArea);
    var parametros = "p1=CargarlistadoTodosTurnosDisponibles&p2=" + nomSedeEmpresaArea;
    var div = "Div_TablaListaTurnosDisponibles";
    //var funcionClick="listarEmpleados";
    var funcionClick = "capturaCodTurnoDeListaDisponiblexArea";
    var funcionDblClick = "";
    var funcionLoad = "listaTurnosxSedeEmpresaArea";
    generarTablay(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}

//bien
function capturaCodTurnoDeListaDisponiblexArea(fil, col) {

    var codTurno = mygridy.cells(fil, 0).getValue();
    $("hCodTurno").value = codTurno;

//alert(codTurno);
//alert("ta dispo")
}


function listaTurnosxSedeEmpresaArea() {
    var nomSedeEmpresaArea = $("nomSedeEmpresaArea").value;
    //alert(nomSedeEmpresaArea);
    var parametros = "p1=listaTurnosxSedeEmpresaArea&p2=" + nomSedeEmpresaArea;
    var div = "Div_TurnosSeleccionadosxArea";
    //var funcionClick="listarEmpleados";
    var funcionClick = "capturaIdTurnoAreaSedeDeListaSeleccionadosxArea";
    //    var funcionDblClick="clickEnlistaTurnosxSedeEmpresaArea";
    var funcionDblClick = "";
    var funcionLoad = "colorearTurnosxSedeEmpresaArea";

    generarTablaz(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}

//function clickEnlistaTurnosxSedeEmpresaArea(fil,col){
////    if(col==5){
////        alert("presionastes el 5");
////        
//////        abrirPoPupColorTurnoSeleccionadoPorArea();
////        
////  
////    } else if(col==6){
////        alert("presionastes el 6");
////        
////        
////  
////    }
//    
//}


function colorearTurnosxSedeEmpresaArea() {

    for (i = 0; i < mygridz.getRowsNum(); i++) {

        var codigoColor = mygridz.cells(i, 5).getValue();

        mygridz.setRowTextStyle(mygridz.getRowId(i), 'background-color:' + codigoColor + ';color:black;border-top: 1px solid #DAEFC2;');

        // mygridz.setRowTextStyle(mygridz.getRowId(i) ,'background-color:#C1E69D;color:black;border-top: 1px solid #DAEFC2;');

        //            mygridz.setRowTextStyle(mygridz.getRowId(i) ,'background-color:#FFA66A;color:black;border-top: 1px solid #FFD7BB;');

    }
}




//funcion que captura el IdTurnoAreaSede
function capturaIdTurnoAreaSedeDeListaSeleccionadosxArea(fil, col) {
    var idTurnoAreaSede = mygridz.cells(fil, 3).getValue();

    $("hIdTurnoAreaSede").value = idTurnoAreaSede;
    $("hIdfilaSeleccionada").value = fil;

    //    alert(idTurnoAreaSede);

    if (col == 6) {

        //alert("presionastes el 5");

        abrirPoPupColorTurnoSeleccionadoPorArea();



    } else if (col == 7) {
        alert("presionastes el 6");

    }


}

//agregado jueves 19 Abril 2012 JCQA
//
//function abrirPoPupColorTurnoSeleccionadoPorArea(sede,area,cordinador,idSedeempresaArea){ 
function abrirPoPupColorTurnoSeleccionadoPorArea() {
    //      alert("Hola");
    //posFuncion = "buscarArea('all')";  

    //    posFuncion ="CargarlistadoTodosTurnosDisponibles()";

    posFuncion = "initColorPicker";
    // posFuncion ="josecito()";
    vtitle = "Seleccion de Color de Turno por Area";
    vformname = 'colorPicker';
    vwidth = '252';
    vheight = '300';
    patronModulo = 'abrirPoPupColorTurnoSeleccionadoPorArea';
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


    parametros = '';
    parametros += 'p1=' + patronModulo;
    //    parametros+='&p2='+sede;
    //    parametros+='&p3='+area;
    //    parametros+='&p4='+cordinador;
    //    parametros+='&p5='+idSedeempresaArea;

    //    alert(parametros);
    //    alert("entro a funcion potpup 1");
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
//    alert("salio a funcion potpup 2");
}

//Agregado 19 Abril 2012 JCQA

function initColorPicker() {


    var picker = new dhtmlXColorPicker("divColoresPicker", false, true);

    picker.setImagePath("../../../imagen/dhtmlxcolorpicker/imgs/");
    picker.setColor('#ffffff');
    // picker.selectedcolor(colorPrincipal);
    picker.setOnCancelHandler(function (color) {
        //some code
        //alert(color);
        //initColorPicker(color)
        Windows.close("Div_colorPicker");
    })

    picker.setOnSelectHandler(function (color) {

        filaSeleccionada = $("hIdfilaSeleccionada").value;
        //        alert("La fila seleccionada es :"+filaSeleccionada);
        //        mygridz.setRowTextStyle(mygridz.getRowId(filaSeleccionada) ,'background-color:#C1E69D;color:black;border-top: 1px solid #DAEFC2;');
        mygridz.setRowTextStyle(mygridz.getRowId(filaSeleccionada), 'background-color:' + color + ';color:black;border-top: 1px solid #DAEFC2;');
        //Windows.close("Div_colorPicker", event);
        Windows.close("Div_colorPicker");
        //alert("El codigo del color es: "+color);
        grabarColorSelecionadoTurnoAreaSede(color);


        // initColorPicker(color)

    })

    //picker.clickOk(function(){alert('peche')})
    picker.init();
    picker.show();


//myCP2.init();
//myCP2.show();
// myCP2.setSkin("dhx_skyblue"); 

//    var myCP3 = new dhtmlXColorPickerInput('dhtmlxColorPicker3');
//    myCP3.setImagePath("../../../imagen/dhtmlxcolorpicker/imgs/");
//    myCP3.init();
//myCP3.setSkin("dhx_skyblue");
}

function grabarColorSelecionadoTurnoAreaSede(color) {

    if (window.confirm("Desea Confirmar el color?" + color)) {
        //alert("codigo de confirmacion"+color);
        var subColor = color;
        var hIdTurnoAreaSede = $("hIdTurnoAreaSede").value;

        var col = subColor.substring(1, 7);

        //alert(col);
        // alert("El hIdTurnoAreaSede es: "+hIdTurnoAreaSede);

        var form = "";
        var destino = "";
        //      var funcion="RefrescarTablaTurnosDisponiblesxArea";
        //        var funcion="RefrescarTablaTurnosSeleccionadosxArea";
        var funcion = "";
        //col es el codigo de color pero sin #
        var parametros = "p1=grabarColorSelecionadoTurnoAreaSede&p2=" + hIdTurnoAreaSede + "&p3=" + col;
        //alert(parametros);
        enviarFormulario(form, parametros, funcion, destino);

    } else {
        alert("codigo de rechazo");

    }

}

//grabarColorSelecionadoTurnoAreaSede

function xxx() {

    alert("entro a xxx");

}


function asignarTurnoDisponibleAlArea() {
    var codTurno = $("hCodTurno").value;
    var idSedeEmpresaArea = $("nomSedeEmpresaArea").value;
    //    alert(codTurno+idSedeEmpresaArea);

    //if(codTurno !='' && idSedeEmpresaArea !=''){

    if (codTurno != '') {
        var form = "";
        var destino = "";
        //var funcion="RefrescarTablaListaEmpleados("+idEmpresaSedearea+")";
        //var funcion="RefrescarTablaTurnosDisponiblesxArea("+idEmpresaSedearea+")";
        var funcion = "RefrescarTablaTurnosDisponiblesxArea";
        var parametros = "p1=asignarTurnoDisponibleAlArea&p2=" + codTurno + "&p3=" + idSedeEmpresaArea;
        enviarFormulario(form, parametros, funcion, destino);
    } else {
        alert("Seleccione algun turno disponible");
    }

}




function quitarTurnoSeleccionadoAlArea() {

    //    alert("quitar Turno");

    var IdTurnoAreaSede = $("hIdTurnoAreaSede").value;
    //var idSedeEmpresaArea= $("nomSedeEmpresaArea").value;

    //    alert(IdTurnoAreaSede);


    if (IdTurnoAreaSede != '') {
        var form = "";
        var destino = "";
        //var funcion="RefrescarTablaListaEmpleados("+idEmpresaSedearea+")";
        var funcion = "RefrescarTablaTurnosDisponiblesxArea";
        //var parametros="p1=quitarPreProgramacion&p2="+idPreProgramacionPersonal+"&p3="+idPuestoEmpleadoPorArea;
        var parametros = "p1=quitarTurnoSeleccionadoAlArea&p2=" + IdTurnoAreaSede;
        enviarFormulario(form, parametros, funcion, destino);
    } else {

        alert("Seleccione un turno del area para quitarlo")
    }
}





function RefrescarTablaTurnosDisponiblesxArea() {

    $("hCodTurno").value = '';
    $("hIdTurnoAreaSede").value = '';
    var idArea = $("nomSedeEmpresaArea").value;

    //alert('el codigo de:::'+idArea);

    var parametros = "p1=RefrescarTablaTurnosDisponiblesxArea&p2=" + idArea;
    var div = "Div_TablaListaTurnosDisponibles";
    var funcionClick = "capturaCodTurnoDeListaDisponiblexArea";
    var funcionDblClick = "";
    var funcionLoad = "RefrescarTablaTurnosSeleccionadosxArea";
    generarTablay(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}




function RefrescarTablaTurnosSeleccionadosxArea() {

    //var IdSedeEmpresaArea=$("nomSedeEmpresaArea").value;
    var idArea = $("nomSedeEmpresaArea").value;

    var parametros = "p1=RefrescarTablaTurnosSeleccionadosxArea&p2=" + idArea;
    var div = "Div_TurnosSeleccionadosxArea";
    var funcionClick = "capturaIdTurnoAreaSedeDeListaSeleccionadosxArea";
    var funcionDblClick = "";
    var funcionLoad = "colorearTurnosxSedeEmpresaArea";
    generarTablaz(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}









/////////////////////
function josecito() {
    //    var ber=$("CodIdSedecita").value;
    //alert("entro a la funcion josecito");
    //    alert(ber);
    alert("holitas");


}



function listarEmpleados(fil, col) {

    var idEmpresaSedearea = mygridx.cells(fil, 2).getValue();

    var NombreMes = $("cboMes").options[$("cboMes").selectedIndex].text;

    var FormNombreMes = "<H3 style='color: #C5302C'><BLINK ><BIG>¡" + NombreMes + "! </BIG></BLINK><H3>";


    //con (fil,1) se captura el nombre del Area
    var nombreArea = "<h1 >Empl. asignados a " + mygridx.cells(fil, 1).getValue() + " - " + FormNombreMes + " </h1>";
    var nombrePreprogramados = "<h1 >Empl. Pre-Programados a " + mygridx.cells(fil, 1).getValue() + " - " + FormNombreMes + " </h1>";

    $('divCabeceraArea').update(nombreArea);

    $('divCabeceraPreProgramados').update(nombrePreprogramados);


    var mes = $("cboMes").value;
    var anno = $("cboAnio").value;
    //    alert(idEmpresaSedearea);
    $("hidEmpresaSedearea").value = idEmpresaSedearea;
    var parametros = "p1=listarEmpleados&p2=" + idEmpresaSedearea + "&p3=" + mes + "&p4=" + anno;
    var div = "Div_TablaEmpleadosArea";
    var funcionClick = "CapturaCodigoidPuestoEmpleadoPorArea";
    var funcionDblClick = "";
    var funcionLoad = "RefrescarTablaListaEmpleadosProgramados";
    //funcionLoad="";
    generarTablay(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}



function CapturaCodigoidPuestoEmpleadoPorArea(fil, col) {

    var idPuestoEmpleadoPorArea1 = mygridy.cells(fil, 1).getValue();
    $("hidPuestoEmpleadoPorArea").value = idPuestoEmpleadoPorArea1;
}

function asignarPreProgramacion() {

    var idPuestoEmpleadoPorArea = $("hidPuestoEmpleadoPorArea").value;
    var idEmpresaSedearea = $("hidEmpresaSedearea").value;
    var mes = $("cboMes").value;
    var anno = $("cboAnio").value;
    var mesActual = $("hidMes").value;
    var annoActual = $("hidannoActual").value;
    //      alert(mes+"-mesActual="+parseInt(mesActual));
    var form = "";
    var destino = "";
    //        var funcion="RefrescarTablaListaEmpleados("+idEmpresaSedearea+")";
    var funcion = "RefrescarTablaListaEmpleados";
    var parametros = "p1=asignarPreProgramacion&p2=" + idPuestoEmpleadoPorArea + "&p3=" + anno + "&p4=" + mes;
    //    alert(idEmpresaSedearea);
    if (parseInt(anno.trim()) > parseInt(annoActual.trim())) {
        if (idPuestoEmpleadoPorArea != '' && idEmpresaSedearea != '') {
            //if(idPuestoEmpleadoPorArea !=''){  

            enviarFormulario(form, parametros, funcion, destino);
        } else {
            alert("Seleccione al Personal");
        }
    } else {
        if (parseInt(anno) == parseInt(annoActual.trim()) && parseInt(mes) >= parseInt(mesActual)) {
            if (idPuestoEmpleadoPorArea != '' && idEmpresaSedearea != '') {

                // if(idPuestoEmpleadoPorArea !='' ){
                enviarFormulario(form, parametros, funcion, destino);
            } else {
                alert("Seleccione al Personal");
            }
        } else {
            alert("No Puede Realizar Modificaciones; Porfavor Selecciones Otro mes");
        }
    }

}


function RefrescarTablaListaEmpleados() {

    var idEmpresaSedearea = $("hidEmpresaSedearea").value;

    $("hidPuestoEmpleadoPorArea").value = '';
    $("hidPuestoEmpleadoPorAreaProgramado").value = '';
    var mes = $("cboMes").value;
    var anno = $("cboAnio").value;
    var parametros = "p1=RefrescarTablaListaEmpleados&p2=" + idEmpresaSedearea + "&p3=" + mes + "&p4=" + anno;
    var div = "Div_TablaEmpleadosArea";
    var funcionClick = "CapturaCodigoidPuestoEmpleadoPorArea";
    var funcionDblClick = "";
    var funcionLoad = "RefrescarTablaListaEmpleadosProgramados";
    generarTablay(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}

function replicarPreProgramación() {

    var anio = $("cboAnio").value;
    var anioInicial = anio;

    var mes = $("cboMes").value;
    var mesInicial = mes;

    var hidEmpresaSedearea = $("hidEmpresaSedearea").value;

    if (mes == 12) {

        anio++;
        mes = 1;
        var NombreMes = "Enero";


    } else if (mes > 0 && mes < 12) {

        mes++;
        NombreMes = $("cboMes").options[$("cboMes").selectedIndex + 1].text;

    }
    //    alert("ini"+anioInicial+"fin"+mesInicial);    
    //    if(hidEmpresaSedearea!=0){

    if (window.confirm("Esta seguro que desea replicar al mes siguiente:" + NombreMes + "del " + anio + "?")) {

        var parametros = "p1=replicarPreProgramación&p2=" + hidEmpresaSedearea + "&p3=" + mesInicial + "&p4=" + anioInicial + "&p5=" + mes + "&p6=" + anio;
        var datosx = traerData(parametros);
        //            if(datosx[0]=='ok'){
        ////                $('divMsmResultadoEncargado').innerHTML='<p style="color: blue; font-weight: bold;">El coordinador fue asignado correctamente.</p>';
        //
        //            }else if(datosx[0]!='existe'){
        ////                $('divMsmResultadoEncargado').innerHTML='<p style="color: red; font-weight: bold;">Error al asignar,vuelva asignar nuevamente.</p>';
        //
        //            }



        //            alert("Se replicara al año: "+anio+" y al mes: "+mes);


    }

//    }else {
//         
//        alert("Debe seleccionar alguna Area");
//    }  



}



//modifique funcionLoad
function RefrescarTablaListaEmpleadosProgramados() {
    var idEmpresaSedearea = $("hidEmpresaSedearea").value;
    var mes = $("cboMes").value;
    var anno = $("cboAnio").value;
    var parametros = "p1=listarEmpleadosProgramados&p2=" + idEmpresaSedearea + "&p3=" + mes + "&p4=" + anno;
    var div = "Div_TablaEmpleadosProgramados";
    var funcionClick = "guardarCodigoPreProgramacionPersonal";
    var funcionDblClick = "";
    var funcionLoad = "";//ListarEmpleadosPreProgramados
    generarTablaz(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}
//

function guardarCodigoPreProgramacionPersonal(fil, col) {
    var idPreProgramacionPersonal = mygridz.cells(fil, 1).getValue();
    var idPuestoEmpleadoPorArea = mygridz.cells(fil, 2).getValue();
    $("hidPreProgramacionPersonal").value = idPreProgramacionPersonal;
    $("hidPuestoEmpleadoPorAreaProgramado").value = idPuestoEmpleadoPorArea;

}

function quitarPreProgramacion() {
    var idPreProgramacionPersonal = $("hidPreProgramacionPersonal").value;
    var idPuestoEmpleadoPorArea = $("hidPuestoEmpleadoPorAreaProgramado").value;
    //modif
    var idEmpresaSedearea = $("hidEmpresaSedearea").value;
    var mes = $("cboMes").value;
    var anno = $("cboAnio").value;
    var mesActual = $("hidMes").value;
    var annoActual = $("hidannoActual").value;
    //modif
    var form = "";
    var destino = "";
    //        var funcion="RefrescarTablaListaEmpleados("+idEmpresaSedearea+")";
    var funcion = "RefrescarTablaListaEmpleados";
    var parametros = "p1=quitarPreProgramacion&p2=" + idPreProgramacionPersonal + "&p3=" + idPuestoEmpleadoPorArea;

    if (parseInt(anno.trim()) > parseInt(annoActual.trim())) {
        if (idPreProgramacionPersonal != '' && idPuestoEmpleadoPorArea != '') {

            enviarFormulario(form, parametros, funcion, destino);
        } else {
            alert("Selecciones un Empleado,que desea quitarle de la  programaciòn")
        }
    } else {
        if (parseInt(anno) == parseInt(annoActual.trim()) && parseInt(mes) >= parseInt(mesActual)) {
            if (idPreProgramacionPersonal != '' && idPuestoEmpleadoPorArea != '') {

                enviarFormulario(form, parametros, funcion, destino);
            } else {
                alert("Selecciones un Empleado,que desea quitarle de la  programaciòn")
            }
        } else {
            alert("No puede Realizar cambios en los meses anteriores, Gracias")
        }
    }
}

function CargarPersonaArea() {
    CargarArea();
//    RefrescarTablaListaEmpleadosProgramados();
}

//Modificado 27 abril 2012
function CargarTotalCoordinadores() {
    //alert("pruebita jcqaaaa");

    CargarlistadoTodosCordinadores();
    CargarlistadoTodasAreasSinCoordinador();
//    cargarArbolAreas2();
//    CargarArea();
//    RefrescarTablaListaEmpleadosProgramados();
}


function ListarEmpleadosPreProgramados() {
    //    alert("text PruebaListar");
    var mes = $("cboMes").value;
    var anno = $("cboAnio").value;
    //alert($("hidEmpresaSedearea").value);

    var NombreMes = $("cboMes").options[$("cboMes").selectedIndex].text;
    var FormNombreMes = "<h1 style='color: #C5302C'><BLINK >" + NombreMes + " </BLINK><h1>";

    //   alert(NombreMes+" "+anno);
    var EmpleadoTotalProgramadosSedes = "<h1>Lista de Pre Programados Todas las Sedes " + FormNombreMes + " </h1>";
    $('divCabeceraEmpleadoTotalProgramadosSedes').update(EmpleadoTotalProgramadosSedes);

    //    idSede=$("cboSede").value;
    //    alert(mes+anno);
    var parametros = "p1=ListarEmpleadosPreProgramados&p2=" + mes + "&p3=" + anno;
    //    div="Div_TablaAreas";
    var div = "Div_TablaEmpleadoTotalProgramados";
    var funcionClick = "";
    var funcionDblClick = "";
    var funcionLoad = "";
    generarTablaxxx(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}


//jcqa eliminado Viernes 27 de Abril 

function cargarArbolAreas2() {

    var sede = $("cboSede").value;
    ///var idVersion='4';
    editarArea = 0;
    idCadenaAreas = "";
    parametros = "p1=arbolAreas2";
    parametros += "&p2=" + sede;
    divMostrar = document.getElementById('arbolAreas');
    divMostrar.innerHTML = " ";
    treex = new dhtmlXTreeObject("arbolAreas", "100%", "100%", 0);
    treex.setSkin('dhx_skyblue');
    treex.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    treex.attachEvent("onClick", function () {
        sede1 = "";
        area1 = "";
        cordinador1 = "";
        iIdEncargadoProgramacionPersonal = "";
        idSedeempresaArea1 = "";
        fechaInicio1 = "";
        fechaFin1 = "";
        accion = "EditarCoordinador"

        abrirMantenimientoEditarCordinador(sede1, area1, cordinador1, iIdEncargadoProgramacionPersonal, idSedeempresaArea1, fechaInicio1, fechaFin1, accion);
        //alert("arbol");
        //        buscarCoordinadoresAsignar();
        //        editarAreas(treex.getSelectedItemId(),treex.getSelectedItemText());
        //        return true;
    });
    treex.openAllItems(0);
    //    treex.setXMLAutoLoading(pathRequestControl+'?'+parametros);
    treex.loadXML(pathRequestControl + '?' + parametros);
}

//fin Viernes 27 Abril 2012



//function jose(){
//
//    alert("Click en la Tabla Empleados Pre Programados");
//
//
//}

//function setHiddenEmpresaSucursal(fil,col){
//    var idEmpresaSedearea=mygridx.cells(fil,0).getValue();
//    $("hidIdEmpresaSedeArea").value=idEmpresaSedearea;
//    $("hidArea").value=mygridx.cells(fil,2).getValue();
//    $("hidSucursal").value=mygridx.cells(fil,4).getValue();
//
//}
//function buscarArea(opt){
//    $("divFilter").show();
//    $("divTablaAreaCont").show();
//    $("divMantenimientoArea").hide();
//    $("divAsignarSede").show();
//    nomArea=$("txtNombreArea").value;
//    parametros="p1=buscarArea&p2="+nomArea;
//    div="divTablaArea";
//    funcionClick="clickTablaArea";
//    funcionDblClick="";
//    funcionLoad="setColorTablaArea";
//    if(nomArea==""  || nomArea.length>3 || opt=="all"){
//        generarTablax(div,parametros,funcionClick,funcionDblClick,funcionLoad);
//    }


function mantenimientoCaja() {
    var c_cod_per = $("txtCodPer").value;
    var patronModulo = 'mantenimientoCaja';

    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + c_cod_per;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            if (trim(respuesta) !== 0) {
                $('divDerRegistroP').update(respuesta);
                myDiv = document.getElementById('divTitulo');
                myDiv.innerHTML = document.getElementById('txtNomPer').value;
            } else {
                window.alert("El Empleado No tiene Usuario");
                mostrarUsuario();
            }
        }
    });
}

function poppackBoletas() {
    var c_cod_per = $("txtCodPer").value;
    var posFuncion = "";
    var vtitle = "";
    var vformname = 'EtiquetaAtributoSerie';
    var vwidth = '600';
    var vheight = '150';
    var patronModulo = 'poppackBoletas';
    var vcenter = 't';
    var vresizable = '';
    var vmodal = 'false';
    var vstyle = '';
    var vopacity = '';
    var veffect = '';
    var vposx1 = '';
    var vposx2 = '';
    var vposy1 = '';
    var vposy2 = '';
    var parametros = '';
    parametros += 'p1=' + patronModulo + '&p2=' + c_cod_per;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function guardarComprobanteSerie() {//txtSeriComprobante
    var c_cod_per = $("txtCodPer").value;
    //var seriComprobante= $("txtSeriComprobante").value;
    var iIdSerieComprobante = $("cboSerieComprobante").value;
    var usuario = $("htxtUsuario").value;
    var numeroCaja = $("htxtNumeroCaja").value;
    /*
     if(seriComprobante.length<3){
     var longitudCadena=(3-seriComprobante.length);
     for (var i=0; i<longitudCadena ;i++){
     seriComprobante="0"+seriComprobante;
     }
     }
     */
    if (trim(iIdSerieComprobante) !== '') {
        var form = "";
        var destino = "";
        var funcion = "CerrarpoppackBoletas";
        var parametros = "p1=guardarComprobanteSerie&p2=" + c_cod_per + "&p3=" + iIdSerieComprobante
                + "&p4=" + usuario + "&p5=" + numeroCaja;
        enviarFormulario(form, parametros, funcion, destino);

    } else {
        alert("Seleccione Serie Comprobante");
    }
}
function CerrarpoppackBoletas() {
    Windows.close("Div_EtiquetaAtributoSerie", '');
    mantenimientoCaja();
}


function eliminarComprobante(iIdCajaComprobante) {

    var patronModulo = 'eliminarCajaComprobante';

    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iIdCajaComprobante;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            alert("Eliminado Correctamente");
            mantenimientoCaja();
        }
    });
}

function editarComprobante(fila) {

    var tablax = $('tblTipoComprobante');
    var codigoComprobante = tablax.tBodies[0].rows[fila].cells[0].innerHTML;
    var b_flag = tablax.tBodies[0].rows[fila].cells[1].innerHTML;
    var b_serie_act = tablax.tBodies[0].rows[fila].cells[2].innerHTML;
    var c_caja = tablax.tBodies[0].rows[fila].cells[3].innerHTML;
    var descSerie = tablax.tBodies[0].rows[fila].cells[4].innerHTML;
    var serie = tablax.tBodies[0].rows[fila].cells[5].innerHTML;
    var c_nro_act = tablax.tBodies[0].rows[fila].cells[6].innerHTML;

    posFuncion = "CargarEstado(" + b_serie_act + ")";
    vtitle = "";
    vformname = 'EtiquetaBoletaEdita';
    vwidth = '600';
    vheight = '400';
    patronModulo = 'poppackBoletasEdita';
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
    parametros = '';
    parametros += 'p1=' + patronModulo + '&p2=' + codigoComprobante + '&p3=' + c_caja + '&p4=' + serie + '&p5=' + descSerie + '&p6=' + c_nro_act;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}
function CargarEstado(b_serie_act) {
    if (b_serie_act == 1) {
        document.getElementById("ckEstadoComprobante").checked = true;
        $("ckEstadoComprobante").value = 1;
    } else {
        document.getElementById("ckEstadoComprobante").checked = false;
        $("ckEstadoComprobante").value = 0;
    }
}
function modificarSerieEstado() {
    var numeroCaja = $("htxtNumeroCaja").value;
    var serieAntigua = $("htxtSerie").value;
    var codigoComprobante = $("htxtCodigoComprobante").value;
    var c_nro_act = trim($("txtC_nro_act").value);
    var estadoserie;

    var serieNuevba = trim($("txtSerie").value);
    if (serieNuevba.length < 3) {
        var longitudCadena1 = (3 - serieNuevba.length);
        for (var j = 0; j < longitudCadena1; j++) {
            serieNuevba = "0" + serieNuevba;
        }
    }
    var serieNuevba = $("txtSerie").value;
    if (c_nro_act.length < 7) {
        var longitudCadena = (7 - c_nro_act.length);
        for (var i = 0; i < longitudCadena; i++) {
            c_nro_act = "0" + c_nro_act;
        }

    }
    if (document.getElementById("ckEstadoComprobante").checked == true) {
        estadoserie = 1;
    } else {
        document.getElementById("ckEstadoComprobante").checked = false;
        estadoserie = 0;
    }
    //    alert(estadoserie);
    form = "";
    destino = "";
    funcion = "refrescarTablaResibo";
    parametros = "p1=modificarSerieEstado&p2=" + numeroCaja + '&p3=' + serieAntigua + '&p4=' + codigoComprobante + '&p5=' + estadoserie + '&p6=' + serieNuevba
            + '&p7=' + c_nro_act;
    enviarFormulario(form, parametros, funcion, destino);
}

function refrescarTablaResibo() {
    Windows.close("Div_EtiquetaBoletaEdita", '');
    mantenimientoCaja();
}
///////////////////////////////////////////// jorge ///////////////////////
//function DesactivarCoordinador(){
//    var mes=$("cboMesCoordinador").value;
//    var decripcion=$("txtDecripcion").value;
//    var anio=$("cboAnio").value;
//    var form="";
//    var destino="";
//    var funcion="";
//    var parametros="p1=DesactivarCoordinador&p2="+mes+'&p3='+decripcion+'&p4='+anio;
//    enviarFormulario(form,parametros,funcion,destino);
//}
//
//function ActivarCoordinador(){
//    var mes=$("cboMesCoordinador").value;
//    var decripcion=$("txtDecripcion").value;
//    var anio=$("cboAnio").value;
//    var form="";
//    var destino="";
//    var funcion="";
//    var parametros="p1=ActivarCoordinador&p2="+mes+'&p3='+decripcion+'&p4='+anio;
//    enviarFormulario(form,parametros,funcion,destino);
//}

//function reporteEmpleado(){
//
//scrollTo(pixelsX,pixelsY)
//    var iCodEmpCoordinador=$("hICodEmpCoordinador").value;
//    var anio=$("cboAnio").value;
//    var mes=$("cboMes").value;
//    var annoActual=$("hAnnoActual").value;
//    var mesActual=$("hMesActual").value;
//    var horaActual=$("hHoraActual").value;
//    var minutosActual=$("hMinutosActual").value;
//    var form="";
//    var destino="divAreaEmpleado";
//    var funcion="";
//    var parametros="p1=reporteEmpleado&p2="+iCodEmpCoordinador+'&p3='+anio+'&p4='+mes
//    +'&p5='+annoActual+'&p6='+mesActual+'&p7='+horaActual+'&p8='+ minutosActual;
//    enviarFormulario(form,parametros,funcion,destino);
//}



//    var tablax = $('tblTipoComprobante');
//    nomPaciente = tablax.tBodies[0].rows[fila].cells[2].innerHTML;
//    edad= tablax.tBodies[0].rows[fila].cells[3].innerHTML;
//    sexo= tablax.tBodies[0].rows[fila].cells[4].innerHTML;
//     codigoPaciente= tablax.tBodies[0].rows[fila].cells[29].innerHTML;
//
//
//function programacionPersonal(filaArea, filaEmpleado){
//    var tablax = $('tblProgramacionPersonal'+filaArea);
//    var codigoPreProgramacion = tablax.tBodies[filaEmpleado].rows[0].cells[0].innerHTML;
//    var codigoSedeEmpresaArea = tablax.tBodies[filaEmpleado].rows[0].cells[1].innerHTML;
//    var nombreEmpleado = tablax.tBodies[filaEmpleado].rows[0].cells[3].innerHTML;
//    var puestoEmpleado = tablax.tBodies[filaEmpleado].rows[0].cells[2].innerHTML;
//    var iCodigoEmpleado = tablax.tBodies[filaEmpleado].rows[0].cells[4].innerHTML;
//    var nNumeroProgramacionesXmes = tablax.tBodies[filaEmpleado].rows[0].cells[7].innerHTML;
//    var nombreAreaSede = $('hNombreAreaSede'+filaArea).value;
//
//
//    var posFuncion = "cargarDatosCodigoPreProgramacion_CodigoSedeAreaTurno("+codigoPreProgramacion+")";
//    var vtitle="";
//    var vformname='VentanaTurnos';
//    var vwidth='680';
//    var vheight='320';
//    var patronModulo='poppackSeleccionarTunosProgramar';
//    var vcenter='t';
//    var vresizable='';
//    var vmodal='false';
//    var vstyle='';
//    var vopacity='';
//    var veffect='';
//    var  vposx1='';
//    var  vposx2='';
//    var  vposy1='';
//    var  vposy2='';
//    var parametros='';
//    parametros+='p1='+patronModulo+'&p2='+codigoPreProgramacion +'&p3='+ codigoSedeEmpresaArea.trim()+'&p4='+ nombreEmpleado +'&p5='+ nombreAreaSede
//    +'&p6='+ puestoEmpleado+'&p7='+  iCodigoEmpleado+'&p8='+ nNumeroProgramacionesXmes;
//    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
//
//}
//function cargarDatosCodigoPreProgramacion_CodigoSedeAreaTurno(codigoPreProgramacion){
//    $("hPreprogramacionPersonal").value=codigoPreProgramacion;
//
//}
//
//function accionCalendarioProgramacionEmpleados(idAccion,cal){
//    arrayInput = document.getElementById(cal).getElementsByTagName("input");
//    fechaActual = arrayInput[20].value+arrayInput[19].value+arrayInput[18].value;
//    pathLink = "p1=calendario02&p2="+fechaActual+"&p3="+idAccion;
//    new Ajax.Request( pathRequestControl,{
//        method : 'get',
//        parameters : pathLink,
//        onLoading : micargador(1),
//        onComplete : function(transport){
//            micargador(0);
//            respuesta = transport.responseText.split("|");
//            fechaActual2 = respuesta[1];
//            document.getElementById("hFechaSeleccionada").value=fechaActual2;
//            document.getElementById("hFechasAProgramar").value = "";
//            document.getElementById("divCalendario").update(respuesta[0]);
//        }
//    })
//}
//
//function seleccionarFechaProgramacionEmpleado(idElemento,cal){
//    diaSel = idElemento.split("-")[1];
//    nomIdDia = cal+"-" + diaSel;
//    arrayInput = document.getElementById(cal).getElementsByTagName("input");
//    fechaActual = arrayInput[20].value+"-"+arrayInput[19].value+"-"+idElemento.split("-")[1];
//    cadena = document.getElementById("hFechasAProgramar").value;
//
//    estilo = document.getElementById(nomIdDia).className.valueOf();
//    switch(estilo){
//        case "estiloCasillaSeleccionada":
//            document.getElementById(nomIdDia).className = "btnCalendario";
//            if (cadena.indexOf(fechaActual+"|")!=-1) {
//                cadena = cadena.replace(fechaActual+"|",'');
//            }
//            if (cadena.indexOf(fechaActual)!=-1) {
//                cadena = cadena.replace("|"+fechaActual,'');
//                cadena = cadena.replace(fechaActual,'');
//            }
//            document.getElementById("hFechasAProgramar").value = cadena;
//            break;
//        case "btnCalendario":
//            document.getElementById('hFechaSeleccionada').value = arrayInput[20].value+"-"+arrayInput[19].value+"-"+diaSel;
//            arrayInput[18].value=diaSel;
//            if(cadena == "")
//                cadena = fechaActual;
//            else
//                cadena = cadena +"|"+ fechaActual;
//            document.getElementById("hFechasAProgramar").value = cadena;
//
//
//            document.getElementById(nomIdDia).className = "estiloCasillaSeleccionada";
//            break;
//    }
//}

/*******************************************************************************************************/
/*************************** Regularizacion de Horarios   **********************************************/
/*******************************************************************************************************/
/***************************Jose Delgado 10-04-2012 12pm************************************************/
varBusquedaEmpleado = '';
function podpadBusquedaEmpleado() {
    varBusquedaEmpleado = '0';
    var posFuncion = "";
    var vtitle = "<h2>BUSQUEDA DE EMPLEADO</h2>";
    var vformname = 'podpadBusquedaEmpleado';
    var vwidth = '940';
    var vheight = '320';
    //'nuevaSubArea' llama al control y luego al actionRRHH y carga la vista vGuardarArea
    var patronModulo = 'podpadBusquedaEmpleado';
    var vcenter = 't';
    var vresizable = ''
    var vmodal = 'false';
    var vstyle = '';
    var vopacity = '';
    var veffect = '';
    var vposx1 = '';
    var vposx2 = '';
    var vposy1 = '';
    var vposy2 = '';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

}

////////////////////////////////////lobo ///////////////////////////////////////////////--
////////////////////////////////////lobo ///////////////////////////////////////////////--
////////////////////////////////////lobo ///////////////////////////////////////////////--
//function seleccionarFechasPorDiaEmpleado(elementoCheck,numDiaDeLaSemana,cal){ // check del calendario
//    fechasPorDia=$("dia"+numDiaDeLaSemana).value;
//    dias=fechasPorDia.split("-");
//    numDias=dias.length;
//    var i;
//    arrayInput = document.getElementById(cal).getElementsByTagName("input");
//    cadenaFechasSeleccionadas = document.getElementById("hFechasAProgramar").value;
//
//    if(elementoCheck.checked){//Si se seleccionan todos los dias
//        for(i=0; i<numDias; i++){
//            nomIdDia = cal+"-" + dias[i];
//            fecha = arrayInput[20].value+"-"+arrayInput[19].value+"-"+dias[i];//año-mes-dia
//            if(cadenaFechasSeleccionadas == ""){
//                cadenaFechasSeleccionadas = fecha;
//            }
//            else{
//                //Eliminamos por si la fecha ya fue insertada anteriormente
//                if (cadenaFechasSeleccionadas.indexOf(fecha+"|")!=-1) {
//                    cadenaFechasSeleccionadas = cadenaFechasSeleccionadas.replace(fecha+"|",'');
//                }
//                if (cadenaFechasSeleccionadas.indexOf(fecha)!=-1) {
//                    cadenaFechasSeleccionadas = cadenaFechasSeleccionadas.replace("|"+fecha,'');
//                    cadenaFechasSeleccionadas = cadenaFechasSeleccionadas.replace(fecha,'');
//                }
//                //Insertamos la nueva fecha
//                cadenaFechasSeleccionadas = cadenaFechasSeleccionadas +"|"+ fecha;
//            }
//            //            alert(cadenaFechasSeleccionadas);
//            document.getElementById("hFechasAProgramar").value = cadenaFechasSeleccionadas;
//            document.getElementById(nomIdDia).className = "estiloCasillaSeleccionada";
//        }
//    }
//    else{//Si se deseleccionan todos los dias
//        for(i=0; i<numDias; i++){
//            nomIdDia = cal+"-" + dias[i];
//            fecha = arrayInput[20].value+"-"+arrayInput[19].value+"-"+dias[i];//año-mes-dia
//
//            if (cadenaFechasSeleccionadas.indexOf(fecha+"|")!=-1) {
//                cadenaFechasSeleccionadas = cadenaFechasSeleccionadas.replace(fecha+"|",'');
//            }
//            if (cadenaFechasSeleccionadas.indexOf(fecha)!=-1) {
//                cadenaFechasSeleccionadas = cadenaFechasSeleccionadas.replace("|"+fecha,'');
//                cadenaFechasSeleccionadas = cadenaFechasSeleccionadas.replace(fecha,'');
//            }
//            document.getElementById("hFechasAProgramar").value = cadenaFechasSeleccionadas;
//            document.getElementById(nomIdDia).className = "btnCalendario";
//        }
//    }
//}
//// fin de jorge
function buscarEmpleadosX($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre) {
    //alert(varBusquedaEmpleado);
    if ($apPat.trim() != '' || $apMat.trim() != '' || $nombre.trim() != '' || $nDoc.trim() != '' || $cod.trim() != '') {

        var patronModulo = "buscaEmpleado";
        cod = $cod;
        estado = $estado;
        if (($estado) == '0001' || ($estado) == '0000') {
            estado = '';
        }
        if (($estado) == '0002') {
            estado = 1;
        }
        if ($estado == '0003') {
            estado = 0;
        }
        tipoDoc = $tipoDoc;
        nDoc = $nDoc;
        apPat = $apPat;
        apMat = $apMat;
        nombre = $nombre;
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + cod;
        parametros += '&p3=' + estado;
        parametros += '&p4=' + tipoDoc;
        parametros += '&p5=' + nDoc;
        parametros += '&p6=' + apPat;
        parametros += '&p7=' + apMat;
        parametros += '&p8=' + nombre;

        //parametros="p1=datosExamenPrueba&p2="+idExamen;
        tablaEmpleados = new dhtmlXGridObject('divTablaResultadosEmpleados');
        tablaEmpleados.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
        tablaEmpleados.setSkin("dhx_skyblue");
        tablaEmpleados.enableRowsHover(true, 'grid_hover');
        //tablaEmpleados.attachEvent("onRowSelect",seleccionarEmpleadoX)
        tablaEmpleados.attachEvent("onRowSelect", function (rowId, cellInd) {
            switch (varBusquedaEmpleado) {
                case '0':
                    seleccionarEmpleadoX();
                    break;
                case '1':
                    asignarUsuarioXPuntoControl();
                    break;
                    // default: alert("ninguna opcion"); break;    
            }
        });
        //    mygridX.attachEvent("onRowDblClicked", dbclickeditarPrueba);
        tablaEmpleados.init();
        tablaEmpleados.loadXML(pathRequestControl + '?' + parametros);
    } else {
        alert("Llene al menos un campo")
    }
}

//function Cerrar_programacionPorDiaSinTurno(){
//    alert("cerrar");
//     Windows.close("Div_VentanaTurnos", '');
//}
/// fin de jorge
//    var tablax = $('tblTipoComprobante');
//    nomPaciente = tablax.tBodies[0].rows[fila].cells[2].innerHTML;
//    edad= tablax.tBodies[0].rows[fila].cells[3].innerHTML;
//    sexo= tablax.tBodies[0].rows[fila].cells[4].innerHTML;
//     codigoPaciente= tablax.tBodies[0].rows[fila].cells[29].innerHTML;





////////////////////////////////////////

function GuardarNumeroComprobante(fila) {
    var numeroComprobante = $("ckComprobante_" + fila).value;
    var ckEstadoComprobante = document.getElementById("ckComprobante_" + fila).checked
    var cadena = $("htxtcodigoComprobante").value;
    if (ckEstadoComprobante == true) {
        if (trim(cadena) == '') {
            cadena = numeroComprobante;
            $("htxtcodigoComprobante").value = cadena
        } else {
            cadena = cadena + '|' + numeroComprobante;
            $("htxtcodigoComprobante").value = cadena;
        }
    } else {
        cadena = cadena.replace(numeroComprobante, "");
        $("htxtcodigoComprobante").value = cadena;
    }
}

function GuardarSerieComprobante(fila) {

    var serieComprobante = $("htxtSerieComprobante").value;
    var presSerieComprobante = $("htxtPreSerieComprobante").value;

    if (trim($("txtSerieComprobante_" + fila).value) != '') {

        if (trim(serieComprobante) == '') {
            serieComprobante = trim($("txtSerieComprobante_" + fila).value) + '*' + $("ckComprobante_" + fila).value;
        } else {
            serieComprobante = serieComprobante + '|' + trim($("txtSerieComprobante_" + fila).value) + '*' + $("ckComprobante_" + fila).value;
            if (trim(presSerieComprobante) != '') {
                serieComprobante = serieComprobante.replace(presSerieComprobante,
                        trim($("txtSerieComprobante_" + fila).value) + '*' + $("ckComprobante_" + fila).value);
            }

            $("htxtSerieComprobante").value = serieComprobante;
        }

        alert(serieComprobante);
        //        PreGuardarSerieComprobante(fila);
    }
//    var serieComprobante=$("txtSerieComprobante_"+fila).value;

}

function PreGuardarSerieComprobante(fila) {
    if ($("txtSerieComprobante_" + fila).value.trim() != '') {
        //        alert("Presee");
        $("htxtPreSerieComprobante").value = $("txtSerieComprobante_" + fila).value + '*' + $("ckComprobante_" + fila).value + '-' + fila;
    }

}
function guardarCajero() {
    var cadena = $("htxtcodigoComprobante").value;
    var usuario = $("htxtUsuario").value;
    var numeroCaja = $("htxtNumeroCaja").value;
    var c_cod_per = $("txtCodPer").value;

    var datos = cadena.split("|");

    for (var i = 0; i < datos.length; i++) {
        //       alert (datos[i]);
        if (trim(datos[i]) != '') {
            //       alert("Comprombante:"+datos[i]+"  Usuario:"+usuario+"  Numero Caja:"+numeroCaja+' Codgio Persona:'+c_cod_per);

            form = "";
            destino = "";
            funcion = "";
            parametros = "p1=guardarCajero&p2=" + trim(datos[i]) + '&p3=' + usuario + '&p4=' + numeroCaja + '&p5=' + c_cod_per;
            enviarFormulario(form, parametros, funcion, destino);
        }
    }

//alert("Comprombante:"+cadena+"  Usuario:"+usuario+"  Numero Caja:"+numeroCaja+' Codgio Persona:'+c_cod_per);
}







function seleccionarEmpleadoX(id, cell) {
    var codEmp = tablaEmpleados.cells(tablaEmpleados.getSelectedId(), 0).getValue();
    var codPer = tablaEmpleados.cells(tablaEmpleados.getSelectedId(), 1).getValue();
    var nombre = tablaEmpleados.cells(tablaEmpleados.getSelectedId(), 2).getValue();
    $('txthidCodigoPersona').value = codPer;
    $('txthidCodigoEmpleado').value = codEmp;
    $('txthidNombreCompletoPersona').value = nombre;
    $('div_NombreCompleto').innerHTML = '<h1>' + codPer + ' ' + nombre + '</h1>';

    Windows.close("Div_podpadBusquedaEmpleado", "");
}

function limpiaBusquedasX(opc, elemento, evento) {
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
    } else {
        tecla = evento.keyCode
    }
    if (tecla == 13) {
        $cod = document.getElementById('txtCodigo').value;
        $estado = document.getElementById('comboTipoEstados').value;
        $tipoDoc = document.getElementById('comboTipoDocumentos').value;
        $nDoc = document.getElementById('nroDoc').value;
        $apPat = document.getElementById('apellidoPaterno').value;
        $apMat = document.getElementById('apellidoMaterno').value;
        $nombre = document.getElementById('nombres').value;
        buscarEmpleadosX($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre);
    }
}


function fechaActual() {
    var today = new Date();
    var yyyy = today.getFullYear();
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    today = dd + '/' + mm + '/' + yyyy;
    return today;
}

function fechaPrimeroMes() {
    var today = fechaActual();
    today = today.substring(2);
    today = '01' + today;
    return today;
}

function cargaFechas() {
    document.getElementById('txtFechaIni').value = fechaPrimeroMes();
    document.getElementById('txtFechaFinal').value = fechaActual()
}

//resta la fecha f2-f1 (f1,f2)
var DateDiff = {

    inDays: function (d1, d2) {
        var t2 = d2.getTime();
        var t1 = d1.getTime();

        return parseInt((t2 - t1) / (24 * 3600 * 1000));
    },

    inWeeks: function (d1, d2) {
        var t2 = d2.getTime();
        var t1 = d1.getTime();

        return parseInt((t2 - t1) / (24 * 3600 * 1000 * 7));
    },

    inMonths: function (d1, d2) {
        var d1Y = d1.getFullYear();
        var d2Y = d2.getFullYear();
        var d1M = d1.getMonth();
        var d2M = d2.getMonth();

        return (d2M + 12 * d2Y) - (d1M + 12 * d1Y);
    },

    inYears: function (d1, d2) {
        return d2.getFullYear() - d1.getFullYear();
    }
}

function toMMDDYYYY(fecha) {
    var dd = fecha.substring(0, 2);
    var mm = fecha.substring(3, 5);
    var yy = fecha.substring(6);
    return mm + '/' + dd + '/' + yy;
}

var fechaIni;
var fechaFin;
function validaFechaDentro30Dias(strFechaFin, strFechaIni) {
    fechaIni = "";
    fechaFin = "";
    strFechaFin = strFechaFin.trim();
    strFechaIni = strFechaIni.trim();
    fechaFin = strFechaFin;
    fechaIni = strFechaIni;
    if (validaFecha(strFechaIni) == 1 && validaFecha(strFechaFin) == 1) {
        var i = new Date(toMMDDYYYY(strFechaIni));
        var f = new Date(toMMDDYYYY(strFechaFin));
        var rs;
        if (i != undefined && f != undefined) {
            rs = DateDiff.inDays(i, f);
            if (rs >= 0 && rs <= 31) {
                return 1;
            } else {
                if (rs > 30) {
                    if (cambioFecha == 1) {
                        alert("La diferencia de fechas es mayor a un mes la fecha inicial se disminuyo en 30 dias respecto a la fecha final");
                        fechaIni = sumaFechas(f, 0);
                        document.getElementById('txtFechaIni').value = fechaIni;

                    } else {
                        if (cambioFecha == 0) {
                            alert("La diferencia de fechas es mayor a un mes la fecha final se aumento en 30 dias respecto a la fecha inicial");
                            fechaFin = sumaFechas(i, 1);
                            document.getElementById('txtFechaFinal').value = fechaFin;
                        }
                    }
                    return 0;
                } else {
                    if (cambioFecha == 1) {
                        alert("La fecha Inicial debe ser menor a la fecha Final la fecha inicial se disminuyo en 30 dias respecto a la fecha final");
                        fechaIni = sumaFechas(f, 0);
                        document.getElementById('txtFechaIni').value = fechaIni;
                    } else {
                        if (cambioFecha == 0) {
                            alert("La fecha Inicial debe ser menor a la fecha Final la fecha final se aumento en 30 dias respecto a la fecha inicial");
                            fechaFin = sumaFechas(i, 1);
                            document.getElementById('txtFechaFinal').value = fechaFin;
                        }
                    }
                    return -1;
                }

            }

        } else {
            alert("Ingrese fechas validas dd/mm/yyyy");
            cargaFechas();
            return -2;
        }
    } else {
        if (strFechaIni == "" && validaFecha(strFechaFin) == 1) {
            alert("Seleccione una fecha Inicial");
        }
        if (validaFecha(strFechaIni) == 1 && strFechaFin == "") {
            alert("Seleccione una fecha Final");
        }
        if (validaFecha(strFechaIni) == 0 && validaFecha(strFechaFin) == 1 && strFechaIni != "") {
            alert("Ingrese bien la fecha inicial dd/mm/yyyy");
            document.getElementById('txtFechaIni').value = '';
        }
        if (validaFecha(strFechaIni) == 1 && validaFecha(strFechaFin) == 0 && strFechaFin != "") {
            alert("Ingrese bien la fecha final dd/mm/yyyy");
            document.getElementById('txtFechaFinal').value = '';
        }
        if (validaFecha(strFechaIni) == 0 && validaFecha(strFechaFin) == 0) {
            alert("Ingrese las fechas dd/mm/yyyy ");
            cargaFechas();
        }
        return -3
    }
}

function sumaFechas(fecha, opc) {
    var auxFecha, dd, mm, yy;
    switch (opc) {
        case 0:
            auxFecha = new Date(fecha.getTime() - 30 * 24 * 3600 * 1000);
            break;
        case 1:
            auxFecha = new Date(fecha.getTime() + 30 * 24 * 3600 * 1000);
            break;
        case 2:
            auxFecha = new Date(fecha.getTime() + 1 * 24 * 3600 * 1000);
            break;
    }
    dd = auxFecha.getDate();
    mm = auxFecha.getMonth() + 1;
    yy = auxFecha.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    if (opc == 2) {
        return yy + '-' + mm + '-' + dd;
    } else {
        return dd + '/' + mm + '/' + yy;
    }
}
var cambioFecha = ""
function estadoCambioFechas(opc) {
    if (opc.trim() == 1) {
        cambioFecha = 1;
    } else {
        cambioFecha = 0;
    }
}

function ActualizarTablaHorarioAsistencia(opcion) {
    var idCodigoPersonaEmpleada = $('txthidCodigoPersonaEmpleada').value;
    var codigoPersona = $("txthidCodigoPersona").value;
    var idTxtAreaObservacion;

    var idMarcacionPersonal;
    var fecha;
    var hora;
    var fechaFinal;
    if (opcion == 1) {
        idMarcacionPersonal = $('txtidMarcacionPersonalEntrada').value;
        fecha = $('txtFechaEntrada').value;
        hora = $('txtHoraEntrada').value;
        idTxtAreaObservacion = $("idTxtAreaObservacionentrada").value;
        fechaFinal = fecha + ' ' + hora;
    } else {
        if (opcion == 2) {
            idMarcacionPersonal = $('txtidMarcacionPersonalSalida').value;
            fecha = $('txtFechaSalida').value;
            hora = $('txtHoraSalida').value;
            idTxtAreaObservacion = $("idTxtAreaObservacionSalida").value;
            fechaFinal = fecha + ' ' + hora;
        }
    }


    var parametros = "p1=ActualizarTablansdHorarioRealesAsistencia&p2=" + idMarcacionPersonal +
            "&p3=" + fechaFinal + "&p4=" + idCodigoPersonaEmpleada + "&p5=" + idTxtAreaObservacion;
    if (trim(idTxtAreaObservacion).length > 5) {
        if (confirmar("Esta seguro que desea realizar los cambios")) {
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                asynchronous: false,
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function (transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    BusquedaEmpleadoHorario(idCodigoPersonaEmpleada, codigoPersona, '');
                }
            })
        }
    } else {
        alert("Falta Ingresar la Observacion");
    }
}


/*******************************************************************************************************/
/************************** Fin Regularización de Horarios   *******************************************/
/*******************************************************************************************************/

/**************************************JCDB 04/05/2012**************************************/
/*****************************************VACACIONES****************************************/
function CargarVentanaPopPapX(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
{
    myRand = parseInt(Math.random() * 999999999999999);
    if (vwidth == undefined || vwidth == 0)
        vwidth = 700;
    if (vheight == undefined || vheight == 0)
        vheight = 400;
    if (vposx1 == undefined || vposx1 == 0)
        vposx1 = 25;
    if (vposy1 == undefined || vposy1 == 0)
        vposy1 = 110;
    if (vposx2 == undefined || vposx2 == 0)
        vposx2 = 25;
    if (vposy2 == undefined || vposy2 == 0)
        vposy2 = 110;

    if (vresizable == undefined || vresizable == 0)
        vresizable = true;
    else
        vresizable = false;
    if (vstyle == undefined || vstyle == 0)
        vstyle = "alphacube";   // fondo y estilo
    //if(veffect==veffect || veffect==0) veffect="popup_effect";
    if (vmodal == undefined || vmodal == 0)
        vmodal = false;
    else
        vmodal = true;
    if (vopacity == undefined || vopacity == 0)
        vopacity = 1;
    if (vcenter == undefined || vcenter == 0 || vcenter == 't')
        vcenter = true;
    else
        vcenter = false;
    if (vtitle == undefined)
        vtitle = vformname;
    if (!ExisteObjeto("Div_" + vformname))
    {
        var vidfrm;
        // file02=decodeURIComponent(file02);
        var vid = "Div_" + vformname;
        vidfrm = "Frm_" + vformname;
        var vzindex = 100;
        var win;
        if (vmodal == true || vmodal == 1)
            win = new Window({
                id: vid,
                className: vstyle,
                title: vtitle,
                width: vwidth,
                height: vheight,
                zIndex: vzindex,
                opacity: vopacity,
                resizable: vresizable
            });
        else
            win = new Window({
                id: vid,
                className: vstyle,
                title: vtitle,
                width: vwidth,
                height: vheight,
                resizable: vresizable
            });
        win.getContent().innerHTML = "<div id='" + vidfrm + "'></div>";
        //win.getContent().innerHTML = "<h1>No Constraint</h1>Wired mode<br><a href='#' onclick='Windows.getWindow(\"win3\").maximize()'>Maximize me</a>";
        win.setDestroyOnClose();
        if (vcenter == true || vcenter == 1)
            win.showCenter(vmodal);
        else
            win.show(vmodal);
        win.setConstraint(true, {
            left: vposx1,
            right: vposx2,
            top: vposy1,
            bottom: 'auto'
        })
        win.toFront();

        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);

                respuesta = transport.responseText;
                $(vidfrm).update(respuesta);
                //posFuncion+="('')";
                //alert(posFuncion);
                eval(posFuncion);
            }
        })
    }
}
function vacaciones() {
    //alert(x+' '+y)
    //tablaContratos.cells(i,6).getValue();
    if (tablaContratos.cells(tablaContratos.getSelectedId(), 6).getValue() == 1) {
        var posFuncion = "obtenerTablaDescansoContratoPuesto";
        var vtitle = "ASIGNACION DE VACIONES";
        var vformname = 'popadAsignacionVacaciones';
        var vwidth = '925';
        var vheight = '300';
        var patronModulo = 'poppadVacaciones';
        var vcenter = 't';
        var vresizable = ''
        var vmodal = 'false';
        var vstyle = '';
        var vopacity = '';
        var vposx1 = '';
        var vposx2 = '';
        var vposy1 = '';
        var vposy2 = '';
        var parametros = '';
        parametros += 'p1=' + patronModulo//+'&p2='+c_cod_per;
        CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
    } else {
        alert("El contrato se encuentra encuentra inhabilitado");
    }
}

function obtenerTablaDescansoContratoPuesto() {
    //alert("x="+x+", y="+y);
    document.getElementById('Div_popadAsignacionVacaciones_content').style.overflow = "hidden";
    var parametros = '';
    parametros += 'p1=tablaDescansoContratoEmpleado';
    parametros += '&codEmp=' + document.getElementById('txtcodigoEmpleado').value.trim();
    parametros += '&idContrato=' + tablaContratos.cells(tablaContratos.getSelectedId(), 0).getValue();
    tablaDescansoContratoPuesto = new dhtmlXGridObject('idDivTablaRegistroVacaciones');
    tablaDescansoContratoPuesto.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaDescansoContratoPuesto.setSkin("dhx_skyblue");
    tablaDescansoContratoPuesto.enableRowsHover(true, 'grid_hover');
    tablaDescansoContratoPuesto.attachEvent("onRowSelect", function (x, y) {
        if (y == 12) {
            if (tablaDescansoContratoPuesto.cells(tablaDescansoContratoPuesto.getSelectedId(), 11).getValue() == 1) {
                nuevaVacacion(2);
            } else {
                alert("El contrato se encuentra encuentra inhabilitado");
            }
        }
        if (y == 13) {
            eliminarDescanso()
        }
    })
    tablaDescansoContratoPuesto.attachEvent("onXLE", function () {
        for (var i = 0; i < tablaDescansoContratoPuesto.getRowsNum(); i++) {
            var estado = tablaDescansoContratoPuesto.cells(i, 11).getValue();
            if (estado == '1')
                tablaDescansoContratoPuesto.setRowTextStyle(tablaDescansoContratoPuesto.getRowId(i), 'background-color:' + tablaDescansoContratoPuesto.cells(i, 10).getValue() + ';color:black;border-top: 1px solid #DAEFC2;');
            else if (estado == '0')
                tablaDescansoContratoPuesto.setRowTextStyle(tablaDescansoContratoPuesto.getRowId(i), 'background-color:#D12521;color:black;border-top: 1px solid #FFD7BB;');
        }
    });
    tablaDescansoContratoPuesto.init();
    tablaDescansoContratoPuesto.loadXML(pathRequestControl + '?' + parametros);
}

function eliminarDescanso() {
    if (window.confirm("¿Está seguro que desea eliminar el registro?")) {
        var parametros = "p1=eliminarVacaciones&p2=" + tablaDescansoContratoPuesto.cells(tablaDescansoContratoPuesto.getSelectedId(), 2).getValue()
        //alert(parametros);
        var datosx = traerData(parametros);
        //alert(datosx[0]);
        if (datosx[0].trim() == '1') {
            alert("El registro se elimino");
            obtenerTablaDescansoContratoPuesto();
        } else if (datosx[0] != '1') {
            alert("Error al eliminar,intentelo nuevamente");
        }
    }
}
function nuevaVacacion(op1) {
    //alert("hola");
    var posFuncion = ""
    if (op1 == '1') {
        posFuncion = "posNuevaVacacion";
    } else if (op1 == '2') {
        posFuncion = "posEditarVacacion";
    }
    var vtitle = "FORMULARIO DE DESCANSO";
    var vformname = 'popadAsignacionVacacionesMantenimiento';
    var vwidth = '580';
    var vheight = '232';
    var patronModulo = 'poppadVacacionesMantenimiento';
    var vcenter = 't';
    var vresizable = ''
    var vmodal = 'false';
    var vstyle = '';
    var vopacity = '';
    var vposx1 = '';
    var vposx2 = '';
    var vposy1 = '';
    var vposy2 = '';
    var parametros = '';
    parametros += 'p1=' + patronModulo
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}
function posNuevaVacacion() {
    document.getElementById('txtIdContrato').value = tablaContratos.cells(tablaContratos.getSelectedId(), 0).getValue();
    document.getElementById('txtPuesto').value = tablaContratos.cells(tablaContratos.getSelectedId(), 1).getValue();
    document.getElementById('txtFechaInicioContrato').value = tablaContratos.cells(tablaContratos.getSelectedId(), 2).getValue();
    document.getElementById('txtFechaFinContrato').value = tablaContratos.cells(tablaContratos.getSelectedId(), 3).getValue();
}

function guardarVacaciones() {
    var idContrato = document.getElementById('txtIdContrato').value;
    var fechaInicioVacacion = document.getElementById('txtFechaInicioVacacion').value;
    var fechaFinVacacion = document.getElementById('txtFechaFinVacacion').value;

    if (validarQueNoExitaProgramacion(idContrato, fechaInicioVacacion, fechaFinVacacion) == 0) {
        if (validarFechasVacaciones() == 1) {
            var parametros = "p1=guardarVacaciones&p2=" + document.getElementById('txtIdContrato').value
                    + "&p3=" + document.getElementById('cboTipoDescanso').value
                    + "&p4=" + document.getElementById('txtFechaInicioVacacion').value
                    + "&p5=" + document.getElementById('txtFechaFinVacacion').value;
            //alert(parametros);
            var datosx = traerData(parametros);
            //alert(datosx[0]);
            if (datosx[0].trim() == '1') {
                $('idDivGuardarVacaciones').hide();
                $('idDivCerrarVacaciones').show();
                $('resultadoVacaciones').innerHTML = '<p style="color: blue; font-weight: bold;">El registro fue guardado con exito.</p>';
                obtenerTablaDescansoContratoPuesto();
            } else if (datosx[0] != '1') {
                $('resultadoVacaciones').innerHTML = '<p style="color: red; font-weight: bold;">Error al guardar,intentelo nuevamente.</p>';
            }
        }
    }
}
function cerrarVacaciones() {
    Windows.close("Div_popadAsignacionVacacionesMantenimiento");
}

function posEditarVacacion() {
    $('idDivGuardarVacaciones').hide();
    $('idDivModificarVacaciones').show();
    $('idDivCerrarVacaciones').hide();
    document.getElementById('txtIdContrato').value = tablaDescansoContratoPuesto.cells(tablaDescansoContratoPuesto.getSelectedId(), 1).getValue();
    document.getElementById('cboTipoDescanso').value = tablaDescansoContratoPuesto.cells(tablaDescansoContratoPuesto.getSelectedId(), 3).getValue();
    document.getElementById('txtPuesto').value = tablaDescansoContratoPuesto.cells(tablaDescansoContratoPuesto.getSelectedId(), 4).getValue();
    document.getElementById('txtFechaInicioContrato').value = tablaDescansoContratoPuesto.cells(tablaDescansoContratoPuesto.getSelectedId(), 6).getValue();
    document.getElementById('txtFechaFinContrato').value = tablaDescansoContratoPuesto.cells(tablaDescansoContratoPuesto.getSelectedId(), 7).getValue();
    document.getElementById('txtFechaInicioVacacion').value = tablaDescansoContratoPuesto.cells(tablaDescansoContratoPuesto.getSelectedId(), 8).getValue();
    document.getElementById('txtFechaFinVacacion').value = tablaDescansoContratoPuesto.cells(tablaDescansoContratoPuesto.getSelectedId(), 9).getValue();
}
function actualizarVacaciones() {

    var parametros = "p1=eliminarVacaciones&p2=" + tablaDescansoContratoPuesto.cells(tablaDescansoContratoPuesto.getSelectedId(), 2).getValue()
    traerData(parametros);
    var parametros1 = "p1=guardarVacaciones&p2=" + document.getElementById('txtIdContrato').value
            + "&p3=" + document.getElementById('cboTipoDescanso').value
            + "&p4=" + document.getElementById('txtFechaInicioVacacion').value
            + "&p5=" + document.getElementById('txtFechaFinVacacion').value;
    //alert(parametros);
    var datosx1 = traerData(parametros1);
    alert(datosx1[0]);
    if (datosx1[0].trim() == '1') {
        $('idDivModificarVacaciones').hide();
        $('idDivCerrarVacaciones').show();
        $('resultadoVacaciones').innerHTML = '<p style="color: blue; font-weight: bold;">El registro fue actualizado con exito.</p>';
        obtenerTablaDescansoContratoPuesto();
    } else if (datosx1[0] != '1') {
        $('resultadoVacaciones').innerHTML = '<p style="color: red; font-weight: bold;">Error al actualizar,intentelo nuevamente.</p>';

        if (validarFechasVacaciones() == 1) {
            var parametros = "p1=eliminarVacaciones&p2=" + tablaDescansoContratoPuesto.cells(tablaDescansoContratoPuesto.getSelectedId(), 2).getValue()
            traerData(parametros);
            var parametros1 = "p1=guardarVacaciones&p2=" + document.getElementById('txtIdContrato').value
                    + "&p3=" + document.getElementById('cboTipoDescanso').value
                    + "&p4=" + document.getElementById('txtFechaInicioVacacion').value
                    + "&p5=" + document.getElementById('txtFechaFinVacacion').value;
            //alert(parametros);
            var datosx1 = traerData(parametros1);
            //alert(datosx1[0]);
            if (datosx1[0].trim() == '1') {
                $('idDivModificarVacaciones').hide();
                $('idDivCerrarVacaciones').show();
                $('resultadoVacaciones').innerHTML = '<p style="color: blue; font-weight: bold;">El registro fue actualizado con exito.</p>';
                obtenerTablaDescansoContratoPuesto();
            } else if (datosx1[0] != '1') {
                $('resultadoVacaciones').innerHTML = '<p style="color: red; font-weight: bold;">Error al actualizar,intentelo nuevamente.</p>';
            }

        }
    }
}
//dd/mm/yyyy
var sms
function diferenciaFecha(txtFechaIni, txtFechaFin, opc) {
    sms = "";
    txtFechaIni = txtFechaIni.trim();
    txtFechaFin = txtFechaFin.trim();
    if (validaFecha(txtFechaIni) == 1 && validaFecha(txtFechaFin) == 1) {
        var i = new Date(toMMDDYYYY(txtFechaIni));
        var f = new Date(toMMDDYYYY(txtFechaFin));
        var rs;
        if (i != undefined && f != undefined) {
            rs = DateDiff.inDays(i, f);
            return rs;
        } else
            return '-1';
    } else {
        if (opc == 0) {
            return '-1';
        } else {
            if (txtFechaIni == "" && validaFecha(txtFechaFin) == 1) {
                sms = "Ingrese la fecha Inicial de Descanso";
            }
            if (validaFecha(txtFechaIni) == 1 && txtFechaFin == "") {
                sms = "Ingrese la fecha Final de Descanso";
            }
            if (validaFecha(txtFechaIni) == 0 && validaFecha(txtFechaFin) == 1 && txtFechaIni != "") {
                sms = "Ingrese bien la fecha inicial de Descanso dd/mm/yyyy";
                document.getElementById('txtFechaInicioContrato').value = '';
            }
            if (validaFecha(txtFechaIni) == 1 && validaFecha(txtFechaFin) == 0 && txtFechaIni != "") {
                sms = "Ingrese bien la fecha final de Descanso dd/mm/yyyy";
                document.getElementById('txtFechaFinVacacion').value = '';
            }
            if (validaFecha(txtFechaIni) == 0 && validaFecha(txtFechaFin) == 0 && txtFechaIni != "" && txtFechaFin != "") {
                sms = "Ingrese bien las fechas de Descanso dd/mm/yyyy ";
            }
            if (txtFechaIni == "" && txtFechaFin == "") {
                sms = "Ingrese las fechas de Descanso";
            }
            return '-1'
        }
    }
}
function validarFechasVacaciones() {
    var sms1 = "Las fechas de descanso deben estar dentro del rango de la fecha de contrato";
    var sms2 = "Seleccione un tipo de descanso";
    if (tablaContratos.cells(tablaContratos.getSelectedId(), 6).getValue() == 1) {
        if (document.getElementById('txtFechaInicioContrato').value.trim() != "" && document.getElementById('txtFechaFinContrato').value.trim() != "") {
            if (diferenciaFecha(document.getElementById('txtFechaInicioContrato').value, document.getElementById('txtFechaFinContrato').value, 0) >= 0) {
                if (diferenciaFecha(document.getElementById('txtFechaInicioVacacion').value, document.getElementById('txtFechaFinVacacion').value, 1) >= 0) {
                    if (diferenciaFecha(document.getElementById('txtFechaInicioContrato').value, document.getElementById('txtFechaInicioVacacion').value, 0) >= 0 &&
                            diferenciaFecha(document.getElementById('txtFechaFinVacacion').value, document.getElementById('txtFechaFinContrato').value, 0) >= 0) {
                        sms1 = "";
                        if (document.getElementById('cboTipoDescanso').value != '0000') {
                            return 1;
                        } else {
                            if (document.getElementById('cboTipoDescanso').value == '0000') {
                                alert(sms2);
                            }
                            return 0;
                        }

                    } else {
                        if (document.getElementById('cboTipoDescanso').value == '0000') {
                            if (sms == "") {
                                alert(sms1 + ', ' + sms2)
                            } else
                                alert(sms + ', ' + sms1 + ', ' + sms2);
                        } else if (sms == "") {
                            alert(sms1);
                        } else
                            alert(sms + ', ' + sms1);
                        return 0;
                    }
                    return 0;
                } else {
                    if (document.getElementById('cboTipoDescanso').value == '0000') {
                        if (sms == "") {
                            alert(sms1 + ', ' + sms2);
                        } else
                            alert(sms + ', ' + sms1 + ', ' + sms2);
                    } else if (sms == "") {
                        alert(sms1);
                    } else
                        alert(sms + ', ' + sms1);
                    return 0;
                }
                return 0;
            } else
                return 0;
        } else {
            if (document.getElementById('txtFechaInicioContrato').value.trim() == "" || document.getElementById('txtFechaFinContrato').value.trim() == "") {
                alert("Regularize contrato");
            }
            return 0;
        }
    } else {
        alert("El contrato se encuentra encuentra inhabilitado");
        return 0;

    }
}
/****************************************FIN VACACIONES**************************************/
/********************************************************************************************/

////   //
////////////////////////////////////Modulo de RRHH  lobo ///////////////////////////////////////////////--
////////////////////////////////////Modulo de RRHH  lobo ///////////////////////////////////////////////--
////////////////////////////////////Modulo de RRHH  lobo ///////////////////////////////////////////////--
function DesactivarCoordinador() {
    if (confirm('Esta seguro que desea desactivar todos los coordinadores')) {
        var mes = $("cboMesCoordinador").value;
        var decripcion = $("txtDecripcion").value;
        var anio = $("cboAnio").value;
        var form = "";
        var destino = "";
        var funcion = "ActivarCordinadorXarea";
        var parametros = "p1=DesactivarCoordinador&p2=" + mes + '&p3=' + decripcion + '&p4=' + anio;
        enviarFormulario(form, parametros, funcion, destino);
    }
}

function ActivarCoordinador() {
    if (confirm('Esta seguro que desea activar todos los coordinadores')) {
        var mes = $("cboMesCoordinador").value;
        var decripcion = $("txtDecripcion").value;
        var anio = $("cboAnio").value;
        var form = "";
        var destino = "";
        var funcion = "ActivarCordinadorXarea";
        var parametros = "p1=ActivarCoordinador&p2=" + mes + '&p3=' + decripcion + '&p4=' + anio;
        enviarFormulario(form, parametros, funcion, destino);
    }
}


function ActivarCordinadorXarea() {

    var mes = $("cboMesCoordinador").value;
    var anio = $("cboAnio").value;
    var parametros = "p1=ActivarCordinadorXarea&p2=" + mes + "&p3=" + anio;
    var div = "DivReporteCoordinadoresXarea";
    var funcionClick = "DarPermisoEspecialAlCoordinador";
    var funcionDblClick = "";
    var funcionLoad = "pintarColorTabla";//ListarEmpleadosPreProgramados
    generarTablaz(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}

function DarPermisoEspecialAlCoordinador(fil, col) {
    var IdHistoriaDeCoordinador = mygridz.cells(fil, 0).getValue();
    if (col == 6) {
        var form = "";
        var destino = "";
        var funcion = "ActivarCordinadorXarea";
        var parametros = "p1=DarPermisoEspecialAlCoordinador&p2=" + IdHistoriaDeCoordinador;
        enviarFormulario(form, parametros, funcion, destino);
    }

}
function pintarColorTabla() {
    for (i = 0; i < mygridz.getRowsNum(); i++) {
        var tipoArea = mygridz.cells(i, 2).getValue();
        if (tipoArea == 0) {
            mygridz.setRowTextStyle(mygridz.getRowId(i), 'background-color:#DF0101;color:black;border-top: 1px solid #DAEFC2;');
        } else if (tipoArea == 1) {
            mygridz.setRowTextStyle(mygridz.getRowId(i), 'background-color:#FFFFFF;color:black;border-top: 1px solid #FFFFFF;');
        }
    }
}


function programacionPersonal(filaArea, filaEmpleado) {
    var tablax = $('tblProgramacionPersonal' + filaArea);
    var codigoPreProgramacion = tablax.tBodies[filaEmpleado].rows[0].cells[0].innerHTML;
    var codigoSedeEmpresaArea = tablax.tBodies[filaEmpleado].rows[0].cells[1].innerHTML;
    var nombreEmpleado = tablax.tBodies[filaEmpleado].rows[0].cells[3].innerHTML;
    var puestoEmpleado = tablax.tBodies[filaEmpleado].rows[0].cells[2].innerHTML;
    var iCodigoEmpleado = tablax.tBodies[filaEmpleado].rows[0].cells[4].innerHTML;
    var nNumeroProgramacionesXmes = tablax.tBodies[filaEmpleado].rows[0].cells[7].innerHTML;
    var nombreAreaSede = $('hNombreAreaSede' + filaArea).value;
    var cboMes = $("cboMes").value;
    var cboAnio = $("cboAnio").value

    var posFuncion = "cargarDatosCodigoPreProgramacion_CodigoSedeAreaTurno(" + codigoPreProgramacion + ")";
    var vtitle = "";
    var vformname = 'VentanaTurnos';
    var vwidth = '680';
    var vheight = '320';
    var patronModulo = 'poppackSeleccionarTunosProgramar';
    var vcenter = 't';
    var vresizable = '';
    var vmodal = 'false';
    var vstyle = '';
    var vopacity = '';
    var veffect = '';
    var vposx1 = '';
    var vposx2 = '';
    var vposy1 = '';
    var vposy2 = '';
    var parametros = '';
    parametros += 'p1=' + patronModulo + '&p2=' + codigoPreProgramacion + '&p3=' + codigoSedeEmpresaArea.trim() + '&p4=' + nombreEmpleado + '&p5=' + nombreAreaSede
            + '&p6=' + puestoEmpleado + '&p7=' + iCodigoEmpleado + '&p8=' + nNumeroProgramacionesXmes + '&p9=' + cboMes + '&p10=' + cboAnio;
    ;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

}
function cargarDatosCodigoPreProgramacion_CodigoSedeAreaTurno(codigoPreProgramacion) {
    $("hPreprogramacionPersonal").value = codigoPreProgramacion;


}

function accionCalendarioProgramacionEmpleados(idAccion, cal) {
    arrayInput = document.getElementById(cal).getElementsByTagName("input");
    fechaActual = arrayInput[20].value + arrayInput[19].value + arrayInput[18].value;
    pathLink = "p1=calendario02&p2=" + fechaActual + "&p3=" + idAccion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText.split("|");
            fechaActual2 = respuesta[1];
            document.getElementById("hFechaSeleccionada").value = fechaActual2;
            document.getElementById("hFechasAProgramar").value = "";
            document.getElementById("divCalendario").update(respuesta[0]);
        }
    })
}

function seleccionarFechaProgramacionEmpleado(idElemento, cal) {
    diaSel = idElemento.split("-")[1];

    nomIdDia = cal + "-" + diaSel;
    arrayInput = document.getElementById(cal).getElementsByTagName("input");
    fechaActual = arrayInput[20].value + "-" + arrayInput[19].value + "-" + idElemento.split("-")[1];
    cadena = document.getElementById("hFechasAProgramar").value;

    estilo = document.getElementById(nomIdDia).className.valueOf();
    switch (estilo) {
        case "estiloCasillaSeleccionada":
            document.getElementById(nomIdDia).className = "btnCalendario";
            if (cadena.indexOf(fechaActual + "|") != -1) {
                cadena = cadena.replace(fechaActual + "|", '');
            }
            if (cadena.indexOf(fechaActual) != -1) {
                cadena = cadena.replace("|" + fechaActual, '');
                cadena = cadena.replace(fechaActual, '');
            }
            document.getElementById("hFechasAProgramar").value = cadena;
            break;
        case "btnCalendario":
            document.getElementById('hFechaSeleccionada').value = arrayInput[20].value + "-" + arrayInput[19].value + "-" + diaSel;
            arrayInput[18].value = diaSel;
            if (cadena == "")
                cadena = fechaActual;
            else
                cadena = cadena + "|" + fechaActual;
            document.getElementById("hFechasAProgramar").value = cadena;

            document.getElementById(nomIdDia).className = "estiloCasillaSeleccionada";
            break;
    }
}

function seleccionarFechasPorDiaEmpleado(elementoCheck, numDiaDeLaSemana, cal) { // check del calendario
    fechasPorDia = $("dia" + numDiaDeLaSemana).value;
    dias = fechasPorDia.split("-");
    numDias = dias.length;
    var i;
    arrayInput = document.getElementById(cal).getElementsByTagName("input");
    cadenaFechasSeleccionadas = document.getElementById("hFechasAProgramar").value;

    if (elementoCheck.checked) {//Si se seleccionan todos los dias
        for (i = 0; i < numDias; i++) {
            nomIdDia = cal + "-" + dias[i];
            fecha = arrayInput[20].value + "-" + arrayInput[19].value + "-" + dias[i];//año-mes-dia
            if (cadenaFechasSeleccionadas == "") {
                cadenaFechasSeleccionadas = fecha;
            } else {
                //Eliminamos por si la fecha ya fue insertada anteriormente
                if (cadenaFechasSeleccionadas.indexOf(fecha + "|") != -1) {
                    cadenaFechasSeleccionadas = cadenaFechasSeleccionadas.replace(fecha + "|", '');
                }
                if (cadenaFechasSeleccionadas.indexOf(fecha) != -1) {
                    cadenaFechasSeleccionadas = cadenaFechasSeleccionadas.replace("|" + fecha, '');
                    cadenaFechasSeleccionadas = cadenaFechasSeleccionadas.replace(fecha, '');
                }
                //Insertamos la nueva fecha
                cadenaFechasSeleccionadas = cadenaFechasSeleccionadas + "|" + fecha;
            }

            document.getElementById("hFechasAProgramar").value = cadenaFechasSeleccionadas;
            document.getElementById(nomIdDia).className = "estiloCasillaSeleccionada";
        }
    } else {//Si se deseleccionan todos los dias
        for (i = 0; i < numDias; i++) {
            nomIdDia = cal + "-" + dias[i];
            fecha = arrayInput[20].value + "-" + arrayInput[19].value + "-" + dias[i];//año-mes-dia

            if (cadenaFechasSeleccionadas.indexOf(fecha + "|") != -1) {
                cadenaFechasSeleccionadas = cadenaFechasSeleccionadas.replace(fecha + "|", '');
            }
            if (cadenaFechasSeleccionadas.indexOf(fecha) != -1) {
                cadenaFechasSeleccionadas = cadenaFechasSeleccionadas.replace("|" + fecha, '');
                cadenaFechasSeleccionadas = cadenaFechasSeleccionadas.replace(fecha, '');
            }
            document.getElementById("hFechasAProgramar").value = cadenaFechasSeleccionadas;
            document.getElementById(nomIdDia).className = "btnCalendario";
        }
    }
}

function descripcionTurno() {
    var turnoDescripcionseleccionado = $("cboTurnoArea").value;
    var turno = turnoDescripcionseleccionado.split("/");
    if (turno[1] == 0 && turno[2] == 0 && turno[3] == 0) {
        $("txtTurno").value = "";
        $("hnInicioTurno").value = "";
        $("hnfinTurno").value = "";
        $("hiCodigoSedeAreaTurno").value = "";
    } else {
        $("txtTurno").value = turno[1];
        $("hnInicioTurno").value = turno[2];
        $("hnfinTurno").value = turno[3];
        $("hiCodigoSedeAreaTurno").value = turno[0];
    }
}

function programacionPorDiaSinTurno(filaArea, filaEmpleado, filaTurno) {

    var anio = $("cboAnio").value;
    var mes = $("cboMes").value;
    var dia = filaTurno + 1;
    var tablax = $('tblProgramacionPersonal' + filaArea);
    var nombreEmpleado = tablax.tBodies[filaEmpleado].rows[0].cells[3].innerHTML;
    var codigoSedeEmpresaArea = tablax.tBodies[filaEmpleado].rows[0].cells[1].innerHTML;
    var codigoPreProgramacion = tablax.tBodies[filaEmpleado].rows[0].cells[0].innerHTML;
    var puestoEmpleado = tablax.tBodies[filaEmpleado].rows[0].cells[2].innerHTML;
    var iCodigoEmpleado = tablax.tBodies[filaEmpleado].rows[0].cells[4].innerHTML;
    var nNumeroProgramacionesXmes = tablax.tBodies[filaEmpleado].rows[0].cells[7].innerHTML;

    var iCodProgramacionEmpleado = "";
    var areaSede = $('hNombreAreaSede' + filaArea).value;

    var posFuncion = "";
    var vtitle = "";
    var vformname = 'VentanaTurnosx';
    var vwidth = '600';
    var vheight = '150';
    var patronModulo = 'poppackSeleccionarTunosProgramarIndividualSinTurno';
    var vcenter = 't';
    var vresizable = '';
    var vmodal = 'false';
    var vstyle = '';
    var vopacity = '';
    var veffect = '';
    var vposx1 = '';
    var vposx2 = '';
    var vposy1 = '';
    var vposy2 = '';
    var parametros = '';
    parametros += 'p1=' + patronModulo + '&p2=' + iCodProgramacionEmpleado + '&p3=' + codigoSedeEmpresaArea.trim()
            + '&p4=' + nombreEmpleado.trim() + '&p5=' + areaSede.trim() + '&p6=' + anio + '&p7=' + mes + '&p8=' + dia
            + '&p9=' + codigoPreProgramacion + '&p10=' + puestoEmpleado + '&p11=' + iCodigoEmpleado + '&p12=' + nNumeroProgramacionesXmes;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function programacionPorDiaConTurno(filaArea, filaEmpleado, filaTurno) {
    var iCodProgramacionEmpleado = $("hiCodProgramacionEmpleado" + filaArea + filaEmpleado + filaTurno).value;
    var areaSede = $("hNombreArea" + filaArea + filaEmpleado + filaTurno).value;
    var descripcionTurno = $("hDescripcionTurno" + filaArea + filaEmpleado + filaTurno).value;
    var descripcionTurnoRango = $("hDescripcionTurnoRango" + filaArea + filaEmpleado + filaTurno).value;
    var iCodTurnoAreaSede = $("hICodTurnoAreaSede" + filaArea + filaEmpleado + filaTurno).value;
    var nomMes = $("cboMes").options[$("cboMes").selectedIndex].text;
    var anio = $("cboAnio").options[$("cboAnio").selectedIndex].text;

    var tablax = $('tblProgramacionPersonal' + filaArea);
    var nombreEmpleado = tablax.tBodies[filaEmpleado].rows[0].cells[3].innerHTML;
    var codigoPreProgramacion = tablax.tBodies[filaEmpleado].rows[0].cells[0].innerHTML;
    var codigoSedeEmpresaArea = tablax.tBodies[filaEmpleado].rows[0].cells[1].innerHTML;
    var nNumeroProgramacionesXmes = tablax.tBodies[filaEmpleado].rows[0].cells[7].innerHTML;
    var puestoEmpleado = tablax.tBodies[filaEmpleado].rows[0].cells[2].innerHTML;

    var iCodigoEmpleado = tablax.tBodies[filaEmpleado].rows[0].cells[4].innerHTML;
    var iCodEmpCoordinador = $("hICodEmpCoordinador").value;
    var posFuncion = "";
    var vtitle = "";
    var vformname = 'VentanaTurnos';
    var vwidth = '600';
    var vheight = '150';
    var patronModulo = 'poppackSeleccionarModificarEliminarTunosProgramarIndividual';
    var vcenter = 't';
    var vresizable = '';
    var vmodal = 'false';
    var vstyle = '';
    var vopacity = '';
    var veffect = '';
    var vposx1 = '';
    var vposx2 = '';
    var vposy1 = '';
    var vposy2 = '';
    var parametros = '';
    parametros += 'p1=' + patronModulo + '&p2=' + iCodProgramacionEmpleado + '&p3=' + nombreEmpleado.trim()
            + '&p4=' + iCodEmpCoordinador.trim() + '&p5=' + areaSede + '&p6=' + codigoSedeEmpresaArea.trim() + '&p7=' + descripcionTurno
            + '&p8=' + descripcionTurnoRango + '&p9=' + iCodTurnoAreaSede + '&p10=' + filaTurno + '&p11=' + nomMes + '&p12=' + anio + '&p13=' + codigoPreProgramacion.trim()
            + '&p14=' + iCodigoEmpleado.trim() + '&p15=' + filaArea + '&p16=' + filaEmpleado + '&p17=' + nNumeroProgramacionesXmes.trim() + '&p18=' + puestoEmpleado;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function guardarTurnoProgramadoGrupo() {
    //   var a= $("divscroll").scrollLeft;
    var b1 = $("divscroll2").scrollTop;
    $("hPosicion").value = b1;

    var turnoDescripcionseleccionado = $("cboTurnoArea").value;
    var codigoTurnoAreaSede = turnoDescripcionseleccionado.split("/");
    var preprogramacionPersonal = $("hPreprogramacionPersonal").value;
    var fechasAProgramar = $("hFechasAProgramar").value;
    var idPuestoEmpleado = $("hPuestoEmpleado").value;
    var iCodigoEmpleado = $("hiCodigoEmpleado").value;
    var nInicioTurno = $("hnInicioTurno").value;
    var nfinTurno = $("hnfinTurno").value;
    var nNumeroProgramacionesXmes = $("hnNumeroProgramacionesXmes").value;
    var codigoSedeEmpresaArea = $("hcodigoSedeEmpresaArea").value;

    if (fechasAProgramar != '' && codigoTurnoAreaSede[0] != 0) {
        var form = "";
        var destino = "divMensajeCruce";
        var funcion = "reporteEmpleadoX";
        var parametros = "p1=guardarTurnoProgramadoGrupo&p2=" + codigoTurnoAreaSede[0] + '&p3=' + preprogramacionPersonal + '&p4=' + fechasAProgramar
                + '&p5=' + idPuestoEmpleado + '&p6=' + iCodigoEmpleado + '&p7=' + nInicioTurno + '&p8=' + nfinTurno + '&p9=' + nNumeroProgramacionesXmes
                + '&p10=' + codigoSedeEmpresaArea;
        //        enviarFormularioSincronizado(form,parametros,funcion,destino);

        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false,
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function (transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                if (respuesta == 1) {
                    Windows.close("Div_VentanaTurnos", "");
                } else {
                    if (destino != "")
                        $(destino).update(respuesta);
                }
                reporteEmpleadoX();
            }
        })

    } else {
        alert("No ah Seleccionado un Turno o Fecha");
    }
}

function reporteEmpleadoX() {
    var iCodEmpCoordinador = $("hICodEmpCoordinador").value;
    var estado = $("hEstado").value;

    var anio = $("cboAnio").value;
    var mes = $("cboMes").value;
    var annoActual = $("hAnnoActual").value;
    var mesActual = $("hMesActual").value;
    var horaActual = $("hHoraActual").value;
    var minutosActual = $("hMinutosActual").value;
    var destino = "divAreaEmpleado";
    var parametros = "p1=reporteEmpleado&p2=" + iCodEmpCoordinador + '&p3=' + anio + '&p4=' + mes
            + '&p5=' + annoActual + '&p6=' + mesActual + '&p7=' + horaActual + '&p8=' + minutosActual;

    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            if (destino != "")
                $(destino).update(respuesta);
            if (estado == 1) {
                document.getElementById('divscroll2').style.height = 600;
            } else {
                document.getElementById('divscroll2').style.height = 450;
            }
            document.getElementById('divscroll2').scrollTop = parseInt($("hPosicion").value);

            //            Windows.close("Div_VentanaTurnos", "");

        }
    })
}
function guardarTurnoProgramadoIndividuar() {//  2012-05-04
    var estado = $("hEstado").value;
    if (estado == 1) {
        document.getElementById('divscroll2').style.height = 600;
    } else {
        document.getElementById('divscroll2').style.height = 450;
    }
    var b1 = $("divscroll2").scrollTop;
    $("hPosicion").value = b1;
    var turnoDescripcionseleccionado = $("cboTurnoArea").value;
    var codigoTurnoAreaSede = turnoDescripcionseleccionado.split("/");
    var preprogramacionPersonal = $("hidPreProgramacion").value;
    var fechasAProgramar = $("hfecha").value
    var idPuestoEmpleado = $("hPuestoEmpleado").value
    var iCodigoEmpleado = $("hiCodigoEmpleado").value;
    var nInicioTurno = $("hnInicioTurno").value;
    var nfinTurno = $("hnfinTurno").value;
    var nNumeroProgramacionesXmes = $("hnNumeroProgramacionesXmes").value;

    if (fechasAProgramar != '' && codigoTurnoAreaSede[0] != 0) {
        var funcion = "reporteEmpleadoX";
        var parametros = "p1=guardarTurnoProgramadoIndividual&p2=" + codigoTurnoAreaSede[0] + '&p3=' + preprogramacionPersonal + '&p4=' + fechasAProgramar
                + '&p5=' + idPuestoEmpleado + '&p6=' + iCodigoEmpleado + '&p7=' + nInicioTurno + '&p8=' + nfinTurno + '&p9=' + nNumeroProgramacionesXmes;

        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false,
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function (transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                if (respuesta == 1) {
                    funcion += "()";
                    eval(funcion);
                    Windows.close("Div_VentanaTurnosx", "");
                } else {
                    alert(respuesta);
                }
            }
        })
    } else {
        alert("No ah Seleccionado un Turno o Fecha");
    }
}

function modificarTurnoProgramadoIndividuar() {
    var estado = $("hEstado").value;
    var nNumeroProgramacionesXmes = $("hnNumeroProgramacionesXmes").value;
    var idPuestoEmpleado = $("hPuestoEmpleado").value;
    var idSedeAreaTurno = $("hiCodigoSedeAreaTurno").value;

    if (estado == 1) {
        document.getElementById('divscroll2').style.height = 600;
    } else {
        document.getElementById('divscroll2').style.height = 450;
    }
    var b1 = $("divscroll2").scrollTop;
    $("hPosicion").value = b1;
    var idSedeAreaTurnoAntiguo = $("hiCodTurnoAreaSedeAntuguo").value;
    var idSedeAreaTurnoActual = $("hiCodigoSedeAreaTurno").value;
    var idProgramacionPersonal = $("hiProgramacionPersonal").value;
    var nInicioTurno = $("hnInicioTurno").value;
    var nfinTurno = $("hnfinTurno").value;
    var anio = $("hAnio").value;
    var numeroDelMes = $("cboMes").value;
    var dia = $("hnumeroFechaMes").value;
    var idPreProgramacion = $("hidPreProgramacion").value;
    var iCodigoEmpleado = $("hiCodigoEmpleado").value;
    var cadena = anio + '-' + numeroDelMes + '-' + dia;

    if (idSedeAreaTurnoActual != '') {
        if (idSedeAreaTurnoAntiguo != idSedeAreaTurnoActual) {

            var funcion = "reporteEmpleadoX";
            var parametros = "p1=modificarTurnoProgramadoIndividuar&p2=" + idProgramacionPersonal + '&p3=' + nInicioTurno + '&p4=' + nfinTurno
                    + '&p5=' + cadena + '&p6=' + idSedeAreaTurnoActual + '&p7=' + idPreProgramacion + '&p8=' + iCodigoEmpleado
                    + '&p9=' + nNumeroProgramacionesXmes.trim() + '&p10=' + idPuestoEmpleado.trim() + '&p11=' + idSedeAreaTurno.trim();

            contadorCargador++;
            var idCargador = contadorCargador;
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                asynchronous: false,
                parameters: parametros,
                onLoading: cargadorpeche(1, idCargador),
                onComplete: function (transport) {
                    cargadorpeche(0, idCargador);
                    var respuesta = transport.responseText;
                    if (respuesta == 1) {
                        funcion += "()";
                        eval(funcion);
                        Windows.close("Div_VentanaTurnos", "");
                    } else {
                        alert(respuesta);
                    }
                }
            })

        } else {
            alert("Ah ingresado el mismo Turno");
        }
    } else {
        alert("Porfavor Ingreso Nuevo Turno");
    }
}

function EliminarTurnoProgramadoIndividuar() {
    var estado = $("hEstado").value;
    if (estado == 1) {
        document.getElementById('divscroll2').style.height = 600;
    } else {
        document.getElementById('divscroll2').style.height = 450;
    }
    var b1 = $("divscroll2").scrollTop;

    $("hPosicion").value = b1;
    var idSedeAreaTurnoAntiguo = $("hiCodTurnoAreaSedeAntuguo").value;
    var idSedeAreaTurnoActual = $("hiCodigoSedeAreaTurno").value;
    var idProgramacionPersonal = $("hiProgramacionPersonal").value;
    var nInicioTurno = $("hnInicioTurno").value;
    var nfinTurno = $("hnfinTurno").value;
    var anio = $("hAnio").value;
    var numeroDelMes = $("cboMes").value;
    var dia = $("hnumeroFechaMes").value;
    var idPreProgramacion = $("hidPreProgramacion").value;
    var iCodigoEmpleado = $("hiCodigoEmpleado").value;
    var cadena = anio + '-' + numeroDelMes + '-' + dia;

    var form = "";
    var destino = "";
    var funcion = "reporteEmpleadoX";
    var parametros = "p1=EliminarTurnoProgramadoIndividuar&p2=" + idProgramacionPersonal + '&p3=' + nInicioTurno + '&p4=' + nfinTurno
            + '&p5=' + cadena + '&p6=' + idSedeAreaTurnoActual + '&p7=' + idPreProgramacion + '&p8=' + iCodigoEmpleado;
    //enviarFormulario(form,parametros,funcion,destino);
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            funcion += "()";
            eval(funcion);
            programacionActualizarEliminar(idPreProgramacion, iCodigoEmpleado, numeroDelMes, anio)
            Windows.close("Div_VentanaTurnos", "");
        }
    })

}

function HorariosTurnosAreaCoordinador(extencion) {
    var iCodEmpCoordinador = $("hICodEmpCoordinador").value;
    var anio = $("cboAnio").value;
    var mes = $("cboMes").value;
    var annoActual = $("hAnnoActual").value;
    var mesActual = $("hMesActual").value;
    var horaActual = $("hHoraActual").value;
    var minutosActual = $("hMinutosActual").value;
    var idModalidadContrato = $("cboModalidadContrato").value;
    //  parametros="p1=HorariosTurnos&p2="+codigoCordinar;
    var parametros = "p1=HorariosTurnosAreaCoordinador&p2=" + iCodEmpCoordinador + '&p3=' + anio + '&p4=' + mes
            + '&p5=' + annoActual + '&p6=' + mesActual + '&p7=' + horaActual + '&p8=' + minutosActual + '&p9=' + extencion + '&p10=' + idModalidadContrato;
    location.href = pathRequestControl + '?' + parametros;
}

function reporteEmpleado() {
    //    $("divscroll2").scrollTo(0,1258) ;

    $("divExportarExcelHorarioEmpleados").show();
    $("hEstado").value = 0;
    var iCodEmpCoordinador = $("hICodEmpCoordinador").value;
    var anio = $("cboAnio").value;
    var mes = $("cboMes").value;
    var annoActual = $("hAnnoActual").value;
    var mesActual = $("hMesActual").value;
    var horaActual = $("hHoraActual").value;
    var minutosActual = $("hMinutosActual").value;
    var form = "";
    var destino = "divAreaEmpleado";
    var funcion = "";
    var parametros = "p1=reporteEmpleado&p2=" + iCodEmpCoordinador + '&p3=' + anio + '&p4=' + mes
            + '&p5=' + annoActual + '&p6=' + mesActual + '&p7=' + horaActual + '&p8=' + minutosActual;
    enviarFormulario(form, parametros, funcion, destino);
}

//function reporteEmpleado(){
//    //    $("divscroll2").scrollTo(0,1258) ;
//    $("hEstado").value=0;
//    var iCodEmpCoordinador=$("hICodEmpCoordinador").value;
//    var anio=$("cboAnio").value;
//    var mes=$("cboMes").value;
//    var annoActual=$("hAnnoActual").value;
//    var mesActual=$("hMesActual").value;
//    var horaActual=$("hHoraActual").value;
//    var minutosActual=$("hMinutosActual").value;
//    var form="";
//    var destino="divAreaEmpleado";
//    var funcion="mostrarAccionTurnoLeyenda";
//    var parametros="p1=reporteEmpleado&p2="+iCodEmpCoordinador+'&p3='+anio+'&p4='+mes
//    +'&p5='+annoActual+'&p6='+mesActual+'&p7='+horaActual+'&p8='+ minutosActual;
//    enviarFormulario(form,parametros,funcion,destino);
//}
function Ocultar() {
    $("hEstado").value = 1;
    document.getElementById('divscroll2').style.height = 600;
    $("divOcultar").hide();
}

function MostrarDatosCoordinador() {
    $("hEstado").value = 0;
    document.getElementById('divscroll2').style.height = 450;
    $("divOcultar").show();
}
function lenyendaArea(codigoSedeEmpresaArea, fila) {
    var destino = "divTrunosArea" + trim(fila);
    var parametros = "p1=lenyendaArea&p2=" + codigoSedeEmpresaArea;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            if (destino != "")
                $(destino).update(respuesta);
        }
    })
}

function OcultarTurnos(fila) {
    $("divTrunosArea" + fila).hide();
}
function MostrarTurnos(fila) {
    $("divTrunosArea" + fila).show();
}
////  Modulo de RRHH  lobo fin //
//********************************************************************************//
////********************************************************************************//
////  reporte asistencia de Medico  lobo  //
function podpadBusquedaMedicos() {
    posFuncion = "";
    vtitle = "<h2>BUSQUEDA DE MEDICO</h2>";
    vformname = 'podpadBusquedaMedicos';
    vwidth = '650';
    vheight = '320';
    //'nuevaSubArea' llama al control y luego al actionRRHH y carga la vista vGuardarArea
    patronModulo = 'podpadBusquedaMedicos';
    vcenter = 't';
    vresizable = ''
    vmodal = 'false';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function buscarMedicoX($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre) {

    if ($apPat.trim() != '' || $apMat.trim() != '' || $nombre.trim() != '' || $nDoc.trim() != '' || $cod.trim() != '') {

        var patronModulo = "buscarMedicoX";
        cod = $cod;
        estado = $estado;
        if (($estado) == '0001' || ($estado) == '0000') {
            estado = '';
        }
        if (($estado) == '0002') {
            estado = 1;
        }
        if ($estado == '0003') {
            estado = 0;
        }
        tipoDoc = $tipoDoc;
        nDoc = $nDoc;
        apPat = $apPat;
        apMat = $apMat;
        nombre = $nombre;
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + cod;
        parametros += '&p3=' + estado;
        parametros += '&p4=' + tipoDoc;
        parametros += '&p5=' + nDoc;
        parametros += '&p6=' + apPat;
        parametros += '&p7=' + apMat;
        parametros += '&p8=' + nombre;

        tablaEmpleados = new dhtmlXGridObject('divTablaResultadosMedico');
        tablaEmpleados.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
        tablaEmpleados.setSkin("dhx_skyblue");
        tablaEmpleados.enableRowsHover(true, 'grid_hover');
        tablaEmpleados.attachEvent("onRowSelect", seleccionarMedicoX)
        //    mygridX.attachEvent("onRowDblClicked", dbclickeditarPrueba);
        tablaEmpleados.init();
        tablaEmpleados.loadXML(pathRequestControl + '?' + parametros);
    } else {
        alert("Llene al menos un campo")
    }
}

function seleccionarMedicoX(id, cell) {
    $("txthidcantidadTotalRegistros").value = 0;
    var codEmp = tablaEmpleados.cells(tablaEmpleados.getSelectedId(), 0).getValue();
    var codPer = tablaEmpleados.cells(tablaEmpleados.getSelectedId(), 1).getValue();
    var nombre = tablaEmpleados.cells(tablaEmpleados.getSelectedId(), 2).getValue();
    $('txthidCodigoPersona').value = codPer;
    $('txthidCodigoEmpleado').value = codEmp;
    $('txthidNombreCompletoPersona').value = nombre;
    $('div_NombreCompleto').innerHTML = '<h1>' + codPer + ' ' + nombre + '</h1>';
    Windows.close("Div_podpadBusquedaMedicos", "");
    reporteBusquedaMedico();
}

function  reporteBusquedaMedico() {
    $("div_listaMedicosPorParteAtras").hide();
    $("div_listaMedicosPorParteAdelante").show();
    $("txthidcantidadTotalRegistros").value = 0;
    $("txthidcantidadRegistro").value = 15;
    $("txthidcantidadRegistroMinimo").value = 0;
    var cantidadRegistro = $("txthidcantidadRegistro").value;
    var cantidadRegistrominimo = $("txthidcantidadRegistroMinimo").value;

    var fechaIni = $("txtFechaIni").value;
    var fechaFinal = $("txtFechaFinal").value;
    var iCodMedico = $("txthidCodigoEmpleado").value;
    var c_cod_per = $("txthidCodigoPersona").value;
    //    $("txthidcantidadTotalRegistros").value=

    var parametros = "p1=reporteBusquedaMedico&p2=" + iCodMedico + '&p3=' + fechaIni + '&p4=' + fechaFinal + '&p5=' + cantidadRegistro + '&p6=' + cantidadRegistrominimo + '&p7=' + c_cod_per;
    var div = "div_tablaXmedicos";
    var funcionClick = "";
    var funcionDblClick = "";
    var funcionLoad = "";//ListarEmpleadosPreProgramados
    if (fechaIni == '' || fechaFinal == '') {
        alert("Ingrese las fechas")
    } else {
        //        generarTablaz(div,parametros,funcionClick,funcionDblClick,funcionLoad);
        misMedicos = new dhtmlXGridObject('div_tablaXmedicos');
        misMedicos.setImagePath("../../../../fastmedical_front/imagen/icono/");
        //miTablaCie.attachEvent("onRowSelect", '');
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador = contadorCargador;
        misMedicos.attachEvent("onXLS", function () {
            cargadorpeche(1, idCargador);
        });
        misMedicos.attachEvent("onXLE", function () {
            cargadorpeche(0, idCargador);
        });
        /////////////fin cargador ///////////////////////
        misMedicos.setSkin("dhx_skyblue");
        misMedicos.init();
        misMedicos.loadXML(pathRequestControl + '?' + parametros);
    }
}

function limpiaBusquedasXMedico(opc, elemento, evento) {
    switch (opc)
    {
        case "01": //Busqueda por codigo
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
            document.getElementById('nroDoc').value = '';
            document.getElementById('apellidoPaterno').value = '';
            document.getElementById('apellidoMaterno').value = '';
            document.getElementById('nombres').value = '';

            break;
        case "03": //Busqueda por docuemnto
            document.getElementById('txtCodigo').value = '';
            document.getElementById('apellidoPaterno').value = '';
            document.getElementById('apellidoMaterno').value = '';
            document.getElementById('nombres').value = '';
            break;
        case "04": //busqeuda por nombre
            document.getElementById('txtCodigo').value = '';
            document.getElementById('comboTipoDocumentos').selected = "selected";
            document.getElementById('comboTipoDocumentos').value = "0000";
            document.getElementById('nroDoc').value = '';

            break;
        case "0": //boton limpiar
            document.getElementById('txtCodigo').value = '';
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
    } else {
        tecla = evento.keyCode
    }
    if (tecla == 13) {
        $cod = document.getElementById('txtCodigo').value;
        $estado = document.getElementById('comboTipoEstados').value;
        $tipoDoc = document.getElementById('comboTipoDocumentos').value;
        $nDoc = document.getElementById('nroDoc').value;
        $apPat = document.getElementById('apellidoPaterno').value;
        $apMat = document.getElementById('apellidoMaterno').value;
        $nombre = document.getElementById('nombres').value;
        buscarMedicoX($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre);
    }
}

//function listaMedicosPorParteAdelante(){
//    $("div_listaMedicosPorParteAtras").show();  
//    var idPreProgramacionPersonal=mygridz.cells(1,7).getValue();
//    if(mygridz.cells(1,7).getValue()){
//        $("txthidcantidadTotalRegistros").value = idPreProgramacionPersonal;
//    }
//    var c_cod_per=$("txthidCodigoPersona").value;
//    var cantidadMedicos=parseInt($("txthidcantidadTotalRegistros").value);
//    var x=parseInt($("txthidcantidadRegistro").value);
//    if(cantidadMedicos>=x){
//    var cantidadRegistro = $("txthidcantidadRegistro").value;
//    cantidadRegistro=parseInt(cantidadRegistro)+15
//    $("txthidcantidadRegistro").value=cantidadRegistro;
//    var cantidadRegistroMinimo = $("txthidcantidadRegistroMinimo").value;
//    cantidadRegistroMinimo=parseInt(cantidadRegistroMinimo)+15;
//    $("txthidcantidadRegistroMinimo").value=cantidadRegistroMinimo;
//    var fechaIni=$("txtFechaIni").value;
//    var fechaFinal=$("txtFechaFinal").value;
//    var iCodMedico=$("txthidCodigoEmpleado").value;
//  
//    var parametros="p1=listaMedicosPorParteAdelante&p2="+iCodMedico+'&p3='+fechaIni+'&p4='+fechaFinal+'&p5='+cantidadRegistro+'&p6='+cantidadRegistroMinimo+'&p7='+ c_cod_per;
//    var div="div_tablaXmedicos";
//    var funcionClick="";
//    var funcionDblClick="";
//    var funcionLoad="";//ListarEmpleadosPreProgramados
//                if(fechaIni == '' || fechaFinal==''){
//                    alert("Ingrese las fechas")
//                }else{
//                    generarTablay(div,parametros,funcionClick,funcionDblClick,funcionLoad);
//                }
//    }else {
//      $("div_listaMedicosPorParteAdelante").hide();  
//    }
//       
//}
function listaMedicosPorParteAdelante() {
    $("div_listaMedicosPorParteAtras").show();

    if (!(parseInt($("txthidcantidadTotalRegistros").value) > 0)) {
        var cantidadTotalRegistros = misMedicos.cells(1, 7).getValue();
        $("txthidcantidadTotalRegistros").value = cantidadTotalRegistros;
    }
    var c_cod_per = $("txthidCodigoPersona").value;
    var cantidadMedicos = parseInt($("txthidcantidadTotalRegistros").value);
    var x = parseInt($("txthidcantidadRegistro").value);
    if (cantidadMedicos >= x) {
        var cantidadRegistro = $("txthidcantidadRegistro").value;
        cantidadRegistro = parseInt(cantidadRegistro) + 15
        $("txthidcantidadRegistro").value = cantidadRegistro;
        var cantidadRegistroMinimo = $("txthidcantidadRegistroMinimo").value;
        cantidadRegistroMinimo = parseInt(cantidadRegistroMinimo) + 15;
        $("txthidcantidadRegistroMinimo").value = cantidadRegistroMinimo;
        var fechaIni = $("txtFechaIni").value;
        var fechaFinal = $("txtFechaFinal").value;
        var iCodMedico = $("txthidCodigoEmpleado").value;

        var parametros = "p1=listaMedicosPorParteAdelante&p2=" + iCodMedico + '&p3=' + fechaIni + '&p4=' + fechaFinal + '&p5=' + cantidadRegistro + '&p6=' + cantidadRegistroMinimo + '&p7=' + c_cod_per;
        var div = "div_tablaXmedicos";
        var funcionClick = "";
        var funcionDblClick = "";
        var funcionLoad = "";//ListarEmpleadosPreProgramados
        if (fechaIni == '' || fechaFinal == '') {
            alert("Ingrese las fechas")
        } else {

            misMedicos1 = new dhtmlXGridObject('div_tablaXmedicos');
            misMedicos1.setImagePath("../../../../fastmedical_front/imagen/icono/");
            misMedicos1.attachEvent("onRowSelect", '');
            //////////para cargador peche////////////////
            contadorCargador++;
            var idCargador = contadorCargador;
            misMedicos1.attachEvent("onXLS", function () {
                cargadorpeche(1, idCargador);
            });
            misMedicos1.attachEvent("onXLE", function () {
                cargadorpeche(0, idCargador);
            });
            /////////////fin cargador ///////////////////////
            misMedicos1.setSkin("dhx_skyblue");
            misMedicos1.init();
            misMedicos1.loadXML(pathRequestControl + '?' + parametros, function () {

            });
        }
    } else {
        $("div_listaMedicosPorParteAdelante").hide();
    }

}
//function buscarCieNombre(){
//    nombre=$('textNombreCie').value;
//    numero=nombre.length;
//    patronModulo='tablaCie';
//    parametros='';
//    parametros+='p1='+patronModulo;
//    parametros+='&p2='+nombre;
//
//    if(numero==4){
//        cn=0;
//        miTablaCie = new dhtmlXGridObject('tablaCie');
//        miTablaCie.setImagePath("../../../../fastmedical_front/imagen/icono/");
//        miTablaCie.attachEvent("onRowSelect", agregarAntecedente);
//        //////////para cargador peche////////////////
//        contadorCargador++;
//        var idCargador=contadorCargador;
//         miTablaCie.attachEvent("onXLS", function(){
//            cargadorpeche(1,idCargador);
//         });
//        miTablaCie.attachEvent("onXLE", function(){
//              cargadorpeche(0,idCargador);
//        });
//        /////////////fin cargador ///////////////////////
//        miTablaCie.setSkin("dhx_skyblue");
//        miTablaCie.init();
//        miTablaCie.loadXML(pathRequestControl+'?'+parametros,function(){
//            cn=1;
//        });
//    //setTimeout('x=1',1000);
//    }
//    if(numero>4&&cn==1){
//        miTablaCie.filterBy(1,$('textNombreCie').value);
//    }
//    
//
//}

function listaMedicosPorParteAtras() {
    $("div_listaMedicosPorParteAdelante").show();

    if (!$("txthidcantidadTotalRegistros").value > 0) {
        var idPreProgramacionPersonal = misMedicos.cells(1, 7).getValue();
        $("txthidcantidadTotalRegistros").value = idPreProgramacionPersonal;
    }
    var c_cod_per = $("txthidCodigoPersona").value;
    var cantidadMedicos = parseInt($("txthidcantidadTotalRegistros").value);
    var x = parseInt($("txthidcantidadRegistro").value);
    if (x != 15) {
        var cantidadRegistro = $("txthidcantidadRegistro").value;
        cantidadRegistro = parseInt(cantidadRegistro) - 15
        $("txthidcantidadRegistro").value = cantidadRegistro;
        var cantidadRegistroMinimo = $("txthidcantidadRegistroMinimo").value;
        cantidadRegistroMinimo = parseInt(cantidadRegistroMinimo) - 15;
        $("txthidcantidadRegistroMinimo").value = cantidadRegistroMinimo;
        var fechaIni = $("txtFechaIni").value;
        var fechaFinal = $("txtFechaFinal").value;
        var iCodMedico = $("txthidCodigoEmpleado").value;

        var parametros = "p1=listaMedicosPorParteAdelante&p2=" + iCodMedico + '&p3=' + fechaIni + '&p4=' + fechaFinal + '&p5=' + cantidadRegistro + '&p6=' + cantidadRegistroMinimo + '&p7=' + c_cod_per;
        var div = "div_tablaXmedicos";
        var funcionClick = "";
        var funcionDblClick = "";
        var funcionLoad = "";//ListarEmpleadosPreProgramados
        if (fechaIni == '' || fechaFinal == '') {
            alert("Ingrese las fechas")
        } else {
            misMedicos = new dhtmlXGridObject('div_tablaXmedicos');
            misMedicos.setImagePath("../../../../fastmedical_front/imagen/icono/");
            misMedicos.attachEvent("onRowSelect", '');
            //////////para cargador peche////////////////
            contadorCargador++;
            var idCargador = contadorCargador;
            misMedicos.attachEvent("onXLS", function () {
                cargadorpeche(1, idCargador);
            });
            misMedicos.attachEvent("onXLE", function () {
                cargadorpeche(0, idCargador);
            });
            /////////////fin cargador ///////////////////////
            misMedicos.setSkin("dhx_skyblue");
            misMedicos.init();
            misMedicos.loadXML(pathRequestControl + '?' + parametros, function () {

            });
        }
    } else {
        $("div_listaMedicosPorParteAtras").hide();
        $("div_listaMedicosPorParteAdelante").show();
    }

}

function verEmpleadoCaducaSuContrato() {
    //alert("lobito");
    posFuncion = "verEmpleadoCaducaSuContratoTabla";
    vtitle = "<h2>CONTRATOS A VENCER</h2> <H1><font color='#FF0000'>(No Podran Ser Programados)</font> </H1>";
    vformname = 'div_reporteRegularizaContratos';
    vwidth = '650';
    vheight = '420';
    //'nuevaSubArea' llama al control y luego al actionRRHH y carga la vista vGuardarArea
    patronModulo = 'podpadReporteEmpleadoVenceContrato';
    vcenter = 't';
    vresizable = ''
    vmodal = 'false';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

}

function verEmpleadoCaducaSuContratoTabla() {
    // alert("hhhhhh");
    var patronModulo = 'verEmpleadoCaducaSuContratoTabla';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    //parametros+='&p2='+codigoProgramacion;

    tablaVistaReporteContratoAVencer = new dhtmlXGridObject('divTablaVistaReporte');
    tablaVistaReporteContratoAVencer.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaVistaReporteContratoAVencer.setSkin("dhx_skyblue");
    tablaVistaReporteContratoAVencer.enableRowsHover(true, 'grid_hover');

    var filtroPeril = "<input type='text' id='txtNombreEmpleadosVenceContratos' style='width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarEmpleadosVenceContratos();\" />";
    var header = ["", "", filtroPeril, "", ""];
    tablaVistaReporteContratoAVencer.attachHeader(header);


    tablaVistaReporteContratoAVencer.attachEvent("onRowSelect", function (rId, cInd) {
        //        var idPuntoControl=tablaPuntosControl.cells(rId,0).getValue();
        //        obtenerDetallePuntoControl(idPuntoControl);

    });
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaVistaReporteContratoAVencer.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    tablaVistaReporteContratoAVencer.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        //        document.getElementById('div_barrraDesplazante').style.height =900;
    });
    tablaVistaReporteContratoAVencer.attachEvent("onRowDblClicked", function (rId, cInd) {

        registroDatosPersonalDetalle(rId, cInd, 'tablaVistaReporteContratoAVencer');
        Windows.close("Div_div_reporteRegularizaContratos");
    });
    /////////////fin cargador ///////////////////////
    tablaVistaReporteContratoAVencer.setSkin("dhx_skyblue");
    tablaVistaReporteContratoAVencer.init();
    tablaVistaReporteContratoAVencer.loadXML(pathRequestControl + '?' + parametros, function () {

    });
}

function CerrarVentanaListaCaducidadContrato() {
    Windows.close("Div_div_reporteRegularizaContratos");
}

function buscarEmpleadosVenceContratos() {
    //    $("txtNombreExamenfiltro").value=$("txtNombreExamen").value;
    findLikeexamen(document.getElementById('txtNombreEmpleadosVenceContratos').value, tablaVistaReporteContratoAVencer, 2);
}

function programacionAsistenciaPersonalRRHH() {
    var c_cod_per = $("txtCodPer").value;
    var nombre = document.getElementById('txtNomPer').value;
    var codigoEmpleado = document.getElementById('txtcodigoEmpleado').value;
    var f = new Date();
    //       alert(f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());
    var anio = f.getFullYear();
    var mes = f.getMonth() + 1;
    //    alert(mes);
    //    alert(anio);
    patronModulo = 'programacionAsistenciaPersonalRRHH';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + c_cod_per;
    parametros += '&p3=' + nombre;
    parametros += '&p4=' + codigoEmpleado;
    parametros += '&p5=' + anio;
    parametros += '&p6=' + mes;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            //           alert(respuesta);
            $('divDerRegistroP').update(respuesta);

            myDiv = document.getElementById('divTitulo');
            myDiv.innerHTML = document.getElementById('txtNomPer').value;

        }
    })

}

function reporteEmpleadoRRHH() {
    var c_cod_per = $("txtCodPer").value;
    var nombre = document.getElementById('txtNomPer').value;
    var codigoEmpleado = document.getElementById('txtcodigoEmpleado').value;

    var anio = $("cboAnio").value;
    var mes = $("cboMesRRHH").value;

    patronModulo = 'programacionAsistenciaPersonalRRHH';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + c_cod_per;
    parametros += '&p3=' + nombre;
    parametros += '&p4=' + codigoEmpleado;
    parametros += '&p5=' + anio;
    parametros += '&p6=' + mes;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            //           alert(respuesta);
            $('divDerRegistroP').update(respuesta);

            document.getElementById('cboMesRRHH').selected = "selected";
            document.getElementById('cboMesRRHH').value = mes;

        }
    })
}








//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------

function programacionBorrar(filaArea, filaEmpleado) {
    var nombreAreaSede = $('hNombreAreaSede' + filaArea).value
    var tablax = $('tblProgramacionPersonal' + filaArea);
    var codigoPreProgramacion = tablax.tBodies[filaEmpleado].rows[0].cells[0].innerHTML;
    var posFuncion = "cargarTablaProgramacionEmpleadoEliminarTurno";
    var vtitle = nombreAreaSede;
    var vformname = 'programacionBorrar';
    var vwidth = '600';
    var vheight = '200';
    var patronModulo = 'programacionBorrar';
    var vcenter = 't';
    var vresizable = '';
    var vmodal = 'false';
    var vstyle = '';
    var vopacity = '';
    var veffect = '';
    var vposx1 = '';
    var vposx2 = '';
    var vposy1 = '';
    var vposy2 = '';
    var parametros = '';
    parametros += 'p1=' + patronModulo + '&p2=' + codigoPreProgramacion;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

}

function cargarTablaProgramacionEmpleadoEliminarTurno() {
    var codPreProgramacion = $('codigoPrePRogramacion').value;
    var patronModulo = 'cargarTablaProgramacionEmpleadoEliminarTurno';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codPreProgramacion;
    tablaPRogramacionEliminarTUrno = new dhtmlXGridObject('contenedorProgramacionMantenimientoBorrado');
    tablaPRogramacionEliminarTUrno.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaPRogramacionEliminarTUrno.setSkin("dhx_skyblue");
    tablaPRogramacionEliminarTUrno.enableRowsHover(true, 'grid_hover');
    tablaPRogramacionEliminarTUrno.attachEvent("onRowSelect", function (fila, columna) {
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaPRogramacionEliminarTUrno.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    tablaPRogramacionEliminarTUrno.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    tablaPRogramacionEliminarTUrno.setSkin("dhx_skyblue");
    tablaPRogramacionEliminarTUrno.init();
    tablaPRogramacionEliminarTUrno.loadXML(pathRequestControl + '?' + parametros, function () {
        borrarProgramacionTurnoEmpleadoSeleccionado();
    });
}


function borrarProgramacionTurnoEmpleadoSeleccionado() {
    for (i = 0; i < tablaPRogramacionEliminarTUrno.getRowsNum(); i++) {
        var PreProgramacion = tablaPRogramacionEliminarTUrno.cells(i, 0).getValue();
        var Turno = tablaPRogramacionEliminarTUrno.cells(i, 2).getValue();
        tablaPRogramacionEliminarTUrno.cells(i, 8).setValue('<input id="cboMuestra' + i + '" onclick= "if(this.checked){this.value=1}else{this.value=0;};programacionSeleccionadaTurno(' + i + ')" type="radio" title="Asignar" name="grupoMuestra" value="0">');
    }
}

function programacionSeleccionadaTurno(i) {

    var PreProgramacion = tablaPRogramacionEliminarTUrno.cells(i, 0).getValue();
    var Turno = tablaPRogramacionEliminarTUrno.cells(i, 2).getValue();
    var CodEmpleado = tablaPRogramacionEliminarTUrno.cells(i, 1).getValue();
    $('turno').value = Turno;
    $('empleado').value = CodEmpleado;
}


function btnEliminarProgramacoinTurnoSelecionado() {
    var cboMes = $("cboMes").value;
    var cboAnio = $("cboAnio").value;
    Turno = $('turno').value;
    CodEmpleado = $('empleado').value;
    PreProgramacion = $('codigoPrePRogramacion').value;
    if (Turno == '' && CodEmpleado == '') {
        alert("seleccione un turno...");
    } else {
        if (confirm("¿Desea eliminar los turnos?")) {
            var patronModulo = 'programacionSeleccionadaTurno';
            var parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + PreProgramacion;
            parametros += '&p3=' + Turno;
            parametros += '&p4=' + cboMes;
            parametros += '&p5=' + cboAnio;
            parametros += '&p6=' + CodEmpleado;
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function (transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    alert('Se elimino correctamente la programacion del turno Seleccionado')
                    Windows.close("Div_programacionBorrar");
                    reporteEmpleado();
                }
            })
        }
    }
}

function programacionPorArea(filaArea, filaEmpleado, filaTurno) {
    var tablax = $('tblProgramacionPersonal' + filaArea);
    var codigoPreProgramacion = tablax.tBodies[filaEmpleado].rows[0].cells[0].innerHTML;
    var posFuncion = "";
    var vtitle = "";
    var vformname = 'ProgramacionPorArea';
    var vwidth = '600';
    var vheight = '280';
    var patronModulo = 'programacionPorArea';
    var vcenter = 't';
    var vresizable = '';
    var vmodal = 'false';
    var vstyle = '';
    var vopacity = '';
    var veffect = '';
    var vposx1 = '';
    var vposx2 = '';
    var vposy1 = '';
    var vposy2 = '';
    var parametros = '';
    parametros += 'p1=' + patronModulo + '&p2=' + codigoPreProgramacion;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function programacionTotal(filaArea, filaEmpleado, filaTurno) {
    var cboMes = $("cboMes").value;
    var cboAnio = $("cboAnio").value;
    var tablax = $('tblProgramacionPersonal' + filaArea);
    var iCodigoEmpleado = tablax.tBodies[filaEmpleado].rows[0].cells[4].innerHTML;
    var posFuncion = "";
    var vtitle = "";
    var vformname = 'programacionTotal';
    var vwidth = '680';
    var vheight = '320';
    var patronModulo = 'programacionTotalEmpleadoAreaSede';
    var vcenter = 't';
    var vresizable = '';
    var vmodal = 'false';
    var vstyle = '';
    var vopacity = '';
    var veffect = '';
    var vposx1 = '';
    var vposx2 = '';
    var vposy1 = '';
    var vposy2 = '';
    var parametros = '';
    parametros += 'p1=' + patronModulo + '&p2=' + iCodigoEmpleado + '&p3=' + cboMes + '&p4=' + cboAnio;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------

function programacionActualizar(filaArea, filaEmpleado, filaTurno) {
    var tablax = $('tblProgramacionPersonal' + filaArea);
    var codigoPreProgramacion = trimJunny(tablax.tBodies[filaEmpleado].rows[0].cells[0].innerHTML);
    var iCodigoEmpleado = trimJunny(tablax.tBodies[filaEmpleado].rows[0].cells[4].innerHTML);
    var cboMes = $("cboMes").value;
    var cboAnio = $("cboAnio").value;
    //alert(codigoPreProgramacion);
    var patronModulo = 'actualizarProgramacionEmpleados';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoPreProgramacion;
    parametros += '&p3=' + iCodigoEmpleado;
    parametros += '&p4=' + cboMes;
    parametros += '&p5=' + cboAnio;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            alert(respuesta);
            reporteEmpleado();
        }
    })


}
function programacionActualizarEliminar(codigoPreProgramacion, iCodigoEmpleado, cboMes, cboAnio) {

    //alert(codigoPreProgramacion);
    var patronModulo = 'actualizarProgramacionEmpleados';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoPreProgramacion;
    parametros += '&p3=' + iCodigoEmpleado;
    parametros += '&p4=' + cboMes;
    parametros += '&p5=' + cboAnio;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            alert(respuesta);
            reporteEmpleado();
        }
    })


}

function agregarPersonaProgramacion() {
    var iCodEmpCoordinador = $("hICodEmpCoordinador").value;
    var cboMes = $("cboMes").value;
    var cboAnio = $("cboAnio").value;
    var combo = document.getElementById("cboMes");
    var cboMesValor = combo.options[combo.selectedIndex].text;

    posFuncion = "";
    vtitle = "Buscar Empleado (" + cboMesValor + ")";
    vformname = 'abrirPopudBusquedaPersonalRRHH';
    vwidth = '920';
    vheight = '360';
    var patronModulo = 'abrirPopudBusquedaPersonalRRHH';
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
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iCodEmpCoordinador;
    parametros += '&p3=' + cboMes;
    parametros += '&p4=' + cboAnio;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

/*
 function agregarPersonaProgramacion(){
 var iCodEmpCoordinador = $("hICodEmpCoordinador").value;
 var cboMes = $("cboMes").value;
 var cboAnio = $("cboAnio").value;
 posFuncion = "";
 vtitle = "Buscar Empleado";
 vformname = 'abrirPopudBusquedaPersonalRRHH';
 vwidth = '920';
 vheight = '360';
 var patronModulo = 'abrirPopudBusquedaPersonalRRHH';
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
 parametros = '';
 parametros += 'p1=' + patronModulo;
 parametros += '&p2=' + iCodEmpCoordinador;
 parametros += '&p3=' + cboMes;
 parametros += '&p4=' + cboAnio;
 CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
 }
 */

function busquedaPersonalPorNombres(iEvento) {
    if (iEvento.keyCode == '13') {
        var vApellidoPaterno = $("vApellidoPaterno").value;
        var vApellidoMaterno = $("vApellidoMaterno").value;
        var vNombre = $("vNombre").value;
        var iMes = $("iMes").value;
        var iAnio = $("iAnio").value;
        var patronModulo = 'busquedaPersonalPorNombres';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + vApellidoPaterno;
        parametros += '&p3=' + vApellidoMaterno;
        parametros += '&p4=' + vNombre;
        tablaEmpleadosRRHH = new dhtmlXGridObject('contenedorTablaPersonalRRHH');
        tablaEmpleadosRRHH.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
        tablaEmpleadosRRHH.setSkin("dhx_skyblue");
        tablaEmpleadosRRHH.enableRowsHover(true, 'grid_hover');
        tablaEmpleadosRRHH.attachEvent("onRowDblClicked", function (rId, cInd) {
            var iIdCoordinador = $("iIdCoordinador").value;
            var c_cod_per = tablaEmpleadosRRHH.cells(rId, 0).getValue();
            var iIdPuestoEmpleado = tablaEmpleadosRRHH.cells(rId, 3).getValue();
            var estado = tablaEmpleadosRRHH.cells(rId, 10).getValue();
            validarDatosContratoPersonal(c_cod_per, iIdCoordinador, iMes, iAnio, iIdPuestoEmpleado, estado);
            //  Windows.close("Div_abrirPopudBusquedaPersonalRRHH");
        });
        contadorCargador++;
        var idCargador = contadorCargador;
        tablaEmpleadosRRHH.attachEvent("onXLS", function () {
            cargadorpeche(1, idCargador);
        });
        tablaEmpleadosRRHH.attachEvent("onXLE", function () {
            cargadorpeche(0, idCargador);
            ;
        });
        tablaEmpleadosRRHH.init();
        tablaEmpleadosRRHH.loadXML(pathRequestControl + '?' + parametros, function () {
            var TipoProgramacion;
            var FechaInicio;
            var FechaFin;
            var annofinal;
            var mesfinal;
            var annoInicial;
            var mesInicial;
            var m = tablaEmpleadosRRHH.getRowsNum()
            for (i = 0; i < m; i++) {
                TipoProgramacion = tablaEmpleadosRRHH.cells(i, 4).getValue();
                FechaInicio = tablaEmpleadosRRHH.cells(i, 5).getValue();
                FechaFin = tablaEmpleadosRRHH.cells(i, 6).getValue();
                annofinal = parseInt(tablaEmpleadosRRHH.cells(i, 8).getValue());
                mesfinal = parseInt(tablaEmpleadosRRHH.cells(i, 9).getValue());
                annoInicial = parseInt(tablaEmpleadosRRHH.cells(i, 11).getValue());
                mesInicial = parseInt(tablaEmpleadosRRHH.cells(i, 12).getValue());
                //                                alert("iAnio : "+iAnio +"annofinal : "+annofinal+'---annoInicial'+annoInicial );
                if (parseInt(annofinal) >= parseInt(iAnio) && parseInt(annoInicial) <= parseInt(iAnio)) {
                    //                    alert('lobo 1');
                    if (parseInt(annofinal) == parseInt(iAnio)) {
                        //                         alert(mes +'>='+iMes);//   tablaTablaPAquete.deleteRow(i);
                        if (mesfinal >= iMes && mesInicial <= iMes) {
                            //                                                        alert(1);//tablaEmpleadosRRHH.getRowId(i)
                            tablaEmpleadosRRHH.setRowTextStyle(i, 'background-color:#C1E69D;color:black;border-top: 1px solid #DAEFC2;');
                            tablaEmpleadosRRHH.cells(i, 10).setValue(1);
                            //                           alert("lobo 1:  "+tablaEmpleadosRRHH.getRowId(i) ); 
                        } else {
                            if (mesInicial > iMes || mesfinal < iMes) {
                                //                                                                alert(2);
                                //                                tablaEmpleadosRRHH.setRowTextStyle(i,'background-color:#FFA66A;color:black;border-top: 1px solid #FFD7BB;');
                                //                                tablaEmpleadosRRHH.cells(i,10).setValue(0);
                                tablaEmpleadosRRHH.deleteRow(i);
                            } else {
                                //                                                                alert(3);
                                tablaEmpleadosRRHH.setRowTextStyle(i, 'background-color:#FFA66A;color:black;border-top: 1px solid #FFD7BB;');
                                tablaEmpleadosRRHH.cells(i, 10).setValue(0);
                            }
                        }
                    } else {
                        tablaEmpleadosRRHH.setRowTextStyle(i, 'background-color:#C1E69D;color:black;border-top: 1px solid #DAEFC2;');
                        tablaEmpleadosRRHH.cells(i, 10).setValue(1);
                    }

                } else {
                    tablaEmpleadosRRHH.setRowTextStyle(i, 'background-color:#FFA66A;color:black;border-top: 1px solid #FFD7BB;');
                    tablaEmpleadosRRHH.cells(i, 10).setValue(0);
                }
                if (TipoProgramacion == '' && FechaInicio == '' && FechaFin == '')
                    tablaEmpleadosRRHH.deleteRow(i);
                //                    tablaEmpleadosRRHH.setRowTextStyle(i,'background-color:#FFA66A;color:black;border-top: 1px solid #FFD7BB;');
                //                    
            }

            if (tablaEmpleadosRRHH.getRowsNum() == 0) {
                alert('El Empleado seleccionado requiere regularizar su contrato.Por Favor LLame a RRHH.');
            }
        });
        // $("vApellidoPaterno").value = "";
        // $("vApellidoMaterno").value = "";
        // $("vNombre").value = "";
    }

}





function busquedaPersonalPorDNI(iEvento) {
    if (iEvento.keyCode == '13') {
        var vApellidoPaterno = $("vDNI").value;
        var iMes = $("iMes").value;
        var iAnio = $("iAnio").value;
        var patronModulo = 'busquedaPersonalPorDNI';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + vApellidoPaterno;
        tablaEmpleadosRRHH = new dhtmlXGridObject('contenedorTablaPersonalRRHH');
        tablaEmpleadosRRHH.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
        tablaEmpleadosRRHH.setSkin("dhx_skyblue");
        tablaEmpleadosRRHH.enableRowsHover(true, 'grid_hover');
        tablaEmpleadosRRHH.attachEvent("onRowDblClicked", function (rId, cInd) {
            var iIdCoordinador = $("iIdCoordinador").value;

            var c_cod_per = tablaEmpleadosRRHH.cells(rId, 0).getValue();
            var iIdPuestoEmpleado = tablaEmpleadosRRHH.cells(rId, 3).getValue();
            var estado = tablaEmpleadosRRHH.cells(rId, 10).getValue();
            validarDatosContratoPersonal(c_cod_per, iIdCoordinador, iMes, iAnio, iIdPuestoEmpleado, estado);

            // Windows.close("Div_abrirPopudBusquedaPersonalRRHH");
        });
        contadorCargador++;
        var idCargador = contadorCargador;
        tablaEmpleadosRRHH.attachEvent("onXLS", function () {
            cargadorpeche(1, idCargador);
        });
        tablaEmpleadosRRHH.attachEvent("onXLE", function () {
            cargadorpeche(0, idCargador);
        });
        tablaEmpleadosRRHH.init();
        tablaEmpleadosRRHH.loadXML(pathRequestControl + '?' + parametros, function () {
            var TipoProgramacion;
            var FechaInicio;
            var FechaFin;
            var annofinal;
            var mesfinal;
            var annoInicial;
            var mesInicial;

            var m = tablaEmpleadosRRHH.getRowsNum()
            for (i = 0; i < m; i++) {

                TipoProgramacion = tablaEmpleadosRRHH.cells(i, 4).getValue();
                FechaInicio = tablaEmpleadosRRHH.cells(i, 5).getValue();
                FechaFin = tablaEmpleadosRRHH.cells(i, 6).getValue();
                annofinal = parseInt(tablaEmpleadosRRHH.cells(i, 8).getValue());
                mesfinal = parseInt(tablaEmpleadosRRHH.cells(i, 9).getValue());
                annoInicial = parseInt(tablaEmpleadosRRHH.cells(i, 11).getValue());
                mesInicial = parseInt(tablaEmpleadosRRHH.cells(i, 12).getValue());
                //                alert("contador : "+i +"tabla : "+tablaEmpleadosRRHH.getRowId(i) );
                if (annofinal >= iAnio && annoInicial <= iAnio) {
                    if (annofinal == iAnio) {
                        // alert(mes +'>='+iMes);   tablaTablaPAquete.deleteRow(i);
                        if (mesfinal >= iMes && mesInicial <= iMes) {
                            //                            alert(1);//tablaEmpleadosRRHH.getRowId(i)
                            tablaEmpleadosRRHH.setRowTextStyle(i, 'background-color:#C1E69D;color:black;border-top: 1px solid #DAEFC2;');
                            tablaEmpleadosRRHH.cells(i, 10).setValue(1);
                            //                           alert("lobo 1:  "+tablaEmpleadosRRHH.getRowId(i) ); 
                        } else {
                            if (mesInicial > iMes || mesfinal < iMes) {
                                tablaEmpleadosRRHH.deleteRow(i);
                            } else {
                                //                                alert(3);
                                tablaEmpleadosRRHH.setRowTextStyle(i, 'background-color:#FFA66A;color:black;border-top: 1px solid #FFD7BB;');
                                tablaEmpleadosRRHH.cells(i, 10).setValue(0);
                            }
                        }
                    } else {
                        tablaEmpleadosRRHH.setRowTextStyle(i, 'background-color:#C1E69D;color:black;border-top: 1px solid #DAEFC2;');
                        tablaEmpleadosRRHH.cells(i, 10).setValue(1);
                    }

                } else {
                    tablaEmpleadosRRHH.setRowTextStyle(i, 'background-color:#FFA66A;color:black;border-top: 1px solid #FFD7BB;');
                    tablaEmpleadosRRHH.cells(i, 10).setValue(0);
                }
                //                if(TipoProgramacion=='' && FechaInicio =='' && FechaFin=='')
                //                    tablaEmpleadosRRHH.setRowTextStyle(i,'background-color:#FFA66A;color:black;border-top: 1px solid #FFD7BB;');

            }
            if (tablaEmpleadosRRHH.getRowsNum() == 0) {
                alert('El Empleado seleccionado requiere regularizar su contrato.Por Favor LLame a RRHH.');
            }
        });
        //$("vDNI").value = "";
    }

}



function abrirPopadAreasPorCoordinador(c_cod_per, iIdCoordinador, iMes, iAnio, iIdPuestoEmpleado) {

    posFuncion = "";
    vtitle = "Buscar Empleado";
    vformname = 'abrirPopadAreasPorCoordinador';
    vwidth = '600';
    vheight = '300';
    var patronModulo = 'abrirPopadAreasPorCoordinador';
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
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iIdCoordinador;
    parametros += '&p3=' + iMes;
    parametros += '&p4=' + iAnio;
    parametros += '&p5=' + c_cod_per;
    parametros += '&p6=' + iIdPuestoEmpleado;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

}

function seleccionarArea(iIdArea, valor) {
    if ($('area_' + iIdArea).checked) {
        $('iIdArea_' + iIdArea).value = iIdArea;
    } else {
        $('iIdArea_' + iIdArea).value = '';
    }
}

function aceptarAgregarEmpleadoXCoodinador(iIdsAreas) {
    if ($('iIdCategoriaEmpleado').value == '') {
        alert('El Puesto del empleado no tiene una categoria...');
        // Windows.close("Div_abrirPopudBusquedaPersonalRRHH");
        Windows.close("Div_abrirPopadAreasPorCoordinador");
    } else {
        var iIdAreaUnica = iIdsAreas.split("//");
        var estado = 0;
        var idPuestoEmpleado = $('iPuestoEmpleado').value;
        var imes = $('iMes').value;
        var ianio = $('iAnio').value;
        for (var x = 0; x <= (iIdAreaUnica.length - 2); x++) {
            if ($('iIdArea_' + iIdAreaUnica[x]).value != "") {
                // alert('seleccionado'+ iIdAreaUnica[x]);
                estado = 1;
                var patronModulo = 'mantenimientoAreaPersona';
                var parametros = '';
                parametros += 'p1=' + patronModulo;
                parametros += "&p2=" + iIdAreaUnica[x];
                parametros += "&p3=" + idPuestoEmpleado;
                parametros += "&p4=" + estado;
                parametros += "&p5=" + imes;
                parametros += "&p6=" + ianio;
                contadorCargador++;
                var idCargador = contadorCargador;
                new Ajax.Request(pathRequestControl, {
                    method: 'get',
                    asynchronous: false, // Para que el ajax respete el orden de ejecucion
                    parameters: parametros,
                    onLoading: cargadorpeche(1, idCargador),
                    onComplete: function (transport) {
                        cargadorpeche(0, idCargador);
                        var respuesta = trimJunny(transport.responseText);

                        if (respuesta != 'ok') {
                            alert(respuesta)
                        }
                    }
                }
                )
            } else {
                //alert('no'+ iIdAreaUnica[x]);
                estado = 0;
            }


        }
        Windows.close("Div_abrirPopudBusquedaPersonalRRHH");
        Windows.close("Div_abrirPopadAreasPorCoordinador");
        reporteEmpleado();
    }
}

function busquedaarbolAreaRRHH() {
    treeArbolAreaSede.findItem(document.getElementById("txtSueldo").value);
}


function  validarDatosContratoPersonal(c_cod_per, iIdCoordinador, iMes, iAnio, iIdPuestoEmpleado, estado) {
    var patronModulo = 'validarDatosContratoPersonal';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + c_cod_per;
    parametros += '&p3=' + iIdPuestoEmpleado;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            if (respuesta == 1) {
                if (estado == 1) {
                    abrirPopadAreasPorCoordinador(c_cod_per, iIdCoordinador, iMes, iAnio, iIdPuestoEmpleado)
                } else {
                    alert('El Empleado seleccionado requiere regularizar su contrato.Por Favor LLame a RRHH.')
                }

            } else {
                alert('El Empleado seleccionado requiere regularizar su contrato.Por Favor LLame a RRHH.')
            }

        }
    })
}





function programacionEliminar(filaArea, filaEmpleado, filaTurno) {

    var nombreAreaSede = $('hNombreAreaSede' + filaArea).value
    var tablax = $('tblProgramacionPersonal' + filaArea);
    var anio = $("cboAnio").value;
    var mes = $("cboMes").value;
    var codigoPreProgramacion = tablax.tBodies[filaEmpleado].rows[0].cells[0].innerHTML;
    var iCodigoEmpleado = tablax.tBodies[filaEmpleado].rows[0].cells[4].innerHTML;

    var posFuncion = "cargarTablaTurnosPreProgramacion";
    var vtitle = nombreAreaSede;
    var vformname = 'programacionBorrar';
    var vwidth = '600';
    var vheight = '200';
    var patronModulo = 'programacionEliminarPopadVista';
    var vcenter = 't';
    var vresizable = '';
    var vmodal = 'false';
    var vstyle = '';
    var vopacity = '';
    var veffect = '';
    var vposx1 = '';
    var vposx2 = '';
    var vposy1 = '';
    var vposy2 = '';
    var parametros = '';
    parametros += 'p1=' + patronModulo + '&p2=' + codigoPreProgramacion + '&p3=' + iCodigoEmpleado + '&p4=' + mes + '&p5=' + anio;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);


}


function cargarTablaTurnosPreProgramacion() {
    var codPreProgramacion = $('codigoPrePRogramacion').value;
    var patronModulo = 'cargarTablaTurnosPreProgramacion';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codPreProgramacion;
    tablaPRogramacionEliminar = new dhtmlXGridObject('contenedorProgramacionMantenimientoBorradoPreProgramacion');
    tablaPRogramacionEliminar.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaPRogramacionEliminar.setSkin("dhx_skyblue");
    tablaPRogramacionEliminar.enableRowsHover(true, 'grid_hover');
    tablaPRogramacionEliminar.attachEvent("onRowSelect", function (fila, columna) {
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaPRogramacionEliminar.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    tablaPRogramacionEliminar.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    tablaPRogramacionEliminar.setSkin("dhx_skyblue");
    tablaPRogramacionEliminar.init();
    tablaPRogramacionEliminar.loadXML(pathRequestControl + '?' + parametros, function () {
    });
}

function btnEliminarProgramacoinPreProgramacionSelecionado() {
    if (confirm('Se eliminara al empleado de esta area por este mes y todas sus horas programadas')) {
        var codigoPrePRogramacion = $('codigoPrePRogramacion').value;
        var empleado = $('empleado').value;
        var imes = $('imes').value;
        var ianio = $('ianio').value;
        var patronModulo = 'btnEliminarProgramacoinPreProgramacionSelecionado';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += "&p2=" + codigoPrePRogramacion;
        parametros += "&p3=" + empleado;
        parametros += "&p4=" + imes;
        parametros += "&p5=" + ianio;
        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false, // Para que el ajax respete el orden de ejecucion
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function (transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                alert('se elimino satisfactoriamente...');
                Windows.close("Div_programacionBorrar");
                reporteEmpleado();
            }
        }
        )
    }

}

function programacionTurno(i) {
    var sede = $('hSede' + i).value;
    var area = $('hArea' + i).value;
    var cordinador = $('hNombreCoordinador').value;
    var idSedeempresaArea = $('hidSedeempresaArea' + i).value;

    posFuncion = "CargarlistadoTodosTurnosDisponibles";
    // posFuncion ="josecito()";
    vtitle = "Seleccion de Turno por Area";
    vformname = 'EtiquetaAtributo';
    vwidth = '720';
    vheight = '450';
    patronModulo = 'mantenimientoTurnoCordi';
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
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + sede;
    parametros += '&p3=' + area;
    parametros += '&p4=' + cordinador;
    parametros += '&p5=' + idSedeempresaArea;

    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

}

function eliminarTurnoPersona(opcion) {
    var idCodigoPersonaEmpleada = $('txthidCodigoPersonaEmpleada').value;
    var codigoPersona = $("txthidCodigoPersona").value;
    var idMarcacionPersonal;

    if (opcion == 1) {
        idMarcacionPersonal = $('txtidMarcacionPersonalEntrada').value;


    } else {
        if (opcion == 2) {
            idMarcacionPersonal = $('txtidMarcacionPersonalSalida').value;
        }
    }
    var idTxtAreaObservacion = $("idTxtAreaObservacion").value;
    if (trim(idTxtAreaObservacion).length > 0) {
        if (confirmar("Esta Sego que desea Eliminar")) {
            var parametros = "p1=eliminarTurnoPersona&p2=" + idMarcacionPersonal + "&p3" + idTxtAreaObservacion;

            new Ajax.Request(pathRequestControl, {
                method: 'get',
                asynchronous: false,
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function (transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    BusquedaEmpleadoHorario(idCodigoPersonaEmpleada, codigoPersona, '');

                }
            })
        }
    } else {
        alert("Ingrese la Observacion");
    }
}

function reportePerActElimInsert() {
    var iMes = $('cboMes').value;
    var iAnio = $('cboAnio').value;
    iMes = parseInt(iMes);

    var patronModulo = 'reportePerActElimInsert';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iAnio + '&p3=' + iMes;
    tablaReporteDeActElimInsert = new dhtmlXGridObject('div_reporteActElimInsert');
    tablaReporteDeActElimInsert.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaReporteDeActElimInsert.setSkin("dhx_skyblue");
    tablaReporteDeActElimInsert.enableRowsHover(true, 'grid_hover');
    tablaReporteDeActElimInsert.attachEvent("onRowSelect", function (fila, columna) {
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaReporteDeActElimInsert.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    tablaReporteDeActElimInsert.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    tablaReporteDeActElimInsert.setSkin("dhx_skyblue");
    tablaReporteDeActElimInsert.init();
    tablaReporteDeActElimInsert.loadXML(pathRequestControl + '?' + parametros, function () {
    });

}


/**************************************************************************************/
function limpiaBusquedasMedicos(opc, elemento, evento) {
    //    alert(123456);
    switch (opc)
    {
        case "01": //Busqueda por codigo
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
            document.getElementById('nroDoc').value = '';
            document.getElementById('apellidoPaterno').value = '';
            document.getElementById('apellidoMaterno').value = '';
            document.getElementById('nombres').value = '';

            break;
        case "03": //Busqueda por docuemnto
            document.getElementById('txtCodigo').value = '';
            document.getElementById('apellidoPaterno').value = '';
            document.getElementById('apellidoMaterno').value = '';
            document.getElementById('nombres').value = '';
            break;
        case "04": //busqeuda por nombre
            document.getElementById('txtCodigo').value = '';
            document.getElementById('comboTipoDocumentos').selected = "selected";
            document.getElementById('comboTipoDocumentos').value = "0000";
            document.getElementById('nroDoc').value = '';

            break;
        case "0": //boton limpiar
            document.getElementById('txtCodigo').value = '';
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
    } else {
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
        buscarMedico($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre);
    }
}


function buscarMedico($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre) {
    var patronModulo = "buscarMedico";
    var cod = $cod;
    var estado = $estado;
    if (($estado) == '0001' || ($estado) == '0000') {
        estado = '';
    }
    if (($estado) == '0002') {
        estado = 1;
    }
    if ($estado == '0003') {
        estado = 0;
    }
    var tipoDoc = $tipoDoc;
    var nDoc = $nDoc;
    var apPat = $apPat;
    var apMat = $apMat;
    var nombre = $nombre;
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + cod;
    parametros += '&p3=' + estado;
    parametros += '&p4=' + tipoDoc;
    parametros += '&p5=' + nDoc;
    parametros += '&p6=' + apPat;
    parametros += '&p7=' + apMat;
    parametros += '&p8=' + nombre;

    //parametros="p1=datosExamenPrueba&p2="+idExamen;
    var tablaEmpleados = new dhtmlXGridObject('divTablaResultadosMedicos');
    tablaEmpleados.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaEmpleados.setSkin("dhx_skyblue");
    tablaEmpleados.enableRowsHover(true, 'grid_hover');

    tablaEmpleados.attachEvent("onRowDblClicked", function (rId, cInd) {
        var codEmpleado = tablaEmpleados.cells(rId, 0).getValue();
        var codPer = tablaEmpleados.cells(rId, 1).getValue();
        var vNombreCompleto = tablaEmpleados.cells(rId, 2).getValue();
        var iidPuesto = '';
        var iidCentroCosto = '';
        var fechaIni = document.getElementById('txtFechaIni').value
        var fechaFinal = document.getElementById('txtFechaFinal').value
        reporteAsistenciaMedico(codPer, iidPuesto, iidCentroCosto, fechaIni, fechaFinal)

    });
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaEmpleados.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    tablaEmpleados.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaEmpleados.init();
    tablaEmpleados.loadXML(pathRequestControl + '?' + parametros);

}
/*******************************************************************************************/


function abrirPopapAsignacionDeTurnosAsignados(fila, columna) {
    //    tablahoraExtrasTrabajadas.cells(i,12).getValue()
    var iIdTipoProgramacion = tablahoraExtrasTrabajadas.cells(fila, 3).getValue();
    var iidPuestoEmpleado = tablahoraExtrasTrabajadas.cells(fila, 4).getValue();
    var codigoPersona = tablahoraExtrasTrabajadas.cells(fila, 1).getValue();
    var vNombreCompleto = tablahoraExtrasTrabajadas.cells(fila, 2).getValue();
    var vHoraInicio = tablahoraExtrasTrabajadas.cells(fila, 6).getValue();
    var vHoraFin = tablahoraExtrasTrabajadas.cells(fila, 7).getValue();
    var iHoraInicio = vHoraInicio.substring(0, 2);
    var iHorafin = vHoraFin.substring(0, 2);
    var vFecha = tablahoraExtrasTrabajadas.cells(fila, 5).getValue();
    //    alert(iHorafin);
    posFuncion = "";
    vtitle = "";
    vformname = 'EtiquetaAtributo';
    vwidth = '420';
    vheight = '250';
    patronModulo = 'abrirPopapAsignacionDeTurnosAsignados';
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
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iIdTipoProgramacion;
    parametros += '&p3=' + iidPuestoEmpleado;
    parametros += '&p4=' + vNombreCompleto;
    parametros += '&p5=' + vFecha;
    parametros += '&p6=' + codigoPersona

    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

}
function descripcionCboSedeArea() {
    var cboSucursal = $("cboSede").value;
    var codigoPersona = $('txthidCodigoPersona').value;
    var iidPuestoEmpleado = $('hiidPuestoEmpleado').value;

    var patronModulo = 'descripcionCboSedeArea';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + cboSucursal;
    parametros += "&p3=" + codigoPersona;
    parametros += "&p4=" + iidPuestoEmpleado;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('div_areaSede').update(respuesta);
            cboSedeAreasTurnos();
        }
    }
    )
}

function cboSedeAreasTurnos() {
    var iIdSedeEmpresaArea = $("cboAreaNuevo").value;
    //    alert(iIdSedeEmpresaArea);
    var patronModulo = 'cboSedeAreasTurnos';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + iIdSedeEmpresaArea;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('div_areaSedeTurnos').update(respuesta);

        }
    })
}

function guardarNuevaProgramacionReemplanzo() {
    var iIdSedeEmpresaArea = $("cboAreaNuevo").value;
    var iIdTurnosAreaSede = $("cboidSedeEmpresaAreaTurno").value;
    var idPuestoEmpleado = $("hiidPuestoEmpleado").value;
    var fechaProgramada = $("hFechaProgramada").value;
    var iIdTipoProgramacion = $("hiIdTipoProgramacion").value;
    var idMotivoReProgramacion = $("cboidMotivoReProgramacion").value;
    var txtAreaVDescripcionMotivo = $("txtAreaVDescripcionMotivo").value;

    var patronModulo = 'guardarNuevaProgramacionReemplanzo';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + iIdSedeEmpresaArea;
    parametros += "&p3=" + iIdTurnosAreaSede;
    parametros += "&p4=" + idPuestoEmpleado;
    parametros += "&p5=" + fechaProgramada;
    parametros += "&p6=" + iIdTipoProgramacion;
    parametros += "&p7=" + idMotivoReProgramacion;
    parametros += "&p8=" + txtAreaVDescripcionMotivo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            var c_cod_per = $("txthidCodigoPersona").value;
            var iIdModalidadContrato = $("hiIdModalidadContrato").value;
            var cInd = $("hicInd").value;
            var vNombreCompleto = $("txthnombreCompleto").value;
            var codEmpleado = $("hicodEmpleado").value;
            var txtFechaIni = $("txtFechaIni").value;
            var txtFechaFinal = $("txtFechaFinal").value;
            if (respuesta != 1) {
                alert(respuesta);
            } else {
                BusquedaEmpleadoHorario(codEmpleado, c_cod_per, vNombreCompleto, iIdModalidadContrato, cInd);
                horaExtrasTrabajadas(txtFechaIni, txtFechaFinal, c_cod_per);
            }

        }
    })
}

function cargaArbolCCostoHorariosMedicos() {


    var parametros = "p1=generaArbolCentroCostos";

    var divMostrar = document.getElementById('divCCostosMedicos');
    divMostrar.innerHTML = " ";
    treeCentroCostos = new dhtmlXTreeObject("divCCostosMedicos", "100%", "100%", 0);
    treeCentroCostos.setSkin('dhx_skyblue');
    treeCentroCostos.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    treeCentroCostos.attachEvent("onClick", function () {
        //  buscarEmpleadosCentroCostos();
        buscarMedicosCentroCostosHorarios(treeCentroCostos.getSelectedItemId(), treeCentroCostos.getSelectedItemText());
    });

    treeCentroCostos.openAllItems(0);
    //    treex.setXMLAutoLoading(pathRequestControl+'?'+parametros);
    treeCentroCostos.loadXML(pathRequestControl + '?' + parametros);
}

function buscarMedicosCentroCostosHorarios(iCodigoCentroCosto, vDescripcionCentroCosto) {

    var patronModulo = "buscarMedicosCentroCostosHorarios";

    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iCodigoCentroCosto;
    //parametros="p1=datosExamenPrueba&p2="+idExamen;
    var tablaEmpleadosMedico = new dhtmlXGridObject('divTablaResultadosMedicos');
    tablaEmpleadosMedico.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaEmpleadosMedico.setSkin("dhx_skyblue");
    tablaEmpleadosMedico.enableRowsHover(true, 'grid_hover');

    //    var filtroPeril = "<input type='text' id='txtNombreExamenfiltro' style='width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarExamenes();\" />"; 
    var filtroPeril = "<input type='text' id='txtNombreExamenfiltro' style='width:90%;font-size:8pt;font-family:Tahoma; ' />";
    var header = [, , "#text_filter", , , , , ];
    tablaEmpleadosMedico.attachHeader(header);

    tablaEmpleadosMedico.attachEvent("onRowDblClicked", function (rId, cInd) {
        var codEmpleado = tablaEmpleadosMedico.cells(rId, 0).getValue();
        var codPer = tablaEmpleadosMedico.cells(rId, 1).getValue();
        var vNombreCompleto = tablaEmpleadosMedico.cells(rId, 2).getValue();
        var iidPuesto = tablaEmpleadosMedico.cells(rId, 5).getValue();
        var iidCentroCosto = tablaEmpleadosMedico.cells(rId, 6).getValue();
        var fechaIni = document.getElementById('txtFechaIni').value
        var fechaFinal = document.getElementById('txtFechaFinal').value
        reporteAsistenciaMedico(codPer, iidPuesto, iidCentroCosto, fechaIni, fechaFinal);
    });
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaEmpleadosMedico.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    tablaEmpleadosMedico.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);

    });
    /////////////fin cargador ///////////////////////
    tablaEmpleadosMedico.init();

    tablaEmpleadosMedico.loadXML(pathRequestControl + '?' + parametros, function () {
    });
}

function agregarPersonalTurnoRegularizar() {
    var idCodigoPersona = $('txthidCodigoPersona').value;
    var nombreCompleto = $('txthnombreCompleto').value;
    //alert(idCodigoPersona);
    if (idCodigoPersona != '') {
        posFuncion = "noeditarCombos";
        vtitle = '<b>' + nombreCompleto.toUpperCase() + '</b>';
        vformname = 'PersonalTurnoRegularizar';
        vwidth = '640';
        vheight = '350';
        patronModulo = 'agregarPersonalTurnoRegularizar';
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
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + idCodigoPersona;
        parametros += '&p3=' + nombreCompleto;
        CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
    } else {
        alert("No ah Seleccionado un Empleado");
        document.getElementById("apellidoPaterno").focus();
    }
}
function noeditarCombos() {
    document.getElementById("cboidSedeEmpresa").disabled = true;
    $('cboAreaNuevo').disabled = true;
    $('div_PopapbotonBuscarAreaRegularizar').hide();
    document.getElementById("cboidSedeEmpresaAreaTurno").disabled = true;
    document.getElementById("cbonsmPuestoEmpelado").disabled = true;
}

function cboSedeAreaNuevo() {
    var cboSucursal;
    cboSucursal = $("cboidSedeEmpresa").value;
    var codigoPersona = $('txthidCodigoPersona').value;
    var iidPuestoEmpelado = $('cbonsmPuestoEmpelado').value;
    var fecha = $('txtFecha').value;
    var patronModulo = 'cboSedeAreaNuevo';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + cboSucursal;
    parametros += "&p3=" + codigoPersona;
    parametros += "&p4=" + iidPuestoEmpelado;
    parametros += "&p5=" + fecha;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('div_areaSede').update(respuesta);
            actualizarSedeAreaNuevoTurnos();
        }
    }
    )
}

function cboSedeAreasTurnosNuevo() {

    var iIdSedeEmpresaArea = $("cboAreaNuevo").value;
    //        alert(iIdSedeEmpresaArea);
    var patronModulo = 'cboSedeAreasTurnos';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + iIdSedeEmpresaArea;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('div_areaSedeTurnos').update(respuesta);
            //            CargaPuestoEmpleadoArea();
        }
    })
}

function funcionPuestoEmpleadoBoton() {
    //       var iIdSedeEmpresaArea=$("cboAreaNuevo").value;
    //    //        alert(iIdSedeEmpresaArea);
    var patronModulo = 'funcionPuestoEmpleadoBoton';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    //    parametros+="&p2="+iIdSedeEmpresaArea;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('div_ActualizarSede').update(respuesta);

            cboTipoProgramacion()
        }
    })
}

function cboTipoProgramacion() {
    var idPuestoEmpleadoArea = $("cbonsmPuestoEmpelado").value;
    var CodigoPersona = $('txthidCodigoPersona').value;
    var cbonsmPuestoEmpelado = $('cbonsmPuestoEmpelado').value;
    var patronModulo = 'cboTipoProgramacion';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + idPuestoEmpleadoArea;
    parametros += "&p3=" + CodigoPersona;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('div_TipoProgramacion').update(respuesta);
            document.getElementById("cboidSedeEmpresa").disabled = false;
            $('cboAreaNuevo').disabled = false;
            $('cboidSedeEmpresaAreaTurno').disabled = false;
            document.getElementById("cboidSedeEmpresaAreaTurno").disabled = false;
            $('div_PopapbotonBuscarAreaRegularizar').show();
            if (cbonsmPuestoEmpelado == 0) {
                document.getElementById("cboidSedeEmpresa").disabled = true;
                $('cboAreaNuevo').disabled = true;
                $('cboidSedeEmpresaAreaTurno').disabled = true;

                $('div_PopapbotonBuscarAreaRegularizar').hide();
            }
        }
    })

}

function verBuscadorAreasRegularizar() {
    var vformname = 'AreaSede'
    var vtitle = 'Buscar Area Sede'
    var vwidth = '500'
    var vheight = '480'
    var vcenter = 't'
    var vresizable = ''
    var vmodal = 'false'
    var vstyle = ''
    var vopacity = ''
    var vposx1 = ''
    var vposx2 = ''
    var vposy1 = ''
    var vposy2 = ''
    var funcionArbol = '';
    var patronModulo = 'buscarAreasRegularizar';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    var posFuncion = 'cargarArbolHMLORegularizar';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
}
function cargarArbolHMLORegularizar(id) {
    var sede;
    if (id == 1) {
        sede = $('cboSede').value;
    } else {
        sede = $('cboidSedeEmpresa').value;
    }
    var parametros = "p1=arbolAreas";
    parametros += "&p2=" + sede;
    divMostrar = document.getElementById('divArbolAreasSedes');
    divMostrar.innerHTML = " ";
    treeArbolAreaSedeNuevo = new dhtmlXTreeObject("divArbolAreasSedes", "100%", "100%", 0);
    treeArbolAreaSedeNuevo.setSkin('dhx_skyblue');
    treeArbolAreaSedeNuevo.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    treeArbolAreaSedeNuevo.attachEvent("onClick", function () {
        actualizarLaSede(sede);
        actualizarSedeAreaNuevo1(sede, treeArbolAreaSedeNuevo.getSelectedItemId());
        //        actualizarLaSede(treeArbolAreaSedeNuevo.getSelectedItemId(),treeArbolAreaSedeNuevo.getSelectedItemText());
    });
    treeArbolAreaSedeNuevo.openAllItems(0);
    treeArbolAreaSedeNuevo.loadXML(pathRequestControl + '?' + parametros);
}

function actualizarLaSede(sede) {

    var patronModulo = 'actualizarLaSede';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + sede;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('div_ActualizarSede').update(respuesta);

        }
    })
}

function actualizarSedeAreaNuevo11(cSede, IdArea) {
    var cboSucursal = cSede;

    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            actualizarSedeAreaNuevo(cboSucursal, IdArea);
        }
    }
    )
}


function  actualizarSedeAreaNuevo(cboSucursal, IdArea) {
    var codigoPersona = $('txthidCodigoPersona').value;
    var iidPuestoEmpleado = $('cbonsmPuestoEmpelado').value;
    var patronModulo = 'actualizarSedeAreaNuevo';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + cboSucursal;
    parametros += "&p3=" + codigoPersona;
    parametros += "&p4=" + IdArea;
    parametros += "&p5=" + iidPuestoEmpleado;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('div_areaSede').update(respuesta);
            actualizarSedeAreaNuevoTurnos();
        }
    }
    )
}

function actualizarSedeAreaNuevoTurnos() {
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            cboSedeAreasTurnosNuevo();
        }
    }
    )
}

function agregarTurnoEmporesaArea() {
    //    document.getElementById("cboidSedeEmpresa").value
    var indiceSede = document.getElementById("cboidSedeEmpresa").selectedIndex;
    var sede = document.getElementById("cboidSedeEmpresa").options[indiceSede].text;

    var indiceArea = document.getElementById("cboAreaNuevo").selectedIndex;
    var area = document.getElementById("cboAreaNuevo").options[indiceArea].text;

    //    var cordinador=$('hNombreCoordinador').value;
    var idSedeempresaArea = document.getElementById("cboAreaNuevo").value;

    posFuncion = "CargarlistadoTodosTurnosDisponiblesNuevo";
    // posFuncion ="josecito()";
    vtitle = "Seleccion de Turno por Area";
    vformname = 'EtiquetaAtributo';
    vwidth = '720';
    vheight = '450';
    patronModulo = 'mantenimientoTurnoCordiNuevo';
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
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + sede;
    parametros += '&p3=' + area;
    parametros += '&p4=' + '';//cordinador;
    parametros += '&p5=' + idSedeempresaArea;

    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

}

function CargarlistadoTodosTurnosDisponiblesNuevo() {
    var nomSedeEmpresaArea = $("nomSedeEmpresaArea").value;
    //alert(nomSedeEmpresaArea);
    var parametros = "p1=CargarlistadoTodosTurnosDisponibles&p2=" + nomSedeEmpresaArea;
    var div = "Div_TablaListaTurnosDisponibles";
    //var funcionClick="listarEmpleados";
    var funcionClick = "capturaCodTurnoDeListaDisponiblexAreaNuevo";
    var funcionDblClick = "";
    var funcionLoad = "listaTurnosxSedeEmpresaArea";
    generarTablay(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}

function capturaCodTurnoDeListaDisponiblexAreaNuevo(fil, col) {
    var codTurno = mygridy.cells(fil, 0).getValue();
    $("hCodTurno").value = codTurno;
}

function asignarTurnoDisponibleAlAreaNuevo() {
    var codTurno = $("hCodTurno").value;
    var idSedeEmpresaArea = $("nomSedeEmpresaArea").value;
    if (codTurno != '') {
        var parametros = "p1=asignarTurnoDisponibleAlArea&p2=" + codTurno + "&p3=" + idSedeEmpresaArea;

        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false, // Para que el ajax respete el orden de ejecucion
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function (transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                RefrescarTablaTurnosDisponiblesxArea();
                cboSedeAreasTurnosNuevo();
            }
        })

    } else {
        alert("Seleccione algun turno disponible");
    }

}
function quitarTurnoSeleccionadoAlAreaNuevo() {
    var IdTurnoAreaSede = $("hIdTurnoAreaSede").value;
    if (IdTurnoAreaSede != '') {
        var form = "";
        var destino = "";
        //var funcion="RefrescarTablaListaEmpleados("+idEmpresaSedearea+")";
        var funcion = "RefrescarTablaTurnosDisponiblesxArea";
        var parametros = "p1=quitarTurnoSeleccionadoAlArea&p2=" + IdTurnoAreaSede;
        enviarFormulario(form, parametros, funcion, destino);

        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false, // Para que el ajax respete el orden de ejecucion
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function (transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                cboSedeAreasTurnosNuevo();
            }
        }
        )
    } else {

        alert("Seleccione un turno del area para quitarlo")
    }
}


function guardarPersonalTurnoRegularizar() {
    var iidPuestoEmpelado = $("cbonsmPuestoEmpelado").value;
    var cidSucursal = $("cboidSedeEmpresa").value;
    var iIdSedeEmpresaArea = $("cboAreaNuevo").value;
    var dFecha = $("txtFecha").value;
    var iIdTurnosAreaSede = $("cboidSedeEmpresaAreaTurno").value;
    var iidTipoProgramacion;
    if (document.getElementById("cboTipoProgramacion")) {
        iidTipoProgramacion = $("cboTipoProgramacion").value;
    }
    var codigoPersona = $('txthidCodigoPersona').value;
    var idMotivoReProgramacion = $('cboidMotivoReProgramacion').value;
    var txtAreaVDescripcionMotivo = $('txtAreaVDescripcionMotivo').value;

    var patronModulo = 'guardarPersonalTurnoRegularizar';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + iIdSedeEmpresaArea;
    parametros += "&p3=" + iIdTurnosAreaSede;
    parametros += "&p4=" + codigoPersona;
    parametros += "&p5=" + iidPuestoEmpelado;
    parametros += "&p6=" + dFecha;
    parametros += "&p7=" + iidTipoProgramacion;
    parametros += "&p8=" + idMotivoReProgramacion;
    parametros += "&p9=" + txtAreaVDescripcionMotivo;

    if (iidPuestoEmpelado != 0 && iIdSedeEmpresaArea != '' && iIdTurnosAreaSede != '' && dFecha != '' && iidTipoProgramacion != '') {
        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false, // Para que el ajax respete el orden de ejecucion
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function (transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                var c_cod_per = $("txthidCodigoPersona").value;
                var iIdModalidadContrato = $("hiIdModalidadContrato").value;
                var cInd = $("hicInd").value;
                var vNombreCompleto = $("txthnombreCompleto").value;
                var codEmpleado = $("hicodEmpleado").value;
                var txtFechaIni = $("txtFechaIni").value;
                var txtFechaFinal = $("txtFechaFinal").value;
                if (trim(respuesta) != 1) {
                    alert(respuesta);
                } else {
                    BusquedaEmpleadoHorario(codEmpleado, c_cod_per, vNombreCompleto, iIdModalidadContrato, cInd);
                    horaExtrasTrabajadas(txtFechaIni, txtFechaFinal, c_cod_per);
                }
                document.getElementById("cbonsmPuestoEmpelado").style.backgroundColor = '#FFFFFF';
                document.getElementById("cboAreaNuevo").style.backgroundColor = '#FFFFFF';
                document.getElementById("cboidSedeEmpresaAreaTurno").style.backgroundColor = '#FFFFFF';
                document.getElementById("txtFecha").style.backgroundColor = '#FFFFFF';
                document.getElementById("cboTipoProgramacion").style.backgroundColor = '#FFFFFF';


            }
        })

    } else {
        if (iidPuestoEmpelado == 0) {
            document.getElementById("cbonsmPuestoEmpelado").style.backgroundColor = '#D15138';
        } else {
            document.getElementById("cbonsmPuestoEmpelado").style.backgroundColor = '#FFFFFF';
        }
        if (iIdSedeEmpresaArea == '') {
            document.getElementById("cboAreaNuevo").style.backgroundColor = '#D15138';
        } else {
            document.getElementById("cboAreaNuevo").style.backgroundColor = '#FFFFFF';
        }
        if (iIdTurnosAreaSede == '') {
            document.getElementById("cboidSedeEmpresaAreaTurno").style.backgroundColor = '#D15138';
        } else {
            document.getElementById("cboidSedeEmpresaAreaTurno").style.backgroundColor = '#FFFFFF';
        }
        if (dFecha == '') {
            document.getElementById("txtFecha").style.backgroundColor = '#D15138';
        } else {
            document.getElementById("txtFecha").style.backgroundColor = '#FFFFFF';
        }
        if (document.getElementById("cboTipoProgramacion")) {
            if (iidTipoProgramacion == '') {
                document.getElementById("cboTipoProgramacion").style.backgroundColor = '#D15138';
            } else {
                document.getElementById("cboTipoProgramacion").style.backgroundColor = '#FFFFFF';
            }
        }
    }

}

function verBuscadorAreasRegularizarEmpleado() {
    var vformname = 'AreaSede'
    var vtitle = 'Buscar Area Sede'
    var vwidth = '500'
    var vheight = '480'
    var vcenter = 't'
    var vresizable = ''
    var vmodal = 'false'
    var vstyle = ''
    var vopacity = ''
    var vposx1 = ''
    var vposx2 = ''
    var vposy1 = ''
    var vposy2 = ''
    var funcionArbol = '';
    var patronModulo = 'buscarAreasRegularizarPersona';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    var posFuncion = 'cargarArbolHMLORegularizar2';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
}
function cargarArbolHMLORegularizar2(id) {
    var sede;
    if (id == 1) {
        sede = $('cboSede').value;
    } else {
        sede = $('cboSede').value;
    }
    var parametros = "p1=arbolAreas";
    parametros += "&p2=" + sede;
    divMostrar = document.getElementById('divArbolAreasSedes');
    divMostrar.innerHTML = " ";
    treeArbolAreaSedeNuevo1 = new dhtmlXTreeObject("divArbolAreasSedes", "100%", "100%", 0);
    treeArbolAreaSedeNuevo1.setSkin('dhx_skyblue');
    treeArbolAreaSedeNuevo1.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    treeArbolAreaSedeNuevo1.attachEvent("onClick", function () {
        actualizarLaSedeEmpleado(sede);
        actualizarSedeAreaNuevo2(sede, treeArbolAreaSedeNuevo1.getSelectedItemId(), 3);
    });
    treeArbolAreaSedeNuevo1.openAllItems(0);
    treeArbolAreaSedeNuevo1.loadXML(pathRequestControl + '?' + parametros);
}

function actualizarLaSedeEmpleado(sede) {

    var patronModulo = 'actualizarLaSedeEmpleado';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + sede;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            //            alert(respuesta);
            $('div_cboSede').update(respuesta);

        }
    })
}

function actualizarSedeAreaNuevo2(cSede, IdArea, i) {
    var cboSucursal = cSede;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            actualizarSedeAreaNuevo1(cboSucursal, IdArea, i);
        }
    }
    )
}

function  actualizarSedeAreaNuevo1(cboSucursal, IdArea, i) {
    var iidPuestoEmpleado;
    var codigoPersona = $('txthidCodigoPersona').value;
    if (i == 3) {
        iidPuestoEmpleado = $('hiidPuestoEmpleado').value;
    } else {
        iidPuestoEmpleado = $('cbonsmPuestoEmpelado').value;
    }

    var patronModulo = 'actualizarSedeAreaNuevo1';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + cboSucursal;
    parametros += "&p3=" + codigoPersona;
    parametros += "&p4=" + IdArea;
    parametros += "&p5=" + iidPuestoEmpleado;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('div_areaSede').update(respuesta);
            actualizarSedeAreaNuevoTurnos1();

        }
    }
    )
}

function actualizarSedeAreaNuevoTurnos1() {
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            cboSedeAreasTurnosNuevo1();
        }
    }
    )
}

function cboSedeAreasTurnosNuevo1() {

    var iIdSedeEmpresaArea = $("cboAreaNuevo").value;
    var patronModulo = 'cboSedeAreasTurnos1';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + iIdSedeEmpresaArea;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('div_areaSedeTurnos').update(respuesta);
        }
    })
}

function agregarTurnoEmporesaAreaPersona() {
    var indiceSede = document.getElementById("cboSede").selectedIndex;
    var sede = document.getElementById("cboSede").options[indiceSede].text;

    var indiceArea = document.getElementById("cboAreaNuevo").selectedIndex;
    var area = document.getElementById("cboAreaNuevo").options[indiceArea].text;

    var idSedeempresaArea = document.getElementById("cboAreaNuevo").value;

    posFuncion = "CargarlistadoTodosTurnosDisponiblesPersona";
    vtitle = "Seleccion de Turno por Area";
    vformname = 'EtiquetaAtributo12';
    vwidth = '720';
    vheight = '450';
    patronModulo = 'mantenimientoTurnoCordiPersona';
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
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + sede;
    parametros += '&p3=' + area;
    parametros += '&p4=' + '';//cordinador;
    parametros += '&p5=' + idSedeempresaArea;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
}

function CargarlistadoTodosTurnosDisponiblesPersona() {

    var nomSedeEmpresaArea = $("nomSedeEmpresaArea").value;
    //alert(nomSedeEmpresaArea);
    var parametros = "p1=CargarlistadoTodosTurnosDisponibles&p2=" + nomSedeEmpresaArea;
    var div = "Div_TablaListaTurnosDisponibles";
    //var funcionClick="listarEmpleados";
    var funcionClick = "capturaCodTurnoDeListaDisponiblexAreaPersona";
    var funcionDblClick = "";
    var funcionLoad = "listaTurnosxSedeEmpresaArea";
    generarTablay(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}

function capturaCodTurnoDeListaDisponiblexAreaPersona(fil, col) {
    var codTurno = mygridy.cells(fil, 0).getValue();
    $("hCodTurno").value = codTurno;
}

function asignarTurnoDisponibleAlAreaPersona() {
    var codTurno = $("hCodTurno").value;
    var idSedeEmpresaArea = $("nomSedeEmpresaArea").value;
    if (codTurno != '') {
        var parametros = "p1=asignarTurnoDisponibleAlArea&p2=" + codTurno + "&p3=" + idSedeEmpresaArea;

        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false, // Para que el ajax respete el orden de ejecucion
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function (transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                RefrescarTablaTurnosDisponiblesxArea();
                cboSedeAreasTurnosNuevo1();
            }
        })
    } else {
        alert("Seleccione algun turno disponible");
    }

}
function quitarTurnoSeleccionadoAlAreaPersona() {
    var IdTurnoAreaSede = $("hIdTurnoAreaSede").value;
    if (IdTurnoAreaSede != '') {
        var form = "";
        var destino = "";
        //var funcion="RefrescarTablaListaEmpleados("+idEmpresaSedearea+")";
        var funcion = "RefrescarTablaTurnosDisponiblesxArea";
        var parametros = "p1=quitarTurnoSeleccionadoAlArea&p2=" + IdTurnoAreaSede;
        enviarFormulario(form, parametros, funcion, destino);

        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false, // Para que el ajax respete el orden de ejecucion
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function (transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                cboSedeAreasTurnosNuevo1();
            }
        }
        )
    } else {
        alert("Seleccione un turno del area para quitarlo")
    }
}

function reporteAsistenciaMedico(codPer, iidPuesto, iidCentroCosto, fechaIni, fechaFinal) {

    var parametros = '';
    parametros += 'p1=' + 'reporteAsistenciaMedico';
    parametros += '&p2=' + codPer;
    parametros += '&p3=' + iidPuesto;
    parametros += '&p4=' + iidCentroCosto;
    parametros += '&p5=' + fechaIni;
    parametros += '&p6=' + fechaFinal;


    //parametros="p1=datosExamenPrueba&p2="+idExamen;
    var tablaAsistenciaMedicos = new dhtmlXGridObject('divTablaMedicosPuestos');
    tablaAsistenciaMedicos.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaAsistenciaMedicos.setSkin("dhx_skyblue");
    tablaAsistenciaMedicos.enableRowsHover(true, 'grid_hover');
    //    var filtroPeril = "<input type='text' id='txtNombreExamenfiltro' style='width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarExamenes();\" />"; 
    var filtroPeril = "<input type='text' id='txtNombreExamenfiltro' style='width:90%;font-size:8pt;font-family:Tahoma; ' />";
    var header = [, , , "#select_filter", , , , , , , , , ];
    tablaAsistenciaMedicos.attachHeader(header);

    tablaAsistenciaMedicos.attachEvent("onRowDblClicked", function (rId, cInd) {


    });
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaAsistenciaMedicos.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    tablaAsistenciaMedicos.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaAsistenciaMedicos.init();
    tablaAsistenciaMedicos.loadXML(pathRequestControl + '?' + parametros);

}

function cargarPuestoEmpleado() {
    var dFecha = $("txtFecha").value;
    var idCodigoPersona = $('txthidCodigoPersona').value;
    var nombreCompleto = $('txthnombreCompleto').value;

    var parametros = "p1=cargarPuestoEmpleado&p2=" + idCodigoPersona + "&p3=" + nombreCompleto + "&p4=" + dFecha;

    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('div_nsmPuesto').update(respuesta);

        }
    })
}

function validarQueNoExitaProgramacion(idContrato, fechaInicioVacacion, fechaFinVacacion) {
    var a;
    var parametros = "p1=validarQueNoExitaProgramacion&p2=" + idContrato + "&p3=" + fechaInicioVacacion + "&p4=" + fechaFinVacacion;

    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            if (parseInt(trim(respuesta)) == 0) {
                a = 0;
            } else {
                var b;
                var c;
                if (parseInt(trim(respuesta)) == 1) {
                    b = 60;
                    c = 80;
                } else {
                    if (parseInt(trim(respuesta)) == 2) {
                        b = parseInt(trim(respuesta)) * 150;
                        c = 100;
                    } else {
                        if (parseInt(trim(respuesta)) >= 3 && parseInt(trim(respuesta)) <= 5) {
                            b = parseInt(trim(respuesta)) * 90;
                            c = parseInt(trim(respuesta)) * 34;
                        } else {
                            b = 320;
                            c = 220;
                        }


                    }

                }
                document.getElementById('Div_cruceDeHorarioDescanso').style.height = c;
                tablaCrucedeHorarioParaTipoDescanso(idContrato, fechaInicioVacacion, fechaFinVacacion);
                document.getElementById('Div_popadAsignacionVacacionesMantenimiento_content').style.height = b;
                a = 1;
            }
        }
    })
    return a;
}

function tablaCrucedeHorarioParaTipoDescanso(idContrato, fechaInicioVacacion, fechaFinVacacion) {

    var parametros = "p1=tablaCrucedeHorarioParaTipoDescanso&p2=" + idContrato + "&p3=" + fechaInicioVacacion + "&p4=" + fechaFinVacacion;
    var tablaCrucedeHorarioParaTipoDescanso1 = new dhtmlXGridObject('Div_cruceDeHorarioDescanso');
    tablaCrucedeHorarioParaTipoDescanso1.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaCrucedeHorarioParaTipoDescanso1.setSkin("dhx_skyblue");
    tablaCrucedeHorarioParaTipoDescanso1.enableRowsHover(true, 'grid_hover');
    tablaCrucedeHorarioParaTipoDescanso1.attachEvent("onRowSelect", function (rId, cInd) {
        eliminarProgramacion(tablaCrucedeHorarioParaTipoDescanso1, rId, cInd);
    });
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaCrucedeHorarioParaTipoDescanso1.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    tablaCrucedeHorarioParaTipoDescanso1.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaCrucedeHorarioParaTipoDescanso1.init();
    tablaCrucedeHorarioParaTipoDescanso1.loadXML(pathRequestControl + '?' + parametros);

}

function eliminarProgramacion(tablaCrucedeHorarioParaTipoDescanso1, rId, cInd) {
    if (cInd == 5) {
        var iIdProgramacionEmpleados = tablaCrucedeHorarioParaTipoDescanso1.cells(rId, 0).getValue();
        var parametros = "p1=eliminarProgramacion&p2=" + iIdProgramacionEmpleados;
        if (confirm("ESTA SEGURO QUE DESEA ELIMINAR TURNO")) {
            contadorCargador++;
            var idCargador = contadorCargador;
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                asynchronous: false, // Para que el ajax respete el orden de ejecucion
                parameters: parametros,
                onLoading: cargadorpeche(1, idCargador),
                onComplete: function (transport) {
                    cargadorpeche(0, idCargador);
                    //                    var respuesta = transport.responseText;
                    var idContrato = document.getElementById('txtIdContrato').value;
                    var fechaInicioVacacion = document.getElementById('txtFechaInicioVacacion').value;
                    var fechaFinVacacion = document.getElementById('txtFechaFinVacacion').value;
                    tablaCrucedeHorarioParaTipoDescanso(idContrato, fechaInicioVacacion, fechaFinVacacion);

                }
            })
        }
    }
}

function validarFechaMenorMayor(txtDesdeFechai, txtHastaFechaf) {
    var bEstadiValidarFecha;
    var strFechaIni = txtDesdeFechai.trim();
    var strFechaFin = txtHastaFechaf.trim();

    if (validaFecha(strFechaIni) == 1 && validaFecha(strFechaFin) == 1) {
        var i = new Date(toMMDDYYYY(strFechaIni));
        var f = new Date(toMMDDYYYY(strFechaFin));
        var rs;
        if (i != undefined && f != undefined) {
            rs = DateDiff.inDays(i, f);
            if (rs > 0) {
                bEstadiValidarFecha = 1;
            } else {
                bEstadiValidarFecha = 0;
            }
        }
    } else {
        bEstadiValidarFecha = 0;
    }
    return bEstadiValidarFecha;
}