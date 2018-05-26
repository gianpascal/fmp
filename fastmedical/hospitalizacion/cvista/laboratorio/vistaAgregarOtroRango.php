<?php
$toolbar = new ToollBar("center");
$toolbar1 = new ToollBar("center");
?>
<input type="hidden" id="hiIdDatosPuntoControl" name="hiIdDatosPuntoControl"  value="<?php echo $datos["iIdDatosPuntoControl"] ?>">
<input type="hidden" id="hidGrupo" name="hidGrupo"  value="<?php echo $datos["idGrupoDatos"] ?>">
<input type="hidden" id="hTipoDatos" name="hTipoDatos"  value="<?php echo $datos["tipoDatos"] ?>">

<div class="titleform" >
    <h1><?php echo $datos["nombreGrupo"] ?>  /  <?php echo $datos["nombreDatos"] ?>   </h1><br>
    <h2> <?php echo $datos["nombreTipoDatos"] ?></h2>
</div>

<fieldset style="margin:5px;padding:5px;height:auto;width:auto;">

    <div align="center">
        <table align="center" >
            <tr bgcolor="#C1E69D">
                <td>
                    <div id="div_sexo"> sexo </div> 
                </td>
                <td>
                    <input type="checkbox" name="checkSexo" value="" 
                           id="checkSexo" checked="checked" onchange="activarSexo()"/>  
                </td>
                <td>
                    <select size="1" name="" id="cboSexo">
                        <option value="1">Hombre</option>
                        <option value="0">Mujer</option>
                    </select>
                </td>
                <td colspan="2">

                </td>
            </tr>
            <tr >
                <td>
                    <div id="div_Edad"> Edad </div>  
                </td>
                <td>
                    <input type="checkbox" name="checkEdad" value="" checked="checked" onchange="activarEdad()"
                           id="checkEdad"/>
                </td>
                <td colspan="3">

                </td>
            </tr>
            <tr bgcolor="#C1E69D">
                <td>
                    <div id="div_RangoEdad"> Rango Edad </div> 
                </td>
                <td style="width:15px;float: center; height: auto; ">
                    <input type="text" id="txtEdadMinimo" name="txtEdadMinimo" value=""
                           maxlength="3" onkeypress="return validFormSalt('nro',this,event,'txtEdadMaximo')"/>
                </td>
                <td>
                    <div id="div_EdadEntre">Entre</div>
                </td>
                <td style="width:15px;float: center; height: auto; ">
                    <input type="text" id="txtEdadMaximo" name="txtEdadMaximo" value=""
                           maxlength="3" onkeypress="return validFormSalt('nro',this,event,'txtEdadMaximo')"/>
                </td>
                <td>
                    <table>
                        <tr>
                            <td>
                                <div id="div_infinitoEdad">
                                    <h1> <b> ++ ∞ </b></h1>
                                </div>
                            </td>
                            <td>
                                <input type="checkbox" name="checkPositivoInfinitoEdad" value="" 
                                       id="checkPositivoInfinitoEdad" onchange="activarEdadPositivo()"/>
                            </td>
                        </tr>
                    </table>
                </td>    
            </tr>
            <tr >
                <td colspan="5" align="center" bgcolor="#C1E69D">
                    <div id="div_RangoResultados"> <b> Rango de Resultados</b> </div>  
                </td>
            </tr>    
            <tr bgcolor="#C1E69D">

                <td> 
                    <table>
                        <tr>
                            <td>
                                <div id="div_RangoResultadoBoole">Rango: </div>
                            </td>
                            <td <?php if ($datos["tipoDatos"] != 5) echo 'hidden' ?>>
                                <input type="checkbox" name="checkBoolea" value="" 
                                       id="checkBoolea"/>
                            </td>
                            <td <?php if ($datos["tipoDatos"] == 5) echo 'hidden' ?>>
                              <div id="div_infinitoNegativo">  <h1> <b> -- ∞ </b></h1></div>
                            </td>
                            <td <?php if ($datos["tipoDatos"] == 5) echo 'hidden' ?>>
                                <input type="checkbox" name="checkNegativoInfinito" value="" 
                                       id="checkNegativoInfinito" onchange="activarNegativoInfinito()"/>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width:15px;float: center; height: auto; ">
                    <input type="text" id="txtValorMinimo" name="txtValorMinimo" value=""
                           onkeypress="return validarTipoDatos(<?php echo $datos["tipoDatos"] ?>,this,event,'')" />
                </td>

                <td style="width:15px;float: center; height: auto; " > 
                    <div id="div_EntreRangoResultado">Entre </div>
                </td>

                <td style="width:15px;float: center; height: auto; ">
                    <input type="text" id="txtValorMaximo" name="txtValorMaximo" value=""
                           onkeypress="return   validarTipoDatos(<?php echo $datos["tipoDatos"] ?>,this,event,'')"/>
                </td>
                <td>
                    <table>
                        <tr>
                            <td <?php if ($datos["tipoDatos"] == 5) echo 'hidden' ?>>
                                <div id="div_infinitoPositivo"> <h1> <b> ++ ∞ </b></h1></div>
                            </td>
                            <td <?php if ($datos["tipoDatos"] == 5) echo 'hidden' ?>>
                                <input type="checkbox" name="checkPositivoInfinito" value="" 
                                       id="checkPositivoInfinito" onchange="activarPositivoInfinito()"/>
                            </td>
                        </tr>
                    </table>
                </td> 
            </tr>
            <tr >
                <td>
                    <div id="div_SeleccionCombo"> <h5> Seleccion del Combo </h5> </div> 
                </td>
                <td>
                    <select id ="cboTipoCombo" name="cboTipoCombo" >
                        <?php foreach ($arrayComboRango as $key => $value) { ?>
                            <option value="<?php echo $value[2] ?>"> <?php echo $value[3] ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td colspan="3">

                </td>
            </tr>
            <tr bgcolor="#C1E69D">
                <td >
                    <div id="div_Significado"> <b> Significado</b></div> 
                </td>
                <td colspan="4" align="justify">
                    <textarea id="txtSignificado" name="txtSignificado" cols="50" rows="5" ></textarea>
                    <!--<input type="text" id="txtSignificado" name="txtSignificado" value="< ?php echo $datos["significado"] ?>" />-->
                </td>
            </tr>
            <tr align="center" bgcolor="#C1E69D">
                <td colspan="2" align="center">
                    <?php
                    $toolbar->SetBoton("Guardar Rangos", "Guardar", "btn", "onclick,onkeypress", "GuardarRangos()", "../../../../fastmedical_front/imagen/icono/grabar.png", "", "", true);
                    $toolbar->Mostrar();
                    ?>
                </td>
                <td colspan="2" align="center">
                    <?php
                    $toolbar1->SetBoton("Cerrar Rangos", "Cerrar", "btn", "onclick,onkeypress", "cerrarGuardarRangos()", "../../../../fastmedical_front/imagen/icono/i_icq_dnd.png", "", "", true);
                    $toolbar1->Mostrar();
                    ?>
                </td>
            </tr>
        </table>
    </div>

</fieldset>  
