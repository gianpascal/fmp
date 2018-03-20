<?php
class Combo{
    private $arrayCombo;
    private $optionsHTML;
    public function __construct($_arrayCombo=array()){
            $this->arrayCombo = empty($_arrayCombo)?array():$_arrayCombo;
            $this->arrayCombo = is_array($this->arrayCombo)?$this->arrayCombo:array();
    }
    public function getArrayCombo(){
            return $this->arrayCombo;
    }
    public function setArrayCombo($_arrayCombo){
            $arrayCombo = empty($_arrayCombo)?array():$_arrayCombo;
    }
    public function getOptionsHTML($indSel='',$valorDefault=''){
        $_optionsHTML = "";
        $valorDefault=empty($valorDefault)?'Seleccionar':$valorDefault;
        $_optionsHTML = $valorDefault=='null' || $valorDefault==null?"":"<option value=\"0000\">$valorDefault</option>";
        foreach ($this->arrayCombo as $indice => $valor){
            //echo "$indice  $valor<br>";
            $selected = $indSel == $indice?"selected='selected'":"";
            $_optionsHTML.= "\t"."<option value='$indice' $selected>".$valor."</option>"."\n";
        }
        $this->optionsHTML = $_optionsHTML;
        return $this->optionsHTML;
    }
    public function getOptionsHTMLFirstSelected($indSel='',$valorDefault=''){ //Esta funcion selecciona al primero de la lista...
        $_optionsHTML = "";
        $valorDefault=empty($valorDefault)?'Seleccionar':$valorDefault;
        $_optionsHTML = $valorDefault=='null' || $valorDefault==null?"":"<option value=\"0000\">$valorDefault</option>";
        $i=0;
        $selected = '';
        foreach ($this->arrayCombo as $indice => $valor){
            if($indSel == '')
                if($i == 0)
                    $selected = "selected='selected'";
            else{
                $selected = $indSel == $indice?"selected='selected'":"";
            }
            $_optionsHTML.= "\t"."<option value='$indice' $selected>".$valor."</option>"."\n";
            $i++;
        }
        $this->optionsHTML = $_optionsHTML;
        return $this->optionsHTML;
    }
    public function getOptionsListaHTML($indSel='',$valorDefault=''){
        $_optionsHTML = "";
        //$valorDefault=empty($valorDefault)?'Seleccionar':$valorDefault;
        //$_optionsHTML = $valorDefault=='null' || $valorDefault==null?"":"<option value=\"0000\">$valorDefault</option>";
        foreach ($this->arrayCombo as $indice => $valor){
            //echo "$indice  $valor<br>";
            $selected = $indSel == $indice?"selected='selected'":"";
            $_optionsHTML.= "\t"."<option value='$indice' $selected>".$valor."</option>"."\n";
        }
        $this->optionsHTML = $_optionsHTML;
        return $this->optionsHTML;
    }
    public function getSelecccionHTML($option,$identificador,$estilo,$evento,$funcion,$ancho=''){
            $eventos='';
            $valor=!empty($option)?1:0;
            if($valor==1){
                $identificador=!empty($identificador)?"id='".$identificador."'":"";
                $estilo=!empty($estilo)?"class='".$estilo."'":"";
                $ancho=!empty($ancho)?"style='width:".$ancho."'":"";
                $cadenaEvento=!empty($evento)?1:0;
                if($cadenaEvento==1){
                        $evento=split(',',$evento);
                        foreach ($evento as $indice => $valor){
                                $eventos.=$valor.'="'.$funcion.'" ';
                        }
                }
            $html = "<select $identificador $estilo $eventos $ancho >".$option."</select>";
            }
            else	$html=$option;
            return $html;
    }
}

