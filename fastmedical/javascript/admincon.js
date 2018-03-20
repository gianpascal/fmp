var teclapresionada = window.Event ? true : false;
function carga_busqueda(var1,titulo,funcionjava,archivophp,opcion,parametro)
{
var key = teclapresionada ? var1.which : var1.keyCode;
	if(key==45 || var1==13) 
	{
		parameter="titulo="+titulo+"&funcionjava="+funcionjava+"&archivophp="+archivophp+"&opcion="+opcion+'&'+parametro;
		jsabrirventana("busquedas/buscar_gral.php?"+parameter, '','no', 'no', 'no', 'no', 'no', 'no', 'no', 500, 400, 'no');		
	}
}
function Verificar_Fecha_Busqueda(TipoB)
{
	switch(TipoB)
	{
		case "1":
		if(document.getElementById("fecha1").value=="" )
		{	alert("La fecha1 debe ser ingresada");
			return false;
		}
		break;
		case "2":
		if(document.getElementById("fecha1").value=="" )
		{	alert("La fecha1 debe ser ingresada");
			return false;
		}
		if(document.getElementById("fecha2").value=="" )
		{
			alert("La fecha2 debe ser ingresada");
			return false;
		}
		break;	
	}
	return true;
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
		case 'CuadroNec'://REQUERIMIENTO
			myajax.Link('logistica/cuadro_necesidades/lista_cuadro_nec.php?'+myajax.DataForm($('CuadroNec')), 'Contenido');
		break;
		case 'CuadroNec_ant'://REQUERIMIENTO
			myajax.Link('logistica/cuadro_necesidades_ant/lista_cuadro_nec.php?'+myajax.DataForm($('CuadroNec_ant')), 'Contenido');
		break;
		case 'CuadroNecAprob':	
			myajax.Link('logistica/solicitud_cot/lista_cuadro_nec_aprob.php?'+myajax.DataForm($('CuadroNecAprob')), 'Contenido');
		break;
		case 'SolicitudCot':
			myajax.Link('logistica/solicitud_cot/lista_solicitudes.php?'+myajax.DataForm($('SolicitudCot')), 'Contenido');			
		break;
		case 'ProcesoSel':
			myajax.Link('logistica/proceso_seleccion/lista_proceso_sel.php?'+myajax.DataForm($('ProcesoSel')), 'Contenido');
		break;	
		case 'ProcesoSelEnv':
 			myajax.Link('logistica/cuadro_comparativo/lista_proceso_sel_env.php?'+myajax.DataForm($('ProcesoSelEnv')), 'Contenido');
		break;
		case 'CuadroComparativo':	
			myajax.Link('logistica/cuadro_comparativo/lista_cuadro_compa.php?'+myajax.DataForm($('CuadroComparativo')), 'Contenido');
		break;
		case 'OrdenServ':	
			myajax.Link('logistica/orden_servicio/lista_orden_serv.php?'+myajax.DataForm($('OrdenServ')), 'Contenido');
		break;
		case 'OrdenCompra':	
			myajax.Link('logistica/orden_compra/lista_orden_compra.php?'+myajax.DataForm($('OrdenCompra')), 'Contenido');
		break;
		case 'OrdenServ_ant':	
			myajax.Link('logistica/orden_servicio_ant/lista_orden_serv.php?'+myajax.DataForm($('OrdenServ_ant')), 'Contenido');
		break;
		case 'OrdenCompra_ant':	
			myajax.Link('logistica/orden_compra_ant/lista_orden_compra.php?'+myajax.DataForm($('OrdenCompra_ant')), 'Contenido');
		break;
		case 'ComVarios':	
			myajax.Link('compromisos_varios/lista_com_varios.php?'+myajax.DataForm($('ComVarios')), 'Contenido');		
		break;
		case 'ComprobantePago':	
			myajax.Link('tesoreria/comprobante_pago/lista_comprobante_pago.php?'+myajax.DataForm($('ComprobantePago')), 'Contenido');		
		break;
		case 'Prove':	
			myajax.Link('maestros/proveedores/m_proveedores.php?TipoBus='+document.getElementById("TipoBus").options[document.getElementById("TipoBus").selectedIndex].value+'&TxtCampoBus='+document.getElementById('TxtCampoBus').value, 'Contenido');
		break;
		case 'Bienes':	
			myajax.Link('maestros/catalogo/busqueda_catalogo.php?TxtCampoBus='+document.getElementById('TxtCampoBus').value+'&ordenarpor='+document.getElementById('ordenarpor').value+'&tipoorden='+document.getElementById('tipoorden').value, 'BuscaCatalogo')
		break;
		case 'PolizaEntrada':	
			myajax.Link('almacen/poliza_entrada/lista_poliza_entrada.php?'+myajax.DataForm($('PolizaEntrada')), 'Contenido');
		break;
		case 'PolizaEntrada_mae':	
			myajax.Link('almacen/poliza_entrada_mae/lista_poliza_entrada.php?'+myajax.DataForm($('PolizaEntrada')), 'Contenido');
		break;
		case 'PecosaCombustible':	
			myajax.Link('almacen/pecosa_comb/lista_pecosa_comb.php?'+myajax.DataForm($('PecosaCombustible')), 'Contenido');
		break;
		case 'PolizaSalida':	
			myajax.Link('almacen/poliza_salida/lista_poliza_salida.php?'+myajax.DataForm($('PolizaSalida')), 'Contenido');
		break;
		case 'PolizaSalida_alm':	
			myajax.Link('almacen/poliza_salida_alm/lista_poliza_salida_alm.php?'+myajax.DataForm($('PolizaSalida_alm')), 'Contenido');
		break;
		case 'KardexCC':
			if(fecha_kardex_check())
				myajax.Link('almacen/kardex/lista_kardex.php?'+myajax.DataForm($('KardexCC')), 'Contenido');
		break;
		case 'Kardexalm':
			
			if(fecha_kardex_check())
				myajax.Link('almacen/kardex_alm/lista_kardex_alm.php?'+myajax.DataForm($('Kardexalm')), 'Contenido');
		break;
		case 'ControlStock':
			
			if(control_stock_check())
				myajax.Link('almacen/control_stock/lista_control_stock.php?'+myajax.DataForm($('ControlStock')), 'Contenido');
		break;
		case 'ReporteSIAF':
			if(document.getElementById('meta')!=null && document.getElementById('meta').value!="")
			{
			myajax.Link('presupuesto/reporte/grid_reporte_siaf.php?'+myajax.DataForm($('ReporteSIAF')), 'gridbox_ReporteSIAF');
			}
			else
			{
				alert("Debe Ingresar la META \n para poder Generar el Reporte!!!!!!");
				return false;
				}
		break;
		case 'p_cargaEXCEL':
			if(document.getElementById('is_excel')!=null && document.getElementById('is_excel').value=="S")
			{
				var parameter="cod_user="+document.getElementById('cod_user').value;
			jsabrirventana("presupuesto/reporte/excel/carga_excel.php?"+parameter, '','no', 'no', 'no', 'no', 'no', 'no', 'no', 500, 400, 'no');
			}
			else
			{
				alert("Debe Generar el Reporte, para poder EXPORTARLO\n en Formato EXCEL");
				return false;
				}
		break;
		case 'ReporteExcelPlan':
			myajax.Link('presupuesto/plandetrabajo/grid_reporte_excel_plantrabajo.php?'+myajax.DataForm($('ReporteExcel')), 'gridbox_ReporteExcel');
		break;
		case 'p_cargaEXCELplan':
			if(document.getElementById('is_excel')!=null && document.getElementById('is_excel').value=="S")
			{
				var parameter="cod_user="+document.getElementById('cod_user').value;
			jsabrirventana("presupuesto/plandetrabajo/excel/carga_excel.php?"+parameter, '','no', 'no', 'no', 'no', 'no', 'no', 'no', 500, 400, 'no');
			}
			else
			{
				alert("Debe Generar el Reporte, para poder EXPORTARLO\n en Formato EXCEL");
				return false;
				}
		break;
		}
	}
	else
		return key;

};
function Salir()
{
	location.href="salir.php";	
}

