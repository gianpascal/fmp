<?php

include_once("../../cdatos/DMantenimientoGeneral.php");

class LMantenimientoGeneral {

    private $dMantenimientoGeneral;

    public function __construct() {
        $this->dMantenimientoGeneral = new DMantenimientoGeneral();
    }

    public function getListarAlmacenes() {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantenimientoGeneral->getListarAlmacenes();
        foreach ($resultado as $key => $value) {
            array_push($resultado[$key], "../../../../medifacil_front/imagen/icono/editar.png ^ Editar");
        }
        return $resultado;
    }

    public function getListaAmbientesLogicos($datos) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral($o_DMantenimientoGeneral);
        $resultado = $o_DMantenimientoGeneral->getArrayAmbientesLogicos($datos);
        $resultadoArray = array();
        foreach ($resultado as $fila) {
            if ($_SESSION["permiso_formulario_servicio"][201]["EDITAR_AMB_LOGICO"] == 1)
                $fila[4] = "<a href='#' onclick=\"irEditarAmbienteLogico('" . $fila[0] . "');\"><img src='../../../../medifacil_front/imagen/icono/editar.png' title='Editar cita'/></a>";
            else
                $fila[4] = "";

            if ($fila[3] == '1') {
                if ($_SESSION["permiso_formulario_servicio"][201]["INACTIVAR_AMB_LOGICO"] == 1) {
                    $fila[5] = "<a href='#' onclick=\"irActivaryDesactivarAmbienteLogico('" . $fila[0] . "','" . $fila[3] . "');\"><img src='../../../../medifacil_front/imagen/icono/agt_action_success.png' title='Desactivar'/></a>";
                } else {
                    $fila[5] = "<img src='../../../../medifacil_front/imagen/icono/agt_action_success.png' title='Desactivar'/>";
                }
            } else {
                if ($_SESSION["permiso_formulario_servicio"][201]["ACTIVAR_AMB_LOGICO"] == 1) {
                    $fila[5] = "<a href='#' onclick=\"irActivaryDesactivarAmbienteLogico('" . $fila[0] . "','" . $fila[3] . "');\"><img src='../../../../medifacil_front/imagen/icono/agt_action_fail.png' title='Activar'/></a>";
                } else {
                    $fila[5] = "<img src='../../../../medifacil_front/imagen/icono/agt_action_fail.png' title='Activar'/>";
                }
            }
            //if($_SESSION["permiso_formulario_servicio"][201]["ACTIVAR_AMB_LOGICO"]==1)
            $fila[6] = "<a href='#' onclick=\"irAsignarAmbienteFisico('" . $fila[0] . "','" . $fila[2] . "');\"><img src='../../../../medifacil_front/imagen/icono/gohome.png' title='Ambiente Fisico'/></a>";
            //else
            //    $fila[6]="";
            array_push($resultadoArray, $fila);
        }
        return $resultadoArray;
    }

    function getArrayListaActividades() {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $rs = $o_DMantenimientoGeneral->spListaActividades();
        $resultadoArray = array();

        foreach ($rs as $fila) {
            $resultadoArray[$fila[0]] = htmlentities(trim($fila[1]));
        }
        return $resultadoArray;
    }

    /*     * **********************************************MANTENIMIENTO TURNOS************************************* */

    //Dibuja tabla de turnos
    public function listaTurno($descTurno) {
        $rs = $this->dMantenimientoGeneral->listaTurno($descTurno);
        $resultadoArray = array();

        foreach ($rs as $fila) {
            $datos = base64_encode($fila[0] . "|" . $fila[1] . "|" . $fila[2] . "|" . $fila[3] . "|" . $fila[4] . "|" . $fila[5] . "|" . $fila[6]);
            $opciones = "";

            if ($_SESSION["permiso_formulario_servicio"][206]["ELIMINAR_TURNO"] == 1) {
                $opciones.="<a href='#' onclick=\"eliminarTurno('eliminar','$fila[0]');\"><img src='../../../../medifacil_front/imagen/icono/op_rechazado.gif' alt='Eliminar' title='Eliminar' border='0'/></a>&nbsp;&nbsp;&nbsp;&nbsp;";
            }
            if ($_SESSION["permiso_formulario_servicio"][206]["EDITAR_TURNO"] == 1) {
                $opciones.="<a href='#' onclick=\"CargarVentana('popupMantTurno','Registro de TurnosEditar','../mantenimientogeneral/manteTurno.php?" .
                        "datos=$datos&accion=actualizar','400','300',false,true,'',1,'',10,10,10,10);\">" .
                        "<img src='../../../../medifacil_front/imagen/icono/editar.png' alt='Editar' title='Editar' border='0'/></a>";
            }

            $fila["opciones"] = $opciones;

            array_push($resultadoArray, $fila);
        }
        return $resultadoArray;
    }

    public function listaTurnoL($descTurno) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantenimientoGeneral->listaTurno($descTurno);
        foreach ($resultado as $key => $value) {
            if ($_SESSION["permiso_formulario_servicio"][206]["ELIMINAR_TURNO"] == 1) {
                array_push($resultado[$key], "../../../../medifacil_front/imagen/icono/op_rechazado.gif ^ Eliminar");
            } else {
                array_push($resultado[$key], "");
            }
            if ($_SESSION["permiso_formulario_servicio"][206]["EDITAR_TURNO"] == 1) {
                array_push($resultado[$key], "../../../../medifacil_front/imagen/icono/editar.png' ^ Editar");
            } else {
                array_push($resultado[$key], "");
            }
        }
        return $resultado;
    }

    public function cargarTablaIPs() {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantenimientoGeneral->cargarTablaIPs();
        foreach ($resultado as $key => $value) {
            array_push($resultado[$key], "../../../../medifacil_front/imagen/icono/edit2.png ^ Editar");

            array_push($resultado[$key], "../../../../medifacil_front/imagen/icono/cancel.png' ^ Eliminar");
        }
        return $resultado;
    }
     public function cargarTablaAmbientes() {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantenimientoGeneral->cargarTablaAmbientes();
        foreach ($resultado as $key => $value) {
            array_push($resultado[$key], "../../../../medifacil_front/imagen/icono/clean.png ^ Agregar");
        }
        return $resultado;
    }
    
    
    

    //modd $nomenclatura
    public function spManteTurno($accion, $codTurno, $descTurno, $horaInicioTurno, $horaFinalTurno, $totalHorasTurno, $tipoHorarioTurno, $nomenclatura) {
        $rs = $this->dMantenimientoGeneral->spManteTurno($accion, $codTurno, $descTurno, $horaInicioTurno, $horaFinalTurno, $totalHorasTurno, $tipoHorarioTurno, $nomenclatura);
        return $rs;
    }

    public function spEliminarTurno($codTurno) {
        //$o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $rs = $this->dMantenimientoGeneral->spEliminarTurno($codTurno);
        //print '00001';
        //$rs=$o_DMantenimientoGeneral->spEliminarTurno($codTurno);
        //print '000002';
        //print_r($rs);
        return $rs;
    }

    /*     * ***************************************MANTENIMIENTO AMBIENTES FISICOS************************************** */

    //Datos de combo empresas
    public function getArrayListaEmpresas($nomEmpresa) {
        $rs = $this->dMantenimientoGeneral->spListaEmpresas($nomEmpresa);
        $resultadoArray = array();

        foreach ($rs as $fila) {
            $resultadoArray[$fila[0]] = htmlentities(trim($fila[1]));
        }
        return $resultadoArray;
    }

    //Datos de combo sedes
    public function getArrayListaSedes($codEmpresa, $nomSede) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $rs = $o_DMantenimientoGeneral->spListaSedes($codEmpresa, $nomSede);
        $resultadoArray = array();

        foreach ($rs as $fila) {
            $resultadoArray[$fila[0]] = htmlentities(trim($fila[14])); //Descripcion de la sede
        }
        return $resultadoArray;
    }

    public function getArrayListaAmbientesFisicos($idSedeEmpresa, $nomAmbienteFisico) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $rs = $o_DMantenimientoGeneral->spListaAmbientesFisicos($idSedeEmpresa, $nomAmbienteFisico);
        $resultadoArray = array();

        foreach ($rs as $fila) {
            $resultadoArray[$fila[0]] = htmlentities(trim($fila[2])); //Nombre del ambiente fisico
        }
        return $resultadoArray;
    }

    //Dibuja tabla de ambientes fisicos
    public function listaAmbientesFisicos($idSedeEmpresa, $nomAmbienteFisico) {
        $rs = $this->dMantenimientoGeneral->spListaAmbientesFisicos($idSedeEmpresa, $nomAmbienteFisico);
        $resultadoArray = array();

        foreach ($rs as $fila) {
            $fila["vNombreAmbienteFisico"] = htmlentities($fila[2]);
            $fila["vDescAmbienteFisico"] = htmlentities($fila[3]);


            /* if($fila["bActivo"]==1)
              $fila["chk_activo"] = "<input type='checkbox' checked disabled>";
              else
              $fila["chk_activo"] = "<input type='checkbox' disabled>"; */
            $datos = base64_encode($fila[0] . "|" . $fila[1] . "|" . ($fila[2]) . "|" . ($fila[3]) . "|" . $fila[4] . "|" . $fila[5] . "|" . $fila[6] . "|" . $fila[7] . "|" . $fila[8] . "|" . $fila[9] . "|" . $fila[10]);
            $opciones = "";
            if ($_SESSION["permiso_formulario_servicio"][202]["ELIMINAR_AMB_FISICO"] == 1) {
                $opciones .= "<a href='#' onclick=\"eliminarAmbienteFisico('eliminar',$fila[0]);\"><img src='../../../../medifacil_front/imagen/icono/op_rechazado.gif' alt='Eliminar' title='Eliminar' border='0'/></a>&nbsp;&nbsp;&nbsp;&nbsp;";
            }
            if ($_SESSION["permiso_formulario_servicio"][202]["EDITAR_AMB_FISICO"] == 1) {
                $opciones .= "<a href='#' onclick=\"CargarVentana('popupMantAmbFisico','Registro de Ambientes Físicos','../mantenimientogeneral/manteAmbienteFisico.php?" .
                        "datos=$datos&accion=actualizar','500','320',false,true,'',1,'',10,10,10,10);\">" .
                        "<img src='../../../../medifacil_front/imagen/icono/editar.png' alt='Editar' title='Editar' border='0'/></a>&nbsp;&nbsp;&nbsp;&nbsp;";
            }
            if ($_SESSION["permiso_formulario_servicio"][202]["AGREGAR_SERVICIO_X_AMB_FISICO"] == 1) {
                $opciones .= "<a href='#' onclick=\"mostrarAmbFisicoxServBasico($fila[0],'$fila[vNombreAmbienteFisico]');\"><img src='../../../../medifacil_front/imagen/icono/exec.gif' alt='Servicios' title='Servicios' border='0'/></a>&nbsp;&nbsp;&nbsp;&nbsp;";
            }

            //if($_SESSION["permiso_formulario_servicio"][202]["AGREGAR_SERVICIO_X_AMB_FISICO"]==1){
            $opciones .= "<a href='#' onclick=\"mostrarMantCamaxAmbFisico($fila[0],'$fila[vNombreAmbienteFisico]');\"><img src='../../../../medifacil_front/imagen/icono/cama.jpg' alt='Camas' title='Camas' border='0'/></a>";
            //}
            $fila["opciones"] = $opciones;
            array_push($resultadoArray, $fila);
        }
        return $resultadoArray;
    }

    //Dibuja tabla de servicios básicos de un ambiente físico
    public function listaAmbFisicoxServBasico($codAmbienteFisico, $nomServicioBasico) {
        $rs = $this->dMantenimientoGeneral->spListaAmbFisicoxServBasico($codAmbienteFisico, $nomServicioBasico);
        $resultadoArray = array();

        foreach ($rs as $fila) {
            //Para habilitar-deshabilitar servicio
            $fila["vNombreServBasico"] = htmlentities($fila[2]);

            if ($fila["bActivo"] == 1) {
                $fila["chk_activo"] = "<input type='checkbox' checked disabled>";
                $imagenHab = "<img src='../../../../medifacil_front/imagen/icono/agt_action_fail.png' alt='Deshabilitar' title='Deshabilitar'/>";
            } else {
                $fila["chk_activo"] = "<input type='checkbox' disabled>";
                $imagenHab = "<img src='../../../../medifacil_front/imagen/icono/agt_action_success.png' alt='Habilitar' title='Habilitar'/>";
            }
            $estado = $fila["bActivo"];

            $fila["opciones"] = "<a href='#' onclick=\"habServBasicoDeAmbFisico($codAmbienteFisico,$fila[1],'$fila[vNombreServBasico]',$estado);\">" . $imagenHab . "</a>";
            //(codAmbienteFisico,codServicioBasico,nomServicioBasico,estado)
            array_push($resultadoArray, $fila);
        }
        return $resultadoArray;
    }

    //Dibuja tabla de camas por un ambiente fisico
    public function listaCamaxAmbFisico($codAmbienteFisico, $descCama) {
        $rs = $this->dMantenimientoGeneral->spListaCamaxAmbFisico($codAmbienteFisico, $descCama);
        $resultadoArray = array();

        foreach ($rs as $fila) {
            //Para habilitar-deshabilitar cama
            if ($fila["bEstado"] == 1) {
                $fila["chk_activo"] = "<input type='checkbox' checked disabled>";
                $imagenHab = "<img src='../../../../medifacil_front/imagen/icono/agt_action_fail.png' alt='Deshabilitar' title='Deshabilitar'/>";
            } else {
                $fila["chk_activo"] = "<input type='checkbox' disabled>";
                $imagenHab = "<img src='../../../../medifacil_front/imagen/icono/agt_action_success.png' alt='Habilitar' title='Habilitar'/>";
            }
            $estado = $fila["bEstado"];

            $opciones = "";
            //if($_SESSION["permiso_formulario_servicio"][202]["AGREGAR_SERVICIO_X_AMB_FISICO"]==1){
            $opciones .= "<a href='#' onclick=\"habCamaDeAmbFisico($codAmbienteFisico,$fila[0],$fila[2],$estado);\">" . $imagenHab . "</a>&nbsp;&nbsp;&nbsp;&nbsp;";
            //(codAmbienteFisico,codServicioBasico,nomServicioBasico,estado)
            //}
            //if($_SESSION["permiso_formulario_servicio"][202]["AGREGAR_SERVICIO_X_AMB_FISICO"]==1){
            $datos = $codAmbienteFisico . "|" . $fila["vNombreAmbienteFisico"] . "|" . $fila["iIdCodigoCama"] . "|" . $fila["iNumeroCama"] . "|" . $fila["vDescripcionCama"];
            $datos = base64_encode($datos);
            $opciones .= "<a href=\"javascript:mostrarMantCamaxAmbFisico2('actualizar','$datos');\"><img src=\"../../../../medifacil_front/imagen/icono/editar.png \"></a>";
            //}

            $fila["opciones"] = $opciones;
            array_push($resultadoArray, $fila);
        }
        return $resultadoArray;
    }

    public function spManteCamaxAmbienteFisico($accion, $idCama, $codAmbienteFisico, $numCama, $descCama) {
        $rs = $this->dMantenimientoGeneral->spManteCamaxAmbienteFisico($accion, $idCama, $codAmbienteFisico, $numCama, $descCama);
        return $rs;
    }

    public function getUltimoNumCamaxAmbFisico($codAmbienteFisico) {
        $rs = $this->dMantenimientoGeneral->getUltimoNumCamaxAmbFisico($codAmbienteFisico);
        return $rs;
    }

    public function spHabCamaDeAmbFisico($codAmbienteFisico, $codCama, $estado) {
        $rs = $this->dMantenimientoGeneral->spHabCamaDeAmbFisico($codAmbienteFisico, $codCama, $estado);
        return $rs;
    }

    public function spManteAmbienteFisico($accion, $codAmbienteFisico, $idSedeEmpresa, $nomAmbienteFisico, $descAmbienteFisico, $numPisoAmbienteFisico, $anchoAmbienteFisico, $largoAmbienteFisico, $altoAmbienteFisico, $umAmbienteFisico, $idTipo) {
        $rs = $this->dMantenimientoGeneral->spManteAmbienteFisico($accion, $codAmbienteFisico, $idSedeEmpresa, $nomAmbienteFisico, $descAmbienteFisico, $numPisoAmbienteFisico, $anchoAmbienteFisico, $largoAmbienteFisico, $altoAmbienteFisico, $umAmbienteFisico, $idTipo);
        return $rs;
    }

    public function spEliminarAmbienteFisico($codAmbienteFisico, $idSedeEmpresa) {
        $rs = $this->dMantenimientoGeneral->spEliminarAmbienteFisico($codAmbienteFisico, $idSedeEmpresa);
        return $rs;
    }

    public function spHabServBasicoDeAmbFisico($codAmbienteFisico, $codServicioBasico, $estado) {
        $rs = $this->dMantenimientoGeneral->spHabServBasicoDeAmbFisico($codAmbienteFisico, $codServicioBasico, $estado);
        return $rs;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function obtenerAmbienteLogico($datos) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        return $o_DMantenimientoGeneral->getAmbienteLogico($datos);
    }

    public function activaryDesactivarAmbienteLogico($datos) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        return $o_DMantenimientoGeneral->activaryDesactivarAmbienteLogico($datos);
    }

    public function lguardarMantenimientoIp($datos) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        return $o_DMantenimientoGeneral->dguardarMantenimientoIp($datos);
    }
     public function actualizarMantenimiento($datos) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        return $o_DMantenimientoGeneral->actualizarMantenimiento($datos);
    }
    
      public function eliminarMantenimiento($datos) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        return $o_DMantenimientoGeneral->eliminarMantenimiento($datos);
    }
    

    public function grabarAmbienteLogico($datos) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        return $o_DMantenimientoGeneral->grabarAmbienteLogico($datos);
    }

    /*     * ****************MANTENIMIENTO ASIGNACION AMBIENTES LOGICOS X AMBIENTES FISICOS************************************** */

    public function getListaAsignacionAmbienteFisicosaAmbientesLogicos($datos) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantenimientoGeneral->getArrayAsignacionAmbienteFisicosaAmbientesLogicos($datos);
        $resultadoArray = array();
        foreach ($resultado as $fila) {
            if ($fila[6] == '1') {
                if ($_SESSION["permiso_formulario_servicio"][201]["DESACTIVAR_AMB_FISICO_X_AMB_LOGICO"] == 1) {
                    $fila[7] = "<a href='#' onclick=\"irActivaryDesactivarAsignacionAmbFisicoaAmbLogico('" . $fila[0] . "','" . $fila[1] . "','" . $fila[2] . "','" . $fila[6] . "');\"><img src='../../../../medifacil_front/imagen/icono/agt_action_success.png' title='Desactivar'/></a>";
                } else {
                    $fila[7] = "<img src='../../../../medifacil_front/imagen/icono/agt_action_success.png' title='Activado'/>";
                }
            } else {
                if ($_SESSION["permiso_formulario_servicio"][201]["ACTIVAR_AMB_FISICO_X_AMB_LOGICO"] == 1) {
                    $fila[7] = "<a href='#' onclick=\"irActivaryDesactivarAsignacionAmbFisicoaAmbLogico('" . $fila[0] . "','" . $fila[1] . "','" . $fila[2] . "','" . $fila[6] . "');\"><img src='../../../../medifacil_front/imagen/icono/agt_action_fail.png' title='Activar'/></a>";
                } else {
                    $fila[7] = "<img src='../../../../medifacil_front/imagen/icono/agt_action_fail.png' title='Desactivado'/>";
                }
            }
            if ($_SESSION["permiso_formulario_servicio"][201]["ELIMINAR_AMB_FISICO_X_AMB_LOGICO"] == 1) {
                $fila[8] = "<a href='#' onclick=\"irEliminarAsignacionAmbFisicoaAmbLogico('" . $fila[0] . "','" . $fila[1] . "','" . $fila[2] . "');\"><img src='../../../../medifacil_front/imagen/icono/delete.png' title='Eliminar'/></a>";
            } else {
                $fila[8] = "";
            }


            array_push($resultadoArray, $fila);
        }
        return $resultadoArray;
    }

    public function agregarAmbienteFisicoaAmbienteLogico($datos) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        return $o_DMantenimientoGeneral->agregarAmbienteFisicoaAmbienteLogico($datos);
    }

    public function activarydesactivarAsignacionAmbFisicoaAmbLogico($datos) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        return $o_DMantenimientoGeneral->activarydesactivarAsignacionAmbFisicoaAmbLogico($datos);
    }

    public function eliminarAsignacionAmbFisicoaAmbLogico($datos) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        return $o_DMantenimientoGeneral->eliminarAsignacionAmbFisicoaAmbLogico($datos);
    }

    public function buscarAmbienteFisico($codigoSucursal, $txtNombreAmbienteFisico) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantenimientoGeneral->buscarAmbienteFisico($codigoSucursal, $txtNombreAmbienteFisico);


        foreach ($resultado as $j => $fila) {
            $imagen1 = "../../../../medifacil_front/imagen/icono/nuevo_item.png ^ Agregar";
            array_push($resultado[$j], $imagen1);
        }
        return $resultado;
    }

    function lCargarDatosMantenimientoAlmacen($datos) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantenimientoGeneral->dCargarDatosMantenimientoAlmacen($datos);
        return $resultado;
    }

    public function guardarAlmacen($datos) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantenimientoGeneral->guardarAlmacen($datos);
    }

    //Jose 2012/02/27
    public function guardarSedeEmpresaAreaMasivamente($cadenaIdArea, $cadenaIdSede) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantenimientoGeneral->guardarSedeEmpresaAreaMasivamente($cadenaIdArea, $cadenaIdSede);
        return $resultado;
    }

    //Jose 2012/03/15
    public function tablaSucursalesXidArea($idArea) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantenimientoGeneral->tablaSucursalesXidArea($idArea);
        foreach ($resultado as $j => $fila) {
            if ($resultado[$j][5] == 1)
                array_push($resultado[$j], "Activado");
            else if ($resultado[$j][5] == 0)
                array_push($resultado[$j], "Desactivado");
            $imagen1 = "../../../../medifacil_front/imagen/icono/editar.png ^ Editar";
            $imagen2 = "../../../../medifacil_front/imagen/icono/eliminar.gif ^ Eliminar";
            array_push($resultado[$j], $imagen1);
            array_push($resultado[$j], $imagen2);
        }
        return $resultado;
    }

    //Jose 2012/02/28
    public function preeditaArea($idArea) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantenimientoGeneral->preeditaArea($idArea);
        return $resultado;
    }

    //Jose 2012/03/01
    public function preeditaAreaXSedeEmpresa($idArea, $idSedeEmpresa, $nivel) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantenimientoGeneral->preeditaAreaXSedeEmpresa($idArea, $idSedeEmpresa, $nivel);
        return $resultado;
    }

    public function presentacionTurnos($datos) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantenimientoGeneral->presentacionTurnos($datos);
        return $resultado;
    }

    //Jose 2012/02/29
    public function grabarAreaJerarquicamente($datos) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantenimientoGeneral->grabarAreaJerarquicamente($datos);
        // ECHO $resultado;
        switch (trim($resultado[0][0])) {
            case "0": {
                    $rs = "<p style='color: red; font-weight: bold'>Solo se permite hasta 5 niveles</p>";
                    break;
                }
            case "1": {
                    $rs = "<p style='color: blue; font-weight: bold'>Datos Grabados Correctamente</p>";
                    break;
                }
            case "2": {
                    $rs = "<p style='color: red; font-weight: bold'>Error al Grabar intentelo nuevamente</p>";
                    break;
                }
            case "3": {
                    $rs = "<p style='color: red; font-weight: bold'>El nombre del Área ya existe, se habilito el área</p>";
                    break;
                }
            case "4": {
                    $rs = "<p style='color: red; font-weight: bold'>Error no existe el Padre del Área que desea grabar</p>";
                    break;
                }
        }
        //  ECHO trim($resultado[0][0]);
        return $rs;
    }

    public function actualizarEstadoSedeEmpresaArea($datos) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantenimientoGeneral->actualizarEstadoSedeEmpresaArea($datos);
