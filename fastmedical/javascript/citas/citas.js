/* funciones citas javascript */
/* Leonidas Alagon Puma */
// INicio Funcion Reportes Graficos
var ventanasActivas = Array();
var pathRequestControl = "../../ccontrol/control/control.php";
function setDatosPersonas(objeto,evento,iid_persona){
    POO.Request({p1:'mostrar_datos_paciente_cita',p2:iid_persona},function(respuestajs){
        Windows.close("Div_formBuscadorPersonas");
        eval(respuestajs);
    });
    return;
}
function setDatosDerechoHabiente(objeto,evento,iid_persona){
    POO.Request({p1:'mostrar_datos_derecho_habiente',p2:iid_persona},function(respuestajs){
    Windows.close("Div_formBuscadorPersonas");
        eval(respuestajs);
    });
    return;
}
function setDatosContribuyente(objeto,evento,iid_persona){
    POO.Request({p1:'mostrar_datos_contribuyente',p2:iid_persona},function(respuestajs){
    Windows.close("Div_formBuscadorPersonas");
    eval(respuestajs);
    });
    return;
}
function mostrar_datos_paciente(objeto,evento,iid_persona){
    POO.Request({p1:'mostrar_datos_paciente',p2:iid_persona},function(respuestajs){
    Windows.close("Div_formBuscadorPersonas");
    eval(respuestajs);
    });
    return;
}
function verificarAfiliciacionPrecio(iid_persona){
    iidafiliacion = document.getElementById("hIdAfiliacion").value;
    idservicioproducto = document.getElementById("hIdServProd").value;
    pathLink = pathRequestControl+"?p1=verificarAfiliciacionPrecioCita&iidafiliacion="+iidafiliacion+"&idservicioproducto="+idservicioproducto;
    alert(pathLink);
    myajax.Link(pathLink);
    //    CargarVentana('formBuscadorPersonas','Buscar Personas','../../ccontrol/control/control.php?p1=form_buscador_personas&funcionJSEjecutar='+funcionJSEjecutar,'600','420',false,true,'',1,'',10,10,10,10);
}
function setDatosCitas(iid_cronograma){
    POO.Request({p1:'mostrar_datos_cronograma_cita',p2:iid_cronograma},function(respuestajs){
    eval(respuestajs);
    });
    return;
}
function setDatosEditarCitas(n_nro_prog,c_cod_per,n_prog_pac){
        POO.Request({p1:'mostrar_datos_editar_cita',p2:n_nro_prog,p3:c_cod_per,p4:n_prog_pac},function(respuestajs){
        eval(respuestajs);
	});
        return;
}

function setHoraServidor(){
        POO.Request({p1:'mostrar_hora_servidor'},function(respuestajs){
        eval(respuestajs);
	});
        return;
}

function guardar_cita(){
	var url = '../../ccontrol/control/control.php';
	var data = $('idGestionCita').serialize();
        //alert(data);
        //mantenimiento_persona
        var condicion = document.getElementById("hdIdNuevaoDetalle").value; //1 nueva cita, 2 detalle cita (lista de citas), 3 editar cita
        if(condicion=='1'){
            formulario = new Array('txtcodigocronograma','txtcodigopaciente','cb_horariopermitido');
            if(validablancos(formulario)){
            //if($F('trabajador') == '' || validablancos(rrhh)){
                if(window.confirm(" \xbfDesea guardar los datos? ")){
                new Ajax.Request ( url,
                        {method         : 'get',
                         parameters 	: 'p1=grabar_cita&'+data,
                         onLoading	: micargador(1),
                         onComplete	: function(transport){micargador(0);
                         $('Resp').update(transport.responseText);
                        }
                    }
                   )
                }
            }
            irDetalleCitas();
            LimpiarFormularioCita();
        }
        else{
            if(condicion=='3'){
                formulario = new Array('txtcodigocronograma','txtcodigopaciente','cb_horariopermitido');
                if(validablancos(formulario)){
                //if($F('trabajador') == '' || validablancos(rrhh)){
                    if(window.confirm(" \xbfDesea actualizar los datos? ")){
                    new Ajax.Request ( url,
                            {method         : 'get',
                             parameters 	: 'p1=editar_cita&'+data,
                             onLoading	: micargador(1),
                             onComplete	: function(transport){micargador(0);
                             $('Resp').update(transport.responseText);
                            }
                        }
                       )
                    }
                }
                irDetalleCitas();
                LimpiarFormularioCita();
            }
        }
}
function mostrarGrafico(){
    var fecha1, fecha2;
    opcion = document.getElementById("hiddenOpcionBusqueda").value;
    fecha1 = document.getElementById("txtFecha1").value;
    fecha2 = document.getElementById("txtFecha2").value;

    //alert(fecha1+ ":" + fecha2);
    http=getHttp();
    path="../reportes/citas/report_control.php";
    http.open("post",path,true);
    http.onreadystatechange = function() {
            if(http.readyState==1){
            }else if(http.readyState!=4){
            }else if(http.status==200){
                    resultado = http.responseText.split("|");
                    document.getElementById("divLeyenda1").innerHTML = resultado[0];
                    document.getElementById("divGraficoEstadistico1").innerHTML = resultado[1];
                    document.getElementById("divLeyenda2").innerHTML = resultado[2];
                    document.getElementById("divGraficoEstadistico2").innerHTML = resultado[3];
                    //document.getElementById("divGraficoEstadistico").innerHTML = http.responseText;
            }
    };
    http.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    parametros = "p1="+opcion+"&p2="+fecha1+"&p3="+fecha2;
    http.send(parametros);
}

function seleccionarOpcionBusCronograma(e){
		abuelo = e.parentNode.parentNode;
//		var padres = abuelo.childNodes;
		var padres = abuelo.getElementsByTagName("td");
		numElementos = padres.length;
//		alert(abuelo.getAttribute("id"));
		for(i=0;i<numElementos;i++){
			padres[i].className = "opc-a-boton";
			padres[i].style="";
			//alert(padres[i].className + " : " + numElementos);
		}
		this.setAttribute('style','background-color:#EEEEEE; border:1px solid #444444;color:#000000;');	
	}

