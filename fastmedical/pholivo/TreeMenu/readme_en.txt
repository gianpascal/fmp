===== BASIC DOCUMENTATION FOR TREEMENU CLASS =====

0.- INTRODUCTION

	This class is designed as an easy to manage DHTML TreeMenu object.  It is 
	crossbrowser on JavaScript Object Model including innerHTML (IE 5.5+ & NS 6+)
	and feeds on XML data based in menu.dtd (also included in the package).
	
	This class is distributed on GNU GPL based license (see LICENSE)
	
1.- INTERFACE

  The public interface for the class is formed by:

  TreeMenu($file="menu.xml")

    CONSTRUCTOR: Initialize the object

	$file -> name for the xml file holding the menu definition
	
	NOTES: The object is automatically created as $menu due to needing the object 
	prior to XML parsing.  By default it points to menu.xml in the same directori
	but this file settings can be changed with SetFile method.
	
  SetFile($file)	

    SETTING THE SOURCE FILE: Changes the file settings to $file

	$file -> new source file for the object

  Generate()

    JAVASCRIPT INITIALIZATION: Include JS libraries and generate JavaScript src
	
	NOTES; This method must be called within the HEAD section of the page and it 
	will automatically inlcude browser.js and TreeMenu.js libraries.  It will then 
	generate all Javascript needed to initialize data in the DHTML JavaScript TreeMenu 
	object.

  PrintMenu()

	SHOWS THE MENU: It will show the menu in that point
	
2.- XML MENU FILES

  A menu file is a small xml file conforming with MENU.DTD.  Each file must 
	include at least a MENU element and an OPTION element.
	
	MENU ELEMENT: Root element
	
		<menu width="<W>" nodewidth="NW" style="S" target="T" indent="I"></menu>
		
		W		: Total width for the table containing the TreeMenu
		NW	: Width for the node cells (normally that of the node graphics)
		S		: Style to use on the menu texts
		T		: Window/Frame name target to the menu links
		I		: MAX Indentation (number of nested menus)
		
	OPTION ELEMENT: Defines menu entries
	
		<option length="<L>" url="<U>" value="<V>"></option>
		
		L		:	Number of options in this entry (this node expands to L options)
		U		: Destination Link for the option (can be an expandable node or not)
		V		: Entry text to show in the menu
		
		NOTES: Options can be nested, so multiple level menus can be achived (see 
		MENU ELEMENT indent details)

3.- Considerations

	This class is an hybrid on JavaScript and PHP OOP and can be quite tricky to 
	understand (specially the JavaScript TreeMenu Object), so take it easy :)
	
	A base $menu object is created with the inclusion of the class file as it is 
	required by the XML Parser auxiliary functions.
	
	The JavaScript object will warn on malformed menu data if more options than 
	those specified with the length argument are set to a given option.
	
	This class looks for the js files in DOCUMENT_ROOT/js directory and looks for 
	images in DOCUMENT_ROOT/images/menuicon directory (a set of base node/line 
	graphics ships along the class).

4.- Future releases and WIP

  Some work will be done so the PHP object can check and validate MENU data (i.e. missing options), but the class is fully usable as is.

5.- Contact information

  Carlos Falo Hervás
  slainte@jet.es

  C/Manila 54-56 Esc. A Ent. 4ª
  08034 Barcelona Spain

  Phone: +34 9 3 2063652
  Fax:	 +34 9 3 2063689
