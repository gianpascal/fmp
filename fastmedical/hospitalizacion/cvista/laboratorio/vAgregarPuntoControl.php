<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<input type="hidden" id="hiIdpuntoControl" name="hiIdpuntoControl"  value="">

<input type="hidden" id="hMaximaSecuencia" name="hMaximaSecuencia"  value="<?php echo $arrayFilas[0][0] ?>">

<div align="center">
    <table align="center">
        <tr align="center">
            <td align="center">
                <div id="divContenidoPuntoControl" style="width:500px; height:300px;  margin:1px auto; border: #006600 solid">
                    <div class="titleform" align="center">
                        <h1>Mantenimiento Datos de Examenes</h1>
                    </div>
                    <div id="divPuntoControl" class="toolbar" style="width:450px;float: center; height: 250px; " align="center"> 
                        <table>
                            <tr>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div id="div_ReportePuntoControl" style="width:420px;float: left; height: 220px; ">
                                    </div>   
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="javascript:guardarNuevoPuntoControl();"> <img border="0" title="Nuevo" alt="" src="../../../../medifacil_front/imagen/btn/b_grabar_on.gif"/></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>  
            </td>
        </tr>
    </table>
</div>

