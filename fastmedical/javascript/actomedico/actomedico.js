var pathRequestControl = "../../ccontrol/control/control.php";
var dhxAccordion;
var contadorDivsMedicamentos = 0;
var contadorDivsPracticaMedica = 0;
var contadorDivsDiagnosticos = 0;
var contadorGrid = 0;
var opcionpreguardarDiagnosticos;
function iniciarContador() {
    contadorGrid = 0;
}

function mostrardatosMedicosActoMedico() {
    patronModulo = 'datosPersonalesActoMedico';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            window.alert(respuesta);
        }
    })
}
function mostrarprogramacionMedicosActoMedico() {
    var mes = document.getElementById("cb_filtro_mes").value;
    var anio = document.getElementById("cb_filtro_anio").value;

    var patronModulo = 'mostrarProgramacionMedicoActoMedico';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + mes;
    parametros += '&p3=' + anio;

    tablaProgramacionMedico = new dhtmlXGridObject('Div_programacionMedicosActoMedico');
    tablaProgramacionMedico.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaProgramacionMedico.setSkin("dhx_skyblue");

    tablaProgramacionMedico.attachEvent("onRowSelect", mostrarPacientes);
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaProgramacionMedico.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    tablaProgramacionMedico.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaProgramacionMedico.init();
    tablaProgramacionMedico.loadXML(pathRequestControl + '?' + parametros, function() {
        mostrarAtenciones();
    });
//calculaAtendidosyNoAtendidosMensualActoMedico();

}

function mostrarAtenciones() {
    var numero = 0;
    var cadenaCronogramas = '';
    var codigocronograma = '';
    var adicionales = 0;
    var fila=0;
    for (i = 0; i < tablaProgramacionMedico.getRowsNum(); i++) {

        var array = tablaProgramacionMedico.getRowId(i).split("|");
        var seleccion = array[2];
        if (seleccion == 1) {
            numero++;
            cadenaCronogramas = cadenaCronogramas + '|' + array[0];
            $('henHora').value = seleccion;
            codigocronograma = array[0];
            adicionales = array[1];
            fila = i;
        //tablaProgramacionMedico.selectRow(i,true,true,true);
        // motrarTodasAtencionesProgramados(cadenaCronogramas)                          
        }
    }
   
    var id=tablaProgramacionMedico.getRowId(fila);
    var servicio=tablaProgramacionMedico.cells(id, 4).getValue();
    if (numero > 1 &&servicio=='TERAPIA FISICA (TARIFA A) ESSALUD') {
        motrarTodasAtencionesProgramados(cadenaCronogramas);
        // mostrarTodosPacientesAdicionales(cadenaCronogramas);
        llenardatosPersonalesMedicoActoMedico(codigocronograma);


    } else {
        if(numero==1){
             tablaProgramacionMedico.selectRow(fila, true, true, true);
        }
       
    }
    $('hcodigoCronograma').value = codigocronograma;
    $("txtcuposadicionales").value = adicionales;
}

function mostrarPacientes(rowId, cellInd) {
    var array = rowId.split("|");
    var codigocronograma = array[0];
    var adicionales = array[1];
    //var actividad = array[3];
    $('henHora').value = array[2];
    mostrarPacientesProgramados(codigocronograma);
    mostrarPacientesAdicionales(codigocronograma);

    $("hcodigoCronograma").value = codigocronograma;
    $("hidtablacronogramas").value = rowId;
    $("txtcuposadicionales").value = adicionales;
    llenardatosPersonalesMedicoActoMedico(codigocronograma);
    calculaAtendidosyNoAtendidosDiarioActoMedico(codigocronograma);
//calculaAtendidosyNoAtendidosMensualActoMedico(codigocronograma);
}

function motrarTodasAtencionesProgramados(cadenaCronogramas) {
    // alert(cadenaCronogramas);
    var patronModulo = 'motrarTodasAtencionesProgramados';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + cadenaCronogramas;


    tablaPacienteProgramados = new dhtmlXGridObject('Div_pacientesprogramados');
    tablaPacienteProgramados.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaPacienteProgramados.setSkin("dhx_skyblue");
    tablaPacienteProgramados.attachEvent("onRowSelect", eventoPacienteProgramado);
    // miTablaAntecedente.attachEvent("onRowSelect", agregarAntecedente);
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaPacienteProgramados.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    tablaPacienteProgramados.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaPacienteProgramados.init();
    tablaPacienteProgramados.loadXML(pathRequestControl + '?' + parametros, function() {
        var total = 0;
        var atendidos = 0;
        var regularizar = 0;
        var noAtendidos = 0;
        for (i = 0; i < tablaPacienteProgramados.getRowsNum(); i++) {
            array = tablaPacienteProgramados.getRowId(i).split("|");
            estadoatencion = array[2];
            if (estadoatencion == '0005') {
                atendidos++;
                tablaPacienteProgramados.setRowTextStyle(tablaPacienteProgramados.getRowId(i), 'background-color:orange;color:black;border-top: 1px solid black;');
            }
            if (estadoatencion == '0007') {
                regularizar++;
                tablaPacienteProgramados.setRowTextStyle(tablaPacienteProgramados.getRowId(i), 'background-color:#D1FCD2;color:black;border-top: 1px solid black;');
            }
            if (estadoatencion == '0004') {
                noAtendidos++;
                tablaPacienteProgramados.setRowTextStyle(tablaPacienteProgramados.getRowId(i), 'background-color:#ffffff;color:black;border-top: 1px solid black;');
            }
        }
        total = atendidos + regularizar + noAtendidos;
        $('hTotal').value = total;
        $('hatendidos').value = atendidos;
        $('hregularizar').value = regularizar;
        $('hnoAtendidos').value = noAtendidos;
        mostrarTodosPacientesAdicionales(cadenaCronogramas);

    });
}

function mostrarTodosPacientesAdicionales(cadenaCronogramas) {

    //        
    var patronModulo = 'mostrarPacientesTodosAdicionalesActoMedico';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + cadenaCronogramas;
    //parametros+='&p3='+codigoactividad;

    tablaPacienteAdicionales = new dhtmlXGridObject('Div_pacientesadicionales');
    tablaPacienteAdicionales.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaPacienteAdicionales.setSkin("dhx_skyblue");
    tablaPacienteAdicionales.attachEvent("onRowSelect", eventoPacienteAdicional);
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaPacienteAdicionales.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    tablaPacienteAdicionales.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaPacienteAdicionales.init();
    tablaPacienteAdicionales.loadXML(pathRequestControl + '?' + parametros, function() {
        var total = 0;
        var atendidos = 0;
        var regularizar = 0;
        var noAtendidos = 0;
        for (i = 0; i < tablaPacienteAdicionales.getRowsNum(); i++) {
            array = tablaPacienteAdicionales.getRowId(i).split("|");
            estadoatencion = array[2];
            if (estadoatencion == '0005') {
                atendidos++;
                tablaPacienteAdicionales.setRowTextStyle(tablaPacienteAdicionales.getRowId(i), 'background-color:orange;color:black;border-top: 1px solid black;');
            }
            if (estadoatencion == '0007') {
                regularizar++;
                tablaPacienteAdicionales.setRowTextStyle(tablaPacienteAdicionales.getRowId(i), 'background-color:#D1FCD2;color:black;border-top: 1px solid black;');
            }
            if (estadoatencion == '0004') {
                noAtendidos++;
                tablaPacienteAdicionales.setRowTextStyle(tablaPacienteAdicionales.getRowId(i), 'background-color:#ffffff;color:black;border-top: 1px solid black;');
            }
        }
        $('hTotal').value = total + atendidos + regularizar + noAtendidos + parseInt($('hTotal').value);
        $('hatendidos').value = atendidos + parseInt($('hatendidos').value);
        $('hregularizar').value = regularizar + parseInt($('hregularizar').value);
        $('hnoAtendidos').value = noAtendidos + parseInt($('hnoAtendidos').value);
    // alert(noAtendidos);
    });


}

function mostrarPacientesProgramados(codigocronograma) {
    //mostrarPacientesAdicionales(filaId,celdaInd);

    var patronModulo = 'mostrarPacientesProgramadosActoMedico';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigocronograma;


    tablaPacienteProgramados = new dhtmlXGridObject('Div_pacientesprogramados');
    tablaPacienteProgramados.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaPacienteProgramados.setSkin("dhx_skyblue");
    tablaPacienteProgramados.enableMultiline(true);
    tablaPacienteProgramados.attachEvent("onRowSelect", eventoPacienteProgramado);
    // miTablaAntecedente.attachEvent("onRowSelect", agregarAntecedente);
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaPacienteProgramados.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    tablaPacienteProgramados.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaPacienteProgramados.init();
    tablaPacienteProgramados.loadXML(pathRequestControl + '?' + parametros, function() {

        for (i = 0; i < tablaPacienteProgramados.getRowsNum(); i++) {
            array = tablaPacienteProgramados.getRowId(i).split("|");
            estadoatencion = array[2];
            if (estadoatencion == '0005') {
                tablaPacienteProgramados.setRowTextStyle(tablaPacienteProgramados.getRowId(i), 'background-color:orange;color:black;border-top: 1px solid black;');
            }
            if (estadoatencion == '0007') {
                tablaPacienteProgramados.setRowTextStyle(tablaPacienteProgramados.getRowId(i), 'background-color:#D1FCD2;color:black;border-top: 1px solid black;');
            }
            if (estadoatencion == '0004') {
                tablaPacienteProgramados.setRowTextStyle(tablaPacienteProgramados.getRowId(i), 'background-color:#ffffff;color:black;border-top: 1px solid black;');
            }
        }
    });



}


function mostrarPacientesAdicionales(codigocronograma) {

    //        
    var patronModulo = 'mostrarPacientesAdicionalesActoMedico';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigocronograma;
    //parametros+='&p3='+codigoactividad;

    tablaPacienteAdicionales = new dhtmlXGridObject('Div_pacientesadicionales');
    tablaPacienteAdicionales.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaPacienteAdicionales.setSkin("dhx_skyblue");
    tablaPacienteAdicionales.attachEvent("onRowSelect", eventoPacienteAdicional);
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaPacienteAdicionales.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    tablaPacienteAdicionales.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaPacienteAdicionales.init();
    tablaPacienteAdicionales.loadXML(pathRequestControl + '?' + parametros, function() {

        for (i = 0; i < tablaPacienteAdicionales.getRowsNum(); i++) {
            array = tablaPacienteAdicionales.getRowId(i).split("|");
            estadoatencion = array[2];
            if (estadoatencion == '0005') {
                tablaPacienteAdicionales.setRowTextStyle(tablaPacienteAdicionales.getRowId(i), 'background-color:orange;color:black;border-top: 1px solid black;');
            }
            if (estadoatencion == '0007') {
                tablaPacienteAdicionales.setRowTextStyle(tablaPacienteAdicionales.getRowId(i), 'background-color:#D1FCD2;color:black;border-top: 1px solid black;');
            }
            if (estadoatencion == '0004') {
                tablaPacienteAdicionales.setRowTextStyle(tablaPacienteAdicionales.getRowId(i), 'background-color:#ffffff;color:black;border-top: 1px solid black;');
            }
        }
    });


}

function eventoPacienteProgramado(rowId, cellInd) {
    if (cellInd == 7) {
        llamaralPacienteActoMedico(rowId);
    }
    if (cellInd == 8) {
        $("hidtablapacientes").value = rowId;
        $("hidtipoprogramacion").value = 0;
        atenderPacienteActoMedico(rowId);
    }
    if (cellInd == 9) {
        $("hidtablapacientes").value = rowId;
        $("hidtipoprogramacion").value = 0;
        if ($('henHora').value == 1) {
            atencionInmediataXRegularizar(rowId);
        } else {
            alert('Solo se puede Cambiar de Estado durante su turno')
        }

    }
}

function eventoPacienteAdicional(rowId, cellInd) {
    if (cellInd == 7) {
        llamaralPacienteActoMedico(rowId);
    }
    if (cellInd == 8) {
        $("hidtablapacientes").value = rowId;
        $("hidtipoprogramacion").value = 1;
        atenderPacienteActoMedico(rowId);
    }
    if (cellInd == 9) {
        $("hidtablapacientes").value = rowId;
        $("hidtipoprogramacion").value = 0;
        if ($('henHora').value == 1) {
            atencionInmediataXRegularizar(rowId);
        } else {
            alert('Solo se puede Cambiar de Estado durante su turno');
        }

    }

}
function afiliacionCorrecta(codigoProgramacion) {


    var patronModulo = 'afiliacionCorrecta';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + '';
    parametros += '&p3=' + codigoProgramacion;
    var respuesta = '';
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        asynchronous: false,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            respuesta = transport.responseText;

        }
    })
    // alert(respuesta)
    return trimJunny(respuesta);
}


function calculaAtendidosyNoAtendidosDiarioActoMedico(codigoCronograma) {
    pathLink = "p1=calculaAtendidosyNoAtendidosDiarioActoMedico&p2=" + codigoCronograma;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            respuesta = transport.responseText;
            $('Div_atencionesdiaria').update(respuesta);
        }
    })
}

function calculaAtendidosyNoAtendidosMensualActoMedico(codigoCronograma) {
    var mes = $("cb_filtro_mes").value;
    var anio = $("cb_filtro_anio").value;

    var patronModulo = 'calculaAtendidosyNoAtendidosMensualActoMedico';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoCronograma;
    parametros += '&p3=' + mes;
    parametros += '&p4=' + anio;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Div_atencionesmensuales').update(respuesta);
        }
    })
}

function seleccionCronogramaActoMedico(event, html, valores) {
    var codigoCronograma = valores.split("|")[0];
    adicionales = valores.split("|")[1];
    document.getElementById("hcodigoCronograma").value = codigoCronograma;
    pathLink = "p1=seleccionCronogramaProgramadosActoMedico&p2=" + codigoCronograma;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Div_pacientesprogramados').update(respuesta);
            document.getElementById("txtcuposadicionales").value = adicionales;
            seleccionCronogramaAdicionalesActoMedico(codigoCronograma);
            calculaAtendidosyNoAtendidosDiarioActoMedico(codigoCronograma);
            llenardatosPersonalesMedicoActoMedico(codigoCronograma);
        }
    })
}
function atencionInmediataXRegularizar(parametro) {
    var array = parametro.split("|");
    var codigoProgramacion = array[0];

    var patronModulo = 'atencionInmediataActoMedico';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoProgramacion;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            var respuesta = transport.responseText;

            mostrarAtenciones();


            window.alert(respuesta);
        }
    })

}
function cargarCuerpoHC(codigoservicio, codigoProgramacion) {
    //para limpiar los hc despues de grabar
    var estadoatencion = document.getElementById("htxtestadoatencion").value;
    var codigopaciente = document.getElementById("htxtcodigopaciente").value;
    //var codigoservicio = document.getElementById("htxtcodigoservicio").value;
    var patronModulo = 'cargarCuerpoHC';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoservicio;
    //var patronModulo='cargaFiliacionActoMedico';
    //var parametros='';
    // parametros+='p1='+patronModulo;
    parametros += '&p3=' + codigoProgramacion;
    parametros += '&p4=' + codigopaciente;
    parametros += '&p5=' + estadoatencion;
    //  alert(codigoProgramacion);
    // alert(codigopaciente);
    //parametros+='&p4='+codigoservicio;

    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Div_GeneralActoMedicoHC').update(respuesta);
        }
    })
}
function atenderPacienteActoMedico(parametro) {
    //  alert(parametro);
    var array = parametro.split("|");
    var codigoProgramacion = array[0];
    var estadoatencion = array[2];
    var codigopaciente = array[3];
    var codigoservicio = array[4];
    var esEssalud = array[5];
    $("htxtcodigopaciente").value = codigopaciente;
    $("htxtestadoatencion").value = estadoatencion;
    if (estadoatencion == '0004' || estadoatencion == '0007') {
        var mensajeAfiliacion = afiliacionCorrecta(codigoProgramacion);
        if (mensajeAfiliacion == 'ok') {
            cargarCuerpoHC(codigoservicio, codigoProgramacion);
            if (estadoatencion == '0004') {
                $("hNumeroDiagnostico").value = '0';
                contadorDivsDiagnosticos = 0;
                $("Div_TablaDiagnosticoCIE").hide();
                $("htxtcodigosDiagnosticos").value = 0;
                $("txtbusquedaNombreDiagnostico").value = '';
            }

            $("Div_GeneralActoMedicoHC").show();
            $("Div_GeneralActoMedico").hide();//oculta programacion de medico
            //$('Div_HCReciente').hide(); //oculta lo 
            //pre carga de Datos
            $("hcodigoProgramacion").value = codigoProgramacion;
            $("htxtEsESSALUD").value = esEssalud;
            $("htxtcodigoservicio").value = codigoservicio;
            cargarDatosDestinoCita();
            cargarDatosTipoCita();
            //dibujarCanvas();
            $("btncancelarActoMedico").show();
        } else {
            alert(mensajeAfiliacion);
        }

    }
    else {
        //alert('peche 2')
        var divs_hc = ["Div_Triaje", "Div_ConsultaMedica", "Div_Antecedentes", "Div_ExamenMedico", "Div_Diagnostico", "Div_Tratamiento", "Opc_proximaCita"];
        cargarCuerpoHC('', codigoProgramacion);
        //$("divHC_cuerpo").hide();
        $("Div_GeneralActoMedicoHC").show();
        $("Div_GeneralActoMedico").hide();
        $("hcodigoProgramacion").value = codigoProgramacion;
        $("htxtEsESSALUD").value = esEssalud;
        $("htxtestadoatencion").value = estadoatencion;
        $("htxtcodigopaciente").value = codigopaciente;
        $("htxtcodigoservicio").value = codigoservicio;
        // $("btnImprimirRecetaUnica").show();  
        $("btnAtencionCompletada").hide();
        $("btnregresarActoMedico").show();
        $("btncancelarActoMedico").hide();
        $('Div_diagnosticoESSALUD').hide();
        //iniciarActoMedico(codigoProgramacion);
        verHcReciente();
    /*
         for (var i=0;i<divs_hc.length;i++){
         $(divs_hc[i]).hide();
         }
         */
    }

    /*
     document.getElementById('Div_pacientesEnEspera').style.display="none";
     document.getElementById('Div_accordActoMedico').style.display="block";
     mostrarPestanitasActoMedico();*/
    window.scrollTo(0, 0); //para subir el scroll


}
function cargarTablaPAquete2(codigopaciente, key, iIdGrupoEtarioPersonas, iIdGrupoEtareo) {
    // Lobo
    //    alert(iIdGrupoEtarioPersonas)
    //    alert(key);
    var servicio = $("htxtcodigoservicio").value;
    var codigoProgramacion = $("hcodigoProgramacion").value;
    //    alert(codigoProgramacion);
    //alert("lobo");
    //alert(servicio);
    var patronModulo = 'cargarTablaPAquete';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigopaciente;
    parametros += '&p3=' + servicio;
    parametros += '&p4=' + codigoProgramacion;
    parametros += '&p5=' + iIdGrupoEtarioPersonas;
    parametros += '&p6=' + iIdGrupoEtareo;


    tablaTablaPAquete = new dhtmlXGridObject('Div_PaquetesCuerpo_' + key);
    tablaTablaPAquete.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaTablaPAquete.setSkin("dhx_skyblue");
    tablaTablaPAquete.enableRowsHover(true, 'grid_hover');

    tablaTablaPAquete.attachEvent("onRowSelect", function(fila, columna) {
        //reporteDePuntoControlXExamen(fila,columna);    
        //        probar(fila,columna);
        //        verFotosPaciente()
        });
    //////////para cargador peche////////////////

    contadorCargador++;
    var idCargador = contadorCargador;
    tablaTablaPAquete.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    tablaTablaPAquete.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);

    });
    /////////////fin cargador ///////////////////////
    tablaTablaPAquete.setSkin("dhx_skyblue");
    tablaTablaPAquete.init();
    //    tablaBuscarPersona.loadXML(pathRequestControl+'?'+parametros);

    tablaTablaPAquete.loadXML(pathRequestControl + '?' + parametros, function() {

        //        CargarNombreGrupoEtario(tablaTablaPAquete)
        setColorTablaPaquetes();
    });
    //    alert(1.5);
    tablaTablaPAquete.attachEvent("onEditCell", function(stage, rId, cInd, nValue, oValue) {

        });

}
//function CargarNombreGrupoEtario(tablaTablaPAquete){
//    for(var i=0;i<tablaTablaPAquete.getRowsNum();i++){
//        if(i==0){
//            var nombreGrupoEtario= tablaTablaPAquete.cells(i,4).getValue();
//            var  patronModulo='';
//            var parametros='';
//            parametros+='p1='+patronModulo;
//            contadorCargador++;
//            var idCargador=contadorCargador;
//            new Ajax.Request( pathRequestControl,{
//                method : 'get',
//                parameters : parametros,
//                onLoading : cargadorpeche(1,idCargador),
//                onComplete : function(transport){
//                    cargadorpeche(0,idCargador);
//                    respuesta = transport.responseText;
//                    $('Div_CuerpoNombreGrupo').update('<h1>'+nombreGrupoEtario+'</h1>');
//                }
//            } )  
//        }
//    }
//    
//}

function  setColorTablaPaquetes() {
    for (var i = 0; i < tablaTablaPAquete.getRowsNum(); i++) {

        var nroAte = tablaTablaPAquete.cells(i, 8).getValue();
        var cantidad = tablaTablaPAquete.cells(i, 15).getValue();
        var nroAtemin = tablaTablaPAquete.cells(i, 14).getValue();
        if (cantidad > 1) {
            if (nroAte > nroAtemin) {
                tablaTablaPAquete.setRowTextStyle(tablaTablaPAquete.getRowId(i), 'background-color:#FF0000;color:black;border-top: 1px solid #FF0000;');
            }
            if (nroAte == nroAtemin) {
                tablaTablaPAquete.setRowTextStyle(tablaTablaPAquete.getRowId(i), 'background-color:#CCE2FE;color:black;border-top: 1px solid #CCE2FE;');
            }

        }
    }
}
function pintarDivExamenes(codigoservicio, codigoProgramacion) {
    var patronModulo = 'pintarDivExamenes';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoservicio;
    parametros += '&p3=' + codigoProgramacion;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            respuesta = transport.responseText;
            $('Div_ExamenMedicoCuerpo').update(respuesta);
        }
    })
}

function tablaSintomas() {
    patronModulo = 'tablaSintomas';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    miTablaSintoma = new dhtmlXGridObject('divTblSintomas');
    miTablaSintoma.setImagePath("../../../../fastmedical_front/imagen/icono/");//miTablaSintoma.setImagePath("../../codebase/imgs/");
    miTablaSintoma.attachEvent("onRowSelect", agregarMotivoDeConsulta);
    miTablaSintoma.setSkin("dhx_skyblue");
    miTablaSintoma.init();
    miTablaSintoma.loadXML(pathRequestControl + '?' + parametros);

}

function cargarMotivoDeConsulta(codigoProgramacion) {
    var patronModulo = 'cargarMotivoDeConsulta';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoProgramacion;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            //$('Div_sintomas').update(respuesta);
            $('Div_ConsultaMedicaCuerpo').update(respuesta);
        //tablaSintomas();
        }
    })
}
//Este caso solo es valido para agregar desde la tabla de sintomas
function agregarMotivoDeConsulta(rowId, cellInd) {
    var idCieSintoma = rowId;//var idCieSintoma = miTablaSintoma.getSelectedId();
    var cadenaIdCieSintomas = document.getElementById("hdnCadenaIdCieSintomas").value;

    if ((cadenaIdCieSintomas.indexOf(idCieSintoma + "|") == -1) && (cadenaIdCieSintomas.indexOf(idCieSintoma) == -1)) {
        if (cadenaIdCieSintomas.length > 0)
            cadenaIdCieSintomas = cadenaIdCieSintomas + "|" + idCieSintoma;
        else
            cadenaIdCieSintomas = idCieSintoma;
        document.getElementById("hdnCadenaIdCieSintomas").value = cadenaIdCieSintomas;

        $('hdnNumSintomas').value = parseInt($('hdnNumSintomas').value) + 1;//Esto al inicio logica Junny

        var nombreSintoma = miTablaSintoma.cells(rowId, 2).getValue();
        var numSintoma = $('hdnNumSintomas').value;
        var patronModulo = 'agregarMotivoDeConsulta';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + numSintoma;
        parametros += '&p3=' + nombreSintoma;
        parametros += '&p4=' + rowId;

        new Ajax.Request(pathRequestControl, {
            method: 'post',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                var respuesta = transport.responseText;

                var para = document.getElementById("Div_sintomas");
                var s = respuesta;
                var range = document.createRange();
                range.selectNode(document.body);
                var documentFragment = range.createContextualFragment(s);
                para.appendChild(documentFragment);
                //sacado de http://www.forosdelweb.com/f13/hacer-innerhtml-firefox-borra-valor-input-mismo-div-776976/
                ////////////////////


                preguardarMotivoDeConsulta();
            }
        })
    }
}

function cambiarMotivoDeConsulta(n) {
    //$('imgPreguardarMotivoDeConsulta').src='../../../../fastmedical_front/imagen/btn/btn_preguardar.gif';
    if ($('hdnEstadoSintoma_' + n).value == '2') {
        $('hdnEstadoSintoma_' + n).value = 4;
    }
    preguardarMotivoDeConsulta();
}

function verMotivoConsultaAnteriores() {
    if ($('hdnAbiertoMotivoConsultaAnteriores').value == 0) {
        $('hdnAbiertoMotivoConsultaAnteriores').value = 1;
        $('icono_abrirMotivoConsultaAnteriores').src = '../../../../fastmedical_front/imagen/icono/cerrarVentana.png';
        codigoProgramacion = $('hcodigoProgramacion').value;
        var codigoPaciente = $('htxtcodigopaciente').value;
        patronModulo = 'verMotivoConsultaAnteriores';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + codigoPaciente;
        $('divMotivoConsultaAnteriores').show();

        miTablaMotivoConsulta = new dhtmlXGridObject('divMotivoConsultaAnteriores');
        miTablaMotivoConsulta.setImagePath("../../../../fastmedical_front/imagen/icono/");
        // miTablaAntecedente.attachEvent("onRowSelect", agregarAntecedente);
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador = contadorCargador;
        miTablaMotivoConsulta.attachEvent("onXLS", function() {
            cargadorpeche(1, idCargador);
        });
        miTablaMotivoConsulta.attachEvent("onXLE", function() {
            cargadorpeche(0, idCargador);
        });
        /////////////fin cargador ///////////////////////
        miTablaMotivoConsulta.setSkin("dhx_skyblue");
        miTablaMotivoConsulta.init();
        miTablaMotivoConsulta.loadXML(pathRequestControl + '?' + parametros);
    } else {
        $('hdnAbiertoMotivoConsultaAnteriores').value = 0;
        $('divMotivoConsultaAnteriores').hide();
        $('icono_abrirMotivoConsultaAnteriores').src = '../../../../fastmedical_front/imagen/icono/abrir.png';
    }
}

function preguardarMotivoDeConsulta() {
    // $('imgPreguardarMotivoDeConsulta').src='../../../../fastmedical_front/imagen/btn/btn_preguardar_off.gif';
    var numeroSintomas = parseInt($('hdnNumSintomas').value);
    var patron = new Array();
    var parametros = new Array();
    var respuesta = new Array();
    var cadena = new Array();
    var hdnEstadoSintoma;
    var estadoEnVista;
    var idMotivoConsulta;
    var idSintomaCie;
    var descSintomaMotivoConsulta;
    var codProgramacion;
    var datos;
    for (var i = 1; i < numeroSintomas + 1; i++) {
        hdnEstadoSintoma = 'hdnEstadoSintoma_' + i;
        if ($(hdnEstadoSintoma).value == 0 || $(hdnEstadoSintoma).value == 4 || $(hdnEstadoSintoma).value == 1) {
            estadoEnVista = trimJunny($(hdnEstadoSintoma).value);
            idMotivoConsulta = trimJunny($('hdnIdMotivoDeConsulta_' + i).value);
            idSintomaCie = trimJunny($('hdnSintomaCIE_' + i).value);

            descSintomaMotivoConsulta = trimJunny($('txaDescSintoma_' + i).value);
            //descSintomaMotivoConsulta=descSintomaMotivoConsulta.replace(/\n/gi,"<br/>");
            codProgramacion = trimJunny($('hcodigoProgramacion').value);
            //alert("Datos: "+estadoEnVista+"|"+idMotivoConsulta+"|"+idSintomaCie+"|"+descSintomaMotivoConsulta+"|"+codProgramacion);
            datos = estadoEnVista + "|" + idMotivoConsulta + "|" + idSintomaCie + "|" + descSintomaMotivoConsulta + "|" + codProgramacion;
            datos = Base64.encode(datos);

            patron = 'manteMotivosDeConsulta';
            parametros = '';
            parametros += 'p1=' + patron;
            parametros += '&accion=' + 'insertar';
            parametros += '&datos=' + datos;
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
                    if (respuesta == 'eliminado') {

                    } else {
                        $('hdnIdMotivoDeConsulta_' + i).value = respuesta;
                        $(hdnEstadoSintoma).value = 2;
                    }

                }
            })

        }
    }
}

function cerrarMotivoDeConsulta(numeroSintoma) {
    //0: creado, 1: eliminado en vista, 2: pregrabado en la BD, 3: grabado en la BD, 4:preguardado que fue modificado
    var div = 'Div_sintoma_' + numeroSintoma;
    var nombre = 'hdnEstadoSintoma_' + numeroSintoma;
    $(nombre).value = '1';
    $(div).hide();

    //codigos = document.getElementById("htxtcodigosDiagnosticos").value;
    var cadenaIdCieSintomas = document.getElementById("hdnCadenaIdCieSintomas").value;
    //var idCieSintoma = document.getElementById("hdnIdMotivoDeConsulta_"+numeroSintoma).value;
    var idCieSintoma = document.getElementById("hdnSintomaCIE_" + numeroSintoma).value;

    if (cadenaIdCieSintomas.indexOf(idCieSintoma + "|") != -1) {
        cadenaIdCieSintomas = cadenaIdCieSintomas.replace(idCieSintoma + "|", '');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
    }
    if (cadenaIdCieSintomas.indexOf(idCieSintoma) != -1) {
        cadenaIdCieSintomas = cadenaIdCieSintomas.replace("|" + idCieSintoma, '');//Eliminar de la cadena en el caso el elemento se encuentre al final
        cadenaIdCieSintomas = cadenaIdCieSintomas.replace(idCieSintoma, '');//Eliminar de la cadena en el caso solo haya uno
    }
    document.getElementById("hdnCadenaIdCieSintomas").value = cadenaIdCieSintomas;

    preguardarMotivoDeConsulta();
}

function buscarSintomaNombre(evento) {
    var nombre = $('txtNombreSintoma').value;
    var numero = nombre.length;
    var accion = 1;
    var patronModulo = 'tablaSintomas';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + nombre;
    parametros += '&p3=' + accion;
    var tecla = evento.keyCode
    if (numero == 4 || tecla == 13) {
        sn = 0;
        miTablaSintoma = new dhtmlXGridObject('divTblSintomas');
        miTablaSintoma.setImagePath("../../../../fastmedical_front/imagen/icono/");
        miTablaSintoma.attachEvent("onRowSelect", agregarMotivoDeConsulta);
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador = contadorCargador;
        miTablaSintoma.attachEvent("onXLS", function() {
            cargadorpeche(1, idCargador);
        });
        miTablaSintoma.attachEvent("onXLE", function() {
            cargadorpeche(0, idCargador);
            sn = 1;
        });
        /////////////fin cargador ///////////////////////
        miTablaSintoma.setSkin("dhx_skyblue");
        miTablaSintoma.init();
        miTablaSintoma.loadXML(pathRequestControl + '?' + parametros, function() {

            });
    }

    if (numero > 4 && sn == 1) {
        //alert('sn: '+ sn);
        //miTablaSintoma.filterBy(2,$('txtNombreSintoma').value);
        var palabra = $('txtNombreSintoma').value;
        var arrayPalabras = new Array();
        arrayPalabras = palabra.split(" ");
        var numeroPalabras = arrayPalabras.length;
        miTablaSintoma.filterBy(2, arrayPalabras[0]);
        for (var i = 1; i < numeroPalabras; i++) {
            miTablaSintoma.filterBy(2, arrayPalabras[i], true);
        }




    }
}

function buscarSintomaCodigo() {

    codigo = $('txtCodigoSintoma').value;
    numero = codigo.length;
    accion = 2;
    patronModulo = 'tablaSintomas';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    parametros += '&p3=' + accion;

    if (numero == 2) {
        sc = 0;
        miTablaSintoma = new dhtmlXGridObject('divTblSintomas');
        miTablaSintoma.setImagePath("../../../../fastmedical_front/imagen/icono/");
        miTablaSintoma.attachEvent("onRowSelect", agregarMotivoDeConsulta);
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador = contadorCargador;
        miTablaSintoma.attachEvent("onXLS", function() {
            cargadorpeche(1, idCargador);
        });
        miTablaSintoma.attachEvent("onXLE", function() {
            cargadorpeche(0, idCargador);
        });
        /////////////fin cargador ///////////////////////
        miTablaSintoma.setSkin("dhx_skyblue");
        miTablaSintoma.init();
        miTablaSintoma.loadXML(pathRequestControl + '?' + parametros, function() {
            sc = 1;
        });
    }
    if (numero > 2 && sc == 1) {
        miTablaSintoma.filterBy(1, $('txtCodigoSintoma').value);
    }
}

function validarManteSintomaMotivoConsulta(accion, numDivSintoma) {
    indiceTipoIngreso = $('cboTipoIngreso' + numDivSintoma).selectedIndex;
    if (indiceTipoIngreso == 0) {
        alert('Seleccione tipo de ingreso');
    }
    else {
        indiceClasifMotivoConsulta = $('cboClasifMotivoConsulta' + numDivSintoma).selectedIndex;
        if (indiceClasifMotivoConsulta == 0) {
            alert('Seleccione clasificaci\xF3n');
        }
        else {
            descSintomaMotivoConsulta = $('txaDescSintoma' + numDivSintoma).value;
            if (descSintomaMotivoConsulta == null) {
                alert('Ingrese descripci\xF3n');
            }
            else {
                descSintomaMotivoConsulta = js_trim(descSintomaMotivoConsulta);
                if (descSintomaMotivoConsulta.length == 0) {
                    alert('Ingrese descripci\xF3n distinto de espacios en blanco');
                }
                else {
                    if (descSintomaMotivoConsulta.length < 5) {
                        alert('Ingrese como m\xEDnimo 5 caracteres para la descripci\xF3n');
                    }
                    else {
                        idCondicionIngreso = $('cboTipoIngreso' + numDivSintoma).value;
                        idClasifMotivoConsulta = $('cboClasifMotivoConsulta' + numDivSintoma).value;
                        descSintomaMotivoConsulta = descSintomaMotivoConsulta.replace(/\n/gi, "<br/>");
                        codProgramacion = $('hcodigoProgramacion').value;

                        datos = idCondicionIngreso + "|" + idClasifMotivoConsulta + "|" + descSintomaMotivoConsulta + "|" + codProgramacion;
                        datos = Base64.encode(datos);
                        manteMotivosDeConsulta(accion, datos);
                    }
                }
            }
        }
    }
}

function manteMotivosDeConsulta(accion, datos) {
    pathLink = "p1=manteMotivosDeConsulta&accion=" + accion + "&datos=" + datos;
    new Ajax.Request(pathRequestControl,
    {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            if (respuesta == 1) {
                alert('Se realiz\xF3 la acci\xF3n con \xE9xito');
            }
            else {
                alert('No se concret\xF3 la acci\xF3n, int\xE9ntelo nuevamente o cont\xE1ctese con su administrador');
            }
        }
    }
    )
}
//editarSintomaMotivoConsulta('actualizar',".$arrayFilas[$i]["idMotivoConsulta"].")
function editarSintomaMotivoConsulta(accion, idMotivoConsulta, numDivSintoma) {
    $('cboTipoIngreso' + numDivSintoma).disabled = false;
    $('cboClasifMotivoConsulta' + numDivSintoma).disabled = false;
    $('txaDescSintoma' + numDivSintoma).readOnly = false;

}

function eliminarSintoma(idDivSintoma) {
    if (confirm('\xBFDesea eliminar s\xEDntoma?')) {
        var nodoHijo = document.getElementById(idDivSintoma);
        var nodoPadre = nodoHijo.parentNode;
        nodoPadre.removeChild(nodoHijo);
    }
}

function eliminarSintoma2(accion, idMotivoConsulta, idDivSintoma) {
    if (confirm('\xBFDesea eliminar s\xEDntoma?')) {
        pathLink = "p1=manteMotivosDeConsulta&accion=" + accion + "&idMotivoConsulta=" + idMotivoConsulta;
        new Ajax.Request(pathRequestControl,
        {
            method: 'post',
            parameters: pathLink,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                respuesta = transport.responseText;
                //alert(respuesta);
                if (respuesta == 1) {
                    var nodoHijo = document.getElementById(idDivSintoma);
                    var nodoPadre = nodoHijo.parentNode;
                    nodoPadre.removeChild(nodoHijo);
                    alert('Se realiz\xF3 la acci\xF3n con \xE9xito');
                }
                else {
                    alert('No se concret\xF3 la acci\xF3n, int\xE9ntelo nuevamente o cont\xE1ctese con su administrador');
                }
            }
        }
        )
    }
}

function crearDivNuevoSintoma(idDivSintoma) {
    var divAnterior = document.getElementById('Div_sintomas');
    var nuevoDivSintoma = document.createElement('div');
    nuevoDivSintoma.setAttribute("id", idDivSintoma);
    nuevoDivSintoma.setAttribute("style", "width: 60%;height: 50%");
    divAnterior.appendChild(nuevoDivSintoma);
}

function llamaralPacienteActoMedico(parametro) {
    var array = parametro.split("|");
    var codigoProgramacion = array[0];
    var codigoambientefisico = array[1];
    var estadoatencion = array[2];

    switch (estadoatencion) {
        case '0004' :
        {
            var patronModulo = 'llamaralPacienteActoMedico';
            parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + codigoProgramacion;
            parametros += '&p3=' + codigoambientefisico;

            //pathLink = "p1=llamaralPacienteActoMedico&p2="+codigoProgramacion+"&p3="+codigoambientefisico;
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function(transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    window.alert(respuesta);
                }
            })
            break;
        }
        case '0005' :
        {
            window.alert("El paciente ya fue atendido!!");
            break;
        }
        case '0007' :
        {
            //            window.alert("La atencion del paciente debe ser regularizada!!");
            //            break;    
            patronModulo = 'llamaralPacienteActoMedico';
            parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + codigoProgramacion;
            parametros += '&p3=' + codigoambientefisico;

            //pathLink = "p1=llamaralPacienteActoMedico&p2="+codigoProgramacion+"&p3="+codigoambientefisico;
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function(transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    window.alert(respuesta);
                }
            })
            break;
        }
    }
}
function llenardatosPersonalesMedicoActoMedico(codigoCronograma) {
    var codigopersonamedico = $("txtcodigoMedico").value;

    var patronModulo = 'datosPersonalesActoMedico';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoCronograma;
    parametros += '&p3=' + codigopersonamedico;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            var datos = respuesta.split("|");
            document.getElementById("txtpuesto").value = datos[0];
            document.getElementById("txtnombrecompleto").value = datos[1];
            document.getElementById("txtconsultorio").value = datos[2];
        }
    })
}

function actualizaradicionalesActoMedico() {
    var codigoCronograma = $("hcodigoCronograma").value;
    var cantidadadicionales = $("txtcuposadicionales").value;
    if (codigoCronograma != '') {
        var patronModulo = 'actualizaradicionalesActoMedico';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + codigoCronograma;
        parametros += '&p3=' + cantidadadicionales;

        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                var respuesta = transport.responseText;
                mostrarprogramacionMedicosActoMedico();
                window.alert(respuesta);
            }
        })
    }
    else {
        window.alert("Seleccionar una programacion del medico,por favor!!");
    }
}

/***********************MANTENIMIENTO DE LLAMADAS PACIENTES**********************/
function llamarCreacionMantPantallas() {
    pathLink = "p1=llamarCreacionMantPantallas";
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            creaAccordionLlamadasPacientes();
            respuesta = respuesta.replace(/'/gi, "\"")
            //window.alert(respuesta);
            eval(respuesta);
            codigopantalla = document.getElementById("hidPantalla").value;
            dhxAccordion.cells(codigopantalla).attachObject("Div_cuerpoGeneralPantalla");
            dhxAccordion.attachEvent("onActive", doOnActive);
            dhxAccordion.setEffect(true);
            mostrarTablaAmbientesFisicosxPantalla();
        }
    })
}

function agregarAmbienteFisicoaPantalla() {
    window.alert("Falta implementar..agregarlo directo a base de datos")
}
function creaAccordionLlamadasPacientes() {
    dhxAccordion = new dhtmlXAccordion("Div_MantenimientoLlamadasPacientes");
}
function agregarItemLlamadasPacientes(id, text) {
    dhxAccordion.addItem(id, text);
}
function abrirItemLlamadasPacientes(id) {
    dhxAccordion.cells(id).open();
    document.getElementById("hidPantalla").value = id;
}

function doOnActive(itemId) {
    document.getElementById("hidPantalla").value = itemId;
    agregarcaracteristicas(itemId);

}
function agregarcaracteristicas(codigopantalla) {
    dhxAccordion.cells(codigopantalla).attachObject("Div_cuerpoGeneralPantalla");
    mostrarTablaAmbientesFisicosxPantalla();
}

function mostrarTablaAmbientesFisicosxPantalla() {
    codigopantalla = document.getElementById("hidPantalla").value;
    pathLink = "p1=mostrarTablaAmbientesFisicosxPantalla&p2=" + codigopantalla;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Div_tablaMantAmbienteFisicoxPantallas').update(respuesta);
        }
    })
}


//////////////funciones de giancarlo

//function tablaCie(){
//    patronModulo='tablaCie';
//    parametros='';
//    parametros+='p1='+patronModulo;
//
//    mygrid = new dhtmlXGridObject('tablaCie');
//    mygrid.setImagePath("../../../../fastmedical_front/imagen/icono/");
//    mygrid.setHeader("Column A, Column B,Columna C");
//    mygrid.setInitWidths("100,100,*");
//    mygrid.setColAlign("right,left,left");
//    mygrid.setColTypes("ro,ed,ro");
//    mygrid.setColSorting("str,str,str");
//    mygrid.setSkin("dhx_skyblue");
//    mygrid.init();
//    mygrid.loadXML(pathRequestControl+'?'+parametros);
//
//}

function tablaCie() {
    patronModulo = 'tablaCie';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    miTablaCie = new dhtmlXGridObject('tablaCie');
    miTablaCie.setImagePath("../../../../fastmedical_front/imagen/icono/");
    miTablaCie.attachEvent("onRowSelect", agregarAntecedente);
    miTablaCie.setSkin("dhx_skyblue");
    miTablaCie.init();
    miTablaCie.loadXML(pathRequestControl + '?' + parametros);
}

function agregarAntecedente(rowId, cellInd) {
    // $('imgPreguardarAntecedentes').src='../../../../fastmedical_front/imagen/btn/btn_preguardar.gif';
    //  $('div_botonPreguardar').show();

    var idCieAntecedente = rowId;//var idCieSintoma = miTablaSintoma.getSelectedId();
    var cadenaIdCieAntecedentes = document.getElementById("hdnCadenaIdCieAntecedentes").value;
    //Validacion para que en vista no agregue repetidos
    if ((cadenaIdCieAntecedentes.indexOf(idCieAntecedente + "|") == -1) && (cadenaIdCieAntecedentes.indexOf(idCieAntecedente) == -1)) {
        if (cadenaIdCieAntecedentes.length > 0)
            cadenaIdCieAntecedentes = cadenaIdCieAntecedentes + "|" + idCieAntecedente;
        else
            cadenaIdCieAntecedentes = idCieAntecedente;
        document.getElementById("hdnCadenaIdCieAntecedentes").value = cadenaIdCieAntecedentes;

        $('hNumeroAntecedentes').value = parseInt($('hNumeroAntecedentes').value) + 1;//Esto al inicio logica Junny
        nombreCie = miTablaCie.cells(rowId, 1).getValue();
        numeroAntecedente = $('hNumeroAntecedentes').value;
        var patronModulo = 'agregarAntecedente';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + numeroAntecedente;
        parametros += '&p3=' + nombreCie;
        parametros += '&p4=' + rowId;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                respuesta = transport.responseText;
                // $('divAntecedentes').innerHTML=$('divAntecedentes').innerHTML+respuesta;
                var para = document.getElementById("divAntecedentes");
                var s = respuesta;
                var range = document.createRange();
                range.selectNode(document.body);
                var documentFragment = range.createContextualFragment(s);
                para.appendChild(documentFragment);
                preguardarAntecedente();
            }
        })
    }
}

function cargaAntecedentes() {
    var codigoProgramacion = $('hcodigoProgramacion').value
    var c_cod_per = '';

    var patronModulo = 'antecedentes';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + c_cod_per;
    parametros += '&p3=' + codigoProgramacion;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Div_AntecedentesCuerpo').update(respuesta);
        //tablaCie();

        }
    })

}

function antecedentesPreguardados() {
    codigoProgramacion = $('hcodigoProgramacion').value
    patronModulo = 'antecedentesPreguardados';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoProgramacion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('divAntecedentes').update(respuesta);
        }
    })
}

function cerrarAntecedente(numeroAntecedente) {
    //0: creado, 1: eliminado en vista, 2: pregrabado en la BD, 3: grabado en la BD, 4:preguardado que fue modificado
    div = 'Div_Antecedente_' + numeroAntecedente;
    nombre = 'hEstadoAgregar_' + numeroAntecedente;
    $(nombre).value = '1';
    $(div).hide();

    var cadenaIdCieAntecedentes = document.getElementById("hdnCadenaIdCieAntecedentes").value;
    var idCieAntecedente = document.getElementById("hcie_" + numeroAntecedente).value;

    if (cadenaIdCieAntecedentes.indexOf(idCieAntecedente + "|") != -1) {
        cadenaIdCieAntecedentes = cadenaIdCieAntecedentes.replace(idCieAntecedente + "|", '');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
    }
    if (cadenaIdCieAntecedentes.indexOf(idCieAntecedente) != -1) {
        cadenaIdCieAntecedentes = cadenaIdCieAntecedentes.replace("|" + idCieAntecedente, '');//Eliminar de la cadena en el caso el elemento se encuentre al final
        cadenaIdCieAntecedentes = cadenaIdCieAntecedentes.replace(idCieAntecedente, '');//Eliminar de la cadena en el caso solo haya uno
    }
    document.getElementById("hdnCadenaIdCieAntecedentes").value = cadenaIdCieAntecedentes;
    preguardarAntecedente();
}

function buscarCieNombre(evento) {
    var nombre = $('textNombreCie').value;
    var numero = nombre.length;
    var patronModulo = 'tablaCie';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + nombre;
    var tecla = evento.keyCode
    if (numero == 4 || tecla == 13) {
        cn = 0;
        miTablaCie = new dhtmlXGridObject('tablaCie');
        miTablaCie.setImagePath("../../../../fastmedical_front/imagen/icono/");
        miTablaCie.attachEvent("onRowSelect", agregarAntecedente);
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador = contadorCargador;
        miTablaCie.attachEvent("onXLS", function() {
            cargadorpeche(1, idCargador);
        });
        miTablaCie.attachEvent("onXLE", function() {
            cargadorpeche(0, idCargador);
        });
        /////////////fin cargador ///////////////////////
        miTablaCie.setSkin("dhx_skyblue");
        miTablaCie.init();
        miTablaCie.loadXML(pathRequestControl + '?' + parametros, function() {
            cn = 1;
        });
    //setTimeout('x=1',1000);
    }
    if (numero > 4 && cn == 1) {
        //miTablaCie.filterBy(1,$('textNombreCie').value);
        var palabra = $('textNombreCie').value;
        var arrayPalabras = new Array();
        arrayPalabras = palabra.split(" ");
        var numeroPalabras = arrayPalabras.length;
        miTablaCie.filterBy(1, arrayPalabras[0]);
        for (var i = 1; i < numeroPalabras; i++) {
            miTablaCie.filterBy(1, arrayPalabras[i], true);
        }

    }


}
function buscarCieCodigo() {

    // miTablaCie.filterBy(0,codigo);

    //////////////////
    codigo = $('textCodigoCie').value;
    numero = codigo.length;
    patronModulo = 'tablaCie';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    parametros += '&p3=' + '3';  //para la busqueda de cie por codigo

    if (numero == 2) {
        cc = 0;
        miTablaCie = new dhtmlXGridObject('tablaCie');
        miTablaCie.setImagePath("../../../../fastmedical_front/imagen/icono/");
        miTablaCie.attachEvent("onRowSelect", agregarAntecedente);
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador = contadorCargador;
        miTablaCie.attachEvent("onXLS", function() {
            cargadorpeche(1, idCargador);
        });
        miTablaCie.attachEvent("onXLE", function() {
            cargadorpeche(0, idCargador);
        });
        /////////////fin cargador ///////////////////////
        miTablaCie.setSkin("dhx_skyblue");
        miTablaCie.init();
        miTablaCie.loadXML(pathRequestControl + '?' + parametros, function() {
            cc = 1;
        });
    //setTimeout('x=1',1000);
    }
    if (numero > 2 && cc == 1) {
        miTablaCie.filterBy(0, $('textCodigoCie').value);
    }
}

function preguardarAntecedente() {
    //$('imgPreguardarAntecedentes').src='../../../../fastmedical_front/imagen/btn/btn_preguardar_off.gif';
    var numeroAntecedentes = parseInt($('hNumeroAntecedentes').value);
    var patron = new Array();
    var parametros = new Array();
    var respuesta = new Array();
    var cadena = new Array();
    var i;
    var j;
    var hEstado;
    var numeroParentescos=14
    for (i = 1; i < numeroAntecedentes + 1; i++) {


        hEstado = 'hEstadoAgregar_' + i;
        //alert($(hEstado).value);
        if ($(hEstado).value == 0 || $(hEstado).value == 4 || $(hEstado).value == 1) {
            //alert($(hEstado).value);
            j = 1;
            cadena[i] = '';
            for(j=1;j<numeroParentescos+1;j++){
                if ($('checkParentesco_' + i + '_' + j))
                {
                    cadena[i] += j + '_' + $('checkParentesco_' + i + '_' + j).value + '_' + $('checkVive_' + i + '_' + j).value + '|';
                
                }  
            }
            
            patron[i] = 'preGrabarAntecedente';
            parametros[i] = '';
            parametros[i] += 'p1=' + patron[i];
            parametros[i] += '&p2=' + $('hcie_' + i).value;
            parametros[i] += '&p3=' + Base64.encode($('textObservacion_' + i).value);
            parametros[i] += '&p4=' + $('hcodigoProgramacion').value;
            parametros[i] += '&p5=' + cadena[i];
            parametros[i] += '&p6=' + $(hEstado).value;
            parametros[i] += '&p7=' + $('hIdAntecedente_' + i).value;
            contadorCargador++;
            var idCargador = contadorCargador;
            new Ajax.Request(pathRequestControl, {
                method: 'post',
                asynchronous: false,
                parameters: parametros[i],
                onLoading: cargadorpeche(1, idCargador),
                onComplete: function(transport) {
                    cargadorpeche(0, idCargador);
                    respuesta[i] = transport.responseText;
                    $('hIdAntecedente_' + i).value = respuesta[i];
                }
            })

            $(hEstado).value = 2;
        }
    }

}
function cambiarAntecedente(n) {
    // $('imgPreguardarAntecedentes').src='../../../../fastmedical_front/imagen/btn/btn_preguardar.gif';
    if ($('hEstadoAgregar_' + n).value == '2') {
        $('hEstadoAgregar_' + n).value = 4;
    }
    preguardarAntecedente();
}
function verAntecedentesAnteriores() {
    if ($('habierto').value == 0) {
        $('habierto').value = 1;
        $('icono_abrir').src = '../../../../fastmedical_front/imagen/icono/cerrarVentana.png';
        var codigoPaciente = $('htxtcodigopaciente').value;
        patronModulo = 'verAntecedentesAnteriores';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + codigoPaciente;
        $('divAntecedentesAnteriores').show();

        miTablaAntecedente = new dhtmlXGridObject('divAntecedentesAnteriores');
        miTablaAntecedente.setImagePath("../../../../fastmedical_front/imagen/icono/");
        // miTablaAntecedente.attachEvent("onRowSelect", agregarAntecedente);
        miTablaAntecedente.setSkin("dhx_skyblue");
        miTablaAntecedente.init();
        miTablaAntecedente.loadXML(pathRequestControl + '?' + parametros);
    } else {
        $('habierto').value = 0;
        $('divAntecedentesAnteriores').hide();
        $('icono_abrir').src = '../../../darxAtencionCompletada../fastmedical_front/imagen/icono/abrir.png';
    }

}

function clonarExamenes() {
    patronModulo = 'clonarExamenes';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            alert(respuesta);
        }
    })
}
function pasarProduccion() {
    patronModulo = 'pasarProduccion';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            alert(respuesta);
        }
    })
}

function accionesExamenes() {
    idVersion = $("cboVersion").value;
    descVersion = varname = $("cboVersion").options[$("cboVersion").selectedIndex].text;
    fechVersion = $("hidFechCreacionVersion").value;
    vestadoDesarrollo = $('stdDesarrollo').innerHTML;
    vformname = 'formBuscadorPersonas';
    vtitle = 'Acciones Versiones Estados';
    vwidth = '600'
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
    patronModulo = 'ventanaAccionesExamenes';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + idVersion;
    parametros += '&p3=' + descVersion;
    parametros += '&p4=' + fechVersion;
    parametros += '&p5=' + vestadoDesarrollo;

    posFuncion = 'verificarExisteDesarrollo';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)

}
function verificarExisteDesarrollo() {
    idVersion = $("cboVersion").value;
    descVersion = varname = $("cboVersion").options[$("cboVersion").selectedIndex].text;
    patronModulo = 'verificarExisteDesarrollo';
    parametros = '';
    parametros += 'p1=' + patronModulo + '&p2=' + idVersion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            array = respuesta.split("|");
            //            alert(array[0]);
            if (array[0] == 1) {
                if (array[1] == "disponible") {
                //mensajear se puede clonar
                } else {
                    stdBotones(2, descVersion);
                }
                stdBotones(1, descVersion);

            }
            else if (array[0] == 2) {
                //pasar a produccion
                stdBotones(2, descVersion);
            }
            else if (array[0] == 0) {
                if (array[1] == "disponible") {
                    //mensajear se puede clonar
                    stdBotones(3, descVersion);
                } else {
                    stdBotones(4, descVersion);
                }
            }
            else {
                stdBotones(5, "");
            }
        }
    })
}

function stdBotones(opt, descVersion) {
    switch (opt) {
        case 1:
            $("divUsarx").style.zIndex = 1002;
            $("divUsary").style.zIndex = 1003;
            $("divMsjUsar").innerHTML = "Esta  Versión " + descVersion + " , ya esta siendo Usada ...";
            break
        case 2:
            $("divEditarx").style.zIndex = 1002;
            $("divEditary").style.zIndex = 1003;
            $("divMsjEditar").innerHTML = "Esta  Versión " + descVersion + " , actualmente se encuentra en modo Edición ...";
            break
        case 3:
            $("divUsarx").style.zIndex = 1002;
            $("divUsary").style.zIndex = 1003;
            $("divEliminarx").style.zIndex = 1002;
            $("divEliminary").style.zIndex = 1003;
            $("divMsjUsar").innerHTML = "Esta  Versión " + descVersion + " , no puede ser Usada, sin antes haber sido Editado";
            $("divMsjEliminar").innerHTML = "Esta  Versión " + descVersion + " , esta Desactivado ...";
            break
        case 4:
            $("divUsarx").style.zIndex = 1002;
            $("divEditarx").style.zIndex = 1002;
            $("divEliminarx").style.zIndex = 1002;
            $("divUsary").style.zIndex = 1003;
            $("divEditary").style.zIndex = 1003;
            $("divEliminary").style.zIndex = 1003;
            $("divMensaje").innerHTML = "Esta Versión " + descVersion + " solo puede ser Editada, pero primero desactive la versión que se encuentra Editada";
            break
        case 5:
            $("divUsarx").style.zIndex = 1002;
            $("divEditarx").style.zIndex = 1002;
            $("divEliminarx").style.zIndex = 1002;
            $("divUsary").style.zIndex = 1003;
            $("divEditary").style.zIndex = 1003;
            $("divEliminary").style.zIndex = 1003;
            $("divMensaje").innerHTML = "Algunos datos de Versión son Inconsistentes ...!";
            break
    }
}


function vistaPreviaExamenes() {
    idExamen = $('hidIdExamen').value;
    version = $('cboVersion').value;
    vformname = 'vistaPrevia';
    vtitle = 'vista Previa';
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
    patronModulo = 'vistaPrevia';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + version;
    parametros += '&p3=' + idExamen;
    posFuncion = '';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)

}



function accionesVersion(accion) {
    idVersion = $("cboVersion").value;
    patronModulo = 'accionesVersion';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + accion;
    parametros += '&p3=' + idVersion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            examenesFisicos();
        }
    })
}


function validaIntegers(evento, elemento, dato) {
    if (evento == '') {
        tecla = 13;
    } else {
        tecla = evento.keyCode
    }
    valor = elemento.value;
    longitud = valor.length;
    ultimoCaracter = valor.substr(valor.length - 1, valor.length);
    //alert(ultimoCaracter);
    if (("0123456789").indexOf(ultimoCaracter) == -1) {
        elemento.value = valor.substr(0, valor.length - 1);
    }
}

function validaDecimal(evento, elemento, dato) {
    if (evento == '') {
        tecla = 13;
    } else {
        tecla = evento.keyCode
    }
    valor = elemento.value;
    longitud = valor.length;
    ultimoCaracter = valor.substr(valor.length - 1, valor.length);
    if (ultimoCaracter == '.') {
        if (valor.substr(0, valor.length - 1).indexOf(ultimoCaracter) != -1) {
            elemento.value = valor.substr(0, valor.length - 1);
        }
    }
    //alert(ultimoCaracter);
    if (("0123456789.").indexOf(ultimoCaracter) == -1) {
        elemento.value = valor.substr(0, valor.length - 1);
    }
}

function preguardarPruebaCorregido(idPrueba) {
    //alert(idPrueba);
    if (idPrueba == 6) {//Evolucion de la version actual, no se debe agregar nuevas versiones, se debe dejar alli
        //valorCampo_6_1
        textoEvolucion = trimJunny($('valorCampo_6_1').value);
        if (textoEvolucion.length < 50) {
            alert("Ingrese como m\xEDnimo 50 caracteres\nen la evoluci\xF3n");
        }
        else {
            // $('imgPreguardarPrueba'+idPrueba).src='../../../../fastmedical_front/imagen/btn/btn_preguardar_off.gif';
            iCodigoProgramacion = $('hcodigoProgramacion').value;
            numeroCampos = parseInt($('numeroCampos_' + idPrueba).value);
            cadenaCampos = '';
            cadenaEstados = '';
            cadenaIdCampos = '';
            cadenaTipoCampo = '';
            cadenaCampoPrueba = '';
            arrayCamposAfectados = new Array();//array de los campos afectados
            iIdVersion = $('hdnIdVersion').value;
            n = 0;
            for (i = 1; i < numeroCampos + 1; i++) {
                idValorCampo = 'valorCampo_' + idPrueba + '_' + i;
                idEstadoCampo = 'estadoCampo_' + idPrueba + '_' + i;
                idCampoExamen = 'idCampoExamen_' + idPrueba + '_' + i;
                idTipoCampo = 'idTipoCampo_' + idPrueba + '_' + i;
                campoPrueba = 'campoPrueba_' + idPrueba + '_' + i;
                //si el estado es nuevo y diferente de null o el estado es editado
                if (($(idEstadoCampo).value == '' && $(idValorCampo).value != '') || $(idEstadoCampo).value == 4) {
                    cadenaCampos = cadenaCampos + $(idValorCampo).value + '|';
                    cadenaEstados = cadenaEstados + $(idEstadoCampo).value + '|';
                    cadenaIdCampos = cadenaIdCampos + $(idCampoExamen).value + '|';
                    cadenaTipoCampo = cadenaTipoCampo + $(idTipoCampo).value + '|';
                    cadenaCampoPrueba = cadenaCampoPrueba + $(campoPrueba).value + '|';
                    arrayCamposAfectados[n] = i;
                    n++;
                }

            }
            //alert(cadenaCampos);

            cadenaCampos = cadenaCampos.replace(/'/gi, "\'\'");
            cadenaCamposCodificada = Base64.encode(cadenaCampos);
            //alert(cadenaCamposCodificada);
            if (n != 0) {
                patronModulo = 'preguardarExamenes';
                parametros = '';
                parametros += 'p1=' + patronModulo;
                parametros += '&p2=' + cadenaCamposCodificada;  //contiene los valores ingresados por el usuario
                parametros += '&p3=' + cadenaEstados; //contiene los estados de los campos
                parametros += '&p4=' + cadenaIdCampos; //contiene los idCampoExamen ya guardados o preguardados
                parametros += '&p5=' + cadenaTipoCampo; //contiene los tipo de campos
                parametros += '&p6=' + cadenaCampoPrueba;//contiene los id de los campos
                parametros += '&p7=' + iCodigoProgramacion; //es el codigo de la programacion
                parametros += '&p8=' + iIdVersion; //contiene la version
                new Ajax.Request(pathRequestControl, {
                    method: 'get',
                    asynchronous: false,
                    parameters: parametros,
                    onLoading: micargador(1),
                    onComplete: function(transport) {
                        micargador(0);
                        respuesta = transport.responseText;
                        //alert(respuesta);
                        arrayRespuesta = respuesta.split("|")
                        numero = arrayRespuesta.length - 1;
                        for (j = 0; j < numero; j++) {
                            idCampoExamen = 'idCampoExamen_' + idPrueba + '_' + arrayCamposAfectados[j];
                            idEstadoCampo = 'estadoCampo_' + idPrueba + '_' + arrayCamposAfectados[j];
                            $(idEstadoCampo).value = 2;
                            $(idCampoExamen).value = arrayRespuesta[j];
                        }
                    }
                })
            }
        }
    }
    else {
        // $('imgPreguardarPrueba'+idPrueba).src='../../../../fastmedical_front/imagen/btn/btn_preguardar_off.gif';
        iCodigoProgramacion = $('hcodigoProgramacion').value;
        numeroCampos = parseInt($('numeroCampos_' + idPrueba).value);
        cadenaCampos = '';
        cadenaEstados = '';
        cadenaIdCampos = '';
        cadenaTipoCampo = '';
        cadenaCampoPrueba = '';
        arrayCamposAfectados = new Array();//array de los campos afectados
        iIdVersion = $('hdnIdVersion').value;
        n = 0;
        for (i = 1; i < numeroCampos + 1; i++) {
            idValorCampo = 'valorCampo_' + idPrueba + '_' + i;
            idEstadoCampo = 'estadoCampo_' + idPrueba + '_' + i;
            idCampoExamen = 'idCampoExamen_' + idPrueba + '_' + i;
            idTipoCampo = 'idTipoCampo_' + idPrueba + '_' + i;
            campoPrueba = 'campoPrueba_' + idPrueba + '_' + i;
            //si el estado es nuevo y diferente de null o el estado es editado
            if (($(idEstadoCampo).value == '' && $(idValorCampo).value != '') || $(idEstadoCampo).value == 4) {
                cadenaCampos = cadenaCampos + $(idValorCampo).value + '|';
                cadenaEstados = cadenaEstados + $(idEstadoCampo).value + '|';
                cadenaIdCampos = cadenaIdCampos + $(idCampoExamen).value + '|';
                cadenaTipoCampo = cadenaTipoCampo + $(idTipoCampo).value + '|';
                cadenaCampoPrueba = cadenaCampoPrueba + $(campoPrueba).value + '|';
                arrayCamposAfectados[n] = i;
                n++;
            }

        }
        //alert(cadenaCampos);

        cadenaCampos = cadenaCampos.replace(/'/gi, "\'\'");
        cadenaCamposCodificada = Base64.encode(cadenaCampos);
        //alert(cadenaCamposCodificada);
        if (n != 0) {
            patronModulo = 'preguardarExamenes';
            parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + cadenaCamposCodificada;  //contiene los valores ingresados por el usuario
            parametros += '&p3=' + cadenaEstados; //contiene los estados de los campos
            parametros += '&p4=' + cadenaIdCampos; //contiene los idCampoExamen ya guardados o preguardados
            parametros += '&p5=' + cadenaTipoCampo; //contiene los tipo de campos
            parametros += '&p6=' + cadenaCampoPrueba;//contiene los id de los campos
            parametros += '&p7=' + iCodigoProgramacion; //es el codigo de la programacion
            parametros += '&p8=' + iIdVersion; //contiene la version
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                asynchronous: false,
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function(transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    //alert(respuesta);
                    arrayRespuesta = respuesta.split("|")
                    numero = arrayRespuesta.length - 1;
                    for (j = 0; j < numero; j++) {
                        idCampoExamen = 'idCampoExamen_' + idPrueba + '_' + arrayCamposAfectados[j];
                        idEstadoCampo = 'estadoCampo_' + idPrueba + '_' + arrayCamposAfectados[j];
                        $(idEstadoCampo).value = 2;
                        $(idCampoExamen).value = arrayRespuesta[j];
                    }
                }
            })
        }
    }
}

function preguardarPrueba(idPrueba) {
    //alert(idPrueba);
    if (idPrueba == 6) {//Evolucion de la version actual, no se debe agregar nuevas versiones, se debe dejar alli
        //valorCampo_6_1
        textoEvolucion = trimJunny($('valorCampo_6_1').value);
        if (textoEvolucion.length < 50) {
            alert("Ingrese como m\xEDnimo 50 caracteres\nen la evoluci\xF3n");
        }
        else {
            //$('imgPreguardarPrueba'+idPrueba).src='../../../../fastmedical_front/imagen/btn/btn_preguardar_off.gif';
            iCodigoProgramacion = $('hcodigoProgramacion').value;
            numeroCampos = parseInt($('numeroCampos_' + idPrueba).value);
            cadenaCampos = '';
            cadenaEstados = '';
            cadenaIdCampos = '';
            cadenaTipoCampo = '';
            cadenaCampoPrueba = '';
            arrayCamposAfectados = new Array();//array de los campos afectados
            iIdVersion = $('hdnIdVersion').value;
            n = 0;
            for (i = 1; i < numeroCampos + 1; i++) {
                idValorCampo = 'valorCampo_' + idPrueba + '_' + i;
                idEstadoCampo = 'estadoCampo_' + idPrueba + '_' + i;
                idCampoExamen = 'idCampoExamen_' + idPrueba + '_' + i;
                idTipoCampo = 'idTipoCampo_' + idPrueba + '_' + i;
                campoPrueba = 'campoPrueba_' + idPrueba + '_' + i;
                //si el estado es nuevo y diferente de null o el estado es editado
                if (($(idEstadoCampo).value == '' && $(idValorCampo).value != '') || $(idEstadoCampo).value == 4) {
                    cadenaCampos = cadenaCampos + $(idValorCampo).value + '|';
                    cadenaEstados = cadenaEstados + $(idEstadoCampo).value + '|';
                    cadenaIdCampos = cadenaIdCampos + $(idCampoExamen).value + '|';
                    cadenaTipoCampo = cadenaTipoCampo + $(idTipoCampo).value + '|';
                    cadenaCampoPrueba = cadenaCampoPrueba + $(campoPrueba).value + '|';
                    arrayCamposAfectados[n] = i;
                    n++;
                }

            }
            //alert(cadenaCampos);

            cadenaCampos = cadenaCampos.replace(/'/gi, "\'\'");
            cadenaCamposCodificada = Base64.encode(cadenaCampos);
            //alert(cadenaCamposCodificada);
            if (n != 0) {
                patronModulo = 'preguardarExamenes';
                parametros = '';
                parametros += 'p1=' + patronModulo;
                parametros += '&p2=' + cadenaCamposCodificada;  //contiene los valores ingresados por el usuario
                parametros += '&p3=' + cadenaEstados; //contiene los estados de los campos
                parametros += '&p4=' + cadenaIdCampos; //contiene los idCampoExamen ya guardados o preguardados
                parametros += '&p5=' + cadenaTipoCampo; //contiene los tipo de campos
                parametros += '&p6=' + cadenaCampoPrueba;//contiene los id de los campos
                parametros += '&p7=' + iCodigoProgramacion; //es el codigo de la programacion
                parametros += '&p8=' + iIdVersion; //contiene la version
                new Ajax.Request(pathRequestControl, {
                    method: 'get',
                    asynchronous: false,
                    parameters: parametros,
                    onLoading: micargador(1),
                    onComplete: function(transport) {
                        micargador(0);
                        respuesta = transport.responseText;
                        //alert(respuesta);
                        arrayRespuesta = respuesta.split("|")
                        numero = arrayRespuesta.length - 1;
                        for (j = 0; j < numero; j++) {
                            idCampoExamen = 'idCampoExamen_' + idPrueba + '_' + arrayCamposAfectados[j];
                            idEstadoCampo = 'estadoCampo_' + idPrueba + '_' + arrayCamposAfectados[j];
                            $(idEstadoCampo).value = 2;
                            $(idCampoExamen).value = arrayRespuesta[j];
                        }
                    }
                })
            }
        }
    }
    else {
        //$('imgPreguardarPrueba'+idPrueba).src='../../../../fastmedical_front/imagen/btn/btn_preguardar_off.gif';
        iCodigoProgramacion = $('hcodigoProgramacion').value;
        numeroCampos = parseInt($('numeroCampos_' + idPrueba).value);
        cadenaCampos = '';
        cadenaEstados = '';
        cadenaIdCampos = '';
        cadenaTipoCampo = '';
        cadenaCampoPrueba = '';
        arrayCamposAfectados = new Array();//array de los campos afectados
        iIdVersion = $('hdnIdVersion').value;
        n = 0;
        for (i = 1; i < numeroCampos + 1; i++) {
            idValorCampo = 'valorCampo_' + idPrueba + '_' + i;
            idEstadoCampo = 'estadoCampo_' + idPrueba + '_' + i;
            idCampoExamen = 'idCampoExamen_' + idPrueba + '_' + i;
            idTipoCampo = 'idTipoCampo_' + idPrueba + '_' + i;
            campoPrueba = 'campoPrueba_' + idPrueba + '_' + i;
            //si el estado es nuevo y diferente de null o el estado es editado
            if (($(idEstadoCampo).value == '' && $(idValorCampo).value != '') || $(idEstadoCampo).value == 4) {
                cadenaCampos = cadenaCampos + $(idValorCampo).value + '|';
                cadenaEstados = cadenaEstados + $(idEstadoCampo).value + '|';
                cadenaIdCampos = cadenaIdCampos + $(idCampoExamen).value + '|';
                cadenaTipoCampo = cadenaTipoCampo + $(idTipoCampo).value + '|';
                cadenaCampoPrueba = cadenaCampoPrueba + $(campoPrueba).value + '|';
                arrayCamposAfectados[n] = i;
                n++;
            }

        }
        //alert(cadenaCampos);

        cadenaCampos = cadenaCampos.replace(/'/gi, "\'\'");
        cadenaCamposCodificada = Base64.encode(cadenaCampos);
        //alert(cadenaCamposCodificada);
        if (n != 0) {
            patronModulo = 'preguardarExamenes';
            parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + cadenaCamposCodificada;  //contiene los valores ingresados por el usuario
            parametros += '&p3=' + cadenaEstados; //contiene los estados de los campos
            parametros += '&p4=' + cadenaIdCampos; //contiene los idCampoExamen ya guardados o preguardados
            parametros += '&p5=' + cadenaTipoCampo; //contiene los tipo de campos
            parametros += '&p6=' + cadenaCampoPrueba;//contiene los id de los campos
            parametros += '&p7=' + iCodigoProgramacion; //es el codigo de la programacion
            parametros += '&p8=' + iIdVersion; //contiene la version
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                asynchronous: false,
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function(transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    //alert(respuesta);
                    arrayRespuesta = respuesta.split("|")
                    numero = arrayRespuesta.length - 1;
                    for (j = 0; j < numero; j++) {
                        idCampoExamen = 'idCampoExamen_' + idPrueba + '_' + arrayCamposAfectados[j];
                        idEstadoCampo = 'estadoCampo_' + idPrueba + '_' + arrayCamposAfectados[j];
                        $(idEstadoCampo).value = 2;
                        $(idCampoExamen).value = arrayRespuesta[j];
                    }
                }
            })
        }
    }
//Base64.encode(datos);
//alert(cadenaCampos);
//alert(cadenaEstados);
}
function cambioEstado(idCampoEstado) {
    //alert(idCampoEstado);
    var m = idCampoEstado.lastIndexOf('_');
    var idPrueba = idCampoEstado.substring(12, m);

    //$('imgPreguardarPrueba'+idPrueba).src='../../../../fastmedical_front/imagen/btn/btn_preguardar.gif';
    var estado = $(idCampoEstado).value;
    if (estado == 2) {
        $(idCampoEstado).value = 4;
    }
    preguardarPrueba(idPrueba);
}


function cargarHC() {
    //$('divHC_cuerpo').show();
    var codigoPaciente = $('htxtcodigopaciente').value;
    //    alert(codigoPaciente)
    var patronModulo = 'verHC';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoPaciente;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('divHC_cuerpo').update(respuesta);
            document.getElementById("divDerechaVerHC").style.overflow = 'auto';
            arbolHCFechas(codigoPaciente);
        }
    })
}
function obtenerCodigoPaciente() {
    codigopersona = $('txtCodigoPersona').value;
    patronModulo = 'obtenerCodigoPaciente';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigopersona;
    codigoPaciente = traerData(parametros);
    $("htxtcodigopaciente").value = codigoPaciente[0];
    cargarHCPacientes(codigoPaciente[0]);
}
function cargarHCPacientes(idPaciente) {
    patronModulo = 'verHC';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + idPaciente;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('historia_paciente').update(respuesta);
            arbolHCFechas(idPaciente);
        }
    })
}
function clickArbolHC(id) {
    var patron = /-|_/i;         //i, en caso de letras le indica que mayuscula o minuscula es indiferente
    if (id.search(patron) == -1) {   //-1  significa que (-,_)no se encuentran en la cadena
        //alert(id);
        verHistoriaFecha(id);
    }
}
function verHistoriaFecha(id) {
    patronModulo = 'verHCxDia';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + id; //id--> codigo de programacion

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('divDerechaVerHC').update(respuesta);
        }
    })
}
function arbolHCFechas(codigopaciente) {
    var p = "p1=arbolHCFechas";
    p += '&p2=' + codigopaciente;
    var funcionClick = "clickArbolHC";
    var div = "divIzquierdaAbajoVerHC";
    generarArbolx(div, p, funcionClick);
}
function tipoDeVista() {
    var id = $("cboPor").value;
    if (id == 0) {
        var codigopaciente = $("htxtcodigopaciente").value;
        document.getElementById("divDerechaVerHC").innerHTML = "";
        this.arbolHCFechas(codigopaciente);
    }
    else if (id == 1) {
        document.getElementById("divDerechaVerHC").innerHTML = "";
        var p = "p1=arbolHCItems";
        var funcionClick = "clickArbolHCItems";
        var div = "divIzquierdaAbajoVerHC";
        generarArbolx(div, p, funcionClick);
    }
}
function clickArbolHCItems(id, text) {
    var codigopaciente = $("htxtcodigopaciente").value;
    //    alert(codigopaciente);
    var destino = "divDerechaVerHC";
    var funcion = "";
    if (id == 8) {
        //alert("laboratorio");
        funcion = "tablaLaboratorioHc";
    }
    var parametros = "p1=verHCxItemes";
    parametros += '&p2=' + id + '&p3=' + text + '&p4=' + codigopaciente;
    enviarFormulario("", parametros, funcion, destino);
    //    alert("ehhhehehe"+text);
    if ($('Detalle') != null) {
        $('Detalle').hide();
    }
    if ($('Detalle2') != null) {
        $('Detalle2').hide();
    }
//$('Detalle2').hide();
}



/********************funciones de luis***********************/
/***********************ATENCION MEDICA HC****************************/
function cargaPreguardados() {
    cargaTratamientosMedicamentososPreguardados();
    cargaTratamientosPracticasMedicasPreguardados();
    cargaDiagnosticosPreguardados();
}

function iniciarActoMedico(codigoProgramacion) {

    var estadoatencion = document.getElementById("htxtestadoatencion").value;
    var codigopaciente = document.getElementById("htxtcodigopaciente").value;
    var codigoservicio = document.getElementById("htxtcodigoservicio").value;
    //alert(estadoatencion);
    if (estadoatencion == '0004') {
        reiniciarDatosDiagnosticos();
    }

    var patronModulo = 'cargaFiliacionActoMedico';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoProgramacion;
    parametros += '&p3=' + codigopaciente;
    parametros += '&p4=' + codigoservicio;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            respuesta = transport.responseText;
            $('Div_filiacionHC').update(respuesta);
            //            codigoAfiliacion = document.getElementById("htxtcodigoafiliacion").value;
            if (estadoatencion == '0004' || estadoatencion == '0007') {
            }
            else {
                verHcReciente(codigoProgramacion);
            }
        }
    })
}
function cargaFiliacionActoMedico() {
    //tablaProductosTratamientosHC();//Esto es de LUIS
    //tablaPracticasMedicasTratamientosHC();//Esto es de LUIS
    //cargaDiagnosticos();//Carga tabla CIE
    cargaPreguardados();//cargaTratamientosMedicamentososPreguardados(); cargaTratamientosPracticasMedicasPreguardados(); cargaDiagnosticosPreguardados();
    cargarTriaje();
// cargaFechaVencimientoRecetaMedica();
}
function cargaFechaVencimientoRecetaMedica() {
    idProgramacion = $('hcodigoProgramacion').value;
    patronModulo = 'cargaFechaVencimientoRecetaMedica';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + idProgramacion;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            respuesta = transport.responseText;
            $("txtfechavencimientoreceta").value = respuesta;
        }
    })
}
function abrirDiv(nombreDiv) {
    if (document.getElementById(nombreDiv).style.display == 'none') {
        $(nombreDiv).show();
        $(nombreDiv + "icono").src = '../../../../fastmedical_front/imagen/icono/plegar.png';
        $(nombreDiv + "icono").title = 'Desplegar';
    }
    else {
        $(nombreDiv).hide();
        $(nombreDiv + "icono").src = '../../../../fastmedical_front/imagen/icono/desplegar.png';
        $(nombreDiv + "icono").title = 'Plegar';
    }
}

function abrirDivSimple(nombreDiv) {
    if (document.getElementById(nombreDiv).style.display == 'none') {
        $(nombreDiv).show();
    }
    else {
        $(nombreDiv).hide();
    }
}
function verHcReciente() {
    $('Div_HCReciente').show();
    idProgramacion = $('hcodigoProgramacion').value;
    patronModulo = 'verHCReciente';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + idProgramacion;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Div_HCRecienteContenido').update(respuesta);
        //            document.getElementById("divDerechaVerHC").style.overflow='auto';
        }
    })
}
function regresarAgendaMedica() {
    $("Div_GeneralActoMedicoHC").hide();
    $("Div_GeneralActoMedico").show();
    menuActoMedicoConsultorio();
}
function cancelarAtencionMedica() {
    //    var zindex=maximozindex();
    //    alert (zindex);
    if (window.confirm("¿Desea cancelar la Atención Médica?")) {

        idProgramacion = $('hcodigoProgramacion').value;
        patronModulo = 'regresarAgendaMedicaActoMedico';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + idProgramacion;

        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                reiniciarDatosDiagnosticos();
                tablaPacienteProgramados.clearSelection();
                tablaPacienteAdicionales.clearSelection();
                $("Div_GeneralActoMedicoHC").hide();
                $("Div_GeneralActoMedico").show();
                mostrarprogramacionMedicosActoMedico();
            }
        })

    }
}

function tablaProductosTratamientosHC() {

    //$('Div_TratamientoRecetaMedicaHC').innerHTML = "";

    var contadorDivsMedicamentos = 0;
    var patronModulo = 'tablaProductosTratamientosHC';
    var parametronombremedicamento = '';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + parametronombremedicamento;

    tablaProductosTratamientos = new dhtmlXGridObject('Div_TablaTratamientoMedicamentosoHC');
    tablaProductosTratamientos.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaProductosTratamientos.setSkin("dhx_skyblue");
    //tablaProductosTratamientos.attachEvent("onRowSelect", agregarMedicamentoHC);
    tablaProductosTratamientos.attachEvent("onRowSelect", function(rId, cInd) {
        agregarMedicamentoHC(rId, cInd, '');
    });
    tablaProductosTratamientos.init();
    tablaProductosTratamientos.loadXML(pathRequestControl + '?' + parametros);
}

function agregarMedicamentoHC(rowId, cellInd, data) {
    //var nombre='nombre Medicamento'
    var divAumentar = 'divRecetaGeneral'
    var nroReceta;
    var elemento;
    var existe = 0;
    var numeroProducto = 1;
    var nombreMedicamento;
    var codigoProducto;
    var presentacion;
    var numeroRecetas;
    var stock;

    nroReceta = $('nroReceta').value;
    if (cellInd == 4) {
        //alert('pece')
        nombreMedicamento = tablaProductosTratamientos.cells(rowId, 1).getValue();
        codigoProducto = tablaProductosTratamientos.cells(rowId, 0).getValue();
        mostrarPreciosAtencionMedica(codigoProducto, nombreMedicamento);
    } else {

        var cantidadRecetas = $('hcantidadRecetas').value;
        if (cantidadRecetas >= (nroReceta - 1)) {
            if (data == '') {
                codigoProducto = tablaProductosTratamientos.cells(rowId, 0).getValue();
                elemento = document.getElementById('hAgregados_' + nroReceta)
                if (elemento != null) {

                    if ($('hAgregados_' + nroReceta).value.indexOf(codigoProducto) != -1) {
                        return;
                    }
                }

                stock = tablaProductosTratamientos.cells(rowId, 3).getValue();
                if (stock == 0) {
                    if (!window.confirm("¿El Producto no cuenta con Stock en almacén desea Continuar?")) {
                        return;
                    }
                }

                nroReceta = $('nroReceta').value;
                elemento = document.getElementById('divReceta_' + nroReceta);


                if (elemento == null) {//verificamos si existe un div para la receta
                    divAumentar = 'divRecetaGeneral'
                    existe = 0;
                    numeroRecetas = $('hcantidadRecetas').value;
                    numeroRecetas++;
                    $('hcantidadRecetas').value = numeroRecetas;
                }
                else {
                    divAumentar = 'divReceta_' + nroReceta;
                    existe = 1;
                    numeroProducto = $('hNumeroProductos_' + nroReceta).value;
                    numeroProducto++;
                    $('hNumeroProductos_' + nroReceta).value = numeroProducto;
                // alert('si existe');
                }
                nombreMedicamento = tablaProductosTratamientos.cells(rowId, 1).getValue();

                presentacion = tablaProductosTratamientos.cells(rowId, 2).getValue();
            } else {
                var arreglo = data.split("|");
                nroReceta = arreglo[0];
                elemento = document.getElementById('divReceta_' + nroReceta);
                if (elemento == null) {//verificamos si existe un div para la receta
                    divAumentar = 'divRecetaGeneral'
                    numeroRecetas = $('hcantidadRecetas').value;
                    numeroRecetas++;
                    $('hcantidadRecetas').value = numeroRecetas;
                } else {
                    divAumentar = 'divReceta_' + nroReceta;
                    existe = 1;
                    numeroProducto = $('hNumeroProductos_' + nroReceta).value;
                    numeroProducto++;
                    $('hNumeroProductos_' + nroReceta).value = numeroProducto;
                // alert('si existe');
                }
                nombreMedicamento = arreglo[1];
                codigoProducto = arreglo[2];
                presentacion = arreglo[3];
                //alert(data)
                if (codigoProducto == '') {
                    nombreMedicamento = arreglo[7];
                    codigoProducto = '0000000';
                    presentacion = arreglo[8];
                }

            }




            var patronModulo = 'agregarMedicamentoHC';
            var parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + existe;
            parametros += '&p3=' + nroReceta;
            parametros += '&p4=' + Base64.encode(nombreMedicamento);
            parametros += '&p5=' + codigoProducto;
            parametros += '&p6=' + presentacion;
            parametros += '&p7=' + numeroProducto;

            contadorCargador++;
            var idCargador = contadorCargador;
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                asynchronous: false,
                parameters: parametros,
                onLoading: cargadorpeche(1, idCargador),
                onComplete: function(transport) {
                    cargadorpeche(0, idCargador);
                    var respuesta = transport.responseText;
                    var para = document.getElementById(divAumentar);
                    var s = respuesta;
                    var range = document.createRange();
                    range.selectNode(document.body);
                    var documentFragment = range.createContextualFragment(s);
                    para.appendChild(documentFragment);

                    $('hAgregados_' + nroReceta).value = $('hAgregados_' + nroReceta).value + '|' + codigoProducto
                    if (data != '') {
                        // alert('peche1');
                        $('hreceta_' + nroReceta).value = arreglo[4];
                        $('hIdTratamiento_' + nroReceta + '_' + numeroProducto).value = arreglo[5];
                        $('cantidad_' + nroReceta + '_' + numeroProducto).value = arreglo[6];
                        if (codigoProducto == '0000000') {
                            $('dosis_' + nroReceta + '_' + numeroProducto).value = trimJunny(arreglo[9]);
                            $('fechaVencimiento_' + nroReceta).value = arreglo[10];
                        } else {
                            $('dosis_' + nroReceta + '_' + numeroProducto).value = trimJunny(arreglo[7]);
                            $('fechaVencimiento_' + nroReceta).value = arreglo[8];
                        }


                        //alert(data);
                        var factual = new Date();
                        //alert(arreglo[8])
                        var arrayFecha = $('fechaVencimiento_' + nroReceta).value.split("/");
                        var fechaLimite = new Date(arrayFecha[2], arrayFecha[1] - 1, arrayFecha[0]);
                        //alert(fechaLimite);
                        var diferencia = -factual.getTime() + fechaLimite.getTime();
                        var dias = Math.floor(diferencia / (1000 * 60 * 60 * 24)) + 1
                        $('diasValidos_' + nroReceta).value = dias;

                    }

                }
            })
        } else {
            cantidadRecetas++;
            alert('la receta nro:' + cantidadRecetas + ' aun no ha sido registrada')
        }
    }
}

function duplicarReceta(numeroReceta) {
    var numeroRecetaAux = parseInt($('hcantidadRecetas').value);
    var idReceta = $('hreceta_' + numeroReceta).value;


    // alert(numeroRecetaAux)
    var patronModulo = 'duplicarReceta';

    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + idReceta;
    parametros += '&p3=' + numeroRecetaAux;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            eval(respuesta);
        }
    })
}
function preguardarRectaMedica(idReceta, idProducto) {

    var tipoReceta = 1;
    var iIdReceta = $('hreceta_' + idReceta).value;
    var dFechaVencimiento = $('fechaVencimiento_' + idReceta).value;
    var idTratamiento = $('hIdTratamiento_' + idReceta + '_' + idProducto).value;
    var c_cod_ser_pro = $('hcodigoProducto_' + idReceta + '_' + idProducto).value;
    var iCantidad = $('cantidad_' + idReceta + '_' + idProducto).value;
    var vModoAplicacion;//=$('dosis_'+idReceta+'_'+idProducto).value;
    var patronModulo = 'preguardarRectaMedica';
    var codigoProgramacion = $('hcodigoProgramacion').value;
    if (c_cod_ser_pro == '0000000') {
        vModoAplicacion = $('hOtros_' + idReceta + '_' + idProducto).value + '|' + $('hOtrosPresentacion_' + idReceta + '_' + idProducto).value;
        vModoAplicacion = vModoAplicacion + '|' + $('dosis_' + idReceta + '_' + idProducto).value;
    } else {
        vModoAplicacion = $('dosis_' + idReceta + '_' + idProducto).value;
    }


    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iIdReceta;
    parametros += '&p3=' + dFechaVencimiento;
    parametros += '&p4=' + trimJunny(idTratamiento);
    parametros += '&p5=' + c_cod_ser_pro;
    parametros += '&p6=' + iCantidad;
    parametros += '&p7=' + Base64.encode(vModoAplicacion);
    parametros += '&p8=' + tipoReceta;
    parametros += '&p9=' + trimJunny(codigoProgramacion);


    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            //$(divReemplazar).update(respuesta);
            var arreglo = respuesta.split("|");
            $('hreceta_' + idReceta).value = arreglo[0];
            $('hIdTratamiento_' + idReceta + '_' + idProducto).value = arreglo[1];


        }
    })
}
function creaReceta(nombrediv) {
    var divPadre = document.getElementById("Div_TablaTratamientoMedicamentos");
    var divnuevo = document.createElement("div");
    divnuevo.setAttribute("id", nombrediv);
    divnuevo.style.width = '95%';
    divPadre.appendChild(divnuevo);
}
function eliminarMedicamentoHC(numeroReceta, numeroProducto, opcion) {

    //window.alert(document.getElementById("\'"+codigoMedicamento+"\'").value);
    if (opcion == 1) {
        if (!window.confirm("¿Desea eliminar el producto de la Receta Medica?")) {
            return;
        }
    }


    var idTratamiento = $('hIdTratamiento_' + numeroReceta + '_' + numeroProducto).value;
    var patronModulo = 'eliminarMedicamentoRecetaMedicaHC';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + idTratamiento;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('divProducto_' + numeroReceta + '_' + numeroProducto).hide();
            var codigoProducto = $('hcodigoProducto_' + numeroReceta + '_' + numeroProducto).value;
            var cadenaProducto = $('hAgregados_' + numeroReceta).value;
            cadenaProducto = cadenaProducto.replace(codigoProducto, '');
            $('hAgregados_' + numeroReceta).value = cadenaProducto;

        }
    })

}
function eliminarReceta(numeroReceta) {
    var cantidad = $('hNumeroProductos_' + numeroReceta).value;
    var i;
    // $('divReceta_'+numeroReceta).hide();
    for (i = 1; i <= cantidad; i++) {
        //alert(i)
        eliminarMedicamentoHC(numeroReceta, i, 0)
    }
// $('divReceta_'+numeroReceta).hide();
}

function tablaPracticasMedicasTratamientosHC() {
    // $('Div_TratamientoRecetaMedicaHC').innerHTML = "";
    contadorDivsPracticaMedica = 0;
    var patronModulo = 'tablaPracticasMedicasTratamientosHC';
    var parametronombrepracticamedica = '';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + parametronombrepracticamedica;

    tablaPracticasMedicasTratamientos = new dhtmlXGridObject('Div_TablaTratamientoPracticasMedicasHC');
    tablaPracticasMedicasTratamientos.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaPracticasMedicasTratamientos.setSkin("dhx_skyblue");
    tablaPracticasMedicasTratamientos.attachEvent("onRowSelect", agregarPracticaMedicaHC);
    tablaPracticasMedicasTratamientos.init();
    tablaPracticasMedicasTratamientos.loadXML(pathRequestControl + '?' + parametros);
}

function agregarPracticaMedicaHC(rowId, cellInd, data) {
    //$('imgPreguardarTratatamientoPracticasMedicas').src='../../../../fastmedical_front/imagen/btn/btn_preguardar.gif';
    if (data == undefined) {
        codigopracticamedica = tablaPracticasMedicasTratamientos.cells(rowId, 0).getValue();
        descripcionpracticamedica = tablaPracticasMedicasTratamientos.cells(rowId, 1).getValue();
        if (cellInd == 3) {
            mostrarPreciosAtencionMedica(codigopracticamedica, descripcionpracticamedica);
        } else {

            numerodivpracticamedica = contadorDivsPracticaMedica;
            nombre = Base64.encode(descripcionpracticamedica);
            idtratamiento = '';
            modoaplicacion = '';
            estadoregistro = '0';
            codigosegus = tablaPracticasMedicasTratamientos.cells(rowId, 2).getValue();

        }
    }
    else {
        //data=Base64.decode(data);
        arreglo = data.split("|");
        // alert(arreglo);
        codigopracticamedica = arreglo[1];
        descripcionpracticamedica = arreglo[2];
        numerodivpracticamedica = contadorDivsPracticaMedica;
        //Ya no es necesario codificarlo porque ya viene codificado
        nombre = descripcionpracticamedica;//Base64.encode(descripcionpracticamedica);
        idtratamiento = arreglo[0];
        modoaplicacion = arreglo[3];
        //modoaplicacion = Base64.encode(arreglo[3]);
        estadoregistro = arreglo[4];
        codigosegus = arreglo[5];
        if (codigosegus == '') {
            codigosegus = '----';
        }

    }
    var codigos = document.getElementById("htxtcodigosServicios").value;
    if (cellInd != 3) {
        if ($('contadorBK')){
            
            if (codigopracticamedica=='XXXX200301'){
                if ($('txtNumeroDiasSintomatico').value>=15){
                    if ($('contadorBK').value<2){
                        if (codigos.length > 0) {
                            codigos = codigos + "|" + codigopracticamedica;
                        }
                        else {
                            codigos = codigopracticamedica;
                        }
                        document.getElementById("htxtcodigosServicios").value = codigos;
                        var estado1 = 0;
                        var patronModulo = 'agregarPracticaMedicaHC';
                        var parametros = '';
                        parametros += 'p1=' + patronModulo;
                        parametros += '&p2=' + nombre;
                        parametros += '&p3=' + numerodivpracticamedica;
                        parametros += '&p4=' + codigopracticamedica;
                        parametros += '&p5=' + idtratamiento;
                        parametros += '&p6=' + modoaplicacion;
                        parametros += '&p7=' + estadoregistro;
                        parametros += '&p8=' + codigosegus;
                        parametros += '&p9=' + estado1;
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
                                nombrediv = "Div_PracticaMedica" + numerodivpracticamedica;
                                creaPracticaMedica(nombrediv);
                                $(nombrediv).innerHTML = respuesta;
                                contadorDivsPracticaMedica++;
                                $('hNumeroTratamientoPracticasMedicas').value = parseInt($('hNumeroTratamientoPracticasMedicas').value) + 1;
                                $('contadorBK').value++;
                                $('txtNumeroBK').value=$('txtNumeroBK').value+numerodivpracticamedica+'|';
                                preguardarTratatamientoPracticasMedicas();
                                if ($('contadorBK').value==1){
                                    
                                    $('div_btnGenerarOrdenDK').update('1 Orden Generada');
                                }else{
                                    $('div_btnGenerarOrdenDK').addClassName('btnReportes1');
                                    $('div_btnGenerarOrdenDK').update('2 Ordenes Generadas');
                                }
                            //document.getElementById("hNumeroTratamientoPracticasMedicas").value = contadorDivsPracticaMedica;
                            }
                        })
                    }
                }
            }
        }
        if (!((codigos.indexOf(codigopracticamedica + "|") != -1) || (codigos.indexOf(codigopracticamedica) != -1))) {
            if (codigos.length > 0) {
                codigos = codigos + "|" + codigopracticamedica;
            }
            else {
                codigos = codigopracticamedica;
            }
            document.getElementById("htxtcodigosServicios").value = codigos;
            var estado1 = 0;
            var patronModulo = 'agregarPracticaMedicaHC';
            var parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + nombre;
            parametros += '&p3=' + numerodivpracticamedica;
            parametros += '&p4=' + codigopracticamedica;
            parametros += '&p5=' + idtratamiento;
            parametros += '&p6=' + modoaplicacion;
            parametros += '&p7=' + estadoregistro;
            parametros += '&p8=' + codigosegus;
            parametros += '&p9=' + estado1;
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
                    nombrediv = "Div_PracticaMedica" + numerodivpracticamedica;
                    creaPracticaMedica(nombrediv);
                    $(nombrediv).innerHTML = respuesta;
                    contadorDivsPracticaMedica++;
                    $('hNumeroTratamientoPracticasMedicas').value = parseInt($('hNumeroTratamientoPracticasMedicas').value) + 1;
                    preguardarTratatamientoPracticasMedicas();
                //document.getElementById("hNumeroTratamientoPracticasMedicas").value = contadorDivsPracticaMedica;
                }
            })
        }
    }
}
function creaPracticaMedica(nombrediv) {
    var divPadre = document.getElementById("Div_TratamientoPracticasHC");
    var divnuevo = document.createElement("div");
    divnuevo.setAttribute("id", nombrediv);
    divPadre.appendChild(divnuevo);
}
function tablaPreciosTratamientoAtencionMedica(codigo) {
    patronModulo = 'obtenerPreciosAtencionMedica';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    tablaPreciosAtencionMedicaTratamiento = new dhtmlXGridObject('Div_tablapreciosProductosServicios');
    tablaPreciosAtencionMedicaTratamiento.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaPreciosAtencionMedicaTratamiento.setSkin("dhx_skyblue");
    //tablaPreciosAtencionMedicaTratamiento.attachEvent("onRowSelect", agregarPracticaMedicaHC);
    tablaPreciosAtencionMedicaTratamiento.init();
    tablaPreciosAtencionMedicaTratamiento.loadXML(pathRequestControl + '?' + parametros);
}
function CargarVentanaPreciosAtencionMedica(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
{
    myRand = parseInt(Math.random() * 999999999999999);
    if (vwidth == undefined || vwidth == 0)
        vwidth = 700;
    if (vheight == undefined || vheight == 0)
        vheight = 400;
    if (vposx1 == undefined || vposx1 == 0)
        vposx1 = 25;
    if (vposy1 == undefined || vposy1 == 0)
        vposy1 = 110;
    if (vposx2 == undefined || vposx2 == 0)
        vposx2 = 25;
    if (vposy2 == undefined || vposy2 == 0)
        vposy2 = 110;

    if (vresizable == undefined || vresizable == 0)
        vresizable = true;
    else
        vresizable = false;
    if (vstyle == undefined || vstyle == 0)
        vstyle = "alphacube";   // fondo y estilo
    //if(veffect==veffect || veffect==0) veffect="popup_effect";
    if (vmodal == undefined || vmodal == 0)
        vmodal = false;
    else
        vmodal = true;
    if (vopacity == undefined || vopacity == 0)
        vopacity = 1;
    if (vcenter == undefined || vcenter == 0 || vcenter == 't')
        vcenter = true;
    else
        vcenter = false;
    if (vtitle == undefined)
        vtitle = vformname;
    if (!ExisteObjeto("Div_" + vformname))
    {
        var vidfrm;
        // file02=decodeURIComponent(file02);
        var vid = "Div_" + vformname;
        vidfrm = "Frm_" + vformname;
        var vzindex = 100;
        var win;
        if (vmodal == true || vmodal == 1)
            win = new Window({
                id: vid,
                className: vstyle,
                title: vtitle,
                width: vwidth,
                height: vheight,
                zIndex: vzindex,
                opacity: vopacity,
                resizable: vresizable
            });
        else
            win = new Window({
                id: vid,
                className: vstyle,
                title: vtitle,
                width: vwidth,
                height: vheight,
                resizable: vresizable
            });
        win.getContent().innerHTML = "<div id='" + vidfrm + "'></div>";
        //win.getContent().innerHTML = "<h1>No Constraint</h1>Wired mode<br><a href='#' onclick='Windows.getWindow(\"win3\").maximize()'>Maximize me</a>";
        win.setDestroyOnClose();
        if (vcenter == true || vcenter == 1)
            win.showCenter(vmodal);
        else
            win.show(vmodal);
        win.setConstraint(true, {
            left: vposx1,
            right: vposx2,
            top: vposy1,
            bottom: 'auto'
        })
        win.toFront();

        new Ajax.Request(pathRequestControl,
        {
            method: 'get',
            parameters: parametros,
            onComplete: function(transport) {
                respuesta = transport.responseText;
                $(vidfrm).update(respuesta);
                eval(posFuncion);
            }
        }
        )
    }
}
function mostrarPreciosAtencionMedica(codigo, descripcion) {
    titulo = 'Precios Atencion Medica'
    vFormaAbrir = 'VENTANA'
    vformname = 'PreciosAtencionMedica'
    vtitle = 'Precios Atencion Medica'
    vwidth = '520'
    vheight = '400'
    patronModulo = 'mostrarPreciosAtencionMedica';
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
    parametros += '&p2=' + encodeURIComponent(descripcion);
    //parametros=encodeURIComponent(parametros);
    posFuncion = "tablaPreciosTratamientoAtencionMedica('" + codigo + "')";
    CargarVentanaPreciosAtencionMedica(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)

}
function eliminarPracticaMedicaHC(nombreDiv, codigoServicio, numeroPracticaMedica) {
    // $(nombreDiv).hide();//Ocultamos el hidden
    var codigos = document.getElementById("htxtcodigosServicios").value;
    if (codigos.indexOf(codigoServicio + "|") != -1) {
        codigos = codigos.replace(codigoServicio + "|", '');
    }
    if (codigos.indexOf(codigoServicio) != -1) {
        codigos = codigos.replace("|" + codigoServicio, '');
        codigos = codigos.replace(codigoServicio, '');
    }
    if ($('Div_Sintomatico')){
        if ($('txtNumeroBK').value.indexOf(numeroPracticaMedica+"|")!=-1) {
            $('txtNumeroBK').value = $('txtNumeroBK').value.replace(numeroPracticaMedica+"|",'');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
        }
        if ($('txtNumeroBK').value.indexOf(numeroPracticaMedica)!=-1) {
            $('txtNumeroBK').value = $('txtNumeroBK').value.replace("|"+numeroPracticaMedica,'');//Eliminar de la cadena en el caso el elemento se encuentre al final
            $('txtNumeroBK').value = $('txtNumeroBK').value.replace(numeroPracticaMedica,'');//Eliminar de la cadena en el caso solo haya uno
        }
        document.getElementById("txtNumeroBK").value = $('txtNumeroBK').value;
                            
        $('contadorBK').value=  $('contadorBK').value-1;
        $('div_btnGenerarOrdenDK').removeClassName('btnReportes1');
        if ( $('contadorBK').value==1){
            $('div_btnGenerarOrdenDK').update('Generar 1 Orden BK');
        }else{
            $('div_btnGenerarOrdenDK').update('Generar 2 Ordenes BK');
        }
    }

    
    document.getElementById("hEstadoAgregarTratamientoPracticaMedica_" + numeroPracticaMedica).value = 1;
    //alert(numeroPracticaMedica);
    document.getElementById("htxtcodigosServicios").value = codigos;
    preguardarTratatamientoPracticasMedicas();
    $(nombreDiv).hide();//Ocultamos el hidden
    
}


function validarTratamientoMedicamentoso() {
    var color = '#F27F7D';
    var todoOK = 1;
    var numeroRecetas = parseInt($('hcantidadRecetas').value);
    var productosReceta;

    for (var i = 1; i <= numeroRecetas; i++) {

        productosReceta = $('hNumeroProductos_' + i).value;

        for (var j = 1; j <= productosReceta; j++) {

            if ($('divProducto_' + i + '_' + j).style.display != 'none') {


                if (trimJunny($('hcodigoProducto_' + i + '_' + j).value) == '0000000') {
                    if (trimJunny($('hOtros_' + i + '_' + j).value) == 'otros') {
                        alert('Ingrese Nuevo Producto');
                        todoOK = -1;
                        $('hOtros_' + i + '_' + j).setStyle({
                            background: color

                        });
                        break;
                    }
                    if (trimJunny($('hOtrosPresentacion_' + i + '_' + j).value) == 'otros') {
                        alert('Ingrese la Presentacion del nuevo producto');
                        todoOK = -2;
                        $('hOtrosPresentacion_' + i + '_' + j).setStyle({
                            background: color

                        });
                        break;
                    }
                }
                if (trimJunny($('cantidad_' + i + '_' + j).value) == '') {
                    alert('ingresar Cantidad');
                    todoOK = -3;
                    $('cantidad_' + i + '_' + j).setStyle({
                        background: color

                    });
                    break;
                }
                if (trimJunny($('dosis_' + i + '_' + j).value) == '') {
                    alert('ingresar las indicaciones');
                    todoOK = -4;
                    $('dosis_' + i + '_' + j).setStyle({
                        background: color

                    });
                    break;
                }
            }

        }
        if (todoOK != 1) {
            break;
        }
    }
    return todoOK;
}

function validaryPreguardarTratamientoMedicamentoso() {

    var rptaValidacion = validarTratamientoMedicamentoso();

    if (rptaValidacion == -1) {
        window.alert("Falta ingresar nombre de medicamento!!!");
    }
    else {
        if (rptaValidacion == -2) {
            window.alert("Falta ingresar presentaci\xF3n del medicamento!!!");
        }
        else {
            if (rptaValidacion == -3) {
                window.alert("Falta ingresar cantidad del medicamento!!!");
            }
            else {
                if (rptaValidacion == -4) {
                    window.alert("Falta ingresar las indicaciones del medicamento!!!");
                }
                else {
                    if (rptaValidacion == 1) {//Todo OK
                        preguardarTratatamientoMedicamentosoCorregido();
                    }
                }
            }
        }
    }
}

function preguardarTratatamientoMedicamentosoCorregido() {
    var numtratamientomedicamentoso = parseInt($('hNumeroTratamientoMedicamentoso').value);
    var patron = new Array();
    var parametros = new Array();
    var respuesta = new Array();
    var cadena = new Array();

    for (i = 0; i < numtratamientomedicamentoso; i++) {
        hEstado = 'hEstadoAgregarTratamientoMedicamentoso_' + i;
        tipodosis = 0;
        if ($("Div_Receta" + i).style.display != 'none') {
            if ($(hEstado).value == 0 || $(hEstado).value == 4) {
                if ($('hcodigoMedicamento_' + i).value == '0000000') {
                    observaciones = Base64.encode(($('otromedicamentonombre_' + i).value).toUpperCase() + "|" + ($('otromedicamentopresentacion_' + i).value).toUpperCase() + "|" + $('txtcantidadmedicamento_' + i).value + "|" + $('txtareaObservacionMedicamento_' + i).value);
                } else {
                    observaciones = Base64.encode($('txtareaObservacionMedicamento_' + i).value);
                }
                patron[i] = 'preGrabarTratatamientoMedicamentoso';
                parametros[i] = '';
                parametros[i] += 'p1=' + patron[i];
                parametros[i] += '&p2=' + $('hcodigoMedicamento_' + i).value;
                parametros[i] += '&p3=' + observaciones;
                parametros[i] += '&p4=' + $('hcodigoProgramacion').value;
                parametros[i] += '&p5=' + $(hEstado).value;
                parametros[i] += '&p6=' + $('hIdTratamientoMedicamentoso_' + i).value;
                parametros[i] += '&p7=' + $('txtcantidadmedicamento_' + i).value;
                parametros[i] += '&p8=' + tipodosis;

                new Ajax.Request(pathRequestControl, {
                    method: 'get',
                    asynchronous: false,
                    parameters: parametros[i],
                    onLoading: micargador(1),
                    onComplete: function(transport) {
                        micargador(0);
                        respuesta[i] = transport.responseText;

                        $('hIdTratamientoMedicamentoso_' + i).value = trimJunny(respuesta[i]);
                    }
                })

                $(hEstado).value = 2;
            }

        }
    }
//preguardarFechaVencimientoReceta();
// $('imgPreguardarTratatamientoMedicamentoso').src='../../../../fastmedical_front/imagen/btn/btn_preguardar_off.gif';
}

function preguardarTratatamientoMedicamentoso() {
    //alert('holsd');

    numerotratamientomedicamentoso = parseInt($('hNumeroTratamientoMedicamentoso').value);
    var patron = new Array();
    var parametros = new Array();
    var respuesta = new Array();
    var cadena = new Array();

    //if(numerotratamientomedicamentoso>0){
    //Valida datos ingresados...
    for (i = 0; i < numerotratamientomedicamentoso; i++) {
        if ($("Div_Receta" + i).style.display != 'none') {
            if ($('hcodigoMedicamento_' + i).value == '0000000') {
                if ($('otromedicamentonombre_' + i).value == '') {
                    window.alert("Falta ingresar nombre de medicamento!!")
                    return
                }
                if ($('otromedicamentopresentacion_' + i).value == '') {
                    window.alert("Falta ingresar presentación del medicamento '" + $('otromedicamentonombre_' + i).value + "'");
                    return
                }
                if ($('txtcantidadmedicamento_' + i).value == '') {
                    window.alert("Falta ingresar cantidad del medicamento '" + $('otromedicamentonombre_' + i).value + "'");
                    return
                }
                if ($('txtareaObservacionMedicamento_' + i).value == '') {
                    window.alert("Falta ingresar las indicaciones del medicamento '" + $('otromedicamentonombre_' + i).value + "'");
                    return
                }
            }
            if ($('txtcantidadmedicamento_' + i).value == '') {
                window.alert("La CANTIDAD TOTAL del medicamento "
                    + $($('hcodigoMedicamento_' + i).value).innerHTML
                    + " no ha sido ingresado!!!")
                return
            }
            if ($('txtareaObservacionMedicamento_' + i).value == '') {
                window.alert("Las INDICACIONES del medicamento "
                    + $($('hcodigoMedicamento_' + i).value).innerHTML
                    + " no ha sido ingresado!!!")
                return
            }

        }
    }
    //    if($('txtfechavencimientoreceta').value == ''){
    //        window.alert("Ingrese la fecha de vencimiento de la Receta Unica");
    //        return;
    //    }
    for (i = 0; i < numerotratamientomedicamentoso; i++) {
        hEstado = 'hEstadoAgregarTratamientoMedicamentoso_' + i;
        //alert(i);
        //        if($('lstTipoDosis_'+i).value == '0000') tipodosis = 0;
        //        else tipodosis = $('lstTipoDosis_'+i).value;
        tipodosis = 0;
        if ($("Div_Receta" + i).style.display != 'none') {
            if ($(hEstado).value == 0 || $(hEstado).value == 4) {
                if ($('hcodigoMedicamento_' + i).value == '0000000') {
                    observaciones = Base64.encode(($('otromedicamentonombre_' + i).value).toUpperCase() + "|" + ($('otromedicamentopresentacion_' + i).value).toUpperCase() + "|" + $('txtcantidadmedicamento_' + i).value + "|" + $('txtareaObservacionMedicamento_' + i).value);
                } else {
                    observaciones = Base64.encode($('txtareaObservacionMedicamento_' + i).value);
                }
                patron[i] = 'preGrabarTratatamientoMedicamentoso';
                parametros[i] = '';
                parametros[i] += 'p1=' + patron[i];
                parametros[i] += '&p2=' + $('hcodigoMedicamento_' + i).value;
                parametros[i] += '&p3=' + observaciones;
                parametros[i] += '&p4=' + $('hcodigoProgramacion').value;
                parametros[i] += '&p5=' + $(hEstado).value;
                parametros[i] += '&p6=' + $('hIdTratamientoMedicamentoso_' + i).value;
                parametros[i] += '&p7=' + $('txtcantidadmedicamento_' + i).value;
                parametros[i] += '&p8=' + tipodosis;

                new Ajax.Request(pathRequestControl, {
                    method: 'get',
                    asynchronous: false,
                    parameters: parametros[i],
                    onLoading: micargador(1),
                    onComplete: function(transport) {
                        micargador(0);
                        respuesta[i] = transport.responseText;

                        $('hIdTratamientoMedicamentoso_' + i).value = respuesta[i];
                    }
                })

                $(hEstado).value = 2;
            }

        }
    }
// preguardarFechaVencimientoReceta();
//$('imgPreguardarTratatamientoMedicamentoso').src='../../../../fastmedical_front/imagen/btn/btn_preguardar_off.gif';
}

function preguardarFechaVencimientoReceta() {
    var codigoProgramacion = $('hcodigoProgramacion').value
    var fechavencimiento = $("txtfechavencimientoreceta").value;
    var patronModulo = 'preguardarFechaVencimientoReceta';

    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoProgramacion;
    parametros += '&p3=' + fechavencimiento;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            respuesta = transport.responseText;
        }
    })
}

function preguardarTratatamientoPracticasMedicas(estado) {
    //$('imgPreguardarTratatamientoPracticasMedicas').src='../../../../fastmedical_front/imagen/btn/btn_preguardar_off.gif';

    if (estado == undefined) {
        estado = 0;
    }

    var numerotratamientomedicamentoso = parseInt($('hNumeroTratamientoPracticasMedicas').value);
    var codigos = document.getElementById("htxtcodigosServicios").value;
    var patron = new Array();
    var parametros = new Array();
    var respuesta = new Array();
    var cadena = new Array();
    var hEstado;

    //if(numerotratamientomedicamentoso>0){
    for (var i = 0; i < numerotratamientomedicamentoso; i++) {
        hEstado = 'hEstadoAgregarTratamientoPracticaMedica_' + i;
        //alert(i);

        //Solo debe guardar los divs que son visibles
        if ($("Div_PracticaMedica" + i).style.display != 'none') {
            if ($(hEstado).value == 0 || $(hEstado).value == 4 || $(hEstado).value == 1) {

                if ($('hcodigoPracticaMedica_' + i).value == '0000000') {
                    observaciones = Base64.encode("OTROS" + "|" + $("txtareaObservacionPracticaMedica_" + i).value);
                } else {
                    observaciones = Base64.encode($("txtareaObservacionPracticaMedica_" + i).value);
                }
                patron[i] = 'preGrabarTratatamientoPracticaMedica';
                parametros[i] = '';
                parametros[i] += 'p1=' + patron[i];
                parametros[i] += '&p2=' + $('hcodigoPracticaMedica_' + i).value;
                //parametros[i]+='&p3='+Base64.encode($('txtareaObservacionPracticaMedica_'+i).value);
                parametros[i] += '&p3=' + observaciones;
                parametros[i] += '&p4=' + $('hcodigoProgramacion').value;
                parametros[i] += '&p5=' + $(hEstado).value;
                parametros[i] += '&p6=' + $('hIdTratamientoPracticaMedica_' + i).value;
                parametros[i] += '&p7=' + estado;
                //codigopracticamedica = $('hcodigoPracticaMedica_'+i).value;
                //if ((codigos.indexOf(codigopracticamedica+"|")!=-1)||(codigos.indexOf(codigopracticamedica)!=-1)){
                new Ajax.Request(pathRequestControl, {
                    method: 'get',
                    asynchronous: false,
                    parameters: parametros[i],
                    onLoading: micargador(1),
                    onComplete: function(transport) {
                        micargador(0);
                        respuesta[i] = transport.responseText;
                        // alert(respuesta[i]);
                        if (respuesta[i] == 'elimi') {
                            $(hEstado).value = 1;
                        } else {
                            $('hIdTratamientoPracticaMedica_' + i).value = respuesta[i];

                            $(hEstado).value = 2;
                        }

                    }
                })


            //}
            }
        }
    }
//}else{
//    window.alert("No hay prácticas médicas agregadas")
//}
}
function cambiarEstadoTratamientoMedicamentoso(n) {
    // $('imgPreguardarTratatamientoMedicamentoso').src='../../../../fastmedical_front/imagen/btn/btn_preguardar.gif';

    if ($('hEstadoAgregarTratamientoMedicamentoso_' + n).value == '2') {
        $('hEstadoAgregarTratamientoMedicamentoso_' + n).value = 4;
    }
    preguardarTratatamientoMedicamentosoCorregido();
}
function cambiarEstadoTratamientoPracticasMedicas(n) {
    // $('imgPreguardarTratatamientoPracticasMedicas').src='../../../../fastmedical_front/imagen/btn/btn_preguardar.gif';

    if ($('hEstadoAgregarTratamientoPracticaMedica_' + n).value == '2') {
        $('hEstadoAgregarTratamientoPracticaMedica_' + n).value = 4;
        preguardarTratatamientoPracticasMedicas();
    }

}
function cambiarFechaVencimientoRecetaUnica() {
// $('imgPreguardarTratatamientoMedicamentoso').src='../../../../fastmedical_front/imagen/btn/btn_preguardar.gif';
}
/*----------busquedas---------*/

function busquedaTratamientoMedicamentosoNombre(evento) {

    var parametronombre = $('txtbusquedaNombreTratamientoMedicamentoso').value;
    var numero = parametronombre.length;
    var accion = 2;
    var afiliacion = $('htxtcodigoafiliacion').value;
    var patronModulo = 'tablaProductosTratamientosHC';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + parametronombre;
    parametros += '&p3=' + accion;
    parametros += '&p4=' + afiliacion;
    var tecla = evento.keyCode
    if (numero == 4 || tecla == 13) {
        tmn = 0;
        tablaProductosTratamientos = new dhtmlXGridObject('Div_TablaTratamientoMedicamentosoHC');
        tablaProductosTratamientos.setImagePath("../../../../fastmedical_front/imagen/icono/");
        //tablaProductosTratamientos.attachEvent("onRowSelect", agregarMedicamentoHC);
        tablaProductosTratamientos.attachEvent("onRowSelect", function(rId, cInd) {
            agregarMedicamentoHC(rId, cInd, '');
        });
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador = contadorCargador;
        tablaProductosTratamientos.attachEvent("onXLS", function() {
            cargadorpeche(1, idCargador);
        });
        tablaProductosTratamientos.attachEvent("onXLE", function() {
            cargadorpeche(0, idCargador);
        });
        /////////////fin cargador ///////////////////////
        tablaProductosTratamientos.setSkin("dhx_skyblue");
        tablaProductosTratamientos.init();
        tablaProductosTratamientos.loadXML(pathRequestControl + '?' + parametros, function() {
            tmn = 1;
        });
    //miTablaCie.clearAll();loadXML
    }
    if (numero > 4 && tmn == 1) {
        var palabra = $('txtbusquedaNombreTratamientoMedicamentoso').value;
        var arrayPalabras = new Array();
        arrayPalabras = palabra.split(" ");
        var numeroPalabras = arrayPalabras.length;
        tablaProductosTratamientos.filterBy(1, arrayPalabras[0]);
        for (var i = 1; i < numeroPalabras; i++) {
            tablaProductosTratamientos.filterBy(1, arrayPalabras[i], true);
        }
    }
}

function buscarTratamientoMedicamentosoCodigo() {
    //codigo=$('txtbusquedaCodigoTratamientoMedicamentoso').value;
    //tablaProductosTratamientos.filterBy(0,codigo);

    var codigo = $('txtbusquedaCodigoTratamientoMedicamentoso').value;
    var numero = codigo.length;
    var accion = 5;
    var afiliacion = $('htxtcodigoafiliacion').value;
    var patronModulo = 'tablaProductosTratamientosHC';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    parametros += '&p3=' + accion;
    parametros += '&p4=' + afiliacion;

    if (numero == 3) {
        tmc = 0;
        tablaProductosTratamientos = new dhtmlXGridObject('Div_TablaTratamientoMedicamentosoHC');
        tablaProductosTratamientos.setImagePath("../../../../fastmedical_front/imagen/icono/");
        //tablaProductosTratamientos.attachEvent("onRowSelect", agregarMedicamentoHC);
        tablaProductosTratamientos.attachEvent("onRowSelect", function(rId, cInd) {
            agregarMedicamentoHC(rId, cInd, '');
        });
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador = contadorCargador;
        tablaProductosTratamientos.attachEvent("onXLS", function() {
            cargadorpeche(1, idCargador);
        });
        tablaProductosTratamientos.attachEvent("onXLE", function() {
            cargadorpeche(0, idCargador);
        });
        /////////////fin cargador ///////////////////////
        tablaProductosTratamientos.setSkin("dhx_skyblue");
        tablaProductosTratamientos.init();
        tablaProductosTratamientos.loadXML(pathRequestControl + '?' + parametros, function() {
            tmc = 1;
        });
    //miTablaCie.clearAll();loadXML
    }
    if (numero > 3 && tmc == 1) {
        //alert('jjjjj');
        tablaProductosTratamientos.filterBy(0, $('txtbusquedaCodigoTratamientoMedicamentoso').value);
    }
}                                                                                  // *****************************************************
function busquedaTratamientoPracticaNombre(evento) {                                             ///////revizar****************************
    var accion = 3;
    var afiliacion = $('htxtcodigoafiliacion').value;
    var parametronombre = $('txtbusquedaNombrePracticasMedicas').value;
    var numero = parametronombre.length;
    var patronModulo = 'tablaPracticasMedicasTratamientosHC';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + parametronombre;
    parametros += '&p3=' + accion;
    parametros += '&p4=' + afiliacion;
    var tecla = evento.keyCode
    if (numero == 4 || tecla == 13) {
        tmp = 0;
        tablaPracticasMedicasTratamientos = new dhtmlXGridObject('Div_TablaTratamientoPracticasMedicasHC');
        tablaPracticasMedicasTratamientos.setImagePath("../../../../fastmedical_front/imagen/icono/");
        tablaPracticasMedicasTratamientos.attachEvent("onRowSelect", agregarPracticaMedicaHC);
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador = contadorCargador;
        tablaPracticasMedicasTratamientos.attachEvent("onXLS", function() {
            cargadorpeche(1, idCargador);
        });
        tablaPracticasMedicasTratamientos.attachEvent("onXLE", function() {
            cargadorpeche(0, idCargador);
        });
        /////////////fin cargador ///////////////////////
        tablaPracticasMedicasTratamientos.setSkin("dhx_skyblue");
        tablaPracticasMedicasTratamientos.init();
        tablaPracticasMedicasTratamientos.loadXML(pathRequestControl + '?' + parametros, function() {
            tmp = 1;
        });
    //miTablaCie.clearAll();
    }
    if (numero > 4 && tmp == 1) {
        //tablaPracticasMedicasTratamientos.filterBy(1,$('txtbusquedaNombrePracticasMedicas').value);
        var palabra = $('txtbusquedaNombrePracticasMedicas').value;
        var arrayPalabras = new Array();
        arrayPalabras = palabra.split(" ");
        var numeroPalabras = arrayPalabras.length;
        tablaPracticasMedicasTratamientos.filterBy(1, arrayPalabras[0]);
        for (var i = 1; i < numeroPalabras; i++) {
            tablaPracticasMedicasTratamientos.filterBy(1, arrayPalabras[i], true);
        }


    }
}

function buscarTratamientoPracticaCodigo() {


    ///////////////////////////////////////////
    var codigo = $('txtbusquedaCodigoPracticasMedicas').value;
    var numero = codigo.length;
    var accion = 6;
    var afiliacion = $('htxtcodigoafiliacion').value;
    var patronModulo = 'tablaPracticasMedicasTratamientosHC';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    parametros += '&p3=' + accion;
    parametros += '&p4=' + afiliacion;
    if (numero == 3) {
        tmpc = 0;
        tablaPracticasMedicasTratamientos = new dhtmlXGridObject('Div_TablaTratamientoPracticasMedicasHC');
        tablaPracticasMedicasTratamientos.setImagePath("../../../../fastmedical_front/imagen/icono/");
        tablaPracticasMedicasTratamientos.attachEvent("onRowSelect", agregarPracticaMedicaHC);
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador = contadorCargador;
        tablaPracticasMedicasTratamientos.attachEvent("onXLS", function() {
            cargadorpeche(1, idCargador);
        });
        tablaPracticasMedicasTratamientos.attachEvent("onXLE", function() {
            cargadorpeche(0, idCargador);
        });
        /////////////fin cargador ///////////////////////
        tablaPracticasMedicasTratamientos.setSkin("dhx_skyblue");
        tablaPracticasMedicasTratamientos.init();
        tablaPracticasMedicasTratamientos.loadXML(pathRequestControl + '?' + parametros, function() {
            tmpc = 1;
        });
    //miTablaCie.clearAll();
    }
    if (numero > 3 && tmpc == 1) {
        tablaPracticasMedicasTratamientos.filterBy(0, $('txtbusquedaCodigoPracticasMedicas').value);
    }
}
/*-------------------------------------------------------------------------------*/
function cargaTratamientosMedicamentososPreguardados() {
    var codigoProgramacion = $('hcodigoProgramacion').value
    //alert($('hcodigoProgramacion').value)
    var patronModulo = 'cargaTratamientosMedicamentososPreguardados';

    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoProgramacion;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            eval(respuesta);
        }
    })
}

function cargaFechaVencimientoReceta(fechavencimiento) {
    $('txtfechavencimientoreceta').value = fechavencimiento;
}
function cargaTratamientosPracticasMedicasPreguardados() {
    contadorDivsPracticaMedica = 0;
    var codigoProgramacion = $('hcodigoProgramacion').value
    //alert($('hcodigoProgramacion').value)
    var patronModulo = 'cargaTratamientosPracticasMedicasPreguardados';

    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoProgramacion;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            //window.alert(respuesta);
            eval(respuesta);
        }
    })
}



/*-------------------------Consultas Anteriores-------------------------*/
function verRecetasAnteriores() {
    if ($('habiertoRecetasAnteriores').value == 0) {
        $('habiertoRecetasAnteriores').value = 1;
        $('icono_abrirRecetasAnteriores').src = '../../../../fastmedical_front/imagen/icono/cerrarVentana.png';
        var codigopaciente = $('htxtcodigopaciente').value;
        var tipotratamiento = '1';
        var patronModulo = 'verTratamientosAnteriores';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + codigopaciente;
        parametros += '&p3=' + tipotratamiento;
        $('Div_RecetasAnteriores').show();

        tablaRecetasAnteriores = new dhtmlXGridObject('Div_RecetasAnteriores');
        tablaRecetasAnteriores.setImagePath("../../../../fastmedical_front/imagen/icono/");
        tablaRecetasAnteriores.attachEvent("onRowSelect", verReceta);
        tablaRecetasAnteriores.setSkin("dhx_skyblue");
        tablaRecetasAnteriores.init();
        tablaRecetasAnteriores.loadXML(pathRequestControl + '?' + parametros);
    }
    else {
        $('habiertoRecetasAnteriores').value = 0;
        $('Div_RecetasAnteriores').hide();
        $('icono_abrirRecetasAnteriores').src = '../../../../fastmedical_front/imagen/icono/abrir.png';
    }

}
function verReceta(rowId, cellInd) {
    if (cellInd == 7) {
        var idtratamiento = this.cells(rowId, 0).getValue();
        mostrarTratamientoAnterior(idtratamiento);

    }
}
function verPracticasMedicasAnteriores() {
    if ($('habiertoPracticasMedicasAnteriores').value == 0) {
        $('habiertoPracticasMedicasAnteriores').value = 1;
        $('icono_abrirPracticasMedicasAnteriores').src = '../../../../fastmedical_front/imagen/icono/cerrarVentana.png';
        codigopaciente = $('htxtcodigopaciente').value;
        tipotratamiento = '2';
        patronModulo = 'verTratamientosAnteriores';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + codigopaciente;
        parametros += '&p3=' + tipotratamiento;
        $('Div_PracticasMedicasAnteriores').show();

        tablaPracticasMedicasAnteriores = new dhtmlXGridObject('Div_PracticasMedicasAnteriores');
        tablaPracticasMedicasAnteriores.setImagePath("../../../../fastmedical_front/imagen/icono/");
        tablaPracticasMedicasAnteriores.attachEvent("onRowSelect", verReceta);
        tablaPracticasMedicasAnteriores.setSkin("dhx_skyblue");
        tablaPracticasMedicasAnteriores.init();
        tablaPracticasMedicasAnteriores.loadXML(pathRequestControl + '?' + parametros);
    } else {
        $('habiertoPracticasMedicasAnteriores').value = 0;
        $('Div_PracticasMedicasAnteriores').hide();
        $('icono_abrirPracticasMedicasAnteriores').src = '../../../../fastmedical_front/imagen/icono/abrir.png';
    }
}

function mostrarTratamientoAnterior(idtratamiento) {
    titulo = 'Consulta de Recetas'
    vFormaAbrir = 'VENTANA'
    vformname = 'RecetaAnteriorMedica'
    vtitle = 'Receta Anterior Medica'
    vwidth = '520'
    vheight = '350'
    patronModulo = 'mostrarVentanaTratamientoAnterior';
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
    parametros += '&p2=' + idtratamiento;
    posFuncion = '';
    //posFuncion="tablaPreciosTratamientoAtencionMedica('"+codigo+"')";
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
}


////*******************************DIAGNOSTICOS******************************************////

function reiniciarDatosDiagnosticos() {
    $("hNumeroDiagnostico").value = '0';
    contadorDivsDiagnosticos = 0;
    $("Div_TablaDiagnosticoCIE").hide();
    $("htxtcodigosDiagnosticos").value = 0;
    $("txtbusquedaNombreDiagnostico").value = '';
}
function cargaNumeroSesiones() {
    codigoPaciente = $('htxtcodigopaciente').value
    //alert($('hcodigoProgramacion').value)
    patronModulo = 'cargaNumeroSesiones';

    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoPaciente;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            //alert (respuesta)
            $('txtCantidadCitasEssalud').value = respuesta;
        }
    })
}
function cargaDiagnosticos() {
    if ($("htxtEsESSALUD").value == 1)
        $("Div_diagnosticoESSALUD").show();
    if ($("htxtEsESSALUD").value == 0)
        $("Div_diagnosticoESSALUD").hide();
    $('Div_TablaDiagnosticoHC').innerHTML = "";

    cargaNumeroSesiones();
    contadorDivsMedicamentos = 0;
    patronModulo = 'tablaCie';
    parametronombrediagnostico = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + parametronombrediagnostico;

    tablaDiagnosticos = new dhtmlXGridObject('Div_TablaDiagnosticoHC');
    tablaDiagnosticos.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaDiagnosticos.setSkin("dhx_skyblue");
    tablaDiagnosticos.attachEvent("onRowSelect", agregarDiagnosticoHC);
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaDiagnosticos.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    tablaDiagnosticos.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaDiagnosticos.init();
    tablaDiagnosticos.loadXML(pathRequestControl + '?' + parametros);
}
function agregarOtro_ActoMedico(opcion) {
    //alert($('hcodigoProgramacion').value)
    patronModulo = 'agregarOtroDiagnosticoHC';

    parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            data = respuesta;

        }
    })
    switch (opcion) {
        /*case 'motivoconsulta' :
         rowId = data.split("|")[0];
         agregarMotivoDeConsulta(rowId,3);//Esto es el anterior
         break;*/ //Esto ya fue
        case 'antecedentes' :
            rowId = data.split("|")[0];
            agregarAntecedente(rowId, 2);
            break;
        case 'diagnostico' :
            //agregarDiagnosticoHC('','',data);
            agregarOtroDiagnostico('', '', data);//Al agregar otro si hay data que viene de la BD
            break;
    }

}

function agregarOtroMotivoDeConsultaDesdeBoton() {
    patronModulo = 'agregarOtroSintoma';

    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            data = respuesta;
            //rowId = data.split("|")[0];//
            var idSintomaCie = data.split("|")[0];
            var cCodigoCie = data.split("|")[1];
            var vDescripcion = data.split("|")[2];

            //agregarOtroMotivoDeConsultaEnVista(rowId,3);
            agregarOtroMotivoDeConsultaEnVista(idSintomaCie, cCodigoCie, vDescripcion);
        }
    })
}

function agregarOtroMotivoDeConsultaEnVista(idCieSintoma, cCodigoCie, vDescripcion) {
    $('imgPreguardarMotivoDeConsulta').src = '../../../../fastmedical_front/imagen/btn/btn_preguardar.gif';
    //alert('Fila: '+rowId+'Columna: '+cellInd);
    //$('Div_btnPreguardar').style.display="block";
    //var idCieSintoma = rowId;//var idCieSintoma = miTablaSintoma.getSelectedId();
    var cadenaIdCieSintomas = document.getElementById("hdnCadenaIdCieSintomas").value;

    if ((cadenaIdCieSintomas.indexOf(idCieSintoma + "|") == -1) && (cadenaIdCieSintomas.indexOf(idCieSintoma) == -1)) {
        if (cadenaIdCieSintomas.length > 0)
            cadenaIdCieSintomas = cadenaIdCieSintomas + "|" + idCieSintoma;
        else
            cadenaIdCieSintomas = idCieSintoma;
        document.getElementById("hdnCadenaIdCieSintomas").value = cadenaIdCieSintomas;

        $('hdnNumSintomas').value = parseInt($('hdnNumSintomas').value) + 1;//Esto al inicio logica Junny

        nombreSintoma = vDescripcion;//nombreSintoma=miTablaSintoma.cells(rowId, 2).getValue();
        numSintoma = $('hdnNumSintomas').value;
        patronModulo = 'agregarMotivoDeConsulta';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + numSintoma;
        parametros += '&p3=' + nombreSintoma;
        parametros += '&p4=' + idCieSintoma;

        new Ajax.Request(pathRequestControl, {
            method: 'post',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                respuesta = transport.responseText;
                $('Div_sintomas').innerHTML = $('Div_sintomas').innerHTML + respuesta;
            }
        })
    }
}

function agregarOtroDiagnostico(rowId, cellInd, data) {
    alert(rowId + '------' + cellInd + '------' + data);
    //$('imgPreguardarDiagnosticos').src='../../../../fastmedical_front/imagen/btn/btn_preguardar.gif';
    /*if(data==undefined){
     
     if($('hNumeroDiagnostico').value == '0'){
     $("Div_TablaDiagnosticoCIE").show();
     $("Div_ObservacionDiagnostico").show();
     }
     codigointernoCIE = tablaDiagnosticos.getSelectedId();
     codigoCIE = tablaDiagnosticos.cells(rowId,0).getValue();
     numerodiv = contadorDivsDiagnosticos;
     descripcionDiagnosticoCIE = tablaDiagnosticos.cells(rowId,1).getValue();
     nombreCIE = Base64.encode(descripcionDiagnosticoCIE);
     idTipoDiagnostico = '';
     idTipoIngreso = '';
     idDiagnosticoCIE = '';
     diagnosticoMedico = '';
     if($("hEstadoAgregarDiagnostico").value=='2'){
     $("hEstadoAgregarDiagnostico").value = 4;
     }
     estadoregistroDiagnostico = $("hEstadoAgregarDiagnostico").value;
     
     
     } else{*/
    if ($('hNumeroDiagnostico').value == '0') {
        $("Div_TablaDiagnosticoCIE").show();
        $("Div_ObservacionDiagnostico").show();
    }
    arreglo = data.split("|");

    codigointernoCIE = arreglo[0];
    codigoCIE = arreglo[1];
    numerodiv = contadorDivsDiagnosticos;
    descripcionDiagnosticoCIE = arreglo[2];
    nombreCIE = Base64.encode(descripcionDiagnosticoCIE);
    idTipoDiagnostico = arreglo[3];
    if (arreglo[6] == 0)
        idTipoIngreso = '';
    else
        idTipoIngreso = arreglo[6];
    idDiagnosticoCIE = arreglo[4];
    diagnosticoMedico = arreglo[5];
    //$("hEstadoAgregarDiagnostico").value='2';// Esto lo comento Junny porque sino falla
    estadoregistroDiagnostico = $("hEstadoAgregarDiagnostico").value;
    //$("hIdDiagnostico").value = idDiagnosticoCIE;// Esto lo comento Junny porque sino falla
    $("txtareaObservacionDiagnostico").value = diagnosticoMedico;

    //}
    codigos = document.getElementById("htxtcodigosDiagnosticos").value;
    if (!((codigos.indexOf(codigointernoCIE + "|") != -1) || (codigos.indexOf(codigointernoCIE) != -1))) {
        if (codigos.length > 0)
            codigos = codigos + "|" + codigointernoCIE;
        else
            codigos = codigointernoCIE;
        document.getElementById("htxtcodigosDiagnosticos").value = codigos;
        patronModulo = 'agregarDiagnosticoHC';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + codigointernoCIE;
        parametros += '&p3=' + codigoCIE;
        parametros += '&p4=' + numerodiv;
        parametros += '&p5=' + nombreCIE;
        parametros += '&p6=' + idTipoDiagnostico;
        parametros += '&p7=' + idTipoIngreso;
        parametros += '&p8=' + idDiagnosticoCIE;
        parametros += '&p9=' + diagnosticoMedico;
        parametros += '&p10=' + estadoregistroDiagnostico;

        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false,
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                respuesta = transport.responseText;
                nombreDiv = "Div_CIE_asignado_" + numerodiv;
                creaDiagnostico(nombreDiv);
                $(nombreDiv).innerHTML = respuesta;
                contadorDivsDiagnosticos++;
            }
        })
        $('hNumeroDiagnostico').value = parseInt($('hNumeroDiagnostico').value) + 1;
    }
}

function agregarDiagnosticoHC(rowId, cellInd, data) {
    var codigointernoCIE;
    var codigoCIE;
    var numerodiv;
    var descripcionDiagnosticoCIE;
    var nombreCIE;
    var idTipoDiagnostico;
    var idTipoIngreso;
    var idDiagnosticoCIE;
    var diagnosticoMedico;
    var estadoregistroDiagnostico;
    if (data == undefined) {

        if ($('hNumeroDiagnostico').value == '0') {
            $("Div_TablaDiagnosticoCIE").show();
            $("Div_ObservacionDiagnostico").show();
        }
        codigointernoCIE = tablaDiagnosticos.getSelectedId();
        codigoCIE = tablaDiagnosticos.cells(rowId, 0).getValue();
        numerodiv = contadorDivsDiagnosticos;
        descripcionDiagnosticoCIE = tablaDiagnosticos.cells(rowId, 1).getValue();
        nombreCIE = Base64.encode(descripcionDiagnosticoCIE);
        idTipoDiagnostico = '';
        idTipoIngreso = '';
        idDiagnosticoCIE = '';
        diagnosticoMedico = '';
        if ($("hEstadoAgregarDiagnostico").value == '2') {
            $("hEstadoAgregarDiagnostico").value = 4;
        }
        estadoregistroDiagnostico = $("hEstadoAgregarDiagnostico").value;


    } else {
        if ($('hNumeroDiagnostico').value == '0') {
            $("Div_TablaDiagnosticoCIE").show();
            $("Div_ObservacionDiagnostico").show();
        }
        var arreglo = data.split("|");

        codigointernoCIE = arreglo[0];
        codigoCIE = arreglo[1];
        numerodiv = contadorDivsDiagnosticos;
        descripcionDiagnosticoCIE = arreglo[2];
        nombreCIE = Base64.encode(descripcionDiagnosticoCIE);
        idTipoDiagnostico = arreglo[3];
        if (arreglo[6] == 0)
            idTipoIngreso = '';
        else
            idTipoIngreso = arreglo[6];
        idDiagnosticoCIE = arreglo[4];
        diagnosticoMedico = arreglo[5];
        $("hEstadoAgregarDiagnostico").value = '2';
        estadoregistroDiagnostico = $("hEstadoAgregarDiagnostico").value;
        $("hIdDiagnostico").value = idDiagnosticoCIE;
        $("txtareaObservacionDiagnostico").value = diagnosticoMedico;

    }
    codigos = document.getElementById("htxtcodigosDiagnosticos").value;
    if (!((codigos.indexOf(codigointernoCIE + "|") != -1) || (codigos.indexOf(codigointernoCIE) != -1))) {
        if (codigos.length > 0)
            codigos = codigos + "|" + codigointernoCIE;
        else
            codigos = codigointernoCIE;
        document.getElementById("htxtcodigosDiagnosticos").value = codigos;
        var patronModulo = 'agregarDiagnosticoHC';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + codigointernoCIE;
        parametros += '&p3=' + codigoCIE;
        parametros += '&p4=' + numerodiv;
        parametros += '&p5=' + nombreCIE;
        parametros += '&p6=' + idTipoDiagnostico;
        parametros += '&p7=' + idTipoIngreso;
        parametros += '&p8=' + idDiagnosticoCIE;
        parametros += '&p9=' + diagnosticoMedico;
        parametros += '&p10=' + estadoregistroDiagnostico;

        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false,
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                respuesta = transport.responseText;
                nombreDiv = "Div_CIE_asignado_" + numerodiv;
                creaDiagnostico(nombreDiv);
                $(nombreDiv).innerHTML = respuesta;
                contadorDivsDiagnosticos++;
            }
        })
        $('hNumeroDiagnostico').value = parseInt($('hNumeroDiagnostico').value) + 1;
    //$('hNumeroDiagnostico').value = $('hNumeroDiagnostico').value + "|" + contadorDivsDiagnosticos;
    }
    preguardarDiagnosticosCorregido();
//validaryPreguardarDiagnosticosCorregido();

}
function agregarDiagnosticoPreguardadoHC(rowId, cellInd, data) {

    //$('imgPreguardarDiagnosticos').src='../../../../fastmedical_front/imagen/btn/btn_preguardar.gif';
    //    alert(1);
    if (data == undefined) {
        if ($('hNumeroDiagnostico').value == '0') {
            $("Div_TablaDiagnosticoCIE").show();
            $("Div_ObservacionDiagnostico").show();
        }
        codigointernoCIE = tablaDiagnosticos.getSelectedId();
        codigoCIE = tablaDiagnosticos.cells(rowId, 0).getValue();
        numerodiv = contadorDivsDiagnosticos;
        descripcionDiagnosticoCIE = tablaDiagnosticos.cells(rowId, 1).getValue();
        nombreCIE = Base64.encode(descripcionDiagnosticoCIE);
        idTipoDiagnostico = '';
        idTipoIngreso = '';
        idDiagnosticoCIE = '';
        diagnosticoMedico = '';
        if ($("hEstadoAgregarDiagnostico").value == '2') {
            $("hEstadoAgregarDiagnostico").value = 4;
        }
        estadoregistroDiagnostico = $("hEstadoAgregarDiagnostico").value;


    } else {
        if ($('hNumeroDiagnostico').value == '0') {
            $("Div_TablaDiagnosticoCIE").show();
            $("Div_ObservacionDiagnostico").show();
        }
        //        alert(3);
        arreglo = data.split("|");

        codigointernoCIE = arreglo[0];
        codigoCIE = arreglo[1];
        numerodiv = contadorDivsDiagnosticos;
        descripcionDiagnosticoCIE = arreglo[2];
        nombreCIE = Base64.encode(descripcionDiagnosticoCIE);
        idTipoDiagnostico = arreglo[3];
        if (arreglo[6] == 0)
            idTipoIngreso = '';
        else
            idTipoIngreso = arreglo[6];
        idDiagnosticoCIE = arreglo[4];
        diagnosticoMedico = arreglo[5];
        $("hEstadoAgregarDiagnostico").value = '2';
        estadoregistroDiagnostico = $("hEstadoAgregarDiagnostico").value;
        $("hIdDiagnostico").value = idDiagnosticoCIE;
        $("txtareaObservacionDiagnostico").value = diagnosticoMedico;

    }
    codigos = document.getElementById("htxtcodigosDiagnosticos").value;
    if (!((codigos.indexOf(codigointernoCIE + "|") != -1) || (codigos.indexOf(codigointernoCIE) != -1))) {
        if (codigos.length > 0)
            codigos = codigos + "|" + codigointernoCIE;
        else
            //            alert(4);
            codigos = codigointernoCIE;
        document.getElementById("htxtcodigosDiagnosticos").value = codigos;
        patronModulo = 'agregarDiagnosticoPreguardadoHC';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + codigointernoCIE;
        parametros += '&p3=' + codigoCIE;
        parametros += '&p4=' + numerodiv;
        parametros += '&p5=' + nombreCIE;
        parametros += '&p6=' + idTipoDiagnostico;
        parametros += '&p7=' + idTipoIngreso;
        parametros += '&p8=' + idDiagnosticoCIE;
        parametros += '&p9=' + diagnosticoMedico;
        parametros += '&p10=' + estadoregistroDiagnostico;
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
                nombreDiv = "Div_CIE_asignado_" + numerodiv;
                creaDiagnostico(nombreDiv);
                $(nombreDiv).innerHTML = respuesta;
                contadorDivsDiagnosticos++;
            }
        })
        $('hNumeroDiagnostico').value = parseInt($('hNumeroDiagnostico').value) + 1;
    //$('hNumeroDiagnostico').value = $('hNumeroDiagnostico').value + "|" + contadorDivsDiagnosticos;
    }

}
function creaDiagnostico(nombrediv) {
    var divPadre = document.getElementById("Div_TablaDiagnosticoCIE");
    var divnuevo = document.createElement("div");
    divnuevo.setAttribute("id", nombrediv);
    divPadre.appendChild(divnuevo);
}

function eliminarDiagnostico(numeroDiagnostico, codigointernoCIE) {
    var div = 'Div_CIE_asignado_' + numeroDiagnostico;
    $(div).hide();

    var codigos = document.getElementById("htxtcodigosDiagnosticos").value;
    if (codigos.indexOf(codigointernoCIE + "|") != -1) {
        codigos = codigos.replace(codigointernoCIE + "|", '');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
    }
    if (codigos.indexOf(codigointernoCIE) != -1) {
        codigos = codigos.replace("|" + codigointernoCIE, '');//Eliminar de la cadena en el caso el elemento se encuentre al final
        codigos = codigos.replace(codigointernoCIE, '');//Eliminar de la cadena en el caso solo haya uno
    }
    document.getElementById("htxtcodigosDiagnosticos").value = codigos;

    //alert("Valorcito encontrado a eliminar: "+$("hIdDiagnostico").value);
    //if($("hIdDiagnostico").value!=''){
    if ($("hIdDiagnostico").value != '' && $("hIdDiagnostico").value != '0') {
        var patronModulo = 'eliminarDiagnosticoHC';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + ($("hIdDiagnostico").value);
        parametros += '&p3=' + codigointernoCIE;

        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false,
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                respuesta = transport.responseText;

            }
        })
    }
}

function validarLlenadoTiposDiagnosticosCorregido() {
    var todoOK = 0;
    var color = '#F27F7D';
    var isEssalud = $("htxtEsESSALUD").value;
    var cantidadCies = $("hNumeroDiagnostico").value;

    var numCiesVisibles = 0;
    var z;

    for (z = 0; z < cantidadCies; z++) {
        if ($("Div_CIE_asignado_" + z).style.display != 'none') {
            numCiesVisibles = numCiesVisibles + 1;
        }
    }

    if (numCiesVisibles == 0) {
        //alert("Seleccione como m\xEDnimo un CIE");
        todoOK = -1;
    }
    else {
        if (numCiesVisibles > 0) {
            if (isEssalud == '1') {
                if ($("lstDestinoCitaEssalud").value == '0000') {
                    //alert("Destino de cita no seleccionada (ESSALUD)");
                    $("lstDestinoCitaEssalud").setStyle({
                        background: color
                    });
                    todoOK = -2;
                }
                else {
                    if ($("lstTipoCitaEssalud").value == '0000') {
                        //alert("Tipo de cita no seleccionada (ESSALUD)");
                        $("lstTipoCitaEssalud").setStyle({
                            background: color
                        });
                        todoOK = -3;
                    }
                //                    else{
                //                        
                //                        todoOK=1;
                //
                //                    }
                }
            }

            //Validar tipo de diagnostico del CIE
            var indiceFaltaTipoDiagnostico = -1;
            //Validar tipo de ingreso del CIE
            var indiceFaltaTipoIngreso = -1;

            for (var i = 0; i < cantidadCies; i++) {//El indice de los agregados inicia en cero
                if (document.getElementById("Div_CIE_asignado_" + i).style.display != "none") {
                    if ($("lstTipoDiagnostico_" + i).value == '0000') {
                        indiceFaltaTipoDiagnostico = i;
                        $("lstTipoDiagnostico_" + i).setStyle({
                            background: color
                        });
                        break;
                    }
                    else {
                        if ($("lstTipoIngreso_" + i).value == '0000') {
                            indiceFaltaTipoIngreso = i;
                            $("lstTipoIngreso_" + i).setStyle({
                                background: color
                            });
                            break;
                        }
                    }
                }
            }

            if (indiceFaltaTipoDiagnostico != -1) {
                todoOK = -4;
            }
            else {
                if (indiceFaltaTipoIngreso != -1) {
                    todoOK = -5;
                }
                else {

                    todoOK = 1;
                }
            }


        }
    }

    return todoOK;
}

function preguardarDiagnosticosCorregido() {
    //$('imgPreguardarDiagnosticos').src='../../../../fastmedical_front/imagen/btn/btn_preguardar_off.gif';
    var cantidadCies = parseInt($("hNumeroDiagnostico").value);
    var observacion = $("txtareaObservacionDiagnostico").value;
    var hEstado = "hEstadoAgregarDiagnostico";
    var hidDiagnostico = "hIdDiagnostico";
    var destinoCitaEssalud = "";
    var tipoconsultaEssalud = "";
    var numerosesion = "";
    var esEssalud = '0';

    //    if ($("htxtEsESSALUD").value == '1') {
    //        destinoCitaEssalud = $("lstDestinoCitaEssalud").value;
    //        tipoconsultaEssalud = $("lstTipoCitaEssalud").value;
    //        numerosesion = $("txtCantidadCitasEssalud").value;
    //        esEssalud = '1';
    //    }

    var cadena = '';
    for (i = 0; i < cantidadCies; i++) {
        if ($(hEstado).value == 0 || $(hEstado).value == 4) {
            if ($("Div_CIE_asignado_" + i).style.display != 'none') {
                if ($('lstTipoIngreso_' + i).value == '0000') {
                    ingreso = 0;
                }
                else {
                    ingreso = $('lstTipoIngreso_' + i).value;
                }
                cadena += $('hcodigoDiagnostico_' + i).value + '_' + $('lstTipoDiagnostico_' + i).value + '_' + ingreso;
            }
            if (i < cantidadCies - 1) {
                cadena += "|";
            }
        }
    }

    if (cadena != '') {
        var patron = 'preGrabarDiagnostico';
        var parametros = '';
        parametros += 'p1=' + patron;
        parametros += '&p2=' + cadena;
        parametros += '&p3=' + $('hcodigoProgramacion').value;
        parametros += '&p4=' + $(hEstado).value;
        parametros += '&p5=' + trimJunny($(hidDiagnostico).value);
        parametros += '&p6=' + observacion;
        parametros += '&p7=' + esEssalud;
        parametros += '&p8=' + destinoCitaEssalud;
        parametros += '&p9=' + tipoconsultaEssalud;
        parametros += '&p10=' + numerosesion;
        parametros += '&p11=' + $('htxtcodigopaciente').value;
        parametros += '&p12=' + $('hcodigoCronograma').value;


        new Ajax.Request(pathRequestControl, {
            method: 'post',
            asynchronous: false,
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                respuesta = transport.responseText;
                arreglo = respuesta.split("|")
                if (arreglo[0] == '0') {
                    $("hIdDiagnostico").value = arreglo[1];
                    $(hEstado).value = '2';
                }
                if (arreglo[0] == '1') {
                    window.alert(arreglo[1]);
                }
            }
        })
    }
}

function validaryPreguardarDiagnosticosCorregido() {
    var cantidadCies = $("hNumeroDiagnostico").value;
    var numCiesVisibles = 0;
    var z;

    for (z = 0; z < cantidadCies; z++) {
        if ($("Div_CIE_asignado_" + z).style.display != 'none') {
            numCiesVisibles = numCiesVisibles + 1;
        }
    }

    if (numCiesVisibles == 0) {
        alert("Seleccione como m\xEDnimo un CIE");
    }
    else {
        if (confirm("\xBFDesea preguardar los CIE?\nUna vez preguardados no podr\xE1n ser eliminados!!!")) {
            var rptaValidacion = validarLlenadoTiposDiagnosticosCorregido();

            if (rptaValidacion == -1) {
                alert("Seleccione como m\xEDnimo un CIE");
            }
            else {
                if (rptaValidacion == -2) {
                    alert("Destino de cita no seleccionada (ESSALUD)");
                }
                else {
                    if (rptaValidacion == -3) {
                        alert("Tipo de cita no seleccionada (ESSALUD)");
                    }
                    else {
                        if (rptaValidacion == -4) {
                            //alert("Ingrese tipo de diagn\xF3stico del\nCIE: " + $("divNombreCieDiagnostico_"+indiceFaltaTipoDiagnostico).firstChild.nodeValue);
                            alert("Ingrese tipo de diagn\xF3stico del CIE");
                        }
                        else {
                            if (rptaValidacion == -5) {
                                //alert("Ingrese tipo de ingreso del\nCIE: " + $("divNombreCieDiagnostico_"+indiceFaltaTipoIngreso).firstChild.nodeValue);
                                alert("Ingrese tipo de ingreso del CIE");
                            }
                            else {
                                if (rptaValidacion == 1) {//Todo Ok
                                    preguardarDiagnosticosCorregido();
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

function validarLlenadoTiposDiagnosticos() {
    isEssalud = $("htxtEsESSALUD").value;
    cantidadCies = $("hNumeroDiagnostico").value;
    faltaregistrar = 0;
    if (isEssalud == '1') {
        if ($("lstDestinoCitaEssalud").value == '0000')
            faltaregistrar = 1;
        if ($("lstTipoCitaEssalud").value == '0000')
            faltaregistrar = 2;
    }

    for (i = 0; i < cantidadCies; i++) {
        if ($("lstTipoDiagnostico_" + i).value == '0000')
            faltaregistrar = 3;
    }
    return faltaregistrar;
}
function preguardarDiagnosticos() {

    // $('imgPreguardarDiagnosticos').src='../../../../fastmedical_front/imagen/btn/btn_preguardar_off.gif';
    opcionpreguardarDiagnosticos = validarLlenadoTiposDiagnosticos();
    if (opcionpreguardarDiagnosticos == 0) {
        cantidadCies = parseInt($("hNumeroDiagnostico").value);
        //    codigos = document.getElementById("htxtcodigosServicios").value;
        observacion = $("txtareaObservacionDiagnostico").value;
        hEstado = "hEstadoAgregarDiagnostico";
        hidDiagnostico = "hIdDiagnostico";
        destinoCitaEssalud = "";
        tipoconsultaEssalud = "";
        numerosesion = "";
        esEssalud = '0';


        if ($("htxtEsESSALUD").value == '1') {
            destinoCitaEssalud = $("lstDestinoCitaEssalud").value;
            tipoconsultaEssalud = $("lstTipoCitaEssalud").value;
            numerosesion = $("txtCantidadCitasEssalud").value;
            esEssalud = '1';
        }

        patron = new Array();
        parametros = new Array();
        respuesta = new Array();
        cadena = '';


        if (cantidadCies > 0) {
            for (i = 0; i < cantidadCies; i++) {
                //                hEstado='hEstadoAgregarDiagnostico_'+i;
                if ($(hEstado).value == 0 || $(hEstado).value == 4) {
                    //                    $('hIdDiagnostico_'+i).value==''?id = '0':id = $('hIdDiagnostico_'+i).value;
                    if ($("Div_CIE_asignado_" + i).style.display != 'none') {
                        if ($('lstTipoIngreso_' + i).value == '0000') {
                            ingreso = 0;
                        }
                        else {
                            ingreso = $('lstTipoIngreso_' + i).value;
                        }
                        cadena += $('hcodigoDiagnostico_' + i).value + '_' + $('lstTipoDiagnostico_' + i).value + '_' + ingreso;
                    }
                    if (i < cantidadCies - 1) {
                        cadena += "|";
                    }
                }
            }

            if (cadena != '') {
                patron = 'preGrabarDiagnostico';
                parametros = '';
                parametros += 'p1=' + patron;
                parametros += '&p2=' + cadena;
                parametros += '&p3=' + $('hcodigoProgramacion').value;
                parametros += '&p4=' + $(hEstado).value;
                parametros += '&p5=' + $(hidDiagnostico).value;
                parametros += '&p6=' + observacion;
                parametros += '&p7=' + esEssalud;
                parametros += '&p8=' + destinoCitaEssalud;
                parametros += '&p9=' + tipoconsultaEssalud;
                parametros += '&p10=' + numerosesion;
                parametros += '&p11=' + $('htxtcodigopaciente').value;
                parametros += '&p12=' + $('hcodigoCronograma').value;


                new Ajax.Request(pathRequestControl, {
                    method: 'get',
                    asynchronous: false,
                    parameters: parametros,
                    onLoading: micargador(1),
                    onComplete: function(transport) {
                        micargador(0);
                        respuesta = transport.responseText;
                        arreglo = respuesta.split("|")
                        if (arreglo[0] == '0') {
                            $("hIdDiagnostico").value = arreglo[1];
                            $(hEstado).value = '2';
                        }
                        if (arreglo[0] == '1')
                            window.alert(arreglo[1]);
                    }
                })


            }
        }
    //        }else{
    //            window.alert("No hay diagnósticos agregados")
    //        }
    } else {
        switch (opcionpreguardarDiagnosticos) {
            case 1 :
            {
                window.alert("Destino de Cita no Seleccionada(EsSalud)");
                break;
            }
            case 2 :
            {
                window.alert("Tipo de Cita no Seleccionada(EsSalud)");
                break;
            }
            case 3 :
            {
                window.alert("Tipo de Diagnóstico no Seleccionado");
                break;
            }
        }
    }

}

function cambiarEstadoDiagnostico() {
    //$('imgPreguardarDiagnosticos').src='../../../../fastmedical_front/imagen/btn/btn_preguardar.gif';
    if ($('hEstadoAgregarDiagnostico').value == '2') {
        $('hEstadoAgregarDiagnostico').value = 4;
    }
    preguardarDiagnosticosCorregido();
}

/*----------------------------busquedas Diagnosticos-----------------------------*/

function busquedaDiagnosticoNombre(evento) {
    var parametronombrediagnostico = $('txtbusquedaNombreDiagnostico').value;
    var numero = parametronombrediagnostico.length;
    var accion = '1';
    var patronModulo = 'tablaCie';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + parametronombrediagnostico;
    parametros += '&p3=' + accion;
    var tecla = evento.keyCode
    if (numero == 3 || tecla == 13) {
        dn = 0;
        tablaDiagnosticos = new dhtmlXGridObject('Div_TablaDiagnosticoHC');
        tablaDiagnosticos.setImagePath("../../../../fastmedical_front/imagen/icono/");
        tablaDiagnosticos.attachEvent("onRowSelect", verificarPaqueteEtaero);
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador = contadorCargador;
        tablaDiagnosticos.attachEvent("onXLS", function() {
            cargadorpeche(1, idCargador);
        });
        tablaDiagnosticos.attachEvent("onXLE", function() {
            cargadorpeche(0, idCargador);
        });
        /////////////fin cargador ///////////////////////
        tablaDiagnosticos.setSkin("dhx_skyblue");
        tablaDiagnosticos.init();
        tablaDiagnosticos.loadXML(pathRequestControl + '?' + parametros, function() {
            dn = 1;
        });
    }
    if (numero > 3 && dn == 1) {
        var palabra = $('txtbusquedaNombreDiagnostico').value;
        var arrayPalabras = new Array();
        arrayPalabras = palabra.split(" ");
        var numeroPalabras = arrayPalabras.length;
        tablaDiagnosticos.filterBy(1, arrayPalabras[0]);
        for (var i = 1; i < numeroPalabras; i++) {
            tablaDiagnosticos.filterBy(1, arrayPalabras[i], true);
        }
    }

}
function verificarPaqueteEtaero(rowId, cellInd, data) {
    var afiliacioPaciente = $('htxtcodigoafiliacion').value;
    var c_cod_per = $('hidCodPersona').value;
    var cie = tablaDiagnosticos.getSelectedId();
    //alert(cie);
    if (afiliacioPaciente == '0027') {
        var patronModulo = 'verificarPaqueteEtareo';

        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + c_cod_per;
        parametros += '&p3=' + cie;

        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function(transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                //window.alert(respuesta);
                if (respuesta == 0) {
                    agregarDiagnosticoHC(rowId, cellInd, data);
                } else {
                    if (respuesta > 0) {
                        if (confirm("El diagnostico Le generara un Paquete de Atención, Quiere Continiar?")) {
                            agregarDiagnosticoHC(rowId, cellInd, data);
                            cargarPaqueteDiagnostico(respuesta);
                            //biennnnnnnn
                            var codigoProgramacion = $("hcodigoProgramacion").value;
                            refrescarVPaquetes(codigoProgramacion);
                        }
                    } else {
                        alert('error: ' + respuesta);
                    }
                }

            }
        })
    } else {
        agregarDiagnosticoHC(rowId, cellInd, data);
    }
}
function refrescarVPaquetes(codigoProgramacion) {
    var c_cod_per = $('hidCodPersona').value;
    var valor = 1;
    var patronModulo = 'refrescarVPaquetes';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoProgramacion;
    parametros += '&p3=' + c_cod_per;
    parametros += '&p4=' + valor;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Div_PaquetesCuerpo').update(respuesta);
        }
    })
}

//function paginaPrueba() {
//    patronModulo = 'abrirpaginaPrueba';
//    parametros = '';
//    parametros += 'p1=' + patronModulo;
//    new Ajax.Request(pathRequestControl, {
//        method: 'get',
//        parameters: parametros,
//        onLoading: micargador(1),
//        onComplete: function(transport) {
//            micargador(0);
//            respuesta = transport.responseText;
//            $('divMantenimiento').update(respuesta);
//            document.getElementById("divGrabar").style.display = 'block';
//        }
//    })
//}
function cargarPaqueteDiagnostico(idGrupoEtaero) {
    var c_cod_per = $('hidCodPersona').value;
    var patronModulo = 'cargarPaqueteDiagnostico';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' +  parseInt(idGrupoEtaero);
    parametros += '&p3=' + c_cod_per;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;

        // alert(respuesta);
        }
    })
}
//
function buscarDiagnosticoCodigo() {

    codigo = $('txtbusquedaCodigoDiagnostico').value;
    numero = codigo.length;
    accion = '3';
    patronModulo = 'tablaCie';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    parametros += '&p3=' + accion;

    if (numero == 2) {
        dc = 0;
        tablaDiagnosticos = new dhtmlXGridObject('Div_TablaDiagnosticoHC');
        tablaDiagnosticos.setImagePath("../../../../fastmedical_front/imagen/icono/");
        tablaDiagnosticos.attachEvent("onRowSelect", agregarDiagnosticoHC);
        tablaDiagnosticos.setSkin("dhx_skyblue");
        tablaDiagnosticos.init();
        tablaDiagnosticos.loadXML(pathRequestControl + '?' + parametros, function() {
            dc = 1;
        });
    //miTablaCie.clearAll();
    }
    if (numero > 2 && dc == 1) {
        tablaDiagnosticos.filterBy(0, $('txtbusquedaCodigoDiagnostico').value);
    }
}

/*-------------------------------------------------------------------------------*/
function cargaDiagnosticosPreguardados() {
    contadorDivsDiagnosticos = 0;
    var codigoProgramacion = $('hcodigoProgramacion').value
    //alert($('hcodigoProgramacion').value)
    var patronModulo = 'cargaDiagnosticosPreguardados';

    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoProgramacion;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            //window.alert(respuesta);
            eval(respuesta);
            cargaNumeroSesiones();
        }
    })
}

function verDiagnosticosAnteriores() {
    if ($('habiertoDiagnosticosAnteriores').value == 0) {
        $('habiertoDiagnosticosAnteriores').value = 1;
        $('icono_abrirDiagnosticosAnteriores').src = '../../../../fastmedical_front/imagen/icono/cerrarVentana.png';
        codigopaciente = $('htxtcodigopaciente').value;
        patronModulo = 'verDiagnosticosAnteriores';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + codigopaciente;
        $('Div_DiagnosticosAnteriores').show();

        tablaDiagnosticosAnteriores = new dhtmlXGridObject('Div_DiagnosticosAnteriores');
        tablaDiagnosticosAnteriores.setImagePath("../../../../fastmedical_front/imagen/icono/");
        tablaDiagnosticosAnteriores.attachEvent("onRowSelect", verDiagnostico);
        tablaDiagnosticosAnteriores.setSkin("dhx_skyblue");
        tablaDiagnosticosAnteriores.init();
        tablaDiagnosticosAnteriores.loadXML(pathRequestControl + '?' + parametros);
    }
    else {
        $('habiertoDiagnosticosAnteriores').value = 0;
        $('Div_DiagnosticosAnteriores').hide();
        $('icono_abrirDiagnosticosAnteriores').src = '../../../../fastmedical_front/imagen/icono/abrir.png';
    }
}
function verDiagnostico(rowId, cellInd) {
    if (cellInd == 6) {
        idprogramacion = this.cells(rowId, 1).getValue();
        mostrarDiagnosticoAnterior(idprogramacion);

    }
}
function mostrarDiagnosticoAnterior(codigoprogramacion) {
    titulo = 'Consulta de Diagnosticos'
    vFormaAbrir = 'VENTANA'
    vformname = 'DiagnosticoAnterior'
    vtitle = 'Diagnostico Anterior Medica'
    vwidth = '800'
    vheight = '500'
    patronModulo = 'mostrarVentanaDiagnosticoAnterior';
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
    parametros += '&p2=' + idprogramacion;
    posFuncion = "tablaDiagnosticoAnteriorPopUp('" + codigoprogramacion + "')";
    //posFuncion="tablaPreciosTratamientoAtencionMedica('"+codigo+"')";
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)

}
function tablaDiagnosticoAnteriorPopUp(codigoprogramacion) {
    patronModulo = 'obtenerDiagnosticoAnterior';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoprogramacion;
    tablaDiagnosticoAnterior = new dhtmlXGridObject('Div_TablaDiagnosticoCIEPopUp');
    tablaDiagnosticoAnterior.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaDiagnosticoAnterior.setSkin("dhx_skyblue");
    //tablaPreciosAtencionMedicaTratamiento.attachEvent("onRowSelect", agregarPracticaMedicaHC);
    tablaDiagnosticoAnterior.init();
    tablaDiagnosticoAnterior.loadXML(pathRequestControl + '?' + parametros);
}

/*
 function validaryPreguardarTratamientoMedicamentoso(){
 
 var rptaValidacion=validarTratamientoMedicamentoso();
 
 if(rptaValidacion==-1){
 window.alert("Falta ingresar nombre de medicamento!!!");
 }
 else{
 if(rptaValidacion==-2){
 window.alert("Falta ingresar presentaci\xF3n del medicamento!!!");
 }
 else{
 if(rptaValidacion==-3){
 window.alert("Falta ingresar cantidad del medicamento!!!");
 }
 else{
 if(rptaValidacion==-4){
 window.alert("Falta ingresar las indicaciones del medicamento!!!");
 }
 else{
 if(rptaValidacion==1){//Todo OK
 preguardarTratatamientoMedicamentosoCorregido();
 }
 }
 }
 }
 }
 }
 */

function darxAtencionCompletada() {
    //Falta realizar validacion completa
    //Lo que debe ir en el acto medico: minimo un CIE y la Evolucion tamanio minimo 50
    //validando
    //1. examenes méddicos
    ///////////////////////////////////////////////////////////////
    var respuesta = '';
    if ($('existeExamenMedico') != null) {
        var color = '#F27F7D';
        var cadenaPruebas = $('hdnPruebasDeExamenMedico').value;
        var arrayPruebas = new Array();
        arrayPruebas = cadenaPruebas.split("|");
        var numeroP = arrayPruebas.length;
        var rpta = 1;
        var idPrueba;
        var numeroCampos = 0;
        var obligatorio;
        var valor;

        for (var i = 0; i < numeroP; i++) {
            idPrueba = arrayPruebas[i];
            //alert(idPrueba);
            numeroCampos = $('numeroCampos_' + idPrueba).value;
            for (var j = 1; j <= numeroCampos; j++) {
                obligatorio = $('idObligatorio' + idPrueba + '_' + j).value;
                if (obligatorio == 1) {
                    valor = $('valorCampo_' + idPrueba + '_' + j).value;
                    if (valor == '') {
                        $('valorCampo_' + idPrueba + '_' + j).setStyle({
                            background: color
                        });
                        respuesta = 'Datos de Examenes Incompletos';
                    }
                }
            }
        }
    }    ///////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //2. Diagnostico
    if ($('existeDiagnostico') != null) {
        var numCiesVisibles = 0;
        var cantidadCies = parseInt($("hNumeroDiagnostico").value);
        var z;
        for (z = 0; z < cantidadCies; z++) {
            if ($("Div_CIE_asignado_" + z).style.display != 'none') {
                numCiesVisibles = numCiesVisibles + 1;
            }
        }
        if (numCiesVisibles == 0) {
            respuesta = respuesta + '---Debe ingresar un diagnostico CIE como minimo';
        }
        else {
            ///////////validando llenado completo de los diagnisticos
            var todoOK = 0;
            //Validar tipo de diagnostico del CIE
            var indiceFaltaTipoDiagnostico = -1;
            //Validar tipo de ingreso del CIE
            var indiceFaltaTipoIngreso = -1;
            for (i = 0; i < cantidadCies; i++) {//El indice de los agregados inicia en cero
                if (document.getElementById("Div_CIE_asignado_" + i).style.display != "none") {
                    if ($("lstTipoDiagnostico_" + i).value == '0000') {
                        indiceFaltaTipoDiagnostico = i;
                        $("lstTipoDiagnostico_" + i).setStyle({
                            background: color
                        });
                        break;
                    }
                    else {
                        if ($("lstTipoIngreso_" + i).value == '0000') {
                            indiceFaltaTipoIngreso = i;
                            $("lstTipoIngreso_" + i).setStyle({
                                background: color
                            });
                            break;
                        }
                    }
                }
            }
            if (indiceFaltaTipoDiagnostico != -1) {
                respuesta = respuesta + '---Debe ingresar El tipo de Diagnostico';
            }
            if (indiceFaltaTipoIngreso != -1) {
                respuesta = respuesta + '---Debe ingresar El tipo de Ingreso de Diagnostico';
            }
        }
    }
    //////////////////////////////////////////////////////////////
    //3. tratamientos medicamentosos
    ////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////
    if ($('existeTratamientos') != null) {
        var numeroRecetas = parseInt($('hcantidadRecetas').value);
        var productosReceta;
        for (i = 1; i <= numeroRecetas; i++) {
            productosReceta = $('hNumeroProductos_' + i).value;
            for (j = 1; j <= productosReceta; j++) {
                if ($('divProducto_' + i + '_' + j).style.display != 'none') {
                    if (trimJunny($('hcodigoProducto_' + i + '_' + j).value) == '0000000') {
                        if (trimJunny($('hOtros_' + i + '_' + j).value) == 'otros') {
                            respuesta = respuesta + '---Ingrese Nuevo Producto';
                            $('hOtros_' + i + '_' + j).setStyle({
                                background: color
                            });
                            break;
                        }
                        if (trimJunny($('hOtrosPresentacion_' + i + '_' + j).value) == 'otros') {
                            respuesta = respuesta + '---Ingrese la Presentacion del nuevo producto';
                            $('hOtrosPresentacion_' + i + '_' + j).setStyle({
                                background: color
                            });
                            break;
                        }
                    }
                    if (trimJunny($('cantidad_' + i + '_' + j).value) == '') {
                        respuesta = respuesta + '---ingresar Cantidad';
                        $('cantidad_' + i + '_' + j).setStyle({
                            background: color

                        });
                        break;
                    }
                    if (trimJunny($('dosis_' + i + '_' + j).value) == '') {
                        respuesta = respuesta + '---ingresar las indicaciones';
                        $('dosis_' + i + '_' + j).setStyle({
                            background: color
                        });
                        break;
                    }
                }
            }

        }
    }

    //return todoOK;
    //4. tratamientos medicos//////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////
    //
    //5. destino de cita
    /*
    if ($("lstDestinoCitaEssalud").value == '0000') {
        //alert("Destino de cita no seleccionada (ESSALUD)");
        $("lstDestinoCitaEssalud").setStyle({
            background: color
        });
        respuesta = respuesta + '---Destino de cita no seleccionada';
    }

    if ($("lstTipoCitaEssalud").value == '0000') {
        //alert("Tipo de cita no seleccionada (ESSALUD)");
        $("lstTipoCitaEssalud").setStyle({
            background: color
        });
        respuesta = respuesta + '---Tipo de cita no seleccionada';
    }
    */
    if (respuesta == '') {
        guardarAtencionMedicaHC();
    } else {
        alert(respuesta);
    }
}

function validarPreguardarExamenes() {
    var color = '#F27F7D';
    var cadenaPruebas = $('hdnPruebasDeExamenMedico').value;
    var arrayPruebas = new Array();
    arrayPruebas = cadenaPruebas.split("|");
    var numeroP = arrayPruebas.length;
    var i;
    var rpta = 1;
    var idPrueba;
    var numeroCampos = 0;
    var obligatorio;
    var valor;
    for (i = 0; i < numeroP; i++) {
        idPrueba = arrayPruebas[i];
        alert(idPrueba);
        numeroCampos = $('numeroCampos_' + idPrueba).value;

        for (var j = 1; j <= numeroCampos; j++) {
            obligatorio = $('idObligatorio' + idPrueba + '_' + j).value;
            if (obligatorio == 1) {
                valor = $('valorCampo_' + idPrueba + '_' + j).value;
                if (valor == '') {
                    $('valorCampo_' + idPrueba + '_' + j).setStyle({
                        background: color
                    });
                    rpta = 0;
                }
            }
        }
    //        if(idPrueba==74){ // ide de evalucion
    //            
    //            //Evolucion de la version actual, no se debe agregar nuevas versiones, se debe dejar alli
    //            //Minimo 50 caracteres
    //            rpta=validarEvolucionDePruebas();//Cero si hay error, uno si hay exito
    //            break;
    //        }
    }
    return rpta;
}

function validarEvolucionDePruebas() {
    var rpta = 1;
    //valorCampo_6_1
    var color = '#F27F7D';
    var textoEvolucion = trimJunny($('valorCampo_74_1').value);

    if (textoEvolucion.length < 50) {
        //alert("Ingrese como m\xEDnimo 50 caracteres");
        $("valorCampo_74_1").setStyle({
            background: color
        });
        $("valorCampo_74_1").focus();
        rpta = 0;
    }

    return rpta;
}

function preguardarExamenes() {
    cadenaPruebas = $('hdnPruebasDeExamenMedico').value;
    arrayPruebas = new Array();
    arrayPruebas = cadenaPruebas.split("|");
    numeroP = arrayPruebas.length;
    for (ii = 0; ii < numeroP; ii++) {
        preguardarPrueba(arrayPruebas[ii])
    // alert(arrayPruebas[ii]);
    }
}
function guardarAtencionMedicaHC() {
    var codigoprogramacion = $("hcodigoProgramacion").value;
    var codigocronograma = $('hcodigoCronograma').value;
    var proximacitasugerida = $('txtproximacita').value;
    var patronModulo = 'guardarAtencionMedicaHC';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoprogramacion;
    parametros += '&p3=' + proximacitasugerida;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            window.alert(respuesta.split("|")[1]);
            if (respuesta.split("|")[0] == 0) {
                $("Div_GeneralActoMedicoHC").hide();
                $("Div_GeneralActoMedico").show();
            //calculaAtendidosyNoAtendidosMensualActoMedico(codigocronograma);
            }
            /*
            if (confirm("\xbfDesea Imprimir la Receta?")) {
                imprimirRecetaUnicaEstandarizadaTodas();
            }
            */
            // mostrarAtenciones();
            var hcodigoProgramacion = $('hcodigoProgramacion').value;
            var htxtestadoatencion = '0005';
            var htxtcodigopaciente = $('htxtcodigopaciente').value;
            var htxtcodigoservicio = $('htxtcodigoservicio').value;
            var htxtEsESSALUD =$('htxtEsESSALUD').value;
            var parametross=hcodigoProgramacion+"|"+"|"+htxtestadoatencion+"|"+htxtcodigopaciente+"|"+htxtcodigoservicio+"|"+htxtEsESSALUD;
            atenderPacienteActoMedico(parametross);

        }
    })
//idtablacronogramas = $("hidtablacronogramas").value;

}
/********************fin de funciones de luis***************************/



//==============================================================================================
//==================================     Juan Carlos        ====================================
//==============================================================================================

function paginaPrueba() {
    patronModulo = 'abrirpaginaPrueba';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('divMantenimiento').update(respuesta);
            document.getElementById("divGrabar").style.display = 'block';
        }
    })
}

function padreExamenFisico() {
    titulo = 'Busqueda...'
    vFormaAbrir = 'VENTANA'
    vformname = 'asignarPadre'
    vtitle = 'ASIGNAR EXAMEN PADRE'
    vwidth = '400'
    vheight = '520'
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
    patronModulo = 'divExamenFisico'; //p1: va al control y recuperar la data para armar el arbol arbol_manuales.xml
    parametros = '';
    parametros += 'p1=' + patronModulo;
    /*--------------------------------------*/
    posFuncion = 'asignarPadreExamenFisico';

    CargarVentanaPopPapExamenPadre(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
}
function cambiarVersion() {
    arbolExamenFisico();
    document.getElementById("divExamenPrueba").style.display = 'none';
    nuevoExamen();
    mostrarStdDesarrollo();
}

function mostrarStdDesarrollo() {
    patronModulo = 'estadoDesarrollo';
    parametros = '';
    idVersion = $("cboVersion").value;
    parametros += 'p1=' + patronModulo + '&p2=' + idVersion;
    $('stdDesarrollo').innerHTML = "";
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            var miarray = respuesta.split("|");
            if (miarray[0] == 2) {
                $("divBtnNuevo").style.display = 'block';
                $("tr_prueba").style.display = 'block';
                $("tr_servicio").style.display = 'block';
            } else {
                $("divBtnNuevo").style.display = 'none';
                $("tr_prueba").style.display = 'none';
                $("tr_servicio").style.display = 'none';
            }
            //            alert(miarray[2]);
            $('hidFechCreacionVersion').value = miarray[2];
            $('stdDesarrollo').innerHTML = miarray[1];
        }
    })
}

function arbolExamenFisico()
{
    var idVersion = document.getElementById("cboVersion").value;
    parametros = "p1=arbolExamenFisico&p2=" + idVersion;
    divMostrar = document.getElementById('divTreeExamen');
    divMostrar.innerHTML = " ";
    treex = new dhtmlXTreeObject("divTreeExamen", "100%", "100%", 0);
    treex.setSkin('dhx_skyblue');
    treex.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    treex.attachEvent("onClick", function() {
        preeditaExamenFisico(treex.getSelectedItemId(), treex.getSelectedItemText());
        return true;
    });
    treex.openAllItems(0);
    //    treex.setXMLAutoLoading(pathRequestControl+'?'+parametros);
    treex.loadXML(pathRequestControl + '?' + parametros);
}

function asignarPadreExamenFisico() {
    var idVersion = document.getElementById("cboVersion").value;
    parametros = "p1=asignarPadreFisico&p2=" + idVersion;
    divMostrar = document.getElementById('divAsignarPadre');
    divMostrar.innerHTML = " ";
    tree = new dhtmlXTreeObject("divAsignarPadre", "100%", "100%", 0);
    tree.setSkin('dhx_skyblue');
    tree.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    tree.attachEvent("onClick", function() {
        capturarPadreExamenFisico(tree.getSelectedItemId(), tree.getSelectedItemText());
        return true;
    });
    //    treey.openAllItems(0);
    //    treey.setXMLAutoLoading(pathRequestControl+'?'+parametros);
    tree.loadXML(pathRequestControl + '?' + parametros);
    /***************** verifica si el arbol Examenes posee nodos********/
    var xx = treex.getAllFatItems();
    var xy = treex.getAllLeafs();

    if (xx == "" && xy == "") {
        $('txtJerarquia').value = "01";
        $('txtOrden').value = "1";
        $('txtNivel').value = "0";
        Windows.close("Div_asignarPadre");
    }
/******************************************************************/
}
function preeditaExamenFisico(id) {
    patronModulo = 'editaExamenFisico';
    parametros = '';
    parametros += 'p1=' + patronModulo + '&iIdExamen=' + id;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            var miarray = respuesta.split("|");
            document.getElementById("hidIdExamen").value = miarray[0];
            document.getElementById("txtPadre").value = miarray[1];
            document.getElementById("txtTitulo").value = miarray[2];
            document.getElementById("txtJerarquia").value = miarray[3];
            document.getElementById("txtNivel").value = miarray[4];
            document.getElementById("txtOrden").value = miarray[5];
            document.getElementById("txtDescripcionPadre").value = miarray[6];
            document.getElementById("cboEstado").value = miarray[7];
            document.getElementById("divEdita").style.display = 'block';
            document.getElementById("divGraba").style.display = 'none';
            document.getElementById("divActualiza").style.display = 'none';
            document.getElementById("divElimina").style.display = 'none';
            document.getElementById("btnAsignarPadre").style.visibility = 'hidden';
            document.getElementById("txtTitulo").disabled = true;
            document.getElementById("cboEstado").disabled = true;
            document.getElementById("txtOrden").disabled = true;
            tabsEstadosInicial();
            Asignaciones();
            document.getElementById("divExamenPrueba").style.display = 'block';
        }
    })
}
function tabsEstadosInicial() {
    $('ultab1').className = 'tabs_1';
    $('ultab2').className = 'tabs_2';
    $("hidFlagTab1").value = 0;
    $("hidFlagTab2").value = 0;
}
function Asignaciones() {
    idExamen = $("hidIdExamen").value;
    flagTab1 = $("hidFlagTab1").value;
    flagTab2 = $("hidFlagTab2").value;
    if (flagTab1 == 0 && flagTab2 == 0) {
        mostrarTblPruebas();
        mostrartablaExamenPrueba(idExamen);
        $("hidFlagTab1").value = 1;
        $('tab1').show();
        $('tab2').hide();
    }
    if (flagTab1 == 1 && flagTab2 == 0) {
        mostrarTblServicios();
        mostrartablaExamenServicio(idExamen);
        $("hidFlagTab2").value = 1;
    }
}
function editaExamenFisico() {
    document.getElementById("txtTitulo").disabled = false;
    document.getElementById("cboEstado").disabled = false;
    document.getElementById("txtOrden").disabled = false;
    document.getElementById("divEdita").style.display = 'none';
    document.getElementById("divGraba").style.display = 'none';
    document.getElementById("divActualiza").style.display = 'block';
    document.getElementById("divElimina").style.display = 'block';
    document.getElementById("btnAsignarPadre").style.visibility = 'hidden';
}

function capturarPadreExamenFisico(id) {
    patronModulo = 'capturaPadreExamenFisico';
    parametros = '';
    idVersion = document.getElementById("cboVersion").value;
    parametros += 'p1=' + patronModulo + '&iIdExamen=' + id + '&idVersion=' + idVersion;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            var miarray = respuesta.split("|");
            document.getElementById("txtDescripcionPadre").value = miarray[1];
            document.getElementById("txtPadre").value = miarray[0];
            document.getElementById("txtJerarquia").value = miarray[2];
            document.getElementById("txtNivel").value = miarray[3];
            document.getElementById("txtOrden").value = miarray[4];
        }
    })
}

function CargarVentanaPopPapExamenPadre(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
{
    myRand = parseInt(Math.random() * 999999999999999);
    if (vwidth == undefined || vwidth == 0)
        vwidth = 700;
    if (vheight == undefined || vheight == 0)
        vheight = 400;
    if (vposx1 == undefined || vposx1 == 0)
        vposx1 = 25;
    if (vposy1 == undefined || vposy1 == 0)
        vposy1 = 110;
    if (vposx2 == undefined || vposx2 == 0)
        vposx2 = 25;
    if (vposy2 == undefined || vposy2 == 0)
        vposy2 = 110;

    if (vresizable == undefined || vresizable == 0)
        vresizable = true;
    else
        vresizable = false;
    if (vstyle == undefined || vstyle == 0)
        vstyle = "alphacube";   // fondo y estilo
    //if(veffect==veffect || veffect==0) veffect="popup_effect";
    if (vmodal == undefined || vmodal == 0)
        vmodal = false;
    else
        vmodal = true;
    if (vopacity == undefined || vopacity == 0)
        vopacity = 1;
    if (vcenter == undefined || vcenter == 0 || vcenter == 't')
        vcenter = true;
    else
        vcenter = false;
    if (vtitle == undefined)
        vtitle = vformname;
    if (!ExisteObjeto("Div_" + vformname))
    {
        var vidfrm;
        // file02=decodeURIComponent(file02);
        var vid = "Div_" + vformname;
        vidfrm = "Frm_" + vformname;
        var vzindex = 100;
        var win;
        if (vmodal == true || vmodal == 1)
            win = new Window({
                id: vid,
                className: vstyle,
                title: vtitle,
                width: vwidth,
                height: vheight,
                zIndex: vzindex,
                opacity: vopacity,
                resizable: vresizable
            });
        else
            win = new Window({
                id: vid,
                className: vstyle,
                title: vtitle,
                width: vwidth,
                height: vheight,
                resizable: vresizable
            });
        win.getContent().innerHTML = "<div id='" + vidfrm + "'></div>";
        //win.getContent().innerHTML = "<h1>No Constraint</h1>Wired mode<br><a href='#' onclick='Windows.getWindow(\"win3\").maximize()'>Maximize me</a>";
        win.setDestroyOnClose();
        if (vcenter == true || vcenter == 1)
            win.showCenter(vmodal);
        else
            win.show(vmodal);
        win.setConstraint(true, {
            left: vposx1,
            right: vposx2,
            top: vposy1,
            bottom: 'auto'
        })
        win.toFront();

        new Ajax.Request(pathRequestControl,
        {
            method: 'get',
            parameters: parametros,
            onComplete: function(transport) {
                respuesta = transport.responseText;
                $(vidfrm).update(respuesta);
                posFuncion += "('')";
                eval(posFuncion);
            }
        })
    }
}


function nue_actExamenFisico(opt) {
    idExamen = document.getElementById("hidIdExamen").value;
    codPadre = document.getElementById("txtPadre").value;
    jerarquia = document.getElementById("txtJerarquia").value;
    titulo = document.getElementById("txtTitulo").value;
    estado = document.getElementById("cboEstado").value;
    orden = document.getElementById("txtOrden").value;
    nivel = document.getElementById("txtNivel").value;
    idVersion = document.getElementById("cboVersion").value;

    patronModulo = 'nuevo_actualizarExamenFisico';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + idExamen;
    parametros += '&p3=' + codPadre;
    parametros += '&p4=' + jerarquia;
    parametros += '&p5=' + titulo;
    parametros += '&p6=' + estado;
    parametros += '&p7=' + orden;
    parametros += '&p8=' + nivel;
    parametros += '&p9=' + idVersion;
    parametros += '&p10=' + opt;

    new Ajax.Request(pathRequestControl,
    {
        method: 'post',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            //            $('Div_programacionMedicosActoMedico').update(respuesta);
            if (opt == 'nuevo') {
                document.getElementById("divEdita").style.display = 'block';
                document.getElementById("divGraba").style.display = 'none';
                document.getElementById("divActualiza").style.display = 'none';
                document.getElementById("divElimina").style.display = 'none';
                document.getElementById("btnAsignarPadre").style.visibility = 'visible';
                document.getElementById("txtTitulo").disabled = true;
                document.getElementById("cboEstado").disabled = true;
                document.getElementById("txtOrden").disabled = true;
            } else if (opt == 'actualizar') {
                document.getElementById("txtPadre").value = '';
                document.getElementById("txtJerarquia").value = '';
                document.getElementById("txtTitulo").value = '';
                document.getElementById("cboEstado").value = '';
                document.getElementById("txtOrden").value = '';
                document.getElementById("txtNivel").value = '';
                document.getElementById("txtDescripcionPadre").value = '';
                document.getElementById("divEdita").style.display = 'none';
                document.getElementById("divGraba").style.display = 'block';
                document.getElementById("divActualiza").style.display = 'none';
                document.getElementById("divElimina").style.display = 'none';
                document.getElementById("btnAsignarPadre").style.visibility = 'visible';
            }
            arbolExamenFisico();
        }
    }
    )
}

function nuevoExamen() {
    document.getElementById("hidIdExamen").value = '';
    document.getElementById("txtPadre").value = '';
    document.getElementById("txtJerarquia").value = '';
    document.getElementById("txtTitulo").value = '';
    document.getElementById("cboEstado").value = 1;
    document.getElementById("txtOrden").value = '';
    document.getElementById("txtNivel").value = '';
    document.getElementById("txtDescripcionPadre").value = '';
    document.getElementById("divEdita").style.display = 'none';
    document.getElementById("divGraba").style.display = 'block';
    document.getElementById("divActualiza").style.display = 'none';
    document.getElementById("divElimina").style.display = 'none';
    document.getElementById("btnAsignarPadre").style.visibility = 'visible';
    document.getElementById("txtTitulo").disabled = false;
    document.getElementById("cboEstado").disabled = false;
    document.getElementById("txtOrden").disabled = false;
    document.getElementById("divExamenPrueba").style.display = 'none';
}
function eliminaExamenFisico() {
    idExamen = $("hidIdExamen").value;
    idVersion = $("cboVersion").value;
    nomExamen = $("txtTitulo").value;
    parametros = "p1=eliminaExamenFisico&p2=" + idExamen + "&p3=" + idVersion;
    if (window.confirm("Desea eliminar el Exámen : " + nomExamen + "?")) {
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                respuesta = transport.responseText;
            }
        })
    }
}

function selectNoAsignado(id, texto) {
    $("hidIdEmanen").value = id;
    $("txtEmanen").value = texto;
}
function asignarExamenPrueba() {
    idVersion = $("cboVersion").value;
    idExamen = $("hidIdExamen").value;
    idPrueba = $("hidIdPrueba").value;
    nomExamen = $("txtTitulo").value;
    nomPrueba = $("hidNomPrueba").value;
    //    nomPrueba= $("cboPrueba").options[$("cboPrueba").selectedIndex].text;
    //    alert("hidIdEmanenx  "+idExamen+"  cboPrueba  "+idPrueba);
    parametros = 'p1=asignarExamenPrueba' + '&p2=' + idExamen + '&p3=' + idPrueba + '&p4=' + idVersion;
    if (idPrueba == "") {
        alert("por favor seleccione una prueba ...!");
        return
    }
    if (window.confirm("Desea asignar el Exámen " + nomExamen + " a la Prueba : " + nomPrueba + "?")) {
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                respuesta = transport.responseText;
                var dato = respuesta.split("|");
                if (dato[0] > 0) {
                    mostrartablaExamenPrueba(idExamen);
                }
            }
        })
    }
}

function mostrarTblPruebas() {
    var idVersion = document.getElementById("cboVersion").value;
    parametros = "p1=datosPruebas&p2=" + idVersion;
    mygridY = new dhtmlXGridObject('divtbl_pruebas');
    mygridY.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    mygridY.setSkin("dhx_skyblue");
    mygridY.attachEvent("onRowSelect", setIdPrueba);
    mygridY.enableRowsHover(true, 'grid_hover');
    //    mygridY.attachEvent("onRowDblClicked", dbclickeditarPrueba);
    mygridY.init();
    mygridY.loadXML(pathRequestControl + '?' + parametros);
}

function mostrarTblServicios() {  //listaServicios
    parametros = '';
    parametros += "p1=listaServicios";
    mygridw = new dhtmlXGridObject('divServicios');
    mygridw.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    mygridw.setSkin("dhx_skyblue");
    mygridw.attachEvent("onRowSelect", setDatosservicios);
    mygridw.enableRowsHover(true, 'grid_hover');
    mygridw.init();
    mygridw.loadXML(pathRequestControl + '?' + parametros);
}

function setIdPrueba(fila, columna) {
    idPrueba = mygridY.cells(fila, 0).getValue();
    nomPrueba = mygridY.cells(fila, 1).getValue();
    document.getElementById("hidIdPrueba").value = idPrueba;
    document.getElementById("hidNomPrueba").value = nomPrueba;
}

function mostrartablaExamenPrueba(idExamen) {
    parametros = "p1=datosExamenPrueba&p2=" + idExamen;
    var mygridX = new dhtmlXGridObject('divtablaExamenPrueba');
    mygridX.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    mygridX.setSkin("dhx_skyblue");
    mygridX.enableRowsHover(true, 'grid_hover');
    mygridX.attachEvent("onRowSelect", desactivarExamenPrueba);
    //    mygridX.attachEvent("onRowDblClicked", dbclickeditarPrueba);
    mygridX.init();
    mygridX.loadXML(pathRequestControl + '?' + parametros);
}

function desactivarExamenPrueba(event_id, native_event_object) {

    //=====================   Eliminar  Prueba==========================
    idExamen = $("hidIdExamen").value;
    idExPr = mygridX.cells(mygridX.getSelectedId(), 11).getValue();
    estadoExPr = mygridX.cells(mygridX.getSelectedId(), 9).getValue();
    //    alert("idExPr"+idExPr+" estadoExPr"+estadoExPr+" hidIdExamen"+idExamen);
    //        return;
    if (native_event_object == 10) {
        if (estadoExPr == 0) {
            //msjActivar
            msj = "Esta seguro que desea desactivar, pienselo bién ...?";
        } else if (estadoExPr == 1) {
            //msjDesactivar
            msj = "Esta seguro de querer activar ...?";
        }
        patronModulo = 'act_desExamenPrueba';
        parametros = 'p1=' + patronModulo + '&p2=' + idExPr + '&p3=' + estadoExPr;
        if (window.confirm(msj)) {
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function(transport) {
                    micargador(0);
                    mostrartablaExamenPrueba(idExamen);
                // respuesta = transport.responseText;
                // var miarray=respuesta.split("|");
                //                    mostrartablaExamenPrueba();
                //                    mostrartablaExamenServicio();
                }
            })
        }
    }

}


/*
 function desactivarExamenPrueba(event_id, native_event_object){
 var estado="";
 if(native_event_object==4){
 //=====================   Eliminar  Prueba==========================
 idPrueba=mygridX.cells(mygridX.getSelectedId(),0).getValue();
 patronModulo='act_desPrueba';
 if(mygridX.cells(mygridX.getSelectedId(),2).getValue()==1){
 parametros='p1='+patronModulo+'&p2='+idPrueba+'&p3=desactivar';
 estado="desactivar";
 }else if(mygridX.cells(mygridX.getSelectedId(),2).getValue()==0){
 parametros='p1='+patronModulo+'&p2='+idPrueba+'&p3=activar';
 estado="activar";
 }
 nomPrueba=mygridX.cells(mygridX.getSelectedId(),1).getValue();
 if(window.confirm("Desea "+estado+" la Prueba : "+nomPrueba+"?")){
 new Ajax.Request(pathRequestControl,{
 method : 'get',
 parameters : parametros,
 onLoading : micargador(1),
 onComplete : function(transport){
 micargador(0);
 // respuesta = transport.responseText;
 // var miarray=respuesta.split("|");
 //                    mostrartablaExamenPrueba();
 //                    mostrartablaExamenServicio();
 }
 } )
 }
 }
 if(native_event_object==9){
 //=====================   Eliminar  Examen==========================
 idExamen=mygridX.cells(mygridX.getSelectedId(),5).getValue();
 patronModulo='act_desExamen';
 if(mygridX.cells(mygridX.getSelectedId(),7).getValue()==1){
 parametros='p1='+patronModulo+'&p2='+idExamen+'&p3=desactivar';
 estado="desactivar";
 }else if(mygridX.cells(mygridX.getSelectedId(),7).getValue()==0){
 parametros='p1='+patronModulo+'&p2='+idExamen+'&p3=activar';
 estado="activar";
 }
 nomExamen=mygridX.cells(mygridX.getSelectedId(),6).getValue();
 if(window.confirm("Desea "+estado+" la Prueba : "+nomExamen+"?")){
 new Ajax.Request(pathRequestControl,{
 method : 'get',
 parameters : parametros,
 onLoading : micargador(1),
 onComplete : function(transport){
 micargador(0);
 // respuesta = transport.responseText;
 // var miarray=respuesta.split("|");
 mostrartablaExamenPrueba();
 }
 } )
 }
 }
 }   */

function resultadoPrueba(nomPrueba) {
    //----------------------------------------------
    parametros = '';
    if (nomPrueba == "") {
        parametros += 'p1=resultado_prueba';
    }
    else {
        parametros += "p1=buscarPrueba&p2=" + nomPrueba;
    }
    //----------------------------------------------
    //    mygridX=new dhtmlXGridObject('tablaPrueba');
    //    mygridX.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    //    mygridX.setSkin("dhx_skyblue");
    //    mygridX.attachEvent("onRowSelect", editelimPrueba);
    //    mygridX.attachEvent("onRowDblClicked", dbclickeditarPrueba);
    //    mygridX.enableRowsHover(true,'grid_hover');
    //    mygridX.init();
    //    mygridX.loadXML(pathRequestControl+'?'+parametros);
    TablaresultadoPrueba = new dhtmlXGridObject('tablaPrueba');

    TablaresultadoPrueba.setImagePath("../../../imagen/dhtmlxgrid/imgs/");

    TablaresultadoPrueba.setSkin("dhx_skyblue");

    TablaresultadoPrueba.enableRowsHover(true, 'grid_hover');
    TablaresultadoPrueba.attachEvent("onRowSelect", function(rId, cInd) {
        var idPrueba = TablaresultadoPrueba.cells(TablaresultadoPrueba.getSelectedId(), 1).getValue();
        var Estado = TablaresultadoPrueba.cells(TablaresultadoPrueba.getSelectedId(), 4).getValue();
        if (cInd <= 5) {
            dbclickeditarPrueba(rId, cInd);
        }
        else if (cInd == 6) {
            editelimPrueba(rId, cInd, Estado)
        }
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    TablaresultadoPrueba.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    TablaresultadoPrueba.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    TablaresultadoPrueba.setSkin("dhx_skyblue");
    TablaresultadoPrueba.init();
    TablaresultadoPrueba.loadXML(pathRequestControl + '?' + parametros, function() {
        });

}
function dbclickeditarPrueba(rId, cInd) {
    //    idPrueba=mygridX.cells(mygridX.getSelectedId(),0).getValue();
    //    nomPrueba=mygridX.cells(mygridX.getSelectedId(),1).getValue();
    idPrueba = TablaresultadoPrueba.cells(TablaresultadoPrueba.getSelectedId(), 1).getValue();
    nomPrueba = TablaresultadoPrueba.cells(TablaresultadoPrueba.getSelectedId(), 2).getValue();
    editarPrueba(idPrueba, nomPrueba);
    editarCampos(idPrueba, nomPrueba);
}
function editarPrueba(idPrueba, nomPrueba) {
    patronModulo = 'editaPrueba';
    var miCampo = ["txtnomPrueba", "txtOrden", "cboEstadoPrueba"];
    //    parametros='p1='+patronModulo;
    //    new Ajax.Request(pathRequestControl,{
    //        method : 'get',
    //        parameters : parametros,
    //        onLoading : micargador(1),
    //        onComplete : function(transport){
    //            micargador(0);
    //            respuesta = transport.responseText;
    //            $('divMantenimiento').update(respuesta);
    document.getElementById("hidIdPrueba").value = idPrueba;
    document.getElementById("txtnomPrueba").value = nomPrueba;
    document.getElementById("txtOrden").value = TablaresultadoPrueba.cells(TablaresultadoPrueba.getSelectedId(), 3).getValue();
    document.getElementById("cboEstadoPrueba").value = TablaresultadoPrueba.cells(TablaresultadoPrueba.getSelectedId(), 4).getValue();
    /*********************************************/
    deshabilitarCampos(miCampo);
    /*********************************************/
    document.getElementById("divGrabar").style.display = 'none';
    document.getElementById("divEditar").style.display = 'block';
    document.getElementById("divActualizar").style.display = 'none';
    document.getElementById("divRestaurar").style.display = 'none';
//        }
//    } )
}
function postEditarPrueba() {
    idPrueba = document.getElementById("hidIdPrueba").value;
    nomPrueba = document.getElementById("txtnomPrueba").value;
    orden = document.getElementById("txtOrden").value;
    stdPrueba = document.getElementById("cboEstadoPrueba").value;
    var miCampo = ["txtnomPrueba", "txtOrden", "cboEstadoPrueba"];
    /***************************************/
    habilitarCampos(miCampo);
    /***************************************/
    parametros = 'p1=postEditaPrueba' + '&p2=' + idPrueba + '&p3=' + nomPrueba + '&p4=' + orden + '&p5=' + stdPrueba;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('divMantenimiento').update(respuesta);
            //            document.getElementById("hidIdPrueba").value=idPrueba;
            //            document.getElementById("txtnomPrueba").value=nomPrueba;
            //            document.getElementById("txtOrden").value=orden;
            //            document.getElementById("cboEstadoPrueba").value=stdPrueba;
            document.getElementById("divGrabar").style.display = 'none';
            document.getElementById("divEditar").style.display = 'none';
            document.getElementById("divActualizar").style.display = 'block';
            document.getElementById("divRestaurar").style.display = 'block';
        }
    })
}
function restaurarPrueba() {
    $('formPrueba').reset();
    var miCampo = ["txtnomPrueba", "txtOrden", "cboEstadoPrueba"];
    deshabilitarCampos(miCampo);
    document.getElementById("divGrabar").style.display = 'none';
    document.getElementById("divEditar").style.display = 'block';
    document.getElementById("divActualizar").style.display = 'none';
    document.getElementById("divRestaurar").style.display = 'none';
}

function editelimPrueba(event_id, native_event_object, bEstado) {
    idPrueba = TablaresultadoPrueba.cells(TablaresultadoPrueba.getSelectedId(), 1).getValue();
    patronModulo = 'act_desPrueba';
    var estado = "";
    if (bEstado == 1) {
        parametros = 'p1=' + patronModulo + '&p2=' + idPrueba + '&p3=desactivar';
        estado = "desactivar";
    } else if (bEstado == 0) {
        parametros = 'p1=' + patronModulo + '&p2=' + idPrueba + '&p3=activar';
        estado = "activar";
    }
    nomPrueba = TablaresultadoPrueba.cells(TablaresultadoPrueba.getSelectedId(), 2).getValue();
    if (window.confirm("Desea " + estado + " la Prueba : " + nomPrueba + "?")) {
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                // respuesta = transport.responseText;
                // var miarray=respuesta.split("|");
                resultadoPrueba("");
            }
        })
    }
}
function buscarPrueba() {
    nomPrueba = document.getElementById("txtNombrePrueba").value;
    if (nomPrueba.length < 5) {
        alert("Por favor imgresar mas de 4 caracteres para iniciar la búsqueda");
        return;
    }
    resultadoPrueba(nomPrueba);
}

function grabarPrueba(hacer) {
    idPrueba = document.getElementById("hidIdPrueba").value;
    nombrePrueba = document.getElementById("txtnomPrueba").value;
    orden = document.getElementById("txtOrden").value;
    estPrueba = document.getElementById("cboEstadoPrueba").value;
    data = "p1=grabarPrueba&p2=" + idPrueba + "&p3=" + nombrePrueba + "&p4=" + orden + "&p5=" + estPrueba + "&p6=" + hacer;
    var miCampo = ["txtnomPrueba", "txtOrden", "cboEstadoPrueba"];

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: data,
        onLoading: micargador(1),
        asynchronous: false,
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('divMostrarCampo').update(respuesta);
            deshabilitarCampos(miCampo);
            document.getElementById("divGrabar1").style.display = 'block';
            if (hacer == 'nuevo') {
                document.getElementById("divGrabar").style.display = 'none';
                document.getElementById("divEditar").style.display = 'block';
                document.getElementById("divActualizar").style.display = 'none';
                document.getElementById("divRestaurar").style.display = 'none';
            }
        }
    })
    resultadoPrueba("");
    if (hacer == 'modificar') {
        document.getElementById("divGrabar").style.display = 'none';
        document.getElementById("divEditar").style.display = 'block';
        document.getElementById("divActualizar").style.display = 'none';
        document.getElementById("divRestaurar").style.display = 'none';
    }
}

function agregaMasCampo(id, kk) {
    //    alert(id);
    //    alert(kk);
    document.getElementById("divGrabar1").style.display = 'block';
    document.getElementById("divEditar1").style.display = 'none';
    tbody = document.getElementById(id).getElementsByTagName("TBODY")[0];
    //  alert(tbody);
    row = document.createElement("tr");
    td1 = document.createElement("td");
    td2 = document.createElement("td");
    td3 = document.createElement("td");
    td4 = document.createElement("td");
    td5 = document.createElement("td");
    caja1 = document.createElement("input");
    caja2 = document.createElement("input");
    caja3 = document.createElement("input");
    caja4 = document.createElement("input");
    link = document.createElement("a");
    img = document.createElement("img");
    sel1 = document.createElement("select");
    sel2 = document.createElement("select");
    chk = document.createElement("input");
    val = $('divCampo').innerHTML;
    cadena = new Array();
    kk = parseInt(val) + 1;

    dataCombo('cbTipoCampo');
    dataCombo('cbEstado');
    function dataCombo(nomcbo) {
        z = 0;
        for (i = 0; i < kk - 1; i++) {
            j = i + 1;
            tipoCam = nomcbo + "[" + j + "]";
            if (document.getElementById(tipoCam)) {
                cadena[z] = $(tipoCam).value;
                z = z + 1;
            }
        }
        return;
    }
    //    alert(cadena.join(","));
    //    cadDocs = cadena.join(",");
    //    alert(cadDocs);
    $('divCampo').innerHTML = kk;
    cbTC = "cbTipoCampo[" + kk + "]";
    txtNC = "txtNombreCampo[" + kk + "]";
    txtOr = "txtOrden[" + kk + "]";
    hidIdCombox = "hidIdCombo[" + kk + "]";
    hidIdCampo = "hidIdCampo[" + kk + "]";
    checked = "bObligatorio[" + kk + "]";
    cbEs = "cbEstado[" + kk + "]";
    img.src = "../../../imagen/inicio/eliminar.gif";
    link.setAttribute("href", "#");
    if (navigator.userAgent.indexOf("MSIE") != -1)
        link.setAttribute("onclick", function() {
            eliminaRowCampo(kk)
        });
    else
        link.setAttribute("onclick", "eliminaRowCampo(" + kk + ");");

    //    link.onclick = function () {eliminaRowCampo(kk)};
    caja2.setAttribute("type", "text");
    caja2.setAttribute("id", txtNC);
    caja2.setAttribute("name", txtNC);
    caja2.setAttribute("value", '');
    //    caja1.setAttribute("onkeypress", "return validFormSalt('nro',this,event,'txtApellidoPat');");
    //    caja1.setAttribute("onblur","valida_docIdentidad("+kk+")");
    caja2.setAttribute("style", "width:100px;");

    caja1.setAttribute("type", "text");
    caja1.setAttribute("id", txtOr);
    caja1.setAttribute("name", txtOr);
    caja1.setAttribute("value", '');
    caja1.setAttribute("style", "width:100px;");


    chk.setAttribute("type", "checkbox");
    chk.setAttribute("id", checked);
    chk.setAttribute("name", checked);
    chk.setAttribute("value", 1);

    caja3.setAttribute("type", "hidden");
    caja3.setAttribute("id", hidIdCombox);
    caja3.setAttribute("name", hidIdCombox);
    caja3.setAttribute("value", '');
    caja3.setAttribute("style", "width:100px;");
    //caja.setAttribute("readonly","readonly");

    caja4.setAttribute("type", "hidden");
    caja4.setAttribute("id", hidIdCampo);
    caja4.setAttribute("name", hidIdCampo);
    caja4.setAttribute("value", '');
    caja4.setAttribute("style", "width:100px;");

    sel1.setAttribute("style", "width:120px");
    sel1.setAttribute("size", "1");
    sel1.setAttribute("name", cbTC);
    sel1.setAttribute("id", cbTC);
    sel1.setAttribute("onchange", "verficaTipo(this);");
    //    sel1.setAttribute("onchange","verficaTipo("+kk+");");
    //    sel1.setAttribute("onchange","validaTxtNroDoc("+kk+");");

    sel2.setAttribute("style", "width:85px");
    sel2.setAttribute("size", "1");
    sel2.setAttribute("name", cbEs);
    sel2.setAttribute("id", cbEs);
    //    sel2.setAttribute("onchange","validaTxtNroDoc("+kk+");");

    row.setAttribute("id", "rowTipoDoc" + kk);
    opcionvar1 = document.createElement("option");
    opcionvar1.innerHTML = "Seleccionar";
    opcionvar1.value = "";
    opcionvar2 = document.createElement("option");
    opcionvar2.innerHTML = "Seleccionar";
    opcionvar2.value = "";


    sel1.appendChild(opcionvar1);
    sel2.appendChild(opcionvar2);
    td1.appendChild(sel2);
    td2.appendChild(caja1);
    td3.appendChild(caja2);
    td3.appendChild(caja4);
    td4.appendChild(sel1);
    td4.appendChild(caja3);
    td5.appendChild(chk);
    link.appendChild(img)

    td1.appendChild(link);
    row.appendChild(td4);
    row.appendChild(td3);
    row.appendChild(td2);
    row.appendChild(td5);
    row.appendChild(td1);
    tbody.appendChild(row);

    llenarComboxxx('campo', 'cbTipoCampo', 1);
    llenarComboxxx('estado', 'cbEstado', 2);

    function llenarComboxxx(opcion, nomcbo, k) {
        url = '../../ccontrol/control/control.php';
        control = 'recuperarCombosCampos';
        data = 'p1=' + control + '&p2=' + opcion;
        new Ajax.Request(url,
        {
            method: 'get',
            parameters: data,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                if (transport.readyState == '4') {
                    xml = transport.responseXML;
                    indice = xml.getElementsByTagName('indice');
                    descripcion = xml.getElementsByTagName('descripcion');
                    a = nomcbo + "[" + kk + "]";
                    var f;
                    if (k == 1) {
                        select1 = document.getElementById(a);
                        select1.options.length = 0;
                        for (f = 0; f < indice.length; f++) {
                            opt = document.createElement('option');
                            codigo = indice[f].firstChild.nodeValue;
                            texto = document.createTextNode(descripcion[f].firstChild.nodeValue);
                            opt.value = codigo;
                            opt.appendChild(texto)
                            select1.appendChild(opt);
                        }
                    }
                    if (k == 2) {
                        select2 = document.getElementById(a);
                        select2.options.length = 0;
                        for (f = 0; f < indice.length; f++) {
                            opt2 = document.createElement('option');
                            codigo = indice[f].firstChild.nodeValue;
                            texto = document.createTextNode(descripcion[f].firstChild.nodeValue);
                            opt2.value = codigo;
                            opt2.appendChild(texto)
                            select2.appendChild(opt2);
                        }
                    }
                }
            }
        }
        )
    }

}

function eliminaRowCampo(kk) {
    $('divCampo').innerHTML = kk - 1;
    el = document.getElementById('rowTipoDoc' + kk);
    padre = el.parentNode;
    padre.removeChild(el);
}

function editarCampos(idPrueba, nomPrueba) {
    //    alert(idPrueba);
    //    alert(nomPrueba);
    patronModulo = 'editaCampos';
    parametros = 'p1=' + patronModulo + '&p2=' + idPrueba + '&p3=' + nomPrueba
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('divMostrarCampo').update(respuesta);
            document.getElementById("hidIdPruebaC").value = idPrueba;
            document.getElementById("divGrabar1").style.display = 'none';
            document.getElementById("divEditar1").style.display = 'block';
            document.getElementById("divAgregar1").style.display = 'block';
            document.getElementById("divActualizar1").style.display = 'none';
            document.getElementById("divRestaurar1").style.display = 'none';
        }
    })
}
function postEditarCampo() {
    document.getElementById("divGrabar1").style.display = 'none';
    document.getElementById("divEditar1").style.display = 'none';
    document.getElementById("divAgregar1").style.display = 'none';
    document.getElementById("divActualizar1").style.display = 'block';
    document.getElementById("divRestaurar1").style.display = 'block';
    habilitarCampoArreglo();
}
function habilitarCampoArreglo() {
    var val = $('divCampo').innerHTML;
    var i;
    for (i = 1; i < val + 1; i++) {
        p1 = document.getElementById("txtNombreCampo[" + i + "]");
        p2 = document.getElementById("txtOrden[" + i + "]");
        p3 = document.getElementById("cbEstado[" + i + "]");
        p4 = document.getElementById("cbTipoCampo[" + i + "]");
        p5 = document.getElementById("bObligatorio[" + i + "]");
        if (p1 && p2 && p3 && p4 && p5) {
            p1.disabled = false;
            p2.disabled = false;
            p3.disabled = false;
            p4.disabled = false;
            p5.disabled = false;
        }
    }
}
function deshabilitarCampoArreglo() {
    var val = $('divCampo').innerHTML;
    var i;
    for (i = 1; i < val + 1; i++) {
        p1 = document.getElementById("txtNombreCampo[" + i + "]");
        p2 = document.getElementById("txtOrden[" + i + "]");
        p3 = document.getElementById("cbEstado[" + i + "]");
        p4 = document.getElementById("cbTipoCampo[" + i + "]");
        p5 = document.getElementById("bObligatorio[" + i + "]");
        if (p1 && p2 && p3 && p4 && p5) {
            p1.disabled = true;
            p2.disabled = true;
            p3.disabled = true;
            p4.disabled = true;
            p5.disabled = true;
        }
    }
}
function restaurarCampo() {
    $('formNuevoCampo').reset();
    //    var miCampo = ["txtnomPrueba","txtOrden","cboEstadoPrueba"];
    //    deshabilitarCampos(miCampo);
    deshabilitarCampoArreglo();
    document.getElementById("divGrabar1").style.display = 'none';
    document.getElementById("divEditar1").style.display = 'block';
    document.getElementById("divAgregar1").style.display = 'block';
    document.getElementById("divActualizar1").style.display = 'none';
    document.getElementById("divRestaurar1").style.display = 'none';
}

function eliminarDbCampo(val) {
    nomCampo = document.getElementById("txtNombreCampo[" + val + "]").value;
    idCampo = document.getElementById("hidIdCampo[" + val + "]").value;
    idCombo = document.getElementById("hidIdCombo[" + val + "]").value;
    if (window.confirm("Desea eliminar  el campo : " + nomCampo + " ?")) {
        parametros = "p1=eliminarDbCampo&p2=" + idCampo + "&p3=" + idCombo;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                respuesta = transport.responseText;
                // var miarray=respuesta.split("|");
                //                    resultadoPrueba("");
                eliminaRowCampo(val);
            }
        })
    }
}

function deshabilitarCampos(miCampo) {
    for (i = 0; i < miCampo.length; i++) {
        document.getElementById(miCampo[i]).disabled = true;
    }
}

function habilitarCampos(miCampo) {
    for (i = 0; i < miCampo.length; i++) {
        document.getElementById(miCampo[i]).disabled = false;
    }
}

function grabarCampo(form, hacer) {
    var idPrueba = document.getElementById("hidIdPruebaC").value;
    var nomPrueba = document.getElementById("txtDescPrueba").value;
    var parametros = 'p2=' + idPrueba;
    var patronModulo = "grabarCampo";
    parametros += '&p1=' + patronModulo + '&p3=' + hacer + "&" + $(form).serialize();
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            document.getElementById("divGrabar1").style.display = 'none';
            document.getElementById("divEditar1").style.display = 'block';
            document.getElementById("divAgregar1").style.display = 'block';
            document.getElementById("divActualizar1").style.display = 'none';
            document.getElementById("divRestaurar1").style.display = 'none';
            deshabilitarCampoArreglo();
            resultadoPrueba("");
            editarCampos(idPrueba, nomPrueba)
        //            setTimeout(function(){dbclickeditarPrueba('','')},200);
        }
    })
}


function verficaTipo(combo) {
    //    varTipo=document.getElementById("cbTipoCampo["+nro+"]").options.text;
    varname = combo.options[combo.selectedIndex].text;
    nroTipoCampo = $('divCampo').innerHTML

    if (varname == "Combo" || varname == "combo" || varname == "COMBO") { //4 es el id del item combo
        mantenimientoCombo(nroTipoCampo, 'nuevo', '');
    }

}

function editarCombo(nroTipoCampo) {    //nroTipoCampo para recuperar el combo con numero nroTipoCampo
    idCompo = document.getElementById("hidIdCombo[" + nroTipoCampo + "]").value;
    mantenimientoCombo(nroTipoCampo, 'modificar', idCompo);
}

function mantenimientoCombo(nroTipoCampo, opt, idCompo) {

    vFormaAbrir = 'VENTANA'
    vwidth = '400'
    vheight = '400'
    if (opt == 'nuevo') {
        titulo = 'Nuevo'
        vformname = 'nuevoCombo'
        vtitle = 'REGISTRAR NUEVO COMBO'
        patronModulo = 'nuevoCombo'
        /*---------------------------------------*/
        parametros = '';
        parametros += 'p1=' + patronModulo;
    /*--------------------------------------*/
    } else if (opt == 'modificar') {
        titulo = 'Modificar'
        vformname = 'editarCombo'
        vtitle = 'MODIFICAR COMBO'
        patronModulo = 'editarCombo'
        /*---------------------------------------*/
        parametros = '';
        parametros += 'p1=' + patronModulo + '&p2=' + idCompo;
    /*--------------------------------------*/
    }
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
    aux = nroTipoCampo
    //    posFuncion='asignarPadreExamenFisico';
    posFuncion = '';

    mostrarVentana(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion, aux, opt)
}

function mostrarVentana(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion, aux, opt)
{
    myRand = parseInt(Math.random() * 999999999999999);
    if (vwidth == undefined || vwidth == 0)
        vwidth = 700;
    if (vheight == undefined || vheight == 0)
        vheight = 400;
    if (vposx1 == undefined || vposx1 == 0)
        vposx1 = 25;
    if (vposy1 == undefined || vposy1 == 0)
        vposy1 = 110;
    if (vposx2 == undefined || vposx2 == 0)
        vposx2 = 25;
    if (vposy2 == undefined || vposy2 == 0)
        vposy2 = 110;

    if (vresizable == undefined || vresizable == 0)
        vresizable = true;
    else
        vresizable = false;
    if (vstyle == undefined || vstyle == 0)
        vstyle = "alphacube";   // fondo y estilo
    //if(veffect==veffect || veffect==0) veffect="popup_effect";
    if (vmodal == undefined || vmodal == 0)
        vmodal = false;
    else
        vmodal = true;
    if (vopacity == undefined || vopacity == 0)
        vopacity = 1;
    if (vcenter == undefined || vcenter == 0 || vcenter == 't')
        vcenter = true;
    else
        vcenter = false;
    if (vtitle == undefined)
        vtitle = vformname;
    if (!ExisteObjeto("Div_" + vformname))
    {
        var vidfrm;
        // file02=decodeURIComponent(file02);
        var vid = "Div_" + vformname;
        vidfrm = "Frm_" + vformname;
        var vzindex = 100;
        var win;
        if (vmodal == true || vmodal == 1)
            win = new Window({
                id: vid,
                className: vstyle,
                title: vtitle,
                width: vwidth,
                height: vheight,
                zIndex: vzindex,
                opacity: vopacity,
                resizable: vresizable
            });
        else
            win = new Window({
                id: vid,
                className: vstyle,
                title: vtitle,
                width: vwidth,
                height: vheight,
                resizable: vresizable
            });
        win.getContent().innerHTML = "<div id='" + vidfrm + "'></div>";
        //win.getContent().innerHTML = "<h1>No Constraint</h1>Wired mode<br><a href='#' onclick='Windows.getWindow(\"win3\").maximize()'>Maximize me</a>";
        win.setDestroyOnClose();
        if (vcenter == true || vcenter == 1)
            win.showCenter(vmodal);
        else
            win.show(vmodal);
        win.setConstraint(true, {
            left: vposx1,
            right: vposx2,
            top: vposy1,
            bottom: 'auto'
        })
        win.toFront();

        new Ajax.Request(pathRequestControl,
        {
            method: 'get',
            parameters: parametros,
            onComplete: function(transport) {
                respuesta = transport.responseText;
                $(vidfrm).update(respuesta);
                /*------------------------*/
                $("hidnroTipoCampo").value = aux;
                if (opt == 'nuevo') {
                    document.getElementById("nuevoCombo").style.display = 'block';
                    document.getElementById("verCombo").style.display = 'block';
                }
                else if (opt == 'modificar') {
                    document.getElementById("nuevoCombo").style.display = 'none';
                    document.getElementById("modificarCombo").style.display = 'block';
                    document.getElementById("verCombo").style.display = 'none';
                }
            }
        }
        )
    }
}

function agregarPrueba() {
    descripcion = document.getElementById("txtTitulo").value;
    document.getElementById("txtDescPrueba").value = descripcion;
}

//function mantenimientoExamenespruebas(){
//    cboPruebas();
//}

//function cboPruebas(){
//    patronModulo="pruebasNoAsignadas";
//    parametros+='&p1='+patronModulo;
//    new Ajax.Request( pathRequestControl,{
//        method : 'get',
//        parameters : parametros,
//        onLoading : micargador(1),
//        onComplete : function(transport){
//            micargador(0);
//            respuesta = transport.responseText;
//        }
//    })
//}
//------------------ items combos -------------------------------
function agregaMasItemsCombo(id, kk) {

    tbody = document.getElementById(id).getElementsByTagName("TBODY")[0];
    row = document.createElement("tr");
    td1 = document.createElement("td");
    td2 = document.createElement("td");
    td3 = document.createElement("td");
    td4 = document.createElement("td");
    caja1 = document.createElement("input");
    caja2 = document.createElement("input");
    link = document.createElement("a");
    img = document.createElement("img");
    sel1 = document.createElement("select");
    sel2 = document.createElement("select");
    val = $('divValorCombo').innerHTML;
    cadena = new Array();
    kk = parseInt(val) + 1;

    $('divValorCombo').innerHTML = kk;

    txtTexto = "txtTexto[" + kk + "]";
    txtValue = "txtValue[" + kk + "]";
    img.src = "../../../imagen/inicio/eliminar.gif";
    link.setAttribute("href", "#");
    if (navigator.userAgent.indexOf("MSIE") != -1)
        link.setAttribute("onclick", function() {
            eliminaRowCombo(kk)
        });
    else
        link.setAttribute("onclick", "eliminaRowCombo(" + kk + ");");

    caja1.setAttribute("type", "text");
    caja1.setAttribute("id", txtTexto);
    caja1.setAttribute("name", txtTexto);
    caja1.setAttribute("value", '');
    caja1.setAttribute("style", "width:100px;");

    caja2.setAttribute("type", "text");
    caja2.setAttribute("id", txtValue);
    caja2.setAttribute("name", txtValue);
    caja2.setAttribute("value", kk);
    caja2.setAttribute("size", "3");
    row.setAttribute("id", "rowMasCombo" + kk);

    td2.appendChild(caja2);
    td3.appendChild(caja1);
    link.appendChild(img)
    td1.appendChild(link);
    row.appendChild(td3);
    row.appendChild(td2);
    row.appendChild(td1);
    tbody.appendChild(row);
}

function eliminaRowCombo(kk) {
    el = document.getElementById('rowMasCombo' + kk);
    padre = el.parentNode;
    padre.removeChild(el);
    $('divValorCombo').innerHTML = kk - 1;
}
function eliminaDbCombo(val) {
    idCombo = document.getElementById("hididCombo").value;
    texto = document.getElementById("txtTexto[" + val + "]").value;
    idValCombo = document.getElementById("hidIdValCombo[" + val + "]").value;
    value = document.getElementById("txtValue[" + val + "]").value;
    nomCombo = document.getElementById("txtnomCombo").value;
    if (window.confirm("Desea eliminar  el Combo : " + nomCombo + " ?")) {
        parametros = "p1=eliminaDbCombo&p2=" + idCombo + "&p3=" + idValCombo;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                respuesta = transport.responseText;
                eliminaRowCombo(val);
            }
        })
    }
}
function grabarCombo(form, opt) {
    patronModulo = 'grabarCombo';
    parametros = '';
    parametros += 'p1=' + patronModulo + '&p2=' + opt + '&' + $(form).serialize()
    indice = $('hidnroTipoCampo').value;
    new Ajax.Request(pathRequestControl, {
        method: 'post',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            var idCombo = respuesta.split("|");
            if (idCombo[0] > 0 && opt == 'nuevo') {
                Windows.close("Div_nuevoCombo", '');
                alert("Se creo el Combo con ID :" + idCombo[0] + " de manera satisfactória !");
                document.getElementById("hidIdCombo[" + indice + "]").value = idCombo[0];
            }
        }
    })
}

function verCombo() {
    parametros = '';
    parametros += "p1=selectCombo";
    mygridX = new dhtmlXGridObject('divCombo');
    mygridX.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    mygridX.setSkin("dhx_skyblue");
    mygridX.attachEvent("onRowSelect", verValorCombo);
    mygridX.attachEvent("onRowDblClicked", asignarCombo);
    mygridX.init();
    mygridX.loadXML(pathRequestControl + '?' + parametros);
    /*****************/
    document.getElementById("divCombo").style.display = 'block';
    document.getElementById("divNota").style.display = 'block';
    document.getElementById("divValorCombo1").style.display = 'none';
    document.getElementById("divnuevoCombo").style.display = 'none';
}

function verValorCombo(event_id, native_event_object) {
    idCombo = mygridX.cells(mygridX.getSelectedId(), 0).getValue();
    if (native_event_object == 1 && contadorGrid < 1) {
        document.getElementById("divValorCombo1").style.display = 'block';
        parametros = '';
        parametros += "p1=selectValorCombo&p2=" + idCombo;
        mygridY = new dhtmlXGridObject('divValorCombo1');
        mygridY.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
        mygridY.setSkin("dhx_skyblue");
        //    mygridY.attachEvent("onRowSelect", verValorItem);
        mygridY.init();
        mygridY.loadXML(pathRequestControl + '?' + parametros);
        contadorGrid++;
    }
    setTimeout(function() {
        iniciarContador()
    }, 3600);
}
function asignarCombo(fil, col) {
    //    hidIdCombo[1];
    idCombo = mygridX.cells(fil, 0).getValue();
    nro = document.getElementById("hidnroTipoCampo").value;
    document.getElementById("hidIdCombo[" + nro + "]").value = idCombo;
    Windows.close("Div_nuevoCombo", "");
}
function noespacios() {
    var er = new RegExp(/\s/);
    var web = document.getElementById('cdusuario_web').value;
    if (er.test(web)) {
        alert('No se permiten espacios');
        return false;
    }
    else
        return true;
}

function setDatosservicios(fila, columna) {
    idServicio = mygridw.cells(fila, 0).getValue();
    nomServicio = mygridw.cells(fila, 0).getValue();
    $("hidIdServicio").value = idServicio;
    $("hidNomServicio").value = nomServicio;
}
function asignarExamenServicio() {
    idServicio = $("hidIdServicio").value;
    idExamen = $("hidIdExamen").value;
    nomExamen = $("txtTitulo").value;
    idVersion = $("cboVersion").value;
    nomServicio = $("hidNomServicio").value;
    //    alert("idServicio "+idServicio+"idExamen "+idExamen+"idVersion "+idVersion);
    parametros = 'p1=asignarExamenServicio' + '&p2=' + idExamen + '&p3=' + idServicio + '&p4=' + idVersion;
    if (idServicio == "") {
        alert("por favor seleccione un servicio ...!");
        return
    }
    if (window.confirm("Desea asignar el Exámen " + nomExamen + " al Servicio : " + nomServicio + "?")) {
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                respuesta = transport.responseText;
                var dato = respuesta.split("|");
                if (dato[0] > 0) {
                    mostrartablaExamenServicio(idExamen);
                }
            }
        })
    }
}

/******************Junnior - Para mostrar los servicios más ordenados de acuerdo al CCosto al que pertenecen******************/

function mostrarServiciosPorCCostos() {
    vformname = 'popupServiciosPorCCostos';
    vtitle = '';
    vwidth = '900';
    vheight = '500';
    vcenter = 't';
    vresizable = '';
    vmodal = 'false';
    vstyle = '';
    vopacity = '';
    //veffect='';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    //file01='';
    //vfunctionjava='';

    patronModulo = 'cargarVentanaServiciosPorActividadDeCCostos';//pnsListaServiciosPorActividadDeCentroCosto
    parametros = '';
    parametros += 'p1=' + patronModulo;
    posFuncion = 'recargarArbolCCostosActividadServicio';

    cargarVentanaEmergente(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
}


function recargarArbolCCostosActividadServicio() {
    divArbol = document.getElementById('divArbolCCostos');
    divArbol.innerHTML = " ";
    arbolCentroCosto = new dhtmlXTreeObject("divArbolCCostos", "100%", "100%", 0);
    arbolCentroCosto.setImagePath("../../../../fastmedical_front/imagen/icono/tree/");
    arbolCentroCosto.attachEvent("onClick", function() {
        //funcionArbolCentroCosto(funcion,arbolCentroCosto.getSelectedItemId());
        var idNodo = arbolCentroCosto.getSelectedItemId();
        cargarTablaCentroCostosServicios(idNodo);
        return true;
    }
    )
    arbolCentroCosto.loadXML("../../../../carpetaDocumentos/arbol_centroCostos.xml");
    arbolCentroCosto.openAllItems(1);
    cargarTablaCentroCostosServicios('%%%')
}

function cargarTablaCentroCostosServicios(IdCenrroCosto) {
    var patronModulo = 'cargarTablaCentroCostosServicios';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + IdCenrroCosto;

    oCostosServicios = new dhtmlXGridObject('divResultadoServiciosCCostos');
    oCostosServicios.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    oCostosServicios.setSkin("dhx_skyblue");
    oCostosServicios.enableRowsHover(true, 'grid_hover');
    oCostosServicios.attachEvent("onRowSelect", function(rId, cInd) {
        IdServicio = oCostosServicios.cells(oCostosServicios.getSelectedId(), 0).getValue();
        asignarExamenAServicioPorActividadDeCCosto('', '', IdServicio)
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    oCostosServicios.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    oCostosServicios.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    oCostosServicios.setSkin("dhx_skyblue");
    oCostosServicios.init();
    oCostosServicios.loadXML(pathRequestControl + '?' + parametros, function() {
        });
}



function mostrarServiciosPorCCosto() {
    //titulo='Busqueda...';
    //vFormaAbrir='VENTANA';
    vformname = 'popupServiciosPorCCosto';
    vtitle = 'Búsqueda de Servicios por Actividad de Centro Costos';
    vwidth = '900';
    vheight = '500';
    vcenter = 't';
    vresizable = '';
    vmodal = 'false';
    vstyle = '';
    vopacity = '';
    //veffect='';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    //file01='';
    //vfunctionjava='';

    patronModulo = 'cargarVentanaServiciosPorActividadDeCCosto';//pnsListaServiciosPorActividadDeCentroCosto
    parametros = '';
    parametros += 'p1=' + patronModulo;
    posFuncion = 'cargarArbolEnVentanaEmergente';

    cargarVentanaEmergente(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
}

function cargarVentanaEmergente(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion) {
    myRand = parseInt(Math.random() * 999999999999999);
    if (vwidth == undefined || vwidth == 0)
        vwidth = 700;
    if (vheight == undefined || vheight == 0)
        vheight = 400;
    if (vposx1 == undefined || vposx1 == 0)
        vposx1 = 25;
    if (vposy1 == undefined || vposy1 == 0)
        vposy1 = 110;
    if (vposx2 == undefined || vposx2 == 0)
        vposx2 = 25;
    if (vposy2 == undefined || vposy2 == 0)
        vposy2 = 110;

    if (vresizable == undefined || vresizable == 0)
        vresizable = true;
    else
        vresizable = false;
    if (vstyle == undefined || vstyle == 0)
        vstyle = "alphacube";   // fondo y estilo
    //if(veffect==veffect || veffect==0) veffect="popup_effect";
    if (vmodal == undefined || vmodal == 0)
        vmodal = false;
    else
        vmodal = true;
    if (vopacity == undefined || vopacity == 0)
        vopacity = 1;
    if (vcenter == undefined || vcenter == 0 || vcenter == 't')
        vcenter = true;
    else
        vcenter = false;
    if (vtitle == undefined)
        vtitle = vformname;
    if (!ExisteObjeto("Div_" + vformname))
    {
        var vidfrm;
        // file02=decodeURIComponent(file02);
        var vid = "Div_" + vformname;
        vidfrm = "Frm_" + vformname;
        var vzindex = 100;
        var win;
        if (vmodal == true || vmodal == 1)
            win = new Window({
                id: vid,
                className: vstyle,
                title: vtitle,
                width: vwidth,
                height: vheight,
                zIndex: vzindex,
                opacity: vopacity,
                resizable: vresizable
            });
        else
            win = new Window({
                id: vid,
                className: vstyle,
                title: vtitle,
                width: vwidth,
                height: vheight,
                resizable: vresizable
            });
        win.getContent().innerHTML = "<div id='" + vidfrm + "'></div>";
        //win.getContent().innerHTML = "<h1>No Constraint</h1>Wired mode<br><a href='#' onclick='Windows.getWindow(\"win3\").maximize()'>Maximize me</a>";
        win.setDestroyOnClose();
        if (vcenter == true || vcenter == 1)
            win.showCenter(vmodal);
        else
            win.show(vmodal);
        win.setConstraint(true, {
            left: vposx1,
            right: vposx2,
            top: vposy1,
            bottom: 'auto'
        })
        win.toFront();

        new Ajax.Request(pathRequestControl,
        {
            method: 'get',
            parameters: parametros,
            //onLoading : micargador(1),
            onComplete: function(transport) {
                //micargador(0);
                respuesta = transport.responseText;
                $(vidfrm).update(respuesta);
                posFuncion += "('')";
                eval(posFuncion);
            }
        }
        )
    }
}

function cargarArbolEnVentanaEmergente() {
    var funcion = 'verServiciosPorActividadDeCCosto';
    recargarArbolCCostosActividadServicios(funcion);
}

function recargarArbolCCostosActividadServicios(funcion) {
    divArbol = document.getElementById('divArbolCCostos');
    divArbol.innerHTML = " ";
    arbolCentroCosto = new dhtmlXTreeObject("divArbolCCostos", "100%", "100%", 0);
    arbolCentroCosto.setImagePath("../../../../fastmedical_front/imagen/icono/tree/");
    arbolCentroCosto.attachEvent("onClick", function() {
        //funcionArbolCentroCosto(funcion,arbolCentroCosto.getSelectedItemId());
        var idNodo = arbolCentroCosto.getSelectedItemId();
        var textofuncion = funcion + "('" + idNodo + "')";
        eval(textofuncion);
        return true;
    }
    )
    //tree2.setXMLAutoLoading("../../../javascript/xml/tree_oficinas.xml");
    arbolCentroCosto.loadXML("../../../../carpetaDocumentos/arbol_centroCostos.xml");
    arbolCentroCosto.openAllItems(1);
}

function buscarEnArbolCCostosActividadServicios() {
    arbolCentroCosto.findItem(document.getElementById("txtServicioPorActividadDeCCosto").value);
}

function verServiciosPorActividadDeCCosto(idNodo) {
    verServicios(idNodo, '', 'asignarExamenAServicioPorActividadDeCCosto');
//seleccionarCentroCostoPuesto(id);
}

function verServicios(id, event, funcion) {
    opcion = '';
    codActividad = '';
    nomServicio = '';
    if (id == 'x') {
        idCCosto = 1;
    } else {
        document.getElementById('hdnCCosto').value = id;
        idCCosto = id;
    //document.getElementById('txtServicioPorActividadDeCCosto').value='Buscar...';
    }
    nomServicio = document.getElementById('txtServicioPorActividadDeCCosto').value;
    if (nomServicio == 'Buscar...') {
        nomServicio = '';
    }
    else {

    }
    //estado=$('comboEstados').value;
    //categoria=document.getElementById('comboCategoriaPuestos').value
    patronModulo = "listaServiciosPorActividadDeCCosto";
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + opcion;
    parametros += '&p3=' + idCCosto;
    parametros += '&p4=' + codActividad;
    parametros += '&p5=' + nomServicio;
    parametros += '&p6=' + funcion;
    if (event == '') {
        tecla = 13;
    } else {
        tecla = event.keyCode;
    }
    if (tecla == 13) {
        new Ajax.Request(pathRequestControl,
        {
            method: 'get',
            parameters: parametros,
            //onLoading : micargador(1),
            onComplete: function(transport) {
                //micargador(0);
                respuesta = transport.responseText;
                $('divResultadoServiciosCCostos').update(respuesta);
            //limpiarDetallePuesto();
            //$('imagenEditar').hide();
            }
        }
        )
    }
}

function asignarExamenAServicioPorActividadDeCCosto(elementoFila, elementoEvento, columna) {//Columna 0 es codSerPro
    // alert(columna);
    Windows.close("Div_popupServiciosPorCCosto", '');
    $("hidIdServicio").value = columna;

    var idServicio = $("hidIdServicio").value;
    var idExamen = $("hidIdExamen").value;
    var nomExamen = $("txtTitulo").value;
    var idVersion = $("cboVersion").value;
    var nomServicio = $("hidNomServicio").value;
    //    alert("idServicio "+idServicio+"idExamen "+idExamen+"idVersion "+idVersion);
    parametros = 'p1=asignarExamenServicio' + '&p2=' + idExamen + '&p3=' + idServicio + '&p4=' + idVersion;
    if (idServicio == "") {
        alert("por favor seleccione un servicio ...!");
        return;
    }
    if (window.confirm("Desea asignar el Examen " + nomExamen + " al Servicio : " + nomServicio + "?")) {
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                respuesta = transport.responseText;
                var dato = respuesta.split("|");
                if (dato[0] > 0) {
                    mostrartablaExamenServicio(idExamen);
                }
            }
        })
    }
}

/*
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
 */
/*****************************************************************************************************************************/

function mostrartablaExamenServicio(idExamen) {
    //    alert("idExamen"+idExamen);
    parametros = "p1=datosExamenServicio&p2=" + idExamen;
    mygridL = new dhtmlXGridObject('divtablaExamenServicio');
    mygridL.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    mygridL.setSkin("dhx_skyblue");
    mygridL.enableRowsHover(true, 'grid_hover');
    mygridL.attachEvent("onRowSelect", desactivarExamenServicio);
    //    mygridL.attachEvent("onRowDblClicked", dbclickeditarPrueba);
    mygridL.init();
    mygridL.loadXML(pathRequestControl + '?' + parametros);
//    mygridL.enableRowsHover(true,'grid_hover');
}

function desactivarExamenServicio(event_id, native_event_object) {
    //=====================   Eliminar  ExamenServicio ==========================
    idExamen = $("hidIdExamen").value;
    idExSe = mygridL.cells(mygridL.getSelectedId(), 11).getValue();
    estadoExSe = mygridL.cells(mygridL.getSelectedId(), 9).getValue();
    //    alert("idExSe"+idExSe+" estadoExSe"+estadoExSe+" hidIdExamen"+idExamen);
    if (native_event_object == 10) {
        if (estadoExSe == 0) {
            //msjActivar
            msj = "Esta seguro que desea desactivar, pienselo bién ...?";
        } else if (estadoExSe == 1) {
            //msjDesactivar
            msj = "Esta seguro de querer activar ...?";
        }
        patronModulo = 'act_desExamenServicio';
        parametros = 'p1=' + patronModulo + '&p2=' + idExSe + '&p3=' + estadoExSe;
        if (window.confirm(msj)) {
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function(transport) {
                    micargador(0);
                    //                mostrartablaExamenPrueba(idExamen);
                    mostrartablaExamenServicio(idExamen);
                }
            })
        }
    }


}
function tablaLaboratorio() {
    this.cargarTablaLaboratorio('');
}
function cargarTablaLaboratorio(param) {
    codPersona = $("txtCodigoPersona").value;
    if (param == "")
        parametros = "p1=cargarTablaLaboratorio&p2=" + codPersona;
    else
        parametros = "p2=" + codPersona + "" + param;

    var div = "divListaLaboratorio";
    var funcionClick = "detalleLaboratorio";
    var funcionDblClick = "";
    var funcionLoad = "";
    generarTablax(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}


function tablaLaboratorioHc() {

    var codPersona = $("txtCodigoPersona").value;

    var patronModulo = 'tablaLaboratorioHc';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codPersona;

    aLaboratorioHc = new dhtmlXGridObject('divListaLaboratorio');

    aLaboratorioHc.setImagePath("../../../imagen/dhtmlxgrid/imgs/");

    aLaboratorioHc.setSkin("dhx_terrace");

    aLaboratorioHc.enableRowsHover(true, 'grid_hover');
    aLaboratorioHc.attachEvent("onRowSelect", function(rId, cInd) {
        var Sistema = aLaboratorioHc.cells(rId, 4).getValue();
        if (Sistema == '1') {
            detalleLaboratorioExamenes(rId);
        }
        if (Sistema == '2') {
            detalleLaboratorio(rId, cInd);
        }
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    aLaboratorioHc.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    aLaboratorioHc.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    aLaboratorioHc.setSkin("dhx_terrace");
    aLaboratorioHc.init();
    aLaboratorioHc.loadXML(pathRequestControl + '?' + parametros, function() {
        });
}


function detalleLaboratorioExamenes(rId) {
    $('Detalle2').update("");
    var IdResult = aLaboratorioHc.cells(rId, 5).getValue();
    if (IdResult == "") {
        document.getElementById("Detalle2").update("<p style='color:red;font-size:22px;'>Laboratorio aun no a registrado los resultados");

    } else {
        var patronModulo = 'detalleLaboratorioExamenes';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + IdResult;
        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function(transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                $('Detalle').update(respuesta);
                $('Detalle').show();
                $('Detalle2').hide();
            }
        })
    }
}






function detalleLaboratorio(fil, col) {
    var idResult = aLaboratorioHc.cells(fil, 6).getValue();
    if (idResult == "") {
        document.getElementById("Detalle2").update("<p style='color:red;font-size:22px;'>Laboratorio aun no a registrado los resultados");
    }
    else {
        $('Detalle').update("");
        $('Detalle').hide();
        $('Detalle2').show();
        parametros = "p1=detalleLaboratorio&p2=" + idResult;
        var div = "Detalle2";
        var funcionClick = "";
        var funcionDblClick = "";
        var funcionLoad = "colorDetalleLaboratorio";
        generarTablay(div, parametros, funcionClick, funcionDblClick, funcionLoad);
    }
}


function colorDetalleLaboratorio() {
    for (i = 0; i < mygridy.getRowsNum(); i++) {
        tipo = mygridy.cells(i, 5).getValue();
        orden = mygridy.cells(i, 6).getValue();

        if (tipo == '1') {
            mygridy.setRowTextStyle(mygridy.getRowId(i), 'background-color:#C6CEDD;color:black;border-top: 1px solid black;');
        } else {
            if (orden == '0')
                mygridy.setRowTextStyle(mygridy.getRowId(i), 'background-color:#98A8C2;color:black;border-top: 1px solid black;');
            else
                mygridy.setRowTextStyle(mygridy.getRowId(i), 'background-color:#E4E8FE;color:black;border-top: 1px solid #7CA5CD;');
        }
    }
    mygridy.enableRowsHover(true, 'grid_hover');
}
function buscarLaboratorio() {
    document.getElementById("divDetalleLaboratorio").style.display = 'none';
    fechaIni = $("txtFechaIni").value;
    fechaFin = $("txtFechaFin").value;
    dato = $("txtDato").value;
    var hacer;
    for (i = 0; i < document.formOpcion.btnOpcion.length; i++) {
        if (document.formOpcion.btnOpcion[i].checked) {
            opcion = document.formOpcion.btnOpcion[i].value;
        }
    }
    if (fechaIni == "" && fechaFin == "" && dato == "") {
        this.cargarTablaLaboratorio('');
        return;
    }
    else if (dato != "") {
        if (fechaIni == "" && fechaFin == "")
            hacer = opcion;
        else {
            if (fechaIni == "" && fechaFin != "")
                hacer = "desde_dato";
            else if (fechaIni != "" && fechaFin == "")
                hacer = "hasta_dato";
            else
                hacer = "all";
        }
    }
    else if (dato == "") {
        if (fechaIni == "" && fechaFin != "")
            hacer = "hasta";
        else if (fechaIni != "" && fechaFin == "")
            hacer = "desde";
        else
            hacer = "entre";
    }
    control = "cargarTablaLaboratorio_confiltro";
    parametros = "&p1=" + control + "&fechaIni=" + fechaIni + "&fechaFin=" + fechaFin + "&dato=" + dato + "&hacer=" + hacer;
    cargarTablaLaboratorio(parametros);
//    alert("fechaIni"+fechaIni+"fechaFin"+fechaFin+"dato"+dato+"opcion"+opcion+"hacer"+hacer);
}
function editarDatosPersona() {
    codPersona = $("hidCodPersona").value;
    ventanaEditaPersona(codPersona);
}
//=================================  fin Juan Carlos ===========================================
//=====================================================================================================


//Triaje
function cargarTriaje() {
    //alert('triaje');
    var codigoProgramacion = $('hcodigoProgramacion').value;
    var patronModulo = 'cargarTriaje';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoProgramacion;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            //$('Div_sintomas').update(respuesta);
            $('Div_TriajeCuerpo').update(respuesta);
        }
    })
}
function calendarioFechaVencimiento(id) {
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
    var campo = 'fechaVencimiento_' + id
    mCalendario = new dhtmlxCalendarObject(campo, false, {
        isMonthEditable: true,
        isYearEditable: true,
        dateformat: '%d/%m/%Y'

    });
    mCalendario.setYearsRange(1900, aniolimite);
    mCalendario.loadUserLanguage('es');

    mCalendario.attachEvent("onClick", function(date) {
        var factual = new Date();
        var fechaLimite = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        var diferencia = -factual.getTime() + fechaLimite.getTime();
        var dias = Math.floor(diferencia / (1000 * 60 * 60 * 24)) + 1
        $('diasValidos_' + id).value = dias;
        var elemento = $('hreceta_' + id).value
        if (elemento != 0) {
            preguardarRectaMedica(id, '1');
        }
    //preguardarRectaMedica(id,'1');

    //alert(fecha);
    });
    // mCalendario.attachEvent("onClick", funcion);
    mCalendario.draw();


}
function calcularFechaValidez(id) {

    var dias = $('diasValidos_' + id).value;

    var fechaInicial = new Date() // 22 de Marzo del 2010 -  los meses comienzan a contar desde 0
    var valorFecha = fechaInicial.valueOf()  // 1269226800000
    var valorFechaTermino = valorFecha + (dias * 24 * 60 * 60 * 1000); // 60 días después, como milisegundos ( días * horas * minutos * segundos * milisegundos )
    var fechaTermino = new Date(valorFechaTermino) // nuevo objeto de fecha: 20 de mayo - Thu May 20 2010 23:00:00 GMT-0400 (CLT)
    var mes = fechaTermino.getMonth() + 1;
    var dia = fechaTermino.getDate();
    if (mes < 10) {
        mes = '0' + mes;
    }
    if (dia < 10) {
        dia = '0' + dia;
    }
    $('fechaVencimiento_' + id).value = dia + "/" + mes + "/" + fechaTermino.getFullYear();
}


function grabarDestinoEssalud() {
    var programacion = $('hcodigoProgramacion').value;
    var combo = $('lstDestinoCitaEssalud').value;
    var patronModulo = 'grabarDestinoEssalud';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + combo;
    parametros += '&p3=' + programacion;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
        }
    })
}

function grabarTipoCitaEssalud() {
    var programacion = $('hcodigoProgramacion').value;
    var combo = $('lstTipoCitaEssalud').value;
    var patronModulo = 'grabarTipoCitaEssalud ';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + combo;
    parametros += '&p3=' + programacion;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
        }
    })
}

function cargarDatosDestinoCita() {
    var programacion = $('hcodigoProgramacion').value;
    var patronModulo = 'cargarDatosCombo ';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + programacion;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            document.getElementById('lstDestinoCitaEssalud').selectedIndex = (respuesta);

        }

    })
}


function cargarDatosTipoCita() {
    var programacion = $('hcodigoProgramacion').value;
    var patronModulo = 'cargarDatosTipoCita ';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + programacion;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            document.getElementById('lstTipoCitaEssalud').selectedIndex = (respuesta);
        }

    })
}



function cargarTablaGrupoEtario(icboAfiliacionGrupoEtario) {

    document.getElementById("txtidGrupoEtario").disabled = true;
    document.getElementById("cboAfiliacionGrupoEtario2").disabled = true;
    document.getElementById("txtCodigoGrupoEtario").disabled = true;
    document.getElementById("cboSexo").disabled = true;
    document.getElementById("txtInicio").disabled = true;
    document.getElementById("txtFin").disabled = true;
    document.getElementById("txtdescripcion").disabled = true;

    var patronModulo = '';
    patronModulo = 'cargarTablaGrupoEtario';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + icboAfiliacionGrupoEtario;
    tablaGrupoEtario = new dhtmlXGridObject('div_tablaGrupoEtario');
    tablaGrupoEtario.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaGrupoEtario.setSkin("dhx_skyblue");
    tablaGrupoEtario.enableRowsHover(true, 'grid_hover');

    //-----------------
    var filtroPeril = "<input type='text' id='txtNombreExamenfiltro' style='width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarGrupoEtario();\" />";
    var header = ["", "", "", "", "", filtroPeril, ""];
    tablaGrupoEtario.attachHeader(header);
    //--------------
    tablaGrupoEtario.attachEvent("onRowSelect", function(fila, columna) {
        seleccionarGrupoEtario(fila, columna);
    });
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaGrupoEtario.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    tablaGrupoEtario.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaGrupoEtario.setSkin("dhx_skyblue");
    tablaGrupoEtario.init();
    tablaGrupoEtario.loadXML(pathRequestControl + '?' + parametros);

}

function buscarGrupoEtario() {
    //    $("txtNombreExamenfiltro").value=$("txtNombreExamen").value;
    findLikeexamen(document.getElementById('txtNombreExamenfiltro').value, tablaGrupoEtario, 5);
}

function seleccionarGrupoEtario(fila, columna) {
    var idGrupoEtario = tablaGrupoEtario.cells(fila, 0).getValue();
    var isexo = tablaGrupoEtario.cells(fila, 7).getValue();

    document.getElementById(isexo).selected = true;
    document.getElementById("txtidGrupoEtario").value = tablaGrupoEtario.cells(fila, 0).getValue();
    document.getElementById("0027").selected = true;
    document.getElementById("txtCodigoGrupoEtario").value = tablaGrupoEtario.cells(fila, 1).getValue();
    document.getElementById("txtInicio").value = tablaGrupoEtario.cells(fila, 6).getValue();
    document.getElementById("txtFin").value = tablaGrupoEtario.cells(fila, 4).getValue();
    document.getElementById("txtdescripcion").value = tablaGrupoEtario.cells(fila, 5).getValue();
    // =====================================================================0000
    document.getElementById("txtidGrupoEtario").disabled = true;
    document.getElementById("cboAfiliacionGrupoEtario2").disabled = true;
    document.getElementById("txtCodigoGrupoEtario").disabled = true;
    document.getElementById("cboSexo").disabled = true;
    document.getElementById("txtInicio").disabled = true;
    document.getElementById("txtFin").disabled = true;
    document.getElementById("txtdescripcion").disabled = true;
    // =====================================================================0000
    // =====================================================================0000
    var patronModulo = '';
    patronModulo = 'serviciosSeleccionadoPorGrupoEtario';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + idGrupoEtario;
    tablaServicioGrupoEtarioSeleccionadosCPT = new dhtmlXGridObject('div_CPTSevicios');
    tablaServicioGrupoEtarioSeleccionadosCPT.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaServicioGrupoEtarioSeleccionadosCPT.setSkin("dhx_skyblue");
    tablaServicioGrupoEtarioSeleccionadosCPT.enableRowsHover(true, 'grid_hover');

    //-----------------
    //    var filtroPeril = "<input type='text' id='txtNombreExamenfiltro' style='width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarGrupoEtario();\" />"; 
    //    var header = ["","","","","",filtroPeril,""];  
    //    tablaServicioGrupoEtarioSeleccionadosCPT.attachHeader(header); 
    //--------------
    tablaServicioGrupoEtarioSeleccionadosCPT.attachEvent("onRowSelect", function(fila, columna) {
        eliminarseleccionarServicioGrupoEtario(fila, columna);
    });
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaServicioGrupoEtarioSeleccionadosCPT.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    tablaServicioGrupoEtarioSeleccionadosCPT.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaServicioGrupoEtarioSeleccionadosCPT.setSkin("dhx_skyblue");
    tablaServicioGrupoEtarioSeleccionadosCPT.init();
    //    tablaServicioGrupoEtarioSeleccionadosCPT.loadXML(pathRequestControl + '?' + parametros);
    tablaServicioGrupoEtarioSeleccionadosCPT.loadXML(pathRequestControl+'?'+parametros, function(){   
        //        setColorTablaEstadoResultado();
        CargarCkeckMinimo(); 
         
    });

}
function   eliminarseleccionarServicioGrupoEtario(fila, columna) {
    var iIdServicioGrupoEtareo = tablaServicioGrupoEtarioSeleccionadosCPT.cells(fila, 0).getValue();
    var iOrden = tablaServicioGrupoEtarioSeleccionadosCPT.cells(fila, 6).getValue();
    var iIdGrupoEtario = $('txtidGrupoEtario').value;
    if (columna == 11) {// Eliminar
        if(confirm("Esta Seguro que desea Eliminar")){
            var patronModulo = 'eliminarseleccionarServicioGrupoEtario';
            var parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + iIdServicioGrupoEtareo;
            parametros += '&p3=' + iOrden;
            parametros += '&p4=' + iIdGrupoEtario;
            contadorCargador++;
            var idCargador = contadorCargador;
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: cargadorpeche(1, idCargador),
                onComplete: function(transport) {
                    cargadorpeche(0, idCargador);
                    var respuesta = transport.responseText;
                    refrescarServiciosSeleccionado();
                }

            })

        }
    }
    if (columna == 12) {// Modifico
           
        var Titulo = tablaServicioGrupoEtarioSeleccionadosCPT.cells(fila, 2).getValue();
        var iorden = tablaServicioGrupoEtarioSeleccionadosCPT.cells(fila, 6).getValue();
        var iIdTipoServicioCPT = tablaServicioGrupoEtarioSeleccionadosCPT.cells(fila, 13).getValue();
        var iIdPeriodoEdad = tablaServicioGrupoEtarioSeleccionadosCPT.cells(fila, 14).getValue();
        var edad = tablaServicioGrupoEtarioSeleccionadosCPT.cells(fila, 3).getValue();
        var nroAtencion = tablaServicioGrupoEtarioSeleccionadosCPT.cells(fila, 7).getValue();
        var vMensaje = tablaServicioGrupoEtarioSeleccionadosCPT.cells(fila, 16).getValue();
        if(edad==0){
            edad=''; 
        }
        var vformname = 'formularioServicioGrupoEtario'
        var vtitle = '<h1>' + Titulo + '</h1><br>'
        var vwidth = '450'
        var vheight = '380'
        var vcenter = 't'
        var vresizable = ''
        var vmodal = 'false'
        var vstyle = ''
        var vopacity = ''
        var vposx1 = ''
        var vposx2 = ''
        var vposy1 = ''
        var vposy2 = ''

        var patronModulo = 'editarServicioGrupoEtario';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + iIdServicioGrupoEtareo;
        parametros += '&p3=' + iOrden;
        parametros += '&p4=' + iIdGrupoEtario;
        parametros += '&p5=' + iorden;
        parametros += '&p6=' + iIdTipoServicioCPT;
        parametros += '&p7=' + iIdPeriodoEdad;
        parametros += '&p8=' + edad;
        parametros += '&p9=' + nroAtencion;
        parametros += '&p10=' + vMensaje;
        var posFuncion = '';
        CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)

    }
}

function modificarServicioGrupoEtario(){
    var iIdServicioGrupoEtareo = $('txtiIdServicioGrupoEtareo').value;
    
    var c_cod_pro = $('txtc_cod_prod').value;
    var iIdGrupoEtario = $('txtidGrupoEtario').value;
    var cboTipoServicioCPT = $('cboTipoServicioCPT').value;
    var cboPeriodoEdad = $('cboPeriodoEdad').value;
    var txtnEdadToma = $('txtnEdadToma').value;
    var txtNroAtenciones = $('txtNroAtenciones').value;
    var txtiOrder = $('txtiOrder').value;
    var txtMensaje = $('txtMensaje').value;
    //    alert(txtNroAtenciones);
    //    alert(iIdServicioGrupoEtareo);
    var patronModulo = 'modificarServicioGrupoEtario';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + c_cod_pro;
    parametros += '&p3=' + iIdGrupoEtario;
    parametros += '&p4=' + cboTipoServicioCPT;
    parametros += '&p5=' + cboPeriodoEdad;
    parametros += '&p6=' + txtnEdadToma;
    parametros += '&p7=' + txtNroAtenciones;
    parametros += '&p8=' + txtiOrder;
    parametros += '&p9=' + iIdServicioGrupoEtareo;
    parametros += '&p10=' + txtMensaje;
    alert(txtMensaje);
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            Windows.close("Div_formularioServicioGrupoEtario");
            refrescarServiciosSeleccionado();
        }

    })
}

function buscarGrupoEtarioPorAfiliacion() {
    var icboAfiliacionGrupoEtario = document.getElementById("cboAfiliacionGrupoEtario").value;
    cargarTablaGrupoEtario(icboAfiliacionGrupoEtario)
}

function agregarNuevoServicioPorGRupoEtario() {
    var idGrupoEtario = document.getElementById("txtidGrupoEtario").value;
    if (idGrupoEtario != '') {
        var vformname = 'formularioContratof'
        var vtitle = 'MANTENIMIENTO DE LOS SERVICIOS DE GRUPO ETARIO'
        var vwidth = '650'
        var vheight = '480'
        var vcenter = 't'
        var vresizable = ''
        var vmodal = 'false'
        var vstyle = ''
        var vopacity = ''
        var vposx1 = ''
        var vposx2 = ''
        var vposy1 = ''
        var vposy2 = ''

        var patronModulo = 'agregarNuevoServicioPorGRupoEtario';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        //    parametros+='&p2='+accion;
        //    parametros+='&p3='+idContrato;
        //    parametros+='&p4='+idPuestoEmpleado;
        var posFuncion = '';
        CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
    }
    else {
        alert("No ah Seleccionado un Grupo Etario");
    }


}

function cargarTablaServicioGrupoEtario() {

    var nombreServicioGrupoEtario = document.getElementById("txtNombreServicioGrupoEtario").value;
    var tam = nombreServicioGrupoEtario.length;
    if (tam > 3) {
        var patronModulo = '';
        patronModulo = 'cargarTablaServicioGrupoEtario';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + nombreServicioGrupoEtario;
        tablaServicioGrupoEtario = new dhtmlXGridObject('div_serviosGrupoEtario');
        tablaServicioGrupoEtario.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
        tablaServicioGrupoEtario.setSkin("dhx_skyblue");
        tablaServicioGrupoEtario.enableRowsHover(true, 'grid_hover');

        //-----------------

        //    var filtroPeril = "<input type='text' id='txtNombreExamenfiltro' style='width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarGrupoEtario();\" />"; 
        //    var header = ["","","","","",filtroPeril,""];  
        //    tablaServicioGrupoEtario.attachHeader(header); 
        //--------------
        tablaServicioGrupoEtario.attachEvent("onRowSelect", function(fila, columna) {
            seleccionarServicioGrupoEtario(fila, columna);
        });
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador = contadorCargador;
        tablaServicioGrupoEtario.attachEvent("onXLS", function() {
            cargadorpeche(1, idCargador);
        });
        tablaServicioGrupoEtario.attachEvent("onXLE", function() {
            cargadorpeche(0, idCargador);
        });
        /////////////fin cargador ///////////////////////
        tablaServicioGrupoEtario.setSkin("dhx_skyblue");
        tablaServicioGrupoEtario.init();

        tablaServicioGrupoEtario.loadXML(pathRequestControl + '?' + parametros);
    }
}

function editarGrupoEtario() {
    document.getElementById("txtidGrupoEtario").disabled = false;
    document.getElementById("cboAfiliacionGrupoEtario2").disabled = false;
    document.getElementById("txtCodigoGrupoEtario").disabled = false;
    document.getElementById("cboSexo").disabled = false;
    document.getElementById("txtInicio").disabled = false;
    document.getElementById("txtFin").disabled = false;
    document.getElementById("txtdescripcion").disabled = false;

}
function seleccionarServicioGrupoEtario(fila, columna) {
    var Titulo = tablaServicioGrupoEtario.cells(fila, 2).getValue();
    var c_cod_prod = tablaServicioGrupoEtario.cells(fila, 0).getValue();
    //    alert(c_cod_prod)
    var iIdGrupoEtario = $('txtidGrupoEtario').value;

    var vformname = 'formularioServicioGrupoEtario'
    var vtitle = '<h1>' + Titulo + '</h1><br>'
    var vwidth = '450'
    var vheight = '380'
    var vcenter = 't'
    var vresizable = ''
    var vmodal = 'false'
    var vstyle = ''
    var vopacity = ''
    var vposx1 = ''
    var vposx2 = ''
    var vposy1 = ''
    var vposy2 = ''

    var patronModulo = 'seleccionarServicioGrupoEtario';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + c_cod_prod;
    parametros += '&p3=' + iIdGrupoEtario;
    //    parametros+='&p4='+idPuestoEmpleado;
    var posFuncion = '';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
}


function checkKey(key, elemento, dato)
{
    var a = document.getElementById("txtidGrupoEtariov").value;

    var unicode
    if (key.charCode)
    {
        unicode = key.charCode;
    }
    else
    {
        unicode = key.keyCode;
    }
    //alert(unicode); // Para saber que codigo de tecla presiono , descomentar

    if (unicode == 13) {
        alert("Presiono enter");
    }
    if (unicode == 32) {
        if (document.getElementById("txtidGrupoEtariov").value == " ") {

            document.getElementById("txtidGrupoEtariov").value = trim(document.getElementById("txtidGrupoEtariov").value);
            //            elemento.value=valor.substr(0, valor.length-1);
            document.getElementById("1").value = 0;
        } else {
            document.getElementById("1").value = parseInt(document.getElementById("1").value) + 1;

            if (parseInt(document.getElementById("1").value) == 2) {
                document.getElementById("txtidGrupoEtariov").value = trim(a) + ' ';
                document.getElementById("1").value = 1;
            }
        }
    }
    else {
        document.getElementById("1").value = 0;
    }
}

function guardarServicioGrupoEtario() {
    var c_cod_pro = $('txtc_cod_prod').value;
    var iIdGrupoEtario = $('txtidGrupoEtario').value;
    var cboTipoServicioCPT = $('cboTipoServicioCPT').value;
    var cboPeriodoEdad = $('cboPeriodoEdad').value;
    var txtnEdadToma = $('txtnEdadToma').value;
    var txtNroAtenciones = $('txtNroAtenciones').value;
    var txtiOrder = $('txtiOrder').value;
    var txtMensaje = $('txtMensaje').value;
    //    alert(txtNroAtenciones);
    var patronModulo = 'guardarServicioGrupoEtario';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + c_cod_pro;
    parametros += '&p3=' + iIdGrupoEtario;
    parametros += '&p4=' + cboTipoServicioCPT;
    parametros += '&p5=' + cboPeriodoEdad;
    parametros += '&p6=' + txtnEdadToma;
    parametros += '&p7=' + txtNroAtenciones;
    parametros += '&p8=' + txtiOrder;
    parametros += '&p9=' + txtMensaje;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            Windows.close("Div_formularioServicioGrupoEtario");
            refrescarServiciosSeleccionado();
        }

    })
}



//----------------------------EQUIVALENCIAS CPT-------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------

function buscarTablaCPT(a, b, evento) {
    // var codCTP=$('txtCPT').value;
    var nombreCTP = $('txtNombreCPT').value;
    var numero = nombreCTP.length;
    var patronModulo = 'buscarTablaCPT';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + nombreCTP;
    // parametros+='&p3='+codCTP;

    var tecla = evento.keyCode
    if (numero == 4 || tecla == 13) {
        vcpt = 0;
        tablaCPT = new dhtmlXGridObject('div_TablaCPT');
        tablaCPT.setImagePath("../../../../fastmedical_front/imagen/icono/");
        tablaCPT.attachEvent("onRowSelect", function(fila, columna) {
            $('txtiIdCPT').value = tablaCPT.cells(fila, 0).getValue();
            reporteEquivalenciaCPT(fila, columna);
        //        reporteEquivalenciaMxserpro(codCPT);
        });
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador = contadorCargador;
        tablaCPT.attachEvent("onXLS", function() {
            cargadorpeche(1, idCargador);
        });
        tablaCPT.attachEvent("onXLE", function() {
            cargadorpeche(0, idCargador);
        });
        /////////////fin cargador ///////////////////////
        tablaCPT.setSkin("dhx_skyblue");
        tablaCPT.init();
        tablaCPT.loadXML(pathRequestControl + '?' + parametros, function() {
            vcpt = 1;
        });
    }

    if (numero > 4 && vcpt == 1) {
        //alert('0')
        var palabra = $('txtNombreCPT').value;
        var arrayPalabras = new Array();
        arrayPalabras = palabra.split(" ");
        var numeroPalabras = arrayPalabras.length;
        tablaCPT.filterBy(2, arrayPalabras[0]);
        for (var i = 1; i < numeroPalabras; i++) {
            tablaCPT.filterBy(2, arrayPalabras[i], true);
        }
    }

}


function validaCodCPT() {

    array_asociativo = new Array();
    array_asociativo['0001'] = 8;
    for (var i in array_asociativo) {
        tipoDato = typeof array_asociativo[i];
        if (tipoDato == "number" && indice == i) {
            $(txtCodCPT).value = "";
            $(txtCodCPT).maxLength = array_asociativo[i];
            $(txtCodCPT).focus();
        }
    }
}

function cargarLetras(event) {
    e = event;
    if (e.keyCode == 13) {
        buscarCPTcod();
    }
}

function buscarCPTcod(event) {
    var iIdCPT = document.getElementById("txtCodCPT").value;
    // alert(CodCPT)
    var patronModulo = '';
    patronModulo = 'buscarCPTcod';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iIdCPT;
    tablaCPT = new dhtmlXGridObject('div_TablaCPT');
    tablaCPT.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaCPT.setSkin("dhx_skyblue");
    tablaCPT.enableRowsHover(true, 'grid_hover');
    tablaCPT.attachEvent("onRowSelect", function(fila, columna) {
        $('txtiIdCPT').value = tablaCPT.cells(fila, 0).getValue();
        reporteEquivalenciaCPT(fila, columna);
    });
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaCPT.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    tablaCPT.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaCPT.setSkin("dhx_skyblue");
    tablaCPT.init();
    tablaCPT.loadXML(pathRequestControl + '?' + parametros);

}



function actualizarTablaEquivalente(fila, columna) {
    var mxSerpro = tablaMxserpro.cells(fila, 0).getValue();
    var decProd = tablaMxserpro.cells(fila, 1).getValue();

    tablaEquivalencia.cells(1, 3).setValue(mxSerpro);
    tablaEquivalencia.cells(1, 4).setValue(decProd);
//////////////////////////////////////////////
}

function buscarMxserpro(a, b, evento) {
    var nombreMxserpro = $('txtNombreMxserpro').value;
    var numero = nombreMxserpro.length;
    var patronModulo = 'cargarTablaMxserpro';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + nombreMxserpro;
    // parametros+='&p3='+codCTP;

    var tecla = evento.keyCode
    if (numero == 4 || tecla == 13) {
        vmxserpro = 0;
        tablaMxserpro = new dhtmlXGridObject('div_TablaMxserpro');
        tablaMxserpro.setImagePath("../../../../fastmedical_front/imagen/icono/");
        tablaMxserpro.attachEvent("onRowSelect", function(fila, columna) {
            actualizarTablaEquivalente(fila, columna);
        //        reporteEquivalenciaMxserpro(codCPT);
        });
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador = contadorCargador;
        tablaMxserpro.attachEvent("onXLS", function() {
            cargadorpeche(1, idCargador);
        });
        tablaMxserpro.attachEvent("onXLE", function() {
            cargadorpeche(0, idCargador);
        });
        /////////////fin cargador ///////////////////////
        tablaMxserpro.setSkin("dhx_skyblue");
        tablaMxserpro.init();
        tablaMxserpro.loadXML(pathRequestControl + '?' + parametros, function() {
            vmxserpro = 1;
        });
    }

    if (numero > 4 && vmxserpro == 1) {
        //alert('0')
        var palabra = $('txtNombreCPT').value;
        var arrayPalabras = new Array();
        arrayPalabras = palabra.split(" ");
        var numeroPalabras = arrayPalabras.length;
        tablaMxserpro.filterBy(1, arrayPalabras[0]);
        for (var i = 1; i < numeroPalabras; i++) {
            tablaMxserpro.filterBy(1, arrayPalabras[i], true);
        }
    }

}


function cargarLetrasMxSerPro(event) {
    e = event;
    if (e.keyCode == 13) {
        buscarMxSerProcod();
    }
}


function buscarMxSerProcod(event) {
    var codMxserpro = document.getElementById("txtIdProd").value;
    var patronModulo = '';
    patronModulo = 'buscarMxSerProcod';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codMxserpro;
    tablaMxserpro = new dhtmlXGridObject('div_TablaMxserpro');
    tablaMxserpro.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaMxserpro.setSkin("dhx_skyblue");
    tablaMxserpro.enableRowsHover(true, 'grid_hover');
    tablaMxserpro.attachEvent("onRowSelect", function(fila, columna) {
        actualizarTablaEquivalente(fila, columna);
    });
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaMxserpro.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    tablaMxserpro.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaMxserpro.setSkin("dhx_skyblue");
    tablaMxserpro.init();
    tablaMxserpro.loadXML(pathRequestControl + '?' + parametros);
}


function reporteEquivalenciaCPT(fila, columna) {
    var iIdCPT = tablaCPT.cells(fila, 0).getValue();
    var vCPTdescripcion = tablaCPT.cells(fila, 2).getValue();
    //    document.getElementById('hestadoprod').value=1;
    //  alert(fila); 
    var patronModulo = 'cargarRegistroMxserpro';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iIdCPT;
    parametros += '&p3=' + vCPTdescripcion;

    tablaEquivalencia = new dhtmlXGridObject('div_Equivalencias');

    tablaEquivalencia.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaEquivalencia.setSkin("dhx_skyblue");
    tablaEquivalencia.enableRowsHover(true, 'grid_hover');

    //////////////////////////////////////////////////////////// 
    tablaEquivalencia.attachEvent("onRowSelect", function(fila, columna) {
        guardarRegistroServicio(fila, columna);
    });
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaEquivalencia.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    tablaEquivalencia.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);

    });
    /////////////fin cargador ///////////////////////
    tablaEquivalencia.setSkin("dhx_skyblue");
    tablaEquivalencia.init();
    //    tablaBuscarPersona.loadXML(pathRequestControl+'?'+parametros);

    tablaEquivalencia.loadXML(pathRequestControl + '?' + parametros, function() {

        });
    tablaEquivalencia.attachEvent("onEditCell", function(stage, rId, cInd, nValue, oValue) {
        });
}


function guardarRegistroServicio(fila, columna) {
    if (columna == 5) {
        if (confirm("¿Esta Seguro de realizar la equivalencia de los Servicios?")) {
            var iIdCPT = tablaEquivalencia.cells(fila, 1).getValue();
            var mxSerpro = tablaEquivalencia.cells(fila, 3).getValue();
            //   alert(iIdCPT);
            //  alert(mxSerpro);

            var patronModulo = 'guardarRegistroServicio';
            var parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + iIdCPT;
            parametros += '&p3=' + mxSerpro;
            contadorCargador++;
            var idCargador = contadorCargador;
            new Ajax.Request(pathRequestControl, {
                method: 'post',
                parameters: parametros,
                asynchronous: false,
                onLoading: micargador(1),
                onComplete: function(transport) {
                    cargadorpeche(0, idCargador);
                    respuesta = transport.responseText;
                    datos = respuesta.split("|");
                }
            });

        }
    } else {
        alert("No puede Realizar El procedimiento, marque el boton guardar");
    }



}


function examenesRelacionados() {

    var iIdCPT = $("txtiIdCPT").value;
    var patronModulo = 'examenesRelacionados';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iIdCPT;
    tablaexamenesRelacionados = new dhtmlXGridObject('div_Equivalencias');
    tablaexamenesRelacionados.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaexamenesRelacionados.setSkin("dhx_skyblue");
    tablaexamenesRelacionados.attachEvent("onRowSelect", function(fila, columna) {
        var iIdRelacion = tablaexamenesRelacionados.cells(fila, 0).getValue();
        var estado = tablaexamenesRelacionados.cells(fila, 4).getValue();
        cambiarEstadoServicioRelacionado(iIdRelacion,estado);
    });
    tablaexamenesRelacionados.init();
    tablaexamenesRelacionados.loadXML(pathRequestControl + '?' + parametros);
    
}

//----------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------





























//*---------------------------------------

function buscarExamenesLaboratorio() {
    //    var nombreExamen=$("txtNombreExamen").value;
    var nombreExamen = '%';
    //    if(nombreExamen.length ==0){
    var patronModulo = 'buscarExamenesLaboratorio';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + nombreExamen;

    tablaExamenesLaboratorio = new dhtmlXGridObject('div_TablaExamenes');
    tablaExamenesLaboratorio.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaExamenesLaboratorio.setSkin("dhx_skyblue");
    tablaExamenesLaboratorio.enableRowsHover(true, 'grid_hover');
    //-----------------
    var filtroPeril = "<input type='text' id='txtNombreExamenfiltro' style='width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarExamenes();\" />";
    var header = ["#numeric_filter", "#text_filter", filtroPeril];
    tablaExamenesLaboratorio.attachHeader(header);
    //--------------
    tablaExamenesLaboratorio.attachEvent("onRowSelect", function(fila, columna) {
        reporteDePuntoControlXExamen(fila, columna);

        $('div_MostrarMaterialesSeleccionadosXpuntoControlExamenLabo').innerHTML = "";
        $('div_detalleMuestrasyLaboratorioxPuntodeControl1').innerHTML = "";
        $('div_MostrarMuestrasSeleccionadosXpuntoControlExamenLabo').innerHTML = "";




    });
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaExamenesLaboratorio.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    tablaExamenesLaboratorio.attachEvent("onXLE", function() {

        // $("txtNombreExamenfiltro").value=$("txtNombreExamen").value;

        cargadorpeche(0, idCargador);

    });
    /////////////fin cargador ///////////////////////
    tablaExamenesLaboratorio.setSkin("dhx_skyblue");
    tablaExamenesLaboratorio.init();
    tablaExamenesLaboratorio.loadXML(pathRequestControl + '?' + parametros);
//    }
}



function  refrescarServiciosSeleccionado() {
    var iIdGrupoEtario = $('txtidGrupoEtario').value;
    var patronModulo = '';
    patronModulo = 'serviciosSeleccionadoPorGrupoEtario';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iIdGrupoEtario;
    tablaServicioGrupoEtarioSeleccionadosCPT = new dhtmlXGridObject('div_CPTSevicios');
    tablaServicioGrupoEtarioSeleccionadosCPT.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaServicioGrupoEtarioSeleccionadosCPT.setSkin("dhx_skyblue");
    tablaServicioGrupoEtarioSeleccionadosCPT.enableRowsHover(true, 'grid_hover');

    //-----------------
    //    var filtroPeril = "<input type='text' id='txtNombreExamenfiltro' style='width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarGrupoEtario();\" />"; 
    //    var header = ["","","","","",filtroPeril,""];  
    //    tablaServicioGrupoEtarioSeleccionadosCPT.attachHeader(header); 
    //--------------
    tablaServicioGrupoEtarioSeleccionadosCPT.attachEvent("onRowSelect", function(fila, columna) {
        eliminarseleccionarServicioGrupoEtario(fila, columna);
    });
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaServicioGrupoEtarioSeleccionadosCPT.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    tablaServicioGrupoEtarioSeleccionadosCPT.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaServicioGrupoEtarioSeleccionadosCPT.setSkin("dhx_skyblue");
    tablaServicioGrupoEtarioSeleccionadosCPT.init();
    //    tablaServicioGrupoEtarioSeleccionadosCPT.loadXML(pathRequestControl + '?' + parametros);
    tablaServicioGrupoEtarioSeleccionadosCPT.loadXML(pathRequestControl+'?'+parametros, function(){   
        //        setColorTablaEstadoResultado();
        CargarCkeckMinimo(); 
         
    });
}

function CargarCkeckMinimo(){
    for(i=0;i<tablaServicioGrupoEtarioSeleccionadosCPT.getRowsNum();i++){
        tablaServicioGrupoEtarioSeleccionadosCPT.cells(i,17).setValue('<input id="cboObligatorio'+i+'" onclick= "if(this.checked){this.value=1}else{this.value=0;};actualizarEstadoObligatorio('+i+')" type="checkbox" title="Seleccionar" name="cboObligatorio" value="0">'); 
        var bObligatorio= tablaServicioGrupoEtarioSeleccionadosCPT.cells(i,15).getValue();
        if(bObligatorio==1){
            document.getElementById('cboObligatorio'+i).checked=true;
            document.getElementById('cboObligatorio'+i).value=1;          
        } else{
            document.getElementById('cboObligatorio'+i).checked=false;
            document.getElementById('cboObligatorio'+i).value=0;

        }    

    }  
 
} 
function actualizarEstadoObligatorio(fila){
    //    alert(fila);
    var iIdServicioGrupoEtareo= tablaServicioGrupoEtarioSeleccionadosCPT.cells(fila,0).getValue();
    //    alert(iIdServicioGrupoEtareo);
    var estado=document.getElementById('cboObligatorio'+fila).value

    var patronModulo = 'actualizarEstadoObligatorio';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iIdServicioGrupoEtareo;
    parametros += '&p3=' + estado;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            //                $('contenedorServicios').update(respuesta);
            refrescarServiciosSeleccionado();
        }
    })

}

function filtrarServiciosManteni(evento) {
    var nombre = $('txtBusquedaServicio').value;
    var tecla = evento.keyCode
    if (tecla == 13 || nombre.length >= 4) {
        var patronModulo = 'filtrarServicios ';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + nombre;
        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function(transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                $('contenedorServicios').update(respuesta);
            }
        })
    }
}




function filtrarAfiliacioanManteni(evento) {
    var nombre = $('txtBusquedaAfiliacion').value;
    var tecla = evento.keyCode
    if (tecla == 13 || nombre.length >= 4) {
        var patronModulo = 'filtrarAfiliacioanManteni ';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + nombre;
        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function(transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                $('contenedorAFiliaciones').update(respuesta);
            }
        })
    }
}


function cargarMantenimiento(id, nombre) {
    var patronModulo = 'cargarMantenimiento ';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + id;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('contenidoMantenimiento').update(respuesta);
            $('idServicio').value = id;
            $('nombreServicio').update(nombre);
        }
    })
}



function quitardSeleccion() {
    afiliacionesnoasignadas = new Array();
    afiliacionesasignadas = new Array();
    asignacionauxiliar = new Array();
    asignacionauxiliar2 = new Array();

    afiliacionesnoasignadas = document.getElementById("lst_Noseleccionadas");
    afiliacionesasignadas = document.getElementById("lst_seleccionadas");
    j = 0;
    numSeleccionados = 0;
    for (k = 0; k < afiliacionesasignadas.length; k += 1) {
        if (afiliacionesasignadas.item(k).selected == 1) {
            asignacionauxiliar[j] = new Array(2);
            asignacionauxiliar[j][0] = afiliacionesasignadas.item(k).value;
            asignacionauxiliar[j][1] = afiliacionesasignadas.item(k).text;
            j = j + 1;
        }
    }
    numSeleccionados = j;
    if (numSeleccionados == 1) {
        existeitem = false;
        for (k = 0; k < afiliacionesnoasignadas.length; k += 1) {
            if (afiliacionesnoasignadas.item(k).value == asignacionauxiliar[0][0]) {
                existeitem = true;
            }
        }
        if (!existeitem) {
            try {
                afiliacionesnoasignadas.add(new Option(asignacionauxiliar[0][1], asignacionauxiliar[0][0]), null);//Pasamos a ESSALUD como la unica afiliación activa excluyente
                afiliacionesasignadas.remove(afiliacionesasignadas.selectedIndex);
            }
            catch (e) { //in IE, try the below version instead of add()
                afiliacionesnoasignadas.add(new Option(asignacionauxiliar[0][1], asignacionauxiliar[0][0]), null);//Pasamos a ESSALUD como la unica afiliación activa excluyente
                afiliacionesasignadas.remove(afiliacionesasignadas.selectedIndex);
            }
        }
    }
    else {
        if (numSeleccionados > 1) {
            for (i = 0; i < asignacionauxiliar.length; i += 1) {
                existe = false;
                for (k = 0; k < afiliacionesnoasignadas.length; k += 1) {
                    if (afiliacionesnoasignadas.item(k).value == asignacionauxiliar[i][0]) {
                        existe = true;
                    }
                }
                if (!existe) {
                    try {
                        afiliacionesnoasignadas.add(new Option(asignacionauxiliar[i][1], asignacionauxiliar[i][0]), null) //add new option to end of "sample"
                        afiliacionesasignadas.remove(afiliacionesasignadas.selectedIndex);
                    }
                    catch (e) { //in IE, try the below version instead of add()
                        afiliacionesnoasignadas.add(new Option(asignacionauxiliar[i][1], asignacionauxiliar[i][0])) //add new option to end of "sample"
                        afiliacionesasignadas.remove(afiliacionesasignadas.selectedIndex);
                    }
                }
            }
        }
    }
}


function agregarSeleccion() {
    afiliacionesnoasignadas = new Array();
    afiliacionesasignadas = new Array();
    asignacionauxiliar = new Array();
    asignacionauxiliar2 = new Array();

    afiliacionesnoasignadas = document.getElementById("lst_Noseleccionadas");
    afiliacionesasignadas = document.getElementById("lst_seleccionadas");
    j = 0;
    numSeleccionados = 0;

    for (k = 0; k < afiliacionesnoasignadas.length; k += 1) {
        if (afiliacionesnoasignadas.item(k).selected == 1) {
            asignacionauxiliar[j] = new Array(2);
            asignacionauxiliar[j][0] = afiliacionesnoasignadas.item(k).value;
            asignacionauxiliar[j][1] = afiliacionesnoasignadas.item(k).text;
            j = j + 1;
        }
    }
    numSeleccionados = j;
    if (numSeleccionados == 1) {
        existeitem = false;
        for (k = 0; k < afiliacionesasignadas.length; k += 1) {
            if (afiliacionesasignadas.item(k).value == asignacionauxiliar[0][0]) {
                existeitem = true;
            }
        }
        if (!existeitem) {
            try {
                afiliacionesasignadas.add(new Option(asignacionauxiliar[0][1], asignacionauxiliar[0][0]), null);//Pasamos a ESSALUD como la unica afiliación activa excluyente
                afiliacionesnoasignadas.remove(afiliacionesnoasignadas.selectedIndex);
            }
            catch (e) { //in IE, try the below version instead of add()
                afiliacionesasignadas.add(new Option(asignacionauxiliar[0][1], asignacionauxiliar[0][0]), null);//Pasamos a ESSALUD como la unica afiliación activa excluyente
                afiliacionesnoasignadas.remove(afiliacionesnoasignadas.selectedIndex);
            }
        }
    }
    else {
        if (numSeleccionados > 1) {
            for (i = 0; i < asignacionauxiliar.length; i += 1) {
                existeitem = false;
                for (k = 0; k < afiliacionesasignadas.length; k += 1) {
                    if (afiliacionesasignadas.item(k).value == asignacionauxiliar[i][0]) {
                        existeitem = true;
                    }
                }
                if (!existeitem) {
                    try {
                        afiliacionesasignadas.add(new Option(asignacionauxiliar[i][1], asignacionauxiliar[i][0]), null) //add new option to end of "sample"
                        afiliacionesnoasignadas.remove(afiliacionesnoasignadas.selectedIndex);
                    }
                    catch (e) { //in IE, try the below version instead of add()
                        afiliacionesasignadas.add(new Option(asignacionauxiliar[i][1], asignacionauxiliar[i][0])) //add new option to end of "sample"
                        afiliacionesnoasignadas.remove(afiliacionesnoasignadas.selectedIndex);
                    }
                }
            }
        }
    }

}



function guardarModulosPorArea() {
    var contadorCombo2 = $('lst_seleccionadas').length;
    var arrayCombo2 = "";
    var arrayNum2 = "";
    for (var y = 0; y <= contadorCombo2 - 1; y++) {
        if (y == 0) {
            arrayCombo2 = $('lst_seleccionadas')[y].value + "|";
            arrayNum2 += (y + 1) + "|";
        }
        else if (y < contadorCombo2 - 1) {
            arrayCombo2 += $('lst_seleccionadas')[y].value + "|";
            arrayNum2 += (y + 1) + "|";
        }
        else if (y == contadorCombo2 - 1) {
            arrayCombo2 += $('lst_seleccionadas')[y].value;
            arrayNum2 += (y + 1);
        }
    }
    if (contadorCombo2 == 0) {
        var IdSer = $("idServicio").value;
        var patronModulo = 'eliminarAnterioresSeleccionados';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + IdSer;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                var respuesta = transport.responseText;
                alert("Se guardo exitosamente...");
            }
        })
    }
    else if (contadorCombo2 > 0) {
        var IdSer = $("idServicio").value;
        var patronModulo = 'eliminarAnterioresSeleccionados';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + IdSer;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                var respuesta = transport.responseText;
                guardarNuevaSeleccion(arrayCombo2, arrayNum2);
            }
        })
    }

}

function guardarNuevaSeleccion(arrayCombo2, arrayNum2) {
    var IdSer = $("idServicio").value;
    var patronModulo = 'guardarNuevaSeleccion';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + arrayCombo2;
    parametros += '&p3=' + IdSer;
    parametros += '&p4=' + arrayNum2;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            var respuesta = transport.responseText;
            alert("Se guardo exitosamente...");
        //cargarMantenimientoServicios();
        }
    })
}
function ventanaDiagnosticoDiente(numeroAntecedenteOdontograma) {
    var vformname = 'formularioDiagnosticoDiente'
    var vtitle = 'Antecedente o Procedimiento'
    var vwidth = '1000'
    var vheight = '480'
    var vcenter = 't'
    var vresizable = ''
    var vmodal = 'false'
    var vstyle = ''
    var vopacity = ''
    var vposx1 = ''
    var vposx2 = ''
    var vposy1 = ''
    var vposy2 = ''

    var patronModulo = 'buscadorDiagnosticoDiente';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + numeroAntecedenteOdontograma;
    //    parametros+='&p3='+idContrato;
    //    parametros+='&p4='+idPuestoEmpleado;
    var posFuncion = 'cargarElementos';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
}
function cargarElementos() {
    cargarArbolDiagnostico();
//cargarDientesseleccionados();
}
function cargarDientesseleccionados() {



    canvasDiente = document.getElementById('canvaDientesSeleccionados');

    p1 = new Processing(canvasDiente, animacionDiente);
}
function cargarArbolDiagnostico() {

    parametros = "p1=arbolPracticasOdontologicas";
    //parametros+="&p2="+sede;
    divMostrar = document.getElementById('arbolOdontologia');
    divMostrar.innerHTML = " ";
    arbolOdontograma = new dhtmlXTreeObject("arbolOdontologia", "100%", "100%", 0);
    arbolOdontograma.setSkin('dhx_skyblue');
    arbolOdontograma.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    arbolOdontograma.enableMultiLineItems("250px");
    arbolOdontograma.enableTreeLines(true);
    arbolOdontograma.attachEvent("onDblClick", function() {

        arbolOdontograma.focusItem(arbolOdontograma.getSelectedItemId());
        diagnosticoOdontogramaSeleccionado(arbolOdontograma.getSelectedItemId(), arbolOdontograma.getSelectedItemText());
        return true;
    });
    //arbolOdontograma.openAllItems(0);

    //    treex.setXMLAutoLoading(pathRequestControl+'?'+parametros);
    arbolOdontograma.loadXML(pathRequestControl + '?' + parametros, function() {
        //arbolOdontograma.closeItem(82,92);
        //alert(arbolOdontograma.getSubItems(1))
        var array = arbolOdontograma.getSubItems(1).split(",");
        var numero = array.length;
        for (var i = 0; i < numero; i++) {
            arbolOdontograma.closeItem(array[i]);
        }
    });

}
function diagnosticoOdontogramaSeleccionado(id, nombre) {
    var patronModulo = 'obtenerTipoDiagnostico';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + id;

    contadorCargador++;

    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        asynchronous: false,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var arrayRespuesta = transport.responseText.split("-");


            // alert(arrayRespuesta);
            $('colorSimbolo_ventana').value = trimJunny(arrayRespuesta[0]);
            $('dientesAfectados_ventana').value = trimJunny(arrayRespuesta[1]);
            $('divTerceroBit').value = arrayRespuesta[2];
            $('divEstadoBit').value = arrayRespuesta[0];
            $('divCarasBit').value = arrayRespuesta[3];
            if (arrayRespuesta[0] == '3') {
                $("divEstado_ventana").show();
            }
            else {
                $("divEstado_ventana").hide();
            }
            if (arrayRespuesta[2] == 1) {
                $("divTercero_ventana").show();
            } else {
                $("divTercero_ventana").hide();
            }

            var numeroAntecedenteSeleccionado = $('numeroAntecedenteOdontogramaSeleccionado').value;
            if (numeroAntecedenteSeleccionado == '') {
                $('txtAntecedenteId_ventana').value = id;
                $('txtAntecedenteNombre_ventana').value = nombre;
            }
            else {
                $('txtAntecedenteId_' + numeroAntecedenteSeleccionado).value = id;
                $('txtAntecedenteNombre_' + numeroAntecedenteSeleccionado).value = nombre;
                grabarAntecedenteOdontograma(numeroAntecedenteSeleccionado);
            }

            Windows.close("Div_formularioDiagnosticoDiente", '');

        }
    })

}
function buscarArbolDiagnosticoOdontolograma() {
    arbolOdontograma.findItem($("textoBusquedaArbol").value);
}
function buscarTablaOdontologia(evento) {

    var parametronombre = $('textoBusquedaTabla').value;
    var numero = parametronombre.length;
    var patronModulo = 'tablaProcedimientoOdontologico';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + parametronombre;

    var tecla = evento.keyCode
    if (numero == 3 || tecla == 13) {
        tod = 0;
        tablaProcedimientoOdontologico = new dhtmlXGridObject('tablaOdontologia');
        tablaProcedimientoOdontologico.setImagePath("../../../../fastmedical_front/imagen/icono/");
        tablaProcedimientoOdontologico.attachEvent("onRowSelect", function(fila, columna) {
            var nombre = tablaProcedimientoOdontologico.cells(fila, 1).getValue();
            diagnosticoOdontogramaSeleccionado(fila, nombre)

        });
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador = contadorCargador;
        tablaProcedimientoOdontologico.attachEvent("onXLS", function() {
            cargadorpeche(1, idCargador);
        });
        tablaProcedimientoOdontologico.attachEvent("onXLE", function() {
            cargadorpeche(0, idCargador);
        });
        /////////////fin cargador ///////////////////////
        tablaProcedimientoOdontologico.setSkin("dhx_skyblue");
        tablaProcedimientoOdontologico.init();
        tablaProcedimientoOdontologico.loadXML(pathRequestControl + '?' + parametros, function() {
            tod = 1;
        });
    //miTablaCie.clearAll();
    }
    if (numero > 3 && tod == 1) {
        //tablaPracticasMedicasTratamientos.filterBy(1,$('txtbusquedaNombrePracticasMedicas').value);
        var palabra = $('textoBusquedaTabla').value;
        var arrayPalabras = new Array();
        arrayPalabras = palabra.split(" ");
        var numeroPalabras = arrayPalabras.length;
        tablaProcedimientoOdontologico.filterBy(1, arrayPalabras[0]);
        for (var i = 1; i < numeroPalabras; i++) {
            tablaProcedimientoOdontologico.filterBy(1, arrayPalabras[i], true);
        }


    }
}

function nuevoAgregarNuevoantecedenteOdontograma() {
    var vformname = 'FormularioDientesSeleccionados'
    var vtitle = 'Antecedente o Procedimiento'
    var vwidth = '1000'
    var vheight = '480'
    var vcenter = 't'
    var vresizable = ''
    var vmodal = 'false'
    var vstyle = ''
    var vopacity = ''
    var vposx1 = ''
    var vposx2 = ''
    var vposy1 = ''
    var vposy2 = ''

    var patronModulo = 'nuevoAntecedenteDinete';
    var parametros = '';
    parametros += 'p1=' + patronModulo;

    var posFuncion = 'cargarDientesseleccionados';
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
//grabarAntecedenteOdontograma(numeroAntecedenteOdontograma);
}
function cancelarDiagnosticoDientes() {
    Windows.close("Div_FormularioDientesSeleccionados", '');
}
function agregarDiagnosticosDientes() {
    var numeroDientesAux = (numeroAux - 1) / 2;
    var numeroAntecedentesOdontograma = $('numeroAntecedentesOdontograma').value;
    var datos = new Array();
    if ($('divTerceroBit').value == 1 && $('selectTercero_ventana').value != "") {
        pasa = 1;
    }
    else if ($('divTerceroBit').value == 0 && $('selectTercero_ventana').value == "") {
        pasa = 1
    }

    else {
        pasa = 0;
    }
    if (pasa == 1) {

        if ($('dientesAfectados_ventana').value == 1) {
            for (var i = 0; i <= numeroDientesAux; i++) {
                if (seleccionado[i] == 1) {
                    numeroAntecedentesOdontograma = $('numeroAntecedentesOdontograma').value;
                    datos = new Array();
                    datos[0] = numeroAntecedentesOdontograma;
                    datos[1] = $('txtAntecedenteId_ventana').value;
                    datos[2] = $('txtAntecedenteNombre_ventana').value;
                    datos[3] = $('selectTercero_ventana').value;
                    datos[4] = $('texArea_ventana').value;
                    datos[5] = arrayDatosDientes[i][0];
                    datos[6] = arrayDatosDientes[i][1];
                    datos[7] = '';
                    datos[8] = '';
                    datos[9] = 0; //1
                    datos[10] = 0;//2
                    datos[11] = 0;//3
                    datos[12] = 0;//4
                    datos[13] = 0;//5
                    datos[14] = 0;//6


                    if (seleccionadoCara[(i - 1) * 5 + 1] == 1) {
                        if (arrayDatosDientesCara[(i - 1) * 5 + 1][1] == 4) {
                            datos[12] = 1;
                        }
                        if (arrayDatosDientesCara[(i - 1) * 5 + 1][1] == 5) {
                            datos[13] = 1;
                        }
                    }
                    if (seleccionadoCara[(i - 1) * 5 + 2] == 1) {
                        if (arrayDatosDientesCara[(i - 1) * 5 + 2][1] == 1) {
                            datos[9] = 1;
                        }
                        if (arrayDatosDientesCara[(i - 1) * 5 + 2][1] == 3) {
                            datos[11] = 1;
                        }
                    }
                    if (seleccionadoCara[(i - 1) * 5 + 3] == 1) {
                        if (arrayDatosDientesCara[(i - 1) * 5 + 3][1] == 4) {
                            datos[12] = 1;
                        }
                        if (arrayDatosDientesCara[(i - 1) * 5 + 3][1] == 6) {
                            datos[14] = 1;
                        }
                    }
                    if (seleccionadoCara[(i - 1) * 5] == 1) {
                        if (arrayDatosDientesCara[(i - 1) * 5][1] == 1) {
                            datos[9] = 1;
                        }
                        if (arrayDatosDientesCara[(i - 1) * 5][1] == 3) {
                            datos[11] = 1;
                        }
                    }
                    if (seleccionadoCara[(i - 1) * 5 + 4] == 1) {
                        if (arrayDatosDientesCara[(i - 1) * 5 + 4][1] == 2) {
                            datos[10] = 1;
                        }
                        if (arrayDatosDientesCara[(i - 1) * 5 + 4][1] == 2) {
                            datos[10] = 1;
                        }
                    }
                    datos[15] = $('colorSimbolo_ventana').value;/////color Marca
                    datos[16] = $('selectestado_ventana').value;/////color Marca
                    datos[17] = $('dientesAfectados_ventana').value;/////color Marca

                    datos[18] = $('divTerceroBit').value;
                    datos[19] = $('divCarasBit').value;
                    agregarAntecedenteOdontograma(datos);
                }
            }
            ////blanquear la seeccion//
            var numeroDientes = arrayDientes.length;
            for (var i = 0; i < numeroDientes; i++) {
                seleccionado[i] = 0;
            }
            ////igualar caras seleccionadas
            var numeroCaras = arrayCaraDientes.length;
            for (i = 0; i < numeroCaras; i++) {
                if ($('colorSimbolo_ventana').value == 1) {
                    arrayCarasRojas[i] = seleccionadoCara[i];

                }
                if ($('colorSimbolo_ventana').value == 2) {

                    arrayCarasAzules[i] = seleccionadoCara[i];
                }

            }

            //var numeroCaras=arrayCaraDientes.length;
            for (i = 0; i < numeroCaras; i++) {
                seleccionadoCara[i] = 0
            }
        }
        if ($('dientesAfectados_ventana').value == 2) {
            numeroAntecedentesOdontograma = $('numeroAntecedentesOdontograma').value;
            datos = new Array();
            datos[0] = numeroAntecedentesOdontograma;
            datos[1] = $('txtAntecedenteId_ventana').value;
            datos[2] = $('txtAntecedenteNombre_ventana').value;
            datos[3] = $('selectTercero_ventana').value;
            datos[4] = $('texArea_ventana').value;
            datos[5] = '';
            datos[6] = '';
            datos[7] = '';
            datos[8] = '';
            datos[9] = 0; //1
            datos[10] = 0;//2
            datos[11] = 0;//3
            datos[12] = 0;//4
            datos[13] = 0;//5
            datos[14] = 0;//6
            var contadorDientes = 0;
            for (var i = 0; i <= numeroDientesAux; i++) {
                if (seleccionado[i] == 1) {
                    if (contadorDientes == 0) {
                        datos[5] = arrayDatosDientes[i][0];
                        datos[6] = arrayDatosDientes[i][1];
                    }
                    if (contadorDientes == 1) {
                        datos[7] = arrayDatosDientes[i][0];
                        datos[8] = arrayDatosDientes[i][1];
                    }
                    contadorDientes++;
                    if (contadorDientes > 1) {
                        break;
                    }
                }
            }
            datos[15] = $('colorSimbolo_ventana').value;/////color Marca
            datos[16] = $('selectestado_ventana').value;/////color Marca
            datos[17] = $('dientesAfectados_ventana').value;/////color Marca
            datos[18] = $('divTerceroBit').value;
            datos[19] = $('divCarasBit').value;
            agregarAntecedenteOdontograma(datos);
            ////blanquear la seeccion//
            var numeroDientes = arrayDientes.length;
            for (var i = 0; i < numeroDientes; i++) {
                seleccionado[i] = 0;
            }
            ////igualar caras seleccionadas
            var numeroCaras = arrayCaraDientes.length;
            for (i = 0; i < numeroCaras; i++) {
                arrayCarasAzules[i] = seleccionadoCara[i];
                arrayCarasRojas[i] = seleccionadoCara[i];
            }

            //var numeroCaras=arrayCaraDientes.length;
            for (i = 0; i < numeroCaras; i++) {
                seleccionadoCara[i] = 0
            }
        }
        mostrarLeyenda();
        Windows.close("Div_FormularioDientesSeleccionados", '');
    } else {
        alert("Seleccione una opcion en realizado por tercero...");
    }


}
function agregarAntecedenteOdontograma(datos) {
    var patronModulo = 'agregarAntecedenteOdontograma';
    var colorsimbolo = datos[15];
    var estado = datos[16];
    var dientAfectados = datos[17];
    /*   alert (Colorsimbolo)
     alert (Estado)
     alert (dientAfectados)*/
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + datos[0];
    parametros += '&p3=' + datos[1];
    parametros += '&p4=' + datos[2];
    parametros += '&p5=' + datos[3];
    parametros += '&p6=' + datos[4];
    parametros += '&p7=' + datos[5];
    parametros += '&p8=' + datos[6];
    parametros += '&p9=' + datos[7];
    parametros += '&p10=' + datos[8];
    parametros += '&p11=' + datos[9];
    parametros += '&p12=' + datos[10];
    parametros += '&p13=' + datos[11];
    parametros += '&p14=' + datos[12];
    parametros += '&p15=' + datos[13];
    parametros += '&p16=' + datos[14];
    parametros += '&p17=' + datos[15];
    parametros += '&p18=' + datos[16];
    parametros += '&p19=' + datos[17];
    parametros += '&p20=' + datos[18];
    parametros += '&p21=' + datos[19];
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        asynchronous: false,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            var para = document.getElementById("divAntecedentesOdontograma");
            var s = respuesta;
            var range = document.createRange();
            range.selectNode(document.body);
            var documentFragment = range.createContextualFragment(s);
            para.appendChild(documentFragment);
            $('numeroAntecedentesOdontograma').value = parseInt($('numeroAntecedentesOdontograma').value) + 1;
            //ventanaDiagnosticoDiente(numeroAntecedenteOdontograma)
            grabarAntecedenteOdontograma(datos[0]);
            cargarImagenesLeyenda(colorsimbolo, estado, dientAfectados);
        }
    })
}




function grabarAntecedenteOdontograma(numeroAntecedenteOdontograma) {
    var idAntecedenteOdontograma = $("idAntecedenteOdontograma_" + numeroAntecedenteOdontograma).value;
    var idDiagnosticodiente = $('txtAntecedenteId_' + numeroAntecedenteOdontograma).value;
    var estadoAntecedenteOdontograma = $('estadoAntecedenteOdontograma_' + numeroAntecedenteOdontograma).value;
    var iIdDiente1 = $('txt_idDiente1_' + numeroAntecedenteOdontograma).value;
    var iIdDiente2 = $('txt_idDiente2_' + numeroAntecedenteOdontograma).value;
    var tercero = $('tercero_' + numeroAntecedenteOdontograma).value;
    var estado = $('selectestado_' + numeroAntecedenteOdontograma).value;
    var Mesial = 0;
    var Incisal = 0;
    var Distal = 0;
    var Vestibular = 0;
    var Lingual = 0;
    var Palatina = 0;
    var Observacion = $('observaciones_' + numeroAntecedenteOdontograma).value;
    if ($('Mesial' + numeroAntecedenteOdontograma).checked == true) {
        Mesial = 1;
    }

    if ($('Incisal' + numeroAntecedenteOdontograma).checked == true) {
        Incisal = 1;
    }

    if ($('Distal' + numeroAntecedenteOdontograma).checked == true) {
        Distal = 1;
    }

    if ($('Vestibular' + numeroAntecedenteOdontograma).checked == true) {
        Vestibular = 1;
    }

    if ($('Lingual' + numeroAntecedenteOdontograma).checked == true) {
        Lingual = 1;
    }

    if ($('Palatina' + numeroAntecedenteOdontograma).checked == true) {
        Palatina = 1;
    }
    var codigoProgramacion = $('hcodigoProgramacion').value
    var patronModulo = 'preguardarAntecedenteOdontograma';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + parseInt(idAntecedenteOdontograma);
    parametros += '&p3=' + idDiagnosticodiente;
    parametros += '&p4=' + estadoAntecedenteOdontograma;
    parametros += '&p5=' + codigoProgramacion;
    parametros += '&p6=' + iIdDiente1;
    parametros += '&p7=' + iIdDiente2;
    parametros += '&p8=' + Mesial;
    parametros += '&p9=' + Incisal;
    parametros += '&p10=' + Distal;
    parametros += '&p11=' + Vestibular;
    parametros += '&p12=' + Lingual;
    parametros += '&p13=' + Palatina;
    parametros += '&p14=' + Observacion;
    parametros += '&p15=' + tercero;
    parametros += '&p16=' + estado;
    contadorCargador++;

    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        asynchronous: false,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $("idAntecedenteOdontograma_" + numeroAntecedenteOdontograma).value = respuesta

        }
    })

}

function dibujarCanvas() {
    var patronModulo = 'arregloDientes';
    var parametros = '';
    parametros += 'p1=' + patronModulo;

    contadorCargador++;

    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        asynchronous: false,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            eval(respuesta);
        }
    })


}
function animacionDiente(processing) {
    var x1 = 0;
    var y1 = 0;
    var x2 = 60;
    var y2 = 0;
    var x3 = 60;
    var y3 = 60;
    var x4 = 0;
    var y4 = 60;
    var x5 = 15;
    var y5 = 15;
    var x6 = 45;
    var y6 = 15;
    var x7 = 45;
    var y7 = 45;
    var x8 = 15;
    var y8 = 45;
    var adentroCaraAux = new Array();
    //numero de dientes
    //alert(numeroAux);
    var arrayPuntosAux = new Array();
    var arrayRelacionCara = new Array();
    var numeroCara = 0;
    var numeroDientesAux = (numeroAux - 1) / 2;
    var contadorDiente = 0;
    var distancia = 65;
    for (var i3 = 0; i3 <= numeroDientesAux; i3++) {

        if (seleccionado[i3] == 1) {

            //region 1
            arrayPuntosAux[numeroCara] = new Array();
            arrayRelacionCara[numeroCara] = (i3 - 1) * 5 + 1;

            arrayPuntosAux[numeroCara][0] = new Array();
            //  alert('peche1b');
            arrayPuntosAux[numeroCara][0][0] = x1 + contadorDiente * distancia;
            //  alert('peche1c');
            arrayPuntosAux[numeroCara][0][1] = y1;
            // alert('peche1d');
            arrayPuntosAux[numeroCara][1] = new Array();
            arrayPuntosAux[numeroCara][1][0] = x2 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][1][1] = y2;
            arrayPuntosAux[numeroCara][2] = new Array();
            arrayPuntosAux[numeroCara][2][0] = x6 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][2][1] = y6;
            arrayPuntosAux[numeroCara][3] = new Array();
            arrayPuntosAux[numeroCara][3][0] = x5 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][3][1] = y5;
            arrayPuntosAux[numeroCara][4] = new Array();
            arrayPuntosAux[numeroCara][4][0] = x1 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][4][1] = y1;
            numeroCara++;
            //alert('peche2');
            //region 2
            arrayPuntosAux[numeroCara] = new Array();
            arrayRelacionCara[numeroCara] = (i3 - 1) * 5 + 2;
            arrayPuntosAux[numeroCara][0] = new Array();
            arrayPuntosAux[numeroCara][0][0] = x2 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][0][1] = y2;
            arrayPuntosAux[numeroCara][1] = new Array();
            arrayPuntosAux[numeroCara][1][0] = x3 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][1][1] = y3;
            arrayPuntosAux[numeroCara][2] = new Array();
            arrayPuntosAux[numeroCara][2][0] = x7 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][2][1] = y7;
            arrayPuntosAux[numeroCara][3] = new Array();
            arrayPuntosAux[numeroCara][3][0] = x6 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][3][1] = y6;
            arrayPuntosAux[numeroCara][4] = new Array();
            arrayPuntosAux[numeroCara][4][0] = x2 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][4][1] = y2;
            numeroCara++;

            //            processing.vertex(x2+contadorDiente*distancia, y2);
            //            processing.vertex(x3+contadorDiente*distancia, y3);
            //            processing.vertex(x7+contadorDiente*distancia, y7);
            //            processing.vertex(x6+contadorDiente*distancia, y6);
            //            processing.vertex(x2+contadorDiente*distancia, y2);
            //            processing.endShape();

            //region 3
            // alert('peche3');
            arrayPuntosAux[numeroCara] = new Array();
            arrayRelacionCara[numeroCara] = (i3 - 1) * 5 + 3;
            arrayPuntosAux[numeroCara][0] = new Array();
            arrayPuntosAux[numeroCara][0][0] = x3 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][0][1] = y3;
            arrayPuntosAux[numeroCara][1] = new Array();
            arrayPuntosAux[numeroCara][1][0] = x4 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][1][1] = y4;
            arrayPuntosAux[numeroCara][2] = new Array();
            arrayPuntosAux[numeroCara][2][0] = x8 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][2][1] = y8;
            arrayPuntosAux[numeroCara][3] = new Array();
            arrayPuntosAux[numeroCara][3][0] = x7 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][3][1] = y7;
            arrayPuntosAux[numeroCara][4] = new Array();
            arrayPuntosAux[numeroCara][4][0] = x3 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][4][1] = y3;
            numeroCara++;

            //            processing.vertex(x3+contadorDiente*distancia, y3);
            //            processing.vertex(x4+contadorDiente*distancia, y4);
            //            processing.vertex(x8+contadorDiente*distancia, y8);
            //            processing.vertex(x7+contadorDiente*distancia, y7);
            //            processing.vertex(x3+contadorDiente*distancia, y3);
            //            processing.endShape();

            //region 4
            //alert('peche4');
            arrayPuntosAux[numeroCara] = new Array();
            arrayRelacionCara[numeroCara] = (i3 - 1) * 5;
            arrayPuntosAux[numeroCara][0] = new Array();
            arrayPuntosAux[numeroCara][0][0] = x1 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][0][1] = y1;
            arrayPuntosAux[numeroCara][1] = new Array();
            arrayPuntosAux[numeroCara][1][0] = x5 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][1][1] = y5;
            arrayPuntosAux[numeroCara][2] = new Array();
            arrayPuntosAux[numeroCara][2][0] = x8 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][2][1] = y8;
            arrayPuntosAux[numeroCara][3] = new Array();
            arrayPuntosAux[numeroCara][3][0] = x4 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][3][1] = y4;
            arrayPuntosAux[numeroCara][4] = new Array();
            arrayPuntosAux[numeroCara][4][0] = x1 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][4][1] = y1;
            numeroCara++;
            //            processing.vertex(x1+contadorDiente*distancia, y1);
            //            processing.vertex(x5+contadorDiente*distancia, y5);
            //            processing.vertex(x8+contadorDiente*distancia, y8);
            //            processing.vertex(x4+contadorDiente*distancia, y4);
            //            processing.vertex(x1+contadorDiente*distancia, y1);
            //            processing.endShape();

            //region 5
            // alert('peche5');
            arrayPuntosAux[numeroCara] = new Array();
            arrayRelacionCara[numeroCara] = (i3 - 1) * 5 + 4;
            arrayPuntosAux[numeroCara][0] = new Array();
            arrayPuntosAux[numeroCara][0][0] = x5 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][0][1] = y5;
            arrayPuntosAux[numeroCara][1] = new Array();
            arrayPuntosAux[numeroCara][1][0] = x6 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][1][1] = y6;
            arrayPuntosAux[numeroCara][2] = new Array();
            arrayPuntosAux[numeroCara][2][0] = x7 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][2][1] = y7;
            arrayPuntosAux[numeroCara][3] = new Array();
            arrayPuntosAux[numeroCara][3][0] = x8 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][3][1] = y8;
            arrayPuntosAux[numeroCara][4] = new Array();
            arrayPuntosAux[numeroCara][4][0] = x5 + contadorDiente * distancia;
            arrayPuntosAux[numeroCara][4][1] = y5;
            numeroCara++;
            //            processing.vertex(x5+contadorDiente*distancia, y5);
            //            processing.vertex(x6+contadorDiente*distancia, y6);
            //            processing.vertex(x7+contadorDiente*distancia, y7);
            //            processing.vertex(x8+contadorDiente*distancia, y8);
            //            processing.vertex(x5+contadorDiente*distancia, y5);
            //            processing.endShape();

            contadorDiente++;
        //alert('peche6');
        }

    }

    processing.setup = function() {
        processing.size(980, 80);

    };
    var numeroDientes = (numeroAux - 1) / 2;
    processing.draw = function() {
        var distancia = 65;
        var contadorDiente = 0;
        var cara;

        for (var i = 0; i <= numeroDientes; i++) {
            if (seleccionado[i] == 1) {
                //region 1
                processing.beginShape();
                if (seleccionadoCara[(i - 1) * 5 + 1] == 1) {
                    processing.fill(255, 0, 0, 80);
                } else {
                    processing.fill(255, 255, 255, 80);
                }
                processing.vertex(x1 + contadorDiente * distancia, y1);
                processing.vertex(x2 + contadorDiente * distancia, y2);
                processing.vertex(x6 + contadorDiente * distancia, y6);
                processing.vertex(x5 + contadorDiente * distancia, y5);
                processing.vertex(x1 + contadorDiente * distancia, y1);
                processing.endShape();

                //region 2
                processing.beginShape();
                if (seleccionadoCara[(i - 1) * 5 + 2] == 1) {
                    processing.fill(255, 0, 0, 80);
                } else {
                    processing.fill(255, 255, 255, 80);
                }
                processing.vertex(x2 + contadorDiente * distancia, y2);
                processing.vertex(x3 + contadorDiente * distancia, y3);
                processing.vertex(x7 + contadorDiente * distancia, y7);
                processing.vertex(x6 + contadorDiente * distancia, y6);
                processing.vertex(x2 + contadorDiente * distancia, y2);
                processing.endShape();

                //region 3
                processing.beginShape();
                if (seleccionadoCara[(i - 1) * 5 + 3] == 1) {
                    processing.fill(255, 0, 0, 80);
                } else {
                    processing.fill(255, 255, 255, 80);
                }
                processing.vertex(x3 + contadorDiente * distancia, y3);
                processing.vertex(x4 + contadorDiente * distancia, y4);
                processing.vertex(x8 + contadorDiente * distancia, y8);
                processing.vertex(x7 + contadorDiente * distancia, y7);
                processing.vertex(x3 + contadorDiente * distancia, y3);
                processing.endShape();

                //region 4
                processing.beginShape();
                if (seleccionadoCara[(i - 1) * 5] == 1) {
                    processing.fill(255, 0, 0, 80);
                } else {
                    processing.fill(255, 255, 255, 80);
                //alert((i-1)*5+4);
                }
                processing.vertex(x1 + contadorDiente * distancia, y1);
                processing.vertex(x5 + contadorDiente * distancia, y5);
                processing.vertex(x8 + contadorDiente * distancia, y8);
                processing.vertex(x4 + contadorDiente * distancia, y4);
                processing.vertex(x1 + contadorDiente * distancia, y1);
                processing.endShape();

                //region 5
                processing.beginShape();
                if (seleccionadoCara[(i - 1) * 5 + 4] == 1) {
                    processing.fill(255, 0, 0, 80);
                } else {
                    processing.fill(255, 255, 255, 80);
                }
                processing.vertex(x5 + contadorDiente * distancia, y5);
                processing.vertex(x6 + contadorDiente * distancia, y6);
                processing.vertex(x7 + contadorDiente * distancia, y7);
                processing.vertex(x8 + contadorDiente * distancia, y8);
                processing.vertex(x5 + contadorDiente * distancia, y5);
                processing.endShape();

                processing.fill(0, 102, 153);
                processing.text(arrayDatosDientes[i][1], x1 + contadorDiente * distancia + 20, y4 + 5, 60, 20);
                contadorDiente++;
            }

        }

    }
    processing.mouseMoved = function() {
        posX2 = processing.mouseX;
        posY2 = processing.mouseY;
        //alert(arrayPuntosAux);
        var aux1;
        var cont1 = 0;
        var numeroCarasDientes = arrayPuntosAux.length;
        var arrayCarasDientesAux = arrayPuntosAux;
        var mause1 = 0;
        //alert(arrayPuntosAux.length);
        for (var z = 0; z < numeroCarasDientes; z++) {
            cont1 = 0;
            var numeroPuntos1 = arrayPuntosAux[z].length - 1;
            //alert(numeroPuntos1);
            for (var j = 0; j < numeroPuntos1; j++) {
                if (posY2 <= maximo(arrayCarasDientesAux[z][j][1], arrayCarasDientesAux[z][j + 1][1])) {
                    if (posY2 > minimo(arrayCarasDientesAux[z][j][1], arrayCarasDientesAux[z][j + 1][1])) {
                        if (posX2 <= maximo(arrayCarasDientesAux[z][j][0], arrayCarasDientesAux[z][j + 1][0])) {
                            if (arrayCarasDientesAux[z][j][0] != arrayCarasDientesAux[z][j + 1][0]) {
                                aux1 = ((posY2 - arrayCarasDientesAux[z][j][1]) * (arrayCarasDientesAux[z][j + 1][0] - arrayCarasDientesAux[z][j][0])) / (arrayCarasDientesAux[z][j + 1][1] - arrayCarasDientesAux[z][j][1]) + arrayCarasDientesAux[z][j][0];
                            }
                            if ((posX2 <= aux1) || (arrayCarasDientesAux[z][j][0] == arrayCarasDientesAux[z][j + 1][0])) {
                                cont1++;
                            //aux2=aux1;
                            //puntoDatos='px1:'+arrayDientesAux[z][j][0]+'py1:'+arrayDientesAux[z][j][1];
                            // puntoDatos1='px2:'+arrayDientesAux[z][j+1][0]+'py2:'+arrayDientesAux[z][j+1][1];
                            }
                        }
                    }
                }
            }
            if (cont1 % 2 == 1) {
                mause1 = 1;
                adentroCaraAux[z] = 1;
            } else {
                adentroCaraAux[z] = 0;
            }
        }
        if (mause1 == 1) {
            processing.cursor(processing.HAND)
        } else {
            processing.cursor(processing.ARROW)
        }

    }
    processing.mouseClicked = function() {
        //alert(processing.mouseY + 'xxxx'+processing.mouseX);
        var numero = arrayPuntosAux.length;
        var indice = 0;
        for (var s = 0; s < numero; s++) {
            if (adentroCaraAux[s] == 1) {
                indice = arrayRelacionCara[s];
                if (seleccionadoCara[indice] == 1) {
                    seleccionadoCara[indice] = 0;
                } else {
                    seleccionadoCara[indice] = 1;
                //seleccionado[arrayDatosDientesCara[w1][0]]=1;
                //seleccionado[arrayDatosDientesCara[w1][0]+52]=1;
                //alert('id'+w1)

                }
            }
        }

    }

}
function cambiarProgramacionDiente() {
    var programacionSeleccionada = $('programacionSeleccionado').value;
    var numeroProgramaciones = arrayHistoriaDiente.length;
    if (programacionSeleccionada == 'x') {
        for (var i = 0; i < numeroProgramaciones; i++) {
            arrayEstados[i] = 1;
            arrayEstadosCara[i] = 1;
        }


    } else {
        for (var i = 0; i < numeroProgramaciones; i++) {
            arrayEstados[i] = 0;
            arrayEstadosCara[i] = 0;
        }
        arrayEstados[programacionSeleccionada] = 1;
        arrayEstadosCara[programacionSeleccionada] = 1;
    }
    actualizarArrayCaras();
}
function actualizarArrayCaras() {
    var numeroCaras = arrayCaraDientesHistoria.length;
    for (i = 0; i < numeroCaras; i++) {
        arrayCarasAzulesHistoria[i] = 0;
        arrayCarasRojasHistoria[i] = 0;
    }
    var numeroHistoriaCaras = arrayHistoriaCara.length;
    var numeroHistoriaCaraDiente = 0;
    var j = 0;
    var dienteSeleccionado = 0;
    var iIdCara = 0;
    var iColorCara = 0;
    var bColorCara = 0;
    for (var i = 0; i < numeroHistoriaCaras; i++) {
        if (arrayEstadosCara[i] == 1) {
            numeroHistoriaCaraDiente = arrayHistoriaCara[i].length;
            //alert(numeroHistoriaDiente);
            for (j = 0; j < numeroHistoriaCaraDiente; j++) {
                dienteSeleccionado = arrayHistoriaCara[i][j][2];
                iIdCara = arrayHistoriaCara[i][j][5];
                iColorCara = arrayHistoriaCara[i][j][3];
                bColorCara = arrayHistoriaCara[i][j][4];
                // numerCara=iIdDiente*5+iIdCara;
                // alert('diego');
                ///////////////////////

                if ((dienteSeleccionado < 9) || (dienteSeleccionado > 32 && dienteSeleccionado < 38)) {
                    if (iIdCara == 1) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                            }
                        }

                    }

                    if (iIdCara == 2) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+4]=1;
                    }

                    if (iIdCara == 3) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5] = 1;
                            }
                        }
                    // arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5]=1;
                    }

                    if (iIdCara == 4) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+1]=1;
                    }

                    if (iIdCara == 5) {

                    }

                    if (iIdCara == 6) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                            }
                            else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+3]=1;
                    }
                }
                if ((dienteSeleccionado > 8 && dienteSeleccionado < 17) || (dienteSeleccionado > 37 && dienteSeleccionado < 43)) {
                    if (iIdCara == 1) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5]=1;
                    }

                    if (iIdCara == 2) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+4]=1;
                    }

                    if (iIdCara == 3) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                            }
                            else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+2]=1;
                    }

                    if (iIdCara == 4) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+1]=1;
                    }

                    if (iIdCara == 5) {

                    }

                    if (iIdCara == 6) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+3]=1;
                    }
                }
                if ((dienteSeleccionado > 16 && dienteSeleccionado < 25) || (dienteSeleccionado > 42 && dienteSeleccionado < 48)) {
                    if (iIdCara == 1) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5]=1;
                    }

                    if (iIdCara == 2) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                            }
                            else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+4]=1;
                    }

                    if (iIdCara == 3) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+2]=1;
                    }

                    if (iIdCara == 4) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+3]=1;
                    }

                    if (iIdCara == 5) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+1]=1;
                    }

                    if (iIdCara == 6) {

                    }

                }
                if ((dienteSeleccionado > 24 && dienteSeleccionado < 33) || (dienteSeleccionado > 47 && dienteSeleccionado < 53)) {
                    if (iIdCara == 1) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+2]=1;
                    }

                    if (iIdCara == 2) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+4]=1;
                    }

                    if (iIdCara == 3) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5] = 1;
                            }
                            else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5]=1;
                    }

                    if (iIdCara == 4) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+3]=1;
                    }

                    if (iIdCara == 5) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+1]=1;
                    }

                    if (iIdCara == 6) {

                    }

                }
            //////////////////////////////////////
            //arrayCarasAzulesHistoria[numerCara]=1;
            }
        }
    }
}
function animacionHistoria(processing) {
    var adentroCaraHistoria = new Array();
    var anchoImagen = 800;
    var altoImagen = 400;
    var numeroProgramaciones = arrayHistoriaDiente.length;
    var numeroHistoriaDiente = 0;
    var tiempo = 0;
    var programacionSeleccionada = 0;
    seleccionadoHistoria = new Array();
    arrayEstados = new Array();
    arrayDesplazamiento = new Array();
    for (var i = 0; i < numeroProgramaciones; i++) {
        arrayEstados[i] = 1;
        arrayDesplazamiento[i] = 400;
    }

    arrayEstadosCara = new Array();
    arrayDesplazamientoCara = new Array();
    for (var i = 0; i < numeroProgramaciones; i++) {
        arrayEstadosCara[i] = 1;
        arrayDesplazamientoCara[i] = 400;
    }
    numeroAuxHistoria = arrayDientesHistoria.length;
    var adentroHistoria = new Array();
    for (var w = 0; w < numeroAuxHistoria; w++) {
        seleccionadoHistoria[w] = 0;
    //adentroHistoria[w]=0;
    }
    numeroAux1Historia = arrayCaraDientesHistoria.length;
    seleccionadoCaraHistoria = new Array();
    for (var w2 = 0; w2 < numeroAux1Historia; w2++) {
        seleccionadoCaraHistoria[w2] = 0;
        adentroCaraHistoria[w2] = 0;
    }
    arrayCarasAzulesHistoria = new Array();
    arrayCarasRojasHistoria = new Array();

    processing.setup = function() {
        processing.size(800, 400);
        imgHistorial = processing.loadImage("../../../../fastmedical_front/imagen/odontograma/odontograma.png");
        var numeroSimbolos = arraySimbolosHistoria.length;
        arrayImagenAzulesHistoria = new Array();
        arrayImagenRojasHistoria = new Array();
        for (var i = 0; i < numeroSimbolos; i++) {
            arrayImagenAzulesHistoria[i] = processing.loadImage("../../../../fastmedical_front/imagen/odontograma/Azules/" + arraySimbolosHistoria[i][2]);
            arrayImagenRojasHistoria[i] = processing.loadImage("../../../../fastmedical_front/imagen/odontograma/Rojos/" + arraySimbolosHistoria[i][2]);
        }
        var numeroCaras = arrayCaraDientesHistoria.length;
        for (i = 0; i < numeroCaras; i++) {
            arrayCarasAzulesHistoria[i] = 0;
            arrayCarasRojasHistoria[i] = 0;
        }
        var numeroHistoriaCaras = arrayHistoriaCara.length;
        var numeroHistoriaCaraDiente = 0;
        var j = 0;
        var dienteSeleccionado = 0;
        var iIdCara = 0;
        var iColorCara = 0;
        var bColorCara = 0;
        for (i = 0; i < numeroHistoriaCaras; i++) {
            numeroHistoriaCaraDiente = arrayHistoriaCara[i].length;
            //alert(numeroHistoriaDiente);
            for (j = 0; j < numeroHistoriaCaraDiente; j++) {
                dienteSeleccionado = arrayHistoriaCara[i][j][2];
                iIdCara = arrayHistoriaCara[i][j][5];
                iColorCara = arrayHistoriaCara[i][j][3];
                bColorCara = arrayHistoriaCara[i][j][4];
                // numerCara=iIdDiente*5+iIdCara;
                // alert('diego');
                ///////////////////////

                if ((dienteSeleccionado < 9) || (dienteSeleccionado > 32 && dienteSeleccionado < 38)) {
                    if (iIdCara == 1) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                            }
                        }

                    }

                    if (iIdCara == 2) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+4]=1;
                    }

                    if (iIdCara == 3) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5] = 1;
                            }
                        }
                    // arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5]=1;
                    }

                    if (iIdCara == 4) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+1]=1;
                    }

                    if (iIdCara == 5) {

                    }

                    if (iIdCara == 6) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+3]=1;
                    }
                }
                if ((dienteSeleccionado > 8 && dienteSeleccionado < 17) || (dienteSeleccionado > 37 && dienteSeleccionado < 43)) {
                    if (iIdCara == 1) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5]=1;
                    }

                    if (iIdCara == 2) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+4]=1;
                    }

                    if (iIdCara == 3) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+2]=1;
                    }

                    if (iIdCara == 4) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+1]=1;
                    }

                    if (iIdCara == 5) {

                    }

                    if (iIdCara == 6) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+3]=1;
                    }
                }
                if ((dienteSeleccionado > 16 && dienteSeleccionado < 25) || (dienteSeleccionado > 42 && dienteSeleccionado < 48)) {
                    if (iIdCara == 1) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5]=1;
                    }

                    if (iIdCara == 2) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+4]=1;
                    }

                    if (iIdCara == 3) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+2]=1;
                    }

                    if (iIdCara == 4) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+3]=1;
                    }

                    if (iIdCara == 5) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+1]=1;
                    }

                    if (iIdCara == 6) {

                    }

                }
                if ((dienteSeleccionado > 24 && dienteSeleccionado < 33) || (dienteSeleccionado > 47 && dienteSeleccionado < 53)) {
                    if (iIdCara == 1) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 2] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+2]=1;
                    }

                    if (iIdCara == 2) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 4] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+4]=1;
                    }

                    if (iIdCara == 3) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5] = 1;
                            }
                            else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5]=1;
                    }

                    if (iIdCara == 4) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 3] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+3]=1;
                    }

                    if (iIdCara == 5) {
                        if (iColorCara == 1) {
                            arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                        }
                        if (iColorCara == 2) {
                            arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                        }
                        if (iColorCara == 3) {
                            if (bColorCara == 0) {
                                arrayCarasRojasHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                            } else {
                                arrayCarasAzulesHistoria[(dienteSeleccionado - 1) * 5 + 1] = 1;
                            }
                        }
                    //arrayCarasAzulesHistoria[(dienteSeleccionado-1)*5+1]=1;
                    }

                    if (iIdCara == 6) {

                    }

                }
            //////////////////////////////////////
            //arrayCarasAzulesHistoria[numerCara]=1;
            }
        }
    }
    processing.draw = function() {


        var numeroImagen = 0;
        var posicionX = 0;
        var posicionY = 0;
        var ancho = 0;
        var largo = 0;
        var dientesAfectados = 0;
        var iColor = 0;
        var bColor = 0;
        var numeroImagen1 = 0;
        var posicionX1 = 0;
        var posicionY1 = 0;
        var ancho1 = 0;
        var largo1 = 0;
        var dientesAfectados1 = 0;
        var iColor1 = 0;
        var bColor1 = 0;
        var numeroImagen2 = 0;
        var posicionX2 = 0;
        var posicionY2 = 0;
        var ancho2 = 0;
        var largo2 = 0;
        var dientesAfectados2 = 0;
        var iColor2 = 0;
        var bColor2 = 0;
        var xi1;
        var xi2;
        var xp1 = 0;
        var xp2 = 0;
        var anchoSimbolo;
        var anchoSimbolo1;
        var anchoSimbolo2;
        var anchoSimbolo3;
        var anchoSimbolo4;
        var numeroRepeticiones;
        var altoSimbolo;

        processing.image(imgHistorial, 0, 0, anchoImagen, altoImagen);
        for (var i = 0; i < numeroProgramaciones; i++) {
            numeroHistoriaDiente = arrayHistoriaDiente[i].length;
            for (var j = 0; j < numeroHistoriaDiente; j++) {
                numeroImagen = arrayHistoriaDiente[i][j][8] - 1;
                posicionX = arrayHistoriaDiente[i][j][10];
                posicionY = arrayHistoriaDiente[i][j][11];
                ancho = arrayHistoriaDiente[i][j][12];
                largo = arrayHistoriaDiente[i][j][13];
                dientesAfectados = arrayHistoriaDiente[i][j][6];
                iColor = arrayHistoriaDiente[i][j][7];
                bColor = arrayHistoriaDiente[i][j][14];

                if (dientesAfectados == 1) {
                    if (iColor == 1) {
                        processing.image(arrayImagenRojasHistoria[numeroImagen], posicionX - ancho / 2, posicionY - largo / 2 + arrayDesplazamiento[i], ancho, largo);
                    }
                    if (iColor == 2) {
                        processing.image(arrayImagenAzulesHistoria[numeroImagen], posicionX - ancho / 2, posicionY - largo / 2 + arrayDesplazamiento[i], ancho, largo);
                    }
                    if (iColor == 3) {
                        if (bColor == 0) {
                            processing.image(arrayImagenRojasHistoria[numeroImagen], posicionX - ancho / 2, posicionY - largo / 2 + arrayDesplazamiento[i], ancho, largo);
                        } else {
                            processing.image(arrayImagenAzulesHistoria[numeroImagen], posicionX - ancho / 2, posicionY - largo / 2 + arrayDesplazamiento[i], ancho, largo);
                        }
                    }
                }
                if (dientesAfectados == 2) {
                    if (iColor == 1) {
                        processing.image(arrayImagenRojasHistoria[numeroImagen], posicionX - ancho / 2, posicionY - largo / 2 + arrayDesplazamiento[i], ancho, largo);
                    }
                    if (iColor == 2) {
                        processing.image(arrayImagenAzulesHistoria[numeroImagen], posicionX - ancho / 2, posicionY - largo / 2 + arrayDesplazamiento[i], ancho, largo);
                    }
                    if (iColor == 3) {
                        if (bColor == 0) {
                            processing.image(arrayImagenRojasHistoria[numeroImagen], posicionX - ancho / 2, posicionY - largo / 2 + arrayDesplazamiento[i], ancho, largo);
                        } else {
                            processing.image(arrayImagenAzulesHistoria[numeroImagen], posicionX - ancho / 2, posicionY - largo / 2 + arrayDesplazamiento[i], ancho, largo);
                        }
                    }
                    numeroImagen1 = arrayHistoriaDiente[i][j + 1][8] - 1;
                    posicionX1 = arrayHistoriaDiente[i][j + 1][10];
                    posicionY1 = arrayHistoriaDiente[i][j + 1][11];
                    ancho1 = arrayHistoriaDiente[i][j + 1][12];
                    largo1 = arrayHistoriaDiente[i][j + 1][13];
                    dientesAfectados1 = arrayHistoriaDiente[i][j][6];
                    iColor1 = arrayHistoriaDiente[i][j + 1][7];
                    bColor1 = arrayHistoriaDiente[i][j + 1][14];

                    numeroImagen2 = arrayHistoriaDiente[i][j + 2][8] - 1;
                    posicionX2 = arrayHistoriaDiente[i][j + 2][10];
                    posicionY2 = arrayHistoriaDiente[i][j + 2][11];
                    ancho2 = arrayHistoriaDiente[i][j + 2][12];
                    largo2 = arrayHistoriaDiente[i][j + 2][13];
                    dientesAfectados2 = arrayHistoriaDiente[i][j + 2][6];
                    iColor2 = arrayHistoriaDiente[i][j + 2][7];
                    bColor2 = arrayHistoriaDiente[i][j + 2][14];
                    if (iColor2 == 1) {
                        processing.image(arrayImagenRojasHistoria[numeroImagen2], posicionX2 - ancho2 / 2, posicionY2 - largo2 / 2 + arrayDesplazamiento[i], ancho2, largo2);
                    }
                    if (iColor2 == 2) {
                        processing.image(arrayImagenAzulesHistoria[numeroImagen2], posicionX2 - ancho2 / 2, posicionY2 - largo2 / 2 + arrayDesplazamiento[i], ancho2, largo2);
                    }
                    if (iColor2 == 3) {
                        if (bColor2 == 0) {
                            processing.image(arrayImagenRojasHistoria[numeroImagen2], posicionX2 - ancho2 / 2, posicionY2 - largo2 / 2 + arrayDesplazamiento[i], ancho2, largo2);
                        } else {
                            processing.image(arrayImagenAzulesHistoria[numeroImagen2], posicionX2 - ancho2 / 2, posicionY2 - largo2 / 2 + arrayDesplazamiento[i], ancho2, largo2);
                        }
                    }
                    /////////////////////////////////////////////
                    //////////////////////////////////////////

                    if (parseInt(posicionX2) > parseInt(posicionX)) {
                        xi1 = posicionX;
                        xi2 = posicionX2;
                        anchoSimbolo1 = ancho;
                        anchoSimbolo2 = ancho2;
                    } else {
                        xi1 = posicionX2;
                        xi2 = posicionX;
                        anchoSimbolo1 = ancho;
                        anchoSimbolo2 = ancho2;
                    }
                    //alert('xi1:'+xi1+'**** xi2:'+xi2)
                    anchoSimbolo3 = ancho1;
                    xp1 = parseInt(xi1) + anchoSimbolo1 / 2;
                    xp2 = parseInt(xi2) - anchoSimbolo2 / 2;
                    //alert('xp1:'+xp1+'**** xp2:'+xp2)
                    numeroRepeticiones = parseInt((xp2 - xp1) / anchoSimbolo3);
                    anchoSimbolo4 = (xp2 - xp1) / numeroRepeticiones;
                    //alert(numeroRepeticiones);
                    for (var i7 = 0; i7 < numeroRepeticiones; i7++) {
                        anchoSimbolo = anchoSimbolo4;
                        altoSimbolo = largo1;
                        if (iColor == '1') {
                            processing.image(arrayImagenRojasHistoria[numeroImagen1], xp1 + anchoSimbolo4 * i7, posicionY1 - altoSimbolo / 2 + arrayDesplazamiento[i], anchoSimbolo, altoSimbolo);
                        }
                        if (iColor == '2') {
                            processing.image(arrayImagenAzulesHistoria[numeroImagen1], xp1 + anchoSimbolo4 * i7, posicionY1 - altoSimbolo / 2 + arrayDesplazamiento[i], anchoSimbolo, altoSimbolo);
                        }
                        if (iColor == '3') {
                            if (bColor == '0') {
                                //alert(anchoSimbolo);
                                processing.image(arrayImagenRojasHistoria[numeroImagen1], xp1 + anchoSimbolo4 * i7, posicionY1 - altoSimbolo / 2 + arrayDesplazamiento[i], anchoSimbolo, altoSimbolo);
                            } else {
                                processing.image(arrayImagenAzulesHistoria[numeroImagen1], xp1 + anchoSimbolo4 * i7, posicionY1 - altoSimbolo / 2 + arrayDesplazamiento[i], anchoSimbolo, altoSimbolo);
                            }

                        }
                    }

                    ///////////////////////////////////////////////
                    //////////////////////////////////////////////
                    j++;
                    j++;

                }

            }
            if (arrayEstados[i] == 1) {
                if (arrayDesplazamiento[i] <= 0) {
                    arrayDesplazamiento[i] = 0;
                } else {
                    arrayDesplazamiento[i] = arrayDesplazamiento[i] - 100;

                }
            } else {
                if (arrayDesplazamiento[i] >= 400) {
                    arrayDesplazamiento[i] = 400;
                }
                else {
                    arrayDesplazamiento[i] = arrayDesplazamiento[i] + 100;

                }
            }

        }

        ////////////////////////////////////////////
        //dibujar diente
        var numeroDientesHistoria = arrayDientesHistoria.length;
        for (var i = 0; i < numeroDientesHistoria; i++) {
            //////////////////////
            ////////////////////
            processing.noFill();
            //processing.noStroke()
            processing.beginShape();
            //processing.fill(255, 255, 255,100);
            if (adentroHistoria[i] == 0) {
                if (seleccionadoHistoria[i] == 0) {
                    processing.noFill();
                // processing.noStroke()
                //processing.fill(255, 255, 250,80);
                } else {
                    if (seleccionadoHistoria[i] == 1) {
                        processing.fill(255, 0, 0, 80);
                    }

                }

            }
            else {
                if (adentroHistoria[i] == 1) {
                    if (seleccionadoHistoria[i] == 0) {
                        processing.fill(0, 255, 0, 80);
                    } else {
                        if (seleccionadoHistoria[i] == 0) {
                            processing.fill(0, 0, 255, 80);
                        }

                    }
                }

            }

            var numeroPuntosHistoria = arrayDientesHistoria[i].length;
            for (var j = 0; j < numeroPuntosHistoria; j++) {
                processing.vertex(arrayDientesHistoria[i][j][0], arrayDientesHistoria[i][j][1]);
            }
            processing.endShape();
        }

        ////dibujar Cara
        var numeroCaras = arrayCaraDientesHistoria.length;
        //alert(numeroCaras);
        for (var i = 0; i < numeroCaras; i++) {
            processing.noFill();
            processing.noStroke()
            processing.beginShape();
            //processing.fill(0, 0, 255,80);

            if (adentroCaraHistoria[i] == 0) {
                if (seleccionadoCaraHistoria[i] == 0) {
                    processing.noFill();
                    processing.noStroke();
                    //arrayCarasAzules[i]=0;
                    //arrayCarasRojas[i]=0;
                    if (arrayCarasAzulesHistoria[i] == 1) {
                        //alert(i);
                        processing.stroke(0, 0, 0)
                        processing.fill(0, 51, 102)
                    }
                    if (arrayCarasRojasHistoria[i] == 1) {
                        //alert(i);
                        processing.stroke(0, 0, 0)
                        processing.fill(211, 6, 6)
                    }
                //processing.fill(255, 12, 250,80);
                }
                else {
                    if (seleccionadoCaraHistoria[i] == 1) {
                        processing.fill(255, 0, 0, 80);
                    }

                }

            } else {
                if (adentroCaraHistoria[i] == 1) {
                    if (seleccionadoCaraHistoria[i] == 0) {
                        processing.fill(0, 255, 0, 80);
                    } else {
                        if (seleccionadoCaraHistoria[i] == 0) {
                            processing.fill(0, 0, 255, 80);
                        }

                    }
                }

            }

            var numeroPuntosCaras = arrayCaraDientesHistoria[i].length;
            for (var j = 0; j < numeroPuntosCaras; j++) {
                //alert('peche');
                processing.vertex(arrayCaraDientesHistoria[i][j][0], arrayCaraDientesHistoria[i][j][1]);
            }
            processing.endShape();
        }
    /////////fin de dibujar cara


    }
    processing.mouseMoved = function() {
        // processing.loop();
        posXHistoria = processing.mouseX;
        posYHistoria = processing.mouseY;
        //dientes 
        var aux;
        var cont = 0;
        var numeroDientes = arrayDientesHistoria.length;
        var arrayDientesAux = arrayDientesHistoria;
        var mause = 0;
        for (var z = 1; z < numeroDientes; z++) {
            cont = 0;
            var numeroPuntos = arrayDientesHistoria[z].length - 1;
            for (var j = 0; j < numeroPuntos; j++) {
                if (posYHistoria <= maximo(arrayDientesAux[z][j][1], arrayDientesAux[z][j + 1][1])) {
                    if (posYHistoria > minimo(arrayDientesAux[z][j][1], arrayDientesAux[z][j + 1][1])) {
                        if (posXHistoria <= maximo(arrayDientesAux[z][j][0], arrayDientesAux[z][j + 1][0])) {
                            if (arrayDientesAux[z][j][0] != arrayDientesAux[z][j + 1][0]) {
                                aux = ((posYHistoria - arrayDientesAux[z][j][1]) * (arrayDientesAux[z][j + 1][0] - arrayDientesAux[z][j][0])) / (arrayDientesAux[z][j + 1][1] - arrayDientesAux[z][j][1]) + arrayDientesAux[z][j][0];
                            }
                            if ((posXHistoria <= aux) || (arrayDientesAux[z][j][0] == arrayDientesAux[z][j + 1][0])) {
                                cont++;
                            //aux2=aux;
                            //puntoDatos='px1:'+arrayDientesAux[z][j][0]+'py1:'+arrayDientesAux[z][j][1];
                            // puntoDatos1='px2:'+arrayDientesAux[z][j+1][0]+'py2:'+arrayDientesAux[z][j+1][1];
                            }
                        }
                    }
                }
            }
            if (cont % 2 == 1) {
                mause = 1;
                adentroHistoria[z] = 1;
            //alert(arrayDatosDientes[i][0]+'---'+arrayDatosDientes[i][1]+'---'+arrayDatosDientes[i][2]+'---'+i) 
            } else {
                adentroHistoria[z] = 0;
            }
        }
        for (var j2 = 0; j2 < numeroDientes; j2++) {
            if (adentroHistoria[j2] == 1) {
                for (var i2 = 0; i2 < numeroDientes; i2++) {
                    if (arrayDatosDientesHistoria[i2][0] == arrayDatosDientesHistoria[j2][0]) {
                        adentroHistoria[i2] = 1;
                    }
                }
            }
        }
        ////////////////////////////////////////////////

        var aux1;
        var cont1 = 0;
        var numeroCarasDientes = arrayCaraDientesHistoria.length;
        var arrayCarasDientesAux = arrayCaraDientesHistoria;
        var mause1 = 0;
        for (var z = 0; z < numeroCarasDientes; z++) {
            cont1 = 0;
            var numeroPuntos1 = arrayCaraDientesHistoria[z].length - 1;
            //alert(numeroPuntos1);
            for (var j = 0; j < numeroPuntos1; j++) {
                if (posYHistoria <= maximo(arrayCarasDientesAux[z][j][1], arrayCarasDientesAux[z][j + 1][1])) {
                    if (posYHistoria > minimo(arrayCarasDientesAux[z][j][1], arrayCarasDientesAux[z][j + 1][1])) {
                        if (posXHistoria <= maximo(arrayCarasDientesAux[z][j][0], arrayCarasDientesAux[z][j + 1][0])) {
                            if (arrayCarasDientesAux[z][j][0] != arrayCarasDientesAux[z][j + 1][0]) {
                                aux1 = ((posYHistoria - arrayCarasDientesAux[z][j][1]) * (arrayCarasDientesAux[z][j + 1][0] - arrayCarasDientesAux[z][j][0])) / (arrayCarasDientesAux[z][j + 1][1] - arrayCarasDientesAux[z][j][1]) + arrayCarasDientesAux[z][j][0];
                            }
                            if ((posXHistoria <= aux1) || (arrayCarasDientesAux[z][j][0] == arrayCarasDientesAux[z][j + 1][0])) {
                                cont1++;
                            //aux2=aux1;
                            //puntoDatos='px1:'+arrayDientesAux[z][j][0]+'py1:'+arrayDientesAux[z][j][1];
                            // puntoDatos1='px2:'+arrayDientesAux[z][j+1][0]+'py2:'+arrayDientesAux[z][j+1][1];
                            }
                        }
                    }
                }
            }
            if (cont1 % 2 == 1) {
                mause1 = 1;
                adentroCaraHistoria[z] = 1;
            }
            else {
                adentroCaraHistoria[z] = 0;
            }
        }

        //////////////////////////////////////////////////////
        if (mause == 1 || mause1 == 1) {
            //if(mause==1){
            processing.cursor(processing.HAND)
        } else {
            processing.cursor(processing.ARROW)
        }
    }
    processing.mouseClicked = function() {
        //alert(processing.mouseY + 'xxxx'+processing.mouseX);
        //var numeroAux=arrayDientes.length;

        for (var w = 0; w < numeroAuxHistoria / 2; w++) {
            if (adentroHistoria[w] == 1) {

                seleccionadoHistoria[w] = 1;
                seleccionadoHistoria[w + 52] = 1;
                $('dienteSeleccionado').value = w;
                cambiarSelectedValueCombo();
            //                if(seleccionadoHistoria[w]==1){
            //                    seleccionadoHistoria[w]=0;
            //                    /*
            //                    seleccionadoCara[(w-1)*5]=0;
            //                    seleccionadoCara[(w-1)*5+1]=0;
            //                    seleccionadoCara[(w-1)*5+2]=0;
            //                    seleccionadoCara[(w-1)*5+3]=0;
            //                    seleccionadoCara[(w-1)*5+4]=0;
            //                    */
            //                }else{
            //                    seleccionadoHistoria[w]=1;
            //                    /*
            //                    seleccionadoCara[(w-1)*5]=1;
            //                    seleccionadoCara[(w-1)*5+1]=1;
            //                    seleccionadoCara[(w-1)*5+2]=1;
            //                    seleccionadoCara[(w-1)*5+3]=1;
            //                    seleccionadoCara[(w-1)*5+4]=1;
            //                    */
            //                    
            //                }
            }
            else {
                seleccionadoHistoria[w] = 0;
                seleccionadoHistoria[w + 52] = 0;
            }
        }
    /*
         for(var w1=0;w1<numeroAux1;w1++){
         
         if(adentroCara[w1]==1){
         if(seleccionadoCara[w1]==1){
         seleccionadoCara[w1]=0;
         }else{
         seleccionadoCara[w1]=1;
         seleccionado[arrayDatosDientesCara[w1][0]]=1;
         seleccionado[arrayDatosDientesCara[w1][0]+52]=1;
         //alert('id'+w1)
         
         }
         
         }
         }
         */
    }
    cargarTablaHistoriaOdontograma();
///////////////////////////////////////////
}
function animacion2(processing) {
    var img = processing.PImage;
    var ancho = 800;
    var alto = 400;
    var adentro = new Array();
    var adentroCara = new Array();
    seleccionado = new Array();
    seleccionadoCara = new Array();
    numeroAux = arrayDientes.length;
    numeroAux1 = arrayCaraDientes.length;
    arrayCarasAzules = new Array();
    arrayCarasRojas = new Array();
    for (var w = 0; w < numeroAux; w++) {
        seleccionado[w] = 0;
    }
    for (var w2 = 0; w2 < numeroAux1; w2++) {
        seleccionadoCara[w2] = 0;
        adentroCara[w2] = 0
    }
    processing.setup = function() {
        processing.size(800, 400);
        img = processing.loadImage("../../../../fastmedical_front/imagen/odontograma/odontograma.png");
        var numeroSimbolos = arraySimbolos.length;
        arrayImagenAzules = new Array();
        arrayImagenRojas = new Array();
        for (var i = 0; i < numeroSimbolos; i++) {
            arrayImagenAzules[i] = processing.loadImage("../../../../fastmedical_front/imagen/odontograma/Azules/" + arraySimbolos[i][2]);
            arrayImagenRojas[i] = processing.loadImage("../../../../fastmedical_front/imagen/odontograma/Rojos/" + arraySimbolos[i][2]);
        }

        var numeroCaras = arrayCaraDientes.length;
        for (i = 0; i < numeroCaras; i++) {
            arrayCarasAzules[i] = 0;
            arrayCarasRojas[i] = 0;
        }

    };
    processing.draw = function() {

        processing.image(img, 0, 0, ancho, alto);

        var numeroAntecedentes = $('numeroAntecedentesOdontograma').value;
        //  var numeroMarcas=arrayMarcas.length;
        var anchoSimbolo;
        var anchoSimbolo1;
        var anchoSimbolo2;
        var anchoSimbolo3;
        var anchoSimbolo4;
        var numeroRepeticiones;
        var altoSimbolo;
        var arraySimboloPeche = new Array();
        var arrayAnchoPeche = new Array();
        var arrayAltoPeche = new Array();
        var arrayPxPeche = new Array();
        var arrayPyPeche = new Array();
        var numeroPeche;
        var xi1;
        var xi2;
        var xp1 = 0;
        var xp2 = 0;
        var dienteSeleccionado = 0;
        var mesial = 0;
        var oclusalInsisal = 0;
        var distal = 0;
        var vestibular = 0;
        var lingual = 0;
        var palatina = 0;

        for (var ic = 0; ic < arrayDientes.length; ic++) {
            arrayCarasAzules[ic] = 0;
            arrayCarasRojas[ic] = 0;
        }
        for (var i5 = 0; i5 < numeroAntecedentes; i5++) {
            if ($('idSimbolo_' + i5).value != '') {
                if ($('dientesAfectados_' + i5).value == 1) {
                    arraySimboloPeche = $('idSimbolo_' + i5).value.split("-");
                    arrayAnchoPeche = $('ancho_' + i5).value.split("-");
                    arrayAltoPeche = $('alto_' + i5).value.split("-");
                    arrayPxPeche = $('px_' + i5).value.split("-");
                    arrayPyPeche = $('py_' + i5).value.split("-");
                    numeroPeche = arraySimboloPeche.length - 1;
                    for (var i6 = 0; i6 < numeroPeche; i6++) {
                        anchoSimbolo = arrayAnchoPeche[i6];
                        altoSimbolo = arrayAltoPeche[i6];
                        if ($('colorSimbolo_' + i5).value == '1') {
                            processing.image(arrayImagenRojas[arraySimboloPeche[i6] - 1], arrayPxPeche[i6] - anchoSimbolo / 2, arrayPyPeche[i6] - altoSimbolo / 2, anchoSimbolo, altoSimbolo);
                        }
                        if ($('colorSimbolo_' + i5).value == '2') {
                            processing.image(arrayImagenAzules[arraySimboloPeche[i6] - 1], arrayPxPeche[i6] - anchoSimbolo / 2, arrayPyPeche[i6] - altoSimbolo / 2, anchoSimbolo, altoSimbolo);
                        }
                        if ($('colorSimbolo_' + i5).value == '3') {
                            if ($('selectestado_' + i5).value == '0') {
                                processing.image(arrayImagenRojas[arraySimboloPeche[i6] - 1], arrayPxPeche[i6] - anchoSimbolo / 2, arrayPyPeche[i6] - altoSimbolo / 2, anchoSimbolo, altoSimbolo);
                            } else {
                                processing.image(arrayImagenAzules[arraySimboloPeche[i6] - 1], arrayPxPeche[i6] - anchoSimbolo / 2, arrayPyPeche[i6] - altoSimbolo / 2, anchoSimbolo, altoSimbolo);
                            }

                        }
                    }
                }
                if ($('dientesAfectados_' + i5).value == 2) {
                    arraySimboloPeche = $('idSimbolo_' + i5).value.split("-");
                    arrayAnchoPeche = $('ancho_' + i5).value.split("-");
                    arrayAltoPeche = $('alto_' + i5).value.split("-");
                    arrayPxPeche = $('px_' + i5).value.split("-");
                    arrayPyPeche = $('py_' + i5).value.split("-");
                    anchoSimbolo = arrayAnchoPeche[0];

                    altoSimbolo = arrayAltoPeche[0];
                    if ($('colorSimbolo_' + i5).value == '1') {

                        processing.image(arrayImagenRojas[arraySimboloPeche[0] - 1], arrayPxPeche[0] - anchoSimbolo / 2, arrayPyPeche[0] - altoSimbolo / 2, anchoSimbolo, altoSimbolo);
                    }
                    if ($('colorSimbolo_' + i5).value == '2') {
                        processing.image(arrayImagenAzules[arraySimboloPeche[0] - 1], arrayPxPeche[0] - anchoSimbolo / 2, arrayPyPeche[0] - altoSimbolo / 2, anchoSimbolo, altoSimbolo);
                    }
                    if ($('colorSimbolo_' + i5).value == '3') {
                        if ($('selectestado_' + i5).value == '0') {
                            processing.image(arrayImagenRojas[arraySimboloPeche[0] - 1], arrayPxPeche[0] - anchoSimbolo / 2, arrayPyPeche[0] - altoSimbolo / 2, anchoSimbolo, altoSimbolo);
                        } else {
                            processing.image(arrayImagenAzules[arraySimboloPeche[0] - 1], arrayPxPeche[0] - anchoSimbolo / 2, arrayPyPeche[0] - altoSimbolo / 2, anchoSimbolo, altoSimbolo);
                        }

                    }
                    anchoSimbolo = arrayAnchoPeche[2];

                    altoSimbolo = arrayAltoPeche[2];
                    if ($('colorSimbolo_' + i5).value == '1') {
                        processing.image(arrayImagenRojas[arraySimboloPeche[2] - 1], arrayPxPeche[2] - anchoSimbolo / 2, arrayPyPeche[2] - altoSimbolo / 2, anchoSimbolo, altoSimbolo);
                    }
                    if ($('colorSimbolo_' + i5).value == '2') {
                        processing.image(arrayImagenAzules[arraySimboloPeche[2] - 1], arrayPxPeche[2] - anchoSimbolo / 2, arrayPyPeche[2] - altoSimbolo / 2, anchoSimbolo, altoSimbolo);
                    }
                    if ($('colorSimbolo_' + i5).value == '3') {
                        if ($('selectestado_' + i5).value == '0') {
                            processing.image(arrayImagenRojas[arraySimboloPeche[2] - 1], arrayPxPeche[2] - anchoSimbolo / 2, arrayPyPeche[2] - altoSimbolo / 2, anchoSimbolo, altoSimbolo);
                        }
                        else {
                            processing.image(arrayImagenAzules[arraySimboloPeche[2] - 1], arrayPxPeche[2] - anchoSimbolo / 2, arrayPyPeche[2] - altoSimbolo / 2, anchoSimbolo, altoSimbolo);
                        }

                    }
                    if (parseInt(arrayPxPeche[2]) > parseInt(arrayPxPeche[0])) {
                        xi1 = arrayPxPeche[0];
                        xi2 = arrayPxPeche[2];
                        anchoSimbolo1 = arrayAnchoPeche[0];
                        anchoSimbolo2 = arrayAnchoPeche[2];
                    } else {
                        xi1 = arrayPxPeche[2];
                        xi2 = arrayPxPeche[0];
                        anchoSimbolo1 = arrayAnchoPeche[2];
                        anchoSimbolo2 = arrayAnchoPeche[0];
                    }
                    //alert('xi1:'+xi1+'**** xi2:'+xi2)
                    anchoSimbolo3 = arrayAnchoPeche[1];
                    xp1 = parseInt(xi1) + anchoSimbolo1 / 2;
                    xp2 = parseInt(xi2) - anchoSimbolo2 / 2;
                    //alert('xp1:'+xp1+'**** xp2:'+xp2)
                    numeroRepeticiones = parseInt((xp2 - xp1) / anchoSimbolo3);
                    anchoSimbolo4 = (xp2 - xp1) / numeroRepeticiones;
                    //alert(numeroRepeticiones);
                    for (var i7 = 0; i7 < numeroRepeticiones; i7++) {
                        anchoSimbolo = anchoSimbolo4;
                        altoSimbolo = arrayAltoPeche[1];
                        if ($('colorSimbolo_' + i5).value == '1') {
                            processing.image(arrayImagenRojas[arraySimboloPeche[1] - 1], xp1 + anchoSimbolo4 * i7, arrayPyPeche[1] - altoSimbolo / 2, anchoSimbolo, altoSimbolo);
                        }
                        if ($('colorSimbolo_' + i5).value == '2') {
                            processing.image(arrayImagenAzules[arraySimboloPeche[1] - 1], xp1 + anchoSimbolo4 * i7, arrayPyPeche[1] - altoSimbolo / 2, anchoSimbolo, altoSimbolo);
                        }
                        if ($('colorSimbolo_' + i5).value == '3') {
                            if ($('selectestado_' + i5).value == '0') {
                                processing.image(arrayImagenRojas[arraySimboloPeche[1] - 1], xp1 + anchoSimbolo4 * i7, arrayPyPeche[1] - altoSimbolo / 2, anchoSimbolo, altoSimbolo);
                            } else {
                                processing.image(arrayImagenAzules[arraySimboloPeche[1] - 1], xp1 + anchoSimbolo4 * i7, arrayPyPeche[1] - altoSimbolo / 2, anchoSimbolo, altoSimbolo);
                            }

                        }
                    }

                }

            }
            /////////////////////////para las caras/
            dienteSeleccionado = $('txt_idDiente1_' + i5).value
            if ((dienteSeleccionado < 9) || (dienteSeleccionado > 32 && dienteSeleccionado < 38)) {
                if ($('Mesial' + i5).checked == true) {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 2] = 1;
                }
                else {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 2] = 0;
                }

                if ($('Incisal' + i5).checked == true) {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 4] = 1;
                } else {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 4] = 0;
                }

                if ($('Distal' + i5).checked == true) {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5] = 1;
                } else {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5] = 0;
                }

                if ($('Vestibular' + i5).checked == true) {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 1] = 1;
                } else {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 1] = 0;
                }

                if ($('Lingual' + i5).checked == true) {

                }

                if ($('Palatina' + i5).checked == true) {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 3] = 1;

                } else {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 3] = 0;
                }
            }
            if ((dienteSeleccionado > 8 && dienteSeleccionado < 17) || (dienteSeleccionado > 37 && dienteSeleccionado < 43)) {
                if ($('Mesial' + i5).checked == true) {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5] = 1;
                } else {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5] = 0;
                }

                if ($('Incisal' + i5).checked == true) {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 4] = 1;
                } else {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 4] = 0;
                }

                if ($('Distal' + i5).checked == true) {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 2] = 1;
                } else {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 2] = 0;
                }

                if ($('Vestibular' + i5).checked == true) {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 1] = 1;
                }
                else {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 1] = 0;
                }

                if ($('Lingual' + i5).checked == true) {

                }

                if ($('Palatina' + i5).checked == true) {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 3] = 1;
                } else {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 3] = 0;
                }
            }
            if ((dienteSeleccionado > 16 && dienteSeleccionado < 25) || (dienteSeleccionado > 42 && dienteSeleccionado < 48)) {
                if ($('Mesial' + i5).checked == true) {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5] = 1;
                } else {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5] = 0;
                }

                if ($('Incisal' + i5).checked == true) {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 4] = 1;
                } else {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 4] = 0;
                }

                if ($('Distal' + i5).checked == true) {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 2] = 1;
                }
                else {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 2] = 0;
                }

                if ($('Vestibular' + i5).checked == true) {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 3] = 1;
                } else {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 3] = 0;
                }

                if ($('Lingual' + i5).checked == true) {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 1] = 1;
                } else {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 1] = 0;
                }

                if ($('Palatina' + i5).checked == true) {

                }

            }
            if ((dienteSeleccionado > 24 && dienteSeleccionado < 33) || (dienteSeleccionado > 47 && dienteSeleccionado < 53)) {
                if ($('Mesial' + i5).checked == true) {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 2] = 1;
                } else {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 2] = 0;
                }

                if ($('Incisal' + i5).checked == true) {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 4] = 1;
                } else {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 4] = 0;
                }

                if ($('Distal' + i5).checked == true) {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5] = 1;
                } else {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5] = 0;
                }

                if ($('Vestibular' + i5).checked == true) {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 3] = 1;
                } else {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 3] = 0;
                }

                if ($('Lingual' + i5).checked == true) {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 1] = 1;
                } else {
                    arrayCarasRojas[(dienteSeleccionado - 1) * 5 + 1] = 0;
                }

                if ($('Palatina' + i5).checked == true) {

                }

            }
        /////////////////////////
        //alert(dienteSeleccionado);
        }

        //dibujar diente
        var numeroDientes = arrayDientes.length;
        for (var i = 0; i < numeroDientes; i++) {
            //////////////////////



            ////////////////////
            processing.noFill();
            //processing.noStroke()
            processing.beginShape();
            //processing.fill(255, 255, 255,100);

            if (adentro[i] == 0) {
                if (seleccionado[i] == 0) {
                    processing.noFill();
                // processing.noStroke()
                //processing.fill(255, 255, 250,80);
                } else {
                    if (seleccionado[i] == 1) {
                        processing.fill(255, 0, 0, 80);
                    }

                }

            } else {
                if (adentro[i] == 1) {
                    if (seleccionado[i] == 0) {
                        processing.fill(0, 255, 0, 80);
                    }
                    else {
                        if (seleccionado[i] == 0) {
                            processing.fill(0, 0, 255, 80);
                        }

                    }
                }

            }

            var numeroPuntos = arrayDientes[i].length;
            for (var j = 0; j < numeroPuntos; j++) {
                processing.vertex(arrayDientes[i][j][0], arrayDientes[i][j][1]);
            }
            processing.endShape();
        }


        //////////////dibujar Caras/////////////////////////////

        var numeroCaras = arrayCaraDientes.length;
        for (var i = 0; i < numeroCaras; i++) {
            processing.noFill();
            processing.noStroke()
            processing.beginShape();
            // processing.fill(0, 0, 255,80);

            if (adentroCara[i] == 0) {
                if (seleccionadoCara[i] == 0) {
                    processing.noFill();
                    processing.noStroke();
                    //arrayCarasAzules[i]=0;
                    //arrayCarasRojas[i]=0;
                    if (arrayCarasAzules[i] == 1) {
                        //alert(i);
                        processing.stroke(0, 0, 0)
                        processing.fill(0, 51, 102)
                    }
                    if (arrayCarasRojas[i] == 1) {
                        //alert(i);
                        processing.stroke(0, 0, 0)
                        processing.fill(211, 6, 6)
                    }
                //processing.fill(255, 12, 250,80);
                }
                else {
                    if (seleccionadoCara[i] == 1) {
                        processing.fill(255, 0, 0, 80);
                    }

                }

            } else {
                if (adentroCara[i] == 1) {
                    if (seleccionadoCara[i] == 0) {
                        processing.fill(0, 255, 0, 80);
                    } else {
                        if (seleccionadoCara[i] == 0) {
                            processing.fill(0, 0, 255, 80);
                        }

                    }
                }

            }

            var numeroPuntosCaras = arrayCaraDientes[i].length;
            for (var j = 0; j < numeroPuntosCaras; j++) {
                processing.vertex(arrayCaraDientes[i][j][0], arrayCaraDientes[i][j][1]);
            }
            processing.endShape();
        }

    ////////////////////////////////////////
    //processing.noLoop();
    }
    processing.mouseMoved = function() {
        // processing.loop();
        posX = processing.mouseX;
        posY = processing.mouseY;
        //dientes 
        var aux;
        var cont = 0;
        var numeroDientes = arrayDientes.length;
        var arrayDientesAux = arrayDientes;
        var mause = 0;
        for (var z = 1; z < numeroDientes; z++) {
            cont = 0;
            var numeroPuntos = arrayDientes[z].length - 1;
            for (var j = 0; j < numeroPuntos; j++) {
                if (posY <= maximo(arrayDientesAux[z][j][1], arrayDientesAux[z][j + 1][1])) {
                    if (posY > minimo(arrayDientesAux[z][j][1], arrayDientesAux[z][j + 1][1])) {
                        if (posX <= maximo(arrayDientesAux[z][j][0], arrayDientesAux[z][j + 1][0])) {
                            if (arrayDientesAux[z][j][0] != arrayDientesAux[z][j + 1][0]) {
                                aux = ((posY - arrayDientesAux[z][j][1]) * (arrayDientesAux[z][j + 1][0] - arrayDientesAux[z][j][0])) / (arrayDientesAux[z][j + 1][1] - arrayDientesAux[z][j][1]) + arrayDientesAux[z][j][0];
                            }
                            if ((posX <= aux) || (arrayDientesAux[z][j][0] == arrayDientesAux[z][j + 1][0])) {
                                cont++;
                            //aux2=aux;
                            //puntoDatos='px1:'+arrayDientesAux[z][j][0]+'py1:'+arrayDientesAux[z][j][1];
                            // puntoDatos1='px2:'+arrayDientesAux[z][j+1][0]+'py2:'+arrayDientesAux[z][j+1][1];
                            }
                        }
                    }
                }
            }
            if (cont % 2 == 1) {
                mause = 1;
                adentro[z] = 1;
            //alert(arrayDatosDientes[i][0]+'---'+arrayDatosDientes[i][1]+'---'+arrayDatosDientes[i][2]+'---'+i) 
            } else {
                adentro[z] = 0;
            }
        }
        for (var j2 = 0; j2 < numeroDientes; j2++) {
            if (adentro[j2] == 1) {
                for (var i2 = 0; i2 < numeroDientes; i2++) {
                    if (arrayDatosDientes[i2][0] == arrayDatosDientes[j2][0]) {
                        adentro[i2] = 1;
                    }
                }
            }
        }
        ////////////////////////////////////////////////
        var aux1;
        var cont1 = 0;
        var numeroCarasDientes = arrayCaraDientes.length;
        var arrayCarasDientesAux = arrayCaraDientes;
        var mause1 = 0;
        for (var z = 0; z < numeroCarasDientes; z++) {
            cont1 = 0;
            var numeroPuntos1 = arrayCaraDientes[z].length - 1;
            //alert(numeroPuntos1);
            for (var j = 0; j < numeroPuntos1; j++) {
                if (posY <= maximo(arrayCarasDientesAux[z][j][1], arrayCarasDientesAux[z][j + 1][1])) {
                    if (posY > minimo(arrayCarasDientesAux[z][j][1], arrayCarasDientesAux[z][j + 1][1])) {
                        if (posX <= maximo(arrayCarasDientesAux[z][j][0], arrayCarasDientesAux[z][j + 1][0])) {
                            if (arrayCarasDientesAux[z][j][0] != arrayCarasDientesAux[z][j + 1][0]) {
                                aux1 = ((posY - arrayCarasDientesAux[z][j][1]) * (arrayCarasDientesAux[z][j + 1][0] - arrayCarasDientesAux[z][j][0])) / (arrayCarasDientesAux[z][j + 1][1] - arrayCarasDientesAux[z][j][1]) + arrayCarasDientesAux[z][j][0];
                            }
                            if ((posX <= aux1) || (arrayCarasDientesAux[z][j][0] == arrayCarasDientesAux[z][j + 1][0])) {
                                cont1++;
                            //aux2=aux1;
                            //puntoDatos='px1:'+arrayDientesAux[z][j][0]+'py1:'+arrayDientesAux[z][j][1];
                            // puntoDatos1='px2:'+arrayDientesAux[z][j+1][0]+'py2:'+arrayDientesAux[z][j+1][1];
                            }
                        }
                    }
                }
            }
            if (cont1 % 2 == 1) {
                mause1 = 1;
                adentroCara[z] = 1;
            } else {
                adentroCara[z] = 0;
            }
        }
        //////////////////////////////////////////////////////
        if (mause == 1 || mause1 == 1) {
            processing.cursor(processing.HAND)
        } else {
            processing.cursor(processing.ARROW)
        }
    }
    processing.mouseClicked = function() {
        //alert(processing.mouseY + 'xxxx'+processing.mouseX);
        //var numeroAux=arrayDientes.length;

        for (var w = 0; w < numeroAux; w++) {
            if (adentro[w] == 1) {
                if (seleccionado[w] == 1) {
                    seleccionado[w] = 0;
                    seleccionadoCara[(w - 1) * 5] = 0;
                    seleccionadoCara[(w - 1) * 5 + 1] = 0;
                    seleccionadoCara[(w - 1) * 5 + 2] = 0;
                    seleccionadoCara[(w - 1) * 5 + 3] = 0;
                    seleccionadoCara[(w - 1) * 5 + 4] = 0;
                } else {
                    seleccionado[w] = 1;
                    seleccionadoCara[(w - 1) * 5] = 1;
                    seleccionadoCara[(w - 1) * 5 + 1] = 1;
                    seleccionadoCara[(w - 1) * 5 + 2] = 1;
                    seleccionadoCara[(w - 1) * 5 + 3] = 1;
                    seleccionadoCara[(w - 1) * 5 + 4] = 1;


                }
            }
        }
        for (var w1 = 0; w1 < numeroAux1; w1++) {

            if (adentroCara[w1] == 1) {
                if (seleccionadoCara[w1] == 1) {
                    seleccionadoCara[w1] = 0;
                }
                else {
                    seleccionadoCara[w1] = 1;
                    seleccionado[arrayDatosDientesCara[w1][0]] = 1;
                    seleccionado[arrayDatosDientesCara[w1][0] + 52] = 1;
                //alert('id'+w1)

                }

            }
        }
    }
}



function maximo(a, b) {
    if (a > b) {
        return a;
    }
    else {
        return b;
    }
}
function minimo(a, b) {
    if (a < b) {
        return a;
    } else {
        return b;
    }
}


//function probar(fila,columna){
//    var selId = tablaTablaPAquete.getSelectedId();
//    alert(selId);
//    tablaTablaPAquete.deleteRow(selId);
//}

///Lobo

function peche(key, lobo) {
    var tabla = eval('tablaTablaPAquete_' + key);
    var numeroFilas = tabla.getRowsNum();
    alert(numeroFilas);

}
function ActualizarServicios(numeroPaquetes, iIdGrupoEtarioPersonas, c_cod_per) {
    var patronModulo = 'actualizarPaquetesPersona';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iIdGrupoEtarioPersonas;
    contadorCargador++;
    var idCargadora = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargadora),
        onComplete: function(transport) {
            
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: "p1=cargarPaquetesActualizados&p2="+iIdGrupoEtarioPersonas+"&p3="+c_cod_per,
                onComplete: function(transport) {
                    cargadorpeche(0, idCargadora)
                    respuesta = transport.responseText;
                    alert(respuesta)
                    $('nuevo_refresca').update(respuesta);
                }
            })
        }
    })
}
function GeneralServicos(numeroPaquetes, iIdGrupoEtarioPersonas) {
    var icodigoProgramacion = $('hcodigoProgramacion').value;
    var estado = 1;
    var j = 0;
    var iCantidad = 0;
    myvariosServicios = new Array();

    var tablaTablaPAquete;
    var numeroFilas;
    //    alert(icodigoProgramacion);
    for (var k = 0; k < numeroPaquetes; k++) {
        tablaTablaPAquete = eval('tablaTablaPAquete_' + k);
        var NombreGrupo = $('NombreGrupoEtareo' + k).value;
        numeroFilas = tablaTablaPAquete.getRowsNum();
        //        alert(numeroFilas);

        for (var i = 0; i < numeroFilas; i++) {
            var iIdServicioGrupoEtareoPersona = tablaTablaPAquete.cells(i, 0).getValue();
            //            alert(iIdServicioGrupoEtareoPersona);  
            var cantidad=tablaTablaPAquete.cells(i,3).getValue();
            var   codigopracticamedica = tablaTablaPAquete.cells(i,5).getValue();// codigo Producto
            var descripcionpracticamedica =tablaTablaPAquete.cells(i,4).getValue();
            var nombreTratamiento=tablaTablaPAquete.cells(i,17).getValue();
            var nombre = Base64.encode(nombreTratamiento); 
            var valorServicio=NombreGrupo+'  '+descripcionpracticamedica
            //             alert(valorServicio);
            valorServicio=Base64.encode(valorServicio);
            
            var nroAte =tablaTablaPAquete.cells(i,6).getValue();
            var nroAtemin=tablaTablaPAquete.cells(i,10).getValue();
            var iGrupoEtario =tablaTablaPAquete.cells(i,13).getValue();
            var ctp=tablaTablaPAquete.cells(i,1).getValue();
            var iColor =tablaTablaPAquete.cells(i,14).getValue();
            var bReceta =tablaTablaPAquete.cells(i,18).getValue();
            var vDescripcionReceta =tablaTablaPAquete.cells(i,21).getValue();
            var iFrecuenciaDias =tablaTablaPAquete.cells(i,22).getValue();
            var iCantidadReceta =tablaTablaPAquete.cells(i,23).getValue();
            var vIndicaciones =tablaTablaPAquete.cells(i,24).getValue();

            var numerodivpracticamedica = contadorDivsPracticaMedica;
            var idtratamiento = '';
            var modoaplicacion = '';
            var estadoregistro = 0;

            if(bReceta!=1){
                if( cantidad >1){
                    if(iColor!=1){
                        if(nroAte==nroAtemin){
                            codigos = document.getElementById("htxtcodigosServicios").value;
                            var a=myvariosServicios.length;
                            var indicador=0;
                            for(var h=0;h<a;h++){  
                                var arrayPalabrasServcios2 =myvariosServicios[h].split("*");
                                var ctp1=arrayPalabrasServcios2[3];
                                if(ctp1==ctp){
                                    indicador=1;                        
                                }                                       
                            }
                            if(indicador!=1){
                                myvariosServicios[j]=nroAte+'*'+iGrupoEtario+'*'+i+'*'+ctp+'*'+ iIdServicioGrupoEtareoPersona+'*'+descripcionpracticamedica+'*'+NombreGrupo+'*'+k;   
                                j++
                            }
                            tablaTablaPAquete.deleteRow(i);
                        }
                    }
                } else {
                    // FIN
                    if(cantidad==1 ){
                        //                    tablaTablaPAquete.deleteRow(i);
                        if(iColor!=1){
                            if(nroAte==nroAtemin){
                                if(codigopracticamedica!=0){
                                    tablaTablaPAquete.deleteRow(i);
                                }
                                
                                codigos = document.getElementById("htxtcodigosServicios").value;
                                if (!((codigos.indexOf(codigopracticamedica + "|") != -1) || (codigos.indexOf(codigopracticamedica) != -1))) {
                                    var patronModulo='agregarPracticaMedicaHC';
                                    var parametros='';
                                    parametros+='p1='+patronModulo;
                                    parametros+='&p2='+nombre;// ya
                                    parametros+='&p3='+numerodivpracticamedica;//ya
                                    parametros+='&p4='+codigopracticamedica;
                                    parametros+='&p5='+idtratamiento;//ya
                                    parametros+='&p6='+modoaplicacion;//ya
                                    parametros+='&p7='+estadoregistro;//ya
                                    parametros+='&p8='+'';
                                    parametros+='&p9='+estado;// ya
                                    parametros+='&p10='+valorServicio;// ya
                                    contadorCargador++;
                                    var idCargador=contadorCargador;
                                    new Ajax.Request( pathRequestControl,{
                                        method : 'get',
                                        asynchronous : false,
                                        parameters : parametros,
                                        onLoading : cargadorpeche(1,idCargador),
                                        onComplete : function(transport){
                                            cargadorpeche(0,idCargador);
                                            var respuesta = transport.responseText;
                                            var nombrediv = "Div_PracticaMedica"+numerodivpracticamedica;
                                            creaPracticaMedica(nombrediv);
                                            $(nombrediv).innerHTML = respuesta;
                                            contadorDivsPracticaMedica++;
                                            $('hNumeroTratamientoPracticasMedicas').value = parseInt($('hNumeroTratamientoPracticasMedicas').value) + 1;
                                            preguardarTratatamientoPracticasMedicas(estado);
                                            actualizarEstadoDeServicioGrupoEtarioPersona(iIdServicioGrupoEtareoPersona,iCantidad); 
                                            if (codigos.length > 0){
                                                codigos = codigos + "|" + codigopracticamedica;
                                            }else {
                                                codigos = codigopracticamedica;
                                            }
                                            document.getElementById("htxtcodigosServicios").value=codigos;
                                    
                                        }
                                    } )
                                }

                            }

                        }
                    }
                }
            }else {
                if(bReceta==1 && iColor!=1){
                    var divAumentar = 'divRecetaGeneral'
                    var nroReceta;
                    var elemento;
                    var existe = 0;
                    var numeroProducto = 1;
                    var nombreMedicamento;
                    var codigoProducto;
                    var presentacion;
                    var numeroRecetas;
                    var stock;
                    var data = '';

                    nroReceta = $('nroReceta').value;
                    var cantidadRecetas = $('hcantidadRecetas').value;
                    if (cantidadRecetas >= (nroReceta - 1)) {
                        codigoProducto = codigopracticamedica;//tablaProductosTratamientos.cells(rowId, 0).getValue();
                        elemento = document.getElementById('hAgregados_' + nroReceta)
                        
                        if(elemento == null){
                            nroReceta = $('nroReceta').value;
                            var elemento1 = document.getElementById('divReceta_' + nroReceta);
                            if (elemento1 == null) {//verificamos si existe un div para la receta
                                divAumentar = 'divRecetaGeneral'
                                existe = 0;
                                numeroRecetas = $('hcantidadRecetas').value;
                                numeroRecetas++;
                                $('hcantidadRecetas').value = numeroRecetas;
                            } else {
                                divAumentar = 'divReceta_' + nroReceta;
                                existe = 1;
                                numeroProducto = $('hNumeroProductos_' + nroReceta).value;
                                numeroProducto++;
                                $('hNumeroProductos_' + nroReceta).value = numeroProducto;
                            }
                            nombreMedicamento = nombreTratamiento;
                            presentacion = vDescripcionReceta;
                            var patronModulo = 'agregarMedicamentoHC';
                            var parametros = '';
                            parametros += 'p1=' + patronModulo;
                            parametros += '&p2=' + existe;
                            parametros += '&p3=' + nroReceta;
                            parametros += '&p4=' + Base64.encode(nombreMedicamento);
                            parametros += '&p5=' + codigoProducto;
                            parametros += '&p6=' + presentacion;
                            parametros += '&p7=' + numeroProducto;

                            contadorCargador++;
                            var idCargador = contadorCargador;
                            new Ajax.Request(pathRequestControl, {
                                method: 'get',
                                asynchronous: false,
                                parameters: parametros,
                                onLoading: cargadorpeche(1, idCargador),
                                onComplete: function(transport) {
                                    cargadorpeche(0, idCargador);
                                    var respuesta = transport.responseText;
                                    var para = document.getElementById(divAumentar);
                                    var s = respuesta;
                                    var range = document.createRange();
                                    range.selectNode(document.body);
                                    var documentFragment = range.createContextualFragment(s);
                                    para.appendChild(documentFragment);
                                    //                                     alert(codigoProducto);
                                    $('hAgregados_' + nroReceta).value = codigoProducto+ '|' ;
                                    if(codigopracticamedica!=0){
                                        tablaTablaPAquete.deleteRow(i);
                                    } 
                                    $('cantidad_' + nroReceta+'_'+numeroProducto).value=30;
                                    $('dosis_' + nroReceta+'_'+numeroProducto).value=codigoProducto;
                                    
                                    preguardarRectaMedica(nroReceta, numeroProducto)
                                }
                            })  
                        } else {
                            if (!($('hAgregados_' + nroReceta).value.indexOf(codigoProducto) != -1)) {
                                nroReceta = $('nroReceta').value;
                                elemento1 = document.getElementById('divReceta_' + nroReceta);
                                 
                                if (elemento1 == null) {//verificamos si existe un div para la receta
                                    divAumentar = 'divRecetaGeneral'
                                    existe = 0;
                                    numeroRecetas = $('hcantidadRecetas').value;
                                    numeroRecetas++;
                                    $('hcantidadRecetas').value = numeroRecetas;
                                }
                                else {
                                    divAumentar = 'divReceta_' + nroReceta;
                                    existe = 1;
                                    numeroProducto = $('hNumeroProductos_' + nroReceta).value;
                                    numeroProducto++;
                                    $('hNumeroProductos_' + nroReceta).value = numeroProducto;
                                //                                   alert('si existe');
                                }
                                nombreMedicamento = nombreTratamiento;
                                presentacion = vDescripcionReceta;
 
                                var patronModulo = 'agregarMedicamentoHC';
                                var parametros = '';
                                parametros += 'p1=' + patronModulo;
                                parametros += '&p2=' + existe;
                                parametros += '&p3=' + nroReceta;
                                parametros += '&p4=' + Base64.encode(nombreMedicamento);
                                parametros += '&p5=' + codigoProducto;
                                parametros += '&p6=' + presentacion;
                                parametros += '&p7=' + numeroProducto;

                                contadorCargador++;
                                var idCargador = contadorCargador;
                                new Ajax.Request(pathRequestControl, {
                                    method: 'get',
                                    asynchronous: false,
                                    parameters: parametros,
                                    onLoading: cargadorpeche(1, idCargador),
                                    onComplete: function(transport) {
                                        cargadorpeche(0, idCargador);
                                        var respuesta = transport.responseText;
                                        var para = document.getElementById(divAumentar);
                                        var s = respuesta;
                                        var range = document.createRange();
                                        range.selectNode(document.body);
                                        var documentFragment = range.createContextualFragment(s);
                                        para.appendChild(documentFragment);
                                        //                                        alert(codigoProducto);
                                        $('hAgregados_' + nroReceta).value = $('hAgregados_' + nroReceta).value + '|' + codigoProducto;
                                        //                                        alert($('hAgregados_' + nroReceta).value);
                                        tablaTablaPAquete.deleteRow(i); 
                                        $('cantidad_' + nroReceta+'_'+numeroProducto).value=30;
                                        $('dosis_' + nroReceta+'_'+numeroProducto).value=vIndicaciones;
                                        
                                        preguardarRectaMedica(nroReceta, numeroProducto)             
                                    }
                                })        
                                                                                                                                    
                            }else {
                                //                                alert("repetido");
                                tablaTablaPAquete.deleteRow(i);  
                            }                  
                        }
                    }                    
                }
            }
        }
    }

    var m = myvariosServicios.length;
    if(m>0){
        var h = 0;
        //    for(var h=0;h<m;h++){    
        var arrayPalabrasServcios = new Array();
        arrayPalabrasServcios = myvariosServicios[h].split("*");
        nroAte = arrayPalabrasServcios[0];
        iGrupoEtario = arrayPalabrasServcios[1];
        var p = arrayPalabrasServcios[2];
        ctp = arrayPalabrasServcios[3];
        iIdServicioGrupoEtareoPersona = arrayPalabrasServcios[4];
        descripcionpracticamedica = arrayPalabrasServcios[5];
        NombreGrupo = arrayPalabrasServcios[6];
        var k1 = arrayPalabrasServcios[7];
        //        alert(nroAte+'---'+iGrupoEtario+'---'+p+'---'+ctp+'---'+iIdServicioGrupoEtareoPersona)
        var posFuncion ="cargarServiciosDuplicados("+nroAte+","+iGrupoEtario+","+p+","+cantidad+","+ iIdServicioGrupoEtareoPersona+","+ ctp+","+k1+","+m+","+h+")";
        var vtitle='<b>'+NombreGrupo+'<br>'+descripcionpracticamedica +' '+nroAte+'<br> </b><input id="txtNombreCpt" value="'+descripcionpracticamedica+'" > ';
        var vformname='vpopudServico'+nroAte+iIdServicioGrupoEtareoPersona;
        var vwidth='816';
        var vheight='280';
        var patronModulo1='popapserviciosDuplicados';
        var vcenter='t';
        var vresizable='';
        var vmodal='false';
        var vstyle='';
        var vopacity='';
        var veffect='';
        var vposx1='';
        var vposx2='';
        var vposy1='';
        var vposy2=''; 
        var parametros1='';
        parametros1+='p1='+patronModulo1 +'&p2='+ ctp+'&p3='+ nroAte+'&p4='+ iIdServicioGrupoEtareoPersona;
        CargarVentanaPopPapJorge(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros1, posFuncion);

    }
}
function cargarServiciosDuplicados(nroAte, iGrupoEtario, i, iCantidad, iIdServicioGrupoEtareoPersona, ctp, k, m, h) {
    m = myvariosServicios.length;

    var NombreGrupo = $('NombreGrupoEtareo' + k).value;
    var codigoCTP = ctp;
    var patronModulo = 'cargarServiciosDuplicados';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoCTP;
    parametros += '&p3=' + nroAte;
    parametros += '&p4=' + iGrupoEtario;
    servicioGrupoEtareoPersona = iIdServicioGrupoEtareoPersona;

    var tablaTablaPAqueteExtra = new dhtmlXGridObject('divTablaCTPExtra' + nroAte + iIdServicioGrupoEtareoPersona);
    tablaTablaPAqueteExtra.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaTablaPAqueteExtra.setSkin("dhx_skyblue");
    tablaTablaPAqueteExtra.enableRowsHover(true, 'grid_hover');
    tablaTablaPAqueteExtra.attachEvent("onRowSelect", function(fila, columna) {
        //        actualizarEntregaExtra(fila,columna,nroAte,iCantidad,iIdServicioGrupoEtareoPersona,tablaTablaPAqueteExtra,NombreGrupo);
        if(m==1){
            actualizarEntregaExtra(fila,columna,nroAte,iCantidad,iIdServicioGrupoEtareoPersona,tablaTablaPAqueteExtra,NombreGrupo); 
        //Windows.close("Div_vpopudServico" + nroAte + iIdServicioGrupoEtareoPersona); 
        } else{
            if(m>1 && h< (m-1)){
                var v=actualizarEntregaExtra(fila,columna,nroAte,iCantidad,iIdServicioGrupoEtareoPersona,tablaTablaPAqueteExtra,NombreGrupo); 
                //                alert("valor:  "+ v);
                if(v!=1){
                    h=h+1;
                    siguientePupapServicios(fila,columna,h,k,i,iCantidad); 
                }
            } else{
                if(h==(m-1)){
                    actualizarEntregaExtra(fila,columna,nroAte,iCantidad,iIdServicioGrupoEtareoPersona,tablaTablaPAqueteExtra,NombreGrupo);  
                //                    Windows.close("Div_vpopudServico" + nroAte + iIdServicioGrupoEtareoPersona); 
                }
            }
        }
    });
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaTablaPAqueteExtra.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    tablaTablaPAqueteExtra.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);

    });
    /////////////fin cargador ///////////////////////
    tablaTablaPAqueteExtra.setSkin("dhx_skyblue");
    tablaTablaPAqueteExtra.init();
    //    tablaBuscarPersona.loadXML(pathRequestControl+'?'+parametros);
    tablaTablaPAqueteExtra.loadXML(pathRequestControl+'?'+parametros, function(){   
        $("Div_vpopudServico"+nroAte+iIdServicioGrupoEtareoPersona+"_close").hide();       
    });
    tablaTablaPAqueteExtra.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){
        });
}
/// tengo que modificar y cambiar de nombre a esta funciones

function siguientePupapServicios(fila, columna, h, k, i, iCantidad) {
    var m = myvariosServicios.length;
    //    for(var h=0;h<m;h++){ 

    var arrayPalabrasServcios = new Array();
    arrayPalabrasServcios = myvariosServicios[h].split("*");
    var nroAte = arrayPalabrasServcios[0];
    var iGrupoEtario = arrayPalabrasServcios[1];
    var p = arrayPalabrasServcios[2];
    var ctp = arrayPalabrasServcios[3];
    var iIdServicioGrupoEtareoPersona = arrayPalabrasServcios[4];
    var descripcionpracticamedica = arrayPalabrasServcios[5];
    NombreGrupo = arrayPalabrasServcios[6];
    var k1 = arrayPalabrasServcios[7];
    //        alert(nroAte+'---'+iGrupoEtario+'---'+p+'---'+ctp+'---'+iIdServicioGrupoEtareoPersona)
    var posFuncion ="cargarServiciosDuplicados("+nroAte+","+iGrupoEtario+","+p+","+iCantidad+","+ iIdServicioGrupoEtareoPersona+","+ ctp+","+k1+","+m+","+h+")";
    var vtitle=NombreGrupo+'<br>'+descripcionpracticamedica +' '+nroAte+'<br><input id="txtNombreCpt" value="'+descripcionpracticamedica+'" > ';
    var vformname='vpopudServico'+nroAte+iIdServicioGrupoEtareoPersona;
    var vwidth='816';
    var vheight='280';
    var patronModulo1='popapserviciosDuplicados';
    var vcenter='t';
    var vresizable='';
    var vmodal='false';
    var vstyle='';
    var vopacity='';
    var veffect='';
    var vposx1='';
    var vposx2='';
    var vposy1='';
    var vposy2=''; 
    var parametros1='';
    parametros1+='p1='+patronModulo1 +'&p2='+ ctp+'&p3='+ nroAte+'&p4='+ iIdServicioGrupoEtareoPersona;
    CargarVentanaPopPapJorge(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros1, posFuncion);         
}

function actualizarEntregaExtra(fila, columna, nroAte, iCantidad, iIdServicioGrupoEtareoPersona, tablaTablaPAqueteExtram, NombreGrupo) {
    codigos = document.getElementById("htxtcodigosServicios").value;
    if (!((codigos.indexOf(codigopracticamedica + "|") != -1) || (codigos.indexOf(codigopracticamedica) != -1))) {
        var estado = 1;
        //    alert(tablaTablaPAqueteExtra);
        if (confirm("Esta Seguro que Desea Registrar el producto")) {
            var codigopracticamedica = tablaTablaPAqueteExtram.cells(fila, 9).getValue();
            var codigosegus = tablaTablaPAqueteExtram.cells(fila, 7).getValue();
            //var descripcionpracticamedica = tablaTablaPAqueteExtram.cells(fila, 8).getValue();
            var descripcionpracticamedica=$('txtNombreCpt').value;
            var ctp = tablaTablaPAqueteExtram.cells(fila, 2).getValue();

            var valorServicio = Base64.encode(NombreGrupo + '  ' + descripcionpracticamedica);
            //            alert(descripcionpracticamedica);

            var nombre = Base64.encode(tablaTablaPAqueteExtram.cells(fila, 8).getValue());
            if (codigos.length > 0) {
                codigos = codigos + "|" + codigopracticamedica;
            } else {
                codigos = codigopracticamedica;
            }
            document.getElementById("htxtcodigosServicios").value = codigos;

            numerodivpracticamedica = contadorDivsPracticaMedica;
            //var numerodivpracticamedica='';
            var idtratamiento = '';
            var modoaplicacion = '';
            var estadoregistro = '';

            var patronModulo = 'agregarPracticaMedicaHC';
            var parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + nombre;
            parametros += '&p3=' + numerodivpracticamedica;
            parametros += '&p4=' + codigopracticamedica;
            parametros += '&p5=' + idtratamiento;
            parametros += '&p6=' + modoaplicacion;
            parametros += '&p7=' + estadoregistro;
            parametros += '&p8=' + codigosegus;
            parametros += '&p9=' + estado;
            parametros += '&p10=' + valorServicio;// ya
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
                    nombrediv = "Div_PracticaMedica" + numerodivpracticamedica;
                    creaPracticaMedica(nombrediv);
                    $(nombrediv).innerHTML = respuesta;
                    contadorDivsPracticaMedica++;
                    $('hNumeroTratamientoPracticasMedicas').value = parseInt($('hNumeroTratamientoPracticasMedicas').value) + 1;
                    preguardarTratatamientoPracticasMedicas(estado);
                    actualizarEstadoDeServicioGrupoEtarioPersona(iIdServicioGrupoEtareoPersona, iCantidad);
                    //                    alert(iIdServicioGrupoEtareoPersona);
                    Windows.close("Div_vpopudServico" + nroAte + iIdServicioGrupoEtareoPersona)
                }
            })
        // return 0;
        }else{
            return 1;
        }
    }
}
function actualizarEstadoDeServicioGrupoEtarioPersona(iIdServicioGrupoEtareoPersona, iCantidad) {

    var patronModulo = 'actualizarEstadoDeServicioGrupoEtarioPersona';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iIdServicioGrupoEtareoPersona;
    parametros += '&p3=' + iCantidad;

    contadorCargador++;

    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        asynchronous: false,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;

        }
    })
}





function validarSeleccion(idObjet) {
    var patronModulo = 'validarSeleccion';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + numeroAntecedenteOdontograma;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'post',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;


        }
    })
}



function quitarImagen(id) {
    if (confirm("Esta seguro que desea borrar la imagen?\n NOTA: Recuerde que se eliminara  y no podra resturarlo de nuevo...!")) {

        var ruta = $('url' + id).value;
        var patronModulo = 'quitarImagen';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + ruta;
        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'post',
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function(transport) {
                cargadorpeche(0, idCargador);
                $('Vista' + id).update("");
                alert("La Imagen se borro Correctamente");
                $('adjuntarFotoOdontograma' + id).show();
                $('button' + id).show();

            }
        })
    }
    else {

    }
}

function updateObsHistoriaDiente(IdNumeric) {
    var idHistoriaDiente = $('idAntecedenteOdontograma_' + IdNumeric).value;
    var observaciones = $('observaciones_' + IdNumeric).value;
    var patronModulo = 'updateObsHistoriaDiente';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + observaciones;
    parametros += '&p3=' + idHistoriaDiente;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'post',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);


        }
    })
}





function updateCarasDiente(id, idCara, objeto) {


    var bit = 0
    var idHistoriaDiente = $('idAntecedenteOdontograma_' + id).value;
    if ($(objeto + id).checked == true) {
        bit = 1;
    }
    var patronModulo = 'updateCarasDiente';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + idHistoriaDiente;
    parametros += '&p3=' + idCara;
    parametros += '&p4=' + bit;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'post',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);


        }
    })

}




function cerrarAntecedenteOdontograma(numeroAntecedente) {
    var idHistoriaDiente = $('idAntecedenteOdontograma_' + numeroAntecedente).value;
    var patronModulo = 'cerrarAntecedenteOdontograma';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + idHistoriaDiente;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'post',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            $('antecedenteOdontograma_' + numeroAntecedente).hide();
            $('estadoAntecedenteOdontograma_' + numeroAntecedente).value = 1;

        }
    })
}


function volverAcargar(idAuto) {
    var idHistoriaDiente = $('idAntecedenteOdontograma_' + idAuto).value;
    var patronModulo = 'cambiaraEstadoImagenesVersionesAnteriores';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + idHistoriaDiente;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'post',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            $('adjuntarFotoOdontograma' + idAuto).show();
            $('button' + idAuto).style.visibility = "visible";
            $('Vista' + idAuto).update("");

        }
    })

}

function abrirNuevoVisorImagen(autonumerico) {
    var url = $('url' + autonumerico).value;
    var rotacion = $('rotacion' + autonumerico).value;
    var patronModulo = 'abrirNuevoVisorImagen';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + url;
    parametros += '&p3=' + url;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'post',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);


        }
    })
}
function cargarFechaAtencionOdontograma() {
    var cadena = $('comboFechaAtenciones').value;
    $('comboDientesAtenciones').value = "x";
    $('dienteSeleccionado').value = "x";
    var n = cadena.split("//");
    $('programacionSeleccionado').value = n[0];
    var palabra;
    if (n[0] == "x") {
        palabra = '';
    }
    else {
        palabra = n[1]
    }
    var arrayPalabras = new Array();
    arrayPalabras = palabra.split(" ");
    var numeroPalabras = arrayPalabras.length;
    $("hCodProgramacionHistoria").value = palabra;
    historiaLeyenda()
    rHistoriaOdontogramaXAtencion.filterBy(7, palabra);
    seleccionarPrimeraFila();
    cambiarProgramacionDiente();
}

function cargarIdDienteOdontograma() {

    var cadena = $('comboDientesAtenciones').value
    var combo = $('comboDientesAtenciones');
    var valor = combo.options[combo.selectedIndex].text;
    $('comboFechaAtenciones').value = 'x';
    $('dienteSeleccionado').value = cadena;
    var palabra;
    if (cadena == "x") {
        palabra = '';
    }
    else {
        // alert(valor);
        var n = valor.split(" ");
        palabra = n[0];
    }
    var arrayPalabras = new Array();
    arrayPalabras = palabra.split(" ");
    var numeroPalabras = arrayPalabras.length;
    rHistoriaOdontogramaXAtencion.filterBy(8, palabra);
    seleccionarPrimeraFila();
}



function cargarTablaHistoriaOdontograma() {
    var codPersona = $('hidCodPersona').value;
    var patronModulo = 'listarHistoriaOdontogramaxPersona';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codPersona;
    contadorCargador++;
    var idCargador = contadorCargador;
    rHistoriaOdontogramaXAtencion = new dhtmlXGridObject('contenedorTablaHistoria');
    rHistoriaOdontogramaXAtencion.setImagePath("../../../../fastmedical_front/imagen/icono/");
    rHistoriaOdontogramaXAtencion.attachEvent("onRowSelect", function(fila, columna) {
        var fecha = rHistoriaOdontogramaXAtencion.cells(fila, 0).getValue();
        var diagnostico = rHistoriaOdontogramaXAtencion.cells(fila, 1).getValue();
        var diente = rHistoriaOdontogramaXAtencion.cells(fila, 2).getValue();
        var tecero = rHistoriaOdontogramaXAtencion.cells(fila, 3).getValue();
        var estado = rHistoriaOdontogramaXAtencion.cells(fila, 4).getValue();
        var dosctor = rHistoriaOdontogramaXAtencion.cells(fila, 5).getValue();
        var imagen = rHistoriaOdontogramaXAtencion.cells(fila, 6).getValue();
        var descripcion = rHistoriaOdontogramaXAtencion.cells(fila, 9).getValue();
        var cara1 = rHistoriaOdontogramaXAtencion.cells(fila, 10).getValue();
        var cara2 = rHistoriaOdontogramaXAtencion.cells(fila, 11).getValue();
        var cara3 = rHistoriaOdontogramaXAtencion.cells(fila, 12).getValue();
        var cara4 = rHistoriaOdontogramaXAtencion.cells(fila, 13).getValue();
        var cara5 = rHistoriaOdontogramaXAtencion.cells(fila, 14).getValue();
        var cara6 = rHistoriaOdontogramaXAtencion.cells(fila, 15).getValue();
        cargarDetalleHIstoriaODontograma(fecha, diagnostico, tecero, estado, dosctor, imagen, descripcion, cara1, cara2, cara3, cara4, cara5, cara6, diente)

    });
    contadorCargador++;
    var idCargador = contadorCargador;
    rHistoriaOdontogramaXAtencion.attachEvent("onXLS", function() {
        cargadorpeche(1, idCargador);
    });
    rHistoriaOdontogramaXAtencion.attachEvent("onXLE", function() {
        cargadorpeche(0, idCargador);
    });
    rHistoriaOdontogramaXAtencion.setSkin("dhx_skyblue");
    rHistoriaOdontogramaXAtencion.init();
    rHistoriaOdontogramaXAtencion.loadXML(pathRequestControl + '?' + parametros, function() {
        seleccionarPrimeraFila();
    });

}


function cargarDetalleHIstoriaODontograma(fecha, diagnostico, tecero, estado, doctor, imagen, descripcion, cara1, cara2, cara3, cara4, cara5, cara6, diente) {
    $('fechaHistoriaDetalle').value = fecha;
    $('diagnosticoHistoriaDetalle').value = diagnostico;
    $('teceroHistoriaDetalle').value = tecero;
    $('estadoHistoriaDetalle').value = estado;
    $('doctorHistoriaDetalle').value = doctor;
    $('obsHistoriaDetalle').value = descripcion;
    $('DienteHistoriaDetalle').value = diente;
    $('carasHistoriaDiente').value = cara1 + ' ' + cara2 + ' ' + cara3 + ' ' + cara4 + ' ' + cara5 + ' ' + cara6;
    if (imagen != 'vacio') {
        var n = imagen.split("/");
        $('imagenHistoriaDetalle').update("<p>Imagen: <a href='../../../hospitalizacion/visorImagen/visor.php?url=../../carpetaDocumentos/" + n[5] + " &rotacion=rot0' target='_blank'>Ver Imagen.</a>");
    } else {
        $('imagenHistoriaDetalle').update('');
    }
//cargarDetalleHIstoriaODontograma(fecha,diagnostico,tecero,estado,doctor,imagen);
}


function cambiarSelectedValueCombo() {
    var comodin = 0;
    var valor = $('dienteSeleccionado').value;
    var contador = $('comboDientesAtenciones').options.length;
    for (x = 0; x <= contador - 1; x++) {
        if ($('comboDientesAtenciones').options[x].value == valor) {
            $('comboDientesAtenciones').value = $('dienteSeleccionado').value;
            x = contador - 1;
            cargarIdDienteOdontograma();
            comodin = 1;
        }
        else {
            comodin = 0;
        }
    }
    if (comodin == 0) {
        if ($('comboDientesAtenciones').value == "x") {
            alert("No existe antecedente o procedimeito para este diente todas la atenciones del paciente");
        } else {
            alert("No existe antecedente o procedimeito para este diente la fecha seleccionada");
        }

    //cargarFechaAtencionOdontograma();
    }
}


function seleccionarPrimeraFila() {
    var contador = rHistoriaOdontogramaXAtencion.getRowsNum()
    // alert(contador);
    if (contador >= 1) {
        rHistoriaOdontogramaXAtencion.selectRow(0, true, true, true);
    }

}


//----------------------------------LEYENDA-------------------------------------

function mostrarLeyenda() {
    var codProgramacion = $("hcodigoProgramacion").value;
    var icolor = $("hicolor").value;
    var bcolor = $("hbcolor").value;
    var dientes = $("hdientes").value;
    var patronModulo = 'mostrarLeyenda';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codProgramacion;
    parametros += '&p3=' + bcolor;
    parametros += '&p4=' + icolor;
    parametros += '&p5=' + dientes;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Div_Leyenda').update(respuesta);
        // alert (respuesta);
        }
    })
}



function cargarImagenesLeyenda(colorsimbolo, estado, dientAfectados) {
    var icolor = colorsimbolo;
    var bcolor = estado;
    var dientes = dientAfectados;

    $("hicolor").value = icolor;
    $("hbcolor").value = bcolor;
    $("hdientes").value = dientes;
}

function historiaLeyenda() {
    var CodProgramacionHistoria = $("hCodProgramacionHistoria").value;
    var CodPersona = $("hidCodPersona").value;
    var patronModulo = 'historiaLeyenda';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + CodPersona;
    parametros += '&p3=' + CodProgramacionHistoria;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Div_HistoriaLeyenda').update(respuesta);
        // alert (respuesta);
        }
    })
}

// =============================================================


function cargarMantenimientoAfiliacionesModulo(id, nombre) {
    var patronModulo = 'cargarMantenimientoAfiliacionesModulo  ';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + id;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('contenidoMantenimiento').update(respuesta);
            $('idAfiliacion').value = id;
            $('nombreAfiliacion').update(nombre);
        }
    })
}


function guardarModulosAfiliacion() {
    var contadorCombo2 = $('lst_seleccionadas').length;
    var arrayCombo2 = "";
    var arrayNum2 = "";
    for (var y = 0; y <= contadorCombo2 - 1; y++) {
        if (y == 0) {
            arrayCombo2 = $('lst_seleccionadas')[y].value + "|";
            arrayNum2 += (y + 1) + "|";
        }
        else if (y < contadorCombo2 - 1) {
            arrayCombo2 += $('lst_seleccionadas')[y].value + "|";
            arrayNum2 += (y + 1) + "|";
        }
        else if (y == contadorCombo2 - 1) {
            arrayCombo2 += $('lst_seleccionadas')[y].value;
            arrayNum2 += (y + 1);
        }
    }
    if (contadorCombo2 == 0) {
        var IdSer = $("idAfiliacion").value;
        var patronModulo = 'eliminarAnterioresSeleccionadosAfiliaciones';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + IdSer;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                var respuesta = transport.responseText;
                alert("Se guardo exitosamente...");
            }
        })
    }
    else if (contadorCombo2 > 0) {
        var IdSer = $("idAfiliacion").value;
        var patronModulo = 'eliminarAnterioresSeleccionadosAfiliaciones';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + IdSer;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function(transport) {
                micargador(0);
                var respuesta = transport.responseText;
                guardarNuevaSeleccionAfiliaciones(arrayCombo2, arrayNum2);
            }
        })
    }

}

function guardarNuevaSeleccionAfiliaciones(arrayCombo2, arrayNum2) {
    var IdSer = $("idAfiliacion").value;
    var patronModulo = 'guardarNuevaSeleccionAfiliaciones';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + arrayCombo2;
    parametros += '&p3=' + IdSer;
    parametros += '&p4=' + arrayNum2;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            var respuesta = transport.responseText;
            alert("Se guardo exitosamente...");
        //cargarMantenimientoServicios();
        }
    })

}


function verListaDeCiePorGrupoEtareo(idGrupoEtareo, nombre) {
    $('nombreGrupoEtareo').value = nombre;
    $('idGrupoEtareo').value = idGrupoEtareo;
    var patronModulo = 'verListaDeCiePorGrupoEtareo';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + idGrupoEtareo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function(transport) {
            micargador(0);
            var respuesta = transport.responseText;
            $('tablaCIeGRupoEtareo').update(respuesta);
        }
    })
}

function buscarCie(event) {
    var cie = $('busquedaCie').value;
    var tecla = event.keyCode
    if (tecla == 13 || cie.length > 4) {
        var patronModulo = 'buscarCieListado';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + cie;
        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function(transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                $('DivCIe').update(respuesta);
            }
        })
    }
}


function agregarCIEaGrupoEtareo(idCie) {
    if ($('idGrupoEtareo').value != '') {
        var idGrupoEtareo = $('idGrupoEtareo').value;
        var patronModulo = 'agregarCIEaGrupoEtareo';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + idCie;
        parametros += '&p3=' + idGrupoEtareo;
        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function(transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                alert(respuesta);
                var nombre = $('nombreGrupoEtareo').value;
                verListaDeCiePorGrupoEtareo(idGrupoEtareo, nombre);
            }
        })
    }
    else {
        alert("Debe visualizar el detalle de algun Grupo Etareo...");
    }

}

function cambiarEstadoCieGrupoEtareo(idCie) {
    if ($('idGrupoEtareo').value != '') {
        var idGrupoEtareo = $('idGrupoEtareo').value;
        var patronModulo = 'cambiarEstadoCieGrupoEtareo';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + idCie;
        parametros += '&p3=' + idGrupoEtareo;
        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function(transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                alert('Se finalizo el cambio de Estado Correctamente...');
                verListaDeCiePorGrupoEtareo(idGrupoEtareo);
            }
        })
    }
    else {
        alert("Error en procedimientos de Mantenimiento Seleccione un Grupo Etareo Para continuar.")
    }
}




function cambiarEstadoServicioRelacionado(iIdRelacion,estado) {
    var bEstado = 0;
    if (estado==1){
        bEstado = 0;
    }
    else if (estado ==0){
        bEstado=1;
    }
    if(confirm("Seguro que desea Cambiar de Estado)")){
        var patronModulo = 'cambiarEstadoServicioRelacionado';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + iIdRelacion;
        parametros += '&p3=' + bEstado;
        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function(transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                alert('Se finalizo el cambio de Estado Correctamente...');
                examenesRelacionados();
            }
        })
    }
}



function cargarVistaPopudResporteHistorialTriaje(iNumeroReporete,vReporte){
    var iCodigoPaciente = $('htxtcodigopaciente').value;
    var dFechaNacimiento = $('txtFechaNacimientoTriaje').value;
    posFuncion ="cargarGraficoHistoriaTriaje("+iNumeroReporete+",'"+vReporte+"')";
    // posFuncion="";
    vtitle="Reporte Historico Triaje -  "+ vReporte;
    vformname='vReporteHistoricoTriajePaciente';
    vwidth='1000';
    vheight='600';
    patronModulo='vReporteHistoricoTriajePaciente';
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
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+iNumeroReporete;
    parametros+='&p3='+vReporte;
    parametros+='&p4='+iCodigoPaciente;
    parametros+='&p5='+dFechaNacimiento;
    CargarVentanaPopPapJorge(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function cargarGraficoHistoriaTriajeDestrucTor(iNumeroReporete,vReporte){ 
    chart.destructor();
    var iCodigoPaciente = $('htxtcodigopaciente').value;
    var patronModulo = 'cargarGraficoHistoriaTriaje';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iCodigoPaciente;
    parametros += '&p3=' + iNumeroReporete;
    parametros += '&p4=' + vReporte;
    parametros += '&p5=' + $('cbxDesde').value;
    parametros += '&p6=' +  $('cbxHasta').value;
    
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            eval(respuesta);
        //cargarTablaLeyendaTriaje(iNumeroReporete,iCodigoPaciente);
        }
    })
}

function cargarGraficoHistoriaTriaje(iNumeroReporete,vReporte){ 
    var iCodigoPaciente = $('htxtcodigopaciente').value;
    var patronModulo = 'cargarGraficoHistoriaTriaje';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iCodigoPaciente;
    parametros += '&p3=' + iNumeroReporete;
    parametros += '&p4=' + vReporte;
    parametros += '&p5=' + $('cbxDesde').value;
    parametros += '&p6=' +  $('cbxHasta').value;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            eval(respuesta);
        //cargarTablaLeyendaTriaje(iNumeroReporete,iCodigoPaciente);
        }
    })
}

function cargarTablaLeyendaTriaje(iNumeroReporete,iCodigoPaciente){
    var patronModulo='listarTablaLeyendaReporteTriaje';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+iNumeroReporete;
    parametros+='&p3='+iCodigoPaciente;
    listarTablaLeyendaReporteTriaje=new dhtmlXGridObject('contenedorTablaLeyenda');
    listarTablaLeyendaReporteTriaje.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    listarTablaLeyendaReporteTriaje.setSkin("dhx_terrace");
    listarTablaLeyendaReporteTriaje.enableRowsHover(true,'grid_hover');
    listarTablaLeyendaReporteTriaje.attachEvent("onRowSelect", function(rId,cInd){ 

        });  
    contadorCargador++;
    var idCargador=contadorCargador;
    listarTablaLeyendaReporteTriaje.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    listarTablaLeyendaReporteTriaje.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);;
    });
    listarTablaLeyendaReporteTriaje.setSkin("dhx_terrace");
    listarTablaLeyendaReporteTriaje.init();
    listarTablaLeyendaReporteTriaje.loadXML(pathRequestControl+'?'+parametros,function(){
        var casa;
        for(i=0;i<listarTablaLeyendaReporteTriaje.getRowsNum();i++){
            casa = listarTablaLeyendaReporteTriaje.cells(i,2).getValue();
            if(casa=='1')
                listarTablaLeyendaReporteTriaje.setRowTextStyle(listarTablaLeyendaReporteTriaje.getRowId(i) ,'background-color:#69C22C;color:black;border-top: 0px solid #FAFAF8;');
            else if(casa=='2')
                listarTablaLeyendaReporteTriaje.setRowTextStyle(listarTablaLeyendaReporteTriaje.getRowId(i) ,'background-color:#F98C33;color:black;border-top: 0px solid #FAFAF8;');
        }
    }); 
}

function generarComboHasta(iHasta,iNumeroReporte,vReporte){
    var iDesde = $('cbxDesde').value;
    var patronModulo = 'generarComboHastaMenorseis';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iDesde;
    parametros += '&p3=' + iHasta;
    parametros += '&p4=' + iNumeroReporte;
    parametros += '&p5=' + vReporte;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('contenedorComboHasta').update(respuesta);
        }
    })
}


function generarComboHasta2(iHasta,iNumeroReporte,vReporte){
    var iDesde =  document.getElementById('cbxDesde').options[document.getElementById('cbxDesde').selectedIndex].text;
    var patronModulo = 'generarComboHastaMayoresseis';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iDesde;
    parametros += '&p3=' + iHasta;
    parametros += '&p4=' + iNumeroReporte;
    parametros += '&p5=' + vReporte;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('contenedorComboHasta').update(respuesta);
        }
    })
}


function insertaActualizaSintomatico(){
    var numeroksekedo;
    var  splitiando;
    var angelsayes
    if($('cbxSintomatico').value==0){
        $('div_nroDiasSintomatico').hide();
        $('div_btnGenerarOrdenDK').hide();
        try
        {
            if ($('txtNumeroBK').value!=''){
                numeroksekedo=$('txtNumeroBK').value; 
                splitiando = numeroksekedo.split("|");
                for(angelsayes=0;angelsayes<=splitiando.length-2;angelsayes++){
                    eliminarPracticaMedicaHC('Div_PracticaMedica'+splitiando[angelsayes],'XXXX200301',splitiando[angelsayes]);
                    $('div_btnGenerarOrdenDK').removeClassName('btnReportes1');
                    if (angelsayes==0){
                        $('div_btnGenerarOrdenDK').update('Generar 1 Orden BK');
                    }else{
                        $('div_btnGenerarOrdenDK').update('Generar 2 Ordenes BK');
                    }
                    
                }              
            }
        }
        catch(err)
        {
            $('txtNumeroBK').value='';
            $('contadorBK').value='';
        }
        $('txtNumeroDiasSintomatico').value=0
    }else{
        try
        {
            if ($('txtNumeroBK').value!=''){
                numeroksekedo=$('txtNumeroBK').value; 
                splitiando = numeroksekedo.split("|");
                for(angelsayes=0;angelsayes<=splitiando.length-2;angelsayes++){
                    eliminarPracticaMedicaHC('Div_PracticaMedica'+splitiando[angelsayes],'XXXX200301',splitiando[angelsayes]);
                    $('div_btnGenerarOrdenDK').removeClassName('btnReportes1');
                    if (angelsayes==0){
                        $('div_btnGenerarOrdenDK').update('Generar 1 Orden BK');
                    }else{
                        $('div_btnGenerarOrdenDK').update('Generar 2 Ordenes BK');
                    }
                }              
            }
        }
        catch(err)
        {
            $('txtNumeroBK').value='';
            $('contadorBK').value='';
        }
        $('div_nroDiasSintomatico').show();
        $('div_btnGenerarOrdenDK').hide();
        $('txtNumeroDiasSintomatico').value=0
    }
    var patronModulo = 'insertaActualizaSintomatico';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + $('cbxSintomatico').value;
    parametros += '&p3=' + $('txtNumeroDiasSintomatico').value;
    parametros += '&p4=' + $('hcodigoProgramacion').value;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('contenedorComboHasta').update(respuesta);
        }
    })
}

function validarNumeroDias(){
    var numeroksekedo;
    var  splitiando;
    var angelsayes
    if(isNaN($('txtNumeroDiasSintomatico').value)!=false){
        try
        {
            if ($('txtNumeroBK').value!=''){
                numeroksekedo=$('txtNumeroBK').value; 
                splitiando = numeroksekedo.split("|");
                for(angelsayes=0;angelsayes<=splitiando.length-2;angelsayes++){
                    eliminarPracticaMedicaHC('Div_PracticaMedica'+splitiando[angelsayes],'XXXX200301',splitiando[angelsayes]);
                    $('div_btnGenerarOrdenDK').removeClassName('btnReportes1');
                    if (angelsayes==0){
                        $('div_btnGenerarOrdenDK').update('Generar 1 Orden BK');
                    }else{
                        $('div_btnGenerarOrdenDK').update('Generar 2 Ordenes BK');
                    }
                }  
            }
        }
        catch(err)
        {
            $('txtNumeroBK').value='';
            $('contadorBK').value='';
        }
        
        $('txtNumeroDiasSintomatico').value=0;
    }
    else{
        if($('txtNumeroDiasSintomatico').value>=15){
            $('div_btnGenerarOrdenDK').show();
        }else{
            $('div_btnGenerarOrdenDK').hide();
            try
            {
                if ($('txtNumeroBK').value!=''){
                    numeroksekedo=$('txtNumeroBK').value; 
                    splitiando = numeroksekedo.split("|");
                    for(angelsayes=0;angelsayes<=splitiando.length-2;angelsayes++){
                        eliminarPracticaMedicaHC('Div_PracticaMedica'+splitiando[angelsayes],'XXXX200301',splitiando[angelsayes]);
                        $('div_btnGenerarOrdenDK').removeClassName('btnReportes1');
                        if (angelsayes==0){
                            $('div_btnGenerarOrdenDK').update('Generar 1 Orden BK');
                        }else{
                            $('div_btnGenerarOrdenDK').update('Generar 2 Ordenes BK');
                        }
                    }  
                }
            }
            catch(err)
            {
                $('txtNumeroBK').value='';
                $('contadorBK').value='';
            }
        }
    }
}

function actualizarNumeroDiasSintomatico(){
    var patronModulo = 'actualizarNumeroDiasSintomatico';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + $('cbxSintomatico').value;
    parametros += '&p3=' + $('txtNumeroDiasSintomatico').value;
    parametros += '&p4=' + $('hcodigoProgramacion').value;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('contenedorComboHasta').update(respuesta);
        }
    })
}


function generarSintomaticoRespiratorio(){
    var patronModulo1 = 'generarSintomaticoRespiratorio';
    var parametros1 = '';
    parametros1 += 'p1=' + patronModulo1;
    parametros1 += '&p2=' + $('cbxSintomatico').value;
    parametros1 += '&p3=' + $('txtNumeroDiasSintomatico').value;
    parametros1 += '&p4=' + $('hcodigoProgramacion').value;
    contadorCargador++;
    var idCargador1 = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: true,
        parameters: parametros1,
        onLoading: cargadorpeche(1, idCargador1),
        onComplete: function(transport) {
            cargadorpeche(0, idCargador1);
            var respuesta1 = transport.responseText;
            var codificar=Base64.encode(respuesta1);
            var angel;
            for(angel=0;angel<=1;angel++){
                numerodivpracticamedica = contadorDivsPracticaMedica;
                codigopracticamedica = 'XXXX200301';
                nombre = 'KE1JQ1JPQklPTE9HSUEpQksgRElSRUNUTyAoMyBNVUVTVFJBUyk=';
                idtratamiento = '';
                modoaplicacion = codificar;
                estadoregistro = '0';
                codigosegus = '330301';
                agregarBK();
            }
            $('div_btnGenerarOrdenDK').addClassName("btnReportes1");
            $('div_btnGenerarOrdenDK').update("2 Ordenes Generadas");
        }
    })
    
    
}

function agregarBK(){
    if ($('contadorBK').value<2){
        var patronModulo; 
        var parametros;
        var idCargador;

        codigos = document.getElementById("htxtcodigosServicios").value;

        if (codigos.length > 0) {
            codigos = codigos + "|" + codigopracticamedica;
        }
        else {
            codigos = codigopracticamedica;
        }
        document.getElementById("htxtcodigosServicios").value = codigos;
        estado1 = 0;
        patronModulo = 'agregarPracticaMedicaHC';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + nombre;
        parametros += '&p3=' + numerodivpracticamedica;
        parametros += '&p4=' + codigopracticamedica;
        parametros += '&p5=' + idtratamiento;
        parametros += '&p6=' + modoaplicacion;
        parametros += '&p7=' + estadoregistro;
        parametros += '&p8=' + codigosegus;
        parametros += '&p9=' + estado1;
 
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
                nombrediv = "Div_PracticaMedica" + numerodivpracticamedica;
                creaPracticaMedica(nombrediv);
                $(nombrediv).innerHTML = respuesta;
                contadorDivsPracticaMedica++;
                $('hNumeroTratamientoPracticasMedicas').value = parseInt($('hNumeroTratamientoPracticasMedicas').value) + 1;
                $('contadorBK').value++;
                $('txtNumeroBK').value=$('txtNumeroBK').value+numerodivpracticamedica+'|';
                preguardarTratatamientoPracticasMedicas();
            }
        })
    }
}



function actualizarTriajeActoMedico(){
    var codigoProgramacion = trimJunny($('hcodigoProgramacion').value);
    var datos = 'angelaugusto' + '|' + 'sayesmalpartida' + '|' + codigoProgramacion;

    datos = Base64.encode(datos);

    CargarVentana('popupRegistroTriaje', 'Triaje', '../cita/manteTriajeActoMedico.php?accion=insertar' + '&datos=' + datos, '300', '230', false, true, '', 1, '', 10, 10, 10, 10);
}

function manteTriajeActoMedico(accion, horaProgramacion, codCronograma) {
    var peso = trim($('txtPeso').value);
    var talla = trim($('txtTalla').value);
    var temp = trim($('txtTemp').value);
    var frecCardiaca = trim($('txtFrecCardiaca').value);
    var presArterial = trim($('txtPresArterial').value);
    var frecRespiratoria = trim($('txtFrecRespiratoria').value);
    var satOxigeno = trim($('txtSatOxigeno').value);
    var codigoProgramacion = trimJunny($('hcodigoProgramacion').value);

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
            onLoading: function(transport) {
                micargador(1);
            },
            onComplete: function(transport) {
                micargador(0);
                alert(transport.responseText);
                Windows.close("Div_popupRegistroTriaje");
                $('txttemperatura').value=$('txtTemp').value;
                $('txtfrecuenciacardiaca').value=$('txtFrecCardiaca').value;
                $('txtfrecuenciarespiratoria').value=$('txtFrecRespiratoria').value;
                $('txtpresionaarterial').value=$('txtPresArterial').value;
                $('txtsaturacionoxigeno').value=$('txtSatOxigeno').value;
                $('txtpeso').value= $('txtPeso').value;
                $('txttalla').value=$('txtTalla').value;       
                $('txtimc').value= precise_round(parseFloat(($('txtPeso').value/ Math.pow($('txtTalla').value,2))),2);
                
                
            }
        }
        )
    }
}