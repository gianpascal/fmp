<script type="text/javascript">
    editarTexto();  //esta en javascript/editor_texto/tinyMCE.js
</script>
<div style="width:99%; margin:1px auto; border: #006600" >
    <div class="titleform">
        <h1>Documentar Nuevo Manual</h1>
    </div>
</div>

<div style="width:99%; margin:1px auto;">
    <div style="margin-left:40px; margin-right:40px;">
        <fieldset style="width:70%;height:auto;padding: 0px; font-size:14px; margin-right:10px; margin-left: 40px;">
            <legend>&nbsp; Datos del Manual &nbsp;</legend>
            <div style="margin-left:5px; margin-right:5px;">
                <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="15%" height="25">C&oacute;digo Padre :<input type="hidden" name="txtManual" id="txtManual" value="<?php echo $idManual;?>"></td>
                        <td width="35%"><input type="text" name="txtPadre" id="txtPadre" value="<?php echo $idDependencia;?>"></td>
                        <td height="15%">C&oacute;digo Jer&aacute;rquico :</td>
                        <td height="35%">
                            <input type="text" name="txtJerarquia" id="txtJerarquia" value="<?php echo $jerarquia;?>">
                        </td>
                    </tr>
                    <tr>
                        <td height="25">T&iacute;tulo :</td>
                        <td colspan="3"><input type="text" name="txtTitulo" id="txtTitulo" value="<?php echo $titulo;?>"></td>
                    </tr>
                    <tr>
                        <td height="25">Estado :</td>
                        <td colspan="3"><select name="cboEstado" id="cboEstado">
                                <option value="">Seleccionar</option>
                                <option value="1">Activar</option>
                                <option value="0">Desactivar</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td height="25">Orden :</td>
                        <td><input type="text" name="txtOrden" id="txtOrden" value="<?php echo $orden;?>"></td>
                        <td height="25">Versi&oacute;n :</td>
                        <td><input type="text" name="txtVersion" id="txtVersion" value="<?php echo $version;?>"></td>
                    </tr>
                    <tr>
                        <td height="25">C&oacute;digo Formulario :</td>
                        <td colspan="3"><select name="cboFormulario" id="cboFormulario" style="width:180px;" onChange="validFormSalt('cbo',this,event,'txtNivel');" onkeypress="validFormSalt('cbo',this,event,'txtNivel')">
                                <?php echo $cboFormulario;?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td height="25">Nivel :</td>
                        <td colspan="3"><input type="text" name="txtNivel" id="txtNivel" value="<?php echo $nivel;?>"></td>
                    </tr>
                </table>
            </div>
        </fieldset>
    </div>
    <br/>
    <fieldset style="margin:1px;width:98%;height:auto;padding: 0px; font-size:14px;">
        <legend>&nbsp; Contenido &nbsp;</legend>
        <div>
            <?php
            if($contenido) {
                $contenido = str_replace("clmj0","&",$contenido);
                $contenido = str_replace("ljcm1","'",$contenido);
                $contenido = str_replace("lcmj2","\"",$contenido);
                $contenido = str_replace("jclm3","%",$contenido);
                $contenido = str_replace("mlcj4","#",$contenido);
            }
            ?>
            <textarea id="txtCuerpo" name="txtCuerpo" rows="30" cols="81" style="width: 85%">

             <?php echo $contenido;?>

            </textarea>
        </div>
    </fieldset>
</div>
<br/>
<div>
    <table width="100" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="33%">
                <?php
                $toolbar1=new ToollBar("right");
                $toolbar1->SetBoton("GRABAR","Grabar","btn","onclick,onkeypress","nue_actManual('nuevo')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/grabar.png");
                $toolbar1->Mostrar();
                ?>
            </td>
            <td width="33%">
                <?php
                $toolbar2=new ToollBar("left");
                $toolbar2->SetBoton("ACTUALIZAR","Actualizar","btn","onclick,onkeypress","nue_actManual('actualizar')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/reload3.png");
                $toolbar2->Mostrar();
                ?>
            </td>
            <td width="33%">
                <?php
                $toolbar3=new ToollBar("right");
                $toolbar3->SetBoton("ELIMINAR","Eliminar","btn","onclick,onkeypress","eliminaManual()",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/delete.png");
                $toolbar3->Mostrar();
                ?>
            </td>
        </tr>
    </table>
</div>
