var pathRequestControl = "../../ccontrol/control/control.php";
//Variables globales
var kk=1;
//función empleada en la búsqueda de pacientes
var pathRequestControl = "../../ccontrol/control/control.php";
var contadorCargador=0;
var arrayEstadosCargador= new Array();
//var laban=28;
/*
function micargador(estado){
    $('VentanaTransparente').setStyle({
        visibility:'visible'
    });
    
    switch (estado){
        
        case 0:	{
                
            $('VentanaTransparente').hide();
            // alert('por aca');
            break;
        }
        case 1:{
            $('VentanaTransparente').show();
            break;
        }
    }
}
*/
/*
function cargadorpeche(estado,id){
    if(estado==1){
        arrayEstadosCargador[id]=1;
        var alto=document.body.scrollHeight;
        //alto=100;
        //alert("id:"+id+" alto: "+alto)
        $('overlayPeche').setStyle({
            height:alto+'px'
        })
        $('VentanaTransparente').show();
        
    }
    if(estado==0){
        arrayEstadosCargador[id]=0;
        var numeroCargadores=arrayEstadosCargador.length;
        var estadoGeneral=0;
        
        for (var i=0; i<=numeroCargadores; i++){
            if(arrayEstadosCargador[i]==1){
                estadoGeneral=1;
                break;
            }
        }
        if(estadoGeneral==0){
            $('VentanaTransparente').hide();
        }
        
    }
// alert('estado='+estado+'id='+id);
}
*/
function maximozindex(){
    var tCol=document.getElementsByTagName('*');
    var z=0;
    for(var i=0;i<tCol.length;i++){
        if(tCol[i].style.zIndex>z){
            z=tCol[i].style.zIndex;
        }
    }
    return ++z;
}



function permisoUsuarios(){//MUESTRA LOS PERMISOS DE USUSARIOS EN BUSQUEDA POR FORMULARIOS
    //alert('sandy');
    patronModulo='verPermisosUsuarios';
    parametros='';
    parametros+='p1='+patronModulo;

    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText;
            $('contenido_inicio').update(respuesta);
            cargarListaFormularios();
        //            recargarArbolAyuda();
           
        }
    } )
}


function serviciosUsuarios(){
    patronModulo='verServiciosUsuarios';
    parametros='';
    parametros+='p1='+patronModulo;

    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText;
            $('contenido_inicio').update(respuesta);
        cargarListaFormulariosServiciosUsuarios()
        //      recargarArbolAyuda();
           
        }
    } )
}


                  /*Clonar permisos por ususarios*/

  function clonarUsuarios(){
  
  patronModulo='verClonarUsuarios';
    parametros='';
    parametros+='p1='+patronModulo;

    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
          var respuesta = transport.responseText;
            $('contenido_inicio').update(respuesta);
          //  cargarListaFormularios();
           
        }
    } )
}

//         resetear CLAVE............
  function resetearClave(){
    patronModulo='resetearClave';
    parametros='';
    parametros+='p1='+patronModulo
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
          var respuesta = transport.responseText;
            $('contenido_inicio').update(respuesta);
        }
    } )
}

//-----------------------------------------------------------------------------------------
//---------------------------------CANCELAR SESION INDIVIDUAL------------------------------
//-----------------------------------------------------------------------------------------

function cancelarSesion(){
    //alert('sandy');
    patronModulo='verCancelarSesion';
    parametros='';
    parametros+='p1='+patronModulo;

    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText;
            $('contenido_inicio').update(respuesta);
           
        }
    } )
    } 
 //-----------------------------------------------------------------------------------------
//---------------------------------CANCELAR SESION X PERFIL---------------------------------
//------------------------------------------------------------------------------------------
  
  function registroDatosPersonalCS(){ //regestros datos de personal en CS= Cerrar Sesion
    patronModulo='registroDatosPersonalCS';
    parametros='';
    parametros+='p1='+patronModulo;

    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
          //  cargaArbolAreaBusqueda();
            cargaArbolCCostoCS();

        }
    } )
}


//-----------------------------------------------------------------------------------------
//---------------------------------PERIODO DE ACCESO---------------------------------------
//-----------------------------------------------------------------------------------------

function periodoDeAcceso(){
    //alert('sandy');
    patronModulo='verPeriodoDeAcceso';
    parametros='';
    parametros+='p1='+patronModulo;

    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText;
            $('contenido_inicio').update(respuesta);
           
        }
    } )
 
    
}