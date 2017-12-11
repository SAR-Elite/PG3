<?php

	if(isset($_POST['isbn'],$_POST['titulo'], $_POST['aut'], $_POST['gen'], $_POST['ano'],$_POST['precio'],$_POST['sinop'])){


		//Validacion del servidor
			


	
		if($_POST['isbn']=="" ||  $_POST['titulo']==""||  $_POST['aut']==""||  $_POST['gen']==""||  $_POST['ano']==""|| $_POST['precio']==""|| $_POST['sinop']==""){

			echo '<span style = "padding:5px" > No se permiten campos vacios </span>';

		}

		else{

				//Contectar con la base de datos 

				$link = mysqli_connect("localhost", "root", "admin", "sar");
				if (!$link)
				{
				 echo "Fallo al conectar a MySQL: " . $link->connect_error;
				}
				$imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));


				$sql= "INSERT INTO libros(ISBN,Titulo,Autor,Genero,Ano,Precio,Sinopsis,Portada) VALUES ('$_POST[isbn]','$_POST[titulo]','$_POST[aut]','$_POST[gen]','$_POST[ano]','$_POST[precio]','$_POST[sinop]', '$imagen')";

				//Error al insertar
				if (!mysqli_query($link ,$sql))
				 { 	
					die('Error: ' . mysqli_error($link));
					echo "No se ha podido insertar";
				 }
				 else{
				 	echo "Libro añadido correctamente";
				 }

				// Cerrar conexión
				mysqli_close($link);

				

		}
	}

?>