function cargarCalendario(idAccion,cal){
    ajax = getHttp();
    arrayInput = document.getElementById(cal).getElementsByTagName("input");
    fechaActual = arrayInput[4].value+"/"+arrayInput[5].value+"/"+arrayInput[6].value;
    //}
    ajax.open("post","../../ccontrol/control//control.php",true);
    ajax.onreadystatechange = function(){
            if(ajax.readyState==1){
                    //alert("Enviandodododo");
            }else if(ajax.readyState!=4){
                    //alert("no funciona esta wada");
            }else if(ajax.status==200){
                    //document.getElementById("Calendario01").innerHTML = "";
                    //innerHTML = http.responseText
                    //alert("Hola si esta pasando x aki");
                    //document.getElementById(divContenedorCalendario).className=claseEstilo;
                    divContenedorCalendario = cal;
                    //document.getElementById(divContenedorCalendario).style.visibility = "visible";
                    document.getElementById(divContenedorCalendario).innerHTML = ajax.responseText;
            }
    };
    ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded')
    url = "p1=calendario&p2="+cal+"&p3="+fechaActual+"&p4="+idAccion
    ajax.send(url);
}
function clickoficinastree(id,nombrecentrocosto)
{
                  document.getElementById("hCentroCosto").value=id
                  fecha = document.getElementById('hFecha').value;
                  centrocosto = document.getElementById("hCentroCosto").value
                  nombrecentrocosto = "<font color=\"#00AA00\">Especialidad :   "+nombrecentrocosto + " </font>";
                  regresaracronogramacitas()
                  setCabeceraCronograma(fecha,centrocosto,nombrecentrocosto);

}
function cargar_tree_ccostos()
{
    //document.getElementById("hOpcionBusqueda").value=2;
    //document.getElementById("cb_filtro").selectedIndex = 0;
    //document.getElementById("cb_dato").selectedIndex = 0;
    //document.getElementById("cb_filtro").disable();
    //document.getElementById("cb_dato").disable();

    myDiv=document.getElementById('divBusCronogramaArbol');
    myDiv.innerHTML = " ";
    tree=new dhtmlXTreeObject("divBusCronogramaArbol","100%","100%",0);
    tree.setImagePath("../../../../medifacil_front/imagen/icono/tree/");
    tree.attachEvent("onClick", function(){
            clickoficinastree(tree.getSelectedItemId(),tree.getSelectedItemText());
            return true;
        })
    tree.loadXML("../../../javascript/xml/arbol_especialidades.xml");
    tree.openAllItems(0);
    

    
    
    //var respuestajs = ajax.responseText;
    //eval(respuestajs);
}


function seleccionarFechaCalendario(idElemento,cal){
	var dia;
	diaSel = idElemento.split("-")[1];
//	hiddenDia = document.getElementById(cal).getElementsByTagName("input")[4];
	arrayInput = document.getElementById(cal).getElementsByTagName("input");
	fechaActual = diaSel+"/"+arrayInput[5].value+"/"+arrayInput[6].value;
	if(cal=="cal01"){
		divCont = "divCal01";
		txtFecha = "txtFecha1";
	}else if(cal=="cal02"){
		txtFecha = "txtFecha2";
		divCont = "divCal02";
	}
	document.getElementById(divCont).style.visibility = "hidden";
	document.getElementById(txtFecha).value = fechaActual;
        
	/*
	dia = hiddenDia.value;
	if(diaSel != dia){
		nomIdDia = cal+"-" + dia;
		document.getElementById(nomIdDia).className = "btnCalendario";
			//alert("Este est el Numero de Dia Elegido: " + document.getElementById("cal01Dia").value);
		hiddenDia.value = diaSel;
		numIdDiaSel =  cal+"-" + diaSel;
		document.getElementById(numIdDiaSel).className = "estiloCasillaSeleccionada";
		
		arrayInput = document.getElementById(cal).getElementsByTagName("input");
		fechaActual = arrayInput[6].value+"-"+arrayInput[5].value+"-"+arrayInput[4].value;
	}*/
}
function getFechaSeleccionadaCalendarioDMY(idElemento,cal){
	diaSel = idElemento.split("-")[1];
//	hiddenDia = document.getElementById(cal).getElementsByTagName("input")[4];
	arrayInput = document.getElementById(cal).getElementsByTagName("input");
	fechaActual = diaSel+"/"+arrayInput[5].value+"/"+arrayInput[6].value;
	return fechaActual;
}

function ponerFecha(idElemento,cal){
	var dia;
	var fechaSeleccionada;
 	fechaSeleccionada = getFechaSeleccionadaCalendarioDMY(idElemento,cal);
	cajaTextocalendarioActiva.value=fechaSeleccionada;
	//Windows.close('Div_'+cal+'_popup', event);
	Windows.close("Div_"+cal);
}

function selOpcionGraficoCitas(opcion){
	document.getElementById("hiddenOpcionBusqueda").value = opcion;
}

/////// Fin Funciones Reportes Graficos




//Funciones para Citas
function listarCronograma(){
		opcionBusqueda = document.getElementById("hOpcionBusqueda").value;
		opcionFiltro = document.getElementById("hOpcionFiltro").value;
		fechadmY=document.getElementById("txtBusProgMedMesAnio").value.toString().split("/");
		fechaYmd=fechadmY[2] + "-" + fechadmY[1] + "-" +fechadmY[0] 
		document.getElementById("hFecha").value = fechaYmd
		fecha = fechaYmd;
		patron = document.getElementById("hPatron").value;
		pathLink = pathRequestControl+"?p1=cronograma_medico&opcionBusqueda="+opcionBusqueda+"&opcionFiltro="+ opcionFiltro+"&fecha=" + fecha+"&patron="+patron;
		//window.alert(pathLink);
		myajax.Link(pathLink,'divConsulCronograma');
	}

function selOpcionBusquedaProgMedicos(opcBusqueda,objeto,evento,escuchador){
	delete objTreeMenu_1;
        if(opcBusqueda==1){
            document.getElementById("cb_filtro").enable();
            document.getElementById("cb_dato").enable();
        }else{
            document.getElementById("cb_filtro").selectedIndex = 0;
            document.getElementById("cb_dato").selectedIndex = 0;
            document.getElementById("cb_filtro").disable();
            document.getElementById("cb_dato").disable();
        }
	opciones = Array("opcBusProgMedFecha","opcBusProgMedEspec","opcBusProgMedProfe");
//	opcNumber = for(i=0;i<=opciones.length;i++){ if() return}
	document.getElementById("hOpcionBusqueda").value = opcBusqueda;
        //divMostrar = "div_"+opcBusqueda;
	document.getElementById("divBusCronograma").innerHtml  = "";
	pathLink = pathRequestControl+"?p1=mostrarOpcionesBusquedaCitas&p2="+opcBusqueda;
	myajax.Link(pathLink,'divBusCronograma');
}

