<?php
	//Inicio de la Sesión.
	session_start();

	//Esta asignación es para hacer una prueba.
	$_SESSION["email"] = "email";
?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<title>Buscar Libros</title>
</head>
<body>

	<!-- Este form devuelve siempre false porque solo es usado para el serialize() de la función de búsqueda-->
	<form id="busqueda" name="busqueda" onsubmit="return false">

		<!-- Texto o fecha a buscar -->
		<input type="text" name="valor" id="valor"></input>

		<!-- Selector de tipo de filtro de búsqueda -->
		<select name="filtro" id="filtro">
			<option value="ISBN">ISBN</option>
			<option value="Titulo">Titulo</option>
			<option value="Autor">Autor</option>
			<option value="Genero">Genero</option>
			<option value="Ano">Año</option>
		</select>

		<!-- Botón para efectuar la búsqueda -->
		<input type="button" name="buscar" id="buscar" value="Buscar"></input>
	</form>
	<br/>

	<!-- Aquí se mostrarán los libros encontrados -->
	<div id="libros">

	</div>
	<br/>

	<div id="compra">
		
	</div>

	<script type="text/javascript">

		//Función Ajax para llamar al PHP que busca los libros a partir de un filtro.
		$('#buscar').click( function() {
			$.ajax({
				data: $('#busqueda').serialize(),
				url: 'hacerBusquedaLibros.php',
				type: 'post',
				beforeSend: function () {
					$("#libros").html("Cargando...");
				},
 				success: function (tabla) {
					$("#libros").html(tabla);
				}
			});
		});

		//Función Ajax para llamar al PHP que efectua la compra de un libro.
		function comprar(ISBN) {
			$.ajax({
				data: {ISBN : ISBN, email : <?php echo "'" . $_SESSION["email"] . "'";?>},
				url: 'comprar.php',
				type: 'post',
				beforeSend: function () {
					$("#compra").html("Comprando...");
				},
 				success: function (response) {
					$("#compra").html(response);
				}
			});
		};

	</script>
</body>
</html>