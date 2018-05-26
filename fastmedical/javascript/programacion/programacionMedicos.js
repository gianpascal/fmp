/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var pathRequestControl = "../../ccontrol/control/control.php";
var tree;
function busquedaarbol() {
    treeCentroCostos.findItem(document.getElementById("txtbuscarservicio").value);
}
function clickCargaCentroCostoProgramacionMedicos(idcentrocosto, nombrecentrocosto)
{
    document.getElementById("hidcentrocosto").value = idcentrocosto;
    $('Div_nombrecentrocosto').innerHTML = "<h1>" + nombrecentrocosto.toUpperCase() + "</h1>";


    //    pathLink = "p1=cargaEmpleadosProgramacionMedicosxCC&p2="+idcentrocosto;
    //    new Ajax.Request( pathRequestControl,{
    //        method : 'get',
    //        parameters : pathLink,
    //        onLoading : micargador(1),
    //        onComplete : function(transport){
    //            micargador(0);
    //            respuesta = transport.responseText;
    //            $('Div_datosEmpleadoMedicos').update(respuesta);
    //        }
    //    })
    //    
    patronModulo = 'cargaEmpleadosProgramacionMedicosxCC'
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + idcentrocosto;
    sEmpleadoMedicos = new dhtmlXGridObject('Div_datosEmpleadoMedicos');
    sEmpleadoMedicos.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    sEmpleadoMedicos.setSkin("dhx_skyblue");
    sEmpleadoMedicos.enableRowsHover(true, 'grid_hover');
    sEmpleadoMedicos.attachEvent("onRowSelect", function(rowId, cellInd) {
        var parametroCadena = sEmpleadoMedicos.cells(rowId, 0).getValue();
        seleccionaMedicoProgramacionMedicos('', '', parametroCadena);
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    sEmpleadoMedicos.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    sEmpleadoMedicos.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    /////////////fin cargador ///////////////////////
    sEmpleadoMedicos.setSkin("dhx_skyblue");
    sEmpleadoMedicos.init();
    sEmpleadoMedicos.loadXML(pathRequestControl + '?' + parametros);

}
//function recargarArbolServicios()
//{
//    myDiv=document.getElementById('Div_centroCostos');
//    myDiv.innerHTML = " ";
//    tree=new dhtmlXTreeObject("Div_centroCostos","100%","100%",0);
//    tree.setImagePath("../../../../fastmedical_front/imagen/icono/tree/");
//    tree.attachEvent("onClick", function(){
//        clickCargaCentroCostoProgramacionMedicos(tree.getSelectedItemId(),tree.getSelectedItemText());
//        return true;
//    })
//    tree.loadXML("../../../../carpetaDocumentos/arbol_centroCostos.xml");
//    tree.openAllItems(0);
//}
//---------------
function recargarArbolServicios() {


    var parametros = "p1=generaArbolCentroCostos";

    var divMostrar = document.getElementById('Div_centroCostos');
    divMostrar.innerHTML = " ";
    treeCentroCostos = new dhtmlXTreeObject("Div_centroCostos", "100%", "100%", 0);
    treeCentroCostos.setSkin('dhx_skyblue');
    treeCentroCostos.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    treeCentroCostos.attachEvent("onClick", function() {
        //  buscarEmpleadosCentroCostos();
        clickCargaCentroCostoProgramacionMedicos(treeCentroCostos.getSelectedItemId(), treeCentroCostos.getSelectedItemText());
    });

    treeCentroCostos.openAllItems(0);
    //    treex.setXMLAutoLoading(pathRequestControl+'?'+parametros);
    treeCentroCostos.loadXML(pathRequestControl + '?' + parametros);
//getMedicosdhtmlx();
}
//--------------

function agregarProgramacion() {

    document.getElementById("hhorainicio").value = "0000";
    document.getElementById("hhorafinal").value = "0000";
    document.getElementById("hcodigoambientefisico").value = "0000";
    document.getElementById("hFechasAProgramar").value = "";
    if (document.getElementById("hcodigopersona").value != "") {
        idcentrocosto = document.getElementById("hidcentrocosto").value;
        //cargaAmbientesLogicosProgramacionMedicos(idcentrocosto);//Todavia no es necesario que este cargado para que se elija el puesto
        cargaActividadesProgramacionMedicos();
        accionNuevaProgramacionMedicos();
        micargador(0);
        $("divGeneralProgramacionMedicos1").hide();
        $("divGeneralProgramacionMedicos2").show();
        //$("divBusquedasProgramacionMedicos").hide();
        //$("divFondoProgramacionMedicos").hide();
        $("divProgramacionMedicos").show();
        refrescarCalendarioNuevaprogramacionMedicos();
        cronogramaxAfiliacion();
        mostrarbotonGrabar();

    }
    else {
        window.alert("Debe seleccionar un personal para agregar Programación");
    }
}
//////******************CALENDARIO PROGRAMACION DE MEDICOS*****************/////
function seleccionarFechaProgramacionMedicos(idElemento, cal) {
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

function seleccionarFechasPorDia(elementoCheck, numDiaDeLaSemana, cal) {
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
            }
            else {
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
    }
    else {//Si se deseleccionan todos los dias
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

function accionCalendarioProgramacionMedicos(idAccion, cal) {
    arrayInput = document.getElementById(cal).getElementsByTagName("input");
    fechaActual = arrayInput[20].value + arrayInput[19].value + arrayInput[18].value;
    pathLink = "p1=calendario02&p2=" + fechaActual + "&p3=" + idAccion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText.split("|");
            fechaActual2 = respuesta[1];
            document.getElementById("hFechaSeleccionada").value = fechaActual2;
            document.getElementById("hFechasAProgramar").value = "";
            document.getElementById("divCalendario").update(respuesta[0]);
        }
    })
}
/********************************************************************************/
function accionNuevaProgramacionMedicos() {
    codigopersona = document.getElementById("hcodigopersona").value;
    idcentrocosto = document.getElementById("hidcentrocosto").value;
    pathLink = "p1=cargaPuestosProgramacionMedicos&p2=" + codigopersona + "&p3=" + idcentrocosto;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Div_puestos').update(respuesta);
            document.getElementById("cb_filtro_actividad").disabled = true;
            document.getElementById("cb_filtro_puestos").disabled = false;
        }
    })
}
function cargarEstadisticaMensualMedico() {
    codigomedico = document.getElementById("hcodigopersona").value;
    messeleccionMedicos = document.getElementById("cb_filtro_mes").value;
    anioseleccionMedicos = document.getElementById("cb_filtro_anio").value;

    patronModulo = 'cargarEstadisticaMensualMedico';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigomedico;
    parametros += '&p3=' + messeleccionMedicos;
    parametros += '&p4=' + anioseleccionMedicos;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Div_estadisticaMensual').update(respuesta);
        }
    })
}
function seleccionaMedicoProgramacionMedicos(html, event, codigoynombre) {
    var datos = codigoynombre.split("|");
    var codigopersona = datos[0];
    var nombrepersona = datos[1];
    document.getElementById("hnombrepersona").value = nombrepersona;
    $('Div_nombreMedico').innerHTML = "<h1>" + nombrepersona + "</h1>";
    $('Div_nombreMedico2').innerHTML = "<h1>" + nombrepersona + "</h1>";
    document.getElementById("hcodigopersona").value = codigopersona;
    var messeleccionMedicos = document.getElementById("cb_filtro_mes").value;
    var anioseleccionMedicos = document.getElementById("cb_filtro_anio").value;
    var codigosede = '';//$('cb_filtroSede').value;
    var patronModulo = 'mostrarseleccionProgramacionMedicos';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigopersona;
    parametros += '&p3=' + messeleccionMedicos;
    parametros += '&p4=' + anioseleccionMedicos;
    parametros += '&p5=' + codigosede;
    ostrarseleccionProgramacionMedicos = new dhtmlXGridObject('Div_ProgramacionMedicoMensual');
    ostrarseleccionProgramacionMedicos.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    ostrarseleccionProgramacionMedicos.setSkin("dhx_skyblue");
    ostrarseleccionProgramacionMedicos.enableRowsHover(true, 'grid_hover');
    ostrarseleccionProgramacionMedicos.attachEvent("onRowSelect", function(rowId, cellInd) {
        var IdProgramacion = ostrarseleccionProgramacionMedicos.cells(rowId, 0).getValue();
        var Fecha = ostrarseleccionProgramacionMedicos.cells(rowId, 1).getValue();
        var Turno = ostrarseleccionProgramacionMedicos.cells(rowId, 6).getValue();
        var permisos = ostrarseleccionProgramacionMedicos.cells(rowId, 17).getValue();
        var Activo = ostrarseleccionProgramacionMedicos.cells(rowId, 12).getValue();
        var msj = ostrarseleccionProgramacionMedicos.cells(rowId, 18).getValue();
        //alert(msj);
        if (Activo==1){
            if (permisos == 1) {
                if (cellInd == 14) {
                    editarProgramacionMedicos(IdProgramacion);
                    $('var1').value = nombrepersona;
                    $('var2').value = IdProgramacion;
                    $('var3').value = Fecha;
                    $('var4').value = Turno;
                }
                if (cellInd == 15) {
                    abrirPopudEliminarProgramacion(IdProgramacion,0);
                //eliminarProgramacionMedicos(IdProgramacion);
                }
                if (cellInd == 16) {
                    autorizarReprogramacionMedicos(IdProgramacion);
                }                                
            }            
        }else {
            if (permisos == 0 && Activo == 0) {
                if (cellInd == 15) {
                    abrirPopudEliminarProgramacion(IdProgramacion,1)
                //eliminarProgramacionMedicos(IdProgramacion);
                }               
            }
        }
        if (cellInd == 18) {           
            mostrarEdicionProgramacion(IdProgramacion);
        }
       
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    ostrarseleccionProgramacionMedicos.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    ostrarseleccionProgramacionMedicos.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    ostrarseleccionProgramacionMedicos.setSkin("dhx_skyblue");
    ostrarseleccionProgramacionMedicos.enableMultiline(true);
    ostrarseleccionProgramacionMedicos.init();
    ostrarseleccionProgramacionMedicos.loadXML(pathRequestControl+'?'+parametros,function(){
        var activo;
        var pasado;
        for(i=0;i<ostrarseleccionProgramacionMedicos.getRowsNum();i++){
            activo = ostrarseleccionProgramacionMedicos.cells(i,12).getValue();
            pasado = ostrarseleccionProgramacionMedicos.cells(i,17).getValue();
            if(activo=='1' && pasado=='0')
                ostrarseleccionProgramacionMedicos.setRowTextStyle(ostrarseleccionProgramacionMedicos.getRowId(i) ,'background-color:#DBDBDB;color:black;border-top: 0px solid #FAFAF8;');                           
            else if(activo=='1' && pasado=='1')
                ostrarseleccionProgramacionMedicos.setRowTextStyle(ostrarseleccionProgramacionMedicos.getRowId(i) ,'background-color:#82D33F;color:black;border-top: 0px solid #FAFAF8;');
            else if(activo=='0' && pasado=='1')
                ostrarseleccionProgramacionMedicos.setRowTextStyle(ostrarseleccionProgramacionMedicos.getRowId(i) ,'background-color:#FFAEFA;color:black;border-top: 0px solid #FFAEFA;');
            else if(activo=='0' && pasado=='0')
                ostrarseleccionProgramacionMedicos.setRowTextStyle(ostrarseleccionProgramacionMedicos.getRowId(i) ,'background-color:#FFAEFA;color:black;border-top: 0px solid #FFAEFA;');
       
        }
    });   
    cargarEstadisticaMensualMedico();
}
function filtrobusquedasfechasProgramacionMedicos() {
    codigopersona = document.getElementById("hcodigopersona").value;
    nombrepersona = document.getElementById("hnombrepersona").value;
    if (codigopersona == "") {
        window.alert("Seleccionar un Empleado");
    } else {
        seleccionaMedicoProgramacionMedicos('', '', codigopersona + '|' + nombrepersona);
    }
}
function seleccionaPuestoProgramacionMedicos() {
    if ($("cb_filtro_actividad").disabled) {
        $("cb_filtro_actividad").disabled = false;
    }
    else {
        $("cb_filtro_actividad").value = "0000";
        seleccionaActividadProgramacionMedicos();
    }
}
/*
 function seleccionaPuestoProgramacionMedicos(){
 codigopuesto = document.getElementById("cb_filtro_puestos").value;
 pathLink = "p1=cargaServiciosProgramacionMedicos&p2="+codigopuesto;
 new Ajax.Request( pathRequestControl,{
 method : 'get',
 parameters : pathLink,
 onLoading : micargador(1),
 onComplete : function(transport){
 micargador(0);
 respuesta = transport.responseText;
 $('Div_servicios').update(respuesta);
 //document.getElementById("cb_filtro_servicios").disabled = false;
 document.getElementById("cb_filtro_actividad").disabled = false;
 }
 })
 }*/

/*function cargaAmbientesLogicosProgramacionMedicos(idcentrocosto)
 {
 codigosede = $('cb_filtroSede').value;
 patronModulo='cargaAmbientesLogicosProgramacionMedicos';
 parametros='';
 parametros+='p1='+patronModulo;
 parametros+='&p2='+idcentrocosto;
 parametros+='&p3='+codigosede;
 
 new Ajax.Request( pathRequestControl,{
 method : 'get',
 parameters : parametros,
 onLoading : micargador(1),
 onComplete : function(transport){
 micargador(0);
 respuesta = transport.responseText;
 $('Div_ambienteslogicos').update(respuesta);
 $("cb_filtro_ambienteslogicos").disabled = true;
 }
 })
 }*/

function seleccionaAmbientesLogicosProgramacionMedicos() {
    codigoambientelogico = $("cb_filtro_ambienteslogicos").value;
    codigoactividad = $("cb_filtro_actividad").value;
    codigosede = $("cb_filtroSede").value;
    pathLink = "p1=cargaAmbientesFisicosProgramacionMedicos&p2=" + codigoambientelogico + "&p3=" + codigoactividad + "&p4=" + codigosede;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Div_ambientesfisicos').update(respuesta);
            cargaTurnoInicioProgramacionMedicos();
            if ($("cb_filtro_turnoinicio").disabled) {
                $("cb_filtro_turnoinicio").disabled = false;
            } else {
                $("cb_filtro_turnoinicio").value = '0000';
            }
        }
    })
}
function seleccionaAmbientesFisicosProgramacionMedicos() {
    cargaTurnoInicioProgramacionMedicos();
    if ($("cb_filtro_turnoinicio").disabled) {
        $("cb_filtro_turnoinicio").disabled = false;
    } else {
        $("cb_filtro_turnoinicio").value = '0000';
    }

}
function cargaTurnoInicioProgramacionMedicos(accion) {

    pathLink = "p1=cargaTurnoProgramacionMedicos&p2=-1";
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            var respuesta = transport.responseText;
            $('Div_turnoinicio').update(respuesta);
            switch (accion) {
                case '2':
                    turnoinicioauxiliar = document.getElementById("hhorainicio").value;
                    opt = document.getElementById("cb_filtro_turnoinicio").options;
                    i = 0;
                    while (i < opt.length) {
                        if (opt[i].value == turnoinicioauxiliar) {
                            opt[i].selected = true;
                        }
                        i = i + 1;
                    }
                    break;
            }
        }
    })
}
function cargaTurnoFinalProgramacionMedicos() {
    var turnoinicio = document.getElementById("cb_filtro_turnoinicio").value;
    pathLink = "p1=cargaTurnoProgramacionMedicos&p2=" + turnoinicio;
    document.getElementById("cb_filtro_turnofinal").disabled = false;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            var respuesta = transport.responseText;
            $('Div_turnofinal').update(respuesta);
            var turnofinalauxiliar = document.getElementById("hhorafinal").value;
            opt = document.getElementById("cb_filtro_turnofinal").options;
            i = 0;
        /*
            while (i < opt.length) {
                if (opt[i].value == turnofinalauxiliar) {
                    opt[i].selected = true;
                }
                i = i + 1;
            }
            */
        }
    })
}
function cargaActividadesProgramacionMedicos() {

    pathLink = "p1=cargaActividadesProgramacionMedicos";
    document.getElementById("cb_filtro_actividad").disabled = true;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Div_actividad').update(respuesta);

        }
    })
}
function seleccionaActividadProgramacionMedicos() {
    var idPuesto = document.getElementById("cb_filtro_puestos").value;
    var codigoActividad = document.getElementById("cb_filtro_actividad").value;
    pathLink = "p1=cargaServiciosPorActividadDeCentroCosto&p2=" + idPuesto + "&p3=" + codigoActividad;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Div_servicios').update(respuesta);
            if ($("cb_filtro_servicios").disabled) {
                $("cb_filtro_servicios").disabled = false;
            } else {
                $("cb_filtro_servicios").value = "0000";
                cargaTiempoAtencionProgramacionMedicos();
            }
        //document.getElementById("cb_filtro_servicios").disabled = false;
        //document.getElementById("cb_filtro_actividad").disabled = false;
        }
    })
}
/*
 //document.getElementById("cb_filtro_puestos").disabled = false;
 codigopuesto = document.getElementById("cb_filtro_puestos").value;
 pathLink = "p1=cargaServiciosProgramacionMedicos&p2="+codigopuesto;
 new Ajax.Request( pathRequestControl,{
 method : 'get',
 parameters : pathLink,
 onLoading : micargador(1),
 onComplete : function(transport){
 micargador(0);
 respuesta = transport.responseText;
 $('Div_servicios').update(respuesta);
 //document.getElementById("cb_filtro_servicios").disabled = false;
 document.getElementById("cb_filtro_actividad").disabled = false;
 }
 })
 */
