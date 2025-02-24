<?php
include("conexion.php"); // Asegúrate de que este archivo contiene la conexión a la base de datos
session_start();
$mensaje_exito="";
$error="";
$usuario = $_SESSION['nombre_usuario'];
$sql = "SELECT id_enfermera, nombre, apellido, numero_telefono, correo_electronico, usuario FROM enfermera WHERE usuario = '$usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $enfermera = $result->fetch_assoc();
} else {
    die("Error: Enfermera no encontrada.");
}

// Variable para almacenar la ruta de la imagen de perfil
$imagenPerfil = 'uploads/default_profile.png'; // Imagen por defecto

// Consultar la última imagen subida para la enfermera específica
$idEnfermera = $enfermera['id_enfermera'];
$sql = "SELECT ruta FROM fotos_perfil WHERE id_enfermera = $idEnfermera ORDER BY fecha_subida DESC LIMIT 1";
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
            // Guardar la ruta de la imagen y el id_enfermera en la base de datos
            $sql = "INSERT INTO fotos_perfil (ruta, id_enfermera) VALUES ('$rutaDestino', $idEnfermera)";
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
            color: green;
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

  </style>
 </head>

 <body>
  
  <dialog id="modal" class="modal">
    <h2>¡Estás a punto de cerrar sesión!</h2>
    <p>.</p>
    <button class="aceptar" onclick="window.modal.close();">Volver a perfil</button>
    <button class="cerrar"><a href="../index.html">Cerrar sesión</a></button>
  </dialog>

  <header>
    <img alt="Logo de DoctorHouse" height="100" src="../image/unnamed.png" width="100"/>
    <div class="perfil1">
      <a href="perfil_enfermera.php"><img alt="foto de perfil" src="../image/perfil.png"></a>
    </div>
  </header>

  <div class="nav">
    <ul>
      <li><a href="index_enfermera.php">Página principal</a></li>
      <li><a href="consulta_enfermera.php">Consultas</a></li>
      <li><a href="perfil_enfermera.php">Perfil</a></li>
      
    </ul>
  </div>
  <?php 
        if (!empty($error)) {
            // Si hay un mensaje de error, se muestra dentro de un contenedor con la clase error.
            echo '<div class="error">' . $error . '</div>';
        } elseif (!empty($mensaje_exito)) {
            // Si hay un mensaje de éxito, se muestra dentro de un contenedor con la clase correcto.
            echo '<div class="correcto">' . $mensaje_exito . '</div>';
        } 
        ?>
  <div class="main-content">
    <h2><b>Enfermera</b></h2>
    
    <div class="profile">
    <img src="<?php echo $imagenPerfil; ?>" alt="Foto de Perfil" class="perfil">
      
      <div class="profile-info">
        
      <h3>Enfermera:  <?php echo htmlspecialchars($enfermera['nombre'])." ".  htmlspecialchars($enfermera['apellido']);  ?> </h3>
        <p>Telefono: <?php echo htmlspecialchars($enfermera['numero_telefono']); ?></p>
          <p>Correo Electrónico: <?php echo htmlspecialchars($enfermera['correo_electronico']); ?></p>
          <p>Usuario: <?php echo htmlspecialchars($enfermera['usuario']); ?></p>
        
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