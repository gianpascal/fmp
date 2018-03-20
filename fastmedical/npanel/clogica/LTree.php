<?php
require_once("../../cdatos/DTree.php");
class LTree{
	private $oDTree;
		
	public function __construct(){
		$this->oDTree = new DTree();
		$this->oDTreeInterno = new DTree();
	}
		
	public function getOficina(){		
		$this->oDTree->getArrayOficina();				
		if($this->oDTree->pg_Total_Rows()>0){	
			$respuesta = '';
			$respuesta = '&lt;item text="HOSPITAL MUNICIPAL DE LOS OLIVOS" id="hdmlo" im0="tombs.gif" im1="tombs_open.gif" im2="tombs.gif" &gt; ';
			$var0=0;	
			while($var0<$this->oDTree->pg_Total_Rows()){  
				$row0=$this->oDTree->pg_Get_Row();	
				$respuesta .= '&lt;item text="'.$row0["nom_oficina"].'" id="'.$row0["cod_oficina"].'" im0="folderClosed.gif" im1="folderOpen.gif" im2="folderClosed.gif"';
				$i++;			
				$this->oDTreeInterno->getArrayOficinaInterno(trim($row0['cod_oficina']));						
				if($this->oDTreeInterno->pg_Total_Rows()>0){	
					$var1=0;	
					$respuesta .= "&gt; ";
					while($var1<$this->oDTreeInterno->pg_Total_Rows()){  
						$row1=$this->oDTreeInterno->pg_Get_Row();					
						$respuesta .= '&lt;item   text="'.$row1["nom_oficina"].'" id="'.$row1["cod_oficina"].'" im0="books_close.gif" im1="books_open.gif" im2="books_close.gif" /&gt; ';						
						$i++;
																	
						$this->oDTreeInterno->pg_Move_Next();
						$var1++;
					}						
				}
				else
					$respuesta .= "/&gt; ";			
				
				$this->oDTree->pg_Move_Next();
				$var0++;			
				if($this->oDTreeInterno->pg_Total_Rows()>0)
					$respuesta .= "&lt;/item&gt; ";	
			}				
			$respuesta .= "&lt;/item&gt;";
		}
		return $respuesta;
	}		
}
?>