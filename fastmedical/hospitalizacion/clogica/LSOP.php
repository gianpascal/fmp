<?php
require_once ("../../cdatos/DSOP.php");
require_once("LPersona.php");

class LSOP {
    private $dSOP;

    public function __construct() {
        $this->dSOP = new DSOP();
    }
    public function getListaProgramacionesSOP($datos){
        $o_DSOP = new DSOP();
        $o_LPersona= new LPersona();
        $resultado = $o_DSOP->getArrayProgramacionesSOP($datos);
        foreach($resultado  as $ind=>$valor){
            $resultado[$ind][6] = utf8_decode($o_LPersona ->formatoEdad($resultado[$ind][6]));
            $resultado[$ind]['dFechaNacimiento'] = utf8_decode($o_LPersona ->formatoEdad($resultado[$ind]['dFechaNacimiento']));
        }
        return $resultado;
    }
    public function getListaLeyenda() {
        $datos = array("0" => 
                                array("0"=>"1","1"=>"","2"=>"Pendiente/Separado"),
                       "1" =>   array("0"=>"2","1"=>"","2"=>"En SOP"),
                       "2" =>   array("0"=>"3","1"=>"","2"=>"Transferido (Hospitalizado)"),
                       "3" =>   array("0"=>"4","1"=>"","2"=>"De Alta")
            );
        
        
        
        return $datos;
    }

    /************************* Solicitud Programacion SOP *********************/
    //Buscador de pacientes para la solicitud de programacion SOP
    public function spListaPaciente($opcion,$valor) {
        $oDSOP = new DSOP();
        $rs = $oDSOP->spListaPaciente($opcion,$valor);
        $resultadoArray = array();

        foreach ($rs as $f) {
            //$f['nomCompleto']=htmlentities($f[5]);
            //$f['js'] = base64_encode($f[0]."|".$f[1]."|".$f[2]."|".$f[3]."|".$f[4]."|".htmlentities($f[5])."|".htmlentities($f[6])."|".htmlentities($f[7])."|".$id_sistema);
            //$f['edad']=htmlentities($this->calcularEdadPaciente(trim($f[3])));
            $f['edad']=utf8_decode($this->calcularEdadPersona(trim($f[3]),1));
            //$f['edad']=$this->calcularEdadPaciente(trim($f[3]));
            array_push($resultadoArray,$f);
        }
        return $resultadoArray;
    }

    public function calcularEdadPersona($fechaNacimiento="",$tipoRespuesta="") {//El argumento es tipo DATE
        //$fecha_actual = date ("Y-m-d");
        $fechaActual = date ("d/m/Y");
        $fechaNacimiento=empty($fechaNacimiento)?$fechaActual:$fechaNacimiento;
        
        $fx=strtotime($fechaNacimiento);
        $arrfx = date("d/m/Y",$fx);

        $arrayFechaNacimiento = explode("/",$arrfx);
        $arrayFechaActual = explode("/",$fechaActual);

        $dias = $arrayFechaActual[0] - $arrayFechaNacimiento[0]; // calculamos días
        $meses = $arrayFechaActual[1] - $arrayFechaNacimiento[1]; // calculamos meses
        $anios = $arrayFechaActual[2] - $arrayFechaNacimiento[2]; // calculamos años
        
        if ($dias < 0) {
            --$meses;
            switch ($arrayFechaActual[1]) {
                case 1: $diasMesAnterior=31;
                        break;
                case 2: $diasMesAnterior=31;
                        break;
                case 3:
                    if ($this->esAnioBisiesto($arrayFechaActual[2])) {
                        $diasMesAnterior=29;
                        break;
                    } else {
                        $diasMesAnterior=28;
                        break;
                    }
                case 4: $diasMesAnterior=31;
                        break;
                case 5: $diasMesAnterior=30;
                        break;
                case 6: $diasMesAnterior=31;
                        break;
                case 7: $diasMesAnterior=30;
                        break;
                case 8: $diasMesAnterior=31;
                        break;
                case 9: $diasMesAnterior=31;
                        break;
                case 10: $diasMesAnterior=30;
                        break;
                case 11: $diasMesAnterior=31;
                        break;
                case 12: $diasMesAnterior=30;
                        break;
            }
            $dias=$dias + $diasMesAnterior;
        }
        if($meses < 0){
            --$anios;
            $meses=$meses + 12;
        }

        $rpta="";
        if($tipoRespuesta==1){
            $rpta=$anios;
        }
        else{
            if($tipoRespuesta==2){
                $rpta="$anios años, $meses meses, $dias días";
            }
        }
        
        return $rpta;
    }

    function esAnioBisiesto($anio) {
        $esBisiesto=0;

        if($anio % 400 == 0){
            $esBisiesto=1;
        }
        else{
            if($anio % 100 == 0){
                $esBisiesto=0;
            }
            else{
                if($anio % 4 == 0){
                    $esBisiesto=1;
                }
                else{
                    $esBisiesto=0;
                }
            }
        }
        return $esBisiesto;
    }

