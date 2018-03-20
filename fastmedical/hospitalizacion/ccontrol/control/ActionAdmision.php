<?php

require_once("../../../pholivo/Html.php");
require_once("../../../pholivo/Html1.php");
require_once("../../../pholivo/tablaDHTMLX.php");
//require_once("../../clogica/LLogin.php");
require_once("../../clogica/LPersona.php");
//require_once("../../clogica/LRrhh.php");//comentado
require_once("../../clogica/LCita.php");

class ActionAdmision {

    public function __construct() {
        
    }

//Muestra los datos de un paciente. Llama a los siguientes métodos, que recogen los datos del paciente.
    public function formRegistroPersonas($iid_persona, $funcion) {
//Inicializo los parametros
//$none                 = $trabajador=='v'?'block':'none';

        $recRuta = $this->recuperarRuta('fotos');
        $readonly = $iid_persona == '' ? '' : 'readonly=readonly';
        $disabled = $iid_persona == '' ? '' : 'disabled=disabled';
        $readonly = 'readonly=readonly';
        $disabled = "disabled='disabled'";
        $btnhabil = $iid_persona == '' ? '0' : '1';
        $btndeshabil = 0;

//Construimos el array
        $p = $this->listaDatosPersona($iid_persona); //Datos principales en nsmPersonas
        $padicional = $this->listaDatosPersonaContactos($iid_persona); //Formas de  contactar con la persona
        $padicional2 = $this->listaDatosPersonaDireccion($iid_persona, '01'); //Domicilio fiscal
        $padicional3 = $this->listaDatosPersonaEstudios($iid_persona, '0001'); //Centros de Estdios
        $documentosIdentidad = $this->listaDatosPersonaDocumentos($iid_persona, $readonly, $disabled);
        $lugar_nacimiento = $this->listaDatosPersonaDireccion($iid_persona, '02'); //Lugar de Nacimiento
        $p = $p + $padicional + $padicional2 + $padicional3;
        $p['lugar_nacimiento'] = $lugar_nacimiento['cUbigeo'];
        $p['paisNacimiento'] = $lugar_nacimiento['cPais'];
//print_r($p);
        $accion = $iid_persona == '' ? '' : 'update';
        $display = "display:none;";
        switch ($accion) {
            case '':
                $displayBotones = "display:none;";
                $btnPrincipal = "display:anone;";
                $btnSecundaria = "display:none;";
                $btnOpcional = "display:none;";
                break;
            case 'update':
                $displayBotones = "display:anone;";
                $btnPrincipal = "display:anone;";
                $btnSecundaria = "display:anone;";
                $btnOpcional = "display:none;";
                break;
        }
        $sexo = $p['bSexo'];
        $fondo = $sexo == 0 ? 'user_female.png' : 'user_male.png';
        $dni_fondo = $p['vFoto'] == '' ? ($iid_persona == '' ? 'tufoto.gif' : $fondo) : $p['vFoto'];

        $imagen = $recRuta[0][0] . "/" . $dni_fondo;

//        $verifica = @fopen($recRuta[0][0]."/".$dni_fondo, "r");
//        if(!$verifica){
//            $imagen = $recRuta[0][0]."/anonimo_00.jpg";
//        }
//        @fclose($verifica);
//        if (!file_exists($recRuta[0][1].$dni_fondo))//verifica si existe el file mediante la ruta fisica
//            $imagen = $recRuta[0][0]."/anonimo_00.jpg";


        $iid_estado_civil = $iid_persona == '' ? '' : $p['cEstadoCivil'];
        $tipo_institucion = $iid_persona == '' ? '' : $p['cTipoInstitucion'];
        $nombre_institucion = $iid_persona == '' ? '' : $p['cIdCentrosDeEstudios'];
        $grado_estudio = $iid_persona == '' ? '' : $p['cIdGradosDeEstudio'];
        $grado_instruccion = $iid_persona == '' ? '' : $p['cNivelEducativo'];
        $condicion_laboral = $iid_persona == '' ? '' : $p['cCondicionLab'];
        $ocupacion_laboral = $iid_persona == '' ? '' : $p['cOcupacionLab'];
        $clase_vivienda = $iid_persona == '' ? '' : $p['cClaseVivienda'];
        $clase_raza = $iid_persona == '' ? '' : $p['cGrupoEtnico'];
        $telefono = $iid_persona == '' ? '' : $p['vTelefono'];
        $celular = $iid_persona == '' ? '' : $p['vMovil1'];
        $celular2 = $iid_persona == '' ? '' : $p['vMovil2'];
        $email = $iid_persona == '' ? '' : $p['vEmail'];
        $tipo_via = $iid_persona == '' ? '' : $p['cTipoVia'];
        $tipo_centro_poblado = $iid_persona == '' ? '' : $p['cTipoDeCentroPoblado'];
        $nombre_tipo_via = $iid_persona == '' ? '' : $p['vNombreTipoVia'];
        $nombre_tipo_centro_poblado = $iid_persona == '' ? '' : $p['vNombreTipoCentroPoblado'];
        $kilometro = $iid_persona == '' ? '' : $p['vkm'];
        $lote = $iid_persona == '' ? '' : $p['cNumeroLote'];
        $manzana = $iid_persona == '' ? '' : $p['cManzana'];
        $numero = $iid_persona == '' ? '' : $p['cNumeroVivienda'];
        $observaciones = $iid_persona == '' ? '' : $p['vObservacion'];
        $vReferencia = $iid_persona == '' ? '' : $p['vReferencia'];
        $txt_hijos = $iid_persona == '' ? '' : $p['dHijos'];
        $txtNroHijos = $iid_persona == '' ? '' : $p['dNumerodeHijo'];
        $vapellido_pat = $iid_persona == '' ? '' : $p['vApellidoPaterno'];
        $vapellido_mat = $iid_persona == '' ? '' : $p['vApellidoMaterno'];
        $vnombre = $iid_persona == '' ? '' : $p['vNombre'];

        $fecha_nacimiento = $iid_persona == '' ? '' : $p['fecha_nacimiento'];
        $edadpaciente = $iid_persona == '' ? '' : $p['edadpaciente'];
        
        //echo $p['fecha_nacimiento'].' ' .$edadpaciente;
        $nro_historia_clinica = $iid_persona == '' ? '' : $p['cNumeroHC'];
        $medios_contacto = $iid_persona == '' ? '' : $p['cMedioContacto'];
//Muestra combos

        $cb_civil = $this->seleccionarEstadoCivil($iid_estado_civil);
        $cb_raza = $this->seleccionarClaseRaza($clase_raza);
        $cb_instruccion = $this->seleccionarGradoInstruccion($grado_instruccion);
        $cb_condicion = $this->seleccionarCondicionLaboral($condicion_laboral);
        $cb_vivienda = $this->seleccionarClaseVivienda($clase_vivienda);
        $cb_via = $this->seleccionarTipoVia($tipo_via);
        $cb_cpo = $this->seleccionarTipoCentroPoblado($tipo_centro_poblado);
        $grupo_laboral = substr($ocupacion_laboral, 0, 2);
        $subgrupo_laboral = substr($ocupacion_laboral, 2, 2); //'04';//Este es el campo que escoge
        $cb_ocupacion = $this->seleccionarOcupacionLaboral($grupo_laboral, $subgrupo_laboral, $disabled);
        $cb_tipoInstEduc = $this->seleccionarTipoInstEducativa($tipo_institucion);
        $cb_InstEduc = $this->seleccionarInstEducativa($nombre_institucion, $tipo_institucion);
        $cb_grado_estudio = $this->seleccionarGradoEstudio($grado_estudio, $tipo_institucion);
        $cb_medios_contacto = $this->seleccionarMediosContacto($medios_contacto);
        $ubigeo = trim($p['cUbigeo']) == '' ? "000000" : $p['cUbigeo'];
        $pais = $p['cPais'];
        $cb_combo = $this->listaDatosComboUbigeo($pais, substr($ubigeo, 0, 2), substr($ubigeo, 2, 2), substr($ubigeo, 4, 2), $disabled);
        $lugarNacimiento = trim($p['lugar_nacimiento']) == '' ? "000000" : $p['lugar_nacimiento'];
        $paisNacimiento = $p['paisNacimiento'] == '' ? '9589' : $p['paisNacimiento'];
        $cb_nacimiento = $this->listaDatosComboNacimiento($paisNacimiento, substr($lugarNacimiento, 0, 2), substr($lugarNacimiento, 2, 2), substr($lugarNacimiento, 4, 2), $disabled);
        $tipo_dato = $this->seleccionarVinculoFamiliar("0013");
        $filiacionN = $this->FiliacionesPaciente($iid_persona, '');
        $afiliacionPersona = $p['cAfiliacion'];
        $paciente = $vapellido_pat . " " . $vapellido_mat . " " . $vnombre;
// if (!file_exists($imagen)) $dni_fondo="tufoto";

        require_once("../../cvista/admision/vregistro_personas.php");
    }

//Se llama a este método cuando se ingresa un paciente nuevo.
    public function formRegistroPersonasNuevo($iid_persona, $funcion) {
        $recRuta = $this->recuperarRuta('fotos');
        $ruta = $recRuta[0][0];
        $readonly = '';
        $disabled = '';
        $btnhabil = 0;
        $btndeshabil = 1;
        $display = "display:anone;";
        $btnPrincipal = "display:anone;";
        $btnSecundaria = "display:none;";
        $btnOpcional = "display:none;";
        $displayBotones = "display:anone;";
        $accion = 'inserted';
        $sexo = "";
        $dni_fondo = "tufoto.gif";
        $imagen = $ruta . "/" . $dni_fondo;
        $cb_civil = $this->seleccionarEstadoCivil('');
        $documentosIdentidad = $this->listaDatosPersonaDocumentos($iid_persona, $readonly, $disabled);
        $cb_raza = $this->seleccionarClaseRaza('');
        $cb_instruccion = $this->seleccionarGradoInstruccion('');
        $cb_condicion = $this->seleccionarCondicionLaboral('');
        $cb_vivienda = $this->seleccionarClaseVivienda('');
        $cb_ocupacion = $this->seleccionarOcupacionLaboral('', '', '');
        $cb_via = $this->seleccionarTipoVia('');
        $cb_cpo = $this->seleccionarTipoCentroPoblado('');
        $cb_tipoInstEduc = $this->seleccionarTipoInstEducativa('');
        $cb_InstEduc = $this->seleccionarInstEducativa('', '0001');
        $cb_grado_estudio = $this->seleccionarGradoEstudio("", "0001");
        $cb_medios_contacto = $this->seleccionarMediosContacto("");
        $cb_combo = $this->listaDatosComboUbigeo('9589', '15', '01', '00', $disabled);
        $cb_nacimiento = $this->listaDatosComboNacimiento('9589', '', '', '', $disabled);
        $tipo_dato = $this->seleccionarVinculoFamiliar("0013");
        $filiacionN = "";
        $arrfiliacion = array();
        $paciente = "";
        $clase_vivienda = "";
        $clase_raza = "";
        $telefono = "";
        $celular = "";
        $celular2 = "";
        $email = "";
        $nombre_colegio = "";
        $vapellido_pat = "";
        $vapellido_mat = "";
        $vnombre = "";
        $fecha_nacimiento = "";
        $edadpaciente = "";
        $nombre_tipo_via = "";
        $nombre_tipo_centro_poblado = "";
        $numero = "";
        $manzana = "";
        $lote = "";
        $kilometro = "";
        $observaciones = "";
        $vReferencia = "";
        $nro_historia_clinica = "";
        $txt_hijos = "";
        $txtNroHijos = "";
        require_once("../../cvista/admision/vregistro_personas.php");
    }

    public function recuperarRuta($ruta) {
        $o_Lpersona = new LPersona();
        $resultado = $o_Lpersona->recuperarRuta($ruta);
        return $resultado;
    }

    public function actualizarFotoPersona($codPersona, $nomFoto) {
        $o_Lpersona = new LPersona();
        $resultado = $o_Lpersona->actualizarFotoPersona($codPersona, $nomFoto);
        return $resultado;
    }

    /* public function listaPersonas($opcion,$patron,$funcionJavaScript=''){
      $o_Lpersona = new LPersona();
      $arrayFilas = $o_Lpersona->getArrayPersonas($opcion,$patron);
      $arrayCabecera = array('0'=>"CODIGO","1"=>"NOMBRES","3"=>"FECHA NAC","9"=>"Documento DNI");
      $o_Tabla = new Tabla($arrayCabecera,$arrayFilas,'fila1','fila2','filaEncima','filaCabecera',0,$funcionJavaScript);
      $tablaHTML = $o_Tabla->getTabla();
      return $tablaHTML;
      } */

