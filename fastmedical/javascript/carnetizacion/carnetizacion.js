/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function buscarPorBotonPersonaCarnetizacion(){
    document.getElementById('checkManipulador').checked=false;
    document.getElementById('checkManipulador').value=0;
    var fecha= $("hfechaObtenidoEventoCalendar").value;
   

    var codigoPersona=trim(document.getElementById('txtCodigoPersona').value);
    var apellidoPaterno=document.getElementById('txtApellidoPaterno').value;
    var apellidoMaterno=document.getElementById('txtApellidoMaterno').value;
    var nombre=document.getElementById('txtNombre').value;
    var numrDocumento=document.getElementById('txtNdocumento').value;
    
    var destino="divTotalManipuladores";
    var patronModulo='buscarPorBotonPersonaCarnetizacion';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+codigoPersona+'&p3='+apellidoPaterno+'&p4='+apellidoMaterno+'&p5='+nombre+'&p6='+numrDocumento
    +'&p7='+fecha ;
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
            if(destino!="") $(destino).update(respuesta); 
            //            BuscarPersonaCarnetizacion();   
            $("hfechaObtenidoEventoCalendar").value=fecha;
        }
    } )
    
}
function BuscarPersonaCarnetizacion(fecha,cboTipoCertificado){
    var codigoPersona=trim(document.getElementById('txtCodigoPersona').value);
    var apellidoPaterno=document.getElementById('txtApellidoPaterno').value;
    var apellidoMaterno=document.getElementById('txtApellidoMaterno').value;
    var nombre=document.getElementById('txtNombre').value;
    var tipoDocumento=document.getElementById('cboTipoDocumento').value;
    var numrDocumento=document.getElementById('txtNdocumento').value;
    var tipoCertificado=document.getElementById('cboTipoCertificado').value;
    var fechaini='';
    var fechaVenc='';
    //    var fechaini=document.getElementById('txtFechaIni').value;
    //    var fechaVenc=document.getElementById('txtFechaVencimiento').value;
    //    $("hfechaObtenidoEventoCalendar").value=fecha;
    if(fecha){
   
        $("hfechaObtenidoEventoCalendar").value=fecha;
    }
    
    // document.getElementById('checkManipulador').value
    // document.getElementById('checkNoManipulador').value
    //  document.getElementById('checkManipulador').checked=false;
    //   document.getElementById('checkNoManipulador').checked=false;
    var codigoManipulador =0;
    if(document.getElementById('checkManipulador').checked){
        codigoManipulador=1;
    }
    if(document.getElementById('checkNoManipulador').checked){
        codigoManipulador=2;
    }
    

    if(!(cboTipoCertificado)){
        cboTipoCertificado='';
       
    }else{

        apellidoPaterno='';
        apellidoMaterno='';
        nombre='';
        tipoDocumento='';
        numrDocumento='';
        tipoCertificado=cboTipoCertificado;
        fechaini='';
        fechaVenc='';
    }
    
    if(!(fecha)){
        fecha='';
        $("hfechaObtenidoEventoCalendar").value='';
    }else{
        apellidoPaterno='';
        apellidoMaterno='';
        nombre='';
        tipoDocumento='';
        numrDocumento='';
        //tipoCertificado='';
        fechaini='';
        fechaVenc='';
    }
    var patronModulo='BuscarPersonaCarnetizacion';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+codigoPersona+'&p3='+apellidoPaterno+'&p4='+apellidoMaterno+'&p5='+nombre+'&p6='+tipoDocumento
    +'&p7='+numrDocumento+'&p8='+tipoCertificado
    +'&p9='+fechaini
    +'&p10='+fechaVenc+'&p11='+fecha +'&p12='+ codigoManipulador ;

    tablaBuscarPersona=new dhtmlXGridObject('divReportePersonaCarnetizacion');
    tablaBuscarPersona.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaBuscarPersona.setSkin("dhx_skyblue");
    tablaBuscarPersona.enableRowsHover(true,'grid_hover');
    //-----------------
    var filtroPeril = "<input type='text' id='txtNombreExamenfiltro' style='width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarExamenesCarnetizacion();\" />"; 
    var header = ["","",filtroPeril,"","","","","","","","","","","","","","","","","","","","","","","","",""];  
    tablaBuscarPersona.attachHeader(header); 
    //--------------
    //    var parax = "";
    //    parax="p1=cargarComboTipoCertificado";
    //    var datosx=traerDataTipoCertificado(parax);
    //    var filtroProcedencia=datosx[0];
    //    //    var filtroExamenesLab = "<input type='text' id='idFiltroExamenLab' style='width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarExamenesLab();\" />"; 
    //    var filtro1="<select id='comboProcedencia' type='text'></select>";
    //    var header = [,,,,,,,,,,,,,,]; 
    //    tablaBuscarPersona.attachHeader(header); 
    
    //////////////////////////////////////////////////////////// 
    tablaBuscarPersona.attachEvent("onRowSelect", function(fila,columna){
        //reporteDePuntoControlXExamen(fila,columna);    
        verDatosPacienteCarnet(fila,columna);
    //        verFotosPaciente()
    });  
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaBuscarPersona.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaBuscarPersona.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
            
    });
    /////////////fin cargador ///////////////////////
    tablaBuscarPersona.setSkin("dhx_skyblue");
    tablaBuscarPersona.init();
    //    tablaBuscarPersona.loadXML(pathRequestControl+'?'+parametros);
    
    tablaBuscarPersona.loadXML(pathRequestControl+'?'+parametros, function(){   
        setColorTablaEstadoResultado();
        CargarCkeck(); 
         
    });
    tablaBuscarPersona.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){
     
        if(stage==2 && cInd==6){
            return actualizarTipoDeCertificado(rId,nValue,oValue);

        }
        if(stage==2 && cInd==7){
            return actualizarProcedencia(rId,nValue,oValue);
        }
        if(stage==2 && cInd==2){
            verFotosPaciente(rId,nValue,oValue);
        }
    });
