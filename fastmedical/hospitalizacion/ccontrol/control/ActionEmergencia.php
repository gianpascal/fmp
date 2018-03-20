<?php

require_once("../../../pholivo/tablaDHTMLX.php");
require_once("../../clogica/LEmergencia.php");
require_once("../../clogica/LPersona.php");

class ActionEmergencia {

    public function __construct() {
        
    }

    /*     * ************************** GESTION DEL ARBOL DE CENTRO DE COSTOS *************************************** */

    public function mostrarCcostos() {
        require_once("../../cvista/rrhh/consultarPersonal.php");
    }

    public function CargarDoctoXpaciente($datos) {

        $oLRemergenciaDoctor = new LEmergencia();
        $resultadosDoctor = $oLRemergenciaDoctor->ComboDoctor($datos["fechaSeleccionada"]);

        $oLRemergenciaEspecialidad = new LEmergencia();
        $resultadosEspecialidad = $oLRemergenciaEspecialidad->ComboEspecialidad();

        $oLRemergencia = new LEmergencia();
        $resultados = $oLRemergencia->CargarDoctoXpaciente($datos);

        foreach ($resultados as $i => $value) {//18
            $resultadosDiagnostico = $oLRemergencia->ComboDiagnostico($resultados[$i][4]);
            $cadena = "";
            foreach ($resultadosDiagnostico as $j => $value) {
                if ($j == 0)
                    $cadena.=$resultadosDiagnostico[$j][1];
                else
                    $cadena.="--" . $resultadosDiagnostico[$j][1];
            }
            array_push($resultados[$i], $cadena);
        }

        foreach ($resultados as $i => $value) {
            $resultadosDestino = $oLRemergencia->ComboDestino();
            array_push($resultados[$i], $resultadosDestino);
        }
        foreach ($resultados as $i => $value) {
            $resultadosAmbienteFisico = $oLRemergencia->ComboAmbienteFisico($resultados[$i][8]);
            array_push($resultados[$i], $resultadosAmbienteFisico);
        }
        foreach ($resultados as $i => $value) {
            array_push($resultados[$i], $datos["fechaSeleccionada"]);
        }
        foreach ($resultados as $i => $value) {
            $idCodigoAmbientefisico = '';
            $idCodigoCama = '';
            $resultadosCodigoAmbienteFisicoCama = $oLRemergencia->CodigoAmbienteFisicoCama($resultados[$i][7]);
            foreach ($resultadosCodigoAmbienteFisicoCama as $k => $valAFC) {
                $idCodigoAmbientefisico = $valAFC[1];
                $idCodigoCama = $valAFC[0];
            }
            array_push($resultados[$i], $idCodigoAmbientefisico);
            array_push($resultados[$i], $idCodigoCama);

            $resultadosCamas = $oLRemergencia->ComboCamaC($idCodigoAmbientefisico);
            array_push($resultados[$i], $resultadosCamas);
        }

        require_once("../../cvista/emergencia/mostrarDatosServicioEmergencia.php");
    }

    public function EditarDetallePaciente($datos) {
        $CodigoProgramacion = $datos["CodigoProgramacion"];
        $CodigoCronograma = $datos["CodigoCronograma"];
        $cod_per = $datos["cod_per"];
        $iCodigoCama = $datos["codigocama"];
        $codigoPaciente = $datos["codigoPaciente"];


        $oLRemergencia = new LEmergencia();
        $o_Lpersona = new LPersona();

        $resultados = $oLRemergencia->ComboDiagnostico($codigoPaciente);
        $resultadosCama = $oLRemergencia->numeroCama($iCodigoCama);
        $resultadosEspecialidad = $oLRemergencia->EspecialidadDoctor($CodigoCronograma);
        $resultadosAntecedentes = $oLRemergencia->Antecedente($codigoPaciente);
        $resultadosFoto = $oLRemergencia->FotoPersona($cod_per);
//      print_r( $cod_per);
//        $foto = "esta es foto";
        $dni_fondo = $resultadosFoto[0][0]; // $idpersona."png"
        $recRuta = $o_Lpersona->recuperarRuta("fotos");
        $fotoPersona = $recRuta[0][0] . "/" . $dni_fondo;
        if (!file_exists($recRuta[0][1] . $dni_fondo))//verifica si existe el file mediante la ruta fisica
            $fotoPersona = $recRuta[0][0] . "/anonimo_00.jpg";
        require_once("../../cvista/emergencia/DatosPacientes.php");
    }

//  
    public function GuardarnsdProgramacionPacientesEmergencia($Datos) {
        $oLRemergencia = new LEmergencia();
        $resultados = $oLRemergencia->GuardarnsdProgramacionPacientesEmergencia($Datos);
    }

