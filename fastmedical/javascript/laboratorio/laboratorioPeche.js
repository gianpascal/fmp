
///Parte para Peches ///////

//creado por peche 04/07/2012
//creado por peche 04/07/2012

function obtenerTablaPuntosControl(){
    var patronModulo='tablaPuntosControl';
    var parametros='';
    parametros+='p1='+patronModulo;
    //parametros+='&p2='+codigoProgramacion;

    tablaPuntosControl=new dhtmlXGridObject('divResultadoPuntoControl');
    tablaPuntosControl.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaPuntosControl.setSkin("dhx_skyblue");
    tablaPuntosControl.enableRowsHover(true,'grid_hover');
    tablaPuntosControl.attachEvent("onRowSelect", function(rId,cInd){     
        var idPuntoControl=tablaPuntosControl.cells(rId,0).getValue();
        obtenerDetallePuntoControl(idPuntoControl);
    });  
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaPuntosControl.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaPuntosControl.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);;
    });
    /////////////fin cargador ///////////////////////
    tablaPuntosControl.setSkin("dhx_skyblue");
    tablaPuntosControl.init();
    tablaPuntosControl.loadXML(pathRequestControl+'?'+parametros,function(){
        var casa;
        for(i=0;i<tablaPuntosControl.getRowsNum();i++){
            casa = tablaPuntosControl.cells(i,2).getValue();
            if(casa=='1')
                tablaPuntosControl.setRowTextStyle(tablaPuntosControl.getRowId(i) ,'background-color:#C1E69D;color:black;border-top: 1px solid #DAEFC2;');
            else if(casa=='0')
                tablaPuntosControl.setRowTextStyle(tablaPuntosControl.getRowId(i) ,'background-color:#FFA66A;color:black;border-top: 1px solid #FFD7BB;');
        }
        //obtenerDetallePuntoControl(0);
        //agregarPuntoControl();
    });

}


function obtenerDetallePuntoControl(idPuntoControl){
    var patronModulo='obtenerDetallePuntoControl';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+="&p2="+idPuntoControl;
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
            $('divDetallePuntoControl').update(respuesta);
            $('btn_guardarPuntoControl').hide();
            $('btn_agregarPuntoControl').show();
            $('btn_habilitarFormularioPuntoControl').show();
            $('btn_cancelarPuntoControl').hide();
            cargarTablaUsuariosHabilitadosXPuntoControl();
            $('divAsignacionUsuariosXPuntosControl').show();
        }
    }
)
}
        


function habilitarFormularioPuntoControl(){
    // document.getElementById("txtIdPuntoControl").removeAttribute("readonly");
    document.getElementById("txtNombre").removeAttribute("readonly");
    document.getElementById("textAreaDescripcion").removeAttribute("readonly");
    document.getElementById("bEstado").disabled=false;
    $('btn_guardarPuntoControl').show();
    $('btn_agregarPuntoControl').hide();
    $('btn_habilitarFormularioPuntoControl').hide();
    $('btn_cancelarPuntoControl').show();
}   

function cancelarPuntoControl(){
    contenidoPuntoControl();
}    
      
      
function FiltrarPuntoControl(){
    var palabra=$('txtPuntoControlBusqueda').value;
    var arrayPalabras=new Array();
    arrayPalabras=palabra.split(" ");
    var numeroPalabras=arrayPalabras.length;
    tablaPuntosControl.filterBy(1,arrayPalabras[0]);
    for(var i=1; i<numeroPalabras; i++){
        tablaPuntosControl.filterBy(1,arrayPalabras[i],true);
    }
}

function guardarPuntoControl(){

    var idPuntoControl=$('txtIdPuntoControl').value;
    var nombreControl=$('txtNombre').value;
    var descripcionControl=$('textAreaDescripcion').value;
    var estadoControl=$('bEstado').value;
    if ($('bEstado').checked){
        estadoControl=1;
    }else {
        estadoControl=0; 
    }   
    var operacion=$("txtIdPuntoControl").value;
    if (operacion>0){
        var patronModulo='grabarDetallePuntoControl';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+="&p2="+idPuntoControl;
        parametros+="&p3="+nombreControl;
        parametros+="&p4="+descripcionControl;
        parametros+="&p5="+estadoControl;
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
                $('divDetallePuntoControl').update(respuesta);
                obtenerTablaPuntosControl();
            }
        } )
        $('btn_agregarPuntoControl').show();
        $('btn_habilitarFormularioPuntoControl').show();
        $('btn_guardarPuntoControl').hide();
        $('btn_cancelarPuntoControl').hide();
    }
    else {
        var patronModu='agregarDetallePuntoControl';
        var parametro='';
        parametro+='p1='+patronModu;
        parametro+="&p2="+idPuntoControl;
        parametro+="&p3="+nombreControl;
        parametro+="&p4="+descripcionControl;
        parametro+="&p5="+estadoControl;
        alert("Agregar");
         
        contadorCargador++;
        var idCargadoragregar=contadorCargador;
        new Ajax.Request( pathRequestControl,{
            method : 'get',
            asynchronous:false,  // Para que el ajax respete el orden de ejecucion
            parameters : parametro,
            onLoading : cargadorpeche(1,idCargadoragregar),
            onComplete : function(transport){
                cargadorpeche(0,idCargadoragregar);
                var respuesta = transport.responseText;
                $('divDetallePuntoControl').update(respuesta);
                obtenerTablaPuntosControl();
            }
        } )
    }
        
}     

function obtenerPersonasPuntoControl(){
    var fecha =$('textFecha').value
    var puntoControl =$('cboPuntoControl').value;
    var patronModulo='personasPorPuntoControl';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+puntoControl;
    parametros+='&p3='+fecha;
    
    tablaPersonaPuntoControl=new dhtmlXGridObject('divTablaProcesarPuntoControl');
    tablaPersonaPuntoControl.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaPersonaPuntoControl.setSkin("dhx_skyblue");
    tablaPersonaPuntoControl.enableRowsHover(true,'grid_hover');
    //**********************************
    var parax = "";
    parax="p1=cargarComboProcedenciaFiltro";
    var datosx=traerDataPrueba(parax);
    var filtroProcedencia=datosx[0];
    //    var filtroExamenesLab = "<input type='text' id='idFiltroExamenLab' style='width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarExamenesLab();\" />"; 
    var filtro1="<select id='comboProcedencia' type='text'></select>";
    var header = [,,,"#text_filter","#select_filter","#select_filter","#select_filter","#select_filter",filtroProcedencia,,"#select_filter",]; 
    tablaPersonaPuntoControl.attachHeader(header); 
    //**********************************
    tablaPersonaPuntoControl.attachEvent("onRowSelect", function(rId,cInd){     
        var idPuntoControl=tablaPuntosControl.cells(rId,0).getValue();
        obtenerDetallePuntoControl(idPuntoControl);
    });  
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaPersonaPuntoControl.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaPersonaPuntoControl.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
        var estado;
        var color;
        for(var i=0;i<tablaPersonaPuntoControl.getRowsNum();i++){
        
            //tablaEstadoExamenes.setRowTextStyle(tablaEstadoExamenes.getRowId(i) ,'background-color:'+color+';color:black;border-top: 1px solid #DAEFC2;');
            estado = tablaPersonaPuntoControl.cells(i,10).getValue();
            if(estado=='Por Procesar'){
                //tablaEstadoExamenes.setRowTextStyle(tablaEstadoExamenes.getRowId(i) ,'background-color:#84A9C9;color:black;border-top: 1px solid #DAEFC2;');
                tablaPersonaPuntoControl.setRowColor(i,"#ADE281");
            }
            if(estado=='Por Recibir'){
                //tablaEstadoExamenes.setRowTextStyle(tablaEstadoExamenes.getRowId(i) ,'background-color:#84A9C9;color:black;border-top: 1px solid #DAEFC2;');
                tablaPersonaPuntoControl.setRowColor(i,"#5DB2CD");
            }
       
            color = tablaPersonaPuntoControl.cells(i,9).getValue();
            //tablaEstadoExamenes.setRowTextStyle(tablaEstadoExamenes.getRowId(i) ,'background-color:'+color+';color:black;border-top: 1px solid #DAEFC2;');
       
            tablaPersonaPuntoControl.cells(i,8).setBgColor(color);
        
   
        
            //alert(color);
        }
    });
    /////////////fin cargador ///////////////////////
    tablaPersonaPuntoControl.setSkin("dhx_skyblue");
    tablaPersonaPuntoControl.init();
    tablaPersonaPuntoControl.loadXML(pathRequestControl+'?'+parametros,function(){
    });
}
function recibirPuntoControl(){
    var idPuntoControl=$('cboPuntoControl').value;
    var indice = $('cboPuntoControl').selectedIndex 
    var nombrePuntoControl = $('cboPuntoControl').options[indice].text 
    var posFuncion = "";
    var vtitle='';
    var vformname='POpadPuntoControl';
    var vwidth='550';
    var vheight='320'; 
    var patronModulo='verRecibirPuntoControl';
    var vcenter='t';
    var vresizable='';
    var vmodal='false';
    var vstyle='';
    var vopacity='';
    var veffect='';
    var vposx1='';
    var vposx2='';
    var vposy1='';
    var vposy2='';
    var parametros='';
    parametros+='p1='+patronModulo+'&p2='+idPuntoControl;
    parametros+='&p3='+nombrePuntoControl; 
    this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion); 
}
function procesarPuntocontrol(){
    var idPuntoControl=$('cboPuntoControl').value;
    var indice = $('cboPuntoControl').selectedIndex 
    var nombrePuntoControl = $('cboPuntoControl').options[indice].text 
    
    var posFuncion = "";
    var vtitle='';
    var vformname='POpadPuntoControl';
    var vwidth='550';
    var vheight='320';   
    var patronModulo='verProcesarPuntoControl';
    var vcenter='t';
    var vresizable='';
    var vmodal='false';
    var vstyle='';
    var vopacity='';
    var veffect='';
    var vposx1='';
    var vposx2='';
    var vposy1='';
    var vposy2='';
    var parametros='';
    parametros+='p1='+patronModulo+'&p2='+idPuntoControl;
    parametros+='&p3='+nombrePuntoControl; 
    this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion); 
}
function verificarRecibirPacientePuntoControl(opcion,evento){
    var tecla='';
    var ejecutar='no';
    if(opcion=='enter'){
        tecla=evento.keyCode
        if(tecla==13){
            ejecutar='si';
        }
    }
    if(opcion=='click'){
        ejecutar='si';
    }
    
    if(ejecutar=='si'){
        var codigoBarra=$('txtCodigoBarras').value;
        var patronModulo='verificarRecibirPuntoControl';
        var idPuntoControl=$('cboPuntoControl').value;
        var parametro='';
        parametro+='p1='+patronModulo;
        parametro+="&p2="+codigoBarra;
        parametro+="&p3="+idPuntoControl;
        
         
        contadorCargador++;
        var idCargadoragregar=contadorCargador;
        new Ajax.Request( pathRequestControl,{
            method : 'get',
            asynchronous:false,  // Para que el ajax respete el orden de ejecucion
            parameters : parametro,
            onLoading : cargadorpeche(1,idCargadoragregar),
            onComplete : function(transport){
                cargadorpeche(0,idCargadoragregar);
                var respuesta = transport.responseText;
                //alert(respuesta);
                var arrayRespuesta=respuesta.split("|*");
                if(arrayRespuesta[0]=='exito'){
                    siguientePasoPuntoControl(arrayRespuesta);
                }else{
                    alertaPuntoControlErroneo(arrayRespuesta);
                }
                
            }
        } )
    }
    
}
function alertaPuntoControlErroneo(arrayRespuesta){
    var fecha=arrayRespuesta[1];
    var nombre=arrayRespuesta[2];
    var afiliacion=arrayRespuesta[3];
    var examen=arrayRespuesta[4];
    var procedencia=arrayRespuesta[5];
    var ubicacion=arrayRespuesta[6];
    var estado=arrayRespuesta[7];
    
    
    var posFuncion = "seleccionarCerrar";
    var vtitle='';
    var vformname='alertaError';
    var vwidth='550';
    var vheight='320';   
    var patronModulo='alertaPuntoControlErroneo';
    var vcenter='t';
    var vresizable='';
    var vmodal='false';
    var vstyle='';
    var vopacity='';
    var veffect='';
    var vposx1='';
    var vposx2='';
    var vposy1='';
    var vposy2='';
    var parametros='';
    parametros+='p1='+patronModulo+'&p2='+fecha;
    parametros+='&p3='+nombre; 
    parametros+='&p4='+afiliacion; 
    parametros+='&p5='+examen; 
    parametros+='&p6='+procedencia; 
    parametros+='&p7='+ubicacion; 
    parametros+='&p8='+estado; 
    
    this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion); 
}
function seleccionarCerrar(){
    //alert('peche')
    $('cerrarVentanaError').focus();
    
}
function cerrarVentanaPeche(ventana,evento){
    
    var tecla=evento.keyCode
    if(tecla==13){
           
        Windows.close(ventana,'');
           
        $('txtCodigoBarras').select();
    }
}
function verificarProcesarPacientePuntoControl(opcion,evento){
    var tecla='';
    var ejecutar='no';
    if(opcion=='enter'){
        tecla=evento.keyCode
        if(tecla==13){
            ejecutar='si';
            $('txtCodigoBarras').select();
        }
    }
    if(opcion=='click'){
        ejecutar='si';
    }
    // $('txtCodigoBarras').select();
    
    if(ejecutar=='si'){
        var codigoBarra=$('txtCodigoBarras').value;
        var patronModulo='verificarProcesarPuntoControl';
        var idPuntoControl=$('cboPuntoControl').value;
        var parametro='';
        parametro+='p1='+patronModulo;
        parametro+="&p2="+codigoBarra;
        parametro+="&p3="+idPuntoControl;
        
         
        contadorCargador++;
        var idCargadoragregar=contadorCargador;
        new Ajax.Request( pathRequestControl,{
            method : 'get',
            asynchronous:false,  // Para que el ajax respete el orden de ejecucion
            parameters : parametro,
            onLoading : cargadorpeche(1,idCargadoragregar),
            onComplete : function(transport){
                cargadorpeche(0,idCargadoragregar);
                var respuesta = transport.responseText;
                //alert(respuesta);
                var arrayRespuesta=respuesta.split("|*");
                if(arrayRespuesta[0]=='exito'){
                    siguientePasoPuntoControl(arrayRespuesta);
                }else{
                    alertaPuntoControlErroneo(arrayRespuesta);
                }
                
            }
        } )
    }
}
function siguientePasoPuntoControl(arrayRespuesta){
    //alert('peche');
    var nombreExamen=arrayRespuesta[1];
    var nombrePaciente=arrayRespuesta[2];
    var fechaExamen=arrayRespuesta[3];
    var afiliacion=arrayRespuesta[4];
    var procedencia=arrayRespuesta[5];
    var idPacienteLaboratorio=arrayRespuesta[6];
    var codigoBarras=arrayRespuesta[7];
    var funcionCerrar='obtenerPersonasPuntoControl()';
    var posFuncion ="acordionHistorial";
    var vtitle="Historial del Examen";
    var vformname='historialExamen';
    var vwidth='800';
    var vheight='600';
    var patronModulo='historialExamen';
    var vcenter='t';
    var vresizable='';
    var vmodal='false';
    var vstyle='';
    var vopacity='';
    var veffect='';
    var vposx1='';
    var vposx2='';
    var vposy1='35';
    var vposy2=''; 
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+="&p2="+nombreExamen;
    parametros+="&p3="+nombrePaciente;
    parametros+="&p4="+fechaExamen;
    parametros+="&p5="+afiliacion;
    parametros+="&p6="+procedencia;
    parametros+="&p7="+idPacienteLaboratorio;
    parametros+="&p8="+codigoBarras;
    parametros+="&p9="+funcionCerrar;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

}


//////////////////
///Parte para Angel

function agregarPuntoControl(){
    document.getElementById("txtNombre").removeAttribute("readonly");
    document.getElementById("textAreaDescripcion").removeAttribute("readonly");
    document.getElementById("bEstado").disabled=false;
    $('txtNombre').clear();
    $('textAreaDescripcion').clear();
    $('txtIdPuntoControl').clear();
    $('btn_agregarPuntoControl').hide();
    $('btn_habilitarFormularioPuntoControl').hide();
    $('btn_guardarPuntoControl').show();
    $('btn_cancelarPuntoControl').show();
}
//aqui la parte de peche


//============================================================================================
////==========================================================================================
///parte para Lobo ///////
//============================================================================================
//============================================================================================
//function buscarPerfil(){
//    //alert("hola")
//    findLikeGoogle(document.getElementById('idFiltroPerfil').value,tablaPerfiles,2);  
//}
//
//
//function findLikeGoogle(palabra,tabla,campo){
//    var arrayPalabras=new Array();
//    arrayPalabras=palabra.split(" ");
//    var numeroPalabras=arrayPalabras.length;
//    tabla.filterBy(campo,arrayPalabras[0]);
//    for(var i=1; i<numeroPalabras; i++){
//        tabla.filterBy(campo,arrayPalabras[i],true);
//    }
//}
function buscarExamenesLaboratorio(){
    //    var nombreExamen=$("txtNombreExamen").value;
    var nombreExamen='%';
    //    if(nombreExamen.length ==0){
    var patronModulo='buscarExamenesLaboratorio';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+nombreExamen;

    tablaExamenesLaboratorio=new dhtmlXGridObject('div_TablaExamenes');
    tablaExamenesLaboratorio.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaExamenesLaboratorio.setSkin("dhx_skyblue");
    tablaExamenesLaboratorio.enableRowsHover(true,'grid_hover');
    //-----------------
    var filtroPeril = "<input type='text' id='txtNombreExamenfiltro' style='width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarExamenes();\" />"; 
    var header = ["#numeric_filter","#text_filter",filtroPeril];  
    tablaExamenesLaboratorio.attachHeader(header); 
    //--------------
    tablaExamenesLaboratorio.attachEvent("onRowSelect", function(fila,columna){
        reporteDePuntoControlXExamen(fila,columna);   
        
        $('div_MostrarMaterialesSeleccionadosXpuntoControlExamenLabo').innerHTML="";
        //        $('div_detalleMuestrasyLaboratorioxPuntodeControl1').innerHTML="";
        
        $('div_detalleMuestrasyLaboratorioxPuntodeControl1_prueba').innerHTML="";
        
        
        
        $('div_MostrarMuestrasSeleccionadosXpuntoControlExamenLabo').innerHTML="";
        
        
        
        
    });  
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaExamenesLaboratorio.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaExamenesLaboratorio.attachEvent("onXLE", function(){

        // $("txtNombreExamenfiltro").value=$("txtNombreExamen").value;
           
        cargadorpeche(0,idCargador);
            
    });
    /////////////fin cargador ///////////////////////
    tablaExamenesLaboratorio.setSkin("dhx_skyblue");
    tablaExamenesLaboratorio.init();
    tablaExamenesLaboratorio.loadXML(pathRequestControl+'?'+parametros);
    //    }
}
function buscarExamenes(){
    //    $("txtNombreExamenfiltro").value=$("txtNombreExamen").value;
    findLikeexamen(document.getElementById('txtNombreExamenfiltro').value,tablaExamenesLaboratorio,2);  
}
function findLikeexamen(palabra,tabla,campo){
    var arrayPalabras=new Array();
    arrayPalabras=palabra.split(" ");
    //    arrayPalabras=$("txtNombreExamen").value+arrayPalabras;
    //    $("txtNombreExamenfiltro").value=arrayPalabras;
    //    alert(arrayPalabras);
    var numeroPalabras=arrayPalabras.length;
    tabla.filterBy(campo,arrayPalabras[0]);
    for(var i=1; i<numeroPalabras; i++){
        tabla.filterBy(campo,arrayPalabras[i],true);
    }
}
//function cargarTablaPerfiles(){
//    var patronModulo='cargartablaPerfiles';
//    var parametros='';
//    parametros+='p1='+patronModulo;
//    //parametros+='&p2='+codigoProgramacion;
//    
//    
//    
//    tablaPerfiles=new dhtmlXGridObject('divTablaPerfilesLaboratorio');
//    tablaPerfiles.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
//    tablaPerfiles.setSkin("dhx_skyblue");
//    tablaPerfiles.enableRowsHover(true,'grid_hover');
//    var filtroPeril = "<input type='text' id='idFiltroPerfil' style='width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarPerfil();\" />"; 
//    var header = ["#numeric_filter","#text_filter",filtroPeril];  
//    tablaPerfiles.attachHeader(header); 
//    tablaPerfiles.attachEvent("onRowSelect", function(rowId,cellInd){
//        cargarTablaPerfilesExamenes();
//    //        switch(cellInd){
//    //            case 3:
//    //                cargarTablaPerfilesExamenes(tablaPerfiles.cells(rowId,0).getValue());
//    //                break;
//    //        }
//    });   
//       
//    // miTablaAntecedente.attachEvent("onRowSelect", agregarAntecedente);
//    //////////para cargador peche////////////////
//    contadorCargador++;
//    var idCargador=contadorCargador;
//    tablaPerfiles.attachEvent("onXLS", function(){
//        cargadorpeche(1,idCargador);
//    });
//    tablaPerfiles.attachEvent("onXLE", function(){
//        cargadorpeche(0,idCargador);
//    });
//    /////////////fin cargador ///////////////////////
//    tablaPerfiles.setSkin("dhx_skyblue");
//    tablaPerfiles.init();
//    tablaPerfiles.loadXML(pathRequestControl+'?'+parametros);
//    
//    
//}
function reporteDePuntoControlXExamen(fila,columna){
    $("div_agregarNuevoPuntoControl").show(); 
    $("div_agregarNuevoPuntoControlBoton").show(); 
    $("div_rangoFormato").hide(); 
    //    $("div_EnDesarrollo").hide(); 
    //    $("div_Produccion").hide();
    $("hfilaexamen").value=fila;
      
    var iIdExamenesLaboratorio=tablaExamenesLaboratorio.cells(fila,0).getValue();
    $("hiIdExamenesLaboratorio").value=iIdExamenesLaboratorio;
    $("hnombreExamen").value=tablaExamenesLaboratorio.cells(fila,2).getValue();
   
    
    var patronModulo='reporteDePuntoControlXExamen';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+iIdExamenesLaboratorio;

    tablaPuntoControl=new dhtmlXGridObject('div_TablaExamenesPuntoControl');
    tablaPuntoControl.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaPuntoControl.setSkin("dhx_skyblue");
    tablaPuntoControl.enableRowsHover(true,'grid_hover');
    tablaPuntoControl.attachEvent("onRowSelect", function(fila,columna){
        subirBajarSecuenciaPuntoControl(fila,columna);
        detalleMuestrayMaterialesEnPuntoControlExamenLaboratorio(fila,columna);
        
        
        $('div_MostrarMaterialesSeleccionadosXpuntoControlExamenLabo').innerHTML="";
        $('div_MostrarMuestrasSeleccionadosXpuntoControlExamenLabo').innerHTML="";
        

    });  
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaPuntoControl.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaPuntoControl.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaPuntoControl.setSkin("dhx_skyblue");
    tablaPuntoControl.init();
    tablaPuntoControl.loadXML(pathRequestControl+'?'+parametros, function(){
        
        probando();
        
    });


    //alert(tablaPuntoControl.getRowsNum());
}

//creado x JCQA 9 AGOSTO 2012


function probando(){
    
    for(i=0;i<tablaPuntoControl.getRowsNum();i++){
        //      tablaPuntoControl.cells(i,10).setValue('<input type="text" onClick="probando1()"; id="pruebaJC"/>');
        //      tablaPuntoControl.cells(i,10).setValue('<select onchange="probando1()" id="Sexoxxx"><option value="1">Hombre</option><option value="2">Mujer</option></select> ');
        //       tablaPuntoControl.cells(i,10).setValue('<input onclick= "probando1()" type="radio" name="grupo1" value="1">Opcion 1 <br><input type="radio" name="grupo1" value="2">Opcion 2 <br><input type="radio" name="grupo1" value="3">Opcion 3 <br>');
        //        tablaPuntoControl.cells(i,7).setValue('<input onclick= "probando1()" type="radio" name="grupo2" value="1">Opcion 1 <br><input type="radio" name="grupo1" value="2">Opcion 2 <br><input type="radio" name="grupo1" value="3">Opcion 3 <br>');
      
        var Muestra= tablaPuntoControl.cells(i,4).getValue();
        var Recibir=tablaPuntoControl.cells(i,5).getValue();
        var Boton=tablaPuntoControl.cells(i,6).getValue();
           
        //              document.getElementById('chkRecibir'+i).value=Recibir;
               
               
       
       
        tablaPuntoControl.cells(i,10).setValue('<input id="cboMuestra'+i+'" onclick= "if(this.checked){this.value=1}else{this.value=0;};seleccionandoMuestraxPuntoControl('+i+')" type="radio" title="Asignar" name="grupoMuestra" value="0">');
        //        document.getElementById('cboMuestra'+i).value=Muestra;
        if(Muestra==1){
            document.getElementById('cboMuestra'+i).checked=true;
            document.getElementById('cboMuestra'+i).value=1;
                    
        }
        else{
            document.getElementById('cboMuestra'+i).checked=false;
            document.getElementById('cboMuestra'+i).value=0;
        }
        
        
        tablaPuntoControl.cells(i,13).setValue('<input id="chkRecibir'+i+'" onclick= "if(this.checked){this.value=1}else{this.value=0;};seleccionandoPuntoControlRecibir('+i+');" type="checkbox" title="Recibir Muestra" name="chkRecibir'+i+'" value="0">');
            
        if(Recibir==1){
            document.getElementById('chkRecibir'+i).checked=true;
            document.getElementById('chkRecibir'+i).value=1;
                    
        }
        else{
            document.getElementById('chkRecibir'+i).checked=false;
            document.getElementById('chkRecibir'+i).value=0;
        }
        
        tablaPuntoControl.cells(i,14).setValue('<input id="chkBoton'+i+'" onclick= "if(this.checked){this.value=1}else{this.value=0;};agregarPuntoControlBoton('+i+');" type="checkbox" title="Recibir Muestra" name="chkRecibir'+i+'" value="0">');
        if(Boton==1){
            document.getElementById('chkBoton'+i).checked=true;
            document.getElementById('chkBoton'+i).value=1;
                    
        }
        else{
            document.getElementById('chkBoton'+i).checked=false;
            document.getElementById('chkBoton'+i).value=0;
        }
        //    <input type="checkbox" name="chkEstado" id="chkEstado" disabled="true" onclick="if(this.checked){this.value=1}else{this.value=0;}" value="0">
    
    
    }

}
function agregarPuntoControlBoton(i){
    var hidPuntoControlExamenLaboratorio=tablaPuntoControl.cells(i,2).getValue();
    var mensaje;   
    var estadoBoton= document.getElementById('chkBoton'+i).value;
    if(estadoBoton==0){
        mensaje='Esta Seguro que Desea Desactivar';
    }else {
        mensaje='Esta Seguro que Desea Activar';
    }
    
    if(window.confirm(mensaje)){    
        var patronModulo='agregarPuntoControlBoton';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+hidPuntoControlExamenLaboratorio;
        parametros+='&p3='+estadoBoton;
        var destino="";
        
         
        contadorCargador++;
        var idCargador=contadorCargador;
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            asynchronous:false,
            parameters : parametros,
            onLoading : cargadorpeche(1,idCargador),
            onComplete : function(transport){
                cargadorpeche(0,idCargador);
                var respuesta = transport.responseText;
                if(destino!="") $(destino).update(respuesta);                         
            }
        }		
    )    
    } 
}
function  detalleMuestrayMaterialesEnPuntoControlExamenLaboratorio(fila,columna){
    
    if(columna == 11) {
        
        $("div_rangoFormato").hide(); 
        
        var Muestra = document.getElementById('cboMuestra'+fila).value;
           
        //muestra Detalle de Materiales + Muestras x Punto Control x ExamenLaboratorio
        var patronModulo='detalleMuestrayMaterialesEnPuntoControlExamenLaboratorio';
        var parametros='';
        parametros+='p1='+patronModulo;
        
        var destino="div_detalleMuestrasyLaboratorioxPuntodeControl1_prueba";//modificado
        contadorCargador++;
        var idCargador=contadorCargador;
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            asynchronous:false,
            parameters : parametros,
            onLoading : cargadorpeche(1,idCargador),
            onComplete : function(transport){
                cargadorpeche(0,idCargador);
                var respuesta = transport.responseText;
                if(destino!="") $(destino).update(respuesta);
                //alert(Muestra);
                if(Muestra==1){
                    
                    $('div_DetalleMuestrasxPuntoControlLaboratorio').show();
                    
                   
         
                }
            }
        }
		
    )
    		
		
    }//fin de if
    
    
}

function seleccionandoMuestraxPuntoControl(fila){
    //alert(fila);
    var hidPuntoControlExamenLaboratorio=tablaPuntoControl.cells(fila,2).getValue();
    //    alert(hidPuntoControlExamenLaboratorio_muestra)
    //    alert('hidPuntoControlExamenLab'+hidPuntoControlExamenLaboratorio_muestra);
    //    tablaPuntoControl.selectRow(2, true, true, true);
    if(window.confirm("¿Está seguro que desea asignar 'TOMA DE MUESTRA'  al punto de control seleccionado?")){
     
        //var hidPuntoControlExamenLaboratorio_muestra=$('hidPuntoControlExamenLaboratorio_muestra').value;
        // alert('hidPuntoControlExamenLaboratorio_muestra'+hidPuntoControlExamenLaboratorio_muestra);
        // tablaPuntoControl.selectRow(tablaPuntoControl.getRowId(i), true, true, true);
        
        //        parametros='';
        //        parametros+='p1=seleccionandoMuestraxPuntoControl';
        //        parametros+='&p2='+hidPuntoControlExamenLaboratorio;
        //      
        //        var datosx=traerDataPrueba(parametros);
        
        var patronModulo='seleccionandoMuestraxPuntoControl';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+hidPuntoControlExamenLaboratorio;
        var destino="";
        
         
        contadorCargador++;
        var idCargador=contadorCargador;
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            asynchronous:false,
            parameters : parametros,
            onLoading : cargadorpeche(1,idCargador),
            onComplete : function(transport){
                cargadorpeche(0,idCargador);
                var respuesta = transport.responseText;
                if(destino!="") $(destino).update(respuesta);              
                
            }
        }
		
    )
        
  
    }
        
}
  
  
function seleccionandoPuntoControlRecibir(fila){
    
    var hidPuntoControlExamenLaboratorio=tablaPuntoControl.cells(fila,2).getValue();
    //    alert(hidPuntoControlExamenLaboratorio);

    //    var b=$("chbRecibir").value;
    //    var idRowSeleccionado =tablaPuntoControl.getSelectedId();
    //    alert(idRowSeleccionado);
    
    var estadoRecibir= document.getElementById('chkRecibir'+fila).value;
    //    alert('chkRecibir'+fila+':'+estadoRecibir);
    
    if(window.confirm("¿Está seguro que desea asignar 'RECIBIR' al punto de control seleccionado?")){
     
        //        var hidPuntoControlExamenLaboratorio_muestra=$('hidPuntoControlExamenLaboratorio_muestra').value;
        //        alert('hidPuntoControlExamenLaboratorio_muestra'+hidPuntoControlExamenLaboratorio);
        
        //        parametros='';
        //        parametros+='p1=seleccionandoPuntoControlRecibir';
        //        parametros+='&p2='+hidPuntoControlExamenLaboratorio;
        //        parametros+='&p3='+estadoRecibir;
        //        var datosx=traerDataPrueba(parametros);
        
        var patronModulo='seleccionandoPuntoControlRecibir';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+hidPuntoControlExamenLaboratorio;
        parametros+='&p3='+estadoRecibir;
        var destino="";
        
         
        contadorCargador++;
        var idCargador=contadorCargador;
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            asynchronous:false,
            parameters : parametros,
            onLoading : cargadorpeche(1,idCargador),
            onComplete : function(transport){
                cargadorpeche(0,idCargador);
                var respuesta = transport.responseText;
                if(destino!="") $(destino).update(respuesta);                         
            }
        }		
    )    
    }  
}
  


function subirBajarSecuenciaPuntoControl(fila,columna){
    var iNivelInicial=tablaPuntoControl.cells(fila,0).getValue();
   
    var iNivelFinal=0;
    var idPuntoControlExamenLab=tablaPuntoControl.cells(fila,2).getValue();
    var nombrePuntoControl=tablaPuntoControl.cells(fila,3).getValue();
    $("hnombrePuntoControl").value= nombrePuntoControl;
    var nombreExamen=$("hnombreExamen").value; 
    var iUltimafila=tablaPuntoControl.cells(fila,6).getValue();    
    var iIdExamenesLaboratorio=$("hiIdExamenesLaboratorio").value;
    $("hidPuntoControlExamenLab").value=idPuntoControlExamenLab;
    $("hfilaPuntoControl").value=fila;
    $("hcolumnaPuntoControl").value=columna;
    
    if(columna==8 && fila !=0){ //subir
        alert('subir');
        iNivelFinal=parseInt(iNivelInicial)-1;
        
        var patronModulo='subirBajarSecuenciaPuntoControl';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+iIdExamenesLaboratorio;
        parametros+='&p3='+iNivelInicial;
        parametros+='&p4='+iNivelFinal;
        parametros+='&p5='+idPuntoControlExamenLab;
        
        contadorCargador++;
        var idCargador=contadorCargador;
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            asynchronous:false,
            parameters : parametros,
            onLoading : cargadorpeche(1,idCargador),
            onComplete : function(transport){
                cargadorpeche(0,idCargador);
                var respuesta = transport.responseText;
                //            $('Contenido').update(respuesta);
                var fila= $("hfilaexamen").value;
                reporteDePuntoControlXExamen(fila,0); 
            }
        })
    }
    ////////////////////////////////////////////////////////////////////////////////////
    if(columna==7 && fila!=iUltimafila-1){ // bajar
        alert('bajar');
        iNivelFinal=parseInt(iNivelInicial)+1;
        var patronModulo='subirBajarSecuenciaPuntoControl';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+iIdExamenesLaboratorio;
        parametros+='&p3='+iNivelInicial;
        parametros+='&p4='+iNivelFinal;
        parametros+='&p5='+idPuntoControlExamenLab;
        contadorCargador++;
        var idCargador=contadorCargador;
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            asynchronous:false,
            parameters : parametros,
            onLoading : cargadorpeche(1,idCargador),
            onComplete : function(transport){
                cargadorpeche(0,idCargador);
                var respuesta = transport.responseText;
                //            $('Contenido').update(respuesta);
                var fila= $("hfilaexamen").value;
                reporteDePuntoControlXExamen(fila,0); 
            }
        })
    }
    
    if(!(columna==6 && fila !=0)&&!(columna==7 && fila!=iUltimafila-1)&& (columna==3 || columna==0 ) && columna!=4){
        if($("hindicardorOcultar").value==''){
            $("hindicardorOcultar").value=0;
        }
        $("div_rangoFormato").show(); 
        var patronModulo='grupoDePuntoControl';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+idPuntoControlExamenLab;
        parametros+='&p3='+nombrePuntoControl;
        parametros+='&p4='+nombreExamen;
        var destino="div_rangoFormato";

        contadorCargador++;
        var idCargador=contadorCargador;
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            asynchronous:false,
            parameters : parametros,
            onLoading : cargadorpeche(1,idCargador),
            onComplete : function(transport){
                cargadorpeche(0,idCargador);
                var respuesta = transport.responseText;
                if(destino!="") $(destino).update(respuesta);              
                mostrarDesarrolloYproduccion();
                
                /////////agregado//////////////////
                
                $('div_MostrarMaterialesSeleccionadosXpuntoControlExamenLabo').innerHTML="";
                //        $('div_detalleMuestrasyLaboratorioxPuntodeControl1').innerHTML="";
        
                $('div_detalleMuestrasyLaboratorioxPuntodeControl1_prueba').innerHTML="";
        
        
        
                $('div_MostrarMuestrasSeleccionadosXpuntoControlExamenLabo').innerHTML="";
                
                ///////fin agregado////////////////
                
            }
        })
    }

    if(columna==12){
       
       
        var patronModulo='eliminarPuntosControl';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+idPuntoControlExamenLab;   
        var destino="";

        contadorCargador++;
        var idCargador=contadorCargador;
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            asynchronous:false,
            parameters : parametros,
            onLoading : cargadorpeche(1,idCargador),
            onComplete : function(transport){
                cargadorpeche(0,idCargador);
                var respuesta = transport.responseText;
               
                if(respuesta==1){
                    alert("No se Puede Eliminar El Proceso, se encuentra activos Paciente");
                }else{
                    var fila= $("hfilaexamen").value;             
                    reporteDePuntoControlXExamen(fila,0); 
                }
            }
        })

    }
}

function mostrarDesarrolloYproduccion(){

    $("div_Produccion").show(); 
    $("div_EnDesarrollo").hide();
    $("div_mostrarTablasExamenYpuntoControl").hide();
    
    var m= $("hindicardorOcultar").value
    var cantidadFinasGrupos=$("hcantidadFinas").value;
    if(m==0){
        document.getElementById('div_barrraDesplazante').style.height =250;
        
        for(var i=0;i<cantidadFinasGrupos;i++){
            $("div_grupoDatosEditar"+i).hide();
            $("div_grupoDatosBotonGuardar"+i).hide();
            var cantidadDeDatos=$("hicantidadDatos"+i).value
            for(var j=0;j<cantidadDeDatos;j++){
                $("div_GuardarDatosPuntoControl"+i+j).hide(); 
                $("div_EditarCombo"+i+j).hide(); 
            }
        } 
    }else{
        document.getElementById('div_barrraDesplazante').style.height =500;
        $("div_mostrarTablasExamenYpuntoControl").show();
        
        for(var i=0;i<cantidadFinasGrupos;i++){
            $("div_grupoDatosEditar"+i).hide();
            $("div_grupoDatosBotonGuardar"+i).hide();
            var cantidadDeDatos=$("hicantidadDatos"+i).value
            for(var j=0;j<cantidadDeDatos;j++){
                $("div_GuardarDatosPuntoControl"+i+j).hide(); 
                $("div_EditarCombo"+i+j).hide(); 
            }
        } 
    }
 
}

