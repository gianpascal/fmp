<div id="Div_ProcedimientoConsulta" style="width:100%;float: left">
    <div id="Div_ProcedimientoConsultaEncabezado" class="titleform" style="cursor: pointer;" onclick="javascript:abrirDiv('Div_ProcedimientoConsultaCuerpo');">
        <table style="height: auto;width: 100%" class="accordion_title">
            <tr align="center">
                <td>
                    <h1>Procedimientos Consultas</h1>
                </td>
                <td style="width:3%">
                    <img id="Div_ProcedimientoConsultaCuerpoicono" src='../../../../fastmedical_front/imagen/icono/desplegar.png' title='desplegar' alt=""/>
                </td>
            </tr>
        </table>
    </div>
    <div id="Div_ProcedimientoConsultaCuerpo" style="width:100%;border-style: solid;border-width: 1px">
        <?php
        $resultadoDatos = $this->arrayDatosConsultaCitaHistoria($datos);
        require_once("tablaAngelSayes.php");
        $tabla = new TablaAngelSayes();
        $oLActoMedico = new LActoMedico();
        $array = $oLActoMedico->lCargarTablaProcedientosConsulta($resultadoDatos);
        $arrayWidth = array(0 => "110", 1 => "100", 2 => "90", 3 => "700");
        $arrayTitulos = array(0 => "Num. Orden ", 1 => "Fecha", 2 => "Afiliacion", 3 => "Servicio");
        $arrayAlign = array(0 => "center", 1 => "center", 2 => "center", 3 => "left ");
        $arrayType = array(0 => "text", 1 => "text", 2 => "text", 3 => "text");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default");
        $arrayFunctionXCelda = array(0 => "", 1 => "", 2 => "", 3 => "");
        $arrayImagenPorCelda = array(0 => "0", 1 => "0", 2 => "0", 3 => "0");
        $arrayUrlImagen = array(0 => "", 1 => "", 2 => "", 3 => "", 4 => "");
        $arrayFunction = array(0 => "", 1 => "", 2 => "", 3 => "", 4 => "");
        $arrayTitle = array(0 => "", 1 => "", 2 => "", 3 => "");
        $numDatosEnviadosFuncionCadena = 1;
        $scroll=1;
        $height = "auto";
        echo  $resultado = $tabla->contructorTabla($scroll,$numDatosEnviadosFuncionCadena, $arrayFunctionXCelda, $arrayTitle, $arrayFunction, $arrayImagenPorCelda, $arrayUrlImagen, $array, $arrayWidth, $arrayTitulos, $arrayAlign, $arrayType, $arrayCursor, $height);
        ?>
    </div>
</div>