<?php
/*
FECHA DE INICIO ---->	20/06/08
REALIZARO 		---->	POR RENE CHOQUE DE MANDINGO
proyecto        ---->	SIIM
*/
	//require_once("../ingreso.php");
	function RecibirParametros($aParam)
	{
		if (array_key_exists($aParam, $_POST)) {
			return $_POST[$aParam];
		} elseif (array_key_exists($aParam, $_GET)) {
			return $_GET[$aParam];		
		} else return NULL;
	}


	function ConvertirParametros($aParam)
	{
		$retornar=RecibirParametros($aParam);
		$retornar=utf8_decode($retornar); 
		$retornar=str_replace('�','�',$retornar);
		$retornar=str_replace('�','�',$retornar);
		$retornar=str_replace('�','�',$retornar);
		$retornar=str_replace('�','�',$retornar);
		$retornar=str_replace('�','�',$retornar);
		$retornar=str_replace('�','�',$retornar);					
		$retornar=str_replace("\'","''",$retornar);					
		$retornar=str_replace('\"',"''",$retornar);
		return strtoupper($retornar);	
	}

	
	function ReemplazaCaracteres($retornar)
	{
	$retornar=str_replace('�','�',$retornar);
	$retornar=str_replace('�','�',$retornar);
	$retornar=str_replace('�','�',$retornar);
	$retornar=str_replace('�','�',$retornar);
	$retornar=str_replace('�','�',$retornar);
	$retornar=str_replace('�','�',$retornar);					
	$retornar=str_replace("\'","''",$retornar);					
	$retornar=str_replace('\"',"''",$retornar);
	$retornar=str_replace(trim(" \ "),"''",$retornar);
	$retornar=str_replace(trim(" ' "),"�",$retornar);
	//echo "<br>-->".strtoupper($retornar);	
	return strtoupper($retornar);	
	}
	function caracteres_html($texto)
	{
		  $texto = htmlentities($texto, ENT_NOQUOTES, 'UTF-8'); // Convertir caracteres especiales a entidades
		  $texto = htmlspecialchars_decode($texto, ENT_NOQUOTES); // Dejar <, & y > como estaban
		  return $texto;
    }
	function caracteres_html_array($arrayCadena)
	
	{	foreach($arrayCadena as $i=>$texto){
		  $texto = htmlentities($texto, ENT_NOQUOTES, 'UTF-8'); // Convertir caracteres especiales a entidades
		  $texto = htmlspecialchars_decode($texto, ENT_NOQUOTES); // Dejar <, & y > como estaban
		  $arrayCadena[$i]=$texto;
		  }
		  
		  return $arrayCadena;
		  
    }
	
	function convertir_caracteres_especiales($cadena)
	{
	$cadena = htmlentities($cadena);	
	$cadena=ereg_replace("&aacute;","�",$cadena);
	$cadena=ereg_replace("&eacute;","�",$cadena);
	$cadena=ereg_replace("&iacute;","�",$cadena);
	$cadena=ereg_replace("&ocute;","�",$cadena);
	$cadena=ereg_replace("&uacute;","�",$cadena);
	$cadena=ereg_replace("&Aacute;","�",$cadena);
	$cadena=ereg_replace("&Eacute;","�",$cadena);
	$cadena=ereg_replace("&Iacute;","�",$cadena);
	$cadena=ereg_replace("&Oacute;","�",$cadena);
	$cadena=ereg_replace("&Uacute;","�",$cadena);
	$cadena=ereg_replace("&ntilde;","�",$cadena);
	$cadena=ereg_replace("&Ntilde;","�",$cadena);
	$cadena=ereg_replace("&deg;","�",$cadena);
	$cadena=ereg_replace("&ordm;","�",$cadena);
	$cadena=ereg_replace("&ordf;","�",$cadena);
	$cadena=ereg_replace("&quot;","\"",$cadena);
	$cadena=str_replace("\'","'",$cadena);					
	$cadena=str_replace('\"',"''",$cadena);
	$cadena=str_replace("'","'",$cadena);					
	$cadena=str_replace('"',"''",$cadena);
	$cadena=str_replace('&',"Y",$cadena);	
	return trim($cadena);
	}




