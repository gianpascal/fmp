<?php

class Tabla1{
	public static $idHijo=0;
	private $idTabla;
	private $estiloTabla;
	private $estiloFilaSeleccionada;
	private $estiloFila;
	private $estiloFilaAlterna;
	private $arrayCabecera;
        private $arrayTipos;
	private $arrayFilas;
	private $indClave;
	private $class;
	private $ancho;
	private $oyenteEventosJS;
	private $numFilas;
	private $arrayEventosJS;
	private $indiceEstados;
	private $check;
	private $ocultarColumnas;
	private $camposEditables;
	private $tipoEditables;
	private $nombre;
	private $columnasOrdenar;
	private $atributoColumnas;
	private $oyenteJSEdicionColumnas;
	private $columnasTotalizadas;
	const VACIO = "&nbsp;";
	private $align = array("j"=>"justify","J"=>"justify","r"=>"right","R"=>"right","l"=>"left","L"=>"left","c"=>"center","C"=>"center");
	function __construct($_arrayCabecera,$_numFilas,$_arrayFilas='',$_estiloTabla='',$_estiloFila='',$_estiloFilaAlterna='',$_estiloFilaSeleccionada='',$_arrayEventosJS='',$_oyenteEventosJS='',$_indClave='',$_arrayTipos='' ,$_indiceEstados='',$_arrayColorEstado=''){
                self::$idHijo++;
		$this->idTabla = "tabla".self::$idHijo;
		$this->numFilas = empty($_numFilas)?0:$_numFilas;
		$this->arrayCabecera=$_arrayCabecera;
		$this->arrayFilas = empty($_arrayFilas)?array('','','','','','','','','','','','','','',''):$_arrayFilas;
                $this->arrayTipos=$_arrayTipos; //es una array para ver si la columana es un elemnto html o puro texto
		$this->estiloTabla=$_estiloTabla;
		$this->estiloFila = $_estiloFila;
		$this->estiloFilaAlterna = empty($_estiloFilaAlterna)?$this->estiloFila:$_estiloFilaAlterna;
		$this->estiloFilaSeleccionada=$_estiloFilaSeleccionada;
		$this->estiloTabla=$_estiloTabla;
		$this->indClave = $_indClave;
		$this->oyenteEventosJS = $_oyenteEventosJS;
		$this->arrayEventosJS  = is_array($_arrayEventosJS)?$_arrayEventosJS:array("1"=>"$_arrayEventosJS");
		$this->arrayColorEstado = is_array($_arrayColorEstado)?$_arrayColorEstado:array();
		$this->indiceEstados = $_indiceEstados;
		$this->tipoEditables=array();
		$this->ocultarColumnas = false;
		$this->camposEdiTables = array();
		$this->atributoColumnas = array();
		$this->columnasOrdenar = array();
	}

