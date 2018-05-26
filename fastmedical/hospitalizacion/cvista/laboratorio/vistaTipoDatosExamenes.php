<?php
$toolbar = new ToollBar("center");
?>

<input type="hidden" id="hcantidadFinas" name="hcantidadFinas"  value="<?php echo $columnaGrupo ?>">


<div class="titleform" >
    <h1><?php echo $datos["nombreExamen"] ?>  /  <?php echo $datos["nombrePuntoControl"] ?>   </h1>

    <div id="div_mostrarTablasExamenYpuntoControl">
        <a href="javascript:mostrarTablasExamenYpuntoControl();"> <img border="0" title="Nuevo" alt="" src="../../../../fastmedical_front/imagen/icono/agt_upgrade_misc.png"/></a>
    </div>

</div>

<fieldset style="margin:5px;padding:5px;height:auto;width:auto;">
    <div style="width:950px;height:150px; border:#000 2px solid; overflow:scroll" id="div_barrraDesplazante" align="center">
        <div id="div_Rangos" class="toolbar" style="width:1250px;float: center; height: 150px; " align="center">
            <table align="center" >
                <thead>
                    <tr>

                        <th onclick="produccion()" bgColor="#D7E9FF">
                <div  style="background-color: #D7E9FF;text-align:center;text-transform: capitalize;font-family: Arial;font-size: 16pt
                      ; background-image:url(../imagen/inicio/ini_toolbar.gif )"> 
                    En Producci&oacute;n
                </div>
                </th>

                <th onclick="desarrollo()" bgColor="red">En Desarrollo</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">

                            <div id="div_Produccion" align="center">
                                <!-- ===================================================================================================================================-->                             
                                <div class="titleform" >  
                                    <table>
                                        <tr>
                                            <td style="width:500px;float: center; height: auto; "></td>
                                            <td>

                                                <h3 style="background-color: #C1E69D"> <blink>
                                                        <big>PRODUCCI&Oacute;N </big>
                                                    </blink>
                                                </h3>
                                            </td>
                                            <td style="width:200px;float: center; height: auto; "></td>
                                        </tr>
                                    </table> 
                                </div>

                                <table>
                                    <tr bgcolor="#C1E69D">
                                        <td colspan="2">
                                            <table>
                                                <tr>
                                                    <td style="width:200px;float: center; height: auto; ">

                                                    </td>
                                                    <td style="width:30px;float: center; height: auto; ">

                                                    </td>
                                                    <td style="width:80px;float: center; height: auto; " align="center">
                                                    </td>
                                                    <td>

                                                    </td>
                                                </tr>
                                            </table>
                                        </td>


                                    </tr>
                                    <?php
                                    foreach ($arrayFilasProduccion as $p => $valuep) {
                                        if (($p + 1) % 2 == 0)
                                            $class = "jclmTbPar";
                                        else
                                            $class = "jclmTbImpar";
                                        ?>
                                        <tr class="<?php echo $class; ?>" > 
                                            <td colspan="2">
                                                <table >
                                                    <tr>
                                                        <td style="width:auto;float: center; height: auto; ">
                                                            <input type="hidden" id="hcantidadParaEditarp<?php echo $k ?>" name="hcantidadParaEditar"  value="0">
                                                            <div id=""> <!-- Nombre del Grupo -->
                                                                <font size="2" color="blue" style="width:90px;font:10pt;font:bold;color:#0000FF"><B><?php echo $valuep[1] ?></b> </font>
                                                                <input type="hidden" id="idGrupoDatosp<?php echo $k ?>" name="idGrupoDatos"  value="<?php echo $valuep[0] ?>">
                                                            </div> 

                                                        </td>
                                                        <td style="width:80px;float: center; height: auto; " align="center">

                                                        </td> 
                                                    </tr>
                                                </table>    
                                            </td>           
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table border="1" style="width: 1200px; height: 150px" >

                                                    <tr>
                                                        <td style="width: 800px;">
                                                            <div >
                                                                <table > <!-- ingresar Nuevos Datos -->
                                                                    <thead>
                                                                        <tr bgColor="#C1E69D">
                                                                            <th hidden>codigo Dato Punto Control</th>
                                                                            <th><h6>NOMBRE DEL DATO</h6></th>
                                                                    <th><h6>TIPO DE DATOS</h6></th>
                                                                    <th><h6>TIPO UNIDADES DE MEDIDA</h6></th>
                                                                    <th><h6>UNIDADES DE MEDIDA</h6></th>
                                                                    <th><h6>En Result.</h6></th>
                                                                    <th><h6>Obligatorio</h6></th>
                                                                    <th><h6>Orden</h6></th>  
                                                                    <th colspan="4" style="width:600px;float: center; height: auto; "><h6>Rango</h6></th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        <?php
                                                                        if (!empty($valuep[2])) {
                                                                            foreach ($valuep[2] as $y => $valuey) {
                                                                                if (($y + 1) % 2 == 0)
                                                                                    $class = "jclmTbPar2";
                                                                                else
                                                                                    $class = "jclmTbImpar";
                                                                                ?>
                                                                                <tr align="center" class="<?php echo $class ?>">
                                                                                    <td hidden>
                                                                                        <input type="txt" id="hIdDatosPuntoControlP<?php echo $k ?><?php echo $y ?>" name="hIdDatosPuntoControl"  value="<?php echo $valuey[0] ?>">   
                                                                                    </td>
                                                                                    <td align="center">
                                                                                        <input type="txt" id="txtNombreDatosP<?php echo $k ?><?php echo $y ?>" name="txtNombreDatos"  value="<?php echo $valuey[6] ?>" disabled="true">   
                                                                                        <input type="hidden" id="hNombreDatosAntiguoP<?php echo $k ?><?php echo $y ?>" name="hNombreDatosAntiguo"  value="<?php echo $valuey[6] ?>">   
                                                                                    </td>
                                                                                    <td>
                                                                                        <table>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <select name="cboTipoDatosP<?php echo $k ?><?php echo $y ?>" id="cboTipoDatosP<?php echo $k ?><?php echo $y ?>" disabled="true" 
                                                                                                            >
                                                                                                        <option value=""> seleccionar</option>
                                                                                                        <?php foreach ($arrayTiposDatos as $m => $valuem) { ?>      
                                                                                                            <option value="<?php echo $valuem[0] ?>" <?php if ($valuey[2] == $valuem[0]) echo "selected" ?>> <?php echo $valuem[1] ?> </option>
                                                                                                        <?php } ?>
                                                                                                    </select>
                                                                                                    <input type="hidden" id="hTipoDatosAntiguoP<?php echo $k ?><?php echo $y ?>" name="hTipoDatos"  value=""> 

                                                                                                </td>
                                                                                                <td>

                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </td>
                                                                                    <td>
                                                                                        <select name="cboTipoUnidadDeMedidaP<?php echo $k ?><?php echo $y ?>" id="cboTipoUnidadDeMedidaP<?php echo $k ?><?php echo $y ?>" disabled="true">
                                                                                            <option value=""> seleccionar</option>
                                                                                            <?php foreach ($arrayTipoUnidadDeMedida as $n => $valuen) { ?>      
                                                                                                <option value="<?php echo $valuen[0] ?>" <?php if ($valuey[8] == $valuen[0]) echo "selected" ?>> <?php echo $valuen[1] ?> </option>
                                                                                            <?php } ?>
                                                                                        </select>                                                                                        
                                                                                    </td>
                                                                                    <td>
                                                                                        <select name="cboUnidadDeMedidaP<?php echo $k ?><?php echo $y ?>" id="cboUnidadDeMedidaP<?php echo $k ?><?php echo $y ?>"  disabled="true">
                                                                                            <option value="<?php echo $valuey[3] ?>"> <?php echo $valuey[4] ?> </option>
                                                                                        </select>
                                                                                    </td>
                                                                                    <td>
                                                                                        <input type="checkbox" name="checkMuestraDatosEnExamenP<?php echo $k ?><?php echo $y ?>" value="" 
                                                                                        <?php if ($valuey[5] == 1) echo 'checked="checked"' ?>
                                                                                               id="checkMuestraDatosEnExamenP<?php echo $k ?><?php echo $y ?>" disabled="true"/>

                                                                                    </td>
                                                                                    <td>
                                                                                        <input type="checkbox" name="checkMuestraDatosEnExamenp<?php echo $k ?><?php echo $y ?>" value="" 
                                                                                        <?php if ($valuey[10] == 1) echo 'checked="checked"' ?>
                                                                                               id="checkObligatorio<?php echo $k ?><?php echo $y ?>" disabled="true"/>
                                                                                        <input type="hidden" id="hcheckObligatoriop<?php echo $k ?><?php echo $y ?>" name="checkMuestraDatosEnExamenp"  
                                                                                               value="<?php echo $valuey[10] ?>">
                                                                                    </td>
                                                                                    <td><!-- orden -->
                                                                                        <?php echo $valuey[7] ?>
                                                                                    </td>      

                                                                                    <td align="center" style="width:auto;float: center; height: auto; ">
                                                                                        <div style="width:600px;height:auto; border:#000 2px solid; overflow:scroll" id="div_barrraDesplazanteL">
                                                                                            <div id="div_RangosL" class="toolbar" style="width:auto;float: center; height: auto; " align="center">
                                                                                                <table >
                                                                                                    <tr bgcolor="#C1E69D" align="center">
                                                                                                        <td hidden ><h6>iCodigo</h6></td>
                                                                                                        <td style="width:200px;float: center; height: auto; "><h6>Edad</h6></td>
                                                                                                        <td style="width:30px;float: center; height: auto; "><h6>Sexo</h6></td>
                                                                                                        <td style="width:380px;float: center; height: auto; "><h6>Rango</h6></td>
                                                                                                        <td style="width:280px;float: center; height: auto; "><h6>Significado</h6></td>

                                                                                                    </tr>
                                                                                                    <?php
                                                                                                    foreach ($valuey[11] as $x => $valuex) {
                                                                                                        if (($x + 1) % 2 == 0)
                                                                                                            $classa = "jclmTbPar2";
                                                                                                        else
                                                                                                            $classa = "jclmTbImpar";
                                                                                                        ?> 
                                                                                                        <tr align="center" class="<?php echo $classa ?>" >
                                                                                                            <td hidden>
                                                                                                                <?php echo $valuex[0] ?> 
                                                                                                                <input type="hidden" id="hidRango<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hidCodigoDatosPuntoControl"  value="<?php echo $valuex[0] ?> ">
                                                                                                            </td>
                                                                                                            <td style="width:200px;float: center; height: auto; ">
                                                                                                                <?php echo $valuex[10] ?>
                                                                                                                <input type="hidden" id="hiedadMinima<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hiedadMinima"  value="<?php echo $valuex[1] ?> ">
                                                                                                                <input type="hidden" id="hiedadMaximo<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hiedadMaximo"  value="<?php echo $valuex[2] ?> ">
                                                                                                                <input type="hidden" id="hEstadoEdad<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hEstadoEdad"  value="<?php echo $valuex[8] ?> ">
                                                                                                               
                                                                                                            </td>
                                                                                                            <td style="width:30px;float: center; height: auto; ">
                                                                                                                <?php echo $valuex[9] ?> 
                                                                                                                <input type="hidden" id="hSexo<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hSexo"  value="<?php echo $valuex[3] ?> ">
                                                                                                                <input type="hidden" id="hEstadoSexo<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hEstadoSexo"  value="<?php echo $valuex[7] ?> ">
                                                                                                                <input type="hidden" id="hSexoTexto<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hSexoTexto"  value="<?php echo $valuex[9] ?> ">
                                                                                                            </td>
                                                                                                            <td style="width:45px;float: center; height: auto; ">
                                                                                                                <?php if ($valuex[12] == 5) { ?>
                                                                                                                    <img src="<?php echo htmlentities($valuex[11]); ?>">   
                                                                                                                    <?php
                                                                                                                } else {
                                                                                                                    echo htmlentities($valuex[11]);
                                                                                                                }
                                                                                                                ?>
                                                                                                                <input type="hidden" id="hiValorMinimap<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hiValorMinimap"  value="<?php echo $valuex[4] ?> ">
                                                                                                                <input type="hidden" id="hiValorMaximop<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hiValorMaximop"  value="<?php echo $valuex[5] ?> ">
                                                                                                            </td>
                                                                                                            <td style="width:180px; height: auto; " align="justify">
                                                                                                                <?php echo trim(utf8_encode($valuex[6])) ?> 
                                                                                                                <input type="hidden" id="hSignificado<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hSignificado"  value="<?php echo utf8_encode($valuex[6]) ?> ">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    <?php } ?> 

                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>    

                                                                                </tr>           
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>


                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:auto;float: center; height: 8px; ">
                                                            <!-- espacio para cada Dato -->
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </table>
                            </div>  

                            <div id="div_EnDesarrollo" align="center">
                                <div class="titleform" >   
                                    <table>
                                        <tr>
                                            <td style="width:500px;float: center; height: auto; "></td>
                                            <td><h3 style="background-color: red"> <blink>
                                                        <big><font style="color:#ffffff">DESARRROLLO</font> </big>
                                                    </blink>
                                                </h3>
                                            </td>
                                            <td style="width:200px;float: center; height: auto; "></td>
                                        </tr>
                                    </table> 
                                </div>  
                                <table>
                                    <tr bgcolor="#C1E69D">
                                        <td colspan="2">
                                            <table>
                                                <tr>
                                                    <td style="width:200px;float: center; height: auto; ">
                                                        <h3> <b>AGREGAR NUEVO GRUPO </b></h3>
                                                    </td>
                                                    <td style="width:30px;float: center; height: auto; ">
                                                        <a href="javascript:popapParaCrearNuevoGrupo();"> <img border="0" title="Nuevo Grupo" alt="" src="../../../../fastmedical_front/imagen/btn/b_adiciona_on.gif"/></a>
                                                    </td>
                                                    <td style="width:80px;float: center; height: auto; " align="center">
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $toolbar->SetBoton("Confirmar a Produccion", "Confirmar a Produccion", "btn", "onclick,onkeypress", "confirmarAproduccion()", "../../../../fastmedical_front/imagen/icono/window_new.png", "", "", true);
                                                        $toolbar->Mostrar();
                                                        ?> 
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>


                                    </tr>
                                    <?php
                                    foreach ($arrayFilas as $k => $value) {
                                        if (($k + 1) % 2 == 0)
                                            $class = "jclmTbPar";
                                        else
                                            $class = "jclmTbImpar";
                                        ?>
                                        <tr class="<?php echo $class; ?>" > 
                                            <td colspan="2">
                                                <table>
                                                    <tr>
                                                        <td style="width:auto;float: center; height: auto; ">
                                                            <input type="hidden" id="hcantidadParaEditar<?php echo $k ?>" name="hcantidadParaEditar"  value="0">
                                                            <div id="div_grupoDatos<?php echo $k ?>"> <!-- Nombre del Grupo -->
                                                                <font size="2" color="blue" style="width:90px;font:10pt;font:bold;color:#0000FF"><B><?php echo $value[1] ?></b> </font>
                                                                <input type="hidden" id="idGrupoDatos<?php echo $k ?>" name="idGrupoDatos"  value="<?php echo $value[0] ?>">
                                                            </div> 
                                                            <div id="div_grupoDatosEditar<?php echo $k ?>">
                                                                <font size="4" color="blue" style="width:90px;font:10pt;font:bold;color:#0000FF">
                                                                <input type="txt" id="nombreGrupoDatosEditar<?php echo $k ?>" name="nombreGrupoDatosEditar"  value="<?php echo $value[1] ?>"> </font>
                                                                <input type="hidden" id="idGrupoDatos<?php echo $k ?>" name="idGrupoDatos"  value="<?php echo $value[0] ?>">
                                                                <input type="hidden" id="hicantidadDatos<?php echo $k ?>" name="icantidadDatos"  value="<?php echo $value[3] ?>">
                                                            </div>
                                                        </td>
                                                        <td style="width:80px;float: center; height: auto; " align="center">
                                                            <div id="div_grupoDatosBoton<?php echo $k ?>">
                                                                <table>
                                                                    <tr align="center" bgcolor="#C1E69D">
                                                                        <td style="width:15px;float: center; height: auto; ">
                                                                            <a href="javascript:editarGrupoDatos(<?php echo $k ?>);"> <img border="0" title="Editar" alt="" src="../../../../fastmedical_front/imagen/icono/editar.png"/></a>
                                                                        </td>
                                                                        <td style="width:40px;float: center; height: auto; ">
                                                                            <a href="javascript:eliminarGrupoDatos(<?php echo $k ?>);"> <img border="0" title="Eliminar" alt="" src="../../../../fastmedical_front/imagen/icono/i_icq_dnd.png"/></a>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div id="div_grupoDatosBotonGuardar<?php echo $k ?>">
                                                                <a href="javascript:guardarModificadoGrupoDatos(<?php echo $k ?>);"> <img border="0" title="Guardar" alt="" src="../../../../fastmedical_front/imagen/icono/grabar.png"/></a>
                                                            </div>
                                                        </td> 
                                                    </tr>
                                                </table>    
                                            </td>           
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table border="1" style="width: 1200px;">

                                                    <tr>
                                                        <td style="width: 800px;">
                                                            <div >
                                                                <table > <!-- ingresar Nuevos Datos -->
                                                                    <thead>
                                                                        <tr bgColor="#C1E69D">
                                                                            <th hidden>codigo Dato Punto Control</th>
                                                                            <th><h6>NOMBRE DEL DATO</h6></th>
                                                                    <th><h6>TIPO DE DATOS</h6></th>
                                                                    <th><h6>TIPO UNIDADES DE MEDIDA</h6></th>
                                                                    <th><h6>UNIDADES DE MEDIDA</h6></th>
                                                                    <th><h6>En Result.</h6></th>
                                                                    <th><h6>Obligatorio</h6></th>
                                                                    <th><h6>Orden</h6></th>
                                                                    <th><h6>EDITAR</h6></th>
                                                                    <th><h6>AGR.</h6></th>
                                                                    <th><h6></h6></th>
                                                                    <th><h6></h6></th>
                                                                    <th><h6></h6></th>
                                                                    <th colspan="4" style="width:600px;float: center; height: auto; "><h6>Rango</h6></th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        <?php
                                                                        if (!empty($value[2])) {
                                                                            foreach ($value[2] as $y => $valuey) {
                                                                                if (($y + 1) % 2 == 0)
                                                                                    $class = "jclmTbPar2";
                                                                                else
                                                                                    $class = "jclmTbImpar";
                                                                                ?>
                                                                                <tr align="center" class="<?php echo $class ?>">
                                                                                    <td hidden>
                                                                                        <input type="hidden" id="hIdDatosPuntoControl<?php echo $k ?><?php echo $y ?>" name="hIdDatosPuntoControl"  value="<?php echo $valuey[0] ?>">   
                                                                                    </td>
                                                                                    <td align="center">
                                                                                        <input type="txt" id="txtNombreDatos<?php echo $k ?><?php echo $y ?>" name="txtNombreDatos"  value="<?php echo $valuey[6] ?>" disabled="true">   
                                                                                        <input type="hidden" id="hNombreDatosAntiguo<?php echo $k ?><?php echo $y ?>" name="hNombreDatosAntiguo"  value="<?php echo $valuey[6] ?>">   
                                                                                    </td>
                                                                                    <td>
                                                                                        <table>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <select name="cboTipoDatos<?php echo $k ?><?php echo $y ?>" id="cboTipoDatos<?php echo $k ?><?php echo $y ?>" disabled="true" 
                                                                                                            onchange="validarTipoDatosCombo(<?php echo $k ?>,<?php echo $y ?>)">
                                                                                                        <option value=""> seleccionar</option>
                                                                                                        <?php foreach ($arrayTiposDatos as $m => $valuem) { ?>      
                                                                                                            <option value="<?php echo $valuem[0] ?>" <?php if ($valuey[2] == $valuem[0]) echo "selected" ?>> <?php echo $valuem[1] ?> </option>
                                                                                                        <?php } ?>
                                                                                                    </select>
                                                                                                    <input type="hidden" id="hTipoDatosAntiguo<?php echo $k ?><?php echo $y ?>" name="hTipoDatos"  value=""> 

                                                                                                </td>
                                                                                                <td>
                                                                                                    <div id="div_EditarCombo<?php echo $k ?><?php echo $y ?>">
                                                                                                        <?php if ($valuey[9] == '') { ?>
                                                                                                            <a href="javascript:editarCombos('.',<?php echo $valuey[0] ?>,<?php echo $k ?>,<?php echo $y ?>);">
                                                                                                                <img border="0" title="Editar" alt="" src="../../../../fastmedical_front/imagen/icono/abrir.png"/></a>
                                                                                                        <?php } else { ?>
                                                                                                            <a href="javascript:editarCombos(<?php echo $valuey[9] ?>,<?php echo $valuey[0] ?>,<?php echo $k ?>,<?php echo $y ?>);">
                                                                                                                <img border="0" title="Editar" alt="" src="../../../../fastmedical_front/imagen/icono/abrir.png"/></a>
                                                                                                        <?php } ?>
                                                                                                        <input type="hidden" id="hidCombo<?php echo $k ?><?php echo $y ?>" name="hidCombo"  value="<?php echo $valuey[9] ?>"> 
                                                                                                    </div> 
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </td>
                                                                                    <td>
                                                                                        <select name="cboTipoUnidadDeMedida<?php echo $k ?><?php echo $y ?>" id="cboTipoUnidadDeMedida<?php echo $k ?><?php echo $y ?>" onchange="cargarComboUnidadMedidaEditar(<?php echo $k ?>,<?php echo $y ?>)" disabled="true">
                                                                                            <option value=""> seleccionar</option>
                                                                                            <?php foreach ($arrayTipoUnidadDeMedida as $n => $valuen) { ?>      
                                                                                                <option value="<?php echo $valuen[0] ?>" <?php if ($valuey[8] == $valuen[0]) echo "selected" ?>> <?php echo $valuen[1] ?> </option>
                                                                                            <?php } ?>
                                                                                        </select>
                                                                                        <input type="hidden" id="hTipoUnidadDeMedida<?php echo $k ?><?php echo $y ?>" name="hTipoUnidadDeMedida"  value="<?php echo $valuen[0] ?>">
                                                                                    </td>
                                                                                    <td>
                                                                                        <div id="div_UnidadDeMedidaEditable<?php echo $k ?><?php echo $y ?>">
                                                                                            <select name="cboUnidadDeMedida<?php echo $k ?><?php echo $y ?>" id="cboUnidadDeMedida<?php echo $k ?><?php echo $y ?>"  disabled="true">
                                                                                                <option value="<?php echo $valuey[3] ?>"> <?php echo $valuey[4] ?> </option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div id="div_UnidadDeMedidaEditableModificar<?php echo $k ?><?php echo $y ?>">
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <input type="checkbox" name="checkMuestraDatosEnExamen<?php echo $k ?><?php echo $y ?>" value="" 
                                                                                        <?php if ($valuey[5] == 1) echo 'checked="checked"' ?>
                                                                                               id="checkMuestraDatosEnExamen<?php echo $k ?><?php echo $y ?>" disabled="true"/>
                                                                                        <input type="hidden" id="hcheckMuestraDatosEnExamen<?php echo $k ?><?php echo $y ?>" name="checkMuestraDatosEnExamen"  
                                                                                               value="<?php echo $valuey[5] ?>">
                                                                                    </td>
                                                                                    <td>
                                                                                        <input type="checkbox" name="checkMuestraDatosEnExamen<?php echo $k ?><?php echo $y ?>" value="" 
                                                                                        <?php if ($valuey[10] == 1) echo 'checked="checked"' ?>
                                                                                               id="checkObligatorio<?php echo $k ?><?php echo $y ?>" disabled="true"/>
                                                                                        <input type="hidden" id="hcheckObligatorio<?php echo $k ?><?php echo $y ?>" name="checkMuestraDatosEnExamen"  
                                                                                               value="<?php echo $valuey[10] ?>">
                                                                                    </td>
                                                                                    <td><!-- orden -->
                                                                                        <?php echo $valuey[7] ?>
                                                                                    </td>      
                                                                                    <td>
                                                                                        <div id="div_editarDatosPuntoControl<?php echo $k ?><?php echo $y ?>">
                                                                                            <a href="javascript:editarDatosPuntoControl(<?php echo $valuey[0] ?>,<?php echo $k ?>,<?php echo $y ?>);"> <img border="0" title="Editar Datos Puntos de Control" alt="" src="../../../../fastmedical_front/imagen/icono/editar.png"/></a>
                                                                                        </div>
                                                                                        <div id="div_GuardarDatosPuntoControl<?php echo $k ?><?php echo $y ?>">
                                                                                            <a href="javascript:modificarDatosPuntoControl(<?php echo $valuey[0] ?>,<?php echo $k ?>,<?php echo $y ?>);"> <img border="0" title="Guardar" alt="" src="../../../../fastmedical_front/imagen/icono/grabar.png"/></a>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td><!-- AGREGAR OTRO RANGO =================== -->
                                                                                        <div id="div_agregarRango<?php echo $k ?><?php echo $y ?>">
                                                                                            <a href="javascript:agregarRango(<?php echo $valuey[0] ?>,<?php echo $k ?>,<?php echo $y ?>);"> <img border="0" title="Agregar Rango" alt="" src="../../../../fastmedical_front/imagen/icono/abrir.png"/></a>
                                                                                        </div>

                                                                                    </td>
                                                                                    <td><!-- ELIMINAR DATOS=================== -->
                                                                                        <div id="div_agregarRango<?php echo $k ?><?php echo $y ?>">
                                                                                            <a href="javascript:EliminarDatosPuntoControl(<?php echo $valuey[0] ?>,<?php echo $k ?>,<?php echo $y ?>,<?php echo $valuey[7] ?>);"> <img border="0" title="Eliminar Punto Control" alt="" src="../../../../fastmedical_front/imagen/icono/i_icq_dnd.png"/></a>
                                                                                        </div>

                                                                                    </td>
                                                                                    <td><!-- SUBIR DATOS=================== -->
                                                                                        <div id="div_agregarRango<?php echo $k ?><?php echo $y ?>">
                                                                                            <?php if ($y != 0) { ?>
                                                                                                <a href="javascript:subirDatosPuntoControl(<?php echo $valuey[0] ?>,<?php echo $k ?>,<?php echo $y ?>,<?php echo $valuey[7] ?>)"> <img border="0" title="Subir de Orden" alt="" src="../../../../fastmedical_front/imagen/icono/arribaFecha.png"/></a>   
                                                                                            <?php } ?>
                                                                                        </div>

                                                                                    </td>
                                                                                    <td><!-- BAJAR DATOS=================== -->
                                                                                        <div id="div_agregarRango<?php echo $k ?><?php echo $y ?>">
                                                                                            <?php if ($value[3] != $y + 1) { ?>
                                                                                                <a href="javascript:bajarDatosPuntoControl(<?php echo $valuey[0] ?>,<?php echo $k ?>,<?php echo $y ?>,<?php echo $valuey[7] ?>);"> <img border="0" title="Bajar de Orden" alt="" src="../../../../fastmedical_front/imagen/icono/agt_upgrade_misc.png"/></a>
                                                                                            <?php } ?>
                                                                                        </div>

                                                                                    </td>
                                                                                    <td align="center" style="width:800px;float: center; height: auto; ">
                                                                                        <div style="width:600px;height:auto; border:#000 2px solid; overflow:scroll" id="div_barrraDesplazanteL">
                                                                                            <div id="div_RangosL" class="toolbar" style="width:auto;float: center; height: auto; " align="center">
                                                                                                <table >
                                                                                                    <tr bgcolor="#C1E69D" align="center">
                                                                                                        <td hidden ><h6>iCodigo</h6></td>
                                                                                                        <td style="width:200px;float: center; height: auto; "><h6>Edad</h6></td>
                                                                                                        <td style="width:30px;float: center; height: auto; "><h6>Sexo</h6></td>
                                                                                                        <td style="width:380px;float: center; height: auto; "><h6>Rango</h6></td>
                                                                                                        <td style="width:280px;float: center; height: auto; "><h6>Significado</h6></td>
                                                                                                        <td style="width:30px;float: center; height: auto; "><h6>Editar</h6></td>
                                                                                                        <td style="width:30px;float: center; height: auto; "><h6>Eliminar</h6></td>
                                                                                                    </tr>
                                                                                                    <?php
                                                                                                    foreach ($valuey[11] as $x => $valuex) {
                                                                                                        if (($x + 1) % 2 == 0)
                                                                                                            $classa = "jclmTbPar2";
                                                                                                        else
                                                                                                            $classa = "jclmTbImpar";
                                                                                                        ?> 
                                                                                                        <tr align="center" class="<?php echo $classa ?>" >
                                                                                                            <td hidden>
                                                                                                                <?php echo $valuex[0] ?> 
                                                                                                                <input type="hidden" id="hidRango<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hidCodigoDatosPuntoControl"  value="<?php echo $valuex[0] ?> ">
                                                                                                            </td>
                                                                                                            <td style="width:200px;float: center; height: auto; ">
                                                                                                                <?php echo $valuex[10] ?>
                                                                                                                <input type="hidden" id="hiedadMinima<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hiedadMinima"  value="<?php echo $valuex[1] ?> ">
                                                                                                                <input type="hidden" id="hiedadMaximo<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hiedadMaximo"  value="<?php echo $valuex[2] ?> ">
                                                                                                                <input type="hidden" id="hEstadoEdad<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hEstadoEdad"  value="<?php echo $valuex[8] ?> ">
                                                                                                                 <input type="hidden" id="hbMaximoEdadInfinito<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hbMaximoEdadInfinito"  value="<?php echo $valuex[13] ?> ">
                                                                                                                <input type="hidden" id="hbRangoInfinitoPositivo<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hbRangoInfinitoPositivo"  value="<?php echo $valuex[14] ?> ">
                                                                                                                <input type="hidden" id="hbRangoInfinitoNegativo<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hbRangoInfinitoNegativo"  value="<?php echo $valuex[15] ?> ">
                                                                                                            </td>
                                                                                                            <td style="width:30px;float: center; height: auto; ">
                                                                                                                <?php echo $valuex[9] ?> 
                                                                                                                <input type="hidden" id="hSexo<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hSexo"  value="<?php echo $valuex[3] ?> ">
                                                                                                                <input type="hidden" id="hEstadoSexo<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hEstadoSexo"  value="<?php echo $valuex[7] ?> ">
                                                                                                                <input type="hidden" id="hSexoTexto<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hSexoTexto"  value="<?php echo $valuex[9] ?> ">
                                                                                                            </td>
                                                                                                            <td style="width:45px;float: center; height: auto; ">
                                                                                                                <?php if ($valuex[12] == 5) { ?>
                                                                                                                    <img src="<?php echo htmlentities($valuex[11]); ?>">   
                                                                                                                    <?php
                                                                                                                } else {
                                                                                                                    echo htmlentities($valuex[11]);
                                                                                                                }
                                                                                                                ?>
                                                                                                                <input type="hidden" id="hiValorMinima<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hiValorMinima"  value="<?php echo $valuex[4] ?> ">
                                                                                                                <input type="hidden" id="hiValorMaximo<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hiValorMaximo"  value="<?php echo $valuex[5] ?> ">
                                                                                                            </td>
                                                                                                            <td style="width:180px; height: auto; " align="justify">
                                                                                                                <?php echo trim(utf8_encode($valuex[6])) ?> 
                                                                                                                <input type="hidden" id="hSignificado<?php echo $k ?><?php echo $y ?><?php echo $x ?>" name="hSignificado"  value="<?php echo utf8_encode($valuex[6]) ?> ">
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                <a href="javascript:editarRango(<?php echo $k ?>,<?php echo $y ?>,<?php echo $x ?>);"> 
                                                                                                                    <img border="0" title="Editar Rango" alt="" src="../../../../fastmedical_front/imagen/icono/editar.png"/></a>
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                <a href="javascript:eliminarRango(<?php echo $k ?>,<?php echo $y ?>,<?php echo $x ?>);">
                                                                                                                    <img border="0" src="../../../../fastmedical_front/imagen/icono/i_icq_dnd.png" alt="" title="Eliminar Rango">
                                                                                                                </a>
                                                                                                            </td>

                                                                                                        </tr>
                                                                                                    <?php } ?> 

                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>    

                                                                                </tr>           
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>

                                                                        <tr align="center" bgcolor="#D7EAFF"><!-- ====================================================================================================================== -->
                                                                            <td hidden="">

                                                                            </td>
                                                                            <td>
                                                                                <input type="txt" id="hfilaexamenGuardar<?php echo $k ?>" name="hfilaexamenGuardar"  value="">   
                                                                            </td>
                                                                            <td>
                                                                                <table>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <select name="cboTipoDatosGuardar<?php echo $k ?>" id="cboTipoDatosGuardar<?php echo $k ?>" >
                                                                                                <option value=""> seleccionar</option>
                                                                                                <?php foreach ($arrayTiposDatos as $m => $valuem) { ?>      
                                                                                                    <option value="<?php echo $valuem[0] ?>"> <?php echo $valuem[1] ?> </option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                        </td>
                                                                                        <td>

                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            <td>
                                                                                <select name="cboTipoUnidadDeMedidaGuardar<?php echo $k ?>" id="cboTipoUnidadDeMedidaGuardar<?php echo $k ?>" onchange="cargarComboUnidadMedidaGuardar(<?php echo $k ?>)">
                                                                                    <option value=""> seleccionar</option>
                                                                                    <?php foreach ($arrayTipoUnidadDeMedida as $z => $valuez) { ?>      
                                                                                        <option value="<?php echo $valuez[0] ?>"> <?php echo $valuez[1] ?> </option>
                                                                                    <?php } ?>
                                                                                </select>

                                                                            </td>
                                                                            <td>
                                                                                <div id="div_UnidaMedida_InicioGuardar<?php echo $k ?>">
                                                                                    <select name="cboUnidadDeMedidaGuardar<?php echo $k ?>" id="cboUnidadDeMedidaGuardar<?php echo $k ?>">
                                                                                        <option value=""> seleccionar</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div id="div_UnidaMedidaGuardar<?php echo $k ?>">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <input type="checkbox" name="checkTipoUnidadDeMedida<?php echo $k ?>" value="ON" 
                                                                                       id="checkTipoUnidadDeMedida<?php echo $k ?>"/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="checkbox" name="checkObligatorio<?php echo $k ?>" value="ON" 
                                                                                       id="checkObligatorio<?php echo $k ?>"/>
                                                                            </td>
                                                                            <td>                                
                                                                                <a href="javascript:guardarDatosPuntoControlGuardar(<?php echo $k ?>,<?php echo $value[0] ?>)"> <img border="0" title="Guardar" alt="" src="../../../../fastmedical_front/imagen/icono/grabar.png"/></a>                     
                                                                            </td>
                                                                            <td colspan="4"> </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:auto;float: center; height: 8px; ">
                                                            <!-- espacio para cada Dato -->
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </table>
                            </div>      
                        </td>
                    </tr>
                </tbody>
            </table> 
        </div>                            
    </div>
</fieldset>

