<?php  
	function conectar(){
		$server = 'localhost';
		$user = 'root';
		$pass = '';
		$db = 'dbgmail';

		$conexion = mysqli_connect($server, $user, $pass, $db);
		if ($conexion) 
		{
			return $conexion;
		}else
		{
			?>
			<script>
				alert('Error al conectar con DB');
			</script>
			<?php
		}
	}

?>