//    tablaBuscarPersona.setRowspan("r01",0,2);
}

function buscarExamenesCarnetizacion(){
    //    $("txtNombreExamenfiltro").value=$("txtNombreExamen").value;
    findLikeexamen(document.getElementById('txtNombreExamenfiltro').value,tablaBuscarPersona,2);  
}
function actualizarTipoDeCertificado(rId,nValue,oValue){
    var idCertificado= tablaBuscarPersona.cells(rId,15).getValue();
    var idtipoCertificado= tablaBuscarPersona.cells(rId,17).getValue();

    ////    tablaBuscarPersona.getCombo(rId);
    //    alert(1);
    //    tablaBuscarPersona.setComboValue("text");
    //combo = tablaBuscarPersona.getCustomCombo(rId,6);
    //combo.put(-1,14);
    //    alert(combo);
    
    if(idtipoCertificado==1 || idtipoCertificado==2){
        //        if(tablaBuscarPersona.getSelectedId()!=null && !isNaN(nValue)){
        
        var parametros="";
        parametros="p1=actualizarTipoCertificado&p2="+idCertificado
        parametros+="&p3="+nValue;// tipo certificado
      
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            parameters : parametros,
            onLoading : micargador(1),
            onComplete : function(transport){
                micargador(0);
                respuesta = transport.responseText;
            }
        } )

    }else {
        alert("No puede Realizar El cambio");
    }   
    return true;
}


function actualizarProcedencia(rId,nValue,oValue){
    var idCertificado= tablaBuscarPersona.cells(rId,15).getValue();

    if(tablaBuscarPersona.getSelectedId()!=null && !isNaN(nValue)){
        
        var parametros="";
        parametros="p1=actualizarProcedencia&p2="+idCertificado
        parametros+="&p3="+nValue;// tipo procedencia
    
        contadorCargador++;
        var idCargador=contadorCargador;
        new Ajax.Request( pathRequestControl,{
            method : 'post',
            parameters : parametros,
            asynchronous:false,
            onLoading : micargador(1),
            onComplete : function(transport){
                cargadorpeche(0,idCargador);

                var fecha=$("hfechaObtenidoEventoCalendar").value;
            //                BuscarPersonaCarnetizacion(fecha);  
            }
        });         
    } 
    return true;
}

