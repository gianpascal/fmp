<h2 align="center"><?php echo ($filaExamen[1]); ?></h2>
<?php
$idPruebaAux='';
$numero=count($pruebasExamenes);
$i=0;

foreach ($pruebasExamenes as $fila){
    $i++;
    
    
    $idPrueba=$fila[1];
    $nombreCampo=$fila[4];
    $iiDCombo=$fila[8];
    if(!($idPrueba==$idPruebaAux)){

        $nombrePrueba=$fila[2];
        if($i!=1){
        ?>
            </fieldset>
        <?php
        }

        ?>
        <fieldset style=" margin:10px; width:100%; font-size: 16px;background-color: #FFFFFF;">
            <legend>&nbsp; <?php echo ($nombrePrueba); ?>&nbsp; </legend>

     <?php

    }
        ?>

                 <?php  
                    $iIdTipoDato=$fila[5];
                    switch ($iIdTipoDato) {
                    case 1: //integer
                        ?>
                        <div style=" margin:2px; padding: 2px; width: 270px; height:15px;float: left; ">
                              <div style=" float: left; width:150px;">
                            <?php echo utf8_encode($nombreCampo); ?>:
                            </div>
                             <div style=" float: left; width:100px;">
                                <?php echo $fila[9]; ?>
                             </div>
                        </div>
                        <?php
                        break;

                    case 2://varchar
                        
                        ?>
                        <div style=" border-radius: 4px; border: solid; border-width:0.5px;   margin:2px; padding: 2px; width: 100%; min-height:15px;float: left; ">
                            <div style=" float: left; width:30%;">
                            <?php echo utf8_encode($nombreCampo); ?>:
                            </div>
                            <div style=" float: left; width:70%;">
                                <?php echo utf8_encode($fila[10]); ?>
                            </div>
                        </div>
                        <?php

                        break;
                    case 3://datetime
                        ?>
                        <div style=" margin:2px; padding: 2px; width: 320px; min-height:15px;float: left; ">
                            <div style=" float: left; width:150px;">
                            <?php echo utf8_encode($nombreCampo); ?>:
                            </div>
                            <div style=" float: left; width:150px;"  >
                                <?php echo $fila[11]; ?>
                            </div>
                        </div>
                        <?php
                        break;
                    case 4: //decimal
                        ?>
                        <div style=" margin:2px; padding: 2px; width: 320px; min-height:15px;float: left; ">
                            <div style=" float: left; width:150px;">
                            <?php echo utf8_encode($nombreCampo); ?>:
                            </div>
                            <div style=" float: left; width:150px;">
                                <?php echo $fila[12]; ?>
                            </div>
                        </div>
                        <?php
                        break;
                    case 5://bolean
                        ?>
                        <div style=" margin:2px; padding: 2px; width: 320px; min-height:15px;float: left; ">
                            <div style=" float: left; width:150px;">
                            <?php echo utf8_encode($nombreCampo); ?>:
                            </div>
                            <div style=" float: left; width:50px;">
                                <?php if($fila[13]=='1'){
                                   echo 'si';
                                    }else{
                                        if($fila[13]=='0'){
                                            echo 'no';
                                        }else{
                                            echo 'null';
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <?php
                        break;
                    case 6:  //combo
                        $arrayCombo=$this->arrayComboExamenes($iiDCombo);
                        $iCombo=$fila[14];
                        $valorCombo=$this->valorComboExamen($iCombo);
                        //print_r($arrayCombo);
                        ?>
                        <div style=" margin:2px; padding: 2px; width: 320px; min-height:15px;float: left; ">
                            <div style=" float: left; width:150px;">
                            <?php echo utf8_encode($nombreCampo); ?>:
                            </div>
                            <div style=" float: left; width:150px;">

                                <?php echo $valorCombo; ?>

                            </div>
                        </div>
                        <?php

                        break;
                    case 7: //texto
                        ?>
                        <div style=" margin:2px; padding: 2px; width: auto; height:auto;float: left; ">
                            <div style=" float: left; width:150px;">
                            <?php echo utf8_encode($nombreCampo); ?>:
                            </div>
                            <div style=" float: left; width:auto;">
                                <fieldset style="text-align:left;" ><?php echo nl2br(utf8_encode($fila[15])); ?></fieldset>
                            </div>
                        </div>
                        <?php
                        break;
                    }
                 ?>
        <?php
    

    if($i==$numero){
        ?>
            </fieldset>
        <?php
    }

    $idPruebaAux=$fila[1];
 
}

?>
