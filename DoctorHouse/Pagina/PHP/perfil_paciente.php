<?php
include("conexion.php"); // Asegúrate de que este archivo contiene la conexión a la base de datos
session_start();
$mensaje_exito="";
$error="";
$usuario = $_SESSION['nombre_usuario'];
$sql = "SELECT id_paciente,nombre,apellido,numero_telefono,correo_electronico,usuario,historial_medico FROM paciente WHERE usuario = '$usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $paciente = $result->fetch_assoc();
} else {
    die("Error: Cliente no encontrado.");
}

// Variable para almacenar la ruta de la imagen de perfil
$imagenPerfil = 'uploads/png-transparent-user-profile-computer-icons-profile-heroes-black-silhouette-thumbnail.png'; // Imagen por defecto

// Consultar la última imagen subida para el paciente específico
$idPaciente = $paciente['id_paciente'];
$sql = "SELECT ruta FROM fotos_perfil WHERE id_paciente = $idPaciente ORDER BY fecha_subida DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtener la ruta de la imagen
    $row = $result->fetch_assoc();
    $imagenPerfil = $row['ruta'];
}

// Verificar si se ha subido un archivo
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto'])) {
    $foto = $_FILES['foto'];
    $nombreArchivo = $foto['name'];
    $rutaTemporal = $foto['tmp_name'];
    
    // Validar el tipo de archivo
    $tipoArchivo = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
    $tiposPermitidos = ['jpg', 'jpeg', 'png', 'gif'];
    
    if (in_array($tipoArchivo, $tiposPermitidos)) {
        // Mover el archivo a una carpeta en el servidor
        $rutaDestino = '../uploads/' . $nombreArchivo; // Ajusta la ruta según la ubicación de tu archivo PHP
        if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
            // Guardar la ruta de la imagen y el id_paciente en la base de datos
            $sql = "INSERT INTO fotos_perfil (ruta, id_paciente) VALUES ('$rutaDestino', $idPaciente)";
            if ($conn->query($sql) === TRUE) {
                $mensaje_exito= "Foto de perfil subida exitosamente.";
                // Actualizar la imagen de perfil
                $imagenPerfil = $rutaDestino;
            } else {
                $error= "Error al guardar en la base de datos: " . $conn->error;
            }
        } else {
            $error= "Error al mover el archivo.";
        }
    } else {
        $error= "Tipo de archivo no permitido.";
    }
}

$conn->close();
?>









<html>
 <head>
  <title>DoctorHouse: Cuidado Médico a tu Alcance</title>
  <link href="../CSS/estilo1.css" rel="stylesheet"/>
  <link rel="icon" href="../image/unnamed.png">
  <style>
 body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #E0E7EC;
  }
  header {
    background-color: #2a527a;
    color: white;
    text-align: center;
    padding: 10px 0;
    display: flex;
    align-items: center;
    justify-content: left;
    
    
  }
  header img {
    height: 100px;
    width: 100px;
    margin-right: 10px;
    margin-left: 10px;
       
    
  }
  .nav{
    background-color:#EDECEC ; 
    height: 40px;
    margin: 0; /* Elimina el margen superior entre el nav y el header */
    padding: 0;
    display: flex;
    align-items: center; /* Centra verticalmente el contenido */
  
  }
  
  
  .nav ul {
    list-style: none; /* Elimina las viñetas de la lista */
    padding: 0; 
    margin: 0 auto; 
    display: flex; 
    justify-content: center; 
    width: 100%; /* Ocupa todo el ancho disponible */
  }
  
  .nav ul li {
    font-size: 18px;
    white-space: nowrap; /Para que no se dividan las palabras/
    margin: auto; /* Espacio horizontal entre los elementos */
   
  }
  
  .nav ul li a {
    color: rgb(0, 0, 0); 
    text-decoration: none; 
    font-weight: bold; /* Hace los enlaces en negrita */
    padding: 5px 10px; 
    border: 1px solid transparent; 
    transition: all 0.3s ease; /* Añade transición suave al hover */
  }
  
  .nav ul li a:hover {
    border-bottom: 2px solid #0a0a0a; /* Subraya el enlace al pasar el mouse */
  }
  .perfil1 {
    margin-left: 950px;
  }
  .main-content {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    padding: 20px;
  }
  .main-content h2 {
    background-color: #4A90E2;
    color: white;
    padding: 25px 555px;
    border-radius: 5px;
    font-size: 30px;
  }
  .profile {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
  }
  .profile img {
    border-radius: 50%;
    width: 500px;
    height: 500px;
    margin-right: 100px;
    background-color: white;
  }
  .profile-info {
    background-color: #4A90E2;
    color: white;
    padding: 30px;
    border-radius: 10px;
    margin-left: 28px;
    width: 500px;
  }
  .profile-info h3 {
    margin-top: 0;
  }
  .profile-info p {
    background-color: white;
    color: black;
    padding: 20px;
    border-radius: 5px;
    margin: 20px 0;
   
  }    
    #modal {
  background-color: white;
  width: 350px;
  height: 250px;
  text-align: center;
  border: 2px solid #333;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

