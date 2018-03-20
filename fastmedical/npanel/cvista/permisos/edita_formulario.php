<fieldset>
    <?php $toolbar->Mostrar();  ?>
</fieldset>
<br/>
<fieldset>
    <input type="hidden" id="hijos" name="hijos" value="<?php echo $hijos ?>" />
    <input type="hidden" id="hermanos" name="hermanos" value="<?php echo $hermanos ?>" />
    <table class="cabecera" >
        <tr>
            <td class="texto_interior" bgcolor="#E4ECF1">C&Oacute;DIGO</td>
            <td class="texto_interior" bgcolor="#E4ECF1"><input type="text" id="id_formulario" name="id_formulario" value="<?php echo $val["iid_formulario"] ?>" class="texto_combo" readonly  /></td>
        </tr>
        <tr class="texto_interior" bgcolor="#E4ECF1">
            <td>NOMBRE</td>
            <td><input type="text" name="nom_formulario" value="<?php echo $val["vnom_formulario"] ?>"  class="texto_combo" size="85" tabindex="0" /></td>
        </tr>
        <tr class="texto_interior" bgcolor="#E4ECF1">
            <td>FILE</td>
            <td><input type="text" name="file_formulario" value="<?php echo $val["vfile_formulario"] ?>"  class="texto_combo" size="85" tabindex="1" /></td>
        </tr>
        <tr class="texto_interior" bgcolor="#E4ECF1">
            <td>DESCRIPCI&Oacute;N</td>
            <td><input type="text" name="desc_formulario" value="<?php echo $val["vdesc_formulario"] ?>"  class="texto_combo" size="85" tabindex="2" /></td>
        </tr>
        <tr class="texto_interior" bgcolor="#E4ECF1">
            <td>ORDEN</td>
            <td>
                <select id="orden_formulario" name="orden_formulario" class="texto_combo" tabindex="4" >
                    <?php echo $cboHnos ?>
                </select>
            </td>
        </tr>
        <tr class="texto_interior" bgcolor="#E4ECF1">
            <td>ABRIR</td>
            <td>
                <select name="abrir_formulario" class="texto_combo" tabindex="6">
                    <option value="_self" >_self</option>
                    <option value="_blank">_blank</option>
                    <option value="_parent">_parent</option>
                    <option value="_top">_top</option>
                </select>
            </td>
        </tr>
        <tr class="texto_interior" bgcolor="#E4ECF1">
            <td>HIDDEN</td>
            <td>
                NIVEL
                <input type="text" name="nivel_formulario" value="<?php echo $val["inivel_formulario"] ?>"  class="texto_combo" size="2" onkeypress="return numbersonly(this, event,'.');" tabindex="3" />
                DEPENDE
                <input type="text" name="depende_formulario" value="<?php echo $val["idepende_formulario"] ?>" class="texto_combo" size="2" onkeypress="return numbersonly(this, event,'.');" tabindex="5" />
                HABILITADO
                <input type="checkbox" name="habilitar_formulario" <?php if($val["bhabilitar_formulario"]==1) echo "checked='checked'" ?> value="1"/>
                FINAL
                <input type="checkbox" name="final_formulario" <?php if($val["bfinal_formulario"]==0) echo "checked='checked'" ?> value="1"/>
            </td>
        </tr>
    </table>
</fieldset>
<br/>
<div id="SubMenuFormulario">
</div>