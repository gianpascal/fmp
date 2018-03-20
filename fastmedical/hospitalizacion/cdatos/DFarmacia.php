<?php

include_once("../../../pholivo/adophp/Adophp.class.php");
include_once("../../../pholivo/Conexion.php");

class DFarmacia extends Adophp {

    public function __construct($cnx = Array(), $_eCita='') {
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

    public function getArrayControlInternoFarmaciaSOP($datos) {
        parent::ConnectionOpen("pnsMantenimientoFarmaciaSOP", "dbweb");
        parent::SetParameterSP("accion", "2");
        parent::SetParameterSP("iidProgramacionSOP", $datos["iidProgramacionSOP"]);
        parent::SetParameterSP("cCodigoPersona", $datos["codigopersona"]);
        parent::SetParameterSP("c_cod_ser_pro", "");
        parent::SetParameterSP("tipobusqueda", "");
        parent::SetParameterSP("parametrobusqueda", "");
        parent::SetParameterSP("cantidadentregada", "");
        parent::SetParameterSP("codigoasignacionproducto", "");
        parent::SetParameterSP("cadenanuevosdatos", "");
        parent::SetParameterSP("vUsuario", "");
        parent::SetParameterSP("vHostname", "");
        //parent::SetParameterSP("fechaSOP",$datos["fechaSOP"]);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function getArrayPaquetesFarmaceuticosCISOP() {
        parent::ConnectionOpen("pnsMantenimientoFarmaciaSOP", "dbweb");
        parent::SetParameterSP("accion", "1");
        parent::SetParameterSP("iidProgramacionSOP", "");
        parent::SetParameterSP("cCodigoPersona", "");
        parent::SetParameterSP("c_cod_ser_pro", "");
        parent::SetParameterSP("tipobusqueda", "");
        parent::SetParameterSP("parametrobusqueda", "");
        parent::SetParameterSP("cantidadentregada", "");
        parent::SetParameterSP("codigoasignacionproducto", "");
        parent::SetParameterSP("cadenanuevosdatos", "");
        parent::SetParameterSP("vUsuario", "");
        parent::SetParameterSP("vHostname", "");
        //parent::SetParameterSP("fechaSOP",$datos["fechaSOP"]);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function setPaqueteMedicamentosalPacienteFarmaciaCISOP($datos) {
        parent::ConnectionOpen("pnsMantenimientoFarmaciaSOP", "dbweb");
        parent::SetParameterSP("accion", "3");
        parent::SetParameterSP("iidProgramacionSOP", $datos["iidProgramacionSOP"]);
        parent::SetParameterSP("cCodigoPersona", $datos["codigopersona"]);
        parent::SetParameterSP("codigoPaqueteFarmaceutico", $datos["codigopaquetefarmaceuticoSOP"]);
        parent::SetParameterSP("tipobusqueda", "");
        parent::SetParameterSP("parametrobusqueda", "");
        parent::SetParameterSP("cantidadentregada", "");
        parent::SetParameterSP("codigoasignacionproducto", "");
        parent::SetParameterSP("cadenanuevosdatos", "");
        parent::SetParameterSP("vUsuario", $_SESSION["login_user"]);
        parent::SetParameterSP("vHostname", $_SESSION['host']);
        //parent::SetParameterSP("fechaSOP",$datos["fechaSOP"]);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function setProductoalPacienteFarmaciaCISOP($datos) {
        parent::ConnectionOpen("pnsMantenimientoFarmaciaSOP", "dbweb");
        parent::SetParameterSP("accion", "5");
        parent::SetParameterSP("iidProgramacionSOP", $datos["iidProgramacionSOP"]);
        parent::SetParameterSP("cCodigoPersona", $datos["codigopersona"]);
        parent::SetParameterSP("codigoPaqueteFarmaceutico", $datos["codigoproducto"]);
        parent::SetParameterSP("tipobusqueda", "");
        parent::SetParameterSP("parametrobusqueda", "");
        parent::SetParameterSP("cantidadentregada", $datos["cantidadaentregar"]);
        parent::SetParameterSP("codigoasignacionproducto", "");
        parent::SetParameterSP("cadenanuevosdatos", "");
        parent::SetParameterSP("vUsuario", $_SESSION["login_user"]);
        parent::SetParameterSP("vHostname", $_SESSION['host']);
        //parent::SetParameterSP("fechaSOP",$datos["fechaSOP"]);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function deleteProductoalPacienteFarmaciaCISOP($datos) {
        parent::ConnectionOpen("pnsMantenimientoFarmaciaSOP", "dbweb");
        parent::SetParameterSP("accion", "6");
        parent::SetParameterSP("iidProgramacionSOP", "");
        parent::SetParameterSP("cCodigoPersona", "");
        parent::SetParameterSP("codigoPaqueteFarmaceutico", "");
        parent::SetParameterSP("tipobusqueda", "");
        parent::SetParameterSP("parametrobusqueda", "");
        parent::SetParameterSP("cantidadentregada", "");
        parent::SetParameterSP("codigoasignacionproducto", $datos["codigoAsignacionProductoCISOP"]);
        parent::SetParameterSP("cadenanuevosdatos", "");
        parent::SetParameterSP("vUsuario", $_SESSION["login_user"]);
        parent::SetParameterSP("vHostname", $_SESSION['host']);
        //parent::SetParameterSP("fechaSOP",$datos["fechaSOP"]);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function getDatosdelPaqueteAsignadoFarmaciaSOP($datos) {
        parent::ConnectionOpen("pnsMantenimientoFarmaciaSOP", "dbweb");
        parent::SetParameterSP("accion", "7");
        parent::SetParameterSP("iidProgramacionSOP", $datos["codigoProgramacionSOP"]);
        parent::SetParameterSP("cCodigoPersona", $datos["codigopersona"]);
        parent::SetParameterSP("codigoPaqueteFarmaceutico", "");
        parent::SetParameterSP("tipobusqueda", "");
        parent::SetParameterSP("parametrobusqueda", "");
        parent::SetParameterSP("cantidadentregada", "");
        parent::SetParameterSP("codigoasignacionproducto", "");
        parent::SetParameterSP("cadenanuevosdatos", "");
        parent::SetParameterSP("vUsuario", "");
        parent::SetParameterSP("vHostname", "");
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function updateNuevasCantidadesEntregadasCISOP($datos) {
        parent::ConnectionOpen("pnsMantenimientoFarmaciaSOP", "dbweb");
        parent::SetParameterSP("accion", "8");
        parent::SetParameterSP("iidProgramacionSOP", "");
        parent::SetParameterSP("cCodigoPersona", "");
        parent::SetParameterSP("codigoPaqueteFarmaceutico", "");
        parent::SetParameterSP("tipobusqueda", "");
        parent::SetParameterSP("parametrobusqueda", "");
        parent::SetParameterSP("cantidadentregada", "");
        parent::SetParameterSP("codigoasignacionproducto", "");
        parent::SetParameterSP("cadenanuevosdatos", $datos["cadenanuevosdatos"]);
        parent::SetParameterSP("vUsuario", $_SESSION["login_user"]);
        parent::SetParameterSP("vHostname", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function getArrayNuevosProductosCISOP($datos) {
        parent::ConnectionOpen("pnsMantenimientoFarmaciaSOP", "dbweb");
        parent::SetParameterSP("accion", "4");
        parent::SetParameterSP("iidProgramacionSOP", "");
        parent::SetParameterSP("cCodigoPersona", "");
        parent::SetParameterSP("codigoPaqueteFarmaceutico", "");
        parent::SetParameterSP("tipobusqueda", "");
        parent::SetParameterSP("parametrobusqueda", "");
        parent::SetParameterSP("cantidadentregada", "");
        parent::SetParameterSP("codigoasignacionproducto", "");
        parent::SetParameterSP("cadenanuevosdatos", "");
        parent::SetParameterSP("vUsuario", $_SESSION["login_user"]);
        parent::SetParameterSP("vHostname", $_SESSION['host']);
        //parent::SetParameterSP("fechaSOP",$datos["fechaSOP"]);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function getDatosPacienteCISOP($datos) {
        parent::ConnectionOpen("pnsMantenimientoFarmaciaSOP", "dbweb");
        parent::SetParameterSP("accion", "10");
        parent::SetParameterSP("iidProgramacionSOP", "");
        parent::SetParameterSP("cCodigoPersona", $datos["codigopersona"]);
        parent::SetParameterSP("codigoPaqueteFarmaceutico", "");
        parent::SetParameterSP("tipobusqueda", "");
        parent::SetParameterSP("parametrobusqueda", "");
        parent::SetParameterSP("cantidadentregada", "");
        parent::SetParameterSP("codigoasignacionproducto", "");
        parent::SetParameterSP("cadenanuevosdatos", "");
        parent::SetParameterSP("vUsuario", "");
        parent::SetParameterSP("vHostname", "");
        //parent::SetParameterSP("fechaSOP",$datos["fechaSOP"]);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;        
    }
    public function generarOrdenCuentaCorrienteFarmaciaCISOP($datos){
        parent::ConnectionOpen("pnsMantenimientoFarmaciaSOP", "dbweb");
        parent::SetParameterSP("accion", "9");
        parent::SetParameterSP("iidProgramacionSOP",$datos["codigoProgramacionSOP"]);
        parent::SetParameterSP("cCodigoPersona", $datos["codigopersona"]);
        parent::SetParameterSP("codigoPaqueteFarmaceutico","");
        parent::SetParameterSP("tipobusqueda", "");
        parent::SetParameterSP("parametrobusqueda", "");
        parent::SetParameterSP("cantidadentregada", "");
        parent::SetParameterSP("codigoasignacionproducto", "");
        parent::SetParameterSP("cadenanuevosdatos", "");
        parent::SetParameterSP("vUsuario", $_SESSION["login_user"]);
        parent::SetParameterSP("vHostname", $_SESSION['host']);
        //parent::SetParameterSP("fechaSOP",$datos["fechaSOP"]);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;        
    }

}

?>
