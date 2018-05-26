<?php

require_once("../../clogica/LReporte.php");
require_once("../../../pholivo/tablaDHTMLX.php");
require_once("../../../pholivo/Html.php");

class ActionReporte {

    public function __construct() {
        
    }

    public function cargarEstadisticasAjax() {
        $o_LReporte = new LReporte();

        $respuesta = 'var dataset=[{id:1,sales:20,year:"02"},{id:2,sales:55,year:"03"},{id:3,sales:40,year:"04"},{id:4,sales:78,year:"05"},{id:5,sales:61,year:"06"},{id:6,sales:100,year:"07"},{id:7,sales:80,year:"08"},{id:8,sales:50,year:"09"},{id:9,sales:65,year:"10"},{id:10,sales:59,year:"11"}];';
        return $respuesta;
    }

    public function aDatosPuntoControlPaciente($codPacienteLab) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->lDatosPuntoControlPaciente($codPacienteLab);
        return $respuesta;
    }

    public function agrupodeDatos($codPacienteLab) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->lgrupodeDatos($codPacienteLab);
        return $respuesta;
    }

    public function adatosExamenUni($codPacienteLab) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->ldatosExamenUni($codPacienteLab);
        return $respuesta;
    }

    public function datosPacientexExamen($codPacienteLab) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->datosPacientexExamen($codPacienteLab);
        return $respuesta;
    }

    public function abrirMantenimientoReportes() {
        $o_LReporte = new LReporte();
        $cboTpoReporteDetalle = $o_LReporte->cboTipoReporteDetalle();
        require_once '../../cvista/vreportes/mantenimientoReportes.php';
    }

    public function guardarDatosHistoriaEstadistica($datos) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->guardarDatosHistoriaEstadistica($datos);
        return $respuesta;
    }

    public function propiedadesPopadEstado() {
        require_once '../../cvista/reporte/popadOpcionesFiltrado.php';
    }

    public function propiedadesPopadAtencion() {
        require_once '../../cvista/reporte/propiedadesPopadAtencion.php';
    }

    public function propiedadesPopadServicios() {
        require_once '../../cvista/reporte/propiedadesPopadServicios.php';
    }

    public function CatalogodeGraficos() {
        require_once '../../cvista/reporte/CatalogodeGraficos.php';
    }

    public function CatalogodeGraficosLaboratorioClinico() {
        require_once '../../cvista/reporte/CatalogodeGraficosLaboratorioClinico.php';
    }

    public function PopadSedes() {
        require_once '../../cvista/reporte/PopadSedes.php';
    }

    public function propiedadesPopadAmbiL() {
        require_once '../../cvista/reporte/propiedadesPopadAmbiL.php';
    }

    public function propiedadesPopadAmbiF() {
        require_once '../../cvista/reporte/propiedadesPopadAmbiF.php';
    }

    public function EditarHistoriaEstadistica() {
        require_once '../../cvista/reporte/EditarHistoriaEstadistica.php';
    }

    public function aEstadisticasMedicos($datos) {
        $o_LReporte = new LReporte();
//////extrayendo las opciones
        $datos['bReservados'] = 0;
        $datos['bPorAtender'] = 0;
        $datos['bAtendidos'] = 0;
        $datos['bConsultaReservados'] = 0;
        $datos['bConsultaPorAtender'] = 0;
        $datos['bConsultaAtendidos'] = 0;
        $datos['bProcedimientosReservados'] = 0;
        $datos['bProcedimientosPorAtender'] = 0;
        $datos['bProcedimientosAtendidos'] = 0;
        $datos['bAdicionalReservados'] = 0;
        $datos['bAdicionalPorAtender'] = 0;
        $datos['bAdicionalAtendidos'] = 0;
        $datos['bProgramadosReservados'] = 0;
        $datos['bProgramadosPorAtender'] = 0;
        $datos['bProgramadosAtendidos'] = 0;
        $datos['codMedico1'] = "";
        $datos['codMedico2'] = "";
        $datos['codMedico3'] = "";
        $datos['codProducto'] = "";
        $datos['codAmbiLo1'] = "";
        $datos['codAmbiLo2'] = "";
        $datos['codAmbiLo3'] = "";
        $datos['codSede1'] = "";
        $datos['codSede2'] = "";
        $datos['codSede3'] = "";
        $datos['codSede4'] = "";
        $datos['Afiliaciones1'] = "";
        $datos['Afiliaciones2'] = "";
        $datos['Afiliaciones3'] = "";
        $datos['bConsultaProgramadoReservados'] = 0;
        $datos['bConsultaProgramadoPorAtender'] = 0;
        $datos['bConsultaProgramadoAtendidos'] = 0;
        $datos['bConsultaAdicionalReservados'] = 0;
        $datos['bConsultaAdicionalPorAtender'] = 0;
        $datos['bConsultaAdicionalAtendidos'] = 0;
        $datos['bProcedimientosProgramadoReservados'] = 0;
        $datos['bProcedimientosProgramadoPorAtender'] = 0;
        $datos['bProcedimientosProgramadoAtendidos'] = 0;
        $datos['bProcedimientosAdicionalReservados'] = 0;
        $datos['bProcedimientosAdicionalPorAtender'] = 0;
        $datos['bProcedimientosAdicionalAtendidos'] = 0;
        $datos['actividad1'] = "";
        $datos['actividad2'] = "";
        $datos['actividad3'] = "";
        $datos['actividad4'] = "";
        $datos['actividad5'] = "";
        $datos['actividad6'] = "";



        $accion = 0;
///para consultas
        $datos["Atencion"] = "*******" . $datos["Atencion"];
        $datos["Estados"] = "*******" . $datos["Estados"];
        $datos["Programacion"] = "*******" . $datos["Programacion"];
//$datos["Medicos"] = "*******" . $datos["Medicos"];
        if (strpos($datos["Atencion"], 'chkAtencion_1') > 0 && strpos($datos["Programacion"], 'chkProgramacion_1') <= 0 && strpos($datos["Programacion"], 'chkProgramacion_2') <= 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bConsultaReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bConsultaPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bConsultaAtendidos'] = 1;
            }
        }
        if (strpos($datos["Atencion"], 'chkAtencion_1') > 0 && strpos($datos["Programacion"], 'chkProgramacion_1') > 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bConsultaProgramadoReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bConsultaProgramadoPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bConsultaProgramadoAtendidos'] = 1;
            }
        }
        if (strpos($datos["Atencion"], 'chkAtencion_1') > 0 && strpos($datos["Programacion"], 'chkProgramacion_2') > 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bConsultaAdicionalReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bConsultaAdicionalPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bConsultaAdicionalAtendidos'] = 1;
            }
        }
        //para estados      
        if (strpos($datos["Atencion"], 'chkAtencion_1') <= 0 && strpos($datos["Atencion"], 'chkAtencion_2') <= 0 && strpos($datos["Programacion"], 'chkProgramacion_1') <= 0 && strpos($datos["Programacion"], 'chkProgramacion_2') <= 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bAtendidos'] = 1;
            }
        }

///para procedimeintos
        if (strpos($datos["Atencion"], 'chkAtencion_2') > 0 && strpos($datos["Programacion"], 'chkProgramacion_1') <= 0 && strpos($datos["Programacion"], 'chkProgramacion_2') <= 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bProcedimientosReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bProcedimientosPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bProcedimientosAtendidos'] = 1;
            }
        }
        if (strpos($datos["Atencion"], 'chkAtencion_2') > 0 && strpos($datos["Programacion"], 'chkProgramacion_1') > 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bProcedimientosProgramadoReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bProcedimientosProgramadoPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bProcedimientosProgramadoAtendidos'] = 1;
            }
        }
        if (strpos($datos["Atencion"], 'chkAtencion_2') > 0 && strpos($datos["Programacion"], 'chkProgramacion_2') > 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bProcedimientosAdicionalReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bProcedimientosAdicionalPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bProcedimientosAdicionalAtendidos'] = 1;
            }
        }
////para Programados
        if (strpos($datos["Programacion"], 'chkProgramacion_1') > 0 && strpos($datos["Atencion"], 'chkAtencion_1') <= 0 && strpos($datos["Atencion"], 'chkAtencion_2') <= 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bProgramadosReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bProgramadosPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bProgramadosAtendidos'] = 1;
            }
        }
///para adicionales
        if (strpos($datos["Programacion"], 'chkProgramacion_2') > 0 && strpos($datos["Atencion"], 'chkAtencion_1') <= 0 && strpos($datos["Atencion"], 'chkAtencion_2') <= 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bAdicionalReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bAdicionalPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bAdicionalAtendidos'] = 1;
            }
        }


////para Medico///
        if ($datos["Medicos"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["Medicos"]);
            $codPer1 = $datosSeparados[0];
            $codPer2 = $datosSeparados[1];
            $codPer3 = $datosSeparados[2];
            $datos['codMedico1'] = $codPer1;
            $datos['codMedico2'] = $codPer2;
            $datos['codMedico3'] = $codPer3;
            $accion = 1;
        }


        if ($datos["Servicios"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["Servicios"]);
            $codPro = $datosSeparados[0];
            $datos['codProducto'] = $codPro;
            $accion = 1;
        }
        if ($datos["AmbiLo"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["AmbiLo"]);
            $AmbiLo1 = $datosSeparados[0];
            $AmbiLo2 = $datosSeparados[1];
            $AmbiLo3 = $datosSeparados[2];
            $datos['codAmbiLo1'] = $AmbiLo1;
            $datos['codAmbiLo2'] = $AmbiLo2;
            $datos['codAmbiLo3'] = $AmbiLo3;
            $accion = 1;
        }


        if ($datos["Afiliaciones"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["Afiliaciones"]);
            $Afiliaciones1 = $datosSeparados[0];
            $Afiliaciones2 = $datosSeparados[1];
            $Afiliaciones3 = $datosSeparados[2];
            $datos['Afiliaciones1'] = $Afiliaciones1;
            $datos['Afiliaciones2'] = $Afiliaciones2;
            $datos['Afiliaciones3'] = $Afiliaciones3;
            $accion = 1;
        }

        if ($datos["Sedes"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["Sedes"]);
            $Sedes1 = $datosSeparados[0];
            $Sedes2 = $datosSeparados[1];
            $Sedes3 = $datosSeparados[2];
            $Sedes4 = $datosSeparados[3];
            $datos['CodSede1'] = $Sedes1;
            $datos['CodSede2'] = $Sedes2;
            $datos['CodSede3'] = $Sedes3;
            $datos['CodSede4'] = $Sedes4;
            $accion = 1;
        }

        if ($datos["actividades"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["actividades"]);
            $actividades1 = $datosSeparados[0];
            $actividades2 = $datosSeparados[1];
            $actividades3 = $datosSeparados[2];
            $actividades4 = $datosSeparados[3];
            $actividades5 = $datosSeparados[4];
            $actividades6 = $datosSeparados[5];
            $datos['actividades1'] = $actividades1;
            $datos['actividades2'] = $actividades2;
            $datos['actividades3'] = $actividades3;
            $datos['actividades4'] = $actividades4;
            $datos['actividades5'] = $actividades5;
            $datos['actividades6'] = $actividades6;
            $accion = 1;
        }



