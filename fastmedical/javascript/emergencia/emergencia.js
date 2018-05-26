
var pathRequestControl = "../../ccontrol/control/control.php";
var numEntrada=0;


function seleccionarFechaEmergencia(idElemento,cal){
    arrayInput = document.getElementById(cal).getElementsByTagName("input");
    fechaActual = arrayInput[6].value+arrayInput[5].value+arrayInput[4].value;
    hiddenDia = document.getElementById(cal).getElementsByTagName("input")[4];
    dia = hiddenDia.value;
    //////////////////////
    diaSel = idElemento.split("-")[1];
    var dia1;
    idfilaseleccionada = "";
    idcolumnaseleccionada="";

    //limpiarCronogramaCitas();
    hiddenDia = document.getElementById(cal).getElementsByTagName("input")[4];
    dia1 = hiddenDia.value;
    document.getElementById("hOpcionBusqueda").value=2;
    if(diaSel != dia1){
        nomIdDia = cal+"-" + dia1;
        document.getElementById(nomIdDia).className = "btnCalendario";
        hiddenDia.value = diaSel;
        numIdDiaSel =  cal+"-" + diaSel;
        document.getElementById(numIdDiaSel).className = "estiloCasillaSeleccionada";
        arrayInput = document.getElementById(cal).getElementsByTagName("input");
        fechaActual = arrayInput[6].value+"-"+arrayInput[5].value+"-"+arrayInput[4].value;
        document.getElementById('hFecha').value = arrayInput[6].value+"-"+arrayInput[5].value+"-"+arrayInput[4].value;
        opcionBusqueda = document.getElementById("hOpcionBusqueda").value;
        fecha = document.getElementById('hFecha').value;
        $("hOpcionSede").value = $("cb_filtroSede").value;
        sede = document.getElementById('hOpcionSede').value;
        patronBusqueda = document.getElementById('hPatronBusqueda').value;
        servicio = document.getElementById('hServicio').value;

        if(document.getElementById("hOpcionBusqueda").value != ""){
    //            regresaracronogramacitas();// estudiar este medoto
    }

    }
    ////////////////// 
    diaSel = idElemento.split("-")[1];
    fechaSeleccionada =diaSel +'/'+arrayInput[5].value+'/'+  arrayInput[6].value;
    
    idCentroCosto='';//$("cboEspecialidad").value;
    codigoDoctorPersona='';//$("cboDoctor").value;

    $("hCodigoDoctorPersona").value=codigoDoctorPersona;
    hcodigoDoctorper=$("hCodigoDoctorPersona").value;
    $("hCodigoCentroCosto").value=idCentroCosto;
    hidCentroCosto=$("hCodigoCentroCosto").value;
    
    $("hfechaSelecionada").value=fechaSeleccionada;
    $("hNombrePaciente").value=$("txtNombre").value;
    $("hApelledoPaterno").value=$("txtPaterno").value;
    $("hApelledoMaterno").value=$("txtMaterno").value;
    hApelledoPaterno=''//$("hApelledoPaterno").value;
    hApelledoMaterno='';
    hNombrePaciente='';
    form="";
    destino="divServiciosEmergencia";
    funcion="";
    parametros="p1=CargarDoctoXpaciente&p2="+fechaSeleccionada+'&p3='+idCentroCosto+'&p4='+codigoDoctorPersona
    +'&p5='+hcodigoDoctorper  +'&p6='+hidCentroCosto+'&p7='+hApelledoPaterno+'&p8='+hApelledoMaterno+'&p9='+hNombrePaciente;
    enviarFormulario(form,parametros,funcion,destino);
}

function LimpiarPersonaPaciente(){
 
    $("txtNombre").value='';
    $("txtPaterno").value='';
    $("txtMaterno").value='';
    
}

