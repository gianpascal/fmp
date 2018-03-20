<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php if ($datos["fila"] == 1) { ?>
            <div id="" style="width:auto; height:auto;margin:1px auto; border: #006600 solid">
                <div class="titleform">
                    <h1>REPORTE DE INGRESOS DIARIO POR NUMERO DE CAJERO</h1>
                </div>
                <div style="width: auto; height: 470px; overflow: auto;" align="center">
                    <table id="" width="300px;" cellspacing="1">
                        <thead class="jclmTbHtml" >
                            <tr>
                                <th style="font-size: medium; background-color:darkseagreen; border-color: #ccffff">Numero Caja</th>
                                <th style="font-size: medium; background-color:darkseagreen; border-color: #ccffff">Monto</th>
                                <th style="font-size: medium; background-color:darkseagreen; border-color: #ccffff">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultado as $i => $val) {
                                $class = ($i + 1) % 2 == 0 ? "jclmTbPar" : "jclmTbImpar"; ?>
                                <tr align="center" class="<?php echo $class; ?>">
                                    <td><?php echo $val[0] ?></td> 
                                    <td><?php echo $val[1] ?></td> 
                                    <td><?php echo substr($val[2], 0, 4) . ' / ' . substr($val[2], 4, 2) . ' / ' . substr($val[2], 6, 2) ?></td> 
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>  
        <?php } ?>

        <?php if ($datos["fila"] == 2) { ?>
        holaaa
            <div id="" style="width:auto; height:auto;margin:1px auto; border: #006600 solid">
                <div class="titleform">
                    <h1>REPORTE DE INGRESOS DIARIO POR NUMERO DE CAJERO</h1>
                </div>
                <div style="width: auto; height: 470px; overflow: auto;" align="center">
                    <table id="" width="auto" cellspacing="1">
                        <thead class="jclmTbHtml" >
                            <tr>
                                <th style="font-size: medium; background-color:darkseagreen; border-color: #ccffff">Codigo Persona</th>
                                <th style="font-size: medium; background-color:darkseagreen; border-color: #ccffff">Nombre Completo</th>
                                <th style="font-size: medium; background-color:darkseagreen; border-color: #ccffff">Monto </th>
                                <th style="font-size: medium; background-color:darkseagreen; border-color: #ccffff"> Año y Mes </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resu as $i => $valx) {
                                $class = ($i + 1) % 2 == 0 ? "jclmTbPar" : "jclmTbImpar"; ?>
                                <tr align="center" class="<?php echo $class; ?>">
                                    <td><?php echo $valx[0] ?></td> 
                                    <td align="LEFT"><?php echo htmlentities($valx[1]).' '.htmlentities($valx[2]).' '.htmlentities($valx[3]) ?></td> 
                                    <td><?php echo $valx[4]?></td> 
                                    <td><?php echo $valx[5]?></td> 
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>  
        <?php } ?>
    </body>
</html>   