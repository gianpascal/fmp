<fieldset>
        <legend>Procedimiento </legend>
        <input type="hidden" id="hEstadoAgregarTratamientoPracticaMedica_<?php echo $datos["numerodivpracticamedica"]; ?>" value="<?php echo $datos["estadoregistro"]; ?>" >
        <input type="hidden" id="hIdTratamientoPracticaMedica_<?php echo $datos["numerodivpracticamedica"]; ?>" value="<?php echo $datos["idtratamiento"]; ?>" >
        <input type="hidden" id="hcodigoPracticaMedica_<?php echo $datos["numerodivpracticamedica"]; ?>" value="<?php echo $datos["codigoservicio"];?>" >
        
        <input type="hidden" id="hbPaquete_<?php echo $datos["numerodivpracticamedica"]; ?>" value="<?php echo $bPaquete[0][0]; ?>" >
        <input type="hidden" id="hcodigoPracticaMedica1_<?php echo $datos["estado"]; ?>" value="<?php echo $datos["estado"];?>" >
        <?php if($bPaquete[0][0] ==''){
           $paquete =$datos["estado"]; 
        }else {
           $paquete =$bPaquete[0][0];
        }
        
        ?>
        <table width="100%" border="0">
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td width="16%">&nbsp;</td>
                <td width="1%">&nbsp;</td>
                <td width="5%" align="right"><div style="margin-top: -15px">
                    <?php if( $paquete==0) { ?>    <a href="javascript:;" onClick="javascript:eliminarPracticaMedicaHC(<?php echo "'Div_PracticaMedica".$datos["numerodivpracticamedica"]."','".$datos["codigoservicio"]."','".$datos["numerodivpracticamedica"]."'";?>);"><img src='../../../../fastmedical_front/imagen/icono/borrar.png' alt="Eliminar"></a></div>
                   <?php } ?>
                </td>
            </tr>
            <tr>
                <td width="7%">Nombre</td>
                <td width="36%"><?php echo ($datos['nombreservicio']); ?></td>
                <td width="17%">C&oacute;digo Segus :</td>
                <td width="18%"><?php echo $datos["codigosegus"];?></td>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">Observaci&oacute;n</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td height="70">&nbsp;</td>
                <td colspan="4">
                    <?php if( $paquete==1) {
                        
                      $content='Por Paquete';
                      if(trim($datos["modoaplicacion"])==$content){
                            $content='';
                        }else {
                            if(trim($datos["modoaplicacion"])>$content){
                            $content='';
                            }
                        }
                    }else {
                     $content='';   
                    }
                    
                    ?>
                    <textarea id="<?php echo "txtareaObservacionPracticaMedica_".$datos["numerodivpracticamedica"];?>"name="<?php echo "txtareaObservacionPracticaMedica_".$datos["numerodivpracticamedica"];?>"cols="85" rows="3"onchange="<?php echo "cambiarEstadoTratamientoPracticasMedicas('".$datos["numerodivpracticamedica"]."')";?>"><?php echo ($datos["modoaplicacion"]); ?><?php echo ($datos["nombreServicionCPT"]) ?></textarea>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>
    </fieldset>
    <br/>


