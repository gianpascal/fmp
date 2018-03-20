<?php

require_once("../../../pholivo/adophp/Adophp.class.php");
require_once("../../../pholivo/Conexion.php");

class DRrhh extends Adophp {

    private $cnx;
    private $oRecord;

    public function __construct($cnx = Array()) {
        $this->cnx = empty($cnx) ? Conexion::getInitDsnMSSQLSimedh() : $cnx;
        parent::__construct('Spanish', $this->cnx);
    }

    public function getArrayDatosPersonal($codigoPersona) {
        parent::ConnectionOpen("pnsDatosPacienteCitas", "dbweb");
        parent::SetParameterSP("$1", $codigoPersona);
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
//parent::SetParameterSP("$2",$codigoPersona);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getArrayprofesionesAntes() {
        parent::ConnectionOpen("psnProfesiones", "dbweb");
        parent::SetParameterSP("$1", '01');
        parent::SetParameterSP("$2", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getArraygranGrupo() {
        parent::ConnectionOpen("psnProfesiones", "dbweb");
        parent::SetParameterSP("$1", '02');
        parent::SetParameterSP("$2", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getArraygranGrupoOcupaciones() {
        parent::ConnectionOpen("psnOcupaciones", "dbweb");
        parent::SetParameterSP("$1", '02');
        parent::SetParameterSP("$2", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getArrayGrupo($granGrupo) {
        parent::ConnectionOpen("psnProfesiones", "dbweb");
        parent::SetParameterSP("$1", '03');
        parent::SetParameterSP("$2", $granGrupo);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getArrayGrupoOcupaciones($granGrupo) {
        parent::ConnectionOpen("psnOcupaciones", "dbweb");
        parent::SetParameterSP("$1", '03');
        parent::SetParameterSP("$2", $granGrupo);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getArraySubGrupo($Grupo, $granGrupo) {
        parent::ConnectionOpen("psnProfesiones", "dbweb");
        parent::SetParameterSP("$1", '04');
        parent::SetParameterSP("$2", $Grupo);
        parent::SetParameterSP("$3", $granGrupo);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getArraySubGrupoOcupaciones($Grupo, $granGrupo) {
        parent::ConnectionOpen("psnOcupaciones", "dbweb");
        parent::SetParameterSP("$1", '04');
        parent::SetParameterSP("$2", $Grupo);
        parent::SetParameterSP("$3", $granGrupo);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getArraylistaApertura($granGrupo, $grupo, $subGrupo) {
        parent::ConnectionOpen("psnProfesiones", "dbweb");
        parent::SetParameterSP("$1", '05');
        parent::SetParameterSP("$2", $granGrupo);
        parent::SetParameterSP("$3", $grupo);
        parent::SetParameterSP("$4", $subGrupo);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getArrayAperturaOcupaciones($granGrupo, $grupo, $subGrupo) {
        parent::ConnectionOpen("psnOcupaciones", "dbweb");
        parent::SetParameterSP("$1", '05');
        parent::SetParameterSP("$2", $granGrupo);
        parent::SetParameterSP("$3", $grupo);
        parent::SetParameterSP("$4", $subGrupo);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function existeProfesion($codProfesionAnterior, $codEspecialidadAnterior) {
        parent::ConnectionOpen("psnProfesiones", "dbweb");
        parent::SetParameterSP("$1", '07');
        parent::SetParameterSP("$2", $codProfesionAnterior);
        parent::SetParameterSP("$3", $codEspecialidadAnterior);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function validarProfesion($codProfesionAnterior, $codEspecialidadAnterior, $codProfesionActual, $usuario, $host) {
        parent::ConnectionOpen("psnProfesiones", "dbweb");
        parent::SetParameterSP("$1", '06');
        parent::SetParameterSP("$2", $codProfesionAnterior);
        parent::SetParameterSP("$3", $codEspecialidadAnterior);
        parent::SetParameterSP("$4", $codProfesionActual);
        parent::SetParameterSP("$5", $usuario);
        parent::SetParameterSP("$6", $host);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function actualizaValidarProfesion($codProfesionAnterior, $codEspecialidadAnterior, $codProfesionActual, $usuario, $host) {
        parent::ConnectionOpen("psnProfesiones", "dbweb");
        parent::SetParameterSP("$1", '08');
        parent::SetParameterSP("$2", $codProfesionAnterior);
        parent::SetParameterSP("$3", $codEspecialidadAnterior);
        parent::SetParameterSP("$4", $codProfesionActual);
        parent::SetParameterSP("$5", $usuario);
        parent::SetParameterSP("$6", $host);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getDatosCentroCosto() {
        parent::ConnectionOpen("pnsCentroCostos", "dbweb");
        parent::SetParameterSP("$1", '01');
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    function dArbolCentroCostos() {
        parent::ConnectionOpen("pnsCentroCostos", "dbweb");
        parent::SetParameterSP("$1", '08');
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    function detalleCentroCostos($id) {
        parent::ConnectionOpen("pnsCentroCostos", "dbweb");
        parent::SetParameterSP("$1", '02');
        parent::SetParameterSP("$2", $id);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function agregarOcupacionCentroCostos($datos) {
        parent::ConnectionOpen("pnsCentroCostos", "dbweb");
        parent::SetParameterSP("$1", '03');
        parent::SetParameterSP("$2", $datos['idCentroCostos']);
        parent::SetParameterSP("$3", $datos['idOcupaciones']);
        parent::SetParameterSP("$4", $datos['vDescripcion']);
        parent::SetParameterSP("$5", $datos['usuario']);
        parent::SetParameterSP("$6", $datos['host']);
        parent::SetParameterSP("$7", $datos['estado']);
        parent::SetParameterSP("$8", $datos['icantidad']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function ocupacionesCentroCosto($idCentroCosto) {
        parent::ConnectionOpen("pnsCentroCostos", "dbweb");
        parent::SetParameterSP("$1", '04');
        parent::SetParameterSP("$2", $idCentroCosto);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function eliminarOcupacionesCentroCosto($idPuesto) {
        parent::ConnectionOpen("pnsCentroCostos", "dbweb");
        parent::SetParameterSP("$1", '05');
        parent::SetParameterSP("$2", $idPuesto);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function agregaServicioCargo($datos) {
        parent::ConnectionOpen("pnsServicioCargo", "dbweb");
        parent::SetParameterSP("$1", '01');
        parent::SetParameterSP("$2", $datos['idCargo']);
        parent::SetParameterSP("$3", $datos['idProducto']);
        parent::SetParameterSP("$4", $datos['usuario']);
        parent::SetParameterSP("$5", $datos['host']);
        parent::SetParameterSP("$6", $datos['bestado']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getServiciosCargo($idCargo) {
        parent::ConnectionOpen("pnsServicioCargo", "dbweb");
        parent::SetParameterSP("$1", '02');
        parent::SetParameterSP("$2", $idCargo);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function eliminarServicioCargo($idServicioCargo) {
        parent::ConnectionOpen("pnsServicioCargo", "dbweb");
        parent::SetParameterSP("$1", '03');
        parent::SetParameterSP("$2", $idServicioCargo);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function seleccionarCategoria() {
        parent::ConnectionOpen("pnsEmpleados", "dbweb");
        parent::SetParameterSP("$1", '02');


        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getListaPuestos($datos) {
        parent::ConnectionOpen("pnsEmpleados", "dbweb");
        parent::SetParameterSP("$1", '03');
        parent::SetParameterSP("$2", $datos["idCCostos"]);
        parent::SetParameterSP("$3", $datos["puesto"]);
        parent::SetParameterSP("$4", $datos["categoria"]);
        parent::SetParameterSP("$5", $datos["estado"]);
        parent::SetParameterSP("$6", "");
        parent::SetParameterSP("$7", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function dGetDetalleContrato($idContrato, $idPuestoEmpleado) {

        parent::ConnectionOpen("pnsEmpleados", "dbweb");
        parent::SetParameterSP("$1", '20');
        parent::SetParameterSP("$2", $idContrato);
        parent::SetParameterSP("$3", $idPuestoEmpleado);
        parent::SetParameterSP("$4", "");
        parent::SetParameterSP("$5", "");
        parent::SetParameterSP("$6", "");
        parent::SetParameterSP("$7", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function dcargarTablaContratos($iCodigoEmpleado) {
        parent::ConnectionOpen("pnsEmpleados", "dbweb");
        parent::SetParameterSP("$1", '18');
        parent::SetParameterSP("$2", $iCodigoEmpleado);
        parent::SetParameterSP("$3", "");
        parent::SetParameterSP("$4", "");
        parent::SetParameterSP("$5", "");
        parent::SetParameterSP("$6", "");
        parent::SetParameterSP("$7", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function dcargarTablaAreaPuestoEmpleado($idPuestoEmpleado) {
        parent::ConnectionOpen("pnsEmpleados", "dbweb");
        parent::SetParameterSP("$1", '21');
        parent::SetParameterSP("$2", $idPuestoEmpleado);
        parent::SetParameterSP("$3", "");
        parent::SetParameterSP("$4", "");
        parent::SetParameterSP("$5", "");
        parent::SetParameterSP("$6", "");
        parent::SetParameterSP("$7", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function dAsignarPuestoEmpleadoArea($datos) {
        parent::ConnectionOpen("pnsMantenimientoPuestoEmpleadoArea", "dbweb");
        parent::SetParameterSP("opcion", '1');
        parent::SetParameterSP("iIdPuestoEmpleadoPorArea", '0');
        parent::SetParameterSP("idArea", $datos['idArea']);
        parent::SetParameterSP("cIdSedeEmpresa", $datos['idSede']);
        parent::SetParameterSP("idPuestoEmpleado", $datos['idPuestoEmpleado']);
        parent::SetParameterSP("estadoPuestoEmpleadoArea", '1');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function dEliminarPuestoEmpleadoArea($datos) {
        parent::ConnectionOpen("pnsMantenimientoPuestoEmpleadoArea", "dbweb");
        parent::SetParameterSP("opcion", '2');
        parent::SetParameterSP("iIdPuestoEmpleadoPorArea", $datos['idPuestoEmpleadoArea']);
        parent::SetParameterSP("idArea", '0');
        parent::SetParameterSP("cIdSedeEmpresa", '0');
        parent::SetParameterSP("idPuestoEmpleado", '0');
        parent::SetParameterSP("estadoPuestoEmpleadoArea", $datos['estadoPuestoEmpleadoArea']);
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function detallePuestoCentroCosto($id) {
        parent::ConnectionOpen("pnsEmpleados", "dbweb");
        parent::SetParameterSP("$1", '04');
        parent::SetParameterSP("$2", $id);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function tablaPeriodos($iidPuestoEmpleado) {
        parent::ConnectionOpen("pnsEmpleados", "dbweb");
        parent::SetParameterSP("$1", '08');
        parent::SetParameterSP("$2", $iidPuestoEmpleado);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function listaEstadoPuestoEmpleado($iidPuestoEmpleado) {
        parent::ConnectionOpen("pnsEmpleados", "dbweb");
        parent::SetParameterSP("$1", '09');
        parent::SetParameterSP("$2", $iidPuestoEmpleado);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function grabarDetallePuesto($datos) {
        parent::ConnectionOpen("pnsMantenimientoPuestos", "dbweb");
        parent::SetParameterSP("$1", $datos['p6']); //update
        parent::SetParameterSP("$2", $datos['p2']);  //iidpuesto
        parent::SetParameterSP("$3", $datos['p7']);  //iidCentroCosto
        parent::SetParameterSP("$4", $datos['p3']); //iidCategoria puesto
        parent::SetParameterSP("$5", $datos['p4']); //vnombrePuesto
        parent::SetParameterSP("$6", $datos['p5']); //vEstado
        parent::SetParameterSP("$7", $_SESSION["login_user"]);
        parent::SetParameterSP("$8", $_SESSION['host']);
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//jcqa 12 Abril 2012 4:30pm
//    parametros+='&p2='+txtNombrePuesto;
//    parametros+='&p3='+hIdCentroCosto;
//    parametros+='&p4='+selectCategoriaPuestos;
//    parametros+='&p5='+estadoPuesto;





    function grabarDetallePuestoaCentroCosto($datos) {
        parent::ConnectionOpen("PuestosxCentroDeCostos", "dbweb");
        parent::SetParameterSP("$1", '6');
        parent::SetParameterSP("$2", $datos['p2']);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", $datos['p3']);
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", $datos['p4']);
        parent::SetParameterSP("$8", $_SESSION["login_user"]);
        parent::SetParameterSP("$9", $_SESSION['host']);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//funcion agregada 17 de Mayo 2012 JCQA

    function desactivarPuestoenCentroCostos($datos) {
        parent::ConnectionOpen("PuestosxCentroDeCostos", "dbweb");
        parent::SetParameterSP("$1", '7');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", $datos['p2']);
        parent::SetParameterSP("$5", $datos['p4']);
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", $datos['p5']);
        parent::SetParameterSP("$8", $_SESSION["login_user"]);
        parent::SetParameterSP("$9", $_SESSION['host']);
        parent::SetParameterSP("$10", $datos['p3']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function seleccionarCentroCostoPuesto($id) {
        parent::ConnectionOpen("pnsSeleccionaDatosCentroCostos", "dbweb");
        parent::SetParameterSP("$1", '2');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $id);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function seleccionarCentroCostoPuestoDelArbol($id) {
        parent::ConnectionOpen("PuestosxCentroDeCostos", "dbweb");
        parent::SetParameterSP("$1", '4');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", $id);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function busquedaEmpleadosCentroCostosFiltrado($puesto, $estado) {
        parent::ConnectionOpen("PuestosxCentroDeCostos", "dbweb");
        parent::SetParameterSP("$1", '5');
        parent::SetParameterSP("$2", $puesto);
        parent::SetParameterSP("$3", $estado);
        parent::SetParameterSP("$4", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /*     * **************************************************************************** */
    /*     * ********************** REGISTOR DE NUEVO EMPLEADO ************************** */

    /* ---------------------- OPCIONES DE BUSQEUDA --------------------------------- */

    function getListaEmpleadosXCod($cod) {
        parent::ConnectionOpen("pnsEmpleadoBusqueda", "dbweb");
        parent::SetParameterSP("$1", '01');
        parent::SetParameterSP("$2", $cod);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function getListaEmpleadosXCodAutorizados($cod) {
        parent::ConnectionOpen("pnsEmpleadoBusqueda", "dbweb");
        parent::SetParameterSP("$1", '09');
        parent::SetParameterSP("$2", $cod);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function dBusquedaEmpleadosCentroCostos($idCentroCostos, $estado) {
        parent::ConnectionOpen("pnsEmpleadoBusqueda", "dbweb");
        parent::SetParameterSP("$1", '05');
        parent::SetParameterSP("$2", $idCentroCostos);
        parent::SetParameterSP("$3", $estado);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function dBusquedaEmpleadosArea($idCentroCostos, $estado) {
        parent::ConnectionOpen("pnsEmpleadoBusqueda", "dbweb");
        parent::SetParameterSP("$1", '12');
        parent::SetParameterSP("$2", $idCentroCostos);
        parent::SetParameterSP("$3", $estado);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function ListadoFiltradoAreas($nombre) {

        parent::ConnectionOpen("CoordinadoresTurnos", "dbweb");
        parent::SetParameterSP("accion", '4');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("idSedeEmpresa", $nombre);
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function getListaArea($nombre) {
        parent::ConnectionOpen("CoordinadoresTurnos", "dbweb");
        parent::SetParameterSP("$1", '01');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $nombre);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

/////inicio


    function desactivarCoordinadorAlArea($hiIdEncargadoProgramacionPersonal) {
        parent::ConnectionOpen("CoordinadoresTurnos", "dbweb");
        parent::SetParameterSP("$1", '15');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", $hiIdEncargadoProgramacionPersonal);
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function asignarNuevoCoordinador($datos) {
        parent::ConnectionOpen("CoordinadoresTurnos", "dbweb");
        parent::SetParameterSP("$1", '17');
        parent::SetParameterSP("$2", $datos["fechaIni"]);
        parent::SetParameterSP("$3", $datos["fechaFin"]);
        parent::SetParameterSP("$4", $datos["IdNuevoCoordinadorAsignado"]);
        parent::SetParameterSP("$5", $datos["hidSedeempresaArea"]);
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", $_SESSION["login_user"]);
        parent::SetParameterSP("$11", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function actualizarDescripcionCeseCoordinador($datos) {
        parent::ConnectionOpen("CoordinadoresTurnos", "dbweb");
        parent::SetParameterSP("$1", '16');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $datos["motivoCese"]);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", $datos["hiIdEncargadoProgramacionPersonal"]);
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function buscarCoordinadoresPopap($apPat, $apMat, $nombre) {
        parent::ConnectionOpen("CoordinadoresTurnos", "dbweb");
        parent::SetParameterSP("$1", '10');
        parent::SetParameterSP("$2", $apPat);
        parent::SetParameterSP("$3", $apMat);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getListaEmpleadosXNombre($apPat, $apMat, $nombre, $estado) {
        parent::ConnectionOpen("pnsEmpleadoBusqueda", "dbweb");
        parent::SetParameterSP("$1", '02');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $estado);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", $apPat);
        parent::SetParameterSP("$7", $apMat);
        parent::SetParameterSP("$8", $nombre);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getListaEmpleadosXNombreAutorizados($apPat, $apMat, $nombre, $estado) {
        parent::ConnectionOpen("pnsEmpleadoBusqueda", "dbweb");
        parent::SetParameterSP("$1", '10');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $estado);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", $apPat);
        parent::SetParameterSP("$7", $apMat);
        parent::SetParameterSP("$8", $nombre);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getListaEmpleadosXDoc($tipoDoc, $nDoc) {
        parent::ConnectionOpen("pnsEmpleadoBusqueda", "dbweb");
        parent::SetParameterSP("$1", '03');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", $tipoDoc);
        parent::SetParameterSP("$5", $nDoc);
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getListaEmpleadosXDocAutorizados($tipoDoc, $nDoc) {
        parent::ConnectionOpen("pnsEmpleadoBusqueda", "dbweb");
        parent::SetParameterSP("$1", '11');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", $tipoDoc);
        parent::SetParameterSP("$5", $nDoc);
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getListaEmpleadosXEstado($estado) {
        parent::ConnectionOpen("pnsEmpleadoBusqueda", "dbweb");
        parent::SetParameterSP("$1", '04');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $estado);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getListaEmpleadosXCCosto($cod, $estado) {
        parent::ConnectionOpen("pnsEmpleadoBusqueda", "dbweb");
        parent::SetParameterSP("$1", '05');
        parent::SetParameterSP("$2", $cod);
        parent::SetParameterSP("$3", $estado);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getListaEmpleadosPuesto($idPuesto, $estado) {
        parent::ConnectionOpen("pnsEmpleadoBusqueda", "dbweb");
        parent::SetParameterSP("$1", '07');
        parent::SetParameterSP("$2", $idPuesto);
        parent::SetParameterSP("$3", $estado);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function listapuestosEmpleado($iidEmpleado) {
//echo "---".$iidEmpleado;
        parent::ConnectionOpen("pnsEmpleados", "dbweb");
        parent::SetParameterSP("$1", '06');
        parent::SetParameterSP("$2", $iidEmpleado);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /* ---------------------- CAPTURA EL ID DE EMPLEADO --------------------------------- */

    function getIdEmpleado($cod) {
        parent::ConnectionOpen("pnsEmpleadoBusqueda", "dbweb");
        parent::SetParameterSP("$1", '06');
        parent::SetParameterSP("$2", $cod);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /* ---------------------------------- CARGA COMBOS ----------------------------------- */

//Funciones para llenar los datos de los combos del MODULO RRHH
    public function seleccionarTipoEstudio() {
        parent::ConnectionOpen("pnsEmpleadoLlenarDatos", "dbweb");
        parent::SetParameterSP("$1", '01');
        parent::SetParameterSP("$2", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function seleccionarInstitucion($opc) {
        parent::ConnectionOpen("pnsEmpleadoLlenarDatos", "dbweb");
        parent::SetParameterSP("$1", '02');
        parent::SetParameterSP("$2", $opc);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function seleccionarInstituto() {
        parent::ConnectionOpen("pnsEmpleadoLlenarDatos", "dbweb");
        parent::SetParameterSP("$1", '02');
        parent::SetParameterSP("$2", '02');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function seleccionarProfesion() {
        parent::ConnectionOpen("pnsEmpleadoLlenarDatos", "dbweb");
        parent::SetParameterSP("$1", '03');
        parent::SetParameterSP("$2", '01');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function seleccionarEstadoEstudio() {
        parent::ConnectionOpen("pnsEmpleadoLlenarDatos", "dbweb");
        parent::SetParameterSP("$1", '04');
        parent::SetParameterSP("$2", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function seleccionarTipoNivel() {
        parent::ConnectionOpen("pnsEmpleadoLlenarDatos", "dbweb");
        parent::SetParameterSP("$1", '05');
        parent::SetParameterSP("$2", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function seleccionarEspecialidad($opc) {
        parent::ConnectionOpen("pnsEmpleadoLlenarDatos", "dbweb");
        parent::SetParameterSP("$1", '06');
        parent::SetParameterSP("$2", $opc);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function seleccionarIdioma() {
        parent::ConnectionOpen("pnsEmpleadoLlenarDatos", "dbweb");
        parent::SetParameterSP("$1", '06');
        parent::SetParameterSP("$2", '02');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function seleccionarAprendizaje() {
        parent::ConnectionOpen("pnsEmpleadoLlenarDatos", "dbweb");
        parent::SetParameterSP("$1", '07');
        parent::SetParameterSP("$2", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /* ---------------------- EXPERIENCIA LABORAL --------------------------------- */

    function getExpLaboral($cod) {
        parent::ConnectionOpen("pnsEmpleadoMostrarDetalles", "dbweb");
        parent::SetParameterSP("$1", '02');
        parent::SetParameterSP("$2", $cod);
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getDetalExpLaboral($id) {
        parent::ConnectionOpen("pnsEmpleadoMostrarDetalles", "dbweb");
        parent::SetParameterSP("$1", '02');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $id);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function accionExpLaboral($cat, $opc, $codigo, $id, $desde, $hasta, $instit, $cargo, $func, $tipoestudio, $esp, $estado, $nivel, $tiponivel) {
        parent::ConnectionOpen("pnsEmpleadoAccionesDetalle", "dbweb");
        parent::SetParameterSP("$1", $cat);
        parent::SetParameterSP("$2", $opc);
        parent::SetParameterSP("$3", $codigo);
        parent::SetParameterSP("$4", $id);
        parent::SetParameterSP("$5", $desde);
        parent::SetParameterSP("$6", $hasta);
        parent::SetParameterSP("$7", $instit);
        parent::SetParameterSP("$8", $cargo);
        parent::SetParameterSP("$9", $func);
        parent::SetParameterSP("$10", $tipoestudio);
        parent::SetParameterSP("$11", $esp);
        parent::SetParameterSP("$12", $estado);
        parent::SetParameterSP("$13", $nivel);
        parent::SetParameterSP("$14", $tiponivel);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function accionLegajo($accion, $codigo, $columna, $puesto, $documento, $fecha) {
        parent::ConnectionOpen("pnsEmpleadoAccionesLegajo", "dbweb");
        parent::SetParameterSP("$1", $accion);
        parent::SetParameterSP("$2", $codigo);
        parent::SetParameterSP("$3", $columna);
        parent::SetParameterSP("$4", $puesto);
        parent::SetParameterSP("$5", $documento);
        parent::SetParameterSP("$6", $fecha);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getFechaEntrega($codigo, $documento) {
        parent::ConnectionOpen("pnsEmpleadoAccionesLegajo", "dbweb");
        parent::SetParameterSP("$1", '');
        parent::SetParameterSP("$2", $codigo);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", $documento);
        parent::SetParameterSP("$6", '');

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /* ---------------------- ESTUDIOS SUPERIORES ------------------------------- */

    function getEstSup($cod) {
        parent::ConnectionOpen("pnsEmpleadoMostrarDetalles", "dbweb");
        parent::SetParameterSP("$1", '03');
        parent::SetParameterSP("$2", $cod);
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getDetalEstSup($id) {
        parent::ConnectionOpen("pnsEmpleadoMostrarDetalles", "dbweb");
        parent::SetParameterSP("$1", '03');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $id);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function accionEstSup($codigo, $institucion, $cargo, $desde, $hasta, $funciones, $id, $opc) {
        parent::ConnectionOpen("pnsAccionesDetalleEmpleados", "dbweb");
        parent::SetParameterSP("$1", '03');
        parent::SetParameterSP("$2", $opc);
        parent::SetParameterSP("$3", $codigo);
        parent::SetParameterSP("$4", $institucion);
        parent::SetParameterSP("$5", $cargo);
        parent::SetParameterSP("$6", $funciones);
        parent::SetParameterSP("$7", $desde);
        parent::SetParameterSP("$8", $hasta);
        parent::SetParameterSP("$9", $id);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /* ---------------------- IDIOMAS --------------------------------- */

    function getIdioma($cod) {
        parent::ConnectionOpen("pnsEmpleadoMostrarDetalles", "dbweb");
        parent::SetParameterSP("$1", '04');
        parent::SetParameterSP("$2", $cod);
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getDetalIdioma($id) {
        parent::ConnectionOpen("pnsEmpleadoMostrarDetalles", "dbweb");
        parent::SetParameterSP("$1", '04');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $id);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /* ---------------------- CONOCIMIENTOS ------------------------------- */

    function getConocimientos($cod) {
        parent::ConnectionOpen("pnsEmpleadoMostrarDetalles", "dbweb");
        parent::SetParameterSP("$1", '05');
        parent::SetParameterSP("$2", $cod);
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getDetalConocimientos($id) {
        parent::ConnectionOpen("pnsEmpleadoMostrarDetalles", "dbweb");
        parent::SetParameterSP("$1", '05');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $id);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /* ---------------------- INVESTIGACION ------------------------------- */

    function getInvestigaciones($cod) {
        parent::ConnectionOpen("pnsEmpleadoMostrarDetalles", "dbweb");
        parent::SetParameterSP("$1", '06');
        parent::SetParameterSP("$2", $cod);
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getDetalInvestigaciones($id) {
        parent::ConnectionOpen("pnsEmpleadoMostrarDetalles", "dbweb");
        parent::SetParameterSP("$1", '06');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $id);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /* ---------------------- LOGROS ------------------------------- */

    function getLogros($cod) {
        parent::ConnectionOpen("pnsEmpleadoMostrarDetalles", "dbweb");
        parent::SetParameterSP("$1", '07');
        parent::SetParameterSP("$2", $cod);
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getDetalLogros($id) {
        parent::ConnectionOpen("pnsEmpleadoMostrarDetalles", "dbweb");
        parent::SetParameterSP("$1", '07');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $id);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /* ---------------------- REFERENCIAS ------------------------------- */

    function getReferencias($cod) {
        parent::ConnectionOpen("pnsEmpleadoMostrarDetalles", "dbweb");
        parent::SetParameterSP("$1", '08');
        parent::SetParameterSP("$2", $cod);
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getDetalReferencias($id) {
        parent::ConnectionOpen("pnsEmpleadoMostrarDetalles", "dbweb");
        parent::SetParameterSP("$1", '08');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $id);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /* ---------------------- LEGAJO ------------------------------- */

    function getLegajo($cod) {
        parent::ConnectionOpen("pnsEmpleadoMostrarDetalles", "dbweb");
        parent::SetParameterSP("$1", '09');
        parent::SetParameterSP("$2", $cod);
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getDetalLegajo($id) {
        parent::ConnectionOpen("pnsEmpleadoMostrarDetalles", "dbweb");
        parent::SetParameterSP("$1", '09');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $id);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function vistaLegajoDetalle($idDocumentoEmpleado) {
        parent::ConnectionOpen("pnsEmpleadoMostrarDetalles", "dbweb");
        parent::SetParameterSP("$1", '10');
        parent::SetParameterSP("$2", $idDocumentoEmpleado);
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function agregarDocumentoEmpleado($iCodigoEmpleado, $iIdDocumento) {
        parent::ConnectionOpen("pnsEmpleadoAccionesLegajo", "dbweb");
        parent::SetParameterSP("$1", '4');
        parent::SetParameterSP("$2", $iCodigoEmpleado);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", $iIdDocumento);
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", $_SESSION["login_user"]);
        parent::SetParameterSP("$8", $_SESSION['host']);


        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /* --------------------------- FIN --------------------------------- */
    /* ------------------------------ MANTENIMIENTO PROFESIONES -------------------------------- */

//Mostrar las profesiones por nombre
    function buscarProfesiones($profesion) {
        parent::ConnectionOpen("pnsMantenimientoProfesionEspecialidad", "dbweb");
        parent::SetParameterSP("$1", '01');
        parent::SetParameterSP("$2", $profesion);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//Mostrar las especialidades de la profesion
    function profesionDetalle($profesion) {
        parent::ConnectionOpen("pnsMantenimientoProfesionEspecialidad", "dbweb");
        parent::SetParameterSP("$1", '02');
        parent::SetParameterSP("$2", $profesion);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//Listar los especialidades que corresponden a la profesion seleccionado
    function buscarEspecialidades($profesion) {
        parent::ConnectionOpen("pnsMantenimientoProfesionEspecialidad", "dbweb");
        parent::SetParameterSP("$1", '03');
        parent::SetParameterSP("$2", $profesion);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//Insertar una nueva profesion
    function grabarProfesion($profesion) {
        parent::ConnectionOpen("pnsMantenimientoProfesionEspecialidad", "dbweb");
        parent::SetParameterSP("$1", '04');
        parent::SetParameterSP("$2", $profesion);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//Registar la relacion entre el documento y el atributo
    function grabarEspecialidad($especialidad, $profesion) {
        parent::ConnectionOpen("pnsMantenimientoProfesionEspecialidad", "dbweb");
        parent::SetParameterSP("$1", '05');
        parent::SetParameterSP("$2", $profesion);
        parent::SetParameterSP("$3", $especialidad);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//eliminar la relacion entre el atributo y el documento
    function eliminarEspecialidad($especialidad) {
        parent::ConnectionOpen("pnsMantenimientoProfesionEspecialidad", "dbweb");
        parent::SetParameterSP("$1", '06');
        parent::SetParameterSP("$2", $especialidad);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//Update al nombre de la especialidad
    function editarEspecialidad($especialidad, $descripcion) {
        parent::ConnectionOpen("pnsMantenimientoProfesionEspecialidad", "dbweb");
        parent::SetParameterSP("$1", '08');
        parent::SetParameterSP("$2", $especialidad);
        parent::SetParameterSP("$3", $descripcion);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//Cambiar el nombre de la profesion
    function editarProfesion($profesion, $descripcion) {
        parent::ConnectionOpen("pnsMantenimientoProfesionEspecialidad", "dbweb");
        parent::SetParameterSP("$1", '09');
        parent::SetParameterSP("$2", $profesion);
        parent::SetParameterSP("$3", $descripcion);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//Cambiar el estado a 0 de profesion
    function desactivarProfesion($profesion) {
        parent::ConnectionOpen("pnsMantenimientoProfesionEspecialidad", "dbweb");
        parent::SetParameterSP("$1", '10');
        parent::SetParameterSP("$2", $profesion);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//Cambiar el estado a 1 de profesion
    function activarProfesion($profesion) {
        parent::ConnectionOpen("pnsMantenimientoProfesionEspecialidad", "dbweb");
        parent::SetParameterSP("$1", '11');
        parent::SetParameterSP("$2", $profesion);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /* ------------------------------ FIN MANTENIMIENTO PROFESIONES -------------------------------- */
    /* ------------------------------ MANTENIMIENTO PUESTO DOCUMENTOS -------------------------------- */

//Mostrar los documentos asociados al puesto
    function puestoDocumento($puesto) {
        parent::ConnectionOpen("pnsMantenimientoDocumentoPuesto", "dbweb");
        parent::SetParameterSP("$1", '01');
        parent::SetParameterSP("$2", $puesto);
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//Actualizar el estado de la tabla relacion nsdDocumentoPuestos a 0
    function eliminarDocumentoPto($documentoPto) {
        parent::ConnectionOpen("pnsMantenimientoDocumentoPuesto", "dbweb");
        parent::SetParameterSP("$1", '02');
        parent::SetParameterSP("$2", $documentoPto);
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//Mostrar la lista de documentos que no tienen relación activa con el puesto seleccionado
    function agregarDocumentoPuesto($puesto) {
        parent::ConnectionOpen("pnsMantenimientoDocumentoPuesto", "dbweb");
        parent::SetParameterSP("$1", '03');
        parent::SetParameterSP("$2", $puesto);
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//Activar o crear la relación entre el puesto y el documento
    function grabarDocumentoPto($puesto, $documento) {
        parent::ConnectionOpen("pnsMantenimientoDocumentoPuesto", "dbweb");
        parent::SetParameterSP("$1", '04');
        parent::SetParameterSP("$2", $puesto);
        parent::SetParameterSP("$3", $documento);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /* ------------------------------ FIN MANTENIMIENTO PUESTO DOCUMENTOS ------------------------------ */
    /* ------------------------------ MANTENIMIENTO DOCUMENTOS -------------------------------- */

//Mostrar los documentos por nombre
    function buscarDocumentos($documento) {
        parent::ConnectionOpen("pnsMantenimientoDocumento", "dbweb");
        parent::SetParameterSP("$1", '01');
        parent::SetParameterSP("$2", $documento);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//Mostrar los atributos del documento
    function documentoDetalle($documento) {
        parent::ConnectionOpen("pnsMantenimientoDocumento", "dbweb");
        parent::SetParameterSP("$1", '02');
        parent::SetParameterSP("$2", $documento);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//Listar los atributos que estan asignados al documento seleccionado
    function buscarAtributos($documento) {
        parent::ConnectionOpen("pnsMantenimientoDocumento", "dbweb");
        parent::SetParameterSP("$1", '03');
        parent::SetParameterSP("$2", $documento);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//Insertar un nuevo documento
    function grabarDocumento($documento, $descripcion) {
        parent::ConnectionOpen("pnsMantenimientoDocumento", "dbweb");
        parent::SetParameterSP("$1", '04');
        parent::SetParameterSP("$2", $documento);
        parent::SetParameterSP("$3", $descripcion);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//Listar los atributos que no estan asignados al documento seleccionado
    function buscarAtributo($documento, $atributo) {
        parent::ConnectionOpen("pnsMantenimientoDocumento", "dbweb");
        parent::SetParameterSP("$1", '05');
        parent::SetParameterSP("$2", $documento);
        parent::SetParameterSP("$3", $atributo);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//Registar la relacion entre el documento y el atributo
    function grabarAtributo($atributo, $documento) {
        parent::ConnectionOpen("pnsMantenimientoDocumento", "dbweb");
        parent::SetParameterSP("$1", '06');
        parent::SetParameterSP("$2", $documento);
        parent::SetParameterSP("$3", $atributo);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//eliminar la relacion entre el atributo y el documento
    function eliminarAtributo($atributo, $documento) {
        parent::ConnectionOpen("pnsMantenimientoDocumento", "dbweb");
        parent::SetParameterSP("$1", '07');
        parent::SetParameterSP("$2", $documento);
        parent::SetParameterSP("$3", $atributo);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//Permite cambiar el Nro de Orden de los atributos para ser mostrados
    function ordenarAtributo($documento, $direccion, $orden, $atributo) {
        parent::ConnectionOpen("pnsMantenimientoDocumento", "dbweb");
        parent::SetParameterSP("$1", '08');
        parent::SetParameterSP("$2", $documento);
        parent::SetParameterSP("$3", $direccion);
        parent::SetParameterSP("$4", $orden);
        parent::SetParameterSP("$5", $atributo);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//Cambiar el nombre del documento
    function editarDocumento($documento, $descripcion) {
        parent::ConnectionOpen("pnsMantenimientoDocumento", "dbweb");
        parent::SetParameterSP("$1", '09');
        parent::SetParameterSP("$2", $documento);
        parent::SetParameterSP("$3", $descripcion);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//Cambiar el estado a 0 de documento
    function eliminarDocumento($documento) {
        parent::ConnectionOpen("pnsMantenimientoDocumento", "dbweb");
        parent::SetParameterSP("$1", '10');
        parent::SetParameterSP("$2", $documento);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//Cambiar el estado a 1 de documento
    function activarDocumento($documento) {
        parent::ConnectionOpen("pnsMantenimientoDocumento", "dbweb");
        parent::SetParameterSP("$1", '11');
        parent::SetParameterSP("$2", $documento);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /* ----------------------------- FIN MANTENIMIENTO DOCUMENTOS ------------------------------ */

    function getListaPuestosConcatenado($datos) {
        parent::ConnectionOpen("pnsEmpleados", "dbweb");
        parent::SetParameterSP("$1", '05');
        parent::SetParameterSP("$2", $datos["idCCostos"]);
        parent::SetParameterSP("$3", "");
        parent::SetParameterSP("$4", "");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function detallePuestosEmpleados($id) {
        parent::ConnectionOpen("pnsEmpleados", "dbweb");
        parent::SetParameterSP("$1", '07');
        parent::SetParameterSP("$2", $id);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//    function detalleModalidadContrata($id) {
//        parent::ConnectionOpen("pnsEmpleados", "dbweb");
//        parent::SetParameterSP("$1", '14');
//        parent::SetParameterSP("$2", $id);
//
//        $resultado = parent::executeSPArrayX();
//        return $resultado;
//    }
//    function modificarContrato($datos) {
//        parent::ConnectionOpen("pnsEmpleados", "dbweb");
//        parent::SetParameterSP("$1", '15');
//        parent::SetParameterSP("$2", $datos["p1"]);
//        parent::SetParameterSP("$3", $datos["p2"]);
//        parent::SetParameterSP("$4", $datos["p3"]);
//        parent::SetParameterSP("$5", $_SESSION["login_user"]);
//        parent::SetParameterSP("$6", $_SESSION['host']);
//        parent::SetParameterSP("$7", $datos["p4"]);
//
//        $resultado = parent::executeSPArrayX();
//        return $resultado;
//    }

    function listaTipoSueldo() {
        parent::ConnectionOpen("pnsEmpleados", "dbweb");
        parent::SetParameterSP("$1", '16');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function listaTipoProgramacion() {
        parent::ConnectionOpen("pnsEmpleados", "dbweb");
        parent::SetParameterSP("$1", '19');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function getListasServiciosAsignados($datos) {
        parent::ConnectionOpen("pnsMantAsignacionServicisoxPuestos", "dbweb");
        parent::SetParameterSP("$1", '1');
        parent::SetParameterSP("$2", $datos["idCCostos"]);
        parent::SetParameterSP("$3", $datos["idPuestos"]);
        parent::SetParameterSP("$4", "");
        parent::SetParameterSP("$5", "");
        parent::SetParameterSP("$6", "");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getListasServiciosparaAsignar($datos) {
        parent::ConnectionOpen("pnsMantAsignacionServicisoxPuestos", "dbweb");
        parent::SetParameterSP("$1", '2');
        parent::SetParameterSP("$2", $datos["idCCostos"]);
        parent::SetParameterSP("$3", $datos["idPuesto"]);
        parent::SetParameterSP("$4", "");
        parent::SetParameterSP("$5", "");
        parent::SetParameterSP("$6", "");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function grabarAsignacionServicioaPuesto($datos) {
        parent::ConnectionOpen("pnsMantAsignacionServicisoxPuestos", "dbweb");
        parent::SetParameterSP("$1", '3');
        parent::SetParameterSP("$2", "");
        parent::SetParameterSP("$3", $datos["idPuesto"]);
        parent::SetParameterSP("$4", $datos["idServicio"]);
        parent::SetParameterSP("$5", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("$6", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function activaryDesactivarAsignacionServicioaPuesto($datos) {
        parent::ConnectionOpen("pnsMantAsignacionServicisoxPuestos", "dbweb");
        parent::SetParameterSP("$1", '4');
        parent::SetParameterSP("$2", "");
        parent::SetParameterSP("$3", $datos["idPuesto"]);
        parent::SetParameterSP("$4", $datos["idServicio"]);
        parent::SetParameterSP("$5", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("$6", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function eliminarAsignacionServicioaPuesto($datos) {
        parent::ConnectionOpen("pnsMantAsignacionServicisoxPuestos", "dbweb");
        parent::SetParameterSP("$1", '5');
        parent::SetParameterSP("$2", "");
        parent::SetParameterSP("$3", $datos["idPuesto"]);
        parent::SetParameterSP("$4", $datos["idServicio"]);
        parent::SetParameterSP("$5", "");
        parent::SetParameterSP("$6", "");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function registrarEmpleado($c_cod_per, $bEstado) {
        parent::ConnectionOpen("pnsMantenimientoEmpleados", "dbweb");
        parent::SetParameterSP("$1", '1');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$2", $c_cod_per);
        parent::SetParameterSP("$3", $bEstado);
        parent::SetParameterSP("$4", $_SESSION["login_user"]);
        parent::SetParameterSP("$5", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function cambiarEstadoPuestoEmpleado($dInicio, $dFin, $bEstado, $iIdPuestoEmpleado, $periodoPuestoEmpleado) {
//          echo $dInicio;
//          echo $dFin;
//          echo $iIdPuestoEmpleado;
//          echo $periodoPuestoEmpleado;
        parent::ConnectionOpen("pnsMantenimientoEstadoPeridos", "dbweb");
        parent::SetParameterSP("$1", '1');
        parent::SetParameterSP("$2", $periodoPuestoEmpleado);
        parent::SetParameterSP("$2", $iIdPuestoEmpleado);
        parent::SetParameterSP("$3", $dInicio);
        parent::SetParameterSP("$4", $dFin);
        parent::SetParameterSP("$5", $bEstado);
        parent::SetParameterSP("$6", $_SESSION["login_user"]);
        parent::SetParameterSP("$7", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
        parent::Close();
    }

    function editarPeriodoPuesto($dInicio, $dFin, $bEstado, $iIdPuestoEmpleado, $periodoPuestoEmpleado) {

        parent::ConnectionOpen("pnsMantenimientoEstadoPeridos", "dbweb");
        parent::SetParameterSP("$1", '2');
        parent::SetParameterSP("$2", $periodoPuestoEmpleado);
        parent::SetParameterSP("$2", $iIdPuestoEmpleado);
        parent::SetParameterSP("$3", $dInicio);
        parent::SetParameterSP("$4", $dFin);
        parent::SetParameterSP("$5", $bEstado);
        parent::SetParameterSP("$6", $_SESSION["login_user"]);
        parent::SetParameterSP("$7", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
        parent::Close();
    }

    function ventanaEditarPeriodos($iIdPeriodo) {
        parent::ConnectionOpen("pnsEmpleados", "dbweb");
        parent::SetParameterSP("$1", '10');
        parent::SetParameterSP("$2", $iIdPeriodo);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function asignarPuestoEmpleado($arrayDat) {
        parent::ConnectionOpen("pnsMantenimientoPuestoEmpleado", "dbweb");
        parent::SetParameterSP("$1", '1');
        parent::SetParameterSP("$2", ''); // aun no se le asigna
        parent::SetParameterSP("$3", $arrayDat["codigoEmpleado"]);
        parent::SetParameterSP("$4", $arrayDat["idPuesto"]);
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", $_SESSION["login_user"]);
        parent::SetParameterSP("$7", $_SESSION['host']);
        parent::SetParameterSP("$8", $arrayDat["idcontrato"]);
        parent::SetParameterSP("$9", $arrayDat["idsucursal"]);
        parent::SetParameterSP("$10", $arrayDat["sueldo"]);
        parent::SetParameterSP("$11", $arrayDat["idSedeEmpresaArea"]);
        parent::SetParameterSP("$12", $arrayDat["idTipoSueldo"]);
        parent::SetParameterSP("$13", $arrayDat["txtFechaIni"]);
        parent::SetParameterSP("$14", $arrayDat["txtFechaFin"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function asignarPuestoEmpleadoLocatario($arrayDat) {
        parent::ConnectionOpen("pnsMantenimientoPuestoEmpleado", "dbweb");
        parent::SetParameterSP("$1", '2');
        parent::SetParameterSP("$2", ''); // aun no se le asigna
        parent::SetParameterSP("$3", $arrayDat["codigoEmpleado"]);
        parent::SetParameterSP("$4", $arrayDat["idPuesto"]);
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", $_SESSION["login_user"]);
        parent::SetParameterSP("$7", $_SESSION['host']);
        parent::SetParameterSP("$8", $arrayDat["idcontrato"]);
        parent::SetParameterSP("$9", $arrayDat["idsucursal"]);
        parent::SetParameterSP("$10", $arrayDat["sueldo"]);
        parent::SetParameterSP("$11", $arrayDat["idSedeEmpresaArea"]);
        parent::SetParameterSP("$12", $arrayDat["idTipoSueldo"]);
        parent::SetParameterSP("$13", $arrayDat["txtFechaIni"]);
        parent::SetParameterSP("$14", $arrayDat["txtFechaFin"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function asignarPuestoSedeArea($idSedeEmpresa, $idPuesto) {
        parent::ConnectionOpen("pnsMantenimientoPuestoEmpleado", "dbweb");
        parent::SetParameterSP("$1", '3');
        parent::SetParameterSP("$2", ''); // aun no se le asigna
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", $idPuesto);
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", $_SESSION["login_user"]);
        parent::SetParameterSP("$7", $_SESSION['host']);
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", $idSedeEmpresa);
        parent::SetParameterSP("$12", '');
        parent::SetParameterSP("$13", "");
        parent::SetParameterSP("$14", "");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function mostrarPuestoArea($idPuesto) {
        parent::ConnectionOpen("pnsMantenimientoPuestoEmpleado", "dbweb");
        parent::SetParameterSP("$1", '4');
        parent::SetParameterSP("$2", ''); // aun no se le asigna
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", $idPuesto);
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", '');
        parent::SetParameterSP("$12", '');
        parent::SetParameterSP("$13", "");
        parent::SetParameterSP("$14", "");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function eliminacionFisicaPuestoArea($iidPuestoSedeEmpresa) {
        parent::ConnectionOpen("pnsMantenimientoPuestoEmpleado", "dbweb");
        parent::SetParameterSP("$1", '5');
        parent::SetParameterSP("$2", ''); // aun no se le asigna
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", $iidPuestoSedeEmpresa);
        parent::SetParameterSP("$12", '');
        parent::SetParameterSP("$13", "");
        parent::SetParameterSP("$14", "");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function registrarEmpleadoComoUsuario($codigoEmpleado, $idPuesto) {
        parent::ConnectionOpen("pnsRegistraEmpleadoComoUsuario", "dbweb");
        parent::SetParameterSP("$1", $codigoEmpleado);
        parent::SetParameterSP("$2", $idPuesto);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//FUNCION PARA TRAER LOS DATOS PARA EL ARBOL COMPLETO DE LOS MANUALES

    function getDatosManualesCompleto($cadena) {
        parent::ConnectionOpen("pnsMantenimientoManual", "dbweb");
        parent::SetParameterSP("pOpc", '1');
        parent::SetParameterSP("cadena", $cadena);
        parent::SetParameterSP("idManual", '');
        parent::SetParameterSP("idDependencia", '');
        parent::SetParameterSP("jerarquia", '');
        parent::SetParameterSP("titulo", '');
        parent::SetParameterSP("contenido", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("orden", '');
        parent::SetParameterSP("version", '');
        parent::SetParameterSP("formulario", '');
        parent::SetParameterSP("nivel", '');
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function generaManual($datos) {
        parent::ConnectionOpen("pnsMantenimientoManual", "dbweb");
        parent::SetParameterSP("pOpc", '2');
        parent::SetParameterSP("cadena", '');
        parent::SetParameterSP("idManual", $datos["idManual"]);
        parent::SetParameterSP("idDependencia", '');
        parent::SetParameterSP("jerarquia", '');
        parent::SetParameterSP("titulo", '');
        parent::SetParameterSP("contenido", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("orden", '');
        parent::SetParameterSP("version", '');
        parent::SetParameterSP("formulario", '');
        parent::SetParameterSP("nivel", '');
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function actualizarFechaDocumento($fecha, $idDocumentoEmpleado) {
        parent::ConnectionOpen("pnsMantenimientoLegajo", "dbweb");
        parent::SetParameterSP("$1", '1');
        parent::SetParameterSP("$2", $fecha); // aun no se le asigna
        parent::SetParameterSP("$3", $idDocumentoEmpleado);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", $_SESSION["login_user"]);
        parent::SetParameterSP("$9", $_SESSION['host']);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /*     * ***********para almacenar los datos de los documentos adjuntos *********** */

    function preMostrarCV($idDocEmp) {
        parent::ConnectionOpen("pnsAtributoDocumentoEmpleado", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("idArchDocEmp", '');
        parent::SetParameterSP("idDocEmp", $idDocEmp); // aun no se le asigna
        parent::SetParameterSP("ruta", '');
        parent::SetParameterSP("version", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function recDatosDocumentoEmpleado($idDocEmp) {
        parent::ConnectionOpen("pnsAtributoDocumentoEmpleado", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("idArchDocEmp", '');
        parent::SetParameterSP("idDocEmp", $idDocEmp); // aun no se le asigna
        parent::SetParameterSP("ruta", '');
        parent::SetParameterSP("version", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function guardarAtributoDocumentoEmpledo($iddocEmpleado, $dirCompleto) {
//session_start();
        parent::ConnectionOpen("pnsAtributoDocumentoEmpleado", "dbweb");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("idArchDocEmp", '');
        parent::SetParameterSP("idDocEmp", $iddocEmpleado); // aun no se le asigna
        parent::SetParameterSP("ruta", $dirCompleto);
        parent::SetParameterSP("version", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("usuario", $_SESSION['login_user']);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

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
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function seleccionarFormulario() {
        parent::ConnectionOpen("pnsMantenimientoManual", "dbweb");
        parent::SetParameterSP("pOpc", '3');
        parent::SetParameterSP("cadena", '');
        parent::SetParameterSP("idManual", '');
        parent::SetParameterSP("idDependencia", '');
        parent::SetParameterSP("jerarquia", '');
        parent::SetParameterSP("titulo", '');
        parent::SetParameterSP("contenido", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("orden", '');
        parent::SetParameterSP("version", '');
        parent::SetParameterSP("formulario", '');
        parent::SetParameterSP("nivel", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function registrarManual($datos) {
        parent::ConnectionOpen("pnsMantenimientoManual", "dbweb");
        parent::SetParameterSP("pOpc", '4');
        parent::SetParameterSP("cadena", $datos["p12"]);
        parent::SetParameterSP("idManual", $datos["p2"]);
        parent::SetParameterSP("idDependencia", $datos["p3"]);
        parent::SetParameterSP("jerarquia", $datos["p4"]);
        parent::SetParameterSP("titulo", $datos["p5"]);
        parent::SetParameterSP("contenido", $datos["p6"]);
        parent::SetParameterSP("estado", $datos["p7"]);
        parent::SetParameterSP("orden", $datos["p8"]);
        parent::SetParameterSP("version", $datos["p9"]);
        parent::SetParameterSP("formulario", $datos["p10"]);
        parent::SetParameterSP("nivel", $datos["p11"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function verItemManual($cod) {
        parent::ConnectionOpen("pnsMantenimientoManual", "dbweb");
        parent::SetParameterSP("pOpc", '5');
        parent::SetParameterSP("cadena", '');
        parent::SetParameterSP("idManual", $cod);
        parent::SetParameterSP("idDependencia", '');
        parent::SetParameterSP("jerarquia", '');
        parent::SetParameterSP("titulo", '');
        parent::SetParameterSP("contenido", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("orden", '');
        parent::SetParameterSP("version", '');
        parent::SetParameterSP("formulario", '');
        parent::SetParameterSP("nivel", '');
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function eliminaManual($cod) {
        parent::ConnectionOpen("pnsMantenimientoManual", "dbweb");
        parent::SetParameterSP("pOpc", '6');
        parent::SetParameterSP("cadena", '');
        parent::SetParameterSP("idManual", $cod);
        parent::SetParameterSP("idDependencia", '');
        parent::SetParameterSP("jerarquia", '');
        parent::SetParameterSP("titulo", '');
        parent::SetParameterSP("contenido", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("orden", '');
        parent::SetParameterSP("version", '');
        parent::SetParameterSP("formulario", '');
        parent::SetParameterSP("nivel", '');
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function traerDatosPadre($cod) {
        parent::ConnectionOpen("pnsMantenimientoManual", "dbweb");
        parent::SetParameterSP("pOpc", '7');
        parent::SetParameterSP("cadena", '');
        parent::SetParameterSP("idManual", $cod);
        parent::SetParameterSP("idDependencia", '');
        parent::SetParameterSP("jerarquia", '');
        parent::SetParameterSP("titulo", '');
        parent::SetParameterSP("contenido", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("orden", '');
        parent::SetParameterSP("version", '');
        parent::SetParameterSP("formulario", '');
        parent::SetParameterSP("nivel", '');
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function mantemientoAtributosDocumentoEmpleados($valor, $tipo, $idAtributoDocumentoEmpleado, $atributoDocumento, $idDocumentoEmpleado) {
        parent::ConnectionOpen("pnsMantenimientoLegajo", "dbweb");
        parent::SetParameterSP("$1", '2');
        parent::SetParameterSP("$2", ''); // aun no se le asigna
        parent::SetParameterSP("$3", $idDocumentoEmpleado);
        parent::SetParameterSP("$4", $valor);
        parent::SetParameterSP("$5", $idAtributoDocumentoEmpleado);
        parent::SetParameterSP("$6", $tipo);
        parent::SetParameterSP("$7", $atributoDocumento);
        parent::SetParameterSP("$8", $_SESSION["login_user"]);
        parent::SetParameterSP("$9", $_SESSION['host']);
//        parent::SetParameterSP("txtCede", '');
//        parent::SetParameterSP("idSedeEmpresaAreaCentroCosto", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function generaArbolServicios() {
        parent::ConnectionOpen("pnsGeneraArbolServicios", "dbweb");
        parent::SetParameterSP("$1", '1');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function arbolCentroCosto() {
        parent::ConnectionOpen("pnsGeneraArbolServicios", "dbweb");
        parent::SetParameterSP("$1", '2');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function tablaAreaCCosto($idCCosto) {
        parent::ConnectionOpen("pnsMantenimientoAreaCCosto", "dbweb");
        parent::SetParameterSP("opt", '1');
        parent::SetParameterSP("idccosto", $idCCosto);
        parent::SetParameterSP("descripcion", '');
        parent::SetParameterSP("abrevia", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("idarea", '');
        parent::SetParameterSP("cod_empresa", '');
        parent::SetParameterSP("nom_area", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("txtCede", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function grabarAreaCCosto($datos) {
        parent::ConnectionOpen("pnsMantenimientoAreaCCosto", "dbweb");
        parent::SetParameterSP("opt", '2');
        parent::SetParameterSP("idccosto", $datos['p1']);
        parent::SetParameterSP("descripcion", '');
        parent::SetParameterSP("abrevia", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("idarea", '');
        parent::SetParameterSP("cod_empresa", '');
        parent::SetParameterSP("nom_area", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("txtCede", '');
        parent::SetParameterSP("idSedeEmpresaArea", $datos['p2']);
        parent::SetParameterSP("idSedeEmpresa", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

//2012/02/22 Jose 08:58am
//    function grabarArea($datos) {
//        parent::ConnectionOpen("pnsMantenimientoAreaCCosto", "dbweb");
//        parent::SetParameterSP("opt", '3');
//        parent::SetParameterSP("idccosto", '');
//        parent::SetParameterSP("descripcion", $datos["descripcion"]);
//        parent::SetParameterSP("abrevia", $datos["abrevia"]);
//        parent::SetParameterSP("estado", $datos["estado"]);
//        parent::SetParameterSP("idarea", '');
//        parent::SetParameterSP("cod_empresa", '');
//        parent::SetParameterSP("nom_area", '');
//        parent::SetParameterSP("user", $_SESSION["login_user"]);
//        parent::SetParameterSP("host", $_SESSION['host']);
//        parent::SetParameterSP("txtCede", '');
//        parent::SetParameterSP("idSedeEmpresaArea", '');
//        parent::SetParameterSP("idSedeEmpresa", '');
//        $resultadoArray = parent::executeSPArrayX();
//        parent::ConnectionClose();
//        return $resultadoArray;
//    }

    public function grabarArea($datos) {
        parent::ConnectionOpen("pnsMantenimientoArea", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idDependencia", $datos["idArea"]);
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("descripcionArea", $datos["descripcion"]);
        parent::SetParameterSP("abreviaturaArea", $datos["abrevia"]);
        parent::SetParameterSP("nivelArea", '1');
        parent::SetParameterSP("estadoArea", $datos["estado"]);
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

//**************************************************************
//2012/02/22 Jose 9:26Am
//    
//    function modificarArea($datos) {
//        parent::ConnectionOpen("pnsMantenimientoAreaCCosto", "dbweb");
//        parent::SetParameterSP("opt", '4');
//        parent::SetParameterSP("idccosto", '');
//        parent::SetParameterSP("descripcion", $datos["descripcion"]);
//        parent::SetParameterSP("abrevia", $datos["abrevia"]);
//        parent::SetParameterSP("estado", $datos["estado"]);
//        parent::SetParameterSP("idarea", $datos["idArea"]);
//        parent::SetParameterSP("cod_empresa", '');
//        parent::SetParameterSP("nom_area", '');
//        parent::SetParameterSP("user", $_SESSION["login_user"]);
//        parent::SetParameterSP("host", $_SESSION['host']);
//        parent::SetParameterSP("txtCede", '');
//        parent::SetParameterSP("idSedeEmpresaArea", '');
//        parent::SetParameterSP("idSedeEmpresa", '');
//        $resultadoArray = parent::executeSPArrayX();
//        parent::ConnectionClose();
//        return $resultadoArray;
//    }
    function modificarArea($datos) {
        parent::ConnectionOpen("pnsMantenimientoArea", "dbweb");
        parent::SetParameterSP("accion", '4');
        parent::SetParameterSP("idArea", $datos["idArea"]);
        parent::SetParameterSP("idDependencia", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("descripcionArea", $datos["descripcion"]);
        parent::SetParameterSP("abreviaturaArea", $datos["abrevia"]);
        parent::SetParameterSP("nivelArea", '');
        parent::SetParameterSP("estadoArea", $datos["estado"]);
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
//        $resultado = parent::executeSPArrayX();
//        parent::Close();
//        return $resultado;
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

//************************************************************************    
//Jose 2012/02/20
    function modificarSubArea($datos) {
        parent::ConnectionOpen("pnsMantenimientoArea", "dbweb");
        parent::SetParameterSP("accion", '4');
        parent::SetParameterSP("idArea", $datos["idSubArea"]);
        parent::SetParameterSP("idDependencia", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("descripcionArea", $datos["descripcion"]);
        parent::SetParameterSP("abreviaturaArea", $datos["abrevia"]);
        parent::SetParameterSP("nivelArea", '');
        parent::SetParameterSP("estadoArea", $datos["estado"]);
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

//***************************************
//    function buscarArea($nomArea) {
//        parent::ConnectionOpen("pnsMantenimientoAreaCCosto", "dbweb");
//        parent::SetParameterSP("opt", '5');
//        parent::SetParameterSP("idCCosto", '');
//        parent::SetParameterSP("descripcion", '');
//        parent::SetParameterSP("abrevia", '');
//        parent::SetParameterSP("estado", '');
//        parent::SetParameterSP("idarea", '');
//        parent::SetParameterSP("cod_empresa", '');
//        parent::SetParameterSP("nom_area", $nomArea);
//        parent::SetParameterSP("user", '');
//        parent::SetParameterSP("host", '');
//        parent::SetParameterSP("txtCede", '');
//        parent::SetParameterSP("idSedeEmpresaArea", '');
//        parent::SetParameterSP("idSedeEmpresa", '');
//        $resultadoArray = parent::executeSPArrayX();
//        parent::ConnectionClose();
//        return $resultadoArray;
//    }
//jose 2011/02/21 8pm

    function buscarArea($nomArea) {
        parent::ConnectionOpen("pnsMantenimientoArea", "dbweb");
        parent::SetParameterSP("accion", '6');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idDependencia", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("descripcionArea", $nomArea);
        parent::SetParameterSP("abreviaturaArea", '');
        parent::SetParameterSP("nivelArea", '');
        parent::SetParameterSP("estadoArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

// parent::ConnectionOpen("pnsMantenimientoArea", "dbweb");
//        parent::SetParameterSP("accion", '1');
//        parent::SetParameterSP("idArea",$idArea );
//        parent::SetParameterSP("idDependencia",'');
//        parent::SetParameterSP("idSedeEmpresaArea", $idSedeArea);
//        parent::SetParameterSP("descripcionArea", '');
//        parent::SetParameterSP("abreviaturaArea", '');
//        parent::SetParameterSP("nivelArea", '');
//         parent::SetParameterSP("estadoArea", '');
//        parent::SetParameterSP("user", '');
//        parent::SetParameterSP("host", '');
//EXEC	dbweb.pnsMantenimientoArea '3','8','','', 'CIRUGIA', '', '','','',''
//Jose 2012/02/17 10:34am
    function buscarSubArea($idArea, $nomArea) {
        parent::ConnectionOpen("pnsMantenimientoArea", "dbweb");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("idArea", $idArea);
        parent::SetParameterSP("idDependencia", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("descripcionArea", $nomArea);
        parent::SetParameterSP("abreviaturaArea", '');
        parent::SetParameterSP("nivelArea", '');
        parent::SetParameterSP("estadoArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
//        $resultado = parent::executeSPArrayX();
//        parent::Close();
//        return $resultado;
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function grabarSedeEmpresaArea($datos) {
        parent::ConnectionOpen("pnsMantenimientoAreaCCosto", "dbweb");
        parent::SetParameterSP("opt", '6');
        parent::SetParameterSP("idccosto", '');
        parent::SetParameterSP("descripcion", '');
        parent::SetParameterSP("abrevia", '');
        parent::SetParameterSP("estadoArea", '');
        parent::SetParameterSP("idarea", $datos["idArea"]);
        parent::SetParameterSP("cod_empresa", $datos["idSede"]);
        parent::SetParameterSP("nom_area", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("estado", $datos['estadoEmpresaArea']); //////////////////////////////
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function listaSedeAreaCentroCosto($idSedeArea) {
        parent::ConnectionOpen("pnsMantenimientoAreaCCosto", "dbweb");
        parent::SetParameterSP("opt", '7');
        parent::SetParameterSP("idccosto", '');
        parent::SetParameterSP("descripcion", '');
        parent::SetParameterSP("abrevia", '');
        parent::SetParameterSP("estadoArea", '');
        parent::SetParameterSP("idarea", '');
        parent::SetParameterSP("cod_empresa", '');
        parent::SetParameterSP("nom_area", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("idSedeEmpresaArea", $idSedeArea);
        parent::SetParameterSP("idSedeEmpresa", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function eliminacionFisicaSedeAreaCentroCosto($idSEACC) {
        parent::ConnectionOpen("pnsMantenimientoAreaCCosto", "dbweb");
        parent::SetParameterSP("opt", '9');
        parent::SetParameterSP("idccosto", $idSEACC);
        parent::SetParameterSP("descripcion", '');
        parent::SetParameterSP("abrevia", '');
        parent::SetParameterSP("estadoArea", '');
        parent::SetParameterSP("idarea", '');
        parent::SetParameterSP("cod_empresa", '');
        parent::SetParameterSP("nom_area", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function listaModalidadContrato() {
        parent::ConnectionOpen("pnsEmpleados", "dbweb");
        parent::SetParameterSP("$1", '11');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function listaTablaArea($idSucursal) {
        parent::ConnectionOpen("pnsEmpleados", "dbweb");
        parent::SetParameterSP("$1", '12');
        parent::SetParameterSP("$2", $idSucursal);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function AsignarEmpleadoArea($datos) {
        parent::ConnectionOpen("pnsEmpleados", "dbweb");
        parent::SetParameterSP("$1", '15');
        parent::SetParameterSP("$2", $datos["hidIdArea"]);
        parent::SetParameterSP("$3", $datos["cboSucursal"]);
        parent::SetParameterSP("$4", $datos["hidIdPersona"]);
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//    jose

    function replicarPreProgramación($datos) {

        parent::ConnectionOpen("AsignacionPersonalArea", "dbweb");
        parent::SetParameterSP("accion", '11');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idArea", $_SESSION['iCodigoEmpleado']);
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);

        parent::SetParameterSP("@p12", $datos["hidEmpresaSedearea"]);
        parent::SetParameterSP("@p13", $datos["mesInicial"]);
        parent::SetParameterSP("@p14", $datos["anioInicial"]);
        parent::SetParameterSP("@p15", $datos["mes"]);
        parent::SetParameterSP("@p16", $datos["anio"]);

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function asignarsolofechasCoordinador($datos) {

        parent::ConnectionOpen("CoordinadoresTurnos", "dbweb");
        parent::SetParameterSP("accion", '14');
        parent::SetParameterSP("iCodigoEmpleado", $datos["fechaIni"]);
        parent::SetParameterSP("idSedeEmpresa", $datos["fechaFin"]);
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", $datos["hiIdEncargadoProgramacionPersonal"]);
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//                ***********************************************************************************************************************************
//                ************************************Creado por Jose Quispe Araoz 29 Marzo 12 desactivar a un Coordinador Asignado*****************
//                ***********************************************************************************************************************************    



    function DesactivarCoordinadorDeArea($datos) {

        parent::ConnectionOpen("CoordinadoresTurnos", "dbweb");
        parent::SetParameterSP("accion", '19');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", $datos["hiIdEncargadoProgramacionPersonal"]);
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function asignarNuevoCoordinadorAlArea($datos) {

        parent::ConnectionOpen("CoordinadoresTurnos", "dbweb");
        parent::SetParameterSP("accion", '18');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idArea", $datos["IdCoordinadorAsignado"]);
        parent::SetParameterSP("idSedeEmpresaArea", $datos["idSedeempresaArea"]);
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function editarEncargadoArea($datos) {
        parent::ConnectionOpen("pnsEmpleados", "dbweb");
        parent::SetParameterSP("$1", '14');
        parent::SetParameterSP("$2", $datos["hidIdArea"]);
        parent::SetParameterSP("$3", $datos["cboSucursal"]);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function listPuestosxCategoria($datos) {
        parent::ConnectionOpen("pnsEmpleados", "dbweb");
        parent::SetParameterSP("$1", '13');
        parent::SetParameterSP("$2", $datos['p1']);
        parent::SetParameterSP("$3", $datos['idSedeEmpresaArea']);
        parent::SetParameterSP("$4", $datos["cboSucursal"]);
        parent::SetParameterSP("$5", $datos["idArea"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function grabarModalidadContrato($datos) {
        parent::ConnectionOpen("pnsMantenimientoPuestos", "dbweb");
        parent::SetParameterSP("opt", '3');
        parent::SetParameterSP("modocontrato", $datos["modocontrato"]);
        parent::SetParameterSP("sueldo", $datos["sueldo"]);
        parent::SetParameterSP("fechaini", $datos["fechaini"]);
        parent::SetParameterSP("fechafin", $datos["fechafin"]);
        parent::SetParameterSP("idEmpleado", $datos["idempleado"]);
        parent::SetParameterSP("$7", $_SESSION["login_user"]);
        parent::SetParameterSP("$8", $_SESSION['host']);
        parent::SetParameterSP("idempmodcon", $datos["idempmodcon"]);
        parent::SetParameterSP("hacer", $datos["hacer"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function empleadoXarea($idSedeEmpresaArea, $fecha, $cboTipoContrato, $idSubArea) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '1');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("dFechaProgramacion", $fecha);
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", $idSedeEmpresaArea);
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", $idSubArea);
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", $cboTipoContrato);
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function listTablaTurnoxArea($idSedeEmpresa) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '2');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("dFechaProgramacion", '');
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", $idSedeEmpresa);
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", '');
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//    function listAreaSucursal($idSucursal, $tipoContrato) {
//        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
//        parent::SetParameterSP("opt", '3');
//        parent::SetParameterSP("iIdProgramacionPersonal", '');
//        parent::SetParameterSP("iCodigoEmpleado", '');
//        parent::SetParameterSP("dFechaProgramacion", '');
//        parent::SetParameterSP("bEstadoHabilitado", '');
//        parent::SetParameterSP("dFechaLimite", '');
//        parent::SetParameterSP("idArea", '');
//        parent::SetParameterSP("idSedeEmpresa", $idSucursal);
//        parent::SetParameterSP("cCodigoTurno", '');
//        parent::SetParameterSP("iIdSedeEmpresaArea", '');
//        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
//        parent::SetParameterSP("user", '');
//        parent::SetParameterSP("host", '');
//        parent::SetParameterSP("hacer", '');
//        parent::SetParameterSP("horas", '');
//        parent::SetParameterSP("param1", $tipoContrato);
//        parent::SetParameterSP("mes", '');
//        parent::SetParameterSP("anio", '');
//        $resultado = parent::executeSPArrayX();
//        parent::Close();
//        return $resultado;
//    }


    function listAreaSucursal($idSucursal) {
        parent::ConnectionOpen("pnsMantenimientoArea", "dbweb");
        parent::SetParameterSP("accion", '5');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idDependencia", '');
        parent::SetParameterSP("idSedeEmpresa", $idSucursal);
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("descripcionArea", '');
        parent::SetParameterSP("abreviaturaArea", '');
        parent::SetParameterSP("nivelArea", '');
        parent::SetParameterSP("estadoArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//        function asignarSedeArea($datos) {
//        parent::ConnectionOpen("pnsMantenimientoAreaCCosto", "dbweb");
//        parent::SetParameterSP("opt", '8');
//        parent::SetParameterSP("idccosto", '');
//        parent::SetParameterSP("descripcion", '');
//        parent::SetParameterSP("abrevia", '');
//        parent::SetParameterSP("estadoArea", '');
//        parent::SetParameterSP("idarea", $datos["p1"]);
//        parent::SetParameterSP("cod_empresa", '');
//        parent::SetParameterSP("nom_area", '');
//        parent::SetParameterSP("user", $_SESSION["login_user"]);
//        parent::SetParameterSP("host", $_SESSION['host']);
//        parent::SetParameterSP("estado", ''); //////////////////////////////
//        parent::SetParameterSP("idSedeEmpresaArea", '');
//        parent::SetParameterSP("idSedeEmpresa", $datos["p2"]);
//        $resultadoArray = parent::executeSPArrayX();
//        parent::ConnectionClose();
//        return $resultadoArray;
//    }
    function asignarSedeArea($datos) {
        parent::ConnectionOpen("pnsMantenimientoArea", "dbweb");
        parent::SetParameterSP("accion", '7');
        parent::SetParameterSP("idArea", $datos["idArea"]);
        parent::SetParameterSP("idDependencia", '');
        parent::SetParameterSP("idSedeEmpresa", $datos["idSedeEmpresa"]);
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("descripcionArea", '');
        parent::SetParameterSP("abreviaturaArea", '');
        parent::SetParameterSP("nivelArea", '');
        parent::SetParameterSP("estadoArea", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//@accion char(2),
//@idArea int, 
//@idDependencia int,
//@idSedeEmpresa int,
//@idSedeEmpresaArea int,
//@descripcionArea varchar(250),
//@abreviaturaArea varchar(150),
//@nivelArea int,
//@estadoArea int,
//@user varchar(25),
//@host varchar(25)
//    
//Jose 2012/02/16 9:44am
    function listSubAreaXAreaXSede($idArea, $idSedeArea) {
        parent::ConnectionOpen("pnsMantenimientoArea", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("idArea", $idArea);
        parent::SetParameterSP("idDependencia", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idSedeEmpresaArea", $idSedeArea);
        parent::SetParameterSP("descripcionArea", '');
        parent::SetParameterSP("abreviaturaArea", '');
        parent::SetParameterSP("nivelArea", '');
        parent::SetParameterSP("estadoArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//

    function desactivarTSEA($idTSEA) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '4');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("dFechaProgramacion", '');
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", '');
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", $idTSEA);
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function listTurnoArea() {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '5');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("dFechaProgramacion", '');
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", '');
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function cargarSubArea($idSedeEmpresaArea) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '6');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("dFechaProgramacion", '');
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", $idSedeEmpresaArea);
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function turnoSedeEmpresaArea($datos) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '7');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("dFechaProgramacion", '');
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", $datos["p2"]);
        parent::SetParameterSP("iIdSedeEmpresaArea", $datos["p1"]);
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function empresaSucursal() {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '8');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("dFechaProgramacion", '');
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", '');
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function grabarPersonaEncargada($datos) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '9');
        parent::SetParameterSP("iIdProgramacionPersonal", $datos["idProgPer"]);
        parent::SetParameterSP("iCodigoEmpleado", $datos["idEmpleado"]);
        parent::SetParameterSP("dFechaIni", $datos["fechIni"]);
        parent::SetParameterSP("bEstado", $datos["estado"]);
        parent::SetParameterSP("dFechaFin", $datos["fechFin"]);
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", '');
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("hacer", $datos['hacer']);
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function editarEmpleadoCargo($idEmpleado) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '10');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", $idEmpleado);
        parent::SetParameterSP("dFechaIni", '');
        parent::SetParameterSP("bEstado", '');
        parent::SetParameterSP("dFechaFin", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", '');
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function cboTurnoEmpresaSedeArea($datos) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '11');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("dFechaProgramacion", '');
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", $datos['idSedeEmpresaArea']);
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//    function tablaEncargadosxArea($idSedeEmpresaArea, $idCategoriaPuesto) {
//        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
//        parent::SetParameterSP("opt", '12');
//        parent::SetParameterSP("iIdProgramacionPersonal", '');
//        parent::SetParameterSP("iCodigoEmpleado", '');
//        parent::SetParameterSP("dFechaProgramacion", '');
//        parent::SetParameterSP("bEstadoHabilitado", '');
//        parent::SetParameterSP("dFechaLimite", '');
//        parent::SetParameterSP("idArea", '');
//        parent::SetParameterSP("idSedeEmpresa", '');
//        parent::SetParameterSP("cCodigoTurno", '');
//        parent::SetParameterSP("iIdSedeEmpresaArea", $idSedeEmpresaArea);
//        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
//        parent::SetParameterSP("user", '');
//        parent::SetParameterSP("host", '');
//        parent::SetParameterSP("hacer", '');
//        parent::SetParameterSP("horas", '');
//        parent::SetParameterSP("param1", $idCategoriaPuesto);
//        $resultado = parent::executeSPArrayX();
//        parent::Close();
//        return $resultado;
//    }

    function getDatosEncargado($idSedeEmpresaArea) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '13');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("dFechaProgramacion", '');
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", $idSedeEmpresaArea);
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function grabarHorariosProgramados($idProgramacionPersonal, $idEmpleado, $iIdSedeEmpresaAreaCentroCosto, $idTSEA, $horasTurno, $fechaProgEmp, $accion, $numprog, $idSubArea) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '14');
        parent::SetParameterSP("iIdProgramacionPersonal", $idProgramacionPersonal);
        parent::SetParameterSP("iCodigoEmpleado", $idEmpleado);
        parent::SetParameterSP("dFechaProgramacion", $fechaProgEmp); //$fechaProgEmp -> es la fecha o dia en la que es programado un empleado
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", $idSubArea);
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", $iIdSedeEmpresaAreaCentroCosto); //obs es iIdSedeEmpresaAreaCentroCosto
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", $idTSEA);
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("hacer", $accion);
        parent::SetParameterSP("horas", $horasTurno); //cantidad de horas turno
        parent::SetParameterSP("param1", $numprog);
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function listaTurnoProgramado($idEmpleadoProgramado, $iIdProgramacionpersonal, $mes, $anio, $accion, $var, $idSEACC, $cboTipoContrato) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '15');
        parent::SetParameterSP("iIdProgramacionPersonal", $iIdProgramacionpersonal);
        parent::SetParameterSP("iCodigoEmpleado", $idEmpleadoProgramado);
        parent::SetParameterSP("dFechaProgramacion", $mes);
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", $anio);
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", '');
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", $cboTipoContrato);
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", $accion);
        parent::SetParameterSP("horas", $var);
        parent::SetParameterSP("param1", $idSEACC);
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function modificarHorariosProgramados($idDPP, $idTSEA, $horasTurno, $accion, $numprog, $idSubArea, $idEmpleado) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '16');
        parent::SetParameterSP("iIdProgramacionPersonal", $idDPP); //ahora va el idDetalleProgramacionPersonal
        parent::SetParameterSP("iCodigoEmpleado", $idEmpleado);
        parent::SetParameterSP("dFechaProgramacion", ''); //$fechaProgEmp -> es la fecha o dia en la que es programado un empleado
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", $idSubArea);
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", '');
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", $idTSEA);
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("hacer", $accion);
        parent::SetParameterSP("horas", $horasTurno); //cantidad de horas turno
        parent::SetParameterSP("param1", $numprog);
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function agregarTurnoAdicional($datos) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '17');
        parent::SetParameterSP("iIdProgramacionPersonal", $datos["p1"]);
        parent::SetParameterSP("iCodigoEmpleado", $datos["p2"]);
        parent::SetParameterSP("dFechaProgramacion", $datos["p4"]);
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", $datos["p5"]);
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", $datos["p3"]);
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", ''); //cantidad de horas turno
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function adicionarHorariosProgramados($idProgramacionPersonal, $idEmpleado, $iIdSedeEmpresaAreaCentroCosto, $idTSEA, $horasTurno, $fechaProgEmp, $hacer, $idSubArea) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '18');
        parent::SetParameterSP("iIdProgramacionPersonal", $idProgramacionPersonal);
        parent::SetParameterSP("iCodigoEmpleado", $idEmpleado);
        parent::SetParameterSP("dFechaProgramacion", $fechaProgEmp); //$fechaProgEmp -> es la fecha o dia en la que es programado un empleado
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", $idSubArea);
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", $iIdSedeEmpresaAreaCentroCosto); //obs es iIdSedeEmpresaAreaCentroCosto
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", $idTSEA);
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("hacer", $hacer);
        parent::SetParameterSP("horas", $horasTurno); //cantidad de horas turno
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function listTurnoProgramar() {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '19');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("dFechaProgramacion", '');
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", '');
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function listaTurnosMaestros() {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '20');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("dFechaProgramacion", '');
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", '');
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//    function horarioProgramadoPorPersona($datos) {
//        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
//        parent::SetParameterSP("opt", '21');
//        parent::SetParameterSP("iIdProgramacionPersonal", $datos["iIdProgramacionpersonal"]);
//        parent::SetParameterSP("iCodigoEmpleado", $datos["idEmpleado"]);
//        parent::SetParameterSP("dFechaProgramacion", $datos["mes"]);
//        parent::SetParameterSP("bEstadoHabilitado", '');
//        parent::SetParameterSP("dFechaLimite", $datos["anio"]);
//        parent::SetParameterSP("idArea", '');
//        parent::SetParameterSP("idSedeEmpresa", '');
//        parent::SetParameterSP("cCodigoTurno", '');
//        parent::SetParameterSP("iIdSedeEmpresaArea", $datos["idSedeEmpresaArea"]);
//        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
//        parent::SetParameterSP("user", '');
//        parent::SetParameterSP("host", '');
//        parent::SetParameterSP("hacer", '');
//        parent::SetParameterSP("horas", '');
//        parent::SetParameterSP("param1", $datos["iIdSEACC"]);
//        $resultado = parent::executeSPArrayX();
//        parent::Close();
//        return $resultado;
//    }

    function encargadosXArea($idSedeEmpresaArea) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '22');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("dFechaProgramacion", '');
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", $idSedeEmpresaArea);
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function grabarTurnoProgramar($datos) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '23');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("dFechaProgramacion", '');
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", '');
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("hacer", $datos["idTurno"]);
        parent::SetParameterSP("horas", $datos["idTurnoProgramar"]);
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//spListaCategoria
//
//    function spListaCategoria2($datos) {
//        parent::ConnectionOpen("pnsListaCategoria", "dbweb");
//        parent::SetParameterSP("opt", '1');
//        parent::SetParameterSP("@cIdSedeEmpresaArea", $datos);
//        parent::SetParameterSP("@iIdCategoria", '');
//        parent::SetParameterSP("@dFechaIni", '');
//        parent::SetParameterSP("@dFechaFin", '');
//        parent::SetParameterSP("@iIdModalidadContrato", '');
//        parent::SetParameterSP("@cboTipoSueldo", '');
//        parent::SetParameterSP("@idArea", '');
//        $resultado = parent::executeSPArrayX();
//        parent::Close();
//        return $resultado;
//    }

    function spListaCategoria($datos) {
        parent::ConnectionOpen("pnsListaCategoria", "dbweb");
        parent::SetParameterSP("opt", '3');
        parent::SetParameterSP("@cIdSedeEmpresaArea", $datos);
        parent::SetParameterSP("@iIdCategoria", '');
        parent::SetParameterSP("@dFechaIni", '');
        parent::SetParameterSP("@dFechaFin", '');
        parent::SetParameterSP("@iIdModalidadContrato", '');
        parent::SetParameterSP("@cboTipoSueldo", '');
        parent::SetParameterSP("@idArea", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function PresentarHorarioEmpleadoTrabjados($datos) {
        parent::ConnectionOpen("pnsListaCategoria", "dbweb");
        parent::SetParameterSP("opt", '2');
        parent::SetParameterSP("@cIdSedeEmpresa", $datos["p5"]);
        parent::SetParameterSP("@iIdCategoria", $datos["p1"]);
        parent::SetParameterSP("@dFechaIni", $datos["p2"]);
        parent::SetParameterSP("@dFechaFin", $datos["p3"]);
        parent::SetParameterSP("@cboTipoContrato", $datos["p4"]);
        parent::SetParameterSP("@cboTipoSueldo", $datos["p6"]);
        parent::SetParameterSP("@iIdArea", $datos["p7"]);
        $resultado = parent::ExecuteSPArrayX();

        parent::Close();
        return $resultado;
    }

    function spListaCategoria2($idSucursal, $idArea) {
        parent::ConnectionOpen("pnsListaCategoria", "dbweb");
        parent::SetParameterSP("opt", '4');
        parent::SetParameterSP("@cIdSedeEmpresaArea", $idSucursal); //id sucursal
        parent::SetParameterSP("@iIdCategoria", ''); //id del  area
        parent::SetParameterSP("@dFechaIni", '');
        parent::SetParameterSP("@dFechaFin", '');
        parent::SetParameterSP("@iIdModalidadContrato", '');
        parent::SetParameterSP("@cboTipoSueldo", '');
        parent::SetParameterSP("@idArea", $idArea);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//ExportarExcel
    function ExportarExcel($datos) {
        parent::ConnectionOpen("pnsListaCategoria", "dbweb");
        parent::SetParameterSP("opt", '2');
        parent::SetParameterSP("@cIdSedeEmpresa", '');
        parent::SetParameterSP("@iIdCategoria", $datos["p1"]);
        parent::SetParameterSP("@dFechaIni", $datos["p2"]);
        parent::SetParameterSP("@dFechaFin", $datos["p3"]);
        parent::SetParameterSP("@cboTipoContrato", $datos["p4"]);
        parent::SetParameterSP("@cboTipoSueldo", $datos["p6"]);
        parent::SetParameterSP("@iIdArea", $datos["p7"]);

        $resultado = parent::executeSPArrayX();

        parent::Close();
        return $resultado;
    }

    function guardarEmpleadoRegularizar($datos) {
        parent::ConnectionOpen("pnsListaPersonalARegularizar", "dbweb");
        parent::SetParameterSP("opt", '5');
        parent::SetParameterSP("@c_cod_per", '');
        parent::SetParameterSP("@cboRegularizado", '');
        parent::SetParameterSP("@txtFechaIni", '');
        parent::SetParameterSP("@txtFechaFinal", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("@varAuxId", $datos['idProgramacionEmpleados']);
        parent::SetParameterSP("txtApePaternoPaciente", '');
        parent::SetParameterSP("txtApeMaternoPaciente", '');
        parent::SetParameterSP("txtNombrePaciente", '');
        parent::SetParameterSP("idCodigoEmpleado", $datos["idCodigoEmpleado"]);
        parent::SetParameterSP("txtFecha", $datos["txtFecha"]);
        parent::SetParameterSP("horaInicio", $datos["horaInicio"]);
        parent::SetParameterSP("horaFin", $datos["horaFin"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function busquedaEmpleadoRegularizar($datos) {
        parent::ConnectionOpen("pnsListaPersonalARegularizar", "dbweb");
        parent::SetParameterSP("opt", '4');
        parent::SetParameterSP("@c_cod_per", '');
        parent::SetParameterSP("@cboRegularizado", '');
        parent::SetParameterSP("@txtFechaIni", '');
        parent::SetParameterSP("@txtFechaFinal", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@varAuxId", '');
        parent::SetParameterSP("txtApePaternoPaciente", $datos["txtApePaternoPaciente"]);
        parent::SetParameterSP("txtApeMaternoPaciente", $datos["txtApeMaternoPaciente"]);
        parent::SetParameterSP("txtNombrePaciente", $datos["txtNombrePaciente"]);
        parent::SetParameterSP("idCodigoEmpleado", '');
        parent::SetParameterSP("txtFecha", '');
        parent::SetParameterSP("horaInicio", '0');
        parent::SetParameterSP("horaFin", '0');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DBusquedaEmpleado($datos) {
        parent::ConnectionOpen("pnsListaPersonalARegularizar", "dbweb");
//        if (trim($datos["p1"]) == 0 || trim($datos["p1"]) == 1) {
//            parent::SetParameterSP("opt", '8');
//        } else {
//            parent::SetParameterSP("opt", '7');
//        }
        parent::SetParameterSP("opt", '8');
        parent::SetParameterSP("@c_cod_per", $datos["p4"]); //c_cod_per
        parent::SetParameterSP("@cboRegularizado", $datos["p1"]);
        parent::SetParameterSP("@txtFechaIni", $datos["p2"]);
        parent::SetParameterSP("@txtFechaFinal", $datos["p3"]);
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@varAuxId", '');
        parent::SetParameterSP("txtApePaternoPaciente", $datos["p5"]); //apellidoPaterno
        parent::SetParameterSP("txtApeMaternoPaciente", $datos["p6"]); //apellidoMaterno
        parent::SetParameterSP("txtNombrePaciente", $datos["p7"]); //nombres
        parent::SetParameterSP("idCodigoEmpleado", $datos["p8"]);
        parent::SetParameterSP("txtFecha", '');
        parent::SetParameterSP("horaInicio", '0');
        parent::SetParameterSP("horaFin", '0');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DturnosEmpleadosReales($codigoProgramacion) {
        parent::ConnectionOpen("pnsListaPersonalARegularizar", "dbweb");
        parent::SetParameterSP("opt", '7');
        parent::SetParameterSP("@c_cod_per", ''); //c_cod_per
        parent::SetParameterSP("codigoProgramacion", $codigoProgramacion);
        parent::SetParameterSP("@txtFechaIni", '');
        parent::SetParameterSP("@txtFechaFinal", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@varAuxId", '');
        parent::SetParameterSP("txtApePaternoPaciente", ''); //apellidoPaterno
        parent::SetParameterSP("txtApeMaternoPaciente", ''); //apellidoMaterno
        parent::SetParameterSP("txtNombrePaciente", ''); //nombres
        parent::SetParameterSP("idCodigoEmpleado", '');
        parent::SetParameterSP("txtFecha", '');
        parent::SetParameterSP("horaInicio", '0');
        parent::SetParameterSP("horaFin", '0');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function BusquedaPersonaRegularizar($c_cod_per) {
        parent::ConnectionOpen("pnsListaPersonalARegularizar", "dbweb");
        parent::SetParameterSP("opt", '1');
        parent::SetParameterSP("@c_cod_per", $c_cod_per);
        parent::SetParameterSP("@cboRegularizado", '');
        parent::SetParameterSP("@txtFechaIni", '');
        parent::SetParameterSP("@txtFechaFinal", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@varAuxId", '');
        parent::SetParameterSP("txtApePaternoPaciente", '');
        parent::SetParameterSP("txtApeMaternoPaciente", '');
        parent::SetParameterSP("txtNombrePaciente", '');
        parent::SetParameterSP("idCodigoEmpleado", '');
        parent::SetParameterSP("txtFecha", '');
        parent::SetParameterSP("horaInicio", '0');
        parent::SetParameterSP("horaFin", '0');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function ActualizarTablansdHorarioRealesAsistencia($datos) {
        parent::ConnectionOpen("pnsListaPersonalARegularizar", "dbweb");
        parent::SetParameterSP("opt", '3');
        parent::SetParameterSP("fdf", '');
        parent::SetParameterSP("@cboRegularizado", '');
        parent::SetParameterSP("fechaFinal", $datos["p2"]);
        parent::SetParameterSP("1", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("idMarcacionPersonal", $datos["p1"]);
        parent::SetParameterSP("txtApePaternoPaciente", '');
        parent::SetParameterSP("txtApeMaternoPaciente", '');
        parent::SetParameterSP("Observacion", $datos["p4"]);
        parent::SetParameterSP("idCodigoEmpleado", $datos["p3"]);
        parent::SetParameterSP("txtFecha", '');
        parent::SetParameterSP("horaInicio", '0');
        parent::SetParameterSP("horaFin", '0');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function cboSedeEmpresaArea($idSedeEmpresa) {
        parent::ConnectionOpen("pnsEmpleados", "dbweb");
        parent::SetParameterSP("$1", '17');
        parent::SetParameterSP("$2", $idSedeEmpresa);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function grabarHorarioFijo($datos) {
        parent::ConnectionOpen("pnsHorariosFijosEmpleados", "dbweb");
        parent::SetParameterSP("opt", '1');
        parent::SetParameterSP("iIdDetalleProgramacionPersonal", '');
        parent::SetParameterSP("iIdProgramacionPersonal", $datos["idProgramacionPersonal"]);
        parent::SetParameterSP("iCodigoEmpleado", $datos["idEmpleado"]);
        parent::SetParameterSP("iIdSedeEmpresaAreaCentroCosto", $datos["iIdSEACC"]);
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", $datos["iIdTSEA"]);
        parent::SetParameterSP("dHorasTurno ", $datos["horasTurno"]);
        parent::SetParameterSP("vNumeroProgramaciones", $datos["idSubArea"]); //idSubArea
        parent::SetParameterSP("dFechaIni", $datos["fechaInicio"]);
        parent::SetParameterSP("dFechaFin", $datos["fechaFin"]);
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    /* +-------------------------------------------------------------------------------------------+ */
    /* +------------------------------    Mondalidad contrato   -----------------------------------+ */
    /* +-------------------------------------------------------------------------------------------+ */

    function grabarContrato($datos) {
//print_r($datos);
        parent::ConnectionOpen("pnsMantenimientoContrato", "dbweb");
        parent::SetParameterSP("opt", '1');
        parent::SetParameterSP("idEmpleado", $datos["idEmpleado"]);
        parent::SetParameterSP("idEmpModCon", "");
        parent::SetParameterSP("cboModContrato", $datos["cboModContrato"]);
        parent::SetParameterSP("cboTipoSueldo", $datos["cboTipoSueldo"]);
        parent::SetParameterSP("txtSueldo", $datos["txtSueldo"]);
        parent::SetParameterSP("txtFechaIni", $datos["txtFechaIni"]);
        parent::SetParameterSP("txtFechaFin", $datos["txtFechaFin"]);
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function detalleModalidadContrato($idEmpleado) {
        parent::ConnectionOpen("pnsMantenimientoContrato", "dbweb");
        parent::SetParameterSP("opt", '2');
        parent::SetParameterSP("idEmpleado", $idEmpleado);
        parent::SetParameterSP("idEmpModCon", "");
        parent::SetParameterSP("cboModContrato", "");
        parent::SetParameterSP("cboTipoSueldo", "");
        parent::SetParameterSP("txtSueldo", "0");
        parent::SetParameterSP("txtFechaIni", "");
        parent::SetParameterSP("txtFechaFin", "");
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function dGrabarMantenimientoContrato($datos) {
//print_r($datos);
        parent::ConnectionOpen("pnsMantenimientoContrato", "dbweb");
        parent::SetParameterSP("opcion", $datos["accion"]);
        parent::SetParameterSP("idContrato", $datos["idContrato"]);
        parent::SetParameterSP("iidTipoSueldo", $datos["tipoSueldo"]);
        parent::SetParameterSP("iIdModalidadContrato", $datos["modalidadContrato"]);
        parent::SetParameterSP("iIdPuestoEmpleado", '0');
        parent::SetParameterSP("iIdTipoProgramacion", $datos["tipoProgramacion"]);
        parent::SetParameterSP("nSueldo", $datos["sueldo"]);
        parent::SetParameterSP("fechaInicial", $datos["inicio"]);
        parent::SetParameterSP("fechaFinal", $datos["fin"]);
        parent::SetParameterSP("idEmpleado", $datos["icodigoEmpleado"]);
        parent::SetParameterSP("iidPuesto", $datos["idPuesto"]);
        parent::SetParameterSP("fechaAnulacion", $datos["fechaAnulacion"]);
        parent::SetParameterSP("vDescripcionAnulacion", $datos["motivoAnulacion"]);
        parent::SetParameterSP("bEstado", $datos["bestado"]);
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);

        $resultado = parent::executeSPArrayX();
// echo parent::GetSql();
        parent::Close();
        return $resultado;
    }

    public function getArrayListaAreas($codigoSede) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("dFechaIni", '');
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaFin", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", $codigoSede);
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("dFechaFin", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '100'); //"param1",'100'; Para hacer una consulta normal de lista de areas
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function getArraySubAreas($datos) {
        parent::ConnectionOpen("pnsEmpleadoSubAreas", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("codigosede", $datos["codigosede"]);
        parent::SetParameterSP("codigoarea", $datos["codigoarea"]);
        parent::SetParameterSP("codigoempleado", '');
        parent::SetParameterSP("codigosubarea", '');
        parent::SetParameterSP("codigoempleadoxsubarea", '');
        parent::SetParameterSP("vusuario", '');
        parent::SetParameterSP("vhost", '');
        parent::SetParameterSP("bestado", '');
        parent::SetParameterSP("varchar1", '');
        parent::SetParameterSP("varchar2", '');
        parent::SetParameterSP("varchar3", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//        public function comboCategoriaSubArea($idSubArea) {
//        parent::ConnectionOpen("pnsEmpleadoSubAreas","dbweb");
//        parent::SetParameterSP("accion",'6');
//        parent::SetParameterSP("codigosede",'');
//        parent::SetParameterSP("codigoarea",'');
//        parent::SetParameterSP("codigoempleado", '');
//        parent::SetParameterSP("codigosubarea",$idSubArea);
//        parent::SetParameterSP("codigoempleadoxsubarea",'');
//        parent::SetParameterSP("vusuario",'');
//        parent::SetParameterSP("vhost",'');
//        $resultado=parent::executeSPArrayX();
//        parent::Close();
//        return $resultado;
//    }
    public function getArrayEmpleadosAreas($datos) {
        parent::ConnectionOpen("pnsEmpleadoSubAreas", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("codigosede", $datos["codigosede"]);
        parent::SetParameterSP("codigoarea", $datos["codigoarea"]);
        parent::SetParameterSP("codigoempleado", '');
        parent::SetParameterSP("codigosubarea", '');
        parent::SetParameterSP("codigoempleadoxsubarea", '');
        parent::SetParameterSP("vusuario", '');
        parent::SetParameterSP("vhost", '');
        parent::SetParameterSP("bestado", '');
        parent::SetParameterSP("varchar1", '');
        parent::SetParameterSP("varchar2", '');
        parent::SetParameterSP("varchar3", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function getArrayEmpleadosSubArea($datos) {
        parent::ConnectionOpen("pnsEmpleadoSubAreas", "dbweb");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("codigosede", $datos["codigosede"]);
        parent::SetParameterSP("codigoarea", $datos["codigoarea"]);
        parent::SetParameterSP("codigoempleado", '');
        parent::SetParameterSP("codigosubarea", '');
        parent::SetParameterSP("codigoempleadoxsubarea", '');
        parent::SetParameterSP("vusuario", '');
        parent::SetParameterSP("vhost", '');
        parent::SetParameterSP("bestado", '');
        parent::SetParameterSP("varchar1", '');
        parent::SetParameterSP("varchar2", '');
        parent::SetParameterSP("varchar3", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function asignacionEmpleadoaSubArea($datos) {
        parent::ConnectionOpen("pnsEmpleadoSubAreas", "dbweb");
        parent::SetParameterSP("accion", '4');
        parent::SetParameterSP("codigosede", '');
        parent::SetParameterSP("codigoarea", '');
        parent::SetParameterSP("codigoempleado", $datos["codigoEmpleado"]);
        parent::SetParameterSP("codigosubarea", $datos["codigoSubArea"]);
        parent::SetParameterSP("codigoempleadoxsubarea", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("bestado", '');
        parent::SetParameterSP("varchar1", '');
        parent::SetParameterSP("varchar2", '');
        parent::SetParameterSP("varchar3", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function eliminarEmpleadoSubArea($datos) {
        parent::ConnectionOpen("pnsEmpleadoSubAreas", "dbweb");
        parent::SetParameterSP("accion", '5');
        parent::SetParameterSP("codigosede", '');
        parent::SetParameterSP("codigoarea", '');
        parent::SetParameterSP("codigoempleado", '');
        parent::SetParameterSP("codigosubarea", '');
        parent::SetParameterSP("codigoempleadoxsubarea", $datos["codigoEmpleadoSubArea"]);
        parent::SetParameterSP("vusuario", '');
        parent::SetParameterSP("vhost", '');
        parent::SetParameterSP("bestado", '');
        parent::SetParameterSP("varchar1", '');
        parent::SetParameterSP("varchar2", '');
        parent::SetParameterSP("varchar3", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function mntTablaCategoriaArea($datos) {
        parent::ConnectionOpen("pnsEmpleadoSubAreas", "dbweb");
        parent::SetParameterSP("accion", '6');
        parent::SetParameterSP("codigosede", '');
        parent::SetParameterSP("codigoarea", '');
        parent::SetParameterSP("codigoempleado", '');
        parent::SetParameterSP("codigosubarea", $datos["idSubArea"]);
        parent::SetParameterSP("codigoempleadoxsubarea", '');
        parent::SetParameterSP("vusuario", '');
        parent::SetParameterSP("vhost", '');
        parent::SetParameterSP("bestado", '');
        parent::SetParameterSP("varchar1", '');
        parent::SetParameterSP("varchar2", '');
        parent::SetParameterSP("varchar3", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//2012/02/17 este procedimiento usa la tabla nsdSubAreas ya no se usa ahora se usa nsmSubArea
//    public function grabarSubArea($datos) {
//        parent::ConnectionOpen("pnsEmpleadoSubAreas", "dbweb");
//        parent::SetParameterSP("accion", '7');
//        parent::SetParameterSP("codigosede", $datos["idSedeEmpresaArea"]);
//        parent::SetParameterSP("codigoarea", '');
//        parent::SetParameterSP("codigoempleado", '');
//        parent::SetParameterSP("codigosubarea", $datos["hidIdSubArea"]);
//        parent::SetParameterSP("codigoempleadoxsubarea", '');
//        parent::SetParameterSP("vusuario", $_SESSION["login_user"]);
//        parent::SetParameterSP("vhost", $_SESSION['host']);
//        parent::SetParameterSP("bestado", $datos["cboEstado"]);
//        parent::SetParameterSP("varchar1", $datos["txtNombre"]);
//        parent::SetParameterSP("varchar2", $datos["txtDescripcion"]);
//        parent::SetParameterSP("varchar3", $datos["opcion"]);
//        $resultado = parent::executeSPArrayX();
//        parent::Close();
//        return $resultado;
//    }
// Jose *********************************** 2012/02/17********************
    public function grabarSubArea($datos) {
        parent::ConnectionOpen("pnsMantenimientoArea", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idDependencia", $datos["idArea"]);
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("descripcionArea", $datos["descripcion"]);
        parent::SetParameterSP("abreviaturaArea", $datos["abreviatura"]);
        parent::SetParameterSP("nivelArea", '2');
        parent::SetParameterSP("estadoArea", $datos["estado"]);
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

//***********************************************************************
//      $datos["descripcion"] = $parametros["p2"];
//                    $datos["abreviatura"] = $parametros["p3"];
//                    $datos["estado"] = $parametros["p4"];
//                    $datos["idArea"] = $parametros["p5"];




    public function grabarCategoriaSubArea($datos) {
        parent::ConnectionOpen("pnsEmpleadoSubAreas", "dbweb");
        parent::SetParameterSP("accion", '8');
        parent::SetParameterSP("codigosede", '');
        parent::SetParameterSP("codigoarea", '');
        parent::SetParameterSP("codigoempleado", '');
        parent::SetParameterSP("codigosubarea", $datos["cboSubArea"]);
        parent::SetParameterSP("codigoempleadoxsubarea", '');
        parent::SetParameterSP("vusuario", $_SESSION["login_user"]);
        parent::SetParameterSP("vhost", $_SESSION['host']);
        parent::SetParameterSP("bestado", '');
        parent::SetParameterSP("varchar1", $datos["cboCategoriaPuesto"]);
        parent::SetParameterSP("varchar2", '');
        parent::SetParameterSP("varchar3", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function cambiarEstadoCategoriasSubArea($idCategoriaSubArea) {
        parent::ConnectionOpen("pnsEmpleadoSubAreas", "dbweb");
        parent::SetParameterSP("accion", '9');
        parent::SetParameterSP("codigosede", '');
        parent::SetParameterSP("codigoarea", '');
        parent::SetParameterSP("codigoempleado", '');
        parent::SetParameterSP("codigosubarea", '');
        parent::SetParameterSP("codigoempleadoxsubarea", '');
        parent::SetParameterSP("vusuario", '');
        parent::SetParameterSP("vhost", '');
        parent::SetParameterSP("bestado", '');
        parent::SetParameterSP("varchar1", $idCategoriaSubArea);
        parent::SetParameterSP("varchar2", '');
        parent::SetParameterSP("varchar3", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    /* ==================================================================================== */
    /* ===============NUEVAS FUNCIONES PROGRAMACION PERSONAL ASISTENCIAL=================== */
    /* ==================================================================================== */

    public function getArrayCoordinadoresAreas($iCodEmpCoordinador) {
//parent::ConnectionOpen("pnsProgramacionPersonalAsistencial", "dbweb");
        parent::ConnectionOpen("pnsListaCoordinadoresArea", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("codigoEmpleadoCoordinador", $iCodEmpCoordinador);
        parent::SetParameterSP("codigoSedeEmpresaArea", '');
        parent::SetParameterSP("codigoSubArea", '');
        parent::SetParameterSP("codigoCategoria", '');
        parent::SetParameterSP("idProgramacion", '');
        parent::SetParameterSP("cadenaDatos", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function getArrayAreasdelCoordinador($datos) {
        parent::ConnectionOpen("pnsProgramacionPersonalAsistencial", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("codigoEmpleadoCoordinador", $datos["codigoCoordinador"]);
        parent::SetParameterSP("codigoSedeEmpresaArea", '');
        parent::SetParameterSP("codigoSubArea", '');
        parent::SetParameterSP("codigoCategoria", '');
        parent::SetParameterSP("idProgramacion", '');
        parent::SetParameterSP("cadenaDatos", '');
        parent::SetParameterSP("mes", $datos["mes"]);
        parent::SetParameterSP("anio", $datos["anio"]);
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function getArraySubAreasdelAreadelCoordinador($datos) {
        parent::ConnectionOpen("pnsProgramacionPersonalAsistencial", "dbweb");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("codigoEmpleadoCoordinador", '');
        parent::SetParameterSP("codigoSedeEmpresaArea", $datos["codigoSedeEmpresaArea"]);
        parent::SetParameterSP("codigoSubArea", '');
        parent::SetParameterSP("codigoCategoria", '');
        parent::SetParameterSP("idProgramacion", '');
        parent::SetParameterSP("cadenaDatos", '');
        parent::SetParameterSP("mes", $datos["mes"]);
        parent::SetParameterSP("anio", $datos["anio"]);
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function getArrayCategoriasdelArea($datos) {
        parent::ConnectionOpen("pnsProgramacionPersonalAsistencial", "dbweb");
        parent::SetParameterSP("accion", '4');
        parent::SetParameterSP("codigoEmpleadoCoordinador", '');
        parent::SetParameterSP("codigoSedeEmpresaArea", '');
        parent::SetParameterSP("codigoSubArea", $datos["codigoSubArea"]);
        parent::SetParameterSP("codigoCategoria", '');
        parent::SetParameterSP("idProgramacion", '');
        parent::SetParameterSP("cadenaDatos", '');
        parent::SetParameterSP("mes", $datos["mes"]);
        parent::SetParameterSP("anio", $datos["anio"]);
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function getArrayEmpleadosCategoriadelSubArea($datos) {
        parent::ConnectionOpen("pnsProgramacionPersonalAsistencial", "dbweb");
        parent::SetParameterSP("accion", '5');
        parent::SetParameterSP("codigoEmpleadoCoordinador", '');
        parent::SetParameterSP("codigoSedeEmpresaArea", '');
        parent::SetParameterSP("codigoSubArea", $datos["codigoSubArea"]);
        parent::SetParameterSP("codigoCategoria", $datos["codigoCategoria"]);
        parent::SetParameterSP("idProgramacion", '');
        parent::SetParameterSP("cadenaDatos", '');
        parent::SetParameterSP("mes", $datos["mes"]);
        parent::SetParameterSP("anio", $datos["anio"]);
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function codigoProgramacionHorario($idEmpleado) {
        parent::ConnectionOpen("pnsProgramacionPersonalAsistencial", "dbweb");
        parent::SetParameterSP("accion", '6');
        parent::SetParameterSP("codigoEmpleadoCoordinador", $idEmpleado);
        parent::SetParameterSP("codigoSedeEmpresaArea", '');
        parent::SetParameterSP("codigoSubArea", '');
        parent::SetParameterSP("codigoCategoria", '');
        parent::SetParameterSP("idProgramacion", '');
        parent::SetParameterSP("cadenaDatos", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function registrarProgramacionHorario($cadenaCuerpo, $idProgramacion, $idSubArea) {
        parent::ConnectionOpen("pnsProgramacionPersonalAsistencial", "dbweb");
        parent::SetParameterSP("accion", '7');
        parent::SetParameterSP("codigoEmpleadoCoordinador", '');
        parent::SetParameterSP("codigoSedeEmpresaArea", '');
        parent::SetParameterSP("codigoSubArea", $idSubArea);
        parent::SetParameterSP("codigoCategoria", '');
        parent::SetParameterSP("idProgramacion", $idProgramacion);
        parent::SetParameterSP("cadenaDatos", $cadenaCuerpo);
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function verificarExisteHorario($coordinador, $idSubArea, $idCategoria, $mes, $anio) {
        parent::ConnectionOpen("pnsProgramacionPersonalAsistencial", "dbweb");
        parent::SetParameterSP("accion", '8');
        parent::SetParameterSP("codigoEmpleadoCoordinador", $coordinador);
        parent::SetParameterSP("codigoSedeEmpresaArea", '');
        parent::SetParameterSP("codigoSubArea", $idSubArea);
        parent::SetParameterSP("codigoCategoria", $idCategoria);
        parent::SetParameterSP("idProgramacion", '');
        parent::SetParameterSP("cadenaDatos", '');
        parent::SetParameterSP("mes", $mes);
        parent::SetParameterSP("anio", $anio);
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function HorariosTurnos($codigoCordinador) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '24');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", $codigoCordinador);
        parent::SetParameterSP("dFechaProgramacion", '');
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", '');
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function eliminarAsistencia($datos) {
        parent::ConnectionOpen("pnsListaPersonalARegularizar", "dbweb");
        parent::SetParameterSP("opt", '6');
        parent::SetParameterSP("@c_cod_per", '');
        parent::SetParameterSP("@cboRegularizado", '');
        parent::SetParameterSP("@txtFechaIni", '');
        parent::SetParameterSP("@txtFechaFinal", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@varAuxId", $datos["idHorarioAsistencia"]);
        parent::SetParameterSP("txtApePaternoPaciente", '');
        parent::SetParameterSP("txtApeMaternoPaciente", '');
        parent::SetParameterSP("txtNombrePaciente", '');
        parent::SetParameterSP("idCodigoEmpleado", '');
        parent::SetParameterSP("txtFecha", '');
        parent::SetParameterSP("horaInicio", '0');
        parent::SetParameterSP("horaFin", '0');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function exportarExcelEncargadosMorosos($datos) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '27');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("dFechaProgramacion", '');
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", '');
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", $datos["cboMes"]);
        parent::SetParameterSP("anio", $datos["cboAnio"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function exportarExcelEncargados($datos) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '28');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("dFechaProgramacion", '');
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", '');
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", $datos["cboMes"]);
        parent::SetParameterSP("anio", $datos["cboAnio"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function fechaProgramacion($iIdProgramacionpersonal) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '28');
        parent::SetParameterSP("iIdProgramacionPersonal", $iIdProgramacionpersonal);
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("dFechaProgramacion", '');
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", '');
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//-------------------------------------------
    function personalVacaciones() {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '26');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("dFechaProgramacion", '');
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", '');
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function personalDescansoMedico() {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '25');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("dFechaProgramacion", '');
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", '');
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function desactivarEmpleadoArea($idCodigoEmpleado, $idCodigoSEACC) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '25');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", $idCodigoEmpleado);
        parent::SetParameterSP("dFechaProgramacion", '');
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", $idCodigoSEACC);
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function exportarExcelArea($datos) {
        parent::ConnectionOpen("pnsMantenimientoHorario", "dbweb");
        parent::SetParameterSP("opt", '27');
        parent::SetParameterSP("iIdProgramacionPersonal", '');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("dFechaProgramacion", '');
        parent::SetParameterSP("bEstadoHabilitado", '');
        parent::SetParameterSP("dFechaLimite", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("cCodigoTurno", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", '');
        parent::SetParameterSP("iIdTurnoSedeEmpresaArea", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("horas", '');
        parent::SetParameterSP("param1", '');
        parent::SetParameterSP("mes", $datos['mes']);
        parent::SetParameterSP("anio", $datos['anio']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function ListaSede($iCodEmpCoordinador) {

        parent::ConnectionOpen("AsignacionPersonalArea", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("iCodigoEmpleado", $iCodEmpCoordinador);
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//


    function ListaTodasSede() {

        parent::ConnectionOpen("CoordinadoresTurnos", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//
    function CargarArea($iCodEmpCoordinador, $cboSede) {

        parent::ConnectionOpen("AsignacionPersonalArea", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("iCodigoEmpleado", $iCodEmpCoordinador);
        parent::SetParameterSP("idSedeEmpresa", $cboSede);
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//Modificar 29Mayo2012
    function CargarlistadoTodosCordinadores($cboSede) {

        if (isset($_SESSION["permiso_formulario_servicio"][235]["FILTRADO_AREAS_X_COORDINADOR"]) && ($_SESSION["permiso_formulario_servicio"][235]["FILTRADO_AREAS_X_COORDINADOR"] == 1)) {
//activado
            $codEmpleado = '';
        } else {
//desactivado
            $codEmpleado = $_SESSION['iCodigoEmpleado'];
        }


        parent::ConnectionOpen("CoordinadoresTurnos", "dbweb");
        parent::SetParameterSP("accion", '3');

//parent::SetParameterSP("iCodigoEmpleado", '');

        parent::SetParameterSP("iCodigoEmpleado", '');


        parent::SetParameterSP("idSedeEmpresa", $cboSede);
        parent::SetParameterSP("idArea", $codEmpleado);
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//añadido 03 Abril 12
    function CargarlistaPuestosXCentroCostos($idCentroDeCosto) {

        parent::ConnectionOpen("PuestosxCentroDeCostos", "dbweb");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idArea", $idCentroDeCosto);
//        parent::SetParameterSP("idSedeEmpresaArea", '');
//        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
//        parent::SetParameterSP("idPreProgramacionPersonal", '');
//        parent::SetParameterSP("mes", '');
//        parent::SetParameterSP("anno", '');
//        parent::SetParameterSP("user", '');
//        parent::SetParameterSP("host", '');

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//Modificado 30 Mayo JCQA
    function CargarlistadoTodosCordinadoresFiltrado($datos) {

        if (isset($_SESSION["permiso_formulario_servicio"][235]["FILTRADO_BUSQUEDA_AREAS_X_COORDINADOR"]) && ($_SESSION["permiso_formulario_servicio"][235]["FILTRADO_BUSQUEDA_AREAS_X_COORDINADOR"] == 1)) {
//activado
            $codEmpleado2 = '';
        } else {
//desactivado
            $codEmpleado2 = $_SESSION['iCodigoEmpleado'];
        }



        parent::ConnectionOpen("CoordinadoresTurnos", "dbweb");
        parent::SetParameterSP("accion", '12');
        parent::SetParameterSP("iCodigoEmpleado", $datos["IdcboSede"]);
        parent::SetParameterSP("idSedeEmpresa", $datos["txtNombreAreaAbuscar"]);
        parent::SetParameterSP("idArea", $codEmpleado2);
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

///////////////////////

    function listaTurnosDisponibles($idSedeempresaArea) {

        parent::ConnectionOpen("CoordinadoresTurnos", "dbweb");
        parent::SetParameterSP("accion", '7');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresaArea", $idSedeempresaArea);
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function listaTurnosxSedeEmpresaArea($idSedeempresaArea) {

        parent::ConnectionOpen("CoordinadoresTurnos", "dbweb");
        parent::SetParameterSP("accion", '6');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresaArea", $idSedeempresaArea);
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function CargarlistadoTodasAreasSinCoordinador($cboSede) {

        parent::ConnectionOpen("CoordinadoresTurnos", "dbweb");
        parent::SetParameterSP("accion", '5');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("idSedeEmpresa", $cboSede);
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function CargarlistadoTodasAreasSinCoordinadorFiltrado($datos) {

        parent::ConnectionOpen("CoordinadoresTurnos", "dbweb");
        parent::SetParameterSP("accion", '13');
        parent::SetParameterSP("iCodigoEmpleado", $datos["IdcboSede"]);
        parent::SetParameterSP("idSedeEmpresa", $datos["txtNombreAreaAbuscar"]);
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function ListarEmpleadosPreProgramados($iCodEmpCoordinador, $datos) {

        parent::ConnectionOpen("AsignacionPersonalArea", "dbweb");
        parent::SetParameterSP("accion", '10');
        parent::SetParameterSP("iCodigoEmpleado", $iCodEmpCoordinador);
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", $datos["mes"]);
        parent::SetParameterSP("anno", $datos["anno"]);
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function listarEmpleados($datos) {

        parent::ConnectionOpen("AsignacionPersonalArea", "dbweb");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresaArea", $datos["idEmpresaSedearea"]);
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", $datos["cboMes"]);
        parent::SetParameterSP("anno", $datos["cboAnio"]);
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function nombreCoordinador($iCodEmpCoordinador) {

        parent::ConnectionOpen("AsignacionPersonalArea", "dbweb");
        parent::SetParameterSP("accion", '4');
        parent::SetParameterSP("iCodigoEmpleado", $iCodEmpCoordinador);
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function insercionPreProgramacion($datos) {

        parent::ConnectionOpen("AsignacionPersonalArea", "dbweb");
        parent::SetParameterSP("accion", '5');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idPuestoEmpleadoPorArea", $datos["idPuestoEmpleadoPorArea"]);
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", $datos["cboMes"]);
        parent::SetParameterSP("anno", $datos["cboAnio"]);
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function insercionTurnoDisponibleAlArea($datos) {

        parent::ConnectionOpen("CoordinadoresTurnos", "dbweb");
        parent::SetParameterSP("accion", '8');
        parent::SetParameterSP("iCodigoEmpleado", $datos["codTurno"]);
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresaArea", $datos["idSedeEmpresaArea"]);
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//Modificado al 20 Abril 2012 JCQA


    function grabarColorSelecionadoTurnoAreaSede($datos) {

        parent::ConnectionOpen("CoordinadoresTurnos", "dbweb");
        parent::SetParameterSP("accion", '21');
        parent::SetParameterSP("iCodigoEmpleado", $datos["hIdTurnoAreaSede"]);
        parent::SetParameterSP("idSedeEmpresa", $datos["color"]);
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function actualizacionEstadoPuestoSedeEmpresaArea($idPuestoEmpleadoPorArea) {

        parent::ConnectionOpen("AsignacionPersonalArea", "dbweb");
        parent::SetParameterSP("accion", '6');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idPuestoEmpleadoPorArea", $idPuestoEmpleadoPorArea);
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function listarEmpleadosProgramados($datos) {

        parent::ConnectionOpen("AsignacionPersonalArea", "dbweb");
        parent::SetParameterSP("accion", '7');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresaArea", $datos["idEmpresaSedearea"]);
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", $datos["cboMes"]);
        parent::SetParameterSP("anno", $datos["cboAnio"]);
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function actualizarEstadoPreProgramacion($idPreProgramacionPersonal) {

        parent::ConnectionOpen("AsignacionPersonalArea", "dbweb");
        parent::SetParameterSP("accion", '8');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", $idPreProgramacionPersonal);
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

/////modif 14 Marzo



    function quitarTurnoSeleccionadoAlArea($idTurnoAreaSede) {

        parent::ConnectionOpen("CoordinadoresTurnos", "dbweb");
        parent::SetParameterSP("accion", '9');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idArea", $idTurnoAreaSede);
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idPuestoEmpleadoPorArea", '');
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function actualizacionEstadoPuestoSedeEmpresaAreadescativacion($idPuestoEmpleadoPorArea) {

        parent::ConnectionOpen("AsignacionPersonalArea", "dbweb");
        parent::SetParameterSP("accion", '9');
        parent::SetParameterSP("iCodigoEmpleado", '');
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("idPuestoEmpleadoPorArea", $idPuestoEmpleadoPorArea);
        parent::SetParameterSP("idPreProgramacionPersonal", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function arbolAreas($idSedeEmpresa) {
        parent::ConnectionOpen("pnsMantenimientoArea", "dbweb");
        parent::SetParameterSP("accion", '8');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idDependencia", "");
        parent::SetParameterSP("idSedeEmpresa", $idSedeEmpresa);
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("descripcionArea", "");
        parent::SetParameterSP("abreviaturaArea", "");
        parent::SetParameterSP("nivelArea", '');
        parent::SetParameterSP("estadoArea", "");
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

//23 enero
    function darbolPracticasOdontologicas() {
        parent::ConnectionOpen("pnsOdontogramaPrueba", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idDependencia", "");
        parent::SetParameterSP("idSedeEmpresa", "");
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("descripcionArea", "");
        parent::SetParameterSP("abreviaturaArea", "");
        parent::SetParameterSP("nivelArea", '');
        parent::SetParameterSP("estadoArea", "");
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function arbolAreas2($idSedeEmpresa) {
        parent::ConnectionOpen("CoordinadoresTurnos", "dbweb");
        parent::SetParameterSP("accion", '20');
        parent::SetParameterSP("idArea", '');
        parent::SetParameterSP("idDependencia", $idSedeEmpresa);
//parent::SetParameterSP("idDependencia", "");
//parent::SetParameterSP("idSedeEmpresa", $idSedeEmpresa);
        parent::SetParameterSP("idSedeEmpresa", '');
        parent::SetParameterSP("idSedeEmpresaArea", '');
        parent::SetParameterSP("descripcionArea", "");
        parent::SetParameterSP("abreviaturaArea", "");
        parent::SetParameterSP("nivelArea", '');
        parent::SetParameterSP("estadoArea", "");
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dGeneraArbolCentroCostos() {
        parent::ConnectionOpen("PuestosxCentroDeCostos", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("p1", '');
        parent::SetParameterSP("p2", '');
//parent::SetParameterSP("idDependencia", "");
//parent::SetParameterSP("idSedeEmpresa", $idSedeEmpresa);
        parent::SetParameterSP("p3", '');
//        parent::SetParameterSP("idSedeEmpresaArea", '');
//        parent::SetParameterSP("descripcionArea", "");
//        parent::SetParameterSP("abreviaturaArea", "");
//        parent::SetParameterSP("nivelArea", '');
//        parent::SetParameterSP("estadoArea", "");
//        parent::SetParameterSP("user", "");
//        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function mantenimientoCaja($c_cod_per) {
        parent::ConnectionOpen("pnsMantenimientoCajero", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("c_cod_per", $c_cod_per);
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("numeroCaja", "");
        parent::SetParameterSP("numeroComprobante", "");
        parent::SetParameterSP("serieComprobante", "");
        parent::SetParameterSP("serieComprobanteNuevo", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("c_nro_act", '');
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function maximonumeroCaja($c_cod_per) {
        parent::ConnectionOpen("pnsMantenimientoCajero", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("c_cod_per", $c_cod_per);
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("numeroCaja", "");
        parent::SetParameterSP("numeroComprobante", "");
        parent::SetParameterSP("serieComprobante", "");
        parent::SetParameterSP("serieComprobanteNuevo", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("c_nro_act", '');
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function DtipoComprobante($c_cod_per) {
        parent::ConnectionOpen("pnsMantenimientoCajero", "dbweb");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("c_cod_per", $c_cod_per);
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("numeroCaja", "");
        parent::SetParameterSP("numeroComprobante", "");
        parent::SetParameterSP("serieComprobante", "");
        parent::SetParameterSP("serieComprobanteNuevo", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("c_nro_act", '');
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function DtipoComprobanteNoSeleccionado($c_cod_per) {
        parent::ConnectionOpen("pnsMantenimientoCajero", "dbweb");
        parent::SetParameterSP("accion", '4');
        parent::SetParameterSP("c_cod_per", $c_cod_per);
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("numeroCaja", "");
        parent::SetParameterSP("numeroComprobante", "");
        parent::SetParameterSP("serieComprobante", "");
        parent::SetParameterSP("serieComprobanteNuevo", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("c_nro_act", '');
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function UsuarioCaja($c_cod_per) {
        parent::ConnectionOpen("pnsMantenimientoCajero", "dbweb");
        parent::SetParameterSP("accion", '5');
        parent::SetParameterSP("c_cod_per", $c_cod_per);
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("numeroCaja", "");
        parent::SetParameterSP("numeroComprobante", "");
        parent::SetParameterSP("serieComprobante", "");
        parent::SetParameterSP("serieComprobanteNuevo", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("c_nro_act", '');
        parent::SetParameterSP("user", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function DempleadoCajero($datos) {
        parent::ConnectionOpen("pnsMantenimientoCajero", "dbweb");
        parent::SetParameterSP("accion", '9');
        parent::SetParameterSP("c_cod_per", $datos["c_cod_per"]);
        parent::SetParameterSP("usuario", $datos["usuario"]);
        parent::SetParameterSP("numeroCaja", "");
        parent::SetParameterSP("numeroComprobante", "");
        parent::SetParameterSP("serieComprobante", $datos['iIdSerieComprobante']);
        parent::SetParameterSP("serieComprobanteNuevo", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("c_nro_act", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    
    
    function dElimnarCajaComprobante($iIdCajaComprobante) {
        parent::ConnectionOpen("pnsMantenimientoCajero", "dbweb");
        parent::SetParameterSP("accion", '10');
        parent::SetParameterSP("c_cod_per", '');
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("numeroCaja", "");
        parent::SetParameterSP("numeroComprobante", "");
        parent::SetParameterSP("serieComprobante", $iIdCajaComprobante);
        parent::SetParameterSP("serieComprobanteNuevo", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("c_nro_act", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }
    
    
    function DserieComprobante($datos) {
        parent::ConnectionOpen("pnsMantenimientoCajero", "dbweb");
        parent::SetParameterSP("accion", '7');
        parent::SetParameterSP("c_cod_per", '');
        parent::SetParameterSP("usuario", $datos["usuario"]);
        parent::SetParameterSP("numeroCaja", $datos["numeroCaja"]);
        parent::SetParameterSP("numeroComprobante", $datos["numeroComprobante"]);
        parent::SetParameterSP("serieComprobante", $datos["seriComprobante"]);
        parent::SetParameterSP("serieComprobanteNuevo", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("c_nro_act", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function DmodificarSerieEstado($datos) {
        parent::ConnectionOpen("pnsMantenimientoCajero", "dbweb");
        parent::SetParameterSP("accion", '8');
        parent::SetParameterSP("c_cod_per", '');
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("numeroCaja", $datos["numeroCaja"]);
        parent::SetParameterSP("numeroComprobante", $datos["codigoComprobante"]);
        parent::SetParameterSP("serieComprobanteAntiguo", $datos["serieAntigua"]);
        parent::SetParameterSP("serieComprobanteNuevo", $datos["serieNueva"]);
        parent::SetParameterSP("estado", $datos["estadoserie"]);
        parent::SetParameterSP("c_nro_act", $datos["c_nro_act"]);
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

//JCDB 18/04/2012 10AM
    function tablaMarcacionEmpleadosAudiotira($parametros) {
        parent::ConnectionOpen("pnsListaPersonalARegularizar", "dbweb");
        parent::SetParameterSP("opt", '9');
        parent::SetParameterSP("@c_cod_per", $parametros["codPer"]);
        parent::SetParameterSP("@cboRegularizado", '');
        parent::SetParameterSP("@txtFechaIni", '');
        parent::SetParameterSP("@txtFechaFinal", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("@varAuxId", $parametros["idHorarioAsistencia"]);
        parent::SetParameterSP("txtApePaternoPaciente", "");
        parent::SetParameterSP("txtApeMaternoPaciente", "");
        parent::SetParameterSP("txtNombrePaciente", "");
        parent::SetParameterSP("idCodigoEmpleado", $parametros["codEmp"]);
        parent::SetParameterSP("txtFecha", $parametros["fecha"]);
        parent::SetParameterSP("horaInicio", '0');
        parent::SetParameterSP("horaFin", '0');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    /*     * *****************************VACACIONES********************************************** */
    /*     * *********************************JCDB 07/05/2012************************************* */

    function comboTipoDescanso() {
        parent::ConnectionOpen("pnsMantenimientoDescanso", "dbweb");
        parent::SetParameterSP("@accion", '2');
        parent::SetParameterSP("@auxInt1", '');
        parent::SetParameterSP("@auxInt2", '');
        parent::SetParameterSP("@auxInt3", '');
        parent::SetParameterSP("@auxDate1", '');
        parent::SetParameterSP("@auxDate2", '');
        parent::SetParameterSP("@auxDatetime1", '');
        parent::SetParameterSP("@auxDatetime2", '');
        parent::SetParameterSP("@auxVarchar1", '');
        parent::SetParameterSP("@auxVarchar2", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function tablaDescansoContratoEmpleado($parametros) {
        parent::ConnectionOpen("pnsMantenimientoDescanso", "dbweb");
        parent::SetParameterSP("@accion", '1');
        parent::SetParameterSP("@auxInt1", $parametros['codEmp']);
        parent::SetParameterSP("@auxInt2", $parametros['idContrato']);
        parent::SetParameterSP("@auxInt3", '');
        parent::SetParameterSP("@auxDate1", '');
        parent::SetParameterSP("@auxDate2", '');
        parent::SetParameterSP("@auxDatetime1", '');
        parent::SetParameterSP("@auxDatetime2", '');
        parent::SetParameterSP("@auxVarchar1", '');
        parent::SetParameterSP("@auxVarchar2", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function guardarVacaciones($parametros) {
        parent::ConnectionOpen("pnsMantenimientoDescanso", "dbweb");
        parent::SetParameterSP("@accion", '3');
        parent::SetParameterSP("@auxInt1", $parametros['p2']);
        parent::SetParameterSP("@auxInt2", $parametros['p3']);
        parent::SetParameterSP("@auxInt3", '');
        parent::SetParameterSP("@auxDate1", $parametros['p4']);
        parent::SetParameterSP("@auxDate2", $parametros['p5']);
        parent::SetParameterSP("@auxDatetime1", '');
        parent::SetParameterSP("@auxDatetime2", '');
        parent::SetParameterSP("@auxVarchar1", $_SESSION["login_user"]);
        parent::SetParameterSP("@auxVarchar2", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function eliminarVacaciones($parametros) {
        parent::ConnectionOpen("pnsMantenimientoDescanso", "dbweb");
        parent::SetParameterSP("@accion", '5');
        parent::SetParameterSP("@auxInt1", '');
        parent::SetParameterSP("@auxInt2", '');
        parent::SetParameterSP("@auxInt3", $parametros['p2']);
        parent::SetParameterSP("@auxDate1", '');
        parent::SetParameterSP("@auxDate2", '');
        parent::SetParameterSP("@auxDatetime1", '');
        parent::SetParameterSP("@auxDatetime2", '');
        parent::SetParameterSP("@auxVarchar1", '');
        parent::SetParameterSP("@auxVarchar2", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    /*     * **********************************FIN VACACIONES************************************************* */

//// Inicio de RR-HH
    function DDesactivarCoordinador($datos) {
        parent::ConnectionOpen("pnsCoordinadores", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("mes", $datos["mes"]);
        parent::SetParameterSP("descripcion", $datos["descripcion"]);
        parent::SetParameterSP("anno", $datos["anio"]);
        parent::SetParameterSP("IdHistoriaDeCoordinador", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function DActivarCoordinador($datos) {
        parent::ConnectionOpen("pnsCoordinadores", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("mes", $datos["mes"]);
        parent::SetParameterSP("descripcion", $datos["descripcion"]);
        parent::SetParameterSP("anno", $datos["anio"]);
        parent::SetParameterSP("IdHistoriaDeCoordinador", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function DActivarCordinadorXarea($datos) {
        parent::ConnectionOpen("pnsCoordinadores", "dbweb");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("mes", $datos["mes"]);
        parent::SetParameterSP("descripcion", '');
        parent::SetParameterSP("anno", $datos["anio"]);
        parent::SetParameterSP("IdHistoriaDeCoordinador", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function DarPermisoEspecialAlCoordinador($datos) {
        parent::ConnectionOpen("pnsCoordinadores", "dbweb");
        parent::SetParameterSP("accion", '4');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("descripcion", '');
        parent::SetParameterSP("anno", '');
        parent::SetParameterSP("IdHistoriaDeCoordinador", $datos["IdHistoriaDeCoordinador"]);
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    public function DAreaDeLosCoordinadores($iCodEmpCoordinador, $anio, $mes) {
        parent::ConnectionOpen("pnsListaCoordinadoresArea", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("codigoEmpleadoCoordinador", $iCodEmpCoordinador);
        parent::SetParameterSP("codigoSedeEmpresaArea", '');
        parent::SetParameterSP("codigoSubArea", '');
        parent::SetParameterSP("codigoCategoria", '');
        parent::SetParameterSP("idProgramacionPersonal", '');
        parent::SetParameterSP("idTurnoAreaSede", '');
        parent::SetParameterSP("cadenaDatos", '');
        parent::SetParameterSP("nDias", '');
        parent::SetParameterSP("mes", $mes);
        parent::SetParameterSP("anio", $anio);
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("numeroProgramaciones", '');
        parent::SetParameterSP("posicion", '');
        parent::SetParameterSP("numeroProgramado", '');
        parent::SetParameterSP("iIdPuestoEmpleado", '');
        parent::SetParameterSP("nInicioTurno", '');
        parent::SetParameterSP("nfinTurno", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function DempleadosXsusArea($iIdSedeEmpresaArea, $anio, $mes, $idCategoria) {
        parent::ConnectionOpen("pnsListaCoordinadoresArea", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("codigoEmpleadoCoordinador", '');
        parent::SetParameterSP("codigoSedeEmpresaArea", $iIdSedeEmpresaArea);
        parent::SetParameterSP("codigoSubArea", '');
        parent::SetParameterSP("codigoCategoria", $idCategoria);
        parent::SetParameterSP("idProgramacionPersonal", '');
        parent::SetParameterSP("idTurnoAreaSede", '');
        parent::SetParameterSP("cadenaDatos", '');
        parent::SetParameterSP("nDias", '');
        parent::SetParameterSP("mes", $mes);
        parent::SetParameterSP("anio", $anio);
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("numeroProgramaciones", '');
        parent::SetParameterSP("posicion", '');
        parent::SetParameterSP("numeroProgramado", '');
        parent::SetParameterSP("iIdPuestoEmpleado", '');
        parent::SetParameterSP("nInicioTurno", '');
        parent::SetParameterSP("nfinTurno", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function DempleadosXturnos($iIdPreProgramacion, $anio, $mes, $nDias, $numeroProgramaciones, $posicion, $iIdPuestoEmpleado, $numeroProgramado, $iIdSedeEmpresaArea) {
        parent::ConnectionOpen("pnsListaCoordinadoresArea", "dbweb");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("codigoEmpleadoCoordinador", '');
        parent::SetParameterSP("codigoSedeEmpresaArea", $iIdSedeEmpresaArea);
        parent::SetParameterSP("iIdPreProgramacion", $iIdPreProgramacion);
        parent::SetParameterSP("codigoCategoria", '');
        parent::SetParameterSP("idProgramacionPersonal", '');
        parent::SetParameterSP("idTurnoAreaSede", '');
        parent::SetParameterSP("cadenaDatos", '');
        parent::SetParameterSP("nDias", $nDias);
        parent::SetParameterSP("mes", $mes);
        parent::SetParameterSP("anio", $anio);
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("numeroProgramaciones", $numeroProgramaciones);
        parent::SetParameterSP("posicion", $posicion);
        parent::SetParameterSP("numeroProgramado", $numeroProgramado);
        parent::SetParameterSP("iIdPuestoEmpleado", $iIdPuestoEmpleado);
        parent::SetParameterSP("nInicioTurno", '');
        parent::SetParameterSP("nfinTurno", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function DfechaSistema() {
        parent::ConnectionOpen("pnsListaCoordinadoresArea", "dbweb");
        parent::SetParameterSP("accion", '4');
        parent::SetParameterSP("codigoEmpleadoCoordinador", '');
        parent::SetParameterSP("codigoSedeEmpresaArea", '');
        parent::SetParameterSP("iIdPreProgramacion", '');
        parent::SetParameterSP("codigoCategoria", '');
        parent::SetParameterSP("idProgramacionPersonal", '');
        parent::SetParameterSP("idTurnoAreaSede", '');
        parent::SetParameterSP("cadenaDatos", '');
        parent::SetParameterSP("nDias", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("numeroProgramaciones", '');
        parent::SetParameterSP("posicion", '');
        parent::SetParameterSP("numeroProgramado", '');
        parent::SetParameterSP("iIdPuestoEmpleado", '');
        parent::SetParameterSP("nInicioTurno", '');
        parent::SetParameterSP("nfinTurno", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function DlistaTurnosArea($codigoSedeEmpresaArea, $anno, $mes) {
        parent::ConnectionOpen("pnsListaCoordinadoresArea", "dbweb");
        parent::SetParameterSP("accion", '5');
        parent::SetParameterSP("codigoEmpleadoCoordinador", '');
        parent::SetParameterSP("codigoSedeEmpresaArea", $codigoSedeEmpresaArea);
        parent::SetParameterSP("iIdPreProgramacion", '');
        parent::SetParameterSP("codigoCategoria", '');
        parent::SetParameterSP("idProgramacionPersonal", '');
        parent::SetParameterSP("idTurnoAreaSede", '');
        parent::SetParameterSP("cadenaDatos", '');
        parent::SetParameterSP("nDias", '');
        parent::SetParameterSP("mes", $mes);
        parent::SetParameterSP("anio", $anno);
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("numeroProgramaciones", '');
        parent::SetParameterSP("posicion", '');
        parent::SetParameterSP("numeroProgramado", '');
        parent::SetParameterSP("iIdPuestoEmpleado", '');
        parent::SetParameterSP("nInicioTurno", '');
        parent::SetParameterSP("nfinTurno", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function DguardarTurnoProgramadoGrupo($datos) {
        parent::ConnectionOpen("pnsListaCoordinadoresArea", "dbweb");
        parent::SetParameterSP("accion", '6');
        parent::SetParameterSP("codigoEmpleado", $datos["iCodigoEmpleado"]); // codigo Empleado que va a ser programado
        parent::SetParameterSP("codigoSedeEmpresaArea", '');
        parent::SetParameterSP("iIdPreProgramacion", $datos["idPreProgramacion"]);
        parent::SetParameterSP("codigoCategoria", '');
        parent::SetParameterSP("idProgramacionPersonal", '');
        parent::SetParameterSP("idTurnoAreaSede", $datos["idTurnoAreaSede"]);
        parent::SetParameterSP("cadenaDatos", $datos["cadena"]);
        parent::SetParameterSP("nDias", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("numeroProgramaciones", '');
        parent::SetParameterSP("posicion", '');
        parent::SetParameterSP("numeroProgramado", $datos["nNumeroProgramacionesXmes"]);
        parent::SetParameterSP("iIdPuestoEmpleado", $datos["idPuestoEmpleado"]);
        parent::SetParameterSP("nInicioTurno", $datos["nInicioTurno"]);
        parent::SetParameterSP("nfinTurno", $datos["nfinTurno"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function DmodificarTurnoProgramadoIndividuar($datos) {
        parent::ConnectionOpen("pnsListaCoordinadoresArea", "dbweb");
        parent::SetParameterSP("accion", '7');
        parent::SetParameterSP("codigoEmpleado", $datos["iCodigoEmpleado"]); // codigo Empleado que va a ser programado
        parent::SetParameterSP("codigoSedeEmpresaArea", '');
        parent::SetParameterSP("iIdPreProgramacion", $datos["idPreProgramacion"]);
        parent::SetParameterSP("codigoCategoria", '');
        parent::SetParameterSP("idProgramacionPersonal", $datos["idProgramacionPersonal"]);
        parent::SetParameterSP("idTurnoAreaSede", $datos["idSedeAreaTurnoActual"]);
        parent::SetParameterSP("cadenaDatos", $datos["cadena"]);
        parent::SetParameterSP("nDias", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("numeroProgramaciones", '');
        parent::SetParameterSP("posicion", '');
        parent::SetParameterSP("numeroProgramado", '');
        parent::SetParameterSP("iIdPuestoEmpleado", '');
        parent::SetParameterSP("nInicioTurno", $datos["nInicioTurno"]);
        parent::SetParameterSP("nfinTurno", $datos["nfinTurno"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function DeliminarTurnoProgramadoIndividuar($datos) {
        parent::ConnectionOpen("pnsListaCoordinadoresArea", "dbweb");
        parent::SetParameterSP("accion", '8');
        parent::SetParameterSP("codigoEmpleado", $datos["iCodigoEmpleado"]); // codigo Empleado que va a ser programado
        parent::SetParameterSP("codigoSedeEmpresaArea", '');
        parent::SetParameterSP("iIdPreProgramacion", $datos["idPreProgramacion"]);
        parent::SetParameterSP("codigoCategoria", '');
        parent::SetParameterSP("idProgramacionPersonal", $datos["idProgramacionPersonal"]);
        parent::SetParameterSP("idTurnoAreaSede", $datos["idTurnoAreaSede"]);
        parent::SetParameterSP("cadenaDatos", $datos["cadena"]);
        parent::SetParameterSP("nDias", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("numeroProgramaciones", '');
        parent::SetParameterSP("posicion", '');
        parent::SetParameterSP("numeroProgramado", $datos["nNumeroProgramacionesXmes"]);
        parent::SetParameterSP("iIdPuestoEmpleado", $datos["idPuestoEmpleado"]);
        parent::SetParameterSP("nInicioTurno", $datos["nInicioTurno"]);
        parent::SetParameterSP("nfinTurno", $datos["nfinTurno"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function DlistaTurnosAreaDescanso() {
        parent::ConnectionOpen("pnsListaCoordinadoresArea", "dbweb");
        parent::SetParameterSP("accion", '9');
        parent::SetParameterSP("codigoEmpleado", ''); // codigo Empleado que va a ser programado
        parent::SetParameterSP("codigoSedeEmpresaArea", '');
        parent::SetParameterSP("iIdPreProgramacion", '');
        parent::SetParameterSP("codigoCategoria", '');
        parent::SetParameterSP("idProgramacionPersonal", '');
        parent::SetParameterSP("idTurnoAreaSede", '');
        parent::SetParameterSP("cadenaDatos", '');
        parent::SetParameterSP("nDias", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("numeroProgramaciones", '');
        parent::SetParameterSP("posicion", '');
        parent::SetParameterSP("numeroProgramado", '');
        parent::SetParameterSP("iIdPuestoEmpleado", '');
        parent::SetParameterSP("nInicioTurno", '');
        parent::SetParameterSP("nfinTurno", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

/// fin de RR-HH lobo
/// Medico lobo
    function DcantidadRegistroMedico($datos) {
        parent::ConnectionOpen("pnsReportaMedicos", "dbweb");
        parent::SetParameterSP("$1", '01');
        parent::SetParameterSP("$2", $datos["c_cod_per"]);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("icodigoEmpleado", $datos["iCodMedico"]);
        parent::SetParameterSP("fechaIngreso", $datos["fechaIni"]);
        parent::SetParameterSP("fechaSalida", $datos["fechaFinal"]);
        parent::SetParameterSP("cantidadRegistro", '');
        parent::SetParameterSP("cantidadRegistrominimo", '');
        parent::SetParameterSP("cantidadTotalMedicos", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getListaMedicoXNombre($apPat, $apMat, $nombre, $estado) {
        parent::ConnectionOpen("pnsReportaMedicos", "dbweb");
        parent::SetParameterSP("$1", '02');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $estado);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", $apPat);
        parent::SetParameterSP("$7", $apMat);
        parent::SetParameterSP("$8", $nombre);
        parent::SetParameterSP("icodigoEmpleado", '');
        parent::SetParameterSP("fechaIngreso", '');
        parent::SetParameterSP("fechaSalida", '');
        parent::SetParameterSP("cantidadRegistro", '');
        parent::SetParameterSP("cantidadRegistrominimo", '');
        parent::SetParameterSP("cantidadTotalMedicos", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function DreporteBusquedaMedico($datos, $cantidadMedicosRegistro) {
        parent::ConnectionOpen("pnsReportaMedicos", "dbweb");
        parent::SetParameterSP("$1", '03');
        parent::SetParameterSP("$2", $datos["c_cod_per"]);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("icodigoEmpleado", $datos["iCodMedico"]);
        parent::SetParameterSP("fechaIngreso", $datos["fechaIni"]);
        parent::SetParameterSP("fechaSalida", $datos["fechaFinal"]);
        parent::SetParameterSP("cantidadRegistro", $datos["cantidadRegistro"]);
        parent::SetParameterSP("cantidadRegistrominimo", $datos["cantidadRegistrominimo"]);
        parent::SetParameterSP("cantidadTotalMedicos", $cantidadMedicosRegistro);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getListaMedicoXDoc($tipoDoc, $nDoc) {
        parent::ConnectionOpen("pnsReportaMedicos", "dbweb");
        parent::SetParameterSP("$1", '04');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", $tipoDoc);
        parent::SetParameterSP("$5", $nDoc);
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("icodigoEmpleado", '');
        parent::SetParameterSP("fechaIngreso", '');
        parent::SetParameterSP("fechaSalida", '');
        parent::SetParameterSP("cantidadRegistro", '');
        parent::SetParameterSP("cantidadRegistrominimo", '');
        parent::SetParameterSP("cantidadTotalMedicos", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function getListaMedicoXCod($cod) {
        parent::ConnectionOpen("pnsReportaMedicos", "dbweb");
        parent::SetParameterSP("$1", '05');
        parent::SetParameterSP("$2", $cod);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("icodigoEmpleado", '');
        parent::SetParameterSP("fechaIngreso", '');
        parent::SetParameterSP("fechaSalida", '');
        parent::SetParameterSP("cantidadRegistro", '');
        parent::SetParameterSP("cantidadRegistrominimo", '');
        parent::SetParameterSP("cantidadTotalMedicos", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DverEmpleadoCaducaSuContratoTabla() {
        parent::ConnectionOpen("pnslistaEmpleadoCaducaContrato", "dbweb");
        parent::SetParameterSP("$1", '01');

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DprogramacionAsistenciaPersonalRRHH($datos) {
        parent::ConnectionOpen("pnslistaHorarioEmpleadosRRHH", "dbweb");
        parent::SetParameterSP("$1", '01');
        parent::SetParameterSP("$2", $datos["codigoEmpleado"]);
        parent::SetParameterSP("$3", $datos["anio"]);
        parent::SetParameterSP("$4", $datos["mes"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function dMantenimientoAreaPersona($datos) {
        parent::ConnectionOpen("pnsMantenimientoAreaPersona", "dbweb");
        parent::SetParameterSP("$1", '01');
        parent::SetParameterSP("$2", $datos["idArea"]);
        parent::SetParameterSP("$3", $datos["idPuestoEmpleado"]);
        parent::SetParameterSP("$4", $datos["estado"]);
        parent::SetParameterSP("$5", $datos["imes"]);
        parent::SetParameterSP("$6", $datos["ianio"]);
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function dActualizarProgramacionEmpleados($datos) {
        parent::ConnectionOpen("pnsMantenimientoAreaPersona", "dbweb");
        parent::SetParameterSP("$1", '02');
        parent::SetParameterSP("$2", $datos["idPreprogramacion"]);
        parent::SetParameterSP("$3", $datos["iCodigoempleado"]);
        parent::SetParameterSP("$4", $datos["imes"]);
        parent::SetParameterSP("$5", $datos["ianio"]);
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function dListaPersonal() {
        parent::ConnectionOpen("pnsListaEmpleados", "dbweb");
        parent::SetParameterSP("$1", '01');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');

        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DListaPersonalDeAsistencia($txtFechainicio, $txtFechafin) {
        parent::ConnectionOpen("pnsListaEmpleados", "dbweb");
        parent::SetParameterSP("$1", '02');
        parent::SetParameterSP("$2", $txtFechainicio);
        parent::SetParameterSP("$3", $txtFechafin);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function DverificarTurnoProgramadoIndividuar($datos) {
        parent::ConnectionOpen("pnsListaCoordinadoresArea", "dbweb");
        parent::SetParameterSP("accion", '10');
        parent::SetParameterSP("codigoEmpleado", $datos["iCodigoEmpleado"]); // codigo Empleado que va a ser programado
        parent::SetParameterSP("codigoSedeEmpresaArea", '');
        parent::SetParameterSP("iIdPreProgramacion", $datos["idPreProgramacion"]);
        parent::SetParameterSP("codigoCategoria", '');
        parent::SetParameterSP("idProgramacionPersonal", $datos["idProgramacionPersonal"]);
        parent::SetParameterSP("idTurnoAreaSede", $datos["idSedeAreaTurnoActual"]);
        parent::SetParameterSP("cadenaDatos", $datos["cadena"]);
        parent::SetParameterSP("nDias", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("numeroProgramaciones", '');
        parent::SetParameterSP("posicion", '');
        parent::SetParameterSP("numeroProgramado", '');
        parent::SetParameterSP("iIdPuestoEmpleado", '');
        parent::SetParameterSP("nInicioTurno", $datos["nInicioTurno"]);
        parent::SetParameterSP("nfinTurno", $datos["nfinTurno"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

//-------------------------------------SANDY-------------------------------------------------
//-------------------------------------------------------------------------------------------

    function DprogramacionPorArea($datos) {
        parent::ConnectionOpen("pnsProgramacionPorArea", "dbweb");
        parent::SetParameterSP("$1", "1");
        parent::SetParameterSP("$2", $datos["codigoPreProgramacion"]);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function areasPorProgramacionEmpleado($datos) {
        parent::ConnectionOpen("pnsProgramacionPorArea", "dbweb");
        parent::SetParameterSP("$1", "2");
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $datos["iCodEmpleado"]);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", $datos["nomMes"]);
        parent::SetParameterSP("$6", $datos["anio"]);


        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function programacionPorEmpleadoDetalleSede($datos) {
        parent::ConnectionOpen("pnsProgramacionPorArea", "dbweb");
        parent::SetParameterSP("$1", "3");
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $datos["iCodEmpleado"]);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", $datos["nomMes"]);
        parent::SetParameterSP("$6", $datos["anio"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function cargarTablaProgramacionEmpleadoEliminarTurno($datos) {
        parent::ConnectionOpen("pnsProgramacionPorArea", "dbweb");
        parent::SetParameterSP("$1", "4");
        parent::SetParameterSP("$2", $datos["codigoPreProgramacion"]);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function DprogramacionSeleccionadaTurno($datos) {
        parent::ConnectionOpen("pnsProgramacionPorArea", "dbweb");
        parent::SetParameterSP("$1", "5");
        parent::SetParameterSP("$2", $datos["PreProgramacion"]);
        parent::SetParameterSP("$3", $datos["codEmpleado"]);
        parent::SetParameterSP("$4", $datos["Turno"]);
        parent::SetParameterSP("$5", $datos["nomMes"]);
        parent::SetParameterSP("$6", $datos["anio"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function LprogramacionPorAreaSede($datos) {
        parent::ConnectionOpen("pnsProgramacionPorArea", "dbweb");
        parent::SetParameterSP("$1", "6");
        parent::SetParameterSP("$2", $datos["codigoPreProgramacion"]);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function cargarTablaTurnosPreProgramacion($datos) {
        parent::ConnectionOpen("pnsProgramacionPorArea", "dbweb");
        parent::SetParameterSP("$1", "4");
        parent::SetParameterSP("$2", $datos["PreProgramacion"]);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function btnEliminarProgramacoinPreProgramacionSelecionado($datos) {
        parent::ConnectionOpen("pnsProgramacionPorArea", "dbweb");
        parent::SetParameterSP("$1", "7");
        parent::SetParameterSP("$2", $datos["codigoPreProgramacion"]);
        parent::SetParameterSP("$3", $datos["iCodigoEmpleado"]);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", $datos["nomMes"]);
        parent::SetParameterSP("$6", $datos["anio"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

//-----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------- 

    function busquedaPersonalPorNombres($datos) {
        parent::ConnectionOpen("pnsAgregarPersonaEmpleadoRegistroHorarios", "dbweb");
        parent::SetParameterSP("bus", 1);
        parent::SetParameterSP("int1", '');
        parent::SetParameterSP("int2", '');
        parent::SetParameterSP("var1", '');
        parent::SetParameterSP("var2", $datos['vApellidoPaterno']);
        parent::SetParameterSP("var3", $datos['vApellidoMaterno']);
        parent::SetParameterSP("var4", $datos['vNombre']);
        parent::SetParameterSP("var5", '');
        parent::SetParameterSP("var6", '');
        parent::SetParameterSP("var7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function busquedaPersonalPorDNI($datos) {
        parent::ConnectionOpen("pnsAgregarPersonaEmpleadoRegistroHorarios", "dbweb");
        parent::SetParameterSP("bus", 2);
        parent::SetParameterSP("int1", '');
        parent::SetParameterSP("int2", '');
        parent::SetParameterSP("var1", $datos['vDNI']);
        parent::SetParameterSP("var2", '');
        parent::SetParameterSP("var3", '');
        parent::SetParameterSP("var4", '');
        parent::SetParameterSP("var5", '');
        parent::SetParameterSP("var6", '');
        parent::SetParameterSP("var7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function datosPersonalSeleccionadoXcoodinador($datos) {
        parent::ConnectionOpen("pnsAgregarPersonaEmpleadoRegistroHorarios", "dbweb");
        parent::SetParameterSP("bus", 3);
        parent::SetParameterSP("int1", '');
        parent::SetParameterSP("int2", $datos['c_cod_per']);
        parent::SetParameterSP("var1", '');
        parent::SetParameterSP("var2", '');
        parent::SetParameterSP("var3", '');
        parent::SetParameterSP("var4", '');
        parent::SetParameterSP("var5", $datos['iIdPuestoEmpleado']);
        parent::SetParameterSP("var6", '');
        parent::SetParameterSP("var7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function validarDatosContratoPersonal($datos) {
        parent::ConnectionOpen("pnsAgregarPersonaEmpleadoRegistroHorarios", "dbweb");
        parent::SetParameterSP("bus", 6);
        parent::SetParameterSP("int1", '');
        parent::SetParameterSP("int2", $datos['c_cod_per']);
        parent::SetParameterSP("var1", '');
        parent::SetParameterSP("var2", '');
        parent::SetParameterSP("var3", '');
        parent::SetParameterSP("var4", '');
        parent::SetParameterSP("var5", $datos['iIdPuestoEmpleado']);
        parent::SetParameterSP("var6", '');
        parent::SetParameterSP("var7", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function datosAreasDeCoordinador($datos) {
        parent::ConnectionOpen("pnsAgregarPersonaEmpleadoRegistroHorarios", "dbweb");
        parent::SetParameterSP("bus", 4);
        parent::SetParameterSP("int1", $datos['iIdCoordinardor']);
        parent::SetParameterSP("int2", '');
        parent::SetParameterSP("var1", '');
        parent::SetParameterSP("var2", '');
        parent::SetParameterSP("var3", '');
        parent::SetParameterSP("var4", '');
        parent::SetParameterSP("var5", '');
        parent::SetParameterSP("@imes", $datos['iMes']);
        parent::SetParameterSP("@ianio", $datos['iAnio']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function datosAreasDeEmpleado($datos) {
        parent::ConnectionOpen("pnsAgregarPersonaEmpleadoRegistroHorarios", "dbweb");
        parent::SetParameterSP("bus", 5);
        parent::SetParameterSP("int1", '');
        parent::SetParameterSP("int2", '');
        parent::SetParameterSP("var1", '');
        parent::SetParameterSP("var2", '');
        parent::SetParameterSP("var3", '');
        parent::SetParameterSP("var4", '');
        parent::SetParameterSP("var5", $datos['iIdPuestoEmpleado']);
        parent::SetParameterSP("var6", $datos['iMes']);
        parent::SetParameterSP("var7", $datos['iAnio']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function DListaTurnosAreaUsado($codigoSedeEmpresaArea) {
        parent::ConnectionOpen("pnsListaCoordinadoresArea", "dbweb");
        parent::SetParameterSP("accion", '11');
        parent::SetParameterSP("codigoEmpleadoCoordinador", '');
        parent::SetParameterSP("codigoSedeEmpresaArea", $codigoSedeEmpresaArea);
        parent::SetParameterSP("iIdPreProgramacion", '');
        parent::SetParameterSP("codigoCategoria", '');
        parent::SetParameterSP("idProgramacionPersonal", '');
        parent::SetParameterSP("idTurnoAreaSede", '');
        parent::SetParameterSP("cadenaDatos", '');
        parent::SetParameterSP("nDias", '');
        parent::SetParameterSP("mes", '');
        parent::SetParameterSP("anio", '');
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("numeroProgramaciones", '');
        parent::SetParameterSP("posicion", '');
        parent::SetParameterSP("numeroProgramado", '');
        parent::SetParameterSP("iIdPuestoEmpleado", '');
        parent::SetParameterSP("nInicioTurno", '');
        parent::SetParameterSP("nfinTurno", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DeliminarTurnoPersona($datos) {
        parent::ConnectionOpen("pnsListaPersonalARegularizar", "dbweb");
        parent::SetParameterSP("opt", '3');
        parent::SetParameterSP("fdf", '');
        parent::SetParameterSP("@cboRegularizado", '');
        parent::SetParameterSP("fechaFinal", '');
        parent::SetParameterSP("1", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("idMarcacionPersonal", $datos["idMarcacionPersonal"]);
        parent::SetParameterSP("txtApePaternoPaciente", '');
        parent::SetParameterSP("txtApeMaternoPaciente", '');
        parent::SetParameterSP("txtNombrePaciente", $datos["idTxtAreaObservacion"]);
        parent::SetParameterSP("idCodigoEmpleado", '');
        parent::SetParameterSP("txtFecha", '');
        parent::SetParameterSP("horaInicio", '0');
        parent::SetParameterSP("horaFin", '0');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DreportePerActElimInsert($datos) {
        parent::ConnectionOpen("pnsListaPersonalARegularizar", "dbweb");
        parent::SetParameterSP("opt", '10');
        parent::SetParameterSP("fdf", '');
        parent::SetParameterSP("@cboRegularizado", '');
        parent::SetParameterSP("fechaFinal", '');
        parent::SetParameterSP("1", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("anno", $datos["iAnio"]);
        parent::SetParameterSP("txtApePaternoPaciente", '');
        parent::SetParameterSP("txtApeMaternoPaciente", '');
        parent::SetParameterSP("txtNombrePaciente", '');
        parent::SetParameterSP("idCodigoEmpleado", $datos["iMes"]);
        parent::SetParameterSP("txtFecha", '');
        parent::SetParameterSP("horaInicio", '0');
        parent::SetParameterSP("horaFin", '0');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DbuscarEmpleadosAreasNombre($datos) {
        parent::ConnectionOpen("pnsEmpleadoBusqueda", "dbweb");
        parent::SetParameterSP("$1", '13');
        parent::SetParameterSP("$2", $datos["p2"]); //c_cod_per
        parent::SetParameterSP("$3", $datos["p1"]); //comboTipoEstados
        parent::SetParameterSP("$4", $datos["p6"]); //comboTipoDocumentos
        parent::SetParameterSP("$5", $datos["p7"]); //nroDoc
        parent::SetParameterSP("$6", $datos["p3"]); //apellidoPaterno
        parent::SetParameterSP("$7", $datos["p4"]); //apellidoMaterno
        parent::SetParameterSP("$8", $datos["p5"]); //nombres
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DbuscaEmpleadoHorario($apPat, $apMat, $nombre, $estado, $dFechaInicio, $dFechaFin) {
        parent::ConnectionOpen("pnsEmpleadoBusqueda", "dbweb");
        parent::SetParameterSP("$1", '13');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $estado);
        parent::SetParameterSP("$4", $dFechaInicio);
        parent::SetParameterSP("$5", $dFechaFin);
        parent::SetParameterSP("$6", $apPat);
        parent::SetParameterSP("$7", $apMat);
        parent::SetParameterSP("$8", $nombre);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function DbuscarEmpleadoHorarioSusAreas($datos) {
        parent::ConnectionOpen("pnsEmpleadoBusqueda", "dbweb");
        parent::SetParameterSP("$1", '14');
        parent::SetParameterSP("$2", $datos["codPer"]);
        parent::SetParameterSP("$3", $datos["codEmpleado"]);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /*     * ************************************************ */

    function getBuscaMedicoXCod($cod) {
        parent::ConnectionOpen("pnsBuscaMedico", "dbweb");
        parent::SetParameterSP("$1", '01');
        parent::SetParameterSP("$2", $cod);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int2", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function getBuscaMedicoXDoc($tipoDoc, $nDoc) {
        parent::ConnectionOpen("pnsBuscaMedico", "dbweb");
        parent::SetParameterSP("$1", '03');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", $tipoDoc);
        parent::SetParameterSP("$5", $nDoc);
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int2", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function DBuscaMedico($apPat, $apMat, $nombre, $estado) {
        parent::ConnectionOpen("pnsBuscaMedico", "dbweb");
        parent::SetParameterSP("$1", '02');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $estado);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", $apPat);
        parent::SetParameterSP("$7", $apMat);
        parent::SetParameterSP("$8", $nombre);
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int2", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    /*     * *************************************************** */

    function DcargarTabladePersonaReemplazo($datos) {
        parent::ConnectionOpen("pnsListaPersonalARegularizar", "dbweb");
        parent::SetParameterSP("opt", '11');
        parent::SetParameterSP("@c_cod_per", '');
        parent::SetParameterSP("@cboRegularizado", '');
        parent::SetParameterSP("@txtFechaIni", '');
        parent::SetParameterSP("@txtFechaFinal", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("iIdTurnosAreaSede", $datos["iIdTurnosAreaSede"]);
        parent::SetParameterSP("txtApePaternoPaciente", '');
        parent::SetParameterSP("txtApeMaternoPaciente", '');
        parent::SetParameterSP("txtNombrePaciente", '');
        parent::SetParameterSP("idCodigoEmpleado", $datos["iIdCodigoempleado"]);
        parent::SetParameterSP("txtFecha", $datos["dFechaProgramada"]);
        parent::SetParameterSP("horaInicio", $datos["fHoraInicio"]);
        parent::SetParameterSP("horaFin", $datos["fHoraFin"]);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DguardarEmpleadoReemplazador($datos) {
        parent::ConnectionOpen("pnsListaPersonalARegularizar", "dbweb");
        parent::SetParameterSP("opt", '12');
        parent::SetParameterSP("@c_cod_per", '');
        parent::SetParameterSP("iIdSedeEmpresaArea", $datos["iIdSedeEmpresaArea"]);
        parent::SetParameterSP("@txtFechaIni", '');
        parent::SetParameterSP("@txtFechaFinal", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("iIdTurnosAreaSede", $datos["iIdTurnosAreaSede"]);
        parent::SetParameterSP("txtApePaternoPaciente", '');
        parent::SetParameterSP("txtApeMaternoPaciente", '');
        parent::SetParameterSP("txtNombrePaciente", '');
        parent::SetParameterSP("iidPuestoEmpleado", $datos["iidPuestoEmpleado"]);
        parent::SetParameterSP("txtFecha", $datos["dFechaProgramada"]);
        parent::SetParameterSP("horaInicio", $datos["iIdTipoProgramacion"]);
        parent::SetParameterSP("horaFin", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DhoraExtrasTrabajadas($datos) {
        parent::ConnectionOpen("pnsListaPersonalARegularizar", "dbweb");
        parent::SetParameterSP("opt", '13');
        parent::SetParameterSP("@c_cod_per", $datos["c_cod_per"]);
        parent::SetParameterSP("iIdSedeEmpresaArea", '');
        parent::SetParameterSP("@txtFechaIni", '');
        parent::SetParameterSP("@txtFechaFinal", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("iIdTurnosAreaSede", '');
        parent::SetParameterSP("txtApePaternoPaciente", '');
        parent::SetParameterSP("txtApeMaternoPaciente", '');
        parent::SetParameterSP("txtNombrePaciente", '');
        parent::SetParameterSP("iidPuestoEmpleado", '');
        parent::SetParameterSP("txtFecha", $datos["cadenaStrin"]);
        parent::SetParameterSP("horaInicio", '0');
        parent::SetParameterSP("horaFin", '0');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DabrirPopapAsignacionDeTurnosAsignados($datos) {
        parent::ConnectionOpen("reporteEmpleadosReemplazanTurnos", "dbweb");
        parent::SetParameterSP("opt", '01');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("iidPuestoEmpleado", $datos["iidPuestoEmpleado"]);
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DsedesHospital() {
        parent::ConnectionOpen("reporteEmpleadosReemplazanTurnos", "dbweb");
        parent::SetParameterSP("opt", '02');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DdescripcionCboSedeArea($datos) {
        parent::ConnectionOpen("reporteEmpleadosReemplazanTurnos", "dbweb");
        parent::SetParameterSP("opt", '03');
        parent::SetParameterSP("varchar", $datos["cboSucursal"]);
        parent::SetParameterSP("int", $datos["iidPuestoEmpleado"]);
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("varchar", $datos["codigoPersona"]);
        parent::SetParameterSP("varchar", $datos["fecha"]);
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DdescripcionCboSedeAreaTurno($iIdSedeEmpresaArea) {
        parent::ConnectionOpen("reporteEmpleadosReemplazanTurnos", "dbweb");
        parent::SetParameterSP("opt", '04');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("int", $iIdSedeEmpresaArea);
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DguardarNuevaProgramacionReemplanzo($datos) {
        parent::ConnectionOpen("reporteEmpleadosReemplazanTurnos", "dbweb");
        parent::SetParameterSP("opt", '05');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("int", $datos["iIdSedeEmpresaArea"]);
        parent::SetParameterSP("int", $datos["iIdTurnosAreaSede"]);
        parent::SetParameterSP("int", $datos["idPuestoEmpleado"]);
        parent::SetParameterSP("int", $datos["iIdTipoProgramacion"]);
        parent::SetParameterSP("varchar", $datos["fechaProgramada"]);
        parent::SetParameterSP("varchar", $datos["txtAreaVDescripcionMotivo"]);
        parent::SetParameterSP("int", $datos["idMotivoReProgramacion"]);
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DbuscarMedicosCentroCostosHorarios($datos) {
        parent::ConnectionOpen("pnsBuscaMedico", "dbweb");
        parent::SetParameterSP("$1", '05');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("int", $datos["iCodigoCentroCosto"]);
        parent::SetParameterSP("int2", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function DbuscarLasSedes($datos) {
        parent::ConnectionOpen("reporteEmpleadosReemplazanTurnos", "dbweb");
        parent::SetParameterSP("opt", '02');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DbuscarPuestoEmpleado($datos) {
        parent::ConnectionOpen("reporteEmpleadosReemplazanTurnos", "dbweb");
        parent::SetParameterSP("opt", '06');
        parent::SetParameterSP("varchar", $datos["CodigoPersona"]);
        parent::SetParameterSP("int", $datos["iIdSedeEmpresaArea"]);
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DcboTipoProgramacion($datos) {
        parent::ConnectionOpen("reporteEmpleadosReemplazanTurnos", "dbweb");
        parent::SetParameterSP("opt", '07');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("int", $datos["idPuestoEmpleadoArea"]);
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DBuscarPuesto($datos) {
        parent::ConnectionOpen("reporteEmpleadosReemplazanTurnos", "dbweb");
        parent::SetParameterSP("opt", '09');
        parent::SetParameterSP("varchar1", $datos["idCodigoPersona"]);
        parent::SetParameterSP("int1", '');
        parent::SetParameterSP("int2", '');
        parent::SetParameterSP("int3", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("varchar2", $datos["dFecha"]);
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DSedeAreaSeleccionada($datos) {
        parent::ConnectionOpen("reporteEmpleadosReemplazanTurnos", "dbweb");
        parent::SetParameterSP("opt", '10');
        parent::SetParameterSP("varchar1", $datos["cboSucursal"]);
        parent::SetParameterSP("int1", $datos["IdArea"]);
        parent::SetParameterSP("int2", $datos["iidPuestoEmpleado"]);
        parent::SetParameterSP("int3", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("varchar2", '');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DguardarPersonalTurnoRegularizar($datos) {
        parent::ConnectionOpen("reporteEmpleadosReemplazanTurnos", "dbweb");
        parent::SetParameterSP("opt", '08');
        parent::SetParameterSP("varchar1", $datos["CodigoPersona"]);
        parent::SetParameterSP("int1", $datos["iIdSedeEmpresaArea"]);
        parent::SetParameterSP("int2", $datos["iIdTurnosAreaSede"]);
        parent::SetParameterSP("int3", $datos["iidPuestoEmpelado"]);
        parent::SetParameterSP("int4", $datos["idTipoProgramacion"]);
        parent::SetParameterSP("varchar2", $datos["dFecha"]);
        parent::SetParameterSP("varchar3", $datos["txtAreaVDescripcionMotivo"]);
        parent::SetParameterSP("int", $datos["idMotivoReProgramacion"]);
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function DmodalidadContrato() {
        parent::ConnectionOpen("pnsListaCoordinadoresArea", "dbweb");
        parent::SetParameterSP("accion", '12');
        parent::SetParameterSP("codigoEmpleadoCoordinador", '');
        parent::SetParameterSP("codigoSedeEmpresaArea", '');
        parent::SetParameterSP("codigoSubArea", '');
        parent::SetParameterSP("codigoCategoria", '');
        parent::SetParameterSP("idProgramacionPersonal", '');
        parent::SetParameterSP("idTurnoAreaSede", '');
        parent::SetParameterSP("cadenaDatos", '');
        parent::SetParameterSP("nDias", '');
        parent::SetParameterSP("mes", $mes);
        parent::SetParameterSP("anio", $anio);
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("numeroProgramaciones", '');
        parent::SetParameterSP("posicion", '');
        parent::SetParameterSP("numeroProgramado", '');
        parent::SetParameterSP("iIdPuestoEmpleado", '');
        parent::SetParameterSP("nInicioTurno", '');
        parent::SetParameterSP("nfinTurno", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DreporteAsistenciaMedico($datos) {
        parent::ConnectionOpen("pnsBuscaMedico", "dbweb");
        parent::SetParameterSP("$1", '06');
        parent::SetParameterSP("$2", $datos["codPer"]);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", $datos["fechaIni"]);
        parent::SetParameterSP("$8", $datos["fechaFinal"]);
        parent::SetParameterSP("int1", $datos["iidPuesto"]);
        parent::SetParameterSP("int2", $datos["iidCentroCosto"]);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function DdescripcionCboSedeArea1($datos) {
        parent::ConnectionOpen("reporteEmpleadosReemplazanTurnos", "dbweb");
        parent::SetParameterSP("opt", '11');
        parent::SetParameterSP("varchar", $datos["cboSucursal"]);
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("varchar", $datos["codigoPersona"]);
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DMotivoReProgramacion() {
        parent::ConnectionOpen("reporteEmpleadosReemplazanTurnos", "dbweb");
        parent::SetParameterSP("opt", '12');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DvalidarQueNoExitaProgramacion($datos) {
        parent::ConnectionOpen("reporteEmpleadosReemplazanTurnos", "dbweb");
        parent::SetParameterSP("opt", '13');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("int", $datos["idContrato"]);
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("varchar", $datos["fechaInicioVacacion"]);
        parent::SetParameterSP("varchar", $datos["fechaFinVacacion"]);
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function DeliminarProgramacion($datos) {
        parent::ConnectionOpen("reporteEmpleadosReemplazanTurnos", "dbweb");
        parent::SetParameterSP("opt", '14');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("int", $datos["iIdProgramacionEmpleados"]);
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("varchar", '');
        parent::SetParameterSP("int", '');
        parent::SetParameterSP("user", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function DlistaTurnosAreaExcel($codigoSedeEmpresaArea, $anno, $mes) {
        parent::ConnectionOpen("pnsListaCoordinadoresArea", "dbweb");
        parent::SetParameterSP("accion", '13');
        parent::SetParameterSP("codigoEmpleadoCoordinador", '');
        parent::SetParameterSP("codigoSedeEmpresaArea", $codigoSedeEmpresaArea);
        parent::SetParameterSP("iIdPreProgramacion", '');
        parent::SetParameterSP("codigoCategoria", '');
        parent::SetParameterSP("idProgramacionPersonal", '');
        parent::SetParameterSP("idTurnoAreaSede", '');
        parent::SetParameterSP("cadenaDatos", '');
        parent::SetParameterSP("nDias", '');
        parent::SetParameterSP("mes", $mes);
        parent::SetParameterSP("anio", $anno);
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("numeroProgramaciones", '');
        parent::SetParameterSP("posicion", '');
        parent::SetParameterSP("numeroProgramado", '');
        parent::SetParameterSP("iIdPuestoEmpleado", '');
        parent::SetParameterSP("nInicioTurno", '');
        parent::SetParameterSP("nfinTurno", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

}

?>
