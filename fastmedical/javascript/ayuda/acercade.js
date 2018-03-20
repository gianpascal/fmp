/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function acercade(){
    //window.alert($('divBusCronogramaMedico').getStyle('z-index'));
    ancho='500'
    largo='200'
    ventanaCargar='../../ccontrol/control/control.php?p1=acercade'
    titulo='Acerca de...'
    vFormaAbrir='VENTANA'
    vformname='tablacitasAdicionales'
    vtitle='Acerca de...'
    file02='../../ccontrol/control/control.php?p1=acercade'
    vwidth='500'
    vheight='200'
    vcenter='t'
    vresizable=''
    vmodal=''
    vstyle=''
    vopacity=''
    veffect=''
    vposx1=''
    vposx2=''
    vposy1=''
    vposy2=''
    file01=''
    vfunctionjava=''
    //CargarVentanaFormulario("VENTANA",vformname,vtitle,file,vwidth,vheight,vcenter,vresizable,true,vstyle,vopacity,veffect,vposx1,vposx2,vposy1,vposy2,'','')
    //CargarVentana(vformname,vtitle,file,vwidth,vheight,vcenter,vresizable,vstyle,vopacity,veffect,vposx1,vposx2,vposy1,vposy2)
    //CargarVentana('tablacitasAdicionales',titulo,ventanaCargar,ancho,largo,'t',true,0,1,'',0,0,0,0);
    CargarVentanaFormulario(vFormaAbrir,vformname,vtitle,file02,vwidth,vheight,vcenter,vresizable,vmodal,vstyle,vopacity,veffect,vposx1,vposx2,vposy1,vposy2,file01,vfunctionjava)
}
