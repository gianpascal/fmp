<input type="hidden" id="existeTratamientos" value="1" />
<div id="Div_Tratamiento" style="width:100%;float: left   "  >
    <div id="Div_TratamientoEncabezado" class="titleform" style="cursor: pointer;" onclick="javascript:abrirDiv('Div_TratamientoCuerpo');">
        <table style="height: auto;width: 100%" class="accordion_title">
            <tr align="center">
                <td>
                    <h1>Tratamiento</h1>
                </td>
                <td style="width:3%">
                    <img id="Div_TratamientoCuerpoicono" src='../../../../medifacil_front/imagen/icono/plegar.png' title='plegar' alt=""/>
                </td>
            </tr>
        </table>
    </div>
    <div id="Div_TratamientoCuerpo" style="width: 95%;height: auto;display:block">
        <?php require_once("../../cvista/actomedico/vistaTratamientos.php"); ?>
    </div>
</div>