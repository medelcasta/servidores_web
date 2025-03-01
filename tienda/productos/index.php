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
        require('../util/conexion.php');
        session_start();
        if(isset($_SESSION["usuario"])){
            echo "<h2>Bienvenid@ ". $_SESSION["usuario"] ."</h2>";
        }else{
            header("location: ../usuario/iniciar_sesion.php");
            exit;
        }
    ?>
</head>
<body>
<div class="container">
        <h1>Los Productos</h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php">Inicio</a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="nuevo_producto.php">Nuevo Producto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../categorias/index.php">Ir a Categorias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../usuario/cerrar_sesion.php">Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $id_producto = $_POST["id_producto"];
                //borrar el producto
                /*
                $sql = "DELETE FROM productos WHERE id_producto = $id_producto";
                $_conexion -> query($sql);
                */
                // 1. Preparacion/ Prepare --> le vamos a quitar todas las variables
                $sql = $_conexion -> prepare("DELETE FROM productos WHERE id_producto = ?");

                // 2. Enlazado/ Bind
                $sql -> bind_param("i", $id_producto); //se pone s si es string e i si es int (si hubiera decimales se pone d)

                // 3. Ejecución / Execute
                $sql -> execute();
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
                    <th></th>
                    <th></th>
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
                            <img width="100" height="200" src="../imagenes/<?php echo $fila["imagen"] ?> ">
                        </td>
                        <?php
                        echo "<td>" . $fila["descripcion"] ."</td>";
                        ?>
                        <td>
                            <a class="btn btn-primary"  href="editar_producto.php?id_producto=<?php echo $fila["id_producto"] ?>">Editar</a>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="id_producto" value="<?php echo $fila["id_producto"] ?>" > <!--COGENOS EL ID-->
                                <input class="btn btn-danger" type="submit" value="Borrar">
                            </form>
                        </td>
                        <?php
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>