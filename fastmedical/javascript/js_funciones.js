var Base64 = {

    // private property
    _keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

    // public method for encoding
    encode : function (input) {
        var output = "";
        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
        var i = 0;

        input = Base64._utf8_encode(input);

        while (i < input.length) {

            chr1 = input.charCodeAt(i++);
            chr2 = input.charCodeAt(i++);
            chr3 = input.charCodeAt(i++);

            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;

            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            }else if (isNaN(chr3)) {
                enc4 = 64;
            }

            output = output +
            this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
            this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

        }

        return output;
    },

    // public method for decoding
    decode : function (input) {
        var output = "";
        var chr1, chr2, chr3;
        var enc1, enc2, enc3, enc4;
        var i = 0;

        input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

        while (i < input.length) {

            enc1 = this._keyStr.indexOf(input.charAt(i++));
            enc2 = this._keyStr.indexOf(input.charAt(i++));
            enc3 = this._keyStr.indexOf(input.charAt(i++));
            enc4 = this._keyStr.indexOf(input.charAt(i++));

            chr1 = (enc1 << 2) | (enc2 >> 4);
            chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
            chr3 = ((enc3 & 3) << 6) | enc4;

            output = output + String.fromCharCode(chr1);

            if (enc3 != 64) {
                output = output + String.fromCharCode(chr2);
            }
            if (enc4 != 64) {
                output = output + String.fromCharCode(chr3);
            }

        }

        output = Base64._utf8_decode(output);

        return output;

    },

    // private method for UTF-8 encoding
    _utf8_encode : function (string) {
        string = string.replace(/\r\n/g,"\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {

            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return utftext;
    },

    // private method for UTF-8 decoding
    _utf8_decode : function (utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;

        while ( i < utftext.length ) {

            c = utftext.charCodeAt(i);

            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            }
            else if((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i+1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            }
            else {
                c2 = utftext.charCodeAt(i+1);
                c3 = utftext.charCodeAt(i+2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }

        }

        return string;
    }

}

function lee_tecla(evt,tecla)
{
    var nav1 = window.Event ? true : false;
    var key = nav1 ? evt.which : evt.keyCode;
			
    if(key==tecla)	return 1;
    else		return 0;			
}
function UltimoDiaDeMes(mes,anio)
{
    switch(parseInt(mes)){
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
            numDias=31;
            break;
        case 4: case 6: case 9: case 11:
            numDias=30;
            break;
        case 2:
            if (comprobarSiBisisesto(anio)){
                numDias=29
            }else{
                numDias=28
            };
            break;
        default:
            alert("Fecha introducida errnea");
            return false;
    }
    return numDias;
}





function Siguiente_Id(valor,nro_ceros,add)
{
    var temp=""+valor;
    //var ancho1=temp.length;
    if(add=='undefined' || add==undefined || add==0)
        add=1;
    var numero=parseFloat(valor)+parseFloat(add);
    numero=""+numero;
    var ancho2=numero.length;
    for (x=0;x<(nro_ceros-ancho2);x++)
        numero='0'+''+numero;
    return numero;
}

function Completarceros(valor,nrodigitos)
{
    var numero=parseFloat(valor);
    numero=""+numero;
    var ancho2=numero.length;
    for (x=0;x<(nrodigitos-ancho2);x++)
        numero='0'+''+numero;
    return numero;
}

function ColocarFocoObjeto(Objeto,TipObjeto)
{
    switch(TipObjeto)
    {
        case 'TEXT':
            break;
        case 'CHECKBOX':
            break;
        case 'SELECT':
            if(document.getElementById(Objeto)!=null)
            {
                document.getElementById(Objeto).focus();
            }
            else if (document.getElementsByName(Objeto)!=null)
            {
                document.getElementsByName(Objeto).focus();
            }
            break;
        default:
            if(document.getElementById(Objeto)!=null)
            {
                document.getElementById(Objeto).focus();
                document.getElementById(Objeto).select();			
            }
            else if (document.getElementsByName(Objeto)!=null)
            {
                document.getElementsByName(Objeto).focus();
                document.getElementsByName(Objeto).select();			
            }
            break;	
    }
}
function ExisteObjeto(Objeto,TipObjeto)
{
    Valor=false;
    switch(TipObjeto)
    {
        case 'TEXT':
            break;
        case 'CHECKBOX':
            break;
        case 'SELECT':
            break;
        case 'DIV':
            if(document.getElementById(Objeto)!=null)
                Valor=true;
            break;
        default:
            //		alert(document.getElementsByName(Objeto));
            if(document.getElementById(Objeto)!=null)
                Valor=true;
            else if (document.getElementsByName(Objeto)!=null && document.getElementsByName(Objeto).value!=undefined)
                Valor=true;
            break;	
    }
    return Valor;
}


function ObtenerValorObjeto(Objeto,Propiedad,TipObjeto,NroItems,Indice)
{
    Valor=false;
    switch(TipObjeto)
    {
        case 'TEXT':
            break;
        case 'CHECKBOX':
            if(Propiedad!=undefined && Propiedad!='undefined' &&  Propiedad!='')
            {	
                if (document.getElementsByName(Objeto)!=null && Indice !=undefined)
                {
                    var ctrl=document.getElementsByName(Objeto);
                    if(ctrl[Indice].checked)	Valor=eval("ctrl."+Propiedad); else Valor=false;				
                }
                else if(document.getElementById(Objeto)!=null && Indice !=undefined)
                {
                    var ctrl=document.getElementById(Objeto);
                    if(ctrl[Indice].checked)	Valor=eval("ctrl."+Propiedad); else Valor=false;								
                }
                else if(NroItems!=undefined)
                {
                    for(i=0;i<NroItems;i++)
                    {
                        ctrl=eval("document.form['"+Objeto+"["+i+"]']");
                        if(ctrl.checked) if(Valor==false) 	Valor=eval("ctrl."+Propiedad); else Valor=Valor+","+eval("ctrl."+Propiedad);
                    }
				
                }
            }
            else
            {
                if (document.getElementsByName(Objeto)!=null && Indice !=undefined )
                {
                    var ctrl=document.getElementsByName(Objeto);
                    if(ctrl[Indice].checked)	Valor=ctrl.value; else Valor=false;				
                }
                else if(document.getElementById(Objeto)!=null && Indice !=undefined )
                {
                    var ctrl=document.getElementById(Objeto);
                    if(ctrl[Indice].checked)	Valor=ctrl.value; else Valor=false;								
                }
                else if(NroItems!=undefined)
                {
                    for(i=0;i<NroItems;i++)
                    {
                        ctrl=eval("document.form['"+Objeto+"["+i+"]']");
                        if(ctrl.checked) if(Valor==false) 	Valor=ctrl.value; else Valor=Valor+","+ctrl.value;
                    }
				
                }		
            }	
            break;
        case 'SELECT':
            break;
        case 'RADIO':
            if(Propiedad!=undefined && Propiedad!='undefined' &&  Propiedad!='')
            {	
                if (document.getElementsByName(Objeto)!=null)
                {
                    var ctrl=document.getElementsByName(Objeto);
                    for(i=0;i<ctrl.length;i++)
                        if(ctrl[i].checked) Valor=eval("ctrl['"+i+"']."+Propiedad);
                }
                else if(document.getElementById(Objeto)!=null)
                {
                    var ctrl=document.getElementById(Objeto);
                    for(i=0;i<ctrl.length;i++)
                        if(ctrl[i].checked) Valor=eval("ctrl['"+i+"']."+Propiedad);		
                }
            }
            else
            {
			
                if (document.getElementsByName(Objeto)!=null)
                {
                    var ctrl=document.getElementsByName(Objeto);
                    for(i=0;i<ctrl.length;i++)
                        if(ctrl[i].checked) Valor=ctrl[i].value;		
                }
                else if(document.getElementById(Objeto)!=null)
                {
                    var ctrl=document.getElementById(Objeto);
                    for(i=0;i<ctrl.length;i++)
                        if(ctrl[i].checked) Valor=ctrl[i].value;		
                }			
            }
            break;
        default:
            if(Propiedad!=undefined && Propiedad!='undefined' &&  Propiedad!='')
            {
                if(document.getElementById(Objeto)!=null)
                    Valor=eval("document.getElementById('"+Objeto+"')."+Propiedad);
                else if (document.getElementsByName(Objeto)!=null && document.getElementsByName(Objeto).value!=undefined)
                    Valor=eval("document.getElementsByName('"+Objeto+"')."+Propiedad);			
            }
            else
            {
                if(document.getElementById(Objeto)!=null)
                    Valor=document.getElementById(Objeto).value;		
                else if (document.getElementsByName(Objeto)!=null && document.getElementsByName(Objeto).value!=undefined)
                    Valor=document.getElementsByName(Objeto).value;			
            }
            break;	
    }
    return Valor;
}
function ColocarValorObjeto(Objeto,Valor,Propiedad,TipObjeto,NroItems,Indice)
{
    switch(TipObjeto)
    {
        case 'TEXT':
            break;
        case 'CHECKBOX':
            break;
        case 'SELECT':
            break;
        case 'RADIO':
            if(Propiedad!=undefined && Propiedad!='undefined' &&  Propiedad!='')
            {	
                if(Valor==true || Valor==false)
                {			
                    if (document.getElementsByName(Objeto)!=null)
                    {
                        var ctrl=document.getElementsByName(Objeto);
                        eval("ctrl["+Indice+"]."+Propiedad+"="+Valor);
                    }
                    else if(document.getElementById(Objeto)!=null)
                    {
                        var ctrl=document.getElementById(Objeto);
                        eval("ctrl["+Indice+"]."+Propiedad+"="+Valor);				
                    }
                }
                else
                {
                    if (document.getElementsByName(Objeto)!=null)
                    {
                        var ctrl=document.getElementsByName(Objeto);
                        eval("ctrl["+Indice+"]."+Propiedad+"='"+Valor+"'");
                    }
                    else if(document.getElementById(Objeto)!=null)
                    {
                        var ctrl=document.getElementById(Objeto);
                        eval("ctrl["+Indice+"]."+Propiedad+"='"+Valor+"'");				
                    }
                }
            }
            else
            {
			
                if (document.getElementsByName(Objeto)!=null)
                {
                    var ctrl=document.getElementsByName(Objeto);
                    ctrl.value=Valor;
                }
                else if(document.getElementById(Objeto)!=null)
                {
                    var ctrl=document.getElementById(Objeto);
                    ctrl.value=Valor;
                }			
            }
	
            break;	
        default:
            var a=new Array();
            a=convertir_a_arreglo(Objeto,',');
            for (x=0;x<a.length;x++)
            {
                Objeto=a[x];
                //alert(Objeto+Propiedad+Valor);
                if(Propiedad!=undefined && Propiedad!='undefined' &&  Propiedad!=''){
                    if(Valor==true || Valor==false)
                    {
                        if(document.getElementById(Objeto)!=null)
                            eval("document.getElementById('"+Objeto+"')."+Propiedad+"="+Valor);
                        else if (document.getElementsByName(Objeto)!=null && document.getElementsByName(Objeto).value!=undefined)
                            eval("document.getElementsByName('"+Objeto+"')."+Propiedad+"="+Valor);
                    }
                    else
                    {
                        if(document.getElementById(Objeto)!=null)
                            eval("document.getElementById('"+Objeto+"')."+Propiedad+"='"+Valor+"'");
                        else if (document.getElementsByName(Objeto)!=null && document.getElementsByName(Objeto).value!=undefined)
                            eval("document.getElementsByName('"+Objeto+"')."+Propiedad+"='"+Valor+"'");
                    }
                }
                else
                {
                    if(document.getElementById(Objeto)!=null)
                        document.getElementById(Objeto).value=Valor;		
                    else if (document.getElementsByName(Objeto)!=null)
                        document.getElementsByName(Objeto).value=Valor;
                }
            }
            break;	
    }
}


function Numero_repiticion_caracter(cadena,parametro)
{
    if(trim(cadena)!="")
    {
        var a = new Array();
        a=convertir_a_arreglo(cadena,parametro);	
        return a.length;
    }
    return 0;
}
function configurar_div(cadena,ancho)
{
    var totaldeancho=screen.width*ancho/100;
    ///alert(screen.width+"-"+totaldeancho);
    var a = new Array();
    a=convertir_a_arreglo(cadena,',');
    s_ancho=0;
    for (x=0;x<a.length;x++)
        s_ancho=s_ancho+parseFloat(a[x]);
    //alert(s_ancho+"-"+totaldeancho);
    for (x=0;x<a.length;x++)
    {
        //alert(a[x]);
        a[x]=parseFloat(a[x]*totaldeancho/s_ancho);
    //alert(a[x]);
    }
    cadena=	convertir_a_cadena(a,',');
    //alert(cadena);
    return cadena;
}

function resolucion_monitor()
{
    /*
Diferentes versiones seg�n la resoluci�n
(Por Miguel Cruz, http://www.signo-net.com)
             */
    // para resolucion 640x480
    if (screen.width==640||screen.height==480)
        return 1;
    //window.location.replace("es640480/index.htm")

    //para resolucion 800x600
    else if (screen.width==800||screen.height==600)
        return 2;
    //window.location.replace("es800600/index.htm")

    //para resolucion 1024x768
    else if (screen.width==1024||screen.height==768)
        return 3;
    //window.location.replace("es1024768/index.htm")
    //para otras resoluciones
    else
        return 4;
//window.location.replace("es1024768/index.htm ")
}

function existe_item(item_a_buscar,cadena,parametro)
{
    //alert(cadena);
    var sw=false;	
    if(cadena.length>0)
    {	
        var a = new Array();
        a=convertir_a_arreglo(cadena,parametro);
        //	alert("total "+a.length);
        //	alert("ultimo valor "+a[a.length-1]);
        for (x=0;x<a.length;x++)
        {
            if(a[x]==item_a_buscar)	sw=true;
        }
    }
    //alert(sw);
    return(sw);
}
function extraer_item(item_a_buscar,cadena,parametro)
{
    //alert(cadena);
    if(cadena.length>0)
    {
        var a = new Array();	
        a=convertir_a_arreglo(cadena,parametro);
        var cadena="";
        for (x=0;x<a.length;x++)
        {
            if(a[x]!=item_a_buscar)	
            {
                if (a[x]==0 || cadena=="")
                    cadena=a[x];
                else
                    cadena=cadena+parametro+a[x];
            }
        }
    }
    //alert(sw);
    return(cadena);
}
function convertir_a_cadena(a,parametro)
{
    var cadena="";
    for (x=0;x<a.length;x++)
    {
        if (x==0)
            cadena=a[x];
        else
            cadena=cadena+parametro+a[x];
    }
    return cadena;
}
function convertir_a_arreglo(cadena,parametro)
{
    var temp=""+cadena;
    if(temp.length>0)
    {	
        var a = new Array();
        var pos=temp.indexOf(parametro);
        var len=parametro.length;
        while(pos!=-1)
        {
            //alert(pos);
            a.push(temp.substring(0, pos));
            //alert(temp.substring(0, pos));
            pos=parseInt(pos)+parseInt(len);
            temp = "" + temp.substring(pos,temp.length);
            pos=temp.indexOf(parametro);
        }
        a.push(temp.substring(0,temp.length));
    }
    return a;
}
//obiente true si  fecha1 es mayot que fecha2
function comparar_fechas(fecha1,fecha2,hora1,hora2)
{
    var bRes = false; 
    var sDia1 = fecha1.substr(0, 2); 
    var sMes1 = fecha1.substr(3, 2); 
    var sAno1 = fecha1.substr(6, 4); 
    var sDia2 = fecha2.substr(0, 2); 
    var sMes2 = fecha2.substr(3, 2); 
    var sAno2 = fecha2.substr(6, 4); 
    if (sAno1 > sAno2) bRes = true; 
    else 
    { 
        if (sAno1 == sAno2)
        { 
            if (sMes1 > sMes2) bRes = true; 
            else 
            { 
                if (sMes1 == sMes2) 
                    if (sDia1 > sDia2) bRes = true; 
                    else if (sDia1 == sDia2 && hora1!=null && hora2 !=null)
                    {
                        var sHora1 = hora1.substr(0, 2); 
                        var sMinuto1 = hora1.substr(3, 2); 
                        var sHora2 = hora2.substr(0, 2); 
                        var sMinuto2 = hora2.substr(3, 2); 
                        if (sHora1 > sHora2) bRes = true; 
                        else if (sHora1 == sHora2) 
                            if (sMinuto1 >= sMinuto2) bRes = true; 
                    }
            } 
        } 
    } 
    return bRes; 
} 
   
   
function getHoyddmonyyyy(){
    //regresa la cadena de la fecha de hoy en formato dd-mon-yyyy
    var hoy = new Date()
    return hoy.getDate() + "-" + getMonthName(hoy.getMonth()) + "-" + hoy.getYear()
}


function getFechaddmonyyyy(f){
    //regresa la cadena de la fecha que pasamos como parametro en formato dd-mon-yyyy
    return f.getDate() + "-" + getMonthName(f.getMonth()) + "-" + f.getYear()
}

function getDiasMes(mes, anio){
    //regresa la cantidad de d�as del mes del a�o que pasamos como parametro
    switch (mes){
        case 0:
            return 31;
            break;
        case 1:
            if (anio % 4 == 0){
                if (anio % 400 == 0){
                    return 29;
                }
                else {
                    if (anio % 100 == 0){
                        return 28;
                    }
                    else {
                        return 29;
                    }
                }
            }
            else {
                return 28;
            };
            break;
        case 2:
            return 31;
            break;
        case 3:
            return 30;
            break;
        case 4:
            return 31;
            break;
        case 5:
            return 30;
            break;
        case 6:
            return 31;
            break;
        case 7:
            return 31;
            break;
        case 8:
            return 30;
            break;
        case 9:
            return 31;
            break;
        case 10:
            return 30;
            break;
        case 11:
            return 31;
            break;

    }
}

function getNombreMes(mes){
    //regresa el nombre del mes que pasamos como parametro
    //0-Ene 11-Dic
    var txtMes
    switch(parseInt(mes)){
        case 1:
            txtMes="Ene";
            break;
        case 2:
            txtMes="Feb";
            break;
        case 3:
            txtMes="Mar";
            break;
        case 4:
            txtMes="Abr";
            break;
        case 5:
            txtMes="May";
            break;
        case 6:
            txtMes="Jun";
            break;
        case 7:
            txtMes="Jul";
            break;
        case 8:
            txtMes="Ago";
            break;
        case 9:
            txtMes="Sep";
            break;
        case 10:
            txtMonth="Oct";
            break;
        case 11:
            txtMes="Nov";
            break;
        case 12:
            txtMes="Dic";
            break;
    }
    return txtMes
}

function fecha_actual()
{
    var mydate=new Date();
    var year=mydate.getYear();
    if (year < 1000)
        year+=1900;
    var day=mydate.getDay();
    var month=mydate.getMonth()+1;
    if (month<10)
        month="0"+month;
    var daym=mydate.getDate();
    if (daym<10)
        daym="0"+daym;
    return (daym+"/"+month+"/"+year);
}
//redondea numeros
function redondear(cantidad, decimales) 
{
    if(cantidad == "") cantidad = "0";
    var cantidad = parseFloat(cantidad);
    var decimales = parseFloat(decimales);
    decimales = (!decimales ? 2 : decimales);
    cantidad = Math.round(cantidad * Math.pow(10, decimales)) / Math.pow(10, decimales); 
    var Ncantidad = ""+cantidad;
    ceros = "";
    for (i=0; i < decimales; i++)
        ceros += '0';
    pos = Ncantidad.indexOf('.')
    if (pos < 0)
        Ncantidad = Ncantidad+"."+ceros;
    else
    {
        pdec = Ncantidad.length - pos -1;
        if (pdec <= decimales)
        {
            for (i=0; i< (decimales-pdec); i++)
                Ncantidad += '0';
        }
    }

    return Ncantidad;
}
//reemplaza caracteres
function reemplaza_caracteres(cadena,cad1,cad2)
{
    temp = "" + cadena;
    //bucle mientras se encuentre la cadena de busqueda
    while (temp.indexOf(cad1)>-1)
    {
        //pos es igual a la posicion donde se encuentra la coincidencia
        pos=temp.indexOf(cad1);
        //coge la cadena desde el principio hasta la primera coincidencia, a�ade
        // el caracter de reemplazo, y coge el resto de cadena, realizando de esta
        // mantera el reemplazo
        temp = "" + (temp.substring(0, pos) + cad2 + temp.substring((pos + cad1.length), temp.length));
    }
    return temp;
}

//solo numeros
function numbersonly2(myfield, e, dec) 
{
    var key;
    var keychar;
    if (window.event)	
        key = window.event.keyCode;	
    else if (e)	
        key = e.which;
    else	
        return true;	
    keychar = String.fromCharCode(key);
    // control keys
    //if ((key==13) )	
    //alert("aaaaaaaa");
	
    if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )	
        return true;
    // numbers  
    if (dec && (keychar == "." || keychar == ","))  
    { 
        return true;  
    }  
    else if ((("0123456789").indexOf(keychar) > -1))  
        return true;
    // decimal point jump  
    else  
        return false;  
}
function numbersonly(myfield, e, dec) // {return numbersonly(this, event,'.');}
{
    var key;
    var keychar;
    if (window.event)
        key = window.event.keyCode;
    else if (e)
        key = e.which;
    else
        return true;
    keychar = String.fromCharCode(key);
    if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27))
        return true;
    // Valida numeros
    if (dec && (keychar == "." || keychar == ","))
    {
        var temp=""+myfield.value;
        alert(temp);
        if(temp.indexOf(keychar) > -1)
            return false;
    }
    else if ((("0123456789").indexOf(keychar) > -1)){
        return true;
    }
    else{
        return false;
    }
}


