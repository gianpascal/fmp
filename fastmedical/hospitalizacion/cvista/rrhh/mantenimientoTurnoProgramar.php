<?php
$toolbar_01=new ToollBar("right");
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <style type="text/css"><!--
            #agregarCodigoATurno {
                position:absolute;
                width:380px;
                height:61px;
                z-index:2;
                left: 120px;
                top: 111px;
                background-color: #FFF;
            }
            #overlayCodigoATurno {
                position:absolute;
                width:610px;
                height:320px;
                z-index:1;
                left: 5px;
                top: 5px;
            }--></style>
    </head>
    <body><br>
        <h2 align="center">Configurar Turnos</h2>
        <div id="overlayCodigoATurno" style="display: none;">
            <div id="agregarCodigoATurno" style="display: none;">
                <fieldset style="font-size: 20px;">
                    <div style="float: right;"><div id="Div_configurarHorarios_close" class="alphacube_close" onclick="$('overlayCodigoATurno').hide();$('agregarCodigoATurno').hide();"> </div></div>
                    <table width="98%">
                        <tr>
                            <td colspan="3" align="center" height="30"><h2>Agregar Turno a Programar</h2></td>
                        </tr>
                        <tr><td><br><td></tr>
                        <tr>
                            <td>Agrega C&oacute;digo :</td>
                            <td><input id="txtIdTurnoProgramar" name="txtIdTurnoProgramar" value=""  style="text-transform: uppercase;"><input id="hidIdTurno" name="hidIdTurno" value="" type="hidden"></td>
                            <td>
                                <?php
                                    if (isset($_SESSION["permiso_formulario_servicio"][221]["AGREGAR_TURNO_A_PROGRAMAR"]) && ($_SESSION["permiso_formulario_servicio"][221]["AGREGAR_TURNO_A_PROGRAMAR"]==1)){
                                        $toolbar_01->SetBoton("CrearTurno","Agregar","btn","onclick,onkeypress","grabarTurnoProgramar()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/grabar.png","","",1);
                                        $toolbar_01->Mostrar();
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" colspan="3"><div id="div_respuesta" style="width: 100%"></div> </td>
                        </tr>
                    </table><br></fieldset>
            </div></div>
        <br>
        <div align="center">
            <div id="divTurnoMaestros" style="width: 90%; height: 250px;" align="center"></div>
        </div>
    </body>
</html>
