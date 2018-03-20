<?PHP
class TreeMenu {

  var $XMLparser ;				// Core parser for the menu file
	var $XMLfile ;					// Name for the file with the menu to render
	var $Indent = 1 ;				// Max indents
	var $Width = 200 ;			// Width for the full menu
	var $NodeWidth = 15 ;		// Indentation size (normally equal to node gfx size)
	var $Style = "menutxt" ;// text style (defined in the page) for menu texts
	var $Target = "_self" ;	// frame/window name for link targets
	
	function TreeMenu($file="menu.xml") {
		$this->XMLfile = $file ;
	  }
		
	function SetFile($file) {
		$this->XMLfile = $file ;
		}
		
	function PrintMenu() {
		echo '<script language="JavaScript">TreeMenu.print_menu() ;</script>' ;
	  }
	function Generate() {
	  if ($fp=@fopen($this->XMLfile,"r")) {
			$this->XMLparser = xml_parser_create() ;
			xml_set_element_handler($this->XMLparser, "startElement", "endElement"); 
			xml_set_character_data_handler($this->XMLparser, "characterData"); 
			while ($data = fread($fp, 4096)) { 
  			if (!xml_parse($this->XMLparser, $data, feof($fp))) { 
		  	  die(sprintf("XML error: %s at line %d", 
    			xml_error_string(xml_get_error_code($this->XMLparser)), 
			    xml_get_current_line_number($this->XMLparser))); 
  	  		}
  			}
			xml_parser_free($this->XMLparser) ;
		} else {
			echo '<br><b>ERROR</b>: Could not open XML file ' . $this->XMLfile . '<br>' ;
	  	}
		}
	}
	
	// Auxiliary vars & functions for the XML parser...
	// Variables
	$endl = "\r\n" ;
	$menu = new TreeMenu() ;
	$cindent = 0 ;
	$oindent = 0 ;
	$count = 0 ;
	$stack = Array(0) ;
	
	
	// Parser open tags
	function startElement($parser, $name, $attrs) {
		global $endl ; // endline
		global $menu ; // TreeMenu object
		global $cindent; // Current indentation
		global $oindent ; // Previous indentation
		global $count ;	// current option list count
		global $stack ; // stack based pop/push ops
		
		$attnames = array_keys($attrs) ;
	  switch ($name) {
			case "MENU":
				// This block must generate javascript include and menu inits...
				echo '<SCRIPT LANGUAGE="javascript" SRC="/js/browser.js"></script>' . $endl ;
				echo '<SCRIPT LANGUAGE="javascript" SRC="/js/TreeMenu.js"></script>' . $endl ;
				echo '<SCRIPT LANGUAGE="javascript">' . $endl ;
				
				// Configure from the params in the file...
		    if (in_array("INDENT",$attnames)) {
					$menu->Indent = $attrs["INDENT"] ;
				  }
		    if (in_array("NODEWIDTH",$attnames)) {
					$menu->NodeWidth = $attrs["NODEWIDTH"] ;
				  }
				if (in_array("STYLE",$attnames)) {
					$menu->Style = $attrs["STYLE"] ;
				  }
				if (in_array("TARGET",$attnames)) {
					$menu->Target = $attrs["TARGET"] ;
				  }
		    if (in_array("WIDTH",$attnames)) {
					$menu->Width = $attrs["WIDTH"] ;
				  }
				// Echo configuration... after all params have been checked
				if ($menu->Style!="") echo 'TreeMenu.set_style("' . $menu->Style .'") ;' . $endl ;
				echo 'TreeMenu.set_target("' . $menu->Target . '") ;' . $endl ;
				echo 'TreeMenu.set_indent(' . $menu->Indent . ') ;' . $endl ;
				echo 'TreeMenu.set_width(' . $menu->Width . ',' . $menu->NodeWidth . ') ;' . $endl ;
				echo 'TreeMenu.set_images("/images/menuicon/c_node.gif","/images/menuicon/c_node_s.gif","/images/menuicon/o_node.gif","/images/menuicon/o_node_s.gif","/images/menuicon/b_node.gif") ;' . $endl ;
			break ;
			CASE "OPTION":
				// Must echo the option insertion into the JavaScript object
				if ($oindent!=$cindent) {
					// Push counter
					array_push($stack,$count) ;
					// Reset counter
					$count = 0 ;
					// Equalize indexes (always a MAX of 1 level difference)
					$oindent++ ;
				  }
				$cindent++ ;
				echo 'TreeMenu.add_option(' ;
				for ($i=1;$i<count($stack);$i++) echo  $stack[$i] . ',' ; // Levels...
				if (in_array("VALUE",$attnames)) echo '"'.$attrs["VALUE"].'",' ; // Text to show
				if (in_array("LENGTH",$attnames)) echo $attrs["LENGTH"] ; // Length for the option
				else echo '0' ;
				echo ',' ;
				if (in_array("URL",$attnames)) echo '"'.$attrs["URL"].'"' ; // Destination link
				else echo '""' ;
				echo ') ;' . $endl ;
			break ;
		  }
	  }
	
	// Parse close tags
	function endElement($parser, $name) {
		global $endl ; // endline
		global $menu ; // TreeMenu object
		global $cindent; // Current indentation
		global $oindent ; // Previous indentation
		global $count ;	// current option list count
		global $stack ; // stack based pop/push ops

	  switch($name) {
			case "MENU":	// Close the <SCRIPT></SCRIPT>
				echo '</SCRIPT>' . $endl ;
			break ;
			case "OPTION":
				$cindent-- ;  // Reduce indent
				if ($oindent!=$cindent) {
				   $oindent-- ; // Adjust old indent
					 $count = array_pop($stack) ;
					 }
				$count++ ;		// Increase option count
			break ;
			}
	  }
		
	// Parser character Data... just echo it... but it should not be used ever
	function characterData($parser, $data) {
    echo $data ;
		}

	
?>
