var pathRequestControl = "../../ccontrol/control/control.php";

function mostrarventanadecambiodeafiliacion(idpersona){
    vformname='cambioafiliaciongeneral';
    vtitle='Cambio de Afiliación';
    vwidth='800'
    vheight='650'
    vcenter='t'
    vresizable=''
    vmodal='false'
    vstyle=''
    vopacity=''
    vposx1=''
    vposx2=''
    vposy1=''
    vposy2=''
    patronModulo='cambioafiliaciongeneral';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idpersona;
    posFuncion='pintarBotonAceptarCambioAfiliacion';
    CargarVentanaPopPap(vformname,vtitle,vwidth,vheight,vcenter,vresizable,vmodal,vstyle,vopacity,vposx1,vposx2,vposy1,vposy2,parametros,posFuncion)
}

function pintarBotonAceptarCambioAfiliacion(){
    var radiobuttons = document.getElementsByName('rbtnafiliacionesactivas');
    for (var i = 0; i < radiobuttons.length; i++) {
        if (radiobuttons.item(i).checked) {
            codigoafiliacionseleccionado = radiobuttons.item(i).value;
            break;
        }
    }
    if(codigoafiliacionseleccionado=='0027'){
        if($('hdnAccionEssalud').value=='0'){//Cuando hay mensajes en rojo
            $('btnaceptarcambioafiliacion').hide();
        }
        else{
            if($('hdnAccionEssalud').value=='2'){
                $('btnaceptarcambioafiliacion').hide();//Cuando Todo OK
            }
            else{//Cuando esta todo ok y falta agregarle saldo en 100 soles
                $('btnaceptarcambioafiliacion').show();
            }
        }
    }
}

function mostrarafiliaciones(){
    codigopersona = $('hcodigopersona').value;
    patronModulo='mostrarafiliaciones'
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+codigopersona;

    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('Div_afiliaciones').innerHTML=respuesta;    
        }
    } )    
}

function mostrarNOafiliaciones(){
    codigopersona = $('hcodigopersona').value;
    patronModulo='mostrarNOafiliaciones'
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+codigopersona;

    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('Div_NOafiliaciones').innerHTML=respuesta;    
        }
    } )    
}