///////////////////////////
        $arrayRespuesta = $o_LReporte->lEstadisticasMedicos($datos);
        if ($arrayRespuesta == null) {
            $respuesta = 1;
        } else {
            switch ($datos['tipografico']) {
                case'bar' :
                    $arrayRespuesta = $o_LReporte->lEstadisticasMedicos($datos);
                    $respuesta = 'var dataset_' . $datos["prefijo"] . '=[';
                    $numeroFilas = count($arrayRespuesta);
                    $cont = 1;
                    $arrayEncabezdos = array_keys($arrayRespuesta[0]);
                    $maximo = 0;
                    $primervalor = 0;
                    foreach ($arrayRespuesta as $key => $value) {
                        $respuesta.='{id:"' . $cont . '"';
                        foreach ($arrayEncabezdos as $llave) {
                            if (is_string($llave)) {
                                $respuesta.=',' . $llave . ':"' . $value[$llave] . '"';
                                $primervalor = $value[$llave];
                                if (is_int($value[$llave]))
                                    if ($maximo < $value[$llave]) {
                                        $maximo = $value[$llave];
                                    }
                            }
                        }
                        $respuesta.='}';
                        if ($cont == $numeroFilas) {
                            
                        } else {
                            $respuesta.=',';
                        }
                        $cont++;
                    }
                    $respuesta.='];';
////opciones de dia, mes, año, semestre o trimestre
                    $template = 'id';

                    if ($datos["opcion"] == 1) {
                        $template = 'Fecha';
                        $leyenda = $arrayEncabezdos[3];
                    }
                    if ($datos["opcion"] == 2) {
                        $template = 'Mes';
                    }
                    if ($datos["opcion"] == 3) {
                        $template = 'Trimestre';
                    }
                    if ($datos["opcion"] == 4) {
                        $template = 'Semestre';
                    }
                    if ($datos["opcion"] == 5) {
                        $template = 'Anio';
                    }

////hallando las series
                    $arraySeries;
                    $contador = 0;
                    foreach ($arrayEncabezdos as $llave) {
                        if (is_string($llave)) {
                            if ($llave != 'Fecha' && $llave != 'Mes' && $llave != 'Anio' && $llave != 'Trimestre' && $llave != 'Semestre') {
                                $arraySeries[$contador] = $llave;
                                $contador++;
                            }
                        }
                    }
/////////////////creando el grafico/////////////
                    $escala = intval($maximo / 10);
                    $log = intval(log10($escala));
                    $escala = intval($escala / pow(10, $log));
                    $escala = $escala * pow(10, $log);
                    $valorunico = 0;

                    if ($accion == 0) {
                        if ($datos["opcion"] == 1) {
                            $valorunico = $arrayEncabezdos[3];
                        }
                        if ($datos["opcion"] == 2) {
                            $valorunico = $arrayEncabezdos[5];
                        }
                        if ($datos["opcion"] == 3) {
                            $valorunico = "";
                        }
                        if ($datos["opcion"] == 4) {
                            $valorunico = $arrayEncabezdos[5];
                        }
                        if ($datos["opcion"] == 5) {
                            $valorunico = "$arrayEncabezdos[3]";
                        }
                    }
                    if ($accion == 1) {
                        $valorunico = "";
                    }

                    $respuesta.='
                var var' . $datos["prefijo"] . '=new dhtmlXChart({
                view:"bar",
                container:"' . $datos["prefijo"] . '",
                value:"#' . $valorunico . '#",
                label:"#' . $valorunico . '#",
                color: "#EE3639",
                border:true,
                width:30,
                radius:0,
                gradient:0.0,
                lines: true,
                xAxis:{
                        title:"",
			template:"#' . $template . '#"
                },
                yAxis:{
                        start:0,
                        end:' . $maximo . ',
                        step:' . $escala . '
                },
                });
           ';
///////////////creando las series
                    $contador = 0;
                    $x = 1;
                    foreach ($arraySeries as $value) {
                        $arrayColores1 = array(1 => "#EE9E36", 2 => "#EEEA36", 3 => "#A9EE36", 4 => "#36D3EE", 5 => "#367FEE", 6 => "#9B36EE ", 7 => "#55FF00", 8 => "#00FF8E", 9 => "#00FF8E", 10 => "#9C00FF");
                        if ($contador != 0) {
                            if (
                                    $value != 'CodigoPersona' ||
                                    $value != 'CodigoServicio' ||
                                    $value != 'CodigoAmbienteLogico' ||
                                    $value != 'Afiliacion' ||
                                    $value != 'Sede'
                            ) {

                                $respuesta.='var' . $datos["prefijo"] . '.addSeries({
                                
                    value: "#' . $value . '#",
                    label:"#' . $value . '#",
                    color: "' . $arrayColores1[$x] . '",
                    tooltip: {
                        template: "#' . $value . '#"
                    }
                    });';
                            }
                        }
                        $contador++;
                        $x++;
                    };
///////////////////////////////////
                    $respuesta.='var' . $datos["prefijo"] . '.parse(dataset_' . $datos["prefijo"] . ',"json");';

                    break;

//////////////////////////////////////////


                case'stackedBar':
                    $arrayRespuesta = $o_LReporte->lEstadisticasMedicos($datos);
                    $respuesta = 'var dataset_' . $datos["prefijo"] . '=[';
                    $numeroFilas = count($arrayRespuesta);
                    $cont = 1;
                    $arrayEncabezdos = array_keys($arrayRespuesta[0]);
                    $maximo = 0;
                    foreach ($arrayRespuesta as $key => $value) {
                        $respuesta.='{id:"' . $cont . '"';
                        foreach ($arrayEncabezdos as $llave) {
                            if (is_string($llave)) {
                                $respuesta.=',' . $llave . ':"' . $value[$llave] . '"';
                                if (is_int($value[$llave]))
                                    if ($maximo < $value[$llave]) {
                                        $maximo = $value[$llave];
                                    }
                            }
                        }
                        $respuesta.='}';
                        if ($cont == $numeroFilas) {
                            
                        } else {
                            $respuesta.=',';
                        }
                        $cont++;
                    }
                    $respuesta.='];';
////opciones de dia, mes, año, semestre o trimestre
                    $template = 'id';
                    if ($datos["opcion"] == 1) {
                        $template = 'Fecha';
                    }
                    if ($datos["opcion"] == 2) {
                        $template = 'Mes';
                    }
                    if ($datos["opcion"] == 3) {
                        $template = 'Trimestre';
                    }
                    if ($datos["opcion"] == 4) {
                        $template = 'Semestre';
                    }
                    if ($datos["opcion"] == 5) {
                        $template = 'Anio';
                    }
////hallando las series
                    $arraySeries;
                    $contador = 0;
                    foreach ($arrayEncabezdos as $llave) {
                        if (is_string($llave)) {
                            if ($llave != 'Fecha' && $llave != 'Mes' && $llave != 'Anio' && $llave != 'Trimestre' && $llave != 'Semestre') {
                                $arraySeries[$contador] = $llave;
                                $contador++;
                            }
                        }
                    }
/////////////////creando el grafico/////////////
                    $escala = intval($maximo / 6);
                    $log = intval(log10($escala));
                    $escala = intval($escala / pow(10, $log));
                    $escala = $escala * pow(10, $log);
                    $valorunico = 0;

                    if ($accion == 0) {
                        if ($datos["opcion"] == 1) {
                            $valorunico = $arrayEncabezdos[3];
                        }
                        if ($datos["opcion"] == 2) {
                            $valorunico = $arrayEncabezdos[5];
                        }
                        if ($datos["opcion"] == 3) {
                            $valorunico = "";
                        }
                        if ($datos["opcion"] == 4) {
                            $valorunico = $arrayEncabezdos[5];
                        }
                        if ($datos["opcion"] == 5) {
                            $valorunico = $arrayEncabezdos[3];
                        }
                    }
                    if ($accion == 1) {
                        $valorunico = "";
                    }

                    $respuesta.='
                var var' . $datos["prefijo"] . '=new dhtmlXChart({
                view:"stackedBar",
                container:"' . $datos["prefijo"] . '",
                value:"#' . $valorunico . '#",
                label:"#' . $valorunico . '#",
                radius:0,
                color: "#EE3639",
                border:true,
                width:30,
                gradient:0.0,
                lines: true,
                xAxis:{
                        title:"",
			template:"#' . $template . '#"
                },
                yAxis:{
                        start:0,
                        end:' . ($maximo * 6) / 4 . ',
                        step:' . $escala . '
                }
                });
           ';
///////////////creando las series
                    $contador = 0;
                    $x = 1;
                    foreach ($arraySeries as $value) {
                        $arrayColores2 = array(1 => "#EE9E36", 2 => "#EEEA36", 3 => "#A9EE36", 4 => "#36D3EE", 5 => "#367FEE", 6 => "#9B36EE ", 7 => "#55FF00", 8 => "#00FF8E", 9 => "#00FF8E", 10 => "#9C00FF");
                        if ($contador != 0) {
                            if (
                                    $value != 'CodigoPersona' ||
                                    $value != 'CodigoServicio' ||
                                    $value != 'CodigoAmbienteLogico' ||
                                    $value != 'Afiliacion' ||
                                    $value != 'Sede'
                            ) {
                                $respuesta.='var' . $datos["prefijo"] . '.addSeries({
                                
                    value: "#' . $value . '#",
                    label:"#' . $value . '#",
                    color: "' . $arrayColores2[$x] . '",
                    tooltip: {
                        template: "#' . $value . '#"
                    }
                    });';
                            }
                        }
                        $contador++;
                        $x++;
                    };
///////////////////////////////////
                    $respuesta.='var' . $datos["prefijo"] . '.parse(dataset_' . $datos["prefijo"] . ',"json");';
                    break;
                case 'pie':

                    $arrayRespuesta = $o_LReporte->lEstadisticasMedicos($datos);
                    $respuesta = 'var dataset_' . $datos["prefijo"] . '=[';
                    $numeroFilas = count($arrayRespuesta);
                    $cont = 1;
                    $arrayEncabezdos = array_keys($arrayRespuesta[0]);
                    if ($datos["opcion"] == 1) {
                        $leyenda = $arrayEncabezdos[1];
                    }
                    if ($datos["opcion"] == 2) {
                        $leyenda = $arrayEncabezdos[3];
                    }
                    if ($datos["opcion"] == 3) {
                        $leyenda = $arrayEncabezdos[3];
                    }
                    if ($datos["opcion"] == 4) {
                        $leyenda = $arrayEncabezdos[3];
                    }
                    if ($datos["opcion"] == 5) {
                        $leyenda = $arrayEncabezdos[1];
                    }
                    $maximo = 0;
                    $x = 1;
                    foreach ($arrayRespuesta as $key => $value) {
                        $respuesta.='{id:"' . $cont . '"';
                        foreach ($arrayEncabezdos as $llave) {
                            $arrayColores = array(1 => "#FFBF00", 2 => "#FF8F35", 3 => "#FF495F", 4 => "#FF1EA8", 5 => "#FFE51E", 6 => "#FFAB68 ", 7 => "#FF709C", 8 => "#0040FF", 9 => "#35A6FF", 10 => "#49FFE9", 11 => "#1EFF74", 12 => "#0FFF3C", 13 => "#6FFF84", 14 => "#A5FFFF", 15 => "#809FFF", 16 => "#4135FF", 17 => "#9A60FF", 18 => "#C5B8FF", 19 => "#F4FFE8", 20 => "#C7FF8E", 21 => "#BAFF49", 22 => "#FFFAAE", 23 => "#FFAEFA", 24 => "#FFE24F", 25 => "#FF8C76", 26 => "#EC53FF", 27 => "#8F49FF", 28 => "#2F54FF", 29 => "#D2FFFF", 30 => "#80FF9F", 31 => "#F335FF");
                            if (is_string($llave)) {
                                $respuesta.=',' . $llave . ':"' . $value[$llave] . '",color:"' . $arrayColores[$x] . '"';
                                if (is_int($value[$llave]))
                                    if ($maximo < $value[$llave]) {
                                        $maximo = $value[$llave];
                                    }
                            }
                        }
                        $x++;
                        $respuesta.='}';
                        if ($cont == $numeroFilas) {
                            
                        } else {
                            $respuesta.=',';
                        }
                        $cont++;
                    }
                    $respuesta.='];';


                    $respuesta.='var var' . $datos["prefijo"] . '=  new dhtmlXChart({
		view:"pie",
		container:"' . $datos["prefijo"] . '",
	        value:"#' . $llave . '#",
                color: "#color#",
                border:true,
               gradient:0.0,
               lines:false,
                label:"#' . $leyenda . '#",
                legend:{
	             width: 130,
	             align: "right",
	             valign: "top",
	             marker:{
	                 width: 25
	             },
                     template: "#' . $leyenda . '#"
                },
		pieInnerText:"<b>#' . $llave . '#</b>" 
                    });';

                    $respuesta.='var' . $datos["prefijo"] . '.parse(dataset_' . $datos["prefijo"] . ',"json");';
                    break;
                case'line' :
                    $arrayRespuesta = $o_LReporte->lEstadisticasMedicos($datos);
                    $respuesta = 'var dataset_' . $datos["prefijo"] . '=[';
                    $numeroFilas = count($arrayRespuesta);
                    $cont = 1;
                    $arrayEncabezdos = array_keys($arrayRespuesta[0]);
                    $maximo = 0;
                    $primervalor = 0;
                    foreach ($arrayRespuesta as $key => $value) {
                        $respuesta.='{id:"' . $cont . '"';
                        foreach ($arrayEncabezdos as $llave) {
                            if (is_string($llave)) {
                                $respuesta.=',' . $llave . ':"' . $value[$llave] . '"';
                                $primervalor = $value[$llave];
                                if (is_int($value[$llave]))
                                    if ($maximo < $value[$llave]) {
                                        $maximo = $value[$llave];
                                    }
                            }
                        }
                        $respuesta.='}';
                        if ($cont == $numeroFilas) {
                            
                        } else {
                            $respuesta.=',';
                        }
                        $cont++;
                    }
                    $respuesta.='];';
////opciones de dia, mes, año, semestre o trimestre
                    $template = 'id';

                    if ($datos["opcion"] == 1) {
                        $template = 'Fecha';
                        $leyenda = $arrayEncabezdos[3];
                    }
                    if ($datos["opcion"] == 2) {
                        $template = 'Mes';
                    }
                    if ($datos["opcion"] == 3) {
                        $template = 'Trimestre';
                    }
                    if ($datos["opcion"] == 4) {
                        $template = 'Semestre';
                    }
                    if ($datos["opcion"] == 5) {
                        $template = 'Anio';
                    }

////hallando las series
                    $arraySeries;
                    $contador = 0;
                    foreach ($arrayEncabezdos as $llave) {
                        if (is_string($llave)) {
                            if ($llave != 'Fecha' && $llave != 'Mes' && $llave != 'Anio' && $llave != 'Trimestre' && $llave != 'Semestre') {
                                $arraySeries[$contador] = $llave;
                                $contador++;
                            }
                        }
                    }