function anular_registro(objeto)
{
	if($(objeto).checked)
	{
		if (confirm("Esta seguro que desea Anular el Registro"))
			document.getElementById("fch_anu").value=fecha_actual();
		else
		{
			document.getElementById("fch_anu").value="";			
			document.getElementById("flg_anu").checked=false;
		}
	}
	else
	{
		document.getElementById("fch_anu").value="";
		document.getElementById("flg_anu").checked=false;		
	}
}
function aprobar_registro(objeto)
{
	if($(objeto).checked)
	{
		if (confirm("Esta seguro que desea Aprobar en Registro"))
			document.getElementById("fch_apru").value=fecha_actual();
		else
			document.getElementById("flg_apru").checked=false;
	}
	else
	{
		document.getElementById("fch_apru").value="";
		document.getElementById("flg_apru").checked=false;		
	}
}

var cnt_mensaje=0;
function parpadear_mensaje()
{
	if(ObtenerValorObjeto("NombreFormulario")=="CuadroNecesidad" && ObtenerValorObjeto("actualizarcampos")=='1')
	{
	 ColocarValorObjeto("tip_actproy",ObtenerValorObjeto("tip_actproy2"));
	 ColocarValorObjeto("cod_actproy",ObtenerValorObjeto("cod_actproy2"));
	 ColocarValorObjeto("des_actproy",ObtenerValorObjeto("des_actproy2"));
	 ColocarValorObjeto("tra_sol",ObtenerValorObjeto("tra_sol2"));
	 ColocarValorObjeto("tra_apr",ObtenerValorObjeto("tra_apr2"));
	 ColocarValorObjeto("nom_trasol",ObtenerValorObjeto("nom_trasol2"));	 
	 ColocarValorObjeto("nom_traapr",ObtenerValorObjeto("nom_traapr2"));
	 ColocarValorObjeto("actualizarcampos","0");
	}
	if( document.getElementById("sw_mensaje")!= null && document.getElementById("sw_mensaje").value>0 && document.getElementById("mensaje")==null)
	{
		if(document.getElementById("mensaje").style.display=="none")
			document.getElementById("mensaje").style.display="inline";
		else
		{
			document.getElementById("mensaje").style.display="none";
			cnt_mensaje=cnt_mensaje+1;
			if(cnt_mensaje==21)
				 document.getElementById("sw_mensaje").value=0;
		}
	}
	else
		cnt_mensaje=0;
	if( document.getElementById("sw_mensaje")!= null && document.getElementById("sw_mensaje").value>0 && document.getElementById("mensaje")!= null)
	{
		msje=document.getElementById("mensaje").value;
		document.getElementById("mensaje").value="";
		document.getElementById("sw_mensaje").value=0;
		if(msje!=undefined)		alert(msje);
	}		
	setTimeout('parpadear_mensaje()',400);	
}

