<?php
    session_start();
?>
<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
	<title>Añadir Libro</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
  	  <form enctype="multipart/form-data" style="float: left" id='flibro' name='flibro' action=guardarLibro.php method="post" onsubmit=" return isValidISBN()">

      <table> 
        

        <table> 
          <tr>
            <td><span>ISBN: </span></td>
            <td><input type="text" id="isbn" name="isbn"></td>
          </tr>
          <tr>
            <td><span>Titulo: </span></td>
              <td><input type="text" id="titulo" name="titulo"></td>
          </tr>
          <tr>
            <td><span>Autor: </span></td>
            <td><input type="text" id="aut" name="aut"></td>
          </tr>
          <tr>
            <td><span>Genero: </span></td>
            <td><input type="text" id="gen"  name="gen"></td>
          </tr>
          <tr>
            <td><span>Año: </span></td>
            <td><input type="number" id="ano"  name="ano"></td>
          </tr>
          <tr>
            <td><span>Precio: </span></td>
            <td><input type="number" id="precio"  name="precio"></td>
          </tr>
          <tr>
            <td><span>Sinopsis: </span></td>
            <td><textarea rows="4" cols="50" name="sinop" form="flibro"></textarea></td>
          </tr>
          <tr>
            <td><span>Portada: </span></td>
            <td><input type="file" id="imagen" name="imagen" accept="image/*"></td>
          </tr>

            </table>
        <br>
      	<input style="margin-left: 5%; margin-bottom: 2%;" id="rst" type="reset" value="Borrar campos">
     	  <input id="submit" type="submit" value="Enviar">

    </form>


  </div>

	<script type="text/javascript">

		//Función que valida un ISBN, creditos a https://neilang.com/articles/how-to-check-if-an-isbn-is-valid-in-javascript/.
		function isValidISBN () {

      var ISBN = $('#isbn').val();
			ISBN = ISBN.replace(/[^\dX]/gi, '');
			if(ISBN.length != 10){
        alert("El ISBN no es valida");
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

      if(!((sum % 11) == 0)){
          alert("El ISBN no es valida");
      }
			return ((sum % 11) == 0);
		}

	</script>


</body>
</html>
