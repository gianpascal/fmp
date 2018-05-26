<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

?>
<input type="hidden" name="htxtSerie" value="<?php echo $datos["serie"] ?>"  id="htxtSerie" />
<input type="hidden" name="htxtCodigoComprobante" value="<?php echo $datos["codigoComprobante"] ?>"  id="htxtCodigoComprobante" />
<input type="hidden" name="htxtNumeroCaja" value="<?php echo $datos["c_caja"] ?>"  id="htxtNumeroCaja" />
<div style="width:99%; margin:1px auto; border: #006600" >
    <div class="titleform" id="" >
     <h3> <font size="4">  MODIFICAR SERIE DE COMPROBANTE </font></h3>
    </div>
</div><br>
<div align="center">
    <table border="1" id="">
        <tr>
            <td>
                <h3> <font size="3"> TIPO DE COMPROBANTE: </font></h3>
            </td>
            <td>
                <h3> <font size="3">  <?php echo $datos["descSerie"] ?></font></h3>
            </td>
        </tr>
        <tr>
            <td>
                <h3> <font size="3">  SERIE COMPROBANTE:</font></h3>
            </td>
            <td>
                <input type="text" name="txtSerie"  style="font-size: 25px;color: blue" maxlength="3"
                                            value="<?php echo $datos["serie"] ?>"  id="txtSerie" />
            </td>
        </tr>
        <tr>
            <td>
                 <h3> <font size="3"> C_nro_act :</font></h3>
            </td>
             <td>
                <input type="text" name="txtC_nro_act"  style="font-size: 20px;color: blue" maxlength="7"
                                            value="<?php echo $datos["c_nro_act"]  ?>"  id="txtC_nro_act" />
            </td>
        </tr>
        <tr>
            <td>
                <h3> <font size="4">   ESTADO:</font></h3>
            </td>
            <td>
                <input type="checkbox" name="ckEstadoComprobante" id="ckEstadoComprobante" value="ON" />
            </td>
        </tr>
    </table>
</div>

<DIV align="">
 <a href="javascript:modificarSerieEstado();"><img border="0" title="Codigo de Persona" alt="" src="../../../../fastmedical_front/imagen/btn/b_actualizar_on.gif"/></a>
</DIV>