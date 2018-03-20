<?php

require_once("../../../pholivo/adophp/Adophp.class.php");
require_once("../../../pholivo/Conexion.php");

class DOrden extends Adophp {

    private $dsn;

    public function __construct($dsn = '') {
        $this->dsn = empty($dsn) ? Conexion::getInitDsnMSSQLSimedh() : $dsn;
        parent::__construct('Spanish', $this->dsn);
    }

    /* ======================================================================= */
    /* ====================================== CAJA =========================== */
    /* ======================================================================= */

    public function spListaFechaServidor($numFormato) {
        parent::ConnectionOpen("pnsListaFechaServidor", "dbweb");
        parent::SetParameterSP("numFormato", $numFormato); //Formato: dd/mm/aaaa
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spListaCaja($c_cod_per) {
        parent::ConnectionOpen("pnsListaCaja", "dbweb");
        parent::SetParameterSP("c_cod_per", $c_cod_per);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spCrearCierreTesoreria() {
        parent::ConnectionOpen("pnsCrearCierreTesoreria", "dbweb");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spTesoreriaSerieCaja($accion, $codCaja, $fecha) {
        parent::ConnectionOpen("pnsTesoreriaSerieCaja", "dbweb");
        parent::SetParameterSP("accion", $accion);
        parent::SetParameterSP("codCaja", $codCaja);
        parent::SetParameterSP("fecha", $fecha);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spSelectCaja($accion, $codCaja, $codTipoComprobante) {
        parent::ConnectionOpen("pnsSelectCaja", "dbweb");
        parent::SetParameterSP("accion", $accion);
        parent::SetParameterSP("codCaja", $codCaja);
        parent::SetParameterSP("codTipoComprobante", $codTipoComprobante);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function dDatosComprobante($codCajaFacturacion) {
        parent::ConnectionOpen("pnsSelectCaja", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("codCaja", $codCajaFacturacion);
        parent::SetParameterSP("codTipoComprobante", $codTipoComprobante);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spMantenimientoSerieCaja($datos) {
        parent::ConnectionOpen("pnsMantenimientoSerieCaja", "dbweb");
        parent::SetParameterSP("accion", $datos["accion"]);
        parent::SetParameterSP("c_t_com_p", $datos["codTipoComprobante"]);
        parent::SetParameterSP("c_serie_com_p", $datos["codSerieComprobante"]);
        parent::SetParameterSP("c_id_caja", $datos["codCaja"]);
        parent::SetParameterSP("d_fec_mov", $datos["fechaHoy"]);
        parent::SetParameterSP("c_nro_act", $datos["nroActualSerieComprobante"]);
        parent::SetParameterSP("c_cod_per", $datos["codPerCajero"]);
        parent::SetParameterSP("v_nomusu", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("v_estaci", strtoupper($_SESSION["host"]));
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spListaFormasDePago() {
        parent::ConnectionOpen("pnsListaFormasDePago", "dbweb");
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spListaOrdenFacturacion($accion, $token, $cadenaItem) {
        parent::ConnectionOpen("pnsListaOrdenFacturacion", "dbweb");
        parent::SetParameterSP("accion", $accion);
        parent::SetParameterSP("token", $token);
        parent::SetParameterSP("cadenaItem", $cadenaItem);
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function spCancelarOrdenFacturacion($datos) {
        parent::ConnectionOpen("pnsCancelarOrdenFacturacion", "dbweb");
        parent::SetParameterSP("c_nro_doc", trim($datos["nroOrdenCompra"]));
        //parent::SetParameterSP("c_nro_com_p_1",trim($datos["codCaja"]).trim($datos["codTipoComprobante"]).trim($datos["codSerieComprobante"]).trim($datos["nroComprobante"]));//Llave compuesta concatenando: caja+tipo+serie+numero
        parent::SetParameterSP("c_nro_com_p_1", trim($datos["nroCompletoComprobante"]));
        parent::SetParameterSP("d_fec_emi", $datos["fechaEmision"]); //Formato para insertar datetime
        parent::SetParameterSP("d_fec_venc_3", $datos["fechaEmision"]);
        parent::SetParameterSP("c_cod_per_5", $datos["codPerPaciente"]);
        parent::SetParameterSP("c_cod_pac", $datos["codPerPaciente"]);
        parent::SetParameterSP("c_tipo_pago_6", $datos["codTipoPago"]); //0001: contado otro: credito
        parent::SetParameterSP("valorv", $datos["valorMonto"]);
        parent::SetParameterSP("n_igv", $datos["valorIGV"]); //18
        parent::SetParameterSP("n_impigv", $datos["valorImpuestoIGV"]); //cero en este caso, recibo no cobra igv
        parent::SetParameterSP("n_total_d_7", $datos["valorTotal"]); //es el mismo, ya que igv es cero
        parent::SetParameterSP("n_total_h_8", "0.00"); //no se por que se pone ese numero
        parent::SetParameterSP("n_imp_ret", "0.00"); //no se por que es cero
        parent::SetParameterSP("nimp_rec", $datos["valorTotal"]); //no se, igual al total, sera el numeric la impresion del recibo???
        parent::SetParameterSP("c_com_rela_11", ""); //manda vacio por ahora, no se para que se usa
        parent::SetParameterSP("t_observa_12", $datos["glosaComprobante"]);
        parent::SetParameterSP("fpago", $datos["codFormaPago"]);
        parent::SetParameterSP("TIPO", 1); //REGISTRO EN EMISION DE COMPROBANTE POR VENTA DE PROD O SERVICIOS
        parent::SetParameterSP("vnomusu", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vestaci", strtoupper($_SESSION["host"]));
        parent::SetParameterSP("tipomov", "OV");
        parent::SetParameterSP("cadena", $datos["cadenaItems"]);
        $resultado = parent::executeSPArrayX();
        //var_dump($datos);
        parent::Close();
        return $resultado;
        /*
          parent::ConnectionOpen("pnsCancelarOrdenFacturacion","dbweb");
          parent::SetParameterSP("c_nro_doc","1288740-2011");
          //parent::SetParameterSP("c_nro_com_p_1",trim($datos["codCaja"]).trim($datos["codTipoComprobante"]).trim($datos["codSerieComprobante"]).trim($datos["nroComprobante"]));//Llave compuesta concatenando: caja+tipo+serie+numero
          parent::SetParameterSP("c_nro_com_p_1","28030280137255");
          //parent::SetParameterSP("d_fec_emi",$datos["fechaEmision"]);//Formato para insertar datetime
          parent::SetParameterSP("d_fec_emi","2011-11-15 09:12:05.860");
          //parent::SetParameterSP("d_fec_venc_3",$datos["fechaEmision"]);//Formato para insertar datetime
          parent::SetParameterSP("d_fec_venc_3","2011-11-15 09:12:05.860");
          parent::SetParameterSP("c_cod_per_5","0411453");
          parent::SetParameterSP("c_cod_pac","0411453");
          parent::SetParameterSP("c_tipo_pago_6","0001");//0001: contado otro: credito
          //parent::SetParameterSP("valorv",(double)$datos["valorMonto"]);
          parent::SetParameterSP("valorv",12.50);
          //parent::SetParameterSP("n_igv",(double)$datos["valorIGV"]);//18
          parent::SetParameterSP("n_igv",18.00);
          //parent::SetParameterSP("n_impigv",(double)$datos["valorImpuestoIGV"]);//cero en este caso, recibo no cobra igv
          parent::SetParameterSP("n_impigv",0.00);
          //parent::SetParameterSP("n_total_d_7",(double)$datos["valorTotal"]);//es el mismo, ya que igv es cero
          parent::SetParameterSP("n_total_d_7",12.50);
          parent::SetParameterSP("n_total_h_8",0.00);//no se por que se pone ese numero
          parent::SetParameterSP("n_imp_ret",0.00);//no se por que es cero
          //parent::SetParameterSP("nimp_rec",(double)$datos["valorTotal"]);//no se, igual al total, sera el numeric la impresion del recibo???
          parent::SetParameterSP("nimp_rec",12.50);
          parent::SetParameterSP("c_com_rela_11","");//manda vacio por ahora, no se para que se usa
          parent::SetParameterSP("t_observa_12","esta wada");
          parent::SetParameterSP("fpago","0001");
          parent::SetParameterSP("TIPO",1);//REGISTRO EN EMISION DE COMPROBANTE POR VENTA DE PROD O SERVICIOS
          parent::SetParameterSP("vnomusu","junny");
          parent::SetParameterSP("vestaci","mi_jato");
          parent::SetParameterSP("tipomov","OV");
          var_dump($datos);
          $resultado=parent::executeSPArrayX();
          parent::Close();
          return $resultado; */
    }

    public function comprobantesEmitidos($datos) {
        parent::ConnectionOpen("pnsMantenimientoSerieCaja", "dbweb");
        parent::SetParameterSP("accion", 3);
        parent::SetParameterSP("c_t_com_p", $datos["cboTipobusqueda"]);
        parent::SetParameterSP("c_serie_com_p", $datos["cbocomprobante"]);
        parent::SetParameterSP("c_id_caja", $datos["cb_filtroCajas"]);
        parent::SetParameterSP("d_fec_mov", $datos["txtfecha"]);
        parent::SetParameterSP("c_nro_act", $datos["txtrecibodesde"]);
        parent::SetParameterSP("c_cod_per", $datos["txtrecibohasta"]);
        parent::SetParameterSP("v_nomusu", '');
        parent::SetParameterSP("v_estaci", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function ddescuentodxctacte($datos) {
        parent::ConnectionOpen("pnsMantenimientoDescuento", "dbweb");
        parent::SetParameterSP("accion", '01');
        parent::SetParameterSP("item", $datos["item"]);
        parent::SetParameterSP("nuevoPrecio", $datos["nuevoPrecio"]);
        parent::SetParameterSP("porcentaje", $datos["porcentaje"]);
        parent::SetParameterSP("nuevoTotal", $datos["nuevoTotal"]);
        parent::SetParameterSP("descuento", $datos["descuento"]);
        parent::SetParameterSP("cantidad", $datos["cantidad"]);
        parent::SetParameterSP("precioIncial", $datos["precioIncial"]);
        parent::SetParameterSP("idAutoriza", $datos["idAutoriza"]);
        parent::SetParameterSP("observacion", $datos["observacion"]);
        parent::SetParameterSP("v_nomusu", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("v_estaci", strtoupper($_SESSION["host"]));
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function DeliminacionComprobantePagoTabla($serieComprobante) {
        parent::ConnectionOpen("pnsCancelarComprobantePago", "dbweb");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("tipoComprobanteFacturacion", '');
        parent::SetParameterSP("codSerieComprobanteFacturacion", $serieComprobante);
        parent::SetParameterSP("nroComprobanteFacturacion", '');
        parent::SetParameterSP("codCaja", '');
        parent::SetParameterSP("codPersona", '');
        parent::SetParameterSP("val", '');
        parent::SetParameterSP("v_nomusu", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function DtotalUsuario($numeroComprobante) {
        parent::ConnectionOpen("pnsCancelarComprobantePago", "dbweb");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("tipoComprobanteFacturacion", '');
        parent::SetParameterSP("codSerieComprobanteFacturacion", $numeroComprobante);
        parent::SetParameterSP("nroComprobanteFacturacion", '');
        parent::SetParameterSP("codCaja", '');
        parent::SetParameterSP("codPersona", '');
        parent::SetParameterSP("val", '');
        parent::SetParameterSP("v_nomusu", '');
        parent::SetParameterSP("host", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function DanularComprobanteDePago($datos) {
        parent::ConnectionOpen("pnsCancelarComprobantePago", "dbweb");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("tipoComprobanteFacturacion", '');
        parent::SetParameterSP("codSerieComprobanteFacturacion", $datos["numeroComprobante"]);
        parent::SetParameterSP("nroComprobanteFacturacion", '');
        parent::SetParameterSP("codCaja", '');
        parent::SetParameterSP("codPersona", $datos["codigoEmpleado"]);
        parent::SetParameterSP("val", 'Anulación');
        parent::SetParameterSP("v_nomusu", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("host", strtoupper($_SESSION["host"]));
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    /* ======================================================================= */
    /* =================================== FIN CAJA ========================== */
    /* ======================================================================= */

    //GENERAR ORDEN - SAYES

    public function dobtenerAfiliacionPersona($datos) {
        parent::ConnectionOpen("pnsGenerarOrden", "dbweb");
        parent::SetParameterSP("bus", '2');
        parent::SetParameterSP("pv1", $datos["codPersona"]);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function verificarPaquete($datos) {
        parent::ConnectionOpen("pnsGenerarOrden", "dbweb");
        parent::SetParameterSP("bus", '4');
        parent::SetParameterSP("pv1", $datos["idnuevo"]);
        parent::SetParameterSP("pv2", $datos["CodigoAfilili"]);
        parent::SetParameterSP("pv3", "");
        parent::SetParameterSP("pv4", "");
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dgetArrayProductos($afil, $pro) {
        parent::ConnectionOpen("pnsGenerarOrden", "dbweb");
        parent::SetParameterSP("bus", "1");
        parent::SetParameterSP("pv1", $afil);
        parent::SetParameterSP("pv2", $pro);
        parent::SetParameterSP("pv3", $_SESSION['host']);
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    public function tablaActoMedico($Cod) {
        parent::ConnectionOpen("pnsGenerarOrden", "dbweb");
        parent::SetParameterSP("bus", "3");
        parent::SetParameterSP("pv1", $Cod);
        parent::SetParameterSP("pv2", "");
        parent::SetParameterSP("pv3", "");
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    public function dgrabarOrgenGenerada($datos) {
        parent::ConnectionOpen("pnsInsertarOrdenMedico", "dbweb");
        parent::SetParameterSP("pv1", $datos["CodigoPer"]);
        parent::SetParameterSP("pv2", $_SESSION['login_user']);
        parent::SetParameterSP("pv3", $_SESSION['host']);
        parent::SetParameterSP("pv4", "");
        parent::SetParameterSP("pv5", $datos["CodActoMedico"]);
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    public function grabarDetalleOrgenGenerada($datos) {
        parent::ConnectionOpen("pnsInsertarDetalleCtaCorriente", "dbweb");
        parent::SetParameterSP("pv1", $datos["CodigoAfil"]);
        parent::SetParameterSP("pv2", $datos["CodigoDetalle"]);
        parent::SetParameterSP("pv3", $datos["CodigoPer"]);
        parent::SetParameterSP("pv4", $datos["codigoPro"]);
        parent::SetParameterSP("pv5", 100);
        parent::SetParameterSP("pv6", $datos["precio"]);
        parent::SetParameterSP("pv7", $datos["cantidad"]);
        parent::SetParameterSP("pv8", $datos["total"]);
        parent::SetParameterSP("pv9", 1);
        parent::SetParameterSP("pv10", "");
        parent::SetParameterSP("pv11", $_SESSION['login_user']);
        parent::SetParameterSP("pv12", $_SESSION['host']);
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    public function dAnularItem($datos){
        
        parent::ConnectionOpen("pnsAnularOrden", "dbweb");
        parent::SetParameterSP("pv1", $datos["item"]);
        parent::SetParameterSP("pv11", $_SESSION['login_user']);
        parent::SetParameterSP("pv12", $_SESSION['host']);
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    public function dDatosPersona($c_cod_per) {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '36');
        parent::SetParameterSP("$2", $c_cod_per);
        parent::SetParameterSP("$3", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dPagarOrdenes($datos) {
        parent::ConnectionOpen("pnsPagos", "dbweb");
        parent::SetParameterSP("$1", '01');
        parent::SetParameterSP("$2", $datos['iIdCajaComprobante']);
        parent::SetParameterSP("$3", $datos['c_cod_per']);
        parent::SetParameterSP("$4", $datos['cIdTipoDocumento']);
        parent::SetParameterSP("$5", $datos['iIdFormaPago']);
        parent::SetParameterSP("$6", $datos['nBaseImponible']);
        parent::SetParameterSP("$7", $datos['nIgv']);
        parent::SetParameterSP("$8", $datos['nTotal']);
        parent::SetParameterSP("$9", $datos['vNumeroDocumento']);
        parent::SetParameterSP("$10", $datos['dFechaEmision']);
        parent::SetParameterSP("$11", $datos['vNumeroComprobante']);
        parent::SetParameterSP("$12", $datos['vSerie']);
        parent::SetParameterSP("$13", $datos['cadenaTotales']);
        parent::SetParameterSP("$14", $datos['cadenaDescuento']);
        parent::SetParameterSP("$15", $datos['cadenaiIdPuestoEmpleado']);
        parent::SetParameterSP("$16", $datos['cadenaPorcentaje']);
        parent::SetParameterSP("$17", $datos['cadenaNuevoPrecio']);
        parent::SetParameterSP("$18", $datos['cadenaCantidad']);
        parent::SetParameterSP("$19", $datos['cadenaNuevoTotal']);
        parent::SetParameterSP("$20", $datos['cadenaItems']);
        parent::SetParameterSP("$21", $datos['cadenaObservacion']);       
        parent::SetParameterSP("$22", $_SESSION['login_user']);
        parent::SetParameterSP("$23", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

}
