/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function cargarArbolCentroCostosServiciosxPuestos()
{
    myDiv=document.getElementById('Div_arbolServiciosxPuestos');
    myDiv.innerHTML = " ";
    tree=new dhtmlXTreeObject("Div_arbolServiciosxPuestos","100%","100%",0);
    tree.setImagePath("../../../../fastmedical_front/imagen/icono/tree/");
    tree.attachEvent("onClick", function(){
        clickCargaCentroCostoPuestos(tree.getSelectedItemId(),tree.getSelectedItemText());
        return true;
    });
    tree.loadXML("../../../../carpetaDocumentos/arbol_centroCostos.xml");
    tree.openAllItems(0);
    

}

function clickCargaCentroCostoPuestos(id,nombrecentrocosto){
    document.getElementById("hidcentrocosto").value=id;
    document.getElementById("hidpuesto").value='';
    $('Div_nombreCentroCostos').innerHTML = "<h1>"+nombrecentrocosto+"</h1>";
    pathLink = "p1=cargarPuestos_serviciosXpuestos&p2="+id;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : pathLink,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            respuesta = transport.responseText;
            $('Div_tablaPuestos').update(respuesta);
            $('Div_btnAgregar').hide();
            limpiarTablasServiciosAsignados();
        }
    });
}

function irmostrarServiciosAsignados(html,event,parametro){
    arreglo = parametro.split("|");
    document.getElementById("hidpuesto").value=arreglo[0];
    idpuesto = document.getElementById("hidpuesto").value;
    idCentroCosto = document.getElementById("hidcentrocosto").value;
    nombrePuesto = arreglo[1];
    $('Div_nombrePuesto').innerHTML = "<h1>"+nombrePuesto+"</h1>";
    pathLink = "p1=cargarServicios_serviciosXpuestos&p2="+idCentroCosto+"&p3="+idpuesto;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : pathLink,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            respuesta = transport.responseText;
            $('Div_tablaServicios1').update(respuesta);
            $('Div_tablaServicios2').update(respuesta);
            $('Div_btnAgregar').show();
        }
    })
}
function limpiarTablasServiciosAsignados(){
    idCentroCosto = '';
    idpuesto = '';
    pathLink = "p1=cargarServicios_serviciosXpuestos&p2="+idCentroCosto+"&p3="+idpuesto;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : pathLink,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            respuesta = transport.responseText;
            $('Div_tablaServicios1').update(respuesta);
            $('Div_tablaServicios2').update(respuesta);
        }
    })
}
function mostrarServiciosxAsignar(){
    idCentroCosto = document.getElementById("hidcentrocosto").value;
    idpuesto = document.getElementById("hidpuesto").value;
    pathLink = "p1=cargarServiciosxAsignar&p2="+idCentroCosto+"&p3="+idpuesto;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : pathLink,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            respuesta = transport.responseText;
            $('Div_tablaServiciosxAsignar').update(respuesta);

        }
    })
}
function irAsignacionServiciosxPuestos(){
    $("Div_Principal1").hide();
    $("Div_Principal2").show();
    mostrarServiciosxAsignar();
}

function regresarAsignacionServiciosxPuestos(){
    $("Div_Principal1").show();
    $("Div_Principal2").hide();
}

function refreshTablaServiciosAsignados(){
    idpuesto = document.getElementById("hidpuesto").value;
    idCentroCosto = document.getElementById("hidcentrocosto").value;
    pathLink = "p1=cargarServicios_serviciosXpuestos&p2="+idCentroCosto+"&p3="+idpuesto;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : pathLink,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('Div_tablaServicios1').update(respuesta);
            $('Div_tablaServicios2').update(respuesta);

        }
    })
}

function grabarAsignacionServicioaPuesto(idservicio){
    idpuesto = document.getElementById("hidpuesto").value;
    pathLink = "p1=grabarAsignacionServicioaPuesto&p2="+idservicio+"&p3="+idpuesto;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : pathLink,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            refreshTablaServiciosAsignados();
            mostrarServiciosxAsignar();
        }
    })
}

function irActivaryDesactivarAsignacionxPuesto(idservicio){
    idpuesto = document.getElementById("hidpuesto").value;
    pathLink = "p1=activaryDesactivarAsignacionServicioaPuesto&p2="+idservicio+"&p3="+idpuesto;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : pathLink,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            refreshTablaServiciosAsignados();
        }
    })

}

function irEliminarAsignacion(idservicio){
    idpuesto = document.getElementById("hidpuesto").value;
    if (confirm("¿Esta seguro de Eliminar la Asignación de este Servicio?")){
        pathLink = "p1=eliminarAsignacionServicioaPuesto&p2="+idservicio+"&p3="+idpuesto;
        new Ajax.Request( pathRequestControl,{
            method : 'get',
            parameters : pathLink,
            onLoading : micargador(1),
            onComplete : function(transport){
                micargador(0);
                refreshTablaServiciosAsignados();
                mostrarServiciosxAsignar();
            }
        })
    }
}