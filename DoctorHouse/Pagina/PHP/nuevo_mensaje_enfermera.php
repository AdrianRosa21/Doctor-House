<?php
include("conexion.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $datos = $_POST['asunto'];
    $doctorr = $_POST['asignar'];

    $sql =  "INSERT INTO gestiona (id_doctor, id_datos) VALUES ('$doctorr', '$datos')";

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
    <title>Asignar nuevo expediente</title>
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
            height: 255px;
            align-content: center;
        }

        .ks {
            text-align: center;
            margin-top: -10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }
        label[for="asunto"]{
            margin-top: 10px;
        }
        .select{
            margin-bottom: 30px;
            margin-top: 20px;
        }

        button {
            background-color: #ff9c7e;
            color: rgb(0, 0, 0);
            border: none;
            border-radius: 3px;
            cursor: pointer;
            height: 30px;
            width: 50px;
            margin-left: 72px;
            align-items: center;
        }

        button:hover {
            background-color: #f3b5fc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="ks">Asigne un doctor al expediente</h3>
        <form action="" method="post">
            <label for="asunto">Número de consulta:</label>
            <input type="number" min="1" id="asunto" name="asunto" required>
            <div class="select">
                <label for="asignar">Identificador del doctor:</label>
                <input type="number" min="1" id="asignar" name="asignar" required>
            </div>
            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>