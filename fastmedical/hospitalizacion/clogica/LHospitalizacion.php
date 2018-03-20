<?php

require_once ("../../cdatos/DHospitalizacion.php");

class LHospitalizacion {

    public function __construct() {
        
    }

    public function getSeleccionaListaMes() {
        $resultadoArray = array();
        for ($i = 1; $i <= 12; $i++) {
            $mes = $this->getNombreMes($i);
            $resultadoArray[$i] = $mes;
        }
        return $resultadoArray;
    }

    public function getNombreMes($numero_mes) {
        $nombre_mes = "";
        switch ($numero_mes) {
            case 1: $nombre_mes = "Enero";
                break;
            case 2: $nombre_mes = "Febrero";
                break;
            case 3: $nombre_mes = "Marzo";
                break;
            case 4: $nombre_mes = "Abril";
                break;
            case 5: $nombre_mes = "Mayo";
                break;
            case 6: $nombre_mes = "Junio";
                break;
            case 7: $nombre_mes = "Julio";
                break;
            case 8: $nombre_mes = "Agosto";
                break;
            case 9: $nombre_mes = "Septiembre";
                break;
            case 10: $nombre_mes = "Octubre";
                break;
            case 11: $nombre_mes = "Noviembre";
                break;
            case 12: $nombre_mes = "Diciembre";
                break;
        }
        return $nombre_mes;
    }

    public function getSeleccionaListaAno($ano_actual='') {
        $ano_actual = $ano_actual == '' ? date('Y') : intval($ano_actual);
        $inicio = $ano_actual - 15;
        $fin = $ano_actual + 15;
        $resultadoArray = array();
        for ($i = $inicio; $i <= $fin; $i++)
            $resultadoArray[$i] = $i;
        return $resultadoArray;
    }

    public function getDiaEspaniol($cadena_dia) {
        $dia_ingles = array("MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN");
        $dia_espanol = array("LUN", "MAR", "MIE", "JUE", "VIE", "SAB", "DOM");
        return str_replace($dia_ingles, $dia_espanol, $cadena_dia);
    }

    public function getCupos($tiempo, $inicio, $fin) {
        if ($tiempo > 0) {
            $ini = explode('.', strval(number_format($inicio, 2, '.', '')));
            $fin = explode('.', strval(number_format($fin, 2, '.', '')));
            $total_min = ( ($fin[0] * 60) + $fin[1] ) - ( ($ini[0] * 60) + $ini[1] );
            $resultado = round(floatval($total_min) / floatval($tiempo));
        }
        else
            $resultado = $tiempo;
        return $resultado;
    }



    public function busquedaPaciente($datos) {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->busquedaPaciente($datos);


        return $resultado;
    }

    public function busquedaPersonaMedicoTratante($datos) {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->busquedaPersonaMedicoTratante($datos);
        return $resultado;
    }

    public function busquedaPersonaMedicoOrdInt($datos) {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->busquedaPersonaMedicoOrdInt($datos);
        return $resultado;
    }

    public function busquedaPersonaMedicoAlta($datos) {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->busquedaPersonaMedicoAlta($datos);
        return $resultado;
    }

    public function cboAmbienteFisico($idPisos) {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->cboAmbienteFisico($idPisos);
        return $resultado;
    }

    public function cboCama($idAmbienteFisico) {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->cboCama($idAmbienteFisico);
        return $resultado;
    }

    public function PacienteGuardarHospitalizacion($datos) {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->PacienteGuardarHospitalizacion($datos);
        return $resultado;
    }

    public function Hospitalizacion($datos) {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->Hospitalizacion($datos);
        return $resultado;
    }

    public function AmbienteCama($idAmbienteFisico) {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->AmbienteCama($idAmbienteFisico);
        return $resultado;
    }

    public function comboDestinoHost() {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->comboDestinoHost();
        return $resultado;
    }

    public function BorrarHospitalizacion($CodigoHospitalizacion) {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->BorrarHospitalizacion($CodigoHospitalizacion);
        return $resultado;
    }

    public function NombreAmbienteFisico($codigoAmbienteFisico) {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->NombreAmbienteFisico($codigoAmbienteFisico);
        return $resultado;
    }

    public function GuardarHospitalizacion($datos) {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->GuardarHospitalizacion($datos);
        return $resultado;
    }

    /* public function comboDiagnostico() {
      $o_DRhospitalizacion = new DHospitalizacion();
      $resultado = $o_DRhospitalizacion->comboDiagnostico();
      return $resultado;
      } */

    public function DocumentoPaciente($cod_per) {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->DocumentoPaciente($cod_per);
        return $resultado;
    }

    public function DiagnosticoEntradaYsalida($codPaciente) {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->DiagnosticoEntradaYsalida($codPaciente);
        return $resultado;
    }

    public function ExpotarExcelHospitalizacion($datos) {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->ExpotarExcelHospitalizacion($datos);
        return $resultado;
    }

    public function FotoPersona($cod_per) {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->FotoPersona($cod_per);
        return $resultado;
    }

    public function recuperarRuta($ruta) {
        require_once("../../cdatos/DRrhh.php");
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->recuperarRuta($ruta);
        return $resultado;
    }

    public function hospitalizacionAfiliacion($iCodigoPaciente) {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->hospitalizacionAfiliacion($iCodigoPaciente);
        return $resultado;
    }

    public function guardarTransferenciaPaciente($datos) {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->guardarTransferenciaPaciente($datos);
        return $resultado;
    }

    public function actualizarTransferenciaPaciente($CodigoActual, $anteriorCodigoHospitalizacion) {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->actualizarTransferenciaPaciente($CodigoActual, $anteriorCodigoHospitalizacion);
        return $resultado;
    }

    public function EstadosHospitalizacion() {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->EstadosHospitalizacion();
        return $resultado;
    }


    public function NuevoPacienteHora() {
        $o_DRhospitalizacion = new DHospitalizacion();
        $resultado = $o_DRhospitalizacion->NuevoPacienteHora();
        return $resultado;
    }

}

?>