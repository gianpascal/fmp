/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var pathRequestControl = "../../ccontrol/control/control.php";
var idfilaseleccionada = "";
var idcolumnaseleccionada = "";
var colorceldaseleccionada = "";
var dhxWins, w1;
var guardadoexitoso = 0;
var tree;
//var mododeejecucion = 0; //0 pase libre,1 modo edicion
//function ventana_busca_procedimiento(funcionJSEjecutar){
//    CargarVentana('formBuscadorPersonas','Buscar Procedimiento','../../ccontrol/control/control.php?p1=form_buscador_personas&funcionJSEjecutar='+funcionJSEjecutar,'600','420',false,true,'',1,'',10,10,10,10);
//}



function seleccionarFechaCitasInformes(idElemento, cal) {
    var dia;
    var idfilaseleccionada = "";
    var idcolumnaseleccionada = "";
    var diaSel = idElemento.split("-")[1];
    var hiddenDia = document.getElementById(cal).getElementsByTagName("input")[4];
    dia = hiddenDia.value;
    if (diaSel != dia) {
        var nomIdDia = cal + "-" + dia;
        document.getElementById(nomIdDia).className = "btnCalendario";
        hiddenDia.value = diaSel;
        var numIdDiaSel = cal + "-" + diaSel;
        document.getElementById(numIdDiaSel).className = "estiloCasillaSeleccionada";
        var arrayInput = document.getElementById(cal).getElementsByTagName("input");
        var fechaActual = arrayInput[6].value + "-" + arrayInput[5].value + "-" + arrayInput[4].value;
        document.getElementById('hFecha').value = arrayInput[6].value + "-" + arrayInput[5].value + "-" + arrayInput[4].value;
        var opcionBusqueda = document.getElementById("hOpcionBusqueda").value;
        var fecha = document.getElementById('hFecha').value;
        $("hOpcionSede").value = $("cb_filtroSede").value;
        var sede = document.getElementById('hOpcionSede').value;
        var patronBusqueda = document.getElementById('hPatronBusqueda').value;
        var servicio = document.getElementById('hServicio').value;

        if (document.getElementById("hOpcionBusqueda").value !== "") {
            seleccionactividad();
            $('divDatosMedicoInformes').hide();
            var vista = $('selectVista').value;
            switch (vista) {
                case '1':  //tripo matriz
                {
                    $('btnProximaCIta').show();
                    $('btnNuevoEmergencia').hide();
                    regresaracronogramacitas();
                    $('programacioncitas').style.display = 'block';
                    $('programacioncitasEmergencia').style.display = "none";
                    $('btnNuevoEmergencia').hide();
                    break;
                }
                case '2': //tipo detalle
                {
                    mostrarProgramacionEmergenciaInformes(0);
                    break;
                }

            }

        }

    }
}
function accionCalendarioCitasInformes(idAccion, cal) {
    idfilaseleccionada = "";
    idcolumnaseleccionada = "";
    arrayInput = document.getElementById(cal).getElementsByTagName("input");
    fechaActual = arrayInput[6].value + arrayInput[5].value + arrayInput[4].value;
    document.getElementById("hFecha").value = fechaActual;
    pathLink = "p1=calendario01&p2=" + fechaActual + "&p3=" + idAccion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText.split("|");
            fechaActual = respuesta[1];
            document.getElementById("hFecha").value = fechaActual;
            $('divBusCronograma').update(respuesta[0]);
            if (document.getElementById("hOpcionBusqueda").value != "") {
                seleccionactividad();
                valor = $('hOpcionActividad').value;
                $('divDatosMedicoInformes').hide();
                var vista = $('selectVista').value;
                switch (vista) {
                    case '1':  //tripo matriz
                    {
                        $('btnProximaCIta').show();
                        $('btnNuevoEmergencia').hide();
                        regresaracronogramacitas();
                        $('programacioncitas').style.display = 'block';
                        $('programacioncitasEmergencia').style.display = "none";
                        $('btnNuevoEmergencia').hide();
                        break;
                    }
                    case '2': //tipo detalle
                    {
                        mostrarProgramacionEmergenciaInformes(0);
                        break;
                    }

                }
            }
        }
    })
}
function refrescaCalendarioCitasInformes(fechaActual) {
    pathLink = "p1=calendario01&p2=" + fechaActual + "&p3=";
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText.split("|");
            fechaActual = respuesta[1];
            document.getElementById("hFecha").value = fechaActual;
            $('divBusCronograma').update(respuesta[0]);
            if (document.getElementById("hOpcionBusqueda").value != "") {
                seleccionactividad();
                $('divDatosMedicoInformes').hide();
                var vista = $('selectVista').value;
                switch (vista) {
                    case '1':  //tripo matriz
                    {
                        $('btnProximaCIta').show();
                        $('btnNuevoEmergencia').hide();
                        regresaracronogramacitas();
                        $('programacioncitas').style.display = 'block';
                        $('programacioncitasEmergencia').style.display = "none";
                        $('btnNuevoEmergencia').hide();
                        break;
                    }
                    case '2': //tipo detalle
                    {
                        mostrarProgramacionEmergenciaInformes(0);
                        break;
                    }

                }

            }
        }
    })
}
function refrescaCalendario(fechaActual) {
    pathLink = "p1=calendario01&p2=" + fechaActual + "&p3=";
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText.split("|");
            fechaActual = respuesta[1];
            document.getElementById("hFecha").value = fechaActual;
            $('divBusCronograma').update(respuesta[0]);

        }
    })
}
function cargardatos() {
    //fechabusqueda = document.getElementById("hFechaBusqueda").value;
    mygrid = new dhtmlXGridObject('programacioncitas');
    pathLink = pathRequestControl + "?p1=mostrarCabeceraCronogramaCitasInformes";
    myajax.Link(pathLink);
//window.alert(myajax.responseText);


//mygrid.setHeader("Hora,Lunes,#cspan,#cspan,Martes,Miercoles,Jueves,Viernes,S&aacute;bado,Domingo");
}

function clickCargaMedico(html, event, cadena) {
    //Pasamos el valor 4 para la busqueda x Medico
    var codigoPersonalSalud = cadena.substring(0, 7);
    var codigoCentroCostos = cadena.substring(8, 18);
    var tam = cadena.length;
    var nombreMedico = "<font color=\"#00AA00\">Medico : " + cadena.substring(19, tam) + "</font>"
    $("hOpcionBusqueda").value = "5";
    $("hCodigoPersonalSalud").value = codigoPersonalSalud;
    $("hServicio").value = codigoCentroCostos;
    $("hNombreCentroCosto").value = nombreMedico;
    //opcionBusqueda = document.getElementById("hOpcionBusqueda").value;
    //fecha = document.getElementById('hFecha').value;
    $('programacioncitas').show();
    $('programacioncitasEmergencia').hide();
    limpiarDescripcionCita();
    guardadoexitoso = 0;
    regresaracronogramacitas();

}

function cargaCronogramaFecha(html, event, cadena) {
    //Pasamos el valor 4 para la busqueda x Medico
    hiddenDia = document.getElementById('cal01').getElementsByTagName("input")[4];
    diaactual = hiddenDia.value;
    fecha = cadena.substring(0, 10);
    //fecha = replaceAll(fecha,'.', '-');
    fecha = fecha.replace('.', '-');
    fecha = fecha.replace('.', '-');
    //window.alert(fecha);
    codigoPersonalSalud = cadena.substring(11, 18);
    codigoCentroCostos = cadena.substring(19, 29);
    dia = 'cal01-' + cadena.substring(8, 10);

    tam = cadena.length;
    nombreMedico = "<font color=\"#00AA00\">Medico : " + cadena.substring(30, tam) + "</font>"
    //window.alert(fecha+'***'+codigoPersonalSalud+'***'+codigoCentroCostos+'***'+nombreMedico+'***'+dia);

    document.getElementById("hOpcionBusqueda").value = "5";
    document.getElementById("hCodigoPersonalSalud").value = codigoPersonalSalud;
    document.getElementById("hServicio").value = codigoCentroCostos;
    document.getElementById("hNombreCentroCosto").value = nombreMedico;
    opcionBusqueda = document.getElementById("hOpcionBusqueda").value;
    document.getElementById('hFecha').value = fecha;
    seleccionarFechaCitasInformes(dia, 'cal01');
    limpiarDescripcionCita();
    guardadoexitoso = 0;
    if (diaactual == cadena.substring(8, 10))
        regresaracronogramacitas();
}
function clickCargaServicio(id, nombrecentrocosto)
{
    //Pasamos el valor 3 para la busqueda x Centro de Costo
    $('programacioncitas').style.background = '';
    var idfilaseleccionada = "";
    var idcolumnaseleccionada = "";
    $("hOpcionBusqueda").value = "2";
    $("hServicio").value = id;
    var fecha = document.getElementById('hFecha').value;
    var servicio = document.getElementById("hServicio").value
    $("hNombreCentroCosto").value = nombrecentrocosto;
    nombrecentrocosto = "<font color=\"#00AA00\">Servicio :   " + nombrecentrocosto + " </font>";
    $("hNombreCentroCosto").value = nombrecentrocosto;
    $("hOpcionSede").value = $("cb_filtroSede").value;
    var sede = document.getElementById("hOpcionSede").value;
    limpiarDescripcionCita();
    limpiaCargaMedicos();
    guardadoexitoso = 0;
    seleccionactividad();
    $('divDatosMedicoInformes').hide();
    var vista = $('selectVista').value;
    switch (vista) {
        case '1':  //tripo matriz
        {
            $('btnProximaCIta').show();
            $('btnNuevoEmergencia').hide();
            regresaracronogramacitas();
            $('programacioncitas').style.display = 'block';
            $('programacioncitasEmergencia').style.display = "none";
            $('btnNuevoEmergencia').hide();
            break;
        }
        case '2': //tipo detalle
        {
            mostrarProgramacionEmergenciaInformes(0);
            break;
        }

    }

}
function verCronogramaMedicoMensual(codigo, nombre) {
    $('programacioncitas').hide();
    $('programacioncitasEmergencia').show();
    $('selectVista').value = '2';
    var nombreMedico = "<font color=\"#00AA00\">Cronograma del Dr: " + nombre + "</font>"
    $('divEspecialidadoMedico').update(nombreMedico);
    $('btnNuevoEmergencia').show();
    var patronModulo = 'mostrarCronogramaMedicoCita';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + $('hFecha').value;
    parametros += '&p3=' + codigo;
    var Seleccionado = 0;

    tablaEmergenciaInformes = new dhtmlXGridObject('contenedorTablaCronogramaAtenciones');
    tablaEmergenciaInformes.setImagePath("../../../../medifacil_front/imagen/icono/");
    tablaEmergenciaInformes.attachEvent("onRowSelect", function (rowId, colId) {
        var iActivo = tablaEmergenciaInformes.cells(rowId, 8).getValue()
        var dFecha = tablaEmergenciaInformes.cells(rowId, 9).getValue()
        if (iActivo == 1 || iActivo == 0) {
            var iCodigoCronograma = tablaEmergenciaInformes.cells(rowId, 0).getValue();
            document.links['btnEditarCita'].href = "javascript:validaredicionCitaInformes('1')";
            listarCronogramaMedicoEmergencia(iCodigoCronograma);
            var fechaActual = new Date($('FechaActual').value);
            var fechaseleecionada = new Date($('hFecha').value);
            if (fechaseleecionada >= fechaActual) {
                $('btnNuevoEmergencia').show();
                $('btnProximaCIta').hide();
            }
        }
        else {
            alert('La programacion esta bloqueada hasta la fecha ' + dFecha);
        }
    });

    tablaEmergenciaInformes.setSkin("dhx_skyblue");
    tablaEmergenciaInformes.init();
    tablaEmergenciaInformes.loadXML(pathRequestControl + '?' + parametros, function () {

        for (i = 0; i < tablaEmergenciaInformes.getRowsNum(); i++) {
            if (tablaEmergenciaInformes.cells(i, 7).getValue() == 1) {
                Seleccionado = 1;
                tablaEmergenciaInformes.selectRow(i, true, true, true);
            }
            if (tablaEmergenciaInformes.cells(i, 8).getValue() == 0) {
                tablaEmergenciaInformes.setRowColor(tablaEmergenciaInformes.getRowId(i), "#CFCFCF");
            }
            //            for (j = 0; j < tablaEmergenciaInformes.getColumnsNum(); j++) {
            //                tablaEmergenciaInformes.setCellTextStyle(tablaEmergenciaInformes.getRowId(i), j, 'color:#0066FF;border-top: 1px solid #5D5D5D;');
            //                if (tablaEmergenciaInformes.cells2(i, 6).getValue() == 0) {
            //                    tablaEmergenciaInformes.setRowColor(tablaEmergenciaInformes.getRowId(i), "#CFCFCF");
            //                }
            //            }

        }
        if (Seleccionado == 0) {
            listarCronogramaMedicoEmergencia(0);
        }
        //;

    });

    /*
     var fecha=document.getElementById('hFecha').value;
     var patronModulo='verCronogramaMedicoMensuales'
     var parametros='';
     parametros+='p1='+patronModulo;
     parametros+='&p2='+codigo;
     parametros+='&p3='+fecha;
     new Ajax.Request( pathRequestControl,{
     method : 'get',
     parameters : parametros,
     onLoading : micargador(1),
     onComplete : function(transport){
     micargador(0);
     var respuestas = transport.responseText;
     
     $('programacioncitas').hide();
     verdatosMedicoCronogramaMensual(codigo);
     }
     } )
     */
}
function mostrarProgramacionEmergenciaInformes(cronograma) {
    //$('hCodigoProgramacion').value='';
    var nombrecentrocosto = $("hNombreCentroCosto").value;
    $('programacioncitasEmergencia').style.display = 'block';
    $('programacioncitas').hide();
    $('divEspecialidadoMedico').update(nombrecentrocosto);
    $('divEspecialidadoMedico2').update(nombrecentrocosto);
    $('btnNuevoEmergencia').show();
    var arreglo = $('hServicio').value.split("|");
    var codigoservicio = arreglo[0];
    var patronModulo = 'mostrarProgramacionEmergenciaInformes';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + $('hFecha').value;
    parametros += '&p3=' + codigoservicio;
    parametros += '&p4=' + $("cb_filtroSede").value;
    if ($('btnEvioMedico')) {
        $('btnEvioMedico').hide();
    }

    tablaEmergenciaInformes = new dhtmlXGridObject('contenedorTablaCronogramaAtenciones');
    tablaEmergenciaInformes.setImagePath("../../../../medifacil_front/imagen/icono/");
    tablaEmergenciaInformes.attachEvent("onRowSelect", function (rowId, colId) {
        var iActivo = tablaEmergenciaInformes.cells(rowId, 6).getValue();
        var dFecha = tablaEmergenciaInformes.cells(rowId, 7).getValue();
        if (iActivo == 1 || iActivo == 0) {
            var iCodigoCronograma = tablaEmergenciaInformes.cells(rowId, 0).getValue();
            document.links['btnEditarCita'].href = "javascript:validaredicionCitaInformes('1')";
            listarCronogramaMedicoEmergencia(iCodigoCronograma);
            mostrarDetalleCronogramaMedico(iCodigoCronograma);
            var fechaActual = new Date($('FechaActual').value);
            var fechaseleecionada = new Date($('hFecha').value);
            if (fechaseleecionada >= fechaActual) {
                $('btnNuevoEmergencia').show();
                $('btnProximaCIta').hide();

            }
        }
        else {
            alert('La programacion esta bloqueada hasta la fecha ' + dFecha);
        }
        if (colId == 8) {
            var iCodigoCronograma2 = tablaEmergenciaInformes.cells(rowId, 0).getValue();
            abrirPupudHistoriaCronograma(iCodigoCronograma2);
        }

        limpiarDescripcionCita();

    });

    tablaEmergenciaInformes.setSkin("dhx_skyblue");
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaEmergenciaInformes.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    tablaEmergenciaInformes.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaEmergenciaInformes.init();
    tablaEmergenciaInformes.loadXML(pathRequestControl + '?' + parametros, function () {
        for (i = 0; i < tablaEmergenciaInformes.getRowsNum(); i++) {
            for (j = 0; j < tablaEmergenciaInformes.getColumnsNum(); j++) {
                tablaEmergenciaInformes.setCellTextStyle(tablaEmergenciaInformes.getRowId(i), j, 'color:#0066FF;border-top: 1px solid #5D5D5D;');
                if (tablaEmergenciaInformes.cells2(i, 6).getValue() == 0) {
                    tablaEmergenciaInformes.setRowColor(tablaEmergenciaInformes.getRowId(i), "#CFCFCF");
                }
            }

        }
        listarCronogramaMedicoEmergencia(cronograma);




    });
}
function seleccionactividad() {
    $('hOpcionActividad').value = $('selectActividades').value;
    document.links['btnEditarCita'].href = "javascript:validaredicionCitaInformes('0')";
    $('btnProximaCIta').hide();
    $('btnNuevoEmergencia').hide();
    $('programacioncitas').update(' ');
    $('divEspecialidadoMedico').update(' ');
    $('divEspecialidadoMedico2').update(' ');
    $('programacioncitasEmergencia').hide()
    $('programacioncitas').show()
    $('programacioncitas').style.border = "0px";
    $('divAfiliacion').update(' ');

}
function busquedaServicioProgramadoCitas() {

    var palabra = $('txtbusquedaTablaServiciosProgramados').value;
    var arrayPalabras = new Array();
    arrayPalabras = palabra.split(" ");
    var numeroPalabras = arrayPalabras.length;
    tablaServiciosProgramadosCitas.filterBy(1, arrayPalabras[0]);
    for (var i = 1; i < numeroPalabras; i++) {
        tablaServiciosProgramadosCitas.filterBy(1, arrayPalabras[i], true);
    }

}