function numbersonlyjorge(myfield, e, dec) // {return numbersonly(this, event,'.');}
{
    var key;
    var keychar;
    if (window.event)
        key = window.event.keyCode;
    else if (e)
        key = e.which;
    else
        return true;
   
    keychar = String.fromCharCode(key);//muestra lo que escribo en el teclado
  
    if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27))
        return true;
    // Valida numeros
    if (dec && (keychar == "." || keychar == ","))
    {
        var item = new Boolean(true); 
        var temp=""+myfield.value;// bota el valor anterior(onkeypress) que he escrito total por el teclado,por la condicion del if solo cuando imprimo el punto
        if(temp.indexOf(keychar) > -1)
            item= false;
        return item;  
    }
    else {
        var temp2=""+myfield.value;
        if ((("0123456789").indexOf(keychar) > -1)|| ((keychar == "-" && (temp2.indexOf("-") <= -1)))){
        
            if(temp2.length==0){
                return true;
            }
            else {
                if(keychar == "-"){
                    myfield.value="-"+temp2;//valor.substr(0, valor.length-1);
                    return false;
                    
                }
                else {
                    return true ;
                }
            }

        }
        else{
            return false;
        }
    } 
}
//solo letras
function validar_texto_unicamente(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-z\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
} 
function setupper(myfield)
{
    if (myfield.inchange)return;
    myfield.inchange=true;
    myfield.value=myfield.value.toUpperCase();
    myfield.inchange=false;
//document.getElementById("LinearD").disabled=true
}
//solo letras
function letrasonly(myfield, e, dec) 
{
    var key;
    var keychar;
    if (window.event)	
        key = window.event.keyCode;	
    else if (e)	
        key = e.which;
    else	
        return true;	
    keychar = String.fromCharCode(key);
    // control keys
    //if ((key==13) )	
    //alert(key);
	
    if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) || (key==32) )	
        return true;
    // numbers  
    if (dec && (keychar == "." || keychar == ","))  
    { 
        var temp=""+myfield.value;	
        if(temp.indexOf(keychar) > -1) 
            return false;  
    }  
    else if ((("ABCDEFGHIJKLMN�OPQRSTUVWXYZ����������abcdefghijklmn�opqrstuvwxyz\"").indexOf(keychar) > -1))  
        return true;
    // decimal point jump  
    else  
        return false;  
}
function dateonly(myfield, e, dec) 
{
    var key;
    var keychar;
    if (window.event)	
        key = window.event.keyCode;	
    else if (e)	
        key = e.which;
    else	
        return true;	
    keychar = String.fromCharCode(key);
    // control keys
    //if ((key==13) )	
    //alert("aaaaaaaa");
	
    if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )	
        return true;
    // numbers  
    if (dec && (keychar == "/"))  
    { 
        var temp=""+myfield.value;	
        pos=temp.indexOf('/');
        temp = "" + temp.substring(pos+1,temp.length);
        if(temp.indexOf(keychar) > -1) 
            return false;  
    }  
    else if ((("0123456789").indexOf(keychar) > -1))  
        return true;
    // decimal point jump  
    else  
        return false;  
}
//define una cantida de caracteres 
function caracter_en_mayuscula(myfield,e,nrodigitos)
{
    var temp=""+myfield.value;	
    var key;
    var keychar;
    if (window.event)	
        key = window.event.keyCode;	
    else if (e)	
        key = e.which;
    else	
        return true;
    keychar = String.fromCharCode(key);
    // control keys
    //alert(key);
    if ((key==null) || (key==0) || (key==8) || (key==9)  )	
        return true;
    if ((key==13) || (key==27))
        return false;
    if (temp.length>nrodigitos)
    {
        alert('LLEGO AL LIMITE PERMISIBLE...');
        return false;
    }
    if ((key==32))	
        return true;
    else if ((("ABCDEFGHIJKLMN�OPQRSTUVWXYZ0123456789()���������ڪ�!�$%/()=?���'{}[]-_*\.,;:abcdefghijklmn�opqrstuvwxyz\"").indexOf(keychar) > -1))  
        return true;
    // decimal point jump  
    /*	else if (dec && (keychar == "."))  
	{ 
	 myfield.form.elements[dec].focus();  
	return false;  
	}*/  
    else  
        return false;  
}

