var pathRequestControl = "../../ccontrol/control/control.php";
var numEntrada=0;



function seleccionarTipoBusqueda(){
    $("txtFechaIni").value='';
    $("txtFechaFinal").value=''; 
    $("txtApPaterno").value='';
    $("txtApMaterno").value='';
    $("txtNombre").value='';
    $("cboPisos").value='0';
    $("cboTipoBusqueda").value='';
    obsion=$("cboTipoBusqueda").value
    if(obsion==0){
        $("trFechaFinal").hide(false); 
        $("trPersonal").hide(false);
        $("trcboPisos").hide(false); 
        $("trBotonFecha").hide(false); 
        $("trBotonPaciente").hide(false); 
        $("trBotonPisos").hide(false); 
        vtxtFechaIni='';
        vtxtFechaFinal=''; 
        vtxtApPaterno='';
        vtxtApMaterno='';
        vtxtNombre='';
        icboPisos='';
        form="";
        destino="div_reporteHospitalizacion";
        funcion="";
        parametros="p1=BuscarHospitalizacion&p2="+vtxtFechaIni+'&p3='+vtxtFechaFinal+'&p4='+vtxtApPaterno+'&p5='+
        vtxtApMaterno +'&p6='+ vtxtNombre +'&p7='+icboPisos ;
        enviarFormulario(form,parametros,funcion,destino); 
           
    }
    if(obsion==1){
        $("trFechaFinal").show();
        $("trPersonal").hide(false); 
        $("trcboPisos").hide(false); 
        $("trBotonFecha").show(); 
        $("trBotonPaciente").hide(false); 
        $("trBotonPisos").hide(false); 
    }
    if(obsion==2){
        $("trFechaFinal").hide(false); 
        $("trPersonal").show();
        $("trcboPisos").hide(false); 
        $("trBotonFecha").hide(false); 
        $("trBotonPaciente").show(); 
        $("trBotonPisos").hide(false); ; 
    }
    if(obsion==3){
        //$("trFechaFinal").hide(false); 
        $("trPersonal").hide(false);
        $("trcboPisos").show(); 
        $("trBotonFecha").hide(false); 
        $("trBotonPaciente").hide(false); 
        $("trBotonPisos").show() ; 
        $("trFechaFinal").show();

    }
    
}

function BuscarXfecha(){
    fechaInicio= $("txtFechaIni").value;
    fechaFinal=$("txtFechaFinal").value;
    //    alert(fechainicial + " "+ fechaFinal);
    form="";
    destino="";
    funcion="";
    parametros="p1=BuscarXfecha&p2="+fechaInicio+'&p3='+fechaFinal;
    enviarFormulario(form,parametros,funcion,destino);
    
}

function NuevoPaciente(){

    posFuncion = "";
    vtitle="";
    vformname='EtiquetaAtributo';
    vwidth='700';
    vheight='400';
    patronModulo='NuevoPaciente';
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
    parametros+='p1='+patronModulo;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

}


function nuevoPacienteHospitalizacion(){ //nuevoPacienteHospitalizacion


    posFuncion = "";
    vtitle="";
    vformname='EtiquetaAtributox';
    vwidth='900';
    vheight='600';
    patronModulo='nuevoPacienteHospitalizacion';
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
    parametros+='p1='+patronModulo;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

}    

function busquedaPaciente(){
     
    txtApePaternoPaciente=$("txtApePaternoPaciente").value;
    txtApeMaternoPaciente=$("txtApeMaternoPaciente").value;
    txtNombrePaciente=$("txtNombrePaciente").value;
   
    
    if(txtApePaternoPaciente!='' && txtApeMaternoPaciente!=''){
        parametros="p1=busquedaPaciente&p2="+txtApePaternoPaciente+'&p3='+txtApeMaternoPaciente+'&p4='+txtNombrePaciente;
        div="divTablaAreaPersona";
        funcionClick="EnviaDatosPersona";
        funcionDblClick="";
        funcionLoad="setColorTablaArea";
    }else{
        alert("PORFAVOR INGRESE LOS DOS APELLIDOS");
    }

    generarTablax(div,parametros,funcionClick,funcionDblClick,funcionLoad);
    
}

