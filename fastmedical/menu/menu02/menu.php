
<?php		
	require_once('../../ccontrol/control/ActionLogin.php');
	$oActionLogin = new ActionLogin();
	$Rs=$oActionLogin->getCargaMenu();	
	
	if($num>0)
	{					
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
  		stm_bp("p0",[0,4,0,0,3,4,22,9,100,"",-2,"",-2,50,2,3,"#999999","transparent","<?php echo $path?>bg_menu.gif",1,0,0,"#A9CFDB #93C0CE #155E8C"]);		
												
<?php	
		$primero=1;		
		$var=0;	
		while($var<$num)
		{   
			$row=$Rs->pg_Get_Row();								
			$oActionLogin2 = new ActionLogin();
			$Rs2=$oActionLogin->getCargaMenuConsulta($row['iid_formulario']);							
			if($Rs2->pg_Total_Rows()>0)
			$file="javascript:myajax.Link('funciones/ListadoGeneral.php?cod_form=".trim($row['iid_formulario'])."', 'Contenido')";								
			else
			$file=$row['vfile_formulario'];				
											
			if($row['idepende_formulario']<>$dep_ant)	
			{					
				if($row['inivel_formulario']<$nivel_anterior)
				{
					$x=$nivel_anterior-$row['inivel_formulario'];
					while($x>0)
					{
?>
				stm_ep();				
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
					stm_bp("p1",[1,4,0,0,0,4,18,7,100,"",-2,"",-2,50,2,3,"#999999","#007436","",1,0,0,"#A9CFDB #93C0CE #155E8C"]);					
<?php
					$pri=0;
				}
				//elseif($row['orden_formulario']==1 and $row['idepende_formulario']<>1 and $row['idepende_formulario']<>0)		
				elseif($pri==1 and $row['idepende_formulario']<>1 and $row['idepende_formulario']<>0)		
				{	
?>														
					stm_bpx("p<?php echo $numero[$row['idepende_formulario']]?>","p1",[1,2,0,0,3,4,7,0,100,"",-2,"",-2,50,2,3,"#999999","#007436","",0]);										
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
			if($row['bfinal_formulario']=='f')
			{	
				
				if($row['inivel_formulario']==0 and $primero==1) //$row['orden_formulario']==1)
				{
?>
					stm_ai("p<?php echo $row['inivel_formulario']?>i<?php echo $count[$row['idepende_formulario']]?>",[0,"<?php echo $row['vnom_formulario']?>","","",-1,-1,0,"","_self","","","","",0,0,0,"","",0,0,0,0,1,"",0,"#FF9900",0,"","",3,3,0,0,"#FFFFF7","#00FF00","#FFFFFF","#000000","8pt Tahoma","8pt Tahoma",0,0]);																									
					
					stm_bp("p1",[1,4,0,0,0,4,22,9,100,"",-2,"",-2,50,2,3,"#999999","#007436","",1,0,0,"#A9CFDB #93C0CE #155E8C"]);																

<?php					
					$primero=0;
				}
				else
				{ 	
					if($row['inivel_formulario']==0)
					{							
?>																				
						stm_aix("p<?php echo $numero[$row['idepende_formulario']]?>i<?php echo $count[$row['idepende_formulario']]?>","p0i0",[0,"<?php echo $row['vnom_formulario']?>","","",-1,-1,0,"","_self","","","","",0,0,0,"","",0,0,0,0,1,"",0,"#FF9900",0,"","",3,3,0,0,"#FFFFF7","#00FF00","#FFFFFF","#000000","8pt Tahoma","8pt Tahoma",0,0]);																												
<?php						
					}
					else
					{
?>
						stm_aix("p<?php echo $numero[$row['idepende_formulario']]?>i<?php echo $count[$row['idepende_formulario']]?>","p0i0",[0,"<?php echo $row['vnom_formulario']?>","","",-1,-1,0,"","_self","","","","",0,0,0,"<?php echo $path?>arrow_r.gif","<?php echo $path?>arrow_r.gif",7,7,0,0,1,"",1,"#FF9900",0,"","",3,3,0,0,"#FFFFF7","#00FF00","#FFFFFF","#000000","8pt Tahoma","8pt Tahoma",0,0]);
<?php
					}		
				}					
			}
			else
			{	
					
				$niv=$row['inivel_formulario'];																				
				if($depende_ant<>$row['idepende_formulario'])	$count_menu++;
				
?>
				stm_aix("p<?php echo $numero[$row['idepende_formulario']]?>i<?php echo $count[$row['idepende_formulario']]?>","p0i0",[0,"<?php echo $row['vnom_formulario']?>","","",-1,-1,0,"<?php echo $file?>","<?php echo $row['vabrir_formulario']?>","","","","",0,0,0,"","",0,0,0,0,1 ,"",0,"#FF9900",0,"","",3,3,0,0,"#FFFFF7","#00FF00","#FFFFFF","#000000","8pt Tahoma","8pt Tahoma",0,0]); 								
<?php														
			}
			
			if($band==1)	$menu++;
			
			$Rs->pg_Move_Next();
			$var++;			
		} //FIN WHILE
?>
		stm_ep();
		stm_em();
	</script>
<?php		
	} //FIN DE IF
	else
                header("Location: ../../../index.php");
		//echo 'Datos de menu no registrados';
?>
