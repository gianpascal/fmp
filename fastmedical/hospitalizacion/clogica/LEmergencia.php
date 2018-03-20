<?php

require_once ("../../cdatos/DEmergencia.php");

class LEmergencia {

    public function __construct() {
        
    }

    public function CargarDoctoXpaciente($datos) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->CargarDoctoXpaciente($datos);

        return $resultado;
    }

    public function ComboCama($Datos) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->ComboCama($Datos);
        return $resultado;
    }

    public function ComboCamaC($idCodigoAmbientefisico) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->ComboCamaC($idCodigoAmbientefisico);
        return $resultado;
    }

    public function ComboDiagnostico($datos) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->ComboDiagnostico($datos);
        return $resultado;
    }

    public function ComboDestino() {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->ComboDestino();
        return $resultado;
    }

    public function EspecialidadDoctor($CodigoCronograma) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->EspecialidadDoctor($CodigoCronograma);
        return $resultado;
    }

    public function Antecedente($CodigoProgramacion) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->Antecedente($CodigoProgramacion);
        return $resultado;
    }

    public function FotoPersona($cod_per) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->FotoPersona($cod_per);
        return $resultado;
    }

    public function GuardarnsdProgramacionPacientesEmergencia($Datos) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->GuardarnsdProgramacionPacientesEmergencia($Datos);
        $resultado1 = $o_DRemergencia->ActulizarCama($Datos);
        $resultado2 = $o_DRemergencia->ActulizarDestino($Datos);
        $resultado3 = $o_DRemergencia->ActulizarCamaEstado($Datos);
        return $resultado;
    }

    public function ComboAmbienteFisico($CodigoAmbienteFisico) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->ComboAmbienteFisico($CodigoAmbienteFisico);
        return $resultado;
    }

    public function ComboDoctor($fechaSeleccionada) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->ComboDoctor($fechaSeleccionada);
        return $resultado;
    }

    public function ComboEspecialidad() {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->ComboEspecialidad();
        return $resultado;
    }

    public function CodigoAmbienteFisicoCama($idProgramacionPacientesEmergencia) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->CodigoAmbienteFisicoCama($idProgramacionPacientesEmergencia);
        return $resultado;
    }

    public function numeroCama($iCodigoCama) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->numeroCama($iCodigoCama);
        return $resultado;
    }

    public function ReporteDiagnosticoGeneral($total, $Datos) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->ReporteDiagnosticoGeneral($total, $Datos);
        return $resultado;
    }

    public function CantidadTotal($Datos) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->CantidadTotal($Datos);
        return $resultado;
    }

    public function cabezeraTablas() {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->cabezeraTablas();
        return $resultado;
    }

    public function Reporte($Datos) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->Reporte($Datos);
        return $resultado;
    }

    public function ReporteXedades($Datos) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->ReporteXedades($Datos);
        return $resultado;
    }

    public function ReportexSexo($Datos) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->ReportexSexo($Datos);
        return $resultado;
    }

    public function ReportexSexoTotal($Datos) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->ReportexSexoTotal($Datos);
        return $resultado;
    }

    public function CantidadTotalServicios($Datos) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->CantidadTotalServicios($Datos);
        return $resultado;
    }

    public function reporteAmbienteLogicos() {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->reporteAmbienteLogicos();
        return $resultado;
    }

    public function ReporteDiagnosticosXAmbLogico($cCodigoAmbienteLogico, $cantidad, $Datos) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->ReporteDiagnosticosXAmbLogico($cCodigoAmbienteLogico, $cantidad, $Datos);
        return $resultado;
    }

    public function reporteEdades($Datos) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->reporteEdades($Datos);
        return $resultado;
    }

    public function CargarDoctoXpacienteX($datos) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->CargarDoctoXpaciente($datos);

        return $resultado;
    }

    public function reporteCantidadXsexo($Datos) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->reporteCantidadXsexo($Datos);
        return $resultado;
    }

    public function reporteCantidadXedadesTotal($Datos) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->reporteCantidadXedadesTotal($Datos);

        return $resultado;
    }

    public function reporteCantidadXsexoTotal($Datos) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->reporteCantidadXsexoTotal($Datos);

        return $resultado;
    }

    public function reporteTotalXedad($Datos) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->reporteTotalXedad($Datos);

        return $resultado;
    }

    public function reporteTotalXsexo($Datos) {
        $o_DRemergencia = new DEmergencia();
        $resultado = $o_DRemergencia->reporteTotalXsexo($Datos);

        return $resultado;
    }

    //Para listar los documentos por nombre
    public function buscarDocumentos($documento) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->buscarDocumentos($documento);
        $array = $rs;
        $j = 0;

        foreach ($array as $fila) {
            $array[$j][3] = $array[$j][2];
            $array[$j][3] = $j + 1;
            If ($array[$j][1] == '1') {
                $array[$j][1] = "ACTIVO";
                $array[$j][4] = "<a onclick='javascript:eliminarDocumento(" . $array[$j][2] . ");'><img border='0' title='Desactivar' src='../../../../medifacil_front/imagen/icono/op_rechazado.gif'/></a>";
            } else {
                $array[$j][1] = "INACTIVO";
                $array[$j][4] = "<a onclick='javascript:activarDocumento(" . $array[$j][2] . ");'><img border='0' title='Activar' src='../../../../medifacil_front/imagen/icono/op_atendido.gif'/></a>";
            }
            $j++;
        }
        return $array;
    }

    //Mostrar la tabla de atricutos del documento
    public function buscarAtributos($documento) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->buscarAtributos($documento);
        $array = $rs;
        $j = 0;
        $filas = count($array);
        $filas--;
        foreach ($array as $fila) {
            $array[$j][5] = $array[$j][3];
            $array[$j][5] = $j + 1;
            $array[$j][8] = $array[$j][4];
            if ($j == 0 && $filas > 1) {
                $array[$j][6] = "<img border='0' src='../../../../medifacil_front/imagen/btn/blank.png'/>" . "<a onclick='javascript:ordenarAtributo(" . $array[$j][4] . ",1," . $array[$j][0] . ");'><img border='0' title='Bajar' src='../../../../medifacil_front/imagen/btn/c_down.png'/></a>";
            } else {
                if ($j < $filas) {
                    $array[$j][6] = "<a onclick='javascript:ordenarAtributo(" . $array[$j][4] . ",0," . $array[$j][0] . ");'><img border='0' title='Subir' src='../../../../medifacil_front/imagen/btn/c_up.png'/></a>" . "<a onclick='javascript:ordenarAtributo(" . $array[$j][4] . ",1," . $array[$j][0] . ");'><img border='0' title='Bajar' src='../../../../medifacil_front/imagen/btn/c_down.png'/></a>";
                } else {
                    if ($filas > 1) {
                        $array[$j][6] = "<a onclick='javascript:ordenarAtributo(" . $array[$j][4] . ",0," . $array[$j][0] . ");'><img border='0' title='Subir' src='../../../../medifacil_front/imagen/btn/c_up.png'/></a>";
                    }
                }
            }
            $array[$j][7] = "<a onclick='javascript:eliminarAtributo(" . $array[$j][3] . ");'><img border='0' title='Eliminar' src='../../../../medifacil_front/imagen/icono/op_rechazado.gif'/></a>";
            $j++;
        }
        return $array;
    }

    /*     * ************************ FIN MANTENIMIENTO DOCUMENTOS RRHH ************************* */

    /*     * **************Asignacion de Servicios a Puestos de trabajo****************** */

    function getListaServiciosparaAsignar($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->getListasServiciosparaAsignar($datos);
        $resultadoArray = array();
        foreach ($resultado as $fila) {
            if ($_SESSION["permiso_formulario_servicio"][205]["ASIGNAR_SERVICIO_X_PUESTO"] == 1) {
                $fila[3] = "<a href='#' onclick=\"grabarAsignacionServicioaPuesto('" . $fila[0] . "');\"><img src='../../../../medifacil_front/imagen/icono/window_new.png' title='Asignar Servicio'/></a>";
            } else {
                $fila[3] = "";
            }
            array_push($resultadoArray, $fila);
        }
        return $resultadoArray;
    }

    public function listaLeyendaTurno() {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->listaLeyendaTurno();
        $imagen1 = "../../../../medifacil_front/imagen/icono/editar.png ^ Editar";
        foreach ($resultado as $i => $value) {
            if ($value[4] == 1)
                array_push($resultado[$i], "Activado");
            else
                array_push($resultado[$i], "Desactivado");
            array_push($resultado[$i], $imagen1);
        }
        return $resultado;
    }

    public function BusquedaEmpleado($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->BusquedaEmpleado($datos);
        $imagen1 = "../../../../medifacil_front/imagen/icono/editar.png ^ Editar";
        foreach ($resultado as $i => $value) {
            array_push($resultado[$i], $imagen1);
        }
        return $resultado;
    }

    public function ActualizarTablansdHorarioRealesAsistencia($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->ActualizarTablansdHorarioRealesAsistencia($datos);
        return $resultado;
    }

}

?>
