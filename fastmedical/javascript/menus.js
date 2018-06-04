/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var pathRequestControl = "../../ccontrol/control/control.php";
function servicioXCargo() {
    path = '../rrhh/vistaServicioCargos.php';

    parametros = '';
    new Ajax.Request(path, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            //funcion+="('"+parametro+"','','"+nro+"')";
            //eval(funcion);
            cargarArbolCentroCostos('serviciosCentroCostos');

        }
    });
}
function ocupacionesXCentroCosto() {
    path = '../rrhh/vistaOcupacionesCentroCostos.php';

    parametros = '';
    new Ajax.Request(path, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);

            cargarArbolCentroCostos('seleccionCentroCostos');

        }
    });
}

function programacionCitasInformes_Old() {
    var codigoCentroCosto = $('hCodigoCentroCosto').value;
    var patronModulo = 'programacionCitasInformes';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoCentroCosto;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
            onComplete: function (transport) {
                cargadorpeche(0, idCargador);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            recargarTablaServicios();
            var ancho = window.innerWidth;
            document.getElementById('programacioncitas').style.height = window.innerHeight - 400;

            document.getElementById('div_principal').style.height = window.innerHeight - 125;
            document.getElementById('divcronogramacitas').style.height = window.innerHeight - 130;

            document.getElementById('programacioncitas').style.width = window.innerWidth - 365;
        }
    });
}

function programacionCitasInformes() {
    var codigoCentroCosto = $('hCodigoCentroCosto').value;
    var ancho = window.innerWidth;
    var alto = window.innerHeight;
    document.getElementById('Contenido').style.height = 620;
    var patronModulo = 'programacionCitasInformesPeche';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoCentroCosto;
    parametros += '&p3=' + ancho;
    parametros += '&p4=' + alto;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            recargarTablaServicios();




        }
    })
}

function programacionMedicos() {
    //path='../cita/citas.php';
    patronModulo = 'programacionMedicos';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            recargarArbolServicios();
        }
    })
}

//function mostrarManuales(){
//    //path='../manuales/inicioManuales.php';
//    patronModulo='mostrarManuales';
//     parametros='';
//        parametros+='p1='+patronModulo;
//
//    new Ajax.Request(pathRequestControl,{
//        method : 'get',
//        parameters : parametros,
//        onLoading : micargador(1),
//        onComplete : function(transport){
//            micargador(0);
//            respuesta = transport.responseText;
//            $('Contenido').update(respuesta);
//            recargarArbolAyuda();
//        }
//    } )
//}
/*  --- new ---*/
function mostrarManuales() {
    patronModulo = 'mostrarManuales';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            //            recargarArbolAyuda();
            seleccionarArbolManual();
        }
    })
}

function registroDatosPacientes() {
    patronModulo = 'registroDatosPacientes';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            //            recargarArbolAyuda();


        }
    })
}

function consultaTarifas() {
    //comboAfiliaciones()
    comboCategorias()


}

function comboCategorias() {
    patronModulo = 'comboCategorias';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            //  mostrarTCategorias();
        }
    }
    )

}
function comboAfiliaciones() {
    patronModulo = 'comboAfiliaciones';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            //  mostrarTCategorias();
        }
    })
}

function generacionOrdenes() {
    var patronModulo = 'generacionOrdenes';
    var parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            /*
             //Esto es para agregar por mientras la apertura de documentos en caja
             codCaja = document.getElementById("hdnIdCaja").value;
             if (codCaja != "" && codCaja != "nada") {
             var numDocAperturadosHoy = document.getElementById("hdnNumDocAperturadosHoy").value;
             if (numDocAperturadosHoy == 0) {
             alert("Tiene que aperturar su caja");
             mostrarVentanaTesoreriaAperturaDeDocumentos();
             }
             //sino no muestro nada
             }
             */
            //sino no es cajero y no muestro nada
        }
    })
}



