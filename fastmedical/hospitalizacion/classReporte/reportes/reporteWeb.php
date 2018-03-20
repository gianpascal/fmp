<?php
//    require_once ("../../../hospitalizacion/cdatos/DRrhh.php");
require_once('../../clogica/LRrhh.php');
$oLRrhh = new LRrhh();
$arrayFilas = $oLRrhh->lListaPersonal();
?>

<html><head>
        <title>Index of /simedhweb/pruebas</title>
    </head>
    <body>
        <table border="1">
            <thead>
                <tr>
                    <?php
                    $bit = 0;
                    foreach ($arrayFilas[0] as $indice => $dato) {
                        if ($bit == 1) {
                            ?>
                            <th><?php echo ($indice);
                    $bit = 0; ?></th>

                            <?php
                        } else {
                            $bit = 1;
                        }
                    }
                    ?>



                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($arrayFilas as $key => $value) {
                    ?>
                    <tr>
                        <?php
                        $bit = 0;
                        foreach ($value as $indice => $dato) {
                            if ($bit == 1) {
                                ?>
                                <td><?php echo ($dato);
                                $bit = 0;
                                ?></td>
                                <?php
                            } else {
                                $bit = 1;
                            }
                        }
                        ?>



                    </tr>
                    <?php
                }
                ?>


            </tbody>
        </table>

    </body></html>