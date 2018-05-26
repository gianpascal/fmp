<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div id="divContenidoPuntoControl" style="width:350px; height:150px;  margin:1px auto; border: #006600 solid">
    <div align="center">
        <table border="1">
            <tr>
                <td>
                    <h4><b><font color='#a0660f'> ESTADO DEL DESARROLLO </font></b> </h4> 
                </td>
                <td style="background-color: #CEE4FF">
                    <h4> <font color='#f0660f'><?php echo $arrayFilas[0][1] ?></font></h4>
                </td>
                <td type="hidden">
                    <input type="hidden" id="hiEstadoVersicion" name="hiEstadoVersicion"  value="<?php echo $arrayFilas[0][0] ?>">  
                </td>
            </tr>
            <tr>
                <td><h4><b><font color='#a0660f'> NOMBRE GRUPO</font></b> </h4> </td>
                <td><b><input type="txt" id="txtNombreGrupo" name="txtNombreGrupo"  value=""> </b> </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <a href="javascript:agregarNuevoGrupo();"> <img border="0" title="Nuevo" alt="" src="../../../../fastmedical_front/imagen/btn/b_grabar_on.gif"/></a>
                </td>
            </tr>
        </table>
    </div> 



</div>