<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Inicio de Sesión</title>
	<link rel="stylesheet" href="examen.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/bootstrap.css">

</head>
<body>
	<h1 class="display-4 p-3">Inicia Sesión</h1>
	<form class="p-4" method="post" onsubmit="return validarLogin(this)" id="formulario">
		<div class="form-group col-md-6 mt-2">
			<label>Correo</label>
			<input type="text" class="form-control mt-2"
			placeholder="Por favor ingrese un correo" id="correo" name="correo">
		</div>
		<div class="form-group col-md-6 mt-2">
			<label>Contraseña</label>
			<input type="password" class="form-control mt-2"
			placeholder="Por favor ingrese una Contraseña" id="contrasena" name="contrasena">
		</div>
		<div class="form-group col-md-6">
			<label class="mb-2 mt-2">Tipo de Usuario</label>
			<?php 
				include "conexion.php";
				$conexion = conectar();
				$consultarTipoPersona = "SELECT * FROM tipopersona";
				$ejecucion = mysqli_query($conexion, $consultarTipoPersona);

            ?>
			<select name="tipoPersona" class="form-select">
				<?php foreach ($ejecucion as $opcionTipo):?>
				<option value="<?php echo $opcionTipo['descripcion'] ?>"><?php echo $opcionTipo['descripcion'] ?></option>
			    <?php endforeach?>
			</select>
		</div>
		<button class="btn btn-primary mt-3" type="submit" name="ingresar">Ingresar</button>
	</form>
		<a href="http://localhost/examen/registro.php"><button class="btn btn-success mt-1 ms-4 ">Registrate</button></a>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="examen.js"></script>
</body>
<?php  
	
	if (isset($_POST['ingresar'])) {
		$correo = $_POST['correo'];
		$contrasena = md5($_POST['contrasena']);
		$tipoPersona = $_POST['tipoPersona'];

		$consultaDb = "SELECT * FROM personas WHERE correo = '$correo' AND contrasena = '$contrasena' AND tipoPersona = '$tipoPersona'";
		$ejecutarConsulta = mysqli_query($conexion, $consultaDb);
		$filas = mysqli_num_rows($ejecutarConsulta);

		if ($filas != 0) 
		{
			$usuarioTemporal = "INSERT INTO usuario (correo,tipoPersona) VALUES ('$correo','$tipoPersona')";
			$ejecutarUsuario = mysqli_query($conexion, $usuarioTemporal);
			header("location:http://localhost/examen/gmail.php");
		}else
		{
			?>
						<script>
							Swal.fire({
								title: 'Error',
								text: 'El correo con el correo y/o la contraseña',
								icon: 'error',
								confirmButtonText: 'Aceptar'
							})
						</script>
			<?php
		}
	}

	

?>
</html>