function traerDataTipoCertificado(parametros){
    var datos;
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request( pathRequestControl,{
        method : 'post',
        parameters : parametros,
        asynchronous:false,
        onLoading : micargador(1),
        onComplete : function(transport){
            cargadorpeche(0,idCargador);
            respuesta = transport.responseText;
            datos = respuesta.split("|");
        }
    });
    return datos;
    
}
function verDatosPacienteCarnet(fila,columna){
    var bEstadoImprimir= tablaBuscarPersona.cells(fila,26).getValue();
    var resultado= tablaBuscarPersona.cells(fila,8).getValue();
    var idSubTipoCertificado= tablaBuscarPersona.cells(fila,17).getValue();
    var permisoFotos= tablaBuscarPersona.cells(fila,27).getValue();
    if(columna==3){       
        var c_cod_per= tablaBuscarPersona.cells(fila,1).getValue();
        ventanaEditaPersonaCarnetizacion(c_cod_per,fila,columna)
        
    }


    if(columna==21 && bEstadoImprimir==1 &&(trim(resultado)!='')&& permisoFotos==1){

        var c_cod_per= tablaBuscarPersona.cells(fila,1).getValue();
        var DNI= tablaBuscarPersona.cells(fila,4).getValue();
        var nombreCompleto= tablaBuscarPersona.cells(fila,2).getValue();
        var tipoCertificado= tablaBuscarPersona.cells(fila,6).getValue();
        var apellidos= tablaBuscarPersona.cells(fila,25).getValue();
        var nombre= tablaBuscarPersona.cells(fila,22).getValue();
        var idtipoCertificado= tablaBuscarPersona.cells(fila,17).getValue();
        var idcertificacion= tablaBuscarPersona.cells(fila,15).getValue();
        var fechaActualSis= tablaBuscarPersona.cells(fila,17).getValue();
        var fechaCaducidadSis= tablaBuscarPersona.cells(fila,18).getValue();
        var fechaActual;
        var fechaCaducidad;
        var fechaActualBase= tablaBuscarPersona.cells(fila,9).getValue();
        var fechaCaducidadBase= tablaBuscarPersona.cells(fila,10).getValue();
       
        var parametros="";
        if(fechaActualBase==null ||fechaActualBase==''){
            fechaActual=fechaActualSis;
        //            parametros="p1=actualizarCertificado&p2="+idcertificacion;
        }else{
            fechaActual=fechaActualBase ;
        }
        if(fechaCaducidadBase==null ||fechaCaducidadBase==''){
            fechaCaducidad=fechaCaducidadSis;
        //            parametros="p1=actualizarCertificado&p2="+idcertificacion;           
        }else{
            fechaCaducidad=fechaCaducidadBase ;
        }
        if(idtipoCertificado==1 || idtipoCertificado==2){
            parametros="p1=actualizarCertificado&p2="+idcertificacion;     
            parametros+="&p3="+fechaCaducidad;
            parametros+="&p4="+c_cod_per;//
            parametros+="&p5="+idSubTipoCertificado;//
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
                  
                    if(respuesta==1){
                        var fecha=$("hfechaObtenidoEventoCalendar").value;
                        //                        BuscarPersonaCarnetizacion(fecha);
                        imprimirCarnetSanidad(DNI,nombreCompleto,tipoCertificado,c_cod_per,apellidos,nombre,fechaActual,fechaCaducidad);
                    }
                    else{
                        alert("No Existe Foto");
                    }
                }
            }); 
        }
    }
    
    if(columna==2){       

        var c_cod_per= tablaBuscarPersona.cells(fila,1).getValue();
        var destino="div_fotoInicio";
        var patronModulo='fotoPersonaCarnetizacion';
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
                if(destino!="") $(destino).update(respuesta);       
                 
                $("div_foto").hide(); 
                $("div_fotoInicio").show(); 
            }
        } )
            
    }
