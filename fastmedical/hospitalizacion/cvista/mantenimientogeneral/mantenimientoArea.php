<div id="MantenimientoArea">
<div  id ="divInfoAreas" style=" float:left;width:34%; " >
    <fieldset style="margin:1px;width:auto;height:auto;padding: 0px; font-size:14px;">
        <div id="arbolAreas" style="width: 200px;height: 300px; background: #D8F3F9;">

        </div>
    </fieldset>
</div>

<div id="">
</div>


<?php
$comboEstado = array(0 => "Activado", 1 => "Desactivado");
$toolbar0 = new ToollBar("right");
$toolbar1 = new ToollBar("right");
?>

<div style="width:1200px; margin:1px auto; border: #006600 solid">
    <div class="titleform">
        <h1>Mantenimiento de Areas</h1>
    </div>
    <div align="center" style="width:100%;height:50px; font-size: 12px">
    </div>
    <fieldset style="width:80%; margin-left:9.8%;margin-right:9.8%;" align="center">    
        <legend>&nbsp;&nbsp;</legend>    
        <div align="center">
            <fieldset style="width:50%; margin-left:25%;margin-right:25%;" align ="center">
                <legend>&nbsp; Sede &nbsp;</legend>
                <table width="50%" align="center" border="1">
                    <tr  align="center"><td  align="center">seleccionar Sede : </td>
                        <td align="center">
                            <select id="cboSede" name="cboSede" style="width: 110px;" onchange="listaAreaXSede()">
                                <option value="">- Seleccionar -</option>
                                <?php foreach ($comboSucursal as $i => $value) { ?>
                                    <option value="<?php echo $comboSucursal[$i][0] ?>"><?php echo $comboSucursal[$i][14] ?></option>
                                <?php } ?>
                            </select>
                        </td></tr>
                </table>
            </fieldset>
        </div>

        <div align="center" style="width:100%;height:20px; font-size: 12px">
        </div>

        <div  style="width:1000px">
            <div id="divEmpresas" style="width:80%;height:250px; margin-left:9.8%;margin-right:9.8%">
                <input id="hidIdAreaSede" name="hidIdAreaSede" value="" type="text"/>
                <input id="htxtDescripcionSedex" name="htxtDescripcionSedex" value="" type="text"/>
                <input id="htxtDescripcionAreax" name="htxtDescripcionAreax" value="" type="text"/>
                <input id="htxtIdAreax" name="htxtIdAreax" value="" type="text"/>
                <div id="divTablaAreaSede" style="height: 250px; display: none;">
                </div>
            </div><br>                  
        </div>




        <div id="btnNuevaArea" align="center" style="width:50%;height:auto; font-size: 12px; margin-left:25%;margin-right:25%;display: none;">
            <?php
            if (isset($_SESSION["permiso_formulario_servicio"][218]["NUEVA_AREA_POR_SEDE"]) && ($_SESSION["permiso_formulario_servicio"][218]["NUEVA_AREA_POR_SEDE"] == 1)) {
                $toolbar0->SetBoton("NuevaAreaxSucursal", "Nueva Area por Sede", "btn", "onclick,onkeypress", "abrirArea('nuevo')", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/filenew.png", "", "", 1);
                $toolbar0->Mostrar();
            }
            ?>
        </div>

        <div align="center" style="width:100%;height:10px; font-size: 12px">
        </div>

        <div  style="width:1000px">
            <div  id="divSubAreaXAreaXSede" style="width:80%;height:150px; margin-left:9.8%;margin-right:9.8%">
            </div><br>
        </div>

        <div id="btnNueaSubArea" align="center" style="width:50%;height:auto; font-size: 12px; margin-left:25%;margin-right:25%;display: none;">
            <?php
            if (isset($_SESSION["permiso_formulario_servicio"][218]["NUEVA_AREA_POR_SEDE"]) && ($_SESSION["permiso_formulario_servicio"][218]["NUEVA_AREA_POR_SEDE"] == 1)) {
                $toolbar1->SetBoton("NuevaSubAreaxAreaxSucursal", "Nueva Sub Area", "btn", "onclick,onkeypress", "abrirSubArea('nuevo')", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/filenew.png", "", "", 1);
                $toolbar1->Mostrar();
            }
            ?>
        </div>


    </fieldset>

</div>
</div>