    public function spListaCieDxPreOperatorio($accion,$token){
        $oDSOP = new DSOP();
        $resultado = $oDSOP->spListaCieDxPreOperatorio($accion,$token);
        /*$j=0;
        foreach($resultado as $fila) {
            $imagen="../../../../medifacil_front/imagen/icono/nuevo_item.png ^ Agregar";
            array_push($resultado[$j],$imagen);
            $j++;
        }*/
        return $resultado;
    }

    public function spListaServicioCirugia($accion,$token){
        $oDSOP = new DSOP();
        $resultado = $oDSOP->spListaServicioCirugia($accion,$token);
        return $resultado;
    }

    public function spListaCirujano($opcion,$valor){
        $oDSOP = new DSOP();
        $rs = $oDSOP->spListaCirujano($opcion,$valor);
        $resultadoArray = array();

        foreach ($rs as $f) {
            $f['edad']=utf8_decode($this->calcularEdadPersona(trim($f[3]),1));
            array_push($resultadoArray,$f);
        }
        return $resultadoArray;
    }

    public function spManteSolProgSOP($accion,$fechaPropuesta,$horaPropuesta,$codPerPaciente,$codCentroCostoSolProgSOP,
                                    $cadenaIdDxPreOperatorio,$cadenaCodServicioCirugia,$cadenaPorcServicioCirugia,
                                    $duracionServicioCirugia,$codPerCirujanoResponsable,$cadenaCodPerCirujanoAyudante,
                                    $valorHematocrito,$valorHemoglobina,$observaciones){
        $oDSOP = new DSOP();
        $rs = $oDSOP->spManteSolProgSOP($accion,$fechaPropuesta,$horaPropuesta,$codPerPaciente,$codCentroCostoSolProgSOP,
                                    $cadenaIdDxPreOperatorio,$cadenaCodServicioCirugia,$cadenaPorcServicioCirugia,
                                    $duracionServicioCirugia,$codPerCirujanoResponsable,$cadenaCodPerCirujanoAyudante,
                                    $valorHematocrito,$valorHemoglobina,$observaciones);
        return $rs;
    }

    public function spListaSolicitudesPendientesSOP($accion,$token){
        $oDSOP = new DSOP();
        $rs = $oDSOP->spListaSolicitudesPendientesSOP($accion,$token);
        $resultadoArray = array();

        foreach ($rs as $f) {
            $f['edad']=utf8_decode($this->calcularEdadPersona(trim($f['dFechaNacimientoPaciente']),1));
            $imagenVerDetalle="../../../../medifacil_front/imagen/icono/b_ver_on.gif ^ Ver detalle";
            $imagenAceptar="../../../../medifacil_front/imagen/icono/agt_action_success.png ^ Aceptar";
            $imagenRechazar="../../../imagen/inicio/eliminar.gif ^ Rechazar";
            $f['btnVerDetalle']=$imagenVerDetalle;
            $f['btnAceptar']=$imagenAceptar;
            $f['btnRechazar']=$imagenRechazar;
            array_push($resultadoArray,$f);
        }
        return $resultadoArray;
    }

    public function spListaDetalleSolicitudesPendientesSOP($accion,$token){
        $oDSOP = new DSOP();
        $rs = $oDSOP->spListaSolicitudesPendientesSOP($accion,$token);
        $resultadoArray = array();

        foreach ($rs as $f) {
            $f["edad"]=utf8_decode($this->calcularEdadPersona(trim($f["dFechaNacimientoPaciente"]),2));
            array_push($resultadoArray,$f);
        }
        return $resultadoArray;
    }

    public function spListaDxPreOperatorioSolicitudesPendientesSOP($accion,$token){
        $oDSOP = new DSOP();
        $rs = $oDSOP->spListaSolicitudesPendientesSOP($accion,$token);
        return $rs;
    }

    public function spListaCirugiasSolicitudesPendientesSOP($accion,$token){
        $oDSOP = new DSOP();
        $rs = $oDSOP->spListaSolicitudesPendientesSOP($accion,$token);
        return $rs;
    }

    public function spListaAyudantesSolicitudesPendientesSOP($accion,$token){
        $oDSOP = new DSOP();
        $rs = $oDSOP->spListaSolicitudesPendientesSOP($accion,$token);
        return $rs;
    }

    /*********************** Fin Solicitud Programacion SOP *******************/

    /****************************** Programacion SOP **************************/
    public function spAceptarRechazarSolProgSOP($accion,$iidSolicitudProgramacion){
        $oDSOP = new DSOP();
        $rs = $oDSOP->spAceptarRechazarSolProgSOP($accion,$iidSolicitudProgramacion);
        return $rs;
    }

