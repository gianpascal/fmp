
var pathRequestControl = "../../ccontrol/control/control.php";

function verSolicitudesPendientesSOP(){
    if($("Div_solicitudespendientesSOP").style.display == 'none'){
        $("Div_solicitudespendientesSOP").show();
        cargarTablaSolicitudesPendientesSOP();
    }else{
        $("Div_solicitudespendientesSOP").hide();
    }
    
}

function cargarTablaSolicitudesPendientesSOP(){
    
    patronModulo='mostrarTablaSolicitudesPendientesSOP';
    parametros='';
    parametros+='p1='+patronModulo;

    tablaSolicitudesPendientes = new dhtmlXGridObject('Div_TablaSolicitudesPendientesSOP');
    tablaSolicitudesPendientes.setImagePath("../../../../medifacil_front/imagen/icono/");
    tablaSolicitudesPendientes.setSkin("dhx_skyblue");
    tablaSolicitudesPendientes.attachEvent("onRowSelect", eventoSolicitudesPendientesSOP);
    tablaSolicitudesPendientes.init();
    tablaSolicitudesPendientes.loadXML(pathRequestControl+'?'+parametros);  
    
}

function eventoSolicitudesPendientesSOP(rowId,cellInd){
    //rowId-->El id de la fila es el primer campo de la tabla, cellInd-->indica el n�mero de columna seleccionado
    if(cellInd==8){
        //alert("Fila: "+rowId+" Columna: "+cellInd);
        mostrarManteSolicitudProgramacionSOP(rowId);
    }
    if(cellInd==9){
        //alert("Fila: "+rowId+" Columna: "+cellInd);
        aceptarSolicitudPendienteSOP(rowId,cellInd);
    }
    if(cellInd==10){
        //alert("Fila: "+rowId+" Columna: "+cellInd);
        rechazarSolicitudPendienteSOP(rowId,cellInd);
    }
}

function mostrarManteSolicitudProgramacionSOP(iidSolicitudProgramacion){
    var titulo="";
    var opcionControl="mostrarManteSolicitudProgramacionSOP";
    CargarVentana('popupManteSolicitudProgramacionSOP',titulo,'../../ccontrol/control/control.php?p1='+opcionControl+'&p2='+iidSolicitudProgramacion,'800','500',false,true,'',1,'',10,10,10,10);
}

function regresarSolicitudesPendientesSOP(){
    Windows.close("Div_popupManteSolicitudProgramacionSOP");
}

function validarManteProgramacionSOP(accion){
    //Validar ambiente logico
    var codAmbienteLogico=trimJunny($("hdnCodAmbienteLogico").value);

    if(codAmbienteLogico==""){
        alert("Seleccione ambiente");
    }
    else{
        //Validar tipo de programacion
        var indiceTipoProgramacionSOP=$("cboTipoProgSOP").selectedIndex;

        if(indiceTipoProgramacionSOP==0){
            alert("Seleccione tipo de programaci\xF3n");
        }
        else{
            //Validar hora de ingreso en SOP
            var horaIngreso=trimJunny($("txtHoraIngresoProgSOP").value);

            if(horaIngreso==""){
                alert("Seleccione hora de ingreso");
            }
            else{
                //Validar hora de salida en SOP
                var horaSalida=trimJunny($("txtHoraSalidaProgSOP").value);

                if(horaSalida==""){
                    alert("Seleccione hora de salida");
                }
                else{
                    //Validar cirujanos que operaron
                    var cadenaIdCirugiaRealizada=tablaCirugiasRealizadasSOP.getAllRowIds("|");
                    var arrayIdCirugiaRealizada=cadenaIdCirugiaRealizada.split("|");
                    //var cadenaCodMedicoCirujano="";
                    var codMedicoCirujano="";
                    var idFilaFaltaCodMedicoCirujano, faltaCodMedicoCirujano=0;

                    for(i=0; i<tablaCirugiasRealizadasSOP.getRowsNum(); i++){
                        codMedicoCirujano=tablaCirugiasRealizadasSOP.cells(arrayIdCirugiaRealizada[i],4).getValue();
                        //cadenaCodMedicoCirujano=cadenaCodMedicoCirujano+codMedicoCirujano+"|";
                        if(codMedicoCirujano==""){
                            faltaCodMedicoCirujano=1;
                            idFilaFaltaCodMedicoCirujano=arrayIdCirugiaRealizada[i];
                            break;
                        }
                    }

                    if(faltaCodMedicoCirujano==1){
                        alert("Asigne m\xE9dico al servicio "+tablaCirugiasRealizadasSOP.cells(idFilaFaltaCodMedicoCirujano,2).getValue());
                    }
                    else{
                        //Validar responsables servicios
                        var cadenaIdServicioUtilizado=tablaServiciosUtilizadosSOP.getAllRowIds("|");
                        var arrayIdServicioUtilizado=cadenaIdServicioUtilizado.split("|");
                        //var cadenaCodMedicoResponsable="";
                        var codMedicoResponsable="";
                        var idFilaFaltaCodMedicoResponsable, faltaCodMedicoResponsable=0;

                        for(i=0; i<tablaServiciosUtilizadosSOP.getRowsNum(); i++){
                            codMedicoResponsable=tablaServiciosUtilizadosSOP.cells(arrayIdServicioUtilizado[i],4).getValue();
                            //cadenaCodMedicoResponsable=cadenaCodMedicoResponsable+codMedicoResponsable+"|";
                            if(codMedicoResponsable==""){
                                faltaCodMedicoResponsable=1;
                                idFilaFaltaCodMedicoResponsable=arrayIdServicioUtilizado[i];
                                break;
                            }
                        }

                        if(faltaCodMedicoResponsable==1){
                            alert("Asigne m\xE9dico al servicio "+tablaServiciosUtilizadosSOP.cells(idFilaFaltaCodMedicoResponsable,2).getValue());
                        }
                        else{
                            manteProgramacionSOP(accion);
                        }
                    }
                }
            }
        }
    }
}

function manteProgramacionSOP(accion){
    if(confirm("\xBFEst\xE1 seguro de grabar los cambios?")){
        var iidProgramacionSOP=trimJunny($("hdnIdProgramacionSOP").value);
        var codAmbienteLogico, idTipoProgramacionSOP, horaIngreso, horaSalida;

        codAmbienteLogico=trimJunny($("hdnCodAmbienteLogico").value);
        idTipoProgramacionSOP=trimJunny($("cboTipoProgSOP").value);
        horaIngreso=trimJunny($("txtHoraIngresoProgSOP").value);
        horaSalida=trimJunny($("txtHoraSalidaProgSOP").value);

        ////////////////////////////////////////////////Cirujanos///////////////////////////////////////
        var cadenaIdCirugiaRealizada=tablaCirugiasRealizadasSOP.getAllRowIds("|");
        var arrayIdCirugiaRealizada=cadenaIdCirugiaRealizada.split("|");
        var cadenaCodMedicoCirujano="";
        var codMedicoCirujano="";
        /*
        for(i=0; i<tablaCirugiasRealizadasSOP.getRowsNum(); i++){
            codMedicoCirujano=tablaCirugiasRealizadasSOP.cells(arrayIdCirugiaRealizada[i],4).getValue();
            cadenaCodMedicoCirujano=cadenaCodMedicoCirujano+codMedicoCirujano+"|";
        }*/
        ////cadenaCodMedicoCirujano=cadenaCodMedicoCirujano.substring(0,cadenaCodMedicoCirujano.length-1);
        codMedicoCirujano=tablaCirugiasRealizadasSOP.cells(arrayIdCirugiaRealizada[0],4).getValue();
        //////////////////////////////////////////////Responsables//////////////////////////////////////
        var cadenaIdServicioUtilizado=tablaServiciosUtilizadosSOP.getAllRowIds("|");
        var arrayIdServicioUtilizado=cadenaIdServicioUtilizado.split("|");
        var cadenaCodPersonaResponsable="";
        var codMedicoResponsable="";

        for(i=0; i<tablaServiciosUtilizadosSOP.getRowsNum(); i++){
            codMedicoResponsable=tablaServiciosUtilizadosSOP.cells(arrayIdServicioUtilizado[i],4).getValue();
            cadenaCodPersonaResponsable=cadenaCodPersonaResponsable+codMedicoResponsable+"|";
        }
        cadenaCodPersonaResponsable=cadenaCodPersonaResponsable.substring(0,cadenaCodPersonaResponsable.length-1);
        ////////////////////////////////////////////////////////////////////////////////////////////////
        //datos = datos.replace(/'/gi,"\'\'");
        datos=iidProgramacionSOP+"|||"+codMedicoCirujano+"|||"+codAmbienteLogico+"|||"+idTipoProgramacionSOP+"|||"+horaIngreso+"|||"+horaSalida+"|||"+
              cadenaIdServicioUtilizado+"|||"+cadenaCodPersonaResponsable;
              
        datos=Base64.encode(datos);

        //accion='insertar';
        patronModulo='manteProgramacionSOP';
        parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+datos;
        parametros+='&p3='+accion;

        new Ajax.Request( pathRequestControl,
                            {
                                method      : 'post',
                                parameters  : parametros,
                                onLoading   : function(transport){micargador(1);},
                                onComplete  : function(transport){micargador(0);
                                            respuesta = transport.responseText;
                                            alert(respuesta);
                                            regresarDeDetalleAprogramacionesSOP();
                                            cargarTablaSolicitudesPendientesSOP();
                                            cargarTablaProgramacionesSOP();
                                            //regresarCronogramaProgramacionSOP();
                                            //verSolicitudesPendientesSOP();
                                }
                            }
                        )
    }
}

