<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="mensaje">
        <input type="text" name="veces">
        <input type="submit" value="Enviar">
    </form>

    <?php 
    if($_SERVER["REQUEST_METHOD"]== "POST"){
        /**
         * Este codigo se ejecuta cuando el servidor recibe una petición PHP
         */
        $mensaje = $_POST["mensaje"];

        /**
         * Añadir al formulario un campo de texto adicional para introducir un numero
         * mostrar el mensaje tantas veces como indique el numero
         */
        $veces = $_POST["veces"];
        if($mensaje != '' and $veces != ''){
            for($i = 0; $i < $veces; $i++){
                echo "<p>$mensaje</p>";
            }
        }else{
            echo "<p>Faltan datos</p>";
        }

    }
    ?>
</body>
</html>