	public function getCabeceraHTML($_arrayCabecera=''){
		$_arrayCabecera = empty($_arrayCabecera)?$this->arrayCabecera:$_arrayCabecera;
		$cabeceraHTML = "<thead><tr>";
		$k=0;
		foreach($_arrayCabecera as $i => $valor){
			if($valor == "checkbox") $valor = "<input type=\"checkbox\" onclick=\"tablaPHP.seleccionarChecks(this,event,$k);\"/>";
			if(in_array($i,$this->columnasOrdenar)){
				$cabeceraHTML.="<th>"."<a onclick=\"tablaPHP.ordenarTabla(this, $k);return false;\" class=\"sortheader\" href=\"#\">$valor<span class=\"sortarrow\">&nbsp;</span></a>"."</th>";
			}else{
				$cabeceraHTML.="<th>".$valor."</th>";
			}
			$k++;
		}
		$cabeceraHTML.= "</tr></thead>";
		return $cabeceraHTML;

	}
	public function getFilasHTML($_arrayFilas='',$_arrayEventosJS='',$_oyenteEventosJS='',$_indClave=-1){
            $_arrayEventosJS = empty($_arrayEventosJS)?$this->arrayEventosJS:$_arrayEventosJS;
            $_arrayEventosJS=is_array($_arrayEventosJS)?$_arrayEventosJS:array("0"=>"$_arrayEventosJS");
            $_indClave=$_indClave<0?$this->indClave:$_indClave;
            $_oyenteEventosJS= empty($_oyenteEventosJS)?$this->oyenteEventosJS:$_oyenteEventosJS;
            $_arrayFilas = empty($_arrayFilas)?$this->arrayFilas:$_arrayFilas;
            $flat=true;
            $numArrayAdicionales = $this->numFilas-count($_arrayFilas);
            
			$numArrayAdicionales = $numArrayAdicionales<0?0:$numArrayAdicionales;
			if(!empty($_arrayFilas[0])){
				
				
				if(count($_arrayFilas[0])==1 ){
					$numColumnas=count($_arrayFilas);
					$_arrayFilas1=array();
					$_arrayFilas1[0]=$_arrayFilas;
					$_arrayFilas=array();
					$_arrayFilas=$_arrayFilas1;
					$numArrayAdicionales = $this->numFilas;
				}else{
					$numColumnas = count($_arrayFilas[0]);
	
					
				}
			}
			
				
			
			
			

            $arrayColsAdicionales=array_fill(0,$numColumnas,null);
            //$arrayColsAdicionales=array('0'=>'','1'=>'','3'=>'','9'=>'');
            for($i=0;$i<$numArrayAdicionales;$i++){

                        $_arrayFilas[] = $arrayColsAdicionales;
                      
            }
            $filasHTML= "<tbody >\n\r";
            //print_r($_arrayFilas);
            //var_dump($_arrayFilas);
            //echo "<br>".count($_arrayFilas)."<br>";
            foreach($_arrayFilas as $i=>$arrayFila){
                //echo "$i";print_r($arrayFila);echo "<br>";
                $estiloFila = $flat?$this->estiloFila:$this->estiloFilaAlterna;
                $flat=!$flat;
                $filasHTML.= $this->getFilaHTML($arrayFila,$this->arrayCabecera,$_arrayEventosJS,$_oyenteEventosJS,$_indClave,$estiloFila,$this->estiloFilaSeleccionada);
            }
            $filasHTML.="\n\r</tbody>";
            return $filasHTML;
	}
	public function getFilaHTML($_arrayFila=array(),$_arrayCols=array(),$_arrayEventosJS='',$_oyenteEventosJS='',$_indiceClave=-1,$_estiloFila='',$_estiloFilaSeleccionada=''){
		$filaHTML = "";
              //  print_r($_arrayFila);echo "<br>";
                $_arrayMostrar = array();//array_intersect_key($_arrayFila,$_arrayCols);
                //print_r($_arrayMostrar);
		foreach($_arrayCols as $i=>$val){
                    if(isset ($_arrayFila[$i])){
                        $_arrayMostrar[$i] = $_arrayFila[$i];
                    }else{
                       $_arrayMostrar[$i]='';
                    }
                    
		}
		$arrayTemp = is_array($this->ocultarColumnas)?$this->ocultarColumnas:array();
		//var_dump($arrayTemp);
		if($this->ocultarColumnas){
                    foreach($_arrayFila as $r=>$fila){
                        //$bool = is_array($this->ocultarColumnas)?in_array($r,$this->ocultarColumnas):$this->ocultarColumnas==true;
                        if(!array_key_exists($r,$_arrayCols) && (in_array($r,$arrayTemp) || $this->ocultarColumnas=="true"))
                        $_arrayMostrar[$r] = $_arrayFila[$r];
                    }
		}
		//$_arrayMostrar = $_arrayFila;
		$bgcolor = "";
                $backgroundcolor="";
		if(is_numeric($this->indiceEstados) && intval($this->indiceEstados)>=0){
			//$_estiloFila = "e".intval($_arrayFila[$this->indiceEstados]);
                    //echo $_arrayMostrar[$this->indiceEstados];
                    //print_r($this->arrayColorEstado);
                    if(!empty ($this->arrayColorEstado[$_arrayFila[$this->indiceEstados]])){
                        //$bgcolor = $this->arrayColorEstado[$_arrayMostrar[$this->indiceEstados]];
			//$backgroundcolor = "style=\"background-color:$bgcolor\"";
                        $_estiloFila = "e".$this->arrayColorEstado[$_arrayFila[$this->indiceEstados]];
                        //echo $_estiloFila;
                    }
		}
                $idValorClave='';
                $eventos = "";
                $onmouseover="";
                $onmouseout="";
		if($_indiceClave>=0 && !empty($_arrayFila[$_indiceClave]) && !empty($_arrayEventosJS)){
			$idValorClave=$_indiceClave>=0?"id=\"$_arrayFila[$_indiceClave]\"":'';
			$valorClaveFila = $_arrayFila[$_indiceClave];
			$funcionOyenteJS = "$_oyenteEventosJS(this,event,'$valorClaveFila');";
			//$funcionDeseleccionar = "";
			$jsSeleccionarFila="";$jsDeseleccionarFila="";$onmouseover="";$onmouseout="";
			if(!empty($_estiloFilaSeleccionada)){
                            $onmouseover = "onmouseover=\"className='$_estiloFilaSeleccionada'\"";
                            $onmouseout = "onmouseout=\"className='$_estiloFila'\"";
                            $jsDeseleccionarFila="tablaPHP.funDesel(this,'$_estiloFilaSeleccionada');";
                            $jsSeleccionarFila = "this.setAttribute('onmouseout','');this.className='$_estiloFilaSeleccionada';this.parentNode.id='$_estiloFila';";
                            $jsSeleccionarFila.="this.parentNode.parentNode.title='".$valorClaveFila."';";
			}
			$jss = "$jsDeseleccionarFila $jsSeleccionarFila $funcionOyenteJS";
			$eventos = "";
			foreach ($_arrayEventosJS as $i=>$valor){
                            $eventos.=" $valor=\"$jss\" ";
			}
		}
		$estilo = "class=\"$_estiloFila\"";
		$filaHTML="<tr $idValorClave $backgroundcolor $eventos $estilo  $onmouseover $onmouseout >"."\n";
		/*LLENA TD*/
		foreach($_arrayMostrar as $indice => $valor){
				//var_export($_arrayMostrar);
				$atributos = empty($this->atributoColumnas[$indice])?" ":$this->getAtributosColumna($this->atributoColumnas[$indice]);
				$estiloOculta = array_key_exists($indice,$_arrayCols)?"":"style=\"display:none;\"";
				$axis="";
                                $ondblclick="";
                                //echo count($this->arrayTipos);
                                //print_r($this->arrayTipos);
                                if(count($this->arrayTipos)==1){
                                    $tipo="c";
                                }else{
                                    $tipo=$this->arrayTipos[$indice];
                                }
				if(!is_array($valor)){
					if(!empty($this->camposEditables) && is_array($this->camposEditables) && !is_null($valor)){
						$ondblclick="";
					  if(in_array($indice,$this->camposEditables)){
					  	$clave=array_search($indice,$this->camposEditables);
					  	if($clave>=0)
					  		$ondblclick= "onclick=\"tablaPHP.mostrarCelda(this,event);\"";
					  			else
					  				$ondblclick = in_array($_arrayFila[-1*$clave],array("T","t","1",1,"true","TRUE","True")) || $_arrayFila[-1*$clave]===true?"onclick=tablaPHP.mostrarCelda(this,event);":"";
					  	$axis = $this->getOyenteCeldaEditable($indice);
					  }
					}
					
                                        if($tipo=="c"){
                                            $item = (trim($valor)=="")?self::VACIO:htmlentities($valor);
                                        }else {
                                            $item = (trim($valor)=="")?self::VACIO:$valor;
                                        }
					$id = "id=\"$indice\"";
					$filaHTML.= "\t"."<td $id $axis $estiloOculta $ondblclick $atributos>".$item."</td>"."\n";
				}else{
					$filaHTML.= "\t"."<td $id $estiloOculta $atributos>".$this->getElementoHTML($_arrayFila,$valor)."</td>"."\n";
				}
		}
		///////////
		$filaHTML.="</tr>\n";
		return $filaHTML;
	}