/*
    function addRow(){
        var newId = (new Date()).valueOf()
        mygrid.addRow(newId,"",mygrid.getRowsNum())
        mygrid.selectRow(mygrid.getRowIndex(newId),false,false,true);
    }
    function removeRow(){
        var selId = mygrid.getSelectedId()
        mygrid.deleteRow(selId);
    }

    <script>
          var rowsAll = grid.getAllRowIds(separator); // delimiter to use in the list should be specified
      </script>

*/

function aceptarSolicitudPendienteSOP(rowId,cellInd){
    if(confirm("\xBFEst\xE1 seguro de aceptar la solicitud?")){
        var iidSolicitudProgramacion=rowId, accion="aceptar";
        patronModulo='aceptarRechazarSolProgSOP';
        parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+iidSolicitudProgramacion;
        parametros+='&p3='+accion;

        new Ajax.Request( pathRequestControl,
                            {
                                method      : 'post',
                                parameters  : parametros,
                                onLoading   : function(transport){micargador(1);},
                                onComplete  : function(transport){
                                            micargador(0);
                                            respuesta = transport.responseText;
                                            alert(respuesta);
                                            cargarTablaSolicitudesPendientesSOP();
                                            cargarTablaProgramacionesSOP();
                                }
                            }
                        )
    }
}

function rechazarSolicitudPendienteSOP(rowId,cellInd){
    if(confirm("\xBFEst\xE1 seguro de rechazar la solicitud?")){
        var iidSolicitudProgramacion=rowId, accion="rechazar";
        patronModulo='aceptarRechazarSolProgSOP';
        parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+iidSolicitudProgramacion;
        parametros+='&p3='+accion;

        new Ajax.Request( pathRequestControl,
                            {
                                method      : 'post',
                                parameters  : parametros,
                                onLoading   : function(transport){micargador(1);},
                                onComplete  : function(transport){
                                            micargador(0);
                                            respuesta = transport.responseText;
                                            alert(respuesta);
                                            cargarTablaSolicitudesPendientesSOP();

                                }
                            }
                        )
    }
}

function cargarTablaProgramacionesSOP(){
    fechaSOP = $('hFecha').value;
    patronModulo='mostrarTablaProgramacionesSOP';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+fechaSOP;

    tablaProgramacionesSOP = new dhtmlXGridObject('Div_TablaProgramacionesSOP');
    tablaProgramacionesSOP.setImagePath("../../../../medifacil_front/imagen/icono/");
    tablaProgramacionesSOP.setSkin("dhx_skyblue");
    tablaProgramacionesSOP.attachEvent("onRowSelect", eventoProgramacionesSOP);
/*
    tablaProgramacionesSOP.attachEvent("onRowSelect", function(rowid,columnindex){
        $("hIdTablaProgramacionSOP").value = rowid;
        $('txtcodigopersona').value = rowid.split("|")[2];
        $('txtdnipaciente').value = rowid.split("|")[3];
        $('txtnombrepaciente').value = tablaProgramacionesSOP.cellById(rowid, 5).getValue();
        $('txtedadpaciente').value = tablaProgramacionesSOP.cellById(rowid, 6).getValue();
    });
*/
    tablaProgramacionesSOP.init();
    tablaProgramacionesSOP.loadXML(pathRequestControl+'?'+parametros,function(){
        
        for(i=0;i<tablaProgramacionesSOP.getRowsNum();i++){
            
            //tablaProgramacionesSOP.setCellTextStyle(tablaProgramacionesSOP.getRowId(i),j,'color:#0066FF;border-top: 1px solid #5D5D5D;');
            estadoprogramacionSOP = (tablaProgramacionesSOP.cells2(i,0).getValue()).split("|");
            switch(estadoprogramacionSOP[1]){
                case '1' :
                    tablaProgramacionesSOP.setRowColor(tablaProgramacionesSOP.getRowId(i),"white");
                    break;
                case '2' :
                    tablaProgramacionesSOP.setRowColor(tablaProgramacionesSOP.getRowId(i),"yellow");
                    break;
                case '3' :
                    tablaProgramacionesSOP.setRowColor(tablaProgramacionesSOP.getRowId(i),"green");
                    break;
                case '4' :
                    tablaProgramacionesSOP.setRowColor(tablaProgramacionesSOP.getRowId(i),"blue");
                    break;                    
                default :
                    tablaProgramacionesSOP.setRowColor(tablaProgramacionesSOP.getRowId(i),"white");
                    break;
            }

        }
    });  
}

function eventoProgramacionesSOP(rowId,cellInd){
    //rowId-->El id de la fila es el primer campo de la tabla, cellInd-->indica el n�mero de columna seleccionado
    if(cellInd==8){
        //alert("Fila: "+rowId+" Columna: "+cellInd);
        mostrarManteProgramacionSOP(rowId);
    }
    /*if(cellInd==9){
        //alert("Fila: "+rowId+" Columna: "+cellInd);
        aceptarSolicitudPendienteSOP(rowId,cellInd);
    }
    if(cellInd==10){
        //alert("Fila: "+rowId+" Columna: "+cellInd);
        rechazarSolicitudPendienteSOP(rowId,cellInd);
    }*/
}

function mostrarManteProgramacionSOP(iidProgramacionSOP){
    /*var titulo="";
    var opcionControl="mostrarManteProgramacionSOP";
    CargarVentana('popupManteProgramacionSOP',titulo,'../../ccontrol/control/control.php?p1='+opcionControl+'&p2='+iidProgramacionSOP,'800','500',false,true,'',1,'',10,10,10,10);*/

    vformname='popupManteProgramacionSOP';
    vtitle='';
    vwidth='800';
    vheight='500';
    vcenter='t';
    vresizable='';
    vmodal='false';
    vstyle='';
    vopacity='';
    vposx1='';
    vposx2='';
    vposy1='';
    vposy2='';

    patronModulo='mostrarManteProgramacionSOP';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+iidProgramacionSOP;
    posFuncion='mostrarTablasCirugiasRealizadasServiciosUtilizadosSOP';

    CargarVentanaPopPap(vformname,vtitle,vwidth,vheight,vcenter,vresizable,vmodal,vstyle,vopacity,vposx1,vposx2,vposy1,vposy2,parametros,posFuncion);
}

function mostrarTablasCirugiasRealizadasServiciosUtilizadosSOP(){
    var iidProgramacionSOP=$("hdnIdProgramacionSOP").value;
    mostrarTablaCirugiasRealizadasSOP(iidProgramacionSOP);
    mostrarTablaServiciosUtilizadosSOP(iidProgramacionSOP);
}

function mostrarTablaCirugiasRealizadasSOP(iidProgramacionSOP){
    patronModulo='tablaCirugiasRealizadasSOP';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+iidProgramacionSOP;

    tablaCirugiasRealizadasSOP = new dhtmlXGridObject('divTablaCirugiasRealizadasSOP');
    tablaCirugiasRealizadasSOP.setImagePath("../../../../medifacil_front/imagen/icono/");
    tablaCirugiasRealizadasSOP.attachEvent("onRowSelect", eventoTablaCirugiasRealizadasSOP);
    tablaCirugiasRealizadasSOP.setSkin("dhx_skyblue");
    tablaCirugiasRealizadasSOP.init();
    tablaCirugiasRealizadasSOP.loadXML(pathRequestControl+'?'+parametros);
}

function mostrarTablaServiciosUtilizadosSOP(iidProgramacionSOP){
    patronModulo='tablaServiciosUtilizadosSOP';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+iidProgramacionSOP;

    tablaServiciosUtilizadosSOP = new dhtmlXGridObject('divTablaServiciosUtilizadosSOP');
    tablaServiciosUtilizadosSOP.setImagePath("../../../../medifacil_front/imagen/icono/");
    tablaServiciosUtilizadosSOP.attachEvent("onRowSelect", eventoTablaServiciosUtilizadosSOP);
    tablaServiciosUtilizadosSOP.setSkin("dhx_skyblue");
    tablaServiciosUtilizadosSOP.init();
    tablaServiciosUtilizadosSOP.loadXML(pathRequestControl+'?'+parametros);
}

