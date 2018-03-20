<?php
    require_once("../../ccontrol/control/ActionMantenimientoGeneral.php");
    
    $codAmbienteFisico = $_REQUEST['p2'];
    $nomServicioBasico = "%";
    $o_ActionMantGeneral = new ActionMantenimientoGeneral();
    $htmlAmbFisicoxServBasico = $o_ActionMantGeneral->listaAmbFisicoxServBasico($codAmbienteFisico,$nomServicioBasico);
?>
<form id="ambFisico_servBasico" name="ambFisico_servBasico" action="">
    <div id="divAmbFisicoxServBasico" style="overflow: auto;">
        <?php echo $htmlAmbFisicoxServBasico; ?>
    </div>
</form>
