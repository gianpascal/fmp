<?php
    session_start();
    require_once("../../../pholivo/Html.php");//Sólo si necesito el toolbar
    $datosDesencriptados = base64_decode($_REQUEST['datos']);
    $datosSeparados = explode("|",$datosDesencriptados);

    $idSistema = $datosSeparados[0];
    if($idSistema==null || $idSistema=='')
        $idSistema=$_REQUEST['id_sistema'];
    $idForm = $datosSeparados[1];
    $nomForm = $datosSeparados[2];
    $fileForm = $datosSeparados[3];
    $descForm = $datosSeparados[4];
    $nivelForm = $datosSeparados[5];
    $imgForm = $datosSeparados[6];
    $ordenForm = $datosSeparados[7];
    $abrirForm = $datosSeparados[8];
    $habForm = $datosSeparados[9];
    $finalForm = $datosSeparados[10];
    $dependeForm = $datosSeparados[11];
    $accion = $_REQUEST['accion'];
?>
<br/>
<fieldset>
    <form id="mante_formulario" name="mante_formulario" action="">
        <table class="cabecera" cellpadding="2" cellspacing="2" border="0">
            <tr>
                <td align="left">C&oacute;digo</td>
                <td><input type="text" name="idForm" id="idForm" value="<?php echo $idForm?>" class="texto_combo" size="10" tabindex="1" readonly/></td>
            </tr>
            <tr>
                <td align="left">Nombre</td>
                <td><input type="text" name="nomForm" id="nomForm" value="<?php echo $nomForm?>" class="texto_combo" size="50" tabindex="2"/></td>
            </tr>
            <tr>
                <td align="left">Archivo</td>
                <td><input type="text" name="fileForm" id="fileForm" value="<?php echo $fileForm?>" class="texto_combo" size="50" tabindex="3"/></td>
            </tr>
            <tr>
                <td align="left">Descripcion</td>
                <td><input type="text" name="descForm" id="descForm" value="<?php echo $descForm?>" class="texto_combo" size="50" tabindex="4"/></td>
            </tr>
            <tr>
                <td align="left">Nivel</td>
                <td><input type="text" name="nivelForm" id="nivelForm" value="<?php echo $nivelForm?>" class="texto_combo" size="50" tabindex="5"/></td>
            </tr>
            <tr>
                <td align="left">Imagen</td>
                <td><input type="text" name="imgForm" id="imgForm" value="<?php echo $imgForm?>" class="texto_combo" size="50" tabindex="6"/></td>
            </tr>
            <tr>
                <td align="left">Orden</td>
                <td><input type="text" name="ordenForm" id="ordenForm" value="<?php echo $ordenForm?>" class="texto_combo" size="50" tabindex="7"/></td>
            </tr>
            <tr>
                <td align="left">Abrir</td>
                <td><input type="text" name="abrirForm" id="abrirForm" value="<?php echo $abrirForm?>" class="texto_combo" size="50" tabindex="8"/></td>
            </tr>
            <tr>
                <td align="left">Habilitado</td>
                <td><input type="text" name="habForm" id="habForm" value="<?php echo $habForm?>" class="texto_combo" size="50" tabindex="9"/></td>
            </tr>
            <tr>
                <td align="left">Final</td>
                <td><input type="text" name="finalForm" id="finalForm" value="<?php echo $finalForm?>" class="texto_combo" size="50" tabindex="10"/></td>
            </tr>
            <tr>
                <td align="left">Depende</td>
                <td><input type="text" name="dependeForm" id="dependeForm" value="<?php echo $dependeForm?>" class="texto_combo" size="50" tabindex="11"/></td>
            </tr>
        </table>
        <input type="hidden" name="idSistema" id="idSistema" value="<?php echo $idSistema?>"/>
    </form>
</fieldset>
<br/>
<fieldset>
<?php
    $toolbar=new ToollBar("left");
    $toolbar->SetBoton("GRABAR","Grabar","btn","onclick,onkeypress","manteFormulario('$accion')",$_SESSION['path_principal']."../medifacil_front/imagen/icono/grabar.png");
    /*if($e!='nuevo')
        $toolbar->SetBoton("NUEVO","Restaurar","btn","onclick,onkeypress","actualizaPwd()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/restaurar.png");*/
    $toolbar->Mostrar();
?>
</fieldset>