function registroDatosPersonal() {
    var patronModulo = 'registroDatosPersonal';
    var parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            //verEmpleadoCaducaSuContrato();
            cargaArbolAreaBusqueda();
            cargaArbolCCosto();


        }
    })
}

function actualizaCCosto() {
    patronModulo = 'actualizaCCosto';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            //actualizarArbolCCostos();
            seleccionarArbolCCostos();

        }
    })
}

function mantenimientoAmbientesLogicos() {
    //path='../cita/citas.php';
    var patronModulo = 'mantAmbientesLogicos';
    var parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            cargarArbolCentroCostos();
        }
    })
}

function mantenimientoAmbientesFisicos() {
    patronModulo = 'mantAmbientesFisicos';
    parametros = 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl,
            {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function (transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    $('Contenido').update(respuesta);
                }
            }
    )
}

function mantenimientoTurnos() {
    patronModulo = 'menuMantTurnos';
    parametros = 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl,
            {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function (transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    $('Contenido').update(respuesta);
                    cargarTablaTurno();
                }
            }
    )
}

function puestosCCostos() {
    patronModulo = 'puestosCCostos';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            //recargarArbolCCostosPuestos('verPuestosArbol');
            CargarArboldeCentroCostos();
            CargarlistadoPuestosXCentroCostos('');



        }
    })
}

function acreditaEssalud() {
    patronModulo = 'acreditaEssalud';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            //verificarConexionEssalud();

        }
    })
}

function puestosxServicios() {
    patronModulo = 'serviciosXpuestos';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            cargarArbolCentroCostosServiciosxPuestos();

        }
    })
}

function mantenimientoDocumento() {
    patronModulo = 'mantenimientoDocumento';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);

            //seleccionarArbolCCostos();

        }
    })
}

function mantenimientoPuestoDocumento() {
    patronModulo = 'mantenimientoPuestoDocumento';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            cargarArbolCCostoPtoDoc();
            //seleccionarArbolCCostos();

        }
    })
}

function mantenimientoEspecialidadProfesion() {
    patronModulo = 'mantenimientoEspecialidadProfesion';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);

        }
    })
}

function menuDatosUsuario() {
    //path='../cita/citas.php';
    patronModulo = 'codigoUsuario';
    parametros = '';
    parametros += 'p1=' + patronModulo;


    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            // $('Contenido').update(respuesta);
            //window.alert(respuesta);
            datosUsuario(respuesta);
            // registroDatosPersonalDetalle('','','0383490')
        }
    })
}

/*******************************ACTO MEDICO************************************/

function menuActoMedicoConsultorio() {
    //path='../cita/citas.php';
    patronModulo = 'actoMedicoConsultorio';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            // llenardatosPersonalesMedicoActoMedico('');

        }
    })
    mostrarprogramacionMedicosActoMedico();
//mostrarPacientesProgramados('');
// mostrarPacientesAdicionales('');
//calculaAtendidosyNoAtendidosDiarioActoMedico('');
//calculaAtendidosyNoAtendidosMensualActoMedico('');    
}


function llamadaPaciente() {
    patronModulo = 'llamadaPaciente';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            llamarCreacionMantPantallas();
        }
    })

}

/*********************************EXMEN FISICO*********************************/
function examenesFisicos() {
    //path='../cita/citas.php';
    patronModulo = 'examenesFisicos';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            arbolExamenFisico();
            //             listaServicios();
            //          mostrartablaExamenPrueba();
        }
    })
}


function pruebasCampos() {
    patronModulo = 'pruebas_campos';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'post',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            resultadoPrueba("");
            paginaPrueba();
        }
    })

}

function antecedentes() {
    c_cod_per = '';
    patronModulo = 'antecedentes';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + c_cod_per;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            tablaCie();

        }
    })
}

function mantenimientoReportes() {
    patronModulo = 'abrirMantenimientoReportes';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            arbolReporte();
        }
    })
}

