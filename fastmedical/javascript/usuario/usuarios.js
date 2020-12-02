
//var pathRequestControl = "../../ccontrol/control/control.php";
//var url = "../../ccontrol/control/control.php";

function validateNewPassword() {

    passwordNueva = $("nuevoPassword").value;
    if (passwordNueva == "") {
        alert("Ingrese nueva contrase\xF1a");
        $("nuevoPassword").value = "";
        $("nuevoPassword").focus();
    }
    else {
        if (passwordNueva.length < 6) {
            alert("Su nueva contrase\xF1a debe tener como m\xEDnimo 6 caracteres");
            $("nuevoPassword").value = "";
            $("confPassword").value = "";
            $("nuevoPassword").focus();
        }
        else {
            passwordConfirmada = $("confPassword").value;
            if (passwordConfirmada == "") {
                alert("Confirme nueva contrase\xF1a");
                $("confPassword").value = "";
                $("confPassword").focus();
            }
            else {
                if (passwordConfirmada != passwordNueva) {
                    alert("No coinciden las contrase\xF1as");
                    $("nuevoPassword").value = "";
                    $("confPassword").value = "";
                    $("nuevoPassword").focus();
                }
                else {
                    updatePassword();
                }
            }
        }
    }
    //}
    //}
}

function validatePassword() {
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=validatePassword&' + $('mante_usuario').serialize();
    new Ajax.Request(url,
        {
            method: 'get',
            parameters: data,
            //onLoading   : function(transport){est_cargador(1);},
            onComplete: function (transport) {/*est_cargador(0);*/
                if (transport.responseText == 0) {
                    alert("Contraseña incorrecta");
                    $("antPassword").value = "";
                    $("antPassword").focus();
                }
                else {
                    $("nuevoPassword").removeAttribute("readonly");
                    //document.getElementById("txtobservacioncita").removeAttribute("readonly");
                    $("confPassword").removeAttribute("readonly");
                }
            }
        }
    )
}

function updatePassword() {
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=updatePassword&' + $('mante_usuario').serialize();
    new Ajax.Request(url,
        {
            method: 'get',
            parameters: data,
            //onLoading   : function(transport){est_cargador(1);},
            onComplete: function (transport) {/*est_cargador(0);*/
                alert(transport.responseText);
                Windows.close("Div_popupManteUsuario");
            }
        }
    )
}
function saltoConEnter(event, elemento, op) {
    if (event == '') {
        tecla = 13;
    } else {
        tecla = event.keyCode
    }
    valor = elemento.value;
    ultimoCaracter = valor.substr(valor.length - 1, valor.length);

    if (ultimoCaracter == ' ' || tecla == 13) {
        if (op == '1') {
            $('usuario').focus();
        }
        if (op == '2') {
            $('clave').focus();
        }
        if (op == '3') {
            $('login').focus();
            //ingresarSistema();
        }
        //        elemento.value=dTrim(valor);
    }

}


function ingresarSistema() {
    pathLogin = "../hospitalizacion/ccontrol/control/control.php";
    usuario = $('usuario').value;
    clave = $('clave').value;
    if (usuario == '') {
        alert('Por favor ingrese su Usuario');
        return;
    }
    if (clave == '') {
        alert('Por favor ingrese su Clave');
        return;
    }

    patronModulo = "ingresarSistema";
    clave = hex_sha1(clave);
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + usuario;
    parametros += '&p3=' + clave;
    new Ajax.Request(pathLogin, {
        method: 'post',
        parameters: parametros,
        onLoading: cargador1(1),
        onComplete: function (transport) {
            cargador1(0);
            respuesta = transport.responseText;
            if (respuesta.trim() != 'ok') {
                alert(respuesta)
            } else {
                window.location = 'cvista/inicio/inicio.php';
            }
        }

    })

}
/*
function cargador1(estado){
    switch (estado){
        case 0:	{
            $('VentanaTransparente').setStyle({
                visibility:'hidden'
            });
            break;
        }
        case 1:{
            $('VentanaTransparente').setStyle({
                visibility:'visible'
            });
            break;
        }
    }
}
*/
function abrirotraventana() {
    window.open("inicio.php");
}
function abrirEssalud() {
    window.open("http://ww4.essalud.gob.pe:7777/acredita");
}
/*
function cierra_sesionSimedh() {
    //var pathRequestControl = "../../ccontrol/control/control.php"; //alojamiento de la funcion
    patronModulo = 'cerrarSesionSimedh'; //nombre de la funcion
    parametros = '';
    parametros += 'p1=' + patronModulo;

    if (confirm("¿Desea Salir del Sistema?")) {
        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'post',
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function (transport) {
                cargadorpeche(0, idCargador);
                respuesta = transport.responseText;
                window.location = '../../../index.php';//será lo que se mostrara al final

            }
        }
        )
    }

}
*/
//var pathRequestControl = "../../ccontrol/control/control.php";
//var url = "../../ccontrol/control/control.php";

