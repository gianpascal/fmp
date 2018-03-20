/*
function setDatosPersonasFarmacia(objeto,evento,iid_persona){
    POO.Request({p1:'mostrar_datos_cliente',p2:iid_persona},function(respuestajs){
    Windows.close("Div_formBuscadorPersonas");
    eval(respuestajs);
    });
    return;
}
function pintarDatosPersonasOrden($iid_persona,$afiliacion,$nombrepaciente,$apellidopaternopaciente,$apellidomaternopaciente,$ndocumento,$fechanacimiento,$id_afiliacion){
    
    document.getElementById("txtcodigo").value=$iid_persona;
    document.getElementById("txtapellidoPaterno").value=$apellidopaternopaciente;
    document.getElementById("txtapellidoMaterno").value=$apellidomaternopaciente;
    document.getElementById("txtnombres").value=$nombrepaciente;
    document.getElementById("txtfiliacion").value=$afiliacion;
    getOrdenes('','',$iid_persona);
    codigo=document.getElementById("auxOrden").value;
    if(codigo=="1"){
      ventana_busca_tarifas('setDatosPersonasFarmacia');
    }
}

function getOrdenes(event,html,iid_persona){
    patronModulo="ordenes";
    patronCodigo=iid_persona;
    path="../../ccontrol/control/control.php?p1="+patronModulo+"&p2="+patronCodigo;
    myajax.Link(path,"div_result_ordenes");
}
function ventana_busca_tarifas(funcionJSEjecutar){
    CargarVentana('formBuscadorProductos','Buscar Productos','../../ccontrol/control/control.php?p1=form_buscador_Productos&funcionJSEjecutar='+funcionJSEjecutar,'820','640',false,true,'',1,'',10,10,10,10);
}
function nuevaOrden(){
    codigo=document.getElementById("txtcodigo").value;
    if(codigo==""){
        ventana_busca_persona('setDatosPersonasFarmacia');
       document.getElementById("auxOrden").value=1;
    }else{
        ventana_busca_tarifas('setDatosPersonasFarmacia');
    }

}
function ventanaBuscaPersonaOrden(funcionJSEjecutar){
    CargarVentana('formBuscadorPersonasOrden','Buscar Personas','../../ccontrol/control/control.php?p1=form_buscador_personas&funcionJSEjecutar='+funcionJSEjecutar,'600','420',false,true,'',1,'',10,10,10,10);
}
function buscarPersona_orden(){
    document.getElementById("auxOrden").value=0;
    ventana_busca_persona('setDatosPersonasFarmacia');
}
function pruebaOrden(){
    //ventana_busca_persona('setDatosPersonasFarmacia');
    funcionJSEjecutar="hihi";
    CargarVentana('formBuscadorPersonasOrden','Buscar Personas','#div_encabezado','600','420',false,true,'',1,'',10,10,10,10);
}

*/
/*------------------------------------------FARMACIA SOP----------------------------------------------*/
function mostrarPaquetesFarmaceuticosSOP(){

    titulo='Paquetes Farmaceuticos SOP'
    vFormaAbrir='VENTANA'
    vformname='PaquetesFarmaceuticosSOP'
    vtitle='Paquetes Farmaceuticos SOP'
    vwidth='520'
    vheight='400'
    patronModulo='mostrarVentanaPaquetesFarmaceuticosCISOP';
    vcenter='t'
    vresizable=''
    vmodal='false'
    vstyle=''
    vopacity=''
    veffect=''
    vposx1=''
    vposx2=''
    vposy1=''
    vposy2=''
    file01=''
    vfunctionjava=''
    //posFuncion = ''
    /*---------------------------------------*/
    /*--------------------------------------*/
    //    posFuncion='asignarPadreExamenFisico';
    parametros='';
    parametros+='p1='+patronModulo;
    //parametros+='&p2='+descripcion;
    //posFuncion="tablaPreciosTratamientoAtencionMedica('"+codigo+"')";
    posFuncion="cargarTablaPaqueteFarmaceuticosSOP()";
    CargarVentanaPreciosAtencionMedica(vformname,vtitle,vwidth,vheight,vcenter,vresizable,vmodal,vstyle,vopacity,vposx1,vposx2,vposy1,vposy2,parametros,posFuncion)

}
function cargarTablaPaqueteFarmaceuticosSOP(){
    mostrarDatosdelPaqueteAsignadoFarmaciaSOP();
    patronModulo='mostrarTablaPaquetesFarmaceuticosCISOP';
    parametros='';
    parametros+='p1='+patronModulo;

    tablaPaquetesFarmaceuticosFarmaciaSOP = new dhtmlXGridObject('Div_TablaPaquetesFarmaceuticosCISOP');
    tablaPaquetesFarmaceuticosFarmaciaSOP.setImagePath("../../../../medifacil_front/imagen/icono/");
    tablaPaquetesFarmaceuticosFarmaciaSOP.setSkin("dhx_skyblue");
    tablaPaquetesFarmaceuticosFarmaciaSOP.attachEvent("onRowSelect", function(rowId,columna){
        $("txtcodigopaquete").value = rowId;
        $("txtnombrepaquete").value = tablaPaquetesFarmaceuticosFarmaciaSOP.cells(rowId,1).getValue();
    });
    tablaPaquetesFarmaceuticosFarmaciaSOP.init();
    tablaPaquetesFarmaceuticosFarmaciaSOP.loadXML(pathRequestControl+'?'+parametros);
}
function cargarPaqueteMedicamentosalPacienteFarmaciaCISOP(){
    codigopaquetefarmaceuticoSOP = $("txtcodigopaquete").value;
    iidProgramacionSOP = $("hIdTablaProgramacionSOP").value.split("|")[0];
    codigoPersona = $("txtcodigopersona").value;
    if(codigopaquetefarmaceuticoSOP!=''){
        if($("hdatospaquete").value == '|'){
            if(window.confirm("Desea Asignar el Paquete de Medicamentos al Paciente : "+$("txtnombrepaciente").value)){
                patronModulo='cargarPaqueteMedicamentosalPacienteFarmaciaCISOP';
                parametros='';
                parametros+='p1='+patronModulo;
                parametros+='&p2='+iidProgramacionSOP;  
                parametros+='&p3='+codigopaquetefarmaceuticoSOP;
                parametros+='&p4='+codigoPersona;

                new Ajax.Request(pathRequestControl,{
                    method : 'get',
                    parameters : parametros,
                    onLoading : micargador(1),
                    onComplete : function(transport){
                        micargador(0);
                        respuesta = transport.responseText;
                        mostrarTablaGeneracionPreOrdenFarmaciaSOP()
                    }
                } )
                Windows.close("Div_PaquetesFarmaceuticosSOP", "");
            }                    
        }else{
            window.alert("Ya ha sido asignado un paquete al paciente..Verifique!");
        }

    }else{
        window.alert("Seleccione un paquete para Asignar,por favor...")
    }

}
function mostrarDatosdelPaqueteAsignadoFarmaciaSOP(){
    iidProgramacionSOP = $("hIdTablaProgramacionSOP").value.split("|")[0];
    codigopersona = $("txtcodigopersona").value;
    patronModulo='mostrarDatosdelPaqueteAsignadoFarmaciaSOP';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+iidProgramacionSOP; 
    parametros+='&p3='+codigopersona;

    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $("hdatospaquete").value = respuesta;
            arreglo = $("hdatospaquete").value.split("|");
            $("txtcodigopaquete").value = arreglo[0];
            $("txtnombrepaquete").value = arreglo[1];
        }
    } )    
}
function mostrarTablaGeneracionPreOrdenFarmaciaSOP(){
    iidProgramacionSOP = $("hIdTablaProgramacionSOP").value.split("|")[0];
    codigopersona = $("txtcodigopersona").value;
    patronModulo='mostrarTablaControlInternoFarmaciaSOP';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+iidProgramacionSOP;
    parametros+='&p3='+codigopersona;

    tablaControlInternoFarmaciaSOP = new dhtmlXGridObject('Div_tablamovimientosCIFarmaciaSOP');
    tablaControlInternoFarmaciaSOP.setImagePath("../../../../medifacil_front/imagen/icono/");
    tablaControlInternoFarmaciaSOP.setSkin("dhx_skyblue");
    tablaControlInternoFarmaciaSOP.attachEvent("onRowSelect", function(rowId,columna){
        nombreproducto = tablaControlInternoFarmaciaSOP.cellById(rowId,2).getValue();
        if(columna == 7){
            eliminarProductoalPacienteCISOP(rowId,nombreproducto);
        }
    })
    tablaControlInternoFarmaciaSOP.attachEvent ("onEditCell", function (etapa, RID, DSD, nValue, ovalue ){
 
        if(etapa == 2){
            if(/^(?:\-)?\d+$/.test(nValue)){
                cantidadstock = tablaControlInternoFarmaciaSOP.cellById(RID, 3).getValue()*1;
                cantidadactual = tablaControlInternoFarmaciaSOP.cellById(RID, 4).getValue()*1;
                movimiento = tablaControlInternoFarmaciaSOP.cellById(RID, 5).getValue()*1;
                nuevacantidad = cantidadactual + movimiento
                if(nuevacantidad<=cantidadstock){
                    if(nuevacantidad>=0){
                        tablaControlInternoFarmaciaSOP.cellById(RID, 6).setValue(nuevacantidad);
                    }else{
                        tablaControlInternoFarmaciaSOP.cellById(RID, 5).setValue(ovalue);
                        window.alert("La nueva cantidad no puede ser Negativa!")
                    }    
                }else{
                    tablaControlInternoFarmaciaSOP.cellById(RID, 5).setValue(ovalue);
                    window.alert("La nueva cantidad no puede ser mayor que el stock en el Almacen de Farmacia SOP!")                    
                }
                
            }else{
                tablaControlInternoFarmaciaSOP.cellById(RID, 5).setValue(ovalue);
                window.alert("Valor ingresado no valido");
            }            
        }
        return true;
    });
    tablaControlInternoFarmaciaSOP.init();
    tablaControlInternoFarmaciaSOP.loadXML(pathRequestControl+'?'+parametros,function(){
        regularizar = 0;
        for(i=0;i<tablaControlInternoFarmaciaSOP.getRowsNum();i++){
            if(tablaControlInternoFarmaciaSOP.cells2(i,3).getValue()*1 < tablaControlInternoFarmaciaSOP.cells2(i,4).getValue()*1){
                tablaControlInternoFarmaciaSOP.cells2(i,1).setBgColor('F6ED5C');
                tablaControlInternoFarmaciaSOP.cells2(i,2).setBgColor('F6ED5C');
                tablaControlInternoFarmaciaSOP.cells2(i,3).setBgColor('F6ED5C');
                tablaControlInternoFarmaciaSOP.cells2(i,4).setBgColor('F6ED5C');
                regularizar = 1;
            }
        }
        if(regularizar == 1){
            window.alert("Hay productos por regularizar en el stock de Farmacia SOP")
        }    
    });
}

