//efecto dos estados para los tabs -----JCLM63--------
function iniTabs(divTabs,idMenu,activado){
    for (i=0;i<idMenu.length;i++){
        var nenu=idMenu[i];
        var iddiv=divTabs[i];
        if(idMenu[i]==activado ){
            $(nenu).className='tabs_1';
            document.getElementById(iddiv).style.display='block';
        }else{
            $(nenu).className='tabs_2';
            document.getElementById(iddiv).style.display='none';
        }
    }
//setTimeout(function(){iniTabs(divTabs,idMenu,activado)},20);
}