function cargarOficinas(ajax){
			document.getElementById("divContenedorArbol").style.visibility = "visible";
			var respuestajs = ajax.responseText;
			eval(respuestajs);
}
function errorCargarOficinas(ajax){
	document.getElementById("divContenedorArbol").style.visibility = "visible";
	var respuestajs = ajax.responseText;
	eval(respuestajs);
}

function retornarCodOficinaArbol(elementoActual,codOficina){
	document.getElementById("divContenedorArbol").style.visibility = "hidden";
	document.getElementById("txtBusProgMedEspecialidad").value = elementoActual.textContent;
	document.getElementById("hPatron").value =  elementoActual.textContent.split(":")[0].toString();
}
function setTxtFechaBus(fecha){
	document.getElementById("txtFechaTimeStamp").value = fecha;
}

function LimpiarFormularioCita(){

                document.getElementById("txtcodigopaciente").value="";
                document.getElementById("txtfiliacionactivapaciente").value="";
                document.getElementById("txtnombrespaciente").value="";
                document.getElementById("txtapellidopaternopaciente").value="";
                document.getElementById("txtapellidomaternopaciente").value="";
                document.getElementById("txtnumerodocumentopaciente").value="";
                document.getElementById("txtfechanacimientopaciente").value="";

                document.getElementById("txtcodigocronograma").value="";
                document.getElementById("txtnombreproductoservicio").value="";
                document.getElementById("txtnombreambiente").value="";
                document.getElementById("txtnombremedico").value="";
                document.getElementById("txtnombreespecialidad").value="";
                document.getElementById("txtturno").value="";
                document.getElementById("txtfechacita").value="";
                document.getElementById("hIdFormato").value = "";
                document.getElementById("hIdClas_Formato").value = "";
                document.getElementById("hIdAmbiente").value = "";
                document.getElementById("hIdCentroCosto").value = "";
                document.getElementById("hIdTurno").value = "";
                document.getElementById("hIdPersonalResponsable").value = "";
                document.getElementById("hIdEntidadPersonalResponsable").value = "";
                document.getElementById("txtcitas").value="";
                document.getElementById("txtreservas").value="";
                document.getElementById("txtcupos").value="";
                document.getElementById("cb_horariopermitido").selectedIndex = 0;




}
function LimpiarFormularioPaciente(){
                document.getElementById("txtcodigopaciente").value="";
                document.getElementById("txtfiliacionactivapaciente").value="";
                document.getElementById("txtnombrespaciente").value="";
                document.getElementById("txtapellidopaternopaciente").value="";
                document.getElementById("txtapellidomaternopaciente").value="";
                document.getElementById("txtnumerodocumentopaciente").value="";
                document.getElementById("txtfechanacimientopaciente").value="";
}


function onClickFila(event,html,clave){

                //1 nueva cita, 2 detalle cita (lista de citas), 3 editar cita
                condicion = document.getElementById("hdIdNuevaoDetalle").value;
                document.getElementById("hdIdCronograma").value=clave;
                document.getElementById("buscarpaciente").style.visibility = "visible";
                document.getElementById("txtfiliacionactivapaciente").setAttribute("readonly", true);
                document.getElementById("txtnombrespaciente").setAttribute("readonly", true);
                document.getElementById("txtapellidopaternopaciente").setAttribute("readonly", true);
                document.getElementById("txtapellidomaternopaciente").setAttribute("readonly", true);
                document.getElementById("txtnumerodocumentopaciente").setAttribute("readonly", true);
                document.getElementById("txtfechanacimientopaciente").setAttribute("readonly", true);

                setDatosCitas(clave);
                if(condicion == '1'){
                    pathLink2 = pathRequestControl + "?p1=programar_cita&p2=" + clave;
                    $('divCitaPaciente2').hide();
                    $('divCitaPaciente').show();
                    myajax2.Link(pathLink2,'divcombocita');
                }
                else{
                    if(condicion == '2'){
                        pathLink = pathRequestControl + "?p1=programacion_citas&p2=" + clave;
                        $('divCitaPaciente').hide();
                        $('divCitaPaciente2').show();
                        myajax.Link(pathLink,'divCitaPaciente2');
                        irDetalleCitas();
                    }
                    else{
                        //pathLink2 = pathRequestControl + "?p1=programar_cita&p2=" + clave;
                        $('divCitaPaciente2').hide();
                        $('divCitaPaciente').show();
                        //myajax2.Link(pathLink2,'divcombocita');
                    }
                }
}
function onClickFilaMedicos(event,html,clave){
                opcionBusqueda = document.getElementById("hOpcionBusqueda").value;
                patron=clave;
                document.getElementById('hPatron').value=patron;
                sede = document.getElementById('hIdFiltroSede').value;
                pathLink = pathRequestControl+"?p1=cronograma_medico&opcionBusqueda="+opcionBusqueda+"&sede="+sede+"&patron="+patron;
                myajax.Link(pathLink,'divConsulCronograma');
}
function onGrabarCita(ajax){
	var respuesta = ajax.responseText;
	if(parseInt(respuesta) ==0){
		delete(ajax);
		alert("CITA GENERADA CORRECTAMENTE");
		volverProgramacionCitas();
		return;
	}else{
		document.getElementById("respuesta_gestion_cita").innerHTML = respuesta;
	}
}
function irDetalleCitas(){
		var clave;
		clave = document.getElementById("hdIdCronograma").value;
                LimpiarFormularioPaciente();
                document.getElementById("hdIdNuevaoDetalle").value='2';
		pathLink = pathRequestControl + "?p1=programacion_citas&p2=" + clave;
		//window.alert(pathLink);
		//document.getElementById("hdIdCronograma").value=clave;
                $('divCitaPaciente').hide();
                $('divCitaPaciente2').show();
                myajax2.Link(pathLink,'divCitaPaciente2');
}

