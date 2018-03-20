<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor. hidden
*/
$fechaprogramar1=$datos["anno"].'-'.$datos["mes"].'-'.$datos["dia"];
if($datos["mes"]<10){
    if($datos["dia"]<10){
      $fechaprogramar='0'.$datos["dia"].'/'.'0'.$datos["mes"].'/'.$datos["anno"];
    }else {
       $fechaprogramar=$datos["dia"].'/'.'0'.$datos["mes"].'/'.$datos["anno"];
    }
}else {
    if($datos["dia"]<10){
      $fechaprogramar='0'.$datos["dia"].'/'.$datos["mes"].'/'.$datos["anno"];
    }
    else{
      $fechaprogramar=$datos["dia"].'/'.$datos["mes"].'/'.$datos["anno"];
    }
}


?>

<input type="hidden" id="hidPreProgramacion" name="hidPreProgramacion" value="<?php echo trim($datos["codigoPreProgramacion"]) ?>"/>
<input type="hidden" id="hfecha" name="hfecha" value="<?php echo $fechaprogramar1 ?>"/>
<input type="hidden" id="hPuestoEmpleado" name="hPuestoEmpleado" value="<?php echo  trim($datos["puestoEmpleado"])  ?>"/>
<input type="hidden" id="hiCodigoEmpleado" name="hiCodigoEmpleado" value="<?php echo trim($datos["iCodigoEmpleado"]) ?>"/>
<input type="hidden" id="hnInicioTurno" name="hnInicioTurno" value=""/>
<input type="hidden" id="hnfinTurno" name="hnfinTurno" value=""/>
<input type="hidden" id="hnNumeroProgramacionesXmes" name="hnNumeroProgramacionesXmes" value="<?php echo trim($datos["nNumeroProgramacionesXmes"]) ?>"/>
<input type="hidden" id="hiCodigoSedeAreaTurno" name="hiCodigoSedeAreaTurno" value=""/>


<div align="center">
    <fieldset style="margin:5px;padding:5px;height:auto;width:auto;">
       <table cellspacing=0 cellpadding=0 style="border-collapse:collapse;">
           <tr>
               <td>
                   <font size="3" color="blue" style="width:90;font:10pt;font:bold;color:#000000"><b><?php echo $fechaprogramar ?></b></font>
               </td>
           </tr>
            <tr>
                <td>
                    <font size="2" color="blue" style="width:90;font:10pt;font:bold;color:#0000FF"> <?php echo $datos["areaSede"] ?> </font>
                </td>
            </tr>
            <tr>
                <td>
                    <font color="red" size="2"> <?php echo  $datos["nombreEmpleado"] ?></font>
                </td>
            </tr>
            <tr>
                <td>
                    <select name="cboTurnoArea" id="cboTurnoArea" onchange="descripcionTurno()">
                        <option value="0/0/0/0">Seleccionar</option>
                        <?php foreach ($arrayListaTurnos as $k => $value) {?>
                        <option value="<?php echo $value[0]."/".$value[3]."/".$value[4]."/".$value[5]  ?>" > <?php echo $value[2] ?> </option>
                            <?php   } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input id="txtTurno" type="txt" value="" disabled  size="1"
                           style=" background-color: white; font: bold; font-style: normal; font-weight: bolder; color: red;"/>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="javascript:guardarTurnoProgramadoIndividuar();"> <img border="0" title="Turno" alt="" src="../../../../medifacil_front/imagen/btn/b_grabar_on.gif"/></a>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="divErrorCruceHorarioUnSoloTurno">

                    </div>
                </td>
            </tr>
        </table>
    </fieldset>
</div>