function BusquedaPacienteTeclado(opc,elemento,evento){
    if(evento==''){
        tecla=13;
    }
    else{
        tecla=evento.keyCode
    }
    if(tecla==13){
        txtApePaternoPaciente=$("txtApePaternoPaciente").value;
        txtApeMaternoPaciente=$("txtApeMaternoPaciente").value;
        txtNombrePaciente=$("txtNombrePaciente").value;
   
        if(txtApePaternoPaciente!='' && txtApeMaternoPaciente!=''){
            parametros="p1=busquedaPaciente&p2="+txtApePaternoPaciente+'&p3='+txtApeMaternoPaciente+'&p4='+txtNombrePaciente;
            div="divTablaAreaPersona";
            funcionClick="EnviaDatosPersona";
            funcionDblClick="";
            funcionLoad="setColorTablaArea";
        }else{
            alert("PORFAVOR INGRESE LOS DOS APELLIDOS");
        }
        generarTablax(div,parametros,funcionClick,funcionDblClick,funcionLoad);
    }
}

function EnviaDatosPersona(fil, col){
    $('tbaNuevoPaciente').show();
    $("txtfiliacion").value=mygridx.cells(fil,7).getValue();
    $("txtApellidos").value=mygridx.cells(fil,1).getValue()+'  '+mygridx.cells(fil,2).getValue();
    $("txtNombre").value=mygridx.cells(fil,3).getValue();   
    $("txtSexo").value=mygridx.cells(fil,5).getValue();
    $("txtEdad").value=mygridx.cells(fil,4).getValue();
    $("htxtCodigoPaciente").value=mygridx.cells(fil,8).getValue();
    $("htxtcIdAfiliacion").value=mygridx.cells(fil,6).getValue();
    
    $("htxtidCentroCosto").value=mygridx.cells(fil,13).getValue();
    $("txtDescripcionCentroCosto").value=mygridx.cells(fil,14).getValue();
    $("htxtAmbLogicoTratante").value=mygridx.cells(fil,11).getValue();
    
    Windows.close("Div_EtiquetaAtributox", '') ;
}

function busquedaMedicotratante(){
    posFuncion = "";
    vtitle="";
    vformname='EtiquetaAtributoMT';
    vwidth='700';
    vheight='350';
    patronModulo='busquedaMedicotratante';
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
    parametros+='p1='+patronModulo;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

}


function busquedaPersonaMedicoTratante(){
   
    txtApePaternoMedicoTratante=$("txtApePaternoMedicoTratante").value;
    txtApeMaternoMedicoTratante=$("txtApeMaternoMedicoTratante").value;
    txtNombreMedicoTratante=$("txtNombreMedicoTratante").value;

    parametros="p1=busquedaPersonaMedicoTratante&p2="+txtApePaternoMedicoTratante+'&p3='+txtApeMaternoMedicoTratante+'&p4='+txtNombreMedicoTratante;
    div="divTablaMedicoTratante";
    funcionClick="EnviarDatosMedicosTratante";
    funcionDblClick="";
    funcionLoad="setColorTablaArea";
    
    generarTablax(div,parametros,funcionClick,funcionDblClick,funcionLoad);  
}

function BusquedaTratanteTeclado(opc,elemento,evento){
    if(evento==''){
        tecla=13;
    }
    else{
        tecla=evento.keyCode
    }
    if(tecla==13){
        txtApePaternoMedicoTratante=$("txtApePaternoMedicoTratante").value;
        txtApeMaternoMedicoTratante=$("txtApeMaternoMedicoTratante").value;
        txtNombreMedicoTratante=$("txtNombreMedicoTratante").value;

        parametros="p1=busquedaPersonaMedicoTratante&p2="+txtApePaternoMedicoTratante+'&p3='+txtApeMaternoMedicoTratante+'&p4='+txtNombreMedicoTratante;
        div="divTablaMedicoTratante";
        funcionClick="EnviarDatosMedicosTratante";
        funcionDblClick="";
        funcionLoad="setColorTablaArea";
    
        generarTablax(div,parametros,funcionClick,funcionDblClick,funcionLoad);  
    }
}


