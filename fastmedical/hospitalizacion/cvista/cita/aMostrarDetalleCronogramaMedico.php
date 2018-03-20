<style>
    .reservador{
        border:1px solid #78D030;
        background-color: #F0F43A;
        text-align: center;
        
    }
    .pagado{
        border:1px solid #78D030;
        background-color: #F8A83E;
        text-align: center;
        
    }
     .atendidos{
        border:1px solid #78D030;
        background-color: #DEEDF8;
        text-align: center;
        
    }
       .otros{
        border:1px solid #78D030;
        background-color: #5493DC;
        text-align: center;
        color:white;        
    }
      .anulados{
        border:1px solid #78D030;
        background-color: #D4D0C8;
        text-align: center;
        color:black;        
    }
</style>
<center>
    <table boder="1" style="width:90%;margin-top: 3px;" cellspacing="0"> 
        <tr>
            <td style="float:right;"><strong>Total Cupos:</strong></td>
            <td><input type="text" class="otros" style="width:25px;float:left;"  value="<?php echo $data[0][1]; ?>"></td>
            <td  style="float:right;"><strong>Adicionales:</strong></td>
            <td><input type="text" class="otros" style="width:25px;float:left;"  value="<?php echo$data[0][2]; ?>"></td>
            <td  style="float:right;"><strong>Reservados:</strong></td>
            <td><input type="text" class="reservador" style="width:25px;float:left;"  value="<?php echo $data[0][3]; ?>"></td>
            <td  style="float:right;"><strong>Pagados o Confirmados:</strong></td>
            <td><input type="text" class="pagado"  style="width:25px;float:left;"  value="<?php echo $data[0][4]; ?>"></td>
            <td  style="float:right;"><strong>Atendidos:</strong></td>
            <td><input type="text" class="atendidos" style="width:25px;float:left;"  value="<?php echo $data[0][6]; ?>"></td>
            <td  style="float:right;"><strong>Anulados:</strong></td>
            <td><input type="text" class="anulados" style="width:25px;float:left;"  value="<?php echo $data[0][5]; ?>"></td>
        </tr>
    </table>
</center>