Class RadioButton{
    private $arrayRadio;
    private $optionsHTML;
    public function __construct($_arrayRadio=array()){
            $this->arrayRadio = empty($_arrayRadio)?array():$_arrayRadio;
            $this->arrayRadio = is_array($this->arrayRadio)?$this->arrayRadio:array();
    }
    public function getArrayRadio(){
            return $this->arrayRadio;
    }
    public function setArrayRadio($_arrayRadio){
            $arrayRadio = empty($_arrayRadio)?array():$_arrayRadio;
    }
    public function getOptionsHTML($indSel='',$onclick='',$Grupo=''){
        //echo "Nuevo<br>";
        //echo "me escogiste".$indSel;
        $_optionsHTML = "";
        //$valorDefault=empty($valorDefault)?'null':$valorDefault;
        $Grupo = empty($Grupo)?'Grupo':$Grupo;

        //$_optionsHTML = $valorDefault=='null' || $valorDefault==null?"":"<option value=\"\">$valorDefault</option>";
        $i=0;
        foreach ($this->arrayRadio as $indice => $nombre){
            //echo "$indice  $valor<br>";
            if($i==0)$checked = 'checked';
            else $checked = $indSel == $indice?"'checked'":"";
            $_optionsHTML.= "\t"."<label><input name=$Grupo type=\"radio\"  id='$nombre' value='$nombre' onClick=$onclick $checked>".$nombre."</label>"."\n";
        }
        //<label><input name="Grupo0" type="radio" id="Grupo_1" value="radio1">Radio</label>
        $this->optionsHTML = $_optionsHTML;
        return $this->optionsHTML;
    }
   
}

class Tabla{
	private $estiloFila1;
	private $estiloFila2;	
	private $estiloFilaEncima;
	private $estiloCabecera;
	private $arrayCabecera;
	private $arrayFilas;
	private $indClave;
	private $class;
	private $ancho;
	private $funcionOnClick;
        function __construct($_arrayCabecera='',$_arrayFilas='',$_estiloFila1='',$_estiloFila2='',$_estiloFilaEncima='',$_estiloCabecera='',$_indClave='',$_funcionOnClick=''){
            $this->estiloFila1=$_estiloFila1;
            $this->estiloFila2=$_estiloFila2;
            $this->estiloFilaEncima=$_estiloFilaEncima;
            $this->estiloCabecera=$_estiloCabecera;
            $this->arrayCabecera=$_arrayCabecera;
            $this->arrayFilas = $_arrayFilas;
            $this->indClave = $_indClave;
            $this->funcionOnClick = $_funcionOnClick;
            $this->class='';
            $this->ancho='';
            return;
	}
	public function setArrayCabecera($_arrayCabecera){
		$this->arrayCabecera=empty($_arrayCabecera)?array():$_arrayCabecera;
	}
	public function getCabeceraHTML($_arrayCabecera=''){
		$_arrayCabecera = empty($_arrayCabecera)?$this->arrayCabecera:$_arrayCabecera;
		$cabeceraHTML=$this->getFilaHTML($_arrayCabecera,$_arrayCabecera,-1,'',$this->estiloCabecera,$this->estiloCabecera);
		return $cabeceraHTML;
	}
	public function getFilasHTML($_arrayFilas='',$_indClave=-1,$_funcionOnClick=''){
            $_funcionOnClick = empty($_funcionOnClick)?$this->funcionOnClick:$_funcionOnClick;
            $_indClave=$_indClave<0?$this->indClave:$_indClave;
            $_arrayFilas = empty($_arrayFilas)?$this->arrayFilas:$_arrayFilas;
            $flat=true;
            $filasHTML="";
            foreach ($_arrayFilas as $i=>$arrayFila){
                $estiloFila = $flat?$this->estiloFila1:$this->estiloFila2;
                $flat=!$flat;
                $filasHTML.= $this->getFilaHTML($arrayFila,$this->arrayCabecera,$_indClave,$_funcionOnClick,$estiloFila,$this->estiloFilaEncima);
            }
            return $filasHTML;
	}
    
