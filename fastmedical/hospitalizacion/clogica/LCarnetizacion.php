<?php

include_once("../../cdatos/DCarnetizacion.php");

class LCarnetizacion {

    public function __construct() {
        
    }

    function LbuscarPersonaCarnetizacion($datos) {
        $o_DCarnetizacion = new DCarnetizacion();
        $resultado = $o_DCarnetizacion->DbuscarPersonaCarnetizacion($datos);


        foreach ($resultado as $key => $value) {
            if ($value[26] == 0) {//resultado
                $resultado[$key][21] = "../../../../medifacil_front/imagen/icono/blank.gif";
                $resultado[$key][27] = 0;
//                array_push($resultado[$key], "../../../../medifacil_front/imagen/icono/blank.gif");
            } else {
                if ($value[8] == null || $value[8] == '') {
                    $resultado[$key][21] = "../../../../medifacil_front/imagen/icono/blank.gif";
                    $resultado[$key][27] = 0;
                } else {
                    //$value[1] codigo persona
                    $nombre_fichero = "../../../../carpetaDocumentos/materialesLaboratorio/fotosCarnet/" . $value[1] . ".JPG";
                    if (file_exists($nombre_fichero)) {//$datos["c_cod_per"] 
                        $resultado[$key][21] = "../../../../medifacil_front/imagen/icono/imprimir.png ^ Imprimir";
                        $resultado[$key][27] = 1;
                    } else {
//            echo "El fichero $nombre_fichero existe";
                        $resultado[$key][21] = "../../../../medifacil_front/imagen/icono/blank.gif";
                        $resultado[$key][27] = 0;
                    }



//                array_push($resultado[$key], "../../../../medifacil_front/imagen/icono/imprimir.png ^ Imprimir");
                }
            }
//print_r($array[$j][6]);
            if ($resultado[$key][3] == '0' || $resultado[$j][3] == '' || $resultado[$j][3] == null) {
                $resultado[$key][3] = "../../../../medifacil_front/imagen/icono/display.png ^ Ver";
//                $resultado[$key][6] = "cxc";
            }
        }

        return $resultado;
    }

//Búsqueda por tipo de documento.
    public function comboTipoDocumento() {
        $o_DCarnetizacion = new DCarnetizacion();
        $rs = $o_DCarnetizacion->comboTipoDocumento();
        return $rs;
    }

//Búsqueda por tipo de certificado.
    public function comboTipoCertifica() {
        $o_DCarnetizacion = new DCarnetizacion();
        $rs = $o_DCarnetizacion->comboTipoCertifica();
        return $rs;
    }

    public function LbuscarPorBotonPersonaCarnetizacion($datos) {
        $o_DCarnetizacion = new DCarnetizacion();
        $rs = $o_DCarnetizacion->DbuscarPorBotonPersonaCarnetizacion($datos);
        $arrayNuevo = array();
        $m = count($rs);
        for ($j = 0; $j < 5; $j++) {
            $arrayNuevo[$j][0] = $j;
            $arrayNuevo[$j][1] = 0;
        }

        foreach ($arrayNuevo as $k => $value) {

            foreach ($rs as $y => $valuey) {
                if ($value[0] == $valuey[0]) {
                    $arrayNuevo[$k][0] = $rs[$y][0];
                    $arrayNuevo[$k][1] = $rs[$y][1];
                }
            }
        }
          return $arrayNuevo;
    }

    public function LbuscarCboCantidadCertificadoPorTipo($datos) {
        $o_DCarnetizacion = new DCarnetizacion();
        $rs = $o_DCarnetizacion->DbuscarCboCantidadCertificadoPorTipo($datos);
        $arrayNuevo = array();
        $m = count($rs);
        for ($j = 0; $j < 5; $j++) {
            $arrayNuevo[$j][0] = $j;
            $arrayNuevo[$j][1] = 0;
        }

        foreach ($arrayNuevo as $k => $value) {

            foreach ($rs as $y => $valuey) {
                if ($value[0] == $valuey[0]) {
                    $arrayNuevo[$k][0] = $rs[$y][0];
                    $arrayNuevo[$k][1] = $rs[$y][1];
                }
            }
        }

        return $arrayNuevo;
    }

//
    public function LcargarComboTipoCertificado() {
        $o_DCarnetizacion = new DCarnetizacion();

        $resultado = $o_DCarnetizacion->DcargarComboTipoCertificado();

        return $resultado;
    }

    public function LactualizarTipoCertificado($datos) {
        $o_DCarnetizacion = new DCarnetizacion();
        $resultado = $o_DCarnetizacion->DactualizarTipoCertificado($datos);
        return $resultado;
    }

    public function LconfirmarImpresion($datos) {
        $o_DCarnetizacion = new DCarnetizacion();
        $resultado = $o_DCarnetizacion->DconfirmarImpresion($datos);
        return $resultado;
    }

    public function LconfirmarEntregado($datos) {
        $o_DCarnetizacion = new DCarnetizacion();
        $resultado = $o_DCarnetizacion->DconfirmarEntregado($datos);
        return $resultado;
    }

    public function LactualizarCertificado($datos) {
        $o_DCarnetizacion = new DCarnetizacion();
        $resultado = $o_DCarnetizacion->DactualizarCertificado($datos);
        return $resultado;
    }

    public function LcargarComboProcedencia() {
        $o_DCarnetizacion = new DCarnetizacion();

        $resultado = $o_DCarnetizacion->DcargarComboProcedencia();

        return $resultado;
    }

    public function LactualizarProcedencia($datos) {
        $o_DCarnetizacion = new DCarnetizacion();
        $resultado = $o_DCarnetizacion->DactualizarProcedencia($datos);

        return $resultado;
    }

}

?>