//function compara_fechas($fecha1,$fecha2)
//{
//            
//
//      if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha1))
//            
//
//              list($dia1,$mes1,$a�o1)=split("/",$fecha1);
//            
//
//      if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha1))
//            
//
//              list($dia1,$mes1,$a�o1)=split("-",$fecha1);
//        if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha2))
//            
//
//              list($dia2,$mes2,$a�o2)=split("/",$fecha2);
//            
//
//      if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha2))
//            
//
//              list($dia2,$mes2,$a�o2)=split("-",$fecha2);
//        $dif = mktime(0,0,0,$mes1,$dia1,$a�o1) - mktime(0,0,0, $mes2,$dia2,$a�o2);
//        return ($dif);                         
//            
//
//}

function ordenar($cadena)
{
        $tmp=0;
		$a=split(",",$cadena);
		//echo "<br>".$cadena;
		//echo "<br>cantidad".count($a);
        for($k = 1; $k < count($a); $k++)
            for($i = 0; $i < count($a) - 1; $i++)
            {
                if (intval($a[$i])>intval($a[$i+1]))
                {
                    $tmp = $a[$i];
                    $a[$i] = $a[$i+1];
                    $a[$i+1] = $tmp;    
                }
            }
	$cadena=implode(",",$a);
	//echo "<br>".$cadena;
	return $cadena;
}
function Siguiente_Id($aTable,$aField1,$sql) 
{
		global $Coneccion; 
		$spr_id = new TSPResult($Coneccion, "fn_nextid");
  		$spr_id->pg_Parametros_SP('aTable', $aTable);
  		$spr_id->pg_Parametros_SP('aField', $aField1);
		if($sql!='0' or strlen(trim($sql))>1)
			$spr_id->pg_Parametros_SP('aWhere', "ano_eje = ''" .date("Y"). "'' and $aField1 not like ''%.%'' ".$sql);
		else
			$spr_id->pg_Parametros_SP('aWhere', "ano_eje = ''" .date("Y"). "'' and $aField1 not like ''%.%'' ");
		$spr_id->pg_Poner_Esquema("logistica");
		$spr_id->pg_Campos_Select('*');
	 	$spr_id->pg_Paginacion(ALL);
		$spr_id->executeSP();
		//echo $spr_id->pg_Store_Procedure();		
		$result = $spr_id->pg_Get_Row();
		return $result[0];
};
	
	function ParamExists($aParam) {
	  return (RecibirParametros($aParam) <> NULL); 
	}	

	function valor_check($campo)
	{
	if(strtoupper($campo)=="ON" or strtoupper($campo)=="T" or strtoupper($campo)=="TRUE" or strtoupper($campo)=="1")
		return "t";
	else
		return "f";
	}
	
	function numerotexto ($numero) { 
		// Primero tomamos el numero y le quitamos los caracteres especiales y extras 
		// Dejando solamente el punto "." que separa los decimales 
		// Si encuentra mas de un punto, devuelve error. 
		// NOTA: Para los paises en que el punto y la coma se usan de forma 
		// inversa, solo hay que cambiar la coma por punto en el array de "extras" 
		// y el punto por coma en el explode de $partes 
		 
		$extras= array("/[\$]/","/ /","/,/","/-/"); 
		$limpio=preg_replace($extras,"",$numero); 
		$partes=explode(".",$limpio); 
		if (count($partes)>2) { 
			return "Error, el n&uacute;mero no es correcto"; 
			exit(); 
		} 
		 
		// Ahora explotamos la parte del numero en elementos de un array que 
		// llamaremos $digitos, y contamos los grupos de tres digitos 
		// resultantes 
		 
		$digitos_piezas=chunk_split ($partes[0],1,"#"); 
		$digitos_piezas=substr($digitos_piezas,0,strlen($digitos_piezas)-1); 
		$digitos=explode("#",$digitos_piezas); 
		$todos=count($digitos); 
		$grupos=ceil (count($digitos)/3); 
		 
		// comenzamos a dar formato a cada grupo 
		 
		$unidad = array   ('un','dos','tres','cuatro','cinco','seis','siete','ocho','nueve'); 
		$decenas = array ('diez','once','doce', 'trece','catorce','quince'); 
		$decena = array   ('dieci','veinti','treinta','cuarenta','cincuenta','sesenta','setenta','ochenta','noventa'); 
		$centena = array   ('ciento','doscientos','trescientos','cuatrocientos','quinientos','seiscientos','setecientos','ochocientos','novecientos'); 
		$resto=$todos; 
		 
		for ($i=1; $i<=$grupos; $i++) { 
			 
			// Hacemos el grupo 
			if ($resto>=3) { 
				$corte=3; } else { 
				$corte=$resto; 
			} 
				$offset=(($i*3)-3)+$corte; 
				$offset=$offset*(-1); 
			 
			// la siguiente seccion es una adaptacion de la contribucion de cofyman y JavierB 
			 
			$num=implode("",array_slice ($digitos,$offset,$corte)); 
			$resultado[$i] = ""; 
			$cen = (int) ($num / 100);              //Cifra de las centenas 
			$doble = $num - ($cen*100);             //Cifras de las decenas y unidades 
			$dec = (int)($num / 10) - ($cen*10);    //Cifra de las decenas 
			$uni = $num - ($dec*10) - ($cen*100);   //Cifra de las unidades 
			if ($cen > 0) { 
			   if ($num == 100) $resultado[$i] = "cien"; 
			   else $resultado[$i] = $centena[$cen-1].' '; 
			}//end if 
			if ($doble>0) { 
			   if ($doble == 20) { 
				  $resultado[$i] .= " veinte"; 
			   }elseif (($doble < 16) and ($doble>9)) { 
				  $resultado[$i] .= $decenas[$doble-10]; 
			   }else { 
				  $resultado[$i] .=' '. $decena[$dec-1]; 
			   }//end if 
			   if ($dec>2 and $uni<>0) $resultado[$i] .=' y '; 
			   if (($uni>0) and ($doble>15) or ($dec==0)) { 
				  if ($i==1 && $uni == 1) $resultado[$i].="uno"; 
				  elseif ($i==2 && $num == 1) $resultado[$i].=""; 
				  else $resultado[$i].=$unidad[$uni-1]; 
			   } 
			} 
	
			// Le agregamos la terminacion del grupo 
			switch ($i) { 
				case 2: 
				$resultado[$i].= ($resultado[$i]=="") ? "" : " mil "; 
				break; 
				case 3: 
				$resultado[$i].= ($num==1) ? " mill&oacute;n " : " millones "; 
				break; 
			} 
			$resto-=$corte; 
		} 
		 
		// Sacamos el resultado (primero invertimos el array) 
		$resultado_inv= array_reverse($resultado, TRUE); 
		$final=""; 
		foreach ($resultado_inv as $parte){ 

			$final.=$parte; 
		} 
		return $final; 
	}




	function numerotexto2($num, $fem = false, $dec = true) {
			//if (strlen($num) > 14) die("El n�mero introducido es demasiado grande");
			$matuni[2]  = "dos";
			$matuni[3]  = "tres";
			$matuni[4]  = "cuatro";
			$matuni[5]  = "cinco";
			$matuni[6]  = "seis";
			$matuni[7]  = "siete";
			$matuni[8]  = "ocho";
			$matuni[9]  = "nueve";
			$matuni[10] = "diez";
			$matuni[11] = "once";
			$matuni[12] = "doce";
			$matuni[13] = "trece";
			$matuni[14] = "catorce";
			$matuni[15] = "quince";
			$matuni[16] = "dieciseis";
			$matuni[17] = "diecisiete";
			$matuni[18] = "dieciocho";
			$matuni[19] = "diecinueve";
			$matuni[20] = "veinte";
			//$matunisub[1] = "un";
			$matunisub[2] = "dos";
			$matunisub[3] = "tres";
			$matunisub[4] = "cuatro";
			$matunisub[5] = "quin";
			$matunisub[6] = "seis";
			$matunisub[7] = "sete";
			$matunisub[8] = "ocho";
			$matunisub[9] = "nove";
			$matdec[2] = "veint";
			$matdec[3] = "treinta";
			$matdec[4] = "cuarenta";
			$matdec[5] = "cincuenta";
			$matdec[6] = "sesenta";
			$matdec[7] = "setenta";
			$matdec[8] = "ochenta";
			$matdec[9] = "noventa";
			$matsub[3]  = 'mill';
			$matsub[5]  = 'bill';
			$matsub[7]  = 'mill';
			$matsub[9]  = 'trill';
			$matsub[11] = 'mill';
			$matsub[13] = 'bill';
			$matsub[15] = 'mill';
			$matmil[4]  = 'millones';
			$matmil[6]  = 'billones';
			$matmil[7]  = 'de billones';
			$matmil[8]  = 'millones de billones';
			$matmil[10] = 'trillones';
			$matmil[11] = 'de trillones';
			$matmil[12] = 'millones de trillones';
			$matmil[13] = 'de trillones';
			$matmil[14] = 'billones de trillones';
			$matmil[15] = 'de billones de trillones';
			$matmil[16] = 'millones de billones de trillones';
			$num = trim((string)@$num);
			if ($num[0] == '-') {
				$neg = 'menos ';
				$num = substr($num, 1);
			} else
				$neg = '';
			while ($num[0] == '0') $num = substr($num, 1);
			if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num;
			$zeros = true;
			$punt = false;
			$ent = '';
			$fra = '';
			for ($c = 0; $c < strlen($num); $c++) {
				$n = $num[$c];
				if (! (strpos(".,'''", $n) === false)) {
					if ($punt) break;
					else{
						$punt = true;
						continue;
					}
				} elseif (! (strpos('0123456789', $n) === false)) {
					if ($punt) {
						if ($n != '0') $zeros = false;
						$fra .= $n;
					} else
						$ent .= $n;
				}else
					break;
			}
   
			$ent = '     ' . $ent;
   
			if ($dec and $fra) {
				$fin = ' con ';
				/*for ($n = 0; $n < strlen($fra); $n++) {
					if (($s = $fra[$n]) == '0')
						$fin .= '0';
					elseif ($s == '1')
						$fin .= $fem ? '1' : '1';
					else
						$fin .= $s;
            	}*/
				$fin.=$fra;
				$fin.= "/100";
			}else
				$fin = '';
			if ((int)$ent === 0) return 'Cero ' . $fin;
			$tex = '';
			$sub = 0;
			$mils = 0;
			$neutro = false;
			
			while ( ($num = substr($ent, -3)) != '   ') {
				$ent = substr($ent, 0, -3);
				if (++$sub < 3 and $fem) {
					$matuni[1] = 'una';
					$subcent = 'as';
				} else {
					$matuni[1] = $neutro ? 'un' : 'uno';
					$subcent = 'os';
				}
				$t = '';
				$n2 = substr($num, 1);
				if ($n2 == '00') {
				} elseif ($n2 < 21)
					$t = ' ' . $matuni[(int)$n2];
				elseif ($n2 < 30) {
					$n3 = $num[2];
					if ($n3 != 0) $t = 'i' . $matuni[$n3];
					$n2 = $num[1];
					$t = ' ' . $matdec[$n2] . $t;
				} else {
					$n3 = $num[2];
					if ($n3 != 0) $t = ' y ' . $matuni[$n3];
					$n2 = $num[1];
					$t = ' ' . $matdec[$n2] . $t;
				}

				$n = $num[0];
				if ($n == 1) {
					if($num[1].$num[2] == '00')
						$t = ' cien' . $t;
					else
						$t = ' ciento' . $t;
				}elseif ($n == 5){
						$t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t;
				}elseif ($n != 0){
						$t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t;
				}
						 
				if ($sub == 1) {
				} elseif (! isset($matsub[$sub])) {
					if ($num == 1) {
						$t = ' un mil';
					}elseif ($num > 1) {
						$t .= ' mil';
					}
				} elseif ($num == 1) {
					$t .= ' ' . $matsub[$sub] . '�n';
				}elseif ($num > 1) {
					$t .= ' ' . $matsub[$sub] . 'ones';
				}   
				if ($num == '000') $mils ++;
				elseif ($mils != 0) {
					if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub];
						$mils = 0;
				}
				$neutro = true;
				$tex = $t . $tex;
			}
			$tex = $neg . substr($tex, 1) . $fin;
			return ucfirst($tex);
		}
		