	public function getElementoHTML($_arrayFila,$elementoArray=array()){
		//$elementoArrayCheck = array($tipoElemento,array($numColumnaForId,$numColumnaForGrupoId,
		//$nombre,$estilo,$clase,$arrayFunciones,$arrayOyentes));
		if($elementoArray[0]=="checkbox"){
			$arrayCheck = $elementoArray[1];
			$id = $_arrayFila[$arrayCheck[0]];
			$idGroup = $_arrayFila[$arrayCheck[1]];
			$nombre = $arrayCheck[2];
			$estilo=$arrayCheck[3];
			$clase=$arrayCheck[4];
			$arrayEventos=$arrayCheck[5];
			$arrayOyentes=$arrayCheck[6];
			$eHTML = new Check($id,$idGroup,$nombre,$estilo,$clase,$arrayEventos,$arrayOyentes);
			$return = $eHTML->getCheckBoxHTML();
		}else if($elementoArray[0]=="button"){
			$arrayButton = $elementoArray[1];
			//OyenteJS, numColInd, Icono de imagen de Oyente
			switch($arrayButton[0]){
				case "delete":
					$onclickjs = "tablaPHP.eliminarFila";
					$btnDefault = "[x]";
					//if(file_exists($arrayButton[2]))
					break;
				case "default":
					$onclickjs = $arrayButton[0];
					$btnDefault = "[ ]";
					break;
				default:
					$onclickjs = $arrayButton[0];
					$btnDefault = "[ ]";
					break;
			}
			$oyenteonclick = "onclick=\"$onclickjs(this,event,{$_arrayFila[$arrayButton[1]]});\"";
			$boton=empty($arrayButton[2])?$btnDefault:"<img src=\"$arrayButton[2]\" />";
			$button = "<a style=\"margin:0px;border:0px;\" href=\"#\" $oyenteonclick >$boton</a>";
			$return = $button;
		}
		return $return;
	}
	public function getTabla($_nombreTabla='', $_estiloTabla='', $_numFilas=0){
		if(empty($this->arrayCabecera)) return "Error: La propiedad arrayFilas  de Tabla1 no contiene un array";
		$this->numFilas = $_numFilas==0?$this->numFilas:$_numFilas;
		$estiloTabla = empty($_estiloTabla)?$this->estiloTabla:$_estiloTabla;
		$return = is_array($this->arrayFilas)?"<table title = '' class='$estiloTabla' id='$this->idTabla' cellspacing='0' cellpading='0'>".$this->getCabeceraHTML().$this->getFilasHTML()."</table>".$this->getTotalesTabla():"undefined";
		if(is_array($this->camposEditables) && !empty($this->camposEditables)){
                $this->setNombre($_nombreTabla);
                $arrayIdTabla = array("0"=>$this->getNombre(),"1"=>$this->getIndClave(),"2"=>serialize($this));
                $_SESSION[$this->getIdTabla()]=$arrayIdTabla;
                $_SESSION[$this->getNombre()] = $this->arrayFilas;
		}
		return $return;
	}

