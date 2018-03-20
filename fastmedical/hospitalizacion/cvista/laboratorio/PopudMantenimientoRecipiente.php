
<?php
$toolbar01 = new ToollBar("right");
$toolbar02 = new ToollBar("right");
$toolbar03 = new ToollBar("right");
$toolbar04 = new ToollBar("right");
$toolbar05 = new ToollBar("right");
$toolbar06 = new ToollBar("center");


$IdExamenLaboratorio = $datos["IdExamenLaboratorio"];
$NombreExamenLaboratorio = $datos["NombreExamenLaboratorio"];
?>

<fieldset style="margin:1px;width:95%;height:auto;padding: 0px; font-size:14px;">
    <legend>&nbsp; Detalle de la Nueva Muestra &nbsp;</legend>

    <table width="100%" border="0">

        <tr>
            <td align="left">Recipiente </td>
            <td><input type="text" name="txtIdExamen" id="txtIdExamen" value="<?php echo $IdExamenLaboratorio ?>" class="texto_combo" size="10" readonly/></td>
        </tr>

        <tr>
            <td align="left">Nombre </td>
            <td><input type="text" name="txtNombreExamen" id="txtNombreExamen" value="<?php echo $NombreExamenLaboratorio ?>" class="texto_combo" size="80" readonly tabindex="1"/></td>
        </tr>
        <tr>
            <td align="left">Capacidad </td>
            <td><input type="text" name="cboTipoExamen" id="cboTipoExamen" value="<?php echo $area ?>" class="texto_combo" size="40" readonly tabindex="1"/></td>

            <td>


                <div style="" id="modificardiv">

                    <?php
                    $toolbar04->SetBoton("AdjuntarImagenNuevoRecpiente", "Adjuntar ...", "btn", "onclick,onkeypress", " AdjuntarImagenNuevoRecpiente()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/agt_action_success.png", "", "", 1);
                    $toolbar04->Mostrar();
                    ?>


                </div>

            </td>


        </tr>
        
        
        
        <tr>
            
            

<!--<td align="center" width= "50%" height="30">-->
<td align="center"  height="30">

    <?php
    $toolbar06->SetBoton("salir2", "Salir", "btn", "onclick,onkeypress", " salirPopupEditarMantenimientoExamen()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/agt_action_success.png", "", "", 1);
    $toolbar06->Mostrar();
    ?>

</td>


            
            
        </tr>
       
        
    </table>

</fieldset>















<!--


<td align="center" width= "50%" height="30">


    <?php
    //$toolbar06->SetBoton("salirPopupEditarMantenimientoExamen", "Salir", "btn", "onclick,onkeypress", " salirPopupEditarMantenimientoExamen()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/agt_action_success.png", "", "", 1);
    //$toolbar06->Mostrar();
    ?>

</td>-->


<!--

</tr>

</table>




-->

<!--    <tr>
        <td colspan="4" align="center">
            <div id="divResulEncargado" ></div>
            <div id="divMsmResultadoEncargado" style="width: 400px;"></div>
        </td>
    </tr>-->