#modal h2 {
  font-size: 24px;
  color: #333;
  margin-bottom: 20px;
}

#modal p {
  font-size: 18px;
  color: #555;
  margin-bottom: 20px;
}

#modal button {
  border-radius: 5px;
  cursor: pointer;
  width: 150px;
  height: 40px;
  font-size: 18px;
  border: none;
  margin: 10px 0;
}

#modal .aceptar {
  background-color: green;
  color: white;
}

#modal .cerrar {
  background-color: red;
  color: white;
}

#modal a {
  color: white;
  text-decoration: none;
  display: inline-block;
  width: 100%;
  height: 100%;
  text-align: center;
  line-height: 40px;
}

dialog::backdrop {
  background: rgba(206, 216, 234, 0.9);
}
.subirFoto{
      background: rgba(255, 255, 255, 0.23);
      width: 350px;
      height: 200px;
      margin-left: 105px;
      border: 1px solid;
      border-radius: 5px;
    }
    label{
    display: flex;
    width: 250px;
    height: 35px;
    font-size: 20px;
    margin: 15%;
    margin-bottom: 3px;
    margin-top: 3px;
    font-size: 18px;
    }
    .subir{
      width: 150px;
      height: 30px;
      margin-left: 95px;
      background-color:; 
    }
    .subirFoto h2{
      margin-left:70px;
    }
    input[type="file"]{
      margin: 2.5%;
      margin-left: 20px;
    }

  
    .subirFoto{
      background: rgba(255, 255, 255, 0.23);
      width: 350px;
      height: 200px;
      margin-left: 105px;
      border: 1px solid;
      border-radius: 5px;
    }
    label{
    display: flex;
    width: 250px;
    height: 35px;
    font-size: 20px;
    margin: 15%;
    margin-bottom: 3px;
    margin-top: 3px;
    font-size: 18px;
    }
    .subir{
      width: 150px;
      height: 30px;
      margin-left: 95px;
      background-color:; 
    }
    .subirFoto h2{
      margin-left:70px;
    }
    input[type="file"]{
      margin: 2.5%;
      margin-left: 20px;
    }

    
    #modal {
  background-color: white;
  width: 350px;
  height: 250px;
  text-align: center;
  border: 2px solid #333;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

#modal h2 {
  font-size: 24px;
  color: #333;
  margin-bottom: 20px;
}

#modal p {
  font-size: 18px;
  color: #555;
  margin-bottom: 20px;
}

#modal button {
  border-radius: 5px;
  cursor: pointer;
  width: 150px;
  height: 40px;
  font-size: 18px;
  border: none;
  margin: 10px 0;
}

#modal .aceptar {
  background-color: green;
  color: white;
}

#modal .cerrar {
  background-color: red;
  color: white;
}