//solo letras mayusculas
function mayusonly(myfield, e, dec) 
{
    var key;
    var keychar;
    if (window.event)	
        key = window.event.keyCode;	
    else if (e)	
        key = e.which;
    else	
        return true;	
    keychar = String.fromCharCode(key);
    // control keys

    if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )	
        return true;
    // numbers  
    else if ((("ABCDEFGHIJKLMN�OPQRSTUVWXYZ0123456789/-*._�?�'").indexOf(keychar) > -1))  
        return true;
    // decimal point jump  
    else  
        return false;  
}
/*Selecciona el texto de una caja de texto recibe como parametro una caja de texto*/
function confirmar(texto){
    input_box=confirm(texto);
    if (input_box==true){ 
        return true; 
    }else{
        return false;
    }
}

function js_envia(pag){
    window.location.href=pag;
}

function js_abrirVentana(direccion,nombre,ancho,alto)
{
    ventana = window.open(direccion,nombre,'toolbar=no,location=no ,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=yes,' + ' width=' + ancho + ', height=' + alto );
    ventana.focus();	
}

function jsabrirventana(direccion, nombre,pantallacompleta, herramientas, direcciones, estado, barramenu, barrascroll, cambiatamano, ancho, alto, sustituir){ 
    var izquierda = (screen.availWidth - ancho) / 2; 
    var arriba = (screen.availHeight - alto) / 2; 
    var opciones = "fullscreen=" + pantallacompleta + 
    ",toolbar=" + herramientas + 
    ",location=" + direcciones + 
    ",status=" + estado + 
    ",menubar=" + barramenu + 
    ",scrollbars=" + barrascroll + 
    ",resizable=" + cambiatamano + 
    ",width=" + ancho + 
    ",height=" + alto + 
    ",left=" + izquierda + 
    ",top=" + arriba; 
    var ventana = window.open(direccion,nombre,opciones,sustituir); 
}      