function desarrollo(){

    $("div_EnDesarrollo").show(); 
    $("div_Produccion").hide();
    
    var parametros='';
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargador),
        onComplete : function(transport){
            cargadorpeche(0,idCargador);          
            desarrolloeditar();    
        }
    })
}
function desarrolloeditar(){
    
    var cantidadFinas=$("hcantidadFinas").value;
    for(var i=0;i<cantidadFinas;i++){
        $("div_grupoDatosEditar"+i).hide();
        $("div_grupoDatosBotonGuardar"+i).hide();
    }
}
function produccion(){

    $("div_EnDesarrollo").hide(); 
    $("div_Produccion").show();    
}
function agregarNuevoPuntoControl(){
    var iIdExamenesLaboratorio=$("hiIdExamenesLaboratorio").value;
    posFuncion = "reportePuntoControl";
    vtitle='';
    vformname='POpadPuntoControl';
    vwidth='550';
    vheight='320';
    //'nuevaSubArea' llama al control y luego al actionRRHH y carga la vista vGuardarArea
    patronModulo='agregarNuevoPuntoControl';
    vcenter='t';
    vresizable='';
    vmodal='false';
    vstyle='';
    vopacity='';
    veffect='';
    vposx1='';
    vposx2='';
    vposy1='';
    vposy2='';
    parametros='';
    parametros+='p1='+patronModulo+'&p2='+iIdExamenesLaboratorio;
    this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion); 

}

function reportePuntoControl(){

    var iIdExamenesLaboratorio =$("hiIdExamenesLaboratorio").value 
    var patronModulo='reporteDePuntoControl';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+iIdExamenesLaboratorio;
  
    tablaPuntoControl=new dhtmlXGridObject('div_ReportePuntoControl');
    tablaPuntoControl.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaPuntoControl.setSkin("dhx_skyblue");
    tablaPuntoControl.enableRowsHover(true,'grid_hover');
    tablaPuntoControl.attachEvent("onRowSelect", function(fila,columna){
        seleccionarPuntoControl(fila,columna);
    });  
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaPuntoControl.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaPuntoControl.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);;
    });
    /////////////fin cargador ///////////////////////
    tablaPuntoControl.setSkin("dhx_skyblue");
    tablaPuntoControl.init();
    tablaPuntoControl.loadXML(pathRequestControl+'?'+parametros);
}
function seleccionarPuntoControl(fila,columna){
    var iIdpuntoControl=tablaPuntoControl.cells(fila,0).getValue();
    $("hiIdpuntoControl").value =iIdpuntoControl;
}

function guardarNuevoPuntoControl(){
    var iIdExamenesLaboratorio =$("hiIdExamenesLaboratorio").value
    var iIdpuntoControl =$("hiIdpuntoControl").value;
    var maximaSecuencia=$("hMaximaSecuencia").value;
    var patronModulo='guardarNuevoPuntoControl';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+iIdExamenesLaboratorio;
    parametros+='&p3='+iIdpuntoControl;
    parametros+='&p4='+maximaSecuencia;
    
    if(iIdpuntoControl!=''){
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
                //            $('Contenido').update(respuesta);
                Windows.close("Div_POpadPuntoControl");
                var fila= $("hfilaexamen").value;
                reporteDePuntoControlXExamen(fila,0);
                // buscarExamenesLaboratorio();
            }
        } )
    }else {
        alert("SELECCIONES UN CONTROL");
    }
}

function popapParaCrearNuevoGrupo(){
    //    var iIdExamenesLaboratorio=$("hiIdExamenesLaboratorio").value;
    posFuncion = "";
    vtitle='';
    vformname='POpadPuntoControl';
    vwidth='380';
    vheight='180';
    patronModulo='popapParaCrearNuevoGrupo';
    vcenter='t';
    vresizable='';
    vmodal='false';
    vstyle='';
    vopacity='';
    veffect='';
    vposx1='';
    vposx2='';
    vposy1='';
    vposy2='';
    parametros='';
    parametros+='p1='+patronModulo;//+'&p2='+iIdExamenesLaboratorio;
    this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion); 

}
function agregarNuevoGrupo(){
    var idPuntoControlExamenLab=$("hidPuntoControlExamenLab").value;
    var iEstadoVersicion=$("hiEstadoVersicion").value;
    var nombreGrupo=$("txtNombreGrupo").value;
    
    var patronModulo='agregarNuevoGrupo';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idPuntoControlExamenLab;
    parametros+='&p3='+iEstadoVersicion;
    parametros+='&p4='+nombreGrupo;
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargador),
        onComplete : function(transport){
            cargadorpeche(0,idCargador); 
            cerrarVentanacrearGrupo();
        }
    })
}
function cerrarVentanacrearGrupo(){
    Windows.close("Div_POpadPuntoControl");
    var filax=  $("hfilaPuntoControl").value;
    var columnax= $("hcolumnaPuntoControl").value;
       
    var patronModulo='';
    var parametros='';
    parametros+='p1='+patronModulo;
 
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargador),
        onComplete : function(transport){
            cargadorpeche(0,idCargador); 
            subirBajarSecuenciaPuntoControl(filax,columnax);
            $("div_rangoFormato").show(); 
            $("div_Produccion").hide(); 
            $("div_EnDesarrollo").show();
            var cantidadFinas=$("hcantidadFinas").value;
            for(var i=0;i<cantidadFinas;i++){
                $("div_grupoDatosEditar"+i).hide();
                $("div_grupoDatosBotonGuardar"+i).hide();
            }
            
            //            var m= $("hindicardorOcultar").value
            //            if(m==0){
            //                document.getElementById('div_barrraDesplazante').style.height =250; 
            //            }else{
            //                document.getElementById('div_barrraDesplazante').style.height =520; 
            //            }
             
        }
    })
    
}

function editarGrupoDatos(fila){
    
    $("div_grupoDatosEditar"+fila).show();
    $("div_grupoDatosBotonGuardar"+fila).show();
    $("div_grupoDatos"+fila).hide();
    $("div_grupoDatosBoton"+fila).hide();  
}  

function guardarModificadoGrupoDatos(fila){
    var nombreGrupoDatosEditar=$("nombreGrupoDatosEditar"+fila).value;
    var idGrupoDatos=$("idGrupoDatos"+fila).value;
    var filax=  $("hfilaPuntoControl").value;
    var columnax= $("hcolumnaPuntoControl").value;
    
    var patronModulo='guardarModificadoGrupoDatos';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+nombreGrupoDatosEditar;
    parametros+='&p3='+idGrupoDatos;
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargador),
        onComplete : function(transport){
            cargadorpeche(0,idCargador); 
            subirBajarSecuenciaPuntoControl(filax,columnax);
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////          
            $("div_rangoFormato").show(); 
            $("div_Produccion").hide(); 
            $("div_EnDesarrollo").show();
            $("div_grupoDatos"+fila).show();
            $("div_grupoDatosBoton"+fila).show();      
            var cantidadFinas=$("hcantidadFinas").value;
            for(var i=0;i<cantidadFinas;i++){
                $("div_grupoDatosEditar"+i).hide();
                $("div_grupoDatosBotonGuardar"+i).hide();
            }

        }
    })   
}
function eliminarGrupoDatos(fila){
    var idGrupoDatos=$("idGrupoDatos"+fila).value;
    var filax=  $("hfilaPuntoControl").value;
    var columnax= $("hcolumnaPuntoControl").value;
    
    var patronModulo='eliminarGrupoDatos';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idGrupoDatos;
    contadorCargador++;
    var idCargador=contadorCargador;
    if(confirm("Seguro que desea eliminar el Grupo")){
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            asynchronous:false,
            parameters : parametros,
            onLoading : cargadorpeche(1,idCargador),
            onComplete : function(transport){
                cargadorpeche(0,idCargador); 
                subirBajarSecuenciaPuntoControl(filax,columnax);            
                $("div_rangoFormato").show(); 
                $("div_Produccion").hide(); 
                $("div_EnDesarrollo").show();
                $("div_grupoDatos"+fila).show();
                $("div_grupoDatosBoton"+fila).show();      
                var cantidadFinas=$("hcantidadFinas").value;
                for(var i=0;i<cantidadFinas;i++){
                    $("div_grupoDatosEditar"+i).hide();
                    $("div_grupoDatosBotonGuardar"+i).hide();
                }
      
            }
        })
    }
}

function ocultarTablasExamenYpuntoControl(){

    if($("hindicardorOcultar").value!=''){     
        $("div_ExamenPuntoControl").hide();
        $("div_mostrarTablasExamenYpuntoControl").show();
        $("div_ocultarTablasExamenYpuntoControl").hide();
        document.getElementById('div_barrraDesplazante').style.height =500;
        $("hindicardorOcultar").value= 1
    }

}

function mostrarTablasExamenYpuntoControl(){
    if($("hindicardorOcultar").value==1){ 
        $("div_ExamenPuntoControl").show();
        $("div_ocultarTablasExamenYpuntoControl").show();
        $("div_mostrarTablasExamenYpuntoControl").hide();
        document.getElementById('div_barrraDesplazante').style.height =250;
        $("hindicardorOcultar").value= 0
    }
}

function guardarDatosPuntoControlGuardar(fila,idGrupoDatos){
    var b1= $("div_barrraDesplazante").scrollTop;
    var idGrupoDatos=$("idGrupoDatos"+fila).value;

    var idTipoDatos=$("cboTipoDatosGuardar"+fila).value;
    var idUnidadDeMedida=$("cboUnidadDeMedidax"+fila).value;
    var filaexamen=$("hfilaexamenGuardar"+fila).value;
    var idVisible= document.getElementById("checkTipoUnidadDeMedida"+fila).checked;
    var idObligatorio= document.getElementById("checkObligatorio"+fila).checked;
    if(idVisible==true){
        idVisible=1;
    }
    else{
        idVisible=0; 
    }
    if(idObligatorio==true){
        idObligatorio=1;
    }else{
        idObligatorio=0; 
    }
    filaexamen=  str_replace ("%", "00100101", filaexamen);
    var patronModulo='guardarDatosPuntoControl';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idGrupoDatos;
    parametros+='&p3='+idTipoDatos;
    parametros+='&p4='+idUnidadDeMedida;
    parametros+='&p5='+filaexamen;
    parametros+='&p6='+idVisible;
    parametros+='&p7='+idObligatorio;
    if(idTipoDatos!='' && filaexamen!=''){
        contadorCargador++;
        var idCargador=contadorCargador;
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            asynchronous:false,
            parameters : parametros,
            onLoading : cargadorpeche(1,idCargador),
            onComplete : function(transport){
                cargadorpeche(0,idCargador); 
                refrescarventanaRango();
                
                document.getElementById('div_barrraDesplazante').scrollTop =b1;
            }
        }) 
    }else {
        alert("Seleccionar Tipo De Datos o Nombre Dato");
    }
}

function cargarComboUnidadMedidaGuardar(filak){
    
    var tipoUnidadDeMedida=$("cboTipoUnidadDeMedidaGuardar"+filak).value;
    $("div_UnidaMedida_InicioGuardar"+filak).hide(); 
    var patronModulo='cargarComboUnidadMedidaGuardar';

    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+tipoUnidadDeMedida;
    parametros+='&p3='+filak;

    var destino="div_UnidaMedidaGuardar"+filak;
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargador),
        onComplete : function(transport){
            cargadorpeche(0,idCargador);
            var respuesta = transport.responseText;
            if(destino!="") $(destino).update(respuesta);              
 
        }
    })
}

function editarRango(filak, filay,filax){
    var idRango=$("hidRango"+filak+filay+filax).value; 
    var edadMinima=$("hiedadMinima"+filak+filay+filax).value; 
    var edadMaximo=$("hiedadMaximo"+filak+filay+filax).value; 
    var sexo=$("hSexo"+filak+filay+filax).value; 
    var sexoTexto=$("hSexoTexto"+filak+filay+filax).value; 
    var valorMinima=$("hiValorMinima"+filak+filay+filax).value; 
    var valorMaximo=$("hiValorMaximo"+filak+filay+filax).value; 
    var significado=$("hSignificado"+filak+filay+filax).value; 
    var nombreGrupo=$("nombreGrupoDatosEditar"+filak).value;
    var nombreDatos=$("txtNombreDatos"+filak+filay).value; 
    var idDatosPuntoControl=$("hIdDatosPuntoControl"+filak+filay).value;
    
    var bMaximoEdadInfinito=$("hbMaximoEdadInfinito"+filak+filay+filax).value;
    var bRangoInfinitoPositivo=$("hbRangoInfinitoPositivo"+filak+filay+filax).value;
    var bRangoInfinitoNegativo=$("hbRangoInfinitoNegativo"+filak+filay+filax).value;
  
    var tipoDatos=$("cboTipoDatos"+filak+filay).value;
    var estadoEdad=$("hEstadoEdad"+filak+filay+filax).value; 
    var estadoSexo=$("hEstadoSexo"+filak+filay+filax).value; 
    var idGrupoDatos=$("idGrupoDatos"+filak).value;  
    var idPuntoControlExamenLab=$("hidPuntoControlExamenLab").value; 
    var nombreTipoDatos=$("cboTipoDatos"+filak+filay).options[$("cboTipoDatos"+filak+filay).selectedIndex].text;

    if(tipoDatos==7 || tipoDatos==2){
        alert("No hay Formato");
    }else{
        posFuncion = "ocultarYpresentarTipoDatos_Div("+tipoDatos+","+estadoSexo+","+estadoEdad+","+bMaximoEdadInfinito+","+ bRangoInfinitoPositivo+","+ bRangoInfinitoNegativo+")";
        vtitle='';
        vformname='POpaEditarRango';
        vwidth='580';
        vheight='380';
 
        patronModulo='popapEditarRango';
        vcenter='t';
        vresizable='';
        vmodal='false';
        vstyle='';
        vopacity='';
        veffect='';
        vposx1='';
        vposx2='';
        vposy1='';
        vposy2='';
        parametros='';
        parametros+='p1='+patronModulo+'&p2='+idRango+'&p3='+trim(edadMinima)+'&p4='+trim(edadMaximo)+'&p5='+sexo+'&p6='+sexoTexto
            +'&p7='+trim(valorMinima)+'&p8='+trim(valorMaximo)+'&p9='+significado+'&p10='+nombreGrupo+'&p11='+nombreDatos
            +'&p12='+estadoEdad+'&p13='+estadoSexo+'&p14='+tipoDatos +'&p15='+idGrupoDatos+'&p16='+idDatosPuntoControl 
            +'&p17='+nombreTipoDatos+'&p18='+bMaximoEdadInfinito+'&p19='+bRangoInfinitoPositivo+'&p20='+bRangoInfinitoNegativo;
        this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion); 
    }
}

function ocultarYpresentarTipoDatos_Div(tipoDatos,estadoSexo,estadoEdad,bMaximoEdadInfinito,bRangoInfinitoPositivo,bRangoInfinitoNegativo){
    $("checkSexo").hide();
    $("cboSexo").hide();
    $("checkEdad").hide();
    $("txtEdadMinimo").hide();
    $("txtEdadMaximo").hide();
    $("txtValorMinimo").hide();
    $("txtValorMaximo").hide();
    $("cboTipoCombo").hide();
    $("txtSignificado").hide();
    //    $("checkedad").hide();
    $("checkBoolea").hide();

    $("div_sexo").hide();
    $("div_Edad").hide();
    $("div_RangoEdad").hide();
    $("div_RangoResultados").hide();
    $("div_SeleccionCombo").hide();
    $("div_Significado").hide();
    $("div_EdadEntre").hide();
    $("div_EntreRangoResultado").hide();
    $("div_RangoResultadoBoole").hide();
    $("checkPositivoInfinitoEdadEditar").hide();
    $("div_infinitoEdadEditar").hide();
    $("checkNegativoInfinitoEditar").hide();
    $("div_infinitoNegativoEditar").hide();
    
    $("checkPositivoInfinitoEditar").hide();
    $("div_infinitoPositivoEditar").hide();
  
    if(tipoDatos==1){//entero
        if(estadoSexo==1){
            $("cboSexo").show();
        }
        
        if(estadoEdad==1){
            $("div_RangoEdad").show();
            $("txtEdadMinimo").show();
            $("txtEdadMaximo").show();
            $("checkPositivoInfinitoEdadEditar").show();
            $("div_infinitoEdadEditar").show();
            
        }
        if(bMaximoEdadInfinito==1){
            $("txtEdadMaximo").value='';
            document.getElementById('txtEdadMaximo').disabled = true;
        }
        if(bRangoInfinitoNegativo==1){
            $("txtValorMinimo").value='';
            document.getElementById('txtValorMinimo').disabled = true;
        }
        
        if(bRangoInfinitoPositivo==1){
            $("txtValorMaximo").value='';
            document.getElementById('txtValorMaximo').disabled = true;
        }
        
        $("checkSexo").show(); 
        $("div_sexo").show();   
        $("checkEdad").show();
        $("div_Edad").show();     
        $("div_EdadEntre").show();
        $("div_Significado").show();
        $("txtSignificado").show();
        $("div_EntreRangoResultado").show();
        $("txtValorMinimo").show();
        $("txtValorMaximo").show();
        $("div_RangoResultados").show();  
        $("checkNegativoInfinitoEditar").show();
        $("div_infinitoNegativoEditar").show();
        $("checkPositivoInfinitoEditar").show();
        $("div_infinitoPositivoEditar").show();
  
    }

    if(tipoDatos==3){// datime
        if(estadoSexo==1){
            $("cboSexo").show();
        }
        
        if(estadoEdad==1){
            $("div_RangoEdad").show();
            $("txtEdadMinimo").show();
            $("txtEdadMaximo").show();
            $("div_EdadEntre").show();
            $("checkPositivoInfinitoEdadEditar").show();
            $("div_infinitoEdadEditar").show();
        }
        if(bMaximoEdadInfinito==1){
            $("txtEdadMaximo").value='';
            document.getElementById('txtEdadMaximo').disabled = true;
        }
        if(bRangoInfinitoNegativo==1){
            $("txtValorMinimo").value='';
            document.getElementById('txtValorMinimo').disabled = true;
        }
        
        if(bRangoInfinitoPositivo==1){
            $("txtValorMaximo").value='';
            document.getElementById('txtValorMaximo').disabled = true;
        }
        $("checkEdad").show();
        $("div_Edad").show();
        
        $("checkSexo").show(); 
        $("div_sexo").show();
        $("checkEdad").show();
        $("div_Significado").show();
        $("txtSignificado").show();
        $("div_EntreRangoResultado").show();
        $("txtValorMinimo").show();
        $("txtValorMaximo").show();
        $("div_RangoResultados").show();
        $("checkNegativoInfinitoEditar").show();
        $("div_infinitoNegativoEditar").show();
        $("checkPositivoInfinitoEditar").show();
        $("div_infinitoPositivoEditar").show();
       
    }

    if(tipoDatos==5){// boleano
        
        if(estadoSexo==1){
            $("cboSexo").show();
        }
        if(estadoEdad==1){
            $("div_RangoEdad").show();
            $("txtEdadMinimo").show();
            $("txtEdadMaximo").show();
            $("div_EdadEntre").show();
            $("checkPositivoInfinitoEdadEditar").show();
            $("div_infinitoEdadEditar").show();
        }
        if(bMaximoEdadInfinito==1){
            $("txtEdadMaximo").value='';
            document.getElementById('txtEdadMaximo').disabled = true;
        }
        $("checkBoolea").show();
        $("checkEdad").show();
        $("div_Edad").show();
        $("div_RangoResultadoBoole").show();
        $("checkSexo").show(); 
        $("div_sexo").show();
        $("checkEdad").show();
        $("div_Significado").show();
        $("txtSignificado").show();

       
    }
    if(tipoDatos==6){// combo
        if(estadoSexo==1){
            $("cboSexo").show();
        }
        if(estadoEdad==1){
            $("div_RangoEdad").show();
            $("txtEdadMinimo").show();
            $("txtEdadMaximo").show();
            $("div_EdadEntre").show();
            $("checkPositivoInfinitoEdadEditar").show();
            $("div_infinitoEdadEditar").show();
        }
        if(bMaximoEdadInfinito==1){
            $("txtEdadMaximo").value='';
            document.getElementById('txtEdadMaximo').disabled = true;
        }
        $("cboTipoCombo").show();
        $("checkEdad").show();
        $("div_Edad").show();
        $("div_SeleccionCombo").show();
        $("checkSexo").show(); 
        $("div_sexo").show();
        $("div_Significado").show();
        $("txtSignificado").show();
        
    }
    if(tipoDatos==4){// Decimal
        if(estadoSexo==1){
            $("cboSexo").show();
            
        }
        
        if(estadoEdad==1){
            $("div_RangoEdad").show();
            $("txtEdadMinimo").show();
            $("txtEdadMaximo").show();
            $("checkPositivoInfinitoEdadEditar").show();
            $("div_infinitoEdadEditar").show();
        }
        if(bMaximoEdadInfinito==1){
            $("txtEdadMaximo").value='';
            document.getElementById('txtEdadMaximo').disabled = true;
        }

        if(bRangoInfinitoNegativo==1){
            $("txtValorMinimo").value='';
            document.getElementById('txtValorMinimo').disabled = true;
        }
        
        if(bRangoInfinitoPositivo==1){
            $("txtValorMaximo").value='';
            document.getElementById('txtValorMaximo').disabled = true;
        }
        $("checkSexo").show(); 
        $("div_sexo").show();   
        $("checkEdad").show();
        $("div_Edad").show();     
        $("div_EdadEntre").show();
        $("div_Significado").show();
        $("txtSignificado").show();
        $("div_EntreRangoResultado").show();
        $("txtValorMinimo").show();
        $("txtValorMaximo").show();
        $("div_RangoResultados").show();
        $("checkNegativoInfinitoEditar").show();
        $("div_infinitoNegativoEditar").show();
        $("checkPositivoInfinitoEditar").show();
        $("div_infinitoPositivoEditar").show();
        
    }
}

function activarNegativoInfinitoEditar(){
    if( document.getElementById("checkPositivoInfinitoEdadEditar").checked){
        $("txtEdadMaximo").value='';
        document.getElementById('txtEdadMaximo').disabled = true;
    }else {
        document.getElementById('txtEdadMaximo').disabled = false;
    }
}

function activarNegativoInfinitoRangoEditar(){
    if( document.getElementById("checkNegativoInfinitoEditar").checked){
        $("txtValorMinimo").value='';
        document.getElementById('txtValorMinimo').disabled = true;
    }else {
        document.getElementById('txtValorMinimo').disabled = false;
    }
}


function activarPositivoInfinitoRangoEditar(){
    if( document.getElementById("checkPositivoInfinitoEditar").checked){
        $("txtValorMaximo").value='';
        document.getElementById('txtValorMaximo').disabled = true;
    }else {
        document.getElementById('txtValorMaximo').disabled = false;
    }
}

function activarSexo(){
    
    var idRangoSexo= document.getElementById("checkSexo").checked;
    
    if(idRangoSexo==true){
        $("cboSexo").show(); 
    }else{
        $("cboSexo").hide(); 
    }
}
function activarEdad(){
    var idRangoEdad= document.getElementById("checkEdad").checked;

    if(idRangoEdad==true){
        $("div_RangoEdad").show();
        $("txtEdadMinimo").show();
        $("txtEdadMaximo").show();
        $("div_EdadEntre").show(); 
        $("checkPositivoInfinitoEdadEditar").show();
        $("div_infinitoEdadEditar").show();
        $("txtEdadMaximo").value='';
        $("txtEdadMinimo").value='';
        
    }else{
        $("div_RangoEdad").hide();
        $("txtEdadMinimo").hide();
        $("txtEdadMaximo").hide();
        $("div_EdadEntre").hide(); 
        $("checkPositivoInfinitoEdadEditar").hide();
        $("div_infinitoEdadEditar").hide();
        $("txtEdadMaximo").value='';
        $("txtEdadMinimo").value='';
    }
}

function eliminarRango(filak, filay,filax){
    var b1= $("div_barrraDesplazante").scrollTop;
    var idRango=$("hidRango"+filak+filay+filax).value;
    if(confirm("Seguro que desea eliminar el Grupo")){
        var patronModulo='eliminarRango';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+idRango;

        var destino="";
        contadorCargador++;
        var idCargador=contadorCargador;
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            asynchronous:false,
            parameters : parametros,
            onLoading : cargadorpeche(1,idCargador),
            onComplete : function(transport){
                cargadorpeche(0,idCargador);
                refrescarventanaRango();
                document.getElementById('div_barrraDesplazante').scrollTop =b1;            
            }
        })
    }
}
function refrescarventanaRango(){

    var filax=  $("hfilaPuntoControl").value;
    var columnax= $("hcolumnaPuntoControl").value;
       
    var patronModulo='';
    var parametros='';
    parametros+='p1='+patronModulo;
 
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargador),
        onComplete : function(transport){
            cargadorpeche(0,idCargador); 
            subirBajarSecuenciaPuntoControl(filax,columnax);
            $("div_rangoFormato").show(); 
            $("div_Produccion").hide(); 
            $("div_EnDesarrollo").show();
            var cantidadFinas=$("hcantidadFinas").value;
            for(var i=0;i<cantidadFinas;i++){
                $("div_grupoDatosEditar"+i).hide();
                $("div_grupoDatosBotonGuardar"+i).hide();
            }  
            
        }
    })
}
function cerrarRangos(){
    Windows.close("Div_POpaEditarRango");   
}
function modificarRangos(){
    var b1= $("div_barrraDesplazante").scrollTop;
    Windows.close("Div_POpaEditarRango");
    var tipoDatos=$("hTipoDatos").value;
    var idRango= $("hidRango").value;
    var ckeckRangoSexo= document.getElementById("checkSexo").checked;
    var ckeckRangoEdad= document.getElementById("checkEdad").checked;
    var  bSexo=0;//
    var  bEdad=0;//
    var  iEdadMinima='';//
    var  iEdadMaxima='';//
    var  iSexo='';//
    var  nValorMinimo='';//
    var  nValorMaximo='';//
    var  vSignificado=$("txtSignificado").value;//
    var bMaximoEdadInfinito=0;
    var bRangoInfinitoPositivo=0;
    var bRangoInfinitoNegativo=0;
    //    var  iIdDatosPuntoControl=0;

    if( document.getElementById("checkPositivoInfinitoEdadEditar").checked){
        bMaximoEdadInfinito=1
    }
    if( document.getElementById("checkNegativoInfinitoEditar").checked){
        bRangoInfinitoNegativo=1;
    }
    if( document.getElementById("checkPositivoInfinitoEditar").checked){
        bRangoInfinitoPositivo=1;
    }
    /////////////////////
    if(ckeckRangoSexo==true){
        bSexo=1;
        iSexo=$("cboSexo").value;      
    }else{
        bSexo=0;
        iSexo=null; 
    }
    if(ckeckRangoEdad==true){
        bEdad=1;
        iEdadMinima=$("txtEdadMinimo").value;  
        iEdadMaxima=$("txtEdadMaximo").value;  
    }else{
        bEdad=0;
        iEdadMinima='';  
        iEdadMaxima=''; 
    }
    if(tipoDatos==1 ||tipoDatos==4 ||tipoDatos== 3 ){
        nValorMinimo =$("txtValorMinimo").value;
        nValorMaximo =$("txtValorMaximo").value;       
    } 
    if(tipoDatos==6 ){
        nValorMinimo =$("cboTipoCombo").value;  
    } 
    if(tipoDatos==5 ){
        if( document.getElementById("checkBoolea").checked==true){
            nValorMinimo =1;    
        }else{
            nValorMinimo =0;
        }               
    }


    var patronModulo='modificarRangos';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idRango+'&p3='+bSexo+'&p4='+bEdad+'&p5='+iEdadMinima+'&p6='+iEdadMaxima
        +'&p7='+iSexo+'&p8='+nValorMinimo+'&p9='+nValorMaximo+'&p10='+vSignificado
        +'&p11='+bMaximoEdadInfinito+'&p12='+bRangoInfinitoPositivo+'&p13='+bRangoInfinitoNegativo ;
 
    var destino="";
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargador),
        onComplete : function(transport){
            cargadorpeche(0,idCargador);
            refrescarventanaRango(); 
            document.getElementById('div_barrraDesplazante').scrollTop =b1;     
            
        }
    })  
    
}

function editarDatosPuntoControl(iIdDatosPuntoControl,filak,filay){
   
    $("hTipoUnidadDeMedida"+filak+filay).value=$('cboTipoUnidadDeMedida'+filak+filay).value;
    var idTipoDatos=$('cboTipoDatos'+filak+filay).value;
    document.getElementById('txtNombreDatos'+filak+filay).disabled = false;
    document.getElementById('cboTipoDatos'+filak+filay).disabled = false;
    $('hTipoDatosAntiguo'+filak+filay).value =$('cboTipoDatos'+filak+filay).value;
    $('hNombreDatosAntiguo'+filak+filay).value=$("txtNombreDatos"+filak+filay).value;
    
    document.getElementById('cboTipoUnidadDeMedida'+filak+filay).disabled = false; 
    document.getElementById('checkMuestraDatosEnExamen'+filak+filay).disabled = false;
    document.getElementById('checkObligatorio'+filak+filay).disabled = false;
    $("div_editarDatosPuntoControl"+filak+filay).hide();
    $("div_GuardarDatosPuntoControl"+filak+filay).show();
    if(idTipoDatos==6){
        $("div_EditarCombo"+filak+filay).show();
    }
    
    $("hcantidadParaEditar"+filak).value=parseInt($("hcantidadParaEditar"+filak).value)+1 
}

function cargarComboUnidadMedidaEditar(filak,filay){
    $("div_UnidadDeMedidaEditable"+filak+filay).hide();
    var idtipoUnidadDeMedida=$("cboTipoUnidadDeMedida"+filak+filay).value;
    
    document.getElementById('cboUnidadDeMedida'+filak+filay).disabled = false;
  
    var patronModulo='cargarComboEditarUnidadMedida';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idtipoUnidadDeMedida;
    parametros+='&p3='+filak;
    parametros+='&p4='+filay;

    var destino="div_UnidadDeMedidaEditableModificar"+filak+filay;
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargador),
        onComplete : function(transport){
            cargadorpeche(0,idCargador);
            var respuesta = transport.responseText;
            if(destino!="") $(destino).update(respuesta);              
        }
    })

}
function modificarDatosPuntoControl(idDatosPuntoControl,filak,filay){
    var b1= $("div_barrraDesplazante").scrollTop;
 
    var idTipoDatos=$('cboTipoDatos'+filak+filay).value;
    if(idTipoDatos==6){
        $("div_EditarCombo"+filak+filay).hide();
    }
    
    var tipoDatoAntiguo= $('hTipoDatosAntiguo'+filak+filay).value ;
    var unidadDeMedidaAntiguo= $('cboUnidadDeMedida'+filak+filay).value;
    var nombreDatosAntiguo= $('hNombreDatosAntiguo'+filak+filay).value;
    var hTipoUnidadDeMedida= $("hTipoUnidadDeMedida"+filak+filay).value ; // para verificar si no cambia el tipo de datos
    var hcheckMuestraDatosEnExamen = $('hcheckMuestraDatosEnExamen'+filak+filay).value;
    var hcheckObligatorio = $('hcheckObligatorio'+filak+filay).value;
    
    var nombreDatos=$("txtNombreDatos"+filak+filay).value;
    var tipoDatos=$("cboTipoDatos"+filak+filay).value;
    var tipoUnidadDeMedida=$("cboTipoUnidadDeMedida"+filak+filay).value;
   
    if( document.getElementById("checkObligatorio"+filak+filay).checked==true){
        var iObligatorio=1;
    }else{ 
        var iObligatorio=0;
    }
    
    if( document.getElementById("checkMuestraDatosEnExamen"+filak+filay).checked==true){
        var muestraDatosEnExamen=1;
    }else{ 
        var muestraDatosEnExamen=0;
    }
    if(hTipoUnidadDeMedida==tipoUnidadDeMedida){
        
        var unidadDeMedidaEditar=$("cboUnidadDeMedida"+filak+filay).value;
    }else{
        var unidadDeMedidaEditar=$("cboUnidadDeMedidaEditar"+filak+filay).value;  
    }
   
    if(!document.getElementById("cboUnidadDeMedidaEditar"+filak+filay)){

        //        alert("no exite"); 

    }else{

        //        alert("exite");
        var unidadDeMedidaEditar=$("cboUnidadDeMedidaEditar"+filak+filay).value; 
    }
    
    //    alert(nombreDatos +'--'+tipoDatos+'--'+tipoUnidadDeMedida+'--'+unidadDeMedidaEditar+'--'+muestraDatosEnExamen);
    //    alert(unidadDeMedidaEditar);
    if(tipoDatoAntiguo!=tipoDatos || hTipoUnidadDeMedida!=tipoUnidadDeMedida
){
        if(confirm("Seguro que desea Cambiar Tipo de Datos")){
            
            if(confirm("Se Eliminaran los Rango")){
                $("hcantidadParaEditar"+filak).value=parseInt($("hcantidadParaEditar"+filak).value)-1 ;
                var patronModulo='modificarDatosPuntoControl';
                var parametros='';
                parametros+='p1='+patronModulo;
                parametros+='&p2='+idDatosPuntoControl+'&p3='+nombreDatos+'&p4='+tipoDatos+'&p5='+tipoUnidadDeMedida+'&p6='+unidadDeMedidaEditar
                    +'&p7='+muestraDatosEnExamen +'&p8='+ iObligatorio+'&p9='+ hTipoUnidadDeMedida;
                var destino="";
                contadorCargador++;
                var idCargador=contadorCargador;
                new Ajax.Request(pathRequestControl,{
                    method : 'get',
                    asynchronous:false,
                    parameters : parametros,
                    onLoading : cargadorpeche(1,idCargador),
                    onComplete : function(transport){
                        cargadorpeche(0,idCargador);

                        NoEditarModificado(parseInt($("hcantidadParaEditar"+filak).value),filak,filay);
                         
                        if(parseInt($("hcantidadParaEditar"+filak).value)==0) {
                            refrescarventanaRango();
                        } 
                        document.getElementById('div_barrraDesplazante').scrollTop =b1;
                    }
                })
            }else{
                $("hcantidadParaEditar"+filak).value=parseInt($("hcantidadParaEditar"+filak).value)-1 
                NoEditarModificado(parseInt($("hcantidadParaEditar"+filak).value),filak,filay);
                document.getElementById('div_barrraDesplazante').scrollTop =b1;
            }
        } 
        else{
            $("hcantidadParaEditar"+filak).value=parseInt($("hcantidadParaEditar"+filak).value)-1 
            NoEditarModificado(parseInt($("hcantidadParaEditar"+filak).value),filak,filay);
            document.getElementById('div_barrraDesplazante').scrollTop =b1;
        }
    }
    else {
        $("hcantidadParaEditar"+filak).value=parseInt($("hcantidadParaEditar"+filak).value)-1 
        var destino="";
        var patronModulo='modificarDatosPuntoControlSoloNombre';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+idDatosPuntoControl+'&p3='+nombreDatos+'&p4='+ muestraDatosEnExamen
            +'&p5='+ unidadDeMedidaEditar+'&p6='+ iObligatorio;
        
        if(nombreDatos!=nombreDatosAntiguo || hcheckMuestraDatosEnExamen!=muestraDatosEnExamen || hcheckObligatorio!=iObligatorio
            || unidadDeMedidaAntiguo!=unidadDeMedidaEditar){
            
            contadorCargador++;
            var idCargador=contadorCargador;
            new Ajax.Request(pathRequestControl,{
                method : 'get',
                asynchronous:false,
                parameters : parametros,
                onLoading : cargadorpeche(1,idCargador),
                onComplete : function(transport){
                    cargadorpeche(0,idCargador);
                    
                    NoEditarModificado(parseInt($("hcantidadParaEditar"+filak).value),filak,filay);
                    if(parseInt($("hcantidadParaEditar"+filak).value)==0) {
                        refrescarventanaRango();
                    }  
                    document.getElementById('div_barrraDesplazante').scrollTop =b1;
                }
            })
        }else{
            
            var destino="";
            var parametros='';
            parametros+='p1='+patronModulo;
            contadorCargador++;
            var idCargador=contadorCargador;
            new Ajax.Request(pathRequestControl,{
                method : 'get',
                asynchronous:false,
                parameters : parametros,
                onLoading : cargadorpeche(1,idCargador),
                onComplete : function(transport){
                    cargadorpeche(0,idCargador);
                    //            refrescarventanaRango()
                    NoEditarModificado(parseInt($("hcantidadParaEditar"+filak).value),filak,filay);
                    if(parseInt($("hcantidadParaEditar"+filak).value)==0) {
                        refrescarventanaRango();
                    } 
                    document.getElementById('div_barrraDesplazante').scrollTop =b1;
                }
            })
        }
    }
}
// como comento porque genera problemas la idea es que cuando no exita cambio alguno no aga nada
// 
function NoEditarModificado(hcantidadParaEditar,filak,filay){
    var tipoUnidadDeMedida=$("cboTipoUnidadDeMedida"+filak+filay).value;
    var hTipoUnidadDeMedida= $("hTipoUnidadDeMedida"+filak+filay).value ; // para verificar si no cambia el tipo de datos
    document.getElementById('txtNombreDatos'+filak+filay).disabled = true;
    document.getElementById('cboTipoDatos'+filak+filay).disabled = true;
    document.getElementById('cboTipoUnidadDeMedida'+filak+filay).disabled = true;

    if(hTipoUnidadDeMedida==tipoUnidadDeMedida){
        document.getElementById('cboUnidadDeMedida'+filak+filay).disabled = true;
    }else{
        document.getElementById('cboUnidadDeMedidaEditar'+filak+filay).disabled = true;
    }
   
    document.getElementById('checkMuestraDatosEnExamen'+filak+filay).disabled = true;
    $("div_editarDatosPuntoControl"+filak+filay).show();
    $("div_GuardarDatosPuntoControl"+filak+filay).hide();
    /////////////////////////////
    var parametros='';
    var destino="";
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargador),
        onComplete : function(transport){
            cargadorpeche(0,idCargador);
    
            if(parseInt($("hcantidadParaEditar"+filak).value)==0) {
                refrescarventanaRango();
            }          
        }
    })
    

}

