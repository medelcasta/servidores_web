<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potencias</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1);
    ?>
</head>
<body>
    <form action="" method="post">
        <label for="base">Base</label>
        <input type="text" name="base" id="base" placeholder="Introduce la base">
        <label for="exponente">Exponente</label>
        <input type="text" name="exponente" id="exponente" placeholder="Introduce el exponente">
        <input type="submit" value="Calcular">

    </form>
    <?php 
    /**
     * CREAR UN FORMULARIO QUE RECIBA DOS PARAMETROS: BASE Y EXPONENTE
     * 
     * CUANDO SE ENVIE EL FORMULARIO SE CALCULARA EL RESULTADO DE ELEVAR
     * LA BASE AL EXPONENTE
     * 
     * EJEMPLOS:
     * 2 ELEVADO A 3 = 8
     * 3 ELEVADO A 2 = 9
     * 2 ELEVADO A 1 = 2
     * 3 ELEVADO A 0 = 1
     */
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $base = $_POST["base"];
        $exponente = $_POST["exponente"];
        $res = 1;
        if($base != '' and $exponente != ''){
            for($i = 0; $i < $exponente; $i++){
                $res *= $base;
            }
            echo "<h3>El resultado es: $res</h3>";
        }else{
            echo "<p>Te faltan datos</p>";
        }
    }
    ?>
</body>
</html>