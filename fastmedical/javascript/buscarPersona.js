var ventanasActivas = Array();
var pathRequestControl = "../../ccontrol/control/control.php";

function getBuscarPersonas(event,elementoHTML,parametro){
    
    var bEstadoServicio=0;
    if(event==''){
        tecla=13;
    }else{
        tecla=event.keyCode
    }
    
    var patronModulo = "buscarPersonas";
    var funcion=document.getElementById("funcion").value;
    var editar=document.getElementById("heditar").value;
    var nro = trim(elementoHTML.value);
    var tipoDoc=document.getElementById("comboTipoDocumentos").value;

    if((tecla == 13 & nro.length>2)){
        var arreglo = $('hServicio').value.split("|");
        var codigoservicio = arreglo[0];
        //        alert(1);
        var parametros='';
        parametros+='p1='+patronModulo;
        //parametros+='&p2='+nro;
        parametros+='&p2='+Base64.encode(nro);
        parametros+='&p3='+tipoDoc;
        parametros+='&p4='+parametro;
        parametros+='&p5='+funcion;
        parametros+='&p6='+editar;

        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request( pathRequestControl,{
            method : 'get',
            parameters : parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function(transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                $('divResultadoBusqueda').update(respuesta);
                //funcion+="('"+parametro+"','','"+nro+"')";
                //eval(funcion);
                bEstadoServicio=validaServicionConProcedimiento(codigoservicio);
                ejecutaFuncion(funcion);
                
                if(bEstadoServicio==1){
                    var codigoFiliacion = document.getElementById("hiCodigoFiliacionActiva").value;
                    var c_cod_ser_pro = document.getElementById("hServicio").value;

                    var radios =document.getElementById("rbtnprocedimiento").value;
                    document.getElementById("rbtnprocedimiento").checked=true;

                    ventana_procedimiento(c_cod_ser_pro, codigoFiliacion);
                    var iid_persona=document.getElementById("txtcodigoPersona").value;
                    getVinculadosTratamientoPaciente(iid_persona) ;
                    getPrecioServicios();
                }
            }
        } )
  

    }
    else if(tecla == 13 & nro.length<=1){
        alert('Lo siento!. La busqueda tiene que ser de al menos 3 caracteres.');
    }
    if (parametro=='02'){
        var key=event.keyCode;
        if (key < 48 || key > 57){
            event.keyCode=0;
        }
    }
    limpiarCampos(parametro);

}


function getBuscarPersonasInsertada(codigo){


    patronModulo = "buscarPersonas";
    funcion=document.getElementById("funcion").value;
    nro = codigo;
    tipoDoc=document.getElementById("comboTipoDocumentos").value;
    parametro='02';
    editar=document.getElementById("heditar").value;


    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+Base64.encode(nro);
    //parametros+='&p2='+nro;
    parametros+='&p3='+tipoDoc;
    parametros+='&p4='+parametro;
    parametros+='&p5='+funcion;
    parametros+='&p6='+editar;

    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('divResultadoBusqueda').update(respuesta);

            ejecutaFuncion(funcion);

        }
    } )


    limpiarCampos(parametro);
}

function ejecutaFuncion(funcion){
    codigo=document.getElementById("txtcodigoPersona").value;
    funcion+="('','','"+codigo+"')";
    eval(funcion);

}

function getBuscarPersonasNombre(event,elemento,op){
    if(event==''){
        tecla=13;
    }else{
        tecla=event.keyCode
    }
    valor=elemento.value;
    var apellidoPaterno=document.getElementById("apellidoPaterno").value;
    var apellidoMaterno=document.getElementById("apellidoMaterno").value;
    var nombres=document.getElementById("nombres").value;
    
    apellidoPaterno=dTrim(apellidoPaterno);//validación de espacios en blanco al final
    apellidoMaterno=dTrim(apellidoMaterno);
    nombres=dTrim(nombres);
    var patronModulo = "buscarPersonas";
    var where='';
    var tipoDoc=document.getElementById("comboTipoDocumentos").value;
    var funcion=document.getElementById("funcion").value;
    var parametro='';
    var editar=document.getElementById("heditar").value;
    if(tecla == 13 ||event==0){
        if(apellidoPaterno!='' ){
            where=where+"and vApellidoPaterno like ''"+apellidoPaterno+"%''";
            parametro='03';
        }
        if(apellidoMaterno!=''){
            where=where+"and vApellidoMaterno like ''"+apellidoMaterno + "%''";
            parametro='03';
        }
        if(nombres!=''){
            where=where+"and vNombre like ''%"+nombres + "%''";
            parametro='03';
        }
        //window.alert(apellidoPaterno);
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+Base64.encode(where);
        parametros+='&p3='+tipoDoc;
        parametros+='&p4='+parametro;
        parametros+='&p5='+funcion;
        parametros+='&p6='+editar;
        //        path="../../ccontrol/control/control.php?"+parametros;
        //        myajax2.Link(path,'divResultadoBusqueda');
        contadorCargador++;
        var idCargador=contadorCargador;
        new Ajax.Request( pathRequestControl,{
            method : 'get',
            asynchronous:false,
            parameters : parametros,
            onLoading : cargadorpeche(1,idCargador),
            onComplete : function(transport){
                cargadorpeche(0,idCargador);
                var respuesta = transport.responseText;
                $('divResultadoBusqueda').update(respuesta);
            }
        } )
    }
    limpiarCampos('03');
}

