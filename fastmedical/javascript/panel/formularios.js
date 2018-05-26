/**
*
*  Base64 encode / decode
*  http://www.webtoolkit.info/
*
**/
var pathRequestControl = "../../ccontrol/control/control.php";

var Base64 = {

	// private property
	_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

	// public method for encoding
	encode : function (input) {
		var output = "";
		var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
		var i = 0;

		input = Base64._utf8_encode(input);

		while (i < input.length) {

			chr1 = input.charCodeAt(i++);
			chr2 = input.charCodeAt(i++);
			chr3 = input.charCodeAt(i++);

			enc1 = chr1 >> 2;
			enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
			enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
			enc4 = chr3 & 63;

			if (isNaN(chr2)) {
				enc3 = enc4 = 64;
			}else if (isNaN(chr3)) {
				enc4 = 64;
			}

			output = output +
			this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
			this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

		}

		return output;
	},

	// public method for decoding
	decode : function (input) {
		var output = "";
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;

		input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

		while (i < input.length) {

			enc1 = this._keyStr.indexOf(input.charAt(i++));
			enc2 = this._keyStr.indexOf(input.charAt(i++));
			enc3 = this._keyStr.indexOf(input.charAt(i++));
			enc4 = this._keyStr.indexOf(input.charAt(i++));

			chr1 = (enc1 << 2) | (enc2 >> 4);
			chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
			chr3 = ((enc3 & 3) << 6) | enc4;

			output = output + String.fromCharCode(chr1);

			if (enc3 != 64) {
				output = output + String.fromCharCode(chr2);
			}
			if (enc4 != 64) {
				output = output + String.fromCharCode(chr3);
			}

		}

		output = Base64._utf8_decode(output);

		return output;

	},

	// private method for UTF-8 encoding
	_utf8_encode : function (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";

		for (var n = 0; n < string.length; n++) {

			var c = string.charCodeAt(n);

			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}

		}

		return utftext;
	},

	// private method for UTF-8 decoding
	_utf8_decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;

		while ( i < utftext.length ) {

			c = utftext.charCodeAt(i);

			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}

		}

		return string;
	}

}

function est_cargador(estado){
    switch (estado){
        case 0:{
                $('cargador').style.visibility='hidden';
                break;
        }
        case 1:{$('cargador').style.visibility='visible';
                break;
        }
    }
}
//Esta es la funcion que se ejecuta luego de seleccionar la fila de un trabajador del buscador antiguo
function selItem(c){
    CargarVentana('buscador4','Nuevo Usuario del Sistema','../../ccontrol/control/control.php?p1=MostrarPersona&idformula=&estado=nuevo&c='+c,'500','300',false,true,'',1,'',10,10,10,10);
}
//Esta funcion es para guardar un usuario del buscador antiguo
function guardaUsuario(){
    var url = '../../ccontrol/control/control.php';
    habilitado=document.nuevo_usuario.habilitado_usuario.checked;
    if(habilitado==true || habilitado==1){
        habilitado=1;
    }
    else{
        habilitado=0;
    }
    var data = 'p1=GuardaNuevoUsuario&' + $('nuevo_usuario').serialize() + '&habilitado_usuario=' + habilitado;

    if($('estado').value=='nuevo'){
        new Ajax.Request (url,
                            {method      : 'get',
                                parameters  : data,
                                onLoading   : function(transport){est_cargador(1);},
                                onComplete  : function(transport){est_cargador(0);
                                            alert(transport.responseText);
                                            Windows.close("Div_buscador4");
                                            mostrarEmpleadosPorRegistrar();
                                            }
                            }
                         )
    }
    else
        if($('estado').value=='editar'){
            new Ajax.Request (url,
                                {method      : 'get',
                                    parameters  : data,
                                    onLoading   : function(transport){est_cargador(1);},
                                    onComplete  : function(transport){est_cargador(0);
                                                alert(transport.responseText);
                                                Windows.close("Div_buscador4");
                                                usuariosDHabAjax();
                                                }
                                }
                             )
        }
}

function mostrarEmpleadosPorRegistrar(){
    ctrlBuscador = $("hdnCtrlBuscador").value;
    idSistema = $("idSistema").value;
    opcion = $("hdnOpcionBusqueda").value;
    
    if(opcion==1){
        apPat=$("txtPatron").value;
        apMat=$("txtPatron2").value;
        nombre=$("txtPatron3").value;
        if(apPat==$("txtPatron").defaultValue){
            apPat='';
        }
        if(apMat==$("txtPatron2").defaultValue){
            apMat='';
        }
        if(nombre==$("txtPatron3").defaultValue){
            nombre='';
        }
        patron=apPat+"|"+apMat+"|"+nombre;
    }
    else{
        patron=$("txtPatron").value;
    }
    path="../../ccontrol/control/control.php?p1="+ctrlBuscador+"&p2="+idSistema+"&p3="+opcion+"&p4="+patron;
    myajax.Link(path,'divResultadoBusquedaPersonas');
}

function actualizaPwd(){
    $('estado').value='recpwd';
    guardaUsuario();
}