function validarTipoDatosCombo(filak,filay){
    var idTipoDatos=$("cboTipoDatos"+filak+filay).value;
    //    alert(idTipoDatos);  // idTipoDatos=6 para el combo
    if(idTipoDatos==6){
        $("div_EditarCombo"+filak+filay).show(); 
    }else{
        $("div_EditarCombo"+filak+filay).hide();  
    }  
}
function editarCombos(idCombo,idDatosPuntoControl,filak,filay){

    posFuncion = "ocultarBotonNueno("+idDatosPuntoControl+")";
    vtitle='';
    vformname='PopaEditarCombo';
    vwidth='580';
    vheight='300';
    patronModulo='popapEditarCombo';
    vcenter='t';
    vresizable='';
    vmodal='false';
    vstyle='';
    vopacity='';
    veffect='';
    vposx1='';
    vposx2='';
    vposy1='';
    vposy2='';
    parametros='';
    parametros+='p1='+patronModulo+'&p2='+idDatosPuntoControl+'&p3='+filak+'&p4='+filay;
    this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion); 

}
function ocultarBotonNueno(idDatosPuntoControl){
    $("div_modificarItemCombo").hide();
    var iTemMax=$("hiTemMax").value;
    var patronModulo='ocultarBotonNueno';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idDatosPuntoControl;
    parametros+='&p3='+iTemMax;
    
    tablaItemCombo=new dhtmlXGridObject('div_ItemCombo');
    tablaItemCombo.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaItemCombo.setSkin("dhx_skyblue");
    tablaItemCombo.enableRowsHover(true,'grid_hover');
    tablaItemCombo.attachEvent("onRowSelect", function(fila,columna){
        editarModificarItem(fila,columna);
    });  
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaItemCombo.attachEvent("onXLS", function(){// ante que se cree la tabla
        cargadorpeche(1,idCargador);
    });
    tablaItemCombo.attachEvent("onXLE", function(){// cuando exite la tabla
        cargadorpeche(0,idCargador);
        $("hidCombo").value= tablaItemCombo.cells(0,1).getValue();
    });
    /////////////fin cargador ///////////////////////
    tablaItemCombo.setSkin("dhx_skyblue");
    tablaItemCombo.init();
    tablaItemCombo.loadXML(pathRequestControl+'?'+parametros);
}

function editarModificarItem(fila,columna){
    var iIddatosPuntoControl=tablaItemCombo.cells(fila,0).getValue();
    var nombreItem=tablaItemCombo.cells(fila,3).getValue();
    var nombreItemAntiguo=tablaItemCombo.cells(fila,3).getValue();
    var ordenItem=tablaItemCombo.cells(fila,4).getValue();
    var idItemCombo=tablaItemCombo.cells(fila,2).getValue();// codigo de DatosCombo
    var idCombo=tablaItemCombo.cells(fila,1).getValue();
   
    if(columna==6){// es el boton editar de los Item de cada combo
        $("txtNombreItem").value  =nombreItem;
        $("txtNombreItemAntiguo").value  =nombreItemAntiguo;
        $("txtOrdenItem").value  =ordenItem;
        $("txtidItem").value  =idItemCombo;
               
        $("div_guardarItemCombo").hide();
        $("div_modificarItemCombo").show();
        $("txtfilak").value=fila;
    }
    ////////////////////////////////////////////////////////////////////
    if(columna==7){ /// eliminar Cada item del combo  
        var iTemMax=$("hiTemMax").value;
    
        var patronModulo='EliminarDatosCombos';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+idItemCombo;
        parametros+='&p3='+idCombo;
        parametros+='&p4='+iTemMax;
        parametros+='&p5='+ordenItem;
        if(confirm("Esta seguro de Eliminar el Item")){
            var destino="";
            contadorCargador++;
            var idCargador=contadorCargador;
            new Ajax.Request(pathRequestControl,{
                method : 'get',
                asynchronous:false,
                parameters : parametros,
                onLoading : cargadorpeche(1,idCargador),
                onComplete : function(transport){
                    cargadorpeche(0,idCargador);
                    ocultarBotonNueno(iIddatosPuntoControl)
                }
            }) 
        }
    }
    ////////////////////////////////////////////////////////////////////
    if(columna==8 && fila!=0){ /// Arriba
        
        var iTemMax=$("hiTemMax").value;
        var idItemComboActual= idItemCombo;
        var ordenItemActual=ordenItem;
        var idItemComboRemplazado=tablaItemCombo.cells(parseInt(fila)-1,2).getValue();
        var ordenRemplazado=tablaItemCombo.cells(parseInt(fila)-1,4).getValue();
       
        var patronModulo='subirOrdenItem';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+idItemComboActual;
        parametros+='&p3='+idItemComboRemplazado;  
        parametros+='&p4='+ordenItemActual;
        parametros+='&p5='+ordenRemplazado;
       
        var destino="";
        contadorCargador++;
        var idCargador=contadorCargador;
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            asynchronous:false,
            parameters : parametros,
            onLoading : cargadorpeche(1,idCargador),
            onComplete : function(transport){
                cargadorpeche(0,idCargador);
                ocultarBotonNueno(iIddatosPuntoControl)
            }
        }) 
    }
    var iTemMax=$("hiTemMax").value;
    if(columna==9 && fila!=parseInt(iTemMax)-1){ /// Abajo   
       
        var idItemComboActual= idItemCombo;
        var ordenItemActual=ordenItem;
        var idItemComboRemplazado=tablaItemCombo.cells(parseInt(fila)+1,2).getValue();
        var ordenRemplazado=tablaItemCombo.cells(parseInt(fila)+1,4).getValue();
       
        var patronModulo='bajarOrdenItem';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+idItemComboActual;
        parametros+='&p3='+idItemComboRemplazado;       
        parametros+='&p4='+ordenItemActual;
        parametros+='&p5='+ordenRemplazado;
       
        var destino="";
        contadorCargador++;
        var idCargador=contadorCargador;
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            asynchronous:false,
            parameters : parametros,
            onLoading : cargadorpeche(1,idCargador),
            onComplete : function(transport){
                cargadorpeche(0,idCargador);
                ocultarBotonNueno(iIddatosPuntoControl)
            }
        }) 
    }
}

function guardarItemCombo(){
  
    var idDatosPuntoControl=$("hidDatosPuntoControl").value;
    var nombreItem=$("txtNombreItem").value;
    var iOrden=$("txtOrdenItem").value;
    var idCombo=$("hidCombo").value;
    var filakcombo=$("hfilakcombo").value;
    var filaycombo=$("hfilaycombo").value;
    $("hiTemMax").value=parseInt(iOrden);
    var patronModulo='guardarItemCombo';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idDatosPuntoControl;
    parametros+='&p3='+nombreItem;
    parametros+='&p4='+iOrden;
    parametros+='&p5='+idCombo;
    if(trim(nombreItem)!=''){ 
        var destino="";
        contadorCargador++;
        var idCargador=contadorCargador;
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            asynchronous:false,
            parameters : parametros,
            onLoading : cargadorpeche(1,idCargador),
            onComplete : function(transport){
                cargadorpeche(0,idCargador);
                ocultarBotonNueno(idDatosPuntoControl); 
                $("txtOrdenItem").value  =parseInt($("hiTemMax").value)+1;
                $("txtNombreItem").value=''; 
            }
        })
    }else {
        alert("No ah Ingrese Nombre");
    }
}


function ModificarItemCombo(){  
    var idDatosPuntoControl=$("hidDatosPuntoControl").value;
    var idItem= $("txtidItem").value;
    var nombreItem=  $("txtNombreItem").value;
    var nombreItemAntiguo=$("txtNombreItemAntiguo").value;
    var patronModulo='ModificarItemCombo';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idItem;
    parametros+='&p3='+nombreItem;

    var destino="";
    if(trim(nombreItem)!=trim(nombreItemAntiguo)){
        contadorCargador++;
        var idCargador=contadorCargador;
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            asynchronous:false,
            parameters : parametros,
            onLoading : cargadorpeche(1,idCargador),
            onComplete : function(transport){
                cargadorpeche(0,idCargador);
                ocultarBotonNueno(idDatosPuntoControl);   
            }
        })   
    }
}

function cancelarCombo(){
    $("div_guardarItemCombo").show();
    $("div_modificarItemCombo").hide();
    // txtOrdenItem
    $("txtOrdenItem").value  =parseInt($("hiTemMax").value)+1;
    $("txtNombreItem").value='';
    $("txtidItem").value='';
    $("txtNombreItemAntiguo").value='';
}

function agregarRango(iIdDatosPuntoControl,filak,filay){

    var nombreGrupo=$("nombreGrupoDatosEditar"+filak).value;
    var nombreDatos=$("txtNombreDatos"+filak+filay).value; 
    //    var idDatosPuntoControl=$("hIdDatosPuntoControl"+filak+filay).value;
    var tipoDatos=$("cboTipoDatos"+filak+filay).value;
    var idGrupoDatos=$("idGrupoDatos"+filak).value;  
    var nombreTipoDatos=$("cboTipoDatos"+filak+filay).options[$("cboTipoDatos"+filak+filay).selectedIndex].text;
    
    if(tipoDatos==7 || tipoDatos==2){
        alert("No hay Formato");
    }else{
        posFuncion = "ocultarYpresentarTipoDatosGuardar_Div("+tipoDatos+")";
        vtitle='';
        vformname='PopaAgregarRango';
        vwidth='580';
        vheight='420';
 
        patronModulo='PopaAgregarRango';
        vcenter='t';
        vresizable='';
        vmodal='false';
        vstyle='';
        vopacity='';
        veffect='';
        vposx1='';
        vposx2='';
        vposy1='';
        vposy2='';
        parametros='';
        parametros+='p1='+patronModulo+'&p2='+nombreGrupo+'&p3='+nombreDatos
            +'&p4='+iIdDatosPuntoControl+'&p5='+tipoDatos +'&p6='+idGrupoDatos+'&p7=' +nombreTipoDatos ;
        this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion); 
    }
}

function ocultarYpresentarTipoDatosGuardar_Div(tipoDatos){

    $("checkSexo").hide();
    $("cboSexo").hide();
    $("checkEdad").hide();
    $("txtEdadMinimo").hide();
    $("txtEdadMaximo").hide();
    $("txtValorMinimo").hide();
    $("txtValorMaximo").hide();
    $("cboTipoCombo").hide();
    $("txtSignificado").hide();   
    $("checkBoolea").hide();

    $("div_sexo").hide();
    $("div_Edad").hide();
    $("div_RangoEdad").hide();
    $("div_RangoResultados").hide();
    $("div_SeleccionCombo").hide();
    $("div_Significado").hide();
    $("div_EdadEntre").hide();
    $("div_EntreRangoResultado").hide();
    $("div_RangoResultadoBoole").hide();
    $("checkPositivoInfinito").hide(); 
    $("checkNegativoInfinito").hide(); 
    $("div_infinitoPositivo").hide(); 
    $("div_infinitoNegativo").hide(); 
   
    if(tipoDatos==1){//entero

        $("cboSexo").show();
        $("div_RangoEdad").show();
        $("txtEdadMinimo").show();
        $("txtEdadMaximo").show();
        $("checkSexo").show(); 
        $("div_sexo").show();   
        $("checkEdad").show();
        $("div_Edad").show();     
        $("div_EdadEntre").show();
        $("div_Significado").show();
        $("txtSignificado").show();
        $("div_EntreRangoResultado").show();
        $("txtValorMinimo").show();
        $("txtValorMaximo").show();
        $("div_RangoResultados").show();
        $("checkPositivoInfinito").show(); 
        $("checkNegativoInfinito").show();
        $("div_infinitoPositivo").show(); 
        $("div_infinitoNegativo").show(); 
    }

    if(tipoDatos==3){// datime
        $("cboSexo").show();
        $("div_RangoEdad").show();
        $("txtEdadMinimo").show();
        $("txtEdadMaximo").show();
        $("div_EdadEntre").show();
        $("checkEdad").show();
        $("div_Edad").show();
        
        $("checkSexo").show(); 
        $("div_sexo").show();
        $("checkEdad").show();
        $("div_Significado").show();
        $("txtSignificado").show();
        $("div_EntreRangoResultado").show();
        $("txtValorMinimo").show();
        $("txtValorMaximo").show();
        $("div_RangoResultados").show();
        $("checkPositivoInfinito").show(); 
        $("checkNegativoInfinito").show();
        $("div_infinitoPositivo").show(); 
        $("div_infinitoNegativo").show(); 
    }

    if(tipoDatos==5){// boleano
 
        $("cboSexo").show();
        $("div_RangoEdad").show();
        $("txtEdadMinimo").show();
        $("txtEdadMaximo").show();
        $("div_EdadEntre").show();
        $("checkBoolea").show();
        $("checkEdad").show();
        $("div_Edad").show();
        $("div_RangoResultadoBoole").show();
        $("checkSexo").show(); 
        $("div_sexo").show();
        $("checkEdad").show();
        $("div_Significado").show();
        $("txtSignificado").show();
   
       
    }
    if(parseInt(tipoDatos)==6){// combo

        $("cboSexo").show();
        $("div_RangoEdad").show();
        $("txtEdadMinimo").show();
        $("txtEdadMaximo").show();
        $("div_EdadEntre").show();
        $("cboTipoCombo").show();
        $("checkEdad").show();
        $("div_Edad").show();
        $("div_SeleccionCombo").show();
        $("checkSexo").show(); 
        $("div_sexo").show();
        $("div_Significado").show();
        $("txtSignificado").show();
        //        $("checkPositivoInfinito").show(); 
        //        $("checkNegativoInfinito").show(); 
    }
    if(tipoDatos==4){// Decimal
            
        $("cboSexo").show();
        $("div_RangoEdad").show();
        $("txtEdadMinimo").show();
        $("txtEdadMaximo").show();
        $("checkSexo").show(); 
        $("div_sexo").show();   
        $("checkEdad").show();
        $("div_Edad").show();     
        $("div_EdadEntre").show();
        $("div_Significado").show();
        $("txtSignificado").show();
        $("div_EntreRangoResultado").show();
        $("txtValorMinimo").show();
        $("txtValorMaximo").show();
        $("div_RangoResultados").show();
        $("checkPositivoInfinito").show(); 
        $("checkNegativoInfinito").show();
        $("div_infinitoPositivo").show(); 
        $("div_infinitoNegativo").show(); 
    }
}

function cerrarGuardarRangos(){
    Windows.close("Div_PopaAgregarRango");
}

function activarEdadPositivo(){
    if( document.getElementById("checkPositivoInfinitoEdad").checked){
        $("txtEdadMaximo").value='';
        document.getElementById('txtEdadMaximo').disabled = true;
    }else {
        document.getElementById('txtEdadMaximo').disabled = false;
    }
       
}

function activarNegativoInfinito(){
    if( document.getElementById("checkNegativoInfinito").checked){
        $("txtValorMinimo").value='';
        document.getElementById('txtValorMinimo').disabled = true;
    }else {
        document.getElementById('txtValorMinimo').disabled = false;
    }
       
}
function activarPositivoInfinito(){
    if( document.getElementById("checkPositivoInfinito").checked){
        $("txtValorMaximo").value='';
        document.getElementById('txtValorMaximo').disabled = true;
    }else {
        document.getElementById('txtValorMaximo').disabled = false;
    }
       
}
function GuardarRangos(){
    var b1= $("div_barrraDesplazante").scrollTop;
    var tipoDatos=$("hTipoDatos").value;
    var iIdDatosPuntoControl=$("hiIdDatosPuntoControl").value; 
    var ckeckRangoSexo= document.getElementById("checkSexo").checked;
    var ckeckRangoEdad= document.getElementById("checkEdad").checked;
    //***************************************************************************
    var ckeckInfinitoEdad= document.getElementById("checkPositivoInfinitoEdad").checked;
    var ckeckInfinitoRangoPositivo= document.getElementById("checkPositivoInfinito").checked;
    var ckeckInfinitoRangoNegativo= document.getElementById("checkNegativoInfinito").checked;
    var bMaximoEdadInfinito=0;
    var bRangoInfinitoPositivo=0;
    var bRangoInfinitoNegativo=0;
    //****************************************************************************
    if(ckeckInfinitoEdad==true){
        bMaximoEdadInfinito=1;
    } 
    if(ckeckInfinitoRangoPositivo==true){
        bRangoInfinitoPositivo=1;
    }
    if(ckeckInfinitoRangoNegativo==true){
        bRangoInfinitoNegativo=1;
    }
    
    var  bSexo=0;//
    var  bEdad=0;//
    var  iEdadMinima='';//  
    var  iEdadMaxima='';//
    var  iSexo='';//
    var  nValorMinimo='';//
    var  nValorMaximo='';//
    var  vSignificado=$("txtSignificado").value;//
    var a=0 ; // indicador
    if(ckeckRangoSexo==true){
        bSexo=1;
        iSexo=$("cboSexo").value;      
    }else{
        bSexo=0;
        iSexo=''; 
    }
    if(ckeckRangoEdad==true){
        bEdad=1;
        iEdadMinima=$("txtEdadMinimo").value;  
        iEdadMaxima=$("txtEdadMaximo").value;  
        if(iEdadMinima==''|| iEdadMaxima==''){
            a=1;
            if(ckeckInfinitoEdad==true){
                a=0;   
            }
        }
    }else{
        bEdad=0;
        iEdadMinima='';  
        iEdadMaxima=''; 
    }
    if(tipoDatos==1 ||tipoDatos==4 ||tipoDatos== 3 ){
        nValorMinimo =$("txtValorMinimo").value;
        nValorMaximo =$("txtValorMaximo").value;       
    } 
    if(tipoDatos==6 ){
        nValorMinimo =$("cboTipoCombo").value;  
    } 
    if(tipoDatos==5 ){// boleando
        if( document.getElementById("checkBoolea").checked==true){        
            nValorMinimo =1;    
        }else{
            nValorMinimo =0;
        }               
    }
    //    alert(iEdadMinima);

    if(a==1){
        alert("Fatal Ingresar el Dato de la Edad")
    }else{
        Windows.close("Div_PopaAgregarRango");
        var patronModulo='GuardarRangos';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+iIdDatosPuntoControl+'&p3='+bSexo+'&p4='+bEdad+'&p5='+iEdadMinima+'&p6='+iEdadMaxima
            +'&p7='+iSexo+'&p8='+nValorMinimo+'&p9='+nValorMaximo+'&p10='+vSignificado 
            +'&p11='+bMaximoEdadInfinito+'&p12='+bRangoInfinitoPositivo+'&p13='+bRangoInfinitoNegativo ;
 
        var destino="";
        contadorCargador++;
        var idCargador=contadorCargador;
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            asynchronous:false,
            parameters : parametros,
            onLoading : cargadorpeche(1,idCargador),
            onComplete : function(transport){
                cargadorpeche(0,idCargador);
                refrescarventanaRango();
                document.getElementById('div_barrraDesplazante').scrollTop =b1;

            }
        })  
    }

}

function cargarItemDelCombo(){
    $("div_modificarItemCombo").hide();
    $("div_ItemCombo").hide();
    var fila=$("fila").value; 
    var idCombo=$("idCombo"+fila).value;
    if(idCombo!=''){  
        $("div_ItemCombo").show();
        var patronModulo='cargarItemDelCombo';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+idCombo;
  
        tablaItemCombo1=new dhtmlXGridObject('div_ItemCombo');
        tablaItemCombo1.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
        tablaItemCombo1.setSkin("dhx_skyblue");
        tablaItemCombo1.enableRowsHover(true,'grid_hover');
        tablaItemCombo1.attachEvent("onRowSelect", function(fila,columna){
            editarModificarItem(fila,columna);
        });  
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador=contadorCargador;
        tablaItemCombo1.attachEvent("onXLS", function(){
            cargadorpeche(1,idCargador);
        });
        tablaItemCombo1.attachEvent("onXLE", function(){
            cargadorpeche(0,idCargador);
        });
        /////////////fin cargador ///////////////////////
        tablaItemCombo1.setSkin("dhx_skyblue");
        tablaItemCombo1.init();
        tablaItemCombo1.loadXML(pathRequestControl+'?'+parametros);
    }  
}

function EliminarDatosPuntoControl(iIdDatosPuntoControl,filak,filay,iOrden){
    var b1= $("div_barrraDesplazante").scrollTop;
    var idGrupoDatos=$("idGrupoDatos"+filak).value;
    //    alert("txtNombreDatos"+filay);
    if(filay>9){
        var txtNombreDatos=$("txtNombreDatos0"+filay).value;
    }else {
        var txtNombreDatos=$("txtNombreDatos0"+filay).value; 
    }
    
    var patronModulo='EliminarDatosPuntoControl';

    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+iIdDatosPuntoControl ;
    parametros+='&p3='+idGrupoDatos;
    parametros+='&p4='+iOrden;
    if(window.confirm("Esta Seguro que sea Eliminar el punto de Control:"+txtNombreDatos)) {   
        var destino="";
        contadorCargador++;
        var idCargador=contadorCargador;
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            asynchronous:false,
            parameters : parametros,
            onLoading : cargadorpeche(1,idCargador),
            onComplete : function(transport){
                cargadorpeche(0,idCargador);
                refrescarventanaRango();
                document.getElementById('div_barrraDesplazante').scrollTop =b1;

            }
        })
    }
}
function subirDatosPuntoControl(iIdDatosPuntoControl,filak,filay,iOrden){
    var b1= $("div_barrraDesplazante").scrollTop;
    var iIdDatosPuntoControlActual=iIdDatosPuntoControl;
    var idDatosPuntoControlNuevo=$("hIdDatosPuntoControl"+filak+(filay-1)).value;
    var iOrdenActual=iOrden;
    var iOrdenNuevo=iOrden-1;
    //    alert('Actual: '+iOrdenActual+'Nuevo:  '+iOrdenNuevo);
    var patronModulo='subirDatosPuntoControl';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+iIdDatosPuntoControlActual ;
    parametros+='&p3='+idDatosPuntoControlNuevo;
    parametros+='&p4='+iOrdenActual;
    parametros+='&p5='+iOrdenNuevo;
    var destino="";
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargador),
        onComplete : function(transport){
            cargadorpeche(0,idCargador);
            refrescarventanaRango();
            document.getElementById('div_barrraDesplazante').scrollTop =b1;

        }
    }) 
}

function bajarDatosPuntoControl(iIdDatosPuntoControl,filak,filay,iOrden){
    var b1= $("div_barrraDesplazante").scrollTop;
    var iIdDatosPuntoControlActual=iIdDatosPuntoControl;
    var idDatosPuntoControlNuevo=$("hIdDatosPuntoControl"+filak+(filay+1)).value;
    var iOrdenActual=iOrden;
    var iOrdenNuevo=iOrden+1;
    //     alert('Actual: '+iIdDatosPuntoControlActual+'Nuevo:  '+idDatosPuntoControlNuevo);
    //      alert('Actual: '+iOrdenActual+'Nuevo:  '+iOrdenNuevo);
    var patronModulo='bajarDatosPuntoControl';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+iIdDatosPuntoControlActual ;
    parametros+='&p3='+idDatosPuntoControlNuevo;
    parametros+='&p4='+iOrdenActual;
    parametros+='&p5='+iOrdenNuevo;
    var destino="";
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargador),
        onComplete : function(transport){
            cargadorpeche(0,idCargador);
            refrescarventanaRango();
            document.getElementById('div_barrraDesplazante').scrollTop =b1;

        }
    })
}

function confirmarAproduccion(){
    var idPuntoControlExamenLab=$("hidPuntoControlExamenLab").value;
    var filax=  $("hfilaPuntoControl").value;
    var columnax= $("hcolumnaPuntoControl").value;
    //    alert(idPuntoControlExamenLab);
    if(confirm("Esta seguro que desea confirmar")){     
        var patronModulo='confirmarAproduccion';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+idPuntoControlExamenLab;
        var destino="";
        contadorCargador++;
        var idCargador=contadorCargador;
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            asynchronous:false,
            parameters : parametros,
            onLoading : cargadorpeche(1,idCargador),
            onComplete : function(transport){
                cargadorpeche(0,idCargador);
                var respuesta = transport.responseText;
                if(trim(respuesta)!=0){
                    alert(respuesta);
                }else {
                    subirBajarSecuenciaPuntoControl(filax,columnax);
                }
           
            }
        })
    }
}
//============================================================================================
////==========================================================================================
///Fin para Lobo ///////
//============================================================================================
//============================================================================================





////////////////////////
///Parte para Araoz
//realizado por 06 de Julio 2012

//Div_MantenimientoTablaExamenesLaboratorio
//
//function mostrarExamenesLaboratorio(){
//    alert("hola")
//    
//    
//    
//    
//}
//
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
//%                                                                                            %
//%                            by JCQA                                                         %
//%                                                                                            %
//%                          18 Julio 2012                                                     %
//%    Permiste mostrar un listado de Examenes de Laboratorio                                  %                                                     %
//%                                                                                            %
//%                                                                                            %
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

//tablaMaterialesDeLaboratorioME.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
//tablaMaterialesDeLaboratorioME.setSkin("dhx_skyblue");
//tablaMaterialesDeLaboratorioME.enableRowsHover(true,'grid_hover');

function mostrarExamenesLaboratorio(){
    var patronModulo='mostrarExamenesLaboratorio';
    var parametros='';
    parametros+='p1='+patronModulo;
    tablaExamenesLaboratorioME=new dhtmlXGridObject('Div_MantenimientoTablaExamenesLaboratorio');
    tablaExamenesLaboratorioME.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaExamenesLaboratorioME.setSkin("dhx_skyblue");
    tablaExamenesLaboratorioME.enableRowsHover(true,'grid_hover');
    var filtroPeril = "<input type='text' id='idFiltroPerfil' style='height:20px;border: 1px solid #CECECE;border-radius:5px;width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarFiltrarExamenesLaboratorio();\" />"; 
    var header = [,"#text_filter",filtroPeril, ,"#select_filter"]; 	
    tablaExamenesLaboratorioME.attachHeader(header);
    tablaExamenesLaboratorioME.attachFooter(",,<span style=color:#2200FF ;background:#F90909><H4><B>Nº  Examenes de Laboratorio =</B></H4></span>,,#stat_count,,");
    tablaExamenesLaboratorioME.attachEvent("onRowSelect",
    function(fil,col){
        mostrarPreciosAfiliacionesPorExamen(fil,col);                     
        var IdExamenLaboratorio=tablaExamenesLaboratorioME.cells(fil,0).getValue();
        $('hIdExamenLaboratorio').value=IdExamenLaboratorio;
        $('div_EditarDetalleExamenLabo').show();
        $('div_ActualizarDetalleExamenLabo').hide();
        $('txtDescripcionExaLabo').readOnly=true;
        $('cboTipoExamenLabo').disabled=true;
        var jcqa=tablaExamenesLaboratorioME.cells(0,6).getValue();
    }          
);
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaExamenesLaboratorioME.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaExamenesLaboratorioME.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });   
    //    tablaExamenesLaboratorioME.setSkin("dhx_terrace");
    tablaExamenesLaboratorioME.init();
    tablaExamenesLaboratorioME.loadXML(pathRequestControl+'?'+parametros, function(){
        setColortablaExamenesLaboratorio();
    });
   
    
}


//
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
//%                                                                                            %
//%                            by JCQA                                                         %
//%                                                                                            %
//%                          18 Julio 2012                                                     %
//%    Permiste mostrar un listado de Materiales de Laboratorio                                %                                                     %
//%                                                                                            %
//%                                                                                            %
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%



function mostrarMaterialesDeLaboratorio(){
    
    var patronModulo='mostrarMaterialesDeLaboratorio';
    var parametros='';
    parametros+='p1='+patronModulo;
    tablaMaterialesDeLaboratorioME=new dhtmlXGridObject('Div_MaterialesDeLaboratorio');
    tablaMaterialesDeLaboratorioME.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaMaterialesDeLaboratorioME.setSkin("dhx_skyblue");
    tablaMaterialesDeLaboratorioME.enableRowsHover(true,'grid_hover');
 
    var filtroPeril = "<input type='text' id='idFiltroPerfil' style='width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarFiltrarMaterialesLaboratorio();\" />"; 
    var header = ["#text_filter", ,filtroPeril, ,"#select_filter"]; 	

    tablaMaterialesDeLaboratorioME.attachHeader(header);
    
    tablaMaterialesDeLaboratorioME.attachFooter(" , Nº ,  #stat_count , , #stat_count ");
    //  tablaMaterialesDeLaboratorioME.attachFooter(" ,  ,   ,Nº ,   ,#stat_count");

    //   
    //   tablaMaterialesDeLaboratorioME.attachFooter(" MATERIALES DE LABORATORIO  ,#cspan,   #cspan ,    #cspan  , #stat_count");
    //tablaMaterialesDeLaboratorioME.attachFooter(" MATERIALES DE LABORATORIO \\,    ,     ,    #cspan  , #stat_count  ");
    //  tablaMaterialesDeLaboratorioME.attachFooter("A ,#cspan ,  #cspan  ,  #cspan    , #cspan");
    // tablaMaterialesDeLaboratorioME.attachFooter(",,#cspan,<span style=color:#2200FF ;background:#F90909><H4><B>Nº  Materiales de Laboratorio =</B></H4></span>\\,\\,#stat_count");
   
    //      
    //    
    //    
    tablaMaterialesDeLaboratorioME.attachEvent("onRowSelect",
  
    function(fil,col){
       
        cargarDetalleProductoSeleccionado(fil,col);
        $('div_NuevoMaterialLaboratorio').show();
        $('div_GuardarDetalleMaterialLaboratorio').hide();
        //            $('div_AdjuntarFotoMaterialLaboratorio').hide();
            
        $('div_AdjuntarFotoMaterialLaboratorio').show();
            
            
        $('div_EditarDetalleMaterialLaboratorio').show();
           
            
        $('cboTipoMaterialLabo').disabled=true;
        $('txtDescripcionExaLabo').readOnly=true;
        mostrarImagenMaterialLaboratorio();
           
        //            $('div_Mensaje_MaterialesLabo').value='';
            
        $('div_Mensaje_MaterialesLabo').innerHTML='<p style="color: blue; font-weight: bold;"> </p>';
             
        //             $('div_Mensaje_MaterialesLabo').hide();
           
            

    }  
       
);
    
 
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaMaterialesDeLaboratorioME.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaMaterialesDeLaboratorioME.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    
    /////////////fin cargador ///////////////////////
    
    
    
    tablaMaterialesDeLaboratorioME.setSkin("dhx_skyblue");
    tablaMaterialesDeLaboratorioME.init();
    tablaMaterialesDeLaboratorioME.loadXML(pathRequestControl+'?'+parametros, function(){
      
        //setColortablaExamenesLaboratorio();
        
    });
   
    
}

function mostrarImagenMaterialLaboratorio(){
       
    var idMaterialLaboratorio=$('hIdMaterialLaboratorio').value
    parametros='';
    //    parametros+='p1=agregarNuevoUnidadalMaterialLaboratorioPoppud';
    parametros+='p1=mostrarImagenMaterialLaboratorioTraerData';
    parametros+='&p2='+idMaterialLaboratorio;
    //    parametros+='&p3='+IdMaterialLabo;
               
    var datosx=traerData(parametros);

    //    alert(datosx[0].trim());
 
    $('Div_fotoMaterialLaboratorio').innerHTML=
        '<p style="color: blue; font-weight: bold;"><img width="100" height="100" src=\"'+datosx[0].trim()+'\" alt=Nuevo title=Id Material='+ +idMaterialLaboratorio +' border=0/></p>';


    
    
    
    
}


//cuando haces click en la tabla Materiales Seleccionados  -- JCQA
function cargarDetalleProductoSeleccionado(fil,col){
    //    alert("cargar detalle");
    var idMaterialLaboratorio=tablaMaterialesDeLaboratorioME.cells(fil,0).getValue();
    var codSerPro=tablaMaterialesDeLaboratorioME.cells(fil,0).getValue();
    var nombreMaterialLaboratorio=tablaMaterialesDeLaboratorioME.cells(fil,2).getValue();
    var idTipoMaterialLaboratorio=tablaMaterialesDeLaboratorioME.cells(fil,3).getValue();
    var TipoMaterialLaboratorio=tablaMaterialesDeLaboratorioME.cells(fil,4).getValue();
    var DescripcionMaterialLaboratorio=tablaMaterialesDeLaboratorioME.cells(fil,5).getValue();
    
    $('hIdMaterialLaboratorio').value=idMaterialLaboratorio
    
    var idMaLa=$('hIdMaterialLaboratorio').value
    
    //    alert(idMaLa)
    
    $('txtIdNuevoMaterialLabo').value=idMaterialLaboratorio;
    $('txtCodigoNuevoMaterialLabo').value=codSerPro;
    $('txtNombreMaterialLabo').value=nombreMaterialLaboratorio;
    $("cboTipoMaterialLabo").selectedIndex=idTipoMaterialLaboratorio;
    
    $('txtDescripcionExaLabo').value=DescripcionMaterialLaboratorio;
     
    cargarTablaUnidadesxTipoxMaterialLaboratorio(idMaLa);
    
  
}

//JCQA 28septiembre2012
function MostrarMaterialesSeleccionadosXpuntoControlExamenLabo(){
    //    alert("MostrarMaterialesSeleccionadosXpuntoControlExamenLabo")
      
    var hidPuntoControlExamenLab=$('hidPuntoControlExamenLab').value;

    var patronModulo='MostrarMaterialesSeleccionadosXpuntoControlExamenLabo';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+hidPuntoControlExamenLab;
    
    var destino="div_MostrarMaterialesSeleccionadosXpuntoControlExamenLabo";
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargador),
        onComplete : function(transport){
            cargadorpeche(0,idCargador);
            var respuesta = transport.responseText;
            if(destino!="") $(destino).update(respuesta);
            // alert("acordo");
           
            acordionHistorialjc();
            MostrarMuestrasSeleccionadosXpuntoControlExamenLabo();
            //            probandolayout();
            //            probandochart();
              
        }
    }
		
)
 
}

function probandochart(){
    
    //                window.onload = function(){
    alert("entro onload 2");
    
    var companies=[
        {
            "companyX":"1", 
            "companyB":"200", 
            "companyC":"5", 
            "day":"Jueves"
        },
        {
            "companyX":"2", 
            "companyC":"7", 
            "day":"Viernes"
        },
        {
            "companyX":"3", 
            "companyC":"8", 
            "day":"Sabado"
        },
        {
            "companyX":"4", 
            "companyC":"10", 
            "day":"Domingo"
        },
        {
            "companyX":"5", 
            "companyC":"11",
            "day":"Lunes"
        },
        {
            "companyX":"6", 
            "companyC":"14",
            "day":"Martes"
        },
        {
            "companyX":"7", 
            "companyC":"20", 
            "day":"Miercoles"
        },
        {
            "companyX":"8", 
            "companyC":"22", 
            "companyB":"1", 
            "day":"Jueves"
        }
    ];
    
    
    var chart2 =  new dhtmlXChart({
        view:"bar",
        container:"chart2",
        value:"#companyX#",
        //            color:"#66cc33",

        item:{
            borderColor: "#1293f8",
            color: "#ffffff"
        },
        line:{
            color:"#1293f8",
            width:3
        },
        tooltip:{
            template:"#companyX#"
        },
        offset:0,
        xAxis:{
            title:"Ventas por dia",
            template:"#day#"
        },
        yAxis:{
            start:0,
            step:5,
            end:40,
            template:function(value){
                return value%5?"":value
            }
        },
        padding:{
            left:35,
            bottom:20
        },
        origin:0,
        legend:{
            layout:"x",
            width: 75,
            align:"center",
            valign:"bottom",
            marker:{
                type:"round",
                width:15
            },
            values:[
                {
                    text:"Cummulative",
                    color:"#3399ff"
                },

                {
                    text:"Daily",
                    color:"#66cc00"
                },

                {
                    text:"Should be",
                    color:"#66cc00"
                }
                    
            ]
        }
    })
      
   
    chart2.addSeries({
        value:"#companyB#",
        item:{
            borderColor: "#66cc00",
            color: "#ffffff"
        },
        line:{
            color:"#66cc00",
            width:3
        },
        tooltip:{
            template:"#companyB#"
        }
    })


    chart2.addSeries({
        value:"#companyC#",
        item:{
            borderColor: "#66cc00",
            color: "#ffffff"
        },
        line:{
            color:"#66cc00",
            width:3
        },
        tooltip:{
            template:"#companyC#"
        }
    })


         
    chart2.parse(companies,"json");
    //            }     //fin de onload
    
}

function buscarExamenesLaboratorio_IndicadoresLaboClinico(){
    //alert("busca");txtExamenLaboratorio_IndicadoresLaboratorioClinico
    //    alert(document.getElementById('txtExamenLaboratorio_IndicadoresLaboratorioClinico').value)
    findLikeGoogle(document.getElementById('idFiltroPerfil_indicadores').value,tablaiindicadorLaboratorioClinicoListaExamenes,2);
    //alert(document.getElementById('txtExamenesLaboratorio').value)
}


