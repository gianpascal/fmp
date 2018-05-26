<?php

require_once("../../../pholivo/Html1.php");
require_once("../../../pholivo/Html.php");
require_once("../../clogica/LRrhh.php");
require_once("../../clogica/LCronograma.php");
require_once("../../../pholivo/tablaDHTMLX.php");
require_once("ActionAdmision.php");
require_once("ActionPersona.php");

class ActionRrhh {

    public function __construct() {
        
    }

    /*     * ************************** GESTION DEL ARBOL DE CENTRO DE COSTOS *************************************** */

    public function mostrarCcostos() {
        require_once("../../cvista/rrhh/consultarPersonal.php");
    }

    public function verItemCC($cod) {
        $oLCronograma = new LCronograma();
//echo"ver".$cod."--//";
        $result = $oLCronograma->verItemCC($cod);

        return $result;
    }

    public function formCCostos($cod) {
        $p = $this->verItemCC($cod); //Datos principales en nsmCentroCostos
        $cCod = $p['0']['0'];
        $vDescripcion = $p['0']['1'];
        $iNivel = $p['0']['2'];
        $vAbreviatura = $p['0']['3'];
        $bActivo = $p['0']['4'];
        $vOservacion = $p['0']['5'];
        $bUltimo = $p['0']['6'];

        $oLCronograma = new LCronograma();
        $q = $oLCronograma->verItemPadre($cod);
        $cCodP = $q['0']['0'];
        $vDescripP = $q['0']['1'];
        $iNivelP = $q['0']['2'];
        $respuesta = $cCod . "|" . $vDescripcion . "|" . $iNivel . "|" . $vAbreviatura . "|" . $bActivo . "|" . $vOservacion . "|" . $bUltimo . "|" . $cCodP . "|" . $vDescripP . "|" . $iNivelP . "|";

        return $respuesta;
    }

    public function traeIdCC($cod) {
        $oLCronograma = new LCronograma();
//echo "tratando de conseguir el ID".$cod."*-*";
        $r = $oLCronograma->getIdActualCentroCosto($cod);
        $id = $r['0']['0'];
        $result = $id . "|";
//echo $result;
        return $result;
    }

    public function traeCodigoCC($pId) {
        $oLCronograma = new LCronograma();
//echo "tratando de conseguir el ID".$cod."*-*";
        $r = $oLCronograma->getCodigoActualCentroCosto($pId);
        $id = $r['0']['0'];
        $result = $id;
        return $result;
    }

    public function traeNombreCC($cod) {
        $oLCronograma = new LCronograma();
//echo "tratando de conseguir el ID".$cod."*-*";
        $r = $oLCronograma->getNombreCentroCosto($cod);
        $id = $r['0']['0'];
        $result = $id . "|";
//echo $result;
        return $result;
    }

    public function nuevoItemHijoCC($id, $descripcion, $abrev, $observ) {
//          session_start();
//          $usuario=strtoupper($_SESSION['login_user']);
//$opcNuevo=1;
        $opcAccion = 1;
        $oLCronograma1 = new LCronograma();
        $nuevoCodigo = $oLCronograma1->getCodigoNuevoCentroCosto($id);

        session_start();
        $usuario = strtoupper($_SESSION['login_user']);
        $oLCronograma = new LCronograma();
        $ncod = $nuevoCodigo;
// echo"Pasando a otra funcion";
        $oLCronograma->getDatosActualCentroCosto($opcNuevo, $opcAccion, $ncod, $descripcion, $usuario, $abrev, 1, $observ);
        $oLCronograma2 = new LCronograma();
        $oLCronograma2->crearArbolCentroCostos();
        $oLCronograma3 = new LCronograma();
        $oLCronograma3->crearArbolCentroCostosCompleto();
    }

    public function editaItemCC($id, $descripcion, $abrev, $estado, $observ, $cod) {
        session_start();
        $usuario = strtoupper($_SESSION['login_user']);
        $oLCronograma = new LCronograma();
        echo"editndo" . $id . "--descripcion//" . $descripcion . "***";
        if ($id == '') {
            $oLCronograma->getDatosActualCentroCosto('', 3, $cod, $descripcion, $usuario, $abrev, $estado, $observ);
        } else {
            $oLCronograma->getDatosActualCentroCosto('', 3, $id, $descripcion, $usuario, $abrev, $estado, $observ);
        }

        $oLCronograma2 = new LCronograma();
        $oLCronograma2->crearArbolCentroCostos();
        $oLCronograma3 = new LCronograma();
        $oLCronograma3->crearArbolCentroCostosCompleto();
    }

    public function eliminaItemCC($id) {
        $opcAccion = 2;
        $oLCronograma = new LCronograma();
        echo"eliminando" . $id . "--//";
        $oLCronograma->getDatosActualCentroCosto('', $opcAccion, $id, '', '', '', '', '');
        $oLCronograma2 = new LCronograma();
        $oLCronograma2->crearArbolCentroCostos();
        $oLCronograma3 = new LCronograma();
        $oLCronograma3->crearArbolCentroCostosCompleto();
    }

//NO SON LLAMADAS EN PERSONAL.JS
    public function getArbolCentroCostos() {

        $oLCronograma = new LCronograma();
        $oLCronograma->crearArbolCentroCostos();
        $oLCronograma1 = new LCronograma();
        $oLCronograma1->crearArbolCentroCostosCompleto();
    }

    public function actualizaCcostos() {
        $oLCronograma1 = new LCronograma();
        $oLCronograma1->crearArbolCentroCostosCompleto();
        $oLCronograma = new LCronograma();
        $oLCronograma->crearArbolCentroCostos();

        require_once("../../cvista/rrhh/actualizarCCostos.php");
    }

    /*     * ********************************** REGISTRO DE NUEVO EMPLEADO ***************************************** */
    /* --------------- CARGA DE ARBOLES --------------- */

    public function mostrarMenuCCostoPersonal() {
        $tablaEmpleados = $this->resultadoEmpleados();
        $o_LPersona = new ActionPersona();
        $funcion = '';
        $comboTipoDocumentos = $o_LPersona->comboTipoDocumento('1');

        require_once("../../cvista/rrhh/consultarPersonal.php");
    }

    public function mostrarMenuRegistro($arrayParametros) {
        require_once("../../cvista/rrhh/registrarPersonal.php");
    }

////por peche 26 de febrero para mantenimiento de contrato
    public function aMostrarContratos($c_cod_per, $nombre, $codigoEmpleado) {
        //echo $c_cod_per;
        require_once("../../cvista/rrhh/vistaContratos.php");
    }

    public function acargarTablaContratos($iCodigoEmpleado) {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayContratos = $oLRrhh->lcargarTablaContratos($iCodigoEmpleado);
        if (isset($_SESSION["permiso_formulario_servicio"][121]["VER_DESCANSO"]) && ($_SESSION["permiso_formulario_servicio"][121]["VER_DESCANSO"] == 1)) {
            $verDescanso = "false";
        } else {
            $verDescanso = "true";
        }
        if (isset($_SESSION["permiso_formulario_servicio"][121]["VER_CONTRATO"]) && ($_SESSION["permiso_formulario_servicio"][121]["VER_CONTRATO"] == 1)) {
            $verContrato = "false";
        } else {
            $verContrato = "true";
        }

        $arrayCabecera = array("0" => "id", "1" => "Puesto", "2" => "Inicio", "3" => "Fin", "4" => "Anulacion", "5" => "sueldo", "6" => "estado", "7" => "Tipo", "8" => "Tipo", "9" => "desc", "10" => "ver");
        $arrayTamano = array("0" => "30", "1" => "*", "2" => "70", "3" => "70", "4" => "70", "5" => "50", "6" => "70", "7" => "70", "8" => "30", "9" => "30", "10" => "30");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "ro", "8" => "ro", "9" => "img", "10" => "img");
        $arrayCursor = array("0" => "default", "1" => "center", "2" => "default", "3" => "center", "4" => "center", "5" => "center", "6" => "center", "7" => "center", "8" => "center", "9" => "center", "10" => "center");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => "false", "5" => "false", "6" => "true", "7" => "false", "8" => "false", "9" => $verDescanso, "10" => $verContrato);
        $arrayAling = array("0" => "center", "1" => "center", "2" => "center", "3" => "center", "4" => "center", "5" => "center", "6" => "center", "7" => "center", "8" => "center", "9" => "center", "10" => "center");

        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayContratos, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function acargarTablaAreaPuestoEmpleado($idPuestoEmpleado, $estadoContrato) {
        if ($estadoContrato == 1) {
            $accion = false;
        } else {
            $accion = true;
        }
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayContratos = $oLRrhh->lcargarTablaAreaPuestoEmpleado($idPuestoEmpleado);

        $arrayCabecera = array("0" => "id", "1" => "Sede", "2" => "Area", "3" => "Estado", "4" => "Accion");
        $arrayTamano = array("0" => "30", "1" => "*", "2" => "*", "3" => "70", "4" => "70");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "img");
        $arrayCursor = array("0" => "default", "1" => "center", "2" => "default", "3" => "center", "4" => "center");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => $accion);
        $arrayAling = array("0" => "center", "1" => "center", "2" => "center", "3" => "center", "4" => "center");

        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayContratos, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function aMantenimientoContrato($datos) {
        $o_LRrhh = new LRrhh();
        $fechaActual = date("d/m/Y");
        if ($datos['idContrato'] == '' && $datos['idPuestoEmpleado'] == '') {
            $idContrato = '';
            $idPuesto = '';
            $vNombrePuesto = '';
            $vNombreCentroCosto = '';
            $inicio = '';
            $fin = '';
            $dFechaAnulacionContrato = '';
            $vdescripcionAnulaContrato = '';
            $iIdModalidadContrato = '0';
            $iIdTipoSueldo = '0';
            $nSueldo = '';
            $iIdTipoProgramacion = '0';
            $bEstado = '1';
            $verAnulacion = 'none';
            $disable = '';
            $anular = false;
            $grabar = true;
        } else {
            $arrayContrato = $o_LRrhh->lGetDetalleContrato($datos['idContrato'], $datos['idPuestoEmpleado']);
            $idContrato = $datos['idContrato'];
            $idPuesto = $arrayContrato['iidPuesto'];
            $vNombrePuesto = $arrayContrato['vNombrePuesto'];
            $vNombreCentroCosto = $arrayContrato['vDescripcionCcosto'];
            $inicio = $arrayContrato['dFechaInicial'];
            $fin = $arrayContrato['dFechaFin'];
            $dFechaAnulacionContrato = $arrayContrato['dFechaAnulacionContrato'];
            $vdescripcionAnulaContrato = $arrayContrato['vdescripcionAnulaContrato'];
            $iIdModalidadContrato = $arrayContrato['iIdModalidadContrato'];
            $iIdTipoSueldo = $arrayContrato['iIdTipoSueldo'];
            $nSueldo = $arrayContrato['nSueldo'];
            $iIdTipoProgramacion = $arrayContrato['iIdTipoProgramacion'];
            $bEstado = $arrayContrato['bEstado'];
            if ($bEstado == 1) {
                $disable = '';
                $anular = true;
                $grabar = true;
                $verAnulacion = 'none';
            } else {
                $disable = "disabled=''";
                $anular = false;
                $grabar = false;
                $verAnulacion = '';
            }
        }


        $arrayComboModalidaContrato = $o_LRrhh->comboModalidadContrato();
        $o_ComboModalidadContrato = new Combo($arrayComboModalidaContrato);
        $optionsHTML = $iIdModalidadContrato;
        $comboModalidadContrato = $o_ComboModalidadContrato->getOptionsHTML($optionsHTML);
        /////////////////////////////////////////////////
        $arrayComboTipoSueldo = $o_LRrhh->comboTipoSueldo();
        $o_ComboTipoSueldo = new Combo($arrayComboTipoSueldo);
        $optionsHTML = $iIdTipoSueldo;
        $comboTipoSueldo = $o_ComboTipoSueldo->getOptionsHTML($optionsHTML);
        ////////////////////////////////////
        $arrayComboTipoProgramacion = $o_LRrhh->comboTipoProgramacion();
        $o_ComboTipoProgramacion = new Combo($arrayComboTipoProgramacion);
        $optionsHTML = $iIdTipoProgramacion;
        $comboTipoProgramacion = $o_ComboTipoProgramacion->getOptionsHTML($optionsHTML);

        require_once("../../cvista/rrhh/vistaMantenimeintoContratos.php");
    }

    public function aBuscarAreas($funcion) {
        $o_LRrhh = new LRrhh();
        $comboSucursal = $o_LRrhh->listaSucursal('0110073', '');
        require_once("../../cvista/rrhh/vistaBuscarArea.php");
    }

    public function aAsignarPuestoEmpleadoArea($datos) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->lAsignarPuestoEmpleadoArea($datos);
        return $resultado;
    }

    public function aEliminarPuestoEmpleadoArea($datos) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->lEliminarPuestoEmpleadoArea($datos);
        return $resultado;
    }

//////////    


    public function mostrarPuestosEmpleados($iidEmpleado) {
        $o_LRrhh = new LRrhh();
        $arrayCombo = $o_LRrhh->seleccionarCategoria();
        $o_Combo = new Combo($arrayCombo);
        $optionsHTML = '0';
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        $iidPuestoEmpleado = '';
        $tablaPeriodos = $this->tablaPeriodos($iidPuestoEmpleado);
        $comboContrato = $o_LRrhh->listaModalidadContrato();
        $comboSucursal = $o_LRrhh->listaSucursal('0110073', ''); //id de la empresa HMLO -> 0110073
        $tipoSueldo = $o_LRrhh->listaTipoSueldo();
        $idEmpMod = "";
        $modlidad = "";
        $sueldo = "";
        $fechini = "";
        $fechfin = "";
        $flag1 = "block";
        $flag2 = "none";
        $flag3 = "none";

        require_once("../../cvista/rrhh/puestoEmpleado.php");
    }

//    public function mostrarTablaPuestosEmpleados($datos) {
//        $o_LRrhh=new LRrhh();
//        $tablaPuestosEmpleados=$this->tablaPuestoEmpleado($datos);
//        return $tablaPuestosEmpleados;
//    }
    public function mostrarTablaPuestosEmpleados($iidEmpleado) {
        $o_LRrhh = new LRrhh();
        $tablaPuestosEmpleados = $this->tablaPuestoEmpleado($iidEmpleado);
        return $tablaPuestosEmpleados;
    }

    public function modalidadContrato($iidEmpleado) {
        $o_LRrhh = new LRrhh();
        $resultado = $this->modalidadContrato($iidEmpleado);
        return $resultado;
    }

    public function tablaPeriodos($iidPuestoEmpleado) {
//echo $iidEmpleado;
        $o_LRrhh = new LRrhh();
        if ($iidPuestoEmpleado == '') {
            $arrayFilas = array();
        } else {
            $arrayFilas = $o_LRrhh->tablaPeriodos($iidPuestoEmpleado);
        }
//print_r($arrayFilas);
        $funcion = '';
        $arrayTipo = array("2" => "c", "3" => "c", "5" => "c", "6" => "h", "7" => "c");
        $arrayColorEstado = array("0" => "6", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9");

        $arrayCabecera = array("2" => "Inicio", "3" => "Fin", "5" => "Estado", "6" => "...", "7" => "...");

        $o_Html = new Tabla1($arrayCabecera, 5, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onclick', $funcion, 0, $arrayTipo, 4, $arrayColorEstado);
        $o_Html->setColumnasOrdenar(array("2", "3", "4"));
        return $o_Html->getTabla();
    }

    public function ventanaCambiarEstadoPuestoEmpleado($iidPuestoEmpleado, $fechaIni, $fechaFin) {
        $o_LRrhh = new LRrhh();
        $arrayFilas = $o_LRrhh->listaEstadoPuestoEmpleado($iidPuestoEmpleado);
        $n = count($arrayFilas);
        if ($n == 0) {
            $inicio = $fechaIni;
            $fin = $fechaFin;
            $activo = '0';
            $checked = '';
            $periodoPuesto = '';
        } else {
            $inicio = $arrayFilas[0][2];
            $fin = $arrayFilas[0][3];
            $activo = $arrayFilas[0][5];
            $checked = 'checked';
            $periodoPuesto = $arrayFilas[0][0];
        }
        require_once("../../cvista/rrhh/ventanaCambiarEstadoPuestoEmpleado.php");
    }

    public function ventanaEditarPeriodos($iIdPeriodo) {
        $o_LRrhh = new LRrhh();
        $array = $o_LRrhh->ventanaEditarPeriodos($iIdPeriodo);
        $inicio = $array[0][2];
        $fin = $array[0][3];
        $activo = $array[0][4];
        if ($activo == 1) {
            $checked = 'checked';
        } else {
            $checked = '';
        }

        $periodoPuesto = $array[0][0];
        require_once ("../../cvista/rrhh/vistaEditarPeriodos.php");
    }

    public function cambiarEstadoPuestoEmpleado($dInicio, $dFin, $bEstado, $iIdPuestoEmpleado, $periodoPuestoEmpleado) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->cambiarEstadoPuestoEmpleado($dInicio, $dFin, $bEstado, $iIdPuestoEmpleado, $periodoPuestoEmpleado);
///print_r($resultado);
        return $resultado;
    }

    public function editarPeriodoPuesto($dInicio, $dFin, $bEstado, $iIdPuestoEmpleado, $periodoPuestoEmpleado) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->editarPeriodoPuesto($dInicio, $dFin, $bEstado, $iIdPuestoEmpleado, $periodoPuestoEmpleado);
///print_r($resultado);
        $mensaje = "<p style='color: red; font-size: 12px;'>Verifique que las fechas sean correctas</p>";
        if ($resultado[0][0] == "ok") {
            $mensaje = $resultado[0][0];
        }
        return $mensaje;
    }