function Nombre_del_Mes($num_mes)
{
	$nombre_mes="";
	switch($num_mes)
	{
		case 1:
			$nombre_mes="Enero";
			break;
		case 2:
			$nombre_mes="Febrero";
			break;
		case 3:
			$nombre_mes="Marzo";
			break;
		case 4:
			$nombre_mes="Abril";
			break;
		case 5:
			$nombre_mes="Mayo";
			break;
		case 6:
			$nombre_mes="Junio";
			break;
		case 7:
			$nombre_mes="Julio";
			break;
		case 8:
			$nombre_mes="Agosto";
			break;
		case 9:
			$nombre_mes="Septiembre";
			break;
		case 10:
			$nombre_mes="Octubre";
			break;
		case 11:
			$nombre_mes="Noviembre";
			break;
		case 12:
			$nombre_mes="Diciembre";
			break;
	}
	return $nombre_mes;
}


function AlmacenarVariableSesion($campo,$valor)
{
    global $sess;
    session_name("SIIM");
    session_start();
    $sess=$sess;
    $sess[$campo]=$valor;
    session_register('sess');
}
//////FUNCIONES AGREGADAS SIMEDH/////////////////////////
function getDia( $timestamp = 0 ){
$timestamp = $timestamp == 0 ? time() : $timestamp;
$dias = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','S�bado');
return $dias[date("w", $timestamp)];
}

