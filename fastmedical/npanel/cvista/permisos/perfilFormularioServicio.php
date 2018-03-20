<?php
    require_once("../../ccontrol/control/ActionFormulario.php");

    $idsistema = $_REQUEST['p2'];
    $idperfil = $_REQUEST['p3'];
    $idformulario = $_REQUEST['p4'];

    $o_ActionFormulario = new ActionFormulario();
    $htmlPerfFormServ = $o_ActionFormulario->listaPerfFormServ($idsistema,$idperfil,$idformulario);
?>

<form id="perfil_formulario_servicio" name="perfil_formulario_servicio" action="">
    <div id="divPerfilFormularioServicio" style="overflow: auto;">
        <?php echo $htmlPerfFormServ; ?>
    </div>
</form>
