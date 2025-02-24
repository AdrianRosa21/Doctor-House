<?php
include("conexion.php");
session_start();
$usuario_paciente = $_SESSION['nombre_usuario'];
$sql = "SELECT id_paciente FROM paciente WHERE usuario = '$usuario_paciente'";
$result = $conn->query($sql);
if ($result === false){
  die("Error en la consulta de doctor: " . $conn->error);
}
$paciente = $result->fetch_assoc();
$paciente_id = $paciente['id_paciente'];
$sql = "SELECT id_enfermera FROM paciente WHERE id_paciente = '$paciente_id'";
$result = $conn->query($sql);
if ($result === false){
  die("Error en la consulta de doctor: " . $conn->error);
}
$enfermera = $result->fetch_assoc();
$enfermera_id = $enfermera['id_enfermera'];
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sintoma = $_POST['mensaje'];
    $sql =  "INSERT INTO datos (sintomas, id_paciente, id_enfermera) VALUES ('$sintoma', '$paciente_id', '$enfermera_id')";

    if ($conn->query($sql)===TRUE){
        echo "Registro exitoso.";
    }
    else{
        echo "Error: " . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje Nuevo</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f0f0;
        }

        .container {
            background-color: #ffb7c9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 200px;
            height: 250px;
            align-content: center;
        }

        .ks {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        label {
            display: block;
            height: 15px;
            width: 10px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        textarea {
            height: 150px;
            resize: vertical;
        }

        button {
            background-color: #ff9c7e;
            color: rgb(0, 0, 0);
            border: none;
            border-radius: 3px;
            cursor: pointer;
            height: 30px;
            width: 50px;
            margin-left: 75px;
            align-items: center;
            margin-top: 15px;
        }

        button:hover {
            background-color: #f3b5fc;
        }
        label[for="mensaje"]{
            margin-bottom: 0px;
            margin-top: -5px;
            width: 300px;
        }
        .pedi{
            width: 220px;
            margin-top: -10;
            margin-bottom: -10px;
        }
        .si{
            margin-top: 0px;
            margin-bottom: 0px;
        }
        .si {
            display: inline-block;
            margin-right: 0px;
        }
        .pediatra{
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h5 class="ks">Nueva consulta</h5>
        <form method="post">

            <label for="mensaje"><h6>Ingrese sus síntomas:</h6></label>
            <textarea id="mensaje" name="mensaje" required></textarea>

            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>