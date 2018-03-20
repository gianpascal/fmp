/* 
 * 
 * 
 */
function cargar(){
    alert("Excelente");
}

function getBuscarPersonasReporte(event,elementoHTML,parametro){
    if(event==''){
        tecla=13;
    }else{
        tecla=event.keyCode
    }
    
    var  patronModulo = "getBuscarPersonasReporte";
    var funcion=document.getElementById("funcion").value;
    var editar=document.getElementById("heditar").value;
    var nro = trim(elementoHTML.value);
    var tipoDoc=document.getElementById("comboTipoDocumentos").value;
    if((tecla == 13 & nro.length>2)){
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+Base64.encode(nro);
        parametros+='&p3='+tipoDoc;
        parametros+='&p4='+parametro;
        parametros+='&p5='+funcion;
        parametros+='&p6='+editar;
        var dhtmlxGridBusquedaPersonasOpcionUno=new dhtmlXGridObject('divResultadoBusqueda');
        dhtmlxGridBusquedaPersonasOpcionUno.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
        dhtmlxGridBusquedaPersonasOpcionUno.setSkin("dhx_skyblue");
        dhtmlxGridBusquedaPersonasOpcionUno.enableRowsHover(true,'grid_hover');
        dhtmlxGridBusquedaPersonasOpcionUno.attachEvent("onRowSelect", function(rowId,cellInd){
            var c_cod_per = dhtmlxGridBusquedaPersonasOpcionUno.cells(rowId,0).getValue();
            if (cellInd==4){
                ventanaEditaPersona(c_cod_per);
            }else {
                cargarDetallePaquetePersona(c_cod_per);
            }
        });
        contadorCargador++;
        var idCargador=contadorCargador;
        dhtmlxGridBusquedaPersonasOpcionUno.attachEvent("onXLS", function(){
            cargadorpeche(1,idCargador);
        });
        dhtmlxGridBusquedaPersonasOpcionUno.attachEvent("onXLE", function(){
            cargadorpeche(0,idCargador);
        });
        /////////////fin cargador ///////////////////////
        dhtmlxGridBusquedaPersonasOpcionUno.setSkin("dhx_skyblue");
        dhtmlxGridBusquedaPersonasOpcionUno.init();
        dhtmlxGridBusquedaPersonasOpcionUno.loadXML(pathRequestControl+'?'+parametros);

      
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


function getBuscarPersonasNombreReporte(event,elemento,op){
    if(event==''){
        tecla=13;
    }else{
        tecla=event.keyCode
    }
    var valor=elemento.value;
    var apellidoPaterno=document.getElementById("apellidoPaterno").value;
    var apellidoMaterno=document.getElementById("apellidoMaterno").value;
    var nombres=document.getElementById("nombres").value;
    
    apellidoPaterno=dTrim(apellidoPaterno);
    apellidoMaterno=dTrim(apellidoMaterno);
    nombres=dTrim(nombres);
    var patronModulo = "getBuscarPersonasReporte";
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
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+Base64.encode(where);
        parametros+='&p3='+tipoDoc;
        parametros+='&p4='+parametro;
        parametros+='&p5='+funcion;
        parametros+='&p6='+editar;
        var dhtmlxGridBusquedaPersonasOpcionDos=new dhtmlXGridObject('divResultadoBusqueda');
        dhtmlxGridBusquedaPersonasOpcionDos.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
        dhtmlxGridBusquedaPersonasOpcionDos.setSkin("dhx_skyblue");
        dhtmlxGridBusquedaPersonasOpcionDos.enableRowsHover(true,'grid_hover');
        dhtmlxGridBusquedaPersonasOpcionDos.attachEvent("onRowSelect", function(rowId,cellInd){
            var c_cod_per = dhtmlxGridBusquedaPersonasOpcionDos.cells(rowId,0).getValue();
            if (cellInd==4){
                ventanaEditaPersona(c_cod_per);
            }else {
                cargarDetallePaquetePersona(c_cod_per);
            }
        });
        contadorCargador++;
        var idCargador=contadorCargador;
        dhtmlxGridBusquedaPersonasOpcionDos.attachEvent("onXLS", function(){
            cargadorpeche(1,idCargador);
        });
        dhtmlxGridBusquedaPersonasOpcionDos.attachEvent("onXLE", function(){
            cargadorpeche(0,idCargador);
        });
        /////////////fin cargador ///////////////////////
        dhtmlxGridBusquedaPersonasOpcionDos.setSkin("dhx_skyblue");
        dhtmlxGridBusquedaPersonasOpcionDos.init();
        dhtmlxGridBusquedaPersonasOpcionDos.loadXML(pathRequestControl+'?'+parametros);

    }
    limpiarCampos('03');
}


function buscarPersonasReporte(){
    if(document.getElementById("txtOrden").value!='' && document.getElementById("txtOrden").value!='Buscar...' ){
        event='';
        elementoHTML=document.getElementById("txtOrden");
        getBuscarPersonasReporte(event,elementoHTML,'01')
    }
    if(document.getElementById("txtCodigo").value!='' && document.getElementById("txtCodigo").value!='Buscar...' ){
        event='';
        elementoHTML=document.getElementById("txtCodigo");
        getBuscarPersonasReporte(event,elementoHTML,'02')
    }
    if(document.getElementById("nroDoc").value!='' && document.getElementById("nroDoc").value!='Buscar...' ){
        event='';
        elementoHTML=document.getElementById("nroDoc");
        getBuscarPersonasReporte(event,elementoHTML,'06')
    }
    if(document.getElementById("apellidoPaterno").value!=''||document.getElementById("apellidoMaterno").value!=''||document.getElementById("nombres").value!=''){
       
        event='';
        getBuscarPersonasNombreReporte(event,'','');
    }
       
        
}

function cargarDetallePaquetePersona(c_cod_per){
    var  patronModulo='MostrarCPTfaltantes'
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+c_cod_per;
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
            $('divContendorDetalleGrupoPaquete').update(respuesta);

        }
    })
}