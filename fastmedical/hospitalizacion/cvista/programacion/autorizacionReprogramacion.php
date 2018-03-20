<div style="width:100%;height: 90%">
    <fieldset style="margin:1px;padding:1px;height:100%;">
        <legend style="text-align:center; font-family:Verdana, Arial, Helvetica, sans-serif;font-size:10px;font-weight:bold;">Generación de Código de Autorización</legend>

        <table style="width:100%;height: 100%">
            <tr><td class ="Estilo9">
                    <div id="Div_AutorizaReprogramacion" align="center">
                        <table width="80%" align="center">
                            <tr align="left">
                                <td class="Estilo6">Nº Documento</td>
                                <td>
                                    <table width="100%" align="center">
                                        <tr>
                                            <td align="center" width="100%" style="font-family:Arial;font-size:11pt"><input type="text" id="txtnumerodocumento" name="txtnumerodocumento" value="" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr align="left">
                                <td class="Estilo6">Código Autorización</td>
                                <td >
                                    <table width="100%" align="center">
                                        <tr>
                                            <td class="Estilo6" align="center" width="100%" style="font-family:Arial;font-size:11pt"><input type="text" id="txtcodigoverificacion" name="txtcodigoverificacion" value="" readonly="true"/></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <table>
                             <?php if($_SESSION["permiso_formulario_servicio"][119]["GENERAR_COD_AUTOR_REPROG_MED"]==1) echo "<tr><td><a href=\"#\" onclick=\"javascript:generarCodigoAutorizacionProgramacionMedicos()\"><img src='../../../../medifacil_front/imagen/btn/b_generar_on.gif' title='Generar Código Autorización' alt=\"Generar Código Autorización\"/></a></td></tr>"?>
                        </table>

                    </div>
                </td>
        </table>
    </fieldset>
</div>