function restaurarTablaGeneracionPreOrdenFarmaciaSOP(){
    mostrarTablaGeneracionPreOrdenFarmaciaSOP();
}

function mostrarVentanaNuevosMedicamentosCISOP(){
    titulo='Productos Farmaceuticos SOP'
    vFormaAbrir='VENTANA'
    vformname='NuevosMedicamentosFarmaceuticosSOP'
    vtitle='Productos Farmaceuticos SOP'
    vwidth='700'
    vheight='650'
    patronModulo='mostrarVentanaNuevosMedicamentosCISOP';
    vcenter='t'
    vresizable=''
    vmodal='false'
    vstyle=''
    vopacity=''
    veffect=''
    vposx1=''
    vposx2=''
    vposy1=''
    vposy2=''
    file01=''
    vfunctionjava=''
    //posFuncion = ''
    /*---------------------------------------*/
    /*--------------------------------------*/
    //    posFuncion='asignarPadreExamenFisico';
    parametros='';
    parametros+='p1='+patronModulo;
    //parametros+='&p2='+descripcion;
    //posFuncion="tablaPreciosTratamientoAtencionMedica('"+codigo+"')";
    posFuncion="cargarTablaNuevosMedicamentosCISOP()";
    CargarVentanaPreciosAtencionMedica(vformname,vtitle,vwidth,vheight,vcenter,vresizable,vmodal,vstyle,vopacity,vposx1,vposx2,vposy1,vposy2,parametros,posFuncion)
}