function dTrim(sStr){
    while (sStr.charAt(sStr.length - 1) == " ")
        sStr = sStr.substr(0, sStr.length - 1);
    return sStr;	
}

function limpiarCampos(campo){
    switch(campo)
    {
        case "01":
            //document.getElementById("txtOrden").value='';
            document.getElementById("txtCodigo").value='';
            document.getElementById("nroDoc").value='';
        
            document.getElementById("apellidoPaterno").value='';
            document.getElementById("apellidoMaterno").value='';
            document.getElementById("nombres").value='';

            break;

        case "02":
            document.getElementById("txtOrden").value='';
            //document.getElementById("txtCodigo").value='';
            document.getElementById("nroDoc").value='';

            document.getElementById("apellidoPaterno").value='';
            document.getElementById("apellidoMaterno").value='';
            document.getElementById("nombres").value='';

            break;
        case "03":
            document.getElementById("txtOrden").value='';
            document.getElementById("txtCodigo").value='';
            document.getElementById("nroDoc").value='';
            document.getElementById("txtOrden").value='';
            //document.getElementById("apellidoPaterno").value='';
            //document.getElementById("apellidoMaterno").value='';
            //document.getElementById("nombres").value='';
            break;
        case "06":
            document.getElementById("txtOrden").value='';
            document.getElementById("txtCodigo").value='';
            //document.getElementById("nroDoc").value='';
            document.getElementById("txtOrden").value='';
            document.getElementById("apellidoPaterno").value='';
            document.getElementById("apellidoMaterno").value='';
            document.getElementById("nombres").value='';
            break;
        case "0":
            document.getElementById("txtOrden").value='';
            document.getElementById("txtCodigo").value='';
            document.getElementById("nroDoc").value='';
        
            document.getElementById("apellidoPaterno").value='';
            document.getElementById("apellidoMaterno").value='';
            document.getElementById("nombres").value='';
            break;
    }

}

function limpiarTablaBuscarPersonas(){
//path="../../ccontrol/control/control.php?p1=buscarPersonas&p2=&p3=&p4=&p5=";
//myajax3.Link(path,'divResultadoBusqueda');
}

function getMedicos(a, b, evento){
    var patronModulo='buscarMedicos'
    var apellidoPaterno=document.getElementById("txtApellidoPaterno").value;
    var apellidoMaterno=document.getElementById("txtApellidoMaterno").value;
    var nombres=document.getElementById("txtNombres").value;
    var numero = apellidoPaterno.length;
    var funcionMedicos=document.getElementById("hiddenFuncion").value;
    var parametros='';

    parametros+='p1='+patronModulo;
    parametros+='&p2='+apellidoPaterno;
    parametros+='&p3='+apellidoMaterno;
    parametros+='&p4='+nombres;
    parametros+='&p5='+funcionMedicos;

    var tecla = evento.keyCode
    if (numero == 3 || tecla == 13) {
        vcpt = 0;
        tablaMedicos = new dhtmlXGridObject('divResultadoBusquedaMedicos');
        tablaMedicos.setImagePath("../../../../medifacil_front/imagen/icono/");
        tablaMedicos.attachEvent("onRowSelect", function(fila, columna) {
            if (columna==0){ 
                var codigoPersona=tablaMedicos.cells(fila,1).getValue();
                var nombre=tablaMedicos.cells(fila,2).getValue();
                verCronogramaMedicoMensual(codigoPersona,nombre);  /////
            }
            else if (columna==2 || columna==3){ 
                var fecha = document.getElementById('hFecha').value;
                fecha = trimJunny(fecha);
                var cadena = tablaMedicos.cells(fila,4).getValue();
                // var Medico = tablaMedicos.cells(fila,2).getValue();
                clickCargaMedico('','',cadena);
                var opcionBusqueda = document.getElementById("hOpcionBusqueda").value;
                var servicio = document.getElementById("hServicio").value;
                var nombrecentrocosto = document.getElementById("hNombreCentroCosto").value;
                var codigoPersonalSalud = document.getElementById("hCodigoPersonalSalud").value;
                var sede = document.getElementById("hOpcionSede").value;
                $('selectVista').value='1';
                setCabeceraCronograma(fecha, opcionBusqueda, servicio, nombrecentrocosto, codigoPersonalSalud, sede);
            } 
        });   
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador = contadorCargador;
        tablaMedicos.attachEvent("onXLS", function() {
            cargadorpeche(1, idCargador);
        });
        tablaMedicos.attachEvent("onXLE", function() {
            cargadorpeche(0, idCargador);
        });
        /////////////fin cargador ///////////////////////
        tablaMedicos.setSkin("dhx_skyblue");
        tablaMedicos.enableMultiline(true);
        tablaMedicos.init();
        tablaMedicos.loadXML(pathRequestControl + '?' + parametros, function() {
            vcpt = 1;
        });
    }

    if (numero > 3 && vcpt == 1) {
        //alert('0')
        var palabra = $('txtNombreCPT').value;
        var arrayPalabras = new Array();
        arrayPalabras = palabra.split(" ");
        var numeroPalabras = arrayPalabras.length;
        tablaMedicos.filterBy(2, arrayPalabras[0]);
        for (var i = 1; i < numeroPalabras; i++) {
            tablaMedicos.filterBy(2, arrayPalabras[i], true);
        }
    }
}