function eventoTablaCirugiasRealizadasSOP(rowId,cellInd){
    //rowId-->El id de la fila es el primer campo de la tabla, cellInd-->indica el número de columna seleccionado
    if(cellInd==6){
        mostrarBuscadorCirujanoSOP(rowId,cellInd);
    }
    else{
        if(cellInd==7){
            quitarCirujanoDeTabla(rowId);
        }
    }
}

function quitarCirujanoDeTabla(rowId){
    if(confirm("\xBFEst\xE1 seguro de quitar cirujano?")){
        tablaCirugiasRealizadasSOP.cells(rowId,4).setValue("");
        tablaCirugiasRealizadasSOP.cells(rowId,5).setValue("");
    }
}

function eventoTablaServiciosUtilizadosSOP(rowId,cellInd){
    //rowId-->El id de la fila es el primer campo de la tabla, cellInd-->indica el número de columna seleccionado
    if(cellInd==6){
        mostrarBuscadorResponsableSOP(rowId,cellInd);
    }
    else{
        if(cellInd==7){
            quitarResponsableDeTabla(rowId);
        }
    }
}

function quitarResponsableDeTabla(rowId){
    if(confirm("\xBFEst\xE1 seguro de quitar responsable?")){
        tablaServiciosUtilizadosSOP.cells(rowId,4).setValue("");
        tablaServiciosUtilizadosSOP.cells(rowId,5).setValue("");
    }
}

function mostrarBuscadorCirujanoSOP(rowId,cellInd){
    var tipoBuscador="buscarCirujanoSOP";

    vformname='popupBuscadorCirujanoSOP';
    vtitle='B\xFAsqueda de Cirujanos';
    vwidth='850';
    vheight='300';
    vcenter='t';
    vresizable='';
    vmodal='false';
    vstyle='';
    vopacity='';
    vposx1='';
    vposx2='';
    vposy1='';
    vposy2='';

    patronModulo='mostrarBuscadorCirujanoSOP';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+tipoBuscador;
    parametros+='&p3='+rowId;
    parametros+='&p4='+cellInd;
    posFuncion='';

    CargarVentanaPopPap(vformname,vtitle,vwidth,vheight,vcenter,vresizable,vmodal,vstyle,vopacity,vposx1,vposx2,vposy1,vposy2,parametros,posFuncion);
}

function mostrarBuscadorResponsableSOP(rowId,cellInd){
    var tipoBuscador="buscarResponsableSOP";

    vformname='popupBuscadorResponsableSOP';
    vtitle='B\xFAsqueda de Cirujanos';
    vwidth='850';
    vheight='300';
    vcenter='t';
    vresizable='';
    vmodal='false';
    vstyle='';
    vopacity='';
    vposx1='';
    vposx2='';
    vposy1='';
    vposy2='';

    patronModulo='mostrarBuscadorCirujanoSOP';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+tipoBuscador;
    parametros+='&p3='+rowId;
    parametros+='&p4='+cellInd;
    posFuncion='';

    CargarVentanaPopPap(vformname,vtitle,vwidth,vheight,vcenter,vresizable,vmodal,vstyle,vopacity,vposx1,vposx2,vposy1,vposy2,parametros,posFuncion);
}

function regresarDeDetalleAprogramacionesSOP(){
    Windows.close("Div_popupManteProgramacionSOP");
}

function mostrarBuscadorAmbienteLogico(hidden,text){
    /*var titulo='B\xFAsqueda de Ambientes';
    var opcionControl="mostrarBuscadorAmbienteLogico";
    CargarVentana('popupBuscadorAmbienteLogico',titulo,'../../ccontrol/control/control.php?p1='+opcionControl+'&p2='+hidden+'&p3='+text,'850','300',false,true,'',1,'',10,10,10,10);*/

    vformname='popupBuscadorAmbienteLogico';
    vtitle='B\xFAsqueda de Ambientes';
    vwidth='850';
    vheight='300';
    vcenter='t';
    vresizable='';
    vmodal='false';
    vstyle='';
    vopacity='';
    vposx1='';
    vposx2='';
    vposy1='';
    vposy2='';

    patronModulo='mostrarBuscadorAmbienteLogico';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+hidden;
    parametros+='&p3='+text;
    posFuncion='mostrarAmbientesLogicosSOP';

    CargarVentanaPopPap(vformname,vtitle,vwidth,vheight,vcenter,vresizable,vmodal,vstyle,vopacity,vposx1,vposx2,vposy1,vposy2,parametros,posFuncion);
}

function mostrarAmbientesLogicosSOP(){
    patronModulo='mostrarAmbientesLogicosSOP';
    parametros='';
    parametros+='p1='+patronModulo;

    tablaAmbienteLogicoSOP = new dhtmlXGridObject('divTablaAmbientesLogicosEncontrados');
    tablaAmbienteLogicoSOP.setImagePath("../../../../medifacil_front/imagen/icono/");
    tablaAmbienteLogicoSOP.attachEvent("onRowSelect", agregarAmbienteLogico);
    tablaAmbienteLogicoSOP.setSkin("dhx_skyblue");
    tablaAmbienteLogicoSOP.init();
    tablaAmbienteLogicoSOP.loadXML(pathRequestControl+'?'+parametros);
}

function buscarAmbienteLogicoPorNombre(){
    nombre=$('txtNombreAmbienteLogico').value;
    numero=nombre.length;
    patronModulo='tablaAmbienteLogicoSOP';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+nombre;

    //if(numero==4){
        //cn=0;
    if(numero==4){
        tablaAmbienteLogicoSOP = new dhtmlXGridObject('divTablaAmbientesLogicosEncontrados');
        tablaAmbienteLogicoSOP.setImagePath("../../../../medifacil_front/imagen/icono/");
        tablaAmbienteLogicoSOP.attachEvent("onRowSelect", agregarAmbienteLogico);
        tablaAmbienteLogicoSOP.setSkin("dhx_skyblue");
        tablaAmbienteLogicoSOP.init();
        tablaAmbienteLogicoSOP.loadXML(pathRequestControl+'?'+parametros,function(){
            //cn=1;
        });
    }
    //setTimeout('x=1',1000);
    //}
    /*if(numero>4&&cn==1){
        miTablaCie.filterBy(1,$('textNombreCie').value);
    }*/
}

function agregarAmbienteLogico(rowId, cellInd){
    //rowId-->El id de la fila es el primer campo de la tabla, cellInd-->indica el n�mero de columna seleccionado
    var codAmbienteLogico, nomAmbienteLogico, idHidden, idText;

    codAmbienteLogico = tablaAmbienteLogicoSOP.cells(rowId,0).getValue();
    nomAmbienteLogico = tablaAmbienteLogicoSOP.cells(rowId,1).getValue();

    idHidden = $('hdnIdHidden').value;
    idText = $('hdnIdText').value;

    Windows.close("Div_popupBuscadorAmbienteLogico");
    
    $(idHidden).value=codAmbienteLogico;
    $(idText).value=nomAmbienteLogico;
}

function cargarLeyendaProgramacionesSOP(){
    patronModulo='mostrarTablaLeyendaSOP';
    parametros='';
    parametros+='p1='+patronModulo;

    tablaLeyendaProgramacionesSOP = new dhtmlXGridObject('Div_LeyendaProgramacionSOP');
    tablaLeyendaProgramacionesSOP.setImagePath("../../../../medifacil_front/imagen/icono/");
    tablaLeyendaProgramacionesSOP.setSkin("dhx_skyblue");
    //tablaSolicitudesPendientes.attachEvent("onRowSelect", agregarMedicamentoHC);
    tablaLeyendaProgramacionesSOP.init();
    tablaLeyendaProgramacionesSOP.loadXML(pathRequestControl+'?'+parametros,function(){
        tablaLeyendaProgramacionesSOP.cells(1,1).setBgColor('white');
        tablaLeyendaProgramacionesSOP.cells(2,1).setBgColor('yellow');
        tablaLeyendaProgramacionesSOP.cells(3,1).setBgColor('green');
        tablaLeyendaProgramacionesSOP.cells(4,1).setBgColor('blue');
    })

}
function mostrarSolicitudProgramacionSOP(){
    $("Div_GeneralProgramacionSOP").hide();
    $("Div_SolicitudProgramacionSOP").show();
}