    public function spManteProgramacionSOP($accion,$iidProgramacionSOP,$iidSolicitudProgramacion,$iidEstadoSOP,$iidCentroCosto,
                                           $cCodigoMedicoCirujano,$iCodigoPaciente,$cCodigoAmbienteLogico,$iCodigoAmbienteFisico,$cCodigoActividad,
                                           $iidTipoProgramacionSOP,$cCodigoFormato,$cNroFormato,$vHoraProgramada,$dFechaServicio,$dFechaHoraIngreso,
                                           $dFechaHoraSalida,$vTiempoAproximado,$cadenaIdServicioUtilizado,$cadenaCodPersonaResponsable){
        $oDSOP = new DSOP();
        $rs = $oDSOP->spManteProgramacionSOP($accion,$iidProgramacionSOP,$iidSolicitudProgramacion,$iidEstadoSOP,$iidCentroCosto,
                                           $cCodigoMedicoCirujano,$iCodigoPaciente,$cCodigoAmbienteLogico,$iCodigoAmbienteFisico,$cCodigoActividad,
                                           $iidTipoProgramacionSOP,$cCodigoFormato,$cNroFormato,$vHoraProgramada,$dFechaServicio,$dFechaHoraIngreso,
                                           $dFechaHoraSalida,$vTiempoAproximado,$cadenaIdServicioUtilizado,$cadenaCodPersonaResponsable);
        return $rs;
    }

    public function spListaProgramacionesSOP($accion,$token){
        $oDSOP = new DSOP();
        $rs = $oDSOP->spListaProgramacionesSOP($accion,$token);
        $resultadoArray = array();

        foreach ($rs as $f) {
            $imagenEditar="../../../../medifacil_front/imagen/icono/editar.png ^ Editar";
            $imagenAtender="../../../../medifacil_front/imagen/icono/hos_medico.png ^ Atender";
            $f['btnAtender']=$imagenAtender;
            $f['btnEditar']=$imagenEditar;
            array_push($resultadoArray,$f);
        }
        
        return $resultadoArray;
    }

    public function spListaDetalleProgramacionSOP($accion,$token){
        $oDSOP = new DSOP();
        $rs = $oDSOP->spListaProgramacionesSOP($accion,$token);
        $resultadoArray = array();

        foreach ($rs as $f) {
            //$f["edad"]=utf8_decode($this->calcularEdadPersona(trim($f["dFechaNacimientoPaciente"]),2));
            $f['edad']=utf8_decode($this->calcularEdadPersona(trim($f['dFechaNacimientoPaciente']),2));
            array_push($resultadoArray,$f);
        }
        return $resultadoArray;
    }

    public function spListaCirugiasRealizadasSOP($accion,$token){
        $oDSOP = new DSOP();
        $rs = $oDSOP->spListaProgramacionesSOP($accion,$token);
        $resultadoArray = array();

        foreach ($rs as $f) {
            $imagenBuscarCirujano="../../../../medifacil_front/imagen/icono/add_user.png ^ Buscar Cirujano";
            $imagenEliminarCirujano="../../../imagen/inicio/eliminar.gif ^ Quitar Cirujano";
            $f['btnBuscarCirujano']=$imagenBuscarCirujano;
            $f['btnEliminarCirujano']=$imagenEliminarCirujano;
            //$f['btnEditar']=$imagenEditar;
            array_push($resultadoArray,$f);
        }

        return $resultadoArray;
    }

    public function spListaServiciosUtilizadosSOP($accion,$token){
        $oDSOP = new DSOP();
        $rs = $oDSOP->spListaProgramacionesSOP($accion,$token);
        $resultadoArray = array();

        foreach ($rs as $f) {
            $imagenBuscarPerResp="../../../../medifacil_front/imagen/icono/add_user.png ^ Buscar Responsable";
            $imagenEliminarPerResp="../../../imagen/inicio/eliminar.gif ^ Quitar Responsable";
            $f['btnBuscarResponsable']=$imagenBuscarPerResp;
            $f['btnEliminarResponsable']=$imagenEliminarPerResp;
            //$f['btnEditar']=$imagenEditar;
            array_push($resultadoArray,$f);
        }

        return $resultadoArray;
    }

    public function spListaAmbientesLogicos($accion,$token){
        $oDSOP = new DSOP();
        $rs = $oDSOP->spListaProgramacionesSOP($accion,$token);
        foreach ($rs as $fila) {
            $combo[$fila["cCodigoAmbienteLogico"]]=htmlentities(trim($fila["vNombreAmbienteLogico"]));
        }
        return $combo;
    }

    public function spListaCentroCostoCirujanosSOP($accion,$token){
        $oDSOP = new DSOP();
        $rs = $oDSOP->spListaProgramacionesSOP($accion,$token);
        foreach ($rs as $fila) {
            $combo[$fila["iidCentroCosto"]]=htmlentities(trim($fila["vDescripcionCcosto"]));
        }
        return $combo;
    }

    public function spListaAmbientesLogicosSOP($accion,$token){
        $oDSOP = new DSOP();
        $resultado = $oDSOP->spListaProgramacionesSOP($accion,$token);
        return $resultado;
    }

    public function spListaTiposProgramacionSOP($accion,$token){
        $oDSOP = new DSOP();
        $rs = $oDSOP->spListaProgramacionesSOP($accion,$token);
        foreach ($rs as $fila) {
            $combo[$fila["iidTipoProgramacionSOP"]]=htmlentities(trim($fila["vTipoProgramacionSOP"]));
        }
        return $combo;
    }
    /**************************** Fin Programacion SOP ************************/


}

?>