function saltarTablaEspecialidades() {
    tablaServiciosProgramadosCitas.selectRow(0, true, true, true);

}


function recargarTablaServicios() {

    seleccionactividad();
    var parametronombre = '';
    var patronModulo = 'mostrarTablaServiciosCitas';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + parametronombre;
    parametros += '&p3=' + $('hOpcionActividad').value;

    tablaServiciosProgramadosCitas = new dhtmlXGridObject('divBusCronogramaArbol');
    tablaServiciosProgramadosCitas.setImagePath("../../../../medifacil_front/imagen/icono/");
    tablaServiciosProgramadosCitas.attachEvent("onRowSelect", function () {
        var arregloId = this.getSelectedRowId().split("|");

        clickCargaServicio(this.getSelectedRowId(), arregloId[1]);

    });

    tablaServiciosProgramadosCitas.setSkin("dhx_skyblue");
    tablaServiciosProgramadosCitas.init();
    tablaServiciosProgramadosCitas.loadXML(pathRequestControl + '?' + parametros);
    if ($('btnUbicacionImagenes')) {
        $('selectActividades').value == '0006' ? $('btnUbicacionImagenes').show() : $('btnUbicacionImagenes').hide();
        if ($('btnEvioMedico')) {
            $('btnEvioMedico').show();
        }

    }
}
function setCabeceraCronograma1(fecha, opcionBusqueda, servicio, nombreCentroCosto, codigoPersonalSalud, sede) {
    POO.Request({
        p1: 'mostrarCabeceraCronogramaCitasInformes',
        p2: fecha,
        p3: servicio,
        p4: codigoPersonalSalud,
        p5: opcionBusqueda,
        p6: sede
    }, function (respuestajs) {
        $('divEspecialidadoMedico').update(nombreCentroCosto);
        $('divEspecialidadoMedico2').update(nombreCentroCosto);
        eval(respuestajs);
    });
    $('divAccionesyBotones').show();
    $('divAcciones').hide();
    return;
}

function setCabeceraCronograma(fecha, opcionBusqueda, servicio, nombreCentroCosto, codigoPersonalSalud, sede) {
    fecha = trimJunny(fecha);
    var patronModulo = 'mostrarCabeceraCronogramaCitasInformes';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + fecha;
    parametros += '&p3=' + servicio;
    parametros += '&p4=' + codigoPersonalSalud;
    parametros += '&p5=' + opcionBusqueda;
    parametros += '&p6=' + sede;

    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('divEspecialidadoMedico').update(nombreCentroCosto);
            $('divEspecialidadoMedico2').update(nombreCentroCosto);
            eval(respuesta);
            $('divAccionesyBotones').show();
            $('divAcciones').hide();
            $('divSandy').show();

        }
    })
}

function calculaprecioservicio(iid_persona) {

    var afiliacionactiva = document.getElementById("hiCodigoFiliacionActiva").value;
    var cadenaCodigoservicio = document.getElementById("hServicio").value;
    var arrayServicio = cadenaCodigoservicio.split("|");
    var codigoservicio = trimJunny(arrayServicio[0]);
    var patronModulo = 'calculaprecioservicio';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + afiliacionactiva;
    parametros += '&p3=' + codigoservicio;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            //            alert(3);
            $('divPrecioServicio').update(respuesta);


        }
    })
}
function clickonFilaPersonaEncontrada(html, event, iid_persona) {
    var patronModulo1 = 'getBuscarPersonaCompleto';
    var parametros1 = '';
    parametros1 += 'p1=' + patronModulo1;
    parametros1 += '&p2=' + iid_persona;
    contadorCargador++;
    var idCargadorpeche = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros1,
        onLoading: cargadorpeche(1, idCargadorpeche),
        onComplete: function (transport) {
            cargadorpeche(0, idCargadorpeche);

            var respuesta1 = transport.responseText;
            if (rtrim(ltrim(respuesta1)) == 'ESSALUD|0') {
                alert('Paciente Afiliado a ESSALUD por favor regularizar Datos.');
                ventanaEditaPersona(iid_persona);
            } else {
                ocultaProcedimientos();
                getActosMedicos(iid_persona, 'getCodigoActomedico');

                $('divActosMedicos').show();
                var patronModulo = 'mostrarDatosPaciente';
                var parametros = '';
                parametros += 'p1=' + patronModulo;
                parametros += '&p2=' + iid_persona;
                contadorCargador++;
                var idCargador = contadorCargador;
                new Ajax.Request(pathRequestControl, {
                    method: 'get',
                    parameters: parametros,
                    asynchronous: false,
                    onLoading: cargadorpeche(1, idCargador),
                    onComplete: function (transport) {
                        cargadorpeche(0, idCargador);
                        var respuesta = transport.responseText;
                        //            alert(respuesta);
                        $('divDatosPersonaCitasInformes').update(respuesta);
                        calculaprecioservicio();
                        //            contarRegistrosgetTratamientoPaciente(iid_persona);    Original
                        getVinculadosTratamientoPaciente(iid_persona);
                        //-----------------------------------------------
                        var arreglo = $('hServicio').value.split("|");
                        var codigoservicio = arreglo[0];
                        var bEstadoServicio = validaServicionConProcedimiento(codigoservicio);
                        if (bEstadoServicio == 1) {
                            var codigoFiliacion = document.getElementById("hiCodigoFiliacionActiva").value;
                            var c_cod_ser_pro = document.getElementById("hServicio").value;

                            var radios = document.getElementById("rbtnprocedimiento").value;
                            document.getElementById("rbtnprocedimiento").checked = true;

                            //ventana_procedimiento(c_cod_ser_pro, codigoFiliacion);
                            var iid_persona = document.getElementById("txtcodigoPersona").value;

                            getVinculadosTratamientoPaciente(iid_persona);
                            getPrecioServicios();
                        }
                    }
                })
            }
        }
    });


}

function getBuscarPersonaCompleto(iid_persona) {

}

function getVinculadosTratamientoPaciente(iid_persona) {
    var i;
    document.getElementsByName("grupotipocita");
    for (i = 0; i < document.getElementsByName("grupotipocita").length; i++) {
        if (document.getElementsByName("grupotipocita").item(i).checked) {
            var codigoTipoCita = document.getElementsByName("grupotipocita").item(i).value;
        }
    }
    //alert(codigoTipoCita);
    //    contarRegistrosgetTratamientoPaciente(iid_persona);

    var patronModulo = 'getVinculadosTratamientoPaciente';
    var hServicioConsultorio = document.getElementById('hServicio').value; //Consultorio
    var hServiciosProcedimientos = document.getElementById('hcCodigoServicioProducto').value; //Procedimiento
    var arrayhServicio = hServicioConsultorio.split("|");
    var arrayCod_Ser_Pro = arrayhServicio[0];
    var arrayDescrip_Producto = arrayhServicio[1];

    //    if(document.getElementById("hiCodigoFiliacionActiva").value!= null)
    //    {
    var hiCodigoFiliacionActiva = document.getElementById("hiCodigoFiliacionActiva").value;
    //        
    //    }    

    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iid_persona;
    parametros += '&p3=' + arrayCod_Ser_Pro;
    parametros += '&p4=' + hiCodigoFiliacionActiva;
    parametros += '&p5=' + hServicioConsultorio;
    parametros += '&p6=' + hServiciosProcedimientos;
    parametros += '&p7=' + codigoTipoCita;

    TablagetVinculadosTratamientoPaciente = new dhtmlXGridObject('divRecetas_Procedimientos_prueba');
    TablagetVinculadosTratamientoPaciente.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    TablagetVinculadosTratamientoPaciente.setSkin("dhx_skyblue");
    TablagetVinculadosTratamientoPaciente.enableRowsHover(true, 'grid_hover');
    TablagetVinculadosTratamientoPaciente.attachEvent("onRowSelect",
            function (fil, col) {

            }
    );

    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    TablagetVinculadosTratamientoPaciente.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    TablagetVinculadosTratamientoPaciente.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });

    /////////////fin cargador ///////////////////////
    TablagetVinculadosTratamientoPaciente.enableMultiline(true);
    TablagetVinculadosTratamientoPaciente.init();
    TablagetVinculadosTratamientoPaciente.loadXML(pathRequestControl + '?' + parametros, function () {
        /*
         if (trim(codigoTipoCita) == '0001') {
         CargarBotonTablagetTratamientoPaciente();//doble comportamiento con tratamiento y sin tratamiento(bloqueado)
         
         }
         
         var cantidadRegistros = TablagetTratamientoPaciente.getRowsNum();
         if (trim(cantidadRegistros) == 1) {
         var idTratamientoUnico = TablagetTratamientoPaciente.cells(0, 9).getValue();
         var idReceta = TablagetTratamientoPaciente.cells(0, 0).getValue();
         
         $('hid_Recetas_Procedimientos_Tratamiento').value = idTratamientoUnico;
         document.getElementById("raTratamiento" + idReceta + idTratamientoUnico).checked = true;
         document.getElementById("raTratamiento" + idReceta + idTratamientoUnico).value = 1;
         document.getElementById("raTratamiento" + idReceta + idTratamientoUnico).disabled = true;
         
         }
         */
    }

    );

}

function getTratamientoPaciente(iid_persona) {
    var i;
    document.getElementsByName("grupotipocita");
    for (i = 0; i < document.getElementsByName("grupotipocita").length; i++) {
        if (document.getElementsByName("grupotipocita").item(i).checked) {
            var codigoTipoCita = document.getElementsByName("grupotipocita").item(i).value;
        }
    }
    //    contarRegistrosgetTratamientoPaciente(iid_persona);

    var patronModulo = 'getTratamientoPaciente';
    var hServicio = document.getElementById('hServicio').value;
    var arrayhServicio = hServicio.split("|");
    var arrayCod_Ser_Pro = arrayhServicio[0];
    var arrayDescrip_Producto = arrayhServicio[1];

    //    if(document.getElementById("hiCodigoFiliacionActiva").value!= null)
    //    {
    var hiCodigoFiliacionActiva = document.getElementById("hiCodigoFiliacionActiva").value;
    //        
    //    }    

    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iid_persona;
    parametros += '&p3=' + arrayCod_Ser_Pro;
    parametros += '&p4=' + hiCodigoFiliacionActiva;

    TablagetTratamientoPaciente = new dhtmlXGridObject('divRecetas_Procedimientos_prueba');
    TablagetTratamientoPaciente.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    TablagetTratamientoPaciente.setSkin("dhx_skyblue");
    TablagetTratamientoPaciente.enableRowsHover(true, 'grid_hover');
    TablagetTratamientoPaciente.attachEvent("onRowSelect",
            function (fil, col) {

            }
    );

    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    TablagetTratamientoPaciente.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    TablagetTratamientoPaciente.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });

    /////////////fin cargador ///////////////////////
    TablagetTratamientoPaciente.enableMultiline(true);
    TablagetTratamientoPaciente.init();
    TablagetTratamientoPaciente.loadXML(pathRequestControl + '?' + parametros, function () {

        if (trim(codigoTipoCita) == '0001') {
            //            alert("entro al 0001");
            CargarBotonTablagetTratamientoPaciente();//doble comportamiento con tratamiento y sin tratamiento(bloqueado)

        }

        var cantidadRegistros = TablagetTratamientoPaciente.getRowsNum();
        if (trim(cantidadRegistros) == 1) {
            var idTratamientoUnico = TablagetTratamientoPaciente.cells(0, 9).getValue();
            var idReceta = TablagetTratamientoPaciente.cells(0, 0).getValue();

            $('hid_Recetas_Procedimientos_Tratamiento').value = idTratamientoUnico;
            document.getElementById("raTratamiento" + idReceta + idTratamientoUnico).checked = true;
            document.getElementById("raTratamiento" + idReceta + idTratamientoUnico).value = 1;
            document.getElementById("raTratamiento" + idReceta + idTratamientoUnico).disabled = true;

        }

    });

}

function getTratamientoPaciente2(iid_persona) {

    var patronModulo = 'getTratamientoPaciente2';
    var hServicio = document.getElementById('hServicio').value;
    var arrayhServicio = hServicio.split("|");
    var arrayCod_Ser_Pro = arrayhServicio[0];
    var arrayDescrip_Producto = arrayhServicio[1];
    var hiCodigoFiliacionActiva = document.getElementById('hiCodigoFiliacionActiva').value;

    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iid_persona;
    parametros += '&p3=' + arrayCod_Ser_Pro;

    TablagetTratamientoPaciente2 = new dhtmlXGridObject('divRecetas_Procedimientos_prueba');
    TablagetTratamientoPaciente2.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    TablagetTratamientoPaciente2.setSkin("dhx_skyblue");
    TablagetTratamientoPaciente2.enableRowsHover(true, 'grid_hover');
    TablagetTratamientoPaciente2.attachEvent("onRowSelect",
            function (fil, col) {

            }
    );

    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    TablagetTratamientoPaciente2.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    TablagetTratamientoPaciente2.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });

    /////////////fin cargador ///////////////////////

    TablagetTratamientoPaciente2.init();
    TablagetTratamientoPaciente2.loadXML(pathRequestControl + '?' + parametros, function () {
        CargarBotonTablagetTratamientoPaciente2();//doble comportamiento con tratamiento y sin tratamiento(bloqueado)

    });

}

function CargarBotonTablagetTratamientoPaciente2() {

    var idReceta = TablagetTratamientoPaciente2.cells(0, 0).getValue();
    var idTratamiento = TablagetTratamientoPaciente2.cells(0, 9).getValue();

    TablagetTratamientoPaciente2.cells(0, 10).setValue('<input name="raTratamiento2" id="raTratamiento2' + idReceta + '" onclick= "if(this.checked){this.value=1}else{this.value=0;};seleccionandoTratamientoParaCita(' + idReceta + ',' + idTratamiento + ')" type="radio" title="Tratamiento" name="grupoTratamientoAescoger"  disabled="true" checked="true" value="0">');
    TablagetTratamientoPaciente2.setRowTextStyle(TablagetTratamientoPaciente2.getRowId(0), 'background-color:#FF3300;color:white;border-top: 1px solid #DAEFC2;');


}


function contarRegistrosgetTratamientoPaciente(iid_persona) {
    var hServicio = document.getElementById('hServicio').value;
    var arrayhServicio = hServicio.split("|");
    var arrayCod_Ser_Pro = arrayhServicio[0];
    var arrayDescrip_Producto = arrayhServicio[1];
    var hiCodigoFiliacionActiva = document.getElementById('hiCodigoFiliacionActiva').value;

    var patronModulo = 'contarRegistrosgetTratamientoPaciente';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iid_persona;
    parametros += '&p3=' + arrayCod_Ser_Pro;
    parametros += '&p4=' + hiCodigoFiliacionActiva;

    var datosx = traerDataPrueba(parametros);

    if (datosx[0].trim() == 'yes') {
        //        alert("si tiene registros")
        $('hid_Recetas_Procedimientos_Tratamiento').value = '';
        $('hid_Recetas').value = '';
        getTratamientoPaciente(iid_persona);

    } else if (datosx[0].trim() == 'not') {
        //             alert("no tiene registros");
        $('hid_Recetas_Procedimientos_Tratamiento').value = 'abcde';
        $('hid_Recetas').value = 'fghij';
        var iid_persona1 = 'xxxxx';
        getTratamientoPaciente2(iid_persona1);

    }

}




function CargarBotonTablagetTratamientoPaciente() {

    for (var i = 0; i < TablagetTratamientoPaciente.getRowsNum(); i++) {

        var idReceta = TablagetTratamientoPaciente.cells(i, 0).getValue();
        var idTratamiento = TablagetTratamientoPaciente.cells(i, 9).getValue();
        TablagetTratamientoPaciente.cells(i, 10).setValue('<input id="raTratamiento' + idReceta + idTratamiento + '" onclick= "if(this.checked){this.value=1}else{this.value=0;};seleccionandoTratamientoParaCita(' + idReceta + ',' + idTratamiento + ')" type="radio" title="Tratamiento" name="grupoTratamientoAescoger"  value="0">');
    }

}

function seleccionandoTratamientoParaCita(idReceta, idTratamiento) {


    if (window.confirm("¿Está seguro que desea escoger este Tratamiento")) {

        $('hid_Recetas').value = idReceta;
        $('hid_Recetas_Procedimientos_Tratamiento').value = idTratamiento;

    }

}