    public function ComboCama($Datos) {
        $fila = $Datos['fila'];
        $EstadoCama = $Datos['estadoCama'];
        $oLRemergencia = new LEmergencia();
        $resultadosCama = $oLRemergencia->ComboCama($Datos);
        if ($EstadoCama == 1) {
            $combo = '<select name="cboCama[' . $fila . ']" id="cboCama[' . $fila . ']" style="width: 50px;">';
            $combo.='<option value=""  >Seleccionar</option>';
            foreach ($resultadosCama as $i => $value) {
                $combo.='<option value="' . $value[0] . '"';
                $combo.=' >';
                $combo.=htmlentities($value[1]) . '</option>';
            }
            $combo.='</select>';
        } else {
            $combo = '<select name="cboCama[' . $fila . ']" id="cboCama[' . $fila . ']" style="width: 50px;" hidden="false">';
            $combo.='<option value="" border="0" ></option>';
            $combo.='</select>';
        }
        return $combo;
    }

    public function menuMostrarEmergencia() {
        require_once '../../cvista/emergencia/ServicioEmergencia.php';
    }

    public function reporteEmergenciaxDiagnosticoGeneral() {

        require_once '../../cvista/emergencia/ReporteEmergenciaGeneral.php';
    }

    public function reporteEmergenciaxDiagnosticoServicio() {

        require_once '../../cvista/emergencia/reporteEmergenciaDiagnosticoServicio.php';
    }

    public function EmergenciaXFecha($Datos) {
        $oLRemergencia = new LEmergencia();
        $resultadoCantidad = $oLRemergencia->CantidadTotal($Datos);
        $oLRemergencia = new LEmergencia();
        $resultados = array();
        if ($resultadoCantidad[0][0] != 0) {
            //  print_r($resultadoCantidad[0][0]);
            $resultados = $oLRemergencia->ReporteDiagnosticoGeneral($resultadoCantidad[0][0], $Datos);
        }

        $resultadoRangoEdades = $oLRemergencia->cabezeraTablas();

        $acumulado = 0;
        foreach ($resultados as $j => $valuex) {
            $acumulado = $acumulado + $valuex[4];
            array_push($resultados[$j], round($acumulado, 3));
        }

        $resultadoEstadisitico = $oLRemergencia->Reporte($Datos);

        $arrayDatos = array();
        $resultadoXedades = $oLRemergencia->ReporteXedades($Datos);

        if (!empty($resultadoRangoEdades) && !empty($resultados) && !empty($resultadoEstadisitico)) {
            foreach ($resultados as $a => $valuea) {//datos  maestro
                $arrayDatos[$a][0] = $valuea[0];
                $arrayDatos[$a][1] = $valuea[1];
                $arrayDatos[$a][2] = $valuea[2];
                $arrayDatos[$a][3] = $valuea[3];
                $arrayDatos[$a][4] = $valuea[4] . " %";
                $arrayDatos[$a][5] = $valuea[5] . " %";
                $incide = 5;
                foreach ($resultadoRangoEdades as $b => $valueb) {
                    $incide++;
                    $arrayDatos[$a][$incide] = '0';
                    foreach ($resultadoEstadisitico as $c => $valuec) {
                        if ($valuea[2] == $valuec[1] && $valueb[0] == $valuec[0]) {
                            $arrayDatos[$a][$incide] = $valuec[2];
                            unset($resultadoEstadisitico[$c]);
                        }
                    }
                }
            }
            $resultadoSex = $oLRemergencia->ReportexSexo($Datos);

            foreach ($arrayDatos as $a => $valuea) {
                if (!empty($resultadoSex)) {
                    foreach ($resultadoSex as $b => $valueb) {
                        if ($arrayDatos[$a][2] == $resultadoSex[$b][0]) {
                            array_push($arrayDatos[$a], $resultadoSex[$b][1]);
                            array_push($arrayDatos[$a], $resultadoSex[$b][2]);
                            unset($resultadoSex[$b]);
                            break;
                        }
                    }
                }
            }

            $resultadoSexoTotal = $oLRemergencia->ReportexSexoTotal($Datos);
            require_once("../../cvista/emergencia/DiagnosticoGeneral.php");
        }
    }

