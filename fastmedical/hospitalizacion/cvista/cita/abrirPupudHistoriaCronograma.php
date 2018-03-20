<input type="hidden" id="txtiCodigoCronograma" value="<?php echo $datos["iCodigoCronograma"]; ?>">

<div id="div_contenedorTblHistoriaCrongoramaPaciente" style="width: 896px;height: 420px;border:1px solid black;">

</div>
<style>
    .normal{
        border:1px solid #78D030;
        background-color: #FAD160;
        text-align: center;
        font-weight: bold;
    }
    .movido{
        border:1px solid #78D030;
        background-color: #4285F4;
        text-align: center;
        font-weight: bold;
        color:white;
    }
    .asignado{
        border:1px solid #78D030;
        background-color: #DA1F26;
        text-align: center;
        font-weight: bold;
        color:white;
    }
</style>
<center>
    <table boder="1" style="width:90%;margin-top: 3px;" cellspacing="0"> 
        <tr>
            <td style="float:right;"><strong>Normal:</strong></td>
            <td><input type="text" class="normal" style="width:25px;float:left;"  value="<?php echo $data[0][0]; ?>"></td>
            <td  style="float:right;"><strong>Movidos:</strong></td>
            <td><input type="text" class="movido" style="width:25px;float:left;"  value="<?php echo $data[0][1]; ?>"></td>
            <td  style="float:right;"><strong>Asignados:</strong></td>
            <td><input type="text" class="asignado" style="width:25px;float:left;"  value="<?php echo $data[0][2]; ?>"></td></tr>
    </table>
</center>