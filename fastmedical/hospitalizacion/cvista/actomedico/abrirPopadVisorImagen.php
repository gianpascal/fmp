<div style="position:none;float:left;">
    <table>
        <tr>
         <td>
                <button onclick="girarImagenPopad(0,<?php echo $datos['numero']; ?>);" style="font-size:8px;cursor: pointer;border: 1px solid black; border-radius:5px;width:23px; height: 23px; ">0º</button></td>
            <td>
                <button onclick="girarImagenPopad(90,<?php echo $datos['numero']; ?>);" style="font-size:8px;cursor: pointer;border: 1px solid black; border-radius:5px;width:23px; height: 23px;">90º</button></a></td>
            <td>
                <button onclick="girarImagenPopad(180,<?php echo $datos['numero']; ?>);" style="font-size:8px;cursor: pointer;border: 1px solid black; border-radius:5px;width:23px; height: 23px; ">180º</button></td>
            <td>
                <button  onclick="girarImagenPopad(270,<?php echo $datos['numero']; ?>);" style="font-size:8px;cursor: pointer;border: 1px solid black; border-radius:5px;width:23px; height: 23px; ">270º</button></td>
          <td style="width:23px;"></td>
            <td>
          
                <button  onclick="aumentarTamaño('mas',<?php echo $datos['numero']; ?>);" style="font-size:8px;cursor: pointer;border: 1px solid black; border-radius:5px;width:23px; height: 23px; ">+</button></td>
        <td>
                <button  onclick="aumentarTamaño('menos',<?php echo $datos['numero']; ?>);" style="font-size:8px;cursor: pointer;border: 1px solid black; border-radius:5px;width:23px; height: 23px; ">-</button></td>
                   <td style="width:23px;"></td>
        <td>
                <button  onclick="Windows.close('Div_abrirPopadVisorImagen')" style="font-size:8px;cursor: pointer;border: 1px solid black; border-radius:5px;width:23px; height: 23px; ">X</button></td>
        
        </tr>
    </table>
</div>
<br><br><br>
<div id="contenedorImagenPopad" style="float:left;">
    <img class="rot<?php echo $datos['rotacion']; ?>" id="imagen" src="<?php echo $datos['url']; ?>" style="margin-left:<?php echo $datos['margin'];?>">
</div>  