//    
}
function ventanaEditaPersonaCarnetizacion(c_cod_per,fila,columna){
    
    document.getElementById('txtFinaCarnetizacionPersona').value=fila;
    vformname='formBuscadorPersonas'
    vtitle='Edición de personas'
    vwidth='900'
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

    var patronModulo='mostrar_datos_paciente_carnetizacion';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+c_cod_per;
    parametros+='&funcionJSEjecutar='+'CerrarVentanaCarnetizacion';


    posFuncion='';
    //CargarVentana('formBuscadorPersonas','Edición de personas','../../ccontrol/control/control.php?p1=mostrar_datos_paciente_admision&p2='+c_cod_per,'900','650',false,true,'',1,'',10,10,10,10);
    CargarVentanaPopPap(vformname,vtitle,vwidth,vheight,vcenter,vresizable,vmodal,vstyle,vopacity,vposx1,vposx2,vposy1,vposy2,parametros,posFuncion)



//CargarVentana('formBuscadorPersonas','Edición de personas','../../ccontrol/control/control.php?p1=mostrar_datos_paciente_admision&p2='+c_cod_per,'900','650',false,true,'',1,'',10,10,10,10);
}
function CerrarVentanaCarnetizacion(){
    var fecha=$("hfechaObtenidoEventoCalendar").value;
    var fila=$("txtFinaCarnetizacionPersona").value;
    var DNI=$("txtNroDocIdent[1]").value;
    var txtApellidoPat=$("txtApellidoPat").value;
    var txtApellidoMat=$("txtApellidoMat").value;
    var txtNombrePaciente=$("txtNombrePaciente").value;
    var apellidos=txtApellidoPat+' '+txtApellidoMat;
    var completo=txtApellidoPat+' '+txtApellidoMat+' '+txtNombrePaciente;
    //         22 => "Nombre", 23 => "Paterno", 24 => "Materno", 25 => "Apellidos", 
    tablaBuscarPersona.cells(fila,4).setValue(DNI);
    tablaBuscarPersona.cells(fila,23).setValue(txtApellidoPat);
    tablaBuscarPersona.cells(fila,24).setValue(txtApellidoMat);
    tablaBuscarPersona.cells(fila,25).setValue(apellidos);
    tablaBuscarPersona.cells(fila,22).setValue(txtNombrePaciente);
    tablaBuscarPersona.cells(fila,2).setValue(completo);
//          BuscarPersonaCarnetizacion(fecha);  
}

function CargarCkeck(){
    
    for(i=0;i<tablaBuscarPersona.getRowsNum();i++){
        var resultado= tablaBuscarPersona.cells(i,8).getValue();
        var impreso= tablaBuscarPersona.cells(i,13).getValue();
        var Entregado=tablaBuscarPersona.cells(i,14).getValue();

        
        if(resultado==''|| resultado==null){
            tablaBuscarPersona.cells(i,11).setValue('');   
        } else {
            tablaBuscarPersona.cells(i,11).setValue('<input id="cboImpreso'+i+'" onclick= "if(this.checked){this.value=1}else{this.value=0;};actualizarImpreso('+i+')" type="checkbox" title="Asignar" name="grupoMuestra" value="0">');
            //            tablaBuscarPersona.cells(i,9).setValue('<input id="cboImpreso'+i+'" onclick= "if(this.checked){this.value=1}else{this.value=0;};seleccionandoMuestraxPuntoControl('+i+')" type="radio" title="Asignar" name="cboImpreso" value="0">');
            if(impreso==1){
                document.getElementById('cboImpreso'+i).checked=true;
                document.getElementById('cboImpreso'+i).value=1;          
            } else{
                document.getElementById('cboImpreso'+i).checked=false;
                document.getElementById('cboImpreso'+i).value=0;

            }       
        }
      
        if(resultado==''|| resultado==null){
            tablaBuscarPersona.cells(i,12).setValue('');  
                   
        } else {
            tablaBuscarPersona.cells(i,12).setValue('<input id="chkEntregado'+i+'" onclick= "if(this.checked){this.value=1}else{this.value=0;};actualizarEntrega('+i+');" type="checkbox" title="Recibir Muestra" name="chkRecibir'+i+'" value="0">');
            if(Entregado==1){
                document.getElementById('chkEntregado'+i).checked=true;
                document.getElementById('chkEntregado'+i).value=1;
                        
            }
            else{
                document.getElementById('chkEntregado'+i).checked=false;
                document.getElementById('chkEntregado'+i).value=0;
            }           
        }      
    }
}

