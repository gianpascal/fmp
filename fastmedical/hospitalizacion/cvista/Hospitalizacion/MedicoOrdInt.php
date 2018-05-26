
<fieldset  style="margin:auto;width:auto;height:auto; "> 
<!--    <legend align="center">&nbsp;<h1> BUSQUEDA DE MEDICO TRATANTE</h1> &nbsp;</legend>-->
<div class="titleform" style="width:100%;">
    <h1> BUSQUEDA DE MEDICO TRATANTE</h1> 
</div>

    <fieldset style="margin:auto;width:50%;height:auto; ">
        <!--        <div id="divServiciosEmergencia">

                </div>-->

        <table id="" width="550px;" cellspacing="1" border="1" >
            <tr>
                <td style="font-weight:bold;" align="right">
                    Apellido Paterno Medico:
                </td>
                <td>
                    <input type="text" id="txtApePaternoMedicoOrdInt" name="txtApePaternoPaciente" onkeypress="BusquedaOrdIntTeclado('13',this,event);"/>
                </td>
            </tr>
            <tr> 
                <td style="font-weight:bold;" align="right">
                    Apellidos Materno Medico:
                </td>
                <td>
                    <input type="text" id="txtApeMaternoMedicoOrdInt"  name="txtApeMaternoPaciente" onkeypress="BusquedaOrdIntTeclado('13',this,event);"/>
                </td>
            </tr>
            <tr>
                <td style="font-weight:bold;" align="right">
                    Nombre Medico:   
                </td>
                <td>
                    <input type="text" id="txtNombreMedicoOrdInt" name="txtNombrePaciente" onkeypress="BusquedaOrdIntTeclado('13',this,event);" />
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <a href="javascript:busquedaPersonaMedicoOrdInt();">
                        <img border="0" title="Buscar" alt="" src="../../../../fastmedical_front/imagen/btn/b_buscar_on.gif"/></a>
                </td>

            </tr>  

        </table>
            <div id="divTablaMedicoOrdInt" style="width: 600px; height: 150px;" align="center">
            </div>
            <div align="center">
                <a href="javascript:CerrarMedicoOrdInt();">
                    <img border="0" title="Salir" alt="" src="../../../../fastmedical_front/imagen/btn/b_Salir.gif"/></a>
            </div>


    </fieldset>

</fieldset > 