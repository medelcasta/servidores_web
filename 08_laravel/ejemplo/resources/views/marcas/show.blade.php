<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show</title>
</head>
<body>
    <h1>Marca</h1>
    <h3>Marca: {{$marca -> marca}}</h3>
    <a href="{{route('marcas.edit', ["marca" => $marca -> id])}}">Editar</a>
    <br>
    <a href="{{route('marcas.index')}}">Volver</a>
    
</body>
</html>