/////////////////creando el grafico/////////////
                    $escala = intval($maximo / 10);
                    $log = intval(log10($escala));
                    $escala = intval($escala / pow(10, $log));
                    $escala = $escala * pow(10, $log);
                    $valorunico = 0;

                    if ($accion == 0) {
                        if ($datos["opcion"] == 1) {
                            $valorunico = $arrayEncabezdos[3];
                        }
                        if ($datos["opcion"] == 2) {
                            $valorunico = $arrayEncabezdos[5];
                        }
                        if ($datos["opcion"] == 3) {
                            $valorunico = "";
                        }
                        if ($datos["opcion"] == 4) {
                            $valorunico = $arrayEncabezdos[5];
                        }
                        if ($datos["opcion"] == 5) {
                            $valorunico = "$arrayEncabezdos[3]";
                        }
                    }
                    if ($accion == 1) {
                        $valorunico = "";
                    }

                    $respuesta.='
                var var' . $datos["prefijo"] . '=new dhtmlXChart({
                view:"line",
                container:"' . $datos["prefijo"] . '",
                value:"#' . $valorunico . '#",
                label:"#' . $valorunico . '#",
                color: "#EE3639",
                border:true,
                width:30,
                radius:0,
                gradient:0.0,
                lines: true,
                xAxis:{
                        title:"",
			template:"#' . $template . '#"
                },
                yAxis:{
                        start:0,
                        end:' . $maximo . ',
                        step:' . $escala . '
                },
                });
           ';
///////////////creando las series
                    $contador = 0;
                    $x = 1;
                    foreach ($arraySeries as $value) {
                        $arrayColores1 = array(1 => "#EE9E36", 2 => "#EEEA36", 3 => "#A9EE36", 4 => "#36D3EE", 5 => "#367FEE", 6 => "#9B36EE ", 7 => "#55FF00", 8 => "#00FF8E", 9 => "#00FF8E", 10 => "#9C00FF");
                        if ($contador != 0) {
                            if (
                                    $value != 'CodigoPersona' ||
                                    $value != 'CodigoServicio' ||
                                    $value != 'CodigoAmbienteLogico' ||
                                    $value != 'Afiliacion' ||
                                    $value != 'Sede'
                            ) {

                                $respuesta.='var' . $datos["prefijo"] . '.addSeries({
                                
                    value: "#' . $value . '#",
                    label:"#' . $value . '#",
                    color: "' . $arrayColores1[$x] . '",
                    tooltip: {
                        template: "#' . $value . '#"
                    }
                    });';
                            }
                        }
                        $contador++;
                        $x++;
                    };
///////////////////////////////////
                    $respuesta.='var' . $datos["prefijo"] . '.parse(dataset_' . $datos["prefijo"] . ',"json");';

                    break;
            }
        }
        return $respuesta;
    }

//jcqa 3nov

    public function aestadisticasExamenesLaboratorioClinico($datos) {
        $o_LReporte = new LReporte();
//////extrayendo las opciones
        $datos['bReservados'] = 0;
        $datos['bPorAtender'] = 0;
        $datos['bAtendidos'] = 0;
        $datos['bConsultaReservados'] = 0;
        $datos['bConsultaPorAtender'] = 0;
        $datos['bConsultaAtendidos'] = 0;
        $datos['bProcedimientosReservados'] = 0;
        $datos['bProcedimientosPorAtender'] = 0;
        $datos['bProcedimientosAtendidos'] = 0;
        $datos['bAdicionalReservados'] = 0;
        $datos['bAdicionalPorAtender'] = 0;
        $datos['bAdicionalAtendidos'] = 0;
        $datos['bProgramadosReservados'] = 0;
        $datos['bProgramadosPorAtender'] = 0;
        $datos['bProgramadosAtendidos'] = 0;
        $datos['codMedico1'] = "";
        $datos['codMedico2'] = "";
        $datos['codMedico3'] = "";
        $datos['codProducto'] = "";
        $datos['codAmbiLo1'] = "";
        $datos['codAmbiLo2'] = "";
        $datos['codAmbiLo3'] = "";

        //agregado
        //$datos['MaterialPorSede'] = 0;


        $accion = 0;
///para consultas
        $datos["Atencion"] = "*******" . $datos["Atencion"];
        $datos["Estados"] = "*******" . $datos["Estados"];
        $datos["Programacion"] = "*******" . $datos["Programacion"];

//$datos["Medicos"] = "*******" . $datos["Medicos"];
        if (strpos($datos["Atencion"], 'chkAtencion_1') > 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bConsultaReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bConsultaPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bConsultaAtendidos'] = 1;
            }
        }

/////////////////////////////////////////////////////inicio nuevo////////////////////////////////////   
//        $datos["Examenes"]
//
//        if (strpos($datos["Atencion"], 'chkAtencion_1') > 0) {
//            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
//                $datos['bConsultaReservados'] = 1;
//            }
//            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
//                $datos['bConsultaPorAtender'] = 1;
//            }
//            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
//                $datos['bConsultaAtendidos'] = 1;
//            }
//        }
/////////////////////////////////////////////////////fin nuevo////////////////////////////////////       
        // Consulta Mate labo
//        if (strpos($datos["Atencion"], 'chkAtencion_1') > 0) {
//            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
//                $datos['bConsultaReservados'] = 1;
//            }
//            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
//                $datos['bConsultaPorAtender'] = 1;
//            }
//            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
//                $datos['bConsultaAtendidos'] = 1;
//            }
//        }
//        if ($datos["Materiales"] != '') {
//            echo 'sedescitas:';
//            //print_r($datos["Sede"]);
//
//            if ($datos["Sede"] != '') {
//
////                echo 'materiales distinto al vacio';
//                //print_r($datos["Materiales"]);
//                $datos['MaterialPorSede'] = 1;
//            }
//        }
///para procedimeintos
        if (strpos($datos["Atencion"], 'chkAtencion_2') > 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bProcedimientosReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bProcedimientosPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bProcedimientosAtendidos'] = 1;
            }
        }
////para Programados
        if (strpos($datos["Programacion"], 'chkProgramacion_1') > 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bProgramadosReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bProgramadosPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bProgramadosAtendidos'] = 1;
            }
        }
///para adicionales
        if (strpos($datos["Programacion"], 'chkProgramacion_2') > 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bAdicionalReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bAdicionalPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bAdicionalAtendidos'] = 1;
            }
        }
        if (strpos($datos["Atencion"], 'chkAtencion_1') <= 0 && strpos($datos["Atencion"], 'chkAtencion_2') <= 0 && strpos($datos["Programacion"], 'chkProgramacion_1') <= 0 && strpos($datos["Programacion"], 'chkProgramacion_2') <= 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bAtendidos'] = 1;
            }
        }

//Examenes
        if ($datos["Examenes"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["Examenes"]);
            $codPer1 = $datosSeparados[0];
            $codPer2 = $datosSeparados[1];
            $codPer3 = $datosSeparados[2];

            $datos['codExamen1'] = $codPer1;
            $datos['codExamen2'] = $codPer2;
            $datos['codExamen3'] = $codPer3;
            $accion = 1;
        }

//Punto de Control
        if ($datos["PuntoControl"] == "") {
            
        } else {
            $datosSeparadoss = explode("|", $datos["PuntoControl"]);
            $puntoControl1 = $datosSeparadoss[0];
            $puntoControl2 = $datosSeparadoss[1];
            $puntoControl3 = $datosSeparadoss[2];

            $datos['puntoControl1'] = $puntoControl1;
            $datos['puntoControl2'] = $puntoControl2;
            $datos['puntoControl3'] = $puntoControl3;
//            $jose= $datos['puntoControl1'];
//            echo '/inicio/'.$jose.'/fin/';

            $accion = 1;
        }



//Sedes
        if ($datos["Sede"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["Sede"]);
            $codSede1 = $datosSeparados[0];
            $codSede2 = $datosSeparados[1];
            $codSede3 = $datosSeparados[2];

            $datos['codSede1'] = $codSede1;
            $datos['codSede2'] = $codSede2;
            $datos['codSede3'] = $codSede3;
            $accion = 1;
        }

//procedencia
        if ($datos["Procedencia"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["Procedencia"]);
            $Procedencia1 = $datosSeparados[0];
            $Procedencia2 = $datosSeparados[1];
            $Procedencia3 = $datosSeparados[2];

            $datos['Procedencia1'] = $Procedencia1;
            $datos['Procedencia2'] = $Procedencia2;
            $datos['Procedencia3'] = $Procedencia3;
            $accion = 1;
        }

//Afiliaciones
        if ($datos["Afiliaciones"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["Afiliaciones"]);
            $Afiliaciones1 = $datosSeparados[0];
            $Afiliaciones2 = $datosSeparados[1];
            $Afiliaciones3 = $datosSeparados[2];

            $datos['Afiliaciones1'] = $Afiliaciones1;
            $datos['Afiliaciones2'] = $Afiliaciones2;
            $datos['Afiliaciones3'] = $Afiliaciones3;
            $accion = 1;
        }

//Materiales
        if ($datos["Materiales"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["Materiales"]);
            $Materiales1 = $datosSeparados[0];
            $Materiales2 = $datosSeparados[1];
            $Materiales3 = $datosSeparados[2];

            $datos['Materiales1'] = $Materiales1;
            $datos['Materiales2'] = $Materiales2;
            $datos['Materiales3'] = $Materiales3;
            $accion = 1;
        }

//Unidad de Medida
        if ($datos["UnidadMedida"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["UnidadMedida"]);
            $UnidadMedida1 = $datosSeparados[0];
            $UnidadMedida2 = $datosSeparados[1];
            $UnidadMedida3 = $datosSeparados[2];

            $datos['UnidadMedida1'] = $UnidadMedida1;
            $datos['UnidadMedida2'] = $UnidadMedida2;
            $datos['UnidadMedida3'] = $UnidadMedida3;
            $accion = 1;
        }


        if ($datos["Servicios"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["Servicios"]);
            $codPro = $datosSeparados[0];
            $datos['codProducto'] = $codPro;
            $accion = 1;
        }
        if ($datos["AmbiLo"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["AmbiLo"]);
            $AmbiLo1 = $datosSeparados[0];
            $AmbiLo2 = $datosSeparados[1];
            $AmbiLo3 = $datosSeparados[2];
            $datos['codAmbiLo1'] = $AmbiLo1;
            $datos['codAmbiLo2'] = $AmbiLo2;
            $datos['codAmbiLo3'] = $AmbiLo3;
            $accion = 1;
        }

        $arrayRespuesta = $o_LReporte->lestadisticasExamenesLaboratorioClinico($datos);

        if ($arrayRespuesta == null) {
            $respuesta = 1;
        } else {
            switch ($datos['tipografico']) {
                case'bar':
                    $arrayRespuesta = $o_LReporte->lestadisticasExamenesLaboratorioClinico($datos);

                    $respuesta = 'var dataset_' . $datos["prefijo"] . '=[';
                    $numeroFilas = count($arrayRespuesta);
                    $cont = 1;
                    $arrayEncabezdos = array_keys($arrayRespuesta[0]);

                    //print_r($arrayEncabezdos);
                    //[0] => 0
                    //[1] => fecha
                    //[2] => 1
                    //[3] => vDescripcion
                    //[4] => 2
                    //[5] => v_desc_ser_pro
                    //[6] => 3
                    //[7] => Cantidad
                    //
                    //echo 'jcc';
                    $maximo = 0;
                    $primervalor = 0;
                    foreach ($arrayRespuesta as $key => $value) {
                        $respuesta.='{id:"' . $cont . '"';
                        foreach ($arrayEncabezdos as $llave) {
                            if (is_string($llave)) {
                                $respuesta.=',' . $llave . ':"' . $value[$llave] . '"';
                                $primervalor = $value[$llave];
                                if (is_int($value[$llave]))
                                    if ($maximo < $value[$llave]) {
                                        $maximo = $value[$llave];
                                    }
                            }
                        }
                        $respuesta.='}';
                        if ($cont == $numeroFilas) {
                            
                        } else {
                            $respuesta.=',';
                        }
                        $cont++;
                    }
                    $respuesta.='];';
////opciones de dia, mes, año, semestre o trimestre
                    $template = 'id';

                    if ($datos["opcion"] == 1) {
                        $template = 'fecha';
                    }
                    if ($datos["opcion"] == 2) {
                        $template = 'imes';
                    }
                    if ($datos["opcion"] == 3) {
                        $template = 'iTrimestre';
                    }
                    if ($datos["opcion"] == 4) {
                        $template = 'isemestre';
                    }
                    if ($datos["opcion"] == 5) {
                        $template = 'ianio';
                    }

////hallando las series
                    $arraySeries;
                    $contador = 0;
                    foreach ($arrayEncabezdos as $llave) {
                        if (is_string($llave)) {
                            if ($llave != 'fecha' && $llave != 'imes' && $llave != 'ianio' && $llave != 'itrimestre' && $llave != 'isemestre') {
                                $arraySeries[$contador] = $llave;
                                $contador++;
                            }
                        }
                    }
//                    echo 'el max:'.$maximo;
                    //print_r($arraySeries);
                    //echo 'sale arrayseries'; //
                    // [0] => vDescripcion
                    //[1] => v_desc_ser_pro
                    //[2] => Cantidad
/////////////////creando el grafico/////////////
                    //$escala = intval($maximo / 5);
                    //$log = intval(log10($escala));
                    //$escala = intval($escala / pow(10, $log));
                    //$escala = $escala * pow(10, $log);
                    $valorunico = 0;
                    // echo ':::::'.$escala;

                    if ($maximo >= 10 && $maximo < 200) {
                        $maximo = 200;
                        $escala = 20;
                    }
                    if ($accion == 0) {
                        if ($datos["opcion"] == 1) {
                            $valorunico = $arrayEncabezdos[3];
                        }
                        if ($datos["opcion"] == 2) {
                            $valorunico = $arrayEncabezdos[5];
                        }
                        if ($datos["opcion"] == 3) {
                            $valorunico = "";
                        }
                        if ($datos["opcion"] == 4) {
                            $valorunico = $arrayEncabezdos[5];
                        }
                        if ($datos["opcion"] == 5) {
                            $valorunico = $arrayEncabezdos[3];
                        }
                    }
                    if ($accion == 1) {
                        $valorunico = "";
                    }


                    $maximo = 30;
                    $escala = 5;

                    $respuesta.='
                var var' . $datos["prefijo"] . '=new dhtmlXChart({
                view:"bar",
                container:"' . $datos["prefijo"] . '",
                value:"#' . $valorunico . '#",
                label:"#' . $valorunico . '#",
                radius:0,
                gradient:"3d",
                color: "#EE3639",
                border:false,
                width:30,
                radius:5,
                lines: true,
                xAxis:{
                        title:"Informe Estadistico",
			template:"#' . $template . '#"
                },
                yAxis:{
                        start:0,
                        end:' . $maximo . ',
                        step:' . $escala . '
                              
                }
                });
           ';
///////////////creando las series
                    $contador = 0;
                    $x = 1;
                    foreach ($arraySeries as $value) {
                        $arrayColores = array(1 => "#EE9E36", 2 => "#EEEA36", 3 => "#A9EE36", 4 => "#36D3EE", 5 => "#367FEE", 6 => "#9B36EE ", 7 => "#55FF00", 8 => "#00FF8E", 9 => "#00FF8E", 10 => "#9C00FF");
                        if ($contador != 0) {
                            //cCodigoPersona     iIdExamenesLaboratorio      iIdPuntoControl           vNombre  v_desc_ser_pro
                            if ($value != 'Examen' && $value != 'vNombre' && $value != 'iIdPuntoControl'
                                    && $value != 'vDescripcion' && $value != 'iIdMaterialesLaboratorio' && $value != 'v_desc_ser_pro'
                            ) {
                                $respuesta.='var' . $datos["prefijo"] . '.addSeries({
                                
                    value: "#' . $value . '#",
                    label:"#' . $value . '#",
                    color: "' . $arrayColores[$x] . '",
                    gradient:"3d",

                    tooltip: {
                        template: "#' . $value . '#"
                    }
                    });';
                            }
                        }
                        $contador++;
                        $x++;
                    };