function EditarDetallePaciente(fila){
    CodigoProgramacion=$("idProgramacion["+fila+"]").value;
     
    var tablax = $('tblServicioEmergencia');
    nomPaciente = tablax.tBodies[0].rows[fila].cells[2].innerHTML;
    edad= tablax.tBodies[0].rows[fila].cells[3].innerHTML;
    sexo= tablax.tBodies[0].rows[fila].cells[4].innerHTML;
     codigoPaciente= tablax.tBodies[0].rows[fila].cells[29].innerHTML;
    // alert(codigoPaciente);
    if(sexo=='M'){
        sexo='Masculino';
    }else {
        sexo='Femenino';
    }
    Medico= tablax.tBodies[0].rows[fila].cells[5].innerHTML;
    codigocama=tablax.tBodies[0].rows[fila].cells[22].innerHTML;

    Diagnostico= tablax.tBodies[0].rows[fila].cells[8].innerHTML;
    destino=$("cboDestino["+fila+"]").options[$("cboDestino["+fila+"]").selectedIndex].text;//$("cboDestino["+fila+"]").value;
    dni = tablax.tBodies[0].rows[fila].cells[14].innerHTML;
    cod_per = tablax.tBodies[0].rows[fila].cells[15].innerHTML;
    CodigoCronograma = tablax.tBodies[0].rows[fila].cells[16].innerHTML;
    AmbienteFisico=$("cboAmbienteFisico["+fila+"]").options[$("cboAmbienteFisico["+fila+"]").selectedIndex].text;
    fechaEntrada = tablax.tBodies[0].rows[fila].cells[25].innerHTML;
    horaEntrada= fechaEntrada.substring(fechaEntrada.lastIndexOf("/")+1);
    fechaEntradax= fechaEntrada.substring(0,14);
    //alert(horaEntrada+'   '+fechaEntradax);
    posFuncion = "";
    vtitle="";
    vformname='Reporte_Paciente';
    vwidth='764';
    vheight='652';
    patronModulo='EditarDetallePaciente';
    vcenter='t';
    vresizable=''
    vmodal='false';
    vstyle='';
    vopacity='';
    veffect='';
    vposx1='';
    vposx2='';
    vposy1='';
    vposy2='';
    parametros='';
    parametros+='p1='+patronModulo+"&p2="+CodigoProgramacion+"&p3="+nomPaciente+"&p4="+edad
    +"&p5="+sexo+"&p6="+Medico+"&p7="+codigocama+"&p8="+Diagnostico+"&p9="+destino +"&p10="+dni
    +"&p11="+CodigoCronograma +"&p12="+cod_per+"&p13="+ AmbienteFisico+"&p14="+fechaEntradax
    +"&p15="+horaEntrada +"&p16="+ codigoPaciente;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

}

function SalirReportePaciente(){
    Windows.close("Div_Reporte_Paciente", '') 
    
}

function ActivarTexto(fila){
    CboDestino=$("cboDestino["+fila+"]").value;
    descDestino=$("cboDestino["+fila+"]").options[$("cboDestino["+fila+"]").selectedIndex].text;
    //  
    if(descDestino=="referido" || descDestino=="REFERIDO"){
        var tablax = $('tblServicioEmergencia');
        txtDescripcionDestino = tablax.tBodies[0].rows[fila].cells[28].innerHTML; 
        //alert(txtDescripcionDestino);
        $("txtDescDestino["+fila+"]").disabled=false;
        $("txtDescDestino["+fila+"]").value=txtDescripcionDestino;
        $("txtDescDestino["+fila+"]").focus();
        form="";
        destino="";
        funcion="";
        parametros="p1=ActivarTexto";
        enviarFormulario(form,parametros,funcion,destino);
        
    }else{
        $("txtDescDestino["+fila+"]").disabled=true;//  setAttribute("disabled", "false"); 
        $("txtDescDestino").value=$("txtDescDestino["+fila+"]").value;
        $("txtDescDestino["+fila+"]").value='';
              
    }
    
}


function GuardarnsdProgramacionPacientesEmergencia(fila){
 
    codigoCama=$("hCodigoCama["+fila+"]").value;
    if(codigoCama =='')
        codigoCama=-1;
    var tablax = $('tblServicioEmergencia');
    idProgramacionPacientesEmergencia = tablax.tBodies[0].rows[fila].cells[17].innerHTML; 
    idCama=$("cboCama["+fila+"]").value;
    idCboDestino=$("cboDestino["+fila+"]").value;
    txtDescDestino=$("txtDescDestino["+fila+"]").value;
    form="";
    destino="";
    funcion="";//funcionXXX("+num+",'"+cadena+"')
    parametros="p1=GuardarnsdProgramacionPacientesEmergencia&p2="+idProgramacionPacientesEmergencia
    +"&p3="+idCama+"&p4="+idCboDestino+"&p5="+txtDescDestino+"&p6="+fila +"&p7="+ codigoCama;
    enviarFormularioSincronizado(form,parametros,funcion,destino);
    $("cboCama["+fila+"]").disabled=true;
    $("cboAmbienteFisico["+fila+"]").disabled=true;
    $("txtDescDestino["+fila+"]").disabled=true;
    $("cboDestino["+fila+"]").disabled=true;
//$("cboCamap["+fila+"]").hide(true);
}

