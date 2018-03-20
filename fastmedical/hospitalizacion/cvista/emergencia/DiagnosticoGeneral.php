<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>

<fieldset  style="margin:auto;width:auto;height:auto; "> 
    <legend align="center">&nbsp;<h1> DIAGNOSTICO GENERAL</h1> &nbsp;</legend>
    <fieldset style="margin:auto;width:60%;height:auto; ">
        <!--        <div id="divServiciosEmergencia">

                </div>-->
        <div style="width: 1200px; height: 500px; overflow: auto; background-color: #CACACA;" align="center">
            <table id="tblServicioEmergencia" width="1650px;" cellspacing="1" >
                <thead class="jclmTbHtml">
                    <tr>
                        <th >DIAG.</th>
                        <th height="10" width="350">Descripci&oacute;n</th>
                        <th colspan="3" width="150">CONSULTAS</th>
                        <th colspan="18" >GRUPO DE EDAD</th>
                        <th colspan="2">SEXO</th>
                    </tr>
                    <tr  align="center">
                        <th></th>
                        <th></th>
                        <th align="center" width="40">Nº</th>
                        <th align="center" width="60">% Porcentaje </th>
                        <th align="center" width="60">ACUM.</th>
                        <?php foreach ($resultadoRangoEdades as $i => $valueR) { ?>
                            <th><?php echo $valueR[1]; ?></th>
                        <?php } ?>
                        <th>FEM</th>
                        <th>MAS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($arrayDatos as $i => $value) {
                        $class = ($i + 1) % 2 == 0 ? "jclmTbPar" : "jclmTbImpar";
                        ?>
                        <tr class="<?php echo $class; ?>">
                            <?php foreach ($value as $j => $val) {
                                if ($j != 2) { 
                                    if($j == 1){?>
                                    <td height="15" ><?php echo htmlentities($val); ?></td>
                                <?php }else{ ?>
                                    <td align="center"><?php echo htmlentities($val); ?></td>
                               <?php }
                                }
                            } ?>
                        </tr>
                      <?php } ?>  

                    <tr style="background: #36b1df">
                        <td colspan="2" align="center" style="font-weight:bold;font-size: medium">TOTAL GENERAL</td>
                        <td align="center" style="font-weight:bold;font-size: medium"><?php echo $resultadoCantidad[0][0] ?> </td>
                        <td align="center" style="font-weight:bold;font-size: medium">100% </td>
                        <td></td>
                        <?php foreach ($resultadoXedades as $x => $valEspex) { ?>
                            <td align="center" style="font-weight:bold; font-size: medium"><?php echo $valEspex[1]; ?>    </td>
                        <?php } ?>

                          <?php foreach ($resultadoSexoTotal as $x => $valEspeS) { ?>
                            <td align="center" style="font-weight:bold; font-size: medium"><?php echo $valEspeS[0]; ?>    </td>
                            <td align="center" style="font-weight:bold; font-size: medium"><?php echo $valEspeS[1]; ?>    </td>
                        <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </fieldset>

</fieldset > 