function mantenimientoAreaCentroCosto() {
    patronModulo = 'abrirAreaCentroCosto';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            arbolCentroCosto();
        }
    })
}
function mantenimientoTurnoArea() {
    patronModulo = 'mantTurnoSucursalArea';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            cargarArbolEmpresaSucursal();
        }
    })
}

function cargaHorarios() {
    patronModulo = 'registroHorariosEmpleados';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            $("divExportarExcelHorarioEmpleados").hide();
            reporteEmpleado();

        }
    })
}



function mantenimientoAlmacen() {
    patronModulo = 'mantenimientoAlmacenes';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            resultadoalmacenes()
        }

    })

}


function vistaUnidadMedida() {
    patronModulo = 'vistaUnidadMedida';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            cargarTablaTipoUnidadMedida();
        }

    })
}

function mostrarReporteAsistencial() {

    patronModulo = 'mostrarReporteAsistencial';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);

        }
    })
}


function regularizarHorarios() {

    patronModulo = 'regularizarHorarios';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    //window.alert("holaaaaaaaaa eeeee");

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            cargaFechas();
            cargaArbolAreaBusquedaHorarios();
            cargaArbolCCostoHorarios();
        }
    })

//    patronModulo='pruebaHorarios';
//    parametros='';
//    parametros+='p1='+patronModulo;
//    //window.alert("holaaaaaaaaa eeeee");
//
//    new Ajax.Request(pathRequestControl,{
//        method : 'get',
//        parameters : parametros,
//        onLoading : micargador(1),
//        onComplete : function(transport){
//            micargador(0);
//            respuesta = transport.responseText;
//            $('Contenido').update(respuesta);
//            //document.getElementById("txtHoraEntrada").value=fechaActualX();
//        }
//    } )

}

function asignacionEmpleadosxSubAreas() {

    //codigoCentroCosto = $('hCodigoCentroCosto').value;
    // patronModulo='mostrarAsignacionEmpleadosxSubAreas';
    patronModulo = 'asignacionEmpleadosxSubAreas';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    //parametros+='&p2='+codigoCentroCosto;


    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            //            pru();
            CargarArea();

        }
    })
}

function menuCordinadoresTurnos() {


    patronModulo = 'menuCordinadoresTurnos';
    parametros = '';
    parametros += 'p1=' + patronModulo;


    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);

            CargarlistadoTodosCordinadores();
            CargarlistadoTodasAreasSinCoordinador();

        }
    })
}

//////////////////////INICIO DE LABORATORIO\\\\\\\\\\\\\\\\\\\\\\\\\\\


//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
//%%              Creado by JCQA 3Julio2012 9am                           %%
//%%                                                                      %%
//%%    Permite crear la vista del Menu: mantenimiento Examenes           %%
//%%                                                                      %%
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
//modificar
function mantenimientoExamenes() {

    //    alert("jose");
    patronModulo = 'mantenimientoExamenes';
    parametros = '';
    parametros += 'p1=' + patronModulo;


    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);

            //           layoutiniciadorMaterialesdeLaboratorio();

            layoutiniciadorExamenesdeLaboratorio();

            mostrarExamenesLaboratorio();
            ListarTiposAfiliacionExamenLaboratorio();

            //CargarlistadoTodosCordinadores();
            //CargarlistadoTodasAreasSinCoordinador();
            cargarComboTipoExamenesjcx();   //agregado

        }
    })
}
//agregado
function  cargarComboTipoExamenesjcx() {

    var patronModulo = 'cargarComboTipoExamenesjcx';

    var parametros = '';
    parametros += 'p1=' + patronModulo;
    //parametros+='&p2='+IdTipoUnidadMedidaSeleccionada;
    //parametros+='&p3='+idtMaterialLaboratorio;

    var destino = "div_UnidadDeMedidaPopud";
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            if (respuesta != "")
                $(destino).update(respuesta);

        }
    })





}//fin

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
//%%              Creado by JCQA 19Julio2012 9am                          %%
//%%                                                                      %%
//%%    Permite crear la vista del Menu: Materiales Laboratorio           %%
//%%                                                                      %%
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%