function cargarTablaNuevosMedicamentosCISOP(){
    parametronombre = '';
    tipobusqueda = '0';
    patronModulo='mostrarTablaNuevosMedicamentosCISOP';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+tipobusqueda;
    parametros+='&p3='+parametronombre;

    tablaAgregarNuevosMedicamentosFarmaciaSOP = new dhtmlXGridObject('Div_TablaProductosFarmaciaCISOP');
    tablaAgregarNuevosMedicamentosFarmaciaSOP.setImagePath("../../../../medifacil_front/imagen/icono/");
    tablaAgregarNuevosMedicamentosFarmaciaSOP.setSkin("dhx_skyblue");
    tablaAgregarNuevosMedicamentosFarmaciaSOP.attachEvent("onRowSelect", function(rowId,columna){
        $("hCodigoProductoIndividual").value = rowId + "|" +tablaAgregarNuevosMedicamentosFarmaciaSOP.cellById(rowId,2).getValue();

    });
    tablaAgregarNuevosMedicamentosFarmaciaSOP.init();
    tablaAgregarNuevosMedicamentosFarmaciaSOP.loadXML(pathRequestControl+'?'+parametros);    
}
function busquedaCodigoProductoFarmaciaCISOP(){
    //seleccionactividad();
    parametronombre=$('txtcodigoproductoFarmaciaCISOP').value;
    tipobusqueda = '1';    
    numero=parametronombre.length;
    patronModulo='mostrarTablaNuevosMedicamentosCISOP';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+tipobusqueda;
    parametros+='&p3='+parametronombre;

    tspc=0;
    tablaAgregarNuevosMedicamentosFarmaciaSOP = new dhtmlXGridObject('Div_TablaProductosFarmaciaCISOP');
    tablaAgregarNuevosMedicamentosFarmaciaSOP.setImagePath("../../../../medifacil_front/imagen/icono/");
    tablaAgregarNuevosMedicamentosFarmaciaSOP.setSkin("dhx_skyblue");
    tablaAgregarNuevosMedicamentosFarmaciaSOP.attachEvent("onRowSelect", function(rowId,columna){
        $("hCodigoProductoIndividual").value = rowId + "|" +tablaAgregarNuevosMedicamentosFarmaciaSOP.cellById(rowId,2).getValue();
    });
    tablaAgregarNuevosMedicamentosFarmaciaSOP.init();
    tablaAgregarNuevosMedicamentosFarmaciaSOP.loadXML(pathRequestControl+'?'+parametros,function(){
        tspc=1;
    });
    if(tspc==1){
        tablaAgregarNuevosMedicamentosFarmaciaSOP.filterBy(1,$('txtcodigoproductoFarmaciaCISOP').value);
        tablaAgregarNuevosMedicamentosFarmaciaSOP.findCell($('txtcodigoproductoFarmaciaCISOP').value);
    }        

}
function busquedaNombreProductoFarmaciaCISOP(){
    parametronombre=$('txtnombreproductoFarmaciaCISOP').value;
    tipobusqueda = '2';    
    numero=parametronombre.length;
    patronModulo='mostrarTablaNuevosMedicamentosCISOP';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+tipobusqueda;
    parametros+='&p3='+parametronombre;

    tspc=0;
    tablaAgregarNuevosMedicamentosFarmaciaSOP = new dhtmlXGridObject('Div_TablaProductosFarmaciaCISOP');
    tablaAgregarNuevosMedicamentosFarmaciaSOP.setImagePath("../../../../medifacil_front/imagen/icono/");
    tablaAgregarNuevosMedicamentosFarmaciaSOP.setSkin("dhx_skyblue");
    tablaAgregarNuevosMedicamentosFarmaciaSOP.attachEvent("onRowSelect", function(rowId,columna){
        $("hCodigoProductoIndividual").value = rowId + "|" +tablaAgregarNuevosMedicamentosFarmaciaSOP.cellById(rowId,2).getValue();
    });
    tablaAgregarNuevosMedicamentosFarmaciaSOP.init();
    tablaAgregarNuevosMedicamentosFarmaciaSOP.loadXML(pathRequestControl+'?'+parametros,function(){
        tspc=1;
    });
    if(tspc==1){
        tablaAgregarNuevosMedicamentosFarmaciaSOP.filterBy(2,$('txtnombreproductoFarmaciaCISOP').value);
        tablaAgregarNuevosMedicamentosFarmaciaSOP.findCell($('txtnombreproductoFarmaciaCISOP').value);
    }  
}