    /* public function listaPersonasAdmision($opcion,$patron){
      $o_Lpersona = new LPersona();
      $arrayFilas = $o_Lpersona->listaPersonasAdmision($opcion,$patron);
      $arrayCabecera = array('0'=>"CODIGO","1"=>"NOMBRE","13"=>"DNI","3"=>"FILIACION ACTIVA");
      $o_Tabla = new Tabla1($arrayCabecera,15,$arrayFilas,'tablaOrden','fila1','fila2','filaSeleccionada','OnClick','setDatosPersonasAdmision',0);
      $tablaHTML = $o_Tabla->getTabla();
      return $tablaHTML;
      } */

    /* public function listaPersonasAdmisionporcampo($p2,$p3,$p4,$p5){
      $patron = trim($p2)." ".trim($p3)." ".trim($p5);
      $o_Lpersona = new LPersona();
      $arrayFilas = $o_Lpersona->getArrayPersonasporcampo($patron);
      header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
      header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
      header("Pragma: no-cache"); // HTTP/1.0
      sleep(2);
      header("Content-Type: text/xml");
      $tablaXML="<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
      $tablaXML.="<results>";
      for ($i=0;$i<count($arrayFilas);$i++){
      $tablaXML.="<rs id=\"".$arrayFilas[$i]['id']."\" info=\"".$arrayFilas[$i]['info']."\">".$arrayFilas[$i]['value']."</rs>";
      }
      $tablaXML.="</results>";
      return $tablaXML;
      } */

//Busqueda de personas por apellido paterno y materno.
    public function listaPersonasAdmisionxApellidos($paterno, $materno) {
        $o_Lpersona = new LPersona();
        $arrayFilas = $o_Lpersona->listaPersonasAdmisionxApellidos($paterno, $materno);
        $cantidad = count($arrayFilas);
        $tablaHTML = "";
        if ($cantidad != 0) {
            $arrayCabecera = array('0' => "", "1" => "", "2" => "");
            $o_Tabla = new Tabla1($arrayCabecera, '', $arrayFilas, '', '', '', '', '', '', 0);
            $tablaHTML = $o_Tabla->getTabla();
        }
        return $tablaHTML;
    }

    /* public function listaPersonasAdmisionpordni($p2,$p3,$p4,$p5){
      $patron=trim($p5);
      $o_Lpersona = new LPersona();
      $arrayFilas = $o_Lpersona->getArrayPersonaspordni($p4,$patron);
      header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
      header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
      header("Pragma: no-cache"); // HTTP/1.0
      sleep(2);
      header("Content-Type: text/xml");
      $tablaXML="<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
      $tablaXML.="<results>";
      for ($i=0;$i<count($arrayFilas);$i++){
      $tablaXML.="<rs id=\"".$arrayFilas[$i]['id']."\" info=\"".$arrayFilas[$i]['info']."\">".$arrayFilas[$i]['value']."</rs>";
      }
      $tablaXML.="</results>";
      return $tablaXML;
      } */

//Busca persona por número y tipo de documento.
    public function validaPersonasDocIdentidad($tipo_documento, $nro_documento) {
        $o_Lpersona = new LPersona();
        $arrayFilas = $o_Lpersona->validaPersonasDocIdentidad($tipo_documento, $nro_documento);
        $resultado = count($arrayFilas);
        return $resultado;
    }

    /* public function validaPersonasAdmisionpordni($p2,$p3,$p4,$p5){
      $patron=trim($p5);
      $o_Lpersona     = new LPersona();
      $arrayFilas     = $o_Lpersona->validaArrayPersonaspordni($p4,$patron);
      $arrayDoc       = $o_Lpersona->sp_lista_tipo_doc_identidad($p4);
      $tipo_documento = $arrayDoc[$p4];
      if(count($arrayFilas)=='0'){
      $tablaXML='';
      }
      elseif(count($arrayFilas)=='1'){
      $tablaXML="<table style='width:280px;' border='1' cellpadding='3' cellspacing='0'>";
      $tablaXML.="<tr>";
      $tablaXML.="<td colspan='2'>Este ".$tipo_documento." se encuentra registrado:</td>";
      $tablaXML.="</tr>";
      $tablaXML.="<tr>";
      $tablaXML.="<td>Codigo</td>";
      $tablaXML.="<td>".$arrayFilas['0']['c_cod_per']."</td>";
      $tablaXML.="</tr>";
      $tablaXML.="<tr>";
      $tablaXML.="<td>Nombre</td>";
      $tablaXML.="<td>".$arrayFilas['0']['nombre']."</td>";
      $tablaXML.="</tr>";
      $tablaXML.="<tr>";
      $tablaXML.="<td>Nacimiento</td>";
      $tablaXML.="<td>".$arrayFilas['0']['d_fecnac']."</td>";
      $tablaXML.="</tr>";
      $tablaXML.="</table>";
      }
      else{
      $tablaXML="<table style='width:280px;' border='1' cellpadding='3' cellspacing='0'>";
      $tablaXML.="<tr>";
      $tablaXML.="<td colspan='2'>Las siguientes personas tienen el mismo ".$tipo_documento."</td>";
      $tablaXML.="</tr>";
      for($i=0;$i<count($arrayFilas);$i++){

      $tablaXML.="<tr>";
      $tablaXML.="<td align='center'>".$arrayFilas[$i]['c_cod_per']."</td>";
      $tablaXML.="<td>".$arrayFilas[$i]['nombre']."</td>";
      $tablaXML.="</tr>";
      }
      $tablaXML.="</table>";
      }


      /*for ($i=0;$i<count($arrayFilas);$i++){
      $tablaXML.="<rs id=\"".$arrayFilas[$i]['id']."\" info=\"".$arrayFilas[$i]['info']."\">".$arrayFilas[$i]['value']."</rs>";
      }
      //return $tablaXML;
      } */

//Devuelve la relación de parentesco (para los derecho habientes) en formato XML.
    public function listaXMLParentesco($valor_defecto) {
        $o_Lpersona = new LPersona();
        $arrayFilas = $o_Lpersona->seleccionarVinculoFamiliar($valor_defecto);
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Pragma: no-cache"); // HTTP/1.0
        sleep(2);
        header("Content-Type: text/xml");
        $tablaXML = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
        $tablaXML.="<resultados>\n";
        foreach ($arrayFilas as $indice => $valor) {
            $tablaXML.="<cParentesco>" . trim($indice) . "</cParentesco>\n";
            $tablaXML.="<vParentesco>" . trim(htmlentities($valor)) . "</vParentesco>\n";
        }
        $tablaXML.="</resultados>\n";
        return $tablaXML;
    }

//Busca a persona por apellido paterno, materno y nombre.
    public function validaPersonasNombres($paterno, $materno, $nombres) {
        $o_Lpersona = new LPersona();
        $arrayFilasnNombre = $o_Lpersona->validaPersonasNombres($paterno, $materno, $nombres);
        $tablaHTML = array();
        $registros = 0;
        if (count($arrayFilasnNombre) >= '1') {
            $registros = 1;
        }
        return $registros;
    }