function seleccionaServicioProgramacionMedicos() {
    var idPuesto = $('cb_filtro_puestos').value;
    cargaAmbienteLogicoPorPuesto(idPuesto);
    cargaTiempoAtencionProgramacionMedicos();

}
function cargaTiempoAtencionProgramacionMedicos() {
    if ($("cb_filtro_ambienteslogicos").disabled) {
        $("cb_filtro_ambienteslogicos").disabled = false;

    } else {
        $("cb_filtro_ambienteslogicos").value = "0000";
        if ($("cb_filtro_ambientefisico").disabled) {
            $("cb_filtro_ambientefisico").disabled = false;
        } else {
            $("cb_filtro_ambientefisico").value = "0000";
        }
    }
    codigoservicio = $("cb_filtro_servicios").value;
    pathLink = "p1=cargaTiempoAtencionProgramacionMedicos&p2=" + codigoservicio;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            if ($("cb_filtro_servicios").value == "0000") {
                $("txttiempoatencion").value = 0;
            } else {
                $("txttiempoatencion").value = respuesta;
            }

        }
    })
}
function cargaAmbienteLogicoPorPuesto(idPuesto) {
    codigosede = $('cb_filtroSede').value;
    //alert('Alert: '+codigosede);
    patronModulo = 'cargaAmbienteLogicoPorPuesto';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + idPuesto;
    parametros += '&p3=' + codigosede;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Div_ambienteslogicos').update(respuesta);
        //document.getElementById("cb_filtro_ambienteslogicos").disabled = true;
        }
    })
}
function editarProgramacionMedicos(valor) {
    titulo = 'Programación de Médicos...'
    vFormaAbrir = 'VENTANA'
    vformname = 'opcionProgramacionMedicos'
    vtitle = 'Programación de Médicos...'
    vwidth = '400'
    vheight = '250'
    vcenter = 't'
    vresizable = ''
    vmodal = 'false'
    vstyle = ''
    vopacity = ''
    veffect = ''
    vposx1 = ''
    vposx2 = ''
    vposy1 = ''
    vposy2 = ''
    file01 = ''
    vfunctionjava = ''
    patronModulo = 'opcionProgramacionMedicos';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + valor;
    posFuncion = '';
    document.getElementById("hcodigocronograma").value = valor;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)

}
function autorizarReprogramacionMedicos(valor) {

    titulo = 'Programación de Médicos...'
    vFormaAbrir = 'VENTANA'
    vformname = 'autorizacionProgramacionMedicos'
    vtitle = 'Programación de Médicos...'
    vwidth = '350'
    vheight = '150'
    vcenter = 't'
    vresizable = ''
    vmodal = 'false'
    vstyle = ''
    vopacity = ''
    veffect = ''
    vposx1 = ''
    vposx2 = ''
    vposy1 = ''
    vposy2 = ''
    file01 = ''
    vfunctionjava = ''


    patronModulo = 'autorizacionProgramacionMedicos';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + valor;
    posFuncion = '';
    document.getElementById("hcodigocronograma").value = valor;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)

}

function seleccionaHoraFinal() {
    //calculaCantidadCupos();
    horainicio = document.getElementById("cb_filtro_turnoinicio").value;
    horafinal = document.getElementById("cb_filtro_turnofinal").value;
    pathLink = "p1=codigoTurnoProgramacionMedicos&p2=" + horainicio + "&p3=" + horafinal;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            document.getElementById("hcodigoturno").value = respuesta;
            calculaCantidadCupos();
        }
    })

}