function onKeyPressEscucha(event,objeto){
	document.getElementById("hdIdCronograma").value = "";//Limpiar IdCronogramaSeleccionado
	code = event.KeyCode;
	if(event.keyCode == 13){
		pathLink = pathRequestControl+"?p1=cronograma_medico_fecha&p2=" + objeto.value;
		//window.alert(pathLink);
		myajax.Link(pathLink,'divConsulCronograma');
	}
}
function irnuevaCita(){
                document.getElementById("hdIdNuevaoDetalle").value='1';
                document.getElementById("btnSelAmbiente").style.visibility = "hidden";
                document.getElementById("buscarpaciente").style.visibility = "visible";
                LimpiarFormularioPaciente();
                document.getElementById("txtcodigocita").value="";
                document.getElementById("txtfechacita").value=document.getElementById('cal01').getElementsByTagName('input')[6].value+'-'+document.getElementById('cal01').getElementsByTagName('input')[5].value+'-'+document.getElementById('cal01').getElementsByTagName('input')[4].value;
                document.idGestionCita.grupotipocita[0].disabled=false;
                document.idGestionCita.grupotipocita[1].disabled=false;
                document.idGestionCita.grupotipocita[0].checked=true;
                document.getElementById("txtobservacioncita").removeAttribute("readonly");
                document.forms['idGestionCita'].elements['cb_horariopermitido'].disabled=false;
                //Mostramos componentes de Nueva Hora
                document.getElementById("tablacita").getElementsByTagName('tr')[4].getElementsByTagName('td')[0].style.display = "none";//ocultamos tag Nueva hora
                document.getElementById("txtnuevahora").style.visibility = "hidden";
                document.getElementById("txtnuevominutos").style.visibility = "hidden";
                document.getElementById("cb_meridiano").style.display = "none";
                //Mostramos combo de turnos
                var cosa = document.forms['idGestionCita'].elements['cb_horariopermitido'];
                cosa.options[0]= new Option("Seleccionar",0,0);

                var clave = document.getElementById("txtcodigocronograma").value;
                pathLink2 = pathRequestControl + "?p1=programar_cita&p2=" + clave;
                $('divCitaPaciente2').hide();
                $('divCitaPaciente').show();
                myajax2.Link(pathLink2,'divcombocita');
    		//myajax.Link('../cita/citas.php','Contenido');
}
//Para ir de la tabla al formulario de edicion de citas
function irEditarCita(n_nro_prog,c_cod_per,n_prog_pac){
                document.getElementById("hdIdNuevaoDetalle").value='3';
                $('divCitaPaciente2').hide();
                $('divCitaPaciente').show();
                
                document.getElementById("btnSelAmbiente").style.visibility = "visible";
                document.getElementById("btnEditarHora").style.visibility = "visible";
                document.getElementById("buscarpaciente").style.visibility = "hidden";
                //Ocultamos componentes de Nueva Hora
                document.getElementById("tablacita").getElementsByTagName('tr')[4].getElementsByTagName('td')[0].style.display = "block";//Mostramos tag Nueva hora
                /*document.getElementById("txtnuevahora").style.visibility = "visible";
                document.getElementById("txtnuevominutos").style.visibility = "visible";
                document.getElementById("cb_meridiano").style.display = "block";*/
                //document.getElementById("txtcodigopaciente").removeAttribute("readonly");
                //document.getElementById("txtfiliacionactivapaciente").removeAttribute("readonly");
                //document.getElementById("txtnombrespaciente").removeAttribute("readonly");
                //document.getElementById("txtapellidopaternopaciente").removeAttribute("readonly");
                //document.getElementById("txtapellidomaternopaciente").removeAttribute("readonly");
                //document.getElementById("txtnumerodocumentopaciente").removeAttribute("readonly");
                //document.getElementById("txtfechanacimientopaciente").removeAttribute("readonly");                

                setDatosEditarCitas(n_nro_prog,c_cod_per,n_prog_pac);
                //pathLink2 = pathRequestControl + "?p1=programar_cita&p2=" + n_nro_prog;
                //myajax2.Link(pathLink2,'divcombocita');

}

function editarObsCita(){
    document.getElementById("txtobservacioncita").removeAttribute("readonly");
}

function editarHora(){
    document.getElementById("txtnuevahora").style.visibility = "visible";
    document.getElementById("txtnuevominutos").style.visibility = "visible";
    document.getElementById("cb_meridiano").style.display = "block";
    setHoraServidor();
}

function ltrim(s) {
	return s.replace(/^\s+/, "");
}

function rtrim(s) {
	return s.replace(/\s+$/, "");
}

function trim(s) {
	return rtrim(ltrim(s));
}

//Esta función es para mostrar mensaje de confirmación cuando se quiere eliminar una cita
function irEliminarCita(n_prog_pac){
    if (confirm("\xbfDesea eliminar cita?")){
            iidcronograma = document.getElementById("hdIdCronograma").value;
            pathLink = pathRequestControl + "?p1=eliminar_cita&p2="+n_prog_pac;
            myajax.Link(pathLink);
            setDatosCitas(iidcronograma);
            irDetalleCitas();
    }
    else{
        alert("No se elimin\xf3 la cita");
    }
}

function validarPatronBusqueda(opcion,patron){
	
}

function buscar_filtro_sede(){
    opcionBusqueda = document.getElementById('hOpcionBusqueda').value;
    patron = '';
//    document.getElementById("cb_filtro").selectedIndex = 0;
//    document.getElementById("cb_dato").selectedIndex = 0;
//    document.getElementById("cb_dato").disable();
    var i
    switch(opcionBusqueda){
        case '1':
            patron = document.getElementById('cal01').getElementsByTagName('input')[6].value+document.getElementById('cal01').getElementsByTagName('input')[5].value+document.getElementById('cal01').getElementsByTagName('input')[4].value
            break;
        case '2':
            patron = document.getElementById('hPatron').value;
            break;
        case '3':
            patron = document.getElementById('hPatron').value;
            break;

    }
//    document.getElementById('hOpcionActividad').value = document.getElementById('cb_filtroActividad').value;
    document.getElementById('hOpcionSede').value = document.getElementById('cb_filtroSede').value;
    sede = document.getElementById('hOpcionSede').value;
//    myajax.Link('../../ccontrol/control/control.php?p1=busqueda_filtro_sede&opcionBusqueda='+opcionBusqueda+'&sede='+sede+'&patron='+patron,'divConsulCronograma');
}
function buscar_filtro_actividad(){
    opcionBusqueda = document.getElementById('hOpcionBusqueda').value;
    patron = '';
//    document.getElementById("cb_filtro").selectedIndex = 0;
//    document.getElementById("cb_dato").selectedIndex = 0;
//    document.getElementById("cb_dato").disable();
    var i
    switch(opcionBusqueda){
        case '1':
            patron = document.getElementById('cal01').getElementsByTagName('input')[6].value+document.getElementById('cal01').getElementsByTagName('input')[5].value+document.getElementById('cal01').getElementsByTagName('input')[4].value
            break;
        case '2':
            patron = document.getElementById('hPatron').value;
            break;
        case '3':
            patron = document.getElementById('hPatron').value;
            break;

    }
//    document.getElementById('hOpcionActividad').value = document.getElementById('cb_filtroActividad').value;
//    actividad = document.getElementById('cb_filtroActividad').value;
//    myajax.Link('../../ccontrol/control/control.php?p1=busqueda_filtro_sede&opcionBusqueda='+opcionBusqueda+'&sede='+sede+'&patron='+patron,'divConsulCronograma');


}