function busqueda_paginacion(op,Raiz,irapagina)
{
	myRand = parseInt(Math.random()*999999999999999);
	var pagina = document.getElementById("pagina").value;
	var total_paginas = document.getElementById("total_paginas").value;
	var opcion_pagina = document.getElementById("opcion_pagina").value;
	switch(op)
	{
		case 1:		pagina=1;						break;
		case 2:		pagina=parseInt(pagina)-1;		break;
		case 3:		pagina=parseInt(pagina)+1;		break;
		case 4:		pagina=parseInt(total_paginas);	break;
		case 0:		pagina=1;						break;
		case 5:		pagina=irapagina;				break;		
		
	}
	document.getElementById("pagina").value=pagina;
	destino_div="Contenido";
	if(document.getElementById("VENTANA")!=null)
	{
			var parametros=myajax2.DataForm($(opcion_pagina));
			if(document.getElementById("Raiz").value==document.getElementById("RaizAnt").value)
				var direccion_pagina=Raiz+'Listado_'+opcion_pagina+".php?"+parametros;			
			else
				var direccion_pagina=Raiz+"ListadoGeneral.php?"+parametros;			
	}
	else
	switch(opcion_pagina)
	{
		case 'CuadroNec':
			var parametros=myajax2.DataForm($('CuadroNec'));
			var direccion_pagina="logistica/cuadro_necesidades/lista_cuadro_nec.php?"+parametros;
		break;
		case 'CuadroNec_ant':
			var parametros=myajax2.DataForm($('CuadroNec_ant'));
			var direccion_pagina="logistica/cuadro_necesidades_ant/lista_cuadro_nec.php?"+parametros;
		break;
		case 'CuadroNecAprob':	
			var parametros=myajax2.DataForm($('CuadroNecAprob'));
			var direccion_pagina="logistica/solicitud_cot/lista_cuadro_nec_aprob.php?"+parametros;
		break;
		case 'SolicitudCot':
			var parametros=myajax2.DataForm($('SolicitudCot'));
			var direccion_pagina="logistica/solicitud_cot/lista_solicitudes.php?"+parametros;
		break;
		case 'ProcesoSel':
			var parametros=myajax2.DataForm($('ProcesoSel'));
			var direccion_pagina="logistica/proceso_seleccion/lista_proceso_sel.php?"+parametros;
		break;	
		case 'ProcesoSelEnv':
			var parametros=myajax2.DataForm($('ProcesoSelEnv'));
			var direccion_pagina="logistica/cuadro_comparativo/lista_proceso_sel_env.php?"+parametros;
		break;
		case 'CuadroComparativo':	
			var parametros=myajax2.DataForm($('CuadroComparativo'));
			var direccion_pagina="logistica/cuadro_comparativo/lista_cuadro_compa.php?"+parametros;
		break;
		case 'OrdenServ':	
			var parametros=myajax2.DataForm($('OrdenServ'));
			var direccion_pagina="logistica/orden_servicio/lista_orden_serv.php?"+parametros;
		break;
		case 'OrdenCompra':	
			var parametros=myajax2.DataForm($('OrdenCompra'));
			var direccion_pagina="logistica/orden_compra/lista_orden_compra.php?"+parametros;
		break;
		case 'OrdenServ_ant':	
			var parametros=myajax2.DataForm($('OrdenServ_ant'));
			var direccion_pagina="logistica/orden_servicio_ant/lista_orden_serv.php?"+parametros;
		break;
		case 'OrdenCompra_ant':	
			var parametros=myajax2.DataForm($('OrdenCompra_ant'));
			var direccion_pagina="logistica/orden_compra_ant/lista_orden_compra.php?"+parametros;
		break;
		case 'ComVarios':	
			var parametros=myajax2.DataForm($('ComVarios'));
			var direccion_pagina="compromisos_varios/lista_com_varios.php?"+parametros;
		break;
		case 'ComprobantePago':	
			var parametros=myajax2.DataForm($('ComprobantePago'));
			var direccion_pagina="tesoreria/comprobante_pago/lista_comprobante_pago.php?"+parametros;
		break;
		//////////////////////
		////PRESUPUESTO////////
		/////////////////////
		case 'CuadroReq':
		var parametros=myajax2.DataForm($('CuadroReq'));
			var direccion_pagina="presupuesto/requerimiento_anual/lista_cuadro_req.php?"+parametros;
		break;
		case 'IngresoAnual':
		var parametros=myajax2.DataForm($('IngresoAnual'));
			var direccion_pagina="presupuesto/ingreso_anual/lista_ingreso_anual.php?"+parametros;
		break;
		case 'det_asig_ftefto_gasto':	
			var tip_actproy = document.getElementById("tip_actproy").value;
			var tipo_presupuesto= document.getElementById("tipo_presupuesto").value;
			var ano_eje_2= document.getElementById("ano_eje_2").value;
			document.getElementById("band").value="false";
			var parametros=myajax2.DataForm($('frm_asig_ftefto_gasto'));
			var direccion_pagina="presupuesto/asig_ftefto_gasto/grid_asig_ftefto_gasto.php?"+parametros+"&tipo_presupuesto="+tipo_presupuesto+"&rand=" + myRand+"&tip_actproy="+tip_actproy+"&pagina="+pagina+"&ano_eje=" + ano_eje_2;
			
			destino_div="gridbox_asig_ftefto_gasto";
			mostrar_navegador_asig_ftefto_gasto();
		break;
		case 'Ampliacion':
		var parametros=myajax2.DataForm($('Ampliacion'));
			var direccion_pagina="presupuesto/calendario_ampliacion/lista_ampliacion.php?"+parametros;
		break;
		case 'Comp_gasto_mes':
		var parametros=myajax2.DataForm($('Comp_gasto_mes'));
			var direccion_pagina="presupuesto/comprobacion/lista_gastos_mes.php?"+parametros;
		break;
		case 'Comp_act_proy':
		var parametros=myajax2.DataForm($('Comp_act_proy'));
			var direccion_pagina="presupuesto/comprobacion/lista_act_proy.php?"+parametros;
		break;
		case 'Comp_ingreso_mes':
		var parametros=myajax2.DataForm($('Comp_ingreso_mes'));
			var direccion_pagina="presupuesto/comprobacion/lista_ingresos_mes.php?"+parametros;
		break;
		case 'Comp_gasto':
		var parametros=myajax2.DataForm($('Comp_gasto'));
			var direccion_pagina="presupuesto/comprobacion/lista_gastos.php?"+parametros;
		break;
		case 'Comp_metas':
		var parametros=myajax2.DataForm($('Comp_metas'));
			var direccion_pagina="presupuesto/comprobacion/lista_metas.php?"+parametros;
		break;
		case 'Comp_presu_inicial':
		var parametros=myajax2.DataForm($('Comp_presu_inicial'));
			var direccion_pagina="presupuesto/comprobacion/lista_presu_inicial.php?"+parametros;
		break;
		case 'Flexibilizacion':
		var parametros=myajax2.DataForm($('Flexibilizacion'));
			var direccion_pagina="presupuesto/calendario_flexibilizacion/lista_flexibilizacion.php?"+parametros;
		break;
		case 'Modificacion_pres':
		var parametros=myajax2.DataForm($('Modificacion_pres'));
			var direccion_pagina="presupuesto/calendario_modificacion_pres/lista_modificacion_pres.php?"+parametros;
		break;
		///////////////////////////
		///////////////////////////
		case 'navegando_rpt':	
			var parametros=myajax2.DataForm($('FrmReporte'));
			var direccion_pagina="logistica/reporteador/reportes.php?"+parametros;
		break;
		case 'navegando_con':	
			var parametros=myajax2.DataForm($('FrmContrato'));
			var direccion_pagina="logistica/reporteador/reportec.php?"+parametros;
		break;
		case 'navegando_plan':	
			var parametros=myajax2.DataForm($('FrmPlancon'));
			var direccion_pagina="maestros/plan/m_plancon.php?"+parametros;
		break;
		case 'navegando_dina':	
			var parametros=myajax2.DataForm($('FrmDinacon'));
			var direccion_pagina="maestros/dinamica/m_dinacon.php?"+parametros;
		break;
		case 'navegando_prove':	
			var parametros=myajax2.DataForm($('FrmProveedores'));
			var direccion_pagina="maestros/proveedores/m_proveedores.php?"+parametros;
		break;
		///////////////////////
		//////////ALMACEN
		/////////////////////////
		case 'PolizaEntrada':	
			var parametros=myajax2.DataForm($('PolizaEntrada'));
			var direccion_pagina="almacen/poliza_entrada/lista_poliza_entrada.php?"+parametros;
		break;
		case 'PolizaSalida':	
			var parametros=myajax2.DataForm($('PolizaSalida'));
			var direccion_pagina="almacen/poliza_salida/lista_poliza_salida.php?"+parametros;
		break;
		case 'PolizaSalida_alm':	
			var parametros=myajax2.DataForm($('PolizaSalida_alm'));
			var direccion_pagina="almacen/poliza_salida_alm/lista_poliza_salida_alm.php?"+parametros;
		break;
	}
	myajax2.Link(direccion_pagina+"&rand=" + myRand, destino_div);
}

