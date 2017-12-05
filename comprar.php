<?php
	sleep(1);
	echo "Bien, ISBN: " . str_pad($_POST["ISBN"], 4, '0', STR_PAD_LEFT) . ", Email: " . $_POST["email"];

	//TODO: Añadir en el XML usuarios.xml el libro con el ISBN correspondiente al usuario con el email correspondiente.
?>