function selecctionaProducto(html, event, c_cod_ser_pro) {
    document.getElementById("hcCodigoServicioProducto").value = c_cod_ser_pro;
}

function regresaracronogramacitas() {
    $("hOpcionSede").value = $("cb_filtroSede").value;
    $('ReservaciondeCita').hide();
    $('CronogramaCompleto').show();
    $('divcronogramacitas').show();
    //    if($('contenedorTablaCronogramaAtenciones')){
    //        var iCodigoCronograma=$('hcodigocronograma').value;
    //        listarCronogramaMedicoEmergencia(iCodigoCronograma);
    //    }
    var fecha = document.getElementById('hFecha').value;
    fecha = trimJunny(fecha);
    var opcionBusqueda = document.getElementById("hOpcionBusqueda").value;
    var servicio = document.getElementById("hServicio").value;
    var nombrecentrocosto = document.getElementById("hNombreCentroCosto").value;
    var codigoPersonalSalud = document.getElementById("hCodigoPersonalSalud").value;
    var sede = document.getElementById("hOpcionSede").value;
    if (guardadoexitoso == 1) {
        var codigoProgramacion = $('hCodigoProgramacion').value;
        descripcionCita(idfilaseleccionada, idcolumnaseleccionada, codigoProgramacion);
    }
    if ($('selectVista').value == 1) {
        setCabeceraCronograma(fecha, opcionBusqueda, servicio, nombrecentrocosto, codigoPersonalSalud, sede);
    } else {
        listarCronogramaMedicoEmergencia($('hcodigocronograma').value)
    }

    $('divGuardaryRegresar').innerHTML = "<a href=\"javascript:validarCitaInformes()\"><img src=\"../../../../medifacil_front/imagen/btn/b_grabar__on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:regresaracronogramacitas()\"><img src=\"../../../../medifacil_front/imagen/btn/b_regresar_on.gif\">";
    $('divDatosPersonaCitasInformes').update("<input id=hiCodigoPersona name =hiCodigoPersona value='' type=hidden /><input id=hiCodigoPaciente type=hidden />");

}

function limpiarReservacion() {
    limpiarCampos('0');
    limpiarTablaBuscarPersonas();

    $('divDatosPersonaCitasInformes').innerHTML = "<input id=\"hiCodigoPersona\" name =\"hiCodigoPersona\" value=\"\" type=\"hidden\"/><input id=\"hiCodigoPaciente\" type=\"hidden\"/>"
            + "<div align=\"center\"><font color=\"00028F\" class=\"Estilo9\">Datos del Paciente</font></div>"
            + "<fieldset style=\"margin:5px;padding:5px;border:none\">"
            + "<table>"
            + "<tr><td class=\"Estilo6\">Filiaci&oacute;n Activa</td><td>-----</td></tr>"
            + "<tr><td class=\"Estilo6\">Apellido Paterno</td><td>-----</td></tr>"
            + "<tr><td class=\"Estilo6\">Apellido Materno</td><td>-----</td></tr>"
            + "<tr><td class=\"Estilo6\">Nombres</td><td>-----</td></tr>"
            + "<tr><td class=\"Estilo6\">N&deg; Documento</td><td>-----</td></tr>"
            + "<tr><td class=\"Estilo6\">Fecha Nacimiento</td><td>-----</td></tr>"
            + "</table>"
            + "</fieldset>"
            + "";

    $('divNumeroOrdenGenerada2').innerHTML = "<font color=\"RED\">Nro. Orden : </font>";
    ocultaProcedimientos();

}
function limpiarDescripcionCita() {
    //$('hCodigoProgramacion').value='';
    var descripcioncitaLimpia = "<table width=\"100%\" align=\"center\" border=\"0\">"
            + "<tr>"
            + "<td width=\"33%\" align=\"center\" class=\"Estilo7\">Persona&nbsp;: -----</td>"
            + "<td width=\"33%\" align=\"center\" class=\"Estilo7\">Médico&nbsp;: -----</td>"
            + "<td width=\"33%\" align=\"center\" class=\"Estilo7\">Especialidad&nbsp;: -----</td>"
            + "</tr>"
            + "</table>"
            + "<table width=\"100%\" align=\"center\" border=\"0\">"
            + "<tr>"
            + "<td width=\"30%\" align=\"center\" class=\"Estilo7\">Fecha&nbsp;: -----</td>"
            + "<td width=\"40%\" align=\"center\" class=\"Estilo7\">Ambiente&nbsp;: -----</td>"
            + "<td width=\"30%\" align=\"center\" class=\"Estilo7\">Hora&nbsp;: -----</td>"
            + "</tr>"
            + "</table>"
            + "<table width=\"100%\" align=\"center\" border=\"0\">"
            + "<tr>"
            + "<td width=\"33%\" align=\"center\" >Tipo de Servicio: -----</td>"
            + "<td width=\"33%\" align=\"center\" >Localización: -----</td>"
            + "<td width=\"33%\" align=\"center\" >Usuario: -----</td>"
            + "</tr>"
            + "</table>";
    $('divNumeroOrdenGenerada1').innerHTML = "<div><font color=\"RED\">Nro. Orden : </font></div>";
    $('divCodigoPersona').innerHTML = "<div><font color=\"BLUE\">Cod. Persona : </font></div>";
    $('divDescripcionCita').innerHTML = descripcioncitaLimpia

}
function nuevaCita(codigoHora, codigoCronograma, tipocitaprogramada) {
    $('CronogramaCompleto').hide();
    $('divcronogramacitas').hide();
    $('ReservaciondeCita').show();
    //$('divLeyendaCitasInformes').hide();
    //$('Div_Actividades').hide();
    //fecha = document.getElementById("hFecha").value;
    $("htipoProgramacion").value = tipocitaprogramada;
    getActosMedicos('-', '');
    // tipo de cita programada es 1 si es adicional y 0 si no lo es.
    if (tipocitaprogramada == 1 || tipocitaprogramada == 2) {
        Windows.close("Div_tablacitasAdicionales");
    }
    $("divNumeroOrdenGenerada2").update("<input id='idNroOrden' type='hidden' value=''><font color='RED'>Nro. Orden : </font>")
    $("hcodigocronograma").value = codigoCronograma;



    pathLink = pathRequestControl + "?p1=reservarCitaInformesCronograma&p2=" + codigoCronograma;//muestra los datos del cronograma en la capa divCronogramaCitasInformes de citas.php


    pathLink2 = pathRequestControl + "?p1=reservarCitaInformesServicio&p2=" + codigoHora + "&p3=" + codigoCronograma + "&p4=" + tipocitaprogramada;//muestras los datos de la cita en la capa divProgramacionCitasInformes en citas.php

    myajax.Link(pathLink, "divCronogramaCitasInformes");
    myajax2.Link(pathLink2, "divProgramacionCitasInformes");
}
/*********************citas Adicionales****************************************/
function nuevaCitaAdicional(codigoCronograma) {
    ventana_citas_adicionales(codigoCronograma, " ");
}
function eliminarCitaAdicionalInformes(parametros, codigoCronograma) {
    var codigoProgramacion = parametros.split("|")[0];
    pathLink = "?p1=eliminarCitaAdicional&p2=" + codigoProgramacion;
    if (confirm("¿Esta seguro de eliminar la cita?")) {
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: pathLink,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                respuesta = transport.responseText;
                cerrarVentanaAdicionales();
                regresaracronogramacitas();
            }
        })
    }

}
function prohibidoeliminarAdicionalInformes(motivoprohibicion) {
    window.alert("No Eliminado,el estado de la cita es " + motivoprohibicion);
}
/*==============================================================================*/
/*DESCOMENTAR PARA QUE FUNCIONE LOS ADICIONALES IDEALMENTE!!!!!CUANDO SE HAGA EL MODULO PARA MEDICOS*/
/*
 function ventana_citas_adicionales(codigoCronograma,funcionJSEjecutar){
 //window.alert($('divBusCronogramaMedico').getStyle('z-index'));
 CargarVentana('tablacitasAdicionales','Reservacion de Citas Adicionales','../../ccontrol/control/control.php?p1=mostrarTablaAdicionales&p2='+codigoCronograma+'&funcionJSEjecutar='+funcionJSEjecutar,'650','350','t',true,0,1,'',0,0,0,0);
 
 }
 */
/*==============================================================================*/
/*MOSTRAR LAS PROGRAMACIONES DETALLADAS CON ADICIONALES FUERA DE TURNOS=====PARCHE!!!!*/
/*COMENTAR O ELIMINAR CUANDO SE REALIZE EL MODULO PARA MEDICOS*/

function ventana_citas_adicionales(codigoCronograma, funcionJSEjecutar) {
    //    alert(funcionJSEjecutar);
    //    window.alert($('divBusCronogramaMedico').getStyle('z-index'));
    CargarVentana('tablacitasAdicionales', 'Programacion de Citas Detalladas', '../../ccontrol/control/control.php?p1=mostrarTablaProgramacionDetallada&p2=' + codigoCronograma + '&funcionJSEjecutar=' + funcionJSEjecutar, '800', '500', 't', true, 0, 1, '', 0, 0, 0, 0);

}

/*=============================================================================*/
function cerrarVentanaAdicionales() {
    Windows.close("Div_tablacitasAdicionales");
}

/******************************************************************************/
function descripcionCitaAdicional(html, event, parametro) {

    $('hCodigoProgramacion').value = parametro.split("|")[0];
    $('hEstadoAtencion').value = parametro.split("|")[1];

    descripcionCita("", "", $('hCodigoProgramacion').value);
}
function descripcionCita(codigoHora, codigoCronograma, codigoProgramacion) {
    idfilaseleccionada = codigoHora;
    idcolumnaseleccionada = codigoCronograma;
    //    alert("descripcionCita");
    //    pathLink = pathRequestControl+"?p1=describirCitaProgramada&p2="+codigoCronograma+"&p3="+codigoHora;
    //    myajax.Link(pathLink,"divDescripcionCita");
    pathLink = "?p1=describirCitaProgramada&p2=" + codigoCronograma + "&p3=" + codigoHora + "&p4=" + codigoProgramacion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            $('divDescripcionCita').update(respuesta);
            $('divSandy').show();
        }
    })


    var data = 'p1=cargarNumeroOrdenGenerada&p2=' + codigoCronograma + '&p3=' + codigoHora + "&p4=" + codigoProgramacion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: data,
        onLoading: micargador(1),
        onComplete: function (transport) {
            //            alert("cargarNumeroOrdenGenerada 2");
            micargador(0);
            var respuesta = transport.responseText;
            arreglo = respuesta.split("|");
            $('divNumeroOrdenGenerada1').update(arreglo[0]);
            $('divAfiliacion').update(arreglo[1]);
            //$('divNumeroOrdenGenerada2').update(respuesta);
        }
    })

    data = 'p1=cargarCodigoPersona&p2=' + codigoCronograma + '&p3=' + codigoHora + "&p4=" + codigoProgramacion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: data,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            arreglo = respuesta.split("|");
            $('divCodigoPersona').update(arreglo[0]);
            $('hCodigoProgramacion').value = arreglo[1];
        }
    })

}

/*********************Mantenimiento de la cita Programada*********************************/
function validarCitaInformes() {
    var codigoServicioProducto = document.getElementById("hcCodigoServicioProducto").value;

    var precioCadena = new Array();
    precioCadena = codigoServicioProducto.split("gxxxgr");
    var precioFinal = 0;
    var nPrecio = new Array();
    for (x = 0; x <= precioCadena.length - 2; x++) {
        nPrecio = precioCadena[x].split("|");
        precioFinal = precioFinal + parseFloat(nPrecio[2]);
    }

    if ($('txtPrecioServicio').value != 0 || precioFinal != 0) {

        var idTratamientoSeleccionado = document.getElementById("hid_Recetas_Procedimientos_Tratamiento").value;
        //    var idRecetaSeleccionado=document.getElementById("hid_Recetas").value;

        var codigoServicioProducto = document.getElementById("hcCodigoServicioProducto").value;
        var codigoPersona = document.getElementById("hiCodigoPersona").value;
        var codigoPaciente = document.getElementById("hiCodigoPaciente").value;
        var codigoCronograma = document.getElementById("hiCodigoCronograma").value;
        var horaProgramada = document.getElementById("hcHoraProgramada").value;
        var observacionCita = document.getElementById("txtobservacioncita").value;
        var tipoProgramacion = document.getElementById("htipoProgramacion").value;
        var i;
        var ac_cod_pro = document.getElementById("hServicio").value;
        var arrayc_cod_pro = ac_cod_pro.split("|");
        var c_cod_pro = arrayc_cod_pro[0];
        var tipoUbicacionCita = $('selectUbicacionCita').value;

        document.getElementsByName("grupotipocita");
        var codigoTipoCita;
        for (i = 0; i < document.getElementsByName("grupotipocita").length; i++) {
            if (document.getElementsByName("grupotipocita").item(i).checked) {
                codigoTipoCita = document.getElementsByName("grupotipocita").item(i).value;
            }
        }
        var codigoActoMedico = document.getElementById("hcCodigoActoMedico").value;
        var path = "?p1=guardarCitaProgramada&p2=" + codigoCronograma +
                "&p3=" + codigoPersona +
                "&p4=" + codigoPaciente +
                "&p5=" + horaProgramada +
                "&p6=" + codigoTipoCita +
                "&p7=" + observacionCita +
                "&p8=" + codigoServicioProducto +
                "&p9=" + codigoActoMedico +
                "&p10=" + tipoProgramacion +
                "&p11=" + idTratamientoSeleccionado +
                "&p12=" + tipoUbicacionCita;
        validacion = true;
        if (codigoPersona == "") {
            window.alert("Seleccione una Persona");
            validacion = false;
        }
        if (codigoCronograma == "") {
            window.alert("Seleccione una Cronograma Medico");
            validacion = false;
        }
        if (horaProgramada == "") {
            window.alert("Seleccione una Hora de Programacion");
            validacion = false;
        }

        if (codigoTipoCita == "0002") {
            if (codigoServicioProducto == "") {
                window.alert("Seleccione un Procedimiento Medico");
                validacion = false;
            }
            /*if (codigoActoMedico == "SAM" && validacion) {
             if (!confirm("¿Seguro de Guardar sin Acto Medico?")) {
             validacion = false;
             }
             }*/
        }

        if (validacion == true) {
            pathLink = "?p1=verificarCronogramaAfiliacion&p2=" + codigoCronograma + "&p3=" + codigoPersona + "&p4=" + c_cod_pro;
            contadorCargador++;
            var idCargador = contadorCargador;
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: pathLink,
                onLoading: cargadorpeche(1, idCargador),
                onComplete: function (transport) {
                    cargadorpeche(0, idCargador);
                    var respuesta1 = transport.responseText;
                    var rs = respuesta1.split("|");
                    if (rs[0] == "1") {
                        window.alert(rs[1]);
                    } else {
                        if (rs[0] == "0") {
                            var mensaje = 'no';
                            if (rs[1] == 1) {
                                mensaje = rs[2];
                            }
                            if (confirm("¿Esta seguro de guardar la cita?")) {
                                guardarCitaInformes(path, mensaje, codigoPersona);
                            }

                        } else {
                            if (rs[0] == '2') {
                                if (confirm(rs[2])) {
                                    var mensaje = 'no';
                                    guardarCitaInformes(path, mensaje, codigoPersona);
                                }
                            }
                        }
                    }
                }
            })
            //window.alert(path);
        }
    } else {
        alert('Seleccionar Procedimiento');
    }
}

function cargarPopudVincularRecetasConTratamientos() {

    var patronModulo = 'cargarTablaVincularRecetasConTratamientos';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + $('hcCodigoServicioProducto').value;

    alert(parametros);
    tablaEnPopudVincularRecetasConTratamientos = new dhtmlXGridObject('div_TablaRecetasVsTratamientos');
    tablaEnPopudVincularRecetasConTratamientos.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaEnPopudVincularRecetasConTratamientos.setSkin("dhx_skyblue");
    tablaEnPopudVincularRecetasConTratamientos.enableRowsHover(true, 'othercaso');
    tablaEnPopudVincularRecetasConTratamientos.attachEvent("onRowSelect", function (fila, columna) {

    });

    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaEnPopudVincularRecetasConTratamientos.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    tablaEnPopudVincularRecetasConTratamientos.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    /////////////fin cargador ///////////////////////

    tablaEnPopudVincularRecetasConTratamientos.init();
    tablaEnPopudVincularRecetasConTratamientos.loadXML(pathRequestControl + '?' + parametros, function () {

    });

}

