<style>
    .p{
    font-size: 12px;
    font-family: verdana;
    font-weight: bold;
}

.button{
    font-size: 12px;
    font-family: verdana;
    height:35px;
    border:1px inset #006631;
    background-color: #006631;
    color:white;
}
.button:hover{
    height:35px;
    border:1px inset #C2E07C;
    background-color:#C2E07C;
    color:black;
}
.input{
    border:1px inset;
    height:35px;
    font-size: 18px;
    font-family: verdana;
    color:#576572;
}
.input:hover{
    color:black;
}
    </style>
<table border="0" style="width:100% ;height:100%;">
    <tr>
        <td height="35" align="center" colspan="2">
            <h1>Mantenimiento de CIE por Grupo Etareo</h1>
        </td>
    </tr>
    <tr>
        <td style="width: 50%;height: 340px;padding-left: 25px;">
            <p class="p">Listado Grupo Etareos:
            <div id="DivGrupoEtareo"style="width: 680px;height: 335px;border:1px solid">

                <?php
                require_once("../control/ActionMantenimientoGeneral.php");

                $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                echo $resultado = $o_ActionMantenimientoGeneral->listarGrupoEtareo();
                ?>

            </div>
        </td>
        <td style="width: 50%;height: 340px;padding-left: 25px;">
            <p class="p"> Buscar : <input class="input" type="text" id="busquedaCie" onkeyup="buscarCie(event)">
                <br><br>
                 <p class="p">Listado CIE:
            <div id="DivCIe" style="width: 480px;height: 280px;border:1px solid">
                <?php
                $o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
                echo $resultado = $o_ActionMantenimientoGeneral->listarCie();
                ?>

            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2"  style="width: 80%;height: 340px;padding-left: 25px;">
            <input type="text" id="nombreGrupoEtareo" style="border:inset;border-bottom: 1px; border-left:1px;border-top: 1px;border-right: 1px;width: 100%;font-weight:bold;">
            <div id="tablaCIeGRupoEtareo"style="width: 1190px;height: 280px;border:1px solid">
               

            </div>
        </td>
    </tr>
</table>
    <input type="hidden" id="idGrupoEtareo">