<?php
session_start();
?>

<!DOCTYPE html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="utf-8">
	<title>Login</title>
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
      <form enctype="multipart/form-data" id='login' name='login' action=login.php method="post">

      <table> 
        
        <tr>
          <td><span>Email: </span></td>
            <td><input type="text" id="email" name="email"></td>

        </tr>
        <tr>
          <td><span>Password: </span></td>
          <td><input type="password" id="pass" name="pass"> </td>
        </tr> 

      </table>

      <br>

		<input style="margin-left: 1%; margin-bottom: 2%;" id="rst" type="reset" value="Borrar campos"></td>
        <input  id="submit" type="submit" value="Iniciar sesión"></td>
        

    </form>

    <?php


        if(isset($_POST['email'],$_POST['pass'])){
            
            $id=login($_POST['email'],$_POST['pass']);

            if($id!=-1){

              if($id==0){ //Si el usuario se esta identificando como admin
                $_SESSION["admin"]='SI';  
              }   
              $_SESSION["id"]=$id;
              header ("Location: inicio.php");            }
            else{
             	echo "<script type=\"text/javascript\">alert(\"Correo o contraseña incorrectas.\");</script>";
            }
        }

        function login($email,$pass){
          $usuarios = simplexml_load_file('usuarios.xml');
          foreach ($usuarios->usuario as $usuario) {
            if($email == $usuario->email){
              if($pass == $usuario->contraseña){                
                return (int) $usuario['id'];
              }
              return -1;
            }
          }
          return -1;
        } 


    ?>

    </div>



</body>
</html>
