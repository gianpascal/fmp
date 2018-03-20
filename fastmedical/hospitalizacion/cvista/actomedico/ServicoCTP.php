<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1><?php echo utf8_encode($verPaquetesIncompleto[0][0]) ?></h1>
<div id="div_servicioPaciente">
    
</div>
<table border="1">
    <thead>
        <tr style=""  bgcolor="#CCE2FE">
            <th>CTP</th>
            <th>DESCRIPCIÓN</th>
            <th>OBSERVACIÓN</th>
            <th>NRO.ATE</th>
            <th>ORD.VIS</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($verPaquetesIncompleto as $k => $value) { ?>
            <tr>    
                    <td> <?php   echo $value[0] ?></td>
                    <td> <?php   echo $value[1] ?></td>
                    <td> <?php   echo $value[2] ?></td>
                    <td> <?php   echo $value[3] ?></td>
                    <td> <?php   echo $value[4] ?></td>
                    <td> <?php   echo $value[5] ?></td>
                    <td> <?php   echo $value[6] ?></td>
                    <td> <?php   echo $value[7] ?></td>
            </tr>
        <?php } ?>
    </tbody>

</table>