function js_seleccionaTexto(caja)
{
    if ( js_estaVacio(caja) == false )
    {
        caja.focus();
        caja.select();
    }
}
/*Pene el foco a una caja de texto*/
function js_ponerFoco(caja)
{

    caja.focus();

}



/*Envia un mensaje en el explorador cliente*/
function js_mensaje(mensaje)
{
    alert(mensaje);
}

/*Quita los espacios en blanco a la derecha y a la izquierda*/

function js_trim(str_cadena)

{
    str_cadenaI="";
    str_cadenaD="";

    for (i=0;i<str_cadena.length;i++)
    {		
        chr_letra = str_cadena.charAt(i)

        if (chr_letra!=' ') 
        {
            str_cadenaI= str_cadena.substring(i,str_cadena.length); //Quita espacios en blanco de la derecha
		
            for (j=str_cadenaI.length-1;j>-1;j--)
            {		
                chr_letra = str_cadenaI.charAt(j);

                if (chr_letra!=' ') 
                {
                    str_cadenaD = str_cadenaI.substring(0,j+1); //Quita espacios en blanco de la izquierda
					
                    str_cadenaD = js_quitaEspaciosEntrePalabras(str_cadenaD)
					
                    return str_cadenaD;
										
                }
			
            }
		
        }
    
    }

    return "";

}

