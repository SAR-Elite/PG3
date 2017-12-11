<?php
session_start();
?>

<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
	<title>Perfil</title>
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
  	 

      <!--Contenedor de los datos del perfil-->
      <fieldset style="border: 1px solid black; margin:1%">
        <legend style="border: 1px solid black; text-align: center; ">Datos</legend>
          <div style="text-align: center;">
          <?php
                $id = $_SESSION['id'];
                $usuarios = simplexml_load_file('usuarios.xml');
                //Buscamos el usuario en el xml
                foreach ($usuarios->usuario as $usuario) {
                   if ($usuario['id'] == $id) {
                      $usuarioActual = $usuario;
                      colocarDatos($usuario->nombre,$usuario->email,$usuario->direccion,$usuario->cuenta);
                 }
               }

               
          ?>
        </div>

      </fieldset>


            <!--Contenedor de los datos de las compras-->
      <fieldset style="border: 1px solid black ;margin:1%">
        <legend style="border: 1px solid black ; text-align: center;">Libros adquiridos</legend>
          <div style="text-align: center;">
          <?php
              if($usuarioActual->libros->count()==0){
                echo'No se ha realizado ninguna compra todavía';
              }
              else{
              foreach($usuarioActual->libros->libro as $libro){
                echo
                obtenerLibros($libro['ISBN']);
              }
            }

          ?>
        </div>

      </fieldset>

    </div>



</body>

</html>

<?php
  
  //Coloca
  function obtenerLibros($ISBN){
    //Conexión a la BD.
    $link = mysqli_connect("localhost", "root", "admin", "sar");
    //Seleccionamos el libro que contenga ese isbn
    $sql= "SELECT * FROM libros WHERE ISBN = '$ISBN' ";
    $libros = mysqli_query($link,$sql);

    while ($fila = mysqli_fetch_array( $libros )) {
      echo '<table style="text-align: center"> <tr> <th>ISBN</th> <th>Título</th> <th>Autor</th> <th>Género</th> <th>Año</th>';
      echo "<tr>";
      echo "<td>" . $fila["ISBN"] . "</td>";
      echo "<td>" . $fila["Titulo"] . "</td>";
      echo "<td>" . $fila["Autor"] . "</td>";
      echo "<td>" . $fila["Genero"] . "</td>";
      echo "<td>" . $fila["Ano"] . "</td>";
      echo "</tr>";
      echo '</table>';
    }

  }





  //Funcion que muestra el email la direccion y los ultimos 3 numeros de la cuenta
  function colocarDatos($nombre, $email, $direccion, $cuenta){
    echo 'Nombre : ';
    echo $nombre;
    echo '<br>';
    echo 'Email : ';
    echo $email;
    echo '<br>';
    echo 'Direccion : ';
    echo $direccion;
    echo '<br>';
    echo 'Nº Cuenta : ';
    for ($i = 0; $i < strlen($cuenta)-3; $i++) {
          echo '*';
    }
    echo substr($cuenta,strlen($cuenta)-3,3);
    
  }
?>