function getMes( $timestamp = 0 ){
$timestamp = $timestamp == 0 ? time() : $timestamp;
$meses = array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
return $meses[date("n", $timestamp)];
}
//////FIN FUNCIONES SIMEDH/////////////////////////

//// funcion completaCeros agregada por jan // no la borren ah o avisen ok!

function completaCeros($valor,$numDigitos){
$numCadena=str_pad($valor,$numDigitos,0,str_pad_left);
return ($numCadena);
}
/******************************************	funciones miguel	******************************************************/
function ReemplazaCaracteresRegulares($str_texto){
	$str_temTexto;
	$str_temTexto = "";
	
	for($i=0;$i<strlen($str_texto);$i++){
		$letra = substr($str_texto,$i,1);
		switch($letra){
			case '�':
				$str_temTexto = $str_temTexto.'&aacute;';
			break;
			case '�':
				$str_temTexto = $str_temTexto.'&eacute;';
			break;
			case '�':
				$str_temTexto = $str_temTexto.'&iacute;';
			break;
			case '�':
				$str_temTexto = $str_temTexto.'&oacute;';
			break;
			case '�':
				$str_temTexto = $str_temTexto.'&uacute;';
			break;
			case '�':
				$str_temTexto = $str_temTexto.'�';
			break;
			case '�': 
				$str_temTexto = $str_temTexto.'�';
			break;
			case '�':
				$str_temTexto = $str_temTexto.'�';
			break;
			case '�':
				$str_temTexto = $str_temTexto.'�';
			break;
			case '�':
				$str_temTexto = $str_temTexto.'�';
			break;
			case '�':
				$str_temTexto = $str_temTexto.'&ntilde;';
			break;


			case '�':
				$str_temTexto = $str_temTexto.'&deg;';
			break;
			default :
				$str_temTexto = $str_temTexto.$letra;//str_texto.charAt(i);
			break;
		}
	}
	return $str_temTexto;
}


