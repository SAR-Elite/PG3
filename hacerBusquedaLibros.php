<?php
	//Inicio de la Sesión.
	session_start();

	//Conexión a la BD.
	$link = mysqli_connect("localhost", "root", "", "sar");

	//Consulta a la BD, dependiendo del filtro elegido.
	switch ($_POST["filtro"])  {
		case "ISBN":
			$libros = mysqli_query($link, "SELECT * FROM libros WHERE ISBN = '" . $_POST["valor"] . "'");
			break;
		case "Titulo":
			$libros = mysqli_query($link, "SELECT * FROM libros WHERE Titulo = '" . $_POST["valor"] . "'");
			break;
		case "Autor":
			$libros = mysqli_query($link, "SELECT * FROM libros WHERE Autor = '" . $_POST["valor"] . "'");
			break;
		case "Genero":
			$libros = mysqli_query($link, "SELECT * FROM libros WHERE Genero = '" . $_POST["valor"] . "'");
			break;
		case "Ano":
			$libros = mysqli_query($link, "SELECT * FROM libros WHERE Ano = '" . $_POST["valor"] . "'");
			break;
	}

	//Comprobación de que la lista no esta vacía.
	if (mysqli_num_rows($libros) == 0) {
		echo "Ningún libro encontrado con esas características.";
	} else {

		//Creación de la lista de libros solicitada.
		echo "<table> <tr> <th>ISBN</th> <th>Título</th> <th>Autor</th> <th>Género</th> <th>Año</th>";

		//En el caso de estar autentificado.
		if (isset($_SESSION["email"])) echo "<th>Comprar</th>";

		echo "</tr>";

		while ($fila = mysqli_fetch_array( $libros )) {
			echo "<tr>";

			echo "<td>" . $fila["ISBN"] . "</td>";
			echo "<td>" . $fila["Titulo"] . "</td>";
			echo "<td>" . $fila["Autor"] . "</td>";
			echo "<td>" . $fila["Genero"] . "</td>";
			echo "<td>" . $fila["Ano"] . "</td>";

			//En el caso de estar autentificado.
			if (isset($_SESSION["email"])) echo "<td> <input type='button' value='comprar' onclick='comprar(" . $fila["ISBN"] . ")'> </input>  </td>"; 

			echo "</tr>";
		}

		echo "</table>";

	}
?>