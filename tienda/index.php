<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );  
        require('./util/conexion.php');

        session_start();
        if(isset($_SESSION["usuario"])){
            echo "<h2>Bienvenid@ ". $_SESSION["usuario"] ."</h2>";
        }else{
            echo "<h2>Usuario Invitado</h2>";
        }
    ?>
</head>
<body>
<div class="container">
        <h1>Pagina Principal</h1>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $id_producto = $_POST["id_producto"];
                //borrar el producto
                $sql = "DELETE FROM productos WHERE id_producto = $id_producto";
                $_conexion -> query($sql);
            }
            $sql = "SELECT * FROM productos";
            $resultado = $_conexion -> query($sql); 

        ?>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Categoria</th>
                    <th>Stock</th>
                    <th>Imagen</th>
                    <th>Descripcion</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    while($fila = $resultado -> fetch_assoc()){ //trata el resultado como un array asociativo
                        echo "<tr>";
                        echo "<td>" . $fila["nombre"] ."</td>";
                        echo "<td>" . $fila["precio"] ."</td>";
                        echo "<td>" . $fila["categoria"] ."</td>";
                        echo "<td>" . $fila["stock"] ."</td>";
                ?>
                        <td>
                            <img width="100" height="200" src="./imagenes/<?php echo $fila["imagen"] ?> ">
                        </td>
                        <?php
                        echo "<td>" . $fila["descripcion"] ."</td>";
                        ?>
                        
                        <?php
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <?php
        if(isset($_SESSION["usuario"])){ ?>
            <a class="btn btn-warning" href="./usuario/cerrar_sesion.php">Cerrar Sesion</a>
            <a class="btn btn-secondary" href="./categorias/index.php">Ir a Categorias</a>
            <a class="btn btn-secondary" href="./productos/index.php">Ir a Productos</a>
        <?php }else{?>
            <a class="btn btn-warning" href="./usuario/iniciar_sesion.php">Iniciar Sesion</a>
        <?php }
        ?>
        
        <br><br>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>