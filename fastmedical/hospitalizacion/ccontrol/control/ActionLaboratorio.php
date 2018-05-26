<?php

include_once("ActionPersona.php");
include_once("../../clogica/LLaboratorio.php");
require_once("../../../pholivo/tablaDHTMLX.php");

class ActionLaboratorio {

    public function __construct() {
        
    }

//creado por peche 03 de julio 2012
    public function aContenidoPuntoControl() {

        require_once('../../../hospitalizacion/cvista/laboratorio/vistaPuntoControl.php');
    }

//creadp por peche 

    function aTablaPuntosControl() {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = $oLLaboratorio->lTablaPuntosControl();
        $arrayCabecera = array(0 => "Id", 1 => "Punto de Control", 2 => "Estado");
        $arrayTamano = array(0 => "40", 1 => "*", 2 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function aPersonasPorPuntoControl($idPuntoControl, $fecha) {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = $oLLaboratorio->lPersonasPorPuntoControl($idPuntoControl, $fecha);
        $arrayCabecera = array(0 => "IdpacienteLaboratorio", 1 => "C. Barras", 2 => "idPacienteLaboratorioPuntoControl", 3 => "idProcesarPuntoControl",
            4 => "Fecha", 5 => "Paciente", 6 => "Afiliacion", 7 => "Examen", 8 => "Origen", 9 => "Color", 10 => "Estado", 11 => "Sede");
        $arrayTamano = array(0 => "40", 1 => "70", 2 => "*", 3 => "*", 4 => "80", 5 => "*", 6 => "80", 7 => "*", 8 => "80", 9 => "*", 10 => "80", 11 => "80");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro", 9 => "ro", 10 => "ro", 11 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default", 10 => "default", 11 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "true", 3 => "true", 4 => "false", 5 => "false", 6 => "false", 7 => "false", 8 => "false", 9 => "true", 10 => "false", 11 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "left", 7 => "left", 8 => "left", 9 => "left", 10 => "left", 11 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function aVerProcesarPuntoControl($idPuntoControl, $nombrePuntoControl) {
        $nombrePuntoControl = $nombrePuntoControl;
        require_once('../../../hospitalizacion/cvista/laboratorio/vProcesarPaciente.php');
    }

    function aAlertaPuntoControlErroneo($datos) {
        // $nombrePuntoControl = $nombrePuntoControl;
        require_once('../../../hospitalizacion/cvista/laboratorio/vAlertaPuntoControlErroneo.php');
    }

    function aVerRecibirPuntoControl($idPuntoControl, $nombrePuntoControl) {
        $nombrePuntoControl = $nombrePuntoControl;
        require_once('../../../hospitalizacion/cvista/laboratorio/vRecibirPaciente.php');
    }

    function aVerificarRecibirPuntoControl($datos) {
        $oLLaboratorio = new LLaboratorio();
        // $idPuntoControl = $datos['idPuntoControl'];

        $arrayRespuesta = $oLLaboratorio->lVerificarRecibirPuntoControl($datos);
        $cadena = '';
        $cadena = $arrayRespuesta[0][0] . '|*';
        $cadena.=$arrayRespuesta[0][1] . '|*';
        $cadena.=$arrayRespuesta[0][2] . '|*';
        $cadena.=$arrayRespuesta[0][3] . '|*';
        $cadena.=$arrayRespuesta[0][4] . '|*';
        $cadena.=$arrayRespuesta[0][5] . '|*';
        $cadena.=$arrayRespuesta[0][6] . '|*';
        $cadena.=$arrayRespuesta[0][7] . '|*';
        //$respuesta=$arrayRespuesta[0][0];
        return $cadena;
        //require_once('../../../hospitalizacion/cvista/laboratorio/vistaDetallePuntoControl.php');
    }

    function aVerificarProcesarPuntoControl($datos) {
        $oLLaboratorio = new LLaboratorio();
        // $idPuntoControl = $datos['idPuntoControl'];

        $arrayRespuesta = $oLLaboratorio->lVerificarProcesarPuntoControl($datos);
        $cadena = '';
        $cadena = $arrayRespuesta[0][0] . '|*';
        $cadena.=$arrayRespuesta[0][1] . '|*';
        $cadena.=$arrayRespuesta[0][2] . '|*';
        $cadena.=$arrayRespuesta[0][3] . '|*';
        $cadena.=$arrayRespuesta[0][4] . '|*';
        $cadena.=$arrayRespuesta[0][5] . '|*';
        $cadena.=$arrayRespuesta[0][6] . '|*';
        $cadena.=$arrayRespuesta[0][7] . '|*';
        //$respuesta=$arrayRespuesta[0][0];
        return utf8_encode($cadena);
        //require_once('../../../hospitalizacion/cvista/laboratorio/vistaDetallePuntoControl.php');
    }

    function aObtenerDetallePuntoControl($datos) {
        $oLLaboratorio = new LLaboratorio();
        $idPuntoControl = $datos['idPuntoControl'];

        $arrayDatosPuntoControl = $oLLaboratorio->lObtenerDetallePuntoControl($idPuntoControl);
        require_once('../../../hospitalizacion/cvista/laboratorio/vistaDetallePuntoControl.php');
    }

    function aGrabarDetallePuntoControl($datos) {
        $oLLaboratorio = new LLaboratorio();

        $idPuntoControl = $datos['idPuntoControl'];
        $arrayDatosPuntoControl = $oLLaboratorio->lGrabarDetallePuntoControl($datos);
        require_once '../../../hospitalizacion/cvista/laboratorio/vistaDetallePuntoControl.php';
//  print_r($datos);
    }

    function aAgregarDetallePuntoControl($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayDatosPuntoControl = $oLLaboratorio->lAgregarDetallePuntoControl($datos);  //  print_r($datos);
        require_once('../../../hospitalizacion/cvista/laboratorio/vistaDetallePuntoControl.php');
    }

    function aContenidoProcesarPuntoControl() {
        $oLLaboratorio = new LLaboratorio();
//$arrayDatosPuntoControl = $oLLaboratorio->lAgregarDetallePuntoControl($datos);  //  print_r($datos);
        $arrayCombo = $oLLaboratorio->lcomboPuntoControl();
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        require_once('../../../hospitalizacion/cvista/laboratorio/vistaProcesarPuntoControl.php');
    }

    function aMantenimientoPerfiles() {
        require_once('../../../hospitalizacion/cvista/laboratorio/vMantenimientoPerfiles.php');
    }

//JCDB 04/07/2012
    function aCargartablaPerfiles() {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLLaboratorio->lCargartablaPerfiles();
        $arrayCabecera = array(0 => "ID", 1 => "c_cod_ser_pro", 2 => "Perfil", 3 => "Seleccionar");
        $arrayTamano = array(0 => "45", 1 => "100", 2 => "475", 3 => "85");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "pointer");
        $arrayHidden = array(0 => "false", 1 => "true", 2 => "false", 3 => "true");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "left", 3 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

//JCDB 16/07/2012
    function aCargarTablaUsuariosHabilitadosXPuntoControl($parametros) {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLLaboratorio->lCargarTablaUsuariosHabilitadosXPuntoControl($parametros);
        $arrayCabecera = array(0 => "ID", 1 => "Nombre", 2 => "Eliminar");
        $arrayTamano = array(0 => "45", 1 => "415", 2 => "85");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

//JCDB 17/07/2012
    function aEliminarUsuariosHabilitadosXPuntoControl($parametros) {
        $oLLaboratorio = new LLaboratorio();
        $respuesta = $oLLaboratorio->lEliminarUsuariosHabilitadosXPuntoControl($parametros);
        $resp = "|";
        if ($respuesta)
            $resp = $respuesta[0][0];
        return $resp;
    }

//JCDB 17/07/2012
    function aConsultaEstadoExamen() {
        $o_LPersona = new ActionPersona();
        $comboTipoDocumentos = $o_LPersona->comboTipoDocumento('1');
        require_once('../../../hospitalizacion/cvista/laboratorio/vConsultaEstadoExamenes.php');
    }

//JCDB 17/07/2012
    function aCargarTablaEstadoExamenes($parametros) {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLLaboratorio->lCargarTablaEstadoExamenes($parametros);
        $cboActividadesLaboratorio = $oLLaboratorio->lListaActividadesLaboratorio();
        $cboActividadesLaboratorio = is_array($cboActividadesLaboratorio) ? $cboActividadesLaboratorio : array();

        $arrayCabecera = array(0 => "iIdPacienteLaboratorioPuntoControlExamen", 1 => "iIdPacienteLaboratorio", 2 => "Fecha", 3 => "Sede", 4 => "Nombre", 5 => "Afiliacion", 6 => "TipoExamen", 7 => "Procedencia", 8 => "Ubicacion", 9 => "Estado", 10 => "vColor", 11 => "idPuntoControl", 12 => "idTipoProceso", 13 => "iIdPtoCtrlExLab", 14 => "bRecibir", 15 => "iCodigoBarraSeguimiento", 16 => "ver", 17 => "Imp.", 18 => "Rep.", 19 => "Anul.");
        $arrayTamano = array(0 => "45", 1 => "45", 2 => "51", 3 => "100", 4 => "180", 5 => "100", 6 => "*", 7 => "120", 8 => "120", 9 => "80", 10 => "176", 11 => "56", 12 => "176", 13 => "56", 14 => "56", 15 => "63", 16 => "30", 17 => "30", 18 => "30", 19 => "30");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "co", 8 => "ro", 9 => "ro", 10 => "ro", 11 => "ro", 12 => "ro", 13 => "ro", 14 => "ro", 15 => "ro", 16 => "img", 17 => "img", 18 => "img", 19 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default", 10 => "default", 11 => "default", 12 => "default", 13 => "default", 14 => "default", 15 => "pointer", 16 => "pointer", 17 => "pointer", 18 => "pointer", 19 => "pointer");
//$arrayHidden = array(0 => "true", 1 => "true", 2 => "false", 3 => "false", 4 => "false", 5 => "false", 6 => "false", 7 => "false", 8 => "false", 9 => "true", 10 => "true", 11 => "true", 12 => "true", 13 => "true",14 => "true", 15 => "false", 16 => "false");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "true", 6 => "false", 7 => "false", 8 => "false", 9 => "false", 10 => "true", 11 => "true", 12 => "true", 13 => "true", 14 => "true", 15 => "false", 16 => "false", 17 => "false", 18 => "false", 19 => "false");
        $arrayAling = array(0 => "right", 1 => "right", 2 => "center", 3 => "left", 4 => "left", 5 => "left", 6 => "left", 7 => "left", 8 => "left", 9 => "left", 10 => "left", 11 => "left", 12 => "left", 13 => "left", 14 => "left", 15 => "center", 16 => "center", 17 => "center", 18 => "center", 19 => "center");
//return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
        return $o_TablaHtmlx->generaTablaFullCombo($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling, $cboActividadesLaboratorio);
    }

//JCDB 23/07/2012
    function aPopudEntregaFrasco() {
        require_once('../../../hospitalizacion/cvista/laboratorio/vPopudEntregaFrasco.php');
    }

//JCDB 24/07/2012
    function aActualizarProcedenciaExamenLaboratorio($parametros) {
        $oLLaboratorio = new LLaboratorio();
        $respuesta = $oLLaboratorio->lActualizarProcedenciaExamenLaboratorio($parametros);
        $resp = "|";
        if ($respuesta)
            $resp = $respuesta[0][0] . "|" . $respuesta[0][1];
        return $resp;
    }

//JCDB 26/07/2012
    function aCargarDatosEntregaFrasco($parametros) {
        $oLLaboratorio = new LLaboratorio();
        $respuesta1 = $oLLaboratorio->lDescripcionRecipiente($parametros);
        $resp = "|";
        $respuesta2 = $oLLaboratorio->lImagenRecipiente($parametros);
        $resp = $respuesta1[0][0] . "|" . $respuesta2[0][0];
        return $resp;
    }

//JCDB 26/07/2012
    function aInsertarSiguientePuntoControlExamenLaboratorio($parametros) {
        $oLLaboratorio = new LLaboratorio();
        $respuesta = $oLLaboratorio->lInsertarSiguientePuntoControlExamenLaboratorio($parametros);
        $resp = "|";
        $resp = $respuesta[0][0] . "|";
        return $resp;
    }

//JCDB 26/07/2012
    function aPopudRecepcionFrasco($parametros) {
        require_once('../../../hospitalizacion/cvista/laboratorio/vPopudRecepcionFrasco.php');
    }

//JCDB 30/07/2012
    function aCargarDatosRecepcionFrasco($parametros) {
        $oLLaboratorio = new LLaboratorio();
        $respuesta1 = $oLLaboratorio->lCargarTipoMuestra($parametros);
        $respuesta2 = $oLLaboratorio->lCargarTelefono($parametros);
        $respuesta3 = $oLLaboratorio->lImagenRecipiente($parametros);
        $respuesta4 = $oLLaboratorio->lCaputarObservacionPuntoControl($parametros);
        $resp = "|";
        $resp = strtoupper($respuesta1[0][0]) . "|" . $respuesta2[0][0] . "|" . $_SESSION['login_user'] . "|" . $respuesta3[0][0] . "|" . $respuesta4[0][0];
        return $resp;
    }

    //JCDB 31/07/2012
    function aRecepcionarFrasco($parametros) {
        $oLLaboratorio = new LLaboratorio();
        $respuesta = $oLLaboratorio->lRecepcionarFrasco($parametros);
        return $respuesta;
    }

    //JCDB 01/08/2012
    function aCargarComboProcedencia() {
        $oLLaboratorio = new LLaboratorio();
        $cboActividadesLaboratorio = $oLLaboratorio->lListaActividadesLaboratorio();
        $cboActividadesLaboratorio = is_array($cboActividadesLaboratorio) ? $cboActividadesLaboratorio : array();
        $combo = '';
        $combo = '<select name="comboProcedencia" id="comboProcedencia" onchange="filterByProcedencia()" style="background-color: #B3EB75">';
        $combo.='<option value="-1" selected="selelected" style="background-color: #FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
        foreach ($cboActividadesLaboratorio as $i => $value) {
            $combo.='<option value="' . $value[0] . '" style="background-color:' . $value[2] . ' ;" >';
            $combo.=htmlentities($value[1]) . '</option>';
        }
        $combo.='</select>';
        return $combo;
    }

    //JCDB 02/08/2012
    function aCapturaFechaLaboratorio() {
        $oLLaboratorio = new LLaboratorio();
        $respuesta = $oLLaboratorio->lCapturaFechaLaboratorio();
        return trim($respuesta[0][0]);
    }

    //JCDB 02/08/2012
    function aGeneradorCodigoBarra() {
        require_once('../../../hospitalizacion/cvista/laboratorio/vGeneracionCodigoBarra.php');
    }

    function aHistorialExamen($datos) {
//$muestra=$this->aCargarDatosRecepcionFrasco($datos);
        $oLLaboratorio = new LLaboratorio();
        $arrayTelefonos = $oLLaboratorio->lDatosPacienteLaboratorio($datos["idPacienteLaboratorio"]);
        $arrayPuntosControl = $oLLaboratorio->lPuntosControlPaciente($datos["idPacienteLaboratorio"]);
        $cadenaAcordion = '';
        $cadenaAcordion .= "divDatos*Datos Examen";
        $cadenaAcordion.="|divMuestra*Descripcoón de Muestra";
        $aux = '';
        $arrayAuxPuntoControl = array();
        foreach ($arrayPuntosControl as $key => $value) {
            if ($aux != $value[1]) {
                $div = "div" . $value[1];
                $nombrePuntoControl = utf8_encode($value[5]);
                $cadenaAcordion.="|$div*$nombrePuntoControl";
                $arrayAuxPuntoControl[$value[1]] = $value;
            } else {
                $arrayAuxPuntoControl[$value[1]][13] = $value[9];
                $arrayAuxPuntoControl[$value[1]][14] = $value[10];
                $arrayAuxPuntoControl[$value[1]][15] = $value[11];
                $arrayAuxPuntoControl[$value[1]][16] = $value[12];
                //array_push($arrayAuxPuntoControl[$value[1]], $value);
            }
            $aux = $value[1];
        }

        //print_r($arrayAuxPuntoControl);
//        $cadenaAcordion = "ac1*Datos Examen";
//        $cadenaAcordion.="|ac2*Descripcoón de Muestra";
//        $cadenaAcordion.="|ac3*punto de Control2";
//        $cadenaAcordion.="|ac4*punto de Control3";
//        $cadenaAcordion.="|ac5*punto de Control4";
//        $cadenaAcordion.="|ac6*punto de Control5";
//        $cadenaAcordion.="|ac7*punto de Control6";
//        $cadenaAcordion.="|ac8*punto de Control7";
        require_once('../../../hospitalizacion/cvista/laboratorio/vHistorialExamen.php');
    }

    //creado x JCQA 26 septiembre 2012

    public function AMostrarMaterialesSeleccionadosXpuntoControlExamenLabo($datos) {
        $oLLaboratorio = new LLaboratorio();

        $arrayListaMaterialesxPuntoDeControlxExamen = $this->listarMatxPCxE($datos);

        $cadenaAcordionMaterialesxPuntoControlxExamenLabo = '';
        $cadenaAcordionMaterialesxPuntoControlxExamenLabo .= "divDatosjc*Observaciones#Materiales";
//        $cadenaAcordionMaterialesxPuntoControlxExamenLabo.="|divMuestrajc*Descripcoón de Muestra";

        foreach ($arrayListaMaterialesxPuntoDeControlxExamen as $value) {
            $div = "div" . $value[0]; //iIdExamenLaboratorioUnidadMedidaLaboratorio
            $nombreMateriales = utf8_encode($value[2]) . '#' . utf8_encode($value[4]) . '-' . utf8_encode($value[6]);

            $cadenaAcordionMaterialesxPuntoControlxExamenLabo.="|$div*$nombreMateriales";
        }


        require_once("../../cvista/laboratorio/ListaDetalleMaterialesxPuntoControlExamenLaboratorio.php");
    }

    //creado x JCQA 28 septiembre 2012

    public function AMostrarMuestrasSeleccionadosXpuntoControlExamenLabo($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayListaMuestrasxPuntoDeControlxExamen = $oLLaboratorio->llistarMuestrasxPCxE($datos);
//        $arrayListaMaterialesxPuntoDeControlxExamen = $this->listarMatxPCxE($datos);

        $cadenaAcordionMuestrasxPuntoControlxExamenLabo = '';
        $cadenaAcordionMuestrasxPuntoControlxExamenLabo .= "divDatosjc2*Observaciones#Muestras";
//        $cadenaAcordionMuestrasxPuntoControlxExamenLabo.="|divMujc2*Descripcoón de Muestra";

        foreach ($arrayListaMuestrasxPuntoDeControlxExamen as $value) {
            $div = "divMuestra" . trim($value[0]); //iIdExamenLaboratorioUnidadMedidaLaboratorio
            $nombreMuestra = utf8_encode($value[2]) . '#' . utf8_encode($value[4]) . '-' . utf8_encode($value[6]);
            $cadenaAcordionMuestrasxPuntoControlxExamenLabo.="|$div*$nombreMuestra";
        }


        require_once("../../cvista/laboratorio/ListaDetalleMuestrasxPuntoControlExamenLaboratorio.php");
    }

//      Modificado por JCQA 26 Septiembre 2012 -----
    public function listarMatxPCxE($datos) {
        $oLLaboratorio = new LLaboratorio();
        $respuesta = $oLLaboratorio->llistarMatxPCxE($datos);
        return $respuesta;
    }

    //      creado por JCQA 24 Septiembre 2012 -----
    public function listarMatxPCxE_prueba($datos) {
        $oLLaboratorio = new LLaboratorio();
        $respuesta = $oLLaboratorio->llistarMatxPCxE($datos);
        $cadena = "";
        $cadena.='<fieldset style=" margin:5px;"><legend>&nbsp; Materiales Guardados &nbsp;</legend><div style="margin-left: 1%; margin-right: 1%;">';
        $cadena.="<h2 align='center'> Lista de Materiales en el Punto de Control del Examen seleccionado</h2>";
        foreach ($respuesta as $i => $value) {

//            echo "josecito" . $value["iIdMaterialesLaboratorio"];
            $datos = array();
            $datos["idMaterialLaboratorio"] = $value["iIdMaterialesLaboratorio"];
//            $ComboTipoUnidadMedidaMaterialSeleccionado = $this->AcargarComboTipoUnidadMedidaMaterialSeleccionado($datos);

            $arrayTipoUnidadMedida = $oLLaboratorio->LcargarComboTipoUnidadMedidaMaterialSeleccionado($datos);

            $combo = '<select id="cboTipoUnidadMedidaDisponibles' . $i . '" onchange="cargarComboUnidadMedidaMaterialSeleccionado();"  style="width:150px; font-size:12px" >';
            $combo.='<option value="x" style="background-color: #FFFFFF">Seleccionar</option>';


            foreach ($arrayTipoUnidadMedida as $n => $valuen) {

                $combo .= '<option value="' . $valuen[1] . ' " ' . $select . '  >' . htmlentities($valuen[0]) . '</option>';
                $a = $respuesta[$i][3];
                $b = $respuesta[$i][4];
                if ($valuen[1] == $respuesta[$i][3]) {
                    $seleccionado = 'selected';
                } else {
                    $seleccionado = '';
                }
                $combo.="<option $seleccionado value=$a>$b</option>";
            }
            $combo .= '</select>';



            $cadena.='<fieldset style=" padding-left: 20px;background-color: #FFFFFF;font-size: 16px;">
                   <table width="600" border="0" align="center" cellpadding="0" cellspacing="2">
                   <tr>
                   <td>Nombre Material:</td> 
                   <td><input type="text" id="txtNombreMaterialSeleccionado' . $i . '" size="60"  readonly="readonly" value="' . $respuesta[$i][2] . '" /> </td>
                   </tr>     
                   <tr>
                   <td>Tipo de Unidad:</td>
                   <td>
                   
                   <div id="Div_ComboTipoUnidadMedidaMaterialSeleccionado' . $i . '">' . $combo .
                    '</div>   
                    </td>
                    
                   </tr>
                   
                <tr>
                    <td>Unidad de Medida:</td>
                    <td>
                    <div id="Div_ComboUnidadMedidaMaterialSeleccionado' . $i . '">
                      <select id="cboUnidadMedidaDisponibles' . $i . '" style="width:150px; font-size:12px">
                      <option value="x" selected style="background-color: #CED2E5">Seleccionar</option>
                      </select>
                    </div>
                    </td>
                </tr>
                
                <tr>
                  <td>Cantidad Máxima:</td>
                   <td>
                       <input type="text" id="txtCantidadMaximaMaterialLabo' . $i . '" size="30" value="' . $respuesta[$i][8] . '"  />          
                   </td>
               </tr>
                <tr>
                                <td>Cantidad Minima:</td>
                                <td>
                                    <input type="text" id="txtCantidadMinimaMaterialLabo' . $i . '" size="30" value="' . $respuesta[$i][7] . '" />       
                                </td>
                            </tr>


                        <tr>
                                <td>
                                    <div id="div_BotonEditar_Material_MDxE' . $i . '">
                                      <a href="javascript:buscarMaterialesLaboratorioPopap();"><img border="0" title="Editar" alt="" src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif"/></a>
            
                                    </div> 

                                 </td>
                                                                 <td>
                                    <div id="div_BotonEliminar_Material_MDxE' . $i . '">
                                      <a href="javascript:buscarMaterialesLaboratorioPopap();"><img border="0" title="Eliminar" alt="" src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif"/></a>
            
                                    </div> 

                                 </td>
                        </tr>

            </table>
            </fieldset><br>';
        }
        $cadena.='</div></fieldset><br>';
        return $cadena;
    }

    function datosMuestra($datos) {
        $oLLaboratorio = new LLaboratorio();
        $id = $datos;
        $arrayMuestras = $oLLaboratorio->lDatosMuestra($id);
        return $arrayMuestras;
    }

    function datosFraccion($iIdPacienteLaboratorioPuntoControl) {
        $oLLaboratorio = new LLaboratorio();
        $id = $iIdPacienteLaboratorioPuntoControl;
        $arrayMFraccion = $oLLaboratorio->ldatosFraccion($id);
        return $arrayMFraccion;
    }

    function aInsertaPacienteLaboratoriPuntoControl($iIdExamenLaboratorioUnidadMedidaLaboratorio, $iIdPacienteLaboratorioPuntoControlExamen, $cantidad) {
        $oLLaboratorio = new LLaboratorio();

        $respuesta = $oLLaboratorio->lInsertaPacienteLaboratoriPuntoControl($iIdExamenLaboratorioUnidadMedidaLaboratorio, $iIdPacienteLaboratorioPuntoControlExamen, $cantidad);
        return $respuesta[0][0];
    }

    function arrayComboLaboratorio($iiDCombo) {
        $oLLaboratorio = new LLaboratorio();

        $arrayComboLaboratorio = $oLLaboratorio->larrayComboLaboratorio($iiDCombo);

        return $arrayComboLaboratorio;
    }

    function aDatosPuntoControlPaciente($iIdPacienteLaboratorioPuntoControl) {
        $oLLaboratorio = new LLaboratorio();
        $arrayFilas = $oLLaboratorio->lDatosPuntoControlPaciente($iIdPacienteLaboratorioPuntoControl);

        return $arrayFilas;
    }

    function aDatosPuntoControlPacienteProcesado($idProcesarPuntoControlProcesar) {
        $oLLaboratorio = new LLaboratorio();
        $arrayFilas = $oLLaboratorio->lDatosPuntoControlPacienteProcesado($idProcesarPuntoControlProcesar);

        return $arrayFilas;
    }

    function aDatosRecibir($idProcesarPuntoControlRecibir) {
        $oLLaboratorio = new LLaboratorio();
        $arrayFilas = $oLLaboratorio->lDatosRecibir($idProcesarPuntoControlRecibir);

        return $arrayFilas;
    }

    function agregarProcesarPuntoControl($iIdPacienteLaboratorioPuntoControl, $idTipoProceso) {
        //echo "idPaciente:$iIdPacienteLaboratorioPuntoControl<br>";
        //echo "itdProceso: $idTipoProceso<br>";
        $oLLaboratorio = new LLaboratorio();
        $arrayFilas = $oLLaboratorio->lAgregarProcesarPuntoControl($iIdPacienteLaboratorioPuntoControl, $idTipoProceso);
        return $arrayFilas[0][0];
    }

    function aModificarCodigoBarras($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayFilas = $oLLaboratorio->lModificarCodigoBarras($datos);

        return $arrayFilas;
    }

    function aModificarMaterialPersona($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayFilas = $oLLaboratorio->lModificarMaterialPersona($datos);

        return $arrayFilas;
    }

    function aModificarTelefonos($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayFilas = $oLLaboratorio->lModificarTelefonos($datos);

        return $arrayFilas;
    }

    function sMantenimientoDinamico($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayFilas = $oLLaboratorio->lMantenimientoDinamico($datos);

        return $arrayFilas;
    }

    function aGrabarDatoLaboratorio($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayFilas = $oLLaboratorio->lGrabarDatoLaboratorio($datos);

        return $arrayFilas;
    }

    function aTerminarProceso($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayFilas = $oLLaboratorio->lTerminarProceso($datos);

        return $arrayFilas[0][0];
    }

    function aRecibirProceso($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayFilas = $oLLaboratorio->lRecibirProceso($datos);

        return $arrayFilas[0][0];
    }

    // =================================================================================================
    // // =================================================================================================
    // laboratorio del lobo //
    // =================================================================================================
    // =================================================================================================
    // =================================================================================================
    function AmantenimientoDatosExamen() {
        require_once('../../../hospitalizacion/cvista/laboratorio/mantenimientoDatosExamen.php');
    }

    function AbuscarExamenesLaboratorio($datos) {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = $oLLaboratorio->LbuscarExamenesLaboratorio($datos);
        $arrayCabecera = array(0 => "idExamen", 1 => "idTipoExamen", 2 => "Nombre Examen", 3 => "Accion");
        $arrayTamano = array(0 => "20", 1 => "20", 2 => "420", 3 => "100");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "false", 3 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "center");
        //return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor,$arrayHidden,$arrayAlineacion);
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function aCargarTablaPerfilesExamenes($parametros) {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLLaboratorio->lCargarTablaPerfilesExamenes($parametros);
        $arrayCabecera = array(0 => "iIdPerfilExamen", 1 => "ID", 2 => "iIdPerfil", 3 => "c_cod_ser_pro", 4 => "Examén", 5 => "Editar", 6 => "Eliminar");
        $arrayTamano = array(0 => "45", 1 => "45", 2 => "100", 3 => "100", 4 => "420", 5 => "55", 6 => "55");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "img", 6 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "pointer", 6 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "true", 3 => "true", 4 => "false", 5 => "true", 6 => "false");
        $arrayAling = array(0 => "center", 1 => "center", 2 => "left", 3 => "left", 4 => "left", 5 => "center", 6 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function aCargarPoppadExamenesLaboratorio() {
        require_once('../../../hospitalizacion/cvista/laboratorio/vListaExamenesLaboratorio.php');
    }

    function aCargarTablaExamenesLaboratorio($parametros) {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLLaboratorio->lCargarTablaExamenesLaboratorio($parametros);
        $arrayCabecera = array(0 => "ID", 1 => "c_cod_ser_pro", 2 => "Examén");
        $arrayTamano = array(0 => "42", 1 => "10", 2 => "712");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default");
        $arrayHidden = array(0 => "false", 1 => "true", 2 => "false");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Original de lobo 12Julio2012  12:24pm
//    function AreporteDePuntoControlXExamen($datos) {
//        $oLLaboratorio = new LLaboratorio();
//        $o_TablaHtmlx = new tablaDHTMLX();
//
//        $arrayFilas = $oLLaboratorio->LreporteDePuntoControlXExamen($datos);
//        $arrayCabecera = array(3 => "Orden", 0 => "idPuntoContro", 1 => "idPuntoControlExamenLab", 2 => "Nombre del Punto Control", 4 => "Subir", 5 => "Bajar", 6 => "columna");
//        $arrayTamano = array(3 => "50", 0 => "20", 1 => "20", 2 => "320", 4 => "40", 5 => "40", 6 => "40");
//        $arrayTipo = array(3 => "ro", 0 => "ro", 1 => "ro", 2 => "ro", 4 => "img", 5 => "img", 6 => "ro");
//        $arrayCursor = array(3 => "default", 0 => "default", 1 => "default", 2 => "default", 4 => "default", 5 => "default", 6 => "default");
//        $arrayHidden = array(3 => "false", 0 => "true", 1 => "true", 2 => "false", 4 => "false", 5 => "false", 6 => "true");
//        $arrayAling = array(3 => "left", 0 => "left", 1 => "left", 2 => "left", 4 => "center", 5 => "center", 6 => "center");
//        //return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor,$arrayHidden,$arrayAlineacion);
//        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
//    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Original de lobo - Modificado por JCQA 12Julio2012 12:24pm
//modificado x JCQA 8Agosto 2012

    function AreporteDePuntoControlXExamen($datos) {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = $oLLaboratorio->LreporteDePuntoControlXExamen($datos);


        $arrayCabecera = array(3 => "Orden", 0 => "idPuntoContro", 1 => "idPuntoControlExamenLab", 2 => "Nombre del Punto Control", 4 => "M", 5 => "R", 6 => "B", 7 => "Subir", 8 => "Bajar", 9 => "columna", 10 => "Mues.", 11 => "Det.", 12 => "E", 13 => "R", 14 => "Bto");
        $arrayTamano = array(3 => "50", 0 => "20", 1 => "20", 2 => "200", 4 => "50", 5 => "50", 6 => "40", 7 => "40", 8 => "40", 9 => "40", 10 => "40", 11 => "40", 12 => "40", 13 => "40", 14 => "40");
        $arrayTipo = array(3 => "ro", 0 => "ro", 1 => "ro", 2 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "img", 8 => "img", 9 => "ro", 10 => "ro", 11 => "img", 12 => "img", 13 => "ro", 14 => "ro");
        $arrayCursor = array(3 => "default", 0 => "default", 1 => "default", 2 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "pointer", 8 => "pointer", 9 => "default", 10 => "pointer", 11 => "pointer", 12 => "pointer", 13 => "pointer", 14 => "pointer");
        $arrayHidden = array(3 => "false", 0 => "true", 1 => "true", 2 => "false", 4 => "true", 5 => "true", 6 => "true", 7 => "false", 8 => "false", 9 => "true", 10 => "false", 11 => "false", 12 => "false", 13 => "false", 14 => "false");
        $arrayAling = array(3 => "left", 0 => "left", 1 => "left", 2 => "left", 4 => "left", 5 => "left", 6 => "center", 7 => "center", 8 => "center", 9 => "center", 10 => "center", 11 => "center", 12 => "center", 13 => "center", 14 => "center");
        //return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor,$arrayHidden,$arrayAlineacion);
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    //
//       function AreporteDePuntoControlXExamen($datos) {
//        $oLLaboratorio = new LLaboratorio();
//        $o_TablaHtmlx = new tablaDHTMLX();
//
//        $arrayFilas = $oLLaboratorio->LreporteDePuntoControlXExamen($datos);
//
//        $arrayCabecera = array(3 => "Ord.", 0 => "idPuntoContro", 1 => "idPuntoControlExamenLab", 2 => "Nombre del Punto Control", 4 => "Sub.", 5 => "Baj.", 6 => "columna",7 => "Id Muestra",8 => "Id Recibir", 9 => "Muestra", 10 => "D", 11 => "R",12 => "E");
//        $arrayTamano = array(3 => "40", 0 => "20", 1 => "20", 2 => "198", 4 => "35", 5 => "35", 6 => "40", 7 => "30", 8 => "30", 9 => "52",10 => "30",11 => "30",12 => "30");
//        $arrayTipo = array(3 => "ro", 0 => "ro", 1 => "ro", 2 => "ro", 4 => "img", 5 => "img", 6 => "ro", 7 => "ro", 8 => "ro", 9 => "ro",10 => "img",11 => "ro",12 => "img");
//        $arrayCursor = array(3 => "default", 0 => "default", 1 => "default", 2 => "default", 4 => "pointer", 5 => "pointer", 6 => "default", 7 => "pointer", 8 => "pointer", 9 => "pointer",10 => "pointer",11 => "pointer", 12 => "pointer");
//        $arrayHidden = array(3 => "false", 0 => "true", 1 => "true", 2 => "false", 4 => "false", 5 => "false", 6 => "true", 7 => "false", 8 => "false", 9 => "false",10 => "false", 11 => "false",12 => "false");
//        $arrayAling = array(3 => "center", 0 => "left", 1 => "left", 2 => "left", 4 => "center", 5 => "center", 6 => "center", 7 => "center", 8 => "center", 9 => "center", 10 => "center",11 => "center", 12 => "center");
//
//        //return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor,$arrayHidden,$arrayAlineacion);
//        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
//    }
    /////////////////////////////////////////////////////////////////////////////////////////


    function AgregarNuevoPuntoControl($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayFilas = $oLLaboratorio->LmaximonivelPuntoControlExamenes($datos);
        require_once('../../../hospitalizacion/cvista/laboratorio/vAgregarPuntoControl.php');
    }

    function AreporteDePuntoControl($datos) {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = $oLLaboratorio->LreporteDePuntoControl($datos);
        $arrayCabecera = array(0 => "idPuntoContro", 1 => "Nombre Punto Control");
        $arrayTamano = array(0 => "20", 1 => "400");
        $arrayTipo = array(0 => "ro", 1 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default");
        $arrayHidden = array(0 => "false", 1 => "false");
        $arrayAling = array(0 => "left", 1 => "left");
        //return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor,$arrayHidden,$arrayAlineacion);
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function AguardarNuevoPuntoControl($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayFilas = $oLLaboratorio->LguardarNuevoPuntoControl($datos);

        return $arrayFilas;
    }

    // laboratorio del JCQA // 
    //07/07/2012
    //
//original de 17Julio2012
//
//    function amostrarExamenesLaboratorio() {
//        $oLLaboratorio = new LLaboratorio();
//        $o_TablaHtmlx = new tablaDHTMLX();
//
//        $arrayFilas = $oLLaboratorio->lmostrarExamenesLaboratorio();
//        $arrayCabecera = array(0 => "ID", 1 => "cod ser pro", 2 => "Nombre Examen Laboratorio", 3 => "IdTipoExamenLabo", 4 => "Tipo Examen Laboratorio",5 => "Descripcion Exa L");
//        $arrayTamano = array(0 => "45", 1 => "90", 2 => "*", 3 => "50", 4 => "*",5 => "*");
//        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro" );
//        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default");
//        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "true", 4 => "false",5 => "true");
//        $arrayAling = array(0 => "center", 1 => "left", 2 => "left", 3 => "center", 4 => "center",5 => "center");
//        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
//    }
//borrador de crear un combo en un grid
    function amostrarExamenesLaboratorio() {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = $oLLaboratorio->lmostrarExamenesLaboratorio();
        $arrayCabecera = array(0 => "Id", 1 => "Codigo", 2 => "Nombre Examen Laboratorio", 3 => "IdTipoExamenLabo", 4 => "Tipo Examen", 5 => "Descripcion Exa L", 6 => "");
        $arrayTamano = array(0 => "40", 1 => "70", 2 => "290", 3 => "50", 4 => "*", 5 => "*", 6 => "30");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ch");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false", 3 => "true", 4 => "false", 5 => "true", 6 => "true");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "left", 3 => "center", 4 => "center", 5 => "center", 6 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

//    creado por JCQA 20 Julio 2012
    function acargarTablaUnidadesxTipoxMaterialLaboratorio($parametros) {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = $oLLaboratorio->lcargarTablaUnidadesxTipoxMaterialLaboratorio($parametros);
        $arrayCabecera = array(0 => "ID Material", 1 => "Id UnidadMedida", 2 => "Nombre Material Laboratorio", 3 => "Id Tipo Material Labo", 4 => "Tipo Material Labo", 5 => "Url Imagen", 6 => " Unidad Medida", 7 => "Tipo Unidad Medida", 8 => "Id Tipo Unidad Medida");
        $arrayTamano = array(0 => "45", 1 => "90", 2 => "*", 3 => "50", 4 => "*", 5 => "*", 6 => "*", 7 => "*", 8 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "true", 3 => "true", 4 => "false", 5 => "true", 6 => "false", 7 => "false", 8 => "true");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "left", 3 => "center", 4 => "center", 5 => "center", 6 => "center", 7 => "center", 8 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function amostrarMaterialesDeLaboratorio() {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = $oLLaboratorio->lmostrarMaterialesDeLaboratorio();
        $arrayCabecera = array(0 => "ID", 1 => "cod ser pro", 2 => "Nombre Material Laboratorio", 3 => "IdTipoMaterialLabo", 4 => "Tipo Material Laboratorio", 5 => "Descripcion Exa L");
        $arrayTamano = array(0 => "45", 1 => "90", 2 => "*", 3 => "50", 4 => "*", 5 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "true");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "left", 3 => "center", 4 => "center", 5 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

//29 enero 2013
    function agetTratamientoPaciente2($datos) {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = $oLLaboratorio->lgetTratamientoPaciente2($datos);
        $arrayCabecera = array(0 => "Receta", 1 => "Fecha", 2 => "Medico", 3 => "CodArea", 4 => "Servicio", 5 => "Fecha", 6 => "TipoTratamiento", 7 => "CodTratamiento", 8 => "NombreTratamiento", 9 => "idTratamiento", 10 => "...");
        $arrayTamano = array(0 => "45", 1 => "50", 2 => "*", 3 => "50", 4 => "*", 5 => "*", 6 => "90", 7 => "*", 8 => "*", 9 => "*", 10 => "30");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro", 9 => "ro", 10 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default", 10 => "center");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "true", 4 => "false", 5 => "true", 6 => "true", 7 => "true", 8 => "false", 9 => "true", 10 => "false");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "left", 3 => "center", 4 => "center", 5 => "center", 6 => "left", 7 => "center", 8 => "center", 9 => "center", 10 => "default");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function agetTratamientoPaciente($datos) {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = $oLLaboratorio->lgetTratamientoPaciente($datos);
        $arrayCabecera = array(0 => "Receta", 1 => "Fecha", 2 => "Medico", 3 => "CodArea", 4 => "Servicio", 5 => "Fecha", 6 => "TipoTratamiento", 7 => "CodTratamiento", 8 => "NombreTratamiento", 9 => "idTratamiento", 10 => "...");
        $arrayTamano = array(0 => "45", 1 => "50", 2 => "*", 3 => "50", 4 => "*", 5 => "*", 6 => "90", 7 => "*", 8 => "*", 9 => "*", 10 => "30");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro", 9 => "ro", 10 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default", 10 => "center");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "true", 4 => "true", 5 => "true", 6 => "true", 7 => "true", 8 => "false", 9 => "true", 10 => "false");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "left", 3 => "center", 4 => "center", 5 => "center", 6 => "left", 7 => "center", 8 => "center", 9 => "center", 10 => "default");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function agetVinculadosTratamientoPaciente($datos) {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = $oLLaboratorio->lgetVinculadosTratamientoPaciente($datos);
        $arrayCabecera = array(0 => "CodSerPro", 1 => "Nombre", 2 => "Receta", 3 => "Fecha", 4 => "Tratamiento", 5 => "Cod_Enlace", 6 => "...", 7 => "d");  //7 CAMPOS MAX-6
        $arrayTamano = array(0 => "70", 1 => "285", 2 => "40", 3 => "50", 4 => "50", 5 => "50", 6 => "30", 7 => "40");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "img", 7 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "true", 4 => "true", 5 => "true", 6 => "false", 7 => "true");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "left", 3 => "center", 4 => "center", 5 => "center", 6 => "center", 7 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function acargarTablaVincularRecetasConTratamientos($datos) {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = $oLLaboratorio->lcargarTablaVincularRecetasConTratamientos($datos);
        $arrayCabecera = array(0 => "Receta", 1 => "Fecha", 2 => "Medico", 3 => "CodArea", 4 => "Servicio", 5 => "Fecha", 6 => "TipoTratamiento", 7 => "CodTratamiento", 8 => "NombreTratamiento", 9 => "idTratamiento", 10 => "...");
        $arrayTamano = array(0 => "45", 1 => "50", 2 => "*", 3 => "50", 4 => "*", 5 => "*", 6 => "90", 7 => "*", 8 => "*", 9 => "*", 10 => "30");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro", 9 => "ro", 10 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default", 10 => "center");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "true", 4 => "true", 5 => "true", 6 => "true", 7 => "true", 8 => "false", 9 => "true", 10 => "false");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "left", 3 => "center", 4 => "center", 5 => "center", 6 => "left", 7 => "center", 8 => "center", 9 => "center", 10 => "default");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

//        function amostrarExamenesLaboratorio() {
//        $oLLaboratorio = new LLaboratorio();
//        $o_TablaHtmlx = new tablaDHTMLX();
//
//        $arrayFilas = $oLLaboratorio->lmostrarExamenesLaboratorio();
//        $arrayCabecera = array(0 => "ID", 1 => "cod ser pro", 2 => "Nombre Examen Laboratorio", 3 => "Editar", 4 => " Eliminar",5 => " ID TIPO",6 => " Eliminar");
//        $arrayTamano = array(0 => "45", 1 => "90", 2 => "*", 3 => "50", 4 => "50");
//        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "img", 4 => "img");
//        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "pointer", 4 => "pointer");
//        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "true", 4 => "true");
//        $arrayAling = array(0 => "center", 1 => "left", 2 => "left", 3 => "center", 4 => "center");
//        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
//    }

    public function aActualizarDetalleExamenLabo($parametros) {
        $oLLaboratorio = new LLaboratorio();
        $respuesta = $oLLaboratorio->lActualizarDetalleExamenLabo($parametros);
        return $respuesta;
    }

    function aListarTiposAfiliacionExamenLaboratorio() {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = $oLLaboratorio->lListarTiposAfiliacionExamenLaboratorio();
        $arrayCabecera = array(0 => "Id", 1 => "Afiliación", 2 => "Precio");
        $arrayTamano = array(0 => "35", 1 => "*", 2 => "80");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function aprecioExamenesxAfiliacion($parametros) {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = $oLLaboratorio->lprecioExamenesxAfiliacion($parametros);
        $arrayCabecera = array(0 => "Id", 1 => "Afiliación", 2 => "Campo3", 3 => "Precio");
        $arrayTamano = array(0 => "35", 1 => "*", 2 => "220", 3 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "true", 3 => "false");
        $arrayAling = array(0 => "center", 1 => "left", 2 => "left", 3 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function AsubirBajarSecuenciaPuntoControl($datos) {

        $oLLaboratorio = new LLaboratorio();
        $arrayFilas = $oLLaboratorio->LsubirBajarSecuenciaPuntoControl($datos);

        return $arrayFilas;
    }

    function aEliminarPerfilesExamenes($parametros) {
        $oLLaboratorio = new LLaboratorio();
        $respuesta = $oLLaboratorio->lEliminarPerfilesExamenes($parametros);
        $resp = "|";
        if ($respuesta)
            $resp = $respuesta[0][0];
        return $resp;
    }

    function aAsignarExamenAPerfil($parametros) {
        $oLLaboratorio = new LLaboratorio();
        $respuesta = $oLLaboratorio->lAsignarExamenAPerfil($parametros);
        $resp = "|";
        if ($respuesta)
            $resp = $respuesta[0][0];
        return $resp;
    }

    /// lobo 12-07-2012 laboratorio

    function AgrupoDePuntoControl($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayTiposDatos = $oLLaboratorio->LtipoDatos();
        $arrayTipoUnidadDeMedida = $oLLaboratorio->LtipoUnidadDeMedida();

        $arrayFilas = $oLLaboratorio->LgrupoDePuntoControl($datos); // grupo por cada punto Control
        $columnaGrupo = count($arrayFilas); // cuando grupo se forma al seleccionar el punto de control de la tbla
        foreach ($arrayFilas as $m => $value) {
            $arrayDatos = $oLLaboratorio->LdatosPuntoControl($value[0]); // nsmDatosPuntoControl
            $columnaDatosDelGrupo = count($arrayDatos); //cantida de datos por grupo 

            foreach ($arrayDatos as $b => $valueb) {
                $arrayDatosRango = $oLLaboratorio->LdatosRangos($valueb[0]); // nsmRangos
                array_push($arrayDatos[$b], $arrayDatosRango);
            }
            array_push($arrayFilas[$m], $arrayDatos);
            array_push($arrayFilas[$m], $columnaDatosDelGrupo);
        }
        ///  presentar en desarrollo
        $arrayFilasProduccion = $oLLaboratorio->LgrupoDePuntoControlProduccion($datos); // grupo por cada punto Control Produccion
//        $columnaGrupoPruduccion = count($arrayFilasProduccion); // cuando grupo se forma al seleccionar el punto de control de la tbla

        foreach ($arrayFilasProduccion as $m => $valuem) {
            $arrayDatosProduccion = $oLLaboratorio->LdatosPuntoControlProduccion($valuem[0]); // nsmDatosPuntoControl
//            $columnaDatosDelGrupo = count($arrayDatos); //cantida de datos por grupo 
            foreach ($arrayDatosProduccion as $b => $valueb) {
                $arrayDatosRango = $oLLaboratorio->LdatosRangosProduccion($valueb[0]); // nsmRangos
                array_push($arrayDatosProduccion[$b], $arrayDatosRango);
            }
            array_push($arrayFilasProduccion[$m], $arrayDatosProduccion);
            array_push($arrayFilasProduccion[$m], $columnaDatosDelGrupo);
        }

        require_once('../../../hospitalizacion/cvista/laboratorio/vistaTipoDatosExamenes.php');
    }

    /// lobo 12-07-2012 laboratorio
    function ApopapParaCrearNuevoGrupo() {
        $oLLaboratorio = new LLaboratorio();
        $arrayFilas = $oLLaboratorio->LEstadoVersicion();
        require_once('../../../hospitalizacion/cvista/laboratorio/vistacrearNuevoGrupo.php');
    }

    // lobo 12-07-2012 laboratorio 
    function AgregarNuevoGrupo($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayFilas = $oLLaboratorio->LagregarNuevoGrupo($datos);
    }

    // lobo 12-07-2012 laboratorio 
    function AguardarModificadoGrupoDatos($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayFilas = $oLLaboratorio->LguardarModificadoGrupoDatos($datos);
    }

    // lobo 13-07-2012 laboratorio 
    function AeliminarGrupoDatos($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayFilas = $oLLaboratorio->LeliminarGrupoDatos($datos);
    }

    // lobo 13-07-2012 laboratorio 
    function AcargarComboUnidadMedida($datos) {
        $oLLaboratorio = new LLaboratorio();

        $arrayUnidadDeMedida = $oLLaboratorio->LcargarComboUnidadMedida($datos);
        $cadena = '<select name="cboUnidadDeMedidax' . $datos["fila"] . '" id="cboUnidadDeMedidax' . $datos["fila"] . '">';
        foreach ($arrayUnidadDeMedida as $n => $valuen) {
            $cadena .= '<option value="' . $valuen[0] . '">' . $valuen[1] . '</option>';
        }
        $cadena .= '</select>';

        return $cadena;
    }

    //JCQA 20julio2012 3pm

    function AcargarComboUnidadMedidaPopudML($datos) {
        $oLLaboratorio = new LLaboratorio();

        $arrayUnidadDeMedida = $oLLaboratorio->LcargarComboUnidadMedidaPopudML($datos);

        $cadena = '<select name="cboUnidadDeMedida" id="cboUnidadDeMedida"  style="width:150px; font-size:12px">';

        foreach ($arrayUnidadDeMedida as $n => $valuen) {
            $cadena .= '<option value="' . $valuen[0] . '">' . $valuen[1] . '</option>';
        }
        $cadena .= '</select>';

        return $cadena;
    }

    //JCQA 10 Agosto 2012 3pm  COMBO TIPO UNIDAD MEDIDA -- MATERIAL LABORATORIO

    function AcargarComboTipoUnidadMedidaMaterialSeleccionado($datos) {
        $oLLaboratorio = new LLaboratorio();

        $arrayTipoUnidadMedida = $oLLaboratorio->LcargarComboTipoUnidadMedidaMaterialSeleccionado($datos);
        $arrayTipoUnidadMedida = is_array($arrayTipoUnidadMedida) ? $arrayTipoUnidadMedida : array();

        $combo = '<select name="cboTipoUnidadMedidaDisponibles" onchange="cargarComboUnidadMedidaMaterialSeleccionado();" id="cboTipoUnidadMedidaDisponibles"  style="width:150px; font-size:12px" >';
        $combo.='<option value="x" selected="selected" style="background-color: #FFFFFF">Seleccionar</option>';
        foreach ($arrayTipoUnidadMedida as $n => $valuen) {
            $combo .= '<option value="' . $valuen[1] . '">' . htmlentities($valuen[0]) . '</option>';
        }
        $combo .= '</select>';

        return $combo;
    }

    //JCQA 16 Agosto 2012 COMBO UNIDAD MEDIDA -- MATERIAL LABORATORIO

    function AcargarComboUnidadMedidaMaterialSeleccionado($datos) {
        $oLLaboratorio = new LLaboratorio();

        $arrayTipoUnidadMedida = $oLLaboratorio->LcargarComboUnidadMedidaMaterialSeleccionado($datos);
        $arrayTipoUnidadMedida = is_array($arrayTipoUnidadMedida) ? $arrayTipoUnidadMedida : array();

        $combo = '<select name="cboUnidadMedidaDisponibles" onchange="" id="cboUnidadMedidaDisponibles"  style="width:150px; font-size:12px" >';
        $combo.='<option value="x" selected="selected" style="background-color: #FFFFFF">Seleccionar</option>';
        foreach ($arrayTipoUnidadMedida as $n => $valuen) {
            $combo .= '<option value="' . $valuen[0] . '">' . htmlentities($valuen[1]) . '</option>';
        }
        $combo .= '</select>';

        return $combo;
    }

    //JCQA 28 Septiembre 2012 COMBO UNIDAD MEDIDA -- MATERIAL LABORATORIO  

    function cargarComboUnidadMedidaMaterialSeleccionado_detalleMaterialesSeleccionados($datos) {
        $oLLaboratorio = new LLaboratorio();

        $arrayTipoUnidadMedida = $oLLaboratorio->LcargarComboUnidadMedidaMaterialSeleccionado($datos);
        $arrayTipoUnidadMedida = is_array($arrayTipoUnidadMedida) ? $arrayTipoUnidadMedida : array();

        $combo = '<select id="cboUnidadMedidaDisponibles' . trim($datos["idUnidadMedidaExamenLabotorio"]) . '" onchange="" style="width:150px; font-size:12px" >';
        $combo.='<option value="x" selected="selected" style="background-color: #FFFFFF">Seleccionar</option>';
        foreach ($arrayTipoUnidadMedida as $n => $valuen) {
            $combo .= '<option value="' . $valuen[0] . '">' . htmlentities($valuen[1]) . '</option>';
        }
        $combo .= '</select>';

        return $combo;
    }

    //JCQA 14 Agosto 2012 3pm

    function AcargarComboUnidadMedidaMuestraSeleccionado($datos) {
        $oLLaboratorio = new LLaboratorio();

        $arrayTipoUnidadMedida = $oLLaboratorio->LcargarComboUnidadMedidaMuestraSeleccionado($datos);
        $arrayTipoUnidadMedida = is_array($arrayTipoUnidadMedida) ? $arrayTipoUnidadMedida : array();

        $combo = '<select name="cboUnidadMedidaMuestraSeleccionada" onchange="" id="cboUnidadMedidaMuestraSeleccionada"  style="width:150px; font-size:12px" >';
        $combo.='<option value="x" selected="selected" style="background-color: #FFFFFF">Seleccionar</option>';
        foreach ($arrayTipoUnidadMedida as $n => $valuen) {
            $combo .= '<option value="' . $valuen[0] . '">' . htmlentities($valuen[1]) . '</option>';
        }
        $combo .= '</select>';

        return $combo;
    }

    //JCQA 01 octubre  2012

    function AcargarComboUnidadMedidaMuestraSeleccionadodetalleMuestraSeleccionados($datos) {
        $oLLaboratorio = new LLaboratorio();

        $arrayTipoUnidadMedida = $oLLaboratorio->LcargarComboUnidadMedidaMuestraSeleccionado($datos);
        $arrayTipoUnidadMedida = is_array($arrayTipoUnidadMedida) ? $arrayTipoUnidadMedida : array();

        $combo = '<select onchange="" id="cboUnidadMedidaMuestraSeleccionada' . trim($datos["idMuestraPuntoControlLaboratorio"]) . '" style="width:150px; font-size:12px" >';
        $combo.='<option value="x" selected="selected" style="background-color: #FFFFFF">Seleccionar</option>';
        foreach ($arrayTipoUnidadMedida as $n => $valuen) {
            $combo .= '<option value="' . $valuen[0] . '">' . htmlentities($valuen[1]) . '</option>';
        }
        $combo .= '</select>';

        return $combo;
    }

    //JCQA 14 Agosto 2012 3pm

    function AcargarComboTipoUnidadMedidaMuestraSeleccionado() {
        $oLLaboratorio = new LLaboratorio();

        $arrayTipoUnidadMedida = $oLLaboratorio->LcargarComboTipoUnidadMedidaMuestraSeleccionado();
        $arrayTipoUnidadMedida = is_array($arrayTipoUnidadMedida) ? $arrayTipoUnidadMedida : array();

        $combo = '<select name="cboTipoUnidadMedidaMuestraSeleccionada" onchange="cargarComboUnidadMedidaMuestraSeleccionado();" id="cboTipoUnidadMedidaMuestraSeleccionada"  style="width:150px; font-size:12px" >';
        $combo.='<option value="x" selected="selected" style="background-color: #FFFFFF">Seleccionar</option>';
        foreach ($arrayTipoUnidadMedida as $n => $valuen) {
            $combo .= '<option value="' . $valuen[0] . '">' . htmlentities($valuen[1]) . '</option>';
        }
        $combo .= '</select>';

        return $combo;
    }

    public function aagregarNuevoUnidadalMaterialLaboratorioPoppud($datos) {
        $oLLaboratorio = new LLaboratorio();

        $respuesta = $oLLaboratorio->lagregarNuevoUnidadalMaterialLaboratorioPoppud($datos);
        return $respuesta;
    }

    //  creado por JCQA Lunes 30 Julio, 2012 


    public function aGuardarCambiosDetalleMaterialesdeLaboratorio($datos) {
        $oLLaboratorio = new LLaboratorio();

        $respuesta = $oLLaboratorio->lGuardarCambiosDetalleMaterialesdeLaboratorio($datos);
        return $respuesta;
    }

    //  creado por JCQA 28 Septiembre 2012 

    public function aActualizarItemMaterialesAlmacenados($datos) {
        $oLLaboratorio = new LLaboratorio();

        $respuesta = $oLLaboratorio->lActualizarItemMaterialesAlmacenados($datos);
        return $respuesta;
    }

    //  creado por JCQA 01 octubre 2012 

    public function aActualizarItemMuestraAlmacenados($datos) {
        $oLLaboratorio = new LLaboratorio();

        $respuesta = $oLLaboratorio->lActualizarItemMuestraAlmacenados($datos);
        return $respuesta;
    }

    //  creado por JCQA 03 octubre 2012 

    public function aEliminarItemMuestraAlmacenados($datos) {
        $oLLaboratorio = new LLaboratorio();

        $respuesta = $oLLaboratorio->LEliminarItemMuestraAlmacenados($datos);
        return $respuesta;
    }

    //  creado por JCQA 03 octubre 2012 

    public function aEliminarItemMaterialesAlmacenados($datos) {
        $oLLaboratorio = new LLaboratorio();

        $respuesta = $oLLaboratorio->lEliminarItemMaterialesAlmacenados($datos);
        return $respuesta;
    }

    //  creado por JCQA Miercoles 19 Septiembre 2012 


    public function apresentarfotoDeMaterialLaboratorio($datos) {
        $oLLaboratorio = new LLaboratorio();

        $respuesta = $oLLaboratorio->lpresentarfotoDeMaterialLaboratorio($datos);
        return $respuesta;
    }

    //  creado por JCQA Martes 7 Agosto, 2012 

    public function AseleccionandoMuestraxPuntoControl($datos) {
        $oLLaboratorio = new LLaboratorio();

        $respuesta = $oLLaboratorio->LseleccionandoMuestraxPuntoControl($datos);
        return $respuesta;
    }

    //  creado por JCQA Martes 8 Agosto, 2012 

    public function AseleccionandoPuntoControlRecibir($datos) {
        $oLLaboratorio = new LLaboratorio();

        $respuesta = $oLLaboratorio->LseleccionandoPuntoControlRecibir($datos);
        return $respuesta;
    }

    //  creado por JCQA Lunes 1 Agosto, 2012 

    public function aGuardarCambiosDetalleMaterialesdeLaboratorio_Nuevo($datos) {
        $oLLaboratorio = new LLaboratorio();

        $respuesta = $oLLaboratorio->lGuardarCambiosDetalleMaterialesdeLaboratorio_Nuevo($datos);
        return $respuesta;
    }

    //  creado por JCQA Lunes 18 Septiembre del 2012 

    public function aGuardarMuestraxPuntoControlxExamenLaboratorio($datos) {
        $oLLaboratorio = new LLaboratorio();

        $respuesta = $oLLaboratorio->lGuardarMuestraxPuntoControlxExamenLaboratorio($datos);
        return $respuesta;
    }

    //  creado por JCQA Lunes 19 Septiembre del 2012 

    public function aGuardarMaterialxPuntoControlxExamenLaboratorio($datos) {
        $oLLaboratorio = new LLaboratorio();

        $respuesta = $oLLaboratorio->lGuardarMaterialxPuntoControlxExamenLaboratorio($datos);
        return $respuesta;
    }

    //  creado por JCQA Lunes 30 Julio, 2012 
    public function amostrarImagenMaterialLaboratorioTraerData($datos) {
        $oLLaboratorio = new LLaboratorio();

        $respuesta = $oLLaboratorio->lmostrarImagenMaterialLaboratorioTraerData($datos);
        return $respuesta;
    }

    //JCDB 16/07/2012
    function aAsignarUsuarioXPuntoControl($parametros) {
        $oLLaboratorio = new LLaboratorio();
        $respuesta = $oLLaboratorio->lAsignarUsuarioXPuntoControl($parametros);
        $resp = "|";
        if ($respuesta)
            $resp = $respuesta[0][0];
        return $resp;
    }

    public function aPopudMantenimientoExamenesEditarEliminar($datos) {
        $oLLaboratorio = new LLaboratorio();
        require_once("../../cvista/laboratorio/PopudMantenimientoExamenesEditarEliminar.php");
    }

    // lobo 13-07-2012 laboratorio 
    function AguardarDatosPuntoControl($datos) {
        $oLLaboratorio = new LLaboratorio();

        $cadena = str_replace("00100101", "%", $datos["filaexamen"]); // $cadena -> "El saludo es adios" 
        $arrayfila = $oLLaboratorio->LguardarDatosPuntoControl($datos, $cadena);
    }

//        $cadena = '<select name="cboTipoMaterialLabo' . $datos["fila"] . '" id="cboUnidadDeMedida' . $datos["fila"] . '">';
//        
//        foreach ($arrayUnidadDeMedida as $n => $valuen) {
//            $cadena .= '<option value="' . $valuen[0] . '">' . $valuen[1] . '</option>';
//        }
//        $cadena .= '</select>';
//
//        return $cadena;
//        print_r($arrayUnidadDeMedida);
//    creado por JCQA 20deJulio2012
    public function aPopudAgregarUnidadMedidaxMaterialLaboratorio() {

        $oLLaboratorio = new LLaboratorio();
        $ListaUnidadDeMedida = $oLLaboratorio->LlistarUnidadMedidaxMaterialLaboratorio();
        require_once("../../cvista/laboratorio/PopudAgregarUnidadMedidaxMaterialLabo.php");
    }

    public function AadjuntarOtroFilejc($idMaterialLaboratorio) {
        $oLLaboratorio = new LLaboratorio();
        $idMaterialLaboratorio = $idMaterialLaboratorio;
        $resultado = $oLLaboratorio->LpreMostrarCVjc($idMaterialLaboratorio);

        $idMaterialLabo = $resultado[0][0];             //:     2
        $codSerPro = $resultado[0][1];                  //:     PRD0000485
        $idTipoMaterialLabo = $resultado[0][2];         //:     2
        $nombreTipoMaterialLabo = $resultado[0][3];     //:     RECIPIENTE
        $idArchivosMaterialLabo = $resultado[0][4];     //:     11
        $iVersionArchivo = $resultado[0][5];            //:     11
        $rutaCompletaArchivo = $resultado[0][6];        //:      ../../../../carpetaDocumentos/2_PRD0000485_V11.jpg
        $rutaSubida = $resultado[0][7];                 //:      ../../../../carpetaDocumentos/   

        require_once("../../cvista/laboratorio/MostrarCVJC.php");
    }

//      creado por JCQA 10 de Agosto 2012

    public function AdetalleMuestrayMaterialesEnPuntoControlExamenLaboratorio() {
        $oLLaboratorio = new LLaboratorio();

        require_once("../../cvista/laboratorio/MuestrasyMaterialesxPuntodeControl.php");
    }

    public function guardarAtributoDocumentoEmpledojc($idMaterialLaboratorio, $nomfileupload) {
        $oLLaboratorio = new LLaboratorio();
//        $datosDocEmp = $o_LRrhh->preMostrarCV($iddocEmpleado);
        $respuesta = $oLLaboratorio->guardarAtributoDocumentoEmpledojc($idMaterialLaboratorio, $nomfileupload);
        return $respuesta;
    }

    public function aPopudMuestrasPorExamen($datos) {
        $oLLaboratorio = new LLaboratorio();
        require_once("../../cvista/laboratorio/PopudMuestrasxExamen.php");
    }

    public function aPopudSeleccionarRecipiente($datos) {
        $oLLaboratorio = new LLaboratorio();
        require_once("../../cvista/laboratorio/PopudSeleccionarRecipiente.php");
    }

    public function aPopudMantenimientoRecipiente($datos) {
        $oLLaboratorio = new LLaboratorio();
        require_once("../../cvista/laboratorio/PopudMantenimientoRecipiente.php");
    }

// lobo 13-07-2012 laboratorio 
    public function ApopapEditarRango($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayCombo = $oLLaboratorio->LeditarCombo($datos);

        require_once("../../cvista/laboratorio/vistaPopapRango.php");
    }

// lobo 13-07-2012 laboratorio 
    public function AeliminarRango($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayfila = $oLLaboratorio->LeliminarRango($datos);
    }

// lobo 13-07-2012 laboratorio 
    public function AmodificarRangos($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayRango = $oLLaboratorio->LmodificarRangos($datos);
    }

// lobo 13-07-2012 laboratorio 
    public function AcargarComboEditarUnidadMedida($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayUnidadMedida = $oLLaboratorio->LcargarComboEditarUnidadMedida($datos);

        $cadena = '<select name="cboUnidadDeMedidaEditar' . $datos["filak"] . $datos["filay"] . '" id="cboUnidadDeMedidaEditar' . $datos["filak"] . $datos["filay"] . '">';
        foreach ($arrayUnidadMedida as $n => $valuen) {
            $cadena .= '<option value="' . $valuen[0] . '">' . $valuen[1] . '</option>';
        }
        $cadena .= '</select>';

        return $cadena;
    }

// lobo 13-07-2012 laboratorio 
    public function AmodificarDatosPuntoControl($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayUnidadMedida = $oLLaboratorio->LEliminarRangoPorDatosPuntoControl($datos["idDatosPuntoControl"]);
        $arrayUnidadMedidaXX = $oLLaboratorio->LmodificarDatosPuntoControl($datos);
    }

// lobo 13-07-2012 laboratorio 
    public function PopaEditarCombo($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayIten = $oLLaboratorio->LeditarCombo($datos);
        require_once("../../cvista/laboratorio/vistaCrearCombo.php");
    }

// lobo 13-07-2012 laboratorio 
    public function AguardarItemCombo($datos) {//$datos["idDatosPuntoControl"]
        $oLLaboratorio = new LLaboratorio();
        $arrayItenww = $oLLaboratorio->LguardarItemCombo($datos);
    }

// lobo 13-07-2012 laboratorio 
    public function AmodificarItemCombo($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayItemmodi = $oLLaboratorio->LmodificarItemCombo($datos);
    }

// lobo 13-07-2012 laboratorio 
    public function AeliminarDatosCombos($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayItemmodi = $oLLaboratorio->LeliminarDatosCombos($datos);
    }

// lobo 13-07-2012 laboratorio 
    public function AocultarBotonNueno($datos) {

        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = $oLLaboratorio->LeditarCombo($datos);
        $arrayCabecera = array(0 => "iIdDatosPuntoControl", 1 => "iIdCombo", 2 => "iIdDatosCombos", 3 => "vItem", 4 => "iOrden", 5 => "maxOrden", 6 => "Editar", 7 => "Eliminar", 8 => "Arriba", 9 => "Abajo");
        $arrayTamano = array(0 => "50", 1 => "50", 2 => "50", 3 => "80", 4 => "50", 5 => "50", 6 => "80", 7 => "80", 8 => "80", 9 => "80");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "img", 7 => "img", 8 => "img", 9 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "true", 3 => "false", 4 => "false", 5 => "true", 6 => "false", 7 => "false", 8 => "false", 9 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "center", 7 => "center", 8 => "center", 9 => "center");
//return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor,$arrayHidden,$arrayAlineacion);
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

// lobo 13-07-2012 laboratorio 
    public function AsubirOrdenItem($datos) {

        $oLLaboratorio = new LLaboratorio();
        $arrayItemmodi = $oLLaboratorio->LsubirOrdenItem($datos);
    }

// lobo 13-07-2012 laboratorio 
    public function AbajarOrdenItem($datos) {

        $oLLaboratorio = new LLaboratorio();
        $arrayItemmodi = $oLLaboratorio->LbajarOrdenItem($datos);
    }

// lobo 13-07-2012 laboratorio 
    public function ApopaAgregarRango($datos) {
        $oLLaboratorio = new LLaboratorio();
        $arrayComboRango = $oLLaboratorio->LCargaCombo($datos);
        require_once("../../cvista/laboratorio/vistaAgregarOtroRango.php");
    }

// lobo 13-07-2012 laboratorio 
    public function AguardarRangos($datos) {
        $oLLaboratorio = new LLaboratorio();
        $array = $oLLaboratorio->LguardarRangos($datos);
    }

// lobo 13-07-2012 laboratorio 
    public function AcargarItemDelCombo($datos) {

        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = $oLLaboratorio->LcargarItemDelCombo($datos);
        $arrayCabecera = array(0 => "iIdDatosPuntoControl", 1 => "iIdCombo", 2 => "iIdDatosCombos", 3 => "vItem", 4 => "iOrden", 5 => "maxOrden", 6 => "Editar", 7 => "Eliminar", 8 => "Arriba", 9 => "Abajo");
        $arrayTamano = array(0 => "50", 1 => "50", 2 => "50", 3 => "80", 4 => "50", 5 => "50", 6 => "80", 7 => "80", 8 => "80", 9 => "80");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "img", 7 => "img", 8 => "img", 9 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false", 6 => "false", 7 => "false", 8 => "false", 9 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "center", 7 => "center", 8 => "center", 9 => "center");
//return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor,$arrayHidden,$arrayAlineacion);
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

// lobo 13-07-2012 laboratorio 
    public function AmodificarDatosPuntoControlSoloNombre($datos) {
        $oLLaboratorio = new LLaboratorio();
        $array = $oLLaboratorio->LmodificarDatosPuntoControlSoloNombre($datos);

        return $array;
    }

// lobo 13-07-2012 laboratorio 
    public function EliminarDatosPuntoControl($datos) {
        $oLLaboratorio = new LLaboratorio();
        $array = $oLLaboratorio->LEliminarDatosPuntoControl($datos);

        return $array;
    }

// lobo 13-07-2012 laboratorio 
    public function AsubirDatosPuntoControl($datos) {
        $oLLaboratorio = new LLaboratorio();
        $array = $oLLaboratorio->LsubirDatosPuntoControl($datos);

        return $array;
    }

// lobo 13-07-2012 laboratorio 
    public function AbajarDatosPuntoControl($datos) {
        $oLLaboratorio = new LLaboratorio();
        $array = $oLLaboratorio->LbajarDatosPuntoControl($datos);

        return $array;
    }

// lobo 13-07-2012 laboratorio 
    public function AeliminarPuntosControl($datos) {
        $oLLaboratorio = new LLaboratorio();
        $array = $oLLaboratorio->LeliminarPuntosControl($datos);

        return $array[0][0];
    }

// lobo 13-07-2012 laboratorio 
    public function AconfirmarAproduccion($datos) {
        $oLLaboratorio = new LLaboratorio();
        $array = $oLLaboratorio->LconfirmarAproduccion($datos);
        if ($array[0][0] == 1) {
            $a = 'Exiten Combos que no Tienen Datos, Verifique, No se puede Confirmar';
        } else {
            $a = '0';
        }
        return $a;
    }

//corregido para llenar el combo jcqa

    function AmantenimientoExamenes() {
        require_once '../../cvista/laboratorio/vMantenimientoExamen.php';
    }

    function mantenimientoExamenes() {
//        $oLRrhh = new LRrhh();
        $oLLaboratorio = new LLaboratorio();

        $opcionesHTMLTipoExamenLaboratorio = $oLLaboratorio->LlistarTiposdeExamenesLaboratorio();

//print_r($datos);
//$iCodEmpCoordinador = $_SESSION['iCodigoEmpleado'];
// $arrayNombreCoordinador = $oLRrhh->nombreCoordinador($iCodEmpCoordinador);
//        $arraySede = $oLRrhh->ListaSede($iCodEmpCoordinador);
//listarAllSedesCom
//$arrayTotalSedes = $oLRrhh->ListaTodasSede();
//          $arraySede = $oLRrhh->ListaTodasSede();
//carga la pag.nueva para Menu CordinadoresTurnos
        require_once '../../cvista/laboratorio/vMantenimientoExamen.php';
    }

    function AMaterialesdeLaboratorio() {
//        $oLRrhh = new LRrhh();
        $oLLaboratorio = new LLaboratorio();
// llenar el combo de tipos de material
        $opcionesHTMLTipoMaterialesLaboratorio = $oLLaboratorio->LlistarTiposdeMaterialesLabo();


// $arrayNombreCoordinador = $oLRrhh->nombreCoordinador($iCodEmpCoordinador);
//$opcionesHTMLTipoExamenLaboratorio = $oLLaboratorio->LMaterialesdeLaboratorio();
//        print_r($opcionesHTMLTipoMaterialesLaboratorio);
//$iCodEmpCoordinador = $_SESSION['iCodigoEmpleado'];
// $arrayNombreCoordinador = $oLRrhh->nombreCoordinador($iCodEmpCoordinador);
//        $arraySede = $oLRrhh->ListaSede($iCodEmpCoordinador);
//listarAllSedesCom
//$arrayTotalSedes = $oLRrhh->ListaTodasSede();
//          $arraySede = $oLRrhh->ListaTodasSede();
//carga la pag.nueva para Menu CordinadoresTurnos

        require_once '../../cvista/laboratorio/vMaterialesDeLaboratorio.php';
    }

    public function avbuscarMaterialesxPuntoControl() {
        $oLLaboratorio = new LLaboratorio();

//$comboTipoDocumentos = $o_LPersona->comboTipoDocumento('1');
        require_once("../../cvista/laboratorio/buscarMaterialesxPuntodeControl.php");
    }

//creado por jcqa 10 Agosto 2012

    public function avbuscarMaterialesxPuntoControl_2() {
        $oLLaboratorio = new LLaboratorio();

//$comboTipoDocumentos = $o_LPersona->comboTipoDocumento('1');
        require_once("../../cvista/laboratorio/buscarMaterialesxPuntodeControl_2.php");
    }

//creado por jcqa 14 Agosto 2012

    public function avbuscarMaterialesxPuntoControl_3() {
        $oLLaboratorio = new LLaboratorio();

//$comboTipoDocumentos = $o_LPersona->comboTipoDocumento('1');
        require_once("../../cvista/laboratorio/buscarMaterialesxPuntodeControl_3.php");
    }

    public function abuscarMaterialesLaboratorioPopap($datos) {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLLaboratorio->lbuscarMaterialesLaboratorioPopap($datos);
//print("inicio");
//        print($arrayFilas);

        $arrayFilas = is_array($arrayFilas) ? $arrayFilas : array();

        $arrayCabecera = array("0" => "Cod Ser Pro", "1" => "Nombre Material");
        $arrayTamano = array("0" => "70", "1" => "*");
        $arrayTipo = array("0" => "ro", "1" => "ro");
        $arrayCursor = array("0" => "default", "1" => "default");
        $arrayHidden = array("0" => "false", "1" => "false");
        $arrayAling = array("0" => "center", "1" => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

//creado x JCQA 10 Agosto 2012

    public function abuscarMaterialesLaboratorioPopap_2($datos) {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLLaboratorio->lbuscarMaterialesLaboratorioPopap_2($datos);
        $arrayFilas = is_array($arrayFilas) ? $arrayFilas : array();

        $arrayCabecera = array("0" => "Id Material Laboratorio", "1" => "Cod Ser Pro", "2" => "Nombre Material",);
        $arrayTamano = array("0" => "70", "1" => "70", "2" => "*");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro");
        $arrayCursor = array("0" => "default", "1" => "default", "2" => "default");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false");
        $arrayAling = array("0" => "center", "1" => "center", "2" => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

//creado x JCQA 14 Agosto 2012

    public function abuscarMaterialesLaboratorioPopap_3($datos) {
        $oLLaboratorio = new LLaboratorio();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLLaboratorio->lbuscarMaterialesLaboratorioPopap_3($datos);
        $arrayFilas = is_array($arrayFilas) ? $arrayFilas : array();

        $arrayCabecera = array("0" => "Id Muestra", "1" => "Cod Ser Pro", "2" => "Nombre Material",);
        $arrayTamano = array("0" => "x", "1" => "x", "2" => "*");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro");
        $arrayCursor = array("0" => "default", "1" => "default", "2" => "default");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "true");
        $arrayAling = array("0" => "center", "1" => "center", "2" => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function aAdjuntoFotoMaterialLaboratorio($datos) {
        $upload = "fotoEmpleado";
        require_once "../../cvista/laboratorio/PopudAdjuntarFotoMaterialesLaboratorio.php";
    }

    // lobo 13-07-2012 laboratorio 
    public function anularExamenPaciente($datos) {
        $oLLaboratorio = new LLaboratorio();
        $array = $oLLaboratorio->LanularExamenPaciente($datos);

        return $array;
    }

    // lobo 13-07-2012 laboratorio 
    public function AreprogramarExamen($datos) {
        $oLLaboratorio = new LLaboratorio();
        $array = $oLLaboratorio->LreprogramarExamen($datos);

        return $array;
    }

    //  Lobo

    public function AgregarPuntoControlBoton($datos) {
        $oLLaboratorio = new LLaboratorio();

        $respuesta = $oLLaboratorio->LagregarPuntoControlBoton($datos);
        return $respuesta;
    }

    //  Lobo

    public function AcargarDatosResultadosLaboratorio($datos) {
        $oLLaboratorio = new LLaboratorio();
        $respuestaFuncion = $oLLaboratorio->LcargarDatosResultadosLaboratorio($datos["idPacienteLaboratorio"]);
//     $respuesta=$respuestaFuncion[0][0];
        switch ($respuestaFuncion[0][0]) {
            case 1: // Gases Arteriales    case 1, 2:
                require_once '../../excelReader/Excel/reader.php';

                $nameFileImport = $datos["txtCodigoBarras"] . ".xls";
                $rutaUpload = "../../../../carpetaDocumentos/materialesLaboratorio/Activo/";
                $pathUpload = $rutaUpload . $nameFileImport;

                if (file_exists($pathUpload)) {
                    $respuesta = $fecha_hora;
                    // +-------------------------------------------------------------------------------------------+
                    $data = new Spreadsheet_Excel_Reader();
                    // Set output Encoding.
                    $data->setOutputEncoding('CP1251');
                    //            $data->setOutputEncoding('UTF-8');
                    $data->read($pathUpload); //le paso la ruta donde se encuentra el archivo a cargar
                    error_reporting(E_ALL ^ E_NOTICE);

                    $arrayCabecera = array();
                    $arrayCuerpo = array();
                    for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
                        for ($j = 1; $j <= 2; $j++) {//$data->sheets[0]['numCols']
                            $arrayCuerpo[$i - 1][$j - 1] = $data->sheets[0]['cells'][$i][$j];
                        }
                    }

                    foreach ($arrayCuerpo as $i => $value1) {
                        if ($i == 0) {
                            $respuesta = $value1[0] . '---' . $value1[1];
                        } else {
                            $respuesta .= '***' . $value1[0] . '---' . $value1[1];
                        }
                    }
                } else {
                    //            echo "\"" . $pathUpload . "\",";
                    $respuesta = "200";
                }
//                $respuesta = $respuestaFuncion[0][0];
                break;
            case 2:// para micrologia (urologia)
                $respuestamicrobiologia = $oLLaboratorio->LcargarDatosResultadosmicroBiologia($datos["txtCodigoBarras"]);
                foreach ($respuestamicrobiologia as $i => $value2) {
                    if ($i == 0) {
//                        $respuesta='peche';
                        $respuesta .= $i + 1 . '---' . $value2[0] . '***';
                        $respuesta .= $i + 2 . '---' . $value2[1] . '***';
                        $respuesta .= $i + 3 . '---' . $value2[2] . '***';
                        $respuesta .= $i + 4 . '---' . $value2[3] . '***';
                        $respuesta .= $i + 5 . '---' . $value2[4] . '***';
                        $respuesta .= $i + 6 . '---' . $value2[5] . '***';
                        $respuesta .= $i + 7 . '---' . $value2[6] . '***';
                        $respuesta .= $i + 8 . '---' . $value2[7] . '***';
                    } else {
                        $respuesta .= '***' . $value2[0] . '---' . $value2[1];
                    }
                }

//                $respuesta = $respuestaFuncion[0][0];
                break;
        }

        return $respuesta;
    }

    function aceptarArchivoGuardarDatosEnBaseDatos($datos, $identtity) {
        $oLLaboratorio = new LLaboratorio();
        require_once '../../excelReader/Excel/reader.php';
        $nameFileImport = $datos["vArchivo"];
        $datos['identity'] = $identtity;
        $rutaUpload = "../../../../carpetaDocumentos/materialesLaboratorio/microBilogiaActivo/";
        $pathUpload = $rutaUpload . $nameFileImport;
        $resultado = "";
        if (file_exists($pathUpload)) {
            $respuesta = $fecha_hora;
            $data = new Spreadsheet_Excel_Reader();
            $data->setOutputEncoding('CP1251');
            $data->read($pathUpload);
            error_reporting(E_ALL ^ E_NOTICE);
            $arrayCabecera = array();
            $arrayCuerpo = array();
            $numeroFila = 0;
            $numeroFila = $data->sheets[0]['numRows'];
            $numeroCOlumnas = count($data->sheets[0]['cells'][1]);
            $varchar[1] = '';
            $varchar[2] = '';
            $varchar[3] = '';
            $varchar[4] = '';
            $varchar[5] = '';
            $varchar[6] = '';
            $varchar[7] = '';
            $varchar[8] = '';
            $varchar[9] = '';
            $varchar[10] = '';
            $varchar[11] = '';
            $varchar[12] = '';
            $varchar[13] = '';
            $varchar[14] = '';
            $varchar[15] = '';
            for ($x = 1; $x <= $numeroFila; $x++) {
                for ($z = 1; $z <= 15; $z++) {
                    if ($x != 1) {
                        $varchar[$z] = $data->sheets[0]['cells'][$x][$z];
                    }
                }
                if ($x != 1) {
                    $respuesta = $oLLaboratorio->guardarDatosExcelMicrobiologia($varchar, $datos);
                }
            }
        }
        return $resultado;
    }

    function validarGuardarDatosEnBaseDatos($datos) {
        require_once '../../excelReader/Excel/reader.php';
        $nameFileImport = $datos["vArchivo"];
        $rutaUploadRuta = "../../../../carpetaDocumentos/materialesLaboratorio/microBilogiaActivo/";
        $pathUploadRuta = $rutaUploadRuta . $nameFileImport;
        $resultado = "";
        if (file_exists($pathUploadRuta)) {
            $oLLaboratorio = new LLaboratorio();
            $respuesta = $oLLaboratorio->validarGuardarDatosEnBaseDatos($datos);
            if ($respuesta[0][0] == 0) {
                $mensaje = 'El archivo ya se encuentra subido completamente en base de datos... Se borrar de la lista de Pendientes';
                $nameFileImport = $datos['vArchivo'];
                $rutaUpload = "../../../../carpetaDocumentos/materialesLaboratorio/microBilogiaActivo/";
                $pathUpload = $rutaUpload . $nameFileImport;
                $nameFileImportCopiar = $datos['vArchivo'];
                $rutaUploadCopiar = "../../../../carpetaDocumentos/materialesLaboratorio/microBilogiaDesactivo/";
                $pathUploadCopiar = $rutaUploadCopiar . $nameFileImportCopiar;
                if (!copy($pathUpload, $pathUploadCopiar)) {
                    
                }

                if (unlink($pathUpload)) {
                    
                }
                return $mensaje;
            } else {
                $identtity = $respuesta[0][0];
                $grabado = $this->aceptarArchivoGuardarDatosEnBaseDatos($datos, $identtity);
                $mensaje = 'Grabado Correctamente';
                $nameFileImport = $datos['vArchivo'];
                $rutaUpload = "../../../../carpetaDocumentos/materialesLaboratorio/microBilogiaActivo/";
                $pathUpload = $rutaUpload . $nameFileImport;
                $nameFileImportCopiar = $datos['vArchivo'];
                $rutaUploadCopiar = "../../../../carpetaDocumentos/materialesLaboratorio/microBilogiaDesactivo/";
                $pathUploadCopiar = $rutaUploadCopiar . $nameFileImportCopiar;
                if (!copy($pathUpload, $pathUploadCopiar)) {
                    
                }

                if (unlink($pathUpload)) {
                    
                }
                return $mensaje;
            }
        }
    }

    function AeviarArchivoExcel($datos) {
        $oLLaboratorio = new LLaboratorio();
//        $respuesta = $oLLaboratorio->LagregarPuntoControlBoton($datos);
        require_once '../../excelReader/Excel/reader.php';

        $nameFileImport = $datos["txtCodigoBarras"] . ".xls";

        $rutaUpload = "../../../../carpetaDocumentos/materialesLaboratorio/Activo/";

        $pathUpload = $rutaUpload . $nameFileImport;
        // ruta de copiar
        $nameFileImportCopiar = $datos["txtCodigoBarras"] . ".xls";
        $rutaUploadCopiar = "../../../../carpetaDocumentos/materialesLaboratorio/Desactivo/";
        $pathUploadCopiar = $rutaUploadCopiar . $nameFileImportCopiar;

        if (!copy($pathUpload, $pathUploadCopiar)) {// copiar
        }

        if (unlink($pathUpload)) {// eliminar
        }

//      return $respuesta;  
    }

    // eliminar
    /* <? 
      $dir='direccion del archivo'; //puedes usar dobles comillas si quieres
      if(file_exists($dir))
      {
      if(unlink($dir))
      print "El archivo fue borrado";
      }
      else
      print "Este archivo no existe";

      ?> */

    function aCargarComboProcedenciaFiltro() {
        $oLLaboratorio = new LLaboratorio();
        $cboActividadesLaboratorio = $oLLaboratorio->lListaActividadesLaboratorio();
        $cboActividadesLaboratorio = is_array($cboActividadesLaboratorio) ? $cboActividadesLaboratorio : array();
        $combo = '';
        $combo = '<select name="comboProcedencia" id="comboProcedencia" onchange="filterByProcedenciaFiltro()" style="background-color: #B3EB75">';
        $combo.='<option value="-1" selected="selelected" style="background-color: #FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
        foreach ($cboActividadesLaboratorio as $i => $value) {
            $combo.='<option value="' . $value[0] . '" style="background-color:' . $value[2] . ' ;" >';
            $combo.=htmlentities($value[1]) . '</option>';
        }
        $combo.='</select>';
        return $combo;
    }

    public function acontarRegistrosgetTratamientoPaciente($datos) {
        $oLLaboratorio = new LLaboratorio();

        $respuesta = $oLLaboratorio->lcontarRegistrosgetTratamientoPaciente($datos);
        return $respuesta;
    }
    public function comparaExistentesBaseDatosConDirectorio() {
        $oLLaboratorio = new LLaboratorio();
        $respuesta = $oLLaboratorio->comparaExistentesBaseDatosConDirectorio();
        return $respuesta;
    }
    

}

?>