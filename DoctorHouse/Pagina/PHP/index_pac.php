<?php
include("conexion.php");
session_start();
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

        <!-- Sección de especialidades -->
        <section class="specialties">
            <div class="espec-box">
                <h3>Especialidades</h3>
                <div class="carousel">
                    <div class="carousel-track">
                        <div class="carousel-slide">
                            <h3>Pediatría</h3>
                            <img src="../image/pediatria.png" alt="Pediatría">
                        </div>

                        <div class="carousel-slide">
                            <h3>Cardiología</h3>
                            <img src="../image/cardiologia.png" alt="corazon_representativo">
                        </div>

                        <div class="carousel-slide">
                            <h3>Ortopedía</h3>
                            <img src="../image/ortopedia.png" alt="pies_radiografia">
                        </div>

                        <div class="carousel-slide">
                            <h3>Psiquiatría</h3>
                            <img src="../image/psiquiatria.png" alt="revision_pensamiento">
                        </div>
                        

                        <div class="carousel-slide">
                            <h3>Neurología</h3>
                            <img src="../image/neurologia.png" alt="salud_cerebral">
                        </div>

                        <div class="carousel-slide">
                            <h3>Geriatría</h3>
                            <img src="../image/geriatria.png" alt="cuidado_a_mayores">
                        </div>

                        <div class="carousel-slide">
                            <h3>Reumatología</h3>
                            <img src="../image/reumatologia.png" alt="cuidado_articulaciones">
                        </div>

                        <div class="carousel-slide">
                            <h3>Urología</h3>
                            <img src="../image/urologia.png" alt="cuidado_de_rinones">
                        </div>

                        <div class="carousel-slide">
                            <h3>Oncología médica</h3>
                            <img src="../image/oncologia.png" alt="prevencion_del_cancer_de_seno">
                        </div>

                        <div class="carousel-slide">
                            <h3>Medicina general</h3>
                            <img src="../image/medicina_general.png" alt="medicina_general">
                        </div>

                    </div>
                </div>
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
