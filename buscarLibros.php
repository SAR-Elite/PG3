<?php
	//Inicio de la Sesión.
	session_start();
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
			//Validaciones previas de los datos.
			switch($('#filtro').val())  {

				case "Ano":

					//Comprueba si es un valor numérico.
					if (!$.isNumeric($('#valor').val())) {
						alert("Introduce un valor numérico, p.e. 2017");
						return;
					}

					//Comprobar que el año es de 4 dígitos.
					if ($('#valor').val().length != 4) {
						alert("Introduce un valor de 4 dígitos, p.e. 1917");
						return;
					}
					break;

				case "ISBN":

					//Comprobar si el ISBN es correcto.
					if (!isValidISBN($('#valor').val())) {
						alert("ISBN no valido, comprueba si lo has escrito correctamente.");
						return;
					}
					break;
			}

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
				data: {ISBN : ISBN},
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

		//Función que valida un ISBN, creditos a https://neilang.com/articles/how-to-check-if-an-isbn-is-valid-in-javascript/.
		function isValidISBN (ISBN) {

			ISBN = ISBN.replace(/[^\dX]/gi, '');
			if(ISBN.length != 10){
				return false;
			}

			var chars = ISBN.split('');
			if(chars[9].toUpperCase() == 'X'){
				chars[9] = 10;
			}

			var sum = 0;
			for (var i = 0; i < chars.length; i++) {
				sum += ((10-i) * parseInt(chars[i]));
			}

			return ((sum % 11) == 0);
		}
	</script>
</body>
</html>