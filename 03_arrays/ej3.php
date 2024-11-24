<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $paises = ["Italy"=>"Rome", "Luxembourg" =>"Luxembourg" , "Belgium"=>
    "Brussels" , "Denmark"=>"Copenhagen" , "Finland"=>"Helsinki" , "France" =>
    "Paris", "Slovakia" =>"Bratislava" , "Slovenia" =>"Ljubljana" , "Germany" =>
    "Berlin", "Greece" => "Athens", "Ireland"=>"Dublin",
    "Netherlands" =>"Amsterdam" , "Portugal" =>"Lisbon", "Spain"=>"Madrid",
    "Sweden"=>"Stockholm" , "United Kingdom" =>"London", "Cyprus"=>"Nicosia",
    "Lithuania" =>"Vilnius", "Czech Republic" =>"Prague", "Estonia"=>"Tallin",
    "Hungary"=>"Budapest" , "Latvia"=>"Riga", "Malta"=>"Valetta", "Austria" =>
    "Vienna", "Poland"=>"Warsaw"];
    ?>
    <table border="1">
        <thead>
            <tr>
                <td>Pais</td>
                <td>Capital</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($paises as $pais => $capital) { ?>
            <tr>
                <td><?php echo $pais?></td>
                <td><?php echo $capital?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>