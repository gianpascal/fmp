var mensaje = new String();

function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}
function enlace_programacion(radio,campo,dato)
{
	myRand = parseInt(Math.random()*999999999999999);		
	var valor
	valor=getCheckedValue(eval(radio))
	myajax.Link('hospitalizacion/programacion/inicio_cronograma.php?rand='+myRand+'&'+campo+'='+valor+'&tipo=2&dato='+dato, 'Contenido')
}

function retorna_cronograma(valor)
{
	myRand = parseInt(Math.random()*999999999999999);		
	myajax.Link('hospitalizacion/programacion/inicio_programacion.php?rand='+myRand,'Contenido');	
	myajax2.Link('hospitalizacion/programacion/crea_grid.php?tipo=2&buscar='+valor, 'contenido_programacion')	
}


function foco_campo(nombre)
{	
	if(document.getElementById(nombre)==null || document.getElementById(nombre).value=='cargando')
	{			
		setTimeout("foco_campo('"+nombre+"')",200);
		return false;
	}
	document.getElementById(nombre).focus();	
}


function carga_busqueda_hospi(var1,parametro,alto,ancho)
{
var key = teclapresionada ? var1.which : var1.keyCode;
	if(key==45 || var1==13) 
	{			
		//alert("titulo="+titulo+"&funcionjava="+funcionjava+"&archivophp="+archivophp+"&opcion="+opcion+'&'+parametro);		
		jsabrirventana("hospitalizacion/busqueda/buscar.php?"+parametro, '','no', 'no', 'no', 'no', 'no', 'yes', 'no', ancho, alto, 'no');		
	}
}

function jsabrirventana(direccion, nombre,pantallacompleta, herramientas, direcciones, estado, barramenu, barrascroll, cambiatamano, ancho, alto, sustituir){ 
    var izquierda = (screen.availWidth - ancho) / 2; 
    var arriba = (screen.availHeight - alto) / 2; 
    var opciones = "fullscreen=" + pantallacompleta + 
                 ",toolbar=" + herramientas + 
                 ",location=" + direcciones + 
                 ",status=" + estado + 
                 ",menubar=" + barramenu + 
                 ",scrollbars=" + barrascroll + 
                 ",resizable=" + cambiatamano + 
                 ",width=" + ancho + 
                 ",height=" + alto + 
                 ",left=" + izquierda + 
                 ",top=" + arriba; 
    var ventana = window.open(direccion,nombre,opciones,sustituir); 
}      

function refresca_padre(id,login,tipo) 
{	  
	switch(tipo)
	{
		case 1:
				document.getElementById("login_usuario").value=login;	
			 	document.getElementById("id_persona").value=id;		  
				document.getElementById("login_usuario").focus();
		break;
		case 2:
				document.getElementById("sol_tra").value=id;	
		break;	
		case 3:
				document.getElementById("apr_tra").value=id;	
		break;	
		case 4:
				document.getElementById("oficina").value=login;
				document.getElementById("cod_oficina").value=id;
				document.getElementById("oficina").focus();
		break;	
		case 5:															
				document.getElementById("nemonico").value=login.substr(0,login.length-4);	
				document.getElementById("cod_nemonico").value=id;
				document.getElementById("nemonico").focus();
				document.getElementById("ano_eje").value=login.substr(-4);
		break;	
		case 6:
				document.getElementById("nombre_usuario").value=login;	
			 	document.getElementById("nro_doc_identidad").value=id;		  
				document.getElementById("nombre_usuario").focus();
		break;
		case 7:
				document.getElementById("dni").value=id;	
		break;	
		case 8:															
				document.getElementById("dato").value=login;
				document.getElementById("dato").focus();
		break;	
		case 9:
				document.getElementById("formulario").value=login;
				document.getElementById("id_formulario").value=id;
				document.getElementById("formulario").focus();
		break;	
		case 10:
				document.getElementById("dato").value=login;
				myajax.Link('hospitalizacion/laboratorio/resultados/mante_buscar.php?tipo=busca_analisis&paciente='+id, 'contenido_programacion');
				
		break;	
	}	  
}

function enlace_hospital(evt,NombreFormulario,Raiz,vParam,mydiv) 	//REGULARIZAR BIENES Y SERVICIOS
{
	var key = teclapresionada ? evt.which : evt.keyCode;
	if(key==13 || evt==13)
	{
		myRand = parseInt(Math.random()*999999999999999);			
		myajax.Link(Raiz+NombreFormulario + '?rand=' + myRand + '&' + vParam , mydiv);	
	}
}

