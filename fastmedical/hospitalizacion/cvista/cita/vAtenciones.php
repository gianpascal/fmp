<style type="text/css">
    #resultadoAtenciones tbody tr td{
        border-top: 1px solid black;      
    }
</style>
<?php
require_once 'ActionPersona.php';
$o_ActionPersona = new ActionPersona();
              $arrayParametros['funcion']='verAtencionesMedicas';
              $arrayParametros['alto']='300px';
              $arrayParametros['nroOrden']=true;
              $arrayParametros['codigo']=true;
              $arrayParametros['documento']=true;
              $arrayParametros['apellidoPaterno']=true;
              $arrayParametros['apellidoMaterno']=true;
              $arrayParametros['nombre']=true;
              $arrayParametros['bbuscar']=true;
              $arrayParametros['blimpiar']=true;
              $arrayParametros['bnuevo']=true;
              $arrayParametros['editar']=''; //editar: agrega el boton editar, otro valor no lo muestra

              //$arrayParametros['funcionNuevo']='setOrdenes';
             
?>


<div >
    <div style="width:350px; float:left ">
        <?php
             $o_ActionPersona->buscadorPersona($arrayParametros);
        ?>
        
    </div>
    <div style="width:580px; float: left">
        <div id="toolbar" style="width:95%; height: 100px; ">
            <div style="width: 100%; height: 20px;" >
                <div style=" width:100px;  color: gray;  float: left; font-family: Arial; font-weight: bold; font-size: 14px;  ">
                    CÓDIGO:
                </div>
                <div style=" float: left;width:10px;">
                    &nbsp;
                </div>
                <div id="divCodigo" style=" float: left; font-family: Arial; font-weight: bold; font-size: 14px;">
                    ...........
                </div>
                <div style=" float: left; width:30px; "  >
&nbsp;
                </div>
                <div style=" color: gray; float: left; font-family: Arial; font-weight: bold; font-size: 14px;" >
                    AFILIACIÓN
                </div>
                <div style=" float: left;width:10px;">
&nbsp;
                </div>
                <div id="divFiliacion" style=" float: left; font-family: Arial; font-weight: bold; font-size: 14px;">
                    .............
                </div>
            </div>
            <div style="width: 100%; height: 20px;" >
                <div style=" width:100px;  color: gray; float: left; font-family: Arial; font-weight: bold; font-size: 14px;  ">
                    NOMBRES:
                </div>
                <div style=" float: left;width:10px;">
                    &nbsp;
                </div>
                <div id="divNombre" style=" float: left; font-family: Arial; font-weight: bold; font-size: 14px;">
                    ...................................
                </div>
                
                
            </div>

            <div style="width: 100%; height: 20px;" >
                <div style=" width:100px;  color: gray; float: left; font-family: Arial; font-weight: bold; font-size: 14px;  ">
                    DOCUMENTO:
                </div>
                <div style=" float: left;width:10px;">
                    &nbsp;
                </div>
                <div id="divDocumento" style=" float: left; font-family: Arial; font-weight: bold; font-size: 14px;">
                    ....................
                </div>


            </div>

            <div style="width: 100%; height: 20px;" >
                <div style=" width:100px;  color: gray; float: left; font-family: Arial; font-weight: bold; font-size: 14px;  ">
                    FECHA NAC:
                </div>
                <div style=" float: left;width:10px;">
                    &nbsp;
                </div>
                <div id="divFechaNacimiento" style=" float: left; font-family: Arial; font-weight: bold; font-size: 14px;">
                    .....................
                </div>
                <div style=" float: left; width:30px; "  >
&nbsp;
                </div>
                
            </div>
            <div style="width: 100%; height: 20px;" >
                
                <div style="width:100px;  color: gray;  float: left; font-family: Arial; font-weight: bold; font-size: 14px;" >
                    EDAD:
                </div>
                <div style=" float: left;width:10px;">
&nbsp;
                </div>
                <div id="divEdad" style=" float: left; font-family: Arial; font-weight: bold; font-size: 14px;">
                    ....................
                </div>
            </div>

        </div>
        <div id="resultadoAtenciones" style="width: 98%; height: 300px; margin: 2px; " >
                    Resultados de actos Médicos...
        </div>

    </div>

</div>