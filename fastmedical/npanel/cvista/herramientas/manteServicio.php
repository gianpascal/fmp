<?php
    session_start();
    require_once("../../../pholivo/Html.php");//Sólo si necesito el toolbar
    $idServicio = $_REQUEST['p2'];
    $nomServicio = $_REQUEST['p3'];
    $descServicio = $_REQUEST['p4'];
    $imgBoton = $_REQUEST['p5'];
    $imgIcono = $_REQUEST['p6'];
    $accion = $_REQUEST['accion'];
?>
<br/>
<fieldset>
    <form id="mante_servicio" name="mante_servicio" action="">
        <table class="cabecera" cellpadding="2" cellspacing="2" border="0">
            <tr>
                <td align="left">C&oacute;digo</td>
                <td><input type="text" name="idServicio" id="idServicio" value="<?php echo $idServicio?>" class="texto_combo" size="10" tabindex="1" readonly/></td>
            </tr>
            <tr>
                <td align="left">Nombre</td>
                <td><input type="text" name="nombre" id="nombre" value="<?php echo $nomServicio?>" class="texto_combo" size="50" tabindex="2"/></td>
            </tr>
            <tr>
                <td align="left">Descripci&oacute;n</td>
                <td><input type="text" name="descripcion" id="descripcion" value="<?php echo $descServicio?>" class="texto_combo" size="50" tabindex="3"/></td>
            </tr>
            <tr>
                <td align="left">Bot&oacute;n</td>
                <td><input type="text" name="imgBoton" id="imgBoton" value="<?php echo $imgBoton?>" class="texto_combo" size="50" tabindex="4"/></td>
            </tr>
            <tr>
                <td align="left">Icono</td>
                <td><input type="text" name="imgIcono" id="imgIcono" value="<?php echo $imgIcono?>"  class="texto_combo" size="50" tabindex="5"/></td>
            </tr>
            <!--
            <tr>
                <td align="left">Bot&oacute;n</td>
                <td>
                    <a href='#' onclick="CargarVentana('popupMantePerfil','Registro de Perfiles','../permisos/mantePerfil.php?id_sistema=<?php echo $id_sistema?>&accion=insertar','305','180',false,true,'',1,'',10,10,10,10);"><img src="../../../../fastmedical_front/imagen/icono/b_ver_on.gif" alt='Nuevo' title='Nuevo' border='0'/></a>
                </td>
            </tr>
            <tr>
                <td align="left">Icono</td>
                <td>
                    <a href='#' onclick="CargarVentana('popupMantePerfil','Registro de Perfiles','../permisos/mantePerfil.php?id_sistema=<?php echo $id_sistema?>&accion=insertar','305','180',false,true,'',1,'',10,10,10,10);"><img src="../../../../fastmedical_front/imagen/icono/b_ver_on.gif" alt='Nuevo' title='Nuevo' border='0'/></a>
                </td>
            </tr>-->
        </table>
    </form>
</fieldset>
<br/>
<fieldset>
<?php
    $toolbar=new ToollBar("left");
    $toolbar->SetBoton("GRABAR","Grabar","btn","onclick,onkeypress","manteServicio('$accion')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/grabar.png");
    /*if($e!='nuevo')
        $toolbar->SetBoton("NUEVO","Restaurar","btn","onclick,onkeypress","actualizaPwd()",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/restaurar.png");*/
    $toolbar->Mostrar();
?>
</fieldset>