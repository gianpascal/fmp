<?php

require_once("../../../pholivo/tablaDHTMLX.php");
require_once("../../clogica/LHospitalizacion.php");
require_once("../../clogica/LPersona.php");

class ActionHospitalizacion {

    public function __construct() {
        
    }

    public function mostrarHospitalizados() {
        require_once '../../cvista/Hospitalizacion/hospitalizacion.php';
    }

    public function NuevoPaciente() {
        $oLRnuevoPaciente = new LHospitalizacion();
        $resultadosDestino = $oLRnuevoPaciente->comboDestinoHost();
        //$resultadosDiagnostico = $oLRnuevoPaciente->comboDiagnostico();
     $resultadoHora = $oLRnuevoPaciente->NuevoPacienteHora();

        require_once '../../cvista/Hospitalizacion/nuevoPaciente.php';
    }

    public function nuevoPacienteHospitalizacion() {

        require_once '../../cvista/Hospitalizacion/buscarPersona.php';
    }

    public function busquedaPaciente($datos) {

        $oLRnuevoPaciente = new LHospitalizacion();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRnuevoPaciente->busquedaPaciente($datos); //$arrayFilas = $oLActoMedico->cargaTratamientosAnteriores($datos);


        $arrayCabecera = array(0 => "Codigo Persona", 1 => "Apellido Paterno", 2 => "Apellido Materno", 3 => "Nombre Completo", 4 => "Edad", 5 => "Sexo", 6 => "cod_filiacion", 
                         7 => "Descripcion_filiacion", 8 => "Codigo_Paciente", 9 => "Codigo_AmbFisico", 10 => "Nomb-Amb-Logico", 11 => "Codigo_AmbLogico", 12 => "Codigo_Actividad"
                        ,13 => "iidCentroCosto", 14 => "vDescripcionCCosto");
        $arrayTamano = array(0 => "100", 1 => "120", 2 => "120", 3 => "150", 4 => "150", 5 => "65", 6 => "50", 7 => "150", 8 => "100", 9 => "50", 10 => "150", 11 => "100", 12 => "100", 13 => "100", 14 => "100");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro", 9 => "ro", 10 => "ro", 11 => "ro", 12 => "ro", 13 => "ro", 14 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default"
                             , 9 => "default", 10 => "default", 11 => "default", 12 => "default", 13 => "default", 14 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false", 6 => "false", 7 => "false", 8 => "false"
                         , 9 => "false", 10 => "false", 11 => "false", 12 => "true", 13 => "false", 14 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "center", 6 => "center", 7 => "center", 8 => "center"
                        , 9 => "center", 10 => "center", 11 => "center", 12 => "center", 13 => "center", 14 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
       
    }

    public function busquedaMedicotratante() {

        require_once '../../cvista/Hospitalizacion/MedicoTratante.php';
    }

