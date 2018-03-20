function validarango(dato){
    var sexo=$('sexo').value;
    if (sexo==1){
    var bus=1
    var idingRango=parseInt(dato.id);
    var valingRango=parseInt(dato.value);
    //alert('VALUE:'+valingRango+'<-->ID:'+idingRango);return;
        var url 	= '../../ccontrol/control/control.php';
        var data 	= 'p1=validarango&p2='+bus+'&p3='+idingRango+'&p4='+valingRango;
       //alert (data);return;
       new Ajax.Request ( url,
        {
            method 		: 'get',
            parameters 	: data,
            onLoading	: micargador(1),
            onComplete	: function(transport){
                 micargador(0);
                 alert(transport.responseText);
                 

            }
        }
        )

    }
}


function calcular_formula(evento,val){
    var key 	=evento.which ? evento.which : evento.keyCode;
    if(key==9 || key==13){
        formula(evento,val);
    }
}
function formula(evento,val){
    alert('VALUE:'+val.value+'<-->ID:'+val.id);return;

}
function guardarResulLab(){
    resultados=$('form_detalle').serialize();
    //alert (resultados);
    var url 	= '../../ccontrol/control/control.php';
    var data 	= "p1=guardarResulLab&"+resultados;
    //  alert(data);return;
    new Ajax.Request ( url,
    {
        method 		: 'get',
        parameters 	: data,
        onLoading	: micargador(1),
        onComplete	: function(transport){
            micargador(0);
            var codigo=$('codper').value;
            alert ('Grabo Correctamente El Resultado');
            Windows.close("Div_grid_cajawv");
            refresh_tabla(codigo);

        }
    }
    )
}
function ManteResultadoLab(){
    resultados=$('form_detalle').serialize();
    // alert (resultados);
    var url 	= '../../ccontrol/control/control.php';
    var data 	= "p1= ManteResultadoLab&"+resultados;
    //  alert(data);return;
    new Ajax.Request ( url,
    {
        method 		: 'get',
        parameters 	: data,
        onLoading	: micargador(1),
        onComplete	: function(transport){
            micargador(0);
            var codigo=$('codper').value;
            alert ('Grabo Correctamente El Resultado');
            Windows.close("Div_grid_caja3");
            refresh_tabla(codigo);

        }
    }
    )
}
function refresh_tabla(codigo){
    var url	= '../../ccontrol/control/control.php';
    var data 	= 'p1=buscar_analisis_Lab&p2='+codigo;
    //alert(data);return;
    new Ajax.Request ( url,
    {
        method 		: 'get',
        parameters 	: data,
        onLoading	: micargador(1),
        onComplete	: function(transport){
            micargador(0);
            $('cont_res').update(transport.responseText);
        }
    }
    )

}
function cerrar_ventana_actualizacion_impresion_resultados(){
    var acepto=confirm("Usted ha impreso correctamente el resultado?");
    if(acepto==true){
        var codigo=$('id_resul_lab').value;
        var url 	= '../../ccontrol/control/control.php';
        var data 	= 'p1=imprResultadolab&p2='+codigo;
        //alert(data);
        new Ajax.Request ( url,
        {
            method 		: 'get',
            parameters 	: data,
            onLoading	: micargador(1),
            onComplete	: function(transport){
                micargador(0);
                var codigo1=$('codper').value;
                alert ('Se Imprimio Correctamente El Resultado');
                Windows.close("Div_grid_AddListResulLablm");
                refresh_tabla(codigo1);
		
            }
        }
        )//Hasta aqui va el ajax.
    }
}

function bustecnologo(){
    var bus='4';
    var codigo=''
    CargarVentana('grid_AddListOrdLatt','Buscador De Tecnologos Laboratorio HMLO','../../ccontrol/control/control.php?p1=bustecnologo&p2='+bus+'&p3='+codigo, '580','300',false,true,'','','',10,10,80,10);

}
function busEventotabla(id){
    //var evalua=$('id').value;
    //alert(evalua);return;
    var bus='6';
    var tablaw=$('tabla[]').value;
    //alert (tabla);return;
    CargarVentana('grid_Bustabla','Muestra data','../../ccontrol/control/control.php?p1=busEventotabla&p2='+bus+'&p3='+tablaw+'&p4='+id, '400','200',false,true,'','','',10,20,10,10);
//}
}
function sel_tabla (valor,evento,codigo){
    var valor1=document.getElementById("idsel").value;
    //alert(valor1);
    var cod=valor.childNodes[1].childNodes[0].textContent;
    var nsel=valor.childNodes[3].childNodes[0].textContent;
    //alert(id);return;
    var acepto=confirm("Esta Seguro De Ingresar Itm : "+nsel+"?");
    if(acepto==true){
        var url 	= '../../cvista/laboratorio/BusTecnologo.php';
        var data 	= 'p1='+cod+'&p2='+nsel+'&p3='+valor1;
        new Ajax.Request ( url,
        {
            method 		: 'get',
            parameters 	: data,
            onLoading	: micargador(1),
            onComplete	: function(transport){
                micargador(0);
                document.getElementById(valor1).value=nsel;
                $('codtabla_wv').value=trim(cod);
                //alert(nsel);
                Windows.close("Div_grid_Bustabla");
            }
        }
        )//Hasta aqui va el ajax.

    }//llave final del if
}