function agregarProductoalPacienteCISOP(){
    cantidadstock = $("hCodigoProductoIndividual").value.split("|")[1]*1;
    cantidadaentregar = $("txtcantidadproductoaentregarCISOP").value*1;
    iidProgramacionSOP = $("hIdTablaProgramacionSOP").value.split("|")[0];
    codigoproducto = $("hCodigoProductoIndividual").value;
    codigopersona = $("txtcodigopersona").value;
    if($("hCodigoProductoIndividual").value == ''){
        window.alert("Seleccione un producto..por favor!")
        return;
    }
    if($("txtcantidadproductoaentregarCISOP").value == ''){
        window.alert("Ingrese la cantidad a entregar al paciente..!!")
        return;
    }    
    if(cantidadaentregar > cantidadstock){
        window.alert("No hay cantidad suficientes productos para entregar..solo hay "+cantidadstock+" en stock de Farmacia SOP");
        return;
    }
    if (cantidadaentregar == '0'){
        window.alert("La cantidad a entrega no puede ser 0 ..!!")
        return;        
    }

    if(window.confirm("Desea Asignar el Producto al paciente : "+$("txtnombrepaciente").value)){
        patronModulo='cargarProductoalPacienteFarmaciaCISOP';
        parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+iidProgramacionSOP;  
        parametros+='&p3='+codigoproducto; 
        parametros+='&p4='+cantidadaentregar;
        parametros+='&p5='+codigopersona;

        new Ajax.Request(pathRequestControl,{
            method : 'get',
            parameters : parametros,
            onLoading : micargador(1),
            onComplete : function(transport){
                micargador(0);
                respuesta = transport.responseText;
                mostrarTablaGeneracionPreOrdenFarmaciaSOP();
            }
        } )
        Windows.close("Div_NuevosMedicamentosFarmaceuticosSOP", "");
    }        

}