function calculaCantidadCupos() {
    indiceHoraInicio = $('cb_filtro_turnoinicio').selectedIndex;
    indiceHoraFinal = $('cb_filtro_turnofinal').selectedIndex;

    if (indiceHoraInicio != 0 && indiceHoraFinal != 0) {
        horaInicioTurno = $('cb_filtro_turnoinicio').value;
        horaFinalTurno = $('cb_filtro_turnofinal').value;

        //Actualizamos descripcion de turno mostrado
        arrayHoraInicioTurno = horaInicioTurno.split(".");
        arrayHoraFinalTurno = horaFinalTurno.split(".");

        parteEnteraHoraInicioTurno = arrayHoraInicioTurno[0];
        parteDecimalHoraInicioTurno = arrayHoraInicioTurno[1];

        parteEnteraHoraFinalTurno = arrayHoraFinalTurno[0];
        parteDecimalHoraFinalTurno = arrayHoraFinalTurno[1];

        if (parseFloat(horaFinalTurno) > parseFloat(horaInicioTurno)) {
            totalHorasTurno = parseFloat(horaFinalTurno) - parseFloat(horaInicioTurno);
            totalHorasTurnoCadena = String(totalHorasTurno.toFixed(1));
            arrayTotalHorasTurno = totalHorasTurnoCadena.split(".");
            parteEntera = arrayTotalHorasTurno[0];
            parteDecimal = arrayTotalHorasTurno[1];
            if (parteDecimal == 7 || parteDecimal == 3) {
                parteDecimal = "30";
            }
            else {
                parteDecimal = "00";
            }
            totalHorasCalculadas = parteEntera + "." + parteDecimal;
        }
        else {
            if (parseFloat(horaFinalTurno) < parseFloat(horaInicioTurno)) {
                horasRestantesDia = parseFloat(24) - parseFloat(horaInicioTurno);
                horasSiguienteDia = horaFinalTurno;
                totalHorasTurno = parseFloat(horasRestantesDia) + parseFloat(horasSiguienteDia);
                totalHorasTurnoCadena = String(totalHorasTurno.toFixed(1));
                arrayTotalHorasTurno = totalHorasTurnoCadena.split(".");
                parteEntera = arrayTotalHorasTurno[0];
                parteDecimal = arrayTotalHorasTurno[1];

                if (parteDecimal == 7 || parteDecimal == 3) {
                    parteDecimal = "30";
                }
                else {
                    parteDecimal = "00";
                }
                totalHorasCalculadas = parteEntera + "." + parteDecimal;
            }
            else {
                if (parseFloat(horaFinalTurno) == parseFloat(horaInicioTurno)) {
                    alert("Seleccione horas distintas");
                    totalHorasCalculadas = "0.00";
                }
            }
        }
        //Convertimos el totalHorasCalculadas a minutos
        arrayTotalHorasCalculadas = totalHorasCalculadas.split(".");
        horas = arrayTotalHorasCalculadas[0];
        minutos = arrayTotalHorasCalculadas[1];
        totalMinutos = parseFloat(horas) * 60 + parseFloat(minutos);

        numCupos = parseFloat(totalMinutos) / parseFloat($('txttiempoatencion').value);//El tiempo de atencion debe estar expresado en minutos
        numCupos = numCupos.toFixed(0);
        $('txtcuposxturno').value = numCupos;
    }
}
//function seleccionarafiliaciones(nombrelista,campooculto){
//    var cadena;
//    var cantidadseleccionados;
//    var i;
//    cadena = "";
//    cantidadseleccionados = 0;
//    for (k = 0; k < document.getElementById(nombrelista).length; k += 1){
//        if (document.getElementById(nombrelista).item(k).selected == 1) {
//            cantidadseleccionados = cantidadseleccionados + 1;
//        }
//    }
//    i = 0;
//    for (j = 0; j < document.getElementById(nombrelista).length; j += 1){
//        if (document.getElementById(nombrelista).item(j).selected == 1 &&  i!=cantidadseleccionados-1) {
//            cadena = cadena + document.getElementById(nombrelista).item(j).value+"|";
//            i = i + 1;
//        }else{
//            if (document.getElementById(nombrelista).item(j).selected == 1 && i == cantidadseleccionados-1 ) {
//                cadena = cadena + document.getElementById(nombrelista).item(j).value;
//                i = i + 1;
//            }
//        }
//    }
//    document.getElementById(campooculto).value = cadena;
//
//}
function contarafiliaciones(nombrelista, campooculto) {
    var cadena;
    var cantidadseleccionados;
    var i;
    cadena = "";
    i = 0;
    for (j = 0; j < document.getElementById(nombrelista).length; j += 1) {
        if (j != document.getElementById(nombrelista).length - 1) {
            cadena = cadena + document.getElementById(nombrelista).item(j).value + "|";
            i = i + 1;
        } else {
            cadena = cadena + document.getElementById(nombrelista).item(j).value;
            i = i + 1;
        }
    }
    document.getElementById(campooculto).value = cadena;

}
function agregarAfiliaciones() {
    afiliacionesnoasignadas = new Array();
    afiliacionesasignadas = new Array();
    asignacionauxiliar = new Array();
    asignacionauxiliar2 = new Array();

    afiliacionesnoasignadas = document.getElementById("lst_afiliacionesnoseleccionadas");
    afiliacionesasignadas = document.getElementById("lst_afiliacionesseleccionadas");
    j = 0;
    numSeleccionados = 0;

    for (k = 0; k < afiliacionesnoasignadas.length; k += 1) {
        if (afiliacionesnoasignadas.item(k).selected == 1) {
            asignacionauxiliar[j] = new Array(2);
            asignacionauxiliar[j][0] = afiliacionesnoasignadas.item(k).value;
            asignacionauxiliar[j][1] = afiliacionesnoasignadas.item(k).text;
            j = j + 1;
        }
    }
    numSeleccionados = j;
    if (numSeleccionados == 1) {
        existeitem = false;
        for (k = 0; k < afiliacionesasignadas.length; k += 1) {
            if (afiliacionesasignadas.item(k).value == asignacionauxiliar[0][0]) {
                existeitem = true;
            }
        }
        if (!existeitem) {
            try {
                afiliacionesasignadas.add(new Option(asignacionauxiliar[0][1], asignacionauxiliar[0][0]), null);//Pasamos a ESSALUD como la unica afiliación activa excluyente
                afiliacionesnoasignadas.remove(afiliacionesnoasignadas.selectedIndex);
            }
            catch (e) { //in IE, try the below version instead of add()
                afiliacionesasignadas.add(new Option(asignacionauxiliar[0][1], asignacionauxiliar[0][0]), null);//Pasamos a ESSALUD como la unica afiliación activa excluyente
                afiliacionesnoasignadas.remove(afiliacionesnoasignadas.selectedIndex);
            }
        }
    }
    else {
        if (numSeleccionados > 1) {
            for (i = 0; i < asignacionauxiliar.length; i += 1) {
                existeitem = false;
                for (k = 0; k < afiliacionesasignadas.length; k += 1) {
                    if (afiliacionesasignadas.item(k).value == asignacionauxiliar[i][0]) {
                        existeitem = true;
                    }
                }
                if (!existeitem) {
                    try {
                        afiliacionesasignadas.add(new Option(asignacionauxiliar[i][1], asignacionauxiliar[i][0]), null) //add new option to end of "sample"
                        afiliacionesnoasignadas.remove(afiliacionesnoasignadas.selectedIndex);
                    }
                    catch (e) { //in IE, try the below version instead of add()
                        afiliacionesasignadas.add(new Option(asignacionauxiliar[i][1], asignacionauxiliar[i][0])) //add new option to end of "sample"
                        afiliacionesnoasignadas.remove(afiliacionesnoasignadas.selectedIndex);
                    }
                }
            }
        }
    }
    contarafiliaciones("lst_afiliacionesnoseleccionadas", "hafiliacionesnoasignadas")
    contarafiliaciones("lst_afiliacionesseleccionadas", "hafiliacionesasignadas")
}

function agregarAfiliacionesPopad() {
    afiliacionesnoasignadas = new Array();
    afiliacionesasignadas = new Array();
    asignacionauxiliar = new Array();
    asignacionauxiliar2 = new Array();

    afiliacionesnoasignadas = document.getElementById("lst_afiliacionesnoseleccionadas");
    afiliacionesasignadas = document.getElementById("lst_afiliacionesseleccionadas");
    j = 0;
    numSeleccionados = 0;

    for (k = 0; k < afiliacionesnoasignadas.length; k += 1) {
        if (afiliacionesnoasignadas.item(k).selected == 1) {
            asignacionauxiliar[j] = new Array(2);
            asignacionauxiliar[j][0] = afiliacionesnoasignadas.item(k).value;
            asignacionauxiliar[j][1] = afiliacionesnoasignadas.item(k).text;
            j = j + 1;
        }
    }
    numSeleccionados = j;
    if (numSeleccionados == 1) {
        existeitem = false;
        for (k = 0; k < afiliacionesasignadas.length; k += 1) {
            if (afiliacionesasignadas.item(k).value == asignacionauxiliar[0][0]) {
                existeitem = true;
            }
        }
        if (!existeitem) {
            try {
                afiliacionesasignadas.add(new Option(asignacionauxiliar[0][1], asignacionauxiliar[0][0]), null);//Pasamos a ESSALUD como la unica afiliación activa excluyente
                afiliacionesnoasignadas.remove(afiliacionesnoasignadas.selectedIndex);
            }
            catch (e) { //in IE, try the below version instead of add()
                afiliacionesasignadas.add(new Option(asignacionauxiliar[0][1], asignacionauxiliar[0][0]), null);//Pasamos a ESSALUD como la unica afiliación activa excluyente
                afiliacionesnoasignadas.remove(afiliacionesnoasignadas.selectedIndex);
            }
        }
    }
    else {
        if (numSeleccionados > 1) {
            for (i = 0; i < asignacionauxiliar.length; i += 1) {
                existeitem = false;
                for (k = 0; k < afiliacionesasignadas.length; k += 1) {
                    if (afiliacionesasignadas.item(k).value == asignacionauxiliar[i][0]) {
                        existeitem = true;
                    }
                }
                if (!existeitem) {
                    try {
                        afiliacionesasignadas.add(new Option(asignacionauxiliar[i][1], asignacionauxiliar[i][0]), null) //add new option to end of "sample"
                        afiliacionesnoasignadas.remove(afiliacionesnoasignadas.selectedIndex);
                    }
                    catch (e) { //in IE, try the below version instead of add()
                        afiliacionesasignadas.add(new Option(asignacionauxiliar[i][1], asignacionauxiliar[i][0])) //add new option to end of "sample"
                        afiliacionesnoasignadas.remove(afiliacionesnoasignadas.selectedIndex);
                    }
                }
            }
        }
    }
    contarafiliaciones("lst_afiliacionesnoseleccionadas", "hafiliacionesnoasignadas")
    contarafiliaciones("lst_afiliacionesseleccionadas", "hafiliacionesasignadas")
    capturarValoresArray();
}
/*
 function agregarAfiliaciones(){
 afiliacionesnoasignadas = new Array();
 afiliacionesasignadas = new Array();
 asignacionauxiliar = new Array();
 asignacionauxiliar2 = new Array();
 
 afiliacionesnoasignadas = document.getElementById("lst_afiliacionesnoseleccionadas");
 afiliacionesasignadas = document.getElementById("lst_afiliacionesseleccionadas");
 j = 0;
 numSeleccionados=0;
 indiceEssalud=0;
 for (k = 0; k < afiliacionesnoasignadas.length; k += 1){
 if (afiliacionesnoasignadas.item(k).selected == 1) {
 asignacionauxiliar[j] = new Array(2);
 asignacionauxiliar[j][0] = afiliacionesnoasignadas.item(k).value;
 asignacionauxiliar[j][1] = afiliacionesnoasignadas.item(k).text;
 if(afiliacionesnoasignadas.item(k).text=='ESSALUD'){
 indiceEssalud=j;
 }
 j = j + 1;
 }
 }
 numSeleccionados=j;
 if(numSeleccionados==1 && asignacionauxiliar[0][1]=='ESSALUD'){
 //ESSALUD con las demás afiliaciones son excluyentes
 existeitem = false;
 for (k = 0; k < afiliacionesasignadas.length; k += 1){
 if (afiliacionesasignadas.item(k).value == asignacionauxiliar[0][0]) {
 existeitem = true;
 }
 }
 if(!existeitem){
 try{
 //Retornamos todas las afiliaciones
 afiliacionesnoasignadas.remove(afiliacionesnoasignadas.selectedIndex);
 for(i = 0; i < afiliacionesasignadas.length; i++){
 asignacionauxiliar2[i] = new Array(2);
 asignacionauxiliar2[i][0] = afiliacionesasignadas.item(i).value;
 asignacionauxiliar2[i][1] = afiliacionesasignadas.item(i).text;
 }
 numFiliacionesAsignadas= afiliacionesasignadas.length;
 for(i = 0; i < numFiliacionesAsignadas; i++){
 afiliacionesasignadas.remove(0);//Voy eliminando los que quedan
 afiliacionesnoasignadas.add(new Option(asignacionauxiliar2[i][1], asignacionauxiliar2[i][0]), null);
 }
 afiliacionesasignadas.add(new Option(asignacionauxiliar[0][1], asignacionauxiliar[0][0]), null);//Pasamos a ESSALUD como la unica afiliación activa excluyente
 }
 catch(e){ //in IE, try the below version instead of add()
 //Retornamos todas las afiliaciones
 afiliacionesnoasignadas.remove(afiliacionesnoasignadas.selectedIndex);
 for(i = 0; i < afiliacionesasignadas.length; i++){
 asignacionauxiliar2[i] = new Array(2);
 asignacionauxiliar2[i][0] = afiliacionesasignadas.item(i).value;
 asignacionauxiliar2[i][1] = afiliacionesasignadas.item(i).text;
 }
 numFiliacionesAsignadas= afiliacionesasignadas.length;
 for(i = 0; i < numFiliacionesAsignadas; i++){
 afiliacionesasignadas.remove(0);//Voy eliminando los que quedan
 afiliacionesnoasignadas.add(new Option(asignacionauxiliar2[i][1], asignacionauxiliar2[i][0]), null);
 }
 afiliacionesasignadas.add(new Option(asignacionauxiliar[0][1], asignacionauxiliar[0][0]), null);//Pasamos a ESSALUD como la unica afiliación activa excluyente
 }
 }
 }
 else{
 if(numSeleccionados>1 && asignacionauxiliar[indiceEssalud][1]=='ESSALUD'){
 alert("ESSALUD es excluyente con otras afiliaciones");
 }
 else{
 essaludEstaAsignado=false;
 for(i = 0; i < afiliacionesasignadas.length; i++){
 asignacionauxiliar2[i] = new Array(2);
 asignacionauxiliar2[i][0] = afiliacionesasignadas.item(i).value;
 asignacionauxiliar2[i][1] = afiliacionesasignadas.item(i).text;
 if(afiliacionesasignadas.item(i).text=='ESSALUD'){
 essaludEstaAsignado=true;
 }
 }
 if(!essaludEstaAsignado){
 existeitem = false;
 for (i = 0; i < asignacionauxiliar.length; i += 1){
 for (k = 0; k < afiliacionesasignadas.length; k += 1){
 if (afiliacionesasignadas.item(k).value == asignacionauxiliar[i][0]) {
 existeitem = true;
 }
 }
 if(!existeitem){
 try{
 afiliacionesasignadas.add(new Option(asignacionauxiliar[i][1], asignacionauxiliar[i][0]), null) //add new option to end of "sample"
 afiliacionesnoasignadas.remove(afiliacionesnoasignadas.selectedIndex);
 }
 catch(e){ //in IE, try the below version instead of add()
 afiliacionesasignadas.add(new Option(asignacionauxiliar[i][1], asignacionauxiliar[i][0])) //add new option to end of "sample"
 afiliacionesnoasignadas.remove(afiliacionesnoasignadas.selectedIndex);
 }
 }
 }
 }
 else{
 alert("ESSALUD es excluyente con otras afiliaciones");
 }
 }
 }
 contarafiliaciones("lst_afiliacionesnoseleccionadas","hafiliacionesnoasignadas")
 contarafiliaciones("lst_afiliacionesseleccionadas","hafiliacionesasignadas")
 }*/

