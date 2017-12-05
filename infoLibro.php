<?php
	//Inicio de la Sesión.
	session_start();

	$link = mysqli_connect("localhost", "root", "admin", "sar");
	$libros = mysqli_query($link, "SELECT * FROM libros WHERE ISBN = '" . $_GET["isbn"] . "'");
?>

<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<title>Informacion del Libro</title>
</head>
<body>

	<?php
		if (mysqli_num_rows($libros) == 0) {
			echo "Libro no encontrado, <a href='buscarLibros.php'> busca otro </a>";
			return;
		} else if (mysqli_num_rows($libros) > 1) {
			echo "Ha ocurrido un error, <a href='buscarLibros.php'> busca otro </a>";
			return;
		} else {
			$libro = mysqli_fetch_array( $libros );
		}
	?>

	<div id="main">
		<ul>
			<li>ISBN: <?php echo $libro["ISBN"]; ?></li>
			<li>Título: <?php echo $libro["Titulo"]; ?></li>
			<li>Autor: <?php echo $libro["Autor"]; ?></li>
			<li>Género: <?php echo $libro["Genero"]; ?></li>
			<li>Año: <?php echo $libro["Ano"]; ?></li>
			<li>Precio: <?php echo $libro["Precio"]; ?>€</li>
		</ul>

		<?php
			if (isset($_SESSION["id"])) {
				echo "<input type='button' value='Comprar' onclick='comprar(" . $libro["ISBN"] . ")'> </input>";
			}
		?>
	</div>
	<br/>

	<div id="compra">
		
	</div>

	<script>
		function comprar(ISBN) {

			$.ajax({
				data: {ISBN : ISBN, id : <?php echo "'" . $_SESSION["id"] . "'";?>},
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