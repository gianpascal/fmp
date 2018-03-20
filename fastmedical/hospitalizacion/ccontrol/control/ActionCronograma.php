<?php

require_once("../../../pholivo/Html.php");
require_once("../../../pholivo/Html1.php");
require_once("../../clogica/LCronograma.php");
require_once("../../../pholivo/tablaDHTMLX.php");

class ActionCronograma {

    private $oLCronograma;

    public function __construct() {
        $this->oLCronograma = new LCronograma();
    }

    function guardarAfiliacionesXMedico($datos) {
        $o_LCronograma = new LCronograma();
        $resultado = $o_LCronograma->guardarAfiliacionesXMedico($datos);
    }

    function EliminarAfiliacionesXMedico($datos) {
        $o_LCronograma = new LCronograma();
        $resultado = $o_LCronograma->EliminarAfiliacionesXMedico($datos);
        return $resultado;
    }

    function muestraDatosCronogramaCita($iid_cronograma) {
        $o_LCronograma = new LCronograma();
        $resultadoDatosCronograma = $o_LCronograma->getDatosCronogramaMedico('1', $iid_cronograma);
        $codigo_cronograma = $iid_cronograma;
        $codigo_centro_costos = $resultadoDatosCronograma[0]['c_cod_ccos'];
        $codigo_ambiente = $resultadoDatosCronograma[0]['c_cod_amb'];
        $ambiente = $resultadoDatosCronograma[0]['v_desc_amb'];
        $codigo_persona_responsable = $resultadoDatosCronograma[0]['c_cod_per'];
        $medico = $resultadoDatosCronograma[0]['nombremedico'];
        $especialidad = $resultadoDatosCronograma[0]['medicoespecialidad'];
        $codigo_profesional_empleado = $resultadoDatosCronograma[0]['c_cod_prof_emp'];
        $codigo_especialidad_profesion = $resultadoDatosCronograma[0]['c_cod_esp_prof'];
        $codigo_turno = $resultadoDatosCronograma[0]['c_cod_tur'];
        $turno = $resultadoDatosCronograma[0]['descripcionturno'];
        $producto_servicios = $resultadoDatosCronograma[0]['v_desc_ser_pro'];
        $codigo_formato = $resultadoDatosCronograma[0]['c_cod_for'];
        $codigo_clas_formato = $resultadoDatosCronograma[0]['c_cod_clas_for'];
        $citas = $resultadoDatosCronograma[0]['citas'];
        $reservas = $resultadoDatosCronograma[0]['reservas'];
        $cupos = $resultadoDatosCronograma[0]['cupos'];
        $codigoproductoservicio = $resultadoDatosCronograma[0]['c_cod_ser_pro'];
        $scriptJS = "pintarDatosCronogramaCitas('" . $codigo_cronograma . "','" . $codigo_centro_costos . "','" . $codigo_ambiente . "','" . $ambiente . "','" . $codigo_persona_responsable . "','" . $medico . "','" . $especialidad . "','" . $codigo_profesional_empleado . "','" . $codigo_turno . "','" . $turno . "','" . $producto_servicios . "','" . $codigo_formato . "','" . $codigo_clas_formato . "','" . $citas . "','" . $reservas . "','" . $cupos . "','" . $codigoproductoservicio . "');";

        return $scriptJS;
    }

