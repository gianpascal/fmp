<?php

require_once("../../../pholivo/tablaDHTMLX.php");
require_once("../../../pholivo/Html1.php");
require_once("../../clogica/LLogistica.php");

class ActionLogistica {

    public function listaCategoriasActiva() {
//		$o_LLogistica = new LLogistica();
//		$arrayFilas = $o_LLogistica->getCategoriasProductos();
//                $tabla="cat";
//		$arrayTodo=array(0=>(array(0=>"%", 1=>"TODAS LAS CATEGORIAS",2=>"TOD")));
//		$arrayFilas1 = array_merge($arrayTodo,$arrayFilas);
//		$arraycabecera = array("1"=>"Categorias", "2"=>"Abrev");
//                $arrayColor=array();
//                $o_Tabla = new Tabla1($arraycabecera,1,$arrayFilas1,'tablaOrden','filax','filay','filaSeleccionada','OnClick','onClickCateg',0);
//		return $o_Tabla->getTabla();

        $o_LLogistica = new LLogistica();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $o_LLogistica->getCategoriasProductos();
        $arrayCabecera = array("0" => "Id", "1" => "Categorias", "2" => "Abrev.");
        $arrayTamano = array("0" => "30", "1" => "*", "2" => "40");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro");
        $arrayCursor = array("0" => "default", "1" => "default", "2" => "center");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false");
        $arrayAling = array("0" => "center", "1" => "lefth", "2" => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function listaCategoriasPasiva() {
        $o_LLogistica = new LLogistica();
        $arrayFilas = $o_LLogistica->getCategoriasProductos();
        $tabla = "cat";
        $arrayTodo = array(0 => (array(0 => "%", 1 => "TODAS LAS CATEGORIAS", 2 => "TOD")));
        $arrayFilas1 = array_merge($arrayTodo, $arrayFilas);
        $arraycabecera = array("1" => "Categorias", "2" => "Abrev");
        $arrayColor = array();
        $o_Tabla = new Tabla1($arraycabecera, 1, $arrayFilas1, 'tablaOrden', 'filaxp', 'filayp', '', '', '', 0);
        return $o_Tabla->getTabla();
    }

    public function listaAfiliaciones() {
        $o_LLogistica = new LLogistica();
        $arrayFilas = $o_LLogistica->getAfiliaciones();
        $arrayTodo = array(0 => (array(0 => "TODAS LAS AFILIACIONES", 1 => "%", 2 => "TOD", 3 => "", 4 => "")));
        $arrayNada = array(0 => (array(0 => "SIN AFILIACIONES", 1 => "0000", 2 => "TOD", 3 => "", 4 => "")));
        $arrayFilas1 = array_merge($arrayTodo, $arrayNada);
        $arrayFilas1 = array_merge($arrayFilas1, $arrayFilas);

        $arraycabecera = array("0" => "Lista de Afiliaciones", "1" => "Codigo");
        $o_Html = new Tabla1($arraycabecera, 1, $arrayFilas1, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'OnClick', 'onClickAfiliacion', 1);

        return $o_Html->getTabla();
    }

    public function listaProductos($prod) {
        $o_LLogistica = new LLogistica();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $o_LLogistica->getProductos($prod);
        $arrayCabecera = array("0" => "Id", "1" => "Nombre Producto", "2" => "Tipo.", "3" => "Presentacion", "4" => "");
        $arrayTamano = array("0" => "70", "1" => "*", "2" => "250", "3" => "90", "4" => "20");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro");
        $arrayCursor = array("0" => "default", "1" => "default", "2" => "lefth", "3" => "lefth", "4" => "lefth");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => "false");
        $arrayAling = array("0" => "lefth", "1" => "lefth", "2" => "lefth", "3" => "lefth", "4" => "lefth");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function CargarPaquetes($datos) {
        $o_LLogistica = new LLogistica();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $o_LLogistica->CargarPaquetes($datos);
        $arrayCabecera = array("0" => "Id", "1" => "Nombre Producto", "2" => "Precio.", "3" => "Cantidad", "4" => "Total");
        $arrayTamano = array("0" => "70", "1" => "*", "2" => "50", "3" => "50", "4" => "50");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro");
        $arrayCursor = array("0" => "default", "1" => "default", "2" => "lefth", "3" => "lefth", "4" => "lefth");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => "false");
        $arrayAling = array("0" => "lefth", "1" => "lefth", "2" => "lefth", "3" => "lefth", "4" => "lefth");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    // 

    public function cargarPreciosServiciosyProductos($cod) {
        $o_LLogistica = new LLogistica();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $o_LLogistica->cargarPreciosServiciosyProductos($cod);
        $arrayCabecera = array("0" => "Id", "1" => "Afiliacion", "2" => "Precio");
        $arrayTamano = array("0" => "40", "1" => "*", "2" => "80");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro");
        $arrayCursor = array("0" => "default", "1" => "center", "2" => "center");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false");
        $arrayAling = array("0" => "lefth", "1" => "lefth", "2" => "lefth");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function amostrarDetalleAlmacen($prod) {
        $o_LLogistica = new LLogistica();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $o_LLogistica->getdetalleStock($prod);
        $arrayCabecera = array("0" => "Id", "1" => "Almacen", "2" => "Stock");
        $arrayTamano = array("0" => "60", "1" => "*", "2" => "80");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro");
        $arrayCursor = array("0" => "default", "1" => "center", "2" => "center");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false");
        $arrayAling = array("0" => "lefth", "1" => "lefth", "2" => "lefth");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function precioAfiliaciones($codProd) {

        $o_LLogistica = new LLogistica();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayExp = $o_LLogistica->getPreciosAfiliaciones($codProd);
        $arrayCabecera = array("2" => "Afiliaciones", "3" => "Precio");
        $arrayTamano = array("2" => "30", "3" => "*");
        $arrayTipo = array("2" => "ro", "3" => "ro");
        $arrayCursor = array("2" => "default", "3" => "default");
        $arrayHidden = array("2" => "false", "3" => "false");
        $arrayAling = array("2" => "center", "3" => "lefth");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayExp, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function formdetalleProd($c_cod_ser_pro) {
        $o_LLogistica = new LLogistica();
        $arrayProducto = $o_LLogistica->getDettalleProducto($c_cod_ser_pro);
        //$arrayFilas="hola amigos array";
        require_once("../../cvista/tesoreria/detalleProducto.php");
    }

    public function infoProductos($c_cod_ser_pro) {
        $o_LLogistica = new LLogistica();
        $arrayFilas = $o_LLogistica->getInfoProductos($c_cod_ser_pro);
        $arraycabecera = array("4" => "Descripcion", "1" => "Valor", "2" => "U.M", "3" => "Pres");
        //$arraycabecera = array("1"=>"Codigo","11"=>"Precio","10"=>"Stock","12"=>"Afiliacion");
        $o_Html = new Tabla1($arraycabecera, 15, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', 'getDetalleProducto', 0);
        return $o_Html->getTabla();
    }

    public function muestraDatosCliente($iid_persona) {

        $o_LCita = new LCita();
        $o_Persona = new LPersona();
        $paciente = new EPaciente();
        $resultadoDatosPaciente = $o_LCita->getObjectPacienteCita($iid_persona);
        $resultadoAfiliacionPaciente = $o_Persona->getArrayFiliacionPaciente($iid_persona);
        $paciente->setIid_persona($iid_persona);
        $paciente->setVapellido_pat($resultadoDatosPaciente[0]["v_apepat"]);
        $paciente->setVapellido_mat($resultadoDatosPaciente[0]["v_apemat"]);
        $paciente->setVnombre($resultadoDatosPaciente[0]["v_nomper"]);
        $paciente->setFecha_nacimiento($resultadoDatosPaciente[0]["d_fecnac"]);
        $paciente->setCsexo($resultadoDatosPaciente[0]["b_sexo"]); //Sexo
        $paciente->setTipo_documento($resultadoDatosPaciente[0]["c_iddide"]);
        $paciente->setVnro_doc_identidad($resultadoDatosPaciente[0]["c_ndide"]);
        $paciente->setCid_ubigeo($resultadoDatosPaciente[0]["c_codubi"]);
        $paciente->setVdireccion($resultadoDatosPaciente[0]["v_direc"]);
        $paciente->setAfiliacion($resultadoAfiliacionPaciente[0]["filia"]);
        $paciente->setIid_tafiliacion($resultadoAfiliacionPaciente[0]["v_ult_afil"]);
        $fecha_nacimiento = date("d/m/Y", strtotime($paciente->getFecha_nacimiento()));
        if ($paciente->getCsexo() == 1)
            $sexo = 'HOMBRE'; elseif ($paciente->getCsexo() == 0)
            $sexo = 'MUJER';
        $edadpaciente = $o_Persona->formatoEdad($paciente->getFecha_nacimiento());
        $scriptJS = "pintarDatosPersonasOrden('" . $paciente->getIid_persona() . "','" . $paciente->getAfiliacion() . "','" . $paciente->getVnombre() . "','" . $paciente->getVapellido_pat() . "','" . $paciente->getVapellido_mat() . "','" . $paciente->getVnro_doc_identidad() . "','" . $fecha_nacimiento . "','" . $paciente->getIid_tafiliacion() . "');";

        return $scriptJS;
    }

    public function getOrdenes($c_cod_per) {
        $o_LLogistica = new LLogistica();
        $arrayFilas = $o_LLogistica->getOrdenes($c_cod_per);
        $arrayTipo = array("5" => "c", "7" => "c", "29" => "c", "27" => "c", "23" => "c", "24" => "c", "25" => "c", "51" => "h", "52" => "h", "53" => "h", "54" => "h");
        $arraycabecera = array("51" => "&nbsp;", "5" => "Nro. Orden", "7" => "Fecha", "29" => "Filiacion", "27" => "Concepto", "23" => "Precio", "24" => "Cant", "25" => "Total", "52" => "&nbsp;", "53" => "&nbsp;", "54" => "&nbsp;");
        $arrayColorEstado = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "5");
        //$arraycabecera = array("1"=>"Codigo","11"=>"Precio","10"=>"Stock","12"=>"Afiliacion");
        $o_Html = new Tabla1($arraycabecera, 15, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', 'getDetalleProducto', 5, $arrayTipo, 26, $arrayColorEstado);
        $o_Html->setColumnasOrdenar(array("5", "7", "29", "27", "25"));
        return $o_Html->getTabla();
    }

    public function formBuscardorProductos($parametros) {
        require_once("../../cvista/tesoreria/generaOrdenes.php");
    }

    public function buscarProductos($funcion, $evento, $alto) {
        //$htmlCategoriasActiva = $this->listaCategoriasActiva();
        require_once("../../cvista/tesoreria/busquedaProductos.php");
    }

    public function precioServicio($idCentroCostos, $idAfiliaciones) {
        $o_LLogistica = new LLogistica();
        $arrayFilas = $o_LLogistica->precioServicios($idCentroCostos, $idAfiliaciones);
        $arrayTipo = array("0" => "c", "1" => "c", "3" => "c");
        $arraycabecera = array("0" => "Código", "1" => "Descripción", "3" => "Precio");
        $arrayColorEstado = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "5");
        //$arraycabecera = array("1"=>"Codigo","11"=>"Precio","10"=>"Stock","12"=>"Afiliacion");
        $o_Html = new Tabla1($arraycabecera, 10, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', 'selecctionaProducto', 0, $arrayTipo, 0, $arrayColorEstado);
        $o_Html->setColumnasOrdenar(array("0", "1", "3"));

        return "<fieldset style=\"margin:5px;height:80%;padding:5px;padding-bottom:20px;border-color: #000000\">" . $o_Html->getTabla() . "</fieldset>";
    }

    public function adicionaProcedimientos($c_cod_ser_pro, $idAfiliaciones, $cadena) {
        $o_LLogistica = new LLogistica();
        $idCentroCostos = $o_LLogistica->centroCostoXServicio($c_cod_ser_pro);
        //echo "*********".$idCentroCostos."-----------";
        echo "<input id=\"hiCodigoFiliacionActiva\" type=\"hidden\" value=\"" . $idAfiliaciones . "\"></input>";
        echo "<input id=\"hiCodigoCCostosPrecio\" type=\"hidden\" value=\"" . $idCentroCostos . "\"></input>";
        $tablaSeleccionados = $this->tablaPrecioProcedimientosSeleccionado('', '', '', $cadena, 'delete');
//        $tablaCentroCosto = $this->tablaCentroCostos($idCentroCostos);
//        $tablaPrecioProcedimientos = $this->tablaResultadosPrecioProcedimientos($idAfiliaciones, $idCentroCostos, '', '');
        require_once("../../cvista/tesoreria/adicionarProcedimientos.php");
    }

    public function tablaCentroCostos($idCentroCostos) {
        $o_LLogistica = new LLogistica();
        $arrayFilas = $o_LLogistica->getCentroCostos($idCentroCostos);
        $arrayTipo = array("0" => "c", "1" => "c");
        $arraycabecera = array("0" => "Código", "1" => "C. Costo");
        $arrayColorEstado = array("0" => "3");
        //$arraycabecera = array("1"=>"Codigo","11"=>"Precio","10"=>"Stock","12"=>"Afiliacion");
        $o_Html = new Tabla1($arraycabecera, 10, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', 'seleccionarCentroCosto', 0, $arrayTipo, 2, $arrayColorEstado);
        //$o_Html->setColumnasOrdenar(array("5","7","29","27","25"));
        return $o_Html->getTabla();
    }

    public function tablaResultadosPrecioProcedimientos($idFiliacion, $cCostos, $procedimiento, $c_cod_ser_pro) {
        $o_LLogistica = new LLogistica();
        $arrayFilas = $o_LLogistica->resultadoPrecioProcedimientos($idFiliacion, $cCostos, $procedimiento, $c_cod_ser_pro);
        $arrayTipo = array("4" => "c", "0" => "c", "1" => "c", "3" => "c", "5" => "h", "6" => "h");
        $arraycabecera = array("4" => "Consulta", "0" => "Código", "1" => "Descripción", "3" => "Precio", "5" => "...", "6" => "....");
        $arrayColorEstado = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "5");
        //$arraycabecera = array("1"=>"Codigo","11"=>"Precio","10"=>"Stock","12"=>"Afiliacion");
        $o_Html = new Tabla1($arraycabecera, 7, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', '', 0, $arrayTipo, 0, $arrayColorEstado);
        $o_Html->setColumnasOrdenar(array("0", "1", "3"));

        return "<fieldset style=\"margin:5px;height:120px;padding:5px;padding-bottom:20px;border-color: #000000\">" . $o_Html->getTabla() . "</fieldset>";
    }

    public function tablaPrecioProcedimientosSeleccionado($c_cod_ser_pro, $nombre, $precio, $cadena, $accion) {
        $o_LLogistica = new LLogistica();
        $arrayFilas = $o_LLogistica->precioProcedimientosSeleccionado($c_cod_ser_pro, $nombre, $precio, $cadena, $accion);
        //print_r($arrayFilas);
        $arrayTipo = array("0" => "c", "1" => "c", "2" => "h", "3" => "h", "4" => "h", "5" => "h");
        $arraycabecera = array("0" => "Código", "1" => "Descripción", "2" => "Precio", "3" => "Can.", "4" => "...", "5" => "....");
        $arrayColorEstado = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "5");
        //$arraycabecera = array("1"=>"Codigo","11"=>"Precio","10"=>"Stock","12"=>"Afiliacion");
        $o_Html = new Tabla1($arraycabecera, 3, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', '', 0, $arrayTipo, 0, $arrayColorEstado);
        //$o_Html->setColumnasOrdenar(array("0","1","3"));
        // $hidden="<input id=\"hiCadenaProcedimientos\" type=\"text\" ></input>";
        return "<fieldset style=\"margin:2px;height:70px;padding:2px;padding-bottom:20px;border-color: #000000\">" . $o_Html->getTabla() . "</fieldset>";
    }

    public function comboCategorias() {
        $o_LLogistica = new LLogistica();
        $arrayCombo = $o_LLogistica->comboCategorias();
        $o_Combo = new Combo($arrayCombo);
        $optionsHTML = $iId;
        $combo = $o_Combo->getOptionsHTML($optionsHTML);
        $arrayComboM = $o_LLogistica->comboAfiliaciones();
        $o_ComboM = new Combo($arrayComboM);
        $optionsHTML = $iIdM;
        $comboM = $o_ComboM->getOptionsHTML($optionsHTML);
        require_once '../../cvista/tesoreria/consulta_tarifas.php';
    }

    public function abrirPopadConsultaTarifasPaquete() {
        $o_LLogistica = new LLogistica();
        $arrayComboM = $o_LLogistica->comboAfiliaciones();
        require_once '../../cvista/tesoreria/abrirPopadConsultaTarifasPaquete.php';
    }

    public function getTarifasProcedimientosProductos($datos) {
        $o_LLogistica = new LLogistica();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LLogistica->getTarifasProcedimientosProductos($datos);
        $arraycabecera = array(0 => "Consulta", 1 => "Código", 2 => "Descripción", 3 => "Precio", 4 => "...", 5 => "....", 6 => "....");
        $arrayTamano = array(0 => "180", 1 => "80", 2 => "450", 3 => "110", 4 => "90", 5 => "35", 6 => "20");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "img", 6 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "pointer", 6 => "default");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "false", 3 => "false", 4 => "true", 5 => "false", 6 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "center", 4 => "center", 5 => "center", 6 => "center");
        return $o_TablaHtmlx->generaTabla($arraycabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }
  
        public function   agregarProcedimientoNuevoInicio() {
        $o_LLogistica = new LLogistica();
        $o_TablaHtmlx = new tablaDHTMLX();
//        $arrayFilas = $o_LLogistica->getTarifasProcedimientosProductos($datos);
        $arrayFilas= array();
        $arraycabecera = array(0 => "Codigo", 1 => "Descripcion", 2 => "Precio", 3 => "Cant.", 4 => "...", 5 => "....", 6 => "....");
        $arrayTamano = array(0 => "80", 1 => "390", 2 => "60", 3 => "40", 4 => "95", 5 => "35", 6 => "20");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "img", 6 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "pointer", 6 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "true", 5 => "false", 6 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "center", 4 => "center", 5 => "center", 6 => "center");
        return $o_TablaHtmlx->generaTabla($arraycabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }
  
}

?>