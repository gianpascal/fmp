<?php


foreach ($listaExamenesPruebas as $examen){
?>
<div class="titleform">
    <h1>
        <?php echo $examen[0] ?>
    </h1>

</div>

<?php
    $this->vistaPrueba($examen[0]);
}

?>


