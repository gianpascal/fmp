 <fieldset style="margin:1px auto;width:95%;height:200px;padding: 0px; font-size:14px">
     <input type="hidden" id="funcionDocumento" value="<?Php echo $parametros['funcionDocumento']; ?>">
                   <div style="width: 100%; height: 12%; float: left; margin-left:1%; margin-top:5px " >
                    <div style="width: 30%; height: 35%; float: left;" id="DivEtiquetaCodP">
                              Nombre de Documento:
                      </div>
                      <div style="width: 49%; height: 35%; float: left;" id="DivTextP">
                          <input onkeypress="javascript:buscarDocumentos(document.getElementById('txtDocumento').value,this,event);" type="text" id="txtDocumento" name="txtDocumento" size="12" value="" style="width:100%;">
                              <input type="hidden" id="hDocumento" name="hDocumento" size="12" value="">
                      </div>

                       <div style="width: 20%; height: 35%; float: left;" id="DivEtiquetaNomP">
                             <a href="javascript:buscarDocumentos(document.getElementById('txtDocumento').value,'','');">
                            <img border="0" title="Buscador de Documentos" alt="" src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif"/></a>
                    </div>
           </div>
            <div id="divdetalleDocumento" style=" height:85%; width:99%; float: left; margin-left:5px; overflow: auto;">
            <?Php
           echo $tablaDocumentos;
             ?>
             </div>
                      
                     
   </fieldset>