function completar(valor,nrodigitos){  
    var numero=parseFloat(valor);
    numero=""+numero;
    var ancho2=numero.length;
    for (x=0;x<(nrodigitos-ancho2);x++)
        numero='0'+''+numero;
    return numero;
}	
contribuyentepuntual = {
    url:'lib/logica.php',
    buscarcontribuyentes:function(){
        contribuyentepuntual.cargargridDatos();				
    },
    consultaestado_contrib:function(idcontrib){	
        var opcion = 2;
        if(idcontrib=='' || idcontrib == null ){
            alert('Debe seleccionar un contribuyente de la lista!');
            return;
        }
        $('hcodigocontribuyente').value = tablaContribuyentes.cellById(idcontrib, 0).getValue();
        $('hnombrecontribuyente').value = tablaContribuyentes.cellById(idcontrib, 1).getValue();
        patronModulo='consultarContribuyentePuntual';
        parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+opcion;
        parametros+='&p3='+idcontrib;
        
        new Ajax.Request( pathRequestControl,{
            method : 'get',
            parameters : parametros,
            onLoading : micargador(1),
            onComplete : function(transport){
                micargador(0);
                respuesta = transport.responseText;
                if(respuesta.split("|")[0]=="1"){
                    $('btnaceptarcambioafiliacion').show();
                }else{
                    $('btnaceptarcambioafiliacion').hide();
                }
                $('Div_estado_contrib').update(respuesta.split("|")[1]);
            }
        })

    },
    cargargridDatos:function(){	
        var opcion = document.getElementById("filtrarpor").value
        var idcont = document.getElementById("txtpcodigo").value;
        var strstring  = document.getElementById("txtpbuscar").value;
        if(parseInt(opcion)==1){
            if(strstring==''){
                alert('Ingrese Nombre de contribuyente');
                return;
            }
        }
        if(parseInt(opcion)==3){
            if(idcont==''){
                alert('Ingrese Codigo de contribuyente');
                return;
            }
        }
    
        patronModulo='mostrarTablaContribuyentePuntual';
        parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+opcion;
        parametros+='&p3='+idcont;
        parametros+='&p4='+encodeURIComponent(strstring);

        tablaContribuyentes = new dhtmlXGridObject('Div_gridContribuyentes');
        tablaContribuyentes.setImagePath("../../../../fastmedical_front/imagen/icono/");
        tablaContribuyentes.setSkin("dhx_skyblue");

        tablaContribuyentes.attachEvent("onRowSelect", contribuyentepuntual.consultaestado_contrib);

        tablaContribuyentes.init();
        tablaContribuyentes.loadXML(pathRequestControl+'?'+parametros,function(){
            
            });        
 
        

    },
    opcionesfiltro:function(option){		
        if(option==3){
            document.getElementById("filtrarpor").value = 3;			
            document.getElementById('div_consultaporcodigo').style.display='block';
            document.getElementById('div_consultapornombre').style.display='none';
            document.getElementById("txtpcodigo").select();
        }else{
            document.getElementById("filtrarpor").value = 1;
            document.getElementById('div_consultaporcodigo').style.display='none';
            document.getElementById('div_consultapornombre').style.display='block';
            document.getElementById("txtpbuscar").select();
        }
    },
    selectedregist:function(idcontrib){
        document.getElementById("c_idcont00").value=idcontrib;
        document.getElementById('btn_verestado[]').disabled = false;
    },
    completar_ceros:function(obj){
        if(isNaN(document.getElementById(obj).value)){
            alert('Codigo de contribuyente no valido');
            document.getElementById(obj).value='';
            return
        }
        document.getElementById(obj).value=completar(document.getElementById(obj).value,7);	   			
    }
}

function mostrarVerificacionContribuyente(idpersona){
    patronModulo='mostrarVerificacionContribuyente'
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idpersona;

    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('Div_VerificacionAfiliaciones').innerHTML=respuesta;    
        }
    } )
}

function cerrarVentanacambioafiliacion(){
    Windows.close('Div_cambioafiliaciongeneral');
}

function aceptarCambioAfiliacionGeneral(){
    var radiobuttons = document.getElementsByName('rbtnafiliacionesactivas');
    codigopersona = $('hcodigopersona').value;
    for (var i = 0; i < radiobuttons.length; i++) {
        if (radiobuttons.item(i).checked) {
            codigoafiliacionseleccionado = radiobuttons.item(i).value;
            break;
        }
    }
    
    switch(codigoafiliacionseleccionado){
        case '0001' :{
            cambiarAfiliacionaAmbulatorio(codigopersona);
            break;
        }
        case '0002' :{
            cambiarAfiliacionaContribuyente(codigopersona);
            break;
        }
        case '0027' :{
            cambiarAfiliacionaEssalud(codigopersona);
            break;
        }
        default:{
            window.alert("Coordinar con el area respectiva!!!");
        }
        cerrarVentanacambioafiliacion();
    }
}
function cambioaAmbulatorio(idpersona){

    patronModulo='cambiarAfiliacionAmbulatorio'
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idpersona;

    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            clickonFilaPersonaEncontrada('','',idpersona)
            
        }
    } )    
}
/*VENTANA CAMBIO DE AFILIACIONES*/
function cambiarAfiliacionaAmbulatorio(idpersona){
    patronModulo='cambiarAfiliacionAmbulatorio'
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idpersona;

    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            window.alert(respuesta);
            cerrarVentanacambioafiliacion();            
            clickonFilaPersonaEncontrada('','',idpersona)
            
        }
    } )
}
function cambiarAfiliacionaContribuyente(codigopersona){
    codigocontribuyente = $('hcodigocontribuyente').value;
    nombrecontribuyente = $('hnombrecontribuyente').value;
    if (confirm("¿Esta seguro de cambiar a Contribuyente Puntual la afiliación de la persona "+nombrecontribuyente+" con código de contribuyente "+codigocontribuyente+" ?")){
        patronModulo='cambiarAfiliacionContribuyente'
        parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+codigopersona;
        parametros+='&p3='+codigocontribuyente;

        new Ajax.Request( pathRequestControl,{
            method : 'get',
            parameters : parametros,
            onLoading : micargador(1),
            onComplete : function(transport){
                micargador(0);
                respuesta = transport.responseText;
                window.alert(respuesta);
                cerrarVentanacambioafiliacion();
                clickonFilaPersonaEncontrada('','',codigopersona)
            }
        } )        
    }
}
function cambiarAfiliacionaEssalud(codigopersona){
    var accion=$('hdnAccionEssalud').value;
    //accion es una cadena porque lo lee de un hidden
    switch(accion){
        case '1' :{// Cuando hay una sola cabecera de carta y un detalle, con saldo menor a 100 soles
            cambiarAfiliacionEssaludAumentarSaldo(accion,codigopersona);
            break;
        }
        case '2' :{// Todo OK para cambiar acreditacion como ESSALUD
            cambiarAfiliacionEssaludTodoOk(accion,codigopersona);
            break;
        }
        case '3' :{
            //cambiarAfiliacionaEssalud(codigopersona);
            break;
        }
        default:{
            //window.alert("Coordinar con el area respectiva!!!");
        }
        //cerrarVentanacambioafiliacion();
    }
}

