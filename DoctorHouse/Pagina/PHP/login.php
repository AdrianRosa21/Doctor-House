<?php
ob_start();
#este codigo es de ejemplo pq en el del cole las variables cambian acordate, pero es funcional iwal
include("conexion.php"); 
session_start();
$Error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $role = $_POST['rol'];
    $tabla = '';
    switch ($role) {
        case 'doctor':
            $tabla = 'doctor';
            break;
        case 'enfermera':
            $tabla = 'enfermera';
            break;
        case 'paciente':
            $tabla = 'paciente';
            break;
        
    }
    $sql = "SELECT * FROM $tabla WHERE usuario='$usuario' OR correo_electronico='$usuario'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $usuario1 = $result->fetch_assoc();
        if ($usuario1['contraseña'] === $contrasena) {
            $_SESSION['nombre_usuario'] = $usuario1['usuario'];
            $_SESSION['rol'] = $role;
            switch ($role) {
                case 'doctor':
                    #este header cambiale las cosas para que te redirija a los mains
                    # Y EN LOS MAINS pondremos que siempre se guarden las conexiones(haremos tdo php)
                    header("Location: index_doctor.php");
                    break;
                case 'enfermera':
                    header("Location: index_enfermera.php");
                    break;
                default:
                    header("Location: index_pac.php");
                    break;
            }
            exit();
        }
        else {
            $Error = "La contraseña es incorrecta.";
        }
    }
    else{
        $Error = "El usuario no ha sido encontrado";
    }
    }
$conn->close();
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../image/unnamed.png">
    <link rel="stylesheet" href="../CSS/login.css">
    <style>
        .Error{
            width: 300px;
            padding: 10px;
            margin-bottom: 3px;
            background-color:rgba(248, 242, 242, 0.605);
            font-size: 20px;
            border: 1px solid black;
            margin: auto;
            color: red;
        }
    </style>
    <title>Iniciar sesión</title>
</head>
<body>
    <header>
        <img alt="Logo de DoctorHouse" height="100" src="../image/unnamed.png" width="100"/>
        <h1>Bienvenidos a DoctorHouse: Cuidado Médico a tu Alcance</h1>
        <ul><a href="../index.html">Volver al menú</a></ul>
    </header>
    <main>
        <form class="iniciar-sesion" id="login" action="" method="post">
            <h2>Iniciar sesión</h2>
            <?php 
            if (!empty($Error)) {
                // Si hay un mensaje de error, se muestra dentro de un contenedor con la clase error.
                echo '<div class="Error">' . $Error . '</div>';
            }
            ?>
            <label for="usuario">Nombre de Usuario:</label>
            <input type="text" id="usuario" name="usuario" placeholder="Nombre de usuario" required>
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>
            <label for="mostrar"> Mostrar contraseña
            <input type="checkbox" id="mostrar"></label>
            <label for="option">Escoge tu rol correspondiente:</label>
            <select required id="select" name="rol">
                <option value="paciente" id="paciente">Paciente</option>
                <option value="doctor" id="doctor">Doctor/a</option>
                <option value="enfermera" id="enfermera">Enfermer@</option>
            </select>
            <button class="button" type="submit">Iniciar sesión</button>
            <p>¿No tienes una cuenta?</p>
            <p><a href="../Html/registrarse.html">Registrate aquí</a></p>
        </form>
    </main>
    <script type="text/javascript">
        const inputContraseña = document.getElementById('contrasena');
        const checkboxMostrarContraseña = document.getElementById('mostrar');
        
        checkboxMostrarContraseña.addEventListener('change', function() {
            inputContraseña.type = this.checked? 'text' : 'password';
        });
        
        
    </script>
    <footer>
        
        <p>Rodrigo Adrián Rosa Rivas #21 | César Daniel Elías Villanueva #8 | Victoria Rebeca Leiva Padilla #11 | William Ariel Mejía Mira #14</p>
        
        <p>Redes sociales: <a href="https://www.facebook.com/colegiopadrearrupeoficial">Facebook</a> | <a href="https://www.instagram.com/colegiopadrearrupeoficial/">Instagram</a></p>
        
        <p>+503 6832 7882 | doctor.house@gmail.com</p>
    </footer>
</body>
</html>