function quitarAfiliaciones() {
    afiliacionesnoasignadas = new Array();
    afiliacionesasignadas = new Array();
    asignacionauxiliar = new Array();
    asignacionauxiliar2 = new Array();

    afiliacionesnoasignadas = document.getElementById("lst_afiliacionesnoseleccionadas");
    afiliacionesasignadas = document.getElementById("lst_afiliacionesseleccionadas");
    j = 0;
    numSeleccionados = 0;
    for (k = 0; k < afiliacionesasignadas.length; k += 1) {
        if (afiliacionesasignadas.item(k).selected == 1) {
            asignacionauxiliar[j] = new Array(2);
            asignacionauxiliar[j][0] = afiliacionesasignadas.item(k).value;
            asignacionauxiliar[j][1] = afiliacionesasignadas.item(k).text;
            j = j + 1;
        }
    }
    numSeleccionados = j;
    if (numSeleccionados == 1) {
        existeitem = false;
        for (k = 0; k < afiliacionesnoasignadas.length; k += 1) {
            if (afiliacionesnoasignadas.item(k).value == asignacionauxiliar[0][0]) {
                existeitem = true;
            }
        }
        if (!existeitem) {
            try {
                afiliacionesnoasignadas.add(new Option(asignacionauxiliar[0][1], asignacionauxiliar[0][0]), null);//Pasamos a ESSALUD como la unica afiliación activa excluyente
                afiliacionesasignadas.remove(afiliacionesasignadas.selectedIndex);
            }
            catch (e) { //in IE, try the below version instead of add()
                afiliacionesnoasignadas.add(new Option(asignacionauxiliar[0][1], asignacionauxiliar[0][0]), null);//Pasamos a ESSALUD como la unica afiliación activa excluyente
                afiliacionesasignadas.remove(afiliacionesasignadas.selectedIndex);
            }
        }
    }
    else {
        if (numSeleccionados > 1) {
            for (i = 0; i < asignacionauxiliar.length; i += 1) {
                existe = false;
                for (k = 0; k < afiliacionesnoasignadas.length; k += 1) {
                    if (afiliacionesnoasignadas.item(k).value == asignacionauxiliar[i][0]) {
                        existe = true;
                    }
                }
                if (!existe) {
                    try {
                        afiliacionesnoasignadas.add(new Option(asignacionauxiliar[i][1], asignacionauxiliar[i][0]), null) //add new option to end of "sample"
                        afiliacionesasignadas.remove(afiliacionesasignadas.selectedIndex);
                    }
                    catch (e) { //in IE, try the below version instead of add()
                        afiliacionesnoasignadas.add(new Option(asignacionauxiliar[i][1], asignacionauxiliar[i][0])) //add new option to end of "sample"
                        afiliacionesasignadas.remove(afiliacionesasignadas.selectedIndex);
                    }
                }
            }
        }
    }
    contarafiliaciones("lst_afiliacionesnoseleccionadas", "hafiliacionesnoasignadas")
    contarafiliaciones("lst_afiliacionesseleccionadas", "hafiliacionesasignadas")

}
function quitarAfiliacionesPopad() {
    afiliacionesnoasignadas = new Array();
    afiliacionesasignadas = new Array();
    asignacionauxiliar = new Array();
    asignacionauxiliar2 = new Array();

    afiliacionesnoasignadas = document.getElementById("lst_afiliacionesnoseleccionadas");
    afiliacionesasignadas = document.getElementById("lst_afiliacionesseleccionadas");
    j = 0;
    numSeleccionados = 0;
    for (k = 0; k < afiliacionesasignadas.length; k += 1) {
        if (afiliacionesasignadas.item(k).selected == 1) {
            asignacionauxiliar[j] = new Array(2);
            asignacionauxiliar[j][0] = afiliacionesasignadas.item(k).value;
            asignacionauxiliar[j][1] = afiliacionesasignadas.item(k).text;
            j = j + 1;
        }
    }
    numSeleccionados = j;
    if (numSeleccionados == 1) {
        existeitem = false;
        for (k = 0; k < afiliacionesnoasignadas.length; k += 1) {
            if (afiliacionesnoasignadas.item(k).value == asignacionauxiliar[0][0]) {
                existeitem = true;
            }
        }
        if (!existeitem) {
            try {
                afiliacionesnoasignadas.add(new Option(asignacionauxiliar[0][1], asignacionauxiliar[0][0]), null);//Pasamos a ESSALUD como la unica afiliación activa excluyente
                afiliacionesasignadas.remove(afiliacionesasignadas.selectedIndex);
            }
            catch (e) { //in IE, try the below version instead of add()
                afiliacionesnoasignadas.add(new Option(asignacionauxiliar[0][1], asignacionauxiliar[0][0]), null);//Pasamos a ESSALUD como la unica afiliación activa excluyente
                afiliacionesasignadas.remove(afiliacionesasignadas.selectedIndex);
            }
        }
    }
    else {
        if (numSeleccionados > 1) {
            for (i = 0; i < asignacionauxiliar.length; i += 1) {
                existe = false;
                for (k = 0; k < afiliacionesnoasignadas.length; k += 1) {
                    if (afiliacionesnoasignadas.item(k).value == asignacionauxiliar[i][0]) {
                        existe = true;
                    }
                }
                if (!existe) {
                    try {
                        afiliacionesnoasignadas.add(new Option(asignacionauxiliar[i][1], asignacionauxiliar[i][0]), null) //add new option to end of "sample"
                        afiliacionesasignadas.remove(afiliacionesasignadas.selectedIndex);
                    }
                    catch (e) { //in IE, try the below version instead of add()
                        afiliacionesnoasignadas.add(new Option(asignacionauxiliar[i][1], asignacionauxiliar[i][0])) //add new option to end of "sample"
                        afiliacionesasignadas.remove(afiliacionesasignadas.selectedIndex);
                    }
                }
            }
        }
    }
    contarafiliaciones("lst_afiliacionesnoseleccionadas", "hafiliacionesnoasignadas")
    contarafiliaciones("lst_afiliacionesseleccionadas", "hafiliacionesasignadas")
    capturarValoresArray();
}




/*function quitarAfiliaciones(){
 afiliacionesnoasignadas = new Array();
 afiliacionesasignadas = new Array();
 asignacionauxiliar = new Array();
 asignacionauxiliar2 = new Array();
 
 afiliacionesnoasignadas = document.getElementById("lst_afiliacionesnoseleccionadas");
 afiliacionesasignadas = document.getElementById("lst_afiliacionesseleccionadas");
 j = 0;
 numSeleccionados=0;
 for (k = 0; k < afiliacionesasignadas.length; k += 1){
 if (afiliacionesasignadas.item(k).selected == 1) {
 asignacionauxiliar[j] = new Array(2);
 asignacionauxiliar[j][0] = afiliacionesasignadas.item(k).value;
 asignacionauxiliar[j][1] = afiliacionesasignadas.item(k).text;
 j = j + 1;
 }
 }
 numSeleccionados=j;
 if(numSeleccionados==1 && asignacionauxiliar[0][1]=='ESSALUD'){
 //ESSALUD con las demás afiliaciones son excluyentes
 existeitem = false;
 for (k = 0; k < afiliacionesnoasignadas.length; k += 1){
 if (afiliacionesnoasignadas.item(k).value == asignacionauxiliar[0][0]) {
 existeitem = true;
 }
 }
 if(!existeitem){
 try{
 //Retornamos todas las afiliaciones
 afiliacionesasignadas.remove(afiliacionesasignadas.selectedIndex);
 for(i = 0; i < afiliacionesnoasignadas.length; i++){
 asignacionauxiliar2[i] = new Array(2);
 asignacionauxiliar2[i][0] = afiliacionesnoasignadas.item(i).value;
 asignacionauxiliar2[i][1] = afiliacionesnoasignadas.item(i).text;
 }
 numFiliacionesNoAsignadas= afiliacionesnoasignadas.length;
 for(i = 0; i < numFiliacionesNoAsignadas; i++){
 afiliacionesnoasignadas.remove(0);//Voy eliminando los que quedan
 afiliacionesasignadas.add(new Option(asignacionauxiliar2[i][1], asignacionauxiliar2[i][0]), null);
 }
 afiliacionesnoasignadas.add(new Option(asignacionauxiliar[0][1], asignacionauxiliar[0][0]), null);//Pasamos a ESSALUD como la unica afiliación activa excluyente
 }
 catch(e){ //in IE, try the below version instead of add()
 //Retornamos todas las afiliaciones
 afiliacionesasignadas.remove(afiliacionesasignadas.selectedIndex);
 for(i = 0; i < afiliacionesnoasignadas.length; i++){
 asignacionauxiliar2[i] = new Array(2);
 asignacionauxiliar2[i][0] = afiliacionesnoasignadas.item(i).value;
 asignacionauxiliar2[i][1] = afiliacionesnoasignadas.item(i).text;
 }
 numFiliacionesNoAsignadas= afiliacionesnoasignadas.length;
 for(i = 0; i < numFiliacionesNoAsignadas; i++){
 afiliacionesnoasignadas.remove(0);//Voy eliminando los que quedan
 afiliacionesasignadas.add(new Option(asignacionauxiliar2[i][1], asignacionauxiliar2[i][0]), null);
 }
 afiliacionesnoasignadas.add(new Option(asignacionauxiliar[0][1], asignacionauxiliar[0][0]), null);//Pasamos a ESSALUD como la unica afiliación activa excluyente
 }
 }
 }
 else{
 existe = false;
 for (i = 0; i < asignacionauxiliar.length; i += 1){
 for (k = 0; k < afiliacionesnoasignadas.length; k += 1){
 if (afiliacionesnoasignadas.item(k).value == asignacionauxiliar[i][0]) {
 existe = true;
 }
 }
 if(!existe){
 try{
 afiliacionesnoasignadas.add(new Option(asignacionauxiliar[i][1], asignacionauxiliar[i][0]), null) //add new option to end of "sample"
 afiliacionesasignadas.remove(afiliacionesasignadas.selectedIndex);
 }
 catch(e){ //in IE, try the below version instead of add()
 afiliacionesnoasignadas.add(new Option(asignacionauxiliar[i][1], asignacionauxiliar[i][0])) //add new option to end of "sample"
 afiliacionesasignadas.remove(afiliacionesasignadas.selectedIndex);
 }
 }
 }
 }
 contarafiliaciones("lst_afiliacionesnoseleccionadas","hafiliacionesnoasignadas")
 contarafiliaciones("lst_afiliacionesseleccionadas","hafiliacionesasignadas")
 }*/
