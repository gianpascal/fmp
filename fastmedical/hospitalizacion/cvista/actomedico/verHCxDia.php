<?php $oLActoMedico = new LActoMedico(); ?>

<fieldset style=" margin:5px; ">
    <legend>&nbsp; Reporte :&nbsp; </legend>
    <center>
        <div style="margin-bottom: 5px;border:2px solid green;width:150px;height: 25px;background: none repeat scroll 0% 0% rgb(27, 132, 60);
             color:white;padding-top: 5px;" onclick="ImprimirHCXdia(<?php echo $idProgramacion; ?>);" onmouseover='this.style.background="#006631";' onmouseout='this.style.background="#1B843C";'>
            <center>Imprimir Atencion</center>
        </div>
    </center>
</fieldset>
<div style="height: 400px"  class="letra16">
    <fieldset style=" margin:5px;">
        <legend>&nbsp; Detalle de la cita:&nbsp; </legend>
        <?php echo $this->mostrarDetalleCita($idProgramacion); ?>
    </fieldset>

    <fieldset style=" margin:5px;">
        <legend>&nbsp; Triaje:&nbsp; </legend>
        <?php echo $this->triaje($idProgramacion); ?>
    </fieldset>

    <fieldset style=" margin:5px;">
        <legend>&nbsp; Motivo de Consulta:&nbsp; </legend>
        <!--<div style="margin-left: 10%; margin-right: 10%;">-->
        <?php echo $this->historiaMotivoConsulta($idProgramacion); ?>
        <!--</div>-->
    </fieldset>

    <fieldset style=" margin:5px; ">
        <legend>&nbsp; Antecedentes:&nbsp; </legend>
        <!--<div style="margin-left: 10%; margin-right: 10%;">-->
        <?php echo $this->historiaAntecedentes($idProgramacion); ?>
        <!--</div>-->
    </fieldset>
    <?php
    $historiaOdontograma = $this->listadoHistoriaDiente($idProgramacion);
    if ($historiaOdontograma) {
        ?>
        <fieldset style=" margin:5px; ">
            <legend>&nbsp; Odontograma:&nbsp; </legend>
            <?php echo $this->cuerpoHIstoriaODontograma($historiaOdontograma);
            ;
            ?>
        </fieldset>
<?php } ?>
    <fieldset style=" margin:5px; ">
        <legend>&nbsp; Ex&aacute;menes M&eacute;dicos:&nbsp; </legend>
<?php $this->examenesHC($idProgramacion, "xfechas"); ?>
    </fieldset>

    <fieldset style=" margin:5px; ">
        <legend>&nbsp; Diagn&oacute;stico - CIE:&nbsp; </legend>
<?php echo $this->historiaDiagnostico($idProgramacion); ?>
    </fieldset>

    <fieldset style=" margin:5px; ">
        <legend>&nbsp; Tratamientos:&nbsp; </legend>
        <!--<div style="margin-left: 1%; margin-right: 1%;">-->
<?php echo $this->historiaTratamientos($idProgramacion); ?>
        <!--</div>-->
    </fieldset>

</div>