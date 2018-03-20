
<?php		
	////////////////////	
	//PARAMETROS DE MENU
	////////////////////					
				
	$Rs=new TSPResult($Coneccion, "menu");	
	$Rs->pg_Parametros_SP("$1",$id_sistema);
	$Rs->pg_Parametros_SP("$2",0);
	$Rs->pg_Parametros_SP("$3",$sess["cod_user"]);	
	$Rs->pg_Campos_Select("*");
	$Rs->pg_Poner_Esquema(" permisos ");
	$Rs->pg_Paginacion('ALL');
	$Rs->executeSP();
	//echo $Rs->Escribir_Consulta();
	$num=$Rs->pg_Total_Rows();
	
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
			
			//$file="javascript:myajax.Link('".$row['file_formulario']."','contenido_inicio')";
			$file=$row['file_formulario'];
											
			if($row['depende_formulario']<>$dep_ant)	
			{					
				if($row['nivel_formulario']<$nivel_anterior)
				{
					$x=$nivel_anterior-$row['nivel_formulario'];
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
				$nivel_anterior=$row['nivel_formulario'];				
				if(trim($numero[$row['depende_formulario']])=='')	$numero[$row['depende_formulario']]=$menu; 
				$dep_ant=$row['depende_formulario']; 
				$band=1;
								
				if(trim($count[$row['depende_formulario']])=='')	$count[$row['depende_formulario']]=0;
				else												$count[$row['depende_formulario']]++;
				
				//if($row['orden_formulario']==1 and $row['nivel_formulario']==1)
				if($pri==1 and $row['nivel_formulario']==1)
				{
?>
					stm_bp("p1",[1,4,0,0,0,4,18,7,100,"",-2,"",-2,50,2,3,"#999999","#007436","",1,0,0,"#A9CFDB #93C0CE #155E8C"]);					
<?php
					$pri=0;
				}
				//elseif($row['orden_formulario']==1 and $row['depende_formulario']<>1 and $row['depende_formulario']<>0)		
				elseif($pri==1 and $row['depende_formulario']<>1 and $row['depende_formulario']<>0)		
				{	
?>														
					stm_bpx("p<?php echo $numero[$row['depende_formulario']]?>","p1",[1,2,0,0,3,4,7,0,100,"",-2,"",-2,50,2,3,"#999999","#007436","",0]);										
<?php												
					$pri=0;
				}				
			}
			else
			{					 					  
				$band=0;
								
				$count[$row['depende_formulario']]++;
			}
								
			/////////////////////////
			/////// CABECERAS ///////
			/////////////////////////
			if($row['final_formulario']=='f')
			{	
				
				if($row['nivel_formulario']==0 and $primero==1) //$row['orden_formulario']==1)
				{
?>
					stm_ai("p<?php echo $row['nivel_formulario']?>i<?php echo $count[$row['depende_formulario']]?>",[0,"<?php echo $row['nom_formulario']?>","","",-1,-1,0,"","_self","","","","",0,0,0,"","",0,0,0,0,1,"",0,"#FF9900",0,"","",3,3,0,0,"#FFFFF7","#00FF00","#FFFFFF","#000000","8pt Tahoma","8pt Tahoma",0,0]);																									
					
					stm_bp("p1",[1,4,0,0,0,4,22,9,100,"",-2,"",-2,50,2,3,"#999999","#007436","",1,0,0,"#A9CFDB #93C0CE #155E8C"]);																

<?php					
					$primero=0;
				}
				else
				{ 	
					if($row['nivel_formulario']==0)
					{							
?>																				
						stm_aix("p<?php echo $numero[$row['depende_formulario']]?>i<?php echo $count[$row['depende_formulario']]?>","p0i0",[0,"<?php echo $row['nom_formulario']?>","","",-1,-1,0,"","_self","","","","",0,0,0,"","",0,0,0,0,1,"",0,"#FF9900",0,"","",3,3,0,0,"#FFFFF7","#00FF00","#FFFFFF","#000000","8pt Tahoma","8pt Tahoma",0,0]);																												
<?php						
					}
					else
					{
?>
						stm_aix("p<?php echo $numero[$row['depende_formulario']]?>i<?php echo $count[$row['depende_formulario']]?>","p0i0",[0,"<?php echo $row['nom_formulario']?>","","",-1,-1,0,"","_self","","","","",0,0,0,"<?php echo $path?>arrow_r.gif","<?php echo $path?>arrow_r.gif",7,7,0,0,1,"",1,"#FF9900",0,"","",3,3,0,0,"#FFFFF7","#00FF00","#FFFFFF","#000000","8pt Tahoma","8pt Tahoma",0,0]);
<?php
					}		
				}					
			}
			else
			{	
					
				$niv=$row['nivel_formulario'];																				
				if($depende_ant<>$row['depende_formulario'])	$count_menu++;
				
?>
				stm_aix("p<?php echo $numero[$row['depende_formulario']]?>i<?php echo $count[$row['depende_formulario']]?>","p0i0",[0,"<?php echo $row['nom_formulario']?>","","",-1,-1,0,"<?php echo $file?>","<?php echo $row['abrir_formulario']?>","","","","",0,0,0,"","",0,0,0,0,1 ,"",0,"#FF9900",0,"","",3,3,0,0,"#FFFFF7","#00FF00","#FFFFFF","#000000","8pt Tahoma","8pt Tahoma",0,0]); 								
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
		echo 'Datos de menu no registrados';
?>
