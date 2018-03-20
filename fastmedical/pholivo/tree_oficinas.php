<?php
header("Cache-Control: no-cache, must-revalidate "); 
printXMLHeader();
printAction("",$cod_user,$ano_eje);
printXMLFooter();

function printXMLHeader($tag="data"){
            if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) 
			{ header("Content-type: application/xhtml+xml"); }
			 else { header("Content-type: text/xml"); } echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n"); 
            echo  "<tree id='0' radio='1'>\n";
}
function printXMLFooter($tag="data"){
            echo  "</tree>\n";
        }
		
function printAction($action,$cod_user,$ano_eje){

//require_once("../Connections/coneccion.php");
//require_once("../funciones/funciones_pg.php");

	$Rs=new TSPResult($Coneccion,"");
	$Rs->pg_Campos_Select(" DISTINCT
      t1.centro_costo,
      t1.nom_oficina,
      t1.der_oficina,
      t1.cod_oficina,
      t1.niv_oficina ");
	$Rs->pg_Campos_From("  nucleo.oficina as t1 left join
        nucleo.trabajador_oficina as t2
        on 
        (t1.cod_oficina=t2.cod_oficina 
        AND t2.cod_tra IN (SELECT * FROM nucleo.sp_busca_idpersona_trabajador('$cod_user','2'))  ) ");
	$Rs->pg_Campos_Condicion(" t1.hab_oficina=true
        AND t2.ano_eje='$ano_eje'
        ORDER BY t1.niv_oficina ASC,t1.niv_oficina desc");		
	$Rs->pg_Poner_Esquema("presupuesto");
	$Rs->pg_Paginacion("ALL");
	$Rs->executeCSQL();
	//echo $Rs->Escribir_Consulta();
	
/*	$Rs=new TSPResult($Coneccion,"sp_grid_oficinas_rep");
	$Rs->pg_Campos_Select(" * ");
	$Rs->pg_Parametros_SP(" ano_eje ",'$ano_eje');
	$Rs->pg_Parametros_SP(" cod_user ",'$cod_user');
	$Rs->pg_Poner_Esquema("presupuesto");
	$Rs->pg_Paginacion("ALL");
	$Rs->executeSP();*/
	//echo $Rs->Escribir_Consulta();
	$Total=$Rs->pg_Num_Rows();
	$Rs_temp=$Rs;
	$N=0;
	
	$p=0;
	$open=0;
	$row=$Rs->pg_Get_Row();
	$cod_oficina_temp=$row["der_oficina"];
	$nivel=0;
	$nivel_c=0;
	$oficina_ant="";
	$paso["000"]="yes";
	//$band="true";
	//echo "TOTAL ".$Total;
	while($N<=$Total )
	{

		//echo "<br> $N --- IF 0 COD OFI TEM = ".$cod_oficina_temp."    DER OFICINA ".$row["der_oficina"]." <br> ";
		$row=$Rs->pg_Get_Row();
		if($cod_oficina_temp==$row["der_oficina"])
		{
			$selected="";
			if($open==0)
			{
				$selected="open='1'  call='1' select='1' ";
				$open=1;
			}
			$cod_oficina_temp=$row["cod_oficina"];
			//echo "<br>ASIG  VAL 0 COD OFI TEM 0 = ".$cod_oficina_temp."   DER OFICINA".$row["der_oficina"]."    NOM ".$row["nom_oficina"]." <br>";
			echo "<item   text='".$row["nom_oficina"]."' $selected id='".$row["cod_oficina"]."' im0='tombs.gif' im1='tombs_open.gif' im2='tombs.gif' >\n";
			$paso[$row["cod_oficina"]]="yes";
			//echo " PASO 1 [".$row["cod_oficina"]."]".$paso[$row["cod_oficina"]]." <br><br>";
			$oficina_ant=$row["der_oficina"];
			$nivel_r=intval($row["niv_oficina"]);
			$Rs->pg_Move_Next();
			//echo "<br>NEXT VAL  COD OFI TEM 000 = ".$cod_oficina_temp."   DER OFICINA 000 = ".$row["der_oficina"]." <br>";
			//echo "<br> $open - $niv_oficina ".$row["cod_oficina"]."<br>";
			
		}
		
		;
		$valor_temp="";
		$PE=$Rs->pg_Cursor_Pos();
		$M=$PE;
		while($M<$Total)
		{
			$row_1=$Rs->pg_Get_Row();
			//echo "<br> $M --- IF 1 COD OFI TEM = ".$cod_oficina_temp."    DER OFICINA ".$row_1["der_oficina"]." <br> ";
			if($cod_oficina_temp==$row_1["der_oficina"])
			{
				$cod_oficina_temp=$row_1["der_oficina"];
				//echo "<br> ASIG VAL 1 COD OFI TEM 1 = ".$cod_oficina_temp." DER OFICINA ".$row_1["der_oficina"]." <br>";
				$valor_temp=$cod_oficina_temp;
				//echo "PASE POR AQUI";
				$M=$Total+2;
				$row=$Rs->pg_Get_Row();
				$nivel=$nivel_r;
				
				//$niv_oficina=intval($row["niv_oficina"]);
				$pos_cur_2[$nivel][$nivel_c]=$PE;
				//echo "<br> AQUI ESTA LOQ UE PODEMOS NIVE $nivel NIVE_C $nivel_c POSITON ".$pos_cur_2[$nivel][$nivel_c]."<br>";
				$nivel_c++;
				
			}
			else
			{
				$Rs->pg_Move_Next();			
				$M++;
			}
		}
		if($valor_temp=="")
		{
			echo "</item>\n";
			//echo "<br> $open - $niv_oficina  ".$row["cod_oficina"]."  DER ".$row["der_oficina"]."<br>";
			
			$Rs->pg_Set_Cursor($PE,$Total);
			$row=$Rs->pg_Get_Row();
			$cod_oficina_temp=$row["der_oficina"];
			$N=$PE;
			//$band="false";
			//echo " N $N <br><br> OA $oficina_ant OT $cod_oficina_temp";
			if($oficina_ant!=$cod_oficina_temp and $N<$Total)
			{
				echo "</item>\n";
				$nivel_c--;
				$N=$pos_cur_2[$nivel][$nivel_c];
				$Rs->pg_Set_Cursor($pos_cur_2[$nivel][$nivel_c],$Total);
				$nivel_c--;
				$row=$Rs->pg_Get_Row();
				$cod_oficina_temp=$row["der_oficina"];
				//echo "PASE PRO AQUI ";
				//$band="true";
			
			}
			if($N==$Total)
			{
				$Rs->pg_Set_Cursor($pos_cur_2[$nivel][$nivel_c],$Total);
				$row=$Rs->pg_Get_Row();
				//echo " PASO AQUIII [".$row["cod_oficina"]."] CODIGOOO ".$paso[$row["cod_oficina"]]." <br><br>";
				$nivel=intval($row["niv_oficina"]);
				$band=false;
				while($band==false)
				{
					echo "</item>\n";
					//echo "PASE POR AQUI NIVE $nivel <br>";
					$P=$pos_cur_2[$nivel][$nivel_c];
					$Rs->pg_Set_Cursor($pos_cur_2[$nivel][$nivel_c],$Total);
					$row=$Rs->pg_Get_Row();
					$cod_oficina_temp=$row["der_oficina"];
					$ofi=$row["cod_oficina"];
					if($paso[$row["cod_oficina"]]!="yes" and $ofi!="")
					{
						//echo "PASE 2";
						$N=$P;
						$band=true;
					}
					else
					{
						if($nivel==0)
						{
							$band=true;
							$N=$Total+$Total;
						}
					}
					$nivel--;
				}
			}
			
		}
		
	}
	

}
?>