///////////////////////////////////
                    $respuesta.='var' . $datos["prefijo"] . '.parse(dataset_' . $datos["prefijo"] . ',"json");';

                    break;

                case'stackedBar':

                    $arrayRespuesta = $o_LReporte->lestadisticasExamenesLaboratorioClinico($datos);


                    $respuesta = 'var dataset_' . $datos["prefijo"] . '=[';
                    $numeroFilas = count($arrayRespuesta);
                    $cont = 1;
                    $arrayEncabezdos = array_keys($arrayRespuesta[0]);
                    $maximo = 0;
                    foreach ($arrayRespuesta as $key => $value) {
                        $respuesta.='{id:"' . $cont . '"';
                        foreach ($arrayEncabezdos as $llave) {
                            if (is_string($llave)) {
                                $respuesta.=',' . $llave . ':"' . $value[$llave] . '"';
                                if (is_int($value[$llave]))
                                    if ($maximo < $value[$llave]) {
                                        $maximo = $value[$llave];
                                    }
                            }
                        }
                        $respuesta.='}';
                        if ($cont == $numeroFilas) {
                            
                        } else {
                            $respuesta.=',';
                        }
                        $cont++;
                    }
                    $respuesta.='];';
////opciones de dia, mes, año, semestre o trimestre
                    $template = 'id';
                    if ($datos["opcion"] == 1) {
                        $template = 'fecha';
                    }
                    if ($datos["opcion"] == 2) {
                        $template = 'imes';
                    }
                    if ($datos["opcion"] == 3) {
                        $template = 'iTrimestre';
                    }
                    if ($datos["opcion"] == 4) {
                        $template = 'isemestre';
                    }
                    if ($datos["opcion"] == 5) {
                        $template = 'ianio';
                    }
////hallando las series
                    $arraySeries;
                    $contador = 0;
                    foreach ($arrayEncabezdos as $llave) {
                        if (is_string($llave)) {
                            if ($llave != 'fecha' && $llave != 'imes' && $llave != 'ianio' && $llave != 'itrimestre' && $llave != 'isemestre') {
                                $arraySeries[$contador] = $llave;
                                $contador++;
                            }
                        }
                    }
/////////////////creando el grafico/////////////
                    $escala = intval($maximo / 5);
                    $log = intval(log10($escala));
                    $escala = intval($escala / pow(10, $log));
                    $escala = $escala * pow(10, $log);
                    $valorunico = 0;
                    if ($maximo >= 10 && $maximo < 100) {
                        if ($datos["opcion"] == 1) {
                            $maximo = 50;
                            $escala = 10;
                        } else {
                            $maximo = 400;
                            $escala = 40;
                        }
                    }

                    if ($accion == 0) {
                        if ($datos["opcion"] == 1) {
                            $valorunico = $arrayEncabezdos[3];
                        }
                        if ($datos["opcion"] == 2) {
                            $valorunico = $arrayEncabezdos[5];
                        }
                        if ($datos["opcion"] == 3) {
                            $valorunico = "";
                        }
                        if ($datos["opcion"] == 4) {
                            $valorunico = $arrayEncabezdos[5];
                        }
                        if ($datos["opcion"] == 5) {
                            $valorunico = $arrayEncabezdos[3];
                        }
                    }
                    if ($accion == 1) {
                        $valorunico = "";
                    }

                    $respuesta.='
                var var' . $datos["prefijo"] . '=new dhtmlXChart({
                view:"stackedBar",
                container:"' . $datos["prefijo"] . '",
                value:"#' . $valorunico . '#",
                label:"#' . $valorunico . '#",
                radius:0,
                gradient:"3d",
                color: "#EE3639",
                border:false,
                width:30,
                radius:5,
                lines: true,
                xAxis:{
                        title:"Informe Estadistico",
			template:"#' . $template . '#"
                },
                yAxis:{
                        start:0,
                        end:' . $maximo . ',
                        step:' . $escala . '
                }
                });
           ';
///////////////creando las series
                    $contador = 0;
                    $x = 1;
                    foreach ($arraySeries as $value) {
                        $arrayColores = array(1 => "#EE9E36", 2 => "#EEEA36", 3 => "#A9EE36", 4 => "#36D3EE", 5 => "#367FEE", 6 => "#9B36EE ", 7 => "#55FF00", 8 => "#00FF8E", 9 => "#00FF8E", 10 => "#9C00FF");
                        if ($contador != 0) {
                            if ($value != 'Examen') {
                                $respuesta.='var' . $datos["prefijo"] . '.addSeries({
                                
                    value: "#' . $value . '#",
                    label:"#' . $value . '#",
                    color: "' . $arrayColores[$x] . '",
                    gradient:"3d",

                    tooltip: {
                        template: "#' . $value . '#"
                    }
                    });';
                            }
                        }
                        $contador++;
                        $x++;
                    };
///////////////////////////////////
                    $respuesta.='var' . $datos["prefijo"] . '.parse(dataset_' . $datos["prefijo"] . ',"json");';
                    break;
/////////////////////////////////////////////////GRAFICO PIE //////////////////////////
                case 'pie':

                    $arrayRespuesta = $o_LReporte->lestadisticasExamenesLaboratorioClinico($datos);


                    $respuesta = 'var dataset_' . $datos["prefijo"] . '=[';
                    $numeroFilas = count($arrayRespuesta);
                    $cont = 1;
                    $arrayEncabezdos = array_keys($arrayRespuesta[0]);
                    $maximo = 0;
                    $x = 1;
                    foreach ($arrayRespuesta as $key => $value) {
                        $respuesta.='{id:"' . $cont . '"';
                        foreach ($arrayEncabezdos as $llave) {
                            $arrayColores = array(1 => "#EE9E36", 2 => "#EEEA36", 3 => "#A9EE36", 4 => "#36D3EE", 5 => "#367FEE", 6 => "#9B36EE ", 7 => "#55FF00", 8 => "#00FF8E", 9 => "#00FF8E", 10 => "#9C00FF");
                            if (is_string($llave)) {
                                $respuesta.=',' . $llave . ':"' . $value[$llave] . '",color:"' . $arrayColores[$x] . '"';
                                if (is_int($value[$llave]))
                                    if ($maximo < $value[$llave]) {
                                        $maximo = $value[$llave];
                                    }
                            }
                        }
                        $x++;
                        $respuesta.='}';
                        if ($cont == $numeroFilas) {
                            
                        } else {
                            $respuesta.=',';
                        }
                        $cont++;
                    }
                    $respuesta.='];';

                    $respuesta.='var var' . $datos["prefijo"] . '=  new dhtmlXChart({
		view:"pie",
		container:"' . $datos["prefijo"] . '",
	        value:"#' . $llave . '#",
                color: "#color#",
                legend:{
	             width: 65,
	             align: "left",
	             valign: "top",
	             marker:{
      	                 type: "round",
	                 width: 15
	             },
                     template: "#' . $llave . '#"
                },
		pieInnerText:"<b>#' . $llave . '#</b>"
                    });';
                    $respuesta.='var' . $datos["prefijo"] . '.parse(dataset_' . $datos["prefijo"] . ',"json");';
                    break;
            }
        }

        return $respuesta;
    }

    public function TablaLeyendaGraficalabo($datos) {
        $o_LReporte = new LReporte();
//////extrayendo las opciones
        $datos['bReservados'] = 0;
        $datos['bPorAtender'] = 0;
        $datos['bAtendidos'] = 0;
        $datos['bConsultaReservados'] = 0;
        $datos['bConsultaPorAtender'] = 0;
        $datos['bConsultaAtendidos'] = 0;
        $datos['bProcedimientosReservados'] = 0;
        $datos['bProcedimientosPorAtender'] = 0;
        $datos['bProcedimientosAtendidos'] = 0;
        $datos['bAdicionalReservados'] = 0;
        $datos['bAdicionalPorAtender'] = 0;
        $datos['bAdicionalAtendidos'] = 0;
        $datos['bProgramadosReservados'] = 0;
        $datos['bProgramadosPorAtender'] = 0;
        $datos['bProgramadosAtendidos'] = 0;
        $datos['codMedico1'] = "";
        $datos['codMedico2'] = "";
        $datos['codMedico3'] = "";
        $datos['codProducto'] = "";
        $datos['codAmbiLo1'] = "";
        $datos['codAmbiLo2'] = "";
        $datos['codAmbiLo3'] = "";


        $accion = 0;
///para consultas
        $datos["Atencion"] = "*******" . $datos["Atencion"];
        $datos["Estados"] = "*******" . $datos["Estados"];
        $datos["Programacion"] = "*******" . $datos["Programacion"];
//$datos["Medicos"] = "*******" . $datos["Medicos"];
        if (strpos($datos["Atencion"], 'chkAtencion_1') > 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bConsultaReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bConsultaPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bConsultaAtendidos'] = 1;
            }
        }
///para procedimeintos
        if (strpos($datos["Atencion"], 'chkAtencion_2') > 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bProcedimientosReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bProcedimientosPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bProcedimientosAtendidos'] = 1;
            }
        }
////para Programados
        if (strpos($datos["Programacion"], 'chkProgramacion_1') > 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bProgramadosReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bProgramadosPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bProgramadosAtendidos'] = 1;
            }
        }
///para adicionales
        if (strpos($datos["Programacion"], 'chkProgramacion_2') > 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bAdicionalReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bAdicionalPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bAdicionalAtendidos'] = 1;
            }
        }
        if (strpos($datos["Atencion"], 'chkAtencion_1') <= 0 && strpos($datos["Atencion"], 'chkAtencion_2') <= 0 && strpos($datos["Programacion"], 'chkProgramacion_1') <= 0 && strpos($datos["Programacion"], 'chkProgramacion_2') <= 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bAtendidos'] = 1;
            }
        }

//Examenes
        if ($datos["Examenes"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["Examenes"]);
            $codPer1 = $datosSeparados[0];
            $codPer2 = $datosSeparados[1];
            $codPer3 = $datosSeparados[2];

            $datos['codExamen1'] = $codPer1;
            $datos['codExamen2'] = $codPer2;
            $datos['codExamen3'] = $codPer3;
            $accion = 1;
        }

