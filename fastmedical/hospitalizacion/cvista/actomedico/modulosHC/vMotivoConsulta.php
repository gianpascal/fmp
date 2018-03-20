<div id="Div_ConsultaMedica" style="width:100%;float: left">
    <div id="Div_ConsultaMedicaEncabezado" class="titleform" style="cursor: pointer;" onclick="javascript:abrirDiv('Div_ConsultaMedicaCuerpo');">
        <table style="height: auto;width: 100%" class="accordion_title">
            <tr align="center">
                <td>
                    <h1>Motivo de la Consulta</h1>
                </td>
                <td style="width:3%">
                    <img id="Div_ConsultaMedicaCuerpoicono" src='../../../../medifacil_front/imagen/icono/desplegar.png' title='desplegar' alt=""/>
                </td>
            </tr>
        </table>
    </div>
    <div id="Div_ConsultaMedicaCuerpo" style="width:100%;display:none;border-style: solid;border-width: 1px">
        <?php
            $datos["p2"] = $datos["codigoProgramacion"];
            //echo 'peche';
            $this->cargarMotivoDeConsulta($datos);
        ?>
    </div>
</div>