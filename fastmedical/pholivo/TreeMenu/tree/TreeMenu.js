// Tree Menu class for IE and NS 6+
// Version 1.0
// copyright (c) 2002 by Carlos Falo Hervás for BiS iNTERACTiVE SL

// Class Definition

TreeMenu = {

	initialized : false ,						// Initialization flag
	levels			: 0 ,								// Current menu length
	closedimg		: new Image() ,			// Closed Node image
	closedimgs	: new Image() ,			// Closed Node image (sublevel)
	openimg			: new Image() ,			// Open Node image
	openimgs		: new Image() ,			// Open Node image (sublevel)
	blankimg		: new Image() ,			// Blank Node image (only FIRST level)
	options			: [] ,							// Array for the subelements
	width				: 200 ,							// Menu total width
	gfxwidth		: 15 ,							// Icon size (square)
	elemstyle		: "" ,							// Style name for the texts
	indent			: 0 ,								// Total indent levels (1 based - 1 => 1 level)
	target			: "_blank" ,				// Destination frame for menu links
	
	// SET_INDENT
	// REQUIRED - defines max menu indentation
	set_indent : function(val) {
	  TreeMenu.indent = val ;
	} ,

	// SET_TARGET
	// DEFAULTS - Set the target window for the links
	set_target : function(val) {
	  TreeMenu.target = val ;
	} ,

	// SET_WIDTH:
	// DEFAULTS - defines global width for the menu and the size of icons
	set_width : function(wd,wdg) {
		TreeMenu.width = wd ;
		TreeMenu.gfxwidth = wdg ;
	} ,
	
  // SET_STYLE:
	// REQUIRED - defines text styles... unique for now, 1st level gets BOLD	
	set_style : function(estilo) {
		TreeMenu.elemstyle = estilo ;
	} ,

	// SET_IMAGES	
	// REQUIRED - defines NODE graphics, lines are for now STATIC
	set_images : function(cimg,cimgs,oimg,oimgs,bimg) {
		TreeMenu.closedimg.src = cimg ;
		TreeMenu.closedimgs.src = cimgs ;
		TreeMenu.openimg.src = oimg ;
		TreeMenu.openimgs.src = oimgs ;		
		TreeMenu.blankimg.src = bimg ;
	} ,

	// ADD_OPTION
	// Adds menu options, VARARGS lvl, sublvl, subsublvl... , value, length
	add_option : function() {
	  a = TreeMenu.add_option.arguments ;
		args = a.length ;
		cobj = TreeMenu ;
		for (i=0;i<args-3;i++) {
			cobj = cobj.options[a[i]] ;
		  }
		if (cobj.levels == cobj.lg) {
			alert("Error: demasiadas opciones para el nivel " + cobj.valor) ;
		} else {
			cobj.options[cobj.levels] = {} ;
			cobj.options[cobj.levels].valor = a[args-3] ;
			cobj.options[cobj.levels].lg = a[args-2] ;
			cobj.options[cobj.levels].lnk = a[args-1] ;
			cobj.options[cobj.levels].options = [] ;
			cobj.options[cobj.levels].levels = 0 ;
			cobj.options[cobj.levels].closed = 1 ;
			cobj.levels++ ;
			}
		return (cobj.levels) ;
	},
	
	// PRINT_MENU
	// Show the menu on screen on the FIRST level only
	print_menu: function() {
	  document.write('<table width="' + TreeMenu.width + '" cellpadding="0" cellspacing="0" border="0">') ;
		size = TreeMenu.width - TreeMenu.indent*TreeMenu.gfxwidth ;
		document.write('<tr><td width="' + TreeMenu.gfxwidth + '"></td><td width="' + TreeMenu.gfxwidth + '"></td><td width="' + size + '"></td></tr>') ;
		for (i=0;i<TreeMenu.levels;i++) {
		  document.write('<tr><td align="left" width="' + TreeMenu.gfxwidth + '">') ;
			if (TreeMenu.options[i].lnk=="") lnk = "#" ;
			else lnk = TreeMenu.options[i].lnk + '" target="' + TreeMenu.target ;
		  if (TreeMenu.options[i].lg==0) {
				document.write('<img src="' + TreeMenu.blankimg.src + '" alt="" border="0">') ;			
			} else {
				document.write('<a href="' + lnk +'" onClick="javascript:menu_action(' + i + ',\'elem' + i + '\');"><img border="0" name="imgelem' + i + '" src="' + TreeMenu.closedimg.src + '" alt="" border="0"></a>') ;
			  }
			document.write('</td><td width="99%" colspan="' + TreeMenu.indent + '" align="left">') ;
			document.write('<img border="0" src="/images/menuicon/trans.gif" width="2" height="1">') ;			
			document.write('<a href="' + lnk + '" onClick="javascript:menu_action(' + i + ',\'elem' + i + '\');" class="' + TreeMenu.elemstyle + '"><b>' + TreeMenu.options[i].valor+"</b></a>") ;
			document.write('</td></tr>') ;
			if (TreeMenu.options[i].lg!=0) {
				// Place to unfold the menu
				size = TreeMenu.indent + 1 ;
				document.write('<tr><td colspan="' + size + '" id="elem' + i + '"></td></tr>') ;
			  }
		  }			
	  document.write('</table>') ;
	}
} ;

// Interface function to fold/unfold menus:

function menu_action() {
		
	a 		= menu_action.arguments ;
	args 	= a.length ;
	cobj 	= TreeMenu ;
	c 		= TreeMenu.indent ;		
	prefix = "sub" + a[0] ;
	lng	   = [] ;
	
	for (i=0;i<args-2;i++) {
		cobj = cobj.options[a[i]] ;
		if ((cobj.lg-1)==a[i+1]) lng[i] = 0 ;
		else lng[i] = 1 ;
		c-- ;
		prefix += "sub" + a[i+1] ;
	  }
	
	elem = a[args-1] ;
	idx = a[args-2] ;
	
	contenido = '<table width="' + TreeMenu.width + '" cellpadding="0" cellspacing="0" border="0">' ;
	if (is.ie) {
	  // Internet Explorer
		obj = document.all[elem] ;
		img = document.all["img"+elem] ;
	} else {
	  // Netscape Navigator
	  if (is.ns5) {
		  // Versions 6+
			obj = document.getElementById(elem) ;
			img = document.images["img"+elem] ;
			}
	  }
		
	if (obj) {
	  if (cobj.options[idx].closed) {
			cobj.options[idx].closed = 0 ;
		  if (cobj.options[idx].lg > 0) {
			  if (c==TreeMenu.indent) {
				  img.src = TreeMenu.openimg.src ;
				} else {
					img.src = TreeMenu.openimgs.src ;
				  }
				n = 0 ;
				for (i=0;i<cobj.options[idx].lg;i++) {
					contenido += '<tr><td width="' + TreeMenu.gfxwidth + '">' ;
					for (j=0;j<lng.length;j++) {
					  if (lng[j]==1) {
							contenido += '<img src="/images/menuicon/line_b.gif"></td><td width="' + TreeMenu.gfxwidth + '">' ;
						} else {
						  contenido += '<img src="/images/menuicon/trans.gif" width="' + TreeMenu.gfxwidth + '" height="1"></td><td width="' + TreeMenu.gfxwidth + '">' ;
							}
					  }
					if (i==cobj.options[idx].lg-1) {
						contenido += '<img src="/images/menuicon/line_l.gif" alt="">' ;
					} else {
						contenido += '<img src="/images/menuicon/line_t.gif" alt="">' ;
			  		}
					contenido += '</td>' ;
					// Now check for this node length
					if (cobj.options[idx].options[i].lnk=="") lnk = "#" ;
					else lnk = cobj.options[idx].options[i].lnk + '" target="' + TreeMenu.target ;
					l = cobj.options[idx].options[i].lg ;
					if (l==0) {
					  n = 0 ;
						contenido += '<td colspan="' + c + '" align="left">' ;
						contenido += '<img src="/images/menuicon/trans.gif" width="2" height="1">' ;
						if (lnk=="#") {
							contenido += '<span class="' + TreeMenu.elemstyle + '">' + cobj.options[idx].options[i].valor + '</span></td>' ;
						} else {
							contenido += '<a href="' + lnk + '" class="' + TreeMenu.elemstyle + '">' + cobj.options[idx].options[i].valor + '</a></td>' ;
							}
					} else {
					  n = 1 ;
						parms = "" ;
						for (j=0;j<args-1;j++) {
							parms += a[j] + "," ;
						  }
						parms += i ;
						contenido += '<td width="' + TreeMenu.gfxwidth + '"><a href="' + lnk + '" onClick="javascript:menu_action(' + parms + ',\'' + prefix + 'elem' + i +'\');"><img border="0" name="img' + prefix + 'elem' + i + '" src="' + TreeMenu.closedimgs.src + '" alt=""></a></td>' ;
						contenido += '<td width="99%" colspan="' + eval(c-1) + '" align="left">' ;
						contenido += '<img src="/images/menuicon/trans.gif" width="2" height="1">' ;
						contenido += '<a href="' + lnk + '" onClick="javascript:menu_action(' + parms + ',\'' + prefix + 'elem' + i +'\');" class="' + TreeMenu.elemstyle + '">' + cobj.options[idx].options[i].valor + '</a></td>' ;	
					  }
					contenido += '</tr>' ;
					if (n!=0) {
						contenido += '<tr><td id="' + prefix + "elem" + i + '" colspan="' + eval(TreeMenu.indent+1) + '">' ;
						// Must create here the indentation arrays...
						to = TreeMenu ;
						ln = [] ;
						for (m=0;m<args-1;m++) {
						  to = to.options[a[m]] ;
							if (m!=args-2) {
  						  if ((to.lg-1)==a[m+1]) ln[m] = 0 ;
 								else ln[m] = 1 ;
							} else {
								if (to.lg-1==i) ln[m] = 0 ;
								else ln[m] = 1 ;
							  }
	  					}
						for (k=0;k<ln.length;k++) {
			  			if (ln[k]==1) {
								contenido += '<img src="/images/menuicon/line_s.gif">' ;
							} else {
							  contenido += '<img src="/images/menuicon/trans.gif" width="' + TreeMenu.gfxwidth + '" height="1">' ;
								}
							}
						contenido += '</td></td></tr>' ;
				  	}
					}
				contenido += '</table>' ;
				obj.innerHTML = contenido ;
			  }	  
	  } else {
			cascade_close(cobj.options[idx]) ;
			// Create dots where needed
			contenido = "" ;
			for (j=0;j<lng.length;j++) {
			  if (lng[j]==1) {
					contenido += '<img src="/images/menuicon/line_s.gif">' ;
				} else {
				  contenido += '<img src="/images/menuicon/trans.gif" width="' + TreeMenu.gfxwidth + '" height="1">' ;
					}
				}
			obj.innerHTML = contenido ;
			if (c!=TreeMenu.indent) {
				img.src = TreeMenu.closedimgs.src ;
			} else {
				img.src = TreeMenu.closedimg.src ;
			  }
		  }
		}
}

// FIXED IE 6.X BUG WITH RECURSIVITY
function cascade_close(start) {
  var z ;
	for (z=0;z<start.lg;z++) {
		if (start.options[z].lg!=0) cascade_close(start.options[z]) ;
	  }
	start.closed = 1 ;	
	return ;
  }