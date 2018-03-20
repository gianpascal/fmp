<?php
$filename = str_replace(" ", "-", "Emergecia Diagnostico");
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=" . $filename . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<fieldset  style="margin:auto;width:auto;height:auto; "> 
   
    <fieldset style="margin:auto;width:60%;height:auto; ">

        <div style="width: 1200px; height: 500px; overflow: auto; background-color: #CACACA;" align="center">
            <table id="tblServicioEmergencia" width="1400px;" cellspacing="1" >
                <thead class="jclmTbHtml">
                    <tr>
                        <th colspan="26" > <legend align="center">&nbsp;<h1> DIAGNOSTICO POR SERVICIOS</h1> &nbsp;</legend> </th>
                    </tr>
                    <tr>
                        <th >CODIGO CIE</th>
                        <th >DIAG.</th>
                        <th width="360">Descripci&oacute;n</th>
                        <th colspan="3" >CONSULTAS</th>
                        <th colspan="18" >GRUPO DE EDAD</th>
                        <th colspan="2" >SEXO</th>
                    </tr>
                    <tr  align="center">
                        <th></th>
                        <th></th>
                        <th></th>
                        <th align="center">Nº</th>
                        <th align="center">% Porcentaje </th>
                        <th align="center">ACUM.</th>
                        <?php foreach ($resultadoRangoEdades as $i => $valueR) { ?>
                            <th width="35"><?php echo $valueR[1].'  '; ?></th>
                        <?php } ?>
                        <th >FEM</th>
                        <th > MAS</th>
                    </tr>
                </thead>
                <?php
                $colap = count($resultadoRangoEdades) + 8;
/* @var $resultadoNombreAmbienteLogico1 type */
                foreach ($resultadoNombreAmbienteLogico1 as $z => $valuez) {
                    $class = ($z + 1) % 2 == 0 ? "jclmTbPar" : "jclmTbImpar";
                    ?>
                    <tr style="background-color: #D7D7D7;">
                        <td height="25"  style="padding-left: 60px; font-weight:bold;" colspan="<?php echo $colap; ?>"><?php echo $valuez[1] ?></td>
                    </tr>
                    <?php foreach ($valuez[2] as $a => $valueDiag) { ?>
                        <tr class="<?php echo $class; ?>">
                            <td><?php echo $valueDiag[0] ?></td>
                            <td><?php echo htmlentities($valueDiag[1]) ?></td>
                            <td><?php echo htmlentities($valueDiag[2]) ?></td>
                            <td align="center"><?php echo htmlentities($valueDiag[3]) ?></td>
                            <td align="center"><?php echo htmlentities($valueDiag[4]) ?></td>
                            <td align="center"><?php echo $valueDiag[5] ?></td>
                            <td align="center"><?php echo $valueDiag[6] ?></td>
                            <td align="center"><?php echo $valueDiag[7] ?></td>
                            <td align="center"><?php echo $valueDiag[8] ?></td>
                            <td align="center"><?php echo $valueDiag[9] ?></td>
                            <td align="center"><?php echo $valueDiag[10] ?></td>
                            <td align="center"><?php echo $valueDiag[11] ?></td>
                            <td align="center"><?php echo $valueDiag[12] ?></td>
                            <td align="center"><?php echo $valueDiag[13] ?></td>
                            <td align="center"><?php echo $valueDiag[14] ?></td>
                            <td align="center"><?php echo $valueDiag[15] ?></td>
                            <td align="center"><?php echo $valueDiag[16] ?></td>
                            <td align="center"><?php echo $valueDiag[17] ?></td>
                            <td align="center"><?php echo $valueDiag[18] ?></td>
                            <td align="center"><?php echo $valueDiag[19] ?></td>
                            <td align="center"><?php echo $valueDiag[20] ?></td>
                            <td align="center"><?php echo $valueDiag[21] ?></td>
                            <td align="center" ><?php echo $valueDiag[22] ?></td>
                            <td align="center"><?php echo $valueDiag[23] ?></td>

                            <td align="center" style=" background-color: #CACACA;"><?php echo $valueDiag[24] ?></td>
                            <td align="center" style=" background-color: #CACACA;"><?php echo $valueDiag[25] ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="3"></td>
                        <?php if (!empty($valuez[7])) { ?>
                            <td align="center"><?php echo $valuez[7] ?></td>
                        <?php } else { ?>
                            <td align="center">0</td>
                        <?php } ?>

                        <td align="center"><?php echo $valuez[3] . ' %' ?></td>
                        <td></td>
                        <?php foreach ($valuez[4] as $s => $values) { ?>                   
                            <td align="center"><?php echo $values[0] ?></td>                        
                        <?php } ?>


                        <?php if (!empty($valuez[7])) { ?>    
                            <td align="center"><?php echo $valuez[5] ?></td> 
                        <?php } else { ?>
                            <td align="center">0</td>
                        <?php } ?>
                        <?php if (!empty($valuez[7])) { ?>    
                            <td align="center"><?php echo $valuez[6] ?></td>
                        <?php } else { ?>
                            <td align="center">0</td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                <tr style="background-color: #a4D0D0; font-weight:bold;">
                    <td></td>
                    <td></td>
                    <?php foreach ($resultadoTotalSexo as $ha => $valueSexo) { ?>
                    <td style="font-size: medium"><?php echo $valueSexo[2] ?></td>                      
                    <?php } ?>
                 
                    <td></td>
                    <td></td>
                    <td style="font-size: medium">100%</td>
                    <?php foreach ($resultadoTotaledad as $u => $valueedad) { ?>
                        <td style="font-size: medium"><?php echo $valueedad[0] ?></td>
                    <?php } ?>

                    <?php foreach ($resultadoTotalSexo as $ha => $valueSexo) { ?>
                        <td style="font-size: medium"><?php echo $valueSexo[0] ?></td>
                        <td style="font-size: medium"><?php echo $valueSexo[1] ?></td>
                        
                    <?php } ?>
                </tr>
            </table>
        </div>
    </fieldset>

</fieldset > 
