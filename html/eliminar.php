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


		if (empty($_GET['id'])) 
		{
		header("location:http://localhost/examen/administracion.php");
		}

		$idUser = $_GET['id'];

		$mostrarPaisActual = "SELECT * FROM pais WHERE idPais = $idUser";
		$result = mysqli_query($conexion, $mostrarPaisActual); 
	?>
	<?php foreach ($result as $key): ?>
	<h1 class="display-4 p-3">Eliminar <?php echo $key['descripcion']; ?></h1>
	<?php endforeach ?>
	<h1>¿Seguro que Quieres Eliminar este Pais?</h1>
	<form action="" method="post">
	<a href="http://localhost/examen/administracion.php"><button class="btn btn-success p-2 m-3 mt-3 ms-4" type="button">Volver</button></a>
	<button class="btn btn-danger m-3 p-2" type="submit" name="registrar">Eliminar</button>
	</form>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="examen.js"></script>
</body>
<?php   
	

	

	
	if (isset($_POST['registrar'])) 
	{

		$eliminarPais = "DELETE FROM pais WHERE idPais = $idUser";
		$eliminar = mysqli_query($conexion, $eliminarPais);
		if ($eliminar) {
				?>	
					<script>
						Swal.fire({
							title:'Eliminado exitosamente',
							icon: 'success',
							confirmButtonText: 'Aceptar'
						});
					</script>
				<?php
		}else
		{
			?>
				<script>
					Swal.fire({
						title: 'Error al Eliminar Pais',
						icon: 'error',
						confirmButtonText: 'Aceptar'
					})
				</script>
			<?php
		}
	}

?>





</html>