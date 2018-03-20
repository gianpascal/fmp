<?php
require_once("../../../pholivo/adophp/Adophp.class.php");
require_once("../../../pholivo/Conexion.php");

class DSOP extends Adophp {

    private $dsn;

    public function __construct($dsn='') {
        $this->dsn = empty($dsn)?Conexion::getInitDsnMSSQLSimedh():$dsn;
        parent::__construct('Spanish',$this->dsn);
    }

    /************************* Solicitud Programacion SOP *************************/
    public function spListaPaciente($opcion,$valor) {
        parent::ConnectionOpen("pnsListaPaciente","dbweb");
        parent::SetParameterSP("opcion",$opcion);
        parent::SetParameterSP("valor",$valor);
        $resultado=parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }
    
    public function spListaCieDxPreOperatorio($accion,$token){
        parent::ConnectionOpen("pnsCie","dbweb");
        parent::SetParameterSP("$1", $accion);
        parent::SetParameterSP("$2", $token);
        $resultado=parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spListaServicioCirugia($accion,$token){
        parent::ConnectionOpen("pnsServicioCirugia","dbweb");
        parent::SetParameterSP("accion", $accion);
        parent::SetParameterSP("token", $token);
        $resultado=parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spListaCirujano($opcion,$valor) {
        parent::ConnectionOpen("pnsListaCirujano","dbweb");
        parent::SetParameterSP("opcion",$opcion);
        parent::SetParameterSP("valor",$valor);
        $resultado=parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spManteSolProgSOP($accion,$fechaPropuesta,$horaPropuesta,$codPerPaciente,$codCentroCostoSolProgSOP,
                                    $cadenaIdDxPreOperatorio,$cadenaCodServicioCirugia,$cadenaPorcServicioCirugia,
                                    $duracionServicioCirugia,$codPerCirujanoResponsable,$cadenaCodPerCirujanoAyudante,
                                    $valorHematocrito,$valorHemoglobina,$observaciones){
        parent::ConnectionOpen("pnsManteSolProgSOP","dbweb");
        parent::SetParameterSP("accion",$accion);
        parent::SetParameterSP("fechaPropuesta",$fechaPropuesta);
        parent::SetParameterSP("horaPropuesta",$horaPropuesta);
        parent::SetParameterSP("codPerPaciente",$codPerPaciente);
        parent::SetParameterSP("codCentroCostoSolProgSOP",$codCentroCostoSolProgSOP);
        parent::SetParameterSP("cadenaIdDxPreOperatorio",$cadenaIdDxPreOperatorio);
        parent::SetParameterSP("cadenaCodServicioCirugia",$cadenaCodServicioCirugia);
        parent::SetParameterSP("cadenaPorcServicioCirugia",$cadenaPorcServicioCirugia);
        parent::SetParameterSP("duracionServicioCirugia",$duracionServicioCirugia);
        parent::SetParameterSP("codPerCirujanoResponsable",$codPerCirujanoResponsable);
        parent::SetParameterSP("cadenaCodPerCirujanoAyudante",$cadenaCodPerCirujanoAyudante);
        parent::SetParameterSP("valorHematocrito",$valorHematocrito);
        parent::SetParameterSP("valorHemoglobina",$valorHemoglobina);
        parent::SetParameterSP("observaciones",$observaciones);
        parent::SetParameterSP("vUsuario",strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHost",strtoupper($_SESSION['host']));
        $resultado=parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spListaSolicitudesPendientesSOP($accion,$token) {
        parent::ConnectionOpen("pnsListaSolicitudesSOP","dbweb");
        parent::SetParameterSP("accion",$accion);
        parent::SetParameterSP("token",$token);
        $resultado=parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }
    /*********************** Fin Solicitud Programacion SOP ***********************/

    /********************************* Programacion SOP ***************************/
    public function spAceptarRechazarSolProgSOP($accion,$iidSolicitudProgramacion){
        /*parent::ConnectionOpen("pnsMantenimientoProgramacionSOP","dbweb");
        parent::SetParameterSP("accion",$accion);//
        parent::SetParameterSP("iidProgramacionSOP","");
        parent::SetParameterSP("iidSolicitudProgramacion",$iidSolicitudProgramacion);//
        parent::SetParameterSP("iidEstadoSOP","");
        parent::SetParameterSP("iidCentroCosto","");
        parent::SetParameterSP("cCodigoMedicoCirujano","");
        parent::SetParameterSP("iCodigoPaciente","");
        parent::SetParameterSP("cCodigoAmbienteLogico","");
        parent::SetParameterSP("iCodigoAmbienteFisico","");
        parent::SetParameterSP("cCodigoActividad","");
        parent::SetParameterSP("iidTipoProgramacionSOP","");
        parent::SetParameterSP("cCodigoFormato","");
        parent::SetParameterSP("cNroFormato","");
        parent::SetParameterSP("vHoraProgramada","");
        parent::SetParameterSP("dFechaServicio","");
        parent::SetParameterSP("dFechaHoraIngreso","");
        parent::SetParameterSP("dFechaHoraSalida","");
        parent::SetParameterSP("vTiempoAproximado","");
        parent::SetParameterSP("cadenaIdServicioUtilizado","");
        parent::SetParameterSP("cadenaCodPersonaResponsable","");
        parent::SetParameterSP("vUsuario",strtoupper($_SESSION["login_user"]));//
        parent::SetParameterSP("vHost",strtoupper($_SESSION['host']));//
        $resultado=parent::executeSPArrayX();
        parent::Close();
        return $resultado;*/
        parent::ConnectionOpen("pnsAceptarRechazarSolProgSOP","dbweb");
        parent::SetParameterSP("accion",$accion);
        parent::SetParameterSP("iidSolicitudProgramacion",$iidSolicitudProgramacion);
        parent::SetParameterSP("vUsuario",strtoupper($_SESSION["login_user"]));//
        parent::SetParameterSP("vHost",strtoupper($_SESSION['host']));//
        $resultado=parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    //public function spManteProgramacionSOP($accion,$iidSolicitudProgramacion){
    public function spManteProgramacionSOP($accion,$iidProgramacionSOP,$iidSolicitudProgramacion,$iidEstadoSOP,$iidCentroCosto,
                                           $cCodigoMedicoCirujano,$iCodigoPaciente,$cCodigoAmbienteLogico,$iCodigoAmbienteFisico,$cCodigoActividad,
                                           $iidTipoProgramacionSOP,$cCodigoFormato,$cNroFormato,$vHoraProgramada,$dFechaServicio,$dFechaHoraIngreso,
                                           $dFechaHoraSalida,$vTiempoAproximado,$cadenaIdServicioUtilizado,$cadenaCodPersonaResponsable){
        parent::ConnectionOpen("pnsMantenimientoProgramacionSOP","dbweb");
        parent::SetParameterSP("accion",$accion);//
        parent::SetParameterSP("iidProgramacionSOP",$iidProgramacionSOP);
        parent::SetParameterSP("iidSolicitudProgramacion",$iidSolicitudProgramacion);//
        parent::SetParameterSP("iidEstadoSOP",$iidEstadoSOP);
        parent::SetParameterSP("iidCentroCosto",$iidCentroCosto);
        parent::SetParameterSP("cCodigoMedicoCirujano",$cCodigoMedicoCirujano);
        parent::SetParameterSP("iCodigoPaciente",$iCodigoPaciente);
        parent::SetParameterSP("cCodigoAmbienteLogico",$cCodigoAmbienteLogico);
        parent::SetParameterSP("iCodigoAmbienteFisico",$iCodigoAmbienteFisico);
        parent::SetParameterSP("cCodigoActividad",$cCodigoActividad);
        parent::SetParameterSP("iidTipoProgramacionSOP",$iidTipoProgramacionSOP);
        parent::SetParameterSP("cCodigoFormato",$cCodigoFormato);
        parent::SetParameterSP("cNroFormato",$cNroFormato);
        parent::SetParameterSP("vHoraProgramada",$vHoraProgramada);
        parent::SetParameterSP("dFechaServicio",$dFechaServicio);
        parent::SetParameterSP("dFechaHoraIngreso",$dFechaHoraIngreso);
        parent::SetParameterSP("dFechaHoraSalida",$dFechaHoraSalida);
        parent::SetParameterSP("vTiempoAproximado",$vTiempoAproximado);
        parent::SetParameterSP("cadenaIdServicioUtilizado",$cadenaIdServicioUtilizado);
        parent::SetParameterSP("cadenaCodPersonaResponsable",$cadenaCodPersonaResponsable);
        parent::SetParameterSP("vUsuario",strtoupper($_SESSION["login_user"]));//
        parent::SetParameterSP("vHost",strtoupper($_SESSION['host']));//
        $resultado=parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spListaProgramacionesSOP($accion,$token) {
        parent::ConnectionOpen("pnsListaProgramacionesSOP","dbweb");
        parent::SetParameterSP("accion",$accion);
        parent::SetParameterSP("token",$token);
        $resultado=parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }


    /******************************* Fin Programacion SOP *************************/

    
    
    public function getArrayProgramacionesSOP($datos){
        parent::ConnectionOpen("pnsMantenimientoProgramacionSOP","dbweb");
        parent::SetParameterSP("accion","1");
        parent::SetParameterSP("fechaSOP",$datos["fechaSOP"]);
        $resultado=parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;        
    }
    
    
}

?>
