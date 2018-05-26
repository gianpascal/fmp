
var pathRequestControl = "../../ccontrol/control/control.php";

function formateaOpcionBuscadorPersona(opc){
    switch (opc){
            case 'nombre':{
                    textEtiqueta = "AP. PAT: ";
                    $('txtPatron').value="Buscar...";
                    $('txtPatron').focus();
                    $('lblPatron2').style.visibility="visible";
                    $('txtPatron2').style.visibility="visible";
                    $('txtPatron2').value="Buscar...";
                    $('lblPatron3').style.visibility="visible";
                    $('txtPatron3').style.visibility="visible";
                    $('txtPatron3').value="Buscar...";
                    $('hdnOpcionBusqueda').value=1;
                    break;
            }
            case 'documento':{
                    textEtiqueta = "DOCUMENTO: ";
                    $('txtPatron').value="Buscar...";
                    $('txtPatron').focus();
                    $('lblPatron2').style.visibility="hidden";
                    $('txtPatron2').style.visibility="hidden";
                    $('lblPatron3').style.visibility="hidden";
                    $('txtPatron3').style.visibility="hidden";
                    $('hdnOpcionBusqueda').value=2;
                    break;
            }
            case 'codigo':{
                    textEtiqueta = "CODIGO: ";
                    $('txtPatron').value="Buscar...";
                    $('txtPatron').focus();
                    $('lblPatron2').style.visibility="hidden";
                    $('txtPatron2').style.visibility="hidden";
                    $('lblPatron3').style.visibility="hidden";
                    $('txtPatron3').style.visibility="hidden";
                    $('hdnOpcionBusqueda').value=3;
                    break;
            }
    }
    document.getElementById("lblPatron").textContent = textEtiqueta;
}

function getBusquedaPersona(event){
    e = event;
    if(e.keyCode == 13){
        tipoBuscador = $("hdnTipoBuscador").value;
        //idSistema = $("idSistema").value;
        opcion = $("hdnOpcionBusqueda").value;

        if(opcion==1){
            apPat=$("txtPatron").value;
            apMat=$("txtPatron2").value;
            nombre=$("txtPatron3").value;
            if(apPat==$("txtPatron").defaultValue){
                apPat='';
            }
            if(apMat==$("txtPatron2").defaultValue){
                apMat='';
            }
            if(nombre==$("txtPatron3").defaultValue){
                nombre='';
            }
            patron=apPat+"|"+apMat+"|"+nombre;
        }
        else{
            patron=$("txtPatron").value;
        }

        //datos = datos.replace(/'/gi,"\'\'");
        patron = Base64.encode(patron);

        switch (tipoBuscador){
            case 'buscarPaciente':{
                cargarTablaPacientes(opcion,patron);
                break;
            }
            case 'buscarCirujano':{
                cargarTablaCirujanos(opcion,patron);
                break;
            }
            case 'buscarCirujanoSOP':{
                cargarTablaCirujanosSOP(opcion,patron);
                break;
            }
            case 'buscarResponsableSOP':{
                cargarTablaResponsablesSOP(opcion,patron);
                break;
            }
        }
        
    }
}

function cargarTablaPacientes(opcion,patron){
    patronModulo='mostrarTablaPacientes';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+opcion;
    parametros+='&p3='+patron;

    tablaPacientes = new dhtmlXGridObject('divResultadoBusquedaPersonas');
    tablaPacientes.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaPacientes.setSkin("dhx_skyblue");
    tablaPacientes.attachEvent("onRowSelect", seleccionarPaciente);
    tablaPacientes.init();
    tablaPacientes.loadXML(pathRequestControl+'?'+parametros);
}

function cargarTablaCirujanos(opcion,patron){
    patronModulo='mostrarTablaCirujanos';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+opcion;
    parametros+='&p3='+patron;

    tablaCirujanos = new dhtmlXGridObject('divResultadoBusquedaPersonas');
    tablaCirujanos.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaCirujanos.setSkin("dhx_skyblue");
    tablaCirujanos.attachEvent("onRowSelect", seleccionarCirujano);
    tablaCirujanos.init();
    tablaCirujanos.loadXML(pathRequestControl+'?'+parametros);
}