function sel_tecnologo(valor,evento,codigo){
    var codigo_tec=valor.childNodes[1].childNodes[0].textContent;
    var nombre_tec=valor.childNodes[3].childNodes[0].textContent;
    // alert(codigo_tec+' '+nombre_tec);return;
    var acepto=confirm("Esta Seguro De Ingresar Al Tecnologo :"+nombre_tec+"?");
    if(acepto==true){
        var url 	= '../../cvista/laboratorio/BusTecnologo.php';
        var data 	= 'p1='+codigo_tec+'&p2='+nombre_tec;
        new Ajax.Request ( url,
        {
            method 		: 'get',
            parameters 	: data,
            onLoading	: micargador(1),
            onComplete	: function(transport){
                micargador(0);
                $('codtecnologo').value=codigo_tec;
                $('codtec').value=codigo_tec;
                $('ntecnologo').value=nombre_tec;
                Windows.close("Div_grid_AddListOrdLatt");
            }
        }
        )//Hasta aqui va el ajax.

    }//llave final del if
}
///////////// FORMATOS ///////////////



function sele_condiciones_items(opcion,codigo_analisis){
	$('valor_formula').value='';
	$('valor_condicion').value=opcion;
	$('res_selecionabledv').innerHTML='';
	$('res_formuladv').style.display='none';
	$('res_selecionabledv').style.display='none';
	
	
	if(opcion=='3'){
			$('res_selecionabledv').style.display='block';
	var valor1='1';
	var valor2='';
	var url 	= '../../ccontrol/control/control.php';
	var data 	= 'p1=CboFormatoSelectlm&p2='+valor1+'&p3='+valor2+'p4=';
	new Ajax.Request ( url,
		{	method 		: 'get',
			parameters 	: data,
			onLoading	: micargador(1),
			onComplete	: function(transport){micargador(0);
				$('res_selecionabledv').update(transport.responseText);
			}
		}
	)
		}else if(opcion=='8'){
	$('res_formuladv').style.display='block';
	CargarVentana('grid_crearFormula','Creacion de Formula','../../ccontrol/control/control.php?p1=FormulaFormatoslm&p2='+codigo_analisis,'380','210',false,true,'','','',10,10,80,10);
		}
}

function arma_formula(opcion,valor){
	
	switch(opcion){
		
		case 'op1':
		$('valor_add_formula').value=$('valor_add_formula').value+valor;
	if($('valor_array').value=='0'){$('valor_array').value=valor;}else{$('valor_array').value=$('valor_array').value+','+valor;}
		//$('valor_array').value=$('valor_add_formula').value;
		$('indice_array').value=parseFloat($('indice_array').value)+1;
		break;
		
		case 'op2':
		$('valor_add_formula').value='';
		$('valor_array').value='';
		$('indice_array').value='0';
		break;	
		}
}

function valida_formula(opcion){
	switch(opcion){
	case 'opc1':
	var acepto=confirm("Es correcta la formula creada?");
	if(acepto==true){
	var formula=$('valor_add_formula').value;
	var url 	= '../../cvista/laboratorio/creacion_formula_formatos.php';
	var data 	= 'p1='+formula;
	new Ajax.Request ( url,
		{
		method 		: 'get',
		parameters 	: data,
		onLoading	: micargador(1),
		onComplete	: function(transport){micargador(0);
			$('valor_formula').value=formula;
	Windows.close("Div_grid_crearFormula");			
		}
	}
	)//Hasta aqui va el ajax.

  }//llave final del if
	break;
	case 'opc2':
	Windows.close("Div_grid_crearFormula");	
	break;
	}
}

function cambio_valor_campo(objeto){
	if(objeto.checked==true){
		$('valor_campo').value='1';
		}else{
		$('valor_campo').value='2';			
			}	
}

function formato_valor_referencial(valor1,valor2){
var	sel=valor1+'-'+valor2;
	$('rango_general').style.display='none';
	$('rango_genero').style.display='none';
switch(sel){
	case'1-1':
	$('rango_general').style.display='block';	
	break;
	case'2-1':
	$('rango_genero').style.display='block';
	break;
	}
}	
///////////////// DE AQUI PARA ARRIBA FUNCIONES LUIS MINAYA FORMATOS //////////////////
function nuevo_formato(opcion,idtipo,items,destino,visual){
	//ejemplo ingreso de un nuevo item: 23,an,'',det_opc
	//Ahora hacemos el ejemplo de editar item 13,'an','it','det_opc'
	idtipo = idtipo!=''?$F(idtipo):'';//aqui le saco el valor seleccionado del combo del item.
        items = items!=''?$F(items):'';
	//alert(items);return;
	var url = '../laboratorio/mantenimiento_formatos_edicion.php';
	var data= 'op='+opcion+'&id_tipo='+idtipo+'&items='+items+'&condi_visual='+visual;
	//alert(data);return;
	new Ajax.Request ( url,
	{
            method 	: 'get',
            parameters 	: data,
            onLoading	: micargador(1),
            onComplete	: function(transport){micargador(0);
                $(destino).update(transport.responseText);
            }
	}
	)
}
function elimina_formato(opcion,grupo,idtipo,items,destino){
//	alert(opcion);return;
	idtipo	= idtipo!=''?$F(idtipo):'';
    items	= items!=''?$F(items):'';
	var url 	= '../../ccontrol/control/control.php';          //id_tipo                                      items
	var data 	= 'p1=ManteFormatos&grupo='+grupo+'&op='+opcion+'&iid_labmformatos='+idtipo+'&iid_labdformatos='+items;
	//alert(data);
    if(window.confirm("Confirma que desea eliminar el registro?")){
	new Ajax.Request ( url,
	{	method 		: 'get',
		parameters 	: data,
		onLoading	: micargador(1),
		onComplete	: function(transport){micargador(0);
			$(destino).update(transport.responseText);
			ActualizarCombos(opcion,'%%',idtipo);
		}
	}
	)
}
}