function busqueda_paginacion_registros(op,iraareg)
{
	var registros = document.getElementById("registros").value;
	var reg_actual = document.getElementById("reg_actual").value;
	var total_registros = document.getElementById("total_registros").value;
	var parametro_busqueda = document.getElementById("parametro_busqueda").value;
	var opcion_pagina = document.getElementById("opcion_pagina").value;	
	switch (op) 
	{
		case 1:		reg_actual=1;							break;
		case 2:		reg_actual=parseInt(reg_actual)-1;		break;
		case 3:		reg_actual=parseInt(reg_actual)+1;		break;
		case 4:		reg_actual=parseInt(total_registros);	break;		
		case 0:		reg_actual=1;							break;
		case 5:		reg_actual=iraareg;				break;				
	}
	if(document.getElementById("VENTANA")!=null)
	{
		reg=reg_actual-1;
		if(ObtenerValorObjeto("CamposIdentificadores"))	CamposIdentificadores=ObtenerValorObjeto("CamposIdentificadores");
		if(ObtenerValorObjeto("accion"))	accion=ObtenerValorObjeto("accion");	
		if(ObtenerValorObjeto("NombreFormulario"))	NombreFormulario=ObtenerValorObjeto("NombreFormulario");			
		document.getElementById("reg_actual").value=reg_actual;
		var a=new Array();
		a=convertir_a_arreglo(CamposIdentificadores,',');
		cadena="";
		for (x=0;x<a.length;x++)
			cadena=cadena+",'"+RecuperarDato(registros,reg,x)+"'";
		eval("CargarOpciones_"+NombreFormulario+"('"+accion+"','"+parametro_busqueda+"','"+registros+"','"+reg_actual+"','"+total_registros+"'"+cadena+")");
	}
	else	
	switch(opcion_pagina)
	{
		case 'CuadroNec':	
			var ano_eje=recuperar_dato(registros,reg_actual,'1');
			var nro_nec=recuperar_dato(registros,reg_actual,'2');
			document.getElementById("gridbox_cn").style.display="none";			
			cargaropciones_cn('Edit',ano_eje,nro_nec,registros,reg_actual,total_registros,parametro_busqueda);
		break;
		case 'CuadroNec_ant':	
			var ano_eje=recuperar_dato(registros,reg_actual,'1');
			var nro_nec=recuperar_dato(registros,reg_actual,'2');
			document.getElementById("gridbox_cn_ant").style.display="none";			
			cargaropciones_cn('Edit',ano_eje,nro_nec,registros,reg_actual,total_registros,parametro_busqueda);
		break;
		case 'CuadroNecAprob':	
			var ano_eje=recuperar_dato(registros,reg_actual,'1');
			var nro_nec=recuperar_dato(registros,reg_actual,'2');
			cargaropciones_cna('Browse',ano_eje,nro_nec,registros,reg_actual,total_registros,parametro_busqueda);
		break;
		case 'SolicituCot':	
		//alert("aa");
			var ano_eje=recuperar_dato(registros,reg_actual,'1');
			var nro_sol=recuperar_dato(registros,reg_actual,'2');
			document.getElementById("gridbox_sc").style.display="none";			
			cargaropciones_sc('Edit',ano_eje,nro_sol,registros,reg_actual,total_registros,parametro_busqueda);
		break;
		case 'ProcesoSel':	
			var ano_eje=recuperar_dato(registros,reg_actual,'1');
			var nro_pro=recuperar_dato(registros,reg_actual,'2');
			cargaropciones_ps('Edit',ano_eje,nro_pro,registros,reg_actual,total_registros,parametro_busqueda);
		break;
		case 'Cab_Cuadro_Comparativo':	
			var ano_eje=recuperar_dato(registros,reg_actual,'1');
			var nro_cco=recuperar_dato(registros,reg_actual,'2');
			cargaropciones_cc('Browser',ano_eje,nro_cco,registros,reg_actual,total_registros,parametro_busqueda);
		break;
		case 'OrdenServ':	
			var ano_eje=recuperar_dato(registros,reg_actual,'1');
			var nro_ord=recuperar_dato(registros,reg_actual,'2');
			document.getElementById("gridbox_os").style.display="none";			
			cargaropciones_os('Edit',ano_eje,nro_ord,registros,reg_actual,total_registros,parametro_busqueda);
		break;
		case 'OrdenCompra':	
			var ano_eje=recuperar_dato(registros,reg_actual,'1');
			var nro_ord=recuperar_dato(registros,reg_actual,'2');
			document.getElementById("gridbox_oc").style.display="none";			
			cargaropciones_oc('Edit',ano_eje,nro_ord,registros,reg_actual,total_registros,parametro_busqueda);
		break;
		case 'OrdenServ_ant':	
			var ano_eje=recuperar_dato(registros,reg_actual,'1');
			var nro_ord=recuperar_dato(registros,reg_actual,'2');
			document.getElementById("gridbox_os").style.display="none";			
			cargaropciones_os_ant('Edit',ano_eje,nro_ord,registros,reg_actual,total_registros,parametro_busqueda);
		break;
		case 'OrdenCompra_ant':	
			var ano_eje=recuperar_dato(registros,reg_actual,'1');
			var nro_ord=recuperar_dato(registros,reg_actual,'2');
			document.getElementById("gridbox_oc").style.display="none";			
			cargaropciones_oc_ant('Edit',ano_eje,nro_ord,registros,reg_actual,total_registros,parametro_busqueda);
		break;
		////////////////////////
		////PRESUPUESTO//////////
		///////////////////////
		case 'Cab_Reque':	
			var ano_eje=recuperar_dato2(registros,reg_actual,'1');
			var tipo_presupuesto=recuperar_dato2(registros,reg_actual,'2');
			var nro_req=recuperar_dato2(registros,reg_actual,'3');			
			cargaropciones_ra('Edit',ano_eje,nro_req,registros,reg_actual,total_registros,parametro_busqueda,tipo_presupuesto);
		break;		
		case 'Cab_IngresoAnual':	
			var ano_eje=recuperar_dato2(registros,reg_actual,'1');
			var tipo_presupuesto=recuperar_dato2(registros,reg_actual,'2');			
			var nro_ing=recuperar_dato2(registros,reg_actual,'3');
			cargaropciones_ia('Edit',ano_eje,nro_ing,registros,reg_actual,total_registros,parametro_busqueda,tipo_presupuesto);
		break;
		case 'Cab_ampliacion':	
			var ano_eje=recuperar_dato(registros,reg_actual,'1');
			var cod_amp=recuperar_dato(registros,reg_actual,'2');
			cargaropciones_ampcal('Edit',ano_eje,cod_amp,registros,reg_actual,total_registros,parametro_busqueda,tipo_presupuesto);
		break;
		case 'Cab_flexibilizacion':	
			var ano_eje=recuperar_dato(registros,reg_actual,'1');
			var cod_flex=recuperar_dato(registros,reg_actual,'2');
			cargaropciones_flexcal('Edit',ano_eje,cod_flex,registros,reg_actual,total_registros,parametro_busqueda,tipo_presupuesto);
		break;
		case 'Cab_modificacion_pres':	
			var ano_eje=recuperar_dato(registros,reg_actual,'1');
			var cod_modpre=recuperar_dato(registros,reg_actual,'2');
			cargaropciones_modpre('Edit',ano_eje,cod_modpre,registros,reg_actual,total_registros,parametro_busqueda,tipo_presupuesto);
		break;
		
		//////////////////
		case 'ListaOficinas':	
			var parametros=myajax2.DataForm($('FrmListaOficina'));
			var direccion_pagina="presupuesto/plandetrabajo/lista_oficinas.php?"+parametros;
		break;		
		case 'ComVarios':
			var ano_eje=recuperar_dato2(registros,reg_actual,'1');
			var cod_doc=recuperar_dato2(registros,reg_actual,'2');
			var nro_comvar=recuperar_dato2(registros,reg_actual,'3');
			cargaropciones_cv('Edit',ano_eje,cod_doc,nro_comvar,registros,reg_actual,total_registros,parametro_busqueda);
		break;		
		case 'ComprobantePago':
			var ano_eje=recuperar_dato2(registros,reg_actual,'1');
			var cod_doc=recuperar_dato2(registros,reg_actual,'2');
			var nro_compag=recuperar_dato2(registros,reg_actual,'3');
			cargaropciones_cp('Edit',ano_eje,cod_doc,nro_compag,registros,reg_actual,total_registros,parametro_busqueda);
		break;		

		//////////////////////
		/////ALMACEN
		///////////////////////
		case 'cab_poliza_entrada':	
			var ano_eje=recuperar_dato(registros,reg_actual,'1');
			var nro_pol=recuperar_dato(registros,reg_actual,'2');
			document.getElementById("gridbox_pe").style.display="none";			
			cargaropciones_pe('Edit',ano_eje,nro_pol,registros,reg_actual,total_registros,parametro_busqueda);
		break;
		case 'cab_pecosa':	
			var ano_eje=recuperar_dato(registros,reg_actual,'1');
			var nro_pec=recuperar_dato(registros,reg_actual,'2');
			document.getElementById("gridbox_pecosa").style.display="none";			
			cargaropciones_pecosa('Edit',ano_eje,nro_pec,registros,reg_actual,total_registros,parametro_busqueda);
		break;
		case 'cab_pecosa_alm':	
			var ano_eje=recuperar_dato(registros,reg_actual,'1');
			var nro_pec=recuperar_dato(registros,reg_actual,'2');
			document.getElementById("gridbox_pecosa_alm").style.display="none";			
			cargaropciones_pecosa('Edit',ano_eje,nro_pec,registros,reg_actual,total_registros,parametro_busqueda);
		break;
	}
}
function RecuperarDato(registros,reg_actual,opcion)
{
	var a=new Array();
	var arreglo=new Array();
	a=convertir_a_arreglo(registros,'-');
	arreglo=convertir_a_arreglo(a[opcion],',');	
	return arreglo[reg_actual];
}
function recuperar_dato(registros,reg_actual,opcion)
{
	var arreglo=new Array();
	reg_actual=reg_actual-1;	
	temp = "" + registros;
	pos=temp.indexOf('-');
	if (opcion==1)// aa�ooooooooooosssssss
	{
	temp = "" + temp.substring(0, pos);
	}
	else if (opcion==2)//nroooooooooooooooo
	{
	temp = "" + temp.substring(pos+1,temp.length);	
	}
	arreglo=temp.split(',');
	return arreglo[reg_actual];
}

