var tagScript = '(?:<script.*?>)((\n|\r|.)*?)(?:<\/script>)';
/**
* Eval script fragment
* @return String
*/
String.prototype.evalScript = function()
{
        return (this.match(new RegExp(tagScript, 'img')) || []).evalScript();
};
/**
* strip script fragment
* @return String
*/
String.prototype.stripScript = function()
{
        return this.replace(new RegExp(tagScript, 'img'), '');
};
/**
* extract script fragment
* @return String
*/
String.prototype.extractScript = function()
{
        var matchAll = new RegExp(tagScript, 'img');
        return (this.match(matchAll) || []);
};
/**
* Eval scripts
* @return String
*/
Array.prototype.evalScript = function(extracted)
{
				var s=this.map(function(sr){
				var sc=(sr.match(new RegExp(tagScript, 'im')) || ['', ''])[1];
				if(window.execScript){
				    window.execScript(tagScript);
				}
				else
				{
				 window.setTimeout(sc,0);
				}
				});
				return true;
};
/**
* Map array elements
* @param {Function} fun
* @return Function
*/
Array.prototype.map = function(fun)
{
        if(typeof fun!=="function"){return false;}
        var i = 0, l = this.length;
        for(i=0;i<l;i++)
        {
                fun(this[i]);
        }
        return true;
};  

function AJAX2(){
	var ajaxs = ["Msxml2.XMLHTTP","Msxml2.XMLHTTP.4.0","Msxml2.XMLH TTP.5.0","Msxml2.XMLHTTP.3.0","Microsoft.XMLHTTP"];
	var ajax = false;
	for(var i=0 ; !ajax && i<ajaxs.length ; i++){
		try{ 
			ajax = new ActiveXObject(ajaxs[i]); 
		}
		catch(e) { 
			ajax = false; 
		}
	}
	if(!ajax && typeof XMLHttpRequest!='undefined') {
		ajax = new XMLHttpRequest();
	}
	return ajax;
}

function getPagina(pagina,capa){
	
	document.getElementById(capa).innerHTML = "<center>C A R G A N D O</center>"; 
	
	var ajax = AJAX2(); 
	if(!ajax){
		document.getElementById(capa).innerHTML = "Error: El navegador no acepta ActiveX. No se pudo cargar la pagina.";
		return false;
	}

	ajax.open("POST",pagina,true);
	
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) { 
			var scs=ajax.responseText.extractScript();
      document.getElementById(capa).innerHTML=ajax.responseText.stripScript();
      scs.evalScript();  
		}
	}
	
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
}