<?php
$toolbar1 = new ToollBar("center");
$toolbar2 = new ToollBar("center");
$toolbar3 = new ToollBar("center");
$toolbar4 = new ToollBar("center");
$toolbar5 = new ToollBar("center");
$toolbar6 = new ToollBar("center");
$toolbar7 = new ToollBar("center");
?>

<!--todo este php se trae desde el control-->
<style type="text/css" >

    #Div_1,#Div_2,#fieldset_foto{
        border-radius:50px 50px 50px 50px;
        /*border-radius:50px 10px / 10px 50px;*/
        border:2px solid green;
        /*border:2px solid #2C5AD6;*/
        /*        background:#eee;*/
        /*        background:green;*/
        width:100%;
        padding:5px;
    }  

    #fieldset_fotoMaterial_MDxE{
        /*border-radius:50px 50px 50px 50px;*/
        border-radius:50px 10px / 10px 50px;
        /*        border:1px solid #333;*/
        border:  1px solid green;
        /*border:2px solid #2C5AD6;*/
        background:#eee;
        width:100%;
        padding:5px;
    }

    /*
        fieldset{
                    border-radius:50px 50px 50px 50px;
            border-radius:10px 10px 10px 10px;
                    border-radius:50px 10px / 10px 50px;
                    border:1px solid #333;
                    border:2px solid #2C5AD6;
            border:2px solid #35844E;
    
            background:#DBEBFF;
            width:100%;
            padding:5px;
        }*/

    /*    fieldset{
    
            border: 1px solid green;
            font-size: 2em
    
        }    */
    /*    legend{
            padding: 0.2em 0.5em;
            border: 1px solid green;
            color:green;
            font-size: 90%;
            text-align: right
    
        }*/

    tm {

        border: 1px solid green;
        font-size: 2em;

        color:green

    } 

</style>

<input type="hidden" id="hIdMaterialLaboratorio" name="hIdMaterialLaboratorio"  value="">
<input type="hidden" id="hCodSerPro" name="hCodSerPro"  value="">
<input type="hidden" id="hNombreMaterialLaboEscogido" name="hNombreMaterialLaboEscogido"  value="">

