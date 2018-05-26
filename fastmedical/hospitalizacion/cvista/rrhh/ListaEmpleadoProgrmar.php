


<div STYLE="height:450px ;  width: auto; font-size: 12px; overflow: auto;" id="divscroll2">
    <table style="width: 200px; "  cellspacing="1">

        <?php
        foreach ($arrayAreaXcoordinadores as $i => $value) {
            if ($value[0] != 1) {
                ?>
                <?php
                if ($i != 0) {
                    if ($arrayAreaXcoordinadores[$i][0] == $arrayAreaXcoordinadores[$i - 1][0] && $arrayAreaXcoordinadores[$i][1] == $arrayAreaXcoordinadores[$i - 1][1]) {
                        ?>
                        <tr bgcolor="blue"> <td></td></tr>
                    <?php } else { ?>
                        <tr bgcolor="#087F37"> <td>"   "</td></tr>
                        <?php
                    }
                }
                ?>
                <tr bgcolor="#D4E7FF">
                    <td>
                        <font size="4" color="blue" style="font:bold;color:#0000FF"> <?php echo $value[0] . '   ' . $value[1] . '  ( ' . strtoupper($value[3]) . ' )' ?></font>
                        <b><font size="2" color="blue" style="font:bold;color:#F90E16">AGREGAR TURNO</font></b><a href="javascript:programacionTurno(<?php echo $i ?>);"> <img border="0" title="Turno" alt="" src="../../../../fastmedical_front/imagen/icono/timer.png"/></a>
                        <input id="hNombreAreaSede<?php echo $i ?>" type="hidden"
                               value=" <?php echo $value[0] . '   ' . $value[1] . '  ( ' . strtoupper($value[3]) . ' )' ?>" />
                        <input id="hSede<?php echo $i ?>" type="hidden"
                               value=" <?php echo $value[0] ?>" />
                        <input id="hArea<?php echo $i ?>" type="hidden"
                               value=" <?php echo $value[1] ?>" />
                        <input id="hidSedeempresaArea<?php echo $i ?>" type="hidden"
                               value=" <?php echo $value[2] ?>" />
                    </td>
                    <td hidden="">
                        <?php echo $value[1] ?>
                    </td>
                    <td  hidden="">
                        <?php echo $value[2] ?>
                    </td>
                    <td hidden="">
                        <?php echo $value[3] ?>
                    </td>

                </tr>
                <tr >
                    <td colspan="4" >
                        <div STYLE="height: auto ; width: 1250px; font-size: 12px; overflow: auto;">
                            <table id="tblProgramacionPersonal<?php echo $i ?>" border="1"  style="width: 1200px ; height: 10px ; font-family:  Arial; font-size: 12px;font-weight: bold " cellspacing="1">
                                <thead>
                                    <tr>
                                        <th hidden="">iIdPreProgramacion</th>
                                        <th hidden="">iIdSedeEmpresaArea</th>
                                        <th hidden="">iIdPuestoEmpleado</th>
                                        <th bgcolor="#F7F7DD">Nombre Empleados</th>
                                        <th hidden="">Codigo Empleado</th>
                                        <th hidden="">Numero Programaciones por dia</th>
                                        <th hidden="">Posicion</th>
                                        <th hidden="">Si tiene Doble en el mes</th>
                                        <th style="width: 38px" bgcolor="#F7F7DD">Acc</th>
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
                                        <th style="width: 38px" bgcolor="#F7F7DD">
                                            Eliminar
                                        </th>
                                        <th style="width: 38px" bgcolor="#F7F7DD">
                                            Borrar
                                        </th>
                                        <th style="width: 38px" bgcolor="#F7F7DD">
                                            Actualizar
                                        </th>
                                    </tr>

                                    <tr>
                                        <th hidden=""></th> <!-- hidden=""-->
                                        <th hidden=""></th>
                                        <th hidden=""></th>
                                        <th bgcolor="#F7F7DD"></th>
                                        <th hidden=""></th>
                                        <th hidden=""></th>
                                        <th hidden=""></th>
                                        <th hidden=""></th>
                                        <th style="width: 38px" bgcolor="#F7F7DD">Acc</th>
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
                                        <th style="width: 38px" bgcolor="#F7F7DD">
                                            Eliminar
                                        </th>
                                        <th style="width: 38px" bgcolor="#F7F7DD">
                                            Borrar
                                        </th>
                                        <th style="width: 38px" bgcolor="#F7F7DD">
                                            Actualizar
                                        </th>
                                    </tr>
                                </thead>

                                <?php
                                if (!empty($value[8])) {
                                    foreach ($value[8] as $a => $valuex) { // nombre persona
                                        $class = ($a + 1) % 2 == 0 ? "jclmTbPar" : "jclmTbImpar";
                                        ?>
                                        <tbody>
                                            <tr align="center" class="<?php echo $class; ?>">
                                                <!-- preProgramacion -->
                                                <td hidden="">
                                                    <?php echo $valuex[0] ?>
                                                </td>
                                                <!-- idSedeEmpresaArea -->
                                                <td hidden="">
                                                    <?php echo $valuex[2] ?>
                                                </td>
                                                <!-- PuestoEmpleado -->
                                                <td hidden="">
                                                    <?php echo $valuex[5] ?>
                                                </td>
                                                <td align="left" width="180px"  bgcolor="<?php echo $valuex[11] ?>">
                                                    <?php echo htmlentities($valuex[1]) ?>
                                                </td>
                                                <!-- codigo empleado -->
                                                <td align="left" width="180px" hidden="">
                                                    <?php echo $valuex[7] ?>
                                                </td >
                                                <td align="left" width="180px" hidden="">
                                                    <?php echo $valuex[3] ?>
                                                </td>
                                                <td align="left" width="180px" hidden="">
                                                    <?php echo $valuex[4] ?>
                                                </td >
                                                <td align="left" width="180px" hidden="">
                                                    <?php echo $valuex[8] ?>
                                                </td>

                                                <?php if ($value[5] == 1) { ?><!-- con permiso -->
                                                    <td>
                                                        <a href="javascript:programacionPersonal(<?php echo $i ?>,<?php echo $a ?>);"> <img border="0" title="Turno" alt="" src="../../../../fastmedical_front/imagen/icono/kopeteavailable.png"/></a>
                                                    </td>
                                                    <?php
                                                } else {
                                                    if ($value[5] == 0) {// sin permiso
                                                        ?>
                                                        <td bgcolor="#C0C0C0">
                                                            <img border="0" title="Turno" alt="" src="../../../../fastmedical_front/imagen/icono/kopeteavailable.png"/>
                                                        </td>                     <?php
                            }
                        }
                                                ?>

                                                <?php
//===========================================================================================================================
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
                                                                        <a href="javascript:programacionPorDiaConTurno(<?php echo $i ?>,<?php echo $a ?>,<?php echo $k ?>)" >
                                                                            <font  title="<?php echo $arrayDiaDelmes[$k][1].'--'.$arrayDiaDelmes[$k][0].'('.$valuey[11].')' ?>"  color="<?php echo $valuey[7] ?>" size="2"><?php echo $valuey[3] ?></font></a>
                                                                        <input id="hICodTurnoAreaSede<?php echo $i ?><?php echo $a ?><?php echo $k ?>" type="hidden"
                                                                               value="<?php echo $valuey[4] ?>" />
                                                                        <input id="hiCodProgramacionEmpleado<?php echo $i ?><?php echo $a ?><?php echo $k ?>" type="hidden"
                                                                               value="<?php echo $valuey[1] ?>" />
                                                                        <input id="hDescripcionTurno<?php echo $i ?><?php echo $a ?><?php echo $k ?>" type="hidden"
                                                                               value="<?php echo $valuey[3] ?>" />
                                                                        <input id="hDescripcionTurnoRango<?php echo $i ?><?php echo $a ?><?php echo $k ?>" type="hidden"
                                                                               value="<?php echo $valuey[11] ?>" />
                                                                        <input id="hNombreArea<?php echo $i ?><?php echo $a ?><?php echo $k ?>" type="hidden"
                                                                               value=" <?php echo $value[0] . '   ' . $value[1] . '  ( ' . strtoupper($value[3]) . ' )' ?>" />
                                                                    </td>
                                                                    <?php
                                                                } else {
                                                                    if ($value[5] == 0) {     // sin permiso
                                                                        ?>

                                                                        <td style="width: 22px; height: 20px" bgcolor="#C0C0C0"> <!-- domingo  sin vacaciones-->

                                                                            <font color="<?php echo $valuey[7] ?>" size="2"><?php echo $valuey[3] ?></font>
                                                                            <input id="hICodTurnoAreaSede<?php echo $i ?><?php echo $a ?><?php echo $k ?>" type="hidden"
                                                                                   value="<?php echo $valuey[4] ?>" />
                                                                            <input id="hiCodProgramacionEmpleado<?php echo $i ?><?php echo $a ?><?php echo $k ?>" type="hidden"
                                                                                   value="<?php echo $valuey[1] ?>" />
                                                                            <input id="hDescripcionTurno<?php echo $i ?><?php echo $a ?><?php echo $k ?>" type="hidden"
                                                                                   value="<?php echo $valuey[3] ?>" />
                                                                            <input id="hDescripcionTurnoRango<?php echo $i ?><?php echo $a ?><?php echo $k ?>" type="hidden"
                                                                                   value="<?php echo $valuey[11] ?>" />
                                                                            <input id="hNombreArea<?php echo $i ?><?php echo $a ?><?php echo $k ?>" type="hidden"
                                                                                   value=" <?php echo $value[0] . '   ' . $value[1] . '  ( ' . strtoupper($value[3]) . ' )' ?>" />
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
                                                                        <a href="javascript:programacionPorDiaConTurno(<?php echo $i ?>,<?php echo $a ?>,<?php echo $k ?>);" >
                                                                            <font  size="2" title="<?php echo $arrayDiaDelmes[$k][1].'--'.$arrayDiaDelmes[$k][0].'('.$valuey[11].')' ?>" ><?php echo $valuey[3] ?></font></a>
                                                                        <input id="hICodTurnoAreaSede<?php echo $i ?><?php echo $a ?><?php echo $k ?>" type="hidden"
                                                                               value="<?php echo $valuey[4] ?>" />
                                                                        <input id="hiCodProgramacionEmpleado<?php echo $i ?><?php echo $a ?><?php echo $k ?>" type="hidden"
                                                                               value="<?php echo $valuey[1] ?>" />
                                                                        <input id="hDescripcionTurno<?php echo $i ?><?php echo $a ?><?php echo $k ?>" type="hidden"
                                                                               value="<?php echo $valuey[3] ?>" />
                                                                        <input id="hDescripcionTurnoRango<?php echo $i ?><?php echo $a ?><?php echo $k ?>" type="hidden"
                                                                               value="<?php echo $valuey[11] ?>" />
                                                                        <input id="hNombreArea<?php echo $i ?><?php echo $a ?><?php echo $k ?>" type="hidden"
                                                                               value=" <?php echo $value[0] . '   ' . $value[1] . '  ( ' . strtoupper($value[3]) . ' )' ?>" />
                                                                    </td>
                                                                    <?php
                                                                } else {
                                                                    if ($value[5] == 0) {// sin permiso
                                                                        ?>

                                                                        <td  bgcolor="C0C0C0"> <!-- cambiar Color a la Sede -->

                                                                            <font  size="2"  title="<?php echo $arrayDiaDelmes[$k][1].'--'.$arrayDiaDelmes[$k][0] ?>" ><?php echo $valuey[3] ?></font>
                                                                            <input id="hICodTurnoAreaSede<?php echo $i ?><?php echo $a ?><?php echo $k ?>" type="hidden"
                                                                                   value="<?php echo $valuey[4] ?>" />
                                                                            <input id="hiCodProgramacionEmpleado<?php echo $i ?><?php echo $a ?><?php echo $k ?>" type="hidden"
                                                                                   value="<?php echo $valuey[1] ?>" />
                                                                            <input id="hDescripcionTurno<?php echo $i ?><?php echo $a ?><?php echo $k ?>" type="hidden"
                                                                                   value="<?php echo $valuey[3] ?>" />
                                                                            <input id="hDescripcionTurnoRango<?php echo $i ?><?php echo $a ?><?php echo $k ?>" type="hidden"
                                                                                   value="<?php echo $valuey[11] ?>" />
                                                                            <input id="hNombreArea<?php echo $i ?><?php echo $a ?><?php echo $k ?>" type="hidden"
                                                                                   value=" <?php echo $value[0] . '   ' . $value[1] . '  ( ' . strtoupper($value[3]) . ' )' ?>" />
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
                                                                    <td style="width: 22px; height: 20px ; background-color: #E88D8D;"  ><!-- domingo -->
                                                                        <a href="javascript:programacionPorDiaSinTurno(<?php echo $i ?>,<?php echo $a ?>,<?php echo $k ?>);" > <img border="0" title="Turno" alt="" src="../../../../fastmedical_front/imagen/icono/good.gif"/></a>
                                                                    </td>
                                                                    <?php
                                                                } else {
                                                                    if ($value[5] == 0) {// sin permiso
                                                                        ?>
                                                                        <td style="width: 22px; height: 20px ; background-color: #C0C0C0;" class="<?php echo $class; ?>" ><!-- domingo -->
                                                                            <img border="0" title="Turno" alt="" src="../../../../fastmedical_front/imagen/icono/good.gif"/>
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
                                                                        <a href="javascript:programacionPorDiaSinTurno(<?php echo $i ?>,<?php echo $a ?>,<?php echo $k ?>);"> <img border="0" title="Turno" alt="" src="../../../../fastmedical_front/imagen/icono/good.gif"/></a>
                                                                    </td>
                                                                    <?php
                                                                } else {
                                                                    if ($value[5] == 0) {//sin permiso
                                                                        ?>
                                                                        <td  bgcolor="#C0C0C0" >
                                                                            <img border="0" title="Turno" alt="" src="../../../../fastmedical_front/imagen/icono/good.gif"/>
                                                                        </td>
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                                <td bgcolor="#F7F7DD">
                                                    <a href="javascript:programacionPorArea(<?php echo $i ?>,<?php echo $a ?>,<?php echo $k ?>);">
                                                        <?php echo $valuex[9] ?></a> <!-- Sub total Horas -->
                                                </td>
                                                <td bgcolor="#F7F7DD">
                                                    <a href="javascript:programacionTotal(<?php echo $i ?>,<?php echo $a ?>,<?php echo $k ?>);">
                                                        <?php echo $valuex[10] ?></a> <!-- Total Horas -->
                                                </td>
                                                <?php if ($value[5] == 1) { // Con permiso 
                                                    ?>
                                                    <td  style="width: 22px; height: 20px ;"  class="<?php echo $class; ?>">
                                                        <a href="javascript:programacionEliminar(<?php echo $i ?>,<?php echo $a ?>,<?php echo $k ?>);"> <img border="0" title="Turno" alt="" src="../../../../fastmedical_front/imagen/icono/borrar.png"/></a>
                                                    </td>
                                                    <td  style="width: 22px; height: 20px ;"  class="<?php echo $class; ?>">
                                                        <a href="javascript:programacionBorrar(<?php echo $i ?>,<?php echo $a ?>,<?php echo $k ?>);"> <img border="0" title="Turno" alt="" src="../../../../fastmedical_front/imagen/icono/borrar.gif"/></a>
                                                    </td>
                                                    <td  style="width: 22px; height: 20px ;"  class="<?php echo $class; ?>">
                                                        <a href="javascript:programacionActualizar(<?php echo $i ?>,<?php echo $a ?>,<?php echo $k ?>);"> <img border="0" title="Turno" alt="" src="../../../../fastmedical_front/imagen/icono/reload3.png"/></a>
                                                    </td>

                                                <?php } else { ?>
                                                    <td  style="width: 22px; height: 20px ;"  class="<?php echo $class; ?>">

                                                    </td>
                                                    <td  style="width: 22px; height: 20px ;"  class="<?php echo $class; ?>">

                                                    </td> 
                                                    <td  style="width: 22px; height: 20px ;"  class="<?php echo $class; ?>">

                                                    </td>
                                                <?php } ?>
                                            </tr>

                                        </tbody>
                                        <?php
                                    }
                                }
                                ?>
                                <tr>
                                    <td>
                                        <table >
                                            <tr>
                                                <td style="width: 125px; height: 20px">
                                                    <a href="javascript:lenyendaArea(<?php echo $value[6] ?>,<?php echo $i ?>);" > Leyenda</a>
                                                </td>
                                                <td style="width: 125px; height: 20px">
                                                    <table border="=1">
                                                        <tr>
                                                            <td>
                                                                <div id="divOcultarTurnos">
                                                                    <a href="javascript:OcultarTurnos(<?php echo $i ?>);"> <img border="0" title="Ocultar" alt="" src="../../../../fastmedical_front/imagen/icono/Upload.png"/></a>
                                                                </div>
                                                            </td>
                                                            <td>

                                                                <div id="divMostrarTurnos">
                                                                    <a href="javascript:MostrarTurnos(<?php echo $i ?>);"> <img border="0" title="Ocultar" alt="" src="../../../../fastmedical_front/imagen/icono/Download.png"/></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                        </table>


                                    </td>
                                    <td colspan="33">
                                        <div id="divTrunosArea<?php echo $i ?>"></div>
                                    </td>
                                </tr>
                            </table>
                        </div> <br>
                    </td>
                </tr>
                <?php
            }
        }
        ?>

    </table>
</div> 