function probandolayout(){
    //    alert("layout");
    
    //    var dhxLayout = new dhtmlXLayoutObject("parentIdjcqa", "3L", "dhx_skyblue");
    
    //    var dhxWins = new dhtmlXWindows();
    //    var layoutWin = dhxWins.createWindow("w1", 20, 20, 600, 400);
    //    
    //    var dhxLayout = new dhtmlXLayoutObject(layoutWin, "3L", "dhx_black");
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //    div_Filtrado   3J   4T
    dhxLayout = new dhtmlXLayoutObject("parentId", "6I","dhx_skyblue");
    dhxLayout.cells("a").setText("GRAFICO"); 
    dhxLayout.cells("a").attachObject("div_Grafico1");//divb
    dhxLayout.cells("a").setHeight(300);
    
    dhxLayout.cells("b").setText("ESCALA"); 
    dhxLayout.cells("b").attachObject("div_Escala");
    dhxLayout.cells("b").setHeight(400);
    //    dhxLayout.cells("b").setHeight(number("100"));
    
        
    dhxLayout.cells("c").setText("FILTRADO POR"); //divc
    dhxLayout.cells("c").attachObject("div_Filtrado");
    
    dhxLayout.cells("d").setText("AFILIACIONES"); //divc
    dhxLayout.cells("d").attachObject("div_BusquedaGraficos");
    
    var statusBar = dhxLayout.attachStatusBar();
    statusBar.setText("Se Muestra la siguiente estadistica de los ultimos 6 meses...");
            
    
    
    var dhxTree = dhxLayout.cells("f").attachTree();
    
    //    dhxGrid.setImagePath("../../../dhtmlxGrid/codebase/imgs/");
    //    dhxGrid.loadXML("../common/grid.xml?etc=" + new Date().getTime());
    dhxLayout.cells("e").setText("PROCEDENCIA"); //divc
    dhxLayout.cells("e").attachObject("div_Procedencia");
    //REVISAR INICIO
    
    //    dhxAccord = dhxLayout.cells("e").attachAccordion();
    //    
    //    
    //    dhxAccord.addItem("a1", "Parametro 1");
    //    dhxAccord.addItem("a2", "Parametro 2");
    //    dhxAccord.addItem("a3", "Parametro 3");
    //    dhxAccord.openItem("a1");
    //REVISAR FIN
    
    
    var Layout1 = new dhtmlXLayoutObject(dhxLayout.items[2], "6I");
    Layout1.cells("a").setText("SEDES"); 
    Layout1.cells("a").attachObject("div_SedesEmpresas");//divb
    ///
    
    var Layout2 = new dhtmlXLayoutObject(dhxLayout.items[0], "2U");
    Layout2.cells("a").setText("INTERVALO DE Tiempo"); 
    Layout2.cells("a").attachObject("div_Escala");
    //    Layout2.cells("a").setWidth(300);
    
    Layout2.cells("b").setText("GRAFICO"); 
    Layout2.cells("b").attachObject("div_Grafico");
    //    Layout2.items[1].attachObject("div_Grafico");
    // Height(300);
    
    
    //    var dhxWins= new dhtmlXWindows();
    //    dhxWins.setSkin("dhx_skyblue");
    //    dhxWins.setImagePath("../../../imagen/dhtmxwindows/imgs/");
    
    //    dhxGrid.setSkin("dhx_skyblue");
    //    dhxWins.setImagePath("../../../imagen/dhtmlxwindowsgrid/imgs/");
    
   
    
    //    dhxWins.setSkin(../../../img/ "dhx_skyblue");
    //    var win = dhxWins.createWindow(String id, int x, int y, int width, int height);
    
    
    //    var popupWindow = dhxLayout.dhxWins.createWindow("popupWindow");
    
    ////
    
    //    var popupWindow = Layout1.dhxWins.createWindow("popupWindow");
    

    //    var Layout2 = new dhtmlXLayoutObject(dhxLayout.items[6], "6I");
    //    dhxLayout.cells("a").attachObject("parentId");
    
    //    dhxLayout.items[0].setHeight(Number("1000"));
     

    
    //    dhxLayout.items[0].setWidth(2500);
    //    dhxLayout.items[0].setHeight(1500);
    
    //    dhxLayout.items["1"].setHeight(2600);
      
    
    
    //Codigo ABC
    
    //    dhxGrid.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    //    dhxGrid.setSkin("dhx_skyblue");




    //	INICIO
    //    var nombreExamen='%';
    //    var patronModulo='buscarExamenesLaboratorio';
    //    var parametros='';
    //    parametros+='p1='+patronModulo;
    //    parametros+='&p2='+nombreExamen;
    //    
    //    dhxGrid.setSkin("dhx_skyblue");
    //    dhxGrid.init();
    //    dhxGrid.loadXML(pathRequestControl+'?'+parametros);
    
    /////FIN
    
    indicadorLaboratorioClinicoListaAfiliaciones();
    indicadorLaboratorioClinicoListaProcedencia();
    indicadorLaboratorioClinicoListaSedes();
    
    
    
    
    var sede="0000000001";
    parametros="p1=arbolAreas2";
    parametros+="&p2="+sede;
    
    dhxTree.setSkin('dhx_skyblue');
    dhxTree.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    dhxTree.openAllItems(0);
    dhxTree.loadXML(pathRequestControl+'?'+parametros);
    
    
    
    
    //Fin de codigo ABC

    //    probandochart();
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //    dhxLayout.cells("a").setText("Main Page");
    //    dhxLayout.cells("b").setText("Site Navigation");
    //    dhxLayout.cells("c").setText("Support & Feedback");
    //    dhxLayout.cells("d").setText("Comments");
    
    //    var dhxWins,
    //    layoutWin,
    //    dhxLayout;
    //    dhxWins = new dhtmlXWindows();
    //    dhxWins.enableAutoViewport(false);
    //    dhxWins.attachViewportTo("winVP");
    //    dhxWins.setImagePath("../../../dhtmlxWindows/codebase/imgs/");
    //    dhxLayout = new dhtmlXLayoutObject(dhxWins.createWindow("w1", 20, 30, 600, 400), "3L");
    //    
    //     T.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    
}


function indicadorLaboratorioClinicoListaSedes(){
    var patronModulo='indicadorLaboratorioClinicoListaSedes';
    var parametros='';
    parametros+='p1='+patronModulo;
    orioClinicoListaSedes=new dhtmlXGridObject('div_ListadoSedesEmpresas');
    orioClinicoListaSedes.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    orioClinicoListaSedes.setSkin("dhx_terrace");
    orioClinicoListaSedes.enableRowsHover(true,'othercaso');
    
    orioClinicoListaSedes.attachEvent("onRowSelect", function(fila,columna){
        
        var IdSede=orioClinicoListaSedes.cells(fila,0).getValue();
        var Sede=orioClinicoListaSedes.cells(fila,1).getValue();
        var IdSedeCom= "afiliaciones"+IdSede;
   
        if (columna==2){ 
        
            var IdSede=orioClinicoListaSedes.cells(fila,0).getValue();
            var Sede=orioClinicoListaSedes.cells(fila,1).getValue();
            var IdSedeCom= "sedeee"+IdSede;
                   
            if ($('Sede').value.indexOf(IdSede+"|")!=-1) {
                alert('El filtro seleccionado ya se encuentra en el panel Sedes');
            }
            else {
                var para = document.getElementById("contenedorfiltros2lb");
                $('ContadorSede').value ++;
                $('con2lc').show();
                if ($('ContadorSede').value<=1){
                    $('Sede').value+= IdSede + '|';
                    var s ='<table cellSpacing="0" border="0" width="220" id='+IdSede+'><tr><td width="120"><font size="2"><UL type = square><LI>'+Sede+'</UL></font></td><td><center><a href="javascript:eliminarFiltroLaboratorioClinicoSede(\''+IdSede+'\')"><img src="../../../../fastmedical_front/imagen/icono/btn_cerrar_layer.png"></a></center></td></tr></table>';
                    var range = document.createRange();
                  
                    range.selectNode(document.body);
                    var documentFragment = range.createContextualFragment(s);
                    para.appendChild(documentFragment); 
                 
                }
                else{
                    alert("El maximo Nº de Sedes es 1");
                    $('ContadorSede').value =$('ContadorSede').value-1;            
                }
                
            }
  
            //            cargaraFiltroIndicadoresLaboratorioClinico(IdExamen,descripcionExamenes,'1');
        }
        
    });  
  
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    orioClinicoListaSedes.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    orioClinicoListaSedes.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    
    /////////////fin cargador ///////////////////////
   
    orioClinicoListaSedes.init();
    orioClinicoListaSedes.loadXML(pathRequestControl+'?'+parametros);  
 
    
    //    alert("entra");
    //    var patronModulo='indicadorLaboratorioClinicoListaAfiliaciones';
    //    var parametros='';
    //    parametros+='p1='+patronModulo;
    //   
    //    
    //    var dhxGrid = dhxLayout.cells("b").attachGrid();
    //    dhxGrid.setSkin("dhx_skyblue");
    //    dhxGrid.init();
    //    dhxGrid.loadXML(pathRequestControl+'?'+parametros); 
    //    alert("sale");
}



//function probandochart(){
//    alert("probandoChart");
//    
//    //    ../../../../carpetaDocumentos/arbol_centroCostos.xml
//    //    chart.load("some.xml", "xml");
//    
//    //    var chart =  new dhtmlXChart({
//    //        view: "bar",
//    //        container: "chart_container",
//    //        value: "#sales#",
//    //        label: "#year#"
//    //    });
//    //    
//    //    chart.load("../../../../carpetaDocumentos/some.xml", "xml");
//
//
//    var barChart = new dhtmlXChart({
//        view: "bar",
//        container: "chart_container",
//        value: "#sales#",
//        gradient: "falling",
//        color: "#b9a8f9",
//        radius: 0,
//        alpha: 0.5,
//        border: true,
//        width: 70
//    //        xAxis: {
//    //            template: "#year#";
//    //        },
//    //        yAxis: {
//    //            start: 0,
//    //            end: 100,
//    //            step: 10,
//    //            template: function(obj) {
//    //                return (obj % 20 ? "": obj);
//    //            }
//    //        }
//    });
//    alert("xml1");
//    barChart.load("../../../../carpetaDocumentos/some.xml");
//    alert("xml2");
//    
//
//    
//}

function layoutiniciadorExamenesdeLaboratorio(){
    
    var  dhxLayoutModuloExamenesLaboratorio= new dhtmlXLayoutObject("parentId1_MantenimientoExamenes", "3L","dhx_web");
    dhxLayoutModuloExamenesLaboratorio.cells("a").setText("Lista de Examenes"); 
    //    dhxLayoutModuloMaterialLaboratorio.cells("a").attachObject("parentId2_MateLab");
    
    dhxLayoutModuloExamenesLaboratorio.cells("a").attachObject("contenedor_Mantenimiento_Tabla_Examenes_Laboratorio");
    //    dhxLayoutModuloMaterialLaboratorio.cells("a").setWidth(430);
    dhxLayoutModuloExamenesLaboratorio.cells("a").setHeight(540);
    
    dhxLayoutModuloExamenesLaboratorio.cells("b").setText("Detalle del Examen");
    dhxLayoutModuloExamenesLaboratorio.cells("b").attachObject("contenedor_Detalle_del_Examen");
    //    dhxLayoutModuloMaterialLaboratorio.cells("b").setWidth(545);
    dhxLayoutModuloExamenesLaboratorio.cells("b").setHeight(220);
            
    dhxLayoutModuloExamenesLaboratorio.cells("c").setText("Precio de Examenes");
    dhxLayoutModuloExamenesLaboratorio.cells("c").attachObject("contenedor_TablaPreciosExamenesAfiliacion");
    //    dhxLayoutModuloMaterialLaboratorio.cells("c").setWidth(545);
    
    
    dhxLayoutModuloExamenesLaboratorio.cells("c").setHeight(320);
   
    
}

    
function layoutiniciadorMaterialesdeLaboratorio(){
    
    var  dhxLayoutModuloMaterialLaboratorio= new dhtmlXLayoutObject("parentId1_MateLab", "3L","dhx_web");
    dhxLayoutModuloMaterialLaboratorio.cells("a").setText("Lista de Materiales"); 
    //    dhxLayoutModuloMaterialLaboratorio.cells("a").attachObject("parentId2_MateLab");
    
    dhxLayoutModuloMaterialLaboratorio.cells("a").attachObject("contenedor_Materiales_De_Laboratorio");
    //    dhxLayoutModuloMaterialLaboratorio.cells("a").setWidth(430);
    dhxLayoutModuloMaterialLaboratorio.cells("a").setHeight(600);
    
    dhxLayoutModuloMaterialLaboratorio.cells("b").setText("Detalle del Material");
    dhxLayoutModuloMaterialLaboratorio.cells("b").attachObject("contenedor_Detalle_del_Material");
    //    dhxLayoutModuloMaterialLaboratorio.cells("b").setWidth(545);
    dhxLayoutModuloMaterialLaboratorio.cells("b").setHeight(425);
            
    dhxLayoutModuloMaterialLaboratorio.cells("c").setText("Unidades de Medida");
    dhxLayoutModuloMaterialLaboratorio.cells("c").attachObject("contenedor_Unidades_de_Medida");
    //    dhxLayoutModuloMaterialLaboratorio.cells("c").setWidth(545);
    
    
    dhxLayoutModuloMaterialLaboratorio.cells("c").setHeight(270);
    
    
}

function layoutiniciadorReporteIndicadorLaboratorioClinico(){
    
    var  dhxLayoutLaboratorioClinico = new dhtmlXLayoutObject("parentId1_laboratorioclinico", "6C","dhx_web");
    dhxLayoutLaboratorioClinico.cells("a").setText(""); 
    dhxLayoutLaboratorioClinico.cells("a").attachObject("parentId2_laboratorioclinico");
    dhxLayoutLaboratorioClinico.cells("b").setText("Examenes");
    //    dhxLayoutLaboratorioClinico.cells("b").attachObject("contenedorExamenes_LaboratorioClinico");
    dhxLayoutLaboratorioClinico.cells("c").setText("Sedes");
    dhxLayoutLaboratorioClinico.cells("c").attachObject("div_SedesEmpresas");

    dhxLayoutLaboratorioClinico.cells("d").setText("Procedencia");
    dhxLayoutLaboratorioClinico.cells("d").attachObject("div_Procedencia");
    dhxLayoutLaboratorioClinico.cells("e").setText("Afiliaciones"); 
    dhxLayoutLaboratorioClinico.cells("e").attachObject("div_Afiliaciones");
    dhxLayoutLaboratorioClinico.cells("f").setText("Materiales"); 
    //dhxLayoutLaboratorioClinico.cells("f").attachObject("div_MaterialesLaboratorio");
 
    dhxLayoutLaboratorioClinico.cells("b").setWidth(265);
    dhxLayoutLaboratorioClinico.cells("b").setHeight(700);//250
    dhxLayoutLaboratorioClinico.cells("c").setWidth(265);
    dhxLayoutLaboratorioClinico.cells("c").setHeight(150);
    dhxLayoutLaboratorioClinico.cells("d").setWidth(265);
    dhxLayoutLaboratorioClinico.cells("d").setHeight(200);
    
    dhxLayoutLaboratorioClinico.cells("e").setWidth(265);
    dhxLayoutLaboratorioClinico.cells("d").setHeight(200);
    dhxLayoutLaboratorioClinico.cells("f").setWidth(265);
    //segundo layout para la celda a
    var dhxLayoutLaboratorioClinico2 = new dhtmlXLayoutObject("parentId2_laboratorioclinico", "3T","dhx_web");
    dhxLayoutLaboratorioClinico2.cells("a").setText("Busqueda por Escala");
    dhxLayoutLaboratorioClinico2.cells("a").attachObject("contenedorEscalaLaboratorioClinico");
    dhxLayoutLaboratorioClinico2.cells("a").setHeight(120);
    dhxLayoutLaboratorioClinico2.cells("b").setText("Graficos");
    dhxLayoutLaboratorioClinico2.cells("b").attachObject("contenedormaestro_laboratorioClinico");
    dhxLayoutLaboratorioClinico2.cells("c").setText("Filtros")
    dhxLayoutLaboratorioClinico2.cells("c").attachObject("filtros_laboratorioClinico");
    dhxLayoutLaboratorioClinico2.cells("c").setWidth(220); 
       
    var Layout1 = new dhtmlXLayoutObject(dhxLayoutLaboratorioClinico.items[1], "2E");
    Layout1.cells("a").setText("Examen");
    Layout1.cells("a").attachObject("contenedorExamenes_LaboratorioClinico");
    Layout1.cells("a").setWidth(265);
    Layout1.cells("a").setHeight(200);
    
    Layout1.cells("b").setText("Punto de Control");
    Layout1.cells("b").attachObject("contenedorPuntoControlExamenes_LaboratorioClinico");
    Layout1.cells("b").setWidth(265);
    Layout1.cells("b").setHeight(200);
   
    var Layout2 = new dhtmlXLayoutObject(dhxLayoutLaboratorioClinico.items[5], "2E");
    Layout2.cells("a").setText("Materiales");
    Layout2.cells("a").attachObject("div_MaterialesLaboratorio");
    Layout2.cells("a").setWidth(265);
    Layout2.cells("a").setHeight(200);
    
    Layout2.cells("b").setText("Unidades Utilizadas");
    Layout2.cells("b").attachObject("div_UnidadesUtilizadasMaterialesLaboratorio");
    Layout2.cells("b").setWidth(265);
    Layout2.cells("b").setHeight(100);
    
    //carga de datos
    cargarEstadisticasLaboratorioClinico();
    indicadorLaboratorioClinicoListaSedes();
    indicadorLaboratorioClinicoListaProcedencia();
    indicadorLaboratorioClinicoListaAfiliaciones();
    indicadorLaboratorioClinicoListaExamenes();
    indicadorLaboratorioClinicoMaterialesLaboratorio();
  
}

function cargarEstadisticasLaboratorioClinico(){
    $('Dia2').show();
    $('Dia').show();
    $('Mes').hide();
    $('Year').hide();
    $('Mes2').hide();
    $('Year2').hide();
    $('Semestral').hide();
    $('YearSe').hide();
    $('Trimestral').hide();
    $('YearTre2').hide();
    $('Trimestral2').hide();
    $('YearTre').hide();
    $('Anual').hide();
    $('Semestral2').hide();
    $('YearSe2').hide();
    $('Anual2').hide();
    $('contenedorfiltros10lb').update('<img src="../../../imagen/graficos/bar.bmp">');
    $('grafico').value="bar";
    $('con1lc').hide();
    $('con1lc_jc').hide();
    $('con2lc').hide();
    $('con3lc').hide();
    $('con4lc').hide();
    $('con5lc').hide();
    //agregado
    $('con5lc_UM').hide();
    //fin
        
    $('con10lc').show();
       
    for (x=1;x<=50;x++){
        $("contenedorgraficotabla"+x).hide();
    }

}

//JCQA 26 octubre 2012
function verGraficosEstadisticosLaboratorioClinico(){
        
    if($('Examenes').value=="" && $('PuntoControl').value=="" && $('Sede').value=="" 
        && $('Procedencia').value=="" && $('Afiliaciones').value==""
        && $('Materiales').value=="" && $('UnidadMedida').value==""   ){
        alert("Escoja algunos datos para el filtro..!");
        
               
    }
    else {
        
        if(  ( $('Examenes').value !="" && $('PuntoControl').value !="" ) || $('Materiales').value !=""    ) 
        {
            //alert("Escoge un filtro de Punto de Control para el Examen");
            //break;
                
            //}// else if ()
        
        
      
            var tipografico=$('grafico').value;
            var numeroGrafico=$('numeroGraficos').value;
            var contenedorGrafico="contenedorGraficos"+numeroGrafico;
            var mostrarTablaCont="contenedorgraficotabla"+numeroGrafico;
      
            if (numeroGrafico==0){
                alert("El maximo de graficos soportados ha sido superado...recarge la pagina para volver(NOTA: Se perderan los graficos anteriores)");
            }
            else
            {
                $('Examenes.'+numeroGrafico).value=$('Examenes').value;
                $('Sede.'+numeroGrafico).value=$('Sede').value;
                $('Procedencia.'+numeroGrafico).value=$('Procedencia').value;
                $('Afiliaciones.'+numeroGrafico).value=$('Afiliaciones').value;
                $('Materiales.'+numeroGrafico).value=$('Materiales').value;
                $('PuntoControl.'+numeroGrafico).value=$('PuntoControl').value;
                $('UnidadMedida.'+numeroGrafico).value=$('UnidadMedida').value;
                        
                $('grafico.'+numeroGrafico).value= tipografico;
          
                $(mostrarTablaCont).show();
                $('numeroGraficos').value = $('numeroGraficos').value - 1;
           
                var Examenes=$('Examenes').value;
                var PuntoControl=$('PuntoControl').value;
                var Sede=$('Sede').value;
                var Procedencia=$('Procedencia').value;
                var Afiliaciones=$('Afiliaciones').value;
                var Materiales=$('Materiales').value;
                var UnidadMedida=$('UnidadMedida').value;
                        
                var patronModulo='estadisticasExamenesLaboratorioClinico';
                var parametros='';
                var opcion=$('comboEscala').value;
   
                switch (opcion){
                    case '1':
                        var fechaInicio=$('txtDia1').value;
                        var fechaFin=$('txtDia2').value;
                        var imesInicio=0;
                        var imesFin=0;
                        var iTrimestreInicio=0;
                        var iTrimestreFin=0;
                        var iSemestreInicio=0;
                        var iSemestreFin=0;
                        var ianioInicio=0;
                        var ianiofin=0;
                    
                                        
                    
                        break;
                    case '2':
                        var fechaInicio=0;
                        var fechaFin=0;
                        var imesInicio=$('cbxMes1').value;
                        var imesFin=$('cbxMes2').value;
                        var iTrimestreInicio=0;
                        var iTrimestreFin=0;
                        var iSemestreInicio=0;
                        var iSemestreFin=0;
                        var ianioInicio=$('txtYear1').value;
                        var ianiofin=$('txtYear2').value;
                        break;
                    case '3':
                        var fechaInicio=0;
                        var fechaFin=0;
                        var imesInicio=0;
                        var imesFin=0;
                        var iTrimestreInicio=$('trimestre1').value;
                        var iTrimestreFin=$('trimestre2').value;
                        var iSemestreInicio=0;
                        var iSemestreFin=0;
                        var ianioInicio=$('txtYearTre1').value;
                        var ianiofin=$('txtYearTre2').value;
                        break;
                    case '4':
                        var fechaInicio=0;
                        var fechaFin=0;
                        var imesInicio=0;
                        var imesFin=0;
                        var iTrimestreInicio=0;
                        var iTrimestreFin=0;
                        var iSemestreInicio=$('semestre1').value;
                        var iSemestreFin=$('semestre2').value;
                        var ianioInicio=$('txtYearSe1').value;
                        var ianiofin=$('txtYearSe2').value;
  
                        break;
                    case '5':
                        var fechaInicio=0;
                        var fechaFin=0;
                        var imesInicio=0;
                        var imesFin=0;
                        var iTrimestreInicio=0;
                        var iTrimestreFin=0;
                        var iSemestreInicio=0;
                        var iSemestreFin=0;
                        var ianioInicio=$('txtAnual1').value;
                        var ianiofin=$('txtAnual2').value;
                        break;
                }
                var prefijo=contenedorGrafico;
        
                parametros+='p1='+patronModulo;
                parametros+="&p2="+Examenes;
                parametros+="&p3="+Sede;
                parametros+="&p4="+Procedencia;
                parametros+="&p5="+Afiliaciones;
                parametros+="&p6="+PuntoControl;
            
                parametros+="&p7="+Materiales;
                parametros+="&p8="+UnidadMedida;
                     
                parametros+="&p11="+opcion;        
                parametros+="&p12="+fechaInicio;
                parametros+="&p13="+fechaFin;
                parametros+="&p14="+imesInicio;
                parametros+="&p15="+imesFin;
                parametros+="&p16="+iTrimestreInicio;
                parametros+="&p17="+iTrimestreFin;
                parametros+="&p18="+iSemestreInicio;
                parametros+="&p19="+iSemestreFin;
                parametros+="&p20="+ianioInicio;
                parametros+="&p21="+ianiofin;
                parametros+="&p22="+prefijo;
                parametros+="&p23="+tipografico;
                //            alert("parametros:"+parametros);
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
                        if (respuesta==1){
                            alert("La busqueda retorno dato vacios");
                        }
                        else {
                            $(mostrarTablaCont).show();
                            $('numeroGraficos').value = $('numeroGraficos').value - 1;
                            tablaLeyendaLaboratorioClinico(numeroGrafico);
                            eval(respuesta);
           
                        }
                  
                    }
                }
            )
   
            }
        }//aumentado    
    }//fin de else
  
}


function tablaLeyendaLaboratorioClinico(numeroGrafico){
    
    var opcion=$('comboEscala').value;
    var Examenes=$('Examenes').value;  
    var PuntoControl=$('PuntoControl').value;   
    var Sede=$('Sede').value;
    var Procedencia=$('Procedencia').value;
    var Afiliaciones=$('Afiliaciones').value;
    var Materiales=$('Materiales').value;
    var UnidadMedida=$('UnidadMedida').value;
    
    //    alert("procedencia"+Procedencia);

    switch (opcion){
        case '1':
            var fechaInicio=$('txtDia1').value;
            var fechaFin=$('txtDia2').value;
            var imesInicio=0;
            var imesFin=0;
            var iTrimestreInicio=0;
            var iTrimestreFin=0;
            var iSemestreInicio=0;
            var iSemestreFin=0;
            var ianioInicio=0;
            var ianiofin=0;
            break;
        case '2':
            var fechaInicio=0;
            var fechaFin=0;
            var imesInicio=$('cbxMes1').value;
            var imesFin=$('cbxMes2').value;
            var iTrimestreInicio=0;
            var iTrimestreFin=0;
            var iSemestreInicio=0;
            var iSemestreFin=0;
            var ianioInicio=$('txtYear1').value;
            var ianiofin=$('txtYear2').value;
            break;
        case '3':
            var fechaInicio=0;
            var fechaFin=0;
            var imesInicio=0;
            var imesFin=0;
            var iTrimestreInicio=$('trimestre1').value;
            var iTrimestreFin=$('trimestre2').value;
            var iSemestreInicio=0;
            var iSemestreFin=0;
            var ianioInicio=$('txtYearTre1').value;
            var ianiofin=$('txtYearTre2').value;
            break;
        case '4':
            var fechaInicio=0;
            var fechaFin=0;
            var imesInicio=0;
            var imesFin=0;
            var iTrimestreInicio=0;
            var iTrimestreFin=0;
            var iSemestreInicio=$('semestre1').value;
            var iSemestreFin=$('semestre2').value;
            var ianioInicio=$('txtYearSe1').value;
            var ianiofin=$('txtYearSe2').value;
            break;
        case '5':
            var fechaInicio=0;
            var fechaFin=0;
            var imesInicio=0;
            var imesFin=0;
            var iTrimestreInicio=0;
            var iTrimestreFin=0;
            var iSemestreInicio=0;
            var iSemestreFin=0;
            var ianioInicio=$('txtAnual1').value;
            var ianiofin=$('txtAnual2').value;
            break;
    }
    var patronModulo='TablaLeyendaGraficaLaboratorioClinico';
    var parametros='';
        
    parametros+='p1='+patronModulo;
    parametros+="&p2="+Examenes;
    parametros+="&p3="+Sede;
    parametros+="&p4="+Procedencia;
    parametros+="&p5="+Afiliaciones;    
    parametros+="&p6="+PuntoControl;
    
    parametros+="&p7="+Materiales;
    parametros+="&p8="+UnidadMedida;
    
    parametros+="&p11="+opcion;        
    parametros+="&p12="+fechaInicio;
    parametros+="&p13="+fechaFin;
    parametros+="&p14="+imesInicio;
    parametros+="&p15="+imesFin;
    parametros+="&p16="+iTrimestreInicio;
    parametros+="&p17="+iTrimestreFin;
    parametros+="&p18="+iSemestreInicio;
    parametros+="&p19="+iSemestreFin;
    parametros+="&p20="+ianioInicio;
    parametros+="&p21="+ianiofin;
 
    var contenedorLeyenda = 'contenedorTablaLeyenda'+numeroGrafico;
    $(contenedorLeyenda).show();
    document.getElementById(contenedorLeyenda).style.height='120';
    aLeyendaLabo=new dhtmlXGridObject(contenedorLeyenda);
    aLeyendaLabo.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    aLeyendaLabo.setSkin("dhx_terrace");
    aLeyendaLabo.enableRowsHover(true,'grid_hover');
    aLeyendaLabo.attachEvent("onRowSelect", function(rId,cInd){
    });  
    contadorCargador++;
    var idCargador=contadorCargador;
    aLeyendaLabo.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    aLeyendaLabo.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);;
    });
    aLeyendaLabo.setSkin("dhx_terrace");
    aLeyendaLabo.init();
    aLeyendaLabo.loadXML(pathRequestControl+'?'+parametros,function(){
    });   
}


function cargaraFiltroIndicadoresLaboratorioClinico(id,desc,cont){
    //Examenes
    if(cont=='1'){
        
        if ($('Examenes').value.indexOf(id+"|")!=-1) {
            alert('El filtro seleccionado ya se encuentra en el panel Examenes');
        }
        else {
 
            //            var cadExam=$('Examenes').value
            //            alert(cadExam);
            var para = document.getElementById("contenedorfiltros1lb");
            $('con1lc').show();
            var s ='<table cellSpacing="0" border="0" width="220" id='+id+'><tr><td width="120"><font size="1"><UL type = square><LI>'+desc+'</UL></font></td><td><center><a href="javascript:eliminarFiltroLaboratorioClinicoExamenes(\''+id+'\')"><img src="../../../../fastmedical_front/imagen/icono/btn_cerrar_layer.png"></a></center></td></tr></table>';
            var range = document.createRange();
            range.selectNode(document.body);
            var documentFragment = range.createContextualFragment(s);
            para.appendChild(documentFragment);  
            $('Examenes').value+= id + '|'; 
        }
    }
    
    //Sede
    if(cont=='2'){
        
        if ($('Sede').value.indexOf(id+"|")!=-1) {
            alert('El filtro seleccionado ya se encuentra en el panel Sedes');
        }
        else {
      
            var para = document.getElementById("contenedorfiltros2lb");
            $('con2lc').show();
            var s ='<table cellSpacing="0" border="0" width="220" id='+id+'><tr><td width="120"><font size="1"><UL type = square><LI>'+desc+'</UL></font></td><td><center><a href="javascript:eliminarFiltroLaboratorioClinicoSede(\''+id+'\')"><img src="../../../../fastmedical_front/imagen/icono/btn_cerrar_layer.png"></a></center></td></tr></table>';
            var range = document.createRange();
            range.selectNode(document.body);
            var documentFragment = range.createContextualFragment(s);
            para.appendChild(documentFragment);  
            $('Sede').value+= id + '|'; 
   
        }
    }
    //Procedencia
    if(cont=='3'){
      
        if ($('Procedencia').value.indexOf(id+"|")!=-1) {
            alert('El filtro seleccionado ya se encuentra en el panel Procedencias');
        }
        else {
 
            var para = document.getElementById("contenedorfiltros3lb");
            $('con3lc').show();
            var s ='<table cellSpacing="0" border="0" width="220" id='+id+'><tr><td width="120"><font size="1"><UL type = square><LI>'+desc+'</UL></font></td><td><center><a href="javascript:eliminarFiltroLaboratorioClinicoProcedencia(\''+id+'\')"><img src="../../../../fastmedical_front/imagen/icono/btn_cerrar_layer.png"></a></center></td></tr></table>';
            var range = document.createRange();
            range.selectNode(document.body);
            var documentFragment = range.createContextualFragment(s);
            para.appendChild(documentFragment);  
            $('Procedencia').value+= id + '|'; 
        }
    }

    //Afiliaciones
    if(cont=='4'){
      
        if ($('Afiliaciones').value.indexOf(id+"|")!=-1) {
            alert('El filtro seleccionado ya se encuentra en el panel Afiliaciones');
        }
        else {
      
            var para = document.getElementById("contenedorfiltros4lb");
            $('con4lc').show();
            var s ='<table cellSpacing="0" border="0" width="220" id='+id+'><tr><td width="120"><font size="1"><UL type = square><LI>'+desc+'</UL></font></td><td><center><a href="javascript:eliminarFiltroLaboratorioClinicoAfiliaciones(\''+id+'\')"><img src="../../../../fastmedical_front/imagen/icono/btn_cerrar_layer.png"></a></center></td></tr></table>';
            var range = document.createRange();
            range.selectNode(document.body);
            var documentFragment = range.createContextualFragment(s);
            para.appendChild(documentFragment);  
            $('Afiliaciones').value+= id + '|'; 
        }

    }
    
    if(cont=='5'){
        
        if ($('Materiales').value.indexOf(id+"|")!=-1) {
            alert('El filtro seleccionado ya se encuentra en el panel Materiales');
        }
        else {
 
            //            var cadExam=$('Examenes').value
            //            alert(cadExam);
            var para = document.getElementById("contenedorfiltros5lb");
            $('con5lc').show();
            var s ='<table cellSpacing="0" border="0" width="220" id='+id+'><tr><td width="120"><font size="1"><UL type = square><LI>'+desc+'</UL></font></td><td><center><a href="javascript:eliminarFiltroLaboratorioClinicoMateriales(\''+id+'\')"><img src="../../../../fastmedical_front/imagen/icono/btn_cerrar_layer.png"></a></center></td></tr></table>';
            var range = document.createRange();
            range.selectNode(document.body);
            var documentFragment = range.createContextualFragment(s);
            para.appendChild(documentFragment);  
            $('Materiales').value+= id + '|'; 
        }
    }
}

function eliminarFiltroLaboratorioClinicoExamenes(id){
    if(confirm('Esta Seguro Eliminar el Filtro seleccionado del Panel Examenes')){
        var nodoHijo = document.getElementById(id);
        var nodoPadre = nodoHijo.parentNode;
        nodoPadre.removeChild(nodoHijo);
        if ($('Examenes').value.indexOf(id+"|")!=-1) {
            $('Examenes').value = $('Examenes').value.replace(id+"|",'');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
        }
        if ($('Examenes').value.indexOf(id)!=-1) {
            $('Examenes').value = $('Examenes').value.replace("|"+id,'');//Eliminar de la cadena en el caso el elemento se encuentre al final
            $('Examenes').value = $('Examenes').value.replace(id,'');//Eliminar de la cadena en el caso solo haya uno
        }
        document.getElementById("Examenes").value = $('Examenes').value;
    }    
}


function eliminarFiltroLaboratorioClinicoPuntoControl(id){
    if(confirm('Esta Seguro Eliminar el Filtro seleccionado del Panel Punto de Control')){
        var nodoHijo = document.getElementById(id);
        var nodoPadre = nodoHijo.parentNode;
        nodoPadre.removeChild(nodoHijo);
        if ($('PuntoControl').value.indexOf(id+"|")!=-1) {
            $('PuntoControl').value = $('PuntoControl').value.replace(id+"|",'');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
        }
        if ($('PuntoControl').value.indexOf(id)!=-1) {
            $('PuntoControl').value = $('PuntoControl').value.replace("|"+id,'');//Eliminar de la cadena en el caso el elemento se encuentre al final
            $('PuntoControl').value = $('PuntoControl').value.replace(id,'');//Eliminar de la cadena en el caso solo haya uno
        }
        
        $('ContadorPuntoControl').value =   $('ContadorPuntoControl').value - 1;
        document.getElementById("PuntoControl").value = $('PuntoControl').value;
    }    
}



function eliminarFiltroLaboratorioClinicoMateriales(id){
    if(confirm('Esta Seguro Eliminar el Filtro seleccionado del Panel Materiales')){
        var nodoHijo = document.getElementById(id);
        var nodoPadre = nodoHijo.parentNode;
        nodoPadre.removeChild(nodoHijo);
        if ($('Materiales').value.indexOf(id+"|")!=-1) {
            $('Materiales').value = $('Materiales').value.replace(id+"|",'');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
        }
        if ($('Materiales').value.indexOf(id)!=-1) {
            $('Materiales').value = $('Materiales').value.replace("|"+id,'');//Eliminar de la cadena en el caso el elemento se encuentre al final
            $('Materiales').value = $('Materiales').value.replace(id,'');//Eliminar de la cadena en el caso solo haya uno
        }        
        $('ContadorMateriales').value =   $('ContadorMateriales').value - 1;
        document.getElementById("Materiales").value = $('Materiales').value;
    }    
}



function eliminarFiltroLaboratorioClinicoUnidadMedida(id){
    if(confirm('Esta Seguro Eliminar el Filtro seleccionado del Panel Unidad de Medida')){
        var nodoHijo = document.getElementById(id);
        var nodoPadre = nodoHijo.parentNode;
        nodoPadre.removeChild(nodoHijo);
        if ($('UnidadMedida').value.indexOf(id+"|")!=-1) {
            $('UnidadMedida').value = $('UnidadMedida').value.replace(id+"|",'');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
        }
        if ($('UnidadMedida').value.indexOf(id)!=-1) {
            $('UnidadMedida').value = $('UnidadMedida').value.replace("|"+id,'');//Eliminar de la cadena en el caso el elemento se encuentre al final
            $('UnidadMedida').value = $('UnidadMedida').value.replace(id,'');//Eliminar de la cadena en el caso solo haya uno
        }
        
        $('ContadorUnidadMedida').value = $('ContadorUnidadMedida').value - 1;
    
        document.getElementById("UnidadMedida").value = $('UnidadMedida').value;
    }    
}



function eliminarFiltroLaboratorioClinicoSede(id){
    if(confirm('Esta Seguro Eliminar el Filtro seleccionado del Panel Sedes')){
        var nodoHijo = document.getElementById(id);
        var nodoPadre = nodoHijo.parentNode;
        nodoPadre.removeChild(nodoHijo);
        if ($('Sede').value.indexOf(id+"|")!=-1) {
            $('Sede').value = $('Sede').value.replace(id+"|",'');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
        }
        if ($('Sede').value.indexOf(id)!=-1) {
            $('Sede').value = $('Sede').value.replace("|"+id,'');//Eliminar de la cadena en el caso el elemento se encuentre al final
            $('Sede').value = $('Sede').value.replace(id,'');//Eliminar de la cadena en el caso solo haya uno
        }
        $('ContadorSede').value =   $('ContadorSede').value - 1;
        document.getElementById("Sede").value = $('Sede').value;
    }    
}
function eliminarFiltroLaboratorioClinicoProcedencia(id){
    if(confirm('Esta Seguro Eliminar el Filtro seleccionado del Panel Procedencia')){
        var nodoHijo = document.getElementById(id);
        var nodoPadre = nodoHijo.parentNode;
        nodoPadre.removeChild(nodoHijo);
        if ($('Procedencia').value.indexOf(id+"|")!=-1) {
            $('Procedencia').value = $('Procedencia').value.replace(id+"|",'');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
        }
        if ($('Procedencia').value.indexOf(id)!=-1) {
            $('Procedencia').value = $('Procedencia').value.replace("|"+id,'');//Eliminar de la cadena en el caso el elemento se encuentre al final
            $('Procedencia').value = $('Procedencia').value.replace(id,'');//Eliminar de la cadena en el caso solo haya uno
        }
        $('ContadorProcedencia').value =   $('ContadorProcedencia').value - 1;
        document.getElementById("Procedencia").value = $('Procedencia').value;
    }    
}
function eliminarFiltroLaboratorioClinicoAfiliaciones(id){
    if(confirm('Esta Seguro Eliminar el Filtro seleccionado del Panel Afiliaciones')){
        var nodoHijo = document.getElementById(id);
        var nodoPadre = nodoHijo.parentNode;
        nodoPadre.removeChild(nodoHijo);
        if ($('Afiliaciones').value.indexOf(id+"|")!=-1) {
            $('Afiliaciones').value = $('Afiliaciones').value.replace(id+"|",'');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
        }
        if ($('Afiliaciones').value.indexOf(id)!=-1) {
            $('Afiliaciones').value = $('Afiliaciones').value.replace("|"+id,'');//Eliminar de la cadena en el caso el elemento se encuentre al final
            $('Afiliaciones').value = $('Afiliaciones').value.replace(id,'');//Eliminar de la cadena en el caso solo haya uno
        }
        $('ContadorAfiliacion').value =   $('ContadorAfiliacion').value - 1;
        document.getElementById("Afiliaciones").value = $('Afiliaciones').value;
    }    
}

