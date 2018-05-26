<?php
$toolbar1 = new ToollBar("right");
$toolbar2 = new ToollBar("right");
$toolbar3 = new ToollBar("right");
$toolbar4 = new ToollBar("right");
?>
<div>
    <fieldset id="fsAfiliaciones" style="padding:5px; height: 180px; width: 690px;">
        <legend>Afiliaciones</legend>
        <div style="padding:5px; height: 180px;">
            <div id="tablaAfiliacionesPersona" style="background-color:#A8DCC6; height: 145px; overflow: auto">
            </div>
            <br><br>
            <div>
                <div id="divmensaje" style="color:red; font-size: 20px; text-align:center">  
                </div>
                <div>
                    <div id="button1" style="float:left;padding-left: 250px;">
                        <?php
                        $toolbar2->SetBoton("Essalud", "Acreditar", "btn", "onclick,onkeypress", "popadDatosEssalud('$datos[codigoPersona]')", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/monedas.jpg", "", "", 1);
                        $toolbar2->Mostrar();
                        ?> 
                    </div>
                    <div id="button2" style="float:left; width: 50px; border: 1px  solid white;"></div>
                    <div id="button3" style="float:left;">
                        <?php
                        if (isset($_SESSION["permiso_formulario_servicio"][110]["AGREGAR_AFIL_PAC"]) && ($_SESSION["permiso_formulario_servicio"][110]["AGREGAR_AFIL_PAC"] == 1)) {
                            $verBotonAgregarAfiliaciones = 1;
                        } else {
                            $verBotonAgregarAfiliaciones = 0;
                        }
                        $toolbar1->SetBoton("Agregar", "Agregar", "btn", "onclick,onkeypress", "PopadAgregarAfiliaciones('$datos[codigoPersona]')", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/window_new.png", "", "", $verBotonAgregarAfiliaciones);
                        $toolbar1->Mostrar();
                        ?> 
                    </div>
                    <div id="button4" style="float:left; width: 50px; border: 1px  solid white;"></div>
                    <div id="button5" style="float:left;">
                        <?php
                        $toolbar3->SetBoton("Link", "", "btn", "onclick,onkeypress", "abrirEssalud", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/images.jpg", "", "", 1);
                        $toolbar3->Mostrar();
                        ?> 
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <br><br><br><br><br>
    <fieldset id="fsDetalle" style="padding:5px; height: 700px; width: 670px;">
        <legend>Detalle</legend>
        <div id="Detalle" style="padding:5px; height: 700px; width: 670px;">
            <div style="width:100%;height:5%;background: white">
                <div class="titleform">
                    <h1>Lista Persona Essalud</h1>
                </div>
            </div>
            <div style="width: 650px;">  
                <div id="spListaPersonaEssalud" style="padding:5px; height: 50px;">
                </div>
            </div>
            <br>
            <div style="width:100%;height:5%;background: white">
                <div class="titleform">
                    <h1>Lista Datos Essalud</h1>
                </div>
            </div>
            <div style="width: 650px;">  
                <div id="spListaDatosEssalud" style="padding:5px; height: 50px;">
                </div>
            </div>
            <br>
            <div style="width:100%;height:5%;background: white">
                <div class="titleform">
                    <h1>Lista Carta Essalud</h1>
                </div>
            </div>
            <div style="width: 620px;">  
                <div id="spListaCabeceraCartaEssalud" style="padding:5px; height: 70px;">
                </div>
            </div>
            <br>
            <div style="width:100%;height:5%;background: white">
                <div class="titleform">
                    <h1>Detalle Carta Essalud</h1>
                </div>
            </div>
            <div style="width: 630px;">  
                <div id="spListaDetalleCartaEssaludPorCabeceraCarta" style="padding:5px; height: 120px;">
                </div>
            </div>
        </div>
        <div  id="DetalleDeuda" style="padding:5px; height: 150px; width: 670px;">
            <div style="width:100%;height:5%;background: white">
                <div class="titleform">
                    <h1>Estado de Deuda</h1>
                </div>
            </div>
            <br><br>
            <div style="width:530px;">  
                <div id="TablaEstadoDeuda" style="height: 50px;width:500px;">
                </div>
                <?php
                
                $toolbar4->SetBoton("Quitar Relacion Municipalidad", "Quitar Relacion Municipalidad", "btn", "onclick,onkeypress", "QuitarRelacion()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/window_new.png", "", "");
                        $toolbar4->Mostrar();
                ?>
            </div>
            <div id="MensajeDeuda" style="color:red; font-size: 20px; text-align:center">
            </div>
            <input type="hidden" id="accion">
            <input type="hidden" id="autogenerado">
        </div>
    </fieldset>
</div>


