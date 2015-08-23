<html>
<head></head>
<title>Niveles de servicio </title>

	<link href="PHP/CSS/estilos_login.css" rel="stylesheet" type="text/css"/>

<body>

<div id = "login">

	<form action = "" method="post" >

		<div>
			<label>Usuario:</label>
			<input type = "text "id = "email" name = "user" value = ""></input>
		</div>
		
		<div>
			<label>Contrase&ntilde;a:</label>
			<input type = "password" id = "Pass" name= "pass" value = ""></input>
		</div>
		
		<input class = "bottom" id = "boton" type = "submit"	value = "Iniciar Sesi&oacute;n" name = "login">

	</form>
	
	<div id = "menubajo">
	
		<a href= "#">Solicitar Acceso</a>

		<a href= "#">Recuperar Password</a>
	</div>
	
</div>
	<?php
	
			include 'PHP/funciones.php';
			
			if(@$_POST['login']){
			
				$mensaje = "";
				
				$u = mysql_real_escape_string($_POST['user']);
				$p = mysql_real_escape_string($_POST['pass']);
			
				if($u==null or $p==null){
				
					$mensaje = "El campo de usuario y/o contraseña esta vacio.";
				
				}else{
				
					if(login($user=$u,$pass=$p)){
						
						header('location:PHP/menu.php');
					}else{
					
						$mensaje = "Usuario o contraseña invalidos.";
					}

				}
				
				echo "<div id = \"error\">".utf8_decode($mensaje)."</div>";

			}

				function login($user,$pass){
				
					$q = "SELECT * FROM registro WHERE user=\"".$user."\" AND pass=".$pass."";
					
					$rec = mysql_query($q);
					
					if(($resultado = mysql_num_rows($rec))==1){
					
					return true;
					}else{
					
					return false;
					}
					
					

				}
			
	?>
<body>

</html>