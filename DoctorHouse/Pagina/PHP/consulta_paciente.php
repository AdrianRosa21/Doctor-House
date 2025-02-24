<?php
include("conexion.php");
session_start();
$usuario_paciente = $_SESSION['nombre_usuario'];
$sql = "SELECT paciente.id_paciente FROM paciente WHERE usuario = '$usuario_paciente'";
$result = $conn->query($sql);
if ($result === false){
  die("Error en la consulta de doctor: " . $conn->error);
}
$paciente = $result->fetch_assoc();
$paciente_id = $paciente['id_paciente'];
$sql = "SELECT doctor.nombre as nombre, doctor.apellido as apellido, datos.fecha_hora as fecha_hora, doctor.numero_telefono as numero_telefono, datos.sintomas as sintomas, doctor.correo_electronico as correo_electronico, datos.diagnostico as diagnostico, datos.receta as receta FROM gestiona INNER JOIN datos ON gestiona.id_datos = datos.id_datos INNER JOIN paciente ON datos.id_paciente = paciente.id_paciente INNER JOIN doctor ON gestiona.id_doctor = doctor.id_doctor INNER JOIN pertenece ON doctor.id_doctor = pertenece.id_doctor INNER JOIN especialidad ON pertenece.id_especialidad = especialidad.id_especialidad WHERE  paciente.id_paciente = '$paciente_id' ORDER BY datos.fecha_hora DESC";
$result = $conn->query($sql);
if($result === false){
    die ("Error en la consulta: " . $conn->error);
}
?>
<script>
  function n_mensaje(){
    nmen = window.open("http://localhost/DoctorHouse/Pagina/PHP/nuevo_mensaje_paciente.php", "AVISO", "toolbar=0, location=500, status=0, menubar=0, scrollbars=yes, resizable=yes, width=420, height=420 ");
    nmen.open();
  }
</script>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../image/logo.png" type="image/x-icon">
  <title>DoctorHouse</title>
  <style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }
  header {
    background-color: #000000;
    color: white;
    justify-content: center; 
    padding: 20px;
    text-align: center;
    height: 100px;
}
.logo {
    height: 100px;
    width: 100px;
    margin-right: 1100px;
}
header h1 {
    font-size: 30px;
    text-align: center;
    margin-top: -70px;
}
nav {
    background-color: #edecec;
    height: 35px;
    width: 100%;
  }
  
  nav ul {
    list-style: none;
    margin: 0;
    padding: 10px;
    display: flex;
    justify-content: space-around;
  }
  
  nav li {
    margin: 0;
  }
  
  nav a {
    text-decoration: none;
    color: #000000;
  }
  
  .content {
    display: flex;
    background-image: url('../image/fondo.jpg');
    background-size: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    border-radius: 5px;
  }
  
  .important {
    background-color: #ffffff;
    opacity: 70%;
    padding: 20px;
    width: 100%;
  }
  
  .inbox h2, .important h2 {
    margin-bottom: 10px;
  }

  .inbox h2{
    text-align: center;
    margin-top: 0;
    margin-bottom: 15px;
  }

  .inbox{
    background-color: #007bff;
    background-size: auto;
    opacity: 70%;
    padding: 20px;
    height: auto;
  }
  
  .message {
    background-color: #303c8a;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
  }
  
  .message p {
    color: #ffffff;
  }
  
  input[type="button"] {
    background-color: #de94da;
    color: #000000;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  footer {
    background-color: #3D62E5; 
    color: #fff; 
    text-align: center; 
    padding: 20px; 
  }
  
  footer a {
    color: #fff; 
    text-decoration: none; 
  }
  
  footer a:hover {
    text-decoration: underline;
  }
  mark{
    background-color: #56bad1;
  }
  </style>
</head>
<body>
  <header>
    <div class="container">
      <img src="../image/logo.png" alt="DoctorHouse Logo" class="logo">
      <h1>Bienvenidos a DoctorHouse: Cuidado Médico a tu Alcance</h1>
    </div>
  </header>

  <main class="container">
    <nav>
      <ul>
        <li><a href="index_pac.php">Página principal</a></li>
        <li><a href="#">Consultas</a></li>
        <li><a href="perfil_paciente.php">Perfil</a></li>
        <li><a href="recomendaciones.php">Recomendaciones</a></li>
      </ul>
    </nav>
    <section class="content">
      <div class="inbox">
        <input type="button" id="nuevo_mensaje" onclick="n_mensaje()" value="+ Redactar nuevo mensaje">
      </div>

      <div class="important" id="mensajeSeleccionado">
        <div class="message-body">
        <h2><ins>Inbox</ins></h2>
        <?php if ($result->num_rows > 0): ?>
          <?php while ($mensaje = $result->fetch_assoc()): ?>
            <h3><mark>Doctor: <?php echo htmlspecialchars($mensaje['nombre']); ?><?php echo ' ' ?><?php echo htmlspecialchars($mensaje['apellido']); ?></mark></h3>
              <p><b>Fecha y hora: </b><?php echo htmlspecialchars($mensaje['fecha_hora']); ?></p>
              <p><b>Número de teléfono: </b><?php echo htmlspecialchars($mensaje['numero_telefono']); ?></p>
              <p><b>Correo electrónico: </b><?php echo htmlspecialchars($mensaje['correo_electronico']); ?></p>
              <p><b>Síntomas que usted ingresó: </b><?php echo htmlspecialchars($mensaje['sintomas']); ?></p>
              <p><b>Diagnóstico: </b><?php echo htmlspecialchars($mensaje['diagnostico']); ?></p>
              <b>Receta: </b><?php echo htmlspecialchars($mensaje['receta']); ?>
          <?php endwhile; ?>
        <?php else: ?>
          <p>No hay diagnósticos pendientes.</p>
        <?php endif; ?>
        </div>
      </div>
    </section>

    <footer>
        
      <p>Rodrigo Adrián Rosa Rivas #21 | César Daniel Elías Villanueva #8 | Victoria Rebeca Leiva Padilla #11 | William Ariel Mejía Mira #14</p>
      
      <p>Redes sociales: <a href="https://www.facebook.com/colegiopadrearrupeoficial">Facebook</a> | <a href="https://www.instagram.com/colegiopadrearrupeoficial/">Instagram</a></p>
      
      <p>+503 6832 7882 | doctor.house@gmail.com</p>
  </footer>
  </main>
</body>
</html>