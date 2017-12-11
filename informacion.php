<?php   
  session_start ();
?>

<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
	<title>Información</title>
	<link  rel='stylesheet' type='text/css' href='styles/styles.css' />

  </head>
  <body>

  	<img class ="logo" src="img/logo.png">
  	<nav class = "menu">


      <?php

              if(isset($_SESSION['id'],$_SESSION['admin'])){

                echo"<a href='inicio.php'>Inicio</a>";
                echo"<a href='anadir_libro.php'>Añadir libro</a>";
                echo"<a href='lista_libros.php'>Lista de libros</a>";
                echo"<a href='informacion.php'>Información</a>";
                echo"<a href='logout.php'>Logout</a>";
              } 
              
              elseif(isset($_SESSION['id'])){

                echo"<a href='inicio.php'>Inicio</a>";
                echo"<a href='lista_libros.php'>Lista de libros</a>";
                echo"<a href='perfil.php'>Perfil</a>";
                echo"<a href='informacion.php'>Información</a>";
                echo" <a href='logout.php'>Logout</a>";

              }

              else{

                echo"<a href='inicio.php'>Inicio</a>";
                echo"<a href='lista_libros.php'>Lista de libros</a>";
                echo"<a href='informacion.php'>Información</a>";
                echo"<a href='registro.php'>Registro</a>";
                echo"<a href='login.php'>Login</a>";

              }


      ?>



  	</nav>

  	<div class= "container">
  		<!--Aqui se mostrará el contenido de la página-->
      <div>
      <h1>¿QUIENES SOMOS?</h1>
      <p>LibrosOnline, tu mejor tienda de libros. Encuentra el libro que quieras al mejor precio aquí. LibrosOnline tiene el mayor número de referencias de libros en venta y ebooks convirtiéndose en la principal tienda online de libros del país. Sea cual sea tu compra esta es tu tienda.</p>
      </div>
  </div>



</body>
</html>
