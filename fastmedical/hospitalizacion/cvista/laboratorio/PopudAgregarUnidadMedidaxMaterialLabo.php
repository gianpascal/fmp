
<?php
$toolbar1 = new ToollBar("center");
$toolbar2 = new ToollBar("center");

//
//$accion = $datos["accion"];
//$sede = $datos["sede"];
//$area = $datos["area"];
//$idSedeempresaArea = $datos["idSedeempresaArea"];
//if (trim($accion) == "EditarCoordinador") {
//  print_r($ListaUnidadDeMedida);
//print_r($opcionesHTMLTipoMaterialesLaboratorio);
//$ListaUnidadDeMedida
//$ListaUnidadDeMedida
?>



<fieldset style="margin:1px;width:95%;height:auto;padding: 0px; font-size:14px;">
    <legend>Agregar Unidad Medida</legend>

    <table width="100%" border="0">

        <tr>
            <td align="left">Tipo</td>

            <td>

                <select name="cboTipoMaterialLaboPopPud" id="cboTipoMaterialLaboPopPud" onchange ="cargarComboUnidadMedidaPopudML();">
                    <option value="">Seleccionar</option>
                    <?php foreach ($ListaUnidadDeMedida as $i => $value) { ?>
                        <option value="<?php echo $value[0] ?>"> <?php echo utf8_encode($value[1]) ?> </option>
                    <?php } ?>
                </select>

            </td>


        </tr>
        <tr>
            <td>
                &nbsp;
            </td>
            <td>
                &nbsp;
            </td>

        </tr>

        <tr>
            <td align="left">Unidad de Medida</td>

            <td>
                <div id="div_UnidadDeMedidaPopud" name="div_UnidadDeMedidaPopud" >
                    <select name="cboUnidadDeMedida123" id="cboUnidadDeMedida123" style="width: 80px;" onchange ="xxx();">
                        <option value="">Seleccionar</option>

                    </select> 
                </div>      
            </td>

        </tr>


<!--        <tr>
            <td><input type="hidden" name="NombreCoordinadorOculto" id="NombreCoordinadorOculto" value="<?php echo $NombreCoordinador ?>" class="texto_combo" size="40"  tabindex="1" readonly/></td>

        </tr>-->

        <tr>
            <td colspan="2">
<!--                <div id="div_EditarDetalleExamenLabo"  style="margin-left: 50% ">-->
                     <div id="div_EditarDetalleExamenLabo"  style="margin-left: 20% ">
                    <?php
                    $toolbar1->SetBoton("AgregarNuevaUnidad", "Agregar Unidad", "btn", "onclick,onkeypress", "agregarNuevoUnidadalMaterialLaboratorioPoppud()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/reload3.png", "", "", 1);
                    $toolbar1->Mostrar();
                    ?>
                </div>

            </td>

        </tr>
        <tr align="center">
            <td colspan="2">
<!--                <td colspan="4" align="center">-->
                <div id="Div_ResultadoDeAgregarNuevaUnidad" align="center" style="width: 100% "></div>
                <!--                <div id="divMsmResultadoEncargado" style="width: 400px;"></div>-->
            </td>
        </tr>


    </table>

</fieldset>
