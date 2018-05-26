<?php
$toolbar1=new ToollBar("right");
$toolbar2=new ToollBar("right");
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <table width="600" cellpadding="3" cellspacing="3" align="center">
            <tr>
                <td align="center" >
                    <div id="divLeyendaTurno" style="width: 100%" align="center">
                        <fieldset><legend>&nbsp; Datos de la Leyenda &nbsp;</legend>
                            <form id="formGrabarLeyenda" action="" method="post">
                                <table cellpadding="3" cellspacing="5" width="100%" align="center">
                                    <tr><td colspan="4"><input id="hidIdLeyendaTurno" name="hidIdLeyendaTurno" value="" type="hidden"></td></tr>
                                    <tr>
                                        <td>Nombre : </td>
                                        <td><input id="txtNombre" name="txtNombre" value=""> </td>
                                        <td>Abreviatura : </td>
                                        <td><input id="txtAbreviatura" name="txtAbreviatura" value="" style="text-transform: uppercase;"> </td>
                                    </tr>
                                    <tr>
                                        <td>Descipci&oacute;n :</td>
                                        <td><input id="txtDescripcion" name="txtDescripcion" value="" size="40"></td>
                                        <td>Estado :</td>
                                        <td>
                                            <select id="cboEstado" name="cboEstado" style="width: 90px;">
                                                <option value="1">Activar</option>
                                                <option value="0">Desactivar</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="30" align="center" colspan="4">
                                            <div id="btnGrabar" style="width: 100px">
                                                <?php
                                                $toolbar1->SetBoton("grabarLeyenda","Grabar","btn","onclick,onkeypress","grabarLeyendaTurno('grabar')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/grabar.png","","",1);
                                                $toolbar1->Mostrar();
                                                ?>
                                            </div>
                                            <div id="btnModificar" style="width: 100px; display: none;">
                                                <?php
                                                $toolbar2->SetBoton("modificarLeyenda","Modificar","btn","onclick,onkeypress","grabarLeyendaTurno('modificar')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/modificar.png","","",1);
                                                $toolbar2->Mostrar();
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </fieldset>
                    </div>

                </td>
            </tr>
            <tr>
                <td align="center">
                    <br>
                    <fieldset style="width: 437px"> <h2 align="center" style="height: 20px;">Leyenda de Turnos</h2>
                        <div id="divListaLeyendaTurno" style="width: 435px; height: 200px;" align="center"></div>
                    </fieldset>
                    <br>
                </td>
            </tr>
        </table>
    </body>
</html>
