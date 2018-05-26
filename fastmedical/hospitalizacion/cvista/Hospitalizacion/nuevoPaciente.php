<?php
//$fecha = date("d/m/Y");
//$hora = date("H:i");
//$exti = date("A");

$fecha = $resultadoHora[0][0];
$hora = $resultadoHora[0][1];
$exti = $resultadoHora[0][2];
?>
<fieldset  style="margin:auto;width:80%;height:auto; "> 

    <div class="titleform" style="width:100%;">
        <h1>REGISTRO PACIENTE<br></h1>
    </div>
    <fieldset style="margin:auto;width:auto;height:auto; ">


        <input type="text" id="htxtCodigoPaciente" name="txtCodigoPaciente" hidden=""/>
        <input type="text" id="htxtiEmpleadoMedicoTratante" name="txtiEmpleadoMedicoTratante" hidden="" />
        <input type="text" id="htxtidCentroCosto" name="txtidCentroCosto" hidden=""/>
        <input type="text" id="htxtiEmpleadoMedicoOrdInt" name="txtiEmpleadoMedicoOrdInt" hidden="" />
        <input type="text" id="htxtiEmpleadoMedicoAlta" name="txtiEmpleadoMedicoAlta" hidden="" />
        <input type="text" id="htxtcIdAfiliacion" name="txtcIdAfiliacion" hidden=""/>
        <input type="text" id="htxtAmbLogicoTratante" name="txtAmbLogicoTratante" hidden=""/> 
        <input type="text" id="htxtAmbFisicoLogicoOrdInt" name="txtAmbFisicoLogicoOrdInt" hidden="" /> 
        <input type="text" id="htxtiAmbFisicoLogicoAlta" name="txtAmbLogicoTratante" hidden=""/> 
        <input type="text" id="htxtiCodigoDestino" name="htxtiCodigoDestino" hidden=""/> 

        <table id="" width="650px;" cellspacing="1" align="center" border="1">
            <tr>
                <td style="font-weight:bold;" align="center">
                    <h2>BUSQUEDA DEL PACIENTE:</h2> 
<!--                    <input id="txtnombrePaciente" type="text" name="txtnombrePaciente"/>-->

<!--                        <td colspan="4" align="center" >-->
                    <a href="javascript:nuevoPacienteHospitalizacion();">
                        <img border="0" title="Buscar" alt="" src="../../../../fastmedical_front/imagen/btn/b_buscar_on.gif"/></a>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <table  id="tbaNuevoPaciente" align="center" style="display: none">
                        <tr>
                            <td style="font-weight:bold;" >
                                Filiaci&oacute;n:
                            </td>
                            <td>
                                <input id="txtfiliacion" name="txtfiliacion" type="text" disabled="" style="border: 0"/>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;" >
                                Apellidos:
                            </td>
                            <td>
                                <input type="text" id="txtApellidos" name="txtApellidos" disabled="" style="border: 0" />
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td style="font-weight:bold;" > 
                                Edad:
                            </td>
                            <td>
                                <input type="text" id="txtEdad" name="txtEdad" disabled="" style="border: 0"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;" >
                                Nombre:
                            </td>
                            <td>
                                <input type="text" id="txtNombre" name="txtNombre" disabled="" style="border: 0"/>
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td style="font-weight:bold;" > 
                                Sexo:
                            </td>
                            <td>
                                <input type="text" id="txtSexo" name="txtSexo" disabled="" style="border: 0"/>
                            </td>
                        </tr>
                    </table>
                </td>

            </tr> 
            <tr align="center">
                <td align="center">
                    <!--                    <fieldset style="margin:auto;width:80%;height:auto; ">-->
                    <div align="center">
                        <table border="1" align="center">
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
<!--                            <tr>
                                <td>
                                    Diagnostico Ingreso:
                                </td>
                                <td>
                                    <select name="" id="comboDiagnosticoEntrada" >
                                        <option value="">Seleccionar Diagnostico</option>
                                        < ?php foreach ($resultadosDiagnostico as $a => $valuea) { ?>
                                            <option value="< ?php echo $valuea[0]; ?>">
                                                < ?php echo $valuea[1]; ?>
                                            </option>                                                 
                                        < ?php } ?> 
                                    </select>
                                </td>
                                <td>
                                </td>
                            </tr>-->
<!--                            <tr>
                                <td>
                                    Diagnostico Salida:
                                </td>
                                <td>
                                    <select name="" id="comboDiagnosticoSalida" >
                                        <option value="">Seleccionar Diagnostico Salida</option>
                                        < ?php foreach ($resultadosDiagnostico as $a => $valuea) { ?>
                                            <option value="< ?php echo $valuea[0]; ?>">
                                                < ?php echo $valuea[1]; ?>
                                            </option>                                                 
                                        < ?php } ?> 
                                    </select>
                                </td>
                                <td>
                                </td>
                            </tr>-->
                        </table>
                        <!--                    </fieldset>-->
                    </div>
                </td>

            </tr>
            <tr align="center">
                <td> 
                    <table>
                        <tr>
<!--                            <td align="center">
                                <a href="javascript:PacienteGuardarHospitalizacion();">
                                    <img border="0" title="Buscar" alt="" src="../../../../fastmedical_front/imagen/btn/b_grabar__on.gif"/></a>   
                            </td>-->

                            <td>
                                <?php
                                $toolbar3 = new ToollBar("left");
                                $toolbar3->SetBoton("GRABAR", "GRABAR", "btn", "onclick,onkeypress", "PacienteGuardarHospitalizacion()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/grabar.png");
                                $toolbar3->Mostrar();
                                ?>
                            </td>
                            <td>
                                <?php
                                $toolbar3 = new ToollBar("left");
                                $toolbar3->SetBoton("ELIMINAR", "SALIR", "btn", "onclick,onkeypress", "cerrarPaciente()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/salir.gif");
                                $toolbar3->Mostrar();
                                ?>
                            </td>
<!--                        <td>-->
                            <!--                            <a href="javascript:cerrarPaciente();">
                                                            <img border="0" title="Buscar" alt="" src="../../../../fastmedical_front/imagen/icono/salir.gif"/></a>
                                                    </td>-->
                        </tr>
                    </table>
                </td>
            </tr>


        </table>
    </fieldset>

</fieldset > 