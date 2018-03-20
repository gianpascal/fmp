<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<input type="hidden" id="hFechaProgramada" name="hFechaProgramada" value="<?php echo $datos["dFecha"] ?>">
<input type="txt" id="hiIdTurnosAreaSede" name="hiIdTurnosAreaSede" value="<?php echo $datos["iIdTurnosAreaSede"] ?>">
<input type="txt" id="hiIdSedeEmpresaArea" name="hiIdSedeEmpresaArea" value="<?php echo $datos["iIdSedeEmpresaArea"] ?>">
<input type="txt" id="hiIdTipoProgramacion" name="hiIdTipoProgramacion" value="<?php echo $datos["iIdTipoProgramacion"] ?>">
<input type="txt" id="hc_cod_per" name="hc_cod_per" value="<?php echo $datos["c_cod_per"] ?>">

<table>
    <tr align="center">
        <td bgcolor="#FFFFCC">
            <table>
                <tr>
                    <td><b><?php echo $datos["vSede"] ?></b></td>
                    <td>&nbsp;&nbsp;<b><?php echo $datos["vArea"] ?></b></td>
                </tr>
            </table>
            
        </td>
    </tr>
    <tr>
        <td>
            <div id="div_tablaXEmpleadosReemplazo" style="width:780px;height: 300px;float:left;border:1px solid #8EAA86; border-radius:5px;float: left;clear:both; ">
            </div>  
        </td>
    </tr>
</table>