function mostrarPreOrdenFarmaciaSOP(){
    if($("hIdTablaProgramacionSOP").value == ''){
        if(window.confirm("�Desea Generar la pre-orden sin asignarla a una programacion SOP?")){
            $("hIdTablaProgramacionSOP").value = '0';
            $("Div_GeneralProgramacionSOP").hide();
            $("Div_PreOrdenFarmaciaSOP").show();
            mostrarDatosdelPaqueteAsignadoFarmaciaSOP();
            mostrarTablaGeneracionPreOrdenFarmaciaSOP();
            $("busquedaPersonaCISOP").show();
        }else{
            window.alert("Seleccione una programacion,por favor...")
        }           
    }else{
        $("Div_GeneralProgramacionSOP").hide();
        $("Div_PreOrdenFarmaciaSOP").show();
        mostrarDatosdelPaqueteAsignadoFarmaciaSOP();
        mostrarTablaGeneracionPreOrdenFarmaciaSOP(); 
        $("busquedaPersonaCISOP").hide();
    }
}
function volveraProgramacionSOPdesdeCIFarmaciaSOP(){
    $("hIdTablaProgramacionSOP").value = '';
    $("txtcodigopersona").value = '';
    $("txtnombrepaciente").value = '';  
    $("txtedadpaciente").value = '';  
    $("Div_GeneralProgramacionSOP").show();
    $("Div_PreOrdenFarmaciaSOP").hide();    
    tablaProgramacionesSOP.clearSelection();
}

/*********************************Funciones PENDEX******************************/
function regresarCronogramaProgramacionSOP(){
    $("Div_SolicitudProgramacionSOP").hide();
    $("Div_GeneralProgramacionSOP").show();
}

function validarFechaPropuestaSolProgSOP(fechaComoCadena){
    var numRespuesta=1;
    fechaComoCadena = trimJunny(fechaComoCadena);
    
    if(fechaComoCadena!=""){
        // /^\d{1,2}\/\d{1,2}\/\d{2,4}$/
        expRegFecha1=/^\d{1,2}\/\d{1,2}\/\d{2}$/;
        expRegFecha2=/^\d{1,2}\/\d{1,2}\/\d{4}$/;

        if(expRegFecha1.test(fechaComoCadena) || expRegFecha2.test(fechaComoCadena)){
            
            var dia,mes,anio;
            var arrayFecha=fechaComoCadena.split("/");
            var numDiasPorMes;

            dia=arrayFecha[0];
            mes=arrayFecha[1];
            anio=arrayFecha[2];

            var numeroMes=parseInt(mes,10);
            var numeroDia=parseInt(dia,10);

            switch(numeroMes){
                case 1:
                case 3:
                case 5:
                case 7:
                case 8:
                case 10:
                case 12:
                    numDiasPorMes=31;
                    break;
                case 4: case 6: case 9: case 11:
                    numDiasPorMes=30;
                    break;
                case 2:
                    if (esBisiesto(anio)){
                        numDiasPorMes=29;
                    }else{
                        numDiasPorMes=28;
                    }
                    break;
                default:
                    //alert("Fecha introducida err\xF3nea");
                    //
                    ////alert("N\xFAmero de mes fuera de rango permitido");
                    numRespuesta=-3;
                    //
                    //$("txtFechaPropuestaSolProgSOP").focus();
            }

            ////alert("Numero de mes: "+numeroMes+" Numero de dia: "+numeroDia);

            //alert("Formato de fecha v�lido (dd/mm/aaaa): " + arrayFecha[0]+"-"+arrayFecha[1]+"-"+arrayFecha[2]);
        }
        else{
            ////alert("Formato de fecha no v�lido!!!" + fechaComoCadena);
            //$("txtFechaPropuestaSolProgSOP").focus();
            numRespuesta=-2;
        }
    }
    else{
        //$("txtFechaPropuestaSolProgSOP").focus();
        /*var myText=document.getElementById("txtFechaPropuestaSolProgSOP");
        myText.focus();*/
        ////alert("Cadena Vac�a");
        numRespuesta=-1;
    }

    //return numRespuesta;
    alert(numRespuesta);
}

function esBisiesto(anio){
    var esBisiesto=false;
    
    if(anio % 400 == 0){
        esBisiesto=true;
    }
    else{
        if(anio % 100 == 0){
            esBisiesto=false;
        }
        else{
            if(anio % 4 == 0){
                esBisiesto=true;
            }
            else{
                esBisiesto=false;
            }
        }
    }

    return esBisiesto;
}

function mostrarBuscadorPaciente(hidden,text){
    //CargarVentana('popupMantCamaxAmbFisico','Ambiente F�sico: '+nomAmbienteFisico,'../mantenimientogeneral/manteCamaxAmbFisico.php?p2='+codAmbienteFisico+'&p3='+nomAmbienteFisico,'500','400',false,true,'',1,'',10,10,10,10);
    var tipoBuscador="buscarPaciente"; // El archivo de referencia para la ventana emergente es inicio.php
    CargarVentana('popupBuscadorPaciente','B\xFAsqueda de Pacientes','../busqueda/buscadorPersona.php?p1='+tipoBuscador+'&p2='+hidden+'&p3='+text,'850','300',false,true,'',1,'',10,10,10,10);
}

function mostrarBuscadorDxPreOperatorio(hidden,text){
    //var patronModulo="xxx"; // El archivo de referencia para la ventana emergente es inicio.php
    CargarVentana('popupBuscadorDxPreOperatorio','B\xFAsqueda CIE-10','../busqueda/buscadorCIE10.php?p1='+hidden+'&p2='+text,'850','300',false,true,'',1,'',10,10,10,10);
}

function mostrarBuscadorServicioCirugia(hidden,text){
    //<a href="javascript:mostrarBuscadorServicioCirugia('hdnCodServicioCirugia1','txtDescServicioCirugia1')">
    //var patronModulo="xxx"; // El archivo de referencia para la ventana emergente es inicio.php
    CargarVentana('popupBuscadorServicioCirugia','B\xFAsqueda de Cirug\xEDa','../busqueda/buscadorCirugia.php?p1='+hidden+'&p2='+text,'850','300',false,true,'',1,'',10,10,10,10);
}

function mostrarBuscadorCirujano(hidden,text){
    var tipoBuscador="buscarCirujano"; // El archivo de referencia para la ventana emergente es inicio.php
    CargarVentana('popupBuscadorCirujano','B\xFAsqueda de Cirujanos','../busqueda/buscadorPersona.php?p1='+tipoBuscador+'&p2='+hidden+'&p3='+text,'850','300',false,true,'',1,'',10,10,10,10);
}

function buscarCieNombreDxPreOperatorio(){
    nombre=$('txtNombreCieDxPreOperatorio').value;
    numero=nombre.length;
    patronModulo='tablaCieDxPreOperatorio';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+nombre;

    //if(numero==4){
        //cn=0;
    if(numero==4){
        tablaCieDxPreOperatorio = new dhtmlXGridObject('divTablaCieDxPreOperatorio');
        tablaCieDxPreOperatorio.setImagePath("../../../../medifacil_front/imagen/icono/");
        tablaCieDxPreOperatorio.attachEvent("onRowSelect", agregarDxPreOperatorio);
        tablaCieDxPreOperatorio.setSkin("dhx_skyblue");
        tablaCieDxPreOperatorio.init();
        tablaCieDxPreOperatorio.loadXML(pathRequestControl+'?'+parametros,function(){
            //cn=1;
        });
    }
    //setTimeout('x=1',1000);
    //}
    /*if(numero>4&&cn==1){
        miTablaCie.filterBy(1,$('textNombreCie').value);
    }*/
}

function agregarDxPreOperatorio(rowId, cellInd){
    //rowId-->El id de la fila es el primer campo de la tabla, cellInd-->indica el n�mero de columna seleccionado
    var idCie, codCie, descCie, idHidden, idText;

    idCie = tablaCieDxPreOperatorio.cells(rowId,0).getValue();
    codCie = tablaCieDxPreOperatorio.cells(rowId,1).getValue();
    descCie = tablaCieDxPreOperatorio.cells(rowId,2).getValue();

    idHidden = $('hdnIdHidden').value;
    idText = $('hdnIdText').value;

    Windows.close("Div_popupBuscadorDxPreOperatorio");
    //$('hdnIdDxPreOperatorio1').value=idCie1;
    //$('txtDescDxPreOperatorio1').value=descCie1;
    $(idHidden).value=idCie;
    $(idText).value=descCie;
}