//function buscarPersonas(event,elementoHTML){
//    e = event;
//    patronModulo = document.getElementById("hBuscadorModulo").value;
//    opcion = document.getElementById("hOpcBusquedaPersona").value;
//    patron = elementoHTML.value;
//    if(e.keyCode == 13){
//            path=pathRequestControl+"?p1="+patronModulo+"&p2="+opcion+"&p3="+patron;
//            myajax.Link(path,'divResultadoBusquedaPersonas');
//    }
//}
function buscarPersonasHospital(funcionJSEjecutar){
    CargarVentana('formBuscadorPersonas','Buscar Personas',POO.pathRequestControl+'?p1=form_buscador_personas&funcionJSEjecutar='+funcionJSEjecutar,'600','400',false,true,'',1,'',10,10,10,10);
    //document.getElementById("txtPatronBusquedaPacientes").focus();
}
//Lista el resultado de una busqueda por nombre,codigo o dni.
function buscarPersonasHospitalListar(evento,obj){
    if(evento.keyCode == 13){
        //if($){alert($)}hFuncionJSEjecutar
        funcionJSEjecutar = $("hFuncionJSEjecutar").value;
        opcion = document.getElementById("hOpcBusquedaPersona").value;
        patron = obj.value;
        accion = 'buscar_personas_simedh';
        parametros = "p1="+accion+"&p2="+opcion+"&p3="+patron+"&funcionJSEjecutar="+funcionJSEjecutar;
        POO.Request(parametros,'divResultadoBusquedaPersonas');
    }
}
function buscarDatosContribuyenteListar(evento,obj){
    if(evento.keyCode == 13){
        funcionJSEjecutar = $("hFuncionJSEjecutar").value;
        opcion = document.getElementById("hOpcBusquedaPersona").value;
        patron = obj.value;
        accion = 'buscar_contribuyentes';
        parametros = "p1="+accion+"&p2="+opcion+"&p3="+patron+"&funcionJSEjecutar="+funcionJSEjecutar;
        POO.Request(parametros,'divResultadoBusquedaPersonas');
    }
}
function formateaOpcionBusqueda(opc){
    switch (opc){
            case 'nombre':{
                    textEtiqueta = "NOMBRE: ";
                    $('txtPatronBusquedaPacientes').className="textPatronNombre";
                    $('txtPatronBusquedaPacientes').value="Buscar...";
                    $('txtPatronBusquedaPacientes').focus();
                    $('hOpcBusquedaPersona').value=1;
                    break;
            }
            case 'documento':{
                    textEtiqueta = "DOCUMENTO: ";
                    document.getElementById("txtPatronBusquedaPacientes").className ="textPatronCodigo";
                    document.getElementById("txtPatronBusquedaPacientes").value ="Buscar...";
                    document.getElementById("hOpcBusquedaPersona").value = 2;
                    $('txtPatronBusquedaPacientes').focus();
                    break;
            }
            case 'codigo':{
                    textEtiqueta = "CODIGO: ";
                    document.getElementById("txtPatronBusquedaPacientes").className = "textPatronCodigo";
                    document.getElementById("txtPatronBusquedaPacientes").value ="Buscar...";
                    document.getElementById("hOpcBusquedaPersona").value = 3;
                    $('txtPatronBusquedaPacientes').focus();
                    break;
            }
    }
    document.getElementById("lblEtiquetaBusqueda").textContent = textEtiqueta;
}

function getPersonasBusquedaPersonas(event,elementoHTML){
    e = event;
    patronModulo = document.getElementById("hBuscadorModulo").value;
    opcion = document.getElementById("hOpcBusquedaPersona").value;
    patron = elementoHTML.value;
    //patronMOdulo=buscar_personas_admision;
    if(e.keyCode == 13 & patron.length>2){
        path="../../ccontrol/control/control.php?p1="+patronModulo+"&p2="+opcion+"&p3="+patron;
        myajax.Link(path,'divResultadoBusquedaPersonas');
    }
    else if(e.keyCode == 13 & patron.length<=2){
        alert('Lo siento!. La busqueda tiene que ser de al menos 3 caracteres.');
    }
}

function validaPersonasBusquedaPersona(event,elementoHTML){
    opcion =$('hOpcBusquedaPersona').value;
    opciontxt=opcion==1?'txt':'nro';
    patron = elementoHTML.value;
    if(!validFormSalt(opciontxt,patron,event,'txtPatronBusquedaPacientes')){
        patron2=patron.substr(0,patron.length-1);
        $('txtPatronBusquedaPacientes').value=patron2.toUpperCase();
    }
}

function validaPersonasBusqueda(event,elementoHTML){
    patron = elementoHTML.value;
    if(!validFormSalt(opciontxt,patron,event,'txtPatronBusquedaPacientes')){
        patron2=patron.substr(0,patron.length-1);
        $('txtPatronBusquedaPacientes').value=patron2.toUpperCase();
    }
}

function getBusquedaPersonalSalud(event,elementoHTML){
    e = event;
    //patronModulo = document.getElementById("hBuscadorModulo").value;
    opcion = document.getElementById("hOpcBusquedaPersona").value;
    patron1 = document.getElementById("textPatronAPaterno").value;//apellido paterno del medico
    patron2 = document.getElementById("textPatronAMaterno").value;//apellido materno del medico
    patron3 = document.getElementById("textPatronNombres").value;//nombres del medico
    path="../../ccontrol/control/control.php?p1=buscar_personal_salud&p2="+opcion+"&p3="+patron1+"&p4="+patron2+"&p5="+patron3;
    myajax.Link(path,'divResultadoBusquedaMedicos');
    
}