/*Quita los espacios en blanco entre palabras*/

function js_quitaEspaciosEntrePalabras(str_texto) 
{

    str_textoOk ="";
    bol_esLetra = true;
    num_contEsp = 0;
    chr_letra ="";

    for(i=0;i<str_texto.length;i++)
    { 

        chr_letra = str_texto.charAt(i);


        if (chr_letra == " " )
        {
            num_contEsp = num_contEsp + 1;
            bol_esLetra = false; 
        }
        else 
        {
            bol_esLetra = true; 
            num_contEsp = 0;
        }  


        if (bol_esLetra == true && num_contEsp <=1 )
        {

            str_textoOk = str_textoOk + str_texto.charAt(i);

        }
	
        else 
        {
            if (num_contEsp == 1 && bol_esLetra == false )
            {

                str_textoOk = str_textoOk + str_texto.charAt(i);
		
            }
            else
            {
                if (bol_esLetra == true && num_contEsp > 1 )
                {
                    str_textoOk = str_textoOk + str_texto.charAt(i);
                    num_contEsp = 0
                }
            }
        }


    }

    return str_textoOk;

}


/*Comprueba si la caja de texto esta vacia retorna verdadero o falso*/

function js_estaVacio(caja)
{

    if (caja.value.length > 0 )
    {
        caja.value = js_trim(caja.value);
    }

    if (caja.value.length > 0 )
    {
        return false;
    }
    else 
    {
        return true;
    }
	
}


