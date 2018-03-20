<?php

include_once("../../../pholivo/adophp/Adophp.class.php");
include_once("../../../pholivo/Conexion.php");
include_once("../../centidad/ECita.php");

class DCita extends Adophp {

    private $cnx;
    private $eCita;
    var $errorGrabar;

    public function __construct($cnx = Array(), $_eCita = '') {
        $this->cnx = empty($cnx) ? Conexion::getInitDsnMSSQLSimedh() : $cnx;
        parent::__construct('Spanish', $this->cnx);
        $this->errorGrabar = array("0" => "grabo Ok!",
            "1" => "programacion de mdico no existe",
            "2" => "programacion de mdico ya paso",
            "3" => "hora seleccionada ya no se puede programar, ya paso",
            "4" => "Tipo de cita incorrecto",
            "5" => "origen de cita seleccionado incorrecto",
            "6" => "El registro de esta persona esta deshabilitada o esta persona no existe",
            "7" => "La persona Seleccionada no es una persona natural",
            "8" => "Esta persona no es un paciente por la ptmre",
            "9" => "Persona no tiene historia clinica, mostrar opcion generar historia clinica",
            "10" => "Afiliacion seleccionada de la persona no esta activa, o no posee una afiliacion,gestionar afiliacion",
            "11" => "Afiliacin actual del paciente no correponde para el producto seleccionado");
    }

    public function getArrayCitaCronograma($iid_cronograma) {
        parent::ConnectionOpen("prog_per", "dbweb");
        parent::SetParameterSP("centro costos", ' ');
        parent::SetParameterSP("codigo_ambiente", ' ');
        parent::SetParameterSP("iid_cronograma", $iid_cronograma);
        parent::SetParameterSP("descripcion_turno", ' ');
        parent::SetSelect("*");
        $resultado = parent::executeSPArrayX();

        return $resultado;
    }