function MaterialesdeLaboratorio() {

    patronModulo = 'MaterialesdeLaboratorio';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);

            //            layoutiniciadorReporteIndicadorLaboratorioClinico();

            layoutiniciadorMaterialesdeLaboratorio();
            //            probandolayout(); //agregado

            mostrarMaterialesDeLaboratorio();

            var idMaterialLaboratorio = 0;
            cargarTablaUnidadesxTipoxMaterialLaboratorio(idMaterialLaboratorio);

            //ListarTiposAfiliacionExamenLaboratorio();


        }
    }

    )
}







//////////////////////FIN DE LABORATORIO\\\\\\\\\\\\\\\\\\\\\\\\\\\
function menuMostrarEmergencia() {
    patronModulo = 'menuMostrarEmergencia';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);

            ReporteInicial();
        }
    })
}

function reporteEmergenciaxDiagnosticoGeneral() {
    //    alert("holaaa")
    patronModulo = 'reporteEmergenciaxDiagnosticoGeneral';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);

        }
    })
}


function reporteEmergenciaxDiagnosticoServicio() {
    //alert("holaaa")
    patronModulo = 'reporteEmergenciaxDiagnosticoServicio';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
        }
    })
}


////////////////////////////////
///////////////////////////////

function mostrarHospitalizados() {
    //alert("holaaa");
    patronModulo = 'mostrarHospitalizados';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            BuscarHospitalizacion();
        }
    })
}


function menuReporteActuElimInsert() {//cargaHorariosRrhh
    patronModulo = 'registroHorariosEmpleadosRrhh';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            //            cargarTablaProgramacionHorarios(0);
        }
    })
}

/*********************************FARMACIA SOP*********************************/
function mostrarCIFarmaciaSOP() {
//    patronModulo='mostrarCIFarmaciaSOP';
//    parametros='';
//    parametros+='p1='+patronModulo;
//
//
//    new Ajax.Request( pathRequestControl,{
//        method : 'get',
//        parameters : parametros,
//        onLoading : micargador(1),
//        onComplete : function(transport){
//            micargador(0);
//            respuesta = transport.responseText;
//            $('Contenido').update(respuesta);
//            mostrarTablaGeneracionPreOrdenFarmaciaSOP();
//        }
//    } )
}
/******************************************************************************/

function mostrarProgramacionSOP() {

    patronModulo = 'mostrarProgramacionSOP';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            cargarTablaProgramacionesSOP();
            cargarLeyendaProgramacionesSOP()
        }
    })
}

/*******************************************************************************/

function mostrarCierreCaja() {
    patronModulo = 'mostrarCierreCaja';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            calendarioGeneral();
            mostrarTabsCierreCaja();
            mostrarTablaParteDiariaCierreCaja('', '');
        }
    })
}

function menuMostrarReportePorNroCaja() {
    //  alert("holaaaa");
    patronModulo = 'menuMostrarReportePorNroCaja';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
        }
    })
}


function mantenimientoArea() {
    patronModulo = 'abrirMantenimientoArea';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    sede = '';
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            cargarArbolAreas(sede);
            opcionCkbSucursales(0);
            editarAreaCatalogo();
            //$("btnNuevaAreaXSucursal").hide();
            //  arbolCentroCosto();
        }
    })
}

function menuCordinadoresTurnos() {
    patronModulo = 'menuCordinadoresTurnos';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);

            CargarlistadoTodosCordinadores();
            CargarlistadoTodasAreasSinCoordinador();
        }
    })
}

function menuCordinadoresActivarYDesactivarMes() {
    patronModulo = 'ActivacionCoordinadores';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    sede = '';
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
        }
    })
}
function asistenciaMedico() {
    patronModulo = 'asistenciaMedico';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    sede = '';
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
        }
    });
}