function formateaOpcionBuscadorPersona(opc){
    switch (opc){
            case 'nombre':{
                    textEtiqueta = "AP. PAT: ";
                    $('txtPatron').value="Buscar...";
                    $('txtPatron').focus();
                    $('lblPatron2').style.visibility="visible";
                    $('txtPatron2').style.visibility="visible";
                    $('txtPatron2').value="Buscar...";
                    $('lblPatron3').style.visibility="visible";
                    $('txtPatron3').style.visibility="visible";
                    $('txtPatron3').value="Buscar...";
                    $('hdnOpcionBusqueda').value=1;
                    break;
            }
            case 'documento':{
                    textEtiqueta = "DOCUMENTO: ";
                    $('txtPatron').value="Buscar...";
                    $('txtPatron').focus();
                    $('lblPatron2').style.visibility="hidden";
                    $('txtPatron2').style.visibility="hidden";
                    $('lblPatron3').style.visibility="hidden";
                    $('txtPatron3').style.visibility="hidden";
                    $('hdnOpcionBusqueda').value=2;
                    break;
            }
            case 'codigo':{
                    textEtiqueta = "CODIGO: ";
                    $('txtPatron').value="Buscar...";
                    $('txtPatron').focus();
                    $('lblPatron2').style.visibility="hidden";
                    $('txtPatron2').style.visibility="hidden";
                    $('lblPatron3').style.visibility="hidden";
                    $('txtPatron3').style.visibility="hidden";
                    $('hdnOpcionBusqueda').value=3;
                    break;
            }
    }
    document.getElementById("lblPatron").textContent = textEtiqueta;
}

function getBusquedaPersona(event){
    e = event;
    if(e.keyCode == 13){
        ctrlBuscador = $("hdnCtrlBuscador").value;
        idSistema = $("idSistema").value;
        opcion = $("hdnOpcionBusqueda").value;

        if(opcion==1){
            apPat=$("txtPatron").value;
            apMat=$("txtPatron2").value;
            nombre=$("txtPatron3").value;
            if(apPat==$("txtPatron").defaultValue){
                apPat='';
            }
            if(apMat==$("txtPatron2").defaultValue){
                apMat='';
            }
            if(nombre==$("txtPatron3").defaultValue){
                nombre='';
            }
            patron=apPat+"|"+apMat+"|"+nombre;
        }
        else{
            patron=$("txtPatron").value;
        }
        path="../../ccontrol/control/control.php?p1="+ctrlBuscador+"&p2="+idSistema+"&p3="+opcion+"&p4="+patron;
        myajax.Link(path,'divResultadoBusquedaPersonas');
    }
}
//Se usa para cambiar estado de habilitado de usuarios
//a: $ophabilita, b: iid_usuario, c: $id_sistema
function even_panel(op,a,b,c){
    switch (op){
        case 1:	{//Para deshabilitar un usuario habilitado
            var url = '../../ccontrol/control/control.php';
            var data = 'p1=HabUsuario&p2='+a+'&p3='+b+'&p4='+c;
            //var habi = a=='t'?'HABILITADO':'DESHABILITADO';
            var habi = a==1?'HABILITADO':'DESHABILITADO';
            var ask = confirm('El Usuario: '+b+' va a ser '+habi+' \xBFDesea Continuar?');
            if(ask){
                new Ajax.Request ( url,
                    {method      : 'get',
                        parameters  : data,
                        onLoading   : function(transport){est_cargador(1);},
                        onComplete  : function(transport){est_cargador(0);
                                        alert('Usuario:'+b+' fue '+habi);
                                        usuariosDHabAjax();
                                      }
                    }
                )
            }
            break;
        }
        /*case 2:	{
                textEtiqueta = "DOCUMENTO : ";
                $("p3").className = "textPatronCodigo";
                $("p3").value = "Buscar...";
                $("p2").value = 2;
                break;
        }
        case 3:	{
                textEtiqueta = "CODIGO : ";
                $("p3").className = "textPatronCodigo";
                $("p3").value = "Buscar...";
                $("p2").value = 3;
                break;
        }*/
    }
}
//Para buscar usuarios deshabilitados
function usuariosDHab(event){
    e = event;
    if(e.keyCode == 13){
        usuariosDHabAjax();
    }
}
function usuariosDHabAjax(){
    parametros=$('frm_usuarios').serialize();
    path="../../ccontrol/control/control.php"+"?"+parametros;
    myajax.Link(path,'div_usuario');
}
//Cargar arbol de opciones de menu del SIMEDH
function cargaPaginaArbol(idsis){
    var url = '../../cvista/permisos/arbol.php';
    var data = 'idsistema='+idsis;
    new Ajax.Request (url,
                        {method        : 'get',
                          parameters    : data,
                          onLoading	: function(transport){est_cargador(1);},
                          onComplete	: function(transport){est_cargador(0);
                                        $('contenido_inicio').innerHTML=transport.responseText;
                                        listFormTree();
                                        }
                        }
                     )
}
//Cargar arbol de opciones de menu del SIMEDH
function listFormTree(){
    var idsis = $('idsistema').value;
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=listFormTree&idsistema='+idsis;
    new Ajax.Request (url,
                        {method        : 'get',
                          parameters 	: data,
                          onLoading	: function(transport){est_cargador(1);},
                          onComplete	: function(transport){est_cargador(0);
                                        eval(transport.responseText);
                                        }
                        }
                     )
}
//Evento del menu arbol
function eventoMenuArbol(m,n){
    var idsis = $('idsistema').value;
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=datosMenuItem&idsistema='+idsis+'&idformulario='+n;
    new Ajax.Request (url,
                        {method	: 'get',
                          parameters 	: data,
                          onLoading	: function(transport){est_cargador(1);},
                          onComplete	: function(transport){est_cargador(0);
                                        $('div_con_arb').innerHTML=transport.responseText;
                                        }
                        }
                     )
}
function eventoSubMenuArbol(m,n,o){
    o = parseInt(o)+1;
    var idsis = $('idsistema').value;
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=datosSubMenuItem&idsistema='+idsis+'&idformulario='+n+'&nivel_formulario='+o+'&depende_formulario='+n;
    new Ajax.Request ( url,
                        {method        : 'get',
                          parameters 	: data,
                          onLoading	: function(transport){est_cargador(1);},
                          onComplete	: function(transport){est_cargador(0);
                                        $('div_edt_arb').innerHTML=transport.responseText;
                                        }
                        }
                     )
}
//Agregar nueva opcion de menu en el arbol
function nuevoMenuArbol(){
    var idsis = $('idsistema').value;
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=nuevoMenuItem&idsistema='+idsis+'&'+$('form_padre').serialize();
    new Ajax.Request ( url,
                        {method      : 'get',
                          parameters  : data,
                          onLoading   : function(transport){est_cargador(1);},
                          onComplete  : function(transport){est_cargador(0);
                                        $('div_edt_arb').innerHTML=transport.responseText;
                                        }
                        }
                     )
}

