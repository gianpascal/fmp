<?php
//$ubigeo = '150117';
//$pais='9589';
//$cb_combo = $this->listaDatosComboUbigeo($pais,substr($ubigeo, 0, 2), substr($ubigeo, 2, 2), substr($ubigeo, 4, 2), "disabled");
//$toolbar = new ToollBar("right");
//$toolbar->SetBoton("Adscripcion Departamental", "Ads.Depart.", "btn", "onclick,onkeypress", "habilitaradscripciondepartamental()", "../../../../fastmedical_front/imagen/icono/apply.png", "", "", true);
?>

<fieldset>


    <div id='fila1' style="height:30px; width:400px;">

        <div id='cell11' style="float:left; width:100px;  " >
            Número Doc:
        </div>
        <div id='cell12' style="float:left; width:100px;">
            <?php echo $parametros['p2'] ?>
        </div>
        <div id='cell11' style="float:left; width:100px;  " >
            Código:
        </div>
        <div id='cell12' style="float:left; width:100px;">
            <?php echo $parametros['p3'] ?>
        </div>

    </div>
    <div id='fila1' style="height:30px; width:400px;">

        <div id='cell11' style="float:left; width:100px;  " >
            A. Paterno:
        </div>
        <div id='cell12' style="float:left; width:100px;">
            <?php echo $parametros['p4'] ?>
        </div>
        <div id='cell11' style="float:left; width:100px;  " >
            A. Materno:
        </div>
        <div id='cell12' style="float:left; width:100px;">
            <?php echo $parametros['p5'] ?>
        </div>

    </div>
    <div id='fila1' style="height:30px; width:400px;">

        <div id='cell11' style="float:left; width:100px;  " >
            P.Nombre:
        </div>
        <div id='cell12' style="float:left; width:100px;">
            <?php echo $parametros['p6'] ?>
        </div>
        <div id='cell11' style="float:left; width:100px;  " >
            S.Nombre:
        </div>
        <div id='cell12' style="float:left; width:100px;">
            <?php echo $parametros['p7'] ?>
        </div>

    </div>
    <div id='fila1' style="height:30px; width:400px;">

        <div id='cell11' style="float:left; width:100px;  " >
            Ubigeo:
        </div>
        <div id='cell12' style="float:left; width:100px;">
            <?php echo $parametros['p9'] ?>
        </div>

    </div>
    <div id='fila1' style="height:30px; width:400px;">

        <div id='cell11' style="float:left; width:100px;  " >
            Desde:
        </div>
        <div id='cell12' style="float:left; width:100px;">
            <?php echo $parametros['p10'] ?>
        </div>
        <div id='cell11' style="float:left; width:100px;  " >
            Hasta:
        </div>
        <div id='cell12' style="float:left; width:100px;">
            <?php echo $parametros['p11'] ?>
        </div>

    </div>
    <div id='fila1' style="height:30px; width:400px;">

        <div id='cell11' style="float:left; width:100px;  " >
            Tipo doc.:
        </div>
        <div id='cell12' style="float:left; width:100px;">
            <?php echo $parametros['p12'] ?>
        </div>
        <div id='cell11' style="float:left; width:100px;  " >
            Estado:
        </div>
        <div id='cell12' style="float:left; width:100px;">
            <?php echo $parametros['p13'] ?>
        </div>

    </div>
    <div id='fila1' style="height:30px; width:400px;">

        <div id='cell11' style="float:left; width:100px;  " >
            Sexo:
        </div>
        <div id='cell12' style="float:left; width:100px;">
            <?php echo $parametros['p14'] ?>
        </div>
        <div id='cell11' style="float:left; width:100px;  " >
            Fecha Nac:
        </div>
        <div id='cell12' style="float:left; width:100px;">
            <?php echo $parametros['p15'] ?>
        </div>

    </div>
    <div id='fila1' style="height:30px; width:400px;">

        <div id='cell11' style="float:left; width:100px;  " >
            TipSeguroGH:
        </div>
        <div id='cell12' style="float:left; width:100px;">
            <?php echo $parametros['p16'] ?>
        </div>
        <div id='cell11' style="float:left; width:100px;  " >
            PlanPotes:
        </div>
        <div id='cell12' style="float:left; width:100px;">
            <?php echo $parametros['p17'] ?>
        </div>

    </div>
    <div id='fila1' style="height:30px; width:400px;">

        <div id='cell11' style="float:left; width:100px;  " >
            CasAdscripcion:
        </div>
        <div id='cell12' style="float:left; width:100px;">
            <?php echo $parametros['p18'] ?>
        </div>
        <div id='cell11' style="float:left; width:100px;  " >
            MsgError:
        </div>
        <div id='cell12' style="float:left; width:100px;">
            <?php echo $parametros['p19'] ?>
        </div>

    </div>
    <div id='fila1' style="height:30px; width:400px;">

        <div id='cell11' style="float:left; width:100px;  " >
            Autogenerado:
        </div>
        <div id='cell12' style="float:left; width:150px;">
            <?php echo $parametros['p8'] ?>
        </div>


    </div>
     <div id='fila1' style="height:30px; width:400px;">

        <div id='cell11' style="float:left; width:100px;  " >
            FlagPotes:
        </div>
        <div id='cell12' style="float:left; width:100px;">
            <?php echo $parametros['p20'] ?>
        </div>
        <div id='cell11' style="float:left; width:100px;  " >
            FlagEps:
        </div>
        <div id='cell12' style="float:left; width:100px;">
            <?php echo $parametros['p21'] ?>
        </div>

    </div>

</fieldset>

