<div id="nuevo_refresca">
    <?php
    $toolbar1 = new ToollBar("center");
    $datos["p2"] = $datos["codigoProgramacion"];
//echo 'peche';
    $arrayPaquetes = $this->aObtenerPaquetesPersona($datosPersona['codpersona']);
//print_r($arrayPaquetes);
    $numeroPaquetes = count($arrayPaquetes);
    ?>
    <?php if ($datos["valor"] != 1) { ?>
        <div id="Div_Paquetes" style="width:100%;float: left;border-style: solid;border-width: 1px">
            <div id="Div_PaquetesEncabezado" class="titleform" style="cursor: pointer;" onclick="javascript:abrirDiv('Div_PaquetesCuerpo');">
                <table style="height: auto;width: 100%" class="accordion_title">
                    <tr align="center">
                        <td >
                            <h1>Paquetes Incompletos</h1>
                        </td>
                        <td style="width:3%">
                            <img id="Div_PaquetesCuerpoicono" src='../../../../medifacil_front/imagen/icono/desplegar.png' title='desplegar' alt=""/>
                        </td>
                    </tr>
                </table>
            </div>
        <?php } ?>    
        <div id="Div_PaquetesCuerpo" style="width:100%;border-style: solid;border-width: 1px">

            <?php
            foreach ($arrayPaquetes as $key => $value) {
                ?>
                <table border="1"> 
                    <tr>
                        <td align="center">
                            <h3>
                                <?php echo utf8_encode($value['vDescripcion']) ?>
                            </h3>
                            <input type="hidden" id="NombreGrupoEtareo<?php echo $key ?>" value="<?php echo utf8_encode($value['vDescripcion']) ?>"    />
                        </td>
                    </tr>
                    <tr>
                        <td style="width:50px; height: 250px ;border-style: solid;border-width: 1px">
                            <div id="Div_PaquetesCuerpo_<?php echo $key ?>"  style="width:920px;height: 250px  ;background-color:white">
                            </div>
                        </td>
                    </tr>

                </table>  
                <script>
                    var codigopaciente=$("htxtcodigopaciente").value;
                    var iIdGrupoEtarioPersonas=<?php echo $value['iIdGrupoEtarioPersonas'] ?>;
                    var iIdGrupoEtareo=<?php echo $value['iIdGrupoEtareo'] ?>;
                    var servicio =  $("htxtcodigoservicio").value;
                    var codigoProgramacion =  $("hcodigoProgramacion").value;
                    var patronModulo='cargarTablaPAquete';
                    var parametros='';
                    parametros+='p1='+patronModulo;
                    parametros+='&p2='+codigopaciente ;
                    parametros+='&p3='+servicio;
                    parametros+='&p4='+codigoProgramacion;
                    parametros+='&p5='+iIdGrupoEtarioPersonas;
                    parametros+='&p6='+iIdGrupoEtareo;


                    tablaTablaPAquete_<?php echo $key; ?>=new dhtmlXGridObject('Div_PaquetesCuerpo_<?php echo $key; ?>');
                    tablaTablaPAquete_<?php echo $key; ?>.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
                    tablaTablaPAquete_<?php echo $key; ?>.setSkin("dhx_skyblue");
                    tablaTablaPAquete_<?php echo $key; ?>.enableRowsHover(true,'grid_hover');

                    tablaTablaPAquete_<?php echo $key; ?>.attachEvent("onRowSelect", function(fila,columna){
                        //reporteDePuntoControlXExamen(fila,columna);    
                        //        probar(fila,columna);
                        //        verFotosPaciente()
                    });  
                    //////////para cargador peche////////////////

                    contadorCargador++;
                    var idCargador=contadorCargador;
                    tablaTablaPAquete_<?php echo $key; ?>.attachEvent("onXLS", function(){
                        cargadorpeche(1,idCargador);
                    });
                    tablaTablaPAquete_<?php echo $key; ?>.attachEvent("onXLE", function(){
                        cargadorpeche(0,idCargador);
                                
                    });
                    /////////////fin cargador ///////////////////////
                    tablaTablaPAquete_<?php echo $key; ?>.setSkin("dhx_skyblue");
                    tablaTablaPAquete_<?php echo $key; ?>.init();
                    //    tablaBuscarPersona.loadXML(pathRequestControl+'?'+parametros);
                       
                    tablaTablaPAquete_<?php echo $key; ?>.loadXML(pathRequestControl+'?'+parametros, function(){   
                          
                        //        CargarNombreGrupoEtario(tablaTablaPAquete)
                        for(var i=0;i<tablaTablaPAquete_<?php echo $key; ?>.getRowsNum();i++){
                        
                            var nroAte =tablaTablaPAquete_<?php echo $key; ?>.cells(i,6).getValue();
                            var cantidad =tablaTablaPAquete_<?php echo $key; ?>.cells(i,3).getValue();
                            var nroAtemin=tablaTablaPAquete_<?php echo $key; ?>.cells(i,10).getValue();
                            var icolor=tablaTablaPAquete_<?php echo $key; ?>.cells(i,14).getValue(); 
                            if(cantidad > 1){  
                                if(nroAte > nroAtemin){
                                    tablaTablaPAquete_<?php echo $key; ?>.setRowTextStyle(tablaTablaPAquete_<?php echo $key; ?>.getRowId(i) ,'background-color:#FF0000;color:black;border-top: 1px solid #FF0000;');       
                                }
                                if(nroAte == nroAtemin){
                                    tablaTablaPAquete_<?php echo $key; ?>.setRowTextStyle(tablaTablaPAquete_<?php echo $key; ?>.getRowId(i) ,'background-color:#CCE2FE;color:black;border-top: 1px solid #CCE2FE;');       
                                }
                            }
                             if(cantidad == 1){  
                                if(nroAte > nroAtemin){
                                    tablaTablaPAquete_<?php echo $key; ?>.setRowTextStyle(tablaTablaPAquete_<?php echo $key; ?>.getRowId(i) ,'background-color:#FF0000;color:black;border-top: 1px solid #FF0000;');       
                                }

                            }
                            if(icolor==1){
                                tablaTablaPAquete_<?php echo $key; ?>.setRowTextStyle(tablaTablaPAquete_<?php echo $key; ?>.getRowId(i) ,'background-color:#FF0000;color:black;border-top: 1px solid #FF0000;');                                     
                            }
                        }
                    });
                    //    alert(1.5);
                    tablaTablaPAquete_<?php echo $key; ?>.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

                    });
                    // cargarTablaPAquete($("htxtcodigopaciente").value,$("key<?php echo $key ?>").value,$("iIdGrupoEtarioPersonas<?php echo $key ?>").value,$("iIdGrupoEtareo<?php echo $key ?>").value);
                </script>
                <?php
            }
            ?>
            <a onclick="javascript:GeneralServicos(<?php echo $numeroPaquetes ?>,<?php echo $value['iIdGrupoEtarioPersonas'] ?>);" href="javascript:;">
                <img id="btn_agregarotro" title="Generar"alt="" src="../../../../medifacil_front/imagen/btn/btn_GenerarOrdenes.png">
            </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a onclick="javascript:ActualizarServicios(<?php echo $numeroPaquetes ?>,<?php echo $value['iIdGrupoEtarioPersonas'].",'".$datosPersona['codpersona']."'" ?>);" href="javascript:;">
                <img id="btn_agregarotro" title="Actualizar" style="width: 50px;" alt="" src="../../../../medifacil_front/imagen/btn/btn_actualizar.jpg">
            </a>
        </div>



    </div>
</div>