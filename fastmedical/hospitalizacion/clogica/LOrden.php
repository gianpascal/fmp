<?php

require_once("../../cdatos/DOrden.php");
require_once("../../centidad/EPaciente.php");
require_once("../../centidad/EProducto.php");

class LOrden {

    private $o_Dorden;

    function __construct() {
        $this->o_Dorden = new DOrden();
    }

    function getArrayComboAfiliacion() {
        $rs = $this->o_Dorden->getArrayComboAfiliacion();
        return $rs;
    }

    function getArrayComboCategoriaProductos() {
        $rs = $this->o_Dorden->getArrayComboCategoriaProductos();
        return $rs;
    }

    function getArrayComboEstadoOrden() {
        $rs = $this->o_Dorden->getArrayComboEstadoOrden();
        return $rs;
    }

    function getArrayOrdenesPaciente($ePaciente, $filtro = array()) {
        $arrayOrdenes = $this->o_Dorden->getArrayOrdenesPaciente($ePaciente, $filtro);
        $arrayOrdenesCheks = array();
        $corden = "";
        foreach ($arrayOrdenes as $i => $fila) {
            if ($corden != $fila[7]) {
                $checkCOrden = array("checkbox", array(7, 7, 'checkCOrden[]', '', 'checkboxOrden', array("onclick"), array("ordenes.oyenteOnClickCheckCOrden"))); //ordenes.oyenteOnClickCheckCOrden
                $corden = $fila[7];
            } else {
                $corden = $fila[7];
                $checkCOrden = "";
                $fila[0] = "";
                $fila[1] = "";
                $fila[2] = "";
            }
            /////Verifica intercambio de Estados////
            $checkDOrden = array("checkbox", array(7, 8, 'checkDOrden[]', '', 'checkboxOrden', array("onclick"), array("ordenes.oyenteOnClickCheckDOrden"))); //ordenes.oyenteOnClickCheckDOrden
            if (in_array($fila[9], array("3", "7", "9"))) {
                $checkCOrden = "";
                $checkDOrden = "";
            }
            $n = count($fila);
            $fila[$n / 2] = $checkCOrden;
            $fila[($n / 2) + 1] = $checkDOrden;
            array_push($arrayOrdenesCheks, $fila);
        }
        return $arrayOrdenesCheks;
    }

    public function getArrayProductos($parametros) {
        $parametros = is_array($parametros) ? $parametros : array();
        $afiliacion = empty($parametros["afiliacion"]) ? "0" : $parametros["afiliacion"];
        $familiaProducto = $parametros["categoria"];
        $patron = trim($parametros["patronBusqueda"]);
        $tipoBusqueda = empty($parametros["opcionBusqueda"]) ? "1" : $parametros["opcionBusqueda"];
        $oDOrden = new DOrden();
        $arrayProductos = $oDOrden->getArrayProductos($patron, $tipoBusqueda, $familiaProducto, $afiliacion);
        return $arrayProductos;
    }

    public function getArrayAgregarProductos($oEProducto) {
        //$patron= $oEProducto->cod_art;
        //$oEProducto = new EProducto();
        $oDOrden = new DOrden();
        $tipoBusqueda = "2";
        $familiaProducto = "";
        $arrayProductos = $oDOrden->getArrayProductos(trim($oEProducto->getCod_art()), $tipoBusqueda, $familiaProducto, trim($oEProducto->getIid_tafiliacion()));
        //var_dump($arrayProductos);
        $arrayProductoFila = $arrayProductos[0];
        //var_export($arrayProductoFila);
        $arrayProducto[0] = $arrayProductoFila[0]; //cod_art
        $arrayProducto[1] = $arrayProductoFila[1]; //nombre_item
        $arrayProducto[2] = number_format($arrayProductoFila[9], 2); //Precio
        $arrayProducto[3] = "1"; //Cantidad
        $arrayProducto[4] = number_format($arrayProductoFila[9], 2); //Total
        $arrayProducto[5] = $arrayProductoFila[12]; //bedita_precio
        //OyenteJS, numColInd, Icono de imagen de Oyente
        $arrayProducto[6] = array("button", array("delete", "0", "../../../../fastmedical_front/imagen/icono/agt_action_fail.png"));
        //$oEProducto
        //var_dump($_SESSION["mantenimiento_productos_ordenes"]);
        $arrayProductosActuales = empty($_SESSION["mantenimiento_productos_ordenes"]) ? array() : $_SESSION["mantenimiento_productos_ordenes"];
        foreach ($arrayProductosActuales as $i => $producto)
            if ($arrayProducto[0] == $producto[0])
                return $arrayProductosActuales;
        //cod_art, cantidad, nombre_item, precio, total, $arrayProductosActuales------------
        array_push($arrayProductosActuales, $arrayProducto);
        return $arrayProductosActuales;
    }