/*
 function getMedicos(event,elemnt){
    patronModulo='buscarMedicos'
    apellidoPaterno=document.getElementById("txtApellidoPaterno").value;
    apellidoMaterno=document.getElementById("txtApellidoMaterno").value;
    nombres=document.getElementById("txtNombres").value;
    funcionMedicos=document.getElementById("hiddenFuncion").value;
    parametros='';

    parametros+='p1='+patronModulo;
    parametros+='&p2='+apellidoPaterno;
    parametros+='&p3='+apellidoMaterno;
    parametros+='&p4='+nombres;
    parametros+='&p5='+funcionMedicos;
    //recargarArbolCentroCostos();
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('divResultadoBusquedaMedicos').update(respuesta);
            

        }
    } )
}
 */
function getMedicosGeneral(event,elemnt){
    patronModulo='buscarMedicosGeneral'
    apellidoPaterno=document.getElementById("txtApellidoPaterno").value;
    apellidoMaterno=document.getElementById("txtApellidoMaterno").value;
    nombres=document.getElementById("txtNombres").value;
    funcionMedicos=document.getElementById("hiddenFuncion").value;
    parametros='';

    parametros+='p1='+patronModulo;
    parametros+='&p2='+apellidoPaterno;
    parametros+='&p3='+apellidoMaterno;
    parametros+='&p4='+nombres;
    parametros+='&p5='+funcionMedicos;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('divResultadoBusquedaMedicos').update(respuesta);

        }
    } )
}

function validaTxtNroDocBuscar(){
    selecTipoDoc     = "comboTipoDocumentos";
    txtNroDoc        = "nroDoc";
    indice           = $(selecTipoDoc).value;
    array_asociativo = new Array();
    array_asociativo['0001']=8;
    array_asociativo['0002']=8;
    array_asociativo['0003']=11;
    array_asociativo['0004']=15;
    array_asociativo['0005']=15;
    array_asociativo['0006']=0;
    array_asociativo['0007']=10;
    array_asociativo['0008']=9;
    array_asociativo['0009']=10;
    array_asociativo['0010']=10;
    array_asociativo['0011']=10;
    array_asociativo['0012']=10;
    array_asociativo['0013']=15;
    array_asociativo['0014']=10;
    array_asociativo['0015']=50;
    for(var i in array_asociativo){
        tipoDato=typeof array_asociativo[i];
        if(tipoDato=="number" && indice==i){
            $(txtNroDoc).value="";
            $(txtNroDoc).maxLength =array_asociativo[i];
            $(txtNroDoc).focus();
        }
    }
}

function buscarPersonas(){
   
    if(document.getElementById("txtOrden").value!='' && document.getElementById("txtOrden").value!='Buscar...' ){
        event='';
        elementoHTML=document.getElementById("txtOrden");
        getBuscarPersonas(event,elementoHTML,'01')
    }
    if(document.getElementById("txtCodigo").value!='' && document.getElementById("txtCodigo").value!='Buscar...' ){
        event='';
        elementoHTML=document.getElementById("txtCodigo");
        getBuscarPersonas(event,elementoHTML,'02')
    }
    if(document.getElementById("nroDoc").value!='' && document.getElementById("nroDoc").value!='Buscar...' ){
        event='';
        elementoHTML=document.getElementById("nroDoc");
        getBuscarPersonas(event,elementoHTML,'06')
    }

    if(document.getElementById("apellidoPaterno").value!=''||document.getElementById("apellidoMaterno").value!=''||document.getElementById("nombres").value!=''){
       
        event='';
        getBuscarPersonasNombre(event,'','');
    }
       
        
}

