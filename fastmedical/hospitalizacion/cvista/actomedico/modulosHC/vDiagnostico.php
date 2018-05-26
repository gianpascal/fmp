<input type="hidden" id="existeDiagnostico" value="1" />
<div id="Div_Diagnostico" style="width:100%; float: left">
    <div id="Div_DiagnosticoEncabezado" class="titleform" style="cursor: pointer;" onclick="javascript:abrirDiv('Div_DiagnosticoCuerpo');">
        <table style="height: auto;width: 100%" class="accordion_title">
            <tr align="center">
                <td >
                    <h1>Diagn&oacute;stico</h1>
                </td>
                <td style="width:3%">
                    <img id="Div_DiagnosticoCuerpoicono" src='../../../../fastmedical_front/imagen/icono/plegar.png' title='plegar' alt=""/>
                </td>
            </tr>
        </table>
    </div>
    <div id="Div_DiagnosticoCuerpo" style="width:100%;height: auto;display:block;border-style: solid;border-width: 1px">
        <?php 
        
        //echo getcwd();
        require_once('../../cvista/actomedico/vistaDiagnosticos.php'); 
        ?>
        
    </div>
</div>
<script>
cargaDiagnosticosPreguardados();
</script>