/*Comprueba si es el valor es texto se pasa como parametro el texto de una caja de texto 
retorna verdadero o falso */

function js_esTexto(caja)
{
    if (js_estaVacio(caja) == false )
    {
        var b =0;

        for(i=0; i< caja.value.length ;i++)
        {
            caja.value = cambiarAcentos(caja.value)
			 
            if (b!=0)break;
 	 
            if (js_esCaracterTexto(caja.value.substr(i,1))== -1 )
            {
                return false;
                b = 1;
            }
	
        }

        return true;
	
    }else
    {
        return false;
    }
	
}

/*Comprueba si es el valor es num�rico se pasa como parametro el texto de una caja de texto 
retorna verdadero o falso */

function js_esNumero(caja)
{

    if (js_estaVacio(caja) == false )
    {

        var b =0;

        for(i=0; i< caja.value.length ;i++)
        {
 	 
            if (b!=0)break;
 	 
 	  	  
            if (js_esCaracterNumero(caja.value.substr(i,1))== -1 )
            {
		
                return false;
                b = 1;
            }
	
        }
        return true;
	
    }else
    {
        return false;
    } 

	
}

/*Comprueba si una cadena es de tipo Alfanum�rico*/

function js_esAlfanumerico(caja)
{

    if (js_estaVacio(caja) == false )
    {

        var b =0;

        for(i=0; i< caja.value.length ;i++)
        {
 	 
            if (b!=0)break;
 	 
 	  	  
            if (js_esCaracterAlfanumerico(caja.value.substr(i,1))== -1 )
            {
		
                return false;
                b = 1;
            }
	
        }
        return true;
	
    }else
    {
        return false;
    } 

	

}