function cambiarAfiliacionEssaludAumentarSaldo(accion,codigopersona){
    if(confirm("\xBFEst\xE1 seguro que desea cambiar la afiliaci\xF3n a ESSALUD e incrementar saldo en S/.100?")){
        var idCarta=$('hdnIdCarta').value;
        var idDetalleCarta=$('hdnIdDetalleCarta').value;
        patronModulo='cambiarAfiliacionEssalud';
        parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+accion;
        parametros+='&p3='+codigopersona;
        parametros+='&p4='+idCarta;
        parametros+='&p5='+idDetalleCarta;

        new Ajax.Request( pathRequestControl,{
            method : 'get',
            parameters : parametros,
            onLoading : micargador(1),
            onComplete : function(transport){
                micargador(0);
                respuesta = transport.responseText;
                window.alert(respuesta);
                cerrarVentanacambioafiliacion();
                clickonFilaPersonaEncontrada('','',codigopersona);
            }
        } )
    }
    else{
        cerrarVentanacambioafiliacion();
    }
}

function cambiarAfiliacionEssaludTodoOk(accion,codigopersona){
    if(confirm("\xBFEst\xE1 seguro que desea cambiar la afiliaci\xF3n a ESSALUD?")){
        //var accion=$('hdnAccionEssalud').value;
        patronModulo='cambiarAfiliacionEssalud';
        parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+accion;
        parametros+='&p3='+codigopersona;

        new Ajax.Request( pathRequestControl,{
            method : 'get',
            parameters : parametros,
            onLoading : micargador(1),
            onComplete : function(transport){
                micargador(0);
                respuesta = transport.responseText;
                window.alert(respuesta);
                cerrarVentanacambioafiliacion();
                clickonFilaPersonaEncontrada('','',codigopersona);
            }
        } )
    }
    else{
        cerrarVentanacambioafiliacion();
    }
}

