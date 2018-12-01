//Variables globales
var kk = 1;
//función empleada en la búsqueda de pacientes
var pathRequestControl = "../../ccontrol/control/control.php";
var contadorCargador = 0;
var arrayEstadosCargador = new Array();
//var laban=28;
/*
function micargador(estado) {
    $('VentanaTransparente').setStyle({
        visibility: 'visible'
    });

    switch (estado) {

        case 0:
        {

            $('VentanaTransparente').hide();
            // alert('por aca');
            break;
        }
        case 1:
        {
            $('VentanaTransparente').show();
            break;
        }
    }
}*/
function cargadorpeche(estado, id) {
    
    $('VentanaTransparente').setStyle({
        visibility: 'visible'
    });
    
    if (estado == 1) {
        //
        arrayEstadosCargador[id] = 1;
        var alto = document.body.scrollHeight;
        //alto=100;
        //alert("id:"+id+" alto: "+alto)
        $('overlayPeche').setStyle({
            height: alto + 'px'
        });
       
        $('VentanaTransparente').setStyle({
            display: 'block'
        });
        $('VentanaTransparente').show();
        
       // $('VentanaTransparente').show();
        //alert('ventana trans');

    }
    if (estado == 0) {
        arrayEstadosCargador[id] = 0;
        var numeroCargadores = arrayEstadosCargador.length;
        var estadoGeneral = 0;

        for (var i = 0; i <= numeroCargadores; i++) {
            if (arrayEstadosCargador[i] == 1) {
                estadoGeneral = 1;
                break;
            }
        }
        if (estadoGeneral == 0) {
            $('VentanaTransparente').hide();
        }
        
    }
// alert('estado='+estado+'id='+id);
}
function maximozindex() {
    var tCol = document.getElementsByTagName('*');
    var z = 0;
    for (var i = 0; i < tCol.length; i++) {
        if (tCol[i].style.zIndex > z) {
            z = tCol[i].style.zIndex;
        }
    }
    return ++z;
}
function ventana_filiacion() {
    if ($F('txtCodigoPersona') != '') {
        CargarVentana('grid_caja2', 'Registro de Filiaciones del Paciente', '../../ccontrol/control/control.php?p1=filiacionesPac&iid_persona=' + $F('txtCodigoPersona'), '770', '500', false, true, '', 1, '', 10, 10, 10, 10)
    }
}
function ventana_historia_clinica() {
    if ($F('txtCodigoPersona') != '') {
        CargarVentana('grid_caja2', 'Historia Clinica del Paciente', '../../ccontrol/control/control.php?p1=filiacionesPac&iid_persona=' + $F('txtCodigoPersona'), '770', '500', false, true, '', 1, '', 10, 10, 10, 10)
    }
}
function ventana_patologia() {
    if ($F('txtCodigoPersona') != '') {
        CargarVentana('grid_caja2', 'Patologia del Paciente', '../../ccontrol/control/control.php?p1=filiacionesPac&iid_persona=' + $F('txtCodigoPersona'), '770', '500', false, true, '', 1, '', 10, 10, 10, 10)
    }
}
function ventana_resultado() {
    if ($F('txtCodigoPersona') != '') {
        CargarVentana('grid_caja2', 'Resultados de Analisis del Paciente', '../../ccontrol/control/control.php?p1=filiacionesPac&iid_persona=' + $F('txtCodigoPersona'), '770', '500', false, true, '', 1, '', 10, 10, 10, 10)
    }
}
function ventana_agrega_tramitador() {
    myajax.Link('../../ccontrol/control/control.php?p1=agregar_filiacion&p2=' + document.getElementById('dh_fil').value + '&p3=' + document.getElementById('dh_iid').value + '&p4=' + document.getElementById('dh_dat').value + '&p5=f&p6=<?php echo $iid_persona;?>&p7=f&p8=t&p11=t&p12=insertar&p13=idh', 'der_hab');
    document.getElementById('bus_hab').style.display = 'none';
    document.getElementById('der_hab').style.display = 'block';
    document.getElementById('hBuscadorModulo').value = 'buscar_personas_admision';
}
function ventana_busca_persona(funcionJSEjecutar) {
    CargarVentana('formBuscadorPersonas', 'Buscar Personas', '../../ccontrol/control/control.php?p1=form_buscador_personas&funcionJSEjecutar=' + funcionJSEjecutar, '600', '420', false, true, '', 1, '', 10, 10, 10, 10);
}
function ventana_formulario_persona(funcionJSEjecutar) {
    // CargarVentana('formBuscadorPersonas','Registro de personas','../../ccontrol/control/control.php?p1=mostrar_datos_paciente_admision_nuevo&p2=&p3=&funcionJSEjecutar='+funcionJSEjecutar,'900','500',false,true,'',1,'',10,10,10,10);
    //Windows.close("Div_formBuscadorPersonas");
    vformname = 'formBuscadorPersonas'
    vtitle = 'Registro de personas'
    vwidth = '900'
    vheight = '500'
    vcenter = 't'
    vresizable = ''
    vmodal = 'false'
    vstyle = ''
    vopacity = ''

    vposx1 = ''
    vposx2 = ''
    vposy1 = ''
    vposy2 = ''
    patronModulo = 'mostrar_datos_paciente_admision_nuevo';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2='; //agreagar o eliminar atributos
    parametros += '&funcionJSEjecutar=' + funcionJSEjecutar;


    posFuncion = '';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)

}
function ventana_contribuyente(funcionJSEjecutar) {
    CargarVentana('formBuscadorPersonas', 'Busqueda de contribuyentes', '../../ccontrol/control/control.php?p1=form_buscador_contribuyentes&funcionJSEjecutar=' + funcionJSEjecutar, '770', '500', false, true, '', 1, '', 10, 10, 10, 10);
}
function ventana_add_dni(iid_persona, imagen) {
    CargarVentana('grid_caja3', 'Adjuntar Fotografia del DNI', '../admision/upload_dni.php?codPersona=' + iid_persona + '&imgFoto=' + imagen, '500', '300', false, true, '', '1', '', 10, 10, 80, 10);
}
function popup_datos_complementarios(capa, texto, titulo, chk) {
    $(capa).show();
    var valor = $(texto).value;
    var url = '../../ccontrol/control/control.php';
    var data = "p1=form_popup_datos_complementarios&p2=" + capa + "&p3=" + texto + "&p4=" + valor + "&p5=" + titulo + "&p6=" + chk;
    new Ajax.Request(url,
    {
        method: 'get',
        parameters: data,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            $(capa).update(transport.responseText);
        }
    }
    )
}
function guardar_persona() {
    habilitia_docIdentidad('cbo');
    var url = '../../ccontrol/control/control.php';
    var funcion = $('funcionJSEjecutar').value;
    if (funcion == '') {
        funcion = 'getBuscarPersonasInsertada';
    }
    var data = $('form_detalle').serialize();
    //alert(data);
    var p_idd = $('txtCodigoPersona').value;
    var accion = document.getElementById("p_acc").value;
    var validaDocumento = document.getElementById("hExisteDocumento").value;
    var chkValida = $('chkValida').value;
    //alert(data);
    //p1=mantenimiento_persona
    var obl = new Array('txtApellidoPat', 'txtApellidoMat', 'txtNombrePaciente', 'txtFechaNacimiento', 'sexo');
    var arrayOr = new Array('txtTelefono', 'txtCelular', 'txtCelular2');
    var rrhh = new Array('cod_cargo', 'cod_cargotipo', 'cod_oficina', 'codprof', 'codesp', 'nro_ruc');
    if (validaDocumento == "no" || chkValida == 1 || accion == 'update') {
        if (chkValida == 0) {
            if (validablancos(obl) && validaOR(arrayOr) && valida_ubigueo()) {
                if (window.confirm("¿Desea guardar los datos?")) {
                    // alert($('cbNac_pais').value);
                    new Ajax.Request(url,
                    {
                        method: 'get',
                        parameters: data,
                        onLoading: micargador(1),
                        onComplete: function(transport) {
                            micargador(0);
                            mensaje = transport.responseText;
                            cierraRegistraPersona(funcion, mensaje);
                        //DatosPersonasAdmision(p_idd);
                        }
                    }
                    )


                }
            }
        }
        else if (chkValida == 1 || accion == 'update') {
            if (window.confirm("¿Desea guardar los datos?")) {
                new Ajax.Request(url,
                {
                    method: 'get',
                    parameters: data,
                    onLoading: micargador(1),
                    onComplete: function(transport) {
                        micargador(0);
                        mensaje = transport.responseText;
                        cierraRegistraPersona(funcion, mensaje);

                    }
                }
                )

            }
        }
    } else {
        mensaje = "NO HA INGRESADO EL DOCUMENTO O EL DOCUMENTO YA EXISTE";
        alert(mensaje);
    }

}
function cierraRegistraPersona(funcion, codigo) {
    document.getElementById("txtCodigo").value = codigo;

    funcion += "('" + codigo + "')";
    Windows.close("Div_formBuscadorPersonas");
    eval(funcion);

}
function generaHistoria() {
    var url = '../../ccontrol/control/control.php';
    var data = "p1=generar_historia";
    new Ajax.Request(url,
    {
        method: 'get',
        parameters: data,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            //$('idHistoria').update(transport.responseText);
            document.getElementById('txtNroHistoria').value = transport.responseText;
        }
    }
    );

}

function editar_persona() {
    //document.getElementById("hExisteDocumento").value='no'
    // alert('holas');
    //    habilita_filiacion();
    // habilita_Nofiliacion();
    //habilita_derhabiente();

    enabled_formulario_adm(1);
    habilitia_docIdentidad('txt');
    habilitia_docIdentidad('cbo');
    habilita_btnIdentidad();
}

function buscador_persona() {
    CargarVentana('grid_caja3', 'Buscar Persona Natural', '../busqueda/busqueda_personas.php', '530', '300', false, true, '', '', '', 10, 10, 80, 10);

}
function setDatosPersonasAdmision(event, html, iid_persona) {
    document.getElementById('idBusquedaPersona').value = iid_persona;
    DatosPersonasAdmision(iid_persona);
//Windows.close("Div_grid_caja3");
}
function getDatosPersonasAdmision(iid_persona) {
    DatosPersonasAdmision(iid_persona);
}
function getDatosPersonasAdmisionNuevo() {
    DatosPersonasAdmision('');
}
function getDatosPersonasLab(iid_persona) {
    DatosPersonasLab(iid_persona);
}
function DatosPersonasAdmision(iid_persona) {
    var control = iid_persona == '' ? 'mostrar_datos_paciente_admision_nuevo' : 'mostrar_datos_paciente_admision';
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=' + control + '&p2=' + iid_persona + '&p3=&funcionJSEjecutar=';
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(url,
    {
        method: 'get',
        parameters: data,
       onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            $('datos_persona').update(transport.responseText);//Coloca el resultado en la capa "DATOS PERSONA"
            ListaPersonaHospitalizacion(iid_persona);
        }
    }
    )
    numDoc = "txtNroDocIdent[1]";
    setTimeout("$(numDoc).focus()", 900);
}

function ListaPersonaHospitalizacion(iid_persona) {
    var control = 'ListaPersonaHospitalizacion';
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=' + control + '&p2=' + iid_persona;
    new Ajax.Request(url,
    {
        method: 'get',
        parameters: data,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            $('idHospitalizacionPersona').update(transport.responseText);
        }
    }
    )
    numDoc = "txtNroDocIdent[1]";
    setTimeout("$(numDoc).focus()", 900);
}

