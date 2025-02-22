<?php
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_doctor = $_POST['id_doctor'];
    $id_paciente = $_POST['id_paciente'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $texto_detallado = $_POST['texto_detallado'];
    
    // Subida de imagen
    $imagen = $_FILES['imagen']['name'];
    $ruta = '../uploads/' . basename($imagen);
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)) {
        // Inserción de datos
        $sql = "INSERT INTO recomendaciones (titulo, descripcion, texto_detallado, imagen) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            // Binding parameters
            $stmt->bind_param("ssss", $titulo, $descripcion, $texto_detallado, $imagen);
            $stmt->execute();

            // Relación en la tabla intermedia
            $id_recomendacion = $stmt->insert_id; // Obtener el ID de la recomendación recién insertada
            $sql_relacion = "INSERT INTO doctor_paciente_recomendacion (id_doctor, id_paciente, id_recomendacion) VALUES (?, ?, ?)";
            $stmt_relacion = $conn->prepare($sql_relacion);
            $stmt_relacion->bind_param("iii", $id_paciente, $id_doctor, $id_recomendacion);
            $stmt_relacion->execute();

            echo "Recomendación agregada con éxito.";
        } else {
            echo "Error al preparar la consulta de inserción: " . $conn->error;
        }
    } else {
        echo "Error al subir la imagen.";
    }
} 

    


$conn->close();
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Recomendaciones</title>
    <link href="../CSS/styles.css" rel="stylesheet"/>
</head>
<body>

    <header>
            <img alt="Logo de DoctorHouse" height="100" src="../image/unnamed.png" width="100">
            <div class="perfil1">
                <a href="Doc_Perfil.html"><img alt="foto de perfil" src="../image/perfil.png"></a>
            </div>
        </header>

    <nav class="nave">
            <ul>
                <li><a href="index_doctor.html">Página principal</a></li>
                <li><a href="consulta_doctor.html">Consultas</a></li>
                <li><a href="Doc_Perfil.php">Perfil</a></li>
                
            </ul>
        </nav>



    <h2>Agregar Recomendación</h2>
    <form action="gestionar_recomendaciones.php" method="POST" enctype="multipart/form-data">
        <label for="id_doctor">ID Doctor:</label>
        <input type="number" name="id_doctor" required><br><br>

        <label for="id_paciente">ID Paciente:</label>
        <input type="number" name="id_paciente" required><br><br>

        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required><br><br>

        <label for="descripcion">Descripción breve:</label>
        <textarea name="descripcion" required></textarea><br><br>

        <label for="texto_detallado">Texto adicional:</label>
        <textarea name="texto_detallado"></textarea><br><br>

        <label for="imagen">Subir imagen:</label>
        <input type="file" name="imagen" required><br><br>

        <input type="submit" value="Agregar Recomendación">
    </form>
    

    <footer>
        <p>Rodrigo Adrián Rosa Rivas #21 | César Daniel Elías Villanueva #8 | Victoria Rebeca Leiva Padilla #11 | William Ariel Mejía Mira #14</p>
        <p>Redes sociales: <a href="https://www.facebook.com/colegiopadrearrupeoficial">Facebook</a> | <a href="https://www.instagram.com/colegiopadrearrupeoficial/">Instagram</a></p>
        <p>+503 6832 7882 | doctor.house@gmail.com</p>
    </footer>
</body>

</html>