/*****************************************Permisos-Perfiles********************************************/
function buscarFormularioDePerfil(){
    var idSistema = $('idsistema').value;
    //var idPerfil = $('cbo_filtroPerfil').value;
    var idPerfil = $('idperfil').value;
    //var indice = document.form_detalle.cbo_filtroPerfil.selectedIndex;
    $('chk_activo').checked=false;//Reseteamos el check de formularios activos
    if(idPerfil==0){//O idPerfil == '0000'
        alert('Seleccione un perfil antes de realizar esta operaci\xF3n');
    }
    else{
        var url = '../../ccontrol/control/control.php';
        var patron=$('nombre_formulario_perfil').value;
        var data = 'p1=listaDetallePerfil&activo=2&idsistema='+idSistema+'&idperfil='+idPerfil+'&patron='+patron;
        //$('chk_activo').checked=false;//Reseteamos el check de formularios activos

        new Ajax.Request ( url,
                            {method      : 'get',
                              parameters  : data,
                              onLoading   : function(transport){est_cargador(1);},
                              onComplete  : function(transport){est_cargador(0);
                                            $('contenido_detalle').innerHTML=transport.responseText;
                                            }
                            }
                         )
        
    }
}

function mostrarFormulariosActivosDePerfil(){
    idsis = $('idsistema').value;
    //idPerfil = $('cbo_filtroPerfil').value;
    idPerfil = $('idperfil').value;
    url = '../../ccontrol/control/control.php';
    //data = 'p1=listaDetallePerfil&idsistema='+idsis+'&idperfil='+idPerfil;
    
    if(idPerfil=='0'){
        alert('Seleccione un perfil antes de realizar esta operaci\xF3n');
        $('chk_activo').checked=false;
    }
    else{
        if($('chk_activo').checked==true){
            //alert('Se selecciono activos');
            data = 'p1=listaDetallePerfil&activo=1&idsistema='+idsis+'&idperfil='+idPerfil;
        }
        else{
            //alert('No selecciono :X');
            data = 'p1=listaDetallePerfil&activo=2&idsistema='+idsis+'&idperfil='+idPerfil;
        }
        new Ajax.Request ( url,
                            {method      : 'get',
                              parameters  : data,
                              onLoading   : function(transport){est_cargador(1);},
                              onComplete  : function(transport){est_cargador(0);
                                                $('contenido_detalle').innerHTML=transport.responseText;
                                                $('nombre_formulario_perfil').value='';
                                                $('nombre_formulario_perfil').focus();
                                            }
                            }
                         )
    }
}
//Esto es del combo antiguo de perfiles
function mostrarPerfil(){//Luego de la seleccion de un perfil del combo
    var idsis = $('idsistema').value;
    //var idPerfil = document.getElementById('cbo_filtroPerfil').value;
    var idPerfil = $('cbo_filtroPerfil').value;
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=listaDetallePerfil&idsistema='+idsis+'&idperfil='+idPerfil;
    
    $("idperfil").value = idPerfil;
    $('chk_activo').checked=false;//Reseteamos el check de formularios activos
    new Ajax.Request ( url,
                        {method      : 'get',
                          parameters  : data,
                          onLoading   : function(transport){est_cargador(1);},
                          onComplete  : function(transport){est_cargador(0);
                                        $('contenido_detalle').innerHTML=transport.responseText;
                                        $('nombre_formulario_perfil').value='';//Limpiamos el text buscador de formularios de perfil
                                        $('nombre_formulario_perfil').focus();
                                        }
                        }
                     )
}
//Para nuevo perfil
function mantePerfil(accion){
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=mantePerfil&'+$('mante_perfil').serialize()+'&accion='+accion;
    new Ajax.Request (url,
                        {method      : 'get',
                            parameters  : data,
                            onLoading   : function(transport){est_cargador(1);},
                            onComplete  : function(transport){est_cargador(0);
                                        alert(transport.responseText);
                                        Windows.close("Div_popupMantePerfil");
                                        myajax.Link('../../cvista/permisos/perfiles.php?id_sistema='+$('idsistema').value+'&id_formulario='+$('idformulario').value,'contenido_inicio');
                                        }
                        }
                     )
}