function recuperar_dato2(registros,reg_actual,opcion)
{
	var arreglo=new Array();
	reg_actual=reg_actual-1;	
	temp = "" + registros;
	pos=temp.indexOf('-');
	if (opcion==1)// aa�ooooooooooosssssss
	{
	temp = "" + temp.substring(0, pos);
	//alert(temp);
	}
	else if (opcion==2)//tipo
	{
	temp = "" + temp.substring(pos+1,temp.length);	
	pos=temp.indexOf('-');
	temp = "" + temp.substring(0, pos);	
	//alert(temp);
	}
	else if (opcion==3)//nroooooooooooooooo
	{
	temp = "" + temp.substring(pos+1,temp.length);	
	pos=temp.indexOf('-');
	temp = "" + temp.substring(pos+1,temp.length);	
	//alert(temp);	
	}
	arreglo=temp.split(',');
	return arreglo[reg_actual];
}


function Sacar_Extencion(cadena)
{
	var pos;
	ext=cadena.substring(cadena.length-3,cadena.length);
	return ext;
}
  function isInteger (s)
   {
      var i;

      if (isEmpty(s))
      if (isInteger.arguments.length == 1) return 0;
      else return (isInteger.arguments[1] == true);

      for (i = 0; i < s.length; i++)
      {
         var c = s.charAt(i);

         if (!isDigit(c)) return false;
      }

      return true;
   }

   function isEmpty(s)
   {
      return ((s == null) || (s.length == 0))
   }

   function isDigit (c)
   {
      return ((c >= "0") && (c <= "9"))
   }
