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
<body>
	<?php 
		include "conexion.php";
		$conexion = conectar();
		$consultarSesionUsuario = "SELECT * FROM usuario";
		$ejecutarconsultarSesion = mysqli_query($conexion,$consultarSesionUsuario);
		$filas = mysqli_num_rows($ejecutarconsultarSesion);

		if ($filas == 0) 
		{
			header("location:http://localhost/examen/");
		}
		/*if (empty($_GET['id'])) 
		{
		header("location:http://localhost/examen/administracion.php");
		}
		
		$idUser = $_GET['id'];

		$mostrarPaisActual = "SELECT * FROM pais WHERE idPais = $idUser";
		$result = mysqli_query($conexion, $mostrarPaisActual); */
	?>
	<h1 class="display-4 p-3">Agregar Pais</h1>
	<form class="p-4" method="post" onsubmit="return validarRegistro(this)" id="formulario">
		<div class="form-group col-md-6 mt-2">
			<label>Id</label>
			<input type="text" class="form-control mt-2"
			placeholder="Por favor ingrese un Id" id="nombre" name="nombre">
		</div>
		<div class="form-group col-md-6 mt-2">
			<label>Pais</label>
			<input type="text" class="form-control mt-2"
			placeholder="Por favor ingrese un Pais" id="apellido" name="apellido">
		</div>
		
		<button class="btn btn-primary mt-3" type="submit" name="registrar">Agregar</button>
	</form>

<a href="http://localhost/examen/administracion.php"><button class="btn btn-success p-1 m-3 mt-0 ms-4">Volver</button></a>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="examen.js"></script>
</body>
<?php   
	

	

	
	if (isset($_POST['registrar'])) 
	{
		$idPais = $_POST['nombre'];
		$descripcionPais = $_POST['apellido'];

		$insertarDatos = "INSERT INTO pais (idPais,descripcion) VALUES ($idPais,'$descripcionPais')";
		$result = mysqli_query($conexion,$insertarDatos);

		if ($result) 
		{
			?>
				<script>
					Swal.fire({
						title: 'Pais Registrado Exitosamente',
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
						title: 'Error al registrar Pais',
						icon: 'error',
						confirmButtonText: 'Aceptar'
					})
				</script>
			<?php
		}

	}

?>





</html>