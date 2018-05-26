<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<input name="hiidPuestoEmpleado" type="hidden" id="hiidPuestoEmpleado" value="<?php echo $datos["iidPuestoEmpleado"] ?>"/>
<input name="hFechaProgramada" type="hidden" id="hFechaProgramada" value="<?php echo $datos["vFecha"] ?>"/>
<input name="hiIdTipoProgramacion" type="hidden" id="hiIdTipoProgramacion" value="<?php echo $datos["iIdTipoProgramacion"] ?>"/>


<div align="center">
    <fieldset style="margin:5px;padding:5px;height:auto;width:auto;">
        <table>
            <tr>
                <td>
                    <fieldset style="margin:8px;padding:7px;height:auto;width:auto;">
                        <font color="blue" size="2"><b> <?php echo $datos["vNombreCompleto"] ?></b></font>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <td>
                    <fieldset style="margin:8px;padding:7px;height:auto;width:auto;">
                        <font color="blue" size="2"><b> <?php echo $datos["vFecha"] ?></b></font>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <td>
                    <table cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td height="25">
                                <b>Sede:</b>
                            </td>
                            <td valign="top">
                                <div id="div_cboSede">
                                    <select name="cboSede" id="cboSede" onchange="descripcionCboSedeArea()">
                                        <option value="0">Seleccionar</option>
                                        <?php foreach ($resSede as $i => $value) { ?>
                                            <option value="<?php echo $value[0] ?>"
                                            <?php
                                            if ($resultado[0][2] == $value[0])
                                                echo 'selected';
                                            ?> >
                                                <?php echo $value[1] ?> </option>
                                        <?php } ?>
                                    </select>                                    
                                </div>

                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td  height="25">
                                <b>Area:</b>
                            </td>
                            <td>
                                <div id="div_areaSede">
                                    <select name="cboAreaNuevo" id="cboAreaNuevo" onchange="cboSedeAreasTurnos()">
                                        <?php foreach ($rsAreaSede as $j => $valuea) { ?>
                                            <option value="<?php echo $valuea[1] ?>"
                                            <?php
                                            if ($resultado[0][1] == $valuea[1])
                                                echo 'selected';
                                            ?> >
                                                <?php echo utf8_decode($valuea[0]) ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>
                            <td align="center" style="height: 25px;width: 100px; alignment-adjust: central">Nueva Area:</td>
                            <td> <a href="javascript:verBuscadorAreasRegularizarEmpleado();">
                                    <img border="0" title="Agregar Area" alt="" src="../../../../fastmedical_front/imagen/icono/window_new.png">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td  height="25">
                                <b>Turno:</b>
                            </td>
                            <td  height="25"> 
                                <div id="div_areaSedeTurnos">
                                    <select name="cboidSedeEmpresaAreaTurno" id="cboidSedeEmpresaAreaTurno">
                                        <?php foreach ($rsAreaSedeTurnos as $k => $valuek) { ?>
                                            <option value="<?php echo $valuek[0] ?>">
                                                <?php echo utf8_decode($valuek[1]) ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>
                            <td align="center" height="25">Nuevo Turno</td>
                            <td>
                                <a href="javascript:agregarTurnoEmporesaAreaPersona();">
                                    <img border="0" title="Otra Turno" alt="" src="../../../../fastmedical_front/imagen/icono/window_new.png">
                                </a>
                            </td>
                        </tr>
                        <tr> 
                            <td height="25">Motivo de la Re-Programacion: </td> 
                            <td valign="top"> 
                                <select name="cboidMotivoReProgramacion" id="cboidMotivoReProgramacion"> 
                                    <?php foreach ($resultadoMotivoReProgramacion as $m => $valuem) { ?>
                                        <option value="<?php echo $valuem[0] ?>"><?php echo $valuem[1] ?></option>      
                                    <?php } ?>
                                </select>   
                            </td> 
                            <td></td> 
                        </tr>
                        <tr> 
                            <td height="25">Observacion: </td> 
                            <td valign="top"> 
                                <textarea id="txtAreaVDescripcionMotivo" rows="2" cols="30"></textarea>
                            </td> 
                            <td></td> 
                        </tr>
                        <tr align="center">
                            <td colspan="4" align="center" height="25">
                                <a href="javascript:guardarNuevaProgramacionReemplanzo();"> <img border="0" title="Guardar" alt="" src="../../../../fastmedical_front/imagen/btn/b_grabar_on.gif"/></a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </fieldset>
</div>