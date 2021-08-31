<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Administracion</title>
	<link rel="stylesheet" href="examen.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
	<body>
	<h1 class="display-4 p-3">JeffryGmail</h1>
	<h1 class="m-2">Administracion de:</h1>
	<form action="" method="post">
		<div class="m-3">
			<a href="#"><button class="btn btn-primary" type="submit" name="administrar">Administrar Paises</button></a>
			<a href="#"><button class="btn btn-primary ms-3" type="submit" name="administrarPersonas">Administrar Personas</button></a>
		</div>
	</form>
	<a href="http://localhost/examen/gmail.php"><button class="btn btn-success p-1 m-3 mt-0 ms-3">Volver</button></a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="examen.js"></script>
</body>
<?php  
	include "conexion.php";
	$conexion = conectar();

	if (isset($_POST['administrar'])) {
		$consulta = "SELECT * FROM pais";
		$ejecutarConsulta = mysqli_query($conexion, $consulta);
		?>
			<form action="" method="post" enctype="multipart/form-data">
			<div class="m-3">
				<table class="table">
				  <thead>
				    <tr>
				      <th scope="col">Id</th>
				      <th scope="col">Pais</th>
				      <th scope="col"><a href="http://localhost/examen/html/agregarPais.php"><button class="btn btn-warning" type="button">Agregar Pais</button></a></th>
				      <th scope="col"></th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php foreach ($ejecutarConsulta as $key ) : ?>
				    <tr>
				      <th scope="row"><?php echo $key['idPais']?></th>
				      <td><?php echo $key['descripcion']?></td>
				      <td><a href="http://localhost/examen/html/editar.php?id=<?php echo $key['idPais'] ?>"><button class="btn btn-primary" type="button" name="modificar" value="<?php echo $key['idPais'] ?>">Modificar</button></a></td>
				      <td><a href="http://localhost/examen/html/eliminar.php?id=<?php echo $key['idPais'] ?>"><button class="btn btn-danger" type="button" name="eliminar" value="<?php echo $key['idPais'] ?>">Eliminar</button></a></td>
				    </tr>
				    <?php endforeach ?>
				  </tbody>
				</table>
			</div>
			</form>
		<?php
	}
	if (isset($_POST['administrarPersonas'])) 
	{
		$consultarPersonas = "SELECT * FROM personas";
		$ejecutarConsultaPersonas = mysqli_query($conexion,$consultarPersonas);
		?>
			<table class="table m-2">
				<thead>
					<tr>
						<th scope="col">Id</th>
						<th scope="col">Nombre</th>
						<th scope="col">Apellido</th>
						<th scope="col">Correo</th>
						<th><a href="http://localhost/examen/html/agregarPersonas.php"><button class="btn btn-warning" type="button">Agregar Persona</button></a></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($ejecutarConsultaPersonas as $keys) :?>
					<tr>
						<th scope="row"><?php echo $keys['idPersonas'] ?></th>
						<td><?php echo $keys['nombre'] ?></td>
						<td><?php echo $keys['apellido'] ?></td>
						<td><?php echo $keys['correo'] ?></td>
						<td><a href="http://localhost/examen/html/editarPersonas.php?id=<?php echo $keys['idPersonas'] ?>"><button class="btn btn-primary"  type="button" name="modificar">Modificar</button></td></a>
						<td><a href="http://localhost/examen/html/eliminarPersona.php?id=<?php echo $keys['idPersonas'] ?>"><button class="btn btn-danger"  type="button" name="eliminar">Eliminar</button></a></td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		<?php
	}
?>
<footer><p class="h6 p-4 m-4">Por favor recuerde que los paises y personas no pueden tener el mismo id ya que si al modificarlos o añadirlos usted coloca el mismo id el proceso va a dar error...De antemano Gracias por preferirnos</p></footer>
</html>  