function ComboCama(fila){
    cboAmbienteFisicox=$("cboAmbienteFisico["+fila+"]").value;
    //alert(cboAmbienteFisicox);
    var tablax = $('tblServicioEmergencia');
    estadoCama = tablax.tBodies[0].rows[fila].cells[26].innerHTML; 
    // alert(estadoCama);
    form="";
    destino="divcboCama_"+fila;
    funcion="";
    parametros="p1=ComboCama&p2="+cboAmbienteFisicox+"&p3="+fila+"&p4="+ estadoCama;
    enviarFormulario(form,parametros,funcion,destino);
}


function EditaComboCamaAmbienteFisicoDestino(fila){
    
    
    descDestino=$("cboDestino["+fila+"]").options[$("cboDestino["+fila+"]").selectedIndex].text;

    if(descDestino=="referido" || descDestino=="REFERIDO"){
        $("txtDescDestino["+fila+"]").disabled=false;
    }
    $("cboCama["+fila+"]").disabled=false;
    $("cboAmbienteFisico["+fila+"]").disabled=false;
    $("cboDestino["+fila+"]").disabled=false;
    
    codigoCama='';
    
    codigoCama =$("cboCamap["+fila+"]").value;
    $("cboCamap["+fila+"]").hide(false);
    $("hCodigoCama["+fila+"]").value=codigoCama;
   
}

function cargarCboEspecialidad(){
    idCentroCosto=$("cboEspecialidad").value;
    //descDestino=$("cboDestino["+fila+"]").options[$("cboDestino["+fila+"]").selectedIndex].text;
    //    codigoCentroCosto =$("hCodigoCentroCosto").value;
    //codigoDoctorPersona=$("hCodigoDoctorPersona").value;
    fechaSeleccionada=$("hfechaSelecionada").value;
    codigoDoctorPersona=$("cboDoctor").value;
    
    $("hCodigoDoctorPersona").value=codigoDoctorPersona;
    hcodigoDoctorper=$("hCodigoDoctorPersona").value;
    
    $("hCodigoCentroCosto").value=idCentroCosto;
    hidCentroCosto=$("hCodigoCentroCosto").value;
    hApelledoPaterno='';//$("txtPaterno").value;
    hNombrePaciente='';//$("txtNombre").value;
    hApelledoMaterno='';//$("txtMaterno").value;
    form="";
    destino="divServiciosEmergencia";
    funcion="";
    parametros="p1=CargarDoctoXpaciente&p2="+fechaSeleccionada+'&p3='+idCentroCosto+'&p4='+codigoDoctorPersona
    +'&p5='+hcodigoDoctorper  +'&p6='+hidCentroCosto +'&p7='+hApelledoPaterno+'&p8='+hApelledoMaterno+'&p9='+hNombrePaciente;
    enviarFormulario(form,parametros,funcion,destino);

}

function BusquedaPersonaPaciente(){
    fechaSeleccionada=$("hfechaSelecionada").value;
    // alert (fechaSeleccionada);
    if(fechaSeleccionada==''){
        alert("Porfavor Seleccione la Fecha");
    }else{
        codigoDoctorPersona=$("cboDoctor").value;
        idCentroCosto=$("cboEspecialidad").value;
        $("hCodigoDoctorPersona").value=codigoDoctorPersona;
        hcodigoDoctorper=$("hCodigoDoctorPersona").value;
   
        $("hCodigoCentroCosto").value=idCentroCosto;
        hidCentroCosto=$("hCodigoCentroCosto").value;
        hApelledoPaterno=$("txtPaterno").value;
        hNombrePaciente=$("txtNombre").value;
        hApelledoMaterno=$("txtMaterno").value;
        //window.alert(hNombrePaciente);
        form="";
        destino="divServiciosEmergencia";
        funcion="";
        parametros="p1=CargarDoctoXpaciente&p2="+fechaSeleccionada+'&p3='+idCentroCosto+'&p4='+codigoDoctorPersona
        +'&p5='+hcodigoDoctorper +'&p6='+hidCentroCosto+'&p7='+hApelledoPaterno+'&p8='+hApelledoMaterno+'&p9='+hNombrePaciente;
        enviarFormulario(form,parametros,funcion,destino);
    }
}

