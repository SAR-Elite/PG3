<?php		
	session_start ();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Inicio</title>
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


			<span><a href='logout.php'>Logout</a></span>



    </header>
	<nav class='main' id='n1' role='navigation'>

		<?php
		

		if(isset($_SESSION['id'],$_SESSION['admin'])){

			echo"<span><a href='inicio.php'>Inicio</a></span>";
			echo"<span><a href='anadir_libro.php'>Añadir libro</a></span>";
			echo"<span><a href='lista_libros.php'>Lista de libros</a></span>";
			echo"<span><a href=''>Información</a></span>";
		
		} 
		
		else{

			echo"<span><a href='inicio.php'>Inicio</a></span>";
			echo"<span><a href='lista_libros.php'>Lista de libros</a></span>";
			echo"<span><a href='perfil.php'>Perfil</a></span>";
			echo"<span><a href=''>Información</a></span>";


		}


		?>

	</nav>
    <section class="main" id="s1">
    
	<div style="float: left; position: relative; top:20%; left: 30%;">
		<input type="text" name="buscador" placeholder="Buscador"> 

	</div>
    </section>
	<footer class='main' id='f1'>

	</footer>
</div>
</body>
</html>