	public static  function actualizarColumnasTabla($parametros,$objeto=null,$funcion=null){
			$arrayTabla1 = array();
			$tabla = $_SESSION[$parametros["idTabla"]];
			$arrayTabla = $_SESSION[$tabla["0"]];
			$arrayTabla1=$arrayTabla;
			$k=-1;
			$f1=array();
			foreach($arrayTabla as $i=>$f){
				if($f[$tabla["1"]]==$parametros["idFila"]){
					$f1 = $f;
					$f1[$parametros["numeroColumna"]]=$parametros["valor"];
					if(!is_null($objeto) && !is_null($funcion) && !empty($objeto) && !empty($funcion)){
						$f1=call_user_func(array(&$objeto,$funcion),$f1,$parametros["numeroColumna"]);
					}
					$k=$i;
					reset($arrayTabla);
					break 1;
				}
			}
			if($k>=0){
				$arrayTabla1[$k]=$f1;
				$_SESSION[$tabla["0"]]=$arrayTabla1;
			}
		return $arrayTabla1;
	}
	public static function eliminarFilaTabla($parametros){
		//idFila, idTabla
		$idTabla=$parametros["idTabla"];
		//var_dump($parametros);
		//var_dump($a);
		//var_dump($_SESSION[$idTabla]);
		//echo $idTabla;
		$tabla = $_SESSION[$idTabla];
		//var_dump($tabla);
		$array = $_SESSION[$tabla["0"]];
		//var_dump($array);
		foreach($array as $i=>$f){
			if($f[$tabla["1"]]==$parametros["idFila"]){
				unset($_SESSION[$tabla["0"]][$i]);
				$objTabla = unserialize($tabla["2"]);
				$objTabla->setArrayFilas($_SESSION[$tabla["0"]]);
				return $objTabla->getTabla($objTabla->getNombre());
			}
		}
	}

