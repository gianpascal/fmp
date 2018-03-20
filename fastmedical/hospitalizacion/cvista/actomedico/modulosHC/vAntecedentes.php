<div id="Div_Antecedentes" style="width:100%;float: left">
    <div id="Div_AntecedentesEncabezado" class="titleform" style="cursor: pointer;" onclick="javascript:abrirDiv('Div_AntecedentesCuerpo');">
        <table style="height: auto;width: 100%" class="accordion_title">
            <tr align="center">
                <td >
                    <h1>Antecedentes</h1>
                </td>
                <td style="width:3%">
                    <img id="Div_AntecedentesCuerpoicono" src='../../../../medifacil_front/imagen/icono/desplegar.png' title='desplegar' alt=""/>
                </td>
            </tr>
        </table>
    </div>
    <div id="Div_AntecedentesCuerpo" style="width:100%;display:none;border-style: solid;border-width: 1px">
        <?php
        $this->antecedentes('', $datos["codigoProgramacion"]);
        
        ?>
    </div>
</div>
