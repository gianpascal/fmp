<?php
    session_start();
    require_once("../../ccontrol/control/ActionUsuario.php");
    require_once("../../../pholivo/Html.php");//Sólo si necesito el toolbar

    $idSistema = $_SESSION['iid_sistema'];
    $loginUsuario = $_SESSION['login_user'];
    //$passwordUsuario = $_SESSION['pass_user'];
    $idPersona = $_SESSION['id_persona'];
?>
<br/>
<fieldset>
    <form id="mante_usuario" name="mante_usuario" action="">
        <table class="cabecera" cellpadding="2" cellspacing="2" border="0">
            <tr>
                <td align="left">Usuario</td>
                <td><input type="text" name="loginUsuario" id="loginUsuario" value="<?php echo $loginUsuario?>" class="texto_combo" size="20" readonly/></td>
            </tr>
            <tr>
                <td align="left">Contrase&ntilde;a</td>
                <td><input type="password" name="antPassword" id="antPassword" value="" class="texto_combo" size="20" tabindex="1" onblur="validatePassword()"/></td>
            </tr>
            <tr>
                <td align="left">Nueva Contrase&ntilde;a</td>
                <td><input type="password" name="nuevoPassword" id="nuevoPassword" value="" class="texto_combo" size="20" tabindex="2" readonly/></td>
            </tr>
            <tr>
                <td align="left">Confirmar Contrase&ntilde;a</td>
                <td><input type="password" name="confPassword" id="confPassword" value="" class="texto_combo" size="20" tabindex="3" readonly/></td>
            </tr>
        </table>
        <input type="hidden" name="idSistema" id="idSistema" value="<?php echo $idSistema?>"/>
        <input type="hidden" name="idPersona" id="idPersona" value="<?php echo $idPersona?>"/>
        <input type="hidden" name="validado" id="validado" value=""/>
    </form>
</fieldset>
<br/>
<fieldset>
<?php
    $toolbar=new ToollBar("right");
    $toolbar->SetBoton("GRABAR","Grabar","btn","onclick,onkeypress","validateNewPassword()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/grabar.png");
    $toolbar->Mostrar();
?>
</fieldset>