	private function getAtributosColumna($arrayAtributo){
		return " width=\"{$arrayAtributo["0"]}\"  align=\"{$this->align[$arrayAtributo["1"]]}\" ";
	}
	private function getOyenteCeldaEditable($numIndice){
		$valorAtributoAxis = $this->oyenteJSEdicionColumnas[$numIndice];
		return !empty($valorAtributoAxis)?"axis=\"$valorAtributoAxis\"":" ";
	}
	private function getTotalesTabla(){
		$tabla="";
		if(!empty($this->columnasTotalizadas) && is_array($this->columnasTotalizadas) && count($this->columnasTotalizadas) > 0 && !empty($this->arrayFilas)){
			$total = $this->arrayFilas[0];
			foreach($total as $i=>$a){
				$total[$i] = in_array($i,$this->columnasTotalizadas)?"0.00":"";
			}
			foreach($this->arrayFilas as $f){
				foreach($this->columnasTotalizadas as $numCol){
					$total[$numCol]+=$f[$numCol];
				}
			}
			$tr="<tr class=\"$this->estiloFila\">";
			foreach($total as $i=>$a){
				if(array_key_exists($i,$this->arrayCabecera)){
					$atributos = !empty($this->atributoColumnas[$i]) && is_array($this->atributoColumnas[$i])?$this->getAtributosColumna($this->atributoColumnas[$i]):"";
					$item = in_array($i,$this->columnasTotalizadas)?number_format($a,2,'.',','):$a;
					$tr.= "<td $atributos >".$item."</td>";
				}
			}
			$tr.="</tr>";
			$estiloTabla = empty($_estiloTabla)?$this->estiloTabla:$_estiloTabla;
			$tabla = "<table title = '' style=\"height:none;width:100%;\"  cellspacing='0' cellpading='0'>$tr</table>";
		}
		return $tabla;
	}

	//////************set set get for Tabla1 *******************////////////////////
	public function getIdTabla(){
		return $this->idTabla;
	}
	public function setIdTabla($_idTabla){
		$this->idTabla = $_idTabla;
	}
	public function getEstiloTabla(){
		return $this->estiloTabla;
	}
	public function setEstiloTabla($_estiloTabla){
		$this->estiloTabla = $_estiloTabla;
	}

	public function getEstiloFilaSeleccionada(){
		return $this->estiloFilaSeleccionada;
	}
	public function setEstiloFilaSeleccionada($_estiloFilaSeleccionada){
		$this->estiloFilaSeleccionada = $_estiloFilaSeleccionada;
	}
	public function getEstiloFila(){
		return $this->estiloFila;
	}
	public function setEstiloFila($_estiloFila){
		$this->estiloFila = $_estiloFila;
	}
	public function getEstiloFilaAlterna(){
		return $this->estiloFilaAlterna;
	}
	public function setEstiloFilaAlterna($_estiloFilaAlterna){
		$this->estiloFilaAlterna = $_estiloFilaAlterna;
	}
	public function getArrayCabecera(){
		return $this->arrayCabecera;
	}
	public function setArrayCabecera($_arrayCabecera){
		$this->arrayCabecera = $_arrayCabecera;
	}
	public function getArrayFilas(){
		return $this->arrayFilas;
	}
	public function setArrayFilas($_arrayFilas){
		$this->arrayFilas = $_arrayFilas;
	}
	public function getIndClave(){
		return $this->indClave;
	}
	public function setIndClave($_indClave){
		$this->indClave = $_indClave;
	}
	public function getClass(){
		return $this->class;
	}
	public function setClass($_class){
		$this->class = $_class;
	}
	public function getAncho(){
		return $this->ancho;
	}
	public function setAncho($_ancho){
		$this->ancho = $_ancho;
	}
	public function getOyenteEventosJS(){
		return $this->oyenteEventosJS;
	}
	public function setOyenteEventosJS($_oyenteEventosJS){
		$this->oyenteEventosJS = $_oyenteEventosJS;
	}
	public function getNumFilas(){
		return $this->numFilas;
	}
	public function setNumFilas($_numFilas){
		$this->numFilas = $_numFilas;
	}
	public function getArrayEventosJS(){
		return $this->arrayEventosJS;
	}
	public function setArrayEventosJS($_arrayEventosJS){
		$this->arrayEventosJS =$_arrayEventosJS;
	}

	public function getIndiceEstados(){
		return $this->indiceEstados;
	}
	public function setIndiceEstados($_indiceEstados){
		$this->indiceEstados = $_indiceEstados;
	}

	public function getCheck(){
		return $this->check;
	}
	public function setCheck($_check){
		$this->check = $_check;
	}

	public function getOcultarColumnas(){
		return $this->ocultarColumnas;
	}
	public function setOcultarColumnas($_ocultarColumnas){
		$this->ocultarColumnas = $_ocultarColumnas;
	}