function guarda_formato(op,mformato,dformato,nivel,padre,idtipo3,idtipo4,idtipo5,idtipo6,idtipo7,idtipo8){
    var nombre_grupo =$F('nombre_grupo');
    var orden        =$F('orden');	
    var sigla        =$F('sigla');
    var tipo         =$F('tipo');
    var unidad       =$F('unidad');
    //alert('op='+op+'&mformato:'+mformato+'&dformato:'+dformato+'&nivel:'+nivel+'&padre:'+padre+'&orden:'+orden)
	//alert('Analisis:'+mformato+'<>Item:'+dformato+'<>Unid. Med:'+idtipo3+'<>VR Inf:'+idtipo4+'VR Sup:<>'+idtipo5+'<>VR Inf:'+idtipo6+'<>VR Sup:'+idtipo7+'<>VR Formula:'+idtipo8+'<>Padre:'+padre);//return;
	/*
	nombre_grupo -> La descripcion  o el nombre de la familia, analisis o item.
	orden -> El orden de como se muestra la familia, analisis o item.
	sigla -> Indice que se graba en la familia o analisis.
	tipo -> Si es Titulo o Subtitulo.
	unidad -> Unidad de medida.
	*/
if(op=='13'){
//aqui cambiar el valor 
var	nivel=$F('valor_condicion');
var tabla='';
var formula='';

	switch(nivel){
	case '3':
	tabla=$F('valor_seleccionable');
	break;
	case '8':
	formula=$F('valor_formula');	
	break;	
	}
	
	var v_referencial=$F('valor_referencial');			
	var tipo4='';
	var tipo5='';
	var tipo6='';
	var tipo7='';
	if(v_referencial=='1'){
		tipo4=$F('val_ref_gnrl_inf_rango');
		tipo5=$F('val_ref_gnrl_sup_rango');	
		}else if(v_referencial=='2'){
		tipo4=$F('val_ref_gnro_inf_fem');
		tipo5=$F('val_ref_gnro_sup_fem');
		tipo6=$F('val_ref_gnro_inf_mas');
		tipo7=$F('val_ref_gnro_sup_mas');			
		}	
	
}	
if(op=='23'){
    /*
    Aqui se obtiene el nivel, el div_form o el tipo formula.
    */
    var nivel=$F('valor_condicion');
    var tabla='';
    var formula='';
    if(nivel=='3'){
       tabla=$F('valor_seleccionable');
    }
    else if(nivel=='8'){
      formula=$F('valor_formula');
    }
    /*
    Aqui se obtiene el valor referencial y si van a
    grabarse solo los tipos 4 y 5, o los 4,5,6 y 7.
    */
    var v_referencial=$F('valor_referencial');
    var tipo4='';
    var tipo5='';
    var tipo6='';
    var tipo7='';
	if(v_referencial=='1'){
            tipo4=$F('val_ref_gnrl_inf_rango');
            tipo5=$F('val_ref_gnrl_sup_rango');
        }
        else if(v_referencial=='2'){
            tipo4=$F('val_ref_gnro_inf_fem');
            tipo5=$F('val_ref_gnro_sup_fem');
            tipo6=$F('val_ref_gnro_inf_mas');
            tipo7=$F('val_ref_gnro_sup_mas');
	}		
}
var url = '../../ccontrol/control/control.php';
var data = 'p1=ManteFormatos&nombre_grupo='+nombre_grupo+ //Se guarda en familia, analisis e item. En nuevo y editar.
          '&orden='+orden+   //Se guarda en familia, analisis e item. En nuevo y editar.
          '&sigla='+sigla+   //Se guarda en familia y analisis. En nuevo y editar.
          '&tipo='+tipo+     //Se guarda en familia, analisis e item. En nuevo y editar.
          '&unidad='+unidad+ //Se guarda en item. En nuevo y editar.
          '&op='+op+         //Se guarda en familia, analisis e item. En nuevo y editar.
          '&iid_labdformatos='+dformato+ //Se guarda en item. En editar.
          '&iid_labmformatos='+mformato+ //Se guarda en familia, analisis e item. En editar.
          '&nivel='+nivel+ //Se guarda en familia, analisis e item. En nuevo y editar.
          '&padre='+padre+ //Se guarda en familia, analisis e item. En editar.
          '&id_tipo3='+idtipo3+ //Se guarda en item. En editar.
          '&id_tipo4='+idtipo4+ //Se guarda en item. En editar.
          '&id_tipo5='+idtipo5+ //Se guarda en item. En editar.
          '&id_tipo6='+idtipo6+ //Se guarda en item. En editar.
          '&id_tipo7='+idtipo7+ //Se guarda en item. En editar.
          '&id_tipo8='+idtipo8+ //Se guarda en item. En editar.
          '&tipo4='+tipo4+
          '&tipo5='+tipo5+
          '&tipo6='+tipo6+
          '&tipo7='+tipo7+
          '&tabla='+tabla+
          '&formula='+formula+
          '&v_referencial='+v_referencial;
          //Se guarda en familia, analisis e item. En nuevo y editar.
          alert(data);
          if(window.confirm("Confirma que desea Guardar el registro?")){
                new Ajax.Request (url,
		{ method        :'get',
		  parameters 	: data,
		  onLoading	: micargador(1),
		  onComplete	: function(transport){micargador(0);
					$('det_opc').update(transport.responseText);
					ActualizarCombos(op,'%%',mformato);
				}
			}
		 )
	 }
}

