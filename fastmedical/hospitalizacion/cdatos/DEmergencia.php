<?php

require_once("../../../pholivo/adophp/Adophp.class.php");
require_once("../../../pholivo/Conexion.php");

class DEmergencia extends Adophp {

    private $cnx;
    private $oRecord;

    public function __construct($cnx = Array()) {
        $this->cnx = empty($cnx) ? Conexion::getInitDsnMSSQLSimedh() : $cnx;
        parent::__construct('Spanish', $this->cnx);
    }

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

    function ComboDiagnostico($datos) {
        parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb");
        parent::SetParameterSP("opt", '3');
        parent::SetParameterSP("@dFechaHoraIngreso", '');
        parent::SetParameterSP("@cCodigoPersona", '');
        parent::SetParameterSP("@iCodigoSucursal", '');
        parent::SetParameterSP("@especialidad", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@iCodigoProgramacion", $datos); // codigo Paciente
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
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function ComboDestino() {
        parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb");
        parent::SetParameterSP("opt", '4');
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
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@idCodigoCentroCosto", '');
        parent::SetParameterSP("@cCodigoDoctorPersona", '');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@vEstadoCama", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function EspecialidadDoctor($CodigoCronograma) {
        parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb");
        parent::SetParameterSP("opt", '6');
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
        parent::SetParameterSP("@idCodigoCronograma", $CodigoCronograma);
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@idCodigoCentroCosto", '');
        parent::SetParameterSP("@cCodigoDoctorPersona", '');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@vEstadoCama", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function Antecedente($CodigoProgramacion) {
        parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb");
        parent::SetParameterSP("opt", '7');
        parent::SetParameterSP("@dFechaHoraIngreso", '');
        parent::SetParameterSP("@cCodigoPersona", '');
        parent::SetParameterSP("@iCodigoSucursal", '');
        parent::SetParameterSP("@especialidad", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@iCodigoProgramacion", $CodigoProgramacion);
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
        $resultado = parent::executeSPArrayX();
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
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function GuardarnsdProgramacionPacientesEmergencia($Datos) {
        parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb");
        parent::SetParameterSP("opt", '9');
        parent::SetParameterSP("@dFechaHoraIngreso", '');
        parent::SetParameterSP("@cCodigoPersona", '');
        parent::SetParameterSP("@iCodigoSucursal", '');
        parent::SetParameterSP("@especialidad", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("@iCodigoProgramacion", '');
        parent::SetParameterSP("@idProgramacionPacientesEmergencia", $Datos['idProgramacionPacientesEmergencia']);
        parent::SetParameterSP("@idCama", $Datos["idCama"]);
        parent::SetParameterSP("@idCboDestino", '');
        parent::SetParameterSP("@txtDescDestino", $Datos["txtDescDestino"]);
        parent::SetParameterSP("@idCodigoCronograma", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@idCodigoCentroCosto", '');
        parent::SetParameterSP("@cCodigoDoctorPersona", '');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@vEstadoCama", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function ActulizarCama($Datos) {
        parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb");
        parent::SetParameterSP("opt", '11');
        parent::SetParameterSP("@dFechaHoraIngreso", '');
        parent::SetParameterSP("@cCodigoPersona", '');
        parent::SetParameterSP("@iCodigoSucursal", '');
        parent::SetParameterSP("@especialidad", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("@iCodigoProgramacion", '');
        parent::SetParameterSP("@idProgramacionPacientesEmergencia", '');
        parent::SetParameterSP("@idCama", $Datos["idCama"]);
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
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function ActulizarCamaEstado($Datos) {
        parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb");
        parent::SetParameterSP("opt", '16');
        parent::SetParameterSP("@dFechaHoraIngreso", '');
        parent::SetParameterSP("@cCodigoPersona", '');
        parent::SetParameterSP("@iCodigoSucursal", '');
        parent::SetParameterSP("@especialidad", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("@iCodigoProgramacion", '');
        parent::SetParameterSP("@idProgramacionPacientesEmergencia", '');
        parent::SetParameterSP("@idCama", $Datos["hCodigoCama"]);
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
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function ActulizarDestino($Datos) {
        parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb");
        parent::SetParameterSP("opt", '12');
        parent::SetParameterSP("@dFechaHoraIngreso", '');
        parent::SetParameterSP("@cCodigoPersona", '');
        parent::SetParameterSP("@iCodigoSucursal", '');
        parent::SetParameterSP("@especialidad", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("@iCodigoProgramacion", '');
        parent::SetParameterSP("@idProgramacionPacientesEmergencia", $Datos['idProgramacionPacientesEmergencia']);
        parent::SetParameterSP("@idCama", '');
        parent::SetParameterSP("@idCboDestino", $Datos["idCboDestino"]);
        parent::SetParameterSP("@txtDescDestino", $Datos["txtDescDestino"]);
        parent::SetParameterSP("@idCodigoCronograma", '');
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@idCodigoCentroCosto", '');
        parent::SetParameterSP("@cCodigoDoctorPersona", '');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@vEstadoCama", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function ComboAmbienteFisico($idCodigoCronograma) {
        parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb");
        parent::SetParameterSP("opt", '10');
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
        parent::SetParameterSP("@idCodigoCronograma", $idCodigoCronograma);
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@idCodigoCentroCosto", '');
        parent::SetParameterSP("@cCodigoDoctorPersona", '');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@vEstadoCama", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function ComboDoctor($fechaSeleccionada) {
        parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb");
        parent::SetParameterSP("opt", '13');
        parent::SetParameterSP("@dFechaHoraIngreso", $fechaSeleccionada);
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
        parent::SetParameterSP("@idCodigoCentroCosto", '');
        parent::SetParameterSP("@cCodigoDoctorPersona", '');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@vEstadoCama", '');
        //parent::SetParameterSP("host",$_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function ComboEspecialidad() {
        parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb");
        parent::SetParameterSP("opt", '14');
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
        parent::SetParameterSP("@idCodigoAmbienteFisico", '');
        parent::SetParameterSP("@idCodigoCentroCosto", '');
        parent::SetParameterSP("@cCodigoDoctorPersona", '');
        parent::SetParameterSP("@vApellidoPaterno", '');
        parent::SetParameterSP("@vApellidoMaterno", '');
        parent::SetParameterSP("@vNombre", '');
        parent::SetParameterSP("@vEstadoCama", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function CodigoAmbienteFisicoCama($idProgramacionPacientesEmergencia) {
        parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb");
        parent::SetParameterSP("opt", '15');
        parent::SetParameterSP("@dFechaHoraIngreso", '');
        parent::SetParameterSP("@cCodigoPersona", '');
        parent::SetParameterSP("@iCodigoSucursal", '');
        parent::SetParameterSP("@especialidad", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@iCodigoProgramacion", '');

        parent::SetParameterSP("@idProgramacionPacientesEmergencia", $idProgramacionPacientesEmergencia);
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
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function numeroCama($iCodigoCama) {
        parent::ConnectionOpen("pnsCargarDoctoXpaciente", "dbweb");
        parent::SetParameterSP("opt", '17');
        parent::SetParameterSP("@dFechaHoraIngreso", '');
        parent::SetParameterSP("@cCodigoPersona", '');
        parent::SetParameterSP("@iCodigoSucursal", '');
        parent::SetParameterSP("@especialidad", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@iCodigoProgramacion", '');

        parent::SetParameterSP("@idProgramacionPacientesEmergencia", '');
        parent::SetParameterSP("@idCama", $iCodigoCama);
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
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function ReporteDiagnosticoGeneral($total, $Datos) {
        parent::ConnectionOpen("pnsReporteEmergenciaGeneral", "dbweb");
        parent::SetParameterSP("opt", '1');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@cantidad", $total);
        parent::SetParameterSP("@horaInicial", '');
        parent::SetParameterSP("@horaFinal", '');
        parent::SetParameterSP("@cCodigoCie", '');
        parent::SetParameterSP("@fechaInicial", $Datos['fechaInicio']);
        parent::SetParameterSP("@fechaFinal", $Datos['fechafinal']);
        parent::SetParameterSP("@RangoEdadesinicial", '');
        parent::SetParameterSP("@RangoEdadesFinal", '');
        parent::SetParameterSP("@idCie", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function CantidadTotal($Datos) {
        parent::ConnectionOpen("pnsReporteEmergenciaGeneral", "dbweb");
        parent::SetParameterSP("opt", '2');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@cantidad", '');
        parent::SetParameterSP("@horaInicial", '');
        parent::SetParameterSP("@horaFinal", '');
        parent::SetParameterSP("@cCodigoCie", '');
        parent::SetParameterSP("@fechaInicial", $Datos['fechaInicio']);
        parent::SetParameterSP("@fechaFinal", $Datos['fechafinal']);
        parent::SetParameterSP("@RangoEdadesinicial", '');
        parent::SetParameterSP("@RangoEdadesFinal", '');
        parent::SetParameterSP("@idCie", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function cabezeraTablas() {
        parent::ConnectionOpen("pnsReporteEmergenciaGeneral", "dbweb");
        parent::SetParameterSP("opt", '3');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@cantidad", '');
        parent::SetParameterSP("@horaInicial", '');
        parent::SetParameterSP("@horaFinal", '');
        parent::SetParameterSP("@cCodigoCie", '');
        parent::SetParameterSP("@fechaInicial", '');
        parent::SetParameterSP("@fechaFinal", '');
        parent::SetParameterSP("@RangoEdadesinicial", '');
        parent::SetParameterSP("@RangoEdadesFinal", '');
        parent::SetParameterSP("@idCie", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function Reporte($Datos) {
        parent::ConnectionOpen("pnsReporteEmergenciaGeneral", "dbweb");
        parent::SetParameterSP("opt", '4');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@cantidad", '');
        parent::SetParameterSP("@horaInicial", '');
        parent::SetParameterSP("@horaFinal", '');
        parent::SetParameterSP("@cCodigoCie", '');
        parent::SetParameterSP("@fechaInicial", $Datos['fechaInicio']);
        parent::SetParameterSP("@fechaFinal", $Datos['fechafinal']);
        parent::SetParameterSP("@RangoEdadesinicial", '');
        parent::SetParameterSP("@RangoEdadesFinal", '');
        parent::SetParameterSP("@idCie", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function ReporteXedades($Datos) {
        parent::ConnectionOpen("pnsReporteEmergenciaGeneral", "dbweb");
        parent::SetParameterSP("opt", '5');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@cantidad", '');
        parent::SetParameterSP("@horaInicial", '');
        parent::SetParameterSP("@horaFinal", '');
        parent::SetParameterSP("@cCodigoCie", '');
        parent::SetParameterSP("@fechaInicial", $Datos['fechaInicio']);
        parent::SetParameterSP("@fechaFinal", $Datos['fechafinal']);
        parent::SetParameterSP("@RangoEdadesinicial", '');
        parent::SetParameterSP("@RangoEdadesFinal", '');
        parent::SetParameterSP("@idCie", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function ReportexSexo($Datos) {
        parent::ConnectionOpen("pnsReporteEmergenciaGeneral", "dbweb");
        parent::SetParameterSP("opt", '6');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@cantidad", '');
        parent::SetParameterSP("@horaInicial", '');
        parent::SetParameterSP("@horaFinal", '');
        parent::SetParameterSP("@cCodigoCie", '');
        parent::SetParameterSP("@fechaInicial", $Datos['fechaInicio']);
        parent::SetParameterSP("@fechaFinal", $Datos['fechafinal']);
        parent::SetParameterSP("@RangoEdadesinicial", '');
        parent::SetParameterSP("@RangoEdadesFinal", '');
        parent::SetParameterSP("@idCie", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function ReportexSexoTotal($Datos) {
        parent::ConnectionOpen("pnsReporteEmergenciaGeneral", "dbweb");
        parent::SetParameterSP("opt", '7');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@cantidad", '');
        parent::SetParameterSP("@horaInicial", '');
        parent::SetParameterSP("@horaFinal", '');
        parent::SetParameterSP("@cCodigoCie", '');
        parent::SetParameterSP("@fechaInicial", $Datos['fechaInicio']);
        parent::SetParameterSP("@fechaFinal", $Datos['fechafinal']);
        parent::SetParameterSP("@RangoEdadesinicial", '');
        parent::SetParameterSP("@RangoEdadesFinal", '');
        parent::SetParameterSP("@idCie", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function CantidadTotalServicios($Datos) {
        parent::ConnectionOpen("pnsReporteEmergenciaServicios", "dbweb");
        parent::SetParameterSP("opt", '1');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@cantidad", '');
        parent::SetParameterSP("@fechaInicial", $Datos['fechaInicio']);
        parent::SetParameterSP("@fechaFinal", $Datos['fechafinal']);
        parent::SetParameterSP("@cCodigoAmbienteLogico", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function reporteAmbienteLogicos() {
        parent::ConnectionOpen("pnsReporteEmergenciaServicios", "dbweb");
        parent::SetParameterSP("opt", '2');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@cantidad", '');
        parent::SetParameterSP("@fechaInicial", '');
        parent::SetParameterSP("@fechaFinal", '');
        parent::SetParameterSP("@cCodigoAmbienteLogico", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function ReporteDiagnosticosXAmbLogico($cCodigoAmbienteLogico, $cantidad, $Datos) {
        parent::ConnectionOpen("pnsReporteEmergenciaServicios", "dbweb");
        parent::SetParameterSP("opt", '3');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@cantidad", $cantidad);
        parent::SetParameterSP("@fechaInicial", $Datos['fechaInicio']);
        parent::SetParameterSP("@fechaFinal", $Datos['fechafinal']);
        parent::SetParameterSP("@cCodigoAmbienteLogico", $cCodigoAmbienteLogico);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function reporteEdades($Datos) {
        parent::ConnectionOpen("pnsReporteEmergenciaServicios", "dbweb");
        parent::SetParameterSP("opt", '4');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@cantidad", '');
        parent::SetParameterSP("@fechaInicial", $Datos['fechaInicio']);
        parent::SetParameterSP("@fechaFinal", $Datos['fechafinal']);
        parent::SetParameterSP("@cCodigoAmbienteLogico", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function reporteCantidadXsexo($Datos) {
        parent::ConnectionOpen("pnsReporteEmergenciaServicios", "dbweb");
        parent::SetParameterSP("opt", '5');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@cantidad", '');
        parent::SetParameterSP("@fechaInicial", $Datos['fechaInicio']);
        parent::SetParameterSP("@fechaFinal", $Datos['fechafinal']);
        parent::SetParameterSP("@cCodigoAmbienteLogico", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    function reporteCantidadXedadesTotal($Datos) {
        parent::ConnectionOpen("pnsReporteEmergenciaServicios", "dbweb");
        parent::SetParameterSP("opt", '6');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@cantidad", '');
        parent::SetParameterSP("@fechaInicial", $Datos['fechaInicio']);
        parent::SetParameterSP("@fechaFinal", $Datos['fechafinal']);
        parent::SetParameterSP("@cCodigoAmbienteLogico", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    function reporteCantidadXsexoTotal($Datos) {
        parent::ConnectionOpen("pnsReporteEmergenciaServicios", "dbweb");
        parent::SetParameterSP("opt", '7');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@cantidad", '');
        parent::SetParameterSP("@fechaInicial", $Datos['fechaInicio']);
        parent::SetParameterSP("@fechaFinal", $Datos['fechafinal']);
        parent::SetParameterSP("@cCodigoAmbienteLogico", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }

    function reporteTotalXedad($Datos) {
        parent::ConnectionOpen("pnsReporteEmergenciaServicios", "dbweb");
        parent::SetParameterSP("opt", '8');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@cantidad", '');
        parent::SetParameterSP("@fechaInicial", $Datos['fechaInicio']);
        parent::SetParameterSP("@fechaFinal", $Datos['fechafinal']);
        parent::SetParameterSP("@cCodigoAmbienteLogico", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }
    function reporteTotalXsexo($Datos) {
        parent::ConnectionOpen("pnsReporteEmergenciaServicios", "dbweb");
        parent::SetParameterSP("opt", '9');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@cantidad", '');
        parent::SetParameterSP("@fechaInicial", $Datos['fechaInicio']);
        parent::SetParameterSP("@fechaFinal", $Datos['fechafinal']);
        parent::SetParameterSP("@cCodigoAmbienteLogico", '');
        $resultado = parent::ExecuteSPArrayX();
        parent::Close();
        return $resultado;
    }
}

?>