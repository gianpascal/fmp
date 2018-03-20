<?php

include_once("../../../pholivo/Conexion.php");
include_once("../../../pholivo/adophp/Adophp.class.php");

class DMantenimientoGeneral extends Adophp {

    private $dsn;

    public function __construct($dsn = '') {
        $this->dsn = empty($dsn) ? Conexion::getInitDsnMSSQLSimedh() : $dsn;
        parent::__construct('Spanish', $this->dsn);
    }

    /*     * ***********************************MANTENIMIENTO AMBIENTES FISICOS************************************** */

    public function spListaEmpresas($nomEmpresa) {
        parent::ConnectionOpen("pnsListaEmpresa", "dbweb");
        parent::SetParameterSP("$1", "%" . $nomEmpresa . "%");
        parent::SetSelect("*");
        parent::SetPagination('ALL');
        return parent::executeSPArrayX();
    }

    public function spListaSedes($codEmpresa, $nomSede) {
        parent::ConnectionOpen("pnsListaSede", "dbweb");
        parent::SetParameterSP("$1", $codEmpresa);
        parent::SetParameterSP("$2", "%" . $nomSede . "%");
        parent::SetSelect("*");
        parent::SetPagination('ALL');
        return parent::executeSPArrayX();
    }

    public function spListaAmbientesFisicos($idSedeEmpresa, $nomAmbienteFisico) {
        parent::ConnectionOpen("pnsListaAmbienteFisico", "dbweb");
        parent::SetParameterSP("$1", $idSedeEmpresa);
        parent::SetParameterSP("$2", "%" . $nomAmbienteFisico . "%");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    /*
     *        /*
      parent::ConnectionOpen("pnsListaAmbienteFisico","dbweb");
      parent::SetParameterSP("accion",'3');
      parent::SetParameterSP("id_sede_empresa",'');
      parent::SetParameterSP("nom_ambiente_fisico",'');
      parent::SetParameterSP("user",$_SESSION["login_user"]);
      parent::SetParameterSP("host",$_SESSION['host']);
      parent::SetParameterSP("vNombreAlmacen",$datos["p1"]);
      parent::SetParameterSP("iCodigoAmbienteFisico",$datos["p2"]);
      parent::SetParameterSP("vDescripcionAlmacen",$datos["p3"]);

      //strtoupper($_SESSION["login_user"])
      $resultado=parent::executeSPArrayX();
      return $resultado
     */

    public function spManteAmbienteFisico($accion, $codAmbienteFisico, $idSedeEmpresa, $nomAmbienteFisico, $descAmbienteFisico, $numPisoAmbienteFisico, $anchoAmbienteFisico, $largoAmbienteFisico, $altoAmbienteFisico, $umAmbienteFisico, $idTipo) {
        parent::ConnectionOpen("pnsManteAmbienteFisico", "dbweb");
        parent::SetParameterSP("$1", $accion);
        parent::SetParameterSP("$2", $codAmbienteFisico);
        parent::SetParameterSP("$3", $idSedeEmpresa);
        parent::SetParameterSP("$4", $nomAmbienteFisico);
        parent::SetParameterSP("$5", $descAmbienteFisico);
        parent::SetParameterSP("$6", $numPisoAmbienteFisico);
        parent::SetParameterSP("$7", $anchoAmbienteFisico);
        parent::SetParameterSP("$8", $largoAmbienteFisico);
        parent::SetParameterSP("$9", $altoAmbienteFisico);
        parent::SetParameterSP("$10", $umAmbienteFisico);
        parent::SetParameterSP("$11", $idTipo);
        parent::SetSelect("*");
        parent::SetPagination('ALL');
        return parent::executeSPArrayX();
    }

    public function spEliminarAmbienteFisico($codAmbienteFisico, $idSedeEmpresa) {
        parent::ConnectionOpen("pnsEliminarAmbienteFisico", "dbweb");
        parent::SetParameterSP("$1", $codAmbienteFisico);
        parent::SetParameterSP("$2", $idSedeEmpresa);
        parent::SetSelect("*");
        parent::SetPagination('ALL');
        return parent::executeSPArrayX();
    }

    public function spListaAmbFisicoxServBasico($codAmbienteFisico, $nomServicioBasico) {
        parent::ConnectionOpen("pnsListaAmbFisicoxServBasico", "dbweb");
        parent::SetParameterSP("$1", $codAmbienteFisico);
        parent::SetParameterSP("$2", "%" . $nomServicioBasico . "%");
        parent::SetSelect("*");
        parent::SetPagination('ALL');
        return parent::executeSPArrayX();
    }

    //Habilita-Deshabilita servicio basico de ambiente fisico
    public function spHabServBasicoDeAmbFisico($codAmbienteFisico, $codServicioBasico, $estado) {
        if ($estado == 1) {//Está habilitado -> deseo deshabilitarlo
            parent::ConnectionOpen("pnsEliminarServBasicoDeAmbFisico", "dbweb");
            parent::SetParameterSP("$1", $codAmbienteFisico);
            parent::SetParameterSP("$2", $codServicioBasico);
        } else {//Está deshabilitado -> deseo habilitarlo
            parent::ConnectionOpen("pnsInsertarServBasicoDeAmbFisico", "dbweb");
            parent::SetParameterSP("$1", $codAmbienteFisico);
            parent::SetParameterSP("$2", $codServicioBasico);
            parent::SetParameterSP("$3", 1);
        }
        parent::SetSelect("*");
        parent::SetPagination('ALL');
        return parent::executeSPArrayX();
    }

    public function spListaCamaxAmbFisico($codAmbienteFisico, $descCama) {
        parent::ConnectionOpen("pnsListaCamaxAmbFisico", "dbweb");
        parent::SetParameterSP("$1", $codAmbienteFisico);
        parent::SetParameterSP("$2", "%" . $descCama . "%");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spManteCamaxAmbienteFisico($accion, $idCama, $codAmbienteFisico, $numCama, $descCama) {
        parent::ConnectionOpen("pnsManteCamaxAmbFisico", "dbweb");
        parent::SetParameterSP("$1", $accion);
        parent::SetParameterSP("$2", $idCama); //codCama-->no se usa para esta accion
        parent::SetParameterSP("$3", $codAmbienteFisico); //codAmbienteFisico
        parent::SetParameterSP("$4", $numCama); //numCama-->no se usa para esta accion
        parent::SetParameterSP("$5", $descCama); //descCama-->no se usa para esta accion
        parent::SetParameterSP("$6", 1); //estadoCama
        parent::SetParameterSP("$7", 0); //bOcupado
        parent::SetParameterSP("$8", strtoupper($_SESSION["login_user"])); //vUsuario
        parent::SetParameterSP("$9", $_SESSION["host"]); //vHost
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function getUltimoNumCamaxAmbFisico($codAmbienteFisico) {
        parent::ConnectionOpen("pnsManteCamaxAmbFisico", "dbweb");
        parent::SetParameterSP("$1", "ultNumCama");
        parent::SetParameterSP("$2", 0); //codCama-->no se usa para esta accion
        parent::SetParameterSP("$3", $codAmbienteFisico); //codAmbienteFisico
        parent::SetParameterSP("$4", 0); //numCama-->no se usa para esta accion
        parent::SetParameterSP("$5", ""); //descCama-->no se usa para esta accion
        parent::SetParameterSP("$6", 1); //estadoCama-->no se usa para esta accion
        parent::SetParameterSP("$7", 0); //bOcupado-->no se usa para esta accion
        parent::SetParameterSP("$8", ""); //vUsuario
        parent::SetParameterSP("$9", ""); //vHost
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    //Habilita-Deshabilita cama de ambiente fisico
    public function spHabCamaDeAmbFisico($codCama, $estado) {
        if ($estado == 1) {//Está habilitado -> deseo deshabilitarlo
            $estado = 0;
        } else {//Está deshabilitado -> deseo habilitarlo
            $estado = 1;
        }
        parent::ConnectionOpen("pnsManteCamaxAmbFisico", "dbweb");
        parent::SetParameterSP("$1", "habDeshab");
        parent::SetParameterSP("$2", $codCama);
        parent::SetParameterSP("$3", 0); //codAmbienteFisico-->no se usa para esta accion
        parent::SetParameterSP("$4", 0); //numCama-->no se usa para esta accion
        parent::SetParameterSP("$5", ""); //descCama-->no se usa para esta accion
        parent::SetParameterSP("$6", $estado);
        parent::SetParameterSP("$7", 0); //bOcupado-->no se usa para esta accion
        parent::SetParameterSP("$8", strtoupper($_SESSION["login_user"])); //vUsuario
        parent::SetParameterSP("$9", $_SESSION["host"]); //vHost

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    /*     * ***********************************MANTENIMIENTO TURNOS************************************** */

    public function listaTurno($descTurno) {
        parent::ConnectionOpen("pnsListaTurno_prueba", "dbweb");
        parent::SetParameterSP("opcion", 1);
        parent::SetParameterSP("$2", "%" . $descTurno . "%");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    //Cuando se agrega un nuevo Turno, se ejecuta esta funcion       //prueba $nomenclatura
    public function spManteTurno($accion, $codTurno, $descTurno, $horaInicio, $horaFinal, $totalHoras, $tipoHorario, $nomenclatura) {
        parent::ConnectionOpen("pnsManteTurno_prueba", "dbweb"); //pnsManteTurno
        parent::SetParameterSP("$1", $accion);
        parent::SetParameterSP("$2", $codTurno);
        parent::SetParameterSP("$3", $descTurno);
        parent::SetParameterSP("$4", $horaInicio);
        parent::SetParameterSP("$5", $horaFinal);
        parent::SetParameterSP("$6", $totalHoras);
        parent::SetParameterSP("$7", $tipoHorario);
        parent::SetParameterSP("$8", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("$9", $_SESSION['host']);
        parent::SetParameterSP("$10", $nomenclatura); //prueba
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spEliminarTurno($codTurno) {
        parent::ConnectionOpen("pnsEliminarTurno", "dbweb");
        parent::SetParameterSP("$1", $codTurno);
        parent::SetParameterSP("$2", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("$3", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function spListaActividades() {
        parent::ConnectionOpen("pnsListaActividades", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("codigoActividad", "");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getArrayAmbientesLogicos($datos) {
        parent::ConnectionOpen("pnsMantAmbientesLogicos", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("idCentroCosto", $datos["idCentroCosto"]);
        parent::SetParameterSP("codigoAmbienteLogico", "");
        parent::SetParameterSP("estadoAmbienteLogico", "");
        parent::SetParameterSP("nombreAmbienteLogico", "");
        parent::SetParameterSP("descripcionAmbienteLogico", "");
        parent::SetParameterSP("usuario", strtoupper($_SESSION["login_user"]));
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getAmbienteLogico($datos) {
        parent::ConnectionOpen("pnsMantAmbientesLogicos", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("codigoCentroCosto", "");
        parent::SetParameterSP("codigoAmbienteLogico", $datos["codigoAmbienteLogico"]);
        parent::SetParameterSP("estadoAmbienteLogico", "");
        parent::SetParameterSP("nombreAmbienteLogico", "");
        parent::SetParameterSP("descripcionAmbienteLogico", "");
        parent::SetParameterSP("usuario", strtoupper($_SESSION["login_user"]));
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function activaryDesactivarAmbienteLogico($datos) {
        parent::ConnectionOpen("pnsMantAmbientesLogicos", "dbweb");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("codigoCentroCosto", "");
        parent::SetParameterSP("codigoAmbienteLogico", $datos["codigoAmbienteLogico"]);
        parent::SetParameterSP("estadoAmbienteLogico", $datos["estadoAmbienteLogico"]);
        parent::SetParameterSP("nombreAmbienteLogico", "");
        parent::SetParameterSP("descripcionAmbienteLogico", "");
        parent::SetParameterSP("usuario", strtoupper($_SESSION["login_user"]));
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function grabarAmbienteLogico($datos) {
        parent::ConnectionOpen("pnsMantAmbientesLogicos", "dbweb");
        parent::SetParameterSP("accion", '4');
        parent::SetParameterSP("codigoCentroCosto", $datos["codigoCentroCosto"]);
        parent::SetParameterSP("codigoAmbienteLogico", $datos["codigoAmbienteLogico"]);
        parent::SetParameterSP("estadoAmbienteLogico", $datos["estadoAmbienteLogico"]);
        parent::SetParameterSP("nombreAmbienteLogico", $datos["nombreAmbienteLogico"]);
        parent::SetParameterSP("descripcionAmbienteLogico", $datos["descripcionAmbienteLogico"]);
        parent::SetParameterSP("usuario", strtoupper($_SESSION["login_user"]));
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /*     * ****************MANTENIMIENTO ASIGNACION AMBIENTES LOGICOS X AMBIENTES FISICOS************************************** */

    function getArrayAsignacionAmbienteFisicosaAmbientesLogicos($datos) {
        parent::ConnectionOpen("pnsMantAmbientesFisicosaAmbientesLogicos", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("codigoAmbienteLogico", $datos["codigoAmbienteLogico"]);
        parent::SetParameterSP("codigoAmbienteFisico", "");
        parent::SetParameterSP("codigoActividad", "");
        parent::SetParameterSP("estadoAsignacion", "");
        parent::SetParameterSP("usuario", "");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function agregarAmbienteFisicoaAmbienteLogico($datos) {
        parent::ConnectionOpen("pnsMantAmbientesFisicosaAmbientesLogicos", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("codigoAmbienteLogico", $datos["codigoAmbienteLogico"]);
        parent::SetParameterSP("codigoAmbienteFisico", $datos["codigoAmbienteFisico"]);
        parent::SetParameterSP("codigoActividad", $datos["codigoActividad"]);
        parent::SetParameterSP("estadoAsignacion", $datos["estadoAsignacion"]);
        parent::SetParameterSP("usuario", strtoupper($_SESSION["login_user"]));
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function activarydesactivarAsignacionAmbFisicoaAmbLogico($datos) {
        parent::ConnectionOpen("pnsMantAmbientesFisicosaAmbientesLogicos", "dbweb");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("codigoAmbienteLogico", $datos["codigoAmbienteLogico"]);
        parent::SetParameterSP("codigoAmbienteFisico", $datos["codigoAmbienteFisico"]);
        parent::SetParameterSP("codigoActividad", $datos["codigoActividad"]);
        parent::SetParameterSP("estadoAsignacion", $datos["estadoAsignacion"]);
        parent::SetParameterSP("usuario", strtoupper($_SESSION["login_user"]));
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function eliminarAsignacionAmbFisicoaAmbLogico($datos) {
        parent::ConnectionOpen("pnsMantAmbientesFisicosaAmbientesLogicos", "dbweb");
        parent::SetParameterSP("accion", '4');
        parent::SetParameterSP("codigoAmbienteLogico", $datos["codigoAmbienteLogico"]);
        parent::SetParameterSP("codigoAmbienteFisico", $datos["codigoAmbienteFisico"]);
        parent::SetParameterSP("codigoActividad", $datos["codigoActividad"]);
        parent::SetParameterSP("estadoAsignacion", "");
        parent::SetParameterSP("usuario", strtoupper($_SESSION["login_user"]));
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function buscarAmbienteFisico($codigoSucursal, $txtNombreAmbienteFisico) {
        parent::ConnectionOpen("pnsListaAmbienteFisicoAlmacen", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("id_sede_empresa", $codigoSucursal);
        parent::SetParameterSP("nom_ambiente_fisico", $txtNombreAmbienteFisico);
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("vNombreAlmacen", '');
        parent::SetParameterSP("iCodigoAmbienteFisico", '');
        parent::SetParameterSP("vDescripcionAlmacen", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function guardarAlmacen($datos) {
        parent::ConnectionOpen("pnsListaAmbienteFisicoAlmacen", "dbweb");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("id_sede_empresa", '');
        parent::SetParameterSP("nom_ambiente_fisico", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("vNombreAlmacen", $datos["p1"]);
        parent::SetParameterSP("iCodigoAmbienteFisico", $datos["p2"]);
        parent::SetParameterSP("vDescripcionAlmacen", $datos["p3"]);

        //strtoupper($_SESSION["login_user"])
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Jose 2012/02/27
    function guardarSedeEmpresaAreaMasivamente($cadenaIdArea, $cadenaIdSede) {
        parent::ConnectionOpen("pnsMantenimientoArea", "dbweb");
        parent::SetParameterSP("accion", '11');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idDependencia", '');
        parent::SetParameterSP("idSedeEmpresa", $cadenaIdSede);
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("descripcionArea", $cadenaIdArea);
        parent::SetParameterSP("abreviaturaArea", "");
        parent::SetParameterSP("nivelArea", '');
        parent::SetParameterSP("estadoArea", "");
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    public function presentacionTurnos($datos) {
        parent::ConnectionOpen("pnsListaTurno", "dbweb");
        parent::SetParameterSP("opcion", 2);
        parent::SetParameterSP("tipoHorarioTurno", $datos["tipoHorarioTurno"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    //Jose 2012/02/28
    public function preeditaArea($idArea) {
        parent::ConnectionOpen("pnsMantenimientoArea", "dbweb");
        parent::SetParameterSP("accion", '12');
        parent::SetParameterSP("idArea", $idArea);
        parent::SetParameterSP("idDependencia", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("descripcionArea", '');
        parent::SetParameterSP("abreviaturaArea", "");
        parent::SetParameterSP("nivelArea", '');
        parent::SetParameterSP("estadoArea", "");
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    //Jose 2012/03/01
    public function preeditaAreaXSedeEmpresa($idArea, $idSedeEmpresa, $nivel) {
        parent::ConnectionOpen("pnsMantenimientoArea", "dbweb");
        parent::SetParameterSP("accion", '14');
        parent::SetParameterSP("idArea", $idArea);
        parent::SetParameterSP("idDependencia", '');
        parent::SetParameterSP("idSedeEmpresa", $idSedeEmpresa);
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("descripcionArea", '');
        parent::SetParameterSP("abreviaturaArea", "");
        parent::SetParameterSP("nivelArea", $nivel);
        parent::SetParameterSP("estadoArea", "");
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    //2012/02/29
    public function grabarAreaJerarquicamente($datos) {
        parent::ConnectionOpen("pnsMantenimientoArea", "dbweb");
        parent::SetParameterSP("accion", '13');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idDependencia", $datos["idDependencia"]);
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("descripcionArea", $datos["descripcion"]);
        parent::SetParameterSP("abreviaturaArea", $datos["abrevia"]);
        parent::SetParameterSP("nivelArea", $datos["nivel"]);
        parent::SetParameterSP("estadoArea", $datos["estado"]);
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    //2012/03/01
    public function actualizarEstadoSedeEmpresaArea($datos) {
        parent::ConnectionOpen("pnsMantenimientoArea", "dbweb");
        parent::SetParameterSP("accion", '15');
        parent::SetParameterSP("idArea", $datos["idArea"]);
        parent::SetParameterSP("idDependencia", '');
        parent::SetParameterSP("idSedeEmpresa", $datos["idSedeEmpresa"]);
        parent::SetParameterSP("idSedeEmpresaArea", $datos["idSedeEmpresaArea"]);
        parent::SetParameterSP("descripcionArea", '');
        parent::SetParameterSP("abreviaturaArea", '');
        parent::SetParameterSP("nivelArea", $datos["nivel"]);
        parent::SetParameterSP("estadoArea", $datos["estado"]);
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    public function tablaSucursalesXidArea($idArea) {
        parent::ConnectionOpen("pnsMantenimientoArea", "dbweb");
        parent::SetParameterSP("accion", '16');
        parent::SetParameterSP("idArea", $idArea);
        parent::SetParameterSP("idDependencia", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("descripcionArea", '');
        parent::SetParameterSP("abreviaturaArea", '');
        parent::SetParameterSP("nivelArea", '');
        parent::SetParameterSP("estadoArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    public function actualizacionLogicaSedeEmpresaArea($idSedeEmpresaArea) {
        parent::ConnectionOpen("pnsMantenimientoArea", "dbweb");
        parent::SetParameterSP("accion", '17');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idDependencia", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idSedeEmpresaArea", $idSedeEmpresaArea);
        parent::SetParameterSP("descripcionArea", '');
        parent::SetParameterSP("abreviaturaArea", '');
        parent::SetParameterSP("nivelArea", '');
        parent::SetParameterSP("estadoArea", '0');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function comboSedes() {
        parent::ConnectionOpen("pnsMantenimientoAlmacen", "dbweb");
        parent::SetParameterSP("bus", '2');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dCargarDatosMantenimientoAlmacen($datos) {
        parent::ConnectionOpen("pnsMantenimientoAlmacen", "dbweb");
        parent::SetParameterSP("bus", '5');
        parent::SetParameterSP("pv1", $datos["idAlmacen"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        parent::SetParameterSP("pv5", "");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getListarAlmacenes() {
        parent::ConnectionOpen("pnsMantenimientoAlmacen", "dbweb");
        parent::SetParameterSP("bus", "1");
        parent::SetParameterSP("pv1", "");
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function grabarMantenimientoAlmacen($datos) {
        parent::ConnectionOpen("pnsMantenimientoAlmacen", "dbweb");
        parent::SetParameterSP("bus", "4");
        parent::SetParameterSP("pv1", $datos["idAmbienteFisico"]);
        parent::SetParameterSP("pv2", $datos["nombreAlmacen"]);
        parent::SetParameterSP("pv3", $datos["descripcion"]);
        parent::SetParameterSP("pv4", $datos["codPersona"]);
        parent::SetParameterSP("pv5", $datos["nombreAlmacenPersona"]);
        parent::SetParameterSP("pv6", $datos["codPersona"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dgrabarAgregarAlmacen($datos) {
        parent::ConnectionOpen("pnsMantenimientoAlmacen", "dbweb");
        parent::SetParameterSP("bus", "6");
        parent::SetParameterSP("pv1", "");
        parent::SetParameterSP("pv4", $datos["idAmbienteFisico"]);
        parent::SetParameterSP("pv2", $datos["nombreAlmacen"]);
        parent::SetParameterSP("pv3", $datos["descripcion"]);
        parent::SetParameterSP("pv6", $datos["nombreAlmacenPersona"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    //Mantenimiento Unidad de Medida - Sayes
    public function getUnidadMedida() {
        parent::ConnectionOpen("pnsMantenimientoUnidadMedida", "dbweb");
        parent::SetParameterSP("bus", "1");
        parent::SetParameterSP("pv1", "");
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function getUnidad($datos) {
        parent::ConnectionOpen("pnsMantenimientoUnidadMedida", "dbweb");
        parent::SetParameterSP("bus", "2");
        parent::SetParameterSP("pv1", $datos["idUnidadMedida"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dMantenimientoTiposUnidadMedida($datos) {
        parent::ConnectionOpen("pnsMantenimientoUnidadMedida", "dbweb");
        parent::SetParameterSP("bus", '3');
        parent::SetParameterSP("pv1", $datos["idTipoUnidad"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        parent::SetParameterSP("pv5", "");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function grabarMantenimientoTipoUnidadMedida($datos) {
        parent::ConnectionOpen("pnsMantenimientoUnidadMedida", "dbweb");
        parent::SetParameterSP("bus", "4");
        parent::SetParameterSP("pv1", $datos["TipoUnidadMedida"]);
        parent::SetParameterSP("pv2", $datos["idTipoUnidadMedida"]);
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function grabarAgregarTipoUnidadMedida($datos) {
        parent::ConnectionOpen("pnsMantenimientoUnidadMedida", "dbweb");
        parent::SetParameterSP("bus", "5");
        parent::SetParameterSP("pv1", $datos["TipoUnidadMedida"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dMantenimientoUnidadMedida($datos) {
        parent::ConnectionOpen("pnsMantenimientoUnidadMedida", "dbweb");
        parent::SetParameterSP("bus", '6');
        parent::SetParameterSP("pv1", $datos["idUnidadMedida"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        parent::SetParameterSP("pv5", "");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function grabarMantenimientoUnidadMedida($datos) {
        parent::ConnectionOpen("pnsMantenimientoUnidadMedida", "dbweb");
        parent::SetParameterSP("bus", "7");
        parent::SetParameterSP("pv1", $datos["idTipoUnidadMedida"]);
        parent::SetParameterSP("pv2", $datos["idUnidad"]);
        parent::SetParameterSP("pv3", $datos["unidadMedida"]);
        parent::SetParameterSP("pv4", $datos["principal"]);
        parent::SetParameterSP("pv5", $datos["equivalencia"]);
        $resultado = parent::executeSPArrayX();

        parent::Close();
        return $resultado;
    }

    public function grabarAgregarUnidadMedida($datos) {
        parent::ConnectionOpen("pnsMantenimientoUnidadMedida", "dbweb");
        parent::SetParameterSP("bus", "8");
        parent::SetParameterSP("pv1", $datos["idTipoUnidadMedida"]);
        parent::SetParameterSP("pv2", $datos["unidadMedida"]);
        parent::SetParameterSP("pv3", $datos["principal"]);
        parent::SetParameterSP("pv4", $datos["equivalencia"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function EliminarTipoUnidadMedida($datos) {
        parent::ConnectionOpen("pnsMantenimientoUnidadMedida", "dbweb");
        parent::SetParameterSP("bus", '9');
        parent::SetParameterSP("pv1", $datos["idTipoUnidad"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        parent::SetParameterSP("pv5", "");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function EliminarUnidadMedida($datos) {
        parent::ConnectionOpen("pnsMantenimientoUnidadMedida", "dbweb");
        parent::SetParameterSP("bus", '10');
        parent::SetParameterSP("pv1", $datos["idUnidad"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        parent::SetParameterSP("pv5", "");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dmodificarRadioButtonUnidadMedida($datos) {
        parent::ConnectionOpen("pnsMantenimientoUnidadMedida", "dbweb");
        parent::SetParameterSP("bus", '11');
        parent::SetParameterSP("pv1", $datos["idUnidad"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        parent::SetParameterSP("pv5", "");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }
      public function cargarTablaIPs() {
        parent::ConnectionOpen("nsmMantenimientoIP", "dbweb");
        parent::SetParameterSP("bus", '1');
        parent::SetParameterSP("pv1", "");
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
         parent::SetParameterSP("pv5", "");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }
      public function dguardarMantenimientoIp($datos) {
        parent::ConnectionOpen("nsmMantenimientoIP", "dbweb");
        parent::SetParameterSP("bus", '2');
        parent::SetParameterSP("pv1", $datos['textIP']);
        parent::SetParameterSP("pv2", $datos['textPC']);
        parent::SetParameterSP("pv3", $_SESSION["login_user"]);
        parent::SetParameterSP("pv4", $_SESSION['host']);
          parent::SetParameterSP("pv5", $datos['textIDAmbiente']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }
    
       public function actualizarMantenimiento($datos) {
        parent::ConnectionOpen("nsmMantenimientoIP", "dbweb");
        parent::SetParameterSP("bus", '3');
        parent::SetParameterSP("pv1", $datos['textIP']);
        parent::SetParameterSP("pv2", $datos['textPC']);
        parent::SetParameterSP("pv3", $datos['textID']);
        parent::SetParameterSP("pv4", $datos['textIDAmbiente']);
         parent::SetParameterSP("pv5", "");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }
    
    
       public function eliminarMantenimiento($datos) {
        parent::ConnectionOpen("nsmMantenimientoIP", "dbweb");
        parent::SetParameterSP("bus", '4');
        parent::SetParameterSP("pv1", $datos['textID']);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
         parent::SetParameterSP("pv5", "");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }
    
     public function cargarTablaAmbientes() {
        parent::ConnectionOpen("nsmMantenimientoIP", "dbweb");
        parent::SetParameterSP("bus", '5');
        parent::SetParameterSP("pv1", "");
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
         parent::SetParameterSP("pv5", "");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }
    


    public function listarGrupoEtareo() {
        parent::ConnectionOpen("pnsMantenimientoCIEGrupoEtareo", "dbweb");
        parent::SetParameterSP("bus", 1);
        parent::SetParameterSP("pv1", '');
        parent::SetParameterSP("pv2", '');
        parent::SetParameterSP("pv3", '');
        parent::SetParameterSP("pv4", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function listarCie() {
        parent::ConnectionOpen("pnsMantenimientoCIEGrupoEtareo", "dbweb");
        parent::SetParameterSP("bus", 2);
        parent::SetParameterSP("pv1", '');
        parent::SetParameterSP("pv2", '');
        parent::SetParameterSP("pv3", '');
        parent::SetParameterSP("pv4", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function verListaDeCiePorGrupoEtareo($iIdGrupoEtareo) {
        parent::ConnectionOpen("pnsMantenimientoCIEGrupoEtareo", "dbweb");
        parent::SetParameterSP("bus", 3);
        parent::SetParameterSP("pv1", '');
        parent::SetParameterSP("pv2", $iIdGrupoEtareo);
        parent::SetParameterSP("pv3", '');
        parent::SetParameterSP("pv4", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function buscarCieListado($nombreCie) {
        parent::ConnectionOpen("pnsMantenimientoCIEGrupoEtareo", "dbweb");
        parent::SetParameterSP("bus", 4);
        parent::SetParameterSP("pv1", $nombreCie);
        parent::SetParameterSP("pv2", '');
        parent::SetParameterSP("pv3", '');
        parent::SetParameterSP("pv4", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function agregarCIEaGrupoEtareo($datos) {
        parent::ConnectionOpen("pnsMantenimientoCIEGrupoEtareo", "dbweb");
        parent::SetParameterSP("bus", 5);
        parent::SetParameterSP("pv1", $datos['idCie']);
        parent::SetParameterSP("pv2", $datos['idGrupoEtareo']);
        parent::SetParameterSP("pv3", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("pv4", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function cambiarEstadoCieGrupoEtareo($datos) {
        parent::ConnectionOpen("pnsMantenimientoCIEGrupoEtareo", "dbweb");
        parent::SetParameterSP("bus", 6);
        parent::SetParameterSP("pv1", $datos['idCie']);
        parent::SetParameterSP("pv2", $datos['idGrupoEtareo']);
        parent::SetParameterSP("pv3", '');
        parent::SetParameterSP("pv4", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

}

?>
