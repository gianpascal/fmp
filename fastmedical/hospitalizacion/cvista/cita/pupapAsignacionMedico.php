<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<input type="hidden" id="fechaActualEditarCita" value="<?php echo date('d/m/Y'); ?>" />
<input type="hidden" id="fechaSeleccionadaEditarCitaPaciente" value="" />
<input type="hidden" id="iCodigoCronogramaMedicoSeleccionado" value="" />
<div>
    <table border="1">
        <tr>
            <td align="center">
                <div id="div_PacientesSeleccionados"  style="height: 440px; width: 380px; float: left; visibility: visible;"></div>
            </td>
            <td>
                <div align="center">
                    <table border="1">
                        <tr align="center">
                            <td align="center"><div id="div_calendarioEditarCitas" style="height: 200px; width: 200px; float: left; visibility: visible;"></div>
                            </td>
                            <td><br><br>
                                <div style="height: 200px; width: 200px;">
                                    <a href="javascript:guardarASignacionMedico()"><img src="../../../../fastmedical_front/imagen/btn/b_grabar__on.gif"/>
                                    </a><br>
                                    <div id="div_NombreMedicoSeleccionado" style="height: auto; width: auto; visibility: visible;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr align="center">
                            <td align="center" colspan="2">
                                <div id="div_ListaDeMedicos" style="height: 230px; width: 400px; float: left; visibility: visible;"></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>

    </table>

</div>