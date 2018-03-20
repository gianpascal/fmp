<div style="width: 100%;border:3px;border-color: #000000;margin-top:0px;margin-bottom:0px;margin-left: 0px;margin-right: 0px;min-height:680px;padding:0px;">
    <div class="titleform" style="width:100%;">
        <h1>REGULARIZACION HORARIO</h1>
    </div>
    <div id="contenido_main" style="width:100%;height:650px;margin:0px; padding:2px; overflow: hidden; z-index:1; position:absolute;">
        <table border="0" style="width:97%;margin: 0px;padding: 0px">
            <tr>
                <td valign="top" style="width:40%">
                    <div style="width:100%;height: 360px;background-color: #F9F9f9;" align="left">
                        <?php 
                            require_once("../../ccontrol/control/ActionPersona.php");
                            $o_ActionPersona  = new ActionPersona();
                              $arrayParametros['funcion']="ReportePersonaRegularizar";
                              $arrayParametros['alto']='200px';
                              $arrayParametros['nroOrden']=false;
                              $arrayParametros['codigo']=true;
                              $arrayParametros['documento']=true;
                              $arrayParametros['apellidoPaterno']=true;
                              $arrayParametros['apellidoMaterno']=true;
                              $arrayParametros['nombre']=true;
                              if($_SESSION["permiso_formulario_servicio"][110]["BUSCAR_PAC"]==1)
                                $arrayParametros['bbuscar']=true;
                              else
                                $arrayParametros['bbuscar']=false;
                              if($_SESSION["permiso_formulario_servicio"][110]["BUSCAR_PAC"]==1)
                                $arrayParametros['blimpiar']=true;
                              else
                                $arrayParametros['blimpiar']=false;
                              $arrayParametros['bnuevo']=false;
                              $arrayParametros['editar']=''; //editar: agrega el boton editar, otro valor no lo muestra

                            $obtenerPersonas     = $o_ActionPersona->buscadorPersona($arrayParametros);
                        ?>
                    </div>
                </td>
                <td  style="width:auto">
                 <div id="" style="width:58%;height:320px;border:0px"  align="left">
                        <?php
                        require_once("../../cvista/rrhh/EmpleadoNoRegularizado.php");
                        ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>