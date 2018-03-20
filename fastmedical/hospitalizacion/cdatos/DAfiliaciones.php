<?php

include_once("../../../pholivo/adophp/Adophp.class.php");
include_once("../../../pholivo/Conexion.php");

class DAfiliaciones extends Adophp {

    private $dsn;

    public function __construct($dsn = '') {
        $this->dsn = empty($dsn) ? Conexion::getInitDsnMSSQLSimedh() : $dsn;
        parent::__construct('Spanish', $this->dsn);
    }

    public function getArrayContribuyentes($datos) {
        $this->dsn = Conexion::getInitDsnMSSQLSimi();
        parent::setDsn($this->dsn);
        parent::ConnectionOpen("pa_Contribpuntual", "dbo");
        parent::SetParameterSP("opcion", $datos["opcionbusqueda"]);
        parent::SetParameterSP("idcontribuyente", $datos["idcontribuyente"]);
        parent::SetParameterSP("nombrecontribuyente", $datos["nombrecontribuyente"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function BuscarPersonaDBSIMI($datos) {
        $this->dsn = Conexion::getInitDsnMSSQLSimi();
        parent::setDsn($this->dsn);
        parent::ConnectionOpen("pa_Contribpuntual", "dbo");
        parent::SetParameterSP("opcion", "1");
        parent::SetParameterSP("idcontribuyente", "");
        parent::SetParameterSP("nombrecontribuyente", $datos["Nombre"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function getEstadoContribuyente($datos) {
        $this->dsn = Conexion::getInitDsnMSSQLSimi();
        parent::setDsn($this->dsn);
        parent::ConnectionOpen("pa_Contribpuntual", "dbo");
        parent::SetParameterSP("opcion", $datos["opcionbusqueda"]);
        parent::SetParameterSP("idcontribuyente", $datos["idcontribuyente"]);
        parent::SetParameterSP("nombrecontribuyente", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function TablaEstadoDeuda($datos) {
        $this->dsn = Conexion::getInitDsnMSSQLSimi();
        parent::setDsn($this->dsn);
        parent::ConnectionOpen("pa_Contribpuntual", "dbo");
        parent::SetParameterSP("opcion", 2);
        parent::SetParameterSP("idcontribuyente", $datos["CodAutogenerado"]);
        parent::SetParameterSP("nombrecontribuyente", '');
        $resultado = parent::executeSPArrayX();
        //echo parent::GetSql();
        parent::Close();
        return $resultado;
    }

    public function agregaAfiliacionalPaciente($datos, $afiliacion) {
        parent::ConnectionOpen("pnsAfiliaciones", "dbweb");
        parent::SetParameterSP("accion", '01');
        parent::SetParameterSP("codigopersona", $datos["codigopersona"]);
        parent::SetParameterSP("codigoafiliacion", $afiliacion);
        parent::SetParameterSP("codigopersonahabiente", $datos["codigopersona"]);
        parent::SetParameterSP("btitular", '1');
        parent::SetParameterSP("usuario", $_SESSION["login_user"]);
        parent::SetParameterSP("estacion", $_SESSION['host']);
        parent::SetParameterSP("c_cod_per_h", $datos["codigopersona"]);
        parent::SetParameterSP("autogenerado", null);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function RegistrarAutoGenerado($datos) {
        parent::ConnectionOpen("pnsAfiliaciones", "dbweb");
        parent::SetParameterSP("accion", '05');
        parent::SetParameterSP("codigopersona", $datos["codPersonaSimedh"]);
        parent::SetParameterSP("codigoafiliacion", '0002');
        parent::SetParameterSP("codigopersonahabiente", $datos["codPersonaSimedh"]);
        parent::SetParameterSP("btitular", '1');
        parent::SetParameterSP("usuario", $_SESSION["login_user"]);
        parent::SetParameterSP("estacion", $_SESSION['host']);
        parent::SetParameterSP("c_cod_per_h", $datos["codPersonaSimedh"]);
        parent::SetParameterSP("autogenerado", null);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function deleteAfiliacionalPaciente($datos) {
        parent::ConnectionOpen("pnsAfiliaciones", "dbweb");
        parent::SetParameterSP("accion", '03');
        parent::SetParameterSP("codigopersona", $datos["codigopersona"]);
        parent::SetParameterSP("codigoafiliacion", $datos["afiliacion"]);
        parent::SetParameterSP("codigopersonahabiente", "");
        parent::SetParameterSP("btitular", '1');
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("estacion", "");
        parent::SetParameterSP("c_cod_per_h", "");
        parent::SetParameterSP("autogenerado", null);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function verificarCodAutogenerado($datos) {
        parent::ConnectionOpen("pnsDatosEnTablaEssalud", "dbweb");
        parent::SetParameterSP("bus", '1');
        parent::SetParameterSP("pv1", $datos["CodiAuto"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        parent::SetParameterSP("pv5", "");
        parent::SetParameterSP("pv6", "");
        parent::SetParameterSP("pv7", "");
        parent::SetParameterSP("pv8", "");
        parent::SetParameterSP("pv9", "");
        parent::SetParameterSP("pv10", "");
        parent::SetParameterSP("pv11", "");
        parent::SetParameterSP("pv12", "");
        parent::SetParameterSP("pv13", "");
        parent::SetParameterSP("pv14", "");
        parent::SetParameterSP("pv15", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function cargarDatosPersona($datos) {
        parent::ConnectionOpen("pnsDatosEnTablaEssalud", "dbweb");
        parent::SetParameterSP("bus", '4');
        parent::SetParameterSP("pv1", $datos["Codigo"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        parent::SetParameterSP("pv5", "");
        parent::SetParameterSP("pv6", "");
        parent::SetParameterSP("pv7", "");
        parent::SetParameterSP("pv8", "");
        parent::SetParameterSP("pv9", "");
        parent::SetParameterSP("pv10", "");
        parent::SetParameterSP("pv11", "");
        parent::SetParameterSP("pv12", "");
        parent::SetParameterSP("pv13", "");
        parent::SetParameterSP("pv14", "");
        parent::SetParameterSP("pv15", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//    public function ActualizarDatosEssalud($datos) {
//        parent::ConnectionOpen("pnsDatosEnTablaEssalud", "dbweb");
//        parent::SetParameterSP("bus", '2');
//        parent::SetParameterSP("pv1", $datos["CodiAuto"]);
//        parent::SetParameterSP("pv2", $datos["Ubigeo"]);
//        parent::SetParameterSP("pv3", $datos["Desde"]);
//        parent::SetParameterSP("pv4", $datos["Hasta"]);
//        parent::SetParameterSP("pv5", $datos["FechaNac"]);
//        parent::SetParameterSP("pv6", $datos["CodPer"]);
//        parent::SetParameterSP("pv7", "");
//        parent::SetParameterSP("pv8", "");
//        parent::SetParameterSP("pv9", "");
//        parent::SetParameterSP("pv10", "");
//        parent::SetParameterSP("pv11", "");
//        parent::SetParameterSP("pv12", "");
//        parent::SetParameterSP("pv13", "");
//        parent::SetParameterSP("pv14", "");
//        parent::SetParameterSP("pv15", "");
//        $resultado = parent::executeSPArrayX();
//        parent::Close();
//        return $resultado;
//    }
    public function ActualizarDatosEssalud($datos) {
        parent::ConnectionOpen("pnsDatosEnTablaEssalud", "dbweb");
        parent::SetParameterSP("bus", '2');
        parent::SetParameterSP("pv1", $datos["CodiAuto"]);
        parent::SetParameterSP("pv2", $datos["Ubigeo"]);
        parent::SetParameterSP("pv3", $datos["Desde"]);
        parent::SetParameterSP("pv4", $datos["Hasta"]);
        parent::SetParameterSP("pv5", $datos["Doc"]);
        parent::SetParameterSP("pv6", $datos["ApePat"]);
        parent::SetParameterSP("pv7", $datos["ApeMat"]);
        parent::SetParameterSP("pv8", $datos["Nomb1"]);
        parent::SetParameterSP("pv9", $datos["Nomb2"]);
        parent::SetParameterSP("pv10", $datos["Sexo"]);
        parent::SetParameterSP("pv11", $datos["FechaNac"]);
        parent::SetParameterSP("pv12", $datos["CodPer"]);
        parent::SetParameterSP("pv13", $_SESSION["login_user"]);
        parent::SetParameterSP("pv14", $_SESSION['host']);
        parent::SetParameterSP("pv15", $datos["edad"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function InsertarDatosEssalud($datos) {
        parent::ConnectionOpen("pnsDatosEnTablaEssalud", "dbweb");
        parent::SetParameterSP("bus", '3');
        parent::SetParameterSP("pv1", $datos["CodiAuto"]);
        parent::SetParameterSP("pv2", $datos["Ubigeo"]);
        parent::SetParameterSP("pv3", $datos["Desde"]);
        parent::SetParameterSP("pv4", $datos["Hasta"]);
        parent::SetParameterSP("pv5", $datos["Doc"]);
        parent::SetParameterSP("pv6", $datos["ApePat"]);
        parent::SetParameterSP("pv7", $datos["ApeMat"]);
        parent::SetParameterSP("pv8", $datos["Nomb1"]);
        parent::SetParameterSP("pv9", $datos["Nomb2"]);
        parent::SetParameterSP("pv10", $datos["Sexo"]);
        parent::SetParameterSP("pv11", $datos["FechaNac"]);
        parent::SetParameterSP("pv12", $datos["CodPer"]);
        parent::SetParameterSP("pv13", $_SESSION["login_user"]);
        parent::SetParameterSP("pv14", $_SESSION['host']);
        parent::SetParameterSP("pv15", $datos["edad"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dagregarAfiliacionPersona($datos) {
        parent::ConnectionOpen("pnsAfiliacionesXPersona", "dbweb");
        parent::SetParameterSP("bus", '1');
        parent::SetParameterSP("pv1", $datos["IdAfil"]);
        parent::SetParameterSP("pv2", $datos["NumeroAfiliacio"]);
        parent::SetParameterSP("pv3", $datos["CodigoPersona"]);
        parent::SetParameterSP("pv4", $datos["CodigoPersona"]);
        parent::SetParameterSP("pv5", $_SESSION["login_user"]);
        parent::SetParameterSP("pv6", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function activarAfiliacion($datos) {
        parent::ConnectionOpen("pnsAfiliacionesXPersona", "dbweb");
        parent::SetParameterSP("bus", '2');
        parent::SetParameterSP("pv1", $datos["CodigoPersona"]);
        parent::SetParameterSP("pv2", $datos["IdAfil"]);
        parent::SetParameterSP("pv3", $datos["NumeroAfil"]);
        parent::SetParameterSP("pv4", $_SESSION["login_user"]);
        parent::SetParameterSP("pv5", $_SESSION['host']);
        parent::SetParameterSP("pv6", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dactivarAfiliacionEssalud($datos) {
        parent::ConnectionOpen("pnsAfiliacionesXPersona", "dbweb");
        parent::SetParameterSP("bus", '3');
        parent::SetParameterSP("pv1", $datos["CodigoPersona"]);
        parent::SetParameterSP("pv2", $datos["IdAfil"]);
        parent::SetParameterSP("pv3", $datos["NumeroAfil"]);
        parent::SetParameterSP("pv4", $_SESSION["login_user"]);
        parent::SetParameterSP("pv5", $_SESSION['host']);
        parent::SetParameterSP("pv6", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function getArrayAfiliacionGeneral($datos) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("accion", '06');
        parent::SetParameterSP("codigopersona", $datos["codigoPersona"]);
        parent::SetParameterSP("var2", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function tablaAfiliacionesActiPersona($datos) {
        parent::ConnectionOpen("pnsAfiliacionesXPersona", "dbweb");
        parent::SetParameterSP("bus", '5');
        parent::SetParameterSP("pv1", $datos["CodigoPersona"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        parent::SetParameterSP("pv5", "");
        parent::SetParameterSP("pv6", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dtablaxAfiliacionesInacPersona($datos) {
        parent::ConnectionOpen("pnsAfiliacionesXPersona", "dbweb");
        parent::SetParameterSP("bus", '6');
        parent::SetParameterSP("pv1", $datos["codigoPersona"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        parent::SetParameterSP("pv5", "");
        parent::SetParameterSP("pv6", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function getArrayNOAfiliacionGeneral($datos) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("accion", '22');
        parent::SetParameterSP("codigopersona", $datos["codigoPersona"]);
        parent::SetParameterSP("var2", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spListaPersonaEssalud($c_cod_per) {
        parent::ConnectionOpen("pnsListaAfiliacionEssalud", "dbweb");
        parent::SetParameterSP("accion", 1);
        parent::SetParameterSP("c_cod_per", $c_cod_per);
        parent::SetParameterSP("idCarta", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spListaDatosEssalud($c_cod_per) {
        parent::ConnectionOpen("pnsListaAfiliacionEssalud", "dbweb");
        parent::SetParameterSP("accion", 2);
        parent::SetParameterSP("c_cod_per", $c_cod_per);
        parent::SetParameterSP("idCarta", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spListaCabeceraCartaEssalud($c_cod_per) {
        parent::ConnectionOpen("pnsListaAfiliacionEssalud", "dbweb");
        parent::SetParameterSP("accion", 3);
        parent::SetParameterSP("c_cod_per", $c_cod_per);
        parent::SetParameterSP("idCarta", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spListaDetalleCartaEssaludPorCabeceraCarta($idCarta) {
        parent::ConnectionOpen("pnsListaAfiliacionEssalud", "dbweb");
        parent::SetParameterSP("accion", 5);
        parent::SetParameterSP("c_cod_per", "");
        parent::SetParameterSP("idCarta", $idCarta);
        $resultado = parent::executeSPArrayX();
        parent::Close();


        return $resultado;
    }

    public function spListaDetalleCartaEssalud($c_cod_per) {
        parent::ConnectionOpen("pnsListaAfiliacionEssalud", "dbweb");
        parent::SetParameterSP("accion", 4);
        parent::SetParameterSP("c_cod_per", $c_cod_per);
        parent::SetParameterSP("idCarta", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function TablaListaDetalleCartaEssaludPorCabeceraCarta($c_cod_per) {
        parent::ConnectionOpen("pnsListaAfiliacionEssalud", "dbweb");
        parent::SetParameterSP("accion", 4);
        parent::SetParameterSP("c_cod_per", $c_cod_per);
        parent::SetParameterSP("idCarta", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function verificarExistenciaDBContribuyentePuntual($datos) {
        parent::ConnectionOpen("pnsContribuyentesPuntuales", "dbweb");
        parent::SetParameterSP("bus", 1);
        parent::SetParameterSP("var1", $datos['codPersona']);
        parent::SetParameterSP("var2", "");
        parent::SetParameterSP("var3", "");
        parent::SetParameterSP("var4", "");
        parent::SetParameterSP("var5", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function TablaListaPersonaEssalud($c_cod_per) {
        parent::ConnectionOpen("pnsListaAfiliacionEssalud", "dbweb");
        parent::SetParameterSP("accion", 1);
        parent::SetParameterSP("c_cod_per", $c_cod_per);
        parent::SetParameterSP("idCarta", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function ListaDatosEssalud($c_cod_per) {
        parent::ConnectionOpen("pnsListaAfiliacionEssalud", "dbweb");
        parent::SetParameterSP("accion", 2);
        parent::SetParameterSP("c_cod_per", $c_cod_per);
        parent::SetParameterSP("idCarta", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function TablaListaCabeceraCartaEssalud($c_cod_per) {
        parent::ConnectionOpen("pnsListaAfiliacionEssalud", "dbweb");
        parent::SetParameterSP("accion", 3);
        parent::SetParameterSP("c_cod_per", $c_cod_per);
        parent::SetParameterSP("idCarta", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function guardarRelacionEntreDBSIMIandSIMED($datos) {
        parent::ConnectionOpen("pnsContribuyentesPuntuales", "dbweb");
        parent::SetParameterSP("bus", 2);
        parent::SetParameterSP("var1", $datos["codPersonaSimedh"]);
        parent::SetParameterSP("var2", $datos["CodPersonaSimi"]);
        parent::SetParameterSP("pv3", $_SESSION["login_user"]);
        parent::SetParameterSP("pv4", $_SESSION['host']);
        parent::SetParameterSP("pv5", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function QuitarRelacion($datos) {
        parent::ConnectionOpen("pnsContribuyentesPuntuales", "dbweb");
        parent::SetParameterSP("bus", 3);
        parent::SetParameterSP("var1", $datos["CodPersona"]);
        parent::SetParameterSP("var2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        parent::SetParameterSP("pv5", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

}

?>