function verdatosMedicoCronogramaMensual(codigo){

    patronModulo='verdatosMedicoCronogramaMensual'
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+codigo;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuestas = transport.responseText;
            $('divDatosMedicoInformes').update(respuestas);
            $('divDatosMedicoInformes').show();
            $('divLeyendaCitasInformes').hide();
        }
    } )
}

function verificarConexionEssalud(){
    POO.Request({
        p1:'verificarConexionEssalud'
    },function(respuestajs){
        eval(respuestajs);
    });
    return;
}
 
function pintarDatosConexionEssalud(usuario1,conexion1,usuario2,conexion2,usuario3,conexion3,usuario4,conexion4){
    color1="red";
    color2="red";
    color3="red";
    color4="red";

    document.getElementById("txtUsuario1").value = usuario1;
    document.getElementById("txtUsuario2").value = usuario2;
    document.getElementById("txtUsuario3").value = usuario3;
    document.getElementById("txtUsuario4").value = usuario4;

    if(conexion1==1){
        color1="#88FFA6";
    }
    if(conexion2==1){
        color2="#88FFA6";
    }
    if(conexion3==1){
        color3="#88FFA6";
    }
    if(conexion4==1){
        color4="#88FFA6";
    }
    document.getElementById("txtConexion1").style.backgroundColor=color1;
    document.getElementById("txtConexion2").style.backgroundColor=color2;
    document.getElementById("txtConexion3").style.backgroundColor=color3;
    document.getElementById("txtConexion4").style.backgroundColor=color4;
/*
    document.getElementById("txtConexion1").value = conexion1;
    document.getElementById("txtConexion2").value = conexion2;
    document.getElementById("txtConexion3").value = conexion3;
    document.getElementById("txtConexion4").value = conexion4;*/
}


function getMedicosdhtmlx(event,elemnt){
    patronModulo='getMedicosdhtmlx'
    var apellidoPaterno=document.getElementById("txtApellidoPaterno").value;
    var apellidoMaterno=document.getElementById("txtApellidoMaterno").value;
    var nombres=document.getElementById("txtNombres").value;
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+apellidoPaterno;
    parametros+='&p3='+apellidoMaterno;
    parametros+='&p4='+nombres;

    MedicosGeneraldhtmlx=new dhtmlXGridObject('divResultadoBusquedaMedicos');
    MedicosGeneraldhtmlx.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    MedicosGeneraldhtmlx.setSkin("dhx_skyblue");
    MedicosGeneraldhtmlx.enableRowsHover(true,'grid_hover');
    MedicosGeneraldhtmlx.attachEvent("onRowSelect", function(rowId,cellInd){
        var parametroCadena = MedicosGeneraldhtmlx.cells(rowId,4).getValue();
        var Medico = MedicosGeneraldhtmlx.cells(rowId,1).getValue();
        clickCargaMedicoxCentroCostoProgramacionMedicos('','',parametroCadena);
        $('var1').value=Medico;
    });
    contadorCargador++;
    var idCargador=contadorCargador;
    MedicosGeneraldhtmlx.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    MedicosGeneraldhtmlx.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    /////////////fin cargador ///////////////////////
    MedicosGeneraldhtmlx.setSkin("dhx_skyblue");
    MedicosGeneraldhtmlx.init();
    MedicosGeneraldhtmlx.loadXML(pathRequestControl+'?'+parametros);
}

function validaServicionConProcedimiento(codigoservicio){
    var bEstadoBase;
    var patronModulo='validaServicionConProcedimiento';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+="&p2="+codigoservicio;

    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        asynchronous:false,  // Para que el ajax respete el orden de ejecucion
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargador),
        onComplete : function(transport){    
            cargadorpeche(0,idCargador);
            var respuesta = transport.responseText;
            //            $('divDetallePuntoControl').update(respuesta);
            bEstadoBase=parseInt(respuesta)
          
        }
    }
    )
        
    if( bEstadoBase==1){
        return 1;
    }else {
        return 0;
    }
}

function ventana_procedimientoNuevo(c_cod_ser_pro, codigoFiliacion) {
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
    var posFuncion = 'cargatablaProcedimiento';

    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)   
}