function seleccionarPerfil(){
    //detallePuestoEmpleado('','','');
    titulo='Busqueda...';
    vFormaAbrir='VENTANA';
    vformname='busquedaPuestosPorCentroCosto';
    vtitle='Búsqueda de Puestos Laborales por Centro de Costos';
    vwidth='800';
    vheight='400';
    vcenter='t';
    vresizable='';
    vmodal='false';
    vstyle='';
    vopacity='';
    veffect='';
    vposx1='';
    vposx2='';
    vposy1='';
    vposy2='';
    file01='';
    vfunctionjava='';

    patronModulo='agregarPuestoEmpleado';
    parametros='';
    parametros+='p1='+patronModulo;
    posFuncion='cargarArbolPop';

    CargarVentanaPopPap(vformname,vtitle,vwidth,vheight,vcenter,vresizable,vmodal,vstyle,vopacity,vposx1,vposx2,vposy1,vposy2,parametros,posFuncion)
}

function CargarVentanaPopPap(vformname,vtitle,vwidth,vheight,vcenter,vresizable,vmodal,vstyle,vopacity,vposx1,vposx2,vposy1,vposy2,parametros,posFuncion)
{
	myRand = parseInt(Math.random()*999999999999999);
	if(vwidth==undefined || vwidth==0) vwidth=700;
	if(vheight==undefined || vheight==0) vheight=400;
	if(vposx1==undefined || vposx1==0) vposx1=25;
	if(vposy1==undefined || vposy1==0) vposy1=110;
	if(vposx2==undefined || vposx2==0) vposx2=25;
	if(vposy2==undefined || vposy2==0) vposy2=110;

	if(vresizable==undefined || vresizable==0) vresizable=true;else vresizable=false;
	if(vstyle==undefined || vstyle==0) vstyle="alphacube";   // fondo y estilo
	//if(veffect==veffect || veffect==0) veffect="popup_effect";
	if(vmodal==undefined || vmodal==0) vmodal=false;else vmodal=true;
	if(vopacity==undefined || vopacity==0) vopacity=1;
	if(vcenter==undefined || vcenter==0 || vcenter == 't') vcenter=true; else vcenter=false;
	if(vtitle==undefined) vtitle=vformname;
	  if(!ExisteObjeto("Div_"+vformname))
		  {var vidfrm;
                   // file02=decodeURIComponent(file02);
                    var vid="Div_"+vformname;
                    vidfrm="Frm_"+vformname;
                    var vzindex = 100;
                    var win;
                      if(vmodal==true || vmodal==1)
                      win = new Window({id: vid, className: vstyle, title:vtitle, width:vwidth, height:vheight, zIndex:vzindex, opacity:vopacity, resizable: vresizable});
                      else
                      win = new Window({id: vid, className: vstyle, title:vtitle, width:vwidth, height:vheight, resizable: vresizable});
                      win.getContent().innerHTML = "<div id='"+vidfrm+"' align='center'></div>";
                      //win.getContent().innerHTML = "<h1>No Constraint</h1>Wired mode<br><a href='#' onclick='Windows.getWindow(\"win3\").maximize()'>Maximize me</a>";
                      win.setDestroyOnClose();
                      if(vcenter==true || vcenter==1)
                              win.showCenter(vmodal);
                      else
                              win.show(vmodal);
                      win.setConstraint(true, {left:vposx1, right:vposx2, top: vposy1, bottom:'auto'})
                      win.toFront();

                   new Ajax.Request(pathRequestControl,
                                        {
                                            method : 'get',
                                            parameters : parametros,
                                            //onLoading : micargador(1),
                                            onComplete : function(transport){
                                                            //micargador(0);
                                                            respuesta = transport.responseText;
                                                            $(vidfrm).update(respuesta);
                                                            posFuncion+="('')";
                                                            eval(posFuncion);
                                                        }
                                        }
                                    )
		  }
}

function cargarArbolPop(){
    funcion='funcionVerPuestos';
    recargarArbolCCostosPuestos(funcion);
}

function recargarArbolCCostosPuestos(funcion){
    myDiv=document.getElementById('divOpcCCostos');
    myDiv.innerHTML = " ";
    tree2=new dhtmlXTreeObject("divOpcCCostos","100%","100%",0);
    tree2.setImagePath("../../../../fastmedical_front/imagen/icono/tree/");
    tree2.attachEvent("onClick", function(){
              
            funcionArbol(funcion,tree2.getSelectedItemId());
            return true;
        })
    //tree2.setXMLAutoLoading("../../../javascript/xml/tree_oficinas.xml");
    tree2.loadXML("../../../../carpetaDocumentos/arbol_centroCostos.xml");
    tree2.openAllItems(1);
}

function funcionArbol(funcion,id){
    textofuncion=funcion+"('"+id+"')";
    eval(textofuncion);
    //seleccionCentroCostos(id)
}

function funcionVerPuestos(id){
    verPuestos(id,'','mostrarFormularioDePerfil');
    //seleccionarCentroCostoPuesto(id);
}

