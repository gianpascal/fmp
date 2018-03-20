<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div align ="center" style="width:600px; margin:1px auto; border: #006600 solid">
    <table width="544" border="0" cellpadding="0" cellspacing="0"> 
        <tr> 
            <td width="89" height="29"></td> 
            <td width="114"></td> 
            <td width="26"></td> 
            <td width="315"></td> 
        </tr>
        <tr> 
            <td height="25">Fecha</td> 
            <td valign="top"> 
                <div id="div_areaSedeFecha">
                    <input name="txtFecha" type="text" id="txtFecha" size="10" draggable=""
                           onclick="calendarioHtmlxJorge('txtFecha')" onkeypress="return validar(event,4);" maxlength="10" readonly='readonly'/>
                </div>
            </td> 
            <td></td> 
        </tr> 
        <tr> 
            <td height="25">Puesto: </td> 
            <td valign="top"> 
                <div id="div_nsmPuesto">
                    <select name="cbonsmPuestoEmpelado" id="cbonsmPuestoEmpelado" onchange="funcionPuestoEmpleadoBoton()"> 
                        <option value="0">Seleccionar</option>
                    </select> 
                </div>
            </td> 
            <td></td> 
        </tr> 
        <tr> 
            <td height="25">SEDE:</td> 
            <td valign="top">
                <div id="div_ActualizarSede">
                    <select name="cboidSedeEmpresa" id="cboidSedeEmpresa" onchange="cboSedeAreaNuevo()"> 
                        <option>Selecciona</option>
                        <?php foreach ($resultadoSedes as $k => $value) { ?>
                            <option value="<?php echo $value[0] ?>"><?php echo $value[1] ?></option> 
                        <?php } ?>               
                    </select> 
                </div>
            </td> 
            <td></td> 
            <td></td> 
        </tr> 
        <tr style="width: 620px;"> 
            <td height="25">Area :</td> 
            <td valign="top" style="width: 100px; height: 25px"> 
                <div id="div_areaSede">
                    <select name="cboAreaNuevo" id="cboAreaNuevo" onchange="cboSedeAreasTurnosNuevo()">  
                        <?php foreach ($resultadoAreas as $m => $valuem) { ?>
                            <option value="<?php echo $valuem[1] ?>"><?php echo $valuem[0] ?></option> 
                        <?php } ?>
                    </select> 
                </div>
            </td>
            <td valign="top" style="width: 100px; height: 25px">
                <b> Nueva Area:</b>
            </td>
            <td valign="top" style="width: 100px; height: 25px"> 
                <div id="div_PopapbotonBuscarAreaRegularizar">
                    <a href="javascript:verBuscadorAreasRegularizar();" >
                        <img border="0" src="../../../../medifacil_front/imagen/icono/window_new.png" alt="" title="Otra Area">
                    </a>
                </div>
            </td>
        </tr> 
        <tr> 
            <td height="25">Turno</td> 
            <td valign="top"> 
                <div id="div_areaSedeTurnos">
                    <select name="cboidSedeEmpresaAreaTurno" id="cboidSedeEmpresaAreaTurno">                      
                        <?php foreach ($resultadoTurnos as $x => $valuex) { ?>
                            <option value="<?php echo $valuex[0] ?>"><?php echo $valuex[1] ?></option>    
                        <?php } ?>
                    </select> 
                </div>
            </td> 
            <td valign="top" style="width: 100px; height: 25px">
                <b> Nueva Turno:</b>
            </td>
            <td><div id="div_PopapbotonBuscarAreaTurnoRegularizar">
                    <a href="javascript:agregarTurnoEmporesaArea();" >
                        <img border="0" src="../../../../medifacil_front/imagen/icono/window_new.png" alt="" title="Otra Turno">
                    </a>
                </div></td> 
        </tr> 
        <tr> 
            <td height="25">TipoProgramacion: </td> 
            <td valign="top"> 
                <div id="div_TipoProgramacion">

                </div>
            </td> 
            <td></td> 
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
        <tr> 
            <td height="25">Guardar: </td> 
            <td><a href="javascript:guardarPersonalTurnoRegularizar();">
                    <img border="0" src="../../../../medifacil_front/imagen/btn/b_grabar_on.gif" alt="" title="Ocultar">
                </a>
            </td> 
            <td></td> 
            <td></td> 
        </tr> 
    </table> 

</div>