function ActualizarCombos(op,mformato,dformato){
		if(op=='13' || op=='23' || op=='33'){
		myajax.Link('../../ccontrol/control/control.php?p1=ListaFormatosAnalisis&sp1=1&sp2=1&sp5=3&sp3='+mformato+'&sp4='+dformato,'dv_it');
		
		}else if(op=='12' || op=='22' || op=='32'){
		myajax.Link('../../ccontrol/control/control.php?p1=ListaFormatosAnalisis&sp1=2&sp2=1&sp5=2&sp3='+mformato+'&sp4='+dformato,'dv_an');

	     }else if(op=='11' || op=='21' || op=='31'){
		 myajax.Link('../../ccontrol/control/control.php?p1=ListaFormatosAnalisis&sp1=1&sp2=1&sp5=1&sp3='+mformato+'&sp4=%%','dv_fm');
		 
		 }
		 
}


//////////// FIN FORMATOS ////////////

function listOrdLab(idElemento,cal){
    var dia     = idElemento.split("-");
	arrayInput = document.getElementById(cal).getElementsByTagName("input");
	//fechaActual = arrayInput[6].value+"-"+arrayInput[5].value+"-"+dia[1];
	fechaActual=dia[1]+'/'+arrayInput[5].value+'/'+arrayInput[6].value;
    ajaxListOrdLab('1',fechaActual,'');
}
function buscListOrdLab(evento,val,opc){
    var key 	=evento.which ? evento.which : evento.keyCode;
	if(key==9 || key==13){
        var valor   = val.value;
        ajaxListOrdLab(opc,'',valor);
    }
}
function ajaxListOrdLab(opc,fechaActual,val){
        var url 	= '../../ccontrol/control/control.php';
	var data 	= 'p1=listOrdLab&p2='+opc+'&p3='+fechaActual+'&p4='+val;
	//alert(data);return;
	new Ajax.Request ( url,
	{
            method 	: 'get',
            parameters 	: data,
            onLoading	: micargador(1),
            onComplete	: function(transport){micargador(0);
                $('contenido_analisis').update(transport.responseText);
                $('detalle_analisis').update('<table cellspacing="0" cellpading="0" id="ubiPredContrib_lm4"class="tablaOrden"title=""><thead><tr><th>CODIGO</th><th>DESCRIPCION</th><th>ACCION</th></tr></thead><tbody><tr class="col1"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr><tr class="col2"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr><tr class="col1"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr><tr class="col2"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr><tr class="col1"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr><tr class="col2"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr><tr class="col1"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr><tr class="col2"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr><tr class="col1"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr><tr class="col2"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr><tr class="col1"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr></tbody></table>');
            }
	}
	)
}
function AddListOrdLab(valor,evento,orden){
//alert(valor.childNodes[7].childNodes[0].textContent+'---'+evento+'---'+orden);return;
var acto_medico=valor.childNodes[13].childNodes[0].textContent;
    CargarVentana('grid_AddListOrdLab','Agregar Orden a Laboratorio','../../ccontrol/control/control.php?p1=AddListOrdLab&p2='+orden+'&p3='+acto_medico,'580','300',false,true,'','','',10,10,80,10);
}
function codOrdLabCmb(val){
    $('bcodigo').type=val.value=='1'?'hidden':'text';
    $('bdni').type=val.value=='1'?'text':'hidden';
    if(val.value=='1'){
        $('bdni').select();
    }else{
        $('bcodigo').select();
    }
}
function busOrdLabTip(t){
    tabs = new Array('TABCALENDAR','TABPACIENTE-bnombre','TABCODIGO-bcodigo','TABORDEN-borden');
    buclesMulti('tabHab',tabs,t);
}
function accionCalendarioOrdLab(idAccion,cal){
    arrayInput = document.getElementById(cal).getElementsByTagName("input");
    fechaActual = arrayInput[6].value+"-"+arrayInput[5].value+"-"+arrayInput[4].value;
    var url 	= '../../ccontrol/control/control.php';
    var data 	= "p1=calendarioOrdLab&p2="+fechaActual+"&p3="+idAccion;
    new Ajax.Request ( url,
    {
        method 		: 'get',
        parameters 	: data,
        onLoading	: micargador(1),
        onComplete	: function(transport){
            micargador(0);
            $('divConsulCronograma').update(transport.responseText);
        }
    }
    )

}
function guardarResulLab(){
    resultados=$('form_detalle').serialize();    
    var url 	= '../../ccontrol/control/control.php';
    var data 	= "p1=guardarResulLab&"+resultados;
    new Ajax.Request ( url,
    {
        method 		: 'get',
        parameters 	: data,
        onLoading	: micargador(1),
        onComplete	: function(transport){
            micargador(0);
           // $('cont_res').update(transport.responseText);
            alert ('Grabo Correctamente El Resultado');
            Windows.close("Div_grid_cajawv");
        }
    }
    )
}

