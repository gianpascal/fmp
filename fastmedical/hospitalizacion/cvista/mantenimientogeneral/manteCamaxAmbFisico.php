<?php
    require_once("../../ccontrol/control/ActionMantenimientoGeneral.php");

    $codAmbienteFisico = $_REQUEST['p2'];
    $nomAmbienteFisico = $_REQUEST['p3'];

    $descCama = "%";
    $o_ActionMantGeneral = new ActionMantenimientoGeneral();
    $htmlCamaxAmbFisico = $o_ActionMantGeneral->listaCamaxAmbFisico($codAmbienteFisico,$descCama);

    $datos=$codAmbienteFisico."|".$nomAmbienteFisico;
    $datos=base64_encode($datos);

?>
<div id="divContenidoMantCamaxAmbFisico">
    <div id="" align="center" style="width:100%; height:10%; background:white; display:block">
        <legend>Ambiente F&iacute;sico <?php echo $nomAmbienteFisico; ?></legend>
    </div>
    <div id="divDatosCamaxAmbFisico" align="center" style="height: 70%;">
        <legend>Camas</legend>
        <div id="divCamaxAmbFisico" style="height: 100%; width: 90%;overflow: auto">
            <?php echo $htmlCamaxAmbFisico; ?>
        </div>
        <input type="hidden" id="hdnCodAmbFisico" name="hdnCodAmbFisico" value="<?php echo $codAmbienteFisico; ?>"/>
    </div>
    <div style="clear:left;width:100%; height: 10%">&nbsp;</div>
    <div id="divAccionesMantCamaxAmbFisico" align="center" style="width:100%;height:10%;background: white;display: block">
        <?php echo "<a href=\"javascript:mostrarMantCamaxAmbFisico2('insertar','$datos');\"><img src=\"../../../../fastmedical_front/imagen/btn/b_nuevo_on.gif \"></a>"; ?>
    </div>
</div>