    public function busquedaPersonaMedicoTratante($datos) {

        $oLRnuevoPaciente = new LHospitalizacion();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRnuevoPaciente->busquedaPersonaMedicoTratante($datos); //$arrayFilas = $oLActoMedico->cargaTratamientosAnteriores($datos);

        $arrayCabecera = array(0 => "CodigoPersona", 1 => "Apellido Paterno", 2 => "Apellido Materno", 3 => "Nombre Completo", 4 => "idEmpleado");
        $arrayTamano = array(0 => "120", 1 => "150", 2 => "150", 3 => "150", 4 => "150");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function busquedaMedicoOrdInt() {
        require_once '../../cvista/Hospitalizacion/MedicoOrdInt.php';
    }

    public function busquedaPersonaMedicoOrdInt($datos) {

        $oLRnuevoPaciente = new LHospitalizacion();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRnuevoPaciente->busquedaPersonaMedicoOrdInt($datos); //$arrayFilas = $oLActoMedico->cargaTratamientosAnteriores($datos);
        $arrayCabecera = array(0 => "CodigoPersona", 1 => "Apellido Paterno", 2 => "Apellido Materno", 3 => "Nombre Completo", 4 => "idEmpleado");
        $arrayTamano = array(0 => "120", 1 => "150", 2 => "150", 3 => "150", 4 => "150");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function busquedaMedicoAlta() {
        require_once '../../cvista/Hospitalizacion/MedicoAlta.php';
    }

    public function busquedaPersonaMedicoAlta($datos) {

        $oLRnuevoPaciente = new LHospitalizacion();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLRnuevoPaciente->busquedaPersonaMedicoAlta($datos); //$arrayFilas = $oLActoMedico->cargaTratamientosAnteriores($datos);

        $arrayCabecera = array(0 => "CodigoPersona", 1 => "Apellido Paterno", 2 => "Apellido Materno", 3 => "Nombre Completo", 4 => "idEmpleado");
        $arrayTamano = array(0 => "120", 1 => "150", 2 => "150", 3 => "150", 4 => "150");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function cboAmbienteFisico($idPisos) {
        $oLRnuevoPaciente = new LHospitalizacion();
        $resultadosAmbienteFisico = $oLRnuevoPaciente->cboAmbienteFisico($idPisos);
        $combo = '<select name="cboAmbienteFisico" id="cboAmbienteFisico" style="width: 180px;" onchange="cboCama()">';
        $combo.='<option value=""  >Seleccionar Ambiente Fisico</option>';
        foreach ($resultadosAmbienteFisico as $i => $value) {
            if ($idPisos != 0) {
                $combo.='<option value="' . $value[0] . '"';
                $combo.=' >';
                $combo.=htmlentities($value[2]) . '</option>';
            }
        }
        return $combo;
    }

    public function cboCama($idAmbienteFisico) {
        $oLRnuevoPaciente = new LHospitalizacion();
        if ($idAmbienteFisico != '') {
            $resultadosCama = $oLRnuevoPaciente->cboCama($idAmbienteFisico);
        }
        $combo = '<select name="cboCamaT" id="cboCamaT" style="width: 100px;">';
        $combo.='<option value=""  >Seleccionar Cama</option>';
        foreach ($resultadosCama as $i => $value) {
            if ($idAmbienteFisico != '') {
                $combo.='<option value="' . $value[0] . '"';
                $combo.=' >';
                $combo.=htmlentities($value[1]) . '</option>';
            }
        }
        return $combo;
    }

    public function PacienteGuardarHospitalizacion($datos) {
        $oLRnuevoPaciente = new LHospitalizacion();
        $resultados = $oLRnuevoPaciente->PacienteGuardarHospitalizacion($datos);
    }

    public function BorrarHospitalizacion($CodigoHospitalizacion) {
        $oLRnuevoPaciente = new LHospitalizacion();
        $resultados = $oLRnuevoPaciente->BorrarHospitalizacion($CodigoHospitalizacion);
    }

    public function BuscarHospitalizacion($datos) {
        $oLRnuevoPaciente = new LHospitalizacion();
        $estadosHospitalizacion = $oLRnuevoPaciente->EstadosHospitalizacion();

        $resultados = $oLRnuevoPaciente->Hospitalizacion($datos);
        $oLRhospitalizacionEspecialidad = new LHospitalizacion();
        foreach ($resultados as $k => $valuek) {

            $resultadosCama = $oLRhospitalizacionEspecialidad->AmbienteCama($valuek[8]);
            array_push($resultados[$k], $resultadosCama);
        }
        foreach ($resultados as $a => $valuea) {
            $resultadosDestino = $oLRhospitalizacionEspecialidad->comboDestinoHost();
            array_push($resultados[$a], $resultadosDestino);
        }

        foreach ($resultados as $b => $valueb) {
            $resultadosAmbFisico = $oLRhospitalizacionEspecialidad->NombreAmbienteFisico($valueb[8]);
            array_push($resultados[$b], $resultadosAmbFisico);
        }

        require_once '../../cvista/Hospitalizacion/ReporteHospital.php';
    }

    public function GuardarHospitalizacion($datos) {
        $oLRnuevoPaciente = new LHospitalizacion();
        $resultados = $oLRnuevoPaciente->GuardarHospitalizacion($datos);
    }

    public function VistaDetallePaciente($datos) {
        $oLRnuevoPaciente = new LHospitalizacion();
        $o_Lpersona = new LPersona();
        $DNI = '';
        $resultadosFoto = $oLRnuevoPaciente->FotoPersona($datos["codigoPersona"]);
        $resultadosNumDocumento = $oLRnuevoPaciente->DocumentoPaciente($datos["codigoPersona"]);
        foreach ($resultadosNumDocumento as $k => $valuek) {
            if ($valuek[1] == '') {
                $DNI = '';
            } else {
                $DNI = $valuek[1];
            }
        }

        $resultadosDiagEntrada = $oLRnuevoPaciente->DiagnosticoEntradaYsalida($datos["codigoPaciente"]);

        $dni_fondo = $resultadosFoto[0][0]; // $idpersona."png"
        $recRuta = $o_Lpersona->recuperarRuta("fotos");
        $fotoPersona = $recRuta[0][0] . "/" . $dni_fondo;
        if (!file_exists($recRuta[0][1] . $dni_fondo))//verifica si existe el file mediante la ruta fisica
            $fotoPersona = $recRuta[0][0] . "/anonimo_00.jpg";
        require_once '../../cvista/Hospitalizacion/DatosPacientesHospitalizacion.php';
    }

    public function ExpotarExcelHospitalizacion($datos) {
        $oLRnuevoPaciente = new LHospitalizacion();
        $resultadosExpotarExcel = $oLRnuevoPaciente->ExpotarExcelHospitalizacion($datos);
        require_once '../../cvista/Hospitalizacion/ReporteExpotacionExcelHospitalizacion.php';
    }

    public function TranferenciaDePaciente($datos) {
        $oLRnuevoPaciente = new LHospitalizacion();
        $resultadosAfiliacion = $oLRnuevoPaciente->hospitalizacionAfiliacion($datos["htxtCodigoPaciente"]);
        $resultadosDestino = $oLRnuevoPaciente->comboDestinoHost();
        require_once '../../cvista/Hospitalizacion/Transferir.php';
    }

    public function guardarTransferenciaPaciente($datos) {
        $oLRnuevoPaciente = new LHospitalizacion();
        $resultados = $oLRnuevoPaciente->guardarTransferenciaPaciente($datos);
        foreach ($resultados as $key => $value) {
            $resultadosActualizar = $oLRnuevoPaciente->actualizarTransferenciaPaciente($value[0], $datos["anteriorCodigoHospitalizacion"]);
        }
    }


}

?>