<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1);
    ?>
</head>
<body>
    <!--    crea un formulario que reciba un numero  se mostrará la tabla 
            de multiplicar de ese numero en una tabla-->
    <form action="" method="post">
        <input type="text" name="numero" placehold="Numero para la tabla de multiplicar">
        <input type="submit" value="calcular">
    </form>

    <?php         
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $numero =(int) $_POST["numero"];
                    if($numero != ''){
                        for($i = 1; $i<= 10; $i++){ 
                            //hago un array para almacenar los resultados de la multiplicacion
                            $resultados[$i] = $numero *$i;
                        } 
                    }else{
                        echo "<p>Falta información</p>";
                    }
                        ?>
                        <table border=2>
                            <thead>
                                <tr>
                                    <th>Tabla</th>
                                    <th>Resultado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach($resultados as $iterador => $resultado){ ?>
                                    <tr>
                                        <td>
                                            <!--Nuestro num X 1 = , el 1 va cambiando
                                            el array resultado tiene como clave i que es un numero (empieza en 1)
                                            y usamos esa clave como iterador para mostrarla como lo que multiplica al 
                                            numero introducido 
                                            -->

                                            <?php echo "$numero" . "X" . $iterador . " = " ?>
                                        </td>
                                        <td>
                                            <?php echo "$resultado" ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    
                <?php
                    
                }
                ?>
            </tr>

   
</body>
</html>