function nuevoDxPreOperatorio(){
    var divTabla, divNuevaFila, numDxPreOperatorio, patronIdFila, patronNombreDxPreOperatorio, patronIdHidden, patronIdText;

    patronIdFila="divFilaDxPreOperatorio";
    patronNombreDxPreOperatorio="Dx PreOperatorio ";
    patronIdHidden="hdnIdDxPreOperatorio";
    patronIdText="txtDescDxPreOperatorio";

    numDxPreOperatorio=parseInt($('hdnNroDxPreOperatorio').value,10)+1;
    $('hdnNroDxPreOperatorio').value=numDxPreOperatorio;//Actualizamos la cantidad

    idNuevaFila=patronIdFila + "_" + numDxPreOperatorio;
    nomNuevoDxPreOperatorio=patronNombreDxPreOperatorio + numDxPreOperatorio;
    idNuevoHidden=patronIdHidden + "_" + numDxPreOperatorio;
    idNuevoText=patronIdText + "_" + numDxPreOperatorio;
    
    divTabla = document.getElementById("divTablaDxPreOperatorio");
    divNuevaFila = document.createElement("div");
    divNuevaFila.setAttribute("id",idNuevaFila);
    divNuevaFila.setAttribute("style","clear:left;width:100%");
    ////////////////////////////////////////////////////////////////////////////
    divCol1=document.createElement("div");
    divCol1.setAttribute("style","float:left; width:22%");
    labelDxPreOperatorio=document.createElement("label");
    labelDxPreOperatorio.appendChild(document.createTextNode(nomNuevoDxPreOperatorio));
    divCol1.appendChild(labelDxPreOperatorio);
    ////////////////////////////////////////////////////////////////////////////
    divCol2=document.createElement("div");
    divCol2.setAttribute("style","float:left; width:45%");

    hiddenIdDxPreOperatorio=document.createElement("input");
    hiddenIdDxPreOperatorio.setAttribute("type","hidden");
    hiddenIdDxPreOperatorio.setAttribute("id",idNuevoHidden);
    hiddenIdDxPreOperatorio.setAttribute("name",idNuevoHidden);
    hiddenIdDxPreOperatorio.setAttribute("value","");
    textDescDxPreOperatorio=document.createElement("input");
    textDescDxPreOperatorio.setAttribute("type","text");
    textDescDxPreOperatorio.setAttribute("id",idNuevoText);
    textDescDxPreOperatorio.setAttribute("name",idNuevoText);
    textDescDxPreOperatorio.setAttribute("value","");
    textDescDxPreOperatorio.setAttribute("size","50");
    textDescDxPreOperatorio.setAttribute("readonly","true");
    
    divCol2.appendChild(hiddenIdDxPreOperatorio);
    divCol2.appendChild(textDescDxPreOperatorio);
    ////////////////////////////////////////////////////////////////////////////
    divCol3=document.createElement("div");
    divCol3.setAttribute("style","float:left; width:11%");
    linkBuscador = document.createElement("a");
    linkBuscador.setAttribute("href","#");
    linkBuscador.setAttribute("onclick","mostrarBuscadorDxPreOperatorio('"+idNuevoHidden+"','"+idNuevoText+"');");
    imgBuscador = document.createElement("img");
    imgBuscador.setAttribute("src","../../../../medifacil_front/imagen/btn/nbtn_buscar.gif");
    linkBuscador.appendChild(imgBuscador);
    divCol3.appendChild(linkBuscador);
    ////////////////////////////////////////////////////////////////////////////
    divCol4=document.createElement("div");
    divCol4.setAttribute("style","float:left; width:11%");
    linkEliminar = document.createElement("a");
    linkEliminar.setAttribute("href","#");
    linkEliminar.setAttribute("onclick","eliminarDxPreOperatorio('"+idNuevaFila+"');");
    imgEliminar = document.createElement("img");
    imgEliminar.setAttribute("src","../../../imagen/inicio/eliminar.gif");
    linkEliminar.appendChild(imgEliminar);
    divCol4.appendChild(linkEliminar);
    ////////////////////////////////////////////////////////////////////////////
    divCol5=document.createElement("div");
    divCol5.setAttribute("style","float:left; width:11%");

    divNuevaFila.appendChild(divCol1);
    divNuevaFila.appendChild(divCol2);
    divNuevaFila.appendChild(divCol3);
    divNuevaFila.appendChild(divCol4);
    divNuevaFila.appendChild(divCol5);
    
    divTabla.appendChild(divNuevaFila);
    $('hdnCadenaIdDxPreOperatorio').value=$('hdnCadenaIdDxPreOperatorio').value+"|"+numDxPreOperatorio;
}

function eliminarDxPreOperatorio(idDivFilaDxPreOperatorio){
    var nodoHijo = document.getElementById(idDivFilaDxPreOperatorio);
    var nodoPadre = nodoHijo.parentNode;
    var cadena = $('hdnCadenaIdDxPreOperatorio').value;
    var cadenaNueva = "";
    arrayNombreFila = idDivFilaDxPreOperatorio.split("_");
    numFilaEliminada = arrayNombreFila[1];

    nodoPadre.removeChild(nodoHijo);

    arrayIdDxPreOperatorio = cadena.split("|");
    for(i=0; i<arrayIdDxPreOperatorio.length; i++){
        if(arrayIdDxPreOperatorio[i]!=numFilaEliminada){
            cadenaNueva = cadenaNueva + arrayIdDxPreOperatorio[i] + "|";
        }
    }

    cadenaNueva = cadenaNueva.substring(0,cadenaNueva.length-1);
    $('hdnCadenaIdDxPreOperatorio').value=cadenaNueva;
}

function nuevoServicioCirugia(){
    var divTabla, divNuevaFila, numServicioCirugia, patronIdFila, patronNombreServicioCirugia, patronIdHidden, patronIdText, patronIdTextPorcentaje;

    patronIdFila="divFilaTablaCirugia";
    patronNombreServicioCirugia="Operaci�n ";
    patronIdHidden="hdnCodServicioCirugia";
    patronIdText="txtDescServicioCirugia";
    patronIdTextPorcentaje="txtPorcServicioCirugia";
    
    numServicioCirugia=parseInt($('hdnNroServicioCirugia').value,10)+1;
    $('hdnNroServicioCirugia').value=numServicioCirugia;//Actualizamos la cantidad

    idNuevaFila=patronIdFila + "_" + numServicioCirugia;
    nomNuevoServicioCirugia=patronNombreServicioCirugia + numServicioCirugia;
    idNuevoHidden=patronIdHidden + "_" + numServicioCirugia;
    idNuevoText=patronIdText + "_" + numServicioCirugia;
    idNuevoTextPorcentaje=patronIdTextPorcentaje + "_" + numServicioCirugia;

    divTabla = document.getElementById("divTablaCirugia");
    divNuevaFila = document.createElement("div");
    divNuevaFila.setAttribute("id",idNuevaFila);
    divNuevaFila.setAttribute("style","clear:left;width:100%");
    ////////////////////////////////////////////////////////////////////////////
    divCol1=document.createElement("div");
    divCol1.setAttribute("style","float:left; width:22%");
    labelServicioCirugia=document.createElement("label");
    labelServicioCirugia.appendChild(document.createTextNode(nomNuevoServicioCirugia));
    divCol1.appendChild(labelServicioCirugia);
    ////////////////////////////////////////////////////////////////////////////
    divCol2=document.createElement("div");
    divCol2.setAttribute("style","float:left; width:45%");

    hiddenIdServicioCirugia=document.createElement("input");
    hiddenIdServicioCirugia.setAttribute("type","hidden");
    hiddenIdServicioCirugia.setAttribute("id",idNuevoHidden);
    hiddenIdServicioCirugia.setAttribute("name",idNuevoHidden);
    hiddenIdServicioCirugia.setAttribute("value","");
    textDescServicioCirugia=document.createElement("input");
    textDescServicioCirugia.setAttribute("type","text");
    textDescServicioCirugia.setAttribute("id",idNuevoText);
    textDescServicioCirugia.setAttribute("name",idNuevoText);
    textDescServicioCirugia.setAttribute("value","");
    textDescServicioCirugia.setAttribute("size","50");
    textDescServicioCirugia.setAttribute("readonly","true");

    divCol2.appendChild(hiddenIdServicioCirugia);
    divCol2.appendChild(textDescServicioCirugia);
    ////////////////////////////////////////////////////////////////////////////
    divCol3=document.createElement("div");
    divCol3.setAttribute("style","float:left; width:11%");
    textPorcentaje=document.createElement("input");
    textPorcentaje.setAttribute("type","text");
    textPorcentaje.setAttribute("id",idNuevoTextPorcentaje);
    textPorcentaje.setAttribute("name",idNuevoTextPorcentaje);
    textPorcentaje.setAttribute("size","5");
    //textPorcentaje.setAttribute("readonly","true");
    textPorcentaje.setAttribute("value","100");
    divCol3.appendChild(textPorcentaje);
    divCol3.appendChild(document.createTextNode("%"));
    ////////////////////////////////////////////////////////////////////////////
    divCol4=document.createElement("div");
    divCol4.setAttribute("style","float:left; width:11%");
    linkBuscador = document.createElement("a");
    linkBuscador.setAttribute("href","#");
    linkBuscador.setAttribute("onclick","mostrarBuscadorServicioCirugia('"+idNuevoHidden+"','"+idNuevoText+"');");
    imgBuscador = document.createElement("img");
    imgBuscador.setAttribute("src","../../../../medifacil_front/imagen/btn/nbtn_buscar.gif");
    linkBuscador.appendChild(imgBuscador);
    divCol4.appendChild(linkBuscador);
    ////////////////////////////////////////////////////////////////////////////
    divCol5=document.createElement("div");
    divCol5.setAttribute("style","float:left; width:11%");
    linkEliminar = document.createElement("a");
    linkEliminar.setAttribute("href","#");
    linkEliminar.setAttribute("onclick","eliminarServicioCirugia('"+idNuevaFila+"');");
    imgEliminar  = document.createElement("img");
    imgEliminar.setAttribute("src","../../../imagen/inicio/eliminar.gif");
    linkEliminar.appendChild(imgEliminar);
    divCol5.appendChild(linkEliminar);
    ////////////////////////////////////////////////////////////////////////////
    divNuevaFila.appendChild(divCol1);
    divNuevaFila.appendChild(divCol2);
    divNuevaFila.appendChild(divCol3);
    divNuevaFila.appendChild(divCol4);
    divNuevaFila.appendChild(divCol5);

    divTabla.appendChild(divNuevaFila);
    $('hdnCadenaCodServicioCirugia').value=$('hdnCadenaCodServicioCirugia').value+"|"+numServicioCirugia;
}

