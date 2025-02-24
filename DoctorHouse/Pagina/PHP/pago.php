
<?php
include("conexion.php");
session_start();
if ($_SERVER['REQUEST_METHOD']=='POST'){
$propietario=$_POST['propietario'];
$numtarjeta=$_POST['numero-tarjeta'];
$vencimiento=$_POST['vencimiento'];
$cvv=$_POST['cvv'];
$id_usuario=$_SESSION['id_paciente'];

$sql = "INSERT INTO metodo_pago (nombre_propietario,num_tarjeta,fecha_exp,cvv,id_paciente)
            VALUES ('$propietario', '$numtarjeta', '$vencimiento','$cvv','$id_usuario')";






if ($conn->query($sql) === TRUE) {
    header("Location: index_pac.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


}
$conn->close();


?>








<!DOCTYPE html>
<html lang="es">
<head>
   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago</title>
    <link rel="icon" href="../image/unnamed.png">
    <link rel="stylesheet" href="../CSS/pay.css">
</head>
<body>
    <header>
        <img alt="Logo de DoctorHouse" height="100" src="../image/unnamed.png" width="100">
        <h1>Bienvenidos a DoctorHouse: Cuidado Médico a tu Alcance</h1>
    </header>
<main>
    <div class="subscription">
        <h2>Suscripción Premium</h2>
       
        <p>Acceso ilimitado a consultas médicas virtuales, recetas digitales y más.</p>
        <p>Contamos con un servicio de calidad, donde pondremos todo nuestro empeño en atenderte.</p>
        <img src="../image/pays.png" alt=""><p><strong>$19.99/mes</strong></p>
        <h5> No se reembolsarán pagos por periodos de facturación parciales. Puedes cancelar tu suscripción en cualquier momento desde tu cuenta.</h5> <!-- Lo agarre de youtube premiun KDJKAJSDASKJ -->
   
     </div>


     <div class="metodo_de_pago">
        <h2>Información de Pago</h2>
        <form action="" method="post">
            <label for="propietario">Nombre del propietario:</label>
            <input type="text" id="propietario" name="propietario" required>


            <label for="numero-tarjeta">Número de tarjeta:</label>
            <input type="text" id="numero-tarjeta" name="numero-tarjeta" required>


            <label for="vencimiento">Fecha de expiración (MM/AA):</label>
            <input type="date" id="vencimiento" name="vencimiento" required>


            <label for="cvv">CVV:</label>
            <input type="password" id="cvv" name="cvv" required>


            <button type="submit" >Pagar</button>
        </form>
    </div>


</main>
<footer>
    <p>Rodrigo Adrián Rosa Rivas #21 | César Daniel Elías Villanueva #8 | Victoria Rebeca Leiva Padilla #11 | William Ariel Mejía Mira #14</p>
    <p>Redes sociales: <a href="https://www.facebook.com/colegiopadrearrupeoficial">Facebook</a> | <a href="https://www.instagram.com/colegiopadrearrupeoficial/">Instagram</a></p>
    <p>+503 6832 7882 | doctor.house@gmail.com</p>
</footer>
</body>
</html>