function contenidoPuntoControl() {
    //para limpiar los hc despues de grabar
    var patronModulo = 'contenidoPuntoControl';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            obtenerTablaPuntosControl();
        }
    })

}
function contenidoProcesarPuntoControl() {
    //para limpiar los hc despues de grabar
    var patronModulo = 'contenidoProcesarPuntoControl';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            $('Contenido').update(respuesta);
        }
    })

}
//// hecho por el lobo ////

function mantenimientoDatosExamen() {
    //para limpiar los hc despues de grabar
    var patronModulo = 'mantenimientoDatosExamen';
    var parametros = '';
    parametros += 'p1=' + patronModulo;

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
            $('Contenido').update(respuesta);
            buscarExamenesLaboratorio();
            oculparBotonNuevoPuntoControl();
        }
    })
}
function oculparBotonNuevoPuntoControl() {
    $("div_rangoFormato").hide();

    // $("div_detalleMuestrasyLaboratorioxPuntodeControl").hide();


    $("div_agregarNuevoPuntoControl").hide();
    $("div_agregarNuevoPuntoControlBoton").hide();
    $("div_detalleMuestrasyLaboratorioxPuntodeControl1").hide();
}

//JCDB 04/07/2012
function mantenimientoPerfiles() {
    //alert("hola");
    var patronModulo = 'mantenimientoPerfiles';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            cargarTablaPerfiles();
        }
    })
}

//JCDB 17/07/2012
function consultaEstadoExamen() {
    var patronModulo = 'consultaEstadoExamen';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            //cargaFechas();
            $('txtFechaIni').value = fechaActual();
            //cargarTablaEstadoExamenes();
        }
    })
}

//JCDB 02/08/2012
function generadorCodigoBarra() {
    var patronModulo = '';
    patronModulo = 'generadorCodigoBarra';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            cargarTablaRangoCodigoBarra();
        }
    })
}

// Jorge Hernandez - Carnetizacion

function menuCarnetizacion() {
    var patronModulo = '';
    patronModulo = 'menuCarnetizacion';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;

            $('Contenido').update(respuesta);

            $("1").hide();
            $("2").hide();
            $("3").hide();
            $("4").hide();
            calendarioCarnetizacion();
            ocultarBotonAbajo()
            //cargarTablaEstadoExamenes(); 
            $("div_foto").hide();
            // 	2/1/2013
            var fechaActual = new Date();

            var dia = fechaActual.getDate();
            var mes = fechaActual.getMonth() + 1;
            var anno = fechaActual.getFullYear();
            //   alert(anno);

            //            if (dia <10) dia = "0" + dia;
            //            if (mes <10) mes = "0" + mes;  

            var fechaHoy = dia + "/" + mes + "/" + anno;
            BuscarPersonaCarnetizacion(fechaHoy);
            cantidadActualFecha(fechaHoy);
        }
    });
}

function calendarioCarnetizacion() {
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

    mCal = new dhtmlxCalendarObject('div_calendarHere', false, {
        isMonthEditable: true,
        isYearEditable: true,
        dateformat: '%d/%m/%Y'

    });
    mCal.setYearsRange(1900, aniolimite);
    mCal.loadUserLanguage('es');

    mCal.attachEvent("onClick", function (date) {
        var d = new Date(date);
        fecha = d.getDate() + "/" + parseInt(d.getMonth() + 1) + "/" + d.getFullYear();
        BuscarPersonaCarnetizacion(fecha);
        limpiaBusquedasotros("05")
        //              alert(fecha);
    });

    mCal.draw();


}

function ReporteIndicadorActoMedico() {
    var patronModulo = '';
    patronModulo = 'ReporteIndicadorActoMedico';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            cargarEstadisticas();
        }
    })

}