//function contarafiliacionesasignadas(){
//    afiliacionesasignadas = document.getElementById("lst_afiliacionesseleccionadas");
//    cadena = "";
//    for(i=0;i<afiliacionesasignadas.length;i++){
//        cadena = cadena + afiliacionesnoasignadas.item(k).value;
//    }
//}

function validarCronogramaProgramacionMedicos() {
    codigopersona = document.getElementById("hcodigopersona").value;
    codigoambientelogico = document.getElementById("cb_filtro_ambienteslogicos").value;
    codigoturno = document.getElementById("hcodigoturno").value;
    fechaservicio = document.getElementById("hFechasAProgramar").value;
    codigoservicio = document.getElementById("cb_filtro_servicios").value;
    cupostotales = document.getElementById("txtcuposxturno").value;
    cuposadicionales = document.getElementById("txtcuposadicionalesxturno").value;
    codigoambientefisico = document.getElementById("cb_filtro_ambientefisico").value;
    codigoactividad = document.getElementById("cb_filtro_actividad").value;
    idpuesto = document.getElementById("cb_filtro_puestos").value;
    afiliaciones = document.getElementById("hafiliacionesasignadas").value;

    error = 0;
    if (codigopersona == "") {
        window.alert("Seleccione al Personal para programación");
        error = 1
    }
    if (codigoambientelogico == "0000") {
        window.alert("Seleccione Ambiente Lógico");
        error = 1
    }
    if (codigoturno == "") {
        window.alert("Seleccione correctamente el horario a programar");
        error = 1
    }
    if (fechaservicio == "") {
        window.alert("Seleccione fecha de programación");
        error = 1
    }
    if (codigoservicio == "0000") {
        window.alert("Seleccione servicio");
        error = 1
    }
    if (cupostotales == "") {
        window.alert("No se calculó correctamente los cupos");
        error = 1
    }
    if (cuposadicionales == "") {
        window.alert("Ingrese un valor en cupos adicionales por defecto es 0");
        error = 1
    }
    /* 
    * SE COMENTO PARA QUE NO SEA OBLIGATORIO EL REGISTRO 
    * AMBIENTE FISICO PARA EVITAR QUE EL CLIENTE TENGA
    * PROBLEMAS CON EL REGISTRO DE LA PROGRAMACION YA QUE
    * LES RESULTA ALGO FASTIDIOSO. 
    * HECHO POR ANGEL AUGUSTO SAYES MALPARTIDA - (1993-2013)
    *                    22-08-2013 
    * 
    * 
    *   if (codigoambientefisico == "0000") {
        window.alert("Seleccione Ambientes Físicos");
        error = 1
    }*/
    if (codigoactividad == "0000") {
        window.alert("Seleccione Actividad");
        error = 1
    }
    if (idpuesto == "0000") {
        window.alert("Seleccione puesto laboral");
        error = 1
    }
    if (afiliaciones == "") {
        window.alert("Seleccione afiliaciones asignadas a esta programación");
        error = 1
    }

    if (error == 0)
        grabarCronogramaProgramacionMedicos()
}
function grabarCronogramaProgramacionMedicos() {
    codigopersona = document.getElementById("hcodigopersona").value;
    codigoambientelogico = document.getElementById("cb_filtro_ambienteslogicos").value;
    codigoturno = document.getElementById("hcodigoturno").value;
    fechaservicio = document.getElementById("hFechasAProgramar").value;
    codigoservicio = document.getElementById("cb_filtro_servicios").value;
    cupostotales = document.getElementById("txtcuposxturno").value;
    cuposadicionales = document.getElementById("txtcuposadicionalesxturno").value;
    codigoambientefisico = document.getElementById("cb_filtro_ambientefisico").value;
    codigoactividad = document.getElementById("cb_filtro_actividad").value;
    idpuesto = document.getElementById("cb_filtro_puestos").value;
    afiliaciones = document.getElementById("hafiliacionesasignadas").value;
    tiempoatencion = document.getElementById("txttiempoatencion").value;
    if ($('chkProgramado').checked == true) {
        bProgramado = 1;
        dFechaProgramadoAnterior = document.getElementById("txtFechaProgramacion").value;
    } else {
        bProgramado = 0;
        dFechaProgramadoAnterior = "15/01/1993";
    }

    var dFechaAntesFin = dFechaProgramadoAnterior.split("/");
    var FechaFinal = dFechaAntesFin[2] + "-" + dFechaAntesFin[1] + "-" + dFechaAntesFin[0];
    pathLink = "p1=grabarProgramacionMedicos&p2=" + codigopersona + "&p3=" + codigoambientelogico + "&p4=" + codigoturno + "&p5=" + fechaservicio + "&p6=" + codigoservicio + "&p7=" + cupostotales + "&p8=" + cuposadicionales + "&p9=" + codigoambientefisico + "&p10=" + codigoactividad + "&p11=" + idpuesto + "&p12=" + afiliaciones + "&p13=" + tiempoatencion + "&p14=" + bProgramado + "&p15=" + FechaFinal;
    if (confirm("¿Esta seguro de guardar la programación?")) {
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: pathLink,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                respuesta = transport.responseText;
                rs = respuesta.split("|");
                window.alert(rs[1]);
                if (rs[0] == "0")
                    //mostrarbotonRegresar();
                    regresarCronogramaProgramacionMedicos();
            }
        })
    }

}


/***********************REPROGRAMACION DE MEDICOS******************************/

/*function cargaLocalizacionReprogramacionMedicos(){
 codigoambientelogico = document.getElementById("cb_filtro_ambienteslogicos").value;
 codigoactividad = document.getElementById("cb_filtro_actividad").value;
 codigosede = document.getElementById("cb_filtroSede").value;
 
 pathLink = "p1=cargaLocalizacionReprogramacionMedicos&p2="+codigoambientelogico+"&p3="+codigoactividad+"&p4="+codigosede;
 new Ajax.Request( pathRequestControl,{
 method : 'get',
 parameters : pathLink,
 onLoading : micargador(1),
 onComplete : function(transport){
 micargador(0);
 respuesta = transport.responseText;
 $('Div_ambientesfisicos').update(respuesta);
 codigoambientefisico = document.getElementById("hcodigoambientefisico").value;
 opt = document.getElementById("cb_filtro_ambientefisico").options;
 i = 0;
 while(i<opt.length){
 if(opt[i].value == codigoambientefisico){
 opt[i].selected = true;
 }
 i = i + 1;
 }
 }
 })
 
 }*/

function consultaProgramacionMedicos(codigocronograma, accion) { //accion 1 solo consulta,2 edita turno,3 edita localizacion
    Windows.close("Div_opcionProgramacionMedicos");
    $("divGeneralProgramacionMedicos1").hide();
    $("divProgramacionMedicos").show();
    $("divGeneralProgramacionMedicos2").show();
    $('cb_filtroSede').disabled = true;
    $('calendario').hide();
    pathLink = "p1=consultarProgramacionMedicos&p2=" + codigocronograma;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            eval(respuesta);
            $('chkProgramado').disabled = true;
            $('txtFechaProgramacion').disabled = true;
            switch (accion) {
                case '1' :
                    document.getElementById("hTipoActualizacion").value = 4
                    $('txtcuposadicionalesxturno').disabled = false;

                   
                    break;
                case '2' :
                    consultaEdicionTurno(codigocronograma);                    
                    break;
                case '4' :
                    consultaEdicionAmbienteLogicoyFisico(codigocronograma);
                    break;
            }
            mostrarAfiliacionesXCronograma();
            mostrarbotonActualizar();
        }
    })


}

function abrirPopadAfiliacionesXMedico() {
    var vtitle = '';
    var vformname = 'PopadAfiliacionesXMedico';
    var vwidth = '550';
    var vheight = '480';
    var posFuncion = 'cargarDatosPopadAfiliacionesProgramacion';
    var patronModulo = 'PopadAfiliacionesXMedico';
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
    parametros += 'p1=' + patronModulo;
    this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
    Windows.close("Div_opcionProgramacionMedicos")
}

function cargarDatosPopadAfiliacionesProgramacion() {
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);

            $('nombreMedico').value = $('var1').value;
            $('numProgramacion').value = $('var2').value;
            $('fecha').value = $('var3').value;
            $('turno').value = $('var4').value;
            var CodPrograma = $('var2').value

            cargarListadodeAfiliacionesNoActivas(CodPrograma);
        }
    })
}

function cargarListadodeAfiliacionesNoActivas(codProgramacion) {
    var patronModulo = 'cargarListadodeAfiliacionesNoActivas';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codProgramacion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            var respuesta = transport.responseText;
            $('Div_afiliacionesnoasignadas').update(respuesta);
            cargarListadodeAfiliacionesActivas(codProgramacion);
        //alert(codProgramacion);
        }
    })
}

function cargarListadodeAfiliacionesActivas(codProgramacion) {
    var codProg = codProgramacion;
    var patronModulo = 'cargarListadodeAfiliacionesActivas';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codProg;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            var respuesta = transport.responseText;
            $('Div_afiliacionesasignadas').update(respuesta);
        }
    })
}


function reprogramarAfiliacionesCronogramas(codigocronograma) {
    abrirPopadAfiliacionesXMedico();

// capturarValoresArray();
}

function capturarValoresArray() {
    var contadorCombo1 = $('lst_afiliacionesnoseleccionadas').length;
    var arrayCombo1;
    for (var x = 0; x <= contadorCombo1 - 1; x++) {
        if (x == 0) {
            arrayCombo1 = $('lst_afiliacionesnoseleccionadas')[x].value + "|";
        }
        else if (x < contadorCombo1 - 1) {
            arrayCombo1 += $('lst_afiliacionesnoseleccionadas')[x].value + "|";
        }
        else if (x == contadorCombo1 - 1) {
            arrayCombo1 += $('lst_afiliacionesnoseleccionadas')[x].value;
        }
    }
    var contadorCombo2 = $('lst_afiliacionesseleccionadas').length;
    var arrayCombo2
    for (var y = 0; y <= contadorCombo2 - 1; y++) {
        if (y == 0) {
            arrayCombo2 = $('lst_afiliacionesseleccionadas')[y].value + "|";
        }
        else if (y < contadorCombo2 - 1) {
            arrayCombo2 += $('lst_afiliacionesseleccionadas')[y].value + "|";
        }
        else if (y == contadorCombo2 - 1) {
            arrayCombo2 += $('lst_afiliacionesseleccionadas')[y].value;
        }
    }
//alert(arrayCombo1);
//alert(arrayCombo2);
}
function consultaEdicionTurno(codigocronograma) {
    //consultaProgramacionMedicos(codigocronograma);
    //    document.getElementById("cb_filtro_turnoinicio").disabled = false;
    document.getElementById("hhorainicio").value = document.getElementById("cb_filtro_turnoinicio").value;
    document.getElementById("hhorafinal").value = document.getElementById("cb_filtro_turnofinal").value;
    cargaTurnoInicioProgramacionMedicos('2'); //1 carga , 2 selecciona para edicion
    refrescarCalendarioConsultaReprogramacionMedicos();
    document.getElementById("cb_filtro_turnoinicio").disabled = false;
    //    $('Div_grabar').hide();
    //    $('Div_actualizar').show();
    document.getElementById("hTipoActualizacion").value = 2 //opcion cambio de turno
}

/*function consultaEdicionLocalizacion(codigocronograma){
 document.getElementById("hcodigoambientefisico").value = document.getElementById("cb_filtro_ambientefisico").value;
 //cargarAmbienteLogicoReprogramacionMedicos();
 cargaLocalizacionReprogramacionMedicos();
 refrescarCalendarioConsultaReprogramacionMedicos();
 document.getElementById("hTipoActualizacion").value = 3 //opcion cambio de ambiente fisico
 }*/

