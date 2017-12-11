<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
	<title>Registro</title>
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
      <br>

      <form enctype="multipart/form-data" id='fregistro' name='fregistro' action=registrarUsuario.php method="post">

      <table> 
        

        <tr>
          <td><span>Nombre y Apellidos: </span></td>
          <td><input type="text" id="nombre" name="nombre"></td>
        </tr>

        <tr>
          <td><span>Email: </span></td>
          <td><input type="text" id="email" name="email"></td>
        </tr>

        <tr>
          <td><span>Dirección: </span></td>
          <td><input type="text" id="direccion" name="direccion"></td>    
        </tr>


        <tr>
          <td><span>Código Postal: </span></td>
          <td><input type="text" id="codPostal" name="codPostal"></td>    
        </tr>

        <tr>
          <td><span>Número de Cuenta Corriente: </span></td>
          <td><input type="text" id="cuenta" name="cuenta"></td>
        </tr>

        <tr>
          <td><span>Contraseña: </span></td>
          <td><input type="password" id="pass1" name="pass1"></td>
        </tr> 
        
        <tr>
          <td><span>Repetir Contraseña: </span></td>
          <td><input type="password" id="pass2" name="pass2"></td>    
        </tr>



      </table>
      <br>
      <input style="margin-left: 5%; margin-bottom: 2%;" id="rst" type="reset" value="Borrar campos">
      <input id="submit" type="submit" value="Enviar">
    </form>

    </div>



</body>
</html>
