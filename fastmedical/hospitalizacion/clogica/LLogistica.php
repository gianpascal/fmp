<?php

include_once("../../cdatos/DLogistica.php");

class LLogistica {

    private $dLogistica;

    public function __construct() {
        $this->dLogistica = new DLogistica();
    }

    public function getCategoriasProductos() {
        return $this->dLogistica->getArrayCategorias();
    }

    public function getAfiliaciones() {
        return $this->dLogistica->getArrayAfiliaciones();
    }

    public function getProductos($prod) {
        return $this->dLogistica->getArrayProductos($prod);
    }

    public function CargarPaquetes($datos) {
        return $this->dLogistica->CargarPaquetes($datos);
    }

    public function cargarPreciosServiciosyProductos($cod) {
        return $this->dLogistica->cargarPreciosServiciosyProductos($cod);
    }

    public function lServiciosProgramables() {
        return $this->dLogistica->dServiciosProgramables();
    }

    public function getdetalleStock($prod) {
        return $this->dLogistica->getArrayStock($prod);
    }

    public function getPreciosAfiliaciones($codProd) {
        return $this->dLogistica->getArrayPrecios($codProd);
    }

    public function getDettalleProducto($codProd) {
        return $this->dLogistica->getdetalleProducto($codProd);
    }

    public function getInfoProductos($codProd) {
        return $this->dLogistica->getInfoProductos($codProd);
    }

    public function getOrdenes($c_cod_per) {
        $array = $this->dLogistica->getOrdenes($c_cod_per);
        $i = 0;

        $norden = "";
        $nordenAux = "";
        foreach ($array as $fila) {
            $fechastr = $array[$i][7];
            setlocale(LC_ALL, 'spanish');
            //echo strftime("%A %d %B %Y",strtotime($fechastr));
            $array[$i][7] = strftime('%d %B %Y', strtotime($fechastr));
            $chek = "<input type='checkbox' name='f' value='opción' id='f0' />";
            $editar = "<a href='#' onclick=\"javascript:confirmarEliminarCita();\"><img src='../../../../medifacil_front/imagen/icono/editar.png' title='Editar Orden'/></a>";
            $eliminar = "<a href='#' onclick=\"javascript:confirmarEliminarCita();\"><img src='../../../../medifacil_front/imagen/icono/editdelete.png' title='Eliminar Orden'/></a>";
            $blanco = "";
            array_push($array[$i], $chek);
            array_push($array[$i], $editar);
            array_push($array[$i], $eliminar);
            array_push($array[$i], $blanco);
            //print_r($fila);
            if (i == 1) {
                $norden = $array[$i][5];
                $nordenAux = $array[$i][5];
            } else {
                if ($norden == $array[$i][5]) {
                    
                }
            }


            $i++;
        }
        //print_r($array);
        return $array;
    }

    public function precioServicios($idCentroCostos, $idAfiliaciones) {
        return $this->dLogistica->precioServicios($idCentroCostos, $idAfiliaciones);
    }

    public function getCentroCostos($idCentroCostos) {
        $array = $this->dLogistica->getCentroCostos($idCentroCostos);

        $arrayAux['0'] = '01020609';
        $arrayAux['1'] = "Todas las Consultas";
        $arrayAux['2'] = "1";


        array_unshift($array, $arrayAux);
        return $array;
    }

    public function resultadoPrecioProcedimientos($idFiliacion, $cCostos, $procedimiento, $c_cod_ser_pro) {
        $array = $this->dLogistica->resultadoPrecioProcedimientos($idFiliacion, $cCostos, $procedimiento, $c_cod_ser_pro);

        $i = 0;

        foreach ($array as $fila) {
            $cCodigoProducto = $array[$i][0];
            $nombre = $array[$i][1];
            //echo htmlentities($nombre);
            $precio = $array[$i][3];
            $add = "<a href='#' onclick=\"javascript:agregarProcedimiento('" . $cCodigoProducto . "');\"><img src='../../../../medifacil_front/imagen/icono/nuevo.png' title='Editar Orden'/></a>";
            $codigo = "<input type='hidden' value='" . $cCodigoProducto . "' id='co" . $cCodigoProducto . "' />";
            $nombre = "<input type='hidden' value='" . htmlentities($nombre) . "' id='no" . $cCodigoProducto . "' />";
            $precio = "<input type='hidden' value='" . $precio . "' id='pr" . $cCodigoProducto . "' />";
            $blanco = $codigo . $nombre . $precio;
            array_push($array[$i], $add);

            array_push($array[$i], $blanco);

            $i++;
        }

        return $array;
    }

