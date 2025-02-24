<?php
include("conexion.php");
session_start();
#Esto cambiar por lo del id del usuario que se ejecute una consulta anterior se saque solo el id del paciente en una variable y ya

$usuario=$_SESSION['nombre_usuario'];
$sql2= "SELECT id_paciente FROM paciente WHERE usuario = '$usuario' ";
$resultt = $conn->query($sql2);

$paciente = $resultt->fetch_assoc();

$id_paciente = $paciente['id_paciente'];

$sql = "SELECT recomendaciones.titulo, recomendaciones.descripcion, recomendaciones.imagen, recomendaciones.texto_detallado, doctor.nombre AS nombre_doctor
        FROM recomendaciones 
        INNER JOIN doctor_paciente_recomendacion ON recomendaciones.id_recomendacion = doctor_paciente_recomendacion.id_recomendacion
        INNER JOIN doctor ON doctor_paciente_recomendacion.id_doctor = doctor.id_doctor
        WHERE doctor_paciente_recomendacion.id_paciente = ?";
        
        $stmt = $conn->prepare($sql); // Preparar la consulta

        // Comprobar si la preparación fue exitosa
        if ($stmt) {
            // Enlazar el parámetro de entrada
            $stmt->bind_param("i", $id_paciente); // Enlaza el ID del paciente
        
            // Ejecutar la consulta
            $stmt->execute();
            
            // Obtener los resultados
            $resultado = $stmt->get_result();
        
            
            // Cerrar la consulta
            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta: " . $conn->error;
        }
        
        // Cerrar la conexión
        $conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DoctorHouse: Cuidado Médico</title>
    <link rel="stylesheet" href="../CSS/styles_reco.css">
    <link rel="icon" href="../image/unnamed.png">
</head>
<body>
    <!-- Este codigo utilizaremos en todo el de paciente -->
    <header>
        <img alt="Logo de DoctorHouse" height="100" src="../image/unnamed.png" width="100">
        <div class="perfil1">
            <a href="perfil_paciente.php"><img alt="foto de perfil" src="../image/perfil.png"></a>
        </div>
    </header>
    <nav class="nave">
        <ul>
            <li><a href="index_pac.php">Página principal</a></li>
            <li><a href="consulta_paciente.php">Consultas</a></li>
            <li><a href="perfil_paciente.php">Perfil</a></li>
            <li><a href="recomendaciones.php">Recomendaciones</a></li>
        </ul>
    </nav>
<!-- Hasta aquí :3 -->
<main>
    <div class="titulo">
        <h2>Recomendaciones de Salud</h2>
    </div>
    
    <!-- Aquí inicia el contenedor dinámico -->
    <div class="informativos-container">
        <?php
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<div class='informativo'>";
                echo "<div class='informativo-header informativos1'>";
                echo "<img src='../uploads/" . $fila['imagen'] . "' alt='Imagen Recomendación' width='200'>";
                echo "<h3>" . $fila['titulo'] . "</h3>";
                echo "</div>";
                echo "<div class='informativo-body informativos2'>";
                echo "<p>" . $fila['descripcion'] . "</p>";
                echo "</div>";
                echo "<button onclick=\"document.getElementById('modal_" . $fila['titulo'] . "').showModal();\">Más Información</button>";
                echo "<dialog id='modal_" . $fila['titulo'] . "'>";
                echo "<h3>Recomendado por: Dr. " . $fila['nombre_doctor'] . "</h3>";
                echo "<p>" . $fila['texto_detallado'] . "</p>";
                echo "<button onclick=\"document.getElementById('modal_" . $fila['titulo'] . "').close();\">Cerrar</button>";
                echo "</dialog>";
                echo "</div>";
            }
        } else {
            
          
            echo "<p>No hay recomendaciones para este paciente.</p>";
            
        }
        ?>
    </div>
</main>

<footer>
    <p>Rodrigo Adrián Rosa Rivas #21 | César Daniel Elías Villanueva #8 | Victoria Rebeca Leiva Padilla #11 | William Ariel Mejía Mira #14</p>
    <p>Redes sociales: <a href="https://www.facebook.com/colegiopadrearrupeoficial">Facebook</a> | <a href="https://www.instagram.com/colegiopadrearrupeoficial/">Instagram</a></p>
    <p>+503 6832 7882 | doctor.house@gmail.com</p>
</footer>

</body>
</html>