    public function calcularColumnasMantenimientoOrdenes($fila, $numCol) {
        $f = $fila;
        switch ($numCol) {
            case "2":
                $f[4] = number_format($f[3] * $f[2], 2);
                break;
            case "3":
                $f[4] = number_format($f[3] * $f[2], 2);
                break;
        }
        return $f;
    }

    public function actualizarCantidadesProductoOrden($parametros) {
        require_once("../../../pholivo/Html1.php");
        $arrayProductos = Tabla1::actualizarColumnasTabla($parametros, $this, 'calcularColumnasMantenimientoOrdenes');
        $arrayTablaProductos = $_SESSION[$parametros["idTabla"]];
        $oTabla = unserialize($arrayTablaProductos[2]);
        //var_dump($objTabla);
        $oTabla->setArrayFilas($arrayProductos);
        //$_SESSION[$parametros["idTabla"][0]];
        return $oTabla->getTabla($oTabla->getNombre());
    }

    public function grabarNuevaOrden($iid_persona, $iid_tafiliacion) {
        $oDOrden = new DOrden();
        $arrayProductos = $_SESSION["mantenimiento_productos_ordenes"];
        $xproductos = array();
        foreach ($arrayProductos as $f) {
            unset($productos);
            $productos = array();
            $productos[0] = $f[0];
            $productos[1] = $f[3];
            $productos[2] = $f[2];
            $xproductos[] = $productos;
        }
        $cod_oficina = "008";
        return $oDOrden->grabarNuevaOrden($iid_persona, $iid_tafiliacion, $cod_oficina, $xproductos);
    }

    /* ======================================================================= */
    /* ====================================== CAJA =========================== */
    /* ======================================================================= */

    public function spListaFechaServidor($numFormato) {
        $oDOrden = new DOrden();
        $rs = $oDOrden->spListaFechaServidor($numFormato);
        return $rs;
    }

    public function spListaCaja($c_cod_per) {
        $oDOrden = new DOrden();
        $rs = $oDOrden->spListaCaja($c_cod_per);
        if (count($rs) == 1) {
            $numDeCaja = $rs[0]["c_id_caja"];
        } else {
            $numDeCaja = "No tiene";
        }

        return $numDeCaja;
    }
    
    public function lDatosPersona($codPerPaciente){
        $oDOrden = new DOrden();
        $rs = $oDOrden->dDatosPersona($codPerPaciente);
        return $rs;
    }
    
    public function lPagarOrdenes($datos){
        $oDOrden = new DOrden();
        $rs = $oDOrden->dPagarOrdenes($datos);
        return $rs;
    }

        public function spCrearCierreTesoreria() {
        $oDOrden = new DOrden();
        $rs = $oDOrden->spCrearCierreTesoreria();
        return $rs;
    }

    public function spTesoreriaSerieCaja($accion, $codCaja, $fecha) {
        $oDOrden = new DOrden();
        $rs = $oDOrden->spTesoreriaSerieCaja($accion, $codCaja, $fecha);
        return $rs;
    }

    public function spListaSerieComprobante($accion, $codCaja, $codTipoComprobante) {
        $oDOrden = new DOrden();
        $rs = $oDOrden->spSelectCaja($accion, $codCaja, $codTipoComprobante);
        $resultado = array();
        foreach ($rs as $fila) {
            $fila["cadenaDatos"] = trim($fila["codSerieComprobante"]) . "|" . trim($fila["c_nro_act"]);
            array_push($resultado, $fila);
        }
        return $resultado;
    }

    public function spMantenimientoSerieCaja($datos) {
        $oDOrden = new DOrden();
        $rs = $oDOrden->spMantenimientoSerieCaja($datos);
        return $rs;
    }

