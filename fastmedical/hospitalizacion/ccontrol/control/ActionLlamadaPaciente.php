<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("../../clogica/LLlamadaPaciente.php");
//require_once("../../clogica/LLlamadaPaciente.php");
class ActionLlamadaPaciente {

    public function __construct() {

    }

    public function llamadaPaciente(){
        
        require_once("../../cvista/llamadaPaciente/vistaLlamadaPaciente.php");
    }
    public function proyectarPantalla(){

        require_once("../../cvista/llamadaPaciente/vistaProyectarPantalla.php");
    }

    public function verColas($idPantalla){
        $oLLlamadaPaciente = new LLlamadaPaciente();
        $resultado=$oLLlamadaPaciente -> verColas($idPantalla);
        $numero=count($resultado);
        if($numero==0){
           $cadena='x' ;
        }else{
            $cadena=$resultado[0][0]."|".$resultado[0][1];
        }
        
        return $cadena;
    }
    public function creaAccordionLlamadasPacientes(){
        $oLLlamadaPaciente = new LLlamadaPaciente();
        $cabecera = $oLLlamadaPaciente->getListaCabeceraMantPantallas();
        return $cabecera;
        //return $cabecera;
    }
    function mostrarTablaAmbientesFisicosxPantalla($datos) {
        $oLLlamadaPaciente = new LLlamadaPaciente();
        $funcion = '';
        $datos==''?$arrayFilas1 = array():$arrayFilas1 = $oLLlamadaPaciente->listarAmbientesFisicosxPantalla($datos);
        $arrayCabecera 	= array("0"=>"CODIGO AMB. FISICO","1"=>"NOMBRE AMBIENTE FISICO","2"=>"DESCRIPCION","3"=>"...","4"=>"...");
        $arrayTipo=array("0"=>"c","1"=>"c","2"=>"c","3"=>"c","4"=>"h");
        $o_Tabla 	= new Tabla1($arrayCabecera,12,$arrayFilas1,'tablaOrden','filax','filay','filaSeleccionada','OnClick',$funcion,0,$arrayTipo);
        $tablaHTML 	= $o_Tabla->getTabla();
        $row_ini	= "<table width='100%'>";
        $row_fin	="</table>";
        return $row_ini.$tablaHTML.$row_fin;
    }

}
?>