function validateNewPassword() {

    passwordNueva = $("nuevoPassword").value;
    if (passwordNueva == "") {
        alert("Ingrese nueva contrase\xF1a");
        $("nuevoPassword").value = "";
        $("nuevoPassword").focus();
    }
    else {
        if (passwordNueva.length < 6) {
            alert("Su nueva contrase\xF1a debe tener como m\xEDnimo 6 caracteres");
            $("nuevoPassword").value = "";
            $("confPassword").value = "";
            $("nuevoPassword").focus();
        }
        else {
            passwordConfirmada = $("confPassword").value;
            if (passwordConfirmada == "") {
                alert("Confirme nueva contrase\xF1a");
                $("confPassword").value = "";
                $("confPassword").focus();
            }
            else {
                if (passwordConfirmada != passwordNueva) {
                    alert("No coinciden las contrase\xF1as");
                    $("nuevoPassword").value = "";
                    $("confPassword").value = "";
                    $("nuevoPassword").focus();
                }
                else {
                    updatePassword();
                }
            }
        }
    }
    //}
    //}
}

function validatePassword() {
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=validatePassword&' + $('mante_usuario').serialize();
    new Ajax.Request(url,
        {
            method: 'get',
            parameters: data,
            //onLoading   : function(transport){est_cargador(1);},
            onComplete: function (transport) {/*est_cargador(0);*/
                if (transport.responseText == 0) {
                    alert("Contraseña incorrecta");
                    $("antPassword").value = "";
                    $("antPassword").focus();
                }
                else {
                    $("nuevoPassword").removeAttribute("readonly");
                    //document.getElementById("txtobservacioncita").removeAttribute("readonly");
                    $("confPassword").removeAttribute("readonly");
                }
            }
        }
    )
}

function updatePassword() {
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=updatePassword&' + $('mante_usuario').serialize();
    new Ajax.Request(url,
        {
            method: 'get',
            parameters: data,
            //onLoading   : function(transport){est_cargador(1);},
            onComplete: function (transport) {/*est_cargador(0);*/
                alert(transport.responseText);
                Windows.close("Div_popupManteUsuario");
            }
        }
    )
}
function saltoConEnter(event, elemento, op) {
    if (event == '') {
        tecla = 13;
    } else {
        tecla = event.keyCode
    }
    valor = elemento.value;
    ultimoCaracter = valor.substr(valor.length - 1, valor.length);

    if (ultimoCaracter == ' ' || tecla == 13) {
        if (op == '1') {
            $('usuario').focus();
        }
        if (op == '2') {
            $('clave').focus();
        }
        if (op == '3') {
            $('login').focus();
            ingresarSistema();
        }
        //        elemento.value=dTrim(valor);
    }

}


function ingresarSistema() {
    pathLogin = "../hospitalizacion/ccontrol/control/control.php";
    usuario = $('usuario').value;
    clave = $('clave').value;
    if (usuario == '') {
        alert('Por favor ingrese su Usuario');
        return;
    }
    if (clave == '') {
        alert('Por favor ingrese su Clave');
        return;
    }

    patronModulo = "ingresarSistema";
    clave = hex_sha1(clave);
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + usuario;
    parametros += '&p3=' + clave;
    new Ajax.Request(pathLogin, {
        method: 'post',
        parameters: parametros,
        onLoading: cargador1(1),
        onComplete: function (transport) {
            cargador1(0);
            respuesta = transport.responseText;
            if (respuesta.trim() != 'ok') {
                alert(respuesta)
            } else {
                window.location = 'cvista/inicio/inicio.php';
            }
        }
        //            if(respuesta=='ok'){
        //                window.location='cvista/inicio/inicio.php';
        //            }else{
        //                alert(respuesta);
        //            }
    }

    )
}


