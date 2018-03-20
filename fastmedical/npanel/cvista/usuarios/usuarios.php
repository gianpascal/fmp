<form id="frm_usuarios" name="usuarios" method="get" action="" onsubmit="return false">
    <fieldset>
        <legend>Buscar</legend>
        <table width="100" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td>Opción:</td>
                <td>
                    <select name="p2" id="p2">
                        <option value="1">Nombres y Apellidos</option>
                        <option value="2">Documento de Identidad</option>
                        <option value="3">Codigo de Persona</option>
                    </select>
                </td>
                <td>&nbsp;</td>
                <td>
                    <input type="text" name="p3" id="p3" onkeypress="usuariosDHab(event)" />
                </td>
            </tr>
        </table>
        <input type="hidden" value="<?php echo $_REQUEST['p1'] ?>" name="p1" id="p1" />
        <input type="hidden" value="<?php echo $_REQUEST['op'] ?>" name="op" id="op" />
        <input type="hidden" value="<?php echo $_REQUEST['id_sistema'] ?>" name="id_sistema" id="id_sistema" />
        <input type="hidden" value="<?php echo $_REQUEST['id_formulario'] ?>" name="id_formulario" id="id_formulario" />
    </fieldset>
    <br/>
    <fieldset>
        <div id="div_usuario" style="height:300px; overflow: auto;"></div>
    </fieldset>
</form>