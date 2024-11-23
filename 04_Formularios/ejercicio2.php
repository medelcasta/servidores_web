<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2/ FORMULARIO</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1);
    ?>
</head>
<body>
    <form action="" method="post">
        <h3>Calculadora de Multiplos</h3>
        <h4>(a, b) y c </h4>
        <p>ej. a=3, b=10 y c=2. Los multiplos son 4,6,8,10</p>
        <label for="a">Extremo 1: </label>
        <input type="text" name="a" id="a">
        <label for="b">Extremo 2: </label>
        <input type="text" name="b" id="b">
        <label for="c">Multiplo: </label>
        <input type="text" name="c" id="c">
        <input type="submit" value="Calcular">
    </form>
    <?php
    if($_SERVER ["REQUEST_METHOD"] == "POST"){
        $a = $_POST["a"];
        $b = $_POST["b"];
        $c = $_POST["c"];
        $inicio = 1;
        $fin = 1;
        $resultado = [];
        if($a != '' and $b != '' and $c != ''){
            if($a > $b){
                $inicio = $b;
                $fin = $a;
            }else{
                $inicio = $a;
                $fin = $b;
            }
            
            for($i = $inicio; $i <= $fin; $i++){
                if($i % $c == 0){
                    $resultado[] = $i;
                }
            }
            echo"Los multiplos son: ";
            for($i = 0; $i <= count($resultado); $i++){
                echo $resultado[$i]. " ";
            }
        }else{
            echo "<p>Falta información</p>";
        }
    }
    ?>
</body>
</html>