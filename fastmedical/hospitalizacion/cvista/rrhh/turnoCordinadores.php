<?php
$filename = str_replace(" ", "-", "Turnos") . "_" . $datos["iCodEmpCoordinador"];
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=" . $filename . $datos["extencion"]);
header("Pragma: no-cache");
header("Expires: 0");
?>




<div STYLE="height:450px ;  width: auto; font-size: 12px; overflow: auto;" id="divscroll2">
    <table style="width: 200px; "  cellspacing="1">

        <?php
        if ($arrayAreaXcoordinadoresn) {
            foreach ($arrayAreaXcoordinadoresn as $i => $value) {
            if ($value[0] != 1) {
                ?>
                <?php
                if ($i != 0) {
                    if ($arrayAreaXcoordinadoresn[$i][0] == $arrayAreaXcoordinadoresn[$i - 1][0] && $arrayAreaXcoordinadoresn[$i][1] == $arrayAreaXcoordinadoresn[$i - 1][1]) {
                        ?>
                        <tr bgcolor="#D4E7FF"> <td colspan="4"></td></tr>
                    <?php } else { ?>
                        <tr bgcolor="#087F37"> <td colspan="4"> </td></tr>
                        <?php
                    }
                }
                ?>
                <tr bgcolor="#D4E7FF">
                    <td colspan="4">
                        <font size="4" color="blue" style="font:bold;color:#0000FF"> <?php echo $value[0] . '   ' . $value[1] . '  ( ' . strtoupper($value[3]) . ' )' ?></font>
                        <input id="hNombreAreaSede<?php echo $i ?>" type="hidden"
                               value=" <?php echo $value[0] . '   ' . $value[1] . '  ( ' . strtoupper($value[3]) . ' )' . $value[2] ?>" />
                    </td>


                </tr>
                <tr >
                    <td colspan="4" >
                        <div STYLE="height: auto ; width: 1250px; font-size: 12px; overflow: auto;">
                            <table id="tblProgramacionPersonal<?php echo $i ?>" border="1"  style="width: 1200px ; height: 10px ; font-family:  Arial; font-size: 12px;font-weight: bold " cellspacing="1">
                                <thead>
                                    <tr>

                                        <th bgcolor="#F7F7DD">Nombre Empleados</th>


                                        <?php
                                        foreach ($arrayDiaDelmes as $k => $valuey) {
                                            if ($valuey[0] == "D") {
                                                ?>
                                                <th bgcolor="#E88D8D"><?php echo $valuey[0]; ?></th> <!-- color Domingo -->
                                            <?php } else { ?>
                                                <th bgcolor="#F7F7DD"><?php echo $valuey[0]; ?></th>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <th style="width: 38px" bgcolor="#F7F7DD">
                                            Sub Total
                                        </th>
                                        <th style="width: 38px" bgcolor="#F7F7DD">
                                            Total
                                        </th>
                                    </tr>

                                    <tr>

                                        <th bgcolor="#F7F7DD"></th>

                                        <?php
                                        foreach ($arrayDiaDelmes as $n => $valuem) {
                                            if ($valuem[0] == "D") {
                                                ?>
                                                <th bgcolor="#E88D8D"><?php echo $valuem[1]; ?></th> <!-- color Domingo -->
                                            <?php } else { ?>
                                                <th bgcolor="#F7F7DD"><?php echo $valuem[1]; ?></th>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <th style="width: 38px" bgcolor="#F7F7DD">
                                            Horas
                                        </th>
                                        <th style="width: 38px" bgcolor="#F7F7DD">
                                            Horas
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //if (!empty($value[8])) {
                                    if ($value[8]) {
                                        foreach ($value[8] as $a => $valuex) { // nombre persona
                                            $class = ($a + 1) % 2 == 0 ? "jclmTbPar" : "jclmTbImpar";
                                            ?>

                                            <tr align="center" class="<?php echo $class; ?>">


                                                <td align="left" width="180px"  bgcolor="<?php echo $valuex[11] ?>">
                                                    <?php echo htmlentities($valuex[1]) ?>
                                                </td>


                                                <?php
//===========================================================================================================================
                                                if ($valuex[13]) {
                                                    foreach ($valuex[13] as $k => $valuey) { //Turnos --------------------------------------------------
                                                        if (trim($valuey[3]) != '1') {//dias programados
                                                            if ($valuey[15] == "D") { // si es Domingo lo pinto
                                                                if ($valuey[8] == 2) {// vacaciones
                                                                    ?>
                                                                    <td style="width: 22px; height: 20px" bgcolor="#E88D8D"> <!-- domingo vacaciones-->
                                                                        <font color="<?php echo $valuey[7] ?>" size="2">V</font>
                                                                    </td>
                                                                    <?php
                                                                } else {
                                                                    if ($value[5] == 1) {    // con permiso         
                                                                        ?>

                                                                        <td style="width: 22px; height: 20px" bgcolor="#E88D8D"> <!-- domingo  sin vacaciones-->
                                                                            <font color="<?php echo $valuey[7] ?>" size="2"><?php echo $valuey[3] ?></font>

                                                                        </td>
                                                                        <?php
                                                                    } else {
                                                                        if ($value[5] == 0) {     // sin permiso
                                                                            ?>

                                                                            <td style="width: 22px; height: 20px" bgcolor="#C0C0C0"> <!-- domingo  sin vacaciones-->

                                                                                <font color="<?php echo $valuey[7] ?>" size="2"><?php echo $valuey[3] ?></font>

                                                                            </td>
                                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            } else { //diferente de domingo programacion
                                                                if ($valuey[8] == "2") { //vacaciones
                                                                    ?>
                                                                    <td  bgcolor="<?php echo $valuey[9] ?>">
                                                                        <font color="blue" size="2"><?php echo $valuey[3] ?></font>
                                                                    </td>
                                                                    <?php
                                                                } else {
                                                                    if ($value[5] == 1) {   //  con permiso
                                                                        ?>

                                                                        <td  bgcolor="<?php echo $valuey[7] ?>"> <!-- cambiar Color a la Sede -->
                                                                            <font  size="2"><?php echo $valuey[3] ?></font>

                                                                        </td>
                                                                        <?php
                                                                    } else {
                                                                        if ($value[5] == 0) {// sin permiso
                                                                            ?>

                                                                            <td  bgcolor="C0C0C0"> <!-- cambiar Color a la Sede -->

                                                                                <font  size="2"><?php echo $valuey[3] ?></font>

                                                                            </td>
                                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            // ======================================================================================================================================
                                                        } else { // SIN PROGRAMAR  ===============================================================================
                                                            if ($valuey[15] == "D") {// cuando es domingo sin  programacion
                                                                if ($valuey[8] == 2) {
                                                                    ?> <!-- vacaciones domingo -->

                                                                    <td style="width: 22px; height: 20px" bgcolor="<?php echo $valuey[9] ?>"> <!-- domingo vacaciones-->
                                                                        <font color="<?php echo $valuey[7] ?>" size="2"><?php echo $valuey[10] ?></font>
                                                                    </td>
                                                                    <?php
                                                                } else {// domingo para progamar
                                                                    if ($value[5] == 1) {   // con permiso
                                                                        ?>
                                                                        <td style="width: 22px; height: 20px ; background-color: #E88D8D;" class="<?php echo $class; ?>" ><!-- domingo -->

                                                                        </td>
                                                                        <?php
                                                                    } else {
                                                                        if ($value[5] == 0) {// sin permiso
                                                                            ?>
                                                                            <td style="width: 22px; height: 20px ; background-color: #C0C0C0;" class="<?php echo $class; ?>" ><!-- domingo -->

                                                                            </td>
                                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            } else { // otro dia sin programar
                                                                if ($valuey[8] == 2) {
                                                                    ?> <!-- vacaciones semana -->
                                                                    <td style="width: 22px; height: 20px" bgcolor="<?php echo $valuey[9] ?>"> <!-- domingo vacaciones-->
                                                                        <font color="<?php echo $valuey[7] ?>" size="2"><?php echo $valuey[10] ?></font>
                                                                    </td>
                                                                    <?php
                                                                } else {// sin vacaciones de la semana
                                                                    if ($value[5] == 1) {  // con permiso
                                                                        ?>
                                                                        <td  class="<?php echo $class; ?>" >

                                                                        </td>
                                                                        <?php
                                                                    } else {
                                                                        if ($value[5] == 0) {// permiso
                                                                            ?>
                                                                            <td  bgcolor="#C0C0C0" >

                                                                            </td>
                                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                //===========================================================================================================================
                                                ?>
                                                <td bgcolor="#F7F7DD">
                                                    <?php echo $valuex[9] ?> <!-- Sub total Horas -->
                                                </td>
                                                <td bgcolor="#F7F7DD">
                                                    <?php echo $valuex[10] ?> <!-- Total Horas -->
                                                </td>
                                            </tr>

                                            <?php
                                        }
                                    }
                                    ?>
                                    <tr>                                   
                                        <td colspan="33" bgcolor="#D4E7FF">
                                            <?php
                                            if ($value[9]) {
                                                foreach ($value[9] as $a => $valuel) {
                                                    ?>
                                                    <?php echo $valuel[3] . '(' . $valuel[2] . ')---'; ?>

                                                    <?php
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <br>
                    </td>
                </tr>
                <?php
            }
        }
        }
        ?>

    </table>
</div> 