function Grabar_Usuario_Pass(vParam,modo)
{
	
	if(document.getElementById("pass_actual").value=="")
	{	alert("Debe Ingresar la CONTRASE�A ACTUAL del USUARIO");
		return false;
	}
	if(document.getElementById("nuevo_pass").value=="")
	{	alert("Debe Ingresar la CONTRASE�A ACTUAL del USUARIO");
		return false;
	}
	if(document.getElementById("nuevo_pass").value!=document.getElementById("re_pass").value)
	{	alert("La VALIDACION de la CONTRASE�A NUEVA no COINCIDE, vuelva a Ingresarlas POR FAVOR");
		return false;
	}
	else
		myajax.Link('opciones/pass_user/mod_contra.php?'+vParam,'Contenido');
}

function sel(nomobjeto,inicio,ofin){
if(ofin=="ALL")
{
	var txt=document.getElementById(nomobjeto).value;
	fin = txt.length;
}
else
	fin=parseInt(ofin);
input=document.getElementById(nomobjeto);
if(typeof document.selection != 'undefined' && document.selection){
tex=input.value;
input.value='';
input.focus();
var str = document.selection.createRange();
input.value=tex;
str.move('character', inicio);
str.moveEnd("character", fin-inicio);
str.select();
}
else if(typeof input.selectionStart != 'undefined'){
input.setSelectionRange(inicio,fin);
input.focus();
}
} 