function ReporteEstadisticoActoMedico() {
    /*
     NO BORRAR ESTA DECLARACION DE VARIABLES ES NECESARIO PARA QUE
     LA EXPORTACION A EXCEL DE LAS TABLAS DINAMICAS SEA POR CADA UNA 
     GENERADA WENO YO ME ENTIENDO NO BORRAR
     ANGEL AUGUSTO SAYES MALPARTIDA - 09/08/2013 
     */
    aLeyenda50 = 'aLeyenda50';
    aLeyenda49 = 'aLeyenda49';
    aLeyenda48 = 'aLeyenda48';
    aLeyenda47 = 'aLeyenda47';
    aLeyenda46 = 'aLeyenda46';
    aLeyenda45 = 'aLeyenda45';
    aLeyenda44 = 'aLeyenda44';
    aLeyenda43 = 'aLeyenda43';
    aLeyenda42 = 'aLeyenda42';
    aLeyenda41 = 'aLeyenda41';
    aLeyenda40 = 'aLeyenda40';
    aLeyenda39 = 'aLeyenda39';
    aLeyenda38 = 'aLeyenda38';
    aLeyenda37 = 'aLeyenda37';
    aLeyenda36 = 'aLeyenda36';
    aLeyenda35 = 'aLeyenda35';
    aLeyenda34 = 'aLeyenda34';
    aLeyenda33 = 'aLeyenda33';
    aLeyenda32 = 'aLeyenda32';
    aLeyenda31 = 'aLeyenda31';
    aLeyenda30 = 'aLeyenda30';
    aLeyenda29 = 'aLeyenda29';
    aLeyenda28 = 'aLeyenda28';
    aLeyenda27 = 'aLeyenda27';
    aLeyenda26 = 'aLeyenda26';
    aLeyenda25 = 'aLeyenda25';
    aLeyenda24 = 'aLeyenda24';
    aLeyenda23 = 'aLeyenda23';
    aLeyenda22 = 'aLeyenda22';
    aLeyenda21 = 'aLeyenda21';
    aLeyenda20 = 'aLeyenda20';
    aLeyenda19 = 'aLeyenda19';
    aLeyenda18 = 'aLeyenda18';
    aLeyenda17 = 'aLeyenda17';
    aLeyenda16 = 'aLeyenda16';
    aLeyenda15 = 'aLeyenda15';
    aLeyenda14 = 'aLeyenda14';
    aLeyenda13 = 'aLeyenda13';
    aLeyenda12 = 'aLeyenda12';
    aLeyenda11 = 'aLeyenda11';
    aLeyenda10 = 'aLeyenda10';
    aLeyenda9 = 'aLeyenda9';
    aLeyenda8 = 'aLeyenda8';
    aLeyenda7 = 'aLeyenda7';
    aLeyenda6 = 'aLeyenda6';
    aLeyenda5 = 'aLeyenda5';
    aLeyenda4 = 'aLeyenda4';
    aLeyenda3 = 'aLeyenda3';
    aLeyenda2 = 'aLeyenda2';
    aLeyenda1 = 'aLeyenda1';
    aLeyenda0 = 'aLeyenda0';
    var patronModulo = '';
    patronModulo = 'ReporteEstadisticoActoMedico';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            layaoutiniciadorReportesEstadisiticos();

        }
    })

}



function ocultarBotonAbajo() {
    $("div_fechaAbajo").hide();
}


//JCQA 22 Octubre 2012

function ReporteIndicadorLaboratorioClinico() {
    var patronModulo = '';
    patronModulo = 'ReporteIndicadorLaboratorioClinico';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            layoutiniciadorReporteIndicadorLaboratorioClinico();
            //            probandolayout();
            //            cargarEstadisticas();
        }
    })

}

function mostrarPracticaDiego() {
    var patronModulo = '';
    patronModulo = 'mostrarPracticaDiego';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            cargarTablaPacientes();
        }
    })

}


//----------------------------------------------------------------------------------------
//----------------------------EQUIVALENCIAS CPT-------------------------------------------
//----------------------------------------------------------------------------------------