function DatosPersonasLab(iid_persona) {
    myajax.Link("../../ccontrol/control/control.php?p1=buscar_analisis_Lab&p2=" + iid_persona, "datos_persona");
}
function enabled_formulario_adm(op) {
    var read = new Array('txtApellidoPat', 'txtApellidoMat', 'txtNombrePaciente', 'txtTelefono', 'txtCelular', 'txtEmail', 'txtCelular2', 'txtHijos', 'txtNombreTipoVia', 'txtTipoCentroPoblado', 'txtNumero', 'txtManzana', 'txtLote', 'txtKm', 'txtObservaciones', 'txtNroDeHijo', 'vReferencia', 'txtFechaNacimiento');
    //var butt = new Array('btn_GRABAR', 'btn_EDITAR', 'btn_DNI', 'btn_RESTAURAR', 'btn_PERSONALES', 'btn_DATOS', 'btn_FILIACIONES', 'btn_ATENCIONES', 'btn_HUELLA');
	var butt = new Array('btn_GRABAR', 'btn_EDITAR',  'btn_RESTAURAR', 'btn_PERSONALES', 'btn_DATOS', 'btn_FILIACIONES', 'btn_ATENCIONES');
    var desh = new Array('sexo', 'cb_civil', 'cb_instruccion', 'cb_condicion', 'cb_vivienda', 'cb_raza', 'cb_departamento', 'cb_provincia', 'cb_distrito', 'cb_grado_estudio', 'cb_via', 'cb_cpo', 'cbNac_pais', 'cbNac_departamento', 'cbNac_provincia', 'cbNac_distrito', 'cb_tipoInstEduc', 'cb_InstEduc', 'cb_medio_contacto', 'chkValida', 'cb_grupolaboral', 'cb_subgrupolaboral', 'cb_pais');
    switch (op) {
        case 1:
           // habi = new Array('v', 'f', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v');
			habi = new Array('v', 'f', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v');
            $('p_acc').update('update');
            buclesMulti('readOnly', read, false);
            buclesMulti('enable', desh, '');
            buclesMulti('btnHab', butt, habi);
            break;
        case 2:
            habi = new Array('f', 'v', 'f', 'f', 'v', 'v', 'v', 'v');//Visibilidad de botones de //
            $('p_acc').update('inserted');
            buclesMulti('readOnly', read, true);
            buclesMulti('disable', desh, '');
            buclesMulti('btnHab', butt, habi);
            $('botones').setStyle({
                display: 'anone'
            });
            break;
        case 3:
            habi = new Array('v', 'f', 'f', 'f', 'v');
            $('acciontit').update($('accion').value = 'nuevo');
            buclesMulti('value', read, '');
            buclesMulti('value', desh, '');
            buclesMulti('btnHab', butt, habi);
            break;
        case 4:
            habi = new Array('v', 'f', 'f', 'f', 'v');
            $('acciontit').update($('accion').value = 'nuevo submenu');
            buclesMulti('value', read, '');
            buclesMulti('value', desh, '');
            buclesMulti('btnHab', butt, habi);
            break;
        case 5:
            habi = new Array('v', 'f', 'v', 'v', 'v', 'v', 'v', 'v', 'v');
            $('p_acc').update('update');
            buclesMulti('readOnly', read, false);
            buclesMulti('enable', desh, '');
            buclesMulti('btnHab', butt, habi);
            break;
    }
    $('form_detalle').focusFirstElement();
}

//////////////////////////////////////////FUNCIONES DE VALIDACION ////////////////////////////////////////////
function buclesMulti(op, array, val) {
    switch (op) {
        case 'disable':
            for (i = 0; i < array.length; i++) {
                $(array[i]).disable();
            }
            break;
        case 'enable':
            for (i = 0; i < array.length; i++) {
                $(array[i]).enable();
            }
            break;
        case 'value':
            for (i = 0; i < array.length; i++) {
                $(array[i]).value = '';
            }
            break;
        case 'readOnly':
            for (i = 0; i < array.length; i++) {
                $(array[i]).readOnly = val;
            }
            break;
        case 'btnHab':
            $('botones').setStyle({
                display: 'block'
            });
            for (i = 0; i < array.length; i++) {
                var dis = val[i] == 'v' ? 'inline' : 'none';
                $(array[i]).setStyle({
                    display: dis
                });
            }
            break;
        case 'tabHab':
            for (i = 0; i < array.length; i++) {
                var valor = array[i].split("-");
                var classN = valor[0] == val.id ? 'tabsel' : 'tab';
                var divDis = valor[0] == val.id ? 'block' : 'none';
                $(valor[0]).className = classN;
                $('div_' + valor[0]).setStyle({
                    display: divDis
                });
                if (valor[1] && valor[0] == val.id)
                    $(valor[1]).select();
            }
            break;
    }
}

function restauraCambios() {
    $('form_detalle').reset();
    $('tab1').show();
    $('tab2').hide();
    $('tab3').show();
    $('tab4').hide();
    $('tab5').show();
    enabled_formulario_adm(2);
    deshabilitia_docIdentidad('cbo');
    deshabilitia_docIdentidad('txt');
    deshabilita_btnIdentidad();
}

function validarTipoDatos(opcion, objeto, evento, salto) {
    var key = evento.which ? evento.which : evento.keyCode;

    switch (opcion)
    {
        case 1:  // entero
            if (numbersonlyjorge(objeto, evento, '')) {
                if (key == 13) {
                    $(salto).focus();
                    return false;
                }
            }
            else {
                return false;
            }
            break;
        case 3:   // datetime
            if (numbersonlyjorge(objeto, evento, '')) {
                if (key == 13) {
                    $(salto).focus();
                    return false;
                }
            }
            else {
                return false;
            }
            break;

        case 4:   // decima
            if (numbersonlyjorge(objeto, evento, '.')) {
                if (key == 13) {
                    $(salto).focus();
                    return false;
                }
            }
            else {
                return false;
            }
            break;

    }


}
function validFormSalt(opcion, objeto, evento, salto) {
    var key = evento.which ? evento.which : evento.keyCode;
    switch (opcion)
    {
        case 'nro':
            if (numbersonly(objeto, evento, '')) {
                if (key == 13) {
                    $(salto).focus();
                    return false;
                }
            }
            else {
                return false;
            }
            break;
        case 'date':
            if (evento.keyCode == 13) {
                lic_validarHoraFinal();
            }
            break;
        case 'txt':
            if (textoonly(objeto, evento)) {
                if (key == 13) {
                    $(salto).focus();
                    return false;
                }
            }
            else {
                return false;
            }
            break;
        case 'alf':
            if (evento.keyCode == 13) {
                $(salto).focus();
            }
            break;
        case 'email':
            if (objeto.value != '') {
                if (key == 13) {
                    if (ValidateEmail(objeto.value)) {
                        $(salto).focus();
                        return false;
                    }
                    else {
                        return false;
                    }
                }
            }
            else {
                $(salto).focus();
                return true;
            }
            break;
        case 'web':
            if (evento.keyCode == 13) {
                $(salto).focus();
            }
            return dirwebonly(objeto, evento);
            break;
        case 'cbo':
            $(salto).focus();
            return false;
            break;
        case 'div':
            //if(key==9){
            $(salto).focus();
            return false;
            //}
            break;
    }
}

function validFormSaltDNI(tipo, objeto, evento, salto) {
    //alert(tipo);
    var key = evento.which ? evento.which : evento.keyCode;
    var array_asociativo_tipo = new Array();
    ;
    array_asociativo_tipo['0001'] = 'nro';
    array_asociativo_tipo['0002'] = 'nro';
    array_asociativo_tipo['0003'] = 'nro';
    array_asociativo_tipo['0004'] = 'nro';
    array_asociativo_tipo['0005'] = 'nro';
    array_asociativo_tipo['0006'] = 'nro';
    array_asociativo_tipo['0007'] = 'nro';
    array_asociativo_tipo['0008'] = 'nro';
    array_asociativo_tipo['0009'] = 'nro';
    array_asociativo_tipo['0010'] = 'nro';
    array_asociativo_tipo['0011'] = 'nro';
    array_asociativo_tipo['0012'] = 'nro';
    array_asociativo_tipo['0013'] = 'nro';
    array_asociativo_tipo['0014'] = 'nro';
    array_asociativo_tipo['0015'] = 'nro';
    array_asociativo_tipo['0016'] = 'alfa';


    var opcion = array_asociativo_tipo[tipo];
    //alert(tipoIngreso);
    switch (opcion)
    {
        case 'nro':
            if (numbersonly(objeto, evento, '')) {
                if (key == 13) {
                    $(salto).focus();
                    return false;
                }
            }
            else {
                return false;
            }
            break;
        case 'date':
            if (evento.keyCode == 13) {
                lic_validarHoraFinal();
            }
            break;
        case 'txt':
            if (textoonly(objeto, evento)) {
                if (key == 13) {
                    $(salto).focus();
                    return false;
                }
            }
            else {
                return false;
            }
            break;
        case 'alf':
            if (evento.keyCode == 13) {
                $(salto).focus();
            }
            break;
        case 'email':
            if (objeto.value != '') {
                if (key == 13) {
                    if (ValidateEmail(objeto.value)) {
                        $(salto).focus();
                        return false;
                    }
                    else {
                        return false;
                    }
                }
            }
            else {
                $(salto).focus();
                return true;
            }
            break;
        case 'web':
            if (evento.keyCode == 13) {
                $(salto).focus();
            }
            return dirwebonly(objeto, evento);
            break;
        case 'cbo':
            $(salto).focus();
            return false;
            break;
        case 'div':
            //if(key==9){
            $(salto).focus();
            return false;
            //}
            break;
    }
//return true;
}
function ubigeoPais() {
    //alert($("cb_pais").value);
    //onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=combo_ubigeo&p2=&p3='+document.getElementById('cb_departamento').value+'&p4='+document.getElementById('cb_provincia').value+'&p5='+document.getElementById('cb_pais').value,'ubigeo');\"";
    if ($("cb_pais").value == '9589') {
        //para limpiar los hc despues de grabar
        patronModulo = 'combo_ubigeo';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + '';
        parametros += '&p3=' + document.getElementById('cb_departamento').value;
        parametros += '&p4=' + document.getElementById('cb_provincia').value;
        parametros += '&p5=' + document.getElementById('cb_pais').value;

        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false,
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function(transport) {
                cargadorpeche(0, idCargador);
                respuesta = transport.responseText;
                $('ubigeo').update(respuesta);
            }
        })
    } else {
        patronModulo = 'combo_ubigeo';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + '';
        parametros += '&p3=' + 0;
        parametros += '&p4=' + 0;
        parametros += '&p5=' + document.getElementById('cb_pais').value;

        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false,
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function(transport) {
                cargadorpeche(0, idCargador);
                respuesta = transport.responseText;
                $('ubigeo').update(respuesta);
            }
        });
    }


}

function ubigeoPaisNacimiento() {
    //alert($("cb_pais").value);
    //onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=combo_ubigeo&p2=&p3='+document.getElementById('cb_departamento').value+'&p4='+document.getElementById('cb_provincia').value+'&p5='+document.getElementById('cb_pais').value,'ubigeo');\"";
    if ($("cb_pais").value == '9589') {
        //para limpiar los hc despues de grabar
        patronModulo = 'combo_nacimiento';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + '';
        parametros += '&p3=' + document.getElementById('cbNac_departamento').value;
        parametros += '&p4=' + document.getElementById('cbNac_provincia').value;
        parametros += '&p5=' + document.getElementById('cbNac_pais').value;

        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false,
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function(transport) {
                cargadorpeche(0, idCargador);
                respuesta = transport.responseText;
                $('ubigeo2').update(respuesta);
            }
        })
    } else {
        patronModulo = 'combo_nacimiento';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + '';
        parametros += '&p3=' + 0;
        parametros += '&p4=' + 0;
        parametros += '&p5=' + document.getElementById('cbNac_pais').value;

        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false,
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function(transport) {
                cargadorpeche(0, idCargador);
                respuesta = transport.responseText;
                $('ubigeo2').update(respuesta);
            }
        })
    }


}
function validablancos(a) {
    var cant = a.length;
    for (i = 0; i < cant; i++) {
        var x = $(a[i]).value;
        var t = $(a[i]).title;
        if (x == '' || x == '0000') {
            alert('Debe ingresar los datos de ' + t + '!');
            $(a[i]).focus();
            return false;
        }
    }
    return true;
}
//'cb_departamento','cb_provincia','cb_distrito'
function valida_ubigueo() {

    if ($('cb_pais').value == '0000') {
        alert('ingrese pais de residencia');
        return false;
    } else {
        if ($('cb_pais').value != '9589') {

            return true;
        } else {
            if ($('cb_departamento').value == '0000') {
                alert('ingrese departamento de residencia');
                return false
            }
            if ($('cb_provincia').value == '0000') {
                alert('ingrese provincia de residencia');
                return false
            }
            if ($('cb_distrito').value == '0000') {
                alert('ingrese distrito de residencia');
                return false
            }
        }
    }

    return true;
}


function validaOR(a) {
    var cant = a.length;
    var condicion = false;
    for (i = 0; i < cant; i++) {
        var x = $(a[i]).value;
        var t = $(a[i]).title;
        if (x == '' || x == '0000') {


        } else {
            condicion = true;
        }
    }
    if (condicion == false) {

        alert('Debe ingresar por lo menos un número telefonico');
    }
    return condicion;
}

function valida_docIdentidad(id) {
    url = '../../ccontrol/control/control.php';
    a = "txtNroDocIdent[" + id + "]";
    b = "cbTipoDoc[" + id + "]";
    if (!$(a).readOnly && $(a).value != '') {
        tipoDoc = $(b).value;
        nroDoc = $(a).value;
        control = 'validaPersonasDocIdentidad';
        data = 'p1=' + control + '&p2=' + tipoDoc + '&p3=' + nroDoc;
        new Ajax.Request(url,
        {
            method: 'get',
            parameters: data,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                resultado = transport.responseText;
                if (resultado > 0) {
                    mensaje = "El " + getNombreTipoDoc(tipoDoc) + " con numero " + nroDoc + " ya se encuentra registrado.";
                    document.getElementById("hExisteDocumento").value = 'si';
                    alert(mensaje);

                //$(a).focus();
                } else {
                    document.getElementById("hExisteDocumento").value = 'no';
                }
            }
        }
        )
    }
}
function valida_nombre_persona(obj1) {
    url = '../../ccontrol/control/control.php';
    paterno = $('txtApellidoPat').value;
    materno = $('txtApellidoMat').value;
    nombres = $('txtNombrePaciente').value;
    accion = $('p_acc').value;
    if (paterno != '' && materno != '' && nombres != '' && !$('txtNombrePaciente').readOnly && accion == 'inserted') {
        control = 'validaPersonasNombres';
        data = 'p1=' + control + '&p2=' + paterno + '&p3=' + materno + '&p4=' + nombres;
        new Ajax.Request(url,
        {
            method: 'get',
            parameters: data,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                resultado = transport.responseText;
                if (resultado > 0) {
                    alert("Esta persona ya se encuentra registrada");
                    $(txtNombrePaciente).value = "";
                    $(txtNombrePaciente).focus();
                }
            }
        }
        )
    }
}

function buscar_personasxApellidos() {
    url = '../../ccontrol/control/control.php';
    paterno = $('txtApellidoPat').value;
    materno = $('txtApellidoMat').value;
    nombres = $('txtNombrePaciente').value;
    accion = $('p_acc').value;
    control = 'buscar_personasxApellidos';
    data = 'p1=' + control + '&p2=' + paterno + '&p3=' + materno;
    if (paterno != '' && materno != '' && !$('txtApellidoMat').readOnly && nombres == '' && accion == 'inserted') {
        new Ajax.Request(url,
        {
            method: 'get',
            parameters: data,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                resultado = transport.responseText;
                if (resultado != '') {
                    $('divNombrePaciente').update(resultado);
                    $('divNombrePaciente').show();
                    $('txtNombrePaciente').focus();
                //$(obj1.id).value = '';
                //$(obj1.id).focus();
                //setTimeout("$('divNombrePaciente').hide()",4000);
                }

            }
        }
        )
    }
}

function validaTxtNroDoc(id) {
    selecTipoDoc = "cbTipoDoc[" + id + "]";
    txtNroDoc = "txtNroDocIdent[" + id + "]";
    indice = $(selecTipoDoc).value;
    array_asociativo = new Array();
    array_asociativo['0001'] = 8;
    array_asociativo['0002'] = 8;
    array_asociativo['0003'] = 11;
    array_asociativo['0004'] = 15;
    array_asociativo['0005'] = 15;
    array_asociativo['0006'] = 0;
    array_asociativo['0007'] = 10;
    array_asociativo['0008'] = 9;
    array_asociativo['0009'] = 10;
    array_asociativo['0010'] = 10;
    array_asociativo['0011'] = 10;
    array_asociativo['0012'] = 10;
    array_asociativo['0013'] = 15;
    array_asociativo['0014'] = 10;
    array_asociativo['0015'] = 50;
    for (var i in array_asociativo) {
        tipoDato = typeof array_asociativo[i];
        if (tipoDato == "number" && indice == i) {
            $(txtNroDoc).value = "";
            $(txtNroDoc).maxLength = array_asociativo[i];
            $(txtNroDoc).focus();
        }
    }
}

function getNombreTipoDoc(codigo) {
    array_asociativo = new Array();
    array_asociativo['0001'] = "DNI";
    array_asociativo['0002'] = "LE";
    array_asociativo['0003'] = "RUC";
    array_asociativo['0004'] = "LIBRETA MILITAR";
    array_asociativo['0005'] = "BOLETA MILITAR";
    array_asociativo['0006'] = "";
    array_asociativo['0007'] = "PARTIDA DE NACIMIENTO";
    array_asociativo['0008'] = "";
    array_asociativo['0009'] = "PASAPORTE";
    array_asociativo['0010'] = "CARNET EXTRANJERIA";
    array_asociativo['0011'] = "CARNET IDENTIDAD POLICIAL";
    array_asociativo['0012'] = "LICENCIA CONDUCIR";
    array_asociativo['0013'] = "CARNET SEGURO SOCIAL";
    array_asociativo['0014'] = "COLEGIATURA PROFESIONAL";
    array_asociativo['0015'] = "POR REGULARIZAR";
    return array_asociativo[codigo];
}

var i = 0;
function mostrar_complementarios() {
    var div_complementarios = document.getElementByid('complementarios');
    div_complementarios.style.display = "anone";
}

////////////////////////////////////RRHH///////////////////////
function listComboAdm(codigo, control, destino) {
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=' + control + '&p2=' + codigo.value;
    new Ajax.Request(url,
    {
        method: 'get',
        parameters: data,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            $(destino).update(transport.responseText);
        }
    }
    )
}

function mostrar(nombreCapa) {
    document.getElementById(nombreCapa).style.visibility = "visible";
}

function ocultar(nombreCapa) {
    document.getElementById(nombreCapa).style.visibility = "hidden";
}
function ocultaComplementarios() {
    ocultar('divComplementarios');
    document.getElementById('divDomicilio').style.left = '-10px';
    document.getElementById('divDomicilio').style.top = '-310px';
    document.getElementById('divDomicilio').style.border = "0px solid #000000";
    document.getElementById('divDomicilio').style.width = "100%";
    document.getElementById('divDomicilio').style.height = "230px";
    document.getElementById('divDomicilio').style.padding = "10px";
    document.getElementById('divDomicilio').style.overflow = "auto";
    document.getElementById('divDomicilio').style.margin = "10px";
}
function autocompletar(obj1, tipo) {
    url = '../../ccontrol/control/control.php';
    paterno = $('txtApellidoPat').value;
    materno = $('txtApellidoMat').value;
    tipodoc = $('cb_tipDc').value;
    input = obj1.value;
    control = (tipo == '1' ? 'buscar_personas_admision_porcampo' : 'buscar_personas_admision_pordni');
    maxchar = (tipo == '1' ? '' : '');
    opcion = {
        script: function(input) {
            return(url + '?p1=' + control + '&p2=' + paterno + '&p3=' + materno + '&p4=' + tipodoc + '&p5=' + input);
        }
    };
    new AutoComplete(obj1.id, opcion);
    return true;
}
function cambiaValor(chk, obj) {
    valori = $(chk).value;
    accion = $('p_acc').value;
    if (valori == '' & accion == 'update') {
        $(chk).value = 'inserted';
    }
    else {
        $(chk).value = accion;
    }
    document.getElementById(chk).checked = true;

}

function valorInicial(chk, obj) {
    $(chk).value = $(obj).value;
}

function longitud_campo(select, option) {
    $('txtNroDocIdent').value = '';
    var id = option.value;
    var control = 'lCampo';
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=' + control + '&p2=' + select + '&p3=' + id;
    new Ajax.Request(url,
    {
        method: 'get',
        parameters: data,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            //alert(transport.responseText);
            $('txtNroDocIdent1').maxLength = transport.responseText;
        }
    }
    )
}

