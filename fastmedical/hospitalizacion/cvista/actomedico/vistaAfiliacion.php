
<div style="width:98%;margin-top:10px;">
    <input type="hidden" id="htxtcodigoafiliacion" name="htxtcodigoafiliacion" value="<?php echo $resultado["cIdAfiliacion"]; ?>" />
    <table width="100%" border="0" cellspacing="0" >
        <tr>
            <td colspan="7"><input  id="hidCodPersona"  name="hidCodPersona" value="<?php echo $resultado["codpersona"]; ?>" type="hidden"></td>
            <td width="14%" style ="border-style: solid;border-width: 1px" rowspan="8" align="center">
                <div>
<!--                    <img height="159px" width="120px" align="middle" src="<?php echo $imagen; ?>" alt="">-->
                </div>
            </td>
        </tr>
        <tr>
            <td width="9%" class="filalabel">Fecha :</td>
            <td width="9%" class="filalabel"><?php echo $resultado["fechaatencion"]; ?></td>
            <td width="10%" class="filalabel">Especialidad :</td>
            <td colspan="2" class="filalabel"><?php echo ($resultado["nombreservicio"]); ?></td>
            <td width="12%" class="filalabel">Hora :</td>
            <td width="15%" class="filalabel"><?php echo date('H : i'); ?></td>

        </tr>
        <tr>
            <td class="filalabel">Nombre :</td>
            <td class="filalabel" colspan="4"><?php echo htmlentities($resultado["nombre"]); ?></td>
            <td class="filalabel">Sexo :</td>
            <td class="filalabel"><?php echo $resultado["sexo"]; ?></td>
        </tr>
        <tr>
            <td class="filalabel">Edad :</td>
            <td class="filalabel" colspan="2"><?php echo utf8_encode($resultado["edad"]); ?></td>
            <td class="filalabel" width="9%">Afiliacion :</td>
            <td class="filalabel" width="22%"><?php echo $resultado["vAfiliacionActoMedico"]; ?></td>
            <td class="filalabel">Fec. Nacimiento :</td>
            <td class="filalabel"><?php echo$resultado["fechanacimiento"]; ?><input type="hidden" id="txtFechaNacimientoTriaje" value="<?php echo$resultado["fechanacimiento"]; ?>"></td>
        </tr>
        <tr>
            <td class="filalabel">DNI :</td>
            <td class="filalabel" colspan="2"><?php echo utf8_encode($resultado["dni"]); ?></td>
            <td class="filalabel" width="9%">Estado Civil :</td>
            <td class="filalabel" width="22%"><?php echo $resultado["estadocivil"]; ?></td>
            <td class="filalabel"></td>
            <td class="filalabel"></td>
        </tr>
        <tr>
            <td class="filalabel" colspan="8" align="center">
                <a onclick="editarDatosPersona();" href="javascript:;">
                    <img src="../../../../fastmedical_front/imagen/btn/b_ver_on.gif" id="imgVerPacienteDatos" alt="Ver">
                </a>
                <a href='javascript:;' onclick="javascript:regresarAgendaMedica();">
                    <img id="btnregresarActoMedico" src='../../../../fastmedical_front/imagen/btn/b_regresar_on.gif' title='Regresar' alt=""/>
                </a>
            </td>
        </tr>
    </table>
</div>
