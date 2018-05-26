<style type="text/css" >

    /*    #Div_MaterialesDeLaboratorio,#Div_MaterialesDeLaboratorio7,#encabe{
            border-radius:50px 50px 50px 50px;
            border-radius:50px 10px / 10px 50px;
            border:2px solid green;
            border:2px solid #2C5AD6;
                    background:#eee;
                    background:green;
            width:100%;
            padding:5px;
        }  
    
        fieldset{
            border-radius:50px 50px 50px 50px;
            border-radius:50px 10px / 10px 50px;
            border:1px solid #333;
            border:2px solid #2C5AD6;
            background:#eee;
            width:100%;
            padding:5px;
        }*/
    .MatLabo{
        font-size: 12px;
        font-weight:bold




    }

    /*    fieldset{
    
            border: 1px solid green;
            font-size: 2em
    
        }     */
    /*    legend{
            padding: 0.2em 0.5em;
                border: 1px solid green;
            color:green;
            font-size: 90%;
            text-align: right
    
        }*/

    /*   tm {
    
            border: 1px solid green;
            font-size: 2em;
                
            color:green
    
        }  */

</style>

<!--agregado-->


<center>
    <!--    <div id="encabe" style="width:90%;height:4%;background-color: #DAD7F4">
    -->            <div class="titleform">
        <h1>MATERIALES &nbsp;&nbsp;&nbsp;DE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LABORATORIO</h1>
    </div><!--
</div>-->
    <!--1215-->
    <div id="parentId1_MateLab" style="position: relative; top: 5px; left: 5px; width: 1100px; height:740px;">
    </div>

<!--    <div id="parentId2_MateLab"  style="position: relative; top: 5px; left: 5px; width:550px; height:740px;display:none;">
    </div>-->

</center>


<?php
$toolbar1 = new ToollBar("center");
$toolbar2 = new ToollBar("center");
$toolbar3 = new ToollBar("center");
$toolbar4 = new ToollBar("center");
$toolbar5 = new ToollBar("center");
$toolbar6 = new ToollBar("center");
?>


<input type="hidden" id="hIdExamenLaboratorio" name="hIdExamenLaboratorio" value=""/>
<input type="hidden" id="hIdMaterialLaboratorio" name="hIdMaterialLaboratorio" value=""/>
<input type="hidden" id="hAccionNuevo_Editar" name="hAccionNuevo_Editar" value=""/>
<input type="hidden" id="hRutaCompletaNuevoArchivoSubido" name="hRutaCompletaNuevoArchivoSubido" value=""/>

<div id="contenedor_Materiales_De_Laboratorio" align="center" style="width:500px; height:600px;">

    <div id="Div_MaterialesDeLaboratorio" align="center" style="width:500px; height:600px;">

    </div>

</div>

