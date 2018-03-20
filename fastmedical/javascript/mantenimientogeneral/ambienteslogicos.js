/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function cargarArbolCentroCostos()
{
    var myDiv=document.getElementById('Div_centroCostos');
    myDiv.innerHTML = " ";
    var tree=new dhtmlXTreeObject("Div_centroCostos","100%","100%",0);
    tree.setImagePath("../../../../medifacil_front/imagen/icono/tree/");
    tree.attachEvent("onClick", function(){
        clickCargaCentroCosto(tree.getSelectedItemId(),tree.getSelectedItemText());
        desactivar();
        limpiarDatosAmbienteLogico();
        $('divGuardaryRegresar').hide();
        $('divNuevo').show();
        return true;
    })
    tree.loadXML("../../../../carpetaDocumentos/arbol_centroCostos.xml");
    tree.openAllItems(0);

}
function clickCargaCentroCosto(id,nombre){
    document.getElementById("hidcentrocosto").value=id;
    document.getElementById("txtnombrecentrocosto").value=nombre;

    var pathLink = "p1=mantenimientoAmbientesLogicos&p2="+id;
    //    ////para cargador peche
    //    contadorCargador++;
    //    var idCargador=contadorCargador;
    //    new Ajax.Request( pathRequestControl,{
    //        method : 'get',
    //        parameters : pathLink,
    //        onLoading : cargadorpeche(1,idCargador),
    //        onComplete : function(transport){
    //            cargadorpeche(0,idCargador);
    //            codigoCentroCosto(id);
    //            var respuesta = transport.responseText;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : pathLink,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText;
            codigoCentroCosto(id);
            $('Div_TablaAmbientesLogicos').update(respuesta);
        }
    })
}

function codigoCentroCosto(id){
    var pathLink = "p1=mantenimientoAmbientesLogicosCentroCosto&p2="+id;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : pathLink,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText;
            document.getElementById("txtcodigocentrocosto").value=respuesta;

        }
    })
}
function activar(){
    document.getElementById("txtnombreambientelogico").readOnly=false;
    document.getElementById("txtdescripcionambientelogico").readOnly=false;
    document.getElementById("checkhabilitarAmbienteLogicos").disabled=false;
}
function desactivar(){
    document.getElementById("txtnombreambientelogico").readOnly=true;
    document.getElementById("txtdescripcionambientelogico").readOnly=true;
    document.getElementById("checkhabilitarAmbienteLogicos").disabled=true;
}
function nuevoAmbienteLogico(){
    var idCentroCosto = document.getElementById("txtcodigocentrocosto").value;
    var nombreCentroCosto = document.getElementById("txtnombrecentrocosto").value;
    document.getElementById("hcodigoambientelogico").value = "";
    if(idCentroCosto!="" && nombreCentroCosto!=""){
        limpiarDatosAmbienteLogico()
        activar();
        $('divGuardaryRegresar').show();
        $('divNuevo').hide();
    }
}

function limpiarDatosAmbienteLogico(){
    document.getElementById("txtnombreambientelogico").value="";
    document.getElementById("txtdescripcionambientelogico").value="";
}

function pintarDatosAmbienteLogico(nombrecentrocosto,nombreambientelogico,descripcionambientelogico,bactivo){
    document.getElementById("txtnombrecentrocosto").value=nombrecentrocosto;
    document.getElementById("txtnombreambientelogico").value=nombreambientelogico;
    document.getElementById("txtdescripcionambientelogico").value=descripcionambientelogico;
    if (bactivo == '0') document.getElementById("checkhabilitarAmbienteLogicos").checked = 0;
    if (bactivo == '1') document.getElementById("checkhabilitarAmbienteLogicos").checked = 1;
}

function refreshTablaAmbientesLogicos(){
    var id=document.getElementById("hidcentrocosto").value;
    var pathLink = "p1=mantenimientoAmbientesLogicos&p2="+id;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : pathLink,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText;
            $('Div_TablaAmbientesLogicos').update(respuesta);
            
        }
    })
}
function irAsignarAmbienteFisico(codigoAmbienteLogico,nombreAmbienteLogico){
    
    ventana_asignacion_ambientesfisicos(codigoAmbienteLogico,nombreAmbienteLogico," ");
}
function ventana_asignacion_ambientesfisicos(codigoAmbienteLogico,nombreAmbienteLogico,funcionJSEjecutar){
    //window.alert($('divBusCronogramaMedico').getStyle('z-index'));
    CargarVentana('tablacitasAdicionales','','../../ccontrol/control/control.php?p1=mostrarAsignacionAmbientesFisicosaAmbientesLogicos&p2='+codigoAmbienteLogico+'&p3='+nombreAmbienteLogico+'&funcionJSEjecutar='+funcionJSEjecutar,'650','550','t',true,0,1,'',0,0,0,0);

}
/************************MANTENIMIENTO******************************************/
function irmostrarAmbienteLogico(html,event,codigoAmbienteLogico){
    document.getElementById("hcodigoambientelogico").value=codigoAmbienteLogico
    var pathLink = "p1=editarAmbientesLogicos&p2="+codigoAmbienteLogico;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : pathLink,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText;
            eval(respuesta);
            $('divGuardaryRegresar').show();
            $('divNuevo').hide();

        }
    })
}
function irEditarAmbienteLogico(codigoAmbienteLogico){
    document.getElementById("hcodigoambientelogico").value=codigoAmbienteLogico
    pathLink = "p1=editarAmbientesLogicos&p2="+codigoAmbienteLogico;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : pathLink,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            eval(respuesta);
            activar();
            $('divGuardaryRegresar').show();
            $('divNuevo').hide();

        }
    })
}