function cargarTablaCirujanosSOP(opcion,patron){
    patronModulo='mostrarTablaCirujanos';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+opcion;
    parametros+='&p3='+patron;

    tablaCirujanosSOP = new dhtmlXGridObject('divResultadoBusquedaPersonas');
    tablaCirujanosSOP.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaCirujanosSOP.setSkin("dhx_skyblue");
    tablaCirujanosSOP.attachEvent("onRowSelect", seleccionarCirujanoSOP);
    tablaCirujanosSOP.init();
    tablaCirujanosSOP.loadXML(pathRequestControl+'?'+parametros);
}

function cargarTablaResponsablesSOP(opcion,patron){
    patronModulo='mostrarTablaCirujanos';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+opcion;
    parametros+='&p3='+patron;

    tablaResponsablesSOP = new dhtmlXGridObject('divResultadoBusquedaPersonas');
    tablaResponsablesSOP.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaResponsablesSOP.setSkin("dhx_skyblue");
    tablaResponsablesSOP.attachEvent("onRowSelect", seleccionarResponsablesSOP);
    tablaResponsablesSOP.init();
    tablaResponsablesSOP.loadXML(pathRequestControl+'?'+parametros);
}

function seleccionarPaciente(rowId, cellInd){
    //rowId-->El id de la fila es el primer campo de la tabla, cellInd-->indica el número de columna seleccionado
    var codPerPaciente, nomPerPaciente, edadPerPaciente;

    codPerPaciente = tablaPacientes.cells(rowId,0).getValue();
    nomPerPaciente = tablaPacientes.cells(rowId,2).getValue();
    edadPerPaciente = tablaPacientes.cells(rowId,4).getValue();

    Windows.close("Div_popupBuscadorPaciente");
    $('hdnCodPerPaciente').value=codPerPaciente;
    $('txtNomPacienteSolProgSOP').value=nomPerPaciente;
    $('txtEdadPacienteSolProgSOP').value=edadPerPaciente;

}

function seleccionarCirujano(rowId, cellInd){
    //rowId-->El id de la fila es el primer campo de la tabla, cellInd-->indica el número de columna seleccionado
    var codPerCirujanoAyudante, nomPerCirujanoAyudante, idHidden, idText;

    codPerCirujanoAyudante = tablaCirujanos.cells(rowId,0).getValue();
    nomPerCirujanoAyudante = tablaCirujanos.cells(rowId,2).getValue();

    idHidden = $('hdnIdHidden').value;
    idText = $('hdnIdText').value;

    Windows.close("Div_popupBuscadorCirujano");
    //$('hdnCodPerCirujanoAyudante1').value=codPerCirujanoAyudante;
    //$('txtNomPerCirujanoAyudante1').value=nomPerCirujanoAyudante;
    $(idHidden).value=codPerCirujanoAyudante;
    $(idText).value=nomPerCirujanoAyudante;
}

function seleccionarCirujanoSOP(rowId, cellInd){
    //rowId-->El id de la fila es el primer campo de la tabla, cellInd-->indica el número de columna seleccionado
    var codPerCirujano, nomPerCirujano, hdnRowId, hdnCellInd;
    
    codPerCirujano = tablaCirujanosSOP.cells(rowId,0).getValue();
    nomPerCirujano = tablaCirujanosSOP.cells(rowId,2).getValue();
    
    hdnRowId = $('hdnRowId').value;
    hdnCellInd= $('hdnCellInd').value;

    Windows.close("Div_popupBuscadorCirujanoSOP");
    
    tablaCirugiasRealizadasSOP.cells(hdnRowId,4).setValue(codPerCirujano);
    tablaCirugiasRealizadasSOP.cells(hdnRowId,5).setValue(nomPerCirujano);
}

function seleccionarResponsablesSOP(rowId, cellInd){
    //rowId-->El id de la fila es el primer campo de la tabla, cellInd-->indica el número de columna seleccionado
    var codPerCirujano, nomPerCirujano, hdnRowId, hdnCellInd;

    codPerCirujano = tablaResponsablesSOP.cells(rowId,0).getValue();
    nomPerCirujano = tablaResponsablesSOP.cells(rowId,2).getValue();

    hdnRowId = $('hdnRowId').value;
    hdnCellInd= $('hdnCellInd').value;

    Windows.close("Div_popupBuscadorResponsableSOP");

    tablaServiciosUtilizadosSOP.cells(hdnRowId,4).setValue(codPerCirujano);
    tablaServiciosUtilizadosSOP.cells(hdnRowId,5).setValue(nomPerCirujano);
}
