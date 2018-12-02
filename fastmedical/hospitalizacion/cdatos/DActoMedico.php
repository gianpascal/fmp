<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("../../../pholivo/adophp/Adophp.class.php");
include_once("../../../pholivo/Conexion.php");

class DActoMedico extends Adophp {

    public function __construct($cnx = Array(), $_eCita = '') {
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

    public function getArrayProgramacionMedico($datos) {
        parent::ConnectionOpen("pnsActoMedico", "dbweb");
        parent::SetParameterSP("accion", "1");
        parent::SetParameterSP("codigoPersona", $datos["codigoPersona"]);
        parent::SetParameterSP("mesprogramacion", $datos["mesprogramacion"]);
        parent::SetParameterSP("anioprogramacion", $datos["anioprogramacion"]);
        parent::SetParameterSP("codigocronograma", "");
        parent::SetParameterSP("codigoprogramacion", "");
        parent::SetParameterSP("cantidadadicionales", "");
        parent::SetParameterSP("codigoambientefisico", "");
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", strtoupper($_SESSION['host']));
        parent::SetParameterSP("vNombreCPT", "");
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function getArrayPacientesProgramados($datos) {
//parent::BeginValues();
        parent::Liberar_Parametros();
        parent::ConnectionOpen("pnsActoMedico", "dbweb");
//parent::BeginValues();
        parent::SetParameterSP("accion", "2");
        parent::SetParameterSP("codigoPersona", "");
        parent::SetParameterSP("mesprogramacion", "");
        parent::SetParameterSP("anioprogramacion", "");
        parent::SetParameterSP("codigocronograma", $datos["codigocronograma"]);
        parent::SetParameterSP("codigoprogramacion", "");
        parent::SetParameterSP("cantidadadicionales", "");
        parent::SetParameterSP("codigoambientefisico", "");
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", strtoupper($_SESSION['host']));
        parent::SetParameterSP("vNombreCPT", "");
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function getArrayPacientesAdicionales($datos) {
        parent::Liberar_Parametros();
        parent::ConnectionOpen("pnsActoMedico", "dbweb");
        parent::SetParameterSP("accion", "3");
        parent::SetParameterSP("codigoPersona", "");
        parent::SetParameterSP("mesprogramacion", "");
        parent::SetParameterSP("anioprogramacion", "");
        parent::SetParameterSP("codigocronograma", $datos["codigocronograma"]);
        parent::SetParameterSP("codigoprogramacion", "");
        parent::SetParameterSP("cantidadadicionales", "");
        parent::SetParameterSP("codigoambientefisico", "");
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", strtoupper($_SESSION['host']));
        parent::SetParameterSP("vNombreCPT", "");
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function getArraydatosPersonalesActoMedico($datos) {
        parent::ConnectionOpen("pnsActoMedico", "dbweb");
        parent::SetParameterSP("accion", "4");
        parent::SetParameterSP("codigoPersona", $datos["codigopersona"]);
        parent::SetParameterSP("mesprogramacion", "");
        parent::SetParameterSP("anioprogramacion", "");
        parent::SetParameterSP("codigocronograma", $datos["codigocronograma"]);
        parent::SetParameterSP("codigoprogramacion", "");
        parent::SetParameterSP("cantidadadicionales", "");
        parent::SetParameterSP("codigoambientefisico", "");
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", strtoupper($_SESSION['host']));
        parent::SetParameterSP("vNombreCPT", "");
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function getArraycontadoresMensualesActoMedico($datos) {
        parent::ConnectionOpen("pnsActoMedico", "dbweb");
        parent::SetParameterSP("accion", "8");
        parent::SetParameterSP("codigoPersona", ""); //parent::SetParameterSP("codigoPersona",$datos["codigoMedico"]);//Ya no es necesario
        parent::SetParameterSP("mesprogramacion", $datos["mesprogramacion"]);
        parent::SetParameterSP("anioprogramacion", $datos["anioprogramacion"]);
        parent::SetParameterSP("codigocronograma", $datos["codigocronograma"]); //parent::SetParameterSP("codigocronograma","");//Si es necesario
        parent::SetParameterSP("codigoprogramacion", "");
        parent::SetParameterSP("cantidadadicionales", "");
        parent::SetParameterSP("codigoambientefisico", "");
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", strtoupper($_SESSION['host']));
        parent::SetParameterSP("vNombreCPT", "");
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function getArraycontadoresCantidadAtencionDiaria($datos) {
        parent::ConnectionOpen("pnsActoMedico", "dbweb");
        parent::SetParameterSP("accion", "5");
        parent::SetParameterSP("codigoPersona", "");
        parent::SetParameterSP("mesprogramacion", "");
        parent::SetParameterSP("anioprogramacion", "");
        parent::SetParameterSP("codigocronograma", $datos["codigocronograma"]);
        parent::SetParameterSP("codigoprogramacion", "");
        parent::SetParameterSP("cantidadadicionales", "");
        parent::SetParameterSP("codigoambientefisico", "");
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", strtoupper($_SESSION['host']));
        parent::SetParameterSP("vNombreCPT", "");
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function getArraydatosdellamadadelPaciente($datos) {
        parent::ConnectionOpen("pnsActoMedico", "dbweb");
        parent::SetParameterSP("accion", "6");
        parent::SetParameterSP("codigoPersona", "");
        parent::SetParameterSP("mesprogramacion", "");
        parent::SetParameterSP("anioprogramacion", "");
        parent::SetParameterSP("codigocronograma", "");
        parent::SetParameterSP("codigoprogramacion", $datos["codigoprogramacion"]);
        parent::SetParameterSP("cantidadadicionales", "");
        parent::SetParameterSP("codigoambientefisico", $datos["codigoambientefisico"]);
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", strtoupper($_SESSION['host']));
        parent::SetParameterSP("vNombreCPT", "");
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function getArrayFechaNacimiento($datos) {
        //var_dump($datos);exit();
        parent::ConnectionOpen("pnsFNacimiento", "dbweb");
        parent::SetParameterSP("accion", "1");
        parent::SetParameterSP("codigoPaciente",$datos["codigoPaciente"]);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function getArrayMesesNacimiento($datos) {
        parent::ConnectionOpen("EdadMeses", "dbweb","F");
        //parent::SetParameterSP("accion", "1");
        parent::SetParameterSP("fecha",$datos["fecha"]);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function getCodigoServicio($datos) {
        //var_dump($datos);exit();
        parent::ConnectionOpen("pnsFNacimiento", "dbweb");
        parent::SetParameterSP("accion", "2");
        parent::SetParameterSP("codigoPaciente",$datos["codigoPaciente"]);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function getCodigoProgramacion($datos) {
        //var_dump($datos);exit();
        parent::ConnectionOpen("pnsFNacimiento", "dbweb");
        parent::SetParameterSP("accion", "3");
        parent::SetParameterSP("codigoPaciente",$datos["codigoPaciente"]);
        $resultado = parent::executeSPArrayX();
        //var_dump($resultado);exit();
        parent::ConnectionClose();
        return $resultado;
    }

    function getCodigoPersona($datos) {
        //var_dump($datos);exit();
        parent::ConnectionOpen("pnsFNacimiento", "dbweb");
        parent::SetParameterSP("accion", "4");
        parent::SetParameterSP("codigoPaciente",$datos);
        $resultado = parent::executeSPArrayX();
        //var_dump($resultado);exit();
        parent::ConnectionClose();
        return $resultado;
    }

    function getCodigoCronogramaServicio($datos) {
        //var_dump($datos);exit();
        parent::ConnectionOpen("pnsFNacimiento", "dbweb");
        parent::SetParameterSP("accion", "5");
        parent::SetParameterSP("codigoPaciente",$datos);
        $resultado = parent::executeSPArrayX();
        //var_dump($resultado);exit();
        parent::ConnectionClose();
        return $resultado;
    }

    function actualizaradicionalesActoMedico($datos) {
        parent::ConnectionOpen("pnsActoMedico", "dbweb");
        parent::SetParameterSP("accion", "7");
        parent::SetParameterSP("codigoPersona", "");
        parent::SetParameterSP("mesprogramacion", "");
        parent::SetParameterSP("anioprogramacion", "");
        parent::SetParameterSP("codigocronograma", $datos["codigocronograma"]);
        parent::SetParameterSP("codigoprogramacion", "");
        parent::SetParameterSP("cantidadadicionales", $datos["cantidadadicionales"]);
        parent::SetParameterSP("codigoambientefisico", "");
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", strtoupper($_SESSION['host']));
        parent::SetParameterSP("vNombreCPT", "");
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    /*     * ********************** Examenes Fisicos ******************************* */

    function asignarPadreFisico($idversion) {
        parent::ConnectionOpen("pnsMantenimientoExamenesFisicos", "dbweb");
        parent::SetParameterSP("$1", '1');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", $idversion);
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", '');
        parent::SetParameterSP("$12", '');
        parent::SetParameterSP("$13", '');
        parent::SetParameterSP("$14", '');

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function act_regExamenFisico($datos) {
        parent::ConnectionOpen("pnsMantenimientoExamenesFisicos", "dbweb");
        parent::SetParameterSP("$1", '2');
        parent::SetParameterSP("idExamen", $datos["p1"]);
        parent::SetParameterSP("codPadre", $datos["p2"]);
        parent::SetParameterSP("jerarquia", $datos["p3"]);
        parent::SetParameterSP("titulo", $datos["p4"]);
        parent::SetParameterSP("estado", $datos["p5"]);
        parent::SetParameterSP("orden", $datos["p6"]);
        parent::SetParameterSP("nivel", $datos["p7"]);
        parent::SetParameterSP("idversion", $datos["p8"]);
        parent::SetParameterSP("hacer", $datos["p9"]);
        parent::SetParameterSP("11", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("12", $_SESSION['host']);
        parent::SetParameterSP("$13", '');
        parent::SetParameterSP("$14", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function capturaPadreEF($datos) {
        parent::ConnectionOpen("pnsMantenimientoExamenesFisicos", "dbweb");
        parent::SetParameterSP("$1", '3');
        parent::SetParameterSP("$2", $datos["idExamen"]);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", $datos["idVersion"]);
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", '');
        parent::SetParameterSP("$12", '');
        parent::SetParameterSP("$13", '');
        parent::SetParameterSP("$14", '');

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function editaExamenFisico($codigo) {
        parent::ConnectionOpen("pnsMantenimientoExamenesFisicos", "dbweb");
        parent::SetParameterSP("$1", '4');
        parent::SetParameterSP("$2", $codigo);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", '');
        parent::SetParameterSP("$12", '');
        parent::SetParameterSP("$13", '');
        parent::SetParameterSP("$14", '');

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function eliminaExamenFisico($datos) {
        parent::ConnectionOpen("pnsMantenimientoExamenesFisicos", "dbweb");
        parent::SetParameterSP("$1", '5');
        parent::SetParameterSP("$2", $datos["idexamen"]);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", $datos["idversion"]);
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", '');
        parent::SetParameterSP("$12", '');
        parent::SetParameterSP("$13", '');
        parent::SetParameterSP("$14", '');

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    /* function examenNoAsignado(){
      parent::ConnectionOpen("pnsMantenimientoExamenesFisicos","dbweb");
      parent::SetParameterSP("$1", '5');
      parent::SetParameterSP("$2", '');
      parent::SetParameterSP("$3", '');
      parent::SetParameterSP("$4", '');
      parent::SetParameterSP("$5", '');
      parent::SetParameterSP("$6", '');
      parent::SetParameterSP("$7", '');
      parent::SetParameterSP("$8", '');
      parent::SetParameterSP("$9", '');
      parent::SetParameterSP("$10", '');
      parent::SetParameterSP("$11", '');
      parent::SetParameterSP("$12", '');
      parent::SetParameterSP("$13", '');

      $resultadoArray = parent::executeSPArrayX();
      parent::ConnectionClose();
      return $resultadoArray;
      } */

    function asignarExamenPrueba($datos) {
        parent::ConnectionOpen("pnsMantenimientoExamenesFisicos", "dbweb");
        parent::SetParameterSP("$1", '6');
        parent::SetParameterSP("$2", $datos["idexamen"]);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", $datos["idversion"]);
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("$12", strtoupper($_SESSION['host']));
        parent::SetParameterSP("$13", $datos["idprueba"]);
        parent::SetParameterSP("$14", '');

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function selectExamenPrueba($idExamen) {
        parent::ConnectionOpen("pnsMantenimientoExamenesFisicos", "dbweb");
        parent::SetParameterSP("$1", '7');
        parent::SetParameterSP("$2", $idExamen);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", '');
        parent::SetParameterSP("$12", '');
        parent::SetParameterSP("$13", '');
        parent::SetParameterSP("$14", '');

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function act_desExamen($idPrueba, $hacer) {
        parent::ConnectionOpen("pnsMantenimientoExamenesFisicos", "dbweb");
        parent::SetParameterSP("$1", '8');
        parent::SetParameterSP("$2", $idPrueba);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", $hacer);
        parent::SetParameterSP("$11", '');
        parent::SetParameterSP("$12", '');
        parent::SetParameterSP("$13", '');
        parent::SetParameterSP("$14", '');

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function asignarExamenServicio($datos) {
        parent::ConnectionOpen("pnsMantenimientoExamenesFisicos", "dbweb");
        parent::SetParameterSP("$1", '9');
        parent::SetParameterSP("$2", $datos["idexamen"]);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", $datos["idversion"]);
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("$12", strtoupper($_SESSION['host']));
        parent::SetParameterSP("$13", '');
        parent::SetParameterSP("$14", $datos["idservicio"]);

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function selectExamenServicio($idExamen) {
        parent::ConnectionOpen("pnsMantenimientoExamenesFisicos", "dbweb");
        parent::SetParameterSP("$1", '10');
        parent::SetParameterSP("$2", $idExamen);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", '');
        parent::SetParameterSP("$12", '');
        parent::SetParameterSP("$13", '');
        parent::SetParameterSP("$14", '');

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function act_desExamenPrueba($idExamenPrueba, $estado) {
        parent::ConnectionOpen("pnsMantenimientoExamenesFisicos", "dbweb");
        parent::SetParameterSP("$1", '11');
        parent::SetParameterSP("$2", $idExamenPrueba);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", $estado);
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", '');
        parent::SetParameterSP("$12", '');
        parent::SetParameterSP("$13", '');
        parent::SetParameterSP("$14", '');

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function act_desExamenServicio($idExamenServicio, $estado) {
        parent::ConnectionOpen("pnsMantenimientoExamenesFisicos", "dbweb");
        parent::SetParameterSP("$1", '12');
        parent::SetParameterSP("$2", $idExamenServicio);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", $estado);
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", '');
        parent::SetParameterSP("$12", '');
        parent::SetParameterSP("$13", '');
        parent::SetParameterSP("$14", '');

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function grabarPrueba($datos) {
        parent::ConnectionOpen("pnsMantenimientoPruebas", "dbweb");
        parent::SetParameterSP("op", '1');
        parent::SetParameterSP("idPrueba", $datos["p1"]);
        parent::SetParameterSP("titulo", $datos["p2"]);
        parent::SetParameterSP("orden", $datos["p3"]);
        parent::SetParameterSP("estado", $datos["p4"]);
        parent::SetParameterSP("user", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("host", strtoupper($_SESSION['host']));
        parent::SetParameterSP("hacer", $datos["p5"]);
        parent::SetParameterSP("estadoetapa", "");

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dPreguardarAntecedenteOdontograma($datos) {
        parent::ConnectionOpen("pnsMantenimientoAntecedenteOdontograma", "dbweb");
        parent::SetParameterSP("var1", '1');
        parent::SetParameterSP("var2", $datos["idAntecedenteOdontograma"]);
        parent::SetParameterSP("var3", $datos["idDiagnosticodiente"]);
        parent::SetParameterSP("var4", $datos["estadoAntecedenteOdontograma"]);
        parent::SetParameterSP("var5", $datos["codigoProgramacion"]);
        parent::SetParameterSP("user", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("host", strtoupper($_SESSION['host']));
        parent::SetParameterSP("var6", $datos["iIdDiente1"]);
        parent::SetParameterSP("var7", $datos["iIdDiente2"]);
        parent::SetParameterSP("var8", $datos["Mesial"]);
        parent::SetParameterSP("var9", $datos["Incisal"]);
        parent::SetParameterSP("var10", $datos["Distal"]);
        parent::SetParameterSP("var11", $datos["Vestibular"]);
        parent::SetParameterSP("var12", $datos["Lingual"]);
        parent::SetParameterSP("var13", $datos["Palatina"]);
        parent::SetParameterSP("var14", $datos["obs"]);
        parent::SetParameterSP("var15", $datos["tercero"]);
        parent::SetParameterSP("var16", $datos["estado"]);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function listaPruebas($hacer, $idversion) {
        parent::ConnectionOpen("pnsMantenimientoPruebas", "dbweb");
        parent::SetParameterSP("op", '2');
        parent::SetParameterSP("idPrueba", '');
        parent::SetParameterSP("titulo", '');
        parent::SetParameterSP("orden", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", $hacer);
        parent::SetParameterSP("idversion", $idversion);

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function listaPruebasDisponibles($hacer, $idversion) {
        parent::ConnectionOpen("pnsMantenimientoPruebas", "dbweb");
        parent::SetParameterSP("op", '5');
        parent::SetParameterSP("idPrueba", '');
        parent::SetParameterSP("titulo", '');
        parent::SetParameterSP("orden", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", $hacer);
        parent::SetParameterSP("idversion", $idversion);

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function buscarPrueba($nomPrueba) {
        parent::ConnectionOpen("pnsMantenimientoPruebas", "dbweb");
        parent::SetParameterSP("op", '3');
        parent::SetParameterSP("idPrueba", '');
        parent::SetParameterSP("titulo", $nomPrueba);
        parent::SetParameterSP("orden", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        parent::SetParameterSP("estadoetapa", "");

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function act_desPrueba($idPrueba, $hacer) {
        parent::ConnectionOpen("pnsMantenimientoPruebas", "dbweb");
        parent::SetParameterSP("op", '4');
        parent::SetParameterSP("idPrueba", $idPrueba);
        parent::SetParameterSP("titulo", '');
        parent::SetParameterSP("orden", '');
        parent::SetParameterSP("estado", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", $hacer);
        parent::SetParameterSP("estadoetapa", "");

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    /*   function pruebasNoAsignadas(){
      parent::ConnectionOpen("pnsMantenimientoPruebas","dbweb");
      parent::SetParameterSP("op", '5');
      parent::SetParameterSP("idPrueba",'');
      parent::SetParameterSP("titulo", '');
      parent::SetParameterSP("orden", '');
      parent::SetParameterSP("estado", '');
      parent::SetParameterSP("user", '');
      parent::SetParameterSP("host", '');
      parent::SetParameterSP("hacer",'');

      $resultadoArray = parent::executeSPArrayX();
      parent::ConnectionClose();
      return $resultadoArray;
      } */

    function grabarCombo($idCombo, $nombre, $hacer) {
        parent::ConnectionOpen("pnsMantenimientoCombos", "dbweb");
        parent::SetParameterSP("op", '1');
        parent::SetParameterSP("idprueba", '');
        parent::SetParameterSP("idcampo", '');
        parent::SetParameterSP("idcombo", $idCombo);
        parent::SetParameterSP("idtipocampo", '');
        parent::SetParameterSP("nomcombo", $nombre);
        parent::SetParameterSP("nomcampo", '');
        parent::SetParameterSP("texto", '');
        parent::SetParameterSP("valor", '');
        parent::SetParameterSP("idvalorcombo", '');
        parent::SetParameterSP("ordencampo", '');
        parent::SetParameterSP("estadocampo", '');
        parent::SetParameterSP("bObligatorio", '');
        parent::SetParameterSP("user", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("host", strtoupper($_SESSION['host']));
        parent::SetParameterSP("hacer", $hacer);

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function grabarItemsCombo($codCombo, $idValcombo, $texto, $value, $hacer) {
        parent::ConnectionOpen("pnsMantenimientoCombos", "dbweb");
        parent::SetParameterSP("op", '2');
        parent::SetParameterSP("idprueba", '');
        parent::SetParameterSP("idcampo", '');
        parent::SetParameterSP("idcombo", $codCombo);
        parent::SetParameterSP("idtipocampo", '');
        parent::SetParameterSP("nomcombo", '');
        parent::SetParameterSP("nomcampo", '');
        parent::SetParameterSP("texto", $texto);
        parent::SetParameterSP("valor", $value);
        parent::SetParameterSP("idvalorcombo", $idValcombo);
        parent::SetParameterSP("ordencampo", '');
        parent::SetParameterSP("estadocampo", '');
        parent::SetParameterSP("bObligatorio", '');
        parent::SetParameterSP("user", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("host", strtoupper($_SESSION['host']));
        parent::SetParameterSP("hacer", $hacer);

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function cargarTipoCampo() {
        parent::ConnectionOpen("pnsMantenimientoCombos", "dbweb");
        parent::SetParameterSP("op", '3');
        parent::SetParameterSP("idprueba", '');
        parent::SetParameterSP("idcampo", '');
        parent::SetParameterSP("idcombo", '');
        parent::SetParameterSP("idtipocampo", '');
        parent::SetParameterSP("nomcombo", '');
        parent::SetParameterSP("nomcampo", '');
        parent::SetParameterSP("texto", '');
        parent::SetParameterSP("valor", '');
        parent::SetParameterSP("idvalorcombo", '');
        parent::SetParameterSP("ordencampo", '');
        parent::SetParameterSP("estadocampo", '');
        parent::SetParameterSP("bObligatorio", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function grabarCampo($idprueba, $idcampo, $idcombo, $idtipocampo, $nombrecampo, $orden, $estado, $obligatorio, $hacer) {

// echo "nombre:".$nombrecampo."-  Orden: ".$orden." - Estado: ".$estado."- Obligatorio: ".$obligatorio." - Hacer:".$hacer;

        parent::ConnectionOpen("pnsMantenimientoCombos", "dbweb");
        parent::SetParameterSP("op", '4');
        parent::SetParameterSP("idprueba", $idprueba);
        parent::SetParameterSP("idcampo", $idcampo);
        parent::SetParameterSP("idcombo", $idcombo);
        parent::SetParameterSP("idtipocampo", $idtipocampo);
        parent::SetParameterSP("nomcombo", '');
        parent::SetParameterSP("nomcampo", $nombrecampo); //
        parent::SetParameterSP("texto", '');
        parent::SetParameterSP("valor", '');
        parent::SetParameterSP("idvalorcombo", '');
        parent::SetParameterSP("ordencampo", $orden);
        parent::SetParameterSP("estadocampo", $estado);
        parent::SetParameterSP("bObligatorio", $obligatorio);
        parent::SetParameterSP("user", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("host", strtoupper($_SESSION['host']));
        parent::SetParameterSP("hacer", $hacer);

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function editaCampos($idprueba) {
        parent::ConnectionOpen("pnsMantenimientoCombos", "dbweb");
        parent::SetParameterSP("op", '5');
        parent::SetParameterSP("idprueba", $idprueba);
        parent::SetParameterSP("idcampo", '');
        parent::SetParameterSP("idcombo", '');
        parent::SetParameterSP("idtipocampo", '');
        parent::SetParameterSP("nomcombo", '');
        parent::SetParameterSP("nomcampo", '');
        parent::SetParameterSP("texto", '');
        parent::SetParameterSP("valor", '');
        parent::SetParameterSP("idvalorcombo", '');
        parent::SetParameterSP("ordencampo", '');
        parent::SetParameterSP("estadocampo", '');
        parent::SetParameterSP("bObligatorio", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function eliminarDbCampo($idCampo, $idCombo) {
        parent::ConnectionOpen("pnsMantenimientoCombos", "dbweb");
        parent::SetParameterSP("op", '6');
        parent::SetParameterSP("idprueba", '');
        parent::SetParameterSP("idcampo", $idCampo);
        parent::SetParameterSP("idcombo", $idCombo);
        parent::SetParameterSP("idtipocampo", '');
        parent::SetParameterSP("nomcombo", '');
        parent::SetParameterSP("nomcampo", '');
        parent::SetParameterSP("texto", '');
        parent::SetParameterSP("valor", '');
        parent::SetParameterSP("idvalorcombo", '');
        parent::SetParameterSP("ordencampo", '');
        parent::SetParameterSP("estadocampo", '');
        parent::SetParameterSP("bObligatorio", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function editarCombo($idCombo, $hacer) {
        parent::ConnectionOpen("pnsMantenimientoCombos", "dbweb");
        parent::SetParameterSP("op", '7');
        parent::SetParameterSP("idprueba", '');
        parent::SetParameterSP("idcampo", '');
        parent::SetParameterSP("idcombo", $idCombo);
        parent::SetParameterSP("idtipocampo", '');
        parent::SetParameterSP("nomcombo", '');
        parent::SetParameterSP("nomcampo", '');
        parent::SetParameterSP("texto", '');
        parent::SetParameterSP("valor", '');
        parent::SetParameterSP("idvalorcombo", '');
        parent::SetParameterSP("ordencampo", '');
        parent::SetParameterSP("estadocampo", '');
        parent::SetParameterSP("bObligatorio", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", $hacer);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function eliminaDbCombo($idCombo, $idValcombo) {
        parent::ConnectionOpen("pnsMantenimientoCombos", "dbweb");
        parent::SetParameterSP("op", '8');
        parent::SetParameterSP("idprueba", '');
        parent::SetParameterSP("idcampo", '');
        parent::SetParameterSP("idcombo", $idCombo);
        parent::SetParameterSP("idtipocampo", '');
        parent::SetParameterSP("nomcombo", '');
        parent::SetParameterSP("nomcampo", '');
        parent::SetParameterSP("texto", '');
        parent::SetParameterSP("valor", '');
        parent::SetParameterSP("idvalorcombo", $idValcombo);
        parent::SetParameterSP("ordencampo", '');
        parent::SetParameterSP("estadocampo", '');
        parent::SetParameterSP("bObligatorio", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function selectCombo() {
        parent::ConnectionOpen("pnsMantenimientoCombos", "dbweb");
        parent::SetParameterSP("op", '9');
        parent::SetParameterSP("idprueba", '');
        parent::SetParameterSP("idcampo", '');
        parent::SetParameterSP("idcombo", '');
        parent::SetParameterSP("idtipocampo", '');
        parent::SetParameterSP("nomcombo", '');
        parent::SetParameterSP("nomcampo", '');
        parent::SetParameterSP("texto", '');
        parent::SetParameterSP("valor", '');
        parent::SetParameterSP("idvalorcombo", '');
        parent::SetParameterSP("ordencampo", '');
        parent::SetParameterSP("estadocampo", '');
        parent::SetParameterSP("bObligatorio", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function selectValorCombo($idCombo) {
        parent::ConnectionOpen("pnsMantenimientoCombos", "dbweb");
        parent::SetParameterSP("op", '10');
        parent::SetParameterSP("idprueba", '');
        parent::SetParameterSP("idcampo", '');
        parent::SetParameterSP("idcombo", $idCombo);
        parent::SetParameterSP("idtipocampo", '');
        parent::SetParameterSP("nomcombo", '');
        parent::SetParameterSP("nomcampo", '');
        parent::SetParameterSP("texto", '');
        parent::SetParameterSP("valor", '');
        parent::SetParameterSP("idvalorcombo", '');
        parent::SetParameterSP("ordencampo", '');
        parent::SetParameterSP("estadocampo", '');
        parent::SetParameterSP("bObligatorio", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        parent::SetParameterSP("hacer", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

//////////funciones de giancarlo///////////////
    function comboVersiones() {
        parent::ConnectionOpen("pnsVersiones", "dbweb");
        parent::SetParameterSP("$1", '1');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function estadoDesarrollo($idversion) {
        parent::ConnectionOpen("pnsVersiones", "dbweb");
        parent::SetParameterSP("$1", '2');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $idversion);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function listaCie($nombreCie, $accion) {
        parent::ConnectionOpen("pnsCie", "dbweb");
        parent::SetParameterSP("$1", $accion);
        parent::SetParameterSP("$2", $nombreCie);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function listaParentesco() {
        parent::ConnectionOpen("pnsParentesco", "dbweb");
        parent::SetParameterSP("$1", '1');

        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function preGrabarAntecedente($idCie, $observacion, $idProgramacion, $cadenaParentesco, $estadoAccion, $idAntecedente) {
        parent::ConnectionOpen("pnsMantenimientoAntecedentes", "dbweb");
        parent::SetParameterSP("$1", '1');
        parent::SetParameterSP("$2", $idCie);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '2');
        parent::SetParameterSP("$5", $idProgramacion);
        parent::SetParameterSP("$6", $observacion);
        parent::SetParameterSP("$7", $cadenaParentesco);
        parent::SetParameterSP("$8", $estadoAccion);
        parent::SetParameterSP("$9", $idAntecedente);
        parent::SetParameterSP("$10", $_SESSION["login_user"]);
        parent::SetParameterSP("$11", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function listaAntecedentesPreguardados($codigoProgramacion) {
        parent::ConnectionOpen("pnsMantenimientoAntecedentes", "dbweb");
        parent::SetParameterSP("$1", '2');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '2');
        parent::SetParameterSP("$5", $codigoProgramacion);
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function spListaNsdAntecedentes($codigoProgramacion) {
        parent::ConnectionOpen("pnsMantenimientoAntecedentes", "dbweb");
        parent::SetParameterSP("$1", '6');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '2');
        parent::SetParameterSP("$5", $codigoProgramacion);
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function verAntecedentesAnteriores($codigoPaciente) {
        parent::ConnectionOpen("pnsMantenimientoAntecedentes", "dbweb");
        parent::SetParameterSP("$1", '3');
        parent::SetParameterSP("$2", $codigoPaciente);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function historiaAntecedentes($idProgramacion) {
        parent::ConnectionOpen("pnsMantenimientoAntecedentes", "dbweb");
        parent::SetParameterSP("$1", '4');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", $idProgramacion);
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function hstrAntecedentes($idPaciente) {
        parent::ConnectionOpen("pnsMantenimientoAntecedentes", "dbweb");
        parent::SetParameterSP("$1", '5');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $idPaciente);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        parent::SetParameterSP("$9", '');
        parent::SetParameterSP("$10", '');
        parent::SetParameterSP("$11", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function clonarExamenes($idversion) {
        parent::ConnectionOpen("pnsMantenimientoVersiones", "dbweb");
        parent::SetParameterSP("$1", '1');
        parent::SetParameterSP("$2", $idversion);
        parent::SetParameterSP("$3", $_SESSION["login_user"]);
        parent::SetParameterSP("$4", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function pasarProduccion($idversion) {
        parent::ConnectionOpen("pnsMantenimientoVersiones", "dbweb");
        parent::SetParameterSP("$1", '2');
        parent::SetParameterSP("$2", $idversion);
        parent::SetParameterSP("$3", $_SESSION["login_user"]);
        parent::SetParameterSP("$4", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dgrabarDestinoEssalud($datos) {
        parent::ConnectionOpen("pnsGrabadoInstantaneoCombos", "dbweb");
        parent::SetParameterSP("bus", '1');
        parent::SetParameterSP("pv1", $datos["combo"]);
        parent::SetParameterSP("pv2", $datos["programacion"]);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dgrabarTipoCitaEssalud($datos) {
        parent::ConnectionOpen("pnsGrabadoInstantaneoCombos", "dbweb");
        parent::SetParameterSP("bus", '2');
        parent::SetParameterSP("pv1", $datos["combo"]);
        parent::SetParameterSP("pv2", $datos["programacion"]);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dcargarDatosCombo($datos) {
        parent::ConnectionOpen("pnsGrabadoInstantaneoCombos", "dbweb");
        parent::SetParameterSP("bus", '3');
        parent::SetParameterSP("pv1", $datos["programacion"]);
        parent::SetParameterSP("pv2", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function obtenerlistaAsignadas($datos) {
        parent::ConnectionOpen("pnsMantenimientoDeModulosPorServicio", "dbweb");
        parent::SetParameterSP("bus", '2');
        parent::SetParameterSP("pv1", $datos["idServicio"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", '');
        parent::SetParameterSP("pv4", '');
        parent::SetParameterSP("pv5", '');
        parent::SetParameterSP("pv6", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function obtenerlistaANoAsignadas($datos) {
        parent::ConnectionOpen("pnsMantenimientoDeModulosPorServicio", "dbweb");
        parent::SetParameterSP("bus", '3');
        parent::SetParameterSP("pv1", $datos["idServicio"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", '');
        parent::SetParameterSP("pv4", '');
        parent::SetParameterSP("pv5", '');
        parent::SetParameterSP("pv6", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dCargarCuerpoHC($datos) {
        parent::ConnectionOpen("pnsMantenimientoDeModulosPorServicio", "dbweb");
        parent::SetParameterSP("bus", '6');
        parent::SetParameterSP("pv1", $datos["c_cod_ser_pro"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", '');
        parent::SetParameterSP("pv4", '');
        parent::SetParameterSP("pv5", '');
        parent::SetParameterSP("pv6", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dCargarCuerpoHCNinoSano($datos) {
        parent::ConnectionOpen("pnsMantenimientoDeModulosPorServicio", "dbweb");
        parent::SetParameterSP("bus", '6');
        parent::SetParameterSP("pv1", $datos["c_cod_ser_pro"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", '');
        parent::SetParameterSP("pv4", '');
        parent::SetParameterSP("pv5", '');
        parent::SetParameterSP("pv6", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dcargarDatosTipoCita($datos) {
        parent::ConnectionOpen("pnsGrabadoInstantaneoCombos", "dbweb");
        parent::SetParameterSP("bus", '4');
        parent::SetParameterSP("pv1", $datos["programacion"]);
        parent::SetParameterSP("pv2", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function inactivarVersion($idversion) {
        parent::ConnectionOpen("pnsMantenimientoVersiones", "dbweb");
        parent::SetParameterSP("$1", '3');
        parent::SetParameterSP("$2", $idversion);
        parent::SetParameterSP("$3", $_SESSION["login_user"]);
        parent::SetParameterSP("$4", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function existeDesarrollo($idversion) {
        parent::ConnectionOpen("pnsMantenimientoVersiones", "dbweb");
        parent::SetParameterSP("$1", '4');
        parent::SetParameterSP("$2", $idversion);
        parent::SetParameterSP("$3", $_SESSION["login_user"]);
        parent::SetParameterSP("$4", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function listaExamenesPruebas($idVersion, $idExamen) {
        parent::ConnectionOpen("pnsDatosExamenes", "dbweb");
        parent::SetParameterSP("$1", '1');
        parent::SetParameterSP("$2", $idVersion);
        parent::SetParameterSP("$3", $idExamen);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function cargarTablaServicios($datos) {
        parent::ConnectionOpen("pnsMantenimientoDeModulosPorServicio", "dbweb");
        parent::SetParameterSP("bus", '1');
        parent::SetParameterSP("pv1", $datos['servicio']);
        parent::SetParameterSP("pv2", '');
        parent::SetParameterSP("pv3", '');
        parent::SetParameterSP("pv4", '');
        parent::SetParameterSP("pv5", '');
        parent::SetParameterSP("pv6", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function eliminarAnterioresSeleccionados($datos) {
        parent::ConnectionOpen("pnsMantenimientoDeModulosPorServicio", "dbweb");
        parent::SetParameterSP("bus", '4');
        parent::SetParameterSP("pv1", $datos['idServicio']);
        parent::SetParameterSP("pv2", '');
        parent::SetParameterSP("pv3", '');
        parent::SetParameterSP("pv4", '');
        parent::SetParameterSP("pv5", '');
        parent::SetParameterSP("pv6", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function guardarNuevaSeleccion($datos) {
        $arrayDatos = explode("|", $datos["cadena"]);
        $arrayNumero = explode("|", $datos["numero"]);
        $numGrabaciones = count($arrayDatos);


        for ($x = 0; $x <= $numGrabaciones - 1; $x++) {
            parent::Liberar_Parametros();
            parent::ConnectionOpen("pnsMantenimientoDeModulosPorServicio", "dbweb");
            parent::SetParameterSP("bus", '5');
            parent::SetParameterSP("pv1", $datos['idServicio']);
            parent::SetParameterSP("pv2", $arrayDatos[$x]);
            parent::SetParameterSP("pv3", strtoupper($_SESSION["login_user"]));
            parent::SetParameterSP("pv4", $_SESSION['host']);
            parent::SetParameterSP("pv5", "");
            parent::SetParameterSP("pv6", $arrayNumero[$x]);
            $resultadoArray = parent::executeSPArrayX();
            parent::ConnectionClose();
        }
        return $resultadoArray;
    }

    function cerrarAntecedenteOdontograma($datos) {
        parent::ConnectionOpen("nsmGrabarImagenHistoriaDiente", "dbweb");
        parent::SetParameterSP("bus", '3');
        parent::SetParameterSP("var1", $datos['IdHistoriaDiente']);
        parent::SetParameterSP("var2", "");
        parent::SetParameterSP("var3", "");
        parent::SetParameterSP("var4", "");
        parent::SetParameterSP("var5", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function cargarTablaAfiliaciones($datos) {
        parent::ConnectionOpen("pnsMantenimientoDeModulosPorServicio", "dbweb");
        parent::SetParameterSP("bus", '7');
        parent::SetParameterSP("var1", $datos['afiliaciones']);
        parent::SetParameterSP("var2", "");
        parent::SetParameterSP("var3", "");
        parent::SetParameterSP("var4", "");
        parent::SetParameterSP("var5", "");
        parent::SetParameterSP("pv6", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function cambiaraEstadoImagenesVersionesAnteriores($datos) {
        parent::ConnectionOpen("nsmGrabarImagenHistoriaDiente", "dbweb");
        parent::SetParameterSP("bus", '4');
        parent::SetParameterSP("var1", $datos['IdHistoriaDiente']);
        parent::SetParameterSP("var2", "");
        parent::SetParameterSP("var3", "");
        parent::SetParameterSP("var4", "");
        parent::SetParameterSP("var5", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function pruebasExamenes($idExamen, $iCodigoProgramacion) {
        parent::ConnectionOpen("pnsDatosExamenes", "dbweb");
        parent::SetParameterSP("$1", '2');
        parent::SetParameterSP("$2", $iCodigoProgramacion);
        parent::SetParameterSP("$3", $idExamen);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function arrayComboExamenes($idCombo) {
        parent::ConnectionOpen("pnsDatosExamenes", "dbweb");
        parent::SetParameterSP("$1", '3');
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $idCombo);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function preguardarExamenes($valorCampo, $estadoCampo, $idCampoExamen, $idTipoCampo, $idCampo, $iCodigoProgramacion, $idVersion) {
        parent::ConnectionOpen("pnsMantenimientoExamenesMedicos", "dbweb");
        parent::SetParameterSP("$1", '1');
        parent::SetParameterSP("$2", $valorCampo);
        parent::SetParameterSP("$3", $estadoCampo);
        parent::SetParameterSP("$4", $idCampoExamen);
        parent::SetParameterSP("$5", $idTipoCampo);
        parent::SetParameterSP("$6", $idCampo);
        parent::SetParameterSP("$7", $iCodigoProgramacion);
        parent::SetParameterSP("$8", $idVersion);
        parent::SetParameterSP("$9", $_SESSION["login_user"]);
        parent::SetParameterSP("$10", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function listaAtencionesXDia($idPrograma) {
        parent::ConnectionOpen("pnsImprimirHcXDia", "dbweb");
        parent::SetParameterSP("bus", '1');
        parent::SetParameterSP("var1", $idPrograma);
        parent::SetParameterSP("var2", '');
        parent::SetParameterSP("var3", '');
        parent::SetParameterSP("var4", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function arbolHCFechas($codigoPaciente) {
        parent::ConnectionOpen("pnsHC", "dbweb");
        parent::SetParameterSP("$1", '1');
        parent::SetParameterSP("$2", $codigoPaciente);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("hacer", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function listaAtencionesMamografias($datos) {
        parent::ConnectionOpen("nsmTramasPapanicolao", "dbweb");
        parent::SetParameterSP("$1", 1);
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", $datos['p2']);
        parent::SetParameterSP("$5", $datos['p3']);
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function datospacientePapanicolaum($c_cod_per) {
        parent::ConnectionOpen("nsmTramasPapanicolao", "dbweb");
        parent::SetParameterSP("$1", 4);
        parent::SetParameterSP("$2", $c_cod_per);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function resultadoLaboratorio($idResultado) {
        parent::ConnectionOpen("nsmTramasPapanicolao", "dbweb");
        parent::SetParameterSP("$1", 5);
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", $idResultado);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function listaAtencionespapanicolaum($datos) {
        parent::ConnectionOpen("nsmTramasPapanicolao", "dbweb");
        parent::SetParameterSP("$1", 3);
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", $datos['p2']);
        parent::SetParameterSP("$5", $datos['p3']);
        parent::SetParameterSP("$6", '6');
        parent::SetParameterSP("$7", '2013');
        parent::SetParameterSP("$8", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function datospaciente($iProgramacion) {
        parent::ConnectionOpen("nsmTramasPapanicolao", "dbweb");
        parent::SetParameterSP("$1", 2);
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $iProgramacion);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function grupoEtareoPersona($iProgramacion) {
        parent::ConnectionOpen("nsmTramasPapanicolao", "dbweb");
        parent::SetParameterSP("$1", 7);
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", $iProgramacion);
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function listaAtencionesPreventivas($dia) {
        parent::ConnectionOpen("nsmTramasPapanicolao", "dbweb");
        parent::SetParameterSP("$1", 6);
        parent::SetParameterSP("$2", '');
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", $dia);
        parent::SetParameterSP("$5", '');
        parent::SetParameterSP("$6", '');
        parent::SetParameterSP("$7", '');
        parent::SetParameterSP("$8", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function listaExamenesHC($codigo, $hacer) {   //por programacion , por paciente
        parent::ConnectionOpen("pnsHC", "dbweb");
        parent::SetParameterSP("$1", '2');
        parent::SetParameterSP("$2", $codigo);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("hacer", $hacer);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function listaExamenesHCGeneral( $codProgramacion,$codExamen) {   //por programacion , por paciente
        parent::ConnectionOpen("pnsHC", "dbweb");
        parent::SetParameterSP("$1", '7');
        parent::SetParameterSP("$2", $codProgramacion);
        parent::SetParameterSP("$3", $codExamen);
        parent::SetParameterSP("hacer", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function cargarTablaCentroCostosServicios($datos) {   //por programacion , por paciente
        parent::ConnectionOpen("pnsListarServiciosXCentroCostos", "dbweb");
        parent::SetParameterSP("bus", '1');
        parent::SetParameterSP("var1", $datos['idCentroCosto']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function valoresCampos($idProgramacion, $idExamen) {
        parent::ConnectionOpen("pnsHC", "dbweb");
        parent::SetParameterSP("$1", '3');
        parent::SetParameterSP("$2", $idProgramacion);
        parent::SetParameterSP("$3", $idExamen);
        parent::SetParameterSP("hacer", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function valorComboExamen($iCombo) {
        parent::ConnectionOpen("pnsHC", "dbweb");
        parent::SetParameterSP("$1", '4');
        parent::SetParameterSP("$2", $iCombo);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("hacer", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function atencionMedico($idProgramacion) {   //por programacion , por paciente
        parent::ConnectionOpen("pnsHC", "dbweb");
        parent::SetParameterSP("$1", '5');
        parent::SetParameterSP("$2", $idProgramacion);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("hacer", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function spListaDetalleCita($idProgramacion) { //Lista detalle de cita parecido al FOX
        parent::ConnectionOpen("pnsHC", "dbweb");
        parent::SetParameterSP("$1", '6');
        parent::SetParameterSP("$2", $idProgramacion);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("hacer", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

////////fin de funciones de giancarlo///////////////////
///////funciones de luis////////////////////////////////
    function getDatosFiliacionActoMedico($datos) {
        parent::ConnectionOpen("pnsMantenimientoHC", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("codigoProgramacion", $datos["codigoProgramacion"]);
        parent::SetParameterSP("codigoPaciente", $datos["codigoPaciente"]);
        parent::SetParameterSP("codigoServicio", $datos["codigoServicio"]);
        parent::SetParameterSP("proximacitasugerida", "");
        parent::SetParameterSP("usuario", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getFechaVencimientoRecetaMedica($datos) {
        parent::ConnectionOpen("pnsMantenimientoTratamientos", "dbweb");
        parent::SetParameterSP("accion", '10');
        parent::SetParameterSP("idReceta", "");
        parent::SetParameterSP("codigomedicamento", "");
        parent::SetParameterSP("observacion", "");
        parent::SetParameterSP("codigoProgramacion", $datos["codigoProgramacion"]);
        parent::SetParameterSP("codigopaciente", "");
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("estadoaccion", "");
        parent::SetParameterSP("idtratamientomedicamentoso", "");
        parent::SetParameterSP("cantidad", "");
        parent::SetParameterSP("codigodosis", "");
        parent::SetParameterSP("fechavencimiento", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function atencionInmediataActoMedico($datos) {
        parent::ConnectionOpen("pnsMantenimientoHC", "dbweb");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("codigoProgramacion", $datos["codigoProgramacion"]);
        parent::SetParameterSP("codigoPaciente", "");
        parent::SetParameterSP("codigoServicio", "");
        parent::SetParameterSP("proximacitasugerida", "");
        parent::SetParameterSP("usuario", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayProductosMedicamentosos($datos, $accion) {
        parent::ConnectionOpen("pnsTratamientosHC", "dbweb");
        parent::SetParameterSP("accion", $accion);
        parent::SetParameterSP("codigoProducto", "");
        parent::SetParameterSP("parametro", $datos["parametronombre"]);
        parent::SetParameterSP("ip", $datos["ip"]);
        parent::SetParameterSP("afiliacion", $datos["afiliacion"]);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayPracticasMedicas($datos, $accion) {
        parent::ConnectionOpen("pnsTratamientosHC", "dbweb");
        parent::SetParameterSP("accion", $accion);
        parent::SetParameterSP("codigoProducto", "");
        parent::SetParameterSP("parametro", $datos["parametronombre"]);
        parent::SetParameterSP("ip", "");
        parent::SetParameterSP("afiliacion", $datos["afiliacion"]);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArraypreciosProductosServicios($datos) {
        parent::ConnectionOpen("pnsTratamientosHC", "dbweb");
        parent::SetParameterSP("accion", '4');
        parent::SetParameterSP("codigoProducto", $datos["codigoProducto"]);
        parent::SetParameterSP("parametro", "");
        parent::SetParameterSP("ip", "");
        parent::SetParameterSP("afiliacion", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayDosificacion() {
        parent::ConnectionOpen("pnsMantenimientoTratamientos", "dbweb");
        parent::SetParameterSP("accion", '9');
        parent::SetParameterSP("idReceta", "");
        parent::SetParameterSP("codigomedicamento", "");
        parent::SetParameterSP("observacion", "");
        parent::SetParameterSP("codigoprogramacion", "");
        parent::SetParameterSP("codigopaciente", "");
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("estadoaccion", "");
        parent::SetParameterSP("idtratamientomedicamentoso", "");
        parent::SetParameterSP("cantidad", "");
        parent::SetParameterSP("codigodosis", "");
        parent::SetParameterSP("fechavencimiento", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function preGrabarTratamientoMedicamentoso($datos) {
        parent::ConnectionOpen("pnsMantenimientoTratamientos", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("idReceta", "");
        parent::SetParameterSP("codigomedicamento", $datos["codigomedicamento"]);
        parent::SetParameterSP("observacion", $datos["observacion"]);
        parent::SetParameterSP("codigoprogramacion", $datos["codigoprogramacion"]);
        parent::SetParameterSP("codigopaciente", "");
        parent::SetParameterSP("estadoregistro", '2');
        parent::SetParameterSP("estadoaccion", $datos["estadoregistro"]);
        parent::SetParameterSP("idtratamientomedicamentoso", $datos["idtratamientomedicamento"]);
        parent::SetParameterSP("cantidad", $datos["txtcantidad"]);
        parent::SetParameterSP("codigodosis", $datos["codigodosis"]);
        parent::SetParameterSP("fechavencimiento", "");
        parent::SetParameterSP("usuario", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("hacer", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function preguardarFechaVencimientoReceta($datos) {
        parent::ConnectionOpen("pnsMantenimientoTratamientos", "dbweb");
        parent::SetParameterSP("accion", '12');
        parent::SetParameterSP("idReceta", "");
        parent::SetParameterSP("codigomedicamento", "");
        parent::SetParameterSP("observacion", "");
        parent::SetParameterSP("codigoprogramacion", $datos["codigoprogramacion"]);
        parent::SetParameterSP("codigopaciente", "");
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("estadoaccion", "");
        parent::SetParameterSP("idtratamientomedicamentoso", "");
        parent::SetParameterSP("cantidad", "");
        parent::SetParameterSP("codigodosis", "");
        parent::SetParameterSP("fechavencimiento", $datos["txtfechavencimiento"]);
        parent::SetParameterSP("usuario", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("hacer", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function preGrabarTratatamientoPracticaMedica($datos) {
        parent::ConnectionOpen("pnsMantenimientoTratamientos", "dbweb");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("idReceta", "");
        parent::SetParameterSP("codigopracticamedica", $datos["codigopracticamedica"]);
        parent::SetParameterSP("observacion", $datos["observacion"]);
        parent::SetParameterSP("codigoprogramacion", $datos["codigoprogramacion"]);
        parent::SetParameterSP("codigopaciente", "");
        parent::SetParameterSP("estadoregistro", '2');
        parent::SetParameterSP("estadoaccion", $datos["estadoregistro"]);
        parent::SetParameterSP("idtratamientopracticamedica", $datos["idtratamientopracticamedica"]);
        parent::SetParameterSP("cantidad", $datos["estado"]);
        parent::SetParameterSP("codigodosis", "");
        parent::SetParameterSP("fechavencimiento", "");
        parent::SetParameterSP("usuario", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        parent::SetParameterSP("hacer", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function cargaTratamientosMedicamentososPreguardados($datos) {
        parent::ConnectionOpen("pnsMantenimientoTratamientos", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("idReceta", "");
        parent::SetParameterSP("codigomedicamento", "");
        parent::SetParameterSP("observacion", "");
        parent::SetParameterSP("codigoprogramacion", $datos["codigoprogramacion"]);
        parent::SetParameterSP("codigopaciente", "");
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("estadoaccion", "");
        parent::SetParameterSP("idtratamientomedicamentoso", "");
        parent::SetParameterSP("cantidad", "");
        parent::SetParameterSP("codigodosis", "");
        parent::SetParameterSP("fechavencimiento", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dDuplicarReceta($datos) {
        parent::ConnectionOpen("pnsMantenimientoTratamientos", "dbweb");
        parent::SetParameterSP("accion", '13');
        parent::SetParameterSP("idReceta", $datos['idReceta']);
        parent::SetParameterSP("codigomedicamento", "");
        parent::SetParameterSP("observacion", "");
        parent::SetParameterSP("codigoprogramacion", '');
        parent::SetParameterSP("codigopaciente", "");
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("estadoaccion", "");
        parent::SetParameterSP("idtratamientomedicamentoso", "");
        parent::SetParameterSP("cantidad", "");
        parent::SetParameterSP("codigodosis", "");
        parent::SetParameterSP("fechavencimiento", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dCadenaRecetas($datos) {
        parent::ConnectionOpen("pnsMantenimientoTratamientos", "dbweb");
        parent::SetParameterSP("accion", '14');
        parent::SetParameterSP("idReceta", '');
        parent::SetParameterSP("codigomedicamento", "");
        parent::SetParameterSP("observacion", "");
        parent::SetParameterSP("codigoprogramacion", $datos["codigoProgramacion"]);
        parent::SetParameterSP("codigopaciente", "");
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("estadoaccion", "");
        parent::SetParameterSP("idtratamientomedicamentoso", "");
        parent::SetParameterSP("cantidad", "");
        parent::SetParameterSP("codigodosis", "");
        parent::SetParameterSP("fechavencimiento", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function cargaTratamientosPracticasMedicasPreguardados($datos) {
        parent::ConnectionOpen("pnsMantenimientoTratamientos", "dbweb");
        parent::SetParameterSP("accion", '4');
        parent::SetParameterSP("idReceta", "");
        parent::SetParameterSP("codigomedicamento", "");
        parent::SetParameterSP("observacion", "");
        parent::SetParameterSP("codigoprogramacion", $datos["codigoprogramacion"]);
        parent::SetParameterSP("codigopaciente", "");
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("estadoaccion", "");
        parent::SetParameterSP("idtratamientomedicamentoso", "");
        parent::SetParameterSP("cantidad", "");
        parent::SetParameterSP("codigodosis", "");
        parent::SetParameterSP("fechavencimiento", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayTratamientosAnteriores($datos) {
        parent::ConnectionOpen("pnsMantenimientoTratamientos", "dbweb");
        parent::SetParameterSP("accion", '5');
        parent::SetParameterSP("idReceta", "");
        parent::SetParameterSP("codigomedicamento", "");
        parent::SetParameterSP("observacion", "");
        parent::SetParameterSP("codigoprogramacion", "");
        parent::SetParameterSP("codigopaciente", $datos["codigopaciente"]);
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("estadoaccion", $datos["tipotratamiento"]);
        parent::SetParameterSP("idtratamientomedicamentoso", "");
        parent::SetParameterSP("cantidad", "");
        parent::SetParameterSP("codigodosis", "");
        parent::SetParameterSP("fechavencimiento", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayTratamientoAnterior($datos) {
        parent::ConnectionOpen("pnsMantenimientoTratamientos", "dbweb");
        parent::SetParameterSP("accion", '6');
        parent::SetParameterSP("idReceta", "");
        parent::SetParameterSP("codigomedicamento", "");
        parent::SetParameterSP("observacion", "");
        parent::SetParameterSP("codigoprogramacion", "");
        parent::SetParameterSP("codigopaciente", "");
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("estadoaccion", "");
        parent::SetParameterSP("idtratamientomedicamentoso", $datos["idtratamiento"]);
        parent::SetParameterSP("cantidad", "");
        parent::SetParameterSP("codigodosis", "");
        parent::SetParameterSP("fechavencimiento", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function historiaTratamientos($idProgramacion, $hacer) {
        parent::ConnectionOpen("pnsMantenimientoTratamientos", "dbweb");
        parent::SetParameterSP("accion", '7');
        parent::SetParameterSP("idReceta", "");
        parent::SetParameterSP("codigomedicamento", "");
        parent::SetParameterSP("observacion", "");
        parent::SetParameterSP("codigoprogramacion", $idProgramacion);
        parent::SetParameterSP("codigopaciente", "");
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("estadoaccion", "");
        parent::SetParameterSP("idtratamientomedicamentoso", "");
        parent::SetParameterSP("cantidad", "");
        parent::SetParameterSP("codigodosis", "");
        parent::SetParameterSP("fechavencimiento", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", $hacer);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function hstrTratamiento($idPaciente, $hacer) {
        parent::ConnectionOpen("pnsMantenimientoTratamientos", "dbweb");
        parent::SetParameterSP("accion", '8');
        parent::SetParameterSP("idReceta", "");
        parent::SetParameterSP("codigomedicamento", "");
        parent::SetParameterSP("observacion", "");
        parent::SetParameterSP("codigoprogramacion", "");
        parent::SetParameterSP("codigopaciente", $idPaciente);
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("estadoaccion", "");
        parent::SetParameterSP("idtratamientomedicamentoso", "");
        parent::SetParameterSP("cantidad", "");
        parent::SetParameterSP("codigodosis", "");
        parent::SetParameterSP("fechavencimiento", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        parent::SetParameterSP("hacer", $hacer);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayTipoIngreso() {
        parent::ConnectionOpen("pnsMantenimientoDiagnosticos", "dbweb");
        parent::SetParameterSP("accion", '13');
        parent::SetParameterSP("cadena", "");
        parent::SetParameterSP("codigoProgramacion", "");
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("idDiagnostico", "");
        parent::SetParameterSP("codigointernoCIE", "");
        parent::SetParameterSP("ObservacionDiagnostico", "");
        parent::SetParameterSP("codigopaciente", "");
        parent::SetParameterSP("codigocronograma", "");
        parent::SetParameterSP("esEssalud", "");
        parent::SetParameterSP("destinoCitaEssalud", "");
        parent::SetParameterSP("tipoconsultaEssalud", "");
        parent::SetParameterSP("numerosesion", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayTipoDiagnostico() {
        parent::ConnectionOpen("pnsMantenimientoDiagnosticos", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("cadena", "");
        parent::SetParameterSP("codigoProgramacion", "");
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("idDiagnostico", "");
        parent::SetParameterSP("codigointernoCIE", "");
        parent::SetParameterSP("ObservacionDiagnostico", "");
        parent::SetParameterSP("codigopaciente", "");
        parent::SetParameterSP("codigocronograma", "");
        parent::SetParameterSP("esEssalud", "");
        parent::SetParameterSP("destinoCitaEssalud", "");
        parent::SetParameterSP("tipoconsultaEssalud", "");
        parent::SetParameterSP("numerosesion", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayDestinoCitaEssalud() {
        parent::ConnectionOpen("pnsMantenimientoDiagnosticos", "dbweb");
        parent::SetParameterSP("accion", '8');
        parent::SetParameterSP("cadena", "");
        parent::SetParameterSP("codigoProgramacion", "");
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("idDiagnostico", "");
        parent::SetParameterSP("codigointernoCIE", "");
        parent::SetParameterSP("ObservacionDiagnostico", "");
        parent::SetParameterSP("codigopaciente", "");
        parent::SetParameterSP("codigocronograma", "");
        parent::SetParameterSP("esEssalud", "");
        parent::SetParameterSP("destinoCitaEssalud", "");
        parent::SetParameterSP("tipoconsultaEssalud", "");
        parent::SetParameterSP("numerosesion", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayTipoCitaEssalud() {
        parent::ConnectionOpen("pnsMantenimientoDiagnosticos", "dbweb");
        parent::SetParameterSP("accion", '9');
        parent::SetParameterSP("cadena", "");
        parent::SetParameterSP("codigoProgramacion", "");
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("idDiagnostico", "");
        parent::SetParameterSP("codigointernoCIE", "");
        parent::SetParameterSP("ObservacionDiagnostico", "");
        parent::SetParameterSP("codigopaciente", "");
        parent::SetParameterSP("codigocronograma", "");
        parent::SetParameterSP("esEssalud", "");
        parent::SetParameterSP("destinoCitaEssalud", "");
        parent::SetParameterSP("tipoconsultaEssalud", "");
        parent::SetParameterSP("numerosesion", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function numeroSesionEssalud($datos) {
        parent::ConnectionOpen("pnsMantenimientoDiagnosticos", "dbweb");
        parent::SetParameterSP("accion", '10');
        parent::SetParameterSP("cadena", "");
        parent::SetParameterSP("codigoProgramacion", "");
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("idDiagnostico", "");
        parent::SetParameterSP("codigointernoCIE", "");
        parent::SetParameterSP("ObservacionDiagnostico", "");
        parent::SetParameterSP("codigopaciente", $datos["codigoPaciente"]);
        parent::SetParameterSP("codigocronograma", "");
        parent::SetParameterSP("esEssalud", "");
        parent::SetParameterSP("destinoCitaEssalud", "");
        parent::SetParameterSP("tipoconsultaEssalud", "");
        parent::SetParameterSP("numerosesion", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayagregarOtroDiagnostico() {
        parent::ConnectionOpen("pnsCie", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("var1", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function preGrabarDiagnostico($datos) {
        parent::ConnectionOpen("pnsMantenimientoDiagnosticos", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("cadena", $datos["cadena"]);
        parent::SetParameterSP("codigoProgramacion", $datos["codigoProgramacion"]);
        parent::SetParameterSP("estadoregistro", $datos["estadoregistro"]);
        parent::SetParameterSP("idDiagnostico", $datos["idDiagnostico"]);
        parent::SetParameterSP("codigointernoCIE", "");
        parent::SetParameterSP("ObservacionDiagnostico", $datos["ObservacionDiagnostico"]);
        parent::SetParameterSP("codigopaciente", $datos["codigopaciente"]);
        parent::SetParameterSP("codigocronograma", $datos["codigocronograma"]);
        parent::SetParameterSP("esEssalud", $datos["esEssalud"]);
        parent::SetParameterSP("destinoCitaEssalud", $datos["destinoCitaEssalud"]);
        parent::SetParameterSP("tipoconsultaEssalud", $datos["tipoconsultaEssalud"]);
        parent::SetParameterSP("numerosesion", $datos["numerosesion"]);
        parent::SetParameterSP("usuario", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function eliminarDiagnostico($datos) {
        parent::ConnectionOpen("pnsMantenimientoDiagnosticos", "dbweb");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("cadena", "");
        parent::SetParameterSP("codigoProgramacion", "");
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("idDiagnostico", $datos["IdDiagnostico"]);
        parent::SetParameterSP("codigointernoCIE", $datos["codigointernoCIE"]);
        parent::SetParameterSP("ObservacionDiagnostico", "");
        parent::SetParameterSP("codigopaciente", "");
        parent::SetParameterSP("codigocronograma", "");
        parent::SetParameterSP("esEssalud", "");
        parent::SetParameterSP("destinoCitaEssalud", "");
        parent::SetParameterSP("tipoconsultaEssalud", "");
        parent::SetParameterSP("numerosesion", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function cargaDiagnosticosPreguardados($datos) {
        parent::ConnectionOpen("pnsMantenimientoDiagnosticos", "dbweb");
        parent::SetParameterSP("accion", '4');
        parent::SetParameterSP("cadena", "");
        parent::SetParameterSP("codigoprogramacion", $datos["codigoprogramacion"]);
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("idDiagnostico", "");
        parent::SetParameterSP("codigointernoCIE", "");
        parent::SetParameterSP("ObservacionDiagnostico", "");
        parent::SetParameterSP("codigopaciente", "");
        parent::SetParameterSP("codigocronograma", "");
        parent::SetParameterSP("esEssalud", "");
        parent::SetParameterSP("destinoCitaEssalud", "");
        parent::SetParameterSP("tipoconsultaEssalud", "");
        parent::SetParameterSP("numerosesion", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getArrayDiagnosticosAnteriores($datos) {
        parent::ConnectionOpen("pnsMantenimientoDiagnosticos", "dbweb");
        parent::SetParameterSP("accion", '5');
        parent::SetParameterSP("cadena", "");
        parent::SetParameterSP("codigoprogramacion", "");
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("idDiagnostico", "");
        parent::SetParameterSP("codigointernoCIE", "");
        parent::SetParameterSP("ObservacionDiagnostico", "");
        parent::SetParameterSP("codigopaciente", $datos["codigopaciente"]);
        parent::SetParameterSP("codigocronograma", "");
        parent::SetParameterSP("esEssalud", "");
        parent::SetParameterSP("destinoCitaEssalud", "");
        parent::SetParameterSP("tipoconsultaEssalud", "");
        parent::SetParameterSP("numerosesion", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    /* TRIAJE */

    function getArrayDatosTriaje($datos) {
        parent::ConnectionOpen("pnsListarDatosTriaje", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("codigoProgramacion", $datos["codigoProgramacion"]);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function listaDatosTriaje($idProgPaciente) {
        parent::ConnectionOpen("pnsListarDatosTriaje", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("codigoProgramacion", $idProgPaciente);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    /*     * traemos datos del medico y servicio fecha** */

    function getArrayDiagnosticoAnterior($datos) {
        parent::ConnectionOpen("pnsMantenimientoDiagnosticos", "dbweb");
        parent::SetParameterSP("accion", '6');
        parent::SetParameterSP("cadena", "");
        parent::SetParameterSP("codigoprogramacion", $datos["codigoprogramacion"]);
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("idDiagnostico", "");
        parent::SetParameterSP("codigointernoCIE", "");
        parent::SetParameterSP("ObservacionDiagnostico", "");
        parent::SetParameterSP("codigopaciente", "");
        parent::SetParameterSP("codigocronograma", "");
        parent::SetParameterSP("esEssalud", "");
        parent::SetParameterSP("destinoCitaEssalud", "");
        parent::SetParameterSP("tipoconsultaEssalud", "");
        parent::SetParameterSP("numerosesion", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    /*     * generamos tabla cie PopUp** */

    function getArrayDiagnosticoAnteriorPopUp($datos) {
        parent::ConnectionOpen("pnsMantenimientoDiagnosticos", "dbweb");
        parent::SetParameterSP("accion", '7');
        parent::SetParameterSP("cadena", "");
        parent::SetParameterSP("codigoprogramacion", $datos["codigoprogramacion"]);
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("idDiagnostico", "");
        parent::SetParameterSP("codigointernoCIE", "");
        parent::SetParameterSP("ObservacionDiagnostico", "");
        parent::SetParameterSP("codigopaciente", "");
        parent::SetParameterSP("codigocronograma", "");
        parent::SetParameterSP("esEssalud", "");
        parent::SetParameterSP("destinoCitaEssalud", "");
        parent::SetParameterSP("tipoconsultaEssalud", "");
        parent::SetParameterSP("numerosesion", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dTablaProcedimientoOdontologico($datos) {
        parent::ConnectionOpen("pnsListarProcedimientosDienteBusquedaTabla", "dbweb");
        parent::SetParameterSP("var1", '1');
        parent::SetParameterSP("var2", $datos["nombre"]);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function historiaDiagnostico($idProgramacion) {
        parent::ConnectionOpen("pnsMantenimientoDiagnosticos", "dbweb");
        parent::SetParameterSP("accion", '11');
        parent::SetParameterSP("cadena", "");
        parent::SetParameterSP("codigoProgramacion", $idProgramacion);
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("idDiagnostico", "");
        parent::SetParameterSP("codigointernoCIE", "");
        parent::SetParameterSP("ObservacionDiagnostico", "");
        parent::SetParameterSP("codigopaciente", "");
        parent::SetParameterSP("codigocronograma", "");
        parent::SetParameterSP("esEssalud", "");
        parent::SetParameterSP("destinoCitaEssalud", "");
        parent::SetParameterSP("tipoconsultaEssalud", "");
        parent::SetParameterSP("numerosesion", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function hstrDiagnostico($idPaciente) {
        parent::ConnectionOpen("pnsMantenimientoDiagnosticos", "dbweb");
        parent::SetParameterSP("accion", '12');
        parent::SetParameterSP("cadena", "");
        parent::SetParameterSP("codigoProgramacion", "");
        parent::SetParameterSP("estadoregistro", "");
        parent::SetParameterSP("idDiagnostico", "");
        parent::SetParameterSP("codigointernoCIE", "");
        parent::SetParameterSP("ObservacionDiagnostico", "");
        parent::SetParameterSP("codigopaciente", $idPaciente);
        parent::SetParameterSP("codigocronograma", "");
        parent::SetParameterSP("esEssalud", "");
        parent::SetParameterSP("destinoCitaEssalud", "");
        parent::SetParameterSP("tipoconsultaEssalud", "");
        parent::SetParameterSP("numerosesion", "");
        parent::SetParameterSP("usuario", "");
        parent::SetParameterSP("host", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function guardarAtencionMedicaHC($datos) {
        parent::ConnectionOpen("pnsMantenimientoHC", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("codigoProgramacion", $datos["codigoProgramacion"]);
        parent::SetParameterSP("codigoPaciente", "");
        parent::SetParameterSP("codigoServicio", "");
        parent::SetParameterSP("proximacitasugerida", $datos["proximacitasugerida"]);
        parent::SetParameterSP("usuario", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function proximaCitaSugeridaArray($datos) {
        parent::ConnectionOpen("pnsMantenimientoHC", "dbweb");
        parent::SetParameterSP("accion", '6');
        parent::SetParameterSP("codigoProgramacion", $datos["codigoProgramacion"]);
        parent::SetParameterSP("codigoPaciente", "");
        parent::SetParameterSP("codigoServicio", "");
        parent::SetParameterSP("proximacitasugerida", "");
        parent::SetParameterSP("usuario", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function cambiarEstadoNoAtendido($datos) {
        parent::ConnectionOpen("pnsMantenimientoHC", "dbweb");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("codigoProgramacion", $datos["codigoProgramacion"]);
        parent::SetParameterSP("codigoPaciente", "");
        parent::SetParameterSP("codigoServicio", "");
        parent::SetParameterSP("proximacitasugerida", "");
        parent::SetParameterSP("usuario", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function anularPago($datos) {
        parent::ConnectionOpen("pnsAnularPago", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("codigoProgramacion", $datos["codigoProgramacion"]);
        parent::SetParameterSP("iIdPago", '');
        parent::SetParameterSP("usuario", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }
    function anularComprobantePago($datos) {
        parent::ConnectionOpen("pnsAnularPago", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("codigoProgramacion", '');
        parent::SetParameterSP("iIdPago", $datos["iIdPago"]);
        parent::SetParameterSP("usuario", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }
    

    function dDesconfirmarCita($datos) {
        parent::ConnectionOpen("pnsMantenimientoHC", "dbweb");
        parent::SetParameterSP("accion", '5');
        parent::SetParameterSP("codigoProgramacion", $datos["codigoProgramacion"]);
        parent::SetParameterSP("codigoPaciente", "");
        parent::SetParameterSP("codigoServicio", "");
        parent::SetParameterSP("proximacitasugerida", "");
        parent::SetParameterSP("usuario", $_SESSION["login_user"]);
        parent::SetParameterSP("host", $_SESSION['host']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function getdatosMedicosActoMedico($datos) {
        
    }

////////fin de funciones de luis///////////////////////
/////////////////////////////////////////Funciones del PENDEX XD///////////////////////////////////////////
    public function spListaSintomas($nombreSintoma, $accion) {
        parent::ConnectionOpen("pnsListaSintomas", "dbweb");
        parent::SetParameterSP("$1", $accion);
        parent::SetParameterSP("$2", $nombreSintoma);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spListaCondicionDeIngreso($nomCondicionDeIngreso) {
        parent::ConnectionOpen("pnsListaCondicionIngreso", "dbweb");
        parent::SetParameterSP("$1", "%" . $nomCondicionDeIngreso . "%");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    /*
      public function spListaClasificacionMotivoConsulta($nomClasificacionMotivoConsulta){
      parent::ConnectionOpen("pnsListaClasificacionMotivoConsulta","dbweb");
      parent::SetParameterSP("$1","%".$nomClasificacionMotivoConsulta."%");
      $resultado = parent::executeSPArrayX();
      parent::Close();
      return $resultado;
      } */

    public function spManteMotivosDeConsulta($hacer, $estadoEnVista, $idMotivoConsulta, $idSintomaCie, $idEstadoRegistro, $descSintomaMotivoConsulta, $codProgramacion) {
        parent::ConnectionOpen("pnsManteMotivosDeConsulta", "dbweb");
        parent::SetParameterSP("$1", "1");
        parent::SetParameterSP("$2", $estadoEnVista);
        parent::SetParameterSP("$3", $idMotivoConsulta);
        parent::SetParameterSP("$4", $idSintomaCie);
        parent::SetParameterSP("$5", $idEstadoRegistro);
        parent::SetParameterSP("$6", $descSintomaMotivoConsulta);
        parent::SetParameterSP("$7", $codProgramacion);
        parent::SetParameterSP("$8", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("$9", $_SESSION['host']);
        parent::SetParameterSP("$10", $hacer);
        parent::SetParameterSP("$11", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function historiaMotivoConsulta($idProgramacion) {
        parent::ConnectionOpen("pnsManteMotivosDeConsulta", "dbweb");
        parent::SetParameterSP("$1", "2");
        parent::SetParameterSP("$2", "");
        parent::SetParameterSP("$3", "");
        parent::SetParameterSP("$4", "");
        parent::SetParameterSP("$5", "");
        parent::SetParameterSP("$6", "");
        parent::SetParameterSP("$7", $idProgramacion);
        parent::SetParameterSP("$8", "");
        parent::SetParameterSP("$9", "");
        parent::SetParameterSP("$10", "");
        parent::SetParameterSP("$11", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function hstrMotivoConsulta($idPaciente) {
        parent::ConnectionOpen("pnsManteMotivosDeConsulta", "dbweb");
        parent::SetParameterSP("$1", "3");
        parent::SetParameterSP("$2", "");
        parent::SetParameterSP("$3", "");
        parent::SetParameterSP("$4", "");
        parent::SetParameterSP("$5", "");
        parent::SetParameterSP("$6", "");
        parent::SetParameterSP("$7", "");
        parent::SetParameterSP("$8", "");
        parent::SetParameterSP("$9", "");
        parent::SetParameterSP("$10", "");
        parent::SetParameterSP("$11", $idPaciente);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function obtenerCodigoPaciente($idpersona) {
        parent::ConnectionOpen("pnsManteMotivosDeConsulta", "dbweb");
        parent::SetParameterSP("$1", "4");
        parent::SetParameterSP("$2", "");
        parent::SetParameterSP("$3", "");
        parent::SetParameterSP("$4", "");
        parent::SetParameterSP("$5", "");
        parent::SetParameterSP("$6", "");
        parent::SetParameterSP("$7", "");
        parent::SetParameterSP("$8", "");
        parent::SetParameterSP("$9", "");
        parent::SetParameterSP("$10", $idpersona);
        parent::SetParameterSP("$11", "");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spEliminarMotivosDeConsulta($idMotivoConsulta) {
        parent::ConnectionOpen("pnsEliminarMotivosDeConsulta", "dbweb");
        parent::SetParameterSP("$1", $idMotivoConsulta);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spListaMotivoDeConsulta($accion, $codigoPaciente) {
        parent::ConnectionOpen("pnsListaMotivoDeConsulta", "dbweb");
        parent::SetParameterSP("$1", $accion);
        parent::SetParameterSP("$2", $codigoPaciente);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spListaExamenMedico($nomExamen, $idVersion, $idEstadoDesarrollo) {
        parent::ConnectionOpen("pnsListaExamenMedico", "dbweb");
        parent::SetParameterSP("$1", "%" . $nomExamen . "%");
        parent::SetParameterSP("$2", $idVersion);
        parent::SetParameterSP("$3", $idEstadoDesarrollo);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spListaExamenPorServicio($codServicio, $idVersion, $idEstadoDesarrollo, $iCodigoProgramacion) {
        parent::ConnectionOpen("pnsListaExamenPorServicio", "dbweb");
        parent::SetParameterSP("$1", $codServicio);
        parent::SetParameterSP("$2", $idVersion);
        parent::SetParameterSP("$3", $idEstadoDesarrollo);
        parent::SetParameterSP("$4", $iCodigoProgramacion);
        $resultado = parent::executeSPArrayX();
        echo "<br>di";
        var_dump($resultado);
        echo "<br>di";
        parent::Close();
        return $resultado;
    }

    public function spListaExamenPorServicioPediatrico($codServicio, $idVersion, $idEstadoDesarrollo, $iCodigoProgramacion,$mesesNacimiento) {
        parent::ConnectionOpen("pnsListaExamenPorServicioPediatrico", "dbweb");
        parent::SetParameterSP("$1", $codServicio);
        parent::SetParameterSP("$2", $idVersion);
        parent::SetParameterSP("$3", $idEstadoDesarrollo);
        parent::SetParameterSP("$4", $iCodigoProgramacion);
         parent::SetParameterSP("$5", $mesesNacimiento);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spListaVersionExamenDeProduccion() {
        parent::ConnectionOpen("pnsListaVersionExamenDeProduccion", "dbweb");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dArregloDientes($datos) {
        parent::ConnectionOpen("pnsPuntosDientes", "dbweb");
        parent::SetParameterSP("opcion", 1);
        parent::SetParameterSP("int1", '0');
        parent::SetParameterSP("int2", '0');
        parent::SetParameterSP("int3", '');
        parent::SetParameterSP("char1", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dObtenerTipoDiagnostico($datos) {
        parent::ConnectionOpen("pnsPuntosDientes", "dbweb");
        parent::SetParameterSP("opcion", 5);
        parent::SetParameterSP("int1", $datos["idDiagnostico"]);
        parent::SetParameterSP("int2", '0');
        parent::SetParameterSP("int3", '');
        parent::SetParameterSP("char1", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dArregloCarasDientes($datos) {
        parent::ConnectionOpen("pnsPuntosDientes", "dbweb");
        parent::SetParameterSP("opcion", 2);
        parent::SetParameterSP("int1", '0');
        parent::SetParameterSP("int2", '0');
        parent::SetParameterSP("int3", '');
        parent::SetParameterSP("char1", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dArrayImagenesSimbolos($datos) {
        parent::ConnectionOpen("pnsPuntosDientes", "dbweb");
        parent::SetParameterSP("opcion", 3);
        parent::SetParameterSP("int1", '0');
        parent::SetParameterSP("int2", '0');
        parent::SetParameterSP("int3", '');
        parent::SetParameterSP("char1", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dArraySimboloHistorial($c_cod_per) {
        parent::ConnectionOpen("pnsPuntosDientes", "dbweb");
        parent::SetParameterSP("opcion", 8);
        parent::SetParameterSP("int1", '0');
        parent::SetParameterSP("int2", '0');
        parent::SetParameterSP("int3", '');
        parent::SetParameterSP("char1", $c_cod_per);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dHistoriaCara($c_cod_per) {
        parent::ConnectionOpen("pnsPuntosDientes", "dbweb");
        parent::SetParameterSP("opcion", 9);
        parent::SetParameterSP("int1", '0');
        parent::SetParameterSP("int2", '0');
        parent::SetParameterSP("int3", '');
        parent::SetParameterSP("char1", $c_cod_per);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dPosicionSimbolo($datos) {
        parent::ConnectionOpen("pnsPuntosDientes", "dbweb");
        parent::SetParameterSP("opcion", 4);
        parent::SetParameterSP("int1", $datos["idDiente1"]);
        parent::SetParameterSP("int2", $datos["idAntecedenteOdontograma"]);
        parent::SetParameterSP("int3", '');
        parent::SetParameterSP("char1", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dHistorialDiente($iCodigoProgramacion) {
        parent::ConnectionOpen("pnsPuntosDientes", "dbweb");
        parent::SetParameterSP("opcion", 7);
        parent::SetParameterSP("int1", $iCodigoProgramacion);
        parent::SetParameterSP("int2", '');
        parent::SetParameterSP("int3", '');
        parent::SetParameterSP("char1", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dPosicionSimboloDoble($datos) {
        parent::ConnectionOpen("pnsPuntosDientes", "dbweb");
        parent::SetParameterSP("opcion", 6);
        parent::SetParameterSP("int1", $datos["idDiente1"]);
        parent::SetParameterSP("int2", $datos["idDiente2"]);
        parent::SetParameterSP("int3", $datos["idAntecedenteOdontograma"]);
        parent::SetParameterSP("char1", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spListaServiciosPorActividadDeCCosto($opcion, $iidCentroCosto, $codActividad, $nomServicio) {
//parent::ConnectionOpen("pnsListaServiciosPorCentroCosto","dbweb");
        parent::ConnectionOpen("pnsListaServiciosPorActividadDeCentroCosto", "dbweb");
        parent::SetParameterSP("opcion", $opcion);
        parent::SetParameterSP("iidCentroCosto", $iidCentroCosto);
        parent::SetParameterSP("codActividad", $codActividad);
        parent::SetParameterSP("nomServicio", $nomServicio);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spListaTipoDeServicio($nomTipoServicio) {
        parent::ConnectionOpen("pnsListaTipoDeServicio", "dbweb");
        parent::SetParameterSP("nomTipoServicio", "%" . $nomTipoServicio . "%");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

///////////////////////////////////////Fin Funciones del PENDEX XD/////////////////////////////////////////
//==============================JCLM==========================================
    public function cargarTablaLaboratorio($codPersona, $opcion) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorio", "dbweb");
        parent::SetParameterSP("opt", '01');
        parent::SetParameterSP("codPersona", $codPersona);
        parent::SetParameterSP("idPaciente", '');
        parent::SetParameterSP("hacer", $opcion);
        $resultado = parent::executeSPArrayX();
        parent::Close();
//echo $opcion;
//print_r($resultado);
        return $resultado;
    }

    public function tablaLaboratorioHc($codPersona) {
        parent::ConnectionOpen("pnsExamenesXpersonaLaboratorio", "dbweb");
        parent::SetParameterSP("bus", '1');
        parent::SetParameterSP("pv1", $codPersona);
        parent::SetParameterSP("pv2", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
//echo $opcion;
//print_r($resultado);
        return $resultado;
    }

    public function DetalletablaLaboratorioHc($IdResult) {
        parent::ConnectionOpen("pnsExamenesXpersonaLaboratorio", "dbweb");
        parent::SetParameterSP("bus", '2');
        parent::SetParameterSP("pv1", $IdResult);
        parent::SetParameterSP("pv2", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
//echo $opcion;
//print_r($resultado);
        return $resultado;
    }

    public function detalleLaboratorio($idresult) {
        parent::ConnectionOpen("Busquedas", "dbo");
        parent::SetParameterSP("opt", '17');
        parent::SetParameterSP("idresult", $idresult);
        parent::SetParameterSP("p3", '');
        parent::SetParameterSP("p4", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function datosPersona($idPaciente, $hacer) {
        parent::ConnectionOpen("pnsMantenimientoLaboratorio", "dbweb");
        parent::SetParameterSP("opt", '02');
        parent::SetParameterSP("codPersona", '');
        parent::SetParameterSP("idPaciente", $idPaciente);
        parent::SetParameterSP("hacer", $hacer);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dAfiliacionCorrecta($datos) {
        parent::ConnectionOpen("pnsActoMedico", "dbweb");
        parent::SetParameterSP("accion", "9");
        parent::SetParameterSP("codigoPersona", '');
        parent::SetParameterSP("mesprogramacion", '');
        parent::SetParameterSP("anioprogramacion", '');
        parent::SetParameterSP("codigocronograma", $datos["codigoPaciente"]);
        parent::SetParameterSP("codigoprogramacion", $datos["codigoProgramacion"]);
        parent::SetParameterSP("cantidadadicionales", "");
        parent::SetParameterSP("codigoambientefisico", "");
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", strtoupper($_SESSION['host']));
        parent::SetParameterSP("vNombreCPT", "");
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function dPreguardarRectaMedica($datos) {
        parent::ConnectionOpen("pnsMantenimientoRecetas", "dbweb");
        parent::SetParameterSP("accion", "1");
        parent::SetParameterSP("idReceta", $datos["iIdReceta"]);
        parent::SetParameterSP("fechaVencimiento", $datos["dFechaVencimiento"]);
        parent::SetParameterSP("idTratamiento", $datos["idTratamiento"]);
        parent::SetParameterSP("c_cod_ser_pro", $datos["c_cod_ser_pro"]);
        parent::SetParameterSP("iCantidad", $datos["iCantidad"]);
        parent::SetParameterSP("vMmodoAplicacion", $datos["vModoAplicacion"]);
        parent::SetParameterSP("tipoReceta", $datos["tipoReceta"]);
        parent::SetParameterSP("iCodigoProgramacion", $datos["codigoProgramacion"]);
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function deleteMedicamentoRecetaMedicaHC($datos) {
        parent::ConnectionOpen("pnsMantenimientoRecetas", "dbweb");
        parent::SetParameterSP("accion", "2");
        parent::SetParameterSP("idReceta", '0');
        parent::SetParameterSP("fechaVencimiento", '');
        parent::SetParameterSP("idTratamiento", $datos["idTratamiento"]);
        parent::SetParameterSP("c_cod_ser_pro", '');
        parent::SetParameterSP("iCantidad", '0');
        parent::SetParameterSP("vMmodoAplicacion", '');
        parent::SetParameterSP("tipoReceta", '0');
        parent::SetParameterSP("iCodigoProgramacion", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

// ================== Grupo Etareo
    function DlistarAfiliacion() {
        parent::ConnectionOpen("pnsGrupoEtario", "dbweb");
        parent::SetParameterSP("accion", "1");
        parent::SetParameterSP("icboAfiliacionGrupoEtario", '');
        parent::SetParameterSP("nombreServicioGrupoEtario", '');
        parent::SetParameterSP("cboTipoServicioCPT", '');
        parent::SetParameterSP("cboPeriodoEdad", '');
        parent::SetParameterSP("txtnEdadToma", '');
        parent::SetParameterSP("txtNroAtenciones", '');
        parent::SetParameterSP("txtiOrder", '');
        parent::SetParameterSP("iIdServicioGrupoEtareo", '');
        parent::SetParameterSP("vMensaje", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function DcargarTablaGrupoEtario($datos) {
        parent::ConnectionOpen("pnsGrupoEtario", "dbweb");
        parent::SetParameterSP("accion", "2");
        parent::SetParameterSP("icboAfiliacionGrupoEtario", $datos["icboAfiliacionGrupoEtario"]);
        parent::SetParameterSP("nombreServicioGrupoEtario", '');
        parent::SetParameterSP("cboTipoServicioCPT", '');
        parent::SetParameterSP("cboPeriodoEdad", '');
        parent::SetParameterSP("txtnEdadToma", '');
        parent::SetParameterSP("txtNroAtenciones", '');
        parent::SetParameterSP("txtiOrder", '');
        parent::SetParameterSP("iIdServicioGrupoEtareo", '');
        parent::SetParameterSP("vMensaje", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function DcargarTablaServicioGrupoEtario($datos) {//$datos["nombreServicioGrupoEtario"]
        parent::ConnectionOpen("pnsGrupoEtario", "dbweb");
        parent::SetParameterSP("accion", "3");
        parent::SetParameterSP("icboAfiliacionGrupoEtario", '');
        parent::SetParameterSP("nombreServicioGrupoEtario", $datos["nombreServicioGrupoEtario"]);
        parent::SetParameterSP("cboTipoServicioCPT", '');
        parent::SetParameterSP("cboPeriodoEdad", '');
        parent::SetParameterSP("txtnEdadToma", '');
        parent::SetParameterSP("txtNroAtenciones", '');
        parent::SetParameterSP("txtiOrder", '');
        parent::SetParameterSP("iIdServicioGrupoEtareo", '');
        parent::SetParameterSP("vMensaje", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function DserviciosSeleccionadoPorGrupoEtario($datos) {//$datos["nombreServicioGrupoEtario"]
        parent::ConnectionOpen("pnsGrupoEtario", "dbweb");
        parent::SetParameterSP("accion", "4");
        parent::SetParameterSP("iGrupoEtario", $datos["idGrupoEtario"]);
        parent::SetParameterSP("nombreServicioGrupoEtario", '');
        parent::SetParameterSP("cboTipoServicioCPT", '');
        parent::SetParameterSP("cboPeriodoEdad", '');
        parent::SetParameterSP("txtnEdadToma", '');
        parent::SetParameterSP("txtNroAtenciones", '');
        parent::SetParameterSP("txtiOrder", '');
        parent::SetParameterSP("iIdServicioGrupoEtareo", '');
        parent::SetParameterSP("vMensaje", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function DlistarPeriodoEdad() {//$datos["nombreServicioGrupoEtario"]
        parent::ConnectionOpen("pnsGrupoEtario", "dbweb");
        parent::SetParameterSP("accion", "5");
        parent::SetParameterSP("iGrupoEtario", '');
        parent::SetParameterSP("nombreServicioGrupoEtario", '');
        parent::SetParameterSP("cboTipoServicioCPT", '');
        parent::SetParameterSP("cboPeriodoEdad", '');
        parent::SetParameterSP("txtnEdadToma", '');
        parent::SetParameterSP("txtNroAtenciones", '');
        parent::SetParameterSP("txtiOrder", '');
        parent::SetParameterSP("iIdServicioGrupoEtareo", '');
        parent::SetParameterSP("vMensaje", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function DlistarTipoServicioCPT() {
        parent::ConnectionOpen("pnsGrupoEtario", "dbweb");
        parent::SetParameterSP("accion", "6");
        parent::SetParameterSP("iGrupoEtario", '');
        parent::SetParameterSP("nombreServicioGrupoEtario", '');

        parent::SetParameterSP("cboTipoServicioCPT", '');
        parent::SetParameterSP("cboPeriodoEdad", '');
        parent::SetParameterSP("txtnEdadToma", '');
        parent::SetParameterSP("txtNroAtenciones", '');
        parent::SetParameterSP("txtiOrder", '');
        parent::SetParameterSP("iIdServicioGrupoEtareo", '');
        parent::SetParameterSP("vMensaje", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function DguardarServicioGrupoEtario($datos) {
        parent::ConnectionOpen("pnsGrupoEtario", "dbweb");
        parent::SetParameterSP("accion", "7");
        parent::SetParameterSP("iGrupoEtario", $datos["iIdGrupoEtario"]);
        parent::SetParameterSP("c_cod_prod", $datos["c_cod_prod"]);

        parent::SetParameterSP("cboTipoServicioCPT", $datos["cboTipoServicioCPT"]);
        parent::SetParameterSP("cboPeriodoEdad", $datos["cboPeriodoEdad"]);
        parent::SetParameterSP("txtnEdadToma", $datos["txtnEdadToma"]);
        parent::SetParameterSP("txtNroAtenciones", $datos["txtNroAtenciones"]);
        parent::SetParameterSP("txtiOrder", $datos["txtiOrder"]);
        parent::SetParameterSP("iIdServicioGrupoEtareo", '');
        parent::SetParameterSP("vMensaje", $datos["vMensaje"]);
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function DLiOrderMax($iIdGrupoEtario) {
        parent::ConnectionOpen("pnsGrupoEtario", "dbweb");
        parent::SetParameterSP("accion", "8");
        parent::SetParameterSP("iGrupoEtario", $iIdGrupoEtario);
        parent::SetParameterSP("c_cod_prod", '');

        parent::SetParameterSP("cboTipoServicioCPT", '');
        parent::SetParameterSP("cboPeriodoEdad", '');
        parent::SetParameterSP("txtnEdadToma", '');
        parent::SetParameterSP("txtNroAtenciones", '');
        parent::SetParameterSP("txtiOrder", '');
        parent::SetParameterSP("iIdServicioGrupoEtareo", '');
        parent::SetParameterSP("vMensaje", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function DeliminarseleccionarServicioGrupoEtario($datos) {
        parent::ConnectionOpen("pnsGrupoEtario", "dbweb");
        parent::SetParameterSP("accion", "9");
        parent::SetParameterSP("iIdServicioGrupoEtareo", $datos["iIdServicioGrupoEtareo"]);
        parent::SetParameterSP("c_cod_prod", '');

        parent::SetParameterSP("iOrden", $datos["iOrden"]);
        parent::SetParameterSP("iIdGrupoEtario", $datos["iIdGrupoEtario"]);
        parent::SetParameterSP("txtnEdadToma", '');
        parent::SetParameterSP("txtNroAtenciones", '');
        parent::SetParameterSP("txtiOrder", '');
        parent::SetParameterSP("iIdServicioGrupoEtareo", '');
        parent::SetParameterSP("vMensaje", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    //----------------------------EQUIVALENCIAS CPT-------------------------------------------
//----------------------------------------------------------------------------------------

    function DCarteraobtenerEdadPersona($datos) {
        parent::ConnectionOpen("pnsCTPServicios", "dbweb");
        parent::SetParameterSP("accion", "1");
        parent::SetParameterSP("1", $datos["codigoPersona"]);
        parent::SetParameterSP("2Varchar", $datos["servicio"]);

        parent::SetParameterSP("3", $datos["codigoProgramacion"]);
        parent::SetParameterSP("4", $datos["iIdGrupoEtarioPersonas"]);
        parent::SetParameterSP("5", $datos["iIdGrupoEtareo"]);
        parent::SetParameterSP("6", '');
        parent::SetParameterSP("7", '');

        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function dObtenerPaquetesPersona($cod_per) {
        parent::ConnectionOpen("pnsCTPServicios", "dbweb");
        parent::SetParameterSP("accion", "5");
        parent::SetParameterSP("1", '');
        parent::SetParameterSP("2Varchar", $cod_per);

        parent::SetParameterSP("3", '');
        parent::SetParameterSP("4", '');
        parent::SetParameterSP("5", '');
        parent::SetParameterSP("6", '');
        parent::SetParameterSP("7", '');

        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function dVerificarPaqueteEtareo($datos) {
        parent::ConnectionOpen("pnsCTPServicios", "dbweb");
        parent::SetParameterSP("accion", "6");
        parent::SetParameterSP("1", $datos["cie"]);
        parent::SetParameterSP("2Varchar", $datos["c_cod_per"]);

        parent::SetParameterSP("3", '');
        parent::SetParameterSP("4", '');
        parent::SetParameterSP("5", '');
        parent::SetParameterSP("6", '');
        parent::SetParameterSP("7", '');

        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function dCargarPaqueteDiagnostico($datos) {
        parent::ConnectionOpen("pnsCTPServicios", "dbweb");
        parent::SetParameterSP("accion", "7");
        parent::SetParameterSP("1", $datos["idGrupoEtaero"]);
        parent::SetParameterSP("2Varchar", $datos["c_cod_per"]);

        parent::SetParameterSP("3", '');
        parent::SetParameterSP("4", '');
        parent::SetParameterSP("5", '');
        parent::SetParameterSP("6", '');
        parent::SetParameterSP("7", '');

        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

//----------------------------------------------------------------------------------------   
//----------------------------EQUIVALENCIAS CPT-------------------------------------------
//----------------------------------------------------------------------------------------


    function DCargarTablaMxserpro($datos) {
        parent::ConnectionOpen("pnsMantenimientoCPT", "dbweb");
        parent::SetParameterSP("accion", "3");
        parent::SetParameterSP("vNombreCPT", '');
        parent::SetParameterSP("mxSerpro", '');
        parent::SetParameterSP("iIdCPT", '');
        parent::SetParameterSP("v_desc_ser_pro", $datos["nombreMxserpro"]);
        parent::SetParameterSP("CodigoCPT", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        parent::SetParameterSP("bit", '');
        parent::SetParameterSP("int", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function DbuscarTablaCPT($datos) {
        parent::ConnectionOpen("pnsMantenimientoCPT", "dbweb");
        parent::SetParameterSP("accion", "1");
        parent::SetParameterSP("nombreCTP", $datos["nombreCTP"]);
        parent::SetParameterSP("mxSerpro", '');
        parent::SetParameterSP("iIdCPT", '');
        parent::SetParameterSP("v_desc_ser_pro", '');
        parent::SetParameterSP("CodigoCPT", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        parent::SetParameterSP("bit", '');
        parent::SetParameterSP("int", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function DbuscarCPTcod($datos) {
        parent::ConnectionOpen("pnsMantenimientoCPT", "dbweb");
        parent::SetParameterSP("accion", "4");
        parent::SetParameterSP("nombreCTP", '');
        parent::SetParameterSP("mxSerpro", '');
        parent::SetParameterSP("iIdCPT", $datos["iIdCPT"]);
        parent::SetParameterSP("v_desc_ser_pro", '');
        parent::SetParameterSP("CodigoCPT", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        parent::SetParameterSP("bit", '');
        parent::SetParameterSP("int", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function DbuscarMxSerProcod($datos) {
        parent::ConnectionOpen("pnsMantenimientoCPT", "dbweb");
        parent::SetParameterSP("accion", "5");
        parent::SetParameterSP("vNombreCPT", '');
        parent::SetParameterSP("mxSerpro", $datos["codMxserpro"]);
        parent::SetParameterSP("iIdCPT", '');
        parent::SetParameterSP("v_desc_ser_pro", '');
        parent::SetParameterSP("CodigoCPT", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        parent::SetParameterSP("bit", '');
        parent::SetParameterSP("int", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function DexamenesRelacionados($datos) {
        parent::ConnectionOpen("pnsMantenimientoCPT", "dbweb");
        parent::SetParameterSP("accion", "6");
        parent::SetParameterSP("vNombreCPT", '');
        parent::SetParameterSP("mxSerpro", '');
        parent::SetParameterSP("iIdCPT", $datos["iIdCPT"]);
        parent::SetParameterSP("v_desc_ser_pro", '');
        parent::SetParameterSP("CodigoCPT", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        parent::SetParameterSP("bit", '');
        parent::SetParameterSP("int", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function cambiarEstadoServicioRelacionado($datos) {
        parent::ConnectionOpen("pnsMantenimientoCPT", "dbweb");
        parent::SetParameterSP("accion", "7");
        parent::SetParameterSP("vNombreCPT", '');
        parent::SetParameterSP("mxSerpro", '');
        parent::SetParameterSP("iIdCPT", '');
        parent::SetParameterSP("v_desc_ser_pro", '');
        parent::SetParameterSP("CodigoCPT", '');
        parent::SetParameterSP("vUsuario", '');
        parent::SetParameterSP("vHostname", '');
        parent::SetParameterSP("bit", $datos['bEstado']);
        parent::SetParameterSP("int", $datos['iIdRelacion']);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------

    function verificarCantidadVersionImagenXHistoriaDiente($datos) {
        parent::ConnectionOpen("nsmGrabarImagenHistoriaDiente", "dbweb");
        parent::SetParameterSP("bus", "2");
        parent::SetParameterSP("var1", $datos['IdHistoriaDiente']);
        parent::SetParameterSP("var2", '');
        parent::SetParameterSP("var3", '');
        parent::SetParameterSP("var4", '');
        parent::SetParameterSP("var5", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function grabarImagenHistoriaDiente($datos) {
        parent::ConnectionOpen("nsmGrabarImagenHistoriaDiente", "dbweb");
        parent::SetParameterSP("bus", "1");
        parent::SetParameterSP("var1", $datos['id']);
        parent::SetParameterSP("var2", $datos['url']);
        parent::SetParameterSP("var3", $datos['height']);
        parent::SetParameterSP("var4", $datos['width']);
        parent::SetParameterSP("var5", $datos['version']);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function updateObsHistoriaDiente($datos) {
        parent::ConnectionOpen("nsmGrabarImagenHistoriaDiente", "dbweb");
        parent::SetParameterSP("bus", "3");
        parent::SetParameterSP("var1", $datos['obs']);
        parent::SetParameterSP("var2", $datos['id']);
        parent::SetParameterSP("var3", '');
        parent::SetParameterSP("var4", '');
        parent::SetParameterSP("var5", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function updateCarasDiente($datos) {
        parent::ConnectionOpen("nsmGrabarImagenHistoriaDiente", "dbweb");
        parent::SetParameterSP("bus", "4");
        parent::SetParameterSP("var1", $datos['idDiente']);
        parent::SetParameterSP("var2", $datos['idCara']);
        parent::SetParameterSP("var3", $datos['Bit']);
        parent::SetParameterSP("var4", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("var5", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function DguardarRegistroServicio($datos) {
        parent::ConnectionOpen("pnsMantenimientoCPT", "dbweb");
        parent::SetParameterSP("accion", "2");
        parent::SetParameterSP("vNombreCPT", '');
        parent::SetParameterSP("mxSerpro", $datos["mxSerpro"]);
        parent::SetParameterSP("iIdCPT", $datos["iIdCPT"]);
        parent::SetParameterSP("v_desc_ser_pro", $datos["nombreMxserpro"]);
        parent::SetParameterSP("CodigoCPT", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        parent::SetParameterSP("bit", '');
        parent::SetParameterSP("int", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function DcargarServiciosDuplicados($datos) {
        parent::ConnectionOpen("pnsCTPServicios", "dbweb");
        parent::SetParameterSP("accion", "2");
        parent::SetParameterSP("1", '');
        parent::SetParameterSP("2Varchar", $datos["codigoCTP"]);

        parent::SetParameterSP("3", $datos["nroAte"]);
        parent::SetParameterSP("4", $datos["iGrupoEtario"]);
        parent::SetParameterSP("5", '');
        parent::SetParameterSP("6", '');
        parent::SetParameterSP("7", '');

        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function DActualizarGrupoEtareoPersonaConfirmado($datos) {
        parent::ConnectionOpen("pnsCTPServicios", "dbweb");
        parent::SetParameterSP("accion", "8");
        parent::SetParameterSP("1", $datos["iIdGrupoEtareoPersonas"]);
        parent::SetParameterSP("2Varchar", '');
        parent::SetParameterSP("3", '');
        parent::SetParameterSP("4", '');
        parent::SetParameterSP("5", '');
        parent::SetParameterSP("6", '');
        parent::SetParameterSP("7", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function DactualizarEstadoDeServicioGrupoEtarioPersona($datos) {
        parent::ConnectionOpen("pnsCTPServicios", "dbweb");
        parent::SetParameterSP("accion", "3");
        parent::SetParameterSP("1", $datos["iIdServicioGrupoEtareoPersona"]);
        parent::SetParameterSP("2Varchar", '');
        parent::SetParameterSP("3", $datos["iCantidad"]);
        parent::SetParameterSP("4", '');
        parent::SetParameterSP("5", '');
        parent::SetParameterSP("6", '');
        parent::SetParameterSP("7", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function DestadoPaquete($idtratamiento) {
        parent::ConnectionOpen("pnsCTPServicios", "dbweb");
        parent::SetParameterSP("accion", "4");
        parent::SetParameterSP("1", $idtratamiento);
        parent::SetParameterSP("2Varchar", '');

        parent::SetParameterSP("3", '');
        parent::SetParameterSP("4", '');
        parent::SetParameterSP("5", '');
        parent::SetParameterSP("6", '');
        parent::SetParameterSP("7", '');

        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function comboFechaAtenciones($c_cod_per) {
        parent::ConnectionOpen("pnsHistoriaOdontograma", "dbweb");
        parent::SetParameterSP("opcion", 1);
        parent::SetParameterSP("var1", $c_cod_per);
        parent::SetParameterSP("var2", '');
        parent::SetParameterSP("var3", '');
        parent::SetParameterSP("var4", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function comboDientesAtenciones($c_cod_per) {
        parent::ConnectionOpen("pnsHistoriaOdontograma", "dbweb");
        parent::SetParameterSP("opcion", 2);
        parent::SetParameterSP("var1", $c_cod_per);
        parent::SetParameterSP("var2", '');
        parent::SetParameterSP("var3", '');
        parent::SetParameterSP("var4", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    //-------------------------------------------------------------------
    function DmostrarLeyenda($datos) {
        parent::ConnectionOpen("pnsLeyendaOdontograma", "dbweb");
        parent::SetParameterSP("accion", "1");
        parent::SetParameterSP("iCodigoProgramacion", $datos["codProgramacion"]);
        parent::SetParameterSP("CodigoPersona", '');
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function DhistoriaLeyenda($datos) {
        parent::ConnectionOpen("pnsLeyendaOdontograma", "dbweb");
        parent::SetParameterSP("accion", "2");
        parent::SetParameterSP("iCodigoProgramacion", $datos["CodProgramacionHistoria"]);
        parent::SetParameterSP("CodigoPersona", $datos["CodPersona"]);
        parent::SetParameterSP("user", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function listarHistoriaOdontogramaxPersona($datos) {
        parent::ConnectionOpen("pnsHistoriaOdontograma", "dbweb");
        parent::SetParameterSP("opcion", 3);
        parent::SetParameterSP("var1", $datos['codPersona']);
        parent::SetParameterSP("var2", '');
        parent::SetParameterSP("var3", '');
        parent::SetParameterSP("var4", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function listadoHistoriaDiente($idPrograma) {
        parent::ConnectionOpen("pnsImprimirHcXDia", "dbweb");
        parent::SetParameterSP("opcion", 3);
        parent::SetParameterSP("var1", $idPrograma);
        parent::SetParameterSP("var2", '');
        parent::SetParameterSP("var3", '');
        parent::SetParameterSP("var4", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function dListaImagenesOdontograma($idPrograma) {
        parent::ConnectionOpen("pnsImprimirHcXDia", "dbweb");
        parent::SetParameterSP("opcion", 3);
        parent::SetParameterSP("var1", $idPrograma);
        parent::SetParameterSP("var2", '');
        parent::SetParameterSP("var3", '');
        parent::SetParameterSP("var4", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function obtenerlistaAsignadasAFiliacion($datos) {
        parent::ConnectionOpen("pnsMantenimientoDeModulosPorServicio", "dbweb");
        parent::SetParameterSP("bus", '8');
        parent::SetParameterSP("pv1", $datos["idAfiliacion"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", '');
        parent::SetParameterSP("pv4", '');
        parent::SetParameterSP("pv5", '');
        parent::SetParameterSP("pv6", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function obtenerlistaANoAsignadasAfiliacion($datos) {
        parent::ConnectionOpen("pnsMantenimientoDeModulosPorServicio", "dbweb");
        parent::SetParameterSP("bus", '9');
        parent::SetParameterSP("pv1", $datos["idAfiliacion"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", '');
        parent::SetParameterSP("pv4", '');
        parent::SetParameterSP("pv5", '');
        parent::SetParameterSP("pv6", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function eliminarAnterioresSeleccionadosAfiliaciones($datos) {
        parent::ConnectionOpen("pnsMantenimientoDeModulosPorServicio", "dbweb");
        parent::SetParameterSP("bus", '10');
        parent::SetParameterSP("pv1", $datos['iIdAfiliacion']);
        parent::SetParameterSP("pv2", '');
        parent::SetParameterSP("pv3", '');
        parent::SetParameterSP("pv4", '');
        parent::SetParameterSP("pv5", '');
        parent::SetParameterSP("pv6", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function guardarNuevaSeleccionAfiliaciones($datos) {
        $arrayDatos = explode("|", $datos["cadena"]);
        $arrayNumero = explode("|", $datos["numero"]);
        $numGrabaciones = count($arrayDatos);


        for ($x = 0; $x <= $numGrabaciones - 1; $x++) {
            parent::Liberar_Parametros();
            parent::ConnectionOpen("pnsMantenimientoDeModulosPorServicio", "dbweb");
            parent::SetParameterSP("bus", '11');
            parent::SetParameterSP("pv1", $datos['iIdAfiliacion']);
            parent::SetParameterSP("pv2", $arrayDatos[$x]);
            parent::SetParameterSP("pv3", strtoupper($_SESSION["login_user"]));
            parent::SetParameterSP("pv4", $_SESSION['host']);
            parent::SetParameterSP("pv5", "");
            parent::SetParameterSP("pv6", '');
            $resultadoArray = parent::executeSPArrayX();
            parent::ConnectionClose();
        }
        return $resultadoArray;
    }

    function arrayDatosConsultaCitaHistoria($datos) {
        parent::ConnectionOpen("pnsProgramacionCitasHistoriaConsultorio", "dbweb");
        parent::SetParameterSP("var1", $datos['codigoProgramacion']);
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function dCargarTablaProcedientosConsulta($resultadoDatos) {
//               print_r($resultadoDatos);
//               echo 'aaaaaa';
        parent::ConnectionOpen("pnsDetalleOrden", "dbweb");
        parent::SetParameterSP("accion", "1");
        parent::SetParameterSP("codigoPersona", $resultadoDatos[0]["cCodigoPersona"]);
        parent::SetParameterSP("nroOrden", $resultadoDatos[0]["c_nro_doc"]);
        parent::SetParameterSP("vNombreUsuario", "");
        parent::SetParameterSP("iCodigoProgramacion", $resultadoDatos[0]["iCodigoProgramacion"]);
        parent::SetParameterSP("idCronogramaMedico", "");
        parent::SetParameterSP("vNombreEstacion", "");
        parent::SetParameterSP("@codidoCentroCosto", "");
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function DmodificarServicioGrupoEtario($datos) {
        parent::ConnectionOpen("pnsGrupoEtario", "dbweb");
        parent::SetParameterSP("accion", "10");
        parent::SetParameterSP("iGrupoEtario", $datos["iIdGrupoEtario"]);
        parent::SetParameterSP("c_cod_prod", $datos["c_cod_prod"]);

        parent::SetParameterSP("cboTipoServicioCPT", $datos["cboTipoServicioCPT"]);
        parent::SetParameterSP("cboPeriodoEdad", $datos["cboPeriodoEdad"]);
        parent::SetParameterSP("txtnEdadToma", $datos["txtnEdadToma"]);
        parent::SetParameterSP("txtNroAtenciones", $datos["txtNroAtenciones"]);
        parent::SetParameterSP("txtiOrder", $datos["txtiOrder"]);
        parent::SetParameterSP("iIdServicioGrupoEtareo", $datos["iIdServicioGrupoEtareo"]);
        parent::SetParameterSP("vMensaje", $datos["vMensaje"]);
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function DactualizarEstadoObligatorio($datos) {
        parent::ConnectionOpen("pnsGrupoEtario", "dbweb");
        parent::SetParameterSP("accion", "11");
        parent::SetParameterSP("iGrupoEtario", '');
        parent::SetParameterSP("c_cod_prod", '');

        parent::SetParameterSP("cboTipoServicioCPT", '');
        parent::SetParameterSP("cboPeriodoEdad", '');
        parent::SetParameterSP("txtnEdadToma", '');
        parent::SetParameterSP("txtNroAtenciones", '');
        parent::SetParameterSP("estado", $datos["estado"]);
        parent::SetParameterSP("iIdServicioGrupoEtareo", $datos["iIdServicioGrupoEtareo"]);
        parent::SetParameterSP("vMensaje", $datos["vMensaje"]);
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function dProcedimientosCitaReporte($idPrograma) {
        parent::ConnectionOpen("nsmImprimirReporteHistoriaXDia", "dbweb");
        parent::SetParameterSP("opcion", '3');
        parent::SetParameterSP("var1", $idPrograma);
        parent::SetParameterSP("var2", "");
        parent::SetParameterSP("var3", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dFirmaMedico($idPrograma) {
        parent::ConnectionOpen("nsmImprimirReporteHistoriaXDia", "dbweb");
        parent::SetParameterSP("opcion", '4');
        parent::SetParameterSP("var1", $idPrograma);
        parent::SetParameterSP("var2", "");
        parent::SetParameterSP("var3", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function nsmModulosPorAfiliacion($datos) {
        parent::ConnectionOpen("pnsMantenimientoHC", "dbweb");
        parent::SetParameterSP("accion", '7');
        parent::SetParameterSP("codigoProgramacion", '');
        parent::SetParameterSP("codigoPaciente", '');
        parent::SetParameterSP("codigoServicio", $datos["cIdAfiliacion"]);
        parent::SetParameterSP("proximacitasugerida", "");
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function nsmModulosporServicio($datos) {
        parent::ConnectionOpen("pnsMantenimientoHC", "dbweb");
        parent::SetParameterSP("accion", '8');
        parent::SetParameterSP("codigoProgramacion", '');
        parent::SetParameterSP("codigoPaciente", '');
        parent::SetParameterSP("codigoServicio", $datos["c_cod_ser_pro"]);
        parent::SetParameterSP("proximacitasugerida", "");
        parent::SetParameterSP("usuario", '');
        parent::SetParameterSP("host", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function aCargarDatosPareElGraficoHistoriaTriaje($datos) {
        parent::ConnectionOpen("pnsReporteHistoriaTriajePaciente", "dbweb");
        parent::SetParameterSP("iOpcion", $datos['iNumeroObcion']);
        parent::SetParameterSP("iCodigoPaciente", $datos['iCodigoPaciente']);
        parent::SetParameterSP("iDesde", $datos['cbxDesde']);
        parent::SetParameterSP("iHasta", $datos['cbxHasta']);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dInsertaActualizaSintomatico($datos) {
        parent::ConnectionOpen("pnsSintomaticoRespiratorio", "dbweb");
        parent::SetParameterSP("iOpcion", 1);
        parent::SetParameterSP("iCodigoProgramacion", $datos['iCodigoProgramacion']);
        parent::SetParameterSP("iSintoma", $datos['iSintomatico']);
        parent::SetParameterSP("iNumeroDias", $datos['iNumeroDias']);
        parent::SetParameterSP("vHost", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vUser", strtoupper($_SESSION['host']));
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dActualizarNumeroDiasSintomatico($datos) {
        parent::ConnectionOpen("pnsSintomaticoRespiratorio", "dbweb");
        parent::SetParameterSP("iOpcion", 2);
        parent::SetParameterSP("iCodigoProgramacion", $datos['iCodigoProgramacion']);
        parent::SetParameterSP("iSintoma", $datos['iSintomatico']);
        parent::SetParameterSP("iNumeroDias", $datos['iNumeroDias']);
        parent::SetParameterSP("vHost", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vUser", strtoupper($_SESSION['host']));
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dListarSintomaticos($datos) {
        parent::ConnectionOpen("pnsSintomaticoRespiratorio", "dbweb");
        parent::SetParameterSP("iOpcion", 3);
        parent::SetParameterSP("iCodigoProgramacion", $datos['codigoProgramacion']);
        parent::SetParameterSP("iSintoma", '');
        parent::SetParameterSP("iNumeroDias", '');
        parent::SetParameterSP("vHost", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vUser", strtoupper($_SESSION['host']));
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function dGenerarSintomaticoRespiratorio($datos) {
        parent::ConnectionOpen("pnsSintomaticoRespiratorio", "dbweb");
        parent::SetParameterSP("iOpcion", 4);
        parent::SetParameterSP("iCodigoProgramacion", $datos['codigoProgramacion']);
        parent::SetParameterSP("iSintoma", $datos['iSintomatico']);
        parent::SetParameterSP("iNumeroDias", $datos['iNumeroDias']);
        parent::SetParameterSP("vHost", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vUser", strtoupper($_SESSION['host']));
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }

    function lstListarNumeroIFExistePlaca($idPrograma) {
        parent::ConnectionOpen("pnsMantenimientoImagenes", "dbweb");
        parent::SetParameterSP("@var1", 2);
        parent::SetParameterSP("@var2", $idPrograma);
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