function PopudVincularRecetasConTratamientos() {
    //div_TablaRecetasVsTratamientos
    //CargarlistadoTodosTurnosDisponibles
    //    alert("PopudVincularRecetasConTratamientos");

    var codigoServicioProducto = document.getElementById("hcCodigoServicioProducto").value;
    var codigoPersona = document.getElementById("hiCodigoPersona").value;
    var hiCodigoFiliacionActiva = document.getElementById("hiCodigoFiliacionActiva").value;




    posFuncion = "cargarPopudVincularRecetasConTratamientos";
    vtitle = "Recetas vs Tratamientos";
    vformname = 'PopudVincularRecetasConTratamientos';
    vwidth = '532';
    vheight = '348';
    patronModulo = 'PopudVincularRecetasConTratamientos';
    vcenter = 't';
    vresizable = '';
    vmodal = 'false';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    //    parametros+='&p2='+IdExamenLaboratorio;
    //    parametros+='&p3='+NombreExamenLaboratorio;
    //    parametros+='&p4='+cordinador;
    //    parametros+='&p5='+idSedeempresaArea;

    //alert(parametros);

    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}


function guardarCitaInformes(path, mensaje, c_cod_per) {
    var pathLink = path;

    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        asynchronous: false,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta2 = transport.responseText.split("|");

            $('divNumeroOrdenGenerada1').update(respuesta2[0]);
            $('divNumeroOrdenGenerada2').update(respuesta2[0]);
            $('hCodigoProgramacion').value = respuesta2[1];


            guardadoexitoso = 1;

            if (mensaje != 'no') {

                if (confirm(mensaje)) {
                    ventanaEditaPersona(c_cod_per)
                }
                if ($('hPermisoPagar').value == 1) {

                    pagarCitaInmediata();
                }
            } else {

                if ($('hPermisoPagar').value == 1) {

                    pagarCitaInmediata();
                }
            }
        }
    })
    $('divGuardaryRegresar').innerHTML = "<a href=\"javascript:regresaracronogramacitas()\"><img src=\"../../../../medifacil_front/imagen/btn/b_regresar_on.gif\">";


}
function editarCitaInformes() {
    var idfilaorigen = $("hidfilaorigen").value;  //
    var idcolumnaorigen = $("hidcolumnaorigen").value;
    var idfiladestino = $("hidfiladestino").value;
    var idcolumnadestino = $("hidcolumnadestino").value;
    var idcodigoprogramacion = $("hCodigoProgramacion").value;
    //    alert("mela1");
    //    alert(idfiladestino); 
    //    alert("mela2");
    if (idfilaorigen == 'Adicionales') {
        idfilaorigen = '---';
    }
    if (idfiladestino == 'Adicionales') {
        idfiladestino = '---';
    }
    if (idfiladestino == 'TipoAmbiente') {
        idfiladestino = '';
    }
    if (idfiladestino == 'IsProcedimiento') {
        idfiladestino = '';
    }
    if (idfiladestino != "" && idcolumnadestino != "") {//
        //alert(idfilaorigen+' '+idcolumnaorigen+' '+idfiladestino+' '+idcolumnadestino);
        var patronModulo = 'editarCitaInformes';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + idcolumnaorigen; //cronograma origen
        parametros += '&p3=' + idfilaorigen; //hora origen
        parametros += '&p4=' + idcolumnadestino; //cronograma destino
        parametros += '&p5=' + idfiladestino; //hora destino
        parametros += '&p6=' + idcodigoprogramacion; //codigo programacion
        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            asynchronous: false,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function (transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                var array = respuesta.split("|");
                window.alert(array[1]);
                if (document.getElementById("hOpcionBusqueda").value != "") {
                    var fecha = document.getElementById("hFecha").value;
                    fecha = trimJunny(fecha)
                    var opcionBusqueda = document.getElementById("hOpcionBusqueda").value;
                    var servicio = document.getElementById("hServicio").value;
                    var nombrecentrocosto = document.getElementById("hNombreCentroCosto").value;
                    var codigoPersonalSalud = document.getElementById("hCodigoPersonalSalud").value;
                    $("hOpcionSede").value = $("cb_filtroSede").value;
                    var sede = document.getElementById("hOpcionSede").value;
                    setCabeceraCronograma(fecha, opcionBusqueda, servicio, nombrecentrocosto, codigoPersonalSalud, sede);
                    if (array[0] == 1) {
                        descripcionCita(idfiladestino, idcolumnadestino, "");
                    }
                    if (array[0] == 0) {
                        descripcionCita(idfilaorigen, idcolumnaorigen, "");
                    }
                    if (idfiladestino == '---') {
                        nuevaCitaAdicional(idcolumnadestino);
                    }
                }
            }
        })
    } else {
        alert("Seleccione la celda Correcta")
    }
    cancelaredicioncitas();
}
function validaredicionCitaInformes(tipoprogramacion) {
    // tipoprogramacion = 0 .... cita programada
    // tipoprogramacion = 1 .... cita adicional

    var tipoVista = $('selectVista').value;
    var estadoatencion = $('hEstadoAtencion').value;
    if (tipoVista == '1') {
        //var estadoatencion = $('hEstadoAtencion').value;
        switch (tipoprogramacion) {
            case '0':
            {
                var idfilaorigen = $("hidfilaorigen").value;
                var idcolumnaorigen = $("hidcolumnaorigen").value;
                var idfiladestino = $("hidfiladestino").value;
                var idcolumnadestino = $("hidcolumnadestino").value;
                //mododeejecucion = 1;
                $('hMododeejecucion').value = 1;
                if ($('hColorSeleccionado').value == "#F0F43A" || $('hColorSeleccionado').value == "#F8A83E") {
                    if (confirm("¿Esta seguro de editar la cita?")) {
                        if (idfilaorigen != "" && idcolumnaorigen != "")
                            $('Div_edicioncita').show();

                    }
                } else {
                    if (colorceldaseleccionada == "#DEEDF8") {
                        window.alert("Cita NO posible Editar,el estado es ATENDIDO");
                        cancelaredicioncitas();
                    } else {
                        window.alert("Elija celda correcta!!!");
                        cancelaredicioncitas();
                    }
                }
                break;

            }
            case '1':
            {
                switch (estadoatencion) {
                    case 'ATENDIDO' :
                        {
                            window.alert('El paciente ya fue atendido');
                        }
                        break;
                    default:
                    {
                        if (estadoatencion == 'RESERVADO' || estadoatencion == 'PAGADO') {
                            if (confirm("¿Esta seguro de editar la cita?")) {
                                //window.alert("Elija el cronograma y la celda correspondiente")
                                $('Div_edicioncita').show();
                                cerrarVentanaAdicionales();
                                $("hidfilaorigen").value = 'Adicionales'
                                $("hidcolumnaorigen").value = $("hcodigocronograma").value;
                                idfilaorigen = $("hidfilaorigen").value;
                                idcolumnaorigen = $("hidcolumnaorigen").value;
                                idfiladestino = $("hidfiladestino").value;
                                idcolumnadestino = $("hidcolumnadestino").value;
                                $('hMododeejecucion').value = 1;
                                if ($('selectVista').value == '2') {
                                    $('selectVista').value = 1;
                                    $('programacioncitasEmergencia').hide();
                                    $('programacioncitas').show();

                                    regresaracronogramacitas();
                                }

                            } else {
                                cancelaredicioncitas();
                            }
                        }
                    }
                }

                break;
            }
        }
    } else {  //vista detalle
        switch (estadoatencion) {
            case 'ATENDIDO' :
                {
                    window.alert('El paciente ya fue atendido');
                }
                break;
            default:
            {
                if (estadoatencion == 'RESERVADO' || estadoatencion == 'PAGADO') {

                    ventanaEditarCita();


                }
            }
        }


    }

}
function ventanaEditarCita() {
    var iCodigoProgramacion = $('hCodigoProgramacion').value;
    if (iCodigoProgramacion == '') {
        alert('Seleccione a un paciente');
    } else {
        //alert('continuar...');
        var vformname = 'ventanaEditarcita';
        var vtitle = 'Editar Cita la Imagen';
        var vwidth = '800';
        var vheight = '300';
        var vcenter = 't';
        var vresizable = '';
        var vmodal = 'false';
        var vstyle = '';
        var vopacity = '';

        var vposx1 = '';
        var vposx2 = '';
        var vposy1 = '';
        var vposy2 = '';

        var patronModulo = 'ventanaEditarCita';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + iCodigoProgramacion;
        var posFuncion = 'insertarCalendario()';

        CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
    }
}
function insertarCalendario() {

    calendarioEditarCitasHtmlx = new dhtmlXCalendarObject("calendarioEditarCitas", true, {
        isMonthEditable: true,
        isYearEditable: true,
        dateformat: '%d/%m/%Y'

    });
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
    calendarioEditarCitasHtmlx.loadUserLanguage('es');

    calendarioEditarCitasHtmlx.attachEvent("onClick", function (d) {

        cargarMedicosEditarCita(calendarioEditarCitasHtmlx.getFormatedDate(null, d))

    });

    var fechaOriginal = $('fechaSeleccionadaEditarCita').value;
    var arrayFecha = fechaOriginal.split("/");
    calendarioEditarCitasHtmlx.setDate(new Date(arrayFecha[2], arrayFecha[1] - 1, arrayFecha[0]));

    calendarioEditarCitasHtmlx.show();

    cargarMedicosEditarCita(fechaOriginal);


}
function cargarMedicosEditarcitaEspecialidad() {
    var fecha = $('fechaSeleccionadaEditarCita').value
    cargarMedicosEditarCita(fecha);
}
function cargarMedicosEditarCita(fecha) {
    $('fechaSeleccionadaEditarCita').value = fecha;
    var arrayFechaActual = $('fechaActualEditarCita').value.split('/');
    var fechaActual = arrayFechaActual[2] + arrayFechaActual[1] + arrayFechaActual[0];
    //var fechaActual=new Date(arrayFechaActual[2],arrayFechaActual[1]-1 ,arrayFechaActual[0]);
    var ArrayfechaSeleccionada = fecha.split('/');
    var fechaSeleccionada = ArrayfechaSeleccionada[2] + ArrayfechaSeleccionada[1] + ArrayfechaSeleccionada[0];
    //var fechaSeleccionada=new Date(ArrayfechaSeleccionada[2],ArrayfechaSeleccionada[1]-1 ,ArrayfechaSeleccionada[0]);
    $('cronogramaDestinoEditarCita').value = '';
    $('divTurnosEditar').update('');
    $('divBotonGrabarEditarCita').hide();
    if (fechaSeleccionada >= fechaActual) {//fecha>=arrayFechaActual
        var iCodigoProgramacion = $('hCodigoProgramacion').value;
        var patronModulo = 'cargarMedicosEditarCita';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + iCodigoProgramacion;
        parametros += '&p3=' + fecha;
        parametros += '&p4=' + $('servicioEditarCita').value;

        tablaMedicosEditarcita = new dhtmlXGridObject('divTablaMedicosEditarCita');
        tablaMedicosEditarcita.setImagePath("../../../../medifacil_front/imagen/icono/");
        tablaMedicosEditarcita.attachEvent("onRowSelect", function (rId, cInd) {
            generarComoTurnos(rId, cInd);
        });
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador = contadorCargador;
        tablaMedicosEditarcita.attachEvent("onXLS", function () {
            cargadorpeche(1, idCargador);
        });
        tablaMedicosEditarcita.attachEvent("onXLE", function () {
            cargadorpeche(0, idCargador);
        });
        /////////////fin cargador ///////////////////////
        tablaMedicosEditarcita.setSkin("dhx_skyblue");
        tablaMedicosEditarcita.init();
        tablaMedicosEditarcita.loadXML(pathRequestControl + '?' + parametros, function () {
            tmpc = 1;
        });
    } else {
        $('divTablaMedicosEditarCita').update('<h1 style="color:red;" >Seleccionar fecha de hoy o posterior.</h1>');
    }


}
function generarComoTurnos(rId, cInd) {
    $('divBotonGrabarEditarCita').hide();
    var cronogramaSeleccionado = tablaMedicosEditarcita.cells(rId, 0).getValue();
    $('cronogramaDestinoEditarCita').value = cronogramaSeleccionado;
    var patronModulo = 'generarComoTurnos';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + cronogramaSeleccionado;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;

            $('divTurnosEditar').update(respuesta);

        }
    })
}
function mostrarBotonGrabarCita() {
    $('divBotonGrabarEditarCita').show();
}
function grabarEditarCita() {
    var cronogramaOrigen = $('hcodigocronograma').value;
    var horaorigen = $('hHoraProgramacion').value;
    var cronogramaDestino = $('cronogramaDestinoEditarCita').value;
    var horaDestino = $('comoHoraEditarCita').value;
    var codigoProgramacion = $('hCodigoProgramacion').value;

    var patronModulo = 'grabarEditarCita';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + cronogramaOrigen;
    parametros += '&p3=' + horaorigen;
    parametros += '&p4=' + cronogramaDestino;
    parametros += '&p5=' + horaDestino;
    parametros += '&p6=' + codigoProgramacion;

    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            var array = respuesta.split("|");
            alert(array[1]);
            if (array[0] == 1) {
                var arrayFecha = $('fechaSeleccionadaEditarCita').value.split('/');
                $('hFecha').value = arrayFecha[2] + '-' + arrayFecha[1] + '-' + arrayFecha[0];


                $("hOpcionBusqueda").value = 2;
                actualizahoraycronograma(horaDestino, cronogramaDestino);
                refrescaCalendario($('hFecha').value);
                mostrarProgramacionEmergenciaInformes(cronogramaDestino);
                descripcionCita(horaDestino, cronogramaDestino, codigoProgramacion);
                Windows.close("Div_ventanaEditarcita");
            } else {
                alert(array[0]);
            }



        }
    })


}
function cancelarEditarCita() {
    Windows.close("Div_ventanaEditarcita");
}
function  restaurarOrdenesTratamientoCita() {
    var hidNroOrden = document.getElementById("hidNroOrden").value;

    var parax = "";

    parax = "p1=restaurarOrdenesTratamientoCita&p2=" + hidNroOrden;
    var datosx = traerDataPrueba(parax);


}


function eliminarCitaInformes() {
    var colorceldaseleccionada = $('hColorSeleccionado').value;
    var icodigoProgramacion = $('hCodigoProgramacion').value;
    //alert(icodigoProgramacion);
    if (icodigoProgramacion != "") {
        //window.alert(idfilaseleccionada+","+idcolumnaseleccionada);
        // pathLink = "?p1=eliminarCitaProgramada&p2=" + idcolumnaseleccionada + '&p3=' + idfilaseleccionada;
        var pathLink = "?p1=eliminarCitaAdicional&p2=" + icodigoProgramacion;
        if (confirm("¿Esta seguro de eliminar la cita?")) {
            switch (colorceldaseleccionada) {
                case "#F0F43A":
                {
                    new Ajax.Request(pathRequestControl, {
                        method: 'get',
                        parameters: pathLink,
                        onLoading: micargador(1),
                        onComplete: function (transport) {
                            micargador(0);
                            var respuesta = transport.responseText;
                            window.alert(respuesta);

                            //                                restaurarOrdenesTratamientoCita();

                            if (document.getElementById("hOpcionBusqueda").value != "") {
                                var fecha = document.getElementById("hFecha").value;
                                var opcionBusqueda = document.getElementById("hOpcionBusqueda").value;
                                var servicio = document.getElementById("hServicio").value;
                                var nombrecentrocosto = document.getElementById("hNombreCentroCosto").value;
                                var codigoPersonalSalud = document.getElementById("hCodigoPersonalSalud").value;
                                $("hOpcionSede").value = $("cb_filtroSede").value;
                                var sede = document.getElementById("hOpcionSede").value;
                                if ($('selectVista').value == '2') {
                                    listarCronogramaMedicoEmergencia($('hcodigocronograma').value);
                                } else {
                                    setCabeceraCronograma(fecha, opcionBusqueda, servicio, nombrecentrocosto, codigoPersonalSalud, sede);
                                }
                            }

                        }
                    })
                    break;
                }
                case "#F8A83E":
                {
                    window.alert("Cita NO eliminada,el estado es PAGADO");
                    break;
                }
                case "#DEEDF8":
                {
                    window.alert("Cita NO eliminada,el estado es ATENDIDO");
                    break;
                }

            }

        }
        //        idfilaseleccionada="";
        //        idcolumnaseleccionada="";
    } else {
        window.alert("Seleccione la celda");
    }

}
/******************************************************************************/
function acciondelasCitas(id, columnIndex) {
    var ventanaAdiciona = 0;
    var idfilaseleccionada = id;
    var idcolumnaseleccionada = this.getColumnId(columnIndex);
    $("hcodigocronograma").value = idcolumnaseleccionada;
    //alert("acciondelasCitas");
    var mododeejecucion = $('hMododeejecucion').value;
    if (columnIndex != 0) { //click en celda valida

        colorceldaseleccionada = this.cells(id, columnIndex).getBgColor().toUpperCase();
        $('hColorSeleccionado').value = colorceldaseleccionada;
        if (this.cells(id, columnIndex).getValue().indexOf("icono/kdmconfig1.gif") != -1) { //click en el boton adicional
            var ventanaAdiciona = 1;
            var hidcolumnaorigen = $("hcodigocronograma").value;
            var parametros = '';
            parametros += 'p1=traerDatosCronogramaProgramado';
            parametros += '&p2=' + hidcolumnaorigen;
            var datosArray = traerDataPrueba(parametros);
            if (datosArray[0].trim() == 'ok') {
                if (mododeejecucion == 0) {
                    nuevaCitaAdicional(this.getColumnId(columnIndex));
                }


            } else if (datosArray[0].trim() == 'error') {
                alert(datosArray[1].trim());
            }
        } else {
            if (this.cells(id, columnIndex).getValue().indexOf("icono/apply.png") != -1) {  //click en boton nueva cita

                if (mododeejecucion == 0) {
                    descripcionCita("", "", "");
                    nuevaCita(id, this.getColumnId(columnIndex), 0);
                } else {   //para la edicion
                    document.getElementById("hidfiladestino").value = idfilaseleccionada
                    document.getElementById("hidcolumnadestino").value = idcolumnaseleccionada
                }
            } else {
                if (this.cells(id, columnIndex).getValue().indexOf("icono/noapply.png") != -1) {
                    window.alert("No se puede reservar una cita en una hora pasada")
                } else {

                    //Revisar
                    if (this.cells(id, columnIndex).getValue() != "") {
                        if (colorceldaseleccionada == '#FFB2B2' && this.cells(id, columnIndex).getValue().indexOf("/") != -1) {
                            alert('fecha de Activacion:' + this.cells(id, columnIndex).getValue())
                        } else {
                            descripcionCita(id, this.getColumnId(columnIndex), "");
                        }

                    }


                }


            }
        }
        if (mododeejecucion == 0) {
            document.getElementById("hidfilaorigen").value = idfilaseleccionada
            document.getElementById("hidcolumnaorigen").value = idcolumnaseleccionada
        } else {
            if (this.cells(id, columnIndex).getValue().indexOf("icono/noapply.png") == -1) {
                document.getElementById("hidfiladestino").value = idfilaseleccionada
                document.getElementById("hidcolumnadestino").value = idcolumnaseleccionada
                if (colorceldaseleccionada != "#C7C7C7") { //no pasada
                    editarCitaInformes();
                } else {
                    window.alert("Celda Incorrecta!!!!");
                }

            }

        }
    }
}