//    public function tablaPuestoEmpleado($datos) {
//        //echo $iidEmpleado;
//        $o_LRrhh=new LRrhh();
//        $o_TablaHtmlx = new tablaDHTMLX();
//        $arrayFilas = $o_LRrhh->listaPuestosEmpleado($datos);
//
//        if($datos["p2"]=="NCC") {
//            $arrayCabecera=array(0=>"iIdPuesto",1=>"Nombre Puesto",2=>"Estado",3=>"estado");
//            $arrayTamano=array(0=>"50",1=>"300",2=>"80",3=>"50");
//            $arrayTipo=array(0=>"ro",1=>"ro",2=>"ro",3=>"ro");
//            $arrayCursor=array(0=>"default",1=>"pointer",2=>"pointer",3=>"default");
//            $arrayHidden=array(0=>"true",1=>"false",2=>"false",3=>"true");
//            $arrayAling=array(0=>"left",1=>"left",2=>"left",3=>"left");
//        }else {
//            $arrayCabecera=array(0=>"iIdPuesto",1=>"Nombre Puesto",2=>"Centro Costo",3=>"Estado",4=>"estado");
//            $arrayTamano=array(0=>"50",1=>"300",2=>"300",3=>"80",4=>"50");
//            $arrayTipo=array(0=>"ro",1=>"ro",2=>"ro",3=>"ro",4=>"ro");
//            $arrayCursor=array(0=>"default",1=>"pointer",2=>"pointer",3=>"default",4=>"default");
//            $arrayHidden=array(0=>"true",1=>"false",2=>"false",3=>"false",4=>"true");
//            $arrayAling=array(0=>"left",1=>"left",2=>"left",3=>"left",4=>"left");
//        }
//        return $o_TablaHtmlx->generaTabla($arrayCabecera,$arrayFilas,$arrayTamano,$arrayTipo,$arrayCursor,$arrayHidden,$arrayAling);
//    }
    public function tablaPuestoEmpleado($iidEmpleado) { ///OBSERVACION: TODO EMPLEADO DEBE TENER UNA SOLA CATEGORIA PUESTO
//echo $iidEmpleado;
        $o_LRrhh = new LRrhh();
        $arrayFilas = $o_LRrhh->listaPuestosEmpleado($iidEmpleado);
        $funcion = 'detallePuestoEmpleado';

        $arrayTipo = array("6" => "c", "1" => "c", "8" => "c", "2" => "c", "3" => "c", "4" => "c", "7" => "h", "9" => "c");
        $arrayColorEstado = array("0" => "6", "2" => "2", "3" => "3");

        $arrayCabecera = array("6" => "Nro", "1" => "PUESTO", "8" => "CATEGORIA PUESTO", "2" => "C. COSTO", "3" => "SUCURSAL", "4" => "AREA", "7" => "ESTADO", "9" => "...");

        $o_Html = new Tabla1($arrayCabecera, 8, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onclick', $funcion, 0, $arrayTipo, 5, $arrayColorEstado);
        $o_Html->setColumnasOrdenar(array("1", "2"));
        return $o_Html->getTabla();


//        $arrayTipo = array("4" => "c", "1" => "c", "2" => "c", "5" => "c", "6" => "c");
//        $arrayColorEstado = array("0" => "6", "2" => "2", "3" => "3");
//
//        $arrayCabecera = array("4" => "Nro", "1" => "PUESTO", "2" => "C. COSTO", "5" => "ESTADO", "6" => "...");
//
//        $o_Html = new Tabla1($arrayCabecera, 8, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onclick', $funcion, 0, $arrayTipo, 3, $arrayColorEstado);
//        $o_Html->setColumnasOrdenar(array("1", "2"));
//        return $o_Html->getTabla();
//                foreach ($array as $fila) {
//            // $array[$j][4]=$estado[$array[$j][0]];
//            $array[$j][6] = $j + 1;
//            If ($array[$j][5] == '1') {
//                $array[$j][7] = "ACTIVO";
//            } else {
//                $array[$j][7] = "INACTIVO";
//            }
//            $j++;
//        }
    }

    public function llenarExpLab() {
// $funcion= $parametros["funcionJSEjecutar"];
        require_once("../../cvista/rrhh/experienciaEmpleado.php");
    }

    public function llenarEstudiosSup($opcion) {
//$o_LPersona          = new ActionPersona();
//$funcion             = $parametros["funcionJSEjecutar"];
        $comboTipoEstudio = $this->comboTipoEstudio('1');
        $comboInstitucion = $this->comboInstitucion('1', $opcion);
        $comboProfesion = $this->comboProfesion('1');
        $comboEstadoEstudio = $this->comboEstadoEstudio('1');
        $comboTipoNivel = $this->comboTipoNivel('1');
        $comboEspecialidad = $this->comboEspecialidad('1', $opcion);
//  $comboTipoDocumentos = $o_LPersona->comboTipoDocumento('1');
//  print_r($comboTipoDocumentos);
        require_once("../../cvista/rrhh/estudiosEmpleado.php");
    }

    public function llenarInstitucion($opcion) {
//echo "action";
        $funcion = $parametros["funcionJSEjecutar"];
        $comboInstitucion = $this->comboInstitucion('1', $opcion);
//require_once("../../cvista/rrhh/estudiosEmpleado.php");
    }

    public function llenarIdiomas($opcion) {

//$o_LPersona          = new ActionPersona();
//$funcion             = $parametros["funcionJSEjecutar"];
//$comboTipoEstudio = $this->comboTipoEstudio('1');
        $comboInstitucion = $this->comboInstitucion('1', 3);
        $comboEspecialidad = $this->comboEspecialidad('1', 14);
//$comboProfesion = $this->comboProfesion('1');
        $comboEstadoEstudio = $this->comboEstadoEstudio('1');
        $comboTipoNivel = $this->comboTipoNivel('1');

//  $comboTipoDocumentos = $o_LPersona->comboTipoDocumento('1');
//  print_r($comboTipoDocumentos);

        require_once("../../cvista/rrhh/idiomasEmpleado.php");
    }

    public function llenarInvestigacion() {
//$funcion             = $parametros["funcionJSEjecutar"];
        $comboEstadoEstudio = $this->comboEstadoEstudio('1');

        require_once("../../cvista/rrhh/investigacionEmpleado.php");
    }

    public function llenarConocimientos($opcion) {

//$funcion             = $parametros["funcionJSEjecutar"];
//$comboTipoEstudio = $this->comboTipoEstudio('1');
        $comboTipoAprendizaje = $this->comboTipoAprendizaje('1');
        $comboEstadoEstudio = $this->comboEstadoEstudio('1');
        $comboTipoNivel = $this->comboTipoNivel('1');

        require_once("../../cvista/rrhh/conocimientosEmpleado.php");
    }

    public function llenarLogros() {
//$funcion             = $parametros["funcionJSEjecutar"];
        require_once("../../cvista/rrhh/logrosEmpleado.php");
    }

    public function llenarReferencias() {
//  $funcion             = $parametros["funcionJSEjecutar"];
        require_once("../../cvista/rrhh/referenciasEmpleado.php");
    }

    public function llenarLegajo() {
// $funcion             = $parametros["funcionJSEjecutar"];
        require_once("../../cvista/rrhh/legajoEmpleado.php");
    }

    public function preMostrarCV($idDocEmp) {
        $o_LRrhh = new LRrhh();
        $idDocEmp = $idDocEmp;
        $resultado = $o_LRrhh->preMostrarCV($idDocEmp); //para verificar si exite el documento
//$ruta=$resultado[0][6];
        if ($resultado == null) {
            $resul = $o_LRrhh->recDatosDocumentoEmpleado($idDocEmp);
            if (count($resul) != 0) {
                $idDocumento = $resul[0][0];
                $nomDocumento = $resul[0][1];
                $codPersona = $resul[0][2];
                $ruta = $resul[0][3];
                $version = 0;
            } else {
                $idDocumento = '';
                $nomDocumento = '';
                $codPersona = '';
                $ruta = '';
                $version = 0;
            }

            require_once("../../cvista/rrhh/mostrarCV.php");
        } else {
            require_once("../../cvista/rrhh/listaArchivosEmpleado.php");
        }
    }

    public function adjuntarOtroFile($idDocEmp) {
        $o_LRrhh = new LRrhh();
        $idDocEmp = $idDocEmp;
        $resultado = $o_LRrhh->preMostrarCV($idDocEmp);
        $codPersona = $resultado[0][0];
        $idDocumento = $resultado[0][1];
        $nomDocumento = $resultado[0][2];
        $version = $resultado[0][4];
        $archivo = $resultado[0][5];
        $ruta = $resultado[0][6];
        // print_r($ruta);
        require_once("../../cvista/rrhh/mostrarCV.php");
    }

    public function guardarAtributoDocumentoEmpledo($iddocEmpleado, $dirCompleto) {
        $o_LRrhh = new LRrhh();
//        $datosDocEmp = $o_LRrhh->preMostrarCV($iddocEmpleado);
        $respuesta = $o_LRrhh->guardarAtributoDocumentoEmpledo($iddocEmpleado, $dirCompleto);
        return $respuesta;
    }

    /* --------------- MUESTRA TABLA DONDE LISTRAN EMPLEADOS --------------- */

    public function resultadoEmpleados() { //tabla vacia que se muestra al comienzo
        $o_LPersona = new LPersona();
        $arrayFilas = array(); //$o_LPersona->getListaMedicos($apellidoPaterno,$ApellidoMaterno,$Nombres);
        $arrayTipo = array("0" => "c", "1" => "c", "2" => "c", "3" => "c", "4" => "c");
        $arrayColorEstado = array("1" => "5", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9");
        $funcion = '';
        $arrayCabecera = array("0" => "CODIGO", "1" => "NOMBRE", "2" => "C. COSTO", "3" => "PUESTO", "4" => "ESTADO");
        $o_Html = new Tabla1($arrayCabecera, 20, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', $funcion, 4, $arrayTipo, 0, $arrayColorEstado);
        $o_Html->setColumnasOrdenar(array("1", "2", "3"));
        return $o_Html->getTabla();
    }

    /* --------------- MUESTRA RESULTADOS DE BUSQUEDA --------------- */

    public function buscaEmpleado($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre) {


        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LRrhh->getListaEmpleados($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre);
        // print_r($arrayFilas);
        $arrayCabecera = array(0 => "código", 1 => "Codigo", 2 => "Nombre", 3 => "Est. Emp");
        $arrayTamano = array(0 => "100", 1 => "100", 2 => "*", 3 => "100");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function busquedaEmpleadosCentroCostosFiltrado($puesto, $estado) {


        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LRrhh->busquedaEmpleadosCentroCostosFiltrado($puesto, $estado);
        // print_r($arrayFilas);


        $arrayCabecera = array("0" => "iidPuesto", "1" => "NombrePuesto", "2" => "Estado Puesto", "3" => "iid CCosto", "4" => "Nombre CCosto", "5" => "Categoria Puesto", "6" => "id Categoria");
        $arrayTamano = array("0" => "40", "1" => "295", "2" => "80", "3" => "40", "4" => "150", "5" => "95", "6" => "40");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro");
        $arrayCursor = array("0" => "default", "1" => "center", "2" => "default", "3" => "default", "4" => "default", "5" => "default", "6" => "default");
        $arrayHidden = array("0" => "true", "1" => "false", "2" => "false", "3" => "true", "4" => "false", "5" => "false", "6" => "true");
        $arrayAling = array("0" => "center", "1" => "left", "2" => "center", "3" => "center", "4" => "center", "5" => "center", "6" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

///peche 09/04/2012 busqueda de empleados por centro de costos
    public function aBusquedaEmpleadosCentroCostos($idCentroCostos, $estado) {
        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LRrhh->lBusquedaEmpleadosCentroCostos($idCentroCostos, $estado);
        // print_r($arrayFilas);
        $arrayCabecera = array(0 => "código", 1 => "Codigo", 2 => "Nombre", 3 => "Est. Emp", 4 => "Centro costo", 5 => "Puesto", 6 => "Est. Pues");
        $arrayTamano = array(0 => "100", 1 => "100", 2 => "*", 3 => "100", 4 => "*", 5 => "*", 6 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false", 6 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    ///busqueda de empleados por areas
    public function aBusquedaEmpleadosArea($idCentroCostos, $estado) {
        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LRrhh->lBusquedaEmpleadosAreas($idCentroCostos, $estado);
        // print_r($arrayFilas);
        $arrayCabecera = array(0 => "código", 1 => "Codigo", 2 => "Nombre", 3 => "Area", 4 => "Sede", 5 => "Puesto", 6 => "Tipo Contrato", 7 => "iIdModalidadContrato", 8 => "....");
        $arrayTamano = array(0 => "100", 1 => "100", 2 => "250", 3 => "100", 4 => "*", 5 => "*", 6 => "*", 7 => "180", 8 => "40");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "false", 3 => "false", 4 => "false", 5 => "false", 6 => "true", 7 => "true", 8 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "center", 4 => "left", 5 => "left", 6 => "Center", 7 => "left", 8 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function abuscarAutoriza($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre) {
        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LRrhh->getListaEmpleadosAutorizados($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre);
        //print_r($arrayFilas);
        $arrayCabecera = array(
            'iidPuestoEmpleado' => 'idPE',
            'c_cod_per' => "Codigo",
            'NOMBRE' => "Nombre",
            'vDescripcionCcosto' => "Centro Costo",
            'vNombrePuesto' => "Puesto"
        );
        $arrayTamano = array(
            'iidPuestoEmpleado' => '30',
            'c_cod_per' => "70",
            'NOMBRE' => "*",
            'vDescripcionCcosto' => "100",
            'vNombrePuesto' => "100"
        );
        $arrayTipo = array(
            'iidPuestoEmpleado' => 'ro',
            'c_cod_per' => "ro",
            'NOMBRE' => "ro",
            'vDescripcionCcosto' => "ro",
            'vNombrePuesto' => "ro"
        );
        $arrayAlineacion = array(
            'iidPuestoEmpleado' => 'center',
            'c_cod_per' => "center",
            'NOMBRE' => "left",
            'vDescripcionCcosto' => "left",
            'vNombrePuesto' => "left"
        );
        $arrayHidden = array(
            'iidPuestoEmpleado' => 'false',
            'c_cod_per' => "false",
            'NOMBRE' => "false",
            'vDescripcionCcosto' => "false",
            'vNombrePuesto' => "false"
        );
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 'c_cod_per', $arrayHidden);
    }

    public function ListadoFiltradoAreas($nombre) {


        $o_LRrhh = new LRrhh();
        $arrayFilas = $o_LRrhh->ListadoFiltradoAreas($nombre);
        $tabla = $this->tablaFiltradoAreas($arrayFilas);
        return $tabla;
    }

    public function buscaEmpleadoPopap($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre) {
        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LRrhh->getListaEmpleados($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre);
//        print_r($arrayFilas);
        $arrayFilas = is_array($arrayFilas) ? $arrayFilas : array();
        $arrayCabecera = array(0 => "Codigo", 1 => "Nombres", 2 => "E.Empleado", 3 => "C. Costo", 4 => "Puesto", 5 => "E. Puesto", 6 => "", 7 => "");
        $arrayTamano = array(0 => "70", 1 => "230", 2 => "50", 3 => "220", 4 => "220", 5 => "90", 6 => "50", 7 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro");
        $arrayCursor = array(0 => "pointer", 1 => "pointer", 2 => "pointer", 3 => "pointer", 4 => "pointer", 5 => "default", 6 => "default", 7 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "true", 3 => "false", 4 => "false", 5 => "false", 6 => "true", 7 => "true");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "center", 3 => "left", 4 => "left", 5 => "center", 6 => "center", 7 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function buscarCoordinadoresPopap($apPat, $apMat, $nombre) {
        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LRrhh->buscarCoordinadoresPopap($apPat, $apMat, $nombre);
        //print("inicio");
//        print($arrayFilas);

        $arrayFilas = is_array($arrayFilas) ? $arrayFilas : array();
        //Cod Original
//        $arrayCabecera = array(0 => "Codigo Empleadojcqa", 1 => "Apellidos y Nombres", 2 => "E.Empleado", 3 => "C. Costo", 4 => "Puesto", 5 => "E. Puesto", 6 => "", 7 => "");
//        $arrayTamano = array(0 => "70", 1 => "300", 2 => "50", 3 => "220", 4 => "220", 5 => "90", 6 => "50", 7 => "50");
//        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro");
//        $arrayCursor = array(0 => "pointer", 1 => "pointer", 2 => "pointer", 3 => "pointer", 4 => "pointer", 5 => "default", 6 => "default", 7 => "default");
//        $arrayHidden = array(0 => "false", 1 => "false", 2 => "true", 3 => "true", 4 => "true", 5 => "true", 6 => "true", 7 => "true");
//        $arrayAling = array(0 => "center", 1 => "left", 2 => "center", 3 => "left", 4 => "left", 5 => "center", 6 => "center", 7 => "center");
//        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
        //Cod Final
        //inicio
//        $arrayCabecera = array(0 => "Codigo Empleado", 1 => "Apellidos y Nombres");
//        $arrayTamano = array(0 => "70", 1 => "300");
//        $arrayTipo = array(0 => "ro", 1 => "ro");
//        $arrayCursor = array(0 => "default", 1 => "default");
//        $arrayHidden = array(0 => "false", 1 => "false");
//        $arrayAling = array(0 => "center", 1 => "left");
//        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);

        $arrayCabecera = array("0" => "Codigo Empleado", "1" => "Apellidos y Nombres");
        $arrayTamano = array("0" => "70", "1" => "300");
        $arrayTipo = array("0" => "ro", "1" => "ro");
        $arrayCursor = array("0" => "default", "1" => "default");
        $arrayHidden = array("0" => "false", "1" => "false");
        $arrayAling = array("0" => "center", "1" => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
        //final
    }

    public function buscaEmpleadoCC($cod, $estado) {
        $o_LRrhh = new LRrhh();
        $arrayFilas = $o_LRrhh->getListaEmpleadosCCostos($cod, $estado);
        $tabla = $this->tablaEmpleados($arrayFilas);
        return $tabla;
    }

    public function empleadosXPuestos($idPuesto, $estado) {

        $o_LRrhh = new LRrhh();
        $arrayFilas = $o_LRrhh->getListaEmpleadosPuestos($idPuesto, $estado);
        $tabla = $this->tablaEmpleados($arrayFilas);
        return $tabla;
    }

    public function tablaEmpleados($arrayFilas) {
        $funcion = 'registroDatosPersonalDetalle';
        $arrayTipo = array("0" => "c", "1" => "c", "2" => "h", "3" => "c", "4" => "c", "5" => "c", "7" => "c");
        $arrayColorEstado = array("0" => "6", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9");

        $arrayCabecera = array("0" => "CODIGO", "1" => "NOMBRE", "2" => "E.EMPLEADO", "3" => "C. COSTO", "4" => "PUESTO", "5" => "E.PUESTO", "7" => "...");

        $o_Html = new Tabla1($arrayCabecera, 15, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'ondblclick', $funcion, 0, $arrayTipo, 6, $arrayColorEstado);
        $o_Html->setColumnasOrdenar(array("1", "2", "3"));
        return $o_Html->getTabla();
    }

    public function tablaFiltradoAreas($arrayFilas) {
        $funcion = '';
        $arrayTipo = array("0" => "c", "1" => "c", "2" => "c", "3" => "c");
        $arrayColorEstado = array("0" => "6", "2" => "2", "3" => "3");

        $arrayCabecera = array("0" => "SEDE", "1" => "AREA", "2" => "APELLIDITOS", "3" => "ID SEDE EMPRESA");

        $o_Html = new Tabla1($arrayCabecera, 15, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'ondblclick', $funcion, 0, $arrayTipo, 6, $arrayColorEstado);
        $o_Html->setColumnasOrdenar(array("1", "2", "3"));
        return $o_Html->getTabla();
    }

    /* --------------- DEVUELVE EL ID DE EMPLEADO --------------- */

    public function mostrarIdEmpleado($codigo) {
        $o_LRrhh = new LRrhh();
        $q = $o_LRrhh->getIdEmpleado($codigo);
        $id = $q['0']['0'];
        $respuesta = $id . "|";
        return $respuesta;
    }

    /* --------------- PRESENTACION DE LOS DATOS X CATEGORIA DE LOS EMPLEADOS --------------- */

    public function tabListaExpLaboral($cod) {
//        $o_LRrhh = new LRrhh();
//        $arrayFilas = $o_LRrhh->getExpLaboral($cod, 2, '');
//        $funcion = 'expLaboralDetalle';
//        $arrayTipo = array("0" => "c", "1" => "c", "2" => "c", "3" => "c", "4" => "c");
//        $arrayColorEstado = array("1" => "5", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9");
//        $arrayCabecera = array("0" => "INSTITUCION", "1" => "CARGO", "2" => "INICIO", "3" => "FIN", "4" => "...");
//        $o_Html = new Tabla1($arrayCabecera, 8, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onclick', $funcion, 4, $arrayTipo, 0, $arrayColorEstado);
//        $o_Html->setColumnasOrdenar(array("0", "2", "3"));
//        return $o_Html->getTabla();
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $oLRrhh->getExpLaboral($cod, 2, '');
        //$funcion = 'expLaboralDetalle';
        $arrayCabecera = array("0" => "INSTITUCION", "1" => "CARGO", "2" => "INICIO", "3" => "FIN", "4" => "ID");
        $arrayTamano = array("0" => "90", "1" => "*", "2" => "70", "3" => "70", "4" => "70");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro");
        $arrayCursor = array("0" => "default", "1" => "center", "2" => "default", "3" => "center", "4" => "center");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => "false");
        $arrayAling = array("0" => "center", "1" => "center", "2" => "center", "3" => "center", "4" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function tabListaEstudiosSup($cod) {
//
//       $comboTipoEstudio = $this->comboTipoEstudio('1');
//       // print_r($comboTipoEstudio);
//         print_r($comboTipoEstudio);
//        $o_LRrhh = new LRrhh();
//        $arrayFilas = $o_LRrhh->getExpLaboral($cod, 3, '');
//        $funcion = 'estSupDetalle';
//        $arrayTipo = array("0" => "c", "1" => "c", "2" => "c", "3" => "c", "4" => "c", "5" => "c");
//        $arrayColorEstado = array("1" => "5", "2" => "2", "3" => "3", "4" => "4");
//        $arrayCabecera = array("0" => "ESPECIALIDAD", "1" => "TIPO ESTUDIO", "2" => "INSTITUCION", "3" => "INICIO", "4" => "FIN", "5" => "...");
//        $o_Html = new Tabla1($arrayCabecera, 6, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', $funcion, 5, $arrayTipo, 0, $arrayColorEstado);
//        $o_Html->setColumnasOrdenar(array("0", "1", "2", "3", "4"));
//        return $o_Html->getTabla();
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $oLRrhh->getExpLaboral($cod, 3, '');
        $arrayCabecera = array("0" => "ESPECIALIDAD", "1" => "TIPO DE ESTUDIO", "2" => "INTITUCION", "3" => "INICIO", "4" => "FIN", "5" => "...");
        $arrayTamano = array("0" => "90", "1" => "*", "2" => "70", "3" => "70", "4" => "70", "5" => "70");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro");
        $arrayCursor = array("0" => "default", "1" => "center", "2" => "default", "3" => "center", "4" => "center", "5" => "center");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => "false", "5" => "false");
        $arrayAling = array("0" => "center", "1" => "center", "2" => "center", "3" => "center", "4" => "center", "5" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function tabListaIdiomas($cod) {
//        $o_LRrhh = new LRrhh();
//        $arrayFilas = $o_LRrhh->getExpLaboral($cod, 4, '');
//        $funcion = 'idiomaDetalle';
//        $arrayTipo = array("0" => "c", "1" => "c", "2" => "c", "3" => "c");
//        $arrayColorEstado = array("1" => "5", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9");
//        $arrayCabecera = array("0" => "IDIOMA", "1" => "INSTITUCION", "2" => "NIVEL");
//        $o_Html = new Tabla1($arrayCabecera, 8, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', $funcion, 3, $arrayTipo, 0, $arrayColorEstado);
//        $o_Html->setColumnasOrdenar(array("0", "1", "2"));
//        return $o_Html->getTabla();
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $oLRrhh->getExpLaboral($cod, 4, '');
        $arrayCabecera = array("0" => "IDIOMA", "1" => "INSTITUCION", "2" => "NIVEL", "3" => "ID");
        $arrayTamano = array("0" => "90", "1" => "*", "2" => "70", "3" => "70");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro");
        $arrayCursor = array("0" => "default", "1" => "center", "2" => "default", "3" => "center");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false");
        $arrayAling = array("0" => "center", "1" => "center", "2" => "center", "3" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function tabListaConocimientos($cod) {
//        $o_LRrhh = new LRrhh();
//        $arrayFilas = $o_LRrhh->getExpLaboral($cod, 5, '');
//// $arrayFilas = $o_LRrhh->getListaEmpleados($cod);
//        $funcion = 'conocimientoDetalle';
//        $arrayTipo = array("0" => "c", "1" => "c", "2" => "c", "3" => "c", "4" => "c");
//        $arrayColorEstado = array("1" => "5", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9");
//        $arrayCabecera = array("0" => "CONOCIMIENTO/EVENTO", "1" => "INSTITUCION", "2" => "TIPO APRENDIZAJE", "3" => "NIVEL", "4" => "...");
//        $o_Html = new Tabla1($arrayCabecera, 8, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', $funcion, 4, $arrayTipo, 0, $arrayColorEstado);
//        $o_Html->setColumnasOrdenar(array("0", "1", "2", "3"));
//        return $o_Html->getTabla();
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $oLRrhh->getExpLaboral($cod, 5, '');
        $arrayCabecera = array("0" => "CONOCIMIENTO/EVENTO", "1" => "INSTITUCION", "2" => "TIPO APRENDISAJE", "3" => "NIVEL", "4" => "ID");
        $arrayTamano = array("0" => "150", "1" => "*", "2" => "120", "3" => "120", "4" => "70");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro");
        $arrayCursor = array("0" => "default", "1" => "center", "2" => "default", "3" => "center", "4" => "center");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => "false");
        $arrayAling = array("0" => "center", "1" => "center", "2" => "center", "3" => "center", "4" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function tabListaInvestigacion($cod) {
//        $o_LRrhh = new LRrhh();
//        $arrayFilas = $o_LRrhh->getExpLaboral($cod, 6, '');
//    // $arrayFilas = $o_LRrhh->getListaEmpleados($cod);
//        $funcion = 'investigacionDetalle';
//        $arrayTipo = array("0" => "c", "1" => "c", "2" => "c", "3" => "c", "4" => "c");
//        $arrayColorEstado = array("1" => "5", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9");
//        $arrayCabecera = array("0" => "TEMA", "1" => "INSTITUCION", "2" => "ESTADO", "3" => "FECHA", "4" => "...");
//        $o_Html = new Tabla1($arrayCabecera, 8, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', $funcion, 4, $arrayTipo, 0, $arrayColorEstado);
//        $o_Html->setColumnasOrdenar(array("0", "1", "2"));
//        return $o_Html->getTabla();

        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $oLRrhh->getExpLaboral($cod, 6, '');
        $arrayCabecera = array("0" => "TEMA", "1" => "INSTITUCION", "2" => "ESTADO", "3" => "FECHA", "4" => "ID");
        $arrayTamano = array("0" => "150", "1" => "*", "2" => "120", "3" => "120", "4" => "70");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro");
        $arrayCursor = array("0" => "default", "1" => "center", "2" => "default", "3" => "center", "4" => "center");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => "false");
        $arrayAling = array("0" => "center", "1" => "center", "2" => "center", "3" => "center", "4" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function tabListaLogros($cod) {
//        $o_LRrhh = new LRrhh();
//        $arrayFilas = $o_LRrhh->getExpLaboral($cod, 7, '');
//// $arrayFilas = $o_LRrhh->getListaEmpleados($cod);
//        $funcion = 'logrosDetalle';
//        $arrayTipo = array("0" => "c", "1" => "c", "2" => "c", "3" => "c");
//        $arrayColorEstado = array("1" => "5", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9");
//        $arrayCabecera = array("0" => "LOGRO", "1" => "INSTITUCION", "2" => "FECHA");
//        $o_Html = new Tabla1($arrayCabecera, 8, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', $funcion, 3, $arrayTipo, 0, $arrayColorEstado);
//        $o_Html->setColumnasOrdenar(array("0", "1", "2"));
//        return $o_Html->getTabla();

        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $oLRrhh->getExpLaboral($cod, 7, '');
        $arrayCabecera = array("0" => "LOGRO", "1" => "INSTITUCION", "2" => "FECHA", "3" => "ID");
        $arrayTamano = array("0" => "150", "1" => "*", "2" => "70", "3" => "70");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro");
        $arrayCursor = array("0" => "default", "1" => "center", "2" => "default", "3" => "center");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false");
        $arrayAling = array("0" => "center", "1" => "center", "2" => "center", "3" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function tabListaReferencias($cod) {
//        $o_LRrhh = new LRrhh();
//        $arrayFilas = $o_LRrhh->getExpLaboral($cod, 8, '');
//// echo $o_LRrhh;
//// $arrayFilas = $o_LRrhh->getListaEmpleados($cod);
//        $funcion = 'referenciaDetalle';
//        $arrayTipo = array("0" => "c", "1" => "c", "2" => "c");
//        $arrayColorEstado = array("1" => "5", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9");
//        $arrayCabecera = array("0" => "REFERENCIA", "1" => "INSTITUCION");
//        $o_Html = new Tabla1($arrayCabecera, 8, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', $funcion, 2, $arrayTipo, 0, $arrayColorEstado);
//        $o_Html->setColumnasOrdenar(array("0", "1"));
//        return $o_Html->getTabla();
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $oLRrhh->getExpLaboral($cod, 8, '');
        $arrayCabecera = array("0" => "REFERENCIA", "1" => "INSTITUCION", "2" => "ID");
        $arrayTamano = array("0" => "150", "1" => "*", "2" => "70");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro");
        $arrayCursor = array("0" => "default", "1" => "center", "2" => "default");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false");
        $arrayAling = array("0" => "center", "1" => "center", "2" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function tabListaLegajoModificado($cod, $vista) {
//        $o_LRrhh = new LRrhh();
//        $arrayFilas = $o_LRrhh->getExpLaboral($cod, 9, $vista);
//
//        $funcion = 'legajoDetalle';
//        $arrayTipo = array("0" => "c", "1" => "c", "2" => "h", "3" => "c", "4" => "h", "5" => "h", "6" => "c", "7" => "c", "8" => "h", "9" => "c", "10" => "c");
//        $arrayColorEstado = array("1" => "5", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9", "10" => "10");
//        $arrayCabecera = array("0" => "PUESTO", "1" => "DOCUMENTO", "2" => "REQ", "8" => "ENT", "4" => "LEG.", "5" => "LDO", "6" => "VENC", "7" => "...");
//        $o_Html = new Tabla1($arrayCabecera, 8, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', $funcion, 11, $arrayTipo, 0, $arrayColorEstado);
//        $o_Html->setColumnasOrdenar(array("0", "1"));
//        return $o_Html->getTabla();
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $oLRrhh->getExpLaboral($cod, 9, $vista);
        $arrayCabecera = array("0" => "PUESTO", "1" => "DOCUMENTO", "2" => "REQ", "3" => "ENT", "4" => "LEG.", "5" => "LDO", "6" => "VENC", "7" => "ID");
        $arrayTamano = array("0" => "90", "1" => "*", "2" => "70", "3" => "70", "4" => "70", "5" => "70", "6" => "70", "7" => "70");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "ro");
        $arrayCursor = array("0" => "default", "1" => "center", "2" => "default", "3" => "center", "4" => "center", "5" => "center", "6" => "center", "7" => "center");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => "false", "5" => "false", "6" => "false", "7" => "false");
        $arrayAling = array("0" => "center", "1" => "center", "2" => "center", "3" => "center", "4" => "center", "5" => "center", "6" => "center", "7" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function tabListaLegajo($cod, $vista) {
        $o_LRrhh = new LRrhh();
        $arrayFilas = $o_LRrhh->getExpLaboral($cod, 9, $vista);

        $funcion = 'legajoDetalle';
        $arrayTipo = array("0" => "c", "1" => "c", "2" => "h", "3" => "c", "4" => "h", "5" => "h", "6" => "c", "7" => "c", "8" => "h", "9" => "c", "10" => "c");
        $arrayColorEstado = array("1" => "5", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9", "10" => "10");
        $arrayCabecera = array("0" => "PUESTO", "1" => "DOCUMENTO", "2" => "REQ", "8" => "ENT", "4" => "LEG.", "5" => "LDO", "6" => "VENC", "7" => "...");
        $o_Html = new Tabla1($arrayCabecera, 8, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', $funcion, 11, $arrayTipo, 0, $arrayColorEstado);
        $o_Html->setColumnasOrdenar(array("0", "1"));
        return $o_Html->getTabla();
    }

    public function actualizarFechaDocumento($fecha, $idDocumentoEmpleado) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->actualizarFechaDocumento($fecha, $idDocumentoEmpleado);
        return $respuesta;
    }

    public function vistaLegajoDetalle($idDocumentoEmpleado) {
        $o_LRrhh = new LRrhh();
        $arrayFilas = $o_LRrhh->vistaLegajoDetalle($idDocumentoEmpleado);
        /* ----------------------------------- */
//$resul = $o_LRrhh->recDatosDocumentoEmpleado($idDocEmp);
        $resul = $o_LRrhh->recDatosDocumentoEmpleado($idDocumentoEmpleado);
//echo "numero".count($resul);
        if (count($resul) != 0) {
            $idDocumento = $resul[0][0];
            $nomDocumento = $resul[0][1];
            $codPersona = $resul[0][2];
            $version = 1;
        } else {
            $idDocumento = '';
            $nomDocumento = '';
            $codPersona = '';
            $version = 1;
        }

        /* ----------------------------------- */
        $nun = count($arrayFilas);
        $filas = intval($nun / 2) + 1;
//echo "num:".$nun."-Filas:".$filas;
        $impar = $nun - intval($nun / 2);
        $html = '';
        $k = 0;
        $echodoc = $arrayFilas[0][0];
        $etiqueta = 'FECHA ENTREGA';
        $input = "<input onclick='calendarioHtmlx(\"fechaEntrega\");'  name='fechaEntrega'  id='fechaEntrega' type='text' readonly='true' value='" . $arrayFilas[0][8] . "' />";
        $valorHidden = $arrayFilas[0][9];
        $hidden = "<input id='documentoEmpleado' type='hidden' value='" . $valorHidden . "' />";
//                $hidden=$hidden."<input id='documentoEmpleado' type='hidden' value='".$valorHidden."' />";
//                $hidden=$hidden."<input id='documentoEmpleado' type='hidden' value='".$valorHidden."' />";
//                $hidden=$hidden."<input id='documentoEmpleado' type='hidden' value='".$valorHidden."' />";
//                $hidden=$hidden."<input id='documentoEmpleado' type='hidden' value='".$valorHidden."' />";
        $anchoDiv = "50%";
        $anchoEtiqueta = "40%";
        $anchoValor = "60%";
        $html = "<div style=' text-transform:uppercase; float: left; width:100%; height:30px; '><h2>DETALLE DE DOCUMENTO ( " . $echodoc . " )</h2>
                    <input id='txtnomDocumento' name='txtnomDocumento' type='hidden' value='" . $echodoc . "' /></div>";
        $html = $html . "<div style=' width:" . $anchoDiv . "; float:left; height:40px; '><div style=' text-transform:uppercase; float: left; width:" . $anchoEtiqueta . "; '>" . $etiqueta . " :</div>";
        $html = $html . "<div style='float:left; width:" . $anchoValor . ";  '>" . $hidden . $input . "</div></div>";

        for ($i = 0; $i < $nun; $i++) {
            $input = '';
            $etiqueta = '';
            $div = '';
            $hidden = '';
            $valorHidden = '';
            if ($arrayFilas[$k][6] == 1) {
                $etiqueta = $arrayFilas[$k][1];
                $input = "<input id='i" . $i . "' readonly style='width:80% ' type='text' value='" . $arrayFilas[$k][3] . "' />";
                if ($arrayFilas[$k][7] == '') {
                    $arrayFilas[$k][7] = 0;
                }
                $valorHidden = $arrayFilas[$k][7];
                $hidden = "<input id='h" . $i . "' type='hidden' value='" . $valorHidden . "' />";
                $tipo = '1';
                $htipo = "<input id='t" . $i . "' type='hidden' value='" . $tipo . "' />";

                $atributoDocumento = $arrayFilas[$k][10];
                $hAtributoDocumento = "<input id='atri" . $i . "' type='hidden' value='" . $atributoDocumento . "' />";

                $anchoDiv = "100%";
                $anchoEtiqueta = "20%";
                $anchoValor = "80%";
            }
            if ($arrayFilas[$k][6] == 2) {
//$valor=$arrayFilas[$k][4];
                $etiqueta = $arrayFilas[$k][1];
                $input = "<input onclick='calendarioHtmlx(\"i" . $i . "\");' id='i" . $i . "' type='text' readonly value='" . $arrayFilas[$k][4] . "' />";
                if ($arrayFilas[$k][7] == '') {
                    $arrayFilas[$k][7] = 0;
                }
                $valorHidden = $arrayFilas[$k][7];
                $hidden = "<input id='h" . $i . "' type='hidden' value='" . $valorHidden . "' />";
                $tipo = '2';
                $htipo = "<input id='t" . $i . "' type='hidden' value='" . $tipo . "' />";
                $atributoDocumento = $arrayFilas[$k][10];
                $hAtributoDocumento = "<input id='atri" . $i . "' type='hidden' value='" . $atributoDocumento . "' />";

                $anchoDiv = "50%";
                $anchoEtiqueta = "40%";
                $anchoValor = "60%";
            }
            if ($arrayFilas[$k][6] == 3) {
//$valor=$arrayFilas[$k][5];
                $etiqueta = $arrayFilas[$k][1];
                $checked = '';
                if ($arrayFilas[$k][5] == 1) {
                    $checked = 'checked';
                }
                $input = "<input id='i" . $i . "' type='checkbox' disabled value='" . $arrayFilas[$k][5] . "' " . $checked . " onclick='if(this.checked){this.value=1}else{this.value=0;}' />";
                if ($arrayFilas[$k][7] == '') {
                    $arrayFilas[$k][7] = 0;
                }
                $valorHidden = $arrayFilas[$k][7];
                $hidden = "<input id='h" . $i . "' type='hidden' value='" . $valorHidden . "' />";
                $tipo = '3';
                $htipo = "<input id='t" . $i . "' type='hidden' value='" . $tipo . "' />";
                $atributoDocumento = $arrayFilas[$k][10];
                $hAtributoDocumento = "<input id='atri" . $i . "' type='hidden' value='" . $atributoDocumento . "'  />";

                $anchoDiv = "50%";
                $anchoEtiqueta = "40%";
                $anchoValor = "60%";
            }

            $div = "<div style=' width:" . $anchoDiv . "; float:left; height:40px; '><div style=' text-transform:uppercase; float: left; width:" . $anchoEtiqueta . "; '>" . htmlentities($etiqueta) . " :</div>";
            $div = $div . "<div style='float:left; width:" . $anchoValor . ";  '>" . $hAtributoDocumento . $htipo . $hidden . $input . "</div></div>";
            $k++;
            $html = $html . $div;
        }

        $inputLongitud = "<input id='longitud' type='hidden' value='" . $nun . "' />";
        $html = $html . "<div style=' text-transform:uppercase; float: left; width:100%; height:30px; '><h2>ADJUNTAR ( " . $echodoc . " )</h2></div>";
        $html = $html . $inputLongitud;
        return $html;
//        return $html."|".$echodoc;
//require_once("../../cvista/rrhh/vistaDetalleLegajo.php");
    }

    function mantemientoAtributosDocumentoEmpleados($valores, $tipos, $idAtributoDocumentoEmpleado, $atributoDocumento, $idDocumentoEmpleado) {
        $o_LRrhh = new LRrhh();
        $arrayValores = explode('|', $valores);
        $arrayTipos = explode('|', $tipos);
        $arrayIdAtributoDocumentoEmpleado = explode('|', $idAtributoDocumentoEmpleado);
        $arrayAtributoDocumento = explode('|', $atributoDocumento);
        $numero = count($arrayValores) - 1;
        for ($i = 0; $i < $numero; $i++) {
            $respuesta = $o_LRrhh->mantemientoAtributosDocumentoEmpleados($arrayValores[$i], $arrayTipos[$i], $arrayIdAtributoDocumentoEmpleado[$i], $arrayAtributoDocumento[$i], $idDocumentoEmpleado);
        }



        return $numero;
    }

    public function agregarDocumentoEmpleado($iCodigoEmpleado, $iIdDocumento) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->agregarDocumentoEmpleado($iCodigoEmpleado, $iIdDocumento);
        $respuesta = $respuesta[0][0];
        return $respuesta;
    }

    /* ------------------------- LLENADO DE LOS COMBOS ----------------------------- */

    public function comboTipoEstudio($optionsHTML) {
        $o_LRrhh = new LRrhh();
        $arrayCombo = $o_LRrhh->seleccionarTipoEstudio();
//print_r($arrayCombo);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

    public function comboInstitucion($optionsHTML, $opc) {
        $o_LRrhh = new LRrhh();
        $arrayCombo = $o_LRrhh->seleccionarInstitucion($opc);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

    public function comboProfesion($optionsHTML) {
        $o_LRrhh = new LRrhh();
        $arrayCombo = $o_LRrhh->seleccionarProfesion();

        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

    public function comboEstadoEstudio($optionsHTML) {
        $o_LRrhh = new LRrhh();
        $arrayCombo = $o_LRrhh->seleccionarEstadoEstudio();

        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

    public function comboTipoNivel($optionsHTML) {
        $o_LRrhh = new LRrhh();
        $arrayCombo = $o_LRrhh->seleccionarTipoNivel();

        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

    public function comboEspecialidad($optionsHTML, $opc) {
        $o_LRrhh = new LRrhh();
        $arrayCombo = $o_LRrhh->seleccionarEspecialidad($opc);

        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

    public function comboTipoAprendizaje($optionsHTML) {
        $o_LRrhh = new LRrhh();
        $arrayCombo = $o_LRrhh->seleccionarAprendizaje();

        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

    public function listaEstudios($codTipo, $codInst, $disabled) {
        $o_LRrhh = new LRrhh();
        $row_ochg_inst = '';
        $nomTipo = "%";
        $arrayCombo = $o_LRrhh->seleccionarTipoEstudio();
        $o_Combo = new Combo($arrayCombo);
        $opcionesHTML_01 = $o_Combo->getOptionsHTML($codTipo);
        $nomInst = "%";
        $arrayCombo = $o_LRrhh->seleccionarInstitucion($codTipo);
        $o_Combo = new Combo($arrayCombo);
        $opcionesHTML_02 = $o_Combo->getOptionsHTML();
        $row_ochg_tipo = "onchange=\"cambiaInstitucion('');\"";
//$row_ochg_inst = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=listaInst&p2='+document.getElementById('comboInst').value,'contenido_detalle');\"";
        $row_ini = "<div style='width: 16%; float: left;' id='divEtiquetaTipoEstudio' align='right'>Tipo*:</div>";
        $row_tipo = "<div style='width: 23%; float: left; ' id='DivSelectTipoEstudio'><select tabindex=1 id=\"comboTipoEstudio\" name=\"comboTipoEstudio\" $disabled " . $row_ochg_tipo . " title=\"Tipo\">";
        $row_fin_cb = "</select></div>";
        $row_med = "<div style='width: 28%; float: left; ' id='divEtiquetainstitucion' align='right'>Instituciones*:</div>";
        $row_inst = "<div style='width: 23%; float: left; ' id='DivSelectInstitucion'><select style='width: 150px;' tabindex=2 id=\"txtInstitucion\" name=\"txtInstitucion\" $disabled " . $row_ochg_inst . " title=\"Institucion\">";

        $comboHTML = $row_ini . $row_tipo . $opcionesHTML_01 . $row_fin_cb . $row_med . $row_inst . $opcionesHTML_02 . $row_fin_cb;
// $comboHTML='';
        return $comboHTML;
    }

    public function listaProfesiones($codProf, $codEsp, $disabled) {
        $o_LRrhh = new LRrhh();
        $nomProf = "%";
        $row_ochg_esp = '';
        $arrayCombo = $o_LRrhh->seleccionarProfesion();
        $o_Combo = new Combo($arrayCombo);
        $opcionesHTML_01 = $o_Combo->getOptionsHTML($codProf);
        $nomEsp = "%";
        $arrayCombo = $o_LRrhh->seleccionarEspecialidad($codProf);
        $o_Combo = new Combo($arrayCombo);
        $opcionesHTML_02 = $o_Combo->getOptionsHTML();
        $row_ochg_prof = "onchange=\"cambiaEspecialidad('');\"";
//$row_ochg_inst = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=listaInst&p2='+document.getElementById('comboInst').value,'contenido_detalle');\"";
        $row_ini = "<div style='width: 100%; height: 50%; '><div style='width: 17%; float: left;' id='divEtiquetaProfesion' align='right'>Profesión*:</div>";
        $row_prof = "<div style='width: 30%; float: left; ' id='DivSelectProfesion'><select tabindex=1 id=\"txtCargo\" name=\"txtCargo\" $disabled " . $row_ochg_prof . " title=\"Profesion\">";
        $row_fin_cb = "</select></div><div style='width: 54%;'>.</div></div>";
        $row_med = "<div style='width: 100%; height: 50%; '><div style='width: 18%; float: left; ' id='divEtiquetaEspecialidad' align='right'>Especialidad*:</div>";
        $row_esp = "<div style='width: 60%; float: left;' id='DivTextEspecialidad'><select tabindex=2 id=\"comboEspecialidad\" style=\"width:305px\" name=\"comboEspecialidad\" $disabled " . $row_ochg_esp . " title=\"Especialidad\">";
        $row_salto = "</select></div></div>";
        $comboHTML = $row_ini . $row_prof . $opcionesHTML_01 . $row_fin_cb . $row_med . $row_esp . $opcionesHTML_02 . $row_salto;
        return $comboHTML;
    }

    /* --------------- PRESENTACION DE LOS DATOS X CATEGORIA EN EL FORMULARIO --------------- */

    public function detalleExpLaboral($id, $opc) {
        $o_LRrhh = new LRrhh();
        $q = $o_LRrhh->detalleExpLaboral($id, $opc);

        if ('2' === $opc) {    //EXPERIENCIA LABORAL
            $Insittucion = $q['0']['0'];
            $Cargo = $q['0']['1'];
            $Inicio = $q['0']['2'];
            $Fin = $q['0']['3'];
            $id = $q['0']['4'];
            $detal = $q['0']['5'];
            $respuesta = $Insittucion . "|" . $Cargo . "|" . $Inicio . "|" . $Fin . "|" . $id . "|" . $detal . "|";
        }
        if ($opc == 3) {    //ESTUDIOS SUPERIORES
            $cero = $q['0']['0'];
            $uno = $q['0']['1'];
            $dos = $q['0']['2'];
            $tres = $q['0']['3'];
            $cuatro = $q['0']['4'];
            $cinco = $q['0']['5'];
            $seis = $q['0']['6'];
            $siete = $q['0']['7'];
            $ocho = $q['0']['8'];
            $nueve = $q['0']['9'];
            $diez = $q['0']['10'];

            $respuesta = $cero . "|" . $uno . "|" . $dos . "|" . $tres . "|" . $cuatro . "|" . $cinco . "|" . $seis . "|" . $siete . "|" . $ocho . "|" . $nueve . "|" . $diez . "|";
        }
        if ($opc == 4) {    //IDIOMAS
            $cero = $q['0']['0'];
            $uno = $q['0']['1'];
            $dos = $q['0']['2'];
            $tres = $q['0']['3'];
            $cuatro = $q['0']['4'];
            $cinco = $q['0']['5'];
            $seis = $q['0']['6'];
            $siete = $q['0']['7'];
            $ocho = $q['0']['8'];
            $nueve = $q['0']['9'];
            $diez = $q['0']['10'];

            $respuesta = $cero . "|" . $uno . "|" . $dos . "|" . $tres . "|" . $cuatro . "|" . $cinco . "|" . $seis . "|" . $siete . "|" . $ocho . "|" . $nueve . "|" . $diez . "|";
        }
        if ($opc == 5) {    //CONOCIMIENTO
            $cero = $q['0']['0'];
            $uno = $q['0']['1'];
            $dos = $q['0']['2'];
            $tres = $q['0']['3'];
            $cuatro = $q['0']['4'];
            $cinco = $q['0']['5'];
            $seis = $q['0']['6'];
            $siete = $q['0']['7'];

            $respuesta = $cero . "|" . $uno . "|" . $dos . "|" . $tres . "|" . $cuatro . "|" . $cinco . "|" . $seis . "|" . $siete . "|";
        }
        if ($opc == 6) {    //INVESTIGACION
            $cero = $q['0']['0'];
            $uno = $q['0']['1'];
            $dos = $q['0']['2'];
            $tres = $q['0']['3'];
            $cuatro = $q['0']['4'];
            $cinco = $q['0']['5'];
// $seis= $q['0']['6'];
            $seis = '';
            $respuesta = $cero . "|" . $uno . "|" . $dos . "|" . $tres . "|" . $cuatro . "|" . $cinco . "|" . $seis . "|";
        }
        if ($opc == 7) {    //LOGROS
            $cero = $q['0']['0'];
            $uno = $q['0']['1'];
            $dos = $q['0']['2'];
            $tres = $q['0']['3'];
            $cuatro = $q['0']['4'];

            $respuesta = $cero . "|" . $uno . "|" . $dos . "|" . $tres . "|" . $cuatro . "|";
        }
        if ($opc == 8) {    //REFERENCIAS
            $cero = $q['0']['0'];
            $uno = $q['0']['1'];
            $dos = $q['0']['2'];
            $tres = $q['0']['3'];
            $cuatro = $q['0']['4'];

            $respuesta = $cero . "|" . $uno . "|" . $dos . "|" . $tres . "|" . $cuatro . "|";
        }
        if ($opc == 9) {    //LEGAJO
            $cero = $q['0']['0'];
            $uno = $q['0']['1'];
            $dos = $q['0']['2'];
            $tres = $q['0']['3'];
            $cuatro = $q['0']['4'];

            $respuesta = $cero . "|" . $uno . "|" . $dos . "|" . $tres . "|" . $cuatro . "|";
        }
        return $respuesta;
    }

    /* --------------- EDICION,ADICION Y ELIMINACION DE LOS DATOS X CATEGORIA --------------- */

    public function accionExpLaboral($cat, $opc, $codigo, $id, $desde, $hasta, $instit, $cargo, $func, $tipoestudio, $esp, $estado, $nivel, $tiponivel) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->accionExpLaboral($cat, $opc, $codigo, $id, $desde, $hasta, $instit, $cargo, $func, $tipoestudio, $esp, $estado, $nivel, $tiponivel);
        return $respuesta;
    }

    public function accionLegajo($accion, $codigo, $columna, $puesto, $documento) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->accionLegajo($accion, $codigo, $columna, $puesto, $documento);
        return $respuesta;
    }

    public function ventanaActualizaEntregaDeDocumentos($accion, $codigo, $puesto, $documento) {
        $o_LRrhh = new LRrhh();
        $accion = $accion;
        $cod = $codigo;
        $pto = $puesto;
        $doc = $documento;
        if ($accion == 3) {
            $arrayFilas = $o_LRrhh->getFechaEntrega($codigo, $documento);
            $n = count($arrayFilas);
            if ($n == 0) {
                
            } else {
                $fecha = $arrayFilas[0][0];
            }
        }

        require_once ("../../cvista/rrhh/ventanaActualizaEntregaDeDocumentos.php");
    }

    public function grabarEntregaDocumento($accion, $codigo, $puesto, $documento, $fecha) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->grabarEntregaDocumento($accion, $codigo, $puesto, $documento, $fecha);
        return $respuesta;
    }

    public function detallePersonal($codigo, $parametro) {
        $o_LRrhh = new LRrhh();
        $o_LPersona = new LPersona();
        $combo = $this->comboTipoDocumento('1');

        $arrayDatos = $o_LRrhh->datosPersonal($codigo, $parametro);
//$codigo='';
        $nombre = '';
//$fechaNacimiento='';
        $edad = '';
        $documento = '';
        $filiacion = '';
//print_r($arrayDatos);
        foreach ($arrayDatos as $fila) {
//$codigo=$fila[0];
            $nombre = $fila[4] . " " . $fila[5] . ' ' . $fila[6];
//$fechaNacimiento=$fila[7];
            $documento = $fila[0];
            $filiacion = $fila[3];
        }

//$datetime = date_create($fechaNacimiento);
//$fechaNacimiento= date_format($datetime, 'm/d/Y') ;
// $edad=$o_LPersona->formatoEdad($fechaNacimiento);
//creando la tabla
//  $arrayFilas=$o_LRrhh->obtenerPersonal($codigo,$parametro);
        $arrayTipo = array("9" => "h", "0" => "c", "1" => "c", "2" => "c", "10" => "h", "3" => "c", "8" => "c", "4" => "c", "5" => "c", "6" => "c", "11" => "c");
//  $arraycabecera = array("9"=>" ","0"=>"Nro Orden","1"=>"Fecha","2"=>"FiliaciÃ³n","10"=>" ","3"=>"concepto","8"=>"Nro Comp.","4"=>"Precio","5"=>"Cant.","6"=>"Total","11"=>"....");

        $arrayColorEstado = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9");
// $o_Html = new Tabla1($arraycabecera,15,$arrayFilas,'tablaPersonal','filax','filay','filaSeleccionada','onClick','',5,$arrayTipo,7,$arrayColorEstado);
        require_once("../../cvista/tesoreria/detallePersonal.php");
    }

    public function formConsultaPersonas($iid_persona, $funcion) {
        require_once("../../cvista/rrhh/consultaPersonas.php");
    }

    /*     * ******************************** FIN DE REGISTRO DE PERSONAL ****************************************** */
    /*     * ************************ MANTENIMIENTO ESPECIALIDADES PROFESIONES RRHH ***************************** */

//Permite cargar la pagina para el mantenimiento de las especialidades y profesiones
    public function mantenimientoEspecialidadProfesion() {
        $tablaProfesiones = $this->buscarProfesiones('');
        require_once("../../cvista/rrhh/mantenimientoEspecialidadProfesion.php");
    }

    public function buscarProfesiones($profesion) {
        $o_LRrhh = new LRrhh();
        if ($profesion == '*') {
            $arrayFilas = $o_LRrhh->buscarProfesiones('');
        } else {
            $arrayFilas = $o_LRrhh->buscarProfesiones($profesion);
        }

        $tabla = $this->tablaProfesiones($arrayFilas);
        return $tabla;
    }

    public function tablaProfesiones($arrayFilas) {
        $funcion = 'profesionDetalle';
        $arrayTipo = array("0" => "c", "1" => "c", "4" => "h", "5" => "h");
        $arrayColorEstado = array("INACTIVO" => "6", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9");
        $arrayCabecera = array("0" => "PROFESION", "1" => "ACTIVO", "4" => "...", "5" => "***");
        $o_Html = new Tabla1($arrayCabecera, 7, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onclick', $funcion, 2, $arrayTipo, 4, $arrayColorEstado);
        $o_Html->setColumnasOrdenar(array("0", "1"));
        return $o_Html->getTabla();
    }

    public function profesionDetalle($id) {
        $o_LRrhh = new LRrhh();
        $q = $o_LRrhh->profesionDetalle($id);
        $cero = $q['0']['0'];
        $uno = $q['0']['1'];
        if ($q['0']['2'] == 1) {
            $dos = 'ACTIVO';
        } else {
            $dos = 'INACTIVO';
        }

        $respuesta = $cero . "|" . $uno . "|" . $dos . "|";
        return $respuesta;
    }

    public function buscarEspecialidades($profesion) {
        $o_LRrhh = new LRrhh();
        $arrayFilas = $o_LRrhh->buscarEspecialidades($profesion);
        $tabla = $this->tablaEspecialidades($arrayFilas);
        return $tabla;
    }

    public function tablaEspecialidades($arrayFilas) {
//$funcion='documentoDetalle';//estaba comentado, se inicializo la variable
        $funcion = '';
        $arrayTipo = array("0" => "c", "1" => "c", "2" => "h", "4" => "h", "5" => "c");
//        $arrayColorEstado=array("0"=>"6","2"=>"2","3"=>"3","4"=>"4");
        $arrayColorEstado = array();
        $arrayCabecera = array("0" => "NRO", "1" => "NOMBRE", "2" => "...", "4" => "...", "5" => "***");
        $o_Html = new Tabla1($arrayCabecera, 10, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onclick', $funcion, 0, $arrayTipo, 0, $arrayColorEstado);
        $o_Html->setColumnasOrdenar(array("0", "1"));
        return $o_Html->getTabla();
    }

    public function ventanaAgregaProfesion() {
        require_once ("../../cvista/rrhh/ventanaAgregaProfesion.php");
    }

    public function grabarProfesion($profesion) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->grabarProfesion($profesion);
        return $respuesta;
    }

    public function ventanaAgregarEspecialidad($profesion) {
        $profesion = $profesion;
        require_once ("../../cvista/rrhh/ventanaAgregarEspecialidad.php");
    }

    public function grabarEspecialidad($especialidad, $profesion) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->grabarEspecialidad($especialidad, $profesion);
        return $respuesta;
    }

    public function eliminarEspecialidad($especialidad, $profesion) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->eliminarEspecialidad($especialidad, $profesion);
        return $respuesta;
    }

    public function ventanaEditarEspecialidad($especialidad, $nombre, $profesion) {
        $profesion = $profesion;
        $especialidad = $especialidad;
        $nombre = $nombre;
        require_once ("../../cvista/rrhh/ventanaEditarEspecialidad.php");
    }

    public function editarEspecialidad($especialidad, $descripcion) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->editarEspecialidad($especialidad, $descripcion);
        return $respuesta;
    }

    public function editarProfesion($profesion, $descripcion) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->editarProfesion($profesion, $descripcion);
        return $respuesta;
    }

    public function desactivarProfesion($profesion) {
        $o_LRrhh = new LRrhh();
        $q = $o_LRrhh->desactivarProfesion($profesion);
        $cero = $q['0']['0'];
        if ($q['0']['0'] == '') {
            $respuesta = $cero . "|";
        } else {
            $respuesta = $q;
        }
        return $respuesta;
    }

    public function activarProfesion($profesion) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->activarProfesion($profesion);
        return $respuesta;
    }

    public function desactivarCoordinadorAlArea($hiIdEncargadoProgramacionPersonal) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->desactivarCoordinadorAlArea($hiIdEncargadoProgramacionPersonal);
        return $respuesta;
    }

    public function actualizarDescripcionCeseCoordinador($datos) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->actualizarDescripcionCeseCoordinador($datos);
        return $respuesta;
    }

    public function asignarNuevoCoordinador($datos) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->asignarNuevoCoordinador($datos);
        return $respuesta;
    }

    /*     * ************************ FIN MANTENIMIENTO ESPECIALIDADES PROFESIONES RRHH ***************************** */
    /*     * ********************************** MANTENIMIENTO PUESTO DOCUENTOS RRHH ********************************* */

//Permite cargar la pagina para el mantenimiento
    public function mantenimientoPuestoDocumento() {
        $o_LRrhh = new LRrhh();
        $arrayCombo = $o_LRrhh->seleccionarCategoria();
        $o_Combo = new Combo($arrayCombo);
        $optionsHTML = '0';
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        $tablaPuestosB = '';
        $tablaPuestoDocumentos = '';
        $tablaDocumentos = '';

        require_once("../../cvista/rrhh/mantenimientoPuestoDocumento.php");
    }

    public function puestosBusquedaDoc($datos) {

        $o_LRrhh = new LRrhh();
        $arrayFilas = $o_LRrhh->getListaPuestosDoc($datos);
        $tabla = $this->tablaPuestosB($arrayFilas);
        return $tabla;
//return $o_Html->getTabla();
    }

    public function tablaPuestosB($arrayFilas) {
        $funcion = 'documentoPuesto';
        $arrayTipo = array("0" => "c", "1" => "c");
        $arrayColorEstado = array("INACTIVO" => "6", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9");
        $arrayCabecera = array("0" => "Nro", "1" => "Puesto");
        $o_Html = new Tabla1($arrayCabecera, 8, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onclick', $funcion, 2, $arrayTipo, 1, $arrayColorEstado);
        $o_Html->setColumnasOrdenar(array("0", "1"));
        return $o_Html->getTabla();
    }

    public function puestoDocumento($puesto) {
        $o_LRrhh = new LRrhh();
        $arrayFilas = $o_LRrhh->puestoDocumento($puesto);
        $tabla = $this->tablaDocumentosXPto($arrayFilas);
        return $tabla;
    }

    public function tablaDocumentosXPto($arrayFilas) {
//$funcion='documentoDetalle';//estaba comentado se inicializo $funcion en nulo
        $funcion = '';
        $arrayTipo = array("0" => "c", "1" => "c", "2" => "h", "3" => "c");
        $arrayColorEstado = array("INACTIVO" => "6", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9");
        $arrayCabecera = array("0" => "Nº", "1" => "DOCUMENTO", "2" => "...", "3" => "...");
        $o_Html = new Tabla1($arrayCabecera, 12, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onclick', $funcion, 0, $arrayTipo, 1, $arrayColorEstado);
        $o_Html->setColumnasOrdenar(array("0", "1", "2"));
        return $o_Html->getTabla();
    }

    public function eliminarDocumentoPto($documentoPto) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->eliminarDocumentoPto($documentoPto);
        return $respuesta;
    }

    public function agregarDocumentoPuesto($puesto) {
        $o_LRrhh = new LRrhh();
        $arrayFilas = $o_LRrhh->agregarDocumentoPuesto($puesto);
        $tabla = $this->tablaDocumentosXPto($arrayFilas);
        return $tabla;
    }

    public function grabarDocumentoPto($puesto, $documento) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->grabarDocumentoPto($puesto, $documento);
        return $respuesta;
    }

    /*     * *********************************** FIN MANTENIMIENTO PUESTO DOCUENTOS RRHH ******************************************** */
    /*     * *********************************** MANTENIMIENTO DE DOCUENTOS RRHH ******************************************** */

    public function mantenimientoDocumento() {
        $tablaDocumentos = $this->buscarDocumentos('', '');
        $tablaAtributos = '';
        require_once("../../cvista/rrhh/mantenimientoDocumento.php");
    }

    public function buscadorDocumentos($parametros) {
        $funcion = $parametros['funcionDocumento'];
        $tablaDocumentos = $this->buscarDocumentos('', $funcion);
//echo "hola";

        require_once("../../cvista/busqueda/buscadorDocumento.php");
    }

    public function buscarDocumentos($documento, $funcion) {
        $o_LRrhh = new LRrhh();
        if ($documento == '*') {
            $arrayFilas = $o_LRrhh->buscarDocumentos('');
        } else {
            $arrayFilas = $o_LRrhh->buscarDocumentos($documento);
        }
        $tabla = $this->tablaDocumentos($arrayFilas, $funcion);
        return $tabla;
    }

    public function tablaDocumentos($arrayFilas, $funcion) {
//$funcion='documentoDetalle';
        $arrayTipo = array("0" => "c", "1" => "c", "2" => "c", "3" => "h", "4" => "h", "5" => "h");
        $arrayColorEstado = array("INACTIVO" => "6", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9");
        $arrayCabecera = array("0" => "DOCUMENTO", "1" => "ESTADO", "4" => "...", "5" => "***");
        $o_Html = new Tabla1($arrayCabecera, 7, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onclick', $funcion, 2, $arrayTipo, 1, $arrayColorEstado);
        $o_Html->setColumnasOrdenar(array("0", "1"));
        return $o_Html->getTabla();
    }

    public function documentoDetalle($id) {
        $o_LRrhh = new LRrhh();
        $q = $o_LRrhh->documentoDetalle($id);
        $cero = $q['0']['0'];
        $uno = $q['0']['1'];
        if ($q['0']['2'] == 1) {
            $dos = 'ACTIVO';
        } else {
            $dos = 'INACTIVO';
        }

        $respuesta = $cero . "|" . $uno . "|" . $dos . "|";
        return $respuesta;
    }

    public function buscarAtributos($documento) {
        $o_LRrhh = new LRrhh();
        $arrayFilas = $o_LRrhh->buscarAtributos($documento);
        $tabla = $this->tablaAtributos($arrayFilas);
        return $tabla;
    }

    public function tablaAtributos($arrayFilas) {
//$funcion='documentoDetalle';
        $funcion = '';
        $arrayTipo = array("0" => "c", "1" => "c", "2" => "c", "6" => "h", "7" => "h");
        $arrayColorEstado = array("0" => "6", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9");
        $arrayCabecera = array("0" => "NRO", "1" => "NOMBRE", "2" => "TIPO", "6" => "...", "7" => "...");
        $o_Html = new Tabla1($arrayCabecera, 8, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onclick', $funcion, 3, $arrayTipo, 7, $arrayColorEstado);
        $o_Html->setColumnasOrdenar(array("0", "1"));
        return $o_Html->getTabla();
    }

    public function ventanaAgregaDocumento() {
//        $o_LRrhh=new LRrhh();              
        require_once ("../../cvista/rrhh/ventanaAgregaDocumento.php");
    }

    public function grabarDocumento($documento, $descripcion) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->grabarDocumento($documento, $descripcion);
        return $respuesta;
    }

    public function ventanaAgregarAtributo($documento) {
        $documento = $documento;
// $tablaNuevoAtributo=$this->buscarAtributos(''); //q muestre vacio
        $o_LRrhh = new LRrhh();
        $arrayFilas = $o_LRrhh->buscarAtributo($documento, '');
        $tablaNuevoAtributo = $this->tablaSeleccionAtributos($arrayFilas);
        require_once ("../../cvista/rrhh/ventanaAgregarAtributo.php");
    }

    public function buscarAtributo($documento, $atributo) {
        $o_LRrhh = new LRrhh();
        $arrayFilas = $o_LRrhh->buscarAtributo($documento, $atributo);
        $tabla = $this->tablaSeleccionAtributos($arrayFilas);
        return $tabla;
    }

    public function seleccionarAtributo($atributo) {
        $o_LRrhh = new LRrhh();
        $arrayFilas = $o_LRrhh->seleccionarAtributo($atributo);
        $tabla = $this->tablaSeleccionAtributos($arrayFilas);
        return $tabla;
    }

    public function tablaSeleccionAtributos($arrayFilas) {
        $funcion = 'idAtributo';
        $arrayTipo = array("0" => "c", "1" => "c");
        $arrayColorEstado = array("0" => "6", "2" => "2");
        $arrayCabecera = array("0" => "NOMBRE", "1" => "TIPO");
        $o_Html = new Tabla1($arrayCabecera, 7, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onclick', $funcion, 2, $arrayTipo, 0, $arrayColorEstado);
        $o_Html->setColumnasOrdenar(array("0", "1"));
        return $o_Html->getTabla();
    }

    public function grabarAtributo($atributo, $documento) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->grabarAtributo($atributo, $documento);
        return $respuesta;
    }

    public function eliminarAtributo($atributo, $documento) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->eliminarAtributo($atributo, $documento);
        return $respuesta;
    }

    public function ordenarAtributo($documento, $direccion, $orden, $atributo) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->ordenarAtributo($documento, $direccion, $orden, $atributo);
        return $respuesta;
    }

    public function editarDocumento($documento, $descripcion) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->editarDocumento($documento, $descripcion);
        return $respuesta;
    }

    public function eliminarDocumento($documento) {
        $o_LRrhh = new LRrhh();
        $q = $o_LRrhh->eliminarDocumento($documento);
        $cero = $q['0']['0'];
        if ($q['0']['0'] == '') {
            $respuesta = $cero . "|";
        } else {
            $respuesta = $q;
        }
        return $respuesta;
    }

    public function activarDocumento($documento) {
        $o_LRrhh = new LRrhh();
        $respuesta = $o_LRrhh->activarDocumento($documento);
        return $respuesta;
    }

    /*     * *********************************** FIN MANTENIMIENTO DE DOCUENTOS RRHH ****************************************** */

    public function leeActualizacionCCostos($parametros) {
        $pAcc = $parametros["p_acc"];                                      //accion
        $pCod = $parametros["txtCodigoE"];                                    //
        $arrP['p2'] = $parametros["txtInsertarHijo"];                           //
        $arrP['p3'] = $parametros["txtInsertarHno"];                            //
        $oLCronograma = new LCronograma();
        $result = $oLCronograma->DatosActualCentroCosto($pCod, $arrP);
        return $result;
    }

    public function aPuestosCCostos() {
        $o_LRrhh = new LRrhh();
//        $arrayCombo = $o_LRrhh->seleccionarCategoria();
//        $comboSucursal = $o_LRrhh->listaSucursal('0110073', ''); //id de la empresa HMLO -> 0110073
//        $o_Combo = new Combo($arrayCombo);
//        $comboHTML = $o_Combo->getOptionsHTML('0');
//        $tablaPuestos = $this->aPuestosXCCostos(1);

        require_once("../../cvista/rrhh/vPuestosCCostos.php");
    }

    public function agregarPuestoEmpleado($funcion) {
//$var='hola';

        $o_LRrhh = new LRrhh();
        $arrayCombo = $o_LRrhh->seleccionarCategoria();
        $o_Combo = new Combo($arrayCombo);
        $optionsHTML = '0';
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        $tablaPuestos = $this->aPuestosXCCostos(1);
        require_once("../../cvista/rrhh/buscarPuestosEmpleados.php");
// return $var;
    }

    public function asignarPuestoEmpleado($arrayDat) {
        $oLRrhh = new LRrhh();
        $mensaje = $oLRrhh->asignarPuestoEmpleado($arrayDat);
        $resultado = $mensaje[0][0];
        return $resultado;
    }

    public function registrarEmpleadoComoUsuario($codigoEmpleado, $idPuesto) {
        $oLRrhh = new LRrhh();
        $mensaje = $oLRrhh->registrarEmpleadoComoUsuario($codigoEmpleado, $idPuesto);
        $resultado = $mensaje[0][0];
        return $resultado;
    }

    public function aPuestosXCCostos($datos) {
        $o_LRrhh = new LRrhh();
        $arrayFilas = $o_LRrhh->getListaPuestos($datos);
        $arrayTipo = array("0" => "c", "1" => "c", "2" => "c", "3" => "c", "4" => "c", "6" => "c");
        $arrayColorEstado = array("0" => "6");
        $arrayCabecera = array("0" => "Nro", "1" => "Puesto", "2" => "C.Costo", "3" => "Categoria", "4" => "Estado", "6" => "...");

        $o_Html = new Tabla1($arrayCabecera, 9, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'ondblclick', $datos['funcion'], 0, $arrayTipo, 5, $arrayColorEstado);
//$o_Html->setColumnasOrdenar(array("1","2"));
        return $o_Html->getTabla();
    }

    public function puestoCentroCosto($id) {
        $o_LRrhh = new LRrhh();
        $datos["idCCostos"] = $id;
        $datos["puesto"] = '';
        $datos["categoria"] = '0000';
        $datos["estado"] = '1';
        $arrayFilas = $o_LRrhh->getListaPuestos($datos);
        $arrayTipo = array("0" => "c", "1" => "c", "2" => "c", "3" => "c", "4" => "c");
        $arrayColorEstado = array("0" => "6");
        $arrayCabecera = array("0" => "Nro", "1" => "Puesto");

        $o_Html = new Tabla1($arrayCabecera, 9, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', 'empleadosXPuestos', 0, $arrayTipo, 5, $arrayColorEstado);
//$o_Html->setColumnasOrdenar(array("1","2"));
        return $o_Html->getTabla();
    }

    public function adetallePuestoCentroCosto($id) {
//echo "aaaaaaaaaaa|bbbbbbbbbbbbbb|ccccccccc|dddddddd|eeeeeeeeeee|";
        $o_LRrhh = new LRrhh();
        $array = $o_LRrhh->detallePuestoCentroCosto($id);
        $resultado = $array[0][0] . "|" . $array[0][3] . " - " . $array[0][2] . "|" . $array[0][1] . "|";
        $resultado = $resultado . $array[0][4] . "|" . $array[0][5];
        return $resultado;
    }

    /*     * **************Asignacion de Servicios a Puestos de trabajo****************** */

    public function listadoPuestosdeTrabajo($datos) {
        $oLRrhh = new LRrhh();
        $datos == '' ? $arrayFilas1 = array() : $arrayFilas1 = $oLRrhh->getListaPuestosConcatenado($datos);
        $arrayCabecera = array("1" => "Nro", "2" => "Puesto", "3" => "Centro Costo", "4" => "Tipo", "5" => " ");
        $arrayTipo = array("1" => "c", "2" => "c", "3" => "c", "4" => "c", "5" => "c");
        $o_Tabla = new Tabla1($arrayCabecera, 10, $arrayFilas1, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'OnClick', 'irmostrarServiciosAsignados', 0, $arrayTipo);
        $tablaHTML = $o_Tabla->getTabla();
        $row_ini = "<table width='100%'>";
        $row_fin = "</table>";
        return $row_ini . $tablaHTML . $row_fin;
    }

    public function listadoServiciosAsignados($datos) {
        $oLRrhh = new LRrhh();
        $datos == '' ? $arrayFilas1 = array() : $arrayFilas1 = $oLRrhh->getListaServiciosAsignados($datos);
        $arrayCabecera = array("0" => "Cod.Servicio", "1" => "Nombre de Servicio", "2" => "Tipo de Servicio", "4" => "...", "5" => "...");
        $arrayTipo = array("0" => "c", "1" => "c", "2" => "c", "4" => "h", "5" => "h");
        $o_Tabla = new Tabla1($arrayCabecera, 10, $arrayFilas1, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'OnClick', '', 0, $arrayTipo);
        $tablaHTML = $o_Tabla->getTabla();
        $row_ini = "<table width='100%'>";
        $row_fin = "</table>";
        return $row_ini . $tablaHTML . $row_fin;
    }

    public function listadoServiciosparaAsignar($datos) {
        $oLRrhh = new LRrhh();
        $datos == '' ? $arrayFilas1 = array() : $arrayFilas1 = $oLRrhh->getListaServiciosparaAsignar($datos);
        $arrayCabecera = array("0" => "Cod.Servicio", "1" => "Nombre de Servicio", "2" => "Tipo de Servicio", "3" => "...", "4" => " ");
        $arrayTipo = array("0" => "c", "1" => "c", "2" => "c", "3" => "h", "4" => "c");
        $o_Tabla = new Tabla1($arrayCabecera, 10, $arrayFilas1, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'OnClick', '', 0, $arrayTipo);
        $tablaHTML = $o_Tabla->getTabla();
        $row_ini = "<table width='100%'>";
        $row_fin = "</table>";
        return $row_ini . $tablaHTML . $row_fin;
    }

    public function grabarAsignacionServicioaPuesto($datos) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->grabarAsignacionServicioaPuesto($datos);
        return $resultado;
    }

    public function activaryDesactivarAsignacionServicioaPuesto($datos) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->activaryDesactivarAsignacionServicioaPuesto($datos);
        return $resultado;
    }

    public function eliminarAsignacionServicioaPuesto($datos) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->eliminarAsignacionServicioaPuesto($datos);
        return $resultado;
    }

    public function grabarDetallePuesto($datos) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->grabarDetallePuesto($datos);
        return $resultado;
    }

    //jcqa 12 Abril 2012 4:34pm

    public function grabarDetallePuestoaCentroCosto($datos) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->grabarDetallePuestoaCentroCosto($datos);
        return $resultado;
    }

    public function seleccionarCentroCostoPuesto($id) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->seleccionarCentroCostoPuesto($id);
        return $resultado;
    }

    public function seleccionarCentroCostoPuestoDelArbol($id) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->seleccionarCentroCostoPuestoDelArbol($id);
        return $resultado;
    }

    public function registrarEmpleado($c_cod_per, $bEstado) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->registrarEmpleado($c_cod_per, $bEstado);
        return $resultado;
    }

    public function detallePuestosEmpleados($id) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->detallePuestosEmpleados($id);
///print_r($resultado);
        return $resultado;
    }

    public function detalleModalidadContrato($idEmpleado) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->detalleModalidadContrato($idEmpleado);
        return $resultado;
    }

    public function aGrabarMantenimientoContrato($datos) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->lGrabarMantenimientoContrato($datos);
        $resultado = $resultado[0][0];
        return $resultado;
    }

    /*     * ************ generar árbol servicios***************** */

    public function generaArbolServicios() {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->generaArbolServicios();
        require_once '../../cvista/rrhh/serviciosXpuestos.php';
//        return $resultado;
    }

    /*     * ***Jose 2012/02/15*********************** */

    public function abrirAreaMantemientoArea() {
        $oLRrhh = new LRrhh();
//        $resultado = $oLRrhh->generaArbolServicios();
        $comboSucursal = $oLRrhh->listaSucursal('0110073', '');
//0110073 pertenece a HMLO
// require_once '../../cvista/rrhh/vMantenimientoArea.php';

        require_once '../../cvista/mantenimientogeneral/vMantenimientoArea.php';
    }

    function arbolAreas($idSedeEmpresa) {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $resultado = $oLRrhh->arbolAreas($idSedeEmpresa);
        return $o_TablaHtmlx->generaArbol($resultado);
    }

    //23enero

    function aarbolPracticasOdontologicas() {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $resultado = $oLRrhh->larbolPracticasOdontologicas();
        return $o_TablaHtmlx->generaArbol($resultado);
    }

    function aArbolCentroCostos() {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $resultado = $oLRrhh->lArbolCentroCostos();
        return $o_TablaHtmlx->generaArbol($resultado);
    }

    function arbolAreas2($idSedeEmpresa) {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $resultado = $oLRrhh->arbolAreas2($idSedeEmpresa);
        return $o_TablaHtmlx->generaArbol($resultado);
    }

    function aGeneraArbolCentroCostos() {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $resultado = $oLRrhh->lGeneraArbolCentroCostos();
        return $o_TablaHtmlx->generaArbol($resultado);
    }

    /*     * ****************************Jorge**************************** */

    public function abrirAreaCentroCosto() {
        $oLRrhh = new LRrhh();
//        $resultado = $oLRrhh->generaArbolServicios();
        $comboSucursal = $oLRrhh->listaSucursal('0110073', '');
        require_once '../../cvista/rrhh/areaXcentrocosto.php';
    }

    public function arbolCentroCosto() {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $resultado = $oLRrhh->arbolCentroCosto();
        return $o_TablaHtmlx->generaArbol($resultado);
    }

    public function tablaAreaCCosto($idCCosto) {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRrhh->tablaAreaCCosto($idCCosto);

        $arrayCabecera = array(0 => "idArea", 1 => "Nombre Área", 2 => "Abreviatura", 3 => "estado", 4 => "Accion");
        $arrayTamano = array(0 => "50", 1 => "280", 2 => "100", 3 => "50", 4 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false", 3 => "true", 4 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

//    public function grabarAreaCCosto($datos) {
//        $oLRrhh = new LRrhh();
//        $resultado = $oLRrhh->grabarArea($datos);
//        return $resultado;
// }
    public function grabarArea($datos) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->grabarArea($datos);
        return $resultado;
    }

    public function grabarAreaX($datos) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->grabarAreaX($datos);
        return $resultado;
    }

    public function buscarArea($nomArea) {

        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRrhh->buscarArea($nomArea); //$arrayFilas = $oLActoMedico->cargaTratamientosAnteriores($datos);

        $btnEditarComoHidden = true;
        if (isset($_SESSION["permiso_formulario_servicio"][218]["EDITAR_AREA"]) && ($_SESSION["permiso_formulario_servicio"][218]["EDITAR_AREA"] == 1)) {
            $btnEditarComoHidden = false;
        }

        $arrayCabecera = array(0 => "idArea", 1 => "Nombre Área", 2 => "Abreviatura", 3 => "estado", 4 => "Estado", 5 => "Accion");
        $arrayTamano = array(0 => "50", 1 => "280", 2 => "100", 3 => "50", 4 => "90", 5 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "pointer");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "true", 4 => "false", 5 => $btnEditarComoHidden);
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);

//return $resultado;
    }

    function buscarAreaModCoordinadoresTurnos($datos) {


        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();

//        $iCodEmpCoordinador = $_SESSION['iCodigoEmpleado'];


        $arrayCargarlistadoTodosCordinadores = $oLRrhh->CargarlistadoTodosCordinadoresFiltrado($datos);

//        $arraySede = $oLRrhh->CargarEmpleados($iCodEmpCoordinador);
//        $arrayCargarlistadoTodosCordinadores = is_array($arrayCargarlistadoTodosCordinadores) ? $arrayCargarlistadoTodosCordinadores : array();


        $arrayCabecera = array("0" => "Sede", "1" => "Area", "2" => "Nivel", "3" => "Coordinador", "4" => "idEncargadoProgramacionPersonal", "5" => "idSedeEmpresaArea", "6" => "Fec Inicio", "7" => "Fecha Fin", "8" => "IcodigoCoordinado", "9" => "Accion Turno", "10" => "Accion Coordinador", "11" => "Turno1");
        $arrayTamano = array("0" => "100", "1" => "220", "2" => "100", "3" => "250", "4" => "150", "5" => "150", "6" => "50", "7" => "50", "8" => "50", "9" => "50", "10" => "50", "11" => "50");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "ro", "8" => "ro", "9" => "img", "10" => "img", "11" => "img");
        $arrayCursor = array("0" => "default", "1" => "center", "2" => "default", "3" => "default", "4" => "default", "5" => "default", "6" => "default", "7" => "default", "8" => "default", "9" => "pointer", "10" => "pointer", "11" => "pointer");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => "true", "5" => "true", "6" => "true", "7" => "true", "8" => "true", "9" => "false", "10" => "false", "11" => "false");

        $arrayAling = array("0" => "center", "1" => "left", "2" => "center", "3" => "center", "4" => "center", "5" => "center", "6" => "center", "7" => "center", "8" => "center", "9" => "center", "10" => "center", "11" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayCargarlistadoTodosCordinadores, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function buscarAreaModSinCoordinadoresTurnos($datos) {

        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
//        $iCodEmpCoordinador = $_SESSION['iCodigoEmpleado'];

        $arrayCargarlistadoTodosCordinadores = $oLRrhh->CargarlistadoTodasAreasSinCoordinadorFiltrado($datos);

//        $arraySede = $oLRrhh->CargarEmpleados($iCodEmpCoordinador);
//        $arrayCargarlistadoTodosCordinadores = is_array($arrayCargarlistadoTodosCordinadores) ? $arrayCargarlistadoTodosCordinadores : array();


        $arrayCabecera = array("0" => "Sede", "1" => "Area", "2" => "Nivel", "3" => "Coordinador", "4" => "id SedeEmpresaArea", "5" => "Accion Turno", "6" => "Accion Coordinador");
        $arrayTamano = array("0" => "100", "1" => "220", "2" => "100", "3" => "50", "4" => "60", "5" => "50", "6" => "50");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "img", "6" => "img");
        $arrayCursor = array("0" => "default", "1" => "center", "2" => "default", "3" => "default", "4" => "default", "5" => "pointer", "6" => "pointer");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "true", "4" => "true", "5" => "false", "6" => "false");
        $arrayAling = array("0" => "center", "1" => "left", "2" => "center", "3" => "center", "4" => "center", "5" => "center", "6" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayCargarlistadoTodosCordinadores, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    //************************Jose 2012/02/07*******************************************************

    public function buscarSubArea($idArea, $nomSubArea) {

        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRrhh->buscarSubArea($idArea, $nomSubArea); //$arrayFilas = $oLActoMedico->cargaTratamientosAnteriores($datos);
//        $btnEditarComoHidden=true;
//        if (isset($_SESSION["permiso_formulario_servicio"][218]["EDITAR_AREA"]) && ($_SESSION["permiso_formulario_servicio"][218]["EDITAR_AREA"]==1)) {
//            $btnEditarComoHidden=false;
//        }
//        $arrayCabecera = array(0 => "idSubarea", 1 => "Nivel", 2 => "idDependencia", 3 => "Nombre SubArea",4 => "Abreviatura", 5 => "estado", 6 => "Estado",7 => "Accion");
//        $arrayTamano = array(0 => "50", 1 => "280", 2 => "100", 3 => "280",4 => "200",5 => "50", 6 => "90", 7 => "50");
//        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro",4 => "ro",5 => "ro", 6 => "ro", 7 => "img");
//        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default",4 => "default",5 => "default", 6 => "default", 7 => "pointer");
//        $arrayHidden = array(0 => "true", 1 => "true", 2 => "true", 3 => "false",4 => "false",5 => "true", 6 => "false", 7 => $btnEditarComoHidden);
//        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left",4 => "left",5 => "left", 6 => "left", 7 => "center");




        $arrayCabecera = array(0 => "idArea", 1 => "idDependencia", 2 => "Descripcion", 3 => "Abreviatura", 4 => "estado", 5 => "Estado", 6 => "Accion");
        $arrayTamano = array(0 => "50", 1 => "280", 2 => "350", 3 => "100", 4 => "50", 5 => "90", 6 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "false", 3 => "false", 4 => "true", 5 => "false", 6 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "center");



        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);

//return $resultado;
    }

//*******************************************************************************************
    //*******************************************************************************************


    public function nuevaArea() {
        $oLRrhh = new LRrhh();
        $comboSucursal = $oLRrhh->listaSucursal('0110073', '');
        require_once("../../cvista/rrhh/vguardarArea.php");
    }

    public function CargarlistadoTodosTurnosDisponibles($nomSedeEmpresaArea) {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();


        $arrayFilas = $oLRrhh->listaTurnosDisponibles($nomSedeEmpresaArea);


        $arrayCabecera = array(0 => "Codigo Turno", 1 => "Descripcion Turno", 2 => "Nomenclatura");
        $arrayTamano = array(0 => "70", 1 => "120", 2 => "60");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function RefrescarTablaTurnosDisponiblesxArea($IdSedeEmpresaArea) {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = $oLRrhh->listaTurnosDisponibles($IdSedeEmpresaArea);


        $arrayCabecera = array(0 => "Codigo Turno", 1 => "Descripcion Turno", 2 => "Nomenclatura");
        $arrayTamano = array(0 => "70", 1 => "120", 2 => "60");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

//modificado 23 Abril2012 JCQA
    public function CargarlistaTurnosxSedeEmpresaArea($nomSedeEmpresaArea) {
        $oLRrhh = new LRrhh();

        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRrhh->listaTurnosxSedeEmpresaArea($nomSedeEmpresaArea);


        //original
//        $arrayCabecera = array(0 => "Codigo Turno", 1 => "Descripcion Turno", 2 => "Nomenclatura", 3 => "IdTurnoAreaSede",4 => "opcion");
//        $arrayTamano = array(0 => "70", 1 => "120", 2 => "40", 3 => "50", 4 => "50");
//        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro",4 => "img");
//        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default",4 => "pointer");
//        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false",4 => "false");
//        $arrayAling = array(0 => "center", 1 => "left", 2 => "center", 3 => "center",4 => "center");
//        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
        //borrador
        $arrayCabecera = array(0 => "Codigo Turno", 1 => "Descripcion Turno", 2 => "Nomenclatura", 3 => "IdTurnoAreaSede", 4 => "Estado", 5 => "CodColor", 6 => "opcion", 7 => "opcion");
        $arrayTamano = array(0 => "50", 1 => "100", 2 => "40", 3 => "50", 4 => "50", 5 => "50", 6 => "50", 7 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "img", 7 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "pointer", 7 => "pointer");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "true", 4 => "false", 5 => "true", 6 => "false", 7 => "true");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "center", 3 => "center", 4 => "center", 5 => "center", 6 => "center", 7 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);



        return $resultado;
    }

//modificado 23 Abril2012 JCQA
    public function RefrescarTablaTurnosSeleccionadosxArea($nomSedeEmpresaArea) {
        $oLRrhh = new LRrhh();

        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRrhh->listaTurnosxSedeEmpresaArea($nomSedeEmpresaArea);




//        $arrayCabecera = array(0 => "Codigo Turno", 1 => "Descripcion Turno", 2 => "Nomenclatura", 3 => "IdTurnoAreaSede");
//        $arrayTamano = array(0 => "70", 1 => "120", 2 => "40", 3 => "50");
//        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
//        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default");
//        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false");
//        $arrayAling = array(0 => "center", 1 => "left", 2 => "center", 3 => "center");
//        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);


        $arrayCabecera = array(0 => "Codigo Turno", 1 => "Descripcion Turno", 2 => "Nomenclatura", 3 => "IdTurnoAreaSede", 4 => "Estado", 5 => "CodColor", 6 => "opcion", 7 => "opcion");
        $arrayTamano = array(0 => "50", 1 => "100", 2 => "40", 3 => "50", 4 => "50", 5 => "50", 6 => "50", 7 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "img", 7 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "pointer", 7 => "pointer");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "true", 4 => "false", 5 => "true", 6 => "false", 7 => "true");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "center", 3 => "center", 4 => "center", 5 => "center", 6 => "center", 7 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);



        return $resultado;
    }

    public function mantenimientoTurnoCordi($datos) {
        $oLRrhh = new LRrhh();


        // $arrayListaTurnosDisponibles=$oLRrhh->listaTurnosDisponibles($datos["idSedeempresaArea"]);
        // $arrayListaTurnosxSedeEmpresaArea=$oLRrhh->listaTurnosxSedeEmpresaArea($datos["idSedeempresaArea"]);
//        print_r($datos) ;
//        $jc="holitas";
//        $comboSucursal = $oLRrhh->listaSucursal('0110073', '');
        require_once("../../cvista/rrhh/mantenimientoTurno.php");
    }

//funciones agregadas el 09Mayo 2012

    public function abrirPopPupArbolAreasConCoordinador($datos) {
        $oLRrhh = new LRrhh();
        // $arrayListaTurnosDisponibles=$oLRrhh->listaTurnosDisponibles($datos["idSedeempresaArea"]);
        // $arrayListaTurnosxSedeEmpresaArea=$oLRrhh->listaTurnosxSedeEmpresaArea($datos["idSedeempresaArea"]);
//        print_r($datos) ;
//        $jc="holitas";
//        $comboSucursal = $oLRrhh->listaSucursal('0110073', '');
        require_once("../../cvista/rrhh/PopPupArbolAreasConCoordinador.php");
    }

    public function abrirPopPupArbolAreasSinCoordinador() {
        $oLRrhh = new LRrhh();

        require_once("../../cvista/rrhh/PopPupArbolAreasSinCoordinador.php");
    }

    //Funcion Agregada 19 Abril 2012 JCQA

    public function abrirPoPupColorTurnoSeleccionadoPorArea($datos) {
        $oLRrhh = new LRrhh();


        // $arrayListaTurnosDisponibles=$oLRrhh->listaTurnosDisponibles($datos["idSedeempresaArea"]);
        // $arrayListaTurnosxSedeEmpresaArea=$oLRrhh->listaTurnosxSedeEmpresaArea($datos["idSedeempresaArea"]);
//        print_r($datos) ;
//        $jc="holitas";
//        $comboSucursal = $oLRrhh->listaSucursal('0110073', '');
        require_once("../../cvista/rrhh/seleccionarColorTurnoArea.php");
    }

    public function mantenimientoEditarCordinador($datos) {
        $oLRrhh = new LRrhh();

        //print_r($datos);
        // $arrayListaTurnosDisponibles=$oLRrhh->listaTurnosDisponibles($datos["idSedeempresaArea"]);
        // $arrayListaTurnosxSedeEmpresaArea=$oLRrhh->listaTurnosxSedeEmpresaArea($datos["idSedeempresaArea"]);
//        print_r($datos) ;
//        $jc="holitas";
//        $comboSucursal = $oLRrhh->listaSucursal('0110073', '');
        require_once("../../cvista/rrhh/mantenimientoCordi.php");
    }

    public function nuevaSubArea() {
        $oLRrhh = new LRrhh();
        $comboSucursal = $oLRrhh->listaSucursal('0110073', '');
        require_once("../../cvista/rrhh/vGuardarSubArea.php");
    }

    public function buscarEmpleado() {
        $o_LPersona = new ActionPersona();
        $comboTipoDocumentos = $o_LPersona->comboTipoDocumento('1');
        require_once("../../cvista/rrhh/buscarEmpleado.php");
    }

    /////
    public function buscarCoordinadores() {
        $o_LPersona = new ActionPersona();
        //$comboTipoDocumentos = $o_LPersona->comboTipoDocumento('1');
        require_once("../../cvista/rrhh/BuscarCoordinadoresParaAsignar.php");
    }

    ////

    public function AsignarEmpleadoArea($datos) {
        $oLRrhh = new LRrhh();
        $respuesta = $oLRrhh->AsignarEmpleadoArea($datos);
        return $respuesta;
    }

//  08 de Mayo 2012  

    public function replicarPreProgramación($datos) {
        $oLRrhh = new LRrhh();
        $respuesta = $oLRrhh->replicarPreProgramación($datos);
        return $respuesta;
    }

    public function asignarsolofechasCoordinador($datos) {
        $oLRrhh = new LRrhh();
        $respuesta = $oLRrhh->asignarsolofechasCoordinador($datos);
        return $respuesta;
    }

//                ***********************************************************************************************************************************                  
//                ************************************Creado por Jose Quispe Araoz 29 Marzo 12 desactivar a un Coordinador Asignado*****************
//                ***********************************************************************************************************************************   


    public function DesactivarCoordinadorDeArea($datos) {
        $oLRrhh = new LRrhh();
        $respuesta = $oLRrhh->DesactivarCoordinadorDeArea($datos);
        return $respuesta;
    }

    public function asignarNuevoCoordinadorAlArea($datos) {
        $oLRrhh = new LRrhh();
        $respuesta = $oLRrhh->asignarNuevoCoordinadorAlArea($datos);
        return $respuesta;
    }

    public function editarEncargadoArea($datos) {
        $oLRrhh = new LRrhh();
        $respuesta = $oLRrhh->editarEncargadoArea($datos);
        $resp = "|";
        if ($respuesta)
            $resp = $respuesta[0][0] . "|" . $respuesta[0][1];
        return $resp;
    }

//
//    public function grabarSedeEmpresaArea($datos) {
//        $oLRrhh = new LRrhh();
//        $resultado = $oLRrhh->grabarSedeEmpresaArea($datos);
//        return $resultado;
//    }
    public function grabarAreaCCosto($datos) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->grabarAreaCCosto($datos);
        return $resultado;
    }

    public function modificarArea($datos) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->modificarArea($datos);
        return $resultado;
    }

//jose 2012/02/20****************/
    public function modificarSubArea($datos) {

        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->modificarSubArea($datos);
        return $resultado;
    }

    //******************************/

    public function eliminarArea($datos) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->eliminarArea($datos);
        return $resultado;
    }

    public function listaTablaArea($idSucursal) {

        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRrhh->listaTablaArea($idSucursal);

        $arrayCabecera = array(0 => "idSedeEmpresaArea", 1 => "idArea", 2 => "Nombre Área", 3 => "Abreviatura");
        $arrayTamano = array(0 => "50", 1 => "50", 2 => "400", 3 => "100");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "pointer", 3 => "default");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "false", 3 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function abrirPuestoArea($datos) {
        $oLRrhh = new LRrhh();
        $cboCategoriaPuesto = $oLRrhh->categoriaPuesto();
        require_once '../../cvista/rrhh/puestoArea.php';
    }

//    public function listPuestoAreaYccosto($datos) {
//        $oLRrhh = new LRrhh();
//        $o_TablaHtmlx = new tablaDHTMLX();
//        $arrayFilas = $oLRrhh->listPuestoAreaYccosto($datos);
//
//        if($datos["p2"]=="NCC") {
//            $arrayCabecera=array(0=>"iIdPuesto",1=>"Nombre Puesto",2=>"Estado",3=>"estado");
//            $arrayTamano=array(0=>"50",1=>"300",2=>"80",3=>"50");
//            $arrayTipo=array(0=>"ro",1=>"ro",2=>"ro",3=>"ro");
//            $arrayCursor=array(0=>"default",1=>"pointer",2=>"pointer",3=>"default");
//            $arrayHidden=array(0=>"true",1=>"false",2=>"false",3=>"true");
//            $arrayAling=array(0=>"left",1=>"left",2=>"left",3=>"left");
//        }else {
//            $arrayCabecera=array(0=>"iIdPuesto",1=>"Nombre Puesto",2=>"Centro Costo",3=>"Estado",4=>"estado");
//            $arrayTamano=array(0=>"50",1=>"300",2=>"300",3=>"80",4=>"50");
//            $arrayTipo=array(0=>"ro",1=>"ro",2=>"ro",3=>"ro",4=>"ro");
//            $arrayCursor=array(0=>"default",1=>"pointer",2=>"pointer",3=>"default",4=>"default");
//            $arrayHidden=array(0=>"true",1=>"false",2=>"false",3=>"false",4=>"true");
//            $arrayAling=array(0=>"left",1=>"left",2=>"left",3=>"left",4=>"left");
//        }
//        return $o_TablaHtmlx->generaTabla($arrayCabecera,$arrayFilas,$arrayTamano,$arrayTipo,$arrayCursor,$arrayHidden,$arrayAling);
//    }

    public function listPuestosxCategoria($datos) {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRrhh->listPuestosxCategoria($datos);

        $arrayCabecera = array(0 => "iidPuesto", 1 => "iidCategoriaPuesto", 2 => "iidCentroCosto", 3 => "Puesto", 4 => "bPrincipal", 5 => "bEstado", 6 => "Estado");
        $arrayTamano = array(0 => "50", 1 => "50", 2 => "50", 3 => "330", 4 => "50", 5 => "50", 6 => "100");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "pointer", 4 => "default", 5 => "default", 6 => "default");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "true", 3 => "false", 4 => "true", 5 => "true", 6 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function grabarModalidadContrato($datos) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->grabarModalidadContrato($datos);
        return $resultado;
    }

    public function registroHorariosEmpleadosRrhh() {
        $oLRrhh = new LRrhh();
//        $comboSucursal = $oLRrhh->listaSucursal('0110073', '');
//        $comboContrato = $oLRrhh->listaModalidadContrato();
        require_once '../../cvista/rrhh/reporteActualizacionEliminacionInsert.php';
    }

    public function listTablaHorarios__________($datos) {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();

        $empleados = $oLRrhh->empleadoXarea($datos); // Se recupera a todos los empleados que pertenecen a una area especifica
        $cboTESA = $oLRrhh->listaTurnoSedeEmpresaArea($datos); // Se recupera los turnos que pertenecen al area de una sede
        $datosEmpleadoProg = $oLRrhh->listaTurnoProgramado("", $datos["iIdProgramacionpersonal"], $datos["mes"], $datos["anio"], 'empleadoProgramado', "", $datos["idSEACC"]); // se recupera a todos los empleados que ya fueron programados, tambien puede retornar null
        $idEmpleadoProgramado = $datosEmpleadoProg;
        /* =========================== Set datos a la cabecera =========================== */
        $arrayCabecera = array(0 => "Accion", 1 => "Hr.", 2 => "+", 3 => "idEmpleado", 4 => "EMPLEADOS A PROGRAMAR", 5 => "Total de Horas");
        /* ========================== fin datos cabecera ================================= */

        /* ================= Set datos para las columnas fijas =========================== */
        $arrayFilas = array();
        $datosEmpleados = array();
        $filx = 0;
        foreach ($empleados as $i => $value) {
            if ($datosEmpleadoProg) {
                $r = 0;
                foreach ($datosEmpleadoProg as $j => $val) {
                    if ($empleados[$i][0] == $datosEmpleadoProg[$j][0]) {
                        $arrayFilas[$filx + $r][0] = "../../../../fastmedical_front/imagen/icono/editar.png ^ Editar";
                        $arrayFilas[$filx + $r][1] = "../../../../fastmedical_front/imagen/icono/timer.png ^ Ver";
                        $arrayFilas[$filx + $r][2] = "../../../../fastmedical_front/imagen/icono/abrir16.png ^  Agragar otro turno";
                        $arrayFilas[$filx + $r][3] = $empleados[$i][0];
                        $arrayFilas[$filx + $r][4] = $empleados[$i][1] . " " . $empleados[$i][2] . " " . $empleados[$i][3];
//--$arrayFilas[$filx+$r][5]="0.00"; //este dato se inserta mas abajo
//------------------------------------------------------
                        $datosEmpleados[$filx + $r][0] = $empleados[$i][0];
                        $datosEmpleados[$filx + $r][1] = $datosEmpleadoProg[$j][2];
//------------------------------------------------------
                        $r++;
                        $filx = ($filx + $r) - 1;
                        if ($r == $datosEmpleadoProg[$j][1]) {
                            for ($p = 0; $p < $r; $p++) {
                                if ($p > 0)
                                    $arrayFilas[$filx - $p][2] = "../../../../fastmedical_front/imagen/icono/no_add.png ^ ...";
                                unset($datosEmpleadoProg[$j - $p]);
                            }
                            break;
                        }
                    }
                    else {
                        $arrayFilas[$filx][0] = "../../../../fastmedical_front/imagen/icono/grabar.png ^ Grabar";
                        $arrayFilas[$filx][1] = "../../../../fastmedical_front/imagen/icono/timer.png ^ Ver";
                        $arrayFilas[$filx][2] = "../../../../fastmedical_front/imagen/icono/abrir16.png ^  Agragar otro turno";
                        $arrayFilas[$filx][3] = $empleados[$i][0];
                        $arrayFilas[$filx][4] = $empleados[$i][1] . " " . $empleados[$i][2] . " " . $empleados[$i][3];
//--$arrayFilas[$filx][5]="0.00"; //este dato se inserta mas abajo
//------------------------------------------------------
                        $datosEmpleados[$filx][0] = $empleados[$i][0];
                        $datosEmpleados[$filx][1] = "1"; //$datosEmpleadoProg[$j][2];
//------------------------------------------------------
                    }
                }
            } else {
                $arrayFilas[$filx][0] = "../../../../fastmedical_front/imagen/icono/grabar.png ^ Grabar";
                $arrayFilas[$filx][1] = "../../../../fastmedical_front/imagen/icono/timer.png ^ Ver";
                $arrayFilas[$filx][2] = "../../../../fastmedical_front/imagen/icono/abrir16.png ^  Agragar otro turno";
                $arrayFilas[$filx][3] = $empleados[$i][0];
                $arrayFilas[$filx][4] = $empleados[$i][1] . " " . $empleados[$i][2] . " " . $empleados[$i][3];
//--$arrayFilas[$filx][5]="0.00"; //este dato se inserta mas abajo
//------------------------------------------------------
                $datosEmpleados[$filx][0] = $empleados[$i][0];
                $datosEmpleados[$filx][1] = "1";
//------------------------------------------------------
            }
            $filx++;
        }

        $arrayTamano = array(0 => "45", 1 => "30", 2 => "30", 3 => "20", 4 => "220", 5 => "80");
        $arrayTipo = array(0 => "img", 1 => "img", 2 => "img", 3 => "ro", 4 => "ro", 5 => "ro");
        $arrayCursor = array(0 => "pointer", 1 => "pointer", 2 => "pointer", 3 => "default", 4 => "default", 5 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false");
        $arrayAling = array(0 => "center", 1 => "center", 2 => "center", 3 => "left", 4 => "left", 5 => "center");
        $arrayCombo = array();
        /* =================  fin Set datos para las columnas fijas ====================== */
//        print_r($datosEmpleados);
        /* =============================   Manejo de fechas   ============================ */
        $diasSem = Array('Monday' => 'Lunes', 'Tuesday' => 'Martes', 'Wednesday' => 'Miercoles', 'Thursday' => 'Jueves', 'Friday' => 'Viernes', 'Saturday' => 'Sabado', 'Sunday' => 'Domingo');
        $fecha = getdate(time());
        if ($datos["mes"] != "")
            $mes = $datos["mes"];
        else
            $mes = $fecha['mon'];
        if ($datos["anio"] != "")
            $anio = $datos["anio"];
        else
            $anio = $fecha['year'];
        $fecha = mktime(0, 0, 0, $mes, 1, $anio);
        $fechaInicioMes = mktime(0, 0, 0, $mes, 1, $anio);
        $fechaInicioMes = date("w", $fechaInicioMes);

        $ultimoDia = date('t', $fecha);
        $númeroDeDias = intval(date("t", $mes));
        /* =============================   Fin Manejo de fechas   ============================ */

        /* ============  Set de la cabecera de las horas programadas existentes  ============= */
        $diaMes = 0;
        for ($coln = 6; $coln < $númeroDeDias + 6; $coln++) {
            if ($diaMes < $ultimoDia) {
                $diaMes++;
                $diaInicial = date("l", mktime(0, 0, 0, $mes, $diaMes, $anio));
                $arrayCabecera[$coln] = $diasSem[$diaInicial] . " - " . $diaMes;
                $arrayTamano[$coln] = "130";
                $arrayTipo[$coln] = "co";
                $arrayCursor[$coln] = "pointer";
                $arrayHidden[$coln] = "false";
                $arrayAling[$coln] = "center";
            }
        }
        /* ==========  Fin set de la cabecera de las horas programadas existentes  ============ */

        /* ================== set datos de las horas programadas existentes  ================= */
        $turnoProgramado = array();
        $flag = "NO";
        $totalHoras = "0.0";
//================================================================================================
//        print_r($datosEmpleados);
        foreach ($datosEmpleados as $i => $valor) {
            $diaMes = 0;
            if ($idEmpleadoProgramado) {  //verificar que haya empleados programados
                foreach ($idEmpleadoProgramado as $j => $valx) {
                    if ($datosEmpleados[$i][0] == $idEmpleadoProgramado[$j][0]) {
                        $oLRrhh = new LRrhh();

                        $turnoProgramado = $oLRrhh->listaTurnoProgramado($idEmpleadoProgramado[$j][0], $datos["iIdProgramacionpersonal"], $datos["mes"], $datos["anio"], 'listaTurnoProgramado', $datosEmpleados[$i][1], $datos["idSEACC"]);
                        if ($turnoProgramado && $turnoProgramado[0][2] == null)
                            $arrayFilas[$i][0] = "../../../../fastmedical_front/imagen/icono/adicionar.png ^ Adicionar";
                        $flag = "SI";
                        unset($idEmpleadoProgramado[$j]);
                        break;
                    }
                    else {
                        $turnoProgramado = null;
                        $flag = "NO";
                    }
                }
                $totalHoras = "0";
                if ($flag == "SI") {
                    foreach ($turnoProgramado as $r => $value) {
                        $totalHoras = $totalHoras + $value[5];
                    }
                }
            }else
                $totalHoras = "0";
            $cadenaHid = "";
            for ($coln = 6; $coln < $númeroDeDias + 6; $coln++) {
                if ($diaMes < $ultimoDia) {
                    $diaMes++;
                    if ($flag == "NO")
                        $arrayFilas[$i][$coln] = "Doble Click";
                    else {
                        if ($turnoProgramado) {
                            foreach ($turnoProgramado as $n => $value) {
                                if ($turnoProgramado[$n][4] == $diaMes) {
                                    foreach ($cboTESA as $s => $val) {
                                        if ($cboTESA[$s][0] == $turnoProgramado[$n][2]) {
                                            $arrayFilas[$i][$coln] = "( " . $cboTESA[$s][1] . " ) " . $cboTESA[$s][2];
                                            if ($cadenaHid == "")
                                                $cadenaHid.=$turnoProgramado[$n][0] . "_" . $diaMes . "_" . $turnoProgramado[$n][5];
                                            else
                                                $cadenaHid.="|" . $turnoProgramado[$n][0] . "_" . $diaMes . "_" . $turnoProgramado[$n][5];
                                            unset($turnoProgramado[$n]);
                                            break;
                                        }
                                        else if ($cboTESA[$s][0] == $turnoProgramado[$n][2] && $turnoProgramado[$n][2] != null)
                                            $arrayFilas[$i][$coln] = "Doble Click";
//----------------------------------------------------------------
                                        if ($turnoProgramado[$n][2] == null) {
                                            $arrayFilas[$i][$coln] = "Doble Click"; //es nulo
                                            if ($cadenaHid == "")
                                                $cadenaHid.=$turnoProgramado[$n][0] . "_" . $diaMes . "_" . $turnoProgramado[$n][5];
                                            else
                                                $cadenaHid.="|" . $turnoProgramado[$n][0] . "_" . $diaMes . "_" . $turnoProgramado[$n][5];
                                            unset($turnoProgramado[$n]);
                                            break;
                                        }
//---------------------------------------------------------------
                                    }
                                    break;
                                }else
                                    $arrayFilas[$i][$coln] = "Doble Click";
                            }
                        }else
                            $arrayFilas[$i][$coln] = "Doble Click";
                    }
                }
            }
            $arrayFilas[$i][$númeroDeDias + 6] = $cadenaHid; //la concadenacion del idTurnoSedeEmpresaArea y dia
            $arrayFilas[$i][$númeroDeDias + 7] = $totalHoras;
            $arrayFilas[$i][$númeroDeDias + 8] = $datosEmpleados[$i][1]; //numero de programacioones: 1 o 2
            $arrayFilas[$i][5] = $totalHoras;
        }
//================================================================================================
        /* ===============  Fin set datos de las horas programadas existentes  =============== */

        /* ========================= Cabecera de los hidden ocultos  ========================= */
        $arrayCabecera[$númeroDeDias + 6] = "idTSEADia";
        $arrayTamano[$númeroDeDias + 6] = "100";
        $arrayTipo[$númeroDeDias + 6] = "ro";
        $arrayCursor[$númeroDeDias + 6] = "default";
        $arrayHidden[$númeroDeDias + 6] = "true";
        $arrayAling[$númeroDeDias + 6] = "center";
        $arrayCabecera[$númeroDeDias + 7] = "totalHoras";
        $arrayTamano[$númeroDeDias + 7] = "50";
        $arrayTipo[$númeroDeDias + 7] = "ro";
        $arrayCursor[$númeroDeDias + 7] = "default";
        $arrayHidden[$númeroDeDias + 7] = "true";
        $arrayAling[$númeroDeDias + 7] = "center";
        $arrayCabecera[$númeroDeDias + 8] = "nroProg";
        $arrayTamano[$númeroDeDias + 8] = "50";
        $arrayTipo[$númeroDeDias + 8] = "ro";
        $arrayCursor[$númeroDeDias + 8] = "default";
        $arrayHidden[$númeroDeDias + 8] = "false";
        $arrayAling[$númeroDeDias + 8] = "center";
        /* ==================== Fin de la cabecera de los hidden ocultos =================== */

        /* ================================================================================= */
        /* =============================== Llenado del Combo =============================== */
        $arrayCombo = array();
        if ($cboTESA) {
            foreach ($cboTESA as $i => $value) {
                $arrayCombo[$i][0] = $value[0] . "|" . $value[3];
                $arrayCombo[$i][1] = "( " . $value[1] . " ) " . $value[2];
            }
        } else {
            $arrayCombo[0][0] = "";
            $arrayCombo[0][1] = "No hay data";
        }
        /* ============================  Fin Llenado del Combo ============================ */
        /* ================================================================================ */
        return $o_TablaHtmlx->generaTablaFullCombo($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling, $arrayCombo);
    }

    public function listTablaHorarios($datos) {
        /*
         * Permisos
         */
        $oLRrhh = new LRrhh();
        $fechasP = $oLRrhh->fechaProgramacion($datos["iIdProgramacionpersonal"]);


        $btnGrabarComoHidden = true;
        if (isset($_SESSION["permiso_formulario_servicio"][232]["GRABAR_HOR_PROG_MEN_EMP"]) && ($_SESSION["permiso_formulario_servicio"][232]["GRABAR_HOR_PROG_MEN_EMP"] == 1)) {
            $btnGrabarComoHidden = false;
        }

        $btnTotalHorasComoHidden = true;
        if (isset($_SESSION["permiso_formulario_servicio"][232]["VER_HORAS_PROG_MEN_EMP"]) && ($_SESSION["permiso_formulario_servicio"][232]["VER_HORAS_PROG_MEN_EMP"] == 1)) {
            $btnTotalHorasComoHidden = false;
        }

        $btnAgregarOtroTurnoComoHidden = true;
        if (isset($_SESSION["permiso_formulario_servicio"][232]["AGREGAR_OTRO_TURNO_PROG_MEN_EMP"]) && ($_SESSION["permiso_formulario_servicio"][232]["AGREGAR_OTRO_TURNO_PROG_MEN_EMP"] == 1)) {
            $btnAgregarOtroTurnoComoHidden = false;
        }
        /*
         * Proceso
         */
        $o_TablaHtmlx = new tablaDHTMLX();
        $m = intval($datos["mes"]);
        $y = $datos["anio"];
        $mes = mktime(0, 0, 0, $m, 1, $y);
        $nDias = intval(date("t", $mes));
        $fechax = $nDias . "/" . $datos["mes"] . "/" . $datos["anio"];
        /*
          Lista de personas que pertenecen al area seleccionada y además estan con un tipo de contrato vigente hasta este mes
         */
        $empleados = $oLRrhh->empleadoXarea($datos["idSedeEmpresaArea"], $fechax, $datos["cboTipoContrato"], $datos["idSubArea"]); // Se recupera a todos los empleados que pertenecen a una area especifica
        /*
          Lista por Turnos con codigo estandarizado y areas
         */
        $cboTESA = $oLRrhh->listaTurnoSedeEmpresaArea($datos); // Se recupera los turnos que pertenecen al area de una sede
        /*
          Se recupera a todos los empleados que ya fueron programados, tambien puede retornar null
         */
        $datosEmpleadoProg = $oLRrhh->listaTurnoProgramado("", $datos["iIdProgramacionpersonal"], $datos["mes"], $datos["anio"], 'empleadoProgramado', "", $datos["idSEACC"], $datos["cboTipoContrato"]);
        $idEmpleadoProgramado = $datosEmpleadoProg;
        /* =========================== Set datos a la cabecera =========================== */
        $arrayCabecera = array(0 => "Accion", 1 => "Hr.", 2 => "+", 3 => "idEmpleado", 4 => "EMPLEADOS A PROGRAMAR", 5 => "Total de Horas");
        /* ========================== fin datos cabecera ================================= */

        /* ================= Set datos para las columnas fijas =========================== */
        $arrayFilas = array();
        $datosEmpleados = array();
        $filx = 0;

        foreach ($empleados as $i => $value) {
            if ($datosEmpleadoProg) {
                $r = 0;
                foreach ($datosEmpleadoProg as $j => $val) {
                    if ($empleados[$i][0] == $datosEmpleadoProg[$j][0]) {
                        $arrayFilas[$filx + $r][0] = "../../../../fastmedical_front/imagen/icono/editar.png ^ Editar";
                        $arrayFilas[$filx + $r][1] = "../../../../fastmedical_front/imagen/icono/timer.png ^ Ver";
                        $arrayFilas[$filx + $r][2] = "../../../../fastmedical_front/imagen/icono/abrir16.png ^  Agregar otro turno";
                        $arrayFilas[$filx + $r][3] = $empleados[$i][0];
                        $arrayFilas[$filx + $r][4] = $empleados[$i][1] . " " . $empleados[$i][2] . " " . $empleados[$i][3];
//--$arrayFilas[$filx+$r][5]="0.00"; //este dato se inserta mas abajo
//------------------------------------------------------
                        $datosEmpleados[$filx + $r][0] = $empleados[$i][0];
                        $datosEmpleados[$filx + $r][1] = $datosEmpleadoProg[$j][2];
                        $numProg = $datosEmpleadoProg[$j][1];
//------------------------------------------------------
                        $r++;
                        $filx = ($filx + $r) - 1;
                        if ($r == $numProg) {
                            for ($p = 0; $p < $r; $p++) {
                                if ($p > 0)
                                    $arrayFilas[$filx - $p][2] = "../../../../fastmedical_front/imagen/icono/no_add.png ^ ...";
                                unset($datosEmpleadoProg[$j - $p]);
                            }
                            break;
                        }
                    }
                    else {
                        $arrayFilas[$filx][0] = "../../../../fastmedical_front/imagen/icono/grabar.png ^ Grabar";
                        $arrayFilas[$filx][1] = "../../../../fastmedical_front/imagen/icono/timer.png ^ Ver";
                        $arrayFilas[$filx][2] = "../../../../fastmedical_front/imagen/icono/abrir16.png ^  Agregar otro turno";
                        $arrayFilas[$filx][3] = $empleados[$i][0];
                        $arrayFilas[$filx][4] = $empleados[$i][1] . " " . $empleados[$i][2] . " " . $empleados[$i][3];
//--$arrayFilas[$filx][5]="0.00"; //este dato se inserta mas abajo
//------------------------------------------------------
                        $datosEmpleados[$filx][0] = $empleados[$i][0];
                        $datosEmpleados[$filx][1] = "1"; //$datosEmpleadoProg[$j][2];
//------------------------------------------------------
                    }
                }
            } else {
                $arrayFilas[$filx][0] = "../../../../fastmedical_front/imagen/icono/grabar.png ^ Grabar";
                $arrayFilas[$filx][1] = "../../../../fastmedical_front/imagen/icono/timer.png ^ Ver";
                $arrayFilas[$filx][2] = "../../../../fastmedical_front/imagen/icono/abrir16.png ^  Agregar otro turno";
                $arrayFilas[$filx][3] = $empleados[$i][0];
                $arrayFilas[$filx][4] = $empleados[$i][1] . " " . $empleados[$i][2] . " " . $empleados[$i][3];
//--$arrayFilas[$filx][5]="0.00"; //este dato se inserta mas abajo
//------------------------------------------------------
                $datosEmpleados[$filx][0] = $empleados[$i][0];
                $datosEmpleados[$filx][1] = "1";
//------------------------------------------------------
            }
            $filx++;
        }
        $arrayTamano = array(0 => "45", 1 => "30", 2 => "30", 3 => "20", 4 => "220", 5 => "80");
        $arrayTipo = array(0 => "img", 1 => "img", 2 => "img", 3 => "ro", 4 => "ro", 5 => "ro");
        $arrayCursor = array(0 => "pointer", 1 => "pointer", 2 => "pointer", 3 => "default", 4 => "default", 5 => "default");
        $arrayHidden = array(0 => $btnGrabarComoHidden, 1 => $btnTotalHorasComoHidden, 2 => $btnAgregarOtroTurnoComoHidden, 3 => "true", 4 => "false", 5 => "false");
        $arrayAling = array(0 => "center", 1 => "center", 2 => "center", 3 => "left", 4 => "left", 5 => "center");
        $arrayCombo = array();
        /* =================  fin Set datos para las columnas fijas ====================== */
//        print_r($datosEmpleados);
        /* =============================   Manejo de fechas   ============================ */
        $diasSem = Array('Monday' => 'Lunes', 'Tuesday' => 'Martes', 'Wednesday' => 'Miercoles', 'Thursday' => 'Jueves', 'Friday' => 'Viernes', 'Saturday' => 'Sabado', 'Sunday' => 'Domingo');
        $fecha = getdate(time());
        if ($datos["mes"] != "")
            $mes = $datos["mes"];
        else
            $mes = $fecha['mon'];
        if ($datos["anio"] != "")
            $anio = $datos["anio"];
        else
            $anio = $fecha['year'];
        $fecha = mktime(0, 0, 0, $mes, 1, $anio);
        $fechaInicioMes = mktime(0, 0, 0, $mes, 1, $anio);
        $fechaInicioMes = date("w", $fechaInicioMes);

        $ultimoDia = date('t', $fecha);
        $númeroDeDias = intval(date("t", $mes));
        /* =============================   Fin Manejo de fechas   ============================ */

        /* ============  Set de la cabecera de las horas programadas existentes  ============= */
        $diaMes = 0;
        for ($coln = 6; $coln < $númeroDeDias + 6; $coln++) {
            if ($diaMes < $ultimoDia) {
                $diaMes++;
                $diaInicial = date("l", mktime(0, 0, 0, $mes, $diaMes, $anio));
                $arrayCabecera[$coln] = $diasSem[$diaInicial] . " - " . $diaMes;
                $arrayTamano[$coln] = "130";
                $arrayTipo[$coln] = "co";
                $arrayCursor[$coln] = "pointer";
                $arrayHidden[$coln] = "false";
                $arrayAling[$coln] = "center";
            }
        }
        /* ==========  Fin set de la cabecera de las horas programadas existentes  ============ */

        /* ================== set datos de las horas programadas existentes  ================= */
        $turnoProgramado = array();
        $flag = "NO";
        $totalHoras = "0.0";
//================================================================================================
//        print_r($datosEmpleados);
        foreach ($datosEmpleados as $i => $valor) {
            $diaMes = 0;
            if ($idEmpleadoProgramado) {  //verificar que haya empleados programados
                foreach ($idEmpleadoProgramado as $j => $valx) {
                    if ($datosEmpleados[$i][0] == $idEmpleadoProgramado[$j][0]) {
                        $oLRrhh = new LRrhh();

                        $turnoProgramado = $oLRrhh->listaTurnoProgramado($idEmpleadoProgramado[$j][0], $datos["iIdProgramacionpersonal"], $datos["mes"], $datos["anio"], 'listaTurnoProgramado', $datosEmpleados[$i][1], $datos["idSEACC"], $datos["cboTipoContrato"]);
                        if ($turnoProgramado && $turnoProgramado[0][2] == null)
                            $arrayFilas[$i][0] = "../../../../fastmedical_front/imagen/icono/adicionar.png ^ Adicionar";
                        $flag = "SI";
                        unset($idEmpleadoProgramado[$j]);
                        break;
                    }
                    else {
                        $turnoProgramado = null;
                        $flag = "NO";
                    }
                }
                $totalHoras = "0";
                if ($flag == "SI") {
                    foreach ($turnoProgramado as $r => $value) {
                        $totalHoras = $totalHoras + $value[5];
                    }
                }
            }else
                $totalHoras = "0";
            $cadenaHid = "";
            for ($coln = 6; $coln < $númeroDeDias + 6; $coln++) {
                if ($diaMes < $ultimoDia) {
                    $diaMes++;
                    if ($flag == "NO")
                        $arrayFilas[$i][$coln] = "Doble Click";
                    else {
                        if ($turnoProgramado) {
                            foreach ($turnoProgramado as $n => $value) {
                                if ($turnoProgramado[$n][4] == $diaMes) {
                                    foreach ($cboTESA as $s => $val) {
                                        if ($cboTESA[$s][0] == $turnoProgramado[$n][2]) {
                                            $arrayFilas[$i][$coln] = "( " . $cboTESA[$s][0] . " ) " . $cboTESA[$s][1];
                                            if ($cadenaHid == "")
                                                $cadenaHid.=$turnoProgramado[$n][0] . "_" . $diaMes . "_" . $turnoProgramado[$n][5];
                                            else
                                                $cadenaHid.="|" . $turnoProgramado[$n][0] . "_" . $diaMes . "_" . $turnoProgramado[$n][5];
                                            unset($turnoProgramado[$n]);
                                            break;
                                        }
                                        else if ($cboTESA[$s][0] == $turnoProgramado[$n][2] && $turnoProgramado[$n][2] != null)
                                            $arrayFilas[$i][$coln] = "Doble Click";
//----------------------------------------------------------------
                                        if ($turnoProgramado[$n][2] == null) {
                                            $arrayFilas[$i][$coln] = "Doble Click"; //es nulo
                                            if ($cadenaHid == "")
                                                $cadenaHid.=$turnoProgramado[$n][0] . "_" . $diaMes . "_" . $turnoProgramado[$n][5];
                                            else
                                                $cadenaHid.="|" . $turnoProgramado[$n][0] . "_" . $diaMes . "_" . $turnoProgramado[$n][5];
                                            unset($turnoProgramado[$n]);
                                            break;
                                        }
//---------------------------------------------------------------
                                    }
                                    break;
                                }else
                                    $arrayFilas[$i][$coln] = "Doble Click";
                            }
                        }else
                            $arrayFilas[$i][$coln] = "Doble Click";
                    }
                }
            }
            $arrayFilas[$i][$númeroDeDias + 6] = $cadenaHid; //la concadenacion del idTurnoSedeEmpresaArea y dia
            $arrayFilas[$i][$númeroDeDias + 7] = $totalHoras;
            $arrayFilas[$i][$númeroDeDias + 8] = $datosEmpleados[$i][1]; //numero de programacioones: 1 o 2
            $arrayFilas[$i][5] = $totalHoras;
        }
//================================================================================================
        /* ===============  Fin set datos de las horas programadas existentes  =============== */

        /* ========================= Cabecera de los hidden ocultos  ========================= */
        $arrayCabecera[$númeroDeDias + 6] = "idTSEADia";
        $arrayTamano[$númeroDeDias + 6] = "100";
        $arrayTipo[$númeroDeDias + 6] = "ro";
        $arrayCursor[$númeroDeDias + 6] = "default";
        $arrayHidden[$númeroDeDias + 6] = "true";
        $arrayAling[$númeroDeDias + 6] = "center";
        $arrayCabecera[$númeroDeDias + 7] = "totalHoras";
        $arrayTamano[$númeroDeDias + 7] = "50";
        $arrayTipo[$númeroDeDias + 7] = "ro";
        $arrayCursor[$númeroDeDias + 7] = "default";
        $arrayHidden[$númeroDeDias + 7] = "true";
        $arrayAling[$númeroDeDias + 7] = "center";
        $arrayCabecera[$númeroDeDias + 8] = "nroProg";
        $arrayTamano[$númeroDeDias + 8] = "50";
        $arrayTipo[$númeroDeDias + 8] = "ro";
        $arrayCursor[$númeroDeDias + 8] = "default";
        $arrayHidden[$númeroDeDias + 8] = "true";
        $arrayAling[$númeroDeDias + 8] = "center";
        /* ==================== Fin de la cabecera de los hidden ocultos =================== */

        /* ================================================================================= */
        /* =============================== Llenado del Combo =============================== */
        $arrayCombo = array();
        if ($cboTESA) {
            foreach ($cboTESA as $i => $value) {
                $arrayCombo[$i][0] = $value[0] . "|" . $value[2];
                $arrayCombo[$i][1] = "( " . $value[0] . " ) " . $value[1];
            }
        } else {
            $arrayCombo[0][0] = "";
            $arrayCombo[0][1] = "No hay data";
        }
        /* ============================  Fin Llenado del Combo ============================ */
        /* ================================================================================ */
        return $o_TablaHtmlx->generaTablaFullCombo($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling, $arrayCombo);
    }

    public function mantTurnoSucursalArea() {
//        $oLRrhh = new LRrhh();
//        $cboLeyendaTurno = $oLRrhh->listaLeyendaID();
        require_once '../../cvista/rrhh/mantenimientoTurnoSucursalArea.php';
    }

    public function exportarExcelHorarios($datos) {
        $oLRrhh = new LRrhh();
//        $nDias = intval(date("t", $datos["mes"]));

        $mes = mktime(0, 0, 0, $datos["mes"], 1, $datos["anio"]);
        setlocale('LC_ALL', 'fr_FR');
        $nDias = date("t", $mes);


        $fechax = $nDias . "/" . $datos["mes"] . "/" . $datos["anio"];
        $empleados = $oLRrhh->empleadoXarea($datos["idSedeEmpresaArea"], $fechax, $datos["cboTipoContrato"], $datos["idSubArea"]); // Se recupera a todos los empleados que pertenecen a una area especifica
        $cboTESA = $oLRrhh->listaTurnoSedeEmpresaArea($datos); // Se recupera los turnos que pertenecen al area de una sede
        $leyendaTESA = $cboTESA;
        $datosEmpleadoProg = $oLRrhh->listaTurnoProgramado("", $datos["iIdProgramacionpersonal"], $datos["mes"], $datos["anio"], 'empleadoProgramado', "", $datos["idSEACC"], $datos["cboTipoContrato"]); // se recupera a todos los empleados que ya fueron programados, tambien puede retornar null
        $idEmpleadoProgramado = $datosEmpleadoProg;
        /* =========================== Set datos a la cabecera =========================== */
        $arrayCabecera = array(0 => "CODIGO", 1 => "EMPLEADOS PROGRAMADOS");
        /* ========================== fin datos cabecera ================================= */

        /* ================= Set datos para las columnas fijas =========================== */
        $arrayFilas = array();
        $datosEmpleados = array();
        $filx = 0;
        foreach ($empleados as $i => $value) {
            if ($datosEmpleadoProg) {
                $r = 0;
                foreach ($datosEmpleadoProg as $j => $val) {
                    if ($empleados[$i][0] == $datosEmpleadoProg[$j][0]) {
                        $arrayFilas[$filx + $r][0] = $empleados[$i][0];
                        $arrayFilas[$filx + $r][1] = $empleados[$i][1] . " " . $empleados[$i][2] . " " . $empleados[$i][3];
//------------------------------------------------------
                        $datosEmpleados[$filx + $r][0] = $empleados[$i][0];
                        $datosEmpleados[$filx + $r][1] = $datosEmpleadoProg[$j][2];
//------------------------------------------------------
                        $r++;
                        $filx = ($filx + $r) - 1;
                        if ($r == $datosEmpleadoProg[$j][1]) {
                            for ($p = 0; $p < $r; $p++) {
                                unset($datosEmpleadoProg[$j - $p]);
                            }
                            break;
                        }
                    } else {
                        $arrayFilas[$filx][0] = $empleados[$i][0];
                        $arrayFilas[$filx][1] = $empleados[$i][1] . " " . $empleados[$i][2] . " " . $empleados[$i][3];
//------------------------------------------------------
                        $datosEmpleados[$filx][0] = $empleados[$i][0];
                        $datosEmpleados[$filx][1] = "1"; //$datosEmpleadoProg[$j][2];
//------------------------------------------------------
                    }
                }
            } else {
                $arrayFilas[$filx][0] = $empleados[$i][0];
                $arrayFilas[$filx][1] = $empleados[$i][1] . " " . $empleados[$i][2] . " " . $empleados[$i][3]; // es el nombre del empleado
//------------------------------------------------------
                $datosEmpleados[$filx][0] = $empleados[$i][0];
                $datosEmpleados[$filx][1] = "1";
//------------------------------------------------------
            }
            $filx++;
        }
        $arrayHidden = array(0 => "false", 1 => "false");
        $arrayAling = array(0 => "left", 1 => "left");
//        $arrayCombo=array();
        /* =================  fin Set datos para las columnas fijas ====================== */
//        print_r($datosEmpleados);
        /* =============================   Manejo de fechas   ============================ */
        $diasSem = Array('Monday' => 'L', 'Tuesday' => 'M', 'Wednesday' => 'M', 'Thursday' => 'J', 'Friday' => 'V', 'Saturday' => 'S', 'Sunday' => 'D');
        $fecha = getdate(time());
        if ($datos["mes"] != "")
            $mes = $datos["mes"];
        else
            $mes = $fecha['mon'];
        if ($datos["anio"] != "")
            $anio = $datos["anio"];
        else
            $anio = $fecha['year'];
        $fecha = mktime(0, 0, 0, $mes, 1, $anio);
        $fechaInicioMes = mktime(0, 0, 0, $mes, 1, $anio);
        $fechaInicioMes = date("w", $fechaInicioMes);

        $ultimoDia = date('t', $fecha);
//        $númeroDeDias = intval(date("t", $mes));
        $mes1 = mktime(0, 0, 0, $datos["mes"], 1, $datos["anio"]);
        setlocale('LC_ALL', 'fr_FR');
        $númeroDeDias = date("t", $mes1);

        /* =============================   Fin Manejo de fechas   ============================ */

        /* ============  Set de la cabecera de las horas programadas existentes  ============= */
        $diaMes = 0;
        for ($coln = 2; $coln < $númeroDeDias + 2; $coln++) {
            if ($diaMes < $ultimoDia) {
                $diaMes++;
                $diaInicial = date("l", mktime(0, 0, 0, $mes, $diaMes, $anio));
                $arrayCabecera[$coln] = $diasSem[$diaInicial] . " - " . $diaMes; // es la cabecera
                $arrayHidden[$coln] = "false";
                $arrayAling[$coln] = "center";
            }
        }
        /* ==========  Fin set de la cabecera de las horas programadas existentes  ============ */

        /* ================== set datos de las horas programadas existentes  ================= */
        $turnoProgramado = array();
        $flag = "NO";
        $totalHoras = "0.0";
//================================================================================================
        foreach ($datosEmpleados as $i => $valor) {
            $diaMes = 0;
            if ($idEmpleadoProgramado) {  //verificar que haya empleados programados
                foreach ($idEmpleadoProgramado as $j => $valx) {
                    if ($datosEmpleados[$i][0] == $idEmpleadoProgramado[$j][0]) {
                        $oLRrhh = new LRrhh();
                        $turnoProgramado = $oLRrhh->listaTurnoProgramado($idEmpleadoProgramado[$j][0], $datos["iIdProgramacionpersonal"], $datos["mes"], $datos["anio"], 'listaTurnoProgramado', $datosEmpleados[$i][1], $datos["idSEACC"], $datos["cboTipoContrato"]);
                        $flag = "SI";
                        unset($idEmpleadoProgramado[$j]);
                        break;
                    } else {
                        $turnoProgramado = null;
                        $flag = "NO";
                    }
                }
                $totalHoras = "0";
                if ($flag == "SI") {
                    foreach ($turnoProgramado as $r => $value) {
                        $totalHoras = $totalHoras + $value[5];
                    }
                }
            }else
                $totalHoras = "0";

            for ($coln = 2; $coln < $númeroDeDias + 2; $coln++) {
                if ($diaMes < $ultimoDia) {
                    $diaMes++;
                    if ($flag == "NO")
                        $arrayFilas[$i][$coln] = "";
                    else {
                        if ($turnoProgramado) {
                            foreach ($turnoProgramado as $n => $value) {
                                if ($turnoProgramado[$n][4] == $diaMes) {
                                    foreach ($cboTESA as $s => $val) {
                                        if ($cboTESA[$s][0] == $turnoProgramado[$n][2]) {
                                            $arrayFilas[$i][$coln] = $cboTESA[$s][0];  ////// aqui modifique para que se note el turno Jorge Hernandez
                                            unset($turnoProgramado[$n]);
                                            break;
                                        } else if ($cboTESA[$s][0] == $turnoProgramado[$n][2] && $turnoProgramado[$n][2] != null)
                                            $arrayFilas[$i][$coln] = "";
//----------------------------------------------------------------
                                        if ($turnoProgramado[$n][2] == null) {
                                            $arrayFilas[$i][$coln] = ""; //es nulo
                                            unset($turnoProgramado[$n]);
                                            break;
                                        }
//---------------------------------------------------------------
                                    }
                                    break;
                                }else
                                    $arrayFilas[$i][$coln] = "";
                            }
                        }else
                            $arrayFilas[$i][$coln] = "";
                    }
                }
            }
            $arrayFilas[$i][$númeroDeDias + 3] = $totalHoras;
        }
//================================================================================================
        /* ===============  Fin set datos de las horas programadas existentes  =============== */

        $arrayCabecera[$númeroDeDias + 3] = "Horas Totales";
        $arrayHidden[$númeroDeDias + 3] = "false";
        $arrayAling[$númeroDeDias + 3] = "center";
        $descSucursal = $datos["descSucursal"];
        $descArea = $datos["descArea"];


        require_once '../../cvista/rrhh/cronogramaHorariosExcel.php';
    }

    public function exportarExcelHorarioPersona($datos) {
        $oLRrhh = new LRrhh();
        $cboTESA = $oLRrhh->listaTurnoSedeEmpresaArea($datos); // Se recupera los turnos que pertenecen al area de una sede
        /* =============================   Manejo de fechas   ============================ */
        $diasSem = Array('Monday' => 'Lunes', 'Tuesday' => 'Martes', 'Wednesday' => 'Miercoles', 'Thursday' => 'Jueves', 'Friday' => 'Viernes', 'Saturday' => 'Sabado', 'Sunday' => 'Domingo');
        $numDia = Array(0 => 'Monday', 1 => 'Tuesday', 2 => 'Wednesday', 3 => 'Thursday', 4 => 'Friday', 5 => 'Saturday', 6 => 'Sunday');
        $fecha = getdate(time());
        if ($datos["mes"] != "")
            $mes = $datos["mes"];
        else
            $mes = $fecha['mon'];
        if ($datos["anio"] != "")
            $anio = $datos["anio"];
        else
            $anio = $fecha['year'];
        $fecha = mktime(0, 0, 0, $mes, 1, $anio);
        $fechaInicioMes = mktime(0, 0, 0, $mes, 1, $anio);
        $fechaInicioMes = date("w", $fechaInicioMes);

        $ultimoDia = date('t', $fecha);
        $númeroDeDias = intval(date("t", $mes));
        /* =============================   Fin Manejo de fechas   ============================ */

        /* ============  Set de la cabecera de las horas programadas existentes  ============= */
        $arrayCabecera = array();
        $arrayAling = array();
        $diaMes = 0;
        for ($coln = 0; $coln < $númeroDeDias; $coln++) {
            if ($diaMes < $ultimoDia) {
                $diaMes++;
                $diaInicial = date("l", mktime(0, 0, 0, $mes, $diaMes, $anio));
                $arrayCabecera[$coln] = $diasSem[$diaInicial] . " - " . $diaMes;
                $arrayAling[$coln] = "center";
            }
        }
        /* ==========  Fin set de la cabecera de las horas programadas existentes  ============ */

        $turnoProgramado = array();
        $arrayFilas = array();
        $flag = "NO";
        $totalHoras = "0.0";
//================================================================================================
        for ($i = 1; $i < 3; $i++) {
            $diaMes = 0;
            $turnoProgramado = $oLRrhh->listaTurnoProgramado($datos["idEmpleado"], $datos["iIdProgramacionpersonal"], $datos["mes"], $datos["anio"], 'listaTurnoProgramado', $i, $datos["idSEACC"], $datos["cboTipoContrato"]);


            for ($coln = 0; $coln < $númeroDeDias; $coln++) {
                if ($diaMes < $ultimoDia) {
                    $diaMes++;
                    if ($turnoProgramado) {
                        foreach ($turnoProgramado as $n => $value) {
                            if ($turnoProgramado[$n][4] == $diaMes) {
                                $totalHoras = $totalHoras + $value[5];
                                foreach ($cboTESA as $s => $val) {
                                    if ($cboTESA[$s][0] == $turnoProgramado[$n][2]) {
                                        $arrayFilas[$i][$coln] = $cboTESA[$s][1] . " - " . $cboTESA[$s][2];
                                        unset($turnoProgramado[$n]);
                                        break;
                                    } else if ($cboTESA[$s][0] == $turnoProgramado[$n][2] && $turnoProgramado[$n][2] != null)
                                        $arrayFilas[$i][$coln] = "";
//----------------------------------------------------------------
                                    if ($turnoProgramado[$n][2] == null) {
                                        $arrayFilas[$i][$coln] = ""; //es nulo
                                        unset($turnoProgramado[$n]);
                                        break;
                                    }
//---------------------------------------------------------------
                                }
                                break;
                            }else
                                $arrayFilas[$i][$coln] = "";
                        }
                    }else
                        $arrayFilas[$i][$coln] = "";
                }
            }
        }


//===============================================================================================================
//=== soporta solo para dos turnos al Dia, actualmente la base de datos esta diseñado asi - 17/06/2011
        $tablaHorarioEmpleado = "";
        $ctn = 1;
        $titulo = "";
        $cuerpo0 = "";
        $cuerpo1 = "";
        $colum = count($arrayFilas[1]);
        for ($j = 0; $j < $colum; $j++) {
            if ($ctn == 1) {//
                if ($j != 0) {
                    $titulo.="</tr>";
                    $cuerpo0.="</tr>";
                    $cuerpo1.="</tr>";
                }
                $titulo.="<tr>";
                $cuerpo0.="<tr>";
                $cuerpo1.="<tr>";
            }
            $titulo.="<td bgcolor='#A0CDAC'>" . $arrayCabecera[$j] . "</td>";
            $cuerpo0.="<td bgcolor='#D8EBDD'>" . $arrayFilas[1][$j] . "</td>";
            $cuerpo1.="<td bgcolor='#FFFFFF'>" . $arrayFilas[2][$j] . "</td>";
            if ($j == $colum - 1) {
                $titulo.="</tr>";
                $cuerpo0.="</tr>";
                $cuerpo1.="</tr>";
            }
            if (($ctn % 7) == 0) {
                $ctn = 1;
                $tablaHorarioEmpleado.=$titulo . $cuerpo0 . $cuerpo1;
                $titulo = "";
                $cuerpo0 = "";
                $cuerpo1 = "";
            }
            else
                $ctn++;
        }

//===============================================================================================================
        $descSucursal = $datos["descSucursal"];
        $descArea = $datos["descArea"];
        $nomEmpleado = $datos["nomEmpleado"];
        $mesx = $datos["mes"];
        require_once '../../cvista/rrhh/cronogramaHorarioEmpleadoExcel.php';
    }

//    public function mostrarTipoHorario($datos) {
//        $oLRrhh = new LRrhh();
//        $cboTESA=$oLRrhh->listaTurnoSedeEmpresaArea($datos);
//        $cboTurno='Turno : &nbsp;&nbsp;&nbsp;&nbsp;';
//        $cboTurno.='<select id="cboTurnoHorario" name="cboTurnoHorario"  style="width: 160px;" >';
//        $cboTurno.='<option> - Seleccionar - </option>';
//        foreach ($cboTESA as $i => $value) {
//            $cboTurno.='<option value="'.$value[0].'">'.$value[4]." => ".$value[2].'</option>';
//        }
//        $cboTurno.='</select>';
//
//        return $cboTurno;
//    }
    public function arbolEmpresaSucursal() {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $resultado = $oLRrhh->empresaSucursal();
        return $o_TablaHtmlx->generaArbol($resultado);
    }

    public function selectSedeEmpresaArea() {
        require_once '../../cvista/rrhh/selectSedeEmpresaArea.php';
    }

    public function asignarHorarioFijo($datos) {
        $oLRrhh = new LRrhh();
        $cboTESA = $oLRrhh->listaTurnoSedeEmpresaArea($datos);
        require_once '../../cvista/rrhh/asignarHorarioFijo.php';
    }

    public function grabarHorarioFijo($datos) {
        $oLRrhh = new LRrhh();
        $result = $oLRrhh->grabarHorarioFijo($datos);
        return $result;
    }

    public function listAreaSucursal($idSede) {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = $oLRrhh->listAreaSucursal($idSede);

        $arrayCabecera = array(0 => "idEmpresaSedeArea", 1 => "idArea", 2 => "Área", 3 => "Abreviatura", 4 => "Sucursal", 5 => "estado", 6 => "Estado", 7 => "Accion", 8 => "Eliminar");
        $arrayTamano = array(0 => "50", 1 => "50", 2 => "500", 3 => "380", 4 => "100", 5 => "100", 6 => "100", 7 => "50", 8 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "img", 8 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "pointer", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "false", 3 => "false", 4 => "true", 5 => "true", 6 => "false", 7 => "false", 8 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "left", 7 => "left", 8 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

//jose 2012/02/16 9:37am


    public function listSubAreaXAreaXSede($idArea, $idSedeArea) {

        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRrhh->listSubAreaXAreaXSede($idArea, $idSedeArea);
//        $arrayCabecera = array(0 => "Sede", 1 => "Área", 2 => "SubArea", 3 => "Abreviatura");
//        $arrayTamano = array(0 => "100", 1 => "400", 2 => "400", 3 => "120");
//        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
//        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default");
//        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "true");
//        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left");



        $arrayCabecera = array(0 => "IdSedeEmpresaArea", 1 => "IdArea", 2 => "IdDepArea", 3 => "Área", 4 => "Sub Área", 5 => "Sub Área Abreviatura", 6 => "estado", 7 => "Estado", 8 => "Accion", 9 => "Eliminar");
        $arrayTamano = array(0 => "50", 1 => "50", 2 => "50", 3 => "100", 4 => "500", 5 => "200", 6 => "50", 7 => "100", 8 => "50", 9 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "img", 9 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "true", 3 => "false", 4 => "false", 5 => "false", 6 => "false", 7 => "false", 8 => "false", 9 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "left", 7 => "left", 8 => "left", 9 => "left");


        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

//************************************



    public function listaSedeAreaCentroCosto($idSedeArea) {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRrhh->listaSedeAreaCentroCosto($idSedeArea);

        $botonEliminarComoHidden = true;
        if (isset($_SESSION["permiso_formulario_servicio"][218]["ELIMINAR_AREA_DE_CCOSTO"]) && ($_SESSION["permiso_formulario_servicio"][218]["ELIMINAR_AREA_DE_CCOSTO"] == 1)) {
            $botonEliminarComoHidden = false;
        }

        $arrayCabecera = array(0 => "iIdSedeEmpresaAreaCentroCosto", 1 => "idCentroCosto", 2 => "idSEArea", 3 => "Centro Costo", 4 => "Area", 5 => "Eliminar");
        $arrayTamano = array(0 => "50", 1 => "50", 2 => "50", 3 => "250", 4 => "250", 5 => "60");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "true", 3 => "false", 4 => "false", 5 => $botonEliminarComoHidden);
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "center");

        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function eliminacionFisicaSedeAreaCentroCosto($idSEACC) {
        $oLRrhh = new LRrhh();
        $respuesta = $oLRrhh->eliminacionFisicaSedeAreaCentroCosto($idSEACC);
        return $respuesta;
    }

    public function listTurnoArea() {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRrhh->listTurnoArea();

        $arrayCabecera = array(0 => "idTurno", 1 => "Tipo horario", 2 => "Descripción turno", 3 => "Hora Inicio", 4 => "Hora Fin", 5 => "Total horas", 6 => "Estado");
        $arrayTamano = array(0 => "50", 1 => "85", 2 => "100", 3 => "50", 4 => "50", 5 => "50", 6 => "60");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro");
        $arrayCursor = array(0 => "default", 1 => "pointer", 2 => "pointer", 3 => "pointer", 4 => "pointer", 5 => "pointer", 6 => "default");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "false", 3 => "false", 4 => "false", 5 => "false", 6 => "false");
        $arrayAling = array(0 => "left", 1 => "center", 2 => "left", 3 => "center", 4 => "center", 5 => "center", 6 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function listTurnoProgramar() {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRrhh->listTurnoProgramar();

        $arrayCabecera = array(0 => "Turno", 1 => "Descripción turno", 2 => "Hora Inicio", 3 => "Hora Fin", 4 => "Total horas", 5 => "Estado");
        $arrayTamano = array(0 => "50", 1 => "100", 2 => "50", 3 => "50", 4 => "50", 5 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro");
        $arrayCursor = array(0 => "default", 1 => "pointer", 2 => "pointer", 3 => "pointer", 4 => "pointer", 5 => "pointer");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "center", 3 => "center", 4 => "center", 5 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function grabarTurnoProgramar($datos) {
        $oLRrhh = new LRrhh();
        $respuesta = $oLRrhh->grabarTurnoProgramar($datos);
        if (is_array($respuesta))
            if ($respuesta[0][0] == 'ok')
                $respuesta = "<h2 style='color: blue'>Se Agreg&oacute; Corectamente.</h2>";
            else if ($respuesta[0][0] == 'existe')
                $respuesta = "<h2 style='color: red'>El c&oacute;digo " . $datos["idTurnoProgramar"] . " que intenta ingresar ya existe.</h2>";
            else
                $respuesta = "<h2 style='color: red'>Fallo el registro.</h2>";
        return $respuesta;
    }

    public function listaTurnos() {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRrhh->listaTurnosMaestros();

        $arrayCabecera = array(0 => "codTurno", 1 => "Descripción turno", 2 => "Hora Inicio", 3 => "Hora Fin", 4 => "Total horas", 5 => "Código", 6 => "Estado");
        $arrayTamano = array(0 => "50", 1 => "120", 2 => "80", 3 => "80", 4 => "80", 5 => "80", 6 => "80");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro");
        $arrayCursor = array(0 => "default", 1 => "pointer", 2 => "pointer", 3 => "pointer", 4 => "pointer", 5 => "pointer", 6 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false", 6 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "center", 3 => "center", 4 => "center", 5 => "left", 6 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function turnoSedeEmpresaArea($datos) {
        $oLRrhh = new LRrhh();
        $resultados = $oLRrhh->turnoSedeEmpresaArea($datos);
        return $resultados;
    }

    public function listTablaTurnoxArea($idSedeEmpresa) {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRrhh->listTablaTurnoxArea($idSedeEmpresa);

        $btnEliminarComoHidden = true;
        if (isset($_SESSION["permiso_formulario_servicio"][221]["ELIMINAR_TURNO_POR_AREA"]) && ($_SESSION["permiso_formulario_servicio"][221]["ELIMINAR_TURNO_POR_AREA"] == 1)) {
            $btnEliminarComoHidden = false;
        }

        $arrayCabecera = array(0 => "Turno", 1 => "Turno", 2 => "Sucursal", 3 => "Área", 4 => "Descripción turno", 5 => "Total horas", 6 => "idestado", 7 => "Estado");
        $arrayTamano = array(0 => "40", 1 => "40", 2 => "90", 3 => "190", 4 => "110", 5 => "70", 6 => "50", 7 => "60");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "pointer", 4 => "pointer", 5 => "pointer", 6 => "pointer", 7 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false", 6 => "true", 7 => $btnEliminarComoHidden);
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "center", 5 => "center", 6 => "center", 7 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function cargarCboArea($idSucursal, $tipoContrato) {
        $oLRrhh = new LRrhh();
        $resultados = $oLRrhh->listAreaSucursal($idSucursal, $tipoContrato);
        $combo = '<select name="cboArea" id="cboArea" style="width: 150px;" onchange="cargarCboSubArea()">';
        $combo.='<option value="">Seleccionar</option>';
        foreach ($resultados as $i => $value) {//$value[0]-> es el id de la sede empresa area mas no del area
            $combo.='<option value="' . $value[0] . '|' . $value[5] . '">' . htmlentities($value[2]) . '</option>';
        }
        $combo.='</select>';
        return $combo;
    }

    public function cargarCboArea2($idSucursal, $tipoContrato) {
        $oLRrhh = new LRrhh();
        $resultados = $oLRrhh->listAreaSucursal($idSucursal, $tipoContrato);
        $combo = '<select name="cboArea" id="cboArea" style="width: 150px;" onchange="cargarCboCategoria2()">';
        $combo.='<option value="">Seleccionar</option>';
        foreach ($resultados as $i => $value) {//$value[0]-> es el id de la sede empresa area mas no del area
            $combo.='<option value="' . $value[1] . '">' . htmlentities($value[2]) . '</option>';
        }
        $combo.='</select>';
        return $combo;
    }

    public function cargarSubArea($idSedeEmpresaArea) {
        $oLRrhh = new LRrhh();
        $resultados = $oLRrhh->cargarSubArea($idSedeEmpresaArea);
        $combo = '<select name="cboSubArea" id="cboSubArea" style="width: 120px;" onchange="cargarTablaProgramacionHorarios(1)">';
        $combo.='<option value="">Seleccionar</option>';
        foreach ($resultados as $i => $value) {
            $combo.='<option value="' . $value[0] . '">' . htmlentities($value[1]) . '</option>';
        }
        $combo.='</select>';

        return $combo;
    }

    public function cargarCboSedeArea($idSucursal, $nombre, $onchange) {
        $oLRrhh = new LRrhh();
        $onchange = empty($onchange) ? '' : ' onchange="' . $onchange . '" ';
        $resultados = $oLRrhh->listAreaSucursal($idSucursal, 100);
        $combo = '<select name="' . $nombre . '" id="' . $nombre . '" style="width: 200px;" ' . $onchange . ' >';
        $combo.='<option value="">Seleccionar</option>';
        foreach ($resultados as $i => $value) {//$value[0]-> es el id de la sede empresa area mas no del area
            $combo.='<option value="' . $value[0] . '|' . $value[1] . '">' . htmlentities($value[2]) . '</option>';
        }
        $combo.='</select>';

        return $combo;
    }

    public function cargarCboSubArea($datos) {
        $oLRrhh = new LRrhh();
        $resultados = $oLRrhh->listarSubAreas($datos);
        $resultados = is_array($resultados) ? $resultados : array();

        $combo = '<select name="cboSubArea" id="cboSubArea" style="width: 150px;" onchange="cargarTablaCategoriasSubAreas()">';
        $combo.='<option value="">Seleccionar</option>';
        foreach ($resultados as $i => $value) {
            $combo.='<option value="' . $value[0] . '">' . htmlentities($value[2]) . '</option>';
        }
        $combo.='</select>';
        return $combo;
    }

//    public function comboCategoriaSubArea($idSubArea) {
//        $oLRrhh = new LRrhh();
//        $resultados= $oLRrhh->comboCategoriaSubArea($idSubArea);
//        $resultados = is_array($resultados) ? $resultados : array();
//
//        $combo = '<select name="cboCategoriaSubArea" id="cboCategoriaSubArea" style="width: 150px;">';
//        $combo.='<option value="">Seleccionar</option>';
//        foreach ($resultados as $i => $value) {
//            $combo.='<option value="' . $value[0] . '">' . htmlentities($value[1]) . '</option>';
//        }
//        $combo.='</select>';
//        return $combo;
//    }

    function mntTablaCategoriaArea($datos) {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $resultados = $oLRrhh->mntTablaCategoriaArea($datos);
        $arrayFilas = is_array($resultados) ? $resultados : array();

        $botonesComoHidden = true;
        if (isset($_SESSION["permiso_formulario_servicio"][226]["DESACTIVAR_CAT_POR_AREA"]) && ($_SESSION["permiso_formulario_servicio"][226]["DESACTIVAR_CAT_POR_AREA"] == 1)) {
            $botonesComoHidden = false;
        }

        $arrayCabecera = array(0 => "Código", 1 => "Nro", 2 => "Descripción", 3 => "idestado", 4 => "Estado", 5 => "Acción");
        $arrayTamano = array(0 => "70", 1 => "50", 2 => "210", 3 => "50", 4 => "80", 5 => "60");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "img");
        $arrayCursor = array(0 => "default", 1 => "pointer", 2 => "pointer", 3 => "pointer", 4 => "pointer", 5 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false", 3 => "true", 4 => "false", 5 => $botonesComoHidden);
        $arrayAling = array(0 => "center", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function tablaEncargadosxArea($idSedeEmpresaArea) {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();

        $coordinador = $oLRrhh->encargadosXArea($idSedeEmpresaArea);
        $arrayFilas = is_array($coordinador) ? $coordinador : array();
        $arrayCabecera = array(0 => "Código", 1 => "Nombres", 2 => "Ap. Paterno", 3 => "Ap. Materno");
        $arrayTamano = array(0 => "70", 1 => "140", 2 => "130", 3 => "130");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayCursor = array(0 => "default", 1 => "pointer", 2 => "pointer", 3 => "pointer");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function grabarPersonaEncargada($datos) {
        $oLRrhh = new LRrhh();
        $resultados = $oLRrhh->grabarPersonaEncargada($datos);
        return $resultados;
    }

    public function editarEmpleadoCargo($idEmpleado) {
        $oLRrhh = new LRrhh();
        $resultados = $oLRrhh->editarEmpleadoCargo($idEmpleado);
        return $resultados;
    }

    public function getDatosEncargado($idSedeEmpresaArea) {
        $oLRrhh = new LRrhh();
        $resultados = $oLRrhh->getDatosEncargado($idSedeEmpresaArea);
        return $resultados;
    }

    public function grabarHorariosProgramados($datos) {
        $oLRrhh = new LRrhh();
        $resultados = $oLRrhh->grabarHorariosProgramados($datos);
        return $resultados;
    }

    public function adicionarHorariosProgramados($datos) {
        $oLRrhh = new LRrhh();
        $resultados = $oLRrhh->adicionarHorariosProgramados($datos);
        return $resultados;
    }

    public function RegularizacionEspecial($datos) {
        $oLRrhh = new LRrhh();
        require_once '../../cvista/rrhh/RegularizacionEspecial1.php';
    }

    public function busquedaEmpleadoRegularizado() {
        $oLRrhh = new LRrhh();
        require_once '../../cvista/rrhh/BusquedaEmpleado.php';
    }

    public function busquedaEmpleadoRegularizar($datos) {

        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRrhh->busquedaEmpleadoRegularizar($datos); //$arrayFilas = $oLActoMedico->cargaTratamientosAnteriores($datos);


        $arrayCabecera = array(0 => "Codigo Persona", 1 => "Apellido Paterno", 2 => "Apellido Materno", 3 => "Nombre Completo");
        $arrayTamano = array(0 => "100", 1 => "120", 2 => "120", 3 => "150");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function guardarEmpleadoRegularizar($datos) {

        $oLRrhh = new LRrhh();
        //$o_TablaHtmlx = new tablaDHTMLX();
        $resultado = $oLRrhh->guardarEmpleadoRegularizar($datos); //$arrayFilas = $oLActoMedico->cargaTratamientosAnteriores($datos);
        return $resultado;
    }

    public function configurarTurnosProgramar() {
        $oLRrhh = new LRrhh();
        require_once '../../cvista/rrhh/mantenimientoTurnoProgramar.php';
    }

    public function listaLeyendaTurno() {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRrhh->listaLeyendaTurno();
        $arrayCabecera = array(0 => "iIdLeyendaTurno", 1 => "Nombre", 2 => "Abreviatura", 3 => "Descripcion", 4 => "idEstado", 5 => "Estado", 6 => "Acción");
        $arrayTamano = array(0 => "90", 1 => "100", 2 => "80", 3 => "120", 4 => "80", 5 => "60", 6 => "60");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false", 3 => "false", 4 => "true", 5 => "false", 6 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function grabarLeyendaTurno($datos) {
        $oLRrhh = new LRrhh();
        $resultados = $oLRrhh->grabarLeyendaTurno($datos);
        return $resultados;
    }

    public function cargarCboLeyenda() {
        $oLRrhh = new LRrhh();
        $cboLeyendaTurno = $oLRrhh->listaLeyendaID();
        $resultados = '';
        $resultados.='<select id="cboLeyendaTurno" name="cboLeyendaTurno" style="width: 110px;">';
        $resultados.='<option value=""> - seleccione - </option>';
        foreach ($cboLeyendaTurno as $i => $value) {
            $resultados.='<option value="' . $value[0] . '">' . htmlentities($value[2]) . ' (' . htmlentities($value[1]) . ')</option>';
        }
        $resultados.='</select>';
        return $resultados;
    }

    public function asignarSedeArea($datos) {
        $oLRrhh = new LRrhh();
        $resultados = $oLRrhh->asignarSedeArea($datos);
        return $resultados;
    }

    public function desactivarTSEA($datos) {
        $oLRrhh = new LRrhh();
        $resultados = $oLRrhh->desactivarTSEA($datos);
        return $resultados;
    }

    public function agregarTurnoAdicional($datos) {
        $oLRrhh = new LRrhh();
        $resultados = $oLRrhh->agregarTurnoAdicional($datos);
        return $resultados;
    }

    public function mostrarReporteAsistencial() {
        $oLRrhh = new LRrhh();
        $resultadoVacaciones = $oLRrhh->personalVacaciones();
        $resultadoDescansoMedico = $oLRrhh->personalDescansoMedico();
        $cboSucursal = $oLRrhh->listaSucursal('0110073', '');
        $cboTipoContrato = $oLRrhh->listaModalidadContrato();
        $cboTipoSueldo = $oLRrhh->listaTipoSueldo();
// $$cboCategoria=$oLRrhh->listaCategoria();
        require_once '../../cvista/rrhh/ReporteHorasTrabajadasXempleado.php';
    }

    public function cargarCboCategoria($idSucursal) {

        $oLRrhh = new LRrhh(); // $cboCategoria=$oLRrhh->listaCategoria();
        $cboCategoria = $oLRrhh->listaCategoria($idSucursal);
        $combo = '<select name="cboCategoria" id="cboCategoria" style="width: 200px;" onchange="PresentarHorarioEmpleadoTrabjados()">'; // onchange="cargarCboTablaEmpleados()">';
        $combo.='<option value="">Seleccionar</option>';
        foreach ($cboCategoria as $i => $value) {//$value[0]-> es el id de la sede empresa area mas no del area
            $combo.='<option value="' . $value[0] . '">' . htmlentities($value[1]) . '</option>';
        }
        $combo.='</select>';
        return $combo;
    }

    public function cargarCboCategoria2($idSucursal, $idArea) {
        $oLRrhh = new LRrhh(); // $cboCategoria=$oLRrhh->listaCategoria();
        $cboCategoria = $oLRrhh->listaCategoria2($idSucursal, $idArea);
        $combo = '<select name="cboCategoria" id="cboCategoria" style="width: 200px;" >'; // onchange="cargarCboTablaEmpleados()">';
        $combo.='<option value="">Seleccionar</option>';
        foreach ($cboCategoria as $i => $value) {//$value[0]-> es el id de la sede empresa area mas no del area
            $combo.='<option value="' . $value[0] . '">' . htmlentities($value[1]) . '</option>';
        }
        $combo.='</select>';
        return $combo;
    }

//    public function cargarCboCategoria2($idSedeEmpresaArea) {
//
//        $oLRrhh = new LRrhh(); // $cboCategoria=$oLRrhh->listaCategoria();
//        $cboCategoria = $oLRrhh->listaCategoria2($idSedeEmpresaArea);
//        $combo = 'Categoria puesto : <select name="cboCategoria" id="cboCategoria" style="width: 200px;" onchange="listaEncargadosPorArea()">'; // onchange="encargadosPorArea()">';
//        $combo.='<option value="">Seleccionar</option>';
//        foreach ($cboCategoria as $i => $value) {//$value[0]-> es el id de la sede empresa area mas no del area
//            $combo.='<option value="' . $value[0] . '">' . htmlentities($value[1]) . '</option>';
//        }
//        $combo.='</select>';
//        return $combo;
//    }
//
    public function PresentarHorarioEmpleadoTrabjados($datos) {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRrhh->PresentarHorarioEmpleadoTrabjados($datos);
        $_SESSION['arrayFilas'] = $arrayFilas;
        $arrayCabecera = array(0 => "Codigo", 1 => "Nombres", 2 => "Área", 3 => "Tot. Horas Trabajadas", 4 => "Tot. Horas Programadas", 5 => "Tardanza (Minutos)", 6 => "Inasistencia (Horas)");
        $arrayTamano = array(0 => "70", 1 => "260", 2 => "160", 3 => "120", 4 => "150", 5 => "120", 6 => "120");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false", 6 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "center", 3 => "center", 4 => "center", 5 => "center", 6 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function empleadosHorasTrabajadasExcel($datos) {
        $oLRrhh = new LRrhh();
//$arrayDatos = $oLRrhh->PresentarHorarioEmpleadoTrabjados($datos);
        $arrayDatos = $_SESSION['arrayFilas'];
        $arrayFilas = array();
        $txtFechaIni = $datos["p2"];
        $txtFechaFin = $datos["p3"];
        $descriSucursal = $datos["p8"];
        $descriContrato = $datos["p9"];

        require_once '../../cvista/rrhh/horasTrabajadasEmpleadoExcel.php';
    }

    public function BusquedaEmpleado($datos) {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRrhh->BusquedaEmpleado($datos);

        $btnEditarComoHidden = "true";
        if (isset($_SESSION["permiso_formulario_servicio"][224]["EDITAR_ASISTENCIA_EMP"]) && ($_SESSION["permiso_formulario_servicio"][224]["EDITAR_ASISTENCIA_EMP"] == 1)) {
            $btnEditarComoHidden = "false";
        }


        if (trim($datos["p1"]) == "2") {
            $oculto = "true";
            $tamanio = "160";
        } else {
            $oculto = "false";
            $tamanio = "80";
        }

        if (!isset($_SESSION["permiso_formulario_servicio"][224]["ELIMINAR_ASISTENCIA_EMP"]) || !($_SESSION["permiso_formulario_servicio"][224]["ELIMINAR_ASISTENCIA_EMP"] == 1)) {
            $oculto = "true";
        }

        $arrayCabecera = array(0 => "CodigoProgramacion", 1 => "idEmp", 2 => "SEDE", 3 => "Area", 4 => "TipoCont", 5 => "Puesto", 6 => "Nombre Completo", 7 => "Fecha", 8 => "Entrada Programada", 9 => "Salida Programada", 10 => "Entrada Real", 11 => "Salida Real", 12 => "Tarde Entrada", 13 => "Tarde Salida", 14 => "Horas Falta", 15 => "Horas Trab", 16 => "Horas Total", 17 => "bestado", 18 => "Editar", 19 => "Eliminar", 20 => "estadoAIE", 21 => "entr turno", 22 => "Sali turno", 23 => "Acc", 24 => "iIdTurnosAreaSede", 25 => "iIdSedeEmpresaArea", 26 => "iIdTipoProgramacion");
        $arrayTamano = array(0 => "70", 1 => "70", 2 => "80", 3 => "90", 4 => "115", 5 => "115", 6 => "220", 7 => "85", 8 => "75", 9 => "75", 10 => "70", 11 => "60", 12 => "55", 13 => "55", 14 => "55", 15 => "55", 16 => "55", 17 => "80", 18 => "40", 19 => "40", 20 => "40", 21 => "40", 22 => "40", 23 => "40", 24 => "40", 25 => "40", 26 => "40");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro", 9 => "ro", 10 => "ro", 11 => "ro", 12 => "ro", 13 => "ro", 14 => "ro", 15 => "ro", 16 => "ro", 17 => "ro", 18 => "img", 19 => "img", 20 => "ro", 21 => "ro", 22 => "ro", 23 => "img", 24 => "ro", 25 => "ro", 26 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default", 10 => "default", 11 => "default", 12 => "default", 13 => "default", 14 => "default", 15 => "default", 16 => "default", 17 => "default", 18 => "pointer", 19 => "pointer", 20 => "default", 21 => "pointer", 22 => "default", 23 => "pointer", 24 => "default", 25 => "default", 26 => "default");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "true", 3 => "false", 4 => "true", 5 => "true", 6 => "false", 7 => "false", 8 => "false", 9 => "false", 10 => "false", 11 => "false", 12 => "false", 13 => "false", 14 => "false", 15 => "false", 16 => "false", 17 => "true", 18 => $btnEditarComoHidden, 19 => "true", 20 => "true", 21 => "true", 22 => "true", 23 => "true", 24 => "true", 25 => "true", 26 => "true");
        $arrayAling = array(0 => "center", 1 => "center", 2 => "left", 3 => "center", 4 => "center", 5 => "center", 6 => "center", 7 => "center", 8 => "center", 9 => "center", 10 => "center", 11 => "center", 12 => "center", 13 => "center", 14 => "center", 15 => "center", 16 => "center", 17 => "center", 18 => "center", 19 => "center", 20 => "center", 21 => "center", 22 => "center", 23 => "center", 24 => "center", 25 => "center", 26 => "center");


        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function uploadFotoEmpleado($datos) {
        $upload = "fotoEmpleado";
        require_once "../../cvista/rrhh/adjuntarArchivos.php";
    }

    public function datosRutaCarpeta($opcion) {
        $oLRrhh = new LRrhh();
        $arrayDatos = $oLRrhh->datosRutaCarpeta($opcion);
        return $arrayDatos;
    }

    public function BusquedaPersonaRegularizar($c_cod_per) {
        $oLRrhh = new LRrhh(); // $cboCategoria=$oLRrhh->listaCategoria();
        $resultados = $oLRrhh->BusquedaPersonaRegularizar($c_cod_per);
//echo $c_cod_per ;
//        print_r($resultados); 
//$combo='<input name="NombreCompleto" type="text" id="NombreCompleto" value="'.$resultados[0][0].'"/>';
        $combo = '<h1>' . $resultados[0][0] . ' </h1>';
        return $combo;
    }

    public function ModificarRegularizacion($datos) {
        $oLRrhh = new LRrhh();
        $resultadoturnos = $oLRrhh->LturnosEmpleadosReales($datos["idProgramacionEmpleados"]);
        $m = count($resultadoturnos);
        if ($m == 0) {
            $m = 0;
        } else {
            if ($m == 1) {
                $m = $m;
            } else {
                $m = $m - 1;
            }
        }
        require_once("../../cvista/rrhh/ModificarTablensdHorarioRealesAsistenciaRegularizacion1.php");
    }

    public function ActualizarTablansdHorarioRealesAsistencia($datos) {
        $oLRrhh = new LRrhh();
        $resultados = $oLRrhh->ActualizarTablansdHorarioRealesAsistencia($datos);
        Return $resultados;
    }

    public function cboSedeEmpresaArea($idSedeEmpresa) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->cboSedeEmpresaArea($idSedeEmpresa);
        $cboSedeEmpresaArea = '<select id="cboSedeEmpresaArea" name="cboSedeEmpresaArea" style="width: 200px;">';
        $cboSedeEmpresaArea.='<option value="">- Seleccionar -</option>';
        foreach ($resultado as $i => $value) {
            $cboSedeEmpresaArea.='<option  value="' . $value[0] . '|' . $value[1] . '">' . htmlentities($value[2]) . '</option>';
        }
        $cboSedeEmpresaArea.='</select>';
        return $cboSedeEmpresaArea;
    }

    public function asignarPuestoSedeArea($idSedeEmpresa, $idPuesto) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->asignarPuestoSedeArea($idSedeEmpresa, $idPuesto);
        $resul = "";
        if ($resultado)
            $resul = $resultado[0][0];
        return $resul;
    }

    public function mostrarPuestoArea($idPuesto) {
        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();

        $btnEliminarComoHidden = true;
        if (isset($_SESSION["permiso_formulario_servicio"][204]["ELIMINAR_PUESTO_AREA"]) && ($_SESSION["permiso_formulario_servicio"][204]["ELIMINAR_PUESTO_AREA"] == 1)) {
            $btnEliminarComoHidden = false;
        }

        $arrayFilas = $o_LRrhh->mostrarPuestoArea($idPuesto);
        $arrayCabecera = array(0 => "iidPuestoSedeEmpresa", 1 => "Sucursal", 2 => "iidSedeEmpresaArea", 3 => "Area", 4 => "iidPuesto", 5 => "Nombre Puesto", 6 => "Eliminar");
        $arrayTamano = array(0 => "80", 1 => "100", 2 => "80", 3 => "200", 4 => "80", 5 => "200", 6 => "60");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "true", 3 => "false", 4 => "true", 5 => "false", 6 => $btnEliminarComoHidden);
        $arrayAling = array(0 => "center", 1 => "left", 2 => "center", 3 => "center", 4 => "center", 5 => "center", 6 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function eliminacionFisicaPuestoArea($iidPuestoSedeEmpresa) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->eliminacionFisicaPuestoArea($iidPuestoSedeEmpresa);
        return $resultado;
    }

    public function grabarContrato($datos) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->grabarContrato($datos);
//$msm = 'No se puede registrar el contrato,Ud. tiene que asignar (UN PUESTO A UNA AREA) o (UN CENTRO DE COSTO A UN AREA).';
        $msm1 = 'porfavo ingrese bien las fechas';
        $msm2 = 'Existe cruce de contrato, verifique';

//        $rs = $resultado[0][0] == '1' ? $msm1 : 'ok';
//        $rs = $resultado[0][0] == '2' ? $msm2 : 'ok';
//para no modificar lo q hizo Juanca..aca chanco el valor de retorno de resultado .. si es q sale error
        /* if (!empty($resultado[0]["respuesta"])) {
          $rs = $resultado[0]["respuesta"];
          } */
        $rs = 'ok';
        if (!empty($resultado)) {
            if ($resultado[0][0] == '2') {
                $rs = $msm2;
            } else {

                if ($resultado[0][0] == '1') {
                    $rs = $msm1;
                } else {
                    $rs = 'ok';
                }
            }
        }
        return $rs;
    }

    public function agregarSubAreas() {
        $oLRrhh = new LRrhh();
        $comboSucursal = $oLRrhh->listaSucursal('0110073', '');
        $arrayCombo = $oLRrhh->seleccionarCategoria();
        $o_Combo = new Combo($arrayCombo);
        $cboCategoriaPuesto = $o_Combo->getOptionsHTML();
        require_once '../../cvista/rrhh/mantenimientoSubAreas.php';
    }

    public function grabarSubArea($datos) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->grabarSubArea($datos);
        return $resultado;
    }

    public function grabarCategoriaSubArea($datos) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->grabarCategoriaSubArea($datos);
        return $resultado;
    }

    public function cambiarEstadoCategoriasSubArea($idCategoriaSubArea) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->cambiarEstadoCategoriasSubArea($idCategoriaSubArea);
        return $resultado;
    }

    public function listaDatosSedeAreas($datos) {
//p
        $iCodEmpCoordinador = $_SESSION['iCodigoEmpleado'];

//---------------------------------------SEDE------------------------------------------------//
        isset($datos["codigoCentroCosto"]) ? $datos["codigoCentroCosto"] = $datos["codigoCentroCosto"] : $datos["codigoCentroCosto"] = '%';
        isset($datos["ip"]) ? $datos["ip"] = $datos["ip"] : $datos["ip"] = '%';
        isset($datos["funcionEjecutar"]) ? $datos["funcionEjecutar"] = $datos["funcionEjecutar"] : $datos["funcionEjecutar"] = '%';
        isset($datos["codigoArea"]) ? $datos["codigoArea"] = $datos["codigoArea"] : $datos["codigoArea"] = '';
//p
        isset($datos["codigoEmpleado"]) ? $datos["codigoEmpleado"] = $datos["codigoEmpleado"] : $datos["codigoEmpleado"] = '';

//p
//$arrayPuestosEmpleado=$_SESSION["puestosEmpleado"];
//iidPuesto=11 para el encargado de recursos humanos
//p


        $o_Lcita = new LCita();
        $rs = $o_Lcita->getArrayListaSedes($datos);

        $seleccionado = '';
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
            if ($fila[2] == '1')
                $seleccionado = $op;
        }
        $o_ComboSede = new Combo($resultadoArray);
        isset($datos["codigoSede"]) ? $datos["codigoSede"] = $datos["codigoSede"] : $datos["codigoSede"] = $seleccionado;
//$comboHTML_01 = $o_ComboSede->getOptionsHTMLFirstSelected();
        $opcionesHTML_01 = $o_ComboSede->getOptionsHTML($datos["codigoSede"]);

        print_r($opcionesHTML_01); //prueba
//---------------------------------------AREA------------------------------------------------//
        $o_Rrhh = new LRrhh();
        $codigoSede = '';
        $arrayCombo = $o_Rrhh->getArrayListaAreas($datos["codigoSede"]);
        $resultadoArray1 = array();
        foreach ($arrayCombo as $fila) {
            $op = $fila[0];
            $resultadoArray1[$op] = htmlentities($fila[1]);
        }
        $o_ComboArea = new Combo($resultadoArray1);
        $opcionesHTML_02 = $o_ComboArea->getOptionsHTML();

        $row_ochg_sede = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=comboSedesAreas&p2='+document.getElementById('cboSede').value,'Div_ComboSedesAreas');\"";
//$row_ochg_area = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=mostrarContenidoEmpleadoSubAreas&p2='+document.getElementById('cboSede').value+'&p3='+document.getElementById('cboArea').value,'Div_ContenidoEmpleadoSubAreas');\"";
        $row_ochg_area = "onchange=\"mostrarContenidoEmpleadoSubAreas();\"";
        $row_ochg_Subarea = "onchange=\"mostrarSubAreas();\""; //agregue

        $row_ini = "<table><tr><td>Sede</td><td>Area</td></tr><tr><td>";
        $row_med = "</td><td>";
        $row_fin = "</td></tr></table>";
        /* $row_empresa = "<select tabindex=1 id=\"cboEmpresa\" name=\"cboEmpresa\" onkeypress=\"return validFormSalt('cbo',this,event,'cb_provincia')\" $disabled ".$row_ochg." title=\"Empresa\">";
          $row_sede = "<select tabindex=2 id=\"cboSede\" name=\"cboSede\" onkeypress=\"return validFormSalt('cbo',this,event,'cb_distrito')\" $disabled ".$row_ochg." style=\"width:100px\" title=\"Sede\">"; */
//$row_empresa = "<select tabindex=1 id=\"cboEmpresa\" name=\"cboEmpresa\" disabled ".$row_ochg_empresa." title=\"Empresa\">";
//$row_sede = "<select tabindex=2 id=\"cboSede\" name=\"cboSede\" $disabled ".$row_ochg_sede." title=\"Sede\">";
        $row_sede = "<select tabindex=1 id=\"cboSede\" name=\"cboSede\" $row_ochg_sede title=\"Sede\">";
        $row_area = "<select tabindex=2 id=\"cboArea\" name=\"cboArea\" $row_ochg_area title=\"Area\">";
        $row_fin_cb = "</select>";

        $comboHTML = $row_ini . $row_sede . $opcionesHTML_01 . $row_fin_cb . $row_med . $row_area . $opcionesHTML_02 . $row_fin_cb . $row_fin;
        return $comboHTML;
        print_r($opcionesHTML_02);
//---------------------------------------SUB AREA------------------------------------------------//
        $o_Rrhh1_p = new LRrhh();
        $codigoSede = '';
        $arrayCombo1_p = $o_Rrhh1_p->getArrayListaSubAreas($datos["codigoSede"]);
        $resultadoArray1_p = array();
        foreach ($arrayCombo1_p as $fila1) {
            $op_p = $fila1_p[0];
            $resultadoArray1_p[$op] = htmlentities($fila1_p[1]);
        }
        $o_ComboArea_p = new Combo($resultadoArray1_p);
        $opcionesHTML_02 = $o_ComboArea_p->getOptionsHTML();

//        $row_ochg_sede = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=comboSedesAreas&p2='+document.getElementById('cboSede').value,'Div_ComboSedesAreas');\"";
//        //$row_ochg_area = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=mostrarContenidoEmpleadoSubAreas&p2='+document.getElementById('cboSede').value+'&p3='+document.getElementById('cboArea').value,'Div_ContenidoEmpleadoSubAreas');\"";
//        $row_ochg_area = "onchange=\"mostrarContenidoEmpleadoSubAreas();\"";
//        $row_ini = "<table><tr><td>Sede</td><td>Area</td></tr><tr><td>";
//        $row_med = "</td><td>";
//        $row_fin = "</td></tr></table>";
        /* $row_empresa = "<select tabindex=1 id=\"cboEmpresa\" name=\"cboEmpresa\" onkeypress=\"return validFormSalt('cbo',this,event,'cb_provincia')\" $disabled ".$row_ochg." title=\"Empresa\">";
          $row_sede = "<select tabindex=2 id=\"cboSede\" name=\"cboSede\" onkeypress=\"return validFormSalt('cbo',this,event,'cb_distrito')\" $disabled ".$row_ochg." style=\"width:100px\" title=\"Sede\">"; */
//$row_empresa = "<select tabindex=1 id=\"cboEmpresa\" name=\"cboEmpresa\" disabled ".$row_ochg_empresa." title=\"Empresa\">";
//$row_sede = "<select tabindex=2 id=\"cboSede\" name=\"cboSede\" $disabled ".$row_ochg_sede." title=\"Sede\">";
        $row_sede = "<select tabindex=1 id=\"cboSede\" name=\"cboSede\" $row_ochg_sede title=\"Sede\">";
        $row_area = "<select tabindex=2 id=\"cboArea\" name=\"cboArea\" $row_ochg_area title=\"Area\">";
        $row_subarea = "<select tabindex=3 id=\"cboSubArea\" name=\"cboSubArea\" $row_ochg_Subarea title=\"SubArea\">";
        $row_fin_cb = "</select>";

        $comboHTML = $row_ini . $row_sede . $opcionesHTML_01 . $row_fin_cb . $row_med . $row_area . $opcionesHTML_02 . $row_fin_cb . $row_med . $row_subarea . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

//fin de listaDatosSedeAreas

    public function listaDatosSedeAreas1($datos) {

//---------------------------------------SEDE------------------------------------------------//
//        isset($datos["codigoCentroCosto"]) ? $datos["codigoCentroCosto"] = $datos["codigoCentroCosto"] : $datos["codigoCentroCosto"] = '%';
//        isset($datos["ip"]) ? $datos["ip"] = $datos["ip"] : $datos["ip"] = '%';
//        isset($datos["funcionEjecutar"]) ? $datos["funcionEjecutar"] = $datos["funcionEjecutar"] : $datos["funcionEjecutar"] = '%';
//        isset($datos["codigoArea"]) ? $datos["codigoArea"] = $datos["codigoArea"] : $datos["codigoArea"] = '';
//        //p
//        isset($datos["codigoEmpleado"]) ? $datos["codigoEmpleado"] = $datos["codigoEmpleado"] : $datos["codigoEmpleado"] = '';
//$arrayPuestosEmpleado=$_SESSION["puestosEmpleado"];
//iidPuesto=11 para el encargado de recursos humanos


        $o_Lcita = new LCita();
        $rs = $o_Lcita->getArrayListaSedes1($datos);

        print_r($rs);

        $seleccionado = '';
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
            if ($fila[2] == '1')
                $seleccionado = $op;
        }
        $o_ComboSede = new Combo($resultadoArray); //    presentacion de combo


        isset($datos["codigoSede"]) ? $datos["codigoSede"] = $datos["codigoSede"] : $datos["codigoSede"] = $seleccionado;

//$comboHTML_01 = $o_ComboSede->getOptionsHTMLFirstSelected();
        $opcionesHTML_01 = $o_ComboSede->getOptionsHTML($datos["codigoSede"]);
        return $rs;

//        print_r($opcionesHTML_01);//prueba
//---------------------------------------AREA------------------------------------------------//
//        $o_Rrhh = new LRrhh();
//        $codigoSede = '';
//        $arrayCombo = $o_Rrhh->getArrayListaAreas($datos["codigoSede"]);
//        $resultadoArray1 = array();
//        foreach ($arrayCombo as $fila) {
//            $op = $fila[0];
//            $resultadoArray1[$op] = htmlentities($fila[1]);
//        }
//        $o_ComboArea = new Combo($resultadoArray1);
//        $opcionesHTML_02 = $o_ComboArea->getOptionsHTML();
//
//        $row_ochg_sede = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=comboSedesAreas&p2='+document.getElementById('cboSede').value,'Div_ComboSedesAreas');\"";
//        //$row_ochg_area = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=mostrarContenidoEmpleadoSubAreas&p2='+document.getElementById('cboSede').value+'&p3='+document.getElementById('cboArea').value,'Div_ContenidoEmpleadoSubAreas');\"";
//        $row_ochg_area = "onchange=\"mostrarContenidoEmpleadoSubAreas();\"";
//        $row_ochg_Subarea = "onchange=\"mostrarSubAreas();\"";//agregue
//
//        $row_ini = "<table><tr><td>Sede</td><td>Area</td></tr><tr><td>";
//        $row_med = "</td><td>";
//        $row_fin = "</td></tr></table>";
//        /* $row_empresa = "<select tabindex=1 id=\"cboEmpresa\" name=\"cboEmpresa\" onkeypress=\"return validFormSalt('cbo',this,event,'cb_provincia')\" $disabled ".$row_ochg." title=\"Empresa\">";
//          $row_sede = "<select tabindex=2 id=\"cboSede\" name=\"cboSede\" onkeypress=\"return validFormSalt('cbo',this,event,'cb_distrito')\" $disabled ".$row_ochg." style=\"width:100px\" title=\"Sede\">"; */
//        //$row_empresa = "<select tabindex=1 id=\"cboEmpresa\" name=\"cboEmpresa\" disabled ".$row_ochg_empresa." title=\"Empresa\">";
//        //$row_sede = "<select tabindex=2 id=\"cboSede\" name=\"cboSede\" $disabled ".$row_ochg_sede." title=\"Sede\">";
//        $row_sede = "<select tabindex=1 id=\"cboSede\" name=\"cboSede\" $row_ochg_sede title=\"Sede\">";
//        $row_area = "<select tabindex=2 id=\"cboArea\" name=\"cboArea\" $row_ochg_area title=\"Area\">";
//        $row_fin_cb = "</select>";
//
//        $comboHTML = $row_ini . $row_sede . $opcionesHTML_01 . $row_fin_cb . $row_med . $row_area . $opcionesHTML_02 . $row_fin_cb . $row_fin;
//        return $comboHTML;
//        print_r($opcionesHTML_02);
//        //---------------------------------------SUB AREA------------------------------------------------//
//        $o_Rrhh1_p = new LRrhh();
//        $codigoSede = '';
//        $arrayCombo1_p = $o_Rrhh1_p->getArrayListaSubAreas($datos["codigoSede"]);
//        $resultadoArray1_p = array();
//        foreach ($arrayCombo1_p as $fila1) {
//            $op_p = $fila1_p[0];
//            $resultadoArray1_p[$op] = htmlentities($fila1_p[1]);
//        }
//        $o_ComboArea_p = new Combo($resultadoArray1_p);
//        $opcionesHTML_02 = $o_ComboArea_p->getOptionsHTML();
//
////        $row_ochg_sede = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=comboSedesAreas&p2='+document.getElementById('cboSede').value,'Div_ComboSedesAreas');\"";
////        //$row_ochg_area = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=mostrarContenidoEmpleadoSubAreas&p2='+document.getElementById('cboSede').value+'&p3='+document.getElementById('cboArea').value,'Div_ContenidoEmpleadoSubAreas');\"";
////        $row_ochg_area = "onchange=\"mostrarContenidoEmpleadoSubAreas();\"";
//
////        $row_ini = "<table><tr><td>Sede</td><td>Area</td></tr><tr><td>";
////        $row_med = "</td><td>";
////        $row_fin = "</td></tr></table>";
//        /* $row_empresa = "<select tabindex=1 id=\"cboEmpresa\" name=\"cboEmpresa\" onkeypress=\"return validFormSalt('cbo',this,event,'cb_provincia')\" $disabled ".$row_ochg." title=\"Empresa\">";
//          $row_sede = "<select tabindex=2 id=\"cboSede\" name=\"cboSede\" onkeypress=\"return validFormSalt('cbo',this,event,'cb_distrito')\" $disabled ".$row_ochg." style=\"width:100px\" title=\"Sede\">"; */
//        //$row_empresa = "<select tabindex=1 id=\"cboEmpresa\" name=\"cboEmpresa\" disabled ".$row_ochg_empresa." title=\"Empresa\">";
//        //$row_sede = "<select tabindex=2 id=\"cboSede\" name=\"cboSede\" $disabled ".$row_ochg_sede." title=\"Sede\">";
//        $row_sede = "<select tabindex=1 id=\"cboSede\" name=\"cboSede\" $row_ochg_sede title=\"Sede\">";
//        $row_area = "<select tabindex=2 id=\"cboArea\" name=\"cboArea\" $row_ochg_area title=\"Area\">";
//        $row_subarea = "<select tabindex=3 id=\"cboSubArea\" name=\"cboSubArea\" $row_ochg_Subarea title=\"SubArea\">";
//        $row_fin_cb = "</select>";
//
//        $comboHTML = $row_ini . $row_sede . $opcionesHTML_01 . $row_fin_cb . $row_med .$row_area. $opcionesHTML_02.$row_fin_cb.$row_med .$row_subarea. $row_fin_cb . $row_fin;
//        return $comboHTML;
    }

//fin de listaDatosSedeAreas

    public function mostrarTablaSubAreas($datos) {

        $o_TablaHtmlx = new tablaDHTMLX();
        $o_LRrhh = new LRrhh();
        $datos == '' ? $arrayFilas = array() : $arrayFilas = $o_LRrhh->listarSubAreas($datos);
        $arrayCabecera = array("0" => "Id", "1" => "Nº", "2" => "Sub-Area", 3 => "Descripcion", 4 => "idEstado", 5 => "Estado");
        $arrayTamano = array("0" => "40", "1" => "50", "2" => "*", 3 => "*", 4 => "50", 5 => "80");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", 3 => "ro", 4 => "ro", 5 => "ro");
        $arrayAlineacion = array("0" => "center", "1" => "left", "2" => "left", 3 => "left", 4 => "left", 5 => "center");
        $arrayHidden = array("0" => "true", "1" => "false", "2" => "false", 3 => "false", 4 => "true", 5 => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function mostrarTablaEmpleadosAreas($datos) {

        $o_TablaHtmlx = new tablaDHTMLX();
        $o_LRrhh = new LRrhh();
        $datos == '' ? $arrayFilas = array() : $arrayFilas = $o_LRrhh->listarEmpleadosAreas($datos);
        $arrayCabecera = array("0" => "Id", "1" => "Nº", "2" => "Apellidos y Nombres", "3" => "Categoría");
        $arrayTamano = array("0" => "40", "1" => "50", "2" => "*", "3" => "*");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro");
        $arrayAlineacion = array("0" => "center", "1" => "center", "2" => "left", "3" => "left");
        $arrayHidden = array("0" => "true", "1" => "false", "2" => "false", "3" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function mostrarTablaEmpleadosSubArea($datos) {

        $o_TablaHtmlx = new tablaDHTMLX();
        $o_LRrhh = new LRrhh();
        $arrayFilas = $o_LRrhh->listarEmpleadosSubArea($datos);
        $datos = is_array($arrayFilas) ? $arrayFilas : array();
//        print_r($datos);
//
//                $arrayCabecera = array(0 => "Codigo", 1 => "Nombres", 2 => "Fecha",3 => "Hora Entrada",4 => "Hora Salida",5 => "Estado a Regularizar",6 => "Codigo Tabla", 7 => "Acción");
//        $arrayTamano = array(0 => "80", 1 => "180", 2 => "100", 3 => "80", 4 => "80", 5 => "140",  6 => "60",7 => "80");
//        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro",5 => "ro",6 => "ro", 7 => "img");
//        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default",3 => "default",4 => "default",5 => "default",6 => "default", 7 => "pointer");
//        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false", 6 => "true", 7 => "false");
//        $arrayAling = array(0 => "center", 1 => "left", 2 => "center", 3 => "center", 4 => "center", 5 => "center", 6 => "center", 7 => "center");
//        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
//
//
        $botonesComoHidden = true;
        if (isset($_SESSION["permiso_formulario_servicio"][226]["ELIMINAR_EMP_SUBAREA"]) && ($_SESSION["permiso_formulario_servicio"][226]["ELIMINAR_EMP_SUBAREA"] == 1)) {
            $botonesComoHidden = false;
        }

        $arrayCabecera = array("0" => "Id", "1" => "Nº", "2" => "Apellidos y Nombres", "3" => "Sub-Area", "4" => "Eliminar");
        $arrayTamano = array("0" => "40", "1" => "40", "2" => "*", "3" => "*", "4" => "50");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default");
        $arrayAling = array("0" => "center", "1" => "center", "2" => "left", "3" => "left", "4" => "center");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => $botonesComoHidden);
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function eliminarEmpleadoSubArea($datos) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->eliminarEmpleadoSubArea($datos);
        return $resultado;
    }

    public function asignacionEmpleadoaSubArea($datos) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->asignacionEmpleadoaSubArea($datos);
        return $resultado;
    }

    /* ================================================================================================ */
    /* =============================PROGRAMACION PERSONAL ASISTENCIAL================================== */
    /* ================================================================================================ */

    function generarFormatoUnificado($datos) {
        $parametros = $datos["datos"];
        $parametros = explode("||", $parametros); //datos concadenados
        /* +--------------------------------------------------------------------------------------+ */
        $arrayCabecera1 = array();
        $arrayCuerpo = array();
        /* +------------------------------  Cabecera  -------------------------------+ */
//        $diasSem = Array('Monday' => 'Lunes', 'Tuesday' => 'Martes', 'Wednesday' => 'Miercoles', 'Thursday' => 'Jueves', 'Friday' => 'Viernes', 'Saturday' => 'Sabado', 'Sunday' => 'Domingo');
        $diasSem = Array('Monday' => 'L-', 'Tuesday' => 'M-', 'Wednesday' => 'M- ', 'Thursday' => 'J- ', 'Friday' => 'V- ', 'Saturday' => 'S- ', 'Sunday' => 'D-');
        $fecha = getdate(time());
        $fileExportar = "PROGRAMACION_" . strtoupper($datos["descMes"]) . "_" . $datos["descArea"];
        if ($datos["mes"] != "")
            $mes = $datos["mes"];
        else
            $mes = $fecha["mon"];
        if ($datos["anio"] != "")
            $anio = $datos["anio"];
        else
            $anio = $fecha['year'];
        $fecha = mktime(0, 0, 0, $mes, 1, $anio);
        $fechaInicioMes = mktime(0, 0, 0, $mes, 1, $anio);
        $fechaInicioMes = date("w", $fechaInicioMes);

        $ultimoDia = date('t', $fecha);
        $númeroDeDias = intval(date("t", $mes));
        /* +-----------------------------------------------------------------------------------------------+ */
        /* +-----------------------------------------------------------------------------------------------+ */
        $fila = 0;
        $oLRrhh = new LRrhh();
        foreach ($parametros as $key => $arrayDatos) {
            $arrayDatos = explode("|", $arrayDatos);
            $datos["nomSubArea"] = $arrayDatos[2];
            $datos["nomCategoriapuesto"] = $arrayDatos[3]; //$valorsubareas[0]."|".$valorcategorias[0]."|".$nomSubArea."|".$nomCategoria."|".$nomSede
            $datos["nomSede"] = $arrayDatos[4];
            $datos["codigoSubArea"] = $arrayDatos[0];
            $datos["codigoCategoria"] = $arrayDatos[1];
            $nameFileGenerar = $datos["anio"] . "_" . $datos["descMes"] . "_" . $datos["nomSede"] . "_" . $datos["nomSubArea"] . "_" . $datos["nomCategoriapuesto"];
            if ($fila == 0) {//es un artificio, para mostrar las cabeceras, pues el framework me limita
                $arrayCabecera1[$fila]["Codigo"] = "Archivo :";
                $arrayCabecera1[$fila]["Nombres"] = $nameFileGenerar;
                $arrayCabecera1[$fila + 1]["Codigo"] = "";
                $arrayCabecera1[$fila + 1]["Nombres"] = strtoupper($datos["nomSede"]) . " - " . strtoupper($datos["nomSubArea"]) . " - " . strtoupper($datos["nomCategoriapuesto"]);
                $arrayCabecera1[$fila + 2]["Codigo"] = "";
                $arrayCabecera1[$fila + 2]["Nombres"] = "";
                $diaMes = 0;
                for ($coln = 2; $coln < $númeroDeDias + 2; $coln++) {
                    if ($diaMes < $ultimoDia) {
                        $diaMes++;
                        $diaInicial = date("l", mktime(0, 0, 0, $mes, $diaMes, $anio));
                        $arrayCabecera1[$fila][$diaMes] = $diasSem[$diaInicial];
                        $arrayCabecera1[$fila + 1][$diaMes] = "";
                        $arrayCabecera1[$fila + 2][$diaMes] = "";
                    }
                }
                $arrayCabecera1[$fila]["Tot_Horas"] = "";
                $arrayCabecera1[$fila]["Num_Prog"] = "";
                $arrayCabecera1[$fila + 1]["Tot_Horas"] = "";
                $arrayCabecera1[$fila + 1]["Num_Prog"] = "";
                $arrayCabecera1[$fila + 2]["Tot_Horas"] = "";
                $arrayCabecera1[$fila + 2]["Num_Prog"] = "";
                $fila = $fila + 2;
            } else {
                $arrayCabecera1[$fila]["Codigo"] = "Codigo";
                $arrayCabecera1[$fila]["Nombres"] = "Nombres";
                $arrayCabecera1[$fila + 1]["Codigo"] = "";
                $arrayCabecera1[$fila + 1]["Nombres"] = strtoupper($datos["nomSede"]) . " - " . strtoupper($datos["nomSubArea"]) . " - " . strtoupper($datos["nomCategoriapuesto"]);
                $arrayCabecera1[$fila + 2]["Codigo"] = "Archivo :";
                $arrayCabecera1[$fila + 2]["Nombres"] = $nameFileGenerar;
                $diaMes = 0;
                for ($coln = 2; $coln < $númeroDeDias + 2; $coln++) {
                    if ($diaMes < $ultimoDia) {
                        $diaMes++;
                        $diaInicial = date("l", mktime(0, 0, 0, $mes, $diaMes, $anio));
                        $arrayCabecera1[$fila][$diaMes] = $diaMes;
                        $arrayCabecera1[$fila + 1][$diaMes] = "";
                        $arrayCabecera1[$fila + 2][$diaMes] = $diasSem[$diaInicial];
                    }
                }
                $arrayCabecera1[$fila]["Tot_Horas"] = "Tot_Horas";
                $arrayCabecera1[$fila]["Num_Prog"] = "Num_Prog";
                $arrayCabecera1[$fila + 1]["Tot_Horas"] = "";
                $arrayCabecera1[$fila + 1]["Num_Prog"] = "";
                $arrayCabecera1[$fila + 2]["Tot_Horas"] = "";
                $arrayCabecera1[$fila + 2]["Num_Prog"] = "";
                $fila = $fila + 3;
            }

            /* +------------------------------  Fin cabecera  ---------------------------+ */

            /* +------------------------------     Cuerpo    ---------------------------+ */
            $empleado = $oLRrhh->obtenerEmpleadosCategoriadelSubArea($datos);
            foreach ($empleado as $i => $value) {
                $arrayCabecera1[$i + $fila]["Codigo"] = $value[0];
                $arrayCabecera1[$i + $fila]["Nombres"] = $value[1];
                for ($j = 2; $j < $númeroDeDias + 2; $j++) {
                    $arrayCabecera1[$i + $fila][$j - 1] = "";
                }
                $arrayCabecera1[$i + $fila]["Tot_Horas"] = "";
                $arrayCabecera1[$i + $fila]["Num_Prog"] = "";
            }

            $fila = $fila + count($empleado);

            for ($i = 0; $i < 4; $i++) {
                $arrayCabecera1[$i + $fila]["Codigo"] = "";
                $arrayCabecera1[$i + $fila]["Nombres"] = "";
                for ($j = 2; $j < $númeroDeDias + 2; $j++) {
                    $arrayCabecera1[$i + $fila][$j - 1] = "";
                }
                $arrayCabecera1[$i + $fila]["Tot_Horas"] = "";
                $arrayCabecera1[$i + $fila]["Num_Prog"] = "";
                $fila++;
            }
        }

        /* +-----------------------------------------------------------------------------------------------+ */
        /* +-----------------------------------------------------------------------------------------------+ */
        /* +------------------------------  Fin cuerpo  ---------------------------+ */
        require_once("../../MSExcelStreamHandler/excel.php");
        require_once("../../MSExcelStreamHandler/excel-ext.php");

        createExcel($fileExportar . ".xls", $arrayCabecera1);
        exit();
    }

    function eliminarAsistencia($datos) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->eliminarAsistencia($datos);
        return $resultado;
    }

    public function exportarExcelEncargadosMorosos($datos) {
        $oLRrhh = new LRrhh();
        $reportes = $oLRrhh->exportarExcelEncargadosMorosos($datos);
        $reportesEncargados = $oLRrhh->exportarExcelEncargados($datos);
        require_once '../../cvista/rrhh/exportarExcelLosMorosos.php';
    }

    function personalVacaciones() {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->personalVacaciones();
        return $resultado;
    }

    function personalDescansoMedico() {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->personalDescansoMedico();
        return $resultado;
    }

    function desactivarEmpleadoArea($idCodigoEmpleado, $idCodigoSEACC) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->desactivarEmpleadoArea($idCodigoEmpleado, $idCodigoSEACC);
        return $resultado;
    }

    public function exportarExcelArea($datos) {
        $oLRrhh = new LRrhh();
        $area = $oLRrhh->exportarExcelArea($datos); // Se recupera los turnos que pertenecen al area de una sede
        require_once '../../cvista/rrhh/exportarExcelArea.php';
    }

    function funcionprueba() {

        $codEmpleado = $_SESSION['iCodigoEmpleado'];
        echo 'El codigo del empleado es' . $codEmpleado;
    }

    function asignacionEmpleadosxSubAreas() {
        $oLRrhh = new LRrhh();

        $iCodEmpCoordinador = $_SESSION['iCodigoEmpleado'];

        $arrayNombreCoordinador = $oLRrhh->nombreCoordinador($iCodEmpCoordinador);
        $arraySede = $oLRrhh->ListaSede($iCodEmpCoordinador);

//carga la pag.
        require_once '../../cvista/rrhh/asignacionEmpleado_Area.php';
    }

/////////////////////////////////agregue

    function menuCordinadoresTurnos() {
        $oLRrhh = new LRrhh();

        $iCodEmpCoordinador = $_SESSION['iCodigoEmpleado'];

        $arrayNombreCoordinador = $oLRrhh->nombreCoordinador($iCodEmpCoordinador);

//        $arraySede = $oLRrhh->ListaSede($iCodEmpCoordinador);
        //listarAllSedesCom
        $arrayTotalSedes = $oLRrhh->ListaTodasSede();
//          $arraySede = $oLRrhh->ListaTodasSede();
        //carga la pag.nueva para Menu CordinadoresTurnos
        require_once '../../cvista/rrhh/cordinadores_Turnos.php';
    }

    /////////////////////////////////agregue
/////inicio LABORATORIO/////
/////inicio LABORATORIO/////    


    function CargarArea($cboSede) {

        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $iCodEmpCoordinador = $_SESSION['iCodigoEmpleado'];

        $arrayAreas = $oLRrhh->CargarArea($iCodEmpCoordinador, $cboSede);
//        $arraySede = $oLRrhh->CargarEmpleados($iCodEmpCoordinador);
        $arrayAreas = is_array($arrayAreas) ? $arrayAreas : array();
        $arrayCabecera = array("0" => "Id Area", "1" => "Sede", "2" => "iIdSedeEmpresaArea", "3" => "Area");
//          $arrayCabecera = array("0" => "Id Area", "1" => "Nombre Area", "2" => "iIdSedeEmpresaArea", "3" => "NombreSede");
        $arrayTamano = array("0" => "40", "1" => "320", "2" => "20", "3" => "200");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro");
        $arrayCursor = array("0" => "default", "1" => "center", "2" => "default", "3" => "center");
        $arrayHidden = array("0" => "true", "1" => "false", "2" => "true", "3" => "false");
        $arrayAling = array("0" => "center", "1" => "center", "2" => "left", "3" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayAreas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function CargarlistadoTodosCordinadores($cboSede) {

        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
//        $iCodEmpCoordinador = $_SESSION['iCodigoEmpleado'];

        if (isset($_SESSION["permiso_formulario_servicio"][235]["ACCION_TURNO_AREA_CON_CORDINADOR"]) && ($_SESSION["permiso_formulario_servicio"][235]["ACCION_TURNO_AREA_CON_CORDINADOR"] == 1)) {
            $verAccionTurnoConCoordinador = "false";
        } else {
            $verAccionTurnoConCoordinador = "true";
        }



        if (isset($_SESSION["permiso_formulario_servicio"][235]["ACCION_COORDINADOR_AREA_CON_CORDINADOR"]) && ($_SESSION["permiso_formulario_servicio"][235]["ACCION_COORDINADOR_AREA_CON_CORDINADOR"] == 1)) {
            $verAccionCoordinadorConCoordinador = "false";
        } else {
            $verAccionCoordinadorConCoordinador = "true";
        }




        $arrayCargarlistadoTodosCordinadores = $oLRrhh->CargarlistadoTodosCordinadores($cboSede);

//        $arraySede = $oLRrhh->CargarEmpleados($iCodEmpCoordinador);
//        $arrayCargarlistadoTodosCordinadores = is_array($arrayCargarlistadoTodosCordinadores) ? $arrayCargarlistadoTodosCordinadores : array();

        $arrayCabecera = array("0" => "Sede", "1" => "Area", "2" => "Nivel", "3" => "Coordinador", "4" => "idEncargadoProgramacionPersonal", "5" => "idSedeEmpresaArea", "6" => "Fec Inicio", "7" => "Fecha Fin", "8" => "IcodigoCoordinado", "9" => "Accion Turno", "10" => "Accion Coordinador", "11" => "Horarios");
        $arrayTamano = array("0" => "100", "1" => "220", "2" => "100", "3" => "250", "4" => "150", "5" => "150", "6" => "50", "7" => "50", "8" => "50", "9" => "50", "10" => "50", "11" => "50");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "ro", "8" => "ro", "9" => "img", "10" => "img", "11" => "img");
        $arrayCursor = array("0" => "default", "1" => "center", "2" => "default", "3" => "default", "4" => "default", "5" => "default", "6" => "default", "7" => "default", "8" => "default", "9" => "pointer", "10" => "pointer", "11" => "pointer");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => "true", "5" => "true", "6" => "true", "7" => "true", "8" => "true", "9" => "false", "10" => "false", "11" => "false");

        $arrayAling = array("0" => "center", "1" => "left", "2" => "center", "3" => "center", "4" => "center", "5" => "center", "6" => "center", "7" => "center", "8" => "center", "9" => "center", "10" => "center", "11" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayCargarlistadoTodosCordinadores, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    //JCQA 09 Abril 2012

    function CargarlistaPuestosXCentroCostos($idCentroDeCosto) {

        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
//        $iCodEmpCoordinador = $_SESSION['iCodigoEmpleado'];

        $arrayCargarlistadoTodosCordinadores = $oLRrhh->CargarlistaPuestosXCentroCostos($idCentroDeCosto);

//        $arraySede = $oLRrhh->CargarEmpleados($iCodEmpCoordinador);
//        $arrayCargarlistadoTodosCordinadores = is_array($arrayCargarlistadoTodosCordinadores) ? $arrayCargarlistadoTodosCordinadores : array();

        $arrayCabecera = array("0" => "iidPuesto", "1" => "NombrePuesto", "2" => "Estado Puesto", "3" => "iid CCosto", "4" => "Nombre CCosto", "5" => "Categoria Puesto", "6" => "id Categoria");
        $arrayTamano = array("0" => "40", "1" => "295", "2" => "80", "3" => "40", "4" => "150", "5" => "95", "6" => "40");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro");
        $arrayCursor = array("0" => "default", "1" => "center", "2" => "center", "3" => "default", "4" => "default", "5" => "center", "6" => "default");
        $arrayHidden = array("0" => "true", "1" => "false", "2" => "false", "3" => "true", "4" => "false", "5" => "false", "6" => "true");
        $arrayAling = array("0" => "center", "1" => "left", "2" => "center", "3" => "center", "4" => "center", "5" => "center", "6" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayCargarlistadoTodosCordinadores, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function CargarlistadoTodasAreasSinCoordinador($cboSede) {

        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
//        $iCodEmpCoordinador = $_SESSION['iCodigoEmpleado'];

        if (isset($_SESSION["permiso_formulario_servicio"][235]["ACCION_TURNO_AREA_SIN_CORDINADOR"]) && ($_SESSION["permiso_formulario_servicio"][235]["ACCION_TURNO_AREA_SIN_CORDINADOR"] == 1)) {
            $verAccionTurnoSinCoordinador = "false";
        } else {
            $verAccionTurnoSinCoordinador = "true";
        }



        if (isset($_SESSION["permiso_formulario_servicio"][235]["ACCION_COORDINADOR_AREA_SIN_CORDINADOR"]) && ($_SESSION["permiso_formulario_servicio"][235]["ACCION_COORDINADOR_AREA_SIN_CORDINADOR"] == 1)) {
            $verAccionCoordinadorSinCoordinador = "false";
        } else {
            $verAccionCoordinadorSinCoordinador = "true";
        }


        $arrayCargarlistadoTodosCordinadores = $oLRrhh->CargarlistadoTodasAreasSinCoordinador($cboSede);

//        $arraySede = $oLRrhh->CargarEmpleados($iCodEmpCoordinador);
//        $arrayCargarlistadoTodosCordinadores = is_array($arrayCargarlistadoTodosCordinadores) ? $arrayCargarlistadoTodosCordinadores : array();

        $arrayCabecera = array("0" => "Sede", "1" => "Area", "2" => "Nivel", "3" => "Coordinador", "4" => "id SedeEmpresaArea", "5" => "Accion Turno", "6" => "Accion Coordinador");
        $arrayTamano = array("0" => "100", "1" => "*", "2" => "100", "3" => "50", "4" => "60", "5" => "50", "6" => "50");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "img", "6" => "img");
        $arrayCursor = array("0" => "default", "1" => "center", "2" => "default", "3" => "default", "4" => "default", "5" => "pointer", "6" => "pointer");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "true", "4" => "true", "5" => $verAccionTurnoSinCoordinador, "6" => $verAccionCoordinadorSinCoordinador);
        $arrayAling = array("0" => "center", "1" => "left", "2" => "center", "3" => "center", "4" => "center", "5" => "center", "6" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayCargarlistadoTodosCordinadores, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    //////aqui modificar

    function ListarEmpleadosPreProgramados($datos) {

        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $iCodEmpCoordinador = $_SESSION['iCodigoEmpleado'];

        $arrayListarEmpleadosProgramados = $oLRrhh->ListarEmpleadosPreProgramados($iCodEmpCoordinador, $datos);
//        $arraySede = $oLRrhh->CargarEmpleados($iCodEmpCoordinador);
        $arrayListarEmpleadosProgramados = is_array($arrayListarEmpleadosProgramados) ? $arrayListarEmpleadosProgramados : array();
        $arrayCabecera = array("0" => "Nombre", "1" => "IId PreProgr Per", "2" => "IId PuestoEmpleadoxArea", "3" => "AREA", "4" => "SEDE");
        $arrayTamano = array("0" => "250", "1" => "40", "2" => "40", "3" => "200", "4" => "150");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro");
        $arrayCursor = array("0" => "default", "1" => "center", "2" => "default", "3" => "center", "4" => "center");
        $arrayHidden = array("0" => "false", "1" => "true", "2" => "true", "3" => "false", "4" => "false");
        $arrayAling = array("0" => "center", "1" => "center", "2" => "center", "3" => "center", "4" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayListarEmpleadosProgramados, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function listarEmpleados($datos) {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
//        $iCodEmpCoordinador = $_SESSION['iCodigoEmpleado'];

        $arrayEmpleados = $oLRrhh->listarEmpleados($datos);

        $arrayAreas = is_array($arrayEmpleados) ? $arrayEmpleados : array();
        $arrayCabecera = array("0" => "Nombre Empleado", "1" => "iidPuestoEmpleadoPorArea", "2" => "iIdSedeEmpresaArea");
        $arrayTamano = array("0" => "400", "1" => "20", "2" => "20");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro");
        $arrayCursor = array("0" => "center", "1" => "center", "2" => "center");
        $arrayHidden = array("0" => "false", "1" => "true", "2" => "true");
        $arrayAling = array("0" => "center", "1" => "center", "2" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayAreas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function RefrescarTablaListaEmpleados($datos) {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
//        $iCodEmpCoordinador = $_SESSION['iCodigoEmpleado'];

        $arrayEmpleados = $oLRrhh->listarEmpleados($datos);

        $arrayAreas = is_array($arrayEmpleados) ? $arrayEmpleados : array();
        $arrayCabecera = array("0" => "Nombre Empleado", "1" => "iidPuestoEmpleadoPorArea", "2" => "iIdSedeEmpresaArea");
        $arrayTamano = array("0" => "400", "1" => "20", "2" => "20");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro");
        $arrayCursor = array("0" => "center", "1" => "center", "2" => "center");
        $arrayHidden = array("0" => "false", "1" => "true", "2" => "true");
        $arrayAling = array("0" => "center", "1" => "center", "2" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayAreas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function asignarPreProgramacion($datos) {

        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->insercionPreProgramacion($datos);

        $resultado = $oLRrhh->actualizacionEstadoPuestoSedeEmpresaArea($datos["idPuestoEmpleadoPorArea"]);
        return $resultado;
    }

    function asignarTurnoDisponibleAlArea($datos) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->insercionTurnoDisponibleAlArea($datos);

        // $resultado = $oLRrhh->actualizacionEstadoPuestoSedeEmpresaArea($datos["idPuestoEmpleadoPorArea"]);

        return $resultado;
    }

//Modificado 20 Abril 2012
    function grabarColorSelecionadoTurnoAreaSede($datos) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->grabarColorSelecionadoTurnoAreaSede($datos);

        // $resultado = $oLRrhh->actualizacionEstadoPuestoSedeEmpresaArea($datos["idPuestoEmpleadoPorArea"]);

        return $resultado;
    }

    function listarEmpleadosProgramados($datos) {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayEmpleadosProgramados = $oLRrhh->listarEmpleadosProgramados($datos);
        $arrayEmpleadosProgramados = is_array($arrayEmpleadosProgramados) ? $arrayEmpleadosProgramados : array();

        $arrayCabecera = array("0" => "Nombre Empleado", "1" => "iidPreProgramacionPersonal", "2" => "iidPuestoEmpleadoPorArea");
        $arrayTamano = array("0" => "400", "1" => "20", "2" => "20");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro");
        $arrayCursor = array("0" => "center", "1" => "center", "2" => "center");
        $arrayHidden = array("0" => "false", "1" => "true", "2" => "true");
        $arrayAling = array("0" => "center", "1" => "center", "2" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayEmpleadosProgramados, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function quitarPreProgramacion($datos) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->actualizarEstadoPreProgramacion($datos["idPreProgramacionPersonal"]);

        $resultado1 = $oLRrhh->actualizacionEstadoPuestoSedeEmpresaAreadescativacion($datos["idPuestoEmpleadoPorArea"]);
        return $resultado;
    }

//    quitarTurnoSeleccionadoAlArea($idSedeEmpresaArea);

    function quitarTurnoSeleccionadoAlArea($idTurnoAreaSede) {
        $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->quitarTurnoSeleccionadoAlArea($idTurnoAreaSede);

        // $resultado1 = $oLRrhh->actualizacionEstadoPuestoSedeEmpresaAreadescativacion($datos["idPuestoEmpleadoPorArea"]);
        return $resultado;
    }
    public function aElimnarCajaComprobante($iIdCajaComprobante){
         $oLRrhh = new LRrhh();
        $resultado = $oLRrhh->lElimnarCajaComprobante($iIdCajaComprobante);
        return $resultado;
    }
    public function mantenimientoCaja($c_cod_per) {
        $oLRrhh = new LRrhh();
        $arrayCajero = $oLRrhh->mantenimientoCaja($c_cod_per);
        $arrayUsuario = $oLRrhh->UsuarioCaja($c_cod_per);
        $arrayMaximoNumeroCaje = $oLRrhh->maximonumeroCaja($c_cod_per);
        $arrayTipoComprobante = $oLRrhh->LtipoComprobante($c_cod_per);
//     print_r($arrayCajero);
//      $mensaje= $arrayCajero;

        if ($arrayCajero == 1) {
            $mensaje = '';
            require_once("../../cvista/rrhh/mantenimientoCajero.php");
        } else {
            $mensaje = "0";
//            require_once("../../cvista/usuario/vRegistroUsuario.php");
        }
//        print_r($mensaje);
        return $mensaje;
    }

    public function ApoppackBoletas($c_cod_per) {
        $oLRrhh = new LRrhh();
        $arraySerieComprobante = $oLRrhh->LtipoComprobanteNoSeleccionado($c_cod_per);

        require_once("../../cvista/rrhh/agregarBoleta.php");
    }

    public function AguardarComprobanteSerie($datos) {
        $oLRrhh = new LRrhh();
        $oLRrhh->LempleadoCajero($datos);
        //$oLRrhh->LserieComprobante($datos);
    }

    public function ApoppackBoletasEdita($datos) {
        $oLRrhh = new LRrhh();
//$arrayTipoComprobante=$oLRrhh->LtipoComprobanteNoSeleccionado($c_cod_per);

        require_once("../../cvista/rrhh/editaSerieComprobante.php");
    }

    public function AmodificarSerieEstado($datos) {

        $oLRrhh = new LRrhh();
        $arrayCajero = $oLRrhh->LmodificarSerieEstado($datos);
    }

    /* Jose Delgado Regularizacion de Horario 10-04-2012 */

    public function podpadBusquedaEmpleado() {
        $o_LPersona = new ActionPersona();
        $comboTipoDocumentos = $o_LPersona->comboTipoDocumento('1');
        require_once("../../cvista/rrhh/buscarEmpleado1.php");
    }

    /* Jose Delgado Auditoria de Registro de Asistencia 18-04-2012 */

    public function tablaMarcacionEmpleadosAudiotira($parametros) {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRrhh->tablaMarcacionEmpleadosAudiotira($parametros);
        //$arrayTablaMarcacionEmpleadosAudiotira = is_array($arrayTablaMarcacionEmpleadosAudiotira) ? $arrayTablaMarcacionEmpleadosAudiotira : array();

        $arrayCabecera = array("0" => "Modificado por Usuario", "1" => "Fecha Marcación", "2" => "Fecha Registro", "3" => "Modificacion");
        $arrayTamano = array("0" => "175", "1" => "115", "2" => "115", "3" => "20");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro");
        $arrayCursor = array("0" => "default", "1" => "default", "2" => "default", "3" => "default");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "true");
        $arrayAling = array("0" => "center", "1" => "center", "2" => "center", "3" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);



//        $oLMantenimientoGeneral = new LMantenimientoGeneral();
//         $o_TablaHtmlx = new tablaDHTMLX();
//         $arrayFilas =$oLMantenimientoGeneral->tablaSucursalesXidArea($idArea);
//         
//        $arrayCabecera=array(0=>"idSedeEmpresaArea",1=>"IdSedeEmpresa",2=>"Sede",3=>"idArea",4=>"Área",5=>"estado",6=>"Estado",7=>"Editar",8=>"Eliminar");
//        $arrayTamano=array(0=>"150",1=>"100",2=>"200",3=>"100",4=>"290",5=>"100",6=>"150",7=>"60",8=>"60");
//        $arrayTipo=array(0=>"ro",1=>"ro",2=>"ro",3=>"ro",4=>"ro",5=>"ro",6=>"ro",7=>"img",8=>"img");
//        $arrayCursor=array(0=>"default",1=>"default",2=>"default",3=>"default",4=>"default",5=>"default",6=>"default",7=>"default",8=>"default");
//        $arrayHidden=array(0=>"true",1=>"true",2=>"false",3=>"true",4=>"false",5=>"true",6=>"false",7=>"true",8=>"false");
//        $arrayAling=array(0=>"left",1=>"left",2=>"left",3=>"left",4=>"left",5=>"left",6=>"left",7=>"center",8=>"center");
//        return $o_TablaHtmlx->generaTabla($arrayCabecera,$arrayFilas,$arrayTamano,$arrayTipo,$arrayCursor,$arrayHidden,$arrayAling);
//        
    }

    //*************************VACACIONES **************************************//
    //******************************JCDB 04/05/2012*****************************//
    public function poppadVaciones() {
        //$oLRrhh = new LRrhh();
        //$comboTipoDescanso = $this->comboTipoDescanso('1');
        require_once("../../cvista/rrhh/vistaVacaciones.php");
    }

    public function comboTipoDescanso($optionsHTML) {
        $oLRrhh = new LRrhh();
        $arrayCombo = $oLRrhh->comboTipoDescanso();
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

    public function tablaDescansoContratoEmpleado($parametros) {
        $oLRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayContratos = $oLRrhh->tablaDescansoContratoEmpleado($parametros);
        $arrayCabecera = array("0" => "idPuesto", "1" => "Id Contrato", "2" => "idDescanso", "3" => "idTipoDescanso", "4" => "Puesto", "5" => "Descanso", "6" => "Fec. Cont. Ini.", "7" => "Fec. Cont. Fin", "8" => "Fec. Desc. Ini.", "9" => "Fec. Desc. Fin", "10" => "colorDescanso", "11" => "bEstado", "12" => "Editar", "13" => "Eliminar");
        $arrayTamano = array("0" => "30", "1" => "72", "2" => "30", "3" => "70", "4" => "216", "5" => "167", "6" => "86", "7" => "86", "8" => "86", "9" => "86", "10" => "70", "11" => "30", "12" => "47", "13" => "47");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "ro", "8" => "ro", "9" => "ro", "10" => "ro", "11" => "ro", "12" => "img", "13" => "img");
        $arrayCursor = array("0" => "default", "1" => "default", "2" => "default", "3" => "default", "4" => "default", "5" => "default", "6" => "default", "7" => "default", "8" => "default", "9" => "default", "10" => "default", "11" => "default", "12" => "default", "13" => "default");
        $arrayHidden = array("0" => "true", "1" => "false", "2" => "true", "3" => "true", "4" => "false", "5" => "false", "6" => "false", "7" => "false", "8" => "false", "9" => "false", "10" => "true", "11" => "true", "12" => "false", "13" => "false");
        $arrayAling = array("0" => "center", "1" => "center", "2" => "center", "3" => "center", "4" => "center", "5" => "center", "6" => "center", "7" => "center", "8" => "center", "9" => "center", "10" => "center", "11" => "center", "12" => "center", "13" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayContratos, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    //*************************FIN VACACIONES **************************************//
    public function poppadVacacionesMantenimiento() {
        $oLRrhh = new LRrhh();
        $comboTipoDescanso = $this->comboTipoDescanso('0000', 'SELECCIONAR');
        require_once("../../cvista/rrhh/vistaVacacionesMantenimiento.php");
    }

    public function guardarVacaciones($parametros) {
        $oLRrhh = new LRrhh();
        $respuesta = $oLRrhh->guardarVacaciones($parametros);
        return $respuesta;
    }

    public function eliminarVacaciones($parametros) {
        $oLRrhh = new LRrhh();
        $respuesta = $oLRrhh->eliminarVacaciones($parametros);
        return $respuesta;
    }

    public function desactivarPuestoenCentroCostos($parametros) {
        $oLRrhh = new LRrhh();
        $respuesta = $oLRrhh->desactivarPuestoenCentroCostos($parametros);
        return $respuesta;
    }

    //*************************FIN VACACIONES **************************************//

    /* ======================================================================= */
    /* =================================== RR-HH - lobo ========================== */
    /* ======================================================================= */
    /* ======================================================================= */
    /* =================================== Coordinadores - lobo ========================== */
    /* ======================================================================= */
    public function ActivacionCoordinadores() {
        require_once("../../cvista/rrhh/ActivacionCoordinadores.php");
    }

    public function ADesactivarCoordinador($datos) {
        $oLRrhh = new LRrhh();
        $arrayCajero = $oLRrhh->LDesactivarCoordinador($datos);
    }

    public function ActivarCoordinador($datos) {
        $oLRrhh = new LRrhh();
        $arrayCajero = $oLRrhh->LActivarCoordinador($datos);
    }

    public function ActivarCordinadorXarea($datos) {
        $oLRrhh = new LRrhh();
        $estado = 'true';
        if (isset($_SESSION["permiso_formulario_servicio"][238]["ACTIVAR_COORDINADOR"]) && ($_SESSION["permiso_formulario_servicio"][238]["ACTIVAR_COORDINADOR"] == 1)) {
            $estado = 'false';
        }

        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayActivarCordinardoXarea = $oLRrhh->LActivarCordinadorXarea($datos);
        $arrayAreas = is_array($arrayActivarCordinardoXarea) ? $arrayActivarCordinardoXarea : array();
        $arrayCabecera = array("0" => "IdHistoriaDeCoordinador", "1" => "iIdEncargadoProgramacionPersonal", "2" => "bEstadoPermisoEspecial", "3" => "SEDE", "4" => "Areas", "5" => "Nombre Coordinador", "6" => "Accion");
        $arrayTamano = array("0" => "50", "1" => "50", "2" => "180", "3" => "120", "4" => "200", "5" => "250", "6" => "50");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "img");
        $arrayCursor = array("0" => "default", "1" => "default", "2" => "default", "3" => "default", "4" => "default", "5" => "default", "6" => "pointer");
        $arrayHidden = array("0" => "true", "1" => "true", "2" => "true", "3" => "false", "4" => "false", "5" => "false", "6" => $estado);
        $arrayAling = array("0" => "center", "1" => "center", "2" => "center", "3" => "left", "4" => "left", "5" => "left", "6" => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayAreas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function AdarPermisoEspecialAlCoordinador($datos) {
        $oLRrhh = new LRrhh();
        $arrayCajero = $oLRrhh->LdarPermisoEspecialAlCoordinador($datos);
    }

    function HorariosTurnosAreaCoordinador($datos) {
        $o_LRrhh = new LRrhh();
//        $resultado = $o_LRrhh->HorariosTurnos($codigoCordinador);
        $mes = mktime(0, 0, 0, $datos["mes"], 1, $datos["anio"]);
        $nDias = intval(date("t", $mes));

        $diasSem = Array('Monday' => 'L', 'Tuesday' => 'M', 'Wednesday' => 'M', 'Thursday' => 'J', 'Friday' => 'V', 'Saturday' => 'S', 'Sunday' => 'D');
        $arrayDiaDelmes = array(0 => 'Accion');

        for ($coln = 0; $coln < $nDias; $coln++) {
            $m = $coln + 1;
            $fechaInicioMes = date("l", mktime(0, 0, 0, $datos["mes"], $m, $datos["anio"]));
            $diasSemDia = Array(0 => $diasSem[$fechaInicioMes], 1 => $m);
            $arrayDiaDelmes[$coln] = $diasSemDia; // tu eres el dato
        }

// $datos["idModalidadContrato"]
        $resultadoArrayNuevo = $_SESSION['TurnoEmpleadoCordinadoresArea'];

        $n = 0;
        if ($datos["idModalidadContrato"] == 0) {
            if ($resultadoArrayNuevo) {
                foreach ($resultadoArrayNuevo as $k => $value) {
                    // AlenyendaArea($datos) ;             
                    $arrayListaTurnos = $o_LRrhh->ListaTurnosAreaExcel($value[2],$datos["anio"],$datos["mes"] );
                    //echo 'peche';
                    if ($resultadoArrayNuevo[$k] <> 1) {
                        array_push($resultadoArrayNuevo[$k], $arrayListaTurnos);
                    }
                    //print($arrayAreaXcoordinadoresn[$k]);
                }
            }
        } else {
            if ($resultadoArrayNuevo) {
                foreach ($resultadoArrayNuevo as $w => $valuew) {
                     $arrayListaTurnos = $o_LRrhh->ListaTurnosAreaExcel($valuew[2],$datos["anio"],$datos["mes"]);
                    //echo 'peche';
                    if ($resultadoArrayNuevo[$w] <> 1) {
                        array_push($resultadoArrayNuevo[$w], $arrayListaTurnos);
                    }                
                    
                    if (is_array($valuew[8])) {
                        foreach ($valuew[8] as $p => $valuep) {
                            if ($valuep[12] != $datos["idModalidadContrato"]) {
                                unset($valuew[8][$p]);
                            }
                        }
                    }
                    if (count($valuew[8]) == 0) {
                        unset($resultadoArrayNuevo[$w]);
                    } else {
                        $resultadoArrayNuevo[$w][8] = $valuew[8];
                    }
                }
            }
        }

        $arrayAreaXcoordinadoresn = $resultadoArrayNuevo;
        require_once '../../cvista/rrhh/turnoCordinadores.php';
    }

    /* ======================================================================= */

    public function AseleccionarTunosProgramar($datos) {
        $oLRrhh = new LRrhh();
        $arrayListaTurnos = $oLRrhh->ListaTurnosArea($datos["codigoSedeEmpresaArea"],$datos["cboAnio"],$datos["cboMes"]);

        require_once("../../cvista/rrhh/IngresoProgramacionTurno.php");
    }

    public function AseleccionarTunosProgramarIndividualSinTurno($datos) {
        $oLRrhh = new LRrhh();
        $arrayListaTurnos = $oLRrhh->ListaTurnosArea($datos["codigoSedeEmpresaArea"],$datos["anno"],$datos["mes"]);

        require_once("../../cvista/rrhh/IngresoTurnoProgramarIndividual.php");
    }

    public function AguardarTurnoProgramadoGrupo($datos) {
        $oLRrhh = new LRrhh();
        $arrayMensajeCrecuHorario = $oLRrhh->LguardarTurnoProgramadoGrupo($datos);

        $cadena = '<table border ="1">';
        if ($arrayMensajeCrecuHorario) {
            foreach ($arrayMensajeCrecuHorario as $k => $value) {
                $cadena .= '<tr>';
                $cadena .= '<td>';
                $cadena .= '<font color="red" size="2">' . $value[0] . '</font>';
                $cadena .= '</td>';
                $cadena .= '</tr>';
            }
            $cadena = $cadena . '</table>';
        } else {
            $cadena = 1;
        }
        return $cadena;
    }

    public function AguardarTurnoProgramadoIndividual($datos) {
        $oLRrhh = new LRrhh();
        $arrayMensajeCrecuHorario = $oLRrhh->LguardarTurnoProgramadoGrupo($datos);

        if ($arrayMensajeCrecuHorario) {
            return $arrayMensajeCrecuHorario[0][0];
        } else {
            return $arrayMensajeCrecuHorario = 1;
        }
    }

    public function ASeleccionarModificarEliminarTunosProgramarIndividual($datos) {
        $oLRrhh = new LRrhh();
        $arrayListaTurnos = $oLRrhh->ListaTurnosArea($datos["codigoSedeEmpresaArea"]);

        require_once("../../cvista/rrhh/ActualizarModificarTurnos.php");
    }

    public function AmodificarTurnoProgramadoIndividuar($datos) {
        $oLRrhh = new LRrhh();
        $arrayCruceHorario = $oLRrhh->LverificarTurnoProgramadoIndividuar($datos);

        if ($arrayCruceHorario[0][0] == 1) {
            $arrayMensajeCrecuHorario = $this->AeliminarTurnoProgramadoIndividuar($datos);
            $arrayMensajeCrecuHorario1 = $this->AguardarTurnoProgramadoGrupo($datos);
            return 1; // sin cruce
        } else {
            return $arrayCruceHorario[0][0]; // cruce
        }
    }

    public function AeliminarTurnoProgramadoIndividuar($datos) {
        $oLRrhh = new LRrhh();
        $arrayMensajeCrecuHorario = $oLRrhh->LeliminarTurnoProgramadoIndividuar($datos);
    }

    public function registroHorariosEmpleados() {
        $oLRrhh = new LRrhh();

        $iCodEmpCoordinador = $_SESSION['iCodigoEmpleado'];

        $arrayNombreCoordinador = $oLRrhh->nombreCoordinador($iCodEmpCoordinador);
        $arrayFechaSistemaActual = $oLRrhh->LfechaSistema();
        $resultadoTurnos = $oLRrhh->HorariosTurnos($_SESSION['iCodigoEmpleado']);
        $resulModalidadContrato = $oLRrhh->DmodalidadContrato();

        require_once '../../cvista/rrhh/registro_horarios_personal.php';
    }

    public function AreporteEmpleado($datos) {
        $mes = mktime(0, 0, 0, $datos["mes"], 1, $datos["anio"]);
        $nDias = intval(date("t", $mes));

        $diasSem = Array('Monday' => 'L', 'Tuesday' => 'M', 'Wednesday' => 'M', 'Thursday' => 'J', 'Friday' => 'V', 'Saturday' => 'S', 'Sunday' => 'D');
        $arrayDiaDelmes = array(0 => 'Accion');

        for ($coln = 0; $coln < $nDias; $coln++) {
            $m = $coln + 1;
            $fechaInicioMes = date("l", mktime(0, 0, 0, $datos["mes"], $m, $datos["anio"]));
            $diasSemDia = Array(0 => $diasSem[$fechaInicioMes], 1 => $m);
            $arrayDiaDelmes[$coln] = $diasSemDia; // tu eres el dato
        }


        $oLRrhh = new LRrhh();

        $arrayAreaXcoordinadores = $oLRrhh->LAreaDeLosCoordinadores($datos["iCodEmpCoordinador"], $datos["anio"], $datos["mes"]);
        if (!empty($arrayAreaXcoordinadores)) {
//  unset($turnoProgramado[$n]);
            foreach ($arrayAreaXcoordinadores as $i => $value) {
                //$totalHorasProgramadas=0;
                $resultaEmpleadosXsusArea = $oLRrhh->LempleadosXsusArea($value[2], $datos["anio"], $datos["mes"], $value[4]); //$value[2]=iIdSedeEmpresaArea; $value[4]=iCategoria
                if (!empty($resultaEmpleadosXsusArea)) {
                    foreach ($resultaEmpleadosXsusArea as $j => $valuex) {
                        $resultaEmpleadosXturnos = $oLRrhh->LempleadosXturnos
                                ($valuex[0], $datos["anio"], $datos["mes"], $nDias, $valuex[3], $valuex[4], $valuex[5], $valuex[6], $value[2]);
                        ////$valuex[0]=iidPreprogramacionPersonal,$valuex[3] ,$valuex[4] posiciones
                        $SubtotalHorasProgramadas = 0;
                        foreach ($resultaEmpleadosXturnos as $f => $valuef) {
                            $SubtotalHorasProgramadas = $SubtotalHorasProgramadas + $valuef[6];
                            foreach ($arrayDiaDelmes as $k => $valuek) {// compara los dias ejemplo del 1 al 30 de cada mes
                                if ($valuef[5] == $valuek[1]) {
                                    array_push($resultaEmpleadosXturnos[$f], $valuek[0]); //me ayuda a comparar si es domingo
                                }
                            }
                        }
                        array_push($resultaEmpleadosXsusArea[$j], $resultaEmpleadosXturnos);
                        array_push($resultaEmpleadosXsusArea[$j], $SubtotalHorasProgramadas);
                    }
                    array_push($arrayAreaXcoordinadores[$i], $resultaEmpleadosXsusArea);
                } else {
                    $arrayAreaXcoordinadores[$i] = '1';
//                    array_push($arrayAreaXcoordinadores[$i], '');
                }
                ////////
            }
        }


        if ($datos["anio"] >= $datos["annoActual"] && $datos["mes"] >= $datos["mesActual"] + 1) {
            $_SESSION['TurnoEmpleadoCordinadoresArea'] = $arrayAreaXcoordinadores;
            require_once("../../cvista/rrhh/ListaEmpleadoProgrmar.php");
        } else {
            $_SESSION['TurnoEmpleadoCordinadoresArea'] = $arrayAreaXcoordinadores;
            require_once("../../cvista/rrhh/ListaEmpleadoProgramarSinEditar.php");
        }
    }

    public function AlenyendaArea($datos) {
        $oLRrhh = new LRrhh();
        $arrayListaTurnos = $oLRrhh->ListaTurnosAreaUsado($datos["codigoSedeEmpresaArea"]);
        $arrayListaTurnoDescanso = $oLRrhh->ListaTurnosAreaDescanso($datos["codigoSedeEmpresaArea"]);

        $cadena = '<table border ="1">';
        $cadena .= '<tr>';
        $cadena .= '<td colspan="8">';
        $cadena .= '<table border ="1">';
        $cadena .= '<tr>';
        foreach ($arrayListaTurnos as $k => $value) {
            if ($k <= 7) {
                $cadena .= '<td style="width: 125px; height: 20px" bgcolor="' . $value[1] . '">';
                $cadena .= '<font  size="1">' . $value[3] . '(' . $value[2] . ')</font>';
                $cadena .= '</td>';
            }
        }
        $cadena .= '</tr>';
        ///////////////////////////////////////////////////////
        $cadena .= '<tr>';
        foreach ($arrayListaTurnos as $k => $value) {
            if ($k > 7 && $k <= 15) {
                $cadena .= '<td style="width: 125px; height: 20px" bgcolor="' . $value[1] . '">';
                $cadena .= '<font  size="1">' . $value[3] . '(' . $value[2] . ')</font>';
                $cadena .= '</td>';
            }
        }
        $cadena .= '</tr>';
        ///////////////////////////////////////////////////////
        $cadena .= '<tr>';
        foreach ($arrayListaTurnos as $k => $value) {
            if ($k > 14) {
                $cadena .= '<td style="width: 125px; height: 20px" bgcolor="' . $value[1] . '">';
                $cadena .= '<font size="1">' . $value[3] . '(' . $value[2] . ')</font>';
                $cadena .= '</td>';
            }
        }
        $cadena .= '</tr>';
        $cadena .= '</table>';
        $cadena .= '</td>';
        $cadena .= '</tr>';


        $cadena .= '<tr>';
        foreach ($arrayListaTurnoDescanso as $m => $valuem) {
            $cadena .= '<td bgcolor="' . $valuem[2] . '">';
            $cadena .= $valuem[1];
            $cadena .= '</td>';
        }
        $cadena .= '</tr>';
        $cadena = $cadena . '</table>';
        return $cadena;
    }

    /* ======================================================================= */
    /* =================================== RR-HH Fin - lobo ========================== */
    /* ======================================================================= */
    /* ======================================================================= */
    /* =================================== RR-HH medicos - inicio ========================== */
    /* ======================================================================= */

    public function AsistenciaMedico() {
        require_once("../../cvista/rrhh/ReporteMedicosAsistencia.php");
    }

    public function podpadBusquedaMedicos() {
        $o_LPersona = new ActionPersona();
        $comboTipoDocumentos = $o_LPersona->comboTipoDocumento('1');
        require_once("../../cvista/rrhh/BusquedaMedico.php");
    }

    public function AbuscaMedico($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre) {

        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LRrhh->getListaMedicos($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre);
        // print_r($arrayFilas);
        $arrayCabecera = array(0 => "código", 1 => "Codigo", 2 => "Nombre", 3 => "Est. Emp");
        $arrayTamano = array(0 => "100", 1 => "100", 2 => "*", 3 => "100");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "false", 3 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function reporteBusquedaMedico($datos) {

        $o_LRrhh = new LRrhh();
        $cantidadMedicosRegistro = $o_LRrhh->LcantidadRegistroMedico($datos); // cantidad de medicos en esa fecha
        $_SESSION['cantidadMedicos'] = $cantidadMedicosRegistro[0][0];
//        print_r($cantidadMedicosRegistro);
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LRrhh->LreporteBusquedaMedico($datos, $cantidadMedicosRegistro[0][0]);

        $arrayCabecera = array(0 => "nro", 1 => "código", 2 => "Nombre Medico", 3 => "Fecha", 4 => "Hora Entrada", 5 => "Hora Salida", 6 => "Hora Trabajadas", 7 => "Total");
        $arrayTamano = array(0 => "20", 1 => "100", 2 => "*", 3 => "100", 4 => "100", 5 => "100", 6 => "100", 7 => "100");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false", 6 => "false", 7 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "center", 3 => "center", 4 => "center", 5 => "center", 6 => "center", 7 => "center");
        //return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor,$arrayHidden,$arrayAlineacion);
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function AlistaMedicosPorParteAdelante($datos) {

        $o_LRrhh = new LRrhh();
//        $cantidadMedicosRegistro = $o_LRrhh->LcantidadRegistroMedico($datos);// cantidad de medicos en esa fecha
//        $_SESSION['cantidadMedicos']=$cantidadMedicosRegistro;
//        print_r($cantidadMedicosRegistro);

        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LRrhh->LreporteBusquedaMedicoX($datos, $_SESSION['cantidadMedicos']);
        $arrayCabecera = array(0 => "nro", 1 => "código", 2 => "Nombre Medico", 3 => "Fecha", 4 => "Hora Entrada", 5 => "Hora Salida", 6 => "Hora Trabajadas", 7 => "Total");
        $arrayTamano = array(0 => "20", 1 => "100", 2 => "*", 3 => "100", 4 => "100", 5 => "100", 6 => "100", 7 => "100");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false", 6 => "false", 7 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "center", 3 => "center", 4 => "center", 5 => "center", 6 => "center", 7 => "center");
        //return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor,$arrayHidden,$arrayAlineacion);
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);

//            $arrayCabecera = array(0 => "código", 1 => "Nombre Medico", 2 => "Fecha", 3 => "Hora Entrada", 4 => "Hora Salida", 5 => "Hora Trabajadas");
//            $arrayTamano = array(0 => "100", 1 => "220", 2 => "120", 3 => "100", 4 => "100", 5 => "100");
//            $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro");
//            $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default");
//            $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false");
//            $arrayAling = array(0 => "left", 1 => "left", 2 => "center", 3 => "center", 4 => "center", 5 => "center");
//            return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function ApodpadReporteEmpleadoVenceContrato() {

        require_once ("../../cvista/rrhh/vistaReporteVenceContrato.php");
    }

    public function AverEmpleadoCaducaSuContratoTabla() {

        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $verEmpleadoCaducaSuContrato = $o_LRrhh->LverEmpleadoCaducaSuContratoTabla(); // cantidad de medicos en esa fecha

        $arrayCabecera = array(0 => "c_cod_per", 1 => "iEmpleado", 2 => "Nombre Completo", 3 => "Puesto Laboral", 4 => "Fecha Termino Contrato");
        $arrayTamano = array(0 => "80", 1 => "100", 2 => "200", 3 => "200", 4 => "90");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default");
        $arrayHidden = array(0 => "false", 1 => "true", 2 => "false", 3 => "false", 4 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left");
        //return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor,$arrayHidden,$arrayAlineacion);
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $verEmpleadoCaducaSuContrato, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function AprogramacionAsistenciaPersonalRRHH($datos) {
        $oLRrhh = new LRrhh();
        $arrayHorarios = $oLRrhh->LprogramacionAsistenciaPersonalRRHH($datos);
        $mensaje = '';

        require_once("../../cvista/rrhh/programacionPersonaRecursosHumanos.php");

        return $mensaje;
    }

    public function aMantenimientoAreaPersona($datos) {
        $oLRrhh = new LRrhh();
        $arrayRespuesta = $oLRrhh->lMantenimientoAreaPersona($datos);


        return $arrayRespuesta[0][0];
    }

    public function aActualizarProgramacionEmpleados($datos) {
        $oLRrhh = new LRrhh();
        $arrayRespuesta = $oLRrhh->lActualizarProgramacionEmpleados($datos);
        return utf8_encode($arrayRespuesta[0][0]);
    }

    function busquedaPersonalPorNombres($datos) {
        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LRrhh->busquedaPersonalPorNombres($datos);
        $arrayCabecera = array(0 => "Codigo", 1 => "Empleado", 2 => "Puesto", 3 => "Tipo Programacion", 4 => "iIdTIpoProgramacion", 5 => "Fecha Inicio", 6 => "Fecha Fin", 7 => "COntrato", 8 => "año fin", 9 => "mes fin", 10 => "estado", 11 => "año inicio", 12 => "mes inicio");
        $arrayTamano = array(0 => "60", 1 => "*", 2 => "*", 3 => "*", 4 => "50", 4 => "70", 5 => "70", 6 => "70", 7 => "70", 8 => "70", 9 => "70", 10 => "70", 11 => "70", 12 => "70");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro", 9 => "ro", 10 => "ro", 11 => "ro", 12 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default", 10 => "default", 11 => "default", 12 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "true", 4 => "true", 5 => "false", 6 => "false", 7 => "false", 8 => "true", 9 => "true", 10 => "true", 11 => "true", 12 => "true");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "left", 3 => "center", 4 => "center", 5 => "center", 6 => "center", 7 => "center", 8 => "center", 9 => "center", 10 => "center", 11 => "center", 12 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function busquedaPersonalPorDNI($datos) {
        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LRrhh->busquedaPersonalPorDNI($datos);
        $arrayCabecera = array(0 => "Codigo", 1 => "Empleado", 2 => "Puesto", 3 => "Tipo Programacion", 4 => "iIdTIpoProgramacion", 5 => "Fecha Inicio", 6 => "Fecha Fin", 7 => "COntrato", 8 => "año", 9 => "mes", 10 => "estado", 11 => "año inicio", 12 => "mes inicio");
        $arrayTamano = array(0 => "60", 1 => "*", 2 => "*", 3 => "*", 4 => "50", 4 => "70", 5 => "70", 6 => "70", 7 => "70", 8 => "70", 9 => "70", 10 => "70", 11 => "70", 12 => "70");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro", 9 => "ro", 10 => "ro", 11 => "ro", 12 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default", 10 => "default", 11 => "default", 12 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "true", 4 => "true", 5 => "false", 6 => "false", 7 => "false", 8 => "false", 9 => "false", 10 => "false", 11 => "false", 12 => "false");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "left", 3 => "center", 4 => "center", 5 => "center", 6 => "center", 7 => "center", 8 => "center", 9 => "center", 10 => "center", 11 => "center", 12 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function datosPersonalSeleccionadoXcoodinador($datos) {
        $oLRrhh = new LRrhh();
        $respuesta = $oLRrhh->datosPersonalSeleccionadoXcoodinador($datos);
        return $respuesta;
    }

    public function datosAreasDeCoordinador($datos) {
        $oLRrhh = new LRrhh();
        $respuesta = $oLRrhh->datosAreasDeCoordinador($datos);
        return $respuesta;
    }

    public function validarDatosContratoPersonal($datos) {
        $oLRrhh = new LRrhh();
        $respuesta = $oLRrhh->validarDatosContratoPersonal($datos);
        if ($respuesta[0][5] == '' || $respuesta[0][7] == '' || $respuesta[0][8] == '') {
            $respuesta = 0;
        } else {
            $respuesta = 1;
        }
        return $respuesta;
    }

//-------------------------------------SANDY-------------------------------------------------
//-------------------------------------------------------------------------------------------
    public function AprogramacionPorArea($datos) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->LprogramacionPorArea($datos);
        $resultadoAreaSede = $o_LRrhh->LprogramacionPorAreaSede($datos);
        require_once("../../cvista/rrhh/ProgramacionPorArea.php");
    }

    public function programacionTotalEmpleadoAreaSede($datos) {
        $o_LRrhh = new LRrhh();
        $resultadoArea = $o_LRrhh->areasPorProgramacionEmpleado($datos);
        $resultadoEmpleado = $o_LRrhh->programacionPorEmpleadoDetalleSede($datos);
        require_once("../../cvista/rrhh/programacionTotalEmpleadoAreaSede.php");
    }

    public function AprogramacionBorrar($datos) {
        $o_LRrhh = new LRrhh();

        // $resultado = $o_LRrhh->LprogramacionBorrar($datos);
        require_once("../../cvista/rrhh/programacionBorrar.php");
    }

    public function aProgramacionEliminarPopadVista($datos) {
        $o_LRrhh = new LRrhh();

        // $resultado = $o_LRrhh->LprogramacionBorrar($datos);
        require_once("../../cvista/rrhh/aProgramacionEliminarPopadVista.php");
    }

    public function cargarTablaProgramacionEmpleadoEliminarTurno($datos) {
        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $verEmpleadoCaducaSuContrato = $o_LRrhh->cargarTablaProgramacionEmpleadoEliminarTurno($datos);

        $arrayCabecera = array(0 => "Cod Pre Pro", 1 => "bEstado", 2 => "Cod Turno", 3 => "Nomenclatura", 4 => "Cant. Turno ", 5 => "Horas por Turno", 6 => "Turnos", 7 => "Total", 8 => "Eliminar");
        $arrayTamano = array(0 => "*", 1 => "*", 2 => "*", 3 => "*", 4 => "*", 5 => "*", 6 => "*", 7 => "*", 8 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "true", 3 => "false", 4 => "false", 5 => "false", 6 => "false", 7 => "false", 8 => "false");
        $arrayAling = array(0 => "center", 1 => "center", 2 => "center", 3 => "center", 4 => "center", 5 => "center", 6 => "center", 7 => "center", 8 => "center");
        //return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor,$arrayHidden,$arrayAlineacion);
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $verEmpleadoCaducaSuContrato, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function cargarTablaTurnosPreProgramacion($datos) {
        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $verEmpleadoCaducaSuContrato = $o_LRrhh->cargarTablaTurnosPreProgramacion($datos);

        $arrayCabecera = array(0 => "Cod Pre Pro", 1 => "bEstado", 2 => "Cod Turno", 3 => "Nomenclatura", 4 => "Cant. Turno ", 5 => "Horas por Turno", 6 => "Turnos", 7 => "Total");
        $arrayTamano = array(0 => "*", 1 => "*", 2 => "*", 3 => "*", 4 => "*", 5 => "*", 6 => "*", 7 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "true", 3 => "false", 4 => "false", 5 => "false", 6 => "false", 7 => "false");
        $arrayAling = array(0 => "center", 1 => "center", 2 => "center", 3 => "center", 4 => "center", 5 => "center", 6 => "center", 7 => "center");
        //return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor,$arrayHidden,$arrayAlineacion);
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $verEmpleadoCaducaSuContrato, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function AprogramacionSeleccionadaTurno($datos) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->LprogramacionSeleccionadaTurno($datos);
        return $resultado;
    }

    public function btnEliminarProgramacoinPreProgramacionSelecionado($datos) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->btnEliminarProgramacoinPreProgramacionSelecionado($datos);
        return $resultado;
    }

    public function datosAreasDeEmpleado($datos) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->datosAreasDeEmpleado($datos);
        return $resultado;
    }

//-----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------- 
    public function registroHorariosEmpleadosTotal($datos) {
        $oLRrhh = new LRrhh();

        $iCodEmpCoordinador = $datos["iCodigoEmpeladoCoordinador"];

        $arrayNombreCoordinador = $oLRrhh->nombreCoordinador($iCodEmpCoordinador);
        $arrayFechaSistemaActual = $oLRrhh->LfechaSistema();
        $resultadoTurnos = $oLRrhh->HorariosTurnos($iCodEmpCoordinador);
        $resulModalidadContrato = $oLRrhh->DmodalidadContrato();
        require_once '../../cvista/rrhh/registro_horarios_personal.php';
    }

    public function AeliminarTurnoPersona($datos) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->DeliminarTurnoPersona($datos);
        return $resultado;
    }

    // lobo
    public function AreportePerActElimInsert($datos) {
        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $resultado = $o_LRrhh->LreportePerActElimInsert($datos);

        $arrayCabecera = array(0 => "Cod Persona", 1 => "Nombre", 2 => "Estado", 3 => "Estado");
        $arrayTamano = array(0 => "*", 1 => "*", 2 => "*", 3 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false");
        $arrayAling = array(0 => "center", 1 => "center", 2 => "center", 3 => "center");
        //return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor,$arrayHidden,$arrayAlineacion);
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $resultado, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function AbuscarEmpleadosAreasNombre($datos) {
        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LRrhh->LbuscarEmpleadosAreasNombre($datos);
        // print_r($arrayFilas);
        $arrayCabecera = array(0 => "código", 1 => "Codigo", 2 => "Nombre", 3 => "Area", 4 => "Sede", 5 => "Puesto", 6 => "Tipo Contrato", 7 => "Est. Puesto");
        $arrayTamano = array(0 => "100", 1 => "100", 2 => "250", 3 => "100", 4 => "*", 5 => "*", 6 => "*", 7 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false", 6 => "false", 7 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "center", 4 => "left", 5 => "left", 6 => "left", 7 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function AbuscaEmpleadoHorario($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre, $dFechaInicio, $dFechaFin) {
        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LRrhh->LbuscaEmpleadoHorario($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre, $dFechaInicio, $dFechaFin);
        // print_r($arrayFilas);
        $arrayCabecera = array(0 => "código", 1 => "Codigo", 2 => "Nombre", 3 => "Est. Emp", 4 => "idTipoModalidadContrato", 5 => "...");
        $arrayTamano = array(0 => "60", 1 => "60", 2 => "290", 3 => "90", 4 => "40", 5 => "40");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "pointer");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "true", 5 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "center", 3 => "left", 4 => "left", 5 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function AbuscarEmpleadoHorarioSusAreas($datos) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->LbuscarEmpleadoHorarioSusAreas($datos);
//        $cadena = '<table > <thead>' .
//                '<tr  bgcolor="#A2DF71"><th  style="width: 120px">Sede</th> <th style="width: 150px">Area</th>'
//                . ' <th style="width: 400px">Nombre Ap.</th> <th style="width: 180px">Puesto</th><th style="width: 180px">Tipo Contrato</th>'
//                . '</thead><tbody>';
        $cadena = '<div id="table_wrapper" style="background:tomato;border:1px solid olive;float:left;" >
              <div id="header">
               <div id="head1">Sede</div>
              <div id="head2">Area</div>
              <div id="head3">Nombre Completo</div>
              <div id="head4">Puesto</div>
              <div id="head5">Tipo Contrato</div>
              </div>
             <div id="tbody" style="height:80px;overflow-y:auto;width:1000px;background:yellow;">';
        $cadena .= '<table id="tablePuesto">';
        foreach ($resultado as $n => $valuen) {
            $cadena .= '<tr align="center" bgcolor="#F7F7DD"><td class="td1"><b>' . $valuen[0] . '</b></td><td class="td2"><b>' . $valuen[1]
                    . '</b></td><td class="td3"><b>' . $datos["vNombreCompleto"] . '</b></td><td class="td4"><b>' . $valuen[2] . '</b></td><td class="td5"><b>'
                    . $valuen[3] . '</b></td></tr> ';
        }
        $cadena .='</table>';
        $cadena .='</div></div>';
        return $cadena;
    }

    /*     * ************************************************************* */
    /*     * ************************************************************* */

    public function AregularizacionAsistenciaPorCambioPersonal($datos) {
        $o_LRrhh = new LRrhh();
//        $arrayFilas = $o_LRrhh->LregularizacionAsistenciaPorCambioPersonal($datos);
        require_once '../../cvista/rrhh/listaDeposibleReemplazosdeInasistencias.php';
    }

    public function AcargarTabladePersonaReemplazo($datos) {
        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LRrhh->LcargarTabladePersonaReemplazo($datos);
        // print_r($arrayFilas);
        $arrayCabecera = array(0 => "iIdTurnosAreaSede", 1 => "iIdCodigoempleado", 2 => "Nombre Completo", 3 => "c_cod_per", 4 => "iidPuestoEmpleado");
        $arrayTamano = array(0 => "100", 1 => "100", 2 => "400", 3 => "100", 4 => "100");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function AguardarEmpleadoReemplazador($datos) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->LguardarEmpleadoReemplazador($datos);
        return $resultado;
    }

    public function AhoraExtrasTrabajadas($datos) {
        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LRrhh->LhoraExtrasTrabajadas($datos);
        // print_r($arrayFilas);
        $arrayCabecera = array(0 => "iCodigoEmpleado", 1 => "c_cod_per", 2 => "Nombre Completo", 3 => "iIdTipoProgramacion", 4 => "iidPuestoEmpleado", 5 => "Fecha", 6 => "Hora Entrada", 7 => "Hora Salida");
        $arrayTamano = array(0 => "40", 1 => "40", 2 => "400", 3 => "40", 4 => "40", 5 => "100", 6 => "100", 7 => "100");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false", 6 => "false", 7 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "center", 5 => "center", 6 => "center", 7 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function abrirPopapAsignacionDeTurnosAsignados($datos) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->LabrirPopapAsignacionDeTurnosAsignados($datos);
        $resSede = $o_LRrhh->LsedesHospital();
        $resultadoMotivoReProgramacion = $o_LRrhh->LMotivoReProgramacion();
        $datos2["cboSucursal"] = $resultado[0][2];
        $datos2["codigoPersona"] = $datos["codigoPersona"];
        $datos2["iidPuestoEmpleado"] = $datos["iidPuestoEmpleado"];
        $iIdSedeEmpresaArea = $resultado[0][1];
        $rsAreaSede = $o_LRrhh->LdescripcionCboSedeArea($datos2);
        $rsAreaSedeTurnos = $o_LRrhh->LdescripcionCboSedeAreaTurno($iIdSedeEmpresaArea);

        require_once '../../cvista/rrhh/popapEmpleadoReemplazador.php';
//        return $resultado;
    }

    public function AdescripcionCboSedeArea($datos) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->LdescripcionCboSedeArea($datos);
        $cadena = '<select name="cboAreaNuevo" id="cboAreaNuevo" onchange="cboSedeAreasTurnos()">';
        $cadena .= ' <option value="0">Seleccionar</option>';
        foreach ($resultado as $key => $value) {
            $cadena .= '<option value="' . $value[1] . '">' . utf8_decode($value[0]) . '</option>';
        }
        $cadena .= ' </select>';
        return $cadena;
    }

    /*     * *******************Busqueda de Medicos*********************** */
    /*     * ************************************************************* */

    public function RegistrarMedico() {
        require_once '../../cvista/rrhh/registro_Medico.php';
    }

    public function AbuscarMedico($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre) {
        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LRrhh->LbuscarMedico($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre);
        // print_r($arrayFilas);
        $arrayCabecera = array(0 => "cod Emple", 1 => "Cod per", 2 => "Nombre", 3 => "Est. Emp");
        $arrayTamano = array(0 => "100", 1 => "100", 2 => "*", 3 => "100");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "Center", 3 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    /*     * ************************************************************* */
    /*     * ************************************************************* */

    public function AguardarNuevaProgramacionReemplanzo($datos) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->LguardarNuevaProgramacionReemplanzo($datos);
        return $resultado[0][0];
    }

    public function AbuscarMedicosCentroCostosHorarios($datos) {
        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LRrhh->LbuscarMedicosCentroCostosHorarios($datos);
        // print_r($arrayFilas);
        if ($arrayFilas) {
            $arrayCabecera = array(0 => "iCodigoEmpleado", 1 => "c_cod_per", 2 => "Nombre", 3 => "Centro Costo", 4 => "Puesto", 5 => "iidPuesto", 6 => "iidcentroCosto");
            $arrayTamano = array(0 => "30", 1 => "60", 2 => "280", 3 => "205", 4 => "80", 5 => "120", 6 => "120");
            $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro");
            $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default");
            $arrayHidden = array(0 => "true", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "true", 6 => "true");
            $arrayAling = array(0 => "left", 1 => "left", 2 => "Center", 3 => "left", 4 => "left", 5 => "left", 6 => "left");
            return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
        }
    }

    public function AgregarPersonalTurnoRegularizar($datos) {
        $o_LRrhh = new LRrhh();
        $resultadoSedes = $o_LRrhh->LBuscarLasSedes($datos);
        $resultadoMotivoReProgramacion = $o_LRrhh->LMotivoReProgramacion();
        $datos1["cboSucursal"] = $resultadoSedes[0][0];
        $datos1["codigoPersona"] = $datos["idCodigoPersona"];

        $resultadoAreas = $o_LRrhh->LdescripcionCboSedeArea1($datos1);

//       $datos5["iIdSedeEmpresaArea"]=$resultadoAreas[0][0];
        $resultadoTurnos = $o_LRrhh->LdescripcionCboSedeAreaTurno($resultadoAreas[0][1]);
        require_once '../../cvista/rrhh/regularizarHorarioNuevaProgramacion.php';
    }

    public function AcboSedeAreaNuevo($datos) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->LdescripcionCboSedeArea($datos);
        $cadena = '<select name="cboAreaNuevo" id="cboAreaNuevo" onchange="cboSedeAreasTurnosNuevo()">';
//        $cadena .= ' <option value="0">Seleccionar</option>';
        foreach ($resultado as $key => $value) {
            $cadena .= '<option value="' . $value[1] . '">' . utf8_decode($value[0]) . '</option>';
        }
        $cadena .= ' </select>';
        return $cadena;
    }

    public function AcargaPuestoEmpleadoArea($datos) {
        $o_LRrhh = new LRrhh();
        $resultadoPuesto = $o_LRrhh->LBuscarPuestoEmpleado($datos);
        $cadena = '<select name="cboPuestoEmpleadoArea" id="cboPuestoEmpleadoArea" onchange="cboTipoProgramacion()" >';
        $cadena .= ' <option value="0">Seleccionar</option>';
        foreach ($resultadoPuesto as $key => $value) {
            $cadena .= '<option value="' . $value[0] . '">' . utf8_decode($value[1]) . '</option>';
        }
        $cadena .= ' </select>';
        return $cadena;
    }

    public function AcboTipoProgramacion($datos) {
        $o_LRrhh = new LRrhh();
        $resultadoTipoProgramacion = $o_LRrhh->LcboTipoProgramacion($datos);
        $cadena = '<select name="cboTipoProgramacion" id="cboTipoProgramacion" >';
//        $cadena .= ' <option value="0">Seleccionar</option>';
        foreach ($resultadoTipoProgramacion as $key => $value) {
            $cadena .= '<option value="' . $value[0] . '">' . utf8_decode($value[1]) . '</option>';
        }
        $cadena .= ' </select>';
        return $cadena;
    }

    public function ASedeAreasTurnos($datos) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->LdescripcionCboSedeAreaTurno($datos["iIdSedeEmpresaArea"]);

        $cadena = '<select name="cboidSedeEmpresaAreaTurno" id="cboidSedeEmpresaAreaTurno">';
        foreach ($resultado as $key => $value) {
            $cadena .= '<option value="' . $value[0] . '">' . utf8_decode($value[1]) . '</option>';
        }
        $cadena .='</tbody></table>';
        $cadena .= ' </select>';
        return $cadena;
    }

    public function aBuscarAreasRegularizar() {
        $o_LRrhh = new LRrhh();
        $comboSucursal = $o_LRrhh->listaSucursal('0110073', '');
        require_once("../../cvista/rrhh/vistarBuscarAraRegularizar.php");
    }

    public function actualizarLaSede($datos) {
        $o_LRrhh = new LRrhh();
        $resultadoSedes = $o_LRrhh->LBuscarLasSedes($datos);

        $cadena = '<select name="cboidSedeEmpresa" id="cboidSedeEmpresa" onchange="cboSedeAreaNuevo()" >';
        foreach ($resultadoSedes as $key => $value) {
            if ($datos["cSede"] == $value[0]) {
                $cadena .= '<option selected  value="' . $value[0] . '">' . utf8_decode($value[1]) . '</option>';
            } else {
                $cadena .= '<option value="' . $value[0] . '">' . utf8_decode($value[1]) . '</option>';
            }
        }
        $cadena .= ' </select>';
        return $cadena;
    }

    public function actualizarSedeAreaNuevo($datos) {
        $o_LRrhh = new LRrhh();

        $resAreaSeleccionada = $o_LRrhh->LSedeAreaSeleccionada($datos);
        $resultado = $o_LRrhh->LdescripcionCboSedeArea($datos);
        $cadena = '<select name="cboAreaNuevo" id="cboAreaNuevo" onchange="cboSedeAreasTurnosNuevo()">';
//        $cadena .= ' <option value="0">Seleccionar</option>';
        foreach ($resultado as $key => $value) {
            if ($resAreaSeleccionada[0][0] == $value[1]) {
                $cadena .= '<option selected value="' . $value[1] . '">' . utf8_decode($value[0]) . '</option>';
            } else {
                $cadena .= '<option value="' . $value[1] . '">' . utf8_decode($value[0]) . '</option>';
            }
        }
        $cadena .= ' </select>';
        return $cadena;
    }

    public function AmantenimientoTurnoCordiNuevo($datos) {
        $oLRrhh = new LRrhh();
        require_once("../../cvista/rrhh/agregarTurnoAreaNuevo.php");
    }

    public function AguardarPersonalTurnoRegularizar($datos) {
        $o_LRrhh = new LRrhh();
        $resultadoSedes = $o_LRrhh->LguardarPersonalTurnoRegularizar($datos);
        return $resultadoSedes[0][0];
    }

    public function aBuscarAreasRegularizarPersona() {
        $o_LRrhh = new LRrhh();
        $comboSucursal = $o_LRrhh->listaSucursal('0110073', '');
        require_once("../../cvista/rrhh/vistaBuscarAreaRegularizarPersona.php");
    }

    public function actualizarLaSedeEmpleado($datos) {
        $o_LRrhh = new LRrhh();
        $resultadoSedes = $o_LRrhh->LBuscarLasSedes($datos);

        $cadena = '<select name="cboSede" id="cboSede" onchange="descripcionCboSedeArea()" >';
        foreach ($resultadoSedes as $key => $value) {
            if ($datos["cSede"] == $value[0]) {
                $cadena .= '<option selected  value="' . $value[0] . '">' . utf8_decode($value[1]) . '</option>';
            } else {
                $cadena .= '<option value="' . $value[0] . '">' . utf8_decode($value[1]) . '</option>';
            }
        }
        $cadena .= ' </select>';
        return $cadena;
    }

    public function actualizarSedeAreaNuevo1($datos) {
        $o_LRrhh = new LRrhh();

        $resAreaSeleccionada = $o_LRrhh->LSedeAreaSeleccionada($datos);
        $resultado = $o_LRrhh->LdescripcionCboSedeArea($datos);
        $cadena = '<select name="cboAreaNuevo" id="cboAreaNuevo" onchange="cboSedeAreasTurnos()">';
//        $cadena .= ' <option value="0">Seleccionar</option>';
        foreach ($resultado as $key => $value) {
            if ($resAreaSeleccionada[0][0] == $value[1]) {
                $cadena .= '<option selected value="' . $value[1] . '">' . utf8_decode($value[0]) . '</option>';
            } else {
                $cadena .= '<option value="' . $value[1] . '">' . utf8_decode($value[0]) . '</option>';
            }
        }
        $cadena .= ' </select>';
        return $cadena;
    }

    public function ASedeAreasTurnos1($datos) {
        $o_LRrhh = new LRrhh();
        $resultado = $o_LRrhh->LdescripcionCboSedeAreaTurno($datos["iIdSedeEmpresaArea"]);

        $cadena = '<select name="cboAreaTurno" id="cboAreaTurno">';
        foreach ($resultado as $key => $value) {
            $cadena .= '<option value="' . $value[0] . '">' . utf8_decode($value[1]) . '</option>';
        }
        $cadena .= ' </select>';
        return $cadena;
    }

    public function AmantenimientoTurnoCordiPersona($datos) {
        $oLRrhh = new LRrhh();
        require_once("../../cvista/rrhh/agregarTurnoAreaPersona.php");
    }

    public function AreporteAsistenciaMedico($datos) {
        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LRrhh->LreporteAsistenciaMedico($datos);
        $arrayCabecera = array(0 => "cornogramaMedico", 1 => "iCodigoEmpelado", 2 => "TipoContrato", 11 => "Centro Costo", 3 => "Nombre Doctor", 4 => "Fecha", 5 => "Entrada Prog.", 6 => "Salida Prog.", 7 => "Entrada Real", 8 => "Salida Real", 9 => "Tarde Entrada", 10 => "Tarde Salida");
        $arrayTamano = array(0 => "0", 1 => "0", 2 => "100", 11 => "90", 3 => "250", 4 => "100", 5 => "80", 6 => "90", 7 => "80", 8 => "80", 9 => "60", 10 => "60");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 11 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro", 9 => "ro", 10 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 11 => "Centro Costo", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default", 10 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 11 => "false", 3 => "false", 4 => "false", 5 => "false", 6 => "false", 7 => "false", 8 => "false", 9 => "false", 10 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 11 => "Center", 3 => "left", 4 => "center", 5 => "center", 6 => "center", 7 => "center", 8 => "center", 9 => "center", 10 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function AcargarPuestoEmpleado($datos) {
        $o_LRrhh = new LRrhh();
        $resultadoPuesto = $o_LRrhh->LBuscarPuesto($datos);

        $cadena = '<select name="cbonsmPuestoEmpelado" id="cbonsmPuestoEmpelado" onchange="funcionPuestoEmpleadoBoton()">';
        $cadena .= ' <option value="0">Seleccionar</option>';
        foreach ($resultadoPuesto as $key => $value) {
            $cadena .= '<option value="' . $value[0] . '">' . utf8_decode($value[1]) . '</option>';
        }
        $cadena .= ' </select>';
        return $cadena;
    }

    public function AfuncionPuestoEmpleadoBoton($datos) {
        $o_LRrhh = new LRrhh();
        $resultadoSedes = $o_LRrhh->LBuscarLasSedes($datos);
        ;

        $cadena = '<select name="cboidSedeEmpresa" id="cboidSedeEmpresa" onchange="cboSedeAreaNuevo()">';
        $cadena .= ' <option value="0">Seleccionar</option>';
        foreach ($resultadoSedes as $key => $value) {
            $cadena .= '<option value="' . $value[0] . '">' . utf8_decode($value[1]) . '</option>';
        }
        $cadena .= ' </select>';
        return $cadena;
    }

    public function AvalidarQueNoExitaProgramacion($datos) {
        $oLRrhh = new LRrhh();
        $respuesta = $oLRrhh->LvalidarQueNoExitaProgramacion($datos);
        $filas = count($respuesta);
        if ($filas == 0) {
            return $filas;
        } else {
            return $filas;
        }
    }

    public function AtablaCrucedeHorarioParaTipoDescanso($datos) {
        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LRrhh->LTablevalidarQueNoExitaProgramacion($datos);
        $arrayCabecera = array(0 => "idProgramacionPersona", 1 => "SEDE", 2 => "AREA", 3 => "FECHA", 4 => "TURNO", 5 => "Eliminar");
        $arrayTamano = array(0 => "5", 1 => "120", 2 => "120", 3 => "90", 4 => "95", 5 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "pointer");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "center", 5 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function AeliminarProgramacion($datos) {
        $oLRrhh = new LRrhh();
        $respuesta = $oLRrhh->LeliminarProgramacion($datos);
        return $respuesta;
    }

}

?>
