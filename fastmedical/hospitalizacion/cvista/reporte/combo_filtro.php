<?php
require_once('../../ccontrol/control/ActionCita.php');
$_SESSION['path_principal']='../../../';
$o_Cita = new ActionCita();
$tablaCita = $o_Cita->listaCita('01','10826');
?>
<div id="grid_caja" style=" height:250px; width:100%; overflow:auto; vertical-align:top; border:solid #CCCCCC; border-width:0.1em">
    <?php echo $tablaCita;?>
</div>