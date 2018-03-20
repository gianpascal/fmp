<?php
require_once("../../ccontrol/control/ActionAdmision.php");
require_once('../../../pholivo/Html.php');
$p1=11;
$p7='';
$p9=1;
$p_acc='inserted';
//**** COMBO ESTADO CIVIL ****//
$o_ActionAdmision= new ActionAdmision();
$select_ec = $p7==''?"0":$p7;
$estado_civil = "<select name=\"cb_civil\" id=\"cb_civil\">".$o_ActionAdmision->listaEstadoCivil($select_ec)."</select>";
echo $estado_civil;
?>

