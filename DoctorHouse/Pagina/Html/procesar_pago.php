<?php
include("conexion.php");

if ($_SERVER['REQUEST_METHOD']=='POST'){
$propietario=$_POST['propietario'];
$numtarjeta=$_POST['numero-tarjeta'];
$vencimiento=$_POST['vencimiento'];
$cvv=$_POST['cvv'];

$sql = "INSERT INTO metodo_pago (nombre_propietario,num_tarjeta,fecha_exp,cvv) 
            VALUES ('$propietario', '$numtarjeta', '$vencimiento','$cvv')";



if ($conn->query($sql) === TRUE) {
    header("Location: index_pac.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}
$conn->close();


?>