function enlace_regulariza(radio1,radio2,campo1,campo2,busca_ant,combo_tipo_ant,busca,combo_tipo,combo_grupo,combo_clase,combo_familia)		//REGULARIZAR BIENES Y SERVICIOS
{	
	myRand = parseInt(Math.random()*999999999999999);		
	var valor1
	var valor2
	valor1=getCheckedValue(eval(radio1))
	valor2=getCheckedValue(eval(radio2))

	if(valor1=='' && valor2=='')
	{
		alert('Debe seleccionar los Items a validar');
	}
	else
	{
		if(valor1!='' && valor2!='')
		{
			myajax.Link('maestros/regularizar_catalogo/mante_det_bienes.php?rand='+myRand+'&'+campo1+'='+valor1+'&'+campo2+'='+valor2+'&tipo=2&opcion=5&accion=RM', 'mantenimiento')	
			myajax2.Link('maestros/regularizar_catalogo/busqueda_catalogo_simedh.php?rand='+myRand+'&tipo_bienant='+combo_tipo_ant+'&tipo_bus=0&TxtCampoBusAnt='+busca_ant, 'contenido_grid_ant')	
			myajax3.Link('maestros/regularizar_catalogo/busqueda_catalogo.php?rand='+myRand+'&TxtCampoBus='+busca+'&tipo_bien='+combo_tipo+'&grupo_bien='+combo_grupo+'&clase_bien='+combo_clase+'&familia_bien='+combo_familia+'&tipo_bus=0', 'BuscaCatalogo')				
		}
		else
		{
			if(valor2!='')
			{
				if (confirm('�Desea regularizar el item individualmente?'))
				{
					myajax.Link('maestros/regularizar_catalogo/mante_det_bienes.php?rand='+myRand+'&'+campo1+'='+valor1+'&'+campo2+'='+valor2+'&tipo=2&opcion=5&accion=RMN', 'mantenimiento')	
					myajax2.Link('maestros/regularizar_catalogo/busqueda_catalogo_simedh.php?rand='+myRand+'&tipo_bienant='+combo_tipo_ant+'&tipo_bus=0&TxtCampoBusAnt='+busca_ant, 'contenido_grid_ant')	
					myajax3.Link('maestros/regularizar_catalogo/busqueda_catalogo.php?rand='+myRand+'&TxtCampoBus='+busca+'&tipo_bien='+combo_tipo+'&grupo_bien='+combo_grupo+'&clase_bien='+combo_clase+'&familia_bien='+combo_familia+'&tipo_bus=0', 'BuscaCatalogo')	
				}
			}
		}
	}
}

function realizar_busqueda(evt,NombreFormulario,Raiz) 
{
	var key = teclapresionada ? evt.which : evt.keyCode;
	if(key==13 || evt==13)
	{
		if(document.getElementById('pagina')!=null) document.getElementById('pagina').value=1;		
	
	if(document.getElementById("VENTANA")!=null)
	{
			if(document.getElementById("Raiz").value==document.getElementById("RaizAnt").value)
				myajax.Link(Raiz+'Listado_'+NombreFormulario+'.php?'+myajax.DataForm($(NombreFormulario)), 'Contenido');
			else
				myajax.Link(Raiz+'ListadoGeneral.php?'+myajax.DataForm($(NombreFormulario)), 'Contenido');			
	}
	else
		switch(NombreFormulario)
		{		
			case 'Bienes':	
				myajax.Link('maestros/regularizar_catalogo/busqueda_catalogo.php?TxtCampoBus='+document.getElementById('TxtCampoBus').value+'&ordenarpor='+document.getElementById('ordenarpor').value+'&tipoorden='+document.getElementById('tipoorden').value, 'BuscaCatalogo')
			break;		
		}
	}
	else
		return key;

}

function AgregarCatalogo_Regulariza(cod_tipo,cod_grupo,cod_clase,cod_familia,descripcion,unidad){
	myRand = parseInt(Math.random()*999999999999999);
	myajax.Link('maestros/regularizar_catalogo/mante_det_bienes.php?tipo_bien='+cod_tipo+'&grupo_bien='+cod_grupo+'&clase_bien='+cod_clase+'&familia_bien='+cod_familia+'&des_ite='+encodeURIComponent(descripcion)+'&und_med='+unidad+'&opcion=4&accion=RI&rand='+myRand, 'mantenimiento_nuevo');
}