///////////////////////////////////////////////////////////////
////////////////// Funciones Luis Minaya //////////////////////
///////////////////////////////////////////////////////////////
/* funciones para las busquedas de ordenes*/
function tipo_condicion_perlab(valor){
	$('condicion_busqueda_perlab').value='';
if(valor=='2'){
	$('condicion_busqueda_perlab').size='25';
	$('condicion_busqueda_perlab').maxLength='25';
	$('condicion_busqueda_perlab').readOnly=true;
	$('condicion_busqueda_perlab').style.cursor='crosshair';
	$('bus_lablm1').style.display='none';
	$('bus_lablm2').style.display='block';
	$('condicion_busqueda_perlab').onClick=WindowBuscaPersonaslm('orden_especifica_selec');
	}else{
	$('condicion_busqueda_perlab').readOnly=false;	
	$('condicion_busqueda_perlab').size='15';
	$('condicion_busqueda_perlab').maxLength='14';
	$('condicion_busqueda_perlab').style.cursor='text';
	$('bus_lablm1').style.display='block';
	$('bus_lablm2').style.display='none';
		}
		$('condicion_busqueda_perlab').focus();
}
/*################## buscador de personas #################*/
function WindowBuscaPersonaslm(javascript){
CargarVentana('grid_WindowBuscaPersonalm','Busqueda de Personas','../../ccontrol/control/control.php?p1=WbuscaPersonalmLab&p2=4&p3=0122614&p4=ventana&p5='+javascript,'580','300',false,true,'','','',10,10,80,10);
}

function opc_dvbsqper(valor){
var a=valor.split("/");
$('opc'+a[0]).style.display='block';
$('opc'+a[1]).style.display='none';
$('opc'+a[2]).style.display='none';
$('condicion_bper'+a[1]).value='';
$('condicion_bper'+a[2]).value='';
$('condicion_bper'+a[0]).focus();
}


function busqueda_personalm(){
	var opcjav=$('opcion_java_lab2').value;
	var combo=$('select_tipo_busq_lab2').value;
	var ar=combo.split('/');
	var opcion=ar[0];
	var condicion=$('condicion_bper'+ar[0]).value;
	var url 	= '../../ccontrol/control/control.php';
	var data 	= 'p1=WbuscaPersonalmLab&p2='+opcion+'&p3='+condicion+'&p4=ajax&p5='+opcjav;
	//alert(data);return;
	new Ajax.Request ( url,
		{
		method 		: 'get',
		parameters 	: data,
		onLoading	: micargador(1),
		onComplete	: function(transport){micargador(0);
			$('grid_busqueda_personalm_lab').update(transport.responseText);
		}
	}
	)//Hasta aqui va el ajax.
}

function busqueda_persona_registro_ingr(valor,evento,codigo){
var cod_per1=valor.childNodes[1].childNodes[0].textContent;
ajaxListOrdLab('3','',cod_per1);
Windows.close("Div_grid_WindowBuscaPersonalm");
}
/*################## mostrar_orden seleccionada, la busqueda de pacientes pa registrar #################*/
function orden_especifica_selec(valor,evento,codigo){

var codigo_per=valor.childNodes[1].childNodes[0].textContent;
		//var acepto=confirm("Confirme la busqueda.");
	//	if(acepto==true){
var url 	= '../../ccontrol/control/control.php';
	var data 	= 'p1=ListOrdLabEsp&p2=1&p3='+codigo_per;
	//alert(data);return;
	new Ajax.Request ( url,
		{
		method 		: 'get',
		parameters 	: data,
		onLoading	: micargador(1),
		onComplete	: function(transport){micargador(0);
			$('gid_busqueda_ordenes_lab').update(transport.responseText);	
		}
	}
	)//Hasta aqui va el ajax.
Windows.close("Div_grid_WindowBuscaPersonalm");
	//	}//cierro el acepto (la confirmacion).
}

function orden_especifica_selec2(){

var codigo_compro=$('condicion_busqueda_perlab').value;
	//	var acepto=confirm("Confirme la busqueda.");
		//if(acepto==true){
var url 	= '../../ccontrol/control/control.php';
	var data 	= 'p1=ListOrdLabEsp&p2=2&p3='+codigo_compro;
	//alert(data);return;
	new Ajax.Request ( url,
		{
		method 		: 'get',
		parameters 	: data,
		onLoading	: micargador(1),
		onComplete	: function(transport){micargador(0);
			$('gid_busqueda_ordenes_lab').update(transport.responseText);	
		}
	}
	)//Hasta aqui va el ajax.
Windows.close("Div_grid_WindowBuscaPersonalm");
		//}//cierro el acepto (la confirmacion).
}
/*################## hasta aqui mostrar_orden seleccionada, la busqueda de pacientes pa registrar #################*/