    public function precioProcedimientosSeleccionado($c_cod_ser_pro, $nombre, $precio, $cadena, $accion) {
        $cadena = utf8_decode($cadena);
        $nombre = utf8_decode($nombre);
        $array2 = array();
        if ($cadena == '') {

            $nro = 0;
            $numFilas = 0;
        } else {
            $array1 = explode("gxxxgr", $cadena);
            $numFilas = count($array1);
            //print_r($array1);

            for ($i = 0; $i < $numFilas - 1; $i++) {
                $array2[$i] = explode("|", $array1[$i]);
                $precio=$array2[$i]['2'];
                $precio="<input type='text' size='7' value='" . $array2[$i]['2'] . "' id='pr" . $array2[$i]['0'] . "' />";
                $array2[$i]['2'] = $precio;
                $cantidad = $array2[$i]['3'];
                $cantidad = "<input type='text' size='3' value='" . $cantidad . "' id='ca" . $array2[$i]['0'] . "' />";
                $array2[$i]['3'] = $cantidad;
                $hcodigo = "<input type='hidden' value='" . $array2[$i]['0'] . "' id='co" . $array2[$i]['0'] . "' />";
                $hnombre = "<input type='hidden' value='" . $array2[$i]['1'] . "' id='no" . $array2[$i]['0'] . "' />";
                //$hprecio = "<input type='hidden' value='" . $array2[$i]['2'] . "' id='pr" . $array2[$i]['0'] . "' />";
                $hnumero = "<input type='hidden' value='" . $array2[$i]['0'] . "' id='nro" . $i . "' />";
                $eliminar = "<a href='#' onclick=\"javascript:eliminarProcedimientoSeleccionado('" . $array2[$i]['0'] . "');\"><img src='../../../../medifacil_front/imagen/icono/borrar.png' title='Borrar Procedimiento'/></a>";
                $array2[$i]['4'] = $eliminar;
                $array2[$i]['5'] = $hcodigo . $hnombre . $hnumero;
            }

            $nro = $numFilas - 1;
        }

        // echo $numFilas;
        // print_r($array2);
        if ($accion == 'add') {
           echo 'Adiciona';
            $hcodigo = "<input type='hidden' value='" . $c_cod_ser_pro . "' id='co" . $c_cod_ser_pro . "' />";
            $hnombre = "<input type='hidden' value='" . $nombre . "' id='no" . $c_cod_ser_pro . "' />";
            $hprecio = "<input type='hidden' value='" . $precio . "' id='pr" . $c_cod_ser_pro . "' />";
            $hnumero = "<input type='hidden' value='" . $c_cod_ser_pro . "' id='nro" . $nro . "' />";
            $cantidad = "<input type='text' size='3' value='1' id='ca" . $c_cod_ser_pro . "' />";
            $eliminar = "<a href='#' onclick=\"javascript:eliminarProcedimientoSeleccionado('" . $c_cod_ser_pro . "');\"><img src='../../../../medifacil_front/imagen/icono/borrar.png' title='Borrar Procedimiento'/></a>";
            $array['0'] = $c_cod_ser_pro;
            $array['1'] = $nombre;
            $array['2'] = $precio;
            $array['3'] = $cantidad;
            $array['4'] = $eliminar;
            $array['5'] = $hcodigo . $hnombre . $hprecio . $hnumero;
            if ($cadena == '') {

                $array2 = $array;
            } else {
                array_push($array2, $array);
            }
        }


        return $array2;
    }

    public function centroCostoXServicio($c_cod_ser_pro) {
        $centroCosto = '';
        $vector = explode("|", $c_cod_ser_pro);
        $array = $this->dLogistica->centroCostoXServicio($vector[0]);
        //print_r($array);
        foreach ($array as $fila) {
            $centroCosto = $array[0][0];
            //echo "ento".$centroCosto;
        }

        return $centroCosto;
    }

    public function comboCategorias() {
        $o_DLogistica = new DLogistica();
        $rs = $o_DLogistica->comboCategorias();
        $resultadoArray = array();

        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    public function comboAfiliaciones() {
        $o_DLogistica = new DLogistica();
        $rs = $o_DLogistica->comboAfiliaciones();
        return $rs;
    }

    public function getTarifasProcedimientosProductos($datos) {
        $o_DLogistica = new DLogistica();
        $rs = $o_DLogistica->getTarifasProcedimientosProductos($datos);

        foreach ($rs as $j => $valuem) {
            $rs[$j][5] = "../../../../medifacil_front/imagen/icono/nuevo.png ^ Agregar";
        }
        return $rs;
    }

// ../../../../medifacil_front/imagen/icono/nuevo.png'
}

?>