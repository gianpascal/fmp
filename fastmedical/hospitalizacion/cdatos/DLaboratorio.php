<?php

include_once("../../../pholivo/adophp/Adophp.class.php");
require_once("../../../pholivo/Conexion.php");

class DLaboratorio extends Adophp {

    private $cnx;
    private $oRecord;

    public function __construct($cnx = Array()) {
        $this->cnx = empty($cnx) ? Conexion::getInitDsnMSSQLSimedh() : $cnx;
        parent::__construct('Spanish', $this->cnx);
    }

    //Peche
    public function dTablaPuntosControl() {
        parent::ConnectionOpen("pnsPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '1');
        parent::SetParameterSP("@varInt1", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varBit1", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dPersonasPorPuntoControl($idPuntoControl, $fecha) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '31');
        parent::SetParameterSP("@varInt1", $idPuntoControl);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", $fecha);
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dcomboPuntoControl() {
        parent::ConnectionOpen("pnsPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '5');
        parent::SetParameterSP("@varInt1", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varBit1", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dObtenerDetallePuntoControl($id) {
        parent::ConnectionOpen("pnsPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '4');
        parent::SetParameterSP("@varInt1", $id);
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varBit1", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dGrabarDetallePuntoControl($datos) {
        parent::ConnectionOpen("pnsPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '2');
        parent::SetParameterSP("@varInt1", $datos["idPuntoControl"]);
        parent::SetParameterSP("@varVarchar1", $datos["nombre"]);
        parent::SetParameterSP("@varVarchar2", $datos["descripcion"]);
        parent::SetParameterSP("@varBit1", $datos["estado"]);
        parent::SetParameterSP("@varVarchar3", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("@varVarchar4", $_SESSION['host']);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dAgregarDetallePuntoControl($datos) {

        parent::ConnectionOpen("pnsPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '3');
        parent::SetParameterSP("@varInt1", $datos["idPuntoControl"]);
        parent::SetParameterSP("@varVarchar1", $datos["nombre"]);
        parent::SetParameterSP("@varVarchar2", $datos["descripcion"]);
        parent::SetParameterSP("@varBit1", $datos["estado"]);
        parent::SetParameterSP("@varVarchar3", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("@varVarchar4", $_SESSION['host']);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dCargartablaPerfiles() {
        parent::ConnectionOpen("pnsMantenimientoPerfilesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '1');
        parent::SetParameterSP("@varInt1", '');
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dCargarTablaPerfilesExamenes($parametros) {
        parent::ConnectionOpen("pnsMantenimientoPerfilesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '2');
        parent::SetParameterSP("@varInt1", $parametros["p2"]);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function DbuscarExamenesLaboratorio($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '01');
        parent::SetParameterSP("nombreExamen", $datos["nombreExamen"]);
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("3", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function DreporteDePuntoControlXExamen($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '02');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", $datos["iIdExamenesLaboratorio"]);
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');

        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("3", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function DreporteDePuntoControl($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '03');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", $datos["iIdExamenesLaboratorio"]);
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("3", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function DguardarNuevoPuntoControl($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '04');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", $datos["iIdExamenesLaboratorio"]);
        parent::SetParameterSP("iIdpuntoControl", $datos["iIdpuntoControl"]);
        parent::SetParameterSP("maximaSecuencia", $datos["maximaSecuencia"]);
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("3", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function DmaximonivelPuntoControlExamenes($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '05');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", $datos["iIdExamenesLaboratorio"]);
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("3", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    // laboratorio de JCQA //


    public function dActualizarDetalleExamenLabo($parametros) {



        parent::ConnectionOpen("pnsMantenimientoExamenes", "dbweb");
        parent::SetParameterSP("$1", '4');
        parent::SetParameterSP("nombreExamen", $parametros["p4"]); //descripExa
        parent::SetParameterSP("iIdExamenesLaboratorio", $parametros["p2"]); //idExamenLabo
        parent::SetParameterSP("iIdpuntoControl", $parametros["p3"]); //tipoExaLab
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function DlistarTiposdeExamenesLaboratorio() {

        parent::ConnectionOpen("pnsMantenimientoExamenes", "dbweb");
        parent::SetParameterSP("$1", '5');
        parent::SetParameterSP("nombreExamen", ''); //descripExa
        parent::SetParameterSP("iIdExamenesLaboratorio", ''); //idExamenLabo
        parent::SetParameterSP("iIdpuntoControl", ''); //tipoExaLab
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function DlistarTiposdeMaterialesLabo() {

        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '2');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//creado x JCQA 9agosto2012   
    public function DMuestraRecibirenPuntoControl($datos) {

        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '15');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos["iIdExamenesLaboratorio"]);
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function DpreMostrarCVjc($idMaterialLaboratorio) {
        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '11');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $idMaterialLaboratorio);
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function guardarAtributoDocumentoEmpledojc($idMaterialLaboratorio, $nomfileupload) {

        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '12');
        parent::SetParameterSP("@var1", $nomfileupload);
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $idMaterialLaboratorio);
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dmostrarExamenesLaboratorio() {

        parent::ConnectionOpen("pnsMantenimientoExamenes", "dbweb");
        parent::SetParameterSP("$1", '1');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dmostrarMaterialesDeLaboratorio() {


        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '1');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //29 Enero 2012
    public function dgetTratamientoPaciente($datos) {

        parent::ConnectionOpen("pnsgetTratamientoPaciente", "dbweb");
        parent::SetParameterSP("@accion", '1');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", $datos["iid_persona"]);
        parent::SetParameterSP("@char2", $datos["arrayCod_Ser_Pro"]);

        parent::SetParameterSP("@char3", $datos["hiCodigoFiliacionActiva"]);
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dgetVinculadosTratamientoPaciente($datos) {

        parent::ConnectionOpen("pnsgetTratamientoPaciente", "dbweb");
        parent::SetParameterSP("@accion", '5');
        parent::SetParameterSP("@var1", $datos["hServicioConsultorio"]);
        parent::SetParameterSP("@var2", $datos["hServiciosProcedimientos"]);
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", $datos["iid_persona"]);
        parent::SetParameterSP("@char2", $datos["arrayCod_Ser_Pro"]);
        parent::SetParameterSP("@char3", $datos["hiCodigoFiliacionActiva"]);
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');

        parent::SetParameterSP("@char4", $datos["codigoTipoCita"]);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //29 Enero 2012
    public function dcargarTablaVincularRecetasConTratamientos($datos) {

        parent::ConnectionOpen("pnsgetTratamientoPaciente", "dbweb");
        parent::SetParameterSP("@accion", '5');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", $datos["iid_persona"]);
        parent::SetParameterSP("@char2", $datos["arrayCod_Ser_Pro"]);

        parent::SetParameterSP("@char3", $datos["hiCodigoFiliacionActiva"]);
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dgetTratamientoPaciente2($datos) {

        parent::ConnectionOpen("pnsgetTratamientoPaciente", "dbweb");
        parent::SetParameterSP("@accion", '3');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", $datos["iid_persona"]);
        parent::SetParameterSP("@char2", $datos["arrayCod_Ser_Pro"]);

        parent::SetParameterSP("@char3", $datos["hiCodigoFiliacionActiva"]);
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //29 Enero 2012
    public function dcontarRegistrosgetTratamientoPaciente($datos) {

        parent::ConnectionOpen("pnsgetTratamientoPaciente", "dbweb");
        parent::SetParameterSP("@accion", '2');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", $datos["iid_persona"]);
        parent::SetParameterSP("@char2", $datos["arrayCod_Ser_Pro"]);
        parent::SetParameterSP("@char3", $datos["hiCodigoFiliacionActiva"]);
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dcargarTablaUnidadesxTipoxMaterialLaboratorio($parametros) {


        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '3');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $parametros["p2"]);
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //CREADO 20 JULIO JCQA
    public function DlistarUnidadMedidaxMaterialLaboratorio() {


        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '4');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function DcargarComboUnidadMedidaPopudML($datos) {


        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '5');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos["IdTipoUnidadMedidaSeleccionada"]);
        parent::SetParameterSP("@int2", $datos["idtMaterialLaboratorio"]);
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //creado por JCQA 10 Agosto 2012  COMBO TIPO UNIDAD MEDIDA -- MATERIAL LABORATORIO

    public function DcargarComboTipoUnidadMedidaMaterialSeleccionado($datos) {


        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '17');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos["idMaterialLaboratorio"]);
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //creado por JCQA 10 Agosto 2012  COMBO TIPO UNIDAD MEDIDA -- MATERIAL LABORATORIO

    public function DcargarComboUnidadMedidaMaterialSeleccionado($datos) {


        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '21');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos["hIdMaterialLaboratorio"]);
        parent::SetParameterSP("@int2", $datos["TipoUnidadMedidaEscogida"]);
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //creado por JCQA 24 Septiembre2012 

    public function dllistarMatxPCxE($datos) {

        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '25');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos["hidPuntoControlExamenLab"]);
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //creado por JCQA 24 Septiembre2012 

    public function dlistarMuestrasxPCxE($datos) {

        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '27');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos["hidPuntoControlExamenLab"]);
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //creado por JCQA 14 Agosto 2012

    public function DcargarComboUnidadMedidaMuestraSeleccionado($datos) {

        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '20');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos["TipoUnidadMedidaEscogidaMuestra"]);
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //creado por JCQA 14 Agosto 2012

    public function DcargarComboTipoUnidadMedidaMuestraSeleccionado() {


        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '19');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dagregarNuevoUnidadalMaterialLaboratorioPoppud($datos) {


        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '6');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos["IdUnidadMedidadSeleccionada"]);
        parent::SetParameterSP("@int2", $datos["IdMaterialLabo"]);
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //  creado por JCQA Lunes 30 Julio, 2012  
    public function dGuardarCambiosDetalleMaterialesdeLaboratorio($datos) {

        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '9');
        parent::SetParameterSP("@var1", $datos["txtDescripcionMaterialLaboratorio"]);
        parent::SetParameterSP("@var2", $datos["txtRutaPrincipalCompleta"]);
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos["IdMaterialLaboratorio"]);
        parent::SetParameterSP("@int2", $datos["IdtipoMaterialLaboratorio"]);
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //  creado por JCQA 28 septiembre 2012  
    public function dActualizarItemMaterialesAlmacenados($datos) {

        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '26');
        parent::SetParameterSP("@var1", $datos["CantidadMaximaMaterial"]);
        parent::SetParameterSP("@var2", $datos["CantidadMinimaMaterial"]);
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos["TipoUnidadMedidaDisponibles"]);
        parent::SetParameterSP("@int2", $datos["UnidadMedidaDisponibles"]);
        parent::SetParameterSP("@int3", $datos["idUnidadMedidaExamenLabotorio"]);
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //  creado por JCQA 01 octubre 2012  
    public function dActualizarItemMuestraAlmacenados($datos) {

        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '28');
        parent::SetParameterSP("@var1", $datos["txtCantidadMaximaMuestraSeleccionada"]);
        parent::SetParameterSP("@var2", $datos["txtCantidadMinimaMuestraSeleccionada"]);
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos["cboTipoUnidadMedidaMuestraSeleccionada"]);
        parent::SetParameterSP("@int2", $datos["cboUnidadMedidaMuestraSeleccionada"]);
        parent::SetParameterSP("@int3", $datos["idMuestraPuntoControlLaboratorio"]);
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //  creado por JCQA 03 octubre 2012  
    public function dEliminarItemMuestraAlmacenados($datos) {

        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '29');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", $datos["idMuestraPuntoControlLaboratorio"]);
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //  creado por JCQA 03 octubre 2012  
    public function dEliminarItemMaterialesAlmacenados($datos) {

        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '30');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", $datos["idUnidadMedidaExamenLab"]);
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //  creado por JCQA 19 septiembre , 2012  
    public function dpresentarfotoDeMaterialLaboratorio($datos) {


        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '24');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos["IdMaterialLaboratorio"]);
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //  creado por JCQA Martes 7 Agosto, 2012  
    public function DseleccionandoMuestraxPuntoControl($datos) {

        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '13');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos["hidPuntoControlExamenLab"]);
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //  creado por JCQA Martes 8 Agosto, 2012  
    public function DseleccionandoPuntoControlRecibir($datos) {

        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '14');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos["hidPuntoControlExamenLab"]);
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", $datos["estadoRecibir"]);
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //  creado por JCQA Martes 1 Agosto, 2012

    public function dGuardarCambiosDetalleMaterialesdeLaboratorio_Nuevo($datos) {

        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '10');
        parent::SetParameterSP("@var1", $datos["txtDescripcionMaterialLaboratorio"]);
        parent::SetParameterSP("@var2", $datos["txtRutaPrincipalCompleta"]);
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos["IdtipoMaterialLaboratorio"]);
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", $datos["CodSerPro"]);
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //  Creado por JCQA Martes 18 Septiembre, 2012


    public function dGuardarMuestraxPuntoControlxExamenLaboratorio($datos) {

        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '22');
        parent::SetParameterSP("@var1", $datos["CantidadMaximaMuestraSeleccionada"]);
        parent::SetParameterSP("@var2", $datos["CantidadMinimaMuestraSeleccionada"]);
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos["IdMuestraLaboratorio"]);
        parent::SetParameterSP("@int2", $datos["IdPuntoControlExamenLaboratorio"]);
        parent::SetParameterSP("@int3", $datos["UnidadMedidaMuestraSeleccionada"]);
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //  Creado por JCQA Martes 19 Septiembre, 2012

    public function dGuardarMaterialxPuntoControlxExamenLaboratorio($datos) {

        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '23');
        parent::SetParameterSP("@var1", $datos["txtCantidadMaximaMaterialLabo"]);
        parent::SetParameterSP("@var2", $datos["txtCantidadMinimaMaterialLabo"]);
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos["IdMaterialLaboratorio"]);
        parent::SetParameterSP("@int2", $datos["idPuntoControlExamenLab"]);
        parent::SetParameterSP("@int3", $datos["UnidadMedidaDisponibles"]);
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//  creado por JCQA Lunes 30 Julio, 2012

    public function dmostrarImagenMaterialLaboratorioTraerData($datos) {


        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '8');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos["idMaterialLaboratorio"]);
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dbuscarMaterialesLaboratorioPopap($datos) {

        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '7');
        parent::SetParameterSP("@var1", $datos["p2"]);
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//creado por JCQA 10 Agosto 2012

    public function dbuscarMaterialesLaboratorioPopap_2($datos) {

        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '16');
        parent::SetParameterSP("@var1", $datos["p2"]);
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//creado por JCQA 14 Agosto 2012

    public function dbuscarMaterialesLaboratorioPopap_3($datos) {

        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '18');
        parent::SetParameterSP("@var1", $datos["p2"]);
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", '');
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dprecioExamenesxAfiliacion($parametros) {
        parent::ConnectionOpen("pnsMantenimientoExamenes", "dbweb");
        parent::SetParameterSP("$1", '2');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@var3", $parametros["p2"]);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dListarTiposAfiliacionExamenLaboratorio() {
        parent::ConnectionOpen("pnsMantenimientoExamenes", "dbweb");
        parent::SetParameterSP("$1", '3');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@var3", '');

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function DsubirBajarSecuenciaPuntoControl($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '06');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", $datos["iIdExamenesLaboratorio"]);
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", $datos["iNivelInicial"]);
        parent::SetParameterSP("iNivelFinal", $datos["iNivelFinal"]);
        parent::SetParameterSP("idPuntoControlExamenLab", $datos["idPuntoControlExamenLab"]);

        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("3", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dCargarTablaExamenesLaboratorio($parametros) {
        parent::ConnectionOpen("pnsMantenimientoPerfilesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '3');
        parent::SetParameterSP("@varInt1", $parametros["p2"]);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//17/07/2012
    public function dCargarTablaUsuariosHabilitadosXPuntoControl($parametros) {
        parent::ConnectionOpen("pnsMantenimientoUsuariosPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '1');
        parent::SetParameterSP("@varInt1", $parametros["p2"]);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dEliminarPerfilesExamenes($parametros) {
        parent::ConnectionOpen("pnsMantenimientoPerfilesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '4');
        parent::SetParameterSP("@varInt1", $parametros["p2"]);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varVarchar1", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("@varVarchar2", $_SESSION['host']);
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dAsignarExamenAPerfil($parametros) {
        parent::ConnectionOpen("pnsMantenimientoPerfilesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '5');
        parent::SetParameterSP("@varInt1", $parametros["p2"]);
        parent::SetParameterSP("@varInt2", $parametros["p3"]);
        parent::SetParameterSP("@varVarchar1", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("@varVarchar2", $_SESSION['host']);
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dAsignarUsuarioXPuntoControl($parametros) {
        parent::ConnectionOpen("pnsMantenimientoUsuariosPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '2');
        parent::SetParameterSP("@varInt1", $parametros["p3"]);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varVarchar1", $parametros["p2"]);
        parent::SetParameterSP("@varVarchar2", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("@varVarchar3", $_SESSION['host']);
        parent::SetParameterSP("@varVarchar4", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//JCDB 17/07/2012
    public function dEliminarUsuariosHabilitadosXPuntoControl($parametros) {
        parent::ConnectionOpen("pnsMantenimientoUsuariosPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '3');
        parent::SetParameterSP("@varInt1", $parametros["p2"]);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varVarchar1", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("@varVarchar2", $_SESSION['host']);
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//JCDB 19/07/2012
    public function dListaActividadesLaboratorio() {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '6');
        parent::SetParameterSP("@varInt1", '');
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//JCDB 19/07/2012
    public function dCargarTablaEstadoExamenes($parametros) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", $parametros["p11"]);
        parent::SetParameterSP("@varInt1", $parametros["p2"]);
        parent::SetParameterSP("@varInt2", $parametros["p3"]);
        parent::SetParameterSP("@varInt3", $_SESSION["id_usuario"]);
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", $parametros["p4"]);
        parent::SetParameterSP("@varVarchar2", $parametros["p5"]);
        parent::SetParameterSP("@varVarchar3", $parametros["p6"]);
        parent::SetParameterSP("@varVarchar4", $parametros["p7"]);
        parent::SetParameterSP("@varVarchar5", $parametros["p8"]);
        parent::SetParameterSP("@varVarchar6", $parametros["p9"]);
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//JCDB 24/07/2012
    public function dActualizarProcedenciaExamenLaboratorio($parametros) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '7');
        parent::SetParameterSP("@varInt1", $parametros["p2"]);
        parent::SetParameterSP("@varInt2", $parametros["p3"]);
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", $_SESSION["login_user"]);
        parent::SetParameterSP("@varVarchar2", $_SESSION['host']);
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//JCDB 26/07/2012
    public function dDescripcionRecipiente($parametros) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '10');
        parent::SetParameterSP("@varInt1", $parametros["p2"]);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//JCDB 26/07/2012
    public function dImagenRecipiente($parametros) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '12');
        parent::SetParameterSP("@varInt1", $parametros["p2"]);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//JCDB 26/07/2012
    public function dInsertarSiguientePuntoControlExamenLaboratorio($parametros) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '9');
        parent::SetParameterSP("@varInt1", $parametros["p2"]);
        parent::SetParameterSP("@varInt2", $parametros["p3"]);
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", $_SESSION["login_user"]);
        parent::SetParameterSP("@varVarchar2", $_SESSION['host']);
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//JCDB 30/07/2012
    public function dCargarTipoMuestra($parametros) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '14');
        parent::SetParameterSP("@varInt1", $parametros["p2"]);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//JCDB 30/07/2012
    public function dCargarTelefono($parametros) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '15');
        parent::SetParameterSP("@varInt1", $parametros["p3"]);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//JCDB 31/07/2012
    public function dActualizarTelefono($parametros) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '16');
        parent::SetParameterSP("@varInt1", $parametros["p3"]);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", $parametros["p5"]);
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//JCDB 31/07/2012
    public function dActualizarCodigoBarra($parametros) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '17');
        parent::SetParameterSP("@varInt1", $parametros["p3"]);
        parent::SetParameterSP("@varInt2", $parametros["p7"]);
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//JCDB 31/07/2012
    public function dProcesarPuntoControl($parametros) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '18');
        parent::SetParameterSP("@varInt1", $parametros["p2"]);
        parent::SetParameterSP("@varInt2", $parametros["p8"]);
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", $_SESSION["login_user"]);
        parent::SetParameterSP("@varVarchar2", $_SESSION['host']);
        parent::SetParameterSP("@varVarchar3", $parametros["p6"]);
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//JCDB 01/08/2012
    public function dCaputarObservacionPuntoControl($parametros) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '19');
        parent::SetParameterSP("@varInt1", $parametros["p4"]);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//JCDB 02/08/2012
    public function dCapturaFechaLaboratorio() {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '20');
        parent::SetParameterSP("@varInt1", '');
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dDatosPacienteLaboratorio($idPacienteLaboratorio) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '15');
        parent::SetParameterSP("@varInt1", $idPacienteLaboratorio);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dModificarCodigoBarras($datos) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '22');
        parent::SetParameterSP("@varInt1", $datos["idPacienteLaboratorio"]);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", $datos["codigoBarras"]);
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dModificarMaterialPersona($datos) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '36');
        parent::SetParameterSP("@varInt1", $datos["iidPacientePuntoControlMateriales"]);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", $_SESSION["login_user"]);
        parent::SetParameterSP("@varVarchar2", $_SESSION['host']);
        parent::SetParameterSP("@varVarchar3", $datos["cantidad"]);
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dVerificarRecibirPuntoControl($datos) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '32');
        parent::SetParameterSP("@varInt1", $datos['idPuntoControl']);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", $datos['codigoBarra']);
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dVerificarProcesarPuntoControl($datos) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '33');
        parent::SetParameterSP("@varInt1", $datos['idPuntoControl']);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", $datos['codigoBarra']);
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dModificarTelefonos($datos) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '26');
        parent::SetParameterSP("@varInt1", '');
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", $datos["telefono"]);
        parent::SetParameterSP("@varVarchar2", $datos["celular1"]);
        parent::SetParameterSP("@varVarchar3", $datos["celular2"]);
        parent::SetParameterSP("@varVarchar4", $datos["codigoTelefono"]);
        parent::SetParameterSP("@varVarchar5", $datos["codigoCelular1"]);
        parent::SetParameterSP("@varVarchar6", $datos["codigoCelular2"]);
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dMantenimientoDinamico($datos) {
        parent::ConnectionOpen("pnsMantenimientoNumerosContacto", "dbweb");
        parent::SetParameterSP("bus", '1');
        parent::SetParameterSP("pv1", $datos["codPaciente"]);
        parent::SetParameterSP("pv2", $datos["telefono"]);
        parent::SetParameterSP("pv3", $datos["codigoTelefono"]);
        parent::SetParameterSP("pv4", $datos["celular1"]);
        parent::SetParameterSP("pv5", $datos["codigoCelular1"]);
        parent::SetParameterSP("pv6", $datos["celular2"]);
        parent::SetParameterSP("pv7", $datos["codigoCelular2"]);
        parent::SetParameterSP("pv8", $_SESSION["login_user"]);
        parent::SetParameterSP("pv9", $_SESSION['host']);
        parent::SetParameterSP("pv10", '');
        parent::SetParameterSP("pv11", '');
        parent::SetParameterSP("pv12", '');
        parent::SetParameterSP("pv13", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dGrabarDatoLaboratorio($datos, $accion) {
        parent::ConnectionOpen("pnsDatosPacienteLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", $accion);
        parent::SetParameterSP("@varInt1", $datos["idDatoExamenPacienteLaboratorio"]);
        parent::SetParameterSP("@varInt2", $datos["idProcesarPuntoControl"]);
        parent::SetParameterSP("@varInt3", $datos["idDatoPuntoControl"]);
        parent::SetParameterSP("@varInt4", $datos["iValor"]);
        parent::SetParameterSP("@nvalor", $datos["nValor"]);
        parent::SetParameterSP("@vvalor", $datos["vValor"]);
        parent::SetParameterSP("@bvalor", $datos["bValor"]);
        parent::SetParameterSP("@icombo", $datos["iCombo"]);
        parent::SetParameterSP("@vUser", $_SESSION["login_user"]);
        parent::SetParameterSP("@vHost", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dTerminarProceso($datos) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '27');
        parent::SetParameterSP("@varInt1", $datos["iIdProcesarPuntoControl"]);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');

        parent::SetParameterSP("@varVarchar1", $datos["observacion"]);
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", $_SESSION["login_user"]);
        parent::SetParameterSP("@varVarchar7", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dRecibirProceso($datos) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '28');
        parent::SetParameterSP("@varInt1", $datos["iIdProcesarPuntoControl"]);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", $datos["observacion"]);
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", $_SESSION["login_user"]);
        parent::SetParameterSP("@varVarchar7", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dDatosPuntoControlPaciente($idPacienteLaboratorio) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '23');
        parent::SetParameterSP("@varInt1", $idPacienteLaboratorio);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dDatosPuntoControlPacienteProcesado($idProcesarPuntoControlProcesar) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '30');
        parent::SetParameterSP("@varInt1", $idProcesarPuntoControlProcesar);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dDatosRecibir($idProcesarPuntoControlRecibir) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '29');
        parent::SetParameterSP("@varInt1", $idProcesarPuntoControlRecibir);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dAgregarProcesarPuntoControl($iIdPacienteLaboratorioPuntoControl, $idTipoProceso) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '25');
        parent::SetParameterSP("@varInt1", $iIdPacienteLaboratorioPuntoControl);
        parent::SetParameterSP("@varInt2", $idTipoProceso);
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", $_SESSION["login_user"]);
        parent::SetParameterSP("@varVarchar2", $_SESSION['host']);
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function darrayComboLaboratorio($iiDCombo) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '24');
        parent::SetParameterSP("@varInt1", $iiDCombo);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dPuntosControlPaciente($idPacienteLaboratorio) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '21');
        parent::SetParameterSP("@varInt1", $idPacienteLaboratorio);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

// lobo 12-07-2012 laboratorio

    public function dDatosMuestra($id) {
        parent::ConnectionOpen("pnsMuestrasPuntoControl", "dbweb");
        parent::SetParameterSP("@bus", '1');
        parent::SetParameterSP("@pv1", $id);
        parent::SetParameterSP("@pv2", '');
        parent::SetParameterSP("@pv3", '');
        parent::SetParameterSP("@pv4", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    //$id=$iIdPacienteLaboratorioPuntoControl

    public function ddatosFraccion($id) {
        parent::ConnectionOpen("pnsMuestrasPuntoControl", "dbweb");
        parent::SetParameterSP("@bus", '2');
        parent::SetParameterSP("@pv1", $id);
        parent::SetParameterSP("@pv2", '');
        parent::SetParameterSP("@pv3", '');
        parent::SetParameterSP("@pv4", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dInsertaPacienteLaboratoriPuntoControl($iIdExamenLaboratorioUnidadMedidaLaboratorio, $iIdPacienteLaboratorioPuntoControlExamen, $cantidad) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '35');
        parent::SetParameterSP("@varInt1", $iIdExamenLaboratorioUnidadMedidaLaboratorio);
        parent::SetParameterSP("@varInt2", $iIdPacienteLaboratorioPuntoControlExamen);
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", $_SESSION["login_user"]);
        parent::SetParameterSP("@varVarchar2", $_SESSION['host']);
        parent::SetParameterSP("@varVarchar3", $cantidad);
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

// lobo 12-07-2012 laboratorio

    public function DEstadoVersicion() {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '07');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("3", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 12-07-2012 laboratorio
    public function DgrupoDePuntoControl($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '08');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", $datos["idPuntoControlExamenLab"]);

        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("3", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 12-07-2012 laboratorio
    public function DagregarNuevoGrupo($datos) {// 
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '09');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", $datos["idPuntoControlExamenLab"]);

        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("iEstadoVersicion", $datos["iEstadoVersicion"]);
        parent::SetParameterSP("nombreGrupo", $datos["nombreGrupo"]);
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("3", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 12-07-2012 laboratorio
    public function DguardarModificadoGrupoDatos($datos) {// 
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '10');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", $datos["nombreGrupoDatosEditar"]);
        parent::SetParameterSP("idGrupo", $datos["idGrupoDatos"]);
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("3", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DeliminarGrupoDatos($datos) {// 
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '11');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", $datos["idGrupoDatos"]);
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("3", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DtipoDatos() {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '12');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("3", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DcargarComboUnidadMedida($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '13');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", $datos["tipoUnidadDeMedida"]);
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("3", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DdatosPuntoControl($idGrupoDatos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '14');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", $idGrupoDatos);
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("3", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DtipoUnidadDeMedida() {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '15');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("3", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DguardarDatosPuntoControl($datos, $cadena) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '16');
        parent::SetParameterSP("nombreExamen", ''); //
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", $datos["idGrupoDatos"]); //
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", $datos["idUnidadDeMedida"]); //
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("idRango", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", $cadena);
        parent::SetParameterSP("tipoDatos", $datos["idTipoDatos"]);
        parent::SetParameterSP("muestraDatosEnExamen", $datos["idVisible"]);
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", $datos["idObligatorio"]);
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DdatosRangos($idDatosPuntoControl) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '17');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", $idDatosPuntoControl);
        parent::SetParameterSP("3", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", '');
        parent::SetParameterSP("bRangoInfinitoPositivo", '');
        parent::SetParameterSP("bRangoInfinitoNegativo", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DeliminarRango($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '18');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("idRango", $datos["idRango"]);
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DmodificarRangos($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '19');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("idRango", $datos["idRango"]);
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", $datos["bSexo"]);
        parent::SetParameterSP("bEdad", $datos["bEdad"]);
        parent::SetParameterSP("iEdadMinima", $datos["iEdadMinima"]);
        parent::SetParameterSP("iEdadMaxima", $datos["iEdadMaxima"]);
        parent::SetParameterSP("iSexo", $datos["iSexo"]);
        parent::SetParameterSP("nValorMinimo", $datos["nValorMinimo"]);
        parent::SetParameterSP("nValorMaximo", $datos["nValorMaximo"]);
        parent::SetParameterSP("vSignificado", $datos["vSignificado"]);
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DmodificarDatosPuntoControl($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '20');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", $datos["tipoUnidadDeMedida"]);
        parent::SetParameterSP("idUnidadMedida", $datos["unidadDeMedidaEditar"]); //
        parent::SetParameterSP("idDatosPuntoControl", $datos["idDatosPuntoControl"]); //
        parent::SetParameterSP("idRango", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", $datos["nombreDatos"]); //
        parent::SetParameterSP("tipoDatos", $datos["tipoDatos"]); //
        parent::SetParameterSP("muestraDatosEnExamen", $datos["muestraDatosEnExamen"]);
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", $datos["iObligatorio"]);
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", '');
        parent::SetParameterSP("bRangoInfinitoPositivo", '');
        parent::SetParameterSP("bRangoInfinitoNegativo", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DEliminarRangoPorDatosPuntoControl($idDatosPuntoControl) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '21');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", ''); //
        parent::SetParameterSP("idDatosPuntoControl", $idDatosPuntoControl); //
        parent::SetParameterSP("idRango", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", ''); //
        parent::SetParameterSP("tipoDatos", ''); //
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", '');
        parent::SetParameterSP("bRangoInfinitoPositivo", '');
        parent::SetParameterSP("bRangoInfinitoNegativo", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DeditarCombo($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '22');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", ''); //
        parent::SetParameterSP("idDatosPuntoControl", $datos["idDatosPuntoControl"]); //$datos["iIdDatosPuntoControl"]
        parent::SetParameterSP("idRango", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", ''); //
        parent::SetParameterSP("tipoDatos", ''); //
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DguardarItemCombo($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '23');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", $datos["idDatosPuntoControl"]);
        parent::SetParameterSP("idRango", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", $datos["nombreItem"]);
        parent::SetParameterSP("iOrden", $datos["iOrden"]);
        parent::SetParameterSP("idCombo", $datos["idCombo"]);
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DmodificarItemCombo($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '24');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("idRango", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", $datos["nombreItem"]);
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", $datos["idItem"]);
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DeliminarDatosCombos($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '25');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", $datos["iTemMax"]);
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("idRango", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", $datos["iOrdenItem"]);
        parent::SetParameterSP("idCombo", $datos["idCombo"]);
        parent::SetParameterSP("idItem", $datos["iIdDatosCombos"]);
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DsubirOrdenItem($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '26');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("idRango", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", $datos["ordenItemActual"]);
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", $datos["idItemComboActual"]);
        parent::SetParameterSP("idItemComboRemplazado", $datos["idItemComboRemplazado"]);
        parent::SetParameterSP("ordenRemplazado", $datos["ordenRemplazado"]);
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DbajarOrdenItem($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '27');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("idRango", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", $datos["ordenItemActual"]);
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", $datos["idItemComboActual"]);
        parent::SetParameterSP("idItemComboRemplazado", $datos["idItemComboRemplazado"]);
        parent::SetParameterSP("ordenRemplazado", $datos["ordenRemplazado"]);
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DcargaCombo($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '22');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", ''); //
        parent::SetParameterSP("idDatosPuntoControl", $datos["iIdDatosPuntoControl"]); //
        parent::SetParameterSP("idRango", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", ''); //
        parent::SetParameterSP("tipoDatos", ''); //
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DguardarRangos($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '28');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", $datos["iIdDatosPuntoControl"]);
        parent::SetParameterSP("idRango", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", $datos["bSexo"]);
        parent::SetParameterSP("bEdad", $datos["bEdad"]);
        parent::SetParameterSP("iEdadMinima", $datos["iEdadMinima"]);
        parent::SetParameterSP("iEdadMaxima", $datos["iEdadMaxima"]);
        parent::SetParameterSP("iSexo", $datos["iSexo"]);
        parent::SetParameterSP("nValorMinimo", $datos["nValorMinimo"]);
        parent::SetParameterSP("nValorMaximo", $datos["nValorMaximo"]);
        parent::SetParameterSP("vSignificado", $datos["vSignificado"]);
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DcargarItemDelCombo($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '29');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("idRango", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", $datos["idCombo"]);
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DmodificarDatosPuntoControlSoloNombre($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '30');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", $datos["unidadDeMedidaEditar"]);
        parent::SetParameterSP("idDatosPuntoControl", $datos["iIdDatosPuntoControl"]);
        parent::SetParameterSP("idRango", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", $datos["nombreDatos"]);
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", $datos["muestraDatosEnExamen"]);
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", $datos["iObligatorio"]);
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DEliminarDatosPuntoControl($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '31');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", $datos["idGrupoDatos"]);
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", $datos["iIdDatosPuntoControl"]);
        parent::SetParameterSP("idRango", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", $datos["iOrden"]);
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DsubirDatosPuntoControl($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '32');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", $datos["iIdDatosPuntoControlActual"]);
        parent::SetParameterSP("idRango", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", $datos["iOrdenActual"]);
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", $datos["iOrdenNuevo"]);
        parent::SetParameterSP("idDatosPuntoControlNuevo", $datos["idDatosPuntoControlNuevo"]);
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DbajarDatosPuntoControl($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '33');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", $datos["iIdDatosPuntoControlActual"]);
        parent::SetParameterSP("idRango", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", $datos["iOrdenActual"]);
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", $datos["iOrdenNuevo"]);
        parent::SetParameterSP("idDatosPuntoControlNuevo", $datos["idDatosPuntoControlNuevo"]);
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DeliminarPuntosControl($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '34');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", $datos["idPuntoControlExamenLab"]);

        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("idRango", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio
    public function DconfirmarAproduccion($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '35');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", $datos["idPuntoControlExamenLab"]);

        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("idRango", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio *** PRODUCCION
    public function DgrupoDePuntoControlProduccion($datos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '36');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", $datos["idPuntoControlExamenLab"]);

        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("3", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio *** PRODUCCION
    public function DdatosPuntoControlProduccion($idGrupoDatos) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '37');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", $idGrupoDatos);
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", '');
        parent::SetParameterSP("3", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

// lobo 13-07-2012 laboratorio *** PRODUCCION
    public function DdatosRangosProduccion($idDatosPuntoControl) {
        parent::ConnectionOpen("pnsLaboratorioExamenesDatos", "dbweb");
        parent::SetParameterSP("$1", '38');
        parent::SetParameterSP("nombreExamen", '');
        parent::SetParameterSP("iIdExamenesLaboratorio", '');
        parent::SetParameterSP("iIdpuntoControl", '');
        parent::SetParameterSP("maximaSecuencia", '');
        parent::SetParameterSP("iNivelInicial", '');
        parent::SetParameterSP("iNivelFinal", '');
        parent::SetParameterSP("idPuntoControlExamenLab", '');

        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("iEstadoVersicion", '');
        parent::SetParameterSP("nombreGrupo", '');
        parent::SetParameterSP("idGrupo", '');
        parent::SetParameterSP("iIdTipoUnidadMedida", '');
        parent::SetParameterSP("idUnidadMedida", '');
        parent::SetParameterSP("idDatosPuntoControl", $idDatosPuntoControl);
        parent::SetParameterSP("3", '');
        /////////////////////////////////////////////
        parent::SetParameterSP("bSexo", '');
        parent::SetParameterSP("bEdad", '');
        parent::SetParameterSP("iEdadMinima", '');
        parent::SetParameterSP("iEdadMaxima", '');
        parent::SetParameterSP("iSexo", '');
        parent::SetParameterSP("nValorMinimo", '');
        parent::SetParameterSP("nValorMaximo", '');
        parent::SetParameterSP("vSignificado", '');
        parent::SetParameterSP("nombreDatos", '');
        parent::SetParameterSP("tipoDatos", '');
        parent::SetParameterSP("muestraDatosEnExamen", '');
        parent::SetParameterSP("nombreItem", '');
        parent::SetParameterSP("iOrden", '');
        parent::SetParameterSP("idCombo", '');
        parent::SetParameterSP("idItem", '');
        parent::SetParameterSP("idItemComboRemplazado", '');
        parent::SetParameterSP("ordenRemplazado", '');
        parent::SetParameterSP("idDatosPuntoControlNuevo", '');
        /////////////////////////////////////////////////////////////////
        parent::SetParameterSP("bMaximoEdadInfinito", $datos["bMaximoEdadInfinito"]);
        parent::SetParameterSP("bRangoInfinitoPositivo", $datos["bRangoInfinitoPositivo"]);
        parent::SetParameterSP("bRangoInfinitoNegativo", $datos["bRangoInfinitoNegativo"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//Lobo
    public function DanularExamenPaciente($datos) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '37');
        parent::SetParameterSP("@varInt1", $datos["idCodExamen"]);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", $_SESSION["login_user"]);
        parent::SetParameterSP("@varVarchar7", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    //Lobo
    public function DreprogramarExamen($datos) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorioPuntoControl", "dbweb");
        parent::SetParameterSP("@accion", '38');
        parent::SetParameterSP("@varInt1", $datos["idCodExamen"]);
        parent::SetParameterSP("@varInt2", '');
        parent::SetParameterSP("@varInt3", '');
        parent::SetParameterSP("@varInt4", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", $_SESSION["login_user"]);
        parent::SetParameterSP("@varVarchar7", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    //  creado por JCQA Martes 8 Agosto, 2012  
    public function DagregarPuntoControlBoton($datos) {

        parent::ConnectionOpen("pnsMaterialesLaboratorio", "dbweb");
        parent::SetParameterSP("@accion", '31');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@int1", $datos["hidPuntoControlExamenLab"]);
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@int3", '');
        parent::SetParameterSP("@bit1", $datos["estadoBoton"]);
        parent::SetParameterSP("@char1", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }


    // lobo
      public function DcargarDatosResultadosLaboratorio($idPacienteLaboratorio) {

        parent::ConnectionOpen("pnsExportaciondeExcelDeResultados", "dbweb");
        parent::SetParameterSP("@accion", '1');
        parent::SetParameterSP("@int1", $idPacienteLaboratorio);
        parent::SetParameterSP("@var2", '');

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }
    
     // lobo
      public function DcargarDatosResultadosmicroBiologia($txtCodigoBarras) {

        parent::ConnectionOpen("pnsExportaciondeExcelDeResultados", "dbweb");
        parent::SetParameterSP("@accion", '2');
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@var2", $txtCodigoBarras);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }
    

    public function validarGuardarDatosEnBaseDatos($datos) {
        parent::ConnectionOpen("nsmLaboratorioCargaDatosMicrobiologia", "dbweb");
        parent::SetParameterSP("@accion", 1);
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@var1", $datos["vArchivo"]);
        parent::SetParameterSP("@var2", $datos["dFechaCreacion"]);
        parent::SetParameterSP("@var3", $datos["dFechaModificacion"]);
        parent::SetParameterSP("@user", $_SESSION["login_user"]);
        parent::SetParameterSP("@host", $_SESSION['host']);
        parent::SetParameterSP("@varchar1", '');
        parent::SetParameterSP("@varchar2", '');
        parent::SetParameterSP("@varchar3", '');
        parent::SetParameterSP("@varchar4", '');
        parent::SetParameterSP("@varchar5", '');
        parent::SetParameterSP("@varchar6", '');
        parent::SetParameterSP("@varchar7", '');
        parent::SetParameterSP("@varchar8", '');
        parent::SetParameterSP("@varchar9", '');
        parent::SetParameterSP("@varchar10", '');
        parent::SetParameterSP("@varchar11", '');
        parent::SetParameterSP("@varchar12", '');
        parent::SetParameterSP("@varchar13", '');
        parent::SetParameterSP("@varchar14", '');
        parent::SetParameterSP("@varchar15", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function guardarDatosExcelMicrobiologia($varchar, $datos) {
        parent::ConnectionOpen("nsmLaboratorioCargaDatosMicrobiologia", "dbweb");
        parent::SetParameterSP("@accion", 2);
        parent::SetParameterSP("@int1", $datos["identity"]);
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@var1", $datos["vArchivo"]);
        parent::SetParameterSP("@var2", $datos["dFechaCreacion"]);
        parent::SetParameterSP("@var3", $datos["dFechaModificacion"]);
        parent::SetParameterSP("@user", $_SESSION["login_user"]);
        parent::SetParameterSP("@host", $_SESSION['host']);
        parent::SetParameterSP("@varchar1", $varchar[1]);
        parent::SetParameterSP("@varchar2", $varchar[2]);
        parent::SetParameterSP("@varchar3", $varchar[3]);
        parent::SetParameterSP("@varchar4", $varchar[4]);
        parent::SetParameterSP("@varchar5", $varchar[5]);
        parent::SetParameterSP("@varchar6", $varchar[6]);
        parent::SetParameterSP("@varchar7", $varchar[7]);
        parent::SetParameterSP("@varchar8", $varchar[8]);
        parent::SetParameterSP("@varchar9", $varchar[9]);
        parent::SetParameterSP("@varchar10", $varchar[10]);
        parent::SetParameterSP("@varchar11", $varchar[11]);
        parent::SetParameterSP("@varchar12", $varchar[12]);
        parent::SetParameterSP("@varchar13", $varchar[13]);
        parent::SetParameterSP("@varchar14", $varchar[14]);
        parent::SetParameterSP("@varchar15", $varchar[15]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function comparaExistentesBaseDatosConDirectorio() {
        parent::ConnectionOpen("nsmLaboratorioCargaDatosMicrobiologia", "dbweb");
        parent::SetParameterSP("@accion", 3);
        parent::SetParameterSP("@int1", '');
        parent::SetParameterSP("@int2", '');
        parent::SetParameterSP("@var1", '');
        parent::SetParameterSP("@var2", '');
        parent::SetParameterSP("@var3", '');
        parent::SetParameterSP("@user", '');
        parent::SetParameterSP("@host", '');
        parent::SetParameterSP("@varchar1", '');
        parent::SetParameterSP("@varchar2", '');
        parent::SetParameterSP("@varchar3", '');
        parent::SetParameterSP("@varchar4", '');
        parent::SetParameterSP("@varchar5", '');
        parent::SetParameterSP("@varchar6", '');
        parent::SetParameterSP("@varchar7", '');
        parent::SetParameterSP("@varchar8", '');
        parent::SetParameterSP("@varchar9", '');
        parent::SetParameterSP("@varchar10", '');
        parent::SetParameterSP("@varchar11", '');
        parent::SetParameterSP("@varchar12", '');
        parent::SetParameterSP("@varchar13", '');
        parent::SetParameterSP("@varchar14", '');
        parent::SetParameterSP("@varchar15", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

}

?>
