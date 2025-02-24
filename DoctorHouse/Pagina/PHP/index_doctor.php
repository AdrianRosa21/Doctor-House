<?php
include("conexion.php");
session_start(); // Iniciar la sesión

?>

<!DOCTYPE html>
<html lang="es">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DoctorHouse: Cuidado Médico</title>
    <link rel="icon" href="../image/unnamed.png">
    <link rel="stylesheet" href="../CSS/styles.css">
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
            <li><a href="gestionar_recomendaciones.php">Recomendaciones</a></li>
            
        </ul>
    </nav>
    
    
    <main>
        <section class="info">
            <div class="image">
                <img src="../image/doctorpc.jpg" alt="Consulta Médica Virtual">
            </div>
            <div class="brindamos">
                <h2>¿Qué brindamos?</h2>
                <p>DoctorHouse, una empresa de telemedicina que ofrece consultas médicas virtuales.</p>
            </div>
        </section>
        <section class="mission-vision">
            <div class="mission">
                <h2>Misión</h2>
                <p>Nuestra misión en DoctorHouse es proporcionar atención médica de alta calidad y accesible a través de servicios de telemedicina.</p>
            </div>
            <div class="vision">
                <h2>Visión</h2>
                <p>Ser el líder en telemedicina en la región, reconocidos por nuestra innovación, accesibilidad y compromiso con la excelencia en el cuidado de la salud.</p>
            </div>
        </section>

        
        
    </main>

    <footer>
        <p>Rodrigo Adrián Rosa Rivas #21 | César Daniel Elías Villanueva #8 | Victoria Rebeca Leiva Padilla #11 | William Ariel Mejía Mira #14</p>
        <p>Redes sociales: <a href="https://www.facebook.com/colegiopadrearrupeoficial">Facebook</a> | <a href="https://www.instagram.com/colegiopadrearrupeoficial/">Instagram</a></p>
        <p>+503 6832 7882 | doctor.house@gmail.com</p>
    </footer>
</body>
</html>