#modal a {
  color: white;
  text-decoration: none;
  display: inline-block;
  width: 100%;
  height: 100%;
  text-align: center;
  line-height: 40px;
}

dialog::backdrop {
  background: rgba(206, 216, 234, 0.9);
}

.error{
            width: 300px;
            padding: 10px;
            margin-bottom: 3px;
            background-color:rgba(248, 242, 242, 0.605);
            font-size: 20px;
            border: 1px solid black;
            margin: auto;
            color: red;
        }
        .correcto{
            width: 300px;
            padding: 10px;
            margin-bottom: 3px;
            background-color: rgba(248, 242, 242, 0.605);
            font-size: 20px;
            border: 1px solid black;
            margin: auto;
            color:  get_parent_class ;
        }

  </style>
 </head>



 <body>
  
  <dialog id="modal" class="modal">
    <h2>¡Estás a punto de cerrar sesión!</h2>
    <p>.</p>
    <button class="aceptar" onclick="window.modal.close();">Volver al perfil</button>
    <button class="volver"><a href="../index.html">Cerrar Sesión </a></button>
  </dialog>

  <header>
    <img alt="Logo de DoctorHouse" height="100" src="../image/unnamed.png" width="100"/>
    <div class="perfil1">
      <a href="perfil_paciente.php"><img alt="foto de perfil" src="../image/perfil.png"></a>
    </div>
  </header>

  <div class="nav">
    <ul>
      <li><a href="index_pac.php">Página principal</a></li>
      <li><a href="consulta_paciente.php">Consultas</a></li>
      <li><a href="perfil_paciente.php">Perfil</a></li>
      <li><a href="recomendaciones.php">Recomendaciones</a></li>
    </ul>
  </div>

  <div class="main-content">
    <h2><b>Paciente</b></h2>
    <?php 
        if (!empty($error)) {
            // Si hay un mensaje de error, se muestra dentro de un contenedor con la clase error.
            echo '<div class="error">' . $error . '</div>';
        } elseif (!empty($mensaje_exito)) {
            // Si hay un mensaje de éxito, se muestra dentro de un contenedor con la clase correcto.
            echo '<div class="correcto">' . $mensaje_exito . '</div>';
        } 
        ?>
    <div class="profile">
    <img src="<?php echo $imagenPerfil; ?>" alt="Foto de Perfil" class="perfil">
      
      <div class="profile-info">
        
          <h3>Pac <?php echo htmlspecialchars($paciente['nombre'])." " . htmlspecialchars($paciente['apellido']);  ?> </h3>
          <p>Teléfono: <?php echo htmlspecialchars($paciente['numero_telefono']); ?></p>
            <p>Correo Electrónico: <?php echo htmlspecialchars($paciente['correo_electronico']); ?></p>
            <p>Usuario: <?php echo htmlspecialchars($paciente['usuario']); ?></p>
            <p>Historial médico: <?php echo htmlspecialchars($paciente['historial_medico']); ?></p>


        
      </div>
    </div>
  </div>


  

    
    <form action="" method="post" enctype="multipart/form-data" class="subirFoto">
        <h2>Subir foto de perfil</h2>
        <label for="foto">Selecciona una foto de perfil:</label>
        <input type="file" name="foto" id="foto" accept="image/*" required>
        <button type="submit" class="subir">Subir Foto</button>
    </form>
  <button class="logout-button" onclick="window.modal.showModal();">Cerrar Sesión</button>

 </body>

 <footer>
   <p>Rodrigo Adrián Rosa Rivas #21 | César Daniel Elías Villanueva #8 | Victoria Rebeca Leiva Padilla #11 | William Ariel Mejía Mira #14</p>
   <p>Redes sociales: <a href="https://www.facebook.com/colegiopadrearrupeoficial">Facebook</a> | 
     <a href="https://www.instagram.com/colegiopadrearrupeoficial/">Instagram</a></p>
   <p>+503 6832 7882 | doctor.house@gmail.com</p>
 </footer>

</html>