	public function getFilaHTML($_arrayFila=array(),$_arrayCols=array(),$_indiceClave=-1,$_funcionOnClick='',$_estiloFila='',$_estiloFilaEncima=''){
                $filaHTML = "";
		$_arrayMostrar =array();// array_intersect_key($_arrayFila,$_arrayCols);
		foreach ($_arrayCols as $i=>$val){
                    $_arrayMostrar[$i] = (!isset($_arrayFila[$i]) ? '':$_arrayFila[$i]);
		}
                $ind=(!isset($_arrayFila[$_indiceClave]) ? '':$_arrayFila[$_indiceClave]);
		$onclick = ($_indiceClave>=0 ? "onclick=\"$_funcionOnClick('$ind');\"":"");
                $idValorClave=$_indiceClave>=0?"id=\"$ind\"":'';
                $filaHTML="<tr $idValorClave $onclick class=\"$_estiloFila\" onmouseover=\"className='$_estiloFilaEncima'\" onmouseout=\"className='$_estiloFila'\" >"."\n";
                foreach ($_arrayMostrar as $indice => $valor){
                    $filaHTML.= "\t"."<td>".$valor."</td>"."\n";
                    $flat = true;
		}
		$filaHTML.="</tr>\n";
		return $filaHTML;
	}

	public function getTabla(){
            //$return = !empty($this->arrayFilas) ? $this->getCabeceraHTML().$this->getFilasHTML():"NO EXISTEN RESULTADOS";
            //$return = !empty($this->arrayFilas) ? $this->getCabeceraHTML().$this->getFilasHTML():"NO EXISTEN RESULTADOS";
            $nCols  = count($this->arrayCabecera);
            $return = !empty($this->arrayFilas) ? $this->getCabeceraHTML().$this->getFilasHTML():$this->getCabeceraHTML()."<tr height='25'><td colspan='".$nCols."' align='center'>NO EXISTEN RESULTADOS</td></tr>";
            return $return;
	}
}



class ToollBar
{
	private $bDivStyle;
	private $bPermiso;
	private $bAlign;
	private $bBoton = array();
	private $bBotonName = array();
	private $bStyle = array();
	private $bEvento = array();
	private $bFuncionJava = array();
	private $bImage = array();
	private $bwidth = array();
	private $bactive = array();
	private $bForm;
	private $bBotonTitle = array();
	private $bServicios  = array();

	public function __construct($palign="left",$style="btns",$form="",$param =false)
	{
            $this->bDivStyle=$style;
            $this->bAlign=$palign;
            $this->bForm=$form;
            $this->bPermiso=$param;
	}
    public function setFormulario($form = ''){
        $this->bForm = $form;
    }
    public function setServicios($servicios = array()) {
	//var_dump($servicios);
		$this->bPermiso=true;
        $this->bServicios = $servicios;
    }
	public function SetStyle($param) {
		$this->bDivStyle=$param;
	}

	public function SetBoton($pboton,$pbotonname,$style,$evento,$funcionjava,$image,$ancho="",$title="",$activo=true) {
            $i=count($this->bBoton);
            $this->bBoton[$i] = $pboton;
            $this->bBotonName[$i] = $pbotonname;
            $this->bStyle[$i] = $style;
            $this->bEvento[$i] = $evento;
            $this->bFuncionJava[$i] = $funcionjava;
            $this->bImage[$i] = $image;
            $this->bwidth[$i] = $ancho;
            $this->bBotonTitle[$i] = $title;
            $this->bactive[$i] = $activo;
	}

