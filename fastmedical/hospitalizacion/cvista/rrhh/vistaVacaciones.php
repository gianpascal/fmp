<?php
$toolbar0 = new ToollBar("center");
$toolbar1 = new ToollBar("center");
?>
<div id="idContenedorVacaciones" style="width: 920px;height: auto" >

        <table align="center" border="1" style="width: 100%;height:277px">
            <tr align="center" valign="middle">
                <th style="background-color: #D3E7FF">REGISTRO DE VACACIONES</th>
            </tr>
            <tr align="center" style="background-color: #D3E7FF">
                <td>
                    <div id="idDivTablaRegistroVacaciones" style ="width:912px;height: 200px" align="center"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="idBtnNuevaVacacion" style="text-align: center;width: 912px;height: 20px;margin-left: 44%" align="center">
                        <?php
                        $toolbar0->SetBoton("btnAsignarArea", "Nueva Vacación", "btn", "onclick,onkeypress", "nuevaVacacion(1)", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/filenew.png", "", "", 1);
                        $toolbar0->Mostrar();
                        ?>
                    </div>
                </td>
            </tr>
        </table>
</div>
