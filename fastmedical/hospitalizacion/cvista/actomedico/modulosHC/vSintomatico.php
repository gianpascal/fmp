<?php
require_once("ActionActoMedico.php");
$o_ActionActoMedico = new ActionActoMedico();
$resultado = $o_ActionActoMedico->aListarSintomaticos($datos);
?>
<style>
    .btnReportes{
        margin: 3px;
        width: 180px;
        height: 25px;
        font-size:14px;
        font-family: verdana;
        color:white;
        background: green;
        border:2px solid cadetblue;
        text-align: center;
        padding-top: 5px;
    }
    .btnReportes:hover{
        background: cadetblue;
        border:2px solid green;
        cursor: pointer;
    }
    .btnReportes1{
        margin: 3px;
        width: 200px;
        height: 25px;
        font-size:14px;
        font-family: verdana;
        color:white;
        background: #D4D0C8;
        border:2px solid cadetblue;
        text-align: center;
        padding-top: 5px;
        color:black;
    }
    .btnReportes1:hover{
        background: #5C6773;
        border:2px solid #D4D0C8;
        color:white
    }
</style>
<div id="Div_Sintomatico" style="width:100%;float: left">
    <div id="Div_SintomaticoEncabezado" class="titleform" style="cursor: pointer;" onclick="javascript:abrirDiv('Div_SintomaticoCuerpo');">
        <table style="height: auto;width: 100%" class="accordion_title">
            <tr align="center">
                <td >
                    <h1>Sintomatico Respiratorio</h1>
                </td>
                <td style="width:3%">
                    <img id="Div_SintomaticoCuerpoicono" src='../../../../medifacil_front/imagen/icono/plegar.png' title='plegar' alt=""/>
                </td>
            </tr>
        </table>
    </div>
    <div id="Div_SintomaticoCuerpo" style="width:100%;display:block;border-style: solid;border-width: 0px">
        <br>
        <table border="0" width="800" cellspacing="0">                  
            <tr>
                <td width="300">
                    <ul>
                        <li style="font-family: verdana;font-size: 14px;font-weight: bold">Sintomatico Respiratorio</li>
                    </ul>
                </td>
                <td width="115">
                    <?php
                    if ($resultado) {

                        if ($resultado[0][0] == 1) {
                            $selectedSi = "selected";
                            $selectedNo = "";
                        } else {
                            $selectedSi = "";
                            $selectedNo = "selected";
                        }
                    } else {
                        $selectedNo = "selected";
                    }
                    ?>
                    <select onChange="insertaActualizaSintomatico();" id="cbxSintomatico" style="width:110px;height:25px;font-family: verdana;font-size: 12px;">
                        <option <?php echo $selectedSi; ?> value="1">Si</option>
                        <option  <?php echo $selectedNo; ?> value="0">No</option>
                    </select>
                </td>
                <td>
                    <?php
                    if ($resultado) {
                        if ($resultado[0][0] == 1) {
                            $display = "display:block;";
                        } else {
                            $display = "display:none;";
                        }
                        if ($resultado[0][1] >=15) {
                            $display1 = "display:block;";
                        } else {
                            $display1 = "display:none;";
                        }
                    } else {
                        $display = "display:none;";
                        $display1 = "display:none;";
                    }
                    ?>
                    <div id="div_nroDiasSintomatico" style="<?php echo $display; ?>">
                        <table>
                            <tr>
                                <td width="200">
                                    <label style="font-family: verdana;font-size: 12px;font-weight: bold">Nro. Días</label>  
                                </td>
                                <td width="200">
                                    <?php
                                    if ($resultado) {
                                        $ValorInput = $resultado[0][1];
                                    } else {
                                        $ValorInput = 0;
                                    }
                                    ?>
                                    <input onchange="actualizarNumeroDiasSintomatico();" onFocus="this.value=''" maxlength="2" value="<?php echo $ValorInput; ?>" onKeyUP="validarNumeroDias()" type="text" id="txtNumeroDiasSintomatico" style="width:30px;height:25px;font-family: verdana;font-size: 12px;">
                                </td>
                            </tr>

                        </table>
                    </div>
                </td>
                <td>
                    <div onClick="generarSintomaticoRespiratorio()" id="div_btnGenerarOrdenDK" class="btnReportes" style="<?php echo $display1; ?>"> 
                        Generar 2 Ordenes BK
                    </div>
                </td>
            </tr>
        </table>
        <br>
    </div>
</div>
<input type="hidden" value="" id="txtNumeroBK">
<input type="hidden" value="" id="contadorBK">
