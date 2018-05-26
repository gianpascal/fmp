<?php
$toolbar1 = new ToollBar("center");
$toolbar2 = new ToollBar("right");
$toolbar3 = new ToollBar("center");
$toolbar4 = new ToollBar("center");
?>

<table border="1">
    <tr >
        <td style=" width: 800px; height: 500px" align="center">
            <table border="1">
                <tr>
                    <td>
                        <b> Afiliaci&oacute;n:
                    </td>
                    <td>
                        <select id="cboAfiliacionGrupoEtario" onchange="buscarGrupoEtarioPorAfiliacion()">
                            <?php foreach ($resultadoAfiliacion as $i => $value) { ?>
                                <option value="<?php echo $value[0] ?>" 
                                        <?php if ($value[0] == '0027') echo ' selected'; ?>>
                                            <?php echo $value[1] ?>
                                </option> 
                            <?php } ?>
                        </select>
                    </td>
                </tr> 
                <tr>
                    <td colspan="2">
                        <div id="div_tablaGrupoEtario" style="width:630px; height:550px;"></div>
                    </td>
                </tr>
                <tr  align ="center">
                    <td colspan="2" align ="center">
                        <?php
                        $toolbar1->SetBoton("Nuevo", "Nuevo", "btn", "onclick,onkeypress", "buscarPorBotonPersonaCarnetizacion()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/nuevo.png", "", "", 1);
                        $toolbar1->Mostrar();
                        ?>
                    </td>
                </tr> 
            </table>            
            <!-- Fin de parte Izquierda      -->
        </td>
        <td style=" width: 1600px; height: 120px">
            <table border="1">
                <tr>
                    <td>
                        <b>ID </b> 
                    </td>
                    <td><input name="txtidGrupoEtario" id="txtidGrupoEtario" />   </td>
                    <td>
                        <b>Afiliaci&oacute;n: </b> 
                    </td>
                    <td>
                        <select id="cboAfiliacionGrupoEtario2">
                            <?php foreach ($resultadoAfiliacion as $i => $value) { ?>
                                <option value="<?php echo $value[0] ?>"  id="<?php echo $value[0] ?>"
                                        <?php if ($value[0] == '0027') echo ' selected'; ?>>
                                            <?php echo $value[1] ?>
                                </option> 
                            <?php } ?>
                        </select>
                    </td>

                </tr>
                <tr>
                    <td>
                        <b>Codigo </b> 
                    </td>
                    <td><input name="txtCodigoGrupoEtario" id="txtCodigoGrupoEtario"  />   </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <b>Sexo </b> 
                    </td>
                    <td>
                    <select id="cboSexo" > 
                        <option value="0" id="0">Mujer</option>
                        <option value="1" id="1">Hombre</option>
                    </select>    
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <b>Inicio </b> 
                    </td>
                    <td><input name="txtInicio" id="txtInicio"  />   </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <b>Fin </b> 
                    </td>
                    <td><input name="txtFin" id="txtFin"  />   </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <b>Descripci&oacute;n </b> 
                    </td>
                    <td colspan="3"> <textarea name="txtdescripcion" rows="2" cols="40" id="txtdescripcion"  >   </textarea> 
                    </td>

                </tr>
                <tr align="center">
                    <td colspan ="2">  <?php
                            $toolbar2->SetBoton("Editar", "Editar", "btn", "onclick,onkeypress", "editarGrupoEtario()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/edit2.png", "", "", 1);
                            $toolbar2->Mostrar();
                            ?></td>
                    <td colspan ="2">  <?php
                        $toolbar3->SetBoton("Guardar", "Guardar", "btn", "onclick,onkeypress", "buscarPorBotonPersonaCarnetizacion()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/grabar.png", "", "", 1);
                        $toolbar3->Mostrar();
                            ?></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div id="div_CPTSevicios"  style="width:550px; height:350px;"></div>            
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <?php
                        $toolbar4->SetBoton("Agregar", "Agregar", "btn", "onclick,onkeypress", "agregarNuevoServicioPorGRupoEtario()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/abrir.png", "", "", 1);
                        $toolbar4->Mostrar();
                        ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>