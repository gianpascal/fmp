
<fieldset  style="margin:auto;width:auto;height:auto; "> 
    <!--    <legend align="center">&nbsp;<h1> BUSQUEDA DE PACIENTE</h1> &nbsp;</legend>-->
    <div class="titleform" style="width:100%;">
        <h1> BUSQUEDA DE PACIENTE</h1> 
    </div>
    <fieldset style="margin:auto;width:60%;height:auto; ">
        <!--        <div id="divServiciosEmergencia">

                </div>-->


        <table id="" width="750px;" cellspacing="1" border="1" >
            <tr>
                <td style="font-weight:bold;" align="right">
                    Apellido Paterno Paciente:
                </td>
                <td>
                    <input type="text" id="txtApePaternoPaciente" name="txtApePaternoPaciente"/>
                </td>
            </tr>
            <tr> 
                <td style="font-weight:bold;" align="right">
                    Apellidos Materno Paciente:
                </td>
                <td>
                    <input type="text" id="txtApeMaternoPaciente"  name="txtApeMaternoPaciente" onkeypress="BusquedaPacienteTeclado('13',this,event);"/>
                </td>
            </tr>
            <tr>
                <td style="font-weight:bold;" align="right">
                    Nombre Paciente:   
                </td>
                <td>
                    <input type="text" id="txtNombrePaciente" name="txtNombrePaciente" />
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <a href="javascript:busquedaPaciente();">
                        <img border="0" title="Buscar" alt="" src="../../../../medifacil_front/imagen/btn/b_buscar_on.gif"/></a>
                </td>

            </tr>  

        </table>
        <fieldset style="margin:10px;width:auto;height:400px; " align="center">
            <div id="divTablaAreaPersona" style="width: 850px; height: 350px;" align="center">
            </div>
            <div align="center">
                <a href="javascript:Cerrar();">
                    <img border="0" title="Salir" alt="" src="../../../../medifacil_front/imagen/btn/b_Salir.gif"/></a>
            </div>
        </fieldset>

    </fieldset>

</fieldset > 
<?php
//                                        $toolbar3 = new ToollBar("left");
//                                        $toolbar3->SetBoton("ELIMINAR", "SALIR", "btn", "onclick,onkeypress", "SalirReportePaciente()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/salir.gif");
//                                        $toolbar3->Mostrar();
?>