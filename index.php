<?php

require_once("clases/empleado.php");
$tituloVentana = "Fabrica - con archivos, AJAX, JQUERY y JSON -";
?>
<html>
<head>
	<title> <?php echo $tituloVentana; ?> </title>
	  
		<!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script type="text/javascript" src="./JavaScript/funciones.js"></script>
		
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<div class="container">
		<div class="page-header">
			<h1>PRODUCTOS</h1>      
		</div>
		<div class="CajaInicio" style="width:1100px">
			<h1>Ingresar datos de empleados </h1>
			<table>
				<tbody>
					<tr>
						<td width="50%"><h1>Alta de empleados </h1>
							<div id="divFrm" style="">
						

						Legajo<input type="text" placeholder="ingrese legajo"  name="legajo" id="legajo" ><br/>
						Nombre   <input type="text"  placeholder="ingrese nombre" name="nombre"   id= "nombre"><br/>
				        Apellido <input type="text"  placeholder="ingrese apellido" name="apellido" id= "apellido" ><br>
               <!--  /* DNi    <input type="text"  placeholder="ingrese dni"    name="dni" >-->
                           Sexo <br><input type="radio" name="rdoSexo" id="rdoSexo" value="Femenino"  checked />Femenino<br/><br>
                             <input type="radio" name="rdoSexo" id="rdoSexo" value="Masculino" checked />Masculino<br/><br>
                            Foto <input type="file" name="archivo" id="archivo" onchange="SubirFoto()" /> 
								<input type="button" class="MiBotonUTN" onclick="AgregarEmpleado()" value="Guardar"  />
								<input type="hidden" id="hdnQueHago" value="agregar" />
							</div>
						</td>
				<td rowspan="1">
							<div id="divGrilla" style="height:610px;overflow:auto;border-style:solid">
							
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div id="divFoto" style="height:350px;overflow:auto">
							
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>