<?php
	var_dump($_SESSION);
	$alineacion=3;
	$path=$_SESSION['path_principal'].'menu/menu/';	
 	$num = count($_SESSION['permiso_formulario']);
	
        echo $num;
	if($num>0)
	{					
		$dep_ant=-1;
		$depende_ant=-1;
		$menu=0;
		$nivel_anterior=-1;
		$count_menu=0;
		$count[]='';
		$numero[]='';

		echo "<script>
		stm_bm(['menu4878',830,'','".$path."blank.gif',0,'','',$alineacion,0,200,0,200,1,0,0,'','',0,0,1,2,'default','hand',''],this);	
  		stm_bp('p0',[0,4,0,0,3,4,22,9,100,'',-2,'',-2,50,2,3,'#999999','transparent','".$path."bg_menu.gif',1,0,0,'#A9CFDB #93C0CE #155E8C']);		
		";	

		$primero=1;		
		$var=0;	
		foreach($_SESSION['permisos'] as $indice => $valor) { 
			
			$row = $_SESSION['permiso_formulario'][$indice];
			
			$file="javascript:CargarVentanaFormulario(\"".$row['vforma_abrir']."\",\"".str_replace(' ','',$row['vnombre'])."\",\"".$row['vnombre']."\",\"".$row['varchivo']."\",\"".$row['iwidth']."\",\"".$row['iheight']."\",\"".$row['bcenter']."\",\"".$row['bresizable']."\",\"".$row['bmodal']."\",\"".$row['vstyle']."\",\"".$row['iopacity']."\",\"".$row['veffect']."\",\"".$row['iposx1']."\",\"".$row['iposx2']."\",\"".$row['iposy1']."\",\"".$row['iposy2']."\",\"".$row['varchivo2']."\",\"".$row['vfunctionjava']."\");";
			
											
			if($row['idepende']<>$dep_ant) {					
				if($row['inivel']<$nivel_anterior) {
					$x=$nivel_anterior-$row['inivel'];
					while($x>0)	{
						echo "stm_ep();";
						$x--;
					}
					$menu--;					
					$pri=0;					
				} else {
					$pri=1;
				}
				$nivel_anterior=$row['inivel'];				
				if(trim($numero[$row['idepende']])=='')	$numero[$row['idepende']]=$menu; 
				$dep_ant=$row['idepende']; 
				$band=1;
								
				if(trim($count[$row['idepende']])=='')	$count[$row['idepende']]=0;
				else									$count[$row['idepende']]++;
				
				if($pri==1 and $row['inivel']==2) {
					echo "stm_bp('p1',[1,4,0,0,0,4,18,7,100,'',-2,'',-2,50,2,3,'#999999','#007436','',1,0,0,'#A9CFDB #93C0CE #155E8C']);";					
					$pri=0;
				} elseif($pri==1 and $row['idepende']<>1 and $row['idepende']<>0) {	
					echo "stm_bpx('p".$numero[$row['idepende']]."','p1',[1,2,0,0,3,4,7,0,100,'',-2,'',-2,50,2,3,'#999999','#007436','',0]);";										
					$pri=0;
				}				
			} else {					 					  
				$band=0;
				$count[$row['idepende']]++;
			}
								
			/////////////////////////
			/////// CABECERAS ///////
			/////////////////////////
			
			if($row['bfinal']=='f') {					
				if($row['inivel']==1 and $primero==1) {
					echo "
					stm_ai('p".$row['inivel']."i".$count[$row['idepende']]."',[0,'".$row['vnombre']."','','',-1,-1,0,'','_self','','','','',0,0,0,'','',0,0,0,0,1,'',0,'#FF9900',0,'','',3,3,0,0,'#FFFFF7','#00FF00','#FFFFFF','#000000','8pt Tahoma','8pt Tahoma',0,0]);
					stm_bp('p1',[1,4,0,0,0,4,22,9,100,'',-2,'',-2,50,2,3,'#999999','#007436','',1,0,0,'#A9CFDB #93C0CE #155E8C']);																
					";
					$primero=0;
				} else { 	
					if($row['inivel']==1) {							
						echo "stm_aix('p".$numero[$row['idepende']]."i".$count[$row['idepende']]."','p0i0',[0,'".$row['vnombre']."','','',-1,-1,0,'','_self','','','','',0,0,0,'','',0,0,0,0,1,'',0,'#FF9900',0,'','',3,3,0,0,'#FFFFF7','#00FF00','#FFFFFF','#000000','8pt Tahoma','8pt Tahoma',0,0]);";																											
					} else {
						echo "stm_aix('p".$numero[$row['idepende']]."i".$count[$row['idepende']]."','p0i0',[0,'".$row['vnombre']."','','',-1,-1,0,'','_self','','','','',0,0,0,'".$path."arrow_r.gif','".$path."arrow_r.gif',7,7,0,0,1,'',1,'#FF9900',0,'','',3,3,0,0,'#FFFFF7','#00FF00','#FFFFFF','#000000','8pt Tahoma','8pt Tahoma',0,0]);";
					}		
				}					
			} else {	
					
				$niv=$row['inivel'];																				
				if($depende_ant<>$row['idepende'])	$count_menu++;
				
				echo "stm_aix('p".$numero[$row['idepende']]."i".$count[$row['idepende']]."','p0i0',[0,'".$row['vnombre']."','','',-1,-1,0,'".$file."','_self','','','','',0,0,0,'','',0,0,0,0,1 ,'',0,'#FF9900',0,'','',3,3,0,0,'#FFFFF7','#00FF00','#FFFFFF','#000000','8pt Tahoma','8pt Tahoma',0,0]);";							
			}
			
			if($band==1)	$menu++;
			
			$var++;			
		} 
		//FIN WHILE
		echo "stm_ep();	stm_em();	</script>";
	} 
	//FIN DE IF
	else
                header("Location: ../../../index.php");
		//echo 'Datos de menu no registrados';
?>