function cargador1(estado) {
    switch (estado) {
        case 0: {
            $('VentanaTransparente').setStyle({
                visibility: 'hidden'
            });
            break;
        }
        case 1: {
            $('VentanaTransparente').setStyle({
                visibility: 'visible'
            });
            break;
        }
    }
}

function abrirotraventana() {
    window.open("inicio.php");
}
function cierra_sesionSimedh() {
    //var pathRequestControl = "../../ccontrol/control/control.php"; //alojamiento de la funcion
    patronModulo = 'cerrarSesionSimedh'; //nombre de la funcion
    parametros = '';
    parametros += 'p1=' + patronModulo;

    if (confirm("¿Desea Salir de Fast Medical?")) {
        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'post',
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function (transport) {
                cargadorpeche(0, idCargador);
                respuesta = transport.responseText;
                window.location = '../../../index.php';//será lo que se mostrara al final

            }
        }
        )
    }

}


/**************************** MENU USUARIO *********************************/
/******************************2012-02-09***********************************/
function mostrarUsuario() {

    patronModulo = 'mostrarMenuUsuario';
    icodigoEmpleado = $('txtcodigoEmpleado').value;
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + icodigoEmpleado;
    parametros += '&p3=' + document.getElementById("txtCodPer").value.trim();
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            respuesta = transport.responseText;
            $('divDerRegistroP').update(respuesta);
            //            desactivarModatidadContrata(1);
            // myDiv=document.getElementById('divTitulo');
            // myDiv.innerHTML =document.getElementById('txtNomPer').value; 
            //puestosPorEmpleados();
            //detalleModalidadContrato();
            cargarPagina();



        }
    })
}


function cargarPagina() {
    if (document.getElementById("hidExistePuesto").value.trim() == "si") {
        if (document.getElementById("hidExisteUsuario").value.trim() == 0) {
            //Exisite Usuario
            botonesUsuario(1);
            listaPerfilesXUsuario(document.getElementById("txtCodPer").value.trim());
        }
        else {
            //No existe Usuario
            botonesUsuario(0);
        }
    }
    else {//no tiene puesto habilitado
        botonesUsuario(3);
    }
}

/*
 function desactivarEmpleadoArea(idCodigoEmpleado,idCodigoSEACC){
    //alert(idCodigoEmpleado+"---"+idCodigoSEACC);
    if(window.confirm("Seguro que desea Desactivar")){
        form="";
        destino="";
        //        funcion="";
        funcion="RefrescarTabla("+idCodigoEmpleado+")";
        parametros="p1=desactivarEmpleadoArea&p2="+idCodigoEmpleado+'&p3='+idCodigoSEACC ;
        enviarFormulario(form,parametros,funcion,destino);  
    }
}
 */
/*******************************2012-02-10*******************************/
/**********************************Funciones de Los botones**************/
function crearUsuario() {
    //    alert("guarda");
    botonesUsuario(2);
}

function editarUsuario() {
    botonesUsuario(4);
}

function modificarUsuario() {
    var idPerfilCombo;
    //var idPerfilGridX
    var codPer;
    codPer = document.getElementById("txtCodPer").value.trim();
    idPerfilCombo = document.getElementById("comboPerfil").value.trim();
    //idPerfilGridX=mygridx.cells(0,0).getValue().trim();
    if (idPerfilCombo != "-1") {
        /*if(idPerfilCombo!=idPerfilGridX){*/
        patronModulo = 'modificarUsuario';
        parametros = '';
        parametros += 'p1=' + patronModulo
        parametros += "&p2=" + codPer;
        parametros += "&p3=" + idPerfilCombo;
        form = "";
        funcion = "postUsuario";
        destino = "divInfoRegistroUsuario";
        enviarFormulario(form, parametros, funcion, destino);
        /*}
            else{
                alert("Seleccione un perfil distinto al ya utilizado");
            }*/
    }
    else {
        alert("Seleccione un Perfil");
    }
}


