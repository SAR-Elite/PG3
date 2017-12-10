<?php
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Login</title>
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
		<span style="float:right;"><a href='registro.html'>Registro</a></spam>/
		<span ><a href='login.php'>Login</a></spam>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='inicioanonimo.html'>Inicio</a></spam>
		<span><a href='lista_librosanonimo.php'>Lista de libros</a></spam>
		<span><a href=''>Información</a></spam>
	</nav>
    <section class="main" id="s1">
    
	<div>

		<form enctype="multipart/form-data" style="float: left" id='login' name='login' action=login.php method="post">

			<table>	
				
				<tr>
					<td><span>Email: </span></td>
			   		<td><input type="text" id="email" name="email"></td>

				</tr>
				<tr>
					<td><span>Password: </span></td>
					<td><input type="password" id="pass" name="pass">	</td>
				</tr>	

			</table>

			<br>

				<input style="margin-top: 20px" id="submit" type="submit" value="Iniciar sesión"></td>
				<input style="margin-top: 20px" id="rst" type="reset" value="Borrar campos"></td>

		</form>

		<?php


				if(isset($_POST['email'],$_POST['pass'])){
						
						$id=login($_POST['email'],$_POST['pass']);

						if($id!=-1){

							if($id==0){	//Si el usuario se esta identificando como admin
								$_SESSION["admin"]='SI';	
							}		
							$_SESSION["id"]=$id;
							header ("Location: inicio.php");						}
						else{
							echo"NO";
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
    </section>
	<footer class='main' id='f1'>
	</footer>
</div>


<script>

</script>


</body>
</html>