function consultaEdicionAmbienteLogicoyFisico(codigocronograma) {
    //document.getElementById("hcodigoambientefisico").value = document.getElementById("cb_filtro_ambientefisico").value/;//esta por ver si va o no va
    document.getElementById("hdnCodAmbLogico").value = document.getElementById("cb_filtro_ambienteslogicos").value;
    cargarComboAmbienteLogicoReprogramacionMedico();//cargaLocalizacionReprogramacionMedicos();
    refrescarCalendarioConsultaReprogramacionMedicos();//
    document.getElementById("hTipoActualizacion").value = 5;//opcion cambio de ambiente logico y fisico
    $('txtcuposadicionalesxturno').disabled = true;

}

function cargarComboAmbienteLogicoReprogramacionMedico() {
    var accionControl = "cargarComboAmbienteLogicoReprogramacionMedico";
    var idPuesto = document.getElementById("cb_filtro_puestos").value;
    var codigosede = document.getElementById("cb_filtroSede").value;
    var codAmbienteLogico = document.getElementById("cb_filtro_ambienteslogicos").value;//codAmbienteLogico=document.getElementById("hdnCodAmbLogico").value;//codigoambientelogico = document.getElementById("cb_filtro_ambienteslogicos").value;
    //alert(codAmbienteLogico);
    pathLink = "";
    pathLink += "p1=" + accionControl;
    pathLink += "&p2=" + idPuesto;
    pathLink += "&p3=" + codigosede;
    pathLink += "&p4=" + codAmbienteLogico;

    new Ajax.Request(pathRequestControl, {
        method: 'post',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Div_ambienteslogicos').update(respuesta);
            cargarComboAmbienteFisicoReprogramacionMedico();
        }
    })
}

function cargarComboAmbienteFisicoReprogramacionMedico() {
    accionControl = "cargarComboAmbienteFisicoReprogramacionMedico";
    codigoambientelogico = $("cb_filtro_ambienteslogicos").value;
    codigoactividad = $("cb_filtro_actividad").value;
    codigosede = $("cb_filtroSede").value;
    codAmbienteFisico = document.getElementById("cb_filtro_ambientefisico").value;

    pathLink = "";
    pathLink += "p1=" + accionControl;
    pathLink += "&p2=" + codigoambientelogico;
    pathLink += "&p3=" + codigoactividad;
    pathLink += "&p4=" + codigosede;
    pathLink += "&p5=" + codAmbienteFisico;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Div_ambientesfisicos').update(respuesta);
        }
    })
}

function validarCronogramaReProgramacionMedicos() {
    //codigocronograma = document.getElementById("hcodigocronograma").value;
    tipoactualizacion = document.getElementById("hTipoActualizacion").value;
    //2 cambio de turno,3 cambio de localizacion
    switch (tipoactualizacion) {
        case '2':
            turnoinicio = document.getElementById("cb_filtro_turnoinicio").value;
            turnofinal = document.getElementById("cb_filtro_turnofinal").value
            //window.alert(turnoinicio + turnofinal)
            if (turnoinicio == "" || turnofinal == "")
                window.alert("Seleccionar el horario correctamente");
            else
                actualizarCronogramaReProgramacionMedicos(tipoactualizacion)

            break;
        case '3':
            ambientefisico = document.getElementById("cb_filtro_ambientefisico").value;
            if (ambientefisico == "" || ambientefisico == "0000")
                window.alert("Seleccionar la localización correctamente");
            else
                actualizarCronogramaReProgramacionMedicos(tipoactualizacion)
            break;
        case '4':
            cantidadadicionales = document.getElementById("txtcuposadicionalesxturno").value;
            if (cantidadadicionales == "")
                window.alert("Ingresar Cantidad de Cupos Adicionales");
            else
                actualizarCronogramaReProgramacionMedicos(tipoactualizacion)
            break;
        case '5':
            ambientelogico = document.getElementById("cb_filtro_ambienteslogicos").value;
            ambientefisico = document.getElementById("cb_filtro_ambientefisico").value;

            if (ambientelogico == "" || ambientelogico == "0000") {
                window.alert("Seleccionar ambiente l\xF3gico");
            }
            else {
                if (ambientefisico == "" || ambientefisico == "0000")
                    window.alert("Seleccionar la localizaci\xF3n correctamente");
                else {
                    //actualizarCronogramaReProgramacionMedicos(tipoactualizacion);
                    mantenimientoReprogramarMedico();
                }
            }
            break;
    }
}
function actualizarCronogramaReProgramacionMedicos() {
    //2 cambio de turno,3 cambio de localizacion
    codigocronograma = document.getElementById("hcodigocronograma").value;
    tipoactualizacion = document.getElementById("hTipoActualizacion").value;
    codigoturno = document.getElementById("hcodigoturno").value;
    cantidadcupos = document.getElementById("txtcuposxturno").value;
    ambientefisico = document.getElementById("cb_filtro_ambientefisico").value;
    cantidadadicionales = document.getElementById("txtcuposadicionalesxturno").value;

    pathLink = "p1=actualizarCronogramaReProgramacionMedicos&p2=" + codigocronograma + "&p3=" + tipoactualizacion + "&p4=" + codigoturno + "&p5=" + ambientefisico + "&p6=" + cantidadadicionales + "&p7=" + cantidadcupos;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            rs = respuesta.split("|");
            window.alert(rs[1]);
            if (rs[0] == "0")
                mostrarbotonRegresar();
        }
    })
}

function mantenimientoReprogramarMedico() {
    iCodigoCronograma = document.getElementById("hcodigocronograma").value;
    cCodigoAmbienteLogicoNuevo = document.getElementById("cb_filtro_ambienteslogicos").value;
    iCodigoAmbienteFisicoNuevo = document.getElementById("cb_filtro_ambientefisico").value;
    accionControl = "mantenimientoReprogramarMedico";
    pathLink = "";
    pathLink += "p1=" + accionControl;
    pathLink += "&p2=" + iCodigoCronograma;
    pathLink += "&p3=" + cCodigoAmbienteLogicoNuevo;
    pathLink += "&p4=" + iCodigoAmbienteFisicoNuevo;

    new Ajax.Request(pathRequestControl, {
        method: 'post',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            rs = respuesta.split("|");
            window.alert(rs[1]);
            if (rs[0] == "0")
                mostrarbotonRegresar();
        }
    })
}

function regresarCronogramaProgramacionMedicos() {
    $("divGeneralProgramacionMedicos1").show();
    $("divProgramacionMedicos").hide();
    $("divGeneralProgramacionMedicos2").hide();
    codigopersona = document.getElementById("hcodigopersona").value;
    nombremedico = document.getElementById("hnombrepersona").value;
    seleccionaMedicoProgramacionMedicos('', '', codigopersona + '|' + nombremedico);
}

function autorizarReprogramacion(codigocronograma) {
    //$("Div_AutorizaReprogramacion").show();
    $("Div_RePrograma").hide();
}

function reprogramacionMedicos(codigocronograma) {
    $("Div_RePrograma").show();
//$("Div_AutorizaReprogramacion").hide();
//Windows.close("Div_opcionProgramacionMedicos");
}

function generarCodigoAutorizacionProgramacionMedicos() {
    codigocronograma = document.getElementById("hcodigocronograma").value;
    numerodocumento = document.getElementById("txtnumerodocumento").value;
    if (numerodocumento.length > 10) {
        pathLink = "p1=generarCodigoAutorizacionProgramacionMedicos&p2=" + codigocronograma + "&p3=" + numerodocumento;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: pathLink,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                respuesta = transport.responseText;
                document.getElementById("txtcodigoverificacion").value = respuesta;
            }
        })
    }
    else {
        window.alert("Ingrese un documento valido!!");
    }
}

/*
 function validarAutorizacionProgramacionMedicos(){
 codigocronograma = document.getElementById("hcodigocronograma").value;
 claveautorizacion = document.getElementById("txtclaveautorizacion").value;
 //window.alert(claveautorizacion);
 pathLink = "p1=validarAutorizacionProgramacionMedicos&p2="+codigocronograma+"&p3="+claveautorizacion;
 new Ajax.Request( pathRequestControl,{
 method : 'get',
 parameters : pathLink,
 onLoading : micargador(1),
 onComplete : function(transport){
 micargador(0);
 respuesta = transport.responseText;
 evaluarReprogramarMedico(respuesta,claveautorizacion);
 }
 })
 
 }*/

function validarAutorizacionProgramacionMedicos() {
    //respuesta = transport.responseText;
    //txaObsCambioPersonalMedico
    var obsCambioPersonal = "";
    obsCambioPersonal = document.getElementById("txaObsCambioPersonalMedico").value;

    obsCambioPersonal = trimJunny(obsCambioPersonal);
    if (obsCambioPersonal.length < 20) {
        document.getElementById("txaObsCambioPersonalMedico").value = obsCambioPersonal;
        document.getElementById("txaObsCambioPersonalMedico").focus();
        alert("Ingrese como m\xEDnimo 20 caracteres");
    }
    else {
        ventanaMostrarMedicosparaReprogramacionMedicos();
    }
}

/*function evaluarReprogramarMedico(respuesta,claveautorizacion){
 
 switch(respuesta){
 case '0':
 Windows.close("Div_opcionProgramacionMedicos");
 ventanaMostrarMedicosparaReprogramacionMedicos(claveautorizacion);
 
 break;
 case '1':
 window.alert("No procede el codigo de autorizacion");
 break;
 }
 }*/

function ventanaMostrarMedicosparaReprogramacionMedicos() {
    titulo = 'Reprogramación de Médicos...';
    vFormaAbrir = 'VENTANA';
    vformname = 'popupReprogramacionMedicos';
    vtitle = 'Reprogramación de Médicos...';
    vwidth = '800';
    vheight = '300';
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

    valor = document.getElementById("hcodigocronograma").value;
    patronModulo = 'mostrarMedicosparaReprogramacionMedicos';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + valor;
    posFuncion = 'cargarTablaMedicoParaReprogramacion';
    //document.getElementById("hcodigoverificacion").value = claveautorizacion;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function cargarTablaMedicoParaReprogramacion() {
    /*patronModulo='mostrarTablaMedicoParaReprogramacion';
     parametros='';
     parametros+='p1='+patronModulo;
     parametros+='&p2='+opcion;
     parametros+='&p3='+patron;*/
    var iCodigoCronograma = document.getElementById("hcodigocronograma").value;

    patronModulo = 'mostrarTablaMedicoParaReprogramacion';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iCodigoCronograma;

    tablaMedicoParaReprogramacion = new dhtmlXGridObject('divResultadoBusquedaPersonas');
    tablaMedicoParaReprogramacion.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaMedicoParaReprogramacion.setSkin("dhx_skyblue");
    tablaMedicoParaReprogramacion.attachEvent("onRowSelect", seleccionarMedicoParaReprogramacion);
    tablaMedicoParaReprogramacion.init();
    tablaMedicoParaReprogramacion.loadXML(pathRequestControl + '?' + parametros);
}

function seleccionarMedicoParaReprogramacion(rowId, cellInd) {
    cadenaDatos = tablaMedicoParaReprogramacion.cells(rowId, 0).getValue();
    nomMedicoNuevo = tablaMedicoParaReprogramacion.cells(rowId, 3).getValue();
    arrayDatos = cadenaDatos.split("|");
    iCodigoCronograma = arrayDatos[0];
    iCodigoEmpleadoNuevo = arrayDatos[1];
    iidPuestoNuevo = arrayDatos[2];
    tMotivoReprogramacion = trimJunny(document.getElementById("txaObsCambioPersonalMedico").value);
    tMotivoReprogramacion = Base64.encode(tMotivoReprogramacion);

    patronModulo = 'grabarReprogramacionMedicos';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iCodigoCronograma;
    parametros += '&p3=' + iCodigoEmpleadoNuevo;
    parametros += '&p4=' + iidPuestoNuevo;
    parametros += '&p5=' + tMotivoReprogramacion;

    if (confirm("\xBFEst\xE1 seguro de la reprogramaci\xF3n con " + nomMedicoNuevo + "?")) {
        new Ajax.Request(pathRequestControl, {
            method: 'post',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                respuesta = transport.responseText;
                rs = respuesta.split("|");
                window.alert(rs[1]);
                Windows.close("Div_popupReprogramacionMedicos");
                Windows.close("Div_opcionProgramacionMedicos");
                codigopersona = document.getElementById("hcodigopersona").value;
                nombremedico = document.getElementById("hnombrepersona").value;
                seleccionaMedicoProgramacionMedicos('', '', codigopersona + '|' + nombremedico);
            }
        })
    }
}

