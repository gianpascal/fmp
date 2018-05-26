<div id="Div_Triaje" style="width:100%;float: left">
        <div id="Div_TriajeEncabezado" class="titleform" style="cursor: pointer;" onclick="javascript:abrirDiv('Div_TriajeCuerpo');">
            <table style="height: auto;width: 100%" class="accordion_title">
                <tr align="center">
                    <td >
                        <h1>Triaje</h1>
                    </td>
                    <td style="width:3%">
                        <img id="Div_TriajeCuerpoicono" src='../../../../fastmedical_front/imagen/icono/plegar.png' title='plegar' alt=""/>
                    </td>
                </tr>
            </table>
        </div>
        <div id="Div_TriajeCuerpo" style="width:100%;display:block;border-style: solid;border-width: 0px">
            <?php
               // $datos["codigoProgramacion"] = $parametros["p2"];
                    require_once("../../cvista/actomedico/vistaTriaje.php");
            ?>
        </div>
    </div>