function  setColorTablaEstadoResultado(){
    for(i=0;i<tablaBuscarPersona.getRowsNum();i++){
        //        var fechaInicial = mygridxcor.cells(i,4).getValue();
        //        var fechaFinal = mygridxcor.cells(i,5).getValue();
        var resultado = tablaBuscarPersona.cells(i,8).getValue();
        var impreso = tablaBuscarPersona.cells(i,13).getValue();
        var entregado = tablaBuscarPersona.cells(i,14).getValue();
        //         alert(resultado);
        //        if(fechaInicial=='' || fechaFinal=='' )
        //            mygridxcor.setRowTextStyle(mygridxcor.getRowId(i) ,'background-color:#CCFF99;color:black;border-top: 1px solid #DAEFC2;');
        //        //else if(estado !='')
        //        else if(fechaInicial !='' && fechaFinal!='' )
        //            mygridxcor.setRowTextStyle(mygridxcor.getRowId(i) ,'background-color:#8db1ff;color:black;border-top: 1px solid #FFD7BB;');

        if(resultado=='' || resultado==null ){// #F2F9F6   color blanco sin resultado
    
            tablaBuscarPersona.setRowTextStyle(tablaBuscarPersona.getRowId(i) ,'background-color:#F2F9F6;color:black;border-top: 1px solid #DAEFC2;');
    
    
        }else {// conn resultado
   
            tablaBuscarPersona.setRowTextStyle(tablaBuscarPersona.getRowId(i) ,'background-color:#D6E9FE;color:black;border-top: 1px solid #FFD7BB;');
    
    
        }
        if(impreso==1 && entregado!=1){// #F2F9F6   color blanco 
            tablaBuscarPersona.setRowTextStyle(tablaBuscarPersona.getRowId(i) ,'background-color:#F6CEEC;color:black;border-top: 1px solid #DAEFC2;');
        }
        if(entregado==1 ){// #F2F9F6   color blanco
            tablaBuscarPersona.setRowTextStyle(tablaBuscarPersona.getRowId(i) ,'background-color:#36B1DF;color:black;border-top: 1px solid #DAEFC2;');
        }

    }
}
function actualizarImpreso(fila){
  
    var idCertificado= tablaBuscarPersona.cells(fila,15).getValue();
    var resultado = tablaBuscarPersona.cells(fila,8).getValue();

    if( document.getElementById('cboImpreso'+fila).checked){
        var estado=1 ;
    }else {
        estado=0;
    }
    //    alert(document.getElementById('cboImpreso'+fila).checked);
    if(document.getElementById('chkEntregado'+fila).checked){
        tablaBuscarPersona.setRowTextStyle(tablaBuscarPersona.getRowId(fila) ,'background-color:#36B1DF;color:black;border-top: 1px solid #DAEFC2;');
    }else { 
        if(document.getElementById('cboImpreso'+fila).checked){
            // #F2F9F6   color blanco 
            tablaBuscarPersona.setRowTextStyle(tablaBuscarPersona.getRowId(fila) ,'background-color:#F6CEEC;color:black;border-top: 1px solid #DAEFC2;');
        }else {
            if(resultado=='' || resultado==null ){
                tablaBuscarPersona.setRowTextStyle(tablaBuscarPersona.getRowId(fila) ,'background-color:#F2F9F6;color:black;border-top: 1px solid #DAEFC2;'); 
            }else {
                tablaBuscarPersona.setRowTextStyle(tablaBuscarPersona.getRowId(fila) ,'background-color:#D6E9FE;color:black;border-top: 1px solid #FFD7BB;');   
            }    
        }
         
    }
    
    //   var impreso = tablaBuscarPersona.cells(fila,13).getValue();
    var parametros="";
    parametros="p1=confirmarImpresion&p2="+idCertificado
    parametros+="&p3="+estado;
    
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request( pathRequestControl,{
        method : 'post',
        parameters : parametros,
        asynchronous:false,
        onLoading : micargador(1),
        onComplete : function(transport){
            cargadorpeche(0,idCargador);
            respuesta = transport.responseText;
            var fecha=$("hfechaObtenidoEventoCalendar").value;
        //            BuscarPersonaCarnetizacion(fecha);  
    
        }
    });
}

