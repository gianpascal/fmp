<center><div style="width: 900px;"><br><p style="font-size:24px;color:green;font-family: verdana;">Practica Diego</div></center>
<br>
<div style="float:left;border:1px solid;width: 100%;background-color: #AFE285;">
    <br>
    <div style="padding-left: 50px;padding-bottom: 30px;">
        <div id="contendorTablaExamanes" style="float:left;border:1px solid;width: 70%;height: 350px;">
        </div>
    </div>
    <div style="float:left;padding-left: 10px;padding-bottom: 30px;">
        <div id="TablaDatos" style="border:1px solid;width: 300px;height: 300px;padding-left: 20px;background-color: #9ECC2A;">
            <div style="width: 60px;float:left;"><br>Codigo:</div>
            <div style="width: 220px;float:left;"><br><input type="text" id="codigo" style="width:70px;"></div>
            <div style="width: 60px;float:left;"><br>Apellido Pat.</div>
            <div style="width: 220px;float:left;"><br><input type="text" id="apellidoPa" style="width:170px;"></div>
            <div style="width: 60px;float:left;"><br>Apellido Mat.</div>
            <div style="width: 220px;float:left;"><br><input type="text" id="apellidoMa" style="width:170px;"></div>
            <div style="width: 60px;float:left;"><br>Nombres:</div>
            <div style="width: 220px;float:left;"><br><input type="text" id="nombres" style="width:200px;"></div>
            <div style="width: 60px;float:left;"><br>Sexo:</div>
            <div style="width: 220px;float:left;"><br><select id="sexo"><option VALUE=""></option><option VALUE="1">MASCULINO</option><option VALUE="0">FEMENINO</option></select></div>
            <div style="width: 60px;float:left;"><br>Fecha Nac:</div>
            <div style="width: 220px;float:left;"><br><input type="text" id="fecha" style="width:80px;"></div>
            <div style="width: 220px;float:left;"><br><br></div>
            <div style="padding: 100px;height: 100px;">
                <?php
                $toolbar = new ToollBar();
                $toolbar->SetBoton("Guardar", "Guardar", "btn", "onclick,onkeypress", "GuarfarDatosPersona", "../../../../medifacil_front/imagen/icono/filesave.png", "", "", true);
                $toolbar->Mostrar();
                ?>
            </div>
        </div>
    </div>
    <br>
</div>
<div style="float:left;width: 100%;"><br><br></div>
<div style="float:left;border:1px solid;width: 100%;background-color: #AFE285;">
    <table border="1" >
        <?php
        $array = array(
            0 => "Lunes",
            1 => "Martes",
            2 => "Miercoles",
            3 => "Jueves",
            4 => "Viernes",
            5 => "Sabado",
            6 => "Domingo",
        );

        $arrayHoras = array(
            0 => "08:00 - 09:00",
            1 => "09:00 - 10:00",
            2 => "10:00 - 11:00",
            3 => "11:00 - 12:00",
            4 => "12:00 - 01:00",
            5 => "01:00 - 02:00",
            6 => "02:00 - 03:00",
            7 => "03:00 - 04:00",
            8 => "04:00 - 05:00",
            9 => "05:00 - 06:00",
        );
        $x = 0;
        $contador = 0;
        $contador = (count($array)) - 1;
        $contadorHoras = (count($arrayHoras)) - 1;
        $cont = 1;
        for ($y = 0; $y <= $contadorHoras + 1; $y++) {
            if ($y == 0) {
                for ($x = 0; $x <= $contador + 1; $x++) {
                    if ($x == 0) {
                        echo '<tr><td colspan="' . ($contador + 2) . '"><font size="6"><center>HORARIOS</center></font></td></tr>';
                        echo '<tr>';
                        echo '<td><font size="6"></font></td>';
                    }
                    echo '<td><font size="6">' . $array[$x] . '</font></td>';
                    if ($x == $contador + 1) {
                        echo '</tr>';
                    }
                }
            } else {
                for ($x = 0; $x <= $contador; $x++) {
                    if ($x == 0) {
                        echo '<tr>';
                        echo '<td><font size="6">' . $arrayHoras[$y - 1] . '</font></td>';
                    }

                    echo '<td><font size="6"><input type="text" id="txthorario' . $cont . '" value="' . $cont . '"></font></td>';


                    if ($x == $contador) {
                        echo '</tr>';
                    }
                    $cont++;
                }
            }
        }
        ?>
    </table>
    <?php 
    $angel = 0;
    $cont=1;
        echo '<br>';
        echo '<br>';
        for ($angel = 0; $angel <= $contador; $angel++) {
            echo '<table border="1">';
            echo '<tr><td colspan="' . ($contadorHoras+1) . '"><font size="6"><center>'.$array[$angel].'</center></font></td></tr>';
            for ($diego =0;$diego<=$contadorHoras;$diego++){
                if ($diego==0){
                    echo '<tr>';
                }
                echo '<td><font size="4"><center>'.$arrayHoras[$diego].'</center></font></td>';
                if  ($diego==$contadorHoras){
                     echo '</tr>';
                }
            }
            for ($diego =0;$diego<=$contadorHoras;$diego++){
                if ($diego==0){
                    echo '<tr>';
                }
                  echo '<td><font size="2"><input type="text" id="txthorario' . $cont . '" value="' . $cont . '"  style="width:70px;"></font></td>';
               if  ($diego==$contadorHoras){
                     echo '</tr>';
                }
                  $cont++;
            }
            echo '</table>';
            echo '<br>';
        }
    ?>
<?php
    $cont=0;$fil=0;$col=0;
    for($cont=0;$cont<=$contadorHoras;$cont++){
        echo '<table border="1">';
        for($fil=0;fil<=1;$fil++){
            if($cont==0){
                echo '<tr>';
                    for($col=0;$col<=$contador;$col++){
                        if($col==0){
                            echo '<td>HORAS</td>';
                        }
                        else{
                            echo '<td>'.$array[$col].'</td>';
                        }
                        
                    }
                echo '</tr>';
                
            }
        }
        echo'</table>';
    }
?>


</div>
