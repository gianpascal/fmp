<center>
    <table>
        <tr>
            <td>
                <div id="nombreAfiliacion" style="width: 500px;height: 50px;border:0px solid;color:#006631;font-size:20px;font-family:verdana;text-aling:center;">
                    
                </div>
            </td>
        </tr>
    </table>
    <br>
    <table>

        <tr>
            <td style="width:200px;">
        <center><p style="font-size:24px;font-family: segoe UI;color:#006631">Asignadas </center>
        </td>

        <td style="width:20px;">

        </td>

        <td style="width:200px;">
        <center><p style="font-size:24px;font-family: segoe UI;color:#006631">No Asignadas </center>
        </td>
        </tr>
        <tr>
            <td style="width:200px;">
                <?php
                echo $cb_comboModuloAsiganados;
                ?>
            </td>

            <td style="width:20px;">
                <div>
                    <input onClick="agregarSeleccion()" type="button" style="font-size:10px;font-family: segoe UI;color:white;float:left;width: 30px;height: 30px;border:2px solid white;background-color:#1B843C" value="<"  onmouseout='this.style.background="#1B843C";' onmouseover='this.style.background="#006631";' onClick="document.getElementById('txtBusquedaServicio').value='';document.getElementById('txtBusquedaServicio').focus();" >

                </div>
                <div>&nbsp;
                </div>
                <div>
                    <input onClick="quitardSeleccion()"  type="button" style="font-size:10px;font-family: segoe UI;color:white;float:left;width: 30px;height: 30px;border:2px solid white;background-color:#1B843C" value=">"  onmouseout='this.style.background="#1B843C";' onmouseover='this.style.background="#006631";' onClick="document.getElementById('txtBusquedaServicio').value='';document.getElementById('txtBusquedaServicio').focus();" >

                    </td>

                    <td style="width:200px;">
                        <?php
                        echo $cb_comboModuloNoAsiganados;
                        ?>
                    </td>
        </tr>
    </table>
    <br><br>
    <div style="padding-left:195px;">
       <input  onClick="guardarModulosAfiliacion()" type="button" style="font-size:10px;font-family: segoe UI;color:white;float:left;width: 100px;height: 30px;border:2px solid white;background-color:#1B843C" value="Guardar"  onmouseout='this.style.background="#1B843C";' onmouseover='this.style.background="#006631";' onClick="document.getElementById('txtBusquedaAfiliacion').value='';document.getElementById('txtBusquedaAfiliacion').focus();" >
    </div>
</center>
