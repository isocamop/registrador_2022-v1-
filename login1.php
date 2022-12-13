<html>
<head> 
	<link rel="stylesheet" href="css/estilo_salida.css" />	
	<title>Inicio de Sesion</title> </head>
<body>
	<header>
	<img src="./imagen/linkedin_banner_image_3.png" id="logo" />
	</header>
	<center>

<?php
	include("conexion2.php");
		if (isset($_POST["submit"]))
		{
			session_start();
			$username = $_POST['username'];
			$password = $_POST['password'];
			$sql = "SELECT * FROM $tbl_name WHERE Nombre = '$username'";
			$result = $conexion->query($sql); 
			if ($result->num_rows > 0)
			{
			$row = $result->fetch_array(MYSQLI_ASSOC); 
			
			if ($password == $row['clave']) {
				$_SESSI0N['loggedin'] = true;
				$_SESSI0N['Nombre'] = $username;
				$_SESSI0N['start'] = time();
				$_SESSION['expire'] = $_SESSION['start'] + (5 * 60);

			} else {
				echo "Nombre o Contraseña estan incorrectos.";
				echo "<br><a href='index.html'>Volver a Intentarlo</a>"; 
			}
			mysqli_close($conexion);
			}
		}
		else
		{
		?>
		<h2>Inicio de Sesion de Usuarios</h2>
		<hr/>
		<FORM METHOD="post" action="checklogin.php">
			Usuario:<br> <input name="username" type="text"	required><br> 
			Contraseña:<br> <input name="password" type="password" required> <br><br>
			<input type="submit" name="submit" value=" Iniciar Sesion ">
		</FORM>
		<?php
		}
		?>
</center>
</body>
</html>