	public function getCamposEditables(){
		return $this->camposEditables;
	}
	public function setCamposEditables($_camposEditables){
		$this->camposEditables = $_camposEditables;
	}
	public function getNombre(){
		return $this->nombre;
	}
	public function setNombre($_nombre){
		$this->nombre = $_nombre;
	}
	public function getColumnasOrdenar(){
		return $this->columnasOrdenar;
	}
	public function setColumnasOrdenar($_columnasOrdenar){
		$this->columnasOrdenar = $_columnasOrdenar;
	}
	public function getTipoEditables(){
		return $this->tipoEditables;
	}
	public function setTipoEditables($_tipoEditables){
		$this->tipoEditables = $_tipoEditables;
	}
	public function getAtributoColumnas(){
		return $this->atributoColumnas;
	}
	//array("x"=>array("XXX","J L R C"));
	public function setAtributoColumnas($_atributoColumnas){
		$this->atributoColumnas = $_atributoColumnas;
	}
	public function getOyenteJSEdicionColumnas(){
		return $this->oyenteJSEdicionColumnas;
	}
	//array("x"=>array("XXX","J L R C"));
	public function setOyenteJSEdicionColumnas($_oyenteJSEdicionColumnas){
		$this->oyenteJSEdicionColumnas = $_oyenteJSEdicionColumnas;
	}
	public function setColumnasTotalizadas($_columnasTotalizadas){
		$this->columnasTotalizadas = $_columnasTotalizadas;
	}
	public function getColumnasTotalizadas(){
		$this->columnasTotalizadas;
	}
	//////************ FIN set get for Tabla1 *******************////////////////////
}
class Check{
	private $checkHTML;
	private $id;
	private $name;
	private $style;
	private $class;
	private $arrayEventos;
	private $arrayEscuchador;
	private $idGrupo;
	private $value;
	//private $bgcolorOnFila
	public function __construct($_id,$_idGrupo,$_name='',$_style='',$_class='',$_arrayEventos=array(),$_arrayEscuchador=array()){
		$this->id = $_id;
		$this->idGrupo = $_idGrupo;
		$this->name =$_name;
		$this->style =$_style;
		$this->class =$_class;
		$this->arrayEventos =$_arrayEventos;
		$this->arrayEscuchador = $_arrayEscuchador;
		$this->value = 	trim($_id).":".trim($_idGrupo);
	}
	public function getCheckBoxHTML(){
		$check = "<input type=\"checkbox\"";
		$id = "id=\"$this->id:$this->idGrupo\"";
		$name = empty($this->name)?"":"name=\"$this->name\"";
		$style = empty($this->style)?"":"style=\"$this->style\"";
		$value = "value=\"$this->value\"";
		$class = empty($this->class)?"":"class=\"$this->class\"";
		$eventos = $this->getStringEventosEscuchaArray();
		$check.= "$id $name $value $class $style $eventos />";
		$this->checkHTML = $check;
		return $this->checkHTML;
	}
	public function getStringEventosEscuchaArray(){
		if((count($this->arrayEventos)!=count($this->arrayEscuchador)) || (count($this->arrayEscuchador) <=0)) return "";
		$r = count($this->arrayEventos);
		$eventos="";
		for($i=0;$i<$r;$i++){
			$eventos.= $this->arrayEventos[$i]."="."\"{$this->arrayEscuchador[0]}(this,event);\""." ";
		}
		return $eventos;
	}
	public function setCheckHTML($_checkHTML){
		$this->checkHTML = $_checkHTML;
	}
	public function toString(){
		return $checkHTML;
	}
}
class ButtonDelete{

	private $id;
	private $name;
	private $style;
	private $class;
	private $icono;
	private $funcion='';
	function __construct($id='',$name='',$style='',$class='',$icono='',$funcion=''){
		$this->id=$id;
		$this->name=$name;
		$this->style=$style;
		$this->class=$class;
		$this->icono=$icono;
		$this->funcion=$funcion;
	}

	public function getFuncion(){
		return $this->funcion;
	}
	public function setFuncion($_funcion){
		$this->funcion = $_funcion;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($_id){
		$this->id = $_id;
	}

	public function getName(){
		return $this->name;
	}
	public function setName($_name){
		$this->name = $_name;
	}

	public function getStyle(){
		return $this->style;
	}
	public function setStyle($_style){
		$this->style = $_style;
	}
	public function getClass(){
		return $this->class;
	}
	public function setClass($_class){
		$this->class = $_class;
	}

	public function getIcono(){
		return $this->icono;
	}
	public function setIcono($_icono){
		$this->icono = $_icono;
	}
}
?>