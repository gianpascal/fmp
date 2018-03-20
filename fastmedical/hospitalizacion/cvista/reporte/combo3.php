<?php
require_once("../../ccontrol/control/ActionAdmision.php");
require_once("../../../pholivo/Html.php");
$dep_ubi='01';
$o_ActionAdmision= new ActionAdmision();
$arrayDepartamento=$o_ActionAdmision->listaDatosComboUbigeo(2009,$dep_ubi,'00','00',false);
echo $arrayDepartamento;
?>
