<script type="text/javascript">
	function validarNinoSano(){
	  var txtn=frm.txtnombre;
	  if(txtn.value==''){
	    alert('Ingrese su nombre');
	    txtn.focus();
	    return false;
	  }
	
	  if(frm.txtapellidos.value==''){
	    alert('Ingrese sus Apellidos');
	    frm.txtapellidos.focus();
	    return false;
	  }
	  if(frm.txtclave.value==''){
	    alert('Ingrese su clave');
	    frm.txtclave.focus();
	    return false;
	  }
	  if(isNaN(frm.txtclave.value)){
	    alert('la clave debe ser un numero');
	    frm.txtclave.focus();
	    return false;
	  } 
	  return true;
	}
</script>
<!--<div id="Div_cuerpoHC" style="width:100%">-->
<?php
	/*require 'CapaNegocio/clsNegocio.php';
	$ObjN = new clsNegocio();
	// Recuperar el id
	$Id = $_GET['id'];
	// Recuperar datos del alumno
	$fila = $ObjN->Buscar($Id);*/
	?>
<div id="cuerpo">
	<form id="frm" name="frm" onsubmit="return validarNinoSano()" method="post" action="InterCuadre.php">
		<div>
			<legend>CONTROL NIÑO SANO 6-12 meses</legend>
			<table width="100%" height="121" border="0" align="center">
				<tr>
					<td>Nombres: </td>
					<td colspan="7">
						<!--<input type="text" name="paciente" readonly style="background-color:#CCC;" value="<?php echo $paciente;?>"/>
							<input type="hidden" id="id_paciente" name="id_paciente" value="<?php echo $id_paciente;?>">
							-->
						<input type="text" name="paciente" id="celdaninosano">
					</td>
				</tr>
				<tr>
					<td>Edad actual: </td>
					<td><input type="text" name="edad"></td>
					<td>Peso: </td>
					<td width=""><input type="text" name="peso" /></td>
					<td>talla: </td>
					<td><input type="text" name="talla"></td>
					<td>PC: </td>
					<td><input type="text" name="pc"></td>
				</tr>
				<tr>
					<td>Nota: </td>
					<td colspan="7"><textarea name="nota" id="celdaninosano" style="height: 78px"></textarea></td>
				</tr>
			</table>
		</div>
		<!--<div>
			<legend>Historia actual</legend>
			<table width="100%" height="121" border="0" align="center">
			
				<tr> 
					<td>Sueño: </td>
					<td colspan="2">
						<select name="valor">
							<option value="">Seleccione</option>
							<option value="Nacional">Nacional</option>
							<option value="Extranjero">Extranjero</option>
						</select>
					</td>
				</tr>
				<tr> 
					<td>Deposiciones: </td>
					<td colspan="2">
						<select name="valor">
							<option value="">Seleccione</option>
							<option value="Nacional">Nacional</option>
							<option value="Extranjero">Extranjero</option>
						</select>
					</td>
				</tr>
				<tr> 
					<td>Enfermedades: </td>
					<td colspan="2">
					<select name="valor">
					<option value="">Seleccione</option>
					<option value="Nacional">Nacional</option>
					<option value="Extranjero">Extranjero</option>
					</select>
					</td>
				</tr>
				<tr> 
					<td>Medicacion: </td>
					<td colspan="2">
					<select name="valor">
					<option value="">Seleccione</option>
					<option value="Nacional">Nacional</option>
					<option value="Extranjero">Extranjero</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>
						<tr><td>Nutrición: </td></tr>
						<tr>
							<td>
							<input type="checkbox" name="lm" />
							Fluor
							<br /><label>&nbsp;</label>
							<input type="checkbox" name="cereal" />
							Formula
							<br /><label>&nbsp;</label>
							<input type="checkbox" name="verduras" />
							LM
							<br /><label>&nbsp;</label>
							<input type="checkbox" name="verduras" />
							Cereal
							</td>
							<td>
							<br /><label>&nbsp;</label>
							<input type="checkbox" name="conocimiento1" />
							Jugos
							<br /><label>&nbsp;</label>
							<input type="checkbox" name="conocimiento1" />
							Verduras
							<br /><label>&nbsp;</label>
							<input type="checkbox" name="conocimientos2" />
							Carnes
							<br /><label>&nbsp;</label>
							<input type="checkbox" name="conocimientos3" />
							Menestras
							</td>
						</tr>
					</td>
				</tr>
			</table>
			</div>-->
		<div id="wrapper1">
			<legend>Historia actual:</legend>
			<table width="100%" border="0" align="center">
				<tr>
					<td>Sueño: </td>
					<td colspan="2">
						<select name="valor">
							<option value="">Seleccione</option>
							<option value="Nacional">Nacional</option>
							<option value="Extranjero">Extranjero</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Deposiciones: </td>
					<td colspan="2">
						<select name="valor">
							<option value="">Seleccione</option>
							<option value="Nacional">Nacional</option>
							<option value="Extranjero">Extranjero</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Enfermedades: </td>
					<td colspan="2">
						<select name="valor">
							<option value="">Seleccione</option>
							<option value="Nacional">Nacional</option>
							<option value="Extranjero">Extranjero</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Medicacion: </td>
					<td colspan="2">
						<select name="valor">
							<option value="">Seleccione</option>
							<option value="Nacional">Nacional</option>
							<option value="Extranjero">Extranjero</option>
						</select>
					</td>
				</tr>
			</table>
		</div>
		<div id="wrapper2">
			<legend>Nutrición</legend>
			<table width="100%" border="0" align="center">
				<tr>
					<td>
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="fluor" />
						Fluor
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="formula" />
						Formula
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="lm" />
						LM
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="cereal" />
						Cereal
					</td>
					<td>
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="jugos" />
						Jugos
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="verduras" />
						Verduras
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="carnes" />
						Carnes
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="menestras" />
						Menestras
					</td>
				</tr>
			</table>
		</div>
		<div id="wrapper_general1">
			<legend>Crecimiento y Desarrollo:</legend>
			<table width="100%" border="0" align="center">
				<tr>
					<center>
						<td><strong>6 meses: </strong></td>
					</center>
					<center>
						<td><strong>9 meses: </strong></td>
					</center>
					<center>
						<td><strong>12 meses: </strong></td>
					</center>
				</tr>
				<tr>
					<td rowspan="7">
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="lm" />
						Sonríe con su imagen
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="cereal" />
						Estira brazo para coger objetos
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="verduras" />
						Se voltea
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="verduras" />
						Juega con su pies
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="conocimiento1" />
						Se sienta sin ayuda
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="conocimiento1" />
						Verduras
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="conocimientos2" />
						Balbucea con iniciativa
					</td>
					<td rowspan="7">
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="lm" />
						Busca objeto escondido
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="cereal" />
						Pinza con dedos, come con las mano 
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="verduras" />
						Se para y camia agarrado
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="verduras" />
						Gatea
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="verduras" />
						Mama/dada inesperado
					</td>
					<td rowspan="7">
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="lm" />
						Toma de taza
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="cereal" />
						Mamá/papá especifico 
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="verduras" />
						Camina
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="verduras" />
						Viene cuando se le llama
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="verduras" />
						Hace chau, aplaude
					</td>
				</tr>
			</table>
		</div>
		<div id="wrapper_general2">
			<legend>Crecimiento y Desarrollo:</legend>
			<table width="100%" border="0" align="center">
				<tr>
					<td>T</td>
					<td><input type="text" name="t"/></td>
					<td>FC</td>
					<td><input type="text" name="fc"/></td>
					<td>FR</td>
					<td><input type="text" name="fr"/></td>
				</tr>
				<tr>
					<center>
						<td><strong>Examen Físico: </strong></td>
					</center>
					<center>
						<td></td>
					</center>
					<center>
						<td><strong>Vacunas </strong></td>
					</center>
				</tr>
				<tr>
					<td rowspan="7">
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="lm" />
						Piel y ganglios:
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="cereal" />
						Cabeza y cuello:
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="verduras" />
						Ojos:
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="verduras" />
						Nariz:
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="conocimiento1" />
						Oidos
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="conocimiento1" />
						Orofaringe
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="conocimientos2" />
						Cardiovascular:
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="conocimiento1" />
						Abdomen y GI:
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="conocimientos2" />
						Genitourinario:
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="conocimientos2" />
						Sist. Nervioso:
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="conocimientos2" />
						Sist. Esquelét:
					</td>
					<td rowspan="3">
						EG:
						<br /><label>&nbsp;</label>
						<textarea name="nota" style="height: 78px"></textarea>
					</td>
					<td rowspan="7">
						<br/>
						6 meses:
						<br/>
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="lm" />
						DTaP(3)
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="cereal" />
						Hib(3) 
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="verduras" />
						IPV(3)
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="verduras" />
						Heo B(3)
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="verduras" />
						Neumococo(3)
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="verduras" />
						Rotavirus(3)
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="verduras" />
						Neumococo(1) (2)
						<br/>
						<br/>
						12 meses:
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="verduras" />
						MMR
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="verduras" />
						Varicela
						Despistaje 9 meses:
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="verduras" />
						Hgb & Hto
						<br /><label>&nbsp;</label>
						<input type="checkbox" name="verduras" />
						Dentista (12 meses)
					</td>
				</tr>
			</table>
		</div>

		<div id="wrapper_general3">
			<legend>Crecimiento y Desarrollo:</legend>
			<table width="100%" height="121" border="0" align="center">
				<tr>
					<td>EG: </td>
					<td colspan="7"><textarea name="nota" id="celdaninosano" style="height: 78px"></textarea></td>
				</tr>
				<tr>
					<td>Plan: </td>
					<td colspan="7"><textarea name="nota" id="celdaninosano" style="height: 78px"></textarea></td>
				</tr>
				<tr>
					<td>Comentario: </td>
					<td colspan="7"><textarea name="nota" id="celdaninosano" style="height: 78px"></textarea></td>
				</tr>
			</table>
		</div>
	</form>
	<div id="Div_botones" style="width:100%;height:30px ;float: left">
		<a href='javascript:;' onclick="javascript:darxAtencionCompletada();"><img id="btnAtencionCompletada" src='../../../../medifacil_front/imagen/btn/btn_darPorAtendido.gif' title='Atención Completada' alt=""/></a>
		<a href='javascript:;' onclick="javascript:cancelarAtencionMedica();"><img id="btncancelarActoMedico" src='../../../../medifacil_front/imagen/btn/b_cancelar_on.gif' title='Cancelar' alt=""/></a>
		<a href='javascript:;' onclick="javascript:regresarAgendaMedica();"><img id="btnregresarActoMedico" src='../../../../medifacil_front/imagen/btn/b_regresar_on.gif' title='Regresar' alt=""/></a>
	</div>
	<input type="hidden" id="hNumeroDiagnostico" name="hNumeroDiagnostico" value="0" />
</div>
<!--</div> //fin del Div_cuerpoHC-->