<?php

if (!isset($_SESSION)) {
    session_start();
}
require_once("../../../pholivo/Html.php");
require_once("../../../pholivo/Calendario.php");
require_once("../../clogica/LCronograma.php");
require_once("../../clogica/LMantenimientoGeneral.php");
require_once ("ActionPersona.php");
require_once("ActionAfiliaciones.php");
require_once ("ActionLaboratorio.php");

//sleep(3);


if ($_GET) {
    $parametros = $_GET;
    $action = $parametros["p1"];
} else if ($_POST) {
    $parametros = $_POST;
    $action = $parametros["p1"];
}
$resultado = '';

if (ini_get('memory_limit') == "2048M" && ini_get('max_input_time') == "90000" && ini_get('max_execution_time') == "90000") {

    if ($action == 'ingresarSistema') {
        require_once("ActionLogin.php");
        $oActionLogin = new ActionLogin();
        $islogin = $oActionLogin->validaUsuario1($parametros);
        $resultado = $islogin;
        $estado = '0';
    } else {
        $estado = '0';
        if (isset($_SESSION)) {
            require_once("ActionLogin.php");
            $oActionLogin = new ActionLogin();
            $accion = 'LEER';
            $sesion = '';
            $tiempo = '600';
            $sistema = $_SESSION['iid_sistema'];
            $contenido = 'mi contenido';
            $idusuario = $_SESSION['id_usuario'];
            $tcaduca = '';
            $ip = $_SESSION['host'];
            $id = $_SESSION['id'];
            $rs = $oActionLogin->verificarSesion($accion, $sesion, $tiempo, $sistema, $contenido, $idusuario, $tcaduca, $ip, $id);
            $estado = $rs[0][0];
            if ($estado == '4') {
                $otroIp = $rs[0][1];
            } else {
                $otroIp = 0;
            }
        }
    }
    if ($estado == '1') {
        //echo $nuevaSesion;
        switch (trim($action)) {
            ///////////****LOGIN****////////////////
            //Login de ingreso al sistema.

            case 'valida_usuario': {
                    require_once("ActionLogin.php");
                    $oActionLogin = new ActionLogin();
                    $oActionLogin->validaUsuario1($parametros);
                    break;
                }
            case 'cerrarSesionSimedh': {
                    require_once("ActionLogin.php");
                    $oActionLogin = new ActionLogin();
                    $resultado = $oActionLogin->cerrarSesion();
                    break;
                }

            ///////////****CRONOGRAMA****////////////////

            case 'cro_busca_profesional':
                require_once("ActionCronograma.php");
                $oActionCronograma = new ActionCronograma();
                $tabla = $oActionCronograma->listaProfesional($parametros["p2"]);
                $resultado = $tabla;
                break;

            case 'buscarSiguienteFecha': {
                    require_once("ActionCronograma.php");
                    $oActionCronograma = new ActionCronograma();
                    $datos['fecha'] = $parametros["p2"];
                    $datos['sede'] = $parametros["p3"];
                    $datos['opcionBusqueda'] = $parametros["p4"];
                    $datos['codigoPersonalSalud'] = $parametros["p5"];
                    $datos['codigoservicio'] = $parametros["p6"];
                    $resultado = $oActionCronograma->buscarSiguienteFecha($datos);
                    break;
                }
            case 'buscarProximaCita': {
                    require_once("ActionCronograma.php");
                    $oActionCronograma = new ActionCronograma();
                    $datos['fecha'] = $parametros["p2"];
                    $datos['sede'] = $parametros["p3"];
                    $datos['busqueda'] = $parametros["p4"];
                    $datos['persona'] = $parametros["p5"];
                    $datos['servicio'] = $parametros["p6"];
                    $resultado = $oActionCronograma->buscarProximaCita($datos);
                    break;
                }



            case 'cro_busca_profesional_total':
                require_once("ActionCronograma.php");
                $oActionCronograma = new ActionCronograma();
                $tabla = $oActionCronograma->listaProfesionalTotal($parametros["p2"]);
                $resultado = $tabla;
                break;
            case 'cro_formulario_registro':
                require_once($_SESSION['path_principal'] . 'hospitalizacion/cvista/programacion/inicio_cronograma.php');
                break;
            case 'cro_listado_cronograma':
                require_once("ActionCronograma.php");
                $oActionCronograma = new ActionCronograma();
                $resultado = $oActionCronograma->listaCronogramaPrincipal($mes_actual, $ano_actual, $persona, $oficina);
                break;
            case 'cro_seleccion_producto':
                require_once("ActionCronograma.php");
                $oActionCronograma = new ActionCronograma();
                $resultado = $oActionCronograma->seleccionListaProducto($oficina, $producto, $actividad);
                break;
            case 'cro_seleccion_ambiente':
                require_once("ActionCronograma.php");
                $oActionCronograma = new ActionCronograma();
                $resultado = $oActionCronograma->SeleccionAmbiente($oficina, $actividad, $ambiente);
                break;
            case 'cro_calendario':
                require_once("ActionCronograma.php");
                $oActionCronograma = new ActionCronograma();
                $resultado = $oActionCronograma->generaCalendario($cal_dia, $cal_mes, $cal_ano, $accion, $marcar_dias, $bloqueo_dias);
                break;
            case 'cro_formulario_cronograma_registro':
                require_once($_SESSION['path_principal'] . 'hospitalizacion/cvista/programacion/cronograma_registro.php');
                break;
            case 'cro_formulario_inicio_programacion':
                require_once($_SESSION['path_principal'] . 'hospitalizacion/cvista/programacion/inicio_programacion.php');
                break;
            case 'cro_mantenimiento_cronograma':
                require_once("ActionCronograma.php");
                $oActionCronograma = new ActionCronograma();
                $resultado = $oActionCronograma->consultaMantenimientoCronograma($accion, $vid_cronograma_ant, $iid_persona, $ambiente, $oficina, $turno, $fecha, $producto, $actividad, $cupos);
                break;
            case 'caj_listado_caja':
                require_once("ActionCaja.php");
                $oActionCaja = new ActionCaja();
                $resultado = $oActionCaja->listaCajaGeneral($sector, $habilitado);
                break;
            case 'caj_detalle_trabajador':
                require_once($_SESSION['path_principal'] . 'hospitalizacion/cvista/caja/detalle_trabajador.php');
                break;
            case 'caj_cajero_datos':
                require_once("ActionCaja.php");
                $oActionCaja = new ActionCaja();
                $resultado = $oActionCaja->muestraCajeroDatos($persona, $caja);
                break;
            case 'caj_detalle_comprobante':
                require_once("ActionCaja.php");
                $oActionCaja = new ActionCaja();
                $resultado = $oActionCaja->muestraDetalleComprobante($caja);
                break;
            case 'cronograma_medico': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $resultado = "<table class=\"tabla1\" width='100%'>" . $o_ActionCita->listaCronogramaSede($parametros) . "<table>";
                    break;
                }
            case 'cronograma_medico_filtro_dato': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $resultado = "<table class=\"tabla1\" width='100%'>" . $o_ActionCita->listaCronogramaFiltroDato($parametros) . "<table>";
                    break;
                }
            case 'programacion_citas': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $resultado = "<table width='100%'>" . $o_ActionCita->listaCita("01", $parametros["p2"], $parametros["p3"]) . "<table>";
                    break;
                }
            case 'gestion_cita': {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $resultado = $o_ActionCronograma->getDatosCronograma("01", $parametros["p2"]);
                    break;
                }
            case 'programar_cita': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $resultado = $o_ActionCita->listaTurnosLibres($parametros["p2"]);
                    break;
                }
            case 'grabar_cita': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $resultado = $o_ActionCita->grabarCita($parametros);
                    break;
                }
            case 'editar_cita': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $resultado = $o_ActionCita->editarCita($parametros);
                    break;
                }
            case 'buscar_personas': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = "<table width='100%'>" . $o_ActionAdmision->listaPersonas($parametros["p2"], $parametros["p3"], 'setDatosPersonas') . "<table>";
                    break;
                }
            case 'mostrarVentanaHistoriaClinica': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->mostrarVentanaHistoriaClinica();
                    break;
                }
            case 'verificarAfiliciacionPrecioCita': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->listaAfiliacionPrecio($parametros);
                    break;
                }
            case 'buscar_personal_salud': {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $resultado = "<table width='100%'>" . $o_ActionCronograma->listaPersonalSalud($parametros["p2"], $parametros["p3"], $parametros["p4"], $parametros["p5"], 'setDatosPersonalSalud') . "<table>";
                    break;
                }
            case 'cargarCronogramaporPersonalSalud': {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $resultado = $o_ActionCronograma->listaCronogramaporPersonalSalud($parametros);
                    break;
                }
            case 'cargarCronogramaporEspecialidad': {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $resultado = $o_ActionCronograma->listaCronogramaporEspecialidad($parametros);
                    break;
                }

            case 'mostrar_datos_paciente_cita': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $iid_persona = $parametros["p2"];
                    $resultado = $o_ActionCita->muestraDatosPacienteCita($iid_persona);
                    break;
                }
            case 'mostrar_datos_cronograma_cita' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $iid_cronograma = $parametros["p2"];
                    $resultado = $o_ActionCronograma->muestraDatosCronogramaCita($iid_cronograma);
                    break;
                }

            case 'mostrar_datos_editar_cita': {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $n_nro_prog = $parametros["p2"];
                    $c_cod_per = $parametros["p3"];
                    $n_prog_pac = $parametros["p4"];
                    $resultado = $o_ActionCronograma->muestraDatosEditarCita($n_nro_prog, $c_cod_per, $n_prog_pac);
                    break;
                }
            case 'mostrar_hora_servidor': {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $resultado = $o_ActionCronograma->muestraHoraServidor();
                    break;
                }
            case "calendario": {
                    $p2 = $parametros["p2"]; //nombrecalendario
                    $p3 = $parametros["p3"]; //fecha
                    $p4 = $parametros["p4"]; //accion
                    $fecha = implode("-", array_reverse(explode("/", $p3)));
                    $tsFechaActual = empty($p3) ? strtotime(date("Y-m-d")) : strtotime($fecha);
                    $idAccion = empty($p4) ? '5' : $p4;
                    $o_Cal01 = new Calendario($p2, 'botonAccionCalendario', 'cabeceraCalendario', 'btnCalendario', 'estiloCasillaSeleccionada', $tsFechaActual, $idAccion, 'ponerFecha', 'cargarCalendario');
                    $calendario = $o_Cal01->getHTMLFullCalendario();
                    $resultado = $calendario;
                    break;
                }

            case 'mostrarOpcionesBusquedaCitas': {
                    require_once("ActionCita.php");
                    $p2 = $parametros["p2"];
                    $o_ActionCita = new ActionCita();
                    $resultado = $o_ActionCita->mostrarOpcionesBusqueda($p2);
                    break;
                }
            case 'obtenerActosMedicos': {
                    require_once("ActionPersona.php");
                    $p2 = $parametros["p2"];
                    $p3 = $parametros["p3"];
                    $o_ActionPersona = new ActionPersona();
                    $resultado = $o_ActionPersona->obtenerActosMedicos($p2, $p3);
                    break;
                }
            case 'combo_filtro': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $opcBusqueda = $parametros["p2"];
                    $valorFiltroBusqueda = $parametros["p3"];
                    $valorDatoBusqueda = '0';
                    $valorFecha = $parametros["p4"];
                    $sede = $parametros["sede"];
                    $resultado = $o_ActionCita->listaDatosComboFiltro($opcBusqueda, $valorFiltroBusqueda, $valorDatoBusqueda, '', $valorFecha, $sede);
                    break;
                }
            case 'busqueda_filtro': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $resultado = "<table class=\"tabla1\"; width='100%'>" . $o_ActionCita->listaCronograma($parametros) . "<table>";
                    break;
                }
            case 'busqueda_filtro_sede': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $resultado = "<table class=\"tabla1\" width='100%'>" . $o_ActionCita->listaCronogramaSede($parametros) . "<table>";
                    break;
                }

            case 'eliminar_cita': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $resultado = "<table class=\"tabla1\" width='100%'>" . $o_ActionCita->eliminarcita(trim($parametros["p2"])) . "<table>";
                    break;
                }
            case 'calendario01': {
                    $p2 = $parametros["p2"]; //Fecha
                    $p3 = $parametros["p3"]; //Accion
                    $tsFechaActual = empty($p2) ? strtotime(date("Y-m-d")) : strtotime($p2);
                    $idAccion = empty($p3) ? '5' : $p3;
                    $o_Cal01 = new Calendario('cal01', 'botonAccionCalendario', 'cabeceraCalendario', 'btnCalendario', 'estiloCasillaSeleccionada', $tsFechaActual, $idAccion, 'seleccionarFechaCitasInformes', 'accionCalendarioCitasInformes', '1');
                    $calendario = $o_Cal01->getHTMLFullCalendario();
                    $fechaObtenida = $o_Cal01->getTsFechaObtenida();
                    $resultado = $calendario . "|" . strftime('%Y-%m-%d', $fechaObtenida);
                    break;
                }
            case 'mostrarTablaServiciosCitas' : {
                    require_once("ActionCronograma.php");
                    header("Content-type: text/xml");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["parametroBusqueda"] = $parametros["p2"];
                    $datos["codigoactividad"] = $parametros["p3"];
                    $resultado = $o_ActionCronograma->listarServiciosCitas($datos);
                    break;
                }
            case 'mostrarCabeceraCronogramaCitasInformes': {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos['fecha'] = $parametros["p2"];
                    $datos['codigoservicio'] = $parametros["p3"];
                    $datos['codigoPersonalSalud'] = $parametros["p4"];
                    $datos['opcionBusqueda'] = $parametros["p5"];
                    $datos['sede'] = $parametros["p6"];
                    $resultado = $o_ActionCronograma->muestraCabeceraCronogramaCitasInformes($datos);
                    break;
                }
            case 'mostrarDatosPaciente': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["codigopersona"] = $parametros["p2"];
                    $resultado = $o_ActionCita->mostrarDatosPaciente($datos);
                    break;
                }

            case 'calculaprecioservicio': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos["afiliacionactiva"] = $parametros["p2"];
                    $datos["codigoservicio"] = $parametros["p3"];
                    $resultado = $o_ActionCita->calculaprecioservicio($datos);
                    break;
                }
            case 'reservarCitaInformesCronograma': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $codigoCronograma = $parametros["p2"];
                    $resultado = $o_ActionCita->reservarCitaInformesCronograma($codigoCronograma);
                    break;
                }

            case 'reservarCitaInformesServicio': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $codigoHora = $parametros["p2"];
                    $codigoCronograma = $parametros["p3"];
                    $tipocitaProgramada = $parametros["p4"];
                    $resultado = $o_ActionCita->reservarCitaInformesServicio($codigoHora, $codigoCronograma, $tipocitaProgramada);
                    break;
                }

            case 'describirCitaProgramada': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["codigoCronograma"] = $parametros["p2"];
                    $datos["codigoHora"] = $parametros["p3"];
                    $datos["codigoProgramacion"] = $parametros["p4"];
                    $resultado = $o_ActionCita->describirCitaProgramada($datos);
                    break;
                }
            case 'cambiarEstadoConfirmacionCita' : {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["codigoCronograma"] = $parametros["p2"];
                    $datos["codigoHora"] = $parametros["p3"];
                    $datos["codigoProgramacion"] = $parametros["p4"];
                    $resultado = $o_ActionCita->cambiarEstadoConfirmacionCita($datos);
                    break;
                }
            case 'guardarCitaProgramada': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["codigoCronograma"] = trim($parametros["p2"]);
                    $datos["codigoPersona"] = trim($parametros["p3"]);
                    $datos["codigoPaciente"] = trim($parametros["p4"]);
                    $datos["horaProgramada"] = trim($parametros["p5"]);
                    $datos["codigoTipoCita"] = trim($parametros["p6"]); //0001 -->Consultorio, 0002 -->Procedimiento
                    $datos["observacionCita"] = trim($parametros["p7"]);
                    $datos["codigoServicioProducto"] = trim($parametros["p8"]);
                    $datos["codigoActoMedico"] = trim($parametros["p9"]);
                    $datos["tipoProgramacion"] = trim($parametros["p10"]);
                    $datos["idTratamientoSeleccionado"] = trim($parametros["p11"]);
                    $datos["tipoUbicacionCita"] = trim($parametros["p12"]);
                    $resultado = $o_ActionCita->guardarCitaProgramada($datos);
                    break;
                }
            case 'editarCitaInformes': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["cronogramaorigen"] = $parametros["p2"];
                    $datos["horaorigen"] = $parametros["p3"];
                    $datos["cronogramadestino"] = $parametros["p4"];
                    $datos["horadestino"] = $parametros["p5"];
                    $datos["codigoprogramacion"] = $parametros["p6"];
                    $resultado = $o_ActionCita->editarCitaInformes($datos);
                    break;
                }
            case 'eliminarCitaProgramada': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["codigoCronograma"] = $parametros["p2"];
                    $datos["codigoHora"] = $parametros["p3"];
                    if (isset($_SESSION["permiso_formulario_servicio"][118]["ELIMINAR_CITA"]) && ($_SESSION["permiso_formulario_servicio"][118]["ELIMINAR_CITA"] == 1)) {
                        $datos["datosPermiso"] = 1;
                    } else {
                        $datos["datosPermiso"] = 0;
                    }
                    $resultado = $o_ActionCita->eliminarCitaProgramada($datos);
                    break;
                }


            case 'restaurarOrdenesTratamientoCita': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["hidNroOrden"] = $parametros["p2"];
//                    $datos["codigoHora"] = $parametros["p3"];

                    $resultado = $o_ActionCita->arestaurarOrdenesTratamientoCita($datos);
                    break;
                }




            case 'cargarNumeroOrdenGenerada': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["codigoCronograma"] = $parametros["p2"];
                    $datos["codigoHora"] = $parametros["p3"];
                    $datos["codigoProgramacion"] = $parametros["p4"];
                    $resultado = $o_ActionCita->cargarNumeroOrdenGenerada($datos);
                    break;
                }
            case 'cargarCodigoPersona': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["codigoCronograma"] = $parametros["p2"];
                    $datos["codigoHora"] = $parametros["p3"];
                    $datos["codigoProgramacion"] = $parametros["p4"];
                    $resultado = $o_ActionCita->cargarCodigoPersona($datos);
                    break;
                }
            case 'limpiarbuscarMedicoCitas': {
                    require_once("ActionPersona.php");
                    $o_ActionPersona = new ActionPersona();
                    $o_ActionPersona->buscadorMedico('clickCargaMedico');
                    break;
                }
            case 'datosdecronograma': {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos['codigoCronograma'] = $parametros["p2"];
                    $resultado = $o_ActionCronograma->getdatosdecronograma($datos);
                    break;
                }


            case 'traerDatosCronogramaProgramado': {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos['hidcolumnaorigen'] = $parametros["p2"];
                    $resultado = $o_ActionCronograma->atraerDatosCronogramaProgramado($datos);
                    break;
                }



            case 'cambiarAfiliacionAmbulatorio' : {
                    require_once("ActionPersona.php");
                    $o_ActionPersona = new ActionPersona();
                    $datos['codigoPersona'] = $parametros["p2"];
                    $resultado = $o_ActionPersona->cambiarAfiliacionAmbulatorio($datos);
                    break;
                }
            case 'cambiarAfiliacionContribuyente' : {
                    require_once("ActionPersona.php");
                    $o_ActionPersona = new ActionPersona();
                    $datos['codigopersona'] = $parametros["p2"];
                    $datos['codigocontribuyente'] = $parametros["p3"];
                    $resultado = $o_ActionPersona->cambiarAfiliacionContribuyente($datos);
                    break;
                }
            case 'cambiarAfiliacionEssalud' : {
                    require_once("ActionPersona.php");
                    $o_ActionPersona = new ActionPersona();
                    $datos['accion'] = ($parametros["p2"] == '' || $parametros["p2"] == null) ? '' : $parametros["p2"];
                    $datos['c_cod_per'] = ($parametros["p3"] == '' || $parametros["p3"] == null) ? '' : $parametros["p3"];
                    $datos['idCarta'] = ($parametros["p4"] == '' || $parametros["p4"] == null) ? '' : $parametros["p4"];
                    $datos['idDetalleCarta'] = ($parametros["p5"] == '' || $parametros["p5"] == null) ? '' : $parametros["p5"];
                    $resultado = $o_ActionPersona->cambiarAfiliacionEssalud($datos);
                    break;
                }
            case 'cambioafiliaciongeneral': {
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliaciones = new ActionAfiliaciones();
                    $datos = array();
                    $datos["codigoPersona"] = $parametros["p2"];
                    $o_ActionAfiliaciones->cambiarAfiliacionGeneral($datos);
                    break;
                }
            case 'AfiliacionInactivasPersona': {
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliaciones = new ActionAfiliaciones();
                    $resultado = $o_ActionAfiliaciones->AfiliacionInactivasPersona();
                    break;
                }
            case 'agregarAfiliacionesalPaciente': {
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliacion = new ActionAfiliaciones();
                    $datos = array();
                    $datos["codigopersona"] = $parametros["p2"];
                    $datos["afiliaciones"] = $parametros["p3"];
                    $o_ActionAfiliacion->agregarAfiliacionesalPaciente($datos);
                    break;
                }
            case 'quitarAfiliacionalPaciente': {
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliacion = new ActionAfiliaciones();
                    $datos = array();
                    $datos["codigopersona"] = $parametros["p2"];
                    $datos["afiliacion"] = $parametros["p3"];
                    $o_ActionAfiliacion->quitarAfiliacionalPaciente($datos);
                    break;
                }
            case 'mostrarafiliaciones' : {
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliacion = new ActionAfiliaciones();
                    $datos = array();
                    $datos["codigoPersona"] = $parametros["p2"];
                    $resultado = $o_ActionAfiliacion->mostrarAfiliaciones($datos);
                    break;
                }
            case 'FormularioDatosEssalud' : {
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliacion = new ActionAfiliaciones();
                    $resultado = $o_ActionAfiliacion->FormularioDatosEssalud($datos);
                    break;
                }
            case 'verificarCodAutogenerado' : {
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliacion = new ActionAfiliaciones();
                    $datos["CodiAuto"] = $parametros["p2"];
                    $resultado = $o_ActionAfiliacion->verificarCodAutogenerado($datos);
                    break;
                }

            case 'cargarDatosPersona' : {
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliacion = new ActionAfiliaciones();
                    $datos["Codigo"] = $parametros["p2"];
                    $resultado = $o_ActionAfiliacion->cargarDatosPersona($datos);
                    break;
                }
            case 'tablaxAfiliacionesPersona': {
                    header("Content-type: text/xml");
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliacion = new ActionAfiliaciones();
                    $datos = array();
                    $datos["CodigoPersona"] = $parametros["p2"];
                    $resultado = $o_ActionAfiliacion->tablaxAfiliacionesPersona($datos);
                    break;
                }
            case 'TablaEstadoDeuda': {
                    header("Content-type: text/xml");
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliacion = new ActionAfiliaciones();
                    $datos = array();
                    $datos["CodAutogenerado"] = $parametros["p2"];
                    $resultado = $o_ActionAfiliacion->TablaEstadoDeuda($datos);
                    break;
                }

            case 'guardarRelacionEntreDBSIMIandSIMED': {
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliacion = new ActionAfiliaciones();
                    $datos["codPersonaSimedh"] = $parametros["p2"];
                    $datos["CodPersonaSimi"] = $parametros["p3"];
                    $resultado = $o_ActionAfiliacion->guardarRelacionEntreDBSIMIandSIMED($datos);
                    break;
                }

            case 'QuitarRelacion': {
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliacion = new ActionAfiliaciones();
                    $datos["CodPersona"] = $parametros["p2"];
                    $resultado = $o_ActionAfiliacion->QuitarRelacion($datos);
                    break;
                }


            case 'RegistrarAutoGenerado': {
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliacion = new ActionAfiliaciones();
                    $datos["codPersonaSimedh"] = $parametros["p2"];
                    $resultado = $o_ActionAfiliacion->RegistrarAutoGenerado($datos);
                    break;
                }

            case 'BuscarPersonaDBSIMI': {
                    header("Content-type: text/xml");
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliacion = new ActionAfiliaciones();
                    $datos["Nombre"] = $parametros["p2"];
                    $resultado = $o_ActionAfiliacion->BuscarPersonaDBSIMI($datos);
                    break;
                }






            case 'verificarExistenciaDBContribuyentePuntual': {
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliacion = new ActionAfiliaciones();
                    $datos["codPersona"] = $parametros["p2"];
                    $resultado = $o_ActionAfiliacion->verificarExistenciaDBContribuyentePuntual($datos);
                    break;
                }


            case 'tablaxAfiliacionesInacPersona': {
                    header("Content-type: text/xml");
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliacion = new ActionAfiliaciones();
                    $datos = array();
                    $datos["codigoPersona"] = $parametros["p2"];
                    $resultado = $o_ActionAfiliacion->tablaxAfiliacionesInacPersona($datos);
                    break;
                }
            case 'activarAfiliacion' : {
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliacion = new ActionAfiliaciones();
                    $datos["CodigoPersona"] = $parametros["p2"];
                    $datos["IdAfil"] = $parametros["p3"];
                    $datos["NumeroAfil"] = $parametros["p4"];
                    $resultado = $o_ActionAfiliacion->activarAfiliacion($datos);
                    break;
                }
            case 'activarAfiliacionEssalud' : {
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliacion = new ActionAfiliaciones();
                    $datos["CodigoPersona"] = $parametros["p2"];
                    $datos["IdAfil"] = $parametros["p3"];
                    $datos["NumeroAfil"] = $parametros["p4"];
                    $resultado = $o_ActionAfiliacion->activarAfiliacionEssalud($datos);
                    break;
                }
            case 'agregarAfiliacionPersona' : {
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliacion = new ActionAfiliaciones();
                    $datos["IdAfil"] = $parametros["p2"];
                    $datos["NumeroAfiliacio"] = $parametros["p3"];
                    $datos["CodigoPersona"] = $parametros["p4"];
                    $resultado = $o_ActionAfiliacion->agregarAfiliacionPersona($datos);
                    break;
                }
            case 'mostrarNOafiliaciones': {
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliacion = new ActionAfiliaciones();
                    $datos = array();
                    $datos["codigoPersona"] = $parametros["p2"];
                    $resultado = $o_ActionAfiliacion->mostrarNOAfiliaciones($datos);
                    break;
                }
            case 'verificarCronogramaAfiliacion' : {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["codigocronograma"] = $parametros["p2"];
                    $datos["codigopersona"] = $parametros["p3"];
                    $datos["c_cod_pro"] = $parametros["p4"];

                    $resultado = $o_ActionCita->verificarCronogramaAfiliacion($datos);
                    break;
                }
            case 'mostrarProgramacionEmergenciaInformes' : {
                    require_once("ActionCita.php");
                    header("Content-type: text/xml");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["fecha"] = $parametros["p2"];
                    $datos["codigoservicio"] = $parametros["p3"];
                    $datos["codigosede"] = $parametros["p4"];
                    $resultado = $o_ActionCita->xmlTablaProgramacionEmergenciaInformes($datos);
                    break;
                }
            case 'mostrarCronogramaMedicoCita' : {
                    require_once("ActionCita.php");
                    header("Content-type: text/xml");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["fecha"] = $parametros["p2"];
                    $datos["c_cod_per"] = $parametros["p3"];

                    $resultado = $o_ActionCita->aMostrarCronogramaMedicoCita($datos);
                    break;
                }

            /* ============================================================================== */
            /* DESCOMENTAR PARA QUE FUNCIONE LOS ADICIONALES IDEALMENTE!!!!!CUANDO SE HAGA EL MODULO PARA MEDICOS */
            /*
              //citas adicionales
              case 'mostrarTablaAdicionales' :{
              require_once("ActionCita.php");
              $o_ActionCita= new ActionCita();
              $datos = array();
              $datos["codigoCronograma"] = $parametros["p2"];
              $resultado = $o_ActionCita->getTablaAdicionales($datos);
              break;
              }
             */
            /* ============================================================================= */
            /* MOSTRAR LAS PROGRAMACIONES DETALLADAS CON ADICIONALES FUERA DE TURNOS=====PARCHE!!!! */
            /* COMENTAR O ELIMINAR CUANDO SE REALIZE EL MODULO PARA MEDICOS */
            //citas detalladas

            case 'mostrarTablaProgramacionDetallada' : {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["codigoCronograma"] = $parametros["p2"];
                    $resultado = $o_ActionCita->getTablaProgramacionDetallada($datos);
                    break;
                }
            case 'mostrarDetalleCronogramaMedico' : {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["codigoCronograma"] = $parametros["p2"];
                    $resultado = $o_ActionCita->aMostrarDetalleCronogramaMedico($datos);
                    break;
                }

            case 'eliminarCitaAdicional' : {

                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["codigoProgramacion"] = $parametros["p2"];
                    if (isset($_SESSION["permiso_formulario_servicio"][118]["ELIMINAR_CITA"]) && ($_SESSION["permiso_formulario_servicio"][118]["ELIMINAR_CITA"] == 1)) {
                        $datos["datosPermiso"] = 1;
                    } else {
                        $datos["datosPermiso"] = 0;
                    }
                    $resultado = $o_ActionCita->eliminarCitaAdicional($datos);
                    //echo 'angel';
                    break;
                }
            case 'mostrarventanaprogramacionTemporal' : {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $resultado = $o_ActionCita->mostrarventanaprogramacionTemporal();
                    break;
                }
            case 'mostrartablaprogramacionTemporal' : {
                    header("Content-type: text/xml");
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["fecha"] = $parametros["p2"];
                    $datos["codigoservicio"] = $parametros["p2"];
                    $resultado = $o_ActionCita->getTablaProgramacionTemporal($datos);
                    break;
                }
            case 'calendario02': {
                    $p2 = $parametros["p2"]; //Fecha
                    $p3 = $parametros["p3"]; //Accion
                    $tsFechaActual = empty($p2) ? strtotime(date("Y-m-d")) : strtotime($p2);
                    $idAccion = empty($p3) ? '5' : $p3;
                    $o_Cal01 = new Calendario('cal02', 'botonAccionCalendario', 'cabeceraCalendario', 'btnCalendario', 'estiloCasillaSeleccionada', $tsFechaActual, $idAccion, 'seleccionarFechaProgramacionMedicos', 'accionCalendarioProgramacionMedicos', '0', '1', 'seleccionarFechasPorDia');
                    $calendario = $o_Cal01->getHTMLFullCalendario();
                    $fechaObtenida = $o_Cal01->getTsFechaObtenida();
                    $resultado = $calendario . "|" . strftime('%Y-%m-%d', $fechaObtenida);
                    break;
                }
            case 'mostrarProgramacionMedico': {

                    break;
                }
            case 'mostrarseleccionProgramacionMedicos' : {
                    header("Content-type: text/xml");
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos["codigopersona"] = $parametros["p2"];
                    $datos["mesprogramacion"] = $parametros["p3"];
                    $datos["anioprogramacion"] = $parametros["p4"];
                    $datos["codigosede"] = $parametros["p5"];
                    $resultado = $o_ActionCronograma->mostrarseleccionProgramacionMedicosdhtmlx($datos);

                    break;
                }
            case 'guardarAfiliacionesXMedico' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos["arrayseleccionados"] = $parametros["p2"];
                    $datos["codCronograma"] = $parametros["p3"];
                    $resultado = $o_ActionCronograma->guardarAfiliacionesXMedico($datos);
                    break;
                }
            case 'abrirPopudEliminarProgramacion' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos["codProgramacion"] = $parametros["p2"];
                    $datos["accion"] = $parametros["p3"];
                    $resultado = $o_ActionCronograma->abrirPopudEliminarProgramacion($datos);
                    break;
                }
            case 'mostrarEdicionProgramacion' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos["codProgramacion"] = $parametros["p2"];
                    $rs = $o_ActionCronograma->mostrarEdicionProgramacion($datos);
                    $datosCronograma = $o_ActionCronograma->aDatosCronogramaMedicos($datos);
                    require_once '../../cvista/programacion/mostrarEdicionProgramacion.php';
                    break;
                }
            case 'EliminarAfiliacionesXMedico' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos["codCronograma"] = $parametros["p2"];
                    $resultado = $o_ActionCronograma->EliminarAfiliacionesXMedico($datos);
                    break;
                }

            case 'cargarListadodeAfiliacionesNoActivas' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos["codCronograma"] = $parametros["p2"];
                    $resultado = $o_ActionCronograma->obtenerlistaAfiliacionesNOAsignadasPopad($datos);
                    break;
                }
            case 'cargarListadodeAfiliacionesActivas' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos["codProg"] = $parametros["p2"];
                    $resultado = $o_ActionCronograma->obtenerlistaAfiliacionesAsignadasPopad($datos);
                    break;
                }



            case 'AbrirPopadMensaje' : {
                    require_once '../../cvista/cita/MensajeEnLaBotella.php';
                    break;
                }


            case 'opcionProgramacionMedicos' : {
                    $datos = array();
                    $datos["codigocronograma"] = $parametros["p2"];
                    require_once '../../cvista/programacion/opcionProgramacionMedicos.php';
                    $resultado = '';
                    break;
                }
            case 'reprogramarAdicionales' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos["iCodigoCronograma"] = $parametros["p2"];
                    $cantidadAdionales = $o_ActionCronograma->aCantidadAdicionales($datos);
                    require_once '../../cvista/programacion/reprogramarAdicionales.php';
                    $resultado = '';
                    break;
                }
            case 'abrirPopudReporteMensualCronograma' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos["iCodigoPersona"] = $parametros["p2"];
                    $datos["iMes"] = $parametros["p3"];
                    $datos["iAnio"] = $parametros["p4"];
                    require_once '../../cvista/programacion/abrirPopudReporteMensualCronograma.php';
                    $resultado = '';
                    break;
                }

            case 'mostrarTablaLog' : {
                    header("Content-type: text/xml");
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos["iCodigoPersona"] = $parametros["p2"];
                    $datos["iMes"] = $parametros["p3"];
                    $datos["iAnio"] = $parametros["p4"];
                    $resultado = $o_ActionCronograma->abrirPopudReporteMensualCronograma($datos);
                    break;
                }

            case 'guardarCambiosLogADicionales' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos["iCodigoCronograma"] = $parametros["p2"];
                    $datos["iCantidad"] = $parametros["p3"];
                    $resultado = $o_ActionCronograma->aGuardarCambiosLogADicionales($datos);
                    break;
                }


            case 'cargarEstadisticaMensualMedico' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["codigomedico"] = $parametros["p2"];
                    $datos["messeleccionMedicos"] = $parametros["p3"];
                    $datos["anioseleccionMedicos"] = $parametros["p4"];
                    $resultado = $o_ActionCronograma->cargarEstadisticaMensualMedico($datos);
                    break;
                }
            case 'autorizacionProgramacionMedicos' : {
                    $datos = array();
                    $datos["codigocronograma"] = $parametros["p2"];
                    require_once '../../cvista/programacion/autorizacionReprogramacion.php';
                    break;
                }
            case 'cargaEmpleadosProgramacionMedicosxCC' : {
                    header("Content-type: text/xml");
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos["idCentroCosto"] = $parametros["p2"];
                    $resultado = $o_ActionCronograma->cargaEmpleadosProgramacionMedicosxCC($datos);
                    break;
                }
            case 'cargaPuestosProgramacionMedicos' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["codigopersona"] = $parametros["p2"];
                    $datos["idcentrocosto"] = $parametros["p3"];
                    $resultado = $o_ActionCronograma->seleccionPuestos($datos);
                    break;
                }
            case 'cargaServiciosProgramacionMedicos' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["codigoPuesto"] = $parametros["p2"];
                    $resultado = $o_ActionCronograma->seleccionServicios($datos);
                    break;
                }
            case 'cargaAmbientesLogicosProgramacionMedicos' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["idCentroCosto"] = $parametros["p2"];
                    $datos["codigosede"] = $parametros["p3"];
                    $resultado = $o_ActionCronograma->seleccionAmbientesLogicos($datos);
                    break;
                }
            case 'cargaAmbienteLogicoPorPuesto' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["idPuesto"] = $parametros["p2"];
                    $datos["codigosede"] = $parametros["p3"];
                    $resultado = $o_ActionCronograma->seleccionAmbienteLogicoPorPuesto($datos);
                    break;
                }
            case 'cargaServiciosPorActividadDeCentroCosto' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["idPuesto"] = $parametros["p2"];
                    $datos["codigoActividad"] = $parametros["p3"];
                    $resultado = $o_ActionCronograma->seleccionServiciosPorActividadDeCentroCosto($datos);
                    break;
                }
            case 'cargaAmbientesFisicosProgramacionMedicos' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["codigoAmbienteLogico"] = $parametros["p2"];
                    $datos["codigoActividad"] = $parametros["p3"];
                    $datos["codigoSede"] = $parametros["p4"];
                    $resultado = $o_ActionCronograma->seleccionAmbientesFisicos($datos);
                    break;
                }
            case 'cargaActividadesProgramacionMedicos' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $resultado = $o_ActionCronograma->seleccionActividades();
                    break;
                }
            case 'cargaTurnoProgramacionMedicos' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["turno"] = $parametros["p2"];
                    $resultado = $o_ActionCronograma->seleccionTurnos($datos);
                    break;
                }
            case 'cargaTiempoAtencionProgramacionMedicos' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["codigoservicio"] = $parametros["p2"];
                    $resultado = $o_ActionCronograma->obtenerTiempoAtencion($datos);
                    break;
                }
            case 'codigoTurnoProgramacionMedicos' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["horainicio"] = $parametros["p2"];
                    $datos["horafinal"] = $parametros["p3"];
                    $resultado = $o_ActionCronograma->obtenercodigoTurno($datos);
                    break;
                }
            case 'agregarAfiliacionesProgramacionMedicos': {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["afiliaciones"] = $parametros["p2"];
                    $resultado = $o_ActionCronograma->obtenercodigoTurno($datos);
                    break;
                }
            case 'grabarProgramacionMedicos' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["codigopersona"] = $parametros["p2"];
                    $datos["codigoambientelogico"] = $parametros["p3"];
                    $datos["codigoturno"] = $parametros["p4"];
                    $datos["fechasservicios"] = $parametros["p5"];
                    $datos["codigoservicio"] = $parametros["p6"];
                    $datos["cupostotales"] = $parametros["p7"];
                    $datos["cuposadicionales"] = $parametros["p8"];
                    $datos["codigoambientefisico"] = $parametros["p9"];
                    $datos["codigoactividad"] = $parametros["p10"];
                    $datos["idpuestoempleado"] = $parametros["p11"];
                    $datos["afiliaciones"] = $parametros["p12"];
                    $datos["tiempoatencion"] = $parametros["p13"];
                    $datos["bProgramado"] = $parametros["p14"];
                    $datos["dFechaProgramado"] = $parametros["p15"];
                    $resultado = $o_ActionCronograma->grabarProgramacionMedicos($datos);
                    break;
                }
            case 'eliminarProgramacionMedicos' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["codigocronograma"] = $parametros["p2"];
                    $datos["motivo"] = $parametros["p3"];
                    $resultado = $o_ActionCronograma->eliminarProgramacionMedicos($datos);
                    break;
                }
            case 'guardarMantenimientoPRogramado' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["codigocronograma"] = $parametros["p2"];
                    $datos["bProgramacion"] = $parametros["p3"];
                    $datos["dFechaProgramacion"] = $parametros["p4"];
                    $resultado = $o_ActionCronograma->guardarMantenimientoPRogramado($datos);
                    break;
                }

            case 'cronogramaxAfiliacion' : {
                    require_once '../../cvista/programacion/cronogramaXafiliacion.php';
                    break;
                }

            case 'abrirPopadContribuyentePuntualBusquedaRelacionDBSIMI' : {
                    require_once '../../cvista/afiliaciones/abrirPopadContribuyentePuntualBusquedaRelacionDBSIMI.php';
                    break;
                }


            case 'limpiarSeleccionesProgramacionMedicos' : {
                    require_once '../../cvista/programacion/seleccionesProgramacionMedicos.php';
                    break;
                }
            case 'mostrarProgramacionAmbientesFisicos' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["fechas"] = $parametros["p2"];
                    $datos["codigoambientefisico"] = $parametros["p3"];
                    $resultado = $o_ActionCronograma->mostrarProgramacionAmbientesFisicos($datos);
                    break;
                }
            case 'consultarProgramacionMedicos' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["codigocronograma"] = $parametros["p2"];
                    $resultado = $o_ActionCronograma->consultarProgramacionMedicos($datos);
                    break;
                }
            case 'cargarComboAmbienteLogicoReprogramacionMedico' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["idPuesto"] = $parametros["p2"];
                    $datos["codigosede"] = $parametros["p3"];
                    $datos["hdnCodAmbLogico"] = $parametros["p4"];
                    $resultado = $o_ActionCronograma->cargarComboAmbienteLogicoReprogramacionMedico($datos);
                    break;
                }
            case 'cargarComboAmbienteFisicoReprogramacionMedico' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["codigoAmbienteLogico"] = $parametros["p2"];
                    $datos["codigoActividad"] = $parametros["p3"];
                    $datos["codigoSede"] = $parametros["p4"];
                    $datos["codAmbienteFisico"] = $parametros["p5"];
                    $resultado = $o_ActionCronograma->cargarComboAmbienteFisicoReprogramacionMedico($datos);
                    break;
                }
            case 'cargaLocalizacionReprogramacionMedicos' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["codigoAmbienteLogico"] = $parametros["p2"];
                    $datos["codigoActividad"] = $parametros["p3"];
                    $datos["codigoSede"] = $parametros["p4"];
                    $resultado = $o_ActionCronograma->cargaLocalizacionReprogramacionMedicos($datos);
                    break;
                }
            case 'actualizarCronogramaReProgramacionMedicos' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["codigocronograma"] = $parametros["p2"];
                    $datos["tipoactualizacion"] = $parametros["p3"];
                    $datos["codigoturno"] = $parametros["p4"];
                    $datos["ambientefisico"] = $parametros["p5"];
                    $datos["cantidadadicionales"] = $parametros["p6"];
                    $datos["cantidadcupos"] = $parametros["p7"];
                    $resultado = $o_ActionCronograma->actualizarCronogramaReProgramacionMedicos($datos);
                    break;
                }
            case 'mantenimientoReprogramarMedico' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["iCodigoCronograma"] = $parametros["p2"];
                    $datos["cCodigoAmbienteLogicoNuevo"] = $parametros["p3"];
                    $datos["iCodigoAmbienteFisicoNuevo"] = $parametros["p4"];
                    $datos["vTxtAreaMotivoDelCambioAmbiente"] = $parametros["p5"];
                    $resultado = $o_ActionCronograma->mantenimientoReprogramarMedico($datos);
                    break;
                }
            case 'generarCodigoAutorizacionProgramacionMedicos' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["codigocronograma"] = $parametros["p2"];
                    $datos["numerodocumento"] = $parametros["p3"];
                    $resultado = $o_ActionCronograma->generarCodigoAutorizacionProgramacionMedicos($datos);
                    break;
                }
            case 'mostrarMedicosparaReprogramacionMedicos' : {
                    $datos = array();
                    $datos["codigocronograma"] = $parametros["p2"];
                    require_once '../../cvista/programacion/medicosReprogramacionMedicos.php';
                    break;
                }
            case 'mostrarTablaMedicoParaReprogramacion' : {
                    require_once("ActionCronograma.php");
                    header("Content-type: text/xml");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["iCodigoCronograma"] = $parametros["p2"];
                    $resultado = $o_ActionCronograma->xmlTablaMedicoParaReprogramacion($datos);
                    break;
                }

            case 'grabarReprogramacionMedicos' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["iCodigoCronograma"] = $parametros["p2"];
                    $datos["iCodigoEmpleadoNuevo"] = $parametros["p3"];
                    $datos["iidPuestoNuevo"] = $parametros["p4"];
                    $datoDesencriptado = base64_decode($parametros["p5"]);
                    $datos["tMotivoReprogramacion"] = $datoDesencriptado;
                    $resultado = $o_ActionCronograma->grabarReprogramacionMedicos($datos);
                    break;
                }
            case 'mostrarAfiliacionesXCronograma' : {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["codigocronograma"] = $parametros["p2"];
                    $resultado = $o_ActionCronograma->mostrarAfiliacionesXCronograma($datos);
                    break;
                }

            case 'cargarCuerpoHC': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["c_cod_ser_pro"] = $parametros["p2"];
                    $datos["codigoProgramacion"] = $parametros["p3"];
                    $datos["codigoPaciente"] = $parametros["p4"];
                    $datos["codigoServicio"] = $parametros["p2"];
                    $datos["estado"] = $parametros["p5"];
                    //print_r($parametros);
                    $resultado = $o_ActionActoMedico->aCargarCuerpoHC($datos);
                    //require_once '../../cvista/actomedico/vistaAtencionMedicaHC.php';
                    break;
                }
            case 'insertaActualizaSintomatico': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["iSintomatico"] = $parametros["p2"];
                    $datos["iNumeroDias"] = $parametros["p3"];
                    $datos["iCodigoProgramacion"] = $parametros["p4"];
                    $resultado = $o_ActionActoMedico->aInsertaActualizaSintomatico($datos);
                    break;
                }
            case 'actualizarNumeroDiasSintomatico': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["iSintomatico"] = $parametros["p2"];
                    $datos["iNumeroDias"] = $parametros["p3"];
                    $datos["iCodigoProgramacion"] = $parametros["p4"];
                    $resultado = $o_ActionActoMedico->aActualizarNumeroDiasSintomatico($datos);
                    break;
                }
            case 'generarSintomaticoRespiratorio': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["iSintomatico"] = $parametros["p2"];
                    $datos["iNumeroDias"] = $parametros["p3"];
                    $datos["iCodigoProgramacion"] = $parametros["p4"];
                    $resultado = $o_ActionActoMedico->aGenerarSintomaticoRespiratorio($datos);
                    break;
                }


            case 'validarSeleccion': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["valor"] = $parametros["p2"];
                    $datos["id"] = $parametros["p3"];
                    $datos["text"] = $parametros["p4"];
                    $resultado = $o_ActionActoMedico->validarSeleccion($datos);
                    break;
                }
            case 'verificarPaqueteEtareo': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["c_cod_per"] = $parametros["p2"];
                    $datos["cie"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->aVerificarPaqueteEtareo($datos);
                    break;
                }
            case 'cargarPaqueteDiagnostico': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["c_cod_per"] = $parametros["p3"];
                    $datos["idGrupoEtaero"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->aCargarPaqueteDiagnostico($datos);
                    break;
                }

            case 'listarHistoriaOdontogramaxPersona': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["codPersona"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->listarHistoriaOdontogramaxPersona($datos);
                    break;
                }
            case 'actoMedicoConsultorio': {
                    require_once '../../cvista/actomedico/atencionMedica.php';
                    break;
                }
            case 'mostrarProgramacionMedicoActoMedico' : {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["codigoPersona"] = $_SESSION["id_persona"];
                    $datos["mesprogramacion"] = $parametros["p2"];
                    $datos["anioprogramacion"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->mostrarProgramacionMedico($datos);
                    break;
                }

            case 'grabarDestinoEssalud' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["combo"] = $parametros["p2"];
                    $datos["programacion"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->grabarDestinoEssalud($datos);
                    break;
                }
            case 'grabarTipoCitaEssalud' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["combo"] = $parametros["p2"];
                    $datos["programacion"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->grabarTipoCitaEssalud($datos);
                    break;
                }
            case 'cargarDatosCombo' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["programacion"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->acargarDatosCombo($datos);
                    break;
                }
            case 'cargarDatosTipoCita' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["programacion"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->acargarDatosTipoCita($datos);
                    break;
                }
            case 'mostrarPacientesProgramadosActoMedico' : {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["codigocronograma"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->mostrarPacientesProgramados($datos);
                    break;
                }
            case 'arregloDientes' : {
                    require_once("ActionActoMedico.php");

                    $o_ActionActoMedico = new ActionActoMedico();
                    //$datos["codigocronograma"] = $parametros["p2"];
                    $datos = '';
                    $resultado = $o_ActionActoMedico->aArregloDientes($datos);
                    break;
                }
            case 'obtenerTipoDiagnostico' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["idDiagnostico"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->aObtenerTipoDiagnostico($datos);
                    break;
                }

            case 'motrarTodasAtencionesProgramados' : {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["cadenaCodigocronograma"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->aMotrarTodasAtencionesProgramados($datos);
                    break;
                }
            case 'mostrarPacientesTodosAdicionalesActoMedico' : {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["cadenaCodigocronograma"] = $parametros["p2"];
                    // $datos["codigoactividad"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->mostrarTodasPacientesAdicionales($datos);
                    break;
                }
            case 'mostrarPacientesAdicionalesActoMedico' : {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["codigocronograma"] = $parametros["p2"];
                    // $datos["codigoactividad"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->mostrarPacientesAdicionales($datos);
                    break;
                }
            case 'calculaAtendidosyNoAtendidosDiarioActoMedico' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["codigocronograma"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->mostrarTablaCantidadAtencionDiaria($datos);
                    break;
                }
            case 'calculaAtendidosyNoAtendidosMensualActoMedico' : {
                    break;
                }
            case 'regresarAgendaMedicaActoMedico' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigoProgramacion"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->regresarAgendaMedicaActoMedico($datos);
                    break;
                }
            case 'llamaralPacienteActoMedico' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["codigoprogramacion"] = $parametros["p2"];
                    $datos["codigoambientefisico"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->llamaralPacienteActoMedico($datos);
                    break;
                }
            case 'datosPersonalesActoMedico' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["codigocronograma"] = $parametros["p2"];
                    $datos["codigopersona"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->mostrardatosPersonalesActoMedico($datos);
                    break;
                }
            case 'actualizaradicionalesActoMedico' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["codigocronograma"] = $parametros["p2"];
                    $datos["cantidadadicionales"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->actualizaradicionalesActoMedico($datos);
                    break;
                }
            case 'mostrarVerificacionContribuyente': {
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliaciones = new ActionAfiliaciones();
                    $datos = array();
                    $datos["codigopersona"] = $parametros["p2"];
                    $resultado = $o_ActionAfiliaciones->mostrarVerificacionContribuyente($datos);
                    break;
                }
            case 'mostrarVerificacionEssalud': {
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliaciones = new ActionAfiliaciones();
                    $c_cod_per = $parametros["p2"];
                    $resultado = $o_ActionAfiliaciones->mostrarVerificacionEssalud($c_cod_per);
                    break;
                }
            case 'spListaPersonaEssalud': {
                    require_once("ActionAfiliaciones.php");
                    header("Content-type: text/xml");
                    $o_ActionAfiliaciones = new ActionAfiliaciones();
                    $c_cod_per = $parametros["p2"];
                    $resultado = $o_ActionAfiliaciones->spListaPersonaEssalud($c_cod_per);
                    break;
                }
            case 'spListaDatosEssalud': {
                    require_once("ActionAfiliaciones.php");
                    header("Content-type: text/xml");
                    $o_ActionAfiliaciones = new ActionAfiliaciones();
                    $c_cod_per = $parametros["p2"];
                    $resultado = $o_ActionAfiliaciones->spListaDatosEssalud($c_cod_per);
                    break;
                }
            case 'spListaDetalleCartaEssaludPorCabeceraCarta': {
                    require_once("ActionAfiliaciones.php");
                    header("Content-type: text/xml");
                    $o_ActionAfiliaciones = new ActionAfiliaciones();
                    $c_cod_per = $parametros["p2"];
                    $resultado = $o_ActionAfiliaciones->spListaDetalleCartaEssaludPorCabeceraCarta($c_cod_per);
                    break;
                }
            case 'spListaCabeceraCartaEssalud': {
                    require_once("ActionAfiliaciones.php");
                    header("Content-type: text/xml");
                    $o_ActionAfiliaciones = new ActionAfiliaciones();
                    $c_cod_per = $parametros["p2"];
                    $resultado = $o_ActionAfiliaciones->spListaCabeceraCartaEssalud($c_cod_per);
                    break;
                }
            case 'mostrarTablaContribuyentePuntual': {
                    require_once("ActionAfiliaciones.php");
                    header("Content-type:text/xml");
                    $o_ActionAfiliaciones = new ActionAfiliaciones();
                    $datos = array();
                    $datos["opcionbusqueda"] = $parametros["p2"];
                    $datos["idcontribuyente"] = $parametros["p3"];
                    $datos["nombrecontribuyente"] = $parametros["p4"];
                    $resultado = $o_ActionAfiliaciones->mostrarTablaContribuyentePuntual($datos);
                    break;
                }
            case 'consultarContribuyentePuntual': {
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliaciones = new ActionAfiliaciones();
                    $datos = array();
                    $datos["opcionbusqueda"] = $parametros["p2"];
                    $datos["idcontribuyente"] = $parametros["p3"];
                    $resultado = $o_ActionAfiliaciones->consultarContribuyentePuntual($datos);
                    break;
                }
            case 'mantenimientoAmbientesLogicos' : {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos = array();
                    $datos["idCentroCosto"] = $parametros["p2"];
                    $resultado = $o_ActionMantenimientoGeneral->listadoAmbientesLogicos($datos);
                    break;
                }

            case 'cargarDatosMantenimientoAlmacen': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos["idPuntoControl"] = $parametros["p2"];
                    $resultado = $o_ActionMantenimientoGeneral->aCargarDatosMantenimientoAlmacen($datos);
                    break;
                }
            case 'editarAmbientesLogicos' : {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos = array();
                    $datos["codigoAmbienteLogico"] = $parametros["p2"];
                    $resultado = $o_ActionMantenimientoGeneral->editarAmbienteLogico($datos);
                    break;
                }
            case 'activaryDesactivarAmbienteLogico' : {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos = array();
                    $datos["codigoAmbienteLogico"] = $parametros["p2"];
                    $datos["estadoAmbienteLogico"] = $parametros["p3"];
                    $resultado = $o_ActionMantenimientoGeneral->activaryDesactivarAmbienteLogico($datos);
                    break;
                }
            case 'grabarAmbienteLogico' : {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos = array();
                    $datos["codigoCentroCosto"] = $parametros["p2"];
                    $datos["codigoAmbienteLogico"] = $parametros["p3"];
                    $datos["nombreAmbienteLogico"] = $parametros["p4"];
                    $datos["estadoAmbienteLogico"] = $parametros["p5"];
                    $datos["descripcionAmbienteLogico"] = $parametros["p6"];
                    $resultado = $o_ActionMantenimientoGeneral->grabarAmbienteLogico($datos);
                    break;
                }
            case 'mantenimientoAmbientesLogicosCentroCosto' : {
                    require_once("ActionRrhh.php");
                    $o_ActionRRHH = new ActionRrhh();
                    $id = $parametros["p2"];
                    $resultado = $o_ActionRRHH->traeCodigoCC($id);
                    break;
                }
            case 'abrirPopudBusquedaPersonalRRHH' : {
                    $datos['iIdCoordinardor'] = $parametros["p2"];
                    $datos['iMes'] = $parametros["p3"];
                    $datos['iAnio'] = $parametros["p4"];
                    require_once("../../cvista/rrhh/popudBuscarEmpleadoRRHH.php");
                    break;
                }
            case 'abrirPopadAreasPorCoordinador' : {
                    $datos['iIdCoordinardor'] = $parametros["p2"];
                    $datos['iMes'] = $parametros["p3"];
                    $datos['iAnio'] = $parametros["p4"];
                    $datos['c_cod_per'] = $parametros["p5"];
                    $datos['iIdPuestoEmpleado'] = $parametros["p6"];
                    require_once("../../cvista/rrhh/abrirPopadAreasPorCoordinador.php");
                    break;
                }
            case 'validarDatosContratoPersonal' : {
                    require_once("ActionRrhh.php");
                    $datos['c_cod_per'] = $parametros["p2"];
                    $datos['iIdPuestoEmpleado'] = $parametros["p3"];
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->validarDatosContratoPersonal($datos);

                    break;
                }




            case 'busquedaPersonalPorNombres' : {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $datos['vApellidoPaterno'] = $parametros["p2"];
                    $datos['vApellidoMaterno'] = $parametros["p3"];
                    $datos['vNombre'] = $parametros["p4"];
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->busquedaPersonalPorNombres($datos);
                    break;
                }
            case 'busquedaPersonalPorDNI' : {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $datos['vDNI'] = $parametros["p2"];
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->busquedaPersonalPorDNI($datos);
                    break;
                }



            case 'mostrarAsignacionAmbientesFisicosaAmbientesLogicos' : {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos = array();
                    $datos["codigoAmbienteLogico"] = $parametros["p2"];
                    $datos["nombreAmbienteLogico"] = $parametros["p3"];
                    $resultado = $o_ActionMantenimientoGeneral->obtenerAsignacionAmbientesFisicosaAmbientesLogicos($datos);
                    break;
                }
            case 'mostrarTablaAsignacionAmbientesFisicosaAmbientesLogicos' : {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos = array();
                    $datos["codigoAmbienteLogico"] = $parametros["p2"];
                    $datos["nombreAmbienteLogico"] = $parametros["p3"];
                    $resultado = $o_ActionMantenimientoGeneral->mostrarTablaAsignacionAmbientesFisicosaAmbientesLogicos($datos);
                    break;
                }
            case 'seleccionAmbientesFisicos' : {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $idSedeEmpresa = $parametros["p2"];
                    $nomAmbienteFisico = '%';
                    $resultado = $o_ActionMantenimientoGeneral->seleccionAmbientesFisicos($idSedeEmpresa, $nomAmbienteFisico);
                    break;
                }
            case 'agregarAmbienteFisicoaAmbienteLogico' : {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos = array();
                    $datos["codigoAmbienteLogico"] = $parametros["p2"];
                    $datos["codigoAmbienteFisico"] = $parametros["p3"];
                    $datos["codigoActividad"] = $parametros["p4"];
                    $datos["estadoAsignacion"] = $parametros["p5"];
                    $resultado = $o_ActionMantenimientoGeneral->agregarAmbienteFisicoaAmbienteLogico($datos);
                    break;
                }
            case 'activarydesactivarAsignacionAmbFisicoaAmbLogico' : {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos = array();
                    $datos["codigoAmbienteLogico"] = $parametros["p2"];
                    $datos["codigoAmbienteFisico"] = $parametros["p3"];
                    $datos["codigoActividad"] = $parametros["p4"];
                    $datos["estadoAsignacion"] = $parametros["p5"];
                    $resultado = $o_ActionMantenimientoGeneral->activarydesactivarAsignacionAmbFisicoaAmbLogico($datos);
                    break;
                }
            case 'eliminarAsignacionAmbFisicoaAmbLogico' : {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos = array();
                    $datos["codigoAmbienteLogico"] = $parametros["p2"];
                    $datos["codigoAmbienteFisico"] = $parametros["p3"];
                    $datos["codigoActividad"] = $parametros["p4"];
                    $resultado = $o_ActionMantenimientoGeneral->eliminarAsignacionAmbFisicoaAmbLogico($datos);
                }
            case 'acredita_essalud': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $dni = $parametros["p2"];
                    $resultado = $o_ActionAdmision->acredita_essalud($dni);
                    break;
                }
            case 'leerArchivoEssalud': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $dni = $parametros["p2"];
                    $resultado = $o_ActionAdmision->leerArchivoEssalud($dni);
                    break;
                }
            case 'validaPersonasDocIdentidad': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $tipo_documento = $parametros['p2'];
                    $nro_documento = $parametros['p3'];
                    $resultado = $o_ActionAdmision->validaPersonasDocIdentidad($tipo_documento, $nro_documento);
                    break;
                }
            case 'validaPersonasNombres': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $paterno = $parametros["p2"];
                    $materno = $parametros["p3"];
                    $nombres = $parametros["p4"];
                    $resultado = $o_ActionAdmision->validaPersonasNombres($paterno, $materno, $nombres);
                    break;
                }
            case 'mostrar_datos_paciente_admision': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $funcion = $parametros["funcionJSEjecutar"];
                    $resultado = $o_ActionAdmision->formRegistroPersonas(trim($parametros["p2"]), $funcion);
                    break;
                }
            case 'mostrar_datos_paciente_admision_nuevo': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $funcion = $parametros["funcionJSEjecutar"];
                    $resultado = $o_ActionAdmision->formRegistroPersonasNuevo(trim($parametros["p2"]), $funcion);
                    break;
                }
            case 'mantenimiento_persona': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->MantenimientoPersonas($parametros);
                    break;
                }
            case 'generar_historia': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->genera_historia($parametros);
                    break;
                }
            case 'combo_ubigeo': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $anioUbigeo = $parametros["p2"];
                    $dep_ubi = $parametros["p3"];
                    $pro_ubi = $parametros["p4"];
                    $pais = $parametros["p5"];
                    $dis_ubi = '0';
                    $resultado = $o_ActionAdmision->listaDatosComboUbigeo($pais, $dep_ubi, $pro_ubi, $dis_ubi, '');
                    break;
                }
            case 'combo_nacimiento': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $anioUbigeo = $parametros["p2"];
                    $dep_ubi = $parametros["p3"];
                    $pro_ubi = $parametros["p4"];
                    $pais = $parametros["p5"];
                    $dis_ubi = '0';
                    $resultado = $o_ActionAdmision->listaDatosComboNacimiento($pais, $dep_ubi, $pro_ubi, $dis_ubi, '');
                    break;
                }
            case 'combo_ocupaciones': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $grupo = $parametros["p2"];
                    $resultado = $o_ActionAdmision->seleccionarOcupacionLaboral($grupo, '', '');
                    break;
                }
            case 'seleccionarParentesco': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->listaXMLParentesco($parametros["p2"]);
                    break;
                }
            case 'listaInstEducativa': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->listaInstEducativa('', $parametros["p2"]);
                    break;
                }
            case 'listaGradoEstudio': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->listaGradoEstudio('', $parametros["p2"]);
                    break;
                }
            case 'listaXMLDocumentoIdentidad': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $cadDocs = $parametros["p2"];
                    $resultado = $o_ActionAdmision->listaXMLDocumentoIdentidad($cadDocs);
                    break;
                }
            case 'filiacionesPac': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $iid_persona = $parametros["p2"];
                    $cAfiliacion = $parametros["p3"];
                    $resultado = $o_ActionAdmision->filiacionesPacienteVent($iid_persona, $cAfiliacion);
                    break;
                }
            case 'mantenimiento_filiacion': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $cAfiliacion = $parametros["p2"]; //idAfiliacion
                    $ipers = $parametros["p3"]; //c_cod_per
                    $ipare = $parametros["p4"]; //c_cod_per_h
                    $bTitular = ($parametros["p5"] == 't' ? '1' : '0'); //Titular(t)
                    $ipe_r = $parametros["p6"]; //id_persona_r//Persona responsable
                    $bUAfiliacion = ($parametros["p7"] == 't' ? '1' : '0'); //Ultima afiliacion(t)
                    $bEstado = ($parametros["p8"] == 't' ? '1' : '0'); //Estado(t)
                    $dFechaInicio = date("d/m/Y H:i:s");
                    $dFechaFin = date("d/m/Y H:i:s");
                    $bcadu = ($parametros["p11"] == 't' ? '1' : '0'); //Caducidad(t)
                    $op_bd = $parametros["p12"]; //Accion(insertar)
                    $op_fm = $parametros["p13"]; //Opcion(vdh)
                    $rs_bd = $o_ActionAdmision->MantenimientoFiliacion($op_bd, $cAfiliacion, $ipers, $ipare, $bTitular, $ipe_r, $bUAfiliacion, $bEstado, $dFechaInicio, $dFechaFin, $bcadu);
                    switch (trim($op_fm)) {
                        case 'vdh': {
                                $resultado = $rs_bd == '1' ? $o_ActionAdmision->FiliacionesPaciente($ipers, '') : "Registro No Insertado";
                                break;
                            }
                        case 'idh': {
                                $resultado = $rs_bd == '1' ? $o_ActionAdmision->ListaDerHabienteFiliacion($ipe_r, $cAfiliacion, $filiacion) : "Registro No Insertado";
                                break;
                            }
                    }
                    break;
                }
            case 'derecho_habiente': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $filiacion = $parametros["p2"]; //cIdAfiliacion
                    $vDescripcion = $parametros["p3"]; //Descripcion
                    $cNumeroAfiliacion = $parametros["p4"]; //Numero Afiliacion
                    $c_cod_per = $parametros["p5"]; //c_cod_per
                    $c_cod_per_h = $parametros["p6"]; //c_cod_per_h
                    $c_cod_per_r = $parametros["p7"]; //c_cod_per_r
                    $bUltimaAfil = $parametros["p8"]; //uAfiliacion
                    $bEstado = $parametros["p9"]; //cEstado
                    $bDerechoHab = $parametros["p10"]; //bHabiente
                    $resultado = $o_ActionAdmision->ListaDerHabienteFiliacion($c_cod_per, $filiacion, $vDescripcion);
                    break;
                }
            case 'agregar_derecho_habiente': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $cAfiliacion = $parametros["p2"]; //cIdAfiliacion
                    $ipers = $parametros["p3"]; //c_cod_per
                    $ipe_r = $parametros["p4"]; //c_cod_per_r
                    $ipare = $parametros["p5"]; //id_parentesco
                    $ipe_rsexo = $parametros["p6"]; //id_sexo derecho habiente
                    $btitu = '';
                    $bacti = ($parametros["p7"] == 't' ? '1' : '0'); //Ultima afiliacion
                    $besta = ($parametros["p8"] == 't' ? '1' : '0'); //Estado
                    $dvi_i = date("d/m/Y H:i:s");
                    $dvi_f = date("d/m/Y H:i:s");
                    $bcadu = ($parametros["p11"] == 't' ? '1' : '0');
                    $op_bd = $parametros["p12"];
                    $op_fm = $parametros["p13"];
                    $filiacion = $parametros["p14"];
                    $resultado = $rs_bd == '1' ? $o_ActionAdmision->ListaDerHabienteFiliacion($ipers, $cAfiliacion, $filiacion) : "Registro No Insertado";
                    break;
                }
            case 'mostrar_datos_paciente': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $iid_persona = $parametros["p2"];
                    $resultado = $o_ActionAdmision->mostrar_datos_paciente($iid_persona);
                    break;
                }
            case 'buscar_pacientes_lab': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $opcion = $parametros['p2'];
                    $valor = $parametros['p3'];
                    $resultado = $o_ActionLaboratorio->getArrayPacientesLab($opcion, $valor);
                    break;
                }
            case 'MantenimientoCargaDatosMicrobilogia': {
                    $iOpcion = $parametros['p2'];
                    $vArchivo = $parametros['p3'];
                    $dFechaCreacion = $parametros['p4'];
                    $dFechaModificacion = $parametros['p5'];
                    require_once '../../cvista/laboratorio/MantenimientoCargaDatosMicrobilogia.php';
                    break;
                }
            case 'SeleccionarArchivo': {
                    $iOpcion = $parametros['p2'];
                    $vArchivo = $parametros['p3'];
                    $dFechaCreacion = $parametros['p4'];
                    $dFechaModificacion = $parametros['p5'];
                    require_once '../../cvista/laboratorio/MantenimientoCargaDatosMicrobilogia.php';
                    break;
                }


            case 'buscar_analisis_Lab': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $paciente = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->getArrayAnalisisLab($paciente);
                    break;
                }
            case 'poner_resultado': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $formato = $parametros["r"];
                    $resultado = $o_ActionLaboratorio->getIngResultadosLab($formato);
                    break;
                }
            case 'ManteResultadoLab': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->getManteResultadoLab($parametros);
                    break;
                }
            case 'ListaFormatosAnalisis': {
                    $sp1 = $parametros['sp1'];
                    $sp2 = $parametros['sp2'];
                    $sp3 = $parametros['sp3'];
                    $sp4 = $parametros['sp4'];
                    $sp5 = $parametros['sp5'];
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->getListaFormatoFamAna($sp1, $sp2, $sp3, $sp4, $sp5);
                    break;
                }
            case 'ManteFormatos': {
                    $op = $parametros['op'];
                    $id_tipo3 = $parametros['id_tipo3'];
                    $id_tipo4 = $parametros['id_tipo4'];
                    $id_tipo5 = $parametros['id_tipo5'];
                    $id_tipo6 = $parametros['id_tipo6'];
                    $id_tipo7 = $parametros['id_tipo7'];
                    $id_tipo8 = $parametros['id_tipo8'];
                    $iid_labdformatos = $parametros['iid_labdformatos'];
                    $iid_labmformatos = $parametros['iid_labmformatos'];
                    $grupo = $parametros['grupo']; //Para eliminar
                    $nivel = $parametros['nivel'];
                    $nombre_grupo = $parametros['nombre_grupo'];
                    $orden = $parametros['orden'];
                    $padre = $parametros['padre'];
                    $sigla = $parametros['sigla'];
                    $tipo = $parametros['tipo'];
                    $unidad = $parametros['unidad'];
                    $tipo4 = $parametros['tipo4'];
                    $tipo5 = $parametros['tipo5'];
                    $tipo6 = $parametros['tipo6'];
                    $tipo7 = $parametros['tipo7'];
                    $tabla = $parametros['tabla'];
                    $formula = $parametros['formula'];
                    $v_referencia = $parametros['v_referencial'];
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->getManteFormatos($op, $id_tipo3, $id_tipo4, $id_tipo5, $id_tipo6, $id_tipo7, $id_tipo8, $iid_labdformatos, $iid_labmformatos, $nivel, $nombre_grupo, $orden, $padre, $sigla, $tipo, $unidad, $tipo4, $tipo5, $tipo6, $tipo7, $tabla, $formula, $v_referencia, $grupo);
                    break;
                }
            case 'FormulaFormatoslm': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->sp_formulas_LevantaItems_lab($parametros);
                    break;
                }
            case 'CboFormatoSelectlm': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->sp_cbo_FormatoSelect_lab($parametros);
                    break;
                }
            case 'ManteServicios': {
                    $ac = $parametros['ac'];
                    $cf = $parametros['cf'];
                    $cro = $parametros['cro'];
                    $cs = $parametros['cs'];
                    $f = $parametros['f'];
                    $s = $parametros['s'];
                    $de = $parametros['de'];
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->getManteFormatosServicios($ac, $cf, $cro, $cs, $f, $s, $de);
                    break;
                }
            case 'rrhh': {
                    $dni = $parametros['dni'];
                    $idtipo_doc_identidad = $parametros['idtipo_doc_identidad'];
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $valores = $o_ActionRrhh->getDatosPersona($idtipo_doc_identidad, $dni);
                    include("../../cvista/rrhh/fondo_usuario_pre.php");
                    break;
                }

            case "calendarioOrdLab": {
                    $p2 = $parametros["p2"]; //Fecha
                    $p3 = $parametros["p3"]; //Accion
                    $tsFechaActual = empty($p2) ? strtotime(date("Y-m-d")) : strtotime($p2);
                    $idAccion = empty($p3) ? '5' : $p3;
                    $o_Cal01 = new Calendario('cal01', 'botonaccionCalendario', 'cabeceraCalendario', 'btnCalendario', 'estiloCasillaSeleccionada', $tsFechaActual, $idAccion, 'listOrdLab', 'accionCalendarioOrdLab');
                    $calendario = $o_Cal01->getHTMLFullCalendario();
                    //$fechaObtenida = $o_Cal01->getTsFechaObtenida();
                    $resultado = $calendario;
                    break;
                }
            case "AddListOrdLab": {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->agregar_ordenes_lab($parametros);
                    break;
                }

            case "ListaPersonaHospitalizacion": {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->ListaPersonaHospitalizacion($parametros["p2"]);
                    break;
                }
            case 'mante_paswd': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->fn_mante_paswd($parametros);
                    break;
                }
            case 'WbuscaPersonalmLab': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->sp_busca_personaslm_lab($parametros);
                    break;
                }

            case 'listOrdLab': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->sp_lista_registros_ingresados_lab_busq($parametros);
                    break;
                }
            case 'ListOrdLabEsp': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->sp_ListOrdLabEsp($parametros);
                    break;
                }
            case 'addListProdLab': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->fn_mante_ejecucion_registropaciente($parametros);
                    break;
                }
            case 'DetViewListProdLab': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->sp_lista_registros_ingresados_detalle_lab($parametros);
                    break;
                }
            case 'WbuscaMedicoLab': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->sp_busca_medicos_lab($parametros);
                    break;
                }
            case 'ActualizaMedicoLab': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->sp_actualiza_medicos_det_lab($parametros);
                    break;
                }
            case 'ActualizacionTablaRegistroLab': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->sp_actualizador_tabla_cabecera_registros($parametros);
                    break;
                }
            case 'form_buscador_personas': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->formBuscardorPersonas($parametros);
                    break;
                } case 'form_buscador_productos': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $resultado = $o_ActionOrden->getFormProductos($parametros);
                    break;
                } case 'form_buscador_contribuyentes': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->formBuscardorContribuyentes($parametros);
                    break;
                }
            case 'form_popup_datos_complementarios': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->formPopupDatosC($parametros);
                    break;
                }
            case 'mostrar_datos_paciente_orden': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $iid_persona = $parametros["p2"];
                    $resultado = $o_ActionOrden->muestraDatosPacienteOrden($iid_persona);
                    break;
                }
            case 'buscar_personas_ordenes': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = "<table width='100%'>" . $o_ActionAdmision->listaPersonas($parametros["p2"], $parametros["p3"], 'setDatosPersonasOrden') . "<table>";
                    break;
                }
            case 'buscar_productos_orden': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $resultado = $o_ActionOrden->getTablaProductos($parametros);
                    break;
                }
            case 'tabla_orden_paciente': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $resultado = $o_ActionOrden->getTablaOrdenesPaciente($parametros);
                    break;
                }
            case 'agregar_productos_nueva_orden': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $resultado = $o_ActionOrden->agregarProductoOrden($parametros);
                    break;
                }
            case 'form_generador_ordenes': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $resultado = $o_ActionOrden->getFormGeneracionOrdenes($parametros);
                    break;
                }
            case 'tabla_productos_ordenes_mantenimiento': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $resultado = $o_ActionOrden->actualizarCantidadesProductoOrden($parametros);
                    break;
                }
            case 'grabar_nueva_orden': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $resultado = $o_ActionOrden->grabarNuevaOrden($parametros);
                    break;
                }
            case 'cambiar_estado_orden': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $resultado = $o_ActionOrden->cambiarEstado($parametros);
                    break;
                }
            case 'listar_cartas_personas': {
                    require_once('ActionTesoreria.php');
                    $o_ActionTeso = new ActionTesoreria();
                    $resultado = $o_ActionTeso->asignarPaciente($parametros) . "|" . $o_ActionTeso->listaPersonas($parametros);
                    break;
                }
            case 'agregar_depositos_carta': {
                    require_once('ActionTesoreria.php');
                    $o_ActionTeso = new ActionTesoreria();
                    $resultado = $o_ActionTeso->agregarDepositoCarta($parametros);
                    break;
                }
            case 'muestra_depositos_carta': {
                    require_once('ActionTesoreria.php');
                    $o_ActionTeso = new ActionTesoreria();
                    $resultado = $o_ActionTeso->muestraDatosCartas($parametros);
                    break;
                }
            case ('imprResultadolab'): {
                    require_once ("ActionLaboratorio.php");
                    $opcion = $parametros ["p2"];
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->getfn_Mante_ImpResultados_lab($opcion);
                }
            case ('bustecnologo'): {
                    require_once("ActionLaboratorio.php");
                    $opcion = $parametros ["p2"];
                    $valor = $parametros ["p3"];
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->bustecnologo($opcion, $valor);
                }
            case ('busEventotabla'): {
                    require_once("ActionLaboratorio.php");
                    $opcion = $parametros ["p2"];
                    $valor = $parametros ["p3"];
                    $idtext = $parametros ["p4"];
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->busEventotabla($opcion, $valor, $idtext);
                }
            case ('validarango') : {
                    require_once("ActionLaboratorio.php");
                    $opcion = $parametros ["p2"];
                    $llave = $parametros ["p3"];
                    $valor = $parametros ["p4"];
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->validarango($opcion, $llave, $valor);
                }
            case 'Ingresar_Resultadocab': {
                    $sp1 = $parametros["bus"];
                    $sp2 = $parametros["c_cod_per"];
                    $sp3 = $parametros["iid_labmformatos"];
                    $sp4 = $parametros['iid_labmreferencia'];
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->getfn_Mante_mlab_resultados($sp1, $sp2, $sp3, $sp4);
                    break;
                }
            case ('Ingresar_resultadodet'): {
                    $sp1 = $parametros ["bus"];
                    $sp1 = $parametros [""];
                    $sp1 = $parametros ["iid_labmformatos"];
                    $sp1 = $parametros ["v_descripcion"];
                    $sp1 = $parametros ["vresultado"];
                    $sp1 = $parametros ["vunidad"];
                    $sp1 = $parametros ["vrefer"];
                    $sp1 = $parametros ["itipo"];
                    $sp1 = $parametros ["vorden"];
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->getfn_Mante_dlab_resultados($sp1, $sp2, $sp3, $sp4, $sp5, $sp6, $sp7, $sp8, $sp9);
                    break;
                }
            case ('guardarResulLab'): {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->guardarResulLab($parametros);
                    break;
                }
            case('productos'): {
                    require_once("ActionLogistica.php");
                    $o_actionLogistica = new ActionLogistica();
                    $htmlResultado = $o_actionLogistica->listaProductos($parametros["p2"], $parametros["p3"], $parametros["p4"], $parametros["p5"], $parametros["p6"]);
                    $resultado = $htmlResultado;
                    break;
                }
            case('precios'): {
                    require_once("ActionLogistica.php");
                    $o_actionLogistica = new ActionLogistica();
                    $htmlResultado = $o_actionLogistica->precioAfiliaciones($parametros["p2"]);
                    $resultado = $htmlResultado;
                    break;
                }
            case('mostrar_detalle_prod'): {
                    require_once("ActionLogistica.php");
                    $o_ActionLogistica = new ActionLogistica();
                    $resultado = $o_ActionLogistica->formdetalleProd(trim($parametros["p2"]));
                    break;
                }
            case('infoProductos'): {
                    require_once("ActionLogistica.php");
                    $o_ActionLogistica = new ActionLogistica();
                    $resultado = $o_ActionLogistica->infoProductos(trim($parametros["p2"]));
                    break;
                }
            case('getPrecioServicios'): {
                    require_once("ActionLogistica.php");
                    $o_ActionLogistica = new ActionLogistica();
                    $resultado = $o_ActionLogistica->precioServicio($parametros["p2"], $parametros["p3"]);
                    break;
                }
            case('adicionaProcedimientos'): {
                    require_once("ActionLogistica.php");
                    $o_ActionLogistica = new ActionLogistica();
                    $resultado = $o_ActionLogistica->adicionaProcedimientos($parametros["p2"], $parametros["p3"], $parametros["p4"]);
                    break;
                }
            case('precioProcedimeintos'): {
                    require_once("ActionLogistica.php");
                    $o_ActionLogistica = new ActionLogistica();
                    $resultado = $o_ActionLogistica->tablaResultadosPrecioProcedimientos($parametros["p2"], $parametros["p3"], $parametros["p4"], $parametros["p5"]);
                    break;
                }
            case('agregarProcedimiento'): {
                    require_once("ActionLogistica.php");
                    $o_ActionLogistica = new ActionLogistica();
                    $resultado = $o_ActionLogistica->tablaPrecioProcedimientosSeleccionado($parametros["p2"], $parametros["p3"], $parametros["p4"], $parametros["p5"], $parametros["p6"]);
                    break;
                }
            case 'mostrar_datos_cliente': {
                    require_once("ActionLogistica.php");
                    $o_ActionLogistica = new ActionLogistica();
                    $iid_persona = $parametros["p2"];
                    $resultado = $o_ActionLogistica->muestraDatosCliente($iid_persona);
                    break;
                }
            case('ordenes'): {
                    require_once("ActionLogistica.php");
                    $o_actionLogistica = new ActionLogistica();
                    $htmlResultado = $o_actionLogistica->getOrdenes($parametros["p2"]);
                    $resultado = $htmlResultado;
                    break;
                }
            case 'form_buscador_Productos': {
                    require_once("ActionLogistica.php");
                    $o_actionLogistica = new ActionLogistica();
                    $resultado = $o_actionLogistica->formBuscardorProductos($parametros);
                    break;
                }
            case 'detalleOrden': {
                    require_once("ActionTesoreria.php");
                    $o_ActionTesoreria = new ActionTesoreria();
                    $resultado = $o_ActionTesoreria->detalleOrden($parametros["p2"], $parametros["p3"]);
                    break;
                }
            case 'ListaPersonaCitas': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->ListaPersonaCitas($parametros["p2"]);
                    break;
                }
            case 'insertarHijo': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->insertarHijoCC($parametros["p2"], $parametros["p3"], $parametros["p4"], $parametros["p5"]);
                    break;
                }
            case 'generaCodCCostoH': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->nuevoItemHijoCC($parametros['p2'], $parametros['p3'], $parametros["p4"], $parametros['p5']);
                    break;
                }
            case 'editaCCosto': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->editaItemCC($parametros['p2'], $parametros['p3'], $parametros["p4"], $parametros['p5'], $parametros["p6"],$parametros["p7"]);
                    break;
                }
            case 'eliminaCCosto': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->eliminaItemCC($parametros['p2']);
                    break;
                }

            case 'verDatosCC': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->verItemCC($parametros['p2']);
                    break;
                }
            case 'puestosxCCostos': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();

                    $datos = array();
                    $datos["idCCostos"] = $parametros['p2'];
                    $datos["puesto"] = $parametros['p3'];
                    $datos["categoria"] = $parametros['p4'];
                    $datos["estado"] = $parametros['p5'];
                    $datos["funcion"] = $parametros['p6'];
                    $resultado = $o_ActionRrhh->aPuestosXCCostos($datos);
                    break;
                }

            case 'detallePuestoCentroCosto': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->adetallePuestoCentroCosto($parametros['p2']);
                    break;
                }

            case 'grabarDetallePuesto': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $ok = $o_ActionRrhh->grabarDetallePuesto($parametros);
                    $resultado = $ok[0][0];
                    break;
                }
            case 'grabarDetallePuestoaCentroCosto': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $ok = $o_ActionRrhh->grabarDetallePuestoaCentroCosto($parametros);
                    $resultado = $ok[0][0];
                    break;
                }
            case 'actualizarDatosPuestoenCentroCostos': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $ok = $o_ActionRrhh->grabarDetallePuestoaCentroCosto($parametros);
                    $resultado = $ok[0][0];
                    break;
                }
            case 'desactivarPuestoenCentroCostos': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->desactivarPuestoenCentroCostos($parametros);
                    break;
                }
            case 'seleccionarCentroCostoPuesto': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->seleccionarCentroCostoPuesto($parametros['p2']);
                    break;
                }
            case 'seleccionarCentroCostoPuestoDelArbol': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->seleccionarCentroCostoPuestoDelArbol($parametros['p2']);
                    break;
                }

            case 'asignarPuestoEmpleado': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $arrayDat = array();
                    $arrayDat["idPuesto"] = $parametros['p2'];
                    $arrayDat["codigoEmpleado"] = $parametros['p3'];
                    $arrayDat["idcontrato"] = $parametros['p4'];
                    $arrayDat["idsucursal"] = $parametros['p5'];
                    $arrayDat["sueldo"] = $parametros['p6'];
                    $arrayDat["idSedeEmpresaArea"] = $parametros['p7'];
                    $arrayDat["opt"] = $parametros['p8'];
                    $arrayDat["idTipoSueldo"] = $parametros['p9'];
                    $arrayDat["txtFechaIni"] = $parametros['p10'];
                    $arrayDat["txtFechaFin"] = $parametros['p11'];
                    $resultado = $o_ActionRrhh->asignarPuestoEmpleado($arrayDat);
                    break;
                }
            case 'registrarEmpleadoComoUsuario': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->registrarEmpleadoComoUsuario($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'detallePeriodosPuestoEmpleados': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->tablaPeriodos($parametros['p2']);
                    break;
                }
            case 'ventanaCambiarEstadoPuestoEmpleado': {
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->ventanaCambiarEstadoPuestoEmpleado($parametros['p2'], $parametros['p3'], $parametros['p4']);
                    break;
                }
            case 'cambiarEstadoPuestoEmpleado': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->cambiarEstadoPuestoEmpleado($parametros['p2'], $parametros['p3'], $parametros['p4'], $parametros['p5'], $parametros['p6']);
                    break;
                }
            case 'editarPeriodoPuesto': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->editarPeriodoPuesto($parametros['p2'], $parametros['p3'], $parametros['p4'], $parametros['p5'], $parametros['p6']);
                    break;
                }
            case 'ventanaEditarPeriodos': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->ventanaEditarPeriodos($parametros['p2']);
                    break;
                }
            case 'vistaLegajoDetalle': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->vistaLegajoDetalle($parametros['p2']);
                    break;
                }
            case 'actualizarFechaDocumento': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->actualizarFechaDocumento($parametros['p2'], $parametros['p3']);
                    break;
                }



            case 'mantemientoAtributosDocumentoEmpleados': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->mantemientoAtributosDocumentoEmpleados($parametros['p2'], $parametros['p3'], $parametros['p4'], $parametros['p5'], $parametros['p6']);
                    break;
                }
            case 'agregarDocumentoEmpleado': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->agregarDocumentoEmpleado($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'consultaDatosPersonal': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->mostrarCcostos();
                    break;
                }
            case 'mostrarDatosCC': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = utf8_encode($o_ActionRrhh->formCCostos($parametros["p2"]));
                    break;
                }
            case 'getNombreCC': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->traeNombreCC($parametros['p2']);
                    break;
                }
            case 'getIdCC': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->traeIdCC($parametros['p2']);
                    break;
                }
            case 'generaCodCCostoH': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->nuevoItemHijoCC($parametros['p2'], $parametros['p3'], $parametros["p4"], $parametros['p5']);
                    break;
                }
            case 'editaCCosto': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->editaItemCC($parametros['p2'], $parametros['p3'], $parametros["p4"], $parametros['p5'], $parametros["p6"], $parametros["p7"]);
                    break;
                }
            case 'eliminaCCosto': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->eliminaItemCC($parametros['p2']);
                    break;
                }
            case 'abrirPopadConsultaTarifasPaquete': {
                    require_once("ActionLogistica.php");
                    $o_ActionLogistica = new ActionLogistica();
                    $resultado = $o_ActionLogistica->abrirPopadConsultaTarifasPaquete();
                    break;
                }




            case 'actualizaCCosto': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->actualizaCcostos();
                    break;
                }
            case 'buscaEmpleado': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->buscaEmpleado($parametros['p2'], $parametros['p3'], $parametros['p4'], $parametros['p5'], $parametros['p6'], $parametros['p7'], $parametros['p8']);
                    break;
                }
            case 'busquedaEmpleadosCentroCostos': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->aBusquedaEmpleadosCentroCostos($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'busquedaEmpleadosAreas': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->aBusquedaEmpleadosArea($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'busquedaEmpleadosCentroCostosFiltrado': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->busquedaEmpleadosCentroCostosFiltrado($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'ListadoFiltradoAreas': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->ListadoFiltradoAreas($parametros['p2']);
                    break;
                }
            case 'buscaEmpleadoPopap': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->buscaEmpleadoPopap($parametros['p2'], $parametros['p3'], $parametros['p4'], $parametros['p5'], $parametros['p6'], $parametros['p7'], $parametros['p8']);
                    break;
                }
            case 'buscarCoordinadoresPopap': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->buscarCoordinadoresPopap($parametros['p2'], $parametros['p3'], $parametros['p4']);
                    break;
                }
            case 'puestoCentroCosto': {
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->puestoCentroCosto($parametros['p2']);
                    break;
                }
            case 'mostrarEmpleadosCC': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->buscaEmpleadoCC($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'mostrarContratos': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->aMostrarContratos($parametros['p2'], $parametros['p3'], $parametros['p4']);
                    break;
                }
            case 'cargarTablaContratos': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->acargarTablaContratos($parametros['p2']);
                    break;
                }
            case 'verTablaAreasPuestoEmpleado': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->acargarTablaAreaPuestoEmpleado($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'CargarPaquetes': {
                    require_once("ActionLogistica.php");
                    header("Content-type: text/xml");
                    $o_ActionLogistica = new ActionLogistica();
                    $datos['paquete'] = $parametros['p2'];
                    $datos['afiliacion'] = $parametros['p3'];
                    $resultado = $o_ActionLogistica->CargarPaquetes($datos);
                    break;
                }


            case 'mantenimientoContrato': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos['accion'] = $parametros['p2'];
                    $datos['idContrato'] = $parametros['p3'];
                    $datos['idPuestoEmpleado'] = $parametros['p4'];
                    $resultado = $o_ActionRrhh->aMantenimientoContrato($datos);
                    break;
                }
            case 'buscarAreas': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->aBuscarAreas($parametros['p2']);
                    break;
                }
            case 'asignarPuestoEmpleadoArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos['idArea'] = $parametros['p2'];
                    $datos['idSede'] = $parametros['p3'];
                    $datos['idPuestoEmpleado'] = $parametros['p4'];
                    $resultado = $o_ActionRrhh->aAsignarPuestoEmpleadoArea($datos);
                    break;
                }
            case 'cambiarEstadoPuestoEmpleadoArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos['idPuestoEmpleadoArea'] = $parametros['p2'];
                    $datos['estadoPuestoEmpleadoArea'] = $parametros['p3'];
                    $resultado = $o_ActionRrhh->aEliminarPuestoEmpleadoArea($datos);
                    break;
                }
            case 'empleadosXPuestos': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->empleadosXPuestos($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'registroDatosPersonal': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->mostrarMenuCCostoPersonal();
                    break;
                }
            case 'buscarPersonaParaEmpleado': {
                    require_once("ActionPersona.php");
                    $o_ActionPersona = new ActionPersona();
                    $arrayParametros['funcion'] = 'registrarEmpleado';
                    $arrayParametros['alto'] = '270px';
                    $arrayParametros['nroOrden'] = false;
                    $arrayParametros['codigo'] = true;
                    $arrayParametros['documento'] = true;
                    $arrayParametros['apellidoPaterno'] = true;
                    $arrayParametros['apellidoMaterno'] = true;
                    $arrayParametros['nombre'] = true;
                    $arrayParametros['bbuscar'] = true;
                    $arrayParametros['blimpiar'] = true;
                    $arrayParametros['bnuevo'] = true;
                    $arrayParametros['editar'] = 'editar'; //editar: agrega el boton editar, otro valor no lo muestra
                    $o_ActionPersona->buscadorPersona($arrayParametros);
                    break;
                }
            case 'registrarEmpleado': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $ok = $o_ActionRrhh->registrarEmpleado($parametros['p2'], $parametros['p3']);
                    $resultado = $ok[0][0];
                    break;
                }
            case 'mostrarPuestosEmpleados': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->mostrarPuestosEmpleados($parametros['p2']);
                    break;
                }
            case 'mostrarTablaPuestosEmpleados': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->mostrarTablaPuestosEmpleados($parametros['p2']);
                    break;
                }
            case 'detallePuestosEmpleados': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->detallePuestosEmpleados($parametros['p2']);
                    break;
                }
            case 'detalleModalidadContrato': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->detalleModalidadContrato($parametros['p2']);
                    break;
                }

            case 'grabarMantenimientoContrato': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    if ($parametros['p2'] == '') {
                        $datos["idContrato"] = '0';
                    } else {
                        $datos["idContrato"] = $parametros['p2'];
                    }
                    $datos["idPuesto"] = $parametros['p3'];
                    $datos["inicio"] = $parametros['p4'];
                    $datos["fin"] = $parametros['p5'];
                    $datos["modalidadContrato"] = $parametros['p6'];
                    $datos["tipoSueldo"] = $parametros['p7'];
                    $datos["sueldo"] = $parametros['p8'];
                    $datos["tipoProgramacion"] = $parametros['p9'];
                    $datos["bestado"] = $parametros['p10'];
                    $datos["icodigoEmpleado"] = $parametros['p11'];
                    $datos["accion"] = $parametros['p12'];
                    $datos["fechaAnulacion"] = $parametros['p13'];
                    $datos["motivoAnulacion"] = $parametros['p14'];
                    $resultado = $o_ActionRrhh->aGrabarMantenimientoContrato($datos);
                    break;
                }

            case 'agregarPuestoEmpleado': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->agregarPuestoEmpleado($parametros['p2']);
                    break;
                }
            case 'registroDatosPersonalDetalle': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->mostrarMenuRegistro();
                    break;
                }
            case 'obtenerIdEmpleado': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->mostrarIdEmpleado($parametros['p2']);
                    break;
                }
            case 'llenarExpLab': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->llenarExpLab();
                    break;
                }
            case 'llenarEstudiosSup': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->llenarEstudiosSup($parametros['p2']);
                    break;
                }
            case 'listaTipo': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $codTipo = $parametros["p2"];
                    $codInst = $parametros["p3"];
                    $disabled = $parametros["p4"];
                    $resultado = $o_ActionRrhh->listaEstudios($codTipo, $codInst, $disabled);
                    break;
                }
            case 'listaProf': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $codProf = $parametros["p2"];
                    $codEsp = $parametros["p3"];
                    $disabled = $parametros["p4"];
                    $resultado = $o_ActionRrhh->listaProfesiones($codProf, $codEsp, $disabled);
                    break;
                }
            case 'llenarInstitucion': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->llenarInstitucion($parametros['p2']);
                    break;
                }
            case 'llenarIdiomas': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->llenarIdiomas('');
                    break;
                }
            case 'llenarInvestigacion': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->llenarInvestigacion();
                    break;
                }
            case 'llenarConocimientos': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->llenarConocimientos($parametros['p2']);
                    break;
                }
            case 'llenarLogros': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->llenarLogros();
                    break;
                }
            case 'llenarReferencias': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->llenarReferencias();
                    break;
                }
            case 'llenarLegajo': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->llenarLegajo();
                    break;
                }
            case 'mostrarcv': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->preMostrarCV($parametros["p2"]);
                    break;
                }
            case 'adjuntarOtroFile': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->adjuntarOtroFile($parametros["p2"]);
                    break;
                }
            case 'adjuntarFotoOdontograma': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["Id"] = $parametros['p2'];
                    $resultado = $o_ActionActoMedico->adjuntarFotoOdontograma($datos);
                    break;
                }
            case 'abrirPopadVisorImagen': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["url"] = $parametros['p2'];
                    $datos["rotacion"] = $parametros['p3'];
                    $datos["numero"] = $parametros['p4'];
                    $datos["margin"] = $parametros['p5'];
                    $resultado = $o_ActionActoMedico->abrirPopadVisorImagen($datos);
                    break;
                }


            case 'cerrarAntecedenteOdontograma': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["IdHistoriaDiente"] = $parametros['p2'];
                    $resultado = $o_ActionActoMedico->cerrarAntecedenteOdontograma($datos);
                    break;
                }
            case 'cambiaraEstadoImagenesVersionesAnteriores': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["IdHistoriaDiente"] = $parametros['p2'];
                    $resultado = $o_ActionActoMedico->cambiaraEstadoImagenesVersionesAnteriores($datos);
                    break;
                }




            case 'quitarImagen': {

                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["ruta"] = $parametros['p2'];
                    $resultado = $o_ActionActoMedico->quitarImagen($datos);
                    break;
                }




            case 'mostrarExpLaboral': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->tabListaExpLaboral($parametros['p2']);
                    break;
                }
            case 'mostrarEstudiosSup': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->tabListaEstudiosSup($parametros['p2']);
                    break;
                }
            case 'mostrarIdiomas': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->tabListaIdiomas($parametros['p2']);
                    break;
                }
            case 'mostrarConocimientos': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->tabListaConocimientos($parametros['p2']);
                    break;
                }
            case 'mostrarInvestigacion': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->tabListaInvestigacion($parametros['p2']);
                    break;
                }
            case 'mostrarLogros': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->tabListaLogros($parametros['p2']);
                    break;
                }
            case 'mostrarReferencias': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->tabListaReferencias($parametros['p2']);
                    break;
                }

            case 'mostrarLegajoModificado': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    header("Content-type: text/xml");
                    $resultado = $o_ActionRrhh->tabListaLegajo($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'mostrarLegajo': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->tabListaLegajo($parametros['p2'], $parametros['p3']);
                    break;
                }


            case 'expLaboralDetalle': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();

                    $resultado = utf8_encode($o_ActionRrhh->detalleExpLaboral($parametros['p2'], $parametros['p3']));
                    break;
                }
            case 'accionExpLaboral': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->accionExpLaboral($parametros['p2'], $parametros['p3'], $parametros['p4'], $parametros['p5'], $parametros['p6'], $parametros['p7'], $parametros['p8'], $parametros['p9'], $parametros['p10'], $parametros['p11'], $parametros['p12'], $parametros['p13'], $parametros['p14'], $parametros['p15']);
                    break;
                }

            case 'accionAtributo': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->accionLegajo($parametros['p2'], $parametros['p3'], $parametros['p4'], $parametros['p5'], $parametros['p6']);
                    break;
                }

            case 'ventanaActualizaEntregaDeDocumentos': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->ventanaActualizaEntregaDeDocumentos($parametros['p2'], $parametros['p3'], $parametros['p4'], $parametros['p5']);
                    break;
                }
            case 'grabarEntregaDocumento': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->grabarEntregaDocumento($parametros['p2'], $parametros['p3'], $parametros['p4'], $parametros['p5'], $parametros['p6']);
                    break;
                }


            case 'puestosCCostos': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->aPuestosCCostos();
                    break;
                }
            case 'detallePuestoCentroCosto': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->adetallePuestoCentroCosto($parametros['p2']);
                    break;
                }
            case 'serviciosXpuestos': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $o_ActionRrhh->generaArbolServicios();
                    break;
                }
            case 'cargarPuestos_serviciosXpuestos' : {

                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["idCCostos"] = $parametros['p2'];
                    $resultado = $o_ActionRrhh->listadoPuestosdeTrabajo($datos);
                    break;
                }
            case 'cargarServicios_serviciosXpuestos' : {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    if ($parametros['p2'] == '' && $parametros['p3'] == '')
                        $resultado = $o_ActionRrhh->listadoServiciosAsignados('');
                    else {
                        $datos["idCCostos"] = $parametros['p2'];
                        $datos["idPuestos"] = $parametros['p3'];
                        $resultado = $o_ActionRrhh->listadoServiciosAsignados($datos);
                    }
                    break;
                }
            case 'cargarServiciosxAsignar' : {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["idCCostos"] = $parametros['p2'];
                    $datos["idPuesto"] = $parametros['p3'];
                    $resultado = $o_ActionRrhh->listadoServiciosparaAsignar($datos);
                    break;
                }
            case 'grabarAsignacionServicioaPuesto' : {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["idServicio"] = $parametros['p2'];
                    $datos["idPuesto"] = $parametros['p3'];
                    $resultado = $o_ActionRrhh->grabarAsignacionServicioaPuesto($datos);
                    break;
                }
            case 'activaryDesactivarAsignacionServicioaPuesto' : {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["idServicio"] = $parametros['p2'];
                    $datos["idPuesto"] = $parametros['p3'];
                    $resultado = $o_ActionRrhh->activaryDesactivarAsignacionServicioaPuesto($datos);
                    break;
                }
            case 'eliminarAsignacionServicioaPuesto' : {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["idServicio"] = $parametros['p2'];
                    $datos["idPuesto"] = $parametros['p3'];
                    $resultado = $o_ActionRrhh->eliminarAsignacionServicioaPuesto($datos);
                    break;
                }
            case 'mantenimientoEspecialidadProfesion': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->mantenimientoEspecialidadProfesion();
                    break;
                }
            case 'buscarProfesiones': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->buscarProfesiones($parametros['p2']);
                    break;
                }
            case 'profesionDetalle': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->profesionDetalle($parametros['p2']);
                    break;
                }
            case 'buscarEspecialidades': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->buscarEspecialidades($parametros['p2']);
                    break;
                }
            case 'ventanaAgregaProfesion': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->ventanaAgregaProfesion();
                    break;
                }
            case 'grabarProfesion': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->grabarProfesion($parametros['p2']);
                    break;
                }
            case 'ventanaAgregarEspecialidad': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->ventanaAgregarEspecialidad($parametros['p2']);
                    break;
                }
            case 'buscarEspecialidad': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->buscarEspecialidad($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'grabarEspecialidad': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->grabarEspecialidad($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'eliminarEspecialidad': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->eliminarEspecialidad($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'ventanaEditarEspecialidad': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->ventanaEditarEspecialidad($parametros['p2'], $parametros['p3'], $parametros['p4']);
                    break;
                }
            case 'editarEspecialidad': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->editarEspecialidad($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'editarProfesion': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->editarProfesion($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'desactivarProfesion': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->desactivarProfesion($parametros['p2']);
                    break;
                }
            case 'activarProfesion': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->activarProfesion($parametros['p2']);
                    break;
                }
            case 'desactivarCoordinadorAlArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->desactivarCoordinadorAlArea($parametros['p2']);
                    break;
                }
            case 'actualizarDescripcionCeseCoordinador': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["hiIdEncargadoProgramacionPersonal"] = $parametros['p2'];
                    $datos["motivoCese"] = $parametros['p3'];
                    $resultado = $o_ActionRrhh->actualizarDescripcionCeseCoordinador($datos);
                    break;
                }
            case 'asignarNuevoCoordinador': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["hidSedeempresaArea"] = $parametros['p2'];
                    $datos["IdNuevoCoordinadorAsignado"] = $parametros['p3'];
                    $datos["fechaIni"] = $parametros['p4'];
                    $datos["fechaFin"] = $parametros['p5'];
                    $resultado = $o_ActionRrhh->asignarNuevoCoordinador($datos);
                    break;
                }
            case 'mantenimientoPuestoDocumento': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->mantenimientoPuestoDocumento();
                    break;
                }

            case 'puestosBusquedaDoc': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["idCCostos"] = $parametros['p2'];
                    $datos["puesto"] = $parametros['p3'];
                    $datos["categoria"] = $parametros['p4'];
                    $datos["estado"] = $parametros['p5'];
                    $datos["funcion"] = $parametros['p6'];
                    $resultado = $o_ActionRrhh->puestosBusquedaDoc($datos);
                    break;
                }

            case 'documentoDetalle': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->puestoDocumento($parametros['p2']);
                    break;
                }

            case 'eliminarDocumentoPto': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->eliminarDocumentoPto($parametros['p2']);
                    break;
                }
            case 'agregarDocumentoPuesto': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->agregarDocumentoPuesto($parametros['p2']);
                    break;
                }
            case 'grabarDocumentoPto': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->grabarDocumentoPto($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'mantenimientoDocumento': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->mantenimientoDocumento();
                    break;
                }
            case 'buscarDocumentos': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->buscarDocumentos($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'buscadorDocumento': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $parametros['funcionDocumento'] = $parametros['p2'];
                    $resultado = $o_ActionRrhh->buscadorDocumentos($parametros);
                    break;
                }
            case 'documentosDetalle': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->documentoDetalle($parametros['p2']);
                    break;
                }
            case 'buscarAtributos': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->buscarAtributos($parametros['p2']);
                    break;
                }
            case 'ventanaAgregaDocumento': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->ventanaAgregaDocumento();
                    break;
                }
            case 'grabarDocumento': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->grabarDocumento($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'ventanaAgregarAtributo': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->ventanaAgregarAtributo($parametros['p2']);
                    break;
                }
            case 'buscarAtributo': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->buscarAtributo($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'grabarAtributo': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->grabarAtributo($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'eliminarAtributo': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->eliminarAtributo($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'ordenarAtributo': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->ordenarAtributo($parametros['p2'], $parametros['p3'], $parametros['p4'], $parametros['p5']);
                    break;
                }
            case 'editarDocumento': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->editarDocumento($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'eliminarDocumento': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->eliminarDocumento($parametros['p2']);
                    break;
                }
            case 'activarDocumento': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->activarDocumento($parametros['p2']);
                    break;
                }
            case 'lista_especialidad': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->sp_lista_especialidad($parametros['p2'], '%');
                    break;
                }
            case 'lista_especialidad_cco': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->sp_lista_especialidad_cco($parametros['p2'], '');
                    break;
                }
            case 'ListaPersonaCitas': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->ListaPersonaCitas($parametros["p2"]);
                    break;
                }
            case 'mostrar_datos_empleado_rrhh_nuevo': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $funcion = $parametros["funcionJSEjecutar"];
                    $resultado = $o_ActionRrhh->formRegistroEmpleadoNuevo(trim($parametros["p2"]), $funcion);
                    break;
                }
            case 'mostrar_consulta_paciente_rrhh': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $funcion = $parametros["funcionJSEjecutar"];
                    $resultado = $o_ActionRrhh->formConsultaPersonas(trim($parametros["p2"]), $funcion);
                    break;
                }
            case 'buscarPersonas': {
                    require_once("ActionPersona.php");
                    $o_ActionPersona = new ActionPersona();
                    $resultado = "<table width='100%'>" . $o_ActionPersona->obtenerPersonas(base64_decode($parametros["p2"]), $parametros["p3"], $parametros["p4"], $parametros["p5"], $parametros["p6"]) . "<table>";
                    break;
                }
            case 'getBuscarPersonaCompleto': {
                    require_once("ActionPersona.php");
                    $o_ActionPersona = new ActionPersona();
                    $datos['iCodigoPersona'] = $parametros['p2'];
                    $resultado = $o_ActionPersona->aDatosPersonaCompleto($datos);
                    break;
                }



            case 'buscarMedicos': {
                    require_once("ActionPersona.php");
                    $o_ActionPersona = new ActionPersona();
                    $datos["apellidoPaterno"] = $parametros["p2"];
                    $datos["apellidoMaterno"] = $parametros["p3"];
                    $datos["nombres"] = $parametros["p4"];
                    $datos["funcionMedicos"] = $parametros["p5"];
                    $resultado = $o_ActionPersona->obtenerMedicos($datos);
                    break;
                }

            /*
              case 'buscarMedicos': {
              require_once("ActionPersona.php");
              $o_ActionPersona = new ActionPersona();
              $resultado = "<table width='100%' id='xxx'" . $o_ActionPersona->obtenerMedicos($parametros["p2"], $parametros["p3"], $parametros["p4"], $parametros["p5"]) . "<table>";
              break;
              }
             */
            case 'buscarMedicosGeneral': {
                    require_once("ActionPersona.php");
                    $o_ActionPersona = new ActionPersona();
                    $resultado = "<table width='100%'>" . $o_ActionPersona->obtenerMedicosGeneral($parametros["p2"], $parametros["p3"], $parametros["p4"], $parametros["p5"]) . "<table>";
                    break;
                }
            case 'ejecutaFuncion': {
                    require_once("ActionPersona.php");
                    $o_ActionPersona = new ActionPersona();
                    $resultado = "";
                    break;
                }
            case 'validatePassword': {//Actualiza contraseóa de usuario
                    require_once("ActionUsuario.php");
                    $o_ActionUsuario = new ActionUsuario();
                    $resultado = $o_ActionUsuario->validatePassword($parametros);
                    break;
                }
            case 'updatePassword': {
                    require_once("ActionUsuario.php");
                    $o_ActionUsuario = new ActionUsuario();
                    $resultado = $o_ActionUsuario->updatePassword($parametros);
                    break;
                }
            case 'acercade': {//muestra la ventana Acerca de...
                    require_once '../../cvista/acercade/acercade.php';
                    break;
                }
            case 'cerrarSesion': {//mata la sesion...
                    require_once("ActionSesion.php");
                    $o_ActionSesion = new ActionSesion();
                    $resultado = $o_ActionSesion->cerrarSesion($parametros);
                    break;
                }
            case 'actualizarSesion': {//mata la sesion...
                    require_once("ActionSesion.php");
                    $o_ActionSesion = new ActionSesion();
                    $resultado = $o_ActionSesion->actualizarSesion($parametros);
                    ;
                    break;
                }
            case 'registroDatosPacientes': {
                    require_once '../../cvista/admision/registro_personas_busqueda.php';
                    break;
                }
            case 'programacionCitasInformes': {
                    $datos = array();
                    $datos["codigoCentroCosto"] = $parametros["p2"];
                    $datos["funcionEjecutar"] = 'filtro_sede()';
                    $datos["ip"] = $_SESSION["ip"];
                    require_once '../../cvista/cita/citas.php';
                    break;
                }
            case 'programacionCitasInformesPeche': {
                    $datos = array();
                    $datos["codigoCentroCosto"] = $parametros["p2"];
                    $datos["ancho"] = $parametros["p3"] - 60;
                    $datos["alto"] = $parametros["p4"] - 75;
                    $datos["funcionEjecutar"] = 'filtro_sede()';
                    $datos["ip"] = $_SESSION["ip"];
                    require_once '../../cvista/cita/citas_peche.php';
                    break;
                }
            case 'mantAmbientesLogicos': {
                    require_once '../../cvista/mantenimientogeneral/ambientesLogicos.php';
                    break;
                }
            case 'generarComboHastaMenorseis': {
                    $cadena = $parametros['p4'] . ',"' . $parametros['p5'] . '"';
                    $resultado = "<select id='cbxHasta' style='width:50px;height:25px;font-family: verdana;font-size: 16px;' onChange='cargarGraficoHistoriaTriajeDestrucTor(" . $cadena . ")'>";
                    for ($z = $parametros["p2"]; $z <= $parametros["p3"]; $z++) {
                        $resultado.= '<option value="' . $z . '">' . $z . '</option>';
                    }
                    $resultado.='</select>';
                    break;
                }
            case 'generarComboHastaMayoresseis': {
                    $cadena = $parametros['p4'] . ',"' . $parametros['p5'] . '"';
                    $resultado = "<select id='cbxHasta' style='width:50px;height:25px;font-family: verdana;font-size: 16px;' onChange='cargarGraficoHistoriaTriajeDestrucTor(" . $cadena . ")'>";
                    for ($z = $parametros["p2"]; $z <= $parametros["p3"]; $z++) {
                        $resultado.= '<option value="' . $z * 12 . '">' . $z . '</option>';
                    }
                    $resultado.='</select>';
                    break;
                }


            case 'vReporteHistoricoTriajePaciente': {

                    $datos["iNumeroReporte"] = $parametros["p2"];
                    $datos["vReporte"] = $parametros["p3"];
                    $datos["iCodigoPaciente"] = $parametros["p4"];
                    $datos["dFechaNacimiento"] = $parametros["p5"];
                    require_once '../../cvista/actomedico/vReporteHistoricoTriajePaciente.php';
                    break;
                }

            case 'manteTriaje': {//Guarda nuevo triaje de paciente en su programación
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $resultado = $o_ActionCita->manteTriaje($parametros);
                    break;
                }
            case 'verCronogramaMedicoMensuales': {
                    require_once("ActionPersona.php");
                    $o_ActionPersona = new ActionPersona();
                    $resultado = "<table width='100%'>" . $o_ActionPersona->obtenerCronogramaMensual($parametros["p2"], $parametros["p3"]) . "<table>";
                    break;
                }
            case 'verdatosMedicoCronogramaMensual': {
                    require_once("ActionPersona.php");
                    $o_ActionPersona = new ActionPersona();
                    $datos["codigoMedico"] = $parametros["p2"];
                    $resultado = $o_ActionPersona->obtenerDatosMedicoCronogramaMensual($datos);
                    break;
                }


            case 'programacionMedicos': {
                    $datos = array();
                    $datos["codigoCentroCosto"] = '';
                    $datos["funcionEjecutar"] = '';
                    $datos["ip"] = $_SESSION["ip"];
                    require_once '../../cvista/programacion/programacionMedicos.php';
                    break;
                }


            //MODULO MANTENIMIENTO DE MODULOS POR SERVICIO//
            //CREADO POR ANGEL AUGUSTO SAYES MALPARTIDA (ALIAS EL HABLADOR) 17-01-2013//

            case 'cargarVistaMantenimientoModuloPorServicios': {
                    require_once '../../cvista/actomedico/cargarVistaMantenimientoModuloPorServicios.php';
                    break;
                }


            case 'cargarMantenimientoModulosAfiliacion': {
                    require_once '../../cvista/actomedico/cargarMantenimientoModulosAfiliacion.php';
                    break;
                }



            case 'filtrarServicios': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["servicio"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->cargarTablaServicios($datos);
                    break;
                }




            case 'filtrarAfiliacioanManteni': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["afiliaciones"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->cargarTablaAfiliaciones($datos);
                    break;
                }

            case 'cargarMantenimientoAfiliacionesModulo': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["idAfiliacion"] = $parametros["p2"];
                    $cb_comboModuloAsiganados = $o_ActionActoMedico->obtenerlistaAsignadasAFiliacion($datos);
                    $cb_comboModuloNoAsiganados = $o_ActionActoMedico->obtenerlistaANoAsignadasAfiliacion($datos);
                    require_once '../../cvista/actomedico/cargarMantenimientoModulosPorAfiliacion.php';
                    break;
                }








            case 'cargarMantenimiento': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["idServicio"] = $parametros["p2"];
                    $cb_comboModuloAsiganados = $o_ActionActoMedico->obtenerlistaAsignadas($datos);
                    $cb_comboModuloNoAsiganados = $o_ActionActoMedico->obtenerlistaANoAsignadas($datos);
                    require_once '../../cvista/actomedico/cargarMantenimiento.php';
                    break;
                }

            case 'eliminarAnterioresSeleccionados': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["idServicio"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->eliminarAnterioresSeleccionados($datos);
                    break;
                }
            case 'eliminarAnterioresSeleccionadosAfiliaciones': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["iIdAfiliacion"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->eliminarAnterioresSeleccionadosAfiliaciones($datos);
                    break;
                }

            case 'guardarNuevaSeleccion': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["cadena"] = $parametros["p2"];
                    $datos["idServicio"] = $parametros["p3"];
                    $datos["numero"] = $parametros["p4"];
                    $resultado = $o_ActionActoMedico->guardarNuevaSeleccion($datos);
                    break;
                }

            case 'guardarNuevaSeleccionAfiliaciones': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["cadena"] = $parametros["p2"];
                    $datos["iIdAfiliacion"] = $parametros["p3"];
                    $datos["numero"] = $parametros["p4"];
                    $resultado = $o_ActionActoMedico->guardarNuevaSeleccionAfiliaciones($datos);
                    break;
                }





            ////////////////////////////////////////////////////////////////////////////
            case 'comboCategorias': {
                    require_once("ActionLogistica.php");
                    $o_ActionLogistica = new ActionLogistica();
                    $resultado = $o_ActionLogistica->comboCategorias();
                    break;
                }
            case 'comboAfiliaciones': {
                    require_once("ActionLogistica.php");
                    $o_ActionLogistica = new ActionLogistica();
                    $resultado = $o_ActionLogistica->comboAfiliaciones();
                    break;
                }
            case 'filtrotextoProducto': {
                    require_once("ActionLogistica.php");
                    header("Content-type: text/xml");
                    $o_ActionLogistica = new ActionLogistica();
                    $resultado = $o_ActionLogistica->listaProductos($parametros['p2']);

                    break;
                }
            case 'cargarPreciosServiciosyProductos': {
                    require_once("ActionLogistica.php");
                    header("Content-type: text/xml");
                    $o_ActionLogistica = new ActionLogistica();
                    $resultado = $o_ActionLogistica->cargarPreciosServiciosyProductos($parametros['p2']);

                    break;
                }
            case 'mostrarDetalleAlmacen': {
                    header("Content-type: text/xml");
                    require_once("ActionLogistica.php");
                    $o_ActionLogistica = new ActionLogistica();
                    $resultado = $o_ActionLogistica->amostrarDetalleAlmacen($parametros['p2']);
                    break;
                }
            case 'mostrarCategorias': {
                    require_once("ActionLogistica.php");
                    header("Content-type: text/xml");
                    $o_ActionLogistica = new ActionLogistica();
                    $resultado = $o_ActionLogistica->listaCategoriasActiva();
                    break;
                }
            case 'mostrarProductos': {
                    require_once("ActionLogistica.php");
                    header("Content-type: text/xml");
                    $o_ActionLogistica = new ActionLogistica();
                    $resultado = $o_ActionLogistica->listaProductos($parametros['p2'], $parametros['p3'], $parametros['p4']);
                    break;
                }
            case 'getMedicosdhtmlx': {
                    header("Content-type: text/xml");
                    require_once("ActionPersona.php");
                    $datos["apellidoPaterno"] = $parametros['p2'];
                    $datos["apellidoMaterno"] = $parametros['p3'];
                    $datos["nombres"] = $parametros['p4'];
                    $o_ActionPersona = new ActionPersona();
                    $resultado = $o_ActionPersona->getMedicosdhtmlx($datos);
                    break;
                }


            case 'generacionOrdenes': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $datos["codCaja"] = $_SESSION["iIdCaja"];
                    // $hdnNumDocAperturadosHoy = 0;
                    // $hdnNumDocAperturadosHoy = $o_ActionOrden->verificarCajaAperturada($datos);
                    require_once '../../cvista/tesoreria/generacion_ordenes.php';
                    $resultado = "";
                    break;
                }
            case 'mostrarMenuUsuario': {
                    require_once("ActionUsuario.php");
                    $o_ActionUsuario = new ActionUsuario();
                    $resultado = $o_ActionUsuario->mostrarMenuUsuario($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'crearUsuario': {
                    require_once("ActionUsuario.php");
                    $o_ActionUsuario = new ActionUsuario();
                    $resultado = $o_ActionUsuario->crearUsuario($parametros['p2'], $parametros['p3'], $parametros['p4']);
                    break;
                }
            case 'listaPerfilesXUsuario': {
                    require_once("ActionUsuario.php");
                    header("Content-type: text/xml");
                    $o_ActionUsuario = new ActionUsuario();
                    $resultado = $o_ActionUsuario->listaPerfilesXUsuario($parametros['p2']);
                    break;
                }

            case 'listaFormulariosXPerfilXUsuario': {
                    require_once("ActionUsuario.php");
                    header("Content-type: text/xml");
                    $o_ActionUsuario = new ActionUsuario();
                    $resultado = $o_ActionUsuario->listaFormulariosXPerfilXUsuario($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'listaServiciosXFormulariosXPerfilXUsuario': {
                    require_once("ActionUsuario.php");
                    header("Content-type: text/xml");
                    $o_ActionUsuario = new ActionUsuario();
                    $resultado = $o_ActionUsuario->listaServiciosXFormulariosXPerfilXUsuario($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'modificarUsuario': {
                    require_once("ActionUsuario.php");
                    $o_ActionUsuario = new ActionUsuario();
                    $resultado = $o_ActionUsuario->modificarUsuario($parametros['p2'], $parametros['p3']);
                    break;
                }

            case 'modificarActividad': {
                    require_once("ActionUsuario.php");
                    $o_ActionUsuario = new ActionUsuario();
                    $resultado = $o_ActionUsuario->modificarActividad($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'mantAmbientesFisicos': {
                    require_once '../../cvista/mantenimientogeneral/ambientesFisicos.php';
                    break;
                }
            case 'comboEmpresas': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $codEmpresa = $parametros["p2"];
                    $codSede = $parametros["p3"];
                    $disabled = '';
                    $resultado = $o_ActionMantenimientoGeneral->listaDatosEmpresa($codEmpresa, $codSede, $disabled);
                    break;
                }
            case 'MantenimientoCIEGrupoEtareo': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    require_once '../../cvista/mantenimientogeneral/MantenimientoCIEGrupoEtareo.php';

                    break;
                }
            case 'verListaDeCiePorGrupoEtareo': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $iIdGrupoEtareo = $parametros["p2"];
                    $resultado = $o_ActionMantenimientoGeneral->verListaDeCiePorGrupoEtareo($iIdGrupoEtareo);

                    break;
                }

            case 'buscarCieListado': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $nombreCie = $parametros["p2"];
                    $resultado = $o_ActionMantenimientoGeneral->buscarCieListado($nombreCie);

                    break;
                }

            case 'agregarCIEaGrupoEtareo': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos['idCie'] = $parametros["p2"];
                    $datos['idGrupoEtareo'] = $parametros["p3"];
                    $resultado = $o_ActionMantenimientoGeneral->agregarCIEaGrupoEtareo($datos);
                    break;
                }
            case 'cambiarEstadoCieGrupoEtareo': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos['idCie'] = $parametros["p2"];
                    $datos['idGrupoEtareo'] = $parametros["p3"];
                    $resultado = $o_ActionMantenimientoGeneral->cambiarEstadoCieGrupoEtareo($datos);
                    break;
                }


            case 'listaAmbientesFisicos': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $idSedeEmpresa = $parametros["p2"];
                    $nomAmbienteFisico = "";
                    $resultado = $o_ActionMantenimientoGeneral->listaAmbientesFisicos($idSedeEmpresa, $nomAmbienteFisico);
                    break;
                }
            case 'manteAmbienteFisico': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $resultado = $o_ActionMantenimientoGeneral->manteAmbienteFisico($parametros);
                    break;
                }
            case 'listaAmbFisicoxServBasico': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $codAmbienteFisico = $parametros["p2"];
                    $nomServicioBasico = $parametros["p3"];
                    $resultado = $o_ActionMantenimientoGeneral->listaAmbFisicoxServBasico($codAmbienteFisico, $nomServicioBasico);
                    break;
                }
            case 'habServBasicoDeAmbFisico': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $resultado = $o_ActionMantenimientoGeneral->spHabServBasicoDeAmbFisico($parametros);
                    break;
                }
            case 'manteCamaxAmbFisico': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $resultado = $o_ActionMantenimientoGeneral->manteCamaxAmbienteFisico($parametros);
                    break;
                }
            case 'listaCamaxAmbFisico': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $codAmbienteFisico = $parametros["p2"];
                    $descCama = "%";
                    $resultado = $o_ActionMantenimientoGeneral->listaCamaxAmbFisico($codAmbienteFisico, $descCama);
                    break;
                }
            case 'habCamaDeAmbFisico': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $resultado = $o_ActionMantenimientoGeneral->spHabCamaDeAmbFisico($parametros);
                    break;
                }
            case 'menuMantTurnos': {
                    require_once '../../cvista/mantenimientogeneral/turnos.php';
                    break;
                }

            case 'cargarTablaTurno': {
                    header("Content-type:text/xml");
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $descTurno = $parametros["p2"];
                    $resultado = $o_ActionMantenimientoGeneral->listaTurnoL($descTurno);
                    break;
                }


            case 'cargarPopadTurnosTabla': {
                    require_once '../../cvista/mantenimientogeneral/manteTurno.php';
                    break;
                }
            case 'PopadAfiliacionesXMedico': {
                    require_once '../../cvista/programacion/PopadAfiliacionesXMedico.php';
                    break;
                }


            case 'listaTurno': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $descTurno = $parametros["p2"];
                    $resultado = $o_ActionMantenimientoGeneral->listaTurno($descTurno);
                    break;
                }
            case 'manteTurno': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $resultado = $o_ActionMantenimientoGeneral->manteTurno($parametros);
                    break;
                }
            case 'acreditaEssalud': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->acreditacionEssalud();
                    break;
                }
            case 'acreditarPersonas': {
                    require_once("ActionAdmision.php");
                    header("Content-type:text/xml");
                    $o_ActionAdmision = new ActionAdmision();
                    $datos = array();
                    $datos["tipoBusqueda"] = $parametros["p2"];
                    $datos["dni"] = $parametros["p3"];
                    $datos["apellidoPaterno"] = $parametros["p4"];
                    $datos["apellidoMaterno"] = $parametros["p5"];
                    $datos["primerNombre"] = $parametros["p6"];
                    $datos["segundoNombre"] = $parametros["p7"];
                    $datos["departamento"] = $parametros["p8"];
                    $datos["provincia"] = $parametros["p9"];
                    $datos["distrito"] = $parametros["p10"];
                    $datos["adscripciondepartamental"] = $parametros["p11"];
                    $resultado = $o_ActionAdmision->acreditarBusqueda($datos);
                    break;
                }
            case 'verDatosEssalud': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $dni = $parametros["p2"];
                    $resultado = $o_ActionAdmision->verDatosEssalud($parametros);
                    break;
                }
            case 'pruebaEssalud': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $mascaraSubRedSedeEmpresa = "192.168.31";
                    $resultado = $o_ActionAdmision->getArrayConexionesActivasEssalud($mascaraSubRedSedeEmpresa);
                    break;
                }
            case 'obtenerCoincidencias': {
                    require_once("ActionPersona.php");
                    $o_ActionPersona = new ActionPersona();
                    $resultado = $o_ActionPersona->aObtenerCoincidencias($parametros["p2"], $parametros["p3"], $parametros["p4"], $parametros["p5"], $parametros["p6"], $parametros["p7"]);
                    break;
                }
            case 'verificarConexionEssalud': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->verificarConexionEssalud();
                    break;
                }
            case 'gravaPersonaEssalud': {
                    require_once("ActionAdmision.php");
                    require_once("ActionPersona.php");

                    $o_ActionPersona = new ActionPersona();
                    $o_ActionAdmision = new ActionAdmision();
                    $codigo = $o_ActionAdmision->MantenimientoPersonas($parametros);
                    $resultado = $o_ActionPersona->grabaTablaEssalud($codigo, $parametros);
                    $resultado = $o_ActionPersona->grabaEssalud($codigo, $parametros);
                    $resultado = $codigo;
                    break;
                }
            case 'actualizarTablaEssalud': {
                    require_once("ActionPersona.php");
                    $o_ActionPersona = new ActionPersona();
                    $resultado = $o_ActionPersona->actualizarTablaEssalud($parametros);
                    break;
                }
            case 'mostrarVentanaAcreditacionComplementaria': {
                    require_once("ActionAdmision.php");
                    $datos = array();
                    $datos["cadena"] = $parametros["p2"];
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->mostrarVentanaAcreditacionComplementaria($datos);
                    break;
                }
            case 'relacionaHmloEssalud': {
                    require_once("ActionPersona.php");
                    $o_ActionPersona = new ActionPersona();
                    $codigo = $parametros['codigo'];
                    $resultado = $o_ActionPersona->actualizaPersonasdesdeEssalud($codigo, $parametros);
                    if ($resultado == 'exitoso') {
                        $resultado = $o_ActionPersona->grabaTablaEssalud($codigo, $parametros);
                        if ($resultado == 'exitoso') {
                            $resultado = $o_ActionPersona->grabaEssalud($codigo, $parametros);
                            if ($resultado == 'exitoso') {
                                $resultado = "0|" . $codigo;
                            } else {
                                $resultado = "1|No se realizó la transferencia...verificar";
                            }
                        }
                    }
                    break;
                }
            case 'detalleAcredita': {
                    require_once("ActionPersona.php");
                    $o_ActionPersona = new ActionPersona();
                    $resultado = $o_ActionPersona->detalleAcredita($parametros['p2']);
                    break;
                }
            case 'filaEncontrada': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->filaEncontrada($parametros['p2'], $parametros['p3']);
                    break;
                }
            case 'ventanaVerAtenciones': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->ventanaVerAtenciones();
                    break;
                }
            case 'verAtencionesMedicas': {
                    require_once("ActionAdmision.php");
                    header("Content-type: text/xml");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->verAtencionesMedicas($parametros['p2']);
                    break;
                }
            case 'verDatosPaciente': {
                    require_once("ActionPersona.php");
                    $o_ActionPersona = new ActionPersona();
                    $resultado = $o_ActionPersona->verDatosPaciente($parametros['p2']);
                    break;
                }
            case 'mostrarManuales': {
                    require_once("ActionManual.php");
                    $o_ActionManual = new ActionManual();
                    $cadena = '1';  //1 activodos
                    $ruta_archivo = "../../../../carpetaDocumentos/arbol_manuales";
                    $resultado = $o_ActionManual->mostrarManual($cadena, $ruta_archivo);
                    break;
                }
            case 'mostrarArbolManualCompleto': {
                    require_once("ActionManual.php");
                    $o_ActionManual = new ActionManual();
                    $cadena = '2'; // todos activados y desactivados
                    $ruta_archivo = "../../../../carpetaDocumentos/arbol_manuales_completo";
                    $resultado = $o_ActionManual->mostrarManual($cadena, $ruta_archivo);
                    break;
                }
            case 'generarManual': {
                    require_once("ActionManual.php");
                    $o_ActionManual = new ActionManual();
                    $datos = array();
                    $datos["idManual"] = $parametros["iIdManual"];
                    $resultado = $o_ActionManual->generaManual($datos);
                    break;
                }
            case 'nuevoManual': {
                    require_once("ActionManual.php");
                    $o_ActionManual = new ActionManual();
                    $cboFormulario = $o_ActionManual->comboCodigoFormulario();
                    $idManual = '';
                    $idDependencia = '';
                    $jerarquia = '';
                    $titulo = '';
                    $estado = '3';
                    $contenido = '';
                    $orden = '';
                    $version = '';
                    $formulario = '';
                    $nivel = '';
                    $desc_padre = '';
                    $btnhabil = 1;
                    $btndeshabil = 0;
                    $btnPadre = 'visible';
                    require_once("../../cvista/manuales/nuevoManual.php");
                    break;
                }
            case 'editaManual': {
                    require_once("ActionManual.php");
                    $o_ActionManual = new ActionManual();
                    $codigo = $parametros["iIdManual"];
                    $resultado = $o_ActionManual->formRegistroManual($codigo);
                    break;
                }
            case 'nuevo_actualizarManual': {
                    require_once("ActionManual.php");
                    $o_ActionManual = new ActionManual();
                    $cadena = $parametros['p6'];
                    $cadena = str_replace("ó", "&", $cadena);
                    $datos = array();
                    $datos["p2"] = $parametros['p2'];
                    $datos["p3"] = $parametros['p3'];
                    $datos["p4"] = $parametros['p4'];
                    $datos["p5"] = $parametros['p5'];
                    $datos["p6"] = $cadena;
                    $datos["p7"] = $parametros['p7'];
                    $datos["p8"] = $parametros['p8'];
                    $datos["p9"] = $parametros['p9'];
                    $datos["p10"] = $parametros['p10'];
                    $datos["p11"] = $parametros['p11'];
                    $datos["p12"] = $parametros['p12'];
                    $info = $o_ActionManual->registrarManual($datos);
                    require_once("../../cvista/manuales/inicioManuales.php");
                    break;
                }
            case 'mostrarDatosManual': {
                    require_once("ActionManual.php");
                    $o_ActionManual = new ActionManual();
                    $resultado = $o_ActionManual->formManual($parametros["p2"]);
                    break;
                }
            case 'eliminaManual': {
                    require_once("ActionManual.php");
                    $o_ActionManual = new ActionManual();
                    $resultado = $o_ActionManual->eliminaManual($parametros["p2"]);
                    require_once("../../cvista/manuales/nuevoManual.php");
                    break;
                }
            case 'asignarPadre': {
                    require_once("ActionManual.php");
                    $o_ActionManual = new ActionManual();
                    $cadena = '1';  //1 activodos
                    $ruta_archivo = "../../../../carpetaDocumentos/arbol_manuales";
                    $resultado = $o_ActionManual->asignarPadre($cadena, $ruta_archivo);
                    break;
                }
            case 'capturaPadre': {
                    require_once("ActionManual.php");
                    $o_ActionManual = new ActionManual();
                    $codigo = $parametros["iIdManual"];
                    $resultado = $o_ActionManual->capturaPadre($codigo);
                    break;
                }

            case 'datosUsuario': {
                    require_once("ActionPersona.php");
                    $o_ActionPersona = new ActionPersona();
                    $resultado = $o_ActionPersona->datosUsuario();
                    break;
                }
            case 'codigoUsuario': {
                    require_once("ActionPersona.php");
                    $o_ActionPersona = new ActionPersona();
                    $resultado = $o_ActionPersona->codigoUsuario();
                    break;
                }

            case 'examenesFisicos': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $o_ActionActoMedico->examenesFisicos();
                    break;
                }
            case 'estadoDesarrollo': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->estadoDesarrollo($parametros["p2"]);
                    break;
                }

            case 'divExamenFisico': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    require_once("../../cvista/actomedico/asignarPadreExamenFisico.php");
                    break;
                }
            case 'asignarPadreFisico': {
                    require_once("ActionActoMedico.php");
                    header("Content-type:text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->asignarPadreFisico($parametros["p2"]);
                    break;
                }
            case 'arbolExamenFisico': {
                    require_once("ActionActoMedico.php");
                    header("Content-type:text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->arbolExamenFisico($parametros["p2"]);
                    break;
                }
            case 'llamadaPaciente': {
                    require_once("ActionLlamadaPaciente.php");
                    $o_ActionLlamadaPaciente = new ActionLlamadaPaciente();
                    $resultado = $o_ActionLlamadaPaciente->llamadaPaciente();
                    break;
                }
            case 'llamarCreacionMantPantallas': {
                    require_once("ActionLlamadaPaciente.php");
                    $o_ActionLlamadaPaciente = new ActionLlamadaPaciente();
                    $resultado = $o_ActionLlamadaPaciente->creaAccordionLlamadasPacientes();
                    break;
                }
            case 'mostrarTablaAmbientesFisicosxPantalla': {
                    require_once("ActionLlamadaPaciente.php");
                    $o_ActionLlamadaPaciente = new ActionLlamadaPaciente();
                    $datos = array();
                    $datos["codigopantalla"] = $parametros["p2"];
                    $resultado = $o_ActionLlamadaPaciente->mostrarTablaAmbientesFisicosxPantalla($datos);
                    break;
                }
            case 'proyectarPantalla': {
                    require_once("ActionLlamadaPaciente.php");
                    $o_ActionLlamadaPaciente = new ActionLlamadaPaciente();
                    $datos = array();
                    $_SESSION["codigopantalla"] = $parametros["p2"];
                    $resultado = $o_ActionLlamadaPaciente->proyectarPantalla();
                    break;
                }
            case 'capturaPadreExamenFisico': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["idExamen"] = $parametros["iIdExamen"];
                    $datos["idVersion"] = $parametros["idVersion"];
                    $resultado = $o_ActionActoMedico->capturaPadreEF($datos);
                    break;
                }
            case 'nuevo_actualizarExamenFisico': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["p1"] = $parametros['p2'];
                    $datos["p2"] = $parametros['p3'];
                    $datos["p3"] = $parametros['p4'];
                    $datos["p4"] = $parametros['p5'];
                    $datos["p5"] = $parametros['p6'];
                    $datos["p6"] = $parametros['p7'];
                    $datos["p7"] = $parametros['p8'];
                    $datos["p8"] = $parametros['p9'];
                    $datos["p9"] = $parametros['p10'];
                    $resultado = $o_ActionActoMedico->act_regExamenFisico($datos);
                    break;
                }
            case 'editaExamenFisico': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $codigo = $parametros["iIdExamen"];
                    $resultado = $o_ActionActoMedico->editaExamenFisico($codigo);
                    break;
                }
            case 'eliminaExamenFisico': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["idexamen"] = $parametros["p2"];
                    $datos["idversion"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->eliminaExamenFisico($datos);
                    break;
                }
            case 'verCola': {
                    require_once("ActionLlamadaPaciente.php");
                    $o_ActionLlamadaPaciente = new ActionLlamadaPaciente();
                    $resultado = utf8_encode($o_ActionLlamadaPaciente->verColas($parametros["p2"]));
                    break;
                }
            case 'pruebas_campos': {
                    require_once("../../cvista/actomedico/vistaPruebas.php");
                    break;
                }
            case 'resultado_prueba': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->resultado_prueba();
                    break;
                }

            case 'recuperarCombosCampos': {
                    require_once("ActionActoMedico.php");
                    $opcion = $parametros["p2"];
                    $o_ActionActoMedico = new ActionActoMedico();
                    if ($opcion == 'campo') {
                        $resultado = $o_ActionActoMedico->comboTipoCampo();
                    }
                    if ($opcion == 'estado') {
                        $resultado = $o_ActionActoMedico->comboEstado();
                    }
                    break;
                }
            case 'grabarPrueba': {
                    require_once("ActionActoMedico.php");
                    $datos = array();
                    $datos["p1"] = $parametros["p2"];
                    $datos["p2"] = $parametros["p3"];
                    $datos["p3"] = $parametros["p4"];
                    $datos["p4"] = $parametros["p5"];
                    $datos["p5"] = $parametros["p6"];
                    $o_ActionActoMedico = new ActionActoMedico();
                    $o_ActionActoMedico->grabarPrueba($datos);
                    $resultado = "";
                    break;
                }
            case 'datosPruebas': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->datosPruebas($parametros["p2"]);
                    break;
                }
            case 'buscarPrueba': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->buscarPrueba($parametros["p2"]);
                    break;
                }
            case 'act_desPrueba': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->act_desPrueba($parametros["p2"], $parametros["p3"]);
                    break;
                }
            case 'act_desExamen': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->act_desExamen($parametros["p2"], $parametros["p3"]);
                    break;
                }
            case 'act_desExamenPrueba': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->act_desExamenPrueba($parametros["p2"], $parametros["p3"]);
                    break;
                }
            case 'act_desExamenServicio': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->act_desExamenServicio($parametros["p2"], $parametros["p3"]);
                    break;
                }
            case 'editaCampos': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->editaCampos($parametros["p2"], $parametros["p3"]);
                    break;
                }
            case 'eliminarDbCampo': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $o_ActionActoMedico->eliminarDbCampo($parametros["p2"], $parametros["p3"]);
                    break;
                }
            case 'postEditaPrueba': {
                    $hidIdPrueba = $parametros["p2"];
                    $txtnomPrueba = $parametros["p3"];
                    $txtOrden = $parametros["p4"];
                    $stdPrueba = $parametros["p5"];
                    require_once("../../cvista/actomedico/nuevaPrueba.php");
                    break;
                }
            case 'abrirpaginaPrueba': {
                    $hidIdPrueba = "";
                    $hidIdPrueba = "";
                    $txtnomPrueba = "";
                    $txtOrden = "";
                    $stdPrueba = "";
                    require_once("../../cvista/actomedico/nuevaPrueba.php");
                    break;
                }
            case 'nuevoCombo': {
                    $idCombo = "";
                    $nomCombo = "";
                    $editarCombo = "no";
                    require_once("../../cvista/actomedico/nuevoCombo.php");
                    break;
                }
            case 'editarCombo': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $o_ActionActoMedico->editarCombo($parametros["p2"]);
                    break;
                }
            case 'eliminaDbCombo': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $o_ActionActoMedico->eliminaDbCombo($parametros["p2"], $parametros["p3"]);
                    break;
                }
            case 'asignarExamenPrueba': {
                    require_once("ActionActoMedico.php");
                    $datos = array();
                    $datos["idexamen"] = $parametros["p2"];
                    $datos["idprueba"] = $parametros["p3"];
                    $datos["idversion"] = $parametros["p4"];
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->asignarExamenPrueba($datos);
                    break;
                }
            case 'asignarExamenServicio': {
                    require_once("ActionActoMedico.php");
                    $datos = array();
                    $datos["idexamen"] = $parametros["p2"];
                    $datos["idservicio"] = $parametros["p3"];
                    $datos["idversion"] = $parametros["p4"];
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->asignarExamenServicio($datos);
                    break;
                }
            case 'datosExamenPrueba': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->selectExamenPrueba($parametros["p2"]);
                    break;
                }
            case 'datosExamenServicio': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->selectExamenServicio($parametros["p2"]);
                    break;
                }
            case 'selectCombo': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->selectCombo();
                    break;
                }
            case 'selectValorCombo': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->selectValorCombo($parametros["p2"]);
                    break;
                }
            case 'listaServicios': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->listaServicios();
                    break;
                }
            case 'antecedentes': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->antecedentes($parametros["p2"], $parametros["p3"]);
                    break;
                }
            case 'tablaCie': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    if (isset($parametros["p2"])) {
                        $nombreCie = $parametros["p2"];
                    } else {
                        $nombreCie = '';
                    }
                    if (isset($parametros["p3"])) {
                        $accion = $parametros["p3"];
                    } else {
                        $accion = '1';
                    }
                    $resultado = $o_ActionActoMedico->xmlTablaCie($nombreCie, $accion);
                    break;
                }
            case 'agregarAntecedente': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->agregarAntecedentes($parametros["p2"], $parametros["p3"], $parametros["p4"]);
                    break;
                }
            case 'preGrabarAntecedente': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->preGrabarAntecedente($parametros["p2"], base64_decode($parametros["p3"]), $parametros["p4"], $parametros["p5"], $parametros["p6"], $parametros["p7"]);
                    break;
                }
            case 'antecedentesPreguardados': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->antecedentesPreguardados($parametros["p2"]);
                    break;
                }
            case 'verAntecedentesAnteriores': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->verAntecedentesAnteriores($parametros["p2"]);
                    break;
                }
            case 'accionesVersion': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $hacer = $parametros['p2'];
                    $idVersion = $parametros['p3'];
                    if ($hacer == "pasardesarrollo") {
                        $resultado = $o_ActionActoMedico->clonarExamenes($idVersion);
                    } else if ($hacer == "pasarproduccion") {
                        $resultado = $o_ActionActoMedico->pasarProduccion($idVersion);
                    } else if ($hacer == "desactivarversion") {
                        $resultado = $o_ActionActoMedico->inactivarVersion($idVersion);
                    }
                    break;
                }


            case 'ventanaAccionesExamenes': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->ventanaAccionesExamenes($parametros);
                    break;
                }
            case 'verificarExisteDesarrollo': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->existeDesarrollo($parametros['p2']);

                    break;
                }

            case 'vistaPrevia': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->vistaPrevia($parametros["p2"], $parametros["p3"]);
                    break;
                }

            case 'preguardarExamenes': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    
                    $resultado = $o_ActionActoMedico->preguardarExamenes(base64_decode($parametros["p2"]), $parametros["p3"], $parametros["p4"], $parametros["p5"], $parametros["p6"], $parametros["p7"], $parametros["p8"]);
                    break;
                }
            case 'verHC': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->verHC($parametros["p2"]);
                    break;
                }
            case 'verHCReciente': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->verHCReciente($parametros["p2"]);
                    break;
                }
            case 'arbolHCFechas': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->arbolHCFechas($parametros["p2"]);
                    break;
                }
            case 'verHCxDia': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->verHCxDia($parametros["p2"]);
                    break;
                }
            case 'verHCxItemes': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->verHCxItemes($parametros["p2"], $parametros["p3"], $parametros["p4"]);
                    break;
                }
            case 'arbolHCItems': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->arbolHCItems();
                    break;
                }
            case 'obtenerCodigoPaciente': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->obtenerCodigoPaciente($parametros["p2"]);
                    break;
                }
            case 'cargarTablaLaboratorio': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $codPersona = $parametros["p2"];
                    $opcion = "";
                    $resultado = $o_ActionActoMedico->cargarTablaLaboratorio($codPersona, $opcion);
                    break;
                }
            case 'tablaLaboratorioHc': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $codPersona = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->tablaLaboratorioHc($codPersona);
                    break;
                }
            case 'DetalletablaLaboratorioHc': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $IdResult = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->DetalletablaLaboratorioHc($IdResult);
                    break;
                }
            case 'detalleLaboratorioExamenes': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $IdResult = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->detalleLaboratorioExamenes($IdResult);
                    break;
                }
            case 'cargarTablaLaboratorio_confiltro': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $codPersona = $parametros["p2"];
                    $datos = array();
                    $datos[0] = $parametros["fechaIni"];
                    $datos[1] = $parametros["fechaFin"];
                    $datos[2] = $parametros["dato"];
                    $datos[3] = $parametros["hacer"];
                    $resultado = $o_ActionActoMedico->cargarTablaLaboratorio_confiltro($codPersona, $datos);
                    break;
                }
            case 'detalleLaboratorio': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $idReult = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->detalleLaboratorio($idReult);
                    break;
                }
            case 'grabarCombo': {
                    require_once("ActionActoMedico.php");
                    $data = array();
                    $data["hacer"] = $parametros["p2"]; //parametro
                    $data["idcombo"] = $parametros["hididCombo"];
                    $data['nomcombo'] = $parametros["txtnomCombo"];
                    $data['texto'] = $parametros["txtTexto"]; //tipo array
                    $data['value'] = $parametros["txtValue"]; //tipo array
                    if ($parametros["p2"] == "modificar") {
                        $data['idvalcombo'] = $parametros["hidIdValCombo"]; //tipo array
                    }
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->grabarCombo($data);
                    break;
                }

            case 'grabarCampo': {
                    require_once("ActionActoMedico.php");
                    $data = array();
                    $hacer = $parametros["p3"];
                    $data['idprueba'] = $parametros["p2"];
                    $data['idcampo'] = $parametros["hidIdCampo"]; //tipo array
                    $data['idcombo'] = $parametros["hidIdCombo"]; //tipo array
                    $data['tipocampo'] = $parametros["cbTipoCampo"]; //tipo array
                    $data['nombrecampo'] = $parametros["txtNombreCampo"]; //tipo array
                    $data['orden'] = $parametros["txtOrden"]; //tipo array
                    $data['obligatorio'] = $parametros["bObligatorio"]; //tipo array
                    $data['estado'] = $parametros["cbEstado"]; //tipo array
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->grabarCampo($data, $hacer);
                    break;
                }
            case 'atencionInmediataActoMedico': {
                    require_once("ActionActoMedico.php");
                    $datos = array();
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["codigoProgramacion"] = $parametros["p2"];
                    $rs = $o_ActionActoMedico->atencionInmediataActoMedico($datos);
                    $resultado = utf8_encode($rs[0][0]);
                    break;
                }
            case 'tablaProductosTratamientosHC': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["parametronombre"] = $parametros["p2"];
                    $datos["ip"] = $_SESSION["ip"];
                    if (isset($parametros["p3"])) {
                        $accion = $parametros["p3"];
                    } else {
                        $accion = '2';
                    }
                    $datos["afiliacion"] = $parametros["p4"];
                    $resultado = $o_ActionActoMedico->xmlTablaProductosTratamientosHC($datos, $accion);
                    break;
                }
            case 'agregarMedicamentoHC' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["existe"] = $parametros["p2"];
                    $datos["nroReceta"] = $parametros["p3"];
                    $datos["nombreproducto"] = base64_decode($parametros["p4"]);
                    $datos["codigoProducto"] = $parametros["p5"];
                    $datos["presentacion"] = $parametros["p6"];
                    $datos["numeroProducto"] = $parametros["p7"];
                    $resultado = $o_ActionActoMedico->agregarMedicamentoRecetaMedicaHC($datos);
                    break;
                }
            case 'preguardarRectaMedica' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["iIdReceta"] = $parametros["p2"];
                    $datos["dFechaVencimiento"] = $parametros["p3"];
                    $datos["idTratamiento"] = $parametros["p4"];
                    $datos["c_cod_ser_pro"] = $parametros["p5"];
                    $datos["iCantidad"] = $parametros["p6"];
                    $datos["vModoAplicacion"] = base64_decode($parametros["p7"]);
                    $datos["tipoReceta"] = $parametros["p8"];
                    $datos["codigoProgramacion"] = $parametros["p9"];
                    $resultado = $o_ActionActoMedico->aPreguardarRectaMedica($datos);
                    break;
                }

            case 'eliminarMedicamentoRecetaMedicaHC' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["idTratamiento"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->eliminarMedicamentoRecetaMedicaHC($datos);
                    break;
                }
            case 'cargaFiliacionActoMedico': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigoProgramacion"] = $parametros["p2"];
                    $datos["codigoPaciente"] = $parametros["p3"];
                    $datos["codigoServicio"] = $parametros["p4"];
                    $resultado = $o_ActionActoMedico->obtenerDatosFiliacionActoMedico($datos);
                    break;
                }
            case 'cargaFechaVencimientoRecetaMedica' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigoProgramacion"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->cargaFechaVencimientoRecetaMedica($datos);
                    break;
                }
            case 'tablaPracticasMedicasTratamientosHC': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["parametronombre"] = $parametros["p2"];
                    if (isset($parametros["p3"])) {
                        $accion = $parametros["p3"];
                    } else {
                        $accion = '3';
                    }
                    $datos["afiliacion"] = $parametros["p4"];
                    $resultado = $o_ActionActoMedico->xmlTablaPracticasMedicasTratamientosHC($datos, $accion);
                    break;
                }
            case 'mostrarPreciosAtencionMedica' : {
                    $datos = array();
                    $datos["descripcionProductoServicio"] = $parametros["p2"];
                    require_once("../../cvista/actomedico/preciosproductosservicios.php");
                    break;
                }
            case 'obtenerPreciosAtencionMedica' : {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigoProducto"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->xmlTablapreciosProductosServicios($datos);
                    break;
                }
            case 'agregarPracticaMedicaHC' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["nombreservicio"] = base64_decode($parametros["p2"]);
                    $datos["numerodivpracticamedica"] = $parametros["p3"];
                    $datos["codigoservicio"] = $parametros["p4"];
                    $datos["idtratamiento"] = $parametros["p5"];
                    $datos["modoaplicacion"] = base64_decode($parametros["p6"]);
                    $datos["estadoregistro"] = $parametros["p7"];
                    $datos["codigosegus"] = $parametros["p8"];
                    $datos["estado"] = $parametros["p9"];
                    $datos["nombreServicionCPT"] = base64_decode($parametros["p10"]);

                    $resultado = $o_ActionActoMedico->agregarPracticaMedicaHC($datos);
                    break;
                }
            case 'cargarPaquetesActualizados' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["iIdGrupoEtareoPersonas"] = $parametros["p2"];
                    $datos["c_cod_per"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->cargarPaquetesActualizados($datos);
                    break;
                }
            case 'actualizarPaquetesPersona' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["iIdGrupoEtareoPersonas"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->actualizarPaquetesPersona($datos);
                    break;
                }
            case 'preGrabarTratatamientoMedicamentoso' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigomedicamento"] = $parametros["p2"];
                    $datos["observacion"] = base64_decode($parametros["p3"]);
                    $datos["codigoprogramacion"] = $parametros["p4"];
                    $datos["estadoregistro"] = $parametros["p5"];
                    $datos["idtratamientomedicamento"] = $parametros["p6"];
                    $datos["txtcantidad"] = $parametros["p7"];
                    $datos["codigodosis"] = $parametros["p8"];
                    $resultado = $o_ActionActoMedico->preGrabarTratamientoMedicamentoso($datos);
                    break;
                }
            case 'preguardarFechaVencimientoReceta' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigoprogramacion"] = $parametros["p2"];
                    $datos["txtfechavencimiento"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->preguardarFechaVencimientoReceta($datos);
                    break;
                }
            case 'preGrabarTratatamientoPracticaMedica' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigopracticamedica"] = $parametros["p2"];
                    $datos["observacion"] = base64_decode($parametros["p3"]);
                    $datos["codigoprogramacion"] = $parametros["p4"];
                    $datos["estadoregistro"] = $parametros["p5"];
                    $datos["idtratamientopracticamedica"] = $parametros["p6"];
                    $datos["estado"] = $parametros["p7"];
                    $resultado = $o_ActionActoMedico->preGrabarTratatamientoPracticaMedica($datos);
                    break;
                }
            case 'cargaTratamientosMedicamentososPreguardados' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigoprogramacion"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->cargaTratamientosMedicamentososPreguardados($datos);
                    break;
                }
            case 'duplicarReceta' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["idReceta"] = $parametros["p2"];
                    $datos["numeroReceta"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->aDuplicarReceta($datos);
                    break;
                }

            case 'cadenaRecetas' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigoProgramacion"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->aCadenaRecetas($datos);
                    break;
                }

            case 'cargaTratamientosPracticasMedicasPreguardados' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();

                    $datos = array();
                    $datos["codigoprogramacion"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->cargaTratamientosPracticasMedicasPreguardados($datos);
                    break;
                }
            case 'verTratamientosAnteriores' : {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigopaciente"] = $parametros["p2"];
                    $datos["tipotratamiento"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->cargaTratamientosAnteriores($datos);
                    break;
                }
            case 'mostrarVentanaTratamientoAnterior' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["idtratamiento"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->mostrarVentanaTratamientoAnterior($datos);
                    break;
                }
            case 'guardarAtencionMedicaHC' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigoProgramacion"] = $parametros["p2"];
                    $datos["proximacitasugerida"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->guardarAtencionMedicaHC($datos);
                    break;
                }
            case 'cambiarEstadoNoAtendido' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigoProgramacion"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->cambiarEstadoNoAtendido($datos);
                    break;
                }

            case 'anularPago': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigoProgramacion"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->anularPago($datos);
                    break;
                }
                
            case 'anularComprobantePago': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["iIdPago"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->anularComprobantePago($datos);
                    break;
                }    
            case 'desconfirmarCita' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigoProgramacion"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->aDesconfirmarCita($datos);
                    break;
                }

            case 'mostrarProgramacionSOP': {
                    require_once("ActionSOP.php");
                    $oActionSOP = new ActionSOP();
                    $resultado = $oActionSOP->mostrarProgramacionSOP();
                    break;
                }
            case 'mostrarTablaSolicitudesPendientesSOP': {
                    require_once("ActionSOP.php");
                    header("Content-type: text/xml");
                    $o_ActionSOP = new ActionSOP();
                    $accion = 1;
                    $token = "";
                    $resultado = $o_ActionSOP->mostrarTablaSolicitudesPendientesSOP($accion, $token);
                    break;
                }
            case 'mostrarTablaProgramacionesSOP': {
                    require_once("ActionSOP.php");
                    header("Content-type: text/xml");

                    $o_ActionSOP = new ActionSOP();
                    $accion = 1;
                    $token = "";
                    $resultado = $o_ActionSOP->mostrarTablaProgramacionesSOP($accion, $token);
                    break;
                }
            case 'mostrarTablaLeyendaSOP' : {
                    require_once("ActionSOP.php");
                    header("Content-type: text/xml");
                    $o_ActionSOP = new ActionSOP();
                    $resultado = $o_ActionSOP->mostrarTablaLeyendaSOP();
                    break;
                }
            case 'mostrarTablaControlInternoFarmaciaSOP' : {
                    require_once("ActionFarmacia.php");
                    header("Content-type: text/xml");
                    $o_ActionFarmacia = new ActionFarmacia();
                    $datos = array();
                    $datos["iidProgramacionSOP"] = $parametros["p2"];
                    $datos["codigopersona"] = $parametros["p3"];
                    $resultado = $o_ActionFarmacia->mostrarTablaControlInternoFarmaciaSOP($datos);
                    break;
                }
            case 'mostrarVentanaPaquetesFarmaceuticosCISOP' : {
                    require_once("../../cvista/programacion/sop/vistaPaquetesFarmaceuticosSOP.php");
                    break;
                }
            case 'mostrarTablaPaquetesFarmaceuticosCISOP' : {
                    require_once("ActionFarmacia.php");
                    header("Content-type: text/xml");
                    $o_ActionFarmacia = new ActionFarmacia();
                    $resultado = $o_ActionFarmacia->mostrarTablaPaquetesFarmaceuticosCISOP();
                    break;
                }
            case 'cargarPaqueteMedicamentosalPacienteFarmaciaCISOP' : {
                    require_once("ActionFarmacia.php");
                    $o_ActionFarmacia = new ActionFarmacia();
                    $datos = array();
                    $datos["iidProgramacionSOP"] = $parametros["p2"];
                    $datos["codigopaquetefarmaceuticoSOP"] = $parametros["p3"];
                    $datos["codigopersona"] = $parametros["p4"];
                    $resultado = $o_ActionFarmacia->cargarPaqueteMedicamentosalPacienteFarmaciaCISOP($datos);
                    break;
                }
            case 'cargarProductoalPacienteFarmaciaCISOP' : {
                    require_once("ActionFarmacia.php");
                    $o_ActionFarmacia = new ActionFarmacia();
                    $datos = array();
                    $datos["iidProgramacionSOP"] = $parametros["p2"];
                    $datos["codigoproducto"] = $parametros["p3"];
                    $datos["cantidadaentregar"] = $parametros["p4"];
                    $datos["codigopersona"] = $parametros["p5"];
                    $resultado = $o_ActionFarmacia->cargarProductoalPacienteFarmaciaCISOP($datos);
                    break;
                }
            case 'eliminarProductoalPacienteCISOP' : {
                    require_once("ActionFarmacia.php");
                    $o_ActionFarmacia = new ActionFarmacia();
                    $datos = array();
                    $datos["codigoAsignacionProductoCISOP"] = $parametros["p2"];
                    $resultado = $o_ActionFarmacia->eliminarProductoalPacienteCISOP($datos);
                    break;
                }

            case 'mostrarDatosdelPaqueteAsignadoFarmaciaSOP' : {
                    require_once("ActionFarmacia.php");
                    $o_ActionFarmacia = new ActionFarmacia();
                    $datos = array();
                    $datos["codigoProgramacionSOP"] = $parametros["p2"];
                    $datos["codigopersona"] = $parametros["p3"];
                    $resultado = $o_ActionFarmacia->mostrarDatosdelPaqueteAsignadoFarmaciaSOP($datos);
                    break;
                }
            case 'actualizarNuevasCantidadesEntregadasCISOP': {
                    require_once("ActionFarmacia.php");
                    $o_ActionFarmacia = new ActionFarmacia();
                    $datos = array();
                    $datos["cadenanuevosdatos"] = $parametros["p2"];
                    $resultado = $o_ActionFarmacia->actualizarNuevasCantidadesEntregadasCISOP($datos);
                    break;
                }
            case 'mostrarVentanaNuevosMedicamentosCISOP' : {
                    require_once("../../cvista/programacion/sop/vistaAgregarMedicamentoFarmaciaSOP.php");
                    break;
                }
            case 'mostrarTablaNuevosMedicamentosCISOP' : {
                    require_once("ActionFarmacia.php");
                    header("Content-type: text/xml");
                    $o_ActionFarmacia = new ActionFarmacia();
                    $datos = array();
                    $datos["tipobusqueda"] = $parametros["p2"];
                    $datos["parametronombre"] = $parametros["p3"];
                    $resultado = $o_ActionFarmacia->mostrarTablaNuevosProductosCISOP($datos);
                    break;
                }
            case 'mostrarVentanaBusquedaPersonas' : {
                    require_once("../../cvista/programacion/sop/vistaBusquedaPersonaCISOP.php");
                    break;
                }
            case 'busquedaPersonaCISOP' : {
                    require_once("ActionFarmacia.php");
                    $o_ActionFarmacia = new ActionFarmacia();
                    $datos = array();
                    $datos["codigopersona"] = $parametros["p2"];
                    $resultado = $o_ActionFarmacia->ObtenerDatosPacienteCISOP($datos);
                    break;
                }
            case 'generarOrdenCuentaCorrienteFarmaciaCISOP' : {
                    require_once("ActionFarmacia.php");
                    $o_ActionFarmacia = new ActionFarmacia();
                    $datos = array();
                    $datos["codigoProgramacionSOP"] = $parametros["p2"];
                    $datos["codigopersona"] = $parametros["p3"];
                    $resultado = $o_ActionFarmacia->generarOrdenCuentaCorrienteFarmaciaCISOP($datos);
                    break;
                }

            case 'cargaNumeroSesiones' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigoPaciente"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->numeroSesionEssalud($datos);
                    break;
                }
            case 'afiliacionCorrecta' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigoPaciente"] = $parametros["p2"];
                    $datos["codigoProgramacion"] = $parametros["p3"];
                    $resultado = utf8_encode($o_ActionActoMedico->aAfiliacionCorrecta($datos));
                    break;
                }
            case 'agregarDiagnosticoHC' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigointernoCIE"] = $parametros["p2"];
                    $datos["codigoCIE"] = $parametros["p3"];
                    $datos["numerodivDiagnostico"] = $parametros["p4"];
                    $datos["nombreCIE"] = base64_decode($parametros["p5"]);
                    $datos["idTipoDiagnostico"] = $parametros["p6"];
                    $datos["idTipoIngreso"] = $parametros["p7"];
                    $datos["idDiagnosticoCIE"] = $parametros["p8"];
                    $datos["diagnosticoMedico"] = $parametros["p9"];
                    $datos["estadoregistroDiagnostico"] = $parametros["p10"];
                    $resultado = $o_ActionActoMedico->agregarDiagnosticoHC($datos);
                    break;
                }
            case 'agregarDiagnosticoPreguardadoHC' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigointernoCIE"] = $parametros["p2"];
                    $datos["codigoCIE"] = $parametros["p3"];
                    $datos["numerodivDiagnostico"] = $parametros["p4"];
                    $datos["nombreCIE"] = (base64_decode($parametros["p5"]));
                    $datos["idTipoDiagnostico"] = $parametros["p6"];
                    $datos["idTipoIngreso"] = $parametros["p7"];
                    $datos["idDiagnosticoCIE"] = $parametros["p8"];
                    $datos["diagnosticoMedico"] = $parametros["p9"];
                    $datos["estadoregistroDiagnostico"] = $parametros["p10"];
                    $resultado = $o_ActionActoMedico->agregarDiagnosticoPreguardadoHC($datos);
                    break;
                }
            case 'agregarOtroSintoma' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->agregarOtroSintoma();
                    break;
                }
            case 'agregarOtroDiagnosticoHC' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->agregarOtroDiagnosticoHC();
                    break;
                }
            case 'preGrabarDiagnostico' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["cadena"] = $parametros["p2"];
                    $datos["codigoProgramacion"] = $parametros["p3"];
                    $datos["estadoregistro"] = $parametros["p4"];
                    $datos["idDiagnostico"] = $parametros["p5"];
                    $datos["ObservacionDiagnostico"] = $parametros["p6"];
                    $datos["esEssalud"] = $parametros["p7"];
                    $datos["destinoCitaEssalud"] = $parametros["p8"];
                    $datos["tipoconsultaEssalud"] = $parametros["p9"];
                    $datos["numerosesion"] = $parametros["p10"];
                    $datos["codigopaciente"] = $parametros["p11"];
                    $datos["codigocronograma"] = $parametros["p12"];
                    $resultado = $o_ActionActoMedico->preGrabarDiagnostico($datos);
                    break;
                }

            case 'eliminarDiagnosticoHC' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["IdDiagnostico"] = $parametros["p2"];
                    $datos["codigointernoCIE"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->eliminarDiagnostico($datos);
                    break;
                }
            case 'cargaDiagnosticosPreguardados' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigoprogramacion"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->cargaDiagnosticosPreguardados($datos);
                    break;
                }
            case 'cargarTriaje' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigoProgramacion"] = $parametros["p2"];
                    require_once("../../cvista/actomedico/vistaTriaje.php");
                    break;
                }
            case 'verDiagnosticosAnteriores' : {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigopaciente"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->cargaDiagnosticosAnteriores($datos);
                    break;
                }
            case 'mostrarVentanaDiagnosticoAnterior' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigoprogramacion"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->mostrarVentanaDiagnosticoAnterior($datos);
                    break;
                }

            case 'subirFotoProcimientoDiente' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    //$datos = array();
                    $datos = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->subirFotoProcimientoDiente($datos);
                    break;
                }

            case 'verificarCantidadVersionImagenXHistoriaDiente' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos['IdHistoriaDiente'] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->verificarCantidadVersionImagenXHistoriaDiente($datos);
                    break;
                }
            case 'grabarImagenHistoriaDiente' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos['url'] = $parametros["p2"];
                    $datos['id'] = $parametros["p3"];
                    $datos['width'] = $parametros["p4"];
                    $datos['height'] = $parametros["p5"];
                    $datos['version'] = $parametros["p6"];
                    $resultado = $o_ActionActoMedico->grabarImagenHistoriaDiente($datos);
                    break;
                }
            case 'updateObsHistoriaDiente' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos['obs'] = $parametros["p2"];
                    $datos['id'] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->updateObsHistoriaDiente($datos);
                    break;
                }

            case 'updateCarasDiente' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos['idDiente'] = $parametros["p2"];
                    $datos['idCara'] = $parametros["p3"];
                    $datos['Bit'] = $parametros["p4"];
                    $resultado = $o_ActionActoMedico->updateCarasDiente($datos);
                    break;
                }







            case 'obtenerDiagnosticoAnterior' : {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codigoprogramacion"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->xmlTablaDiagnosticoAnteriorPopUp($datos);
                    break;
                }
            case 'agregarMotivoDeConsulta': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->agregarMotivoDeConsulta($parametros);
                    break;
                }
            case 'agregarAntecedenteOdontograma': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos['iIdHistoriaDiente'] = 0;
                    $datos["numeroAntecedenteOdontograma"] = $parametros["p2"];
                    $datos["idAntecedenteOdontograma"] = $parametros["p3"];
                    $datos["nombreAntecedenteOdontograma"] = $parametros["p4"];
                    $datos["bTercero"] = $parametros["p5"];
                    $datos["observacion"] = $parametros["p6"];
                    $datos["idDiente1"] = $parametros["p7"];
                    $datos["binario1"] = $parametros["p8"];
                    $datos["idDiente2"] = $parametros["p9"];
                    $datos["binario2"] = $parametros["p10"];
                    $datos["mesial"] = $parametros["p11"];
                    $datos["oclusal"] = $parametros["p12"];
                    $datos["distal"] = $parametros["p13"];
                    $datos["vestibular"] = $parametros["p14"];
                    $datos["lingual"] = $parametros["p15"];
                    $datos["palatino"] = $parametros["p16"];
                    $datos["iColorsimbolo"] = $parametros["p17"];
                    $datos["iEstado"] = $parametros["p18"];
                    $datos["dientesAfectados"] = $parametros["p19"];
                    $datos["bEsTercero"] = $parametros["p20"];
                    $datos["bCaras"] = $parametros["p21"];
                    if ($datos["dientesAfectados"] == 1) {
                        $arrayPosicion = $o_ActionActoMedico->aPosicionSimbolo($datos);
                        $datos["idSimboloGrafico"] = '';
                        $datos["px"] = '';
                        $datos["py"] = '';
                        $datos["ancho"] = '';
                        $datos["alto"] = '';
                        foreach ($arrayPosicion as $fila) {
                            $datos["idSimboloGrafico"].= $fila['iIdSimboloGraficoDiagnostico'] . '-';
                            $datos["px"].= $fila['nPosicionX'] . '-';
                            $datos["py"].= $fila['nPosicionY'] . '-';
                            $datos["ancho"].= $fila['nAncho'] . '-';
                            $datos["alto"].= $fila['nLargo'] . '-';
                        }
                    }
                    if ($datos["dientesAfectados"] == 2) {
                        $arrayPosicion = $o_ActionActoMedico->aPosicionSimboloDoble($datos);
                        $datos["idSimboloGrafico"] = '';
                        $datos["px"] = '';
                        $datos["py"] = '';
                        $datos["ancho"] = '';
                        $datos["alto"] = '';
                        foreach ($arrayPosicion as $fila) {
                            $datos["idSimboloGrafico"].= $fila['iIdSimboloGraficoDiagnostico'] . '-';
                            $datos["px"].= $fila['nPosicionX'] . '-';
                            $datos["py"].= $fila['nPosicionY'] . '-';
                            $datos["ancho"].= $fila['nAncho'] . '-';
                            $datos["alto"].= $fila['nLargo'] . '-';
                        }
                    }


                    $resultado = $o_ActionActoMedico->aAagregarAntecedenteOdontograma($datos);
                    break;
                }
            case 'buscadorDiagnosticoDiente': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["numeroAntecedenteOdontograma"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->aBuscadorDiagnosticoDiente($datos);
                    break;
                }
            case 'nuevoAntecedenteDinete': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    //$datos["numeroAntecedenteOdontograma"] = $parametros["p2"];

                    $datos = '';
                    $resultado = $o_ActionActoMedico->aNuevoAntecedenteDinete($datos);
                    break;
                }

            case 'tablaProcedimientoOdontologico' : {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();

                    $datos["nombre"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->aTablaProcedimientoOdontologico($datos);
                    break;
                }
            case 'preguardarAntecedenteOdontograma': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["idAntecedenteOdontograma"] = $parametros["p2"];
                    $datos["idDiagnosticodiente"] = $parametros["p3"];
                    $datos["estadoAntecedenteOdontograma"] = $parametros["p4"];
                    $datos["codigoProgramacion"] = $parametros["p5"];


                    $datos["iIdDiente1"] = $parametros["p6"];
                    $datos["iIdDiente2"] = $parametros["p7"];
                    $datos["Mesial"] = $parametros["p8"];
                    $datos["Incisal"] = $parametros["p9"];

                    $datos["Distal"] = $parametros["p10"];
                    $datos["Vestibular"] = $parametros["p11"];
                    $datos["Lingual"] = $parametros["p12"];
                    $datos["Palatina"] = $parametros["p13"];
                    $datos["obs"] = $parametros["p14"];

                    $datos["tercero"] = $parametros["p15"];
                    $datos["estado"] = $parametros["p16"];

                    $resultado = $o_ActionActoMedico->aPreguardarAntecedenteOdontograma($datos);
                    break;
                }


            case 'manteMotivosDeConsulta': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->manteMotivosDeConsulta($parametros);
                    break;
                }
            case 'cargarMotivoDeConsulta': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->cargarMotivoDeConsulta($parametros);
                    break;
                }
            case 'tablaSintomas': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    if (isset($parametros["p2"])) {
                        $nombreSintoma = $parametros["p2"];
                    } else {
                        $nombreSintoma = '';
                    }
                    if (isset($parametros["p3"])) {
                        $accion = $parametros["p3"];
                    } else {
                        $accion = '1';
                    }
                    $resultado = $o_ActionActoMedico->xmlTablaSintomas($nombreSintoma, $accion);
                    break;
                }
            case 'verMotivoConsultaAnteriores': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->verMotivoConsultaAnteriores($parametros);
                    break;
                }
            case 'cargarTablaCentroCostosServicios': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["idCentroCosto"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->cargarTablaCentroCostosServicios($datos);
                    break;
                }



            case 'pintarDivExamenes': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos['c_cod_ser_pro'] = $parametros['p2'];
                    $datos['codigoPaciente'] = $parametros['p3'];
                    $resultado = $o_ActionActoMedico->pintarDivExamenes($parametros);
                    break;
                }
            case 'cargarVentanaServiciosPorActividadDeCCostos': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->cargarVentanaServiciosPorActividadDeCCostos();
                    break;
                }


            case 'cargarVentanaServiciosPorActividadDeCCosto': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->cargarVentanaServiciosPorActividadDeCCosto();
                    break;
                }
            case 'listaServiciosPorActividadDeCCosto': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $opcion = 1; //$opcion=$parametros['p2'];
                    $iidCentroCosto = $parametros['p3'];
                    $codActividad = ''; //$codActividad=$parametros['p4'];
                    $nomServicio = ''; //$nomServicio=$parametros['p5'];
                    $funcion = $parametros['p6'];
                    $resultado = $o_ActionActoMedico->listaServiciosPorActividadDeCCosto($opcion, $iidCentroCosto, $codActividad, $nomServicio, $funcion);
                    break;
                }
            case 'abrirMantenimientoReportes': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->abrirMantenimientoReportes();
                    break;
                }
            case 'TablaLeyendaGrafica': {
                    header("Content-type: text/xml");
                    require_once("ActionReporte.php");

                    $o_ActionReporte = new ActionReporte();

                    $datos["Estados"] = $parametros["p2"];
                    $datos["Atencion"] = $parametros["p3"];
                    $datos["Programacion"] = $parametros["p4"];
                    $datos["Medicos"] = $parametros["p5"];
                    $datos["Servicios"] = $parametros["p6"];
                    $datos["Afiliaciones"] = $parametros["p7"];
                    $datos["AmbiLo"] = $parametros["p8"];
                    $datos["Sedes"] = $parametros["p9"];
                    $datos["Turnos"] = $parametros["p10"];
                    $datos["opcion"] = $parametros["p11"];
                    $datos["fechaInicio"] = $parametros["p12"];
                    $datos["fechaFin"] = $parametros["p13"];
                    $datos["imesInicio"] = $parametros["p14"];
                    $datos["imesFin"] = $parametros["p15"];
                    $datos["iTrimestreInicio"] = $parametros["p16"];
                    $datos["iTrimestreFin"] = $parametros["p17"];
                    $datos["iSemestreInicio"] = $parametros["p18"];
                    $datos["iSemestreFin"] = $parametros["p19"];
                    $datos["ianioInicio"] = $parametros["p20"];
                    $datos["ianiofin"] = $parametros["p21"];
                    $datos["actividades"] = $parametros["p22"];
                    $resultado = $o_ActionReporte->TablaLeyendaGrafica($datos);
                    break;
                }
            case 'TablaLeyendaGraficaLaboratorioClinico': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos["Examenes"] = $parametros["p2"];
                    $datos["Sede"] = $parametros["p3"];
                    $datos["Procedencia"] = $parametros["p4"];
                    $datos["Afiliaciones"] = $parametros["p5"];
                    $datos["PuntoControl"] = $parametros["p6"];
                    $datos["Materiales"] = $parametros["p7"];
                    $datos["UnidadMedida"] = $parametros["p8"];
                    $datos["opcion"] = $parametros["p11"];
                    $datos["fechaInicio"] = $parametros["p12"];
                    $datos["fechaFin"] = $parametros["p13"];
                    $datos["imesInicio"] = $parametros["p14"];
                    $datos["imesFin"] = $parametros["p15"];
                    $datos["iTrimestreInicio"] = $parametros["p16"];
                    $datos["iTrimestreFin"] = $parametros["p17"];
                    $datos["iSemestreInicio"] = $parametros["p18"];
                    $datos["iSemestreFin"] = $parametros["p19"];
                    $datos["ianioInicio"] = $parametros["p20"];
                    $datos["ianiofin"] = $parametros["p21"];
                    $resultado = $o_ActionReporte->TablaLeyendaGraficalabo($datos);
                    break;
                }
            case 'grabarReporte': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos = array();
                    $datos["p1"] = $parametros["hidIdReporte"];
                    $datos["p2"] = $parametros["txtNomReporte"];
                    $datos["p3"] = $parametros["cboEstadoReporte"];
                    $datos["p4"] = $parametros["p2"];
                    $resultado = $o_ActionReporte->grabarReporte($datos);
                    break;
                }
            case 'grabarEtiqueta': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos = array();
                    $datosTipo = array();
                    $datos["p1"] = $parametros["hidIdEtiqueta"];
                    $datos["p2"] = $parametros["txtNomEtiqueta"];
                    $datos["p3"] = $parametros["cboEstadoEtiqueta"];
                    $datos["p4"] = $parametros["p3"]; //hacer
                    $datos["p5"] = $parametros["txtOrdenEtiqueta"];
                    $datosTipo["q1"] = $parametros["p2"]; //idreporte
                    $datosTipo["q2"] = $parametros["cboTpoReporteDetalle"];
                    $datosTipo["q3"] = $parametros["hidIdReporteDetalle"];
                    $datosTipo["q4"] = $parametros["p3"]; //hacer
                    $resultado = $o_ActionReporte->grabarEtiqueta($datos, $datosTipo);
                    break;
                }
            case 'grabarAtributoFormato': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos = array();
                    $datos["p1"] = $parametros["hidIdAtributo"];
                    $datos["p2"] = $parametros["txtNomAtributo"];
                    $datos["p3"] = $parametros["cboEstadoAtributo"];
                    $datos["p4"] = $parametros["cboAtributo"];
                    $datos["p5"] = $parametros["p2"];
                    $resultado = $o_ActionReporte->grabarAtributoFormato($datos);
                    break;
                }
            case 'arbolReporte': {
                    require_once("ActionReporte.php");
                    header("Content-type: text/xml");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->arbolReporte();
                    break;
                }
            case 'editarReporte': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->editarReporte($parametros["p2"]);
                    break;
                }
            case 'listaEtiqueta': {
                    require_once("ActionReporte.php");
                    header("Content-type: text/xml");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->listaEtiqueta($parametros["p2"]);
                    break;
                }
            case 'listaAtributos': {
                    require_once("ActionReporte.php");
                    header("Content-type: text/xml");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->listaAtributos();
                    break;
                }
            case 'tipoAtributoFormato': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos = array();
                    $datos["idAtributo"] = $parametros["p2"];
                    $opt = $parametros["p3"];
                    $resultado = $o_ActionReporte->abrirTipoAtributoFormato($datos, $opt);
                    break;
                }

            case 'grabarAtributoCombo': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos = array();
                    $datosItemCombo = array();
                    $datos["p1"] = $parametros["p2"];
                    $datos["p2"] = $parametros["p3"];
                    $datos["p3"] = $parametros["p4"];
                    $datos["p4"] = $parametros["p5"];
                    $datos["p5"] = $parametros["p6"];
                    $datosItemCombo["q1"] = $parametros["txtTexto"]; //tipo array
                    $datosItemCombo["q2"] = $parametros["txtValue"]; //tipo array
                    $resultado = $o_ActionReporte->grabarAtributoCombo($datos, $datosItemCombo);
                    break;
                }
            case 'modificarAtributoCombo': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos = array();
                    $datos["p1"] = $parametros["p2"]; //id atributo
                    $datos["hididcomboatributo"] = $parametros["hidIdComboAtributo"];  //tipo array
                    $datos["txttexto"] = $parametros["txtTexto"];            //tipo array
                    $datos["txtvalue"] = $parametros["txtValue"];            //tipo array
                    $datos["p2"] = $parametros["p3"];                  //hacer
                    $resultado = $o_ActionReporte->modificarAtributoCombo($datos);
                    break;
                }
            case 'asignarEtiquetaAtributo': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->asignarEtiquetaAtributo();
                    break;
                }
            case 'listaAsignarAtributos': {
                    require_once("ActionReporte.php");
                    header("Content-type: text/xml");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->listaAsignarAtributos();
                    break;
                }
            case 'cargarAtributoCombo': {
                    require_once("ActionReporte.php");
                    header("Content-type: text/xml");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->cargarAtributoCombo($parametros["p2"]);
                    break;
                }
            case 'grabarEtiquetaAtributo': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos = array();
                    $datos["p1"] = $parametros["p2"];
                    $datos["p2"] = $parametros["p3"];
                    $valor = $parametros["p4"];
                    $valor = str_replace("jclm63", "#", $valor);
                    $datos["p3"] = $valor;
                    $datos["p4"] = $parametros["p5"];
                    $resultado = $o_ActionReporte->grabarEtiquetaAtributo($datos);
                    break;
                }
            case 'listaEtiquetaAtributo': {
                    require_once("ActionReporte.php");
                    header("Content-type: text/xml");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->listaEtiquetaAtributo($parametros["p2"]);
                    break;
                }
            case 'switchEtiquetaAtributo': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos = array();
                    $datos["p1"] = $parametros["p2"];
                    $datos["p2"] = $parametros["p3"];
                    $resultado = $o_ActionReporte->switchEtiquetaAtributo($datos);
                    break;
                }
            case 'imprimirRecetaMedica': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $codigoProgramacion = $parametros["p2"];
                    $resultado = $o_ActionReporte->imprimirRecetaMedica($codigoProgramacion);
                    break;
                }

            case 'modificarEtiquetaAtributo': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos = array();
                    $datos["p1"] = $parametros["p2"];
                    $valor = $parametros["p3"];
                    $valor = str_replace("jclm63", "#", $valor);
                    $datos["p2"] = $valor;
                    $datos["p3"] = $parametros["p4"];
                    $resultado = $o_ActionReporte->modificarEtiquetaAtributo($datos);
                    break;
                }
            case 'eliminaDbComboAtributo': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos = array();
                    $datos["p1"] = $parametros["p2"];
                    $datos["p2"] = $parametros["p3"];
                    $resultado = $o_ActionReporte->eliminaDbComboAtributo($datos);
                    break;
                }
            case 'seleccionarColor': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->seleccionarColor();
                    break;
                }
            case 'abrirAreaCentroCosto': {
                    require_once("ActionabrirPopadAreasPorCoordinador.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->abrirAreaCentroCosto();
                    break;
                }
            case 'arbolCentroCosto': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->arbolCentroCosto();
                    break;
                }
            case 'tablaAreaCCosto': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->tablaAreaCCosto($parametros["p2"]);
                    break;
                }
            case 'grabarArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["descripcion"] = strtoupper($parametros["p2"]);
                    $datos["abrevia"] = strtoupper($parametros["p3"]);
                    $datos["estado"] = $parametros["p4"];
                    $resultado = $o_ActionRrhh->grabarArea($datos);
                    break;
                }
            case 'grabarAreaJerarquicamente': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos = array();
                    $datos["idDependencia"] = strtoupper($parametros["p2"]);
                    $datos["descripcion"] = strtoupper($parametros["p3"]);
                    $datos["abrevia"] = strtoupper($parametros["p4"]);
                    $datos["estado"] = $parametros["p5"];
                    $datos["nivel"] = $parametros["p6"];
                    $resultado = $o_ActionMantenimientoGeneral->grabarAreaJerarquicamente($datos);
                    break;
                }
            case 'actualizarEstadoSedeEmpresaArea': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos = array();
                    $datos["idSedeEmpresaArea"] = strtoupper($parametros["p2"]);
                    $datos["estado"] = strtoupper($parametros["p3"]);
                    $datos["idArea"] = strtoupper($parametros["p4"]);
                    $datos["nivel"] = strtoupper($parametros["p5"]);
                    $datos["idSedeEmpresa"] = strtoupper($parametros["p6"]);
                    $resultado = $o_ActionMantenimientoGeneral->actualizarEstadoSedeEmpresaArea($datos);
                    break;
                }
            case 'modificarArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["idArea"] = $parametros["p2"];
                    $datos["descripcion"] = $parametros["p3"];
                    $datos["abrevia"] = $parametros["p4"];
                    $datos["estado"] = $parametros["p5"];
                    $resultado = $o_ActionRrhh->modificarArea($datos);
                    break;
                }
            case 'modificarSubArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["idSubArea"] = $parametros["p2"];
                    $datos["descripcion"] = $parametros["p3"];
                    $datos["abrevia"] = $parametros["p4"];
                    $datos["estado"] = $parametros["p5"];
                    $resultado = $o_ActionRrhh->modificarSubArea($datos);
                    break;
                }
            case 'listaTablaArea': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->listaTablaArea($parametros["p2"]);
                    break;
                }
            case 'abrirPuestoArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["idSedeEmpresaArea"] = $parametros["p2"];
                    $resultado = $o_ActionRrhh->abrirPuestoArea($datos);
                    break;
                }
            case 'listPuestosxCategoria': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["p1"] = $parametros["p2"];
                    $datos["idSedeEmpresaArea"] = $parametros["p3"];
                    $datos["cboSucursal"] = $parametros["p4"];
                    $datos["idArea"] = $parametros["p5"];
                    $resultado = $o_ActionRrhh->listPuestosxCategoria($datos);
                    break;
                }
            case 'grabarModalidadContrato': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["modocontrato"] = $parametros["p2"];
                    $datos["sueldo"] = $parametros["p3"];
                    $datos["fechaini"] = $parametros["p4"];
                    $datos["fechafin"] = $parametros["p5"];
                    $datos["idempleado"] = $parametros["p6"];
                    $datos["idempmodcon"] = $parametros["p7"];
                    $datos["hacer"] = $parametros["p8"];
                    $resultado = $o_ActionRrhh->grabarModalidadContrato($datos);
                    break;
                }
            case 'buscarArea': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->buscarArea($parametros["p2"]);
                    break;
                }
            case 'buscarAreaModCoordinadoresTurnos': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["txtNombreAreaAbuscar"] = $parametros["p2"];
                    $datos["IdcboSede"] = $parametros["p3"];
                    $resultado = $o_ActionRrhh->buscarAreaModCoordinadoresTurnos($datos);
                    break;
                }
            case 'buscarAreaModSinCoordinadoresTurnos': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["txtNombreAreaAbuscar"] = $parametros["p2"];
                    $datos["IdcboSede"] = $parametros["p3"];
                    $resultado = $o_ActionRrhh->buscarAreaModSinCoordinadoresTurnos($datos);
                    break;
                }
            case 'buscarSubArea': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->buscarSubArea($parametros["p2"], $parametros["p3"]);
                    break;
                }
            case 'vbuscarEmpleado': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->buscarEmpleado();
                    break;
                }
            case 'vbuscarCoordinador': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->buscarCoordinadores();
                    break;
                }
            case 'asignarEmpleadoArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["hidIdArea"] = $parametros["p2"];
                    $datos["cboSucursal"] = $parametros["p3"];
                    $datos["hidIdPersona"] = $parametros["p4"];
                    $resultado = $o_ActionRrhh->AsignarEmpleadoArea($datos);
                    break;
                }
            case 'replicarPreProgramación': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["hidEmpresaSedearea"] = $parametros["p2"];
                    $datos["mesInicial"] = $parametros["p3"];
                    $datos["anioInicial"] = $parametros["p4"];
                    $datos["mes"] = $parametros["p5"];
                    $datos["anio"] = $parametros["p6"];
                    $resultado = $o_ActionRrhh->replicarPreProgramación($datos);
                    break;
                }
            case 'asignarsolofechasCoordinador': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["fechaIni"] = $parametros["p2"];
                    $datos["fechaFin"] = $parametros["p3"];
                    $datos["hiIdEncargadoProgramacionPersonal"] = $parametros["p4"];
                    $resultado = $o_ActionRrhh->asignarsolofechasCoordinador($datos);
                    break;
                }
            case 'DesactivarCoordinadorDeArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["hiIdEncargadoProgramacionPersonal"] = $parametros["p2"];
                    $resultado = $o_ActionRrhh->DesactivarCoordinadorDeArea($datos);
                    break;
                }
            case 'asignarNuevoCoordinadorAlArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["IdCoordinadorAsignado"] = $parametros["p2"];
                    $datos["idSedeempresaArea"] = $parametros["p3"];
                    $resultado = $o_ActionRrhh->asignarNuevoCoordinadorAlArea($datos);
                    break;
                }
            case 'editarEncargadoArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["hidIdArea"] = $parametros["p2"];
                    $datos["cboSucursal"] = $parametros["p3"];
                    $resultado = $o_ActionRrhh->editarEncargadoArea($datos);
                    break;
                }
            case 'nuevaArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->nuevaArea();
                    break;
                }

            case 'mantenimientoTurnoCordi': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["sede"] = $parametros["p2"];
                    $datos["area"] = $parametros["p3"];
                    $datos["cordinador"] = $parametros["p4"];
                    $datos["idSedeempresaArea"] = $parametros["p5"];
                    $resultado = $o_ActionRrhh->mantenimientoTurnoCordi($datos);
                    break;
                }
            case 'abrirPopPupArbolAreasConCoordinador': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["sede"] = $parametros["p2"];
                    $resultado = $o_ActionRrhh->abrirPopPupArbolAreasConCoordinador($datos);
                    break;
                }
            case 'abrirPopPupArbolAreasSinCoordinador': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->abrirPopPupArbolAreasSinCoordinador();
                    break;
                }
            case 'abrirPoPupColorTurnoSeleccionadoPorArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["sede"] = $parametros["p1"];
                    $resultado = $o_ActionRrhh->abrirPoPupColorTurnoSeleccionadoPorArea($datos);
                    break;
                }
            case 'mantenimientoEditarCordinador': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["sede"] = $parametros["p2"];
                    $datos["area"] = $parametros["p3"];
                    $datos["cordinador"] = $parametros["p4"];
                    $datos["iIdEncargadoProgramacionPersonal"] = $parametros["p5"];
                    $datos["fechaInicio"] = $parametros["p6"];
                    $datos["fechaFin"] = $parametros["p7"];
                    $datos["accion"] = $parametros["p8"];
                    $datos["idSedeempresaArea"] = $parametros["p9"];
                    $resultado = $o_ActionRrhh->mantenimientoEditarCordinador($datos);
                    break;
                }
            case 'nuevaSubArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->nuevaSubArea();
                    break;
                }
            case 'guardarSedeEmpresaAreaMasivamente': {
                    require_once("ActionMantenimientoGeneral.php");
                    header("Content-type: text/xml");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $resultado = $o_ActionMantenimientoGeneral->guardarSedeEmpresaAreaMasivamente($parametros["p2"], $parametros["p3"]);
                    break;
                }
            case 'preeditaArea': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $resultado = $o_ActionMantenimientoGeneral->preeditaArea($parametros["p2"]);
                    break;
                }
            case 'preeditaAreaXSedeEmpresa': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $resultado = $o_ActionMantenimientoGeneral->preeditaAreaXSedeEmpresa($parametros["p2"], $parametros["p3"], $parametros["p4"]);
                    break;
                }
            case 'tablaSucursalesXidArea': {
                    require_once("ActionMantenimientoGeneral.php");
                    header("Content-type: text/xml");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $resultado = $o_ActionMantenimientoGeneral->tablaSucursalesXidArea($parametros["p2"]);
                    break;
                }
            case 'prueba': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->prueba();
                    break;
                }
            case 'grabarCeCeSedeEmpresaArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["p1"] = $parametros["p3"]; //idCC
                    $datos["p2"] = $parametros["p2"]; //idSEA
                    $resultado = $o_ActionRrhh->grabarAreaCCosto($datos);
                    break;
                }
            case 'registroHorariosEmpleados': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->registroHorariosEmpleados();
                    break;
                }
            case 'registroHorariosEmpleadosRrhh': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->registroHorariosEmpleadosRrhh();
                    break;
                }
            case 'listTablaHorarios': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $datos = array();
                    $datos["anio"] = $parametros["p2"];
                    $datos["mes"] = $parametros["p3"];
                    $datos["idSedeEmpresaArea"] = $parametros["p4"];
                    $datos["iIdProgramacionpersonal"] = $parametros["p5"];
                    $datos["idSEACC"] = $parametros["p6"];
                    $datos["cboTipoContrato"] = $parametros["p7"];
                    $datos["idSubArea"] = $parametros["p8"];
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->listTablaHorarios($datos);
                    break;
                }
            case 'mantTurnoSucursalArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->mantTurnoSucursalArea();
                    break;
                }
            case 'arbolEmpresaSucursal': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->arbolEmpresaSucursal();
                    break;
                }
            case 'listAreaSucursal': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->listAreaSucursal($parametros["p2"]);
                    break;
                }
            case 'listSubAreaXAreaXSede': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->listSubAreaXAreaXSede($parametros["p2"], $parametros["p3"]);
                    break;
                }
            case 'selectSedeEmpresaArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->selectSedeEmpresaArea();
                    break;
                }
            case 'listaSedeAreaCentroCosto': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->listaSedeAreaCentroCosto($parametros["p2"]);
                    break;
                }
            case 'eliminacionFisicaSedeAreaCentroCosto': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->eliminacionFisicaSedeAreaCentroCosto($parametros["p2"]);
                    break;
                }
            case 'listTurnoArea': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->listTurnoArea();
                    blistTurnoAreareak;
                }
            case 'listTurnoProgramar': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->listTurnoProgramar();
                    break;
                }
            case 'grabarTurnoProgramar': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["idTurno"] = $parametros["p2"];
                    $datos["idTurnoProgramar"] = strtoupper($parametros["p3"]);
                    $resultado = $o_ActionRrhh->grabarTurnoProgramar($datos);
                    break;
                }
            case 'listaTurnos': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->listaTurnos();
                    break;
                }

            case 'asignarTurnoSedeEmpresaArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["p1"] = $parametros["p2"];
                    $datos["p2"] = $parametros["p3"];
                    $resultado = $o_ActionRrhh->turnoSedeEmpresaArea($datos);
                    break;
                }
            case 'listTablaTurnoxArea': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->listTablaTurnoxArea($parametros["p2"]);
                    break;
                }
            case 'cargarCboArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->cargarCboArea($parametros["p2"], $parametros["p3"]);
                    break;
                }
            case 'cargarCboArea2': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->cargarCboArea2($parametros["p2"], 100);
                    break;
                }
            case 'cargarSubArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->cargarSubArea($parametros["p2"]);
                    break;
                }
            case 'cargarCboSedeArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->cargarCboSedeArea($parametros["p2"], $parametros["p3"], $parametros["p4"]);
                    break;
                }
            case 'cargarCboSubArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["codigosede"] = $parametros["p2"];
                    $datos["codigoarea"] = $parametros["p3"];
                    $resultado = $o_ActionRrhh->cargarCboSubArea($datos);
                    break;
                }
            case 'mntTablaCategoriaArea': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["idSubArea"] = $parametros["p2"];
                    $resultado = $o_ActionRrhh->mntTablaCategoriaArea($datos);
                    break;
                }
            case 'desactivarTSEA': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->desactivarTSEA($parametros["p2"]);
                    break;
                }
            case 'mantenimientoAlmacenes': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMant = new ActionMantenimientoGeneral();
                    $resultado = $o_ActionMant->mantenimientoAlmacenes();
                    break;
                }

            case 'vistaUnidadMedida': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMant = new ActionMantenimientoGeneral();
                    $resultado = $o_ActionMant->vistaUnidadMedida();
                    break;
                }
            case 'resultadoalmacenes': {
                    require_once("ActionMantenimientoGeneral.php");
                    header("Content-type: text/xml");
                    $o_ActionMant = new ActionMantenimientoGeneral();
                    $resultado = $o_ActionMant->resultadoalmacenes();
                    break;
                }
            case 'tablaUnidadMedida': {
                    require_once("ActionMantenimientoGeneral.php");
                    header("Content-type: text/xml");
                    $o_ActionMant = new ActionMantenimientoGeneral();
                    $resultado = $o_ActionMant->tablaUnidadMedida();
                    break;
                }
            case 'tablaUnidad': {
                    require_once("ActionMantenimientoGeneral.php");
                    header("Content-type: text/xml");
                    $o_ActionMant = new ActionMantenimientoGeneral();
                    $datos['idUnidadMedida'] = $parametros["p2"];
                    $resultado = $o_ActionMant->tablaUnidad($datos);
                    break;
                }
            case 'MantenimientoTiposUnidadMedida': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos["idTipoUnidad"] = $parametros["p2"];
                    $resultado = $o_ActionMantenimientoGeneral->MantenimientoTiposUnidadMedida($datos);
                    break;
                }
            case 'ActualizarDatosEssalud': {
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliacion = new ActionAfiliaciones();
                    $datos["CodiAuto"] = $parametros["p2"];
                    $datos["Ubigeo"] = $parametros["p3"];
                    $datos["Desde"] = $parametros["p4"];
                    $datos["Hasta"] = $parametros["p5"];
                    $datos["Doc"] = $parametros["p6"];
                    $datos["ApePat"] = $parametros["p7"];
                    $datos["ApeMat"] = $parametros["p8"];
                    $datos["Nomb1"] = $parametros["p9"];
                    $datos["Nomb2"] = $parametros["p10"];
                    $datos["Sexo"] = $parametros["p11"];
                    $datos["FechaNac"] = $parametros["p12"];
                    $datos["CodPer"] = $parametros["p13"];
                    $fecha_de_nacimiento = $datos["FechaNac"];
                    $array_nacimiento = explode("/", $fecha_de_nacimiento);
                    $array_actual = explode("/", $fecha_actual);
                    $anos = $array_actual[2] - $array_nacimiento[2];
                    $meses = $array_actual[1] - $array_nacimiento[1];
                    if ($meses < 0) {
                        --$anos;
                        $meses = $meses + 12;
                    }
                    $edad = $anos;
                    $datos["edad"] = $parametros["p13"];
                    $resultado = $o_ActionAfiliacion->ActualizarDatosEssalud($datos);
                    break;
                }
            case 'InsertarDatosEssalud': {
                    require_once("ActionAfiliaciones.php");
                    $o_ActionAfiliacion = new ActionAfiliaciones();
                    $datos["CodiAuto"] = $parametros["p2"];
                    $datos["Ubigeo"] = $parametros["p3"];
                    $datos["Desde"] = $parametros["p4"];
                    $datos["Hasta"] = $parametros["p5"];
                    $datos["Doc"] = $parametros["p6"];
                    $datos["ApePat"] = $parametros["p7"];
                    $datos["ApeMat"] = $parametros["p8"];
                    $datos["Nomb1"] = $parametros["p9"];
                    $datos["Nomb2"] = $parametros["p10"];
                    $datos["Sexo"] = $parametros["p11"];
                    $datos["FechaNac"] = $parametros["p12"];
                    $datos["CodPer"] = $parametros["p13"];
                    $fecha_de_nacimiento = $datos["FechaNac"];
                    $array_nacimiento = explode("/", $fecha_de_nacimiento);
                    $array_actual = explode("/", $fecha_actual);
                    $anos = $array_actual[2] - $array_nacimiento[2];
                    $meses = $array_actual[1] - $array_nacimiento[1];
                    if ($meses < 0) {
                        --$anos;
                        $meses = $meses + 12;
                    }
                    $edad = $anos;
                    $datos["edad"] = $parametros["p13"];
                    $resultado = $o_ActionAfiliacion->InsertarDatosEssalud($datos);
                    break;
                }
            case 'obtenerAfiliacionPersona': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $datos["codPersona"] = $parametros["p2"];
                    $resultado = $o_ActionOrden->obtenerAfiliacionPersona($datos);
                    break;
                }
            case 'verificarPaquete': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $datos["idnuevo"] = $parametros["p2"];
                    $datos["CodigoAfilili"] = $parametros["p3"];
                    $resultado = $o_ActionOrden->verificarPaquete($datos);
                    break;
                }
            case 'grabarOrgenGenerada': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $datos["CodigoPer"] = $parametros["p2"];
                    $datos["CodActoMedico"] = $parametros["p3"];
                    $resultado = $o_ActionOrden->grabarOrgenGenerada($datos);
                    break;
                }
            case 'grabarDetalleOrgenGenerada': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $datos["CodigoAfil"] = $parametros["p2"];
                    $datos["CodigoDetalle"] = $parametros["p3"];
                    $datos["CodigoPer"] = $parametros["p4"];
                    $datos["codigoPro"] = $parametros["p5"];
                    $datos["precio"] = $parametros["p6"];
                    $datos["cantidad"] = $parametros["p7"];
                    $datos["total"] = $parametros["p8"];
                    $resultado = $o_ActionOrden->grabarDetalleOrgenGenerada($datos);
                    break;
                }

            case 'anularItem': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $datos["item"] = $parametros["p2"];
                    $resultado = $o_ActionOrden->aAnularItem($datos);
                    break;
                }
            case 'tablaProductosxAfiliacion': {
                    require_once("ActionOrden.php");
                    header("Content-type: text/xml");
                    $o_ActionOrden = new ActionOrden();
                    $datos["codAfiliacion"] = $parametros["p2"];
                    $datos["producto"] = $parametros["p3"];
                    $resultado = $o_ActionOrden->tablaProductosxAfiliacion($parametros["p2"], $parametros['p3']);
                    break;
                }
            case 'tablaTemporal': {
                    require_once("ActionOrden.php");
                    header("Content-type: text/xml");
                    $o_ActionOrden = new ActionOrden();
                    $resultado = $o_ActionOrden->tablaTemporal();
                    break;
                }
            case 'tablaActoMedico': {
                    require_once("ActionOrden.php");
                    header("Content-type: text/xml");
                    $o_ActionOrden = new ActionOrden();
                    $datos["codPersona"] = $parametros["p2"];
                    $resultado = $o_ActionOrden->tablaActoMedico($parametros["p2"]);
                    break;
                }
            case 'EditarVdescripcionHistorial': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos["descripcion"] = $parametros["p2"];
                    $datos["Id"] = $parametros["p3"];
                    $resultado = $o_ActionReporte->EditarVdescripcionHistorial($datos);
                    break;
                }
            case 'PopadGenerarOrden': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $resultado = $o_ActionOrden->PopadGenerarOrden($parametros);
                    break;
                }
            case 'propiedadesPopadEstado': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->propiedadesPopadEstado();
                    break;
                }
            case 'propiedadesPopadAtencion': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->propiedadesPopadAtencion();
                    break;
                }
            case 'propiedadesPopadServicios': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->propiedadesPopadServicios();
                    break;
                }
            case 'propiedadesPopadAmbiL': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->propiedadesPopadAmbiL();
                    break;
                }
            case 'propiedadesPopadAmbiF': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->propiedadesPopadAmbiF();
                    break;
                }
            case 'EditarHistoriaEstadistica': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->EditarHistoriaEstadistica();
                    break;
                }
            case 'CatalogodeGraficos': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->CatalogodeGraficos();
                    break;
                }
            case 'abrirReporteIndicadorDiagnostico': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->abrirReporteIndicadorDiagnostico();
                    break;
                }
            case 'abrirPopudDiagnosticosReporte': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->abrirPopudDiagnosticosReporte();
                    break;
                }
            case 'listarBusquedaCIE': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos["vNombreCie"] = $parametros["p2"];
                    $resultado = $o_ActionReporte->listarBusquedaCIE($datos);
                    break;
                }

            case 'mostrarReportesEstadisticos': {
                    header("Content-type: text/xml");
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos["vAccion"] = $parametros["p2"];
                    $datos["fecha1"] = $parametros["p3"];
                    $datos["fecha2"] = $parametros["p4"];
                    $datos["afiliacion"] = $parametros["p5"];
                    $datos["sede"] = $parametros["p6"];
                    $datos["diagnostico"] = $parametros["p7"];
                    $datos["sede1"] = $parametros["p8"];
                    $datos["sede2"] = $parametros["p9"];
                    $datos["sede3"] = $parametros["p10"];
                    $datos["sede4"] = $parametros["p11"];
                    switch ($datos["vAccion"]) {
                        case "Fechas":
                            $resultado = $o_ActionReporte->mostrarReportesFechas($datos);
                            break;
                        case "FechasAfiliacion":
                            $resultado = $o_ActionReporte->mostrarReportesFechasAfiliacion($datos);
                            break;
                        case "FechasSede":
                            $resultado = $o_ActionReporte->mostrarReportesFechasSede($datos);
                            break;
                        case "FechasCIE":
                            $resultado = $o_ActionReporte->mostrarReportesFechasCie($datos);
                            break;
                        case "FechasAfiliacionSede":
                            $resultado = $o_ActionReporte->mostrarReportesFechasAfiliacionSede($datos);
                            break;
                        case "FechasAfiliacionCIE":
                            $resultado = $o_ActionReporte->mostrarReportesFechasAfiliacionCIE($datos);
                            break;
                        case "FechasSedeCIE":
                            $resultado = $o_ActionReporte->mostrarReportesFechasSedeCIE($datos);
                            break;
                        case "FechasAfiliacionSedeCIE":
                            $resultado = $o_ActionReporte->mostrarReportesFechasAfiliacionSedeCIE($datos);
                            break;
                    }
                    break;
                }
            case 'mostrarReportesEstadisticosREcetaMedica': {
                    header("Content-type: text/xml");
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos["vAccion"] = $parametros["p2"];
                    $datos["fecha1"] = $parametros["p3"];
                    $datos["fecha2"] = $parametros["p4"];
                    $datos["medicamento"] = $parametros["p5"];
                    $datos["medico"] = $parametros["p6"];
                    switch ($datos["vAccion"]) {
                        case "Fechas":
                            $resultado = $o_ActionReporte->mostrarReportesFechasRecetaMedica($datos);
                            break;
                        case "FechasMEdicamentos":
                            $resultado = $o_ActionReporte->mostrarReportesMedicamentoRecetaMedica($datos);
                            break;
                        case "FechasMedico":
                            $resultado = $o_ActionReporte->mostrarReportesFechasMedico($datos);
                            break;
                    }
                    break;
                }



            case 'abrirModuloReporteRecetasMedicas': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->abrirModuloReporteRecetasMedicas();
                    break;
                }
            case 'buscarMedicamento': {
                    header("Content-type: text/xml");
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos["vNombreMedicamento"] = $parametros["p2"];
                    $resultado = $o_ActionReporte->buscarMedicamento($datos);
                    break;
                }
            case 'buscarMEdico': {
                    header("Content-type: text/xml");
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos["vNOmbreMedico"] = $parametros["p2"];
                    $resultado = $o_ActionReporte->buscarMEdico($datos);
                    break;
                }






            //27Dic12

            case 'CatalogodeGraficosLaboratorioClinico': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->CatalogodeGraficosLaboratorioClinico();
                    break;
                }



            case 'PopadSedes': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->PopadSedes();
                    break;
                }
            case 'cargarPopadTurnos': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->cargarPopadTurnos();
                    break;
                }
            case 'estadisticasMedicos': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos["Estados"] = $parametros["p2"];
                    $datos["Atencion"] = $parametros["p3"];
                    $datos["Programacion"] = $parametros["p4"];
                    $datos["Medicos"] = $parametros["p5"];
                    $datos["Servicios"] = $parametros["p6"];
                    $datos["Afiliaciones"] = $parametros["p7"];
                    $datos["AmbiLo"] = $parametros["p8"];
                    $datos["Sedes"] = $parametros["p9"];
                    $datos["Turnos"] = $parametros["p10"];
                    $datos["opcion"] = $parametros["p11"];
                    $datos["fechaInicio"] = $parametros["p12"];
                    $datos["fechaFin"] = $parametros["p13"];
                    $datos["imesInicio"] = $parametros["p14"];
                    $datos["imesFin"] = $parametros["p15"];
                    $datos["iTrimestreInicio"] = $parametros["p16"];
                    $datos["iTrimestreFin"] = $parametros["p17"];
                    $datos["iSemestreInicio"] = $parametros["p18"];
                    $datos["iSemestreFin"] = $parametros["p19"];
                    $datos["ianioInicio"] = $parametros["p20"];
                    $datos["ianiofin"] = $parametros["p21"];
                    $datos["prefijo"] = $parametros["p22"];
                    $datos["tipografico"] = $parametros["p23"];
                    $datos["actividades"] = $parametros["p24"];
                    $resultado = $o_ActionReporte->aEstadisticasMedicos($datos);
                    break;
                }
            case 'guardarDatosHistoriaEstadistica': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos["Estados"] = $parametros["p2"];
                    $datos["Atencion"] = $parametros["p3"];
                    $datos["Programacion"] = $parametros["p4"];
                    $datos["Medicos"] = $parametros["p5"];
                    $datos["Servicios"] = $parametros["p6"];
                    $datos["Afiliaciones"] = $parametros["p7"];
                    $datos["AmbiLo"] = $parametros["p8"];
                    $datos["Sedes"] = $parametros["p9"];
                    $datos["Turnos"] = $parametros["p10"];
                    $datos["opcion"] = $parametros["p11"];
                    $datos["fechaInicio"] = $parametros["p12"];
                    $datos["fechaFin"] = $parametros["p13"];
                    $datos["imesInicio"] = $parametros["p14"];
                    $datos["imesFin"] = $parametros["p15"];
                    $datos["iTrimestreInicio"] = $parametros["p16"];
                    $datos["iTrimestreFin"] = $parametros["p17"];
                    $datos["iSemestreInicio"] = $parametros["p18"];
                    $datos["iSemestreFin"] = $parametros["p19"];
                    $datos["ianioInicio"] = $parametros["p20"];
                    $datos["ianiofin"] = $parametros["p21"];
                    $datos["tipografico"] = $parametros["p22"];
                    $datos["titulo"] = $parametros["p23"];
                    $datos["actividades"] = $parametros["p24"];
                    $resultado = $o_ActionReporte->guardarDatosHistoriaEstadistica($datos);
                    break;
                }
            case 'estadisticasExamenesLaboratorioClinico': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos["Examenes"] = $parametros["p2"];
                    $datos["Sede"] = $parametros["p3"];
                    $datos["Procedencia"] = $parametros["p4"];
                    $datos["Afiliaciones"] = $parametros["p5"];
                    $datos["PuntoControl"] = $parametros["p6"];

                    $datos["Materiales"] = $parametros["p7"];
                    $datos["UnidadMedida"] = $parametros["p8"];
                    $datos["opcion"] = $parametros["p11"];
                    $datos["fechaInicio"] = $parametros["p12"];
                    $datos["fechaFin"] = $parametros["p13"];
                    $datos["imesInicio"] = $parametros["p14"];
                    $datos["imesFin"] = $parametros["p15"];
                    $datos["iTrimestreInicio"] = $parametros["p16"];
                    $datos["iTrimestreFin"] = $parametros["p17"];
                    $datos["iSemestreInicio"] = $parametros["p18"];
                    $datos["iSemestreFin"] = $parametros["p19"];
                    $datos["ianioInicio"] = $parametros["p20"];
                    $datos["ianiofin"] = $parametros["p21"];
                    $datos["prefijo"] = $parametros["p22"];
                    $datos["tipografico"] = $parametros["p23"];
                    $resultado = $o_ActionReporte->aestadisticasExamenesLaboratorioClinico($datos);
                    break;
                }
            case 'TablaHistoriaEstadistica': {
                    require_once("ActionReporte.php");
                    header("Content-type: text/xml");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->TablaHistoriaEstadistica();
                    break;
                }
            case 'eliminarEstadisticaGuardada': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos["IdGrafico"] = $parametros["p2"];
                    $resultado = $o_ActionReporte->eliminarEstadisticaGuardada($datos);
                    break;
                }

            case 'cargarTablaPersonal': {
                    require_once("ActionReporte.php");
                    header("Content-type: text/xml");
                    $o_ActionReporte = new ActionReporte();
                    $datos["codigo"] = $parametros["p2"];
                    $datos["apepat"] = $parametros["p3"];
                    $datos["apemat"] = $parametros["p4"];
                    $datos["nombre"] = $parametros["p5"];
                    $datos["dni"] = $parametros["p6"];
                    $resultado = $o_ActionReporte->cargarTablaPersonal($datos);
                    break;
                }
            case 'cargarEstadisticasHistorialGuardado': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos["idEstadistica"] = $parametros["p2"];
                    $datos["TipoGrafico"] = $parametros["p3"];
                    $datos["prefijo"] = $parametros["p4"];
                    $resultado = $o_ActionReporte->cargarEstadisticasHistorialGuardado($datos);
                    break;
                }
            case 'cargarTablaServicios': {
                    require_once("ActionReporte.php");
                    header("Content-type: text/xml");
                    $o_ActionReporte = new ActionReporte();
                    $datos["servicio"] = $parametros["p2"];
                    $resultado = $o_ActionReporte->cargarTablaServicios($datos);
                    break;
                }
            case 'cargarTablaSedes': {
                    require_once("ActionReporte.php");
                    header("Content-type: text/xml");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->cargarTablaSedes();
                    break;
                }
            case 'tablaAmbiLo': {
                    require_once("ActionReporte.php");
                    header("Content-type: text/xml");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->tablaAmbiLo();
                    break;
                }
            case 'tablaAmbiFi': {
                    require_once("ActionReporte.php");
                    header("Content-type: text/xml");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->tablaAmbiFi();
                    break;
                }
            case 'propiedadesPopadMedicos': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->propiedadesPopadMedicos();
                    break;
                }
            case 'propiedadesPopadProgramacion': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->propiedadesPopadProgramacion();
                    break;
                }
            case 'PopadActoMedico': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $resultado = $o_ActionOrden->PopadActoMedico();
                    break;
                }
            case 'MantenimientoEliminarTiposUnidadMedida': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos["idTipoUnidad"] = $parametros["p2"];
                    $resultado = $o_ActionMantenimientoGeneral->MantenimientoEliminarTiposUnidadMedida($datos);
                    break;
                }
            case 'MantenimientoEliminarUnidadMedida': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos["idUnidadMedida"] = $parametros["p2"];
                    $resultado = $o_ActionMantenimientoGeneral->MantenimientoEliminarUnidadMedida($datos);
                    break;
                }
            case 'EliminarTipoUnidadMedida': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos["idTipoUnidad"] = $parametros["p2"];
                    $resultado = $o_ActionMantenimientoGeneral->EliminarTipoUnidadMedida($datos);
                    break;
                }
            case 'modificarRadioButtonUnidadMedida': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos["idUnidad"] = $parametros["p2"];
                    $resultado = $o_ActionMantenimientoGeneral->modificarRadioButtonUnidadMedida($datos);
                    break;
                }
            case 'EliminarUnidadMedida': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos["idUnidad"] = $parametros["p2"];
                    $resultado = $o_ActionMantenimientoGeneral->EliminarUnidadMedida($datos);
                    break;
                }
            case'grabarMantenimientoTipoUnidadMedida': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos["idTipoUnidadMedida"] = $parametros["p2"];
                    $datos["TipoUnidadMedida"] = $parametros["p3"];
                    $resultado = $o_ActionMantenimientoGeneral->grabarMantenimientoTipoUnidadMedida($datos);
                    break;
                }
            case'MantenimientoUnidadMedida': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos["idUnidadMedida"] = $parametros["p2"];
                    $datos["idTipoUnidadMedida"] = $parametros["p3"];
                    $resultado = $o_ActionMantenimientoGeneral->MantenimientoUnidadMedida($datos);
                    break;
                }
            case 'grabarAgregarTipoUnidadMedida': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos["TipoUnidadMedida"] = $parametros["p2"];
                    $resultado = $o_ActionMantenimientoGeneral->grabarAgregarTipoUnidadMedida($datos);
                    break;
                }
            case 'grabarAgregarUnidadMedida': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos["idTipoUnidadMedida"] = $parametros["p2"];
                    $datos["unidadMedida"] = $parametros["p3"];
                    $datos["principal"] = $parametros["p4"];
                    $datos["equivalencia"] = $parametros["p5"];
                    $resultado = $o_ActionMantenimientoGeneral->grabarAgregarUnidadMedida($datos);
                    break;
                }
            case'grabarMantenimientoUnidadMedida': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos["idTipoUnidadMedida"] = $parametros["p2"];
                    $datos["idUnidad"] = $parametros["p3"];
                    $datos["unidadMedida"] = $parametros["p4"];
                    $datos["principal"] = $parametros["p5"];
                    $datos["equivalencia"] = $parametros["p6"];
                    $resultado = $o_ActionMantenimientoGeneral->grabarMantenimientoUnidadMedida($datos);
                    break;
                }

            case 'asignarAmbienteFisico': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $resultado = $o_ActionMantenimientoGeneral->asignarAmbienteFisico();
                    break;
                }

            case 'mantenimientoAlmacen': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMant = new ActionMantenimientoGeneral();
                    $datos['idAlmacen'] = $parametros["p2"];
                    $resultado = $o_ActionMant->aMantenimientoAlmacen($datos);
                    break;
                }
            case 'tablaEncargadosxArea': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->tablaEncargadosxArea($parametros["p2"]);
                    break;
                }
            case 'grabarPersonaEncargada': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["idEmpleado"] = $parametros["p2"];
                    $datos["fechIni"] = $parametros["p3"];
                    $datos["fechFin"] = $parametros["p4"];
                    $datos["estado"] = $parametros["p5"];
                    $datos["idProgPer"] = $parametros["p6"];
                    $datos["hacer"] = $parametros["p7"];
                    $resultado = $o_ActionRrhh->grabarPersonaEncargada($datos);
                    break;
                }
            case 'editarEmpleadoCargo': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->editarEmpleadoCargo($parametros["p2"]);
                    break;
                }
            case 'getDatosEncargado': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->getDatosEncargado($parametros["p2"]);
                    break;
                }
            case 'grabarHorariosProgramados': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["idProgramacionPersonal"] = $parametros["p2"];
                    $datos["idEmpleado"] = $parametros["p3"];
                    $datos["iIdSedeEmpresaAreaCentroCosto"] = $parametros["p4"];
                    $datos["arrayIdTSEA"] = explode(",", $parametros["p5"]);
                    $datos["arrayHorasTurno"] = explode(",", $parametros["p6"]);
                    $datos["arrayFechaProgEmp"] = explode(",", $parametros["p7"]);
                    $datos["accion"] = $parametros["p8"];
                    if ($parametros["p8"] == "modificar")
                        $datos["arrayEditados"] = explode(",", $parametros["p9"]);
                    $datos["modo"] = explode("|", $parametros["p10"]);
                    $datos["numprog"] = $parametros["p11"];
                    $datos["idSubArea"] = $parametros["p12"];
                    $resultado = $o_ActionRrhh->grabarHorariosProgramados($datos);
                    break;
                }
            case 'adicionarHorariosProgramados': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["idProgramacionPersonal"] = $parametros["p2"];
                    $datos["idEmpleado"] = $parametros["p3"];
                    $datos["iIdSedeEmpresaAreaCentroCosto"] = $parametros["p4"];
                    $datos["arrayIdTSEA"] = explode(",", $parametros["p5"]);
                    $datos["arrayHorasTurno"] = explode(",", $parametros["p6"]);
                    $datos["arrayFechaProgEmp"] = explode(",", $parametros["p7"]);
                    $datos["idDPP"] = $parametros["p8"];
                    $datos["idSubArea"] = $parametros["p9"];
                    $resultado = $o_ActionRrhh->adicionarHorariosProgramados($datos);
                    break;
                }
            case 'configurarTurnosProgramar': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->configurarTurnosProgramar();
                    break;
                }
            case 'listaLeyendaTurno': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->listaLeyendaTurno();
                    break;
                }
            case 'cargarCboLeyenda': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->cargarCboLeyenda();
                    break;
                }
            case 'buscarAmbienteFisico': {
                    require_once("ActionMantenimientoGeneral.php");
                    header("Content-type: text/xml");
                    $o_ActionMant = new ActionMantenimientoGeneral();
                    $resultado = $o_ActionMant->buscarAmbienteFisico($parametros["p2"], $parametros["p3"]);
                    break;
                }
            case 'grabarAgregarAlmacen': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos["idAmbienteFisico"] = $parametros["p2"];
                    $datos["nombreAlmacen"] = $parametros["p3"];
                    $datos["descripcion"] = $parametros["p4"];
                    $datos["nombreAlmacenPersona"] = $parametros["p5"];
                    $resultado = $o_ActionMantenimientoGeneral->grabarAgregarAlmacen($datos);
                    break;
                }
            case 'guardarAlmacen': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMant = new ActionMantenimientoGeneral();
                    $datos = array();
                    $datos["p1"] = $parametros["p2"];
                    $datos["p2"] = $parametros["p3"];
                    $datos["p3"] = $parametros["p4"];
                    $resultado = $o_ActionMant->guardarAlmacen($datos);
                    break;
                }
            case 'BusquedaAmbiteFisico': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMant = new ActionMantenimientoGeneral();
                    $datos = array();
                    $datos["p1"] = $parametros["p2"];
                    $datos["p2"] = $parametros["p3"];
                    $datos["p3"] = $parametros["p4"];
                    $resultado = $o_ActionMant->guardarAlmacen($datos);
                    break;
                }
            case 'asignarSedeArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["idArea"] = $parametros["p2"]; //idarea
                    $datos["idSedeEmpresa"] = $parametros["p3"]; //idsedearea
                    $resultado = $o_ActionRrhh->asignarSedeArea($datos);
                    break;
                }
            case 'asignacionEmpleadosxSubAreas': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->asignacionEmpleadosxSubAreas();
                    break;
                }
            case 'menuCordinadoresTurnos': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->menuCordinadoresTurnos();
                    break;
                }
            case 'comboSedesAreas': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $codSede = $parametros["p2"];
                    $datos = array();
                    $datos["codigoCentroCosto"] = $parametros["p2"];
                    $datos["funcionEjecutar"] = '';
                    $datos["ip"] = $_SESSION["ip"];
                    $datos["codigoSede"] = $codSede;
                    $resultado = $o_ActionRrhh->listaDatosSedeAreas($datos);
                    break;
                }

            case 'agregarSubAreas': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->agregarSubAreas();
                    break;
                }
            case 'grabarSubArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["descripcion"] = $parametros["p2"];
                    $datos["abreviatura"] = $parametros["p3"];
                    $datos["estado"] = $parametros["p4"];
                    $datos["idArea"] = $parametros["p5"];
                    $resultado = $o_ActionRrhh->grabarSubArea($datos);
                    break;
                }
            case 'grabarCategoriaSubArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["cboCategoriaPuesto"] = $parametros["cboCategoriaPuesto"];
                    $datos["cboSubArea"] = $parametros["cboSubArea"];
                    $resultado = $o_ActionRrhh->grabarCategoriaSubArea($datos);
                    break;
                }
            case 'cambiarEstadoCategoriasSubArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->cambiarEstadoCategoriasSubArea($parametros["p2"]);
                    break;
                }
            case 'mostrarTablaSubAreas': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["codigosede"] = $parametros["p2"];
                    $datos["codigoarea"] = $parametros["p3"];
                    $resultado = $o_ActionRrhh->mostrarTablaSubAreas($datos);
                    break;
                }
            case 'mostrarTablaEmpleadosAreas': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["codigosede"] = $parametros["p2"];
                    $datos["codigoarea"] = $parametros["p3"];
                    $resultado = $o_ActionRrhh->mostrarTablaEmpleadosAreas($datos);
                    break;
                }
            case 'mostrarTablaEmpleadosSubArea': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["codigosede"] = $parametros["p2"];
                    $datos["codigoarea"] = $parametros["p3"];
                    $resultado = $o_ActionRrhh->mostrarTablaEmpleadosSubArea($datos);
                    break;
                }
            case 'eliminarEmpleadoSubArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["codigoEmpleadoSubArea"] = $parametros["p2"];
                    $resultado = $o_ActionRrhh->eliminarEmpleadoSubArea($datos);
                    break;
                }
            case 'asignacionEmpleadoaSubArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["codigoSubArea"] = $parametros["p2"];
                    $datos["codigoEmpleado"] = $parametros["p3"];
                    $resultado = $o_ActionRrhh->asignacionEmpleadoaSubArea($datos);
                    break;
                }
            case 'mostrarContenidoProgramacionAsistencial': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["codigoCoordinador"] = $parametros["p2"];
                    $datos["mes"] = $parametros["p3"];
                    $datos["anio"] = $parametros["p4"];
                    $resultado = $o_ActionRrhh->generarContenidoProgramacionAsistencial($datos);
                    break;
                }
            case 'verificarHistoriaClinica': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos = array();
                    $datos["p1"] = $parametros["p2"];
                    $resultado = $o_ActionReporte->verificarHistoriaClinica($datos);
                    break;
                }
            case 'verificarHistoriaClinicaXDia': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos = array();
                    $datos["codProgramacion"] = $parametros["p2"];
                    $resultado = $o_ActionReporte->verificarHistoriaClinicaXDia($datos);
                    break;
                }
            case 'agregarTurnoAdicional': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["p1"] = $parametros["p2"];
                    $datos["p2"] = $parametros["p3"];
                    $datos["p3"] = $parametros["p4"];
                    $datos["p4"] = $parametros["p5"];
                    $datos["p5"] = $parametros["p6"];
                    $resultado = $o_ActionRrhh->agregarTurnoAdicional($datos);
                    break;
                }
            case 'mostrarReporteAsistencial': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $o_ActionRrhh->mostrarReporteAsistencial();
                    break;
                }
            case 'cargarCboCategoria': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->cargarCboCategoria($parametros["p2"]);
                    break;
                }
            case 'cargarCboCategoria2': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->cargarCboCategoria2($parametros["p2"], $parametros["p3"]);
                    break;
                }
            case 'generarFormato': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["codigoSubArea"] = $parametros["p2"];
                    $datos["codigoCategoria"] = $parametros["p3"];
                    $datos["mes"] = $parametros["p4"];
                    $datos["anio"] = $parametros["p5"];
                    $datos["descMes"] = $parametros["p6"];
                    $datos["nomCategoriapuesto"] = $parametros["p7"];
                    $datos["nomSubArea"] = $parametros["p8"];
                    $datos["nomSede"] = $parametros["p9"];
                    $resultado = $o_ActionRrhh->obtenerEmpleadosCategoriadelSubArea($datos);
                    break;
                }
            case 'generarFormatoUnificado': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["mes"] = $parametros["p2"];
                    $datos["anio"] = $parametros["p3"];
                    $datos["descMes"] = $parametros["p4"];
                    $datos["datos"] = $parametros["p5"];
                    $datos["descArea"] = $parametros["p6"];
                    $resultado = $o_ActionRrhh->generarFormatoUnificado($datos);
                    break;
                }
            case 'cargarBaseDelExcel': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["mes"] = $parametros["p2"];
                    $datos["anio"] = $parametros["p3"];
                    $datos["coordinador"] = $parametros["p4"];
                    $datos["nameFileImport"] = $parametros["p5"];
                    $datos["idSubArea"] = $parametros["p6"];
                    $resultado = $o_ActionRrhh->cargarBaseDelExcel($datos);
                    break;
                }
            case 'PresentarHorarioEmpleadoTrabjados': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["p1"] = $parametros["p2"];
                    $datos["p2"] = $parametros["p3"];
                    $datos["p3"] = $parametros["p4"];
                    $datos["p4"] = $parametros["p5"];
                    $datos["p5"] = $parametros["p6"];
                    $datos["p6"] = $parametros["p7"];
                    $datos["p7"] = $parametros["p8"];
                    $resultado = $o_ActionRrhh->PresentarHorarioEmpleadoTrabjados($datos);
                    break;
                }
            case 'empleadosHorasTrabajadasExcel': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["p1"] = $parametros["p2"]; //cboCategoria
                    $datos["p2"] = $parametros["p3"]; //txtFechaIni
                    $datos["p3"] = $parametros["p4"]; //txtFechaFin
                    $datos["p4"] = $parametros["p5"]; //cboTipoContrato
                    $datos["p5"] = $parametros["p6"]; //cboSucursal
                    $datos["p6"] = $parametros["p7"]; //cboTipoSueldo
                    $datos["p7"] = $parametros["p8"]; //iIdArea
                    $datos["p8"] = $parametros["p9"]; //descripSucursal
                    $datos["p9"] = $parametros["p10"]; //descripContrato
                    $o_ActionRrhh->empleadosHorasTrabajadasExcel($datos);
                    break;
                }
            case 'exportarExcelHorarios': {
                    require_once("ActionRrhh.php");
                    $datos = array();
                    $datos["anio"] = $parametros["p2"];
                    $datos["mes"] = $parametros["p3"];
                    $datos["idSedeEmpresaArea"] = $parametros["p4"];
                    $datos["iIdProgramacionpersonal"] = $parametros["p5"];
                    $datos["descSucursal"] = $parametros["p6"];
                    $datos["descArea"] = $parametros["p7"];
                    $datos["idSEACC"] = $parametros["p8"];
                    $datos["cboTipoContrato"] = $parametros["p9"];
                    $datos["idSubArea"] = $parametros["p10"];
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->exportarExcelHorarios($datos);
                    break;
                }
            case 'exportarExcelHorarioPersona': {
                    require_once("ActionRrhh.php");
                    $datos = array();
                    $datos["anio"] = $parametros["p2"];
                    $datos["mes"] = $parametros["p3"];
                    $datos["idSedeEmpresaArea"] = $parametros["p4"];
                    $datos["iIdProgramacionpersonal"] = $parametros["p5"];
                    $datos["idEmpleado"] = $parametros["p6"];
                    $datos["descSucursal"] = $parametros["p7"];
                    $datos["descArea"] = $parametros["p8"];
                    $datos["idSEACC"] = $parametros["p9"];
                    $datos["nomEmpleado"] = $parametros["p10"];
                    $datos["cboTipoContrato"] = $parametros["p11"];
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->exportarExcelHorarioPersona($datos);
                    break;
                }
            case 'exportarExcelArea': {
                    require_once("ActionRrhh.php");
                    $datos = array();
                    $datos["anio"] = $parametros["p2"];
                    $datos["mes"] = $parametros["p3"];
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->exportarExcelArea($datos);
                    break;
                }
            case 'asignarHorarioFijo': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["idSedeEmpresaArea"] = $parametros["p2"];
                    $datos["nomEmpleado"] = $parametros["p3"];
                    $resultado = $o_ActionRrhh->asignarHorarioFijo($datos);
                    break;
                }
            case 'grabarHorarioFijo': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["idProgramacionPersonal"] = $parametros["p2"];
                    $datos["idEmpleado"] = $parametros["p3"];
                    $datos["iIdSEACC"] = $parametros["p4"];
                    $datos["iIdTSEA"] = $parametros["p5"];
                    $datos["horasTurno"] = $parametros["p6"];
                    $datos["fechaInicio"] = $parametros["p7"];
                    $datos["fechaFin"] = $parametros["p8"];
                    $datos["idSubArea"] = $parametros["p9"];
                    $resultado = $o_ActionRrhh->grabarHorarioFijo($datos);
                    break;
                }
            case 'uploadFotoEmpleado': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["idPersona"] = $parametros["p2"];
                    $datos["rutaFoto"] = $parametros["p3"];
                    $resultado = $o_ActionRrhh->uploadFotoEmpleado($datos);
                    break;
                }
            case 'uploadExcelHorarios': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["idSubArea"] = $parametros["p2"];
                    $datos["idCategoria"] = $parametros["p3"];
                    $resultado = $o_ActionRrhh->uploadExcelHorarios($datos);
                    break;
                }
            case 'regularizarHorarios': {
                    require_once '../../cvista/rrhh/RegularizacionHorario1.php';
                    break;
                }
            case 'BusquedaEmpleado': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["p1"] = $parametros["p2"]; //cboRegularizado
                    $datos["p2"] = $parametros["p3"]; //txtFechaIni
                    $datos["p3"] = $parametros["p4"]; //txtFechaFinal
                    $datos["p4"] = $parametros["p5"]; //c_cod_per
                    $datos["p5"] = $parametros["p6"]; //apellidoPaterno
                    $datos["p6"] = $parametros["p7"]; //apellidoMaterno
                    $datos["p7"] = $parametros["p8"]; //nombres
                    $datos["p8"] = $parametros["p9"]; //idEmpleado
                    $datos["p9"] = $parametros["p10"]; //comboTipoDocumentos
                    $datos["p10"] = $parametros["p11"]; //nroDoc
                    $resultado = $o_ActionRrhh->BusquedaEmpleado($datos);
                    break;
                }

            case 'BusquedaPersonaRegularizar': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $c_cod_per = $parametros["p2"];
                    $resultado = $o_ActionRrhh->BusquedaPersonaRegularizar($c_cod_per);
                    break;
                }

            case 'ModificarRegularizacion': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["iIdCodigoempleado"] = $parametros["p2"];
                    $datos["NombreCompleto"] = $parametros["p3"];
                    $datos["vSede"] = $parametros["p4"];
                    $datos["vArea"] = $parametros["p5"];
                    $datos["dFecha"] = $parametros["p6"];
                    $datos["vTurnos"] = $parametros["p7"];
                    $datos["idProgramacionEmpleados"] = $parametros["p8"];

                    $resultado = $o_ActionRrhh->ModificarRegularizacion($datos);
                    break;
                }
//                +c_cod_per+'&p3='+NombreCompleto+'&p4='+Fecha+'&p5='+horaEntrada
//            +'&p6='+horaSalida+'&p7='+estadoRegulado;
            case 'ActualizarTablansdHorarioRealesAsistencia': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["p1"] = $parametros["p2"];
                    $datos["p2"] = $parametros["p3"];
                    $datos["p3"] = $parametros["p4"];
                    $datos["p4"] = $parametros["p5"];
                    $resultado = $o_ActionRrhh->ActualizarTablansdHorarioRealesAsistencia($datos);
                    break;
                }
            case 'podpadBusquedaEmpleado': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->podpadBusquedaEmpleado();
                    break;
                }
            case 'tablaMarcacionEmpleadosAudiotira': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->tablaMarcacionEmpleadosAudiotira($parametros);
                    break;
                }
            case 'calendario03': {
                    $p2 = $parametros["p2"]; //Fecha
                    $p3 = $parametros["p3"]; //Accion
                    $tsFechaActual = empty($p2) ? strtotime(date("Y-m-d")) : strtotime($p2);
                    $idAccion = empty($p3) ? '5' : $p3;
                    $o_Cal03 = new Calendario('cal03', 'botonAccionCalendario', 'cabeceraCalendario', 'btnCalendario', 'estiloCasillaSeleccionada', $tsFechaActual, $idAccion, 'seleccionarFechaEmergencia', 'accionCalendarioCitasInformesEmergencia', '1');
                    $calendario = $o_Cal03->getHTMLFullCalendario();
                    $fechaObtenida = $o_Cal03->getTsFechaObtenida();
                    $resultado = $calendario . "|" . strftime('%Y-%m-%d', $fechaObtenida);
                    break;
                }
            case 'menuMostrarEmergencia': {
                    require_once("ActionEmergencia.php");
                    $o_ActionEmergencia = new ActionEmergencia();
                    $resultado = $o_ActionEmergencia->menuMostrarEmergencia();
                    break;
                }
            case 'CargarDoctoXpaciente' : {
                    require_once("ActionEmergencia.php");
                    $o_ActionEmergencia = new ActionEmergencia();
                    $datos["fechaSeleccionada"] = $parametros["p2"];
                    $datos["codigoCentroCosto"] = $parametros["p3"];
                    $datos["codigoDoctorPersona"] = $parametros["p4"];
                    $datos["hcodigoDoctorper"] = $parametros["p5"];
                    $datos["hidCentroCosto"] = $parametros["p6"];
                    $datos["hApelledoPaterno"] = $parametros["p7"];
                    $datos["hApelledoMaterno"] = $parametros["p8"];
                    $datos["hNombrePaciente"] = $parametros["p9"];
                    $resultado = $o_ActionEmergencia->CargarDoctoXpaciente($datos);
                    break;
                }
            case 'cboSedeEmpresaArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->cboSedeEmpresaArea($parametros["p2"]);
                    break;
                }
            case 'asignarPuestoSedeArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->asignarPuestoSedeArea($parametros["p2"], $parametros["p3"]);
                    break;
                }
            case 'mostrarPuestoArea': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh(); //$parametros["p3"]
                    $resultado = $o_ActionRrhh->mostrarPuestoArea($parametros["p2"]);
                    break;
                }
            case 'eliminacionFisicaPuestoArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->eliminacionFisicaPuestoArea($parametros["p2"]);
                    break;
                }
            case 'grabarContrato': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["cboModContrato"] = $parametros["p2"];
                    $datos["cboTipoSueldo"] = $parametros["p3"];
                    $datos["txtSueldo"] = $parametros["p4"];
                    $datos["txtFechaIni"] = $parametros["p5"];
                    $datos["txtFechaFin"] = $parametros["p6"];
                    $datos["idEmpleado"] = $parametros["p7"];
                    $resultado = $o_ActionRrhh->grabarContrato($datos);
                    break;
                }
            case 'EditarDetallePaciente': {
                    require_once("ActionEmergencia.php");
                    $datos["CodigoProgramacion"] = $parametros["p2"];
                    $datos["nomPaciente"] = $parametros["p3"];
                    $datos["edad"] = $parametros["p4"];
                    $datos["Sexo"] = $parametros["p5"];
                    $datos["Medico"] = $parametros["p6"];
                    $datos["codigocama"] = $parametros["p7"];
                    $datos["Diagnostico"] = $parametros["p8"];
                    $datos["destino"] = $parametros["p9"];
                    $datos["dni"] = $parametros["p10"];
                    $datos["CodigoCronograma"] = $parametros["p11"];
                    $datos["cod_per"] = $parametros["p12"];
                    $datos["AmbienteFisico"] = $parametros["p13"];
                    $datos["fechaEntrada"] = $parametros["p14"];
                    $datos["horaEntrada"] = $parametros["p15"];
                    $datos["codigoPaciente"] = $parametros["p16"];
                    $o_ActionEmergencia = new ActionEmergencia();
                    $resultado = $o_ActionEmergencia->EditarDetallePaciente($datos);
                    break;
                }
            case 'GuardarnsdProgramacionPacientesEmergencia': {
                    require_once("ActionEmergencia.php");
                    $Datos["idProgramacionPacientesEmergencia"] = $parametros["p2"];
                    $Datos["idCama"] = $parametros["p3"];
                    $Datos["idCboDestino"] = $parametros["p4"];
                    $Datos["txtDescDestino"] = $parametros["p5"];
                    $Datos["fila"] = $parametros["p6"];
                    $Datos["hCodigoCama"] = $parametros["p7"];
                    $o_ActionEmergencia = new ActionEmergencia();
                    $resultado = $o_ActionEmergencia->GuardarnsdProgramacionPacientesEmergencia($Datos);
                    break;
                }
            case 'ComboCama': {
                    require_once("ActionEmergencia.php");
                    $Datos["idCodigoAmbienteFisico"] = $parametros["p2"];
                    $Datos["fila"] = $parametros["p3"];
                    $Datos["estadoCama"] = $parametros["p4"];
                    $o_ActionEmergencia = new ActionEmergencia();
                    $resultado = $o_ActionEmergencia->ComboCama($Datos);
                    break;
                }
            case 'reporteEmergenciaxDiagnosticoGeneral': {
                    require_once("ActionEmergencia.php");
                    $o_ActionEmergencia = new ActionEmergencia();
                    $resultado = $o_ActionEmergencia->reporteEmergenciaxDiagnosticoGeneral();
                    break;
                }
            case 'EmergenciaXFecha': {
                    require_once("ActionEmergencia.php");
                    $o_ActionEmergencia = new ActionEmergencia();
                    $Datos["fechaInicio"] = $parametros["p2"];
                    $Datos["fechafinal"] = $parametros["p3"];
                    $resultado = $o_ActionEmergencia->EmergenciaXFecha($Datos);
                    break;
                }
            case 'reporteEmergenciaxDiagnosticoServicio': {
                    require_once("ActionEmergencia.php");
                    $o_ActionEmergencia = new ActionEmergencia();
                    $resultado = $o_ActionEmergencia->reporteEmergenciaxDiagnosticoServicio();
                    break;
                }
            case 'EmergenciaXFechaServicio': {
                    require_once("ActionEmergencia.php");
                    $o_ActionEmergencia = new ActionEmergencia();
                    $Datos["fechaInicio"] = $parametros["p2"];
                    $Datos["fechafinal"] = $parametros["p3"];
                    $resultado = $o_ActionEmergencia->EmergenciaXFechaServicio($Datos);
                    break;
                }
            case 'ExpotarExcelDiagnostico': {
                    require_once("ActionEmergencia.php");
                    $o_ActionEmergencia = new ActionEmergencia();
                    $Datos["fechaInicio"] = $parametros["p2"];
                    $Datos["fechafinal"] = $parametros["p3"];
                    $resultado = $o_ActionEmergencia->ExpotarExcelDiagnostico($Datos);
                    break;
                }
            case 'mostrarHospitalizados': {
                    require_once("ActionHospitalizacion.php");
                    $o_ActionHospitalizacion = new ActionHospitalizacion();
                    $resultado = $o_ActionHospitalizacion->mostrarHospitalizados();
                    break;
                }
            case 'NuevoPaciente': {
                    require_once("ActionHospitalizacion.php");
                    $o_ActionHospitalizacion = new ActionHospitalizacion();
                    $resultado = $o_ActionHospitalizacion->NuevoPaciente();
                    break;
                }
            case 'nuevoPacienteHospitalizacion': {
                    require_once("ActionHospitalizacion.php");
                    $o_ActionHospitalizacion = new ActionHospitalizacion();
                    $resultado = $o_ActionHospitalizacion->nuevoPacienteHospitalizacion();
                    break;
                }
            case 'busquedaPaciente': {
                    require_once("ActionHospitalizacion.php");
                    header("Content-type: text/xml");
                    $o_ActionHospitalizacion = new ActionHospitalizacion();
                    $datos["txtApePaternoPaciente"] = $parametros["p2"];
                    $datos["txtApeMaternoPaciente"] = $parametros["p3"];
                    $datos["txtNombrePaciente"] = $parametros["p4"];
                    $resultado = $o_ActionHospitalizacion->busquedaPaciente($datos);
                    break;
                }
            case 'buscarParentescoPaciente': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->buscarParentescoPaciente();
                    break;
                }
            case 'grabarParentescoPaciente': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->grabarParentescoPaciente($parametros["p2"], $parametros["p3"]);
                    break;
                }
            case 'listaParentescoPaciente': {
                    require_once("ActionAdmision.php");
                    header("Content-type: text/xml");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->listaParentescoPaciente($parametros["p2"]);
                    break;
                }
            case 'eliminarParentescoPaciente': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $resultado = $o_ActionAdmision->eliminarParentescoPaciente($parametros["p2"]);
                    break;
                }
            case 'asingarParientePaciente': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $datos = array();
                    $datos["idPerentescoDePersona"] = $parametros["p2"];
                    $datos["idParentesco"] = $parametros["p3"];
                    $resultado = $o_ActionAdmision->asingarParientePaciente($datos);
                    break;
                }
            case 'busquedaMedicotratante': {
                    require_once("ActionHospitalizacion.php");
                    $o_ActionHospitalizacion = new ActionHospitalizacion();

                    $resultado = $o_ActionHospitalizacion->busquedaMedicotratante();
                    break;
                }
            case 'busquedaPersonaMedicoTratante': {
                    require_once("ActionHospitalizacion.php");
                    header("Content-type: text/xml");
                    $o_ActionHospitalizacion = new ActionHospitalizacion();
                    $datos["txtApePaternoPaciente"] = $parametros["p2"];
                    $datos["txtApeMaternoPaciente"] = $parametros["p3"];
                    $datos["txtNombrePaciente"] = $parametros["p4"];
                    $resultado = $o_ActionHospitalizacion->busquedaPersonaMedicoTratante($datos);
                    break;
                }
            case 'busquedaMedicoOrdInt': {
                    require_once("ActionHospitalizacion.php");
                    $o_ActionHospitalizacion = new ActionHospitalizacion();
                    $resultado = $o_ActionHospitalizacion->busquedaMedicoOrdInt();
                    break;
                }

            case 'busquedaPersonaMedicoOrdInt': {
                    require_once("ActionHospitalizacion.php");
                    header("Content-type: text/xml");
                    $o_ActionHospitalizacion = new ActionHospitalizacion();
                    $datos["txtApePaternoPaciente"] = $parametros["p2"];
                    $datos["txtApeMaternoPaciente"] = $parametros["p3"];
                    $datos["txtNombrePaciente"] = $parametros["p4"];
                    $resultado = $o_ActionHospitalizacion->busquedaPersonaMedicoOrdInt($datos);
                    break;
                }

            case 'busquedaMedicoAlta': {
                    require_once("ActionHospitalizacion.php");
                    $o_ActionHospitalizacion = new ActionHospitalizacion();
                    $resultado = $o_ActionHospitalizacion->busquedaMedicoAlta();
                    break;
                }
            case 'busquedaPersonaMedicoAlta': {
                    require_once("ActionHospitalizacion.php");
                    header("Content-type: text/xml");
                    $o_ActionHospitalizacion = new ActionHospitalizacion();
                    $datos["txtApePaternoPaciente"] = $parametros["p2"];
                    $datos["txtApeMaternoPaciente"] = $parametros["p3"];
                    $datos["txtNombrePaciente"] = $parametros["p4"];
                    $resultado = $o_ActionHospitalizacion->busquedaPersonaMedicoAlta($datos);
                    break;
                }

            case 'cboAmbienteFisico': {
                    require_once("ActionHospitalizacion.php");
                    $o_ActionHospitalizacion = new ActionHospitalizacion();
                    $idPisos = $parametros["p2"];
                    $resultado = $o_ActionHospitalizacion->cboAmbienteFisico($idPisos);
                    break;
                }
            case 'cboCama': {
                    require_once("ActionHospitalizacion.php");
                    $o_ActionHospitalizacion = new ActionHospitalizacion();
                    $idAmbienteFisico = $parametros["p2"];
                    $resultado = $o_ActionHospitalizacion->cboCama($idAmbienteFisico);
                    break;
                }
            case 'PacienteGuardarHospitalizacion': {
                    require_once("ActionHospitalizacion.php");
                    $o_ActionHospitalizacion = new ActionHospitalizacion();
                    $datos["txtCodigoPaciente"] = $parametros["p2"];
                    $datos["txtidCentroCosto"] = $parametros["p3"];
                    $datos["txtiEmpleadoMedicoOrdInt"] = $parametros["p4"];
                    $datos["txtiEmpleadoMedicoTratante"] = $parametros["p5"];
                    $datos["txtiEmpleadoMedicoAlta"] = $parametros["p6"];
                    $datos["txtcIdAfiliacion"] = $parametros["p7"];
                    $datos["cboCama"] = $parametros["p8"];
                    $datos["cboAmbienteFisico"] = $parametros["p9"];
                    $datos["txtAmbLogicoTratante"] = $parametros["p10"];
                    $datos["txtFechaIngreso"] = $parametros["p11"];
                    $datos["iCodigoDestino"] = $parametros["p12"];
//                    $datos["iCodigoDiagnosticoEntrada"] = $parametros["p13"];
//                    $datos["iCodigoDiagnosticoSalida"] = $parametros["p14"];
                    $resultado = $o_ActionHospitalizacion->PacienteGuardarHospitalizacion($datos);
                    break;
                }
            case 'BorrarHospitalizacion': {
                    require_once("ActionHospitalizacion.php");
                    $o_ActionHospitalizacion = new ActionHospitalizacion();
                    $CodigoHospitalizacion = $parametros["p2"];

                    $resultado = $o_ActionHospitalizacion->BorrarHospitalizacion($CodigoHospitalizacion);
                    break;
                }

            case 'BuscarHospitalizacion': {
                    require_once("ActionHospitalizacion.php");
                    $o_ActionHospitalizacion = new ActionHospitalizacion();
                    $datos["vtxtFechaIni"] = $parametros["p2"];
                    $datos["vtxtFechaFinal"] = $parametros["p3"];
                    $datos["vtxtApPaterno"] = $parametros["p4"];
                    $datos["vtxtApMaterno"] = $parametros["p5"];
                    $datos["vtxtNombre"] = $parametros["p6"];
                    $datos["icboPisos"] = $parametros["p7"];

                    $resultado = $o_ActionHospitalizacion->BuscarHospitalizacion($datos);
                    break;
                }
            case 'GuardarHospitalizacion': {
                    require_once("ActionHospitalizacion.php");
                    $o_ActionHospitalizacion = new ActionHospitalizacion();
                    $datos["codigoHospitalizacion"] = $parametros["p2"];
                    $datos["codigoCama"] = $parametros["p3"];
                    $datos["codigoDestino"] = $parametros["p4"];

                    $resultado = $o_ActionHospitalizacion->GuardarHospitalizacion($datos);
                    break;
                }

            case 'VistaDetallePaciente': {
                    require_once("ActionHospitalizacion.php");
                    $o_ActionHospitalizacion = new ActionHospitalizacion();
                    $datos["codigoHospitalizacion"] = $parametros["p2"];
                    $datos["codigoPaciente"] = $parametros["p3"];
                    $datos["codigoPersona"] = $parametros["p4"];
                    $datos["nombrePacienteCompleto"] = $parametros["p5"];
                    $datos["edadPaciente"] = $parametros["p6"];
                    $datos["sexoPaciente"] = $parametros["p7"];
                    $datos["nombreMedicoTratante"] = $parametros["p8"];

                    $datos["nombreMedicoAlta"] = $parametros["p9"];
                    $datos["nombreAmbienteFisco"] = $parametros["p10"];
                    $datos["codigoAmbienteFisico"] = $parametros["p11"];
                    $datos["codigoAmbLogico"] = $parametros["p12"];
                    $datos["codigoCama"] = $parametros["p13"];
                    $datos["numeroCama"] = $parametros["p14"];
                    $datos["codigoDestino"] = $parametros["p15"];
                    $datos["descripcionDestino"] = $parametros["p16"];
                    $datos["idDiagEntrada"] = $parametros["p17"];
                    $datos["idDiagSalida"] = $parametros["p18"];
                    $datos["horaIngreso"] = $parametros["p19"];
                    $datos["fechaEntrada"] = $parametros["p20"];
                    $datos["codigoHospitalizacionSiguiente"] = $parametros["p21"];

                    $resultado = $o_ActionHospitalizacion->VistaDetallePaciente($datos);
                    break;
                }
            case 'ExpotarExcelHospitalizacion': {
                    require_once("ActionHospitalizacion.php");
                    $o_ActionHospitalizacion = new ActionHospitalizacion();
                    $datos["vtxtFechaIni"] = $parametros["p2"];
                    $datos["vtxtFechaFinal"] = $parametros["p3"];
                    $datos["vtxtApPaterno"] = $parametros["p4"];
                    $datos["vtxtApMaterno"] = $parametros["p5"];
                    $datos["vtxtNombre"] = $parametros["p6"];
                    $datos["icboPisos"] = $parametros["p7"];

                    $resultado = $o_ActionHospitalizacion->ExpotarExcelHospitalizacion($datos);
                    break;
                }

            case 'TranferenciaDePaciente': {
                    require_once("ActionHospitalizacion.php");
                    $o_ActionHospitalizacion = new ActionHospitalizacion();
                    $datos["htxtCodigoPaciente"] = $parametros["p2"];
                    $datos["htxtNombreCompleto"] = $parametros["p3"];
                    $datos["htxtSexoPaciente"] = $parametros["p4"];
                    $datos["htxtEdadPaciente"] = $parametros["p5"];
                    $datos["htxtCodigoHospitalizacion"] = $parametros["p6"];
                    $resultado = $o_ActionHospitalizacion->TranferenciaDePaciente($datos);
                    break;
                }

            case 'guardarTransferenciaPaciente': {
                    require_once("ActionHospitalizacion.php");
                    $o_ActionHospitalizacion = new ActionHospitalizacion();
                    $datos["txtCodigoPaciente"] = $parametros["p2"];
                    $datos["txtidCentroCosto"] = $parametros["p3"];
                    $datos["txtiEmpleadoMedicoOrdInt"] = $parametros["p4"];
                    $datos["txtiEmpleadoMedicoTratante"] = $parametros["p5"];
                    $datos["txtiEmpleadoMedicoAlta"] = $parametros["p6"];
                    $datos["txtcIdAfiliacion"] = $parametros["p7"];
                    $datos["cboCama"] = $parametros["p8"];
                    $datos["cboAmbienteFisico"] = $parametros["p9"];
                    $datos["txtAmbLogicoTratante"] = $parametros["p10"];
                    $datos["txtFechaIngreso"] = $parametros["p11"];
                    $datos["iCodigoDestino"] = $parametros["p12"];
                    $datos["anteriorCodigoHospitalizacion"] = $parametros["p13"];
//                    $datos["iCodigoDiagnosticoSalida"] = $parametros["p14"];
                    $resultado = $o_ActionHospitalizacion->guardarTransferenciaPaciente($datos);
                    break;
                }
            /* ======================================================================= */
            /* ============================== FARMACIA SOP =========================== */
            /* ======================================================================= */
            case 'mostrarCIFarmaciaSOP': {
                    $datos = array();
                    //$datos["descripcionProductoServicio"] = $parametros["p2"];
                    require_once("../../cvista/farmacia/controlInternoFarmaciaSOP.php");
                    break;
                }

            /* ======================================================================= */
            /* ========================== Solicitudes SOP =========================== */
            /* ======================================================================= */

            case 'mostrarTablaPacientes': {
                    require_once("ActionSOP.php");
                    header("Content-type: text/xml");
                    $o_ActionSOP = new ActionSOP();
                    $datos["opcion"] = $parametros["p2"];
                    $datos["patron"] = $parametros["p3"];
                    $resultado = $o_ActionSOP->xmlTablaPacientes($datos);
                    break;
                }


            case 'tablaCieDxPreOperatorio': {
                    require_once("ActionSOP.php");
                    header("Content-type: text/xml");
                    $o_ActionSOP = new ActionSOP();
                    if (isset($parametros["p2"])) {
                        $token = $parametros["p2"];
                    } else {
                        $token = '';
                    }
                    if (isset($parametros["p3"])) {
                        $accion = $parametros["p3"];
                    } else {
                        $accion = '1';
                    }
                    $resultado = $o_ActionSOP->xmlTablaCieDxPreOperatorio($accion, $token);
                    break;
                }

            case 'mostrarVentanaOrdenConProductoServicio': {
                    require_once("ActionSOP.php");
                    $o_ActionSOP = new ActionSOP();
                    $datosDesencriptados = base64_decode($parametros["p2"]);
                    $arrayDatos = explode("|", $datosDesencriptados);
                    //datos=hidden+"|"+text+"|"+cCodPerPaciente+"|"+nomCompletoPaciente+"|"+cIdAfiliacion;
                    $hidden = $arrayDatos[0];
                    $text = $arrayDatos[1];
                    $cCodPerPaciente = $arrayDatos[2];
                    $nomCompletoPaciente = $arrayDatos[3];
                    $cIdAfiliacion = $arrayDatos[4];
                    $descAfiliacion = $arrayDatos[5];
                    $resultado = $o_ActionSOP->mostrarVentanaOrdenConProductoServicio($hidden, $text, $cCodPerPaciente, $nomCompletoPaciente, $cIdAfiliacion, $descAfiliacion);
                    break;
                }

            case 'manteOrdenConProductoServicio': {
                    require_once("ActionSOP.php");
                    $o_ActionSOP = new ActionSOP();
                    $datos["c_cod_per"] = $parametros["p2"];
                    $datos["c_cod_ccos"] = $parametros["p3"];
                    $datos["b_incluyeigv"] = $parametros["p4"];
                    $datos["nroactmed"] = $parametros["p5"];
                    $datos["c_cod_per_pago"] = $parametros["p6"];
                    $datos["cadenaDatosProdServ"] = base64_decode($parametros["p7"]);
                    $datos["accion"] = $parametros["p8"];
                    $resultado = $o_ActionSOP->manteOrdenConProductoServicio($datos);
                    break;
                }

            /*
              case 'mostrarTablaProductoServicioSeleccionados': {
              require_once("ActionSOP.php");
              header("Content-type: text/xml");
              $o_ActionSOP = new ActionSOP();
              $resultado = $o_ActionSOP->mostrarTablaProductoServicioSeleccionados();
              break;
              } */

            case 'mostrarVentanaBuscadorServicioCirugia': {
                    require_once("ActionSOP.php");
                    $o_ActionSOP = new ActionSOP();
                    $hidden = $parametros["p2"];
                    $text = $parametros["p3"];
                    $cCodPerPaciente = $parametros["p4"];
                    $cIdAfiliacion = $parametros["p5"];
                    $resultado = $o_ActionSOP->mostrarVentanaBuscadorServicioCirugia($hidden, $text, $cCodPerPaciente, $cIdAfiliacion);
                    break;
                }

            case 'mostrarTablaStockPorAlmacen': {
                    require_once("ActionSOP.php");
                    header("Content-type: text/xml");
                    $o_ActionSOP = new ActionSOP();
                    $datos["tipoBusqueda"] = $parametros["p2"];
                    $datos["patronBusqueda"] = $parametros["p3"];
                    $datos["cCodTipoProdServ"] = $parametros["p4"];
                    $datos["c_cod_t_afil"] = $parametros["p5"];
                    $resultado = $o_ActionSOP->mostrarTablaStockPorAlmacen($datos);
                    break;
                }

            case 'mostrarTablaProductoServicioSOP': {
                    require_once("ActionSOP.php");
                    header("Content-type: text/xml");
                    $o_ActionSOP = new ActionSOP();
                    $datos["tipoBusqueda"] = $parametros["p2"];
                    $datos["patronBusqueda"] = $parametros["p3"];
                    $datos["cCodTipoProdServ"] = $parametros["p4"];
                    $datos["c_cod_t_afil"] = $parametros["p5"];
                    $resultado = $o_ActionSOP->mostrarTablaProductoServicioSOP($datos);
                    break;
                }

            case 'mostrarVentanaDetallePaquete': {
                    require_once("ActionSOP.php");
                    $o_ActionSOP = new ActionSOP();
                    $c_cod_ser_pro = $parametros["p2"];
                    $c_cod_t_afil = $parametros["p3"];
                    $resultado = $o_ActionSOP->mostrarVentanaDetallePaquete($c_cod_ser_pro, $c_cod_t_afil);
                    break;
                }

            case 'mostrarTablaDetallePaquete': {
                    require_once("ActionSOP.php");
                    header("Content-type: text/xml");
                    $o_ActionSOP = new ActionSOP();
                    $datos["c_cod_ser_pro"] = $parametros["p2"];
                    $datos["c_cod_t_afil"] = $parametros["p3"];
                    $resultado = $o_ActionSOP->mostrarTablaDetallePaquete($datos);
                    break;
                }

            case 'mostrarTablaProdServDePaqueteSeleccionado': {
                    require_once("ActionSOP.php");
                    header("Content-type: text/xml");
                    $o_ActionSOP = new ActionSOP();
                    $datos["tipoBusqueda"] = 5;
                    $datos["patronBusqueda"] = $parametros["p2"]; //c_cod_ser_pro
                    $datos["cCodTipoProdServ"] = "";
                    $datos["c_cod_t_afil"] = $parametros["p3"];
                    $resultado = $o_ActionSOP->mostrarTablaProdServDePaqueteSeleccionado($datos);
                    break;
                }

            case 'tablaServicioCirugia': {
                    require_once("ActionSOP.php");
                    header("Content-type: text/xml");
                    $o_ActionSOP = new ActionSOP();
                    if (isset($parametros["p2"])) {
                        $token = $parametros["p2"];
                    } else {
                        $token = '';
                    }
                    if (isset($parametros["p3"])) {
                        $accion = $parametros["p3"];
                    } else {
                        $accion = '1';
                    }
                    $resultado = $o_ActionSOP->xmlTablaServicioCirugia($accion, $token);
                    break;
                }

            case 'mostrarTablaCirujanos': {
                    require_once("ActionSOP.php");
                    header("Content-type: text/xml");
                    $o_ActionSOP = new ActionSOP();
                    $datos["opcion"] = $parametros["p2"];
                    $datos["patron"] = $parametros["p3"];
                    $resultado = $o_ActionSOP->xmlTablaCirujanos($datos);
                    break;
                }

            case 'manteSolProgSOP': {
                    require_once("ActionSOP.php");
                    $o_ActionSOP = new ActionSOP();
                    $resultado = $o_ActionSOP->manteSolProgSOP($parametros);
                    break;
                }

            case 'mostrarManteSolicitudProgramacionSOP': {
                    require_once("ActionSOP.php");
                    $o_ActionSOP = new ActionSOP();
                    $iidSolicitudProgramacion = $parametros["p2"];
                    //$accion=2;
                    //$token=$iidSolicitudProgramacion;
                    $resultado = $o_ActionSOP->mostrarManteSolProgSOP($iidSolicitudProgramacion);
                    break;
                }
            /* ======================================================================= */
            /* ============================= Programacion SOP ======================== */
            /* ======================================================================= */
            case 'aceptarRechazarSolProgSOP': {
                    require_once("ActionSOP.php");
                    $o_ActionSOP = new ActionSOP();
                    $resultado = $o_ActionSOP->aceptarRechazarSolProgSOP($parametros);
                    break;
                }

            case 'manteProgramacionSOP': {
                    require_once("ActionSOP.php");
                    $o_ActionSOP = new ActionSOP();
                    $resultado = $o_ActionSOP->manteProgramacionSOP($parametros);
                    break;
                }

            case 'mostrarManteProgramacionSOP': {
                    require_once("ActionSOP.php");
                    $o_ActionSOP = new ActionSOP();
                    $iidSolicitudProgramacion = $parametros["p2"];
                    $resultado = $o_ActionSOP->mostrarManteProgSOP($iidSolicitudProgramacion);
                    break;
                }

            case 'mostrarBuscadorAmbienteLogico': {
                    require_once("ActionSOP.php");
                    $o_ActionSOP = new ActionSOP();
                    $hidden = $parametros["p2"];
                    $text = $parametros["p3"];
                    $resultado = $o_ActionSOP->mostrarBuscadorAmbienteLogico($hidden, $text);
                    break;
                }

            case 'mostrarAmbientesLogicosSOP': {
                    require_once("ActionSOP.php");
                    header("Content-type: text/xml");
                    $o_ActionSOP = new ActionSOP();
                    $accion = 6;
                    $token = "";
                    $resultado = $o_ActionSOP->xmlTablaAmbientesLogicosSOP($accion, $token);
                    break;
                }

            case 'tablaAmbienteLogicoSOP': {
                    require_once("ActionSOP.php");
                    header("Content-type: text/xml");
                    $o_ActionSOP = new ActionSOP();
                    $accion = 7;
                    $token = $parametros["p2"];
                    $resultado = $o_ActionSOP->xmlTablaAmbientesLogicosSOP($accion, $token);
                    break;
                }

            case 'tablaCirugiasRealizadasSOP': {
                    require_once("ActionSOP.php");
                    header("Content-type: text/xml");
                    $o_ActionSOP = new ActionSOP();
                    $accion = 3;
                    $token = $parametros["p2"]; //iidProgramacionSOP
                    $resultado = $o_ActionSOP->xmlTablaCirugiasRealizadasSOP($accion, $token);
                    break;
                }

            case 'RegularizacionEspecial': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["c_cod_per"] = $parametros["p2"];
                    $datos["NombreCompleto"] = $parametros["p3"];
                    $datos["Fecha"] = $parametros["p4"];
                    $datos["horaEntrada"] = $parametros["p5"];
                    $datos["horaSalida"] = $parametros["p6"];
                    $datos["estadoRegulado"] = $parametros["p7"];
                    $datos["idProgramacionEmpleados"] = $parametros["p8"];
                    $datos["Turno"] = $parametros["p9"];
                    $datos["codEmp"] = $parametros["p10"];
                    $resultado = $o_ActionRrhh->RegularizacionEspecial($datos);

                    break;
                }

            case 'busquedaEmpleadoRegularizado': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->busquedaEmpleadoRegularizado();

                    break;
                }

            case 'busquedaEmpleadoRegularizar': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["txtApePaternoPaciente"] = $parametros["p2"];
                    $datos["txtApeMaternoPaciente"] = $parametros["p3"];
                    $datos["txtNombrePaciente"] = $parametros["p4"];
                    $resultado = $o_ActionRrhh->busquedaEmpleadoRegularizar($datos);
                    break;
                }
            case 'guardarEmpleadoRegularizar': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["idCodigoEmpleado"] = $parametros["p2"];
                    $datos["txtFecha"] = $parametros["p3"];
                    $datos["horaInicio"] = $parametros["p4"];
                    $datos["horaFin"] = $parametros["p5"];
                    $datos["idProgramacionEmpleados"] = $parametros["p6"];
                    $resultado = $o_ActionRrhh->guardarEmpleadoRegularizar($datos);
                    break;
                }

            case 'tablaServiciosUtilizadosSOP': {
                    require_once("ActionSOP.php");
                    header("Content-type: text/xml");
                    $o_ActionSOP = new ActionSOP();
                    $accion = 4;
                    $token = $parametros["p2"]; //iidProgramacionSOP
                    $resultado = $o_ActionSOP->xmlTablaServiciosUtilizadosSOP($accion, $token);
                    break;
                }

            case 'mostrarBuscadorCirujanoSOP': {
                    require_once("ActionSOP.php");
                    $o_ActionSOP = new ActionSOP();
                    $tipoBuscador = $parametros["p2"];
                    $rowId = $parametros["p3"];
                    $cellInd = $parametros["p4"];
                    $resultado = $o_ActionSOP->mostrarBuscadorCirujanoSOP($tipoBuscador, $rowId, $cellInd);
                    break;
                }
            case 'HorariosTurnosAreaCoordinador': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["iCodEmpCoordinador"] = $parametros["p2"];
                    $datos["anio"] = $parametros["p3"];
                    $datos["mes"] = $parametros["p4"];
                    $datos["annoActual"] = $parametros["p5"];
                    $datos["mesActual"] = $parametros["p6"];
                    $datos["horaActual"] = $parametros["p7"];
                    $datos["minutosActual"] = $parametros["p8"];
                    $datos["extencion"] = $parametros["p9"];
                    $datos["idModalidadContrato"] = $parametros["p10"];
                    $resultado = $o_ActionRrhh->HorariosTurnosAreaCoordinador($datos);
                    break;
                }

            case 'desactivarEmpleadoArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $idCodigoEmpleado = $parametros["p2"];
                    $idCodigoSEACC = $parametros["p3"];
                    $resultado = $o_ActionRrhh->desactivarEmpleadoArea($idCodigoEmpleado, $idCodigoSEACC);
                    break;
                }
            case 'verificarRecibodePago' : {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos = array();
                    $datos["numeroRecibo"] = $parametros["p2"];
                    $resultado = $o_ActionReporte->verificarRecibodePago($datos);
                    break;
                }
            case 'mostrarCierreCaja' : {
                    require_once("ActionCaja.php");
                    $o_ActionCaja = new ActionCaja();
                    $resultado = $o_ActionCaja->mostrarCierreCaja();
                    break;
                }
            case 'busquedaResponsabledesuCaja' : {
                    require_once("ActionCaja.php");
                    $o_ActionCaja = new ActionCaja();
                    $datos = array();
                    $datos["numerocaja"] = $parametros["p2"];
                    $resultado = $o_ActionCaja->listarResponsabledesuCaja($datos);
                    break;
                }
            case 'mostrarTablaParteDiariaCierreCaja': {
                    require_once("ActionCaja.php");
                    header("Content-type: text/xml");
                    $o_ActionCaja = new ActionCaja();
                    if ($parametros["p2"] != '' && $parametros["p3"] != '') {
                        $datos = array();
                        $datos["numerocaja"] = $parametros["p2"];
                        $datos["fechadeproceso"] = $parametros["p3"];
                    } else {
                        $datos = '';
                    }
                    $resultado = $o_ActionCaja->mostrarTablaParteDiariaCierreCaja($datos);
                    break;
                }
            case 'cerrarCajaCierreCaja' : {
                    require_once("ActionCaja.php");
                    $o_ActionCaja = new ActionCaja();
                    $datos = array();
                    $datos["numerocaja"] = $parametros["p2"];
                    $datos["fechadeproceso"] = $parametros["p3"];
                    $resultado = $o_ActionCaja->cerrarCajaCierreCaja($datos);
                    break;
                }
            case 'anularCierreCaja' : {
                    require_once("ActionCaja.php");
                    $o_ActionCaja = new ActionCaja();
                    $datos = array();
                    $datos["numerocaja"] = $parametros["p2"];
                    $datos["fechadeproceso"] = $parametros["p3"];
                    $resultado = $o_ActionCaja->anularCierreCaja($datos);
                    break;
                }
            case 'mostrarVentanaTesoreriaAperturaDeDocumentos': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $resultado = $o_ActionOrden->mostrarVentanaTesoreriaAperturaDeDocumentos();
                    break;
                }
            case 'mostrarTablaTipoComprobantesAperturados': {
                    require_once("ActionOrden.php");
                    header("Content-type: text/xml");
                    $o_ActionOrden = new ActionOrden();
                    $datos["codCaja"] = $parametros["p2"];
                    $datos["fechaHoy"] = $parametros["p3"];
                    $resultado = $o_ActionOrden->mostrarTablaTipoComprobantesAperturados($datos);
                    break;
                }
            case 'cargarDatosCboSerieComprobante': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $datos["codCaja"] = $parametros["p2"];
                    $datos["codTipoComprobante"] = $parametros["p3"];
                    $resultado = $o_ActionOrden->cargarDatosCboSerieComprobante($datos);
                    break;
                }
            case 'agregarTipoComprobante': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $datos["accion"] = 1;
                    $datos["codPerCajero"] = $parametros["p2"];
                    $datos["fechaHoy"] = $parametros["p3"];
                    $datos["codCaja"] = $parametros["p4"];
                    $datos["codTipoComprobante"] = $parametros["p5"];
                    $datos["codSerieComprobante"] = $parametros["p6"];
                    $datos["nroActualSerieComprobante"] = $parametros["p7"];
                    $resultado = $o_ActionOrden->agregarTipoComprobante($datos);
                    break;
                }
            case 'cargarDatosCboTipoComprobante': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $datos["codCaja"] = $parametros["p2"];
                    $datos["fechaHoy"] = $parametros["p3"];
                    $resultado = $o_ActionOrden->cargarDatosCboTipoComprobante($datos);
                    break;
                }
            case 'mostrarVentanaFacturacionOrdenPaciente': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $datos = $parametros["p2"];
                    $datosDesencriptados = base64_decode($datos);
                    $arrayDatos = explode("|", $datosDesencriptados);
                    $nroOrdenCompra = $arrayDatos[0];
                    $codPerPaciente = $arrayDatos[1];
                    //$nomCompletoPaciente = $arrayDatos[2];
                    //$dniPaciente = $arrayDatos[3];
                    $funcionCerrar = $arrayDatos[2];
                    $resultado = $o_ActionOrden->mostrarVentanaFacturacionOrdenPaciente($nroOrdenCompra, $codPerPaciente, $funcionCerrar);
                    break;
                }

            case 'obtenerNumeroYSerie': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $iIdSerieComprobante = $parametros["p2"];

                    $resultado = $o_ActionOrden->obtenerNumeroYSerie($iIdSerieComprobante);
                    break;
                }
            case 'ventanaDescuento': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $datos['c_item'] = $parametros["p2"];
                    $datos['codigo'] = $parametros["p3"];
                    $datos['nombreProducto'] = $parametros["p4"];
                    $datos['precioUnitario'] = $parametros["p5"];
                    $datos['cantidad'] = $parametros["p6"];
                    $datos['total'] = $parametros["p7"];
                    $datos['idSeleccionado'] = $parametros["p8"];

                    $resultado = $o_ActionOrden->aVentanaDescuento($datos);
                    break;
                }
            case 'ventanaBuscarAutoriza': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $idPuestoEmpleado = $parametros["p2"];


                    $resultado = $o_ActionOrden->aVentanaBuscarAutoriza($idPuestoEmpleado);
                    break;
                }
            case 'pagarOrdenes': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $datos['iIdCajaComprobante'] = $parametros["p2"];
                    $datos['c_cod_per'] = $parametros["p3"];
                    $datos['cIdTipoDocumento'] = $parametros["p4"];
                    $datos['iIdFormaPago'] = $parametros["p5"];
                    $datos['nBaseImponible'] = $parametros["p6"];
                    $datos['nIgv'] = $parametros["p7"];
                    $datos['nTotal'] = $parametros["p8"];
                    $datos['vNumeroDocumento'] = $parametros["p9"];
                    $datos['dFechaEmision'] = $parametros["p10"];
                    $datos['vNumeroComprobante'] = $parametros["p11"];
                    $datos['vSerie'] = $parametros["p12"];
                    $datos['cadenaTotales'] = $parametros["p13"];
                    $datos['cadenaDescuento'] = $parametros["p14"];
                    $datos['cadenaiIdPuestoEmpleado'] = $parametros["p15"];
                    $datos['cadenaPorcentaje'] = $parametros["p16"];
                    $datos['cadenaNuevoPrecio'] = $parametros["p17"];
                    $datos['cadenaCantidad'] = $parametros["p18"];
                    $datos['cadenaNuevoTotal'] = $parametros["p19"];
                    $datos['cadenaItems'] = $parametros["p20"];
                    $datos['cadenaObservacion'] = $parametros["p21"];
                    $resultado = $o_ActionOrden->aPagarOrdenes($datos);
                    break;
                }


            case 'buscarAutoriza': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->abuscarAutoriza($parametros['p2'], $parametros['p3'], $parametros['p4'], $parametros['p5'], $parametros['p6'], $parametros['p7'], $parametros['p8']);
                    break;
                }

            case 'descuentodxctacte': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $datos['item'] = $parametros['p2'];
                    $datos['nuevoPrecio'] = $parametros['p3'];
                    $datos['porcentaje'] = $parametros['p4'];
                    $datos['nuevoTotal'] = $parametros['p5'];
                    $datos['descuento'] = $parametros['p6'];
                    $datos['cantidad'] = $parametros['p7'];
                    $datos['precioIncial'] = $parametros['p8'];
                    $datos['idAutoriza'] = $parametros['p9'];
                    $datos['observacion'] = $parametros['p10'];
                    $resultado = $o_ActionOrden->adescuentodxctacte($datos);
                    break;
                }

            case 'mostrarTablaProductoServicioFacturacion': {
                    require_once("ActionOrden.php");
                    header("Content-type: text/xml");
                    $o_ActionOrden = new ActionOrden();
                    $datos["nroOrdenCompra"] = $parametros["p2"];
                    $datos["cadenaItems"] = $parametros["p3"];
                    $resultado = $o_ActionOrden->mostrarTablaProductoServicioFacturacion($datos);
                    break;
                }
            case 'verificarCajaNoCerrada': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $datos["codCaja"] = $parametros["p2"];
                    $datos["fechaHoy"] = $parametros["p3"];
                    $resultado = $o_ActionOrden->verificarCajaNoCerrada($datos);
                    break;
                }
            case 'cancelarMontoComprobanteFacturacion': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    //$datos = $parametros["p2"];
                    $datosDesencriptados = base64_decode($parametros["p2"]);
                    $arrayDatos = explode("|", $datosDesencriptados);
                    $datos["nroOrdenCompra"] = $arrayDatos[0];
                    $datos["codCaja"] = $arrayDatos[1];
                    $datos["codTipoComprobante"] = $arrayDatos[2];
                    $datos["codSerieComprobante"] = $arrayDatos[3];
                    $datos["nroComprobante"] = $arrayDatos[4];
                    $datos["nroCompletoComprobante"] = $datos["codCaja"] . $datos["codTipoComprobante"] . $datos["codSerieComprobante"] . $datos["nroComprobante"];
                    $datos["fechaEmision"] = $arrayDatos[5];
                    $datos["codPerPaciente"] = $arrayDatos[6];
                    $datos["codTipoPago"] = $arrayDatos[7];
                    $datos["valorMonto"] = $arrayDatos[8];
                    $datos["valorIGV"] = $arrayDatos[9];
                    $datos["valorImpuestoIGV"] = $arrayDatos[10];
                    $datos["valorTotal"] = $arrayDatos[11];
                    $datos["glosaComprobante"] = $arrayDatos[12];
                    $datos["codFormaPago"] = $arrayDatos[13];
                    $datos["cadenaItems"] = $arrayDatos[14];
                    $resultado = $o_ActionOrden->cancelarMontoComprobanteFacturacion($datos);
                    break;
                }
            case 'selecciontipoComprobante': {
                    require_once("ActionCaja.php");
                    $o_ActionCaja = new ActionCaja();
                    $datos["codCaja"] = $parametros["p2"];
                    $datos["fechaHoy"] = $parametros["p3"];
                    $resultado = $o_ActionCaja->selecciontipoComprobante($datos);
                    break;
                }
            case 'comprobantesEmitidos': {
                    require_once("ActionOrden.php");
                    header("Content-type: text/xml");
                    $o_ActionOrden = new ActionOrden();
                    $datos["txtfecha"] = $parametros["p2"];
                    $datos["cbocomprobante"] = $parametros["p3"];
                    $datos["cboTipobusqueda"] = $parametros["p4"];
                    $datos["txtrecibodesde"] = $parametros["p5"];
                    $datos["txtrecibohasta"] = $parametros["p6"];
                    $datos["cb_filtroCajas"] = $parametros["p7"];
                    $resultado = $o_ActionOrden->comprobantesEmitidos($datos);
                    break;
                }
            case 'menuMostrarReportePorNroCaja' : {
                    require_once("ActionCaja.php");
                    $o_ActionCaja = new ActionCaja();
                    $resultado = $o_ActionCaja->menuMostrarReportePorNroCaja();
                    break;
                }
            case 'reporteCajaPorCajero' : {
                    require_once("ActionCaja.php");
                    $o_ActionCaja = new ActionCaja();
                    $datos["codCaja"] = $parametros["p2"];
                    $datos["txtFechaIni"] = $parametros["p3"];
                    $datos["txtFechaFinal"] = $parametros["p4"];
                    $datos["fila"] = $parametros["p5"];
                    $resultado = $o_ActionCaja->reporteCajaPorCajero($datos);
                    break;
                }

            case 'eliminarAsistencia' : {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["idHorarioAsistencia"] = $parametros["p2"];
                    $resultado = $o_ActionRrhh->eliminarAsistencia($datos);
                    break;
                }


            case 'exportarExcelEncargadosMorosos' : {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["cboAnio"] = $parametros["p2"];
                    $datos["cboMes"] = $parametros["p3"];
                    $resultado = $o_ActionRrhh->exportarExcelEncargadosMorosos($datos);
                    break;
                }

            case 'presentacionTurnos' : {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos["tipoHorarioTurno"] = $parametros["p2"];
                    $resultado = $o_ActionMantenimientoGeneral->presentacionTurnos($datos);
                    break;
                }

            case 'CargarArea' : {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $cboSede = $parametros["p2"];
                    $resultado = $o_ActionRrhh->CargarArea($cboSede);
                    break;
                }



            case 'CargarlistadoTodosCordinadores' : {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $cboSede = $parametros["p2"];
                    $resultado = $o_ActionRrhh->CargarlistadoTodosCordinadores($cboSede);
                    break;
                }

            case 'CargarlistaPuestosXCentroCostos' : {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $idCentroDeCosto = $parametros["p2"];
                    $resultado = $o_ActionRrhh->CargarlistaPuestosXCentroCostos($idCentroDeCosto);

                    break;
                }
            case 'CargarlistadoTodasAreasSinCoordinador' : {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $cboSede = $parametros["p2"];
                    $resultado = $o_ActionRrhh->CargarlistadoTodasAreasSinCoordinador($cboSede);
                    break;
                }


            case 'CargarlistadoTodosTurnosDisponibles' : {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $nomSedeEmpresaArea = $parametros["p2"];
                    $resultado = $o_ActionRrhh->CargarlistadoTodosTurnosDisponibles($nomSedeEmpresaArea);
                    break;
                }



            case 'listaTurnosxSedeEmpresaArea' : {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $nomSedeEmpresaArea = $parametros["p2"];
                    $resultado = $o_ActionRrhh->CargarlistaTurnosxSedeEmpresaArea($nomSedeEmpresaArea);
                    break;
                }

            case 'RefrescarTablaTurnosSeleccionadosxArea' : {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $nomSedeEmpresaArea = $parametros["p2"];
                    $resultado = $o_ActionRrhh->RefrescarTablaTurnosSeleccionadosxArea($nomSedeEmpresaArea);
                    break;
                }

            case 'ListarEmpleadosPreProgramados' : {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["mes"] = $parametros["p2"];
                    $datos["anno"] = $parametros["p3"];
                    $resultado = $o_ActionRrhh->ListarEmpleadosPreProgramados($datos);
                    break;
                }

            case 'listarEmpleados' : {
                    require_once("ActionRrhh.php");

                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["idEmpresaSedearea"] = $parametros["p2"];
                    $datos["cboMes"] = $parametros["p3"];
                    $datos["cboAnio"] = $parametros["p4"];
                    $resultado = $o_ActionRrhh->listarEmpleados($datos);
                    break;
                }

            case 'RefrescarTablaListaEmpleados' : {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["idEmpresaSedearea"] = $parametros["p2"];
                    $datos["cboMes"] = $parametros["p3"];
                    $datos["cboAnio"] = $parametros["p4"];
                    $resultado = $o_ActionRrhh->RefrescarTablaListaEmpleados($datos);
                    break;
                }

            case 'RefrescarTablaTurnosDisponiblesxArea' : {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $IdSedeEmpresaArea = $parametros["p2"];
                    $resultado = $o_ActionRrhh->RefrescarTablaTurnosDisponiblesxArea($IdSedeEmpresaArea);
                    break;
                }

            case 'asignarPreProgramacion' : {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["idPuestoEmpleadoPorArea"] = $parametros["p2"];
                    $datos["cboAnio"] = $parametros["p3"];
                    $datos["cboMes"] = $parametros["p4"];
                    $resultado = $o_ActionRrhh->asignarPreProgramacion($datos);
                    break;
                }
            case 'asignarTurnoDisponibleAlArea' : {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["codTurno"] = $parametros["p2"];
                    $datos["idSedeEmpresaArea"] = $parametros["p3"];
                    $resultado = $o_ActionRrhh->asignarTurnoDisponibleAlArea($datos);
                    break;
                }
            case 'grabarColorSelecionadoTurnoAreaSede' : {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["hIdTurnoAreaSede"] = $parametros["p2"];
                    $datos["color"] = "#" . $parametros["p3"];
                    $resultado = $o_ActionRrhh->grabarColorSelecionadoTurnoAreaSede($datos);
                    break;
                }

            case 'listarEmpleadosProgramados' : {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["idEmpresaSedearea"] = $parametros["p2"];
                    $datos["cboMes"] = $parametros["p3"];
                    $datos["cboAnio"] = $parametros["p4"];
                    $resultado = $o_ActionRrhh->listarEmpleadosProgramados($datos);
                    break;
                }

            case 'quitarPreProgramacion' : {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["idPreProgramacionPersonal"] = $parametros["p2"];
                    $datos["idPuestoEmpleadoPorArea"] = $parametros["p3"];

                    $resultado = $o_ActionRrhh->quitarPreProgramacion($datos);
                    break;
                }


            case 'quitarTurnoSeleccionadoAlArea' : {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $idTurnoAreaSede = $parametros["p2"];
                    $resultado = $o_ActionRrhh->quitarTurnoSeleccionadoAlArea($idTurnoAreaSede);
                    break;
                }

            case 'mantenimientoCaja': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $c_cod_per = $parametros["p2"];
                    $resultado = $o_ActionRrhh->mantenimientoCaja($c_cod_per);
                    break;
                }
            case 'eliminarCajaComprobante': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $iIdCajaComprobante = $parametros["p2"];
                    $resultado = $o_ActionRrhh->aElimnarCajaComprobante($iIdCajaComprobante);

                    break;
                }
            case 'poppackBoletas': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $c_cod_per = $parametros["p2"];
                    $resultado = $o_ActionRrhh->ApoppackBoletas($c_cod_per);
                    break;
                }

            case 'poppackBoletasEdita': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["codigoComprobante"] = $parametros["p2"];
                    $datos["c_caja"] = $parametros["p3"];
                    $datos["serie"] = $parametros["p4"];
                    $datos["descSerie"] = $parametros["p5"];
                    $datos["c_nro_act"] = $parametros["p6"];
                    $resultado = $o_ActionRrhh->ApoppackBoletasEdita($datos);
                    break;
                }

            case 'guardarComprobanteSerie': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["c_cod_per"] = $parametros["p2"];
                    $datos["iIdSerieComprobante"] = $parametros["p3"];
                    $datos["usuario"] = $parametros["p4"];
                    $datos["numeroCaja"] = $parametros["p5"];
                    $resultado = $o_ActionRrhh->AguardarComprobanteSerie($datos);
                    break;
                }
            case 'modificarSerieEstado': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["numeroCaja"] = $parametros["p2"];
                    $datos["serieAntigua"] = $parametros["p3"];
                    $datos["codigoComprobante"] = $parametros["p4"];
                    $datos["estadoserie"] = $parametros["p5"];
                    $datos["serieNueva"] = $parametros["p6"];
                    $datos["c_nro_act"] = $parametros["p7"];

                    $resultado = $o_ActionRrhh->AmodificarSerieEstado($datos);
                    break;
                }

            case 'popackEliminacionComprobantePago': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $datos["numeroComprobante"] = $parametros["p2"];
                    $datos["codigoEmpleado"] = $parametros["p3"];
                    $datos["nomPerDeOrdenGenerada"] = $parametros["p4"];
                    $datos["dniPaciente"] = $parametros["p5"];
                    $datos["nroOrdenCompra"] = $parametros["p6"];
                    $resultado = $o_ActionOrden->popackEliminacionComprobantePago($datos);
                    break;
                }
            case 'EliminacionComprobantePagoTabla' : {
                    require_once("ActionOrden.php");
                    header("Content-type: text/xml");
                    $o_ActionOrden = new ActionOrden();
                    $serieComprobante = $parametros["p2"];
                    $resultado = $o_ActionOrden->AeliminacionComprobantePagoTabla($serieComprobante);
                    break;
                    break;
                }
            case 'anularComprobanteDePago': {
                    require_once("ActionOrden.php");
                    $o_ActionOrden = new ActionOrden();
                    $datos["numeroComprobante"] = $parametros["p2"];
                    $datos["codigoEmpleado"] = $parametros["p3"];
                    $resultado = $o_ActionOrden->AanularComprobanteDePago($datos);
                    break;
                }
            case 'abrirMantenimientoArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->abrirAreaMantemientoArea();
                    break;
                }
            case 'arbolAreas': {
                    require_once("ActionRrhh.php");
                    header("Content-type:text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->arbolAreas($parametros["p2"]);
                    break;
                }






            case 'ActivacionCoordinadores': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->ActivacionCoordinadores();
                    break;
                }

            case 'DesactivarCoordinador': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["mes"] = $parametros["p2"];
                    $datos["descripcion"] = $parametros["p3"];
                    $datos["anio"] = $parametros["p4"];
                    $resultado = $o_ActionRrhh->ADesactivarCoordinador($datos);
                    break;
                }
            case 'ActivarCoordinador': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["mes"] = $parametros["p2"];
                    $datos["descripcion"] = $parametros["p3"];
                    $datos["anio"] = $parametros["p4"];
                    $resultado = $o_ActionRrhh->ActivarCoordinador($datos);
                    break;
                }

            case 'ActivarCordinadorXarea': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["mes"] = $parametros["p2"];
                    $datos["anio"] = $parametros["p3"];
                    $resultado = $o_ActionRrhh->ActivarCordinadorXarea($datos);
                    break;
                }

            case 'DarPermisoEspecialAlCoordinador': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["IdHistoriaDeCoordinador"] = $parametros["p2"];

                    $resultado = $o_ActionRrhh->AdarPermisoEspecialAlCoordinador($datos);
                    break;
                }
            case 'arbolCentroCostos': {
                    require_once("ActionRrhh.php");
                    header("Content-type:text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->aArbolCentroCostos();
                    break;
                }
            case 'ventanaAsignaAreaSede' : {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $resultado = $o_ActionMantenimientoGeneral->ventanaAsignaAreaSede();
                    break;
                }
            case 'actualizacionLogicaSedeEmpresaArea': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $resultado = $o_ActionMantenimientoGeneral->actualizacionLogicaSedeEmpresaArea($parametros["p2"]);
                    break;
                }
            case 'pruebaHorarios': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $resultado = $o_ActionMantenimientoGeneral->pruebaHorarios();
                    break;
                }


            case 'arbolAreas2': {
                    require_once("ActionRrhh.php");
                    header("Content-type:text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->arbolAreas2($parametros["p2"]);
                    break;
                }



            case 'generaArbolCentroCostos': {
                    require_once("ActionRrhh.php");
                    header("Content-type:text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->aGeneraArbolCentroCostos();
                    break;
                }

            case 'poppadVacaciones': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $o_ActionRrhh->poppadVaciones();
                    break;
                }
            case 'tablaDescansoContratoEmpleado': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->tablaDescansoContratoEmpleado($parametros);
                    break;
                }
            case 'poppadVacacionesMantenimiento': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $o_ActionRrhh->poppadVacacionesMantenimiento();
                    break;
                }
            case 'guardarVacaciones': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->guardarVacaciones($parametros);
                    break;
                }
            case 'eliminarVacaciones': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->eliminarVacaciones($parametros);
                    break;
                }
            case 'HorariosTurnos': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $codigoCordinador = $parametros["p2"];
                    $resultado = $o_ActionRrhh->HorariosTurnos($codigoCordinador);
                    break;
                }
            case 'reporteEmpleado': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["iCodEmpCoordinador"] = $parametros["p2"];
                    $datos["anio"] = $parametros["p3"];
                    $datos["mes"] = $parametros["p4"];
                    $datos["annoActual"] = $parametros["p5"];
                    $datos["mesActual"] = $parametros["p6"];
                    $datos["horaActual"] = $parametros["p7"];
                    $datos["minutosActual"] = $parametros["p8"];
                    $resultado = $o_ActionRrhh->AreporteEmpleado($datos);
                    break;
                }

            case 'poppackSeleccionarTunosProgramar': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["codigoPreProgramacion"] = $parametros["p2"];
                    $datos["codigoSedeEmpresaArea"] = $parametros["p3"];
                    $datos["nombreEmpleado"] = $parametros["p4"];
                    $datos["nombreAreaSede"] = $parametros["p5"];
                    $datos["puestoEmpleado"] = $parametros["p6"];
                    $datos["iCodigoEmpleado"] = $parametros["p7"];
                    $datos["nNumeroProgramacionesXmes"] = $parametros["p8"];
                    $datos["cboMes"] = $parametros["p9"];
                    $datos["cboAnio"] = $parametros["p10"];

                    $resultado = $o_ActionRrhh->AseleccionarTunosProgramar($datos);
                    break;
                }

            case 'poppackSeleccionarTunosProgramarIndividualSinTurno': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["iCodProgramacionEmpleado"] = $parametros["p2"];
                    $datos["codigoSedeEmpresaArea"] = $parametros["p3"];
                    $datos["nombreEmpleado"] = $parametros["p4"];
                    $datos["areaSede"] = $parametros["p5"];
                    $datos["anno"] = $parametros["p6"];
                    $datos["mes"] = $parametros["p7"];
                    $datos["dia"] = $parametros["p8"];
                    $datos["codigoPreProgramacion"] = $parametros["p9"];
                    $datos["puestoEmpleado"] = $parametros["p10"];
                    $datos["iCodigoEmpleado"] = $parametros["p11"];
                    $datos["nNumeroProgramacionesXmes"] = $parametros["p12"];
                    $resultado = $o_ActionRrhh->AseleccionarTunosProgramarIndividualSinTurno($datos);
                    break;
                }

            case 'guardarTurnoProgramadoGrupo': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["idTurnoAreaSede"] = $parametros["p2"];
                    $datos["idPreProgramacion"] = $parametros["p3"];
                    $datos["cadena"] = $parametros["p4"];
                    $datos["idPuestoEmpleado"] = $parametros["p5"];
                    $datos["iCodigoEmpleado"] = $parametros["p6"];
                    $datos["nInicioTurno"] = $parametros["p7"];
                    $datos["nfinTurno"] = $parametros["p8"];
                    $datos["nNumeroProgramacionesXmes"] = $parametros["p9"];
                    $datos["codigoSedeEmpresaArea"] = $parametros["p10"];

                    $resultado = $o_ActionRrhh->AguardarTurnoProgramadoGrupo($datos);
                    break;
                }

            case 'poppackSeleccionarModificarEliminarTunosProgramarIndividual': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["iCodProgramacionEmpleado"] = $parametros["p2"];
                    $datos["nombreEmpleado"] = $parametros["p3"];
                    $datos["iCodEmpCoordinador"] = $parametros["p4"];
                    $datos["areaSede"] = $parametros["p5"];
                    $datos["codigoSedeEmpresaArea"] = $parametros["p6"];
                    $datos["descripcionTurno"] = $parametros["p7"];
                    $datos["descripcionTurnoRango"] = $parametros["p8"];
                    $datos["idTurnoAreaSede"] = $parametros["p9"];
                    $datos["filaTurno"] = $parametros["p10"];
                    $datos["nomMes"] = $parametros["p11"];
                    $datos["anio"] = $parametros["p12"];
                    $datos["codigoPreProgramacion"] = $parametros["p13"];
                    $datos["iCodigoEmpleado"] = $parametros["p14"];
                    $datos["filaArea"] = $parametros["p15"];
                    $datos["filaEmpleado"] = $parametros["p16"];
                    $datos["nNumeroProgramacionesXmes"] = $parametros["p17"];
                    $datos["puestoEmpleado"] = $parametros["p18"];

                    $resultado = $o_ActionRrhh->ASeleccionarModificarEliminarTunosProgramarIndividual($datos);
                    break;
                }

            case 'modificarTurnoProgramadoIndividuar': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["idProgramacionPersonal"] = $parametros["p2"];
                    $datos["nInicioTurno"] = $parametros["p3"];
                    $datos["nfinTurno"] = $parametros["p4"];
                    $datos["cadena"] = $parametros["p5"];
                    $datos["idSedeAreaTurnoActual"] = $parametros["p6"];
                    $datos["idPreProgramacion"] = $parametros["p7"];
                    $datos["iCodigoEmpleado"] = $parametros["p8"];
                    $datos["nNumeroProgramacionesXmes"] = $parametros["p9"];
                    $datos["idPuestoEmpleado"] = $parametros["p10"];
                    $datos["idTurnoAreaSede"] = $parametros["p11"];

                    $resultado = $o_ActionRrhh->AmodificarTurnoProgramadoIndividuar($datos);
                    break;
                }

            case 'EliminarTurnoProgramadoIndividuar': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["idProgramacionPersonal"] = $parametros["p2"];
                    $datos["nInicioTurno"] = $parametros["p3"];
                    $datos["nfinTurno"] = $parametros["p4"];
                    $datos["cadena"] = $parametros["p5"];
                    $datos["idSedeAreaTurnoActual"] = $parametros["p6"];
                    $datos["idPreProgramacion"] = $parametros["p7"];
                    $datos["iCodigoEmpleado"] = $parametros["p8"];

                    $resultado = $o_ActionRrhh->AeliminarTurnoProgramadoIndividuar($datos);
                    break;
                }


            case 'guardarTurnoProgramadoIndividual': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["idTurnoAreaSede"] = $parametros["p2"];
                    $datos["idPreProgramacion"] = $parametros["p3"];
                    $datos["cadena"] = $parametros["p4"];
                    $datos["idPuestoEmpleado"] = $parametros["p5"];
                    $datos["iCodigoEmpleado"] = $parametros["p6"];
                    $datos["nInicioTurno"] = $parametros["p7"];
                    $datos["nfinTurno"] = $parametros["p8"];
                    $datos["nNumeroProgramacionesXmes"] = $parametros["p9"];

                    $resultado = $o_ActionRrhh->AguardarTurnoProgramadoIndividual($datos);
                    break;
                }

            case 'lenyendaArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["codigoSedeEmpresaArea"] = $parametros["p2"];
                    $resultado = $o_ActionRrhh->AlenyendaArea($datos);
                    break;
                }
            case 'asistenciaMedico': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->AsistenciaMedico();
                    break;
                }
            case 'podpadBusquedaMedicos': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->podpadBusquedaMedicos();
                    break;
                }
            case 'buscarMedicoX': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->AbuscaMedico($parametros['p2'], $parametros['p3'], $parametros['p4'], $parametros['p5'], $parametros['p6'], $parametros['p7'], $parametros['p8']);
                    break;
                }
            case 'reporteBusquedaMedico': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["iCodMedico"] = $parametros["p2"];
                    $datos["fechaIni"] = $parametros["p3"];
                    $datos["fechaFinal"] = $parametros["p4"];
                    $datos["cantidadRegistro"] = $parametros["p5"];
                    $datos["cantidadRegistrominimo"] = $parametros["p6"];
                    $datos["c_cod_per"] = $parametros["p7"];
                    $resultado = $o_ActionRrhh->reporteBusquedaMedico($datos);
                    break;
                }
            case 'listaMedicosPorParteAdelante': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["iCodMedico"] = $parametros["p2"];
                    $datos["fechaIni"] = $parametros["p3"];
                    $datos["fechaFinal"] = $parametros["p4"];
                    $datos["cantidadRegistro"] = $parametros["p5"];
                    $datos["cantidadRegistrominimo"] = $parametros["p6"];
                    $datos["c_cod_per"] = $parametros["p7"];
                    $resultado = $o_ActionRrhh->AlistaMedicosPorParteAdelante($datos);
                    break;
                }
            case 'contenidoPuntoControl': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aContenidoPuntoControl();
                    break;
                }
            case 'tablaPuntosControl': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aTablaPuntosControl($datos);
                    break;
                }
            case 'contenidoProcesarPuntoControl': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aContenidoProcesarPuntoControl();
                    break;
                }
            case 'personasPorPuntoControl': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $idPuntoControl = $parametros["p2"];
                    $fecha = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->aPersonasPorPuntoControl($idPuntoControl, $fecha);
                    break;
                }
            case 'verProcesarPuntoControl': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $idPuntoControl = $parametros["p2"];
                    $nombrePuntoControl = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->aVerProcesarPuntoControl($idPuntoControl, $nombrePuntoControl);
                    break;
                }
            case 'alertaPuntoControlErroneo': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos['fecha'] = $parametros["p2"];
                    $datos['nombre'] = $parametros["p3"];
                    $datos['afiliacion'] = $parametros["p4"];
                    $datos['examen'] = $parametros["p5"];
                    $datos['procedencia'] = $parametros["p6"];
                    $datos['ubicacion'] = $parametros["p7"];
                    $datos['estado'] = $parametros["p8"];
                    $resultado = $o_ActionLaboratorio->aAlertaPuntoControlErroneo($datos);
                    break;
                }
            case 'verRecibirPuntoControl': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $idPuntoControl = $parametros["p2"];
                    $nombrePuntoControl = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->aVerRecibirPuntoControl($idPuntoControl, $nombrePuntoControl);
                    break;
                }
            case 'verificarRecibirPuntoControl': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos['codigoBarra'] = $parametros["p2"];
                    $datos['idPuntoControl'] = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->aVerificarRecibirPuntoControl($datos);
                    break;
                }
            case 'verificarProcesarPuntoControl': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos['codigoBarra'] = $parametros["p2"];
                    $datos['idPuntoControl'] = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->aVerificarProcesarPuntoControl($datos);
                    break;
                }
            case 'mantenimientoDatosExamen': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->AmantenimientoDatosExamen();
                    break;
                }
            case 'buscarExamenesLaboratorio': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["nombreExamen"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->AbuscarExamenesLaboratorio($datos);
                    break;
                }
            case 'reporteDePuntoControlXExamen': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["iIdExamenesLaboratorio"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->AreporteDePuntoControlXExamen($datos);
                    break;
                }
            case 'reporteDePuntoControlXExamen_indicador': {
                    require_once("ActionReporte.php");
                    header("Content-type: text/xml");
                    $o_ActionReporte = new ActionReporte();
                    $datos["iIdExamenesLaboratorio"] = $parametros["p2"];
                    $resultado = $o_ActionReporte->AreporteDePuntoControlXExamen_indicador($datos);
                    break;
                }


            case 'reporteDeUnidadesUtilizadasxMaterialLaboratorio_IndicadorLaboratorio': {
                    require_once("ActionReporte.php");
                    header("Content-type: text/xml");
                    $o_ActionReporte = new ActionReporte();
                    $datos["IdMat"] = $parametros["p2"];
                    $resultado = $o_ActionReporte->AreporteDeUnidadesUtilizadasxMaterialLaboratorio_IndicadorLaboratorio($datos);
                    break;
                }
            case 'agregarNuevoPuntoControl': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["iIdExamenesLaboratorio"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->AgregarNuevoPuntoControl($datos);
                    break;
                }
            case 'reporteDePuntoControl': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["iIdExamenesLaboratorio"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->AreporteDePuntoControl($datos);
                    break;
                }
            case 'guardarNuevoPuntoControl': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["iIdExamenesLaboratorio"] = $parametros["p2"];
                    $datos["iIdpuntoControl"] = $parametros["p3"];
                    $datos["maximaSecuencia"] = $parametros["p4"];
                    $resultado = $o_ActionLaboratorio->AguardarNuevoPuntoControl($datos);
                    break;
                }
            case 'subirBajarSecuenciaPuntoControl': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["iIdExamenesLaboratorio"] = $parametros["p2"];
                    $datos["iNivelInicial"] = $parametros["p3"];
                    $datos["iNivelFinal"] = $parametros["p4"];
                    $datos["idPuntoControlExamenLab"] = $parametros["p5"];
                    $resultado = $o_ActionLaboratorio->AsubirBajarSecuenciaPuntoControl($datos);
                    break;
                }
            case 'grupoDePuntoControl': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idPuntoControlExamenLab"] = $parametros["p2"];
                    $datos["nombrePuntoControl"] = $parametros["p3"];
                    $datos["nombreExamen"] = $parametros["p4"];
                    $resultado = $o_ActionLaboratorio->AgrupoDePuntoControl($datos);
                    break;
                }
            case 'popapParaCrearNuevoGrupo': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->ApopapParaCrearNuevoGrupo();
                    break;
                }
            case 'agregarNuevoGrupo': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idPuntoControlExamenLab"] = $parametros["p2"];
                    $datos["iEstadoVersicion"] = $parametros["p3"];
                    $datos["nombreGrupo"] = $parametros["p4"];
                    $resultado = $o_ActionLaboratorio->AgregarNuevoGrupo($datos);
                    break;
                }
            case 'guardarModificadoGrupoDatos': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["nombreGrupoDatosEditar"] = $parametros["p2"];
                    $datos["idGrupoDatos"] = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->AguardarModificadoGrupoDatos($datos);
                    break;
                }
            case 'eliminarGrupoDatos': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idGrupoDatos"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->AeliminarGrupoDatos($datos);
                    break;
                }
            case 'cargarComboUnidadMedidaGuardar': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["tipoUnidadDeMedida"] = $parametros["p2"];
                    $datos["fila"] = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->AcargarComboUnidadMedida($datos);
                    break;
                }
            case 'guardarDatosPuntoControl': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idGrupoDatos"] = $parametros["p2"];
                    $datos["idTipoDatos"] = $parametros["p3"];
                    $datos["idUnidadDeMedida"] = $parametros["p4"];
                    $datos["filaexamen"] = $parametros["p5"];
                    $datos["idVisible"] = $parametros["p6"];
                    $datos["idObligatorio"] = $parametros["p7"];
                    $resultado = $o_ActionLaboratorio->AguardarDatosPuntoControl($datos);
                    break;
                }
            case 'popapEditarRango': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idRango"] = $parametros["p2"];
                    $datos["edadMinima"] = $parametros["p3"];
                    $datos["edadMaximo"] = $parametros["p4"];
                    $datos["sexo"] = $parametros["p5"];
                    $datos["sexoTexto"] = $parametros["p6"];
                    $datos["valorMinima"] = $parametros["p7"];
                    $datos["valorMaximo"] = $parametros["p8"];
                    $datos["significado"] = $parametros["p9"];
                    $datos["nombreGrupo"] = $parametros["p10"];
                    $datos["nombreDatos"] = $parametros["p11"];
                    $datos["estadoEdad"] = $parametros["p12"];
                    $datos["estadoSexo"] = $parametros["p13"];
                    $datos["tipoDatos"] = $parametros["p14"];
                    $datos["idGrupoDatos"] = $parametros["p15"];
                    $datos["idDatosPuntoControl"] = $parametros["p16"];
                    $datos["nombreTipoDatos"] = $parametros["p17"];
                    $datos["bMaximoEdadInfinito"] = $parametros["p18"];
                    $datos["bRangoInfinitoPositivo"] = $parametros["p19"];
                    $datos["bRangoInfinitoNegativo"] = $parametros["p20"];
                    $resultado = $o_ActionLaboratorio->ApopapEditarRango($datos);
                    break;
                }
            case 'eliminarRango': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idRango"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->AeliminarRango($datos);
                    break;
                }
            case 'modificarRangos': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idRango"] = $parametros["p2"];
                    $datos["bSexo"] = $parametros["p3"];
                    $datos["bEdad"] = $parametros["p4"];
                    $datos["iEdadMinima"] = $parametros["p5"];
                    $datos["iEdadMaxima"] = $parametros["p6"];
                    $datos["iSexo"] = $parametros["p7"];
                    $datos["nValorMinimo"] = $parametros["p8"];
                    $datos["nValorMaximo"] = $parametros["p9"];
                    $datos["vSignificado"] = $parametros["p10"];
                    $datos["bMaximoEdadInfinito"] = $parametros["p11"];
                    $datos["bRangoInfinitoPositivo"] = $parametros["p12"];
                    $datos["bRangoInfinitoNegativo"] = $parametros["p13"];
                    $resultado = $o_ActionLaboratorio->AmodificarRangos($datos);
                    break;
                }
            case 'cargarComboEditarUnidadMedida': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["tipoUnidadDeMedida"] = $parametros["p2"];
                    $datos["filak"] = $parametros["p3"];
                    $datos["filay"] = $parametros["p4"];
                    $resultado = $o_ActionLaboratorio->AcargarComboEditarUnidadMedida($datos);
                    break;
                }
            case 'modificarDatosPuntoControl': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idDatosPuntoControl"] = $parametros["p2"];
                    $datos["nombreDatos"] = $parametros["p3"];
                    $datos["tipoDatos"] = $parametros["p4"];
                    $datos["tipoUnidadDeMedida"] = $parametros["p5"];
                    $datos["unidadDeMedidaEditar"] = $parametros["p6"];
                    $datos["muestraDatosEnExamen"] = $parametros["p7"];
                    $datos["iObligatorio"] = $parametros["p8"];
                    $datos["hTipoUnidadDeMedida"] = $parametros["p9"];
                    $resultado = $o_ActionLaboratorio->AmodificarDatosPuntoControl($datos);
                    break;
                }
            case 'popapEditarCombo': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idDatosPuntoControl"] = $parametros["p2"];
                    $datos["filak"] = $parametros["p3"];
                    $datos["filay"] = $parametros["p4"];
                    $resultado = $o_ActionLaboratorio->PopaEditarCombo($datos);
                    break;
                }
            case 'guardarItemCombo': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idDatosPuntoControl"] = $parametros["p2"];
                    $datos["nombreItem"] = $parametros["p3"];
                    $datos["iOrden"] = $parametros["p4"];
                    $datos["idCombo"] = $parametros["p5"];
                    $resultado = $o_ActionLaboratorio->AguardarItemCombo($datos);
                    break;
                }
            case 'ModificarItemCombo': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idItem"] = $parametros["p2"];
                    $datos["nombreItem"] = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->AmodificarItemCombo($datos);
                    break;
                }
            case 'EliminarDatosCombos': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["iIdDatosCombos"] = $parametros["p2"];
                    $datos["idCombo"] = $parametros["p3"];
                    $datos["iTemMax"] = $parametros["p4"];
                    $datos["iOrdenItem"] = $parametros["p5"];
                    $resultado = $o_ActionLaboratorio->AeliminarDatosCombos($datos);
                    break;
                }
            case 'ocultarBotonNueno': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idDatosPuntoControl"] = $parametros["p2"];
                    $datos["iTemMax"] = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->AocultarBotonNueno($datos);
                    break;
                }
            case 'subirOrdenItem': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idItemComboActual"] = $parametros["p2"];
                    $datos["idItemComboRemplazado"] = $parametros["p3"];
                    $datos["ordenItemActual"] = $parametros["p4"];
                    $datos["ordenRemplazado"] = $parametros["p5"];
                    $resultado = $o_ActionLaboratorio->AsubirOrdenItem($datos);
                    break;
                }
            case 'bajarOrdenItem': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idItemComboActual"] = $parametros["p2"];
                    $datos["idItemComboRemplazado"] = $parametros["p3"];
                    $datos["ordenItemActual"] = $parametros["p4"];
                    $datos["ordenRemplazado"] = $parametros["p5"];
                    $resultado = $o_ActionLaboratorio->AbajarOrdenItem($datos);
                    break;
                }
            case 'PopaAgregarRango': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["nombreGrupo"] = $parametros["p2"];
                    $datos["nombreDatos"] = $parametros["p3"];
                    $datos["iIdDatosPuntoControl"] = $parametros["p4"];
                    $datos["tipoDatos"] = $parametros["p5"];
                    $datos["idGrupoDatos"] = $parametros["p6"];
                    $datos["nombreTipoDatos"] = $parametros["p7"];
                    $resultado = $o_ActionLaboratorio->ApopaAgregarRango($datos);
                    break;
                }
            case 'GuardarRangos': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["iIdDatosPuntoControl"] = $parametros["p2"];
                    $datos["bSexo"] = $parametros["p3"];
                    $datos["bEdad"] = $parametros["p4"];
                    $datos["iEdadMinima"] = $parametros["p5"];
                    $datos["iEdadMaxima"] = $parametros["p6"];
                    $datos["iSexo"] = $parametros["p7"];
                    $datos["nValorMinimo"] = $parametros["p8"];
                    $datos["nValorMaximo"] = $parametros["p9"];
                    $datos["vSignificado"] = $parametros["p10"];
                    $datos["bMaximoEdadInfinito"] = $parametros["p11"];
                    $datos["bRangoInfinitoPositivo"] = $parametros["p12"];
                    $datos["bRangoInfinitoNegativo"] = $parametros["p13"];
                    $resultado = $o_ActionLaboratorio->AguardarRangos($datos);
                    break;
                }
            case 'cargarItemDelCombo': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idCombo"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->AcargarItemDelCombo($datos);
                    break;
                }
            case 'modificarDatosPuntoControlSoloNombre': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["iIdDatosPuntoControl"] = $parametros["p2"];
                    $datos["nombreDatos"] = $parametros["p3"];
                    $datos["muestraDatosEnExamen"] = $parametros["p4"];
                    $datos["unidadDeMedidaEditar"] = $parametros["p5"];
                    $datos["iObligatorio"] = $parametros["p6"];
                    $resultado = $o_ActionLaboratorio->AmodificarDatosPuntoControlSoloNombre($datos);
                    break;
                }
            case 'EliminarDatosPuntoControl': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["iIdDatosPuntoControl"] = $parametros["p2"];
                    $datos["idGrupoDatos"] = $parametros["p3"];
                    $datos["iOrden"] = $parametros["p4"];
                    $resultado = $o_ActionLaboratorio->EliminarDatosPuntoControl($datos);
                    break;
                }
            case 'subirDatosPuntoControl': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["iIdDatosPuntoControlActual"] = $parametros["p2"];
                    $datos["idDatosPuntoControlNuevo"] = $parametros["p3"];
                    $datos["iOrdenActual"] = $parametros["p4"];
                    $datos["iOrdenNuevo"] = $parametros["p5"];
                    $resultado = $o_ActionLaboratorio->AsubirDatosPuntoControl($datos);
                    break;
                }
            case 'bajarDatosPuntoControl': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["iIdDatosPuntoControlActual"] = $parametros["p2"];
                    $datos["idDatosPuntoControlNuevo"] = $parametros["p3"];
                    $datos["iOrdenActual"] = $parametros["p4"];
                    $datos["iOrdenNuevo"] = $parametros["p5"];
                    $resultado = $o_ActionLaboratorio->AbajarDatosPuntoControl($datos);
                    break;
                }
            case 'eliminarPuntosControl': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idPuntoControlExamenLab"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->AeliminarPuntosControl($datos);
                    break;
                }
            case 'confirmarAproduccion': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idPuntoControlExamenLab"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->AconfirmarAproduccion($datos);
                    break;
                }
            case 'obtenerDetallePuntoControl': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idPuntoControl"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->aObtenerDetallePuntoControl($datos);
                    break;
                }

            case 'grabarDetallePuntoControl': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idPuntoControl"] = $parametros["p2"];
                    $datos["nombre"] = $parametros["p3"];
                    $datos["descripcion"] = $parametros["p4"];
                    $datos["estado"] = $parametros["p5"];
                    $resultado = $o_ActionLaboratorio->aGrabarDetallePuntoControl($datos);
                    break;
                }
            case 'grabarMantenimientoAlmacen': {
                    require_once("ActionMantenimientoGeneral.php");
                    $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos["idAmbienteFisico"] = $parametros["p2"];
                    $datos["nombreAlmacen"] = $parametros["p3"];
                    $datos["descripcion"] = $parametros["p4"];
                    $datos["codPersona"] = $parametros["p5"];
                    $datos["nombreAlmacenPersona"] = $parametros["p6"];
                    $datos["codPersona"] = $parametros["p7"];
                    $resultado = $o_ActionMantenimientoGeneral->grabarMantenimientoAlmacen($datos);
                    break;
                }
            case 'agregarDetallePuntoControl': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idPuntoControl"] = $parametros["p2"];
                    $datos["nombre"] = $parametros["p3"];
                    $datos["descripcion"] = $parametros["p4"];
                    $datos["estado"] = $parametros["p5"];
                    $resultado = $o_ActionLaboratorio->aAgregarDetallePuntoControl($datos);
                    break;
                }
            case 'mantenimientoPerfiles': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aMantenimientoPerfiles();
                    break;
                }
            // JCDB 04/07/2012
            case 'cargartablaPerfiles': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aCargartablaPerfiles();
                    break;
                }

            case 'cargarTablaPerfilesExamenes': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aCargarTablaPerfilesExamenes($parametros);
                    break;
                }
            case 'cargarPoppadExamenesLaboratorio': {
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionLaboratorio();
                    $resultado = $o_ActionRrhh->aCargarPoppadExamenesLaboratorio();
                    break;
                }
            case 'cargarTablaUsuariosHabilitadosXPuntoControl': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aCargarTablaUsuariosHabilitadosXPuntoControl($parametros);
                    break;
                }
            case 'asignarUsuarioXPuntoControl': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aAsignarUsuarioXPuntoControl($parametros);
                    break;
                }
            case 'eliminarUsuariosHabilitadosXPuntoControl': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aEliminarUsuariosHabilitadosXPuntoControl($parametros);
                    break;
                }
            case 'adjuntarOtroFilejc': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->AadjuntarOtroFilejc($parametros["p2"]);
                    break;
                }
            case 'detalleMuestrayMaterialesEnPuntoControlExamenLaboratorio': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->AdetalleMuestrayMaterialesEnPuntoControlExamenLaboratorio();
                    break;
                }
            case 'MostrarMaterialesSeleccionadosXpuntoControlExamenLabo': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["hidPuntoControlExamenLab"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->AMostrarMaterialesSeleccionadosXpuntoControlExamenLabo($datos);
                    break;
                }
            case 'MostrarMuestrasSeleccionadosXpuntoControlExamenLabo': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["hidPuntoControlExamenLab"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->AMostrarMuestrasSeleccionadosXpuntoControlExamenLabo($datos);
                    break;
                }
            case 'consultaEstadoExamen': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aConsultaEstadoExamen();
                    break;
                }
            //JCDB 17/07/2012
            case 'cargarTablaEstadoExamenes': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aCargarTablaEstadoExamenes($parametros);
                    break;
                }
            case 'popudEntregaFrasco': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aPopudEntregaFrasco();
                    break;
                }
            case 'actualizarProcedenciaExamenLaboratorio': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aActualizarProcedenciaExamenLaboratorio($parametros);
                    break;
                }
            case 'cargarDatosEntregaFrasco': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aCargarDatosEntregaFrasco($parametros);
                    break;
                }
            case 'insertarSiguientePuntoControlExamenLaboratorio': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aInsertarSiguientePuntoControlExamenLaboratorio($parametros);
                    break;
                }
            case 'popudRecepcionFrasco': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aPopudRecepcionFrasco($parametros);
                    break;
                }
            case 'cargarDatosRecepcionFrasco': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aCargarDatosRecepcionFrasco($parametros);
                    break;
                }
            case 'recepcionarFrasco': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aRecepcionarFrasco($parametros);
                    break;
                }
            case 'cargarComboProcedencia': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aCargarComboProcedencia();
                    break;
                }
            case 'capturaFechaLaboratorio': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aCapturaFechaLaboratorio();
                    break;
                }
            case 'generadorCodigoBarra': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aGeneradorCodigoBarra();
                    break;
                }
            case 'historialExamen': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["nombreExamen"] = $parametros["p2"];
                    $datos["nombrePaciente"] = $parametros["p3"];
                    $datos["fechaExamen"] = $parametros["p4"];
                    $datos["afiliacion"] = $parametros["p5"];
                    $datos["procedencia"] = $parametros["p6"];
                    $datos["idPacienteLaboratorio"] = $parametros["p7"];
                    $datos["codigoBarras"] = $parametros["p8"];
                    $datos["funcionCerrar"] = $parametros["p9"];
                    $resultado = $o_ActionLaboratorio->aHistorialExamen($datos);
                    break;
                }
            case 'modificarCodigoBarras': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["codigoBarras"] = $parametros["p2"];
                    $datos["idPacienteLaboratorio"] = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->aModificarCodigoBarras($datos);
                    break;
                }
            case 'modificarMaterialPersona': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["iidPacientePuntoControlMateriales"] = $parametros["p2"];
                    $datos["cantidad"] = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->aModificarMaterialPersona($datos);
                    break;
                }
            case 'modificarTelefonos': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["telefono"] = $parametros["p2"];
                    $datos["celular1"] = $parametros["p3"];
                    $datos["celular2"] = $parametros["p4"];
                    $datos["codigoTelefono"] = $parametros["p5"];
                    $datos["codigoCelular1"] = $parametros["p6"];
                    $datos["codigoCelular2"] = $parametros["p7"];
                    $resultado = $o_ActionLaboratorio->aModificarTelefonos($datos);
                    break;
                }
            case 'MantenimientoDinamico': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["codPaciente"] = $parametros["p2"];
                    $datos["telefono"] = $parametros["p3"];
                    $datos["codigoTelefono"] = $parametros["p4"];
                    $datos["celular1"] = $parametros["p5"];
                    $datos["codigoCelular1"] = $parametros["p6"];
                    $datos["celular2"] = $parametros["p7"];
                    $datos["codigoCelular2"] = $parametros["p8"];
                    $resultado = $o_ActionLaboratorio->sMantenimientoDinamico($datos);
                    break;
                }
            case 'grabarDatoLaboratorio': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["tipoDato"] = $parametros["p2"];
                    $datos["idDatoExamenPacienteLaboratorio"] = $parametros["p3"];
                    $datos["valor"] = $parametros["p4"];
                    $datos["idProcesarPuntoControl"] = $parametros["p5"];
                    $datos["idDatoPuntoControl"] = $parametros["p6"];
                    $resultado = $o_ActionLaboratorio->aGrabarDatoLaboratorio($datos);
                    break;
                }
            case 'terminarProceso': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["iIdProcesarPuntoControl"] = $parametros["p2"];
                    $datos["observacion"] = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->aTerminarProceso($datos);
                    break;
                }
            case 'recibirProceso': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["iIdProcesarPuntoControl"] = $parametros["p2"];
                    $datos["observacion"] = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->aRecibirProceso($datos);
                    break;
                }
            case 'mostrarExamenesLaboratorio': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->amostrarExamenesLaboratorio();
                    break;
                }
            case 'AdjuntoFotoMaterialLaboratorio': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["idPersona"] = $parametros["p2"];
                    $datos["rutaFoto"] = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->aAdjuntoFotoMaterialLaboratorio($datos);
                    break;
                }
            case 'cargarTablaUnidadesxTipoxMaterialLaboratorio': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->acargarTablaUnidadesxTipoxMaterialLaboratorio($parametros);
                    break;
                }
            case 'mostrarMaterialesDeLaboratorio': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->amostrarMaterialesDeLaboratorio();
                    break;
                }


            //29 Enero 2012 jcqa

            case 'getTratamientoPaciente': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["iid_persona"] = $parametros["p2"];
                    $datos["arrayCod_Ser_Pro"] = $parametros["p3"];
                    $datos["hiCodigoFiliacionActiva"] = $parametros["p4"];
                    $resultado = $o_ActionLaboratorio->agetTratamientoPaciente($datos);
                    break;
                }


            case 'getVinculadosTratamientoPaciente': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["iid_persona"] = $parametros["p2"];
                    $datos["arrayCod_Ser_Pro"] = $parametros["p3"];
                    $datos["hiCodigoFiliacionActiva"] = $parametros["p4"];
                    $datos["hServicioConsultorio"] = $parametros["p5"];
                    $datos["hServiciosProcedimientos"] = $parametros["p6"];
                    $datos["codigoTipoCita"] = $parametros["p7"];


                    $resultado = $o_ActionLaboratorio->agetVinculadosTratamientoPaciente($datos);
                    break;
                }



            case 'cargarTablaVincularRecetasConTratamientos': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["iid_persona"] = $parametros["p2"];
                    $datos["arrayCod_Ser_Pro"] = $parametros["p3"];
                    $datos["hiCodigoFiliacionActiva"] = $parametros["p4"];
                    $resultado = $o_ActionLaboratorio->acargarTablaVincularRecetasConTratamientos($datos);
                    break;
                }


            case 'getTratamientoPaciente2': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["iid_persona"] = $parametros["p2"];
                    $datos["arrayCod_Ser_Pro"] = $parametros["p3"];
                    $datos["hiCodigoFiliacionActiva"] = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->agetTratamientoPaciente2($datos);
                    break;
                }


            case 'PopudVincularRecetasConTratamientos': {

                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $resultado = $o_ActionCita->aPopudVincularRecetasConTratamientos($datos);


//                    $datos = array();
//                    $datos["IdExamenLaboratorio"] = $parametros["p2"];
//                    $datos["NombreExamenLaboratorio"] = $parametros["p3"];
//                    $resultado = $o_ActionLaboratorio->aPopudVincularRecetasConTratamientos($datos);
                    break;
                }

            case 'updateUbicacionCita': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos["iIdUbicacionCita"] = $parametros["p2"];
                    $datos["iCodigoProgramacion"] = $parametros["p3"];
                    $resultado = $o_ActionCita->aUpdateUbicacionCita($datos);
                    break;
                }



            case 'ListarTiposAfiliacionExamenLaboratorio': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aListarTiposAfiliacionExamenLaboratorio();
                    break;
                }
            case 'precioExamenesxAfiliacion': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aprecioExamenesxAfiliacion($parametros);
                    break;
                }
            case 'PopudMantenimientoExamenesEditarEliminar': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["IdExamenLaboratorio"] = $parametros["p2"];
                    $datos["NombreExamenLaboratorio"] = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->aPopudMantenimientoExamenesEditarEliminar($datos);
                    break;
                }







            case 'PopudAgregarUnidadMedidaxMaterialLaboratorio': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aPopudAgregarUnidadMedidaxMaterialLaboratorio();
                    break;
                }
            case 'cargarComboUnidadMedidaPopudML': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["IdTipoUnidadMedidaSeleccionada"] = $parametros["p2"];
                    $datos["idtMaterialLaboratorio"] = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->AcargarComboUnidadMedidaPopudML($datos);
                    break;
                }
            case 'cargarComboTipoUnidadMedidaMaterialSeleccionado': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idMaterialLaboratorio"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->AcargarComboTipoUnidadMedidaMaterialSeleccionado($datos);
                    break;
                }
            case 'cargarComboUnidadMedidaMaterialSeleccionado': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["hIdMaterialLaboratorio"] = $parametros["p2"];
                    $datos["TipoUnidadMedidaEscogida"] = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->AcargarComboUnidadMedidaMaterialSeleccionado($datos);
                    break;
                }
            case 'cargarComboUnidadMedidaMaterialSeleccionado_detalleMaterialesSeleccionados': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["hIdMaterialLaboratorio"] = $parametros["p2"];
                    $datos["TipoUnidadMedidaEscogida"] = $parametros["p3"];
                    $datos["idUnidadMedidaExamenLabotorio"] = $parametros["p4"];
                    $resultado = $o_ActionLaboratorio->cargarComboUnidadMedidaMaterialSeleccionado_detalleMaterialesSeleccionados($datos);
                    break;
                }
            case 'cargarComboTipoUnidadMedidaMuestraSeleccionado': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->AcargarComboTipoUnidadMedidaMuestraSeleccionado();
                    break;
                }
            case 'cargarComboUnidadMedidaMuestraSeleccionado': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["TipoUnidadMedidaEscogidaMuestra"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->AcargarComboUnidadMedidaMuestraSeleccionado($datos);
                    break;
                }

            case 'cargarComboUnidadMedidaMuestraSeleccionado_detalleMuestraSeleccionados': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["cboTipoUnidadMedidaMuestraSeleccionada"] = $parametros["p3"];
                    $datos["TipoUnidadMedidaEscogidaMuestra"] = $parametros["p3"];
                    $datos["idMuestraPuntoControlLaboratorio"] = $parametros["p4"];
                    $resultado = $o_ActionLaboratorio->AcargarComboUnidadMedidaMuestraSeleccionadodetalleMuestraSeleccionados($datos);
                    break;
                }
            case 'vbuscarMaterialesxPuntoControl': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->avbuscarMaterialesxPuntoControl();
                    break;
                }
            case 'vbuscarMaterialesxPuntoControl_2': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->avbuscarMaterialesxPuntoControl_2();
                    break;
                }
            case 'vbuscarMaterialesxPuntoControl_3': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->avbuscarMaterialesxPuntoControl_3();
                    break;
                }

            case 'buscarMaterialesLaboratorioPopap': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["p2"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->abuscarMaterialesLaboratorioPopap($datos);
                    break;
                }
            case 'buscarMaterialesLaboratorioPopap_2': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["p2"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->abuscarMaterialesLaboratorioPopap_2($datos);
                    break;
                }
            case 'buscarMaterialesLaboratorioPopap_3': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["p2"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->abuscarMaterialesLaboratorioPopap_3($datos);
                    break;
                }
            case 'PopudMuestrasPorExamen': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["IdExamenLaboratorio"] = $parametros["p2"];
                    $datos["NombreExamenLaboratorio"] = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->aPopudMuestrasPorExamen($datos);
                    break;
                }
            case 'PopudSeleccionarRecipiente': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["IdExamenLaboratorio"] = $parametros["p2"];
                    $datos["NombreExamenLaboratorio"] = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->aPopudSeleccionarRecipiente($datos);
                    break;
                }
            case 'PopudMantenimientoRecipiente': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["IdExamenLaboratorio"] = $parametros["p2"];
                    $datos["NombreExamenLaboratorio"] = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->aPopudMantenimientoRecipiente($datos);
                    break;
                }
            case 'mantenimientoExamenes': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->mantenimientoExamenes();
                    //mantenimientoExamenes            AmantenimientoExamenes  
                    break;
                }
            case 'MaterialesdeLaboratorio': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->AMaterialesdeLaboratorio();
                    break;
                }


            case 'agregarNuevoUnidadalMaterialLaboratorioPoppud': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["IdUnidadMedidadSeleccionada"] = $parametros["p2"];
                    $datos["IdMaterialLabo"] = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->aagregarNuevoUnidadalMaterialLaboratorioPoppud($datos);
                    break;
                }
            case 'GuardarCambiosDetalleMaterialesdeLaboratorio': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["IdMaterialLaboratorio"] = $parametros["p2"];
                    $datos["IdtipoMaterialLaboratorio"] = $parametros["p3"];
                    $datos["txtDescripcionMaterialLaboratorio"] = $parametros["p4"];
                    $datos["txtRutaPrincipalCompleta"] = $parametros["p5"];
                    $resultado = $o_ActionLaboratorio->aGuardarCambiosDetalleMaterialesdeLaboratorio($datos);
                    break;
                }
            case 'ActualizarItemMaterialesAlmacenados': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["TipoUnidadMedidaDisponibles"] = $parametros["p2"];
                    $datos["UnidadMedidaDisponibles"] = $parametros["p3"];
                    $datos["CantidadMaximaMaterial"] = $parametros["p4"];
                    $datos["CantidadMinimaMaterial"] = $parametros["p5"];
                    $datos["idUnidadMedidaExamenLabotorio"] = $parametros["p6"];
                    $resultado = $o_ActionLaboratorio->aActualizarItemMaterialesAlmacenados($datos);
                    break;
                }
            case 'ActualizarItemMuestraAlmacenados': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["cboTipoUnidadMedidaMuestraSeleccionada"] = $parametros["p2"];
                    $datos["cboUnidadMedidaMuestraSeleccionada"] = $parametros["p3"];
                    $datos["txtCantidadMaximaMuestraSeleccionada"] = $parametros["p4"];
                    $datos["txtCantidadMinimaMuestraSeleccionada"] = $parametros["p5"];
                    $datos["idMuestraPuntoControlLaboratorio"] = $parametros["p6"];
                    $resultado = $o_ActionLaboratorio->aActualizarItemMuestraAlmacenados($datos);
                    break;
                }
            case 'EliminarItemMuestraAlmacenados': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["idMuestraPuntoControlLaboratorio"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->aEliminarItemMuestraAlmacenados($datos);
                    break;
                }
            case 'EliminarItemMaterialesAlmacenados': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["idUnidadMedidaExamenLab"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->aEliminarItemMaterialesAlmacenados($datos);
                    break;
                }
            case 'presentarfotoDeMaterialLaboratorio': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["IdMaterialLaboratorio"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->apresentarfotoDeMaterialLaboratorio($datos);
                    break;
                }
            case 'seleccionandoMuestraxPuntoControl': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["hidPuntoControlExamenLab"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->AseleccionandoMuestraxPuntoControl($datos);
                    break;
                }

            //jcqa

            case 'seleccionandoTratamientoParaCita': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["idtratamiento"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->AseleccionandoTratamientoParaCita($datos);
                    break;
                }

            case 'seleccionandoPuntoControlRecibir': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["hidPuntoControlExamenLab"] = $parametros["p2"];
                    $datos["estadoRecibir"] = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->AseleccionandoPuntoControlRecibir($datos);
                    break;
                }
            case 'GuardarCambiosDetalleMaterialesdeLaboratorio_Nuevo': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["CodSerPro"] = $parametros["p2"];
                    $datos["IdtipoMaterialLaboratorio"] = $parametros["p3"];
                    $datos["txtDescripcionMaterialLaboratorio"] = $parametros["p4"];
                    $datos["txtRutaPrincipalCompleta"] = $parametros["p5"];
                    $resultado = $o_ActionLaboratorio->aGuardarCambiosDetalleMaterialesdeLaboratorio_Nuevo($datos);
                    break;
                }
            case 'GuardarMuestraxPuntoControlxExamenLaboratorio': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["IdMuestraLaboratorio"] = $parametros["p2"];
                    $datos["IdPuntoControlExamenLaboratorio"] = $parametros["p3"];
                    $datos["UnidadMedidaMuestraSeleccionada"] = $parametros["p4"];
                    $datos["CantidadMaximaMuestraSeleccionada"] = $parametros["p5"];
                    $datos["CantidadMinimaMuestraSeleccionada"] = $parametros["p6"];
                    $resultado = $o_ActionLaboratorio->aGuardarMuestraxPuntoControlxExamenLaboratorio($datos);
                    break;
                }
            case 'GuardarMaterialxPuntoControlxExamenLaboratorio': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["IdMaterialLaboratorio"] = $parametros["p2"];
                    $datos["idPuntoControlExamenLab"] = $parametros["p3"];
                    $datos["UnidadMedidaDisponibles"] = $parametros["p4"];
                    $datos["txtCantidadMaximaMaterialLabo"] = $parametros["p5"];
                    $datos["txtCantidadMinimaMaterialLabo"] = $parametros["p6"];
                    $resultado = $o_ActionLaboratorio->aGuardarMaterialxPuntoControlxExamenLaboratorio($datos);
                    break;
                }


            //23 Enero

            case 'arbolPracticasOdontologicas': {
                    require_once("ActionRrhh.php");
                    header("Content-type:text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->aarbolPracticasOdontologicas();
                    break;
                }


            case 'mostrarImagenMaterialLaboratorioTraerData': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["idMaterialLaboratorio"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->amostrarImagenMaterialLaboratorioTraerData($datos);
                    break;
                }
            case 'ReporteIndicadorActoMedico': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->ReporteIndicadorActoMedico();
                    break;
                }
            case 'cambiarEstadoServicioRelacionado': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["iIdRelacion"] = $parametros["p2"];
                    $datos["bEstado"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->cambiarEstadoServicioRelacionado($datos);
                    break;
                }

            case 'ReporteEstadisticoActoMedico': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->ReporteEstadisticoActoMedico();
                    break;
                }

            case 'ReportesEstadisticosActoMedico': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->ReportesEstadisticosActoMedico();
                    break;
                }


            case 'cargarEstadisticasAjax': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->cargarEstadisticasAjax();
                    break;
                }
            case 'cargarTablaExamenesLaboratorio': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aCargarTablaExamenesLaboratorio($parametros);
                    break;
                }
            case 'eliminarPerfilesExamenes': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aEliminarPerfilesExamenes($parametros);
                    break;
                }
            case 'asignarExamenAPerfil': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aAsignarExamenAPerfil($parametros);
                    break;
                }
            case 'ActualizarDetalleExamenLabo': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aActualizarDetalleExamenLabo($parametros);
                    break;
                }
            case 'menuCarnetizacion': {
                    require_once("ActionCarnetizacion.php");
                    $o_ActionCarnetizacion = new ActionCarnetizacion();
                    $resultado = $o_ActionCarnetizacion->AmenuCarnetizacion();
                    break;
                }


            case 'ListarActividades': {
                    header("Content-type: text/xml");
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->ListarActividades();
                    break;
                }
            case 'BuscarPersonaCarnetizacion': {
                    require_once("ActionCarnetizacion.php");
                    header("Content-type: text/xml");
                    $o_ActionCarnetizacion = new ActionCarnetizacion();
                    $datos["codigoPersona"] = $parametros["p2"];
                    $datos["apellidoPaterno"] = $parametros["p3"];
                    $datos["apellidoMaterno"] = $parametros["p4"];
                    $datos["nombre"] = $parametros["p5"];
                    $datos["tipoDocumento"] = $parametros["p6"];
                    $datos["numrDocumento"] = $parametros["p7"];
                    $datos["tipoCertificado"] = $parametros["p8"];
                    $datos["fechaini"] = $parametros["p9"];
                    $datos["fechaVenc"] = $parametros["p10"];
                    $datos["fecha"] = $parametros["p11"];
                    $datos["codigoManipulador"] = $parametros["p12"];
                    $resultado = $o_ActionCarnetizacion->AbuscarPersonaCarnetizacion($datos);
                    break;
                }
            case 'buscarPorBotonPersonaCarnetizacion': {
                    require_once("ActionCarnetizacion.php");
                    $o_ActionCarnetizacion = new ActionCarnetizacion();
                    $datos["codigoPersona"] = $parametros["p2"];
                    $datos["apellidoPaterno"] = $parametros["p3"];
                    $datos["apellidoMaterno"] = $parametros["p4"];
                    $datos["nombre"] = $parametros["p5"];
                    $datos["numrDocumento"] = $parametros["p6"];
                    $datos["fecha"] = $parametros["p7"];
                    $resultado = $o_ActionCarnetizacion->AbuscarPorBotonPersonaCarnetizacion($datos);
                    break;
                }
            case 'buscarCboCantidadCertificadoPorTipo': {
                    require_once("ActionCarnetizacion.php");
                    $o_ActionCarnetizacion = new ActionCarnetizacion();
                    $datos["fechaCalendario"] = $parametros["p2"];
                    $datos["idTipoCertifiado"] = $parametros["p3"];
                    $datos["idSubTipoCertifiado"] = $parametros["p4"];
                    $resultado = $o_ActionCarnetizacion->AbuscarCboCantidadCertificadoPorTipo($datos);
                    break;
                }
            case 'cargarComboTipoCertificado': {
                    require_once("ActionCarnetizacion.php");
                    $o_ActionCarnetizacion = new ActionCarnetizacion();
                    $resultado = $o_ActionCarnetizacion->AcargarComboTipoCertificado();
                    break;
                }
            case 'actualizarTipoCertificado': {
                    require_once("ActionCarnetizacion.php");
                    $o_ActionCarnetizacion = new ActionCarnetizacion();
                    $datos["idCertificado"] = $parametros["p2"];
                    $datos["idTipoCertifiado"] = $parametros["p3"];
                    $resultado = $o_ActionCarnetizacion->AactualizarTipoCertificado($datos);
                    break;
                }
            case 'confirmarImpresion': {
                    require_once("ActionCarnetizacion.php");
                    $o_ActionCarnetizacion = new ActionCarnetizacion();
                    $datos["idCertificado"] = $parametros["p2"];
                    $datos["estado"] = $parametros["p3"];
                    $resultado = $o_ActionCarnetizacion->AconfirmarImpresion($datos);
                    break;
                }
            case 'confirmarEntregado': {
                    require_once("ActionCarnetizacion.php");
                    $o_ActionCarnetizacion = new ActionCarnetizacion();
                    $datos["idCertificado"] = $parametros["p2"];
                    $datos["estado"] = $parametros["p3"];
                    $datos["idSubTipoCertificado"] = $parametros["p4"];
                    $resultado = $o_ActionCarnetizacion->AconfirmarEntregado($datos);
                    break;
                }
            case 'actualizarCertificado': {
                    require_once("ActionCarnetizacion.php");
                    $o_ActionCarnetizacion = new ActionCarnetizacion();
                    $datos["idCertificado"] = $parametros["p2"];
                    $datos["fechaCaducidad"] = $parametros["p3"];
                    $datos["c_cod_per"] = $parametros["p4"];
                    $datos["idSubTipoCertificado"] = $parametros["p5"];
                    $resultado = $o_ActionCarnetizacion->AactualizarCertificado($datos);
                    break;
                }
            case 'ReporteIndicadorLaboratorioClinico': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->aReporteIndicadorLaboratorioClinico();
                    break;
                }
            case 'indicadorLaboratorioClinicoListaAfiliaciones': {
                    require_once("ActionReporte.php");
                    header("Content-type: text/xml");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->aindicadorLaboratorioClinicoListaAfiliaciones();
                    break;
                }
            case 'indicadorLaboratorioClinicoListaProcedencia': {
                    require_once("ActionReporte.php");
                    header("Content-type: text/xml");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->aindicadorLaboratorioClinicoListaProcedencia();
                    break;
                }
            case 'indicadorLaboratorioClinicoListaSedes': {
                    require_once("ActionReporte.php");
                    header("Content-type: text/xml");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->aindicadorLaboratorioClinicoListaSedes();
                    break;
                }
            case 'indicadorLaboratorioClinicoMaterialesLaboratorio': {
                    require_once("ActionReporte.php");
                    header("Content-type: text/xml");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->indicadorLaboratorioClinicoMaterialesLaboratorio();
                    break;
                }
            case 'mostrarPracticaDiego': {
                    require_once("ActionUsuario.php");
                    $o_ActionUsuario = new ActionUsuario();
                    $resultado = $o_ActionUsuario->aMostrarPracticaDiego();
                    break;
                }
            case 'cargarTablaPacientes': {

                    header("Content-type: text/xml");

                    require_once("ActionUsuario.php");
                    header("Content-type: text/xml");

                    $o_ActionUsuario = new ActionUsuario();
                    $resultado = $o_ActionUsuario->cargarTablaPacientes();
                    break;
                }
            case 'indicadorLaboratorioClinicoListaExamenes': {
                    require_once("ActionReporte.php");
                    header("Content-type: text/xml");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->aindicadorLaboratorioClinicoListaExamenes();
                    break;
                }
            case 'anularExamenPaciente': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idCodExamen"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->anularExamenPaciente($datos);
                    break;
                }
            case 'reprogramarExamen': {
                    require_once("ActionLaboratorio.php");
                    header("Content-type: text/xml");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos["idCodExamen"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->AreprogramarExamen($datos);
                    break;
                }
            case 'agregarPuntoControlBoton': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["hidPuntoControlExamenLab"] = $parametros["p2"];
                    $datos["estadoBoton"] = $parametros["p3"];
                    $resultado = $o_ActionLaboratorio->AgregarPuntoControlBoton($datos);
                    break;
                }
            case 'CargarDatosResultadosLaboratorio': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["txtCodigoBarras"] = $parametros["p2"];
                    $datos["numeroCampos"] = $parametros["p3"];
                    $datos["idPacienteLaboratorio"] = $parametros["p4"];
                    $resultado = $o_ActionLaboratorio->AcargarDatosResultadosLaboratorio($datos);
                    break;
                }
            case 'aceptarArchivoGuardarDatosEnBaseDatos': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["vArchivo"] = $parametros["p2"];
                    $datos["dFechaCreacion"] = $parametros["p3"];
                    $datos["dFechaModificacion"] = $parametros["p4"];
                    $resultado = $o_ActionLaboratorio->validarGuardarDatosEnBaseDatos($datos);
                    break;
                }


            // lobo


            case 'eviarArchivoExcel': {
                    require_once("ActionLaboratorio.php");

                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $datos = array();
                    $datos["txtCodigoBarras"] = $parametros["p2"];
                    $resultado = $o_ActionLaboratorio->AeviarArchivoExcel($datos);
                    break;
                }
            // lobo
            //JCDB 01/08/2012

            case 'cargarComboProcedenciaFiltro': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();
                    $resultado = $o_ActionLaboratorio->aCargarComboProcedenciaFiltro();
                    break;
                }




            case 'contarRegistrosgetTratamientoPaciente': {
                    require_once("ActionLaboratorio.php");
                    $o_ActionLaboratorio = new ActionLaboratorio();


                    $datos["iid_persona"] = $parametros["p2"];
                    $datos["arrayCod_Ser_Pro"] = $parametros["p3"];
                    $datos["hiCodigoFiliacionActiva"] = $parametros["p4"];


                    $resultado = $o_ActionLaboratorio->acontarRegistrosgetTratamientoPaciente($datos);
                    break;
                }
//----------------------------------------------------------------------------------------   
//----------------------------EQUIVALENCIAS CPT-------------------------------------------
//----------------------------------------------------------------------------------------

            case 'abrirEquivalenciasCPT': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->abrirEquivalenciasCPT();
                    break;
                }

            case 'cargarTablaMxserpro': {//Carga por defecto la lista de formularios
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["nombreMxserpro"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->AcargarTablaMxserpro($datos);
                    break;
                }

            case 'cargarRegistroMxserpro': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["iIdCPT"] = $parametros["p2"];
                    $datos["vCPTdescripcion"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->AcargarRegistroMxserpro($datos);
                    break;
                }

            case 'guardarRegistroServicio' : {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["iIdCPT"] = $parametros["p2"];
                    $datos["mxSerpro"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->AguardarRegistroServicio($datos);
                    break;
                }

            case 'buscarTablaCPT': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["nombreCTP"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->AbuscarTablaCPT($datos);
                    break;
                }

            case 'buscarCPTcod': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["iIdCPT"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->AbuscarCPTcod($datos);
                    break;
                }

            case 'buscarMxSerProcod': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos = array();
                    $datos["codMxserpro"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->AbuscarMxSerProcod($datos);
                    break;
                }


//----------------------------------------------------------------------------------------  
//----------------------------------------------------------------------------------------
//---------------------------ventanaVerDetalleOrden--------------------------
//---------------------------------------------------------------------------- 

            case 'ventanaVerDetalleOrden': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $resultado = $o_ActionCita->ventanaVerDetalleOrden();
                    break;
                }

            case 'MostrarDetalleOrden': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos['nroOrden'] = $parametros["p2"];
                    $datos['codPersona'] = $parametros["p3"];
                    $datos['CodProgramacion'] = $parametros["p4"];
                    $resultado = $o_ActionCita->MostrarDetalleOrden($datos);
                    break;
                }

            case 'MostrarUsuarioRegistro': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos['CodProgramacion'] = $parametros["p2"];
                    $datos['codcronograma'] = $parametros["p3"];
                    $datos['codPersona'] = $parametros["p4"];
                    $resultado = $o_ActionCita->MostrarUsuarioRegistro($datos);
                    break;
                }

            case 'MostrarUsuarioConfirma': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos['CodProgramacion'] = $parametros["p2"];
                    $datos['codcronograma'] = $parametros["p3"];
                    $datos['codPersona'] = $parametros["p4"];
                    $resultado = $o_ActionCita->MostrarUsuarioConfirma($datos);
                    break;
                }

            case 'MostrarUsuarioPaga': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos['nroOrden'] = $parametros["p2"];
                    $resultado = $o_ActionCita->MostrarUsuarioPaga($datos);
                    break;
                }

            case 'MostrarAtencionInicio': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos['CodProgramacion'] = $parametros["p2"];
                    $datos['codcronograma'] = $parametros["p3"];
                    $datos['codPersona'] = $parametros["p4"];
                    $resultado = $o_ActionCita->MostrarAtencionInicio($datos);
                    break;
                }
            case 'MostrarAtencionFin': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos['CodProgramacion'] = $parametros["p2"];
                    $datos['codcronograma'] = $parametros["p3"];
                    $datos['codPersona'] = $parametros["p4"];
                    $resultado = $o_ActionCita->MostrarAtencionFin($datos);
                    break;
                }

            case 'examenesRelacionados': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["iIdCPT"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->AexamenesRelacionados($datos);
                    break;
                }

            case 'MostrarReceta': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos['CodProgramacion'] = $parametros["p2"];
                    $resultado = $o_ActionCita->AmostrarReceta($datos);
                    break;
                }
            ///DIEGO ALVAREZ TARA AZONA//
            case 'cargarMantenimientoIP' : {
                    require_once("../../cvista/mantenimientogeneral/cargarMantenimientoIP.php");
                    break;
                }
            case 'cargarTablaIPs' : {
                    require_once("ActionMantenimientoGeneral.php");
                    header("Content-type: text/xml");
                    $ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $resultado = $ActionMantenimientoGeneral->cargarTablaIPs();
                    break;
                }
            case 'cargarTablaAmbientes' : {
                    require_once("ActionMantenimientoGeneral.php");
                    header("Content-type: text/xml");
                    $ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $resultado = $ActionMantenimientoGeneral->cargarTablaAmbientes();
                    break;
                }


            case 'guardarMantenimientoIp' : {
                    require_once("ActionMantenimientoGeneral.php");
                    $ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos["textIP"] = $parametros["p2"];
                    $datos["textPC"] = $parametros["p3"];
                    $datos["textIDAmbiente"] = $parametros["p4"];
                    $resultado = $ActionMantenimientoGeneral->aguardarMantenimientoIp($datos);
                    break;
                }
            case 'actualizarMantenimiento' : {
                    require_once("ActionMantenimientoGeneral.php");
                    $ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos["textIP"] = $parametros["p2"];
                    $datos["textPC"] = $parametros["p3"];
                    $datos["textID"] = $parametros["p4"];
                    $datos["textIDAmbiente"] = $parametros["p5"];
                    $resultado = $ActionMantenimientoGeneral->actualizarMantenimiento($datos);
                    break;
                }
            case 'eliminarMantenimiento' : {
                    require_once("ActionMantenimientoGeneral.php");
                    $ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                    $datos["textID"] = $parametros["p2"];
                    $resultado = $ActionMantenimientoGeneral->eliminarMantenimiento($datos);
                    break;
                }
//----------------------------------------------------------------------------------------  
//------------------------------------LEYENDA---------------------------------------------
            case 'mostrarLeyenda': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["codProgramacion"] = $parametros["p2"];
                    $datos["bcolor"] = $parametros["p3"];
                    $datos["icolor"] = $parametros["p4"];
                    $datos["dientes"] = $parametros["p5"];
                    $resultado = $o_ActionActoMedico->AmostrarLeyenda($datos);
                    break;
                }

            case 'historiaLeyenda': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["CodPersona"] = $parametros["p2"];
                    $datos["CodProgramacionHistoria"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->AhistoriaLeyenda($datos);
                    break;
                }

            //-------------------------------------------------------------------------
            case 'actualizarProcedencia': {
                    require_once("ActionCarnetizacion.php");
                    $o_ActionCarnetizacion = new ActionCarnetizacion();
                    $datos["idCertificado"] = $parametros["p2"];
                    $datos["idProcedencia"] = $parametros["p3"];
                    $resultado = $o_ActionCarnetizacion->AactualizarProcedencia($datos);
                    break;
                }

            case 'fotoPersonaCarnetizacion': {
                    require_once("ActionCarnetizacion.php");
                    $o_ActionCarnetizacion = new ActionCarnetizacion();
                    $datos["c_cod_per"] = $parametros["p2"];

                    $resultado = $o_ActionCarnetizacion->AfotoPersonaCarnetizacion($datos);
                    break;
                }
            case 'mostrar_datos_paciente_carnetizacion': {
                    require_once("ActionAdmision.php");
                    $o_ActionAdmision = new ActionAdmision();
                    $funcion = $parametros["funcionJSEjecutar"];
                    $resultado = $o_ActionAdmision->formRegistroPersonas(trim($parametros["p2"]), $funcion);
                    break;
                }

            case 'podpadReporteEmpleadoVenceContrato': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->ApodpadReporteEmpleadoVenceContrato();
                    break;
                }
            case 'verEmpleadoCaducaSuContratoTabla': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->AverEmpleadoCaducaSuContratoTabla();
                    break;
                }

            case 'mantenimientoGrupoEtario': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();

                    $resultado = $o_ActionActoMedico->AmantenimientoGrupoEtario();
                    break;
                }
            case 'cargarTablaGrupoEtario': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["icboAfiliacionGrupoEtario"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->AcargarTablaGrupoEtario($datos);
                    break;
                }
            case 'agregarNuevoServicioPorGRupoEtario': {
                    require_once("ActionActoMedico.php");
//                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
//                    $datos["icboAfiliacionGrupoEtario"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->AgregarNuevoServicioPorGRupoEtario();
                    break;
                }

            case 'cargarTablaServicioGrupoEtario': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["nombreServicioGrupoEtario"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->AcargarTablaServicioGrupoEtario($datos);
                    break;
                }
            case 'serviciosSeleccionadoPorGrupoEtario': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["idGrupoEtario"] = $parametros["p2"];
                    $resultado = $o_ActionActoMedico->AserviciosSeleccionadoPorGrupoEtario($datos);
                    break;
                }
            case 'seleccionarServicioGrupoEtario': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["c_cod_prod"] = $parametros["p2"];
                    $datos["iIdGrupoEtario"] = $parametros["p3"];

                    $resultado = $o_ActionActoMedico->AseleccionarServicioGrupoEtario($datos);
                    break;
                }
            case 'guardarServicioGrupoEtario': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["c_cod_prod"] = $parametros["p2"];
                    $datos["iIdGrupoEtario"] = $parametros["p3"];
                    $datos["cboTipoServicioCPT"] = $parametros["p4"];
                    $datos["cboPeriodoEdad"] = $parametros["p5"];
                    $datos["txtnEdadToma"] = $parametros["p6"];
                    $datos["txtNroAtenciones"] = $parametros["p7"];
                    $datos["txtiOrder"] = $parametros["p8"];
                    $datos["vMensaje"] = $parametros["p9"];
                    $resultado = $o_ActionActoMedico->AguardarServicioGrupoEtario($datos);
                    break;
                }
            case 'eliminarseleccionarServicioGrupoEtario': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["iIdServicioGrupoEtareo"] = $parametros["p2"];
                    $datos["iOrden"] = $parametros["p3"];
                    $datos["iIdGrupoEtario"] = $parametros["p4"];

                    $resultado = $o_ActionActoMedico->AeliminarseleccionarServicioGrupoEtario($datos);
                    break;
                }

            case 'modificarServicioGrupoEtario': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["c_cod_prod"] = $parametros["p2"];
                    $datos["iIdGrupoEtario"] = $parametros["p3"];
                    $datos["cboTipoServicioCPT"] = $parametros["p4"];
                    $datos["cboPeriodoEdad"] = $parametros["p5"];
                    $datos["txtnEdadToma"] = $parametros["p6"];
                    $datos["txtNroAtenciones"] = $parametros["p7"];
                    $datos["txtiOrder"] = $parametros["p8"];
                    $datos["iIdServicioGrupoEtareo"] = $parametros["p9"];
                    $datos["vMensaje"] = $parametros["p10"];
                    $resultado = $o_ActionActoMedico->AmodificarServicioGrupoEtario($datos);
                    break;
                }

            case 'cargarTablaPAquete': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["codigoPersona"] = $parametros["p2"];
                    $datos["servicio"] = $parametros["p3"];
                    $datos["codigoProgramacion"] = $parametros["p4"];
                    $datos["iIdGrupoEtarioPersonas"] = $parametros["p5"];
                    $datos["iIdGrupoEtareo"] = $parametros["p6"];

                    $resultado = $o_ActionActoMedico->apaqueteIncompleto($datos);
                    break;
                }

            case 'popapserviciosDuplicados': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["ctp"] = $parametros["p2"];
                    $datos["nroAte"] = $parametros["p3"];
                    $datos["iIdServicioGrupoEtareoPersona"] = $parametros["p4"];
                    $resultado = $o_ActionActoMedico->ApopapserviciosDuplicados($datos);
                    break;
                }

            case 'cargarServiciosDuplicados': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["codigoCTP"] = $parametros["p2"];
                    $datos["nroAte"] = $parametros["p3"];
                    $datos["iGrupoEtario"] = $parametros["p4"];

                    $resultado = $o_ActionActoMedico->AcargarServiciosDuplicados($datos);
                    break;
                }

            case 'actualizarEstadoDeServicioGrupoEtarioPersona': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["iIdServicioGrupoEtareoPersona"] = $parametros["p2"];
                    $datos["iCantidad"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->AactualizarEstadoDeServicioGrupoEtarioPersona($datos);
                    break;
                }

            case 'programacionAsistenciaPersonalRRHH': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["c_cod_per"] = $parametros["p2"];
                    $datos["nombre"] = $parametros["p3"];
                    $datos["codigoEmpleado"] = $parametros["p4"];
                    $datos["anio"] = $parametros["p5"];
                    $datos["mes"] = $parametros["p6"];
                    $resultado = $o_ActionRrhh->AprogramacionAsistenciaPersonalRRHH($datos);
                    break;
                }
            case 'refrescarVPaquetes': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["codigoProgramacion"] = $parametros["p2"];
                    $datos["codpersona"] = $parametros["p3"];
                    $datos["valor"] = $parametros["p4"];
                    $resultado = $o_ActionActoMedico->ArefrescarVPaquetes($datos);
                    break;
                }

//-------------------------------------SANDY-------------------------------------------------
//--------------------------------------------------------------------------------------
            case 'programacionPorArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["codigoPreProgramacion"] = ltrim($parametros["p2"]);
                    $resultado = $o_ActionRrhh->AprogramacionPorArea($datos);
                    break;
                }

            case 'programacionTotalEmpleadoAreaSede': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["iCodEmpleado"] = ltrim($parametros["p2"]);
                    $datos["nomMes"] = ltrim($parametros["p3"]);
                    $datos["anio"] = ltrim($parametros["p4"]);
                    $resultado = $o_ActionRrhh->programacionTotalEmpleadoAreaSede($datos);
                    break;
                }

            case 'programacionBorrar': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["codigoPreProgramacion"] = ltrim($parametros["p2"]);
                    $resultado = $o_ActionRrhh->AprogramacionBorrar($datos);
                    break;
                }

            case 'cargarTablaProgramacionEmpleadoEliminarTurno': {
                    header("Content-type: text/xml");
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["codigoPreProgramacion"] = ltrim($parametros["p2"]);
                    $resultado = $o_ActionRrhh->cargarTablaProgramacionEmpleadoEliminarTurno($datos);
                    break;
                }

            case 'programacionSeleccionadaTurno': {
                    header("Content-type: text/xml");
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["PreProgramacion"] = ltrim($parametros["p2"]);
                    $datos["Turno"] = ltrim($parametros["p3"]);
                    $datos["nomMes"] = ltrim($parametros["p4"]);
                    $datos["anio"] = ltrim($parametros["p5"]);
                    $datos["codEmpleado"] = ltrim($parametros["p6"]);
                    $resultado = $o_ActionRrhh->AprogramacionSeleccionadaTurno($datos);
                    break;
                }
            case 'cargarTablaTurnosPreProgramacion': {
                    header("Content-type: text/xml");
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["PreProgramacion"] = rtrim(ltrim($parametros["p2"]));
                    $resultado = $o_ActionRrhh->cargarTablaTurnosPreProgramacion($datos);
                    break;
                }


            case 'programacionEliminarPopadVista': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["codigoPreProgramacion"] = rtrim(ltrim($parametros["p2"]));
                    $datos["iCodigoEmpleado"] = rtrim(ltrim($parametros["p3"]));
                    $datos["nomMes"] = rtrim(ltrim($parametros["p4"]));
                    $datos["anio"] = rtrim(ltrim($parametros["p5"]));
                    $resultado = $o_ActionRrhh->aProgramacionEliminarPopadVista($datos);
                    break;
                }
            case 'btnEliminarProgramacoinPreProgramacionSelecionado': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["codigoPreProgramacion"] = rtrim(ltrim($parametros["p2"]));
                    $datos["iCodigoEmpleado"] = rtrim(ltrim($parametros["p3"]));
                    $datos["nomMes"] = rtrim(ltrim($parametros["p4"]));
                    $datos["anio"] = rtrim(ltrim($parametros["p5"]));
                    $resultado = $o_ActionRrhh->btnEliminarProgramacoinPreProgramacionSelecionado($datos);
                    break;
                }



//--------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------      
            case 'mantenimientoAreaPersona': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["idArea"] = $parametros["p2"];
                    $datos["idPuestoEmpleado"] = $parametros["p3"];
                    $datos["estado"] = $parametros["p4"];
                    $datos["imes"] = $parametros["p5"];
                    $datos["ianio"] = $parametros["p6"];
                    $resultado = $o_ActionRrhh->aMantenimientoAreaPersona($datos);
                    break;
                }
            case 'actualizarProgramacionEmpleados': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["idPreprogramacion"] = $parametros["p2"];
                    $datos["iCodigoempleado"] = $parametros["p3"];
                    $datos["imes"] = $parametros["p4"];
                    $datos["ianio"] = $parametros["p5"];

                    $resultado = $o_ActionRrhh->aActualizarProgramacionEmpleados($datos);
                    break;
                }
            case 'registroHorariosEmpleadosTotal': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["iCodigoEmpeladoCoordinador"] = $parametros["p2"];

                    $resultado = $o_ActionRrhh->registroHorariosEmpleadosTotal($datos);
                    break;
                }

            case 'eliminarTurnoPersona': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["idMarcacionPersonal"] = $parametros["p2"];
                    $datos["idTxtAreaObservacion"] = $parametros["p3"];

                    $resultado = $o_ActionRrhh->AeliminarTurnoPersona($datos);
                    break;
                }
//**************************************************************************************
            case 'mostrarReporteGrupoEtareo': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $o_ActionReporte->AmostrarReporteGrupoEtareo();
                    break;
                }

            case 'buscarReporteGruposEtareos': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = utf8_encode($o_ActionReporte->AbuscarReporteGruposEtareos());
                    break;
                }

            case 'buscarPersonasGrupoEtareo': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos["iIdGrupoEtareo"] = $parametros["p2"];
                    $datos["ServComple"] = $parametros["p3"];
                    $resultado = utf8_encode($o_ActionReporte->AbuscarPersonasGrupoEtareo($datos));
                    break;
                }

            case 'MostrarPersonasGrupoEtareo': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos["iIdGrupoEtareo"] = $parametros["p2"];
                    $resultado = utf8_encode($o_ActionReporte->AbuscarPersonasGrupoEtareo($datos));
                    break;
                }

            case 'ventanaMostrarCPTfaltantes': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = utf8_encode($o_ActionReporte->ventanaMostrarCPTfaltantes());
                    break;
                }

            case 'MostrarCPTfaltantes': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos['c_cod_per'] = $parametros["p2"];
                    $resultado = $o_ActionReporte->AmostrarCPTfaltantes($datos);
                    break;
                }
            case 'reportePerActElimInsert': {
                    header("Content-type: text/xml");
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["iAnio"] = $parametros["p2"];
                    $datos["iMes"] = $parametros["p3"];

                    $resultado = $o_ActionRrhh->AreportePerActElimInsert($datos);
                    break;
                }
            case 'editarServicioGrupoEtario': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["iIdServicioGrupoEtareo"] = $parametros["p2"];
                    $datos["iOrden"] = $parametros["p3"];
                    $datos["iIdGrupoEtario"] = $parametros["p4"];
                    $datos["iorden"] = $parametros["p5"];
                    $datos["iIdTipoServicioCPT"] = $parametros["p6"];
                    $datos["iIdPeriodoEdad"] = $parametros["p7"];
                    $datos["edad"] = $parametros["p8"];
                    $datos["nroAtencion"] = $parametros["p9"];
                    $datos["vMensaje"] = $parametros["p10"];
                    $resultado = $o_ActionActoMedico->AeditarServicioGrupoEtario($datos);
                    break;
                }
            case 'actualizarEstadoObligatorio': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["iIdServicioGrupoEtareo"] = $parametros["p2"];
                    $datos["estado"] = $parametros["p3"];
                    $resultado = $o_ActionActoMedico->actualizarEstadoObligatorio($datos);
                    break;
                }
            case 'buscarEmpleadosAreasNombre': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["p1"] = $parametros["p2"]; //comboTipoEstados
                    $datos["p2"] = $parametros["p3"]; //c_cod_per
                    $datos["p3"] = $parametros["p4"]; //apellidoPaterno
                    $datos["p4"] = $parametros["p5"]; //apellidoMaterno
                    $datos["p5"] = $parametros["p6"]; //nombres
                    $datos["p6"] = $parametros["p7"]; //comboTipoDocumentos
                    $datos["p7"] = $parametros["p8"]; //nroDoc

                    $resultado = $o_ActionRrhh->AbuscarEmpleadosAreasNombre($datos);
                    break;
                }

            /*   case 'reporteDePuntoControlXExamen': {
              require_once("ActionLaboratorio.php");
              header("Content-type: text/xml");
              $o_ActionLaboratorio = new ActionLaboratorio();
              $datos["iIdExamenesLaboratorio"] = $parametros["p2"];
              $resultado = $o_ActionLaboratorio->AreporteDePuntoControlXExamen($datos);
              break;
              } */
            case 'ventanaEssalud': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->aVentanaEssalud();
                    // $resultado = 'lobo';
                    break;
                }
            case 'clickCargarVistaReportesEssalud': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos["p1"] = $parametros["p2"];
                    $datos["p2"] = $parametros["p3"];
                    $resultado = $o_ActionReporte->aClickCargarVistaReportesEssalud($datos);
                    break;
                }
            case 'verificarSubCarpetas': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos["p1"] = $parametros["p2"];
                    $resultado = $o_ActionReporte->aVerificarSubCarpetas($datos);
                    break;
                }
            case 'verificarExistenciaCarpeta': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $datos["p1"] = $parametros["p2"];
                    $datos["p2"] = $parametros["p3"];
                    $datos["p3"] = $parametros["p4"];
                    $resultado = $o_ActionReporte->aVerificarExistenciaCarpeta($datos);
                    break;
                }
            case 'cargarTablaProgramacionDHTMLX': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    header("Content-type: text/xml");
                    $datos["p1"] = $parametros["p2"];
                    $resultado = $o_ActionReporte->aCargarTablaProgramacionDHTMLX($datos);
                    break;
                }

            case 'buscaEmpleadoHorario': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->AbuscaEmpleadoHorario($parametros['p2'], $parametros['p3'], $parametros['p4'], $parametros['p5'], $parametros['p6'], $parametros['p7'], $parametros['p8'], $parametros['p9'], $parametros['p10']);
                    break;
                }

            case 'cargarArbolNSIG': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    header("Content-type: text/xml");
                    $arrayGrupo = $o_ActionReporte->aArrayGrupoNSIG();
                    $arrayActividad = $o_ActionReporte->aArrayActividadNSIG();
                    $arrayServicio = $o_ActionReporte->aArrayServicioNSIG();
                    require_once("../../cvista/reporte/generarArbolNSIG.php");
                    break;
                }

            case 'cargarArbol': {
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    header("Content-type: text/xml");
                    $resultado = $o_ActionReporte->aMostrarReporteOperacionalTBC();
                    break;
                }


            case 'buscarEmpleadoHorarioSusAreas': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["codEmpleado"] = $parametros["p2"];
                    $datos["codPer"] = $parametros["p3"];
                    $datos["vNombreCompleto"] = $parametros["p4"];
                    $resultado = $o_ActionRrhh->AbuscarEmpleadoHorarioSusAreas($datos);
                    break;
                }
            case 'RegularizacionAsistenciaPorCambioPersonal': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["iIdCodigoempleado"] = $parametros["p2"];
                    $datos["vNombreCompleto"] = $parametros["p3"];
                    $datos["vSede"] = $parametros["p4"];
                    $datos["vArea"] = $parametros["p5"];
                    $datos["dFecha"] = $parametros["p6"];
                    $datos["vTurnos"] = $parametros["p7"];
                    $datos["idProgramacionEmpleados"] = $parametros["p8"];
                    $datos["iIdTurnosAreaSede"] = $parametros["p9"];
                    $datos["iIdSedeEmpresaArea"] = $parametros["p10"];
                    $datos["iIdTipoProgramacion"] = $parametros["p11"];
                    $datos["c_cod_per"] = $parametros["p12"];
                    $resultado = $o_ActionRrhh->AregularizacionAsistenciaPorCambioPersonal($datos);
                    break;
                }
            case 'CargarTabladePersonaReemplazo': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["iIdTurnosAreaSede"] = $parametros["p2"];
                    $datos["iIdCodigoempleado"] = $parametros["p3"];
                    $datos["fHoraInicio"] = $parametros["p4"];
                    $datos["fHoraFin"] = $parametros["p5"];
                    $datos["dFechaProgramada"] = $parametros["p6"];
                    $resultado = $o_ActionRrhh->AcargarTabladePersonaReemplazo($datos);
                    break;
                }
            case 'guardarEmpleadoReemplazador': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["iIdTurnosAreaSede"] = $parametros["p2"];
                    $datos["dFechaProgramada"] = $parametros["p3"];
                    $datos["iIdSedeEmpresaArea"] = $parametros["p4"];
                    $datos["iidPuestoEmpleado"] = $parametros["p5"];
                    $datos["iIdTipoProgramacion"] = $parametros["p6"];
                    $resultado = $o_ActionRrhh->AguardarEmpleadoReemplazador($datos);
                    break;
                }
            case 'horaExtrasTrabajadas': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["cadenaStrin"] = $parametros["p2"];
                    $datos["c_cod_per"] = $parametros["p3"];
                    $resultado = $o_ActionRrhh->AhoraExtrasTrabajadas($datos);
                    break;
                }

            /*             * *******************Busqueda de Medicos*********************** */
            /*             * ************************************************************* */

            case 'RegularizarMarcacionMedicos': {
                    require_once '../../cvista/rrhh/RegularizarMarcacionMedicos.php';
                    break;
                }

            case 'buscarMedico': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->AbuscarMedico($parametros['p2'], $parametros['p3'], $parametros['p4'], $parametros['p5'], $parametros['p6'], $parametros['p7'], $parametros['p8']);
                    break;
                }
            case 'abrirPopapAsignacionDeTurnosAsignados': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["iIdTipoProgramacion"] = $parametros["p2"];
                    $datos["iidPuestoEmpleado"] = $parametros["p3"];
                    $datos["vNombreCompleto"] = $parametros["p4"];
                    $datos["vFecha"] = $parametros["p5"];
                    $datos["codigoPersona"] = $parametros["p6"];

                    $resultado = $o_ActionRrhh->abrirPopapAsignacionDeTurnosAsignados($datos);
                    break;
                }

            case 'descripcionCboSedeArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["cboSucursal"] = $parametros["p2"];
                    $datos["codigoPersona"] = $parametros["p3"];
                    $datos["iidPuestoEmpleado"] = $parametros["p4"];
                    $resultado = $o_ActionRrhh->AdescripcionCboSedeArea($datos);
                    break;
                }
            case 'cboSedeAreasTurnos': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["iIdSedeEmpresaArea"] = $parametros["p2"];
                    $resultado = $o_ActionRrhh->ASedeAreasTurnos($datos);
                    break;
                }
            case 'guardarNuevaProgramacionReemplanzo': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["iIdSedeEmpresaArea"] = $parametros["p2"];
                    $datos["iIdTurnosAreaSede"] = $parametros["p3"];
                    $datos["idPuestoEmpleado"] = $parametros["p4"];
                    $datos["fechaProgramada"] = $parametros["p5"];
                    $datos["iIdTipoProgramacion"] = $parametros["p6"];
                    $datos["idMotivoReProgramacion"] = $parametros["p7"];
                    $datos["txtAreaVDescripcionMotivo"] = $parametros["p8"];

                    $resultado = $o_ActionRrhh->AguardarNuevaProgramacionReemplanzo($datos);
                    break;
                }

            /*             * *******************Busqueda de Medicos*********************** */
            /*             * ************************************************************* */

            case 'RegularizarMarcacionMedicos': {
                    require_once '../../cvista/rrhh/RegularizarMarcacionMedicos.php';
                    break;
                }
            case 'buscarMedico': {
                    require_once("ActionRrhh.php");
                    header("Content-type: text/xml");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->AbuscarMedico($parametros['p2'], $parametros['p3'], $parametros['p4'], $parametros['p5'], $parametros['p6'], $parametros['p7'], $parametros['p8']);
                    break;
                }
            /* Modulo de citas EMERGENCIA */
            case 'listarCronogramaMedicoEmergencia': {
                    require_once("ActionCita.php");
                    header("Content-type: text/xml");
                    $datos['iCodigoCronograma'] = $parametros["p2"];
                    $o_ActionCita = new ActionCita();
                    $resultado = $o_ActionCita->aListarCronogramaMedicoEmergencia($datos);
                    break;
                }


            case 'buscarMedicosCentroCostosHorarios': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["iCodigoCentroCosto"] = $parametros["p2"];
                    $resultado = $o_ActionRrhh->AbuscarMedicosCentroCostosHorarios($datos);
                    break;
                }

            case 'agregarPersonalTurnoRegularizar': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["idCodigoPersona"] = $parametros["p2"];
                    $datos["nombreCompleto"] = $parametros["p3"];
                    $resultado = $o_ActionRrhh->AgregarPersonalTurnoRegularizar($datos);
                    break;
                }
            case 'cboSedeAreaNuevo': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["cboSucursal"] = $parametros["p2"];
                    $datos["codigoPersona"] = $parametros["p3"];
                    $datos["iidPuestoEmpleado"] = $parametros["p4"];
                    $datos["fecha"] = $parametros["p5"];

                    $resultado = $o_ActionRrhh->AcboSedeAreaNuevo($datos);
                    break;
                }

            case 'CargaPuestoEmpleadoArea': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["iIdSedeEmpresaArea"] = $parametros["p2"];
                    $datos["CodigoPersona"] = $parametros["p3"];
                    $resultado = $o_ActionRrhh->AcargaPuestoEmpleadoArea($datos);
                    break;
                }

            case 'cboTipoProgramacion': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["idPuestoEmpleadoArea"] = $parametros["p2"];
                    $datos["CodigoPersona"] = $parametros["p3"];
                    $resultado = $o_ActionRrhh->AcboTipoProgramacion($datos);
                    break;
                }

            case 'buscarAreasRegularizar': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->aBuscarAreasRegularizar();
                    break;
                }
            case 'actualizarLaSede': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["cSede"] = $parametros["p2"];
                    $resultado = $o_ActionRrhh->actualizarLaSede($datos);
                    break;
                }

            case 'actualizarSedeAreaNuevo': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["cboSucursal"] = $parametros["p2"];
                    $datos["codigoPersona"] = $parametros["p3"];
                    $datos["IdArea"] = $parametros["p4"];
                    $datos["iidPuestoEmpleado"] = $parametros["p5"];
                    $resultado = $o_ActionRrhh->actualizarSedeAreaNuevo($datos);
                    break;
                }

            case 'mantenimientoTurnoCordiNuevo': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["sede"] = $parametros["p2"];
                    $datos["area"] = $parametros["p3"];
                    $datos["cordinador"] = $parametros["p4"];
                    $datos["idSedeempresaArea"] = $parametros["p5"];
                    $resultado = $o_ActionRrhh->AmantenimientoTurnoCordiNuevo($datos);
                    break;
                }
            case 'guardarPersonalTurnoRegularizar': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["iIdSedeEmpresaArea"] = $parametros["p2"];
                    $datos["iIdTurnosAreaSede"] = $parametros["p3"];
                    $datos["CodigoPersona"] = $parametros["p4"];
                    $datos["iidPuestoEmpelado"] = $parametros["p5"];
                    $datos["dFecha"] = $parametros["p6"];
                    $datos["idTipoProgramacion"] = $parametros["p7"];
                    $datos["idMotivoReProgramacion"] = $parametros["p8"];
                    $datos["txtAreaVDescripcionMotivo"] = $parametros["p9"];
                    $resultado = $o_ActionRrhh->AguardarPersonalTurnoRegularizar($datos);
                    break;
                }

            case 'buscarAreasRegularizarPersona': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $resultado = $o_ActionRrhh->aBuscarAreasRegularizarPersona();
                    break;
                }
            case 'actualizarLaSedeEmpleado': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["cSede"] = $parametros["p2"];
                    $resultado = $o_ActionRrhh->actualizarLaSedeEmpleado($datos);
                    break;
                }
            case 'actualizarSedeAreaNuevo1': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["cboSucursal"] = $parametros["p2"];
                    $datos["codigoPersona"] = $parametros["p3"];
                    $datos["IdArea"] = $parametros["p4"];
                    $datos["iidPuestoEmpleado"] = $parametros["p5"];
                    $resultado = $o_ActionRrhh->actualizarSedeAreaNuevo1($datos);
                    break;
                }

            case 'cboSedeAreasTurnos1': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["iIdSedeEmpresaArea"] = $parametros["p2"];
                    $resultado = $o_ActionRrhh->ASedeAreasTurnos1($datos);
                    break;
                }

            case 'mantenimientoTurnoCordiPersona': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["sede"] = $parametros["p2"];
                    $datos["area"] = $parametros["p3"];
                    $datos["cordinador"] = $parametros["p4"];
                    $datos["idSedeempresaArea"] = $parametros["p5"];
                    $resultado = $o_ActionRrhh->AmantenimientoTurnoCordiPersona($datos);
                    break;
                }

            case 'reporteAsistenciaMedico': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["codPer"] = $parametros["p2"];
                    $datos["iidPuesto"] = $parametros["p3"];
                    $datos["iidCentroCosto"] = $parametros["p4"];
                    $datos["fechaIni"] = $parametros["p5"];
                    $datos["fechaFinal"] = $parametros["p6"];
                    $resultado = $o_ActionRrhh->AreporteAsistenciaMedico($datos);
                    break;
                }

            case 'cargarPuestoEmpleado': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["idCodigoPersona"] = $parametros["p2"];
                    $datos["nombreCompleto"] = $parametros["p3"];
                    $datos["dFecha"] = $parametros["p4"];
                    $resultado = $o_ActionRrhh->AcargarPuestoEmpleado($datos);
                    break;
                }

            case 'funcionPuestoEmpleadoBoton': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos["idCodigoPersona"] = $parametros["p2"];
                    $datos["nombreCompleto"] = $parametros["p3"];
                    $datos["dFecha"] = $parametros["p4"];
                    $resultado = $o_ActionRrhh->AfuncionPuestoEmpleadoBoton($datos);
                    break;
                }
            case 'ventanaUbicacionImagenes': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["iCodigoProgramacion"] = $parametros["p2"];
                    $resultado = $o_ActionCita->aVentanaUbicacionImagenes($datos);
                    break;
                }
            case 'mantenimientoNumeroPlaca': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["iCodigoProgramacion"] = $parametros["p2"];
                    $datos["numeroPlaca"] = $parametros["p3"];
                    $datos["observacion"] = $parametros["p4"];
                    $resultado = $o_ActionCita->aMantenimientoNumeroPlaca($datos);
                    break;
                }
            case 'grabarUbicacionImagenes': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["iCodigoProgramacion"] = $parametros["p2"];
                    $datos["ubicacion"] = $parametros["p3"];
                    $datos["observacion"] = $parametros["p4"];
                    $resultado = $o_ActionCita->aGrabarUbicacionImagenes($datos);
                    break;
                }
            case 'grabarUbicacionPlacas': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["iCodigoProgramacion"] = $parametros["p2"];
                    $datos["ubicacion"] = $parametros["p3"];
                    $datos["observacion"] = $parametros["p4"];
                    $resultado = $o_ActionCita->grabarUbicacionPlacas($datos);
                    break;
                }
            case 'seleccionarUbicaciones': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $resultado = $o_ActionCita->seleccionarUbicaciones();
                    break;
                }
            case 'cargarGraficoHistoriaTriaje': {
                    require_once("ActionActoMedico.php");
                    $o_ActionActoMedico = new ActionActoMedico();
                    $datos["iCodigoPaciente"] = $parametros["p2"];
                    $datos["iNumeroObcion"] = $parametros["p3"];
                    $datos["vTitulo"] = $parametros["p4"];

                    $datos["cbxDesde"] = $parametros["p5"];
                    $datos["cbxHasta"] = $parametros["p6"];
                    $resultado = $o_ActionActoMedico->aCargarGraficoHistoriaTriaje($datos);
                    break;
                }
            case 'listarTablaLeyendaReporteTriaje': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $datos['iNumeroObcion'] = $parametros["p2"];
                    $datos['iCodigoPaciente'] = $parametros["p3"];
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->aListarTablaLeyendaReporteTriaje($datos);
                    break;
                }

            case 'generarSintomaticoRespiratorio': {
                    require_once("ActionActoMedico.php");
                    header("Content-type: text/xml");
                    $datos['iSintomatico'] = $parametros["p2"];
                    $datos['iNumeroDias'] = $parametros["p3"];
                    $datos['codigoProgramacion'] = $parametros["p4"];
                    $o_ActionActoMedico = new ActionActoMedico();
                    $resultado = $o_ActionActoMedico->aGenerarSintomaticoRespiratorio($datos);
                    break;
                }
            case 'ventanaEditarCita': {
                    require_once("ActionCita.php");
                    $datos['codigoProgramacion'] = $parametros["p2"];
                    $datos['actividad'] = $parametros["p3"];
                    $o_ActionCita = new ActionCita();
                    $resultado = $o_ActionCita->aVentanaEditarCita($datos);
                    break;
                }
            case 'cargarMedicosEditarCita': {
                    header("Content-type: text/xml");
                    require_once("ActionCita.php");
                    $datos['codigoProgramacion'] = $parametros["p2"];
                    $datos['fecha'] = $parametros["p3"];
                    $datos['c_cod_ser_pro'] = $parametros["p4"];
                    $o_ActionCita = new ActionCita();
                    $resultado = $o_ActionCita->aCargarMedicosEditarCita($datos);
                    break;
                }
            case 'generarComoTurnos': {

                    require_once("ActionCita.php");
                    $datos['iCodigoCronograma'] = $parametros["p2"];

                    $o_ActionCita = new ActionCita();
                    $resultado = $o_ActionCita->aGenerarComoTurnos($datos);
                    break;
                }

            case 'validarQueNoExitaProgramacion': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["idContrato"] = $parametros["p2"];
                    $datos["fechaInicioVacacion"] = $parametros["p3"];
                    $datos["fechaFinVacacion"] = $parametros["p4"];
                    $resultado = $o_ActionRrhh->AvalidarQueNoExitaProgramacion($datos);
                    break;
                }

            case 'tablaCrucedeHorarioParaTipoDescanso': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["idContrato"] = $parametros["p2"];
                    $datos["fechaInicioVacacion"] = $parametros["p3"];
                    $datos["fechaFinVacacion"] = $parametros["p4"];
                    $resultado = $o_ActionRrhh->AtablaCrucedeHorarioParaTipoDescanso($datos);
                    break;
                }
            case 'eliminarProgramacion': {
                    require_once("ActionRrhh.php");
                    $o_ActionRrhh = new ActionRrhh();
                    $datos = array();
                    $datos["iIdProgramacionEmpleados"] = $parametros["p2"];
                    $resultado = $o_ActionRrhh->AeliminarProgramacion($datos);
                    break;
                }


            case 'grabarEditarCita': {

                    require_once("ActionCita.php");
                    $datos['cronogramaOrigen'] = $parametros["p2"];
                    $datos['horaOrigen'] = $parametros["p3"];
                    $datos['cronogramaDestino'] = $parametros["p4"];
                    $datos['horaDestino'] = $parametros["p5"];
                    $datos['codigoProgramacion'] = $parametros["p6"];

                    $o_ActionCita = new ActionCita();
                    $resultado = $o_ActionCita->aGrabarEditarCita($datos);
                    break;
                }


            case 'seleccionarTurnoProgramacionMedico': {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["codigocronograma"] = $parametros["p2"];
                    $rs1 = $o_ActionCronograma->seleccionarTurnoProgramacionMedico($datos);
                    require_once '../../cvista/programacion/seleccionarTurnoProgramacionMedico.php';
                    break;
                }



            case 'seleccionarHoraFinal': {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["horainicio"] = $parametros["p2"];
                    $resultado = $o_ActionCronograma->seleccionarHoraFinal($datos);
                    break;
                }

            case 'actualizarTurnoProgramacionMedico': {
                    require_once("ActionCronograma.php");
                    $o_ActionCronograma = new ActionCronograma();
                    $datos = array();
                    $datos["codCro"] = $parametros["p2"];
                    $datos["codTur"] = $parametros["p3"];
                    $datos["motivo"] = $parametros["p4"];
                    $resultado = $o_ActionCronograma->actualizarTurnoProgramacionMedico($datos);
                    break;
                }


            case('getTarifasProcedimientosProductos'): {
                    header("Content-type: text/xml");
                    require_once("ActionLogistica.php");
                    $o_ActionLogistica = new ActionLogistica();
                    $datos['afiliacionActiva'] = $parametros["p2"];
                    $datos['nombreProcedimiento'] = $parametros["p3"];
                    $resultado = $o_ActionLogistica->getTarifasProcedimientosProductos($datos);
                    break;
                }



            case('agregarProcedimientoNuevoInicio'): {
                    header("Content-type: text/xml");
                    require_once("ActionLogistica.php");
                    $o_ActionLogistica = new ActionLogistica();
                    $resultado = $o_ActionLogistica->agregarProcedimientoNuevoInicio();
                    break;
                }

            case 'consultaProgramacionMedicosJorgeNuevo' : {
                    require_once("ActionCronograma.php");
                    $oActionCronograma = new ActionCronograma();
                    $datos['nombrepersona'] = $parametros["p2"];
                    $datos['codigocronograma'] = $parametros["p3"];
                    $resultado = $oActionCronograma->consultaProgramacionMedicosJorgeNuevo($datos);
                    break;
                }

            case 'cargarComboAmbienteFisicoReprogramacionMedicoNuevo' : {
                    require_once("ActionCronograma.php");
                    $oActionCronograma = new ActionCronograma();
                    $datos['idAmbienteslogicos'] = $parametros["p2"];
                    $datos['cidSedeEmpresa'] = $parametros["p3"];
//                    $datos['opcionBusqueda'] = $parametros["p4"];
//                    $datos['codigoPersonalSalud'] = $parametros["p5"];
//                    $datos['codigoservicio'] = $parametros["p6"];
                    $resultado = $oActionCronograma->cargarComboAmbienteFisicoReprogramacionMedicoNuevo($datos);
                    break;
                }

            case 'vistaReportePaquetePersona': {
                    require_once '../../cvista/reporte/vistaReportePaquetePersona.php';
                    break;
                }

            case 'getBuscarPersonasReporte': {
                    header("Content-type: text/xml");
                    require_once("ActionReporte.php");
                    $o_ActionReporte = new ActionReporte();
                    $resultado = $o_ActionReporte->getBuscarPersonasReporte(base64_decode($parametros["p2"]), $parametros["p3"], $parametros["p4"], $parametros["p5"], $parametros["p6"]);
                    break;
                }
            case 'pupapAsignacionMedico': {
                    header("Content-type: text/xml");
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["hCadenaCodigoProgramacionNombre"] = $parametros["p2"];
                    $datos["hCadenaCodigoProgramacion"] = $parametros["p3"];
                    $resultado = $o_ActionCita->ApupapAsignacionMedico($datos);
                    break;
                }

            case 'crearTablaAsignacionMedicoPacientes': {
                    header("Content-type: text/xml");
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["hCadenaCodigoProgramacion"] = $parametros["p2"];
                    $datos["hCadenaCodigoProgramacionNombre"] = $parametros["p3"];
                    //print_r($datos);
                    $resultado = $o_ActionCita->AcrearTablaAsignacionMedicoPacientes($datos);
                    break;
                }

            case 'tablacargarMedicosAsignados': {
                    header("Content-type: text/xml");
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["opcionSede"] = $parametros["p2"];
                    $datos["c_cod_pro"] = $parametros["p3"];
                    $datos["fecha"] = $parametros["p4"];
                    $resultado = $o_ActionCita->AtablacargarMedicosAsignados($datos);
                    break;
                }

            case 'guardarASignacionMedico': {
                    header("Content-type: text/xml");
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos = array();
                    $datos["iCodigoCronogramaMedicoSeleccionado"] = $parametros["p2"];
                    $datos["cadenaCodigoPacienteProgramado"] = $parametros["p3"];
//                    $datos["fecha"] = $parametros["p4"];
                    $resultado = $o_ActionCita->AguardarASignacionMedico($datos);
                    break;
                }
            case 'abrirPupudHistoriaCronograma': {
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos["iCodigoCronograma"] = $parametros["p2"];
                    $data = $o_ActionCita->aCargarDatosLeyenda($datos);
                    require_once '../../cvista/cita/abrirPupudHistoriaCronograma.php';
                    break;
                }
            case 'listarHistoriaCronogramaPaciente': {
                    header("Content-type: text/xml");
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos["iCodigoCronograma"] = $parametros["p2"];
                    $resultado = $o_ActionCita->aListarHistoriaCronogramaPaciente($datos);
                    break;
                }

            case 'validaServicionConProcedimiento': {
                    header("Content-type: text/xml");
                    require_once("ActionCita.php");
                    $o_ActionCita = new ActionCita();
                    $datos["codigoservicio"] = $parametros["p2"];
                    $resultado = $o_ActionCita->AvalidaServicionConProcedimiento($datos);
                    break;
                }

            case 'reporteCaja': {
                    require_once("ActionCaja.php");
                    $o_ActionCaja = new ActionCaja();
                    $resultado = $o_ActionCaja->aReporteCaja();
                    break;
                }


            case 'cargarReporteCaja': {
                    require_once("ActionCaja.php");
                    header("Content-type: text/xml");
                    $o_ActionCaja = new ActionCaja();
                    $resultado = $o_ActionCaja->aCargarReporteCaja($parametros);
                    break;
                 
                }
              case 'exportarReporteCaja': {
                    require_once("ActionCaja.php");
                   
                    $o_ActionCaja = new ActionCaja();
                    $resultado = $o_ActionCaja->aExportarReporteCaja($parametros);
                    break;
                 
                }  
                
                

            /*             * ************************************************************* */
            /*             * ************************************************************* */


//**************************************************************************************
        }
    } else {
        if ($action != 'ingresarSistema') {
            session_unset();
            session_destroy();
            $mensaje = '';
            $resultado = '';
            if ($estado == 0) {
                $mensaje = 'Su sesión no fue iniciada';
            }
            if ($estado == '2') {
                $mensaje = 'Su sesión ya fue cerrada';
            }
            if ($estado == '3') {
                $mensaje = 'Su sesión ha expirado';
            }
            if ($estado == '4') {
                if ($otroIp != '0') {
                    $mensaje = 'Se ha iniciado otra sesión en ' . $otroIp;
                } else {
                    $mensaje = 'Inicio su session en otro equipo';
                }
            }
            if ($estado == '5') {
                $mensaje = 'Se cancelo su sesión por mantenimiento del sistema';
            }
            $mensaje = $mensaje;
            $resultado.="<script type='text/javascript'> ";
            $resultado.="alert('" . $mensaje . "'); ";
            $resultado.="caduca_sesion()";
            $resultado.="</script>";
        }
    }
    echo $resultado;
} else {
    echo "Falla en el servidor .....Comunicarse con Informatica...<br/><br/>";

    echo 'max_execution_time = ' . ini_get('max_execution_time') . "<br/>";
    echo 'max_input_time = ' . ini_get('max_input_time') . "<br/>";
    echo 'memory_limit = ' . ini_get('memory_limit') . "<br/>";
}
?>