    public function EmergenciaXFechaServicio($Datos) {
        $oLRemergencia = new LEmergencia();
        $resultadoRangoEdades = $oLRemergencia->cabezeraTablas();
        $resultadoCantidad = $oLRemergencia->CantidadTotalServicios($Datos);
        $resultadoNombreAmbienteLogico = $oLRemergencia->reporteAmbienteLogicos();
        $resultadoEstadisticosEdades = $oLRemergencia->reporteEdades($Datos);
        $resultadoCantidadXsexo = $oLRemergencia->reporteCantidadXsexo($Datos);
        $resultadoCantidadXedadesTotal = $oLRemergencia->reporteCantidadXedadesTotal($Datos);
        $resultadoCantidadXsexoTotal = $oLRemergencia->reporteCantidadXsexoTotal($Datos);

        $resultadoTotaledad = $oLRemergencia->reporteTotalXedad($Datos);
        $resultadoTotalSexo = $oLRemergencia->reporteTotalXsexo($Datos);
        $cantidad = $resultadoCantidad[0][0];
        // print_r($cantidad);
        if (!empty($resultadoCantidadXsexo) && !empty($resultadoRangoEdades) && !empty($resultadoCantidad) && !empty($resultadoEstadisticosEdades)) {
            foreach ($resultadoNombreAmbienteLogico as $j => $valuex) {

                $ReporteDiagnosticosXAmbLogico = $oLRemergencia->ReporteDiagnosticosXAmbLogico($valuex[0], $cantidad, $Datos);
                $acumulado = 0;

                foreach ($ReporteDiagnosticosXAmbLogico as $c => $valuey) {
                    $acumulado = $acumulado + $valuey[5];
                    array_push($ReporteDiagnosticosXAmbLogico[$c], round($acumulado, 3));
                }
                $finalAcumulado = $acumulado;

                $arrayDatos = array();

                $d = 0;
                $incide = 0;
                foreach ($ReporteDiagnosticosXAmbLogico as $d => $valued) {
                    $arrayDatos[$d][0] = $valued[3]; //codigo diagnostico
                    $arrayDatos[$d][1] = $valued[1]; //codigo Ambiente logico
                    $arrayDatos[$d][2] = $valued[2];
                    $arrayDatos[$d][3] = $valued[4];
                    $arrayDatos[$d][4] = $valued[5] . " %";
                    $arrayDatos[$d][5] = $valued[6] . " %";
                    $incide = 5;
                    foreach ($resultadoRangoEdades as $e => $valuee) {
                        $incide++;
                        $arrayDatos[$d][$incide] = '0';
                        foreach ($resultadoEstadisticosEdades as $f => $valuef) {

                            if ($valued[3] == $valuef[1] && $valuee[0] == $valuef[3] && $valuex[0] == $valuef[0]) {
                                $arrayDatos[$d][$incide] = $valuef[2];
                                unset($resultadoEstadisticosEdades[$f]);
                            }
                        }
                    }
                }

                foreach ($arrayDatos as $M => $valuemM) {
                    foreach ($resultadoCantidadXsexo as $g => $valueg) { //CodigoAmbienteLogicof,idcief
                        if ($valueg[1] == $valuemM[0] && $valueg[0] == $valuex[0]) {//$valuemM[1]  =codigo ambiente logico
                            array_push($arrayDatos[$M], $valueg[2]);
                            array_push($arrayDatos[$M], $valueg[3]);
                            unset($resultadoCantidadXsexo[$g]);
                            break;
                        }
                    }
                }


                $arrayTotalEdades = array();
                array_push($resultadoNombreAmbienteLogico[$j], $arrayDatos);
                array_push($resultadoNombreAmbienteLogico[$j], $finalAcumulado);
                unset($arrayDatos);
                foreach ($resultadoRangoEdades as $z => $valuez) {
                    $incideX = 0;
                    $arrayTotalEdades[$z][$incideX] = '0';
                    foreach ($resultadoCantidadXedadesTotal as $t => $valueT) {

                        if ($valueT[0] == $valuex[0] && $valueT[2] == $valuez[0]) {
                            $arrayTotalEdades[$z][$incideX] = $valueT[1];
                            unset($resultadoCantidadXedadesTotal[$t]);
                            $incideX++;
                        }
                    }
                }

                array_push($resultadoNombreAmbienteLogico[$j], $arrayTotalEdades);


                foreach ($resultadoCantidadXsexoTotal as $zi => $valuezi) {
                    if ($valuezi[0] == $valuex[0]) {
                        array_push($resultadoNombreAmbienteLogico[$j], $valuezi[1]);
                        array_push($resultadoNombreAmbienteLogico[$j], $valuezi[2]);
                        array_push($resultadoNombreAmbienteLogico[$j], $valuezi[3]);
                    }
                }
            }
            //global $resultadoNombreAmbienteLogico1;
            //$resultadoNombreAmbienteLogico1=  $resultadoNombreAmbienteLogico;
            $_SESSION['resultadoNombreAmbienteLogico'] = $resultadoNombreAmbienteLogico;
            $_SESSION['resultadoTotaledad'] = $resultadoTotaledad;
             $_SESSION['resultadoTotalSexo'] = $resultadoTotalSexo;

//                $arrayTotalXsexo = array();
//                foreach ($resultadoCantidadXsexoTotal as $zi => $valuezi) {
//                     $incidezi = 0;
//                   $arrayTotalXsexo[$zi][$incidezi]=0;
//                    if ($valuezi[0] == $valuex[0]) {
//                       $arrayTotalXsexo[$zi][$incidezi]=$valuezi[1];
//                       $incidezi ++;
//                       $arrayTotalXsexo[$zi][$incidezi]=$valuezi[2];
//                       $incidezi ++;
//                       $arrayTotalXsexo[$zi][$incidezi]=$valuezi[3];
////                        array_push($resultadoNombreAmbienteLogico[$j], $valuezi[1]);
////                        array_push($resultadoNombreAmbienteLogico[$j], $valuezi[2]);
////                        array_push($resultadoNombreAmbienteLogico[$j], $valuezi[3]);                        
//                        $incidezi ++;
//                    }
//                    unset($resultadoCantidadXsexoTotal[$zi]);
//                }
//                array_push($resultadoNombreAmbienteLogico[$j], $arrayTotalXsexo); 
//        $col = count($resultadoNombreAmbienteLogico);
//        print_r($resultadoNombreAmbienteLogico);
            require_once("../../cvista/emergencia/EmergenciaDiagnosticoServicios.php");
        }
    }

    public function ExpotarExcelDiagnostico($Datos) {

        $oLRemergencia = new LEmergencia();
        $resultadoRangoEdades = $oLRemergencia->cabezeraTablas();

        $resultadoTotaledad = $oLRemergencia ;
         $resultadoTotaledad=$_SESSION['resultadoTotaledad'];
        $resultadoTotalSexo = $oLRemergencia;
        $resultadoTotalSexo=$_SESSION['resultadoTotalSexo'];

        $resultadoNombreAmbienteLogico1 = $oLRemergencia;
        $resultadoNombreAmbienteLogico1 = $_SESSION['resultadoNombreAmbienteLogico'];

        require_once("../../cvista/emergencia/EmergenciaDiagnosticoExcel.php");
      
    }

}

