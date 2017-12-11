<?php
    session_start();
?>

<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
	<title>Lista Libros</title>
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
          echo" <a href='logout.php'>Logout</a>";
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
          echo"<a href='registro.html'>Registro</a>";
          echo"<a href='login.php'>Login</a>";

        }


        ?>

        
        
  	</nav>

  	<div class= "container">

      <!--Aqui se mostrará el contenido de la página-->
     
      <?php

        //Contectar con la base de datos 

        $link = mysqli_connect("localhost", "root", "admin", "sar");
        if (!$link)
        {
         echo "Fallo al conectar a MySQL: " . $link->connect_error;
        }

        //Insertar los datos
        $libro=mysqli_query($link, "SELECT * FROM libros");

        //Error al consultar
        if (!$libro)
         {  
          die('Error: ' . mysqli_error($link));
          echo "No se ha podido insertar";
         }

         //Crear la tabla

         echo '<table border=1> <tr> <th> ISBN </th> <th> TITULO </th><th> AUTOR </th> <th> GENERO </th> <th> AÑO </th> <th> PRECIO </th> <th> SINOPSIS </th> </tr>';


          while ($row = mysqli_fetch_array($libro)) {
           echo '<tr> 
          <td>' . $row["ISBN"] . '</td> <td>' . $row["Titulo"] .'</td> <td>' . $row["Autor"] .'</td> <td>' . $row["Genero"] .'</td> <td>' . $row["Ano"] .'</td>  <td>' . $row["Precio"] . '</td> <td>' . $row["Sinopsis"] . '</td></tr>';

          }

          echo '</table>';

        // Cerrar conexión
        mysqli_close($link);

      ?>

    </div>

</body>
</html>