function cabeceranombreMedico(index, e) {
    idCronograma = this.getColumnId(index);
    pathLink = "?p1=datosdecronograma&p2=" + idCronograma;

    if (idCronograma > 0) {
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: pathLink,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                respuesta = transport.responseText;
                //window.alert(respuesta);
                eval(respuesta);
            }
        })
    }
//    window.alert(idCronograma);
}
function setPintarCabeceraCronograma(cabecera, subcabecera, datos, tipocabecera, alineamiento, idsColumnas, anchocolumna, estadopagos) {
    datos = datos.replace(/'/gi, "\"");
    estadopagos = estadopagos.replace(/'/gi, "\"");
    datos = datos.replace(/citanueva/gi, "<img src='../../../../medifacil_front/imagen/icono/apply.png'>");
    datos = datos.replace(/citapasada/gi, "<img src='../../../../medifacil_front/imagen/icono/noapply.png'>");
    datos = datos.replace(/citaadicional/gi, "<img src='../../../../medifacil_front/imagen/icono/kdmconfig1.gif'>");

    mygrid = new dhtmlXGridObject('programacioncitas');
    mygrid.setHeader(cabecera);
    mygrid.attachHeader(subcabecera);
    mygrid.setColTypes(tipocabecera);
    mygrid.setColAlign(alineamiento);
    mygrid.setColumnIds(idsColumnas);
    mygrid.setInitWidths(anchocolumna);
    data = JSON.parse(datos);
    mygrid.splitAt(1);
    mygrid.attachEvent("onRowSelect", acciondelasCitas);
    mygrid.attachEvent("onHeaderClick", cabeceranombreMedico);
    mygrid.setImagePath("../../../../medifacil_front/imagen/icono/");
    //mygrid.setSkin("dhx_skyblue");
    mygrid.setSkin("dhx_skyblue");
    mygrid.init();
    mygrid.parse(data, "json");
    for (i = 0; i < mygrid.getRowsNum(); i++) {
        for (j = 0; j < mygrid.getColumnsNum(); j++) {
            mygrid.cells2(i, j).setBgColor('#FFFFFF');
            mygrid.setCellTextStyle(mygrid.getRowId(i), j, 'color:#000000;border: 1px solid #D3D3D3;');
        }
    }
    eval(estadopagos);
    $('divLeyendaCitasInformes').show();
    $('Div_Actividades').show();

}
function marcar_hora_actual() {
    // MARCAR LA HORA
    if (idfilaseleccionada != "" && idcolumnaseleccionada != "") {
        mygrid.selectCell(mygrid.getRowIndex(idfilaseleccionada), mygrid.getColIndexById(idcolumnaseleccionada), false, true, true, true);
    } else {
        miFecha = new Date();
        if (miFecha.getHours() < 10)
            horaactual = '0' + miFecha.getHours() + ':00';
        else
            horaactual = miFecha.getHours() + ':00';
        for (i = 0; i < mygrid.getRowsNum(); i++) {
            if (mygrid.cellByIndex(i, 0).getValue() == horaactual) {
                mygrid.selectCell(i, 0, false, true, true, true);
            }
        }
    }
}
function limpiaCargaMedicos() {
    var patronModulo = 'limpiarbuscarMedicoCitas';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta1 = transport.responseText;
            var respuesta1 = "<fieldset id=\"fielBusCronogramaMedico\" style=\"margin:5px;padding:5px;height:180px;\">"
                    + "<legend style=\"text-align:center; font-family:Verdana, Arial, Helvetica, sans-serif;font-size:10px;font-weight:bold;\">Buscar M&eacute;dico</legend>"
                    + respuesta1 + "</fieldset>"
            if ($('divBusCronogramaMedico')) {
                $('divBusCronogramaMedico').update(respuesta1);
            }


        }
    })

}

function getActosMedicos(c_cod_per, funcionActoMedico) {
    document.getElementById("hcCodigoActoMedico").value = "SAM";
    var patronModulo = 'obtenerActosMedicos'
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + c_cod_per;
    parametros += '&p3=' + funcionActoMedico;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('divActosMedicos').update(respuesta);
            //funcion+="('"+parametro+"','','"+nro+"')";
            //eval(funcion);


        }
    })
}

function getCodigoActomedico(elemet, event, nroActoMedico) {
    document.getElementById("hcCodigoActoMedico").value = nroActoMedico;
// document.getElementById("radioActoMedico").checked=false;

//document.getElementById("radioActoMedico").[1].check=true;


}
/*******************************************************************************/
function filtro_sede() {
    opcionBusqueda = document.getElementById("hOpcionBusqueda").value;
    document.getElementById('hOpcionSede').value = document.getElementById('cb_filtroSede').value;
    sede = document.getElementById('hOpcionSede').value;
    if (opcionBusqueda != "") {
        limpiarDescripcionCita();
        guardadoexitoso = 0;
        $('divDatosMedicoInformes').hide();
        var vista = $('selectVista').value;
        switch (vista) {
            case '1':  //tripo matriz
            {
                $('btnProximaCIta').show();
                $('btnNuevoEmergencia').hide();
                regresaracronogramacitas();
                $('programacioncitas').style.display = 'block';
                $('programacioncitasEmergencia').style.display = "none";
                $('btnNuevoEmergencia').hide();
                break;
            }
            case '2': //tipo detalle
            {
                mostrarProgramacionEmergenciaInformes(0);
                break;
            }

        }
    }
}

function cambiarEstadoConfirmacionCita() {
    if ((idfilaseleccionada != "" && idcolumnaseleccionada != "") || $('hCodigoProgramacion').value != '') {
        //window.alert(idfilaseleccionada+","+idcolumnaseleccionada);
        pathLink = "?p1=cambiarEstadoConfirmacionCita&p2=" + idcolumnaseleccionada + '&p3=' + idfilaseleccionada + '&p4=' + $('hCodigoProgramacion').value;
        if (confirm("¿Esta seguro de cambiar el estado de la cita?")) {
            switch (colorceldaseleccionada) {
                case "#DEEDF8":
                {
                    window.alert("La Cita ya fue ATENDIDA");
                    break;
                }
                default:
                {
                    new Ajax.Request(pathRequestControl, {
                        method: 'get',
                        parameters: pathLink,
                        onLoading: micargador(1),
                        onComplete: function (transport) {
                            micargador(0);
                            respuesta = transport.responseText;
                            pos1 = respuesta.indexOf("/*");
                            pos2 = respuesta.indexOf("*/");
                            if (pos1 != -1 && pos2 != -1) {
                                window.alert(respuesta.substring(pos1 + 2, pos2));
                            } else {
                                if (pos1 == -1 && pos2 == -1) {
                                    window.alert(respuesta);
                                }
                            }

                            if (document.getElementById("hOpcionBusqueda").value != "") {
                                var fecha = document.getElementById("hFecha").value;
                                var opcionBusqueda = document.getElementById("hOpcionBusqueda").value;
                                var servicio = document.getElementById("hServicio").value;
                                var nombrecentrocosto = document.getElementById("hNombreCentroCosto").value;
                                var codigoPersonalSalud = document.getElementById("hCodigoPersonalSalud").value;
                                $("hOpcionSede").value = $("cb_filtroSede").value;
                                sede = document.getElementById("hOpcionSede").value;

                            }
                            if ($('selectVista').value == '2') {
                                listarCronogramaMedicoEmergencia($('hcodigocronograma').value);

                            } else {
                                setCabeceraCronograma(fecha, opcionBusqueda, servicio, nombrecentrocosto, codigoPersonalSalud, sede);
                            }
                            $('hCodigoProgramacion').value = '';


                        }

                    })

                    break;
                }

            }
        }
        idfilaseleccionada = '';
        idcolumnaseleccionada = '';

    } else {
        window.alert("Seleccione la celda");
    }

}

function cancelaredicioncitas() {
    //mododeejecucion = 0;
    $('hMododeejecucion').value = 0;
    $('Div_edicioncita').hide();
    $("hidfilaorigen").value = "";
    $("hidcolumnaorigen").value = "";
    $("hidfiladestino").value = "";
    $("hidcolumnadestino").value = "";
    $("hCodigoProgramacion").value = "";
}

function actualizahoraycronograma(hora, cronograma) {
    idfilaseleccionada = hora;
    idcolumnaseleccionada = cronograma;
}

function mostrarFormRegistrarTriaje() {

    if (idfilaseleccionada != "" && idcolumnaseleccionada != "") {
        //alert('Fila: '+idfilaseleccionada+' Columna: '+idcolumnaseleccionada);
        var codigoProgramacion = trimJunny($('hCodigoProgramacion').value);
        var datos = idfilaseleccionada + '|' + idcolumnaseleccionada + '|' + codigoProgramacion;

        datos = Base64.encode(datos);

        CargarVentana('popupRegistroTriaje', 'Triaje', '../cita/manteTriaje.php?accion=insertar' + '&datos=' + datos, '300', '230', false, true, '', 1, '', 10, 10, 10, 10);
    }
    else {
        alert('Seleccione una celda');
    }
}

function manteTriaje(accion, horaProgramacion, codCronograma) {
    var peso = trim($('txtPeso').value);
    var talla = trim($('txtTalla').value);
    var temp = trim($('txtTemp').value);
    var frecCardiaca = trim($('txtFrecCardiaca').value);
    var presArterial = trim($('txtPresArterial').value);
    var frecRespiratoria = trim($('txtFrecRespiratoria').value);
    var satOxigeno = trim($('txtSatOxigeno').value);
    var codigoProgramacion = trimJunny($('hCodigoProgramacion').value);

    if (peso == '' && talla == '' && temp == '' && frecCardiaca == '' && presArterial == '' && frecRespiratoria == '' && satOxigeno == '') {
        alert('Debe ingresar como m\xEDnimo uno de los campos para registrar triaje');
    }
    else {
        if ($('unidadTalla').value == 2) {
            //De centimetros convertimos a metros
            talla = parseFloat(talla) / 100;
            talla = talla.toFixed(2);
        }

        var datos = codigoProgramacion + "|" + peso + "|" + talla + "|" + temp + "|" + frecCardiaca + "|" + presArterial + "|" + frecRespiratoria + "|" + satOxigeno;
        //alert(datos);
        datos = datos.replace(/'/gi, "\'\'");
        datos = Base64.encode(datos);

        var data = 'p1=manteTriaje&datos=' + datos + '&accion=' + accion;
        new Ajax.Request(pathRequestControl,
                {
                    method: 'post',
                    parameters: data,
                    onLoading: function (transport) {
                        micargador(1);
                    },
                    onComplete: function (transport) {
                        micargador(0);
                        alert(transport.responseText);
                        Windows.close("Div_popupRegistroTriaje");
                    }
                }
        )
    }
}
function CambiarEstadoNoAtendidoAdicional(vEstado, programacion) {
    var Codigo = programacion.split('|');
    codigoProgramacion = Codigo[0];
    if (codigoProgramacion == '') {
        window.alert("Por favor seleccione la programación de un paciente!!");
        return;
    }
    switch (vEstado) {
        case 'RESERVADO':
        {
            window.alert("Esta Cita no esta atendida,el estado es RESERVADO");
            break;
        }
        case "PAGADO":
        {
            if (confirm("Esta seguro de Desconfirmar la cita?")) {
                var patronModulo = 'desconfirmarCita';
                var parametros = '';
                parametros += 'p1=' + patronModulo;
                parametros += '&p2=' + $('hCodigoProgramacion').value;
                new Ajax.Request(pathRequestControl, {
                    method: 'get',
                    asynchronous: false,
                    parameters: parametros,
                    onLoading: micargador(1),
                    onComplete: function (transport) {
                        micargador(0);
                        respuesta = transport.responseText;
                        window.alert(respuesta);
                        regresaracronogramacitas();
                    }
                })
            }
            ;


            break;
        }
        case "ATENDIDO":
        {
            if (confirm('\xBFDesea Cambiar el estado de la Cita a NO ATENDIDO?')) {
                var patronModulo = 'cambiarEstadoNoAtendido';
                var parametros = '';
                parametros += 'p1=' + patronModulo;
                parametros += '&p2=' + codigoProgramacion;

                new Ajax.Request(pathRequestControl, {
                    method: 'get',
                    asynchronous: false,
                    parameters: parametros,
                    onLoading: micargador(1),
                    onComplete: function (transport) {
                        micargador(0);
                        respuesta = transport.responseText;
                        window.alert(respuesta);
                        regresaracronogramacitas();
                    }
                })
            }
            break;
        }
    }
}
function CambiarEstadoNoAtendido() {
    codigoProgramacion = $('hCodigoProgramacion').value;
    if (codigoProgramacion ==='') {
        window.alert("Por favor seleccione la programación de un paciente!!");
        return;
    }
    switch (colorceldaseleccionada) {
        case '#F0F43A':
        {
            window.alert("Esta Cita no esta atendida,el estado es RESERVADO");
            break;
        }
        case "#F8A83E":
        {
            if (confirm("Esta seguro de Desconfirmar la cita?")) {
                var patronModulo = 'desconfirmarCita';
                var parametros = '';
                parametros += 'p1=' + patronModulo;
                parametros += '&p2=' + codigoProgramacion;

                new Ajax.Request(pathRequestControl, {
                    method: 'get',
                    asynchronous: false,
                    parameters: parametros,
                    onLoading: micargador(1),
                    onComplete: function (transport) {
                        micargador(0);
                        respuesta = transport.responseText;
                        window.alert(respuesta);
                        regresaracronogramacitas();
                    }
                });
            }
            ;


            break;
        }
        case "#DEEDF8":
        {
            if (confirm('\xBFDesea Cambiar el estado de la Cita a NO ATENDIDO?')) {
                var patronModulo = 'cambiarEstadoNoAtendido';
                var parametros = '';
                parametros += 'p1=' + patronModulo;
                parametros += '&p2=' + codigoProgramacion;

                new Ajax.Request(pathRequestControl, {
                    method: 'get',
                    asynchronous: false,
                    parameters: parametros,
                    onLoading: micargador(1),
                    onComplete: function (transport) {
                        micargador(0);
                        respuesta = transport.responseText;
                        window.alert(respuesta);
                        regresaracronogramacitas();
                    }
                });
            }
            break;
        }
    }
}

function anularPago() {
    var codigoProgramacion = $('hCodigoProgramacion').value;
    if (codigoProgramacion === '') {
        window.alert("Por favor seleccione la programación de un paciente!!");
        return;
    }

    switch (colorceldaseleccionada) {
        case "#F8A83E":
        {
            if (confirm('¿Desea anular el Pago realizado?')) {
                var patronModulo = 'anularPago';
                var parametros = '';
                parametros += 'p1=' + patronModulo;
                parametros += '&p2=' + codigoProgramacion;

                new Ajax.Request(pathRequestControl, {
                    method: 'get',
                    asynchronous: false,
                    parameters: parametros,
                    onLoading: micargador(1),
                    onComplete: function (transport) {
                        micargador(0);
                        var respuesta = transport.responseText;
                        window.alert(respuesta);
                        regresaracronogramacitas();
                    }
                });
            }
            break;
        }
    }

}

function buscarSiguienteFecha() {
    var cantidad = $('buscarOtro').value;
    var hNombreCentroCosto = $('hNombreCentroCosto').value;
    var fecha = $('hFecha').value;
    var fechaArray = fecha;
    var Array = fechaArray.split("-");
    var bit = 0;
    var dias = 0;
    var mes = 0;
    var diaRep = "";
    if ((Array[0] % 4 == 0) && ((Array[0] % 100 != 0) || (Array[0] % 400 == 0))) {
        bit = 1;
    } else {
        bit = 0;
    }
    switch (Array[1]) {
        case "01" :
            dias = 31;
            mes = 1;
            break;
        case "02" :
            if ((Array[0] % 4 == 0) && ((Array[0] % 100 != 0) || (Array[0] % 400 == 0))) {
                dias = 29;
            } else {
                dias = 28;
            }
            mes = 2;
            break;
        case "03" :
            dias = 31;
            mes = 3;
            break;
        case "04" :
            dias = 30;
            mes = 4;
            break;
        case "05" :
            dias = 31;
            mes = 5;
            break;
        case "06" :
            dias = 30;
            mes = 6;
            break;
        case "07" :
            dias = 31;
            mes = 7;
            break;
        case "08" :
            dias = 31;
            mes = 8;
            break;
        case "09" :
            dias = 30;
            mes = 9;
            break;
        case "10" :
            dias = 31;
            mes = 10;
            break;
        case "11" :
            dias = 30;
            mes = 11;
            break;
        case "12" :
            dias = 31;
            mes = 12;
            break;
    }
    var diaFinal = "";
    var mesFinal = "";
    var anio = parseInt(Array[0]);
    for (var x = parseInt(Array[2]); x <= dias; x++) {
        if ($('buscarOtro').value == 0) {
            var sede = $('hOpcionSede').value;
            var opcionBusqueda = $('hOpcionBusqueda').value;
            var personal = $('hCodigoPersonalSalud').value;
            var servicio = $('hServicio').value;
            if (x <= 9) {
                diaFinal = "0" + x;
                mesFinal = "0" + mes
            } else {
                diaFinal = x;
                mesFinal = mes
            }
            var fechaFinal = anio + "-" + mesFinal + "-" + diaFinal;
            var patronModulo = 'buscarSiguienteFecha';
            var parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + fechaFinal;
            parametros += '&p3=' + sede;
            parametros += '&p4=' + opcionBusqueda;
            parametros += '&p5=' + personal;
            parametros += '&p6=' + servicio;
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                asynchronous: false,
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function (transport) {
                    micargador(0);
                    var respuesta = transport.responseText;
                    var str = respuesta;
                    var n = str.split("/");
                    //alert(n[1] + " " + fechaFinal);
                    if (n[1] > 0) {
                        x = dias;
                        $('buscarOtro').value = 1;
                        alert("Se encontro " + n[1] + " Cupo Disponibles en la Busqueda Seleccionada de la Fecha " + fechaFinal);
                        setCabeceraCronograma1(fechaFinal, opcionBusqueda, servicio, hNombreCentroCosto, personal, sede);
                        seleccionarFechaCitasInformes('cal01-' + diaFinal, 'cal01')
                        $('fechaDes').value = 0;
                    }
                    else if (n[0] == -1) {
                        alert("No hay Programacion Disponible....");
                        x = dias;
                        $('fechaDes').value = 10;
                    }

                }
            })

        }
        else {
            // x = dias;
        }
    }
    if ($('buscarOtro').value != 1) {
        if ($('fechaDes').value == 10) {

        } else {
            // seleccionarFechaCitasInformes('cal01-01','cal01')
            accionCalendarioCitas('3', 'cal01');
        }
    }
    $('buscarOtro').value = 0;
}

