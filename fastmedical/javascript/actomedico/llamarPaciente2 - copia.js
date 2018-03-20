/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var pathRequestControl = "../../ccontrol/control/control.php";

function activarPantalla(){
    //var windowprops ="top=0,left=0,toolbar=no,location=no,status=no, menubar=no,scrollbars=no, resizable=no,width=" + w + ",height=" + h;
    //var winName="titulo" 
    pantalla=$("hidPantalla").value;
    patronModulo='proyectarPantalla';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+pantalla;
    window.open(pathRequestControl+"?"+parametros); 
    
}
function llamarPaciente1(){
    var pantalla=$('hpantalla').value;
    var patronModulo='verCola';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+pantalla;

    new Ajax.Request( pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        //onLoading : micargador(1),
        onComplete : function(transport){
             respuesta = transport.responseText;
            //respuesta=trim(respuesta);
            var vacio=respuesta.indexOf("x")
            if(vacio!=0){
                var miarray=respuesta.split("|");
                var consultorio=miarray[0];
                var mensaje=miarray[1];
                //$('div1').update(respuesta);
                ubicarEspacio(consultorio,mensaje);
            }
            setTimeout("llamarPaciente1()",2000);
        //alert(mensaje+consultorio);
        }
    } )
}
function llamarPaciente(){
    pantalla=$('hpantalla').value;
    patronModulo='verCola';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+pantalla;
        


    new Ajax.Request( pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        //onLoading : micargador(1),
        onComplete : function(transport){
            respuesta = transport.responseText;
            if(respuesta!='|'){
                var miarray=respuesta.split("|");
                consultorio=miarray[0];
                mensaje=miarray[1];
                //$('div1').update(respuesta);
                ubicarEspacio(consultorio,mensaje);
            }
            
        //alert(mensaje+consultorio);
        }
    } )



}

function ubicarEspacio(c, mensaje){
    numeroEspacios=$('numeroEspacios').value;
    //alert('consultorio');
    aux=numeroEspacios;
    for (var x=0; x <numeroEspacios-1; x++) {
       
        campo='hconsultorio'+aux;
       
        div='div'+aux;
        aux2=aux-1;
        campoAux='hconsultorio'+aux2;
        divAux='div'+aux2;
        //alert(campoAux)
        $(campo).value=$(campoAux).value;
        $(div).innerHTML=$(divAux).innerHTML;
        aux=aux-1;


    }

    $('div1').innerHTML=mensaje;
    $('hconsultorio1').value=c;
    
}

