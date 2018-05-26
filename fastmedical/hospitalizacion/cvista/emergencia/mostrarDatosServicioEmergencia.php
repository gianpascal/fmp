<?php
//$valor = "false";
//
//if ($CboDestino <> 'ALTA MEDICA') {
//    $valor = "false";
//} else {
//    $valor = "true";
//}
//print_r($CboDestino);
?> 
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body >


        <table>
            <tr> 
                <td align="center">
                    <table align="center" >
                        <tr>
                            <td colspan="2" align="center">
                                <table align="center">
                                    <tr>
                                        <td><?php
                                             $toolbar3 = new ToollBar("left");
                                               $toolbar3->SetBoton("REFRESCAR", "REFRESCAR", "btn", "onclick,onkeypress", "refrescarTablaPaciente()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/actividad3.png");
                                               $toolbar3->Mostrar();
                                               ?>
                                        </td>
                                    </tr>
                                </table>  </td>
                        </tr>
                        <tr>
                            <td>
                                MEDICO :  <select name="cboDoctor" id="cboDoctor" style="width: 120px;" onchange="CargarCboDoctor()">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($resultadosDoctor as $i => $valueX) { ?>
                                        <option value="<?php echo $valueX[0]; ?>"
                                        <?php if ($datos["hcodigoDoctorper"] == $valueX[0])
                                            echo 'selected'; ?>     P.iCodigoPaciente >
                                                    <?php echo htmlentities($valueX[2]); ?>
                                        </option>
                                    <?php } ?>
                                </select>

                            </td>
                            <td>
                                SERVICIO :  <select name="cboEspecialidad" id="cboEspecialidad" style="width: 120px;" onchange="cargarCboEspecialidad()">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($resultadosEspecialidad as $i => $valueXEspecialidad) { ?>
                                        <option value="<?php echo $valueXEspecialidad[0]; ?>"
                                        <?php if ($datos["hidCentroCosto"] == $valueXEspecialidad[0])
                                            echo 'selected'; ?>      >
                                                    <?php echo htmlentities($valueXEspecialidad[1]); ?>
                                        </option>
                                    <?php } ?>
                                </select>                     

                            </td>
                        </tr>
                    </table>
                </td> 

            </tr>
            <tr>
                <td>
                    <div style="width: 950px; height: 500px; overflow: auto;">
                        <table id="tblServicioEmergencia" border="0" width="1200px;" cellspacing="1">
                            <thead class="jclmTbHtml">
                                <tr>
                                    <th hidden="false">CodigoProgramacion</th>
                                    <th >Hora Ingreso</th>
                                    <th>Paciente</th>
                                    <th>Edad</th>
                                    <th>Sexo</th>
                                    <th>Medico</th>
                                    <th>Ambiente Fisico</th>
                                    <th>Cama</th>
                                    <th>Diagnostico</th>
                                    <th colspan="2">Destino</th>
                                    <th colspan="3">Accion</th>
                                    <th hidden="false">DNI</th>
                                    <th hidden="false">codigo persona</th>
                                    <th hidden="false">codigo Cronograma</th>
                                    <th hidden="false">nsdProgramacionPacientesEmergencia</th>
                                    <th hidden="false">idCama</th>
                                    <th hidden="false">Fecha Selecciona</th>
                                    <th hidden="false">codigo medico persona</th>
                                    <th hidden="false">fila</th>
                                    <th hidden="false">CodigoCama</th>
                                    <th hidden="false">CodigoAmbiente</th>
                                    <th hidden="false">codigoDestino</th>
                                    <th hidden="false">Fecha Ingreso de Paciente</th>
                                    <th hidden="false">EstadoCama</th>
                                    <th hidden="false">Camb Cama Estado</th>
                                    <th hidden="false">Txt Descripcion</th>
                                    <th hidden="false">Cidigo Paciente</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($resultados as $i => $value) {
                                    if (($i + 1) % 2 == 0)
                                        $class = "jclmTbPar";
                                    else
                                        $class="jclmTbImpar";
                                    $nameDiv = "divcboCama_" . $i;
                                    ?>

                                    <tr class="<?php echo $class; ?>">
                                        <td hidden="false"> <input name="idProgramacion[<?php echo $i ?>]" type="text" id="idProgramacion[<?php echo $i ?>]" value="<?php echo $value[4]; ?>" /></td>
                                        <td><?php echo $value[0]; ?></td>
                                        <td><?php echo htmlentities($value[1]); ?></td>
                                        <td><?php echo htmlentities($value[2]); ?></td>
                                        <td><?php echo $value[3]; ?></td>
                                        <td><?php echo $value[6]; ?></td>
                                        <td> <select id="cboAmbienteFisico[<?php echo $i ?>]"  name="cboAmbienteFisico[<?php echo $i ?>]" style="width: 120px;" onchange="ComboCama(<?php echo $i; ?>)"
                                            <?php if ($resultados[$i][23] == '38' || $resultados[$i][23] == '39' || $resultados[$i][23] == '40')
                                                echo ' disabled="false"' ?>   
                                                     <?php if ($value[16] == 0)
                                                         echo ' hidden="false"' ?> >
                                                <option value=""> ----------  </option>
                                                        <?php foreach ($resultados[$i][21] as $k => $valAF) { ?>
                                                    <option value="<?php echo $valAF[0] ?>" <?php if ($value[23] == $valAF[0])
                                                        echo 'selected'; ?>> 
                                                    <?php echo $valAF[2] ?>
                                                    </option>
    <?php } ?>
                                            </select>  </td>
                                        <td> 
                                            <div id="<?php echo $nameDiv; ?>" >
                                                <select id="cboCama[<?php echo $i ?>]"  name="cboCama[<?php echo $i ?>]" hidden="false">
                                                    <option>---</option>
                                                </select>
                                            </div>
    <!--                                             <select id="cboCamap[<?php echo $i ?>]"  name="cboCamap[<?php echo $i ?>]" style="width: 50px;"
                                                 disabled="false" hidden="false">
                                         </select>-->
    <?php if ($value[10] == '') { ?>
                                                <div id="<?php echo $nameDiv; ?>" >
                                                    <select id="cboCama[<?php echo $i ?>]"  name="cboCama[<?php echo $i ?>]" hidden="false">
                                                        <option>---</option>
                                                    </select>
                                                </div>
                                            <?php } else { ?>
                                                <select id="cboCamap[<?php echo $i ?>]"  name="cboCamap[<?php echo $i ?>]" style="width: 50px;"
                                                        <?php if ($value[10] != '')
                                                            echo ' disabled="false"' ?>>
                                                    <option value=""> helloo  </option>
                                                            <?php foreach ($resultados[$i][25] as $k => $valAFC) { ?>
                                                        <option value="<?php echo $valAFC[0] ?>" <?php if ($resultados[$i][24] == $valAFC[0])
                                                        echo 'selected'; ?>> 
                                                        <?php echo $valAFC[1] ?>
                                                        </option>
                                                <?php } ?>
                                                </select>
    <?php } ?>
                                        </td>
                                        <td><?php echo $value[19]; ?></td>
                                        <td>  <select id="cboDestino[<?php echo $i ?>]" name="cboDestino[<?php echo $i ?>]" style="width: 120px;"  onchange="ActivarTexto(<?php echo $i; ?>)"
                                                      <?php if ($value[11] != '')
                                                          echo 'disabled="false"' ?>>
                                                <option  value=""> ---------  </option>
                                                        <?php foreach ($resultados[$i][20] as $k => $valx) { ?>
                                                    <option value="<?php echo $valx[0] ?>"<?php if ($value[11] == $valx[0])
                                                        echo 'selected' ?> > 
                                                    <?php echo $valx[1] ?>
                                                    </option>
    <?php } ?>
                                            </select>                           
                                        </td>
                                        <td >

                                            <input id="txtDescDestino[<?php echo $i ?>]"  type="text" value="<?php echo $value[17]; ?>" disabled="true"/></td>
                                    <!--<td contenteditable=<//?//php //echo $valor ?>  -->
                                        <?php
                                        
                                        if(isset($_SESSION["permiso_formulario_servicio"][225]["GRABAR_PROG_EME"]) && $_SESSION["permiso_formulario_servicio"][225]["GRABAR_PROG_EME"]==1){
                                        echo "<td>
                                            <a href=\"javascript:GuardarnsdProgramacionPacientesEmergencia($i);\">
                                                <img border=\"0\" title=\"Guardar\" alt=\"\" src=\"../../../../fastmedical_front/imagen/icono/grabar.png\"/></a>
                        <!--                            <img align=\"absmiddle\" title=\"\" alt=\"Grabar\" src=\"../../../../fastmedical_front/imagen/icono/grabar.png\"></img>-->
                                        </td>";
                                        }
                                        ?>
                                        <?php
                                        if(isset($_SESSION["permiso_formulario_servicio"][225]["EDITAR_PROG_EME"]) && $_SESSION["permiso_formulario_servicio"][225]["EDITAR_PROG_EME"]==1){
                                        echo "<td>
                                            <a href=\"javascript:EditaComboCamaAmbienteFisicoDestino($i);\">
                                                <img border=\"0\" title=\"Editar\" alt=\"\" src=\"../../../../fastmedical_front/imagen/icono/editar.png\"/></a>
                        <!--                            <img border=\"0\" src=\"../../../../fastmedical_front/imagen/icono/editar.png\" title=\" Editar\"></img>-->
                                        </td>";
                                        }
                                        ?>
                                        <?php
                                        
                                        if(isset($_SESSION["permiso_formulario_servicio"][225]["VER_DET_PROG_EME"]) && $_SESSION["permiso_formulario_servicio"][225]["VER_DET_PROG_EME"]==1){
                                        echo "<td>
                                            <a href=\"javascript:EditarDetallePaciente($i);\">
                                                <img border=\"0\" title=\"Visualizar Paciente\" alt=\"\" src=\"../../../../fastmedical_front/imagen/icono/b_ver_on.gif\"/></a>
                        <!--                            <img border=\"0\" src=\"../../../../fastmedical_front/imagen/icono/editar.png\" title=\" Editar\"></img>-->
                                        </td>";
                                        }
                                        ?>
                                        <td hidden="false"><?php echo $value[9]; ?> </td>
                                        <td hidden="false"><?php echo $value[5]; ?> </td>
                                        <td hidden="false"><?php echo $value[8]; ?> </td>
                                        <td hidden="false"><?php echo $value[7]; ?> </td>
                                        <td hidden="false"><?php echo $value[10]; ?> </td>
                                        <td hidden="false"><?php echo $value[18]; ?> </td>
                                        <td hidden="false"><?php echo $value[12]; ?> </td>
                                        <td hidden="false"><?php echo $i ?> </td>
                                        <td hidden="false"><?php echo $resultados[$i][10] ?>  </td>
                                        <td hidden="false"> <?php echo $resultados[$i][21] ?> </td>
                                        <td hidden="false"> <?php echo $value[11]; ?> </td>
                                        <td hidden="false"><?php echo $value[15]; ?></td>
                                        <td hidden="false"><?php echo $value[16]; ?></td>
                                        <td hidden="false"><input name="hCodigoCama[<?php echo $i ?>]" type="text" id="hCodigoCama[<?php echo $i ?>]" value="" /></td>
                                        <td hidden="false"><?php echo $value[17]; ?></td>
                                        <td hidden="false"><?php echo $value[18]; ?></td>
                                    </tr>
<!--                                <input style="border: 0px;" id="txtDescDestino"  type="hidden"/>-->
<?php } ?>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>      
        </table>           
    </body>
</html>