	public function Mostrar() {
            $i=0;
            $n=count($this->bBoton);
            $botones= "<div id='$this->bDivStyle' class='$this->bDivStyle'><ul>";
            if($this->bPermiso){
                $arrayPermisos  = $_SESSION['permisos_servicios'];
                $dir_imagen=$this->bImage[$i];
                $arrayPermisosBD = array();
                foreach($arrayPermisos as $var){
                    if($var['iid_formulario'] == $this->bForm){
                        $arrayPermisosBD[] = $var['vnombre'];
                    }
                }
             }
             else{
                $dir_imagen=$this->bImage[$i];
             }
            /*echo "tarde";
            echo "-------------------------------";
            var_export($this->bBoton);
            echo "-----------------------------------";*/
            foreach($this->bBoton as $i=>$b)   //$i=0;$i<$n;$i++
            {
                $otros="";
                if(!empty($arrayPermisosBD)){
                        if(in_array($this->bServicios[$i],$arrayPermisosBD) || empty($this->bServicios[$i])){
                            //|| $this->bServicios[$i] == 'true' || $this->bServicios[$i] == 't'
                            $band = 1;
                        } else {
                            $band = 0;
                        }
                }else{
                    $band = 1;
                }
                if($band == 1){
                    $evento=explode(",",$this->bEvento[$i]);
                    $eventos="";
                    for($k=0;$k<count($evento);$k++){
                        if(trim($evento[$k])!=""){
                            $eventos.=$evento[$k]."=\"if(window.".$this->bFuncionJava[$i].")
                            return ".$this->bFuncionJava[$i]."('".$this->bBoton[$i]."',this,'".$evento[$k]."',event);\"";
                        }
                    }
                    if($this->bwidth[$i]!="")
                    {
                        if($this->bactive[$i]==false) $style="style='width:".$this->bwidth[$i]."; display:none;' ";
                        else $style=" style='width:".$this->bwidth[$i].";'";
                    }
                    else
                    {
                        if($this->bactive[$i]==false) $style="style='display:none;' ";
                        else $style="";
                    }
                    //print_r($eventos)."<br><br><br>";
                    $botones.="
                            <li>
                            <a href='#'  id='".$this->bBoton[$i]."' class='".$this->bStyle[$i]."' style='float:$this->bAlign' $eventos>
                                <span $style id='btn_".trim($this->bForm).$this->bBoton[$i]."' >
                                    <img src='{$this->bImage[$i]}' alt='".$this->bBotonName[$i]."' align='absmiddle' title='".$this->bBotonTitle[$i]."'/> ".$this->bBotonName[$i]."
                                </span>
                            </a>
                            </li>
                            ";
                }
            }
            $botones.="</ul></div>";
            echo $botones;
	}
}

class ToollTab
{
	private $bDivStyle;
	private $bPermiso;
	private $bAlign;
	private $bBoton = array();
	private $bBotonName = array();
	private $bStyle = array();
	private $bEvento = array();
	private $bFuncionJava = array();
	private $bwidth = array();
	private $bForm;
	private $bBotonTitle = array();
	private $bactive = array();

	public function __construct($palign="left",$style="tabs",$form="",$param =false)
	{

		$this->bDivStyle=$style;
		$this->bAlign=$palign;
		$this->bForm=$form;
		$this->bPermiso=$param;

		/*
		faltas asignar permisos

		*/
	}

	public function SetStyle($param) {
		$this->bDivStyle=$param;
	}

	public function SetBoton($pboton,$pbotonname,$style,$evento,$funcionjava,$ancho="",$title="",$activo=true) {
		$i=count($this->bBoton);
		$this->bBoton[$i] = $pboton;
		$this->bBotonName[$i] = $pbotonname;
		$this->bStyle[$i] = $style;
		$this->bEvento[$i] = $evento;
		$this->bFuncionJava[$i] = $funcionjava;
		$this->bwidth[$i] = $ancho;
		$this->bBotonTitle[$i] = $title;
		$this->bactive[$i] = $activo;
	}