function irActivaryDesactivarAmbienteLogico(codigoAmbienteLogico,bActivo){
    document.getElementById("hcodigoambientelogico").value=codigoAmbienteLogico
    pathLink = "p1=activaryDesactivarAmbienteLogico&p2="+codigoAmbienteLogico+"&p3="+bActivo;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : pathLink,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            refreshTablaAmbientesLogicos();
        }
    })
}

function grabarAmbienteLogico(){
    idcentrocosto=document.getElementById("hidcentrocosto").value;
    codigoambientelogico = document.getElementById("hcodigoambientelogico").value;
    nombreambientelogico = document.getElementById("txtnombreambientelogico").value;
    estadoambientelogico = document.getElementById("checkhabilitarAmbienteLogicos").checked;
    descripcionambientelogico = document.getElementById("txtdescripcionambientelogico").value;
    if(nombreambientelogico!=""){
        pathLink = "p1=grabarAmbienteLogico&p2="+idcentrocosto+"&p3="+codigoambientelogico+"&p4="+nombreambientelogico+"&p5="+estadoambientelogico+"&p6="+descripcionambientelogico;
        new Ajax.Request( pathRequestControl,{
            method : 'get',
            parameters : pathLink,
            onLoading : micargador(1),
            onComplete : function(transport){
                micargador(0);
                desactivar();
                limpiarDatosAmbienteLogico();
                $('divGuardaryRegresar').hide();
                $('divNuevo').show();
                refreshTablaAmbientesLogicos();
            }
        })
    }else{
        window.alert("Ingrese Nombre de Ambiente Logico!");
    }
}


/***********ASIGNACION DE AMBIENTES FISICOS A LOS AMBIENTES LOGICOS************/
function agregarAmbienteFisicoaAmbienteLogico(){
    codigoambientelogico = document.getElementById("hidambientelogico").value;
    codigoambientefisico = document.getElementById("cboAmbFisicos").value;
    codigoactividad = document.getElementById("cboActividad").value;
    estadoasignacion = document.getElementById("checkhabilitarAsignacion").checked;
    pathLink = "p1=agregarAmbienteFisicoaAmbienteLogico&p2="+codigoambientelogico+"&p3="+codigoambientefisico+"&p4="+codigoactividad+"&p5="+estadoasignacion;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : pathLink,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            refreshTablaAsignacionAmbientesLogicos();
        }
    })
//window.alert(codigoambientelogico+","+codigoambientefisico+","+codigoactividad+","+estadoasignacion);

}

function refreshTablaAsignacionAmbientesLogicos(){
    codigoAmbienteLogico = document.getElementById("hidambientelogico").value;
    nombreAmbienteLogico = document.getElementById("hnombreambientelogico").value;
    pathLink = "p1=mostrarTablaAsignacionAmbientesFisicosaAmbientesLogicos&p2="+codigoAmbienteLogico+'&p3='+nombreAmbienteLogico;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : pathLink,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('Div_TablaAsignacionAmbientesLogicos').update(respuesta);

        }
    })

}

function irActivaryDesactivarAsignacionAmbFisicoaAmbLogico(codigoAmbienteLogico,codigoAmbienteFisico,codigoActividad,estadoasignacion){
    pathLink = "p1=activarydesactivarAsignacionAmbFisicoaAmbLogico&p2="+codigoAmbienteLogico+"&p3="+codigoAmbienteFisico+"&p4="+codigoActividad+"&p5="+estadoasignacion;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : pathLink,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            refreshTablaAsignacionAmbientesLogicos();
        }
    })
}

function irEliminarAsignacionAmbFisicoaAmbLogico(codigoAmbienteLogico,codigoAmbienteFisico,codigoActividad){
    pathLink = "p1=eliminarAsignacionAmbFisicoaAmbLogico&p2="+codigoAmbienteLogico+"&p3="+codigoAmbienteFisico+"&p4="+codigoActividad;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : pathLink,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            refreshTablaAsignacionAmbientesLogicos();
        }
    })
}