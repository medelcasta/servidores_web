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
    <form method="GET">
        <label>¿Cuántos pokémons quieres mostrar?</label>
        <input type="number" name="limit">
        <input type="submit" value="Mostrar">

    </form>
    <?php
        
        $apiUrl = "https://pokeapi.co/api/v2/pokemon/?limit=5";

        

        if(isset($_GET["limit"])){
            $limit = $_GET["limit"];
            $apiUrl = "https://pokeapi.co/api/v2/pokemon/?limit=$limit";
        }

        $offset = '';
       
        $apiUrl = "https://pokeapi.co/api/v2/pokemon/?offset=$offset&limit=$limit";
            
        
        // Realizar la solicitud a la API
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $resultados = json_decode($respuesta, true);
        $pokemons = $resultados["results"];
        $pag_anterior = $resultados["previous"];
        $pag_siguiente = $resultados["next"];
      

    ?>
    
    <table>
        <thead>
            <tr>
                <th>Pokemon</th>
                <th>Imagen</th>
                <th>Tipos</th>
            </tr>
        </thead>
        <tbody>  
    
        <?php 
        
        foreach($pokemons as $pokemon){            
        $nombre = $pokemon["name"];
        $nombre = ucfirst($nombre) ?>
        <tr>
        <td>
            <?php echo $nombre; ?>
            
        </td>   <?php
        if(isset($pokemon["url"])){
            $url = $pokemon["url"];
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $respuesta = curl_exec($curl);
            curl_close($curl);

            $resultados = json_decode($respuesta, true);
            $otros = $resultados["sprites"]["front_default"];
            $tipos = $resultados["types"];

        }
         ?>
        
        <td>
            <img src="<?php echo $otros ?>" >
        </td>
        <td>
        <?php foreach($tipos as $tipo){ 
            $clases = $tipo["type"]["name"]; 
            $clase = ucfirst($clases);
            echo ucfirst($clases) . " ";
         } ?> </td>
        
        <?php }  ?>
         
        </tbody>
    </table>


    <div>
        <?php if ($pag_anterior == null) { ?>
            <a href="">Anterior</a>
        <?php } ?>
        <?php if ($pag_siguiente) { ?>
            <a href="">Siguiente</a>
        <?php } ?>
    </div>
    
</body>
</html>