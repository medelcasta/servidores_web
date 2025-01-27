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
    ?>
</head>
<body>
    <?php 
        $apiUrl = "https://api.jikan.moe/v4/producers";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datos = json_decode($respuesta, true);
        $producer = $datos["data"];
        //print_r($animes);
    ?>
    <div class="container">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Info Productor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php
                            print_r($producer["titles"]);
                            /*
                            foreach($titles as $title){
                                if($title["type"] == "Default") { ?>
                                    <?php echo $title["title"] ?>          
                                <?php }
                            } */ ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>