<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Añadir_libro</title>
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

		<?php
		session_start ();

		if((isset($_SESSION['autentificado'])) & (isset($_SESSION['admin'])) & ($_SESSION['admin']=="SI")){
			echo"<span><a href='logout.php'>Logout</a></span>";
		}

		?>


    </header>
	<nav class='main' id='n1' role='navigation'>

		<?php
		

		if((isset($_SESSION['autentificado'])) & (isset($_SESSION['admin'])) & ($_SESSION['admin']=="SI")){

			echo"<span><a href='inicio.php'>Inicio</a></span>";
			echo"<span><a href='anadir_libro.php'>Añadir libro</a></span>";
			echo"<span><a href='lista_libros.php'>Lista de libros</a></span>";
			echo"<span><a href=''>Información</a></span>";
		
		}


		?>

	</nav>
    <section class="main" id="s1">
    
    	<form enctype="multipart/form-data" style="float: left" id='flibro' name='flibro' action=anadir_libro.php? method="post">

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
					<td><span>Categoria: </span></td>
					<td><input type="text" id="cat"  name="cat"></td>
				</tr>

				<tr>
					<td><span>Fecha: </span></td>
					<td><input type="date" id="fech"  name="fech"></td>
				</tr>

			</table>

			<br>

				<span id="hldr"></span>
				<input id="fileChos" type="file" name="pic" accept="image/*"  onchange="showImg(this)">
				<br>
				<input  style="margin-top: 20px" id="submit" type="submit" value="Enviar"></td>
				<input style="margin-top: 20px" id="rst" type="reset" value="Borrar campos e imagen"></td>

		</form>

		<?php

				if(isset($_POST['isbn'],$_POST['titulo'], $_POST['aut'], $_POST['cat'], $_POST['fech'])){


					//Validacion del servidor
						$erISBN = '/^([0-9]{3})+(-)+([0-9]{1})+(-)+([0-9]{2})+(-)+([0-9]{6})(-)+([0-9]{1})$/';

						


						$("#nom").val().match(/^([a-zA-ZáéíóúÁÉÍÓÚ])+((([ ])+([a-zA-ZáéíóúÁÉÍÓÚ]{1,})){1,})$/);

						if($_POST['isbn']=="" || $_POST['titulo']=="" || $_POST['aut']==""|| $_POST['cat']==""|| $_POST['fech']=="")

							
							echo '<span style = "padding:5px" > No se permiten campos vacios </span>';

						elseif (!preg_match($erISBN, $_POST['isbn'])) {
								
							echo '<span">Error ISBN: ejemplo: 97-3-16-14410-0 </span>';

						}


						else{

								//Contectar con la base de datos 

								$link = mysqli_connect("localhost", "root", "", "libros");
								if (!$link)
								{
								 echo "Fallo al conectar a MySQL: " . $link->connect_error;
								}

								//Insertar imagen


								if ($_FILES['pic']['size'] == 0 ){
									$pic = addslashes(file_get_contents("img/imgPrev.png"));	
								}			
								else{
									$pic = addslashes(file_get_contents($_FILES['pic']['tmp_name']));
								}

								

								$sql= "INSERT INTO libro(ISBN,TITULO,AUTOR,CATEGORIA,FECHA,IMAGEN) VALUES ('$_POST[isbn]','$_POST[titulo]','$_POST[aut]','$_POST[cat]','$_POST[fech]','$pic')";

								//Error al insertar
								if (!mysqli_query($link ,$sql))
								 { 	
									die('Error: ' . mysqli_error($link));
									echo "No se ha podido insertar";
								 }
								 

								// Cerrar conexión
								mysqli_close($link);

						
					}
				}
			?>



    </section>
	<footer class='main' id='f1'>
	</footer>
</div>

<script>

	function rmvImg(){
			$('#imgPrev').remove();	   						
	}


	function showImg(input){

		rmvImg();
		$('#hldr').append('<img id="imgPrev" src="img/imgPrev.png" style="width:150px;height:150px;float: left; border:2px solid black ;margin-right:30px ">');
		var reader = new FileReader();
		reader.onload = function (e) {
            $('#imgPrev').attr('src', e.target.result);
        }
		reader.readAsDataURL(input.files[0]);

	}


</script>

</body>
</html>