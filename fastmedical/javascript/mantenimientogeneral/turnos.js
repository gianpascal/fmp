
var url = '../../ccontrol/control/control.php';

//función empleada en las búsquedas
/*
function estadoCargador(estado){
    switch (estado){
        case 0:	{
            $('VentanaTransparente').setStyle({
                visibility:'hidden'
            });
            break;
        }
        case 1:{
            $('VentanaTransparente').setStyle({
                visibility:'visible'
            });
            break;
        }
    }
}
*/
function ltrim(s) {
    return s.replace(/^\s+/, "");
}

function rtrim(s) {
    return s.replace(/\s+$/, "");
}

function trim(s) {
    return rtrim(ltrim(s));
}

function actDescTurno(){
    indiceHoraInicio=$('horaInicioTurno').selectedIndex;
    indiceHoraFinal=$('horaFinalTurno').selectedIndex;

    if(indiceHoraInicio!=0 && indiceHoraFinal!=0){
        horaInicioTurno=$('horaInicioTurno').value;
        horaFinalTurno=$('horaFinalTurno').value;

        //Actualizamos descripcion de turno mostrado
        arrayHoraInicioTurno=horaInicioTurno.split(".");
        arrayHoraFinalTurno=horaFinalTurno.split(".");

        parteEnteraHoraInicioTurno=arrayHoraInicioTurno[0];
        parteDecimalHoraInicioTurno=arrayHoraInicioTurno[1];

        parteEnteraHoraFinalTurno=arrayHoraFinalTurno[0];
        parteDecimalHoraFinalTurno=arrayHoraFinalTurno[1];

        //Completamos ceros en la hora inicio
        if(parseFloat(parteEnteraHoraInicioTurno)<10){
            parteEnteraHoraInicioTurnoCadena="0"+parteEnteraHoraInicioTurno;
            if(parseFloat(parteDecimalHoraInicioTurno)<10){
                parteDecimalHoraInicioTurnoCadena="0"+parteDecimalHoraInicioTurno;
            }
            else{
                parteDecimalHoraInicioTurnoCadena=parteDecimalHoraInicioTurno;
            }
        }
        else{
            parteEnteraHoraInicioTurnoCadena=parteEnteraHoraInicioTurno;
            if(parseFloat(parteDecimalHoraInicioTurno)<10){
                parteDecimalHoraInicioTurnoCadena="0"+parteDecimalHoraInicioTurno;
            }
            else{
                parteDecimalHoraInicioTurnoCadena=parteDecimalHoraInicioTurno;
            }
        }
        //Completamos ceros en la hora final
        if(parseFloat(parteEnteraHoraFinalTurno)<10){
            parteEnteraHoraFinalTurnoCadena="0"+parteEnteraHoraFinalTurno;
            if(parseFloat(parteDecimalHoraFinalTurno)<10){
                parteDecimalHoraFinalTurnoCadena="0"+parteDecimalHoraFinalTurno;
            }
            else{
                parteDecimalHoraFinalTurnoCadena=parteDecimalHoraFinalTurno;
            }
        }
        else{
            parteEnteraHoraFinalTurnoCadena=parteEnteraHoraFinalTurno;
            if(parseFloat(parteDecimalHoraFinalTurno)<10){
                parteDecimalHoraFinalTurnoCadena="0"+parteDecimalHoraFinalTurno;
            }
            else{
                parteDecimalHoraFinalTurnoCadena=parteDecimalHoraFinalTurno;
            }
        }
        $('descTurno').value=parteEnteraHoraInicioTurnoCadena+":"+parteDecimalHoraInicioTurnoCadena+" - "+parteEnteraHoraFinalTurnoCadena+":"+parteDecimalHoraFinalTurnoCadena+" hs";

        if(parseFloat(horaFinalTurno)>parseFloat(horaInicioTurno)){
            totalHorasTurno=parseFloat(horaFinalTurno)-parseFloat(horaInicioTurno);
            totalHorasTurnoCadena=String(totalHorasTurno.toFixed(1));
            arrayTotalHorasTurno=totalHorasTurnoCadena.split(".");
            parteEntera=arrayTotalHorasTurno[0];
            parteDecimal=arrayTotalHorasTurno[1];
            if(parteDecimal==7 || parteDecimal==3){
                parteDecimal="50";
            }
            else{
                parteDecimal="00";
            }
            $('totalHorasTurno').value=parteEntera+"."+parteDecimal;
        }
        else{
            if(parseFloat(horaFinalTurno)<parseFloat(horaInicioTurno)){
                horasRestantesDia=parseFloat(24)-parseFloat(horaInicioTurno);
                horasSiguienteDia=horaFinalTurno;
                totalHorasTurno=parseFloat(horasRestantesDia)+parseFloat(horasSiguienteDia);
                totalHorasTurnoCadena=String(totalHorasTurno.toFixed(1));
                arrayTotalHorasTurno=totalHorasTurnoCadena.split(".");
                parteEntera=arrayTotalHorasTurno[0];
                parteDecimal=arrayTotalHorasTurno[1];

                if(parteDecimal==7 || parteDecimal==3){
                    parteDecimal="50";
                }
                else{
                    parteDecimal="00";
                }
                $('totalHorasTurno').value=parteEntera+"."+parteDecimal;
            }
            else{
                if(parseFloat(horaFinalTurno)==parseFloat(horaInicioTurno)){
                    alert("Seleccione horas distintas");
                    $('totalHorasTurno').value="0.00";
                }
            }
        }
    }
}

