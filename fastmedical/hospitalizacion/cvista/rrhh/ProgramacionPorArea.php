<style>
    .tablaProgramacionXArea{
        width: 99%;
        height: auto;
        border:1px solid;
    }
    .celda{
        border:1px solid #7CBD0C;
        font-size:14px;
    }
    .celdaFilas{
        border:1px solid #7CBD0C;
        font-size:10px;
    }
    
    .cabecera{
         border:1px solid;
       background: #9dd53a; /* Old browsers */
        background: -moz-linear-gradient(top, #9dd53a 0%, #a1d54f 50%, #80c217 51%, #7cbc0a 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#9dd53a), color-stop(50%,#a1d54f), color-stop(51%,#80c217), color-stop(100%,#7cbc0a)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #9dd53a 0%,#a1d54f 50%,#80c217 51%,#7cbc0a 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top, #9dd53a 0%,#a1d54f 50%,#80c217 51%,#7cbc0a 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top, #9dd53a 0%,#a1d54f 50%,#80c217 51%,#7cbc0a 100%); /* IE10+ */
        background: linear-gradient(to bottom, #9dd53a 0%,#a1d54f 50%,#80c217 51%,#7cbc0a 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#9dd53a', endColorstr='#7cbc0a',GradientType=0 ); /* IE6-9 */
        font-size:22px;
        font-family: verdana;
        font-weight: bold;
        text-align: center;
        height: 15px;
        vertical-align: middle;
        color:white;
    }
    .filapar{
        background-color: #CDF7F5;
         font-size:16px;
        font-family: verdana;
        font-weight: bold;
        text-align: center;
        height: 10px;
        vertical-align: middle;
        color:black;
    }
    .filapar:hover{
        background-color: #92ED82; 
         font-size:16px;
        font-family: verdana;
        font-weight: bold;
        text-align: center;
        height: 10px;
        vertical-align: middle;
        color:black;
    }
    .filaimpar{
         background-color: #50C9C3; 
          font-size:16px;
        font-family: verdana;
        font-weight: bold;
        text-align: center;
        height: 10px;
        vertical-align: middle;
        color:black;
    }
    .filaimpar:hover{
         background-color: #92ED82;
          font-size:16px;
        font-family: verdana;
        font-weight: bold;
        text-align: center;
        height: 10px;
        vertical-align: middle;
        color:black;
    }
</style>
<h1><?php echo $resultadoAreaSede[0][1]?>-<?php echo $resultadoAreaSede[0][2]?></h1>
<br>
    <div id="DivTablaProgramacionPorArea" style="width:100%;max-height: 90%;overflow-y: auto;">
        <table class="tablaProgramacionXArea" cellspacing="0" border="0">
            <tr class="cabecera">
                <td class="celda">
                    Codigo
                </td>
                <td class="celda">
                    Hora
                </td>
                <td class="celda">
                    Horas por Turno
                </td>
                <td class="celda">
                    Turnos
                </td>
                <td class="celda">
                    Total
                </td>
            </tr>
            <?php
            $total = (0);
            $contador = count($resultado);
            for ($x = 0; $x <= $contador - 1; $x++) {
                if ($x%2==0){ $class="filapar";}else{$class="filaimpar";}
                ?>
                <tr class="<?php echo $class;?>">
                    <?php for ($y = 0; $y <= 4; $y++) { ?>
                        <td class="celdaFilas">
                            <?php 
                            echo $resultado[$x][$y]; 
                            ?>
                        </td>
                    <?php }
                    $total +=($resultado[$x][4]);
                    ?>
                </tr>
            <?php }
            ?>
        </table>
        <br>
        <div style="width: 90%;text-align: right">
            <p style="border:0px solid;font-family: verdana;font-size: 20px;"><b>Total:</b> <?php echo $total;?>
        </div>
        

    </div>
    <br>