function actualizarEntrega(fila){
    var idCertificado= tablaBuscarPersona.cells(fila,15).getValue();
    var idSubTipoCertificado= tablaBuscarPersona.cells(fila,17).getValue();
    var resultado = tablaBuscarPersona.cells(fila,8).getValue();
    //    alert("melaaa");
    if( document.getElementById('chkEntregado'+fila).checked){
        var estado=1 ;
    }else {
        estado=0;
    }
    if(document.getElementById('chkEntregado'+fila).checked){
        tablaBuscarPersona.setRowTextStyle(tablaBuscarPersona.getRowId(fila) ,'background-color:#36B1DF;color:black;border-top: 1px solid #DAEFC2;');
    }else { 
        if(document.getElementById('cboImpreso'+fila).checked){
            // #F2F9F6   color blanco 
            tablaBuscarPersona.setRowTextStyle(tablaBuscarPersona.getRowId(fila) ,'background-color:#F6CEEC;color:black;border-top: 1px solid #DAEFC2;');
        }else {
            if(resultado=='' || resultado==null ){
                tablaBuscarPersona.setRowTextStyle(tablaBuscarPersona.getRowId(fila) ,'background-color:#F2F9F6;color:black;border-top: 1px solid #DAEFC2;'); 
            }else {
                tablaBuscarPersona.setRowTextStyle(tablaBuscarPersona.getRowId(fila) ,'background-color:#D6E9FE;color:black;border-top: 1px solid #FFD7BB;');   
            }   
        }
    }
    var parametros="";
    parametros="p1=confirmarEntregado&p2="+idCertificado
    parametros+="&p3="+estado;
    parametros+="&p4="+idSubTipoCertificado;
    
    contadorCargador++;
    var idCargador=contadorCargador;
    new Ajax.Request( pathRequestControl,{
        method : 'post',
        parameters : parametros,
        asynchronous:false,
        onLoading : micargador(1),
        onComplete : function(transport){
            cargadorpeche(0,idCargador);
            respuesta = transport.responseText;
            var fecha=$("hfechaObtenidoEventoCalendar").value;
        //            BuscarPersonaCarnetizacion(fecha);  
        }
    });
}

//function limpiaBusquedasotros(){
//    alert(":)");
//}