function verPuestos(id,event,funcion){
        if(id=='x'){
            ccosto=1
        }else{
            document.getElementById('hCcosto').value=id;
            ccosto=id;
            document.getElementById('txtPuesto').value='Buscar...';
        }
        puesto=document.getElementById('txtPuesto').value;
        if(puesto=='Buscar...'){
            puesto='';
        }
        estado=$('comboEstados').value;
        categoria=document.getElementById('comboCategoriaPuestos').value
        patronModulo = "puestosxCCostos";
        parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+ccosto;
        parametros+='&p3='+puesto;
        parametros+='&p4='+categoria;
        parametros+='&p5='+estado;
        parametros+='&p6='+funcion;
        if(event==''){
            tecla=13;
        }else{
            tecla=event.keyCode
        }
        if(tecla==13){
            new Ajax.Request(pathRequestControl,
                                {
                                    method : 'get',
                                    parameters : parametros,
                                    //onLoading : micargador(1),
                                    onComplete : function(transport){
                                                    //micargador(0);
                                                    respuesta = transport.responseText;
                                                    $('divResultadoPuestosCCostos').update(respuesta);
                                                    //limpiarDetallePuesto();
                                                    //$('imagenEditar').hide();
                                                }
                                }
                            )
        }
}

function mostrarFormularioDePerfil(elemento, evento, idPuesto){
    //iidPuesto=iid_perfil
    Windows.close("Div_busquedaPuestosPorCentroCosto", '');
    var idsis = $('idsistema').value;
    //var idPerfil = $('cbo_filtroPerfil').value;
    var idPerfil = idPuesto;
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=listaDetallePerfil&idsistema='+idsis+'&idperfil='+idPerfil;

    //alert("Hola Mundo: "+idPerfil+" "+idsis);
    $("idperfil").value = idPerfil;
    $('chk_activo').checked=false;//Reseteamos el check de formularios activos
    new Ajax.Request ( url,
                        { method      : 'get',
                          parameters  : data,
                          onLoading   : function(transport){est_cargador(1);},
                          onComplete  : function(transport){est_cargador(0);
                                            $('contenido_detalle').innerHTML=transport.responseText;
                                            $('nombre_formulario_perfil').value='';//Limpiamos el text buscador de formularios de perfil
                                            $('nombre_formulario_perfil').focus();
                                            $('idperfil').value=idPerfil;
                                            getNombrePerfil(idsis,idPerfil);
                                        }
                        }
                     )
}

function getNombrePerfil(idsistema,idperfil){
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=getNombrePerfil&idsistema='+idsistema+'&idperfil='+idperfil;
    new Ajax.Request ( url,
                        {
                          method      : 'get',
                          parameters  : data,
                          onLoading   : function(transport){est_cargador(1);},
                          onComplete  : function(transport){est_cargador(0);
                                            $('txtNombrePerfil').value=transport.responseText;
                                        }
                        }
                     )
}
//Sólo para perfiles del panel web
function nuevoPerfil(){
    var idSistema = $('idsistema').value;
    CargarVentana('popupMantePerfil','Registro de Perfiles','../permisos/mantePerfil.php?accion=insertar&id_sistema='+idSistema,'305','180',false,true,'',1,'',10,10,10,10);
}
//Sólo para perfiles del panel web
function editarPerfil(){
    var idSistema = $('idsistema').value;
    var idPerfil = $('cbo_filtroPerfil').value;
    var indice = document.form_detalle.cbo_filtroPerfil.selectedIndex;
    var nomPerfil = document.form_detalle.cbo_filtroPerfil.options[indice].text;
    
    if(indice==0){//O idPerfil == '0000'
        alert('Seleccione un perfil antes de realizar esta operaci\xF3n');
        //$('chk_activo').checked=false;
    }
    else{
        CargarVentana('popupMantePerfil','Registro de Perfiles','../permisos/mantePerfil.php?accion=actualizar&id_sistema='+idSistema+'&p2='+idPerfil+'&p3='+nomPerfil,'305','180',false,true,'',1,'',10,10,10,10);
    }
}

function eliminarPerfil(accion){
    var idSistema = $('idsistema').value;
    var idPerfil = $('cbo_filtroPerfil').value;
    var indice = document.form_detalle.cbo_filtroPerfil.selectedIndex;
    var nomPerfil = document.form_detalle.cbo_filtroPerfil.options[indice].text;

    if(indice==0){//O idPerfil == '0000'
        alert('Seleccione un perfil antes de realizar esta operaci\xF3n');
        //$('chk_activo').checked=false;
    }
    else{
        if(confirm("\xBFEst\xE1 seguro que desea eliminar el perfil: "+nomPerfil+"?")){
            var url = '../../ccontrol/control/control.php';
            var data = 'p1=mantePerfil&idSistema='+idSistema+'&idPerfil='+idPerfil+'&accion='+accion;
            new Ajax.Request ( url,
                                {method      : 'get',
                                  parameters  : data,
                                  onLoading   : function(transport){est_cargador(1);},
                                  onComplete  : function(transport){est_cargador(0);
                                                alert(transport.responseText);
                                                myajax.Link('../../cvista/permisos/perfiles.php?id_sistema='+$('idsistema').value+'&id_formulario='+$('idformulario').value,'contenido_inicio');
                                                }
                                }
                             )
        }
    }
}