/* Graba una orden a laboratorio y muestra la data actualizada en la cabecera.*/
function GrabarOrdLab(){
	var arrayProductos_lab=$('ArrayProductoLab').value;// codigos de los productos a ingresar en el detalle.
	var arrayDetcod_lab=$('ArrayDetCodLab').value;// codigos id de los detalles de ordenes a ingresar en el detalle de laboratorio.
	if(Trim(arrayProductos_lab)==''){alert('Debe ingresar como minnimo una prueba.');return;}
		var acepto=confirm("Esta seguro de Ingresar esta Orden?");
		if(acepto==true){
	var valor_lab=$('valor_opcion_lab').value;// opcion en el procedimiento almacenado que corresponde a ingresar = 1.
	var codper_lab=$('idpersona_lab').value;// codigo de persona.
	var comprobante_lab=$('comprobante_lab').value;// codigo de comprobante.
	var orden_lab=$('orden_lab').value;// codigo de la orden.
	var acto_medico_lab=$('acto_medico_lab').value;// codigo del acto medico.
	var fecha_hoy_lab=$('fecha_hoy_lab').value;
	var codigo_medico=$('codigo_medico_lab').value;
    var url 	= '../../ccontrol/control/control.php';

	var data 	= 'p1=addListProdLab&p2='+codper_lab+'&p3='+comprobante_lab+'&p4='+valor_lab+'&p5='+orden_lab+'&p6='+acto_medico_lab+'&p7='+codigo_medico+'&p8='+arrayProductos_lab+'&p9='+arrayDetcod_lab;
	//alert(data);return;
	new Ajax.Request ( url,
		{
		method 		: 'get',
		parameters 	: data,
		onLoading	: micargador(1),
		onComplete	: function(transport){micargador(0);
				alert(transport.responseText);
				ActualizacionTablaRegistroLab(fecha_hoy_lab);
		}
	}
	)	//Hasta aqui es el ajax.
  Windows.close("Div_grid_AddListOrdLab");	
  }

}

/* Visualiza los detalles del registro seleccionado en la cabecera.*/
function vista_detalle_registros(valor,evento,codigo){
var registro_lab=valor.childNodes[1].childNodes[0].textContent;
var codmed_lab=valor.childNodes[13].childNodes[0].textContent;
var fecha_reg_lab=valor.childNodes[5].childNodes[0].textContent;
$('helper_fecha').value='';
$('helper_fecha').value=fecha_reg_lab;
  //alert(codmed_lab);return;
	var url 	= '../../ccontrol/control/control.php';

	var data 	= 'p1=DetViewListProdLab&p2='+registro_lab+'&p3='+codmed_lab+'&p4=2';
	//alert(data);return;
	new Ajax.Request ( url,
		{
		method 		: 'get',
		parameters 	: data,
		onLoading	: micargador(1),
		onComplete	: function(transport){micargador(0);
			$('detalle_analisis').update(transport.responseText);
		}
	}
	)	//Hasta aqui es el ajax.
}

/*################ BUSQUEDA DE MEDICO PARA LA ORDEN ################*/
/*Levanta la ventana de busqueda de medicos.*/
function WindowBuscaMedico(javascript){
CargarVentana('grid_WindowBuscaMedico','Busqueda de Medico','../../ccontrol/control/control.php?p1=WbuscaMedicoLab&p2=4&p3= &p4=ventana&p5='+javascript,'580','300',false,true,'','','',10,10,80,10);
}

function opc_dvbsqmed(valor){
var a=valor.split("/");
$('opc'+a[0]).style.display='block';
$('opc'+a[1]).style.display='none';
$('opc'+a[2]).style.display='none';
$('condicion_bmed'+a[1]).value='';
$('condicion_bmed'+a[2]).value='';
$('condicion_bmed'+a[0]).focus();
}

function busqueda_medico(){
	var opcjav=$('opcion_java_lab').value;
	var combo=$('select_tipo_busq_lab').value;
	var ar=combo.split('/');
	var opcion=ar[0];
	var condicion=$('condicion_bmed'+ar[0]).value;
	var url 	= '../../ccontrol/control/control.php';
	var data 	= 'p1=WbuscaMedicoLab&p2='+opcion+'&p3='+condicion+'&p4=ajax&p5='+opcjav;
	//alert(data);return;
	new Ajax.Request ( url,
		{
		method 		: 'get',
		parameters 	: data,
		onLoading	: micargador(1),
		onComplete	: function(transport){micargador(0);
			$('grid_busqueda_medico_lab').update(transport.responseText);
		}
	}
	)//Hasta aqui va el ajax.
}

