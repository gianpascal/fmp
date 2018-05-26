<?php
session_start();
require_once("../../../pholivo/Html.php"); //Sólo si necesito el toolbar
// require_once("../../clogica/LMantenimientoGeneral.php");
$accion = $_REQUEST['accion'];

if (isset($_REQUEST['datos'])) {
    $datosDesencriptados = base64_decode($_REQUEST['datos']);
    $datosSeparados = explode("|", $datosDesencriptados);

    $codAmbienteFisico = $datosSeparados[0];
    //$idSedeEmpresa = $datosSeparados[1];
    $nomAmbienteFisico = $datosSeparados[2];
    $descAmbienteFisico = $datosSeparados[3];
    $nombreTipo = $datosSeparados[4];
    $idTipo = $datosSeparados[5];

    $numPisoAmbienteFisico = $datosSeparados[6];
    $anchoAmbienteFisico = $datosSeparados[7];
    $largoAmbienteFisico = $datosSeparados[8];
    $altoAmbienteFisico = $datosSeparados[9];
    $umAmbienteFisico = $datosSeparados[10];
} else {
    $codAmbienteFisico = '';
    $nomAmbienteFisico = '';
    $descAmbienteFisico = '';
    $nombreTipo = '';
    $idTipo = '';
    $numPisoAmbienteFisico = '';
    $anchoAmbienteFisico = '';
    $largoAmbienteFisico = '';
    $altoAmbienteFisico = '';
    $umAmbienteFisico = '';
}

$arrayCombo = array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5); //Array con los pisos
$o_Combo = new Combo($arrayCombo);
$opcionesHTML = $o_Combo->getOptionsHTML($numPisoAmbienteFisico);

$arrayComboTipo = array(1 => "Almacen", 2 => "Consultorio", 3 => "Farmacia", 4 => "Modulo", 5 => "Oficio",6 => "Otros"); //Array con los pisos
$o_ComboTipo = new Combo($arrayComboTipo);
$opcionesHTMLTipo = $o_ComboTipo->getOptionsHTML($idTipo);
?>
<br/>
<fieldset>
    <form id="mante_ambiente_fisico" name="mante_ambiente_fisico" action="">
        <table class="cabecera" cellpadding="2" cellspacing="2" border="0">
            <tr>
                <td align="left">C&oacute;digo</td>
                <td><input type="text" name="codAmbienteFisico" id="codAmbienteFisico" value="<?php echo $codAmbienteFisico ?>" class="texto_combo" size="10" readonly/></td>
            </tr>
            <tr>
                <td align="left">Nombre</td>
                <td><input type="text" name="nomAmbienteFisico" id="nomAmbienteFisico" value="<?php echo $nomAmbienteFisico ?>" class="texto_combo" size="50" tabindex="1" /></td>
            </tr>
            <tr>
                <td align="left">Descripción</td>
                <td><input type="text" name="descAmbienteFisico" id="descAmbienteFisico" value="<?php echo $descAmbienteFisico ?>" class="texto_combo" size="50" tabindex="2"/></td>
            </tr>
            <tr>
                <td align="left">Tipo</td>
                <td>
                    <select name="tipoAmbiente" id="tipoAmbiente">
                        <?php echo $opcionesHTMLTipo; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="left">N&deg; de piso</td>
                <td>
                    <select name="numPisoAmbienteFisico" id="numPisoAmbienteFisico">
                        <?php echo $opcionesHTML; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="left">Ancho</td>
                <td><input type="text" name="anchoAmbienteFisico" id="anchoAmbienteFisico" value="<?php echo $anchoAmbienteFisico ?>" class="texto_combo" size="10" onkeypress="return numbersonly(this, event,'.');" tabindex="3"/>&nbsp;m</td>
            </tr>
            <tr>
                <td align="left">Largo</td>
                <td><input type="text" name="largoAmbienteFisico" id="largoAmbienteFisico" value="<?php echo $largoAmbienteFisico ?>" class="texto_combo" size="10" onkeypress="return numbersonly(this, event,'.');" tabindex="4"/>&nbsp;m</td>
            </tr>
            <tr>
                <td align="left">Alto</td>
                <td><input type="text" name="altoAmbienteFisico" id="altoAmbienteFisico" value="<?php echo $altoAmbienteFisico ?>" class="texto_combo" size="10" onkeypress="return numbersonly(this, event,'.');" tabindex="5"/>&nbsp;m</td>
            </tr>
            <input type="hidden" name="umAmbienteFisico" id="umAmbienteFisico" value="m" class="texto_combo" size="50"/>

        </table>
    </form>
</fieldset>
<br/>
<fieldset>
    <?php
    if ($_SESSION["permiso_formulario_servicio"][202]["GRABAR_AMB_FISICO"] == 1) {
        $toolbar = new ToollBar("right");
        $toolbar->SetBoton("GRABAR", "Grabar", "btn", "onclick,onkeypress", "validarManteAmbienteFisico('$accion')", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/grabar.png");
        /* if($e!='nuevo')
          $toolbar->SetBoton("NUEVO","Restaurar","btn","onclick,onkeypress","actualizaPwd()",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/restaurar.png"); */
        $toolbar->Mostrar();
    }
    ?>
</fieldset>