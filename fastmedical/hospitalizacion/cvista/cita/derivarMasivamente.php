<style type="text/css">
    #header td{
        background-color: #A2DF71;       
        font-weight: bold;
    }
    #tblPaciente{
        border: black solid 1px; 
        border-collapse: collapse;
        text-align: center;
    }
    #tblPaciente td{
        padding: 3px;
        margin: 0;
        border-bottom: black solid 1px;
    }
    #header td.borde{
        border-right: #ffffff solid 1px;
    }
</style>
<div align="center">
    <h4>Placas que van a ser derivadas</h4><br/>
    <table id="tblPaciente" >
        <tr id="header">
            <td class="borde">Código</td><td class="borde">Paciente</td><td class="borde">Placa</td><td>Examen</td>
        </tr>
        <tbody id="tbdPaciente"></tbody>

    </table>
</div>
<br/>
<div class="toolbar" style="height: 60px;width:600px; margin: 0 auto;  ">
    <div style="height: 20px;width:240px; margin: 0 auto; float: left" >
        <div style="height: 20px;width:80px; margin: 0 auto; float: left" >
            Ubicación
        </div>

        <div style="height: 20px;width:150px; margin: 0 auto; float: left">
            <select id='cboUbicacion' style="width: 120px;" >               
                <?php foreach ($arrayUbicaciones as $k => $value) { ?>
                    <option value="<?php echo $arrayUbicaciones[$k][0]; ?>"
                    <?php
                    if ($arrayUbicaciones[$k][0] == 1) {
                        echo " selected='selected' ";
                    }
                    ?> >
                                <?php echo utf8_encode($arrayUbicaciones[$k][1]); ?>
                    </option>
                <?php } ?>
            </select>
        </div>


    </div>
    <div style="height: 20px;width:250px; margin: 0 auto; float: left" >
        <div style="height: 20px;width:80px; margin: 0 auto; float: left" >
            Observación
        </div>
        <div style="height: 20px;width:170px; margin: 0 auto; float: left">
            <textarea  id="txaObservacionUbicacion" name="" rows="3" cols="30" style="width: 170px; height: 50px;" ></textarea>
        </div>
    </div>

    <div style="height: 20px;width:80px; margin: 0 auto; float: left" >
        <div id="" style=" float: left">
            <?php if ($_SESSION["permiso_formulario_servicio"][118]["grabarUbicacionImagenes_Citas"] == 1) { ?>
                <a href="javascript:grabarUbicacionPlacas();">
                    <img src="../../../../fastmedical_front/imagen/btn/b_grabar__on.gif"/>
                </a>
            <?php } ?>
        </div>

    </div>

</div>