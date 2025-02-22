
<?php
session_start(); // Iniciar la sesión

// Verificar si los datos del doctor están en la sesión
if (isset($_SESSION['doctor_nombre'])) {
    $doctor_nombre = $_SESSION['doctor_nombre'];
    $doctor_apellido = $_SESSION['doctor_apellido'];
    $doctor_telefono = $_SESSION['doctor_telefono'];
    $doctor_correo = $_SESSION['doctor_correo'];
    $doctor_especialidad = $_SESSION['doctor_especialidad'];
    
    
} else {
    echo "No se encontraron los datos del doctor.";
    exit();
}
?>




<html>
 <head>
  <title>DoctorHouse: Cuidado Médico a tu Alcance</title>
  <link href="../CSS/estilo.css" rel="stylesheet"/>
  <link rel="icon" href="../image/unnamed.png">
 </head>
 <body>
  
  <dialog id="modal" class="modal">
    <h2>¡Estas a punto de cerrar sesión!</h2>
    <p>.</p>
    <button onclick="window.modal.close();">Volver a perfil</button>
    <button><a href="index.html">Aceptar</a></button>
  </dialog>

  <header>
    <img alt="Logo de DoctorHouse" height="100" src="../image/unnamed.png" width="100"/>
    <div class="perfil1">
      <a href="Doc_Perfil.html"><img alt="foto de perfil" src="../image/perfil.png"></a>
  </div>
  </header>

  <div class="nav">
    <ul>
      <li><a href="index_doctor.php">Página principal</a></li>
      <li><a href="consulta_doctor.html">Consultas</a></li>
      <li><a href="Doc_Perfil.html">Perfil</a></li>
    </ul>
  </div>

  <div class="main-content">
    <h2><b>Doctor</b></h2>
    
    <div class="profile">
      <img alt="Imagen de perfil del paciente" id="profileImage" height="150" src="../image/bayter.jpg" width="150"/>
      
      <div class="profile-info">
      <h3>Dr. <?php echo $doctor_nombre . " " . $doctor_apellido; ?> </h3>
        <p>Teléfono:<?php echo $doctor_telefono ?> </p>
        <p>Correo Electrónico:<?php echo $doctor_correo?> </p>
        <p>Especialidad: <?php echo $doctor_especialidad  ?></p>
        <p>Consultorio: [Dirección de la Consulta]</p>
        <p>Horario de Atención: [Horario Laboral]</p>
      </div>
    </div>
  </div>


  <button class="upload-button" onclick="document.getElementById('imageInput').click()">Subir Foto de Perfil</button>
  <input type="file" id="imageInput" style="display: none;" />

  <script>
    const profileImage = document.getElementById('profileImage');
    const imageInput = document.getElementById('imageInput');

    imageInput.addEventListener('change', (e) => {
      const file = imageInput.files[0];
      const reader = new FileReader();

      reader.onload = (event) => {
        profileImage.src = event.target.result;
      };

      reader.readAsDataURL(file);
    });
  </script>

  <button class="logout-button" onclick="window.modal.showModal();">Cerrar Sesión</button>

 </body>
 
 <footer>
   <p>Rodrigo Adrián Rosa Rivas #21 | César Daniel Elías Villanueva #8 | Victoria Rebeca Leiva Padilla #11 | William Ariel Mejía Mira #14</p>
   <p>Redes sociales: 
     <a href="https://www.facebook.com/colegiopadrearrupeoficial">Facebook</a> | 
     <a href="https://www.instagram.com/colegiopadrearrupeoficial/">Instagram</a>
   </p>
   <p>+503 6832 7882 | doctor.house@gmail.com</p>
 </footer>
</html>