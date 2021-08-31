<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Subir imagen</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
<a href="http://localhost/examen/gmail.php"><button class="btn btn-primary m-3">Volver</button></a>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>
<?php 
	include "conexion.php";
	$conexion = conectar();

	if(empty($_POST['nombreImagen']) && empty ($_POST['imagen']))
	{
		header('location:http://localhost/examen/gmail.php');
	}else
	{
		$producto = $_REQUEST['nombreImagen'];
		$nombreImg = $_FILES['imagen']['name'];
		$archivo = $_FILES['imagen']['tmp_name'];
		$ruta = 'images';

		$ruta = $ruta."/".$nombreImg;

		move_uploaded_file($archivo,$ruta);

		$query = mysqli_query($conexion,"INSERT INTO imagenes VALUES('','".$producto."','".$ruta."')");
		if ($query) 
		{
			?>
			<script>
				Swal.fire({
					title: 'Subida',
					text: 'Imagen subida exitosamente',
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
					text: 'Error al subir la imagen',
					icon: 'error',
					confirmButtonText: 'Aceptar'
				})
			</script>
			<?php 
		}
	}

		
?>