<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label>Introduce la cantidad</label>
        <input type="text" name="cantidad">
        <select name="origen">
            <option value="euro">€</option>
            <option value="dolar">$</option>
            <option value="yen">¥</option>
        </select>
        <label>Cambiar a</label>
        <select name="destino">
            <option value="euro">€</option>
            <option value="dolar">$</option>
            <option value="yen">¥</option>
        </select>
        <input type="submit" value="Calcular">
    </form>

    <?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $cantidad = $_POST["cantidad"];
        $origen = $_POST["origen"];
        $destino = $_POST["destino"];
        $conversion;
        if($cantidad != '' and $origen != '' and $conversion != ''){
            $conversion = match ($origen) {
                "euro" => match($destino){
                    "dolar"=> $cantidad * 1.06 ,
                    "yen"=> $cantidad * 157.56,
                    "euro" => $cantidad,
                },
                "dolar" => match($destino){
                    "euro"=> $cantidad * 0.94,
                    "yen"=> $cantidad * 148.73,
                    "dolar" => $cantidad,
                },
                "yen"=> match($destino){
                    "euro"=>$cantidad * 0.0063,
                    "dolar"=> $cantidad * 0.0067,
                    "yen" => $cantidad,
                },
            };
            echo "Son: " . $conversion;
        }else{
            echo "<p>FALTAN DATOS</p>";
        }
    }
    ?>
</body>
</html>