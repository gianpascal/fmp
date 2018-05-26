<?php
    session_start();
    require_once("../../ccontrol/control/ActionFormulario.php");
    require_once("../../../pholivo/Html.php");//Sólo si necesito el toolbar
    $idPerfil = $_REQUEST['p2'];
    $nomPerfil = $_REQUEST['p3'];
    $idSistema = $_REQUEST['id_sistema'];
    $accion = $_REQUEST['accion'];

    $o_ActionFormulario = new ActionFormulario();
    $nomSistema = $o_ActionFormulario->spListaSistema($idSistema);
?>
<br/>
<fieldset>
    <form id="mante_perfil" name="mante_perfil" action="">
        <table class="cabecera" cellpadding="2" cellspacing="2" border="0">
            <tr>
                <td align="left">C&oacute;digo</td>
                <td><input type="text" name="idPerfil" id="idPerfil" value="<?php echo $idPerfil?>" class="texto_combo" size="10" tabindex="1" readonly/></td>
            </tr>
            <tr>
                <td align="left">Nombre</td>
                <td><input type="text" name="nombre" id="nombre" value="<?php echo $nomPerfil?>" class="texto_combo" size="50" tabindex="2"/></td>
            </tr>
            <tr>
                <td align="left">Sistema</td>
                <td><input type="text" name="sistema" id="sistema" value="<?php echo $nomSistema?>" class="texto_combo" size="50" tabindex="3" readonly/></td>
            </tr>
        </table>
        <input type="hidden" name="idSistema" id="idSistema" value="<?php echo $idSistema?>"/>
    </form>
</fieldset>
<br/>
<fieldset>
<?php
    $toolbar=new ToollBar("left");
    $toolbar->SetBoton("GRABAR","Grabar","btn","onclick,onkeypress","mantePerfil('$accion')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/grabar.png");
    $toolbar->Mostrar();
?>
</fieldset>