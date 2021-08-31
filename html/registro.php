<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Jeffry Gmail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="examen.css">
</head>
<header><h1 class="display-4 p-3">Registrate</h1></header>
<body class="body">
	<form class="p-4" method="post" onsubmit="return validarRegistro(this)" id="formulario">
		<div class="form-group col-md-6 mt-2">
			<label>Nombre</label>
			<input type="text" class="form-control mt-2"
			placeholder="Por favor ingrese un nombre" id="nombre" name="nombre">
		</div>
		<div class="form-group col-md-6 mt-2">
			<label>Apellido</label>
			<input type="text" class="form-control mt-2"
			placeholder="Por favor ingrese un apellido" id="apellido" name="apellido">
		</div>
		<div class="form-group col-md-6 mt-2">
			<label>Correo</label>
			<input type="text" class="form-control mt-2" 
			placeholder="Por favor ingrese un correo" id="correo" name="correo">
		</div>
		<div class="form-group col-md-6 mt-2">
			<label  class="mb-2">Genero</label>
			<?php 
				include "conexion.php";
				$conexion = conectar();

				$consultarGenero = "SELECT * FROM genero";
				$ejecutar = mysqli_query($conexion, $consultarGenero);

            ?>
			<select class="form-select" name="genero">
				<?php foreach ($ejecutar as $key):?>
				<option value="<?php echo $key['descripcion'] ?>"><?php echo $key['descripcion'] ?></option>
			    <?php endforeach ?>
			</select>
        </div>
		<div class="form-group col-md-6">
			<label class="mb-2 mt-2">Pais</label>
			<?php 

				$consultarPais = "SELECT * FROM pais";
				$ejecutar = mysqli_query($conexion, $consultarPais);

            ?>
			<select name="pais" class="form-select">
				<?php foreach ($ejecutar as $opcion):?>
				<option value="<?php echo $opcion['descripcion'] ?>"><?php echo $opcion['descripcion'] ?></option>
			    <?php endforeach?>
			</select>
		</div>
		<div class="form-group col-md-6">
			<label class="mb-2 mt-2">Tipo de Usuario</label>
			<?php 

				$consultarTipoPersona = "SELECT * FROM tipopersona";
				$ejecucion = mysqli_query($conexion, $consultarTipoPersona);

            ?>
			<select name="tipoPersona" class="form-select">
				<?php foreach ($ejecucion as $opcionTipo):?>
				<option value="<?php echo $opcionTipo['descripcion'] ?>"><?php echo $opcionTipo['descripcion'] ?></option>
			    <?php endforeach?>
			</select>
		</div>

		
		<div class="form-group col-md-6 mt-2">
			<label>Contraseña</label>
			<input type="password" class="form-control mt-2"
			placeholder="Por favor ingrese una Contraseña" id="contrasena" name="contrasena">
		</div>
		<div class="form-group col-md-6 mt-2">
			<label>Repetir Contraseña</label>
			<input type="password" class="form-control mt-2"
			placeholder="Por favor Repita su Contraseña" id="repiteContrasena" name="repiteContrasena">
		</div>
		<button class="btn btn-primary mt-3" type="submit" name="registrar">Registrarse</button>
	</form>

<a href="http://localhost/examen/"><button class="btn btn-success p-1 m-3 mt-0 ms-4">Volver a inicio de sesión</button></a>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="examen.js"></script>
</body>
<?php   

	if (isset($_POST['registrar'])) 
	{
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$correo = $_POST['correo'];
		$genero = $_POST['genero'];
		$pais = $_POST['pais'];
		$tipoPersona = $_POST['tipoPersona'];
		$contrasena = md5($_POST['contrasena']);
		

		if ($tipoPersona == 'administrador') 
		{

			?>
			<script>
			(async()=>{
				const {value:password} = await Swal.fire({
					title: 'Contraseña',
					input: 'password',
					inputLabel: 'Por favor ingrese la contraseña del Administrador',
					inputPlaceholder: 'Por favor ingrese la contraseña',
					inputAttributes: 
				  	{
				    	maxlength: 10,
				    	autocapitalize: 'off',
				    	autocorrect: 'off'
				 	}
				})
				if (password == 'Admin123') 
				{	
				   
				    <?php
				    		$consultaCorreo = "SELECT * FROM personas WHERE correo = '$correo'";
							$ejecutarConsultaCorreo = mysqli_query($conexion, $consultaCorreo);
							$filas = mysqli_num_rows($ejecutarConsultaCorreo);
							if ($filas != 0) 
							{
								?>
										
											Swal.fire({
												title: 'Error',
												text: 'El correo ya existe',
												icon: 'error',
												confirmButtonText: 'Aceptar'
											})
										
								<?php
							}else
							{
								$consultarDatos = "INSERT INTO personas (nombre, apellido, correo, genero, pais, contrasena, tipoPersona) VALUES ('$nombre','$apellido','$correo','$genero','$pais','$contrasena', '$tipoPersona')";
								$ejecutarConsulta = mysqli_query($conexion, $consultarDatos);
								if ($ejecutarConsulta) 
								{
									?>
										
											Swal.fire({
												title: 'Registrado',
												text: 'Usted se ha registrado exitosamente',
												icon: 'success',
												confirmButtonText: 'Aceptar'
											})
										
									<?php
								}else
								{
									?>
										
											Swal.fire({
												title: 'Error',
												text: 'Error al registrarse',
												icon: 'error',
												confirmButtonText: 'Aceptar'
											})
										
									<?php
								}
							}
					?>
					
				}else
				{
					Swal.fire('Contraseña incorrecta');
				}
			})()
		    </script>
		    <?php	
			
		}else
		{	

				    		$consultaCorreo = "SELECT * FROM personas WHERE correo = '$correo'";
							$ejecutarConsultaCorreo = mysqli_query($conexion, $consultaCorreo);
							$filas = mysqli_num_rows($ejecutarConsultaCorreo);
							if ($filas != 0) 
							{
									?>

									<script>	
											Swal.fire({
												title: 'Error',
												text: 'El correo ya existe',
												icon: 'error',
												confirmButtonText: 'Aceptar'
											})
									</script>
									<?php
								
							}else
							{
								$consultarDatos = "INSERT INTO personas (nombre, apellido, correo, genero, pais, contrasena, tipoPersona) VALUES ('$nombre','$apellido','$correo','$genero','$pais','$contrasena', '$tipoPersona')";
								$ejecutarConsulta = mysqli_query($conexion, $consultarDatos);
								if ($ejecutarConsulta) 
								{
									?>
										<script>
										
											Swal.fire({
												title: 'Registrado',
												text: 'Usted se ha registrado exitosamente',
												icon: 'success',
												confirmButtonText: 'Aceptar'
											})
										</script>
									<?php
								}else
								{
									?>
										<script>
											Swal.fire({
												title: 'Error',
												text: 'Error al registrarse',
												icon: 'error',
												confirmButtonText: 'Aceptar'
											})
										</script>
									<?php
								}
							}
					
        }

    }

?>





</html>