function accionCalendarioCitas(idAccion, cal) {
    idfilaseleccionada = "";
    idcolumnaseleccionada = "";
    arrayInput = document.getElementById(cal).getElementsByTagName("input");
    fechaActual = arrayInput[6].value + arrayInput[5].value + arrayInput[4].value;
    document.getElementById("hFecha").value = fechaActual;
    pathLink = "p1=calendario01&p2=" + fechaActual + "&p3=" + idAccion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText.split("|");
            fechaActual = respuesta[1];
            document.getElementById("hFecha").value = fechaActual;
            $('divBusCronograma').update(respuesta[0]);
            if (document.getElementById("hOpcionBusqueda").value != "") {
                seleccionactividad();
                $('divDatosMedicoInformes').hide();
                var vista = $('selectVista').value;
                switch (vista) {
                    case '1':  //tripo matriz
                    {
                        $('btnProximaCIta').show();
                        $('btnNuevoEmergencia').hide();
                        regresaracronogramacitas();
                        $('programacioncitas').style.display = 'block';
                        $('programacioncitasEmergencia').style.display = "none";
                        $('btnNuevoEmergencia').hide();
                        break;
                    }
                    case '2': //tipo detalle
                    {
                        mostrarProgramacionEmergenciaInformes(0);
                        break;
                    }

                }

            }
            seleccionarFechaCitasInformes('cal01-01', 'cal01')
            buscarSiguienteFecha();
        }
    })
}


function buscarProximaCita() {

    var fecha = $('hFecha').value;
    var fechaACtual = $('FechaActual').value;
    //alert(fecha);
    //alert(fechaACtual);
    if (fechaACtual <= fecha) {

        var sede = $('hOpcionSede').value;
        var opcionBusqueda = $('hOpcionBusqueda').value;
        var personal = $('hCodigoPersonalSalud').value;
        var servicio = $('hServicio').value;
        var str = servicio;
        var n = str.split("|");
        var nombreSede = "";
        switch (sede) {
            case '0000001464' :
            {
                nombreSede = "PROLIMA";
                break;
            }
            case '0000000002' :
            {
                nombreSede = "VILLASOL";
                break;
            }
            case '0000000003' :
            {
                nombreSede = "TREBOL";
                break;
            }
            case '0000000001' :
            {
                nombreSede = "HMLO";
                break;
            }
        }
        var patronModulo = 'buscarProximaCita';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + fecha;
        parametros += '&p3=' + sede;
        parametros += '&p4=' + opcionBusqueda;
        parametros += '&p5=' + personal;
        parametros += '&p6=' + n[0];
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false,
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                var respuesta = transport.responseText;
                var rst = respuesta;
                //alert(respuesta);
                var r = rst.split("/");
                var contador = r.length - 1;
                var msg = 0;
                if (contador == 0) {
                    alert("A partir de la fecha " + fecha + " no hay programacion disponible en la especialidad " + n[1] + " en la sede " + nombreSede);
                } else {
                    //alert(fecha);
                    var dfechaT = fecha;
                    //var datetime = dfechaT.split("-");
                    //alert(dfechaT);
                    //alert('peche');
                    for (var x = $('buscarOtro').value; x <= contador - 1; x++) {
                        //  busquedaXfechaProgramada(r[x],sede,opcionBusqueda,personal,n[0],n[1]);
                        var patronModulo1 = 'buscarSiguienteFecha';
                        var parametros = '';
                        var a = false;
                        parametros += 'p1=' + patronModulo1;
                        parametros += '&p2=' + r[x];
                        parametros += '&p3=' + sede;
                        parametros += '&p4=' + opcionBusqueda;
                        parametros += '&p5=' + personal;
                        parametros += '&p6=' + n[0];
                        //alert(r[x]);
                        new Ajax.Request(pathRequestControl, {
                            method: 'get',
                            asynchronous: false,
                            parameters: parametros,
                            onLoading: micargador(1),
                            onComplete: function (transport) {
                                micargador(0);
                                var respuesta1 = transport.responseText;
                                var str = respuesta1;
                                //alert(respuesta1);
                                var f = str.split("/");
                                if (f[0] == 1) {
                                    // alert(r[x]);
                                    //alert(f[1]);
                                    //alert('angel');
                                    AbrirPopadMensaje(f[1], r[x]);
                                    refrescaCalendario(r[x]);
                                    // $('mensajeEnlaBotella').update("<p style='font-size:14px;font-family:verdana;'>Se encontro <b>" +f[1]+ " </b> cupo(s) disponibles en la busqueda seleccionada de la Fecha <b> " + r[x]+"</b>");
                                    //$('objId').show();
                                    //                                var dfecha=r[x];
                                    //                                var date=dfecha.split("-");
                                    //                                if (parseInt(date[1])!=parseInt(datetime[1])){
                                    //                                    // seleccionarFechaCitasInformes('cal01-'+date[2],'cal01')
                                    //                                    //  alert(parseInt(datetime[1]) + " - " + parseInt(date[1]));
                                    //                                    var y=0;
                                    //                                    var text ="";
                                    //                                    for (y=parseInt(datetime[1]);y<=(parseInt(date[1])-1);y++){
                                    //                                        alert("Pasando al mes siguiente mes");
                                    //                                        seleccionarFechaCitasInformes('cal01-'+date[2],'cal01');
                                    //                                        accionCalendarioCitasInformes('3','cal01');
                                    //                                    // seleccionarFechaCitasInformes('cal01-'+date[2],'cal01')
                                    //                                    }
                                    //                                //  $('numerito').value=0;
                                    //                                }   
                                    //                                else {
                                    //                                    seleccionarFechaCitasInformes('cal01-'+date[2],'cal01')   
                                    //                                    
                                    //                                }
                                    $('buscarOtro').value = 1;
                                    x = contador - 1;
                                    msg = 1;

                                }
                                else {
                                    msg = 0;
                                    $('buscarOtro').value = 0;
                                }
                            }
                        })
                    }
                    if (msg == 0) {
                        alert("No hay cupos disponibles");
                    }
                }

            }
        })
    }
    else {
        alert("Seleccione fecha actual...");
    }
}


function aceptarBusqueda() {
    var fecha = $('fechaEncontrada').value;
    var sede = $('hOpcionSede').value;
    var opcionBusqueda = $('hOpcionBusqueda').value;
    var personal = $('hCodigoPersonalSalud').value;
    var servicioCon = $('hServicio').value;
    var str = servicioCon;
    var n = str.split("|");
    $('buscarOtro').value = 0;
    Windows.close("Div_AbrirPopadMensaje");

    setCabeceraCronograma(fecha, opcionBusqueda, n[0], n[1], personal, sede)
}


function AbrirPopadMensaje(num, fecha) {
    // $('buscarOtro').value=0;
    //Windows.close("Div_AbrirPopadMensaje", event);
    if ($('Div_AbrirPopadMensaje') != null) {
        cargarMensaje(num, fecha);
        // alert('existe');
    } else {
        var posFuncion = "cargarMensaje(" + num + ",'" + fecha + "')";
        //alert(posFuncion);
        var vtitle = '';
        var vformname = 'AbrirPopadMensaje';
        var vwidth = '700';
        var vheight = '70';
        var patronModulo = 'AbrirPopadMensaje';
        var vcenter = 't';
        var vresizable = '';
        var vmodal = 'false';
        var vstyle = '';
        var vopacity = '';
        var veffect = '';
        var vposx1 = '';
        var vposx2 = '';
        var vposy1 = '';
        var vposy2 = '';
        var parametros = '';
        parametros += 'p1=' + patronModulo;

        CargarVentanaPopPapJorge(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
        //alert('no existe');
    }

}


function cargarMensaje(num, fecha) {

    //alert("mensaje");
    // alert(num);
    // alert(fecha);
    var f = fecha.split("-");
    $('mensajeEnlaBotella').update("<p style='font-size:12px;font-family:verdana;'>Se encontro <b>" + num + " </b> cupo(s) disponibles  de la Fecha <b> " + f[2] + "-" + f[1] + "-" + f[0] + "</b> - (dd-mm-aaaa)<br>");
    $('buscarOtro').value = 0;
    $('fechaEncontrada').value = fecha;
}

function listarCronogramaMedicoEmergencia(iCodigoCronograma) {
    $("hCadenaCodigoProgramacion").value = '';
    $("hCadenaCodigoProgramacionNombre").value = '';
    if ($('btnEvioMedico')) {
        $('btnEvioMedico').hide();
    }

    $('hcodigocronograma').value = iCodigoCronograma;
    $('divAccionesyBotones').show();
    $('divAcciones').hide();
    $('botoneraAngel').show();
    var patronModulo = 'listarCronogramaMedicoEmergencia'
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iCodigoCronograma;

    cargaEmpleadosProgramacionMedicosxCC = new dhtmlXGridObject('contenedorTablaCronogramaPacientes');
    cargaEmpleadosProgramacionMedicosxCC.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    //    cargaEmpleadosProgramacionMedicosxCC.setSkin("dhx_skyblue");
    cargaEmpleadosProgramacionMedicosxCC.setSkin("dhx_terrace");
    cargaEmpleadosProgramacionMedicosxCC.enableRowsHover(true, 'grid_hover');
    //        var filtroExamenesLab = "<input type='text' id='idFiltroExamenLab' style='border:1px solid #CECECE; border-radius:5px;height:20px;width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarPersonaImagen();\" />"; # master_checkbox 
    var filtroExamenesLab = '<input id="CkeckMuestraTotal" onclick= "if(this.checked){this.value=1}else{this.value=0;};seleccionarTodo()" type="checkbox" title="Asignar" name="CkeckMuestra" value="0">'
    var header = ["#numeric_filter", "#text_filter", "#text_filter", "#text_filter", "#text_filter", "#text_filter", "#text_filter", "#text_filter", "#text_filter", "#text_filter", "#text_filter", "#text_filter", "#text_filter", "#text_filter", "#text_filter", "#text_filter", "#text_filter", "#text_filter", "#text_filter", "#text_filter", "#text_filter", filtroExamenesLab];
    cargaEmpleadosProgramacionMedicosxCC.attachHeader(header);
    cargaEmpleadosProgramacionMedicosxCC.enableRowsHover(true, 'grid_hover');
    cargaEmpleadosProgramacionMedicosxCC.attachEvent("onRowSelect", function (rowId, cellInd) {
        if (cellInd != 5 && cellInd != 21 && cellInd != 22) {
            var codigoHora = cargaEmpleadosProgramacionMedicosxCC.cells(rowId, 1).getValue();
            var codigoCronograma = cargaEmpleadosProgramacionMedicosxCC.cells(rowId, 17).getValue();
            var codigoProgramacion = cargaEmpleadosProgramacionMedicosxCC.cells(rowId, 16).getValue();
            var vEstadoAtencion = cargaEmpleadosProgramacionMedicosxCC.cells(rowId, 19).getValue();
            var vTipoCita = cargaEmpleadosProgramacionMedicosxCC.cells(rowId, 11).getValue();
            //        alert(codigoProgramacion);
            $('hEstadoAtencion').value = vEstadoAtencion;
            $('hCodigoProgramacion').value = codigoProgramacion;
            descripcionCita(codigoHora, codigoCronograma, codigoProgramacion);
            $('divAccionesyBotones').show();
            $('divAcciones').hide();
            $('hHoraProgramacion').value = codigoHora
            $('hcodigocronograma').value = codigoCronograma;

            $('hTipoCita').value = vTipoCita;
            if ($('hEstadoAtencion').value == 'ATENDIDO') {
                colorceldaseleccionada = "#DEEDF8";
                $('hColorSeleccionado').value = "#DEEDF8";
                idfilaseleccionada = $('hHoraProgramacion').value
            }
            if ($('hEstadoAtencion').value == 'RESERVADO') {
                colorceldaseleccionada = "#F0F43A";
                $('hColorSeleccionado').value = "#F0F43A";
                idfilaseleccionada = $('hHoraProgramacion').value
            }
            if ($('hEstadoAtencion').value == 'PAGADO') {
                colorceldaseleccionada = "#F8A83E";
                $('hColorSeleccionado').value = "#F8A83E";
                idfilaseleccionada = $('hHoraProgramacion').value
            }
            idcolumnaseleccionada = codigoCronograma;
        }

    });
    contadorCargador++;
    var idCargador = contadorCargador;
    cargaEmpleadosProgramacionMedicosxCC.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    cargaEmpleadosProgramacionMedicosxCC.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    cargaEmpleadosProgramacionMedicosxCC.enableMultiline(true);
    cargaEmpleadosProgramacionMedicosxCC.setSkin("dhx_skyblue");
    cargaEmpleadosProgramacionMedicosxCC.init();
    cargaEmpleadosProgramacionMedicosxCC.loadXML(pathRequestControl + '?' + parametros, function () {
        for (var i = 0; i < cargaEmpleadosProgramacionMedicosxCC.getRowsNum(); i++) {
            var vUbicacion = cargaEmpleadosProgramacionMedicosxCC.cells(i, 18).getValue();
            var bEstado = cargaEmpleadosProgramacionMedicosxCC.cells(i, 19).getValue();


            if (bEstado == 'ATENDIDO') {
                cargaEmpleadosProgramacionMedicosxCC.setRowColor(cargaEmpleadosProgramacionMedicosxCC.getRowId(i), "#DEEDF8");
                cargaEmpleadosProgramacionMedicosxCC.cells(i, 21).setValue('<input id="CkeckMuestra' + i + '" onclick= "if(this.checked){this.value=1}else{this.value=0;};seleccionandoNumeroDePlaca(' + i + ')" type="checkbox" title="Asignar" name="CkeckMuestra" value="0">');
            }
            if (bEstado == 'RESERVADO') {
                cargaEmpleadosProgramacionMedicosxCC.setRowColor(cargaEmpleadosProgramacionMedicosxCC.getRowId(i), "#F0F43A");

            }
            if (bEstado == 'PAGADO') {
                cargaEmpleadosProgramacionMedicosxCC.setRowColor(cargaEmpleadosProgramacionMedicosxCC.getRowId(i), "#F8A83E");
                /// jorge               
                cargaEmpleadosProgramacionMedicosxCC.cells(i, 21).setValue('<input id="CkeckMuestra' + i + '" onclick= "if(this.checked){this.value=1}else{this.value=0;};seleccionandoNumeroDePlaca(' + i + ')" type="checkbox" title="Asignar" name="CkeckMuestra" value="0">');
            }
            if (bEstado == 'BLOQUEADO') {
                cargaEmpleadosProgramacionMedicosxCC.setRowColor(cargaEmpleadosProgramacionMedicosxCC.getRowId(i), "#FFB2B2");
            }
            for (j = 0; j < cargaEmpleadosProgramacionMedicosxCC.getColumnsNum(); j++) {
                cargaEmpleadosProgramacionMedicosxCC.setCellTextStyle(cargaEmpleadosProgramacionMedicosxCC.getRowId(i), j, 'color:#000000;border-top:1px solid #5D5D5D;');
                switch (vUbicacion)
                {
                    case 'Archivos RX':
                        cargaEmpleadosProgramacionMedicosxCC.setCellTextStyle(cargaEmpleadosProgramacionMedicosxCC.getRowId(i), 17, 'color:#000;font-weight:bold;border-top:1px solid #5D5D5D;background-color: #FAD160;');
                        break;
                    case 'Medico':
                        cargaEmpleadosProgramacionMedicosxCC.setCellTextStyle(cargaEmpleadosProgramacionMedicosxCC.getRowId(i), 17, 'color:#000;font-weight:bold;border-top:1px solid #5D5D5D;background-color:#4285F4;');
                        break;
                    case 'Prestamo Paciente':
                        cargaEmpleadosProgramacionMedicosxCC.setCellTextStyle(cargaEmpleadosProgramacionMedicosxCC.getRowId(i), 17, 'color:#000;font-weight:bold;border-top:1px solid #5D5D5D;background-color: #E56069;');
                        break;
                    case 'Archivo 5to piso':
                        cargaEmpleadosProgramacionMedicosxCC.setCellTextStyle(cargaEmpleadosProgramacionMedicosxCC.getRowId(i), 17, 'color:#000;font-weight:bold;border-top:1px solid #5D5D5D;background-color: #616D79;');
                        break;
                    case 'Repetir':
                        cargaEmpleadosProgramacionMedicosxCC.setCellTextStyle(cargaEmpleadosProgramacionMedicosxCC.getRowId(i), 17, 'color:#000;font-weight:bold;border-top:1px solid #5D5D5D;background-color:#CF66D1;');
                        break;
                    case 'Entregado':
                        cargaEmpleadosProgramacionMedicosxCC.setCellTextStyle(cargaEmpleadosProgramacionMedicosxCC.getRowId(i), 17, 'color:#000;font-weight:bold;border-top:1px solid #5D5D5D;background-color:#C8C8C8;');
                        break;
                    default:
                        cargaEmpleadosProgramacionMedicosxCC.setCellTextStyle(cargaEmpleadosProgramacionMedicosxCC.getRowId(i), 17, 'color:#000;border-top:1px solid #5D5D5D;');
                        break;
                }
            }
        }


    });
    cargaEmpleadosProgramacionMedicosxCC.attachEvent("onEditCell", function (stage, rId, cInd, nValue, oValue) {
        if (stage == 2 && cInd == 5) {
            var codigoProgramacion = cargaEmpleadosProgramacionMedicosxCC.cells(rId, 16).getValue();
            //alert(codigoProgramacion);
            updateUbicacionCita(nValue, iCodigoCronograma, codigoProgramacion);
        }
    });
}

function updateUbicacionCita(nValue, iCodigoCronograma, iCodigoProgramacion) {
    var patronModulo = 'updateUbicacionCita';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + nValue;
    parametros += '&p3=' + iCodigoProgramacion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            listarCronogramaMedicoEmergencia(iCodigoCronograma);
        }
    })
}