    public function getFechHoraServidor() {
        parent::ConnectionOpen("pa_obtener_fecha", "dbweb");
        parent::SetSelect("*");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getOrigenCita() {
        parent::ConnectionOpen("sel_torigen_cita", "public");
        parent::SetSelect("*");
        $resultado = parent::ExecuteSPArrayCombo(); //echo parent::GetSql();
        //var_dump($resultado);
        return $resultado;
    }

    function getArraylistaDatosBusqueda($filtro, $dato, $fecha, $sede) {
        parent::ConnectionOpen("pa_cons_cronomed_filtro", "dbweb");
        parent::SetParameterSP("pfiltro", $filtro);
        parent::SetParameterSP("pfecha", date("Y/m/d", strtotime($fecha)));
        parent::SetParameterSP("sede", $sede);
        parent::SetSelect("*");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//backup
    function getArraylistaSedes($datos) {
        parent::ConnectionOpen("pnsListaSedes", "dbweb");
        parent::SetParameterSP("codigoCentroCosto", $datos["codigoCentroCosto"]);
        parent::SetParameterSP("ip", $datos["ip"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getArraylistaSedes1($datos) {
        parent::ConnectionOpen("AsignacionPersonalArea", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("iCodigoEmpleado", $datos['iCodigoEmpleado']);
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idArea", '');
//        parent::SetParameterSP("ip",$datos["ip"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//prueba   accion
//    function getArraylistaSedes($datos) {
////        $resultado=$_SESSION['iCodigoEmpleado']; comentario
//        
//        parent::ConnectionOpen("AsignacionPersonalArea","dbweb");
//        parent::SetParameterSP("accion",'1');
//        parent::SetParameterSP("iCodigoEmpleado",'1980');
//        parent::SetParameterSP("idSedeEmpresa",'');
//        parent::SetParameterSP("idArea",'');
//        parent::SetParameterSP("idSedeEmpresaArea",'');
//        parent::SetParameterSP("descripcionArea",'');
//        
//             
//        $resultado=parent::executeSPArrayX();
//        return $resultado;
//    }

    function getArrayListaActividades() {
        parent::ConnectionOpen("pnsListaActividades", "dbweb");
        parent::SetParameterSP("accion", "1");
        parent::SetParameterSP("actividad", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getArraylistaCitasPermitidas($nro_programacionmedico) {
        parent::ConnectionOpen("listaturnos", "dbweb");
        parent::SetParameterSP("nro_progrogramacionmedico", $nro_programacionmedico);
        parent::SetSelect("horario");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /* public function getObjectPacienteCita($iid_persona){
      $iid_persona = empty($iid_persona)?"0":$iid_persona;
      parent::ConnectionOpen("paxadmision","dbweb");
      parent::SetParameterSP("$1",'02');
      parent::SetParameterSP("$2",$iid_persona);
      parent::SetParameterSP("$3",'');
      parent::SetSelect("*");
      $resultado=parent::executeSPArrayX();
      return $resultado;
      } */

    //Lista datos principales de los pacientes.
    public function listaDatosPersona($c_cod_per) {
        $c_cod_per = empty($c_cod_per) ? "0" : $c_cod_per;
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '01');
        parent::SetParameterSP("$2", $c_cod_per);
        parent::SetParameterSP("$3", '');
        parent::SetSelect("*");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista contactos de un paciente.
    public function listaDatosPersonaContactos($c_cod_per) {
        $c_cod_per = empty($c_cod_per) ? "0" : $c_cod_per;
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '04');
        parent::SetParameterSP("$2", $c_cod_per);
        parent::SetParameterSP("$3", '');
        parent::SetSelect("*");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista documentos de identidad de un paciente.
    public function listaDatosPersonaDocumentos($c_cod_per) {
        $c_cod_per = empty($c_cod_per) ? "0" : $c_cod_per;
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '03');
        parent::SetParameterSP("$2", $c_cod_per);
        parent::SetParameterSP("$3", '');
        parent::SetSelect("*");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista direcciones de un paciente.
    public function listaDatosPersonaDireccion($c_cod_per, $tipo) {
        $c_cod_per = empty($c_cod_per) ? "0" : $c_cod_per;
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '02');
        parent::SetParameterSP("$2", $c_cod_per);
        parent::SetParameterSP("$3", $tipo);
        parent::SetSelect("*");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista estudios de un paciente.
    public function listaDatosPersonaEstudios($c_cod_per, $tipo) {
        //echo "$c_cod_per,$tipo";
        $c_cod_per = empty($c_cod_per) ? "0" : $c_cod_per;
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '05');
        parent::SetParameterSP("$2", $c_cod_per);
        parent::SetParameterSP("$3", $tipo);
        parent::SetSelect("*");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lista afiliaciones de un paciente.
    public function listaDatosPersonaAfiliacion($c_cod_per) {
        $c_cod_per = empty($c_cod_per) ? "0" : $c_cod_per;
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '06');
        parent::SetParameterSP("$2", $c_cod_per);
        parent::SetParameterSP("$3", '1');
        parent::SetSelect("*");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getDatosCita($n_prog_pac) {
        $n_prog_pac = empty($n_prog_pac) ? "0" : $n_prog_pac;
        parent::ConnectionOpen("paxadmision", "dbweb");
        parent::SetParameterSP("$1", '35');
        parent::SetParameterSP("$2", $n_prog_pac);
        parent::SetParameterSP("$3", '');
        parent::SetSelect("*");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getObjectPacienteCitaAdicionales($iid_persona) {
        $iid_persona = empty($iid_persona) ? "0" : $iid_persona;
        parent::ConnectionOpen("paxadmision", "dbweb");
        parent::SetParameterSP("$1", '33');
        parent::SetParameterSP("$2", '9001');
        parent::SetParameterSP("$3", $iid_persona);
        parent::SetSelect("*");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getObjectPacienteCitaAdicionales2($iid_persona) {
        $iid_persona = empty($iid_persona) ? "0" : $iid_persona;
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '02');
        parent::SetParameterSP("$2", $iid_persona);
        parent::SetParameterSP("$3", '');
        parent::SetSelect("*");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getArrayCuposCitasCronograma($iid_cronograma) {
        parent::ConnectionOpen("sel_horario_cronograma", "hospitalizacion");
        parent::SetParameterSP("$1", $iid_cronograma);
        parent::SetSelect("*");
        $resultado = parent::ExecuteSPArray(); //echo parent::GetSql();
        return $resultado;
    }

    public function getArrayoficinas() {
        parent::ConnectionOpen("sel_oficinas", "nucleo");
        parent::SetSelect("niv_oficina,der_oficina,cod_oficina,deriva,nom_oficina");
        parent::SetFieldsOrder("niv_oficina,der_oficina,cod_oficina", "asc");
        $resultado = parent::ExecuteSPArray();
        //echo parent::GetSql();
        //var_dump($resultado);
        return $resultado;
    }

    public function grabarCita($parametros) {

        parent::ConnectionOpen("sp_insertar_cita_paciente", "dbweb");
        parent::SetParameterSP("codigoformato", $parametros["hIdFormato"]);
        parent::SetParameterSP("claseformato", $parametros["hIdClas_Formato"]);
        parent::SetParameterSP("codigoambiente", $parametros["hIdAmbiente"]);
        parent::SetParameterSP("codigocentrocostos", $parametros["hIdCentroCosto"]);
        parent::SetParameterSP("codigoturno", $parametros["hIdTurno"]);
        parent::SetParameterSP("fechahoraservicio", $parametros["txtfechacita"]);
        parent::SetParameterSP("codigohora", $parametros["cb_horariopermitido"]);
        parent::SetParameterSP("fechahoraing", $parametros["txtfechacita"]);
        parent::SetParameterSP("fechahoraaltaF", $parametros["txtfechacita"]);
        parent::SetParameterSP("fechahoraaltaM", $parametros["txtfechacita"]);
        parent::SetParameterSP("codigotipocita", $parametros["grupotipocita"]);
        parent::SetParameterSP("", ''); //condicion llegada
        parent::SetParameterSP("", ''); //codigo de cie de ingreso
        parent::SetParameterSP("", ''); //contador cama
        parent::SetParameterSP("codigopersona", $parametros["txtcodigopaciente"]);
        parent::SetParameterSP("codigopersonaresponsable", $parametros["hIdPersonalResponsable"]);
        parent::SetParameterSP("codigopersonaresponsableentidad", $parametros["hIdEntidadPersonalResponsable"]);
        parent::SetParameterSP("codigoprogramacion", $parametros["txtcodigocronograma"]);
        parent::SetParameterSP("descripcioncita", $parametros["txtobservacioncita"]);
        parent::SetParameterSP("nombreusuario", strtoupper($_SESSION["login_user"]));
        parent::SetSelect("*");
        parent::ExecuteStoreProcedure();
        parent::ConnectionClose();
    }

    public function editarCita($parametros) {

        parent::ConnectionOpen("sp_editar_cita_paciente", "dbweb");
        parent::SetParameterSP("codigoformato", $parametros["hIdFormato"]);
        parent::SetParameterSP("claseformato", $parametros["hIdClas_Formato"]);
        parent::SetParameterSP("codigoambiente", $parametros["hIdAmbiente"]);
        parent::SetParameterSP("codigocentrocostos", $parametros["hIdCentroCosto"]);
        parent::SetParameterSP("codigoturno", $parametros["hIdTurno"]);
        parent::SetParameterSP("fechahoraservicio", $parametros["txtfechacita"]);
        parent::SetParameterSP("codigohora", $parametros["cb_horariopermitido"]);
        parent::SetParameterSP("fechahoraing", $parametros["txtfechacita"]);
        parent::SetParameterSP("fechahoraaltaF", $parametros["txtfechacita"]);
        parent::SetParameterSP("fechahoraaltaM", $parametros["txtfechacita"]);
        parent::SetParameterSP("codigotipocita", $parametros["grupotipocita"]);
        parent::SetParameterSP("", ''); //condicion llegada
        parent::SetParameterSP("", ''); //codigo de cie de ingreso
        parent::SetParameterSP("", ''); //contador cama
        parent::SetParameterSP("codigopersona", $parametros["txtcodigopaciente"]);
        parent::SetParameterSP("codigopersonaresponsable", $parametros["hIdPersonalResponsable"]);
        parent::SetParameterSP("codigopersonaresponsableentidad", $parametros["hIdEntidadPersonalResponsable"]);
        parent::SetParameterSP("codigoprogramacion", $parametros["txtcodigocronograma"]);
        parent::SetParameterSP("descripcioncita", $parametros["txtobservacioncita"]);
        parent::SetParameterSP("nombreusuario", strtoupper($_SESSION["login_user"]));
        parent::SetSelect("*");
        parent::ExecuteStoreProcedure();
    }

    public function eliminarCita($n_prog_pac) {
        $usuario = strtoupper($_SESSION["login_user"]);
        parent::ConnectionOpen("sp_eliminar_cita_paciente", "dbweb");
        parent::SetParameterSP("nprogramacionpaciente", $n_prog_pac);
        parent::SetParameterSP("usuario", $usuario);
        parent::ExecuteStoreProcedure();
    }

////////*****************CITAS INFORMES****************/////////////////////
    public function getArrayCitaInformesCronograma($codigoCronograma) {

        parent::ConnectionOpen("pnsDatosCitasInformes", "dbweb");
        parent::SetParameterSP("accion", "1");
        parent::SetParameterSP("codigoCronograma", $codigoCronograma);
        parent::SetParameterSP("codigoHora", "");
        parent::SetParameterSP("codigoProgramacion", "");
        parent::SetParameterSP("afiliacionactiva", "");
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function cambiarEstadoConfirmacionCita($datos) {
        parent::ConnectionOpen("pnsDatosCitasInformes", "dbweb");
        parent::SetParameterSP("accion", "9");
        parent::SetParameterSP("codigoCronograma", $datos["codigoCronograma"]);
        parent::SetParameterSP("codigoHora", $datos["codigoHora"]);
        parent::SetParameterSP("codigoProgramacion", $datos["codigoProgramacion"]);
        parent::SetParameterSP("afiliacionactiva", "");
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function getArraydescripcionCitaInformes($datos) {
        parent::ConnectionOpen("pnsDatosCitasInformes", "dbweb");
        parent::SetParameterSP("accion", "2");
        parent::SetParameterSP("codigoCronograma", $datos["codigoCronograma"]);
        parent::SetParameterSP("codigoHora", $datos["codigoHora"]);
        parent::SetParameterSP("codigoProgramacion", $datos["codigoProgramacion"]);
        parent::SetParameterSP("afiliacionactiva", "");
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function getArraycargarNumeroOrdenGenerada($datos) {
        parent::ConnectionOpen("pnsDatosCitasInformes", "dbweb");
        parent::SetParameterSP("accion", "3");
        parent::SetParameterSP("codigoCronograma", $datos["codigoCronograma"]);
        parent::SetParameterSP("codigoHora", $datos["codigoHora"]);
        parent::SetParameterSP("codigoProgramacion", $datos["codigoProgramacion"]);
        parent::SetParameterSP("afiliacionactiva", "");
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function getArraycargarCodigoPersona($datos) {
        parent::ConnectionOpen("pnsDatosCitasInformes", "dbweb");
        parent::SetParameterSP("accion", "6");
        parent::SetParameterSP("codigoCronograma", $datos["codigoCronograma"]);
        parent::SetParameterSP("codigoHora", $datos["codigoHora"]);
        parent::SetParameterSP("codigoProgramacion", $datos["codigoProgramacion"]);
        parent::SetParameterSP("afiliacionactiva", "");
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function verificarCronogramaAfiliacion($datos) {

        parent::ConnectionOpen("pnsDatosPacienteCitas", "dbweb");
        parent::SetParameterSP("accion", "2");
        parent::SetParameterSP("codigopersona", $datos["codigopersona"]);
        parent::SetParameterSP("codigocronograma", $datos["codigocronograma"]);
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();

        parent::ConnectionClose();
        return $resultado;
    }

    public function getArrayProgramacionEmergenciaInformes($datos) {

        parent::ConnectionOpen("pnsCronogramaMedico", "dbweb");
        parent::SetParameterSP("accion", 10);
        parent::SetParameterSP("fecha", $datos['fecha']);
        parent::SetParameterSP("horarioinicio", '0');
        parent::SetParameterSP("horariofinal", '0');
        parent::SetParameterSP("iCodigoProgramacion", "");
        parent::SetParameterSP("cCodigoCentroCosto", $datos['codigoservicio']);
        parent::SetParameterSP("codigoPersonalSalud", "");
        parent::SetParameterSP("sede", $datos['codigosede']);
        parent::SetParameterSP("contadoroptimofechas", "");
        $resultadoArray = parent::executeSPArrayX();
        //echo parent::GetSql();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    public function dMostrarCronogramaMedicoCita($datos) {

        parent::ConnectionOpen("pnsCronogramaMedico", "dbweb");
        parent::SetParameterSP("accion", 11);
        parent::SetParameterSP("fecha", $datos['fecha']);
        parent::SetParameterSP("horarioinicio", '0');
        parent::SetParameterSP("horariofinal", '0');
        parent::SetParameterSP("iCodigoProgramacion", "");
        parent::SetParameterSP("cCodigoCentroCosto", '');
        parent::SetParameterSP("codigoPersonalSalud", $datos["c_cod_per"]);
        parent::SetParameterSP("sede", '');
        parent::SetParameterSP("contadoroptimofechas", "");
        $resultadoArray = parent::executeSPArrayX();
        //echo parent::GetSql();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    public function getArrayCitaInformesServicio($codigoCronograma) {
        parent::ConnectionOpen("pnsDatosCitasInformes", "dbweb");
        parent::SetParameterSP("accion", "4");
        parent::SetParameterSP("codigoCronograma", $codigoCronograma);
        parent::SetParameterSP("codigoHora", "");
        parent::SetParameterSP("codigoProgramacion", "");
        parent::SetParameterSP("afiliacionactiva", "");
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function getcalcularprecio($datos) {
        parent::ConnectionOpen("pnsDatosCitasInformes", "dbweb");
        parent::SetParameterSP("accion", "8");
        parent::SetParameterSP("codigoCronograma", "");
        parent::SetParameterSP("codigoHora", "");
        parent::SetParameterSP("codigoProgramacion", "");
        parent::SetParameterSP("afiliacionactiva", $datos["afiliacionactiva"]);
        parent::SetParameterSP("codigoservicio", $datos["codigoservicio"]);
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    /* ============================================================================== */
    /* DESCOMENTAR PARA QUE FUNCIONE LOS ADICIONALES IDEALMENTE!!!!!CUANDO SE HAGA EL MODULO PARA MEDICOS */
    /*
      public function getArrayTablaAdicionales($datos){
      parent::ConnectionOpen("pnsDatosCitasInformes","dbweb");
      parent::SetParameterSP("accion","5");
      parent::SetParameterSP("codigoCronograma",$datos["codigoCronograma"]);
      parent::SetParameterSP("codigoHora"," ");
      parent::SetParameterSP("afiliacionactiva","");
      parent::SetParameterSP("codigoservicio","");
      $resultado=parent::executeSPArrayX();
      parent::ConnectionClose();
      return $resultado;
      }
     */
    /* ============================================================================= */
    /* MOSTRAR LAS PROGRAMACIONES DETALLADAS CON ADICIONALES FUERA DE TURNOS=====PARCHE!!!! */
    /* COMENTAR O ELIMINAR CUANDO SE REALICE EL MODULO PARA MEDICOS */

    public function getArrayTablaProgramacionDetallada($datos) {
        parent::ConnectionOpen("pnsDatosCitasInformes", "dbweb");
        parent::SetParameterSP("accion", "10");
        parent::SetParameterSP("codigoCronograma", $datos["codigoCronograma"]);
        parent::SetParameterSP("codigoHora", " ");
        parent::SetParameterSP("codigoProgramacion", "");
        parent::SetParameterSP("afiliacionactiva", "");
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function getCronogramaDetallada($datos) {
        parent::ConnectionOpen("pnsDatosCitasInformes", "dbweb");
        parent::SetParameterSP("accion", "11");
        parent::SetParameterSP("codigoCronograma", $datos["codigoCronograma"]);
        parent::SetParameterSP("codigoHora", " ");
        parent::SetParameterSP("codigoProgramacion", "");
        parent::SetParameterSP("afiliacionactiva", "");
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    /* ============================================================================= */

    public function getArrayeliminarCitaAdicional($datos) {
        parent::ConnectionOpen("pnsEliminarCitansmProgramacionPacientes", "dbweb");
        parent::SetParameterSP("accion", "2");
        parent::SetParameterSP("codigoCronograma", "");
        parent::SetParameterSP("codigoHora", "");
        parent::SetParameterSP("codigoProgramacion", $datos["codigoProgramacion"]);
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", strtoupper($_SESSION['host']));
        parent::SetParameterSP("bPermiso", $datos["datosPermiso"]);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function getArrayguardarCitaProgramada($datos) {
        // session_start();
        parent::ConnectionOpen("pnsInsertarCitansmProgramacionPacientes", "dbweb");
        parent::SetParameterSP("codigoCronograma", $datos["codigoCronograma"]);
        parent::SetParameterSP("codigoPaciente", $datos["codigoPaciente"]);
        parent::SetParameterSP("codigoPersona", $datos["codigoPersona"]);
        parent::SetParameterSP("cHoraProgramada", $datos["horaProgramada"]);
        parent::SetParameterSP("codigotipocita", $datos["codigoTipoCita"]);
        parent::SetParameterSP("descripcioncita", $datos["observacionCita"]);
        parent::SetParameterSP("tipoprogramacion", $datos["tipoProgramacion"]);
        parent::SetParameterSP("codigoActoMedico", $datos["codigoActoMedico"]);
        parent::SetParameterSP("tipoUbicacionCita", $datos["tipoUbicacionCita"]);
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::Close();
        //echo parent::GetSql();
        return $resultado;
    }

    //jcqa Enero 2013  $resultadoArraydxctacte
    public function insertarOrdenesTratamientoProcedimiento($datos, $resultadoArraydxctacte) {
        // session_start();
        parent::ConnectionOpen("pnsinsertarOrdenesTratamiento", "dbweb");
        parent::SetParameterSP("accion", "2");
        parent::SetParameterSP("var1", "");
        parent::SetParameterSP("var2", "");
        parent::SetParameterSP("var3", "");
        parent::SetParameterSP("int1", trim($datos["idTratamientoSeleccionado"]));
        parent::SetParameterSP("int2", "");
        parent::SetParameterSP("int3", "");
        parent::SetParameterSP("bit1", "");
        parent::SetParameterSP("char", $resultadoArraydxctacte[0]["c_item"]);
        parent::SetParameterSP("user", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("host", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::Close();
        //echo parent::GetSql();
        return $resultado;
    }

    public function insertarOrdenesTratamiento($datos, $resultadoArraydxctacte) {
        // session_start();
        parent::ConnectionOpen("pnsinsertarOrdenesTratamiento", "dbweb");
        parent::SetParameterSP("accion", "1");
        parent::SetParameterSP("var1", "");
        parent::SetParameterSP("var2", "");
        parent::SetParameterSP("var3", "");
        parent::SetParameterSP("int1", trim($datos["idTratamientoSeleccionado"]));
        parent::SetParameterSP("int2", "");
        parent::SetParameterSP("int3", "");
        parent::SetParameterSP("bit1", "");
        parent::SetParameterSP("char", $resultadoArraydxctacte[0]["c_item"]);
        parent::SetParameterSP("user", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("host", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::Close();
        //echo parent::GetSql();
        return $resultado;
    }

    public function isExisteNroDoc($nrodoc, $datos) {
        parent::ConnectionOpen("pnsConsultamxctacte", "dbweb");
        parent::SetParameterSP("nroDoc", $nrodoc);
        parent::SetParameterSP("codigoPersona", $datos["codigoPersona"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function guardardetallectacte($datos, $detalle, $nrodoc) {
        // session_start();
//        pnsInsertardctacte_2

        parent::ConnectionOpen("pnsInsertardctacte_paraCita", "dbweb");
        parent::SetParameterSP("nrodoc", $nrodoc);
        parent::SetParameterSP("codigoPersona", $datos["codigoPersona"]);
        parent::SetParameterSP("codigoFormato", $datos["codigoformato"]);
        parent::SetParameterSP("numeroFormato", $datos["numeroformato"]);
        parent::SetParameterSP("codigoservicio", $detalle["codigoservicio"]);
        parent::SetParameterSP("n_porcen", 100);
        parent::SetParameterSP("precioservicio", $detalle["precioservicio"]);
        parent::SetParameterSP("cantidadservicio", $detalle["cantidadservicio"]);
        parent::SetParameterSP("totalservicio", $detalle["totalservicio"]);
        parent::SetParameterSP("estado", 1);
        parent::SetParameterSP("valorigv", '0');
        parent::SetParameterSP("t_aten", 0);
        parent::SetParameterSP("valor_v", $detalle["totalservicio"]);
        parent::SetParameterSP("usuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::Close();
        //Agregado 5 Febrero 2013 jcqa
        return $resultado;
        //echo "detalle ".parent::GetSql();
        //echo "LUIS ALEJANDRO";
    }

    public function getArrayeditarCitaInformes($datos) {
        parent::ConnectionOpen("pnsEditarCitansmProgramacionPacientes", "dbweb");
        parent::SetParameterSP("cronogramaorigen", $datos["cronogramaorigen"]);
        parent::SetParameterSP("horaorigen", $datos["horaorigen"]);
        parent::SetParameterSP("cronogramadestino", $datos["cronogramadestino"]);
        parent::SetParameterSP("horadestino", $datos["horadestino"]);
        parent::SetParameterSP("codigoprogramacion", $datos["codigoprogramacion"]);
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dGrabarEditarCita($datos) {
        parent::ConnectionOpen("pnsEditarCitansmProgramacionPacientes", "dbweb");
        parent::SetParameterSP("cronogramaorigen", $datos['cronogramaOrigen']);
        parent::SetParameterSP("horaorigen", $datos['horaOrigen']);
        parent::SetParameterSP("cronogramadestino", $datos['cronogramaDestino']);
        parent::SetParameterSP("horadestino", $datos['horaDestino']);
        parent::SetParameterSP("codigoprogramacion", $datos['codigoProgramacion']);
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function getArrayeliminarCitaProgramada($datos) {
        parent::ConnectionOpen("pnsEliminarCitansmProgramacionPacientes", "dbweb");
        parent::SetParameterSP("accion", "1");
        parent::SetParameterSP("codigoCronograma", $datos["codigoCronograma"]);
        parent::SetParameterSP("codigoHora", $datos["codigoHora"]);
        parent::SetParameterSP("codigoProgramacion", "");
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", strtoupper($_SESSION['host']));
        parent::SetParameterSP("bPermiso", $datos["datosPermiso"]);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function drestaurarOrdenesTratamientoCita($datos) {

        parent::ConnectionOpen("pnsgetTratamientoPaciente", "dbweb");
        parent::SetParameterSP("@accion", '6');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("@char2", '');
        parent::SetParameterSP("@char3", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function spManteTriaje($accion, $codigoProgramacion, $peso, $talla, $temp, $frecCardiaca, $presArterial, $frecRespiratoria, $satOxigeno) {
        parent::ConnectionOpen("pnsMantenimientoTriaje", "dbweb");
        parent::SetParameterSP("accion", $accion);
        parent::SetParameterSP("codigoProgramacion", $codigoProgramacion);
        parent::SetParameterSP("nPeso", $peso);
        parent::SetParameterSP("nTalla", $talla);
        parent::SetParameterSP("nTemperatura", $temp);
        parent::SetParameterSP("iFrecuenciaCardiaca", $frecCardiaca);
        parent::SetParameterSP("vPresionArterial", $presArterial);
        parent::SetParameterSP("iFrecuenciaRespiratoria", $frecRespiratoria);
        parent::SetParameterSP("nSaturacionOxigeno", $satOxigeno);
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHost", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function spListaTriaje($codigoProgramacion) {
        parent::ConnectionOpen("pnsMantenimientoTriaje", "dbweb");
        parent::SetParameterSP("accion", 'listar');
        parent::SetParameterSP("iCodigoProgramacion", $codigoProgramacion);
        parent::SetParameterSP("nPeso", 1);
        parent::SetParameterSP("nTalla", 1);
        parent::SetParameterSP("nTemperatura", 1);
        parent::SetParameterSP("iFrecuenciaCardiaca", 1);
        parent::SetParameterSP("vPresionArterial", '1');
        parent::SetParameterSP("iFrecuenciaRespiratoria", 1);
        parent::SetParameterSP("nSaturacionOxigeno", 1);
        parent::SetParameterSP("vUsuario", '1');
        parent::SetParameterSP("vHost", '1');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function getArrayListaProgramacionTemporal($datos) {
        parent::ConnectionOpen("pnsDatosCitasInformes", "dbweb");
        parent::SetParameterSP("accion", "10");
        parent::SetParameterSP("codigoCronograma", $datos["codigoCronograma"]);
        parent::SetParameterSP("codigoHora", " ");
        parent::SetParameterSP("codigoProgramacion", "");
        parent::SetParameterSP("afiliacionactiva", "");
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    //////////////////////////////////////////////DETALLE ORDENES//////////////////////////////////////////////////

    public function DMostrarDetalleOrden($datos) {
        parent::ConnectionOpen("pnsDetalleOrden", "dbweb");
        parent::SetParameterSP("accion", "1");
        parent::SetParameterSP("codigoPersona", $datos["codPersona"]);
        parent::SetParameterSP("nroOrden", $datos["nroOrden"]);
        parent::SetParameterSP("vNombreUsuario", "");
        parent::SetParameterSP("iCodigoProgramacion", $datos["CodProgramacion"]);
        parent::SetParameterSP("idCronogramaMedico", "");
        parent::SetParameterSP("vNombreEstacion", "");
        parent::SetParameterSP("@codidoCentroCosto", "");
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function DMostrarUsuarioRegistro($datos) {
        parent::ConnectionOpen("pnsDetalleOrden", "dbweb");
        parent::SetParameterSP("accion", "2");
        parent::SetParameterSP("codigoPersona", $datos["codPersona"]);
        parent::SetParameterSP("nroOrden", "");
        parent::SetParameterSP("vNombreUsuario", "");
        parent::SetParameterSP("iCodigoProgramacion", $datos["CodProgramacion"]);
        parent::SetParameterSP("idCronogramaMedico", "");
        parent::SetParameterSP("vNombreEstacion", $datos["codcronograma"]);
        parent::SetParameterSP("@codidoCentroCosto", "");
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function DMostrarUsuarioConfirma($datos) {
        parent::ConnectionOpen("pnsDetalleOrden", "dbweb");
        parent::SetParameterSP("accion", "3");
        parent::SetParameterSP("codigoPersona", $datos["codPersona"]);
        parent::SetParameterSP("nroOrden", "");
        parent::SetParameterSP("vNombreUsuario", "");
        parent::SetParameterSP("iCodigoProgramacion", $datos["CodProgramacion"]);
        parent::SetParameterSP("idCronogramaMedico", "");
        parent::SetParameterSP("vNombreEstacion", $datos["codcronograma"]);
        parent::SetParameterSP("@codidoCentroCosto", "");
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function DMostrarUsuarioPaga($datos) {
        parent::ConnectionOpen("pnsDetalleOrden", "dbweb");
        parent::SetParameterSP("accion", "7");
        parent::SetParameterSP("codigoPersona", "");
        parent::SetParameterSP("nroOrden", $datos["nroOrden"]);
        parent::SetParameterSP("vNombreUsuario", "");
        parent::SetParameterSP("iCodigoProgramacion", "");
        parent::SetParameterSP("idCronogramaMedico", "");
        parent::SetParameterSP("vNombreEstacion", "");
        parent::SetParameterSP("@codidoCentroCosto", "");
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function DMostrarAtencionInicio($datos) {
        parent::ConnectionOpen("pnsDetalleOrden", "dbweb");
        parent::SetParameterSP("accion", "4");
        parent::SetParameterSP("codigoPersona", $datos["codPersona"]);
        parent::SetParameterSP("nroOrden", "");
        parent::SetParameterSP("vNombreUsuario", "");
        parent::SetParameterSP("iCodigoProgramacion", $datos["CodProgramacion"]);
        parent::SetParameterSP("idCronogramaMedico", "");
        parent::SetParameterSP("vNombreEstacion", $datos["codcronograma"]);
        parent::SetParameterSP("@codidoCentroCosto", "");
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function DMostrarAtencionFin($datos) {
        parent::ConnectionOpen("pnsDetalleOrden", "dbweb");
        parent::SetParameterSP("accion", "5");
        parent::SetParameterSP("codigoPersona", $datos["codPersona"]);
        parent::SetParameterSP("nroOrden", "");
        parent::SetParameterSP("vNombreUsuario", "");
        parent::SetParameterSP("iCodigoProgramacion", $datos["CodProgramacion"]);
        parent::SetParameterSP("idCronogramaMedico", "");
        parent::SetParameterSP("vNombreEstacion", $datos["codcronograma"]);
        parent::SetParameterSP("@codidoCentroCosto", "");
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function DmostrarReceta($datos) {
        parent::ConnectionOpen("pnsDetalleOrden", "dbweb");
        parent::SetParameterSP("accion", "6");
        parent::SetParameterSP("codigoPersona", "");
        parent::SetParameterSP("nroOrden", "");
        parent::SetParameterSP("vNombreUsuario", "");
        parent::SetParameterSP("iCodigoProgramacion", $datos["CodProgramacion"]);
        parent::SetParameterSP("idCronogramaMedico", "");
        parent::SetParameterSP("vNombreEstacion", "");
        parent::SetParameterSP("@codidoCentroCosto", "");
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function getArrayHorasProgramadasRestantesAngel($codigoCronograma) {
        //parent::Liberar_Parametros();
        parent::ConnectionOpen("pnsCronogramaCitasEmergencia", "dbweb");
        parent::SetParameterSP("@iOpcion", 2);
        parent::SetParameterSP("@iCodigoCronograma", $codigoCronograma);
        parent::SetParameterSP("@c_cod_ser_pro", "");
        parent::SetParameterSP("@cCodigoCentroCosto", "");
        parent::SetParameterSP("@iCodigoProgramacion", "");
        parent::SetParameterSP("@c_cod_per", "");
        parent::SetParameterSP("@dFechaServicio", "");
        parent::SetParameterSP("@vSede", "");
        parent::SetParameterSP("@iCodigoMedico", "");
        parent::SetParameterSP("@iCodigoMedico", "");
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
        //  echo $codigoCronograma;
    }

    public function getUbicacionCitas() {

        parent::ConnectionOpen("pnsDatosCitasInformes", "dbweb");
        parent::Liberar_Parametros();
        parent::SetParameterSP("accion", "12");
        parent::SetParameterSP("codigoCronograma", '');
        parent::SetParameterSP("codigoHora", "");
        parent::SetParameterSP("codigoProgramacion", "");
        parent::SetParameterSP("afiliacionactiva", "");
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        parent::Liberar_Parametros();
        return $resultado;
    }

    public function dListarCronogramaMedicoEmergencia($datos) {
        //parent::Liberar_Parametros();
        parent::ConnectionOpen("pnsCronogramaCitasEmergencia", "dbweb");
        parent::SetParameterSP("@iOpcion", 1);
        parent::SetParameterSP("@iCodigoCronograma", $datos['iCodigoCronograma']);
        parent::SetParameterSP("@c_cod_ser_pro", "");
        parent::SetParameterSP("@cCodigoCentroCosto", "");
        parent::SetParameterSP("@iCodigoProgramacion", "");
        parent::SetParameterSP("@c_cod_per", "");
        parent::SetParameterSP("@dFechaServicio", "");
        parent::SetParameterSP("@vSede", "");
        parent::SetParameterSP("@iCodigoMedico", "");
        parent::SetParameterSP("@iCodigoMedico", "");
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function dListaUbicacionCita() {
        //parent::Liberar_Parametros();
        parent::ConnectionOpen("pnsCronogramaCitasEmergencia", "dbweb");
        parent::SetParameterSP("@iOpcion", 3);
        parent::SetParameterSP("@iCodigoCronograma", '');
        parent::SetParameterSP("@c_cod_ser_pro", "");
        parent::SetParameterSP("@cCodigoCentroCosto", "");
        parent::SetParameterSP("@iCodigoProgramacion", "");
        parent::SetParameterSP("@c_cod_per", "");
        parent::SetParameterSP("@dFechaServicio", "");
        parent::SetParameterSP("@vSede", "");
        parent::SetParameterSP("@iCodigoMedico", "");
        parent::SetParameterSP("@iCodigoMedico", "");
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function dMantenimientoNumeroPlaca($datos) {
        //parent::Liberar_Parametros();
        parent::ConnectionOpen("pnsMantenimientoImagenes", "dbweb");
        parent::SetParameterSP("@var1", 1);
        parent::SetParameterSP("@var2", $datos["iCodigoProgramacion"]);
        parent::SetParameterSP("@var3", $datos["numeroPlaca"]);
        parent::SetParameterSP("@var4", $datos["observacion"]);
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function dGrabarUbicacionImagenes($datos) {
        //parent::Liberar_Parametros();
        parent::ConnectionOpen("pnsMantenimientoImagenes", "dbweb");
        parent::SetParameterSP("@var1", 4);
        parent::SetParameterSP("@var2", $datos["iCodigoProgramacion"]);
        parent::SetParameterSP("@var3", $datos["ubicacion"]);
        parent::SetParameterSP("@var4", $datos["observacion"]);
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function grabarUbicacionPlacas($datos) {
        //parent::Liberar_Parametros();
        parent::ConnectionOpen("pnsMantenimientoPlacas", "dbweb");
        parent::SetParameterSP("@var1", 1);
        parent::SetParameterSP("@var2", $datos["iCodigoProgramacion"]);
        parent::SetParameterSP("@var3", $datos["ubicacion"], 'int');
        parent::SetParameterSP("@var4", $datos["observacion"]);
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dDatosNumeroPlaca($datos) {
        //parent::Liberar_Parametros();
        parent::ConnectionOpen("pnsMantenimientoImagenes", "dbweb");
        parent::SetParameterSP("@var1", 2);
        parent::SetParameterSP("@var2", $datos["iCodigoProgramacion"]);
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@var4", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function dUbicacionesImagenes() {
        //parent::Liberar_Parametros();
        parent::ConnectionOpen("pnsMantenimientoImagenes", "dbweb");
        parent::SetParameterSP("@var1", 3);
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@var4", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function dHistorialUbicacionesImagenes($datos) {
        //parent::Liberar_Parametros();
        parent::ConnectionOpen("pnsMantenimientoImagenes", "dbweb");
        parent::SetParameterSP("@var1", 5);
        parent::SetParameterSP("@var2", $datos["iCodigoProgramacion"]);
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@var4", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function dDatosEditarCita($datos) {
        parent::Liberar_Parametros();
        parent::ConnectionOpen("pnsDatosEditarCita", "dbweb");
        parent::SetParameterSP("@var1", 1);
        parent::SetParameterSP("@var2", $datos["codigoProgramacion"]);
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@var4", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function dServicios($datos) {
        parent::Liberar_Parametros();
        parent::ConnectionOpen("pnsDatosEditarCita", "dbweb");
        parent::SetParameterSP("@var1", 3);
        parent::SetParameterSP("@var2", $datos["codigoProgramacion"]);
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@var4", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function dCargarMedicosEditarCita($datos) {
        //parent::Liberar_Parametros();
        parent::ConnectionOpen("pnsDatosEditarCita", "dbweb");
        parent::SetParameterSP("@var1", 2);
        parent::SetParameterSP("@var2", $datos["codigoProgramacion"]);
        parent::SetParameterSP("@var3", $datos["fecha"]);
        parent::SetParameterSP("@var4", $datos["c_cod_ser_pro"]);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function dUpdateUbicacionCita($datos) {
        //parent::Liberar_Parametros();
        parent::ConnectionOpen("pnsCronogramaCitasEmergencia", "dbweb");
        parent::SetParameterSP("@iOpcion", 4);
        parent::SetParameterSP("@iCodigoCronograma", $datos['iIdUbicacionCita']);
        parent::SetParameterSP("@c_cod_ser_pro", "");
        parent::SetParameterSP("@cCodigoCentroCosto", "");
        parent::SetParameterSP("@iCodigoProgramacion", $datos['iCodigoProgramacion']);
        parent::SetParameterSP("@c_cod_per", "");
        parent::SetParameterSP("@dFechaServicio", "");
        parent::SetParameterSP("@vSede", "");
        parent::SetParameterSP("@iCodigoMedico", "");
        parent::SetParameterSP("@iCodigoMedico", "");
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function DMostrarDetalleCronogramaMedico($datos) {
        parent::ConnectionOpen("pnsCronogramaCitasEmergencia", "dbweb");
        parent::SetParameterSP("@iOpcion", 5);
        parent::SetParameterSP("@iCodigoCronograma", $datos["codigoCronograma"]);
        parent::SetParameterSP("@c_cod_ser_pro", "");
        parent::SetParameterSP("@cCodigoCentroCosto", "");
        parent::SetParameterSP("@iCodigoProgramacion", "");
        parent::SetParameterSP("@c_cod_per", "");
        parent::SetParameterSP("@dFechaServicio", "");
        parent::SetParameterSP("@vSede", "");
        parent::SetParameterSP("@iCodigoMedico", "");
        parent::SetParameterSP("@iCodigoMedico", "");
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function DtablacargarMedicosAsignados($datos) {
        parent::ConnectionOpen("pnsCronogramaCitasEmergencia", "dbweb");
        parent::SetParameterSP("@iOpcion", 6);
        parent::SetParameterSP("@iCodigoCronograma", "");
        parent::SetParameterSP("@c_cod_ser_pro", $datos["c_cod_pro"]);
        parent::SetParameterSP("@cCodigoCentroCosto", "");
        parent::SetParameterSP("@iCodigoProgramacion", "");
        parent::SetParameterSP("@c_cod_per", "");
        parent::SetParameterSP("@dFechaServicio", $datos["fecha"]);
        parent::SetParameterSP("@vSede", $datos["opcionSede"]);
        parent::SetParameterSP("@iCodigoMedico", "");
        parent::SetParameterSP("@iCodigoMedico", "");
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function DguardarASignacionMedico($datos) {
        parent::ConnectionOpen("pnsCronogramaCitasEmergencia", "dbweb");
        parent::SetParameterSP("@iOpcion", 7);
        parent::SetParameterSP("@iCodigoCronograma", $datos["iCodigoCronogramaMedicoSeleccionado"]);
        parent::SetParameterSP("@c_cod_ser_pro", "");
        parent::SetParameterSP("@cCodigoCentroCosto", "");
        parent::SetParameterSP("@iCodigoProgramacion", "");
        parent::SetParameterSP("@c_cod_per", "");
        parent::SetParameterSP("@dFechaServicio", "");
        parent::SetParameterSP("@vSede", "");
        parent::SetParameterSP("@iCodigoMedico", "");
        parent::SetParameterSP("coadenaCodigoPaciente", $datos["cadenaCodigoPacienteProgramado"]);
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function dListarHistoriaCronogramaPaciente($datos) {
        parent::ConnectionOpen("pnsHistoriaPacientesCronograma", "dbweb");
        parent::SetParameterSP("@var1", 1);
        parent::SetParameterSP("@var2", $datos["iCodigoCronograma"]);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }


    public function DvalidaServicionConProcedimiento($datos) {
        parent::ConnectionOpen("pnsCronogramaCitasEmergencia", "dbweb");
        parent::SetParameterSP("@iOpcion", 8);
        parent::SetParameterSP("@iCodigoCronograma", '');
        parent::SetParameterSP("@c_cod_ser_pro", $datos["codigoservicio"]);
        parent::SetParameterSP("@cCodigoCentroCosto", "");
        parent::SetParameterSP("@iCodigoProgramacion", "");
        parent::SetParameterSP("@c_cod_per", "");
        parent::SetParameterSP("@dFechaServicio", "");
        parent::SetParameterSP("@vSede", "");
        parent::SetParameterSP("@iCodigoMedico", "");
        parent::SetParameterSP("coadenaCodigoPaciente", '');
        parent::SetParameterSP("vUsuario", '');
        parent::SetParameterSP("vHostname", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

     public function dCargarDatosLeyenda($datos) {
        parent::ConnectionOpen("pnsHistoriaPacientesCronograma", "dbweb");
        parent::SetParameterSP("@var1", 2);
        parent::SetParameterSP("@var2", $datos["iCodigoCronograma"]);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }
    

}

?>