	public function Mostrar() {
		$n=count($this->bBoton);
		$botones= "<div id='$this->bDivStyle' class='$this->bDivStyle'><ul>";
		for($i=0;$i<$n;$i++)
		{
			//imagenes/icon/filenew.png;
			$evento=explode(",",$this->bEvento[$i]);
			$eventos="";
			for($k=0;$k<count($evento);$k++){
				if(trim($evento[$k])!="")
				$eventos.=$evento[$k]."=\"if(window.".$this->bFuncionJava[$i].")
				return ".$this->bFuncionJava[$i]."('".$this->bBoton[$i]."',this,'".$evento[$k]."',event);\"";
			}

			if($this->bwidth[$i]!="")
			{
					if($this->bactive[$i]==false) $style="style='width:".$this->bwidth[$i]."; display:none;' ";
					else $style=" style='width:".$this->bwidth[$i].";'";
			}
			else
			{
						if($this->bactive[$i]==false) $style="style='display:none;' ";
						else $style="";
			}

    		$botones.="
			<li><a href='#' id='".$this->bBoton[$i]."' class='".$this->bStyle[$i]."' style='float:$this->bAlign' title='".$this->bBotonTitle[$i]."'  $eventos>
			<span $style $tamanio id='btn_".trim($this->bForm).$this->bBoton[$i]."' >
			".$this->bBotonName[$i]."
			</span></a></li>";
		}
		$botones.="</ul></div>";
		echo $botones;

	}
}
class Calendar{		
		public	$marca_fecha;
		private $cal_mes;
		private $cal_ano;
		private $cal_dia;
		private $accion;
		private $resalta_dia;
		private $cal_fecha;
		private $cal_nom_dia;
		private $cal_nom_mes;		
		private $cal_Html;			
		public function __construct($cal_dia='',$cal_mes='',$cal_ano='',$accion='',$marca_dias='',$bloqueo_dias=''){
			$this->cal_mes=$cal_mes;
			$this->cal_ano=$cal_ano;	
			$this->cal_dia=$cal_dia;
			$this->accion=$accion;
			$this->cal_bloqueo=$bloqueo_dias;
			$this->cal_valores=$marca_dias;
			$this->validarDatos();			
		}
		private function validarDatos(){
			$this->cal_mes = $this->cal_mes==''?date('m'):$this->cal_mes;
			$this->cal_ano = $this->cal_ano==''?date('Y'):$this->cal_ano;
			$this->cal_dia = $this->cal_dia==''?date('d'):$this->cal_dia;
			$this->accion = $this->accion==''?'':$this->accion;
			$this->cal_bloqueo = $this->cal_bloqueo==''?0:$this->cal_bloqueo;
			if($this->accion==1)	$this->mesAnterior($this->cal_mes,$this->cal_ano);
			if($this->accion==2)	$this->mesSiguiente($this->cal_mes,$this->cal_ano);
			$this->cal_fecha=mktime(0, 0, 0, $this->cal_mes, $this->cal_dia, $this->cal_ano); 
			$this->cal_nom_dia=$this->diaEspanol(date('l',$this->cal_fecha));
			$this->cal_nom_mes=$this->mesEspanol(date('F',$this->cal_fecha));						
		}	
		private function seleccionaDias($_resalta_dia){
			$this->resalta_dia = $_resalta_dia;
		}
		private function diaEspanol($cadena_dia){
			$dia_ingles = array("Monday", "Tuesday", "Wednesday","Thursday","Friday","Saturday","Sunday");
			$dia_espanol   = array("Lunes", "Martes", "Miercoles","Jueves","Viernes","Sabado","Domingo");		
			return str_replace($dia_ingles, $dia_espanol, $cadena_dia);
		}
		private function mesEspanol($cadena_mes){	
			$mes_ingles = array("January", "February", "March", "April","May","June","July","August","September", "October", "November","December");
			$mes_espanol   = array("Enero", "Febrero", "Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			return str_replace($mes_ingles, $mes_espanol, $cadena_mes);
		}
		private function mesAnterior($cal_mes,$cal_ano){		
			$this->cal_ano = date('Y', mktime(0, 0, 0, $cal_mes-1, 1, $cal_ano));
			$this->cal_mes = date('m', mktime(0, 0, 0, $cal_mes-1, 1, $cal_ano));								
		}
		private function mesSiguiente($cal_mes,$cal_ano){
			$this->cal_ano = date('Y', mktime(0, 0, 0, $cal_mes+1, 1, $cal_ano));
			$this->cal_mes = date('m', mktime(0, 0, 0, $cal_mes+1, 1, $cal_ano));								
		}
		private function calendarioHTML(){			
			$cal_Html = '
			<div id="calendario_grid" align="center" style="width:100%; margin-top:5px; height:150px;">
				<table cellpadding="0" cellspacing="1" style="vertical-align:text-top; border: #666666 solid; border-width:0.1em">
  					<tr class="col1" style="font-size:10px; font-family:Verdana, Arial; background:url(imagenes/icon_gisp/bg_calendar.gif);" align="center">
						<td nowrap="nowrap" style="width:40px;"><input name="ano_menor" id="ano_menor" type="button" style=" background:url(imagenes/icon_gisp/bg_calendar.gif); width:40px; border-width:0; font-size:10px; font-family:Verdana, Arial;" onclick=myajax.Link("../../ccontrol/control/control.php?p1=cro_calendario&cal_dia='.$this->cal_dia.'&cal_mes='.$this->cal_mes.'&cal_ano='.($this->cal_ano-1).'&marcar_dias="+document.getElementById("cal_valores").value+"&resalta_dia='.$this->resalta_dia.'&accion=0&bloqueo_dias="+document.getElementById("cal_bloqueo").value,"calendario_grid") value="<<" /></td>      
      					<td nowrap="nowrap" style="width:40px;"><input name="mes_menor" id="mes_menor" type="button" style=" background:url(imagenes/icon_gisp/bg_calendar.gif); width:40px; border-width:0; font-size:10px; font-family:Verdana, Arial;" onclick=myajax.Link("../../ccontrol/control/control.php?p1=cro_calendario&cal_dia='.$this->cal_dia.'&cal_mes='.$this->cal_mes.'&cal_ano='.$this->cal_ano.'&marcar_dias="+document.getElementById("cal_valores").value+"&accion=1&resalta_dia='.$this->resalta_dia.'&bloqueo_dias="+document.getElementById("cal_bloqueo").value,"calendario_grid") value="<" /></td>
	  					<td colspan="3" nowrap="nowrap" style="width:40px;" align="center">'.$this->cal_nom_mes.' '.$this->cal_ano.'</td>
						<td nowrap="nowrap" style="width:40px;"><input name="mes_mayor" id="mes_mayor" type="button" style=" background:url(imagenes/icon_gisp/bg_calendar.gif); width:40px; border-width:0; font-size:10px; font-family:Verdana, Arial;" onclick=myajax.Link("../../ccontrol/control/control.php?p1=cro_calendario&cal_dia='.$this->cal_dia.'&cal_mes='.$this->cal_mes.'&cal_ano='.$this->cal_ano.'&marcar_dias="+document.getElementById("cal_valores").value+"&accion=2&resalta_dia='.$this->resalta_dia.'&bloqueo_dias="+document.getElementById("cal_bloqueo").value,"calendario_grid") value=">" /></td>
      					<td nowrap="nowrap" style="width:40px;"><input name="ano_mayor" id="ano_mayor" type="button" style=" background:url(imagenes/icon_gisp/bg_calendar.gif); width:40px; border-width:0; font-size:10px; font-family:Verdana, Arial;" onclick=myajax.Link("../../ccontrol/control/control.php?p1=cro_calendario&cal_dia='.$this->cal_dia.'&cal_mes='.$this->cal_mes.'&cal_ano='.($this->cal_ano+1).'&marcar_dias="+document.getElementById("cal_valores").value+"&resalta_dia='.$this->resalta_dia.'&accion=0&bloqueo_dias="+document.getElementById("cal_bloqueo").value,"calendario_grid") value=">>" /></td>
				</tr>
				<tr class="col1" style="font-size:10px; font-family:Verdana, Arial;" align="center">
				  <td nowrap="nowrap" style="background:#F1F1C7; width:40px;">Lun</td>
				  <td nowrap="nowrap" style="background:#F1F1C7; width:40px;">Mar</td>
				  <td nowrap="nowrap" style="background:#F1F1C7; width:40px;">Mie</td>
				  <td nowrap="nowrap" style="background:#F1F1C7; width:40px;">Jue</td>
				  <td nowrap="nowrap" style="background:#F1F1C7; width:40px;">Vie</td>
				  <td nowrap="nowrap" style="background:#F1F1C7; width:40px;">Sab</td>
				  <td nowrap="nowrap" style="background:#F1F1C7; width:40px; color:#990000">Dom</td>
				</tr>
				<tr>';
			return $cal_Html;
		}
		private function diasHTML(){
			$dia_fin = intval(date('d', mktime(0, 0, 0, ($this->cal_mes)+1, 0, $this->cal_ano)));					
			$num_dia=date("N", mktime(0, 0, 0, $this->cal_mes, 1, $this->cal_ano));					
			$band=0;					//INICIO DE DIAS	
			$j=1;						//INCIO FILAS	
			$k=1;						//INICIO COLUMNAS	
			$dia_cont=1;	
			for($i=1; $i<=42; $i++)		//BUCLE CREA CASILLEROS
			{		
				if( ($i==$num_dia or $band==1) and ($dia_cont<=$dia_fin) )
				{
					$cal_int_fecha=mktime(0, 0, 0, $this->cal_mes, $dia_cont, $this->cal_ano); 							
					$cal_int_nom_dia=$this->diaEspanol(date('l',$cal_int_fecha));
					$cal_int_nom_mes=$this->mesEspanol(date('F',$cal_int_fecha));			
					$dia_cont=str_pad($dia_cont,2,"0",STR_PAD_LEFT);		//RELLENA CON CEROS A LA IZQUIERDA
					if( strstr($this->cal_valores,$dia_cont.'/'.$this->cal_mes.'/'.$this->cal_ano) ) $bg_color="#81BFED";
					else	$bg_color="#E6E6E6";
					$dias_HTML .= '					    
					<td><input name="campo'.$j.$k.'" id="campo'.$j.$k.'" type="button" style="background:'.$bg_color.'; width:40px; border-width:0; font-size:10px; font-family:Verdana, Arial" value="'.$dia_cont.$aux.'" onclick=comprueba_marca("campo","'.$j.'","'.$k.'","'.$dia_cont.'","'.$this->cal_mes.'","'.trim($this->cal_ano).'","'.$bg_color.'")  onmouseover=muestra_dia("'.$cal_int_nom_dia.'","'.$dia_cont.'","'.$cal_int_nom_mes.'","'.$this->cal_ano.'","'.$this->cal_valores.'") />	
			      	</td>';      									
					$band=1;	
					$dia_cont++;													
				}
				else
				{
					$dias_HTML .= '
					<td><input name="campo'.$j.$k.'" id="campo'.$j.$k.'" type="button" style="background:#F5F5F5; width:40px; border-width:0; font-size:10px; font-family:Verdana, Arial;" />
      				</td>';
				}
				if($i%7==0)			//SI ES DOMINGO INICIAR NUEVA SEMANA/FILA
				{	$j++;			//INCREMENTAMOS FILAS
					$k=1;			//INICIAMOS COLUMNA
					$dias_HTML .= '
			    	</tr>
			    	<tr>';
		      	}
				else
				{
					$k++;			//INCREMENTAMOS COLUMNA
				}						
			}

    		$dias_HTML .= '	
				</tr>
				<tr class="col1" style="font-size:10px; font-family:Verdana, Arial; background:url(imagenes/icon_gisp/bg_calendar.gif);" align="center">
				  <td nowrap="nowrap" style="width:40px;"></td>            
				  <td colspan="5" nowrap="nowrap" style="width:40px;" align="center"><input type="text" id="cal_descripcion" name="cal_descripcion" style="width:220px; border-width:0; background:url(imagenes/icon_gisp/bg_calendar.gif); text-align:center"/></td>           
				  <td nowrap="nowrap" style="width:40px;"></td>
				</tr>
			</table>			
			<input type="hidden" id="cal_dia" name="cal_dia" value="'.$this->cal_dia.'"/>
			<input type="hidden" id="cal_mes" name="cal_mes" value="'.$this->cal_mes.'"/>
			<input type="hidden" dir="cal_ano" name="cal_ano" value="'.$this->cal_ano.'"/>
		</div>
			<input type="hidden" id="cal_bloqueo" name="cal_bloqueo" value="'.$this->cal_bloqueo.'" />
			<input type="hidden" id="cal_valores" name="cal_valores" value="'.$this->cal_valores.'"/>'; 
			return $dias_HTML;
		}
		public function enviarCalendarioHTML(){
			return $this->calendarioHTML().$this->diasHTML();
		}
}
?>