function GrabarActividad() {
    var codActividadCombo;
    var codPer;
    codPer = document.getElementById("txtCodPer").value.trim();
    codActividadCombo = document.getElementById("comboActividad").value.trim();
    if (codActividadCombo != "-1") {
        patronModulo = 'modificarActividad';
        parametros = '';
        parametros += 'p1=' + patronModulo
        parametros += "&p2=" + codPer;
        parametros += "&p3=" + codActividadCombo;
        form = "";
        funcion = "postUsuario";
        destino = "divInfoRegistroUsuario";
        enviarFormulario(form, parametros, funcion, destino);
    }
    else {
        alert("Seleccione un Actividad");
    }
}


function botonesUsuario(opc) {
    //Nota  divSubFrmUsuario: tiene los combos de opciones     
    switch (opc) {
        case 0: {
            $('divFrmUsuario').show();
            $('divSubFrmUsuario').show();
            $("btnCrearUsuario").show();
            $("btnGrabarUsuario").hide();
            $("btnEditarUsuario").hide();
            $("btnModificarUsuario").hide();
            $("comboPerfil").disabled = true;
            $("comboUsuario").disabled = true;
            break;
        }

        //existe usuario
        case 1: {
            $('divFrmUsuario').show();
            $('divSubFrmUsuario').show();
            $("btnCrearUsuario").hide();
            $("btnGrabarUsuario").hide();
            $("btnEditarUsuario").show();
            $("btnModificarUsuario").hide();
            $("comboPerfil").disabled = true;
            $("comboUsuario").disabled = true;
            break;
        }

        case 2: {
            $('divFrmUsuario').show();
            $('divSubFrmUsuario').show();
            $("btnCrearUsuario").hide();
            $("btnGrabarUsuario").show();
            $("btnEditarUsuario").hide();
            $("btnModificarUsuario").hide();
            $("comboUsuario").disabled = false;
            $("comboPerfil").disabled = false;
            break;
        }
        //Si selecciona no tiene puesto habilitado
        case 3: {
            $('divFrmUsuario').hide();
            $('divSubFrmUsuario').hide();
            $("btnCrearUsuario").hide();
            $("btnGrabarUsuario").hide();
            $("btnEditarUsuario").hide();
            $("btnModificarUsuario").hide();
            $("comboUsuario").disabled = true;
            $("comboPerfil").disabled = true;
            alert("La persona debe tener un puesto habilitado");
            break;
        }
        //editar
        case 4: {
            $('divFrmUsuario').show();
            $('divSubFrmUsuario').show();
            $("btnCrearUsuario").hide();
            $("btnGrabarUsuario").hide();
            $("btnEditarUsuario").hide();
            $("btnModificarUsuario").show();
            $("comboUsuario").disabled = true;
            $("comboPerfil").disabled = false;
            break;
        }
    }
}

function guardarUsuario() {
    var usuario = '';
    var idPerfil;
    var codPer;
    //alert("Hola");
    usuario = document.getElementById("comboUsuario").value.trim();
    codPer = document.getElementById("txtCodPer").value.trim();
    idPerfil = document.getElementById("comboPerfil").value.trim();
    if (usuario != "Seleccionar" && idPerfil != "-1") {
        patronModulo = 'crearUsuario';
        parametros = '';
        parametros += 'p1=' + patronModulo + '&p2=' + usuario;
        parametros += "&p3=" + codPer;
        parametros += "&p4=" + idPerfil;
        form = "";
        funcion = "postUsuario";
        destino = "divInfoRegistroUsuario";
        enviarFormulario(form, parametros, funcion, destino);
    }
    else {
        alert("Seleccione las dos opciones");
    }
}

function postUsuario() {
    botonesUsuario(1);
    listaPerfilesXUsuario(document.getElementById("txtCodPer").value.trim());
}