//Sedes
        if ($datos["Sede"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["Sede"]);
            $codSede1 = $datosSeparados[0];
            $codSede2 = $datosSeparados[1];
            $codSede3 = $datosSeparados[2];

            $datos['codSede1'] = $codSede1;
            $datos['codSede2'] = $codSede2;
            $datos['codSede3'] = $codSede3;
            $accion = 1;
        }

        //Punto Control

        if ($datos["PuntoControl"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["PuntoControl"]);
            $PuntoControl1 = $datosSeparados[0];
            $PuntoControl2 = $datosSeparados[1];
            $PuntoControl3 = $datosSeparados[2];

            $datos['PuntoControl1'] = $PuntoControl1;
            $datos['PuntoControl2'] = $PuntoControl2;
            $datos['PuntoControl3'] = $PuntoControl3;
            $accion = 1;
        }



        if ($datos["Procedencia"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["Procedencia"]);
            $Procedencia1 = $datosSeparados[0];
            $Procedencia2 = $datosSeparados[1];
            $Procedencia3 = $datosSeparados[2];
            $datos['Procedencia1'] = $Procedencia1;
            $datos['Procedencia2'] = $Procedencia2;
            $datos['Procedencia3'] = $Procedencia3;
            $accion = 1;
        }

        //afiliaciones
        if ($datos["Afiliaciones"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["Afiliaciones"]);
            $Afilicacion1 = $datosSeparados[0];
            $Afilicacion2 = $datosSeparados[1];
            $Afilicacion3 = $datosSeparados[2];
            $datos['Afiliaciones1'] = $Afilicacion1;
            $datos['Afiliaciones2'] = $Afilicacion2;
            $datos['Afiliaciones3'] = $Afilicacion3;
            $accion = 1;
        }

        //Materiales
        if ($datos["Materiales"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["Materiales"]);
            $Materiales1 = $datosSeparados[0];
            $Materiales2 = $datosSeparados[1];
            $Materiales3 = $datosSeparados[2];

            $datos['Materiales1'] = $Materiales1;
            $datos['Materiales2'] = $Materiales2;
            $datos['Materiales3'] = $Materiales3;
            $accion = 1;
        }

