<?php
    require_once("../../ccontrol/control/ActionFormulario.php");

    $idsistema = $_REQUEST['p2'];
    $idpersona = $_REQUEST['p3'];
    $idformulario = $_REQUEST['p4'];

    $o_ActionFormulario = new ActionFormulario();
    $htmlPermisoFormServ = $o_ActionFormulario->listaPermisoFormServ($idsistema,$idformulario,$idpersona);
?>

<form id="perfil_formulario_servicio" name="perfil_formulario_servicio" action="">
    <div id="divPermisoFormularioServicio" style="overflow: auto;">
        <?php echo $htmlPermisoFormServ; ?>
    </div>
</form>
