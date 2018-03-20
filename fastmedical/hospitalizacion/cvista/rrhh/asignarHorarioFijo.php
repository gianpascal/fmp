<?php
$toolbarz=new ToollBar("left");
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <fieldset>
            <table cellpadding="3" cellspacing="3" width="295">
                <tr>
                    <td align="center" colspan="2" height="30"> <?php echo $datos["nomEmpleado"];?></td>
                </tr>
                <tr>
                    <td width="40%">Fecha Inicio :</td>
                    <td width="60%"><input id="txtFechaIni" name="txtFechaIni" value="" onclick="calendarioHtmlx('txtFechaIni')" size="15"></td>
                </tr>
                <tr>
                    <td>Fecha Fin :</td>
                    <td><input id="txtFechaFin" name="txtFechaFin" value="" onclick="calendarioHtmlx('txtFechaFin')" size="15"></td>
                </tr>
                <tr>
                    <td>Turno :</td>
                    <td>
                        <select id="cboTurnoHoras" name="cboTurnoHoras" style=" width: 150px;">
                            <option value=""> - Seleccionar - </option>
                            <?php foreach ($cboTESA as $i => $value) {?>
                            <option value="<?php echo $value[0]."|".$value[2];?>"><?php echo "( ".$value[0]." ) ".$value[1]?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="2">
                        <br>
                        <div style="width: 75px;" align="center">
                        <?php
                            if (isset($_SESSION["permiso_formulario_servicio"][232]["GRABAR_HOR_FIJO_EMP"]) && ($_SESSION["permiso_formulario_servicio"][232]["GRABAR_HOR_FIJO_EMP"]==1)){
                                $toolbarz->SetBoton("grabarHorarioFijo","Grabar","btn","onclick,onkeypress","grabarHorarioFijo()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/grabar.png","","",1);
                                $toolbarz->Mostrar();
                            }
                        ?>
                       </div>
                    </td>
                </tr>
            </table>
        </fieldset>
    </body>
</html>
