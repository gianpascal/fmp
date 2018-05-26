<?php
$toolbar1 = new ToollBar("center");
?>
<div id="divPoppadListaExamenesLaboratorio" align="center">
    <table border="0" align="center" style="width: 800px;height: 300px" >
        <tr align="center" >
            <td>
                <div id="divCabeceraExamenesLaboratorio"style="border:1px solid  #CECECE;width:1;width:100%; height:100%;background-color: #D6E9FE; color: #770088">
                    <h1>EXAMENES</h1>
                </div>
            </td>
        </tr>
        <tr align="center">
            <td>
                <table>
                    <tr>
                        <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspEXAMEN:</td>
                        <td><input type="text" name="txtExamen" id="txtExamen" value="" size="64"  onkeyup="buscarExamenLaboratorio()" style='border:1px solid #CECECE; border-radius:5px;height:20px;width:90%;font-size:8pt;font-family:Tahoma; '/></td>
                        <td>
                            <div id="divBotonAsignarExamenAPerfil" align="center" style="width:9px; height:10px;margin-left: 45%">
                                <?php
                                $toolbar1->SetBoton("asignarExamenAPerfil", "Asignar Exámen", "btn", "onclick,onkeypress", "asignarExamenAPerfil()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/kopeteavailable.png", "", "", 1);
                                $toolbar1->Mostrar();
                                ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr align="center">
            <td style="alignment-adjust: central">
                <div id="divTablaExamenesLaboratorio" align="center" style="width:780px; height:330px;"></div>
            </td>
        </tr>
    </table>
</div>