function agrega_documento_identidad(id, kk) {
    tbody = document.getElementById(id).getElementsByTagName("TBODY")[0];
    row = document.createElement("tr");
    td1 = document.createElement("td");
    td2 = document.createElement("td");
    caja = document.createElement("input");
    link = document.createElement("a");
    img = document.createElement("img");
    sel = document.createElement("select")
    val = $('divDNI').innerHTML;
    cadena = new Array();
    kk = parseInt(val) + 1;
    z = 0;
    for (i = 0; i < kk - 1; i++) {
        j = i + 1;
        tipoDoc = "cbTipoDoc[" + j + "]";
        if (document.getElementById(tipoDoc)) {
            cadena[z] = $(tipoDoc).value;
            z = z + 1;
        }
    }
    //alert(cadena.join(","));
    cadDocs = cadena.join(",");
    $('divDNI').innerHTML = kk;
    txtDoc = "txtNroDocIdent[" + kk + "]";
    cbDoc = "cbTipoDoc[" + kk + "]";
    img.src = "../../../imagen/inicio/eliminar.gif";
    link.setAttribute("href", "#");
    link.setAttribute("onclick", "elimina_fila(" + kk + ");");
    caja.setAttribute("type", "text");
    caja.setAttribute("id", txtDoc);
    caja.setAttribute("name", txtDoc);
    caja.setAttribute("onkeypress", "return validFormSalt('nro',this,event,'txtApellidoPat');");
    caja.setAttribute("onblur", "valida_docIdentidad(" + kk + ")");
    //caja.setAttribute("readonly","readonly");
    caja.setAttribute("style", "width:100px;");
    sel.setAttribute("style", "width:120px");
    sel.setAttribute("size", "1");
    sel.setAttribute("name", cbDoc);
    sel.setAttribute("id", cbDoc);
    sel.setAttribute("onchange", "validaTxtNroDoc(" + kk + ");");
    row.setAttribute("id", "rowTipoDoc" + kk);
    opcionvar = document.createElement("option");
    opcionvar.innerHTML = "Seleccionar";
    opcionvar.value = "";
    sel.appendChild(opcionvar);
    td1.appendChild(caja);
    td2.appendChild(sel);
    link.appendChild(img)
    td1.appendChild(link);
    row.appendChild(td2);
    row.appendChild(td1);
    tbody.appendChild(row);
    url = '../../ccontrol/control/control.php';
    control = 'listaXMLDocumentoIdentidad';
    data = 'p1=' + control + '&p2=' + cadDocs;
    new Ajax.Request(url,
    {
        method: 'get',
        parameters: data,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            micargador(0);
            if (transport.readyState == '4') {
                xml = transport.responseXML;
                arrtipodoc = xml.getElementsByTagName('tipodoc');
                arrnombredoc = xml.getElementsByTagName('nombredoc');
                a = "cbTipoDoc[" + kk + "]";
                select = document.getElementById(a);
                select.options.length = 0;
                for (var f = 0; f < arrtipodoc.length; f++) {
                    opt = document.createElement('option');
                    codigo = arrtipodoc[f].firstChild.nodeValue;
                    texto = document.createTextNode(arrnombredoc[f].firstChild.nodeValue);
                    opt.value = codigo;
                    opt.appendChild(texto)
                    select.appendChild(opt);
                }
                $(txtDoc).focus();
            }
        }
    }
    )
}
function elimina_fila(kk) {
    el = document.getElementById('rowTipoDoc' + kk);
    padre = el.parentNode;
    padre.removeChild(el);
}

function elimina_filiacion(idfila) {
    table = document.getElementById('tblNoFiliPac');
    table.deleteRow(idfila);
}
iafiliacion = 1;
function agrega_filiacion(idAfiliacion, vAfiliacion, bDerHab) {
    c_cod_per = document.getElementById('txtCodigoPersona').value;
    table = document.getElementById('tblFiliPac');
    myNewRow = table.insertRow(-1);
    myNewRow.id = iafiliacion;
    myNewRow.className = iafiliacion % 2 == 0 ? 'fila1' : 'fila2';
    myNewCell = myNewRow.insertCell(-1);
    myNewCell.innerHTML = vAfiliacion;
    myNewCell = myNewRow.insertCell(-1);
    deshabilita_agrega_fila_derhabiente();
    $('dh_filiacion').value = idAfiliacion;
    if (bDerHab == 1) {
        myNewCell.innerHTML = "<input type='radio' name='iddafiliacion' value='" + idAfiliacion + "' id='iddafiliacion' checked='checked' \n\
                                                onclick=\"\n\
                                                    btn='btnAgregaDerHab[" + idAfiliacion + "]';\n\
                                                    btnAgregaDerHab2=document.getElementById(btn);\n\
                                                    deshabilita_agrega_fila_derhabiente();\n\
                                                    btnAgregaDerHab2.disabled=false;\n\
                                                    btnAgregaDerHab2.style.cursor='pointer';\n\
                                                    btnAgregaDerHab2.style.background='url(../../../../fastmedical_front/imagen/icono/add_user.png) no-repeat;width:18px;border:0px';\n\
                                                    document.getElementById('dh_filiacion').value ='" + idAfiliacion + "';\n\
                                                    myajax.Link('../../ccontrol/control/control.php?p1=derecho_habiente&p2=" + idAfiliacion + "&p3=" + vAfiliacion + "&p4=&p5=" + c_cod_per + "&p6=&p7=" + c_cod_per + "&p8=&p9=&p10=&p11=" + c_cod_per + "','der_hab');\"\n\
                                                \"/>";
        myNewCell = myNewRow.insertCell(-1);
        myNewCell.innerHTML = "<input type='button' name='btnAgregaDerHab[" + idAfiliacion + "]' id='btnAgregaDerHab[" + idAfiliacion + "]' \n\
                                                    style='background:url(../../../../fastmedical_front/imagen/icono/add_user.png) no-repeat;width:18px;border:0px;background-color:transparent;cursor:pointer;' \n\
                                                    onclick=\"agrega_fila_derhabiente('tblDerHab');ventana_busca_persona('setDatosDerechoHabiente');\" title='Filiacion Derecho Habiente'>";
    }
    else {
        myNewCell.innerHTML = "<input type='radio' name='iddafiliacion' value='opción' id='iddafiliacion' checked='checked' onclick=\"\n\
                                                deshabilita_agrega_fila_derhabiente();\n\
                                                document.getElementById('dh_filiacion').value ='" + idAfiliacion + "';\n\
                                                myajax.Link('../../ccontrol/control/control.php?p1=derecho_habiente&p2=" + idAfiliacion + "&p3=" + vAfiliacion + "&p4=&p5=" + c_cod_per + "&p6=&p7=" + c_cod_per + "&p8=&p9=&p10=&p11=" + c_cod_per + "','der_hab');\"/>";
        myNewCell = myNewRow.insertCell(-1);
        myNewCell.innerHTML = "&nbsp;";
    }
    iafiliacion++;
    document.form_detalle.iddafiliacion[document.form_detalle.iddafiliacion.length - 1].focus();
    myajax.Link('../../ccontrol/control/control.php?p1=derecho_habiente&p2="+idAfiliacion+"&p3="+vAfiliacion+"&p4=&p5="+c_cod_per+"&p6=&p7="+c_cod_per+"&p8=&p9=&p10=&p11="+c_cod_per+"', 'der_hab');
}
function guardar_filiacion() {
    var data = $('form_detalle').serialize();
    //data = document.getElementById('iddafiliacion').value;
    alert(data);
}

function agrega_fila_derhabiente() {
    ii = parseInt(document.getElementById('numDerHab').value) + 1;
    document.getElementById('numDerHab').value = ii;
    table = document.getElementById('tblDerHab');
    if (ii == 1) {
        table.deleteRow(1);
    }
    myNewRow = table.insertRow(-1);
    myNewRow.id = ii;
    myNewRow.className = 'fila1';
    myNewCell = myNewRow.insertCell(-1);
    myNewCell.innerHTML = "<input type='text' name='codigo[" + ii + "]' id='codigo[" + ii + "]' value='' style='width:60px;font-size:11px' readonly>";
    myNewCell = myNewRow.insertCell(-1);
    myNewCell.innerHTML = "<input type='text' name='nombre[" + ii + "]' id='nombre[" + ii + "]' value='' style='width:220px;font-size:11px' readonly>";
    myNewCell = myNewRow.insertCell(-1);
    myNewCell.innerHTML = "<select name='relacion[" + ii + "]' id='relacion[" + ii + "]' style='width:135px;font-size:11px'></select>";
    myNewCell = myNewRow.insertCell(-1);
    myNewCell.innerHTML = "<img src='../../../../fastmedical_front/imagen/btn/b_eliminar_on.gif' title='Eliminar Derecho Habiente' onclick=\"idfila=this.parentNode.parentNode.rowIndex;elimina_fila_derhabiente(idfila);\"/>";
    data = 'p1=seleccionarParentesco&p2=0013';
    new Ajax.Request('../../ccontrol/control/control.php', {
        method: 'get',
        parameters: data,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            xml = transport.responseXML;
            b = "relacion[" + ii + "]";
            select = $(b);
            select.options.length = 0;
            opt1 = document.createElement('option');
            opt1.appendChild(document.createTextNode('Seleccionar'));
            opt1.value = '0000'
            select.appendChild(opt1);
            arrtipodoc = xml.getElementsByTagName('cParentesco');
            arrnombredoc = xml.getElementsByTagName('vParentesco');
            for (var f = 0; f < arrtipodoc.length; f++) {
                opt = document.createElement('option');
                codigo = arrtipodoc[f].firstChild.nodeValue;
                texto = document.createTextNode(arrnombredoc[f].firstChild.nodeValue);
                opt.value = codigo;
                opt.appendChild(texto)
                select.appendChild(opt);
            }
        //resultado = transport.responseText;
        //alert(resultado);

        /*for(var indice in resultado){
             alert('Indice'+indice+'&'+resultado[indice]);
             }*/
        }
    });
}
function deshabilita_agrega_fila_derhabiente() {
/*    radio1 = document.form_detalle.iddafiliacion;
     for(i=0;i<radio1.length;i++){
     id2=radio1[i].value;
     btn="btnAgregaDerHab["+id2+"]";
     if(document.getElementById(btn)){
     boton=document.getElementById(btn);
     boton.disabled=true;
     boton.style.cursor = 'default';
     boton.style.background='url(../../../../fastmedical_front/imagen/icono/add_user_black.png) no-repeat';
     }
     }
     */
}
function elimina_fila_derhabiente(idfila) {
    table = document.getElementById('tblDerHab');
    table.deleteRow(idfila);
}
function habilita_derhabiente() {
    table = document.getElementById('tblDerHab');
    for (i = 0; i < table.rows.length; i++) {
        idCodigo = "codigo[" + i + "]";
        idNombre = "nombre[" + i + "]";
        idRelacion = "relacion[" + i + "]";
        idBoton = "btnElimDerHab[" + i + "]";
        if (document.getElementById(idCodigo)) {
            $(idCodigo).disabled = false;
            $(idNombre).disabled = false;
            $(idRelacion).disabled = false;
            $(idBoton).disabled = false;
            $(idBoton).style.background = 'url(../../../../fastmedical_front/imagen/btn/b_eliminar_on.gif) no-repeat';
        }
    }
}
function habilita_filiacion() {
    afiliacion = $('dh_filiacion').value;
    radio1 = document.form_detalle.iddafiliacion;
    if (typeof(radio1.length) == 'undefined') {
        numFiliacion = 1;
    }
    else {
        numFiliacion = radio1.length;
    }
    if (numFiliacion > 1) {
        for (i = 0; i < numFiliacion; i++) {
            id2 = radio1[i].value;
            radio1[i].disabled = false;
            btn = "btnAgregaDerHab[" + id2 + "]";
            if (document.getElementById(btn)) {
                boton = document.getElementById(btn);
                boton.disabled = id2 == afiliacion ? false : true;
                boton.style.cursor = id2 == afiliacion ? 'pointer' : 'default';
                boton.style.background = id2 == afiliacion ? 'url(../../../../fastmedical_front/imagen/icono/add_user.png) no-repeat' : 'url(../../../../fastmedical_front/imagen/icono/add_user_black.png) no-repeat';
            }
        }
    }
    else {
        id2 = radio1.value;
        radio1.disabled = false;
        btn = "btnAgregaDerHab[" + id2 + "]";
        if (document.getElementById(btn)) {
            boton = document.getElementById(btn);
            boton.disabled = id2 == afiliacion ? false : true;
            boton.style.cursor = id2 == afiliacion ? 'pointer' : 'default';
            boton.style.background = id2 == afiliacion ? 'url(../../../../fastmedical_front/imagen/icono/add_user.png) no-repeat' : 'url(../../../../fastmedical_front/imagen/icono/add_user_black.png) no-repeat';
        }
    }
}
function habilita_Nofiliacion() {
    btnNoAfiliado = document.getElementById('btnNoAfiliado');
    table = document.getElementById('tblNoFiliPac');
    for (i = 0; i < table.rows.length; i++) {
        idbtn = "btnNoAfiliado[" + i + "]";
        if (document.getElementById(idbtn)) {
            $(idbtn).style.background = 'url(../../../../fastmedical_front/imagen/icono/db_add.png) no-repeat';
            $(idbtn).disabled = false;
        }
    }
}
function habilitia_docIdentidad(tipo) {
    nroDocIdent = $('divDNI').innerHTML;
    if (nroDocIdent == '') {
        nroDocIdent = 1;
    }
    for (i = 1; i <= nroDocIdent; i++) {
        a = "txtNroDocIdent[" + i + "]";
        b = "cbTipoDoc[" + i + "]";

        if (document.getElementById(a)) {

            if (tipo == 'cbo') {
                $(b).disabled = false;
            }
            else if (tipo == 'txt') {
                $(a).disabled = false;
                $(a).readOnly = false;
            }
            else {
                $(b).disabled = false;
                $(a).disabled = false;
                $(a).readOnly = false;
            }
        }
    }
}
function deshabilitia_docIdentidad(tipo) {
    nroDocIdent = $('divDNI').innerHTML;
    for (i = 1; i <= nroDocIdent; i++) {
        a = "txtNroDocIdent[" + i + "]";
        b = "cbTipoDoc[" + i + "]";
        if (document.getElementById(a)) {
            if (tipo == 'cbo') {
                $(b).disabled = true;
            }
            else if (tipo == 'txt') {
                $(a).disabled = true;
                $(a).readOnly = true;
            }
            else {
                $(b).disabled = true;
                $(a).disabled = true;
                $(a).readOnly = true;
            }
        }
    }
}
function habilita_btnIdentidad() {
    nroDocIdent = $('divDNI').innerHTML;
    for (i = 1; i <= nroDocIdent; i++) {
        a = "btnDni[" + i + "]";
        if (document.getElementById(a)) {
            $(a).disabled = false;
            $(a).style.cursor = 'pointer';
            $(a).style.background = i == 1 ? "url(../../../../fastmedical_front/imagen/icono/nuevo_item.png) no-repeat" : "url(../../../imagen/inicio/eliminar.gif) no-repeat";
        }
    }
}
function deshabilita_btnIdentidad() {
    nroDocIdent = $('divDNI').innerHTML;
    for (i = 1; i <= nroDocIdent; i++) {
        a = "btnDni[" + i + "]";
        if (document.getElementById(a)) {
            $(a).disabled = true;
            $(a).style.cursor = 'pointer';
            $(a).style.background = i == 1 ? "url(../../../../fastmedical_front/imagen/icono/nuevo_item_black.png) no-repeat" : "url(../../../imagen/inicio/eliminar.gif) no-repeat";
        }
    }
}
function cargar_nombreInstitucion() {
    tipoInstitucion = $('cb_tipoInstEduc').value;
    var control = 'listaInstEducativa';
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=' + control + '&p2=' + tipoInstitucion;
    new Ajax.Request(url,
    {
        method: 'get',
        parameters: data,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            $('inst_educativa').update(transport.responseText);
            cargar_gradoDeEstudio();
        }
    }
    )
}

function cargar_gradoDeEstudio() {
    tipoInstitucion = $('cb_tipoInstEduc').value;
    var control = 'listaGradoEstudio';
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=' + control + '&p2=' + tipoInstitucion;
    new Ajax.Request(url,
    {
        method: 'get',
        parameters: data,
        onLoading: micargador(1),
        onComplete: function(transport2) {
            micargador(0);
            $('grado_estudio').update(transport2.responseText);
        //alert(transport.responseText);
        }
    }
    )
}
function ValidateEmail(txtEmail) {
    if (/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.(([0-9]{1,3})|([a-zA-Z]{2,3})|(aero|coop|info|museum|name))$/.test(txtEmail)) {
        resultado = true;
    } else {
        alert('La direccion de correo no es valida');
        resultado = false;
    }
    return resultado;
}
function acredita_essalud() {
    tipoDoc = $('cbTipoDoc[1]').value;
    nroDoc = $('txtNroDocIdent[1]').value;
    control = 'acredita_essalud';
    url = '../../ccontrol/control/control.php';
    data = 'p1=' + control + '&p2=' + nroDoc;
    new Ajax.Request(url,
    {
        method: 'get',
        parameters: data,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            alert(transport.responseText);
        }
    }
    )
}

