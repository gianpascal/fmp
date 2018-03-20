<style>
    .cuerpoPrincipal{
        width: 1000px;
        max-width: 97%;
        float:right;
        height: 500px;
        border:0px solid
    }
    .cabeceraCuerpo{
        width: 1000px;
        max-width:99%;
        float:right;
        height: 5%;
        border:0px solid;
    }

    .contenedorTabla{
        overflow-y:scroll;
        background:white;
    }


    .tdCabecera{
        color:white;
        font-size: 12px;
        height: 35px;
        text-align: center;
        border-top:0px solid #0C2D59;
        border-right:1px solid #0C2D59;
        border-bottom:1px solid #0C2D59;
        border-left:0px solid #0C2D59;
    }

    .tdCabeceraBusqueda{
        border-top:1px solid #144B95;
        height: 30px; 
        background-color: #D5DDE8;

    }
    .td{
        border-top:0px inset #0C2D59;
        border-right:1px inset #0C2D59;
        border-bottom:1px inset #0C2D59;
        border-left:0px inset #0C2D59;
        font-size: 11px;
        font-family: verdana;
    }

    .tablaTitulo{
        background-color:#0C2D59;
        color:white;
        text-align: center;
        font-family: verdana;
        font-size: 11px;
        font-weight: bold;
    }

    .filaTablaMaestra:hover {
        background-color:#D5DDE8;
        color:black;
        font-family: verdana;
        font-size: 8px;
    }


    .filaTablaMaestra:active  {
        color:white;
    }

    .filaTablaMaestra {
        background-color: #EFF5FD;
    }
    input{
        height: 20px;
        border:1px solid #144B95;
        font-size: 11px;
        font-family: verdana;
        color:#576572;
    }
    input:hover{
        color:black
    }

</style>
<?php
require_once("../../ccontrol/control/tablaAngelCompleta.php");
require_once("../../cdatos/DReporte.php");
$o_DatosReporte = new DReporte();
$array = $o_DatosReporte->listarCieUsado();
$tabla = new TablaAngelSayes();
$arrayWidth = array(0 => "50", 1 => "840");
$arrayTitulos = array(0 => "Id", 1 => "Cie Usado");
$arrayAlign = array(0 => "center", 1 => "left");
$arrayType = array(0 => "text", 1 => "text");
$arrayCursor = array(0 => "pointer", 1 => "pointer");
$arrayImagenPorCelda = array(0 => "0", 1 => "0");
$arrayUrlImagen = array(0 => "", 1 => "");
$arrayFunction = array(0 => "", 1 => "");
$arrayTitle = array(0 => "", 1 => "");
$arrayBitBusqueda = array(0 => "0", 1 => "1");
$arrayTypeBusqueda = array(0 => "0", 1 => "text");
$numDatosEnviadosFuncionCadena = 1;
$arrayFunctionXCelda = array(0 => "agregarCieReporte", 1 => "agregarCieReporte");
$arrayFuncionesDatosCombo = array(0 => "", 1 => "");
$arrayFuncionesObjetosBusqueda = array(0 => "", 1 => "listarBusquedaCIE");
$arrayEtiquedaId = array(0 => "", 1 => "txtBusquedaCIE");
$height = 520;
$ResultadoBusqueda = 0;
$BusquedaBit = 1;
$idNameContenedorSecundario = "lstTablaListadoCie";
$resultado = $tabla->contructorTabla($idNameContenedorSecundario, $BusquedaBit, $arrayEtiquedaId, $arrayFuncionesObjetosBusqueda, $ResultadoBusqueda, $arrayFuncionesDatosCombo, $arrayBitBusqueda, $arrayTypeBusqueda, $numDatosEnviadosFuncionCadena, $arrayFunctionXCelda, $arrayTitle, $arrayFunction, $arrayImagenPorCelda, $arrayUrlImagen, $array, $arrayWidth, $arrayTitulos, $arrayAlign, $arrayType, $arrayCursor, $height);
?>
<div id="contenedorTablaDiagnostico">
    <?php echo $resultado; ?>
</div>