    public function spSelectCaja($accion, $codCaja, $codTipoComprobante) {
        $oDOrden = new DOrden();
        $rs = $oDOrden->spSelectCaja($accion, $codCaja, $codTipoComprobante);
        return $rs;
    }
    public function lDatosComprobante($codCajaFacturacion) {
        $oDOrden = new DOrden();
        $rs = $oDOrden->dDatosComprobante($codCajaFacturacion);
        return $rs;
    }
    

    public function spListaFormasDePago() {
        $oDOrden = new DOrden();
        $rs = $oDOrden->spListaFormasDePago();
        return $rs;
    }

    public function spListaOrdenFacturacion($accion, $token, $cadenaItem) {
        $oDOrden = new DOrden();
        $resultado = $oDOrden->spListaOrdenFacturacion($accion, $token, $cadenaItem);
        $tablaep = array();
        foreach ($resultado as $i => $value) {

            $resultado[$i]['descuento'] = "../../../../fastmedical_front/imagen/icono/icono_descuento.jpg ^ descuento";
            $resultado[$i]['porcentaje'] = '';
            $resultado[$i]['montoDescuento'] = '0';
            $resultado[$i]['nuevoPrecio'] = $value['n_preunit'];
            $resultado[$i]['nuevoTotal'] = '';
            $resultado[$i]['idPuestoempleado'] = '';
            $resultado[$i]['observacion'] = '';
        }
        return $resultado;
    }

    function ldescuentodxctacte($datos) {
        $oDOrden = new DOrden();
        $resultado = $oDOrden->ddescuentodxctacte($datos);
        return $resultado;
    }

    public function spCancelarOrdenFacturacion($datos) {
        $oDOrden = new DOrden();
        $rs = $oDOrden->spCancelarOrdenFacturacion($datos);
        return $rs;
    }

    public function comprobantesEmitidos($datos) {
        $oDOrden = new DOrden();
        $rs = $oDOrden->comprobantesEmitidos($datos);
        return $rs;
    }

    public function LeliminacionComprobantePagoTabla($serieComprobante) {
        $oDOrden = new DOrden();
        $array = $oDOrden->DeliminacionComprobantePagoTabla($serieComprobante);
        foreach ($array as $i => $fila) {
            $array[$i][0] = $i;
        }
        return $array;
    }

    public function LtotalUsuario($numeroComprobante) {
        $oDOrden = new DOrden();
        $rs = $oDOrden->DtotalUsuario($numeroComprobante);
        return $rs;
    }

    public function LanularComprobanteDePago($datos) {
        $oDOrden = new DOrden();
        $rs = $oDOrden->DanularComprobanteDePago($datos);
        return $rs;
    }

    /* ======================================================================= */
    /* =================================== FIN CAJA ========================== */
    /* ======================================================================= */

    //GENERAR ORDER - SAYES

    public function lobtenerAfiliacionPersona($datos) {
        $oDOrden = new DOrden();
        $resultado = $oDOrden->dobtenerAfiliacionPersona($datos);
        return $resultado;
    }

      public function verificarPaquete($datos) {
        $oDOrden = new DOrden();
        $resultado = $oDOrden->verificarPaquete($datos);
        return $resultado;
    }
    
    
    
    public function lgetProductos($afil, $pro) {
        $oDOrden = new DOrden();
        $resultado = $oDOrden->dgetArrayProductos($afil, $pro);
        foreach ($resultado as $key => $value) {
            array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/agt_upgrade_misc.png ^ Accion");
        }
        return $resultado;
    }

    public function getActoMedico($Cod) {
        $rs = $this->o_Dorden->tablaActoMedico($Cod);
        return $rs;
    }
    
      public function lgrabarOrgenGenerada($datos) {
        $oDOrden = new DOrden();
        $resultado = $oDOrden->dgrabarOrgenGenerada($datos);
        return $resultado;
    }
    
     public function grabarDetalleOrgenGenerada($datos) {
        $oDOrden = new DOrden();
        $resultado = $oDOrden->grabarDetalleOrgenGenerada($datos);
        return $resultado;
        
    }
    public function lAnularItem($datos) {
        $oDOrden = new DOrden();
        $resultado = $oDOrden->dAnularItem($datos);
        return $resultado;
        
    }
    

}

