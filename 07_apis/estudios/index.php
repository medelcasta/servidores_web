<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php 
    error_reporting( E_ALL );
    ini_set("display_errors", 1 );  
    ?>
</head>
<body>
    <div>
        <form class="col-6" action="" method="get" enctype="multipart/form-data">
                <h1>Formulario</h1>
                <div class="mb-3">
                    <label class="form-label">Ciudad</label>
                    <input class="form-control" type="text" name="ciudad">
                </div>
                <div class="mb-3">
                    <input class="btn btn-primary" type="submit" value="Buscar">
                </div>          
        </form>    
    </div>
    
    <?php 
        $apiUrl = "http://localhost/Ejercicios/07_apis/estudios/api_estudios.php";

        if(!empty($_GET["ciudad"])) {
            $ciudad = $_GET["ciudad"];
            $apiUrl = "$apiUrl?ciudad=$ciudad";
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $estudios = json_decode($respuesta, true);
        //print_r($estudios);
    ?>
    <div class="container">

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Estudio</th>
                <th>Ciudad</th>
                <th>Año de fundacion</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($estudios as $estudio){ ?>
                    <tr>
                        <td><?php echo $estudio["nombre_estudio"]?></td>
                        <td><?php echo $estudio["ciudad"]?></td>
                        <td><?php echo $estudio["anno_fundacion"]?></td>
                    </tr>
                <?php } ?>
        </tbody>
    </table>
    </div>
    <?php 
        /**
         * 1. Crear un formulario con get que mande la ciudad
         * 2. Recogemos la ciudad con get
         * 3. Si se ha mandado alguna ciudad, a la API_URL le concatenamos la ciudad para 
         * que la api devuelve los estudios filtrados.
         */
    ?>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>