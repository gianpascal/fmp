<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<style type="text/css">
    <!--
    .Estilo6{width:140px;height:20px;font-size: 14px; font-weight: bold;font-family: Arial;}
    .Estilo7{width:300px;height:20px;font-size: 14px; font-weight: bold;font-family: Arial;}
    .Estilo8{width:230px;height:40px;font-size: 14px; font-weight: bold;font-family: Arial;}
    .Estilo9{text-decoration: underline;font-weight: bold;font-family: Arial;font-size: 14px;}
    -->

</style>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <input type="text" id="htxtCodigoPaciente" name="htxtCodigoPaciente" hidden="" value="<?php echo $datos["codigoPaciente"]; ?>"/>
   <input type="text" id="htxtcIdAfiliacion" name="txtcIdAfiliacion" hidden="" value=""/>
    <input type="text" id="htxtNombreCompleto" name="htxtNombreCompleto" hidden="" value="<?php echo $datos["nombrePacienteCompleto"]; ?>"/>
    <input type="text" id="htxtSexoPaciente" name="htxtSexoPaciente" hidden="" value="<?php echo $datos["sexoPaciente"]; ?>"/>
    <input type="text" id="htxtEdadPaciente" name="htxtEdadPaciente" hidden="" value="<?php echo $datos["edadPaciente"]; ?>"/>
    <input type="text" id="htxtCodigoHospitalizacion" name="htxtCodigoHospitalizacion" hidden=""  value="<?php echo $datos["codigoHospitalizacion"]; ?> "/>
<!--     <input type="text" id="htxtcIdHospitalizacionSiguiente" name="htxtcIdHospitalizacionSiguiente"  
            value="<?php echo $datos["codigoHospitalizacionSiguiente"]; ?> "/>-->
   <!--     <div style="width: auto; height: auto" align="center">-->  
    <fieldset  style="margin:auto;width:auto;height:auto; " align="center">
        <!--                    <fieldset  style="margin:auto;width:80%;" >-->
        <div style="width: 100%"  align="center">
            <div class="titleform" style="width:100%;">
                <h1>Consulta de Pacientes Detallada<br></h1>
            </div>
            <table border="0" width="740" cellspacing="2"  align="center" >
                <tbody>
                    <tr>
                        <td width="149" class="Estilo6">Codigo: <br></td>
                        <td width="240"  style="FONT-FAMILY: Arial"><?php echo $datos["codigoPaciente"]; ?> <br></td>

                        <td width="193" rowspan="6" align="center" style="font-size: medium">DNI: <?php echo $DNI; ?><br><img src="<?php echo $fotoPersona; ?>" alt="" width="110" height="130"></td>
                    </tr>
                    <tr>
                        <td class="Estilo6">Paciente:<br></td>
                        <td  style="FONT-FAMILY: Arial"><?php echo $datos["nombrePacienteCompleto"]; ?> <br></td>
                    </tr>
                    <tr>
                        <td class="Estilo6">Edad:<br></td>
                        <td  style="FONT-FAMILY: Arial"><?php echo $datos["edadPaciente"]; ?> <br></td>
                    </tr>
                    <tr>
                        <td class="Estilo6">Fecha Entrada:<br></td>
                        <td  style="FONT-FAMILY: Arial"><?php echo $datos["fechaEntrada"]; ?> <br></td>
                    </tr>
                    <tr>
                        <td class="Estilo6">Hora Entrada:<br></td>
                        <td  style="FONT-FAMILY: Arial"><?php echo $datos["horaIngreso"]; ?> <br></td>
                    </tr>
                    <tr>
                        <td class="Estilo6">Sexo:</td>
                        <td  style="FONT-FAMILY: Arial"><?php echo $datos["sexoPaciente"]; ?> <br></td>
                    </tr>
                    <tr>
                        <td class="Estilo6"><br>Medico Tratante:<br></td>
                        <td  style="FONT-FAMILY: Arial"><br><?php echo $datos["nombreMedicoTratante"]; ?> </td>
                    </tr>
                    <tr>
                        <td class="Estilo6"><br>Medico Alta:<br></td>
                        <td  style="FONT-FAMILY: Arial"><br><?php echo $datos["nombreMedicoAlta"]; ?> </td>
                    </tr>

                    <tr>
                        <td  class="Estilo6"><br>Ambiente Fisico:</td>
                        <td style="FONT-FAMILY: Arial"> <br> <?php echo $datos["nombreAmbienteFisco"]; ?>  </td>
                    </tr>
                    <tr>
                        <td class="Estilo6">Nª Cama:<br></td>
                        <td style="FONT-FAMILY: Arial"><?php echo $datos["numeroCama"]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="Estilo6">Destino:<br></td>
                        <td colspan="2"  style="FONT-FAMILY: Arial"><?php echo $datos["descripcionDestino"]; ?><br></td>
                    </tr>
<!--                        <tr>
                        <td style="font-size: large">Diagnosticos CIE:<br></td>
                        <td colspan="2"  style="font-size: small;"><table  border="0" style="min-width: 500px;">
                                <thead class="jclmTbHtml">
                                    <tr>
                                        <th>Diagnostico Entrada</th>
                                        <th> Diagnostico Salida</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    < ?php foreach ($resultadosDiagEntrada as $i => $value) { ?>
                                        <tr>

                                            <td style="font-size: small">< ?php echo htmlentities($value[1]) ?></td>
                                            <td style="font-size: small">< ?php echo htmlentities($value[2]) ?></td>

                                        </tr>
                                    < ?php } ?>
                                </tbody>
                            </table><br></td>
                    </tr>-->
                    <tr align="center">
                        <td colspan="3" align="center">
                            <br><br>
                            <table align="center"> <tr>
                                    <td><?php
                                            $toolbar3 = new ToollBar("left");
                                            $toolbar3->SetBoton("ELIMINAR", "SALIR", "btn", "onclick,onkeypress", "SalirReportePaciente()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/salir.gif");
                                            $toolbar3->Mostrar();
                                            ?>
                                    </td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td>
                                        <?php
                                        if($datos["codigoHospitalizacionSiguiente"]==''){
                                        $toolbar3 = new ToollBar("left");
                                        $toolbar3->SetBoton("ELIMINAR", "TRANSFERENCIA(INTERNA)", "btn", "onclick,onkeypress", "TranferenciaDePaciente()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/transferir.gif");
                                        $toolbar3->Mostrar();
                                        }
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