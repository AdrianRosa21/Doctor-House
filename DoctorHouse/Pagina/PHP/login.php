<?php
session_start();

$servername="localhost";
$username="root";
$password="";
$dbname="doctorhouse1";

$conn = new mysqli($servername,$username, $password, $dbname);

if($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

if ($role == 'paciente') {
    $sql = "SELECT * FROM paciente WHERE (usuario = '$username' OR correo_electronico = '$username') AND contraseña = '$password'";
} elseif ($role == 'doctor') {
    $sql = "SELECT * FROM doctor WHERE (usuario = '$username' OR correo_electronico = '$username') AND contraseña = '$password'";
} elseif ($role == 'enfermera') {
    $sql = "SELECT * FROM enfermera WHERE (usuario = '$username' OR correo_electronico = '$username') AND contraseña = '$password'";
}

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // El usuario existe, redirige según el rol
    if ($role == 'paciente') {

        $paciente = $result->fetch_assoc();
        $_SESSION['paciente_nombre'] = $paciente['nombre'];
        $_SESSION['paciente_apellido'] = $paciente['apellido'];
        $_SESSION['paciente_telefono'] = $paciente['numero_telefono'];
        $_SESSION['paciente_correo'] = $paciente['correo_electronico'];
        $_SESSION['paciente-id'] = $paciente['id_paciente'];

        header("Location: http://localhost/DoctorHouse/Pagina/Html/index_pac.html");
    } elseif ($role == 'doctor') {

        $doctor = $result->fetch_assoc();
        $_SESSION['doctor_nombre'] = $doctor['nombre'];
        $_SESSION['doctor_apellido'] = $doctor['apellido'];
        $_SESSION['doctor_telefono'] = $doctor['numero_telefono'];
        $_SESSION['doctor_correo'] = $doctor['correo_electronico'];

        header("Location:  http://localhost/DoctorHouse/Pagina/Html/index_doctor.php");
    } elseif ($role == 'enfermera') {

        $enfermera = $result->fetch_assoc();
        $_SESSION['enfermera_nombre'] = $enfermera['nombre'];
        $_SESSION['enfermera_apellido'] = $enfermera['apellido'];
        $_SESSION['enfermera_telefono'] = $enfermera['numero_telefono'];
        $_SESSION['enfermera_correo'] = $enfermera['correo_electronico'];

        header("Location: http://localhost/DoctorHouse/Pagina/Html/index_enfermera.html");
    }
    exit();
} else {
    // Si no hay resultados
    echo "Usuario o contraseña incorrectos para el rol seleccionado.";
}

$conn->close();
?>