function getHttp(){
	var http;
	//http = new XMLHttpRequest();
	if(window.XMLHttpRequest){
		http = new XMLHttpRequest();
	}else if(window.ActiveXObject){
		http = new ActiveXObject("Microsoft.XMLHTTP");
	}else if(!http){
		http = new ActiveXObject("Msxml2.XMLHTTP");
	}
	return http;
}
function pintarDatosPacienteCitas($iid_persona,$afiliacion,$nombrepaciente,$apellidopaternopaciente,$apellidomaternopaciente,$ndocumento,$fechanacimiento,$id_afiliacion){
    document.getElementById("txtcodigopaciente").value=$iid_persona;
    document.getElementById("txtfiliacionactivapaciente").value=$afiliacion;
    document.getElementById("txtnombrespaciente").value=$nombrepaciente;
    document.getElementById("txtapellidopaternopaciente").value=$apellidopaternopaciente;
    document.getElementById("txtapellidomaternopaciente").value=$apellidomaternopaciente;
    document.getElementById("txtnumerodocumentopaciente").value=$ndocumento;
    document.getElementById("txtfechanacimientopaciente").value=$fechanacimiento;
    document.getElementById("hIdAfiliacion").value=$id_afiliacion;

    verificarAfiliciacionPrecio();
    
}
function pintarDatosCronogramaCitas($codigo_cronograma,$codigo_centro_costos,$codigo_ambiente,$ambiente,$codigo_persona_responsable,$medico,$especialidad,$codigo_profesional_empleado,$codigo_turno,$turno,$producto_servicios,$codigo_formato,$codigo_clas_formato,$citas,$reservas,$cupos,$codigoservprod){

    document.getElementById("txtcitas").value=$citas;
    document.getElementById("txtreservas").value=$reservas;
    document.getElementById("txtcupos").value=$cupos;
    document.getElementById("txtcodigocronograma").value=$codigo_cronograma;
    document.getElementById("txtnombreproductoservicio").value=$producto_servicios;
    document.getElementById("txtnombreambiente").value=$ambiente;
    document.getElementById("txtnombremedico").value=$medico;
    document.getElementById("txtnombreespecialidad").value=$especialidad;
    document.getElementById("txtturno").value=$turno;
    document.getElementById("txtfechacita").value = document.getElementById("hFecha").value
    document.getElementById("hIdServProd").value = $codigoservprod;
    document.getElementById("hIdFormato").value = $codigo_formato;
    document.getElementById("hIdClas_Formato").value = $codigo_clas_formato;
    document.getElementById("hIdAmbiente").value = $codigo_ambiente;
    document.getElementById("hIdCentroCosto").value = $codigo_centro_costos;
    document.getElementById("hIdTurno").value = $codigo_turno;
    document.getElementById("hIdPersonalResponsable").value = $codigo_persona_responsable;
    document.getElementById("hIdEntidadPersonalResponsable").value = $codigo_profesional_empleado;

}

function pintarDatosEditarCitas(citas,
                                reservas,
                                cupos,

                                codigo_cronograma,
                                producto_servicios,
                                ambiente,
                                medico,
                                especialidad,
                                turno,

                                codigo_paciente,
                                filiacion_activa,
                                nombres_paciente,
                                apepat_paciente,
                                apemat_paciente,
                                documento_paciente,
                                fecnac_paciente,
                                
                                codigo_cita,
                                fecha_cita,
                                tipo_cita,
                                desc_cita,
                                turno_cita){

    document.getElementById("txtcitas").value=citas;
    document.getElementById("txtreservas").value=reservas;
    document.getElementById("txtcupos").value=cupos;

    document.getElementById("txtcodigocronograma").value=codigo_cronograma;
    document.getElementById("txtnombreproductoservicio").value=producto_servicios;
    document.getElementById("txtnombreambiente").value=ambiente;
    document.getElementById("txtnombremedico").value=medico;
    document.getElementById("txtnombreespecialidad").value=especialidad;
    document.getElementById("txtturno").value=turno;

    document.getElementById("txtcodigopaciente").value=codigo_paciente;
    document.getElementById("txtfiliacionactivapaciente").value=filiacion_activa;
    document.getElementById("txtnombrespaciente").value=nombres_paciente;
    document.getElementById("txtapellidopaternopaciente").value=apepat_paciente;
    document.getElementById("txtapellidomaternopaciente").value=apemat_paciente;
    document.getElementById("txtnumerodocumentopaciente").value=documento_paciente;
    document.getElementById("txtfechanacimientopaciente").value=fecnac_paciente;

    document.getElementById("txtcodigocita").value=codigo_cita;
    document.getElementById("txtfechacita").value=fecha_cita;
    document.idGestionCita.grupotipocita[0].disabled=true;
    document.idGestionCita.grupotipocita[1].disabled=true;
    if(trim(tipo_cita.toUpperCase())=="CONSULTORIO")
        document.idGestionCita.grupotipocita[0].checked=true;
    else
        if(trim(tipo_cita.toUpperCase())=="PROCEDIMIENTO")
            document.idGestionCita.grupotipocita[1].checked=true;
        else
            alert("Error en lectura de tipo de cita");
    document.getElementById("txtobservacioncita").value=desc_cita;
    var cosa = document.forms['idGestionCita'].elements['cb_horariopermitido'];
    cosa.options[0]= new Option(turno_cita,0,0);
    document.forms['idGestionCita'].elements['cb_horariopermitido'].selectedIndex = 0;
    document.forms['idGestionCita'].elements['cb_horariopermitido'].disabled=true;
}

function pintarFechoraServidor(horas,minutos,meridiano){
    document.getElementById("txtnuevahora").value = horas;
    document.getElementById("txtnuevominutos").value = minutos;
    if(trim(meridiano.toUpperCase())=="AM")
        document.getElementById("cb_meridiano").selectedIndex = 0;
    else
        if(trim(meridiano.toUpperCase())=="PM")
            document.getElementById("cb_meridiano").selectedIndex = 1;
        else
            alert("Error en lectura de hora del servidor");
}

