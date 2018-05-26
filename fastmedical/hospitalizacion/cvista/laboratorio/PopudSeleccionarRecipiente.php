<?php
$toolbar01 = new ToollBar("right");
$toolbar02 = new ToollBar("right");
?>
<input id="hCodTurno" type="hidden" />
<input id="hIdTurnoAreaSede" type="hidden">
<input id="hIdfilaSeleccionada" type="hidden">









<div id="cabecera" align="center" style="width: 100%;height: 30%; color: #000000;">

    <table border="0" align="center" style="width: 100%;height: 100%">
        <tr>
            <td align="center" style="height:100%; width:47%">



                <table border="1" align="center">
                    <tr align="center">
                        <td>

                            <div  id ="divCabeceraArea" style="width:100%; height:100%;background-color: #D6E9FE; color: #0000FF">
                                <h1 >IMAGEN 1</h1>
                            </div>

                        </td>


                    </tr>
                    <tr align="center">
                        <td>
                            <div id="Div_TablaListaTurnosDisponibles" align="center" style="width:300px; height:240px;"></div>
                        </td>
                    </tr>
                </table>


            </td>

            <td align="center" style="height:100%; width:6%">
            </td>


            <td align="center" style="height:100%; width:47%">

                <table border="1" align="center">
                    <tr align="center">
                        <td>

                            <div  id ="divCabeceraArea" style="width:100%; height:100%;background-color: #D6E9FE; color: #0000FF">
                                <h1 >IMAGEN 2 </h1>
                            </div>

                        </td>


                    </tr>
                    <tr align="center">
                        <td>
                            <!--                            <div id="Div_TurnosSeleccionadosxArea" align="center" style="width:300px; height:180px;"></div>-->
                            <div id="Div_TurnosSeleccionadosxArea" align="center" style="width:300px; height:240px;"></div>
                        </td>
                    </tr>
                </table>



            </td>
        </tr>    
    </table>


    <table>
        <tr>

            <td width="200" align="right">
                <div id="idbBuscarCoordinadores" style="">;

                    <?php
                    $toolbar01->SetBoton("NuevoTipoMuestra", "Nuevo Recipiente", "btn", "onclick,onkeypress", "NuevoTipoMuestra()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/agt_action_success.png", "", "", 1);
                    $toolbar01->Mostrar();
                    ?>

                </div>


            </td>

        </tr>

    </table>

</div>
