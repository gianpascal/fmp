<?php

require_once("../../cdatos/DTesoreria.php");

class LTesoreria {

    private $dTesoreria;

    public function __construct() {
        $this->o_dTesoreria = new DTesoreria();
    }

    public function getArrayCarta($ppersona, $pestado, $ptipocarta, $pafiliacion, $pfechaapertura, $pfechacierre) {
        $rs = $this->o_dTesoreria->getArrayCarta($ppersona, $pestado, $ptipocarta, $pafiliacion, $pfechaapertura, $pfechacierre);
        $resultadoArray = array();
        //	$file='inicio_deposito.php';
        $div = 'filtros_cartas';
        while ($fila = pg_fetch_array($rs)) {
            $fila['parametro'] = "myphp','mydiv";
            $fila[1] = $fila[0] . $fila[1];
            array_push($resultadoArray, $fila);
        }
        return $resultadoArray;
    }

    public function getArrayEstadoCarta() {
        $resultadoArray = array('Anulado', 'Abierta', 'Cerrada', 'Todas');
        return $resultadoArray;
    }

    public function getArrayTipoDocumentoCarta() {
        $rs = $this->o_dTesoreria->getArrayDocumentoCarta();
        $resultadoArray = array();
        while ($fila = pg_fetch_array($rs)) {
            $op = $fila[0];
            $resultadoArray[$op] = $fila[1];
        }
        return $resultadoArray;
    }

    public function getTipoDoc() {
        $array1 = array();
        $array = $this->o_dTesoreria->getTipoDoc();
        foreach ($array as $f) {
            $array1[$f[0]] = $f[1];
            unset($f);
        }
        return $array1;
    }

    public function getFiliacion() {
        $array1 = array();
        $array = $this->o_dTesoreria->getFiliacion();
        foreach ($array as $f) {
            $array1[$f[0]] = $f[5];
            unset($f);
        }
        return $array1;
    }

    public function getSelCartaDeposito($p1, $p2) {
        $array = $this->o_dTesoreria->getSelCartaDeposito($p1, $p2);
        return $array;
    }

    public function getSelAdicionalesCarta($p1, $p2) {
        $array = $this->o_dTesoreria->getSelAdicionalesCarta($p1, $p2);
        return $array;
    }

    public function getArrayPersonaOrden($patron, $parametro) {
        $o_DTesoreria = new DTesoreria();
        $rs = $o_DTesoreria->getArrayPersonaOrden($patron, $parametro);
        $resultadoArray = array();
        $resultadoArray = $rs;
        return $resultadoArray;
    }

    public function tipoDocumento() {
        $o_DTesoreria = new DTesoreria();
        $rs = $o_DTesoreria->getArrayTipoDocumento();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = $fila[1];
        }
        return $resultadoArray;
    }

    public function datosPersonales($codigoPersona, $parametro) {
        $o_DTesoreria = new DTesoreria();
        $auxp = '05';
        if ($parametro == '01') {
            $auxp = '07';
        }
        if ($parametro == '02') {
            $auxp = '05';
        }

        $rs = $o_DTesoreria->getArrayDatosPersonales($codigoPersona, $auxp);

        return $rs;
    }

    public function obtenerOrdenes($codigoPersona) {
        $o_DTesoreria = new DTesoreria();
        $array = $o_DTesoreria->getArrayOrdenes($codigoPersona);
        $i = 0;
        $orden = "";
        $auxOrden = "";
        $num; // contador de numero de detalles por numero de ordenes

        foreach ($array as $fila) {
            $eliminar='';
            $estado=$fila[7];
            $fechastr = $array[$i][1];
            $datetime = date_create($array[$i][1]);
            // echo date_format($datetime, 'd/m/Y') . "\n";
            $array[$i][1] = date_format($datetime, 'd/m/y');
            //setlocale(LC_ALL, 'spanish');
            //$array[$i][1] = strftime('%d-%m-%Y', strtotime($fechastr));
            $array[$i][3]=  utf8_decode($array[$i][3]);
            $orden = $array[$i][0];
            if ($auxOrden == $orden) {
                $chekMxctacte = '';
                $array[$i][0] = '';
                $array[$i][1] = '';
                $array[$i][2] = '';
                $num++;
            } else {
                $chekMxctacte = "<input type='checkbox' name='checkOrden' value='" . $orden . "' ";
                $chekMxctacte.="id='" . $orden . "' onclick='seleccionaOrden(this,\"" . $orden . "\")' />";
                $auxOrden = $orden;
                $num = 1;
            }
            $item=$fila['c_item'];
            if($estado==1) {
                $checDxctacte = "<input type='checkbox' name='" . $orden . "' value='".$item."' ";
                $checDxctacte.="id='" . $orden . "-" . $num . "' onclick='seleccionarItem(\"" . $orden . "-" . $num . "\")'  />";
            }else {
                $checDxctacte='';
            }

            if($array[$i][8]!='') {
              // $numeroComprobante =  "<a href='#' style='color: blue;'
              //  onclick=\"EliminacionComprobantePago('".$array[$i][8]. "','" . $codigoPersona. "','" . $orden ."','" . $estado . "');\">".$array[$i][8]."</a>";
                $numeroComprobante=$array[$i][8];
               $eliminar =  "<a href='#' 
                onclick=\"anularComprobantePago('".$array[$i][8]. "');\"><img src='../../../../medifacil_front/imagen/icono/agt_action_fail.png' title='eliminar'/></a>";
            }else {
                $numeroComprobante='';
            }
            if($estado==1) {
               $eliminar =  "<a href='#' 
                onclick=\"anularItem('".$array[$i][9]. "');\"><img src='../../../../medifacil_front/imagen/icono/agt_action_fail.png' title='eliminar'/></a>";
            }
            


//            $numeroComprobante=$array[$i][8];
//            print_r($numeroComprobante);
            $blanco = "";
            array_push($array[$i], $chekMxctacte);
            array_push($array[$i], $checDxctacte);
            array_push($array[$i], $blanco);
            array_push($array[$i], $numeroComprobante);
            array_push($array[$i], $eliminar);
            //print_r($fila);

            $i++;
        }
        return $array;
    }

}
