<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ejemplo";
$port = 3307;

// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

// Verificar conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Manejar el registro
if (isset($_POST['registro'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO datos (nombre, correo, contraseña) VALUES ('$nombre', '$correo', '$contrasena')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Registro exitoso. Ahora puedes iniciar sesión.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error al registrar: " . mysqli_error($conn) . "');</script>";
    }
}

// Manejar el inicio de sesión
if (isset($_POST['ingresar'])) {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT * FROM datos WHERE correo='$correo'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($contrasena, $row['contraseña'])) {
            echo "<script>alert('Inicio de sesión exitoso. Bienvenido, " . $row['nombre'] . "!'); window.location.href='http://127.0.0.1:5500/pagina-principal.html';</script>";
        } else {
            echo "<script>alert('Contraseña incorrecta.');</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado.');</script>";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro e inicio de sesion</title>
</head>
<body>



<div class="contenido">
        <div class="parte1">
    <h2>Formulario <br> de Registro</h2>
    <form method="POST" action="index.php">
        
        <div class="cont">
        <img src="imagenes/nombre.png" alt="" class ="img1"><input type="text" name="nombre" required="" placeholder = "Nombre" class ="recuadro" ><br>
        <img src="imagenes/correo.png" alt="" class ="img1"><input type="email" name="correo" required="" placeholder = "Correo" class ="recuadro"><br>
        <img src="imagenes/telefono.png" alt="" class ="img1"><input type="text" name="telefono" required="" placeholder = "telefono" class ="recuadro"><br>
        <img src="imagenes/contraseña.png" alt="" class ="img1"><input type="password" name="contrasena" required="" placeholder = "contraseña" class ="recuadro"><br><br>
        <button type="submit" name="registro" >Registrar</button>
        </div>
    </form>
    </div>

    <div class="parte2">
    <h2>Formulario Inicio <br> de Sesión</h2>
    <form method="POST" action="index.php">
        <div class="cont1">
        <img src="imagenes/correo.png" alt="" class ="img1"><input type="email" name="correo" required="" placeholder="Correo" class ="recuadro"><br>
        <img src="imagenes/contraseña.png" alt="" class ="img1"><input type="password" name="contrasena" required="" placeholder="Cotraseña" class ="recuadro"><br><br>
        <button type="submit" name="ingresar">Ingresar</button>
        </div>
    </form>
    </div>
</div>


<style>

    
body {
        background: url(imagenes/bar.jpg); /* ruta actualizada si el CSS está en carpeta css/ */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        margin: 0;
        font-family: Arial, sans-serif;
    }
    
/*LOGIN ------------------------------------------------------------------------*/

.contenido{
    display: flex;
    justify-content: center;
    margin-left:210px;
    margin-right:210px;
    margin-top: 100px;
    width: 50%;
    height: 550px;
    padding-top: 50px;
    background: transparent;
    animation: sombras 3s 0.5s infinite running ;
    gap: 20px;
    transition: 0.7s ease-in-out;
    border-radius: 50px;
    padding-inline:150px;
    position: relative;

    
}

.contenido:hover{
       transition: 0.7s ease-in-out;
       background: rgba(0, 0, 0, 0.7);

    
}



@keyframes sombras{
    0%{
        box-shadow: 0px 0px 20px purple;
    }

    20%{
        box-shadow: -10px -12px 20px red;
    }

    40%{
        box-shadow: 12px -10px 20px orange;
    }

    60%{
        box-shadow: 12px 15px 20px yellow;
    }

    80%{
        box-shadow: -12px 10px 20px purple;
    }

    100%{
        box-shadow: 0px 0px 20px greenyellow;
    }
}

/*PARTE 1---------------------------------------------------------------------*/

.contenido .parte1{
    width: 100%;
    height: 480px;
}

.contenido .parte1 h2{
    color: white;
    text-shadow: 0 0 10px white;
    text-align: center;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 30px;
}


.contenido .parte1 .cont{
    padding-left: auto;
    padding-right:auto;
}

.contenido .parte1 .img1{
    filter: invert(100%);
    margin-right: 20px;
    width: 25px;
} 

.contenido .parte1 .recuadro{
    background: transparent;
    border: 2px solid white;
    padding-top: 15px;
    padding-bottom: 15px;
    padding-left: 10px;
    padding-right: 90px;
    border-radius: 15px;
    margin-bottom: 14px;
}



input.recuadro::placeholder {
    color: white;
    font-size: 18px;
}

input{
    color: white;
    font-size: 18px;
}


.contenido .cont button{
    background: transparent;
    color: white;
    border: 2px solid white;
    padding-top: 10px;
    padding-bottom: 10px;
    padding-inline: 40px;
    font-size: 20px;
    margin-left: 135px;
    border-radius: 20px 75px 30px 60px;
    transition: 0.4s;
}

.contenido .cont button:hover{
    transform: scale(1.1) rotate(360deg);
    transition: 0.4s;
    box-shadow: 0 0 12px #f5f5f5;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    box-shadow: 0 10px 8px purple;
}






/*PARTE 2---------------------------------------------------------------------*/

.contenido .parte2{
    width: 500px;
    height: 480px;
    background: transparent;
}

.contenido .parte2 h2{
    color: white;
    text-shadow: 0 0 10px white;
    text-align: center;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 30px;
    margin-bottom: 60px;
}


.contenido .parte2 .cont1{
    padding-left: 40px;
    background: transparent;
}

.contenido .parte2 .img1{
    filter: invert(100%);
    margin-right: 20px;
    width: 25px;
} 

.contenido .parte2 .recuadro{
    background: transparent;
    border: 2px solid white;
    padding-top: 15px;
    padding-bottom: 15px;
    padding-left: 10px;
    padding-right: 90px;
    border-radius: 15px;
    margin-bottom: 34px;
}



input.recuadro::placeholder {
    color: white;
    font-size: 18px;
}


.contenido .cont1 button{
    background:transparent;
    color: white;
    border: 2px solid white;
    text-align: center;
    padding-top: 10px;
    padding-bottom: 10px;
    padding-inline: 40px;
    font-size: 20px;
    margin-left: 135px;
    border-radius: 20px 75px 30px 60px;
    transition: 0.4s;
    margin-top: 50px;
}

.contenido button:hover{
    transform: scale(1.1) rotate(3deg);
    transition: 0.4s;
    box-shadow: 0 0 12px #f5f5f5;
}


/*responsive 1024-------------------------------------------*/

@media (max-width: 1024px) {
    .contenido{
        position: absolute;
        margin-right: auto;
        margin-left: auto;
        width: auto;
        height: auto;
        flex-direction: column;
    }

    .contenido .parte1{
        width: auto;
        height: auto;
        padding-inline:85px;
    }



    .contenido .cont .recuadro{
        width: auto;
        padding-right: 0;
    }

    .contenido .parte1 .cont button{
        margin-left: 30px;
    }


    /*parte 2--------------------------------*/

    .contenido .parte2{
        width: auto;
        height: auto;
    }


    .contenido .cont1 .recuadro{
        width: auto;
        padding-right: 0;
    }

    .contenido .cont button{
        margin-left: 78px ;
    }

    .contenido .cont1 button{
        margin-left: 78px ;
        margin-top: -70px;
        margin-bottom: 22px;
    }

}


@keyframes square-in-center {
    from {
      clip-path: inset(100% 100% 100% 100%);
    }
    to {
      clip-path: inset(0 0 0 0);
    }
  }
  
 
</style>

</body>
</html>
