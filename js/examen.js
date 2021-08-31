function validarRegistro(formulario)
{
	var nombre = formulario.nombre.value;
	var apellido = formulario.apellido.value;
	var correo = formulario.correo.value;
	var contrasena = formulario.contrasena.value;
	var repiteContrasena = formulario.repiteContrasena.value;

	if (nombre == '') 
	{
		Swal.fire({
			title: 'Error',
			text: 'Por favor ingrese un nombre',
			icon: 'error',
			confirmButtonText:'Aceptar'
		})
		return false;
	}

	if (apellido == '') 
	{
		Swal.fire({
			title: 'Error',
			text: 'Por favor ingrese un apellido',
			icon: 'error',
			confirmButtonText:'Aceptar'
		})
		return false;
	}

	if (correo == '') 
	{
		Swal.fire({
			title: 'Error',
			text: 'Por favor ingrese un correo',
			icon: 'error',
			confirmButtonText:'Aceptar'
		})
		return false;
	}

	if (contrasena == '') 
	{
		Swal.fire({
			title: 'Error',
			text: 'Por favor ingrese un contraseña',
			icon: 'error',
			confirmButtonText:'Aceptar'
		})
		return false;
	}

	if (repiteContrasena == '') 
	{
		Swal.fire({
			title: 'Error',
			text: 'Por favor repita su contraseña',
			icon: 'error',
			confirmButtonText:'Aceptar'
		})
		return false;
	}
	if (repiteContrasena != contrasena) 
	{
		Swal.fire({
			title: 'Error',
			text: 'Las contraseñas deben ser iguales',
			icon: 'error',
			confirmButtonText:'Aceptar'
		})
		return false;
	}

	return true;
}