function leerArchivoEssalud() {
    tipoDoc = $('cbTipoDoc[1]').value;
    nroDoc = $('txtNroDocIdent[1]').value;
    control = 'leerArchivoEssalud';
    url = '../../ccontrol/control/control.php';
    data = 'p1=' + control + '&p2=' + nroDoc;
    new Ajax.Request(url,
    {
        method: 'get',
        parameters: data,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            alert(transport.responseText);
        }
    }
    )
}

function calendarioHtmlx(id) {
    window.dhx_globalImgPath = "../dhtmlxCalendar/";
    var fecha = new Date();
    var aniolimite = fecha.getFullYear() + 2;
    dhtmlxCalendarLangModules = new Array();
    dhtmlxCalendarLangModules['es'] = {
        langname: 'es',
        monthesFNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"],
        monthesSNames: ["Ene", "Feb", "May", "Аbr", "Маy", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
        daysFNames: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado"],
        daysSNames: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
        weekend: [0, 6],
        weekstart: 1,
        msgClose: "Cerrar",
        msgMinimize: "Minimizar",
        msgToday: "Hoy"
    }

    mCal = new dhtmlxCalendarObject(id, false, {
        isMonthEditable: true,
        isYearEditable: true,
        dateformat: '%d/%m/%Y'

    });
    mCal.setYearsRange(1900, aniolimite);
    mCal.loadUserLanguage('es');

    mCal.attachEvent("onClick", function(date) {
        var d = new Date(date);
        fecha = d.getDate() + "/" + d.getMonth() + "/" + d.getFullYear();
    //calculaEdad(fecha);
    });

    mCal.draw();


}

function calendarioHtmlxJorge(id) {
    window.dhx_globalImgPath = "../dhtmlxCalendar/";
    var fecha = new Date();
    var aniolimite = fecha.getFullYear() + 2;
    dhtmlxCalendarLangModules = new Array();
    dhtmlxCalendarLangModules['es'] = {
        langname: 'es',
        monthesFNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"],
        monthesSNames: ["Ene", "Feb", "May", "Аbr", "Маy", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
        daysFNames: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado"],
        daysSNames: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
        weekend: [0, 6],
        weekstart: 1,
        msgClose: "Cerrar",
        msgMinimize: "Minimizar",
        msgToday: "Hoy"
    }

    mCal = new dhtmlxCalendarObject(id, false, {
        isMonthEditable: true,
        isYearEditable: true,
        dateformat: '%d/%m/%Y'

    });
    mCal.setYearsRange(1900, aniolimite);
    mCal.loadUserLanguage('es');

    mCal.attachEvent("onClick", function(date) {
        var d = new Date(date);
        fecha = d.getDate() + "/" + d.getMonth() + "/" + d.getFullYear();
        
        cargarPuestoEmpleado();
    });

    mCal.draw();


}

function calendarioAcredita() {
    fecha = new Date();
    aniolimite = fecha.getFullYear() + 2;
    dhtmlxCalendarLangModules = new Array();
    dhtmlxCalendarLangModules['es'] = {
        langname: 'es',
        monthesFNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"],
        monthesSNames: ["Ene", "Feb", "May", "Аbr", "Маy", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
        daysFNames: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado"],
        daysSNames: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
        weekend: [0, 6],
        weekstart: 1,
        msgClose: "Cerrar",
        msgMinimize: "Minimizar",
        msgToday: "Hoy"
    }

    mCal1 = new dhtmlxCalendarObject('dhtmlxCalendar1', false, {
        isMonthEditable: true,
        isYearEditable: true,
        dateformat: '%d/%m/%Y'
    });
    mCal1.setOnClickHandler(seleccionar1);
    mCal1.setYearsRange(2000, aniolimite);
    mCal1.loadUserLanguage('es');
    mCal1.draw();

    mCal2 = new dhtmlxCalendarObject('dhtmlxCalendar2', false, {
        isMonthEditable: true,
        isYearEditable: true,
        dateformat: '%d/%m/%Y'
    });
    mCal2.setOnClickHandler(seleccionar2);
    mCal2.setYearsRange(2000, aniolimite);
    mCal2.loadUserLanguage('es');
    mCal2.draw();

}
function seleccionar1(date) {
    $('txtvigenciadesde').value = mCal1.getFormatedDate(null, date);
    $('dhtmlxCalendar1').style.display = 'none';
}
function seleccionar2(date) {
    document.getElementById('txtvigenciahasta').value = mCal2.getFormatedDate(null, date);
    document.getElementById('dhtmlxCalendar2').style.display = 'none';
}
function mostrarcalendar(id) {
    if ($(id).style.display == 'none')
        $(id).show();
    else
        $(id).hide();
}
function cerrarVentanasEmergentes(div) {
    Windows.close(div);
}
function mSelectDate() {
    var dateformat = '%d/%m/%y';
    mCal.setDateFormat(dateformat);
    document.getElementById('txtFechaNacimiento').innerHTML = mCal.getFormatedDate();
    return true;
}
function setNewDate() {
    var newdateVal = document.getElementById('newdate').value;
    var dateformat = document.getElementById('dateformat').value;
    mCal.setDateFormat(dateformat);
    mCal.setDate(newdateVal);
    document.getElementById('mCalInput').innerHTML = mCal.getFormatedDate();
}
function ventanaEditaPersona(c_cod_per) {


    vformname = 'formBuscadorPersonas'
    vtitle = 'Edición de personas'
    vwidth = '900'
    vheight = '650'
    vcenter = 't'
    vresizable = ''
    vmodal = 'false'
    vstyle = ''
    vopacity = ''

    vposx1 = ''
    vposx2 = ''
    vposy1 = ''
    vposy2 = ''

    var patronModulo = 'mostrar_datos_paciente_admision';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + c_cod_per;
    parametros += '&funcionJSEjecutar=' + '';


    posFuncion = 'editar_persona_ventana';
    //CargarVentana('formBuscadorPersonas','Edición de personas','../../ccontrol/control/control.php?p1=mostrar_datos_paciente_admision&p2='+c_cod_per,'900','650',false,true,'',1,'',10,10,10,10);
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)



//CargarVentana('formBuscadorPersonas','Edición de personas','../../ccontrol/control/control.php?p1=mostrar_datos_paciente_admision&p2='+c_cod_per,'900','650',false,true,'',1,'',10,10,10,10);
}
function editar_persona_ventana() {
    document.getElementById("historia_paciente").style.width = '1015px';
    document.getElementById("historia_paciente").style.height = '700px';
    editar_persona();
    restauraCambios();
    editar_persona();
}
function esFechaValida(fecha) {

    if (fecha != undefined && fecha.value != "") {
        if (!((/^\d{2}\/\d{2}\/\d{4}$/.test(fecha.value)) || ((/^\d{2}\/\d{2}\/\d{2}$/.test(fecha.value))))) {
            alert("formato de fecha no válido (dd/mm/aaaa): " + fecha.value);
            return false;
        }
        var anio = 0
        var dia = parseInt(fecha.value.substring(0, 2), 10);
        var mes = parseInt(fecha.value.substring(3, 5), 10);
        if (/^\d{2}\/\d{2}\/\d{4}$/.test(fecha.value)) {
            anio = parseInt(fecha.value.substring(6), 10);
        }
        if (/^\d{2}\/\d{2}\/\d{2}$/.test(fecha.value)) {
            anio = parseInt(fecha.value.substring(6), 8);
        }


        switch (mes) {
            case 1:
            case 3:
            case 5:
            case 7:
            case 8:
            case 10:
            case 12:
                numDias = 31;
                break;
            case 4:
            case 6:
            case 9:
            case 11:
                numDias = 30;
                break;
            case 2:
                if (comprobarSiBisisesto(anio)) {
                    numDias = 29
                } else {
                    numDias = 28
                }
                ;
                break;
            default:
                alert("Fecha introducida errónea");
                return false;
        }

        if (dia > numDias || dia == 0) {
            alert("Fecha introducida errónea");
            return false;
        }
        if ($('txtFechaNacimiento') != null) {
            fnacimiento = $('txtFechaNacimiento').value;

            calculaEdad(fnacimiento)
        }

        return true;
    }

}

function comprobarSiBisisesto(anio) {
    if ((anio % 100 != 0) && ((anio % 4 == 0) || (anio % 400 == 0))) {
        return true;
    }
    else {
        return false;
    }
}
//function acreditar(evento, elemento, tipos){
//    contadorCargador++;
//        var idCargador=contadorCargador;
//        cargadorpeche(1,idCargador);
//}

function acreditar(evento, elemento, tipo) {
    var dni;
    var apellidoPaterno = '';
    var apellidoMaterno = '';
    var primerNombre = '';
    var segundoNombre = '';
    var tipoBusqueda = '1';
    var adscripciondepartamental;
    if ($('chkadscripciondepartamental').checked == true)
        adscripciondepartamental = '1';
    else
        adscripciondepartamental = '0';
    tipoBusqueda = 'x'
    if (tipo == '01') {
        $('txtApellidoPaterno').value = 'BUSCAR...';
        $('txtApellidoMaterno').value = 'BUSCAR...';
        $('txtPrimerNombre').value = 'BUSCAR...';
        $('txtSegundoNombre').value = 'BUSCAR...';
        dni = $('txtDni').value;
        apellidoPaterno = '';
        apellidoMaterno = '';
        primerNombre = '';
        segundoNombre = '';
        tipoBusqueda = '1'
    }
    if (tipo == '03') {
        $('txtDni').value = 'BUSCAR...';
        dni = '.';
        apellidoPaterno = $('txtApellidoPaterno').value;
        apellidoMaterno = $('txtApellidoMaterno').value;
        primerNombre = $('txtPrimerNombre').value;
        segundoNombre = $('txtSegundoNombre').value;
        if (apellidoPaterno == 'BUSCAR....') {
            apellidoPaterno = '';
            tipoBusqueda = '1'
        }
        if (apellidoMaterno == 'BUSCAR...') {
            apellidoMaterno = '';
            tipoBusqueda = '1'
        }
        if (primerNombre == 'BUSCAR...') {
            primerNombre = '';
            tipoBusqueda = '1'
        }
        if (segundoNombre == 'BUSCAR...') {
            segundoNombre = '';
            tipoBusqueda = '1'
        }
        tipoBusqueda = 'A'
    }
    if (tipo == '04') {
        dni = $('txtDni').value;
        apellidoPaterno = $('txtApellidoPaterno').value;
        apellidoMaterno = $('txtApellidoMaterno').value;
        primerNombre = $('txtPrimerNombre').value;
        segundoNombre = $('txtSegundoNombre').value;
        if (apellidoPaterno == 'BUSCAR...') {
            apellidoPaterno = '';
            tipoBusqueda = '1'
        } else {
            tipoBusqueda = 'A'
        }
        if (apellidoMaterno == 'BUSCAR...') {
            apellidoMaterno = '';
            if (tipoBusqueda != 'A') {
                tipoBusqueda = '1'
            }

        } else {
            tipoBusqueda = 'A'
        }
        if (primerNombre == 'BUSCAR...') {
            primerNombre = '';
            if (tipoBusqueda != 'A') {
                tipoBusqueda = '1'
            }
        } else {
            tipoBusqueda = 'A'
        }
        if (segundoNombre == 'BUSCAR...') {
            segundoNombre = '';
            if (tipoBusqueda != 'A') {
                tipoBusqueda = '1'
            }
        } else {
            tipoBusqueda = 'A'
        }
        if (dni == 'BUSCAR...') {
            dni = '.';
            if (tipoBusqueda != '1') {
                tipoBusqueda = 'A'
            } else {
                tipoBusqueda = 'X'
            }
        }
    }
    apellidoPaterno = apellidoPaterno.toUpperCase();
    apellidoMaterno = apellidoMaterno.toUpperCase();
    primerNombre = primerNombre.toUpperCase();
    segundoNombre = segundoNombre.toUpperCase();
    //var cadena=tipoBusqueda+" "+dni+" "+apellidoPaterno+" "+apellidoMaterno+" "+primerNombre+" "+segundoNombre;
    var departamento = $('cb_departamento').value;
    var provincia = $('cb_provincia').value;
    var distrito = $('cb_distrito').value;
    if (evento == '') {
        tecla = 13;
    } else {
        tecla = evento.keyCode
    }
    if (tecla == 13) {
        $('existePersona').hide();
        $('dcontenedorDetalle').hide();
        var parametros = '';
        var patronModulo = 'acreditarPersonas';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + tipoBusqueda;
        parametros += '&p3=' + dni;
        parametros += '&p4=' + apellidoPaterno;
        parametros += '&p5=' + apellidoMaterno;
        parametros += '&p6=' + primerNombre;
        parametros += '&p7=' + segundoNombre;
        parametros += '&p8=' + departamento;
        parametros += '&p9=' + provincia;
        parametros += '&p10=' + distrito;
        parametros += '&p11=' + adscripciondepartamental;


        tablaAcredita = new dhtmlXGridObject('tablaResultadoBusqueda');
        tablaAcredita.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
        tablaAcredita.setSkin("dhx_skyblue");
        tablaAcredita.enableRowsHover(true, 'grid_hover');

        tablaAcredita.attachEvent("onRowSelect", function(rId, cInd) {
            verPersonaEncontrada(rId, cInd);

        });
        tablaAcredita.attachEvent("onRowDblClicked", function(rId, cInd) {
            acreditarPersona(rId, cInd);

        });
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador = contadorCargador;
        tablaAcredita.attachEvent("onXLS", function() {
            cargadorpeche(1, idCargador);
        });
        tablaAcredita.attachEvent("onXLE", function() {
            cargadorpeche(0, idCargador);
            mensajeVacio();
        });
        /////////////fin cargador ///////////////////////
        tablaAcredita.init();
        tablaAcredita.loadXML(pathRequestControl + '?' + parametros, function() {
            var casa;
            var eps;
            for (i = 0; i < tablaAcredita.getRowsNum(); i++) {
                casa = tablaAcredita.cells(i, 16).getValue();
                eps = tablaAcredita.cells(i, 20).getValue();
                //alert(eps)
                if (casa == '802' && eps == 'ESSALUD')
                    tablaAcredita.setRowTextStyle(tablaAcredita.getRowId(i), 'background-color:#347D9E;color:black;border-top: 1px solid #DAEFC2;');
                else if (casa == '0')
                    tablaAcredita.setRowTextStyle(tablaAcredita.getRowId(i), 'background-color:#FFA66A;color:black;border-top: 1px solid #FFD7BB;');

            }
        });

    }
}
function  verPersonaEncontrada(rId, cInd) {
    if (cInd == 21) {

        var titulo = 'Acreditación Complementaria'
        var vFormaAbrir = 'VENTANA'
        var vformname = 'verDatosEssalud'
        var vtitle = 'Datos Recibidos de Essalud'
        var vwidth = '450'
        var vheight = '350'
        var patronModulo = 'verDatosEssalud';
        var vcenter = 't'
        var vresizable = ''
        var vmodal = 'false'
        var vstyle = ''
        var vopacity = ''
        var veffect = ''
        var vposx1 = ''
        var vposx2 = ''
        var vposy1 = ''
        var vposy2 = ''
        var file01 = ''
        var vfunctionjava = ''
        var posFuncion = '';
        /*---------------------------------------*/
        /*--------------------------------------*/

        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + tablaAcredita.cells(rId, 0).getValue();//nro doc
        parametros += '&p3=' + tablaAcredita.cells(rId, 1).getValue();//codigo
        parametros += '&p4=' + tablaAcredita.cells(rId, 2).getValue();//paterno
        parametros += '&p5=' + tablaAcredita.cells(rId, 3).getValue();//materno
        parametros += '&p6=' + tablaAcredita.cells(rId, 4).getValue();//primer nombre
        parametros += '&p7=' + tablaAcredita.cells(rId, 5).getValue();//segundo nombre
        parametros += '&p8=' + tablaAcredita.cells(rId, 6).getValue();//autogenerado
        parametros += '&p9=' + tablaAcredita.cells(rId, 7).getValue();//ubigeo
        parametros += '&p10=' + tablaAcredita.cells(rId, 8).getValue();//desde
        parametros += '&p11=' + tablaAcredita.cells(rId, 9).getValue();//hasta
        parametros += '&p12=' + tablaAcredita.cells(rId, 10).getValue();//tipo doc
        parametros += '&p13=' + tablaAcredita.cells(rId, 11).getValue();//estado
        parametros += '&p14=' + tablaAcredita.cells(rId, 12).getValue();//sexo
        parametros += '&p15=' + tablaAcredita.cells(rId, 13).getValue();//fecha nac
        parametros += '&p16=' + tablaAcredita.cells(rId, 14).getValue();//tipo seguro
        parametros += '&p17=' + tablaAcredita.cells(rId, 15).getValue();//plan potes
        parametros += '&p18=' + tablaAcredita.cells(rId, 16).getValue();//casAdscripcion
        parametros += '&p19=' + tablaAcredita.cells(rId, 17).getValue(); //mserror
        parametros += '&p20=' + tablaAcredita.cells(rId, 19).getValue(); //flagPotes
        parametros += '&p21=' + tablaAcredita.cells(rId, 20).getValue(); //eps

        //posFuncion="tablaPreciosTratamientoAtencionMedica('"+codigo+"')";
        CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
    }
}
function acreditarPersona(rId, cInd) {
    var codigo = tablaAcredita.cells(rId, 1).getValue();
    //////////verificar si corresponde
    var adsDepartartamental = $('chkadscripciondepartamental').checked;
    var puedeAcreditar;
    var mensaje = '';
    if (adsDepartartamental) {
        var ubigeo = tablaAcredita.cells(rId, 7).getValue();
        var departamento = ubigeo.substring(0, 2)
        if (departamento == 15) {
            puedeAcreditar = false;
            mensaje = 'La persona pertenece a lima, no aplica ads. Departamental';
        } else {
            puedeAcreditar = true;
        }
    } else {
        var casAdscripcion = tablaAcredita.cells(rId, 16).getValue();
        var eps = tablaAcredita.cells(rId, 20).getValue();
        if (casAdscripcion == '802' && eps == 'ESSALUD') {
            //    if(casAdscripcion=='802'){
            puedeAcreditar = true;
        } else {
            puedeAcreditar = false;
            mensaje = 'El lugar de atención no corresponde a Ubap Los Olivos o es EPS';
        }
    }

    //////////
    if (puedeAcreditar) {
        var fechaHasta = tablaAcredita.cells(rId, 9).getValue();
        var arrayFechaHasta = fechaHasta.split("-");
        var fechaDesde = tablaAcredita.cells(rId, 8).getValue();
        var arrayFechaDesde = fechaDesde.split("-");
        var estadoFecha = false;
        if (fechaHasta == '0000-00-00') {
            estadoFecha = false;
        } else {
            var fechaActual = tablaAcredita.cells(rId, 18).getValue();
            var arrayFechaActual = fechaActual.split("-");
            //comparar año
            if (arrayFechaActual[0] > arrayFechaHasta[0]) {
                estadoFecha = false;
            } else {
                if (arrayFechaActual[1] > arrayFechaHasta[1]) {
                    estadoFecha = false;
                } else {
                    estadoFecha = true;
                    //alert('2');
                    if (arrayFechaActual[1] == arrayFechaHasta[1]) {
                        if (arrayFechaActual[2] > arrayFechaHasta[2]) {
                            estadoFecha = false;
                        } else {
                            estadoFecha = true;
                        }
                    }
                }
            }
        }
        if (estadoFecha == true) {
            if (codigo == '--' || codigo == '') {
                //alert('-no encontro');
                var apellidoPaterno = tablaAcredita.cells(rId, 2).getValue();
                var apellidoMaterno = tablaAcredita.cells(rId, 3).getValue();
                var primerNombre = tablaAcredita.cells(rId, 4).getValue();
                var segundoNombre = tablaAcredita.cells(rId, 5).getValue();
                var dni = tablaAcredita.cells(rId, 0).getValue();
                $('existePersona').show();
                obtenerCoincidencias(apellidoPaterno, apellidoMaterno, primerNombre, segundoNombre, dni, rId);
            } else {
                relacionarHmloEssalud('', '', rId);
            }
        } else {
            alert('No se realizó la transferencia, vigencia vencida o NO actualizada en ESSALUD')
        }



    }
    else {
        alert(mensaje);
    }
}
function mensajeVacio() {
    if (tablaAcredita.cells(0, 0).getValue() == 0) {
        alert('no se encontro ningun resultado');
    }
}
function pruebaEssalud() {
    parametros = '';
    patronModulo = 'pruebaEssalud';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('tablaResultados').update(respuesta);
        }
    })
}

