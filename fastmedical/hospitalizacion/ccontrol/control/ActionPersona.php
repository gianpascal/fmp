<?php

require_once("../../../pholivo/Html1.php");
require_once("../../../pholivo/Html.php");
require_once("../../clogica/LPersona.php");
require_once("../../../pholivo/tablaDHTMLX.php");

class ActionPersona {

    public function __construct() {
        
    }

    public function buscadorPersona($arrayParametros) {
        $comboTipoDocumentos = $this->comboTipoDocumento('1');
        $obtenerPersonas = $this->obtenerPersonas('', '', '', '', '', '');
        require_once("../../cvista/busqueda/buscador_personas.php");
    }

    public function comboTipoDocumento($optionsHTML) {
        $o_LPersona = new LPersona();
        $arrayCombo = $o_LPersona->seleccionarTipoDocumentoBusqueda();
        //$arrayCombo=array('dni','le','array');
        //print_r($arrayCombo);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

    public function aDatosPersonaCompleto($datos){
        $o_LPersona = new LPersona();
        $parametro='02';
        $tipoDoc='001';
        $patron=$datos['iCodigoPersona'];
        $arrayFilas = $o_LPersona->lDatosPersonaCompleto($patron, $tipoDoc, $parametro);
       return $arrayFilas[0][2].'|'.$arrayFilas[0][3];
    }
    
    public function obtenerPersonas($patron, $tipoDoc, $parametro, $funcion, $editar) {
//        echo "jjjjj".$funcion."seeeeee";
                
        $o_LPersona = new LPersona();
        $patron = str_replace("\\", '', $patron);
//        echo "5555".$patron."5555";
        $arrayFilas = $o_LPersona->getListaPersonas($patron, $tipoDoc, $parametro, $editar);
        $codigoPrimeraPersona = '';
        if (isset($arrayFilas[0][0])) {
            $codigoPrimeraPersona = $arrayFilas[0][0];
            echo "<input type=\"hidden\" value=\"" . $codigoPrimeraPersona . "\" id=\"txtcodigoPersona\" />";
        }
        $arrayTipo = array("0" => "c", "1" => "c", "2" => "c");
        $arrayColorEstado = array("0" => "6");
        $arrayCabecera = array('0' => "CODIGO", "1" => "NOMBRE", "2" => "AFILIACIÓN");
        if ($editar == 'editar') {
            //echo $editar."echo";
            $arrayTipo['4'] = 'h';
            $arrayCabecera['4'] = '...';
            $arrayTipo['5'] = 'c';
            $arrayCabecera['5'] = '...';
        } else {
            $arrayTipo['4'] = 'c';
            $arrayCabecera['4'] = '...';
        }
        $o_Html = new Tabla1($arrayCabecera, 10, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', $funcion, 0, $arrayTipo, 3, $arrayColorEstado);
        
//        echo "11111".$patron."33333";
        
        $o_Html->setColumnasOrdenar(array("0", "1", "2"));
        return $o_Html->getTabla();
    }

    public function buscadorMedico($funcion) {
        //$obtenerMedicos = $this->obtenerMedicos('#', '', '', '');
        require_once("../../cvista/busqueda/busqueda_medicos.php");
    }

    public function buscadorMedicoGeneral() {
        //  $obtenerMedicosGeneral = $this->obtenerMedicosGeneral('#', '', '', '');
        require_once("../../cvista/busqueda/busquedaMedicosGeneral.php");
    }
/*
    public function obtenerMedicos($apellidoPaterno, $ApellidoMaterno, $Nombres, $funcion) {
        $o_LPersona = new LPersona();
        $arrayFilas = $o_LPersona->getListaMedicos($apellidoPaterno, $ApellidoMaterno, $Nombres, $funcion);


        $arrayTipo = array("5" => "h", "1" => "h", "2" => "h");
        $arrayColorEstado = array("1" => "5", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9");
        $arrayCabecera = array("5" => "...", "1" => "NOMBRE", "2" => "SERVICIO");

        $o_Html = new Tabla1($arrayCabecera, 5, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', '', 4, $arrayTipo, 0, $arrayColorEstado);
        $o_Html->setColumnasOrdenar(array("1", "2"));
        return $o_Html->getTabla();
    }
 
    */
        public function obtenerMedicos($datos) {
        $o_LPersona = new LPersona();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LPersona->getListaMedicos($datos);
        $arrayCabecera = array("0" => "CRONOGRAMA","1" => "CODIGO", "2" => "NOMBRE", "3" => "SERVICIO", "4" => "CADENA");
        $arrayTamano = array(0 => "25", 1 => "20", 2 => "140", 3 => "140", 4 => "2");
        $arrayTipo = array(0 =>"img", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro");
        $arrayCursor = array(0 => "pointer", 1 => "default", 2 => "default", 3 => "default", 4 => "default");
        $arrayHidden = array(0 => "false", 1 => "true", 2 => "false", 3 => "false", 4 => "true");
        $arrayAlineacion = array(0 => "center", 1 => "left", 2 => "left", 3 => "left", 4 => "left");
      //  return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }
    
    public function obtenerMedicosGeneral($apellidoPaterno, $ApellidoMaterno, $Nombres, $funcion) {
        $o_LPersona = new LPersona();
        $arrayFilas = $o_LPersona->getListaMedicosGeneral($apellidoPaterno, $ApellidoMaterno, $Nombres, $funcion);


        $arrayTipo = array("5" => "h", "1" => "h", "2" => "h");
        $arrayColorEstado = array("1" => "5", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9");
        $arrayCabecera = array("1" => "NOMBRE", "2" => "C.COSTO");

        $o_Html = new Tabla1($arrayCabecera, 5, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', $funcion, 4, $arrayTipo, 0, $arrayColorEstado);
        $o_Html->setColumnasOrdenar(array("1", "2"));
        return $o_Html->getTabla();
    }

    public function obtenerActosMedicos($c_cod_per, $funcionActoMedico) {
        $o_LPersona = new LPersona();
        $arrayFilas = $o_LPersona->getActosMedicos($c_cod_per);
        //echo $funcionActoMedico."----";

        $arrayTipo = array("1" => "c", "2" => "c", "3" => "c", "4" => "c", "6" => "h", "7" => "c");
        $arrayColorEstado = array("1" => "5", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9");
        $arrayCabecera = array("1" => "# Act. Medico", "2" => "ESPECIALIDAD", "3" => "Fecha", "4" => "Medico", "6" => "check", "7" => "...");

        $o_Html = new Tabla1($arrayCabecera, 3, $arrayFilas, 'tablaOrden', 'filax', 'filay', '', 'onClick', $funcionActoMedico, 8, $arrayTipo, 0, $arrayColorEstado);
        $o_Html->setColumnasOrdenar(array("1", "2", "3", "4"));
        return "<fieldset>" . $o_Html->getTabla() . "</fieldset>";
    }

    public function obtenerCronogramaMensual($codigo, $fecha) {
        $o_LPersona = new LPersona();
        $arrayFilas = $o_LPersona->getCronogramaMedicoMensual($codigo, $fecha);

        $funcion = 'cargaCronogramaFecha';
        $arrayTipo = array("0" => "c", "1" => "c", "2" => "c", "3" => "c", "4" => "c", "5" => "c", "6" => "c");
        $arrayColorEstado = array("2" => "7");
        $arrayCabecera = array("0" => "Dia", "1" => "Fecha", "2" => "Actividad", "3" => "turno", "4" => "Cupos", "5" => "Ambiente", "6" => "Producto");

        $o_Html = new Tabla1($arrayCabecera, 25, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', $funcion, 8, $arrayTipo, 7, $arrayColorEstado);
        $o_Html->setColumnasOrdenar(array("0", "1", "2", "3", "4", "5", "6"));
        return $o_Html->getTabla();
    }

    public function obtenerDatosMedicoCronogramaMensual($datos) {
        $o_LPersona = new LPersona();
        $arrayFilas = $o_LPersona->getDatosMedicoCronogramaMensual($datos);
        empty($arrayFilas[0]["vCodigoContacto"]) || (trim($arrayFilas[0]["vCodigoContacto"]) == '') ? $cel1 = '---' : $cel1 = $arrayFilas[0]["vCodigoContacto"];
        empty($arrayFilas[1]["vCodigoContacto"]) || (trim($arrayFilas[1]["vCodigoContacto"]) == '') ? $cel2 = '---' : $cel2 = $arrayFilas[1]["vCodigoContacto"];
        $cadena = "<table width=\"100%\" cellspacing=\"2\" >
          <tr style=\"color:#00AA00\">
            <td width=\"25%\" style=\"font-family: Arial;font-size: 12pt;\" >Celular 1 :</td>
            <td width=\"25%\" style=\"font-family: Arial;font-size: 12pt;\" >" . $cel1 . "</td>
            <td width=\"25%\" style=\"font-family: Arial;font-size: 12pt;\" >Celular 2 :</td>
            <td width=\"25%\" style=\"font-family: Arial;font-size: 12pt;\" >" . $cel2 . "</td>
          </tr>
        </table>";
        return $cadena;
    }

    public function aObtenerCoincidencias($apellidoPaterno, $ApellidoMaterno, $primerNombre, $segundoNombre, $dni, $rId) {
        $o_LPersona = new LPersona();

        $arrayFilas = $o_LPersona->lObtenerCoincidencias($apellidoPaterno, $ApellidoMaterno, $primerNombre, $dni, $rId);

        if (count($arrayFilas) == 0) {
            $botonAgregar = "<a href='#' onclick=\"javascript:registrarPersonaEssalud('$rId');\"><$array src='../../../../fastmedical_front/imagen/btn/b_agregar_on1.gif' /></a>";
            $botonCancelar = "<a href='#' onclick=\"javascript:cancelarRegistroEssalud('');\"><img src='../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif' /></a>";
            $tabla = "La persona: <b>" . $apellidoPaterno . " " . $ApellidoMaterno . " " . $primerNombre . " " . $segundoNombre;
            $tabla.="</b> no se encuentra registrada en la base de datos del Hospital Municipal Los Olivos, desea registrarlo ahora?";
            $tabla.="<br/><br/>";
            $tabla.=$botonAgregar . " " . $botonCancelar;
        } else {
            $arrayTipo = array("0" => "c", "1" => "c", "2" => "c", "3" => "c", "4" => "h");
            $arrayColorEstado = array("0" => "6");
            $arrayCabecera = array('0' => "CODIGO", "1" => "DNI", "2" => "NOMBRE", "3" => "AFILIACIÓN", "4" => "ver");
            $funcion = "relacionarHmloEssalud";
            $o_Html = new Tabla1($arrayCabecera, 2, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', $funcion, 5, $arrayTipo, 3, $arrayColorEstado);
            $o_Html->setColumnasOrdenar(array("0", "1", "2"));
            $tabla = "Es la primera vez que se va a creditar a: <b>" . $apellidoPaterno . " " . $ApellidoMaterno . " " . $primerNombre . " " . $segundoNombre;
            $tabla.="</b>,seleccione a la persona correcta, si no lo es puede agregarlo como nuevo";
            $tabla.="<a href='#' onclick=\"javascript:registrarPersonaEssalud('$rId');\"><img src='../../../../fastmedical_front/imagen/btn/b_agregar_on1.gif' /></a>";
            $tabla.="<p><div style='height:50px;'>" . $o_Html->getTabla() . "</div>";
        }

        return "0|" . $tabla;
    }

    public function actualizaPersonasdesdeEssalud($codigo, $parametros) {
        $o_LPersona = new LPersona();
        $arrayFilas = $o_LPersona->actualizaPersonasdesdeEssalud($codigo, $parametros);
        return $arrayFilas;
    }

    public function grabaEssalud($codigo, $parametros) {
        $o_LPersona = new LPersona();
        $arrayFilas = $o_LPersona->grabaEssalud($codigo, $parametros);
        return $arrayFilas;
    }

    public function grabaTablaEssalud($codigo, $parametros) {
        $o_LPersona = new LPersona();

        $arrayFilas = $o_LPersona->grabaTablaEssalud($codigo, $parametros);
        return $arrayFilas;
    }

    public function actualizarTablaEssalud($parametros) {
        $o_LPersona = new LPersona();
        $arrayFilas = $o_LPersona->actualizarTablaEssalud($parametros);
        //echo "a_actualizarTablaEssalud";
        //$arrayFilas = $o_LPersona->acreditarPersonaRegistradaHmlo($parametros);

        return $arrayFilas;
    }

    public function detalleAcredita($c_cod_per) {
        $o_LPersona = new LPersona();
        $arrayFilas = $o_LPersona->detalleAcredita($c_cod_per);
        // print_r($arrayFilas);
        if (isset($arrayFilas[0][1])) {
            $codigo = $arrayFilas[0][1];
            $nombre = utf8_encode($arrayFilas[0][2]);
            $afiliacion = $arrayFilas[0][3];
            if ($_SESSION["permiso_formulario_servicio"][177]["VER_ACRE"] == 1) {
                $ver = "<a href='#' onclick=\"javascript:ventanaEditaPersona('" . $codigo . "');\"><img style='height:15px;' src='../../../../fastmedical_front/imagen/btn/b_ver_off.gif' title='Editar Persona'/></a>";
                $ver2 = "<a href='#' onclick=\"javascript:ventanaEditaPersona('" . $codigo . "');\"><img style='height:15px;' src='../../../../fastmedical_front/imagen/icono/ver.png' title='Paquete etareo'/></a>";               
            } else {
                $ver = "";
                $ver2 = "";
            }


            //print_r($arrayFilas);
            $arrayTipo = array("4" => "c", "5" => "c", "6" => "c", "7" => "c", "8" => "c", "9" => "c", "11" => "h");
            $arrayColorEstado = array("2" => "6");
            $arrayCabecera = array('4' => "idCarta", "5" => "Afiliacion Carta", "6" => "Monto", "7" => "Saldo", "8" => "desde", "9" => "hasta", "11" => "Estado");
            $funcion = "relacionarHmloEssalud";
            $o_Html = new Tabla1($arrayCabecera, 2, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', '', 1, $arrayTipo, 10, $arrayColorEstado);
            $o_Html->setColumnasOrdenar(array("0", "1", "2"));
            $cartas = $o_Html->getTabla();
            require_once("../../cvista/admision/vDetalleAcredita.php");
        } else {
            echo "no tiene cartas activas";
        }
    }

    public function cambiarAfiliacionAmbulatorio($datos) {
        $o_LPersona = new LPersona();
        $resultado = $o_LPersona->cambiarAfiliacionAmbulatorio($datos);
        return $resultado[0]["respuesta"];
    }

    public function cambiarAfiliacionContribuyente($datos) {
        $o_LPersona = new LPersona();
        $resultado = $o_LPersona->cambiarAfiliacionContribuyente($datos);
        return $resultado[0]["respuesta"];
    }

    public function cambiarAfiliacionEssalud($datos) {
        $o_LPersona = new LPersona();
        $resultado = $o_LPersona->cambiarAfiliacionEssalud($datos);
        return $resultado[0]["respuesta"];
    }

    public function verDatosPaciente($c_cod_per) {
        $o_LPersona = new LPersona();
        $datos["codigopersona"] = $c_cod_per;
        $datos["codigocronograma"] = '';
        $resultado = $o_LPersona->verDatosPaciente($datos);
        //$datetime = date_create($resultado[0][7]);
        //$fechaNacimiento= date_format($datetime, 'd/m/y') ;
        $dias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $fechaNacimiento = strtotime($resultado[0][7]);
        $fecha = $dias[date('w', $fechaNacimiento)] . " " . date('d', $fechaNacimiento) . " " . $meses[date('n', $fechaNacimiento) - 1] . " " . date('Y', $fechaNacimiento);
        $edad = $o_LPersona->formatoEdad($resultado[0][7]);
        $cadena = $c_cod_per . '|';
        $cadena = $cadena . $resultado[0][3] . '|';
        $cadena = $cadena . $resultado[0][0] . '|';
        $cadena = $cadena . htmlentities($resultado[0][4] . ' ' . $resultado[0][5] . ' ' . $resultado[0][6]) . '|';
        $cadena = $cadena . $fecha . '|';
        $cadena = $cadena . $edad;
        return $cadena;
    }

    public function datosUsuario() {
        $c_cod_per = $_SESSION['id_persona'];
        require_once("../../cvista/usuario/vDatosUsuario.php");
        //return $c_cod_per;
    }

    public function codigoUsuario() {
        $c_cod_per = $_SESSION['id_persona'];
        return $c_cod_per;
    }

    public function getMedicosdhtmlx($datos) {
        $o_LPersona = new LPersona();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LPersona->getMedicosdhtmlx($datos);
        $arrayCabecera = array(0 => "CODIGO", 1 => "MEDICO", 2 => "C. COSTOS", 3 => "", 4 => "");
        $arrayTamano = array(0 => "60", 1 => "*", 2 => "*", 3 => "*", 4 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "true", 4 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

}

?>
