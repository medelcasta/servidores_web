<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $series = [
        ["Malcom in the Middlel", "Disney", 7],
        ["Anatomia the Grey","Netflix",21],
        ["Los Britherton","Netflix",3],
        ["Los Simpson","Antena 3",22],
        ["Futurama","Disney",16],
    ];
    ?>
    <h1>Tabla normal</h1>
    <table>
        <thead>
            <tr>
                <td>Titulo</td>
                <td>Plataforma</td>
                <td>Temporadas</td>
            </tr>
        </thead>
        <tbody>
                <?php foreach($series as $serie){
                 list($titulo, $plataforma, $temporadas) = $serie;?>
                 <tr>
                    <td><?php echo $titulo?></td>
                    <td><?php echo $plataforma ?></td>
                    <td><?php echo $temporadas?></td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
    <h1>Tabla ordenada por temporadas</h1>
    <?php
    $_temporadas = array_column($series, 2);
    array_multisort($_temporadas, SORT_ASC, $series); ?>
    <table>
        <thead>
            <tr>
                <td>Titulo</td>
                <td>Plataforma</td>
                <td>Temporadas</td>
            </tr>
        </thead>
        <tbody>
                <?php foreach($series as $serie){
                 list($titulo, $plataforma, $temporadas) = $serie;?>
                 <tr>
                    <td><?php echo $titulo?></td>
                    <td><?php echo $plataforma ?></td>
                    <td><?php echo $temporadas?></td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
    <h1>Tabla ordenada por plataforma y titulo</h1>
    <?php 
    $_plataforma = array_column($series, 1);
    $_titulo = array_column($series, 0);
    array_multisort($_plataforma, SORT_ASC, $_titulo, SORT_ASC, $series); ?>
    <table>
        <thead>
            <tr>
                <td>Titulo</td>
                <td>Plataforma</td>
                <td>Temporadas</td>
            </tr>
        </thead>
        <tbody>
                <?php foreach($series as $serie){
                 list($titulo, $plataforma, $temporadas) = $serie;?>
                 <tr>
                    <td><?php echo "".$titulo?></td>
                    <td><?php echo "".$plataforma ?></td>
                    <td><?php echo "".$temporadas?></td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
</body>
</html>