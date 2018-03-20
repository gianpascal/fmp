<input type="hidden" id="existeExamenMedico" value="1" />
<div id="Div_ExamenMedico" style="width:100%; float: left">
    <div id="Div_ExamenMedicoEncabezado" class="titleform" style="cursor: pointer;" onclick="javascript:abrirDiv('Div_ExamenMedicoCuerpo');">
        <table style="height: auto;width: 100%" class="accordion_title">
            <tr align="center">
                <td >
                    <h1>Examen M&eacute;dico</h1>
                </td>
                <td style="width:3%">
                    <img id="Div_ExamenMedicoCuerpoicono" src='../../../../medifacil_front/imagen/icono/plegar.png' title='plegar' alt=""/>
                </td>
            </tr>
        </table>
    </div>
    <div id="Div_ExamenMedicoCuerpo" style="width:100%;display:block;border-style: solid;border-width: 1px">
        <?php 
        //print_r($datos);
        echo $this->pintarDivExamenes($datos);
        ////require_once("vistaExamenMedico.php");  ?>
    </div>
</div>