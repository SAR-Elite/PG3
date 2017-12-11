<?php   
  session_start ();
?>

<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
	<title>Inicio</title>

	<link  rel='stylesheet' type='text/css' href='styles/styles.css' />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
      aaa

    </div>

    <script type="text/javascript">
      
      $.ajax({
        url: 'buscarLibros.php',
        type: 'post',
        success: function (data) {
          $(".container").html(data);
        }
      });

    </script>


</body>
</html>