function habFormDePerfil(idForm, nomForm, estado){
    idsis = $('idsistema').value;
    idperf = $("idperfil").value;
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=habFormDePerfil&p2='+idsis+'&p3='+idperf+'&p4='+idForm+'&p5='+estado;
    var habi = estado==1?'DESHABILITADO':'HABILITADO';
    var ask = confirm('El Formulario: '+nomForm+' va a ser '+habi+' \xBFDesea Continuar?');
    if(ask){
        new Ajax.Request ( url,
            {method      : 'get',
                parameters  : data,
                onLoading   : function(transport){est_cargador(1);},
                onComplete  : function(transport){est_cargador(0);
                                alert('Formulario: '+nomForm+' fue '+habi);
                                actFormDePerfil();
                              }
            }
        )
    }
}
function actFormDePerfil(){
    var idsis = $('idsistema').value;
    var idPerfil = $("idperfil").value;
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=listaDetallePerfil&idsistema='+idsis+'&idperfil='+idPerfil;
    $('chk_activo').checked=false;//Reseteamos el check de formularios activos
    new Ajax.Request ( url,
                        {method      : 'get',
                          parameters  : data,
                          //onLoading   : function(transport){est_cargador(1);},
                          onComplete  : function(transport){//est_cargador(0);
                                        $('contenido_detalle').innerHTML=transport.responseText;
                                        $('nombre_formulario_perfil').value='';//Limpiamos el text buscador de formularios de perfil
                                        $('nombre_formulario_perfil').focus();
                                        }
                        }
                     )
}
//Mostrar Perfil-Formulario-Servicio
function mostrarPerfilFormularioServicio(idsistema,idperfil,idformulario,nomformulario){
    CargarVentana('popupPerfilFormularioServicio','Formulario: '+nomformulario,'../permisos/perfilFormularioServicio.php?p2='+idsistema+'&p3='+idperfil+'&p4='+idformulario,'900','400',false,true,'',1,'',10,10,10,10);
}
//Habilitar-Deshabilitar servicio de formulario de perfil
function habServDePerfil(idsistema,idperfil,idformulario,idservicio,nomserv,estado){
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=habServDePerfil&p2='+idsistema+'&p3='+idperfil+'&p4='+idformulario+'&p5='+idservicio+'&p6='+estado;
    var habi = estado==1?'DESHABILITADO':'HABILITADO';
    var ask = confirm('El Servicio: '+nomserv+' va a ser '+habi+' \xBFDesea Continuar?');
    if(ask){
        new Ajax.Request ( url,
            {method      : 'get',
                parameters  : data,
                onLoading   : function(transport){est_cargador(1);},
                onComplete  : function(transport){est_cargador(0);
                                alert('Servicio: '+nomserv+' fue '+habi);
                                actPerfilFormularioServicio(idsistema,idperfil,idformulario);
                              }
            }
        )
    }
}
//Refresca los servicios de formulario de perfil mostrados
function actPerfilFormularioServicio(idsistema,idperfil,idformulario){
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=listaPerfFormServ&p2='+idsistema+'&p3='+idperfil+'&p4='+idformulario;
    new Ajax.Request ( url,
                        {method      : 'get',
                          parameters  : data,
                          //onLoading   : function(transport){est_cargador(1);},
                          onComplete  : function(transport){//est_cargador(0);
                                        $('divPerfilFormularioServicio').innerHTML=transport.responseText;
                                        }
                        }
                      )
}
/*
function mostrarServDePerfil(){
    var idsis = $('idsistema').value;
    var idPerfil = $("idperfil").value;
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=listaDetallePerfil&idsistema='+idsis+'&idperfil='+idPerfil;
    $('chk_activo').checked=false;//Reseteamos el check de formularios activos
    new Ajax.Request ( url,
                        {method      : 'get',
                          parameters  : data,
                          //onLoading   : function(transport){est_cargador(1);},
                          onComplete  : function(transport){//est_cargador(0);
                                        $('contenido_detalle').innerHTML=transport.responseText;
                                        }
                        }
                     )
}*/



/*************************Permisos-Permisos**************************/
function buscarFormularioDePermiso(){
    var idSistema = $('idsistema').value;
    var idPersona = $('idpersona').value;
    var patron=$('nombre_formulario_permiso').value;
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=listaDetallePermiso&p2='+idSistema+'&p3='+idPersona+'&patron='+patron;
    new Ajax.Request ( url,
                        {method      : 'get',
                          parameters  : data,
                          onLoading   : function(transport){est_cargador(1);},
                          onComplete  : function(transport){est_cargador(0);
                                        $('contenido_detalle').innerHTML=transport.responseText;
                                        }
                        }
                     )
}
//Funcion que se ejecuta luego de seleccionar la fila de un usuario de permiso
function selUsuario(datosUsuario){
    datos = datosUsuario.split("-");
    idPersona = datos[0];
    loginUsuario = datos[1];
    idSistema=$('idSistema').value;//idSistema de la ventana de buscador de personas
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=listaDetallePermiso&p2=' + idSistema + '&p3=' + idPersona;
    new Ajax.Request (url,
                        {method      : 'get',
                            parameters  : data,
                            onLoading   : function(transport){est_cargador(1);},
                            onComplete  : function(transport){est_cargador(0);
                                        Windows.close("Div_buscador3");
                                        $('contenido_detalle').innerHTML=transport.responseText;
                                        $('login_usuario').value=loginUsuario;
                                        $('idpersona').value=idPersona;
                                        $('nombre_formulario_permiso').value='';
                                        $('nombre_formulario_permiso').focus();
                                        }
                        }
                     )
}