function indicadorLaboratorioClinicoListaExamenes(){
    var patronModulo='indicadorLaboratorioClinicoListaExamenes';
    var parametros='';
    parametros+='p1='+patronModulo;
    tablaiindicadorLaboratorioClinicoListaExamenes=new dhtmlXGridObject('div_tablaExamenesIndicadores_LaboratorioClinico');
    tablaiindicadorLaboratorioClinicoListaExamenes.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaiindicadorLaboratorioClinicoListaExamenes.setSkin("dhx_terrace");
    tablaiindicadorLaboratorioClinicoListaExamenes.enableRowsHover(true,'othercaso');
    tablaiindicadorLaboratorioClinicoListaExamenes.attachEvent("onRowSelect", function(fila,columna){
        
        var IdExamenLaboratorio=tablaiindicadorLaboratorioClinicoListaExamenes.cells(fila,0).getValue();
        
        if(columna==2){
           
            reporteDePuntoControlXExamen_IndicadorLaboratorio(IdExamenLaboratorio);
     
        }
        
        if (columna==6){ 
           
            //            var IdExamenLaboratorio=tablaiindicadorLaboratorioClinicoListaExamenes.cells(fila,0).getValue();
            var descripcionExamenes=tablaiindicadorLaboratorioClinicoListaExamenes.cells(fila,2).getValue();
            var IdExamen= "examen"+IdExamenLaboratorio;
            if ($('Examenes').value.indexOf(IdExamenLaboratorio+"|")!=-1) {
                alert('El filtro seleccionado ya se encuentra en el panel Examenes');
            }
            else {
                var para = document.getElementById("contenedorfiltros1lb");
                $('ContadorExamen').value ++;
                $('con1lc').show();
                if ($('ContadorExamen').value<=3){
                    
                    //                    reporteDePuntoControlXExamen_IndicadorLaboratorio(IdExamenLaboratorio);
                                        
                    //fin agregado
                    $('Examenes').value+= IdExamenLaboratorio + '|';
                    var s ='<table cellSpacing="0" border="0" width="220" id='+IdExamenLaboratorio+'><tr><td width="120"><font size="2"><UL type = square><LI>'+descripcionExamenes+'</UL></font></td><td><center><a href="javascript:eliminarFiltroLaboratorioClinicoExamenes(\''+IdExamenLaboratorio+'\')"><img src="../../../../fastmedical_front/imagen/icono/btn_cerrar_layer.png"></a></center></td></tr></table>';
                    var range = document.createRange();
                  
                    range.selectNode(document.body);
                    var documentFragment = range.createContextualFragment(s);
                    para.appendChild(documentFragment); 
                 
                }
                else{
                    alert("El maximo de examenes es 3");
                    $('ContadorExamen').value =$('ContadorExamen').value-1            
                }
                
                
            }//fin del else
  
            //            cargaraFiltroIndicadoresLaboratorioClinico(IdExamen,descripcionExamenes,'1');
        }
    }

); 
  
    var filtroPeril = "<input type='text' id='idFiltroPerfil_indicadores' style='width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarExamenesLaboratorio_IndicadoresLaboClinico();\" />"; 
    var header = ["#text_filter", ,filtroPeril, ,"#select_filter"]; 	
    tablaiindicadorLaboratorioClinicoListaExamenes.attachHeader(header);
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaiindicadorLaboratorioClinicoListaExamenes.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaiindicadorLaboratorioClinicoListaExamenes.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    
    /////////////fin cargador ///////////////////////
   
    tablaiindicadorLaboratorioClinicoListaExamenes.init();
    tablaiindicadorLaboratorioClinicoListaExamenes.loadXML(pathRequestControl+'?'+parametros); 
       
}


//jcqa 15noviembre 2012

function reporteDePuntoControlXExamen_IndicadorLaboratorio(IdExamenLaboratorio){
    
    var patronModulo='reporteDePuntoControlXExamen_indicador';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+IdExamenLaboratorio;
    tablaPuntoControl_indicadorLaboratorioClinico=new dhtmlXGridObject('div_tablaPuntoControlExamenesIndicadores_LaboratorioClinico');
    tablaPuntoControl_indicadorLaboratorioClinico.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaPuntoControl_indicadorLaboratorioClinico.setSkin("dhx_terrace");
    tablaPuntoControl_indicadorLaboratorioClinico.enableRowsHover(true,'othercaso');
    tablaPuntoControl_indicadorLaboratorioClinico.attachEvent("onRowSelect", function(fila,columna){
     
        if (columna==4){ 
            var IdPuntoControl=tablaPuntoControl_indicadorLaboratorioClinico.cells(fila,0).getValue();
            var nombrePuntoControl=tablaPuntoControl_indicadorLaboratorioClinico.cells(fila,2).getValue();
            var IdExamen= "examen"+IdPuntoControl;
        
            if ($('PuntoControl').value.indexOf(IdPuntoControl+"|")!=-1) {
                alert('El filtro seleccionado ya se encuentra en el panel Punto de Control');
            }
            else {
                var para = document.getElementById("contenedorfiltros1lb_jc");
                $('ContadorPuntoControl').value ++;
                $('con1lc_jc').show();
                if ($('ContadorPuntoControl').value<=1){
            
                    $('PuntoControl').value+= IdPuntoControl + '|';
                    var s ='<table cellSpacing="0" border="0" width="220" id='+IdPuntoControl+'><tr><td width="120"><font size="2"><UL type = square><LI>'+nombrePuntoControl+'</UL></font></td><td><center><a href="javascript:eliminarFiltroLaboratorioClinicoPuntoControl(\''+IdPuntoControl+'\')"><img src="../../../../fastmedical_front/imagen/icono/btn_cerrar_layer.png"></a></center></td></tr></table>';
                    var range = document.createRange();
                  
                    range.selectNode(document.body);
                    var documentFragment = range.createContextualFragment(s);
                    para.appendChild(documentFragment); 
                 
                }
                else{
                    alert("El maximo Nº de Puntos de Control es 1");
                    $('ContadorPuntoControl').value =$('ContadorPuntoControl').value-1;            
                }
        
            }
  
            //            cargaraFiltroIndicadoresLaboratorioClinico(IdExamen,descripcionExamenes,'1');
        }
 
        
    });  
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaPuntoControl_indicadorLaboratorioClinico.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaPuntoControl_indicadorLaboratorioClinico.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaPuntoControl_indicadorLaboratorioClinico.init();
    tablaPuntoControl_indicadorLaboratorioClinico.loadXML(pathRequestControl+'?'+parametros, function(){
            
    });

}
	
function  indicadorLaboratorioClinicoMaterialesLaboratorio(){
    
    var patronModulo='indicadorLaboratorioClinicoMaterialesLaboratorio';
    var parametros='';
    parametros+='p1='+patronModulo;
    oMaterialesLaboratorio=new dhtmlXGridObject('div_ListadoMaterialesLaboratorio');
    oMaterialesLaboratorio.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    oMaterialesLaboratorio.setSkin("dhx_terrace");
    oMaterialesLaboratorio.enableRowsHover(true,'othercaso');
    oMaterialesLaboratorio.attachEvent("onRowSelect", function(fila,columna){
       
        var IdMat=oMaterialesLaboratorio.cells(fila,0).getValue();
        var descripcionExamenes=oMaterialesLaboratorio.cells(fila,1).getValue();
        //        var IdMaterialLa= "materiales"+IdMat;
                
        if(columna==1){                           
            reporteDeUnidadesUtilizadasxMaterialLaboratorio_IndicadorLaboratorio(IdMat);     
        }
   
      
        if(columna==2){
            if ($('Materiales').value.indexOf(IdMat+"|")!=-1) {
                alert('El filtro seleccionado ya se encuentra en el panel Materiales');
            }
            else {
                var para = document.getElementById("contenedorfiltros5lb");
                $('ContadorMateriales').value ++;
                $('con5lc').show();
                if ($('ContadorMateriales').value<=1){
            
                    $('Materiales').value+= IdMat + '|';
                    var s ='<table cellSpacing="0" border="0" width="220" id='+IdMat+'><tr><td width="120"><font size="2"><UL type = square><LI>'+descripcionExamenes+'</UL></font></td><td><center><a href="javascript:eliminarFiltroLaboratorioClinicoMateriales(\''+IdMat+'\')"><img src="../../../../fastmedical_front/imagen/icono/btn_cerrar_layer.png"></a></center></td></tr></table>';
                    var range = document.createRange();
                  
                    range.selectNode(document.body);
                    var documentFragment = range.createContextualFragment(s);
                    para.appendChild(documentFragment); 
                 
                }
                else{
                    alert("El maximo Nº de Materiales es 1");
                    $('ContadorMateriales').value =$('ContadorMateriales').value-1;            
                }
        
            }//fin del else
   
        }
   
   
        //        cargaraFiltroIndicadoresLaboratorioClinico(IdMat,descripcionExamenes,'5');
        
        
        
        
    }); 
    var header = [, "#text_filter"]; 	
    oMaterialesLaboratorio.attachHeader(header);
    contadorCargador++;
    var idCargador=contadorCargador;
    oMaterialesLaboratorio.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    oMaterialesLaboratorio.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });   
    oMaterialesLaboratorio.init();
    oMaterialesLaboratorio.loadXML(pathRequestControl+'?'+parametros);  
}


function reporteDeUnidadesUtilizadasxMaterialLaboratorio_IndicadorLaboratorio(IdMat){
    
    var patronModulo='reporteDeUnidadesUtilizadasxMaterialLaboratorio_IndicadorLaboratorio';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+IdMat;
    tablaUnidadesUtilizadas_indicadorLaboratorioClinico=new dhtmlXGridObject('div_UnidadesUtilizadasMaterialesLaboratorio_tabla');
    tablaUnidadesUtilizadas_indicadorLaboratorioClinico.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaUnidadesUtilizadas_indicadorLaboratorioClinico.setSkin("dhx_terrace");
    tablaUnidadesUtilizadas_indicadorLaboratorioClinico.enableRowsHover(true,'othercaso');
    tablaUnidadesUtilizadas_indicadorLaboratorioClinico.attachEvent("onRowSelect", function(fila,columna){
        if (columna==2){ 
           
            var IdUnidadMedida=tablaUnidadesUtilizadas_indicadorLaboratorioClinico.cells(fila,0).getValue();
            var nombreUnidadMedida=tablaUnidadesUtilizadas_indicadorLaboratorioClinico.cells(fila,1).getValue();
            //            var IdExamen= "examen"+IdPuntoControl;
        
            if ($('UnidadMedida').value.indexOf(IdUnidadMedida+"|")!=-1) {
                alert('El filtro seleccionado ya se encuentra en el panel Unidad de Medida');
            }
            else {
                var para = document.getElementById("contenedorfiltros5lb_UM");
                $('ContadorUnidadMedida').value ++;
                $('con5lc_UM').show();
                if ($('ContadorUnidadMedida').value<=1){
            
                    $('UnidadMedida').value+= IdUnidadMedida + '|';
                    var s ='<table cellSpacing="0" border="0" width="220" id='+IdUnidadMedida+'><tr><td width="120"><font size="2"><UL type = square><LI>'+nombreUnidadMedida+'</UL></font></td><td><center><a href="javascript:eliminarFiltroLaboratorioClinicoUnidadMedida(\''+IdUnidadMedida+'\')"><img src="../../../../fastmedical_front/imagen/icono/btn_cerrar_layer.png"></a></center></td></tr></table>';
                    var range = document.createRange();
                  
                    range.selectNode(document.body);
                    var documentFragment = range.createContextualFragment(s);
                    para.appendChild(documentFragment); 
                 
                }
                else{
                    alert("El maximo Nº de Unidades de Medida es 1");
                    $('ContadorUnidadMedida').value =$('ContadorUnidadMedida').value-1;            
                }
        
            }//fin del else
  
            //            cargaraFiltroIndicadoresLaboratorioClinico(IdExamen,descripcionExamenes,'1');
        }
 
        
    });  
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaUnidadesUtilizadas_indicadorLaboratorioClinico.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaUnidadesUtilizadas_indicadorLaboratorioClinico.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaUnidadesUtilizadas_indicadorLaboratorioClinico.init();
    tablaUnidadesUtilizadas_indicadorLaboratorioClinico.loadXML(pathRequestControl+'?'+parametros, function(){
            
    });

}


function indicadorLaboratorioClinicoListaProcedencia(){
    
    var patronModulo='indicadorLaboratorioClinicoListaProcedencia';
    var parametros='';
    parametros+='p1='+patronModulo;
    tablaiindicadorLaboratorioClinicoListaProcedencia=new dhtmlXGridObject('div_ListadoProcedencia');
    tablaiindicadorLaboratorioClinicoListaProcedencia.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaiindicadorLaboratorioClinicoListaProcedencia.setSkin("dhx_terrace");//dhx_skyblue
    tablaiindicadorLaboratorioClinicoListaProcedencia.enableRowsHover(true,'othercaso');
    
    tablaiindicadorLaboratorioClinicoListaProcedencia.attachEvent("onRowSelect", function(fila,columna){
   
        if (columna==2){ 
            
            var idProcedencia=tablaiindicadorLaboratorioClinicoListaProcedencia.cells(fila,0).getValue();
            var descripcionProcedencia=tablaiindicadorLaboratorioClinicoListaProcedencia.cells(fila,1).getValue();
    
            if ($('Procedencia').value.indexOf(idProcedencia+"|")!=-1) {
                alert('El filtro seleccionado ya se encuentra en el panel Procedencia');
            }
            else {
                var para = document.getElementById("contenedorfiltros3lb");
                $('ContadorProcedencia').value ++;
                $('con3lc').show();
                if ($('ContadorProcedencia').value<=1){
            
                    $('Procedencia').value+= idProcedencia + '|';
                    var s ='<table cellSpacing="0" border="0" width="220" id='+idProcedencia+'><tr><td width="120"><font size="2"><UL type = square><LI>'+descripcionProcedencia+'</UL></font></td><td><center><a href="javascript:eliminarFiltroLaboratorioClinicoProcedencia(\''+idProcedencia+'\')"><img src="../../../../fastmedical_front/imagen/icono/btn_cerrar_layer.png"></a></center></td></tr></table>';
                    var range = document.createRange();
                  
                    range.selectNode(document.body);
                    var documentFragment = range.createContextualFragment(s);
                    para.appendChild(documentFragment); 
                 
                }
                else{
                    alert("El maximo Nº de Procedencia es 1");
                    $('ContadorProcedencia').value =$('ContadorProcedencia').value-1;            
                }
        
            }
  
            //            cargaraFiltroIndicadoresLaboratorioClinico(IdExamen,descripcionExamenes,'1');
        }
 
        
    });  
     
    //    cargaraFiltroIndicadoresLaboratorioClinico(IdProcede,descripcionProcedencia,'3');
   
    //        seleccionarPuntoControl(fila,columna);
        
    //});  
    
   
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaiindicadorLaboratorioClinicoListaProcedencia.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaiindicadorLaboratorioClinicoListaProcedencia.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    
    /////////////fin cargador ///////////////////////
   
    tablaiindicadorLaboratorioClinicoListaProcedencia.init();
    tablaiindicadorLaboratorioClinicoListaProcedencia.loadXML(pathRequestControl+'?'+parametros);  
   
}


function indicadorLaboratorioClinicoListaAfiliaciones(){
    var patronModulo='indicadorLaboratorioClinicoListaAfiliaciones';
    var parametros='';
    parametros+='p1='+patronModulo;
    tablaindicadorLaboratorioClinicoListaAfiliaciones=new dhtmlXGridObject('div_ListadoAfiliaciones');
    tablaindicadorLaboratorioClinicoListaAfiliaciones.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaindicadorLaboratorioClinicoListaAfiliaciones.setSkin("dhx_terrace");
    tablaindicadorLaboratorioClinicoListaAfiliaciones.enableRowsHover(true,'othercaso');
    
    tablaindicadorLaboratorioClinicoListaAfiliaciones.attachEvent("onRowSelect", function(fila,columna){

        
        if (columna==2){
            
            var IdAfiliacion=tablaindicadorLaboratorioClinicoListaAfiliaciones.cells(fila,0).getValue();
            var descripcionAfiliacion=tablaindicadorLaboratorioClinicoListaAfiliaciones.cells(fila,1).getValue();
        
    
            if ($('Afiliaciones').value.indexOf(IdAfiliacion+"|")!=-1) {
                alert('El filtro seleccionado ya se encuentra en el panel Afiliaciones');
            }
            else {
                var para = document.getElementById("contenedorfiltros4lb");
                $('ContadorAfiliacion').value ++;
                $('con4lc').show();
                if ($('ContadorAfiliacion').value<=1){
            
                    $('Afiliaciones').value+= IdAfiliacion + '|';
                    var s ='<table cellSpacing="0" border="0" width="220" id='+IdAfiliacion+'><tr><td width="120"><font size="2"><UL type = square><LI>'+descripcionAfiliacion+'</UL></font></td><td><center><a href="javascript:eliminarFiltroLaboratorioClinicoAfiliaciones(\''+IdAfiliacion+'\')"><img src="../../../../fastmedical_front/imagen/icono/btn_cerrar_layer.png"></a></center></td></tr></table>';
                    var range = document.createRange();
                  
                    range.selectNode(document.body);
                    var documentFragment = range.createContextualFragment(s);
                    para.appendChild(documentFragment); 
                 
                }
                else{
                    alert("El maximo Nº de Afiliaciones es 1");
                    $('ContadorAfiliacion').value =$('ContadorAfiliacion').value-1;            
                }
        
            }
  
        }
        
    });  
  
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaindicadorLaboratorioClinicoListaAfiliaciones.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaindicadorLaboratorioClinicoListaAfiliaciones.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    
    /////////////fin cargador ///////////////////////
   
    tablaindicadorLaboratorioClinicoListaAfiliaciones.init();
    tablaindicadorLaboratorioClinicoListaAfiliaciones.loadXML(pathRequestControl+'?'+parametros);  
 
}


//JCQA 28septiembre2012
function MostrarMuestrasSeleccionadosXpuntoControlExamenLabo(){
    
    //    alert(MostrarMuestrasSeleccionadosXpuntoControlExamenLabo);
      
    var hidPuntoControlExamenLab=$('hidPuntoControlExamenLab').value;

    var patronModulo='MostrarMuestrasSeleccionadosXpuntoControlExamenLabo';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+hidPuntoControlExamenLab;
    
    var destino="div_MostrarMuestrasSeleccionadosXpuntoControlExamenLabo";
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargador),
        onComplete : function(transport){
            cargadorpeche(0,idCargador);
            var respuesta = transport.responseText;
            if(destino!="") $(destino).update(respuesta);
            acordionHistorialjc_Muestras();
                          
        }
    }
		
)
 
}

//jcqa 27dic2012  cambiarGrafico
function cambiarGraficoLaboratorioClinico(){
    abrirPopapOpcionesLaboratorioClinico('10');
}

function abrirPopapOpcionesLaboratorioClinico(id){
    switch (id){
        case '1':
            posFuncion = "";
            vtitle='';
            vformname='propiedadesPopadEstado';
            vwidth='150';
            vheight='170';
            patronModulo='propiedadesPopadEstado';
            vcenter='t';
            vresizable='';
            vmodal='false';
            vstyle='';
            vopacity='';
            veffect='';
            vposx1='';
            vposx2='';
            vposy1='';
            vposy2='';
            parametros='';
            parametros+='p1='+patronModulo;
            this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion); 
            break;
        case '2':
            posFuncion = "";
            vtitle='';
            vformname='propiedadesPopadMedicos';
            vwidth='696';
            vheight='440';
            patronModulo='propiedadesPopadMedicos';
            vcenter='t';
            vresizable='';
            vmodal='false';
            vstyle='';
            vopacity='';
            veffect='';
            vposx1='';
            vposx2='';
            vposy1='';
            vposy2='';
            parametros='';
            parametros+='p1='+patronModulo;
            this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion); 
            
            break;
        case '3':
            posFuncion = "cargarTablaServicio()";
            vtitle='';
            vformname='propiedadesPopadServicios';
            vwidth='350;';
            vheight='440';
            patronModulo='propiedadesPopadServicios';
            vcenter='t';
            vresizable='';
            vmodal='false';
            vstyle='';
            vopacity='';
            veffect='';
            vposx1='';
            vposx2='';
            vposy1='';
            vposy2='';
            parametros='';
            parametros+='p1='+patronModulo;
            this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion); 
           
            
            break;
        case '4':
            posFuncion = "cargarTablaAmbiLo()";
            vtitle='';
            vformname='propiedadesPopadAmbiL';
            vwidth='350';
            vheight='440';
            patronModulo='propiedadesPopadAmbiL';
            vcenter='t';
            vresizable='';
            vmodal='false';
            vstyle='';
            vopacity='';
            veffect='';
            vposx1='';
            vposx2='';
            vposy1='';
            vposy2='';
            parametros='';
            parametros+='p1='+patronModulo;
            this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion); 
            
            break; 
        case '5':
            posFuncion = "cargarTablaAmbiFi()";
            vtitle='';
            vformname='propiedadesPopadAmbiF';
            vwidth='350';
            vheight='440';
            patronModulo='propiedadesPopadAmbiF';
            vcenter='t';
            vresizable='';
            vmodal='false';
            vstyle='';
            vopacity='';
            veffect='';
            vposx1='';
            vposx2='';
            vposy1='';
            vposy2='';
            parametros='';
            parametros+='p1='+patronModulo;
            this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion); 
            break;
        case '6':
            posFuncion = "cargarTablaSedes()";
            vtitle='';
            vformname='PopadSedes';
            vwidth='200';
            vheight='250';
            patronModulo='PopadSedes';
            vcenter='t';
            vresizable='';
            vmodal='false';
            vstyle='';
            vopacity='';
            veffect='';
            vposx1='';
            vposx2='';
            vposy1='';
            vposy2='';
            parametros='';
            parametros+='p1='+patronModulo;
            this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion); 
            
            break;
        case '7':
            posFuncion = "";
            vtitle='';
            vformname='cargarPopadTurnos';
            vwidth='150';
            vheight='170';
            patronModulo='cargarPopadTurnos';
            vcenter='t';
            vresizable='';
            vmodal='false';
            vstyle='';
            vopacity='';
            veffect='';
            vposx1='';
            vposx2='';
            vposy1='';
            vposy2='';
            parametros='';
            parametros+='p1='+patronModulo;
            this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion); 
            
            break;
        case '8':
            posFuncion = "";
            vtitle='';
            vformname='propiedadesPopadAtencion';
            vwidth='170';
            vheight='140';
            patronModulo='propiedadesPopadAtencion';
            vcenter='t';
            vresizable='';
            vmodal='false';
            vstyle='';
            vopacity='';
            veffect='';
            vposx1='';
            vposx2='';
            vposy1='';
            vposy2='';
            parametros='';
            parametros+='p1='+patronModulo;
            this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion); 
            break;
        case '9':
            posFuncion = "";
            vtitle='';
            vformname='propiedadesPopadProgramacion';
            vwidth='170';
            vheight='140';
            patronModulo='propiedadesPopadProgramacion';
            vcenter='t';
            vresizable='';
            vmodal='false';
            vstyle='';
            vopacity='';
            veffect='';
            vposx1='';
            vposx2='';
            vposy1='';
            vposy2='';
            parametros='';
            parametros+='p1='+patronModulo;
            this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion); 
            break;
        case '10':
            posFuncion = "verGraficosEstadisticosInicioLaboratorioClinico";
            vtitle='';
            vformname='CatalogodeGraficos';
            vwidth='1080';
            vheight='250';
            patronModulo='CatalogodeGraficosLaboratorioClinico';
            vcenter='t';
            vresizable='';
            vmodal='false';
            vstyle='';
            vopacity='';
            veffect='';
            vposx1='';
            vposx2='';
            vposy1='';
            vposy2='';
            parametros='';
            parametros+='p1='+patronModulo;
            this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion); 
            break;
    }
}

function verGraficosEstadisticosInicioLaboratorioClinico(){
    var patronModulo='cargarEstadisticasAjax';
    var parametros='';
    parametros+='p1='+patronModulo;
    contadorCargador++;
    var idCargadoragregar=contadorCargador;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        asynchronous:false, 
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargadoragregar),
        onComplete : function(transport){
            cargadorpeche(0,idCargadoragregar);
            var respuesta = transport.responseText;
            eval(respuesta);
            var barChart1=new dhtmlXChart({
                view:"pie",
                container:"chart_container1",
                value:"#sales#",
                radius:0,
                border:true,
                xAxis:{
                    template:"'#year#"
                },
                yAxis:{
                    start:0,
                    end:100,
                    step:1000,
                    template:function(obj){
                        return(obj%20?"":obj)
                    }
                }
            });
                      
            var barChart5=new dhtmlXChart({
                view:"bar",
                container:"chart_container5",
                value:"#sales#",
                radius:0,
                border:true,
                xAxis:{
                    template:"'#year#"
                },
                yAxis:{
                    start:0,
                    end:100,
                    step:10,
                    template:function(obj){
                        return(obj%20?"":obj)
                    }
                }
            });
                        
            barChart1.parse(dataset,"json");//2da imagen
            barChart5.parse(dataset,"json");//1era imagen
             
        }
    } )
    cargarSkaterBar();
}


function agregaropcionCatalogoGraficoLaboratorioClinico(id){
    switch (id){
        case 1:
            $('contenedorfiltros10lb').update('<img src="../../../imagen/graficos/pie.bmp">')
            $('grafico').value="pie";
            break;
        case 6:
            $('contenedorfiltros10lb').update('<img src="../../../imagen/graficos/bar.bmp">')
            $('grafico').value="bar";
            break;
        case 12:
            $('contenedorfiltros10lb').update('<img src="../../../imagen/graficos/stackedBar.bmp">')
            $('grafico').value="stackedBar";
            break;
   
    }
    Windows.close("Div_CatalogodeGraficos");
}



//fin 27dic2012


//JCQA 26 Septiembre 2012

function acordionHistorialjc(){
    var cadenaAcordion=$('textAcordionMaterialesxPuntoControlxExamenLabo').value;
    //    var cadenaAcordion='';
    //    cadenaAcordion+='Material1*Material Uno';
    //    cadenaAcordion+='|Material2*Material dos';
      
    // alert("Cadenas:"+cadenaAcordion);
    var arrayAcordion=cadenaAcordion.split("|");
    
    //    var arrayAcordion = new Array();
    //    arrayAcordion[0] = "Material1*Material Uno";
       
    var numeroAcordion=arrayAcordion.length;
       
    //    var idItem;
    //    var nombreItem;
    //    var dhxAccord;
     
    var dhxAccordjc = new dhtmlXAccordion("contenedorAcordionjc");
    //       dhxAccordjc.enableMultiMode();
    for (var i=0;i<numeroAcordion;i++){
        var datosItemjc=arrayAcordion[i].split("*");
        var datosItemjcc=datosItemjc[1].split("#");
        
        datosItemjcc[1]='<b><font color=#2239E5>'+datosItemjcc[1]+'</font></b>';
        
        var acordionjc='jose'+i;
        dhxAccordjc.addItem(acordionjc,datosItemjcc[0]+'  '+datosItemjcc[1] );
        dhxAccordjc.cells(acordionjc).attachObject(datosItemjc[0]);
    } 
        
    //    dhxAccordjc.addItem("a1", "Comments");
    //    dhxAccordjc.addItem("a2", "Site Navigation");
    
    dhxAccordjc.openItem('jose0');

}

//creado JCQA 28 septiembre2012
function acordionHistorialjc_Muestras(){
    var cadenaAcordionMuestra=$('textAcordionMuestrasxPuntoControlxExamenLabo').value;
 
    //alert("CadenasMuestra:"+cadenaAcordionMuestra);
    var arrayAcordionMuestra=cadenaAcordionMuestra.split("|");
    //alert(cadenaAcordionMuestra)
    var numeroAcordionMuestra=arrayAcordionMuestra.length;
    
    dhxAccordjcMuestra = new dhtmlXAccordion("contenedorAcordionjc2");
    //       dhxAccordjc.enableMultiMode();
    for (var i=0;i<numeroAcordionMuestra;i++){
        datosItemjcMuestra=arrayAcordionMuestra[i].split("*");
        datosItemjcc2=datosItemjcMuestra[1].split("#");
        datosItemjcc2[1]='<b><font color=#F41D1D>'+datosItemjcc2[1]+'</font></b>';
        
        acordionjcMuestra='muestras'+i;
        dhxAccordjcMuestra.addItem(acordionjcMuestra,datosItemjcc2[0]+'  '+datosItemjcc2[1] );
        //        datosItemjcMuestra[0]='<b>'+datosItemjcMuestra[0]+'</b>';
        dhxAccordjcMuestra.cells(acordionjcMuestra).attachObject(datosItemjcMuestra[0]);
    } 
   
    dhxAccordjcMuestra.openItem('muestras0');

}


//credado 30 segpitm 2012 jcqa
function EditarItemMuestrasAlmacenados(idMuestraPuntoControlLaboratorio){
    
    //    alert('es:'+idMuestraPuntoControlLaboratorio);
    
   
    $('cboTipoUnidadMedidaMuestraSeleccionada'+idMuestraPuntoControlLaboratorio.trim()).disabled=false;
    $('cboUnidadMedidaMuestraSeleccionada'+idMuestraPuntoControlLaboratorio.trim()).disabled=false;
    $('txtCantidadMaximaMuestraSeleccionada'+idMuestraPuntoControlLaboratorio.trim()).readOnly=false;
    $('txtCantidadMinimaMuestraSeleccionada'+idMuestraPuntoControlLaboratorio.trim()).readOnly=false;
    
}

function EliminarItemMuestraAlmacenados(idMuestraPuntoControlLaboratorio){
    var idMuestraPuntoControlLaboratorio=document.getElementById('idMuestraPuntoControlLaboratorio'+idMuestraPuntoControlLaboratorio.trim()).value;
       
    //    alert('idMuestraPuntoControlLaboratorio:'+idMuestraPuntoControlLaboratorio);
    
    parametros='';
    parametros+='p1=EliminarItemMuestraAlmacenados';
    parametros+='&p2='+idMuestraPuntoControlLaboratorio;
        
    var datosxxx=traerDataPrueba(parametros);
    if(datosxxx[0].trim()=='ok'){
                
        alert("Se elimino exitosamente");
          
    }
    
    
    
    
}

function ActualizarItemMuestraAlmacenados(cboTipoUnidadMedidaMuestraSeleccionada,cboUnidadMedidaMuestraSeleccionada,
txtCantidadMaximaMuestraSeleccionada,txtCantidadMinimaMuestraSeleccionada,    idMuestraPuntoControlLaboratorio){
    
    //    alert(cboTipoUnidadMedidaMuestraSeleccionada+'/'+cboUnidadMedidaMuestraSeleccionada+'/'+txtCantidadMaximaMuestraSeleccionada+
    //        '/'+txtCantidadMinimaMuestraSeleccionada+'/'+idMuestraPuntoControlLaboratorio);
    //    
    if(cboTipoUnidadMedidaMuestraSeleccionada!='x' && cboUnidadMedidaMuestraSeleccionada!='x' && idMuestraPuntoControlLaboratorio !=''){
    
        parametros='';
        //    parametros+='p1=ActualizarItemMaterialesAlmacenados';
        parametros+='p1=ActualizarItemMuestraAlmacenados';
        parametros+='&p2='+cboTipoUnidadMedidaMuestraSeleccionada;
        parametros+='&p3='+cboUnidadMedidaMuestraSeleccionada;
        parametros+='&p4='+txtCantidadMaximaMuestraSeleccionada;
        parametros+='&p5='+txtCantidadMinimaMuestraSeleccionada;
        parametros+='&p6='+idMuestraPuntoControlLaboratorio;
       
        var datosxxx=traerDataPrueba(parametros);
        if(datosxxx[0].trim()=='ok'){
                
            $('cboTipoUnidadMedidaMuestraSeleccionada'+idMuestraPuntoControlLaboratorio.trim()).disabled=true;
            $('cboUnidadMedidaMuestraSeleccionada'+idMuestraPuntoControlLaboratorio.trim()).disabled=true;
            $('txtCantidadMaximaMuestraSeleccionada'+idMuestraPuntoControlLaboratorio.trim()).readOnly=true;
            $('txtCantidadMinimaMuestraSeleccionada'+idMuestraPuntoControlLaboratorio.trim()).readOnly=true;
            alert("Se actualizo exitosamente");   
   
        }
    
    }
    
}
    
  



function cargarTablaUnidadesxTipoxMaterialLaboratorio(idMaterialLaboratorio){
    
    //    alert("unidad");

    //alert("hola")
    var patronModulo='cargarTablaUnidadesxTipoxMaterialLaboratorio';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idMaterialLaboratorio;
    //    parametros+='&p3='+idTipoDatos;
    TablaUnidadesxTipoxMaterialLaboratorioME=new dhtmlXGridObject('Div_TablaUnidadesxTipoxMaterialLaboratorio');
    TablaUnidadesxTipoxMaterialLaboratorioME.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    TablaUnidadesxTipoxMaterialLaboratorioME.setSkin("dhx_skyblue");
    TablaUnidadesxTipoxMaterialLaboratorioME.enableRowsHover(true,'grid_hover');
 
    var filtroPeril = "<input type='text' id='idFiltroPerfil' style='width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarFiltrarMaterialesLaboratorio();\" />"; 
    var header = ["#text_filter", ,filtroPeril, ,"#select_filter",  ,"#select_filter","#select_filter"]; 	
    //8 campos
    TablaUnidadesxTipoxMaterialLaboratorioME.attachHeader(header);

    TablaUnidadesxTipoxMaterialLaboratorioME.attachFooter(" ,  ,   ,Nº ,   ,#stat_count");
    //      tablaMaterialesDeLaboratorioME.attachFooter(" ,  ,   ,Nº ,   ,#stat_count");
    
  
    TablaUnidadesxTipoxMaterialLaboratorioME.attachEvent("onRowSelect",
  
    function(fil,col){
          
        //            alert("unidades de medida");
     

    }  
       
);
    
 
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    TablaUnidadesxTipoxMaterialLaboratorioME.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    TablaUnidadesxTipoxMaterialLaboratorioME.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    
    /////////////fin cargador ///////////////////////
    
    
    
    TablaUnidadesxTipoxMaterialLaboratorioME.setSkin("dhx_skyblue");
    TablaUnidadesxTipoxMaterialLaboratorioME.init();
    TablaUnidadesxTipoxMaterialLaboratorioME.loadXML(pathRequestControl+'?'+parametros, function(){
      
        //        setColortablaExamenesLaboratorio();
        setColorTablaUnidadesxTipoxMaterialLaboratorio();
        
    });
   
}

function setColorTablaUnidadesxTipoxMaterialLaboratorio(){
  
    //alert("entro al setcolor")
      
    for(i=0;i<TablaUnidadesxTipoxMaterialLaboratorioME.getRowsNum();i++){
       
        var tipoUnidadMedida = TablaUnidadesxTipoxMaterialLaboratorioME.cells(i,8).getValue();
   
        switch(tipoUnidadMedida.trim()){
           
            case '1':
                TablaUnidadesxTipoxMaterialLaboratorioME.setRowTextStyle(TablaUnidadesxTipoxMaterialLaboratorioME.getRowId(i) ,'background-color:#ABF936;color:black;border-top: 1px solid #DAEFC2;');
            
                ;
                break;

            case '2':
                TablaUnidadesxTipoxMaterialLaboratorioME.setRowTextStyle(TablaUnidadesxTipoxMaterialLaboratorioME.getRowId(i) ,'background-color:#8779F2;color:black;border-top: 1px solid #FFD7BB;');
                ;
                break
            
            case '3':
                TablaUnidadesxTipoxMaterialLaboratorioME.setRowTextStyle(TablaUnidadesxTipoxMaterialLaboratorioME.getRowId(i) ,'background-color:#E4EA35;color:black;border-top: 1px solid #DAEFC2;');
            
                ;
                break;
            
            case '4':
                TablaUnidadesxTipoxMaterialLaboratorioME.setRowTextStyle(TablaUnidadesxTipoxMaterialLaboratorioME.getRowId(i) ,'background-color:#C3BAD8;color:black;border-top: 1px solid #FFD7BB;');
                ;
                break
            
            case '5':
                TablaUnidadesxTipoxMaterialLaboratorioME.setRowTextStyle(TablaUnidadesxTipoxMaterialLaboratorioME.getRowId(i) ,'background-color:#637AF9;color:black;border-top: 1px solid #FFD7BB;');
                ;
                break
        }
 
 
        //tablaExamenesLaboratorioME.setRowTextStyle(tablaExamenesLaboratorioME.getRowId(i) ,'background-color:#C43636;color:black;border-top: 1px solid #DAEFC2;');

 
 
 
   
    }
    
    
    
    
}

function AgregarUnidadMedidaxMaterialLaboratorio(){
    
    //alert("agregar nueva unidad de medida")
    PoppudAgregarUnidadMedidaxMaterialLaboratorio();
    
    
    
    
}



function PoppudAgregarUnidadMedidaxMaterialLaboratorio(sede,area,cordinador,iIdEncargadoProgramacionPersonal,idSedeempresaArea,fechaInicio,fechaFin,accion){
    
    posFuncion ="";
  
    vtitle="Agregar nueva Unidad de Medida";
    vformname='MantenimientoCoordinadorArea';
    vwidth='250';//200
    vheight='200';//160
    patronModulo='PopudAgregarUnidadMedidaxMaterialLaboratorio';
    vcenter='t';
    vresizable='';
    vmodal='false';
    vstyle='';
    vopacity='';
    veffect='';
    vposx1='';
    vposx2='';
    vposy1='';
    vposy2='';
   
      
    parametros='';
    parametros+='p1='+patronModulo;
    //    parametros+='&p2='+sede;
    //    parametros+='&p3='+area;
    //    parametros+='&p4='+cordinador;
    //    parametros+='&p5='+iIdEncargadoProgramacionPersonal;
    //    parametros+='&p6='+fechaInicio;
    //    parametros+='&p7='+fechaFin;
    //    parametros+='&p8='+accion;
    //    parametros+='&p9='+idSedeempresaArea;
    
    //alert(parametros);
    
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}




