<?php

require_once ("../../cdatos/DFarmacia.php");
require_once("LPersona.php");

class LFarmacia {

    public function __construct() {
        
    }

    public function getListaControlInternoFarmaciaSOP($datos) {
        $o_DFarmacia = new DFarmacia();
        $resultado = $o_DFarmacia->getArrayControlInternoFarmaciaSOP($datos);
        $j = 0;
        foreach ($resultado as $fila) {
            $imagen1 = "../../../../medifacil_front/imagen/icono/eliminar.gif ^ Eliminar";
            array_push($resultado[$j], $imagen1);
            $j++;
        }
        return $resultado;
    }

    public function getListaPaquetesFarmaceuticosCISOP() {
        $o_DFarmacia = new DFarmacia();
        $resultado = $o_DFarmacia->getArrayPaquetesFarmaceuticosCISOP();
        return $resultado;
    }

    public function asignarPaqueteMedicamentosalPacienteFarmaciaCISOP($datos) {
        $o_DFarmacia = new DFarmacia();
        $resultado = $o_DFarmacia->setPaqueteMedicamentosalPacienteFarmaciaCISOP($datos);
        return $resultado;
    }

    public function asignarProductoalPacienteFarmaciaCISOP($datos) {
        $o_DFarmacia = new DFarmacia();
        $resultado = $o_DFarmacia->setProductoalPacienteFarmaciaCISOP($datos);
        return $resultado;
    }

    public function eliminarProductoalPacienteCISOP($datos) {
        $o_DFarmacia = new DFarmacia();
        $resultado = $o_DFarmacia->deleteProductoalPacienteFarmaciaCISOP($datos);
        return $resultado;
    }

    public function obtenerDatosdelPaqueteAsignadoFarmaciaSOP($datos) {
        $o_DFarmacia = new DFarmacia();
        $resultado = $o_DFarmacia->getDatosdelPaqueteAsignadoFarmaciaSOP($datos);
        return $resultado[0]["respuesta"];
    }

    public function actualizarNuevasCantidadesEntregadasCISOP($datos) {
        $o_DFarmacia = new DFarmacia();
        $resultado = $o_DFarmacia->updateNuevasCantidadesEntregadasCISOP($datos);
        return $resultado[0]["respuesta"];
    }

    public function getListaNuevosProductosCISOP($datos) {
        $o_DFarmacia = new DFarmacia();
        $resultado = $o_DFarmacia->getArrayNuevosProductosCISOP($datos);
        return $resultado;
    }

    public function ObtenerDatosPacienteCISOP($datos) {
        $o_DFarmacia = new DFarmacia();
        $o_LPersona= new LPersona();
        $resultado = $o_DFarmacia->getDatosPacienteCISOP($datos);
        $arreglo = explode("|", $resultado[0]["respuesta"]);
        $arreglo[3] = $o_LPersona ->formatoEdad($arreglo[3]);
        $cadena= $arreglo[0]."|".$arreglo[1]."|".$arreglo[2]."|".$arreglo[3];
        return $cadena;
    }
    public function generarOrdenCuentaCorrienteFarmaciaCISOP($datos){
        $o_DFarmacia = new DFarmacia();
        $resultado = $o_DFarmacia->generarOrdenCuentaCorrienteFarmaciaCISOP($datos);
        return $resultado[0]["respuesta"];        
    }

}

?>
