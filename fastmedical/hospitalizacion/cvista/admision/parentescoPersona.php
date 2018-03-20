<?php
$toolbar10=new ToollBar("center");
if(isset($_SESSION["permiso_formulario_servicio"][110]["AGREGAR_PARENTESCO_PAC"]) && $_SESSION["permiso_formulario_servicio"][110]["AGREGAR_PARENTESCO_PAC"]==1)
    $toolbar10->SetBoton("btnParentesco","Agregar","btn","onclick,onkeypress","buscarParentescoPaciente()","../../../../medifacil_front/imagen/icono/good.gif","","",1);
?>
<table width="710" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td colspan="3">
            <fieldset>
                <legend>&nbsp; PARENTESCO DEL PACIENTE &nbsp;</legend>
                <div id="div_parentescoPaciente" align="center">
                    <div style="width: 400px;" align="center">
                    <fieldset>
                        <table align="center">
                            <tr>
                                <td colspan="2" align="center"> <h1> PARENTESCOS </h1><input id="hidCodPersona" name="hidCodPersona" type="hidden" value="<?php echo $iid_persona;?>"> </td>
                            </tr>
                            <tr>
                                <td class="lt14"><strong> Paciente : </strong></td>
                                <td class="lt14"><?php echo htmlentities(trim($vapellido_pat))." ".htmlentities(trim($vapellido_mat))." ".htmlentities(trim($vnombre));?></td>
                            </tr>
                            <tr>
                                <td class="lt14"><strong>Edad : </strong></td>
                                <td class="lt14"><?php echo trim($edadpaciente);?></td>
                            </tr>
                        </table>
                    </fieldset>
                        <div style="width: 100px; margin-top: 10px; margin-bottom: 10px;" align="center">
                            <?php $toolbar10->Mostrar();?>
                        </div>
                    </div>
                    <div id="divListaParentesco" style="width: 93%; height: 250px; overflow: auto;" align="center" >lista de parentesco</div>
                </div>
            </fieldset>
        </td>
    </tr>
</table>