<div id="<?php echo $idDiv;?>" style="height: 400px" class="letra16">
    <input id="txtCodigoPersona" name="txtCodigoPersona" type="hidden" value="<?php echo $codigoPersona;?>">
    <fieldset style=" margin:5px; border:0;">
        <legend>&nbsp;<?php echo $titulo;?>&nbsp;</legend>
        <div style="margin-left: 1%; margin-right: 1%;">
            <?php
            switch ($id) {
                case 2:
                   echo $this->hstrMotivoConsulta($idPaciente);
                    break;
                case 3:
                    echo $this->hstrAntecedentes($idPaciente);
                    break;
                case 4:
                    $this->hstrExamenesMedicos($idPaciente);
                    break;
                case 5:
                    echo $this->hstrDiagnostico($idPaciente);
                    break;
                case 6:
                    echo $this->hstrTratamientoMedicamentos($idPaciente);
                    break;
                case 7:
                    echo $this->hstrTratamientoPracticas($idPaciente);
                    break;
                case 8:
                    $this->vistaLaboratorio($idPaciente);
                    break;
                case 9:
                    $this->vistaOdontograma($idPaciente);
                    break;
            }
            ?>
        </div>

    </fieldset>
</div>
