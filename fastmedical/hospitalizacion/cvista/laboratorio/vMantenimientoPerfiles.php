<?php
$toolbar1 = new ToollBar("center");
?>

<div id="divMantenimientoPerfiles" align="center">
    <div class="titleform">
        <h2>MANTENIMIENTO DE PERFILES</h2>
    </div>
    <table border="0" align="center" style="width:1100px;height: 500px;">
        <tr>
            <td align="center" style="height:200%; width:50%">
                <table border="0" align="center" >
                    <tr align="center" >
                        <td>
                            <div  id ="divCabeceraPerfiles" style="border:1px solid  #CECECE;width:100%; height:200%;background-color: #D6E9FE; color: #0000FF">
                                <h1 >PERFILES </h1>
                            </div>
                        </td>
                    </tr>
                    <tr align="center">
                        <td style="display:none">
                            <table style="center"><tr>
                                    <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspPERFIL:</td>
                                    <td><input type="text" name="txtPerfil" id="txtPerfil" value="" size="64" /></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr align="center">
                        <td>
                            <div id="divTablaPerfilesLaboratorio" align="center" style="width:520px; height:330px;"></div>
                        </td>
                    </tr>
                    <tr align="center">
                        <td>
                            <div id="divBotonAgregarPerfilLaboratorio" align="center" style="width:520px; height:30px;"></div>
                        </td>
                    </tr>
                </table>
            </td>
            <td align="center" style="height:200%; width:45%;">
                <table border="0" align="center">
                    <tr align="center" >
                        <td>
                            <div id="divCabeceraExamenesXPerfil"style="border:1px solid  #CECECE;width:100%; height:200%;background-color: #D6E9FE; color: #770088">
                                <h1>EXAMENES POR PERFIL</h1>
                            </div>
                        </td>
                    </tr>
                    <tr align="center" style="display:none">
                        <td>
                            <table style="center"><tr>
                                    <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspEXAMEN:</td>
                                    <td><input type="text" name="txtExamen" id="txtExamen" value="" size="64" /></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr align="center">
                        <td>
                            <div id="divTablaExamenesXPerfil" align="center" style="border:1px solid  #CECECE;width:520px; height:330px;"></div>
                        </td>
                    </tr>
                    <tr align="center">
                        <td>
                            <div id="divBotonAgregarPerfilLaboratorio" align="center" style="width:520px; height:30px;margin-left: 45%">
                                <?php
                                $toolbar1->SetBoton("agregarExamen", "Agregar Examen", "btn", "onclick,onkeypress", "asignacionExamenesAPerfiles()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/kopeteavailable.png", "", "", 1);
                                $toolbar1->Mostrar();
                                ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>