function setColortablaExamenesLaboratorio(){
     
    for(i=0;i<tablaExamenesLaboratorioME.getRowsNum();i++){
       
        var tipoArea = tablaExamenesLaboratorioME.cells(i,3).getValue();
   
        switch(tipoArea.trim()){
           
            case '1':
                tablaExamenesLaboratorioME.setRowTextStyle(tablaExamenesLaboratorioME.getRowId(i) ,'background-color:#ABF936;color:black;border-top: 1px solid #DAEFC2;');
            
                ;
                break;

            case '2':
                tablaExamenesLaboratorioME.setRowTextStyle(tablaExamenesLaboratorioME.getRowId(i) ,'background-color:#35EA5A;color:black;border-top: 1px solid #FFD7BB;');
                ;
                break
            
            case '3':
                tablaExamenesLaboratorioME.setRowTextStyle(tablaExamenesLaboratorioME.getRowId(i) ,'background-color:#E4EA35;color:black;border-top: 1px solid #DAEFC2;');
            
                ;
                break;
            
            case '4':
                tablaExamenesLaboratorioME.setRowTextStyle(tablaExamenesLaboratorioME.getRowId(i) ,'background-color:#EA35CF;color:black;border-top: 1px solid #FFD7BB;');
                ;
                break
            
            case '5':
                tablaExamenesLaboratorioME.setRowTextStyle(tablaExamenesLaboratorioME.getRowId(i) ,'background-color:#637AF9;color:black;border-top: 1px solid #FFD7BB;');
                ;
                break
        }
 
 
        //tablaExamenesLaboratorioME.setRowTextStyle(tablaExamenesLaboratorioME.getRowId(i) ,'background-color:#C43636;color:black;border-top: 1px solid #DAEFC2;');

 
 
    }
   
}



function ListarTiposAfiliacionExamenLaboratorio(){
    var patronModulo='ListarTiposAfiliacionExamenLaboratorio';
    var parametros='';
    parametros+='p1='+patronModulo;
    tablaListarTiposAfiliacionExamenLaboratorio=new dhtmlXGridObject('Div_TablaPreciosExamenesAfiliacion');
    tablaListarTiposAfiliacionExamenLaboratorio.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaListarTiposAfiliacionExamenLaboratorio.setSkin("dhx_skyblue");
    tablaListarTiposAfiliacionExamenLaboratorio.enableRowsHover(true,'grid_hover');
    
    // tablaExamenesLaboratorioME.attachEvent("onRowSelect",mostrarPreciosAfiliacionesPorExamen );
        
   
    //    tablaExamenesLaboratorioME.attachEvent("onRowSelect", function(rowId,cellInd){
    //        switch(cellInd){
    //            case 4: editarPerfilesExamenes(tablaExamenesLaboratorio1.cells(rowId,0));break;
    //            case 5: eliminarPerfilesExamenes(tablaExamenesLaboratorio1.cells(rowId,0));break
    //        }
    //    });
    //    
  
  
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaListarTiposAfiliacionExamenLaboratorio.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaListarTiposAfiliacionExamenLaboratorio.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    
    /////////////fin cargador ///////////////////////
    
    //    tablaListarTiposAfiliacionExamenLaboratorio.setSkin("dhx_terrace");
    tablaListarTiposAfiliacionExamenLaboratorio.init();
    tablaListarTiposAfiliacionExamenLaboratorio.loadXML(pathRequestControl+'?'+parametros);  
}


function ActualizarDetalleExamenLabo(){
    //alert('/'+tipoExaLa+ '/'+tipoDescripExamenLabo+''+IdExamenLaboratorio);
    if(window.confirm("¿Está seguro que desea actualizarlo?")){
        
        var IdExamenLaboratorio=$('hIdExamenLaboratorio').value;
        var tipoExaLa =$("cboTipoExamenLabo").selectedIndex;
        var tipoDescripExamenLabo=$('txtDescripcionExaLabo').value
        var parametros="p1=ActualizarDetalleExamenLabo&p2="+IdExamenLaboratorio+"&p3="+tipoExaLa+"&p4="+tipoDescripExamenLabo;
       
        var datosx=traerDataPrueba(parametros);
        
        // CargarlistadoPuestosXCentroCostos(hIdCentroCosto);
        //alert(datosx[0]);
        
        if(datosx[0].trim()=='1'){
             
            $('cell52').show();
            $('cell52').innerHTML='<CENTER><p style="color: blue; font-weight: bold;">El tipo de examen de laboratorio y/o su descripcionpuesto se han actualizado correctmente'+ '</p></CENTER>';
            mostrarExamenesLaboratorio();
            //mostrar detalle lockeado
            //    alert("Editar123")
            $('div_EditarDetalleExamenLabo').show();
            $('div_ActualizarDetalleExamenLabo').hide();
            $('txtDescripcionExaLabo').readOnly=true;
            $('cboTipoExamenLabo').disabled=true;
            //fin de mostrar detalle lockeado
                 
        }else if(datosx[0].trim()=='2'){
          
            $('cell52').show();
            $('cell52').innerHTML='<CENTER><p style="color: blue; font-weight: bold;">No se actualizo correctamente.'+ '</p></CENTER>';
          
        }
  
    }
 
}


function EditarDetalleExamenLabo(){
   
    //    alert("Editar123")
    $('div_EditarDetalleExamenLabo').hide();
    $('div_ActualizarDetalleExamenLabo').show();
    $('txtDescripcionExaLabo').readOnly=false;
    $('cboTipoExamenLabo').disabled=false;
     

}
function agregarNuevoMaterialLaboratorioPoppud(){
    alert("agregarNuevouNIDADDDD")

}


function  cargarComboUnidadMedidaPopudML(){
       
    //    var IdTipoUnidadMedidaSeleccionada =$("cboTipoMaterialLaboPopPud").selectedIndex;
    var IdTipoUnidadMedidaSeleccionada =$("cboTipoMaterialLaboPopPud").value;
    
    var idtMaterialLaboratorio=$('hIdMaterialLaboratorio').value;
    //alert(idtMaterialLaboratorio)
         
    //       alert(IdTipoUnidadMedidaSeleccionada);
          
          
    //          var tipoUnidadDeMedida=$("cboTipoUnidadDeMedida"+fila).value;
    //    $("div_UnidaMedida_Inicio").hide();
    
    //    var patronModulo='cargarComboUnidadMedida';

    var patronModulo='cargarComboUnidadMedidaPopudML';
    
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+IdTipoUnidadMedidaSeleccionada;
    parametros+='&p3='+idtMaterialLaboratorio;
 
    var destino="div_UnidadDeMedidaPopud";
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargador),
        onComplete : function(transport){
            cargadorpeche(0,idCargador);
            var respuesta = transport.responseText;
            if(destino!="") $(destino).update(respuesta);              
 
        }
    })    
          
    
}


function  mostrarPreciosAfiliacionesPorExamen(fil,col){
  
    var CodProductoExamen=tablaExamenesLaboratorioME.cells(fil,1).getValue();
    
    //mostrar en combo el tipo de examen de laboratorio
    var NombreExamenLaboratorio=tablaExamenesLaboratorioME.cells(fil,2).getValue();
    var TipoExamenLaboratorio=tablaExamenesLaboratorioME.cells(fil,3).getValue();
    var DescripcionExamenLaboratorio=tablaExamenesLaboratorioME.cells(fil,5).getValue();
                            
    $('txtNombreExaLabo').value=NombreExamenLaboratorio;
                            
    $("cboTipoExamenLabo").selectedIndex=TipoExamenLaboratorio;
                              
    $('txtDescripcionExaLabo').value=DescripcionExamenLaboratorio;
                            
    //fin de mostrar en combo el tipo de examen de laboratorio                

    //alert(NombreExamenLaboratorio + ''+ TipoExamenLaboratorio+''+DescripcionExamenLaboratorio);
    //    
    //    alert(CodProductoExamen)

    var patronModulo='precioExamenesxAfiliacion';
    var parametros='';
    parametros+='p1='+patronModulo;

    parametros+='&p2='+CodProductoExamen;

    
    tablaPreciosAfiliacionesPorExamenME=new dhtmlXGridObject('Div_TablaPreciosExamenesAfiliacion');
    tablaPreciosAfiliacionesPorExamenME.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaPreciosAfiliacionesPorExamenME.setSkin("dhx_skyblue");
    tablaPreciosAfiliacionesPorExamenME.enableRowsHover(true,'grid_hover');
    
    //tablaPreciosAfiliacionesPorExamenME.attachEvent("onRowSelect",mostrarPreciosAfiliacionesPorExamen );
        
    
    //    tablaExamenesLaboratorioME.attachEvent("onRowSelect", function(rowId,cellInd){
    //        switch(cellInd){
    //            case 4: editarPerfilesExamenes(tablaExamenesLaboratorio1.cells(rowId,0));break;
    //            case 5: eliminarPerfilesExamenes(tablaExamenesLaboratorio1.cells(rowId,0));break
    //        }
    //    });
    //    
  
  
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaPreciosAfiliacionesPorExamenME.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaPreciosAfiliacionesPorExamenME.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    
    /////////////fin cargador ///////////////////////
    
    tablaPreciosAfiliacionesPorExamenME.setSkin("dhx_terrace");
    tablaPreciosAfiliacionesPorExamenME.init();
    tablaPreciosAfiliacionesPorExamenME.loadXML(pathRequestControl+'?'+parametros);  
    ClickTablaMostrarExamenesEditarEliminar(fil,col)


}






function ClickTablaMostrarExamenesEditarEliminar(fil,col){
    // alert("pepe")
    //editar
    if(col==3){
        //        alert("3")
   
        
        var IdExamenLaboratorio=tablaExamenesLaboratorioME.cells(fil,0).getValue();
        var NombreExamenLaboratorio=tablaExamenesLaboratorioME.cells(fil,2).getValue();
        //        var cordinador=mygridxcor.cells(fil,3).getValue();
        //        var idSedeempresaArea=mygridxcor.cells(fil,5).getValue();
       
        //PopudMantenimientoExamenesEditarEliminar(sede,area,cordinador,idSedeempresaArea);
        PopudMantenimientoExamenesEditarEliminar(IdExamenLaboratorio,NombreExamenLaboratorio);
       
        //eliminar
    } else if(col==4)  {
      
        //      alert("4")
        var IdExamenLaboratorio=tablaExamenesLaboratorioME.cells(fil,0).getValue();
        //        var area1=mygridxcor.cells(fil,1).getValue();
        //        var cordinador1=mygridxcor.cells(fil,3).getValue();
        //        var iIdEncargadoProgramacionPersonal=mygridxcor.cells(fil,4).getValue();
        //        var idSedeempresaArea1=mygridxcor.cells(fil,5).getValue();
        //        var fechaInicio1=mygridxcor.cells(fil,6).getValue();
        //        var fechaFin1=mygridxcor.cells(fil,7).getValue();
        //        var accion="EditarCoordinador";
        // PopudMantenimientoExamenesEditarEliminar();
        //        PopudMantenimientoExamenesEditarEliminar(sede1,area1,cordinador1,iIdEncargadoProgramacionPersonal,idSedeempresaArea1,fechaInicio1,fechaFin1,accion);
      
        
    }else {
        
        //alert("diferente de 3 y  4");
        

    }
   
}



function PopudMantenimientoExamenesEditarEliminar(IdExamenLaboratorio,NombreExamenLaboratorio){
    //CargarlistadoTodosTurnosDisponibles
   
    posFuncion ="";
    // posFuncion ="josecito()";
    vtitle="Mantenimiento del Examen de Laboratorio";
    vformname='vPopudMantenimientoExamenesEditarEliminar';
    vwidth='650';//440  720
    vheight='240';//240   450
    patronModulo='PopudMantenimientoExamenesEditarEliminar';
    vcenter='t';
    vresizable='';
    vmodal='false';
    vstyle='';
    vopacity='';
    veffect='';
    vposx1='';
    vposx2='';
    vposy1='';
    vposy2='';
   
      
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+IdExamenLaboratorio;
    parametros+='&p3='+NombreExamenLaboratorio;
    //    parametros+='&p4='+cordinador;
    //    parametros+='&p5='+idSedeempresaArea;
    
    //alert(parametros);
    
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}


function DetalleExamenLaboratorio(){
    
    //alert("detalle")
    
    $('txtNombreExamen').readOnly=false;
    //    $('selectCategoriaPuestos').disabled=false;
    //    $('chkEstado').disabled=false;
    
    //    $('txtCentroCostos').readOnly=false;
    
    $('modificardiv').hide();
    
    $('activardiv').show();
    //    
    //    $('imgagenCancelar').show();
    
   
    
}


//
//function PopudMuestrasPorExamen(IdExamenLaboratorio,NombreExamenLaboratorio){
//    //CargarlistadoTodosTurnosDisponibles
//   
//    posFuncion ="";
//    // posFuncion ="josecito()";
//    vtitle="Mantenimiento del Examen de Laboratorio";
//    vformname='vPopudMantenimientoExamenesEditarEliminar';
//    vwidth='650';//440  720
//    vheight='240';//240   450
//    patronModulo='PopudMantenimientoExamenesEditarEliminar';
//    vcenter='t';
//    vresizable='';
//    vmodal='false';
//    vstyle='';
//    vopacity='';
//    veffect='';
//    vposx1='';
//    vposx2='';
//    vposy1='';
//    vposy2='';
//   
//      
//    parametros='';
//    parametros+='p1='+patronModulo;
//    parametros+='&p2='+IdExamenLaboratorio;
//    parametros+='&p3='+NombreExamenLaboratorio;
////    parametros+='&p4='+cordinador;
////    parametros+='&p5='+idSedeempresaArea;
//    
//    //alert(parametros);
//    
//    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
//}




function PopudMuestrasPorExamen(){
    //CargarlistadoTodosTurnosDisponibles
   
    posFuncion ="";
    // posFuncion ="josecito()";
    vtitle="Muestras por Examen";
    vformname='vPopudMuestrasPorExamen';
    vwidth='650';//440  720
    vheight='240';//240   450
    patronModulo='PopudMuestrasPorExamen';
    vcenter='t';
    vresizable='';
    vmodal='false';
    vstyle='';
    vopacity='';
    veffect='';
    vposx1='';
    vposx2='';
    vposy1='';
    vposy2='';
   
      
    parametros='';
    parametros+='p1='+patronModulo;
    //    parametros+='&p2='+IdExamenLaboratorio;
    //    parametros+='&p3='+NombreExamenLaboratorio;
    //    parametros+='&p4='+cordinador;
    //    parametros+='&p5='+idSedeempresaArea;
    
    //alert(parametros);
    
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}


function PopudSeleccionarRecipiente(){
    //CargarlistadoTodosTurnosDisponibles
   
    posFuncion ="";
    // posFuncion ="josecito()";
    vtitle="Seleccionar Recipiente";
    vformname='vPopudSeleccionarRecipiente';
    vwidth='700';//440  720
    vheight='500';//240   450
    patronModulo='PopudSeleccionarRecipiente';
    vcenter='t';
    vresizable='';
    vmodal='false';
    vstyle='';
    vopacity='';
    veffect='';
    vposx1='';
    vposx2='';
    vposy1='';
    vposy2='';
   
      
    parametros='';
    parametros+='p1='+patronModulo;
    //    parametros+='&p2='+IdExamenLaboratorio;
    //    parametros+='&p3='+NombreExamenLaboratorio;
    //    parametros+='&p4='+cordinador;
    //    parametros+='&p5='+idSedeempresaArea;
    
    //alert(parametros);
    
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function NuevoTipoMuestra(){
    PopudMantenimientoRecipiente();
    
}



function PopudMantenimientoRecipiente(){
    //CargarlistadoTodosTurnosDisponibles
   
    posFuncion ="";
    // posFuncion ="josecito()";
    vtitle="Mantenimiento Recipiente";
    vformname='vPopudMantenimientoRecipiente';
    vwidth='700';//440  720
    vheight='170';//240   450
    patronModulo='PopudMantenimientoRecipiente';
    vcenter='t';
    vresizable='';
    vmodal='false';
    vstyle='';
    vopacity='';
    veffect='';
    vposx1='';
    vposx2='';
    vposy1='';
    vposy2='';
   
      
    parametros='';
    parametros+='p1='+patronModulo;
    //    parametros+='&p2='+IdExamenLaboratorio;
    //    parametros+='&p3='+NombreExamenLaboratorio;
    //    parametros+='&p4='+cordinador;
    //    parametros+='&p5='+idSedeempresaArea;
    
    //alert(parametros);
    
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}




function agregarNuevoUnidadalMaterialLaboratorioPoppud(){
    
    //alert("agregar unidadddddddddddd")
    var IdUnidadMedidadSeleccionada =$("cboUnidadDeMedida").value;
    var IdMaterialLabo =$("hIdMaterialLaboratorio").value;
    
    var NombreUnidadMedidaAgregada=$("cboUnidadDeMedida").options[$("cboUnidadDeMedida").selectedIndex].text;
   
    alert(IdUnidadMedidadSeleccionada);
    
    parametros='';
    parametros+='p1=agregarNuevoUnidadalMaterialLaboratorioPoppud';
    parametros+='&p2='+IdUnidadMedidadSeleccionada;
    parametros+='&p3='+IdMaterialLabo;
                 
    var datosx=traerData(parametros);
    //    print_r(datosx);
                         
    if(datosx[0].trim()=='ok'){
        $('Div_ResultadoDeAgregarNuevaUnidad').innerHTML='<p style="color: blue; font-weight: bold;">Se inserto satisfactoriamente:  '+NombreUnidadMedidaAgregada+'</p>';
        //        cargarTablaUnidadesxTipoxMaterialLaboratorio
        cargarTablaUnidadesxTipoxMaterialLaboratorio(IdMaterialLabo);
        cargarComboUnidadMedidaPopudML();
  
  
  
    }else if(datosx[0].trim()=='existe'){
        $('Div_ResultadoDeAgregarNuevaUnidad').innerHTML='<p style="color: red; font-weight: bold;">Error al desactivar al Coordinador.</p>';
    }
    else if(datosx[0].trim()=='fallo'){
        $('Div_ResultadoDeAgregarNuevaUnidad').innerHTML='<p style="color: red; font-weight: bold;">Error al desactivar al Coordinador.</p>';
    }
    
}

function EditarDetalleMaterialLaboratorio(){
    
    $('hAccionNuevo_Editar').value='editar';
    
    //aparece Guardar y se oculta Editar
    $('div_GuardarDetalleMaterialLaboratorio').show();
    $('div_EditarDetalleMaterialLaboratorio').hide();
     
    $('Div_BotonAdjuntarFotoMaterialLabo').show();
    
    $('cboTipoMaterialLabo').disabled=false;
    $('txtDescripcionExaLabo').readOnly=false;
   
   
    
}

//hacer click en el boton Nuevo Material de Mante Mate Labo
function agregarNuevoMaterialLaboratorio(){
    
    $('hAccionNuevo_Editar').value='nuevo';
   
    //    $('div_NuevoMaterialLaboratorio').hide();
    //    $('div_GuardarDetalleMaterialLaboratorio').show();
    //    $('div_AdjuntarFotoMaterialLaboratorio').show();
    
    
    PopudbuscarMaterialesxPuntoControl();
    
    
    
     
    
}

function buscarMaterialesLaboratorioPopap123(){
    
    //    document.getElementById('NombreaBuscarMateriales').value
    // alert( document.getElementById('NombreaBuscarMateriales').value);
    
    buscarMaterialesLaboratorioPopap(document.getElementById('NombreaBuscarMateriales').value);
}


function PopudbuscarMaterialesxPuntoControl(){
    //CargarlistadoTodosTurnosDisponibles
   
    posFuncion ="";
    // posFuncion ="josecito()";
    vtitle="Buscar Materiales";
    vformname='ForbuscarMaterialesxPuntoControl';
    vwidth='700';//440  720
    vheight='400';//240   450
    patronModulo='vbuscarMaterialesxPuntoControl';
    vcenter='t';
    vresizable='';
    vmodal='false';
    vstyle='';
    vopacity='';
    veffect='';
    vposx1='';
    vposx2='';
    vposy1='';
    vposy2='';
   
      
    parametros='';
    parametros+='p1='+patronModulo;
    //    parametros+='&p2='+IdExamenLaboratorio;
    //    parametros+='&p3='+NombreExamenLaboratorio;
    //    parametros+='&p4='+cordinador;
    //    parametros+='&p5='+idSedeempresaArea;
    
    //alert(parametros);
    
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

//creado x JCQA 10 Agosto 2012 -- PopPud Buscar Materiales para Punto Control Examen

function PopudbuscarMaterialesxPuntoControl_2(){
    //CargarlistadoTodosTurnosDisponibles
   
    posFuncion ="";
    // posFuncion ="josecito()";
    vtitle="Buscar Materiales de Laboratorio";
    vformname='BuscarMaterialesLaboratorioPuntoControlExamen';
    vwidth='700';//440  720
    vheight='400';//240   450
    patronModulo='vbuscarMaterialesxPuntoControl_2';
    vcenter='t';
    vresizable='';
    vmodal='false';
    vstyle='';
    vopacity='';
    veffect='';
    vposx1='';
    vposx2='';
    vposy1='';
    vposy2='';
   
      
    parametros='';
    parametros+='p1='+patronModulo;
    //    parametros+='&p2='+IdExamenLaboratorio;
    
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function PopudbuscarMaterialesxPuntoControl_3(){
    //CargarlistadoTodosTurnosDisponibles
   
    posFuncion ="";
    // posFuncion ="josecito()";
    vtitle="Buscar Muestras";
    vformname='ForbuscarMaterialesxPuntoControl_3';
    vwidth='700';//440  720
    vheight='400';//240   450
    patronModulo='vbuscarMaterialesxPuntoControl_3';
    vcenter='t';
    vresizable='';
    vmodal='false';
    vstyle='';
    vopacity='';
    veffect='';
    vposx1='';
    vposx2='';
    vposy1='';
    vposy2='';
   
      
    parametros='';
    parametros+='p1='+patronModulo;
    //    parametros+='&p2='+IdExamenLaboratorio;
    //    parametros+='&p3='+NombreExamenLaboratorio;
    //    parametros+='&p4='+cordinador;
    //    parametros+='&p5='+idSedeempresaArea;
    
    //alert(parametros);
    
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}


function buscarMaterialesLaboratorioPopap(textoAbuscar){
  
    var patronModulo='buscarMaterialesLaboratorioPopap';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+textoAbuscar;
    //    parametros+='&p3='+b;
    //    parametros+='&p4='+c;
    
    
    tablabuscarMaterialesLaboratorioPopap=new dhtmlXGridObject('div_ResultadoBusquedaMaterialesLaboratorio');
    tablabuscarMaterialesLaboratorioPopap.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablabuscarMaterialesLaboratorioPopap.setSkin("dhx_skyblue");
    tablabuscarMaterialesLaboratorioPopap.enableRowsHover(true,'grid_hover');
 
    //    var filtroPeril = "<input type='text' id='idFiltroPerfil' style='width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarFiltrarMaterialesLaboratorio();\" />"; 
    //    var header = ["#text_filter", ,filtroPeril, ,"#select_filter",  ,"#select_filter","#select_filter"]; 	
    //    //8 campos
    //    TablabuscarMaterialesLaboratorioPopap.attachHeader(header);
    //
    //    TablabuscarMaterialesLaboratorioPopap.attachFooter(" ,  ,   ,Nº ,   ,#stat_count");
    //   
      
    tablabuscarMaterialesLaboratorioPopap.attachEvent("onRowDblClicked",
  
    function(fil,col){
            
            
     
        seleccionarMaterialesDeLaboratorio(fil,col);
        $('div_AdjuntarFotoMaterialLaboratorio').show();
        
        $('div_NuevoMaterialLaboratorio').hide();
        
        $('div_GuardarDetalleMaterialLaboratorio').show();
        $('div_EditarDetalleMaterialLaboratorio').show();

        $('Div_fotoMaterialLaboratorio').innerHTML='<p style="color: blue; font-weight: bold;"><img src=\"../../../imagen/fotoMaterial/tufoto.gif\" alt=Nuevo title=Nueva Foto border=0/></p>';
            
         
        //            $('div_EditarDetalleMaterialLaboratorio').show();
            
        $("hIdMaterialLaboratorio").value='';
           
        $("txtDescripcionExaLabo").value='';
            
            
            
            
      
    }  
       
);
    
 
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablabuscarMaterialesLaboratorioPopap.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablabuscarMaterialesLaboratorioPopap.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    
    /////////////fin cargador ///////////////////////
    
    
    
    tablabuscarMaterialesLaboratorioPopap.setSkin("dhx_skyblue");
    tablabuscarMaterialesLaboratorioPopap.init();
    tablabuscarMaterialesLaboratorioPopap.loadXML(pathRequestControl+'?'+parametros, function(){
      
        //        setColortablaExamenesLaboratorio();
        //        setColorTablaUnidadesxTipoxMaterialLaboratorio();
        
    });
   
}


function seleccionarMaterialesDeLaboratorio_2(fil,col){
    //    alert("presion la tabla resultados materiales");
    
    var idMaterialLaboratorio=tablabuscarMaterialesLaboratorioPopap_2.cells(fil,0).getValue();
    var cod_ser_pro=tablabuscarMaterialesLaboratorioPopap_2.cells(fil,1).getValue();
    var NombreMaterialLaboratorio=tablabuscarMaterialesLaboratorioPopap_2.cells(fil,2).getValue();
   
    $("hIdMaterialLaboratorio").value=idMaterialLaboratorio;
    $("hCodSerPro").value=cod_ser_pro;
    $("hNombreMaterialLaboEscogido").value=NombreMaterialLaboratorio;
    $("txtNombreMaterialSeleccionado").value=NombreMaterialLaboratorio;
     
    cargarComboTipoUnidadMedidaMaterialSeleccionado(idMaterialLaboratorio);
    
    presentarfotoDeMaterialLaboratorio(idMaterialLaboratorio);
    
    //    $('cboTipoMaterialLabo').disabled=false;
    //    $('txtDescripcionExaLabo').readOnly=false;
 
 
    Windows.close("Div_BuscarMaterialesLaboratorioPuntoControlExamen", "");
}
function presentarfotoDeMaterialLaboratorio(idMaterialLaboratorio){
        
    parametros='';
    parametros+='p1=presentarfotoDeMaterialLaboratorio';
    parametros+='&p2='+idMaterialLaboratorio;
    //    parametros+='&p3='+idMaterialLaboratorio;
          
    var datosx=traerDataPrueba(parametros);
    //    alert(datosx[0][0]);
    // alert(datosx);  
    if(datosx[0].trim()==''){
        //        alert("jcc")
     
        $('fotoMaterial_MDxE').innerHTML='<img style="vertical-align: middle " align="middle" alt="Material" height="150px" width="120px" src="../../../imagen/empleados/noExiste.gif" />';
    
    } else{
        $('fotoMaterial_MDxE').innerHTML='<img style="vertical-align: middle " align="middle" alt="Material" height="150px" width="120px" src="'+datosx[0].trim()+'" />';
         
    } 
    //        if(datosx[0].trim()=='ok'){
    //    datosx[0].trim();
    //    $('fotoMaterial_MDxE').innerHTML='<p style="color: blue; font-weight: bold;">Se Guardó los cambios correcamente.</p>';
    //    $('fotoMaterial_MDxE').innerHTML='<img style="vertical-align: middle " align="middle" alt="Material" height="150px" width="120px" src="'+datosx[0].trim()+'" />';
                                   
    //    mostrarMaterialesDeLaboratorio();
    //      }
        
}

function cargarComboTipoUnidadMedidaMaterialSeleccionado(idMaterialLaboratorio){
    
    //    var patronModulo='cargarComboUnidadMedidaPopudML';
    var patronModulo='cargarComboTipoUnidadMedidaMaterialSeleccionado';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idMaterialLaboratorio;
 
    var destino="Div_ComboTipoUnidadMedidaMaterialSeleccionado";
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargador),
        onComplete : function(transport){
            cargadorpeche(0,idCargador);
            var respuesta = transport.responseText;
            if(destino!="") $(destino).update(respuesta);              
 
        }
    })    
    
    
}

//JCQA 26Sept 2012
function cargarComboUnidadMedidaMaterialSeleccionadoHistorialMateriales(idUnidadMedidaExamenLabotorio){
    
    var idMaterialLaboratorio=document.getElementById('idMaterialLaboratorio'+idUnidadMedidaExamenLabotorio.trim()).value;
    var cboTipoUnidadMedidaDisponibles=document.getElementById('cboTipoUnidadMedidaDisponibles'+idUnidadMedidaExamenLabotorio.trim()).value;
     
    //    alert('idMaterialLaboratorio:'+idMaterialLaboratorio+'cboTipoUnidadMedidaDisponibles:'+cboTipoUnidadMedidaDisponibles);
  
    var patronModulo='cargarComboUnidadMedidaMaterialSeleccionado_detalleMaterialesSeleccionados';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idMaterialLaboratorio;
    parametros+='&p3='+cboTipoUnidadMedidaDisponibles;
    parametros+='&p4='+idUnidadMedidaExamenLabotorio;
 
    var destino="Div_ComboUnidadMedidaMaterialSeleccionado"+idUnidadMedidaExamenLabotorio;
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargador),
        onComplete : function(transport){
            cargadorpeche(0,idCargador);
            var respuesta = transport.responseText;
            if(destino!="") $(destino).update(respuesta);              
 
        }
    })    
  
}// fin de función


//jcqa 01 octubre 2012


function cargarComboUnidadMedidaMuestraSeleccionadoHistorialMuestra(idMuestraPuntoControlLaboratorio){
    
    var idMuestraLaboratorio=document.getElementById('idMuestraLaboratorio'+idMuestraPuntoControlLaboratorio.trim()).value;
    var cboTipoUnidadMedidaMuestraSeleccionada=document.getElementById('cboTipoUnidadMedidaMuestraSeleccionada'+idMuestraPuntoControlLaboratorio.trim()).value;
     
    //    alert('idMaterialLaboratorio:'+idMaterialLaboratorio+'cboTipoUnidadMedidaDisponibles:'+cboTipoUnidadMedidaDisponibles);
  
    var patronModulo='cargarComboUnidadMedidaMuestraSeleccionado_detalleMuestraSeleccionados';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idMuestraLaboratorio;
    parametros+='&p3='+cboTipoUnidadMedidaMuestraSeleccionada;
    parametros+='&p4='+idMuestraPuntoControlLaboratorio;
 
    var destino="Div_ComboUnidadMedidaMuestraSeleccionada"+idMuestraPuntoControlLaboratorio.trim();
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargador),
        onComplete : function(transport){
            cargadorpeche(0,idCargador);
            var respuesta = transport.responseText;
            if(destino!="") $(destino).update(respuesta);              
 
        }
    })    
  
}// fin de función





//CREADO POR JCQA 16 AGOSTO 2012 ---- CARGAR COMBO UNIDAD MEDIDA MATERIAL SELECCIONADO

function cargarComboUnidadMedidaMaterialSeleccionado(){
    
    var TipoUnidadMedidaEscogida =$("cboTipoUnidadMedidaDisponibles").value;
    //    var b =document.getElementById("cboTipoUnidadMedidaDisponibles").value;
    var hIdMaterialLaboratorio=$("hIdMaterialLaboratorio").value;
    //    alert('TipoUnidadMedidaEscogida:'+TipoUnidadMedidaEscogida +'idML:'+hIdMaterialLaboratorio);
    
 
    var patronModulo='cargarComboUnidadMedidaMaterialSeleccionado';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+hIdMaterialLaboratorio;
    parametros+='&p3='+TipoUnidadMedidaEscogida;
 
    var destino="Div_ComboUnidadMedidaMaterialSeleccionado";
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargador),
        onComplete : function(transport){
            cargadorpeche(0,idCargador);
            var respuesta = transport.responseText;
            if(destino!="") $(destino).update(respuesta);              
 
        }
    })    
  
}

function EditarItemMaterialesAlmacenados(idUnidadMedidaExamenLabotorio){
    //alert('es:'+idUnidadMedidaExamenLabotorio);
    
   
    $('cboTipoUnidadMedidaDisponibles'+idUnidadMedidaExamenLabotorio.trim()).disabled=false;
    $('cboUnidadMedidaDisponibles'+idUnidadMedidaExamenLabotorio.trim()).disabled=false;
    $('txtCantidadMaximaMaterialLabo'+idUnidadMedidaExamenLabotorio.trim()).readOnly=false;
    $('txtCantidadMinimaMaterialLabo'+idUnidadMedidaExamenLabotorio.trim()).readOnly=false;
     
    //    cargarComboUnidadMedidaMaterialSeleccionado
   
    
}

function EliminarItemMaterialesAlmacenados(idUnidadMedidaExamenLab){
    
    var idUnidadMedidaExaLab=document.getElementById('idUnidadMedidaExamenLabotorio'+idUnidadMedidaExamenLab).value;
    //alert('idUnidadMedidaExamenLabotorio:'+idUnidadMedidaExaLab);

    parametros='';
    parametros+='p1=EliminarItemMaterialesAlmacenados';
    parametros+='&p2='+idUnidadMedidaExamenLab;
        
    var datosxxx=traerDataPrueba(parametros);
    if(datosxxx[0].trim()=='ok'){
                
        alert("Se elimino exitosamente");
          
    }



    
}


function ActualizarItemMaterialesAlmacenados(TipoUnidadMedidaDisponibles,UnidadMedidaDisponibles,CantidadMaximaMaterial,CantidadMinimaMaterial,idUnidadMedidaExamenLabotorio){
    
    //alert(TipoUnidadMedidaDisponibles+'/'+UnidadMedidaDisponibles+'/'+CantidadMaximaMaterial+'/'+CantidadMinimaMaterial);
    
    parametros='';
   
    parametros+='p1=ActualizarItemMaterialesAlmacenados';
    parametros+='&p2='+TipoUnidadMedidaDisponibles;
    parametros+='&p3='+UnidadMedidaDisponibles;
    parametros+='&p4='+CantidadMaximaMaterial;
    parametros+='&p5='+CantidadMinimaMaterial;
    parametros+='&p6='+idUnidadMedidaExamenLabotorio;
       
    var datosxxx=traerDataPrueba(parametros);
    if(datosxxx[0].trim()=='ok'){
                
        $('cboTipoUnidadMedidaDisponibles'+idUnidadMedidaExamenLabotorio.trim()).disabled=true;
        $('cboUnidadMedidaDisponibles'+idUnidadMedidaExamenLabotorio.trim()).disabled=true;
        $('txtCantidadMaximaMaterialLabo'+idUnidadMedidaExamenLabotorio.trim()).readOnly=true;
        $('txtCantidadMinimaMaterialLabo'+idUnidadMedidaExamenLabotorio.trim()).readOnly=true;
        alert("Se guardo exitosamente");   
   
    }
    
    
    
}



//creado JCQA 14 agosto 2012 onchange

function cargarComboUnidadMedidaMuestraSeleccionado(){
    
    var TipoUnidadMedidaEscogidaMuestra =$("cboTipoUnidadMedidaMuestraSeleccionada").value;
   
    //    var hIdMaterialLaboratorio=$("hIdMaterialLaboratorio").value;
    //    alert('TipoUnidadMedidaEscogida:'+TipoUnidadMedidaEscogida +'idML:'+hIdMaterialLaboratorio);
 
    var patronModulo='cargarComboUnidadMedidaMuestraSeleccionado';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+TipoUnidadMedidaEscogidaMuestra;
    //    parametros+='&p3='+TipoUnidadMedidaEscogida;
 
    var destino="Div_ComboUnidadMedidaMuestraSeleccionada";
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargador),
        onComplete : function(transport){
            cargadorpeche(0,idCargador);
            var respuesta = transport.responseText;
            if(destino!="") $(destino).update(respuesta);              
 
        }
    })    
  
}

//creado x JCQA 10 AGOSTO 2012  genera tabla para buscar materiales punto control examen

function buscarMaterialesLaboratorioPopap_2(textoAbuscar){
  
    var patronModulo='buscarMaterialesLaboratorioPopap_2';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+textoAbuscar;
    tablabuscarMaterialesLaboratorioPopap_2=new dhtmlXGridObject('div_ResultadoBusquedaMaterialesLaboratorio');
    tablabuscarMaterialesLaboratorioPopap_2.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablabuscarMaterialesLaboratorioPopap_2.setSkin("dhx_skyblue");
    tablabuscarMaterialesLaboratorioPopap_2.enableRowsHover(true,'grid_hover');
     
    tablabuscarMaterialesLaboratorioPopap_2.attachEvent("onRowDblClicked",
    function(fil,col){
    
        seleccionarMaterialesDeLaboratorio_2(fil,col);
        
    }  
       
);
    
 
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablabuscarMaterialesLaboratorioPopap_2.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablabuscarMaterialesLaboratorioPopap_2.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    
    /////////////fin cargador ///////////////////////
    
        
    tablabuscarMaterialesLaboratorioPopap_2.setSkin("dhx_skyblue");
    tablabuscarMaterialesLaboratorioPopap_2.init();
    //    tablabuscarMaterialesLaboratorioPopap_2.loadXML(pathRequestControl+'?'+parametros, function(){
    //      
    //        //        setColortablaExamenesLaboratorio();
    //        //        setColorTablaUnidadesxTipoxMaterialLaboratorio();
    //        
    //        });
        
    tablabuscarMaterialesLaboratorioPopap_2.loadXML(pathRequestControl+'?'+parametros);
   
}



//creado x JCQA 14 AGOSTO 2012

function buscarMaterialesLaboratorioPopap_3(textoAbuscar){
  
    var patronModulo='buscarMaterialesLaboratorioPopap_3';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+textoAbuscar;
    tablabuscarMaterialesLaboratorioPopap_3=new dhtmlXGridObject('div_ResultadoBusquedaMaterialesLaboratorio');
    tablabuscarMaterialesLaboratorioPopap_3.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablabuscarMaterialesLaboratorioPopap_3.setSkin("dhx_skyblue");
    tablabuscarMaterialesLaboratorioPopap_3.enableRowsHover(true,'grid_hover');
     
    tablabuscarMaterialesLaboratorioPopap_3.attachEvent("onRowDblClicked",
  
    function(fil,col){
  
        seleccionarMaterialesDeLaboratorio_3(fil,col);
      
    }  
       
);
    
 
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablabuscarMaterialesLaboratorioPopap_3.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablabuscarMaterialesLaboratorioPopap_3.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    
    /////////////fin cargador ///////////////////////
    
    
    
    tablabuscarMaterialesLaboratorioPopap_3.setSkin("dhx_skyblue");
    tablabuscarMaterialesLaboratorioPopap_3.init();
    tablabuscarMaterialesLaboratorioPopap_3.loadXML(pathRequestControl+'?'+parametros, function(){
      
        //        setColortablaExamenesLaboratorio();
        //        setColorTablaUnidadesxTipoxMaterialLaboratorio();
        
    });
    //    var hidExameneLabora= $('hIdExamenLaboratorio').value;

}

