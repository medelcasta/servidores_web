<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Conversor de Temperaturas</h3>
    <form action="" method="post">
        <label for="temp">Introduce la temperatura</label>
        <input type="text" name="temp" id="temp">
        <select name="origen">
            <option value="celsius">Celsius</option>
            <option value="fahrenheit">Fahrenheit</option>
            <option value="kelvin">Kelvin</option>
        </select>
        <br>
        <p>Convertir a 
        <select name="destino">
            <option value="celsius">Celsius</option>
            <option value="fahrenheit">Fahrenheit</option>
            <option value="kelvin">Kelvin</option>
        </select>
        <input type="submit" value="Convertir"> </p>
    </form>

    <?php 
    if($_SERVER["REQUEST_METHOD"]== "POST"){
        $temp = $_POST["temp"];
        $origen = $_POST["origen"];
        $destino = $_POST["destino"];
        $conversion;
        if($temp != '' and $origen != '' and $destino != ''){
            $conversion = match ($origen) {
                "celsius" => match($destino){
                    "fahrenheit"=> ($temp * (9/5)) +32,
                    "kelvin"=> $temp + 273,
                    "celsius" => $temp,
                },
                "fahrenheit" => match($destino){
                    "celsius"=> ($temp - 32) * (5/9),
                    "kelvin"=> ($temp -32) * (5/9) + 273,
                    "fahrenheit" => $temp,
                },
                "kelvin"=> match($destino){
                    "celsius"=>$temp - 273,
                    "fahrenheit"=> ($temp -273) * (9/5) + 32,
                    "kelvin" => $temp,
                },
            };
            echo "Resultado: " .$conversion;
        }else {
            echo "<p>falta información</p>";
        }
    }
    ?>
</body>
</html>