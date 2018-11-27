<?php

/* ../../classReporte/reportes/setDatosReporte.php?p1=recetaUnicaEstandarizada&p2=1&p3=4171974&p4=286267&p5=0030860&p6=4
 * 
 * p2 => modo de impresion de reporte --> (1=>label y datos, 0=>solo datos)
 * p3 => codigo de programacion
 * p4 => codigo de persona
 * p5 => codigo de medico
 * p6 => idReporte 
 */
header('Content-Type: text/html; charset=iso-8859-1');
require_once('../../ccontrol/control/ActionActoMedico.php');
require_once('../../ccontrol/control/ActionReporte.php');
require_once('../../clogica/LActoMedico.php');
require_once('../../ccontrol/control/ActionActoMedico.php');
try {
    $o_ActionReporte = new ActionReporte();
    $opcion = $_REQUEST["p1"];
    $modo = $_REQUEST["p2"];
    $parametros = array();
    $parametros["PDF_PAGE_FORMAT"] = "A4";
    $parametros["PDF_MARGIN_HEADER"] = 5;
    $parametros["PDF_MARGIN_FOOTER"] = 10;
    $parametros["AUTO_PAGE_BREAK"] = true;
    $parametros["PDF_MARGIN_BOTTOM"] = 25;
    $parametros["PDF_PAGE_ORIENTATION"] = "P";
    $parametros["PDF_MARGIN_LEFT"] = 15;
    $parametros["PDF_MARGIN_TOP"] = 27;
    $parametros["PDF_MARGIN_RIGHT"] = 15;
    $parametros["PRINT_HEADER"] = true;
    $parametros["PRINT_FOOTER"] = true;

    switch ($opcion) {
        case "recetaMedica": {
                require_once('generadorDeReportes.php');
                $setdat = new PluginMYPDF();

                $codProgramacion = $_REQUEST["p3"];
                $codPaciente = $_REQUEST["p4"];
                $codMedico = $_REQUEST["p5"];
                $idReporte = $_REQUEST["p6"];
                $nombreReporte = "RecetaMedica" . $codProgramacion;

                /* ===================================================================================================== */
                /* =======================================   Datos de Cabecera   ============================================ */
                $labelCabecera = $o_ActionReporte->labelReportePdf("recetamedica", $idReporte, 1);
                $datosPaciente = $o_ActionReporte->datosPaciente($codPaciente);
                $datosCabecera = array();
                $datosCabecera[2] = $codProgramacion;
                $datosCabecera[4] = $datosPaciente[0][0];
                $datosCabecera[5] = $datosPaciente[0][1] . " " . $datosPaciente[0][2] . " " . $datosPaciente[0][3];
                $datosCabecera[6] = date('d-m-Y', time() + 3600);
                $datosCabecera[7] = date('H:i:s', time() + 3600);

                /* ===================================================================================================== */
                /* =======================================   Datos de Detalle   ============================================ */
                $labelDetalle = $o_ActionReporte->labelReportePdf("recetamedica", $idReporte, 2);
                $datosDet = $o_ActionReporte->datosRecetaMedica($codProgramacion);
                $datosDetalle = array();
                foreach ($datosDet as $i => $value) {
                    $datosDetalle[$i][0] = $datosDet[$i][3];
                    $datosDetalle[$i][1] = utf8_encode($datosDet[$i][6]);
                    $datosDetalle[$i][2] = $datosDet[$i][4];
//                    $datosDetalle[$i][3]=$datosDet[$i][7];
                }

                /* ===================================================================================================== */
                /* =======================================   Datos de Pie   ============================================ */
                $datosPie = array();
                $labelPie = $o_ActionReporte->labelReportePdf("recetamedica", $idReporte, 3);
                $datosMedico = $o_ActionReporte->datosMedico($codMedico);
                $datosPie[0] = $datosMedico[0][1] . " " . $datosMedico[0][2] . " " . $datosMedico[0][3];
                $datosPie[1] = $datosMedico[0][0];

                /* ===================================================================================================== */
                /* =====================================   Todo Los atributos   ======================================== */
                $atributosReceta = $o_ActionReporte->atributosRecetaMedica($idReporte);
                $parametros["PDF_PAGE_FORMAT"] = "RECETA_MEDICA";
                $parametros["PRINT_HEADER"] = false;
                $parametros["PRINT_FOOTER"] = false;
                $parametros["PDF_MARGIN_LEFT"] = 10;
                $parametros["PDF_MARGIN_RIGHT"] = 10;
                $parametros["PDF_MARGIN_TOP"] = 10;
                $parametros["AUTO_PAGE_BREAK"] = false;
                $parametros["PDF_PAGE_ORIENTATION"] = "P";
                $setdat->generarMYPDF($atributosReceta, $labelCabecera, $labelDetalle, $labelPie, $datosCabecera, $datosDetalle, $datosPie, $modo, $nombreReporte, $parametros);
                break;
            }
        case "recetaUnicaEstandarizada": {
                require_once('generarRecetaMedica.php');
                $setdat = new generarMYPDFRME();

                $codProgramacion = $_REQUEST["p3"];
                $codPersona = $_REQUEST["p4"]; //para el paciente
                $codMedico = $_REQUEST["p5"];
                $idReporte = $_REQUEST["p6"];
                $nombreReporte = "RecetaMedica" . $codProgramacion;
                /* ===================================================================================================== */
                /* =======================================   Datos de Cabecera   ============================================ */
                $labelCabecera = $o_ActionReporte->labelReportePdf("recetaUnicaEstandarizada", $idReporte, 1);
                $datosPaciente = $o_ActionReporte->datosPacienteRecetaEstandarizada($codPersona, $codProgramacion);
                $diagnosticos = trim($datosPaciente[0][11]);

                for ($i = 1; $i < count($datosPaciente); $i++) {
                    $diagnosticos = $diagnosticos . " - " . trim($datosPaciente[$i][11]);
                }

                $datosCabecera = array();
                $datosCabecera[2] = $datosPaciente[0][8]; // codigorecetaunica
                $datosCabecera[3] = utf8_encode($datosPaciente[0][2]); //nombres
                $datosCabecera[4] = $datosPaciente[0][3]; //edad
                $datosCabecera[5] = $datosPaciente[0][4]; // Nro Historia clínica
                $datosCabecera[6] = $datosPaciente[0][7]; //tipo usuario
                $datosCabecera[7] = $datosPaciente[0][5]; //atencion
                $datosCabecera[8] = utf8_encode($datosPaciente[0][6]); //especialidad
                $datosCabecera[9] = $diagnosticos; //diagnostico presuntivo
                $datosCabecera[10] = $datosPaciente[0][9]; //dni
                $datosCabecera[11] = utf8_encode($datosPaciente[0][10]); //medico tratante
                $datosCabecera[12] = $datosPaciente[0][12]; //fecha de atencion
//print_r($datosCabecera);
                /* ===================================================================================================== */
                /* =======================================   Datos de Detalle   ============================================ */
                $labelDetalle = $o_ActionReporte->labelReportePdf("recetaUnicaEstandarizada", $idReporte, 2);
                $datosDet = $o_ActionReporte->datosRecetaMedica($codProgramacion);
//print_r($datosDet);
                $datosDetalle = array();
                foreach ($datosDet as $i => $value) {
//                    $datosDetalle[$i][0]=$datosDet[$i][3];
//                    $datosDetalle[$i][1]=$datosDet[$i][6];
//                    $datosDetalle[$i][2]=$datosDet[$i][4];
//                    $datosDetalle[$i][3]=$datosDet[$i][5];
                    $datosDetalle[$i][0] = $datosDet[$i][0];
                    $datosDetalle[$i][1] = $datosDet[$i][1];
                    $datosDetalle[$i][2] = $datosDet[$i][2];
                    $datosDetalle[$i][3] = $datosDet[$i][3];
                    $datosDetalle[$i][4] = $datosDet[$i]['vModoAplicacion'];
                }
                //print_r(  $datosDet);
                //  print_r(  $datosDetalle);
//               $datosDetalle = array();
//               $datosDetalle = array(
//                       0=>array("medicamento xxxxx es una prueba para generar receta medicas estandarizadas, dn ad sm dms ds","230 mg", "expediente x","1000","dosis xx","2 al dia","oral","1semana"),
//                       1=>array("medicamento xxxxx","230 mg", "expediente x","1000","dosis xx","2 al dia","oral","1semana"),
//                       2=>array("medicamento xxxxx","230 mg", "expediente x","1000","dosis xx","2 al dia","oral","1semana"),
//                       3=>array("medicamento xxxxx es una prueba para generar receta medicas estandarizadas, dn ad sm dms ds","230 mg", "expediente x","1000","dosis xx","2 al dia","oral","1semana"),
//                       4=>array("medicamento xxxxx","230 mg", "expediente x","1000","dosis xx","2 al dia","oral","1semana"),
//                       5=>array("medicamento xxxxx","230 mg", "expediente x","1000","dosis xx","2 al dia","oral","1semana"),
//                       6=>array("medicamento xxxxx es una prueba para generar receta medicas estandarizadas, dn ad sm dms ds","230 mg", "expediente x","1000","dosis xx","2 al dia","oral","1semana"),7=>array("medicamento xxxxx","230 mg", "expediente x","1000","dosis xx","2 al dia","oral","1semana"),8=>array("medicamento xxxxx","230 mg", "expediente x","1000","dosis xx","2 al dia","oral","1semana")
//                   );



                /* ===================================================================================================== */
                /* =======================================   Datos de Pie   ============================================ */
                $datosPie = array();
                $labelPie = $o_ActionReporte->labelReportePdf("recetaUnicaEstandarizada", $idReporte, 3);
                $fechasTratamiento = $o_ActionReporte->fechasTratamienos($codProgramacion);
//               exit ();
                if ($fechasTratamiento[0][1] == '01/01/1900') {
                    $datosPie[1] = "";
                } else {
                    $datosPie[1] = $fechasTratamiento[0][1]; //proxima cita sugerida
                }
                $datosPie[2] = $fechasTratamiento[0][2]; //fecha de vencimiento de la receta
                $datosPie[6] = $fechasTratamiento[0][3]; //Nro Orden Receta

                /* ===================================================================================================== */
                /* =====================================   Todo Los atributos   ======================================== */
                $atributosReceta = $o_ActionReporte->atributosRecetaMedica($idReporte);
                $parametros["PDF_PAGE_FORMAT"] = "RECETA_MEDICA_ESTANDARIZADA";
                $parametros["PRINT_HEADER"] = false;
                $parametros["PRINT_FOOTER"] = false;
                $parametros["PDF_MARGIN_LEFT"] = 6;
                $parametros["PDF_MARGIN_RIGHT"] = 6;
                $parametros["PDF_MARGIN_TOP"] = 6;
                $parametros["AUTO_PAGE_BREAK"] = false;
                $parametros["PDF_PAGE_ORIENTATION"] = "L";
                $parametros["CODIGO_DE_BARRAS"] = $fechasTratamiento[0][3]; //nro de la orden generada
                $setdat->generarMYPDF_RME($atributosReceta, $labelCabecera, $labelPie, $datosCabecera, $datosDetalle, $datosPie, $modo, $nombreReporte, $parametros);
                break;
            }
        case "recetaOrdenMedica": {
                require_once('generarMYPDF_RME_ORDEN_MEDICA.php');
                $setdat = new generarMYPDFRME_ORDENMEDICA();

                $codProgramacion = $_REQUEST["p3"];
                $codPersona = $_REQUEST["p4"]; //para el paciente
                $codMedico = $_REQUEST["p5"];
                $idReporte = $_REQUEST["p6"];
                $nombreReporte = "OrdenMedica" . $codProgramacion;
                /* ===================================================================================================== */
                /* =======================================   Datos de Cabecera   ============================================ */
                $labelCabecera = $o_ActionReporte->labelReportePdf("", $idReporte, 1);
                $datosPaciente = $o_ActionReporte->datosPacienteRecetaEstandarizada($codPersona, $codProgramacion);
                $diagnosticos = trim($datosPaciente[0][11]);

                for ($i = 1; $i < count($datosPaciente); $i++) {
                    $diagnosticos = $diagnosticos . " - " . trim($datosPaciente[$i][11]);
                }

                $datosCabecera = array();
                $datosCabecera[2] = $datosPaciente[0][8]; // codigorecetaunica
                $datosCabecera[3] = utf8_encode($datosPaciente[0][2]); //nombres
                $datosCabecera[4] = $datosPaciente[0][3]; //edad
                $datosCabecera[5] = $datosPaciente[0][4]; // Nro Historia clínica
                $datosCabecera[6] = $datosPaciente[0][7]; //tipo usuario
                $datosCabecera[7] = $datosPaciente[0][5]; //atencion
                $datosCabecera[8] = utf8_encode($datosPaciente[0][6]); //especialidad
                $datosCabecera[9] = $diagnosticos; //diagnostico presuntivo
                $datosCabecera[10] = $datosPaciente[0][9]; //dni
                $datosCabecera[11] = utf8_encode($datosPaciente[0][10]); //medico tratante
                $datosCabecera[12] = $datosPaciente[0][12]; //fecha de atencion
//print_r($datosCabecera);
                /* ===================================================================================================== */
                /* =======================================   Datos de Detalle   ============================================ */
                $labelDetalle = $o_ActionReporte->labelReportePdf("", $idReporte, 2);
                $datosDet = $o_ActionReporte->datosRecetaMedica($codProgramacion);
//print_r($datosDet);
                $datosDetalle = array();
                foreach ($datosDet as $i => $value) {
//                    $datosDetalle[$i][0]=$datosDet[$i][3];
//                    $datosDetalle[$i][1]=$datosDet[$i][6];
//                    $datosDetalle[$i][2]=$datosDet[$i][4];
//                    $datosDetalle[$i][3]=$datosDet[$i][5];
                    $datosDetalle[$i][0] = $datosDet[$i][0];
                    $datosDetalle[$i][1] = $datosDet[$i][1];
                    $datosDetalle[$i][2] = $datosDet[$i][2];
                    $datosDetalle[$i][3] = $datosDet[$i][3];
                    $datosDetalle[$i][4] = $o_ActionReporte->centroCostosPorServicio($datosDet[$i][4]);
                }
                //print_r($datosDetalle);
//print_r($datosDetalle);
//               $datosDetalle = array();
//               $datosDetalle = array(
//                       0=>array("medicamento xxxxx es una prueba para generar receta medicas estandarizadas, dn ad sm dms ds","230 mg", "expediente x","1000","dosis xx","2 al dia","oral","1semana"),
//                       1=>array("medicamento xxxxx","230 mg", "expediente x","1000","dosis xx","2 al dia","oral","1semana"),
//                       2=>array("medicamento xxxxx","230 mg", "expediente x","1000","dosis xx","2 al dia","oral","1semana"),
//                       3=>array("medicamento xxxxx es una prueba para generar receta medicas estandarizadas, dn ad sm dms ds","230 mg", "expediente x","1000","dosis xx","2 al dia","oral","1semana"),
//                       4=>array("medicamento xxxxx","230 mg", "expediente x","1000","dosis xx","2 al dia","oral","1semana"),
//                       5=>array("medicamento xxxxx","230 mg", "expediente x","1000","dosis xx","2 al dia","oral","1semana"),
//                       6=>array("medicamento xxxxx es una prueba para generar receta medicas estandarizadas, dn ad sm dms ds","230 mg", "expediente x","1000","dosis xx","2 al dia","oral","1semana"),7=>array("medicamento xxxxx","230 mg", "expediente x","1000","dosis xx","2 al dia","oral","1semana"),8=>array("medicamento xxxxx","230 mg", "expediente x","1000","dosis xx","2 al dia","oral","1semana")
//                   );



                /* ===================================================================================================== */
                /* =======================================   Datos de Pie   ============================================ */
                $datosPie = array();
                $labelPie = $o_ActionReporte->labelReportePdf("recetaUnicaEstandarizada", $idReporte, 3);
                $fechasTratamiento = $o_ActionReporte->fechasTratamienos($codProgramacion);
//               exit ();
                if ($fechasTratamiento[0][1] == '01/01/1900') {
                    $datosPie[1] = "";
                } else {
                    $datosPie[1] = $fechasTratamiento[0][1]; //proxima cita sugerida
                }
                if ($fechasTratamiento[0][2] == '01/01/1900') {
                    $datosPie[2] = "";
                } else {
                    $datosPie[2] = $fechasTratamiento[0][2]; //fecha de vencimiento de la receta
                }
                if ($fechasTratamiento[0][3] == '01/01/1900') {
                    $datosPie[6] = "";
                } else {
                    $datosPie[6] = $fechasTratamiento[0][3]; //fecha de vencimiento de la receta
                }




                /* ===================================================================================================== */
                /* =====================================   Todo Los atributos   ======================================== */
                $atributosReceta = $o_ActionReporte->atributosRecetaMedica($idReporte);
                $parametros["PDF_PAGE_FORMAT"] = "RECETA_MEDICA_ESTANDARIZADA";
                $parametros["PRINT_HEADER"] = false;
                $parametros["PRINT_FOOTER"] = false;
                $parametros["PDF_MARGIN_LEFT"] = 6;
                $parametros["PDF_MARGIN_RIGHT"] = 6;
                $parametros["PDF_MARGIN_TOP"] = 6;
                $parametros["AUTO_PAGE_BREAK"] = false;
                $parametros["PDF_PAGE_ORIENTATION"] = "L";
                $parametros["CODIGO_DE_BARRAS"] = $fechasTratamiento[0][3]; //nro de la orden generada
                //print_r($fechasTratamiento);
                $setdat->generarMYPDF_RME_ORDEN_MEDICA($atributosReceta, $labelCabecera, $labelPie, $datosCabecera, $datosDetalle, $datosPie, $modo, $nombreReporte, $parametros);
                break;
            }
        case "ticketCita": {
                require_once('generadorDeReportes.php');
                $setdat = new PluginMYPDF();

//orden del array: nroOrden, especialidad, paciente, medico, fecha, hora, ambienteLogio
                $arrayDatos = $_REQUEST["p3"];
                $idReporte = $_REQUEST["p4"];

                $datosTicketCita = explode("|", $arrayDatos);
                $nombreReporte = "Cita" . $datosTicketCita[0];

                /* ===================================================================================================== */
                /* =======================================   Datos de Cabecera   ============================================ */
                $labelCabecera = $o_ActionReporte->labelReportePdf("ticketcita", $idReporte, 1);
                $datosCabecera = array();
                $datosCabecera[0] = "";
                /* ===================================================================================================== */
                /* =======================================   Datos de Detalle   ============================================ */
                $labelDetalle = $o_ActionReporte->labelReportePdf("ticketcita", $idReporte, 2);
                for ($i = 0; $i < count($datosTicketCita) ; $i++) { //observacion (-1) por que entrar 7 columnas (del 0 al 6) pero se envia al generador de reporte solo 6 columas
                    $datosDetalle[0][$i] = $datosTicketCita[$i];
                }

//                $datosDetalle[0][0]=$datosTicketCita[0];
//                $datosDetalle[0][1]=$datosTicketCita[1];
//                $datosDetalle[0][2]=$datosTicketCita[2];
//                $datosDetalle[0][3]=$datosTicketCita[3];
//                $datosDetalle[0][4]=$datosTicketCita[4];
//                $datosDetalle[0][5]=$datosTicketCita[5];

                /* ===================================================================================================== */
                /* =======================================   Datos de Pie   ============================================ */
                $datosPie = array();
                $labelPie = $o_ActionReporte->labelReportePdf("ticketcita", $idReporte, 3);
//                $datosMedico=$o_ActionReporte->datosMedico($codMedico);
                $datosPie[0] = "";
//                $datosPie[2]="";

                /* ===================================================================================================== */
                /* =====================================   Todo Los atributos   ======================================== */
                $atributosReceta = $o_ActionReporte->atributosRecetaMedica($idReporte);

                $parametros["PDF_PAGE_FORMAT"] = "TICKET_ORDEN";
                $parametros["PDF_MARGIN_HEADER"] = 0;
                $parametros["PDF_MARGIN_FOOTER"] = 0;
                $parametros["AUTO_PAGE_BREAK"] = false;
                $parametros["PDF_MARGIN_BOTTOM"] = 0;
               // $parametros["PDF_PAGE_ORIENTATION"] = "L";
                $parametros["PDF_MARGIN_LEFT"] = 1;
                $parametros["PDF_MARGIN_TOP"] = 0;
                $parametros["PDF_MARGIN_RIGHT"] = 1;
                $parametros["PRINT_HEADER"] = false;
                $parametros["PRINT_FOOTER"] = false;

                $setdat->generarMYPDF($atributosReceta, $labelCabecera, $labelDetalle, $labelPie, $datosCabecera, $datosDetalle, $datosPie, $modo, $nombreReporte, $parametros);

                break;
            }

        case "ticketOrdenMedica": {
                require_once('generadorDeReportes.php');
                $setdat = new PluginMYPDF();


                $arrayDatos = "MEDICINA GENERAL|ROMERO PLASENCIA MARITZA|RIVERA C. OMAR|Viernes 10 Agosto 2012|5:30PM  |MED. GENERAL I - PROLIMA(ESSALUD)";
                $idReporte = $_REQUEST["p3"];
                $idTratamiento = $_REQUEST["p4"];
                //echo 'trar'.$idTratamiento;
                //$codProgramacion = $_REQUEST["p3"];
                $codPersona = $_REQUEST["p5"];
                //$datosTicketCita = explode("|", $arrayDatos);
                $datosOrdenMedica = array();
                $nombreReporte = "TicketOrdenMedica" . $idTratamiento;
                $datosOrdenMedica = $o_ActionReporte->aDatosPacienteTicketOrden($idTratamiento);
                /* ===================================================================================================== */
                /* =======================================   Datos de Cabecera   ============================================ */
                $labelCabecera = $o_ActionReporte->labelReportePdf("", $idReporte, 1);
                $datosCabecera = array();
                $datosCabecera[0] = "";
                /* ===================================================================================================== */
                /* =======================================   Datos de Detalle   ============================================ */
                $labelDetalle = $o_ActionReporte->labelReportePdf("", $idReporte, 2);
                for ($i = 0; $i < 5; $i++) { //observacion (-1) por que entrar 7 columnas (del 0 al 6) pero se envia al generador de reporte solo 6 columas
                    $datosDetalle[0][$i] = $datosOrdenMedica[0][$i];
                }

//                $datosDetalle[0][0]='0724108-2012';
//                $datosDetalle[0][1]= 'RIVERA C. OMAR';
//                $datosDetalle[0][2]='C. MEDICINA GENERAL';
//                $datosDetalle[0][3]='LAB(ANATOMIA PATOLOGICA) PAPANICOLAU CERVICO VAGINAL';
//                $datosDetalle[0][4]='DESCARTAR LOS HONGOS EN LOS PIES';
//                $datosDetalle[0][5]='viernes 13 Agosto 2012';

                /* ===================================================================================================== */
                /* =======================================   Datos de Pie   ============================================ */
                $datosPie = array();
                $labelPie = $o_ActionReporte->labelReportePdf("", $idReporte, 3);
//                $datosMedico=$o_ActionReporte->datosMedico($codMedico);
                $datosPie[0] = "";
//                $datosPie[2]="";

                /* ===================================================================================================== */
                /* =====================================   Todo Los atributos   ======================================== */
                $atributosReceta = $o_ActionReporte->atributosRecetaMedica($idReporte);

                $parametros["PDF_PAGE_FORMAT"] = "TICKET_ORDEN_MEDICA";
                $parametros["PDF_MARGIN_HEADER"] = 0;
                $parametros["PDF_MARGIN_FOOTER"] = 0;
                $parametros["AUTO_PAGE_BREAK"] = false;
                $parametros["PDF_MARGIN_BOTTOM"] = 0;

                $parametros["PDF_MARGIN_LEFT"] = 1;
                $parametros["PDF_MARGIN_TOP"] = 0;
                $parametros["PDF_MARGIN_RIGHT"] = 1;
                $parametros["PRINT_HEADER"] = false;
                $parametros["PRINT_FOOTER"] = false;

                $setdat->generarMYPDF($atributosReceta, $labelCabecera, $labelDetalle, $labelPie, $datosCabecera, $datosDetalle, $datosPie, $modo, $nombreReporte, $parametros);

                break;
            }
        case "historiasMamografias": {
                require_once('generarReporteMensual.php');
                $reporteHC = new generarReporteMensualMamografias();

                $idPaciente = 4567;
                $idReporte = 3;
                $datos['p2'] = $_REQUEST["p2"];
                $datos['p3'] = $_REQUEST["p3"];
                $modo = 1;
                $labelCabecera = $o_ActionReporte->labelReportePdf("vacio", 11000, 1000);
                $datosCabecera = array();
                $listaAtenciones = $o_ActionReporte->listaAtencionesMamografias($datos);
                $arrayHC = array();
                foreach ($listaAtenciones as $i => $value) {
                    $o_ActionReporte = new ActionReporte();
                    $oLActoMedico = new LActoMedico();

                    $datosMed = $oLActoMedico->atencionMedico($listaAtenciones[$i][0]);
                    $motivoConsulta = $o_ActionReporte->rptMotivoConsulta($listaAtenciones[$i][0]);
                    $triaje = $o_ActionReporte->rptTriaje($listaAtenciones[$i][0]);
                    $examenesMedicos = $o_ActionReporte->rptExamenesMedicos($listaAtenciones[$i][0]);
                    $datosExamenes = array();
                    if ($examenesMedicos) {
                        foreach ($examenesMedicos as $j => $filaExamen) {
                            $pruebasExamenes = $oLActoMedico->valoresCampos($listaAtenciones[$i][0], $filaExamen[0]);
                            if ($pruebasExamenes)
                                $datosExamenes[$j][0] = $pruebasExamenes;
                            else
                                $datosExamenes[$j][0] = null;
                        }
                        $arrayHC[$i][2] = $datosExamenes;
                    }else {
                        $arrayHC[$i][2] = null;
                    }

                    $diagnostico = $o_ActionReporte->rptDiagnostico($listaAtenciones[$i][0]);
                    $medicamentoso = $o_ActionReporte->rptTratamientos($listaAtenciones[$i][0], "1");
                    $practicaMedica = $o_ActionReporte->rptTratamientos($listaAtenciones[$i][0], "2");
                    $tratamientosx = array();
                    if ($medicamentoso)
                        $tratamientosx[0][0] = $medicamentoso;
                    else
                        $tratamientosx[0][0] = null;
                    if ($practicaMedica)
                        $tratamientosx[0][1] = $practicaMedica;
                    else
                        $tratamientosx[0][1] = null;

                    if ($motivoConsulta)
                        $arrayHC[$i][0] = $motivoConsulta;
                    else
                        $arrayHC[$i][0] = null;
                    if ($triaje)
                        $arrayHC[$i][1] = $triaje;
                    else
                        $arrayHC[$i][1] = null;
                    if ($diagnostico)
                        $arrayHC[$i][3] = $diagnostico;
                    else
                        $arrayHC[$i][3] = null;
                    if ($tratamientosx)
                        $arrayHC[$i][4] = $tratamientosx;
                    else
                        $arrayHC[$i][4] = null;
                    if ($datosMed) {
                        $arrayHC[$i][5] = $datosMed;
                        $arrayHC[$i][6] = $listaAtenciones[$i][4];
                    } else {
                        $arrayHC[$i][5] = null;
                        $arrayHC[$i][6] = null;
                    }
                }

                /* ===================================================================================================== */
                /* =======================================   Datos de Pie   ============================================ */


                /* ===================================================================================================== */
                /* =====================================   Todo Los atributos   ======================================== */
                $atributosHC = $o_ActionReporte->atributosRecetaMedica($idReporte);
                $parametros["PRINT_HEADER"] = true;
                $parametros["PRINT_FOOTER"] = false;
                $parametros["PDF_MARGIN_LEFT"] = 10;
                $parametros["PDF_MARGIN_RIGHT"] = 10;
                $parametros["PDF_MARGIN_TOP"] = 10;
                $parametros["AUTO_PAGE_BREAK"] = true;
                $datosPie = "";
                $nombreReporte = $numHC;
                $historiaOdontograma = "";
                $reporteHC->generarMYPDF_HC_Completo($atributosHC, $labelCabecera, $datosCabecera, $datosPie, $antecedentes, $arrayHC, $modo, $datos, $parametros, $listaAtenciones);
                break;
            }
        case "historiasPapanicolaou": {
                require_once('generarReporteMensualPapanicolaou.php');
                $reporteHC = new generarReporteMensualPapanicolaou();
                $o_ActionActoMedico = new ActionActoMedico();
                $datos['p2'] = $_REQUEST["p2"];
                $datos['p3'] = $_REQUEST["p3"];
                $listarPapanicolaum = $o_ActionActoMedico->listaAtencionespapanicolaum($datos);
                $parametros["PRINT_HEADER"] = false;
                $parametros["PRINT_FOOTER"] = false;
                $parametros["PDF_MARGIN_LEFT"] = 10;
                $parametros["PDF_MARGIN_RIGHT"] = 10;
                $parametros["PDF_MARGIN_TOP"] = 10;
                $parametros["AUTO_PAGE_BREAK"] = true;
                $reporteHC->generarMYPDF_HC_Completo($listarPapanicolaum, $parametros, $datos);
                break;
            }
        case "historiasPreventivas": {
                require_once('generarReporteMensualPreventivas.php');
                $reporteHC = new generarReporteMensualPreventivas();
                $idPaciente = 4567;
                $idReporte = 3;
                $numHC = $_REQUEST["p1"];
                $modo = 1;
                $dia = $_REQUEST["p2"];
                $labelCabecera = $o_ActionReporte->labelReportePdf("vacio", 11000, 1000);
                $datosCabecera = array();
                //echo 'Peche <br>';
                $listaAtenciones = $o_ActionReporte->listaAtencionesPreventivas($dia);
                $arrayHC = array();
                foreach ($listaAtenciones as $i => $value) {
                    $o_ActionReporte = new ActionReporte();
                    $oLActoMedico = new LActoMedico();

                    $datosMed = $oLActoMedico->atencionMedico($listaAtenciones[$i][0]);
                    $motivoConsulta = $o_ActionReporte->rptMotivoConsulta($listaAtenciones[$i][0]);
                    $triaje = $o_ActionReporte->rptTriaje($listaAtenciones[$i][0]);
                    $examenesMedicos = $o_ActionReporte->rptExamenesMedicos($listaAtenciones[$i][0]);
                    $datosExamenes = array();
                    if ($examenesMedicos) {
                        foreach ($examenesMedicos as $j => $filaExamen) {
                            $pruebasExamenes = $oLActoMedico->valoresCampos($listaAtenciones[$i][0], $filaExamen[0]);
                            if ($pruebasExamenes)
                                $datosExamenes[$j][0] = $pruebasExamenes;
                            else
                                $datosExamenes[$j][0] = null;
                        }
                        $arrayHC[$i][2] = $datosExamenes;
                    }else {
                        $arrayHC[$i][2] = null;
                    }

                    $diagnostico = $o_ActionReporte->rptDiagnostico($listaAtenciones[$i][0]);
                    $medicamentoso = $o_ActionReporte->rptTratamientos($listaAtenciones[$i][0], "1");
                    $practicaMedica = $o_ActionReporte->rptTratamientos($listaAtenciones[$i][0], "2");
                    $tratamientosx = array();
                    if ($medicamentoso)
                        $tratamientosx[0][0] = $medicamentoso;
                    else
                        $tratamientosx[0][0] = null;
                    if ($practicaMedica)
                        $tratamientosx[0][1] = $practicaMedica;
                    else
                        $tratamientosx[0][1] = null;

                    if ($motivoConsulta)
                        $arrayHC[$i][0] = $motivoConsulta;
                    else
                        $arrayHC[$i][0] = null;
                    if ($triaje)
                        $arrayHC[$i][1] = $triaje;
                    else
                        $arrayHC[$i][1] = null;
                    if ($diagnostico)
                        $arrayHC[$i][3] = $diagnostico;
                    else
                        $arrayHC[$i][3] = null;
                    if ($tratamientosx)
                        $arrayHC[$i][4] = $tratamientosx;
                    else
                        $arrayHC[$i][4] = null;
                    if ($datosMed) {
                        $arrayHC[$i][5] = $datosMed;
                        $arrayHC[$i][6] = $listaAtenciones[$i][4];
                    } else {
                        $arrayHC[$i][5] = null;
                        $arrayHC[$i][6] = null;
                    }
                    // echo $listaAtenciones[$i][0].'</br>';
                }

                /* ===================================================================================================== */
                /* =======================================   Datos de Pie   ============================================ */


                /* ===================================================================================================== */
                /* =====================================   Todo Los atributos   ======================================== */
                //echo 'peche1 <br>';
                $atributosHC = $o_ActionReporte->atributosRecetaMedica($idReporte);
                $parametros["PRINT_HEADER"] = false;
                $parametros["PRINT_FOOTER"] = false;
                $parametros["PDF_MARGIN_LEFT"] = 10;
                $parametros["PDF_MARGIN_RIGHT"] = 10;
                $parametros["PDF_MARGIN_TOP"] = 10;
                $parametros["AUTO_PAGE_BREAK"] = true;
                $datosPie = "";
                $nombreReporte = $numHC;
                $historiaOdontograma = "";
                //echo 'peche2 <br>';
                ob_flush();
                $reporteHC->generarMYPDF_HC_Completo($atributosHC, $labelCabecera, $datosCabecera, $datosPie, $antecedentes, $arrayHC, $modo, $dia, $parametros, $listaAtenciones);
                break;
            }
        case "historiaClinica" : {

            $idPaciente = $_REQUEST["p3"];
            $idReporte = $_REQUEST["p4"];
            $numHC = $_REQUEST["p5"];
            $o_LActionReporte = new LActoMedico();
            $codigo_paciente["codigoPaciente"] = $idPaciente;
            if($codigo_paciente["codigoPaciente"]=='undefined'){
            $codigo_paciente["codigoPaciente"]='';

            }
            $fecha_nacimiento=$o_LActionReporte->obtenerFechaNacimiento($codigo_paciente);
            $PV_FEC_NAC=$fecha_nacimiento[0][3];
            $fecha_nac_paciente["fecha"]=$fecha_nacimiento[0][3];
            $meses_nacimiento=$o_LActionReporte->obtenerNumMeses($fecha_nac_paciente);
            $meses=$meses_nacimiento[0][0];

            $codigo_servicio=$o_LActionReporte->obtenerCodigoServicio($codigo_paciente);
            $codigo_servicio=$codigo_servicio[0][0];
            $codigo_programacion=$o_LActionReporte->obtenerCodigoProgramacion($codigo_paciente);
            $codigo_programacion=$codigo_programacion[0][0];
            if($codigo_servicio=='PED0000001'){
                require_once('../../../phpjasperxml/phpjasperxml_0.9d/class/PHPJasperXML.inc.php');
                require_once('../../../phpjasperxml/phpjasperxml_0.9d/class/tcpdf/tcpdf.php');
            } else {
                require_once('generarReporteHCCompleto.php');
                $reporteHC = new generarMYPDFHCCompleto();
            }               
                
            if ($numHC != "NO_DATA") {

                    /* ===================================================================================================== */
                    /* =======================================   Datos de Cabecera   ============================================ */
                    $labelCabecera = $o_ActionReporte->labelReportePdf("historiaClinica", $idReporte, 1);
                    $datosPaciente = $o_ActionReporte->datosPaciente($idPaciente);
                    //var_dump('<pre>',$datosPaciente);exit();
                    $datosCabecera = array();

                    $datosCabecera[4] = $numHC;
                    $datosCabecera[5] = $datosPaciente[0][2];
                    $datosCabecera[6] = $datosPaciente[0][3];
                    $datosCabecera[7] = $datosPaciente[0][1];
                    $datosCabecera[8] = $datosPaciente[0][9];

                    $PV_DOC_IDENT=$datosPaciente[0][10];
                    if ($datosPaciente[0][8] == 'sindata') {
                        $fechayedad = '';
                    } else {
                        $fechayedad = $datosPaciente[0][8] . " ( " . $datosPaciente[0][4] . " años )";
                    }
                    $datosCabecera[9] = $fechayedad;
                    $datosCabecera[10] = $datosPaciente[0][5] == 1 ? "MASCULINO" : "FEMENINO";
                    $datosCabecera[11] = trim($datosPaciente[0][11]);
                    $datosCabecera[12] = $datosPaciente[0][12] . " - " . $datosPaciente[0][13];
//---/home/samba/shares/2010_hmlo_personal/0374787.jpg
                    //var_dump($datosPaciente[0][7]);exit();
                    if (file_exists($datosPaciente[0][7] . "" . $datosPaciente[0][10]))  //verifico si existe la foto en la ruta
                        $datosCabecera[13] = $datosPaciente[0][6] . "" . $datosPaciente[0][10];
                    /* ===================================================================================================== */
                    /* =======================================   Datos de Detalle   ============================================ */
                    $listaAtenciones = $o_ActionReporte->listaAtenciones($idPaciente); //$listaAtenciones[$i][0]--> idPrigramacion;
                    //var_dump('<pre>',$listaAtenciones);exit();
                    $antecedentes = $o_ActionReporte->rptAntecedentes($idPaciente); //serecupera los antecedentes de golpe

                    //$hc_general = $o_ActionReporte->listaExamenesHCGeneral($idPaciente); 
                    //var_dump($hc_general);exit();

                    $arrayHC = array();
                    foreach ($listaAtenciones as $i => $value) {
                        $o_ActionReporte = new ActionReporte();
                        $oLActoMedico = new LActoMedico();

                        //idProgPaciente
                        $idProgPaciente=$listaAtenciones[$i][0];

                        $datosMed = $oLActoMedico->atencionMedico($listaAtenciones[$i][0]);
                        $motivoConsulta = $o_ActionReporte->rptMotivoConsulta($listaAtenciones[$i][0]);

                        $triaje = $o_ActionReporte->rptTriaje($listaAtenciones[$i][0]);
                        //var_dump('<pre>',$triaje);exit();
//------------------------------------------------------------------------------------
                        $examenesMedicos = $o_ActionReporte->rptExamenesMedicos($listaAtenciones[$i][0]);
                        //var_dump('<pre>',$examenesMedicos);exit();
                        $datosExamenes = array();
                        if ($examenesMedicos) {
                            foreach ($examenesMedicos as $j => $filaExamen) {
                                $pruebasExamenes = $oLActoMedico->valoresCampos($listaAtenciones[$i][0], $filaExamen[0]);
                                //var_dump('<pre>',$pruebasExamenes);exit();
                                if ($pruebasExamenes)
                                    $datosExamenes[$j][0] = $pruebasExamenes;
                                else
                                    $datosExamenes[$j][0] = null;
                            }
                            $arrayHC[$i][2] = $datosExamenes;
                        }else {
                            $arrayHC[$i][2] = null;
                        }
//------------------------------------------------------------------------------------

                        $diagnostico = $o_ActionReporte->rptDiagnostico($listaAtenciones[$i][0]);
                        $array_diagnostico = array();
                        $diagnostico_concantenado='';
                        foreach ($diagnostico as $j => $value) {
                            if($value[2]!=''){
                            $array_diagnostico[]=$value[2];
                            } 
                        }
                            $diagnostico_concantenado = implode(",", $array_diagnostico);
                        
                        $medicamentoso = $o_ActionReporte->rptTratamientos($listaAtenciones[$i][0], "1");

                        $practicaMedica = $o_ActionReporte->rptTratamientos($listaAtenciones[$i][0], "2");
                        $array_tratamiento = array();
                        $tratamiento_concantenado='';
                        foreach ($practicaMedica as $j => $value) {     
                            if($value[2]!=''){
                            $array_tratamiento[]=$value[2];
                            } 
                        }
                            $tratamiento_concantenado = implode(",", $array_tratamiento);


                        $tratamientosx = array();
                        if ($medicamentoso)
                            $tratamientosx[0][0] = $medicamentoso;
                        else
                            $tratamientosx[0][0] = null;
                        if ($practicaMedica)
                            $tratamientosx[0][1] = $practicaMedica;
                        else
                            $tratamientosx[0][1] = null;

                        if ($motivoConsulta)
                            $arrayHC[$i][0] = $motivoConsulta;
                        else
                            $arrayHC[$i][0] = null;
                        if ($triaje)
                            $arrayHC[$i][1] = $triaje;
                        else
                            $arrayHC[$i][1] = null;
// Examenes
                        if ($diagnostico)
                            $arrayHC[$i][3] = $diagnostico;
                        else
                            $arrayHC[$i][3] = null;
                        if ($tratamientosx)
                            $arrayHC[$i][4] = $tratamientosx;
                        else
                            $arrayHC[$i][4] = null;
                        if ($datosMed) {
                            $arrayHC[$i][5] = $datosMed;
                            $arrayHC[$i][6] = $listaAtenciones[$i][4];
                        } else {
                            $arrayHC[$i][5] = null;
                            $arrayHC[$i][6] = null;
                        }
                    }
                                    
                    /*$peso_old=$triaje[0]['nPeso'];
                    $talla_old=$triaje[0]['nTalla'];
                    $nota_old=$medicamentoso[0]['vComentario'];*/

                //$PV_FOTO=$labelCabecera[3][3];
                //$PV_FOTO="http://172.24.64.226/fastmedical_front/imagen/logo/".$PV_RUTA_LOGO;

                //$PV_FOTO=$datosPaciente[0][11];
                //var_dump($PV_RUTA_LOGO);exit();

                $PV_FOTO=$datosPaciente[0][11];
                $PV_RUTA_FOTO=$datosPaciente[0][6];
                $PV_FOTO=$PV_RUTA_FOTO.$PV_FOTO;

                $PV_LOGO=$labelCabecera[0][3];
                $PV_RUTA_LOGO=$datosPaciente[0][6];
                //var_dump($PV_RUTA_LOGO);exit();
                $PV_LOGO=$PV_RUTA_LOGO.$PV_LOGO;
                //var_dump($PV_LOGO);exit();
                session_start();
                //var_dump($_SESSION['base_url']);exit();
                $PV_CHECK=$_SESSION['base_url']."fastmedical_front/imagen/icono/checkbox-checked.png";
                $PV_UNCHECK=$_SESSION['base_url']."fastmedical_front/imagen/icono/checkbox-unchecked.png";
                //$checked="smb://172.24.64.226/www/fastmedical_front/imagen/icono/checkbox-checked.png";
                //$checked="../../../../fastmedical_front/imagen/icono/checkbox_checked_old.png";
                //$unchecked="../../../..//fastmedical_front/imagen/icono/checkbox-unchecked.png";
                if($codigo_servicio=='PED0000001'){

                    $server="172.24.64.200";
                    $db="dermomedica";
                    $user="consulta";
                    $pass="consulta";

                    if($meses>=0 && $meses<=6){
                       // var_dump('entro');exit();
                    ini_set('display_errors', 0);
                    $xml = simplexml_load_file ('../../../phpjasperxml/phpjasperxml_0.9d/Historia_Clinica_0_4.jrxml');

                    $PHPJasperXML = new PHPJasperXML ();
                    $PHPJasperXML->debugsql = false;
                                        
                    //$logo=$labelCabecera[0][3];
                    //var_dump($logo);exit();
                    $PV_HOSP_CLI=$labelCabecera[1][3];
                    $PV_DIR_HOSP_CLI=$labelCabecera[2][3];
                    //$PV_FOTO=$labelCabecera[3][3];

                    $PV_HIST_CLI =$datosCabecera[4];
                    $PV_NOMBRE = $datosCabecera[5].' '.$datosCabecera[6].' '.$datosCabecera[7];
                    $FECHA = $datosPaciente[0]['fecha_registro'];
                    //$PV_DOC_IDENT = $datosCabecera[8];

                    //var_dump('<pre>',$PV_DOC_IDENT);exit();
                    $PV_FEC_NAC = $datosPaciente[0]['nacimiento'];
                    $PV_SEXO = $datosCabecera[10];
                    $PV_DIR_PAC = $datosPaciente[0]['ubigeo'];
                    $PV_TLF_PAC = $datosPaciente[0]['vCodigoContacto'];
                    //$imp_dx=$diagnostico[0]['vDescripcion'];
                    $PV_IMP_DX=$diagnostico_concantenado;
                    //$tratamiento=$practicaMedica[0][2];
                    $tratamiento_old=$tratamiento_concantenado;

                    $hc_general = $o_ActionReporte->listaExamenesHCGeneral($codigo_programacion,63);

                    //var_dump('<pre>',$hc_general);exit();
                    //Exámen fisico I
                    $PV_PESO=$hc_general[0][3];
                    $PV_TALLA=$hc_general[1][3];
                    $PV_PC=$hc_general[2][3];
                    $PV_NOTA=$hc_general[3][3];

                    //Historia actual
                    $PV_SUENHO=$hc_general[4][3];
                    $PV_DEPOSICIONES=$hc_general[5][3];
                    $PV_ENFERMEDADES=$hc_general[6][3];
                    $PV_MEDICACION=$hc_general[7][3];
                    
                    //Nutrición
                    $PV_LM=$hc_general[8][3];
                    $PV_FORMULA=$hc_general[9][3];
                    $PI_HOJA_ALIM=$hc_general[10][3];
                    $PI_EMI_OTO=$hc_general[11][3];

                    //Crecimiento y Desarrollo 1 mes
                    $PI_FIJA_MIR=$hc_general[12][3];
                    $PI_ESC_1=$hc_general[13][3];
                    $PI_LEV_CAB=$hc_general[14][3];
                    $PI_MOV_SIM=$hc_general[15][3];

                    //Crecimiento y Desarrollo 2 meses
                    $PI_SIGUE_90=$hc_general[16][3];
                    $PI_ESC_2=$hc_general[17][3];
                    $PI_LEV_CAB_45=$hc_general[18][3];
                    $PI_SON_ESP=$hc_general[19][3];
                    $PI_VOCA=$hc_general[20][3];

                    //Crecimiento y Desarrollo 4 meses
                    $PI_SONR_SOC=$hc_general[21][3];
                    $PI_ALEG=$hc_general[22][3];
                    $PI_AGA_COS=$hc_general[23][3];
                    $PI_JUNT_MANO=$hc_general[24][3];
                    $PI_CAB_EST=$hc_general[25][3];

                    //Examen Físico
                    $PV_T=$hc_general[26][3];
                    $PV_FC=$hc_general[27][3];
                    $PV_FR=$hc_general[28][3];

                    //Evaluacion general
                    $PI_PIEL_GANG=$hc_general[29][3];
                    $PI_CAB_CUE=$hc_general[30][3];
                    $PI_OJOS=$hc_general[31][3];
                    $PI_NARIZ=$hc_general[32][3];
                    $PI_OIDOS=$hc_general[33][3];
                    $PI_ORO=$hc_general[34][3];
                    $PI_TORAX=$hc_general[35][3];
                    $PI_CARDIO=$hc_general[36][3];
                    $PI_ABDO=$hc_general[37][3];
                    $PI_GENIT=$hc_general[38][3];
                    $PI_SIST_NERV=$hc_general[39][3];
                    $PI_SIST_ESQ=$hc_general[40][3];
                    $PV_EG=$hc_general[41][3];

                    //vacunas 2 meses
                    $PI_DTAP_1=$hc_general[42][3];
                    $PI_HIB_1=$hc_general[43][3];
                    $PI_IPV_1=$hc_general[44][3];
                    $PI_HEP_B_1=$hc_general[45][3];
                    $PI_NEUMO_1=$hc_general[46][3];
                    $PI_ROTAV_1=$hc_general[47][3];

                    //vacunas 4 meses
                    $PI_DTAP_2=$hc_general[48][3];
                    $PI_HIB_2=$hc_general[49][3];
                    $PI_IPV_2=$hc_general[50][3];
                    $PI_HEP_B_2=$hc_general[51][3];
                    $PI_NEUMO_2=$hc_general[52][3];
                    $PI_ROTAV_2=$hc_general[53][3];
                    //$PV_IMP_DX=$hc_general[54][3];
                    $PV_PLAN=$hc_general[54][3];
                   
                    //Comentarios
                    /*$comentarios_hoja_chupon=$hc_general[44][3];
                    $comentarios_hoja_fiebre=$hc_general[45][3];
                    $comentarios_hoja_resfrio=$hc_general[46][3];
                    $comentarios_hoja_prev=$hc_general[47][3];*/
                    //var_dump($PV_DOC_IDENT);exit();
                    //var_dump($PV_DIR_HOSP_CLI);exit();
                    //var_dump($PV_LOGO);exit();
                    $PHPJasperXML->arrayParameter=array("PV_CHECK"=>$PV_CHECK,"PV_UNCHECK"=>$PV_UNCHECK,"idPaciente"=>$idPaciente,"PV_LOGO"=>$PV_LOGO,"PV_HOSP_CLI"=>$PV_HOSP_CLI,"PV_DIR_HOSP_CLI"=>$PV_DIR_HOSP_CLI,"PV_FOTO"=>$PV_FOTO,"PV_HIST_CLI"=>$PV_HIST_CLI,"PV_NOMBRE"=>$PV_NOMBRE,"FECHA"=>$FECHA,"PV_DOC_IDENT"=>$PV_DOC_IDENT,"PV_FEC_NAC"=>$PV_FEC_NAC,"PV_SEXO"=>$PV_SEXO,"PV_DIR_PAC"=>$PV_DIR_PAC,"PV_TLF_PAC"=>$PV_TLF_PAC,"PV_PESO"=>$PV_PESO,"PV_TALLA"=>$PV_TALLA,"PV_PC"=>$PV_PC,"PV_NOTA"=>$PV_NOTA,"PV_IMP_DX"=>$PV_IMP_DX,"PV_PLAN"=>$PV_PLAN,
                        "PV_SUENHO"=>$PV_SUENHO,"PV_DEPOSICIONES"=>$PV_DEPOSICIONES,"PV_ENFERMEDADES"=>$PV_ENFERMEDADES,"PV_MEDICACION"=>$PV_MEDICACION,"PV_LM"=>$PV_LM,"PV_FORMULA"=>$PV_FORMULA,"PI_HOJA_ALIM"=>$PI_HOJA_ALIM,"PI_EMI_OTO"=>$PI_EMI_OTO,
                        "PI_FIJA_MIR"=>$PI_FIJA_MIR,"PI_ESC_1"=>$PI_ESC_1,"PI_LEV_CAB"=>$PI_LEV_CAB,"PI_MOV_SIM"=>$PI_MOV_SIM,
                        "PI_SIGUE_90"=>$PI_SIGUE_90,"PI_ESC_2"=>$PI_ESC_2,"PI_LEV_CAB_45"=>$PI_LEV_CAB_45,"PI_SON_ESP"=>$PI_SON_ESP,"PI_VOCA"=>$PI_VOCA,
                        "PI_SONR_SOC"=>$PI_SONR_SOC,"PI_ALEG"=>$PI_ALEG,"PI_AGA_COS"=>$PI_AGA_COS,"PI_JUNT_MANO"=>$PI_JUNT_MANO,"PI_CAB_EST"=>$PI_CAB_EST,
                        "PV_T"=>$PV_T,"PV_FC"=>$PV_FC,"PV_FR"=>$PV_FR,
                        "PI_DTAP_1"=>$PI_DTAP_1,"PI_HIB_1"=>$PI_HIB_1,"PI_IPV_1"=>$PI_IPV_1,"PI_HEP_B_1"=>$PI_HEP_B_1,"PI_NEUMO_1"=>$PI_NEUMO_1,"PI_ROTAV_1"=>$PI_ROTAV_1,
                        "PI_DTAP_2"=>$PI_DTAP_2,"PI_HIB_2"=>$PI_HIB_2,"PI_IPV_2"=>$PI_IPV_2,"PI_HEP_B_2"=>$PI_HEP_B_2,"PI_NEUMO_2"=>$PI_NEUMO_2,"PI_ROTAV_2"=>$PI_ROTAV_2,
                        "PI_PIEL_GANG"=>$PI_PIEL_GANG,"PI_CAB_CUE"=>$PI_CAB_CUE,"PI_OJOS"=>$PI_OJOS,"PI_NARIZ"=>$PI_NARIZ,"PI_OIDOS"=>$PI_OIDOS, "PI_ORO"=>$PI_ORO,"PI_TORAX"=>$PI_TORAX,"PI_CARDIO"=>$PI_CARDIO,"PI_ABDO"=>$PI_ABDO,"PI_GENIT"=>$PI_GENIT,"PI_SIST_NERV"=>$PI_SIST_NERV,"PI_SIST_ESQ"=>$PI_SIST_ESQ,"PV_EG"=>$PV_EG,
                        "comentarios_hoja_chupon"=>$comentarios_hoja_chupon,"comentarios_hoja_fiebre"=>$comentarios_hoja_fiebre,"comentarios_hoja_resfrio"=>$comentarios_hoja_resfrio,"comentarios_hoja_prev"=>$comentarios_hoja_prev);
                }else{
                    //var_dump('entro2');exit();
                    ini_set('display_errors', 0);
                    $xml = simplexml_load_file ('../../../phpjasperxml/phpjasperxml_0.9d/Historia_Clinica_6_12.jrxml');

                    $PHPJasperXML = new PHPJasperXML ();
                    $PHPJasperXML->debugsql = false;
                                        
                    $logo=$labelCabecera[0][3];
                   // var_dump($logo);exit();
                    $PV_HOSP_CLI=$labelCabecera[1][3];
                    $PV_DIR_HOSP_CLI=$labelCabecera[2][3];
                    //$PV_FOTO=$labelCabecera[3][3];
                    //var_dump($PV_FOTO);exit();
                    $PV_HIST_CLI =$datosCabecera[4];
                    //var_dump($PV_HIST_CLI);exit();
                    $PV_NOMBRE = $datosCabecera[5].' '.$datosCabecera[6].' '.$datosCabecera[7];
                    $FECHA = $datosPaciente[0]['fecha_registro'];
                    //$PV_DOC_IDENT = $datosCabecera[8];
                    $PV_FEC_NAC = $datosPaciente[0]['nacimiento'];
                    $PV_SEXO = $datosCabecera[10];
                    $PV_DIR_PAC = $datosPaciente[0]['ubigeo'];
                    $PV_TLF_PAC = $datosPaciente[0]['vCodigoContacto'];
                    //$imp_dx=$diagnostico[0]['vDescripcion'];
                    $PV_IMP_DX=$diagnostico_concantenado;
                    //$tratamiento=$practicaMedica[0][2];
                    $tratamiento_old=$tratamiento_concantenado;
                    $hc_general = $o_ActionReporte->listaExamenesHCGeneral($codigo_programacion,62);
                    //var_dump('<pre>',$hc_general);exit();

                    //Exámen fisico I
                    $PV_PESO=$hc_general[0][3];
                    $PV_TALLA=$hc_general[1][3];
                    $PV_PC=$hc_general[2][3];
                    $PV_NOTA=$hc_general[3][3];
                    //var_dump('<pre>',$hc_general[4]);exit();
                    //Historia actual
                    $PV_SUENHO=$hc_general[4][3];
                    $PV_DEPOSICIONES=$hc_general[5][3];
                    $PV_ENFERMEDADES=$hc_general[6][3];
                    $PV_MEDICACION=$hc_general[7][3];
                    
                    //Nutrición
                    $PI_LM=$hc_general[8][3];
                    $PI_FORMULA=$hc_general[9][3];
                    $PI_FLUOR=$hc_general[10][3];
                    $PI_CEREAL=$hc_general[11][3];
                    $PI_JUGOS=$hc_general[12][3];
                    $PI_VERDURAS=$hc_general[13][3];
                    $PI_FRUTAS=$hc_general[14][3];
                    $PI_CARNES=$hc_general[15][3];
                    $PI_MENESTRAS=$hc_general[16][3];
                    $PI_LV_TAZA=$hc_general[17][3];

                    //Crecimiento y Desarrollo 6 mes
                    $PI_SONR_IMG=$hc_general[18][3];
                    $PI_EST_BRZ=$hc_general[19][3];
                    $PI_VOLTEA=$hc_general[20][3];
                    $PI_JUEGA_PIES=$hc_general[21][3];
                    $PI_SIENTA_SIN_AYU=$hc_general[22][3];
                    $PI_BALBUCEA=$hc_general[23][3];

                    //Crecimiento y Desarrollo 9 meses
                    $PI_BUSC_OBJ=$hc_general[24][3];
                    $PI_PINZ_DED=$hc_general[25][3];
                    $PI_PARA_CAMINA=$hc_general[26][3];
                    $PI_GATEA=$hc_general[27][3];
                    $PI_MA_PA_INES=$hc_general[28][3];

                    //Crecimiento y Desarrollo 12 meses
                    $PI_TOMA_TAZA=$hc_general[29][3];
                    $PI_MA_PA_ESPE=$hc_general[30][3];
                    $PI_CAMINA=$hc_general[31][3];
                    $PI_VIENE_LLAMA=$hc_general[32][3];
                    $PI_CHAU_APLAU=$hc_general[33][3];

                    //Examen Físico
                    $PV_T=$hc_general[34][3];
                    $PV_FC=$hc_general[35][3];
                    $PV_FR=$hc_general[36][3];

                    //Evaluacion general
                    $PI_PIEL_GANG=$hc_general[37][3];
                    $PI_CAB_CUE=$hc_general[38][3];
                    $PI_OJOS=$hc_general[39][3];
                    $PI_NARIZ=$hc_general[40][3];
                    $PI_OIDOS=$hc_general[41][3];
                    $PI_ORO=$hc_general[42][3];
                    $PI_TORAX=$hc_general[43][3];
                    $PI_CARDIO=$hc_general[44][3];
                    $PI_ABDO=$hc_general[45][3];
                    $PI_GENIT=$hc_general[46][3];
                    $PI_SIST_NERV=$hc_general[47][3];
                    $PI_SIST_ESQ=$hc_general[48][3];
                    $PV_EG=$hc_general[49][3];

                     //vacunas 6 meses
                    $PI_DTAP_3=$hc_general[50][3];
                    $PI_HIB_3=$hc_general[51][3];
                    $PI_IPV_3=$hc_general[52][3];
                    $PI_HEP_B_3=$hc_general[53][3];
                    $PI_NEUMO_3=$hc_general[54][3];
                    $PI_ROTAV_3=$hc_general[55][3];
                    $PI_INFLU_1_2=$hc_general[56][3];

                    //vacunas 12 meses
                    $PI_MMR=$hc_general[57][3];
                    $PI_VARICELA=$hc_general[58][3];

                    //despistaje 9 meses
                    $PI_HGB_Y_HTO=$hc_general[59][3];

                    //dentista
                    $PI_DENTISTA=$hc_general[60][3];

                    //$PV_IMP_DX=$hc_general[54][3];
                    //plan
                    $PV_PLAN=$hc_general[61][3];
                   
                    //Comentarios
                    /*$comentarios_hoja_chupon=$hc_general[44][3];
                    $comentarios_hoja_fiebre=$hc_general[45][3];
                    $comentarios_hoja_resfrio=$hc_general[46][3];
                    $comentarios_hoja_prev=$hc_general[47][3];*/
                    //var_dump($idPaciente);exit();
                    $PHPJasperXML->arrayParameter=array("PV_CHECK"=>$PV_CHECK,"PV_UNCHECK"=>$PV_UNCHECK,"idPaciente"=>$idPaciente,
                        "PV_LOGO"=>$PV_LOGO,"PV_HOSP_CLI"=>$PV_HOSP_CLI,"PV_DIR_HOSP_CLI"=>$PV_DIR_HOSP_CLI,"PV_FOTO"=>$PV_FOTO,
                        "PV_HIST_CLI"=>$PV_HIST_CLI,"PV_NOMBRE"=>$PV_NOMBRE,"FECHA"=>$FECHA,"PV_DOC_IDENT"=>$PV_DOC_IDENT,"PV_FEC_NAC"=>$PV_FEC_NAC,"PV_SEXO"=>$PV_SEXO,"PV_DIR_PAC"=>$PV_DIR_PAC,"PV_TLF_PAC"=>$PV_TLF_PAC,"PV_PESO"=>$PV_PESO,"PV_TALLA"=>$PV_TALLA,"PV_PC"=>$PV_PC,"PV_NOTA"=>$PV_NOTA,"PV_PLAN"=>$PV_PLAN,"PV_IMP_DX"=>$PV_IMP_DX,
                        "PV_SUENHO"=>$PV_SUENHO,"PV_DEPOSICIONES"=>$PV_DEPOSICIONES,"PV_ENFERMEDADES"=>$PV_ENFERMEDADES,"PV_MEDICACION"=>$PV_MEDICACION,"PI_LM"=>$PI_LM,"PI_FORMULA"=>$PI_FORMULA,"PI_FLUOR"=>$PI_FLUOR,"PI_CEREAL"=>$PI_CEREAL,"PI_JUGOS"=>$PI_JUGOS,"PI_VERDURAS"=>$PI_VERDURAS,"PI_FRUTAS"=>$PI_FRUTAS,"PI_CARNES"=>$PI_CARNES,"PI_MENESTRAS"=>$PI_MENESTRAS,"PI_LV_TAZA"=>$PI_LV_TAZA,

                        "PI_SONR_IMG"=>$PI_SONR_IMG,"PI_EST_BRZ"=>$PI_EST_BRZ,"PI_VOLTEA"=>$PI_VOLTEA,"PI_JUEGA_PIES"=>$PI_JUEGA_PIES,"PI_SIENTA_SIN_AYU"=>$PI_SIENTA_SIN_AYU,"PI_BALBUCEA"=>$PI_BALBUCEA,

                        "PI_BUSC_OBJ"=>$PI_BUSC_OBJ,"PI_PINZ_DED"=>$PI_PINZ_DED,"PI_PARA_CAMINA"=>$PI_PARA_CAMINA,"PI_GATEA"=>$PI_GATEA,"PI_MA_PA_INES"=>$PI_MA_PA_INES,

                        "PI_TOMA_TAZA"=>$PI_TOMA_TAZA,"PI_MA_PA_ESPE"=>$PI_MA_PA_ESPE,"PI_CAMINA"=>$PI_CAMINA,"PI_VIENE_LLAMA"=>$PI_VIENE_LLAMA,"PI_CHAU_APLAU"=>$PI_CHAU_APLAU,

                        "PV_T"=>$PV_T,"PV_FC"=>$PV_FC,"PV_FR"=>$PV_FR,

                        "PI_PIEL_GANG"=>$PI_PIEL_GANG,"PI_CAB_CUE"=>$PI_CAB_CUE,
                        "PI_OJOS"=>$PI_OJOS,"PI_NARIZ"=>$PI_NARIZ,

                        "PI_OIDOS"=>$PI_OIDOS,"PI_ORO"=>$PI_ORO,
                        "PI_TORAX"=>$PI_TORAX,"PI_CARDIO"=>$PI_CARDIO,"PI_ABDO"=>$PI_ABDO,"PI_GENIT"=>$PI_GENIT,"PI_SIST_NERV"=>$PI_SIST_NERV,
                        "PI_SIST_ESQ"=>$PI_SIST_ESQ,"PV_EG"=>$PV_EG,

                        "PI_DTAP_3"=>$PI_DTAP_3,"PI_HIB_3"=>$PI_HIB_3,"PI_IPV_3"=>$PI_IPV_3,"PI_HEP_B_3"=>$PI_HEP_B_3,"PI_NEUMO_3"=>$PI_NEUMO_3,"PI_ROTAV_3"=>$PI_ROTAV_3,
                        "PI_INFLU_1_2"=>$PI_INFLU_1_2,

                        "PI_MMR"=>$PI_MMR,"PI_VARICELA"=>$PI_VARICELA,"PI_HGB_Y_HTO"=>$PI_HGB_Y_HTO,"PI_DENTISTA"=>$PI_DENTISTA,
                        "comentarios_hoja_chupon"=>$comentarios_hoja_chupon,"comentarios_hoja_fiebre"=>$comentarios_hoja_fiebre,"comentarios_hoja_resfrio"=>$comentarios_hoja_resfrio,"comentarios_hoja_prev"=>$comentarios_hoja_prev); 
                    }
                    //var_dump('entro');exit();
                    $PHPJasperXML->xml_dismantle ( $xml );
                    $PHPJasperXML->transferDBtoArray ( $server, $user, $pass,$db,'mssql' );
                    $PHPJasperXML->outpage ( "I" ); 
                    break;
                }else{

                    $atributosHC = $o_ActionReporte->atributosRecetaMedica($idReporte);
                    $parametros["PRINT_HEADER"] = false;
                    $parametros["PRINT_FOOTER"] = false;
                    $parametros["PDF_MARGIN_LEFT"] = 10;
                    $parametros["PDF_MARGIN_RIGHT"] = 10;
                    $parametros["PDF_MARGIN_TOP"] = 10;
                    $parametros["AUTO_PAGE_BREAK"] = true;
                    $datosPie = "";
                    $nombreReporte = $numHC;
                    $historiaOdontograma = "";
                    $atributosHC = $o_ActionReporte->atributosRecetaMedica($idReporte);
                    $reporteHC->generarMYPDF_HC_Completo($atributosHC, $labelCabecera, $datosCabecera, $datosPie, $antecedentes, $arrayHC, $modo, $nombreReporte, $parametros);
                    break;
                }


            }
               echo 'EL PACIENTE SELECCIONADO NO CUENTA CON HISTORIA CLINICA';
                
                break;
        }



        case 'historiaClinicaXDia': {
                require_once('generarReporteHC.php');
                $reporteHC = new generarMYPDFHC();
                $idPaciente = $_REQUEST["p3"];
                $idReporte = $_REQUEST["p4"];
                $numHC = $_REQUEST["p5"];
                $idPrograma = $_REQUEST["p6"];
                /* ===================================================================================================== */
                /* =======================================   Datos de Cabecera   ============================================ */
                $labelCabecera = $o_ActionReporte->labelReportePdf("historiaClinica", $idReporte, 1);
                $datosPaciente = $o_ActionReporte->datosPacienteImprimirHIstoria($idPrograma);
                $datosCabecera = array();
                $datosCabecera[2] = $datosPaciente[0][0];
                $datosCabecera[3] = $datosPaciente[0][1];
                $datosCabecera[4] = $datosPaciente[0][2];
                $datosCabecera[5] = $datosPaciente[0][3];
                $datosCabecera[6] = $datosPaciente[0][4];
                $datosCabecera[7] = $datosPaciente[0][6];
                $datosCabecera[8] = $datosPaciente[0][5];
                $datosCabecera[9] = $datosPaciente[0][7];
                $datosCabecera[10] = $datosPaciente[0][8];
                $datosCabecera[11] = $datosPaciente[0][9];
                $datosCabecera[12] = $datosPaciente[0][10];
                $datosCabecera[13] = $datosPaciente[0][11];
                /* ===================================================================================================== */
                /* =======================================   Datos de Detalle   ============================================ */
                $o_ActionReporte = new ActionReporte();
                $oLActoMedico = new LActoMedico();
                $listaAtenciones = $o_ActionReporte->listaAtencionesXDia($idPrograma); //$listaAtenciones[$i][0]--> idPrigramacion
                $antecedentes = $o_ActionReporte->rptAntecedentesPRograma($idPrograma); //serecupera los antecedentes de golpe
                $historiaOdontograma = $oLActoMedico->listadoHistoriaDiente($idPrograma);
                $simbolosImagen = $oLActoMedico->listaImagenesOdontograma($idPrograma);
                
                $nroPlaca = $oLActoMedico->lstListarNumeroIFExistePlaca($idPrograma);
                
                
                $arrayHC = array();
                foreach ($listaAtenciones as $i => $value) {


                    $datosMed = $oLActoMedico->atencionMedico($listaAtenciones[$i][0]);
                    $motivoConsulta = $o_ActionReporte->rptMotivoConsulta($listaAtenciones[$i][0]);
                    $triaje = $o_ActionReporte->rptTriaje($listaAtenciones[$i][0]);
//------------------------------------------------------------------------------------
                    $examenesMedicos = $o_ActionReporte->rptExamenesMedicos($listaAtenciones[$i][0]);
                    $datosExamenes = array();
                    if ($examenesMedicos) {
                        foreach ($examenesMedicos as $j => $filaExamen) {
                            $pruebasExamenes = $oLActoMedico->valoresCampos($listaAtenciones[$i][0], $filaExamen[0]);
                            if ($pruebasExamenes)
                                $datosExamenes[$j][0] = $pruebasExamenes;
                            else
                                $datosExamenes[$j][0] = null;
                        }
                        $arrayHC[$i][2] = $datosExamenes;
                    }else {
                        $arrayHC[$i][2] = null;
                    }
//------------------------------------------------------------------------------------

                    $diagnostico = $o_ActionReporte->rptDiagnostico($listaAtenciones[$i][0]);

                    $medicamentoso = $o_ActionReporte->rptTratamientos($listaAtenciones[$i][0], "1");
                    $practicaMedica = $o_ActionReporte->rptTratamientos($listaAtenciones[$i][0], "2");
                    $tratamientosx = array();
                    if ($medicamentoso)
                        $tratamientosx[0][0] = $medicamentoso;
                    else
                        $tratamientosx[0][0] = null;
                    if ($practicaMedica)
                        $tratamientosx[0][1] = $practicaMedica;
                    else
                        $tratamientosx[0][1] = null;

                    if ($motivoConsulta)
                        $arrayHC[$i][0] = $motivoConsulta;
                    else
                        $arrayHC[$i][0] = null;
                    if ($triaje)
                        $arrayHC[$i][1] = $triaje;
                    else
                        $arrayHC[$i][1] = null;
// Examenes
                    if ($diagnostico)
                        $arrayHC[$i][3] = $diagnostico;
                    else
                        $arrayHC[$i][3] = null;
                    if ($tratamientosx)
                        $arrayHC[$i][4] = $tratamientosx;
                    else
                        $arrayHC[$i][4] = null;
                    if ($datosMed) {
                        $arrayHC[$i][5] = $datosMed;
                        $arrayHC[$i][6] = $listaAtenciones[$i][4];
                    } else {
                        $arrayHC[$i][5] = null;
                        $arrayHC[$i][6] = null;
                    }
                }

                /* ===================================================================================================== */
                /* =======================================   Datos de Pie   ============================================ */


                /* ===================================================================================================== */
                /* =====================================   Todo Los atributos   ======================================== */
                $atributosHC = $o_ActionReporte->atributosRecetaMedica($idReporte);
                $parametros["PRINT_HEADER"] = false;
                $parametros["PRINT_FOOTER"] = false;
                $parametros["PDF_MARGIN_LEFT"] = 10;
                $parametros["PDF_MARGIN_RIGHT"] = 10;
                $parametros["PDF_MARGIN_TOP"] = 5;
                $parametros["AUTO_PAGE_BREAK"] = true;
                $datosPie = "";
                $nombreReporte = $numHC;
                $reporteHC->generarMYPDF_HC($atributosHC, $labelCabecera, $datosCabecera, $datosPie, $antecedentes, $arrayHC, $modo, $nombreReporte, $parametros, $historiaOdontograma,$nroPlaca,$idPrograma);
                break;
            }

        case 'formatolaboratorio': {
                require_once('generadorDeReportesLaboratorio.php');
                $setdat = new LabPluginMYPDF();
                $idReporte = $_REQUEST["p3"];
                $codPacienteLab = $_REQUEST["p4"];
                $datosOrdenMedica = array();
                $nombreReporte = "Examen Laboratorio Nro: " . $codPacienteLab;
                $labelCabecera = $o_ActionReporte->labelReportePdf("", $idReporte, 1);
                $datosPaciente = $o_ActionReporte->datosPacientexExamen($codPacienteLab);
                $datosCabecera = array();
                $datosCabecera[4] = $codPacienteLab;
                $datosCabecera[5] = $datosPaciente[0][0];
                $datosCabecera[6] = $datosPaciente[0][1];
                $datosCabecera[7] = $datosPaciente[0][2];
                $datosCabecera[8] = $datosPaciente[0][3];
                $datosCabecera[9] = $datosPaciente[0][4];
                $datosCabecera[10] = $datosPaciente[0][5];
                $datosCabecera[11] = $datosPaciente[0][6];
                $datosCabecera[12] = $datosPaciente[0][7];
                $labelDetalle = $o_ActionReporte->labelReportePdf("", $idReporte, 2);
                $datosExamen = $o_ActionReporte->aDatosPuntoControlPaciente($codPacienteLab);
                $datosGrupo = $o_ActionReporte->agrupodeDatos($codPacienteLab);
                $datosExamenUni = $o_ActionReporte->adatosExamenUni($codPacienteLab);
                $labelPie = $o_ActionReporte->labelReportePdf("", $idReporte, 3);
                $datosPie[0] = $datosPaciente[0][8];
                $atributosReceta = $o_ActionReporte->atributosRecetaMedica($idReporte);
                $parametros["PDF_PAGE_FORMAT"] = "A4";
                $parametros["PDF_MARGIN_HEADER"] = 0;
                $parametros["PDF_MARGIN_FOOTER"] = 0;
                $parametros["AUTO_PAGE_BREAK"] = true;
                $parametros["PDF_MARGIN_BOTTOM"] = 10;
                $parametros["PDF_MARGIN_LEFT"] = 6;
                $parametros["PDF_MARGIN_RIGHT"] = 6;
                $parametros["PDF_MARGIN_TOP"] = 10;
                $parametros["PRINT_HEADER"] = false;
                $parametros["PRINT_FOOTER"] = false;
                $parametros["CODIGO_DE_BARRAS"] = $datosPaciente[0][8];
                $setdat->generarReporte($atributosReceta, $labelCabecera, $labelDetalle, $labelPie, $datosCabecera, $datosDetalle, $datosExamen, $datosExamenUni, $datosGrupo, $datosPie, $modo, $nombreReceta, $parametros);
                break;
            }

        case 'recibodepago': {
                // require_once('generarReporteRecibodePago.php');//generacionResiboPagpPDF
                require_once('generacionResiboPagpPDF.php');
                $reporteRecibo = new generarMYPDF_RECIBODEPAGO();
                $numeroRecibo = $_REQUEST["p3"];
                $idReporte = $_REQUEST["p4"];
                /* ===================================================================================================== */
                /* =======================================   Datos de Cabecera   ============================================ */
                $labelCabecera = $o_ActionReporte->labelReportePdf("recibodepago", $idReporte, 1);
                $datosEmpresa = $o_ActionReporte->datosEmpresaGeneraelRecibo('0110073');
                $datosPaciente = $o_ActionReporte->datosPacienteGeneraelRecibo($numeroRecibo);
                $datosFecha = $o_ActionReporte->fechaEmiteResibo();
                $datosCabecera = array();
                $datosCabecera[4] = $datosEmpresa[0][0];
                $datosCabecera[5] = $datosEmpresa[0][1];
                $datosCabecera[6] = $datosEmpresa[0][2];
                $datosCabecera[7] = $numeroRecibo;
                $datosCabecera[8] = $datosPaciente[0][0];
                $datosCabecera[9] = htmlentities($datosPaciente[0][1]); //$str_replace("ñ", "&ntilde;", $datosPaciente[0][1]);
                $datosCabecera[10] = $datosPaciente[0][2];
                $datosCabecera[11] = $datosPaciente[0][3];
                $datosCabecera[12] = $datosPaciente[0][4];
                $datosCabecera[13] = $datosFecha[0][0];
                /* ===================================================================================================== */
                /* =======================================   Datos de Detalle   ============================================ */
//                $labelDetalle = $o_ActionReporte->labelReportePdf("recibodepago", $idReporte, 2);
//                $datosDetalle = array();
                $labelDetalle = $o_ActionReporte->labelReportePdf("recibodepago", $idReporte, 2);
                $datosDet = $o_ActionReporte->datosDetalleReciboGenerado($numeroRecibo);
                $datosDetalle = array();
                foreach ($datosDet as $i => $value) {
                    $datosDetalle[$i] = $value;
                }
                /* ===================================================================================================== */
                /* =======================================   Datos de Pie   ============================================ */
                $labelPie = $o_ActionReporte->labelReportePdf("recibodepago", $idReporte, 3);
                $datosPieRecibo = $o_ActionReporte->datosPieReciboGenerado($numeroRecibo);
                $datosPie = array();
                $datosPie[4] = $datosPieRecibo[0][1];
                if ($datosPieRecibo[0][0] == '1') {
                    $datosPie[5] = $datosPieRecibo[0][2];
                    $datosPie[6] = $datosPieRecibo[0][3];
                    $datosPie[7] = $datosPieRecibo[0][4];
                    $datosPie[8] = $datosPieRecibo[0][5];
                }


                /* ===================================================================================================== */
                /* =====================================   Todo Los atributos   ======================================== */
                $atributosRecibo = $o_ActionReporte->atributosRecetaMedica($idReporte);
                $parametros["PDF_PAGE_FORMAT"] = "BOLETA_DE_PAGO";
                $parametros["PDF_MARGIN_HEADER"] = 0;
                $parametros["PDF_MARGIN_FOOTER"] = 0;
                $parametros["AUTO_PAGE_BREAK"] = false;
                $parametros["PDF_MARGIN_BOTTOM"] = 0;
                $parametros["PDF_PAGE_ORIENTATION"] = "P";
                $parametros["PDF_MARGIN_LEFT"] = 1;
                $parametros["PDF_MARGIN_TOP"] = 0;
                $parametros["PDF_MARGIN_RIGHT"] = 1;
                $parametros["PRINT_HEADER"] = false;
                $parametros["PRINT_FOOTER"] = false;
                //$datosPie = "";
                $nombreReporte = $numeroRecibo;
                $reporteRecibo->generarMYPDF_RECIBO($atributosRecibo, $labelCabecera, $labelDetalle, $labelPie, $datosCabecera, $datosDetalle, $datosPie, $modo, $nombreReporte, $parametros);
                break;
            }
        case 'recibodepagoImprimir': {
                // require_once('generarReporteRecibodePago.php');//generacionResiboPagpPDF
                require_once('generarResiboImprimir.php');
                $reporteRecibo = new generarMYPDF_RECIBODEPAGO();
                $numeroRecibo = $_REQUEST["p3"];
                $idReporte = $_REQUEST["p4"];
                $c_cod_per = $_REQUEST["p5"];
                /* ===================================================================================================== */
                /* =======================================   Datos de Cabecera   ============================================ */
                $labelCabecera = $o_ActionReporte->labelReportePdf("recibodepago", $idReporte, 1);
                $datosEmpresa = $o_ActionReporte->datosEmpresaGeneraelRecibo('0110073');
                $datosPaciente = $o_ActionReporte->datosPacienteGeneraelRecibo($numeroRecibo);
                $datosFecha = $o_ActionReporte->fechaEmiteResibo();
                $exitenciaHistoriaClinica = $o_ActionReporte->ExitenciaHistoriaClinica($c_cod_per);
                $datosCabecera = array();
                $datosCabecera[4] = $datosEmpresa[0][0];
                $datosCabecera[5] = $datosEmpresa[0][1];
                $datosCabecera[6] = $datosEmpresa[0][2];
                $datosCabecera[7] = substr($numeroRecibo, 0, 2); //////////MODIFICAR AQUI
                $datosCabecera[8] = $datosPaciente[0][0];
                $datosCabecera[9] = htmlentities($datosPaciente[0][1]); //$str_replace("ñ", "&ntilde;", $datosPaciente[0][1]);
                $datosCabecera[10] = $datosPaciente[0][2];
                $datosCabecera[11] = $datosPaciente[0][3];
                $datosCabecera[12] = $datosPaciente[0][4];
                $datosCabecera[13] = $datosFecha[0][0];
                $datosCabecera[14] = substr($numeroRecibo, 4, strlen($numeroRecibo));
                $datosCabecera[15] = $numeroRecibo;
                $datosCabecera[16] = $exitenciaHistoriaClinica[0][0];

                /* ===================================================================================================== */
                /* =======================================   Datos de Detalle   ============================================ */
//                $labelDetalle = $o_ActionReporte->labelReportePdf("recibodepago", $idReporte, 2);
//                $datosDetalle = array();
                $labelDetalle = $o_ActionReporte->labelReportePdf("recibodepago", $idReporte, 2);
                $datosDet = $o_ActionReporte->datosDetalleReciboGenerado($numeroRecibo);
                $datosDetalle = array();
                foreach ($datosDet as $i => $value) {
                    $datosDetalle[$i] = $value;
                }
                /* ===================================================================================================== */
                /* =======================================   Datos de Pie   ============================================ */
                $labelPie = $o_ActionReporte->labelReportePdf("recibodepago", $idReporte, 3);
                $datosPieRecibo = $o_ActionReporte->datosPieReciboGenerado($numeroRecibo);
                $datosPie = array();
                $datosPie[4] = $datosPieRecibo[0][1];
                if ($datosPieRecibo[0][0] == '1') {
                    $datosPie[5] = $datosPieRecibo[0][2];
                    $datosPie[6] = $datosPieRecibo[0][3];
                    $datosPie[7] = $datosPieRecibo[0][4];
                    $datosPie[8] = $datosPieRecibo[0][5];
                }


                /* ===================================================================================================== */
                /* =====================================   Todo Los atributos   ======================================== */
                $atributosRecibo = $o_ActionReporte->atributosRecetaMedica($idReporte);
                $parametros["PDF_PAGE_FORMAT"] = "BOLETA_DE_PAGO";
                $parametros["PDF_MARGIN_HEADER"] = 0;
                $parametros["PDF_MARGIN_FOOTER"] = 0;
                $parametros["AUTO_PAGE_BREAK"] = false;
                $parametros["PDF_MARGIN_BOTTOM"] = 0;
                $parametros["PDF_PAGE_ORIENTATION"] = "P";
                $parametros["PDF_MARGIN_LEFT"] = 1;
                $parametros["PDF_MARGIN_TOP"] = 0;
                $parametros["PDF_MARGIN_RIGHT"] = 1;
                $parametros["PRINT_HEADER"] = false;
                $parametros["PRINT_FOOTER"] = false;
                //$datosPie = "";
                $nombreReporte = $numeroRecibo;
                $reporteRecibo->generarMYPDF_RECIBO($atributosRecibo, $labelCabecera, $labelDetalle, $labelPie, $datosCabecera, $datosDetalle, $datosPie, $modo, $nombreReporte, $parametros);
                break;
            }

        case 'carnetSanidad': {
                // require_once('generarReporteRecibodePago.php');//generacionResiboPagpPDF
                require_once('generarCarnetSanidad.php');
                $reporteRecibo = new generarMYPDFRMECARNET();
                $DNI = $_REQUEST["p3"];
                $nombreCompleto = $_REQUEST["p4"];
                $tipoCertificado = $_REQUEST["p5"];
                $c_cod_per = $_REQUEST["p6"];
                $idReporte = $_REQUEST["p7"];
                $apellidos = $_REQUEST["p8"];
                $nombre = $_REQUEST["p9"];
                $fechaActual = $_REQUEST["p10"];
                $fechaCaducidad = $_REQUEST["p11"];
//                print_r($tipoCertificado);
                /* ===================================================================================================== */
                /* =======================================   Datos de Cabecera   ============================================ */
                $labelCabecera = $o_ActionReporte->labelReportePdf("CarnetSanidad", $idReporte, 1);
//                $datosEmpresa = $o_ActionReporte->datosEmpresaGeneraelRecibo('0110073');
//                $datosPaciente = $o_ActionReporte->datosPacienteGeneraelRecibo($numeroRecibo);
//                $datosFecha = $o_ActionReporte->fechaEmiteResibo();
//                $exitenciaHistoriaClinica = $o_ActionReporte->ExitenciaHistoriaClinica($c_cod_per);
                $datosCabecera = array();
//                $datosCabecera[4] = $datosEmpresa[0][0];
//                $datosCabecera[5] = $datosEmpresa[0][1];
//                $datosCabecera[6] = $datosEmpresa[0][2];
//                $datosCabecera[7] = substr($numeroRecibo, 0, 2); //////////MODIFICAR AQUI
//                $datosCabecera[8] = $datosPaciente[0][0];
//                $datosCabecera[9] = htmlentities($datosPaciente[0][1]); //$str_replace("ñ", "&ntilde;", $datosPaciente[0][1]);
//                $datosCabecera[10] = $datosPaciente[0][2];
//                $datosCabecera[11] = $datosPaciente[0][3];
//                $datosCabecera[12] = $datosPaciente[0][4];
//                $datosCabecera[13] = $datosFecha[0][0];
//                $datosCabecera[14] = substr($numeroRecibo, 4, strlen($numeroRecibo));
//                $datosCabecera[15] = $numeroRecibo;
//                $datosCabecera[16] = $exitenciaHistoriaClinica[0][0];
                $datosCabecera[0] = $DNI;
                $datosCabecera[1] = $nombreCompleto;
                $datosCabecera[2] = $tipoCertificado;
                $datosCabecera[3] = $c_cod_per;
                $datosCabecera[4] = $apellidos;
                $datosCabecera[5] = $nombre;
                $datosCabecera[6] = $fechaActual;
                $datosCabecera[7] = $fechaCaducidad;

                /* ===================================================================================================== */
                /* =======================================   Datos de Pie   ============================================ */

                $datosPie[0] = '';
                /* ===================================================================================================== */
                /* =====================================   Todo Los atributos   ======================================== */
//                $atributosRecibo = $o_ActionReporte->atributosRecetaMedica($idReporte);
                $atributosRecibo = $o_ActionReporte->atributosRecetaMedica($idReporte);
                $parametros["PDF_PAGE_FORMAT"] = "CERNET_SANIDAD";
                $parametros["PDF_MARGIN_HEADER"] = 0;
                $parametros["PDF_MARGIN_FOOTER"] = 0;
                $parametros["AUTO_PAGE_BREAK"] = false;
                $parametros["PDF_MARGIN_BOTTOM"] = 0;
                $parametros["PDF_PAGE_ORIENTATION"] = "L";
                $parametros["PDF_MARGIN_LEFT"] = 10;
                $parametros["PDF_MARGIN_TOP"] = 0;
                $parametros["PDF_MARGIN_RIGHT"] = 0;
                $parametros["PRINT_HEADER"] = false;
                $parametros["PRINT_FOOTER"] = false;
                //$datosPie = "";
                $nombreReporte = 'Carnet Sanidad';
                $reporteRecibo->generarMYPDF_CARNET_SANIDAD($datosCabecera, $modo, $nombreReporte, $parametros, $labelCabecera, $atributosRecibo);
                break;
            }
        case "entregaResultadoImagenes": {
                require_once('generadorDeReportes.php');
                $setdat = new PluginMYPDF();

//orden del array: nroOrden, especialidad, paciente, medico, fecha, hora, ambienteLogio
                $arrayDatos = $_REQUEST["p3"];
                $idReporte = $_REQUEST["p4"];
                $iIdUbicacionesImagenes = $_REQUEST["p5"];
                $datosExamen = $o_ActionReporte->aDatosExamenes($iIdUbicacionesImagenes);
                $datosTicketCita = explode("|", $arrayDatos);

                $nombreReporte = "Cita" . $datosTicketCita[0];

                /* ===================================================================================================== */
                /* =======================================   Datos de Cabecera   ============================================ */
                $labelCabecera = $o_ActionReporte->labelReportePdf("ticketcita", $idReporte, 1);
                $datosCabecera = array();
                $datosPie = array();
                $datosCabecera[0] = "";
                /* ===================================================================================================== */
                /* =======================================   Datos de Detalle   ============================================ */
                $labelDetalle = $o_ActionReporte->labelReportePdf("ticketcita", $idReporte, 2);
//                for ($i = 0; $i < count($datosTicketCita) - 1; $i++) { //observacion (-1) por que entrar 7 columnas (del 0 al 6) pero se envia al generador de reporte solo 6 columas
//                    $datosDetalle[0][$i] = $datosTicketCita[$i];
//                }
                $datosCabecera[1] = $datosTicketCita[2];
                $datosCabecera[3] = utf8_encode($datosTicketCita[3]);
                // $datosDetalle[0][0]=$datosTicketCita[2];
                $datosDetalle[0][0] = utf8_encode(strtoupper($datosExamen[0][0]));
                //$datosDetalle[1][0]=$datosTicketCita[2];
                $datosDetalle[1][0] = utf8_encode($datosExamen[1][0]);
                //$datosDetalle[2][0]=$datosExamen[2][0];
                $datosPie[0] = utf8_encode($datosExamen[0][1]);
                $datosPie[1] = utf8_encode($datosExamen[0][2]);
                $datosPie[2] = utf8_encode($datosExamen[0][3]);
                $datosPie[3] = utf8_encode($datosExamen[0][4]);
                /* ===================================================================================================== */
                /* =======================================   Datos de Pie   ============================================ */
                //
                $labelPie = $o_ActionReporte->labelReportePdf("ticketcita", $idReporte, 3);
//                $datosMedico=$o_ActionReporte->datosMedico($codMedico);
//                $datosPie[2]="";

                /* ===================================================================================================== */
                /* =====================================   Todo Los atributos   ======================================== */
                $atributosReceta = $o_ActionReporte->atributosRecetaMedica($idReporte);
                //print_r($atributosReceta);
                $parametros["PDF_PAGE_FORMAT"] = "TICKET_CARGO";
                $parametros["PDF_MARGIN_HEADER"] = 0;
                $parametros["PDF_MARGIN_FOOTER"] = 0;
                $parametros["AUTO_PAGE_BREAK"] = false;
                $parametros["PDF_MARGIN_BOTTOM"] = 0;
                //$parametros["PDF_PAGE_ORIENTATION"] = "L";
                $parametros["PDF_MARGIN_LEFT"] = 1;
                $parametros["PDF_MARGIN_TOP"] = 0;
                $parametros["PDF_MARGIN_RIGHT"] = 1;
                $parametros["PRINT_HEADER"] = false;
                $parametros["PRINT_FOOTER"] = false;
                //$parametros[""]
                $setdat->generarMYPDF($atributosReceta, $labelCabecera, $labelDetalle, $labelPie, $datosCabecera, $datosDetalle, $datosPie, $modo, $nombreReporte, $parametros);
                break;
            }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
