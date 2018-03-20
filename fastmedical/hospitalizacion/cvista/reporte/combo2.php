<?php
require_once("../../clogica/LOrden.php");
require_once("../../../pholivo/Html.php");
$fecha = date("d/m/Y");
$value = "value='$fecha'";
$o_Orden = new LOrden();
$arrayAfiliacion = $o_Orden->getArrayComboAfiliacion();
$objCombo1 =new Combo($arrayAfiliacion);
$optComboAfiliacion =  $objCombo1->getOptionsHTML('','AFILIACION');
?>
<select name="cboAfiliacion" id="cboAfiliacion" class="combo">
<?php echo $optComboAfiliacion; ?>
</select>