//creado x JCQA 10 Agosto 2012
//En base al parametro: idMaterialLaboratorio, trae de base atributos del Material labo seleccionado
function adjuntarOtroFilejc(){
        
    var idMaterialLaboratorio= $('hIdMaterialLaboratorio').value;
    //alert('idMaterialLaboratorio::::::'+idMaterialLaboratorio);
    
    var patronModulo='adjuntarOtroFilejc';
    var parametros='';
    parametros+='p1='+patronModulo+'&p2='+idMaterialLaboratorio;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText;
            $('divAdjuntarOtrojc').update(respuesta);
       
        }
    } )
}


function GuardarCambiosDetalleMaterialesdeLaboratorio(){
    
    var AccionNuevo_Editar= $('hAccionNuevo_Editar').value;
 
    //    alert(AccionNuevo_Editar);
        
    var  IdtipoMaterialLaboratorio =$("cboTipoMaterialLabo").value;
    var  txtDescripcionMaterialLaboratorio =$("txtDescripcionExaLabo").value;
    
    var txtRutaPrincipal = '../../../imagen/fotoMaterial/';
    var nombreFoto='fotito.jpg';
    var txtRutaPrincipalCompleta=txtRutaPrincipal+nombreFoto
   
    //    alert(txtRutaPrincipalCompleta);
   
    if(window.confirm("¿Está seguro que desea guardar los cambios?")){
        
        if(AccionNuevo_Editar.trim()=='editar'){
            
            //            alert("guardar Editar");
            
            var IdMaterialLaboratorio =$("hIdMaterialLaboratorio").value;
            
        
            parametros='';
            parametros+='p1=GuardarCambiosDetalleMaterialesdeLaboratorio';
            parametros+='&p2='+IdMaterialLaboratorio;
            parametros+='&p3='+IdtipoMaterialLaboratorio;
            parametros+='&p4='+txtDescripcionMaterialLaboratorio;
            //adicionado
            parametros+='&p5='+txtRutaPrincipalCompleta;
       
            var datosx=traerDataPrueba(parametros);
                         
            if(datosx[0].trim()=='ok'){
                
                $('div_Mensaje_MaterialesLabo').innerHTML='<p style="color: blue; font-weight: bold;">Se Guardó los cambios correcamente.</p>';
                mostrarMaterialesDeLaboratorio();
                
             
                $('div_NuevoMaterialLaboratorio').show();
                $('div_GuardarDetalleMaterialLaboratorio').hide();
                //            $('div_AdjuntarFotoMaterialLaboratorio').hide();
            
                $('div_AdjuntarFotoMaterialLaboratorio').show();
            
            
                $('div_EditarDetalleMaterialLaboratorio').show();
           
            
                $('cboTipoMaterialLabo').disabled=true;
                $('txtDescripcionExaLabo').readOnly=true;
                mostrarImagenMaterialLaboratorio();
           
                /////
                
                
                
            }else {
                $('div_Mensaje_MaterialesLabo').innerHTML='<p style="color: red; font-weight: bold;">Error al guardar los cambios.</p>';
            }
      
        }else if(AccionNuevo_Editar.trim()=='nuevo'){
            
            //            alert("guardar nuevo");
            
            var CodSerPro =$("txtCodigoNuevoMaterialLabo").value;
            
            //            alert(CodSerPro)
            //             $("txtCodigoNuevoMaterialLabo").value=c_cod_ser_pro;
            
            
            
            parametros='';
            parametros+='p1=GuardarCambiosDetalleMaterialesdeLaboratorio_Nuevo';
            parametros+='&p2='+CodSerPro;
            parametros+='&p3='+IdtipoMaterialLaboratorio;
            parametros+='&p4='+txtDescripcionMaterialLaboratorio;
            
            //adicionado
            
            parametros+='&p5='+txtRutaPrincipalCompleta;
            
         
            var datosx=traerDataPrueba(parametros);
                         
            if(datosx[0].trim()=='ok'){
                $('div_Mensaje_MaterialesLabo').innerHTML='<p style="color: blue; font-weight: bold;">Se creo el Material de Laboratorio correctamente</p>';
            }else {
                $('div_Mensaje_MaterialesLabo').innerHTML='<p style="color: red; font-weight: bold;">Error al crear el Material de Laboratorio.</p>';
            }
   
        }
        
  

    }
    


}


function seleccionarMaterialesDeLaboratorio(fil,col){
    //    alert("presion la tabla resultados materiales");
    
    var c_cod_ser_pro=tablabuscarMaterialesLaboratorioPopap.cells(fil,0).getValue();
    var NombreMaterialLaboSeleccionado=tablabuscarMaterialesLaboratorioPopap.cells(fil,1).getValue();
    //    alert(c_cod_ser_pro+'/'+NombreMaterialLaboSeleccionado)
    
    $("hcod_ser_pro").value=c_cod_ser_pro;
    
    $("hNombreMaterialxAgregar").value=NombreMaterialLaboSeleccionado;
    $("txtIdNuevoMaterialLabo").value='';
    
    $('cboTipoMaterialLabo').disabled=false;
    $('txtDescripcionExaLabo').readOnly=false;
    
    
    //    txtNombreMaterialLabo
    //    txtCodigoNuevoMaterialLabo
    
    $("txtCodigoNuevoMaterialLabo").value=c_cod_ser_pro;//esto se tomara en cuenta
    $("txtNombreMaterialLabo").value=NombreMaterialLaboSeleccionado;
   
 
    Windows.close("Div_ForbuscarMaterialesxPuntoControl", "");
}

//19 Septiembre del 2012 - JCQA - Agregar otro Material de Laboratorio
function AgregarotroMuestraMaterialdeLaboratorio(){
    
    $("txtNombreMuestraSeleccionada").value='';
    $("txtCantidadMaximaMuestraSeleccionada").value='';
    $("txtCantidadMinimaMuestraSeleccionada").value='';
    //    $("Div_ComboUnidadMedidaMaterialSeleccionado").innerHTML=
    //    "<input name='txtprueba' type='text' id='txtprueba' size='30'/>";
    
    
    $("Div_ComboTipoUnidadMedidaMuestraSeleccionada").innerHTML=
        "<select name='cboTipoUnidadMedidaMuestraSeleccionada' id='cboTipoUnidadMedidaMuestraSeleccionada' style='width:150px; font-size:12px'><option value='x' selected style='background-color: #CED2E5'>Seleccionar</option></select>";
    
    $("Div_ComboUnidadMedidaMuestraSeleccionada").innerHTML=
        "<select name='cboUnidadMedidaMuestraSeleccionada' id='cboUnidadMedidaMuestraSeleccionada' style='width:150px; font-size:12px'><option value='x' selected style='background-color: #CED2E5'>Seleccionar</option></select>";
      
    
    
    
}

//19 Septiembre del 2012 - JCQA - Agregar otra Muestra de Laboratorio
function AgregarotroMaterialLaboratorio(){
    
    $("txtNombreMaterialSeleccionado").value='';
    $("txtCantidadMaximaMaterialLabo").value='';
    $("txtCantidadMinimaMaterialLabo").value='';
    $("Div_ComboTipoUnidadMedidaMaterialSeleccionado").innerHTML=
        "<select name='cboTipoUnidadMedidaDisponibles' id='cboTipoUnidadMedidaDisponibles' style='width:150px; font-size:12px'><option value='x' selected style='background-color: #CED2E5'>Seleccionar</option></select>";
    
    $("Div_ComboUnidadMedidaMaterialSeleccionado").innerHTML=
        "<select name='cboUnidadMedidaDisponibles' id='cboUnidadMedidaDisponibles' style='width:150px; font-size:12px'><option value='x' selected style='background-color: #CED2E5'>Seleccionar</option></select>";
    
}


//19 Septiembre del 2012 - JCQA - Guardar Material
function GuardarMaterialxPuntoControlxExamenLaboratorio(){
    
    var IdMaterialLaboratorio =$("hIdMaterialLaboratorio").value;
    var TipoUnidadMedidaDisponibles =$("cboTipoUnidadMedidaDisponibles").value;
    var UnidadMedidaDisponibles =$("cboUnidadMedidaDisponibles").value;
    var txtCantidadMaximaMaterialLabo =$("txtCantidadMaximaMaterialLabo").value;
    var txtCantidadMinimaMaterialLabo =$("txtCantidadMinimaMaterialLabo").value;
    var idPuntoControlExamenLab =$("hidPuntoControlExamenLab").value;
    
   
    if(TipoUnidadMedidaDisponibles != 'x' &&  UnidadMedidaDisponibles != 'x' &&  IdMaterialLaboratorio != ''){
       
        //alert(IdMaterialLaboratorio+'/'+TipoUnidadMedidaDisponibles+'/'+UnidadMedidaDisponibles+ '/'+ txtCantidadMaximaMaterialLabo
        // +'/'+ txtCantidadMinimaMaterialLabo+'/'+ idPuntoControlExamenLab);
      
        var parametros='';
        parametros+='p1=GuardarMaterialxPuntoControlxExamenLaboratorio';
        parametros+='&p2='+IdMaterialLaboratorio;
        parametros+='&p3='+idPuntoControlExamenLab;
        parametros+='&p4='+UnidadMedidaDisponibles;  
        parametros+='&p5='+txtCantidadMaximaMaterialLabo;
        parametros+='&p6='+txtCantidadMinimaMaterialLabo;  
  
        var datosx=traerDataPrueba(parametros);
       
    }
    
    
}

function GuardarMuestraxPuntoControlxExamenLaboratorio(){
    var IdMuestraLaboratorio=$("hidMuestraLaboratorio").value;
    var TipoUnidadMedidaMuestraSeleccionada=$("cboTipoUnidadMedidaMuestraSeleccionada").value;
    
    var IdPuntoControlExamenLaboratorio =$("hidPuntoControlExamenLab").value;
    var UnidadMedidaMuestraSeleccionada=$("cboUnidadMedidaMuestraSeleccionada").value;
    var CantidadMaximaMuestraSeleccionada=$("txtCantidadMaximaMuestraSeleccionada").value;
    var CantidadMinimaMuestraSeleccionada=$("txtCantidadMinimaMuestraSeleccionada").value;
     
    //    alert('IdPuntoControlExamenLaboratorio'+IdPuntoControlExamenLaboratorio);

    if(TipoUnidadMedidaMuestraSeleccionada != 'x' &&  UnidadMedidaMuestraSeleccionada != 'x'){
       
        //        alert(dMuestraLaboratorio+'/'+TipoUnidadMedidaMuestraSeleccionada+'/'+UnidadMedidaMuestraSeleccionada+ '/'+ CantidadMaximaMuestraSeleccionada+'/'+ CantidadMinimaMuestraSeleccionada);
      
        var parametros='';
        parametros+='p1=GuardarMuestraxPuntoControlxExamenLaboratorio';
        parametros+='&p2='+IdMuestraLaboratorio;
        parametros+='&p3='+IdPuntoControlExamenLaboratorio;
        parametros+='&p4='+UnidadMedidaMuestraSeleccionada;  
        parametros+='&p5='+CantidadMaximaMuestraSeleccionada;
        parametros+='&p6='+CantidadMinimaMuestraSeleccionada;  
  
        var datosx=traerDataPrueba(parametros);
        
        //        if(datosx[0]==1){
        //            
        //            Windows.close("Div_popadExamenesLaboratorio");
        //            cargarTablaPerfilesExamenes();            
        //        }
       
    }
    
   
}



//creado por JCQA 14 aGOSTO 2012

function seleccionarMaterialesDeLaboratorio_3(fil,col){
    //    alert("presion la tabla resultados materiales");
    
    var idMuestraLaboratorio=tablabuscarMaterialesLaboratorioPopap_3.cells(fil,0).getValue();
    var NombreMuestraLaboratorioSeleccionado=tablabuscarMaterialesLaboratorioPopap_3.cells(fil,1).getValue();
    //    alert(c_cod_ser_pro+'/'+NombreMaterialLaboSeleccionado)
    
    $("hidMuestraLaboratorio").value=idMuestraLaboratorio;
    
    $("hNombreMuestraxAgregar").value=NombreMuestraLaboratorioSeleccionado;
    //    $("txtIdNuevoMaterialLabo").value='';
    
    //    $('cboTipoMaterialLabo').disabled=false;
    //    $('txtDescripcionExaLabo').readOnly=false;
    
    
    //    txtNombreMaterialLabo
    //    txtCodigoNuevoMaterialLabo
    
    //    $("txtCodigoNuevoMaterialLabo").value=idMuestraLaboratorio;//esto se tomara en cuenta
    
    cargarComboTipoUnidadMedidaMuestraSeleccionado();
    
    
    
    
    $("txtNombreMuestraSeleccionada").value=NombreMuestraLaboratorioSeleccionado;
   
 
    //    Windows.close("Div_ForbuscarMuestrassxPuntoControl", "");
    Windows.close("Div_ForbuscarMaterialesxPuntoControl_3", "");
    
    
}

//creado JCQA 14 Agosto 2012

function cargarComboTipoUnidadMedidaMuestraSeleccionado(){
       
    //    var patronModulo='cargarComboTipoUnidadMedidaMaterialSeleccionado';
    var patronModulo='cargarComboTipoUnidadMedidaMuestraSeleccionado';
    var parametros='';
    parametros+='p1='+patronModulo;
    //    parametros+='&p2='+idMaterialLaboratorio;
 
    var destino="Div_ComboTipoUnidadMedidaMuestraSeleccionada";
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        asynchronous:false,
        parameters : parametros,
        onLoading : cargadorpeche(1,idCargador),
        onComplete : function(transport){
            cargadorpeche(0,idCargador);
            var respuesta = transport.responseText;
            if(destino!="") $(destino).update(respuesta);              
 
        }
    })  
    
    
    
    
}





function AdjuntoFotoMaterialLaboratorio(idPersona,param2){

    var div='divAdjuntarFoto';
    var titulo="Foto Material Laboratorio";
    var patronModulo="p1=AdjuntoFotoMaterialLaboratorio&p2="+idPersona+"&p3="+param2;
    var nombreFile=idPersona;
    var opcion="imagen";
    var arrayTipoFile=["png","jpg","gif","jpeg"];
    var rutaFile="../../../../carpetaDocumentos/";
   
    //     var rutaFile="";  //¿Que ruta significa?
    uploadFileHMLO(div,titulo,patronModulo,nombreFile,opcion,arrayTipoFile,rutaFile);
    
    
    
    
    
}




////////////////////////////////////////////////////////////////////////////////////////ARAOZ INICIO BLOOCK

function asignarCoordinadorAlArea_bak(){
    
    var NombreCoordinadorOculto=$("NombreCoordinadorOculto").value;
    var nombresCoordinadorVisible=$("txtNombres").value;
    var hiIdEncargadoProgramacionPersonal=$("hiIdEncargadoProgramacionPersonal").value;
    var IdNuevoCoordinadorAsignado=$("hidIdPersona").value;
    var hidSedeempresaArea=$("hidSedeempresaArea").value;
    var chkEstado=$("chkEstado").value;
    //    alert("/"+chkEstado +"/"+hiIdEncargadoProgramacionPersonal+"/" );
    
    if($("chkEstado").value=='0'){
        //alert("usted quiere deshabilitar")
            
        if(window.confirm("Desea deshabilitar a este Coordinador?")){
               
            parametros='';
            parametros+='p1=DesactivarCoordinadorDeArea';
            parametros+='&p2='+hiIdEncargadoProgramacionPersonal;
                 
            var datosx=traerData(parametros);
                         
            if(datosx[0].trim()=='ok'){
                $('divMsmResultadoEncargado').innerHTML='<p style="color: blue; font-weight: bold;">Se Desactivo exitosamente</p>';
            }else if(datosx[0].trim()=='existe'){
                $('divMsmResultadoEncargado').innerHTML='<p style="color: red; font-weight: bold;">Error al desactivar al Coordinador.</p>';
            }else if(datosx[0].trim()=='fallo'){
                $('divMsmResultadoEncargado').innerHTML='<p style="color: red; font-weight: bold;">Error al desactivar al Coordinador.</p>';
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

function limpiaCajaCoordinador_bak(){
    // alert("entro a la funcion limpiajc");
    
    document.getElementById('txtNombres').value='';
    
    document.getElementById("chkEstado").checked=true;
    
    document.getElementById('chkEstado').value='1';
    
    
    
}

function salirModCoordiTurnos_bak(){
    
    //    alert("click boton salir");
    var chkEstado=$("chkEstado").value;
    //alert("el valorInicio"+ chkEstado+"fin" );
    Windows.close("Div_MantenimientoCoordinadorArea", ''); 
    CargarlistadoTodasAreasSinCoordinador();
    
}





////////////////////////////////////////////////////////////////////////////////////////////////ARAOZ FIN BLOCK
//funcion agregada domingo 0


function salirPopupEditarMantenimientoExamen(){
    
 
    //    var chkEstado=$("chkEstado").value;
    //alert("el valorInicio"+ chkEstado+"fin" );
    Windows.close("Div_vPopudMantenimientoExamenesEditarEliminar", '');
    
    // CargarlistadoTodasAreasSinCoordinador();
    
}





function  agregarMuestra(){
    
    // alert(document.getElementById('txtExamenesLaboratorioManteExamen').value)
    PopudMuestrasPorExamen();
}


function  seleccionarRecipiente(){
    
    // alert(document.getElementById('txtExamenesLaboratorioManteExamen').value)
    //    PopudMuestrasPorExamen();
    PopudSeleccionarRecipiente();
}
//
//function buscarExamenesLaboratorioManteExamenes456(){
//    alert("holas123");
//    if( tablaPerfiles.getSelectedId()!=null){
//        podpadListaExamenes();
//    }else{
//        alert("Seleccione un perfil");
//    }
////    alert(tablaPerfiles.getSelectedId());
//
//
//}

///////////////////////////domingo////
function buscarExamenesLaboratorioManteExamenes(){
    //alert("busca");
    findLikeGoogle(document.getElementById('txtExamenesLaboratorioManteExamen').value,tablaExamenesLaboratorioME,2);
    //alert(document.getElementById('txtExamenesLaboratorio').value)
}

//function findLikeGoogle(palabra,tabla,campo){
//    var arrayPalabras=new Array();
//    arrayPalabras=palabra.split(" ");
//    var numeroPalabras=arrayPalabras.length;
//    tabla.filterBy(campo,arrayPalabras[0]);
//    for(var i=1; i<numeroPalabras; i++){
//        tabla.filterBy(campo,arrayPalabras[i],true);
//    }
//}



///////////////////////////domingo////





//function buscarAreaModCoordinadoresTurnos(){
//
//    alert("ini");
//
//    var txtNombreAreaAbuscar=$("txtNombreAreaAbuscar").value;
//    var IdcboSede=$("cboSede").value;
//    var numero=txtNombreAreaAbuscar.length;
//    var parametros="p1=buscarAreaModCoordinadoresTurnos&p2="+txtNombreAreaAbuscar+"&p3="+IdcboSede;
// 
//
//    
//    if(numero==3 || numero==0 ){
//        //        alert("Nº de teclas presionadas: "+numero);
//        dn=0;
//        mygridxcor = new dhtmlXGridObject('Div_listadoTodosCordinadores');
//        mygridxcor.setImagePath("../../../../fastmedical_front/imagen/icono/");
//  
//        mygridxcor.attachEvent("onRowSelect",ClickCargarlistadoTodosCordinadores );
//        
//        //////////para cargador peche////////////////
//        contadorCargador++;
//        //        alert(contadorCargador);
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
//    if(numero>3&&dn==1){
//        //         alert("presiono mas de 3 osea: "+numero);
//        mygridxcor.filterBy(1,$('txtNombreAreaAbuscar').value);
//    }
//
//   
//}















//pate de araoz



//////////////////
///Parte para Letal
function cargarTablaPerfiles(){
    var patronModulo='cargartablaPerfiles';
    var parametros='';
    parametros+='p1='+patronModulo;
    //parametros+='&p2='+codigoProgramacion;
    
    
    
    tablaPerfiles=new dhtmlXGridObject('divTablaPerfilesLaboratorio');
    tablaPerfiles.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaPerfiles.setSkin("dhx_terrace");
    tablaPerfiles.enableRowsHover(true,'grid_hover');
    var filtroPeril = "<input type='text' id='idFiltroPerfil' style='border:1px solid #CECECE; border-radius:5px;height:20px;width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarPerfil();\" />"; 
    var header = ["#numeric_filter","#text_filter",filtroPeril];  
    tablaPerfiles.attachHeader(header); 
    tablaPerfiles.attachEvent("onRowSelect", function(rowId,cellInd){
        cargarTablaPerfilesExamenes();
        //        switch(cellInd){
        //            case 3:
        //                cargarTablaPerfilesExamenes(tablaPerfiles.cells(rowId,0).getValue());
        //                break;
        //        }
    });   
       
    // miTablaAntecedente.attachEvent("onRowSelect", agregarAntecedente);
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaPerfiles.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaPerfiles.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaPerfiles.setSkin("dhx_terrace");
    tablaPerfiles.init();
    tablaPerfiles.loadXML(pathRequestControl+'?'+parametros);
    
    
}
function buscarPerfil(){
    //alert("hola")
    findLikeGoogle(document.getElementById('idFiltroPerfil').value,tablaPerfiles,2);  
}



function cargarTablaPerfilesExamenes(){
    //alert(idPerfil);
    var patronModulo='cargarTablaPerfilesExamenes';
    var parametros='';
    parametros+='p1='+patronModulo+'&p2='+tablaPerfiles.cells(tablaPerfiles.getSelectedId(),0).getValue();
    tablaPerfilesExamenes=new dhtmlXGridObject('divTablaExamenesXPerfil');
    tablaPerfilesExamenes.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaPerfilesExamenes.setSkin("dhx_terrace");
    tablaPerfilesExamenes.enableRowsHover(true,'grid_hover');
    var filtroPerfilesExamenes = "<input type='text' id='idFiltroPerfilExamen' style='border:1px solid #CECECE; border-radius:5px;height:20px;width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarPerfilesExamenes();\" />"; 
    var header = ["#numeric_filter","#numeric_filter","#numeric_filter","#text_filter",filtroPerfilesExamenes]; 
    tablaPerfilesExamenes.attachHeader(header); 
    tablaPerfilesExamenes.attachEvent("onRowSelect", function(rowId,cellInd){
        switch(cellInd){
            //            case 4:
            //                editarPerfilesExamenes(tablaPerfilesExamenes.cells(rowId,0));
            //                break;
            case 6:
                eliminarPerfilesExamenes(tablaPerfilesExamenes.cells(tablaPerfilesExamenes.getSelectedId(),0).getValue());
                break
        }
    });
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaPerfilesExamenes.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaPerfilesExamenes.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    
    /////////////fin cargador ///////////////////////
    tablaPerfilesExamenes.setSkin("dhx_terrace");
    tablaPerfilesExamenes.init();
    tablaPerfilesExamenes.loadXML(pathRequestControl+'?'+parametros);
}

function buscarPerfilesExamenes(){
    findLikeGoogle(document.getElementById('idFiltroPerfilExamen').value,tablaPerfilesExamenes,4);  
}

function asignacionExamenesAPerfiles(){
    if( tablaPerfiles.getSelectedId()!=null){
        podpadListaExamenes();
    }else{
        alert("Seleccione un perfil");
    }
    //    alert(tablaPerfiles.getSelectedId());
}


function podpadListaExamenes(){
    var posFuncion= "cargarTablaExamenesLaboratorio";
    var vtitle="";
    var vformname='popadExamenesLaboratorio';
    var vwidth='810';
    var vheight='407';
    var patronModulo='cargarPoppadExamenesLaboratorio';
    var vcenter='t';
    var vresizable=''
    var vmodal='false';
    var vstyle='';
    var vopacity='';
    var vposx1='';
    var vposx2='';
    var vposy1='';
    var vposy2='';
    var parametros='';
    parametros+='p1='+patronModulo
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

//JCDB 07/07/2012
function asignarExamenAPerfil(){
    if(tablaExamenesLaboratorio1.getSelectedId()!=null){
        var parametros="";
        parametros="p1=asignarExamenAPerfil&p2="+tablaExamenesLaboratorio1.cells(tablaExamenesLaboratorio1.getSelectedId(),0).getValue()
        parametros+="&p3="+tablaPerfiles.cells(tablaPerfiles.getSelectedId(),0).getValue();

        var datosx=traerDataPrueba(parametros);
        if(datosx[0]==1){
            Windows.close("Div_popadExamenesLaboratorio");
            cargarTablaPerfilesExamenes();            
        }
    }    
    else{
        alert("Seleccione un exámen");
    }    
}

//JCDB 06/07/2012
function cargarTablaExamenesLaboratorio(){
    var patronModulo='cargarTablaExamenesLaboratorio';
    var parametros='';
    parametros+='p1='+patronModulo+'&p2='+tablaPerfiles.cells(tablaPerfiles.getSelectedId(),0).getValue();
    tablaExamenesLaboratorio1=new dhtmlXGridObject('divTablaExamenesLaboratorio');
    tablaExamenesLaboratorio1.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaExamenesLaboratorio1.setSkin("dhx_terrace");
    tablaExamenesLaboratorio1.enableRowsHover(true,'grid_hover');
    var filtroExamenesLab = "<input type='text' id='idFiltroExamenLab' style='border:1px solid #CECECE; border-radius:5px;height:20px;width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarExamenesLab();\" />"; 
    var header = ["#numeric_filter","#text_filter",filtroExamenesLab]; 
    tablaExamenesLaboratorio1.attachHeader(header); 
    //    
    //    tablaExamenesLaboratorio1.attachEvent("onRowSelect", function(rowId,cellInd){
    //        switch(cellInd){
    //            case 4: editarPerfilesExamenes(tablaExamenesLaboratorio1.cells(rowId,0));break;
    //            case 5: eliminarPerfilesExamenes(tablaExamenesLaboratorio1.cells(rowId,0));break
    //        }
    //    });
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaExamenesLaboratorio1.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaExamenesLaboratorio1.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    
    /////////////fin cargador ///////////////////////
    tablaExamenesLaboratorio1.attachEvent("onRowDblClicked", function(rowId,cellInd){  
        asignarExamenAPerfil();
    });  
    tablaExamenesLaboratorio1.setSkin("dhx_terrace");
    tablaExamenesLaboratorio1.init();
    tablaExamenesLaboratorio1.loadXML(pathRequestControl+'?'+parametros);  
}


//xxxx

function buscarFiltrarExamenesLaboratorio(){
    //alert("hola")
    findLikeGoogle(document.getElementById('idFiltroPerfil').value,tablaExamenesLaboratorioME,2);  
}

function buscarFiltrarMaterialesLaboratorio(){
    //alert("hola")
    findLikeGoogle(document.getElementById('idFiltroPerfil').value,tablaMaterialesDeLaboratorioME,2);  
}


function buscarExamenesLab(){
    findLikeGoogle(document.getElementById('idFiltroExamenLab').value,tablaExamenesLaboratorio1,2);  
}


//JCDB 07/07/2012
function buscarExamenLaboratorio(){
    findLikeGoogle(document.getElementById('txtExamen').value,tablaExamenesLaboratorio1,2)  
}
//JCDB 07/07/2012
function findLikeGoogle(palabra,tabla,campo){
    var arrayPalabras=new Array();
    arrayPalabras=palabra.split(" ");
    var numeroPalabras=arrayPalabras.length;
    tabla.filterBy(campo,arrayPalabras[0]);
    for(var i=1; i<numeroPalabras; i++){
        tabla.filterBy(campo,arrayPalabras[i],true);
    }
}
function eliminarPerfilesExamenes(id){
    var parametros="p1=eliminarPerfilesExamenes&p2="+id
    var datosx=traerDataPrueba(parametros);
    if(datosx[0]==1){
        cargarTablaPerfilesExamenes();
    }  
}


function cargarTablaUsuariosHabilitadosXPuntoControl(){
    var patronModulo='cargarTablaUsuariosHabilitadosXPuntoControl';
    var parametros='';
    parametros+='p1='+patronModulo+'&p2='+tablaPuntosControl.cells(tablaPuntosControl.getSelectedId(),0).getValue();
    tablaUsuariosHabilitadosXPuntoControl=new dhtmlXGridObject('divTablaUsuariosHabilitados');
    tablaUsuariosHabilitadosXPuntoControl.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaUsuariosHabilitadosXPuntoControl.setSkin("dhx_skyblue");
    tablaUsuariosHabilitadosXPuntoControl.enableRowsHover(true,'grid_hover');
    tablaUsuariosHabilitadosXPuntoControl.attachEvent("onRowSelect", function(rowId,cellInd){
        switch(cellInd){
            case 2:
                eliminarUsuariosHabilitadosXPuntoControl();
                break
        }
    });
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaUsuariosHabilitadosXPuntoControl.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaUsuariosHabilitadosXPuntoControl.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaUsuariosHabilitadosXPuntoControl.setSkin("dhx_skyblue");
    tablaUsuariosHabilitadosXPuntoControl.init();
    tablaUsuariosHabilitadosXPuntoControl.loadXML(pathRequestControl+'?'+parametros);
}


function asignarUsuarioXPuntoControl(){
    if(tablaPuntosControl.getSelectedId()!=null){
        var parametros="";
        parametros="p1=asignarUsuarioXPuntoControl&p2="+tablaEmpleados.cells(tablaEmpleados.getSelectedId(),1).getValue();
        parametros+="&p3="+tablaPuntosControl.cells(tablaPuntosControl.getSelectedId(),0).getValue();
        //alert(parametros);
        var datosx=traerDataPrueba(parametros);
        if(datosx[0]==1){
            Windows.close("Div_podpadBusquedaEmpleado", "");
            cargarTablaUsuariosHabilitadosXPuntoControl();       
        }else{
            if(datosx[0]==0){
                alert("La persona debe tener un usuario habilitado contáctese con informática")
            }          
        }
    }
    else{
        alert("Seleccione un Punto de Control")
    }    
}


function podpadBusquedaEmpleadoPuntoControl(){
    varBusquedaEmpleado='1';
    var posFuncion = "";
    var vtitle="<h2>BUSQUEDA DE EMPLEADO</h2>";
    var vformname='podpadBusquedaEmpleado';
    var vwidth='940';
    var vheight='320';
    //'nuevaSubArea' llama al control y luego al actionRRHH y carga la vista vGuardarArea
    var patronModulo='podpadBusquedaEmpleado';
    var vcenter='t';
    var vresizable=''
    var vmodal='false';
    var vstyle='';
    var vopacity='';
    var veffect='';
    var vposx1='';
    var vposx2='';
    var vposy1='';
    var vposy2='';
    var parametros='';
    parametros+='p1='+patronModulo;
    this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
  
}

function eliminarUsuariosHabilitadosXPuntoControl(){
    if(tablaUsuariosHabilitadosXPuntoControl.getSelectedId()!=null){
        if(window.confirm("Esta seguro que desea eliminar al usuario ?")){
            var parametros="";
            parametros="p1=eliminarUsuariosHabilitadosXPuntoControl&p2="+tablaUsuariosHabilitadosXPuntoControl.cells(tablaUsuariosHabilitadosXPuntoControl.getSelectedId(),0).getValue();
            var datosx=traerDataPrueba(parametros);
            if(datosx[0]==1){
                cargarTablaUsuariosHabilitadosXPuntoControl();            
            }
        }
    }    
    else{
        alert("Seleccione un exámen")
    }    

}

//////////////////
///Parte para Jhon

//17/07/2012
var cambioFechaLaboratorio=""
function estadoCambioFechasConsultaLaboratorio(opc){
    if(opc.trim()==1){
        cambioFechaLaboratorio=1;
    }
    else{
        cambioFechaLaboratorio=0;
    }
}
//JCDB 17/07/2012
function cargarTablaEstadoExamenes(){
    var patronModulo='cargarTablaEstadoExamenes';
    var parametros='';
    parametros+='p1='+patronModulo;
    //+'&p2='+tablaPerfiles.cells(tablaPerfiles.getSelectedId(),0).getValue();
    parametros+='&p2='+document.getElementById('txtCodigo').value;
    parametros+='&p3='+document.getElementById('txtCodBar').value;
    parametros+='&p4='+document.getElementById('comboTipoDocumentos').value;
    parametros+='&p5='+document.getElementById('txtNroDoc').value;
    parametros+='&p6='+document.getElementById('txtApePat').value;
    parametros+='&p7='+document.getElementById('txtApeMat').value;
    parametros+='&p8='+document.getElementById('txtNombre').value;    
    parametros+='&p9='+document.getElementById('txtFechaIni').value;     
    // parametros+='&p10='+document.getElementById('txtFechaFinal').value;     
    tablaEstadoExamenes=new dhtmlXGridObject('divTablaEstadoExamenes');
    tablaEstadoExamenes.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaEstadoExamenes.setSkin("dhx_skyblue");
    tablaEstadoExamenes.enableRowsHover(true,'grid_hover');
    var parax = "";
    parax="p1=cargarComboProcedencia";
    var datosx=traerDataPrueba(parax);
    var filtroProcedencia=datosx[0];
    //    var filtroExamenesLab = "<input type='text' id='idFiltroExamenLab' style='width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarExamenesLab();\" />"; 
    var filtro1="<select id='comboProcedencia' type='text'></select>";
    var header = [,,,"#text_filter","#select_filter","#select_filter","#text_filter",filtroProcedencia,"#select_filter","#select_filter"]; 
    tablaEstadoExamenes.attachHeader(header); 
     
    tablaEstadoExamenes.attachEvent("onRowSelect", function(rowId,cellInd){
        switch(cellInd){
            case 16:
                siguientePasoExamen();
                break;
            case 17:
                var  idCodExamen = tablaEstadoExamenes.cells(rowId,1).getValue();
                formatoLaboratorio(idCodExamen);
                break; 
            case 18:
                var  idCodExamen = tablaEstadoExamenes.cells(rowId,1).getValue();
                reprogramarExamen(idCodExamen);
                break; 
            case 19:
                var  idCodExamen = tablaEstadoExamenes.cells(rowId,1).getValue();
                anularExamen(idCodExamen);
                break; 
        }
        //siguientePasoExamen();
    });
    //////////para cargador peche////////////////
 
    
    //    tablaEstadoExamenes.attachEvent("onCellChanged", function(rId,cInd,nValue){
    //        xyz1(rId,cInd,nValue);
    //    });
   
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaEstadoExamenes.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaEstadoExamenes.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    
    /////////////fin cargador ///////////////////////
    //    tablaEstadoExamenes.attachEvent("onRowDblClicked", function(rowId,cellInd){  
    //        //asignarExamenAPerfil();
    //    });  
    tablaEstadoExamenes.enableMultiline(true);
    tablaEstadoExamenes.init();
    //tablaEstadoExamenes.splitAt(2);
    tablaEstadoExamenes.loadXML(pathRequestControl+'?'+parametros,function(){ 
        //var casa;
        setColorTablaTablaEstadoExamenes();
        //            for(i=0;i<tablaEstadoExamenes.getRowsNum();i++){
        //                //casa = tablaEstadoExamenes.cells(i,9).getValue();
        //             tablaEstadoExamenes.setRowTextStyle(tablaEstadoExamenes.getRowId(i) ,'background-color:#C1E69D;color:black;border-top: 1px solid #DAEFC2;');
        //            }
    });
    tablaEstadoExamenes.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){
        if(stage==2 && cInd==7){
            return actualizarProcedenciaExamenLaboratorio(rId,nValue,oValue);
        }  
    });
}
function reprogramarExamen(idCodExamen){
    if(confirm("¿Está Seguro que desea reprogramar el examen?")){
        var patronModulo='reprogramarExamen';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+="&p2="+idCodExamen;
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
                cargarTablaEstadoExamenes();
            }
        }
    )
    }
}
function  anularExamen(idCodExamen){

    if(confirm("¿Está Seguro que desea anular el examen?")){
        var patronModulo='anularExamenPaciente';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+="&p2="+idCodExamen;
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
                cargarTablaEstadoExamenes();
            }
        }
    )
    }
}

//JCDB 23/07/2012
function buscarConsultaEstadoExamen(){
    cargarTablaEstadoExamenes();
    
    
}
//JCDB 23/07/2012
function limpiarCamposConsultaEstado(opc,elemento,evento){
    switch(opc)
    {
        case "01": //Busqueda por codigo
            document.getElementById('txtCodBar').value='';
            document.getElementById('comboTipoDocumentos').selected="selected";
            document.getElementById('comboTipoDocumentos').value="0001" ;
            document.getElementById('txtNroDoc').value='';
            document.getElementById('txtApePat').value='';
            document.getElementById('txtApeMat').value='';
            document.getElementById('txtNombre').value='';
            break;

        case "02": //Busqueda X codigo barra
            document.getElementById('txtCodigo').value='';
            document.getElementById('comboTipoDocumentos').selected="selected";
            document.getElementById('comboTipoDocumentos').value="0001" ;
            document.getElementById('txtNroDoc').value='';
            document.getElementById('txtApePat').value='';
            document.getElementById('txtApeMat').value='';
            document.getElementById('txtNombre').value='';

            break;
        case "03": //Busqueda por documento
            document.getElementById('txtCodBar').value='';
            document.getElementById('txtCodigo').value='';
            document.getElementById('txtApePat').value='';
            document.getElementById('txtApeMat').value='';
            document.getElementById('txtNombre').value='';
            break;
        case "04": //busqeuda por nombre
            document.getElementById('txtCodigo').value='';
            document.getElementById('txtCodBar').value='';
            document.getElementById('comboTipoDocumentos').selected="selected";
            document.getElementById('comboTipoDocumentos').value="0001" ;
            document.getElementById('txtNroDoc').value='';
            break;
        case "0": //boton limpiar
            document.getElementById('txtCodBar').value='';
            document.getElementById('txtCodBar').value='';
            document.getElementById('comboTipoDocumentos').selected="selected";
            document.getElementById('comboTipoDocumentos').value="0001" ;
            document.getElementById('txtNroDoc').value='';
            document.getElementById('txtApePat').value='';
            document.getElementById('txtApeMat').value='';
            document.getElementById('txtNombre').value='';
            break;
    }
    if(evento==''){
        tecla=13;
    }
    else{
        tecla=evento.keyCode
    }
    if(tecla==13){
        cargarTablaEstadoExamenes();
        document.getElementById('txtCodBar').select();
        //        var $cod,$codbar,$tipoDoc,$nDoc,$apPat,$apMat,$nombre;
        //        $cod=document.getElementById('txtCodigo').value;
        //        $codbar=document.getElementById('txtCodBar').value;
        //        $tipoDoc=document.getElementById('comboTipoDocumentos').value;
        //        $nDoc=document.getElementById('txtNroDoc').value;
        //        $apPat=document.getElementById('txtApePat').value;
        //        $apMat=document.getElementById('txtApeMat').value;
        //        $nombre=document.getElementById('txtNombre').value;
        //        alert('cod='+$cod+' codBar='+$codbar+' tipoDoc='+$tipoDoc+' NDoc='+$nDoc+' ApPat='+$apPat+' ApMat='+$apMat+' Nom='+$nombre);
        //        //buscarEmpleados($cod,$estado,$tipoDoc,$nDoc,$apPat,$apMat,$nombre);
    }
} 
function setColorTablaTablaEstadoExamenes(){
    var color='';
    var finalizado='';
    for(var i=0;i<tablaEstadoExamenes.getRowsNum();i++){
        color = tablaEstadoExamenes.cells(i,10).getValue();
        //tablaEstadoExamenes.setRowTextStyle(tablaEstadoExamenes.getRowId(i) ,'background-color:'+color+';color:black;border-top: 1px solid #DAEFC2;');
       
        tablaEstadoExamenes.cells(i,7).setBgColor(color);
        
        //alert(color);
    }
    for(var i=0;i<tablaEstadoExamenes.getRowsNum();i++){
        
        //tablaEstadoExamenes.setRowTextStyle(tablaEstadoExamenes.getRowId(i) ,'background-color:'+color+';color:black;border-top: 1px solid #DAEFC2;');
        finalizado = tablaEstadoExamenes.cells(i,9).getValue();
        if(finalizado=='Finalizado'){
            //tablaEstadoExamenes.setRowTextStyle(tablaEstadoExamenes.getRowId(i) ,'background-color:#84A9C9;color:black;border-top: 1px solid #DAEFC2;');
            tablaEstadoExamenes.setRowColor(i,"#84A9C9");
        }
        if(finalizado=='Anulado'){
            //tablaEstadoExamenes.setRowTextStyle(tablaEstadoExamenes.getRowId(i) ,'background-color:#84A9C9;color:black;border-top: 1px solid #DAEFC2;');
            tablaEstadoExamenes.setRowColor(i,"#ABAAAA");
        }
        
        //alert(color);
    }
    
}


