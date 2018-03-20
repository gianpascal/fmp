<?php
    require_once("../../ccontrol/control/ActionFormulario.php");

    $idsistema = $_REQUEST['p2'];
    $idformulario = $_REQUEST['p3'];
    $nomServ = '%';
    $o_ActionFormulario = new ActionFormulario();
    $htmlFormServ = $o_ActionFormulario->listaFormServ($idsistema,$idformulario,$nomServ);
?>

<form id="formulario_servicio" name="formulario_servicio" action="">
    <div id="divFormularioServicio" style="overflow: auto;">
        <?php echo $htmlFormServ; ?>
    </div>
</form>