    /* public function longitudDNI($select,$option){
      $o_Lpersona = new LPersona();
      $longitud   = $o_Lpersona->longitudDNI($select,$option);
      return $longitud;
      } */
    /*
      public function muestraDatosPacienteAdmision($iid_persona){
      $o_LCita = new LCita();
      $o_Persona = new LPersona();
      $paciente = $o_LCita->getObjectPacienteCita($iid_persona);
      $fecha_nacimiento = date("d/m/Y",strtotime($paciente->dfch_nacimiento));
      if($paciente->csexo == 'h') $sexo='HOMBRE'; elseif ($paciente->csexo == 'm') $sexo= 'MUJER';
      $edadpaciente = $o_Persona->formatoEdad($paciente->dfch_nacimiento);
      unset($_SESSION["paciente"]);
      $arrayPaciente=array(
      'iid_persona'=>$paciente->iid_persona,
      'vnombre'=>$paciente->vnombre,
      'vapellido_pat'=>$paciente->vapellido_pat,
      'vapellido_mat'=>$paciente->vapellido_mat,
      'fecha_nacimiento'=>$fecha_nacimiento,
      'csexo'=>$paciente->csexo,
      'iid_estado_civil'=>$paciente->iid_estado_civil,
      'estado_civil'=>$paciente->estado_civil,
      'vnro_doc_identidad'=>$paciente->vnro_doc_identidad,
      'tipo_documento'=>$paciente->tipo_documento,
      'iid_tipo_documento'=>$paciente->iid_tipo_documento,
      'nro_historia_clinica'=>$paciente->nro_historia_clinica,
      'iid_tafiliacion'=>$paciente->iid_tafiliacion,
      'iid_mafiliacion'=>$paciente->iid_mafiliacion,
      'afiliacion'=>$paciente->afiliacion,
      'fecha_nacimiento'=>$fecha_nacimiento,
      'grupo_sanguineo'=>$paciente->grupo_sanguineo,
      'telefono'=>$paciente->telefono,
      'celular'=>$paciente->celular,
      'email'=>$paciente->email,
      'fax'=>$paciente->fax,
      'cid_ubigeo'=>$paciente->cid_ubigeo,
      'cano_ubigeo'=>$paciente->cano_ubigeo,
      'vdireccion'=>$paciente->vdireccion);
      $_SESSION["paciente"]=$arrayPaciente;//Ojo, lo guarda en la sesion
      $scriptJS = "pintarDatosPersonasAdmision('$paciente->iid_persona','$paciente->vnombre','$paciente->vapellido_pat','$paciente->vapellido_mat','$fecha_nacimiento','$sexo','$paciente->iid_estado_civil','$paciente->estado_civil','$paciente->vnro_doc_identidad','$paciente->tipo_documento','$paciente->iid_tipo_documento','$paciente->nro_historia_clinica','$paciente->iid_tafiliacion','$paciente->iid_mafiliacion','$paciente->afiliacion','$fecha_nacimiento','$edadpaciente','$paciente->grupo_sanguineo',
      '$paciente->telefono','$paciente->celular','$paciente->email','$paciente->fax','$paciente->cid_ubigeo','$paciente->cano_ubigeo','$paciente->vdireccion');";
      echo $scriptJS;
      //return $scriptJS;
      } */

//Recupera los datos principales de una persona. La capa lógica de donde obtiene estos valores es LCita, no LAdmisión. $o_LCita->listaDatosPersona
    public function listaDatosPersona($c_cod_per) {
        $o_LCita = new LCita();
        $o_Persona = new LPersona();
        $paciente = $o_LCita->listaDatosPersona($c_cod_per);
        if ($c_cod_per == '') {
            $arrayPaciente = array(
                'iid_persona' => '', 'vNombre' => '', 'vApellidoPaterno' => '',
                'vApellidoMaterno' => '', 'bSexo' => '', 'cNumeroHC' => '', 'dFechaNacimiento' => '', 'vFoto' => '',
                'cEstadoCivil' => '', 'cNivelEducativo' => '',
                'cOcupacionLab' => '', 'cCondicionLab' => '', 'cClaseVivienda' => '',
                'dFechaIngreso' => '', 'cGrupoEtnico' => '', 'dHijos' => '', 'vObservacion' => '', 'cAfiliacion' => '', 'vAfiliacion' => '',
                'cMedioContacto' => '', 'dNumerodeHijo' => ''
            );
        } else {
            
//$fx=strtotime($paciente[0]['dFechaNacimiento']);
//echo $paciente[0]['dFechaNacimiento'];
//$array_nacimiento = date ("Y-m-d", $fx);
//$arrfech_nacimiento=explode("-",$array_nacimiento);
//$fecha_nacimiento=$arrfech_nacimiento[2]."/".$arrfech_nacimiento[1]."/".$arrfech_nacimiento[0];
           // print_r($paciente);
 
            if ($paciente[0]['dFechaNacimiento']=='sindata') {
             //echo 'por akanga';
                $fecha_nacimiento = "";
                $edadpaciente = "";
            } else {
                $fch = $paciente[0]['dFechaNacimiento'];
                $datetime = date_create($fch);
                $fch = date_format($datetime, 'm/d/Y');
                $fecha_nacimiento = date_format($datetime, 'd/m/Y');
                $edadpaciente = $o_Persona->formatoEdad($fch);
            }

            $sexo = ($paciente[0]['bSexo'] == '1') ? 'HOMBRE' : 'MUJER';
            if ($c_cod_per == '') {
                $edadpaciente = "";
                $fecha_nacimiento = "";
            }
            $arrayPaciente = array(
                'iid_persona' => $paciente[0]['c_cod_per'],
                'vNombre' => $paciente[0]['vNombre'],
                'vApellidoPaterno' => $paciente[0]['vApellidoPaterno'],
                'vApellidoMaterno' => $paciente[0]['vApellidoMaterno'],
                'fecha_nacimiento' => $fecha_nacimiento,
                'bSexo' => $paciente[0]['bSexo'],
                'cNumeroHC' => $paciente[0]['cNumeroHC'],
                'fecha_nacimiento' => $fecha_nacimiento,
                //'fecha_nacimiento'      => $fch,
                'edadpaciente' => $edadpaciente,
                'vFoto' => $paciente[0]['vFoto'],
                'cEstadoCivil' => $paciente[0]['cEstadoCivil'],
                'cNivelEducativo' => $paciente[0]['cNivelEducativo'],
                'cOcupacionLab' => $paciente[0]['cOcupacionLab'],
                'cCondicionLab' => $paciente[0]['cCondicionLab'],
                'cClaseVivienda' => $paciente[0]['cClaseVivienda'],
                'dFechaIngreso' => $paciente[0]['dFechaIngreso'],
                'cGrupoEtnico' => $paciente[0]['cGrupoEtnico'],
                'dHijos' => $paciente[0]['dHijos'],
                'vObservacion' => $paciente[0]['vObservacion'],
                'cAfiliacion' => $paciente[0]['cAfiliacion'],
                'vAfiliacion' => $paciente[0]['vDescripcion'],
                'cMedioContacto' => $paciente[0]['cMedioContacto'],
                'dNumerodeHijo' => $paciente[0]['dNumerodeHijo']
            );
        }
        return $arrayPaciente;
    }

//Recupera los contactos de una persona. La capa lógica donde se obtienen estos valores es LCita. $o_LCita->listaDatosPersonaContactos.
    public function listaDatosPersonaContactos($c_cod_per) {
        $o_LCita = new LCita();
        $o_Persona = new LPersona();
        $arrayPaciente = $o_LCita->listaDatosPersonaContactos($c_cod_per);
        if ($c_cod_per == '') {
            $arrayPaciente = array('vTelefono' => '', 'vMovil1' => '', 'vMovil2' => '', 'vEmail' => '');
        }
        return $arrayPaciente;
    }

//Recupera la dirección de una persona. La capa lógica donde se obtienen estos valores es LCita. $o_LCita->listaDatosPersonaDireccion.
    public function listaDatosPersonaDireccion($c_cod_per, $tipo) {
        $o_LCita = new LCita();
        $o_Persona = new LPersona();
        $paciente = $o_LCita->listaDatosPersonaDireccion($c_cod_per, $tipo);
        $filas = count($paciente);
        $arrayPaciente = array();
        if ($c_cod_per == '' || $filas == 0) {
            $arrayPaciente = array('cPais' => '', 'cTipoVia' => '', 'cTipoDeCentroPoblado' => '', 'cUbigeo' => '', 'vNombreTipoVia' => '', 'cManzana' => '', 'cNumeroLote' => '', 'cNumeroVivienda' => '', 'vNombreTipoCentroPoblado' => '', 'vkm' => '', 'vReferencia' => '');
        } else {
            $cPais = $paciente['cPais'];
            $cTipoVia = $paciente['cTipoVia'];
            $cTipoDeCentroPoblado = $paciente['cTipoDeCentroPoblado'];
            $cUbigeo = $paciente['cUbigeo'];
            $vNombreTipoVia = $paciente['vNombreTipoVia'];
            $cManzana = $paciente['cManzana'];
            $cNumeroLote = $paciente['cNumeroLote'];
            $NumeroVivienda = $paciente['cNumeroVivienda'];
            $vNombreTipoCentroPoblado = $paciente['vNombreTipoCentroPoblado'];
            $vkm = $paciente['vkm'];
            $vReferencia = $paciente['vReferencia'];

            $arrayPaciente = array(
                'cPais' => $cPais,
                'cTipoVia' => $cTipoVia,
                'cTipoDeCentroPoblado' => $cTipoDeCentroPoblado,
                'cUbigeo' => $cUbigeo,
                'vNombreTipoVia' => $vNombreTipoVia,
                'cManzana' => $cManzana,
                'cNumeroLote' => $cNumeroLote,
                'cNumeroVivienda' => $NumeroVivienda,
                'vNombreTipoCentroPoblado' => $vNombreTipoCentroPoblado,
                'vkm' => $vkm,
                'vReferencia' => $vReferencia,
            );
        }
        return $arrayPaciente;
    }

//Recupera los documentos de identidad de una persona. La capa lógica donde se obtienen estos valores es LCita. $o_LCita-> listaDatosPersonaDocumentos
    public function listaDatosPersonaDocumentos($c_cod_per, $readonly, $disabled) {
        $o_LCita = new LCita();
        $arrayFilas = $o_LCita->listaDatosPersonaDocumentos($c_cod_per);
        $cantidad = count($arrayFilas);
        $script = "<script>$('divDNI').innerHTML=" . $cantidad . "</script>";
        echo $script;
        $tablaHTML = "";
      //  $tablaHTML = "<table id='tbl_doc' style='width:100%;' border='0' cellpadding='3' cellspacing='0'>";
       // $tablaHTML.= "<tbody>";
        $i = 1;
        if ($c_cod_per == '' || count($arrayFilas) == 0) {
            $cb_tipDc = $this->seleccionarTipoDocumento('0001');
            $imagen = $disabled == '' ? '../../../../medifacil_front/imagen/icono/nuevo_item.png' : '../../../../medifacil_front/imagen/icono/nuevo_item_black.png';
            $cursor = $disabled == '' ? 'cursor:pointer;' : 'cursor:default;';
           // $tablaHTML.= "<tr>";
            $tablaHTML.="<td height='23'  >";
            $tablaHTML.="<select " . $disabled . " onchange='validaTxtNroDoc(1);' name='cbTipoDoc[1]' id='cbTipoDoc[1]' style='width:80px;'>";
            $tablaHTML.=$cb_tipDc;
            $tablaHTML.="</select>";
            $tablaHTML.="</td>";
            $tablaHTML.="<td>";
            $tablaHTML.="<input name='txtNroDocIdent[1]' tabindex=1 onblur='valida_docIdentidad(1);' onkeypress=\"return validFormSaltDNI($('cbTipoDoc[1]').value,this,event,'txtApellidoPat')\"  type='text' style='width:100px;' id='txtNroDocIdent[1]' title='Documento Identidad' maxlength='8' " . $readonly . "/>";
           // $tablaHTML.="&nbsp;<input type='button' name='btnAgregaDni[1]' id='btnAgregaDni[1]' " . $disabled . " value='' style='background:url($imagen) no-repeat;width:18px;height:18px;border:0px;$cursor' onclick='agrega_documento_identidad(\"tbl_doc\",++kk);'>";
            $tablaHTML.="</td>";
            //$tablaHTML.= "</tr>";
            $script = "<script>$('divDNI').innerHTML=1</script>";
            echo $script;
        } else {
            foreach ($arrayFilas as $indice => $valor) {
                $cb_tipDc = $this->seleccionarTipoDocumento($arrayFilas[$i - 1]['cTipoDocumento']);
               // $tablaHTML.= "<tr id='rowTipoDoc" . $i . "'>";
                $tablaHTML.="<td height='23'  valign='top'>";
                $tablaHTML.="<select onchange='validaTxtNroDoc(" . $i . ");' name='cbTipoDoc[" . $i . "]' id='cbTipoDoc[" . $i . "]' style='width:80px;' " . $disabled . ">";
                $tablaHTML.=$cb_tipDc;
                $tablaHTML.="</select>";
                $tablaHTML.="</td>";
                $tablaHTML.="<td>";
                $tablaHTML.="<input name='txtNroDocIdent[" . $i . "]' onblur='valida_docIdentidad(" . $i . ");' onkeypress=\"return validFormSalt('nro',this,event,'txtApellidoPat')\" type='text' " . $readonly . " style='width:100px;' id='txtNroDocIdent[" . $i . "]' value='" . htmlentities(trim($arrayFilas[$i - 1]['vNumeroDocumento'])) . "'  title='Documento Identidad' maxlength='8'/>";
              //  $tablaHTML.= $i == 1 ? "<input type='button' disabled='disabled' name='btnDni[" . $i . "]' id='btnDni[" . $i . "]' value='' style='background:url(../../../../medifacil_front/imagen/icono/nuevo_item_black.png) no-repeat;width:18px;height:18px;border:0px;cursor:default;' onclick='agrega_documento_identidad(\"tbl_doc\",++kk);'>" : "<input type='button' name='btnDni[" . $i . "]' id='btnDni[" . $i . "]' disabled='disabled' value='' style='background:url(../../../imagen/inicio/eliminar_black.gif) no-repeat;width:18px;height:18px;border:0px;cursor:default;' onclick='elimina_fila(" . $i . ");'>";
                $tablaHTML.="</td>";
               // $tablaHTML.="</tr>";
                $i++;
            }
        }
        //$tablaHTML.= "</tbody>";
        //$tablaHTML.="</table>";
        return $tablaHTML;
    }

//Recupera los estudios de una persona. La capa lógica donde se obtienen estos valores es LCita. $o_LCita-> listaDatosPersonaEstudios
    public function listaDatosPersonaEstudios($c_cod_per, $tipo) {
        $o_LCita = new LCita();
        $o_Persona = new LPersona();
        $arrayPaciente = $o_LCita->listaDatosPersonaEstudios($c_cod_per, $tipo);
        if ($c_cod_per == '' || count($arrayPaciente) == 0) {
            $arrayPaciente = array('cIdCentrosDeEstudios' => '', 'vDescripcionCentro' => '', 'cIdGradosDeEstudio' => '', 'vDescripcionGrado' => '', 'cTipoInstitucion' => '');
        }
        return $arrayPaciente;
    }

//Combo estado Civil.
    public function seleccionarEstadoCivil($optionsHTML) {
        $o_Lpersona = new LPersona();
        $arrayCombo = $o_Lpersona->seleccionarEstadoCivil();
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

//Combo Grupo Sanguíneo.
    public function seleccionarGrupoSanguineo($optionsHTML) {
        $o_Lpersona = new LPersona();
        $arrayCombo = $o_Lpersona->seleccionarGrupoSanguineo();
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

//Combo Medios de Contacto.
    public function seleccionarMediosContacto($optionsHTML) {
        $o_Lpersona = new LPersona();
        $arrayCombo = $o_Lpersona->seleccionarMediosContacto();
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

//Combo Tipo de Vía.
    public function seleccionarTipoVia($optionsHTML) {
        $o_Lpersona = new LPersona();
        $arrayCombo = $o_Lpersona->seleccionarTipoVia();
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

//Combo Tipo de Centro Poblado.
    public function seleccionarTipoCentroPoblado($optionsHTML) {
        $o_Lpersona = new LPersona();
        $arrayCombo = $o_Lpersona->seleccionarTipoCentroPoblado();
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

//Combo Grupo Laboral.
    public function seleccionarGrupoLaboral($optionsHTML) {
        $o_Lpersona = new LPersona();
        $arrayCombo = $o_Lpersona->seleccionarGrupoLaboral();
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

//Combo Sub grupo laboral.
    public function seleccionarSubgrupoLaboral($grupo_laboral, $optionsHTML) {
        $o_Lpersona = new LPersona();
        $arrayCombo = $o_Lpersona->seleccionarSubgrupoLaboral($grupo_laboral);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

//Combo Ocupación Laboral.
    public function seleccionarOcupacionLaboral($grupo, $subgrupo, $disabled) {
        $o_Lpersona = new LPersona();
//Grupo
        $arrayCombo = $o_Lpersona->seleccionarGrupoLaboral();
        $o_Combo = new Combo($arrayCombo);
        $comboGrupo = $o_Combo->getOptionsHTML($grupo);
//Subgrupo
        $arrayCombo = $o_Lpersona->seleccionarSubgrupoLaboral($grupo);
        $o_Combo = new Combo($arrayCombo);
        $comboSub = $o_Combo->getOptionsHTML($subgrupo);
        $row_java = "onchange=\"if($('cb_grupolaboral').value!='0000'){myajax.Link('../../ccontrol/control/control.php?p1=combo_ocupaciones&p2='+$('cb_grupolaboral').value,'ocupaciones')}else{myajax.Link('../../ccontrol/control/control.php?p1=combo_ocupaciones&p2=','ocupaciones');}\"";
        $row_ini = "<table border='0' style='width:100%;'><tr><td width='15%'>Grupo";
        $row_med = "</td><td width='25%'>";
        $row_aux = "</td><td width='15%'>Sub-grupo</td><td>";
        $row_fin = "</td></tr></table>";
        $row_grupo = "<select name='cb_grupolaboral' id='cb_grupolaboral' onkeypress=\"return validFormSalt('cbo',this,event,'cb_subgrupolaboral')\" " . $disabled . " style=\"width:180px\" " . $row_java . ">";
        $row_sub = "<select name='cb_subgrupolaboral' id='cb_subgrupolaboral' onkeypress=\"return validFormSalt('cbo',this,event,'cb_condicion')\" " . $disabled . " style=\"width:200px\">";
        $row_fin_cb = "</select>";
        $comboHTML = $row_ini . $row_med . $row_grupo . $comboGrupo . $row_fin_cb . $row_aux . $row_sub . $comboSub . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

    /* public function listaDatosPersona2($optionsHTML,$iid_dato_nivel1){
      $o_Lpersona = new LPersona();
      $arrayCombo = $o_Lpersona->getArrayPersonasDatos($iid_dato_nivel1);
      $o_Combo = new Combo($arrayCombo);
      $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
      return $comboHTML;
      } */

//Combo Tipos de Documento.
    public function seleccionarTipoDocumento($iid_dato_nivel1) {
        $o_Lpersona = new LPersona();
        $arrayCombo = $o_Lpersona->seleccionarTipoDocumento('0000'); //Dentro se colocan los campos que no se quieren recoger
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($iid_dato_nivel1);
        return $comboHTML;
    }

//Tipos de documento en formato XML
    public function listaXMLDocumentoIdentidad($cadDocs) {
        $o_Lpersona = new LPersona();
        $arrayFilas = $o_Lpersona->seleccionarTipoDocumento($cadDocs);
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Pragma: no-cache"); // HTTP/1.0
        sleep(2);
        header("Content-Type: text/xml");
        $tablaXML = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
        $tablaXML.="<resultados>";
        foreach ($arrayFilas as $indice => $valor) {
            $tablaXML.="<tipodoc>" . $indice . "</tipodoc>";
            $tablaXML.="<nombredoc>" . $valor . "</nombredoc>";
        }
        $tablaXML.="</resultados>";
        return $tablaXML;
    }

//Lista los tipos de documentos de identidad en una tabla.
    public function listaDocumentoIdentidad($c_cod_per) {
        $o_Lpersona = new LPersona();
        $arrayFilas = $o_Lpersona->listaDocumentoIdentidad($c_cod_per);
        $arrayCabecera = array('0' => '', '1' => '', '2' => '');
        $o_Tabla = new Tabla($arrayCabecera, $arrayCabecera, 'fila1', 'fila2', 'filaEncima', 'filaCabecera', 0);
        $tablaHTML = $o_Tabla->getTabla();
        $row_ini = "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
        $row_fin = "</table";
        return $row_ini . $tablaHTML . $row_fin;
    }

    /* public function lista_tipo_doc_identidad($p,$c_cod_per){
      $o_Lpersona    = new LPersona();
      $array_tipoDoc = $o_Lpersona->getArrayPersonaspordni($c_cod_per);

      } */

//Combo clase de raza.
    public function seleccionarClaseRaza($optionsHTML) {
        $o_Lpersona = new LPersona();
        $arrayCombo = $o_Lpersona->seleccionarClaseRaza($optionsHTML);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

//Combo Grado de Instruccion
    public function seleccionarGradoInstruccion($optionsHTML) {
        $o_Lpersona = new LPersona();
        $arrayCombo = $o_Lpersona->seleccionarGradoInstruccion($optionsHTML);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

//Combo Condicion laboral.
    public function seleccionarCondicionLaboral($optionsHTML) {
        $o_Lpersona = new LPersona();
        $arrayCombo = $o_Lpersona->seleccionarCondicionLaboral($optionsHTML);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

//Combo Clase Vivienda
    public function seleccionarClaseVivienda($optionsHTML) {
        $o_Lpersona = new LPersona();
        $arrayCombo = $o_Lpersona->seleccionarClaseVivienda($optionsHTML);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

    /* public function listaOcupacionLaboral($optionsHTML){
      $o_Lpersona = new LPersona();
      $arrayCombo = $o_Lpersona->listaOcupacionLaboral($optionsHTML);
      $o_Combo = new Combo($arrayCombo);
      $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
      return $comboHTML;
      } */

//Combo Tipo de Institución Educativa.
    public function seleccionarTipoInstEducativa($optionsHTML) {
        $o_Lpersona = new LPersona();
        $arrayCombo = $o_Lpersona->seleccionarTipoInstEducativa($optionsHTML);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

//Combo Institución Educativa.
    public function seleccionarInstEducativa($optionsHTML, $tipoInstitucion) {
        $o_Lpersona = new LPersona();
        $arrayCombo = $o_Lpersona->seleccionarInstEducativa($tipoInstitucion);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

//Combo Grado de Estudio.
    public function seleccionarGradoEstudio($optionsHTML, $tipoInstitucion) {
        $o_Lpersona = new LPersona();
        $arrayCombo = $o_Lpersona->seleccionarGradoEstudio($tipoInstitucion);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

//Como Institucion educativa con la etiqueta select (Verificar si se usa).
    public function listaInstEducativa($optionsHTML, $tipoInstitucion) {
        $tablaHTML = "<select name=\"cb_InstEduc\" id=\"cb_InstEduc\"  style=\"width:180px;\"  onchange=\"validFormSalt('cbo',this,event,'txtTelefono');\" onkeypress=\"return validFormSalt('alf',this,event,'txtOcupacion')\">";
        $tablaHTML.=$this->seleccionarInstEducativa($optionsHTML, $tipoInstitucion);
        $tablaHTML.="</select>";
        return $tablaHTML;
    }

//Combo Grados de Estudio con la etiqueta select(Verificar si se usa).
    public function listaGradoEstudio($optionsHTML, $tipoInstitucion) {
        $tablaHTML = "<select name=\"cb_grado_estudio\" id=\"cb_grado_estudio\"  style=\"width:180px;\"  onchange=\"validFormSalt('cbo',this,event,'cb_instruccion');\" onkeypress=\"return validFormSalt('alf',this,event,'txtOcupacion')\">";
        $tablaHTML.=$this->seleccionarGradoEstudio($optionsHTML, $tipoInstitucion);
        $tablaHTML.="</select>";
        return $tablaHTML;
    }

//Combo medios de contacto.
    public function listaMediosDeContacto($optionsHTML) {
        $o_Lpersona = new LPersona();
        $arrayCombo = $o_Lpersona->listaMediosDeContacto($optionsHTML);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

//Combo tipos de documento.
    public function listaTiposDeDocumento($optionsHTML) {
        $o_Lpersona = new LPersona();
        $arrayCombo = $o_Lpersona->listaTiposDeDocumento($optionsHTML);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

//Combo tipos de dirección (vivienda, nacimiento)
    public function listaTiposDeDireccion($optionsHTML) {
        $o_Lpersona = new LPersona();
        $arrayCombo = $o_Lpersona->listaTiposDeDireccion($optionsHTML);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
        return $comboHTML;
    }

    /* public function listaNombreColegio($optionsHTML){
      $o_Lpersona = new LPersona();
      $arrayCombo = $o_Lpersona->listaNombreColegio($optionsHTML);
      $o_Combo = new Combo($arrayCombo);
      $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
      return $comboHTML;
      } */

//Recibe todos los valores de un formulario para editar o insertar un registro.
    public function MantenimientoPersonas($parametros) {
        $p_acc = $parametros["p_acc"];                                                                 //accion
        $p_iid = $parametros["txtCodigoPersona"];                                                      //iid_persona
        $arrP['p2'] = $parametros["txtNroDocIdent"];                                                        //vnro_doc_identidad
        $arrP['p3'] = $parametros["cbTipoDoc"];                                                             //tipo_documento
        $arrP['p4'] = trim(strtoupper($parametros["txtApellidoPat"]));                                      //vapellido_pat
        $arrP['p5'] = trim(strtoupper($parametros["txtApellidoMat"]));                                      //vapellido_mat
        $arrP['p6'] = trim(strtoupper($parametros["txtNombrePaciente"]));                                   //vnombre
        $arrP['p7'] = trim($parametros["txtFechaNacimiento"]);                                             //$fecha_nacimiento
        $arrP['p8'] = trim($parametros["txtEdad"]);                                                         //$edadpaciente
        $arrP['p9'] = $parametros["sexo"];                                                                  //$sexo
        $arrP['p10'] = $parametros['cb_civil'];                                                              //iid_estado_civil(iddato,idvalor,valor)
        $arrP['p11'] = trim($parametros["txtTelefono"]);                                                     //telefono
        $arrP['p12'] = trim($parametros["txtCelular"]);                                                      //celular
        $arrP['p13'] = trim($parametros["txtCelular2"]);                                                     //Celular2
        $arrP['p14'] = trim($parametros["txtEmail"]);                                                 //email
        $arrP['p15'] = $parametros["cb_departamento"] . $parametros["cb_provincia"] . $parametros["cb_distrito"]; //cid_ubigeo
        $arrP['p16'] = $parametros["cb_via"];                                                                //Tipo de via
        $arrP['p17'] = trim(strtoupper($parametros["txtNombreTipoVia"]));                                    //Nombre de Tipo de via
        $arrP['p18'] = $parametros["cb_cpo"];                                                                //Tipo de Centro Poblado
        $arrP['p19'] = trim(strtoupper($parametros["txtTipoCentroPoblado"]));                                //Nombre de Centro de Poblado
        $arrP['p20'] = trim($parametros["txtNumero"]);                                                       //Numero de la Vivienda
        $arrP['p21'] = trim(strtoupper($parametros["txtManzana"]));                                          //Manzana de la direccion
        $arrP['p22'] = trim($parametros["txtLote"]);                                                         //Numero de lote
        $arrP['p23'] = trim($parametros["txtKm"]);                                                           //Numero en kilometros
        $arrP['p24'] = trim($parametros["txtNroHistoria"]);                                                  //nro_historia_clinica
        $arrP['p25'] = $parametros["cb_raza"];                                                               //cid raza
        $arrP['p26'] = substr($parametros["cbNac_departamento"] . $parametros["cbNac_provincia"] . $parametros["cbNac_distrito"], 0, 6);   //Lugar de nacimiento
        $arrP['p27'] = $parametros["cb_grupolaboral"];                                                       //id grupo laboral
        $arrP['p28'] = $parametros["cb_subgrupolaboral"];                                                    //id subGrupo laboral
        $arrP['p29'] = $parametros["cb_condicion"];                                                          //id condicion laboral
        $arrP['p30'] = $parametros["cb_instruccion"];                                                        //id_grado de instruccion
        $arrP['p31'] = $parametros["cb_tipoInstEduc"];                                                        //Tipo de institucion educativa
        $arrP['p32'] = $parametros["cb_InstEduc"];                                                           //combo Nombre institucion educativa
        $arrP['p33'] = $parametros["cb_grado_estudio"];                                                      //Grado de estudio
        $arrP['p34'] = $parametros["cb_vivienda"];                                                           //id clase vivienda
        $arrP['p35'] = $parametros["txtHijos"];                                                              //Nro de hijos
        $arrP['p36'] = $parametros["txtNroDeHijo"];                                                          //Numero de hijo
        $arrP['p37'] = $parametros["cb_medio_contacto"];                                                     //combo contacto
        $arrP['p38'] = $parametros["dh_filiacion"];                                                          //AFiliacion de la persona
        $arrP['p39'] = !isset($parametros["codigo"]) ? '' : $parametros["codigo"];                               //Codigo del derecho habiente
        $arrP['p40'] = !isset($parametros["nombre"]) ? '' : $parametros["nombre"];                               //Nombre del derecho habiente
        $arrP['p41'] = !isset($parametros["relacion"]) ? '' : $parametros["relacion"];                           //Parentesco con el titular
        $arrP['p42'] = trim(strtoupper($parametros["txtObservaciones"]));                                    //Observaciones generales
        $arrP['p43'] = $parametros["txtFotografia"]; //Foogrfia.
        $arrP['p44'] = $parametros["vReferencia"];
        $arrP['p45'] = $parametros["cb_pais"];
        $arrP['p46'] = $parametros["cbNac_pais"] == '0000' ? '9589' : $parametros["cbNac_pais"];
//echo "pais naci".$arrP['p46'];
        $o_Lpersona = new LPersona();
        $result = $o_Lpersona->mantenimiento_Personas($p_acc, $p_iid, $arrP);
        return $result;
    }

//Combo del ubigeo, muestra departamento, provincia y distrito.
    public function listaDatosComboUbigeo($pais, $dep_ubi, $pro_ubi, $dis_ubi, $disabled) {
//$pais='9589';
        $o_Lpersona = new LPersona();
        $arrayCombo = $o_Lpersona->getArraylistaDatosUbigeoDep($pais);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML_01 = $o_Combo->getOptionsHTML($dep_ubi);

        $arrayCombo = $o_Lpersona->getArraylistaDatosUbigeoProv('', $dep_ubi);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML_02 = $o_Combo->getOptionsHTML($pro_ubi);

        $arrayCombo = $o_Lpersona->getArraylistaDatosUbigeoDist('', $dep_ubi, $pro_ubi);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML_03 = $o_Combo->getOptionsHTML($dis_ubi);

        $arrayCombo = $o_Lpersona->getArraylistaDatosPais();
        $o_Combo = new Combo($arrayCombo);
        $comboHTML_pais = $o_Combo->getOptionsHTML($pais);
//$comboHTML_pais='lista pais';
        $row_ochg = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=combo_ubigeo&p2=&p3='+document.getElementById('cb_departamento').value+'&p4='+document.getElementById('cb_provincia').value+'&p5='+document.getElementById('cb_pais').value,'ubigeo');\"";

        $row_ochg_pais = "onchange=ubigeoPais();";
        $row_ini = "<table><tr><td>Pais*</td><td>Departamento*</td><td>Provincia*</td><td>Distrito*</td></tr><tr><td>";
        $row_med = "</td><td>";
        $row_fin = "</td></tr></table>";
        $row_pais = "<select tabindex=13 name=\"cb_pais\" onkeypress=\"return validFormSalt('cbo',this,event,'cb_departamento')\" $disabled id=\"cb_pais\" " . $row_ochg_pais . " title=\"pais\" style=\"width:120px; \"  >";
        $row_depa = "<select tabindex=14 name=\"cb_departamento\" onkeypress=\"return validFormSalt('cbo',this,event,'cb_provincia')\" $disabled id=\"cb_departamento\" " . $row_ochg . " title=\"Departamento\">";
        $row_prov = "<select tabindex=15 name=\"cb_provincia\" onkeypress=\"return validFormSalt('cbo',this,event,'cb_distrito')\" $disabled id=\"cb_provincia\"" . $row_ochg . " style=\"width:100px\" title=\"Provincia\">";
        $row_dist = "<select tabindex=16 name=\"cb_distrito\" onkeypress=\"return validFormSalt('cbo',this,event,'cb_via')\" $disabled id=\"cb_distrito\" title=\"Distrito\">";
        $row_fin_cb = "</select>";

        $comboHTML = $row_ini . $row_pais . $comboHTML_pais . $row_fin_cb . $row_med . $row_depa . $comboHTML_01 . $row_fin_cb . $row_med . $row_prov . $comboHTML_02 . $row_fin_cb . $row_med . $row_dist . $comboHTML_03 . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

//Combo del ubigeo de nacimiento, muestra departamento, provincia y distrito.
    public function listaDatosComboNacimiento($paisNacimiento, $dep_ubi, $pro_ubi, $dis_ubi, $disabled) {
        $o_Lpersona = new LPersona();
        $arrayCombo = $o_Lpersona->getArraylistaDatosUbigeoDep($paisNacimiento);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML_01 = $o_Combo->getOptionsHTML($dep_ubi);

        $arrayCombo = $o_Lpersona->getArraylistaDatosUbigeoProv('', $dep_ubi);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML_02 = $o_Combo->getOptionsHTML($pro_ubi);

        $arrayCombo = $o_Lpersona->getArraylistaDatosUbigeoDist('', $dep_ubi, $pro_ubi);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML_03 = $o_Combo->getOptionsHTML($dis_ubi);

        $arrayCombo = $o_Lpersona->getArraylistaDatosPais();
        $o_Combo = new Combo($arrayCombo);
        $comboHTML_pais = $o_Combo->getOptionsHTML($paisNacimiento);

        $row_ochg_pais = "onchange=ubigeoPaisNacimiento();";
        $row_ochg = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=combo_nacimiento&p2=&p3='+document.getElementById('cbNac_departamento').value+'&p4='+document.getElementById('cbNac_provincia').value+'&p5='+document.getElementById('cbNac_pais').value,'ubigeo2');\"";
        $row_ini = "<table><tr><td>Departamento*</td><td>Provincia*</td><td>Distrito*</td></tr><tr><td>";
        $row_med = "</td><td>";
        $row_fin = "</td></tr></table>";
        $row_pais = "<select tabindex=13 name=\"cbNac_pais\" onkeypress=\"return validFormSalt('cbo',this,event,'cbNac_departamento')\" $disabled id=\"cbNac_pais\" " . $row_ochg_pais . " title=\"pais\" style=\"width:120px; \"  >";
        $row_depa = "<select name=\"cbNac_departamento\" onkeypress=\"return validFormSalt('cbo',this,event,'cbNac_provincia')\" $disabled id=\"cbNac_departamento\" " . $row_ochg . ">";
        $row_prov = "<select name=\"cbNac_provincia\"  onkeypress=\"return validFormSalt('cbo',this,event,'cbNac_distrito')\" $disabled id=\"cbNac_provincia\"" . $row_ochg . " style=\"width:100px\">";
        $row_dist = "<select name=\"cbNac_distrito\" onkeypress=\"return validFormSalt('txt',this,event,'cb_grupolaboral')\" $disabled id=\"cbNac_distrito\">";
        $row_fin_cb = "</select>";
//$comboHTML = $row_ini . $row_depa . $comboHTML_01 . $row_fin_cb . $row_med . $row_prov . $comboHTML_02 . $row_fin_cb . $row_med . $row_dist . $comboHTML_03 . $row_fin_cb . $row_fin;
        $comboHTML = $row_ini . $row_pais . $comboHTML_pais . $row_fin_cb . $row_med . $row_depa . $comboHTML_01 . $row_fin_cb . $row_med . $row_prov . $comboHTML_02 . $row_fin_cb . $row_med . $row_dist . $comboHTML_03 . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

    /* public function listaAnioUbigeo(){
      $o_Lpersona = new LPersona();
      $respuestaAnio = $o_Lpersona->getArraylistaAnioUbigeo();
      return $respuestaAnio;
      } */

///////////////////////////////////////////////////////////////// Afiliaciones /////////////////////////////////////////////////
//Muestra la pantalla de Filiaciones de un paciente. Además llama a los siguientes métodos:(ListaDatoPersona,FiliacionesPaciente,ListaDerHabienteFiliacion)
    public function filiacionesPacienteVent($iid_persona, $cAfiliacion) {
        $strAfiliacion = "";
        if ($cAfiliacion == '') {
            $o_LCita = new LCita();
            $arrAfiliacion = $o_LCita->listaDatosPersonaAfiliacion($iid_persona);
            $cAfiliacion = $arrAfiliacion[0]['cAfiliacion'];
            $strAfiliacion = $arrAfiliacion[0]['vDescripcion'];
        }
        $tipo_dato = $this->ListaDatoPersona("0013");
        $filiacionN = $this->FiliacionesPaciente($iid_persona, $cAfiliacion);
        $derHabiente = $this->ListaDerHabienteFiliacion($iid_persona, $cAfiliacion, $strAfiliacion);
        require_once("../../cvista/admision/filiacion_personas.php");
    }

//Muestra la afiliaciones activas y las afiliaciones disponibles de un paciente en una tabla(listaFiliacionPaciente,listaNoFiliacionPaciente)
    public function FiliacionesPaciente($paciente, $cAfiliacion) {
        $filiacion = $this->listaFiliacionPaciente($paciente, $cAfiliacion);
        $no_filiacion = $this->listaNoFiliacionPaciente($paciente);
        $html_table = "<table border='0' width='100%'><tr><td width='45%'>" .
                "<fieldset><legend>FILIACIONES DEL PACIENTE</legend>" .
                "<div style='height:150px; overflow:scroll; overflow-x:hidden; border: 1px solid #CCCCCC;'>" .
                $filiacion .
                "</div>" .
                "</fieldset>" .
                "<td width='10%'>&nbsp;</td><td width='45%'>" .
                "<fieldset><legend>NO FILIACIONES DEL PACIENTE</legend>" .
                "<div style='height:150px; overflow:scroll; overflow-x:hidden; border: 1px solid #CCCCCC;'>" .
                $no_filiacion .
                "</div>" .
                "</fieldset>" .
                "</td></tr></table>";
        return $html_table;
    }

//Muestra las filiaciones de un paciente.
    public function listaFiliacionPaciente($c_cod_per, $cAfiliacion) {
        $o_Lpersona = new LPersona();
        $arrayFilas = $o_Lpersona->listaFiliacionPaciente($c_cod_per, $cAfiliacion);
        $arrayCabecera = array('1' => "FILIACION", "6" => "ESTADO", "5" => "D.HABIENTE");
        $o_Tabla = new Tabla($arrayCabecera, $arrayFilas, 'fila1', 'fila2', 'filaEncima', 'filaCabecera', 0);
        $tablaHTML = $o_Tabla->getTabla();
        $row_ini = "<table id='tblFiliPac' width='100%' border='0' cellpadding='0' cellspacing='0'>";
        $row_fin = "</table>";
        return $row_ini . $tablaHTML . $row_fin;
    }

//Muestra las filiaciones disponibles de un paciente.
    public function listaNoFiliacionPaciente($paciente) {
        $o_Lpersona = new LPersona();
        $arrayFilas = $o_Lpersona->listaNoFiliacionPaciente($paciente);
        $arrayCabecera = array('1' => "FILIACION", "2" => "AGREGAR");
        $o_Tabla = new Tabla($arrayCabecera, $arrayFilas, 'fila1', 'fila2', 'filaEncima', 'filaCabecera', 0);
        $tablaHTML = $o_Tabla->getTabla();
        $row_ini = "<table id='tblNoFiliPac' width='100%' border='0' cellpadding='0' cellspacing='0'>";
        $row_fin = "</table>";
        return $row_ini . $tablaHTML . $row_fin;
    }

//Permite insertar o actualizar una filiación para una persona o un derecho habiente.
    public function MantenimientoFiliacion($op_bd, $iafil, $ipers, $ipare, $btitu, $ipe_r, $bacti, $besta, $dvi_i, $dvi_f, $bcadu) {
        $o_Lpersona = new LPersona();
        $usuario = strtoupper($_SESSION['login_user']);
        $respuesta = $o_Lpersona->MantenimientoFiliacion($op_bd, $iafil, $ipers, $ipare, $btitu, $ipe_r, $bacti, $besta, $dvi_i, $dvi_f, $bcadu);
        return $respuesta;
    }

    public function listaAfiliacionPrecio($parametros) {
        $o_LPersona = new LPersona();
        $resultado = $o_LPersona->listaAfiliacionPrecio($parametros);
        return $resultado;
    }

/////////////////////////////////////////////////////// DERECHO HABIENTES  ////////////////////////////////////////////////////////////
//Muestra en una tabla los derecho habientes para una afiliación que lo permita.
    public function ListaDerHabienteFiliacion($c_cod_per, $cAfiliacion, $filiacion) {
        $o_Lpersona = new LPersona();
        $arrayFilas = $o_Lpersona->ListaDerHabienteFiliacion($c_cod_per, $cAfiliacion);
        $numDerHab = count($arrayFilas);
        $arrayCabecera = array("0" => "CODIGO", "2" => "NOMBRE", "8" => "HABIENTE", '9' => "ELIMINAR");
        $o_Tabla = new Tabla($arrayCabecera, $arrayFilas, 'fila1', 'fila2', 'filaEncima', 'filaCabecera', 1);
        $tablaHTML = $o_Tabla->getTabla();
        $row_icon = "";
        $row_ini = "<table id='tblDerHab' width='100%' border='1' cellpadding='0' cellspacing='0'>";
        $row_fin = "</table>";
        $row_fin .= "<span><input type='text' name='numDerHab' id='numDerHab' value='" . $numDerHab . "'></span>";
//$row_fin        .= "<div id='Div_formBuscadorPersonas'></div>";
        return $row_icon . $row_ini . $tablaHTML . $row_fin;
    }

    /* public function MantenimientoDerechoHabiente($op_bd,$iafil,$ipers,$ipare,$btitu,$ipe_r,$bacti,$besta,$dvi_i,$dvi_f,$bcadu,$ipe_rsexo){
      $o_Lpersona = new LPersona();
      $usuario=strtoupper($_SESSION['login_user']);
      $respuesta  = $o_Lpersona->MantenimientoDerechoHabiente($op_bd,$usuario,$iafil,$ipers,$ipare,$btitu,$ipe_r,$bacti,$besta,$dvi_i,$dvi_f,$bcadu,$ipe_rsexo);
      return $respuesta;
      } */

    /* public function muestraDatosDerechoHabiente($iid_persona){
      $o_LCita = new LCita();
      $paciente = $o_LCita->getObjectPacienteCita($iid_persona);
      $scriptJS = "pintarDerechoHabiente('".$paciente[0]['c_cod_per']."','".$paciente[0]['v_nomper']."','".$paciente[0]['v_apepat']."','".$paciente[0]['v_apemat']."','".trim($paciente[0]['c_ndide'])."','".$paciente[0]['b_sexo']."');";
      return $scriptJS;
      } */

    /* public function listaDerechoHabiente($parametros){
      $o_Lpersona = new LPersona();
      $opcion=$parametros["p2"];
      $patron=$parametros["p3"];
      $arrayFilas = $o_Lpersona->getArrayPersonas($opcion,$patron);
      $arrayCabecera = array('0'=>"CODIGO","1"=>"NOMBRE","9"=>"FECHA NAC","3"=>"DNI");
      $oTabla = new Tabla1($arrayCabecera,20,$arrayFilas,'tablaOrden','fila2','fila2','filaSeleccionada','ondblclick',$parametros["funcionJSEjecutar"],0);
      $oTabla->setOcultarColumnas(array("2","4","5","6","7","8"));
      $oTabla->setColumnasOrdenar(array("0","1","9"));
      $tablaHTML = $oTabla->getTabla();
      return $tablaHTML;
      } */

//Combo relación de parentesco.
    public function seleccionarVinculoFamiliar($iid_dato_nivel) {
        $o_Lpersona = new LPersona();
        $arrayCombo = $o_Lpersona->seleccionarVinculoFamiliar();
        $o_Combo = new Combo($arrayCombo);
        $nivel = '';
        $comboHTML = $o_Combo->getOptionsHTML($iid_dato_nivel);
        return $comboHTML;
    }

    /* public function muestraDatosContribuyente($iid_persona){
      $o_LCita = new LCita();
      $paciente = $o_LCita->getObjectPacienteCita($iid_persona);
      //$scriptJS = "pintarContribuyente();";
      return 1;
      } */

    public function mostrar_datos_paciente($iid_persona) {
        return 1;
    }

    public function mostrarVentanaHistoriaClinica() {
        require_once("../../cvista/admision/vHistoriaClinica.php");
    }

    public function genera_historia() {
        $o_Lpersona = new LPersona();
        $historia = $o_Lpersona->genera_historia();
        return $historia;
    }

//Caja del buscador de personas
    function formBuscardorPersonas($parametros) {
        $o_LPersona = new ActionPersona();
        $funcion = $parametros["funcionJSEjecutar"];
        $comboTipoDocumentos = $o_LPersona->comboTipoDocumento('1');
        $obtenerPersonas = $o_LPersona->obtenerPersonas('', '', '', $funcion);
        require_once("../../cvista/busqueda/buscador_personas.php");
    }

    function formBuscardorContribuyentes($parametros) {
        require_once("../../cvista/busqueda/buscador_contribuyentes.php");
    }

    function formPopupDatosC($parametros) {
        $capa = $parametros['p2']; //Nombre de la capa
        $texto = $parametros['p3']; //Nombre del campo texto
        $txt_civil_obs = $parametros['p4']; //Valor
        $titulo = $parametros['p5']; //Titulo
        $chk = $parametros['p6']; //Checked
        $readonly = "";
        $textarea = "txtArea" . $texto;
        $oHtml = "
                OBSERVACIONES " . $titulo . "
                <a href='#' onclick=\"document.getElementById('$texto').value=$('txtArea" . $texto . "').value;$('$capa').hide();\"><img src='../../../imagen/alphacube/button-close-focus.gif' class='close' alt='close'/></a>
                <div id='master'>
                    <label>
                        <textarea name='txtArea" . $texto . "' id='txtArea" . $texto . "' cols='28' rows='2' " . $readonly . ">" . $txt_civil_obs . "</textarea><br>
                        <button type='button' id='rec' style='font-size:10px;' onclick=\"document.getElementById('$texto').value=$('txtArea" . $texto . "').value;$('$capa').hide();\">GRABAR</button>
                    </label>
                </div>
                ";
        return $oHtml;
    }

    function listaPersonasSimedh($parametros) {
        $o_Lpersona = new LPersona();
        $opcion = $parametros["p2"];
        $patron = $parametros["p3"];
        $arrayFilas = $o_Lpersona->getArrayPersonas($opcion, $patron);
        $arrayCabecera = array('0' => "CODIGO", "1" => "NOMBRE", "9" => "FECHA NAC", "3" => "DNI");
        $oTabla = new Tabla1($arrayCabecera, 20, $arrayFilas, 'tablaOrden', 'fila2', 'fila2', 'filaSeleccionada', 'ondblclick', $parametros["funcionJSEjecutar"], 0);
        $oTabla->setOcultarColumnas(array("2", "4", "5", "6", "7", "8"));
        $oTabla->setColumnasOrdenar(array("0", "1", "9"));
        $tablaHTML = $oTabla->getTabla();
        return $tablaHTML;
    }

    function listaContribuyenteSimedh($parametros) {
        $o_Lpersona = new LPersona();
        $opcion = $parametros["p2"];
        $patron = $parametros["p3"];
        $arrayFilas = $o_Lpersona->getArrayContribuyentes($opcion, $patron);
        $arrayCabecera = array('0' => "COD.CONTRIB.", "1" => "NOMBRE", "2" => "SITUACION");
        $oTabla = new Tabla1($arrayCabecera, 20, $arrayFilas, 'tablaOrden', 'fila2', 'fila2', 'filaSeleccionada', 'ondblclick', $parametros["funcionJSEjecutar"], 0);
//$oTabla->setOcultarColumnas(array("2","4","5","6","7","8"));
        $oTabla->setColumnasOrdenar(array("0", "1", "2"));
        $tablaHTML = $oTabla->getTabla();
        return $tablaHTML;
    }

    public function fn_mante_paswd($p) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->fn_mante_paswd($p['id_persona'], $p['iid_sistema'], sha1(trim($p['pass_actual'])), sha1(trim($p['nuevo_pass'])));
        $mensaje0 = "<span class='anulado'>LA CONTRASE&Ntilde;A ACTUAL NO COINCIDE</span>";
        $mensaje1 = "<span class='comprometido'>CONTRASE&Ntilde;A ACTUALIZADA CON EXITO!!!</span>";
        $respuesta = $rs[0]['fn_mante_paswd'] == 1 ? $mensaje1 : $mensaje0;
        require_once("../../cvista/opciones/pass_user/resultado.php");
    }

///////////////////RRHH/////////////////////////

    public function getDatosLaborales($iid_persona_ing) {
        $oLRrhh = new LRrhh();
        $array = $oLRrhh->getDatosLaborales($iid_persona_ing);
        return $array;
    }

    public function sp_lista_cargo($sp1) {
        $oLRrhh = new LRrhh();
        $arrayCombo = $oLRrhh->sp_lista_cargo('%');
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($sp1);

        return $comboHTML;
    }

    public function sp_lista_cargo_tipo($sp1) {
        $oLRrhh = new LRrhh();
        $arrayCombo = $oLRrhh->sp_lista_cargo_tipo('%');
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($sp1);

        return $comboHTML;
    }

    public function sp_lista_oficina($sp1) {
        $oLRrhh = new LRrhh();
        $arrayCombo = $oLRrhh->sp_lista_oficina('%', '%');
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($sp1);

        return $comboHTML;
    }

    public function sp_lista_especialidad_cco($sp1, $sp2) {
        $oLRrhh = new LRrhh();
        $arrayCombo = $oLRrhh->sp_lista_especialidad_cco($sp1);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($sp2);
        return $comboHTML;
    }

    public function sp_lista_profesion($sp1) {
        $oLRrhh = new LRrhh();
        $arrayCombo = $oLRrhh->sp_lista_profesion('%');
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($sp1);

        return $comboHTML;
    }

    public function sp_lista_especialidad($sp1, $sp2) {
        $oLRrhh = new LRrhh();

        $arrayCombo = $oLRrhh->sp_lista_especialidad($sp1, $sp2);

        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($sp2);

        return $comboHTML;
    }

    public function sp_lista_cargo_ofic_trab($sp1, $sp2) {
        $oLRrhh = new LRrhh();
        $arrayCombo = $oLRrhh->sp_lista_cargo_ofic_trab($sp1, $sp2);
        return $arrayCombo;
    }

//////////////////////////////CITAS PERSONAS   ////////////////////////////////////
//Personas para citas.
    public function ListaPersonaCitas($c_cod_per) {
        $o_Lpersona = new LPersona();
        $arrayFilas = $o_Lpersona->ListaPersonaCitas($c_cod_per);
        $arrayCabecera = array("0" => "FECHA", "1" => "HORA", "2" => "SERVICIO", '3' => "PROFESIONAL", '4' => "TIPO DE CITA", '5' => "SITUACION", '6' => "ESTADO");
        $o_Tabla = new Tabla($arrayCabecera, $arrayFilas, 'fila1', 'fila2', 'filaEncima', 'filaCabecera', 1);
        $tablaHTML = $o_Tabla->getTabla();
        $row_icon = "";
        $row_ini = "<table id='tblDerHab' width='100%' border='1' cellpadding='0' cellspacing='0'>";
        $row_fin = "</table>";
        return $row_icon . $row_ini . $tablaHTML . $row_fin;
    }

/////////////////////////   hospitalizacion personas //////////////////
//Personas hospitalizads.
    public function ListaPersonaHospitalizacion($c_cod_per) {
        $o_Lpersona = new LPersona();
        $arrayFilas = $o_Lpersona->ListaPersonaHospitalizacion($c_cod_per);
        $cantidad = count($arrayFilas);
        $row_ini = "<table width='100%' border='0' cellpadding='5' cellspacing='0'>";
        $row_fin = "</table>";
        $fIngreso = $cantidad == 0 ? '&nbsp;' : $arrayFilas['fingreso'];
        $fSalida = $cantidad == 0 ? '&nbsp;' : ($arrayFilas['fecsal'] == '' ? '&nbsp;' : $arrayFilas['fecsal']);
        $sede = $cantidad == 0 ? '&nbsp;' : 'HMLO';
        $estado = $cantidad == 0 ? '&nbsp;' : 'HOSPITALIZACION';
        $piso = $cantidad == 0 ? '&nbsp;' : $arrayFilas['piso'];
        $cama = $cantidad == 0 ? '&nbsp;' : $arrayFilas['c_nro_cama'];
        $tablaHTML = "<tr><td width='45%'>" .
                "<fieldset><legend>UBICACION DEL PACIENTE</legend>" .
                "<div style='height:120px; overflow:hidden; overflow-x:hidden;padding:10px;'>" .
                "<table width='100%' border='1' cellpadding='12' cellspacing='0'>" .
                "<tr>" .
                "<td  class='fila1' width='45%' style='font-size:12px;'>Fecha de Ingreso</td>" .
                "<td>" . $fIngreso . "</td>" .
                "</tr>" .
                "<tr>" .
                "<td  class='fila1' width='45%' style='font-size:12px;'>Fecha de Salida</td>" .
                "<td>" . $fSalida . "</td>" .
                "</tr>" .
                "<tr>" .
                "<td  class='fila1' width='45%' style='font-size:12px;'>Sede</td>" .
                "<td>" . $sede . "</td>" .
                "</tr>" .
                "<tr>" .
                "<td  class='fila1' width='45%' style='font-size:12px;'>Estado</td>" .
                "<td>" . $estado . "</td>" .
                "</tr>" .
                "<tr>" .
                "<td  class='fila1' width='45%' style='font-size:12px;'>Ubicacion</td>" .
                "<td>" . $piso . "</td>" .
                "</tr>" .
                "<tr>" .
                "<td  class='fila1' width='45%' style='font-size:12px;'>Cama</td>" .
                "<td>" . $cama . "</td>" .
                "</tr>" .
                "</table>" .
                "</div>" .
                "</fieldset>" .
                "</td></tr>";
        return $row_ini . $tablaHTML . $row_fin;
    }

    public function acreditacionEssalud() {
//$tabla=$this->acreditarBusqueda('');
        require_once("../../cvista/admision/vAcreditacion.php");
    }

    public function getArrayServidoresDisponibles($mascaraSubRedSedeEmpresa) {
        $o_LPersona = new LPersona();
        $mascaraSubRedSedeEmpresa = ($mascaraSubRedSedeEmpresa == '' || $mascaraSubRedSedeEmpresa == null) ? '%' : $mascaraSubRedSedeEmpresa;
        $i = 0;
        $n = 0;

        $arrayFilas = $o_LPersona->spListaIpAcreditacion($mascaraSubRedSedeEmpresa);
        $n = count($arrayFilas);
        $arrayServidores = array();
        $arrayServidoresDisponibles = array();

        $ipServidor = "";
        $rutaHost = realpath("../../../");

        for ($i = 0; $i < $n; $i++) {
            $ipServidor = $arrayFilas[$i]["vNumeroIpAcreditacion"];

            $comandoVerificarConexionServidor = "ping " . "$ipServidor" . " -c 1 -i 1 -W 1";
            $cadenaEjecucion = shell_exec($comandoVerificarConexionServidor);
            $cadenaBuscada = "1 packets transmitted, 1 received, 0% packet loss";
            $posicionCadenaBuscada = strpos($cadenaEjecucion, $cadenaBuscada);
            if ($posicionCadenaBuscada === FALSE) {
//no hago nada
            } else {
                array_push($arrayServidoresDisponibles, $arrayFilas[$i]);
            }
        }
        return $arrayServidoresDisponibles;
    }

    public function getArrayConexionesActivasEssalud($mascaraSubRedSedeEmpresa) {
        $i = 0;
        $n = 0;
        $arrayFilas = $this->getArrayServidoresDisponibles($mascaraSubRedSedeEmpresa);

        $n = count($arrayFilas);
        $arrayConexionesActivas = array();

        $ipServidor = "nada";

//$ipEssalud="172.20.90.19";
        $ipEssalud = "192.168.30";

        $rutaHost = realpath("../../../");

        for ($i = 0; $i < $n; $i++) {
            $ipServidor = $arrayFilas[$i]["vNumeroIpAcreditacion"];
            $comandoVerificarConexionEssalud = "java -jar " . $rutaHost . "/essalud/JarSimedh/ClienteVerificarConexionEssalud.jar " . $ipServidor . " " . $ipEssalud;
            $existeConexionEssalud = shell_exec($comandoVerificarConexionEssalud);
            if ($existeConexionEssalud == 1) {//Cuando no hay conexion arroja excepción
                array_push($arrayConexionesActivas, $arrayFilas[$i]);
            }
        }
        return $arrayConexionesActivas;
    }

    public function verificarConexionEssalud() {
        $ipClienteWeb = $_SERVER['REMOTE_ADDR'];
        $arrayIpClienteWeb = explode(".", $ipClienteWeb);
        $mascaraSubRedSedeEmpresa = $arrayIpClienteWeb[0] . "." . $arrayIpClienteWeb[1] . "." . $arrayIpClienteWeb[2];
        $mascaraSubRedSedePrincipal = "192.168.31";
        $usuario1 = "Usu1";
        $usuario2 = "Usu2";
        $usuario3 = "Usu3";
        $usuario4 = "Usu4";
        $conexion1 = 0;
        $conexion2 = 0;
        $conexion3 = 0;
        $conexion4 = 0;

        $arrayConexionesActivas = array();

        if ($mascaraSubRedSedeEmpresa == $mascaraSubRedSedePrincipal) {//Mascara de la principal que es el HMLO
            $arrayConexionesActivas = $this->getArrayConexionesActivasEssalud($mascaraSubRedSedeEmpresa);
        } else {
            $arrayConexionesActivas = $this->getArrayConexionesActivasEssalud($mascaraSubRedSedeEmpresa);
            if (count($arrayConexionesActivas) == 0) {//En caso de no encontrar conexiones en su sede, busca en el HMLO
                $arrayConexionesActivas = $this->getArrayConexionesActivasEssalud($mascaraSubRedSedePrincipal);
            }
        }

        if (isset($arrayConexionesActivas[0]["vUsuarioIpAcreditacion"])) {
            $usuario1 = $arrayConexionesActivas[0]["vUsuarioIpAcreditacion"];
            $conexion1 = 1;
        }

        if (isset($arrayConexionesActivas[1]["vUsuarioIpAcreditacion"])) {
            $usuario2 = $arrayConexionesActivas[1]["vUsuarioIpAcreditacion"];
            $conexion2 = 1;
        }

        if (isset($arrayConexionesActivas[2]["vUsuarioIpAcreditacion"])) {
            $usuario3 = $arrayConexionesActivas[2]["vUsuarioIpAcreditacion"];
            $conexion3 = 1;
        }

        if (isset($arrayConexionesActivas[3]["vUsuarioIpAcreditacion"])) {
            $usuario4 = $arrayConexionesActivas[3]["vUsuarioIpAcreditacion"];
            $conexion4 = 1;
        }

        $scriptJS = "pintarDatosConexionEssalud('" . $usuario1 . "','" . $conexion1 . "','" . $usuario2 . "','" . $conexion2 . "','" . $usuario3 . "','" . $conexion3 . "','" . $usuario4 . "','" . $conexion4 . "');";
        return $scriptJS;
    }

    function reemplazaCaracteresEspeciales($cadena) {//Reemplaza caracteres especiales por caracteres simples
        $novalido = array("á", "é", "í", "ó", "ú", "ñ", "Á", "É", "Í", "Ó", "Ú", "Ñ", "'");
        $valido = array("a", "e", "i", "o", "u", "n", "A", "E", "I", "O", "U", "N", "");
        $cadena = str_replace($novalido, $valido, $cadena);
        return $cadena;
    }

    public function acreditarBusqueda($datos) {
        include('../../nusoap/nusoap.php');
        $adscripciondepartamental = $datos["adscripciondepartamental"];
        $wsdl = "http://192.168.0.31:8080/siaserv/servlet/agenasegsia?wsdl"; //url del servicio
        $clientEssalud = new nusoap_client($wsdl);
        $operation = "GenAsegSia.Execute";
        $parametros = array(); //parametros de la llamada
        $parametros["Dgactdi"] = $datos['tipoBusqueda'];
        $parametros["Dgandid"] = $datos['dni'];
        $parametros["Dgatapa"] = utf8_decode($datos['apellidoPaterno']);
        $parametros["Dgatama"] = utf8_decode($datos['apellidoMaterno']);
        $parametros["Dgatpno"] = utf8_decode($datos['primerNombre']);
        $parametros["Dgatsno"] = utf8_decode($datos['segundoNombre']);
        $clientEssaludRpta = $clientEssalud->call($operation, $parametros);
        $datosAseguradosXMLcomoString = $clientEssaludRpta["Dato"];
        $datosAseguradosXMLcomoString = str_replace(' xmlns="SiaWebServ"', '', $datosAseguradosXMLcomoString);
        //echo $datosAseguradosXMLcomoString;
        $personas = simplexml_load_string(utf8_encode($datosAseguradosXMLcomoString));

        $array = get_object_vars($personas);
        $arrayPersona = array();
        if (count($array['AsegEssalud.Item']) == 19) { // si es igual a 19 es porque tiene solo una columna
            $arrayPersona[] = get_object_vars($array['AsegEssalud.Item']);
        } else {
            foreach ($array['AsegEssalud.Item'] as $value) {
                $arrayPersona[] = get_object_vars($value);
            }
        }
        
        $arrayFilas = array();

        foreach ($arrayPersona as $key => $fila) {
            $i = 0;
            foreach ($fila as $llave => $value) {
                $arrayFilas[$key][$i] = utf8_decode($value);
                $i++;
            }
            $o_Lpersona = new LPersona();
            $arrayPersona = $o_Lpersona->personaRegistrada($arrayFilas[$key][5]); //busca segun el dni

            if (count($arrayPersona) != '0') {
                $arrayFilas[$key][$i] = $arrayPersona[0]['c_cod_per'];
                //echo 'peche1';
            } else {
                $arrayFilas[$key][$i] = '--';
                // echo 'peche2';
            }
            $i++;
            $arrayFilas[$key][$i] = date('Y-m-d');
            $i++;
            $arrayFilas[$key][$i] = "../../../../medifacil_front/imagen/icono/editar.png ^ Ver";
            $eps = $arrayFilas[$key][18];
            if ($eps == 1) {
                $arrayFilas[$key][18] = 'EPS';
            }
            if ($eps == 0) {
                $arrayFilas[$key][18] = 'ESSALUD';
            }
        }



        $o_LRrhh = new LRrhh();
        $o_TablaHtmlx = new tablaDHTMLX();
        // print_r($arrayPersona);
        // print_r($arrayFilas);
        $arrayCabecera = array(10 => "NumDoc", 19 => "Cod", 1 => "ApePaterno", 2 => "ApeMaterno", 3 => "1er Nombre", 4 => "2do Nombre");
        $arrayCabecera+= array(5 => "Autogenerado", 6 => "Ubigeo", 7 => "FecDesde", 8 => "FecVigAten", 9 => "TipDocIden");
        $arrayCabecera+= array(0 => "Flag", 11 => "Sex", 12 => "FecNacimiento", 13 => "TipSeguroGH", 14 => "PlanPotes");
        $arrayCabecera+= array(15 => "CasAdscripcion", 16 => "MsgError", 20 => "fecha", 17 => 'flagpotes', 18 => 'flageps', 21 => "ver");

        $arrayTamano = array(0 => "*", 1 => "*", 2 => "*", 3 => "*", 4 => "*");
        $arrayTamano += array(5 => "*", 6 => "*", 7 => "*", 8 => "*", 9 => "*");
        $arrayTamano += array(10 => "*", 11 => "30", 12 => "*", 13 => "*", 14 => "*");
        $arrayTamano += array(15 => "*", 16 => "*", 17 => "*", 20 => "*", 21 => "30", 17 => "*", 18 => "*");

        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro");
        $arrayTipo += array(5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro", 9 => "ro");
        $arrayTipo += array(10 => "ro", 11 => "ro", 12 => "ro", 13 => "ro", 14 => "ro");
        $arrayTipo += array(15 => "ro", 16 => "ro", 19 => "ro", 20 => "ro", 21 => "img", 17 => "ro", 18 => "ro");

        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default");
        $arrayCursor += array(5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default");
        $arrayCursor += array(10 => "default", 11 => "default", 12 => "default", 13 => "default", 14 => "default");
        $arrayCursor += array(15 => "default", 16 => "default", 19 => "default", 20 => "default", 21 => "default", 17 => "default", 18 => "default");

        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false", 3 => "false", 4 => "false");
        $arrayHidden += array(5 => "true", 6 => "true", 7 => "false", 8 => "false", 9 => "true");
        $arrayHidden += array(10 => "false", 11 => "false", 12 => "false", 13 => "true", 14 => "true");
        $arrayHidden += array(15 => "true", 16 => "true", 19 => "false", 20 => "false", 21 => "false", 17 => "true", 18 => "false");

        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left");
        $arrayAling += array(5 => "left", 6 => "left", 7 => "left", 8 => "left", 9 => "left");
        $arrayAling += array(10 => "left", 11 => "left", 12 => "left", 13 => "left", 14 => "left");
        $arrayAling += array(15 => "left", 16 => "left", 19 => "left", 20 => "left", 21 => "left", 17 => "left", 18 => "left");

        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function verDatosEssalud($parametros) {
        // print_r($parametros);
        require_once("../../cvista/admision/vVerDatosEssalud.php");
    }

    public function acreditarBusqueda1($datos) {
        $numConexionesActivas = 0;

        $existeArchivoEssalud = 0; //1: fue creado archivo, 0: no fue creado archivo
        $pacientesEssalud = "";

        $ipEssalud = "192.168.30"; //Generalizando se le asigna el número de red
        $tipo = $datos["tipoBusqueda"];
        $dniPaciente = $datos["dni"];
        $apaterno = $datos["apellidoPaterno"];
        $amaterno = $datos["apellidoMaterno"];
        $primerNombre = $datos["primerNombre"];
        $segundoNombre = $datos["segundoNombre"];
        $adscripciondepartamental = $datos["adscripciondepartamental"];
        $nomArchivoTxt = "";

        $tiempoRetardo = 1;
        $fechaActualUnix = time();
//Formamos el nombre del archivo que se obtendrá desde Essalud
        if ($tipo == 1) {
            $nomArchivoTxt = $dniPaciente . "_" . $fechaActualUnix;
            $tiempoRetardo = 1;
        } else {
            if ($tipo == "A") {
                $nomArchivoTxt = $apaterno . "_" . $amaterno . "_" . $primerNombre . "_" . $segundoNombre . "_" . $fechaActualUnix;
                $nomArchivoTxt = $this->reemplazaCaracteresEspeciales($nomArchivoTxt);
                $tiempoRetardo = 3;
            }
        }

        $longitud = strlen($nomArchivoTxt) - 2;
        $nomArchivoTxt = substr($nomArchivoTxt, 0, $longitud);
        $rutaHost = realpath("../../../");
        $i = 0;
//Buscar IPs servidores que se encuentren conectados a Essalud
        $arrayConexionesActivas = array();

        $ipClienteWeb = $_SERVER['REMOTE_ADDR'];
        $arrayIpClienteWeb = explode(".", $ipClienteWeb);
        $mascaraSubRedSedeEmpresa = $arrayIpClienteWeb[0] . "." . $arrayIpClienteWeb[1] . "." . $arrayIpClienteWeb[2];

//$arrayConexionesActivas=$this->getArrayConexionesActivasEssalud($mascaraSubRedSedeEmpresa);
        $mascaraSubRedSedePrincipal = "192.168.31";

        if ($mascaraSubRedSedeEmpresa == $mascaraSubRedSedePrincipal) {//Mascara de la principal que es el HMLO
            $arrayConexionesActivas = $this->getArrayConexionesActivasEssalud($mascaraSubRedSedeEmpresa);
        } else {
            $arrayConexionesActivas = $this->getArrayConexionesActivasEssalud($mascaraSubRedSedeEmpresa);
            if (count($arrayConexionesActivas) == 0) {//En caso de no encontrar conexiones en su sede, busca en el HMLO
                $arrayConexionesActivas = $this->getArrayConexionesActivasEssalud($mascaraSubRedSedePrincipal);
            }
        }

        $numConexionesActivas = count($arrayConexionesActivas);
        $encontroIP = 0;
        $indiceRandom = -1;

        if ($numConexionesActivas > 0) {
            $indiceRandom = rand(0, $numConexionesActivas - 1);
            $ipServidor = $arrayConexionesActivas[$indiceRandom]["vNumeroIpAcreditacion"];
//$encontroIP=1;

            $salida = "";
//java -jar "D:\ClienteCreaArchivo\dist\ClienteCreaArchivo.jar" ipServidor ipEssalud tipo dniPaciente apaterno amaterno primerNombre segundoNombre nomArchivoTxt
            $comandoExisteArchivoEssalud = "java -jar " . $rutaHost . "/essalud/JarSimedh/ClienteCreaArchivo.jar " . $ipServidor . " " . $ipEssalud . " " . $tipo . " " . $dniPaciente . " " . $apaterno . " " . $amaterno . " " . $primerNombre . " " . $segundoNombre . " " . $nomArchivoTxt;
// echo $comandoExisteArchivoEssalud;
//java -jar "D:\ClienteAcredita\dist\ClienteAcredita.jar" ipServidor ipEssalud dniPaciente
            $comandoLeerArchivoEssalud = "java -jar " . $rutaHost . "/essalud/JarSimedh/ClienteAcredita.jar " . $ipServidor . " " . $ipEssalud . " " . $nomArchivoTxt;
//echo $comandoLeerArchivoEssalud;
            $existeArchivoEssalud = shell_exec($comandoExisteArchivoEssalud);

            if ($existeArchivoEssalud == 1) {
//sleep($tiempoRetardo);
                $pacientesEssalud = shell_exec($comandoLeerArchivoEssalud);
                $pacientesEssalud = str_replace("[N]", "Ñ", $pacientesEssalud);

                $pacientesEssalud = str_replace("[A]", "Á", $pacientesEssalud);
                $pacientesEssalud = str_replace("[E]", "É", $pacientesEssalud);
                $pacientesEssalud = str_replace("[I]", "Í", $pacientesEssalud);
                $pacientesEssalud = str_replace("[O]", "Ó", $pacientesEssalud);
                $pacientesEssalud = str_replace("[U]", "Ú", $pacientesEssalud);

                $pacientesEssalud = str_replace("[A1]", "Ä", $pacientesEssalud);
                $pacientesEssalud = str_replace("[E1]", "Ë", $pacientesEssalud);
                $pacientesEssalud = str_replace("[I1]", "Ï", $pacientesEssalud);
                $pacientesEssalud = str_replace("[O1]", "Ö", $pacientesEssalud);
                $pacientesEssalud = str_replace("[U1]", "Ü", $pacientesEssalud);

                $pacientesEssalud = str_replace("#", "_", $pacientesEssalud); //Para los caracteres basura de ESSALUD
                $pacientesEssalud = str_replace("?", "_", $pacientesEssalud); //Para los caracteres basura de ESSALUD

                $salida = $pacientesEssalud;

//if($salida=="" || $salida==null) {
                if ($salida != "" && $salida != null) {
                    $o_Lpersona2 = new LPersona();

                    $vlineas = explode("*", $salida);
//print_r($array1);
                    $numeroFilas = count($vlineas) - 1;
//print_r($vlineas);
                    $arrayFilasValidas = array();
                    $j = 0;
                    $ubigeo = $datos["departamento"] . $datos["provincia"] . $datos["distrito"];

                    for ($i = 0; $i < $numeroFilas; $i++) {
                        $arrayPersona = '';
                        $arrayFilas[$i] = str_replace('|', '', explode(",", $vlineas[$i]));
                        if ($adscripciondepartamental == '0') {
                            if ($arrayFilas[$i][6] == '150117' || $arrayFilas[$i][6] == '150194') {
                                $arrayPersona = $o_Lpersona2->personaRegistrada($arrayFilas[$i][5]); //busca segun el dni
                                if (isset($arrayPersona[0][0]))
                                    $arrayFilas[$i][17] = $arrayPersona[0][0];
                                else
                                    $arrayFilas[$i][17] = '';
                                $arrayFilas[$i][18] = "|" . $arrayFilas[$i][0] . "|" . $arrayFilas[$i][1] . "|" . $arrayFilas[$i][2] . "|" . $arrayFilas[$i][3] . "|" . $arrayFilas[$i][4] . "|" . $arrayFilas[$i][5] . "|" . $arrayFilas[$i][6] . "|" . $arrayFilas[$i][7] . "|" . $arrayFilas[$i][8] . "|";
                                $arrayFilas[$i][18].="|" . $arrayFilas[$i][9] . "|" . $arrayFilas[$i][10] . "|" . $arrayFilas[$i][11] . "|" . $arrayFilas[$i][12] . "|" . $arrayFilas[$i][13] . "|" . $arrayFilas[$i][14] . "|" . $arrayFilas[$i][15] . "|" . $arrayFilas[$i][16] . "|" . $arrayFilas[$i][17] . "|";
                                $arrayFilas[$i][1] = utf8_decode($arrayFilas[$i][1]);
                                $arrayFilas[$i][2] = utf8_decode($arrayFilas[$i][2]);
                                $arrayFilas[$i][3] = utf8_decode($arrayFilas[$i][3]);
                                $arrayFilas[$i][4] = utf8_decode($arrayFilas[$i][4]);
                                $arrayFilasValidas[$j] = $arrayFilas[$i];

                                $j = $j + 1;
                            }
                        }else {
//                if (substr($arrayFilas[$i][6],0,-2) == $datos["departamento"] . $datos["provincia"]) {
                            $arrayPersona = $o_Lpersona2->personaRegistrada($arrayFilas[$i][5]); //busca segun el dni
                            if (isset($arrayPersona[0][0]))
                                $arrayFilas[$i][17] = $arrayPersona[0][0];
                            else
                                $arrayFilas[$i][17] = '';
                            $arrayFilas[$i][18] = "|" . $arrayFilas[$i][0] . "|" . $arrayFilas[$i][1] . "|" . $arrayFilas[$i][2] . "|" . $arrayFilas[$i][3] . "|" . $arrayFilas[$i][4] . "|" . $arrayFilas[$i][5] . "|" . $arrayFilas[$i][6] . "|" . $arrayFilas[$i][7] . "|" . $arrayFilas[$i][8] . "|";
                            $arrayFilas[$i][18].="|" . $arrayFilas[$i][9] . "|" . $arrayFilas[$i][10] . "|" . $arrayFilas[$i][11] . "|" . $arrayFilas[$i][12] . "|" . $arrayFilas[$i][13] . "|" . $arrayFilas[$i][14] . "|" . $arrayFilas[$i][15] . "|" . $arrayFilas[$i][16] . "|" . $arrayFilas[$i][17] . "|";
                            $arrayFilas[$i][1] = utf8_decode($arrayFilas[$i][1]);
                            $arrayFilas[$i][2] = utf8_decode($arrayFilas[$i][2]);
                            $arrayFilas[$i][3] = utf8_decode($arrayFilas[$i][3]);
                            $arrayFilas[$i][4] = utf8_decode($arrayFilas[$i][4]);
                            $arrayFilasValidas[$j] = $arrayFilas[$i];

                            $j = $j + 1;
//                }
                        }
                    }

//    print_r($arrayFilas);
                    $funcion = 'acreditarPersonaEncontrada';
                    $arrayTipo = array("5" => "c", "10" => "c", "1" => "c", "2" => "c", "3" => "c", "4" => "c", "7" => "c", "8" => "c", "17" => "c", "11" => "c");
                    $arrayColorEstado = array("2" => "7");
                    $arrayCabecera = array("5" => "Autogenerado", "10" => "Nº DOC.", "1" => "A.Paterno", "2" => "A.Materno", "3" => "1er Nombre", "4" => "2do Nombre", "7" => "De", "8" => "Hasta", "17" => "Código", "11" => "...");

                    $o_Html = new Tabla1($arrayCabecera, 7, $arrayFilasValidas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', $funcion, 18, $arrayTipo, 7, $arrayColorEstado);
                    $o_Html->setColumnasOrdenar(array("0", "1", "2", "3", "4", "5", "6"));
                    $respuestaFinal = $o_Html->getTabla();
                }
                else {
                    $respuestaFinal = "<h2><font color=\"red\">Congestión en la red,intente otra vez</font></h2>"; //Esto ya no ocurre porque se espera hasta que se genere el archivo
                }
            } else {
                $respuestaFinal = "<h2><font color=\"red\">No se generó archivo de Essalud correctamente</font></h2>";
            }
        } else {
            $respuestaFinal = "<h2><font color=\"red\">No hay conexión con Essalud o con usuario acredita</font></h2>";
        }

        return $respuestaFinal;
    }

    function filaEncontrada($cadena, $c_cod_per) {
//echo $c_cod_per;
        $cadena = utf8_decode($cadena);
        $cadena = $cadena . $c_cod_per;
        $arrayFilas = explode("|", $cadena);
        $funcion = 'acreditarPersonaEncontrada';
        $arrayTipo = array("6" => "c", "12" => "c", "2" => "c", "3" => "c", "4" => "c", "5" => "c", "8" => "c", "9" => "c", "20" => "c", "11" => "c");
        $arrayColorEstado = array("2" => "7");
        $arrayCabecera = array("6" => "Autogenerado", "12" => "DNI", "2" => "A.Paterno", "3" => "A.Materno", "4" => "1er Nombre", "5" => "2do Nombre", "8" => "De", "9" => "Hasta", "20" => "Código", "11" => "...");

        $o_Html = new Tabla1($arrayCabecera, 7, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', $funcion, 18, $arrayTipo, 7, $arrayColorEstado);
        $o_Html->setColumnasOrdenar(array("0", "1", "2", "3", "4", "5", "6"));
        return $o_Html->getTabla();
    }

    public function ventanaVerAtenciones() {
        require_once("../../cvista/cita/vAtenciones.php");
    }

    public function verAtencionesMedicas($c_cod_per) {
        $o_Lpersona = new LPersona();       
        $arrayFilas = $o_Lpersona->ListaPersonaCitas($c_cod_per);
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayCabecera = array("0" => "CodProgramacion", "1" => "Fecha", "2" => "Hora", "3" => "Médico", "4" => "Descripción", "5" => "Estado", "6" => "Datos","7" => "Ubicación", "8" => "Placa","9"=>"...");
        $arrayTamano = array(0 => "10", 1 => "60", 2 => "50",3 => "90", 4 => "190", 5 => "60", 6 => "10",7 => "40",8 => "40",9 => "20");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default",6 => "default", 7 => "default",8 => "default",9 => "default");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro",3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro",8 => "ro",9 => "img");       
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false",3 => "false", 4 => "false", 5 => "false",6 => "true",7 => "false",8 => "false",9 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left",3 => "left", 4 => "left", 5 => "left",6 => "left", 7 => "left",8 => "left",9 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);        
    }

    public function mostrarVentanaAcreditacionComplementaria($datos) {
        require_once("../../cvista/admision/vAcreditacionComplementaria.php");
    }

    public function buscarParentescoPaciente() {
        $o_LPersona = new ActionPersona();
        $arrayParametros['funcion'] = "seleccionarParentescoPaciente";
        $funcion = $arrayParametros['funcion'];
        $arrayParametros['alto'] = "250px";
        $comboTipoDocumentos = $o_LPersona->comboTipoDocumento('1');
        $obtenerPersonas = $o_LPersona->obtenerPersonas('', '', '', $funcion, '');
        require_once("../../cvista/busqueda/buscador_personas.php");
    }

    public function grabarParentescoPaciente($codPersonaTitular, $codPariente) {
        $o_LPersona = new LPersona();
        $resultado = $o_LPersona->grabarParentescoPaciente($codPersonaTitular, $codPariente);
        return $resultado;
    }

    public function listaParentescoPaciente($codPersonaTitular) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $o_LPersona = new LPersona();
        $arrayFilas = $o_LPersona->listaParentescoPaciente($codPersonaTitular);
        $arrayFilas = is_array($arrayFilas) ? $arrayFilas : array();
        $cboParemtesco = $o_LPersona->listaParentesco();
        $cboParemtesco = is_array($cboParemtesco) ? $cboParemtesco : array();

        $grabar = true;
        $eliminar = true;
        if (isset($_SESSION["permiso_formulario_servicio"][110]["GRABAR_PARENTESCO_PAC"]) && $_SESSION["permiso_formulario_servicio"][110]["GRABAR_PARENTESCO_PAC"] == 1)
            $grabar = false;

        if (isset($_SESSION["permiso_formulario_servicio"][110]["ELIMINAR_PARENTESCO_PAC"]) && $_SESSION["permiso_formulario_servicio"][110]["ELIMINAR_PARENTESCO_PAC"] == 1)
            $eliminar = false;

        $arrayCabecera = array(0 => "iidParentescoDePersona", 1 => "cCodigoPersonaPrincipal", 2 => "Código", 3 => "Persona", 4 => "idParentesco", 5 => "Parentesco", 6 => "Grabar", 7 => "Eliminar");
        $arrayTamanio = array(0 => "70", 1 => "70", 2 => "70", 3 => "250", 4 => "60", 5 => "200", 6 => "50", 7 => "70");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "co", 6 => "img", 7 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "false", 3 => "false", 4 => "true", 5 => "false", 6 => $grabar, 7 => $eliminar);
        $arrayAling = array(0 => "left", 1 => "left", 2 => "center", 3 => "center", 4 => "center", 5 => "center", 6 => "center", 7 => "center");
        return $o_TablaHtmlx->generaTablaFullCombo($arrayCabecera, $arrayFilas, $arrayTamanio, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling, $cboParemtesco);
    }

    public function eliminarParentescoPaciente($idParentescoDePersona) {
        $o_LPersona = new LPersona();
        $resultado = $o_LPersona->eliminarParentescoPaciente($idParentescoDePersona);
        return $resultado;
    }

    public function asingarParientePaciente($datos) {
        $o_LPersona = new LPersona();
        $resultado = $o_LPersona->asingarParientePaciente($datos);
        return $resultado;
    }

}

?>