    function muestraDatosEditarCita($n_nro_prog, $c_cod_per, $n_prog_pac) {
        $o_LCronograma = new LCronograma();
        $o_LCita = new LCita();
        $o_LPersona = new LPersona();

        $resultadoDatosCronograma = $o_LCronograma->getDatosCronogramaMedico('1', $n_nro_prog);
        $resultadoDatosPaciente = $o_LCita->getObjectPacienteCita($c_cod_per);
        $resultadoAfiliacionPaciente = $o_LPersona->getArrayFiliacionPaciente($c_cod_per);
        $resultadoDatosCita = $o_LCita->getDatosCita($n_prog_pac);

        $citas = $resultadoDatosCronograma[0]['citas'];
        $reservas = $resultadoDatosCronograma[0]['reservas'];
        $cupos = $resultadoDatosCronograma[0]['cupos'];

        $codigo_cronograma = $resultadoDatosCronograma[0]['n_nro_prog'];
        $producto_servicios = $resultadoDatosCronograma[0]['v_desc_ser_pro'];
        $ambiente = $resultadoDatosCronograma[0]['v_desc_amb'];
        $medico = $resultadoDatosCronograma[0]['nombremedico'];
        $especialidad = $resultadoDatosCronograma[0]['medicoespecialidad'];
        $turno = $resultadoDatosCronograma[0]['descripcionturno'];

        $codigo_paciente = $resultadoDatosPaciente[0]["c_cod_per"];
        $filiacion_activa = $resultadoAfiliacionPaciente[0]["filia"];
        $nombres_paciente = $resultadoDatosPaciente[0]["v_nomper"];
        $apepat_paciente = $resultadoDatosPaciente[0]["v_apepat"];
        $apemat_paciente = $resultadoDatosPaciente[0]["v_apemat"];
        $documento_paciente = $resultadoDatosPaciente[0]["c_ndide"];
        $fecnac_paciente = date("d/m/Y", strtotime($resultadoDatosPaciente[0]["d_fecnac"]));

        $codigo_cita = $resultadoDatosCita[0]["n_prog_pac"];
        $fecha_cita = date("d/m/Y", strtotime($resultadoDatosCita[0]["d_fechorserv"]));
        $tipo_cita = $resultadoDatosCita[0]["tipo_cita"];
        $desc_cita = $resultadoDatosCita[0]["t_des_cita"];
        $turno_cita = $resultadoDatosCita[0]["c_cod_hora"];

        $scriptJS = "pintarDatosEditarCitas('" . $citas . "',
                                            '" . $reservas . "',
                                            '" . $cupos . "',

                                            '" . $codigo_cronograma . "',
                                            '" . $producto_servicios . "',
                                            '" . $ambiente . "',
                                            '" . $medico . "',
                                            '" . $especialidad . "',
                                            '" . $turno . "',

                                            '" . $codigo_paciente . "',
                                            '" . $filiacion_activa . "',
                                            '" . $nombres_paciente . "',
                                            '" . $apepat_paciente . "',
                                            '" . $apemat_paciente . "',
                                            '" . $documento_paciente . "',
                                            '" . $fecnac_paciente . "',

                                            '" . $codigo_cita . "',
                                            '" . $fecha_cita . "',
                                            '" . $tipo_cita . "',
                                            '" . $desc_cita . "',
                                            '" . $turno_cita . "');";
        return $scriptJS;
    }

    public function muestraHoraServidor() {
        $o_LCita = new LCita();
        $fechora_servidor = $o_LCita->getFechHoraServidor();
        $horas = date("h", strtotime($fechora_servidor[0]["d_fechora"]));
        $minutos = date("i", strtotime($fechora_servidor[0]["d_fechora"]));
        $meridiano = date("A", strtotime($fechora_servidor[0]["d_fechora"]));
        $scriptJS = "pintarFechoraServidor('" . $horas . "','" . $minutos . "','" . $meridiano . "');";
        return $scriptJS;
    }

    public function listaProfesional($usuario) {
        $oLCronograma = new LCronograma();
        $arrayFilas = $oLCronograma->getListaProfesional($usuario);
        $arrayCabecera = array("1" => "NOMBRE", "2" => "APE. PAT.", "3" => "APE. MAT.");
        $o_Tabla = new Tabla($arrayCabecera, $arrayFilas, 'col1', 'col2', 'filaEncimaNaranja', 'titleb', 'parametro', 'myajax.Link');
        $tablaHTML = $o_Tabla->getTabla();
        $row_ini = "<table width='100%' border='0' cellpadding='0' cellspacing='1px' class='grid'>		  ";
        $row_fin = "</table>";
        return $row_ini . $tablaHTML . $row_fin;
    }

    public function listaProfesionalTotal($oficina) {
        $oLCronograma = new LCronograma();
        $arrayFilas = $oLCronograma->getListaProfesionalTotal($oficina);
        $arrayCabecera = array("0" => "CODIGO", "1" => "NOMBRE", "2" => "APE. PAT.", "3" => "APE. MAT.", "4" => "PROFESION", "7" => "ESPECIALIDAD", "5" => "TELEFONO", "6" => "CELULAR");
        $o_Tabla = new Tabla($arrayCabecera, $arrayFilas, 'col1', 'col2', 'filaEncimaNaranja', 'titleb', 'parametro', 'myajax.Link');
        $tablaHTML = $o_Tabla->getTabla();
        $row_ini = "<table width='100%' border='0' cellpadding='0' cellspacing='1px' class='grid'> ";
        $row_fin = "</table>";
        //$tablaHTML="<tr><td>".print_r($arrayCabecera)."</td></tr>";
        return $row_ini . $tablaHTML . $row_fin;
    }

    public function listaProfesionalTotalCabecera() {
        $oLCronograma = new LCronograma();
        $arrayFilas = $oLCronograma->getListaProfesionalTotal();
        $arrayCabecera = array("0" => "CODIGO", "1" => "NOMBRE", "2" => "APE. PAT.", "3" => "APE. MAT.", "4" => "PROFESION", "5" => "ESPECIALIDAD", "6" => "TELEFONO", "6" => "CELULAR");
        return $oLCronograma->getCabeceraHTML($arrayCabecera);
    }

    public function listaProfesionalCargo($persona) {
        $oLCronograma = new LCronograma();
        $record = $oLCronograma->getListaProfesionalCargo($persona);
        return $record;
    }

    public function seleccionListaMes($mes_actual) {
        $oLHospitalizacion = new LHospitalizacion();
        $arrayCombo = $oLHospitalizacion->getSeleccionaListaMes();
        $oCombo = new Combo($arrayCombo);
        $comboHTML = $oCombo->getOptionsHTML($mes_actual);
        return $oCombo->getSelecccionHTML($comboHTML, 'meses', '', 'onchange', "listaCronogramaPrincipal()");
    }

    public function listaCronogramaOficina($persona) {
        $oLCronograma = new LCronograma();
        $arrayFilas = $oLCronograma->getListaCronogramaOficina($persona);
        $arrayCabecera = array("2" => "VER", "3" => "SEL", "1" => "OFICINA");
        $oTabla = new Tabla($arrayCabecera, $arrayFilas, 'col1', 'col2', 'filaEncimaNaranja', 'titleb', '', '');
        $tablaHTML = $oTabla->getTabla();
        $row_ini = "<table width='100%' border='0' cellpadding='0' cellspacing='1px' class='grid'>";
        $row_fin = "</table>";
        return $row_ini . $tablaHTML . $row_fin;
    }

    public function listaCronogramaPrincipal($mes_actual, $ano_actual, $persona, $oficina) {
        $oLCronograma = new LCronograma();
        $arrayFilas = $oLCronograma->getListaCronogramaPrincipal($mes_actual, $ano_actual, $persona, $oficina);
        $arrayCabecera = array("0" => "DIA", "1" => "FECHA", "2" => "ACTIVIDAD", "3" => "PRODUCTO/SERVICIO", "4" => "AMBIENTE", "turno" => "TURNO", "cupos" => "CUPOS", "opcion" => "OPCION");
        $oTabla = new Tabla($arrayCabecera, $arrayFilas, 'col1', 'col2', 'filaEncimaNaranja', 'titleb', 'parametro', 'myajax.Link');
        $tablaHTML = $oTabla->getTabla();
        $row_ini = "<table width='100%' border='0' cellpadding='0' cellspacing='1px' class='grid'>";
        $row_fin = "</table>";
        return $row_ini . $tablaHTML . $row_fin;
    }

    public function listaCronogramaporPersonalSalud($parametros) {
        $oLCronograma = new LCronograma();
        $arrayFilas = $oLCronograma->getListaCronogramaporPersonalSalud($parametros);
        $arrayCabecera = array("0" => "DIA", "1" => "FECHA", "2" => "ACTIVIDAD", "3" => "PRODUCTO/SERVICIO", "4" => "AMBIENTE", "turno" => "TURNO", "cupos" => "CUPOS", "opcion" => "OPCION");
        $oTabla = new Tabla($arrayCabecera, $arrayFilas, 'col1', 'col2', 'filaEncimaNaranja', 'titleb', 'parametro', 'myajax.Link');
        $tablaHTML = $oTabla->getTabla();
        $row_ini = "<table width='100%' border='0' cellpadding='0' cellspacing='1px' class='grid'>";
        $row_fin = "</table>";
        return $row_ini . $tablaHTML . $row_fin;
    }

    function listaPersonalSalud($opcion, $patron1, $patron2, $patron3, $funcionJavaScript = '') {
        $o_Lcronograma = new LCronograma();
        $arrayFilas = $o_Lcronograma->getListaProfesionalSalud($opcion, $patron1, $patron2, $patron3);
        $arrayCabecera = array("nombremedico" => "NOMBRES", "especialidad" => "ESPECIALIDAD");
        $o_Tabla = new Tabla1($arrayCabecera, 15, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', 'onClickFilaMedicos', 0);
        //$o_Tabla = new Tabla($arrayCabecera,$arrayFilas,'fila1','fila2','filaEncima','filaCabecera',0,$funcionJavaScript);
        $tablaHTML = $o_Tabla->getTabla();
        return $tablaHTML;
    }

    public function seleccionListaAno($ano_actual) {
        $oLHospitalizacion = new LHospitalizacion();
        $ano_actual = $ano_actual == '' ? date('Y') : intval($ano_actual);
        $arrayCombo = $oLHospitalizacion->getSeleccionaListaAno($ano_actual);
        $oCombo = new Combo($arrayCombo);
        $comboHTML = $oCombo->getOptionsHTML($ano_actual);
        return $oCombo->getSelecccionHTML($comboHTML, 'anos', '', 'onchange', "listaCronogramaPrincipal()");
    }

    public function seleccionListaOficinaHospital($oficina) {
        $oLCronograma = new LCronograma();
        $arrayCombo = $oLCronograma->getSeleccionOficinaHospital();
        $oCombo = new Combo($arrayCombo);
        $comboHTML = $oCombo->getOptionsHTML($oficina);
        return $oCombo->getSelecccionHTML($comboHTML, 'cmb_oficina', 'combo_ancho', 'onchange', "listaComboOficina()");
    }

    public function seleccionListaActividad($actividad) {
        $oLCronograma = new LCronograma();
        $arrayCombo = $oLCronograma->getSeleccionActividad();
        $oCombo = new Combo($arrayCombo);
        $comboHTML = $oCombo->getOptionsHTML($actividad);
        return $oCombo->getSelecccionHTML($comboHTML, 'cmb_actividad', 'combo_ancho', 'onchange', "listaComboActividad()");
    }

    public function seleccionListaProducto($oficina, $producto, $actividad) {
        $oLCronograma = new LCronograma();
        $oficina = $oficina == '' ? '%' : $oficina;
        $producto = $producto == '' ? '%' : $producto;
        $actividad = $actividad == '' ? '%' : $actividad;
        $arrayCombo = $oLCronograma->getSeleccionProducto($oficina, $producto, $actividad);
        $oCombo = new Combo($arrayCombo);
        $comboHTML = $oCombo->getOptionsHTML($producto);
        return $oCombo->getSelecccionHTML($comboHTML, 'cmb_producto', 'combo_ancho', 'onchange', "listaComboProducto()");
    }

    public function SeleccionAmbiente($oficina, $actividad, $ambiente) {
        $oLCronograma = new LCronograma();
        $oficina = $oficina == '' ? '%' : $oficina;
        $actividad = $actividad == '' ? '%' : $actividad;
        $arrayCombo = $oLCronograma->getSeleccionAmbiente($oficina, $actividad);
        $oCombo = new Combo($arrayCombo);
        $comboHTML = $oCombo->getOptionsHTML($ambiente);
        return $oCombo->getSelecccionHTML($comboHTML, 'cmb_ambiente', 'combo_ancho', 'onchange', "");
    }

    public function SeleccionTurno($turno) {
        $oLCronograma = new LCronograma();
        $arrayCombo = $oLCronograma->getSeleccionTurno();
        $oCombo = new Combo($arrayCombo);
        $comboHTML = $oCombo->getOptionsHTML($turno);
        return $oCombo->getSelecccionHTML($comboHTML, 'cmb_turno', 'combo_ancho', 'onchange', "");
    }

    public function generaCalendario($cal_dia, $cal_mes, $cal_ano, $accion, $marcar_dias, $bloqueo_dias) {
        $oCalendario = new Calendar($cal_dia, $cal_mes, $cal_ano, $accion, $marcar_dias, $bloqueo_dias);
        return $oCalendario->enviarCalendarioHTML();
    }

    public function consultaValidaCronograma($persona, $oficina, $actividad, $ambiente, $producto, $turno, $fecha) {
        require_once("../../clogica/LCronograma.php");
        $oLCronograma = new LCronograma();
        return $oLCronograma->getValidaCronograma($persona, $oficina, $actividad, $ambiente, $producto, $turno, $fecha);
    }

    public function consultaMantenimientoCronograma($accion, $vid_cronograma_ant, $persona, $ambiente, $oficina, $turno, $fecha, $producto, $actividad, $cupos) {
        $oLCronograma = new LCronograma();
        return $oLCronograma->getMantenimientoCronograma($accion, $vid_cronograma_ant, $persona, $ambiente, $oficina, $turno, $fecha, $producto, $actividad, $cupos);
    }

    public function getArbolEspecialidad() {
        $oLCronograma = new LCronograma();
        return $oLCronograma->crearArbolCentroCostos();
    }

    /* CRONOGRAMACITASINFORMES */

    public function muestraCabeceraCronogramaCitasInformes($datos) {
        $oLCronograma = new LCronograma();
        $cantidadoptimafechas = $oLCronograma->obtenerCantidadOptimaFechas($datos);
        $datos['contadoroptimofechas'] = $cantidadoptimafechas;
        $cabecera = $oLCronograma->getListaCabeceraCronogramaInformes($datos);
        $subcabecera = $oLCronograma->getListaSubCabeceraCronogramaInformes($datos);
        $data = $oLCronograma->armarCronogramaCitasInformes($datos);
//        echo 'perritooo';
//        print_r($data);
//        echo 'perrooo';

        $tipocabecera = $oLCronograma->tipocabecera();
        $alineamiento = $oLCronograma->alineamiento();
        $idsColumnas = $oLCronograma->getColumnasIds();
        $anchocolumnas = $oLCronograma->anchocolumnas();
        $estadopagos = $oLCronograma->getCadenaEstadoPagos();

        $scriptJS = "setPintarCabeceraCronograma(" . $cabecera . "," . $subcabecera . "," . $data . "," . $tipocabecera . "," . $alineamiento . "," . $idsColumnas . "," . $anchocolumnas . "," . $estadopagos . ");";
        return $scriptJS;
    }

    public function buscarSiguienteFecha($datos) {
        $oLCronograma = new LCronograma();
        $cantidadoptimafechas = $oLCronograma->obtenerCantidadOptimaFechas($datos);
        $datos['contadoroptimofechas'] = 1;
        $subcabecera = $oLCronograma->getListaSubCabeceraCronogramaInformes($datos);
        //$retorno = $oLCronograma->buscarCupoDisponible($datos);
        $retorno = $oLCronograma->buscarCupoDisponibleNuevo($datos);
        //print_r($subcabecera);
        return $retorno;
    }

    public function buscarProximaCita($datos) {
        $oLCronograma = new LCronograma();
        $resultado = $oLCronograma->buscarProximaCita($datos);
        $count = count($resultado);
        if ($count != 0) {
            $cadena = "";
            for ($x = 0; $x <= $count - 1; $x++) {
                $cadena.=$resultado[$x][0] . "/";
            }
        }
        //print_r($cadena);
        return $cadena;
    }

    public function getdatosdecronograma($datos) {
        $oLCronograma = new LCronograma();
        $respuesta = $oLCronograma->getdatosdecronograma($datos);
        $scriptJS = "cargaCronogramaFecha('','','" . $respuesta[0]['parametro'] . "')";
        return $scriptJS;
    }

    public function atraerDatosCronogramaProgramado($datos) {
        $oLCronograma = new LCronograma();
        $respuesta = $oLCronograma->ltraerDatosCronogramaProgramado($datos);
        return $respuesta;
    }

    //    public function getArbolServiciosProgramados() {
//        $oLCronograma = new LCronograma();
//        return $oLCronograma -> crearArbolServiciosProgramados();
//    }
    public function listarServiciosCitas($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $o_LCronograma = new LCronograma();
        $arrayFilas = $o_LCronograma->listarServiciosCitas($datos);
        $arrayCabecera = array("1" => "C.Costos", "2" => "Servicio");
        $arrayTamano = array("1" => "60", "2" => "*");
        $arrayTipo = array("1" => "ro", "2" => "ro");
        $arrayAlineacion = array("1" => "center", "2" => "left");
        $arrayHidden = array("1" => "true", "2" => "false");
        $resultado = $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
        return $resultado;
    }

    /* PROGRAMACIONMEDICOS */

    //tabla
    public function listadoDatosMedicos($datos) {
        $oLCronograma = new LCronograma();
        $datos == '' ? $arrayFilas1 = array() : $arrayFilas1 = $oLCronograma->getListaProfesionalMedicos($datos);
        $arrayCabecera = array("1" => "CODIGO", "2" => "PERSONAL DE SALUD", "3" => "CELULAR 1", "4" => "CELULAR 2", "5" => "TELEF. FIJO", "6" => "...");
        $arrayTipo = array("1" => "c", "2" => "c", "3" => "c", "4" => "c", "5" => "c", "6" => "c");
        $o_Tabla = new Tabla1($arrayCabecera, 10, $arrayFilas1, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'OnClick', 'seleccionaMedicoProgramacionMedicos', 0, $arrayTipo);
        $tablaHTML = $o_Tabla->getTabla();
        $row_ini = "<table width='100%'>";
        $row_fin = "</table>";
        return $row_ini . $tablaHTML . $row_fin;
    }

    //tabla
    function mostrarseleccionProgramacionMedicos($datos) {
        $oLCronograma = new LCronograma();
        $datos == '' ? $arrayFilas1 = array() : $arrayFilas1 = $oLCronograma->obtenerProgramacionMedico($datos);
        $arrayCabecera = array("1" => "DIA", "2" => "ACTIVIDAD", "3" => "SERVICIO", "4" => "AMB.LOG.", "5" => "AMB.FIS.", "6" => "TURNO", "7" => "CUPOS", "8" => "ADIC.", "9" => "...", "10" => "...", /* "11"=>"...", */ "12" => "...");
        $arrayTipo = array("0" => "c", "1" => "c", "2" => "c", "3" => "c", "4" => "c", "5" => "c", "6" => "c", "7" => "c", "8" => "c", "9" => "h", "10" => "h", /* "11"=>"h", */ "12" => "c");
        $o_Tabla = new Tabla1($arrayCabecera, 10, $arrayFilas1, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'OnClick', '', 0, $arrayTipo);
        $tablaHTML = $o_Tabla->getTabla();
        $row_ini = "<table width='100%'>";
        $row_fin = "</table>";
        return $row_ini . $tablaHTML . $row_fin;
    }

    function cargarEstadisticaMensualMedico($datos) {
        $o_Lcronograma = new LCronograma();
        $resultado = $o_Lcronograma->obtenerEstadisticaMensualMedico($datos);
        return $resultado;
    }

    //combo
    public function seleccionAmbientesLogicos($datos) {
        $o_Lcronograma = new LCronograma();
        $datosComboAmbientes = $o_Lcronograma->getArrayListaAmbientes($datos);
        $o_ComboAmbiente = new Combo($datosComboAmbientes);
        $comboHTML_01 = $o_ComboAmbiente->getOptionsHTML();
        $row_ochg = "onchange=\"seleccionaAmbientesLogicosProgramacionMedicos(true)\"";
        $row_ini = "<table width=\"100%\" align=\"left\"><tr>";
        $row_fin = "</tr></table>";
        $row_etiqueta = "";
        $row_filtro = "<td align=\"left\" width=\"100%\" style=\"font-family:Arial;font-size:11pt\"><select align=\"center\" style=\"font-family:Arial;font-size: 11pt\" name=\"cb_filtro_ambienteslogicos\" id=\"cb_filtro_ambienteslogicos\" " . $row_ochg . ">";
        $row_fin_cb = "</select></td>";
        $comboHTML = $row_ini . $row_filtro . $comboHTML_01 . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

    public function seleccionAmbienteLogicoPorPuesto($datos) {//Combo Junnior
        $o_Lcronograma = new LCronograma();
        $datosComboAmbientes = $o_Lcronograma->spListaAmbienteLogicoPorPuesto($datos);
        $o_ComboAmbiente = new Combo($datosComboAmbientes);
        $comboHTML_01 = $o_ComboAmbiente->getOptionsHTML();
        $row_ochg = "onchange=\"seleccionaAmbientesLogicosProgramacionMedicos(true)\"";
        $row_ini = "<table width=\"100%\" align=\"left\"><tr>";
        $row_fin = "</tr></table>";
        $row_etiqueta = "";
        $row_filtro = "<td align=\"left\" width=\"100%\" style=\"font-family:Arial;font-size:11pt\"><select align=\"center\" style=\"font-family:Arial;font-size: 11pt\" name=\"cb_filtro_ambienteslogicos\" id=\"cb_filtro_ambienteslogicos\" " . $row_ochg . ">";
        $row_fin_cb = "</select></td>";
        $comboHTML = $row_ini . $row_filtro . $comboHTML_01 . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

    function seleccionServiciosPorActividadDeCentroCosto($datos) {//Combo Junnior
        $o_Lcronograma = new LCronograma();
        $datosComboServicios = $o_Lcronograma->spListaServiciosPorActividadDeCentroCosto($datos);
        $o_ComboServicios = new Combo($datosComboServicios);
        $comboHTML_01 = $o_ComboServicios->getOptionsHTML();
        $row_ochg = "onchange=\"seleccionaServicioProgramacionMedicos()\"";
        $row_ini = "<table width=\"100%\" align=\"left\"><tr>";
        $row_fin = "</tr></table>";
        $row_etiqueta = "";
        $row_filtro = "<td align=\"left\" width=\"100%\" style=\"font-family:Arial;font-size:11pt\"><select align=\"center\" style=\"font-family:Arial;font-size: 11pt\" name=\"cb_filtro_servicios\" id=\"cb_filtro_servicios\" " . $row_ochg . ">";
        $row_fin_cb = "</select></td>";
        $comboHTML = $row_ini . $row_filtro . $comboHTML_01 . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

    function seleccionPuestos($datos) {
        $o_Lcronograma = new LCronograma();
        $datosComboPuestos = $o_Lcronograma->getArrayListaPuestos($datos);
        $o_ComboPuesto = new Combo($datosComboPuestos);
        $comboHTML_01 = $o_ComboPuesto->getOptionsHTML();
        $row_ochg = "onchange=\"seleccionaPuestoProgramacionMedicos()\"";
        $row_ini = "<table width=\"100%\" align=\"left\"><tr>";
        $row_fin = "</tr></table>";
        $row_etiqueta = "";
        $row_filtro = "<td align=\"left\" width=\"100%\" style=\"font-family:Arial;font-size:11pt\"><select align=\"center\" style=\"font-family:Arial;font-size: 11pt\" name=\"cb_filtro_puestos\" id=\"cb_filtro_puestos\" " . $row_ochg . ">";
        $row_fin_cb = "</select></td>";
        $comboHTML = $row_ini . $row_filtro . $comboHTML_01 . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

    function seleccionServicios($datos) {
        $o_Lcronograma = new LCronograma();
        $datosComboServicios = $o_Lcronograma->getArrayListaServicios($datos);
        $o_ComboServicios = new Combo($datosComboServicios);
        $comboHTML_01 = $o_ComboServicios->getOptionsHTML();
        $row_ochg = "onchange=\"seleccionaServicioProgramacionMedicos()\"";
        $row_ini = "<table width=\"100%\" align=\"left\"><tr>";
        $row_fin = "</tr></table>";
        $row_etiqueta = "";
        $row_filtro = "<td align=\"left\" width=\"100%\" style=\"font-family:Arial;font-size:11pt\"><select align=\"center\" style=\"font-family:Arial;font-size: 11pt\" name=\"cb_filtro_servicios\" id=\"cb_filtro_servicios\" " . $row_ochg . ">";
        $row_fin_cb = "</select></td>";
        $comboHTML = $row_ini . $row_filtro . $comboHTML_01 . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

    function seleccionAmbientesFisicos($datos) {
        $o_Lcronograma = new LCronograma();
        $datosComboAmbientesFisicos = $o_Lcronograma->getArrayListaAmbientesFisicos($datos);
        $o_ComboAmbientesFisicos = new Combo($datosComboAmbientesFisicos);
        $comboHTML_01 = $o_ComboAmbientesFisicos->getOptionsHTML();
        $row_ochg = "onchange=\"seleccionaAmbientesFisicosProgramacionMedicos()\"";
        $row_ini = "<table width=\"100%\" align=\"left\"><tr>";
        $row_fin = "</tr></table>";
        $row_etiqueta = "";
        $row_filtro = "<td align=\"left\" width=\"100%\" style=\"font-family:Arial;font-size:11pt\"><select align=\"center\" style=\"font-family:Arial;font-size: 11pt\" name=\"cb_filtro_ambientefisico\" id=\"cb_filtro_ambientefisico\" " . $row_ochg . ">";
        $row_fin_cb = "</select></td>";
        $comboHTML = $row_ini . $row_filtro . $comboHTML_01 . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

    function seleccionActividades() {
        $oLMantenimientoGeneral = new LMantenimientoGeneral();
        $datosComboActividades = $oLMantenimientoGeneral->getArrayListaActividades();
        $o_ComboActividades = new Combo($datosComboActividades);
        $comboHTML_01 = $o_ComboActividades->getOptionsHTML();
        $row_ochg = "onchange=\"seleccionaActividadProgramacionMedicos()\"";
        $row_ini = "<table width=\"100%\" align=\"left\"><tr>";
        $row_fin = "</tr></table>";
        $row_etiqueta = "";
        $row_filtro = "<td align=\"left\" width=\"100%\" style=\"font-family:Arial;font-size:11pt\"><select align=\"center\" style=\"font-family:Arial;font-size: 11pt\" name=\"cb_filtro_actividad\" id=\"cb_filtro_actividad\" " . $row_ochg . ">";
        $row_fin_cb = "</select></td>";
        $comboHTML = $row_ini . $row_filtro . $comboHTML_01 . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

    function seleccionTurnos($datos) {
        $o_Lcronograma = new LCronograma();
        $datosComboTurno = $o_Lcronograma->getArrayListaTurnos($datos);
        if ($datos["turno"] == -1) {
            $row_ochg = "onchange=\"cargaTurnoFinalProgramacionMedicos()\"";
            $idcombo = "cb_filtro_turnoinicio";
        } else {
            $row_ochg = "onchange=\"seleccionaHoraFinal()\"";
            $idcombo = "cb_filtro_turnofinal";
        }
        $o_ComboTurnos = new Combo($datosComboTurno, '0000');
        $comboHTML_01 = $o_ComboTurnos->getOptionsHTML();
        $row_ini = "<table width=\"100%\" align=\"left\"><tr>";
        $row_fin = "</tr></table>";
        $row_etiqueta = "";
        $row_filtro = "<td align=\"left\" width=\"100%\" style=\"font-family:Arial;font-size:11pt\"><select align=\"center\" style=\"font-family:Arial;font-size: 11pt\" $row_ochg name=\"" . $idcombo . "\" id=\"" . $idcombo . "\" >";
        $row_fin_cb = "</select></td>";
        $comboHTML = $row_ini . $row_filtro . $comboHTML_01 . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

    function obtenerTiempoAtencion($datos) {
        $o_Lcronograma = new LCronograma();
        $resultado = $o_Lcronograma->getTiempoAtencion($datos);
        return $resultado;
    }

    function obtenercodigoTurno($datos) {
        $o_Lcronograma = new LCronograma();
        $resultado = $o_Lcronograma->obtenercodigoTurno($datos);
        return $resultado;
    }

    function obtenerlistaAfiliacionesNOAsignadasPopad($datos) {
        $o_Lcronograma = new LCronograma();
        $datosComboAfilicionesNoAsignadas = $o_Lcronograma->lobtenerlistaAfiliacionesNOAsignadasPopad($datos);
        $o_ComboAfiliacionesNoAsignadas = new Combo($datosComboAfilicionesNoAsignadas);
        $comboHTML_01 = $o_ComboAfiliacionesNoAsignadas->getOptionsListaHTML();
        $row_ochg = "onchange=\"\"";
        $multiple = "multiple=\"multiple\"";
        $size = "size=\"15\"";
        $row_ini = "<table width=\"100%\" align=\"left\"><tr>";
        $row_fin = "</tr></table>";
        $row_etiqueta = "";
        $row_filtro = "<select style=\"width:100%\" name=\"lst_afiliacionesnoseleccionadas\" id=\"lst_afiliacionesnoseleccionadas\" $size $multiple " . $row_ochg . ">";
        $row_fin_cb = "</select>";
        $comboHTML = $row_filtro . $comboHTML_01 . $row_fin_cb;
        return utf8_encode($comboHTML);
    }

    function obtenerlistaAfiliacionesNOAsignadas() {
        $o_Lcronograma = new LCronograma();
        $datosComboAfilicionesNoAsignadas = $o_Lcronograma->obtenerlistaAfiliacionesNOAsignadas();
        $o_ComboAfiliacionesNoAsignadas = new Combo($datosComboAfilicionesNoAsignadas);
        $comboHTML_01 = $o_ComboAfiliacionesNoAsignadas->getOptionsListaHTML();
        $row_ochg = "onchange=\"\"";
        $multiple = "multiple=\"multiple\"";
        $size = "size=\"15\"";
        $row_ini = "<table width=\"100%\" align=\"left\"><tr>";
        $row_fin = "</tr></table>";
        $row_etiqueta = "";
        $row_filtro = "<select style=\"width:100%\" name=\"lst_afiliacionesnoseleccionadas\" id=\"lst_afiliacionesnoseleccionadas\" $size $multiple " . $row_ochg . ">";
        $row_fin_cb = "</select>";
        $comboHTML = $row_filtro . $comboHTML_01 . $row_fin_cb;
        return utf8_encode($comboHTML);
    }

    function obtenerlistaAfiliacionesAsignadasPopad($datos) {
        $o_Lcronograma = new LCronograma();
        $datosComboAfilicionesAsignadas = $o_Lcronograma->lobtenerlistaAfiliacionesAsignadasPopad($datos);
        //$datosComboAfilicionesAsignadas = array();
        $o_ComboAfiliacionesAsignadas = new Combo($datosComboAfilicionesAsignadas);
        $comboHTML_01 = $o_ComboAfiliacionesAsignadas->getOptionsListaHTML();
        $row_ochg = "onchange=\"\"";
        $multiple = "multiple=\"multiple\"";
        $size = "size=\"15\"";
        $row_ini = "<table width=\"100%\" align=\"left\"><tr>";
        $row_fin = "</tr></table>";
        $row_etiqueta = "";
        $row_filtro = "<select style=\"width:100%\" name=\"lst_afiliacionesseleccionadas\" id=\"lst_afiliacionesseleccionadas\" $size $multiple " . $row_ochg . ">";
        $row_fin_cb = "</select>";
        $comboHTML = $row_filtro . $comboHTML_01 . $row_fin_cb;
        return $comboHTML;
    }

    function obtenerlistaAfiliacionesAsignadas() {
        $o_Lcronograma = new LCronograma();
        //$datosComboAfilicionesAsignadas = $o_Lcronograma->obtenerlistaAfiliacionesAsignadas();
        $datosComboAfilicionesAsignadas = array();
        $o_ComboAfiliacionesAsignadas = new Combo($datosComboAfilicionesAsignadas);
        $comboHTML_01 = $o_ComboAfiliacionesAsignadas->getOptionsListaHTML();
        $row_ochg = "onchange=\"\"";
        $multiple = "multiple=\"multiple\"";
        $size = "size=\"15\"";
        $row_ini = "<table width=\"100%\" align=\"left\"><tr>";
        $row_fin = "</tr></table>";
        $row_etiqueta = "";
        $row_filtro = "<select style=\"width:100%\" name=\"lst_afiliacionesseleccionadas\" id=\"lst_afiliacionesseleccionadas\" $size $multiple " . $row_ochg . ">";
        $row_fin_cb = "</select>";
        $comboHTML = $row_filtro . $comboHTML_01 . $row_fin_cb;
        return $comboHTML;
    }

    function grabarProgramacionMedicos($datos) {
        $o_Lcronograma = new LCronograma();
        $resultado = $o_Lcronograma->grabarProgramacionMedicos($datos);
        return $resultado;
    }

    function eliminarProgramacionMedicos($datos) {
        $o_Lcronograma = new LCronograma();
        $resultado = $o_Lcronograma->eliminarProgramacionMedicos($datos);
        return $resultado;
    }

    function mostrarProgramacionAmbientesFisicos($datos) {
        $funcion = '';
        $oLCronograma = new LCronograma();
        $datos == '' ? $arrayFilas1 = array() : $arrayFilas1 = $oLCronograma->listarProgramacionAmbientesFisicos($datos);
        $arrayCabecera = array("0" => "AMB.FIS.", "1" => "FECHA", "2" => "TURNO", "3" => "PUESTO", "4" => "MEDICO");
        $arrayTipo = array("0" => "c", "1" => "c", "2" => "c", "3" => "c", "4" => "c", "5" => "c");
        $o_Tabla = new Tabla1($arrayCabecera, 12, $arrayFilas1, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'OnClick', $funcion, 0, $arrayTipo);
        $tablaHTML = $o_Tabla->getTabla();
        $row_ini = "<table width='100%'>";
        $row_fin = "</table>";
        return $row_ini . $tablaHTML . $row_fin;
    }

    /* Reprogramacion de Medicos */

    function consultarProgramacionMedicos($datos) {
        $o_Lcronograma = new LCronograma();
        $resultado = $o_Lcronograma->consultarProgramacionMedicos($datos);
        return $resultado;
    }

    public function cargarComboAmbienteLogicoReprogramacionMedico($datos) {
        $o_Lcronograma = new LCronograma();
        $datosComboAmbientes = $o_Lcronograma->spListaAmbienteLogicoPorPuesto($datos);
        $o_ComboAmbiente = new Combo($datosComboAmbientes);
        $comboHTML_01 = $o_ComboAmbiente->getOptionsHTML($datos["hdnCodAmbLogico"]);
        //$row_ochg = "onchange=\"seleccionaAmbientesLogicosProgramacionMedicos(true)\"";
        $row_ochg = "onchange=\"cargarComboAmbienteFisicoReprogramacionMedico()\"";
        $row_ini = "<table width=\"100%\" align=\"left\"><tr>";
        $row_fin = "</tr></table>";
        $row_etiqueta = "";
        $row_filtro = "<td align=\"left\" width=\"100%\" style=\"font-family:Arial;font-size:11pt\"><select align=\"center\" style=\"font-family:Arial;font-size: 11pt\" name=\"cb_filtro_ambienteslogicos\" id=\"cb_filtro_ambienteslogicos\" " . $row_ochg . ">";
        $row_fin_cb = "</select></td>";
        $comboHTML = $row_ini . $row_filtro . $comboHTML_01 . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

    public function cargarComboAmbienteFisicoReprogramacionMedico($datos) {
        $o_Lcronograma = new LCronograma();
        $datosComboAmbientesFisicos = $o_Lcronograma->getArrayListaAmbientesFisicos($datos);
        $o_ComboAmbientesFisicos = new Combo($datosComboAmbientesFisicos);
        $comboHTML_01 = $o_ComboAmbientesFisicos->getOptionsHTML($datos["codAmbienteFisico"]);
        $row_ochg = ""; //Ninguna accion cuando se selecciona para la edicion de una programacion
        $row_ini = "<table width=\"100%\" align=\"left\"><tr>";
        $row_fin = "</tr></table>";
        $row_etiqueta = "";
        $row_filtro = "<td align=\"left\" width=\"100%\" style=\"font-family:Arial;font-size:11pt\"><select align=\"center\" style=\"font-family:Arial;font-size: 11pt\" name=\"cb_filtro_ambientefisico\" id=\"cb_filtro_ambientefisico\" " . $row_ochg . ">";
        $row_fin_cb = "</select></td>";
        $comboHTML = $row_ini . $row_filtro . $comboHTML_01 . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

    function cargaLocalizacionReprogramacionMedicos($datos) {
        $o_Lcronograma = new LCronograma();
        $datosComboAmbientesFisicos = $o_Lcronograma->getArrayListaAmbientesFisicos($datos);
        $o_ComboAmbientesFisicos = new Combo($datosComboAmbientesFisicos);
        $comboHTML_01 = $o_ComboAmbientesFisicos->getOptionsHTML();
        $row_ochg = "";
        $row_ini = "<table width=\"100%\" align=\"left\"><tr>";
        $row_fin = "</tr></table>";
        $row_etiqueta = "";
        $row_filtro = "<td align=\"left\" width=\"100%\" style=\"font-family:Arial;font-size:11pt\"><select align=\"center\" style=\"font-family:Arial;font-size: 11pt\" name=\"cb_filtro_ambientefisico\" id=\"cb_filtro_ambientefisico\" " . $row_ochg . ">";
        $row_fin_cb = "</select></td>";
        $comboHTML = $row_ini . $row_filtro . $comboHTML_01 . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

    function actualizarCronogramaReProgramacionMedicos($datos) {
        $o_Lcronograma = new LCronograma();
        $resultado = $o_Lcronograma->actualizarCronogramaReProgramacionMedicos($datos);
        return $resultado;
    }

    public function mantenimientoReprogramarMedico($datos) {
        $o_Lcronograma = new LCronograma();
        $resultado = $o_Lcronograma->spMantenimientoReprogramarMedico($datos);
        return $resultado;
    }

    function generarCodigoAutorizacionProgramacionMedicos($datos) {
        $o_Lcronograma = new LCronograma();
        $resultado = $o_Lcronograma->generarCodigoAutorizacionProgramacionMedicos($datos);
        return $resultado;
    }

    /* function validarAutorizacionProgramacionMedicos($datos) {
      $o_Lcronograma = new LCronograma();
      $resultado = $o_Lcronograma->validarAutorizacionProgramacionMedicos($datos);
      return $resultado;
      } */

    /* function mostrarMedicosparaReprogramacionMedicos($datos) {
      $funcion = 'grabarReprogramacionMedicos';
      $oLCronograma = new LCronograma();
      $datos==''?$arrayFilas1 = array():$arrayFilas1 = $oLCronograma->listarMedicosparaReprogramacionMedicos($datos);
      $arrayCabecera 	= array("1"=>"CODIGO","2"=>"MEDICO","3"=>"PUESTO");
      $arrayTipo=array("1"=>"c","2"=>"c","3"=>"c","4"=>"c","5"=>"c","6"=>"c");
      $o_Tabla 	= new Tabla1($arrayCabecera,12,$arrayFilas1,'tablaOrden','filax','filay','filaSeleccionada','OnClick',$funcion,0,$arrayTipo);
      $tablaHTML 	= $o_Tabla->getTabla();
      $row_ini	= "<table width='100%'>";
      $row_fin	="</table>";
      return $row_ini.$tablaHTML.$row_fin;
      } */

    public function xmlTablaMedicoParaReprogramacion($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLCronograma = new LCronograma();

        $arrayFilas = $oLCronograma->listarMedicosparaReprogramacionMedicos($datos);

        $arrayCabecera = array("cadenaDatos" => "datos",
            "c_cod_per" => "Código",
            "vNumeroDocumento" => "DNI",
            "nomCompletoMedico" => "Médico",
            /* "vApellidoPaterno"=>"Ap. Paterno",
              "vApellidoMaterno"=>"Ap. Materno",
              "vNombre"=>"Nombres", */
            "vNombrePuesto" => "Puesto");

        $arrayTamano = array("cadenaDatos" => "200",
            "c_cod_per" => "80",
            "vNumeroDocumento" => "80",
            "nomCompletoMedico" => "250",
            /* "vApellidoPaterno"=>"100",
              "vApellidoMaterno"=>"100",
              "vNombre"=>"150", */
            "vNombrePuesto" => "250");

        $arrayTipo = array("cadenaDatos" => "ro",
            "c_cod_per" => "ro",
            "vNumeroDocumento" => "ro",
            "nomCompletoMedico" => "ro",
            /* "vApellidoPaterno"=>"ro",
              "vApellidoMaterno"=>"ro",
              "vNombre"=>"ro", */
            "vNombrePuesto" => "ro");

        $arrayAlineacion = array("cadenaDatos" => "right",
            "c_cod_per" => "center",
            "vNumeroDocumento" => "center",
            "nomCompletoMedico" => "left",
            /* "vApellidoPaterno"=>"left",
              "vApellidoMaterno"=>"left",
              "vNombre"=>"left", */
            "vNombrePuesto" => "center");

        $arrayHidden = array("cadenaDatos" => "true",
            "c_cod_per" => "false",
            "vNumeroDocumento" => "false",
            "nomCompletoMedico" => "false",
            /* "vApellidoPaterno"=>"false",
              "vApellidoMaterno"=>"false",
              "vNombre"=>"false", */
            "vNombrePuesto" => "false");

        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    function grabarReprogramacionMedicos($datos) {
        $o_Lcronograma = new LCronograma();
        $resultado = $o_Lcronograma->grabarReprogramacionMedicos($datos);
        return $resultado;
    }

    function mostrarAfiliacionesXCronograma($datos) {
        $o_Lcronograma = new LCronograma();
        $datosComboAfilicionesAsignadas = $o_Lcronograma->listaAfiliacionesXCronograma($datos);
        $o_ComboAfiliacionesAsignadas = new Combo($datosComboAfilicionesAsignadas);
        $comboHTML_01 = $o_ComboAfiliacionesAsignadas->getOptionsListaHTML();
        $row_ochg = "onchange=\"\"";
        $multiple = "multiple=\"multiple\"";
        $size = "size=\"15\"";
        $row_ini = "<table width=\"70%\" height=\"100%\" align=\"center\"><tr><td height=\"100%\">";
        $row_fin = "</td></tr></table>";
        $row_etiqueta = "";
        $row_filtro = "<select style=\"width:100%\" name=\"lst_afiliacionesasignadas\" id=\"lst_afiliacionesasignadas\" $size $multiple " . $row_ochg . ">";
        $row_fin_cb = "</select>";
        $comboHTML = $row_ini . $row_filtro . $comboHTML_01 . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

    function cargaEmpleadosProgramacionMedicosxCC($datos) {
        $o_Lcronograma = new LCronograma();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_Lcronograma->getListaProfesionalMedicos($datos);
        $arrayCabecera = array(0 => "", 1 => "CODIGO", 2 => "PERSONAL DE SALUD", 3 => "CELULAR 1", 4 => "CELULAR 2", 5 => "TELF. FIJO", 6 => "...");
        $arrayTamano = array(0 => "60", 1 => "60", 2 => "*", 3 => "90", 4 => "90", 5 => "90", 6 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false", 6 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function mostrarseleccionProgramacionMedicosdhtmlx($datos) {

//         $oLCronograma = new LCronograma();
//        $datos == '' ? $arrayFilas1 = array() : $arrayFilas1 = $oLCronograma->obtenerProgramacionMedico($datos);
//        $arrayCabecera = array("1" => "DIA", "2" => "ACTIVIDAD", "3" => "SERVICIO", "4" => "AMB.LOG.", "5" => "AMB.FIS.", "6" => "TURNO", "7" => "CUPOS", "8" => "ADIC.", "9" => "...", "10" => "...", /* "11"=>"...", */"12" => "...");
//        $arrayTipo = array("0" => "c", "1" => "c", "2" => "c", "3" => "c", "4" => "c", "5" => "c", "6" => "c", "7" => "c", "8" => "c", "9" => "h", "10" => "h", /* "11"=>"h", */"12" => "c");
//        $o_Tabla = new Tabla1($arrayCabecera, 10, $arrayFilas1, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'OnClick', '', 0, $arrayTipo);
//        $tablaHTML = $o_Tabla->getTabla();
//        $row_ini = "<table width='100%'>";
//        $row_fin = "</table>";
//        return $row_ini . $tablaHTML . $row_fin;
        $o_Lcronograma = new LCronograma();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_Lcronograma->obtenerProgramacionMedico($datos);
        //print_r($arrayFilas);
        $arrayCabecera = array(0 => "", 1 => "DIA", 2 => "ACTIVIDAD", 3 => "C. COSTO", 4 => "AMB.LOG.", 5 => "AMB.FIS.", 6 => "TURNO", 7 => "CUPOS", 8 => "", 9 => "", 10 => "", 11 => "Fecha Pro.", 12 => "Activo", 13 => "...", 14 => "...", 15 => "...", 16 => "...", 17 => "...", 18 => "...");
        $arrayTamano = array(0 => "*", 1 => "50", 2 => "110", 3 => "180", 4 => "180", 5 => "60", 6 => "90", 7 => "50", 8 => "*", 9 => "*", 10 => "*", 11 => "*", 12 => "30", 13 => "30", 14 => "30", 15 => "30", 16 => "30", 17 => "30", 18 => "30");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro", 9 => "ro", 10 => "ro", 11 => "ro", 12 => "ro", 13 => "ro", 14 => "img", 15 => "img", 16 => "img", 17 => "ro", 18 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default", 10 => "default", 11 => "default", 12 => "default", 13 => "default", 14 => "pointer", 15 => "pointer", 16 => "pointer", 17 => "default", 18 => "pointer");
        $arrayHidden = array(0 => "TRUE", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "true", 6 => "false", 7 => "false", 8 => "true", 9 => "true", 10 => "true", 11 => "false", 12 => "true", 13 => "true", 14 => "false", 15 => "false", 16 => "true", 17 => "true", 18 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "left", 7 => "center", 8 => "left", 9 => "left", 10 => "left", 11 => "left", 12 => "center", 13 => "center", 14 => "center", 15 => "center", 16 => "center", 17 => "center", 18 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function traerDatosProgramacion($datos) {
        $o_Lcronograma = new LCronograma();
        $resultado = $o_Lcronograma->traerDatosProgramacion($datos);
        return $resultado;
    }

    function guardarMantenimientoPRogramado($datos) {
        $o_Lcronograma = new LCronograma();
        $resultado = $o_Lcronograma->guardarMantenimientoPRogramado($datos);
        return $resultado;
    }

    function abrirPopudEliminarProgramacion($datos) {
        require_once '../../cvista/programacion/abrirPopudEliminarProgramacion.php';
    }

    function mostrarEdicionProgramacion($datos) {
        $o_Lcronograma = new LCronograma();
        $rs = $o_Lcronograma->mostrarEdicionProgramacion($datos);

        return $rs;
    }

    function consultaProgramacionMedicosJorgeNuevo($datos) {
        $o_Lcronograma = new LCronograma();
        $resultadoSede = $o_Lcronograma->LconsultarSede($datos);
        $resultadoAmbiente = $o_Lcronograma->consultarAmbienteFisico($datos);
        require_once '../../cvista/programacion/cambioDeAmbienteFisicoMedicos_0.php';

    }

    function aDatosCronogramaMedicos($datos) {
        $o_Lcronograma = new LCronograma();
        $rs = $o_Lcronograma->lDatosCronogramaMedicos($datos);
        return $rs;
    }

    function aCantidadAdicionales($datos) {
        $o_Lcronograma = new LCronograma();
        $rs = $o_Lcronograma->lCantidadAdicionales($datos);
        return $rs;
    }

    function aGuardarCambiosLogADicionales($datos) {
        $o_Lcronograma = new LCronograma();
        $rs = $o_Lcronograma->lGuardarCambiosLogADicionales($datos);
        return $rs;
    }

    function abrirPopudReporteMensualCronograma($datos) {
        $o_Lcronograma = new LCronograma();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_Lcronograma->labrirPopudReporteMensualCronograma($datos);
        $arrayCabecera = array(0 => "", 1 => "", 2 => "", 3 => "", 4 => ".", 5 => ".", 6 => "", 7 => "", 8 => "");
        $arrayTamano = array(0 => "40", 1 => "50", 2 => "80", 3 => "*", 4 => "*", 5 => "*", 6 => "*", 7 => "*", 8 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false", 6 => "false", 7 => "false", 8 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "left", 7 => "center", 8 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);

    }


    function cargarComboAmbienteFisicoReprogramacionMedicoNuevo($datos) {
        $o_Lcronograma = new LCronograma();
        $rs = $o_Lcronograma->LcargarComboAmbienteFisicoReprogramacionMedicoNuevo($datos);
        $cadena = '<select style="width: 120px; font-size: 9px;" name="cb_filtro_ambienteFisico" id="cb_filtro_ambienteFisico" >';
        $cadena .= ' <option value="0000">Seleccionar</option>';
        foreach ($rs as $key => $value) {
            $cadena .= '<option value="' . $value[0] . '">' . $value[1] . '</option>';
        }
        $cadena .= ' </select>';
        return $cadena;
        return $rs;
    }



    function seleccionarTurnoProgramacionMedico($datos){
        $o_Lcronograma = new LCronograma();       
        $rs = $o_Lcronograma->seleccionarTurnoProgramacionMedico($datos);
        return $rs;
    }
    function seleccionarHoraFinal($datos){
        $o_Lcronograma = new LCronograma();       
        $rs = $o_Lcronograma->seleccionarHoraFinal($datos);
        return $rs;
    }   
    function actualizarTurnoProgramacionMedico($datos){
        $o_Lcronograma = new LCronograma();       
        $rs = $o_Lcronograma->actualizarTurnoProgramacionMedico($datos);
        return $rs;
    }

}

?>