function CargarCboDoctor(){
    idCentroCosto=$("cboEspecialidad").value;
    fechaSeleccionada=$("hfechaSelecionada").value;
    codigoDoctorPersona=$("cboDoctor").value;
    
    $("hCodigoDoctorPersona").value=codigoDoctorPersona;
    hcodigoDoctorper=$("hCodigoDoctorPersona").value;
    
    $("hCodigoCentroCosto").value=idCentroCosto;
    hidCentroCosto=$("hCodigoCentroCosto").value;
    hApelledoPaterno='';//$("txtPaterno").value;
    hNombrePaciente='';//$("txtNombre").value;
    hApelledoMaterno='';//$("txtMaterno").value;
    form="";
    destino="divServiciosEmergencia";
    funcion="";
    parametros="p1=CargarDoctoXpaciente&p2="+fechaSeleccionada+'&p3='+idCentroCosto+'&p4='+codigoDoctorPersona
    +'&p5='+hcodigoDoctorper  +'&p6='+hidCentroCosto+'&p7='+hApelledoPaterno+'&p8='+hApelledoMaterno+'&p9='+hNombrePaciente;
    enviarFormulario(form,parametros,funcion,destino);
}

function refrescarTablaPaciente(){
     
    idCentroCosto='';
    codigoDoctorPersona='';
    fechaSeleccionada=$("hfechaSelecionada").value;
    codigoDoctorPersona='';
    hcodigoDoctorper='';
    hidCentroCosto='';
    hApelledoPaterno='';//$
    hNombrePaciente='';
    hApelledoMaterno='';
    $("txtPaterno").value='';
    $("txtMaterno").value='';
    $("txtNombre").value='';
    
    form="";
    destino="divServiciosEmergencia";
    funcion="";
    parametros="p1=CargarDoctoXpaciente&p2="+fechaSeleccionada+'&p3='+idCentroCosto+'&p4='+codigoDoctorPersona
    +'&p5='+hcodigoDoctorper  +'&p6='+hidCentroCosto+'&p7='+hApelledoPaterno+'&p8='+hApelledoMaterno+'&p9='+hNombrePaciente;
    enviarFormulario(form,parametros,funcion,destino);
}
function accionCalendarioCitasInformesEmergencia(idAccion,cal){
    idfilaseleccionada = "";
    idcolumnaseleccionada="";
    arrayInput = document.getElementById(cal).getElementsByTagName("input");
    fechaActual = arrayInput[6].value+arrayInput[5].value+arrayInput[4].value;
    document.getElementById("hFecha").value=fechaActual;
    pathLink = "p1=calendario03&p2="+fechaActual+"&p3="+idAccion;
    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : pathLink,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText.split("|");
            fechaActual = respuesta[1];
            document.getElementById("hFecha").value=fechaActual;
            $('divBusCronograma').update(respuesta[0]);
            if(document.getElementById("hOpcionBusqueda").value != ""){
                regresaracronogramacitasx();
            }
        }
    })
}
function regresaracronogramacitasx(){
    $("hOpcionSede").value = $("cb_filtroSede").value;
    $('ReservaciondeCita').hide();
    $('CronogramaCompleto').show();
    $('divcronogramacitas').show();
    fecha = document.getElementById('hFecha').value;
    opcionBusqueda = document.getElementById("hOpcionBusqueda").value;
    servicio = document.getElementById("hServicio").value;
    nombrecentrocosto = document.getElementById("hNombreCentroCosto").value;
    codigoPersonalSalud = document.getElementById("hCodigoPersonalSalud").value;
    sede = document.getElementById("hOpcionSede").value;
    limpiarReservacion();
    limpiarDescripcionCita();
    if(guardadoexitoso==1){
        codigoProgramacion = $('hCodigoProgramacion').value;
        descripcionCita(idfilaseleccionada,idcolumnaseleccionada,codigoProgramacion);
        
    }
    setCabeceraCronograma(fecha,opcionBusqueda,servicio,nombrecentrocosto,codigoPersonalSalud,sede);
    micargador(0);
    $('divGuardaryRegresar').innerHTML="<a href=\"javascript:validarCitaInformes()\"><img src=\"../../../../fastmedical_front/imagen/btn/b_grabar__on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:regresaracronogramacitas()\"><img src=\"../../../../fastmedical_front/imagen/btn/b_regresar_on.gif\">";
    
}

