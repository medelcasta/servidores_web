<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php 
        define("TRAMO1", (12450 * 0.19));
        define("TRAMO2", (7749 * 0.24));
        define("TRAMO3", (15000 * 0.3));
        define("TRAMO4", (24800 * 0.37));
        define("TRAMO5", (240000 * 0.45));
    ?>
</head>
<body>
    <form action="" method="get">
        <label>Salario Bruto</label>
        <input type="text" name="bruto">
        <input type="submit" value="Calcular">
    </form>

    <?php 
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $bruto = $_GET["bruto"];
        $impuesto;
        $res;
        if($bruto != ''){
            if($bruto < 12450){
                $impuesto = 12450 * 0.19;
            }else if($bruto >= 12450 && $bruto < 20199){
                $res = $bruto - 12450;
                $impuesto = ($res * 0.24) + TRAMO1;

            }else if($bruto >= 20199 && $bruto < 35199){
                $res = $bruto - 20199;
                $impuesto = ($res * 0.3) + TRAMO2 + TRAMO1;

            }else if($bruto >= 35199 && $bruto < 59999){
                $res = $bruto - 35199;
                $impuesto = ($res * 0.37) + TRAMO3 + TRAMO2 + TRAMO1;

            }else if($bruto >= 59999 && $bruto < 299999){
                $res = $bruto - 59999;
                $impuesto = ($res * 0.45) + TRAMO4 + TRAMO3 + TRAMO2 + TRAMO1;

            }else if($bruto >= 299999){
                $res = $bruto - 299999;
                $impuesto = ($res * 0.47) + TRAMO5 + TRAMO4 + TRAMO3 + TRAMO2 + TRAMO1;
            }

            $misueldo = $bruto - $impuesto;

            echo "<p>TU SUELDO NETO QUEDA EN: $misueldo</p>";
        }else{
            echo "<p>Te faltan datos</p>";
        }
    }
    ?>
</body>
</html>