/*Esta funcion se ejecuta cuando se asigna al medico en una orden.*/
function Obtener_Cod_med(valor,evento,codigo){
var codigo_med=valor.childNodes[1].childNodes[0].textContent;
var nombre_med=valor.childNodes[5].childNodes[0].textContent;
var acepto=confirm("Esta seguro de Asignar al Medico: "+nombre_med+"?");
	if(acepto==true){
	var url 	= '../../cvista/laboratorio/registro_ordenes_laboratorio_busqmedico.php';
	var data 	= 'p1='+codigo_med+'&p2='+nombre_med;
	new Ajax.Request ( url,
		{
		method 		: 'get',
		parameters 	: data,
		onLoading	: micargador(1),
		onComplete	: function(transport){micargador(0);
			$('codigo_medico_lab').value=codigo_med;
			$('nombre_medico_lab').value=nombre_med;
	Windows.close("Div_grid_WindowBuscaMedico");			
		}
	}
	)//Hasta aqui va el ajax.

  }//llave final del if
}
/*################ OBTENER SOLO LOS PRODUCTOS SELECCIONADOS DE UNA ORDEN ################*/
function ArrayProductosLab(elemento,producto,detcod){
var checkbox=elemento.checked;
if(checkbox==true){
$('ArrayProductoLab').value=$('ArrayProductoLab').value+" "+producto;
$('ArrayDetCodLab').value=$('ArrayDetCodLab').value+" "+detcod;
}else{
$('Tdchk2').checked=false;	
$('ArrayProductoLab').value=$('ArrayProductoLab').value.replace(producto,"");
$('ArrayDetCodLab').value=$('ArrayDetCodLab').value.replace(detcod,"");
	}
}

function SelAllNull(elemento){
var checkbox=elemento.checked;
$('ArrayProductoLab').value='';
$('ArrayDetCodLab').value='';
var countchk=parseFloat($('count_Chk').value);
if(checkbox==true){
	var n=0;while(n<countchk){document.getElementsByName('chk')[n].checked = true;n+=1;}
$('ArrayProductoLab').value=$('TotalProductoLab').value;
$('ArrayDetCodLab').value=$('TotalDetCodLab').value;
}else{
	var n=0;while(n<countchk){document.getElementsByName('chk')[n].checked = false;n+=1;}
$('ArrayProductoLab').value="";
$('ArrayDetCodLab').value="";
	}
}

/*################ ACCIONES EN LA CABECERA Y DETALLES DE LOS REGISTROS INGRESADOS ################*/
/*############################ BORRAR REGISTROS Y PRUEBAS ########################*/
function borrar_registros_lab(registro,fecha_elegida,c_orden){
//	alert(fecha_elegida);return;
	var acepto=confirm("Esta seguro de Eliminar este Registro?");
		if(acepto==true){
	//alert(codregcab_lab);return;
    var url 	= '../../ccontrol/control/control.php';

	var data 	= 'p1=addListProdLab&p2='+registro+'&p3='+fecha_elegida+'&p4=2&p5= &p6= &p7= &p8='+c_orden+'&p9= ';
	//alert(data);return;
	new Ajax.Request ( url,
		{
		method 		: 'get',
		parameters 	: data,
		onLoading	: micargador(1),
		onComplete	: function(transport){micargador(0);
				alert(transport.responseText);
				ActualizacionTablaRegistroLab(fecha_elegida);
		}
	}
	)	//Hasta aqui es el ajax.	
  }
}

function borrar_pruebas_lab(registro,fecha_elegida,detcod){
//	alert(registro+' '+fecha_elegida);return;
	var acepto=confirm("Esta seguro de Eliminar esta Prueba?");
		if(acepto==true){
	//alert(codregcab_lab);return;
    var url 	= '../../ccontrol/control/control.php';

	var data 	= 'p1=addListProdLab&p2='+registro+'&p3='+fecha_elegida+'&p4=3&p5= &p6= &p7= &p8= &p9='+detcod;
	//alert(data);return;
	new Ajax.Request ( url,
		{
		method 		: 'get',
		parameters 	: data,
		onLoading	: micargador(1),
		onComplete	: function(transport){micargador(0);
				alert(transport.responseText);
				ActualizacionTablaRegistroLab(fecha_elegida);
		}
	}
	)	//Hasta aqui es el ajax.	
  }
}

/* CAMBIO DE MEDICOS EN EL DETALLE */
function cambio_medico(cod_registro_det){
//alert(cod_registro_det);
$('helper_1').value='';
$('helper_1').value=cod_registro_det;	
WindowBuscaMedico('Actualizar_Cod_Med');
}
/*esta funcion se ejecuta cuando se desea actualizar al medico en el detalle de los registros ingresados.*/
function Actualizar_Cod_Med(valor,evento,codigo){
var codigo_med=valor.childNodes[1].childNodes[0].textContent;
var nombre_med=valor.childNodes[5].childNodes[0].textContent;
var codigo_prod_detalle=$('helper_1').value;
var fecha_registro_lab=$('helper_fecha').value;
//alert(codigo_med+' '+nombre_med+' '+codigo_prod_detalle);
var acepto=confirm("Esta seguro de Cambiar al Medico: "+nombre_med+"?");
	if(acepto==true){

		var url 	= '../../ccontrol/control/control.php';
		var data 	= 'p1=ActualizaMedicoLab&p2=1&p3='+codigo_med+'&p4='+codigo_prod_detalle+'&p5='+fecha_registro_lab;
		//alert(data);return;
		new Ajax.Request ( url,
			{
			method 		: 'get',
			parameters 	: data,
			onLoading	: micargador(1),
			onComplete	: function(transport){micargador(0);
				alert(transport.responseText);
				ActualizacionTablaRegistroLab(fecha_registro_lab);							
			}
		}
		)//Hasta aqui va el ajax.

$('helper_1').value='';
Windows.close("Div_grid_WindowBuscaMedico");
	}
}