function ocultarVistas(version) {
    if (version == 1) {
        $('btnProximaCIta').hide();
        document.links['btnEditarCita'].href = "javascript:validaredicionCitaInformes('1')";
        $('programacioncitasEmergencia').style.display = 'block';
        $('programacioncitas').style.display = 'none';
        $('programacioncitas').update('');
        $('programacioncitasEmergencia').style.height = "500px";
    } else {
        regresaracronogramacitas();
        $('programacioncitas').style.display = 'block';
        $('programacioncitas').style.height = "500px";
        $('programacioncitasEmergencia').style.display = "none";
        $('btnProximaCIta').show();
        document.links['btnEditarCita'].href = "javascript:validaredicionCitaInformes('0')";


    }
}

function nuevacitaEmergenecia() {
    //alert($('hcodigocronograma').value);
    if ($('hcodigocronograma').value == '' || $('hcodigocronograma').value == 0) {
        alert('Seleccione Programación');
    } else {
        nuevaCita('', $('hcodigocronograma').value, 0);
    }


}


function seleccionarTurnoPRogramacion(valor) {
    //alert($('rbtnconsulta').value);
    $('hcHoraProgramada').value = valor;
    if (valor == '---') {
        $('div_TipoProgramacion').update('Adicional');
        $('htipoProgramacion').value = 2;
    } else {
        $('div_TipoProgramacion').update('Programada');
        $('htipoProgramacion').value = 0;
    }
}
function ubicacionImagenes() {
    var iCodigoProgramacion = $('hCodigoProgramacion').value;
    if (iCodigoProgramacion == '') {
        alert('Seleccione a un paciente');
    } else {
        //alert('continuar...');
        var vformname = 'ventanaUbicacionImagenes';
        var vtitle = 'Ubicación de la Imagen';
        var vwidth = '680';
        var vheight = '420';
        var vcenter = 't';
        var vresizable = '';
        var vmodal = 'false';
        var vstyle = '';
        var vopacity = '';

        var vposx1 = '';
        var vposx2 = '';
        var vposy1 = '';
        var vposy2 = '';

        var patronModulo = 'ventanaUbicacionImagenes';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + iCodigoProgramacion;
        var posFuncion = '';

        CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
    }
}

function guardarNroPlaca() {
    if (confirm('Seguro de Grabar?')) {
        $('botonEditarPlaca').show();
        $('botonGrabarPlaca').hide();
        $('botonCancelarGrabarPlaca').hide();

        var numeroPlaca = $('inputNroPlaca').value;
        var Observacion = $('textAreaObservacion').value;
        var iCodigoProgramacion = $('hCodigoProgramacion').value;
        //        alert(iCodigoProgramacion);
        if (numeroPlaca == '') {
            alert('ingresar numero de placa');
        } else {
            /////////////
            var patronModulo = 'mantenimientoNumeroPlaca';
            var parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + trimJunny(iCodigoProgramacion);
            parametros += '&p3=' + trimJunny(numeroPlaca);
            parametros += '&p4=' + trimJunny(Observacion);
            var respuesta = '';
            contadorCargador++;
            var idCargador = contadorCargador;
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                asynchronous: false,
                onLoading: cargadorpeche(1, idCargador),
                onComplete: function (transport) {
                    cargadorpeche(0, idCargador);
                    respuesta = transport.responseText;
                    recargarVentanaImagenes();
                    listarCronogramaMedicoEmergencia($('hcodigocronograma').value);
                }
            })

        }
    }


}
function editarNumeroPlaca() {
    $('botonGrabarPlaca').show();
    $('botonCancelarGrabarPlaca').show();
    $('botonEditarPlaca').hide();
    $('inputNroPlaca').readOnly = false;
    $('textAreaObservacion').enable();

}
function cancelarGuardarNroPlaca() {
    $('botonEditarPlaca').show();
    $('botonGrabarPlaca').hide();
    $('botonCancelarGrabarPlaca').hide();
    recargarVentanaImagenes();

}
function recargarVentanaImagenes() {
    var iCodigoProgramacion = $('hCodigoProgramacion').value;
    var patronModulo = 'ventanaUbicacionImagenes';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + trimJunny(iCodigoProgramacion);
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        asynchronous: false,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Frm_ventanaUbicacionImagenes').update(respuesta);
        }
    })

}

function grabarUbicacionImagenes() {
    if (confirm('¿Seguro de Grabar?')) {
        var ubicacion = $('comboUbicaciones').value;
        var observaciones = $('textAreaObservacionUbicacion').value;
        var iCodigoProgramacion = $('hCodigoProgramacion').value;
        var patronModulo = 'grabarUbicacionImagenes';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + trimJunny(iCodigoProgramacion);
        parametros += '&p3=' + trimJunny(ubicacion);
        parametros += '&p4=' + trimJunny(observaciones);

        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            asynchronous: false,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function (transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                recargarVentanaImagenes();
                listarCronogramaMedicoEmergencia($('hcodigocronograma').value);
            }
        });
    }

}

function imprimirUbicacion(idImagen) {
    var cadena = $("hidDatosCita").value;
    //var iCodigoProgramacion=$('hCodigoProgramacion').value;
    //alert(cadena);
    //window.alert(cadena);
    var ordenCita = $("hidNroOrden").value;
    var arraydatos = ordenCita + "|" + cadena;
    var idReporte = 11;
    var modo = 1; // modo de impresion de reporte --> (1=>label y datos, 0=>solo datos)
    var datos = "p1=entregaResultadoImagenes&p2=" + modo;
    datos += "&p3=" + arraydatos + "&p4=" + idReporte;
    datos += '&p5=' + idImagen;
    //location.href="../../classReporte/reportes/setDatosReporte.php?"+datos;
    var ruta = "../../classReporte/reportes/setDatosReporte.php?" + datos;
    window.open(ruta);
}


function mostrarDetalleCronogramaMedico(iCodigoCronograma) {
    var patronModulo = 'mostrarDetalleCronogramaMedico';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iCodigoCronograma;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        asynchronous: false,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('contenedorLeyendaCronograma').update(respuesta);
            $("hCadenaCodigoProgramacion").value = '';
            $("hCadenaCodigoProgramacionNombre").value = '';
        }
    })
}

function seleccionandoNumeroDePlaca(i) {

    var vEstado = cargaEmpleadosProgramacionMedicosxCC.cells(i, 19).getValue();
    var placa = cargaEmpleadosProgramacionMedicosxCC.cells(i, 13).getValue();
    var codigoProgramacion = cargaEmpleadosProgramacionMedicosxCC.cells(i, 16).getValue();
    var vNombrePaciente = cargaEmpleadosProgramacionMedicosxCC.cells(i, 8).getValue();
    var bit = 1;
    if (placa == '') {
        bit = 0;
    }
    if (bit == 1) {
        var bEstadoSeleccionado = $("CkeckMuestra" + i).value;
        var hCadenaCodigoProgramacion = $("hCadenaCodigoProgramacion").value;
        var hCadenaCodigoProgramacionNombre = $("hCadenaCodigoProgramacionNombre").value;

        //alert("bEstadoSeleccionado : "+bEstadoSeleccionado)
        if (bEstadoSeleccionado == 1) {
            if ($('btnEvioMedico')) {
                $('btnEvioMedico').show();
            }
            if (hCadenaCodigoProgramacion.indexOf(codigoProgramacion) == -1) {
                if (hCadenaCodigoProgramacion == '') {
                    hCadenaCodigoProgramacion = codigoProgramacion;
                    hCadenaCodigoProgramacionNombre = codigoProgramacion + '---' + vNombrePaciente;
                    $("hCadenaCodigoProgramacion").value = hCadenaCodigoProgramacion;
                    $("hCadenaCodigoProgramacionNombre").value = hCadenaCodigoProgramacionNombre;
                } else {
                    hCadenaCodigoProgramacion = hCadenaCodigoProgramacion + '***' + codigoProgramacion;
                    hCadenaCodigoProgramacionNombre = hCadenaCodigoProgramacionNombre + '***' + codigoProgramacion + '---' + vNombrePaciente;
                    $("hCadenaCodigoProgramacion").value = hCadenaCodigoProgramacion;
                    $("hCadenaCodigoProgramacionNombre").value = hCadenaCodigoProgramacionNombre;
                }
            }

            if (vEstado == 'PAGADO' || vEstado == 'ATENDIDO') {
                if (placa == '') {
                    $('CkeckMuestra' + i).checked = false;
                    alert("No tiene Nº de placa. Por favor regularice.");
                }
            } else {

                var palabras = hCadenaCodigoProgramacion.split("***");
                var palabrasNombres = hCadenaCodigoProgramacionNombre.split("***");
                if (palabras.indexOf(codigoProgramacion) != -1) {
                    var posicion = palabras.indexOf(codigoProgramacion);
                    palabras.splice(parseInt(posicion), 1);
                    var mensaje = palabras.join("***");
                    $("hCadenaCodigoProgramacion").value = mensaje;
                    hCadenaCodigoProgramacion = $("hCadenaCodigoProgramacion").value
                }
                if (palabrasNombres.indexOf(codigoProgramacion + '---' + vNombrePaciente) != -1) {
                    var posicion2 = palabrasNombres.indexOf(codigoProgramacion + '---' + vNombrePaciente);
                    palabrasNombres.splice(parseInt(posicion2), 1);
                    var mensaje2 = palabrasNombres.join("***");
                    $("hCadenaCodigoProgramacionNombre").value = mensaje2;
                    hCadenaCodigoProgramacionNombre = $("hCadenaCodigoProgramacionNombre").value
                }
            }
            $("hCadenaCodigoProgramacion").value = hCadenaCodigoProgramacion;
            $("hCadenaCodigoProgramacionNombre").value = hCadenaCodigoProgramacionNombre;

            if (hCadenaCodigoProgramacion == '') {
                if ($('btnEvioMedico')) {
                    $('btnEvioMedico').hide();
                }
                document.getElementById("CkeckMuestra" + i).checked = false;
                alert('No está pagado o confirmado.');
            }
        }
    } else {
        $('CkeckMuestra' + i).checked = false;
        alert("No tiene Nº de placa. Por favor regularice.");
    }
}

function buscarPersonaImagen() {
    findLikeGoogle(document.getElementById('idFiltroExamenLab').value, tablaExamenesLaboratorio1, 2);
}


