<?php

require_once("../../../pholivo/Html.php");
require_once("../../../pholivo/Html1.php");
require_once("../../clogica/LPersona.php");
require_once("../../clogica/LCita.php");
require_once("../../clogica/LOrden.php");
require_once("../../centidad/EPaciente.php");
require_once("../../centidad/EProducto.php");
require_once("../../../pholivo/tablaDHTMLX.php");

class ActionOrden {

    private $o_LOrden;

    function __construct() {
        $this->o_LOrden = new LOrden();
    }

    public function muestraDatosPacienteOrden($iid_persona) {
        $o_LCita = new LCita();
        $o_Persona = new LPersona();
        $paciente = $o_LCita->getObjectPacienteCita($iid_persona);
        $fecha_nacimiento = date("d/m/Y", strtotime($paciente->dfch_nacimiento));
        if ($paciente->csexo == 'h')
            $sexo = 'HOMBRE';
        elseif ($paciente->csexo == 'm')
            $sexo = 'MUJER';
        $edadpaciente = $o_Persona->formatoEdad($paciente->dfch_nacimiento);
        $arrayPaciente = array('iid_persona' => $paciente->iid_persona,
            'vnombre' => $paciente->vnombre,
            'vapellido_pat' => $paciente->vapellido_pat,
            'vapellido_mat' => $paciente->vapellido_mat,
            'csexo' => $paciente->csexo,
            'iid_estado_civil' => $paciente->iid_estado_civil,
            'estado_civil' => $paciente->estado_civil,
            'vnro_doc_identidad' => $paciente->vnro_doc_identidad,
            'tipo_documento' => $paciente->tipo_documento,
            'iid_tipo_documento' => $paciente->iid_tipo_documento,
            'nro_historia_clinica' => $paciente->nro_historia_clinica,
            'iid_tafiliacion' => $paciente->iid_tafiliacion,
            'iid_mafiliacion' => $paciente->iid_mafiliacion,
            'afiliacion' => $paciente->afiliacion,
            'fecha_nacimiento' => $fecha_nacimiento,
            'grupo_sanguineo' => $paciente->grupo_sanguineo,
            'telefono' => $paciente->telefono,
            'celular' => $paciente->celular,
            'email' => $paciente->email,
            'fax' => $paciente->fax,
            'cid_ubigeo' => $paciente->cid_ubigeo,
            'cano_ubigeo' => $paciente->cano_ubigeo,
            'vdireccion' => $paciente->vdireccion);

        $_SESSION["paciente"] = $arrayPaciente;

        $scriptJS = "ordenes.pintarDatosPersonasOrden('$paciente->vnombre','$paciente->vapellido_pat $paciente->vapellido_mat','$paciente->afiliacion','$edadpaciente','$fecha_nacimiento','$sexo','$paciente->iid_persona');";
        return $scriptJS;
    }

    function getTablaOrdenesPaciente($parametros) {
        //////parametros de funcion L//////
        $oEPaciente = new EPaciente();
        $oEPaciente->setIid_persona($parametros["iid_persona"]);
        //echo "<br>familia_producto: ".$parametros["familia_producto"]."<br>";
        $parametros["familia_producto"] = $parametros["familia_producto"] == "" ? "" : $parametros["familia_producto"];
        $parametros["iid_tafiliacion"] = $parametros["iid_tafiliacion"] == "" ? 0 : $parametros["iid_tafiliacion"];
        //echo "<br>longitud:".$parametros["fechas"]."<br>";
        $fecha = array(substr(trim($parametros["fechas"]), 0, 10), substr(trim($parametros["fechas"]), 10, 10));
        $fecha1 = split("/", $fecha[0]);
        $fecha2 = split("/", $fecha[1]);
        $f1 = $fecha1[2] . "-" . $fecha1[1] . "-" . $fecha1[0];
        $f2 = $fecha2[2] . "-" . $fecha2[1] . "-" . $fecha2[0];
        //echo "<br>familia_producto: ".$parametros["familia_producto"]."<br>";
        //echo "<br>longitud:".strlen(trim($parametros["fechas"]))."<br>";
        $parametros["fechas"] = strlen(trim($parametros["fechas"])) == "20" ? $f1 . $f2 : "";
        //echo "<br>$f1:$f2<br>";
        //echo "<br>fecha:".$parametros["fechas"]."<br>";
        $parametros["iestado_orden"] = $parametros["iestado_orden"] == "" ? 0 : $parametros["iestado_orden"];
        ///////Parametros de funcion///////
        $arrayTabla = $this->o_LOrden->getArrayOrdenesPaciente($oEPaciente, $parametros);
        //var_dump($arrayTabla);
        $arrayCabecera = array("11" => "checkbox", "0" => "Nº ORDEN", "1" => "FECHA", "2" => "AFILIACION", "12" => "#", "3" => "CONCEPTO", "4" => "PRECIO", "5" => "CANTIDAD", "6" => "TOTAL");
        $o_Tabla = new Tabla1($arrayCabecera, 15, $arrayTabla, 'tablaOrden', '', '', 'filaSeleccionada', 'OnDblClick', 'alert', 8, 9);
        $tablaHtml = $o_Tabla->getTabla();
        return $tablaHtml;
    }

    public function getTablaProductos($parametros) {
        $arrayCabeceraProductos = array("0" => "CODIGO", "1" => "PRODUCTO", "9" => "PRECIO", "11" => "AFILIACION");
        $arrayFilasProductos = array();
        $oLOrden = new LOrden();
        $accion = $parametros["accionEventoFila"];
        $arrayFilasProductos = $oLOrden->getArrayProductos($parametros);
        $arrayFilas = array();
        foreach ($arrayFilasProductos as $i => $fila) {
            $row = $fila;
            $row[12] = $fila[0] . $fila[10];
            array_push($arrayFilas, $row);
        }
        $oTabla = new Tabla1($arrayCabeceraProductos, 20, $arrayFilas, 'tablaOrden', 'fila2', 'fila2', 'filaSeleccionada', 'ondblclick', $accion, 12);
        //$oTabla->setOcultarColumnas(true);
        //$oTabla->setCamposEditables(array("1","9"));//Se Usa al darle Onlick a una celda
        $oTabla->setColumnasOrdenar(array("1"));
        $tabla = $oTabla->getTabla();
        return $tabla;
    }

