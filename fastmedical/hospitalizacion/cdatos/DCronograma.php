<?php

include_once("../../../pholivo/Conexion.php");
include_once("../../../pholivo/adophp/Adophp.class.php");

class DCronograma extends Adophp {

    private $cnx;

    public function __construct($cnx = '') {
        //$this->cnx = empty($cnx)?Conexion::getPgConexion():$cnx;
        $this->cnx = empty($cnx) ? Conexion::getInitDsnMSSQLSimedh() : $cnx; // Para SQL dsn Windows
        //parent::__construct($this->cnx);
        parent::__construct('Spanish', $this->cnx);
    }

    public function getArrayProfesional($usuario) {
        parent::ConnectionOpen("sel_busca_empleado", "personas");
        parent::SetParameterSP("$1", $usuario);
        parent::SetSelect("*");
        $resultado = parent::ExecuteSPArray();
        return $resultado;
    }

    public function getArrayCronogramaMedico($parametros) { //BUSQUEDA POR FECHA
        $opcionbusqueda = $parametros["opcionBusqueda"];
        $fecha = $parametros["fecha"]; //'YYYY-MM-DD'
        parent::ConnectionOpen("pa_cons_cronomed1", "dbweb");
        parent::SetParameterSP("$1", '');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", date("Y/m/d", strtotime($fecha)));
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        //print_r($resultadoArray);
        return $resultadoArray;
    }

    public function getArrayCronogramaMedicoporEspecialidad($parametros) { //BUSQUEDA POR ESPECIALIDAD
        $patron = $parametros["patron"];
        $fecha = $parametros["fecha"]; //'YYYY-MM-DD'
        parent::ConnectionOpen("pa_cons_cronomed2", "dbweb");
        parent::SetParameterSP("$1", $patron);
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        //print_r($resultadoArray);
        return $resultadoArray;
    }

    public function getArrayCronogramaMedicoporMedico($parametros) { //BUSQUEDA POR MEDICO
        $patron = $parametros["patron"];
        parent::ConnectionOpen("pa_cons_cronomed2", "dbweb");
        parent::SetParameterSP("$1", '');
        parent::SetParameterSP("$2", $patron);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        //print_r($resultadoArray);
        return $resultadoArray;
    }

