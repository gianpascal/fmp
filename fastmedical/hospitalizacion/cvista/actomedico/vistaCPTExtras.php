<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<input type="hidden" id="hCTPExtra<?php echo $datos["ctp"] ?>" name="hCTPExtra"  value="<?php echo $datos["ctp"] ?>">
<input type="hidden" id="hnroAte<?php echo $datos["nroAte"] ?>" name="hnroAte"  value="<?php echo $datos["nroAte"] ?>">
<input type="hidden" id="hiIdServicioGrupoEtareoPersona<?php echo $datos["iIdServicioGrupoEtareoPersona"] ?>" name="hnroAte"  value="<?php echo $datos["iIdServicioGrupoEtareoPersona"] ?>">

<input type="hidden" id="hiIdprobando<?php echo $datos["iIdServicioGrupoEtareoPersona"] ?>" name="hnroAte"  value="divTablaCTPExtra<?php echo $datos["nroAte"] ?><?php echo $datos["iIdServicioGrupoEtareoPersona"] ?>">
<br><br>
<div id ="lobo" align="center">
    <table>
        <tr>
            <td>
                <div id="divTablaCTPExtra<?php echo $datos["nroAte"] ?><?php echo $datos["iIdServicioGrupoEtareoPersona"] ?>" 
                     align="center"  style="width: 650px; float: left; height: 200px;">
                </div>  
            </td>
        </tr>
    </table> 

</div>