function limpiarCamposBusquedaEssalud() {//Junnior
    $('txtDni').value = 'BUSCAR...';
    $('txtApellidoPaterno').value = 'BUSCAR...';
    $('txtApellidoMaterno').value = 'BUSCAR...';
    $('txtPrimerNombre').value = 'BUSCAR...';
    $('txtSegundoNombre').value = 'BUSCAR...';
}

function acreditarPersonaEncontrada(objeto, evento, cadena) {

    var miarray = cadena.split("|");
    $('hcadena').value = cadena;
    codigo1 = trim(miarray[19]);
    apellidoPaterno = miarray[2];
    apellidoMaterno = miarray[3];
    primerNombre = miarray[4];
    segundoNombre = miarray[5];
    fechaVencimiento = miarray[9];
    dni = miarray[12];
    alert(dni)
    $('detalleAcredita').update('');
    if (miarray[8] == '00/00/0000' || miarray[9] == '00/00/0000') {
        mostrarventanaAcreditacionComplementaria(cadena);
    } else {
        if (codigo1 == '') {
            $('existePersona').show();
            obtenerCoincidencias(apellidoPaterno, apellidoMaterno, primerNombre, segundoNombre, dni, fechaVencimiento);
        } else {
            $('existePersona').hide();
            relacionarHmloEssalud('', '', codigo1);
        }
    }
}

function trim(cadena)
{
    for (i = 0; i < cadena.length; )
    {
        if (cadena.charAt(i) == " ")
            cadena = cadena.substring(i + 1, cadena.length);
        else
            break;
    }

    for (i = cadena.length - 1; i >= 0; i = cadena.length - 1)
    {
        if (cadena.charAt(i) == " ")
            cadena = cadena.substring(0, i);
        else
            break;
    }

    return cadena;
}

function actualizarTablaEssalud() {

    cadena = $('hcadena').value;
    var miarray = cadena.split("|");
    d1 = miarray[1];
    apellidoPaterno = miarray[2];
    apellidoMaterno = miarray[3];
    primerNombre = miarray[4];
    segundoNombre = miarray[5];
    autogenerado = miarray[6];
    d7 = miarray[7];//ubigeo
    if (miarray[8] == '00/00/0000') {
        miarray[8] = '01/01/1900';
    }
    if (miarray[9] == '00/00/0000') {
        miarray[9] = '01/01/1900';
    }
    d8 = miarray[8];//fecha inicio
    d9 = miarray[9];
    fechaVencimiento = miarray[9];
    tipoDocumento = miarray[11];
    numeroDocumento = miarray[12];
    sexo = miarray[13];
    fechaNacimiento = miarray[14];
    d14 = miarray[15];
    d15 = miarray[16];
    d16 = miarray[17];
    d17 = miarray[18];
    codigo = miarray[19];

    //patronModulo = "acreditarPersonaRegistradaHmlo";
    patronModulo = 'actualizarTablaEssalud';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + d1;
    parametros += '&p3=' + apellidoPaterno;
    parametros += '&p4=' + apellidoMaterno;
    parametros += '&p5=' + primerNombre;
    parametros += '&p6=' + segundoNombre;
    parametros += '&p7=' + autogenerado;
    parametros += '&p8=' + d7;
    parametros += '&p9=' + d8;

    parametros += '&p10=' + fechaVencimiento;
    parametros += '&p11=' + '0001';
    parametros += '&p12=' + numeroDocumento;
    parametros += '&p13=' + sexo;
    parametros += '&p14=' + fechaNacimiento;
    parametros += '&p15=' + d14;
    parametros += '&p16=' + d15;
    parametros += '&p17=' + d16;
    parametros += '&p18=' + d17;
    parametros += '&p19=' + codigo;



    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
        //$('divCoincidencias').update(respuesta);


        }
    })

}
function obtenerCoincidencias(apellidoPaterno, apellidoMaterno, primerNombre, segundoNombre, dni, rId) {
    $('dcontenedorDetalle').hide();
    apellidoPaterno = dTrim(apellidoPaterno);//validación de espacios en blanco al final
    apellidoMaterno = dTrim(apellidoMaterno);
    primerNombre = dTrim(primerNombre);
    segundoNombre = dTrim(segundoNombre);
    var patronModulo = "obtenerCoincidencias";
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + apellidoPaterno;
    parametros += '&p3=' + apellidoMaterno;
    parametros += '&p4=' + primerNombre;
    parametros += '&p5=' + segundoNombre;
    parametros += '&p6=' + dni;
    parametros += '&p7=' + rId;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            var respuesta = transport.responseText;
            var arreglo = respuesta.split("|");
            if (arreglo[0] == '0') {
                $('divCoincidencias').update(arreglo[1]);
            }
            else {
                window.alert(arreglo[1]);
            }
        }
    })

}
function cancelarRegistroEssalud() {
    $('existePersona').hide();
}
function registrarPersonaEssalud(rId) {
    if (window.confirm("Esta seguro que desea agregar a esta persona a la base de datos del HMLO? ")) {
        var apellidoPaterno = tablaAcredita.cells(rId, 2).getValue();
        var apellidoMaterno = tablaAcredita.cells(rId, 3).getValue();
        var primerNombre = tablaAcredita.cells(rId, 4).getValue();
        var segundoNombre = tablaAcredita.cells(rId, 5).getValue();
        var autogenerado = tablaAcredita.cells(rId, 6).getValue();
        var ubigeo = tablaAcredita.cells(rId, 7).getValue();//ubigeo
        var d8 = tablaAcredita.cells(rId, 8).getValue();//fecha inicio
        var d9 = tablaAcredita.cells(rId, 9).getValue();
        var fechaVencimiento = tablaAcredita.cells(rId, 9).getValue();
        var tipoDocumento = tablaAcredita.cells(rId, 10).getValue();
        var numeroDocumento = tablaAcredita.cells(rId, 0).getValue();
        var sexo = tablaAcredita.cells(rId, 12).getValue();
        var fechaNacimiento = tablaAcredita.cells(rId, 13).getValue();
        fechaNacimiento = fechaNacimiento.substring(8, 10) + '/' + fechaNacimiento.substring(5, 7) + '/' + fechaNacimiento.substring(0, 4);
        var codigo = tablaAcredita.cells(rId, 1).getValue();
        var patronModulo = 'gravaPersonaEssalud';
        var parametros = '';

        parametros += 'p1=' + patronModulo;
        parametros += '&txtApellidoPat=' + apellidoPaterno;
        parametros += '&txtApellidoMat=' + apellidoMaterno;
        parametros += '&txtNombrePaciente=' + primerNombre + " " + segundoNombre;
        parametros += '&primerNombre=' + primerNombre;
        parametros += '&segundoNombre=' + segundoNombre;
        parametros += '&p6=' + autogenerado;
        parametros += '&p7=' + ubigeo;
        parametros += '&p8=' + d8;
        parametros += '&fechaVencimiento=' + fechaVencimiento;
        parametros += '&txtFechaNacimiento=' + fechaNacimiento;
        if (tipoDocumento == '1') {
            parametros += '&cbTipoDoc[1]=' + '0001';
        }
        if (tipoDocumento == '2') {
            parametros += '&cbTipoDoc[1]=' + '0010';
        }
        if (tipoDocumento == '6') {
            parametros += '&cbTipoDoc[1]=' + '0007';
        }
        parametros += '&txtNroDocIdent[1]=' + numeroDocumento;
        parametros += '&numeroDocumento=' + numeroDocumento;
        parametros += '&tipoDocumento=' + tipoDocumento;
        parametros += '&p12=' + sexo;

        if (sexo == 'M') {
            parametros += '&sexo=' + '1';
        } else {
            if (sexo == 'F') {
                parametros += '&sexo=' + '0';
            } else {
                parametros += '&sexo=' + '';
            }
        }
        parametros += '&p13=' + fechaNacimiento;
        parametros += '&p18=' + '';
        parametros += '&p_acc=' + 'inserted';
        parametros += '&txtCodigoPersona=' + codigo;
        parametros += '&txtEdad=' + " ";
        parametros += '&cb_civil=' + '0000';
        parametros += '&txtTelefono=' + '';
        parametros += '&txtCelular=' + '';
        parametros += '&txtCelular2=' + '';
        parametros += '&txtEmail=' + '';

        ///// sin ubigeo hasta que essalud nos confirme
        var pais = $('cb_pais').value;
        var departamento = ubigeo.substring(0, 2);
        var provincia = ubigeo.substring(2, 4);
        var distrito = ubigeo.substring(4, 6);

        ///////////////
        departamento = $('cb_departamento').value;
        provincia = $('cb_provincia').value;
        distrito = $('cb_distrito').value;
        //////////////////////////////////////
        parametros += '&cb_pais=' + pais;
        parametros += '&cb_departamento=' + departamento;
        parametros += '&cb_provincia=' + provincia;
        parametros += '&cb_distrito=' + distrito;

        parametros += '&cb_via=' + '0000';
        parametros += '&txtNombreTipoVia=' + '';
        parametros += '&cb_cpo=' + '0000';
        parametros += '&txtTipoCentroPoblado=' + '';
        parametros += '&txtNumero=' + '';
        parametros += '&txtManzana=' + '';
        parametros += '&txtLote=' + '';
        parametros += '&txtKm=' + '';

        parametros += '&txtNroHistoria=' + '';
        parametros += '&cb_raza=' + '0000';
        parametros += '&cbNac_pais=' + pais;
        parametros += '&cbNac_departamento=' + '0000';
        parametros += '&cbNac_provincia=' + '0000';
        parametros += '&cbNac_distrito=' + '0000';

        parametros += '&cb_grupolaboral=' + '0000';
        parametros += '&cb_subgrupolaboral=' + '0000';
        parametros += '&cb_condicion=' + '0000';
        parametros += '&cb_instruccion=' + '0000';
        parametros += '&cb_tipoInstEduc=' + '0000';
        parametros += '&cb_InstEduc=' + '0000';

        parametros += '&cb_grado_estudio=' + '0000';
        parametros += '&cb_vivienda=' + '0000';
        parametros += '&txtHijos=' + '';
        parametros += '&txtNroDeHijo=' + '';
        parametros += '&cb_medio_contacto=' + '0000';
        parametros += '&dh_filiacion=' + '0027';

        parametros += '&codigo=' + '';
        parametros += '&nombre=' + '';
        parametros += '&relacion=' + '';
        parametros += '&txtObservaciones=' + 'Registrado por acreditación';
        parametros += '&txtFotografia=' + '';
        parametros += '&vReferencia=' + '';                                                                 //
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                var respuesta = transport.responseText;
                detalleAcredita(respuesta);
                $('existePersona').hide();
            }
        })
    }
}



