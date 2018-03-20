function cargarTablaIPs(){
    patronModulo='cargarTablaIPs';
    parametros='';
    parametros+='p1='+patronModulo; 
    arTablaIPs=new dhtmlXGridObject('contenedorTablaIP');
    arTablaIPs.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    arTablaIPs.setSkin("");
    arTablaIPs.enableRowsHover(true,'grid_hover');
    arTablaIPs.attachEvent("onRowSelect", function(rId,cInd){ 
        if (cInd==5){
            $('textID').value=arTablaIPs.cells(rId,0).getValue();   
            $('textIP').value=arTablaIPs.cells(rId,1).getValue();   
            $('textPC').value=arTablaIPs.cells(rId,2).getValue();   
            $('textAmbiente').value=arTablaIPs.cells(rId,3).getValue();   
            $('textIDAmbiente').value=arTablaIPs.cells(rId,4).getValue();
            $('buscar').show();
            $('guardar').hide();
            $('actualizar').show();
            $('nuevo').hide();
            $('textIP').disabled = false;
            $('textPC').disabled = false;
        }
        else if (cInd==6){
            var id = $('textID').value=arTablaIPs.cells(rId,0).getValue();
            if(confirm("Estas seguro de Elimar el Registro Seleccionado")){
                eliminarMantenimiento(id);
            }
        }
    }); 
    contadorCargador++;
    var idCargador=contadorCargador;
    arTablaIPs.attachEvent("onXLS", function(){
        cargadorpeche(0,idCargador);
    });
    arTablaIPs.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    arTablaIPs.init();
    arTablaIPs.loadXML(pathRequestControl+'?'+parametros);
}


function guardarMantenimientoIp(){
    var ip = $('textIP').value;
    var pc = $('textPC').value;
    var ambiente = $('textIDAmbiente').value;
    if (ip=='' || pc==''){
        alert('Debe completar los datos necesarios para el correcto Mantenimiento...');
    }else {
        var patronModulo='guardarMantenimientoIp';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+="&p2="+ip;    
        parametros+="&p3="+pc;  
        parametros+="&p4="+ambiente;  
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            parameters : parametros,
            onLoading : micargador(1),
            onComplete : function(transport){
                micargador(0);
                var respuesta = transport.responseText;
                cargarMantenimientoIP();
            }
        } 
        )
    }
}


function actualizarMantenimiento(){
    var id = $('textID').value;
    var ip = $('textIP').value;
    var pc = $('textPC').value;
    var ambiente = $('textIDAmbiente').value;
    if (ip=='' || pc==''){
        alert('Debe completar los datos necesarios para el correcto Mantenimiento...');
    }else {
        var patronModulo='actualizarMantenimiento';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+="&p2="+ip;    
        parametros+="&p3="+pc;  
        parametros+="&p4="+id;  
        parametros+="&p5="+ambiente;  
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            parameters : parametros,
            onLoading : micargador(1),
            onComplete : function(transport){
                micargador(0);
                var respuesta = transport.responseText;
                cargarMantenimientoIP();
            }
        } 
        )
    } 
}


function eliminarMantenimiento(id){
    var patronModulo='eliminarMantenimiento';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+="&p2="+id;    
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText;
            cargarMantenimientoIP();
        }
    } 
    )
}


function cargarTablaAmbientes(){
    patronModulo='cargarTablaAmbientes';
    parametros='';
    parametros+='p1='+patronModulo; 
    arTablaAmbientes=new dhtmlXGridObject('contenedorTablaAmbientes');
    arTablaAmbientes.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    arTablaAmbientes.setSkin("");
    arTablaAmbientes.enableRowsHover(true,'grid_hover');
    arTablaAmbientes.attachEvent("onRowSelect", function(rId,cInd){ 
        if (cInd==3){
            $('textIDAmbiente').value=arTablaAmbientes.cells(rId,0).getValue(); 
            $('textAmbiente').value=arTablaAmbientes.cells(rId,2).getValue(); 
        }
    }); 
    contadorCargador++;
    var idCargador=contadorCargador;
    arTablaAmbientes.attachEvent("onXLS", function(){
        cargadorpeche(0,idCargador);
    });
    arTablaAmbientes.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    arTablaAmbientes.init();
    arTablaAmbientes.loadXML(pathRequestControl+'?'+parametros);  
}