function eliminarProductoalPacienteCISOP(rowId,nombreproducto){
    iidcodigoasignaciondelproducto = rowId;
    if(window.confirm("¿Desea Eliminar la asignacion del producto : "+nombreproducto+" ?")){
        patronModulo='eliminarProductoalPacienteCISOP';
        parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+iidcodigoasignaciondelproducto;  

        new Ajax.Request(pathRequestControl,{
            method : 'get',
            parameters : parametros,
            onLoading : micargador(1),
            onComplete : function(transport){
                micargador(0);
                respuesta = transport.responseText;
                mostrarTablaGeneracionPreOrdenFarmaciaSOP();
            }
        } )
    //Windows.close("Div_PaquetesFarmaceuticosSOP", "");
    } 
}

function actualizarNuevaCantidadEntregadaCISOP(){
    cadena = '';
    for (i=0;i<tablaControlInternoFarmaciaSOP.getRowsNum();i++){
        if(i<tablaControlInternoFarmaciaSOP.getRowsNum()-1){
            cadena = cadena + tablaControlInternoFarmaciaSOP.cells2(i,0).getValue() + "-" + tablaControlInternoFarmaciaSOP.cells2(i,6).getValue() + "|";
        }else{
            cadena = cadena + tablaControlInternoFarmaciaSOP.cells2(i,0).getValue() + "-" + tablaControlInternoFarmaciaSOP.cells2(i,6).getValue();
        }
    }
    $("hdatosactualizarcantidadproductosCISOP").value = cadena;
    
    if(window.confirm("¿Desea guardar las nuevas cantidad entregadas?")){
        patronModulo='actualizarNuevasCantidadesEntregadasCISOP';
        parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+cadena;  

        new Ajax.Request(pathRequestControl,{
            method : 'get',
            parameters : parametros,
            onLoading : micargador(1),
            onComplete : function(transport){
                micargador(0);
                respuesta = transport.responseText;
                switch(respuesta){
                    case '0':
                        window.alert("Hubo un error al guardar..por favor verifique!!");
                        break;
                    case '1':
                        volveraProgramacionSOPdesdeCIFarmaciaSOP();
                        $("hIdTablaProgramacionSOP").value = '';
                        window.alert("Se actualizo correctamente los datos");
                        break;                        
                        
                }
            }
        } )
    }     
}
function mostrarBusquedadePersonasCISOP(){

    titulo='Busqueda Personas'
    vFormaAbrir='VENTANA'
    vformname='BusquedaPersonasCISOP'
    vtitle='Busqueda Personas'
    vwidth='520'
    vheight='320'
    patronModulo='mostrarVentanaBusquedaPersonas';
    vcenter='t'
    vresizable=''
    vmodal='false'
    vstyle=''
    vopacity=''
    veffect=''
    vposx1=''
    vposx2=''
    vposy1=''
    vposy2=''
    file01=''
    vfunctionjava=''
    //posFuncion = ''
    /*---------------------------------------*/
    /*--------------------------------------*/
    //    posFuncion='asignarPadreExamenFisico';
    parametros='';
    parametros+='p1='+patronModulo;
    //parametros+='&p2='+descripcion;
    //posFuncion="tablaPreciosTratamientoAtencionMedica('"+codigo+"')";
    posFuncion="";
    CargarVentanaPreciosAtencionMedica(vformname,vtitle,vwidth,vheight,vcenter,vresizable,vmodal,vstyle,vopacity,vposx1,vposx2,vposy1,vposy2,parametros,posFuncion)
}
function busquedaPersonaCISOP(html,event,codigopersona){
    patronModulo='busquedaPersonaCISOP';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+codigopersona;  

    new Ajax.Request(pathRequestControl,{
        method : 'get',
        asynchronous : false,
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            arreglo = respuesta.split("|");
            $("txtcodigopersona").value = arreglo[0];
            $("txtnombrepaciente").value = arreglo[1];
            $("txtdnipaciente").value = arreglo[2];
            $("txtedadpaciente").value = arreglo[3];
            mostrarTablaGeneracionPreOrdenFarmaciaSOP();
            mostrarDatosdelPaqueteAsignadoFarmaciaSOP();
            Windows.close("Div_BusquedaPersonasCISOP","");
        }
    } )    
}

function generarOrdenCuentaCorrienteFarmaciaCISOP(){
    iidProgramacionSOP = $("hIdTablaProgramacionSOP").value.split("|")[0];
    codigopersona = $("txtcodigopersona").value;    
    if(window.confirm("¿Desea generar la orden de productos para la liquidacion?")){
        patronModulo='generarOrdenCuentaCorrienteFarmaciaCISOP';
        parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+iidProgramacionSOP;  
        parametros+='&p3='+codigopersona;  

        new Ajax.Request(pathRequestControl,{
            method : 'get',
            asynchronous : false,
            parameters : parametros,
            onLoading : micargador(1),
            onComplete : function(transport){
                micargador(0);
                respuesta = transport.responseText;
                $("hIdTablaProgramacionSOP").value = '';
                window.alert(respuesta);
            }
        } ) 
    }
}
function enviandoImprimirFarmaciaCISOP(){
    window.alert("Imprimir");
}