function ActualizacionTablaRegistroLab(fecha_actualizar){
	var url2 	= '../../ccontrol/control/control.php';
	var data2	= 'p1=ActualizacionTablaRegistroLab&p2='+fecha_actualizar;
	
		new Ajax.Request ( url2,
				{
					method 		: 'get',
					parameters 	: data2,
					onLoading	: micargador(1),
					onComplete	: function(transport){micargador(0);
						$('contenido_analisis').update(transport.responseText);
						$('detalle_analisis').update(
					'<table cellspacing="0" cellpading="0" id="ubiPredContrib_lm4"class="tablaOrden"title=""><thead><tr><th>CODIGO</th><th>DESCRIPCION</th><th>ACCION</th></tr></thead><tbody><tr class="col1"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr><tr class="col2"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr><tr class="col1"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr><tr class="col2"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr><tr class="col1"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr><tr class="col2"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr><tr class="col1"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr><tr class="col2"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr><tr class="col1"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr><tr class="col2"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr><tr class="col1"><td id="Codigo"><span style="visibility: hidden;">.</span></td><td id="Descripcion"><span style="visibility: hidden;">.</span></td><td id="Accion"><span style="visibility: hidden;">.</span></td></tr></tbody></table>');
					}
				}
		)//Hasta aqui va el ajax.
		
}


/*########################## FUNCIONES DE VALIDACION ##########################*/

/*function numbersonly(myfield, e, dec)
{
    alert('hola');
    var key;
    var keychar;
    if (window.event)
            key = window.event.keyCode;
    else if (e)
            key = e.which;
    else
            return true;	

    keychar = String.fromCharCode(key);
    alert(keychar);
    // control keys
    //if ((key==13) )
                    //alert("aaaaaaaa");

    if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )
            return true;
    // numbers
    if (dec && (keychar == "." || keychar == ","))
    {
            var temp=""+myfield.value;
            if(temp.indexOf(keychar) > -1)
                    return false;
    }
    else if ((("0123456789").indexOf(keychar) > -1))
            return true;
    // decimal point jump
    else
    return false;
}
*/
function textoonly(myfield, e) 
{
	var key;
	var keychar;
	if (window.event)	
		key = window.event.keyCode;	
	else if (e)	
		key = e.which;
	else	
		return true;	
	keychar = String.fromCharCode(key);
	// control keys
	//if ((key==13) )	
			//alert("aaaaaaaa");
	
	if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )	
		return true;
	// numbers  
	if ((("ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz ").indexOf(keychar) > -1))
		return true;
	// decimal point jump  
	else  
	return false;  
}
function RellenarConCeros(cant,id){
	var cadena=$(id).value;
		for(n=cadena.length;n<cant;n++){
		cadena="0"+cadena;
	}
	return $(id).value=cadena;
}

function EsTecla(evt,tecla)
{	
	key=LeeTecla(evt);
	if(key==tecla)	return 1;
	else		return 0;			
}
function LeeTecla(evt)
{	var nav1 = window.Event ? true : false;
	var key = nav1 ? evt.which : evt.keyCode;
	return key;			
}
 ///Funcion Trim para javascript 
function Trim( str ) {
var resultStr = "";

resultStr = TrimLeft(str);
resultStr = TrimRight(resultStr);

return resultStr;
}
 
function TrimLeft( str ) {
var resultStr = "";
var i = len = 0;
// Return immediately if an invalid value was passed in
if (str+"" == "undefined" || str == null) 
return null;
// Make sure the argument is a string
str += "";
if (str.length == 0) 
resultStr = "";
else { 
// Loop through string starting at the beginning as long as there
// are spaces.
// len = str.length - 1;
len = str.length;

while ((i <= len) && (str.charAt(i) == " "))
i++;
// When the loop is done, we're sitting at the first non-space char,
// so return that char plus the remaining chars of the string.
resultStr = str.substring(i, len);
}
return resultStr;
}

function TrimRight( str ) {
var resultStr = "";
var i = 0;
// Return immediately if an invalid value was passed in
if (str+"" == "undefined" || str == null) 
return null;
// Make sure the argument is a string
str += "";

if (str.length == 0) 
resultStr = "";
else {
// Loop through string starting at the end as long as there
// are spaces.
i = str.length - 1;
while ((i >= 0) && (str.charAt(i) == " "))
i--;

// When the loop is done, we're sitting at the last non-space char,
// so return that char plus all previous chars of the string.
resultStr = str.substring(0, i + 1);
}

return resultStr; 
}
///////fin del Trim de javascript



/*########################## FIN DE FUNCIONES DE VALIDACION ##########################*/

///////////////////////////////////////////////////////////////
////////////////// Funciones Luis Minaya //////////////////////
///////////////////////////////////////////////////////////////