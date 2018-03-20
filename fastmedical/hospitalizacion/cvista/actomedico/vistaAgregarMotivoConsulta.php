<?php if($numSintomas!=0){ ?><div id="Div_sintoma_<?php echo $numSintomas;?>" style="width:85%">
        <fieldset class="examenes" style="margin:5px;">
            <legend>&nbsp; S&iacute;ntoma: &nbsp;</legend>
                <input type="hidden" id="hdnEstadoSintoma_<?php echo $numSintomas;?>" value="<?php echo $estadoSintoma;?>">
                <input type="hidden" id="hdnIdMotivoDeConsulta_<?php echo $numSintomas;?>" value="<?php echo $idMotivoDeConsulta;?>">
                <div style="float: right; margin-top: -15px;">
                    <a href="javascript:;" onclick="javascript:cerrarMotivoDeConsulta(<?php echo $numSintomas;?>);">
                        <img src='../../../../medifacil_front/imagen/icono/borrar.png' alt="Cerrar" title="Cerrar">
                    </a>
                </div>
                <fieldset style="margin:5px;">
                    <div align="left" style="margin:2px;">
                        <b><input id="hdnSintomaCIE_<?php echo $numSintomas;?>" type="hidden" value="<?php echo $idSintoma;?>"/> <?php echo ($nombreSintoma);?></b>
                    </div>
                </fieldset>
                <fieldset class="subExamenes" style="margin:5px;">
                    <legend>&nbsp; Descripci&oacute;n: &nbsp;</legend>
                    <div align="left" style="margin:2px;">
                        <textarea id="txaDescSintoma_<?php echo $numSintomas;?>" onchange="cambiarMotivoDeConsulta(<?php echo $numSintomas; ?>);" style="width:100%; height:30px;" cols="" rows=""><?php echo htmlentities($descSintoma);?></textarea>
                    </div>
                </fieldset>
        </fieldset>
    </div>
<?php if($ultimo=='si'){ ?>
</div>
        <input id="hdnNumSintomas" type="hidden" value="<?php echo $numSintomas;?>"/>
       
<?php } ?>
<?php }else{ ?>
    </div>
        <input id="hdnNumSintomas" type="hidden" value="<?php echo $numSintomas;?>"/>
        
<?php } ?>