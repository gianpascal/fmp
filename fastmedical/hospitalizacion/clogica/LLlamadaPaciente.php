<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
require_once("../../cdatos/DLlamadaPaciente.php");

class LLlamadaPaciente {

    public function __construct() {

    }

    public function verColas($idPantalla){
        $oDLlamadaPaciente = new DLlamadaPaciente();
        $resultado=$oDLlamadaPaciente -> verColas($idPantalla);
        return $resultado;
    }
    function getListaCabeceraMantPantallas() {
        $o_DLlamadaPaciente = new DLlamadaPaciente();
        $resultado = $o_DLlamadaPaciente -> getArrayCabeceraMantPantallas();
        $cadena = "";
        $coma = ",";
        $i=0;
        foreach($resultado as $ind => $valor) {
            $cadena = $cadena."agregarItemLlamadasPacientes('".$valor["iIdPantalla"]."','".$valor["descripcion"]."');";
            if($i == 0){
                $primervalor = $valor["iIdPantalla"];
            }
            $cadena = $cadena."abrirItemLlamadasPacientes('".$primervalor."');";
            $i = $i + 1;
        }

        return $cadena;
    }

    function listarAmbientesFisicosxPantalla($datos) {
        $o_DLlamadaPaciente = new DLlamadaPaciente();
        $resultado =$o_DLlamadaPaciente ->getArrayAmbientesFisicosxPantalla($datos);
        return $resultado;
    }
}
?>