//Unidad de Medida
        if ($datos["UnidadMedida"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["UnidadMedida"]);
            $UnidadMedida1 = $datosSeparados[0];
            $UnidadMedida2 = $datosSeparados[1];
            $UnidadMedida3 = $datosSeparados[2];

            $datos['UnidadMedida1'] = $UnidadMedida1;
            $datos['UnidadMedida2'] = $UnidadMedida2;
            $datos['UnidadMedida3'] = $UnidadMedida3;
            $accion = 1;
        }




        if ($datos["Servicios"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["Servicios"]);
            $codPro = $datosSeparados[0];
            $datos['codProducto'] = $codPro;
            $accion = 1;
        }
        if ($datos["AmbiLo"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["AmbiLo"]);
            $AmbiLo1 = $datosSeparados[0];
            $AmbiLo2 = $datosSeparados[1];
            $AmbiLo3 = $datosSeparados[2];
            $datos['codAmbiLo1'] = $AmbiLo1;
            $datos['codAmbiLo2'] = $AmbiLo2;
            $datos['codAmbiLo3'] = $AmbiLo3;
            $accion = 1;
        }
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->TablaLeyendaGraficaLab($datos);
//       print_r($arrayFilas);
        $arrayEncabezdos = array_keys($arrayFilas[0]);
        $x = 0;
        $numero = 0;
        $contador = count($arrayEncabezdos);
        for ($x = 0; $x <= $contador; $x++) {
            if (is_numeric($arrayEncabezdos[$x])) {
                
            } else {
                if ($arrayEncabezdos[$x] != '') {
                    $arrayCabeceraFor[round(($numero / 2)) - 1] = $arrayEncabezdos[$x];
                    $arrayTamanoFor[round(($numero / 2)) - 1] = "80";
                    $arrayTipoFor[round(($numero / 2)) - 1] = "ro";
                    $arrayCursorFor[round(($numero / 2)) - 1] = "default";
                    $arrayHiddenFor[round(($numero / 2)) - 1] = "false";
                    $arrayAlingFor[round(($numero / 2)) - 1] = "center";
                }
            }
            $numero++;
        }
        $arrayCabecera = $arrayCabeceraFor;
        $arrayTamano = $arrayTamanoFor;
        $arrayTipo = $arrayTipoFor;
        $arrayCursor = $arrayCursorFor;
        $arrayHidden = $arrayHiddenFor;
        $arrayAling = $arrayAlingFor;

        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function propiedadesPopadMedicos() {
        require_once '../../cvista/reporte/propiedadesPopadMedicos.php';
    }

    public function TablaHistoriaEstadistica() {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->TablaHistoriaEstadistica();
        $arrayCabecera = array(0 => "", 1 => "", 2 => "", 3 => "", 4 => "", 5 => "", 6 => "", 7 => "", 8 => "", 9 => "", 10 => "", 11 => "", 12 => "", 13 => "", 14 => "", 15 => "", 16 => "", 17 => "", 18 => "", 19 => "", 20 => "", 21 => "", 22 => "", 23 => "", 24 => "", 25 => "", 26 => "", 27 => "", 28 => "");
        $arrayTamano = array(0 => "65", 1 => "65", 2 => "*", 3 => "*", 4 => "*", 5 => "*", 6 => "*", 7 => "*", 8 => "*", 9 => "*", 10 => "*", 11 => "*", 12 => "*", 13 => "*", 14 => "*", 15 => "*", 16 => "*", 17 => "*", 18 => "*", 19 => "*", 20 => "*", 21 => "*", 22 => "*", 23 => "*", 24 => "", 25 => "35", 26 => "35", 27 => "35", 28 => "35");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro", 9 => "ro", 10 => "ro", 11 => "ro", 12 => "ro", 13 => "ro", 14 => "ro", 15 => "ro", 16 => "ro", 17 => "ro", 18 => "ro", 19 => "ro", 20 => "ro", 21 => "ro", 22 => "ro", 23 => "ro", 24 => "ro", 25 => "ro", 26 => "img", 27 => "img", 28 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default", 10 => "default", 11 => "default", 12 => "default", 13 => "default", 14 => "default", 15 => "default", 16 => "default", 17 => "default", 18 => "default", 19 => "default", 20 => "default", 21 => "default", 22 => "default", 23 => "default", 24 => "default", 25 => "default", 26 => "pointer", 27 => "pointer", 28 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "false", 3 => "true", 4 => "true", 5 => "true", 6 => "true", 7 => "true", 8 => "true", 9 => "true", 10 => "true", 11 => "true", 12 => "true", 13 => "true", 14 => "true", 15 => "true", 16 => "true", 17 => "true", 18 => "true", 19 => "true", 20 => "true", 21 => "true", 22 => "true", 23 => "true", 24 => "true", 25 => "true", 26 => "false", 27 => "false", 28 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "center", 5 => "center", 6 => "center", 7 => "center", 8 => "center", 9 => "center", 10 => "center", 11 => "center", 12 => "center", 13 => "center", 14 => "center", 15 => "center", 16 => "center", 17 => "center", 18 => "center", 19 => "center", 20 => "center", 21 => "center", 22 => "center", 23 => "center", 24 => "center", 25 => "center", 26 => "center", 27 => "center", 28 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function cargarTablaPersonal($datos) {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->cargarTablaPersonal($datos);
        $arrayCabecera = array(0 => "", 1 => "", 2 => "", 3 => "", 4 => "");
        $arrayTamano = array(0 => "10", 1 => "55", 2 => "*", 3 => "10", 4 => "40");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "false", 3 => "true", 4 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function cargarTablaServicios($datos) {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->cargarTablaServicios($datos);
        $arrayCabecera = array(0 => "", 1 => "", 2 => "");
        $arrayTamano = array(0 => "50", 1 => "*", 2 => "40");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function ListarActividades() {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->ListarActividades();
        $arrayCabecera = array(0 => "", 1 => "", 2 => "");
        $arrayTamano = array(0 => "50", 1 => "*", 2 => "40");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function tablaAmbiFi() {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->tablaAmbiFi();
        $arrayCabecera = array(0 => "", 1 => "", 2 => "");
        $arrayTamano = array(0 => "40", 1 => "*", 2 => "40");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function tablaAmbiLo() {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->tablaAmbiLo();
        $arrayCabecera = array(0 => "", 1 => "", 2 => "");
        $arrayTamano = array(0 => "40", 1 => "*", 2 => "40");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function cargarTablaSedes() {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->cargarTablaSedes();
        $arrayCabecera = array(0 => "", 1 => "", 2 => "");
        $arrayTamano = array(0 => "50", 1 => "*", 2 => "40");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function propiedadesPopadProgramacion() {
        require_once '../../cvista/reporte/propiedadesPopadProgramacion.php';
    }

    public function ReporteIndicadorActoMedico() {
        $o_LReporte = new LReporte();
        require_once '../../cvista/reporte/ReporteIndicadorActoMedico.php';
    }

    public function ReporteEstadisticoActoMedico() {
        $o_LReporte = new LReporte();
        require_once '../../cvista/reporte/ReporteEstadisticoActoMedico.php';
    }

    public function ReportesEstadisticosActoMedico() {
        $o_LReporte = new LReporte();
        require_once '../../cvista/reporte/ReportesEstadisticosActoMedico.php';
    }

//JCQA 22 Oct 2012 
    public function aReporteIndicadorLaboratorioClinico() {
        $o_LReporte = new LReporte();
        require_once '../../cvista/reporte/ReporteIndicadorLaboratorioClinico.php';
    }

    public function abrirReporteIndicadorDiagnostico() {
        $o_LReporte = new LReporte();
        require_once '../../cvista/reporte/abrirReporteIndicadorDiagnostico.php';
    }

    public function abrirPopudDiagnosticosReporte() {
        $o_LReporte = new LReporte();
        require_once '../../cvista/reporte/abrirPopudDiagnosticosReporte.php';
    }

    public function listarBusquedaCIE($datos) {
        $o_LReporte = new LReporte();
        require_once("../../ccontrol/control/tablaAngelCompleta.php");
        $array = $o_LReporte->listarBusquedaCIE($datos);
        $tabla = new TablaAngelSayes();
        $arrayWidth = array(0 => "50", 1 => "840");
        $arrayTitulos = array(0 => "Id", 1 => "Cie Usado");
        $arrayAlign = array(0 => "center", 1 => "left");
        $arrayType = array(0 => "text", 1 => "text");
        $arrayCursor = array(0 => "pointer", 1 => "pointer");
        $arrayImagenPorCelda = array(0 => "0", 1 => "0");
        $arrayUrlImagen = array(0 => "", 1 => "");
        $arrayFunction = array(0 => "", 1 => "");
        $arrayTitle = array(0 => "", 1 => "");
        $arrayBitBusqueda = array(0 => "0", 1 => "1");
        $arrayTypeBusqueda = array(0 => "0", 1 => "text");
        $numDatosEnviadosFuncionCadena = 1;
        $arrayFunctionXCelda = array(0 => "agregarCieReporte", 1 => "agregarCieReporte");
        $arrayFuncionesDatosCombo = array(0 => "", 1 => "");
        $arrayFuncionesObjetosBusqueda = array(0 => "", 1 => "listarBusquedaCIE");
        $arrayEtiquedaId = array(0 => "", 1 => "txtBusquedaCIE");
        $height = 520;
        $ResultadoBusqueda = 1;
        $BusquedaBit = 0;
        $idNameContenedorSecundario = "lstTablaListadoCie";
        $resultado = $tabla->contructorTabla($idNameContenedorSecundario, $BusquedaBit, $arrayEtiquedaId, $arrayFuncionesObjetosBusqueda, $ResultadoBusqueda, $arrayFuncionesDatosCombo, $arrayBitBusqueda, $arrayTypeBusqueda, $numDatosEnviadosFuncionCadena, $arrayFunctionXCelda, $arrayTitle, $arrayFunction, $arrayImagenPorCelda, $arrayUrlImagen, $array, $arrayWidth, $arrayTitulos, $arrayAlign, $arrayType, $arrayCursor, $height);
        return $resultado;
    }

//JCQA 23 octubre 2012

    public function aindicadorLaboratorioClinicoListaAfiliaciones() {

        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->lindicadorLaboratorioClinicoListaAfiliaciones();

        $arrayCabecera = array(0 => "", 1 => "", 2 => "");
        $arrayTamano = array(0 => "50", 1 => "*", 2 => "30");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "pointer");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

//JCQA 23 octubre 2012

    public function aindicadorLaboratorioClinicoListaProcedencia() {

        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->lindicadorLaboratorioClinicoListaProcedencia();

        $arrayCabecera = array(0 => "", 1 => "", 2 => "");
        $arrayTamano = array(0 => "50", 1 => "*", 2 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "pointer");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

//jcqa 16Nov2012

    function AreporteDePuntoControlXExamen_indicador($datos) {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = $o_LReporte->LreporteDePuntoControlXExamen_indicador($datos);

        $arrayCabecera = array(0 => "idPuntoControl", 1 => "idPuntoControlExamenLab", 2 => "Nombre", 3 => "Secuencia", 4 => "");
        $arrayTamano = array(0 => "20", 1 => "20", 2 => "*", 3 => "50", 4 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "false", 3 => "true", 4 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    //jcqa 22Noviembre 2012

    function AreporteDeUnidadesUtilizadasxMaterialLaboratorio_IndicadorLaboratorio($datos) {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = $o_LReporte->LreporteDeUnidadesUtilizadasxMaterialLaboratorio_IndicadorLaboratorio($datos);

        $arrayCabecera = array(0 => "ID", 1 => "Nombre", 2 => "");
        $arrayTamano = array(0 => "*", 1 => "*", 2 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "pointer");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function aindicadorLaboratorioClinicoListaExamenes() {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = $o_LReporte->lindicadorLaboratorioClinicoListaExamenes();
        $arrayCabecera = array(0 => "ID", 1 => "cod ser pro", 2 => "", 3 => "IdTipoExamenLabo", 4 => "Tipo Examen Laboratorio", 5 => "Descripcion Exa L", 6 => "");
        $arrayTamano = array(0 => "45", 1 => "90", 2 => "200", 3 => "50", 4 => "*", 5 => "*", 6 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "false", 3 => "true", 4 => "true", 5 => "true", 6 => "false");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "left", 3 => "center", 4 => "center", 5 => "center", 6 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

//JCQA 23 octubre 2012


    public function aindicadorLaboratorioClinicoListaSedes() {

        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->lindicadorLaboratorioClinicoListaSedes();

        $arrayCabecera = array(0 => "", 1 => "", 2 => "");
        $arrayTamano = array(0 => "50", 1 => "*", 2 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "pointer");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function indicadorLaboratorioClinicoMaterialesLaboratorio() {

        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->indicadorLaboratorioClinicoMaterialesLaboratorio();

        $arrayCabecera = array(0 => "", 1 => "", 2 => "");
        $arrayTamano = array(0 => "30", 1 => "*", 2 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "pointer");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function cargarPopadTurnos() {
        $o_LReporte = new LReporte();
        require_once '../../cvista/reporte/cargarPopadTurnos.php';
    }

    public function grabarReporte($datos) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->grabarReporte($datos);
        if (count($respuesta) == 1)
            $idGenerado = $respuesta[0][0];
        else
            $idGenerado = "";
        return $idGenerado . "|";
    }

    public function grabarEtiqueta($datos, $datosTipo) {
        $o_LReporte = new LReporte();
        $retorna = "";
        if ($datos["p4"] == "grabar") {
            $respuesta = $o_LReporte->grabarEtiqueta($datos);
            if (count($respuesta) == 1) {
                $idGenerado = $respuesta[0][0];
                $respuesta = $o_LReporte->grabarReporteDetalle($idGenerado, $datosTipo);
                $retorna = $idGenerado . "|";
            }
        } else if ($datos["p4"] == "modificar") {
            $idEtiqueta = $datos["p1"];
            $respuesta = $o_LReporte->grabarEtiqueta($datos);
            $respuesta = $o_LReporte->grabarReporteDetalle($idEtiqueta, $datosTipo);
        }

        return $retorna;
    }

    public function grabarAtributoFormato($datos) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->grabarAtributoFormato($datos);
        return $respuesta;
    }

    public function arbolReporte() {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $resultado = $o_LReporte->arbolReporte();
        $arrayDatos = array();
        $cont = 0;
        foreach ($resultado as $i => $value) {
            if ($cont == 0) {
                $arrayDatos[$i]["id"] = "lmjc";
                $arrayDatos[$i]["titulo"] = "Lista de Reportes";
                $arrayDatos[$i]["jerarquia"] = "01";
                $arrayDatos[$i]["nivel"] = 0;
            }
            $arrayDatos[$i + 1]["id"] = $resultado[$i][0];
            $arrayDatos[$i + 1]["titulo"] = $resultado[$i][1];
            $arrayDatos[$i + 1]["jerarquia"] = $resultado[$i][2];
            $arrayDatos[$i + 1]["nivel"] = $resultado[$i][3];
            $cont++;
        }
        return $o_TablaHtmlx->generaArbol($arrayDatos);
    }

    public function editarReporte($idreporte) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->editarReporte($idreporte);
        return $respuesta;
    }

    public function listaEtiqueta($idReporte) {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->listaEtiqueta($idReporte);
        $arrayCabecera = array(0 => "idEtiqueta", 1 => "Ubicación", 2 => "Nombre Etiqueta", 3 => "Estado", 4 => "idTipoReporteDetalle", 5 => "idReporteDetalle", 6 => "Orden");
        $arrayTamano = array(0 => "70", 1 => "100", 2 => "300", 3 => "100", 4 => "50", 5 => "50", 6 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false", 3 => "false", 4 => "true", 5 => "true", 6 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function listaAtributos() {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->listaAtributos();
        $arrayCabecera = array(0 => "idAtributo", 1 => "Nombre Atributo", 2 => "Estado", 3 => "Tipo");
        $arrayTamano = array(0 => "70", 1 => "300", 2 => "100", 3 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false", 3 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left");
        $arrayCombo = array();
//        $arrayCombo[0][0]="id1";
//        $arrayCombo[0][1]="ppk";
//        $arrayCombo[1][0]="id2";
//        $arrayCombo[1][1]="toledo";
//        $arrayCombo[2][0]="id3";
//        $arrayCombo[2][1]="castaneda";
//        return $o_TablaHtmlx->generaTablaFullCombo($arrayCabecera,$arrayFilas,$arrayTamano,$arrayTipo,$arrayCursor,$arrayHidden,$arrayAling,$arrayCombo);
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function listaAsignarAtributos() {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->listaAtributos();
        $arrayCabecera = array(0 => "idAtributo", 1 => "Nombre Atributo", 2 => "Estado", 3 => "Tipo");
        $arrayTamano = array(0 => "70", 1 => "200", 2 => "50", 3 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayCursor = array(0 => "default", 1 => "pointer", 2 => "default", 3 => "default");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "true", 3 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function abrirTipoAtributoFormato($datos, $opt) {
        if ($opt == "nuevo") {
            $editarCombo = "no";
//            $idComboAtributo="";
            $idAtributo = "";
        } else if ($opt == "editar") {
            $o_LReporte = new LReporte();
            $comboAtributo = $o_LReporte->traerValoresCombo($datos);
            $editarCombo = "si";
        }

        require_once '../../cvista/vreportes/tipoAtributoFormato.php';
    }

    public function grabarAtributoCombo($datos, $datosItemCombo) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->grabarAtributoFormato($datos);
        $idAtributo = $respuesta[0][0];
        $respuesta2 = null;
        if ($idAtributo > 0) {
            $respuesta2 = $o_LReporte->grabarAtributoCombo($idAtributo, $datosItemCombo);
        }
        return $respuesta2;
    }

    public function modificarAtributoCombo($datos) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->modificarAtributoCombo($datos);
        return $respuesta;
    }

    public function asignarEtiquetaAtributo() {
        $o_LReporte = new LReporte();
        $cboTipoEtiquetaAtributo = $o_LReporte->cboTipoEtiquetaAtributo();
        require_once '../../cvista/vreportes/asignarEtiquetaAtributo.php';
    }

    public function cargarAtributoCombo($idAtributo) {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayDatos = $o_LReporte->cargarAtributoCombo($idAtributo);
        return $o_TablaHtmlx->generarCombo($arrayDatos);
    }

    public function grabarEtiquetaAtributo($datos) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->grabarEtiquetaAtributo($datos);
        return $respuesta;
    }

    public function listaEtiquetaAtributo($idEtiqueta) {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->listaEtiquetaAtributo($idEtiqueta);
        $arrayCabecera = array(0 => "idEticaAtributo", 1 => "Etiqueta", 2 => "Atributo", 3 => "Valor", 4 => "idTipo", 5 => "Tipo", 6 => "idEstado", 7 => "Estado", 8 => "Acción");
        $arrayTamano = array(0 => "50", 1 => "115", 2 => "115", 3 => "70", 4 => "50", 5 => "70", 6 => "50", 7 => "100", 8 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false", 3 => "false", 4 => "true", 5 => "false", 6 => "true", 7 => "false", 8 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "left", 7 => "left", 8 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function switchEtiquetaAtributo($datos) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->switchEtiquetaAtributo($datos);
        return $respuesta;
    }

    public function imprimirRecetaMedica($codigoProgramacion) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->existeRecetaMedica($codigoProgramacion);
        $resul;
        if ($respuesta) {
            $resul = "SI";
        } else {
            $resul = "NO";
        }
        return $resul;
    }

    public function datosRecetaMedica($codProgramacion) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->datosRecetaMedica($codProgramacion);
        return $respuesta;
    }

    public function fechasTratamienos($idProgramacion) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->fechasTratamienos($idProgramacion);
        return $respuesta;
    }

    public function atributosRecetaMedica($reporte) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->atributosRecetaMedica($reporte);
        return $respuesta;
    }

    public function modificarEtiquetaAtributo($datos) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->modificarEtiquetaAtributo($datos);
        return $respuesta;
    }

    public function labelReportePdf($reporte, $idReporte, $idTipoReorteDetalle) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->labelReportePdf($reporte, $idReporte, $idTipoReorteDetalle);
        return $respuesta;
    }

    public function datosPaciente($codPaciente) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->datosPaciente($codPaciente);
        return $respuesta;
    }

    public function centroCostosPorServicio($codProducto) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->centroCostosPorServicio($codProducto);
        return $respuesta;
    }

    public function datosPacienteImprimirHIstoria($idProgramacion) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->datosPacienteImprimirHIstoria($idProgramacion);
        return $respuesta;
    }

    public function datosPacienteRecetaEstandarizada($codPersona, $idProgramacion) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->datosPacienteRecetaEstandarizada($codPersona, $idProgramacion);
        return $respuesta;
    }

    public function aDatosPacienteTicketOrden($idTratamiento) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->lDatosPacienteTicketOrden($idTratamiento);

        return $respuesta;
    }

    public function datosMedico($codMedico) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->datosMedico($codMedico);
        return $respuesta;
    }

    public function eliminaDbComboAtributo($datos) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->eliminaDbComboAtributo($datos);
        return $respuesta;
    }

    public function seleccionarColor() {
        require_once '../../cvista/vreportes/colorpicker.php';
    }

    public function verificarHistoriaClinica($datos) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->verificarHistoriaClinica($datos);
        return $respuesta;
    }

    public function verificarHistoriaClinicaXDia($datos) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->verificarHistoriaClinicaXDia($datos);
        return $respuesta;
    }

    public function listaAtenciones($idPaciente) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->listaAtenciones($idPaciente);
        return $respuesta;
    }

    public function listaAtencionesMamografias($datos) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->listaAtencionesMamografias($datos);
        return $respuesta;
    }

    public function listaAtencionesPreventivas($dia) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->listaAtencionesPreventivas($dia);
        return $respuesta;
    }

    public function listaAtencionesXDia($idPrograma) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->listaAtencionesXDia($idPrograma);
        return $respuesta;
    }

    public function rptAntecedentes($idPaciente) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->rptAntecedentes($idPaciente);
        return $respuesta;
    }

    public function listaExamenesHCGeneral($codProgramacion,$codExamen) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->listaExamenesHCGeneral($codProgramacion,$codExamen);
        //var_dump('<pre>',$respuesta);exit();
        return $respuesta;
    }

    public function rptMotivoConsulta($idProgPaciente) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->rptMotivoConsulta($idProgPaciente);
        return $respuesta;
    }

    public function rptTriaje($idProgPaciente) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->rptTriaje($idProgPaciente);
        return $respuesta;
    }

    public function rptExamenesMedicos($idProgPaciente) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->rptExamenesMedicos($idProgPaciente);
        return $respuesta;
    }

    public function rptDiagnostico($idProgPaciente) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->rptDiagnostico($idProgPaciente);
        return $respuesta;
    }

    public function rptTratamientos($idProgPaciente, $opt) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->rptTratamientos($idProgPaciente, $opt);
        return $respuesta;
    }

    /* CAJA SIMEDH WEB */

    public function verificarRecibodePago($datos) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->verificarRecibodePago($datos);
        return $respuesta;
    }

    public function datosEmpresaGeneraelRecibo($codigoEmpresa) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->obtenerDatosEmpresaGeneraelRecibo($codigoEmpresa);
        return $respuesta;
    }

    public function datosPacienteGeneraelRecibo($numeroRecibo) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->obtenerDatosPacienteGeneraelRecibo($numeroRecibo);
        return $respuesta;
    }

    public function datosDetalleReciboGenerado($numeroRecibo) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->obtenerDatosDetalleReciboGenerado($numeroRecibo);
        return $respuesta;
    }

    public function datosPieReciboGenerado($numeroRecibo) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->obtenerDatosPieReciboGenerado($numeroRecibo);
        return $respuesta;
    }

    public function fechaEmiteResibo() {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->fechaEmiteResibo();
        return $respuesta;
    }

    public function ExitenciaHistoriaClinica($c_cod_per) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->ExitenciaHistoriaClinica($c_cod_per);
        return $respuesta;
    }

    public function eliminarEstadisticaGuardada($datos) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->eliminarEstadisticaGuardada($datos);
        return $respuesta;
    }

    public function EditarVdescripcionHistorial($datos) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->EditarVdescripcionHistorial($datos);
        return $respuesta;
    }

    public function TablaLeyendaGrafica($datos) {

        $o_LReporte = new LReporte();
        $datos['bReservados'] = 0;
        $datos['bPorAtender'] = 0;
        $datos['bAtendidos'] = 0;
        $datos['bConsultaReservados'] = 0;
        $datos['bConsultaPorAtender'] = 0;
        $datos['bConsultaAtendidos'] = 0;
        $datos['bProcedimientosReservados'] = 0;
        $datos['bProcedimientosPorAtender'] = 0;
        $datos['bProcedimientosAtendidos'] = 0;
        $datos['bAdicionalReservados'] = 0;
        $datos['bAdicionalPorAtender'] = 0;
        $datos['bAdicionalAtendidos'] = 0;
        $datos['bProgramadosReservados'] = 0;
        $datos['bProgramadosPorAtender'] = 0;
        $datos['bProgramadosAtendidos'] = 0;
        $datos['codMedico1'] = "";
        $datos['codMedico2'] = "";
        $datos['codMedico3'] = "";
        $datos['codProducto'] = "";
        $datos['codAmbiLo1'] = "";
        $datos['codAmbiLo2'] = "";
        $datos['codAmbiLo3'] = "";
        $datos['codSede1'] = "";
        $datos['codSede2'] = "";
        $datos['codSede3'] = "";
        $datos['codSede4'] = "";
        $datos['Afiliaciones1'] = "";
        $datos['Afiliaciones2'] = "";
        $datos['Afiliaciones3'] = "";
        $datos['bConsultaProgramadoReservados'] = 0;
        $datos['bConsultaProgramadoPorAtender'] = 0;
        $datos['bConsultaProgramadoAtendidos'] = 0;
        $datos['bConsultaAdicionalReservados'] = 0;
        $datos['bConsultaAdicionalPorAtender'] = 0;
        $datos['bConsultaAdicionalAtendidos'] = 0;
        $datos['bProcedimientosProgramadoReservados'] = 0;
        $datos['bProcedimientosProgramadoPorAtender'] = 0;
        $datos['bProcedimientosProgramadoAtendidos'] = 0;
        $datos['bProcedimientosAdicionalReservados'] = 0;
        $datos['bProcedimientosAdicionalPorAtender'] = 0;
        $datos['bProcedimientosAdicionalAtendidos'] = 0;
        $datos['actividad1'] = "";
        $datos['actividad2'] = "";
        $datos['actividad3'] = "";
        $datos['actividad4'] = "";
        $datos['actividad5'] = "";
        $datos['actividad6'] = "";
        $accion = 0;
///para consultas
        $datos["Atencion"] = "*******" . $datos["Atencion"];
        $datos["Estados"] = "*******" . $datos["Estados"];
        $datos["Programacion"] = "*******" . $datos["Programacion"];
//$datos["Medicos"] = "*******" . $datos["Medicos"];
        if (strpos($datos["Atencion"], 'chkAtencion_1') > 0 && strpos($datos["Programacion"], 'chkProgramacion_1') <= 0 && strpos($datos["Programacion"], 'chkProgramacion_2') <= 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bConsultaReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bConsultaPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bConsultaAtendidos'] = 1;
            }
        }
        if (strpos($datos["Atencion"], 'chkAtencion_1') > 0 && strpos($datos["Programacion"], 'chkProgramacion_1') > 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bConsultaProgramadoReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bConsultaProgramadoPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bConsultaProgramadoAtendidos'] = 1;
            }
        }
        if (strpos($datos["Atencion"], 'chkAtencion_1') > 0 && strpos($datos["Programacion"], 'chkProgramacion_2') > 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bConsultaAdicionalReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bConsultaAdicionalPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bConsultaAdicionalAtendidos'] = 1;
            }
        }
        //para estados      
        if (strpos($datos["Atencion"], 'chkAtencion_1') <= 0 && strpos($datos["Atencion"], 'chkAtencion_2') <= 0 && strpos($datos["Programacion"], 'chkProgramacion_1') <= 0 && strpos($datos["Programacion"], 'chkProgramacion_2') <= 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bAtendidos'] = 1;
            }
        }

