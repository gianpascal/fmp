function listaCronogramaPrincipal(){
	persona = document.getElementById('persona').value;
	mes_actual = document.form_cronograma.meses.value;
	ano_actual = document.form_cronograma.anos.value;
	oficina = document.getElementById('oficina').value;
	myajax.Link('../../ccontrol/control/control.php?p1=cro_listado_cronograma&persona='+persona+'&lista_mes=1&busca_fechas=0&mes_actual='+mes_actual+'&ano_actual='+ano_actual+'&oficina='+oficina,'grid_cronograma');
}
function listaCronogramaOficina(voficina){
	document.getElementById('oficina').value = voficina;
	persona = document.getElementById('persona').value;
	meses = document.getElementById('meses').value;
	anos = document.getElementById('anos').value;
	myajax.Link('../../ccontrol/control/control.php?p1=cro_listado_cronograma&oficina='+voficina+'&persona='+persona+'&lista_mes=1&mes_actual='+meses+'&ano_actual='+anos,'grid_cronograma');
}
function listaComboOficina(){
	actividad =  document.form_cronograma.cmb_actividad.value;
	oficina = document.form_cronograma.cmb_oficina.value;
	myajax.Link('../../ccontrol/control/control.php?p1=cro_seleccion_producto&actividad='+actividad+'&add_funcion=1&oficina='+oficina,'combo_producto'); 
	myajax2.Link('../../ccontrol/control/control.php?p1=cro_seleccion_ambiente&actividad='+actividad+'&add_funcion=1&oficina='+oficina,'combo_ambiente');	
}
function listaComboActividad(){
	actividad =  document.form_cronograma.cmb_actividad.value;
	oficina = document.form_cronograma.cmb_oficina.value;
	myajax.Link('../../ccontrol/control/control.php?p1=cro_seleccion_producto&actividad='+actividad+'&add_funcion=1&oficina='+oficina,'combo_producto');
	myajax2.Link('../../ccontrol/control/control.php?p1=cro_seleccion_ambiente&actividad='+actividad+'&add_funcion=1&oficina='+oficina,'combo_ambiente')
}
function listaComboProducto(){
	actividad =  document.form_cronograma.cmb_actividad.value;
	oficina = document.form_cronograma.cmb_oficina.value;
	persona = document.getElementById('persona').value;
	meses = document.getElementById('meses').value;
	anos = document.getElementById('anos').value;
	myajax.Link('../../ccontrol/control/control.php?p1=cro_seleccion_cronograma_principal&iid_persona='+persona+'&lista_mes=1&busca_fechas=0&mes_actual='+meses+'&ano_actual='+anos,'grid_cronograma');
}
function mostrarCalendario(oficina,actividad,producto,ambiente,turno,dia,mes,ano,valores,bloqueo_dias,vid_cronograma_ant){
	myajax.Link('../../ccontrol/control/control.php?p1=cro_formulario_cronograma_registro&oficina='+oficina+'&actividad='+actividad+'&producto='+producto+'&ambiente='+ambiente+'&turno='+turno+'&cal_dia='+dia+'&cal_mes='+mes+'&cal_ano='+ano+'&cal_valores='+valores+'&bloqueo_dias='+bloqueo_dias,'detalle_cronograma');
	document.getElementById('vid_cronograma_ant').value = vid_cronograma_ant;
}
function cancelaCalendario(vid_cronograma,fecha){
	if(confirm('Esta seguro que desea elminar el turno'))		
			myajax.Link('../../ccontrol/control/control.php?p1=cro_mantenimiento_cronograma&vid_cronograma_ant='+vid_cronograma+'&fecha='+fecha+'&accion=delete','toolbar_pe');
	espera_respuesta_cronograma();
			//myajax.Link('hospitalizacion/programacion/mante_cronograma.php?vid_cronograma_ant='+vid_cronograma+'&fecha='+fecha+'&accion=delete','toolbar_pe');
}
function retornaCronograma(valor){
	myRand = parseInt(Math.random()*999999999999999);		
	myajax.Link('../../control/control.php?rand='+myRand+'&p1=cro_formulario_inicio_programacion','Contenido');
}
function espera_respuesta_cronograma()
{
		ob12=myajax;
	 	if(ob12.objAjax.readyState == 4)  
		{
			if(ob12.objAjax.status == 304 || ob12.objAjax.status == 200)
			{
				persona=document.getElementById('iid_persona').value;
				oficina=document.getElementById('oficina').value;
				myajax.Link('../../ccontrol/control/control.php?p1=cro_listado_cronograma&persona='+persona+'&oficina='+oficina,'grid_cronograma');
				return true;
			}
			else
			{
				ob12.Cancel();
			}
		}
		setTimeout("espera_respuesta_cronograma()",100);
}


function click_oficinas_tree(id)
{
	myajax.Link('../../ccontrol/control/control.php?p1=cro_busca_profesional_total&p2='+id,'detalle_programacion');
}
function cargar_profesional(){
	myDiv=document.getElementById('busca_tipo');
	myDiv.innerHTML = " ";
	document.getElementById('toolbar_interior').style.display = 'block';		
}