function getBusquedaMedicoParaReprogramacion(event) {
    e = event;

    if (e.keyCode == 13) {
        opcion = $("hdnOpcionBusqueda").value;

        if (opcion == 1) {//Filtrar por apellidos y nombres
            apPat = $("txtPatron").value;
            apMat = $("txtPatron2").value;
            nombre = $("txtPatron3").value;
            if (apPat == $("txtPatron").defaultValue) {
                apPat = '';
            }
            if (apMat == $("txtPatron2").defaultValue) {
                apMat = '';
            }
            if (nombre == $("txtPatron3").defaultValue) {
                nombre = '';
            }
            //Armamos el query
            if (apPat != '' && apMat == '' && nombre == '') {
                patron = apPat;
            }
            else {
                if (apPat == '' && apMat != '' && nombre == '') {
                    patron = apMat;
                }
                else {
                    if (apPat == '' && apMat == '' && nombre != '') {
                        patron = nombre;
                    }
                    else {
                        if (apPat != '' && apMat != '' && nombre == '') {
                            patron = apPat + ' ' + apMat;
                        }
                        else {
                            if (apPat == '' && apMat != '' && nombre != '') {
                                patron = apMat + ', ' + nombre;
                            }
                            else {
                                /*if(apPat!='' && apMat=='' && nombre!=''){
                                 patron = apPat+' '+$nombre;
                                 }
                                 else{*/
                                if (apPat != '' && apMat != '' && nombre != '') {
                                    patron = apPat + ' ' + $apMat + ', ' + nombre;
                                }
                                else {
                                    if (apPat == '' && apMat == '' && nombre == '') {
                                        patron = '';
                                    }
                                }
                            //}
                            }
                        }
                    }
                }
            }
            //patron=apPat+" "+apMat+", "+nombre;
            tablaMedicoParaReprogramacion.filterBy(3, patron);
        }
        else {
            patron = $("txtPatron").value;

            if (opcion == 2) {//Filtrar por DNI
                tablaMedicoParaReprogramacion.filterBy(2, patron);
            }
            else {
                if (opcion == 3) {//Filtrar por codigo de persona
                    tablaMedicoParaReprogramacion.filterBy(1, patron);
                }
            }
        }
    }
}

function guardarAfiliacionesXMedico() {
    var contadorCombo2 = $('lst_afiliacionesseleccionadas').length;
    var arrayCombo2
    for (var y = 0; y <= contadorCombo2 - 1; y++) {
        if (y == 0) {
            arrayCombo2 = $('lst_afiliacionesseleccionadas')[y].value + "|";
        }
        else if (y < contadorCombo2 - 1) {
            arrayCombo2 += $('lst_afiliacionesseleccionadas')[y].value + "|";
        }
        else if (y == contadorCombo2 - 1) {
            arrayCombo2 += $('lst_afiliacionesseleccionadas')[y].value;
        }
    }
    if (contadorCombo2 == 0) {
        CodCronograma = $("numProgramacion").value;
        patronModulo = 'EliminarAfiliacionesXMedico';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + CodCronograma;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                var respuesta = transport.responseText;
                alert("Se guardo exitosamente...");  
            }
        })
    }
    else if (contadorCombo2 > 0) {
        CodCronograma = $("numProgramacion").value;
        patronModulo = 'EliminarAfiliacionesXMedico';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + CodCronograma;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                var respuesta = transport.responseText;
                despuesdeEliminarAfiliaciones(arrayCombo2);
            }
        })
    }
   
}

function despuesdeEliminarAfiliaciones(arrayCombo2) {
    CodCronograma = $("numProgramacion").value;
    var patronModulo = 'guardarAfiliacionesXMedico';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + arrayCombo2;
    parametros += '&p3=' + CodCronograma;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            var respuesta = transport.responseText;
            alert("Se guardo exitosamente...");
            Windows.close("Div_PopadAfiliacionesXMedico");
        }
    })
}


function mostrarAfiliacionesXCronograma() {
    codigocronograma = document.getElementById("hcodigocronograma").value;
    pathLink = "p1=mostrarAfiliacionesXCronograma&p2=" + codigocronograma;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Div_CronogramaxAfiliacion').innerHTML = respuesta;
        }
    })
}
function cronogramaxAfiliacion() {
    pathLink = "p1=cronogramaxAfiliacion";
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Div_CronogramaxAfiliacion').innerHTML = respuesta;
            contarafiliaciones("lst_afiliacionesnoseleccionadas", "hafiliacionesnoasignadas")
            contarafiliaciones("lst_afiliacionesseleccionadas", "hafiliacionesasignadas")
        }
    })
}
/*function ventanaMostrarMedicosparaReprogramacionMedicos(claveautorizacion){
 
 titulo='Reprogramación de Médicos...'
 vFormaAbrir='VENTANA'
 vformname='reprogramacionMedicos'
 vtitle='Reprogramación de Médicos...'
 vwidth='400'
 vheight='250'
 vcenter='t'
 vresizable=''
 vmodal='false'
 vstyle=''
 vopacity=''
 veffect=''
 vposx1=''
 vposx2=''
 vposy1=''
 vposy2=''
 file01=''
 vfunctionjava=''
 
 valor = document.getElementById("hcodigocronograma").value;
 patronModulo='mostrarMedicosparaReprogramacionMedicos';
 parametros='';
 parametros+='p1='+patronModulo;
 parametros+='&p2='+valor;
 posFuncion='';
 document.getElementById("hcodigoverificacion").value = claveautorizacion;
 CargarVentanaPopPap(vformname,vtitle,vwidth,vheight,vcenter,vresizable,vmodal,vstyle,vopacity,vposx1,vposx2,vposy1,vposy2,parametros,posFuncion)
 
 }*/

/*
 function grabarReprogramacionMedicos(html,event,valor){
 valores = valor.split("|");
 codigocronograma = valores[0];
 codigoempleado = valores[1];
 codigopuesto = valores[2];
 claveautorizacion = document.getElementById("hcodigoverificacion").value ;
 pathLink = "p1=grabarReprogramacionMedicos&p2="+codigocronograma+"&p3="+codigoempleado+"&p4="+codigopuesto+"&p5="+claveautorizacion;
 if (confirm("¿Esta seguro de la Reprogramación?")){
 new Ajax.Request( pathRequestControl,{
 method : 'get',
 parameters : pathLink,
 onLoading : micargador(1),
 onComplete : function(transport){
 micargador(0);
 respuesta = transport.responseText;
 rs = respuesta.split("|");
 window.alert(rs[1]);
 Windows.close("Div_reprogramacionMedicos");
 codigopersona = document.getElementById("hcodigopersona").value;
 nombremedico = document.getElementById("hnombrepersona").value;
 seleccionaMedicoProgramacionMedicos('','',codigopersona+'|'+nombremedico);
 }
 })
 }
 
 }*/

function refrescarCalendarioConsultaReprogramacionMedicos() {

    fecha = document.getElementById("hFechasAProgramar").value;
    accion = 5;
    pathLink = "p1=calendario03&p2=" + fecha + "&p3=" + accion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            rs = respuesta.split("|");
            $("divCalendario").innerHTML = rs[0];
        //$("divCalendario").innerHTML = respuesta;
        }
    })
}
function refrescarCalendarioNuevaprogramacionMedicos() {
    fecha = document.getElementById("hFechasAProgramar").value;
    accion = 5;
    pathLink = "p1=calendario02&p2= &p3= ";
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            rs = respuesta.split("|");
            $("divCalendario").innerHTML = rs[0];
        }
    })
}
function clickCargaMedicoxCentroCostoProgramacionMedicos(html, event, valor) {
    arreglo = valor.split("|");
    codigoynombre = arreglo[0] + "|" + arreglo[1];
    seleccionaMedicoProgramacionMedicos('', '', codigoynombre);
    clickCargaCentroCostoProgramacionMedicos(arreglo[2], arreglo[3]);

}

function eliminacionProhibida() {
    window.alert("No se puede Eliminar La Programación");
}
function eliminarProgramacionMedicos(codigocronograma,motivo) {
    codigopersona = document.getElementById("hcodigopersona").value;
    nombrepersona = document.getElementById("hnombrepersona").value;
    codigoynombre = codigopersona + "|" + nombrepersona;

    if (confirm("¿Esta seguro de eliminar la Programacion?")) {
        pathLink = "p1=eliminarProgramacionMedicos&p2=" + codigocronograma+"&p3=" + motivo;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: pathLink,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                respuesta = transport.responseText;
                window.alert(respuesta);
                seleccionaMedicoProgramacionMedicos('', '', codigoynombre);
            }
        })
    }
}

function mostrarbotonGrabar() {
    $('Div_grabar').show();
    $('Div_actualizar').hide();
    $('Div_regresar').hide();
}
function mostrarbotonActualizar() {
    $('Div_grabar').hide();
    $('Div_actualizar').show();
    $('Div_regresar').hide();
}
function mostrarbotonRegresar() {
    $('Div_grabar').hide();
    $('Div_actualizar').hide();
    $('Div_regresar').show();
}
function nuevaProgramacionMedicos() {
    pathLink = "p1=limpiarSeleccionesProgramacionMedicos";
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $("divGeneralProgramacionMedicos2").show();
            $('cb_filtroSede').disabled = true;
            $('calendario').show();
            $('Div_selecciones').innerHTML = respuesta;
            agregarProgramacion();
        }
    })
}

function ventanaMostrarProgramacionAmbientesFisicos(fechas, codigoambientefisico) {

    titulo = 'Programación Ambientes Físicos...'
    vFormaAbrir = 'VENTANA'
    vformname = 'programacionambientesfisicos'
    vtitle = 'Programación Ambientes Físicos...'
    vwidth = '600'
    vheight = '350'
    vcenter = 't'
    vresizable = ''
    vmodal = 'false'
    vstyle = ''
    vopacity = ''
    veffect = ''
    vposx1 = ''
    vposx2 = ''
    vposy1 = ''
    vposy2 = ''
    file01 = ''
    vfunctionjava = ''

    patronModulo = 'mostrarProgramacionAmbientesFisicos';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + fechas;
    parametros += '&p3=' + codigoambientefisico;
    posFuncion = '';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)

}


function verCruces() {
    fechas = document.getElementById("hFechasAProgramar").value;
    codigoambientefisico = document.getElementById("cb_filtro_ambienteFisico").value;

    if (codigoambientefisico == "0000") {
        window.alert("Seleccione Ambiente Fisico");
    } else {
        ventanaMostrarProgramacionAmbientesFisicos(fechas, codigoambientefisico)
    }


//    window.alert(fechas+"|"+codigoambientefisico+"|"+codigoturno);
}

function activarFechaProgramacion(objeto) {
    if ($('chkProgramado').checked == true) {
        $("txtFechaProgramacion").disabled = false;
    } else {
        $("txtFechaProgramacion").disabled = true;
    }
}

function reprogramarProgramacionAndFecha() {
    $('DivMantenimientoPRogramable').show();
}

function activarFechaProgramacionMantenimiento(objeto) {
    if ($('chkProgramadoMantenimiento').checked == true) {
        $("txtFechaProgramacionMantenimiento").disabled = false;
    } else {
        $("txtFechaProgramacionMantenimiento").disabled = true;
    }
}

function cancelarMantenimientoProgramable() {
    $('DivMantenimientoPRogramable').hide();
}

