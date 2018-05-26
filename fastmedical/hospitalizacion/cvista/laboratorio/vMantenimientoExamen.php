<style type="text/css" >

    .MatLabo{
        font-size: 15px;
        font-weight:bold

    }


</style>
<?php
$toolbar1 = new ToollBar("center");
$toolbar2 = new ToollBar("center");
$toolbar3 = new ToollBar("center");

//$o_Combo = new Combo($datos);
//
//$opcionesHTMLTipoExamenLaboratorio = $o_Combo->getOptionsHTML('', '');
?>

<input type="hidden" id="hIdExamenLaboratorio" name="hIdExamenLaboratorio" value=""/>
<center>
    <div class="titleform">
        <h1>MANTENIMIENTO &nbsp;&nbsp;&nbsp;DE&nbsp;&nbsp;&nbsp;EXAMENES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>
    </div>


    <div id="cabecera" align="center" style="width: 40%;height: 40px; color: #000000;">
        <fieldset style="margin:1px;width:100%;height:40px;padding: 0px; font-size:10px;background-color:#66A738">
<!--            <legend style="font-size:20px;color: black">Buscar Examenes:</legend>-->
            <div align="center">
                <table style="width: 100%" align="center">
                    <tr>
                        <td><div id="divFilter" style="font-weight:bold;width: 100%;font-size: medium;padding-left:15px;color: white">Nombre del Examen : <input id="txtExamenesLaboratorioManteExamen" name="txtExamenesLaboratorioManteExamen" type="text" size="40" style="border-radius:5px; border: 1px solid #CECECE;color:#64825B;font-family:verdana;" onkeyup="buscarExamenesLaboratorioManteExamenes();"/></div>
                        </td>

                    </tr>
                </table>
            </div> 
        </fieldset>
    </div> 

    <div id="parentId1_MantenimientoExamenes" style="position: relative; top: 5px; left: 5px; width: 1100px; height:570px;">
    </div>

    <!--    <div id="parentId2_MantenimientoExamenes"  style="position: relative; top: 5px; left: 5px; width:550px; height:740px;display:none;">
        </div>-->

    <div id="contenedor_Mantenimiento_Tabla_Examenes_Laboratorio" align="center" style="width:500px; height:540px;">

        <div id="Div_MantenimientoTablaExamenesLaboratorio" align="center" style="width:500px; height:520px;">

        </div>

    </div>

    <div id="contenedor_Detalle_del_Examen" align="center" style="width:500px; height:215px;">
        <div id="Detalle_del_Examen" align="center" style="width:500px; height:215px;">

            <fieldset align="center" style="margin:0px;width:95%;padding: 0px;">
                <legend>Detalle del Material</legend>
                <form id="DetalleExamenLaboratorio" name="mante_ambiente_fisico" action="" style="">
                    <table class="cabecera" cellpadding="2" cellspacing="2" border="0" style="padding-left: 15px;" >
                        <tr>
                            <td align="left" class="MatLabo">Nombre : </td>
                            <td><input type="text" name="txtNombreExaLabo" id="txtNombreExaLabo" value="" class="texto_combo" size="55" readonly/></td>
                        </tr>
                        <tr>
                            <td align="left" class="MatLabo">Tipo :</td>
                            <td>

                                <select name="cboTipoExamenLabo" id="cboTipoExamenLabo" disabled="true">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($opcionesHTMLTipoExamenLaboratorio as $i => $value) { ?>
                                        <option value="<?php echo $value[0] ?>"> <?php echo utf8_encode($value[1]) ?> </option>
                                    <?php } ?>
                                </select>


                            </td>
                        </tr>

                        <tr>
                            <td align="left" class="MatLabo">Descripcion :</td>
                            <td>

                                <div style="height: 40%; width:75%; float: left;">
                                    <textarea name="txtDescripcionExaLabo" rows="2" cols="20" id="txtDescripcionExaLabo" style=" width:350px; font-family: sans-serif" readonly onfocus="" onblur="" onkeypress=""></textarea>
                                </div>

                            </td>
                        </tr>
                        <tr  align="center" class="MatLabo">
                            <td colspan="2">
                                <div id="div_EditarDetalleExamenLabo"  style="margin-left: 50% ">
                                    <?php
                                    $toolbar1->SetBoton("EditarDetalleExamenLabo", "Editar", "btn", "onclick,onkeypress", "EditarDetalleExamenLabo()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/reload3.png", "", "", 1);
                                    $toolbar1->Mostrar();
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr  align="center">
                            <td colspan="2">
                                <div id="div_ActualizarDetalleExamenLabo"  style="margin-left: 50%; display: none">
                                    <?php
                                    $toolbar2->SetBoton("ActualizarDetalleExamenLabo", "Actualizar", "btn", "onclick,onkeypress", "ActualizarDetalleExamenLabo()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/reload3.png", "", "", 1);
                                    $toolbar2->Mostrar();
                                    ?>
                                </div>

                            </td> 

                        </tr>
                        <tr>
                            <td colspan="2">
                                <div id='cell52' style="float:right; width:100%;display:none;"></div>
                            </td>

                        </tr>


                    </table>
                </form>

            </fieldset>

        </div>

    </div>

    <div id="contenedor_TablaPreciosExamenesAfiliacion" align="center" style="width:545px; height:320px;">

        <div id="Div_TablaPreciosExamenesAfiliacion" align="center" style="width:545px; height:320px;">

        </div>
    </div>

</center>