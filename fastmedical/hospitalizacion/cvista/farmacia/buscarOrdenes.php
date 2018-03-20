    	<div id="div_datosPersona" style="float:left">
        
        <form id="idGestionCita" name="idGestionCita" class="formGestionCita">
          <table  >
            <tr>
              <td>C&oacute;digo</td>
              <td><input id="txtcodigo" name="txtcodigo" type="text" size="30" readonly="true" /></td>
            </tr>
            <tr>
              <td>Apellido Paterno:</td>
              <td><input id="txtapellidoPaterno" name="txtapellidoPaterno" type="text" size="30" readonly="true" /></td>
            </tr>
            <tr>
              <td>Apellido Materno</td>
              <td><input id="txtapellidoMaterno" name="txtapellidosMaterno" type="text" size="30" readonly="true" /></td>
            </tr>
            <tr>
              <td>Nombres:</td>
              <td><input id="txtnombres" name="txtnombres" type="text" size="30" readonly="true" /></td>
            </tr>
            <tr>
              <td>Filiaci&oacute;n Activa</td>
              <td><input id="txtfiliacion" name="txtfiliacion" type="text" size="30" readonly="true" /></td>
            </tr>
          </table>
  </form>
    	</div>
        <div id="div_botones" style="float:left">
        	<div><input name="buscarpaciente" id="buscarpaciente" value="Buscar Personas" onclick="buscarPersona_orden();" type="button" width="10">
            </div>
            <div>
            <input name="Ver Datos" type="button" value="Ver Datos"/>
            </div>
        </div>
      <div id= "div_filtros" style="float:left">
        <table border="1">
  <tr>
    <td>
      <input type="checkbox" name="checkbox" id="checkbox" />
    Categor&iacute;a</td>
    <td>
      <select name="select" id="select">
        <option>Seleccione Categorias</option>
            </select>
    </td>
  </tr>
  <tr>
    <td><input type="checkbox" name="checkbox2" id="checkbox2" /> 
      Filiaci&oacute;n</td>
    <td><select name="select2" id="select2">
      <option>Seleccione Filiaci&oacute;n</option>
            </select></td>
  </tr>
  <tr>
    <td><input type="checkbox" name="checkbox3" id="checkbox3" />
      Rango de Fecha</td>
    <td><label>
      Entre:
          <input name="textfield" type="text" id="textfield" size="10" />
    y 
    <input name="textfield2" type="text" id="textfield2" size="10" />
    </label></td>
  </tr>
  <tr>
    <td><input type="checkbox" name="checkbox4" id="checkbox4" />
      Estado</td>
    <td><select name="select5" id="select5">
      <option>Seleccione Estado</option>
        </select></td>
  </tr>
</table>

   	  </div>