function relacionarHmloEssalud(objeto, evento, fila) {
    var rId;
    var guion = fila.indexOf('-');
    var codigo;
    if (guion == -1) {
        rId = fila;
        codigo = tablaAcredita.cells(rId, 1).getValue();
    } else {
        rId = fila.substring(guion + 1);
        codigo = fila.substring(0, guion);
    }
    if (window.confirm("Esta seguro que desea acreditar a esta persona de essalud en HMLO? ")) {
        var apellidoPaterno = tablaAcredita.cells(rId, 2).getValue();
        var apellidoMaterno = tablaAcredita.cells(rId, 3).getValue();
        var primerNombre = tablaAcredita.cells(rId, 4).getValue();
        var segundoNombre = tablaAcredita.cells(rId, 5).getValue();
        var autogenerado = tablaAcredita.cells(rId, 6).getValue();
        d7 = tablaAcredita.cells(rId, 7).getValue();//ubigeo
        d8 = tablaAcredita.cells(rId, 8).getValue();
        var fechaVencimiento = tablaAcredita.cells(rId, 9).getValue();
        var tipoDocumento = tablaAcredita.cells(rId, 10).getValue();
        var numeroDocumento = tablaAcredita.cells(rId, 0).getValue();
        var sexo = tablaAcredita.cells(rId, 12).getValue();
        var fechaNacimiento = tablaAcredita.cells(rId, 13).getValue();
        fechaNacimiento = fechaNacimiento.substring(8, 10) + '/' + fechaNacimiento.substring(5, 7) + '/' + fechaNacimiento.substring(0, 4);
        var patronModulo = 'relacionaHmloEssalud';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&txtApellidoPat=' + apellidoPaterno;
        parametros += '&txtApellidoMat=' + apellidoMaterno;
        parametros += '&txtNombrePaciente=' + primerNombre + " " + segundoNombre;
        parametros += '&primerNombre=' + primerNombre;
        parametros += '&segundoNombre=' + segundoNombre;
        parametros += '&p6=' + autogenerado;
        parametros += '&p7=' + d7;
        parametros += '&p8=' + d8;
        parametros += '&fechaVencimiento=' + fechaVencimiento;
        parametros += '&txtFechaNacimiento=' + fechaNacimiento;
        if (tipoDocumento == '1') {
            parametros += '&cbTipoDoc[1]=' + '0001';
        }
        if (tipoDocumento == '2') {
            parametros += '&cbTipoDoc[1]=' + '0010';
        }
        if (tipoDocumento == '6') {
            parametros += '&cbTipoDoc[1]=' + '0007';
        }
        parametros += '&txtNroDocIdent[1]=' + numeroDocumento;
        parametros += '&numeroDocumento=' + numeroDocumento;
        parametros += '&tipoDocumento=' + tipoDocumento;
        parametros += '&p12=' + sexo;

        if (sexo == 'M') {
            parametros += '&sexo=' + '1';
        } else {
            if (sexo == 'F') {
                parametros += '&sexo=' + '0';
            } else {
                parametros += '&sexo=' + '';
            }
        }
        parametros += '&p13=' + fechaNacimiento;
        parametros += '&p18=' + '';
        departamento = $('cb_departamento').value;
        provincia = $('cb_provincia').value;
        distrito = $('cb_distrito').value;
        if (d7 == '150117' || d7 == '150194') {
            parametros += '&cb_departamento=' + departamento;
            parametros += '&cb_provincia=' + provincia;
            parametros += '&cb_distrito=' + distrito;
        } else {
            parametros += '&cb_departamento=' + departamento;
            parametros += '&cb_provincia=' + provincia;
            parametros += '&cb_distrito=' + '00';
        }
        parametros += '&dh_filiacion=' + '0027';
        parametros += '&codigo=' + codigo;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                var respuesta = transport.responseText;
                arreglo = respuesta.split("|");
                if (arreglo[0] == '0')
                    detalleAcredita(arreglo[1]);
                else
                    window.alert(arreglo[1]);
                $('detalleAcredita').update(respuesta);
                $('existePersona').hide();
            }
        })

    }

}
function mostrarventanaAcreditacionComplementaria(cadena) {
    titulo = 'Acreditación Complementaria'
    vFormaAbrir = 'VENTANA'
    vformname = 'acreditaciónComplementaria'
    vtitle = 'Acreditación Complementaria'
    vwidth = '400'
    vheight = '150'
    patronModulo = 'mostrarVentanaAcreditacionComplementaria';
    vcenter = 't'
    vresizable = ''
    vmodal = 'false'
    vstyle = ''
    vopacity = ''
    veffect = ''
    vposx1 = ''
    vposx2 = ''
    vposy1 = ''
    vposy2 = ''
    file01 = ''
    vfunctionjava = ''
    //posFuncion = ''
    /*---------------------------------------*/
    /*--------------------------------------*/
    //    posFuncion='asignarPadreExamenFisico';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + cadena;
    posFuncion = "calendarioAcredita";
    //posFuncion="tablaPreciosTratamientoAtencionMedica('"+codigo+"')";
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)

}
function aceptarAcreditacionComplementaria(cadena) {
    cadena = $('hcadena').value;
    miarray = cadena.split("|");
    vigenciadesde = $('txtvigenciadesde').value;
    vigenciahasta = $('txtvigenciahasta').value;
    codigo1 = trim(miarray[19]);
    apellidoPaterno = miarray[2];
    apellidoMaterno = miarray[3];
    primerNombre = miarray[4];
    segundoNombre = miarray[5];
    dni = miarray[12];
    miarray[8] = vigenciadesde;
    miarray[9] = vigenciahasta;
    cadena1 = '';
    for (i = 0; i < miarray.length; i++) {
        if (i != miarray.length - 1)
            cadena1 = cadena1 + miarray[i] + '|';
        else
            cadena1 = cadena1 + miarray[i];

    }
    $('hcadena').value = cadena1;
    if (codigo1 == '') {
        $('existePersona').show();
        obtenerCoincidencias(apellidoPaterno, apellidoMaterno, primerNombre, segundoNombre, dni);
    } else {
        $('existePersona').hide();
        relacionarHmloEssalud('', '', codigo1);
    }
    cerrarVentanasEmergentes('Div_acreditaciónComplementaria');

}
function habilitaradscripciondepartamental() {

    var cantidad;
    var departamento = $('cb_departamento');
    var provincia = $('cb_provincia');
    var distrito = $('cb_distrito');

    if ($('chkadscripciondepartamental').checked == true) {
        $('chkadscripciondepartamental').checked = false;
        cantidad = departamento.length;
        for (i = 0; i < cantidad; i++) {
            if (departamento[i].value == '15') {
                departamento[i].selected = true;
            }
        }
        cantidad = provincia.length;
        for (i = 0; i < cantidad; i++) {
            if (provincia[i].value == '01') {
                provincia[i].selected = true;
            }
        }
        cantidad = distrito.length;
        for (i = 0; i < cantidad; i++) {
            if (distrito[i].value == '17') {
                distrito[i].selected = true;
            }
        }
    } else {
        $('chkadscripciondepartamental').checked = true;
        cantidad = departamento.length;
        for (i = 0; i < cantidad; i++) {
            if (departamento[i].value == '0000') {
                departamento[i].selected = true;
            }
        }
        cantidad = provincia.length;
        for (i = 0; i < cantidad; i++) {
            if (provincia[i].value == '0000') {
                provincia[i].selected = true;
            }
        }
        cantidad = distrito.length;
        for (i = 0; i < cantidad; i++) {
            if (distrito[i].value == '0000') {
                distrito[i].selected = true;
            }
        }
    }

}
function detalleAcredita(codigo) {
    // cadena=$('hcadena').value;
    var patronModulo = 'detalleAcredita';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            var respuesta = transport.responseText;
            $('dcontenedorDetalle').show();
            $('detalleAcredita').update(respuesta);
        }
    })
}

function filaEncontrada(cadena, codigo) {
    patronModulo = 'filaEncontrada';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + cadena;
    parametros += '&p3=' + codigo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('tablaResultados').update(respuesta);
        //window.alert('codigo:'+codigo);

        }
    })
}

function calcular_edad(fecha) {

    //calculo la fecha de hoy
    hoy = new Date()
    //alert(hoy)

    //calculo la fecha que recibo
    //La descompongo en un array
    var array_fecha = fecha.split("/")
    //si el array no tiene tres partes, la fecha es incorrecta
    if (array_fecha.length != 3)
        return false

    //compruebo que los ano, mes, dia son correctos
    var ano
    ano = parseInt(array_fecha[2]);
    if (isNaN(ano))
        return false

    var mes
    mes = parseInt(array_fecha[1]);
    if (isNaN(mes))
        return false

    var dia
    dia = parseInt(array_fecha[0]);
    if (isNaN(dia))
        return false


    //si el año de la fecha que recibo solo tiene 2 cifras hay que cambiarlo a 4
    if (ano <= 99)
        ano += 1900

    //resto los años de las dos fechas
    edad = hoy.getYear() - ano - 1; //-1 porque no se si ha cumplido años ya este año

    //si resto los meses y me da menor que 0 entonces no ha cumplido años. Si da mayor si ha cumplido
    if (hoy.getMonth() + 1 - mes < 0) //+ 1 porque los meses empiezan en 0
        return edad
    if (hoy.getMonth() + 1 - mes > 0)
        return edad + 1

    //entonces es que eran iguales. miro los dias
    //si resto los dias y me da menor que 0 entonces no ha cumplido años. Si da mayor o igual si ha cumplido
    if (hoy.getUTCDate() - dia >= 0)
        return edad + 1

    return edad
}

function ventanaVerAtenciones() {
    vformname = 'formBuscadorPersonas'
    vtitle = 'Ver Atenciones'
    vwidth = '950'
    vheight = '450'
    vcenter = 't'
    vresizable = ''
    vmodal = 'false'
    vstyle = ''
    vopacity = ''

    vposx1 = ''
    vposx2 = ''
    vposy1 = ''
    vposy2 = ''

    patronModulo = 'ventanaVerAtenciones';
    parametros = '';
    parametros += 'p1=' + patronModulo;


    posFuncion = '';

    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
}