function limpiaBusquedasotros(opc,elemento,evento){
    switch(opc)
    {
        case "01": //Busqueda por codigo
            document.getElementById('txtApellidoPaterno').value='';
            document.getElementById('txtApellidoMaterno').value='';
            document.getElementById('txtNombre').value='';
            document.getElementById('cboTipoDocumento').value="" ;
            document.getElementById('txtNdocumento').value='';
            document.getElementById('cboTipoCertificado').value='' ;
            //            document.getElementById('txtFechaIni').value='';
            //            document.getElementById('txtFechaVencimiento').value='';
            document.getElementById('checkManipulador').checked=false;
            document.getElementById('checkManipulador').value=0;
            document.getElementById('checkNoManipulador').checked=false;
            document.getElementById('checkNoManipulador').value=0;  
            $("1").hide(); 
            $("2").hide(); 
            $("3").hide(); 
            $("4").hide(); 
            break;

        case "02": ////Busqueda por docuemnto
            document.getElementById('txtApellidoPaterno').value='';
            document.getElementById('txtApellidoMaterno').value='';
            document.getElementById('txtNombre').value='';
            document.getElementById('txtCodigoPersona').value="" ;
            //            document.getElementById('txtNdocumento').value='';
            document.getElementById('cboTipoCertificado').value='' ;
            //            document.getElementById('txtFechaIni').value='';
            //            document.getElementById('txtFechaVencimiento').value='';
            document.getElementById('checkManipulador').checked=false;
            document.getElementById('checkManipulador').value=0;
            document.getElementById('checkNoManipulador').checked=false;
            document.getElementById('checkNoManipulador').value=0;  
            $("1").hide(); 
            $("2").hide(); 
            $("3").hide(); 
            $("4").hide();
            break;
        case "03":
            document.getElementById('txtApellidoPaterno').value='';
            document.getElementById('txtApellidoMaterno').value='';
            document.getElementById('txtNombre').value='';
            document.getElementById('txtCodigoPersona').value="" ;
            document.getElementById('cboTipoDocumento').value="" 
            document.getElementById('txtNdocumento').value='';
            document.getElementById('cboTipoCertificado').value='' ;
            document.getElementById('checkManipulador').checked=false;
            document.getElementById('checkManipulador').value=0;
            document.getElementById('checkNoManipulador').checked=false;
            document.getElementById('checkNoManipulador').value=0;  
            
            
            $("1").hide(); 
            $("2").hide(); 
            $("3").hide(); 
            $("4").hide();
            break;
        case "04": //busqeuda por nombre
            document.getElementById('txtCodigoPersona').value='';
            //            document.getElementById('cboTipoDocumento').selected="selected";
            document.getElementById('cboTipoDocumento').value="" ;
            document.getElementById('txtNdocumento').value='';
            document.getElementById('cboTipoCertificado').value='' ;
            //            document.getElementById('txtFechaIni').value='';
            //            document.getElementById('txtFechaVencimiento').value='';
            document.getElementById('checkManipulador').checked=false;
            document.getElementById('checkManipulador').value=0;
            document.getElementById('checkNoManipulador').checked=false;
            document.getElementById('checkNoManipulador').value=0;  
            $("1").hide(); 
            $("2").hide(); 
            $("3").hide(); 
            $("4").hide();
            break;
            
        case "05": //busqeuda por por el tipo de certificado
            document.getElementById('txtCodigoPersona').value='';
            document.getElementById('txtApellidoPaterno').value='';
            document.getElementById('txtApellidoMaterno').value='';
            document.getElementById('txtNombre').value='';
            //            document.getElementById('cboTipoDocumento').selected="selected";
            document.getElementById('cboTipoDocumento').value="" ;
            document.getElementById('txtNdocumento').value='';
            //            document.getElementById('txtFechaIni').value='';
            //            document.getElementById('txtFechaVencimiento').value='';
            var fechaCalendario=  $("hfechaObtenidoEventoCalendar").value;
            var idTipoCertifiado=document.getElementById('cboTipoCertificado').value;
            var iidSubtipoCertificado=0;
            if(document.getElementById('checkNoManipulador').checked){
                iidSubtipoCertificado=2;
            }
            if(document.getElementById('checkManipulador').checked){
                iidSubtipoCertificado=1;
            }     
            var destino="divTotalManipuladores";
            var patronModulo='buscarCboCantidadCertificadoPorTipo';
            var parametros='';
            parametros+='p1='+patronModulo;
            parametros+='&p2='+fechaCalendario+'&p3='+idTipoCertifiado+'&p4='+iidSubtipoCertificado;
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
                    if(destino!="") $(destino).update(respuesta);       
                    //                    BuscarPersonaCarnetizacion();   
                    BuscarPersonaCarnetizacion(fechaCalendario,idTipoCertifiado);
                }
            } )
            
            if( document.getElementById('cboTipoCertificado').value==1){
                $("1").show(); 
                $("2").show(); 
                $("3").show(); 
                $("4").show(); 
            }else {
                document.getElementById('checkManipulador').checked=false;
                document.getElementById('checkManipulador').value=0;
                document.getElementById('checkNoManipulador').checked=false;
                document.getElementById('checkNoManipulador').value=0;  
                $("1").hide(); 
                $("2").hide(); 
                $("3").hide(); 
                $("4").hide();  
            }
            break;
    }
//    if(evento==''){
//        tecla=13;
//    }
//    else{
//        tecla=evento.keyCode
//    }
//    if(tecla==13){
//        var codigoPersona=document.getElementById('txtCodigoPersona').value;
//        var apellidoPaterno=document.getElementById('txtApellidoPaterno').value;
//        var apellidoMaterno=document.getElementById('txtApellidoMaterno').value;
//        var nombre=document.getElementById('txtNombre').value;
//        var tipoDocumento=document.getElementById('cboTipoDocumento').value;
//        var numrDocumento=document.getElementById('txtNdocumento').value;
//        var tipoCertificado=document.getElementById('cboTipoCertificado').value;
//        var fechaini=document.getElementById('txtFechaIni').value;
//        var fechaVenc=document.getElementById('txtFechaVencimiento').value;
//        //        buscarEmpleadosPopap($cod,$estado,$tipoDoc,$nDoc,$apPat,$apMat,$nombre);
//        BuscarPersonaCarnetizacion();
//    }
}

