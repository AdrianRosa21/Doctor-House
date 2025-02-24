<?php
include("conexion.php");
session_start();

$Nombre = $_POST["nombre"];
$Apellidos = $_POST["apellido"];
$edad = $_POST["edad"];
$telefono = $_POST["telefono"];
$email = $_POST["email"];
$usuario = $_POST["nombre_usuario"];
$contraseña = $_POST["password"];
$historial = $_POST["historial"];

$numEnfer = rand(1,10);

$sql = "
        INSERT INTO paciente (id_enfermera,nombre,apellido,numero_telefono,correo_electronico,fecha_nacimiento,usuario,contraseña,historial_medico)
        VALUES ('$numEnfer', '$Nombre', '$Apellidos','$telefono','$email', '$edad','$usuario', '$contraseña', '$historial')";

if(mysqli_query($conn,$sql)){
        $_SESSION['nombre_usuario']=$usuario;
// Obtener el último ID insertado (id_paciente)
$id_paciente = mysqli_insert_id($conn);

// Guardar el id_paciente en una variable de sesión
$_SESSION['id_paciente'] = $id_paciente;
}else{
         die("Problemas en el queri: ".mysqli_error($conn));}
header("Location: pago.php");
mysqli_close($conn);

?>