    public function agregarProductoOrden($parametros) {
        $oLOrden = new LOrden();
        $oEProducto = new EProducto();
        if ($parametros["numProductos"] == "0") {
            unset($_SESSION["mantenimiento_productos_ordenes"]);
        }
        $oEProducto->setCod_art(substr($parametros["codigoProducto"], 0, 13));
        $oEProducto->setIid_tafiliacion(substr($parametros["codigoProducto"], 13, 2));
        $arrayProductosOrden = $oLOrden->getArrayAgregarProductos($oEProducto);
        $numProductos = count($arrayProductosOrden);
        $imgCabecera = "../../../../fastmedical_front/imagen/icono/agt_action_fail.png";

        $arrayCabecera = array("1" => "Concepto", "2" => "Precio", "3" => "Cant", "4" => "Total", "6" => "<img src=\"$imgCabecera\" />");
        $oTabla = new Tabla1($arrayCabecera, 13, $arrayProductosOrden, 'tablaOrden', "fila2", "fila2", "", "", "", 0);

        $oTabla->setIdTabla("tabla_productos_ordenes_mantenimiento"); // asigna un Id a la tabla html
        $oTabla->setCamposEditables(array("-5" => "2", "3")); //Falta validar tipos -> int,string,time,datetime,numeric
        //$oTabla->setOcultarColumnas(array("1"),"2",242);
        $oTabla->setAtributoColumnas(array("2" => array("40", "R"), "3" => array("30", "R"), "4" => array("60", "R"), "6" => array("20", "C")));
        $oTabla->setOyenteJSEdicionColumnas(array("2" => "ordenes.actualizarTablaProductos", "3" => "ordenes.actualizarTablaProductos"));
        $oTabla->setColumnasTotalizadas(array("4"));
        $tabla = $oTabla->getTabla("mantenimiento_productos_ordenes"); //con este nombre se va a grabar en session
        return $numProductos . "|" . $tabla;
    }

    public function getFormProductos($parametros) {
        require_once("../../cvista/busqueda/buscador_productos.php");
    }

    public function getFormGeneracionOrdenes($parametros) {
        //if(false){	$arrayProductosMantenimientoOrden = $_SESSION["antenimiento_productos_ordenes"];}
        require_once("../../cvista/orden/mantenimiento_orden.php");
    }

    public function actualizarCantidadesProductoOrden($parametros) {
        $tabla = $this->o_LOrden->actualizarCantidadesProductoOrden($parametros);
        return $tabla;
    }

    public function grabarNuevaOrden($parametros) {
        $respuesta = $this->o_LOrden->grabarNuevaOrden($parametros["idPersona"], $parametros["idAfiliacion"]);
        return $respuesta;
    }

    public function cambiarEstado($parametros) {
        $accion = $parametros["accion"]; //0 Eliminar, // HABLITAR
        $arrayChecks = json_decode($parametros["ordenes"]);
    }

    //generacion de orde - sayes 

    public function PopadGenerarOrden() {
        $oLOrden = new LOrden();
        require_once '../../cvista/orden/PopadGenerarOrden.php';
    }

    public function PopadActoMedico() {
        $oLOrden = new LOrden();
        require_once '../../cvista/orden/PopadActomedico.php';
    }

    public function obtenerAfiliacionPersona($datos) {
        $oLOrden = new LOrden();
        $arrayDatosAfiliacion = $oLOrden->lobtenerAfiliacionPersona($datos);
        echo $arrayDatosAfiliacion[0][0] . '*' . $arrayDatosAfiliacion[0][1];
        //require_once '../../cvista/orden/PopadGenerarOrden.php';
    }

    public function verificarPaquete($datos) {
        $oLOrden = new LOrden();
        $arrayDatosOrden = $oLOrden->verificarPaquete($datos);
        $numero = count($arrayDatosOrden);
        $cadena = '';
        $contador = 0;
        foreach ($arrayDatosOrden as $value) {
            $contador++;
            $cadena .= $value[0] . '[]' . $value[1] . '[]' . $value[2] . '[]' . $value[3] . '[]' . $value[4];
            if ($contador != $numero) {
                $cadena .= "|";
            }
        }
//        switch ($numero) {
//            case 1:
//                echo $arrayDatosOrden[0][0] . '*' . $arrayDatosOrden[0][1] . '*' . $arrayDatosOrden[0][2] . '*' . $arrayDatosOrden[0][3] . '*' . $arrayDatosOrden[0][4];
//                break;
//            case 2:
//                echo $arrayDatosOrden[0][0] . '*' . $arrayDatosOrden[0][1] . '*' . $arrayDatosOrden[0][2] . '*' . $arrayDatosOrden[0][3] . '*' . $arrayDatosOrden[0][4] . '|' . $arrayDatosOrden[1][0] . '*' . $arrayDatosOrden[1][1] . '*' . $arrayDatosOrden[1][2] . '*' . $arrayDatosOrden[1][3] . '*' . $arrayDatosOrden[1][4];
//                break;
//            case 3:
//                echo $arrayDatosOrden[0][0] . '*' . $arrayDatosOrden[0][1] . '*' . $arrayDatosOrden[0][2] . '*' . $arrayDatosOrden[0][3] . '*' . $arrayDatosOrden[0][4] . '|' . $arrayDatosOrden[1][0] . '*' . $arrayDatosOrden[1][1] . '*' . $arrayDatosOrden[1][2] . '*' . $arrayDatosOrden[1][3] . '*' . $arrayDatosOrden[1][4]. '|' . $arrayDatosOrden[2][0] . '*' . $arrayDatosOrden[2][1] . '*' . $arrayDatosOrden[2][2] . '*' . $arrayDatosOrden[2][3] . '*' . $arrayDatosOrden[2][4];
//                break;
//        }
        echo $cadena;
    }

    public function grabarOrgenGenerada($datos) {
        $oLOrden = new LOrden();
        $arrayDatosAfiliacion = $oLOrden->lgrabarOrgenGenerada($datos);
        echo $arrayDatosAfiliacion[0][0];
        //require_once '../../cvista/orden/PopadGenerarOrden.php';
    }

    public function grabarDetalleOrgenGenerada($datos) {
        $oLOrden = new LOrden();
        $arrayDatosAfiliacion = $oLOrden->grabarDetalleOrgenGenerada($datos);
        echo $arrayDatosAfiliacion;
        //require_once '../../cvista/orden/PopadGenerarOrden.php';
    }