    public function getArrayCronogramaMedicoporSede($parametros) {
        $opcionbusqueda = $parametros["opcionBusqueda"];
        $sede = $parametros["sede"];
        $patron = $parametros["patron"];
        parent::ConnectionOpen("PA_listarcronogramamedico", "dbweb");
        parent::SetParameterSP("opcionbusqueda", $opcionbusqueda);
        parent::SetParameterSP("sede", $sede);
        parent::SetParameterSP("patron", $patron);
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    public function getArrayCronogramaFiltroDato($parametros) {
        $fecha = $parametros["fecha"]; //'YYYY-MM-DD'
        $filtro = $parametros["filtro"];
        $dato = $parametros["dato"];
        $sede = $parametros["sede"];

        parent::ConnectionOpen("pa_cons_cronomed_filtro_dato", "dbweb");
        parent::SetParameterSP("pfiltro", $filtro);
        parent::SetParameterSP("pdato", $dato);
        parent::SetParameterSP("pfecha", date("Y/m/d", strtotime($fecha)));
        parent::SetParameterSP("sede", $sede);
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    public function getObjectCronogramaID($vidCronograma) {
        parent::ConnectionOpen("pa_cronograma_id", "dbweb");
        parent::SetParameterSP("vidCronograma", $vidCronograma);
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    function getArrayCronogramaporPersonalSalud($id_personalsalud) {
        parent::ConnectionOpen("", "dbweb");
        parent::SetParameterSP($pName, $pValue);
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    function getDisponibilidadCupos($id_cronograma) {
        parent::ConnectionOpen("pa_cronograma_id", "dbweb");
        parent::SetParameterSP("id_cronograma", $id_cronograma);
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    function getArrayProfesionalSalud($opcion, $patron1, $patron2, $patron3) {
        parent::ConnectionOpen("pa_busquedapersonalsalud", "dbweb");
        parent::SetParameterSP("patronAPaterno", $patron1); //patron de busqueda apellido paterno
        parent::SetParameterSP("patronAMaterno", $patron2); //patron de busqueda apellido materno
        parent::SetParameterSP("patronNombres", $patron3); //patron de busqueda nombres
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        //print_r($resultadoArray);
        return $resultadoArray;
    }

    /*     * ********************************** */
    /* ADMINISTRACION DEL CENTRO DE COSTOS */
    /*     * ********************************** */

    //FUNCION PARA TRAER LOS DATOS PARA EL ARBOL
    function getDatosCentroCosto() {
        parent::ConnectionOpen("pnsSeleccionaDatosCentroCostos", "dbweb");
        parent::SetParameterSP("pOpc", '1');
        parent::SetParameterSP("pCod", '');
        parent::SetParameterSP("pId", '');
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    //FUNCION PARA TRAER LOS DATOS PARA EL ARBOL COMPLETO
    function getDatosCentroCostoCompleto() {
        parent::ConnectionOpen("pnsSeleccionaDatosCentroCostos", "dbweb");
        parent::SetParameterSP("pOpc", '6');
        parent::SetParameterSP("pCod", '');
        parent::SetParameterSP("pId", '');
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    //FUNCION PARA INSERTAR LOS DATOS DE UN NUEVO ITEM
    function getDatosInsertaCentroCosto($pCodCC, $pCodJ, $pDescripcion, $pNivel, $pActivo, $pUsuario, $pAbrev, $observ, $estacion) {
        parent::ConnectionOpen("pnsAccionesCentroCostos", "dbweb");
        parent::SetParameterSP("pOpc", '1');
        parent::SetParameterSP("pId", '');
        parent::SetParameterSP("pCodCC", $pCodCC);
        parent::SetParameterSP("pCodJ", $pCodJ);
        parent::SetParameterSP("pDescripcion", $pDescripcion);
        parent::SetParameterSP("pNivel", $pNivel);
        parent::SetParameterSP("pActivo", $pActivo);
        parent::SetParameterSP("pUsuario", $pUsuario);
        parent::SetParameterSP("pAbrev", $pAbrev);
        parent::SetParameterSP("pObser", $observ);
        parent::SetParameterSP("pEstac", $estacion);
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    //FUNCION PARA ACTUALIZAR LOS DATOS DE UN ITEM
    function getDatosEditaCentroCosto($pId, $pDescripcion, $pAbrev, $pActivo, $pUsuario, $pObser, $estacion) {
        parent::ConnectionOpen("pnsAccionesCentroCostos", "dbweb");
        parent::SetParameterSP("pOpc", '2');
        parent::SetParameterSP("pId", $pId);
        parent::SetParameterSP("pCodCC", '');
        parent::SetParameterSP("pCodJ", '');
        parent::SetParameterSP("pDescripcion", $pDescripcion);
        parent::SetParameterSP("pNivel", '');
        parent::SetParameterSP("pActivo", $pActivo);
        parent::SetParameterSP("pUsuario", $pUsuario);
        parent::SetParameterSP("pAbrev", $pAbrev);
        parent::SetParameterSP("pObser", $pObser);
        parent::SetParameterSP("pEstac", $estacion);
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    //FUNCION PARA INACTIVAR A ITEM
    function getDatosEliminaCentroCosto($pId) {
        parent::ConnectionOpen("pnsAccionesCentroCostos", "dbweb");
        parent::SetParameterSP("pOpc", '3');
        parent::SetParameterSP("pId", $pId);
        parent::SetParameterSP("pCodCC", '');
        parent::SetParameterSP("pCodJ", '');
        parent::SetParameterSP("pDescripcion", '');
        parent::SetParameterSP("pNivel", '');
        parent::SetParameterSP("pActivo", '');
        parent::SetParameterSP("pUsuario", '');
        parent::SetParameterSP("pAbrev", '');
        parent::SetParameterSP("pObser", '');
        parent::SetParameterSP("pEstac", '');
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    //FUNCION PARA OBTENER EL MAYOR CODIGO JERARQUICO DE LOS ITEMS HIJOS CON EL ID DEL PADRE
    function getDatosItemCentroCosto($pId) {
        parent::ConnectionOpen("pnsCodNuevoItemArbolCCosto", "dbweb");
        parent::SetParameterSP("pId", $pId);
        //parent::SetParameterSP("pOpc", $pOpc);
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    //FUNCION PARA OBTENER EL ID DE UN ITEM A PARTIR DE SU CODIGO CC
    function getIdActual($pCodCC) {
        parent::ConnectionOpen("pnsSeleccionaDatosCentroCostos", "dbweb");
        parent::SetParameterSP("pOpc", '4');
        parent::SetParameterSP("pCod", $pCodCC);
        parent::SetParameterSP("pId", '');
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getCodigoActual($pId) {
        parent::ConnectionOpen("pnsSeleccionaDatosCentroCostos", "dbweb");
        parent::SetParameterSP("pOpc", '7');
        parent::SetParameterSP("pCod", '');
        parent::SetParameterSP("pId", $pId);
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    //FUNCION PARA OBTENER EL ID DE UN ITEM A PARTIR DE SU CODIGO CC
    function getNombreActual($pCodCC) {
        parent::ConnectionOpen("pnsSeleccionaDatosCentroCostos", "dbweb");
        parent::SetParameterSP("pOpc", '5');
        parent::SetParameterSP("pCod", $pCodCC);
        parent::SetParameterSP("pId", '');
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    //FUNCION PARA OBTENER LOS DATOS A MOSTRAR DE UN ITEM SELECCIONADO
    function getDatosVerCentroCosto($pCodCC, $pId) {
        parent::ConnectionOpen("pnsSeleccionaDatosCentroCostos", "dbweb");
        parent::SetParameterSP("pOpc", '2');
        parent::SetParameterSP("pCod", $pCodCC);
        parent::SetParameterSP("pId", $pId);
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    //FUNCION PARA MOSTRAR LOS DATOS DEL PAPA DE UN ITEM SELECCIONADO
    function getDatosVerPapaCC($pCodCC, $pId) {
        parent::ConnectionOpen("pnsSeleccionaDatosCentroCostos", "dbweb");
        parent::SetParameterSP("pOpc", '3');
        parent::SetParameterSP("pCod", $pCodCC);
        parent::SetParameterSP("pId", $pId);
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    /* ----------------CRONOGRAMACITASINFORMES------------------------ */

    public function getCantidadOptimaFechas($datos) {
        //print_r($datos);
        $horarioinicio = 7;
        $horariofinal = 15;
        parent::ConnectionOpen("pnsCronogramaMedico", "dbweb");
        parent::SetParameterSP("accion", "9");
        parent::SetParameterSP("fecha", $datos['fecha']);
        parent::SetParameterSP("horarioinicio", $horarioinicio);
        parent::SetParameterSP("horariofinal", $horariofinal);
        parent::SetParameterSP("iCodigoProgramacion", "");
        parent::SetParameterSP("codigoservicio", $datos['codigoservicio']);
        parent::SetParameterSP("codigoPersonalSalud", $datos['codigoPersonalSalud']);
        parent::SetParameterSP("sede", $datos['sede']);
        parent::SetParameterSP("contadoroptimofechas", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    public function getArrayCabeceraCronogramaInformes($datos) {
        $horarioinicio = 7;
        $horariofinal = 15;
        parent::ConnectionOpen("pnsCronogramaMedico", "dbweb");
        parent::SetParameterSP("accion", ($datos['opcionBusqueda'] - 1));
        parent::SetParameterSP("fecha", $datos['fecha']);
        parent::SetParameterSP("horarioinicio", $horarioinicio);
        parent::SetParameterSP("horariofinal", $horariofinal);
        parent::SetParameterSP("iCodigoProgramacion", "");
        parent::SetParameterSP("codigoservicio", $datos['codigoservicio']);
        parent::SetParameterSP("codigoPersonalSalud", $datos['codigoPersonalSalud']);
        parent::SetParameterSP("sede", $datos['sede']);
        parent::SetParameterSP("contadoroptimofechas", $datos['contadoroptimofechas']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    public function getArraySubCabeceraCronogramaInformes($datos) {
        $horarioinicio = 7;
        $horariofinal = 15;
        parent::ConnectionOpen("pnsCronogramaMedico", "dbweb");
        parent::SetParameterSP("accion", $datos['opcionBusqueda']);
        parent::SetParameterSP("fecha", $datos['fecha']);
        parent::SetParameterSP("horarioinicio", $horarioinicio);
        parent::SetParameterSP("horariofinal", $horariofinal);
        parent::SetParameterSP("iCodigoProgramacion", "");
        parent::SetParameterSP("codigoservicio", $datos['codigoservicio']);
        parent::SetParameterSP("codigoPersonalSalud", $datos['codigoPersonalSalud']);
        parent::SetParameterSP("sede", $datos['sede']);
        parent::SetParameterSP("contadoroptimofechas", $datos['contadoroptimofechas']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayProgramacionPacientes($n_nro_prog, $datos) {
        $horarioinicio = 7;
        $horariofinal = 15;
        parent::ConnectionOpen("pnsCronogramaMedico", "dbweb");
        parent::SetParameterSP("accion", 3);
        parent::SetParameterSP("fecha", $datos['fecha']);
        parent::SetParameterSP("horarioinicio", $horarioinicio);
        parent::SetParameterSP("horariofinal", $horariofinal);
        parent::SetParameterSP("iCodigoProgramacion", $n_nro_prog);
        parent::SetParameterSP("codigoservicio", $datos['codigoservicio']);
        parent::SetParameterSP("codigoPersonalSalud", "");
        parent::SetParameterSP("sede", $datos['sede']);
        parent::SetParameterSP("contadoroptimofechas", $datos['contadoroptimofechas']);
        $resultadoArray = parent::executeSPArrayX();
        //echo parent::GetSql();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getDatosServiciosProgramados($datos) {
        parent::ConnectionOpen("pnsgeneraTablaServiciosProgramados", "dbweb");
        parent::SetParameterSP("parametroBusqueda", $datos["parametroBusqueda"]);
        parent::SetParameterSP("codigoactividad", $datos["codigoactividad"]);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getdatosdecronograma($datos) {
        $horarioinicio = 7;
        $horariofinal = 15;
        parent::ConnectionOpen("pnsCronogramaMedico", "dbweb");
        parent::SetParameterSP("accion", 7);
        parent::SetParameterSP("fecha", "");
        parent::SetParameterSP("horarioinicio", $horarioinicio);
        parent::SetParameterSP("horariofinal", $horariofinal);
        parent::SetParameterSP("iCodigoProgramacion", $datos['codigoCronograma']);
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("codigoPersonalSalud", "");
        parent::SetParameterSP("sede", "");
        parent::SetParameterSP("contadoroptimofechas", "");
        $resultadoArray = parent::executeSPArrayX();
        //echo parent::GetSql();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    /////////////////////////////////////////////////

    public function dtraerDatosCronogramaProgramado($datos) {

        parent::ConnectionOpen("pnsgetTratamientoPaciente", "dbweb");
        parent::SetParameterSP("@accion", '6');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos['hidcolumnaorigen']);
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

    //////////////////////////////////////////////////

    /* ----------------PROGRAMACIONMEDICOS------------------------ */

    function getArrayProfesionalMedicos($datos) {
        parent::ConnectionOpen("pnsProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 1);
        parent::SetParameterSP("idCentroCosto", $datos["idCentroCosto"]);
        parent::SetParameterSP("codigoPersona", "");
        parent::SetParameterSP("codigoPuesto", "");
        parent::SetParameterSP("codigoAmbienteLogico", "");
        parent::SetParameterSP("codigoActividad", "");
        parent::SetParameterSP("codigoSede", "");
        parent::SetParameterSP("horainicio", '0');
        parent::SetParameterSP("horafinal", '0');
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("mesprogramacion", "");
        parent::SetParameterSP("anioprogramacion", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayEstadisticaMensualMedico($datos) {
        parent::ConnectionOpen("pnsProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 12);
        parent::SetParameterSP("idCentroCosto", "");
        parent::SetParameterSP("codigomedico", $datos["codigomedico"]); // codigopersona
        parent::SetParameterSP("codigoPuesto", "");
        parent::SetParameterSP("codigoAmbienteLogico", "");
        parent::SetParameterSP("codigoActividad", "");
        parent::SetParameterSP("codigoSede", "");
        parent::SetParameterSP("horainicio", '0');
        parent::SetParameterSP("horafinal", '0');
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("mesprogramacion", $datos["messeleccionMedicos"]);
        parent::SetParameterSP("anioprogramacion", $datos["anioseleccionMedicos"]);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayProgramacionMedico($datos) {
        parent::ConnectionOpen("pnsProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 9);
        parent::SetParameterSP("idCentroCosto", "");
        parent::SetParameterSP("codigoPersona", $datos["codigopersona"]);
        parent::SetParameterSP("codigoPuesto", "");
        parent::SetParameterSP("codigoAmbienteLogico", "");
        parent::SetParameterSP("codigoActividad", "");
        parent::SetParameterSP("codigoSede", $datos["codigosede"]);
        parent::SetParameterSP("horainicio", '0');
        parent::SetParameterSP("horafinal", '0');
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("mesprogramacion", $datos["mesprogramacion"]);
        parent::SetParameterSP("anioprogramacion", $datos["anioprogramacion"]);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayPuestos($datos) {
        parent::ConnectionOpen("pnsProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 2);
        parent::SetParameterSP("idCentroCosto", $datos["idcentrocosto"]);
        parent::SetParameterSP("codigoPersona", $datos["codigopersona"]);
        parent::SetParameterSP("codigoPuesto", "");
        parent::SetParameterSP("codigoAmbienteLogico", "");
        parent::SetParameterSP("codigoActividad", "");
        parent::SetParameterSP("codigoSede", "");
        parent::SetParameterSP("horainicio", '0');
        parent::SetParameterSP("horafinal", '0');
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("mesprogramacion", "");
        parent::SetParameterSP("anioprogramacion", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayServicios($datos) {
        parent::ConnectionOpen("pnsProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 3);
        parent::SetParameterSP("idCentroCosto", "");
        parent::SetParameterSP("codigoPersona", "");
        parent::SetParameterSP("codigoPuesto", $datos["codigoPuesto"]);
        parent::SetParameterSP("codigoAmbienteLogico", "");
        parent::SetParameterSP("codigoActividad", "");
        parent::SetParameterSP("codigoSede", "");
        parent::SetParameterSP("horainicio", '0');
        parent::SetParameterSP("horafinal", '0');
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("mesprogramacion", "");
        parent::SetParameterSP("anioprogramacion", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArraylistaAmbientes($datos) {
        parent::ConnectionOpen("pnsProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 4);
        parent::SetParameterSP("idCentroCosto", $datos["idCentroCosto"]);
        parent::SetParameterSP("codigoPersona", "");
        parent::SetParameterSP("codigoPuesto", "");
        parent::SetParameterSP("codigoAmbienteLogico", "");
        parent::SetParameterSP("codigoActividad", "");
        parent::SetParameterSP("codigoSede", $datos["codigosede"]);
        parent::SetParameterSP("horainicio", '0');
        parent::SetParameterSP("horafinal", '0');
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("mesprogramacion", "");
        parent::SetParameterSP("anioprogramacion", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function spListaAmbienteLogicoPorPuesto($datos) {//Junnior
        parent::ConnectionOpen("pnsFiltradoAmbientesXSede", "dbweb");
        parent::SetParameterSP("accion", 1);
        parent::SetParameterSP("idCentroCosto", "");
        parent::SetParameterSP("codigoPersona", "");
        parent::SetParameterSP("idPuesto", $datos["idPuesto"]);
        parent::SetParameterSP("codigoAmbienteLogico", "");
        parent::SetParameterSP("codigoActividad", "");
        parent::SetParameterSP("codigoSede", $datos["codigosede"]);
        parent::SetParameterSP("horainicio", '0');
        parent::SetParameterSP("horafinal", '0');
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("mesprogramacion", "");
        parent::SetParameterSP("anioprogramacion", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function spListaServiciosPorActividadDeCentroCosto($datos) {//Junnior
        parent::ConnectionOpen("pnsProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 14);
        parent::SetParameterSP("idCentroCosto", "");
        parent::SetParameterSP("codigoPersona", "");
        parent::SetParameterSP("idPuesto", $datos["idPuesto"]);
        parent::SetParameterSP("codigoAmbienteLogico", "");
        parent::SetParameterSP("codigoActividad", $datos["codigoActividad"]);
        parent::SetParameterSP("codigoSede", "");
        parent::SetParameterSP("horainicio", '0');
        parent::SetParameterSP("horafinal", '0');
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("mesprogramacion", "");
        parent::SetParameterSP("anioprogramacion", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayAmbientesFisicos($datos) {
        parent::ConnectionOpen("pnsProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 5);
        parent::SetParameterSP("idCentroCosto", "");
        parent::SetParameterSP("codigoPersona", "");
        parent::SetParameterSP("codigoPuesto", "");
        parent::SetParameterSP("codigoAmbienteLogico", $datos["codigoAmbienteLogico"]);
        parent::SetParameterSP("codigoActividad", $datos["codigoActividad"]);
        parent::SetParameterSP("codigoSede", $datos["codigoSede"]);
        parent::SetParameterSP("horainicio", '0');
        parent::SetParameterSP("horafinal", '0');
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("mesprogramacion", "");
        parent::SetParameterSP("anioprogramacion", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayTurnos($datos) {
        parent::ConnectionOpen("pnsProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 6);
        parent::SetParameterSP("idCentroCosto", "");
        parent::SetParameterSP("codigoPersona", "");
        parent::SetParameterSP("codigoPuesto", "");
        parent::SetParameterSP("codigoAmbienteLogico", "");
        parent::SetParameterSP("codigoActividad", "");
        parent::SetParameterSP("codigoSede", "");
        parent::SetParameterSP("horainicio", $datos["turno"]);
        parent::SetParameterSP("horafinal", '0');
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("mesprogramacion", "");
        parent::SetParameterSP("anioprogramacion", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getTiempoAtencion($datos) {
        parent::ConnectionOpen("pnsProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 7);
        parent::SetParameterSP("idCentroCosto", "");
        parent::SetParameterSP("codigoPersona", "");
        parent::SetParameterSP("codigoPuesto", "");
        parent::SetParameterSP("codigoAmbienteLogico", "");
        parent::SetParameterSP("codigoActividad", "");
        parent::SetParameterSP("codigoSede", "");
        parent::SetParameterSP("horainicio", '0');
        parent::SetParameterSP("horafinal", '0');
        parent::SetParameterSP("codigoservicio", $datos["codigoservicio"]);
        parent::SetParameterSP("mesprogramacion", "");
        parent::SetParameterSP("anioprogramacion", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getcodigoTurno($datos) {
        parent::ConnectionOpen("pnsProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 8);
        parent::SetParameterSP("idCentroCosto", "");
        parent::SetParameterSP("codigoPersona", "");
        parent::SetParameterSP("codigoPuesto", "");
        parent::SetParameterSP("codigoAmbienteLogico", "");
        parent::SetParameterSP("codigoActividad", "");
        parent::SetParameterSP("codigoSede", "");
        parent::SetParameterSP("horainicio", $datos["horainicio"]);
        parent::SetParameterSP("horafinal", $datos["horafinal"]);
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("mesprogramacion", "");
        parent::SetParameterSP("anioprogramacion", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayAfiliacionesNOAsignadas() {
        parent::ConnectionOpen("pnsProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 10);
        parent::SetParameterSP("idCentroCosto", "");
        parent::SetParameterSP("codigoPersona", "");
        parent::SetParameterSP("codigoPuesto", "");
        parent::SetParameterSP("codigoAmbienteLogico", "");
        parent::SetParameterSP("codigoActividad", "");
        parent::SetParameterSP("codigoSede", "");
        parent::SetParameterSP("horainicio", '0');
        parent::SetParameterSP("horafinal", '0');
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("mesprogramacion", "");
        parent::SetParameterSP("anioprogramacion", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayAfiliacionesNOAsignadasPopad($datos) {
        parent::ConnectionOpen("pnsCronogramaAfiliacion", "dbweb");
        parent::SetParameterSP("accion", 3);
        parent::SetParameterSP("pv1", $datos["codCronograma"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        parent::SetParameterSP("pv5", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayAfiliacionesAsignadasPopad($datos) {
        parent::ConnectionOpen("pnsCronogramaAfiliacion", "dbweb");
        parent::SetParameterSP("accion", 4);
        parent::SetParameterSP("pv1", $datos["codProg"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        parent::SetParameterSP("pv5", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayAfiliacionesAsignadas() {
        parent::ConnectionOpen("pnsProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 11);
        parent::SetParameterSP("idCentroCosto", "");
        parent::SetParameterSP("codigoPersona", "");
        parent::SetParameterSP("codigoPuesto", "");
        parent::SetParameterSP("codigoAmbienteLogico", "");
        parent::SetParameterSP("codigoActividad", "");
        parent::SetParameterSP("codigoSede", "");
        parent::SetParameterSP("horainicio", '0');
        parent::SetParameterSP("horafinal", '0');
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("mesprogramacion", "");
        parent::SetParameterSP("anioprogramacion", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function grabarProgramacionMedicos($datos) {
        parent::ConnectionOpen("pnsMantProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 1);
        parent::SetParameterSP("codigocronograma", "");
        parent::SetParameterSP("codigopersona", $datos["codigopersona"]);
        parent::SetParameterSP("codigoambientelogico", $datos["codigoambientelogico"]);
        parent::SetParameterSP("codigoturno", $datos["codigoturno"]);
        parent::SetParameterSP("fechasservicios", $datos["fechasservicios"]);
        parent::SetParameterSP("codigoservicio", $datos["codigoservicio"]);
        parent::SetParameterSP("cupostotales", $datos["cupostotales"]);
        parent::SetParameterSP("cuposadicionales", $datos["cuposadicionales"]);
        parent::SetParameterSP("codigoambientefisico", $datos["codigoambientefisico"]);
        parent::SetParameterSP("codigoactividad", $datos["codigoactividad"]);
        parent::SetParameterSP("idpuestoempleado", $datos["idpuestoempleado"]);
        parent::SetParameterSP("afiliaciones", $datos["afiliaciones"]);
        parent::SetParameterSP("tiempoatencion", $datos["tiempoatencion"]);
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", strtoupper($_SESSION['host']));
        parent::SetParameterSP("bProgramado", $datos["bProgramado"]);
        parent::SetParameterSP("dFechaProgramado", $datos["dFechaProgramado"]);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function eliminarProgramacionMedicos($datos) {
        parent::ConnectionOpen("pnsMantProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 2);
        parent::SetParameterSP("codigocronograma", $datos["codigocronograma"]);
        parent::SetParameterSP("codigopersona", "");
        parent::SetParameterSP("codigoambientelogico", "");
        parent::SetParameterSP("codigoturno", "");
        parent::SetParameterSP("fechasservicios", "");
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("cupostotales", "");
        parent::SetParameterSP("cuposadicionales", "");
        parent::SetParameterSP("codigoambientefisico", "");
        parent::SetParameterSP("codigoactividad", "");
        parent::SetParameterSP("idpuestoempleado", "");
        parent::SetParameterSP("afiliaciones", $datos["motivo"]);
        parent::SetParameterSP("tiempoatencion", "");
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", $_SESSION['host']);
        parent::SetParameterSP("bProgramado", '');
        parent::SetParameterSP("dFechaProgramado", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function traerMotivoEliminacion($datos) {
        parent::ConnectionOpen("pnsMantProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 6);
        parent::SetParameterSP("codigocronograma", $datos["codProgramacion"]);
        parent::SetParameterSP("codigopersona", "");
        parent::SetParameterSP("codigoambientelogico", "");
        parent::SetParameterSP("codigoturno", "");
        parent::SetParameterSP("fechasservicios", "");
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("cupostotales", "");
        parent::SetParameterSP("cuposadicionales", "");
        parent::SetParameterSP("codigoambientefisico", "");
        parent::SetParameterSP("codigoactividad", "");
        parent::SetParameterSP("idpuestoempleado", "");
        parent::SetParameterSP("afiliaciones", "");
        parent::SetParameterSP("tiempoatencion", "");
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", $_SESSION['host']);
        parent::SetParameterSP("bProgramado", '');
        parent::SetParameterSP("dFechaProgramado", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayProgramacionAmbientesFisicos($datos) {
        parent::ConnectionOpen("pnsMantProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 3);
        parent::SetParameterSP("codigocronograma", "");
        parent::SetParameterSP("codigopersona", "");
        parent::SetParameterSP("codigoambientelogico", "");
        parent::SetParameterSP("codigoturno", "");
        parent::SetParameterSP("fechasservicios", $datos["fechas"]);
        parent::SetParameterSP("codigoservicio", "");
        parent::SetParameterSP("cupostotales", "");
        parent::SetParameterSP("cuposadicionales", "");
        parent::SetParameterSP("codigoambientefisico", $datos["codigoambientefisico"]);
        parent::SetParameterSP("codigoactividad", "");
        parent::SetParameterSP("idpuestoempleado", "");
        parent::SetParameterSP("afiliaciones", "");
        parent::SetParameterSP("tiempoatencion", "");
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", $_SESSION['host']);
        parent::SetParameterSP("bProgramado", '');
        parent::SetParameterSP("dFechaProgramado", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    /*     * ***************************REPROGRAMACION MEDICOS*********************** */

    function getArrayDatosProgramacionMedicos($datos) {
        parent::ConnectionOpen("pnsMantReProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 1);
        parent::SetParameterSP("codigocronograma", $datos["codigocronograma"]);
        parent::SetParameterSP("codigoempleado", "");
        parent::SetParameterSP("codigopuesto", "");
        parent::SetParameterSP("tipoactualizacion", "");
        parent::SetParameterSP("codigoturno", "");
        parent::SetParameterSP("ambientefisico", "");
        parent::SetParameterSP("cantidadadicionales", "");
        parent::SetParameterSP("cantidadcupos", "");
        parent::SetParameterSP("numerodocumento", "");
        parent::SetParameterSP("claveautogenerada", "");
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function actualizarCronogramaReProgramacionMedicos($datos) {
        parent::ConnectionOpen("pnsMantReProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 2);
        parent::SetParameterSP("codigocronograma", $datos["codigocronograma"]);
        parent::SetParameterSP("codigoempleado", "");
        parent::SetParameterSP("codigopuesto", "");
        parent::SetParameterSP("tipoactualizacion", $datos["tipoactualizacion"]);
        parent::SetParameterSP("codigoturno", $datos["codigoturno"]);
        parent::SetParameterSP("ambientefisico", $datos["ambientefisico"]);
        parent::SetParameterSP("cantidadadicionales", $datos["cantidadadicionales"]);
        parent::SetParameterSP("cantidadcupos", $datos["cantidadcupos"]);
        parent::SetParameterSP("numerodocumento", "");
        parent::SetParameterSP("claveautogenerada", "");
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function spMantenimientoReprogramarMedico($datos) {
        parent::ConnectionOpen("pnsMantenimientoReprogramarMedico", "dbweb");
        parent::SetParameterSP("accion", 1);
        parent::SetParameterSP("iCodigoCronograma", $datos["iCodigoCronograma"]);
        parent::SetParameterSP("cCodigoAmbienteLogicoNuevo", $datos["cCodigoAmbienteLogicoNuevo"]);
        parent::SetParameterSP("iCodigoAmbienteFisicoNuevo", $datos["iCodigoAmbienteFisicoNuevo"]);
        parent::SetParameterSP("iCodigoEmpleadoNuevo", 0);
        parent::SetParameterSP("iidPuestoNuevo", 0);
        parent::SetParameterSP("bReprogramado", 0);
        parent::SetParameterSP("tMotivoReprogramacion", $datos["vTxtAreaMotivoDelCambioAmbiente"] );
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHost", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function generarCodigoAutorizacionProgramacionMedicos($datos) {
        parent::ConnectionOpen("pnsMantReProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 3);
        parent::SetParameterSP("codigocronograma", $datos["codigocronograma"]);
        parent::SetParameterSP("codigoempleado", "");
        parent::SetParameterSP("codigopuesto", "");
        parent::SetParameterSP("tipoactualizacion", "");
        parent::SetParameterSP("codigoturno", "");
        parent::SetParameterSP("ambientefisico", "");
        parent::SetParameterSP("cantidadadicionales", "");
        parent::SetParameterSP("cantidadcupos", "");
        parent::SetParameterSP("numerodocumento", $datos["numerodocumento"]);
        parent::SetParameterSP("claveautogenerada", $datos["claveautogenerada"]);
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    /* function validarAutorizacionProgramacionMedicos($datos) {
      parent::ConnectionOpen("pnsMantReProgramacionMedicos","dbweb");
      parent::SetParameterSP("accion", 4);
      parent::SetParameterSP("codigocronograma",$datos["codigocronograma"]);
      parent::SetParameterSP("codigoempleado","");
      parent::SetParameterSP("codigopuesto","");
      parent::SetParameterSP("tipoactualizacion","");
      parent::SetParameterSP("codigoturno","");
      parent::SetParameterSP("ambientefisico","");
      parent::SetParameterSP("cantidadadicionales","");
      parent::SetParameterSP("cantidadcupos","");
      parent::SetParameterSP("numerodocumento","");
      parent::SetParameterSP("claveautorizacion",$datos["claveautorizacion"]);
      parent::SetParameterSP("vNombreUsuario","");
      parent::SetParameterSP("vNombreEstacion","");
      $resultadoArray = parent::executeSPArrayX();
      parent::ConnectionClose();
      return $resultadoArray;
      } */

    function getArrayMedicosparaReprogramacionMedicos($datos) {
        parent::ConnectionOpen("pnsEmpleadoBusqueda", "dbweb");
        parent::SetParameterSP("$1", '08');
        parent::SetParameterSP("$2", $datos["iCodigoCronograma"]);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function grabarReprogramacionMedicos($datos) {
        parent::ConnectionOpen("pnsMantenimientoReprogramarMedico", "dbweb");
        parent::SetParameterSP("accion", 2);
        parent::SetParameterSP("iCodigoCronograma", $datos["iCodigoCronograma"]);
        parent::SetParameterSP("cCodigoAmbienteLogicoNuevo", "");
        parent::SetParameterSP("iCodigoAmbienteFisicoNuevo", 0);
        parent::SetParameterSP("iCodigoEmpleadoNuevo", $datos["iCodigoEmpleadoNuevo"]);
        parent::SetParameterSP("iidPuestoNuevo", $datos["iidPuestoNuevo"]);
        parent::SetParameterSP("bReprogramado", 1);
        parent::SetParameterSP("tMotivoReprogramacion", $datos["tMotivoReprogramacion"]);
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHost", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    /* function grabarReprogramacionMedicos($datos) {
      parent::ConnectionOpen("pnsMantReProgramacionMedicos","dbweb");
      parent::SetParameterSP("accion", 5);
      parent::SetParameterSP("codigocronograma",$datos["codigocronograma"]);
      parent::SetParameterSP("codigoempleado",$datos["codigoempleado"]);
      parent::SetParameterSP("codigopuesto",$datos["codigopuesto"]);
      parent::SetParameterSP("tipoactualizacion","");
      parent::SetParameterSP("codigoturno","");
      parent::SetParameterSP("ambientefisico","");
      parent::SetParameterSP("cantidadadicionales","");
      parent::SetParameterSP("cantidadcupos","");
      parent::SetParameterSP("numerodocumento","");
      parent::SetParameterSP("claveautorizacion",$datos["claveautorizacion"]);
      parent::SetParameterSP("vNombreUsuario",strtoupper($_SESSION["login_user"]));
      parent::SetParameterSP("vNombreEstacion",$_SESSION['host']);
      $resultadoArray = parent::executeSPArrayX();
      parent::ConnectionClose();
      return $resultadoArray;
      } */

    function getArrayAfiliacionesXCronograma($datos) {
        parent::ConnectionOpen("pnsMantReProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 6);
        parent::SetParameterSP("codigocronograma", $datos["codigocronograma"]);
        parent::SetParameterSP("codigoempleado", "");
        parent::SetParameterSP("codigopuesto", "");
        parent::SetParameterSP("tipoactualizacion", "");
        parent::SetParameterSP("codigoturno", "");
        parent::SetParameterSP("ambientefisico", "");
        parent::SetParameterSP("cantidadadicionales", "");
        parent::SetParameterSP("cantidadcupos", "");
        parent::SetParameterSP("numerodocumento", "");
        parent::SetParameterSP("claveautorizacion", "");
        parent::SetParameterSP("vNombreUsuario", "");
        parent::SetParameterSP("vNombreEstacion", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dguardarAfiliacionesXMedico($datos) {
        $arrayDatos = explode("|", $datos["arrayseleccionados"]);
        $numGrabaciones = count($arrayDatos);
        for ($x = 0; $x <= $numGrabaciones - 1; $x++) {
            parent::Liberar_Parametros();
            parent::ConnectionOpen("pnsCronogramaAfiliacion", "dbweb");
            parent::SetParameterSP("accion", 1);
            parent::SetParameterSP("pv1", $arrayDatos[$x]);
            parent::SetParameterSP("pv2", $datos["codCronograma"]);
            parent::SetParameterSP("pv3", strtoupper($_SESSION["login_user"]));
            parent::SetParameterSP("pv4", $_SESSION['host']);
            parent::SetParameterSP("pv5", "");
            $resultadoArray = parent::executeSPArrayX();
            parent::ConnectionClose();
        }
        return $resultadoArray;
    }

    function EliminarAfiliacionesXMedico($datos) {
        // parent::Liberar_Parametros();
        parent::ConnectionOpen("pnsCronogramaAfiliacion", "dbweb");
        parent::SetParameterSP("accion", 2);
        parent::SetParameterSP("pv1", $datos["codCronograma"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        parent::SetParameterSP("pv5", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function buscarProximaCita($datos) {
        parent::ConnectionOpen("nsmBuscarSiguienteCita", "dbweb");
        parent::SetParameterSP("bus", $datos['busqueda']);
        parent::SetParameterSP("servicio", $datos['servicio']);
        parent::SetParameterSP("sede", $datos['sede']);
        parent::SetParameterSP("fecha", $datos['fecha']);
        parent::SetParameterSP("persona", $datos['persona']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function traerDatosProgramacion($datos) {
        parent::ConnectionOpen("pnsMantProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 4);
        parent::SetParameterSP("codigocronograma", $datos["codigocronograma"]);
        parent::SetParameterSP("codigopersona", '');
        parent::SetParameterSP("codigoambientelogico", '');
        parent::SetParameterSP("codigoturno", '');
        parent::SetParameterSP("fechasservicios", '');
        parent::SetParameterSP("codigoservicio", '');
        parent::SetParameterSP("cupostotales", '');
        parent::SetParameterSP("cuposadicionales", '');
        parent::SetParameterSP("codigoambientefisico", '');
        parent::SetParameterSP("codigoactividad", '');
        parent::SetParameterSP("idpuestoempleado", '');
        parent::SetParameterSP("afiliaciones", '');
        parent::SetParameterSP("tiempoatencion", '');
        parent::SetParameterSP("vNombreUsuario", '');
        parent::SetParameterSP("vNombreEstacion", '');
        parent::SetParameterSP("bProgramado", '');
        parent::SetParameterSP("dFechaProgramado", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function guardarMantenimientoPRogramado($datos) {
        parent::ConnectionOpen("pnsMantProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 5);
        parent::SetParameterSP("codigocronograma", $datos["codigocronograma"]);
        parent::SetParameterSP("codigopersona", '');
        parent::SetParameterSP("codigoambientelogico", '');
        parent::SetParameterSP("codigoturno", '');
        parent::SetParameterSP("fechasservicios", '');
        parent::SetParameterSP("codigoservicio", '');
        parent::SetParameterSP("cupostotales", '');
        parent::SetParameterSP("cuposadicionales", '');
        parent::SetParameterSP("codigoambientefisico", '');
        parent::SetParameterSP("codigoactividad", '');
        parent::SetParameterSP("idpuestoempleado", '');
        parent::SetParameterSP("afiliaciones", '');
        parent::SetParameterSP("tiempoatencion", '');
        parent::SetParameterSP("vNombreUsuario", '');
        parent::SetParameterSP("vNombreEstacion", '');
        parent::SetParameterSP("bProgramado", $datos["bProgramacion"]);
        parent::SetParameterSP("dFechaProgramado", $datos["dFechaProgramacion"]);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function mostrarEdicionProgramacion($datos) {
        parent::ConnectionOpen("pnsLogCronogramaMedico", "dbweb");
        parent::SetParameterSP("accion", 1);
        parent::SetParameterSP("iCodigoCronograma", $datos["codProgramacion"]);
        parent::SetParameterSP("iCantidad", '');
        parent::SetParameterSP("vHost", $_SESSION['host']);
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("imes", '');
        parent::SetParameterSP("ianio", '');
        parent::SetParameterSP("vCodigoPersona", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;
    }

    function dCantidadAdicionales($datos) {
        parent::ConnectionOpen("pnsLogCronogramaMedico", "dbweb");
        parent::SetParameterSP("accion", 2);
        parent::SetParameterSP("iCodigoCronograma", $datos["iCodigoCronograma"]);
        parent::SetParameterSP("iCantidad", '');
        parent::SetParameterSP("vHost", $_SESSION['host']);
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("imes", '');
        parent::SetParameterSP("ianio", '');
        parent::SetParameterSP("vCodigoPersona", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;
    }


    function consultarAmbienteFisico($datos) {
        parent::ConnectionOpen("pnsMantReProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 7);
        parent::SetParameterSP("codigocronograma", $datos["codigocronograma"]);
        parent::SetParameterSP("codigoempleado", "");
        parent::SetParameterSP("codigopuesto", "");
        parent::SetParameterSP("tipoactualizacion", "");
        parent::SetParameterSP("codigoturno", "");
        parent::SetParameterSP("ambientefisico", "");
        parent::SetParameterSP("cantidadadicionales", "");
        parent::SetParameterSP("cantidadcupos", "");
        parent::SetParameterSP("numerodocumento", "");
        parent::SetParameterSP("claveautogenerada", "");
        parent::SetParameterSP("vNombreUsuario", '');
        parent::SetParameterSP("vNombreEstacion", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function DconsultarSede($datos) {
        parent::ConnectionOpen("pnsMantReProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 8);
        parent::SetParameterSP("codigocronograma", $datos["codigocronograma"]);
        parent::SetParameterSP("codigoempleado", "");
        parent::SetParameterSP("codigopuesto", "");
        parent::SetParameterSP("tipoactualizacion", "");
        parent::SetParameterSP("codigoturno", "");
        parent::SetParameterSP("ambientefisico", "");
        parent::SetParameterSP("cantidadadicionales", "");
        parent::SetParameterSP("cantidadcupos", "");
        parent::SetParameterSP("numerodocumento", "");
        parent::SetParameterSP("claveautogenerada", "");
        parent::SetParameterSP("vNombreUsuario", '');
        parent::SetParameterSP("vNombreEstacion", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }
    
    function DcargarComboAmbienteFisicoReprogramacionMedicoNuevo($datos) {
        parent::ConnectionOpen("pnsMantReProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 9);
        parent::SetParameterSP("codigocronograma", '');
        parent::SetParameterSP("codigoempleado", "");
        parent::SetParameterSP("codigopuesto", "");
        parent::SetParameterSP("tipoactualizacion", "");
        parent::SetParameterSP("codigoturno", "");
        parent::SetParameterSP("ambientefisico", $datos['idAmbienteslogicos']);
        parent::SetParameterSP("cantidadadicionales", "");
        parent::SetParameterSP("cantidadcupos", "");
        parent::SetParameterSP("numerodocumento", "");
        parent::SetParameterSP("claveautogenerada", "");
        parent::SetParameterSP("vNombreUsuario", '');
        parent::SetParameterSP("cidSedeEmpresa", $datos['cidSedeEmpresa'] );
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }



    function dGuardarCambiosLogADicionales($datos) {
        parent::ConnectionOpen("pnsLogCronogramaMedico", "dbweb");
        parent::SetParameterSP("accion", 3);
        parent::SetParameterSP("iCodigoCronograma", $datos["iCodigoCronograma"]);
        parent::SetParameterSP("iCantidad", $datos["iCantidad"]);
        parent::SetParameterSP("vHost", $_SESSION['host']);
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("imes", '');
        parent::SetParameterSP("ianio", '');
        parent::SetParameterSP("vCodigoPersona", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;
    }

    
    function seleccionarTurnoProgramacionMedico($datos){
        parent::ConnectionOpen("pnsMantTurnoProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 1);
        parent::SetParameterSP("iCodigoCronograma", $datos["codigocronograma"],"INT");
        parent::SetParameterSP("horainicio", 0,"NUMERIC");
        parent::SetParameterSP("codigoturno", '');
        parent::SetParameterSP("motivo", "");
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;
    }
    function seleccionarHoraFinal($datos){
        
        parent::ConnectionOpen("pnsMantTurnoProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 2);
        parent::SetParameterSP("iCodigoCronograma", 0,"INT");
        parent::SetParameterSP("horainicio", $datos["horainicio"],"NUMERIC");
        parent::SetParameterSP("codigoturno", '');
        parent::SetParameterSP("motivo", "");
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;
    }
    function actualizarTurnoProgramacionMedico($datos){
        parent::ConnectionOpen("pnsMantTurnoProgramacionMedicos", "dbweb");
        parent::SetParameterSP("accion", 3);
        parent::SetParameterSP("iCodigoCronograma", $datos["codCro"],"INT");
        parent::SetParameterSP("horainicio", 0,"NUMERIC");
        parent::SetParameterSP("codigoturno", $datos["codTur"]);
        parent::SetParameterSP("motivo", $datos["motivo"]);
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION["host"]);
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;
    }

    function dabrirPopudReporteMensualCronograma($datos) {
        parent::ConnectionOpen("pnsLogCronogramaMedico", "dbweb");
        parent::SetParameterSP("accion", 4);
        parent::SetParameterSP("iCodigoCronograma", '');
        parent::SetParameterSP("iCantidad", '');
        parent::SetParameterSP("vHost", $_SESSION['host']);
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("imes", $datos['iMes']);
        parent::SetParameterSP("ianio", $datos['iAnio']);
        parent::SetParameterSP("vCodigoPersona", $datos['iCodigoPersona']);
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;
    }
    function dDatosCronogramaMedicos($datos) {
        parent::ConnectionOpen("pnsLogCronogramaMedico", "dbweb");
        parent::SetParameterSP("accion", 5);
        parent::SetParameterSP("iCodigoCronograma", $datos["codProgramacion"]);
        parent::SetParameterSP("iCantidad", '');
        parent::SetParameterSP("vHost", $_SESSION['host']);
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("imes", '');
        parent::SetParameterSP("ianio", '');
        parent::SetParameterSP("vCodigoPersona", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;
    }


}

?>
