<?php
$fecha = date("d/m/Y");
$hora = date("H:i");
$exti = date("A");
?>
<input type="text" id="htxtCodigoPaciente" name="txtCodigoPaciente" value="<?php echo $datos["htxtCodigoPaciente"]; ?>" hidden=""/>
<input type="text" id="htxtiEmpleadoMedicoTratante" name="txtiEmpleadoMedicoTratante" hidden="" />
<input type="text" id="htxtidCentroCosto" name="txtidCentroCosto" hidden=""/>
<input type="text" id="htxtiEmpleadoMedicoOrdInt" name="txtiEmpleadoMedicoOrdInt" hidden="" />
<input type="text" id="htxtiEmpleadoMedicoAlta" name="txtiEmpleadoMedicoAlta" hidden="" />
<input type="text" id="htxtAmbLogicoTratante" name="txtAmbLogicoTratante" hidden=""/> 
<input type="text" id="htxtAmbFisicoLogicoOrdInt" name="txtAmbFisicoLogicoOrdInt" hidden="" /> 
<input type="text" id="htxtiAmbFisicoLogicoAlta" name="txtAmbLogicoTratante" hidden=""/> 
<input type="text" id="htxtiCodigoDestino" name="htxtiCodigoDestino" hidden=""/> 

<fieldset style="margin:auto;width:90%;height:auto; " align="center">
    <div class="titleform" style="width:100%;">
        <h1>TRANSFERENCIA DE PACIENTE<br></h1>
    </div>
    <div style="width: 100%"  align="center">
        <table  id="" align="center"  >

            <tr>
                <td style="font-weight:bold; width: 40%" colspan="2" align="center" >
                    Apellidos y Nombres:
                </td>
                <td colspan="7" align="center">
                    <?php echo $datos["htxtNombreCompleto"]; ?>
                </td>
            </tr>
            <tr>
                <td  style="font-weight:bold; width: 10%" align="center" > 
                    Edad:
                </td>
                <td colspan="4">
                    <?php echo $datos["htxtEdadPaciente"]; ?>
                </td>
                <td style="font-weight:bold;" > 
                    &nbsp;&nbsp;&nbsp;&nbsp;Sexo: &nbsp;&nbsp;
                </td>
                <td>
                    <?php echo $datos["htxtSexoPaciente"]; ?>
                </td>
                <td style="font-weight:bold;" > 
                    &nbsp;&nbsp;&nbsp;&nbsp;Afiliaci&oacute;n: &nbsp;&nbsp;
                </td>
                <td>
                    <?php
                    foreach ($resultadosAfiliacion as $i => $value) {
                        echo $value[1];?>
                    <input type="text" id="htxtcIdAfiliacion" value="<?php echo $value[0]; ?>" name="txtcIdAfiliacion" hidden=""/>
                 <?php   }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="9"><br><br></td>
            </tr>
            <tr>
                <td colspan="9" align ="center">
<!--                    <fieldset style="margin:auto;width:100%;height:auto; ">-->
                        <table >
                            <tr>
                                <td>
                                    Medico Ord. Int.:
                                </td>
                                <td>
                                    <input type="text" id="txtMedicoOrdInt" name="txtMedicoOrdInt" disabled="" size="45"/>

                                    <input id="btnMedicoOrdInt" type="button" style="cursor: pointer"
                                           onclick="busquedaMedicoOrdInt()" value="......." name="btnMedicoOrdInt" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Medico Tratante:
                                </td>
                                <td>
                                    <input type="text" id="txtMedicotratante" name="txtMedicotratante" disabled="" size="45"/>

                                    <input id="btnMedicotratante" type="button" style="cursor: pointer"
                                           onclick="busquedaMedicotratante()" value="......." name="btnMedicotratante" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Medico de Alta:
                                </td>
                                <td>
                                    <input type="text" id="txtMedicoAlta" name="txtMedicoAlta" disabled="" size="45"/>

                                    <input id="btnMedicoAlta" type="button" style="cursor: pointer"
                                           onclick="busquedaMedicoAlta()" value="......." name="btnMedicoAlta" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Area / Especialidad:
                                </td>
                                <td>
                                    <input type="text" id="txtDescripcionCentroCosto" name="txtDescripcionCentroCosto" disabled="" size="45"/>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Fecha de Ingreso:
                                </td>
                                <td>
                                    <input type="text" id="txtFechaIngreso" name="txtFechaIngreso"  size="12" onclick="calendarioHtmlx('txtFechaIngreso')" value="<?php echo $fecha; ?>"/>
                                    <input type="text" id="txtHoraIngreso" name="txtHoraIngreso"  size="7" value="<?php echo $hora; ?>"/>
                                    <input type="text" id="txtTurno" name="txtFechaIngreso"  size="2" disabled value="<?php echo $exti; ?>"/>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Piso:
                                </td>
                                <td>
                                    <select name="cboPisosAmbiente" id="cboPisosAmbiente" onchange="cboAmbienteFisicox()">
                                        <option value="0">SELECCIONAR PISO</option>
                                        <option value="1">Piso 1</option>
                                        <option value="2">Piso 2</option>
                                        <option value="3">Piso 3</option>
                                        <option value="4">Piso 4</option>
                                        <option value="5">Piso 5</option>
                                    </select>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Ambiente F&iacute;sico:
                                </td>
                                <td>
                                    <div id="div_cboAmbienteFisico"></div>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Cama:
                                </td>
                                <td>
                                    <div id="div_cboCama"></div>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Destino:
                                </td>
                                <td>
                                    <select name="" id="comboDestinoP" onchange="CargaCodigoDestino()">
                                        <option value="">Seleccionar Destino</option>
                                        <?php foreach ($resultadosDestino as $a => $valuea) { ?>
                                            <option value="<?php echo $valuea[0]; ?>">
                                                <?php echo $valuea[1]; ?>
                                            </option>                                                 
                                        <?php } ?> 
                                    </select>
                                </td>
                                <td>
                                </td>
                            </tr>
                        </table>
<!--                    </fieldset>-->
                </td>
            </tr>
            <tr align="center">
                <td colspan="9"> 
                    <table>
                        <tr>
                            <td>
                                <?php
                                $toolbar3 = new ToollBar("left");
                                $toolbar3->SetBoton("GRABAR", "GRABAR", "btn", "onclick,onkeypress", "guardarTransferenciaPaciente()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/grabar.png");
                                $toolbar3->Mostrar();
                                ?>
                            </td>
                            <td>
                                <?php
                                $toolbar3 = new ToollBar("left");
                                $toolbar3->SetBoton("ELIMINAR", "SALIR", "btn", "onclick,onkeypress", "cerrarTransferenciaPaciente()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/salir.gif");
                                $toolbar3->Mostrar();
                                ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

        </table>
    </div>
</fieldset>
