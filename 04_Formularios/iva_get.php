<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1);
        define("GENERAL", 1.21);
        define("REDUCIDO", 1.1);
        define("SUPERREDUCIDO", 1.04);
    ?>
</head>
<body>
    <!--
        GENERAL = 21%
        REDUCIDO = 10%
        SUPERREDUCIDO = 4%
    -->
        <form action="" method="get">
            <label for="precio">Precio</label>
            <input type="text" name="precio" id="precio">
            <br><br>
            <select name="iva">
                <option value="general">General</option>
                <option value="reducido">Reducido</option>
                <option value="superreducido">Superreducido</option>
            </select>
            <input type="submit" value="Calcular">
        </form>

        <?php 
        //isset (is set) devuelve true si la variable existe
        //por defecto $_get["precio"] por ejemplo no existe solo existe cuando se le da al boton
        if(isset($_GET["precio"]) and isset($_GET["iva"])){
            $precio = $_GET["precio"];
            $iva = $_GET["iva"];

            //var_dump($precio);
            //var_dump($iva);
            if($precio != '' and $iva != ''){
                $pvp = match($iva){
                    "general" => $precio * 1.21,
                    "reducido" => $precio * 1.1,
                    "superreducido" => $precio * 1.04,
                };
                echo "<h1>El PVP seria: $pvp</h1>";
            }else{
                echo "<p>Te faltan datos</p>";
            }
        }
        ?>
</body>
</html>