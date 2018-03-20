<div id="Div_HistoriaOdontograma" style="width:100%; float: left">
    <div id="Div_HistoriaOdontogramaEncabezado" class="titleform" style="cursor: pointer;" onclick="javascript:abrirDiv('Div_HistoriaOdontogramaCuerpo');">
        <table style="height: auto;width: 100%" class="accordion_title">
            <tr align="center">
                <td>
                    <h1>Historia Odontograma</h1>
                </td>
                <td style="width:3%">
                    <img id="Div_HistoriaOdontogramaCuerpoicono" src='../../../../medifacil_front/imagen/icono/desplegar.png' title='desplegar' alt=""/>
                </td>
            </tr>
        </table>
    </div>
    <div id="Div_HistoriaOdontogramaCuerpo" style="width:100%;display:none;">
        <?php  
       // echo $datosPersona['codpersona'];
        $this->aHistoriaOdontograma($datosPersona['codpersona']);
        ?>
    </div>
</div>