function siguientePasoExamen(){
    var idTipoProceso=tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),12).getValue();
    var bRecibir=tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),14).getValue();
    var idPacienteLaboratorioPuntoControl=tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),1).getValue();
    var nombreExamen=tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),6).getValue();
    var nombrePaciente=tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),4).getValue();
    var fechaExamen=tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),2).getValue();
    var afiliacion=tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),5).getValue();
    var procedencia=tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),7).getValue();
    var idPacienteLaboratorio=tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),1).getValue();
    var codigoBarras=tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),15).getValue();
    var funcionCerrar='buscarConsultaEstadoExamen()';
    var posFuncion ="acordionHistorial";
    var vtitle="Historial del Examen";
    var vformname='historialExamen';
    var vwidth='800';
    var vheight='600';
    var patronModulo='historialExamen';
    var vcenter='t';
    var vresizable='';
    var vmodal='false';
    var vstyle='';
    var vopacity='';
    var veffect='';
    var vposx1='';
    var vposx2='';
    var vposy1='20';
    var vposy2='35'; 
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+="&p2="+nombreExamen;
    parametros+="&p3="+nombrePaciente;
    parametros+="&p4="+fechaExamen;
    parametros+="&p5="+afiliacion;
    parametros+="&p6="+procedencia;
    parametros+="&p7="+idPacienteLaboratorio;
    parametros+="&p8="+codigoBarras;
    parametros+="&p9="+funcionCerrar;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
    // recepcionFrasco();
}
function acordionHistorial(){
    var cadenaAcordion=$('textAcordion').value;
    var idAbierto=$('textAbierto').value;
    var arrayAcordion=cadenaAcordion.split("|");
    var numeroAcordion=arrayAcordion.length;
    var idItem;
    var nombreItem;
    var dhxAccord;
    
    dhxAccord = new dhtmlXAccordion("contenedorAcordion");
    //dhxAccord.enableMultiMode();
    for (var i=0;i<numeroAcordion;i++){
        datosItem=arrayAcordion[i].split("*");
        acordion='peche'+i;
        dhxAccord.addItem(acordion,datosItem[1] );
        dhxAccord.cells(acordion).attachObject(datosItem[0]);
    } 
    dhxAccord.openItem('peche'+idAbierto);
}



function grabarDatoLaboratorio(tipoDato,idDatoExamenPacienteLaboratorio,objeto,idProcesarPuntoControl,idDatoPuntoControl){
    //    alert(tipoDato);
    //    alert(idDatoExamenPacienteLaboratorio);
    //    alert(objeto.value);
    if(idDatoExamenPacienteLaboratorio==0){
        idDatoExamenPacienteLaboratorio=trimJunny(objeto.name);
    }
    // var idddd=objeto.id;
    //alert(idddd);
    //    var arrayaux=idddd.split(" ");
    //    var salto=arrayaux[0]+'_'+(parseInt(arrayaux[1])+1)
    //    $(salto).focus();
    var patronModulo='grabarDatoLaboratorio';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+="&p2="+(tipoDato);
    parametros+="&p3="+(idDatoExamenPacienteLaboratorio);
    parametros+="&p4="+(objeto.value);
    parametros+="&p5="+(idProcesarPuntoControl);
    parametros+="&p6="+(idDatoPuntoControl);
    
    
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
            objeto.name=respuesta;
            

        }
    }
)
    
}
function validaDecimalLaboratorio(evento,elemento,dato){
    var tecla;
    if(evento==''){
        tecla=13;
    }else{
        tecla=evento.keyCode
    }
    var idddd;
    var arrayaux;
    var saltoPeche;
    if(tecla==40){
        idddd=elemento.id;
        //alert(idddd);
        arrayaux=idddd.split("_");
        saltoPeche=arrayaux[0]+'_'+(parseInt(arrayaux[1])+1)
        //alert(saltoPeche);
        if($(saltoPeche)==null){
            // $(saltoPeche).focus(); 
        }else{
            $(saltoPeche).focus(); 
        }
        
       
        
    }
    if(tecla==38){
        idddd=elemento.id;
        //alert(idddd);
        arrayaux=idddd.split("_");
        saltoPeche=arrayaux[0]+'_'+(parseInt(arrayaux[1])-1)
        //alert(saltoPeche);
        if(parseInt(arrayaux[1])-1>0){
            $(saltoPeche).focus();  
        }
        
    }
    
    //alert(tecla);
    var valor=elemento.value;
    var longitud=valor.length;
    var ultimoCaracter=valor.substr(valor.length-1, valor.length);
    if(ultimoCaracter=='.'){
        if(valor.substr(0, valor.length-1).indexOf(ultimoCaracter)!=-1){
            elemento.value=valor.substr(0, valor.length-1);
        }
    }
    //alert(ultimoCaracter);
    if(("0123456789.").indexOf(ultimoCaracter)==-1){
        elemento.value=valor.substr(0, valor.length-1);
    }
}
function saltoVarchar(evento,elemento,dato){
    var tecla;
    if(evento==''){
        tecla=13;
    }else{
        tecla=evento.keyCode
    }
    var idddd;
    var arrayaux;
    var saltoPeche;
    if(tecla==40){
        idddd=elemento.id;
        //alert(idddd);
        arrayaux=idddd.split("_");
        saltoPeche=arrayaux[0]+'_'+(parseInt(arrayaux[1])+1)
        //alert(saltoPeche);
        $(saltoPeche).focus(); 
    }
    if(tecla==38){
        idddd=elemento.id;
        //alert(idddd);
        arrayaux=idddd.split("_");
        saltoPeche=arrayaux[0]+'_'+(parseInt(arrayaux[1])-1)
        //alert(saltoPeche);
        if(parseInt(arrayaux[1])-1>0){
            $(saltoPeche).focus();  
        }
        
    }
}
function validaIntegers(evento,elemento,dato){
    var tecla;
    if(evento==''){
        tecla=13;
    }else{
        tecla=evento.keyCode
    }
    var idddd;
    var arrayaux;
    var saltoPeche;
    if(tecla==40){
        idddd=elemento.id;
        arrayaux=idddd.split("_");
        saltoPeche=arrayaux[0]+'_'+(parseInt(arrayaux[1])+1)
        $(saltoPeche).focus(); 
    }
    if(tecla==38){
        idddd=elemento.id;
        //alert(idddd);
        arrayaux=idddd.split("_");
        saltoPeche=arrayaux[0]+'_'+(parseInt(arrayaux[1])-1)
        //alert(saltoPeche);
        if(parseInt(arrayaux[1])-1>0){
            $(saltoPeche).focus();  
        }
        
    }
    var valor=elemento.value;
    var longitud=valor.length;
    var ultimoCaracter=valor.substr(valor.length-1, valor.length);
    //alert(ultimoCaracter);
    if(("0123456789").indexOf(ultimoCaracter)==-1){
        elemento.value=valor.substr(0, valor.length-1);
    }
}
function grabarDatoLaboratorioNulos(tipoDato,idDatoExamenPacienteLaboratorio,id,idProcesarPuntoControl,idDatoPuntoControl){
    //    alert(tipoDato);
    //    alert(idDatoExamenPacienteLaboratorio);
    //    alert(objeto.value);
    if(idDatoExamenPacienteLaboratorio==0){
        idDatoExamenPacienteLaboratorio=trimJunny($('valor_'+id).name);
    }
    if(idDatoExamenPacienteLaboratorio==0){
        var patronModulo='grabarDatoLaboratorio';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+="&p2="+(tipoDato);
        parametros+="&p3="+(idDatoExamenPacienteLaboratorio);
   
        parametros+="&p4="+($('valor_'+id).value);
        parametros+="&p5="+(idProcesarPuntoControl);
        parametros+="&p6="+(idDatoPuntoControl);
    
    
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
                $('valor_'+id).name=respuesta;

            }
        }
    )
    }
    
    
}
function terminarProceso(iIdProcesarPuntoControl,funcion){
    var valido=1;
    var numeroCampos=$('numeroCampos').value;
    var obligatorio='';
    var valor='';
    var colorObligatorio='#F27F7D';
    var colorListo='#ffffff';
    for( var i=1;i<parseInt(numeroCampos)+1;i++){
        //alert (i);
        valor=$('valor_'+i).value;
        obligatorio=$('obligatorio_'+i).value;
        valor=trimJunny(valor);
        if(valor==''){
            if(obligatorio==' (*)'){
                valido=0;
                $('valor_'+i).setStyle({
                    background:colorObligatorio
                        
                });
            }else{
                eval($('funcioNulos_'+i).value);
            }
        }else{
            $('valor_'+i).setStyle({
                background:colorListo
                        
            });
        }
        
    }
    // alert(valido);
    if(valido==1){
        var observacion=$('textObservacion'+iIdProcesarPuntoControl).value
        var patronModulo='terminarProceso';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+="&p2="+(iIdProcesarPuntoControl);
        parametros+="&p3="+observacion;
    
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
                //                alert(respuesta)
                if(trimJunny(respuesta)=='ok'){
                    
                    alert('Procesado exitosamente');
                    // funcion que envia un arrchivo excel a otra pagina y elimina
                    // // lobo
                    eviarArchivoExcel();
                    Windows.close("Div_historialExamen");
                    //buscarConsultaEstadoExamen();
                    eval(funcion);
                    
                             
                }

            }
        }
    )
    }else{
        alert('los Campos con (*) son obligatorios');
    }  
}

function recibirProceso(iIdProcesarPuntoControl,funcion){
    var observacion=$('textObservacion'+iIdProcesarPuntoControl).value;
    var patronModulo='recibirProceso';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+="&p2="+(iIdProcesarPuntoControl);
    parametros+="&p3="+observacion;
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
            //alert(respuesta)
            if(respuesta>0){
                alert('Recibido exitisamente');
                Windows.close("Div_historialExamen");
                //buscarConsultaEstadoExamen();
                eval(funcion);
            }

        }
    }
)
}
function entregaFrasco(){
    popudEntregaFrasco();
}
function popudEntregaFrasco(){
    var posFuncion ="cargarDatosEntregaFrasco";
    var vtitle="Entrega de Frasco";
    var vformname='vpopudEntregaFrasco';
    var vwidth='416';
    var vheight='372';
    var patronModulo='popudEntregaFrasco';
    var vcenter='t';
    var vresizable='';
    var vmodal='false';
    var vstyle='';
    var vopacity='';
    var veffect='';
    var vposx1='';
    var vposx2='';
    var vposy1='';
    var vposy2=''; 
    var parametros='';
    parametros+='p1='+patronModulo;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}
//peche 05/09/2012
function editarCodigoBarras(){
    $('txtCodigoBarras').readOnly=false;
    $('iconoGrabarCodigoBarras').show();
    $('iconoCancelarCodigoBarras').show();
    $('iconoEditarCodigoBarras').hide();
    $('txtCodigoBarras').focus();
}
function cancelarCodigoBarras(){
    $('txtCodigoBarras').readOnly=true;
    $('iconoGrabarCodigoBarras').hide();
    $('iconoCancelarCodigoBarras').hide();
    $('iconoEditarCodigoBarras').show();
    
}

function editarCodBarra2(){
    $('txtCodBarra2').readOnly=false;
    $('iconoGrabarCodigoBarras2').show();
    $('iconoCancelarCodigoBarras2').show();
    $('idtxtCodBarra2').hide();
    $('txtCodBarra2').focus();
}
function cancelarCodigoBarras2(){
    $('txtCodBarra2').readOnly=true;
    $('iconoGrabarCodigoBarras2').show();
    $('iconoCancelarCodigoBarras2').hide();
    $('idtxtCodBarra2').show();
    
}

function modificarCodigoBarras1(){
    var codigoBarras=$('txtCodigoBarras').value;
    var idPacienteLaboratorio=$('txtIdPacienteLaboratorio').value;
    var patronModulo='modificarCodigoBarras';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+="&p2="+codigoBarras;
    parametros+="&p3="+idPacienteLaboratorio;
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
            $('txtCodigoBarras').readOnly=true;
            $('iconoGrabarCodigoBarras').hide();
            $('iconoCancelarCodigoBarras').hide();
            $('iconoEditarCodigoBarras').show();
            
            $('txtCodBarra2').value=$('txtCodigoBarras').value;
        }
    }
)
}

function modificarCodigoBarras(e){
    var tecla=(document.all) ? e.keyCode : e.which;
    if(tecla == 13){   
        var codigoBarras=$('txtCodigoBarras').value;
        var idPacienteLaboratorio=$('txtIdPacienteLaboratorio').value;
        var patronModulo='modificarCodigoBarras';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+="&p2="+codigoBarras;
        parametros+="&p3="+idPacienteLaboratorio;
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
                $('txtCodigoBarras').readOnly=true;
                $('iconoGrabarCodigoBarras').hide();
                $('iconoCancelarCodigoBarras').hide();
                $('iconoEditarCodigoBarras').show();
                $('txtCodBarra2').value=$('txtCodigoBarras').value;
            }
        }
    )
    }
}



function modificarCodigoBarras2(e){
    
    var tecla=(document.all) ? e.keyCode : e.which;
    if(tecla == 13){       
        var codigoBarras=$('txtCodBarra2').value;
        var idPacienteLaboratorio=$('txtIdPacienteLaboratorio').value;
        var patronModulo='modificarCodigoBarras';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+="&p2="+codigoBarras;
        parametros+="&p3="+idPacienteLaboratorio;
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
                $('txtCodBarra2').readOnly=true;
                $('iconoGrabarCodigoBarras2').hide();
                $('iconoCancelarCodigoBarras2').hide();
                $('idtxtCodBarra2').show();
                
                $('txtCodigoBarras').value=$('txtCodBarra2').value;
            }
        }
    )
    }
}


function modificarCodigoBarras3(){     
    var codigoBarras=$('txtCodBarra2').value;
    var idPacienteLaboratorio=$('txtIdPacienteLaboratorio').value;
    var patronModulo='modificarCodigoBarras';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+="&p2="+codigoBarras;
    parametros+="&p3="+idPacienteLaboratorio;
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
            $('txtCodBarra2').readOnly=true;
            $('iconoGrabarCodigoBarras2').hide();
            $('iconoCancelarCodigoBarras2').hide();
            $('idtxtCodBarra2').show();
            
            $('txtCodigoBarras').value=$('txtCodBarra2').value;
        }
    }
)
}
function editarMaterialPersona(iidPacientePuntoControlMateriales){
    $('material_'+iidPacientePuntoControlMateriales).readOnly=false;
    $('iconoGrabarMaterial_'+iidPacientePuntoControlMateriales).show();
    $('iconoCancelarMaterial_'+iidPacientePuntoControlMateriales).show();
    $('iconoEditarMaterial_'+iidPacientePuntoControlMateriales).hide();
    $('material_'+iidPacientePuntoControlMateriales).focus();
}
function cancelarMaterialPersona(iidPacientePuntoControlMateriales){
    $('material_'+iidPacientePuntoControlMateriales).readOnly=true;
    $('iconoGrabarMaterial_'+iidPacientePuntoControlMateriales).hide();
    $('iconoCancelarMaterial_'+iidPacientePuntoControlMateriales).hide();
    $('iconoEditarMaterial_'+iidPacientePuntoControlMateriales).show();
    
}
function modificarMaterialPersona(iidPacientePuntoControlMateriales){
    var cantidad=$('material_'+iidPacientePuntoControlMateriales).value;
    
    var patronModulo='modificarMaterialPersona';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+="&p2="+iidPacientePuntoControlMateriales;
    parametros+="&p3="+cantidad;
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
            $('material_'+iidPacientePuntoControlMateriales).readOnly=true;
            $('iconoGrabarMaterial_'+iidPacientePuntoControlMateriales).hide();
            $('iconoCancelarMaterial_'+iidPacientePuntoControlMateriales).hide();
            $('iconoEditarMaterial_'+iidPacientePuntoControlMateriales).show();
        }
    }
)
    
    
}

function editarTelefonos(){
    $('txtTelefono').readOnly=false;
    $('txtCell1').readOnly=false;
    $('txtCell2').readOnly=false;
    $('iconoGrabarTelefono').show();
    $('iconoCancelarTelefono').show();
    $('iconoEditarTelefono').hide();
    $('txtTelefono').focus();
}
function cancelarTelefonos(){
    $('txtTelefono').readOnly=true;
    $('txtCell1').readOnly=true;
    $('txtCell2').readOnly=true;
    $('iconoGrabarTelefono').hide();
    $('iconoCancelarTelefono').hide();
    $('iconoEditarTelefono').show();
    
}

function modificarTelefonos(){
    var telefono=$('txtTelefono').value;
    var celular1=$('txtCell1').value;
    var celular2=$('txtCell2').value;
    var codPaciente=$('txtIdPacienteLaboratorio').value;
    var codigoTelefono=$('txtCidContactoTelefono').value;
    var codigoCelular1=$('txtCidContactoCelular1').value;
    var codigoCelular2=$('txtCidContactoCelular2').value;  
    var patronModulo='MantenimientoDinamico';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+="&p2="+codPaciente;
    parametros+="&p3="+telefono;
    parametros+="&p4="+codigoTelefono;
    parametros+="&p5="+celular1;
    parametros+="&p6="+codigoCelular1;
    parametros+="&p7="+celular2;
    parametros+="&p8="+codigoCelular2;
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
            $('txtTelefono').readOnly=true;
            $('txtCell1').readOnly=true;
            $('txtCell2').readOnly=true;
            $('iconoGrabarTelefono').hide();
            $('iconoCancelarTelefono').hide();
            $('iconoEditarTelefono').show();
        }
    }
)
    
    
}
//JCDB 26/07/2012
function cargarDatosEntregaFrasco(){
    var parametros="";
    parametros="p1=cargarDatosEntregaFrasco&p2="+tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),12).getValue();
    //alert(parametros);
    var datosx=traerDataPrueba(parametros);
    //alert(datosx[0]);
    //alert(datosx[1]);
    document.getElementById('h1DescripcionEntregaFrasco').innerHTML=datosx[0];
    document.getElementById('imgEntregaFrasco').src=datosx[1];
}
//JCDB 26/07/2012
function procesarEntregaFrasco(){
    if(confirm("¿Está Seguro que desea procesar la entrega del frasco?")){
        if(insertarSiguientePuntoControlExamenLaboratorio(tablaEstadoExamenes.getSelectedId())){
            cargarTablaEstadoExamenes();
            Windows.close("Div_vpopudEntregaFrasco");
        }
        else{
            Windows.close("Div_vpopudEntregaFrasco");
        }
    }
}

function cerrarPopupEntregaFrasco(){
    Windows.close("Div_vpopudEntregaFrasco");
}

function  actualizarProcedenciaExamenLaboratorio(rId,nValue,oValue){
    //    //idPacienteLaboratorio
    if(tablaEstadoExamenes.getSelectedId()!=null && !isNaN(nValue)){
        var parametros="";
        parametros="p1=actualizarProcedenciaExamenLaboratorio&p2="+tablaEstadoExamenes.cells(rId,1).getValue()
        parametros+="&p3="+nValue;
        var datosx=traerDataPrueba(parametros);
        if(datosx[0]=='1'){
            //tablaEstadoExamenes.setRowTextStyle(tablaEstadoExamenes.getRowId(rId) ,'background-color:'+datosx[1]+';color:black;border-top: 1px solid #DAEFC2;');          
            //tablaEstadoExamenes.cells(rId,6).setBgColor(datosx[1]);  
            setColorTablaTablaEstadoExamenes();
            return true;
        } 
        else{
            return false
        }         
    }    
    else{
        alert("Seleccione un exámen");
        return false;
    }    
}   
//25/07/2012
function insertarSiguientePuntoControlExamenLaboratorio(){
    if(tablaEstadoExamenes.getSelectedId()!=null){
        //if(id!=null){
        //if(tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),13).getValue()!=0){
        var parametros="";
        parametros="p1=insertarSiguientePuntoControlExamenLaboratorio&p2="+tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),1).getValue();
        parametros+="&p3="+tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),13).getValue();
        var datosx=traerDataPrueba(parametros);
        if(datosx[0]=='1'){
            return true;
        } 
        else{
            return false;
        }
        //        }
        //        else{
        //            return false;
        //        }
    }    
    else{
        return false;
    }  
}

function recepcionFrasco(){
    //var posFuncion ="cargarDatosRecepcionFrasco";
    var posFuncion ="cargarDatosRecepcionFrasco";
    var vtitle="Recepción de Muestra";
    var vformname='vPopudRecepcionFrasco';
    var vwidth='416';
    var vheight='332';
    var patronModulo='popudRecepcionFrasco';
    var vcenter='t';
    var vresizable='';
    var vmodal='false';
    var vstyle='';
    var vopacity='';
    var veffect='';
    var vposx1='';
    var vposx2='';
    var vposy1='';
    var vposy2=''; 
    var parametros='';
    var cerrar= 'killTz1';
    parametros+='p1='+patronModulo;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}
//JCDB 30/07/2012
var fechaLaboratorio;
var tz1
function cargarDatosRecepcionFrasco(){
    //alert("hola");
    var parax="";
    parax="p1=capturaFechaLaboratorio";
    var datosx=traerDataPrueba(parax);
    fechaLaboratorio=new Date(datosx[0].trim());
    document.getElementById('Div_vPopudRecepcionFrasco_close').addEventListener('click',function (e) {
        killTz1();
    },true);
    document.getElementById('txtEntregadoPor').value=tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),3).getValue();
    document.getElementById('txtProcedencia').value=tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),6).getValue();
    document.getElementById('txtCodigoBarra').value=tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),14).getValue();
    var parametros=""; 
    parametros="p1=cargarDatosRecepcionFrasco&p2="+tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),12).getValue();
    parametros+="&p3="+tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),1).getValue();
    parametros+="&p4="+tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),0).getValue();
    var datosx=traerDataPrueba(parametros);
    document.getElementById('txtTipoMuestra').value=datosx[0];
    document.getElementById('txtTelefono').value=datosx[1];
    document.getElementById('txtUsuario').value=datosx[2];
    document.getElementById('imgEntregaFrasco').src=datosx[3];
    document.getElementById('txtAreaObservaciones').value=datosx[4];
    //alert(datosx[0]+' 1  '+datosx[1]+' 2 '+datosx[2]+' 3 '+datosx[3]);
    // showXX();
    startTime();
}
//JCDB 31/07/2012
function recepcionarFrasco(){
    if(confirm("¿Está Seguro que desea procesar la Recepcion del frasco?")){
        var parametros=""; 
        parametros="p1=recepcionarFrasco&p2="+ tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),0).getValue();
        parametros+="&p3="+tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),1).getValue();
        parametros+="&p4="+tablaEstadoExamenes.cells(tablaEstadoExamenes.getSelectedId(),12).getValue();
        parametros+="&p5="+document.getElementById('txtTelefono').value.trim();
        parametros+="&p6="+document.getElementById('txtAreaObservaciones').value.trim();
        parametros+="&p7="+document.getElementById('txtCodigoBarra').value;
        var datosx=traerDataPrueba(parametros);
        //alert(datosx[0].trim());
        switch(datosx[0].trim()){
            case '1':{
                    insertarSiguientePuntoControlExamenLaboratorio();
                    cargarTablaEstadoExamenes();
                    killTz1();
                    Windows.close("Div_vPopudRecepcionFrasco");
                    break;
                }
            case '0':{
                    insertarSiguientePuntoControlExamenLaboratorio();
                    cargarTablaEstadoExamenes();
                    killTz1();
                    Windows.close("Div_vPopudRecepcionFrasco");
                    break;
                }
            case '-1': {
                    alert("El codigo de barra ingresado es duplicado");
                    break;
                }
        }
        //     
    }
}
//JCDB 31/07/2012


//clearTimeout(tz1);
function startTime()
{  //alert("hola");
    var h=fechaLaboratorio.getHours();
    var m=fechaLaboratorio.getMinutes();
    var s=fechaLaboratorio.getSeconds();
    
    var dd = fechaLaboratorio.getDate(); 
    var mm = fechaLaboratorio.getMonth()+1;
    var yyyy = fechaLaboratorio.getFullYear(); 
    m=checkTime(m);
    s=checkTime(s);
    dd=checkTime(dd);
    mm=checkTime(mm);
    document.getElementById('txtHora').value=h+":"+m+":"+s;
    document.getElementById('txtFecha').value=dd+"/"+mm+"/"+yyyy;
    fechaLaboratorio.setMilliseconds(fechaLaboratorio.getMilliseconds()+ 500);
    tz1=setTimeout('startTime()',500);
}
function checkTime(i)
{
    if (i<10){
        i="0" + i;
    }
    return i;
}
function killTz1(){
    clearTimeout(tz1);
}
function cerrarPopudRecepcionFrasco(){
    killTz1();
    Windows.close("Div_vPopudRecepcionFrasco");
}

function filterByProcedencia(){
    if(document.getElementById('comboProcedencia').value == -1){
        tablaEstadoExamenes.filterBy(6,""); 
    }
    else{
        tablaEstadoExamenes.filterBy(6,document.getElementById('comboProcedencia').options[document.getElementById('comboProcedencia').selectedIndex].text);
        //tablaEstadoExamenes.filterByAll();
    }
}

function htcc(e,id){
    var tecla = (document.all) ? e.keyCode : e.which;
    var a;
    var num=document.getElementById(id).value;
    if((tecla==null)  || (tecla==8) || (tecla==0)|| (tecla==13) || (tecla==27)|| (tecla==9)  ) return true; // 3
    
    if(num!=null && validar(e,5)){
        //alert("valido");
        a= String.fromCharCode(tecla);         
        //alert(num.length);
        if(num.length==0 && a=='-'){
            //alert(a);
            return true;
        }else{
            if(!isNaN(num+a)){
                //alert(isNaN(num))
                return true;
            }
            else{
                if(a=='-'){
                    num*=-1;
                    document.getElementById(id).value=num;
                    return false;
                }else{
                    return false;
                }
            }
        }
    }
    else {
        //alert("invalido");
        return false;
    }
}

function CargarDatosResultadosLaboratorio(){

    var txtCodigoBarras=$('txtCodigoBarras').value;
    var numeroCampos=$('numeroCampos').value;
    var idPacienteLaboratorio=$('txtIdPacienteLaboratorio').value;
    
//        alert(idPacienteLaboratorio);
    var patronModulo='CargarDatosResultadosLaboratorio';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+="&p2="+txtCodigoBarras;
    parametros+="&p3="+numeroCampos;
    parametros+="&p4="+idPacienteLaboratorio;
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
                     alert(respuesta)
            for( var m=1 ;m<= parseInt(numeroCampos) ;m++){
                $('valor_'+m).value=''; 
            }
            if(respuesta !=''){
                if(trim(respuesta) !=200){ 
                    var j=1
                    var arrayRespuesta=respuesta.split("***");
                    //                for( var i=1;i<parseInt(numeroCampos)+1;i++){
                    for( var i=1;i<= arrayRespuesta.length  ;i++){
                        //                    var obligatorio=$('contador_'+i).value;

//                                            alert(arrayRespuesta[i-1]);
                        var arrayRespuestaDatos=arrayRespuesta[i-1].split("---");
                        //                    alert(arrayRespuestaDatos[0]);
                        //                    $('valor_'+i).value=1;
                        for( ;j<= parseInt(numeroCampos) ;j++){
                            if(arrayRespuestaDatos[0]==j){                           
                                $('valor_'+arrayRespuestaDatos[0]).value=arrayRespuestaDatos[1];
                                
                                var tipoDatos=  $('tipoDatos_'+arrayRespuestaDatos[0]).value ;
                                var idDatoExamenPacienteLaboratorio=  $('idDatoExamenPacienteLaboratorio_'+arrayRespuestaDatos[0]).value ;
                                var idProcesarPuntoControl=  $('idProcesarPuntoControl_'+arrayRespuestaDatos[0]).value ;
                                var idDatoPuntoControl=  $('idDatoPuntoControl_'+arrayRespuestaDatos[0]).value ;
                                grabarDatoLaboratorio(tipoDatos,idDatoExamenPacienteLaboratorio,$('valor_'+arrayRespuestaDatos[0]),idProcesarPuntoControl,idDatoPuntoControl);
                                //                               grabarDatoLaboratorio($tipoDato,$idDatoExamenPacienteLaboratorio,this,$idProcesarPuntoControl,$idDatoPuntoControl)
                                
                                j=arrayRespuestaDatos[0];
                                break;
                            }           
                        }               
                    }
                }else {
                    alert("ARCHIVO EN PROCESO");
                }
            }
        }
    }
)
}

//function terminarProceso(iIdProcesarPuntoControl,funcion){
//    var valido=1;
//    var numeroCampos=$('numeroCampos').value;
//    var obligatorio='';
//    var valor='';
//    var colorObligatorio='#F27F7D';
//    var colorListo='#ffffff';
//    for( var i=1;i<parseInt(numeroCampos)+1;i++){
//        //alert (i);
//        valor=$('valor_'+i).value;
//        obligatorio=$('obligatorio_'+i).value;
//        valor=trimJunny(valor);
//        if(valor==''){
//            if(obligatorio==' (*)'){
//                valido=0;
//                $('valor_'+i).setStyle({
//                    background:colorObligatorio
//                        
//                });
//            }else{
//                eval($('funcioNulos_'+i).value);
//            }
//        }else{
//            $('valor_'+i).setStyle({
//                background:colorListo
//                        
//            });
//        }
//        
//    }
//}
//////////////////
///Parte para Jhon


function enfocarCampos(evento,id){
    if(evento.keyCode==9){
        if(id=='txtCodigo'){
            document.getElementById('txtCodBar').focus();
        }
        if(id=='comboTipoDocumentos'){
            document.getElementById('txtNroDoc').focus();
         
        }
        if(id=='txtApePat'){
            document.getElementById('txtApeMat').focus();
        
        }
        if(id=='txtNombre'){
            document.getElementById('txtFechaIni').focus();
        
        }
        if(id=='txtCodBar'){
            document.getElementById('comboTipoDocumentos').focus();
         
        }
        if(id=='txtNroDoc'){
            document.getElementById('txtApePat').focus();
     
        }
        if(id=='txtApeMat'){
            document.getElementById('txtNombre').focus();

        }
    }
}

function generarCodigoBarra(){
    creaCodigoBarraPDF(document.getElementById('txtRangoCodigoBarraInicio').value,document.getElementById('txtRangoCodigoBarraFinal').value,document.getElementById('ComboEscala').value);
}

function creaCodigoBarraPDF(rangoIni,rangoFin,escala){
    if(isNaN(rangoIni)&&isNaN(rangoFin)){
        alert("Los Rangos Ingresados deben ser numericos")
    }
    else{      
        if(rangoIni<=rangoFin){
            var datos="p1="+rangoIni;
            datos+="&p2="+rangoFin;
            datos+="&p3="+escala;
            var ruta="../../cvista/laboratorio/generacionCodigoBarraPDF?"+datos;
            window.open(ruta);
        }
    }
}
function botonOne(){
    var ruta="../../../tcPDF/tcpdf/tcpdf/examples/";
    window.open(ruta); 
}
function capturaRangosCodigoBarra(){
    var parametros="";
    parametros="p1=capturaRangosCodigoBarra";
    var datosx=traerDataPrueba(parametros);
    document.getElementById('txtRangoCodigoBarraInicio').value=datosx[0];
    document.getElementById('txtRangoCodigoBarraFinal').value=datosx[1];
}

function cargarTablaRangoCodigoBarra(){
    var patronModulo='cargarTablaRangoCodigoBarra';
    var parametros='';
    parametros+='p1='+patronModulo;
    tablaRangoCodigoBarra=new dhtmlXGridObject('DivTablaRangoCodigoBarra');
    tablaRangoCodigoBarra.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaRangoCodigoBarra.setSkin("dhx_terrace");
    tablaRangoCodigoBarra.enableRowsHover(true,'grid_hover');
    tablaRangoCodigoBarra.attachEvent("onRowSelect", function(rowId,cellInd){
        switch(cellInd){
            case 3:
                creaCodigoBarraPDF(tablaRangoCodigoBarra.cells(rowId,1).getValue(),tablaRangoCodigoBarra.cells(rowId,2).getValue());
                break;
        }
    });
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaRangoCodigoBarra.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaRangoCodigoBarra.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaRangoCodigoBarra.setSkin("dhx_terrace");
    tablaRangoCodigoBarra.init();
    tablaRangoCodigoBarra.loadXML(pathRequestControl+'?'+parametros);
}


//function validarMaximo(){
//    var Valor=  document.getElementById('txtNumerosDeColumna').value
//    if(Valor>=7){
//        alert("El numero maximo de columnas soportadas es 6");
//        document.getElementById('txtNumerosDeColumna').value=6;
//    }
//}

function str_replace (search, replace, subject, count) {
    // http://kevin.vanzonneveld.net
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Gabriel Paderni
    // +   improved by: Philip Peterson
    // +   improved by: Simon Willison (http://simonwillison.net)
    // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +   bugfixed by: Anton Ongson
    // +      input by: Onno Marsman
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +    tweaked by: Onno Marsman
    // +      input by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   input by: Oleg Eremeev
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Oleg Eremeev
    // %          note 1: The count parameter must be passed as a string in order
    // %          note 1:  to find a global variable in which the result will be given
    // *     example 1: str_replace(' ', '.', 'Kevin van Zonneveld');
    // *     returns 1: 'Kevin.van.Zonneveld'
    // *     example 2: str_replace(['{name}', 'l'], ['hello', 'm'], '{name}, lars');
    // *     returns 2: 'hemmo, mars'
    var i = 0,
    j = 0,
    temp = '',
    repl = '',
    sl = 0,
    fl = 0,
    f = [].concat(search),
    r = [].concat(replace),
    s = subject,
    ra = Object.prototype.toString.call(r) === '[object Array]',
    sa = Object.prototype.toString.call(s) === '[object Array]';
    s = [].concat(s);
    if (count) {
        this.window[count] = 0;
    }

    for (i = 0, sl = s.length; i < sl; i++) {
        if (s[i] === '') {
            continue;
        }
        for (j = 0, fl = f.length; j < fl; j++) {
            temp = s[i] + '';
            repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
            s[i] = (temp).split(f[j]).join(repl);
            if (count && s[i] !== temp) {
                this.window[count] += (temp.length - s[i].length) / f[j].length;
            }
        }
    }
    return sa ? s : s[0];
}

function eviarArchivoExcel(){
    estadoBoton=0;
    if(document.getElementById("estado_1")){
        var estadoBoton= $('estado_1').value;
    }
    
    if(estadoBoton==1){
        var txtCodigoBarras=$('txtCodigoBarras').value;
        var patronModulo='eviarArchivoExcel';
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+="&p2="+txtCodigoBarras;
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
          
            }
        }
    )
    }

}

function noeditarFecha(){
   
   
    if(document.getElementById("checkFecha").checked){
        $('textFecha').value=$('htextFecha').value ;
        document.getElementById("textFecha").disabled=false;
    }else {
        $('textFecha').value='';
        document.getElementById("textFecha").disabled=true;
    }
   
}

function filterByProcedenciaFiltro(){

    if(document.getElementById('comboProcedencia').value == -1){
        tablaPersonaPuntoControl.filterBy(8,""); 
    }
    else{
        tablaPersonaPuntoControl.filterBy(8,document.getElementById('comboProcedencia').options[document.getElementById('comboProcedencia').selectedIndex].text);
        //tablaEstadoExamenes.filterByAll();
    
    }
}
    

function SeleccionarArchivo(vNombre,dFechaCreacion,dFechaModificacion,vColor){
    var patronModulo='SeleccionarArchivo';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros += '&p2=' + 2;
    parametros += '&p3=' + vNombre;
    parametros += '&p4=' + dFechaCreacion;
    parametros += '&p5=' + dFechaModificacion;
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
            $('contenedorMantenimiento').setStyle({
                background:vColor,
                display: 'block'
            });   

            $('contenedorMantenimiento').update(respuesta);
        }
    }
)      
}

function cancelarSeleccionarXLS(){
    $('contenedorMantenimiento').setStyle({
        display: 'none'               
    }); 
}


function aceptarArchivoGuardarDatosEnBaseDatos(vNombre,dFechaCreacion,dFechaModificacion){
    var patronModulo='aceptarArchivoGuardarDatosEnBaseDatos';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros += '&p2=' + vNombre;
    parametros += '&p3=' + dFechaCreacion;
    parametros += '&p4=' + dFechaModificacion;
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
            alert(respuesta);
            moduloMantenimientoCargaDatosMicrobiologia();
        }
    }
)        
}