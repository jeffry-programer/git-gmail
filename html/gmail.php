<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Inicio de Sesión</title>
	<link rel="stylesheet" href="examen.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

</head>
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

	?>
<body>
	
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="examen.js"></script>
<script>
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timerProgressBar: true,
		timer: 5000,

		didOpen : (toast) => {
			toast.addEventListener('mouseenter',Swal.stopTimer);
			toast.addEventListener('mouseleave',Swal.resumeTimer);
		}
	})
	Toast.fire({
		icon: 'success',
		title: 'Usted ha ingresado correctamente'
	})
</script>
</body>
<?php  
	

    $consultaTipoPersona = "SELECT * FROM usuario WHERE tipoPersona = 'Administrador'";
    $ejecutarConsulta = mysqli_query($conexion,$consultaTipoPersona);
    $filas = mysqli_num_rows($ejecutarConsulta);
    if ($filas != 0) {
    	?>	
    		<h1 class="display-4 p-3">Bievendo a JeffryGmail</h1>
			<div class="dropdown">
			<button class="dropdown-toggle btn btn-primary m-3" type="button" aria-expended="false" data-bs-toggle="dropdown" id="boton">Opciones de Gmail</button>
			<ul class="dropdown-menu" aria-labelledby= "boton">
			<a href="http://localhost/examen/enviar.php"><li class="dropdown-item">Enviar mensaje</li></a>
			<a href="http://localhost/examen/recibir.php"><li class="dropdown-item">Revisar bandeja de entrada</li></a>
			<a href="http://localhost/examen/administracion.php"><li class="dropdown-item">Administrar Gmail</li></a>
			</ul>
			</div>

			<form enctype="multipart/form-data" action="uploader.php" method="post" class="col-md-4 p-3">
			<label class="mb-2">Ingrese una imagen</label>
			<input type="text" placeholder="Por favor ingrese el nombre de la imagen" class="form-control mb-3" name="nombreImagen">
			<label class="mb-2">Seleccione la imagen</label>
			<input name="imagen" type="file" class="form-control"/>
			<input type="submit" value="Subir archivo" class="btn btn-primary mt-3"/>
			</form>

			<form method="post">
			<div class="form-group col-md-6">
			<button name="close" class="btn btn-primary mt-3 ms-3" type="submit">Cerrar Sesión</button>
			</div>
    		</form>
    		<form method="post">
    			<button name="mostrar" class="btn btn-primary m-3" >Mostrar imagenes del servidor</button>
    		</form>

    	<?php
    }else
    {	
    	?>
    		<h1 class="display-4 p-3">Bievendo a JeffryGmail</h1>
			<div class="dropdown">
			<button class="dropdown-toggle btn btn-primary m-3" type="button" aria-expended="false" data-bs-toggle="dropdown" id="boton">Opciones de Gmail</button>
			<ul class="dropdown-menu" aria-labelledby= "boton">
				<a href="http://localhost/examen/enviar.php"><li class="dropdown-item">Enviar mensaje</li></a>
				<a href="http://localhost/examen/recibir.php"><li class="dropdown-item">Revisar bandeja de entrada</li></a>
			</ul>
			</div>
	
			<form method="post">
			<div class="form-group col-md-6">
			<button name="close" class="btn btn-primary ms-3" type="submit">Cerrar Sesión</button>
			</div>
    		</form>
    	<?php
    }
 	

	if(isset($_POST['close'])) 
	{
		$consulta = "DELETE FROM usuario";
		$ejecutar = mysqli_query($conexion, $consulta);
		header("location:http://localhost/examen");
	}
	if (isset($_POST['mostrar'])) 
	{
		$consultaDeImagenes = "SELECT * FROM imagenes";
		$ejecutarConsultaDeImagenes = mysqli_query($conexion,$consultaDeImagenes);
		?>
			<?php foreach ($ejecutarConsultaDeImagenes as $value): ?>
			<div class="m-3">
				<img src="<?php echo $value['imagen'] ?>" style= "width: 300px; height: 300px;">
			</div>
			<?php endforeach ?>
		<?php  
	}

?>

</html>