function pintarDatosPersonasDh($iid_persona,$afiliacion,$nombrepaciente,$apellidopaternopaciente,$apellidomaternopaciente,$ndocumento,$fechanacimiento){
    document.getElementById("dh_iid").value=$iid_persona;
    document.getElementById("dh_fil").value=$afiliacion;
    document.getElementById("dh_nom").value=$nombrepaciente;
    document.getElementById("dh_app").value=$apellidopaternopaciente;
    document.getElementById("dh_apm").value=$apellidomaternopaciente;
    document.getElementById("dh_dni").value=$ndocumento;
    document.getElementById("dh_dat").value=$fechanacimiento;//Tipo de parentesco
}
function pintarDatosPersonasAdmision(p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,p11,p12,p13,p14,p15,p16,p17,p18,p19,p20,p21,p22,p23,p24,p25){
	
myajax.Link('../admision/registro_personas.php?p_acc=up&p1='+p1+'&p2='+p2+'&p3='+p3+'&p4='+p4+'&p5='+p5+'&p6='+p6+'&p7='+p7+'&p8='+p8+'&p9='+p9+'&p10='+p10+'&p11='+p11+'&p12='+p12+'&p13='+p13+'&p14='+p14+'&p15='+p15+'&p16='+p16+'&p17='+p17+'&p18='+p18+'&p19='+p19+'&p20='+p20+'&p21='+p21+'&p22='+p22+'&p23='+p23+'&p24='+p24+'&p25='+p25, 'datos_persona');

}
function esconderBuscadorPersonas(){
	document.getElementById("txtPatronBusquedaPacientes").value = "";
	document.getElementById('divResultadoBusquedaPersonas').innerHTML = "";
	document.getElementById('divBusPersonas').className='divBusPersonasOculto';
	document.getElementById('divTotal').className='divTotalOculto'
}
function seleccionarFecha(idElemento,cal){
	var dia;
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
                sede = document.getElementById('hOpcionSede').value;
                patronBusqueda = document.getElementById('hPatronBusqueda').value;
                centrocosto = document.getElementById('hCentroCosto').value;
                setCabeceraCronograma(fecha,centrocosto);


	}
}



function accionCalendario(idAccion,cal){
	ajax = getHttp();
	arrayInput = document.getElementById(cal).getElementsByTagName("input");
	fechaActual = arrayInput[6].value+arrayInput[5].value+arrayInput[4].value;
        
	ajax.open("post",pathRequestControl,true);
	ajax.onreadystatechange = function(){
		if(ajax.readyState==1){
			//alert("Enviandodododo");
		}else if(ajax.readyState!=4){
			//alert("no funciona esta wada");
		}else if(ajax.status==200){
			//document.getElementById("Calendario01").innerHTML = "";
			//innerHTML = http.responseText
			//alert("Hola si esta pasando x aki");
                        var respuesta =  ajax.responseText.toString().split("|");
			document.getElementById("divBusCronograma").innerHTML = respuesta[0];
			//arrayInput = document.getElementById(cal).getElementsByTagName("input");
			//fecha = arrayInput[6].value+"-"+arrayInput[5].value+"-"+arrayInput[4].value;
			fecha = respuesta[1];
                        document.getElementById("hFecha").value=fecha;
                        while (fecha.toString().indexOf("-") != -1)
                              fecha = fecha.toString().replace("-","");
                        //if(document.getElementById(cal))
			opcionBusqueda = document.getElementById("hOpcionBusqueda").value;
                        patron = fecha;
                        sede = document.getElementById('hOpcionSede').value;
			//opcionFiltro = document.getElementById("hOpcionFiltro").value;
			//document.getElementById(txtcodigocronograma).innerHTML = "";
			//patron = '';
			//pathLink = pathRequestControl+"?p1=cronograma_medico&opcionBusqueda="+opcionBusqueda+"&opcionFiltro="+ opcionFiltro+"&fecha=" + fecha+"&patron="+patron;
                        pathLink = pathRequestControl+"?p1=cronograma_medico&opcionBusqueda="+opcionBusqueda+"&sede="+sede+"&patron="+patron;
                        //myajax.Link('../../ccontrol/control/control.php?p1=busqueda_filtro_sede&opcionBusqueda='+opcionBusqueda+'&sede='+sede+'&patron='+patron
                        //pathLink = pathRequestControl+"?p1=cronograma_medico_&p2=" + fechaActual;
                        pathLink2 = pathRequestControl + "?p1=programacion_citas&p2=-1&p3=true";

                        //1 nueva cita, 2 detalle cita (lista de citas), 3 editar cita
                        condicion = document.getElementById("hdIdNuevaoDetalle").value;
                        if(condicion == '1' || condicion=='2'){
                            myajax.Link(pathLink,'divConsulCronograma');
                            myajax2.Link(pathLink2,'divCitaPaciente2');
                            LimpiarFormularioCita();
                        }
                        else{
                            myajax.Link(pathLink,'divConsulCronograma');
                        }
		}
	};
	//limpiarCronogramaCitas();
        
	ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded')
	url = "p1=calendario01&p2="+fechaActual+"&p3="+idAccion
	ajax.send(url);
}

function seleccionarComboFiltroDato(cal){
//	limpiarCronogramaCitas();
        fecha=document.getElementById(cal).getElementsByTagName("input")[6].value+"-"+document.getElementById(cal).getElementsByTagName("input")[5].value+"-"+document.getElementById(cal).getElementsByTagName("input")[4].value;
        //alert(fecha);
        filtro = document.form_filtro.cb_filtro.value;
        document.getElementById('hFiltro').value = filtro;
        dato = document.form_filtro.cb_dato.value;
        document.getElementById('hDato').value = dato;
        sede = document.getElementById('hIdFiltroSede').value;
        pathLink = pathRequestControl+"?p1=cronograma_medico_filtro_dato&fecha="+fecha+"&filtro="+filtro+"&dato="+dato+"&sede="+sede;
        myajax.Link(pathLink,'divConsulCronograma');
}

function limpiarCronogramaCitas(){
	document.getElementById("hdIdCronograma").value = "";
	//document.getElementById("txtcodigocronograma").value = "";
}

//////////////////////////////////////////ORDENES LABORATORIO//////////////////////////////////////////////
function selFechOrdLab(idElemento,cal){ //Nueva Funcion de laboratorio
	var dia;
	diaSel = idElemento.split("-")[1];
	
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
		pathLink = pathRequestControl+"?p1=ordenes_lab&p2=" + fechaActual;
		myajax.Link(pathLink,'contenido_programacion');
	}
}
//////////////////////////////////////////FIN ORDENES LABORATORIO//////////////////////////////////////////

