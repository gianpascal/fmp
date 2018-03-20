<?php
$toolbar01 = new ToollBar("right");
?>


<fieldset style="margin:1px;width:94%;height:auto;padding: 0px; font-size:14px;">
    <legend>&nbsp; Ventana Selector Color &nbsp;</legend>

    <table width="100%" border="0">

        <tr>
            <td align="left">Color</td>
            <td><input type="text" name="IdSede" id="IdSede" value="<?php ?>" class="texto_combo" size="10" readonly/></td>
        </tr>

        <tr>
            <td align="left">Area</td>
            <td><input type="text" name="tcolor" id="tcolor" value="<?php ?>" class="texto_combo" size="10" readonly tabindex="1"/></td>
        </tr>

        <tr>
            <td><input type="hidden" name="NombreCoordinadorOculto" id="NombreCoordinadorOculto" value="<?php ?>" class="texto_combo" size="40"  tabindex="1" readonly/></td>
            <td><input type="hidden" name="hidSedeempresaArea" id="hidSedeempresaArea" value="<?php ?>" class="texto_combo" size="40"  tabindex="1" readonly/></td> </td>
            <td><input type="hidden" name="hiIdEncargadoProgramacionPersonal" id="hiIdEncargadoProgramacionPersonal" value="<?php ?>" class="texto_combo" size="40"  tabindex="1" readonly/></td> </td>
        </tr>
        
        <tr>
            
        <div><input type="text" imagepath="../../../imagen/dhtmlxcolorpicker/imgs/" id="dhtmlxColorPicker1"></div><br>

        <div><input type="text"  imagepath="../../../imagen/dhtmlxcolorpicker/imgs/" colorbox="true" fullview="true" selectedcolor="#00ff00" id="dhtmlxColorPicker2"/></div><br>

        <div><input type="text"  imagepath="../../../imagen/dhtmlxcolorpicker/imgs/" customcolors="true" selectonclick="true" id="dhtmlxColorPicker3"/></div>
        <input type="submit" value="PulsarColor" onclick="initColorPicker('#ffffff')" />

        </tr>
        
<!--        <div id="colorPicker" style="position:absolute;top:150px;left:200px;"></div>-->
        
<!--        <tr>
        <input type="text" id="colorPicker" colorbox="true" customcolors="true" selectonclick="true" fullview="true" selectedcolor="#00ff00">
            
        </tr>-->


    </table>

</fieldset>

<table width="100%" border="0">
    <tr>
        <td>
            <table width="100%" border="0">
                <tr>
                    <!--
                                        <td height="30" width="24%">Nombre Coordinador :</td>
                                        <td width="30%">
                    
                    
                                            <input id="txtNombres" name="txtNombres" value="<?php ?>" size="35" readonly/>
                     
                    
                    
                    
                                        </td>-->



                    <?php
                    echo '
                        
                    <td width="45%" align="right">
                        <div id="idbBuscarCoordinadores" style="width: 100%; ">';


                    $toolbar01->SetBoton("btnAceptarColorTurnoArea", "Confirmar", "btn", "onclick,onkeypress", "xxx()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/agt_action_success.png", "", "", 1);
                    $toolbar01->Mostrar();

                    echo '
                        </div>


                    </td>';
                    ?>

                    <?php
//                    if ($accion == "NuevoCoordinador") {
//
//                        echo '
//                        
//                    <td width="45%" align="right">
//                        <div id="idbBuscarCoordinadores" style="width: 100%;">';
//
//
//                        $toolbar01->SetBoton("btnListaCoordinadores", "Buscar", "btn", "onclick,onkeypress", "buscarCoordinadoresAsignar()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/agt_action_success.png", "", "", 1);
//                        $toolbar01->Mostrar();
//
//                        echo '
//                        </div>
//
//
//                    </td>';
//                    }
                    ?>




                </tr>

                <tr>
                    <td>Estado : </td>

                    <td>
                        <input type="checkbox" name="chkEstado" id="chkEstado" onclick="if(this.checked){this.value=1}else{this.value=0;}" value="1" CHECKED/>

                    </td>

                </tr>



            </table>



        </td>

    </tr>


    <tr>
        <td>
            <input id="hidIdPersona" name="hidIdPersona" type="hidden" value="">

        </td>


    </tr>


    <!--    <?php
//    if ($accion == "EditarCoordinador") {
//
//        echo '
//    <tr>
//
//
//        <td colspan="2" align="left" height="30" id="desactivardiv" >
//            <div style="width: 150px;">';
//
//
//
//        $toolbar02->SetBoton("desactivarCoordinadorAlArea", "Desactivar", "btn", "onclick,onkeypress", "desactivarCoordinadorAlArea()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/agt_action_success.png", "", "", 1);
////        $toolbar02->Mostrar();
//
//
//
//        echo '
//            </div>
//        </td>
//
//
//
//
//    </tr>';
//    }
                    ?>  -->






</table>
</fieldset>

<br/>





<p>&nbsp;</p>

<div id="peche" style="height: 350px; width: 350px; background: #6565fe; " >
    peche
</div>





