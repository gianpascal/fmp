<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<input type="hidden" id="idSedeEmpresa" value="<?php echo $resultadoSede[0][0] ?>"/>
<input type="hidden" id="idCodigocronograma" value="<?php echo $datos['codigocronograma'] ?>"/>

<fieldset  style="margin:auto;width:auto;height:238px; ">
    <legend align="center">&nbsp;<h1><?php echo $datos['nombrepersona'] ?></h1> &nbsp;</legend>
    <fieldset style="margin:auto;width:60%;height:165px;">
        <div align="center">
            <table>
                <tr>
                    <td><b>Ambiente</b></td>
                    <td colspan="2">
                        <select onchange="cargarComboAmbienteFisicoReprogramacionMedicoNuevo();" style="width: 120px; font-size: 9px;" id="cb_filtro_ambienteslogicos" name="cb_filtro_ambienteslogicos">
                            <option value="0" >Seleccionar</option>
                            <?php foreach ($resultadoAmbiente as $key => $value) { ?>
                                <option value="<?php echo $value[0] ?>" ><?php echo $value[1] ?></option>
                            <?php } ?>                        
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><b>Localizaci&oacute;n</b></td>
                    <td><div id="div_localizacionAmbienteFisico">
                            <select style="width: 120px; font-size: 9px;" id="cb_filtro_ambienteFisico" name="cb_filtro_ambienteFisico">
                                <option value="0000" >Seleccionar</option>
                            </select>  
                        </div>
                    </td>
                    <td><a href="javascript:verCruces();"><img src="../../../../fastmedical_front/imagen/btn/b_ver_on.gif"></a></td>
                </tr>
                <tr>
                    <td><b>Observaci&oacute;n</b></td>
                    <td colspan="2"><textarea id="idTxtAreaMotivoDelCambioAmbiente" rows="2" cols="30"></textarea></td>
                </tr>
                <tr>
                    <td colspan="3"> 
                        <table align="center">
                            <tr>
                                <td><a href="javascript:actualizarAmbienteFisico()"><img src="../../../../fastmedical_front/imagen/btn/b_actualizar_on.gif"></a>
                                </td>
                                <td><a href="javascript:CancelarCambiodeAmbienteFisico()"><img src="../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif"></a>
                                </td>

                            </tr>
                        </table>

                    </td>

                </tr>
            </table>
        </div>
    </fieldset>
</fieldset>

