<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */
?>

<fieldset  style="margin:auto;width:auto;height:auto; "> 
    <legend align="center">&nbsp;<h1> BUSQUEDA DE EMPLEADO</h1> &nbsp;</legend>
    <fieldset style="margin:auto;width:60%;height:auto; ">
        <!--        <div id="divServiciosEmergencia">

                </div>-->


        <table id="" width="550px;" cellspacing="1" border="1" >
            <tr>
                <td style="font-weight:bold;" align="right">
                    Apellido Paterno Paciente:
                </td>
                <td>
                    <input type="text" id="txtApePaternoPaciente" name="txtApePaternoPaciente" onkeypress="if(event.keyCode==13){busquedaEmpleadoRegularizar()}"/>
                </td>
            </tr>
            <tr> 
                <td style="font-weight:bold;" align="right">
                    Apellidos Materno Paciente:
                </td>
                <td>
                    <input type="text" id="txtApeMaternoPaciente"  name="txtApeMaternoPaciente" onkeypress="if(event.keyCode==13){busquedaEmpleadoRegularizar()}"/>
                </td>
            </tr>
            <tr>
                <td style="font-weight:bold;" align="right">
                    Nombre Paciente:   
                </td>
                <td>
                    <input type="text" id="txtNombrePaciente" name="txtNombrePaciente" onkeypress="if(event.keyCode==13){busquedaEmpleadoRegularizar()}" />
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <a href="javascript:busquedaEmpleadoRegularizar();">
                        <img border="0" title="Buscar" alt="" src="../../../../medifacil_front/imagen/btn/b_buscar_on.gif"/></a>
                </td>

            </tr>  

        </table>
        <fieldset style="margin:10px;width:auto;height:200px; " align="center">
            <div id="divTablaAreaPersonaRegularizar" style="width: 550px; height: 200px;" align="center">
            </div>
            <div align="center">
                <a href="javascript:Cerrar();">
                    <img border="0" title="Salir" alt="" src="../../../../medifacil_front/imagen/btn/b_Salir.gif"/></a>
            </div>
        </fieldset>

    </fieldset>

</fieldset > 
