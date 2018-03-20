<?php

//
require_once("../../../pholivo/adophp/Adophp.class.php");
require_once("../../../pholivo/Conexion.php");

//
class DHospitalizacion extends Adophp {

    private $cnx;
    private $oRecord;

    public function __construct($cnx = Array()) {
        $this->cnx = empty($cnx) ? Conexion::getInitDsnMSSQLSimedh() : $cnx;
        parent::__construct('Spanish', $this->cnx);
    }

//    function NuevoPaciente() {
//        parent::ConnectionOpen("pnsCargarDoctorXpaciente", "dbweb"); //hNombrePaciente
//        parent::SetParameterSP("opt", '1');
//        parent::SetParameterSP("@dFechaHoraIngreso", '');
//
//        $resultado = parent::ExecuteSPArrayX();
//        parent::Close();
//        return $resultado;
//    }

    function busquedaPaciente($datos) {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '1');
        parent::SetParameterSP("@vApellidoPaterno", $datos["txtApePaternoPaciente"]);
        parent::SetParameterSP("@vApellidoMaterno", $datos["txtApeMaternoPaciente"]);
        parent::SetParameterSP("@vNombre", $datos["txtNombrePaciente"]);
        parent::SetParameterSP("@iNpisos", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@cboCama", '');
        parent::SetParameterSP("@txtCodigoPaciente", '');
        parent::SetParameterSP("@txtidCentroCosto", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", '');
        parent::SetParameterSP("@txtcIdAfiliacion", '');
        parent::SetParameterSP("@txtFechaIngreso", '');
        parent::SetParameterSP("@txtAmbLogicoTratante", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@idCodigoHospitalizacion", '');
        parent::SetParameterSP("@txtFechaIngresoI", '');
        parent::SetParameterSP("@txtFechaIngresoF", '');
        parent::SetParameterSP("@iidCodigoDestino", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    function busquedaPersonaMedicoTratante($datos) {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '3');
        parent::SetParameterSP("@vApellidoPaterno", $datos["txtApePaternoPaciente"]);
        parent::SetParameterSP("@vApellidoMaterno", $datos["txtApeMaternoPaciente"]);
        parent::SetParameterSP("@vNombre", $datos["txtNombrePaciente"]);
        parent::SetParameterSP("@iNpisos", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@cboCama", '');
        parent::SetParameterSP("@txtCodigoPaciente", '');
        parent::SetParameterSP("@txtidCentroCosto", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", '');
        parent::SetParameterSP("@txtcIdAfiliacion", '');
        parent::SetParameterSP("@txtFechaIngreso", '');
        parent::SetParameterSP("@txtAmbLogicoTratante", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@idCodigoHospitalizacion", '');
        parent::SetParameterSP("@txtFechaIngresoI", '');
        parent::SetParameterSP("@txtFechaIngresoF", '');
        parent::SetParameterSP("@iidCodigoDestino", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    function busquedaPersonaMedicoOrdInt($datos) {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '3');
        parent::SetParameterSP("@vApellidoPaterno", $datos["txtApePaternoPaciente"]);
        parent::SetParameterSP("@vApellidoMaterno", $datos["txtApeMaternoPaciente"]);
        parent::SetParameterSP("@vNombre", $datos["txtNombrePaciente"]);
        parent::SetParameterSP("@iNpisos", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@cboCama", '');
        parent::SetParameterSP("@txtCodigoPaciente", '');
        parent::SetParameterSP("@txtidCentroCosto", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", '');
        parent::SetParameterSP("@txtcIdAfiliacion", '');
        parent::SetParameterSP("@txtFechaIngreso", '');
        parent::SetParameterSP("@txtAmbLogicoTratante", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@idCodigoHospitalizacion", '');
        parent::SetParameterSP("@txtFechaIngresoI", '');
        parent::SetParameterSP("@txtFechaIngresoF", '');
        parent::SetParameterSP("@iidCodigoDestino", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    function busquedaPersonaMedicoAlta($datos) {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '3');
        parent::SetParameterSP("@vApellidoPaterno", $datos["txtApePaternoPaciente"]);
        parent::SetParameterSP("@vApellidoMaterno", $datos["txtApeMaternoPaciente"]);
        parent::SetParameterSP("@vNombre", $datos["txtNombrePaciente"]);
        parent::SetParameterSP("@iNpisos", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@cboCama", '');
        parent::SetParameterSP("@txtCodigoPaciente", '');
        parent::SetParameterSP("@txtidCentroCosto", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", '');
        parent::SetParameterSP("@txtcIdAfiliacion", '');
        parent::SetParameterSP("@txtFechaIngreso", '');
        parent::SetParameterSP("@txtAmbLogicoTratante", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@idCodigoHospitalizacion", '');
        parent::SetParameterSP("@txtFechaIngresoI", '');
        parent::SetParameterSP("@txtFechaIngresoF", '');
        parent::SetParameterSP("@iidCodigoDestino", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    //////////////////////
    //////////////////////////////////////
    function CargarDoctoXpaciente($datos) {
        parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb"); //hNombrePaciente
        parent::SetParameterSP("opt", '1');
        parent::SetParameterSP("@dFechaHoraIngreso", $datos["fechaSeleccionada"]);
        parent::SetParameterSP("@cCodigoPersona", '');
        parent::SetParameterSP("@iCodigoSucursal", '');
        parent::SetParameterSP("@especialidad", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@iCodigoProgramacion", '');
        parent::SetParameterSP("@idProgramacionPacientesEmergencia", '');
        parent::SetParameterSP("@idCama", '');
        parent::SetParameterSP("@idCboDestino", '');
        parent::SetParameterSP("@txtDescDestino", '');
        parent::SetParameterSP("@idCodigoCronograma", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@idCodigoCentroCosto", $datos["codigoCentroCosto"]);
        parent::SetParameterSP("@cCodigoDoctorPersona", $datos["codigoDoctorPersona"]);
        parent::SetParameterSP("@vApellidoPaterno", $datos["hApelledoPaterno"]);
        parent::SetParameterSP("@vApellidoMaterno", $datos["hApelledoMaterno"]);
        parent::SetParameterSP("@vNombre", $datos["hNombrePaciente"]);
        parent::SetParameterSP("@vEstadoCama", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function cboAmbienteFisico($idPisos) {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '4');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@iNpisos", $idPisos);
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@cboCama", '');
        parent::SetParameterSP("@txtCodigoPaciente", '');
        parent::SetParameterSP("@txtidCentroCosto", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", '');
        parent::SetParameterSP("@txtcIdAfiliacion", '');
        parent::SetParameterSP("@txtFechaIngreso", '');
        parent::SetParameterSP("@txtAmbLogicoTratante", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@idCodigoHospitalizacion", '');
        parent::SetParameterSP("@txtFechaIngresoI", '');
        parent::SetParameterSP("@txtFechaIngresoF", '');
        parent::SetParameterSP("@iidCodigoDestino", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

//
    function ComboCama($Datos) {
        parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb");
        parent::SetParameterSP("opt", '2');
        parent::SetParameterSP("@dFechaHoraIngreso", '');
        parent::SetParameterSP("@cCodigoPersona", '');
        parent::SetParameterSP("@iCodigoSucursal", '');
        parent::SetParameterSP("@especialidad", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@iCodigoProgramacion", '');
        parent::SetParameterSP("@idProgramacionPacientesEmergencia", '');
        parent::SetParameterSP("@idCama", '');
        parent::SetParameterSP("@idCboDestino", '');
        parent::SetParameterSP("@txtDescDestino", '');
        parent::SetParameterSP("@idCodigoCronograma", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", $Datos["idCodigoAmbienteFisico"]);
        parent::SetParameterSP("@idCodigoCentroCosto", '');
        parent::SetParameterSP("@cCodigoDoctorPersona", '');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@vEstadoCama", $Datos["estadoCama"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function cboCama($idAmbienteFisico) {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '5');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@iNpisos", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", $idAmbienteFisico);
        parent::SetParameterSP("@cboCama", '');
        parent::SetParameterSP("@txtCodigoPaciente", '');
        parent::SetParameterSP("@txtidCentroCosto", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", '');
        parent::SetParameterSP("@txtcIdAfiliacion", '');
        parent::SetParameterSP("@txtFechaIngreso", '');
        parent::SetParameterSP("@txtAmbLogicoTratante", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@idCodigoHospitalizacion", '');
        parent::SetParameterSP("@txtFechaIngresoI", '');
        parent::SetParameterSP("@txtFechaIngresoF", '');
        parent::SetParameterSP("@iidCodigoDestino", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

//
    function ComboCamaC($idCodigoAmbientefisico) {
        parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb");
        parent::SetParameterSP("opt", '5');
        parent::SetParameterSP("@dFechaHoraIngreso", '');
        parent::SetParameterSP("@cCodigoPersona", '');
        parent::SetParameterSP("@iCodigoSucursal", '');
        parent::SetParameterSP("@especialidad", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@iCodigoProgramacion", '');
        parent::SetParameterSP("@idProgramacionPacientesEmergencia", '');
        parent::SetParameterSP("@idCama", '');
        parent::SetParameterSP("@idCboDestino", '');
        parent::SetParameterSP("@txtDescDestino", '');
        parent::SetParameterSP("@idCodigoCronograma", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", $idCodigoAmbientefisico);
        parent::SetParameterSP("@idCodigoCentroCosto", '');
        parent::SetParameterSP("@cCodigoDoctorPersona", '');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@vEstadoCama", 1);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function PacienteGuardarHospitalizacion($datos) {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '6');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@iNpisos", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", $datos["cboAmbienteFisico"]);
        parent::SetParameterSP("@cboCama", $datos["cboCama"]);
        parent::SetParameterSP("@txtCodigoPaciente", $datos["txtCodigoPaciente"]);
        parent::SetParameterSP("@txtidCentroCosto", $datos["txtidCentroCosto"]);
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", $datos["txtiEmpleadoMedicoOrdInt"]);
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", $datos["txtiEmpleadoMedicoTratante"]);
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", $datos["txtiEmpleadoMedicoAlta"]);
        parent::SetParameterSP("@txtcIdAfiliacion", $datos["txtcIdAfiliacion"]);
        parent::SetParameterSP("@txtFechaIngreso", $datos["txtFechaIngreso"]);
        parent::SetParameterSP("@txtAmbLogicoTratante", $datos["txtAmbLogicoTratante"]);
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("@idCodigoHospitalizacion", '');
        parent::SetParameterSP("@txtFechaIngresoI", '');
        parent::SetParameterSP("@txtFechaIngresoF", '');
        parent::SetParameterSP("@iidCodigoDestino", $datos["iCodigoDestino"]);
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

//function ComboDestino() {
//    parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb");
//    parent::SetParameterSP("opt", '4');
//    parent::SetParameterSP("@dFechaHoraIngreso", '');
//    parent::SetParameterSP("@cCodigoPersona", '');
//    parent::SetParameterSP("@iCodigoSucursal", '');
//    parent::SetParameterSP("@especialidad", '');
//    parent::SetParameterSP("user", '');
//    parent::SetParameterSP("host", '');
//    parent::SetParameterSP("@iCodigoProgramacion", '');
//    parent::SetParameterSP("@idProgramacionPacientesEmergencia", '');
//    parent::SetParameterSP("@idCama", '');
//    parent::SetParameterSP("@idCboDestino", '');
//    parent::SetParameterSP("@txtDescDestino", '');
//    parent::SetParameterSP("@idCodigoCronograma", '');
//    parent::SetParameterSP("@idCodigoAmbienteFisico", '');
//    parent::SetParameterSP("@idCodigoCentroCosto", '');
//    parent::SetParameterSP("@cCodigoDoctorPersona", '');
//    parent::SetParameterSP("@vApellidoPaterno", '');
//    parent::SetParameterSP("@vApellidoMaterno", '');
//    parent::SetParameterSP("@vNombre", '');
//    parent::SetParameterSP("@vEstadoCama", '');
//    $resultado = parent::executeSPArrayX();
//    parent::Close();
//    return $resultado;
//}

    function Hospitalizacion($datos) {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '2');
        parent::SetParameterSP("@vApellidoPaterno", $datos["vtxtApPaterno"]);
        parent::SetParameterSP("@vApellidoMaterno", $datos["vtxtApMaterno"]);
        parent::SetParameterSP("@vNombre", $datos["vtxtNombre"]);
        parent::SetParameterSP("@iNpisos", $datos["icboPisos"]);
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@cboCama", '');
        parent::SetParameterSP("@txtCodigoPaciente", '');
        parent::SetParameterSP("@txtidCentroCosto", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", '');
        parent::SetParameterSP("@txtcIdAfiliacion", '');
        parent::SetParameterSP("@txtFechaIngreso", '');
        parent::SetParameterSP("@txtAmbLogicoTratante", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@idCodigoHospitalizacion", '');
        parent::SetParameterSP("@txtFechaIngresoI", $datos["vtxtFechaIni"]);
        parent::SetParameterSP("@txtFechaIngresoF", $datos["vtxtFechaFinal"]);
        parent::SetParameterSP("@iidCodigoDestino", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

//function EspecialidadDoctor($CodigoCronograma) {
//    parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb");
//    parent::SetParameterSP("opt", '6');
//    parent::SetParameterSP("@dFechaHoraIngreso", '');
//    parent::SetParameterSP("@cCodigoPersona", '');
//    parent::SetParameterSP("@iCodigoSucursal", '');
//    parent::SetParameterSP("@especialidad", '');
//    parent::SetParameterSP("user", '');
//    parent::SetParameterSP("host", '');
//    parent::SetParameterSP("@iCodigoProgramacion", '');
//    parent::SetParameterSP("@idProgramacionPacientesEmergencia", '');
//    parent::SetParameterSP("@idCama", '');
//    parent::SetParameterSP("@idCboDestino", '');
//    parent::SetParameterSP("@txtDescDestino", '');
//    parent::SetParameterSP("@idCodigoCronograma", $CodigoCronograma);
//    parent::SetParameterSP("@idCodigoAmbienteFisico", '');
//    parent::SetParameterSP("@idCodigoCentroCosto", '');
//    parent::SetParameterSP("@cCodigoDoctorPersona", '');
//    parent::SetParameterSP("@vApellidoPaterno", '');
//    parent::SetParameterSP("@vApellidoMaterno", '');
//    parent::SetParameterSP("@vNombre", '');
//    parent::SetParameterSP("@vEstadoCama", '');
//    $resultado = parent::executeSPArrayX();
//    parent::Close();
//    return $resultado;
//}

    function AmbienteCama($idAmbienteFisico) {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '5');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@iNpisos", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", $idAmbienteFisico);
        parent::SetParameterSP("@cboCama", '');
        parent::SetParameterSP("@txtCodigoPaciente", '');
        parent::SetParameterSP("@txtidCentroCosto", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", '');
        parent::SetParameterSP("@txtcIdAfiliacion", '');
        parent::SetParameterSP("@txtFechaIngreso", '');
        parent::SetParameterSP("@txtAmbLogicoTratante", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@idCodigoHospitalizacion", '');
        parent::SetParameterSP("@txtFechaIngresoI", '');
        parent::SetParameterSP("@txtFechaIngresoF", '');
        parent::SetParameterSP("@iidCodigoDestino", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

//function FotoPersona($cod_per) {
//    parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb");
//    parent::SetParameterSP("opt", '8');
//    parent::SetParameterSP("@dFechaHoraIngreso", '');
//    parent::SetParameterSP("@cCodigoPersona", $cod_per);
//    parent::SetParameterSP("@iCodigoSucursal", '');
//    parent::SetParameterSP("@especialidad", '');
//    parent::SetParameterSP("user", '');
//    parent::SetParameterSP("host", '');
//    parent::SetParameterSP("@iCodigoProgramacion", '');
//    //parent::SetParameterSP("user",$_SESSION["login_user"]);
//    //parent::SetParameterSP("host",$_SESSION['host']);
//    parent::SetParameterSP("@idProgramacionPacientesEmergencia", '');
//    parent::SetParameterSP("@idCama", '');
//    parent::SetParameterSP("@idCboDestino", '');
//    parent::SetParameterSP("@txtDescDestino", '');
//    parent::SetParameterSP("@idCodigoCronograma", '');
//    parent::SetParameterSP("@idCodigoAmbienteFisico", '');
//    parent::SetParameterSP("@idCodigoCentroCosto", '');
//    parent::SetParameterSP("@cCodigoDoctorPersona", '');
//    parent::SetParameterSP("@vApellidoPaterno", '');
//    parent::SetParameterSP("@vApellidoMaterno", '');
//    parent::SetParameterSP("@vNombre", '');
//    parent::SetParameterSP("@vEstadoCama", '');
//    $resultado = parent::executeSPArrayX();
//    parent::Close();
//    return $resultado;
//}

    function comboDestinoHost() {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '7');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@iNpisos", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@cboCama", '');
        parent::SetParameterSP("@txtCodigoPaciente", '');
        parent::SetParameterSP("@txtidCentroCosto", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", '');
        parent::SetParameterSP("@txtcIdAfiliacion", '');
        parent::SetParameterSP("@txtFechaIngreso", '');
        parent::SetParameterSP("@txtAmbLogicoTratante", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@idCodigoHospitalizacion", '');
        parent::SetParameterSP("@txtFechaIngresoI", '');
        parent::SetParameterSP("@txtFechaIngresoF", '');
        parent::SetParameterSP("@iidCodigoDestino", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    function BorrarHospitalizacion($CodigoHospitalizacion) {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '8');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@iNpisos", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@cboCama", '');
        parent::SetParameterSP("@txtCodigoPaciente", '');
        parent::SetParameterSP("@txtidCentroCosto", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", '');
        parent::SetParameterSP("@txtcIdAfiliacion", '');
        parent::SetParameterSP("@txtFechaIngreso", '');
        parent::SetParameterSP("@txtAmbLogicoTratante", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@idCodigoHospitalizacion", $CodigoHospitalizacion);
        parent::SetParameterSP("@txtFechaIngresoI", '');
        parent::SetParameterSP("@txtFechaIngresoF", '');
        parent::SetParameterSP("@iidCodigoDestino", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

//function ActulizarCamaEstado($Datos) {
//    parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb");
//    parent::SetParameterSP("opt", '16');
//    parent::SetParameterSP("@dFechaHoraIngreso", '');
//    parent::SetParameterSP("@cCodigoPersona", '');
//    parent::SetParameterSP("@iCodigoSucursal", '');
//    parent::SetParameterSP("@especialidad", '');
//    parent::SetParameterSP("user", $_SESSION["login_user"]);
//    parent::SetParameterSP("host", $_SESSION['host']);
//    parent::SetParameterSP("@iCodigoProgramacion", '');
//    parent::SetParameterSP("@idProgramacionPacientesEmergencia", '');
//    parent::SetParameterSP("@idCama", $Datos["hCodigoCama"]);
//    parent::SetParameterSP("@idCboDestino", '');
//    parent::SetParameterSP("@txtDescDestino", '');
//    parent::SetParameterSP("@idCodigoCronograma", '');
//    parent::SetParameterSP("@idCodigoAmbienteFisico", '');
//    parent::SetParameterSP("@idCodigoCentroCosto", '');
//    parent::SetParameterSP("@cCodigoDoctorPersona", '');
//    parent::SetParameterSP("@vApellidoPaterno", '');
//    parent::SetParameterSP("@vApellidoMaterno", '');
//    parent::SetParameterSP("@vNombre", '');
//    parent::SetParameterSP("@vEstadoCama", '');
//    $resultado = parent::executeSPArrayX();
//    parent::Close();
//    return $resultado;
//}

    function NombreAmbienteFisico($codigoAmbienteFisico) {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '9');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@iNpisos", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", $codigoAmbienteFisico);
        parent::SetParameterSP("@cboCama", '');
        parent::SetParameterSP("@txtCodigoPaciente", '');
        parent::SetParameterSP("@txtidCentroCosto", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", '');
        parent::SetParameterSP("@txtcIdAfiliacion", '');
        parent::SetParameterSP("@txtFechaIngreso", '');
        parent::SetParameterSP("@txtAmbLogicoTratante", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@idCodigoHospitalizacion", '');
        parent::SetParameterSP("@txtFechaIngresoI", '');
        parent::SetParameterSP("@txtFechaIngresoF", '');
        parent::SetParameterSP("@iidCodigoDestino", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    function GuardarHospitalizacion($datos) {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '10');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@iNpisos", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@cboCama", $datos["codigoCama"]);
        parent::SetParameterSP("@txtCodigoPaciente", '');
        parent::SetParameterSP("@txtidCentroCosto", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", '');
        parent::SetParameterSP("@txtcIdAfiliacion", '');
        parent::SetParameterSP("@txtFechaIngreso", '');
        parent::SetParameterSP("@txtAmbLogicoTratante", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@idCodigoHospitalizacion", $datos["codigoHospitalizacion"]);
        parent::SetParameterSP("@txtFechaIngresoI", '');
        parent::SetParameterSP("@txtFechaIngresoF", '');
        parent::SetParameterSP("@iidCodigoDestino", $datos["codigoDestino"]);
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    function comboDiagnostico() {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '11');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@iNpisos", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@cboCama", '');
        parent::SetParameterSP("@txtCodigoPaciente", '');
        parent::SetParameterSP("@txtidCentroCosto", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", '');
        parent::SetParameterSP("@txtcIdAfiliacion", '');
        parent::SetParameterSP("@txtFechaIngreso", '');
        parent::SetParameterSP("@txtAmbLogicoTratante", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@idCodigoHospitalizacion", '');
        parent::SetParameterSP("@txtFechaIngresoI", '');
        parent::SetParameterSP("@txtFechaIngresoF", '');
        parent::SetParameterSP("@iidCodigoDestino", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DocumentoPaciente($cod_per) {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '12');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@iNpisos", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@cboCama", '');
        parent::SetParameterSP("@txtCodigoPaciente", '');
        parent::SetParameterSP("@txtidCentroCosto", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", '');
        parent::SetParameterSP("@txtcIdAfiliacion", '');
        parent::SetParameterSP("@txtFechaIngreso", '');
        parent::SetParameterSP("@txtAmbLogicoTratante", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@idCodigoHospitalizacion", '');
        parent::SetParameterSP("@txtFechaIngresoI", '');
        parent::SetParameterSP("@txtFechaIngresoF", '');
        parent::SetParameterSP("@iidCodigoDestino", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", $cod_per);
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DiagnosticoEntradaYsalida($codPaciente) {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '13');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@iNpisos", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');


        parent::SetParameterSP("@cboCama", '');
        parent::SetParameterSP("@txtCodigoPaciente", $codPaciente);
        parent::SetParameterSP("@txtidCentroCosto", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", '');
        parent::SetParameterSP("@txtcIdAfiliacion", '');
        parent::SetParameterSP("@txtFechaIngreso", '');
        parent::SetParameterSP("@txtAmbLogicoTratante", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@idCodigoHospitalizacion", '');
        parent::SetParameterSP("@txtFechaIngresoI", '');
        parent::SetParameterSP("@txtFechaIngresoF", '');
        parent::SetParameterSP("@iidCodigoDestino", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    function ExpotarExcelHospitalizacion($datos) {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '14');
        parent::SetParameterSP("@vApellidoPaterno", $datos["vtxtApPaterno"]);
        parent::SetParameterSP("@vApellidoMaterno", $datos["vtxtApMaterno"]);
        parent::SetParameterSP("@vNombre", $datos["vtxtNombre"]);
        parent::SetParameterSP("@iNpisos", $datos["icboPisos"]);
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@cboCama", '');
        parent::SetParameterSP("@txtCodigoPaciente", '');
        parent::SetParameterSP("@txtidCentroCosto", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", '');
        parent::SetParameterSP("@txtcIdAfiliacion", '');
        parent::SetParameterSP("@txtFechaIngreso", '');
        parent::SetParameterSP("@txtAmbLogicoTratante", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@idCodigoHospitalizacion", '');
        parent::SetParameterSP("@txtFechaIngresoI", $datos["vtxtFechaIni"]);
        parent::SetParameterSP("@txtFechaIngresoF", $datos["vtxtFechaFinal"]);
        parent::SetParameterSP("@iidCodigoDestino", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    function hospitalizacionAfiliacion($iCodigoPaciente) {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '15');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@iNpisos", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@cboCama", '');
        parent::SetParameterSP("@txtCodigoPaciente", $iCodigoPaciente);
        parent::SetParameterSP("@txtidCentroCosto", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", '');
        parent::SetParameterSP("@txtcIdAfiliacion", '');
        parent::SetParameterSP("@txtFechaIngreso", '');
        parent::SetParameterSP("@txtAmbLogicoTratante", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@idCodigoHospitalizacion", '');
        parent::SetParameterSP("@txtFechaIngresoI", '');
        parent::SetParameterSP("@txtFechaIngresoF", '');
        parent::SetParameterSP("@iidCodigoDestino", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    function guardarTransferenciaPaciente($datos) {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '16');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@iNpisos", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", $datos["cboAmbienteFisico"]);
        parent::SetParameterSP("@cboCama", $datos["cboCama"]);
        parent::SetParameterSP("@txtCodigoPaciente", $datos["txtCodigoPaciente"]);
        parent::SetParameterSP("@txtidCentroCosto", $datos["txtidCentroCosto"]);
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", $datos["txtiEmpleadoMedicoOrdInt"]);
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", $datos["txtiEmpleadoMedicoTratante"]);
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", $datos["txtiEmpleadoMedicoAlta"]);
        parent::SetParameterSP("@txtcIdAfiliacion", $datos["txtcIdAfiliacion"]);
        parent::SetParameterSP("@txtFechaIngreso", $datos["txtFechaIngreso"]);
        parent::SetParameterSP("@txtAmbLogicoTratante", $datos["txtAmbLogicoTratante"]);
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("@idCodigoHospitalizacion", $datos["anteriorCodigoHospitalizacion"]);
        parent::SetParameterSP("@txtFechaIngresoI", '');
        parent::SetParameterSP("@txtFechaIngresoF", '');
        parent::SetParameterSP("@iidCodigoDestino", $datos["iCodigoDestino"]);
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    function actualizarTransferenciaPaciente($CodigoActual, $anteriorCodigoHospitalizacion) {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '17');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@iNpisos", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@cboCama", '');
        parent::SetParameterSP("@txtCodigoPaciente", '');
        parent::SetParameterSP("@txtidCentroCosto", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", '');
        parent::SetParameterSP("@txtcIdAfiliacion", '');
        parent::SetParameterSP("@txtFechaIngreso", '');
        parent::SetParameterSP("@txtAmbLogicoTratante", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@idCodigoHospitalizacion", $anteriorCodigoHospitalizacion);
        parent::SetParameterSP("@txtFechaIngresoI", '');
        parent::SetParameterSP("@txtFechaIngresoF", '');
        parent::SetParameterSP("@iidCodigoDestino", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", $CodigoActual);
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    function EstadosHospitalizacion() {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '18');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@iNpisos", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@cboCama", '');
        parent::SetParameterSP("@txtCodigoPaciente", '');
        parent::SetParameterSP("@txtidCentroCosto", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", '');
        parent::SetParameterSP("@txtcIdAfiliacion", '');
        parent::SetParameterSP("@txtFechaIngreso", '');
        parent::SetParameterSP("@txtAmbLogicoTratante", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@idCodigoHospitalizacion", '');
        parent::SetParameterSP("@txtFechaIngresoI", '');
        parent::SetParameterSP("@txtFechaIngresoF", '');
        parent::SetParameterSP("@iidCodigoDestino", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    function NuevoPacienteHora() {
        parent::ConnectionOpen("pnsDoctorXpaciente", "dbweb");
        parent::SetParameterSP("opt", '19');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@iNpisos", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@cboCama", '');
        parent::SetParameterSP("@txtCodigoPaciente", '');
        parent::SetParameterSP("@txtidCentroCosto", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoOrdInt", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoTratante", '');
        parent::SetParameterSP("@txtiEmpleadoMedicoAlta", '');
        parent::SetParameterSP("@txtcIdAfiliacion", '');
        parent::SetParameterSP("@txtFechaIngreso", '');
        parent::SetParameterSP("@txtAmbLogicoTratante", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@idCodigoHospitalizacion", '');
        parent::SetParameterSP("@txtFechaIngresoI", '');
        parent::SetParameterSP("@txtFechaIngresoF", '');
        parent::SetParameterSP("@iidCodigoDestino", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoEntrada", '');
        parent::SetParameterSP("@iidCodigoDiagnosticoSalida", '');
        parent::SetParameterSP("@c_cod_per", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    function FotoPersona($cod_per) {
        parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb");
        parent::SetParameterSP("opt", '8');
        parent::SetParameterSP("@dFechaHoraIngreso", '');
        parent::SetParameterSP("@cCodigoPersona", $cod_per);
        parent::SetParameterSP("@iCodigoSucursal", '');
        parent::SetParameterSP("@especialidad", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@iCodigoProgramacion", '');
        parent::SetParameterSP("@idProgramacionPacientesEmergencia", '');
        parent::SetParameterSP("@idCama", '');
        parent::SetParameterSP("@idCboDestino", '');
        parent::SetParameterSP("@txtDescDestino", '');
        parent::SetParameterSP("@idCodigoCronograma", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@idCodigoCentroCosto", '');
        parent::SetParameterSP("@cCodigoDoctorPersona", '');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@vEstadoCama", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

//function ReporteDiagnosticoGeneral($total, $Datos) {
//    parent::ConnectionOpen("pnsReporteEmergenciaGeneral", "dbweb");
//    parent::SetParameterSP("opt", '1');
//    parent::SetParameterSP("user", '');
//    parent::SetParameterSP("host", '');
//    parent::SetParameterSP("@cantidad", $total);
//    parent::SetParameterSP("@horaInicial", '');
//    parent::SetParameterSP("@horaFinal", '');
//    parent::SetParameterSP("@cCodigoCie", '');
//    parent::SetParameterSP("@fechaInicial", $Datos['fechaInicio']);
//    parent::SetParameterSP("@fechaFinal", $Datos['fechafinal']);
//    parent::SetParameterSP("@RangoEdadesinicial", '');
//    parent::SetParameterSP("@RangoEdadesFinal", '');
//    parent::SetParameterSP("@idCie", '');
//    $resultado = parent::executeSPArrayX();
//    parent::Close();
//    return $resultado;
//}

    function recuperarRuta($opcion) {
        parent::ConnectionOpen("pnsAtributoDocumentoEmpleado", "dbweb");
        parent::SetParameterSP("accion", '4');
        parent::SetParameterSP("idArchDocEmp", '');
        parent::SetParameterSP("idDocEmp", ''); // aun no se le asigna
        parent::SetParameterSP("ruta", $opcion);
        parent::SetParameterSP("version", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::ExecuteSPArrayX();
        return $resultado;
    }

//function CantidadTotal($Datos) {
//    parent::ConnectionOpen("pnsReporteEmergenciaGeneral", "dbweb");
//    parent::SetParameterSP("opt", '2');
//    parent::SetParameterSP("user", '');
//    parent::SetParameterSP("host", '');
//    parent::SetParameterSP("@cantidad", '');
//    parent::SetParameterSP("@horaInicial", '');
//    parent::SetParameterSP("@horaFinal", '');
//    parent::SetParameterSP("@cCodigoCie", '');
//    parent::SetParameterSP("@fechaInicial", $Datos['fechaInicio']);
//    parent::SetParameterSP("@fechaFinal", $Datos['fechafinal']);
//    parent::SetParameterSP("@RangoEdadesinicial", '');
//    parent::SetParameterSP("@RangoEdadesFinal", '');
//    parent::SetParameterSP("@idCie", '');
//    $resultado = parent::executeSPArrayX();
//    parent::Close();
//    return $resultado;
//}
//function cabezeraTablas() {
//    parent::ConnectionOpen("pnsReporteEmergenciaGeneral", "dbweb");
//    parent::SetParameterSP("opt", '3');
//    parent::SetParameterSP("user", '');
//    parent::SetParameterSP("host", '');
//    parent::SetParameterSP("@cantidad", '');
//    parent::SetParameterSP("@horaInicial", '');
//    parent::SetParameterSP("@horaFinal", '');
//    parent::SetParameterSP("@cCodigoCie", '');
//    parent::SetParameterSP("@fechaInicial", '');
//    parent::SetParameterSP("@fechaFinal", '');
//    parent::SetParameterSP("@RangoEdadesinicial", '');
//    parent::SetParameterSP("@RangoEdadesFinal", '');
//    parent::SetParameterSP("@idCie", '');
//    $resultado = parent::executeSPArrayX();
//    parent::Close();
//    return $resultado;
//
//}
//
//function Reporte($Datos) {
//    parent::ConnectionOpen("pnsReporteEmergenciaGeneral", "dbweb");
//    parent::SetParameterSP("opt", '4');
//    parent::SetParameterSP("user", '');
//    parent::SetParameterSP("host", '');
//    parent::SetParameterSP("@cantidad", '');
//    parent::SetParameterSP("@horaInicial", '');
//    parent::SetParameterSP("@horaFinal", '');
//    parent::SetParameterSP("@cCodigoCie", '');
//    parent::SetParameterSP("@fechaInicial", $Datos['fechaInicio']);
//    parent::SetParameterSP("@fechaFinal", $Datos['fechafinal']);
//    parent::SetParameterSP("@RangoEdadesinicial", '');
//    parent::SetParameterSP("@RangoEdadesFinal", '');
//    parent::SetParameterSP("@idCie", '');
//    $resultado = parent::executeSPArrayX();
//    parent::Close();
//    return $resultado;
//}
//
//function ReporteXedades($Datos) {
//    parent::ConnectionOpen("pnsReporteEmergenciaGeneral", "dbweb");
//    parent::SetParameterSP("opt", '5');
//    parent::SetParameterSP("user", '');
//    parent::SetParameterSP("host", '');
//    parent::SetParameterSP("@cantidad", '');
//    parent::SetParameterSP("@horaInicial", '');
//    parent::SetParameterSP("@horaFinal", '');
//    parent::SetParameterSP("@cCodigoCie", '');
//    parent::SetParameterSP("@fechaInicial", $Datos['fechaInicio']);
//    parent::SetParameterSP("@fechaFinal", $Datos['fechafinal']);
//    parent::SetParameterSP("@RangoEdadesinicial", '');
//    parent::SetParameterSP("@RangoEdadesFinal", '');
//    parent::SetParameterSP("@idCie", '');
//    $resultado = parent::executeSPArrayX();
//    parent::Close();
//    return $resultado;
//}
//
////
//function ReportexSexo($Datos) {
//    parent::ConnectionOpen("pnsReporteEmergenciaGeneral", "dbweb");
//    parent::SetParameterSP("opt", '6');
//    parent::SetParameterSP("user", '');
//    parent::SetParameterSP("host", '');
//    parent::SetParameterSP("@cantidad", '');
//    parent::SetParameterSP("@horaInicial", '');
//    parent::SetParameterSP("@horaFinal", '');
//    parent::SetParameterSP("@cCodigoCie", '');
//    parent::SetParameterSP("@fechaInicial", $Datos['fechaInicio']);
//    parent::SetParameterSP("@fechaFinal", $Datos['fechafinal']);
//    parent::SetParameterSP("@RangoEdadesinicial", '');
//    parent::SetParameterSP("@RangoEdadesFinal", '');
//    parent::SetParameterSP("@idCie", '');
//    $resultado = parent::executeSPArrayX();
//    parent::Close();
//    return $resultado;
//}
//
//function ReportexSexoTotal($Datos) {
//    parent::ConnectionOpen("pnsReporteEmergenciaGeneral", "dbweb");
//    parent::SetParameterSP("opt", '7');
//    parent::SetParameterSP("user", '');
//    parent::SetParameterSP("host", '');
//    parent::SetParameterSP("@cantidad", '');
//    parent::SetParameterSP("@horaInicial", '');
//    parent::SetParameterSP("@horaFinal", '');
//    parent::SetParameterSP("@cCodigoCie", '');
//    parent::SetParameterSP("@fechaInicial", $Datos['fechaInicio']);
//    parent::SetParameterSP("@fechaFinal", $Datos['fechafinal']);
//    parent::SetParameterSP("@RangoEdadesinicial", '');
//    parent::SetParameterSP("@RangoEdadesFinal", '');
//    parent::SetParameterSP("@idCie", '');
//    $resultado = parent::executeSPArrayX();
//    parent::Close();
//    return $resultado;
//}
//function Antecedente($CodigoProgramacion) {
//    parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb");
//    parent::SetParameterSP("opt", '7');
//    parent::SetParameterSP("@dFechaHoraIngreso", '');
//    parent::SetParameterSP("@cCodigoPersona", '');
//    parent::SetParameterSP("@iCodigoSucursal", '');
//    parent::SetParameterSP("@especialidad", '');
//    parent::SetParameterSP("user", '');
//    parent::SetParameterSP("host", '');
//    parent::SetParameterSP("@iCodigoProgramacion", $CodigoProgramacion);
//    parent::SetParameterSP("@idProgramacionPacientesEmergencia", '');
//    parent::SetParameterSP("@idCama", '');
//    parent::SetParameterSP("@idCboDestino", '');
//    parent::SetParameterSP("@txtDescDestino", '');
//    parent::SetParameterSP("@idCodigoCronograma", '');
//    parent::SetParameterSP("@idCodigoAmbienteFisico", '');
//    parent::SetParameterSP("@idCodigoCentroCosto", '');
//    parent::SetParameterSP("@cCodigoDoctorPersona", '');
//    parent::SetParameterSP("@vApellidoPaterno", '');
//    parent::SetParameterSP("@vApellidoMaterno", '');
//    parent::SetParameterSP("@vNombre", '');
//    parent::SetParameterSP("@vEstadoCama", '');
//    $resultado = parent::executeSPArrayX();
//    parent::Close();
//    return $resultado;
//}
}

?>