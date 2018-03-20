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

<input id="codigoPrePRogramacion" type="hidden"  value="<?php echo  $datos["codigoPreProgramacion"]; ?>">
<input id="empleado" type="hidden"  value="<?php echo  $datos["iCodigoEmpleado"]; ?>">
<input id="imes" type="hidden"  value="<?php echo  $datos["nomMes"]; ?>">
<input id="ianio" type="hidden"  value="<?php echo  $datos["anio"]; ?>">

<div style="width: 96%;border:0px solid;height: 96%;">
    <div id="contenedorProgramacionMantenimientoBorradoPreProgramacion" style="width: 100%;border:1px solid;height: 70%;">
      

    </div>
  <br>
        <center><button class="btnSandy" onCLick="btnEliminarProgramacoinPreProgramacionSelecionado();">Eliminar</button></center>
</div>