function valida_cronograma(fecha_actual)
{	
	if(document.getElementById('cmb_oficina').selectedIndex==0)	alert('Seleccione una Oficina');
	else	
		if(document.getElementById('cmb_actividad').selectedIndex==0) alert('Seleccione una Actividad');
		else
			if(document.getElementById('cmb_producto').selectedIndex==0) alert('Seleccione un Producto');
			else
				if(document.getElementById('cmb_ambiente').selectedIndex==0)	alert('Seleccione un Ambiente');
				else
					if(document.getElementById('cmb_turno').selectedIndex==0) alert('Seleccione un Turno');
					else
					{	
						var datos = new String();
						var band=1;	//Indica si las fechas son correctas
						fecha_registro = document.getElementById('cal_valores').value;
						if(fecha_registro=='' || fecha_registro=='|')
						{
							document.getElementById('mensaje_crono').style.color='#FF0000';	
							document.getElementById('mensaje_crono').value='Ingrese la fecha a Programar';	
						}
						else
						{
							fecha_registro=fecha_registro.split("|");	
														
							for(var i=0;i<fecha_registro.length;i++)
							{
								if(fecha_registro[i]!='')
								{
									//Verifica si la fecha a evaluar es mayor que la fecha actual	
									if( comparar_fechas(fecha_actual,fecha_registro[i],null,null) )
									{																														
										band=0;	
										var j=i;
									}			
								}
							}
							
							if(band==0)		
							{								
								document.getElementById('mensaje_crono').value='No es posible programar fechas anteriores a '+fecha_actual;
								document.getElementById('mensaje_crono').style.color='#FF0000';	
							}
							else
							{	
								document.getElementById('mensaje_crono').style.color='#000000';	
								document.getElementById('mensaje_crono').value='Se regristaron los datos en el Cronograma';																							
								myajax.Run('../programacion/existe_cronograma.php?oficina='+document.getElementById('cmb_oficina').value+'&actividad='+document.getElementById('cmb_actividad').value+'&producto='+document.getElementById('cmb_producto').value+'&ambiente='+document.getElementById('cmb_ambiente').value+'&turno='+document.getElementById('cmb_turno').value+'&iid_persona='+document.getElementById('iid_persona').value+'&cal_valores='+document.getElementById('cal_valores').value+'&vid_cronograma_ant='+document.getElementById('vid_cronograma_ant').value+'&bloqueo_cal='+document.getElementById('cal_bloqueo').value);	
								
							}
						}
					}
}

function miFuncion(datos) {
 alert('- ' + datos.join('\n- '));
 $('main').innerHTML = '- ' + datos.join('<br>- ');
}


///////MANTENIMIENTO TURNOS --> ACTUALIZAR -->SU PAPI WVALERIANO
function mantenimiento_turnos() {
	if(confirm('confirme accion ')) 
	{
	id=document.getElementById('id').value;
	inicio=document.getElementById('inicio').value;
	fin=document.getElementById('fin').value;

	param="accion=actualiza&id="+id+"&inicio="+inicio+"&fin="+fin;
	myajax.Link('hospitalizacion/walter/mantenimiento.php?'+param,'resultado');

	comprobar_mantenimiento_turno();

	}
}

function comprobar_mantenimiento_turno()
{
	if(document.getElementById('result')==null)
	{
		setTimeout('comprobar_mantenimiento_turno()',1000);
	}
	if(document.getElementById('result').value!='ok')
	{
		setTimeout('comprobar_mantenimiento_turno()',1000);
	}
	else
		myajax.Link('hospitalizacion/walter/prueba.php','general');
	
}


///////MANTENIMIENTO TURNOS --> INSERTAR -->SU PAPI WVALERIANO

function mantenimiento_turnos() {
	if(confirm('confirme accion ')) 
	{
	inicio=document.getElementById('inicio').value;
	fin=document.getElementById('fin').value;
	param="accion=insertar&inicio="+inicio+"&fin="+fin;
	myajax.Link('hospitalizacion/walter/mantenimiento.php?'+param,'resultado');

	comprobar_mantenimiento_turno();

	}
}

function comprobar_mantenimiento_turno()
{
	if(document.getElementById('insert')==null)
	{
		setTimeout('comprobar_mantenimiento_turno()',1000);
	}
	if(document.getElementById('insert').value!='ok')
	{
		setTimeout('comprobar_mantenimiento_turno()',1000);
	}
	else
		myajax.Link('hospitalizacion/walter/prueba.php','general');
	
}
