<?php

require_once("../../../pholivo/adophp/Adophp.class.php");
require_once("../../../pholivo/Conexion.php");

class DReporte extends Adophp {

    private $cnx;
    private $oRecord;

    public function __construct($cnx = Array()) {
        $this->cnx = empty($cnx) ? Conexion::getInitDsnMSSQLSimedh() : $cnx;
        parent::__construct('Spanish', $this->cnx);
    }

    function grabarReporte($datos) {
        parent::ConnectionOpen("pnsMantenimientoReportes", "dbweb");
        parent::SetParameterSP("op", '1');
        parent::SetParameterSP("idReporte", $datos["p1"]);
        parent::SetParameterSP("nomReporte", $datos["p2"]);
        parent::SetParameterSP("stdReporte", $datos["p3"]);
        parent::SetParameterSP("idEtiqueta", "");
        parent::SetParameterSP("nomEtiqueta", "");
        parent::SetParameterSP("stdEtiqueta", "");
        parent::SetParameterSP("ordenEtiqueta", "");
        parent::SetParameterSP("idAtributo", "");
        parent::SetParameterSP("nomAtributo", "");
        parent::SetParameterSP("stdAtributo", "");
        parent::SetParameterSP("tpoAtributo", "");
        parent::SetParameterSP("user", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("host", strtoupper($_SESSION['host']));
        parent::SetParameterSP("hacer", $datos["p4"]);
        parent::SetParameterSP("idCombo", "");
        parent::SetParameterSP("txtCombo", "");
        parent::SetParameterSP("valCombo", "");
        parent::SetParameterSP("idTipoReporteDetalle", "");
        parent::SetParameterSP("idReporteDetalle", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function cargarTablaPersonal($datos) {
        parent::ConnectionOpen("pnsReportesEstadisticosActoMedico", "dbweb");
        parent::SetParameterSP("bus", '1');
        parent::SetParameterSP("pv1", $datos["codigo"]);
        parent::SetParameterSP("pv2", $datos["apepat"]);
        parent::SetParameterSP("pv3", $datos["apemat"]);
        parent::SetParameterSP("pv4", $datos["nombre"]);
        parent::SetParameterSP("pv5", $datos["dni"]);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function cargarTablaServicios($datos) {
        parent::ConnectionOpen("pnsReportesEstadisticosActoMedico", "dbweb");
        parent::SetParameterSP("bus", '2');
        parent::SetParameterSP("pv1", $datos["servicio"]);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function ListarActividades() {
        parent::ConnectionOpen("pnsReportesEstadisticosActoMedico", "dbweb");
        parent::SetParameterSP("bus", '10');
        parent::SetParameterSP("pv1", '');
        parent::SetParameterSP("pv2", '');
        parent::SetParameterSP("pv3", '');
        parent::SetParameterSP("pv4", '');
        parent::SetParameterSP("pv5", '');
        parent::SetParameterSP("pv6", '');
        parent::SetParameterSP("pv7", '');
        parent::SetParameterSP("pv8", '');
        parent::SetParameterSP("pv9", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function listarCieUsado() {
        parent::ConnectionOpen("pnsProductividadDiagnostico", "dbweb");
        parent::SetParameterSP("bus", 1);
        parent::SetParameterSP("pv1", '');
        parent::SetParameterSP("pv2", '');
        parent::SetParameterSP("pv3", '');
        parent::SetParameterSP("pv4", '');
        parent::SetParameterSP("pv5", '');
        parent::SetParameterSP("pv6", '');
        parent::SetParameterSP("pv7", '');
        parent::SetParameterSP("pv8", '');
        parent::SetParameterSP("pv9", '');
        parent::SetParameterSP("pv10", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function listarBusquedaCIE($datos) {
        parent::ConnectionOpen("pnsProductividadDiagnostico", "dbweb");
        parent::SetParameterSP("bus", 2);
        parent::SetParameterSP("pv1", '');
        parent::SetParameterSP("pv2", '');
        parent::SetParameterSP("pv3", '');
        parent::SetParameterSP("pv4", '');
        parent::SetParameterSP("pv5", '');
        parent::SetParameterSP("pv6", $datos['vNombreCie']);
        parent::SetParameterSP("pv7", '');
        parent::SetParameterSP("pv8", '');
        parent::SetParameterSP("pv9", '');
        parent::SetParameterSP("pv10", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function mostrarReportesFechas($datos) {
        parent::ConnectionOpen("pnsProductividadDiagnostico", "dbweb");
        parent::SetParameterSP("bus", 3);
        parent::SetParameterSP("pv1", $datos['fecha1']);
        parent::SetParameterSP("pv2", $datos['fecha2']);
        parent::SetParameterSP("pv3", $datos['afiliacion']);
        parent::SetParameterSP("pv4", $datos['sede']);
        parent::SetParameterSP("pv5", $datos['diagnostico']);
        parent::SetParameterSP("pv6", '');
        parent::SetParameterSP("pv7", $datos['sede1']);
        parent::SetParameterSP("pv8", $datos['sede2']);
        parent::SetParameterSP("pv9", $datos['sede3']);
        parent::SetParameterSP("pv10", $datos['sede4']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function mostrarReportesFechasSede($datos) {
        parent::ConnectionOpen("pnsProductividadDiagnostico", "dbweb");
        parent::SetParameterSP("bus", 4);
        parent::SetParameterSP("pv1", $datos['fecha1']);
        parent::SetParameterSP("pv2", $datos['fecha2']);
        parent::SetParameterSP("pv3", $datos['afiliacion']);
        parent::SetParameterSP("pv4", $datos['sede']);
        parent::SetParameterSP("pv5", $datos['diagnostico']);
        parent::SetParameterSP("pv6", '');
        parent::SetParameterSP("pv7", $datos['sede1']);
        parent::SetParameterSP("pv8", $datos['sede2']);
        parent::SetParameterSP("pv9", $datos['sede3']);
        parent::SetParameterSP("pv10", $datos['sede4']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function mostrarReportesFechasAfiliacion($datos) {
        parent::ConnectionOpen("pnsProductividadDiagnostico", "dbweb");
        parent::SetParameterSP("bus", 5);
        parent::SetParameterSP("pv1", $datos['fecha1']);
        parent::SetParameterSP("pv2", $datos['fecha2']);
        parent::SetParameterSP("pv3", $datos['afiliacion']);
        parent::SetParameterSP("pv4", $datos['sede']);
        parent::SetParameterSP("pv5", $datos['diagnostico']);
        parent::SetParameterSP("pv6", '');
        parent::SetParameterSP("pv7", $datos['sede1']);
        parent::SetParameterSP("pv8", $datos['sede2']);
        parent::SetParameterSP("pv9", $datos['sede3']);
        parent::SetParameterSP("pv10", $datos['sede4']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function mostrarReportesFechasCie($datos) {
        parent::ConnectionOpen("pnsProductividadDiagnostico", "dbweb");
        parent::SetParameterSP("bus", 6);
        parent::SetParameterSP("pv1", $datos['fecha1']);
        parent::SetParameterSP("pv2", $datos['fecha2']);
        parent::SetParameterSP("pv3", $datos['afiliacion']);
        parent::SetParameterSP("pv4", $datos['sede']);
        parent::SetParameterSP("pv5", $datos['diagnostico']);
        parent::SetParameterSP("pv6", '');
        parent::SetParameterSP("pv7", $datos['sede1']);
        parent::SetParameterSP("pv8", $datos['sede2']);
        parent::SetParameterSP("pv9", $datos['sede3']);
        parent::SetParameterSP("pv10", $datos['sede4']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function mostrarReportesFechasAfiliacionSede($datos) {
        parent::ConnectionOpen("pnsProductividadDiagnostico", "dbweb");
        parent::SetParameterSP("bus", 7);
        parent::SetParameterSP("pv1", $datos['fecha1']);
        parent::SetParameterSP("pv2", $datos['fecha2']);
        parent::SetParameterSP("pv3", $datos['afiliacion']);
        parent::SetParameterSP("pv4", $datos['sede']);
        parent::SetParameterSP("pv5", $datos['diagnostico']);
        parent::SetParameterSP("pv6", '');
        parent::SetParameterSP("pv7", $datos['sede1']);
        parent::SetParameterSP("pv8", $datos['sede2']);
        parent::SetParameterSP("pv9", $datos['sede3']);
        parent::SetParameterSP("pv10", $datos['sede4']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function mostrarReportesFechasAfiliacionCIE($datos) {
        parent::ConnectionOpen("pnsProductividadDiagnostico", "dbweb");
        parent::SetParameterSP("bus", 8);
        parent::SetParameterSP("pv1", $datos['fecha1']);
        parent::SetParameterSP("pv2", $datos['fecha2']);
        parent::SetParameterSP("pv3", $datos['afiliacion']);
        parent::SetParameterSP("pv4", $datos['sede']);
        parent::SetParameterSP("pv5", $datos['diagnostico']);
        parent::SetParameterSP("pv6", '');
        parent::SetParameterSP("pv7", $datos['sede1']);
        parent::SetParameterSP("pv8", $datos['sede2']);
        parent::SetParameterSP("pv9", $datos['sede3']);
        parent::SetParameterSP("pv10", $datos['sede4']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function mostrarReportesFechasSedeCIE($datos) {
        parent::ConnectionOpen("pnsProductividadDiagnostico", "dbweb");
        parent::SetParameterSP("bus", 9);
        parent::SetParameterSP("pv1", $datos['fecha1']);
        parent::SetParameterSP("pv2", $datos['fecha2']);
        parent::SetParameterSP("pv3", $datos['afiliacion']);
        parent::SetParameterSP("pv4", $datos['sede']);
        parent::SetParameterSP("pv5", $datos['diagnostico']);
        parent::SetParameterSP("pv6", '');
        parent::SetParameterSP("pv7", $datos['sede1']);
        parent::SetParameterSP("pv8", $datos['sede2']);
        parent::SetParameterSP("pv9", $datos['sede3']);
        parent::SetParameterSP("pv10", $datos['sede4']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function mostrarReportesFechasAfiliacionSedeCIE($datos) {
        parent::ConnectionOpen("pnsProductividadDiagnostico", "dbweb");
        parent::SetParameterSP("bus", 10);
        parent::SetParameterSP("pv1", $datos['fecha1']);
        parent::SetParameterSP("pv2", $datos['fecha2']);
        parent::SetParameterSP("pv3", $datos['afiliacion']);
        parent::SetParameterSP("pv4", $datos['sede']);
        parent::SetParameterSP("pv5", $datos['diagnostico']);
        parent::SetParameterSP("pv6", '');
        parent::SetParameterSP("pv7", $datos['sede1']);
        parent::SetParameterSP("pv8", $datos['sede2']);
        parent::SetParameterSP("pv9", $datos['sede3']);
        parent::SetParameterSP("pv10", $datos['sede4']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function tablaAmbiLo() {
        parent::ConnectionOpen("pnsReportesEstadisticosActoMedico", "dbweb");
        parent::SetParameterSP("bus", '4');
        parent::SetParameterSP("pv1", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function cargarTablaSedes() {
        parent::ConnectionOpen("pnsReportesEstadisticosActoMedico", "dbweb");
        parent::SetParameterSP("bus", '5');
        parent::SetParameterSP("pv1", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    //JCQA 23 OCTUBRE 2012
    function dindicadorLaboratorioClinicoListaAfiliaciones() {

        parent::ConnectionOpen("pnsReportesEstadisticosLaboratorioClinico", "dbweb");
        parent::SetParameterSP("@accion", '1');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@int4", '');
        parent::SetParameterSP("@int5", '');
        parent::SetParameterSP("@int6", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@bit2", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("@char2", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    //JCQA 23 OCTUBRE 2012
    function dindicadorLaboratorioClinicoListaProcedencia() {

        parent::ConnectionOpen("pnsReportesEstadisticosLaboratorioClinico", "dbweb");
        parent::SetParameterSP("@accion", '2');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@int4", '');
        parent::SetParameterSP("@int5", '');
        parent::SetParameterSP("@int6", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@bit2", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("@char2", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    //JCQA 23 OCTUBRE 2012
    function dindicadorLaboratorioClinicoListaSedes() {

        parent::ConnectionOpen("pnsReportesEstadisticosLaboratorioClinico", "dbweb");
        parent::SetParameterSP("@accion", '3');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@int4", '');
        parent::SetParameterSP("@int5", '');
        parent::SetParameterSP("@int6", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@bit2", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("@char2", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    //JCQA 16 Noviembre 2012
    function DreporteDePuntoControlXExamen_indicador($datos) {

        parent::ConnectionOpen("pnsReportesEstadisticosLaboratorioClinico", "dbweb");
        parent::SetParameterSP("@accion", '5');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos["iIdExamenesLaboratorio"]);
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@int4", '');
        parent::SetParameterSP("@int5", '');
        parent::SetParameterSP("@int6", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@bit2", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("@char2", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    //JCQA 22 Noviembre 2012
    function DreporteDeUnidadesUtilizadasxMaterialLaboratorio_IndicadorLaboratorio($datos) {

        parent::ConnectionOpen("pnsReportesEstadisticosLaboratorioClinico", "dbweb");
        parent::SetParameterSP("@accion", '6');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos["IdMat"]);
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@int4", '');
        parent::SetParameterSP("@int5", '');
        parent::SetParameterSP("@int6", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@bit2", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("@char2", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    //JCQA 23 OCTUBRE 2012
    function dindicadorLaboratorioClinicoListaExamenes() {

        parent::ConnectionOpen("pnsReportesEstadisticosLaboratorioClinico", "dbweb");
        parent::SetParameterSP("@accion", '4');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@int4", '');
        parent::SetParameterSP("@int5", '');
        parent::SetParameterSP("@int6", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@bit2", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("@char2", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function tablaAmbiFi() {
        parent::ConnectionOpen("pnsReportesEstadisticosActoMedico", "dbweb");
        parent::SetParameterSP("bus", '9');
        parent::SetParameterSP("pv1", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function indicadorLaboratorioClinicoMaterialesLaboratorio() {
        parent::ConnectionOpen("pnsReporteLaboratorio", "dbweb");
        parent::SetParameterSP("bus", '1');
        parent::SetParameterSP("pv1", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dDatosPuntoControlPaciente($codPacienteLab) {
        parent::ConnectionOpen("pnsReportesExamenLaboratorio", "dbweb");
        parent::SetParameterSP("bus", '2');
        parent::SetParameterSP("pv1", $codPacienteLab);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dgrupodeDatos($codPacienteLab) {
        parent::ConnectionOpen("pnsReportesExamenLaboratorio", "dbweb");
        parent::SetParameterSP("bus", '3');
        parent::SetParameterSP("pv1", $codPacienteLab);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function ddatosExamenUni($codPacienteLab) {
        parent::ConnectionOpen("pnsReportesExamenLaboratorio", "dbweb");
        parent::SetParameterSP("bus", '4');
        parent::SetParameterSP("pv1", $codPacienteLab);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function EditarVdescripcionHistorial($datos) {
        parent::ConnectionOpen("pnsReportesEstadisticosActoMedico", "dbweb");
        parent::SetParameterSP("bus", '7');
        parent::SetParameterSP("pv1", $datos["Id"]);
        parent::SetParameterSP("pv2", $datos["descripcion"]);
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function guardarDatosHistoriaEstadistica($datos) {
        parent::ConnectionOpen("pnsguargarHistorialEstidisticoActoMedico", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("vEstado", $datos["Estados"]);
        parent::SetParameterSP("vAtencion", $datos["Atencion"]);
        parent::SetParameterSP("vProgramacion", $datos["Programacion"]);
        parent::SetParameterSP("vMedicos", $datos["Medicos"]);
        parent::SetParameterSP("vServicios", $datos["Servicios"]);
        parent::SetParameterSP("vAmbiFi", $datos["Afiliaciones"]);
        parent::SetParameterSP("vAmbiLo", $datos["AmbiLo"]);
        parent::SetParameterSP("vSedes", $datos["Sedes"]);
        parent::SetParameterSP("vTurnos", $datos["Turnos"]);
        parent::SetParameterSP("iTipoRango", $datos["opcion"]);
        parent::SetParameterSP("fechaInicio", $datos["fechaInicio"]);
        parent::SetParameterSP("fechaFin", $datos["fechaFin"]);
        parent::SetParameterSP("imesInicio", $datos["imesInicio"]);
        parent::SetParameterSP("imesFin", $datos["imesFin"]);
        parent::SetParameterSP("iTrimestreInicio", $datos["iTrimestreInicio"]);
        parent::SetParameterSP("iTrimestreFin", $datos["iTrimestreFin"]);
        parent::SetParameterSP("iSemestreInicio", $datos["iSemestreInicio"]);
        parent::SetParameterSP("iSemestreFin", $datos["iSemestreFin"]);
        parent::SetParameterSP("ianioInicio", $datos["ianioInicio"]);
        parent::SetParameterSP("ianiofin", $datos["ianiofin"]);
        parent::SetParameterSP("vTipoGrafico", $datos['tipografico']);
        parent::SetParameterSP("vTitulo", $datos["titulo"]);
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("actividad", $datos['actividades']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function TablaLeyendaGrafica($datos) {
        parent::ConnectionOpen("pnsEstadisticasCronogramaMedico", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("iTipoRango", $datos["opcion"]);
        parent::SetParameterSP("fechaInicio", $datos["fechaInicio"]);
        parent::SetParameterSP("fechaFin", $datos["fechaFin"]);
        parent::SetParameterSP("imesInicio", $datos["imesInicio"]);
        parent::SetParameterSP("imesFin", $datos["imesFin"]);
        parent::SetParameterSP("iTrimestreInicio", $datos["iTrimestreInicio"]);
        parent::SetParameterSP("iTrimestreFin", $datos["iTrimestreFin"]);
        parent::SetParameterSP("iSemestreInicio", $datos["iSemestreInicio"]);
        parent::SetParameterSP("iSemestreFin", $datos["iSemestreFin"]);
        parent::SetParameterSP("ianioInicio", $datos["ianioInicio"]);
        parent::SetParameterSP("ianiofin", $datos["ianiofin"]);
        parent::SetParameterSP("bReservados", $datos['bReservados']);
        parent::SetParameterSP("bPorAtender", $datos['bPorAtender']);
        parent::SetParameterSP("bAtendidos", $datos['bAtendidos']);
        parent::SetParameterSP("bConsultaReservados", $datos['bConsultaReservados']);
        parent::SetParameterSP("bConsultaPorAtender", $datos['bConsultaPorAtender']);
        parent::SetParameterSP("bConsultaAtendidos", $datos['bConsultaAtendidos']);
        parent::SetParameterSP("bProcedimientosReservados", $datos['bProcedimientosReservados']);
        parent::SetParameterSP("bProcedimientosPorAtender", $datos['bProcedimientosPorAtender']);
        parent::SetParameterSP("bProcedimientosAtendidos", $datos['bProcedimientosAtendidos']);
        parent::SetParameterSP("bAdicionalReservados", $datos['bAdicionalReservados']);
        parent::SetParameterSP("bAdicionalPorAtender", $datos['bAdicionalPorAtender']);
        parent::SetParameterSP("bAdicionalAtendidos", $datos['bAdicionalAtendidos']);
        parent::SetParameterSP("bProgramadosReservados", $datos['bProgramadosReservados']);
        parent::SetParameterSP("bProgramadosPorAtender", $datos['bProgramadosPorAtender']);
        parent::SetParameterSP("bProgramadosAtendidos", $datos['bProgramadosAtendidos']);
        parent::SetParameterSP("vCodMedico1", $datos['codMedico1']);
        parent::SetParameterSP("vCodMedico2", $datos['codMedico2']);
        parent::SetParameterSP("vCodMedico3", $datos['codMedico3']);
        parent::SetParameterSP("vCodServicio", $datos['codProducto']);
        parent::SetParameterSP("vCodAmbiLogico1", $datos['codAmbiLo1']);
        parent::SetParameterSP("vCodAmbiLogico2", $datos['codAmbiLo2']);
        parent::SetParameterSP("vCodAmbiLogico3", $datos['codAmbiLo3']);
        parent::SetParameterSP("vCodAfiliacion1", $datos['Afiliaciones1']);
        parent::SetParameterSP("vCodAfiliacion2", $datos['Afiliaciones2']);
        parent::SetParameterSP("vCodAfiliacion3", $datos['Afiliaciones3']);
        parent::SetParameterSP("vCodSede1", $datos['CodSede1']);
        parent::SetParameterSP("vCodSede2", $datos['CodSede2']);
        parent::SetParameterSP("vCodSede3", $datos['CodSede3']);
        parent::SetParameterSP("vCodSede4", $datos['CodSede4']);
        parent::SetParameterSP("bConsultaProgramadoReservados", $datos['bConsultaProgramadoReservados']);
        parent::SetParameterSP("bConsultaProgramadoPorAtender", $datos['bConsultaProgramadoPorAtender']);
        parent::SetParameterSP("bConsultaProgramadoAtendidos", $datos['bConsultaProgramadoAtendidos']);
        parent::SetParameterSP("bConsultaAdicionalReservados", $datos['bConsultaAdicionalReservados']);
        parent::SetParameterSP("bConsultaAdicionalPorAtender", $datos['bConsultaAdicionalPorAtender']);
        parent::SetParameterSP("bConsultaAdicionalAtendidos", $datos['bConsultaAdicionalAtendidos']);
        parent::SetParameterSP("bProcedimientosProgramadoReservados", $datos['bProcedimientosProgramadoReservados']);
        parent::SetParameterSP("bProcedimientosProgramadoPorAtender", $datos['bProcedimientosProgramadoPorAtender']);
        parent::SetParameterSP("bProcedimientosProgramadoAtendidos", $datos['bProcedimientosProgramadoAtendidos']);
        parent::SetParameterSP("bProcedimientosAdicionalReservados", $datos['bProcedimientosAdicionalReservados']);
        parent::SetParameterSP("bProcedimientosAdicionalPorAtender", $datos['bProcedimientosAdicionalPorAtender']);
        parent::SetParameterSP("bProcedimientosAdicionalAtendidos", $datos['bProcedimientosAdicionalAtendidos']);
        parent::SetParameterSP("vActividades1", $datos['actividades1']);
        parent::SetParameterSP("vActividades2", $datos['actividades2']);
        parent::SetParameterSP("vActividades3", $datos['actividades3']);
        parent::SetParameterSP("vActividades4", $datos['actividades4']);
        parent::SetParameterSP("vActividades5", $datos['actividades5']);
        parent::SetParameterSP("vActividades6", $datos['actividades6']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dEstadisticasMedicos($datos) {
        parent::ConnectionOpen("pnsEstadisticasCronogramaMedico", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("iTipoRango", $datos["opcion"]);
        parent::SetParameterSP("fechaInicio", $datos["fechaInicio"]);
        parent::SetParameterSP("fechaFin", $datos["fechaFin"]);
        parent::SetParameterSP("imesInicio", $datos["imesInicio"]);
        parent::SetParameterSP("imesFin", $datos["imesFin"]);
        parent::SetParameterSP("iTrimestreInicio", $datos["iTrimestreInicio"]);
        parent::SetParameterSP("iTrimestreFin", $datos["iTrimestreFin"]);
        parent::SetParameterSP("iSemestreInicio", $datos["iSemestreInicio"]);
        parent::SetParameterSP("iSemestreFin", $datos["iSemestreFin"]);
        parent::SetParameterSP("ianioInicio", $datos["ianioInicio"]);
        parent::SetParameterSP("ianiofin", $datos["ianiofin"]);
        parent::SetParameterSP("bReservados", $datos['bReservados']);
        parent::SetParameterSP("bPorAtender", $datos['bPorAtender']);
        parent::SetParameterSP("bAtendidos", $datos['bAtendidos']);
        parent::SetParameterSP("bConsultaReservados", $datos['bConsultaReservados']);
        parent::SetParameterSP("bConsultaPorAtender", $datos['bConsultaPorAtender']);
        parent::SetParameterSP("bConsultaAtendidos", $datos['bConsultaAtendidos']);
        parent::SetParameterSP("bProcedimientosReservados", $datos['bProcedimientosReservados']);
        parent::SetParameterSP("bProcedimientosPorAtender", $datos['bProcedimientosPorAtender']);
        parent::SetParameterSP("bProcedimientosAtendidos", $datos['bProcedimientosAtendidos']);
        parent::SetParameterSP("bAdicionalReservados", $datos['bAdicionalReservados']);
        parent::SetParameterSP("bAdicionalPorAtender", $datos['bAdicionalPorAtender']);
        parent::SetParameterSP("bAdicionalAtendidos", $datos['bAdicionalAtendidos']);
        parent::SetParameterSP("bProgramadosReservados", $datos['bProgramadosReservados']);
        parent::SetParameterSP("bProgramadosPorAtender", $datos['bProgramadosPorAtender']);
        parent::SetParameterSP("bProgramadosAtendidos", $datos['bProgramadosAtendidos']);
        parent::SetParameterSP("vCodMedico1", $datos['codMedico1']);
        parent::SetParameterSP("vCodMedico2", $datos['codMedico2']);
        parent::SetParameterSP("vCodMedico3", $datos['codMedico3']);
        parent::SetParameterSP("vCodServicio", $datos['codProducto']);
        parent::SetParameterSP("vCodAmbiLogico1", $datos['codAmbiLo1']);
        parent::SetParameterSP("vCodAmbiLogico2", $datos['codAmbiLo2']);
        parent::SetParameterSP("vCodAmbiLogico3", $datos['codAmbiLo3']);
        parent::SetParameterSP("vCodAfiliacion1", $datos['Afiliaciones1']);
        parent::SetParameterSP("vCodAfiliacion2", $datos['Afiliaciones2']);
        parent::SetParameterSP("vCodAfiliacion3", $datos['Afiliaciones3']);
        parent::SetParameterSP("vCodSede1", $datos['CodSede1']);
        parent::SetParameterSP("vCodSede2", $datos['CodSede2']);
        parent::SetParameterSP("vCodSede3", $datos['CodSede3']);
        parent::SetParameterSP("vCodSede4", $datos['CodSede4']);
        parent::SetParameterSP("bConsultaProgramadoReservados", $datos['bConsultaProgramadoReservados']);
        parent::SetParameterSP("bConsultaProgramadoPorAtender", $datos['bConsultaProgramadoPorAtender']);
        parent::SetParameterSP("bConsultaProgramadoAtendidos", $datos['bConsultaProgramadoAtendidos']);
        parent::SetParameterSP("bConsultaAdicionalReservados", $datos['bConsultaAdicionalReservados']);
        parent::SetParameterSP("bConsultaAdicionalPorAtender", $datos['bConsultaAdicionalPorAtender']);
        parent::SetParameterSP("bConsultaAdicionalAtendidos", $datos['bConsultaAdicionalAtendidos']);
        parent::SetParameterSP("bProcedimientosProgramadoReservados", $datos['bProcedimientosProgramadoReservados']);
        parent::SetParameterSP("bProcedimientosProgramadoPorAtender", $datos['bProcedimientosProgramadoPorAtender']);
        parent::SetParameterSP("bProcedimientosProgramadoAtendidos", $datos['bProcedimientosProgramadoAtendidos']);
        parent::SetParameterSP("bProcedimientosAdicionalReservados", $datos['bProcedimientosAdicionalReservados']);
        parent::SetParameterSP("bProcedimientosAdicionalPorAtender", $datos['bProcedimientosAdicionalPorAtender']);
        parent::SetParameterSP("bProcedimientosAdicionalAtendidos", $datos['bProcedimientosAdicionalAtendidos']);
        parent::SetParameterSP("vActividades1", $datos['actividades1']);
        parent::SetParameterSP("vActividades2", $datos['actividades2']);
        parent::SetParameterSP("vActividades3", $datos['actividades3']);
        parent::SetParameterSP("vActividades4", $datos['actividades4']);
        parent::SetParameterSP("vActividades5", $datos['actividades5']);
        parent::SetParameterSP("vActividades6", $datos['actividades6']);
//          parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function destadisticasExamenesLaboratorioClinico($datos) {

//        $bb = $datos['puntoControl1'];
//        echo '  /jose/' . $bb . '/carlos/  ';
        parent::ConnectionOpen("pnsEstadisticasLaboratorioClinico", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("iTipoRango", $datos["opcion"]);
        parent::SetParameterSP("fechaInicio", $datos["fechaInicio"]);
        parent::SetParameterSP("fechaFin", $datos["fechaFin"]);
        parent::SetParameterSP("imesInicio", $datos["imesInicio"]);
        parent::SetParameterSP("imesFin", $datos["imesFin"]);
        parent::SetParameterSP("iTrimestreInicio", $datos["iTrimestreInicio"]);
        parent::SetParameterSP("iTrimestreFin", $datos["iTrimestreFin"]);
        parent::SetParameterSP("iSemestreInicio", $datos["iSemestreInicio"]);
        parent::SetParameterSP("iSemestreFin", $datos["iSemestreFin"]);
        parent::SetParameterSP("ianioInicio", $datos["ianioInicio"]);
        parent::SetParameterSP("ianiofin", $datos["ianiofin"]);
        parent::SetParameterSP("iIdExamenLaboratorio1", $datos['codExamen1']);
        parent::SetParameterSP("iIdExamenLaboratorio2", $datos['codExamen2']);
        parent::SetParameterSP("iIdExamenLaboratorio3", $datos['codExamen3']);
        parent::SetParameterSP("cidSedeEmpresa1", $datos['codSede1']);
        parent::SetParameterSP("cidSedeEmpresa2", $datos['codSede2']);
        parent::SetParameterSP("cidSedeEmpresa3", $datos['codSede3']);
        parent::SetParameterSP("cIdAfiliacion", $datos['Afiliaciones1']);
        parent::SetParameterSP("iIdActividadesLaboratorio", $datos['Procedencia1']);
        parent::SetParameterSP("iIdPuntoControl", $datos['puntoControl1']);

        parent::SetParameterSP("Materiales", $datos['Materiales1']);
        parent::SetParameterSP("UnidadMedida", $datos['UnidadMedida1']);
        //parent::SetParameterSP("MaterialPorSede", $datos['MaterialPorSede']);
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));


        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    //jcqa 14nov 12


    function TablaLeyendaGraficaLabo($datos) {
        parent::ConnectionOpen("pnsEstadisticasLaboratorioClinico", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("iTipoRango", $datos["opcion"]);
        parent::SetParameterSP("fechaInicio", $datos["fechaInicio"]);
        parent::SetParameterSP("fechaFin", $datos["fechaFin"]);
        parent::SetParameterSP("imesInicio", $datos["imesInicio"]);
        parent::SetParameterSP("imesFin", $datos["imesFin"]);
        parent::SetParameterSP("iTrimestreInicio", $datos["iTrimestreInicio"]);
        parent::SetParameterSP("iTrimestreFin", $datos["iTrimestreFin"]);
        parent::SetParameterSP("iSemestreInicio", $datos["iSemestreInicio"]);
        parent::SetParameterSP("iSemestreFin", $datos["iSemestreFin"]);
        parent::SetParameterSP("ianioInicio", $datos["ianioInicio"]);
        parent::SetParameterSP("ianiofin", $datos["ianiofin"]);
        parent::SetParameterSP("iIdExamenLaboratorio1", $datos['codExamen1']);
        parent::SetParameterSP("iIdExamenLaboratorio2", $datos['codExamen2']);
        parent::SetParameterSP("iIdExamenLaboratorio3", $datos['codExamen3']);

        parent::SetParameterSP("cidSedeEmpresa1", $datos['codSede1']);
        parent::SetParameterSP("cidSedeEmpresa2", $datos['codSede2']);
        parent::SetParameterSP("cidSedeEmpresa3", $datos['codSede3']);

        parent::SetParameterSP("cIdAfiliacion", $datos['Afiliaciones1']);
        parent::SetParameterSP("iIdActividadesLaboratorio", $datos['Procedencia1']);
        parent::SetParameterSP("iIdPuntoControl", $datos['PuntoControl1']);

        parent::SetParameterSP("Materiales", $datos['Materiales1']);
        parent::SetParameterSP("UnidadMedida", $datos['UnidadMedida1']);

        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dEstadisticasMedicosGuardados($datos) {
        parent::ConnectionOpen("pnsReportesEstadisticosActoMedico", "dbweb");
        parent::SetParameterSP("bus", '7');
        parent::SetParameterSP("pv1", $datos['idEstadistica']);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function TablaHistoriaEstadistica() {
        parent::ConnectionOpen("pnsReportesEstadisticosActoMedico", "dbweb");
        parent::SetParameterSP("bus", '6');
        parent::SetParameterSP("pv1", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function datosPacientexExamen($codPacienteLab) {
        parent::ConnectionOpen("pnsReportesExamenLaboratorio", "dbweb");
        parent::SetParameterSP("bus", '1');
        parent::SetParameterSP("pv1", $codPacienteLab);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function grabarEtiqueta($datos) {
        parent::ConnectionOpen("pnsMantenimientoReportes", "dbweb");
        parent::SetParameterSP("op", '2');
        parent::SetParameterSP("idReporte", "");
        parent::SetParameterSP("nomReporte", "");
        parent::SetParameterSP("stdReporte", "");
        parent::SetParameterSP("idEtiqueta", $datos["p1"]);
        parent::SetParameterSP("nomEtiqueta", $datos["p2"]);
        parent::SetParameterSP("stdEtiqueta", $datos["p3"]);
        parent::SetParameterSP("ordenEtiqueta", $datos["p5"]);
        parent::SetParameterSP("idAtributo", "");
        parent::SetParameterSP("nomAtributo", "");
        parent::SetParameterSP("stdAtributo", "");
        parent::SetParameterSP("tpoAtributo", "");
        parent::SetParameterSP("user", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("host", strtoupper($_SESSION['host']));
        parent::SetParameterSP("hacer", $datos["p4"]);
        parent::SetParameterSP("idCombo", "");
        parent::SetParameterSP("txtCombo", "");
        parent::SetParameterSP("valCombo", "");
        parent::SetParameterSP("idTipoReporteDetalle", "");
        parent::SetParameterSP("idReporteDetalle", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function grabarAtributoFormato($datos) {
        parent::ConnectionOpen("pnsMantenimientoReportes", "dbweb");
        parent::SetParameterSP("op", '3');
        parent::SetParameterSP("idReporte", "");
        parent::SetParameterSP("nomReporte", "");
        parent::SetParameterSP("stdReporte", "");
        parent::SetParameterSP("idEtiqueta", "");
        parent::SetParameterSP("nomEtiqueta", "");
        parent::SetParameterSP("stdEtiqueta", "");
        parent::SetParameterSP("ordenEtiqueta", "");
        parent::SetParameterSP("idAtributo", $datos["p1"]);
        parent::SetParameterSP("nomAtributo", $datos["p2"]);
        parent::SetParameterSP("stdAtributo", $datos["p3"]);
        parent::SetParameterSP("tpoAtributo", $datos["p4"]);
        parent::SetParameterSP("user", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("host", strtoupper($_SESSION['host']));
        parent::SetParameterSP("hacer", $datos["p5"]);
        parent::SetParameterSP("idCombo", "");
        parent::SetParameterSP("txtCombo", "");
        parent::SetParameterSP("valCombo", "");
        parent::SetParameterSP("idTipoReporteDetalle", "");
        parent::SetParameterSP("idReporteDetalle", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function arbolReporte() {
        parent::ConnectionOpen("pnsMantenimientoReportes", "dbweb");
        parent::SetParameterSP("op", '4');
        parent::SetParameterSP("idReporte", "");
        parent::SetParameterSP("nomReporte", "");
        parent::SetParameterSP("stdReporte", "");
        parent::SetParameterSP("idEtiqueta", "");
        parent::SetParameterSP("nomEtiqueta", "");
        parent::SetParameterSP("stdEtiqueta", "");
        parent::SetParameterSP("ordenEtiqueta", "");
        parent::SetParameterSP("idAtributo", "");
        parent::SetParameterSP("nomAtributo", "");
        parent::SetParameterSP("stdAtributo", "");
        parent::SetParameterSP("tpoAtributo", "");
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", "");
        parent::SetParameterSP("idCombo", "");
        parent::SetParameterSP("txtCombo", "");
        parent::SetParameterSP("valCombo", "");
        parent::SetParameterSP("idTipoReporteDetalle", "");
        parent::SetParameterSP("idReporteDetalle", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function editarReporte($idreporte) {
        parent::ConnectionOpen("pnsMantenimientoReportes", "dbweb");
        parent::SetParameterSP("op", '5');
        parent::SetParameterSP("idReporte", $idreporte);
        parent::SetParameterSP("nomReporte", "");
        parent::SetParameterSP("stdReporte", "");
        parent::SetParameterSP("idEtiqueta", "");
        parent::SetParameterSP("nomEtiqueta", "");
        parent::SetParameterSP("stdEtiqueta", "");
        parent::SetParameterSP("ordenEtiqueta", "");
        parent::SetParameterSP("idAtributo", "");
        parent::SetParameterSP("nomAtributo", "");
        parent::SetParameterSP("stdAtributo", "");
        parent::SetParameterSP("tpoAtributo", "");
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", "");
        parent::SetParameterSP("idCombo", "");
        parent::SetParameterSP("txtCombo", "");
        parent::SetParameterSP("valCombo", "");
        parent::SetParameterSP("idTipoReporteDetalle", "");
        parent::SetParameterSP("idReporteDetalle", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function listaEtiqueta($idReporte) {
        parent::ConnectionOpen("pnsMantenimientoReportes", "dbweb");
        parent::SetParameterSP("op", '6');
        parent::SetParameterSP("idReporte", $idReporte);
        parent::SetParameterSP("nomReporte", "");
        parent::SetParameterSP("stdReporte", "");
        parent::SetParameterSP("idEtiqueta", "");
        parent::SetParameterSP("nomEtiqueta", "");
        parent::SetParameterSP("stdEtiqueta", "");
        parent::SetParameterSP("ordenEtiqueta", "");
        parent::SetParameterSP("idAtributo", "");
        parent::SetParameterSP("nomAtributo", "");
        parent::SetParameterSP("stdAtributo", "");
        parent::SetParameterSP("tpoAtributo", "");
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", "");
        parent::SetParameterSP("idCombo", "");
        parent::SetParameterSP("txtCombo", "");
        parent::SetParameterSP("valCombo", "");
        parent::SetParameterSP("idTipoReporteDetalle", "");
        parent::SetParameterSP("idReporteDetalle", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function listaAtributos() {
        parent::ConnectionOpen("pnsMantenimientoReportes", "dbweb");
        parent::SetParameterSP("op", '7');
        parent::SetParameterSP("idReporte", "");
        parent::SetParameterSP("nomReporte", "");
        parent::SetParameterSP("stdReporte", "");
        parent::SetParameterSP("idEtiqueta", "");
        parent::SetParameterSP("nomEtiqueta", "");
        parent::SetParameterSP("stdEtiqueta", "");
        parent::SetParameterSP("ordenEtiqueta", "");
        parent::SetParameterSP("idAtributo", "");
        parent::SetParameterSP("nomAtributo", "");
        parent::SetParameterSP("stdAtributo", "");
        parent::SetParameterSP("tpoAtributo", "");
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", "");
        parent::SetParameterSP("idCombo", "");
        parent::SetParameterSP("txtCombo", "");
        parent::SetParameterSP("valCombo", "");
        parent::SetParameterSP("idTipoReporteDetalle", "");
        parent::SetParameterSP("idReporteDetalle", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function grabarAtributoCombo($idAtributoCombo, $idAtributo, $texto, $value, $hacer) {
        parent::ConnectionOpen("pnsMantenimientoReportes", "dbweb");
        parent::SetParameterSP("op", '8');
        parent::SetParameterSP("idReporte", "");
        parent::SetParameterSP("nomReporte", "");
        parent::SetParameterSP("stdReporte", "");
        parent::SetParameterSP("idEtiqueta", "");
        parent::SetParameterSP("nomEtiqueta", "");
        parent::SetParameterSP("stdEtiqueta", "");
        parent::SetParameterSP("ordenEtiqueta", "");
        parent::SetParameterSP("idAtributo", $idAtributo);
        parent::SetParameterSP("nomAtributo", "");
        parent::SetParameterSP("stdAtributo", "");
        parent::SetParameterSP("tpoAtributo", "");
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", $hacer);
        parent::SetParameterSP("idCombo", $idAtributoCombo);
        parent::SetParameterSP("txtCombo", $texto);
        parent::SetParameterSP("valCombo", $value);
        parent::SetParameterSP("idTipoReporteDetalle", "");
        parent::SetParameterSP("idReporteDetalle", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function cboTipoReporteDetalle() {
        parent::ConnectionOpen("pnsMantenimientoReportes", "dbweb");
        parent::SetParameterSP("op", '9');
        parent::SetParameterSP("idReporte", "");
        parent::SetParameterSP("nomReporte", "");
        parent::SetParameterSP("stdReporte", "");
        parent::SetParameterSP("idEtiqueta", "");
        parent::SetParameterSP("nomEtiqueta", "");
        parent::SetParameterSP("stdEtiqueta", "");
        parent::SetParameterSP("ordenEtiqueta", "");
        parent::SetParameterSP("idAtributo", "");
        parent::SetParameterSP("nomAtributo", "");
        parent::SetParameterSP("stdAtributo", "");
        parent::SetParameterSP("tpoAtributo", "");
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", "");
        parent::SetParameterSP("idCombo", "");
        parent::SetParameterSP("txtCombo", "");
        parent::SetParameterSP("valCombo", "");
        parent::SetParameterSP("idTipoReporteDetalle", "");
        parent::SetParameterSP("idReporteDetalle", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function grabarReporteDetalle($idEtiqueta, $datosTipo) {
        parent::ConnectionOpen("pnsMantenimientoReportes", "dbweb");
        parent::SetParameterSP("op", '10');
        parent::SetParameterSP("idReporte", $datosTipo["q1"]);
        parent::SetParameterSP("nomReporte", "");
        parent::SetParameterSP("stdReporte", "");
        parent::SetParameterSP("idEtiqueta", $idEtiqueta);
        parent::SetParameterSP("nomEtiqueta", "");
        parent::SetParameterSP("stdEtiqueta", "");
        parent::SetParameterSP("ordenEtiqueta", "");
        parent::SetParameterSP("idAtributo", "");
        parent::SetParameterSP("nomAtributo", "");
        parent::SetParameterSP("stdAtributo", "");
        parent::SetParameterSP("tpoAtributo", "");
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", $datosTipo["q4"]);
        parent::SetParameterSP("idCombo", "");
        parent::SetParameterSP("txtCombo", "");
        parent::SetParameterSP("valCombo", "");
        parent::SetParameterSP("idTipoReporteDetalle", $datosTipo["q2"]);
        parent::SetParameterSP("idReporteDetalle", $datosTipo["q3"]);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function traerValoresCombo($datos) {
        parent::ConnectionOpen("pnsMantenimientoReportes", "dbweb");
        parent::SetParameterSP("op", '11');
        parent::SetParameterSP("idReporte", "");
        parent::SetParameterSP("nomReporte", "");
        parent::SetParameterSP("stdReporte", "");
        parent::SetParameterSP("idEtiqueta", "");
        parent::SetParameterSP("nomEtiqueta", "");
        parent::SetParameterSP("stdEtiqueta", "");
        parent::SetParameterSP("ordenEtiqueta", "");
        parent::SetParameterSP("idAtributo", $datos["idAtributo"]);
        parent::SetParameterSP("nomAtributo", "");
        parent::SetParameterSP("stdAtributo", "");
        parent::SetParameterSP("tpoAtributo", "");
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", "");
        parent::SetParameterSP("idCombo", "");
        parent::SetParameterSP("txtCombo", "");
        parent::SetParameterSP("valCombo", "");
        parent::SetParameterSP("idTipoReporteDetalle", "");
        parent::SetParameterSP("idReporteDetalle", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function cargarAtributoCombo($idAtributo) {
        parent::ConnectionOpen("pnsMantenimientoReportes", "dbweb");
        parent::SetParameterSP("op", '12');
        parent::SetParameterSP("idReporte", "");
        parent::SetParameterSP("nomReporte", "");
        parent::SetParameterSP("stdReporte", "");
        parent::SetParameterSP("idEtiqueta", "");
        parent::SetParameterSP("nomEtiqueta", "");
        parent::SetParameterSP("stdEtiqueta", "");
        parent::SetParameterSP("ordenEtiqueta", "");
        parent::SetParameterSP("idAtributo", $idAtributo);
        parent::SetParameterSP("nomAtributo", "");
        parent::SetParameterSP("stdAtributo", "");
        parent::SetParameterSP("tpoAtributo", "");
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", "");
        parent::SetParameterSP("idCombo", "");
        parent::SetParameterSP("txtCombo", "");
        parent::SetParameterSP("valCombo", "");
        parent::SetParameterSP("idTipoReporteDetalle", "");
        parent::SetParameterSP("idReporteDetalle", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function grabarEtiquetaAtributo($datos) {
        parent::ConnectionOpen("pnsMantenimientoReportes", "dbweb");
        parent::SetParameterSP("op", '13');
        parent::SetParameterSP("idReporte", "");
        parent::SetParameterSP("nomReporte", "");
        parent::SetParameterSP("stdReporte", "");
        parent::SetParameterSP("idEtiqueta", $datos["p2"]);
        parent::SetParameterSP("nomEtiqueta", "");
        parent::SetParameterSP("stdEtiqueta", "");
        parent::SetParameterSP("ordenEtiqueta", "");
        parent::SetParameterSP("idAtributo", $datos["p1"]);
        parent::SetParameterSP("nomAtributo", "");
        parent::SetParameterSP("stdAtributo", "");
        parent::SetParameterSP("tpoAtributo", $datos["p4"]); //idTipoEtiquetaAtributo
        parent::SetParameterSP("user", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("host", strtoupper($_SESSION['host']));
        parent::SetParameterSP("hacer", $datos["p3"]); //textVale
        parent::SetParameterSP("idCombo", "");
        parent::SetParameterSP("txtCombo", "");
        parent::SetParameterSP("valCombo", "");
        parent::SetParameterSP("idTipoReporteDetalle", "");
        parent::SetParameterSP("idReporteDetalle", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function listaEtiquetaAtributo($idEtiqueta) {
        parent::ConnectionOpen("pnsMantenimientoReportes", "dbweb");
        parent::SetParameterSP("op", '14');
        parent::SetParameterSP("idReporte", "");
        parent::SetParameterSP("nomReporte", "");
        parent::SetParameterSP("stdReporte", "");
        parent::SetParameterSP("idEtiqueta", $idEtiqueta);
        parent::SetParameterSP("nomEtiqueta", "");
        parent::SetParameterSP("stdEtiqueta", "");
        parent::SetParameterSP("ordenEtiqueta", "");
        parent::SetParameterSP("idAtributo", "");
        parent::SetParameterSP("nomAtributo", "");
        parent::SetParameterSP("stdAtributo", "");
        parent::SetParameterSP("tpoAtributo", "");
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", "");
        parent::SetParameterSP("idCombo", "");
        parent::SetParameterSP("txtCombo", "");
        parent::SetParameterSP("valCombo", "");
        parent::SetParameterSP("idTipoReporteDetalle", "");
        parent::SetParameterSP("idReporteDetalle", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function switchEtiquetaAtributo($datos) {
        parent::ConnectionOpen("pnsMantenimientoReportes", "dbweb");
        parent::SetParameterSP("op", '15');
        parent::SetParameterSP("idReporte", "");
        parent::SetParameterSP("nomReporte", "");
        parent::SetParameterSP("stdReporte", "");
        parent::SetParameterSP("idEtiqueta", $datos["p1"]);   //por aqui paso el id de la tabla dbweb.nsdEtiquetaAtributoFormato
        parent::SetParameterSP("nomEtiqueta", "");
        parent::SetParameterSP("stdEtiqueta", $datos["p2"]);  //por aqui paso el estado de la tabla dbweb.nsdEtiquetaAtributoFormato
        parent::SetParameterSP("ordenEtiqueta", "");
        parent::SetParameterSP("idAtributo", "");
        parent::SetParameterSP("nomAtributo", "");
        parent::SetParameterSP("stdAtributo", "");
        parent::SetParameterSP("tpoAtributo", "");
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", "");
        parent::SetParameterSP("idCombo", "");
        parent::SetParameterSP("txtCombo", "");
        parent::SetParameterSP("valCombo", "");
        parent::SetParameterSP("idTipoReporteDetalle", "");
        parent::SetParameterSP("idReporteDetalle", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function atributosRecetaMedica($idReporte) {
        parent::ConnectionOpen("pnsMantenimientoReportes", "dbweb");
        parent::SetParameterSP("op", '16');
        parent::SetParameterSP("idReporte", $idReporte);
        parent::SetParameterSP("nomReporte", "");
        parent::SetParameterSP("stdReporte", "");
        parent::SetParameterSP("idEtiqueta", "");
        parent::SetParameterSP("nomEtiqueta", "");
        parent::SetParameterSP("stdEtiqueta", "");
        parent::SetParameterSP("ordenEtiqueta", "");
        parent::SetParameterSP("idAtributo", "");
        parent::SetParameterSP("nomAtributo", "");
        parent::SetParameterSP("stdAtributo", "");
        parent::SetParameterSP("tpoAtributo", "");
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", "");
        parent::SetParameterSP("idCombo", "");
        parent::SetParameterSP("txtCombo", "");
        parent::SetParameterSP("valCombo", "");
        parent::SetParameterSP("idTipoReporteDetalle", "");
        parent::SetParameterSP("idReporteDetalle", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function modificarEtiquetaAtributo($datos) {
        parent::ConnectionOpen("pnsMantenimientoReportes", "dbweb");
        parent::SetParameterSP("op", '17');
        parent::SetParameterSP("idReporte", "");
        parent::SetParameterSP("nomReporte", "");
        parent::SetParameterSP("stdReporte", "");
        parent::SetParameterSP("idEtiqueta", "");
        parent::SetParameterSP("nomEtiqueta", "");
        parent::SetParameterSP("stdEtiqueta", "");
        parent::SetParameterSP("ordenEtiqueta", "");
        parent::SetParameterSP("idAtributo", $datos["p1"]); //id de nsdEtiquetaAtributoFormato
        parent::SetParameterSP("nomAtributo", $datos["p2"]); // valor de nsdEtiquetaAtributoFormato
        parent::SetParameterSP("stdAtributo", "");
        parent::SetParameterSP("tpoAtributo", $datos["p3"]);  //idTipoEtiquetaAtributo
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", ""); //textVale
        parent::SetParameterSP("idCombo", "");
        parent::SetParameterSP("txtCombo", "");
        parent::SetParameterSP("valCombo", "");
        parent::SetParameterSP("idTipoReporteDetalle", "");
        parent::SetParameterSP("idReporteDetalle", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function labelReportePdf($reporte, $idReporte, $idTipoReporteDetalle) {
        parent::ConnectionOpen("pnsMantenimientoReportes", "dbweb");
        parent::SetParameterSP("op", '18');
        parent::SetParameterSP("idReporte", $idReporte);
        parent::SetParameterSP("nomReporte", "");
        parent::SetParameterSP("stdReporte", "");
        parent::SetParameterSP("idEtiqueta", "");
        parent::SetParameterSP("nomEtiqueta", "");
        parent::SetParameterSP("stdEtiqueta", "");
        parent::SetParameterSP("ordenEtiqueta", "");
        parent::SetParameterSP("idAtributo", "");
        parent::SetParameterSP("nomAtributo", "");
        parent::SetParameterSP("stdAtributo", "");
        parent::SetParameterSP("tpoAtributo", "");
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", $reporte);
        parent::SetParameterSP("idCombo", "");
        parent::SetParameterSP("txtCombo", "");
        parent::SetParameterSP("valCombo", "");
        parent::SetParameterSP("idTipoReporteDetalle", $idTipoReporteDetalle);
        parent::SetParameterSP("idReporteDetalle", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function cboTipoEtiquetaAtributo() {
        parent::ConnectionOpen("pnsMantenimientoReportes", "dbweb");
        parent::SetParameterSP("op", '19');
        parent::SetParameterSP("idReporte", "");
        parent::SetParameterSP("nomReporte", "");
        parent::SetParameterSP("stdReporte", "");
        parent::SetParameterSP("idEtiqueta", "");
        parent::SetParameterSP("nomEtiqueta", "");
        parent::SetParameterSP("stdEtiqueta", "");
        parent::SetParameterSP("ordenEtiqueta", "");
        parent::SetParameterSP("idAtributo", "");
        parent::SetParameterSP("nomAtributo", "");
        parent::SetParameterSP("stdAtributo", "");
        parent::SetParameterSP("tpoAtributo", "");
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", "");
        parent::SetParameterSP("idCombo", "");
        parent::SetParameterSP("txtCombo", "");
        parent::SetParameterSP("valCombo", "");
        parent::SetParameterSP("idTipoReporteDetalle", "");
        parent::SetParameterSP("idReporteDetalle", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function eliminaDbComboAtributo($datos) {
        parent::ConnectionOpen("pnsMantenimientoReportes", "dbweb");
        parent::SetParameterSP("op", '20');
        parent::SetParameterSP("idReporte", "");
        parent::SetParameterSP("nomReporte", "");
        parent::SetParameterSP("stdReporte", "");
        parent::SetParameterSP("idEtiqueta", "");
        parent::SetParameterSP("nomEtiqueta", "");
        parent::SetParameterSP("stdEtiqueta", "");
        parent::SetParameterSP("ordenEtiqueta", "");
        parent::SetParameterSP("idAtributo", $datos["p1"]);
        parent::SetParameterSP("nomAtributo", "");
        parent::SetParameterSP("stdAtributo", "");
        parent::SetParameterSP("tpoAtributo", "");
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", "");
        parent::SetParameterSP("idCombo", $datos["p2"]);
        parent::SetParameterSP("txtCombo", "");
        parent::SetParameterSP("valCombo", "");
        parent::SetParameterSP("idTipoReporteDetalle", "");
        parent::SetParameterSP("idReporteDetalle", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function existeRecetaMedica($codigoProgramacion) {
        parent::ConnectionOpen("pnsImprimirReportes", "dbweb");
        parent::SetParameterSP("op", '1');
        parent::SetParameterSP("codProg", $codigoProgramacion);
        parent::SetParameterSP("hacer", "");
        parent::SetParameterSP("int1", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function datosRecetaMedica($codProgramacion) {
        parent::ConnectionOpen("pnsImprimirReportes", "dbweb");
        parent::SetParameterSP("op", '2');
        parent::SetParameterSP("codProg", $codProgramacion);
        parent::SetParameterSP("hacer", "");
        parent::SetParameterSP("int1", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function datosPaciente($codPaciente) {
        parent::ConnectionOpen("pnsImprimirReportes", "dbweb");
        parent::SetParameterSP("op", '3');
        parent::SetParameterSP("codProg", "");
        parent::SetParameterSP("hacer", "");
        parent::SetParameterSP("int1", $codPaciente);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function datosPacienteImprimirHIstoria($idProgramacion) {
        parent::ConnectionOpen("nsmImprimirReporteHistoriaXDia", "dbweb");
        parent::SetParameterSP("opcion", '1');
        parent::SetParameterSP("var1", $idProgramacion);
        parent::SetParameterSP("var2", "");
        parent::SetParameterSP("var3", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function centroCostosPorServicio($codProducto) {
        parent::ConnectionOpen("nsmImprimirReporteHistoriaXDia", "dbweb");
        parent::SetParameterSP("opcion", '2');
        parent::SetParameterSP("var1", $codProducto);
        parent::SetParameterSP("var2", "");
        parent::SetParameterSP("var3", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function datosMedico($codMedico) {
        parent::ConnectionOpen("pnsImprimirReportes", "dbweb");
        parent::SetParameterSP("op", '4');
        parent::SetParameterSP("codProg", "");
        parent::SetParameterSP("hacer", $codMedico);
        parent::SetParameterSP("int1", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function verificarHistoriaClinica($datos) {
        parent::ConnectionOpen("pnsImprimirReportes", "dbweb");
        parent::SetParameterSP("op", '5');
        parent::SetParameterSP("codProg", "");
        parent::SetParameterSP("hacer", $datos["p1"]); //id persona
        parent::SetParameterSP("int1", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function datosPacienteRecetaEstandarizada($codPersona, $idProgramacion) {
        parent::ConnectionOpen("pnsImprimirReportes", "dbweb");
        parent::SetParameterSP("op", '6');
        parent::SetParameterSP("codProg", $idProgramacion);
        parent::SetParameterSP("hacer", $codPersona);
        parent::SetParameterSP("int1", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dDatosPacienteTicketOrden($idTratamiento) {
        parent::ConnectionOpen("pnsImprimirReportes", "dbweb");
        parent::SetParameterSP("op", '14');
        parent::SetParameterSP("codProg", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("int1", $idTratamiento);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function fechasTratamienos($idProgramacion) {
        parent::ConnectionOpen("pnsImprimirReportes", "dbweb");
        parent::SetParameterSP("op", '7');
        parent::SetParameterSP("codProg", $idProgramacion);
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("int1", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    /* CAJA SIMEDH WEB */

    function verificarRecibodePago($datos) {
        parent::ConnectionOpen("pnsImprimirReportes", "dbweb");
        parent::SetParameterSP("op", '8');
        parent::SetParameterSP("codProg", "");
        parent::SetParameterSP("hacer", $datos["numeroRecibo"]); //numeroRecibo
        parent::SetParameterSP("int1", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getDatosEmpresaGeneraelRecibo($codigoEmpresa) {
        parent::ConnectionOpen("pnsImprimirReportes", "dbweb");
        parent::SetParameterSP("op", '9');
        parent::SetParameterSP("codProg", "");
        parent::SetParameterSP("hacer", $codigoEmpresa); //numeroRecibo
        parent::SetParameterSP("int1", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getDatosPacienteGeneraelRecibo($numeroRecibo) {
        parent::ConnectionOpen("pnsImprimirReportes", "dbweb");
        parent::SetParameterSP("op", '10');
        parent::SetParameterSP("codProg", "");
        parent::SetParameterSP("hacer", $numeroRecibo); //numeroRecibo
        parent::SetParameterSP("int1", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getDatosDetalleReciboGenerado($numeroRecibo) {
        parent::ConnectionOpen("pnsImprimirReportes", "dbweb");
        parent::SetParameterSP("op", '11');
        parent::SetParameterSP("codProg", "");
        parent::SetParameterSP("hacer", $numeroRecibo); //numeroRecibo
        parent::SetParameterSP("int1", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getDatosPieReciboGenerado($numeroRecibo) {
        parent::ConnectionOpen("pnsImprimirReportes", "dbweb");
        parent::SetParameterSP("op", '12');
        parent::SetParameterSP("codProg", "");
        parent::SetParameterSP("hacer", $numeroRecibo); //numeroRecibo
        parent::SetParameterSP("int1", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function fechaEmiteResibo() {
        parent::ConnectionOpen("pnsImprimirReportes", "dbweb");
        parent::SetParameterSP("op", '13');
        parent::SetParameterSP("codProg", "");
        parent::SetParameterSP("hacer", ''); //numeroRecibo
        parent::SetParameterSP("int1", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function ExitenciaHistoriaClinica($c_cod_per) {
        parent::ConnectionOpen("pnsImprimirReportes", "dbweb");
        parent::SetParameterSP("op", '14');
        parent::SetParameterSP("codProg", '');
        parent::SetParameterSP("hacer", $c_cod_per); //numeroRecibo
        parent::SetParameterSP("int1", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function eliminarEstadisticaGuardada($datos) {
        parent::ConnectionOpen("pnsReportesEstadisticosActoMedico", "dbweb");
        parent::SetParameterSP("bus", '8');
        parent::SetParameterSP("pv1", $datos["IdGrafico"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        parent::SetParameterSP("pv5", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function verificarHistoriaClinicaXDia($datos) {
        parent::ConnectionOpen("pnsImprimirHcXDia", "dbweb");
        parent::SetParameterSP("bus", '2');
        parent::SetParameterSP("var1", $datos['codProgramacion']);
        parent::SetParameterSP("var2", '');
        parent::SetParameterSP("var3", '');
        parent::SetParameterSP("var4", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function DbuscarReporteGruposEtareos() {
        parent::ConnectionOpen("pnsReporteGrupoEtareo", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("int1", '');
        parent::SetParameterSP("int2", '');
        parent::SetParameterSP("char1", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function DbuscarPersonasGrupoEtareo($datos) {
        parent::ConnectionOpen("pnsReporteGrupoEtareo", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("int1", $datos['iIdGrupoEtareo']);
        parent::SetParameterSP("int2", $datos['ServComple']);
        parent::SetParameterSP("char1", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function DmostrarCPTfaltantes($datos) {
        parent::ConnectionOpen("pnsReporteGrupoEtareo", "dbweb");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("int1", '');
        parent::SetParameterSP("int2", '');
        parent::SetParameterSP("char1", $datos['c_cod_per']);
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function buscarMedicamento($datos) {
        parent::ConnectionOpen("pnsReporteRecetaMedica", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("var1", '');
        parent::SetParameterSP("var2", '');
        parent::SetParameterSP("var3", '');
        parent::SetParameterSP("var4", '');
        parent::SetParameterSP("var5", $datos['vNombreMedicamento']);
        parent::SetParameterSP("var6", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function buscarMEdico($datos) {
        parent::ConnectionOpen("pnsReporteRecetaMedica", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("var1", '');
        parent::SetParameterSP("var2", '');
        parent::SetParameterSP("var3", '');
        parent::SetParameterSP("var4", '');
        parent::SetParameterSP("var5", '');
        parent::SetParameterSP("var6", $datos['vNOmbreMedico']);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function mostrarReportesFechasRecetaMedica($datos) {
        parent::ConnectionOpen("pnsReporteRecetaMedica", "dbweb");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("var1", $datos["fecha1"]);
        parent::SetParameterSP("var2", $datos["fecha2"]);
        parent::SetParameterSP("var3", $datos["medicamento"]);
        parent::SetParameterSP("var4", $datos["medico"]);
        parent::SetParameterSP("var5", '');
        parent::SetParameterSP("var6", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function mostrarReportesMedicamentoRecetaMedica($datos) {
        parent::ConnectionOpen("pnsReporteRecetaMedica", "dbweb");
        parent::SetParameterSP("accion", '4');
        parent::SetParameterSP("var1", $datos["fecha1"]);
        parent::SetParameterSP("var2", $datos["fecha2"]);
        parent::SetParameterSP("var3", $datos["medicamento"]);
        parent::SetParameterSP("var4", $datos["medico"]);
        parent::SetParameterSP("var5", '');
        parent::SetParameterSP("var6", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function mostrarReportesFechasMedico($datos) {
        parent::ConnectionOpen("pnsReporteRecetaMedica", "dbweb");
        parent::SetParameterSP("accion", '5');
        parent::SetParameterSP("var1", $datos["fecha1"]);
        parent::SetParameterSP("var2", $datos["fecha2"]);
        parent::SetParameterSP("var3", $datos["medicamento"]);
        parent::SetParameterSP("var4", $datos["medico"]);
        parent::SetParameterSP("var5", '');
        parent::SetParameterSP("var6", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function dCargarTablaProgramacionDHTMLX() {
        parent::ConnectionOpen("nsmProgramacionUBAP", "dbweb");
        parent::SetParameterSP("accion", 1);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function dmostrarReporteOperacionalTBC() {
        parent::ConnectionOpen("nsmProgramacionUBAP", "dbweb");
        parent::SetParameterSP("accion", 2);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }
    function dArrayHojaNSIG() {
        parent::ConnectionOpen("nsmProgramacionUBAP", "dbweb");
        parent::SetParameterSP("accion", 7);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }
    
     function dArrayGrupoNSIG() {
        parent::ConnectionOpen("nsmProgramacionUBAP", "dbweb");
        parent::SetParameterSP("accion", 8);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }
     function dArrayActividadNSIG() {
        parent::ConnectionOpen("nsmProgramacionUBAP", "dbweb");
        parent::SetParameterSP("accion", 9);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }
     function dArrayServicioNSIG() {
        parent::ConnectionOpen("nsmProgramacionUBAP", "dbweb");
        parent::SetParameterSP("accion", 10);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }
     function rptAntecedentesPRograma($idPrograma) {
        parent::ConnectionOpen("pnsMantenimientoAntecedentes", "dbweb");
        parent::SetParameterSP("$1", '7');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", $idPrograma                                                                               );
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", $_SESSION["login_user"]);
        parent::SetParameterSP("$11", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }
    function dDatosExamenes($iIdUbicacionesImagenes) {
        //parent::Liberar_Parametros();
        parent::ConnectionOpen("pnsMantenimientoImagenes", "dbweb");
        parent::SetParameterSP("@var1", 6);
        parent::SetParameterSP("@var2", $iIdUbicacionesImagenes);
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@var4", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }
    
    
    
    

}

?>
