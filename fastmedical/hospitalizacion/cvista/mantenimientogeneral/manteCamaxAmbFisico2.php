<?php
    require_once("../../ccontrol/control/ActionMantenimientoGeneral.php");

    $datosDesencriptados = base64_decode($_REQUEST['datos']);
    $datosSeparados = explode("|",$datosDesencriptados);

    $codAmbienteFisico = $datosSeparados[0];
    $nomAmbienteFisico = $datosSeparados[1];
    $accion = $_REQUEST['accion'];

    if($accion=="actualizar"){
        $idCama=$datosSeparados[2];
        $numCama=$datosSeparados[3];
        $descCama=$datosSeparados[4];
    }
    else{
        $o_ActionMantGeneral = new ActionMantenimientoGeneral();
        $ultimoNumCamaxAmbFisico = $o_ActionMantGeneral->getUltimoNumCamaxAmbFisico($codAmbienteFisico);

        $idCama="";
        $numCama=$ultimoNumCamaxAmbFisico+1;
        $descCama="";
    }
?>
<div id="divContenidoMantCamaxAmbFisico2">
    <div id="" align="center" style="width:100%;height:auto;background: white;display: block">
        <legend>Ambiente F&iacute;sico <?php echo $nomAmbienteFisico; ?></legend>
    </div>
    <br/>
    <div id="divDatosCamaxAmbFisico2" style="height: 60%;">
        <div style="clear:left;width:100%">
            <div style="float:left; width:50%;" >
                <label>N&uacute;mero:</label>
            </div>
            <div style="float:left; width:50%;"><!-- validaIntegers(evento,elemento,dato) -->
                <input type="text" name="txtNumeroCama" id="txtNumeroCama" size ="6" onkeyup="" value="<?php echo $numCama; ?>" readonly/>
            </div>
            <input type="hidden" id="hdnIdCama" name="hdnIdCama" value="<?php echo $idCama; ?>"/>
        </div>
        <div style="clear:left;width:100%">&nbsp;</div>
        <div style="clear:left;width:100%">
            <div style="float:left; width:50%;" >
                <label>Descripci&oacute;n:</label>
            </div>
            <div style="float:left; width:50%;">
                <!--<input type="text" name="txtTemp" id="txtTemp" size ="6" onkeyup="validaDecimal(event,this,'')" value="<?php //echo $temp?>"/>-->
                <textarea id="txaDescripcion" name="txaDescripcion" rows="1" cols="20"><?php echo $descCama; ?></textarea>
            </div>
        </div>
    </div>
    <div id="divAccionesMantCamaxAmbFisico2" align="center" style="width:100%;height:auto;background: white;display: block">
        <?php echo "<a href=\"javascript:manteCamaxAmbFisico('$accion',$codAmbienteFisico);\"><img src=\"../../../../medifacil_front/imagen/btn/b_grabar_on.gif \"></a>"; ?>
    </div>
</div>