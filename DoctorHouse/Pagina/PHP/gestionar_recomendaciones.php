<?php
session_start();
include("conexion.php");

$error = ""; // Variable para almacenar los mensajes de error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_doctor = $_POST['id_doctor'];
    $id_paciente = $_POST['id_paciente'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $texto_detallado = $_POST['texto_detallado'];

    // Subida de imagen
    $imagen = $_FILES['imagen']['name'];
    $ruta = '../uploads/' . basename($imagen);

    // Verificar si el doctor existe
    $verificar_doc = "SELECT id_doctor FROM doctor WHERE id_doctor = '$id_doctor'";
    $querydoc = $conn->query($verificar_doc);

    if ($querydoc->num_rows > 0) {
        // Verificar si el paciente existe
        $verificar_paciente = "SELECT id_paciente FROM paciente WHERE id_paciente = '$id_paciente'";
        $consulta_paciente = $conn->query($verificar_paciente);

        if ($consulta_paciente->num_rows > 0) {
            // Si todo es válido, movemos la imagen y procedemos con la inserción
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)) {
                // Inserción de datos en la tabla de recomendaciones incluyendo id_paciente y id_doctor
                $sql = "INSERT INTO recomendaciones (titulo, descripcion, imagen, texto_detallado) 
                        VALUES ('$titulo', '$descripcion', '$imagen', '$texto_detallado')";

                if ($conn->query($sql) === TRUE) {
                    // Obtener el ID de la recomendación recién insertada
                    $id_recomendacion = $conn->insert_id;

                    // Inserción en la tabla intermedia doctor_paciente_recomendacion
                    $sql_relacion = "INSERT INTO doctor_paciente_recomendacion (id_doctor, id_paciente, id_recomendacion) 
                                     VALUES ('$id_doctor', '$id_paciente', '$id_recomendacion')";
                    

                    if ($conn->query($sql_relacion) === TRUE) {
                        
                
                        $mensaje_exito = "La recomendación ha sido agregada con éxito.";
                        } else {
                            $error = "Error al insertar en la tabla intermedia: " . $stmt_relacion->error;
                        }
                    } else {
                        $error = "Error al insertar la recomendación: " . $conn->error;
                    }
            } else {
                $error = "Error al subir la imagen, inténtalo de nuevo.";
                
            }
        } else {
            $error = "Error: El ID de paciente que usted ha ingresado no existe.";
           
            
        }
    } else {
        $error = "Error: El ID de doctor que usted ha ingresado no existe.";
        
    }
}else{
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Recomendaciones</title>
    <link href="../CSS/gestionar_rec.css" rel="stylesheet"/>
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
            color: red;
        }

    </style>
</head>
<body>

    <header>
            <img alt="Logo de DoctorHouse" height="100" src="../image/unnamed.png" width="100">
            <div class="perfil1">
                <a href="perfil_doctor.php"><img alt="foto de perfil" src="../image/perfil.png"></a>
            </div>
        </header>

    <nav class="nave">
            <ul>
                <li><a href="index_doctor.php">Página principal</a></li>
                <li><a href="consulta_doctor.php">Consultas</a></li>
                <li><a href="perfil_doctor.php">Perfil</a></li>
                <li><a href="gestionar_recomedaciones.php">Gestionar recomendaciones</a></li>
                
            </ul>
        </nav>



    
    <form class="recomendacion" action="gestionar_recomendaciones.php" method="POST" enctype="multipart/form-data">
        <h2>Agregar Recomendación</h2>
        <?php 
        if (!empty($error)) {
            // Si hay un mensaje de error, se muestra dentro de un contenedor con la clase error.
            echo '<div class="error">' . $error . '</div>';
        } elseif (!empty($mensaje_exito)) {
            // Si hay un mensaje de éxito, se muestra dentro de un contenedor con la clase correcto.
            echo '<div class="correcto">' . $mensaje_exito . '</div>';
        } 
        ?>
        <label for="id_doctor">ID Doctor:</label>
        <input type="number" name="id_doctor" placeholder="Colocar su número de doctor" required><br><br>

        <label for="id_paciente">ID Paciente:</label>
        <input type="number" name="id_paciente" placeholder="Colocar el número de paciente" required><br><br>

        <label for="titulo">Título:</label>
        <input type="text" name="titulo" placeholder="Colocar un título a la recomendación" required><br><br>

        <label for="descripcion">Descripción breve:</label>
        <textarea name="descripcion" placeholder="Agregar una breve descripción" required></textarea><br><br>

        <label for="texto_detallado">Texto adicional:</label>
        <textarea name="texto_detallado" placeholder="Agregar un texto adicional"></textarea><br><br>

        <label for="imagen">Subir imagen:</label>
        <input type="file" name="imagen" required><br><br>

        <button type="submit">Agregar Recomendación</button>
    </form>
    

    <footer>
        <p>Rodrigo Adrián Rosa Rivas #21 | César Daniel Elías Villanueva #8 | Victoria Rebeca Leiva Padilla #11 | William Ariel Mejía Mira #14</p>
        <p>Redes sociales: <a href="https://www.facebook.com/colegiopadrearrupeoficial">Facebook</a> | <a href="https://www.instagram.com/colegiopadrearrupeoficial/">Instagram</a></p>
        <p>+503 6832 7882 | doctor.house@gmail.com</p>
    </footer>
</body>

</html>