function equivalenciasCPT() {
    var patronModulo = 'abrirEquivalenciasCPT';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false, // Para que el ajax respete el orden de ejecucion
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            $('Contenido').update(respuesta);
        }
    })

}

//----------------------------------------------------------------------------------------  


function mantenimientoGrupoEtario() {
    var patronModulo = '';
    patronModulo = 'mantenimientoGrupoEtario';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            var icboAfiliacionGrupoEtario = $('cboAfiliacionGrupoEtario').value;
            //             alert(icboAfiliacionGrupoEtario);
            cargarTablaGrupoEtario(icboAfiliacionGrupoEtario);
        }
    })
}


function cargarMantenimientoServicios() {
    var patronModulo = '';
    patronModulo = 'cargarVistaMantenimientoModuloPorServicios';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Contenido').style.height = 750;
            $('Contenido').update(respuesta);
        }
    })

}




function cargarMantenimientoIP() {
    var patronModulo = '';
    patronModulo = 'cargarMantenimientoIP';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            cargarTablaIPs();
            $('guardar').hide();
            $('actualizar').hide();
            $('buscar').hide();
            $('ambientesDiv').hide();
            $('textIP').disabled = true;
            $('textPC').disabled = true;
            $('textAmbiente').disabled = true;



        }
    })

}

function cargarMantenimientoModulosAfiliacion() {
    var patronModulo = '';
    patronModulo = 'cargarMantenimientoModulosAfiliacion';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Contenido').style.height = 750;
            $('Contenido').update(respuesta);
        }
    })
}
function MantenimientoCIEGrupoEtareo() {
    var patronModulo = '';
    patronModulo = 'MantenimientoCIEGrupoEtareo';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Contenido').style.height = 750;
            $('Contenido').update(respuesta);


        }
    })
}


function moduloMantenimientoCargaDatosMicrobiologia() {
    var patronModulo = '';
    patronModulo = 'MantenimientoCargaDatosMicrobilogia';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + 1;
    parametros += '&p3=' + '';
    parametros += '&p4=' + '';
    parametros += '&p5=' + '';
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Contenido').style.height = 750;
            $('Contenido').update(respuesta);
        }
    })
}



function abrirReporteIndicadorDiagnostico() {
    var patronModulo = '';
    patronModulo = 'abrirReporteIndicadorDiagnostico';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Contenido').style.height = 750;
            $('Contenido').update(respuesta);
            cargarCuerpoReporteDiagnostico();
        }
    })
}

//***************************************************
function mostrarReporteGrupoEtareo() {

    patronModulo = 'mostrarReporteGrupoEtareo';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            buscarReporteGruposEtareos();
        }
    })
}


function abrirModuloReporteRecetasMedicas() {
    var patronModulo = '';
    patronModulo = 'abrirModuloReporteRecetasMedicas';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Contenido').style.height = 750;
            $('Contenido').update(respuesta);
            cargarCuerpoReporteRecetaMedica();
        }
    })
}
function ventanaEssalud() {
    var patronModulo = '';
    patronModulo = 'ventanaEssalud';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: true,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            cargarArbolListaReportesESSALUD();
        }
    })
}

/*********************Marcacion de Medicos************************/
/****************************************************************/

function RegularizarMarcacionMedicos() {

    patronModulo = 'RegularizarMarcacionMedicos';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    //window.alert("holaaaaaaaaa eeeee");
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            $('Contenido').update(respuesta);
            cargaFechas();
            cargaArbolCCostoHorariosMedicos();
        }
    });
}


function vistaReportePaquetePersona() {
    patronModulo = 'vistaReportePaquetePersona';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            $('Contenido').update(respuesta);
        }
    })
}

/****************************************************************/
/****************************************************************/


function reporteCaja() {
    var patronModulo = 'reporteCaja';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('Contenido').update(respuesta);

            $('txtFechaInicial').value = fechaActual();
            $('txtFechaFinal').value = fechaActual();
            buscarReporteCaja();
        }
    });
}