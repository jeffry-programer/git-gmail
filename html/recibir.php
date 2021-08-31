<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Bandeja de entrada</title>
	<link rel="stylesheet" href="examen.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/bootstrap.css">

</head>
<body>
	<h1 class="display-4 p-3">JeffryGmail</h1>
	<h1 class="ms-4">Bandeja de entrada</h1>
	<a href="http://localhost/examen/gmail.php"><button class="btn btn-primary m-4">Volver</button></a>
	
	
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="examen.js"></script>
</body>
<?php  
	include "conexion.php";
	$conexion = conectar();
	$consultaCorreo = "SELECT * FROM usuario";
	$correoConsulta = mysqli_query($conexion, $consultaCorreo);
	foreach ($correoConsulta as $key):
	$correo = $key['correo'];
	endforeach;

	$consultaMensajes = "SELECT * FROM mensajes WHERE destino = '$correo'";
	$ejecutarConsultaMensaje = mysqli_query($conexion, $consultaMensajes);
	$filas = mysqli_num_rows($ejecutarConsultaMensaje);
	if ($filas != 0) 
	{	
		?>
		<?php   foreach ($ejecutarConsultaMensaje as $key): ?>
		<div class="form-group col-md-6 p-2 m-2">
			<div class="form-control p-3">
				<?php
				    ?><div class="p-2 negrita"><?php echo "Asunto:";?></div>
			        <div class="p-2"><?php echo $key['asunto'];?></div>
			 	    <?php
			 	    ?><div class="p-2 negrita"><?php echo "Mensaje:";?></div>
			        <div class="p-2"><?php echo $key['descripcion'];?></div>
			        <div class="p-2 negrita"> <?php echo "correo de:";?></div>
					<div class="p-2"><?php echo $key['deParte'];?></div> 
					<a href="http://localhost/examen/enviar.php?correo=<?php echo $key['deParte'];?>"><button class="btn btn-primary m-2" type="button">Responder</button></a>
					<a href="http://localhost/examen/enviar.php?mensaje=<?php echo $key['descripcion'];?>"><button class="btn btn-primary m-2" type="button">Reenviar</button></a>
			    
			</div>
		</div>
		<?php endforeach; 

	}else
	{
		?>
			<script>
				Swal.fire({
				title: 'No hay mensajes',
				icon: 'info',
				confirmButtonText: 'Aceptar'
			    })
	        </script>
		<?php
	}
	
?>

</html>