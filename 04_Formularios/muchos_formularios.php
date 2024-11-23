<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php 
        require('../05_funciones/potencias.php');
        require('../05_funciones/primos.php');
        require('../05_funciones/irpf.php');
        require('../05_funciones/iva.php');
        error_reporting( E_ALL );
        ini_set( "display_errors", 1);
    ?>
</head>
<body>
    <form action="" method="post">
        <h3>Potencias</h3>
        <label for="base">Base</label>
        <input type="text" name="base" id="base" placeholder="Introduce la base">
        <label for="exponente">Exponente</label>
        <input type="text" name="exponente" id="exponente" placeholder="Introduce el exponente">
        <input type="hidden" name="accion" value="formulario_potencias">
        <input type="submit" value="Calcular">
    </form>
    <?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $tmp_base = $_POST["base"];
        $tmp_exponente = $_POST["exponente"];

        /*FORMA SUCIA
        if($tmp_base != ''){
            if(filter_var($tmp_base, FILTER_VALIDATE_INT) !== FALSE){
                $base = $tmp_base;
            }else{
                echo "<p>La base debe ser un número</p>";
            }
        }else{
            echo "<p>La base es obligatoria</p>";
        }*/

        //FORMA LIMPIA
        if($tmp_base == ''){
            echo "<p>La base es obligatoria</p>";
        }else{
            if(filter_var($tmp_base, FILTER_VALIDATE_INT) == FALSE){
                echo "<p>La base debe ser un número</p>";
            }else{
                $base = $tmp_base;
            }
        }
        /*
        if($tmp_exponente != ''){
            if(filter_var($tmp_exponente, FILTER_VALIDATE_INT) !== FALSE){
                if($tmp_exponente >= 0){
                    $exponente = $tmp_exponente;
                }else{
                    echo "<p>El exponente debe ser mayor o igual que cero</p>";
                }
            }else{
                echo "<p>El exponente debe ser un número</p>";
            }
        }else{
            echo "<p>El exponente es obligatoria</p>";
        }*/
        //FORMA LIMPIA
        if($tmp_exponente == ''){
            echo "<p>La base es obligatoria</p>";
        }else{
            if(filter_var($tmp_exponente, FILTER_VALIDATE_INT) == FALSE){
                echo "<p>La base debe ser un número</p>";
            }else{
                if($tmp_exponente < 0){
                    echo "<p>El exponente debe ser mayor o igual que cero</p>";
                }else{
                    $exponente = $tmp_exponente;
                }
            }
        }
        
        //isset comprueba que la variable se ha definido
        if(isset($base) && isset($exponente)){
            //calculo la pontencia
            $resultado = calcularPotencia($base, $exponente);
            echo "<h1>El resultado es $resultado</h1>";
        }
    }
        
    ?>

    <form action="" method="post">
        <h3>Calculadora de Primos</h3>
        <label for="num1">Número 1: </label>
        <input type="text" name="num1" id="num1">
        <label for="num2">Número 2: </label>
        <input type="text" name="num2" id="num2">
        <input type="hidden" name="accion" value="formulario_potencias">
        <input type="submit" value="calcular">
    </form>

    <?php 
        $num1 = $_POST["num1"];
        $num2 = $_POST["num2"];
        $mayor;
        $menor;
        $esPrimo = true;
        $cont = 0;
        calcularPrimos($num1, $num2);
    ?>

    <form action="" method="post">
        <h3>Calculadora de IRPF</h3>
        <label>Salario Bruto</label>
        <input type="text" name="bruto">
        <input type="submit" value="Calcular">
    </form>

    <?php 
        if($_SERVER["REQUEST_METHOD"] == "POST"){
        $tmp_bruto = $_POST["bruto"];
        if($tmp_bruto != ''){
            if(filter_var($tmp_exponente, FILTER_VALIDATE_FLOAT) !== FALSE){
                if($tmp_bruto >= 0){
                    $bruto = $tmp_bruto;
                }else{
                    echo "<p>El salario debe ser mayor o igual que cero</p>";
                }
            }else{
                echo "<p>El salario debe ser un número</p>";
            }
        }else{
            echo "<p>El salario es obligatoria</p>";
        }

        if(isset($bruto)){
            //calculo la pontencia
            $resultado = Salario($bruto);
            echo "<h1>El resultado es $resultado</h1>";
        }
        
        }
    ?>

    <form action="" method="post">
        <h3>IVA</h3>
        <label for="precio">Precio</label>
        <input type="text" name="precio" id="precio">
        <br><br>
        <select name="iva">
            <option>--- Elige un tipo de IVA ---</option>
            <option value="GENERAL">General</option>
            <option value="REDUCIDO">Reducido</option>
            <option value="SUPERREDUCIDO">Superreducido</option>
        </select>
        <input type="submit" value="Calcular">
    </form>

    <?php 
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $tmp_precio = $_POST["precio"];
            $tmp_iva = $_POST["iva"];

            if($tmp_precio != ''){
                if(filter_var($tmp_precio, FILTER_VALIDATE_FLOAT) !== FALSE){
                    if($tmp_precio >= 0){
                        $precio = $tmp_precio;
                    }else{
                        echo "<p>El precio debe ser mayor o igual que cero</p>";
                    }
                }else{
                    echo "<p>El precio debe ser un número</p>";
                }
            }else{
                echo "<p>El precio es obligatoria</p>";
            }

            if($tmp_iva == ''){
                echo "<p>El iva es obligatorio</p>";
            }else{
                $valores_validos_iva = ["GENERAL", "REDUCIDO", "SUPERREDUCIDO"];
                //if($tmp_iva != "GENERAL" && $tmp_iva != "REDUCIDO" && $tmp_iva != "SUPERREDUCIDO"){
                if(!in_array($tmp_iva, $valores_validos_iva)){
                    echo "<p>EL IVA SOLO PUEDE SER GENERAL, REDUCIDO O SUPERREDUCIDO</p>";
                }else{

                }
            }
    
            if(isset($precio) && isset($iva)){
                //calculo la pontencia
                $resultado = calcularIVA($precio, $iva);
                echo "<h1>El resultado es $resultado</h1>";
            }
        }
            

    ?>

</body>
</html>