function eliminarServicioCirugia(idDivFilaServicioCirugia){
    var nodoHijo = document.getElementById(idDivFilaServicioCirugia);
    var nodoPadre = nodoHijo.parentNode;
    var cadena = $('hdnCadenaCodServicioCirugia').value;
    var cadenaNueva = "";
    arrayNombreFila = idDivFilaServicioCirugia.split("_");
    numFilaEliminada = arrayNombreFila[1];

    nodoPadre.removeChild(nodoHijo);

    arrayCodServicioCirugia = cadena.split("|");
    for(i=0; i<arrayCodServicioCirugia.length; i++){
        if(arrayCodServicioCirugia[i]!=numFilaEliminada){
            cadenaNueva = cadenaNueva + arrayCodServicioCirugia[i] + "|";
        }
    }

    cadenaNueva = cadenaNueva.substring(0,cadenaNueva.length-1);
    $('hdnCadenaCodServicioCirugia').value=cadenaNueva;
}

function nuevoCirujanoAyudante(){
    var divTabla, divNuevaFila, numCirujanoAyudante, patronIdFila, patronNombreCirujanoAyudante, patronIdHidden, patronIdText;

    patronIdFila="divFilaTablaCirujanoAyudante";
    patronNombreCirujanoAyudante="Ayudante ";
    patronIdHidden="hdnCodPerCirujanoAyudante";
    patronIdText="txtNomPerCirujanoAyudante";

    numCirujanoAyudante=parseInt($('hdnNroCirujanoAyudante').value,10)+1;
    $('hdnNroCirujanoAyudante').value=numCirujanoAyudante;//Actualizamos la cantidad

    idNuevaFila=patronIdFila + "_" + numCirujanoAyudante;
    nomNuevoCirujanoAyudante=patronNombreCirujanoAyudante + numCirujanoAyudante;
    idNuevoHidden=patronIdHidden + "_" + numCirujanoAyudante;
    idNuevoText=patronIdText + "_" + numCirujanoAyudante;

    divTabla = document.getElementById("divTablaCirujanoAyudante");
    divNuevaFila = document.createElement("div");
    divNuevaFila.setAttribute("id",idNuevaFila);
    divNuevaFila.setAttribute("style","clear:left;width:100%");
    ////////////////////////////////////////////////////////////////////////////
    divCol1=document.createElement("div");
    divCol1.setAttribute("style","float:left; width:22%");
    labelCirujanoAyudante=document.createElement("label");
    labelCirujanoAyudante.appendChild(document.createTextNode(nomNuevoCirujanoAyudante));
    divCol1.appendChild(labelCirujanoAyudante);
    ////////////////////////////////////////////////////////////////////////////
    divCol2=document.createElement("div");
    divCol2.setAttribute("style","float:left; width:45%");

    hiddenIdCirujanoAyudante=document.createElement("input");
    hiddenIdCirujanoAyudante.setAttribute("type","hidden");
    hiddenIdCirujanoAyudante.setAttribute("id",idNuevoHidden);
    hiddenIdCirujanoAyudante.setAttribute("name",idNuevoHidden);
    hiddenIdCirujanoAyudante.setAttribute("value","");
    textNomPerCirujanoAyudante=document.createElement("input");
    textNomPerCirujanoAyudante.setAttribute("type","text");
    textNomPerCirujanoAyudante.setAttribute("id",idNuevoText);
    textNomPerCirujanoAyudante.setAttribute("name",idNuevoText);
    textNomPerCirujanoAyudante.setAttribute("value","");
    textNomPerCirujanoAyudante.setAttribute("size","50");
    textNomPerCirujanoAyudante.setAttribute("readonly","true");

    divCol2.appendChild(hiddenIdCirujanoAyudante);
    divCol2.appendChild(textNomPerCirujanoAyudante);
    ////////////////////////////////////////////////////////////////////////////
    divCol3=document.createElement("div");
    divCol3.setAttribute("style","float:left; width:11%");
    linkBuscador = document.createElement("a");
    linkBuscador.setAttribute("href","#");
    linkBuscador.setAttribute("onclick","mostrarBuscadorCirujano('"+idNuevoHidden+"','"+idNuevoText+"');");
    imgBuscador = document.createElement("img");
    imgBuscador.setAttribute("src","../../../../medifacil_front/imagen/btn/nbtn_buscar.gif");
    linkBuscador.appendChild(imgBuscador);
    divCol3.appendChild(linkBuscador);
    ////////////////////////////////////////////////////////////////////////////
    divCol4=document.createElement("div");
    divCol4.setAttribute("style","float:left; width:11%");
    linkEliminar = document.createElement("a");
    linkEliminar.setAttribute("href","#");
    linkEliminar.setAttribute("onclick","eliminarCirujanoAyudante('"+idNuevaFila+"');");
    imgEliminar  = document.createElement("img");
    imgEliminar.setAttribute("src","../../../imagen/inicio/eliminar.gif");
    linkEliminar.appendChild(imgEliminar);
    divCol4.appendChild(linkEliminar);
    ////////////////////////////////////////////////////////////////////////////
    divCol5=document.createElement("div");
    divCol5.setAttribute("style","float:left; width:11%");
    //espBlco=document.createTextNode("&nbsp;");

    divNuevaFila.appendChild(divCol1);
    divNuevaFila.appendChild(divCol2);
    divNuevaFila.appendChild(divCol3);
    divNuevaFila.appendChild(divCol4);
    divNuevaFila.appendChild(divCol5);

    divTabla.appendChild(divNuevaFila);
    $('hdnCadenaCodPerCirujanoAyudante').value=$('hdnCadenaCodPerCirujanoAyudante').value+"|"+numCirujanoAyudante;
}

function eliminarCirujanoAyudante(idDivFilaCirujanoAyudante){
    var nodoHijo = document.getElementById(idDivFilaCirujanoAyudante);
    var nodoPadre = nodoHijo.parentNode;
    var cadena = $('hdnCadenaCodPerCirujanoAyudante').value;
    var cadenaNueva = "";
    arrayNombreFila = idDivFilaCirujanoAyudante.split("_");
    numFilaEliminada = arrayNombreFila[1];

    nodoPadre.removeChild(nodoHijo);

    arrayCodPerCirujanoAyudante = cadena.split("|");
    for(i=0; i<arrayCodPerCirujanoAyudante.length; i++){
        if(arrayCodPerCirujanoAyudante[i]!=numFilaEliminada){
            cadenaNueva = cadenaNueva + arrayCodPerCirujanoAyudante[i] + "|";
        }
    }

    cadenaNueva = cadenaNueva.substring(0,cadenaNueva.length-1);
    $('hdnCadenaCodPerCirujanoAyudante').value=cadenaNueva;
}

function buscarCieCodigoDxPreOperatorio(){
    
}

