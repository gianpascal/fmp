<style>
    .btnSandy {
        border:1px solid red;
        background-color: green;
        color:white;
        height: 35px;
        text-align: center;
        font-family: verdana;
        font-size: 12px;
        font-weight: bold;
        width: 100px;
    }
    .btnSandy:hover {
        border:1px solid green;
        background-color: r;
        color:white;
        cursor: pointer
    }
</style>

<input id="codigoPrePRogramacion" type="hidden"  value="<?php echo $datos['codigoPreProgramacion']; ?>">
<input id="turno" type="hidden"  value="">
<input id="empleado" type="hidden"  value="">
<div style="width: 96%;border:0px solid;height: 96%;">
    <div id="contenedorProgramacionMantenimientoBorrado" style="width: 100%;border:1px solid;height: 70%;">
      

    </div>
  <br>
        <center><button class="btnSandy" onCLick="btnEliminarProgramacoinTurnoSelecionado();">Borrar</button></center>
</div>
