<?php
require_once("../../ccontrol/control/ActionActoMedico.php");

$o_ActionActoMedico = new ActionActoMedico();

$accion=1;
$nomExamen='%';
$idVersion=29;
$arrayExamenMedico=$o_ActionActoMedico->listaExamenMedico($accion,$nomExamen,$idVersion);
$iIdExamen=275;
//$iIdExamen=29;
$o_ActionActoMedico->getPreordenArbol($arrayExamenMedico,$iIdExamen);

$arbolExamenMedico=$o_ActionActoMedico->getCadenaArbol();

echo $arbolExamenMedico;


/*
$accion=1;
$nomExamen='%';
$arrayExamenMedico=$o_ActionActoMedico->listaExamenMedico($accion,$nomExamen);

$arrayRaizExamen=$o_ActionActoMedico->getArrayRaizArbol($arrayExamenMedico);

$numero=1;
foreach($arrayRaizExamen as $idNodoRaiz => $valor){
    $arrayHijo2=array_reverse($o_ActionActoMedico->getArrayHijoArbol($arrayExamenMedico,$idNodoRaiz),true);
    if($arrayHijo2!=null){
        echo '**********Inicio_Div_Arbol: '.$idNodoRaiz.'**********<br/>';
        $pilaExamen=array();
        array_push($pilaExamen,'vacio'.$idNodoRaiz);
        array_push($pilaExamen,$idNodoRaiz);

        $numElementosPila=count($pilaExamen);

        while($numElementosPila>1){
            $idNodo=array_pop($pilaExamen);
            $numero++;


            $arrayHijo=array_reverse($o_ActionActoMedico->getArrayHijoArbol($arrayExamenMedico,$idNodo),true);

            if($arrayHijo!=null){
                //echo 'Arbolito: '.$idNodo.'<br/>';
                echo 'Raiz: '.$idNodo.'<br/>';
                foreach($arrayHijo as $idNodoHijo => $valor2){
                    array_push($pilaExamen,$idNodoHijo);
                }
            }
            else{
                echo 'Hojita: '.$idNodo.'<br/>';
            }
            $numElementosPila=count($pilaExamen);
        }
        echo '**********Fin_Div_Arbol: '.$idNodoRaiz.'**********<br/><br/>';
    }
    else{
        echo '**********Inicio_Div_Hoja: '.$idNodoRaiz.'**********<br/>';
        echo '**********Fin_Div_Hoja: '.$idNodoRaiz.'**********<br/><br/>';
    }
}
*/
?>