function validarManteTurno(){
    var accion = $("accion").value;
    //Validar seleccion hora inicio
    indiceHoraInicio=$('horaInicioTurno').selectedIndex;
    if(indiceHoraInicio==0){
        alert("Seleccione Hora Inicio");
    }
    else{
        //Validar seleccion hora final
        indiceHoraFinal=$('horaFinalTurno').selectedIndex;
        if(indiceHoraFinal==0){
            alert("Seleccione Hora Final");
            alert("Seleccione Hora Final");
        }
        else{
            //Validar que hora inicio y final sean diferentes
            horaInicioTurno=$('horaInicioTurno').value;
            horaFinalTurno=$('horaFinalTurno').value;
            if(parseFloat(horaFinalTurno)==parseFloat(horaInicioTurno)){
                alert("Seleccione horas distintas");
            }
            else{
                //Validar tipo de horario del turno
                indiceTipoHorarioTurno=$('tipoHorarioTurno').selectedIndex;
                if(indiceTipoHorarioTurno==0){
                    alert("Seleccione Tipo de Horario");
                }
                else{
                    manteTurno(accion);
                }
            }
        }
    }
}

function manteTurno(accion){
    codTurno=$('codTurno').value;
    descTurno=$('descTurno').value;
    horaInicioTurno=$('horaInicioTurno').value;
    horaFinalTurno=$('horaFinalTurno').value;
    totalHorasTurno=$('totalHorasTurno').value;
    tipoHorarioTurno=$('tipoHorarioTurno').value;
    nomenclatura=$('nomenclatura').value;//prueba

    datos=codTurno+"|"+descTurno+"|"+horaInicioTurno+"|"+horaFinalTurno+"|"+totalHorasTurno+"|"+tipoHorarioTurno+"|"+nomenclatura;
    //alert(datos);
    //datos = datos.replace(/'/gi,"\'\'");
    datos = Base64.encode(datos);

    data = 'p1=manteTurno&accion='+accion+'&datos='+datos;
    
    new Ajax.Request (url,
    {
        method      : 'post',
        parameters  : data,
        onLoading   : function(transport){
            estadoCargador(1);
        },
        onComplete  : function(transport){
            estadoCargador(0);
            //alert("mensajde de Ajax.Request")
            alert(transport.responseText);
            Windows.close("Div_Turnos");
            // refrescarTurno('');
            cargarTablaTurno();
        }
    }
    )
                         
}

function eliminarTurno(accion,codTurno){
    descTurno='';
    if(confirm("\xBFEst\xE1 seguro que desea eliminar el turno?")){
        data = 'p1=manteTurno&accion='+accion+'&codTurno='+codTurno;
        //alert(data);
        new Ajax.Request ( url,
        {
            method      : 'post',
            parameters  : data,
            onLoading   : function(transport){
                estadoCargador(1);
            },
            onComplete  : function(transport){
                estadoCargador(0);
                alert(transport.responseText);
                //  refrescarTurno(descTurno);
                cargarTablaTurno();                          
            }
        }
        )
    }
}
//Actualiza tabla de turnos mostrados
function refrescarTurno(descTurno){
    data = 'p1=listaTurno&p2='+descTurno;
    new Ajax.Request (url,
    {
        method      : 'post',
        parameters  : data,
        onLoading   : function(transport){
            estadoCargador(1);
        },
        onComplete  : function(transport){
            estadoCargador(0);
            $('contenido_detalle').innerHTML=transport.responseText;
        }
    }
    )
}

