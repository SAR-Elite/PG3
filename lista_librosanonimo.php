<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Lista de libros</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<h2>TIENDA DE LIBROS</h2>
		<span style="float:right;"><a href='registro.html'>Registro</a></spam>/
		<span ><a href='login.php'>Login</a></spam>
    </header>
	<nav class='main' id='n1' role='navigation'>


		<span><a href='inicioanonimo.html'>Inicio</a></span>
		<span><a href='lista_librosanonimo.php'>Lista de libros</a></span>
		<span><a href=''>Información</a></span>




	</nav>
    <section class="main" id="s1">
    
    	<?php

			//Contectar con la base de datos 

			$link = mysqli_connect("localhost", "root", "", "libros");
			if (!$link)
			{
			 echo "Fallo al conectar a MySQL: " . $link->connect_error;
			}

			//Insertar los datos
			$libro=mysqli_query($link, "SELECT * FROM libro");

			//Error al consultar
			if (!$libro)
			 { 	
				die('Error: ' . mysqli_error($link));
				echo "No se ha podido insertar";
			 }

			 //Crear la tabla

			 echo '<table border=1> <tr> <th> ISBN </th> <th> TITULO </th><th> AUTOR </th> <th> CATEGORIA </th> <th> FECHA </th> <th> PORTADA</th></tr>';
				while ($row = mysqli_fetch_array($libro)) {
				echo '<tr><td>' . $row["ISBN"] . '</td> <td>' . $row["TITULO"] .'</td> <td>' . $row["AUTOR"] .'</td> <td>' . $row["CATEGORIA"] .'</td> <td>' . $row["FECHA"] .'</td>
				 <td>	

				 	<img style="width:50px;height:50px;float: left; border:2px solid black ; margin-left: 3px" src="data:image/jpeg;base64,'.base64_encode( $row['IMAGEN'] ).'"/>		

				 </td>


				</tr>';
				}
				echo '</table>';

			// Cerrar conexión
			mysqli_close($link);

		?>

    </section>
	<footer class='main' id='f1'>

	</footer>
</div>

</body>
</html>