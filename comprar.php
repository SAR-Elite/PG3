<?php
	sleep(1);

	//TODO: Añadir en el XML usuarios.xml el libro con el ISBN correspondiente al usuario con el id correspondiente.

	$xml = simplexml_load_file('usuarios.xml');

	foreach ($xml->usuario as $usuario) {

		if ((string) $usuario['id'] == $_POST["id"]) {
			echo "El usuario " . (string) $usuario->nombre . " ha comprado el libro con ISBN " . $_POST['ISBN'];
			$libro = $usuario->libros->addChild('libro');
			$libro->addAttribute('ISBN', $_POST['ISBN']);

			$xml->asXML('usuarios.xml');
		}
	}
?>