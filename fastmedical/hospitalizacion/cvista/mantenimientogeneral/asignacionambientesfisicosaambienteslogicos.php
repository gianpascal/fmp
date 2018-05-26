
<div style="width:100%;height:auto;">
    <div align="center" style="width:100%;height:5%;"><font color="00028F" class="Estilo9">Asignación de Ambiente Físico</font></div>
    <div align="center" style="width:100%;height:5%;"><font color="00028F" class="Estilo9"><?php echo $datos["nombreAmbienteLogico"]?></font></div>
    <div align="center" style="width:100%;height:auto;">
        <fieldset style="margin:5px;padding:5px;border:none">
            <table>
                <tr>&nbsp;</tr>
                <input  id="hnombreambientelogico" name="hnombreambientelogico" type="hidden" value="<?php echo $datos["nombreAmbienteLogico"]?>"/>
                <input  id="hidambientelogico" name="hidambientelogico" type="hidden" value="<?php echo $datos["codigoAmbienteLogico"]?>"/>
                <tr><td class="Estilo6">Sede</td><td><?php echo $row_sede.$opcionesHTML_01.$row_fin_cb?></td></tr>
                <tr><td class="Estilo6">Ambiente Físico</td><td><div id="div_ambfisicos"><select tabindex=2 id="cboSede" name="cboSede" title="Sede"><option>Seleccionar</option></select></div></td></tr>
                <tr><td class="Estilo6">Actividad</td><td><?php echo $row_actividad.$opcionesHTML_03.$row_fin_cb?></td></tr>
                <tr><td class="Estilo6">Habilitado</td><td><input type="checkbox" id="checkhabilitarAsignacion" name="checkhabilitarAsignacion" checked/></td></tr>
            </table>
        </fieldset>
    </div>
    <div id="divAgregar" align="center"  style="width:100%;height:5%;display: block">
        <?php if($_SESSION["permiso_formulario_servicio"][201]["AGREGAR_AMB_FISICO_X_AMB_LOGICO"]==1) echo "<a href=\"javascript:agregarAmbienteFisicoaAmbienteLogico()\"><img src=\"../../../../fastmedical_front/imagen/btn/b_agregar_on.gif\" alt=\"\"></a>&nbsp;&nbsp;&nbsp;&nbsp;"; ?>
    </div>
</div>
<div id="Div_TablaAsignacionAmbientesLogicos" align="center" style="width:100%;height:50%">
    <div style="width:90%;height:90%">
        <?php echo $row_ini.$tablaHTML.$row_fin?>
    </div>
</div>


