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
    <div class="container">
        <h1>Elige por donde filtrar</h1>
        <form action="" method="get">
        <div class="form-check">
            <input type="radio" name="type" id="rb1" value="TV">
            <label for="rb1">Serie</label>
        </div>
        <div class="form-check">
            <input type="radio" name="type" id="rb2" value="Movie">
            <label  for="rb2">Película</label>
        </div>
        <div class="form-check">
            <input type="radio" name="type" id="rb3" value="">
            <label for="rb3">Todos</label>
        </div>
        <input class="btn btn-danger" type="submit" value="Filtrar">
        </form>
    </div>
<?php
        $apiUrl = "https://api.jikan.moe/v4/top/anime";
        if(isset($_GET["type"])){
            $type = $_GET["type"];
            $apiUrl = "https://api.jikan.moe/v4/top/anime?type=$type";
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datos = json_decode($respuesta, true);
        $animes = $datos["data"];
        $pagination = $datos["pagination"];
        //print_r($animes);

            if(isset($_GET["page"])){
                $page = $_GET["page"];
                $apiUrl = "https://api.jikan.moe/v4/top/anime?page=$page";
            }else{
                $page = 1;
                $apiUrl = "https://api.jikan.moe/v4/top/anime?page=$page";
            }
        ?>
   
    <div class="container">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Posición</th>
                    <th>Titulo</th>
                    <th>Nota</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($animes as $anime){ ?>
                        <tr>
                            <td><?php echo $anime["rank"]?></td>
                            <td>
                                <a href="anime.php?id=<?php echo $anime["mal_id"] ?>">
                                    <?php echo $anime["title"]?>
                                </a>
                            </td>
                            <td><?php echo $anime["score"]?></td>
                            <td>
                                <img width="100px" src="<?php echo $anime["images"]["jpg"]["image_url"] ?>">
                            </td>
                        </tr>
                    <?php } ?>
            </tbody>
        </table>
        <?php 
            if($pagination["current_page"] > 1){ 
                $anterior = $page - 1;
                ?>
                <a href="https://api.jikan.moe/v4/top_anime?page=<?php echo $anterior;?>"> Anterior</a>
            <?php } 
            if($pagination["has_next_page"]){
                $siguiente = $page + 1;
                ?>
                <a href="https://api.jikan.moe/v4/top_anime?page=<?php echo $siguiente;?>"> Siguiente</a>
            <?php } ?>
        ?>
       
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>