function EnviarDatosMedicosTratante(fil, col){

    $("txtMedicotratante").value=mygridx.cells(fil,1).getValue()+'  '+mygridx.cells(fil,2).getValue()+' , '+mygridx.cells(fil,3).getValue();
    $("htxtiEmpleadoMedicoTratante").value=mygridx.cells(fil,4).getValue();
    // $("htxtidCentroCosto").value=mygridx.cells(fil,4).getValue();
    //$("txtDescripcionCentroCosto").value=mygridx.cells(fil,5).getValue();
    // $("htxtAmbLogicoTratante").value=mygridx.cells(fil,7).getValue();
    $("txtMedicoAlta").value=$("txtMedicotratante").value;
    $("htxtiEmpleadoMedicoAlta").value=$("htxtiEmpleadoMedicoTratante").value;
    $("htxtiAmbFisicoLogicoAlta").value= $("htxtAmbLogicoTratante").value;
    Windows.close("Div_EtiquetaAtributoMT", '');
}
function busquedaMedicoOrdInt(){
    posFuncion = "";
    vtitle="";
    vformname='EtiquetaAtributoMOI';
    vwidth='700';
    vheight='350';
    patronModulo='busquedaMedicoOrdInt';
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
    parametros+='p1='+patronModulo;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function busquedaPersonaMedicoOrdInt(){
   
    txtApePaternoMedicoOrdInt=$("txtApePaternoMedicoOrdInt").value;
    txtApeMaternoMedicoOrdInt=$("txtApeMaternoMedicoOrdInt").value;
    txtNombreMedicoOrdInt=$("txtNombreMedicoOrdInt").value;
    parametros="p1=busquedaPersonaMedicoOrdInt&p2="+txtApePaternoMedicoOrdInt+'&p3='+txtApeMaternoMedicoOrdInt+'&p4='+txtNombreMedicoOrdInt;
    div="divTablaMedicoOrdInt";
    funcionClick="EnviarDatosMedicosOrdInt";
    funcionDblClick="";
    funcionLoad="setColorTablaArea";
    
    generarTablax(div,parametros,funcionClick,funcionDblClick,funcionLoad);  
}

function BusquedaOrdIntTeclado(opc,elemento,evento){
    if(evento==''){
        tecla=13;
    }
    else{
        tecla=evento.keyCode
    }
    if(tecla==13){
        txtApePaternoMedicoOrdInt=$("txtApePaternoMedicoOrdInt").value;
        txtApeMaternoMedicoOrdInt=$("txtApeMaternoMedicoOrdInt").value;
        txtNombreMedicoOrdInt=$("txtNombreMedicoOrdInt").value;
        parametros="p1=busquedaPersonaMedicoOrdInt&p2="+txtApePaternoMedicoOrdInt+'&p3='+txtApeMaternoMedicoOrdInt+'&p4='+txtNombreMedicoOrdInt;
        div="divTablaMedicoOrdInt";
        funcionClick="EnviarDatosMedicosOrdInt";
        funcionDblClick="";
        funcionLoad="setColorTablaArea";
    
        generarTablax(div,parametros,funcionClick,funcionDblClick,funcionLoad);  
        
    }
}


function EnviarDatosMedicosOrdInt(fil, col){

    $("txtMedicoOrdInt").value=mygridx.cells(fil,1).getValue()+'  '+mygridx.cells(fil,2).getValue()+' , '+mygridx.cells(fil,3).getValue();
    $("htxtiEmpleadoMedicoOrdInt").value=mygridx.cells(fil,4).getValue();
    //  $("htxtAmbFisicoLogicoOrdInt").value=mygridx.cells(fil,7).getValue();
    
    Windows.close("Div_EtiquetaAtributoMOI", '');
}

function busquedaMedicoAlta(){
    posFuncion = "";
    vtitle="";
    vformname='EtiquetaAtributoMA';
    vwidth='700';
    vheight='350';
    patronModulo='busquedaMedicoAlta';
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
    parametros='p1='+patronModulo;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function busquedaPersonaMedicoAlta(){
   
    txtApePaternoMedicoAlta=$("txtApePaternoMedicoAlta").value;
    txtApeMaternoMedicoAlta=$("txtApeMaternoMedicoAlta").value;
    txtNombreMedicoAlta=$("txtNombreMedicoAlta").value;
    parametros="p1=busquedaPersonaMedicoAlta&p2="+txtApePaternoMedicoAlta+'&p3='+txtApeMaternoMedicoAlta+'&p4='+txtNombreMedicoAlta;
    div="divTablaMedicoAlta";
    funcionClick="EnviarDatosMedicosAlta";
    funcionDblClick="";
    funcionLoad="setColorTablaArea";
    
    generarTablax(div,parametros,funcionClick,funcionDblClick,funcionLoad);  
}

function BusquedaMedicoAltaTeclado(opc,elemento,evento){
    if(evento==''){
        tecla=13;
    }
    else{
        tecla=evento.keyCode
    }
    if(tecla==13){
        txtApePaternoMedicoAlta=$("txtApePaternoMedicoAlta").value;
        txtApeMaternoMedicoAlta=$("txtApeMaternoMedicoAlta").value;
        txtNombreMedicoAlta=$("txtNombreMedicoAlta").value;
        parametros="p1=busquedaPersonaMedicoAlta&p2="+txtApePaternoMedicoAlta+'&p3='+txtApeMaternoMedicoAlta+'&p4='+txtNombreMedicoAlta;
        div="divTablaMedicoAlta";
        funcionClick="EnviarDatosMedicosAlta";
        funcionDblClick="";
        funcionLoad="setColorTablaArea";
    
        generarTablax(div,parametros,funcionClick,funcionDblClick,funcionLoad);  
    }
}
function EnviarDatosMedicosAlta(fil, col){

    $("txtMedicoAlta").value=mygridx.cells(fil,1).getValue()+'  '+mygridx.cells(fil,2).getValue()+' , '+mygridx.cells(fil,3).getValue();
    $("htxtiEmpleadoMedicoAlta").value=mygridx.cells(fil,4).getValue();
    //$("htxtiAmbFisicoLogicoAlta").value=mygridx.cells(fil,7).getValue();
    
    Windows.close("Div_EtiquetaAtributoMA", '');
}

////////////////////////////////////////////////
///////////////////////////////////////////////
function cboAmbienteFisicox(){   
    npiso=$("cboPisosAmbiente").value;
    if(npiso!=''){
        form="";
        destino="div_cboAmbienteFisico";
        funcion="";
        parametros="p1=cboAmbienteFisico&p2="+npiso;
        enviarFormulario(form,parametros,funcion,destino);
    }
    
}
function cboCama(){
    idCodigoFisico=$("cboAmbienteFisico").value;
    if(idCodigoFisico!=''){
        form="";
        destino="div_cboCama";
        funcion="";
        parametros="p1=cboCama&p2="+idCodigoFisico;
        enviarFormulario(form,parametros,funcion,destino);
    }
}
function PacienteGuardarHospitalizacion(){
    txtCodigoPaciente=$("htxtCodigoPaciente").value;
    txtidCentroCosto=$("htxtidCentroCosto").value;
    
    txtiEmpleadoMedicoTratante=$("htxtiEmpleadoMedicoTratante").value;
    txtiEmpleadoMedicoOrdInt=$("htxtiEmpleadoMedicoOrdInt").value;
    txtiEmpleadoMedicoAlta=$("htxtiEmpleadoMedicoAlta").value;
    txtcIdAfiliacion=$("htxtcIdAfiliacion").value;
    txtAmbLogicoTratante=$("htxtAmbLogicoTratante").value;
    txtAmbFisicoLogicoOrdInt=$("htxtAmbFisicoLogicoOrdInt").value;
    txtiAmbFisicoLogicoAlta=$("htxtiAmbFisicoLogicoAlta").value;

    txtFechaIngreso=$("txtFechaIngreso").value +' '+$("txtHoraIngreso").value;
    cboAmbienteFisico=$("cboAmbienteFisico").value;
    cboCamat=$("cboCamaT").value;
    codigoDestino=$("comboDestinoP").value;
    //    iCodigoDiagnosticoEntrada =$("comboDiagnosticoEntrada").value;
    //    iCodigoDiagnosticoSalida= $("comboDiagnosticoSalida").value;   
    if(txtCodigoPaciente !=''){
        form="";
        destino="";
        funcion="Refrescar";
        parametros="p1=PacienteGuardarHospitalizacion&p2="+txtCodigoPaciente+'&p3='+txtidCentroCosto+'&p4='+txtiEmpleadoMedicoOrdInt+'&p5='+
        txtiEmpleadoMedicoTratante +'&p6='+ txtiEmpleadoMedicoAlta +'&p7='+txtcIdAfiliacion +'&p8='+cboCamat+'&p9='+cboAmbienteFisico+
        '&p10='+txtAmbLogicoTratante+'&p11='+txtFechaIngreso+'&p12='+ codigoDestino;//+'&p13='+ iCodigoDiagnosticoEntrada+'&p14='+ iCodigoDiagnosticoSalida;

        enviarFormulario(form,parametros,funcion,destino);   
    }else{
        alert("No ah Ingresado Nombre Paciente");
    }
   
}
function Refrescar(){
    vtxtFechaIni='';
    vtxtFechaFinal=''; 
    vtxtApPaterno='';
    vtxtApMaterno='';
    vtxtNombre='';
    icboPisos='';

    form="";
    destino="div_reporteHospitalizacion";
    funcion="";
    parametros="p1=BuscarHospitalizacion&p2="+vtxtFechaIni+'&p3='+vtxtFechaFinal+'&p4='+vtxtApPaterno+'&p5='+
    vtxtApMaterno +'&p6='+ vtxtNombre +'&p7='+icboPisos ;
    enviarFormulario(form,parametros,funcion,destino);   
}
function BuscarHospitalizacion(){
    
    vtxtFechaIni=$("txtFechaIni").value;
    vtxtFechaFinal=$("txtFechaFinal").value; 
    vtxtApPaterno=$("txtApPaterno").value;
    vtxtApMaterno=$("txtApMaterno").value;
    vtxtNombre=$("txtNombre").value;
    icboPisos=$("cboPisos").value;

    form="";
    destino="div_reporteHospitalizacion";
    funcion="";
    parametros="p1=BuscarHospitalizacion&p2="+vtxtFechaIni+'&p3='+vtxtFechaFinal+'&p4='+vtxtApPaterno+'&p5='+
    vtxtApMaterno +'&p6='+ vtxtNombre +'&p7='+icboPisos ;
    enviarFormulario(form,parametros,funcion,destino);   
}

function CargaCodigoDestino(){
    $("htxtiCodigoDestino").value=$("comboDestinoP").value;
//    alert($("htxtiCodigoDestino").value);
     
}


function BorrarHospitalizacion(fila){
    var tablax = $('tblHospitalizacion');
    codigoHospitalizacion =tablax.tBodies[0].rows[fila].cells[0].innerHTML; 
    form="";
    destino="";
    funcion="";
    parametros="p1=BorrarHospitalizacion&p2="+codigoHospitalizacion;
    enviarFormulario(form,parametros,funcion,destino);   
    mostrarHospitalizados();
}

function EditaHospitalizacion(fila){
    
    $("comboCama["+fila+"]").disabled=false;
    $("comboDestino["+fila+"]").disabled=false;
    $("Guardar["+fila+"]").show();
    $("Editar["+fila+"]").hide(false);
}
function GuardarHospitalizacion(fila){
    $("Guardar["+fila+"]").hide(false); 
    $("Editar["+fila+"]").show(); 
    $("comboCama["+fila+"]").disabled=true;
    $("comboDestino["+fila+"]").disabled=true;
    
    var tablax = $('tblHospitalizacion');
    codigoHospitalizacion =tablax.tBodies[0].rows[fila].cells[0].innerHTML; 
    codigoCama =$("comboCama["+fila+"]").value; 
    codigoDestino =$("comboDestino["+fila+"]").value;
    
    form="";
    destino="";
    funcion="";
    parametros="p1=GuardarHospitalizacion&p2="+codigoHospitalizacion+'&p3='+codigoCama+'&p4='+codigoDestino;
    enviarFormulario(form,parametros,funcion,destino);  
    
       
}

function VistaDetallePaciente(fila ){
    var tablax = $('tblHospitalizacion');
    codigoHospitalizacion =tablax.tBodies[0].rows[fila].cells[0].innerHTML; 
    
    codigoPaciente =tablax.tBodies[0].rows[fila].cells[20].innerHTML; 
    codigoPersona =tablax.tBodies[0].rows[fila].cells[19].innerHTML; 
    nombrePacienteCompleto =tablax.tBodies[0].rows[fila].cells[4].innerHTML; 
    edadPaciente =tablax.tBodies[0].rows[fila].cells[5].innerHTML;   
    sexoPaciente =tablax.tBodies[0].rows[fila].cells[18].innerHTML; 
    
    nombreMedicoTratante =tablax.tBodies[0].rows[fila].cells[6].innerHTML; 
    //  nombreMedicoOrdeInt =tablax.tBodies[0].rows[fila].cells[0].innerHTML; 
    nombreMedicoAlta =tablax.tBodies[0].rows[fila].cells[7].innerHTML; 
    
    nombreAmbienteFisco =tablax.tBodies[0].rows[fila].cells[8].innerHTML; 
    codigoAmbienteFisico =tablax.tBodies[0].rows[fila].cells[24].innerHTML; 
    codigoAmbLogico =tablax.tBodies[0].rows[fila].cells[10].innerHTML; 
    
    codigoCama= $("comboCama["+fila+"]").value;
    numeroCama=$("comboCama["+fila+"]").options[$("comboCama["+fila+"]").selectedIndex].text;
 
    codigoDestino =$("comboDestino["+fila+"]").value;
    descripcionDestino =$("comboDestino["+fila+"]").options[$("comboDestino["+fila+"]").selectedIndex].text;
    
    idDiagEntrada =tablax.tBodies[0].rows[fila].cells[21].innerHTML; 
    idDiagSalida =tablax.tBodies[0].rows[fila].cells[22].innerHTML; 
    horaIngreso =tablax.tBodies[0].rows[fila].cells[3].innerHTML; 
    fechaEntrada =tablax.tBodies[0].rows[fila].cells[1].innerHTML; 
    codigoHospitalizacionSiguiente =tablax.tBodies[0].rows[fila].cells[25].innerHTML; 
    //    alert(codigoHospitalizacionSiguiente);
    
    posFuncion = "";
    vtitle="";
    vformname='EtiquetaAtributoVP';
    vwidth='800';
    vheight='420';
    patronModulo='';//busquedaMedicoAlta';
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
    parametros="p1=VistaDetallePaciente&p2="+codigoHospitalizacion+'&p3='+codigoPaciente+'&p4='+codigoPersona +'&p5='+nombrePacienteCompleto
    +'&p6='+edadPaciente+'&p7='+sexoPaciente+'&p8='+nombreMedicoTratante+'&p9='+nombreMedicoAlta+'&p10='+nombreAmbienteFisco
    +'&p11='+codigoAmbienteFisico+'&p12='+codigoAmbLogico+'&p13='+codigoCama+'&p14='+numeroCama+'&p15='+codigoDestino+'&p16='+descripcionDestino
    +'&p17='+idDiagEntrada+'&p18='+idDiagSalida+'&p19='+horaIngreso+'&p20='+  fechaEntrada +'&p21='+  codigoHospitalizacionSiguiente;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
    
}
function TranferenciaDePaciente(){
    htxtCodigoPaciente=  $("htxtCodigoPaciente").value;
    htxtNombreCompleto= $("htxtNombreCompleto").value;
    htxtSexoPaciente=  $("htxtSexoPaciente").value;
    htxtEdadPaciente=$("htxtEdadPaciente").value;
    htxtCodigoHospitalizacion=$("htxtCodigoHospitalizacion").value;
    //  alert(htxtCodigoHospitalizacion);
    posFuncion = "";
    vtitle="";
    vformname='EtiqueTranferenciaDePaciente';
    vwidth='600';
    vheight='350';
    patronModulo='';//busquedaMedicoAlta';
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
    parametros="p1=TranferenciaDePaciente&p2="+htxtCodigoPaciente+'&p3='+htxtNombreCompleto+'&p4='+htxtSexoPaciente 
    +'&p5='+htxtEdadPaciente +'&p6='+htxtCodigoHospitalizacion;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);  
}

function guardarTransferenciaPaciente(){
    txtCodigoPaciente=$("htxtCodigoPaciente").value;
    txtidCentroCosto=$("htxtidCentroCosto").value;// falta
    
    txtiEmpleadoMedicoTratante=$("htxtiEmpleadoMedicoTratante").value;
    txtiEmpleadoMedicoOrdInt=$("htxtiEmpleadoMedicoOrdInt").value;
    txtiEmpleadoMedicoAlta=$("htxtiEmpleadoMedicoAlta").value;
    txtcIdAfiliacion=$("htxtcIdAfiliacion").value;
    txtAmbLogicoTratante=$("htxtAmbLogicoTratante").value;
    //    txtAmbFisicoLogicoOrdInt=$("htxtAmbFisicoLogicoOrdInt").value;
    //    txtiAmbFisicoLogicoAlta=$("htxtiAmbFisicoLogicoAlta").value;

    txtFechaIngreso=$("txtFechaIngreso").value +' '+$("txtHoraIngreso").value;
    cboAmbienteFisico=$("cboAmbienteFisico").value;
    cboCamat=$("cboCamaT").value;
    codigoDestino=$("comboDestinoP").value;
    anteriorCodigoHospitalizacion=$("htxtCodigoHospitalizacion").value;  
    //alert(anteriorCodigoHospitalizacion);

    if(txtCodigoPaciente !=''){
        form="";
        destino="";
        funcion="Refrescar";
        parametros="p1=guardarTransferenciaPaciente&p2="+txtCodigoPaciente+'&p3='+txtidCentroCosto+'&p4='+txtiEmpleadoMedicoOrdInt+'&p5='+
        txtiEmpleadoMedicoTratante +'&p6='+ txtiEmpleadoMedicoAlta +'&p7='+txtcIdAfiliacion +'&p8='+cboCamat+'&p9='+cboAmbienteFisico+
        '&p10='+txtAmbLogicoTratante+'&p11='+txtFechaIngreso+'&p12='+ codigoDestino+'&p13='+ anteriorCodigoHospitalizacion //+'&p14='+ iCodigoDiagnosticoSalida;

        enviarFormulario(form,parametros,funcion,destino);   
        Windows.close("Div_EtiqueTranferenciaDePaciente",''); 
    }else{
        alert("No ah Ingresado Nombre Paciente");
    }
   
}

function Cerrar(){
    Windows.close("Div_EtiquetaAtributox", '') ;
}

function cerrarTransferenciaPaciente(){
    Windows.close("Div_EtiqueTranferenciaDePaciente",''); 
}
function cerrarPaciente(){
    Windows.close("Div_EtiquetaAtributo", '') ;
}

function CerrarMedicoTratante(){
    Windows.close("Div_EtiquetaAtributoMT", '');
}
function CerrarMedicoOrdInt(){
    Windows.close("Div_EtiquetaAtributoMOI", '');
}

function CerrarMedicoAlta(){
    Windows.close("Div_EtiquetaAtributoMA", '');
}

function SalirReportePaciente(){
    Windows.close("Div_EtiquetaAtributoVP", '');
}


function ExpotarExcelHospitalizacion(){

    vtxtFechaIni=$("txtFechaIni").value;
    vtxtFechaFinal=$("txtFechaFinal").value; 
    vtxtApPaterno=$("txtApPaterno").value;
    vtxtApMaterno=$("txtApMaterno").value;
    vtxtNombre=$("txtNombre").value;
    icboPisos=$("cboPisos").value;

    var datos="p1=ExpotarExcelHospitalizacion&p2="+vtxtFechaIni+"&p3="+vtxtFechaFinal;
    datos+="&p4="+vtxtApPaterno+"&p5="+vtxtApMaterno+"&p6="+vtxtNombre+"&p7="+icboPisos;

    //-------------------------------
    location.href= pathRequestControl+'?'+datos;  
}

//function Prueba(opc,elemento,evento){
//    if(evento==''){
//        tecla=13;
//    }
//    else{
//        tecla=evento.keyCode
//    }
//    if(tecla==13){
//        alert("holaaa")
//    }
//}









//
//function busquedaMedicotratante(){
//    alert("busquedaMedicotratante");
//    txtApePaternoMedicoTratante=$("txtApePaternoMedicoTratante").value;
//    txtApeMaternoMedicoTratante=$("txtApeMaternoMedicoTratante").value;
//    txtNombreMedicoTratante=$("txtNombreMedicoTratante").value;
//    parametros="p1=busquedaPaciente&p2="+txtApePaternoMedicoTratante+'&p3='+txtApeMaternoMedicoTratante+'&p4='+txtNombreMedicoTratante;
//    div="divTablaMedicoTratante";
//    funcionClick="EnviaDatosPersona";
//    funcionDblClick="";
//    funcionLoad="setColorTablaArea";
//
//    generarTablax(div,parametros,funcionClick,funcionDblClick,funcionLoad);
//}