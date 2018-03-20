<?php
	$aUsers = array(
		"Artimes, Juan C.",
		"Almada, Marisa",
		"Archimo, Jimena",
		"Ausman, Carlos",
		"Barreto, Miguel A.",
		"Baller, Esteban",
		"Bartez, Cesar",
		"Basil, Orlando",
		"Beail, Leonardo",
		"Blanco, Luis M.",
		"Bloise, Eugenia",
		"Blant, Nora",
		"Bollin, Carmen",
		"Burnot, Javier",
		"Carden, Presentada",
		"Carter, Mirhna",
		"Charatea, Aanabel",
		"Churchi, Miranda E.",
		"Conkler, Ermindo Juan",
		"Countri, Anabela B.",
		"Courner, Edgardo",
		"Couher, Antonio P.",
		"Craig, Carlos",
		"Cramo, Lautaro",
		"Cressmin, Teodoro",
		"Cressmin, Jesus",
		"Davis, Pdero",
		"Dominguez, Eusevio",
		"Escobar, Marcos",
		"Escobar, Marcelo",
		"Eisenman, Mamerto",
		"Fitzman, Timoteo",
		"Fleming, Francisco",
		"Fuchs, Estela",
		"Fulton, Rosalia A.",
		"Fernandez, Florencia",
		"Fernandez, Fiorela R.",
		"Genes, Raul",
		"Gremol, Marcos",
		"Greis, Juan",
		"Guest, Sara",
		"Hardei, Prisila",
		"Hildan, Ernesto",
		"Hoens, Eulalia",
		"Isasi, Marcelo L.",
		"Javiere, Domingo",
		"Jenco, Mirtha",
		"Jubeno, Berta",
		"Kava, Mariana",
		"Kern, Beatriz",
		"Klockman, Joaquin",
		"Lacon, Jimena",
		"Laurenzi, Leandro",
		"Leiva, Javier O.",
		"Leiva, Karlos M.",
		"Lester, Enzo",
		"Llora, Roxana",
		"Lombardi, Paola",
		"Llorin, Luisa",
		"Mayans, Ernesto J.",
		"Mocule, Bernardo",
		"McAlister, Cristian",
		"Meyers, Hector",
		"Monahan, Penelope",
		"Mull, Orlando P.",
		"Newing, Pedro",
		"Nickolson, Alfredo",
		"Paulin, Javier",
		"Panter, Andrea",
		"Pinneda, Walter",
		"Pratto, Ricardo",
		"Prietto, Estefania",
		"Reamo, Teresa",
		"Rumbaugh, Noelia",
		"Rial, Tania",
		"Sailor, Leonora",
		"Schofield, Danna V.",
		"Schuck, Juan",
		"Scannia, Claudia",
		"Smith, Estela",
		"Smothers, Macos",
		"Stainfor, Mauricio",
		"Stephenson, Paola",
		"Stemart, Hector",
		"Stough, Mariela",
		"Strickland, Benjamin",
		"Sullivan, Griselda",
		"Swink, Stefania",
		"Tavoularis, Teodoro",
		"Taylor, Karla",
		"Thigpen, Amir",
		"Treeby, Jimena",
		"Trevin, Jaime",
		"Waldron, Alberto",
		"Wheeler, Vanesa",
		"Whishaw, Dalberto",
		"Whitehead, Lorena",
		"Wilkins, Daniel",
		"Winre, karina",
		"Woodman, Alejandra",
		"Zanicontor, Jimena"
	);
	
	//Construimos el array
	$input    = strtolower( $_GET['input'] );
	$len      = strlen($input);
	$limit    = isset($_GET['limit']) ? (int) $_GET['limit'] : 0;
	$aResults = array();
	$count    = 0;
	if($len)
	{
		for ($i=0;$i<count($aUsers);$i++)
		{
			// had to use utf_decode, here
			// not necessary if the results are coming from mysql
			//
			if (strtolower(substr(utf8_decode($aUsers[$i]),0,$len)) == $input)
			{
				$count++;
				$aResults[] = array( "id"=>($i+1) ,"value"=>htmlspecialchars($aUsers[$i]), "info"=>'');
			}
			
			if ($limit && $count==$limit)
				break;
		}
	}
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Pragma: no-cache"); // HTTP/1.0
	sleep(2);
	header("Content-Type: text/xml");
	echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?><results>";
	for ($i=0;$i<count($aResults);$i++)
	{
		echo "<rs id=\"".$aResults[$i]['id']."\" info=\"".$aResults[$i]['info']."\">".$aResults[$i]['value']."</rs>";
	}
	echo "</results>";
?>