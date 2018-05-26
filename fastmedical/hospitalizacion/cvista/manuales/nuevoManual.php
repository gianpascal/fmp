<?php
$cboEstado = array(1 => "Activar", 0 => "Desactivar");
?>
<div style="width:99%; margin:1px auto; border: #006600" >
    <div class="titleform">
        <?php if($titulo==''){?>
         <h1>Documentar Nuevo Manual</h1>
         <?php }else{?>
        <h1><?php echo htmlentities($titulo);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; versi&oacute;n v.<?php echo $version;?></h1>
        <?php }?>
    </div>
</div>

<script type="text/javascript">
   /*-------eliminar la instancia de CKEDITOR existente--------*/

if (CKEDITOR.instances['txtCuerpo']) {
CKEDITOR.remove(CKEDITOR.instances['txtCuerpo']);
}
 /*------------------------------------------------------------*/
//  CKEDITOR.replace( 'txtCuerpo',
//                {
//                    fullPage : true
//                });

  editor=CKEDITOR.replace('txtCuerpo',{toolbar : 'Full',fullPage : true});
  editor.Height='400';
   
//  CKFinder.SetupCKEditor( editor, '/ckfinder/' );
</script>
<div style="width:99%; margin:1px auto;">
    <div style="margin-left:40px; margin-right:40px;">
        <fieldset style="width:80%;height:auto;padding: 0px; font-size:14px; margin-right:10px; margin-left: 10px;">
            <legend>&nbsp; Datos del Manual &nbsp;</legend>
            <div style="margin-left:5px; margin-right:5px;">
                <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
                        <td width="15%" height="25">C&oacute;digo Padre :<input type="hidden" name="txtManual" id="txtManual" value="<?php echo $idManual;?>"></td>
                        <td width="45%"><input name="txtPadre" type="text" id="txtPadre" disabled value="<?php echo $idDependencia;?>" size="5">
                        <input name="txtDescripcionPadre" type="text" id="txtDescripcionPadre" disabled value="<?php echo $desc_padre;?>" />
                        <input type="button" name="btnAsignarPadre" id="btnAsignarPadre" style="visibility:<?php echo $btnPadre;?>" value="..." onclick="asignarPadre()" />
                        </td>
                        <td height="15%">C&oacute;digo Jer&aacute;rquico :</td>
                        <td height="25%">
                            <input type="text" name="txtJerarquia" id="txtJerarquia" disabled value="<?php echo $jerarquia;?>">
                        </td>
                    </tr>
                    <tr>
                        <td height="25">T&iacute;tulo :</td>
                        <td colspan="3"><input type="text" name="txtTitulo" id="txtTitulo" size="35" value="<?php echo $titulo;?>"></td>
                    </tr>
                    <tr>
                        <td height="25">Estado :</td>
                        <td colspan="3"><select name="cboEstado" id="cboEstado">
                                <option value="">Seleccionar</option>
                               <?php foreach ($cboEstado as $k => $value) { ?>
                                <option value="<?php echo $k;?>" <?php if($k==$estado){?>selected<?php }?>><?php echo $value;?></option>
                                <?php }?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td height="25">Orden :</td>
                        <td><input type="text" name="txtOrden" id="txtOrden" size="5" value="<?php echo $orden;?>"></td>
                        <td height="25">Versi&oacute;n :</td>
                        <td><input type="text" name="txtVersion" id="txtVersion" size="5" disabled value="<?php echo $version;?>"></td>
                    </tr>
                    <tr>
                        <td height="25">C&oacute;digo Formulario :</td>
                        <td colspan="3">
                            <select name="cboFormulario" id="cboFormulario">
                               <option value="">Seleccionar</option>
                               <?php foreach ($cboFormulario as $descripcion) {?>
                                <option value="<?php echo $descripcion['iid_formulario'];?>" <?php if($descripcion['iid_formulario']==$formulario){?>selected<?php }?>><?php echo $descripcion['vdesc_formulario'];?></option>
                               <?php }?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td height="25">Nivel :</td>
                        <td colspan="3"><input type="text" name="txtNivel" id="txtNivel" size="5" disabled value="<?php echo $nivel;?>"></td>
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
                $contenido = str_replace("cmjl5","?",$contenido);
            }
            ?>
            <textarea id="txtCuerpo" name="txtCuerpo" rows="30" cols="81" style="width:100%">

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
                $toolbar1->SetBoton("GRABAR","Grabar","btn","onclick,onkeypress","nue_actManual('nuevo')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/grabar.png","","",$btnhabil);
                $toolbar1->SetBoton("ACTUALIZAR","Actualizar","btn","onclick,onkeypress","nue_actManual('actualizar')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/reload3.png","","",$btndeshabil);
                $toolbar1->Mostrar();
                ?>
            </td>
            <td width="33%">
                <?php
                $toolbar3=new ToollBar("right");
                $toolbar3->SetBoton("ELIMINAR","Eliminar","btn","onclick,onkeypress","eliminaManual()",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/delete.png","","",$btndeshabil);
                $toolbar3->Mostrar();
                ?>
            </td>
        </tr>
    </table>
</div>
