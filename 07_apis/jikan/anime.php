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
        $id = $_GET["id"];
        $apiUrl = "https://api.jikan.moe/v4/anime/$id/full";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datos = json_decode($respuesta, true);
        $anime = $datos["data"];
        //print_r($animes);
    ?>
    <div class="container">
        <h1><?php echo $anime["title"] ?></h1>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Imagen</th>
                    <th>Nota</th>
                    <th>Sinopsis</th>
                    <th>Lista de Generos</th>
                    <th>Trailer</th>
                    <th>Animes Relacionados</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img width="100px" src="<?php echo $anime["images"]["jpg"]["image_url"] ?>"></td>
                    <td><?php echo $anime["score"] ?></td>
                    <td><?php echo $anime["synopsis"] ?></td>
                    <td>
                        <ul>
                            <?php 
                            $genres = $anime["genres"];
                            foreach($genres as $genre){ ?>
                                <li><?php echo $genre["name"]; ?></li>
                            <?php } ?>
                        </ul>
                    </td>
                    <td><iframe src="<?php echo $anime["trailer"]["embed_url"] ?>"></iframe></td>
                    <td>
                        <ul>
                        <?php 
                            $relations = $anime["relations"];
                            foreach($relations as $relation){
                                $entries = $relation["entry"]; 
                                foreach($entries as $entry){
                                    if($entry["type"] == "anime") { ?>
                                        <li>
                                            <a href="anime.php?id=<?php echo $entry["mal_id"]?>">
                                                <?php echo $entry["name"] ?>
                                            </a>
                                        </li>          
                                     <?php }
                                }
                            } ?>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>