<input type="hidden" id="hidMuestraLaboratorio" name="hidMuestraLaboratorio"  value="">
<input type="hidden" id="hNombreMuestraxAgregar" name="hNombreMuestraxAgregar"  value="">
<div id="cabecera" align="center" style="width: 100%;height: 100%; color: #000000;">
    <div style="width:100%;height:5%;background: white">
        <div class="titleform">
            <h1>AGREGAR MUESTRAS Y/O MATERIALES AL PUNTO DE CONTROL</h1>
        </div>
    </div>

    <div id="div_DetalleMaterialesxPuntoControlLaboratorio" style="margin-left: 0%" >
        <div style="padding:15px; float:left;width: 550px;">


            <fieldset style="width: 950px">
                <legend>Agregar Material:</legend>
                <div style="padding:15px;">
                    <div class="filaMaterialDetalle" >
                        <div class="labelMaterialDetalle">
                            <b>Nombre Material: </b>
                        </div>
                        <div class="inputMaterialDetalle">
                            <input name="txtNombreMaterialSeleccionado" type="text" id="txtNombreMaterialSeleccionado" size="60"  readonly="readonly" />

                        </div>

                        <div class="inputMaterialDetalle2" style="">

                            <div id="div_BotonBuscarMateriales_MDxE" style="margin-left: 40%">
                                <?php
                                $toolbar1->SetBoton("BuscarMaterialesxPuntoControl_2", "Buscar .. ", "btn", "onclick,onkeypress", "PopudbuscarMaterialesxPuntoControl_2()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/abrir.png", "", "", 1);
                                $toolbar1->Mostrar();
                                ?>
                            </div> 


                        </div>

                    </div>

                    <div class="filaMaterialDetalle" >
                        <div class="labelMaterialDetalle">
                            <b>Tipo de Unidad</b>
                        </div>

                        <div class="inputMaterialDetalle">


                            <div id="Div_ComboTipoUnidadMedidaMaterialSeleccionado">
                                <select name="cboTipoUnidadMedidaDisponibles" id="cboTipoUnidadMedidaDisponibles" style="width:150px; font-size:12px" >
                                    <option value="x" selected style="background-color: #CED2E5">Seleccionar..</option>;
                                </select>

                            </div>

                        </div>
                    </div>

                    <div class="filaMaterialDetalle" >
                        <div class="labelMaterialDetalle">
                            <b>Unidad de Medida::</b>
                        </div>
                        <div class="inputMaterialDetalle">

                            <div id="Div_ComboUnidadMedidaMaterialSeleccionado">
                                <select name="cboUnidadMedidaDisponibles" id="cboUnidadMedidaDisponibles" style="width:150px; font-size:12px">
                                    <option value="x" selected style="background-color: #CED2E5">Seleccionar</option>'; 

                                </select>
                            </div> 
                        </div>
                    </div>

                    <div class="filaMaterialDetalle" >
                        <div class="labelMaterialDetalle">
                            <b>Cantidad Máxima:</b>
                        </div>
                        <div class="inputMaterialDetalle">

                            <input name="txtCantidadMaximaMaterialLabo" type="text" id="txtCantidadMaximaMaterialLabo" 
                                   size="20" onkeypress="return   validarTipoDatos(4,this,event,'txtCantidadMinimaMaterialLabo')"/>          

                        </div>
                    </div>
                    <div class="filaMaterialDetalle" >
                        <div class="labelMaterialDetalle">
                            <b>Cantidad Minima::</b>
                        </div>
                        <div class="inputMaterialDetalle">
                            <input name="txtCantidadMinimaMaterialLabo" type="text" id="txtCantidadMinimaMaterialLabo" 
                                   onkeypress="return   validarTipoDatos(4,this,event,'')" size="20"  />       

                        </div>
                    </div>

                    <div class="filaMaterialDetalle" >
                        <div class="labelMaterialDetalle">

                            <div id="div_BotonGuardar_Material_MDxE">
                                <?php
                                $toolbar2->SetBoton("GuardarMaterialPuntoControl", "Guardar", "btn", "onclick,onkeypress", "GuardarMaterialxPuntoControlxExamenLaboratorio()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/abrir.png", "", "", 1);
                                $toolbar2->Mostrar();
                                ?>
                            </div> 


                        </div>

                        <div class="inputMaterialDetalle2">
                            <div id="div_BotonAgregar_Material_MDxE">
                                <?php
                                $toolbar3->SetBoton("AgregarotroMaterialalPuntoControl", "Agregar Material", "btn", "onclick,onkeypress", "AgregarotroMaterialLaboratorio()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/abrir.png", "", "", 1);
                                $toolbar3->Mostrar();
                                ?>
                            </div> 

                        </div>
                        <div class="inputMaterialDetalle2">
                            <div id="div_BotonMostrarMaterialesSeleccionadosXpuntoControlExamenLabo">
                                <?php
                                $toolbar7->SetBoton("MostrarMaterialesSeleccionadosXpuntoControlExamenLabo", "Mostrar Historial", "btn", "onclick,onkeypress", "MostrarMaterialesSeleccionadosXpuntoControlExamenLabo()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/abrir.png", "", "", 1);
                                $toolbar7->Mostrar();
                                ?>

                            </div>
                        </div>

                        </fieldset>
                    </div>

                    <div style="padding:15px; float:left;width: 200px;margin-left: 19%; margin-top: 20">  
                        <div class="inputMaterialDetalle3">
                            <fieldset id="fieldset_fotoMaterial_MDxE" style="margin:0px; padding:0px;width:150 ; height: 190px">
                                <legend>Foto</legend>
                                <center>
                                    <div id="fotoMaterial_MDxE" style=" height:150px;width:120px;">

                                    </div>

                                </center>
                            </fieldset>

                        </div>
                    </div>

                </div>

        </div>


        <!--        <div id="div_DetalleMuestrasxPuntoControlLaboratorio" style="display: none; width: 820px;overflow: auto; margin-left: 10%" >-->

        <div id="div_DetalleMuestrasxPuntoControlLaboratorio" style="display: visible; width: 820px;overflow: auto; margin-left: 10%" >       

            <div style="padding:15px; float:left;width: 550px;"> 
                <!--<div style="padding:15px;">-->
                <fieldset  style="width: 800px">
                    <legend>Agregar Muestra</legend>
                    <div style="padding:15px;">
                        <div class="filaMuestraDetalle" >
                            <div class="labelMuestraDetalle">
                                <b>Nombre Muestra: </b>
                            </div>
                            <div class="inputMuestraDetalle">
                                <input type="text" id="txtNombreMuestraSeleccionada" size="20"  readonly="readonly" /> </td>

                            </div>

                            <div class="inputMuestraDetalle2">
                                <div id="divBotonBuscarMuestra_MDxE">
                                    <?php
                                    $toolbar4->SetBoton("BuscarMaterialesxPuntoControl_3", "Buscar Muestras ...", "btn", "onclick,onkeypress", "PopudbuscarMaterialesxPuntoControl_3()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/abrir.png", "", "", 1);
                                    $toolbar4->Mostrar();
                                    ?>
                                </div> 
                            </div>


                        </div>

                        <div class="filaMuestraDetalle" >
                            <div class="labelMuestraDetalle">
                                <b>Tipo de Unidad</b>
                            </div>
                            <div class="inputMuestraDetalle">
                                <div id="Div_ComboTipoUnidadMedidaMuestraSeleccionada">
                                    <select name="cboTipoUnidadMedidaMuestraSeleccionada" id="cboTipoUnidadMedidaMuestraSeleccionada" style="width:150px; font-size:12px" >
                                        <option value="x" selected style="background-color: #CED2E5">Seleccionar</option>'; 

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="filaMuestraDetalle" >
                            <div class="labelMuestraDetalle">
                                <b>Unidad de Medida::</b>
                            </div>
                            <div class="inputMuestraDetalle">
                                <div id="Div_ComboUnidadMedidaMuestraSeleccionada">
                                    <select name="cboUnidadMedidaMuestraSeleccionada" id="cboUnidadMedidaMuestraSeleccionada" style="width:150px; font-size:12px" >
                                        <option value="x" selected style="background-color: #CED2E5">Seleccionar</option>'; 

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="filaMuestraDetalle" >
                            <div class="labelMuestraDetalle">
                                <b>Cantidad Máxima:</b>
                            </div>
                            <div class="inputMuestraDetalle">
                                <input name="txtCantidadMaximaMuestraSeleccionada" type="text" id="txtCantidadMaximaMuestraSeleccionada" 
                                       onkeypress="return   validarTipoDatos(4,this,event,'txtCantidadMinimaMuestraSeleccionada')" size="20"  />        
                            </div>
                        </div>
                        <div class="filaMuestraDetalle" >
                            <div class="labelMuestraDetalle">
                                <b>Cantidad Minima::</b>
                            </div>
                            <div class="inputMuestraDetalle">
                                <input name="txtCantidadMinimaMuestraSeleccionada" type="text" id="txtCantidadMinimaMuestraSeleccionada"
                                       onkeypress="return   validarTipoDatos(4,this,event,'')" size="20"  />   
                            </div>
                        </div>

                        <div class="filaMuestraDetalle" >
                            <div class="labelMuestraDetalle">
                                <div id="div_BotonGuardar_Muestra_MDxE" style="margin-left: 10%;" >
                                    <?php
                                    $toolbar5->SetBoton("GuardarMuestraPuntoControl", "Guardar Muestra", "btn", "onclick,onkeypress", "GuardarMuestraxPuntoControlxExamenLaboratorio()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/abrir.png", "", "", 1);
                                    $toolbar5->Mostrar();
                                    ?>
                                </div> 
                            </div>
                            <div class="inputMuestraDetalle">
                                <div id="div_BotonAgregar_Muestra_MDxE"  style="margin-left: 27%;">
                                    <?php
                                    $toolbar6->SetBoton("AgregarotroMuestraalPuntoControl", "Agregar Muestra", "btn", "onclick,onkeypress", "AgregarotroMuestraMaterialdeLaboratorio()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/abrir.png", "", "", 1);
                                    $toolbar6->Mostrar();
                                    ?>
                                </div>

                            </div>
                        </div>

                    </div>
                </fieldset>

            </div>

        </div>

        <!--        <div id="parentId" style="width: 1000px; height: 500px; background-color:#487595;">
        
                </div>-->

        <div id="diva" style="position: relative; width: 100%; height: 100%; display: none ">
            <div style="padding:15px;">


                <b> Observaciones Materiales </b>

            </div> 

        </div>
        <div id="divb" style="position: relative; width: 100%; height: 100%; display: none ">
            <div style="padding:15px;">


                <b> Observaciones Materiales </b>

            </div> 

        </div>
        <div id="divc" style="position: relative; width: 100%; height: 100%; display: none ">
            <div style="padding:15px;">


                <b> Observaciones Materiales </b>

            </div> 

        </div>



        </body>
        </html>

