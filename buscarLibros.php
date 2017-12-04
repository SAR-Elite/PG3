<?php
	session_start();
	$_SESSION["email"] = "email";
?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<title>Buscar Libros</title>
</head>
<body>

	<form id="busqueda" name="busqueda">
		<input type="text" name="valor" id="valor"></input>
		<select name="filtro" id="filtro">
			<option value="ISBN">ISBN</option>
			<option value="Titulo">Titulo</option>
			<option value="Autor">Autor</option>
			<option value="Genero">Genero</option>
			<option value="Ano">Año</option>
		</select>
		<input type="button" name="buscar" id="buscar" value="Buscar"></input>
	</form>

	<div id="libros">
		
	</div>

	<div id="compra">
		
	</div>

	<script type="text/javascript">

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

		function comprar(ISBN) {
			$.ajax({
				data: {ISBN : ISBN, usuario : <?php echo "'" . $_SESSION["email"] . "'";?>},
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