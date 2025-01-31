<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Anime</title>
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );    
    ?>
</head>

<body>
    <?php
        // Obtener el tipo seleccionado y la página actual
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        // Construir la URL
        $apiUrl = "https://api.jikan.moe/v4/top/anime?page=$page";
        if (!empty($type)) {
            $apiUrl .= "&type=$type";
        }

        // Realizar la solicitud a la API
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datos = json_decode($respuesta, true);
        $animes = $datos["data"];
        $pagination = $datos["pagination"];
    ?>

    <!-- Tipo -->
    <form method="GET" action="">
        <label>
            <input type="radio" name="type" value="" <?php echo empty($type) ? 'checked' : ''; ?>> Todos
        </label>
        <label>
            <input type="radio" name="type" value="tv" <?php echo $type === 'tv' ? 'checked' : ''; ?>> Serie
        </label>
        <label>
            <input type="radio" name="type" value="movie" <?php echo $type === 'movie' ? 'checked' : ''; ?>> Película
        </label>
        <button type="submit">Filtrar</button>
    </form>

    <!-- Tabla -->
    <table>
        <thead>
            <tr>
                <th>Posición</th>
                <th>Título</th>
                <th>Nota</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($animes as $anime) { ?>
                <tr>
                    <td><?php echo $anime["rank"] ?></td>
                    <td>
                        <a href="anime.php?id=<?php echo $anime["mal_id"] ?>">
                            <?php echo $anime["title"] ?>
                        </a>
                    </td>
                    <td><?php echo $anime["score"] ?></td>
                    <td>
                        <img width="100px" src="<?php echo $anime["images"]["jpg"]["image_url"] ?>">
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Botones de paginación -->
    <div>
        <?php if ($pagination['current_page'] > 1) { ?>
            <a href="?page=<?php echo $page - 1; ?>&type=<?php echo $type; ?>">Página Anterior</a>
        <?php } ?>
        <?php if ($pagination['has_next_page']) { ?>
            <a href="?page=<?php echo $page + 1; ?>&type=<?php echo $type; ?>">Página Siguiente</a>
        <?php } ?>
    </div>
</body>
</html>