function listaPerfilesXUsuario(codPersona) {
    $('divContenedorInfoFormularios').hide();
    $('divContenedorInfoServicios').hide();
    var parametros = "";
    parametros = "p1=listaPerfilesXUsuario";
    parametros += "&p2=" + codPersona;
    var div = "divTablaPerfilesXUuario";
    var funcionClick = "listaFormulariosXPerfilXUsuario";
    var funcionDblClick = "";
    var funcionLoad = "colorTX";
    generarTablax(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}

function listaFormulariosXPerfilXUsuario(fil) {
    $('divContenedorInfoFormularios').show();
    $('divContenedorInfoServicios').hide();
    var parametros = "";
    parametros = "p1=listaFormulariosXPerfilXUsuario";
    parametros += "&p2=" + document.getElementById("txtCodPer").value.trim();
    parametros += "&p3=" + mygridx.cells(fil, 0).getValue().trim();
    var div = "divTablaFormulariosXPerfilXUsuario";
    var funcionClick = "listaServiciosXFormulariosXPerfilXUsuario";
    var funcionDblClick = "";
    var funcionLoad = "colorTY";
    generarTablay(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}

function listaServiciosXFormulariosXPerfilXUsuario(fil) {
    $('divContenedorInfoServicios').show();
    var parametros = "";
    parametros = "p1=listaServiciosXFormulariosXPerfilXUsuario"
    parametros += "&p2=" + document.getElementById("txtCodPer").value.trim()
    parametros += "&p3=" + mygridy.cells(fil, 0).getValue().trim();
    var div = "divTablaServiciosXFormulariosXPerfilXUsuario";
    var funcionClick = "";
    var funcionDblClick = "";
    var funcionLoad = "colorTZ";
    generarTablaz(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}
function colorTX() {
    setColorTablaAreaEstado(2, mygridx);
}
function colorTY() {
    setColorTablaAreaEstado(2, mygridy);
}
function colorTZ() {
    setColorTablaAreaEstado(2, mygridz);
}
function setColorTablaAreaEstado(vfila, grid) {
    for (i = 0; i < grid.getRowsNum(); i++) {
        estado = grid.cells(i, vfila).getValue();
        if (estado == '1')
            grid.setRowTextStyle(grid.getRowId(i), 'background-color:#C1E69D;color:black;border-top: 1px solid #DAEFC2;');
        else if (estado == '0')
            grid.setRowTextStyle(grid.getRowId(i), 'background-color:#FFA66A;color:black;border-top: 1px solid #FFD7BB;');
    }
}



function cargarTablaPacientes() {
    var patronModulo = 'cargarTablaPacientes';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    aPacientes = new dhtmlXGridObject('contendorTablaExamanes');
    aPacientes.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    aPacientes.setSkin("dhx_skyblue");
    aPacientes.enableRowsHover(true, 'grid_hover');
    var header = ["#text_filter", '#select_filter', '', ''];
    aPacientes.attachHeader(header);
    aPacientes.attachEvent("onRowSelect", function (rowId, cellInd) {
        if (cellInd == 6) {
            var nombres = aPacientes.cells(rowId, 0).getValue();
            var apellidoPa = aPacientes.cells(rowId, 1).getValue();
            var apellidoMa = aPacientes.cells(rowId, 2).getValue();
            var sexo = aPacientes.cells(rowId, 3).getValue();
            var fecha = aPacientes.cells(rowId, 4).getValue();
            var IdPersona = aPacientes.cells(rowId, 5).getValue();
            if (sexo == 'MASCULINO') {
                document.getElementById("sexo").value = 1;
            }
            else {
                document.getElementById("sexo").value = 0;
            }
            document.getElementById("codigo").value = IdPersona;
            document.getElementById("nombres").value = nombres;
            document.getElementById("apellidoPa").value = apellidoPa;
            document.getElementById("apellidoMa").value = apellidoMa;
            document.getElementById("fecha").value = fecha;
        }
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    aPacientes.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    aPacientes.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    /////////////fin cargador ///////////////////////
    aPacientes.setSkin("dhx_skyblue");
    aPacientes.init();
    aPacientes.loadXML(pathRequestControl + '?' + parametros);
}