function busqueda_paginacion_grid(op)
{
	myRand = parseInt(Math.random()*999999999999999);
	var pagina_grid = document.getElementById("pagina_grid").value;
	var total_paginas_grid = document.getElementById("total_paginas_grid").value;
	var opcion_pagina_grid = document.getElementById("opcion_pagina_grid").value;
	switch(op)
	{
		case 1:		pagina_grid=1;						break;
		case 2:		pagina_grid=parseInt(pagina_grid)-1;		break;
		case 3:		pagina_grid=parseInt(pagina_grid)+1;		break;
		case 4:		pagina_grid=parseInt(total_paginas_grid);	break;
		case 0:		pagina_grid=1;						break;
	}
	document.getElementById("pagina_grid").value=pagina_grid;
	switch(opcion_pagina_grid)
	{
		case 'det_asig_espe_ing':
			reload_grid_asig_espe_ing();
		break;
		case 'det_asig_espe_gasto':
			reload_grid_asig_espe_gasto();
		break;
		case 'det_asig_valuni_reqanual':
			reload_grid_asig_valuni_reqanual();
		break;
	}
			
}

function trim(cadena)
{
	for(i=0; i<cadena.length; )
	{
		if(cadena.charAt(i)==" ")
			cadena=cadena.substring(i+1, cadena.length);
		else
			break;
	}

	for(i=cadena.length-1; i>=0; i=cadena.length-1)
	{
		if(cadena.charAt(i)==" ")
			cadena=cadena.substring(0,i);
		else
			break;
	}
	
	return cadena;
}

function funcion_menu_myajax(title_form,cod_form) 
{
	myajax.Link(title_form+'.?cod_form='+cod_form+'&rand=' + myRand, 'Contenido');
}



