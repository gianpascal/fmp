<?php
$toolbar = new ToollBar("center");
$toolbar1 = new ToollBar("center");
?>
<input type="hidden" id="hidRango" name="hidRango"  value="<?php echo $datos["idRango"] ?>">
<input type="hidden" id="hidGrupo" name="hidGrupo"  value="<?php echo $datos["idGrupoDatos"] ?>">
<input type="hidden" id="hTipoDatos" name="hTipoDatos"  value="<?php echo $datos["tipoDatos"] ?>">

<div class="titleform" >
    <h1><?php echo $datos["nombreGrupo"] ?>  /  <?php echo $datos["nombreDatos"] ?>   </h1>
    <h2><?php echo $datos["nombreTipoDatos"] ?></h2>
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
                           <?php if ($datos["estadoSexo"] == 1) echo 'checked="checked"' ?>  id="checkSexo" onchange="activarSexo()"/>  
                </td>
                <td>
                    <select size="1" name="" id="cboSexo">
                        <option value="1"<?php if ($datos["sexo"] == 1) echo "selected" ?>  >Hombre</option>
                        <option value="0" <?php if ($datos["sexo"] == 0) echo "selected" ?>>Mujer</option>
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
                    <input type="checkbox" name="checkEdad" value="" onchange="activarEdad()"
                           <?php if ($datos["estadoEdad"] == 1) echo 'checked="checked"' ?>  id="checkEdad"/>
                </td>
                <td colspan="3">

                </td>
            </tr>
            <tr bgcolor="#C1E69D">
                <td>
                    <div id="div_RangoEdad"> Rango Edad </div> 
                </td>
                <td style="width:15px;float: center; height: auto; ">
                    <input type="text" id="txtEdadMinimo" name="txtEdadMinimo" value="<?php echo $datos["edadMinima"] ?>" size="3" 
                           maxlength="3" onkeypress="return validFormSalt('nro',this,event,'txtEdadMaximo')"/>
                </td>
                <td>
                    <div id="div_EdadEntre">Entre</div>
                </td>
                <td style="width:15px;float: center; height: auto; ">
                    <input type="text" id="txtEdadMaximo" name="txtEdadMaximo" value="<?php echo $datos["edadMaximo"] ?>" size="3" 
                           maxlength="3" onkeypress="return validFormSalt('nro',this,event,'')"/>
                </td>
                <td>
                    <table>
                        <tr>
                            <td>
                                <div id="div_infinitoEdadEditar">
                                    <h1> <b> ++∞ </b></h1>
                                </div>
                            </td>
                            <td>
                                <input type="checkbox" name="checkPositivoInfinitoEdadEditar" value="" 
                                       id="checkPositivoInfinitoEdadEditar"  <?php if ($datos["bMaximoEdadInfinito"] == 1) echo 'checked="checked"' ?>
                                       onchange="activarNegativoInfinitoEditar()"/>   
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
                    <div id="div_RangoResultadoBoole">Rango: </div>
                    <table>
                        <tr>
                            <td>
                                <div id="div_infinitoNegativoEditar">
                                    <h1> <b> --∞ </b></h1>
                                </div>
                            </td>
                            <td>
                                <input type="checkbox" name="checkNegativoInfinitoEditar" value="" 
                                       id="checkNegativoInfinitoEditar"  <?php if ($datos["bRangoInfinitoNegativo"] == 1) echo 'checked="checked"' ?>
                                       onchange="activarNegativoInfinitoRangoEditar()"/>   
                            </td>
                        </tr>
                    </table>
                </td>
                <td  <?php if ($datos["tipoDatos"] != 5) echo 'hidden' ?> > 
                    <input type="checkbox" name="checkBoolea" value="" 
                           <?php if ($datos["valorMinima"] == 1) echo 'checked="checked"' ?>  id="checkBoolea"/>
                </td>
                <td style="width:15px;float: center; height: auto; ">
                    <input type="text" id="txtValorMinimo" name="txtValorMinimo" value="<?php echo $datos["valorMinima"] ?>"
                           onkeypress="return validarTipoDatos(<?php echo $datos["tipoDatos"] ?>,this,event,'')"/>
                </td>

                <td style="width:15px;float: center; height: auto; "> 
                    <div id="div_EntreRangoResultado">Entre </div>
                </td>

                <td style="width:15px;float: center; height: auto; ">
                    <input type="text" id="txtValorMaximo" name="txtValorMaximo" value="<?php echo $datos["valorMaximo"] ?>"
                           onkeypress="return validarTipoDatos(<?php echo $datos["tipoDatos"] ?>,this,event,'')"/>
                </td>
                <td>
                    <table>
                        <tr>
                            <td>
                                <div id="div_infinitoPositivoEditar">
                                    <h1> <b> ++∞ </b></h1>
                                </div>
                            </td>
                            <td>
                                <input type="checkbox" name="checkPositivoInfinitoEditar" value="" 
                                       id="checkPositivoInfinitoEditar"  <?php if ($datos["bRangoInfinitoPositivo"] == 1) echo 'checked="checked"' ?>
                                       onchange="activarPositivoInfinitoRangoEditar()"/>   
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
                        <?php foreach ($arrayCombo as $key => $valuekey) { ?>
                            <option value="<?php echo $valuekey[2] ?>" <?php if ($valuekey[2] == $datos["valorMinima"]) echo "selected" ?>> <?php echo $valuekey[3] ?></option>
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
                    <textarea id="txtSignificado" name="txtSignificado" style="width: 200px; height: 150px;-ms-text-justify:justify;  " 
                              rows="1" cols="80" style="width:320px; font-family:Arial, Helvetica, sans-serif; font-size:12px" 
                              name="txtObservaciones" tabindex="25"  ><?php echo trim($datos["significado"]) ?></textarea>
                   <!-- <input type="text" id="txtSignificado" name="txtSignificado" value="< ?php echo $datos["significado"] ?>" />-->
                </td>
            </tr>
            <tr align="center" bgcolor="#C1E69D">
                <td colspan="2" align="center">
                    <?php
                    $toolbar->SetBoton("Modificar Rangos", "Modificar", "btn", "onclick,onkeypress", "modificarRangos()", "../../../../fastmedical_front/imagen/icono/apply.png", "", "", true);
                    $toolbar->Mostrar();
                    ?>
                </td>
                <td colspan="2" align="center">
                    <?php
                    $toolbar1->SetBoton("Cerrar Rangos", "Cerrar", "btn", "onclick,onkeypress", "cerrarRangos()", "../../../../fastmedical_front/imagen/icono/i_icq_dnd.png", "", "", true);
                    $toolbar1->Mostrar();
                    ?>
                </td>
            </tr>
        </table>
    </div>

</fieldset>  