function verAtencionesMedicas(evento, elemento, c_cod_per) {
    patronModulo = 'verAtencionesMedicas';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + c_cod_per;
    rTablaAtenciones = new dhtmlXGridObject('resultadoAtenciones');
    rTablaAtenciones.setImagePath("../../../imagen/dhtmlxgrid/imgs/");  
    rTablaAtenciones.setSkin("dhx_skyblue");
    rTablaAtenciones.enableRowsHover(true, 'grid_hover');
    rTablaAtenciones.enableMultiline(true);
    var header = ["#text_filter","#text_filter","#text_filter","#text_filter","#text_filter","#text_filter","#text_filter","#text_filter","#text_filter"]; 
    rTablaAtenciones.attachHeader(header); 
    rTablaAtenciones.attachEvent("onRowSelect", function(rId, cInd) {
        var vEstado=rTablaAtenciones.cells2(rId,5).getValue();  
        $('hCodigoProgramacion').value=rTablaAtenciones.cells2(rId,0).getValue();
        verCronogramaAtencionesMedicas('','',rTablaAtenciones.cells2(rId,6).getValue());             
        if(cInd==9 && (vEstado=='PAGADO' || vEstado=='ATENDIDO')){                        
            ubicacionImagenes();
        }
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    rTablaAtenciones.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    rTablaAtenciones.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    rTablaAtenciones.init();
    rTablaAtenciones.loadXML(pathRequestControl + '?' + parametros, function() {
        for(var i=0;i<rTablaAtenciones.getRowsNum();i++){           
            var  bEstado = rTablaAtenciones.cells2(i,5).getValue();
            if (bEstado == 'ATENDIDO') {
                rTablaAtenciones.setRowColor(rTablaAtenciones.getRowId(i), "#DEEDF8");                
            }
            else if (bEstado== 'RESERVADO') {
                rTablaAtenciones.setRowColor(rTablaAtenciones.getRowId(i), "#F0F43A");
            }
            else if (bEstado== 'PAGADO') {
                rTablaAtenciones.setRowColor(rTablaAtenciones.getRowId(i),"#F8A83E");                
            }
            else if (bEstado == 'BLOQUEADO') {
                rTablaAtenciones.setRowColor(rTablaAtenciones.getRowId(i), "#FFB2B2");
            }           
        }
    });
    verDatosPaciente(c_cod_per);
}

function verCronogramaAtencionesMedicas(elemento, evento, cadena) {

    Windows.close("Div_formBuscadorPersonas", '');

    var miarray = cadena.split("|");
    var codigoprogramacion = miarray[0];
    var hora = miarray[1];
    var cronograma = miarray[2];
    //window.alert(hora + cronograma)



    $('hFecha').value = miarray[3];
    $("hServicio").value = miarray[5];
    $("hNombreCentroCosto").value = "<font color=\"#00AA00\">Medico : " + miarray[6] + "</font>";
    // document.getElementById("hCodigoPersonalSalud").value = "<font color=\"#00AA00\">Medico : " + miarray[4]+"</font>" ;
    $("hCodigoPersonalSalud").value = miarray[4];
    $("hOpcionBusqueda").value = 2;
    actualizahoraycronograma(hora, cronograma);

    descripcionCita(hora, cronograma, codigoprogramacion);
    refrescaCalendario(miarray[3]);
    //descripcionCita(hora,cronograma,codigoprogramacion);
    if($('selectVista').value==1){
        regresaracronogramacitas();//
    }else{
        mostrarProgramacionEmergenciaInformes(cronograma);
    // listarCronogramaMedicoEmergencia(cronograma);
    }
    
   
    $('divAccionesyBotones').show();
    $('divAcciones').hide();

}
function verDatosPaciente(c_cod_per) {
    patronModulo = 'verDatosPaciente';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + c_cod_per;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta1 = transport.responseText;
            miarray = respuesta1.split("|");
            $('divCodigo').update(miarray[0]);
            $('divFiliacion').update(miarray[1]);
            $('divNombre').update(miarray[3]);
            $('divDocumento').update(miarray[2]);
            $('divFechaNacimiento').update(miarray[4]);
            $('divEdad').update(miarray[5]);
        //window.alert('codigo:'+codigo);

        }
    })
}
function mostrarVentanaHistoriaClinica() {
    codigopersona = $('txtCodigoPersona').value;
    if (codigopersona != '') {
        titulo = 'Historia Clinica'
        vFormaAbrir = 'VENTANA'
        vformname = 'historiaclinica'
        vtitle = 'HISTORIA CLINICA'
        vwidth = '1050'
        vheight = '600'
        vcenter = 't'
        vresizable = ''
        vmodal = 'false'
        vstyle = ''
        vopacity = ''
        veffect = ''
        vposx1 = ''
        vposx2 = ''
        vposy1 = ''
        vposy2 = ''
        file01 = ''
        vfunctionjava = ''
        /*---------------------------------------*/
        patronModulo = 'mostrarVentanaHistoriaClinica';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        /*--------------------------------------*/
        posFuncion = 'obtenerCodigoPaciente';

        CargarVentanaPopPapExamenPadre(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
    } else {
        window.alert('Por favor seleccione una persona');
    }

}

function mantenimientoParentesco() {
    codPersona = $("txtcodigoPersona").value;
}

function buscarParentescoPaciente() {
    vformname = 'buscarParentescoPaciente'
    vtitle = 'BUSCAR PARIENTES'
    vwidth = '700'
    vheight = '400'
    vcenter = 't'
    vresizable = ''
    vmodal = 'false'
    vstyle = ''
    vopacity = ''
    vposx1 = ''
    vposx2 = ''
    vposy1 = ''
    vposy2 = ''
    funcion = ''
    patronModulo = 'buscarParentescoPaciente';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    posFuncion = '';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function seleccionarParentescoPaciente(que, event, codPariente) {//codpersona : codigo del pariente , tio madre,querida,trampa etc......
    if (confirm('¿Estás seguro de registrar como PARENTESCO al PACIENTE.?')) {
        var codPersonaTitular = $("hidCodPersona").value;
        var parametros = "p1=grabarParentescoPaciente&p2=" + codPersonaTitular + "&p3=" + codPariente;
        enviarFormularioSincronizado("", parametros, "listaParentescoPaciente", "");
        Windows.close("Div_buscarParentescoPaciente", "");
    }

}
function listaParentescoPaciente() {
    var codPersonaTitular = $("hidCodPersona").value;
    var parametros = "p1=listaParentescoPaciente&p2=" + codPersonaTitular;
    var div = "divListaParentesco", funcionClick = "accionesParentescoPaciente", funcionDblClick = "", funcionLoad = "";
    generarTablax(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}

function accionesParentescoPaciente(fil, col) {
    var idPerentescoDePersona = mygridx.cells(fil, 0).getValue();
    var parametros;
    switch (col) {
        case '6': //Asignar Pariente
            var idParentesco = mygridx.cells(fil, 5).getValue();
            var idParentescox = parseInt(idParentesco);
            if (idParentescox > 0)
            {
                parametros = "p1=asingarParientePaciente&p2=" + idPerentescoDePersona + "&p3=" + idParentescox;
                enviarFormularioSincronizado("", parametros, "listaParentescoPaciente", "");
            }
            break;
        case '7': //Eliminar
            parametros = "p1=eliminarParentescoPaciente&p2=" + idPerentescoDePersona;
            enviarFormularioSincronizado("", parametros, "listaParentescoPaciente", "");
            break;
    }

}

function cargarTablaAfiliacionesPersona(codPersona) {
    $('Essalud').hide();
    $('DetalleDeuda').hide();
    $('Detalle').hide();
    var CodigoPersona = codPersona;
    document.getElementById('tablaAfiliacionesPersona');
    patronModulo = 'tablaxAfiliacionesPersona';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + CodigoPersona;
    rTablaAfiliaciones = new dhtmlXGridObject('tablaAfiliacionesPersona');
    rTablaAfiliaciones.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    rTablaAfiliaciones.setSkin("dhx_skyblue");
    rTablaAfiliaciones.enableRowsHover(true, 'grid_hover');
    rTablaAfiliaciones.attachEvent("onRowSelect", function(rId, cInd) {
        var CodAutogenerado = rTablaAfiliaciones.cells(rId, 9).getValue();
        // $('autogenerado').value = CodAutogenerado;
        var IdAfil = rTablaAfiliaciones.cells(rId, 0).getValue();
        var Estado = rTablaAfiliaciones.cells(rId, 6).getValue();
        var NumeroAfil = rTablaAfiliaciones.cells(rId, 2).getValue();
        if (cInd == 10) {
            if (IdAfil == '0027') {
                if (Estado == 0) {
                    $('DetalleDeuda').hide();
                    $('Detalle').hide()
                    $('Essalud').hide();
                    //activarAfiliacionEssalud(CodigoPersona,IdAfil,NumeroAfil);  
                    popadDatosEssalud(CodigoPersona);
                }
            }
            else if (IdAfil == '0002') {
                if (Estado == 0) {
                    $('DetalleDeuda').show();
                    $('Detalle').hide()
                    $('Essalud').hide();
                    // abrirPopadContribuyentePuntualBusquedaRelacionDBSIMI();
                    //tablaEstadoDeuda(CodigoPersona,IdAfil,NumeroAfil );
                    verificarExistenciaDBContribuyentePuntual(CodigoPersona);
                }
            }
            else {
                $('DetalleDeuda').hide();
                $('Detalle').hide();
                $('Essalud').hide();
                activarAfiliacion(CodigoPersona, IdAfil, NumeroAfil);
            }
        }

        if (IdAfil == '0027') {
            if (Estado == 1) {
                $('DetalleDeuda').hide();
                $('Detalle').show();
                $('Essalud').hide();
                spListaPersonaEssalud(codPersona);
                spListaDatosEssalud(codPersona);
                spListaCabeceraCartaEssalud(codPersona);
                spListaDetalleCartaEssaludPorCabeceraCarta(codPersona);
            }
        }
        else if (IdAfil == '0002') {
            $('DetalleDeuda').show();
            verificarExistenciaDBContribuyentePuntual(CodigoPersona);
        }
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    rTablaAfiliaciones.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    rTablaAfiliaciones.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    rTablaAfiliaciones.init();
    rTablaAfiliaciones.loadXML(pathRequestControl + '?' + parametros, function() {
        });
}


function tablaEstadoDeuda(CodigoPersona) {
    patronModulo = 'TablaEstadoDeuda';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + CodigoPersona;
    aEstadoDeuda = new dhtmlXGridObject('contenedorEstadoDeuda');
    aEstadoDeuda.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    aEstadoDeuda.setSkin("");
    aEstadoDeuda.enableRowsHover(true, 'grid_hover');
    aEstadoDeuda.attachEvent("onRowSelect", function(rId, cInd) {
        var Mensaje = aEstadoDeuda.cells(rId, 0).getValue();
        var Resultado = aEstadoDeuda.cells(rId, 1).getValue();
        var Deuda = aEstadoDeuda.cells(rId, 2).getValue();
        if (cInd == 3) {
            switch (Resultado) {
                case "1":
                    alert("Contribuyente con deuda...");
                    break;
                case "0":
                    if (Deuda == 0) {
                        var CodSimedh = $('txtCodigoPersona').value;
                        guardarRelacionEntreDBSIMIandSIMED(CodSimedh, CodigoPersona);
                    }
                    else {
                        alert("Sin predio no aplica Contribuyente Puntual");
                    }
                    break;
                default :
                    break
            }
        }
    }
    );
    contadorCargador++;
    var idCargador = contadorCargador;
    aEstadoDeuda.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    aEstadoDeuda.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    aEstadoDeuda.init();
    aEstadoDeuda.loadXML(pathRequestControl + '?' + parametros, function() {
        });
}

function spListaPersonaEssalud(codPersona) {
    patronModulo = 'spListaPersonaEssalud';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codPersona;
    pListaPersonaEssalud = new dhtmlXGridObject('spListaPersonaEssalud');
    pListaPersonaEssalud.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    pListaPersonaEssalud.setSkin("dhx_skyblue");
    pListaPersonaEssalud.enableRowsHover(true, 'grid_hover');
    contadorCargador++;
    var idCargador = contadorCargador;
    pListaPersonaEssalud.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    pListaPersonaEssalud.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    pListaPersonaEssalud.init();
    pListaPersonaEssalud.loadXML(pathRequestControl + '?' + parametros, function() {
        var casa;
        for (i = 0; i < pListaPersonaEssalud.getRowsNum(); i++) {
            casa = pListaPersonaEssalud.cells(i, 4).getValue();
            if (casa == '1')
                pListaPersonaEssalud.setRowTextStyle(pListaPersonaEssalud.getRowId(i), 'background-color:#C1E69D;color:black;border-top: 1px solid #DAEFC2;');
            else if (casa == '0')
                pListaPersonaEssalud.setRowTextStyle(pListaPersonaEssalud.getRowId(i), 'background-color:#FFA66A;color:black;border-top: 1px solid #FFD7BB;');
        }
    });
}
function spListaDatosEssalud(codPersona) {
    patronModulo = 'spListaDatosEssalud';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codPersona;
    aDatosEssalud = new dhtmlXGridObject('spListaDatosEssalud');
    aDatosEssalud.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    aDatosEssalud.setSkin("dhx_skyblue");
    aDatosEssalud.enableRowsHover(true, 'grid_hover');
    contadorCargador++;
    var idCargador = contadorCargador;
    aDatosEssalud.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    aDatosEssalud.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    aDatosEssalud.init();
    aDatosEssalud.loadXML(pathRequestControl + '?' + parametros);
}

function spListaCabeceraCartaEssalud(codPersona) {
    patronModulo = 'spListaCabeceraCartaEssalud';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codPersona;
    aCabeceraCartaEssalud = new dhtmlXGridObject('spListaCabeceraCartaEssalud');
    aCabeceraCartaEssalud.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    aCabeceraCartaEssalud.setSkin("dhx_skyblue");
    aCabeceraCartaEssalud.enableRowsHover(true, 'grid_hover');
    contadorCargador++;
    var idCargador = contadorCargador;
    aCabeceraCartaEssalud.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    aCabeceraCartaEssalud.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    aCabeceraCartaEssalud.init();
    aCabeceraCartaEssalud.loadXML(pathRequestControl + '?' + parametros, function() {
        var casa;
        for (i = 0; i < aCabeceraCartaEssalud.getRowsNum(); i++) {
            casa = aCabeceraCartaEssalud.cells(i, 3).getValue();
            if (casa == '1')
                aCabeceraCartaEssalud.setRowTextStyle(aCabeceraCartaEssalud.getRowId(i), 'background-color:#C1E69D;color:black;border-top: 1px solid #DAEFC2;');
            else if (casa == '2')
                aCabeceraCartaEssalud.setRowTextStyle(aCabeceraCartaEssalud.getRowId(i), 'background-color:#FFA66A;color:black;border-top: 1px solid #FFD7BB;');
        }
    });
}
function spListaDetalleCartaEssaludPorCabeceraCarta(codPersona) {
    patronModulo = 'spListaDetalleCartaEssaludPorCabeceraCarta';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codPersona;
    aEssaludPorCabeceraCarta = new dhtmlXGridObject('spListaDetalleCartaEssaludPorCabeceraCarta');
    aEssaludPorCabeceraCarta.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    aEssaludPorCabeceraCarta.setSkin("dhx_skyblue");
    aEssaludPorCabeceraCarta.enableRowsHover(true, 'grid_hover');
    contadorCargador++;
    var idCargador = contadorCargador;
    aEssaludPorCabeceraCarta.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    aEssaludPorCabeceraCarta.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    aEssaludPorCabeceraCarta.init();
    aEssaludPorCabeceraCarta.loadXML(pathRequestControl + '?' + parametros, function() {
        var casa;
        for (i = 0; i < aEssaludPorCabeceraCarta.getRowsNum(); i++) {
            casa = aEssaludPorCabeceraCarta.cells(i, 6).getValue();
            if (casa == '1')
                aEssaludPorCabeceraCarta.setRowTextStyle(aEssaludPorCabeceraCarta.getRowId(i), 'background-color:#C1E69D;color:black;border-top: 1px solid #DAEFC2;');
            else if (casa == '2')
                aEssaludPorCabeceraCarta.setRowTextStyle(aEssaludPorCabeceraCarta.getRowId(i), 'background-color:#FFA66A;color:black;border-top: 1px solid #FFD7BB;');
        }
    });
}

function activarAfiliacion(CodigoPersona, IdAfil, NumeroAfil) {
    patronModulo = 'activarAfiliacion';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + CodigoPersona;
    parametros += '&p3=' + IdAfil;
    parametros += '&p4=' + NumeroAfil;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('divmensaje').update("");
            cargarTablaAfiliacionesPersona(CodigoPersona)
        }
    })
}

function activarAfiliacionEssalud(CodigoPersona, IdAfil, NumeroAfil) {
    patronModulo = 'activarAfiliacionEssalud';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + CodigoPersona;
    parametros += '&p3=' + IdAfil;
    parametros += '&p4=' + NumeroAfil;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('divmensaje').update(respuesta);
            cargarTablaAfiliacionesPersona(CodigoPersona)
            $('Essalud').show();
        }
    })
}

function PopadAgregarAfiliaciones($datos) {
    CodigoPersona = $datos;
    posFuncion = "cargarTablaAfiliacionesInactivasPersona(CodigoPersona)";
    vtitle = "";
    vformname = 'AfiliacionesInactivas';
    vwidth = '350';
    vheight = '500';
    patronModulo = 'AfiliacionInactivasPersona';
    vcenter = 't';
    vresizable = ''
    vmodal = 'true';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    CargarVentanaPopPapJorge(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

}



function abrirPopadContribuyentePuntualBusquedaRelacionDBSIMI() {
    posFuncion = "";
    vtitle = "";
    vformname = '';
    vwidth = '700';
    vheight = '600';
    patronModulo = 'abrirPopadContribuyentePuntualBusquedaRelacionDBSIMI';
    vcenter = 't';
    vresizable = ''
    vmodal = 'true';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function buscarNombreContribuyente(nombreBuscar){
    $('nombrePersonaBuscar').value = nombreBuscar;
}



function popadDatosEssalud(CodigoPersona) {
    CodigoSerPro = CodigoPersona;
    posFuncion = "cargarDatosPersona(CodigoSerPro)";
    vtitle = "";
    vformname = 'FormularioDatosEssalud';
    vwidth = '400';
    vheight = '580';
    patronModulo = 'FormularioDatosEssalud';
    vcenter = 't';
    vresizable = ''
    vmodal = 'true';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function cargarDatosPersona(CodigoSerPro) {
    var Codigo = CodigoSerPro;
    patronModulo = 'cargarDatosPersona';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + Codigo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            var respuesta = transport.responseText;
            var arrayRespuesta = respuesta.split('*');
            $('Ubigeo').value = "150117";
            $('CodPer').value = arrayRespuesta[0];
            $('Doc').value = arrayRespuesta[1];
            $('ApePat').value = arrayRespuesta[2];
            $('ApeMat').value = arrayRespuesta[3];
            $('Nomb1').value = arrayRespuesta[4];
            $('Sexo').value = arrayRespuesta[5];
            $('FechaNac').value = arrayRespuesta[6];
            $('AccionEss').value = '0';
        }
    })
}

function verificarCodAutogenerado() {
    var CodiAuto = document.getElementById('txtCodiAuto').value;
    patronModulo = 'verificarCodAutogenerado';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + CodiAuto;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            var respuesta = transport.responseText;
            var arrayRespuesta = respuesta.split('*');
            var AccionHa = $('AccionEss').value = arrayRespuesta[10];
            if (AccionHa == 1) {
                if ($('CodPer').value == arrayRespuesta[9]) {
                    $('Ubigeo').value = "150117";


                    var fechaDesde = arrayRespuesta[0].split('/');
                    if (fechaDesde[0].length == 4) {
                        $('Desde').value = fechaDesde[2] + "/" + fechaDesde[1] + "/" + fechaDesde[0];
                    } else if ((fechaDesde[0].length == 2)) {
                        $('Desde').value = fechaDesde[0] + "/" + fechaDesde[1] + "/" + fechaDesde[2];
                    }

                    var fechaHasta = arrayRespuesta[1].split('/');
                    if (fechaHasta[0].length == 4) {
                        $('Hasta').value = fechaHasta[2] + "/" + fechaHasta[1] + "/" + fechaHasta[0];
                    } else if ((fechaDesde[0].length == 2)) {
                        $('Hasta').value = fechaHasta[0] + "/" + fechaHasta[1] + "/" + fechaHasta[2];
                    }


                    $('Doc').value = arrayRespuesta[2];
                    $('ApePat').value = arrayRespuesta[3];
                    $('ApeMat').value = arrayRespuesta[4];
                    $('Nomb1').value = arrayRespuesta[5];
                    $('Nomb2').value = arrayRespuesta[6];
                    $('Sexo').value = arrayRespuesta[7];
                    $('FechaNac').value = arrayRespuesta[8];
                    $('CodPer').value = arrayRespuesta[9];
                    $('AccionEss').value = arrayRespuesta[10];
                } else {
                    alert('El autogenerado no corresponde a la persona');
                    Windows.close("Div_FormularioDatosEssalud");
                }

            }
            else {
                //alert("NO entro");
                $('Ubigeo').value = "150117";
                $('Desde').value = "";
                $('Hasta').value = "";
                $('Doc').value = "";
                $('ApePat').value = "";
                $('ApeMat').value = "";
                $('Nomb1').value = "";
                $('Nomb2').value = "";
                $('Sexo').value = "";
                $('FechaNac').value = "";
                $('CodPer').value = "";
                $('AccionEss').value = 0;
            }
        }
    })
}

function GuardarDatosEssalud() {
    var CodiAuto = document.getElementById('txtCodiAuto').value;
    var Ubigeo = document.getElementById('Ubigeo').value;
    var Desde = document.getElementById('Desde').value;
    var Hasta = document.getElementById('Hasta').value;
    var Doc = document.getElementById('Doc').value;
    var ApePat = document.getElementById('ApePat').value;
    var ApeMat = document.getElementById('ApeMat').value;
    var Nomb1 = document.getElementById('Nomb1').value;
    var Nomb2 = document.getElementById('Nomb2').value;
    var Sexo = document.getElementById('Sexo').value;
    var FechaNac = document.getElementById('FechaNac').value;
    var CodPer = document.getElementById('CodPer').value;
    var Accion = document.getElementById('AccionEss').value;
    if (Accion == 1) {
        patronModulo = 'ActualizarDatosEssalud';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + CodiAuto;
        parametros += '&p3=' + Ubigeo;
        parametros += '&p4=' + Desde;
        parametros += '&p5=' + Hasta;
        parametros += '&p6=' + Doc;
        parametros += '&p7=' + ApePat;
        parametros += '&p8=' + ApeMat;
        parametros += '&p9=' + Nomb1;
        parametros += '&p10=' + Nomb2;
        parametros += '&p11=' + Sexo;
        parametros += '&p12=' + FechaNac;
        parametros += '&p13=' + CodPer;
    }
    else {
        patronModulo = 'InsertarDatosEssalud';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + CodiAuto;
        parametros += '&p3=' + Ubigeo;
        parametros += '&p4=' + Desde;
        parametros += '&p5=' + Hasta;
        parametros += '&p6=' + Doc;
        parametros += '&p7=' + ApePat;
        parametros += '&p8=' + ApeMat;
        parametros += '&p9=' + Nomb1;
        parametros += '&p10=' + Nomb2;
        parametros += '&p11=' + Sexo;
        parametros += '&p12=' + FechaNac;
        parametros += '&p13=' + CodPer;
    }
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            var respuesta = transport.responseText;
            Windows.close("Div_FormularioDatosEssalud");
            Windows.close("Div_AfiliacionesInactivas")
            //buscarPersonas();
            cargarTablaAfiliacionesPersona(CodPer);
        }
    })
}