function habFormDePermiso(idForm, nomForm, estado){
    idSistema = $('idsistema').value;
    idPersona = $('idpersona').value;
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=habFormDePermiso&p2='+idSistema+'&p3='+idPersona+'&p4='+idForm+'&p5='+estado;
    var habi = estado==1?'DESHABILITADO':'HABILITADO';
    var ask = confirm('El Formulario: '+nomForm+' va a ser '+habi+' \xBFDesea Continuar?');
    if(ask){
        new Ajax.Request ( url,
            {method      : 'get',
                parameters  : data,
                onLoading   : function(transport){est_cargador(1);},
                onComplete  : function(transport){est_cargador(0);
                                alert('Formulario: '+nomForm+' fue '+habi);
                                actFormDePermiso(idSistema,idPersona);
                              }
            }
        )
    }
}
//Refresca los formularios de permiso de un usuario
function actFormDePermiso(idSistema,idPersona){
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=listaDetallePermiso&p2='+idSistema+'&p3='+idPersona;
    //$('chk_activo').checked=false;//Reseteamos el check de formularios activos
    new Ajax.Request ( url,
                        {method      : 'get',
                          parameters  : data,
                          //onLoading   : function(transport){est_cargador(1);},
                          onComplete  : function(transport){//est_cargador(0);
                                        $('contenido_detalle').innerHTML=transport.responseText;
                                        $('nombre_formulario_permiso').value='';
                                        $('nombre_formulario_permiso').focus();
                                        }
                        }
                     )
}

function mostrarPermisoFormServ(idsistema,idpersona,idformulario,nomformulario){
    CargarVentana('popupPermisoFormularioServicio','Formulario: '+nomformulario,'../permisos/permisoFormularioServicio.php?p2='+idsistema+'&p3='+idpersona+'&p4='+idformulario,'900','400',false,true,'',1,'',10,10,10,10);
}
//Habilitar-Deshabilitar servicio de formulario de permiso
function habServDePermiso(idsistema,idpersona,idformulario,idservicio,nomserv,estado){
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=habServDePermiso&p2='+idsistema+'&p3='+idpersona+'&p4='+idformulario+'&p5='+idservicio+'&p6='+estado;
    var habi = estado==1?'DESHABILITADO':'HABILITADO';
    var ask = confirm('El Servicio: '+nomserv+' va a ser '+habi+' \xBFDesea Continuar?');
    if(ask){
        new Ajax.Request ( url,
            {method      : 'get',
                parameters  : data,
                onLoading   : function(transport){est_cargador(1);},
                onComplete  : function(transport){est_cargador(0);
                                alert('Servicio: '+nomserv+' fue '+habi);
                                actPermisoFormServ(idsistema,idformulario,idpersona);
                              }
            }
        )
    }
}

function actPermisoFormServ(idsistema,idformulario,idpersona){
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=listaPermisoFormServ&p2='+idsistema+'&p3='+idformulario+'&p4='+idpersona;
    //$('chk_activo').checked=false;//Reseteamos el check de formularios activos
    new Ajax.Request ( url,
                        {method      : 'get',
                          parameters  : data,
                          //onLoading   : function(transport){est_cargador(1);},
                          onComplete  : function(transport){//est_cargador(0);
                                        $('divPermisoFormularioServicio').innerHTML=transport.responseText;
                                        }
                        }
                     )
}

/*************************Herramientas-Formularios**************************/
//Buscar formulario en campo de texto
function buscarFormulario(){
    idSistema = document.getElementById("idSistema").value;
    patron = $("nombre_formulario").value;
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=listaDetalleFormulario&p2='+idSistema+'&patron='+patron;
    new Ajax.Request ( url,
                        {method      : 'post',
                          parameters  : data,
                          onLoading   : function(transport){est_cargador(1);},
                          onComplete  : function(transport){est_cargador(0);
                                        $('contenido_detalle').innerHTML=transport.responseText;
                                        }
                        }
                     )
}
//Actualiza tabla de formularios mostrados
function actFormulario(idsistema){
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=listaDetalleFormulario&p2='+idsistema;
    new Ajax.Request (url,
                        {method      : 'get',
                            parameters  : data,
                            onLoading   : function(transport){est_cargador(1);},
                            onComplete  : function(transport){est_cargador(0);
                                        $('contenido_detalle').innerHTML=transport.responseText;
                                        $("nombre_formulario").value='';
                                        $("nombre_formulario").focus();
                                        }
                        }
                     )
}

