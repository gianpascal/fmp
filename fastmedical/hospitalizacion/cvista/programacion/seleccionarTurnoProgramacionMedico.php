<style type="text/css">
    .hora{
        width: 60px;
    }
    .btn{
        background-color: lightgreen;
        color: black;
    }
    #tabla {
        width: 300px;
    }
</style>
<?php $codTur=""; ?>
<div align="center">
    <fieldset>
        <legend>Edición de turno</legend>
        <br/>
    <table border="0" align="center" id="tabla">
            <tr>
                <td>Hora inicio:</td>
                <td><select class="hora" id="cboHoraInicio" onchange="javascript:seleccionarHoraFinal(this.value);">
                        <?php foreach($rs1 as $key => $value){ ?>
                        <option value="<?php echo $value[0]?>" <?php if($value[1]!=0){$codTur=$value[1];echo "selected";}?>><?php echo number_format($value[0],2)?></option>
                        <?php }?>
                    </select>
                </td>
                <td colspan="2"></td>
                <td>Hora fin:</td>
                <td><select class="hora" id="cboHoraFin">
                        
                    </select>
                </td>
            </tr>            
            <tr>
                <td>Motivo:</td>
                <td colspan="5"><textarea id="txaMotivo" rows="4" cols="30"></textarea></td>           
            </tr>            
            <tr>
                <td colspan="2"></td>
                <td colspan="2">
                    <a href="javascript:actualizarTurnoProgramacionMedico($('hcodigocronograma').value);">
                                    <img src="../../../../fastmedical_front/imagen/btn/b_actualizar_on.gif"/></a>                   
                </td>                
                <td colspan="2">                    
                    <input type="hidden" id="hCodigoTurno" value="<?php echo $codTur; ?>"/>
                </td>                                         
            </tr>
    </table>
    </fieldset>
</div>