/****/


/*Compueba si el email es correcto retrona verdadero o falso*/

function js_esEmail(caja)
{

    if((caja.value.indexOf('@')== -1 || caja.value.indexOf('.')== -1)  || caja.value.length < 2 )
    {
        return false;
    }
    else
    {
        return true;
    }
}

/*comprueba  si un caracter es de tipo texto 
retorna -1 en caso de no encontrar coincidencias o el valor del indice donde se encuentra el texto
         */

function js_esCaracterTexto(cad)
{
    var caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ������abcdefghijklmnopqrstuvwxyz������?? '
    return( caracteres.indexOf( cad ) ) 
}				

/* comprueba  si un caracter es de tipo Num�rico 
   retorna -1 en caso de no encontrar coincidencias o el valor del indice donde se encuentra el texto 
         */


function js_esCaracterNumero(cad)
{
    var caracteres = '0123456789'
    return( caracteres.indexOf( cad ) )
} 
    
/*Confirmaci�n de Acci�n */



/*Inicio de funci�n de confirmaci�n y redireccionamiento de p�gina*/

function js_confirmarRedireccionar(mensaje, url)
{
    if (confirm(mensaje) == true )
    {
	
        document.location.href = url;  
	
    }
 
}
/*Fin de Confirmaci�n de AcciOn*/

/*Es caracter v�lido*/

function js_esCaracterValido(cad){
    var caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ������abcdefghijklmnopqrstuvwxyz ������??!"#$%&/=?���*+{}[]()-_�,.;:0123456789/\n\r'
    return( caracteres.indexOf( cad ) ) 
}				

/*Valida si un caracter es alfanum�rico*/

function js_esCaracterAlfanumerico(cad)
{
    var caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'
    return( caracteres.indexOf( cad ) ) 
}				



/*Fin de es caracter v�lido*/


/*Funci�n de validaci�n de texto valido para ingreso en textos en Base de datos*/

function js_esTextoValido(caja)
{
    if (js_estaVacio(caja) == false )
    {
        var b =0;

        caja.value = cambiarAcentos(caja.value)
	
        for(i=0; i< caja.value.length ;i++)
        {
 	 
            if (b!=0)break;
 	 
            if (js_esCaracterValido(caja.value.substr(i,1))== -1 )
            {
                return false;
                b = 1;
            }
	
        }

        return true;
	
    }else
    {
        return false;
    }
	
}

/*F�n de validaci�n de texto v�lido*/


/*Cambiar acentos*/