function cambiarAfiliacionGeneral(idAfiliacion,idPersona){
    
    switch(idAfiliacion){
        case '0001' :{
            $('btnaceptarcambioafiliacion').show();
            $('Div_VerificacionAfiliaciones').innerHTML='';
            break;
        }
        case '0002' :{
            $('btnaceptarcambioafiliacion').hide();
            mostrarVerificacionContribuyente(idPersona);
            break;
        }
        case '0027' :{
            var c_cod_per=idPersona;
            mostrarVerificacionEssalud(c_cod_per);
            /*
            if($("hdnUltimaAfiliacionActiva").value=='0027'){
                alert("Essalud es su afiliacion actual");
                $('btnaceptarcambioafiliacion').hide();
                mostrarVerificacionEssalud(c_cod_per);

                //if($('hdnAccionEssalud').value=='0'){//Cuando hay mensajes en rojo
                    //$('btnaceptarcambioafiliacion').hide();
                //}
                //else{
                    //if($('hdnAccionEssalud').value=='2'){
                        //$('btnaceptarcambioafiliacion').hide();//Cuando Todo OK
                    //}
                    //else{//Cuando esta todo ok y falta agregarle saldo en 100 soles
                        //$('btnaceptarcambioafiliacion').show();
                    //}
                //}
            }
            else{
                mostrarVerificacionEssalud(c_cod_per);
                if($('hdnAccionEssalud').value=='0'){//Cuando hay mensajes en rojo
                    $('btnaceptarcambioafiliacion').hide();
                }
                else{//Cuando esta todo Ok o solo falta agregar saldo en 100 soles
                    $('btnaceptarcambioafiliacion').show();
                }
            }*/
            break;
        }        
        default:{
            window.alert("Coordinar con el area respectiva!!!");
        }
    }
}

function mostrarVerificacionEssalud(c_cod_per){
    patronModulo='mostrarVerificacionEssalud'
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+c_cod_per;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            //$('Div_VerificacionAfiliaciones').update=respuesta;
            $('Div_VerificacionAfiliaciones').innerHTML=respuesta;

            if($("hdnUltimaAfiliacionActiva").value=='0027'){
                $('btnaceptarcambioafiliacion').hide();
                alert("Essalud es su afiliacion actual");
            }
            else{
                if($('hdnAccionEssalud').value=='0'){//Cuando hay mensajes en rojo
                    $('btnaceptarcambioafiliacion').hide();
                }
                else{//Cuando esta todo Ok o solo falta agregar saldo en 100 soles
                    $('btnaceptarcambioafiliacion').show();
                }
            }
        }
    } )
}

function asignarAfiliaciones(){
    var checks = document.getElementsByName('chkafiliacionesNOactivas');
    codigopersona = $('hcodigopersona').value;
    afiliaciones = '';
    for (var i = 0; i < checks.length; i++) {
        if (checks.item(i).checked) {
            codigoafiliacionseleccionado = checks.item(i).value;
            afiliaciones = afiliaciones + "|" +codigoafiliacionseleccionado;
        }
    }    
    afiliaciones = afiliaciones.substring(1,afiliaciones.length);
    if (confirm("¿Esta seguro de agregar estas afiliaciones ?")){
        patronModulo='agregarAfiliacionesalPaciente'
        parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+codigopersona;
        parametros+='&p3='+afiliaciones;

        new Ajax.Request( pathRequestControl,{
            method : 'get',
            parameters : parametros,
            onLoading : micargador(1),
            onComplete : function(transport){
                micargador(0);
                mostrarafiliaciones();
                mostrarNOafiliaciones();
            }
        } )        
    }    
    
}
function quitarAfiliacion(){
    var radiobuttons = document.getElementsByName('rbtnafiliacionesactivas');
    codigopersona = $('hcodigopersona').value;
    for (var i = 0; i < radiobuttons.length; i++) {
        if (radiobuttons.item(i).checked) {
            codigoafiliacionseleccionado = radiobuttons.item(i).value;
            break;
        }
    }
    if (confirm("¿Desea quitar esta afiliación al paciente ?")){
        patronModulo='quitarAfiliacionalPaciente'
        parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+codigopersona;
        parametros+='&p3='+codigoafiliacionseleccionado;

        new Ajax.Request( pathRequestControl,{
            method : 'get',
            parameters : parametros,
            onLoading : micargador(1),
            onComplete : function(transport){
                micargador(0);
                mostrarafiliaciones();
                mostrarNOafiliaciones();
            }
        } )        
    }
}