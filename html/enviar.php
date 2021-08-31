<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Enviar Mensaje</title>
	<link rel="stylesheet" href="examen.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/bootstrap.css">

</head>
<body>
	<h1 class="display-4 p-3">JeffryGmail</h1>
	<form action="" method="post" onsubmit="return validarMensaje(this)" id="formulario">

		<div class="form-group col-md-6 mt-2">
			<label  class="mb-2 ms-4">Para</label>
			<?php 
				include "conexion.php";
				$conexion = conectar();

				$consultar = "SELECT * FROM personas";
				$ejecutar = mysqli_query($conexion, $consultar);
				
				if (!empty($_GET['correo'])) 
				{
					$responderUsuario = $_GET['correo'];
					?>

					<select class="form-select ms-4 mb-3" name="destino">
					<option value="<?php echo $responderUsuario ?>"><?php echo $responderUsuario ?></option>
					</select>

					<?php
				}else
				{
					?>

						<select class="form-select ms-4 mb-3" name="destino">
						<?php foreach ($ejecutar as $key):?>
						<option value="<?php echo $key['correo'] ?>"><?php echo $key['correo'] ?></option>
					    <?php endforeach ?>
						</select>


					<?php


				}
				if (!empty($_GET['mensaje']))
				{
					$mensaje = $_GET['mensaje'];
					?>
					</div>
     			   	<div class="form-group col-md-6">
					<textarea class="form-control m-4" placeholder="Asunto" name="asunto" id="asunto"></textarea>
					</div>
					<div class="form-group col-md-6">
					<textarea class="form-control m-4" placeholder="Escribe tu mensaje" name="mensaje" id="mensaje"><?php echo $mensaje ?></textarea>
					</div>
					<?php 
				}else
				{
					?>
					</div>
     			   	<div class="form-group col-md-6">
					<textarea class="form-control m-4" placeholder="Asunto" name="asunto" id="asunto"></textarea>
					</div>
					<div class="form-group col-md-6">
					<textarea class="form-control m-4" placeholder="Escribe tu mensaje" name="mensaje" id="mensaje"></textarea>
					</div>
					<?php 
				}
            ?>
              
			
	<button class="btn btn-primary ms-4" type="submit" name="enviar">Enviar</button>
    </form>
  	<a href="http://localhost/examen/gmail.php"><button class="btn btn-primary m-4">Volver</button></a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="examen.js"></script>
</body>
<?php  
	if (isset($_POST['enviar'])) {
		$mensaje = $_POST['mensaje'];
		$destino = $_POST['destino'];
		$asunto = $_POST['asunto'];
		$consultaCorreo = "SELECT * FROM usuario";
		$correoConsulta = mysqli_query($conexion, $consultaCorreo);
		foreach ($correoConsulta as $key):
		$correo = $key['correo'];
		endforeach;

		$registrarMensaje = "INSERT INTO mensajes (descripcion,destino,deParte,asunto) VALUES ('$mensaje','$destino','$correo','$asunto')";
		$ejecutarRegistroMensajes = mysqli_query($conexion, $registrarMensaje);


		if ($ejecutarRegistroMensajes) {
			?>
					<script>
						Swal.fire({
							title: 'Mensaje Enviado',
							text: 'El mensaje fue enviado exitosamente',
							icon: 'success',
							confirmButtonText: 'Aceptar'
						})
					</script>
			<?php
		}

	}

?>

</html>