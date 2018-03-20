
<?php		
	////////////////////	
	//PARAMETROS DE MENU
	////////////////////	
						
	$alineacion=3;
        $path='../../../menu/menu01/';
 	$num = count($_SESSION['permiso_formulario']);
       
	if($num>0){
		$dep_ant=-1;
		$depende_ant=-1;
		$menu=0;
		$nivel_anterior=-1;
		$count_menu=0;
		$count[]='';
		$numero[]='';
                
?>
	<script>
		stm_bm(["menu4878",830,"","<?php echo $path?>blank.gif",0,"","",<?php echo $alineacion?>,0,200,0,200,1,0,0,"","",0,0,1,2,"default","hand",""],this);
  		stm_bp("p0",[0,4,0,0,3,4,22,9,100,"",-2,"",-2,50,2,3,"#999999","transparent","<?php echo $path.'bg_menu.gif'?>",1,0,0,"#A9CFDB #93C0CE #155E8C"]);
        </script>
<?php	
		$primero=1;		
		$var=0;
                
		foreach($_SESSION['permiso_formulario'] as $indice => $valor) {
                        
			$row = $_SESSION['permiso_formulario'][$indice];
					
			$file=$row['vfile_formulario'];
                        //print_r($row['vfile_formulario']);
											
			if($row['idepende_formulario']<>$dep_ant)	
			{	
				if($row['inivel_formulario']<$nivel_anterior)
				{
					$x=$nivel_anterior-$row['inivel_formulario'];
					while($x>0)
					{
?>
        <script>
			stm_ep();
        </script>
<?php			
						$x--;
					}
					$menu--;
					$pri=0;					
				}			
				else
				{
					$pri=1;
				}		
				$nivel_anterior=$row['inivel_formulario'];				
				if(trim($numero[$row['idepende_formulario']])=='')	$numero[$row['idepende_formulario']]=$menu; 
				$dep_ant=$row['idepende_formulario']; 
				$band=1;
								
				if(trim($count[$row['idepende_formulario']])=='')	$count[$row['idepende_formulario']]=0;
				else												$count[$row['idepende_formulario']]++;
				
				//if($row['orden_formulario']==1 and $row['inivel_formulario']==1)
				if($pri==1 and $row['inivel_formulario']==1)
				{
?>
        <script>
					stm_bp("p1",[1,4,0,0,0,4,18,7,100,"",-2,"",-2,50,2,3,"#999999","#007436","",1,0,0,"#A9CFDB #93C0CE #155E8C"]);
        </script>
<?php
					$pri=0;
				}
				//elseif($row['orden_formulario']==1 and $row['idepende_formulario']<>1 and $row['idepende_formulario']<>0)		
				elseif($pri==1 and $row['idepende_formulario']<>1 and $row['idepende_formulario']<>0)
				{	
?>
        <script>
					stm_bpx("p<?php echo $numero[$row['idepende_formulario']]?>","p1",[1,2,0,0,3,4,7,0,100,"",-2,"",-2,50,2,3,"#999999","#007436","",0]);
        </script>
<?php						
					$pri=0;						
				}				
			}
			else
			{					 					  
				$band=0;
								
				$count[$row['idepende_formulario']]++;
			}
								
			/////////////////////////
			/////// CABECERAS ///////
			/////////////////////////
			if($row['bfinal_formulario']==1)
			{	
				
				if($row['inivel_formulario']==0 and $primero==1) //$row['orden_formulario']==1)
				{
?>
<script>
					stm_ai("p<?php echo $row['inivel_formulario']?>i<?php echo $count[$row['idepende_formulario']]?>",[0,"<?php echo $row['vnom_formulario']?>","","",-1,-1,0,"","_self","","","","<?php echo $path."arrow_r.gif";?>",0,0,0,"<?php echo $path."arrow_r.gif";?>","<?php echo $path."arrow_r.gif";?>",0,0,0,0,1,"",0,"#FF9900",0,"","",3,3,0,0,"#FFFFF7","#00FF00","#FFFFFF","#000000","8pt Tahoma","8pt Tahoma",0,0]);
					stm_bp("p1",[1,4,0,0,0,4,22,9,100,"",-2,"",-2,50,2,3,"#999999","#007436","",1,0,0,"#A9CFDB #93C0CE #155E8C"]);
</script>
<?php					
					$primero=0;
				}
				else
				{ 	if($row['inivel_formulario']==0)
					{
?><script>
						stm_aix("p<?php echo $numero[$row['idepende_formulario']]?>i<?php echo $count[$row['idepende_formulario']]?>","p0i0",[0,"<?php echo $row['vnom_formulario']?>","","",-1,-1,0,"","_self","","","","",0,0,0,"","",0,0,0,0,1,"",0,"#FF9900",0,"","",3,3,0,0,"#FFFFF7","#00FF00","#FFFFFF","#000000","8pt Tahoma","8pt Tahoma",0,0]);
</script>
<?php
					}
					else
					{
?><script>
						stm_aix("p<?php echo $numero[$row['idepende_formulario']]?>i<?php echo $count[$row['idepende_formulario']]?>","p0i0",[0,"<?php echo $row['vnom_formulario']?>","","",-1,-1,0,"<?php echo $file?>","_self","","","","",0,0,0,"","",7,7,0,0,1,"",1,"#FF9900",0,"","",3,3,0,0,"#FFFFF7","#00FF00","#FFFFFF","#000000","8pt Tahoma","8pt Tahoma",0,0]);
</script>
<?php
					}
				}					
			}
			else
			{	
					
				$niv=$row['inivel_formulario'];																				
				if($depende_ant<>$row['idepende_formulario'])$count_menu++;
?>
<script>
				stm_aix("p<?php echo $numero[$row['idepende_formulario']]?>i<?php echo $count[$row['idepende_formulario']]?>","p0i0",[0,"<?php echo $row['vnom_formulario']?>","","",-1,-1,0,"","<?php echo $row['vabrir_formulario']?>","","","","<?php echo $path."arrow_r.gif";?>",0,0,0,"<?php echo $path."arrow_r.gif";?>","<?php echo $path."arrow_r.gif";?>",0,0,0,0,1 ,"",0,"#FF9900",0,"","",3,3,0,0,"#FFFFF7","#00FF00","#FFFFFF","#000000","8pt Tahoma","8pt Tahoma",0,0]);

</script>
<?php														
			}
			
			if($band==1)	$menu++;
			
			//$Rs->pg_Move_Next();
			$var++;			
		}
?>
        <script>
		stm_ep();
		stm_em();
	</script>
<?php		
	}
	else
                header("Location: ../../../index.php");
		//echo 'Datos de menu no registrados';
?>