function ComprobarSiBisisesto($anio){
if ( ( $anio % 100 != 0) && (($anio % 4 == 0) || ($anio % 400 == 0))) {
  return true;
  }
else {
  return false;
  }
}


function UltimoDiaDeMes($mes,$anio)
{
  switch(intval($mes))
  {
	  case 1:
	  case 3:
	  case 5:
	  case 7:
	  case 8:
	  case 10:
	  case 12:
		  $numDias=31;
	  break;
	  case 4: case 6: case 9: case 11:
		  $numDias=30;
	  break;
	  case 2:
		  if (ComprobarSiBisisesto($anio)){ $numDias=29; }else{ $numDias=28; }
		  break;
	  default:
		  return false;
  }
  return $numDias;
}

function AniadirDiasFecha($fecha,$diasaniadir)
{
	//if(diasaniadir>30){ alert("no funciona"); return false;}
  $dia  =  substr($fecha,0,2);
  $mes  =  substr($fecha,3,2);
  $anio =  substr($fecha,6,4);

	$nrodiasmes=UltimoDiaDeMes($mes,$anio);
	while($diasaniadir>0)
	{
		$difdias=$nrodiasmes-$dia;				
		if($difdias>=$diasaniadir) //16>16
		{
			$dia=$dia+$diasaniadir;
			$diasaniadir=0;			
		}
		else
		{
			$dia=$dia+$diasaniadir-$nrodiasmes;
			if($mes==12) {$mes=1; $anio=$anio+1;}
			else	$mes=$mes+1;	

			$nrodiasmes=UltimoDiaDeMes($mes,$anio);
			if(dia>$nrodiasmes)
			{
				$diasaniadir=$dia-$nrodiasmes;
				$dia=$nrodiasmes;
			}
			else
				$diasaniadir=0;
			
		}
	}
	$nuevofecha=completaCeros($dia,2)."/".completaCeros($mes,2)."/".completaCeros($anio,4);
	//alert(nuevofecha);
	return $nuevofecha;
}
?>