function ReporteInicial(){
    //  fechaSeleccionada =diaSel +'/'+arrayInput[5].value+'/'+  arrayInput[6].value;
    fechaActual = new Date();
    fechaSeleccionada =fechaActual.getDate() +'/'+(fechaActual.getMonth()+1)+'/'+ fechaActual.getFullYear() ; 
    //alert(fechaSeleccionada);
    $("hfechaSelecionada").value=fechaSeleccionada;
    fechaSeleccionadax='';
    codigoDoctorPersona='';
    idCentroCosto='';
    hcodigoDoctorper='';
    hidCentroCosto='';
    hApelledoPaterno='';
    hNombrePaciente='';
    hApelledoMaterno='';
    form="";
    destino="divServiciosEmergencia";
    funcion="";
    parametros="p1=CargarDoctoXpaciente&p2="+fechaSeleccionadax+'&p3='+idCentroCosto+'&p4='+codigoDoctorPersona
    +'&p5='+hcodigoDoctorper +'&p6='+hidCentroCosto+'&p7='+hApelledoPaterno+'&p8='+hApelledoMaterno+'&p9='+hNombrePaciente;
    enviarFormulario(form,parametros,funcion,destino);
}


function EmergenciaXFecha(){
    fechaInicio=$("txtFechaIni").value;
    fechafinal=$("txtFechaFinal").value;

    form="";
    destino="divEmergenciaPaciente";
    funcion="";
    parametros="p1=EmergenciaXFecha&p2="+fechaInicio+'&p3='+fechafinal;
      enviarFormulario(form,parametros,funcion,destino);
    
}

function EmergenciaXFechaServicio(){
    fechaInicio=$("txtFechaIniServicio").value;
    fechafinal=$("txtFechaFinalServicio").value;
    form="";
    destino="divEmergenciaPacienteServicio";
    funcion="";
    parametros="p1=EmergenciaXFechaServicio&p2="+fechaInicio+'&p3='+fechafinal;
      enviarFormulario(form,parametros,funcion,destino);
    
}


function ExpotarExcelDiagnostico(){

  fechaInicio=$("txtFechaIniServicio").value;
    fechafinal=$("txtFechaFinalServicio").value;

    var datos="p1=ExpotarExcelDiagnostico&p2="+fechaInicio+"&p3="+fechafinal;
  
    //-------------------------------
    location.href= pathRequestControl+'?'+datos;  
}
////////////////////////////////////////////////
/////////////////////////////////////////////
////////////////////////////

//function cargarCboCategoria(){
//    idSucursal=$("cboSucursal").value;
//    form="";
//    destino="div_cbo_area";
//    funcion="";
//    parametros="p1=cargarCboCategoria&p2="+idSucursal;
//    enviarFormulario(form,parametros,funcion,destino);
//}



//function ObtenerPrimerTexto(){
//    //obtener el texto de la fila 1, columna 1
//    var tabla = document.getElementById('miTabla');
//    var texto = tabla.tBodies[0].rows[0].cells[0].innerHTML;
//    alert("Texto de la Columna 1, Fila 1: "+texto);
//}



