<?php $oLActoMedico = new LActoMedico();
//var_dump($idProgramacion);exit();
    $codigoPersona=$oLActoMedico->obtenerCodigoPersona($idProgramacion);
    $codigoPersona=$codigoPersona[0][0];
?>

<fieldset style=" margin:5px; ">
    <legend>&nbsp; Reporte :&nbsp; </legend>
    <center>
        <div style="margin-bottom: 5px;border:2px solid green;width:150px;height: 25px;background: none repeat scroll 0% 0% rgb(27, 132, 60);
             color:white;padding-top: 5px;" onclick="mostrarHistoriaClinica(<?php echo $codigoPersona; ?>);" onmouseover='this.style.background="#006631";' onmouseout='this.style.background="#1B843C";'>
            <center>Imprimir Atencion</center>
        </div>
    </center>
</fieldset>
<div style="height: 400px"  class="letra16">
    <fieldset style=" margin:5px;">
        <legend>&nbsp; Detalle de la cita:&nbsp; </legend>
        <?php echo $this->mostrarDetalleCita($idProgramacion); ?>
    </fieldset>

    <fieldset style=" margin:5px; ">
        <legend>&nbsp; Ex&aacute;menes M&eacute;dicos:&nbsp; </legend>
<?php $this->examenesHC($idProgramacion, "xfechas"); ?>
    </fieldset>

    <fieldset style=" margin:5px; ">
        <legend>&nbsp; Diagn&oacute;stico - CIE:&nbsp; </legend>
<?php echo $this->historiaDiagnostico($idProgramacion); ?>
    </fieldset>


</div>