<div id="contenedor_Detalle_del_Material" align="center" style="width:500px; height:515px;">
    <div id="Detalle_del_Material" align="center" style="width:500px; height:515px;">

        <fieldset align="center" style="margin:0px;width:95%;padding: 0px;">
            <legend>Detalle del Material</legend>
            <form id="DetalleMaterialLaboratorio" action="" style="">
                <table class="" cellpadding="2" cellspacing="2" border="0"  >
                    <tr class="" style="width:130px">
                        <td align="left" width="80" class="MatLabo"><b>Id : </b></td>
                        <td><input type="text" name="txtIdNuevoMaterialLabo" id="txtIdNuevoMaterialLabo" value="" class="" size="20" readonly/></td>
                    </tr>

                    <tr>
                        <td align="left" width="100" class="MatLabo">Cod Ser Pro : </td>
                        <td><input type="text" name="txtCodigoNuevoMaterialLabo" id="txtCodigoNuevoMaterialLabo" value="" class="texto_combo" size="20" readonly/></td>
                    </tr>
                    <tr>
                        <td align="left" width="100" class="MatLabo">Nombre : </td>
                        <td><input type="text" name="txtNombreMaterialLabo" id="txtNombreMaterialLabo" value="" class="texto_interior" size="55" readonly/></td>
                    </tr>


                    <tr>
                        <td align="left" width="100" class="MatLabo">Tipo Material :</td>
                        <td>

                            <select name="cboTipoMaterialLabo" id="cboTipoMaterialLabo" disabled="false">
                                <option value="">Seleccionar</option>
                                <?php foreach ($opcionesHTMLTipoMaterialesLaboratorio as $i => $value) { ?>
                                    <option value="<?php echo $value[0] ?>"> <?php echo utf8_encode($value[1]) ?> </option>
                                <?php } ?>
                            </select>


                        </td>
                    </tr>
                    <tr>
                        <td align="left" width="100" class="MatLabo">Descripcion :</td>
                        <td>

                            <div style="height: 40%; width:75%; float: left;">
                                <textarea name="txtDescripcionExaLabo" rows="1" cols="20" id="txtDescripcionExaLabo" style=" width:290px; font-family: sans-serif" readonly onfocus="" onblur="" onkeypress=""></textarea>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">

                            <div id="div_AdjuntarFotoMaterialLaboratorio" align="center" style="display:none">


                                <fieldset style="margin:0px; padding:0px;height: 150px;width:150px">
                                    <legend>Foto</legend>
                                    <div id="Div_fotoMaterialLaboratorio" style=" height:90%;width:90%;background:#F9FAFC" align="center">
                                        Foto
                                    </div>
                                </fieldset>

                                <div id="Div_BotonAdjuntarFotoMaterialLabo" align="center" style="display:none">

                                    <div align="center" style="width: 120px;margin-left:7%;">
                                        <?php
                                        $toolbar5->SetBoton("AdjuntoFotoMaterialLaboratorio", "Adjuntar Foto", "btn", "onclick,onkeypress", "adjuntarOtroFilejc()", "../../../../fastmedical_front/imagen/icono/adjunto.gif", "", "", 1);
                                        $toolbar5->Mostrar();
                                        ?>
                                    </div>
                                    <input type="hidden" name="txtFotografia" id="txtFotografia" style="width:100px;" value="<?php echo $dni_fondo; ?>"/>
                                </div>

                                <div  id ="divAdjuntarOtrojc" style="width:99%; float:left; height:30px;margin-left:1%;margin-right:1%; ">
                                </div>


                            </div>
                        </td>
                    </tr>


                    <tr style="height:20px">

                    </tr>


                    <tr  align="center" > 

                        <td colspan="2">


                            <div id="div_NuevoMaterialLaboratorio" align="center"  style="width:40%; float: left;margin-left: 20%;">
                                <?php
                                $toolbar1->SetBoton("NuevoMaterialLaboratorio", "Nuevo Material", "btn", "onclick,onkeypress", "agregarNuevoMaterialLaboratorio()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/reload3.png", "", "", 1);
                                $toolbar1->Mostrar();
                                ?>
                            </div>

                            <div id="div_GuardarDetalleMaterialLaboratorio"   align="center"  style="width:40%; float: left;margin-left: 0%; display:none">
                                <?php
                                $toolbar4->SetBoton("GuardarCambiosDetalleMaterialesdeLaboratorio", "Guardar Cambios", "btn", "onclick,onkeypress", "GuardarCambiosDetalleMaterialesdeLaboratorio()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/reload3.png", "", "", 1);
                                $toolbar4->Mostrar();
                                ?>
                            </div>

                            <div id="div_EditarDetalleMaterialLaboratorio"   style="width:40%; float: right;margin-left: 0%;">
                                <?php
                                $toolbar2->SetBoton("EditarDetalleMaterialLaboratorio", "Editar Detalle", "btn", "onclick,onkeypress", "EditarDetalleMaterialLaboratorio()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/reload3.png", "", "", 1);
                                $toolbar2->Mostrar();
                                ?>
                            </div>



                        </td>

                    </tr>

                    <tr>
                        <td colspan="2">
                            <div id='div_Mensaje_MaterialesLabo' align="center"  style="float:right; width:100%; margin-left: 10%; "></div>
                        </td>

                    </tr>


                </table>
            </form>
        </fieldset>


    </div>
</div>

<div id="contenedor_Unidades_de_Medida" align="center" style="width:545px; height:220px;">

    <div id="Unidades_de_Medida" align="center" style="width:545px; height:220px;">
        <fieldset style="margin:0px;width:90%;padding: 0px; font-size:10em;">

            <legend>Unidades de Medida</legend>

            <table width="460" height="200" border="0">
                <tr align="center">
                    <td>&nbsp;

                        <div id="Div_TablaUnidadesxTipoxMaterialLaboratorio" style="overflow:auto;background-color: #E6FFEC ;border-style: groove;font-weight: bold; height: 150px;width:490px ;color: #E6FFEC">></div>


                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="div_ActualizarDetalleExamenLabo"  style="margin-left: 40%;">
                            <?php
                            $toolbar3->SetBoton("AgregarUnidadMedidaxMaterialLaboratorio", "Agregar Unidad Medida", "btn", "onclick,onkeypress", "AgregarUnidadMedidaxMaterialLaboratorio()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/reload3.png", "", "", 1);
                            $toolbar3->Mostrar();
                            ?>
                        </div>



                    </td>



                </tr>




            </table>

        </fieldset>
    </div>
</div>

<iframe name="iframe1" src="" style="display: none;" > </iframe>
