<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body align="center">
        <!--        <div style="width: auto; height: auto" align="center">-->
        <fieldset  style="margin:auto;width:auto;height:auto; " align="center">
            <!--                    <fieldset  style="margin:auto;width:80%;" >-->
            <div style="width: 100%"  align="center">
                <div class="titleform" style="width:100%;">
                    <h1>Consulta de Pacientes Detallada<br></h1>
                </div>
                <table border="0" width="740" cellspacing="2"  align="center" >
                    <tbody>
                        <tr>
                            <td width="149" style="font-size: large" >Codigo: <br></td>
                            <td width="240"  style="font-size: medium"><?php echo $datos["codigoPaciente"]; ?> <br></td>

                            <td width="193" rowspan="6" align="center" style="font-size: medium">DNI: <?php echo $datos["dni"]; ?><br><img src="<?php echo $fotoPersona; ?>" alt="" width="110" height="130"></td>
                        </tr>
                        <tr>
                            <td style="font-size: large">Paciente:<br></td><br>
                            <td  style="font-size:small"><?php echo $datos["nomPaciente"]; ?> <br></td><br>
                        </tr>
                        <tr>
                            <td style="font-size: large">Edad:<br></td>
                            <td  style="font-size: small"><?php echo $datos["edad"]; ?> <br></td>
                            <!-- <td>Edad del paciente</td>-->
                        </tr>
                        <tr>
                            <td style="font-size: large">Fecha Entrada:<br></td>
                            <td  style="font-size: small"><?php echo $datos["fechaEntrada"]; ?> <br></td>
                            <!-- <td> masculino o femenino</td>-->
                        </tr>
                        <tr>
                            <td style="font-size: large">Hora Entrada:<br></td>
                            <td  style="font-size: small"><?php echo $datos["horaEntrada"]; ?> <br></td>
                            <!-- <td> masculino o femenino</td>-->
                        </tr>
                        <tr>
                            <td style="font-size: large">Sexo:</td>
                            <td  style="font-size: small"><?php echo $datos["Sexo"]; ?> <br></td>
                            <!-- <td> masculino o femenino</td>-->
                        </tr>
                        <tr>
                            <td style="font-size: large"><br>Medico:<br></td>
                            <td  style="font-size: small"><br><?php echo $datos["Medico"]; ?> </td>
                            <!-- <td>Nombre del medico </td>-->
                        </tr>
                        <tr>
                            <td style="font-size: large">Especialidad:</td>
                            <td  style="font-size: small"><?php foreach ($resultadosEspecialidad as $i => $valEspe) { ?>
                                    <?php echo $valEspe[2] ?>
                                <?php } ?> </td>
                              <!--<td> nombre de la Especialidad medico</td>-->             
                        </tr>
                        <tr>
                            <?php if ($datos["AmbienteFisico"] != '----------') { ?>
                                <td  style="font-size: large"><br>Ambiente Fisico:</td>
                                <td> <br> <?php echo $datos["AmbienteFisico"]; ?>  </td>
                            <?php } else if($datos["AmbienteFisico"] == ''){ ?>
                                <td></td>
                                <td></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <?php if ($datos["AmbienteFisico"] != '----------') { ?>
                                <td style="font-size: large">Nª Cama:<br></td>
                                <td  style="font-size: small"><?php foreach ($resultadosCama as $i => $valcama) { ?>
                                        <?php echo $valcama[1] ?>
                                    <?php } ?> <br></td>
                            <?php } else if($datos["AmbienteFisico"] == ''){ ?>
                                <td></td>
                                <td></td>
                            <?php } ?>


                        </tr>
                         <tr>
                            <?php if ($datos["destino"] != '---------') { ?>
                            <td style="font-size: large">Destino:<br></td>
                            <td colspan="2"  style="font-size: small"><?php echo $datos["destino"]; ?><br></td>
                            <?php } else if ($datos["destino"] == '---------') {?>
                            <td></td>
                            <td></td>
                            <?php }?>
                        </tr>
                        <tr>
                            <td style="font-size: large">Diagnosticos CIE:<br></td>
                            <td colspan="2"  style="font-size: small;"><table  border="0" style="min-width: 500px;">
                                    <thead class="jclmTbHtml">
                                        <tr>
                                            <th>Codigo</th>
                                            <th> Descripcion del Diagnostico</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($resultados as $i => $value) { ?>
                                            <tr>

                                                <td style="font-size: small"><?php echo htmlentities($value[1]) ?></td>
                                                <td style="font-size: small"><?php echo htmlentities($value[2]) ?></td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table><br></td>
                        </tr>
                       <tr>
                            <td style="font-size: large">Antecedentes:<br></td>
                            <td colspan="2"  style="font-size: small"><table  border="0" style="min-width: 500px;">
                                    <thead class="jclmTbHtml">
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Descripcion del Antecedentes</th>
                                            <th>Parentesco</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($resultadosAntecedentes as $i => $valueA) { ?>
                                            <tr>                                  
                                                <td style="font-size: small"><?php echo $valueA[0] ?></td>
                                                <td style="font-size: small"><?php echo $valueA[1] ?></td>
                                                <td style="font-size: small"><?php echo $valueA[2] ?></td>                               
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table></td>
                        </tr>
                        <tr align="center">
                            <td colspan="3" align="center">
                                <br><br>
                                <table align="center"> <tr>
                                        <td><?php
                                        $toolbar3 = new ToollBar("left");
                                        $toolbar3->SetBoton("ELIMINAR", "SALIR", "btn", "onclick,onkeypress", "SalirReportePaciente()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/salir.gif");
                                        $toolbar3->Mostrar();
                                        ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
        <!--        </div>-->

    </body>
</html>