function cargarTablaAfiliacionesInactivasPersona(codPer) {

    CodigoPersona = codPer;
    document.getElementById('listaAfiliaciones');
    patronModulo = 'tablaxAfiliacionesInacPersona';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + CodigoPersona;
    rTablaAfiliacionesInac = new dhtmlXGridObject('listaAfiliaciones');
    rTablaAfiliacionesInac.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    rTablaAfiliacionesInac.setSkin("dhx_skyblue");
    rTablaAfiliacionesInac.enableRowsHover(true, 'grid_hover');
    contadorCargador++;
    var idCargador = contadorCargador;
    rTablaAfiliacionesInac.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    rTablaAfiliacionesInac.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    rTablaAfiliacionesInac.init();
    rTablaAfiliacionesInac.loadXML(pathRequestControl + '?' + parametros);
    rTablaAfiliacionesInac.attachEvent("onRowSelect", function(rId, cInd) {
        var NumeroAfiliacio = rTablaAfiliacionesInac.cells(rId, 2).getValue();
        CodAutogenerado = $('autogenerado').value
        var IdAfil = rTablaAfiliacionesInac.cells(rId, 0).getValue();
        if (IdAfil == '0027') {
            $('DetalleDeuda').show();
            $('Detalle').hide()
            $('divmensaje').update("");
            $('Essalud').hide();
            if (CodAutogenerado == '0' || CodAutogenerado == '') {
                alert("No tiene codigo Autogenerado");
                $('MensajeDeuda').update("No cuenta con los requisitos minimos para el cambio de afiliacion");
                Windows.close("Div_AfiliacionesInactivas")
                $('DetalleDeuda').show();
                $('divmensaje').update("");
                $('Detalle').hide()
                $('Essalud').hide();
            }
            else {
                popadDatosEssalud(codPer);
            }
        }
        else if (IdAfil == '0002') {
            verificarExistenciaDBContribuyentePuntual(CodigoPersona);
        }
        else {
            var nombre = $('divTitulo').value;
            agregarAfiliacionPersona(IdAfil, NumeroAfiliacio, CodigoPersona);
        }
    });
}

function agregarAfiliacionPersona(IdAfil, NumeroAfiliacio, CodigoPersona) {
    patronModulo = 'agregarAfiliacionPersona';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + IdAfil;
    parametros += '&p3=' + NumeroAfiliacio;
    parametros += '&p4=' + CodigoPersona;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            Windows.close("Div_AfiliacionesInactivas");
            $('Detalle').hide();
            $('divmensaje').update("");
            $('DetalleDeuda').hide();
            cargarTablaAfiliacionesPersona(CodigoPersona);
        }

    })
}

function verificarExistenciaDBContribuyentePuntual(CodigoPersona) {
    patronModulo = 'verificarExistenciaDBContribuyentePuntual';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + CodigoPersona;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            var respu = respuesta.split("/");
            if (respu[0] == 0) {
                //                alert("afafafa");
                //                var nombre = $('divTitulo').innerHTML;
                //                var apellidos = nombre.split(" ");
                //                alert(apellidos[0] + " " + apellidos[1])
                //                nombreBuscar = apellidos[0] + " " + apellidos[1];
                abrirPopadContribuyentePuntualBusquedaRelacionDBSIMI();
                $('TablaEstadoDeuda').update(' ');
                $('btn_Quitar Relacion Municipalidad').hide();
            }
            else if (respu[0] == 1) {
                cargarTablaDeudaSimi(respu[1]);
                $('btn_Quitar Relacion Municipalidad').show();
            }
        }


    })
}


function cargarTablaDeudaSimi(IdPersonaSimi) {
    patronModulo = 'TablaEstadoDeuda';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + IdPersonaSimi;
    rTablaDeudaSimi = new dhtmlXGridObject('TablaEstadoDeuda');
    rTablaDeudaSimi.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    rTablaDeudaSimi.setSkin("");
    rTablaDeudaSimi.enableRowsHover(true, 'grid_hover');
    rTablaDeudaSimi.attachEvent("onRowSelect", function(rId, cInd) {
        var Mensaje = rTablaDeudaSimi.cells(rId, 0).getValue();
        var Resultado = rTablaDeudaSimi.cells(rId, 1).getValue();
        var Deuda = rTablaDeudaSimi.cells(rId, 2).getValue();
        if (cInd == 3) {
            if (Resultado == 1) {
                alert("Contribuyente con deuda...");
            } else if (Resultado != 1 && Deuda == 0) {
                if (Mensaje == "SIN PREDIO, NO APLICA CONT. PUNTUAL") {
                    alert("No pertenece a contribuyente Puntual");
                } else {
                    var CodSimedh = $('txtCodigoPersona').value;
                    // guardarRelacionEntreDBSIMIandSIMED(CodSimedh , CodigoPersona);
                    RegistrarAutoGenerado(CodSimedh);
                }
            }
        }
    }
    );
    contadorCargador++;
    var idCargador = contadorCargador;
    rTablaDeudaSimi.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    rTablaDeudaSimi.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    rTablaDeudaSimi.init();
    rTablaDeudaSimi.loadXML(pathRequestControl + '?' + parametros, function() {
        });
}


function BuscarPersonaDBSIMI(evento) {
    var nombre = $('nombrePersonaBuscar').value;
    // var numero=nombre.length;
    var tecla = evento.keyCode
    var patronModulo = 'BuscarPersonaDBSIMI';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + nombre;
    if (tecla == 13) {
        //var tmn=0;
        rPersonaDBSIMI = new dhtmlXGridObject('contenedorTablaBDSIMI');
        rPersonaDBSIMI.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
        rPersonaDBSIMI.setSkin("");
        rPersonaDBSIMI.enableRowsHover(true, 'grid_hover');
        contadorCargador++;
        var idCargador = contadorCargador;
        rPersonaDBSIMI.attachEvent("onXLS", function() {
            cargadorpeche(1, idCargador);
        });
        rPersonaDBSIMI.attachEvent("onXLE", function() {
            cargadorpeche(0, idCargador);
        });
        rPersonaDBSIMI.attachEvent("onRowSelect", function(x, y) {
            var codPersonaSIMI = rPersonaDBSIMI.cells(x, 0).getValue();
            if (y == 4) {
                tablaEstadoDeuda(codPersonaSIMI);
            }
        });
        rPersonaDBSIMI.init();
        rPersonaDBSIMI.loadXML(pathRequestControl + '?' + parametros, function() {
            // tmn=1;
            });
    }
//    if(numero>3&&tmn==1){
//        var palabra=$('nombrePersonaBuscar').value;
//        var arrayPalabras=new Array();
//        arrayPalabras=palabra.split(" ");
//        var numeroPalabras=arrayPalabras.length;
//        rPersonaDBSIMI.filterBy(1,arrayPalabras[0]);
//        for(var i=1; i<numeroPalabras; i++){
//            rPersonaDBSIMI.filterBy(1,arrayPalabras[i],true);
//        }
//    }
}


function     guardarRelacionEntreDBSIMIandSIMED(CodSimedh, CodigoPersona) {
    patronModulo = 'guardarRelacionEntreDBSIMIandSIMED';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + CodSimedh;
    parametros += '&p3=' + CodigoPersona;


    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            var respuesta = transport.responseText;
            RegistrarAutoGenerado(CodSimedh);

        }
    })
}


function   RegistrarAutoGenerado(CodSimedh) {
    patronModulo = 'RegistrarAutoGenerado';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + CodSimedh;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            var respuesta = transport.responseText;
            Windows.close("Div_AfiliacionesInactivas");
            Windows.close("Div_");
            cargarTablaAfiliacionesPersona(CodSimedh);
        }
    })
}




function QuitarRelacion() {
    var cod = document.getElementById('txtCodigoPersona').value;
    patronModulo = 'QuitarRelacion';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + cod;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            var respuesta = transport.responseText;
            cargarTablaAfiliacionesPersona(cod);

        }
    })
}



////////////////////////////////////////////////////////////////SANDY////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ventanaVerDetalleOrden() {
    if ($("hCodigoPersonaParaCobro") != null) {
        VerDetalleOrden();
    }
    else {
        alert('Seleccione un Paciente');
    }
}

function VerDetalleOrden() {
    //    window.alert($('divBusCronogramaMedico').getStyle('z-index'));
    vformname = 'formDetalleOrden'
    vtitle = 'Ver Detalle de las Ordenes'  //Área de desarrollo y proyectos informaticos
    vwidth = '680'
    vheight = '420'
    vcenter = 't'
    vresizable = ''
    vmodal = 'false'
    vstyle = ''
    vopacity = ''

    vposx1 = ''
    vposx2 = ''
    vposy1 = ''
    vposy2 = ''

    patronModulo = 'ventanaVerDetalleOrden';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    posFuncion = 'MostrarDetalleOrden';

    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
}


function MostrarDetalleOrden() {
    var nroOrden = $("hidNroOrden").value;
    var codPersona = $("hCodigoPersonaParaCobro").value;
    var CodProgramacion = $("hCodigoProgramacion").value;
    var patronModulo = 'MostrarDetalleOrden';
    var parametros = '';


    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + nroOrden;
    parametros += '&p3=' + codPersona;
    parametros += '&p4=' + CodProgramacion;


    tablaVerDetalleOrden = new dhtmlXGridObject('divVerDetalleExamenes');
    tablaVerDetalleOrden.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaVerDetalleOrden.setSkin("dhx_skyblue");
    /*tablaVerDetalleOrden.attachEvent("onRowSelect", function(fila,columna){
     var CodProgramacion=tablaVerDetalleOrden.cells(fila,7).getValue();
     //-----------------------------------------------------------
     MostrarUsuarioRegistro(CodProgramacion);  
     MostrarUsuarioCofirma(CodProgramacion);
     MostrarAtencionInicio(CodProgramacion);
     MostrarAtencionFin(CodProgramacion);
     //-----------------------------------------------------------
     });*/

    tablaVerDetalleOrden.init();

    // tablaVerDetalleOrden.loadXML(pathRequestControl+'?'+parametros);  

    tablaVerDetalleOrden.loadXML(pathRequestControl + '?' + parametros, function() {
        MostrarUsuarioRegistro();
        MostrarUsuarioCofirma();
        MostrarUsuarioPaga();
        MostrarAtencionInicio();
        MostrarAtencionFin();
        MostrarReceta();
    });
}


function MostrarUsuarioRegistro() { // muestra a el usuario que realizo el registro del paciente
    //    hcodigocronograma ---->390518 idCronogramaMedico , hCodigoProgramacion ----> iCodigoProgramacion=5408073 
    //alert(fila + " " + columna);          
    //var CodProgramacion=$("hCodigoProgramacion").value;  
    //    var CodProgramacion=tablaVerDetalleOrden.cells(fila,7).getValue();
    var CodProgramacion = $("hCodigoProgramacion").value;
    var codcronograma = $("hcodigocronograma").value;
    var codPersona = $("hCodigoPersonaParaCobro").value;
    var patronModulo = 'MostrarUsuarioRegistro';
    var parametros = '';

    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + CodProgramacion;
    parametros += '&p3=' + codcronograma;
    parametros += '&p4=' + codPersona;

    tablaMostrarUsuarioRegistro = new dhtmlXGridObject('divUsuarioRegistra');
    tablaMostrarUsuarioRegistro.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaMostrarUsuarioRegistro.setSkin("dhx_skyblue");
    tablaMostrarUsuarioRegistro.attachEvent("onRowSelect", function() {
        });
    tablaMostrarUsuarioRegistro.init();
    tablaMostrarUsuarioRegistro.loadXML(pathRequestControl + '?' + parametros);
}


function MostrarUsuarioCofirma() { // muestra a el usuario que realizo el registro del paciente 
    // var CodProgramacion=tablaVerDetalleOrden.cells(fila,7).getValue();
    var CodProgramacion = $("hCodigoProgramacion").value;
    var codcronograma = $("hcodigocronograma").value;
    var codPersona = $("hCodigoPersonaParaCobro").value;
    var patronModulo = 'MostrarUsuarioConfirma';
    var parametros = '';

    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + CodProgramacion;
    parametros += '&p3=' + codcronograma;
    parametros += '&p4=' + codPersona;

    tablaMostrarUsuarioCofirma = new dhtmlXGridObject('divUsuarioConfirma');
    tablaMostrarUsuarioCofirma.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaMostrarUsuarioCofirma.setSkin("dhx_skyblue");
    tablaMostrarUsuarioCofirma.attachEvent("onRowSelect", function() {
        });
    tablaMostrarUsuarioCofirma.init();
    tablaMostrarUsuarioCofirma.loadXML(pathRequestControl + '?' + parametros);
}

function MostrarUsuarioPaga(){ // pago en fox
    var nroOrden=$("hidNroOrden").value;   
    var patronModulo='MostrarUsuarioPaga';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+nroOrden;
    
    tablaMostrarUsuarioPaga = new dhtmlXGridObject('divUsuarioPaga');
    tablaMostrarUsuarioPaga.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaMostrarUsuarioPaga.setSkin("dhx_skyblue");
    tablaMostrarUsuarioPaga.attachEvent("onRowSelect", function(){
        });
    tablaMostrarUsuarioPaga.init();
    tablaMostrarUsuarioPaga.loadXML(pathRequestControl+'?'+parametros);  
}

function MostrarAtencionInicio() {
    //  var CodProgramacion=tablaVerDetalleOrden.cells(fila,7).getValue();
    var CodProgramacion = $("hCodigoProgramacion").value;
    var codcronograma = $("hcodigocronograma").value;
    var codPersona = $("hCodigoPersonaParaCobro").value;
    var patronModulo = 'MostrarAtencionInicio';
    var parametros = '';

    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + CodProgramacion;
    parametros += '&p3=' + codcronograma;
    parametros += '&p4=' + codPersona;

    tablaMostrarAtencionInicio = new dhtmlXGridObject('divAtencionInicio');
    tablaMostrarAtencionInicio.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaMostrarAtencionInicio.setSkin("dhx_skyblue");
    tablaMostrarAtencionInicio.attachEvent("onRowSelect", function() {
        });
    tablaMostrarAtencionInicio.init();
    tablaMostrarAtencionInicio.loadXML(pathRequestControl + '?' + parametros);
}

function MostrarAtencionFin() {
    //var CodProgramacion=tablaVerDetalleOrden.cells(fila,7).getValue();
    var CodProgramacion = $("hCodigoProgramacion").value;
    var codcronograma = $("hcodigocronograma").value;
    var codPersona = $("hCodigoPersonaParaCobro").value;
    var patronModulo = 'MostrarAtencionFin';
    var parametros = '';

    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + CodProgramacion;
    parametros += '&p3=' + codcronograma;
    parametros += '&p4=' + codPersona;

    tablaMostrarAtencionFin = new dhtmlXGridObject('divAtencionFin');
    tablaMostrarAtencionFin.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaMostrarAtencionFin.setSkin("dhx_skyblue");
    tablaMostrarAtencionFin.attachEvent("onRowSelect", function() {
        });
    tablaMostrarAtencionFin.init();
    tablaMostrarAtencionFin.loadXML(pathRequestControl + '?' + parametros);
}

function MostrarReceta() { // muestra la receta del paciente
    var CodProgramacion = $("hCodigoProgramacion").value;

    //alert(arrayDescrip_Producto)
    var patronModulo = 'MostrarReceta';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + CodProgramacion;
    tablaMostrarReceta = new dhtmlXGridObject('divVerRecetas');
    tablaMostrarReceta.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaMostrarReceta.setSkin("dhx_skyblue");
    tablaMostrarReceta.attachEvent("onRowSelect", function() {
        });
    tablaMostrarReceta.init();
    tablaMostrarReceta.loadXML(pathRequestControl + '?' + parametros);
}

function actualizaUbigeo(elemento){
    
     patronModulo = 'combo_ubigeo';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + '';
        parametros += '&p3=' + document.getElementById('cb_departamento').value;
        parametros += '&p4=' + document.getElementById('cb_provincia').value;
        parametros += '&p5=' + document.getElementById('cb_pais').value;

        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false,
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function(transport) {
                cargadorpeche(0, idCargador);
                respuesta = transport.responseText;
                $(elemento).update(respuesta);
            }
        })
    //$row_ochg = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=combo_ubigeo&p2=&p3='+document.getElementById('cb_departamento').value+'&p4='+document.getElementById('cb_provincia').value+'&p5='+document.getElementById('cb_pais').value,'ubigeo');\"";
}
function actualizaUbigeo2(elemento){

     patronModulo = 'combo_ubigeo';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + '';
        parametros += '&p3=' + document.getElementById('cbNac_departamento').value;
        parametros += '&p4=' + document.getElementById('cbNac_provincia').value;
        parametros += '&p5=' + document.getElementById('cbNac_pais').value;

        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false,
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function(transport) {
                cargadorpeche(0, idCargador);
                respuesta = transport.responseText;
                $(elemento).update(respuesta);
            }
        })
    //$row_ochg = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=combo_ubigeo&p2=&p3='+document.getElementById('cb_departamento').value+'&p4='+document.getElementById('cb_provincia').value+'&p5='+document.getElementById('cb_pais').value,'ubigeo');\"";
}