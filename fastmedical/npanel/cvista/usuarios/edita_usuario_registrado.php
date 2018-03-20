<br/>
<fieldset>
    <form id="nuevo_usuario" name="nuevo_usuario" action="">
        <table class="cabecera" cellpadding="2" cellspacing="2" border="0">
            <tr>
                <td align="left">TIPO DOCUMENTO</td>
                <td><input type="text" name="abreviatura" id="abreviatura" value="<?php echo $row['3'];?>" class="texto_combo" size="7" tabindex="1" readonly="1"/></td>
            </tr>
            <tr>
                <td align="left">N&Uacute;MERO</td>
                <td><input type="text" name="nro_doc_identidad" id="nro_doc_identidad" value="<?php echo $row['4'];?>" class="texto_combo" size="16" tabindex="2" readonly="1"/></td>
            </tr>
            <tr>
                <td align="left">NOMBRE</td>
                <td><input type="text" name="nombre" id="nombre" value="<?php echo $row['5'];?>"  class="texto_combo" maxlength="50" size="28" tabindex="3" readonly="1"/></td>
            </tr>
            <tr>
                <td align="left">APELLIDO PATERNO</td>
                <td><input type="text" name="apellido_p" id="apellido_p" value="<?php echo $row['6'];?>"  class="texto_combo" maxlength="60" size="50" tabindex="4" readonly="1"/></td>
            </tr>
            <tr>
                <td align="left">APELLIDO MATERNO</td>
                <td><input type="text" name="apellido_m" id="apellido_m" value="<?php echo $row['7'];?>"  class="texto_combo" maxlength="60" size="50" tabindex="5" readonly="1"/></td>
            </tr>
            <tr>
                <td align="left">PERFIL</td>
                <td><select name="id_perfil" id="id_perfil" style="width:170px;"><?php echo $row['100'];?></select></td>
            </tr>
            <tr>
                <td align="left">USUARIO BD</td>
                <td><select name="id_usuariobd" id="id_usuariobd" style="width:120px;"><?php echo $row['101'];?></select></td>
            </tr>
            <tr>
                <td align="left">HABILITAR</td>
                <td><input type="checkbox" name="habilitado_usuario" id="habilitado_usuario" value="1" <?php if($e!='nuevo') echo 'disabled="disabled"';?> /></td>
            </tr>
        </table>
        <input type="hidden" name="idpersona" id="idpersona" value="<?php echo $row['0'];?>" />
        <input type="hidden" name="idsistema" id="idsistema" value="<?php echo $row['8'];?>" />
        <input type="hidden" name="idformula" id="idformula" value="<?php echo $f;?>" />
        <input type="hidden" name="estado" id="estado" value="<?php echo $e;?>" />
    </form>
</fieldset>
<br/>
<fieldset>
<?php
    $toolbar=new ToollBar("left");
    $toolbar->SetBoton("GRABAR","Grabar","btn","onclick,onkeypress","guardaUsuario()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/grabar.png");
    if($e!='nuevo')
        $toolbar->SetBoton("NUEVO","Restaurar","btn","onclick,onkeypress","actualizaPwd()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/restaurar.png");
    $toolbar->Mostrar();
?>		
</fieldset>
