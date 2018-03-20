/**
 * @author avatara
 */
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
///////////////////////////////////////////////////////

///////////CLASE POO{}////////////////////////
POO={
	param1 : "000001",
	idDivCargador : 'VentanaTransparente',
	nodoDivTotal : null,
	pathRequestControl:"../../ccontrol/control/control.php",
	estiloFondoVisible :"background-position:50% 50%;background-repeat:norepeat;position:absolute;width:100%;height:100%;background-color:#F0F0F0;-moz-opacity:0.7;opacity:0.7;-moz-border-radius:5px;visibility:hidden;",
	estiloFondoOculto :"position:absolute;width:0px;height:0px;background-color:#F0F0F0;visibility:hidden;",
	send : function(url,param){
		parent = this; 
		if (parent.http.readyState == 1) return;
		parent.http.open("get",url,true);
		parent.http.onreadystatechange = null;
		fn = param;
		parent.http.onreadystatechange = function(){
			if(parent.http.readyState == 1){
				$(parent.idDivCargador).style.visibility = 'visible';
			}else if(parent.http.readyState!=4){//7
				$(parent.idDivCargador).style.visibility = 'visible';
			}else if(parent.http.status==200){
					$(parent.idDivCargador).style.visibility = 'hidden';
				if(typeof fn == "function" && fn instanceof Function){
					respuesta = parent.http.responseText;
					fn.call(null,respuesta);
					return;
				}else if(typeof fn == 'string'){
					$(fn).innerHTML = parent.http.responseText;
					delete fn;
					return;
				}
			}else{
				alert("Ocurrio un maldito Error :)");
				parent.http.abort();
			}
		};
		this.http.send(null);
	},
	Request:function(parametros,param){
		fn = param;
		new Ajax.Request(POO.pathRequestControl,
			{method:'get',
			parameters:parametros,
			onLoading:function(transport){
				$(POO.idDivCargador).style.visibility = 'visible';
			},
			onSuccess:function(transport){
				$(POO.idDivCargador).style.visibility = 'hidden';
				if(typeof fn == "function" && fn instanceof Function){
					respuesta = transport.responseText;
                                        fn.call(null,respuesta);
					return;
				}else if(typeof fn == 'string'){
					//alert("holaaa..." + "  " + fn);
					$(fn).update(transport.responseText);
					delete fn;
					return;
				}
			}
		});
	},
	cancelarSolicitud:function(){
		this.http.abort();
		$(parent.idDivCargador).style.visibility = 'visible';
		return;
	},
	addMethod : function(object, name, fn){
		var old = object[ name ];
   		object[ name ] = function(){
        if ( fn.length == arguments.length)
             return fn.apply(this, arguments);
         else if ( typeof old == 'function')
            return old.apply(this, arguments);
     	};
	},
	getHttp : function(){
		var http;
		if(window.XMLHttpRequest){
			http = new XMLHttpRequest();
		}else if(window.ActiveXObject){
			http = new ActiveXObject("Microsoft.XMLHTTP");
		}else if(!http){
			http = new ActiveXObject("Msxml2.XMLHTTP");
		}
		return http;
	},
	addEvent :function(elemento,nombreEvento,funcionOyente){
		if(elemento.addEventListener){
			elemento.addEventListener(nombreEvento, funcionOyente, false);
			return true;
		}else if (elemento.attachEvent){
			var r = elemento.attachEvent('on' + nombreEvento, funcionOyente);
			return r;
		}else{
			elemento['on' + nombreEvento] = funcionOyente;
		}
	},
	http : this.getHttp(),
}
tablaPHP={
		SORT_COLUMN_INDEX:0,
		urlTablaOyente:"../../../pholivo/control_pholivo/control/control_pholivo.php",
		funDesel:function(tr, eFS){
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
		},
		mostrarCelda : function(_this,_event){
                    //Cuando se Da click sobre el textbox se ejecuta el evento del TD. El _this es el TD y el evento es del textbox. El ultimo event es del input;
                    if(_event.type == "click" && _this.type != "text" && _this.nodeName == "TD" && _this.firstChild.nodeName != "input" &&  _event.target != '[object HTMLInputElement]'){
                            //alert(_this.id +" : "+ _this.nodeName + " : "+ _event.layerX + " : "+ _event.X + " : " + _event.pageX + " : " + _event.screenX+ " : "+  _event.target + " : " + _event.type);
                            cajaTexto = document.createElement("input");
                            cajaTexto.setAttribute("type","text");
                            cajaTexto.setAttribute("value",_this.textContent);
                            //cajaTexto.setAttribute("width",_this.width);
                            cajaTexto.setAttribute("onblur","tablaPHP.ocultarCelda(this,event);");
                            cajaTexto.size = "0";
                            cajaTexto.setAttribute("onkeypress","if(event.keyCode==13) this.blur();");
                            _this.textContent = "";
                            _this.appendChild(cajaTexto);
                            cajaTexto.focus();
                            cajaTexto.select();
                            //cajaTexto.attachEvent //ie
                            //cajaTexto.addEventListener("blur","ocultarCelda");
                            return;
                    }
		},limpiarTabla:function(idTabla){
			//alert($(idTabla).nodeName +  " : " + $(idTabla).childNodes[1].nodeName + " : " + $(idTabla).childNodes[0].nodeName + $(idTabla));
			//tabla = $(idTabla).getElementsByTagName("tbody")[0];
			//alert(tabla.nodeName);
			tabla = $(idTabla).childNodes[1];
			//nodosHijos = tabla.childNodexd s;
            //obtiene todos lo hijos
			nodosHijos = tabla.descendants();
            //alert(nodosHijos.length);
			//for each(nodo in nodosHijos){
			//	if(nodo.nodeName == "TD"){
                    //alert("nodo Hijo 1");
			//		nodo.update("<span style=\"visibility:hidden;\">.</span>");
			//	}
			//}
		},
		ocultarCelda:function(_this,_event){
			if(_event.type == "blur"){				
				valor = _this.value;
				td = _this.parentNode;
				axis = td.axis;
				//Si existe axis el evento lanzado por al actualizacion 
				//de un campo se manda a esta funcion axis;
				if(_this.type == "text"){
					tablaContenedor = _this.ancestors()[3];
					idTabla = tablaContenedor.id;
					fila = td.parentNode;
					idFila = fila.id;
					numeroColumna = td.id;
					var existsOyente;
					td.removeChild(td.firstChild);
					texto = document.createTextNode(valor);
					td.appendChild(texto);
					if(axis == null || typeof axis == 'undefined' || axis == 'undefined' || axis == ''){
						existsOyente =false;
						mapeador ="accion=actualizar_datos_clase_tabla1";
						requestControl = tablaPHP.urlTablaOyente;
					}else{
						existsOyente = true;
						mapeador = "p1="+idTabla;
						requestControl = POO.pathRequestControl;
					}
					parametros = mapeador+"&idTabla="+idTabla+"&idFila="+idFila+"&numeroColumna="+numeroColumna+"&valor="+valor;
					new Ajax.Request(requestControl,{
							parameters:parametros,
							method:'get',
							onSuccess:function(transport){
								if(existsOyente){
									respuesta = transport.responseText;
									script = "<script>"+axis+"("+"respuesta"+");"+"</script>";
									script.evalScripts();
								}
							},
					});
				}
			}
		},
		eliminarFila:function(obj,evento){
			tablaContenedor = obj.ancestors()[3];
			idTabla = tablaContenedor.id;
			mapeador = "accion=eliminar_fila_tabla1";
			idDivContenedor = $(idTabla).parentNode.id;
			idFila = obj.parentNode.parentNode.id;
			//alert( idFila + " : " + tablaPHP.urlTablaOyente + " : " + idTabla + " : " + idDivContenedor);
			url = tablaPHP.urlTablaOyente;
			//alert(url);
			parametros = mapeador+"&idTabla="+idTabla+"&idFila="+idFila;
			new Ajax.Request(url,{
				//overlay_absolute
				parameters:parametros,
				method:'get',
				onSuccess:function(transport){
					if(transport.responseText){
						$(idDivContenedor).update(transport.responseText);
					}
				}
			});
		},
		seleccionarChecks: function(_this,_event,numColumna){
			tabla = _this.parentNode.parentNode.parentNode.parentNode;
			//alert(tabla.nodeName + " : " + _event.ctrlKey + " : " + _event.target + " : " + _event.layerX);
			arrayHB = tabla.childNodes;
		//	alert(arrayHB[1].nodeName);
			tbody = arrayHB[1];
			filas =	tbody.getElementsByTagName("tr");
			fila1 = filas[0];
			//alert(fila1.nodeName);
		//	alert(tdFila1.length);
			arrayTDs = fila1.getElementsByTagName("td");
			tdPrimerCheck = arrayTDs[numColumna];
			arrayChecks = document.getElementsByName(tdPrimerCheck.firstChild.name);
			tamanio = arrayChecks.length;
			if(_event.ctrlKey)
				for(i=0;i<tamanio;i++)
					arrayChecks[i].checked = !arrayChecks[i].checked;
			else
				for(i=0;i<tamanio;i++)
					arrayChecks[i].checked = _this.checked;
		},// para iniciar tabla sorteable al cargar la la pagina
		sortables_init:function(){
			    // Find all tables with class sortable and make them sortable
			    if (!document.getElementsByTagName) return;
			    tbls = document.getElementsByTagName("table");
			    for (ti=0;ti<tbls.length;ti++) {
			        thisTbl = tbls[ti];
			        if (((' '+thisTbl.className+' ').indexOf("sortable") != -1) && (thisTbl.id)) {
			            //initTable(thisTbl.id);
			            ts_makeSortable(thisTbl);
			        }
			    }
		},
		ts_makeSortable:function(table){
			    if (table.rows && table.rows.length > 0) {
			        var firstRow = table.rows[0];
			    }
			    if (!firstRow) return;
			    
			    // We have a first row: assume it's the header, and make its contents clickable links
			    for (var i=0;i<firstRow.cells.length;i++) {
			        var cell = firstRow.cells[i];
			        var txt = ts_getInnerText(cell);
			        cell.innerHTML = '<a href="#" class="sortheaders" '+ 
			        'onclick="ordenar(this, '+i+');return false;">' + 
			        txt+'<span class="sortarrow">&nbsp;&nbsp;&nbsp;</span></a>';
			    }
			},
		ts_getInnerText:function(el){
			if (typeof el == "string") return el;
			if (typeof el == "undefined") { return el };
			if (el.innerText) return el.innerText;	//Not needed but it is faster
			var str = "";
			
			var cs = el.childNodes;
			var l = cs.length;
			for (var i = 0; i < l; i++) {
				switch (cs[i].nodeType) {
					case 1: //ELEMENT_NODE
						str += tablaPHP.ts_getInnerText(cs[i]);
						break;
					case 3:	//TEXT_NODE
						str += cs[i].nodeValue;
						break;
				}
			}
			return str;
		},
		ordenarTabla:function(lnk,clid){
			//alert("punto 1");
			var span;
		    for (var ci=0;ci<lnk.childNodes.length;ci++) {
		        if (lnk.childNodes[ci].tagName && lnk.childNodes[ci].tagName.toLowerCase() == 'span') span = lnk.childNodes[ci];
		    }
			//alert("punto 2");
		    var spantext = tablaPHP.ts_getInnerText(span);
			///alert("punto 3");
		    var td = lnk.parentNode;
		    var column = clid || td.cellIndex;//cellIndex
		    var table = this.getParent(td,'TABLE');
		    // Work out a type for the column
		    if (table.rows.length <= 1) return;
		    var itm = tablaPHP.ts_getInnerText(table.rows[1].cells[column]);
			//alert("punto 4");
		    sortfn = this.ts_sort_caseinsensitive;
		    if (itm.match(/^\d\d[\/-]\d\d[\/-]\d\d\d\d$/)) sortfn = this.ts_sort_date;
		    if (itm.match(/^\d\d[\/-]\d\d[\/-]\d\d$/)) sortfn = this.ts_sort_date;
		    if (itm.match(/^[�$]/)) sortfn = this.ts_sort_currency;
		    if (itm.match(/^[\d\.]+$/)) sortfn = this.ts_sort_numeric;
		    this.SORT_COLUMN_INDEX = column;
		    var firstRow = new Array();
		    var newRows = new Array();
			//alert("punto 5");
			//extrae la columna que va ser evaluda para ordenar en un solo array
		    for (i=0;i<table.rows[0].length;i++){ firstRow[i] = table.rows[0][i]; }
			//alert("punto 6");
		    for (j=1;j<table.rows.length;j++) { newRows[j-1] = table.rows[j]; }
			//alert("punto 7");
		    newRows.sort(sortfn);
			//alert("punto 8");
		    if (span.getAttribute("sortdir") == 'down') {
		        ARROW = '&nbsp;&nbsp;&uarr;';
		        newRows.reverse();
		        span.setAttribute('sortdir','up');
		    }else{
		        ARROW = '&nbsp;&nbsp;&darr;';
		        span.setAttribute('sortdir','down');
		    }
		    // We appendChild rows that already exist to the tbody, so it moves them rather than creating new ones
		    // don't do sortbottom rows
		    for (i=0;i<newRows.length;i++) { if (!newRows[i].className || (newRows[i].className && (newRows[i].className.indexOf('sortbottom') == -1))) table.tBodies[0].appendChild(newRows[i]);}
		    // do sortbottom rows only
		    for (i=0;i<newRows.length;i++) { if (newRows[i].className && (newRows[i].className.indexOf('sortbottom') != -1)) table.tBodies[0].appendChild(newRows[i]);}
			
		    // Delete any other arrows there may be showing
		    var allspans = document.getElementsByTagName("span");
		    for (var ci=0;ci<allspans.length;ci++) {
		        if (allspans[ci].className == 'sortarrow') {
		            if (this.getParent(allspans[ci],"table") == this.getParent(lnk,"table")) { // in the same table as us?
		                allspans[ci].innerHTML = '&nbsp;&nbsp;&nbsp;';
		            }
		        }
		    }
		    span.innerHTML = ARROW;
			//alert("punto 6");
		},
		getParent:function (el, pTagName){
			if (el == null) return null;
			else if (el.nodeType == 1 && el.tagName.toLowerCase() == pTagName.toLowerCase())	// Gecko bug, supposed to be uppercase
				return el;
			else
				return this.getParent(el.parentNode, pTagName);
		},
		ts_sort_date:function(a,b) {
		    // y2k notes: two digit years less than 50 are treated as 20XX, greater than 50 are treated as 19XX
		    aa = tablaPHP.ts_getInnerText(a.cells[tablaPHP.SORT_COLUMN_INDEX]);
		    bb = tablaPHP.ts_getInnerText(b.cells[tablaPHP.SORT_COLUMN_INDEX]);
		    if (aa.length == 10) {
		        dt1 = aa.substr(6,4)+aa.substr(3,2)+aa.substr(0,2);
		    } else {
		        yr = aa.substr(6,2);
		        if (parseInt(yr) < 50) { yr = '20'+yr; } else { yr = '19'+yr; }
		        dt1 = yr+aa.substr(3,2)+aa.substr(0,2);
		    }
		    if (bb.length == 10) {
		        dt2 = bb.substr(6,4)+bb.substr(3,2)+bb.substr(0,2);
		    } else {
		        yr = bb.substr(6,2);
		        if (parseInt(yr) < 50) { yr = '20'+yr; } else { yr = '19'+yr; }
		        dt2 = yr+bb.substr(3,2)+bb.substr(0,2);
			}
		    if (dt1==dt2) return 0;
		    if (dt1<dt2) return -1;
		    return 1;
		},
		ts_sort_currency:function(a,b){
		    aa = tablaPHP.ts_getInnerText(a.cells[tablaPHP.SORT_COLUMN_INDEX]).replace(/[^0-9.]/g,'');
		    bb = tablaPHP.ts_getInnerText(b.cells[tablaPHP.SORT_COLUMN_INDEX]).replace(/[^0-9.]/g,'');
		    return parseFloat(aa) - parseFloat(bb);
		},
		ts_sort_numeric:function (a,b) { 
		    aa = parseFloat(tablaPHP.ts_getInnerText(a.cells[tablaPHP.SORT_COLUMN_INDEX]));
		    if (isNaN(aa)) aa = 0;
		    bb = parseFloat(tablaPHP.ts_getInnerText(b.cells[tablaPHP.SORT_COLUMN_INDEX])); 
		    if (isNaN(bb)) bb = 0;
		    return aa-bb;
		},
		ts_sort_caseinsensitive:function (a,b) {
		    aa = tablaPHP.ts_getInnerText(a.cells[tablaPHP.SORT_COLUMN_INDEX]).toLowerCase();
		    bb = tablaPHP.ts_getInnerText(b.cells[tablaPHP.SORT_COLUMN_INDEX]).toLowerCase();
		    if (aa==bb) return 0;
		    if (aa<bb) return -1;
		    return 1;
		},
		ts_sort_default:function (a,b){
			alert(this);
		    aa = tablaPHP.ts_getInnerText(a.cells[tablaPHP.SORT_COLUMN_INDEX]);
		    bb = tablaPHP.ts_getInnerText(b.cells[tablaPHP.SORT_COLUMN_INDEX]);
		    if (aa==bb) return 0;
		    if (aa<bb) return -1;
		    return 1;
		},
		addEvent:function(elm, evType, fn, useCapture){
		  if (elm.addEventListener){
		    elm.addEventListener(evType, fn, useCapture);
		    return true;
		  } else if (elm.attachEvent){
		    var r = elm.attachEvent("on"+evType, fn);
		    return r;
		  } else {
		    alert("Handler could not be removed");
		  }
		}
		/////////////////////// fin ordenar tabla /////////////////////
};
////////Fuciones para la Clase Tabla1////////////////////
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
function seleccionarChecks(_this,_event,numColumna){
	tabla = _this.parentNode.parentNode.parentNode.parentNode;
	//alert(tabla.nodeName + " : " + _event.ctrlKey + " : " + _event.target + " : " + _event.layerX);
	arrayHB = tabla.childNodes;
//	alert(arrayHB[1].nodeName);
	tbody = arrayHB[1];
	filas =	tbody.getElementsByTagName("tr");
	fila1 = filas[0];
	//alert(fila1.nodeName);
//	alert(tdFila1.length);
	arrayTDs = fila1.getElementsByTagName("td");
	tdPrimerCheck = arrayTDs[numColumna];
	arrayChecks = document.getElementsByName(tdPrimerCheck.firstChild.name);
	tamanio = arrayChecks.length;
		if(_event.ctrlKey)
			for(i=0;i<tamanio;i++)
				arrayChecks[i].checked = !arrayChecks[i].checked;
		else
			for(i=0;i<tamanio;i++)
				arrayChecks[i].checked = _this.checked;
}
//////////////////////////////////////////////////////////////////////////////
tablaPHP.addEvent(window, "load", tablaPHP.sortables_init);