function cambiarAcentos(str_texto)
{
    var str_temTexto;
    str_temTexto ="";
	
    for(var i=0;i<str_texto.length;i++)
    {

        switch(str_texto.charAt(i))
        {
            case '�':
                str_temTexto = str_temTexto + '�';
                break;
            case '�':
                str_temTexto = str_temTexto + '�';
                break;
            case '�':
                str_temTexto = str_temTexto + '�';
                break;
            case '�':
                str_temTexto = str_temTexto + '�';
                break;
            case '�':
                str_temTexto = str_temTexto + '�';
                break;
            case '�':
                str_temTexto = str_temTexto + '�';
                break;
            case '�':
                str_temTexto = str_temTexto + '�';
                break;
            case '�':
                str_temTexto = str_temTexto + '�';
                break;
            case '�':
                str_temTexto = str_temTexto + '�';
                break;
            case '�':
                str_temTexto = str_temTexto + '�';
                break;
            default :
                str_temTexto = str_temTexto + str_texto.charAt(i);
                break;
        }

    }

    return str_temTexto;
	
}

/*F�n de cambiar acentos*/

/*Enviar valores de lista a caja de texto*/

function js_enviarLista(form,lista,caja,num){
    var str_cbo='';

    obj_list=eval('document.' + form + '.' + lista);
    if(num>1){
        for(var i=0; i< obj_list.length; i++){
            if(obj_list[i].checked) {
                if(str_cbo=='')	str_cbo = obj_list[i].value ;
                else str_cbo = str_cbo+ ',' + obj_list[i].value;
            }
        }
    }else 
    if(obj_list.checked)  str_cbo = obj_list.value ;

    if(str_cbo==''){
        alert('Debe seleccionar un registro!');
        return false;
    }else{
        eval('document.' + form + '.' + caja).value= str_cbo;
        return true;
    }
}
			

/*F�n de copia de valores de lista a caja*/


/*Selecciona todos los cheks de un formulario*/

function js_SeleccionaChecks(caja,condicion)
{ 
 
    var i;

    for (i = 0 ;i < TheForm.elements.length;  i++)  
    {
        if (caja.elements[i].type == "checkbox")  
        {
            caja.elements[i].checked = condicion;
        }
    }
}

/*Fin de selecci�n*/



/*Valida si una fecha ingresada es correcta en caso de ser incorrecta retorna falso*/
function js_esFecha(Dia, Mes, Ano)
{

    if(Dia > '' && Mes>'' && Ano >'')
    {
	
        if (isNaN(Ano) || Ano.length<4 || parseFloat(Ano)<1900)
        {
            return false;
        }
	
        if (isNaN(Mes) || parseFloat(Mes)<1 || parseFloat(Mes)>12){
            return false;
        }
	
	
        if (isNaN(Dia) || parseInt(Dia)<1 || parseInt(Dia)>31 )
        {	
            return false;
        }
	
        if (Mes==4 || Mes==6 || Mes==9 || Mes==11 || Mes==2) 
        {
            if (Mes==2 && Dia > 28 || Dia>30) 
            {
                return false;
            }
        }
	
    }
  
  
    else 
    {
        if(Dia > '' || Mes>'' || Ano >'')
        {
            return false;
        }
        else
        {
            return false;	
        }	
    }  
 
    return true;
 
}
function cierra_sesion(){
    //function cierra_sesion($accion,$session_id,$tiempo,$id_sistema,$contenido,$id_usuario,$ip){
    //getAccionSesion($accion,$session_id,$tiempo,$id_sistema,$contenido,$id_usuario,$ip);
    var url = 'salir.php';
    if (confirm("¿Desea Salir del Simedh WEB?")){       
        new Ajax.Request( url,{
            onComplete : function(transport){
                window.location='../../cvista/inicio/salir.php';
            //window.location = '../../../index.php';
            }
        })

    }
}
function cierra_sesion1(){
    var pathRequestControl = "../../ccontrol/control/control.php"; //alojamiento de la funcion
    patronModulo='cerrarSesion'; //nombre de la funcion
    parametros='';
    parametros+='p1='+patronModulo;

    if (confirm("¿Desea Salir del Simedh WEB?")){
        new Ajax.Request( pathRequestControl,{
            method : 'get',
            parameters : parametros,
            onLoading : micargador(1),
            onComplete : function(transport){
                micargador(0);
                respuesta = transport.responseText;           
                // window.alert(respuesta);
                window.location = '../../../index.php';//será lo que se mostrara al final
          
            }
        }
        )
    }

}

function actualiza_sesion(){
    var pathRequestControl = "../../ccontrol/control/control.php"; //alojamiento de la funcion
    patronModulo='actualizarSesion'; //nombre de la funcion
    parametros='';
    parametros+='p1='+patronModulo;

    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            // window.alert(respuesta);
            window.location = '../../../index.php';//será lo que se mostrara al final

        }
    }
    )


}



function caduca_sesion(){
    var url = 'salir.php';
    new Ajax.Request( url,{
        onComplete : function(transport){
            window.location='../../cvista/inicio/salir.php';                
        }
    })
}