//        switch (trim($resultado[0][0])) {
//            case "0": {
//                    $rs = "<p style='color: red; font-weight: bold'>...</p>";
//                    break;
//                }
//            case "1": {
//                    $rs = "<p style='color: blue; font-weight: bold'>Registro Actualizado</p>";
//                    break;
//                }
//            default: $rs="<p style='color: blue; font-weight: bold'>....</p>";
//        }
        //ECHO trim($resultado[0][0]);
        //return $rs;
    }

    public function actualizacionLogicaSedeEmpresaArea($idSedeEmpresaArea) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantenimientoGeneral->actualizacionLogicaSedeEmpresaArea($idSedeEmpresaArea);
    }

    public function comboSedes() {
        $o_DLMantenimientoGeneral = new DMantenimientoGeneral();
        $rs = $o_DLMantenimientoGeneral->comboSedes();
        $resultadoArray = array();

        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    public function grabarMantenimientoAlmacen($datos) {
        $o_DLMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DLMantenimientoGeneral->grabarMantenimientoAlmacen($datos);
        return $resultado;
    }

    public function lgrabarAgregarAlmacen($datos) {
        $o_DLMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DLMantenimientoGeneral->dgrabarAgregarAlmacen($datos);
        return $resultado;
    }

    //Mantenimiento Unidades de MEdida - Angel

    public function getUnidadMedida() {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantenimientoGeneral->getUnidadMedida();
        foreach ($resultado as $key => $value) {
            array_push($resultado[$key], "../../../../medifacil_front/imagen/icono/editar.png ^ Editar");
            array_push($resultado[$key], "../../../../medifacil_front/imagen/icono/i_nomailappt.png ^ Eliminar");
        }
        return $resultado;
    }

    public function getUnidad($datos) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantenimientoGeneral->getUnidad($datos);
        foreach ($resultado as $key => $value) {
            array_push($resultado[$key], "../../../../medifacil_front/imagen/icono/editar.png ^ Editar");
            array_push($resultado[$key], "../../../../medifacil_front/imagen/icono/i_nomailappt.png ^ Eliminar");
        }
        return $resultado;
    }

    public function lMantenimientoTiposUnidadMedida($datos) {
        $o_DLMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DLMantenimientoGeneral->dMantenimientoTiposUnidadMedida($datos);
        return $resultado;
    }

    public function EliminarTipoUnidadMedida($datos) {
        $o_DLMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DLMantenimientoGeneral->EliminarTipoUnidadMedida($datos);
        return $resultado;
    }

    public function EliminarUnidadMedida($datos) {
        $o_DLMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DLMantenimientoGeneral->EliminarUnidadMedida($datos);
        return $resultado;
    }

    public function grabarMantenimientoTipoUnidadMedida($datos) {
        $o_DLMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DLMantenimientoGeneral->grabarMantenimientoTipoUnidadMedida($datos);
        return $resultado;
    }

    public function grabarAgregarTipoUnidadMedida($datos) {
        $o_DLMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DLMantenimientoGeneral->grabarAgregarTipoUnidadMedida($datos);
        return $resultado;
    }

    public function lMantenimientoUnidadMedida($datos) {
        $o_DLMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DLMantenimientoGeneral->dMantenimientoUnidadMedida($datos);
        return $resultado;
    }

    public function grabarMantenimientoUnidadMedida($datos) {
        $o_DLMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DLMantenimientoGeneral->grabarMantenimientoUnidadMedida($datos);
        return $resultado;
    }

    public function grabarAgregarUnidadMedida($datos) {
        $o_DLMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DLMantenimientoGeneral->grabarAgregarUnidadMedida($datos);
        return $resultado;
    }

    public function lmodificarRadioButtonUnidadMedida($datos) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        return $o_DMantenimientoGeneral->dmodificarRadioButtonUnidadMedida($datos);
    }
      public function verListaDeCiePorGrupoEtareo($iIdGrupoEtareo) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        return $o_DMantenimientoGeneral->verListaDeCiePorGrupoEtareo($iIdGrupoEtareo);
    }
 public function agregarCIEaGrupoEtareo($datos) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        return $o_DMantenimientoGeneral->agregarCIEaGrupoEtareo($datos);
    }
     public function cambiarEstadoCieGrupoEtareo($datos) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        return $o_DMantenimientoGeneral->cambiarEstadoCieGrupoEtareo($datos);
    }

    

    public function listarGrupoEtareo() {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantenimientoGeneral->listarGrupoEtareo();
        foreach ($resultado as $key => $value) {
            array_push($resultado[$key], "");
        }
        return $resultado;
    }
    public function listarCie() {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantenimientoGeneral->listarCie();
        foreach ($resultado as $key => $value) {
            array_push($resultado[$key], "");
        }
        return $resultado;
    }
     public function buscarCieListado($nombreCie) {
        $o_DMantenimientoGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantenimientoGeneral->buscarCieListado($nombreCie);
        foreach ($resultado as $key => $value) {
            array_push($resultado[$key], "");
        }
        return $resultado;
    }

    

}

?>
