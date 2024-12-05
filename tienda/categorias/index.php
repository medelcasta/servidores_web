<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );  
        require('../util/conexion.php');
        require '../util/depurar.php';

        session_start();
        if(isset($_SESSION["usuario"])){
            echo "<h2>Bienvenid@ ". $_SESSION["usuario"] ."</h2>";
        }else{
            header("location: ../usuario/iniciar_sesion.php");
            exit;
        }
    ?>
</head>
</head>
<body>
<div class="container">
        <h1>Las Categorias</h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php">Inicio</a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="nueva_categoria.php">Nueva Categoria</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../productos/index.php">Ir a Productos</a>
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
                $categoria = depurar($_POST["categoria"]);
                $sql = "SELECT * FROM productos WHERE categoria = '$categoria'";
                $resultado = $_conexion -> query($sql);

                if($resultado -> num_rows >= 1){
                    $err_delete = "Esta categoria tiene asociada un producto, para poder eliminarla elimina antes los productos";
                }else{
                    $sql = "DELETE FROM categorias WHERE categoria = '$categoria'";
                    $_conexion -> query($sql);
                }
            }
            $sql = "SELECT * FROM categorias";
            $resultado = $_conexion -> query($sql); 

        ?>

        

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Categoria</th>
                    <th>Descripcion</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    while($fila = $resultado -> fetch_assoc()){ //trata el resultado como un array asociativo
                        echo "<tr>";
                        echo "<td>" . $fila["categoria"] ."</td>";
                        echo "<td>" . $fila["descripcion"] ."</td>";
                        ?>
                        <td>
                            <a class="btn btn-primary"  href="editar_categoria.php?categoria=<?php echo $fila["categoria"] ?>">Editar</a>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="categoria" value="<?php echo $fila["categoria"] ?>" > <!--COGENOS EL ID-->
                                <input class="btn btn-danger" type="submit" value="Borrar">
                            </form>
                        </td>
                        <?php
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <?php if(isset($err_delete)) "<span class='error'> $err_delete </span>"?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>