function guardarMantenimientoPRogramado(codProgramacion) {
    if ($('chkProgramadoMantenimiento').checked == true) {
        programacion = 1;
    } else {
        programacion = 0;
    }
    var Fecha = $("txtFechaProgramacionMantenimiento").value;
    var dFechaAntesFin = Fecha.split("/");
    var FechaFinal = dFechaAntesFin[2] + "-" + dFechaAntesFin[1] + "-" + dFechaAntesFin[0];
    pathLink = "p1=guardarMantenimientoPRogramado&p2=" + codProgramacion + "&p3=" + programacion + "&p4=" + FechaFinal;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            alert("Se actualizo Correctamente");
            Windows.close("Div_opcionProgramacionMedicos");
            codigopersona = document.getElementById("hcodigopersona").value;
            nombrepersona = document.getElementById("hnombrepersona").value;
            seleccionaMedicoProgramacionMedicos('', '', codigopersona + '|' + nombrepersona);
        }
    })
}


function abrirPopudEliminarProgramacion(codProgramacion,accion){
    titulo = 'Eliminar Programacion'
    vFormaAbrir = ''
    vformname = ''
    vtitle = ''
    vwidth = '200'
    vheight = '150'
    vcenter = 't'
    vresizable = ''
    vmodal = 'false'
    vstyle = ''
    vopacity = ''
    veffect = ''
    vposx1 = ''
    vposx2 = ''
    vposy1 = ''
    vposy2 = ''
    file01 = ''
    vfunctionjava = ''
    patronModulo = 'abrirPopudEliminarProgramacion';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codProgramacion;
    parametros += '&p3=' + accion;
    posFuncion = '';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)

}

function grabarMotivoEliminacion(codProgramacion){
    var cantidad = $('motivoEliminacion').value
    var longitud = cantidad.length
    if (longitud>=25){
        eliminarProgramacionMedicos(codProgramacion,cantidad);
        Windows.close("Div_abrirPopudEliminarProgramacion");
    } 
    else {
        alert('La cantidad de Caracteres minimos es 25');
    }
    
}

function mostrarEdicionProgramacion(codProgramacion){
    var titulo = 'Log Programacion'
    var vFormaAbrir = ''
    var vformname = ''
    var vtitle = ''
    var vwidth = '800'
    var vheight = '500'
    var vcenter = 't'
    var vresizable = ''
    var vmodal = 'false'
    var vstyle = ''
    var vopacity = ''
    var veffect = ''
    var vposx1 = ''
    var vposx2 = ''
    var vposy1 = ''
    var vposy2 = ''
    var file01 = ''
    var vfunctionjava = ''
    var patronModulo = 'mostrarEdicionProgramacion';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codProgramacion;
    var posFuncion = 'cargarAfiliacionesActivas';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}
function cargarAfiliacionesActivas(){
    var codProg = $('hCronogramaMedicoSeleccionado').value;
    var patronModulo = 'cargarListadodeAfiliacionesActivas';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codProg;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            var respuesta = transport.responseText;
            $('divAfiliacionesCronograma').update(respuesta);
        }
    })
}



function seleccionarTurnoProgramacionMedico(codigocronograma){
    var titulo = 'seleccionarTurnoProgramacionMedico'
    var vFormaAbrir = ''
    var vformname = 'seleccionarTurnoProgramacionMedico'
    var vtitle = ''
    var vwidth = '400'
    var vheight = '200'
    var vcenter = 't'
    var vresizable = ''
    var vmodal = 'false'
    var vstyle = ''
    var vopacity = ''
    var veffect = ''
    var vposx1 = ''
    var vposx2 = ''
    var vposy1 = ''
    var vposy2 = ''
    var file01 = ''
    var vfunctionjava = ''
    var patronModulo = 'seleccionarTurnoProgramacionMedico';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigocronograma;
    var posFuncion = 'seleccionarHoraFinal($("cboHoraInicio").value)';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function seleccionarHoraFinal(horainicio){
    var pathLink = "p1=seleccionarHoraFinal&p2=" + horainicio;  
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $("cboHoraFin").update(respuesta);              
        }
    });
}
function actualizarTurnoProgramacionMedico(codigocronograma){
    var motivo=$("txaMotivo").value;
    if($("cboHoraFin").value!=$("hCodigoTurno").value){
        if(motivo.length>=20){  
            var codTur=$("cboHoraFin").value;
            pathLink = "p1=actualizarTurnoProgramacionMedico&p2="+codigocronograma+"&p3="+codTur+"&p4="+motivo;
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: pathLink,
                onLoading: micargador(1),
                onComplete: function(transport) {
                    micargador(0);
                    respuesta = transport.responseText;          
                    alert(respuesta);
                    Windows.close('Div_seleccionarTurnoProgramacionMedico');
                    Windows.close("Div_opcionProgramacionMedicos");
                    seleccionaMedicoProgramacionMedicos("","",$("hcodigopersona").value+"|"+$("hnombrepersona").value);
                }
            });
        }
        else
            alert("El motivo debe tener mínimo 20 caracteres.");
    }
    else
        alert("El turno es el mismo. Elija otro para poder actualizar.");
}

function reprogramarAdicionales(iCodigoCronograma){
    var titulo = 'Cambiar Adicionales Programacion'
    var vFormaAbrir = ''
    var vformname = ''
    var vtitle = ''
    var vwidth = '600'
    var vheight = '60'
    var vcenter = 't'
    var vresizable = ''
    var vmodal = 'false'
    var vstyle = ''
    var vopacity = ''
    var veffect = ''
    var vposx1 = ''
    var vposx2 = ''
    var vposy1 = ''
    var vposy2 = ''
    var file01 = ''
    var vfunctionjava = ''
    var patronModulo = 'reprogramarAdicionales';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iCodigoCronograma;
    var posFuncion = '';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
  
}

function validaInteger(evento, elemento) {
    if (evento == '') {
        tecla = 13;
    } else {
        tecla = evento.keyCode
    }
    valor = elemento.value;
    longitud = valor.length;
    ultimoCaracter = valor.substr(valor.length - 1, valor.length);
    //alert(ultimoCaracter);
    if (("0123456789").indexOf(ultimoCaracter) == -1) {
        elemento.value = valor.substr(0, valor.length - 1);
    }
}

function guardarCambiosLogADicionales(){
    var  iCodigocronograma = $("txtiCodigoCronogramaModificarAdicionales").value;
    var  icantidad = $("txtNumeroAdicionales").value;
    var patronModulo = 'guardarCambiosLogADicionales';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iCodigocronograma;
    parametros += '&p3=' + icantidad;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            var respuesta = transport.responseText;
            alert("Se guardo exitosamente...");
            
            Windows.close("Div_");
            Windows.close("Div_opcionProgramacionMedicos");
            seleccionaMedicoProgramacionMedicos('', '', codigopersona + '|' + nombrepersona);
        }
    })
}


function abrirPopudReporteMensualCronograma (){
    var titulo = 'Reporte Log Mensual Cronograma'
    var vFormaAbrir = ''
    var vformname = 'abrirPopudReporteMensualCronograma'
    var vtitle = 'abrirPopudReporteMensualCronograma'
    var vwidth = '800'
    var vheight = '600'
    var vcenter = 't'
    var vresizable = ''
    var vmodal = 'false'
    var vstyle = ''
    var vopacity = ''
    var veffect = ''
    var vposx1 = ''
    var vposx2 = ''
    var vposy1 = ''
    var vposy2 = ''
    var file01 = ''
    var vfunctionjava = ''
    var patronModulo = 'abrirPopudReporteMensualCronograma';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + $('hcodigopersona').value;
    parametros += '&p3=' + $('cb_filtro_mes').value;
    parametros += '&p4=' + $('cb_filtro_anio').value;
    var posFuncion = 'listarLogCronograma()';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}


function consultaProgramacionMedicosJorgeNuevo(codigocronograma, accion) {
    var codigopersona = document.getElementById("hcodigopersona").value;
    var nombrepersona = document.getElementById("hnombrepersona").value;
    vFormaAbrir = 'VENTANA';
    vformname = 'popupReprogramacionMedicosFisco';
    vtitle = '<h1>Programación de Médicos</h1>';
    vwidth = '500';
    vheight = '250';
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
    patronModulo = 'consultaProgramacionMedicosJorgeNuevo';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + nombrepersona;
    parametros += '&p3=' + codigocronograma;
    posFuncion = '';
    //document.getElementById("hcodigoverificacion").value = claveautorizacion;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function cargarComboAmbienteFisicoReprogramacionMedicoNuevo(){
    var idAmbienteslogicos = $('cb_filtro_ambienteslogicos').value
    var cidSedeEmpresa = $('idSedeEmpresa').value
    //    alert(idAmbienteslogicos);alert(cidSedeEmpresa);
    
    var patronModulo = 'cargarComboAmbienteFisicoReprogramacionMedicoNuevo';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + idAmbienteslogicos;
    parametros += '&p3=' + cidSedeEmpresa;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        asynchronous: false,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('div_localizacionAmbienteFisico').update(respuesta);   
        }
    })
}
function CancelarCambiodeAmbienteFisico(){
    Windows.close("Div_opcionProgramacionMedicos");
    Windows.close("Div_popupReprogramacionMedicosFisco");
  
}
function actualizarAmbienteFisico(){
    var codigopersona = document.getElementById("hcodigopersona").value;
    var idCodigocronograma = document.getElementById("idCodigocronograma").value;
    var idAmbienteslogicos = $('cb_filtro_ambienteslogicos').value;
    var idAmbienteFisico = $('cb_filtro_ambienteFisico').value;
    var vTxtAreaMotivoDelCambioAmbiente = $('idTxtAreaMotivoDelCambioAmbiente').value;
    var m=vTxtAreaMotivoDelCambioAmbiente.length; 
    var bValidador=1;
    if(m>20){        
        if(idAmbienteslogicos==0){
            bValidador=0;
            alert("Ingrese Ambiente Logico");
        }
        if(idAmbienteFisico=='0000'){
            bValidador=0;
            alert("Ingrese Ambiente Fisico");
        }
        if(bValidador==1){
            accionControl = "mantenimientoReprogramarMedico";
            pathLink = "";
            pathLink += "p1=" + accionControl;
            pathLink += "&p2=" + idCodigocronograma;
            pathLink += "&p3=" + idAmbienteslogicos;
            pathLink += "&p4=" + idAmbienteFisico;
            pathLink += "&p5=" + vTxtAreaMotivoDelCambioAmbiente;

            new Ajax.Request(pathRequestControl, {
                method: 'post',
                parameters: pathLink,
                onLoading: micargador(1),
                onComplete: function(transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    rs = respuesta.split("|");
                    window.alert(rs[1]);
                    if (rs[0] == 0)
                        regresarCronogramaProgramacionMedicos();
                }
            })    
        }      
    }else{
        alert('Ingreso Motivo del Cambio de Ambiente')
    }
}


function listarLogCronograma(){
    var patronModulo = 'mostrarTablaLog';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + $('hcodigopersona').value;
    parametros += '&p3=' + $('cb_filtro_mes').value;
    parametros += '&p4=' + $('cb_filtro_anio').value;
    tblLogCronogramaMensual = new dhtmlXGridObject('contendorTabla');
    tblLogCronogramaMensual.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tblLogCronogramaMensual.setSkin("dhx_skyblue");
    tblLogCronogramaMensual.enableRowsHover(true, 'grid_hover');
    tblLogCronogramaMensual.enableMultiline(true);
    tblLogCronogramaMensual.attachEvent("onRowSelect", function(rowId, cellInd) {
        
        });
    contadorCargador++;
    var idCargador = contadorCargador;
    tblLogCronogramaMensual.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    tblLogCronogramaMensual.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    tblLogCronogramaMensual.setSkin("dhx_skyblue");
    tblLogCronogramaMensual.init();
    tblLogCronogramaMensual.loadXML(pathRequestControl+'?'+parametros,function(){
       
        }); 
}