function presentacionTurnos(){
    tipoHorarioTurno=  $("tipoHorarioTurno").value
    //    alert(tipoHorarioTurno);
    form="";
    destino="divreporteDescripcion";
    funcion="";
    parametros="p1=presentacionTurnos&p2="+tipoHorarioTurno ;
    enviarFormulario(form,parametros,funcion,destino);  
}

function funcionPrueba(){
    
    prueba="holas";
    alert(prueba);
    
    
}


function cargarTablaTurno(){
    var   patronModulo='cargarTablaTurno';
    var descTurno = "%";
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+descTurno;
    arTablaTurno=new dhtmlXGridObject('contenido_detalle');
    arTablaTurno.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    arTablaTurno.setSkin("dhx_terrace");
    arTablaTurno.enableRowsHover(true,'grid_hover');
    arTablaTurno.attachEvent("onRowSelect", function(rowId,cellInd){
        if (cellInd==8){
            var IdTurno = arTablaTurno.cells(rowId,0).getValue();
            var eliminarAccion = "eliminar";
            eliminarTurno(eliminarAccion,IdTurno);
        } 
        else  if (cellInd==9){
            var IdTurno = arTablaTurno.cells(rowId,0).getValue();
            var Horario = arTablaTurno.cells(rowId,1).getValue();
            var HInicio = arTablaTurno.cells(rowId,2).getValue();
            var HFin = arTablaTurno.cells(rowId,3).getValue();
            var TotalH = arTablaTurno.cells(rowId,4).getValue();
            var Tipo = arTablaTurno.cells(rowId,5).getValue();
            var Nomenclatura = arTablaTurno.cells(rowId,6).getValue();
            $("var1").value=IdTurno;
            $("var2").value=Horario;
            $("var3").value=HInicio;
            $("var4").value=HFin;
            $("var5").value=TotalH;
            $("var6").value=Tipo;
            $("var7").value=Nomenclatura;
            var accion=1
            cargarPopadTurnosTabla(accion);
        }
    });
    contadorCargador++;
    var idCargador=contadorCargador;
    arTablaTurno.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    arTablaTurno.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    arTablaTurno.setSkin("dhx_skyblue");
    arTablaTurno.init();
    arTablaTurno.loadXML(pathRequestControl+'?'+parametros);
}


function cargarPopadTurnosTabla(accion){
    var posFuncion='';
    if (accion==1){
        posFuncion = "cargarDatosPopadTurno";
        $("accion").value='actualizar';
    }
    else {
        $("accion").value="insertar";
         posFuncion ='';
    }
    var vtitle='Turno';
    var vformname='Turnos';
    var vwidth='450';
    var vheight='400';   
    var patronModulo='cargarPopadTurnosTabla';
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
    this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion); 
}

function cargarDatosPopadTurno(){
    var IdTurno = $("var1").value;
    var Horario = $("var2").value;
    var HInicio = $("var3").value;
    var HFin = $("var4").value;
    var TotalH = $("var5").value;
    var Tipo = $("var6").value;
    var Nomenclatura = $("var7").value;
    path='../mantenimientogeneral/manteTurno.php';
    new Ajax.Request( path,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText; 
            var HoraInicio;
            
            if(HInicio.length==1){
                HoraInicio=HInicio+".0";
            }
            if(HInicio.length==2){
                HoraInicio=HInicio+".0";
            }
            if(HInicio.length==3){
                var SplitI=HInicio.split(".");
                HoraInicio=  SplitI[0]+"."+  SplitI[1]+"0";
            }
            if(HInicio.length==4){
                var SplitI=HInicio.split(".");
                HoraInicio=  SplitI[0]+"."+  SplitI[1]+"0";
            }
            var HoraFin;
            if(HFin.length==1){
                HoraFin=HFin+".0";
            }
             if(HFin.length==2){
                HoraFin=HFin+".0";
            }
            if(HFin.length==3){
                var SplitF=HFin.split(".");
                HoraFin=  SplitF[0]+"."+  SplitF[1]+"0";
            }
            if(HFin.length==4){
                var SplitF=HFin.split(".");
                HoraFin=  SplitF[0]+"."+  SplitF[1]+"0";
            }  
            $("codTurno").value=IdTurno;
            $("descTurno").value=Horario;
            $("totalHorasTurno").value=TotalH; 
            $("tipoHorarioTurno").value=Tipo;
            $("nomenclatura").value=Nomenclatura;
            $("horaInicioTurno").value=HoraInicio;
            $("horaFinalTurno").value=HoraFin;
            presentacionTurnos();
        }
    } )
    
}