/*
function buscarCieCodigo(){

    // miTablaCie.filterBy(0,codigo);

    //////////////////
    codigo=$('textCodigoCie').value;
    numero=codigo.length;
    patronModulo='tablaCie';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+codigo;
    parametros+='&p3='+'3';  //para la busqueda de cie por codigo

    if(numero==2){
        cc=0;
        miTablaCie = new dhtmlXGridObject('tablaCie');
        miTablaCie.setImagePath("../../../../medifacil_front/imagen/icono/");
        miTablaCie.attachEvent("onRowSelect", agregarAntecedente);
        miTablaCie.setSkin("dhx_skyblue");
        miTablaCie.init();
        miTablaCie.loadXML(pathRequestControl+'?'+parametros,function(){
            cc=1;
        });
    //setTimeout('x=1',1000);
    }
    if(numero>2&&cc==1){
        miTablaCie.filterBy(0,$('textCodigoCie').value);
    }
}
*/

function buscarServicioNombreCirugia(){
    nombre=$('txtNombreServicioCirugia').value;
    numero=nombre.length;
    patronModulo='tablaServicioCirugia';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+nombre;

    //if(numero==4){
        //cn=0;
    if(numero==2){
        tablaServicioCirugia = new dhtmlXGridObject('divTablaServicioCirugia');
        tablaServicioCirugia.setImagePath("../../../../medifacil_front/imagen/icono/");
        tablaServicioCirugia.attachEvent("onRowSelect", agregarServicioCirugia);
        tablaServicioCirugia.setSkin("dhx_skyblue");
        tablaServicioCirugia.init();
        tablaServicioCirugia.loadXML(pathRequestControl+'?'+parametros,function(){
            //cn=1;
        });
    }
    //setTimeout('x=1',1000);
    //}
    /*if(numero>4&&cn==1){
        miTablaCie.filterBy(1,$('textNombreCie').value);
    }*/
}

function agregarServicioCirugia(rowId, cellInd){
    //rowId-->El id de la fila es el primer campo de la tabla, cellInd-->indica el n�mero de columna seleccionado
    var codServicioCirugia, descServicioCirugia, idHidden, idText;

    codServicioCirugia = tablaServicioCirugia.cells(rowId,0).getValue();
    descServicioCirugia = tablaServicioCirugia.cells(rowId,1).getValue();

    idHidden = $('hdnIdHidden').value;
    idText = $('hdnIdText').value;

    Windows.close("Div_popupBuscadorServicioCirugia");
    //$('hdnCodServicioCirugia1').value=codServicioCirugia1;
    //$('txtDescServicioCirugia1').value=descServicioCirugia1;
    $(idHidden).value=codServicioCirugia;
    $(idText).value=descServicioCirugia;
}

function lTrimJunny(s) {
	return s.replace(/^\s+/, "");
}

function rTrimJunny(s) {
	return s.replace(/\s+$/, "");
}

function trimJunny(s) {
	return rTrimJunny(lTrimJunny(s));
}

function validarManteSolProgSOP(accion){
    //Validar Fecha Propuesta
    var fechaComoCadena=$("txtFechaPropuestaSolProgSOP").value;
    if(validarFechaPropuestaSolProgSOP(fechaComoCadena)!=1){
        alert("Formato de fecha no v\xE1lido");
        $("txtFechaPropuestaSolProgSOP").focus();
    }
    else{
        //Validar Seleccion Hora Propuesta
        var indiceHoraPropuesta=$("cboHoraPropuestaSolProgSOP").selectedIndex;
        if(indiceHoraPropuesta==0){
            alert("Seleccione Hora Propuesta");
            $("cboHoraPropuestaSolProgSOP").focus();
        }
        else{
            //Validar Busqueda Paciente
            var codPerPaciente=trimJunny($("hdnCodPerPaciente").value);
            if(codPerPaciente==""){
                alert("Seleccione Paciente");
                $("txtNomPacienteSolProgSOP").focus();
            }
            else{
                //Validar Seleccion Centro de Costo de Cirugia
                var indiceCentroCostoCirugia=$("cboCentroCostoSolProgSOP").selectedIndex;
                if(indiceCentroCostoCirugia==0){
                    alert("Seleccione Centro de Costo");
                    $("cboCentroCostoSolProgSOP").focus();
                }
                else{
                    //Validar DxPreOperatorio
                    cadenaIdDxPreOperatorio=$("hdnCadenaIdDxPreOperatorio").value;
                    arrayIdDxPreOperatorio=cadenaIdDxPreOperatorio.split("|");
                    
                    faltaIngresarDxPreOperatorio=0;
                    patronNombreDxPreOperatorio="Dx PreOperatorio ";
                    patronIdHidden="hdnIdDxPreOperatorio";
                    patronIdText="txtDescDxPreOperatorio";

                    for(i=0; i<arrayIdDxPreOperatorio.length; i++){
                        idNuevoHidden = patronIdHidden + "_" + arrayIdDxPreOperatorio[i];
                        if($(idNuevoHidden).value=="" || $(idNuevoHidden).value==null){
                            faltaIngresarDxPreOperatorio=1;
                            indice=i;
                            break;
                        }
                    }

                    if(faltaIngresarDxPreOperatorio==1){
                        alert("Ingrese " + patronNombreDxPreOperatorio + arrayIdDxPreOperatorio[indice]);
                        idTextFaltaDxPreOperatorio=patronIdText + "_" + arrayIdDxPreOperatorio[indice];
                        $(idTextFaltaDxPreOperatorio).focus();
                    }
                    else{
                        //Validar Sevicio Cirugia
                        cadenaCodServicioCirugia=$("hdnCadenaCodServicioCirugia").value;
                        arrayCodServicioCirugia=cadenaCodServicioCirugia.split("|");

                        faltaIngresarServicioCirugia=0;
                        patronNombreServicioCirugia="Operaci�n ";
                        patronIdHidden="hdnCodServicioCirugia";
                        patronIdText="txtDescServicioCirugia";
                        patronIdTextPorcentaje="txtPorcServicioCirugia";

                        for(i=0; i<arrayCodServicioCirugia.length; i++){
                            idNuevoHidden = patronIdHidden + "_" + arrayCodServicioCirugia[i];
                            idNuevoTextPorcentaje = patronIdTextPorcentaje + "_" + arrayCodServicioCirugia[i];
                            if($(idNuevoHidden).value=="" || $(idNuevoHidden).value==null){
                                if($(idNuevoTextPorcentaje).value=="" || $(idNuevoTextPorcentaje).value==null){
                                    faltaIngresarServicioCirugia=2;
                                }
                                else{
                                    faltaIngresarServicioCirugia=1;
                                }
                                indice=i;
                                break;
                            }
                            else{
                                if($(idNuevoTextPorcentaje).value=="" || $(idNuevoTextPorcentaje).value==null){
                                    faltaIngresarServicioCirugia=3;
                                    indice=i;
                                    break;
                                }
                            }
                        }
                        if(faltaIngresarServicioCirugia==1){
                            alert("Ingrese " + patronNombreServicioCirugia + arrayCodServicioCirugia[indice]);
                            idTextFaltaServicioCirugia=patronIdText + "_" + arrayCodServicioCirugia[indice];
                            $(idTextFaltaServicioCirugia).focus();
                        }
                        else{
                            if(faltaIngresarServicioCirugia==2){
                                alert("Ingrese " + patronNombreServicioCirugia + arrayCodServicioCirugia[indice] + " y su porcentaje");
                                idTextFaltaServicioCirugia=patronIdText + "_" + arrayCodServicioCirugia[indice];
                                $(idTextFaltaServicioCirugia).focus();
                            }
                            else{
                                if(faltaIngresarServicioCirugia==3){
                                    alert("Ingrese porcentaje de " + patronNombreServicioCirugia + arrayCodServicioCirugia[indice]);
                                    idTextFaltaPorcServicioCirugia=patronIdTextPorcentaje + "_" + arrayCodServicioCirugia[indice];
                                    $(idTextFaltaPorcServicioCirugia).focus();
                                }
                                else{
                                    //Validar Duracion Cirugia
                                    var indiceDuracionCirugia=$("cboHorasEstimadasSolProgSOP").selectedIndex;
                                    if(indiceDuracionCirugia==0){
                                        alert("Seleccione duraci\xF3n de operaci\xF3n");
                                        $("cboHorasEstimadasSolProgSOP").focus();
                                    }
                                    else{
                                        //Validar Cirujano Responsable
                                        var codPerCirujanoResponsable=trimJunny($("hdnCodPerCirujanoResponsable").value);
                                        if(codPerCirujanoResponsable==""){
                                            alert("Seleccione Cirujano Responsable");
                                            $("txtNomPerCirujanoResponsable").focus();
                                        }
                                        else{
                                            //Validar Cirujanos Ayudantes
                                            cadenaCodPerCirujanoAyudante=$("hdnCadenaCodPerCirujanoAyudante").value;
                                            arrayCodPerCirujanoAyudante=cadenaCodPerCirujanoAyudante.split("|");

                                            faltaIngresarCirujanoAyudante=0;
                                            patronNombreCirujanoAyudante="Ayudante ";
                                            patronIdHidden="hdnCodPerCirujanoAyudante";
                                            patronIdText="txtNomPerCirujanoAyudante";

                                            for(i=0; i<arrayCodPerCirujanoAyudante.length; i++){
                                                idNuevoHidden = patronIdHidden + "_" + arrayCodPerCirujanoAyudante[i];
                                                if($(idNuevoHidden).value=="" || $(idNuevoHidden).value==null){
                                                    faltaIngresarCirujanoAyudante=1;
                                                    indice=i;
                                                    break;
                                                }
                                            }

                                            if(faltaIngresarCirujanoAyudante==1){
                                                alert("Ingrese " + patronNombreCirujanoAyudante + arrayCodPerCirujanoAyudante[indice]);
                                                idTextFaltaCirujanoAyudante=patronIdText + "_" + arrayCodPerCirujanoAyudante[indice];
                                                $(idTextFaltaCirujanoAyudante).focus();
                                            }
                                            else{
                                                //Validar Hematocrito
                                                var valorHematocrito=$("txtValorHematocrito").value;
                                                if(valorHematocrito=="" || valorHematocrito==null){
                                                    alert("Ingrese valor de hematocrito");
                                                    $("txtValorHematocrito").focus();
                                                }
                                                else{
                                                    //Validar Hemoglobina
                                                    var valorHemoglobina=$("txtValorHemoglobina").value;
                                                    if(valorHemoglobina=="" || valorHemoglobina==null){
                                                        alert("Ingrese valor de hemoglobina");
                                                        $("txtValorHemoglobina").focus();
                                                    }
                                                    else{
                                                        //Solo falta validar observaciones que es opcional
                                                        //alert("Todo OK XD");
                                                        manteSolProgSOP(accion);
                                                    }
                                                }
                                                
                                            }
                                        }
                                    }

                                }
                            }
                        }
                    }
                }
            }
        }
    }
}


