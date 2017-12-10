<?php

	if(isset(
		$_POST['nombre'],
		$_POST['email'],
		$_POST['pass1'],
		$_POST['pass2'],
		$_POST['direccion'],
		$_POST['codPostal'],
		$_POST['cuenta']
		)
		){

		$error =validarRegistro(
		$_POST['nombre'],
		$_POST['email'],
		$_POST['pass1'],
		$_POST['pass2'],
		$_POST['direccion'],
		$_POST['codPostal'],
		$_POST['cuenta']);

		if($error!=""){
			echo $error;
		}
		else{
			guardarUsuario(
			$_POST['nombre'],
			$_POST['email'],
			$_POST['pass1'],
			$_POST['direccion'],
			$_POST['codPostal'],
			$_POST['cuenta']
				);
			echo "Se ha registrado el usuario correctamente";
		}

	}
	else{
		echo'Error al recibir los datos';
	}

	function validarRegistro($nombre,$email,$pass1,$pass2,$direccion,$codPostal,$cuenta){
		$error= "";
		$erMail = '/^[a-zA-Z0-9]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/';

		if($nombre==""||$email==""||$pass1==""||$pass2==""||$direccion==""||$codPostal==""||$cuenta==""){
			$error="No se permiten campos vacios";
		}


		//Validación del email mediante una expresión regular
		
		elseif(!preg_match($erMail,$email)){
			$error="El email introducido no es válido";
		}
		//Comprabar que las contraseñas son iguales
		elseif($pass1!=$pass2){
			$error="Las contraseñas no coinciden";	
		}
		//Comprobar que la longitud del codigo postal es 5
		elseif(strlen($codPostal)!=5){
			$error="El codigo postal no es válido";
		}

		//Verificar que no existe un usario con el mismo mail
		$error=comprobarEmail($email);


		return $error;

	}


	function comprobarEmail($email){
		$usuarios = simplexml_load_file('usuarios.xml');
		foreach ($usuarios->usuario as $usuario) {
			if($email == $usuario->email){
					return 'Ya existe un usuario registrado con el mismo email';
				}
		}
		return '';
	}

	function guardarUsuario($nombre,$email,$pass,$direccion,$codPostal,$cuenta){
			$usuarios = simplexml_load_file('usuarios.xml');
			//Calcular el identificador
			$ultID = (int) $usuarios['ult_id'];
			$cantidad = (int) $usuarios['cantidad'];
			$ultID++;
			$cantidad++;
			$usuarios['ult_id'] = $ultID;
			$usuarios['cantidad'] = $cantidad;

			//Añadir usuario al xml
			$nuevoUsuario = $usuarios->addChild('usuario');
			$nuevoUsuario->addAttribute('id',$ultID);
			$nuevoUsuario->addChild('nombre',$nombre);
			$nuevoUsuario->addChild('email',$email);
			$nuevoUsuario->addChild('contraseña',$pass);
			$nuevoUsuario->addChild('direccion',$direccion);
			$nuevoUsuario->addChild('codPostal',$codPostal);
			$nuevoUsuario->addChild('cuenta',$cuenta);
			$nuevoUsuario->addChild('libros');

			$usuarios->asXML('usuarios.xml');

	}


?>