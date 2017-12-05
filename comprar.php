<?php
	sleep(1);

	//TODO: Añadir en el XML usuarios.xml el libro con el ISBN correspondiente al usuario con el email correspondiente.

	$xml = simplexml_load_file('usuarios.xml');

	foreach ($xml->usuario as $usuario) {
		
		if ((string) $usuario['id'] == $_POST["email"]) {
			echo (string) $usuario->nombre;
		}
	}
?>