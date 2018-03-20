<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$b=$resultadoturnos[0][3];
if($resultadoturnos[0][3]==''){
   $b= $datos["dFecha"];
}
$a=$resultadoturnos [$m][3];
if($resultadoturnos [$m][3]==''){
   $a= $datos["dFecha"];
}
?>
<input name="txthidCodigoPersonaEmpleada" type="hidden" id="txthidCodigoPersonaEmpleada" value="<?php echo $datos["iIdCodigoempleado"] ?>" />
<input name="txthidprogramacionEmpleado" type="hidden" id="txthidprogramacionEmpleado" size="20" value="<?php echo $datos["idProgramacionEmpleados"] ?>"/>
<input name="txthidCodnsdHorarioRealesAsistencia" type="hidden" id="txthidCodnsdHorarioRealesAsistencia" size="20"/>
<input name="txthidFecha" type="hidden" id="txthidFecha" size="20" value="<?php echo $datos["Fecha"] ?>"/>
<DIV ALIGN="CENTER">

    <fieldset align="center" style="margin:auto;width:670px;height:130px; "> 
        <table align="center" border="0" width="450">
            <tr align="center">
                <td>
                    <h1> <?PHP ECHO $datos["NombreCompleto"] ?> </h1>
                </td>
            </tr>
            <tr align="center">
                <td>
                    <font size="4" color="#3399FF"><b> <?PHP ECHO $datos["vSede"] ?> &plusdu;&plusdu; &plusdu;<?PHP ECHO $datos["vArea"] ?> </b> </font>
                </td>
            </tr>
            <tr align="center" style="width: 12PX; height: 12px">
                <td>                   
                </td>
            </tr>
            <tr align="center">
                <td>
                    <B><font size="3" color="#EA0002">TURNO PROGRAMADO </font></B>          
                </td>
            </tr>
            <tr align="center">
                <td>
                    <font size="4" color="#3399FF"><b> <?PHP ECHO $datos["dFecha"] ?> &NonBreakingSpace;
                        <font size="4" color="#EA0002"><?PHP ECHO $datos["vTurnos"] ?> </font>
                    </b> </font>
                </td>
            </tr>

        </table>
    </fieldset><br>
    <fieldset align="center" style="margin:auto;width:470px;height:270px; "> 
        <table border="0">        
            <tr>
                <td colspan="2">
                    <table>
                        <tr>
                            <td colspan="1"  style="width: 230PX; height: 24px" align="left">
                                <font size="3" color="#3399FF"> <b>Fecha Entrada &NonBreakingSpace;(<?php echo $resultadoturnos [0][3] ?>)</b></font>
                            </td>
                            <td colspan="1" bgcolor="#D6E9FE" style="width: 200PX; height: 24px">
                                <font style="color: blue"> <b>(HH:MM:DD) ejemplo: 07:58:10 </b></font>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr align="center">
                <td style="width: 650PX; height: 12px" align="center">
                    <table border="1">
                        <thead>
                            <tr>
                                <th><font size="2">Fecha</font></th>
                                <th><font size="2">Hora Actual</font></th>
                                <th><font size="2">Hora Modificar</font></th>
                                <th><font size="2">Observaci&oacute;n</font></th>
                                <th><font size="2">Usuario</font></th>
                                <th><font size="2">Actu</font></th>
                                <th><font size="2">Elim</font></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr align="center">

                                <td>
                                    <input id="txtFechaEntrada" name="txtFechaEntrada" type="text" size="10" 
                                           style="font-size:14px; text-align:center;"
                                           value="<?php echo $b ?>" onclick="calendarioHtmlx('txtFechaEntrada')"/>
                                </td> 
                                <td>
                                    <input id="txtdisabHoraEntrada" name="txtdisabHoraEntrada" type="text" size="8" disabled
                                           style="font-size:14px; text-align:center;background-color:#D6E9FE; "
                                           value="<?php echo $resultadoturnos [0][4] ?>"/>
                                    <input id="txtidMarcacionPersonalEntrada" name="txtidMarcacionPersonalEntrada" type="hidden" 
                                           value="<?php echo $resultadoturnos [0][1] ?>"/>
                                    <input id="txtfechaMarcacionEntrada" name="txtfechaMarcacionEntrada" type="hidden" 
                                           value="<?php echo $resultadoturnos [0][3] ?>"/>
                                </td> 
                                <td>
                                    <input id="txtHoraEntrada" name="txtHoraEntrada" type="text" size=12 maxlength=10 value="<?php echo $resultadoturnos [0][4] ?>"
                                           style="font-size:14px; text-align:center; "
                                           onkeyup="horaJavaScript('txtHoraEntrada','txtdisabHoraEntrada',this,event)"
                                           onBlur="CheckTime(this)"
                                           onclick="horaJavaScriptclick('txtHoraEntrada','txtdisabHoraEntrada',this,event)"/>
                                           <!--onclick="horaJavaScriptclick('txtHoraEntrada','txtdisabHoraEntrada',this,event)"-->
                                </td>
                                <td style="width: 220PX; " align="left">
                                    <textarea cols="30" rows="2" id="idTxtAreaObservacionentrada"><?php echo $resultadoturnos [0][5] ?></textarea>
                                </td>
                                <td><?php echo $resultadoturnos [0][6] ?>
                                </td>
                                <td>
                                    <a href="javascript:ActualizarTablaHorarioAsistencia(1);"><img border="0" title="Actualizar" alt="" src="../../../../medifacil_front/imagen/btn/b_actualizar_off.gif"/></a>
                                </td>
                                <td>
                                    <a href="javascript:eliminarTurnoPersona(1);"><img border="0" title="Eliminar" alt="" src="../../../../medifacil_front/imagen/icono/borrar.png"/></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table>
                        <tr>
                            <td colspan="1"  style="width: 230PX; height: 24px" align="left">
                                <font size="3" color="#3399FF"><b> Fecha Salida &NonBreakingSpace;(<?php echo $resultadoturnos [$m][3] ?>)</b></font>
                            </td>
                            <td colspan="1" bgcolor="#D6E9FE" style="width: 200PX; height: 24px">
                                <font style="color: blue"> <b>(HH:MM:DD) ejemplo: 07:58:10 </b></font>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr align="center">
                <td style="width: 650PX; height: 12px" align="center">
                    <table border="1">
                        <thead>
                            <tr>
                                <th><font size="2">Fecha</font></th>
                                <th><font size="2">Hora Actual</font></th>
                                <th><font size="2">Hora Modificar</font></th>
                                <th><font size="2">Observaci&oacute;n</font></th>
                                <th><font size="2">Usuario</font></th>
                                <th><font size="2">Actu</font></th>
                                <th><font size="2">Elim</font></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr align="center">
                                <td>
                                    <input id="txtFechaSalida" name="txtFechaSalida" type="text" size="10" 
                                           style="font-size:14px; text-align:center; "
                                           value="<?php echo $a ?>"onclick="calendarioHtmlx('txtFechaSalida')"/>
                                </td> 
                                <td>
                                    <input id="txtdisabHoraSalida" name="txtdisabHoraSalida" type="text" size="8" disabled 
                                           style="font-size:14px; text-align:center;background-color:#D6E9FE; "
                                           value="<?php echo $resultadoturnos [$m][4] ?>"/>
                                    <input id="txtidMarcacionPersonalSalida" name="txtidMarcacionPersonalSalida" type="hidden" 
                                           value="<?php echo $resultadoturnos [$m][1] ?>"/>
                                    <input id="txtfechaMarcacionSalida" name="txtfechaMarcacionSalida" type="hidden" 
                                           value="<?php echo $resultadoturnos [$m][3] ?>"/>
                                </td>
                                <td>
                                    <input id="txtHoraSalida" name="txtHoraSalida" type="text" size="8"  
                                           style="font-size:14px; text-align:center; "value="<?php echo $resultadoturnos [$m][4] ?>"
                                           onkeyup="horaJavaScript('txtHoraSalida','txtdisabHoraSalida',this,event)"
                                           onBlur="CheckTime(this)"
                                           onclick="horaJavaScriptclick('txtHoraSalida','txtdisabHoraSalida',this,event)"/>
                                           <!--onclick="horaJavaScriptclick('txtHoraSalida','txtdisabHoraSalida',this,event)"    />-->
                                </td>
                                <td style="width: 220PX; " align="left">
                                    <textarea cols="30" rows="2" id="idTxtAreaObservacionSalida"><?php echo $resultadoturnos [$m][5] ?></textarea>
                                </td>
                                <td><?php echo $resultadoturnos [$m][6] ?>
                                </td>
                                <td>
                                    <a href="javascript:ActualizarTablaHorarioAsistencia(2);"><img border="0" title="Actualizar" alt="" src="../../../../medifacil_front/imagen/btn/b_actualizar_off.gif"/></a>
                                </td>
                                <td>
                                    <a href="javascript:eliminarTurnoPersona(2);"><img border="0" title="Eliminar" alt="" src="../../../../medifacil_front/imagen/icono/borrar.png"/></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </fieldset>
</DIV>