function manteSolProgSOP(accion){
    if(confirm("\xBFEst\xE1 seguro de generar la solicitud?")){
        var fechaPropuesta, arrayFechaPropuesta;
        var horaPropuesta;
        var codPerPaciente;
        var codCentroCosto;
        var numDxPreOperatorio, cadenaIdDxPreOperatorio;
        //var cirugiaPropuesta;
        var numCirugias, cadenaCodServicioCirugia, cadenaPorcServicioCirujia;

        var durCirugia;
        var codPerCirujanoResp;

        var numAyudantes, cadenaCodPerAyudante;

        var valorHematocrito;
        var valorHemoglobina;
        var observaciones;

        fechaPropuesta=trimJunny($('txtFechaPropuestaSolProgSOP').value);
        arrayFechaPropuesta=fechaPropuesta.split("/");
        fechaPropuesta=arrayFechaPropuesta[2]+arrayFechaPropuesta[1]+arrayFechaPropuesta[0];
        
        horaPropuesta=trimJunny($('cboHoraPropuestaSolProgSOP').value);
        codPerPaciente=trimJunny($('hdnCodPerPaciente').value);
        codCentroCosto=trimJunny($('cboCentroCostoSolProgSOP').value);

        numDxPreOperatorio=trimJunny($('hdnNroDxPreOperatorio').value);
        //////////////////cadenaIdDxPreOperatorio=trim($('hdnIdDxPreOperatorio').value);

        //cirugiaPropuesta=$('...').value;
        numCirugias=trimJunny($('hdnNroServicioCirugia').value);
        /////////////////cadenaCodServicioCirugia=trim($('hdnCodServicioCirugia').value);
        /////////////////cadenaPorcServicioCirujia=trim($('txtPorcServicioCirugia').value);

        durCirugia=trimJunny($('cboHorasEstimadasSolProgSOP').value);
        codPerCirujanoResp=trimJunny($('hdnCodPerCirujanoResponsable').value);

        numAyudantes=trimJunny($('hdnNroCirujanoAyudante').value);
        ////////////////cadenaCodPerAyudante=trim($('hdnCodPerCirujanoAyudante').value);

        valorHematocrito=trimJunny($('txtValorHematocrito').value);
        valorHemoglobina=trimJunny($('txtValorHemoglobina').value);
        observaciones=trimJunny($('txaObservaciones').value);

        //Concatenamos codigos de DxPreOperatorio
        cadena=$("hdnCadenaIdDxPreOperatorio").value;
        arrayIdDxPreOperatorio=cadena.split("|");
        patronIdHidden="hdnIdDxPreOperatorio";
        patronIdText="txtDescDxPreOperatorio";
        idText="";
        idHidden="";
        cadenaIdDxPreOperatorio="";
        for(i=0; i<arrayIdDxPreOperatorio.length; i++){
            idText = patronIdText + "_" + arrayIdDxPreOperatorio[i];
            if(trimJunny($(idText).value)!=""){
                idHidden = patronIdHidden + "_" + arrayIdDxPreOperatorio[i];
                cadenaIdDxPreOperatorio = cadenaIdDxPreOperatorio + $(idHidden).value+"|";
            }
        }
        cadenaIdDxPreOperatorio = cadenaIdDxPreOperatorio.substring(0,cadenaIdDxPreOperatorio.length-1);

        //Concatenamos codigos de Operacion
        cadena=$("hdnCadenaCodServicioCirugia").value;
        arrayCodServicioCirugia=cadena.split("|");
        patronIdHidden="hdnCodServicioCirugia";
        patronIdText="txtDescServicioCirugia";
        patronIdText2="txtPorcServicioCirugia";
        idText="";
        idHidden="";
        idText2="";
        cadenaCodServicioCirugia="";
        cadenaPorcServicioCirujia="";
        for(i=0; i<arrayCodServicioCirugia.length; i++){
            idText = patronIdText + "_" + arrayCodServicioCirugia[i];
            idText2 = patronIdText2 + "_" + arrayCodServicioCirugia[i];
            if(trimJunny($(idText).value)!="" && trimJunny($(idText2).value)!=""){
                idHidden = patronIdHidden + "_" + arrayCodServicioCirugia[i];
                cadenaCodServicioCirugia = cadenaCodServicioCirugia + $(idHidden).value+"|";
                cadenaPorcServicioCirujia = cadenaPorcServicioCirujia + $(idText2).value+"|";
            }
        }
        cadenaCodServicioCirugia = cadenaCodServicioCirugia.substring(0,cadenaCodServicioCirugia.length-1);
        cadenaPorcServicioCirujia = cadenaPorcServicioCirujia.substring(0,cadenaPorcServicioCirujia.length-1);

        //Concatenamos codigos de Personas de los Ayudantes
        cadena=$("hdnCadenaCodPerCirujanoAyudante").value;
        arrayCodPerCirujanoAyudante=cadena.split("|");
        patronIdHidden="hdnCodPerCirujanoAyudante";
        patronIdText="txtNomPerCirujanoAyudante";
        idText="";
        idHidden="";
        cadenaCodPerAyudante="";
        for(i=0; i<arrayCodPerCirujanoAyudante.length; i++){
            idText = patronIdText + "_" + arrayCodPerCirujanoAyudante[i];
            if(trimJunny($(idText).value)!=""){
                idHidden = patronIdHidden + "_" + arrayCodPerCirujanoAyudante[i];
                cadenaCodPerAyudante = cadenaCodPerAyudante + $(idHidden).value+"|";
            }
        }
        cadenaCodPerAyudante = cadenaCodPerAyudante.substring(0,cadenaCodPerAyudante.length-1);
        
        datos=fechaPropuesta+"|||"+horaPropuesta+"|||"+codPerPaciente+"|||"+codCentroCosto+"|||"+cadenaIdDxPreOperatorio+"|||"+
              cadenaCodServicioCirugia+"|||"+cadenaPorcServicioCirujia+"|||"+durCirugia+"|||"+codPerCirujanoResp+"|||"+cadenaCodPerAyudante+"|||"+
              valorHematocrito+"|||"+valorHemoglobina+"|||"+observaciones;

        //datos = datos.replace(/'/gi,"\'\'");
        datos = Base64.encode(datos);
        //accion='insertar';
        patronModulo='manteSolProgSOP';
        parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+datos;
        parametros+='&p3='+accion;
        
        new Ajax.Request( pathRequestControl,
                            {
                                method      : 'post',
                                parameters  : parametros,
                                onLoading   : function(transport){micargador(1);},
                                onComplete  : function(transport){
                                            micargador(0);
                                            respuesta = transport.responseText;
                                            alert(respuesta);
                                            regresarCronogramaProgramacionSOP();
                                            verSolicitudesPendientesSOP();
                                }
                            }
                        )
        
    }
}
/*******************************Fin Funciones PENDEX****************************/