function pupapAsignacionMedico() {

    var hCadenaCodigoProgramacionNombre = document.getElementById("hCadenaCodigoProgramacionNombre").value;
    var hCadenaCodigoProgramacion = document.getElementById("hCadenaCodigoProgramacion").value;

    posFuncion = "crearTablaAsignacionMedicoPacientes()";
    vtitle = "";
    vformname = 'pupapAsignacionMedico';
    vwidth = '832';
    vheight = '548';
    patronModulo = 'pupapAsignacionMedico';
    vcenter = 't';
    vresizable = '';
    vmodal = 'false';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + hCadenaCodigoProgramacionNombre;
    parametros += '&p3=' + hCadenaCodigoProgramacion;
    CargarVentanaPopPapJorge(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}
function crearTablaAsignacionMedicoPacientes() {
    var hCadenaCodigoProgramacionNombre = document.getElementById("hCadenaCodigoProgramacionNombre").value;
    var hCadenaCodigoProgramacion = document.getElementById("hCadenaCodigoProgramacion").value;

    var patronModulo = 'crearTablaAsignacionMedicoPacientes'
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + hCadenaCodigoProgramacion;
    parametros += '&p3=' + hCadenaCodigoProgramacionNombre;

    tablaAsignacionMedicoPacientes = new dhtmlXGridObject('div_PacientesSeleccionados');
    tablaAsignacionMedicoPacientes.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaAsignacionMedicoPacientes.setSkin("dhx_terrace");
    tablaAsignacionMedicoPacientes.enableRowsHover(true, 'grid_hover');

    tablaAsignacionMedicoPacientes.enableRowsHover(true, 'grid_hover');
    tablaAsignacionMedicoPacientes.attachEvent("onRowSelect", function (rowId, cellInd) {
        eliminarRegistrodePacientes(rowId, cellInd);
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaAsignacionMedicoPacientes.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    tablaAsignacionMedicoPacientes.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    tablaAsignacionMedicoPacientes.setSkin("dhx_skyblue");
    tablaAsignacionMedicoPacientes.init();
    tablaAsignacionMedicoPacientes.loadXML(pathRequestControl + '?' + parametros, function () {
        //carga al iniciar la tabla 
        var y = tablaAsignacionMedicoPacientes.getRowsNum();
        for (var i = 0; i < y; i++) {
            tablaAsignacionMedicoPacientes.cells(i, 2).setValue('../../../../medifacil_front/imagen/icono/borrar.png');
        }
    });
    tablaAsignacionMedicoPacientes.attachEvent("onEditCell", function (stage, rId, cInd, nValue, oValue) {

    });
    insertarCalendarioMedicosEmpleados();
}
/**/
function insertarCalendarioMedicosEmpleados() {

    dhtmlxCalendarioMedicosEmpleados = new dhtmlXCalendarObject("div_calendarioEditarCitas", true, {
        isMonthEditable: true,
        isYearEditable: true,
        dateformat: '%d/%m/%Y'

    });
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
    dhtmlxCalendarioMedicosEmpleados.loadUserLanguage('es');

    dhtmlxCalendarioMedicosEmpleados.attachEvent("onClick", function (date) {
        cargarMedicosEmpleados(dhtmlxCalendarioMedicosEmpleados.getFormatedDate(null, date));
    });

    var fechaOriginal = $('hFecha').value;
    var arrayFecha = fechaOriginal.split("-");
    dhtmlxCalendarioMedicosEmpleados.setDate(new Date(arrayFecha[0], arrayFecha[1] - 1, arrayFecha[2]));
    dhtmlxCalendarioMedicosEmpleados.show();

}

function cargarMedicosEmpleados(fecha) {
    $('fechaSeleccionadaEditarCitaPaciente').value = fecha;
    var arrayFechaActual = $('fechaActualEditarCita').value.split('/');
    var fechaActual = arrayFechaActual[2] + arrayFechaActual[1] + arrayFechaActual[0];
    var ArrayfechaSeleccionada = fecha.split('/');
    var fechaSeleccionada = ArrayfechaSeleccionada[2] + ArrayfechaSeleccionada[1] + ArrayfechaSeleccionada[0];

    var opcionSede = $('hOpcionSede').value;
    var arreglo = $('hServicio').value.split("|");
    if (fechaSeleccionada >= fechaActual) {
        //       alert(opcionSede);
        //       alert(arreglo[0]);
        //       alert(fecha);
        var patronModulo = 'tablacargarMedicosAsignados';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + opcionSede;
        parametros += '&p3=' + arreglo[0];
        parametros += '&p4=' + fecha;

        var tablaMedicosEditarcitaPaciente = new dhtmlXGridObject('div_ListaDeMedicos');
        tablaMedicosEditarcitaPaciente.setImagePath("../../../../medifacil_front/imagen/icono/");
        tablaMedicosEditarcitaPaciente.attachEvent("onRowSelect", function (rId, cInd) {
            // capturar el codigo de la cronograma del medico
            $("iCodigoCronogramaMedicoSeleccionado").value = tablaMedicosEditarcitaPaciente.cells(rId, 0).getValue();
            var vNombreMedico = tablaMedicosEditarcitaPaciente.cells(rId, 4).getValue();
            $('div_NombreMedicoSeleccionado').update("<b>" + vNombreMedico + "</b>");
            //            generarComoTurnos(rId, cInd);
        });
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador = contadorCargador;
        tablaMedicosEditarcitaPaciente.attachEvent("onXLS", function () {
            cargadorpeche(1, idCargador);
        });
        tablaMedicosEditarcitaPaciente.attachEvent("onXLE", function () {
            cargadorpeche(0, idCargador);
        });
        /////////////fin cargador ///////////////////////
        tablaMedicosEditarcitaPaciente.setSkin("dhx_skyblue");
        tablaMedicosEditarcitaPaciente.init();
        tablaMedicosEditarcitaPaciente.loadXML(pathRequestControl + '?' + parametros, function () {
            tmpc = 1;
        });
    } else {
        $('div_ListaDeMedicos').update('<h1 style="color:red;" >Seleccionar fecha valida</h1>');
    }
}

function seleccionarTodo() {
    var hCadenaCodigoProgramacion = $("hCadenaCodigoProgramacion").value;
    var hCadenaCodigoProgramacionNombre = $("hCadenaCodigoProgramacionNombre").value;
    var bEstadoSeleccionadoTotal = $("CkeckMuestraTotal").value;
    var m = cargaEmpleadosProgramacionMedicosxCC.getRowsNum()
    for (var i = 0; i < m; i++) {
        var bEstado = cargaEmpleadosProgramacionMedicosxCC.cells(i, 19).getValue();
        if (bEstado == 'PAGADO') {
            if (bEstadoSeleccionadoTotal == 1) {
                var codigoProgramacion = cargaEmpleadosProgramacionMedicosxCC.cells(i, 16).getValue();
                var vNombrePaciente = cargaEmpleadosProgramacionMedicosxCC.cells(i, 8).getValue();
                $('btnEvioMedico').show();
                document.getElementById("CkeckMuestra" + i).checked = true
                $("CkeckMuestra" + i).value = 1;
                if (hCadenaCodigoProgramacion.indexOf(codigoProgramacion) == -1) {
                    if (hCadenaCodigoProgramacion == '') {
                        hCadenaCodigoProgramacion = codigoProgramacion;
                        hCadenaCodigoProgramacionNombre = codigoProgramacion + '---' + vNombrePaciente;
                    } else {
                        hCadenaCodigoProgramacion = hCadenaCodigoProgramacion + '***' + codigoProgramacion;
                        hCadenaCodigoProgramacionNombre = hCadenaCodigoProgramacionNombre + '***' + codigoProgramacion + '---' + vNombrePaciente;
                    }
                }
            } else {
                document.getElementById("CkeckMuestra" + i).checked = false
                $("CkeckMuestra" + i).value = 0;
                $('btnEvioMedico').hide();
                document.getElementById("hCadenaCodigoProgramacionNombre").value = '';
                document.getElementById("hCadenaCodigoProgramacion").value = '';
                hCadenaCodigoProgramacion = '';
                hCadenaCodigoProgramacionNombre = '';
            }
        }
    }
    $("hCadenaCodigoProgramacion").value = hCadenaCodigoProgramacion;
    $("hCadenaCodigoProgramacionNombre").value = hCadenaCodigoProgramacionNombre;
}


function eliminarRegistrodePacientes(rId, cInd) {
    var codigoPaciente1 = '';
    var v = 0;
    if (confirmar("Esta Seguro que desea Eliminar")) {
        if (cInd == 2) {
            var m = parseInt(tablaAsignacionMedicoPacientes.getRowsNum());
            if (m == 1) {
                codigoPaciente1 = tablaAsignacionMedicoPacientes.cells(rId, 0).getValue();
                tablaAsignacionMedicoPacientes.deleteRow(rId);
            } else {
                if (m == (rId + 1)) {
                    codigoPaciente1 = tablaAsignacionMedicoPacientes.cells(rId, 0).getValue();
                    tablaAsignacionMedicoPacientes.deleteRow(rId);
                } else {
                    for (var i = rId; i < m; i++) {
                        var j = parseInt(i) + 1;
                        if (j != m) {
                            if (v == 0) {
                                codigoPaciente1 = tablaAsignacionMedicoPacientes.cells(i, 0).getValue();
                            }
                            var codigoPaciente = tablaAsignacionMedicoPacientes.cells(j, 0).getValue();
                            var nombrePaciente = tablaAsignacionMedicoPacientes.cells(j, 1).getValue();
                            tablaAsignacionMedicoPacientes.cells(i, 0).setValue(codigoPaciente);
                            tablaAsignacionMedicoPacientes.cells(i, 1).setValue(nombrePaciente);
                            tablaAsignacionMedicoPacientes.cells(i, 2).setValue('../../../../medifacil_front/imagen/icono/borrar.png');
                            v = 1;
                        }
                        else {
                            if (v == 0) {
                                codigoPaciente1 = tablaAsignacionMedicoPacientes.cells(parseInt(m) - 1, 0).getValue();
                            }
                            tablaAsignacionMedicoPacientes.deleteRow(parseInt(m) - 1);
                        }
                    }
                }
            }
        }
        if (codigoPaciente1 != '') {
            var h = cargaEmpleadosProgramacionMedicosxCC.getRowsNum();
            for (var k = 0; k < h; k++) {
                var codigoProgramacion = cargaEmpleadosProgramacionMedicosxCC.cells(k, 16).getValue();
                if (codigoProgramacion == codigoPaciente1) {
                    //                alert("Entro: "+codigoPaciente1+"  k: "+k);
                    document.getElementById("CkeckMuestra" + k).checked = false;
                    $("CkeckMuestra" + k).value = 0;
                    seleccionandoNumeroDePlaca(k);
                }
            }
        }
    }
}

function guardarASignacionMedico() {
    var cadenaCodigoPacienteProgramado = document.getElementById("hCadenaCodigoProgramacion").value;
    var iCodigoCronogramaMedicoSeleccionado = $("iCodigoCronogramaMedicoSeleccionado").value;
    var b = 1;
    var m = parseInt(tablaAsignacionMedicoPacientes.getRowsNum());
    if (cadenaCodigoPacienteProgramado == '') {
        b = 0;
    }
    if (iCodigoCronogramaMedicoSeleccionado == '') {
        b = 0;
    }
    if (m == 0) {
        b = 2;
    }
    if (b == 1) {
        var patronModulo = 'guardarASignacionMedico';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += "&p2=" + iCodigoCronogramaMedicoSeleccionado;
        parametros += "&p3=" + cadenaCodigoPacienteProgramado;
        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false, // Para que el ajax respete el orden de ejecucion
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function (transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                //            $('divDetallePuntoControl').update(respuesta);
                alert("Se Guardo Exitosamente");
                listarCronogramaMedicoEmergencia($('hcodigocronograma').value);
            }
        }
        )
    } else {
        if (b == 1) {
            alert("Selecciones al Medico");
        }
        if (b == 2) {
            alert("No hay Paciente Seleccionado");
        }
    }
}
function popupDerivarMasivamente() {
    var filas = cargaEmpleadosProgramacionMedicosxCC.getRowsNum();
    var n = 0;
    for (var i = 0; i < filas; i++) {
        var vEstado = cargaEmpleadosProgramacionMedicosxCC.cells(i, 19).getValue();
        if (vEstado == 'PAGADO' || vEstado == 'ATENDIDO') {
            if ($('CkeckMuestra' + i).checked == true) {
                n++;
                break;
            }
        }
    }
    if (n == 0) {
        alert('Seleccione por lo menos a un paciente.');
    }
    else {
        var vformname = 'ventanaDerivarMasivamente';
        var vtitle = 'Derivación masiva';
        var vwidth = '700';
        var vheight = '450';
        var vcenter = 't';
        var vresizable = '';
        var vmodal = 'false';
        var vstyle = '';
        var vopacity = '';
        var vposx1 = '';
        var vposx2 = '';
        var vposy1 = '';
        var vposy2 = '';
        var patronModulo = 'seleccionarUbicaciones';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        var posFuncion = 'mostrarPacientesDerivarMasivamente';
        CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
    }
}
function mostrarPacientesDerivarMasivamente() {

    var filas = cargaEmpleadosProgramacionMedicosxCC.getRowsNum();
    var codPer = '', nomPer = '', examen = '', placa = '', n = 0;
    var html = '';
    // _codigosProgramacion es variable global
    _codigosProgramacion = new Array();

    for (var i = 0; i < filas; i++) {
        var vEstado = cargaEmpleadosProgramacionMedicosxCC.cells(i, 19).getValue();
        if (vEstado == 'PAGADO' || vEstado == 'ATENDIDO') {
            var codPro = cargaEmpleadosProgramacionMedicosxCC.cells(i, 16).getValue();
            if ($('CkeckMuestra' + i).checked == true && codPro != _codigosProgramacion[n - 1]) {
                codPer = cargaEmpleadosProgramacionMedicosxCC.cells(i, 6).getValue();
                nomPer = cargaEmpleadosProgramacionMedicosxCC.cells(i, 8).getValue();
                examen = cargaEmpleadosProgramacionMedicosxCC.cells(i, 12).getValue();
                placa = cargaEmpleadosProgramacionMedicosxCC.cells(i, 13).getValue();
                _codigosProgramacion[n] = cargaEmpleadosProgramacionMedicosxCC.cells(i, 16).getValue();

                html += "<tr>";
                html += "<td>" + codPer + "</td><td>" + nomPer + "</td><td>" + placa + "</td><td>" + examen + "</td>";
                html += "</tr>";
                n++;
            }
        }
    }
    $('tbdPaciente').innerHTML = html;
}
function grabarUbicacionPlacas() {
    if (confirm('¿Seguro de Grabar?')) {
        var ubicacion = $('cboUbicacion').value;
        var observaciones = $('txaObservacionUbicacion').value;
        var longitud = _codigosProgramacion.length; // _codigosProgramacion es variable global definida en mostrarPacientesDerivarMasivamente()
        var codigosProg = '';
        for (var i = 0; i < longitud; i++)
            codigosProg += _codigosProgramacion[i] + '|';
        _codigosProgramacion = null;
        var patronModulo = 'grabarUbicacionPlacas';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + codigosProg;
        parametros += '&p3=' + ubicacion;
        parametros += '&p4=' + observaciones;

        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            asynchronous: false,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function (transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                alert(respuesta);
                Windows.close('Div_ventanaDerivarMasivamente');
                listarCronogramaMedicoEmergencia($('hcodigocronograma').value);
            }
        });
    }
}



function abrirPupudHistoriaCronograma(iCodigoCronograma) {
    var vformname = 'ventanaHistoriaCronograma';
    var vtitle = 'Historia Cronograma';
    var vwidth = '900';
    var vheight = '450';
    var vcenter = 't';
    var vresizable = '';
    var vmodal = 'false';
    var vstyle = '';
    var vopacity = '';
    var vposx1 = '';
    var vposx2 = '';
    var vposy1 = '';
    var vposy2 = '';
    var patronModulo = 'abrirPupudHistoriaCronograma';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iCodigoCronograma;
    var posFuncion = 'listarHistoriaCronogramaPaciente';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

}


function listarHistoriaCronogramaPaciente() {
    var iCodigoCronograma = $('txtiCodigoCronograma').value;
    var patronModulo = 'listarHistoriaCronogramaPaciente';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iCodigoCronograma;
    var listarHistoriaCronogramaPaciente = new dhtmlXGridObject('div_contenedorTblHistoriaCrongoramaPaciente');
    listarHistoriaCronogramaPaciente.setImagePath("../../../../medifacil_front/imagen/icono/");
    listarHistoriaCronogramaPaciente.attachEvent("onRowSelect", function (rId, cInd) {

    });
    contadorCargador++;
    var idCargador = contadorCargador;
    listarHistoriaCronogramaPaciente.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    listarHistoriaCronogramaPaciente.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    listarHistoriaCronogramaPaciente.setSkin("dhx_skyblue");
    listarHistoriaCronogramaPaciente.init();
    listarHistoriaCronogramaPaciente.loadXML(pathRequestControl + '?' + parametros, function () {
        var iMovidos = 0;
        var iTraidos = 0;
        for (var i = 0; i < listarHistoriaCronogramaPaciente.getRowsNum(); i++) {
            var vEstado = listarHistoriaCronogramaPaciente.cells2(i, 7).getValue();
            var vSituacion = listarHistoriaCronogramaPaciente.cells2(i, 6).getValue();
            if (vEstado == 'ATENDIDO') {
                listarHistoriaCronogramaPaciente.setRowColor(listarHistoriaCronogramaPaciente.getRowId(i), "#DEEDF8");
            }
            if (vEstado == 'RESERVADO') {
                listarHistoriaCronogramaPaciente.setRowColor(listarHistoriaCronogramaPaciente.getRowId(i), "#F0F43A");

            }
            if (vEstado == 'PAGADO') {
                listarHistoriaCronogramaPaciente.setRowColor(listarHistoriaCronogramaPaciente.getRowId(i), "#F8A83E");
            }
            for (j = 0; j < listarHistoriaCronogramaPaciente.getColumnsNum(); j++) {
                listarHistoriaCronogramaPaciente.setCellTextStyle(listarHistoriaCronogramaPaciente.getRowId(i), j, 'color:#000000;border-top:1px solid #5D5D5D;');
                switch (vSituacion)
                {
                    case 'NORMAL':
                        listarHistoriaCronogramaPaciente.setCellTextStyle(listarHistoriaCronogramaPaciente.getRowId(i), 6, 'color:#000;font-weight:bold;border-top:1px solid #5D5D5D;background-color: #FAD160;');
                        break;
                    case 'MOVIDO':
                        iMovidos++;
                        listarHistoriaCronogramaPaciente.setCellTextStyle(listarHistoriaCronogramaPaciente.getRowId(i), 6, 'color:#000;font-weight:bold;border-top:1px solid #5D5D5D;background-color:#4285F4;');
                        break;
                    case 'ASIGNADO':
                        iTraidos++;
                        listarHistoriaCronogramaPaciente.setCellTextStyle(listarHistoriaCronogramaPaciente.getRowId(i), 6, 'color:#fff;font-weight:bold;border-top:1px solid #5D5D5D;background-color: #DA1F26;');
                        break;
                }
            }
        }
    });
}