///para procedimeintos
        if (strpos($datos["Atencion"], 'chkAtencion_2') > 0 && strpos($datos["Programacion"], 'chkProgramacion_1') <= 0 && strpos($datos["Programacion"], 'chkProgramacion_2') <= 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bProcedimientosReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bProcedimientosPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bProcedimientosAtendidos'] = 1;
            }
        }
        if (strpos($datos["Atencion"], 'chkAtencion_2') > 0 && strpos($datos["Programacion"], 'chkProgramacion_1') > 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bProcedimientosProgramadoReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bProcedimientosProgramadoPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bProcedimientosProgramadoAtendidos'] = 1;
            }
        }
        if (strpos($datos["Atencion"], 'chkAtencion_2') > 0 && strpos($datos["Programacion"], 'chkProgramacion_2') > 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bProcedimientosAdicionalReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bProcedimientosAdicionalPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bProcedimientosAdicionalAtendidos'] = 1;
            }
        }
////para Programados
        if (strpos($datos["Programacion"], 'chkProgramacion_1') > 0 && strpos($datos["Atencion"], 'chkAtencion_1') <= 0 && strpos($datos["Atencion"], 'chkAtencion_2') <= 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bProgramadosReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bProgramadosPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bProgramadosAtendidos'] = 1;
            }
        }
