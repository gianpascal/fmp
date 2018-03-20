<?php
require_once("../../clogica/LOrden.php");
require_once("../../../pholivo/Html.php");
require_once("../../../pholivo/Html1.php");
$o_Orden = new LOrden();
$arrayAfiliacion = $o_Orden->getArrayComboAfiliacion();
$objCombo1 =new Combo($arrayAfiliacion);
$optComboAfiliacion =  $objCombo1->getOptionsHTML('','AFILIACION');
echo $optComboAfiliacion;
?>