function NocheckManipulador(){
    document.getElementById('checkManipulador').checked=false;
    document.getElementById('checkManipulador').value=0;
    var fecha= $("hfechaObtenidoEventoCalendar").value;
    var iidtipoCertificado= document.getElementById('cboTipoCertificado').value;
    var destino="divTotalManipuladores";
    var iidSubtipoCertificado=0;
    if(document.getElementById('checkNoManipulador').checked){
        iidSubtipoCertificado=2;
    }
    if(document.getElementById('checkManipulador').checked){
        iidSubtipoCertificado=1;
    }


    var patronModulo='buscarCboCantidadCertificadoPorTipo';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+fecha+'&p3='+iidtipoCertificado+'&p4='+iidSubtipoCertificado;
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
            if(destino!="") $(destino).update(respuesta);       
            BuscarPersonaCarnetizacion(fecha)   
        }
    } )
     
}
function checkManipulador(){
    document.getElementById('checkNoManipulador').checked=false;
    document.getElementById('checkNoManipulador').value=0;
    var fecha= $("hfechaObtenidoEventoCalendar").value;
    var iidtipoCertificado= document.getElementById('cboTipoCertificado').value;
    var destino="divTotalManipuladores";
    var iidSubtipoCertificado=0;
    if(document.getElementById('checkNoManipulador').checked){
        iidSubtipoCertificado=2;
    }
    if(document.getElementById('checkManipulador').checked){
        iidSubtipoCertificado=1;
    }


    var patronModulo='buscarCboCantidadCertificadoPorTipo';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+fecha+'&p3='+iidtipoCertificado+'&p4='+iidSubtipoCertificado;
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
            if(destino!="") $(destino).update(respuesta);       
            BuscarPersonaCarnetizacion(fecha)   
        }
    } )
}
  
  
function ocultarBusqueda(){
    var estado=  $("hEstado").value;
    if(estado==0){
        $("hEstado").value=1;
        $("div_calendarHere").hide(); 
        $("div_fechaArriba").hide(); 
        $("div_fechaAbajo").show();  
    //     document.getElementById('divReportePersonaCarnetizacion').style.height =500;
    }
  
    if(estado==1){
        $("hEstado").value=0;
        $("div_calendarHere").show();  
        $("div_fechaArriba").show(); 
        $("div_fechaAbajo").hide();  
    }
}

function LimpiarPersonaCarnetizacion(){
    document.getElementById('checkNoManipulador').checked=false;
    document.getElementById('checkNoManipulador').value=0;
    document.getElementById('checkManipulador').checked=false;
    document.getElementById('checkManipulador').value=0;
    document.getElementById('txtCodigoPersona').value='';
    document.getElementById('txtApellidoPaterno').value='';
    document.getElementById('txtApellidoMaterno').value='';
    document.getElementById('txtNombre').value='';
    document.getElementById('cboTipoDocumento').value="" ;
    document.getElementById('txtNdocumento').value='';
    document.getElementById('cboTipoCertificado').value='' ;
}
//var b1= $("div_barrraDesplazante").scrollTop;
//
//document.getElementById('div_barrraDesplazante').scrollTop =b1;

function cantidadActualFecha(fechaCalendario){
    //    var fechaCalendario=  $("hfechaObtenidoEventoCalendar").value;
    var idTipoCertifiado=document.getElementById('cboTipoCertificado').value;
    var iidSubtipoCertificado=0;
    if(document.getElementById('checkNoManipulador').checked){
        iidSubtipoCertificado=2;
    }
    if(document.getElementById('checkManipulador').checked){
        iidSubtipoCertificado=1;
    }         
    var destino="divTotalManipuladores";
    var patronModulo='buscarCboCantidadCertificadoPorTipo';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+fechaCalendario+'&p3='+idTipoCertifiado+'&p4='+iidSubtipoCertificado;
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
            if(destino!="") $(destino).update(respuesta);       

        }
    } )
}