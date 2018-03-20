<div>
    	<table>
  <tr>
    <td><div align="right">C&oacute;digo:</div></td>
    <td >
    <?php
              echo $codigo;
    ?>
    </td>
  </tr>
  <tr>
    <td>Apellidos y Nombres:</td>
    <td colspan="3">
	<?php
              echo $nombre;
    ?>
    </td>
    </tr>
  <tr>
    <td><div align="right">CentroCostos:</div></td>
    <td >
        <?php
              echo $ccostos;
    ?>
    </td>
    <td>Cargo:</td>
    <td>
      <div align="left">
        <?php
              echo $cargo;
    ?>
        </div></td>
  </tr>
</table>

	</div>
 <div id="resultadoPersonal" style="width:700px; height:400px; background-color:#66CCFF; float:left">
  <?php
              echo $o_Html->getTabla();
   ?>


 </div>
