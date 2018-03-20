
<?php
$toolbar01 = new ToollBar("right");
$toolbar02 = new ToollBar("right");
$toolbar03 = new ToollBar("right");
$toolbar04 = new ToollBar("right");
$toolbar05 = new ToollBar("right");
$toolbar06 = new ToollBar("right");

$IdExamenLaboratorio = $datos["IdExamenLaboratorio"] ;
$NombreExamenLaboratorio = $datos["NombreExamenLaboratorio"];



?>

<fieldset style="margin:1px;width:95%;height:auto;padding: 0px; font-size:14px;">
    <legend>&nbsp; Detalle del Examen Laboratorio &nbsp;</legend>

    <table width="100%" border="0">

        <tr>
            <td align="left">Id Examen </td>
            <td><input type="text" name="txtIdExamen" id="txtIdExamen" value="<?php echo $IdExamenLaboratorio ?>" class="texto_combo" size="10" readonly/></td>
        </tr>

        <tr>
            <td align="left">Nombre Examen </td>
            <td><input type="text" name="txtNombreExamen" id="txtNombreExamen" value="<?php echo $NombreExamenLaboratorio ?>" class="texto_combo" size="80" readonly tabindex="1"/></td>
        </tr>
        <tr>
            <td align="left">Tipo Examen </td>
            <td><input type="text" name="cboTipoExamen" id="cboTipoExamen" value="<?php echo $area ?>" class="texto_combo" size="40" readonly tabindex="1"/></td>
        </tr>
        <tr>
            <td><input type="hidden" name="NombreCoordinadorOculto" id="NombreCoordinadorOculto" value="<?php echo $NombreCoordinador ?>" class="texto_combo" size="40"  tabindex="1" readonly/></td>
            <td><input type="hidden" name="hidSedeempresaArea" id="hidSedeempresaArea" value="<?php echo $idSedeempresaArea ?>" class="texto_combo" size="40"  tabindex="1" readonly/></td> </td>
            <td><input type="hidden" name="hiIdEncargadoProgramacionPersonal" id="hiIdEncargadoProgramacionPersonal" value="<?php echo $iIdEncargadoProgramacionPersonal ?>" class="texto_combo" size="40"  tabindex="1" readonly/></td> </td>
        </tr> 
            <tr>
                <td>Estado : </td>

                <td>
                    <input type="checkbox" name="chkEstado" id="chkEstado" onclick="if(this.checked){this.value=1}else{this.value=0;}" value="1" CHECKED/>

                </td>

            </tr>


    </table>

</fieldset>

<table width="100%" border="0">
<!--    <tr>

        <td height="30" width="24%">Coordinador :</td>
        <td width="30%">


            <input id="txtNombres" name="txtNombres" value="<?php echo $NombreCoordinador ?>" size="40" readonly/>

        </td>

       
       

    </tr>-->






</table>
<center>


    <?php
   

        echo '
            <table  width="80%" border="0" align="center">
           
            <tr>


                    <td align="center" width= "50%" height="30" >
                        <div style=" display: none" id="activardiv" > ';


      

        $toolbar03->SetBoton("ActualizarDetalleExamenLaboratorio", "Actualizar", "btn", "onclick,onkeypress", "asignandoNuevoCoordinadorAlArea()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/agt_action_success.png", "", "", 1);
        $toolbar03->Mostrar();
        echo '

                        </div>

                        <div style="" id="modificardiv">';



     
        $toolbar04->SetBoton("DetalleExamenLaboratorio", "Editar", "btn", "onclick,onkeypress", " DetalleExamenLaboratorio()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/agt_action_success.png", "", "", 1);
        $toolbar04->Mostrar();



        echo '</div>
                    
                    </td>';
   
    ?>






    <?php





    echo '<td align="center" width= "50%" height="30">';
    
    
    

        $toolbar06->SetBoton("salirPopupEditarMantenimientoExamen", "Salir", "btn", "onclick,onkeypress", " salirPopupEditarMantenimientoExamen()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/agt_action_success.png", "", "", 1);
        $toolbar06->Mostrar();
   


    echo '</td>




            </tr>
    
            </table>
            
            ';



    ?>



    <tr>
        <td colspan="4" align="center">
            <div id="divResulEncargado" ></div>
            <div id="divMsmResultadoEncargado" style="width: 400px;"></div>
        </td>
    </tr>



</center>
<br/>



<p>&nbsp;</p>