///para adicionales
        if (strpos($datos["Programacion"], 'chkProgramacion_2') > 0 && strpos($datos["Atencion"], 'chkAtencion_1') <= 0 && strpos($datos["Atencion"], 'chkAtencion_2') <= 0) {
            if (strpos($datos["Estados"], 'chkEstado_1') > 0) {
                $datos['bAdicionalReservados'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_2') > 0) {
                $datos['bAdicionalPorAtender'] = 1;
            }
            if (strpos($datos["Estados"], 'chkEstado_3') > 0) {
                $datos['bAdicionalAtendidos'] = 1;
            }
        }

////para Medico///
        if ($datos["Medicos"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["Medicos"]);
            $codPer1 = $datosSeparados[0];
            $codPer2 = $datosSeparados[1];
            $codPer3 = $datosSeparados[2];
            $datos['codMedico1'] = $codPer1;
            $datos['codMedico2'] = $codPer2;
            $datos['codMedico3'] = $codPer3;
            $accion = 1;
        }


        if ($datos["Servicios"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["Servicios"]);
            $codPro = $datosSeparados[0];
            $datos['codProducto'] = $codPro;
            $accion = 1;
        }
        if ($datos["AmbiLo"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["AmbiLo"]);
            $AmbiLo1 = $datosSeparados[0];
            $AmbiLo2 = $datosSeparados[1];
            $AmbiLo3 = $datosSeparados[2];
            $datos['codAmbiLo1'] = $AmbiLo1;
            $datos['codAmbiLo2'] = $AmbiLo2;
            $datos['codAmbiLo3'] = $AmbiLo3;
            $accion = 1;
        }

        if ($datos["Afiliaciones"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["Afiliaciones"]);
            $Afiliaciones1 = $datosSeparados[0];
            $Afiliaciones2 = $datosSeparados[1];
            $Afiliaciones3 = $datosSeparados[2];
            $datos['Afiliaciones1'] = $Afiliaciones1;
            $datos['Afiliaciones2'] = $Afiliaciones2;
            $datos['Afiliaciones3'] = $Afiliaciones3;
            $accion = 1;
        }

        if ($datos["Sedes"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["Sedes"]);
            $Sedes1 = $datosSeparados[0];
            $Sedes2 = $datosSeparados[1];
            $Sedes3 = $datosSeparados[2];
            $Sedes4 = $datosSeparados[3];
            $datos['CodSede1'] = $Sedes1;
            $datos['CodSede2'] = $Sedes2;
            $datos['CodSede3'] = $Sedes3;
            $datos['CodSede4'] = $Sedes4;
            $accion = 1;
        }


        if ($datos["actividades"] == "") {
            
        } else {
            $datosSeparados = explode("|", $datos["actividades"]);
            $actividades1 = $datosSeparados[0];
            $actividades2 = $datosSeparados[1];
            $actividades3 = $datosSeparados[2];
            $actividades4 = $datosSeparados[3];
            $actividades5 = $datosSeparados[4];
            $actividades6 = $datosSeparados[5];
            $datos['actividades1'] = $actividades1;
            $datos['actividades2'] = $actividades2;
            $datos['actividades3'] = $actividades3;
            $datos['actividades4'] = $actividades4;
            $datos['actividades5'] = $actividades5;
            $datos['actividades6'] = $actividades6;
            $accion = 1;
        }


        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->TablaLeyendaGrafica($datos);
        $arrayEncabezdos = array_keys($arrayFilas[0]);
        $x = 0;
        $numero = 0;
        $contador = count($arrayEncabezdos);
        for ($x = 0; $x <= $contador; $x++) {
            if (is_numeric($arrayEncabezdos[$x])) {
                
            } else {
                if ($arrayEncabezdos[$x] != '') {
                    $arrayCabeceraFor[round(($numero / 2)) - 1] = $arrayEncabezdos[$x];
                    $arrayTamanoFor[round(($numero / 2)) - 1] = '"*"';
                    $arrayTipoFor[round(($numero / 2)) - 1] = 'txt';
                    $arrayCursorFor[round(($numero / 2)) - 1] = '"default"';
                    $arrayHiddenFor[round(($numero / 2)) - 1] = '"false"';
                    $arrayAlingFor[round(($numero / 2)) - 1] = '"center"';
                }
            }
            $numero++;
        }
        $arrayCabecera = $arrayCabeceraFor;
        $arrayTamano = $arrayTamanoFor;
        $arrayTipo = $arrayTipoFor;
        $arrayCursor = $arrayCursorFor;
        $arrayHidden = $arrayHiddenFor;
        $arrayAling = $arrayAlingFor;

        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function mostrarReportesFechas($datos) {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->mostrarReportesFechas($datos);
        $arrayCabecera = array(0 => "idCie", 1 => "cCodigoCie", 2 => "vDescripcion", 3 => "Cantidad");
        $arrayTamano = array(0 => "50", 1 => "50", 2 => "*", 3 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayCursor = array(0 => "default", 1 => "pointer", 2 => "default", 3 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function mostrarReportesFechasSede($datos) {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->mostrarReportesFechasSede($datos);
        $arrayCabecera = array(0 => "idCie", 1 => "cCodigoCie", 2 => "vDescripcion", 3 => "Sede", 4 => "Cantidad");
        $arrayTamano = array(0 => "50", 1 => "50", 2 => "*", 3 => "*", 4 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro");
        $arrayCursor = array(0 => "default", 1 => "pointer", 2 => "default", 3 => "default", 4 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function mostrarReportesFechasAfiliacion($datos) {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->mostrarReportesFechasAfiliacion($datos);
        $arrayCabecera = array(0 => "idCie", 1 => "cCodigoCie", 2 => "vDescripcion", 3 => "Afiliacion", 4 => "Cantidad");
        $arrayTamano = array(0 => "50", 1 => "50", 2 => "*", 3 => "*", 4 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro");
        $arrayCursor = array(0 => "default", 1 => "pointer", 2 => "default", 3 => "default", 4 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function mostrarReportesFechasCie($datos) {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->mostrarReportesFechasCie($datos);
        $arrayCabecera = array(0 => "idCie", 1 => "cCodigoCie", 2 => "vDescripcion", 3 => "Cantidad");
        $arrayTamano = array(0 => "50", 1 => "50", 2 => "*", 3 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayCursor = array(0 => "default", 1 => "pointer", 2 => "default", 3 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function mostrarReportesFechasAfiliacionSede($datos) {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->mostrarReportesFechasAfiliacionSede($datos);
        $arrayCabecera = array(0 => "idCie", 1 => "cCodigoCie", 2 => "vDescripcion", 3 => "Afiliacion", 4 => "Sede", 5 => "Cantidad");
        $arrayTamano = array(0 => "50", 1 => "50", 2 => "*", 3 => "*", 4 => "*", 5 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro");
        $arrayCursor = array(0 => "default", 1 => "pointer", 2 => "default", 3 => "default", 4 => "default", 5 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function mostrarReportesFechasAfiliacionCIE($datos) {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->mostrarReportesFechasAfiliacionCIE($datos);
        $arrayCabecera = array(0 => "idCie", 1 => "cCodigoCie", 2 => "vDescripcion", 3 => "Afiliacion", 4 => "Cantidad");
        $arrayTamano = array(0 => "50", 1 => "50", 2 => "*", 3 => "*", 4 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro");
        $arrayCursor = array(0 => "default", 1 => "pointer", 2 => "default", 3 => "default", 4 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function mostrarReportesFechasSedeCIE($datos) {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->mostrarReportesFechasSedeCIE($datos);
        $arrayCabecera = array(0 => "idCie", 1 => "cCodigoCie", 2 => "vDescripcion", 3 => "Sede", 4 => "Cantidad");
        $arrayTamano = array(0 => "50", 1 => "50", 2 => "*", 3 => "*", 4 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro");
        $arrayCursor = array(0 => "default", 1 => "pointer", 2 => "default", 3 => "default", 4 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function mostrarReportesFechasAfiliacionSedeCIE($datos) {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->mostrarReportesFechasAfiliacionSedeCIE($datos);
        $arrayCabecera = array(0 => "idCie", 1 => "cCodigoCie", 2 => "vDescripcion", 3 => "Afiliacion", 4 => "Sede", 5 => "Cantidad");
        $arrayTamano = array(0 => "50", 1 => "50", 2 => "*", 3 => "*", 4 => "*", 5 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro");
        $arrayCursor = array(0 => "default", 1 => "pointer", 2 => "default", 3 => "default", 4 => "default", 5 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    //*******************************************************************************************
    public function AmostrarReporteGrupoEtareo() {
        require_once '../../cvista/reporte/mostrarReporteGrupoEtareo.php';
    }

    public function AbuscarReporteGruposEtareos() {
        $o_TablaHtmlx = new tablaDHTMLX();
        $o_LReporte = new LReporte();
        $arrayFilas = $o_LReporte->LbuscarReporteGruposEtareos();
        $arrayCabecera = array("0" => "Nro", "1" => "idPAquete", "2" => "Cod. Essalud", "3" => "Paquete", "4" => "Nro Servicios", "5" => "Serv. Completados", "6" => "Avance", "7" => "% Avance", "8" => "Nro Pacientes");
        $arrayTamano = array(0 => "30", 1 => "*", 2 => "50", 3 => "*", 4 => "35", 5 => "50", 6 => "50", 7 => "50", 8 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro");
        $arrayAlineacion = array("0" => "center", "1" => "center", "2" => "center", "3" => "left", "4" => "center", "5" => "center", "6" => "center", "7" => "center", "8" => "center");
        $arrayHidden = array("0" => "false", "1" => "true", "2" => "false", "3" => "false", "4" => "false", "5" => "false", "6" => "true", "7" => "false", "8" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function AbuscarPersonasGrupoEtareo($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $o_LReporte = new LReporte();
        $arrayFilas = $o_LReporte->LbuscarPersonasGrupoEtareo($datos);
        $arrayCabecera = array("0" => "cod.Persona", "1" => "Nombre");
        $arrayTamano = array(0 => "70", 1 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro");
        $arrayAlineacion = array("0" => "center", "1" => "left");
        $arrayHidden = array("0" => "false", "1" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function buscarMedicamento($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $o_LReporte = new LReporte();
        $arrayFilas = $o_LReporte->buscarMedicamento($datos);
        $arrayCabecera = array("0" => "Codigo", "1" => "Descripcion");
        $arrayTamano = array(0 => "70", 1 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro");
        $arrayAlineacion = array("0" => "center", "1" => "left");
        $arrayHidden = array("0" => "false", "1" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function buscarMEdico($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $o_LReporte = new LReporte();
        $arrayFilas = $o_LReporte->buscarMEdico($datos);
        $arrayCabecera = array("0" => "Codigo", "1" => "Medico");
        $arrayTamano = array(0 => "70", 1 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro");
        $arrayAlineacion = array("0" => "center", "1" => "left");
        $arrayHidden = array("0" => "false", "1" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function mostrarReportesFechasRecetaMedica($datos) {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->mostrarReportesFechasRecetaMedica($datos);
        $arrayCabecera = array(0 => "Codigo Servicio", 1 => "Descripcion", 2 => "Cantidad");
        $arrayTamano = array(0 => "80", 1 => "*", 2 => "80");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro");
        $arrayCursor = array(0 => "default", 1 => "pointer", 2 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function mostrarReportesMedicamentoRecetaMedica($datos) {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->mostrarReportesMedicamentoRecetaMedica($datos);
        $arrayCabecera = array(0 => "Medico", 1 => "Cantidad");
        $arrayTamano = array(0 => "*", 1 => "80");
        $arrayTipo = array(0 => "ro", 1 => "ro");
        $arrayCursor = array(0 => "default", 1 => "pointer");
        $arrayHidden = array(0 => "false", 1 => "false");
        $arrayAling = array(0 => "left", 1 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function mostrarReportesFechasMedico($datos) {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->mostrarReportesFechasMedico($datos);
        $arrayCabecera = array(0 => "Codigo Servicio", 1 => "Descripcion", 2 => "Cantidad");
        $arrayTamano = array(0 => "80", 1 => "*", 2 => "80");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro");
        $arrayCursor = array(0 => "default", 1 => "pointer", 2 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function ventanaMostrarCPTfaltantes() {
        require_once '../../cvista/reporte/ventanaMostrarCPTfaltantes.php';
    }

    function AmostrarCPTfaltantes($datos) {
        $o_LReporte = new LReporte();
        $resultado = $o_LReporte->LmostrarCPTfaltantes($datos);
        $idGrupoEtareoAux = 0;
        $idGrupoEtareo = 0;
        $rs = '';
        $codigoPersona = $datos['c_cod_per'];
        foreach ($resultado as $key => $value) {
            $idGrupoEtareo = $value[1];
            if ($idGrupoEtareoAux != $idGrupoEtareo) {
                $rs.="<h3>$codigoPersona - $value[3]</h3>";
                $rs.= '<table cellspacing="1" style="border:0px solid;">
                            <tr style="background-image:url(\'../../../../fastmedical_front/imagen/icono/fondogrid.png\');height: 30px;">
                            <td style="width: 100px;border:0px solid #BBE796">
                            <center><p style="font-size:16px;font-family: segoe UI;color:#006631"><b>Nro</b></p></center>
                            </td>
                            <td style="width: 700px;border:0px solid #BBE796">
                            <center><p style="font-size:16px;font-family: segoe UI;color:#006631"><b>Servicio</b></p></center>
                            </td>
                            <td style="width: 250px;border:0px solid #BBE796">
                            <center><p style="font-size:16px;font-family: segoe UI;color:#006631"><b>Atenciones</b></p></center>
                            </td>
                            </tr>';
                foreach ($resultado as $key1 => $value1) {
                    if ($value1[1] == $value[1]) {
                        if ($value1[5] == 0) {
                            $rs.='<tr style=\'background:#ffcccc; \'  onmouseout=\'this.style.background="#ffcccc";\' onmouseover=\'this.style.background="#ffaaaa";\'> ';
                        } else {
                            $rs.='<tr onmouseout=\'this.style.background="#FFFFFF";\' onmouseover=\'this.style.background="#BBE796";\'> ';
                        }
                        $rs.='<td>
                           <center><p style="font-size:12px;font-family: segoe UI;color:#006631">' . $value1[0] . '</p></center>
                           </td>
                           <td>
                           <p style="font-size:12px;font-family: segoe UI;color:#006631">' . $value1[4] . '</p>
                           </td>
                           <td>
                           <center><p style="font-size:12px;font-family: segoe UI;color:#006631">' . $value1[5] . '</p></center>
                           </td>
                           </tr>';
                    }
                }
                $rs.="</table>";
            }
            $idGrupoEtareoAux = $idGrupoEtareo;
        }
        $rs1 = '<table cellspacing="1" style="border:0px solid;">
                          <tr style="background-image:url(\'../../../../fastmedical_front/imagen/icono/fondogrid.png\');height: 30px;">
                          <td style="width: 100px;border:0px solid #BBE796">
                          <center><p style="font-size:16px;font-family: segoe UI;color:#006631"><b>Nro</b></p></center>
                          </td>
                          <td style="width: 700px;border:0px solid #BBE796">
                          <center><p style="font-size:16px;font-family: segoe UI;color:#006631"><b>Paquete</b></p></center>
                          </td>
                          <td style="width: 700px;border:0px solid #BBE796">
                          <center><p style="font-size:16px;font-family: segoe UI;color:#006631"><b>Servicio</b></p></center>
                          </td>
                          <td style="width: 250px;border:0px solid #BBE796">
                          <center><p style="font-size:16px;font-family: segoe UI;color:#006631"><b>Atenciones</b></p></center>
                          </td>     
                          </tr>';
        $contador = count($resultado);
        for ($x = 0; $x <= $contador - 1; $x++) {
            $j = 0;
            $rs1.='<tr style=onmouseout=\'this.style.background="#FFFFFF";\' onmouseover=\'this.style.background="#BBE796";\'>                 
                           <td>
                           <center><p style="font-size:12px;font-family: segoe UI;color:#006631">' . $resultado[$x][0] . '</p></center>
                           </td>
                           <td>
                           <p style="font-size:12px;font-family: segoe UI;color:#006631">' . $resultado[$x][3] . '</p>
                           </td>
                           <td>
                           <center><p style="font-size:12px;font-family: segoe UI;color:#006631">' . $resultado[$x][4] . '</p></center>
                           </td>
                           <td>
                           <center><p style="font-size:12px;font-family: segoe UI;color:#006631">' . $resultado[$x][5] . '</p></center>
                           </td>
                           </tr>';
            $j++;
        }
        $rs1.='</table>';
        return utf8_encode($rs);
    }

    function abrirModuloReporteRecetasMedicas() {
        $o_LReporte = new LReporte();
        require_once '../../cvista/reporte/abrirModuloReporteRecetasMedicas.php';
    }

    function aVentanaEssalud() {

        require_once '../../cvista/reporte/vVentanaEssalud.php';
    }

    function aClickCargarVistaReportesEssalud($datos) {
        require_once '../../cvista/reporte/' . $datos["p2"];
    }

    function aVerificarSubCarpetas($datos) {
        require_once '../../cvista/reporte/aVerificarSubCarpetas.php';
    }

    function aVerificarExistenciaCarpeta($datos) {
        require_once '../../cvista/reporte/aVerificarExistenciaCarpeta.php';
    }

    function aCargarTablaProgramacionDHTMLX() {
        $o_LReporte = new LReporte();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->lCargarTablaProgramacionDHTMLX();
        $arrayCabecera = array(0 => "Id", 1 => "DESCRIPCION", 2 => "ENERO", 3 => "FEBRERO", 4 => "MARZO", 5 => "ABRIL", 6 => "MAYO", 7 => "JUNIO", 8 => "JULIO", 9 => "AGOSTO", 10 => "SETIEMBRE", 11 => "OCTUBRE", 12 => "NOVIEMBRE", 13 => "DICIEMBRE", 14 => "TOTAL");
        $arrayTamano = array(0 => "30", 1 => "*", 2 => "50", 3 => "50", 4 => "50", 5 => "50", 6 => "50", 7 => "50", 8 => "50", 9 => "50", 10 => "50", 11 => "50", 12 => "50", 13 => "50", 14 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro", 9 => "ro", 10 => "ro", 11 => "ro", 12 => "ro", 13 => "ro", 14 => "ro");
        $arrayCursor = array(0 => "default", 1 => "pointer", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default", 10 => "default", 11 => "default", 12 => "default", 13 => "default", 14 => "default");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false", 6 => "false", 7 => "false", 8 => "false", 9 => "false", 10 => "false", 11 => "false", 12 => "false", 13 => "false", 14 => "false");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "right", 3 => "right", 4 => "right", 5 => "right", 6 => "right", 7 => "right", 8 => "right", 9 => "right", 10 => "right", 11 => "right", 12 => "right", 13 => "right", 14 => "right");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function aMostrarReporteOperacionalTBC() {
        $o_LReporte = new LReporte();
        $arrayFilas = $o_LReporte->lmostrarReporteOperacionalTBC();
        require_once '../../cvista/reporte/cargarArbol.php';
    }

    public function aArrayHojaNSIG() {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->lArrayHojaNSIG();
        return $respuesta;
    }

    public function aArrayGrupoNSIG() {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->lArrayGrupoNSIG();
        return $respuesta;
    }

    public function aArrayActividadNSIG() {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->lArrayActividadNSIG();
        return $respuesta;
    }

    public function aArrayServicioNSIG() {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->lArrayServicioNSIG();
        return $respuesta;
    }

    public function rptAntecedentesPRograma($idPrograma) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->rptAntecedentesPRograma($idPrograma);
        return $respuesta;
    }

    public function aDatosExamenes($iIdUbicacionesImagenes) {
        $o_LReporte = new LReporte();
        $respuesta = $o_LReporte->lDatosExamenes($iIdUbicacionesImagenes);
        return $respuesta;
    }

    public function getBuscarPersonasReporte($patron, $tipoDoc, $parametro, $funcion, $editar) {
        $o_LReporte = new LReporte();
        $patron = str_replace("\\", '', $patron);
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LReporte->getBuscarPersonasReporte($patron, $tipoDoc, $parametro, $editar);
        $arrayCabecera = array(0 => "Codigo", 1 => "Nombre", 2 => "", 3 => "", 4 => "", 5 => "", 6 => "", 7 => "...");
        $arrayTamano = array(0 => "50", 1 => "*", 2 => "*", 3 => "50", 4 => "50", 5 => "50", 6 => "50", 7 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "img", 5 => "ro", 6 => "ro", 7 => "ro");
        $arrayCursor = array(0 => "default", 1 => "pointer", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "true", 4 => "false", 5 => "true", 6 => "true", 7 => "true");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "left", 3 => "left", 4 => "center", 5 => "left", 6 => "left", 7 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

//*******************************************************************************************
}

?>