//////////////////////////////////////////DERECHO HABIENTE//////////////////////////////////////////////
function pintarDerechoHabiente(p1,p2,p3,p4,p5,p6){
    ii = $('numDerHab').value;
    a  = "codigo["+ii+"]";
    b  = "nombre["+ii+"]";
    $(a).value = p1;
    $(b).value = p3 + ' ' + p4 + ' ' +p2;

}
function cambiarInteractuarColor(e,idContenedor){
	colorAnt = "";
	colorNuevo = "";
	e.style = "";
}
function cerrarVentanaActiva(idVentanaActiva){
		if(idVentanaActiva=="divBusPersonas")
			document.getElementById(idVentanaActiva).className='divBusPersonasOculto';
		else 
			document.getElementById(idVentanaActiva).style.visibility = "hidden";
		document.getElementById('divTotal').className='divTotalOculto';
		if(ventanasActivas[idVentanaActiva]!="undefined" || ventanasActivas[idVentanaActiva]!=null || !isNaN(ventanasActivas["divBusPersonas"]) || ventanasActivas["divBusPersonas"]!=""){
				//alert(ventanasActivas[idVentanaActiva]);
				clearInterval(ventanasActivas[idVentanaActiva]);
				ventanasActivas["divBusPersonas"]="";
		}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////funcion para clase Tabla1  de Html1////////////////////////////////////////////////
function funDesel(tr, eFS){
	trs = tr.parentNode.getElementsByTagName('tr');
	n = trs.length;
	for (i = 0; i < n; i++){
		if (trs[i].className == eFS){
		eFAnterior=trs[i].parentNode.id.toString();
		onmouseout1 = "className='" + eFAnterior + "'";
		trs[i].setAttribute('onmouseout',onmouseout1);
		trs[i].className = eFAnterior;
		}
	}
}
function mostrarCelda(_this,_event){
	//alert(_this.nodeName);
	//Cuando se Da click sobre el textbox se ejecuta el evento del TD. El _this es el TD y el evento es del textbox. El ultimo event es del input;
	if(_event.type == "click" && _this.type != "text" && _this.nodeName == "TD" && _this.firstChild.nodeName != "input" &&  _event.target != '[object HTMLInputElement]'){
		//alert(_this.id +" : "+ _this.nodeName + " : "+ _event.layerX + " : "+ _event.X + " : " + _event.pageX + " : " + _event.screenX+ " : "+  _event.target + " : " + _event.type);
		cajaTexto = document.createElement("input");
		cajaTexto.setAttribute("type","text");
		cajaTexto.setAttribute("value",_this.textContent);
		_this.textContent = "";
		_this.appendChild(cajaTexto);
		cajaTexto.focus();
		//cajaTexto.attachEvent //ie
		//cajaTexto.addEventListener("blur","ocultarCelda");
		cajaTexto.setAttribute("onblur","ocultarCelda(this,event);");
		cajaTexto.size = "0";
		cajaTexto.setAttribute("onkeypress","if(event.keyCode==13) this.blur();");
		return;
	}
}
function ocultarCelda(_this,_event){
	if(_event.type == "blur"){
		valor = _this.value;
		td = _this.parentNode;
		if(_this.type == "text"){
			td.removeChild(td.firstChild);
			texto = document.createTextNode(valor);
			td.appendChild(texto);
		}
	}
}


//-----------


function prueba(){
    data = {rows: [{id: "8:45AM",data: ["100", "A Time to Kill", "John Grisham", "12.99", "1", "05/01/1998"]},{id: "8:15AM",data: ["1000", "Blood and Smoke", "Stephen King", "0", "1", "01/01/2000"]}]};
    
    
    mygrid = new dhtmlXGridObject('programacioncitas');
    //mygrid2 = new dhtmlXGridFromTable('');
    mygrid.setImagePath("codebase/imgs/");
    mygrid.setHeader("Hora,Lunes,#cspan,#cspan,Martes,Miercoles,Jueves,Viernes,S&aacute;bado,Domingo");
    //mygrid.attachHeader("&nbsp;,&nbsp;,&nbsp;,&nbsp;,&nbsp;,&nbsp;,&nbsp;,&nbsp;");
    mygrid.attachHeader(["#rspan","Title","LUIS","Author","#rspan","#rspan","#rspan","#rspan","#rspan","#rspan"])
    mygrid.setInitWidths("50,150,120,80,80,80,80,200");
    mygrid.setColAlign("center,center,center,center,center,center,center,center");
    mygrid.setColTypes("ed,ed,ed,price,ra,co,ra,ro");
    //mygrid.enableHeaderMenu();
    mygrid.getCombo(5).put(2, 2);
    mygrid.setColSorting("int,str,str,int,str,str,str,date"); //para ordenar
    mygrid.enableMultiline(true);
    mygrid.setEditable(!mygrid.isEditable); //Para no editar
    //mygrid.enableEditEvents(false, false, true);  // Edicion a un click, a doble click, y solo con F2
    //mygrid.enableCellIds();
    //mygrid.enableBlockSelection(); Para seleccionar para el clipboard
    mygrid.enableMarkedCells();
    //mygrid.
//mygrid.setHeader(hdrStr, splitSign, styles)
    //mygrid.enableRowspan();
    //mygrid.enableColSpan(true);
   
    //mygrid.enableLightMouseNavigation(true); //resalta la fila con solo pasar el mouse..no es necesario apretar.
    mygrid.getCheckedRows(6);
    mygrid.init();

    mygrid.setSkin("dhx_skyblue");
    mygrid.splitAt(1);
    mygrid.parse(data, "", "json");
    //mygrid.loadXML("../../../javascript/citas/grid.xml");
    
}
function mark() {
    filamarcada = new String(mygrid.getMarked());
    window.alert(""+filamarcada);
    mygrid.setCellExcellType(1097,3, "ro");
    array = filamarcada.split(",");
    filaID = array[0];
    columna = array[1];
    window.alert("ID : "+filaID+"index columna : "+columna);
    window.alert(mygrid.getColType(4));

    mygrid.addRow(123,"text1,text2,LUISALEJANDRO,400"); // para insertar una fila (id fila,texto,index(opcional))

    //mygrid.deleteSelectedRows(); // eliminar filas seleccionadas

    if(mygrid.doesRowExist(124))window.alert("Existe") //Para verificar la existencia de una fila con id = 124
    else window.alert("NOExiste");

    mygrid.selectRow(5, true, true, true);

    //mygrid.selectAll();

    window.alert("LUIS"+mygrid.getSelectedId());

    //mygrid.copyRowContent("6", "5");

    mygrid.setRowColor(1049,"#000000");


    window.alert(""+mygrid.cells(filaID,columna).getValue());
    //window.alert(""+mygrid.findCell("LUISALEJANDRO",2)); // busca la celda enviando el valor y la columna donde sera buscado; retorna un array con el idRow y indiceCOL

    //mygrid.deleteColumn(columna);

    //mygrid.setColspan(fila,columna, 2); //agrupa un dato de una celda dentro de las dos columnas

    //mygrid.setRowspan(4, columna, 2); //agrupa un dato de una celda dentro de dos filas

    mygrid.selectCell(mygrid.getRowIndex(filaID), columna, false, true, true, true);
    window.alert(""+mygrid.getSelectedCellIndex());
    


}