function cargarCboMedico(){
    idSucursal=$("cboSucursal").value;
    window.alert(idSucursal);
//    form="";
//    destino="div_cbo_area";
//    funcion="";
//    parametros="p1=cargarCboArea&p2="+idSucursal;
//    enviarFormulario(form,parametros,funcion,destino);
}
    //function seleccionarFechaEmergencia(idElemento,cal){
    //    var dia;
    //    idfilaseleccionada = "";
    //    idcolumnaseleccionada="";
    //    diaSel = idElemento.split("-");
    //    //limpiarCronogramaCitas();
    //    hiddenDia = document.getElementById(cal).getElementsByTagName("input")[4];
    //    dia = hiddenDia.value;
    //    if(diaSel != dia){
    //        nomIdDia = cal+"-" + dia;
    //        document.getElementById(nomIdDia).className = "btnCalendario";
    //        hiddenDia.value = diaSel;
    //        numIdDiaSel =  cal+"-" + diaSel;
    //        document.getElementById(numIdDiaSel).className = "estiloCasillaSeleccionada";
    //        arrayInput = document.getElementById(cal).getElementsByTagName("input");
    //        fechaActual = arrayInput[6].value+"-"+arrayInput[5].value+"-"+arrayInput[4].value;
    //        document.getElementById('hFecha').value = arrayInput[6].value+"-"+arrayInput[5].value+"-"+arrayInput[4].value;
    //        opcionBusqueda = document.getElementById("hOpcionBusqueda").value;
    //        fecha = document.getElementById('hFecha').value;
    //        $("hOpcionSede").value = $("cb_filtroSede").value;
    //        sede = document.getElementById('hOpcionSede').value;
    //        patronBusqueda = document.getElementById('hPatronBusqueda').value;
    //        servicio = document.getElementById('hServicio').value;
    //
    //        if(document.getElementById("hOpcionBusqueda").value != ""){
    //            regresaracronogramacitas();
    //        }
    //
    //    }
    //}
    /*
     *function cargaCronogramaFecha(html,event,cadena){
    //Pasamos el valor 4 para la busqueda x Medico
    hiddenDia = document.getElementById('cal01').getElementsByTagName("input")[4];
    diaactual = hiddenDia.value;
    fecha = cadena.substring(0,10);
    //fecha = replaceAll(fecha,'.', '-');
    fecha=fecha.replace('.','-');
    fecha=fecha.replace('.','-');
    //window.alert(fecha);
    codigoPersonalSalud=cadena.substring(11,18);
    codigoCentroCostos=cadena.substring(19,29);
    dia='cal01-'+cadena.substring(8,10);
    
    tam=cadena.length;
    nombreMedico="<font color=\"#00AA00\">Medico : " + cadena.substring(30,tam)+"</font>"
    //window.alert(fecha+'***'+codigoPersonalSalud+'***'+codigoCentroCostos+'***'+nombreMedico+'***'+dia);
    
    document.getElementById("hOpcionBusqueda").value = "5";
    document.getElementById("hCodigoPersonalSalud").value = codigoPersonalSalud;
    document.getElementById("hServicio").value = codigoCentroCostos;
    document.getElementById("hNombreCentroCosto").value = nombreMedico;
    opcionBusqueda = document.getElementById("hOpcionBusqueda").value;
    document.getElementById('hFecha').value=fecha;
    seleccionarFechaCitasInformes(dia,'cal01');
    limpiarDescripcionCita();
    guardadoexitoso = 0;
    if(diaactual==cadena.substring(8,10))  regresaracronogramacitas();
}
     *
     *
     *
     *function seleccionarFechaCitasInformes(idElemento,cal){
    var dia;
    idfilaseleccionada = "";
    idcolumnaseleccionada="";
    diaSel = idElemento.split("-")[1];
    //limpiarCronogramaCitas();
    hiddenDia = document.getElementById(cal).getElementsByTagName("input")[4];
    dia = hiddenDia.value;
    if(diaSel != dia){
        nomIdDia = cal+"-" + dia;
        document.getElementById(nomIdDia).className = "btnCalendario";
        hiddenDia.value = diaSel;
        numIdDiaSel =  cal+"-" + diaSel;
        document.getElementById(numIdDiaSel).className = "estiloCasillaSeleccionada";
        arrayInput = document.getElementById(cal).getElementsByTagName("input");
        fechaActual = arrayInput[6].value+"-"+arrayInput[5].value+"-"+arrayInput[4].value;
        document.getElementById('hFecha').value = arrayInput[6].value+"-"+arrayInput[5].value+"-"+arrayInput[4].value;
        opcionBusqueda = document.getElementById("hOpcionBusqueda").value;
        fecha = document.getElementById('hFecha').value;
        $("hOpcionSede").value = $("cb_filtroSede").value;
        sede = document.getElementById('hOpcionSede').value;
        patronBusqueda = document.getElementById('hPatronBusqueda').value;
        servicio = document.getElementById('hServicio').value;

        if(document.getElementById("hOpcionBusqueda").value != ""){
            regresaracronogramacitas();
        }

    }
}
     **/