    public function aAnularItem($datos) {
        $oLOrden = new LOrden();
        $array = $oLOrden->lAnularItem($datos);
        return utf8_encode($array[0][0]);
        //require_once '../../cvista/orden/PopadGenerarOrden.php';
    }

    public function tablaProductosxAfiliacion($afil, $pro) {
        $oLOrden = new LOrden();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $oLOrden->lgetProductos($afil, $pro);
        $arrayCabecera = array("0" => "Id", "1" => "Nombre Producto", "2" => "Precio", "3" => "Stock", "4" => "Descripcion", "5" => "Id", "6" => "Accion");
        $arrayTamano = array("0" => "70", "1" => "*", "2" => "50", "3" => "45", "4" => "*", "5" => "*", "6" => "70");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "img");
        $arrayCursor = array("0" => "default", "1" => "default", "2" => "lefth", "3" => "lefth", "4" => "lefth", "6" => "lefth", "7" => "pointer");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => "false", "5" => "true", "6" => "false");
        $arrayAling = array("0" => "lefth", "1" => "lefth", "2" => "lefth", "3" => "center", "4" => "center", "5" => "center", "6" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function tablaTemporal() {
        $oLOrden = new LOrden();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = Array();
        $arrayCabecera = array("0" => "Producto", "1" => "Cantidad", "2" => "Precio", "3" => "Total", "4" => "Accion", "5" => "Código");
        $arrayTamano = array("0" => "*", "1" => "70", "2" => "70", "3" => "70", "4" => "70", "5" => "*");
        $arrayTipo = array("0" => "ro", "1" => "ed", "2" => "ed", "3" => "ro", "4" => "img", "5" => "ro");
        $arrayCursor = array("0" => "default", "1" => "lefth", "2" => "lefth", "3" => "lefth", "4" => "pointer", "5" => "default");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => "false", "5" => "false");
        $arrayAling = array("0" => "lefth", "1" => "lefth", "2" => "center", "3" => "center", "4" => "center", "5" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function tablaActoMedico($Cod) {
        $oLOrden = new LOrden();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $oLOrden->getActoMedico($Cod);
        $arrayCabecera = array("0" => "Nro. Comprobante", "1" => "Nro. Acto Medico", "2" => "Descripcion", "3" => "Fecha", "4" => "Medico", "5" => "Observacion");
        $arrayTamano = array("0" => "*", "1" => "*", "2" => "*", "3" => "*", "4" => "*", "5" => "*");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro");
        $arrayCursor = array("0" => "default", "1" => "default", "2" => "lefth", "3" => "lefth", "4" => "lefth", "5" => "lefth");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => "false", "5" => "false");
        $arrayAling = array("0" => "lefth", "1" => "lefth", "2" => "lefth", "3" => "center", "4" => "center", "5" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    /* ======================================================================= */
    /* ====================================== CAJA =========================== */
    /* ======================================================================= */

    public function mostrarVentanaTesoreriaAperturaDeDocumentos() {
        $oLOrden = new LOrden();

        $codPerCajero = $_SESSION['id_persona']; //c_cod_per  de persona logueada //se muestra en la vista
        $nomCompletoCajero = htmlentities($_SESSION['nombre']); //Nombre completo del usuario logueado //se muestra en la vista
//$c_cod_per="0151860";//njaimes caja 34 serie 034 para recibos
//$c_cod_per="0364835";//Patty caja 28 serie 028 para recibos
//$codCaja=$oLOrden->spListaCaja($c_cod_per);
        $codCaja = $_SESSION["iIdCaja"]; //se muestra en la vista
//$numFormato=103;
        $numFormato = 121;
        $rs = $oLOrden->spListaFechaServidor($numFormato);
        $fechaActualServidor = $rs[0]["fechaServidor"]; //se muestra en la vista

        $rptaCrearCierreTesoreria = $oLOrden->spCrearCierreTesoreria();

        $indSeleccionado = "";
        $opcionesCboTipoComprobante = $this->listarOpcionesCboTipoComprobante($codCaja, $fechaActualServidor, $indSeleccionado);
        require_once("../../cvista/orden/vistaAperturaDeDocumentos.php");
    }

    public function listarOpcionesCboTipoComprobante($codCaja, $fecha, $indSeleccionado) {
        $oLOrden = new LOrden();
        $accion = "06";

        $rs = $oLOrden->spTesoreriaSerieCaja($accion, $codCaja, $fecha);
        if (count($rs) > 0) {
            foreach ($rs as $fila) {
                $arrayCombo[$fila["codTipoComprobante"]] = htmlentities(trim($fila["codTipoComprobante"]) . "-" . trim($fila["descTipoComprobante"]));
            }
        }
        if (!isset($arrayCombo)) {
            $arrayCombo = array();
        }
        $oCombo = new Combo($arrayCombo);
        $indSel = $indSeleccionado;
        $valorDefault = "";
        $comboHTML = $oCombo->getOptionsHTML($indSel, $valorDefault);
        return $comboHTML;
    }

    public function mostrarTablaTipoComprobantesAperturados($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLOrden = new LOrden();
        $accion = "02";
        $codCaja = $datos["codCaja"];
        $fecha = $datos["fechaHoy"];

        $arrayFilas = $oLOrden->spTesoreriaSerieCaja($accion, $codCaja, $fecha);

        $arrayCabecera = array("codTipoDocumentoPago" => "codTipoDocumentoPago",
            "descTipoDocumentoPago" => "Descripcion",
            "serieDocumentoPago" => "Serie");
        $arrayTamano = array("codTipoDocumentoPago" => "80",
            "descTipoDocumentoPago" => "*",
            "serieDocumentoPago" => "80");
        $arrayTipo = array("codTipoDocumentoPago" => "ro",
            "descTipoDocumentoPago" => "ro",
            "serieDocumentoPago" => "ro");
        $arrayAlineacion = array("codTipoDocumentoPago" => "right",
            "descTipoDocumentoPago" => "right",
            "serieDocumentoPago" => "right");
        $arrayHidden = array("codTipoDocumentoPago" => "true",
            "descTipoDocumentoPago" => "false",
            "serieDocumentoPago" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, "codTipoDocumentoPago", $arrayHidden);
    }

    public function cargarDatosCboSerieComprobante($datos) {
        $oLOrden = new LOrden();

        $accion = "11";
        $codCaja = $datos["codCaja"];
        $codTipoComprobante = $datos["codTipoComprobante"];
        $rs = $oLOrden->spListaSerieComprobante($accion, $codCaja, $codTipoComprobante);

        if (count($rs) > 0) {
            foreach ($rs as $fila) {
                //$arrayCombo[$fila["codSerieComprobante"]]=htmlentities(trim($fila["codSerieComprobante"]));
                $arrayCombo[$fila["cadenaDatos"]] = htmlentities(trim($fila["codSerieComprobante"]));
            }
        }
        if (!isset($arrayCombo)) {
            $arrayCombo = array();
        }
        $oCombo = new Combo($arrayCombo);
        $indSel = "";
        $valorDefault = "";
        $opcionesComboHTML = $oCombo->getOptionsHTML($indSel, $valorDefault);
        return "<select id=\"cboSerieComprobante\" name=\"cboSerieComprobante\">" . $opcionesComboHTML . "</select>";
    }

    public function agregarTipoComprobante($datos) {
        $oLOrden = new LOrden();
        $rs = $oLOrden->spMantenimientoSerieCaja($datos);
        $rpta = $rs[0][0];

        if ($rpta == 1)
            $msj = "Se registro el tipo de comprobante con exito";
        else
            $msj = "No se concreto la accion, intentelo nuevamente o contactese con su administrador";

        return $msj;
    }

    public function cargarDatosCboTipoComprobante($datos) {
        $codCaja = $datos["codCaja"];
        $fechaActualServidor = $datos["fechaHoy"];
        $indSeleccionado = "";
        $opcionesCboTipoComprobanteHtml = $this->listarOpcionesCboTipoComprobante($codCaja, $fechaActualServidor, $indSeleccionado);

        return "<select id=\"cboTipoComprobante\" name=\"cboTipoComprobante\" onchange=\"cargarDatosCboSerieComprobante();\">" . $opcionesCboTipoComprobanteHtml . "</select>";
    }

    public function mostrarVentanaFacturacionOrdenPaciente($nroOrdenCompra, $codPerPaciente, $funcionCerrar) {
        $oLOrden = new LOrden();
        $codPerCajero = $_SESSION['id_persona']; //c_cod_per  de persona logueada
        $codCajaFacturacion = $_SESSION["iIdCaja"];
        $arrayDatosPersona = $oLOrden->lDatosPersona($codPerPaciente);
        $arrayDatosComprobante = $oLOrden->lDatosComprobante($codCajaFacturacion);
        $opcionesCboTipoComprobanteFacturacion = $this->listarOpcionesCboTipoComprobanteFechaHoy($arrayDatosComprobante);

        if (isset($arrayDatosComprobante['0']['iActual'])) {
            $nroComprobanteFacturacion = $arrayDatosComprobante['0']['iActual'];
            $nroComprobanteFacturacion = $nroComprobanteFacturacion + 1;
            $tipoIgv = $arrayDatosComprobante['0']['iIdTipoIgv'];
            $vSerie = $arrayDatosComprobante['0']['vSerie'];
        } else {
            $nroComprobanteFacturacion = '';
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $indFormaPagoSeleccionado = "0001"; //Seleccionamos efectivo por defecto
        $opcionesCboFormaPagoComprobanteFacturacion = $this->listarOpcionesFormasDePago($indFormaPagoSeleccionado);
        $fechaActualServidor = date("d/m/y");

        /*

          $indTipoComprobanteSeleccionado = "01"; //Seleccionamos Boleta por defecto
          ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          $accion = 1;
          $codTipoComprobante = ""; //No es necesario enviar este parametro porque no lo usa
          $arrayDatos = $oLOrden->spSelectCaja($accion, $codCajaFacturacion, $codTipoComprobante);
          $opcionesCboTipoComprobanteFacturacion = $this->listarOpcionesCboTipoComprobanteFechaHoy($arrayDatos, $indTipoComprobanteSeleccionado);

          //Seleccionamos el numero de serie del recibo seleccionado
          $codSerieComprobanteFacturacion = "nada";
          $nroComprobanteFacturacion = "nada";

          if (count($arrayDatos) > 0) {
          foreach ($arrayDatos as $fila) {
          if ($fila["codTipoComprobante"] == $indTipoComprobanteSeleccionado) {
          $codSerieComprobanteFacturacion = $fila["codSerieComprobante"];
          $nroComprobanteFacturacion = $fila["nroUltComprobante"];
          $nroComprobanteFacturacion = $nroComprobanteFacturacion + 1;

          if (strlen($nroComprobanteFacturacion) < 7) {
          $numCerosFaltantes = 7 - strlen($nroComprobanteFacturacion);
          for ($i = 1; $i <= $numCerosFaltantes; $i++) {
          $nroComprobanteFacturacion = "0" . $nroComprobanteFacturacion;
          }
          }
          }
          }
          }
          ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

          $numFormato = 121; //con milisegundos

          $rs = $oLOrden->spListaFechaServidor($numFormato);
          $fechaActualServidor = $rs[0]["fechaServidor"];
          ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          $indFormaPagoSeleccionado = "0001"; //Seleccionamos efectivo por defecto
          $opcionesCboFormaPagoComprobanteFacturacion = $this->listarOpcionesFormasDePago($indFormaPagoSeleccionado);
         */
        require_once("../../cvista/orden/vistaFacturacionOrdenPaciente.php");
    }

    public function obtenerNumeroYSerie($iIdSerieComprobante) {
        $oLOrden = new LOrden();
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $accion = 3;
        $codTipoComprobante = "";
        $arrayDatos = $oLOrden->spSelectCaja($accion, $iIdSerieComprobante, '');

//Seleccionamos el numero de serie del recibo seleccionado

        $nroComprobanteFacturacion = "nada";
        $tipoIgv = "nada";
        $vSerie = 'nada';

        if (count($arrayDatos) > 0) {
            foreach ($arrayDatos as $fila) {
                $nroComprobanteFacturacion = $fila["iActual"];
                $nroComprobanteFacturacion = $nroComprobanteFacturacion + 1;
                $tipoIgv = $fila['iIdTipoIgv'];
                $vSerie = $fila['vSerie'];
            }
        }
        return "$nroComprobanteFacturacion-$tipoIgv-$vSerie";
    }

    public function listarOpcionesCboTipoComprobanteFechaHoy($arrayDatos) {
        $oLOrden = new LOrden();
        if (count($arrayDatos) > 0) {
            $primero = true;
            foreach ($arrayDatos as $fila) {
                $arrayCombo[$fila["iIdCajaComprobante"]] = htmlentities("Serie: " . $fila['vSerie'] . " - " . trim($fila["vDescripcion"]));
                if ($primero) {
                    $indSeleccionado = $fila["iIdCajaComprobante"];
                    $primero = false;
                }
            }
        }
        if (!isset($arrayCombo)) {
            $arrayCombo = array();
        }
        $oCombo = new Combo($arrayCombo);
        $indSel = $indSeleccionado;
        $valorDefault = "";
        $opcionesComboHTML = $oCombo->getOptionsHTML($indSel, $valorDefault);
        return $opcionesComboHTML;
    }

    public function listarOpcionesFormasDePago($indSeleccionado) {
        $oLOrden = new LOrden();

        $rs = $oLOrden->spListaFormasDePago();
        if (count($rs) > 0) {
            foreach ($rs as $fila) {
                $arrayCombo[$fila["iIdFormaPago"]] = trim($fila["iIdFormaPago"]) . "-" . utf8_encode($fila["vFormaPago"]);
            }
        }
        if (!isset($arrayCombo)) {
            $arrayCombo = array();
        }
        $oCombo = new Combo($arrayCombo);
        $indSel = $indSeleccionado;
        $valorDefault = "";
        $opcionesComboHTML = $oCombo->getOptionsHTML($indSel, $valorDefault);
        return $opcionesComboHTML;
    }

    public function mostrarTablaProductoServicioFacturacion($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLOrden = new LOrden();
        $accion = 2;
        $token = $datos["nroOrdenCompra"];
        $cadenaItem = $datos["cadenaItems"];

        $arrayFilas = $oLOrden->spListaOrdenFacturacion($accion, $token, $cadenaItem);

        $arrayCabecera = array(
            "c_item" => "Item",
            "c_cod_ser_pro" => "Codigo",
            "descTipoProdServ" => "Tipo",
            "v_desc_ser_pro" => "Descripcion",
            "n_preunit" => "P.Unit",
            "n_canti" => "Cant",
            "montoDescuento" => "Desc.",
            "nuevoPrecio" => "Precio Dto.",
            "n_total" => "Total",
            "porcentaje" => "porcentaje",
            "nuevoTotal" => "nuevoTotal",
            "idPuestoempleado" => "idPuestoempleado",
            "observacion" => "observacion",
            "descuento" => " ");
        $arrayTamano = array(
            "c_item" => "80",
            "c_cod_ser_pro" => "80",
            "descTipoProdServ" => "150",
            "v_desc_ser_pro" => "*",
            "n_preunit" => "50",
            "n_canti" => "50",
            "n_total" => "50",
            "porcentaje" => "20",
            "montoDescuento" => "50",
            "nuevoPrecio" => "50",
            "nuevoTotal" => "20",
            "idPuestoempleado" => "20",
            "observacion" => "20",
            "descuento" => "20");
        $arrayTipo = array(
            "c_item" => "ro",
            "c_cod_ser_pro" => "ro",
            "descTipoProdServ" => "ro",
            "v_desc_ser_pro" => "ro",
            "n_preunit" => "ro",
            "n_canti" => "ro",
            "n_total" => "ro",
            "porcentaje" => "ro",
            "montoDescuento" => "ro",
            "nuevoPrecio" => "ro",
            "nuevoTotal" => "ro",
            "idPuestoempleado" => "ro",
            "observacion" => "ro",
            "descuento" => "img");
        $arrayAlineacion = array(
            "c_item" => "right",
            "c_cod_ser_pro" => "right",
            "descTipoProdServ" => "right",
            "v_desc_ser_pro" => "right",
            "n_preunit" => "right",
            "n_canti" => "right",
            "n_total" => "right",
            "porcentaje" => "right",
            "montoDescuento" => "right",
            "nuevoPrecio" => "right",
            "nuevoTotal" => "right",
            "idPuestoempleado" => "right",
            "observacion" => "right",
            "descuento" => "center");
        $arrayHidden = array(
            "c_item" => "true",
            "c_cod_ser_pro" => "false",
            "descTipoProdServ" => "false",
            "v_desc_ser_pro" => "false",
            "n_preunit" => "false",
            "n_canti" => "false",
            "n_total" => "false",
            "porcentaje" => "true",
            "montoDescuento" => "false",
            "nuevoPrecio" => "false",
            "nuevoTotal" => "true",
            "idPuestoempleado" => "true",
            "observacion" => "true",
            "descuento" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, "c_item", $arrayHidden);
    }

    public function aVentanaDescuento($datos) {
//echo $c_item;
        require_once("../../cvista/orden/vDescuentos.php");
    }

    public function aVentanaBuscarAutoriza($idPuestoEmpleado) {
        $o_LPersona = new ActionPersona();
//$funcion = '';
        $comboTipoDocumentos = $o_LPersona->comboTipoDocumento('1');
        require_once("../../cvista/orden/vBuscarAutoriza.php");
    }

    public function aPagarOrdenes($datos) {
        $oLOrden = new LOrden();
        $array = $oLOrden->lPagarOrdenes($datos);
        $cabecera = $array[0];
        print_r($array);
        $cantidad = count($array);
        $respuesta = $array[0][0];
        //Llamar a facturación electrónica
        include_once '../../../pholivo/arrayToXml.php';

        $header['fechaTransaccion'] = '2020-11-28 12:47:35'; //date('Y-m-d H:i:s');// '2020-11-06 12:46:41';
        $header['idEmisor'] = '20147736577';
        $header['token'] = 'WAGptLMI3VCh12WxSCny/Wp++O4=';
        $header['transaccion'] = 'enviarComprobanteRequest';

        $comprobanteElectronico['anticipo'] = $cabecera['anticipo'];
        $comprobanteElectronico['codTipoOperacion'] = $cabecera['codTipoOperacion'];
        $comprobanteElectronico['codigoEmisor'] = $cabecera['codigoEmisor'];
        $comprobanteElectronico['codigoTipoDocumentoIdentificacionAdquiriente'] = trim($cabecera['codigoTipoDocumentoIdentificacionAdquiriente']);
        $comprobanteElectronico['codigoTipoDocumentoIdentificacionEmisor'] = $cabecera['codigoTipoDocumentoIdentificacionEmisor'];
        $comprobanteElectronico['codigoTipoMoneda'] = $cabecera['codigoTipoMoneda'];

        $comprobanteElectronico['correoElectronicoAdquiriente'] = trim($cabecera['correoElectronicoAdquiriente']);

        $descuentoCargoGlobal['descuentoAfectaIGV'] = trim($cabecera['descuentoAfectaIGV']);
        $descuentoCargoGlobal['descuentoNoAfectaIGV'] = $cabecera['descuentoNoAfectaIGV'];
        //$descuentoCargoGlobal['recagoYpropina'] = '27.19';

        $comprobanteElectronico['descuentoCargoGlobal'] = $descuentoCargoGlobal;
        $comprobanteElectronico['descuentoGlobal'] =trim($cabecera['descuentoGlobal']);

        $direccionAdquiriente['departamento'] = $cabecera['departamentoAdquiriente'];
        $direccionAdquiriente['direccionDetallada'] = $cabecera['direccionDetalladaAdquiriente'];
        $direccionAdquiriente['distrito'] = $cabecera['distritoAdquiriente'];
        $direccionAdquiriente['provincia'] = $cabecera['provienciaAdquiriente'];

        $comprobanteElectronico['direccionAdquiriente'] = $direccionAdquiriente;

        $direccionEmisor['codigoPais'] = $cabecera['codigoPaisEmisor'];
        $direccionEmisor['codigoSede'] = '';
        $direccionEmisor['codigoSunatAnexo'] = $cabecera['codigoSunatAnexo'];
        $direccionEmisor['codigoUbigeo'] = $cabecera['codigoUbigeo'];
        $direccionEmisor['departamento'] = $cabecera['departamento'];
        $direccionEmisor['direccionDetallada'] = $cabecera['direccionDetallada'];
        $direccionEmisor['distrito'] = $cabecera['distrito'];
        $direccionEmisor['provincia'] = $cabecera['provincia'];

        $comprobanteElectronico['direccionEmisor'] = $direccionEmisor;
        /*
          $direccionEntregaBienOPrestaServicio['codigoPais'] = 'PE';
          $direccionEntregaBienOPrestaServicio['codigoSede'] = 'HCC6';
          $direccionEntregaBienOPrestaServicio['codigoSunatAnexo'] = '';
          $direccionEntregaBienOPrestaServicio['codigoUbigeo'] = '030101';
          $direccionEntregaBienOPrestaServicio['departamento'] = 'APUR�?MAC';
          $direccionEntregaBienOPrestaServicio['direccionDetallada'] = 'AV. MI CASA NRO. 125';
          $direccionEntregaBienOPrestaServicio['distrito'] = 'ABANCAY';
          $direccionEntregaBienOPrestaServicio['provincia'] = 'ABANCAY';
          $comprobanteElectronico['direccionEntregaBienOPrestaServicio'] = $direccionEntregaBienOPrestaServicio;
         */
        $listadoDeEstructuras['nombre'] = 'CAJERO';
        $listadoDeEstructuras['valor'] = 'USUARIO_VALDITEX';
        $estructuraVariable['listadoDeEstructuras'][] = $listadoDeEstructuras;
        $listadoDeEstructuras['nombre'] = 'RECARGO_CONSUMO';
        $listadoDeEstructuras['valor'] = '27.19';
        $estructuraVariable['listadoDeEstructuras'][] = $listadoDeEstructuras;
        $listadoDeEstructuras['nombre'] = 'SEDE';
        $listadoDeEstructuras['valor'] = 'SEDE ALFA';
        $estructuraVariable['listadoDeEstructuras'][] = $listadoDeEstructuras;
        $comprobanteElectronico['estructuraVariable'] = $estructuraVariable;

        $comprobanteElectronico['fechaEmision'] = $cabecera['fechaEmision']; //'2020-11-06';
        $comprobanteElectronico['fechaVencimiento'] = $cabecera['fechaVencimiento']; //'2020-11-06';
        //   $comprobanteElectronico['formaPago'] = 'CRE';
        //   $comprobanteElectronico['gratuito'] = 'false';
        $comprobanteElectronico['horaEmision'] = $cabecera['horaEmision']; //'12:46:41';

        $identificador['codigoTipoDocumento'] = $cabecera['codigoTipoDocumento']; //'01';
        $identificador['numeroCorrelativo'] = $cabecera['numeroCorrelativo']; //'10';
        $identificador['numeroDocumentoIdentificacionEmisor'] = $cabecera['numeroDocumentoIdentificacionEmisor']; //'20553771111';
        $identificador['serie'] = trim($cabecera['serie']);
        //$identificador['tipoEmision'] = 'ELE';

        $comprobanteElectronico['identificador'] = $identificador;
        $comprobanteElectronico['importeTotal'] = $cabecera['importeTotal']; //'169.71';
        $comprobanteElectronico['indicadorOperacionSujetaDetraccion'] = $cabecera['indicadorOperacionSujetaDetraccion'];
        //  $comprobanteElectronico['indicadorRetornoEstado'] = 'S';
        $i = 0;
        foreach ($array as $key => $value) {
            if ($i < $cantidad - 1) {
                $itemsComprobantePagoElectronicoVenta['cantidad'] = $value['cantidad'];//
               // $itemsComprobantePagoElectronicoVenta['cargoNoAfectaIGV'] = $value[''];//'0.0';
              //  $itemsComprobantePagoElectronicoVenta['cargoNoAfectaIGVFactor'] =$value[''];//'0';
                $itemsComprobantePagoElectronicoVenta['codigoProducto'] = $value['codigoProducto'];//'';
                $itemsComprobantePagoElectronicoVenta['descripcionProducto'] = $value['descripcionProducto'];//'ASDASD';
              //  $itemsComprobantePagoElectronicoVenta['detalleProducto'] = $value[''];//'';
             //   $itemsComprobantePagoElectronicoVenta['gratuito'] =$value[''];// 'false';
                $itemsComprobantePagoElectronicoVenta['importeTotal'] = $value['importeTotal'];//'169.71';
                $itemsComprobantePagoElectronicoVenta['importeValorVentaItem'] =$value['importeValorVentaItem'];// '143.82';




                $impuestosUnitarios['codigoImpuestoUnitario'] = $value['codigoImpuestoUnitario'];//'1000';
                $impuestosUnitarios['codigoTipoAfectacionIgv'] = $value['codigoTipoAfectacionIgv'];//'10';
                $impuestosUnitarios['montoBaseImpuesto'] = $value['montoBaseImpuesto'];//'143.82';
               // $impuestosUnitarios['montoSubTotalImpuestoUnitario'] = $value['montoSubTotalImpuestoUnitario'];//'25.89';
                $impuestosUnitarios['montoTotalImpuestoUnitario'] =$value['montoTotalImpuestoUnitario'];// '25.89';

                $itemsComprobantePagoElectronicoVenta['impuestosUnitarios'] = $impuestosUnitarios;


                $itemsComprobantePagoElectronicoVenta['numeroOrden'] =$value['numeroOrden'];// '1';
               // $itemsComprobantePagoElectronicoVenta['precioReferencia'] = $value[''];//'false';

                $preciosUnitarios['codigoTipoPrecio'] = $value['codigoTipoPrecio'];//'01';
                $preciosUnitarios['montoPrecio'] = $value['montoPrecio'];//'169.71';
                $itemsComprobantePagoElectronicoVenta['preciosUnitarios'] = $preciosUnitarios;

                $itemsComprobantePagoElectronicoVenta['unidadMedida'] = trim($value['unidadMedida']);//'ZZ';
                $itemsComprobantePagoElectronicoVenta['valorVentaUnitario'] =$value['valorVentaUnitario'];// '143.82000';


                $comprobanteElectronico['itemsComprobantePagoElectronicoVenta'][] = $itemsComprobantePagoElectronicoVenta;
            }
            $i++;
        }

        $comprobanteElectronico['numeroDocumentoIdentificacionAdquiriente'] = $cabecera['numeroDocumentoIdentificacionAdquiriente'];//'20508316985';
         $comprobanteElectronico['nombresAdquiriente'] = $cabecera['nombresAdquiriente'];
          $comprobanteElectronico['apellidosAdquiriente'] = $cabecera['apellidosAdquiriente'];
       // $comprobanteElectronico['observaciones'] = $cabecera[''];'';
      //  $comprobanteElectronico['precioReferencial'] = 'false';
      //  $propiedadesAdicionales['codigoPropiedadAdicional'] = $cabecera[''];//'1000';
      //  $propiedadesAdicionales['descripcionPropiedadAdicional'] = 'CIENTO SETENTA Y UNO CON 01/100 SOLES';
     //   $comprobanteElectronico['propiedadesAdicionales'] = $propiedadesAdicionales;
      //  $comprobanteElectronico['razonSocialAdquiriente'] = $cabecera['razonSocialAdquiriente'];//'CONSULTORIA Y ASESORIA EN TECNOLOGIA CONASTEC S.R.L. ';
        $comprobanteElectronico['razonSocialEmisor'] = 'CONGREG. PADRES OBLATOS SAN JOSE DE ASTI';
        $comprobanteElectronico['sumatoriaOtrosCargos'] =$cabecera['sumatoriaOtrosCargos'];// '27.19';
        $comprobanteElectronico['telefonoEmisor'] =$cabecera['telefonoEmisor'];//  '';
      // $comprobanteElectronico['ticket'] = 'false';
        $comprobanteElectronico['totalCargoNoAfecta'] = $cabecera['totalCargoNoAfecta'];// '27.19';
        $comprobanteElectronico['totalIgv'] = $cabecera['totalIgv'];// '21.94';
        $comprobanteElectronico['totalImpuesto'] = $cabecera['totalImpuesto'];// '21.94';
        $comprobanteElectronico['totalIsc'] = $cabecera['totalIsc'];// '0.00';
        $comprobanteElectronico['totalOperacionExportacion'] = $cabecera['totalOperacionExportacion'];// '0.00';
        $comprobanteElectronico['totalOperacionGratuito'] = $cabecera['totalOperacionGratuito'];// '0.00';
        $comprobanteElectronico['totalPrecioVenta'] = $cabecera['totalPrecioVenta'];// '143.82';
        $comprobanteElectronico['totalTributoGratuito'] = $cabecera['totalTributoGratuito'];// '0.00';
        $comprobanteElectronico['totalValorVenta'] =$cabecera['totalValorVenta'];//  '121.88';
        $comprobanteElectronico['totalValorVentaOperacionesExoneradas'] = $cabecera['totalValorVentaOperacionesExoneradas'];// '0.00';
        $comprobanteElectronico['totalValorVentaOperacionesGravadas'] = $cabecera['totalValorVentaOperacionesGravadas'];// '121.88';
        $comprobanteElectronico['totalValorVentaOperacionesInafectas'] = $cabecera['totalValorVentaOperacionesInafectas'];// '0.00';
      //  $comprobanteElectronico['usuario'] = $cabecera['telefonoEmisor'];// 'USUARIO_VALDITEX';
        //$comprobanteElectronico['ventaItinerante'] = $cabecera['telefonoEmisor'];// 'false';

        $enviarComprobante['header'] = $header;
        $enviarComprobante['comprobanteElectronico'] = $comprobanteElectronico;
        $data = ArrayToXml::convert($enviarComprobante, 'enviarComprobante', true, 'UTF-8', '1.0', [], true);
        print_r($data);


        $wsdl = 'https://qa.ebis.pe/SfeWeb/services/ws/sfeServicesNetwork.wsdl'; //URL de nuestro servicio soap
//Basados en la estructura del servicio armamos un array
        $params = Array(
            "data" => $data
        );

        $options = Array(
            "uri" => $wsdl,
            "style" => SOAP_RPC,
            "use" => SOAP_ENCODED,
            "soap_version" => SOAP_1_1,
            "cache_wsdl" => WSDL_CACHE_BOTH,
            "connection_timeout" => 15,
            "trace" => false,
            "encoding" => "UTF-8",
            "exceptions" => false,
            "stream_context" => stream_context_create(
                    array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                        )
                    )
            )
        );

//Enviamos el Request
        $soap = new SoapClient($wsdl, $options);
        $result = $soap->enviarComprobante($params); //Aquí cambiamos dependiendo de la acción del servicio que necesitemos ejecutar
        var_dump($result);








        //////////////////////////////////////////////////

        return $respuesta;
    }

    function adescuentodxctacte($datos) {
        $oLOrden = new LOrden();
//$funcion = '';
        $array = $oLOrden->ldescuentodxctacte($datos);
        $respuesta = $array[0][0];
        return $respuesta;
    }

    public function verificarCajaNoCerrada($datos) {
        $oLOrden = new LOrden();
        $accion = "01";
        $codCaja = $datos["codCaja"];
        $fecha = $datos["fechaHoy"];
        $rs = $oLOrden->spTesoreriaSerieCaja($accion, $codCaja, $fecha);
//var_dump($rs);
        if (isset($rs[0]["estado"]) && $rs[0]["estado"] == 0) {
            $rpta = "ok";
        } else {
            $rpta = "";
        }
        /* $rpta = $rs[0]["estado"];//0 si hay exito, quiere decir que la caja aun no se ha cerrado y se puede cobrar
          if($rpta==0){
          $rpta=1;
          } */
        return $rpta;
    }

    public function cancelarMontoComprobanteFacturacion($datos) {
        $oLOrden = new LOrden();
        $rs = $oLOrden->spCancelarOrdenFacturacion($datos);
        $rpta = $rs[0][0];
//print_r($rs);
        return $rpta;
    }

    public function verificarCajaAperturada($datos) {
        $oLOrden = new LOrden();
        $accion = 1;
        $codCaja = $datos["codCaja"];
        $codTipoComprobante = "";
        $numDocumentosAperturadosHoy = 0;

        $rs = $oLOrden->spSelectCaja($accion, $codCaja, $codTipoComprobante);

        if (isset($rs)) {
            $numDocumentosAperturadosHoy = count($rs);
        } else {
            $numDocumentosAperturadosHoy = 0;
        }
        return $numDocumentosAperturadosHoy;
    }

    public function comprobantesEmitidos($datos) {

        $o_TablaHtmlx = new tablaDHTMLX();
        $oLOrden = new LOrden();
        $arrayFilas = $oLOrden->comprobantesEmitidos($datos);

        $arrayCabecera = array("0" => "Numero", "1" => "Apellidos y Nombre", "2" => "Total", "3" => "Fecha y Hora");
        $arrayTamano = array("0" => "80", "1" => "250", "2" => "100", "3" => "80");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro");
        $arrayAlineacion = array("0" => "center", "1" => "left", "2" => "center", "3" => "center");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function popackEliminacionComprobantePago($datos) {
////mostrarVentanaFacturacionOrdenPaciente($nroOrdenCompra, $codPerPaciente, $nomCompletoPaciente, $dniPaciente, $funcionCerrar){
        $oLOrden = new LOrden();
        $codPerCajero = $datos["codigoEmpleado"]; //
// usurio y total
        $res = $oLOrden->LtotalUsuario($datos["numeroComprobante"]);
        $codCajaFacturacion = $_SESSION["iIdCaja"];
        $indTipoComprobanteSeleccionado = "03"; //Seleccionamos recibo por defecto
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $accion = 1;
        $codTipoComprobante = ""; //No es necesario enviar este parametro porque no lo usa
        $arrayDatos = $oLOrden->spSelectCaja($accion, $codCajaFacturacion, $codTipoComprobante);
        $opcionesCboTipoComprobanteFacturacion = $this->listarOpcionesCboTipoComprobanteFechaHoy($arrayDatos, $indTipoComprobanteSeleccionado);

//Seleccionamos el numero de serie del recibo seleccionado
        $codSerieComprobanteFacturacion = "nada";
        $nroComprobanteFacturacion = "nada";

        if (count($arrayDatos) > 0) {
            foreach ($arrayDatos as $fila) {
                if ($fila["codTipoComprobante"] == $indTipoComprobanteSeleccionado) {
                    $codSerieComprobanteFacturacion = $fila["codSerieComprobante"];
                    $nroComprobanteFacturacion = $fila["nroUltComprobante"];
                    $nroComprobanteFacturacion = $nroComprobanteFacturacion;

                    if (strlen($nroComprobanteFacturacion) < 7) {
                        $numCerosFaltantes = 7 - strlen($nroComprobanteFacturacion);
                        for ($i = 1; $i <= $numCerosFaltantes; $i++) {
                            $nroComprobanteFacturacion = "0" . $nroComprobanteFacturacion;
                        }
                    }
                }
            }
        }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//$numFormato=103;
        $numFormato = 121; //con milisegundos
//$numFormato=120;//canonico
//$numFormato=111;//japon
        $rs = $oLOrden->spListaFechaServidor($numFormato);
        $fechaActualServidor = $rs[0]["fechaServidor"];
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $indFormaPagoSeleccionado = "0001"; //Seleccionamos efectivo por defecto
        $opcionesCboFormaPagoComprobanteFacturacion = $this->listarOpcionesFormasDePago($indFormaPagoSeleccionado);
        require_once("../../cvista/orden/elimanacionComprobantePago.php");
    }

    public function AeliminacionComprobantePagoTabla($serieComprobante) {

        $o_TablaHtmlx = new tablaDHTMLX();
        $oLOrden = new LOrden();
        $arrayFilas = $oLOrden->LeliminacionComprobantePagoTabla($serieComprobante);

        $arrayCabecera = array("0" => "Codigo", "1" => "Fecha", "2" => "Afiliacion",
            "3" => "Servicio-Producto", "4" => "Pre-Unit", "5" => "Cantidad", "6" => "Total", "7" => "Estado");
        $arrayTamano = array("0" => "80", "1" => "100", "2" => "150", "3" => "320", "4" => "80", "5" => "80", "6" => "80"
            , "7" => "250");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "ro");
        $arrayAlineacion = array("0" => "center", "1" => "left", "2" => "center", "3" => "left", "4" => "center"
            , "5" => "center", "6" => "center", "7" => "center");
        $arrayHidden = array("0" => "true", "1" => "false", "2" => "false", "3" => "false", "4" => "false", "5" => "false",
            "6" => "false", "7" => "true");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);

//      $o_Html = new Tabla1($arraycabecera, 15, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', '', 5, $arrayTipo, 7, $arrayColorEstado);
    }

    public function AanularComprobanteDePago($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLOrden = new LOrden();
        $arrayFilas = $oLOrden->LanularComprobanteDePago($datos);
    }

    /*
      public function spSelectCaja($accion,$codCaja,$codTipoComprobante){
      $oDOrden = new DOrden();
      $rs = $oDOrden->spSelectCaja($accion,$codCaja,$codTipoComprobante);
      return $rs;
      }
     */

    /* ======================================================================= */
    /* =================================== FIN CAJA ========================== */
    /* ======================================================================= */
}

?>