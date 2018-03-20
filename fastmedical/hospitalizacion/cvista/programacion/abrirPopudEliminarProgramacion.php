<style>
    .btnReporte{
        width: 20px;
        font-size:14px;
        font-family: verdana;
        color:white;
        background-color: green;
        text-align: center;
        border:1px solid;
    }
    .btnReporte:hover{
        background: cadetblue;
        cursor: pointer;
        border:1px solid green;
        color:white;
    }
</style>

<?php
$valorMotivo = "";
$resultado;
if ($datos['accion'] == 0) {
    $valorMotivo = "";
} else {
    require_once("../../clogica/LCronograma.php");
    $o_Lcronograma = new LCronograma();
    $resultado = $o_Lcronograma->traerMotivoEliminacion($datos);
    $valorMotivo = $resultado[0][0];
}
?>
<p>Motivo:
<textarea id="motivoEliminacion" max="250" style="width: 100%;height: 100px;"><?php echo $valorMotivo; ?></textarea>
<center>
    <?php if ($datos['accion'] == 0) {
        echo '<button class="btnReporte" style="width:100px;height: 35px;" onClick="grabarMotivoEliminacion('.$datos["codProgramacion"].');">Eliminar</button>';
    }
    ?>
</center>