function manteFormulario(accion){
    idSistema=$('idSistema').value;
    var url = '../../ccontrol/control/control.php';
    idForm=$('idForm').value;
    nomForm=String($('nomForm').value);
    fileForm=String($('fileForm').value);
    descForm=$('descForm').value;
    nivelForm=$('nivelForm').value;
    imgForm=$('imgForm').value;
    ordenForm=$('ordenForm').value;
    abrirForm=$('abrirForm').value;
    habForm=$('habForm').value;
    finalForm=$('finalForm').value;
    dependeForm=$('dependeForm').value;
    
    datos=idSistema+"|"+idForm+"|"+nomForm+"|"+fileForm+"|"+descForm+"|"+nivelForm+"|"+imgForm+"|"+ordenForm+"|"+abrirForm+"|"+habForm+"|"+finalForm+"|"+dependeForm;
    datos = datos.replace(/'/gi,"\'\'");
    datos = Base64.encode(datos);

    //var data = 'p1=manteFormulario&'+$('mante_formulario').serialize()+'&accion='+accion;
    var data = 'p1=manteFormulario&datos='+datos+'&accion='+accion;
    new Ajax.Request (url,
                        {method      : 'post',
                            parameters  : data,
                            onLoading   : function(transport){est_cargador(1);},
                            onComplete  : function(transport){est_cargador(0);
                                        alert(transport.responseText);
                                        Windows.close("Div_popupManteFormulario");
                                        actFormulario(idSistema);
                                        }
                        }
                     )
}

function eliminarFormulario(accion,idFormulario){
    idSistema=$('idSistema').value;
    if(confirm("\xBFEst\xE1 seguro que desea eliminar el formulario?")){
        var url = '../../ccontrol/control/control.php';
        var data = 'p1=manteFormulario&idSistema='+idSistema+'&idForm='+idFormulario+'&accion='+accion;
        new Ajax.Request ( url,
                            {method      : 'get',
                              parameters  : data,
                              onLoading   : function(transport){est_cargador(1);},
                              onComplete  : function(transport){est_cargador(0);
                                            alert(transport.responseText);
                                            actFormulario(idSistema);
                                            }
                            }
                         )
    }
}
//function mostrarFormServ(idForm,nomServ){
function mostrarFormServ(idsistema,idformulario,nomformulario){
    CargarVentana('popupFormularioServicio','Formulario: '+nomformulario,'../herramientas/formularioServicio.php?p2='+idsistema+'&p3='+idformulario,'900','400',false,true,'',1,'',10,10,10,10);
}
//Habilitar-Deshabilitar servicio de formulario
function habServDeForm(idsistema,idformulario,idservicio,nomserv,estado){
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=habServDeForm&p2='+idsistema+'&p3='+idformulario+'&p4='+idservicio+'&p5='+estado;
    var habi = estado==1?'DESHABILITADO':'HABILITADO';
    var ask = confirm('El Servicio: '+nomserv+' va a ser '+habi+' \xBFDesea Continuar?');
    if(ask){
        new Ajax.Request ( url,
            {method      : 'get',
                parameters  : data,
                onLoading   : function(transport){est_cargador(1);},
                onComplete  : function(transport){est_cargador(0);
                                alert('Servicio: '+nomserv+' fue '+habi);
                                actFormServ(idsistema,idformulario);
                              }
            }
        )
    }
}

function actFormServ(idsistema,idformulario){
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=listaFormServ&p2='+idsistema+'&p3='+idformulario;
    new Ajax.Request ( url,
                        {method      : 'get',
                          parameters  : data,
                          //onLoading   : function(transport){est_cargador(1);},
                          onComplete  : function(transport){//est_cargador(0);
                                        $('divFormularioServicio').innerHTML=transport.responseText;
                                        }
                        }
                     )
}

/*************************Herramientas-Servicios**************************/
//Buscar servicio en campo de texto
function buscarServicio(){
    control = "listaDetalleServicio";
    patron = $("nombre_servicio").value;
    var url = '../../ccontrol/control/control.php';
    var data = 'p1='+control+'&p2='+patron;
    new Ajax.Request ( url,
                        {method      : 'post',
                          parameters  : data,
                          onLoading   : function(transport){est_cargador(1);},
                          onComplete  : function(transport){est_cargador(0);
                                        $('contenido_detalle').innerHTML=transport.responseText;
                                        }
                        }
                     )
}

function mostrarServicio(){
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=listaDetalleServicio';
    new Ajax.Request (url,
                        {method      : 'get',
                            parameters  : data,
                            onLoading   : function(transport){est_cargador(1);},
                            onComplete  : function(transport){est_cargador(0);
                                        $('contenido_detalle').innerHTML=transport.responseText;
                                        $("nombre_servicio").value='';
                                        $("nombre_servicio").focus();
                                        }
                        }
                     )
}

function manteServicio(accion){
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=manteServicio&'+$('mante_servicio').serialize()+'&accion='+accion;
    new Ajax.Request (url,
                        {method      : 'get',
                            parameters  : data,
                            onLoading   : function(transport){est_cargador(1);},
                            onComplete  : function(transport){est_cargador(0);
                                        alert(transport.responseText);
                                        Windows.close("Div_popupManteServicio");
                                        mostrarServicio();
                                        }
                        }
                     )
}

function eliminarServicio(accion,idServicio){
    if(confirm("\xBFEst\xE1 seguro que desea eliminar el servicio?")){
        var url = '../../ccontrol/control/control.php';
        var data = 'p1=manteServicio&idServicio='+idServicio+'&accion='+accion;
        new Ajax.Request ( url,
                            {method      : 'get',
                              parameters  : data,
                              onLoading   : function(transport){est_cargador(1);},
                              onComplete  : function(transport){est_cargador(0);
                                            alert(transport.responseText);
                                            mostrarServicio();
                                            }
                            }
                         )
    }
}
