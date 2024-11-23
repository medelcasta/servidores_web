<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1);
    ?>
</head>
<body>
    <h1>hola</h1>
    <!--
        EJERCICIO 1: CALCULA LA SUMA DE TODOS LOS NUMEROS PARES DEL 1 AL 20
    -->
    <!--
        EJERCICIO 2: MOSTRAR LA FECHA ACTUAL CON EL SIGUIENTE FORMATO: 
            Viernes 27 de Septiembre de 2024
        UTILIZAR LAS ESTRUCTURAS DE CONTROL NECESARIAS
    --> 
    <?php 
        $semana = date("l");
        $semana = match($semana){
            "Monday" => "Lunes",
            "Tuesday" => "Martes",
            "Wednesday" => "Miercoles",
            "Thursday" => "Jueves",
            "Friday" => "Viernes",
            "Saturday" => "Sábado",
            "Sunday" => "Domingo",
        };

        $mes = date("F");
        $mes = match($mes){
            "January" => "Enero",
            "February" => "Febrero",
            "March" => "Marzo ",
            "April" => "Abril",
            "May" => "Mayo",
            "June" => "Junio",
            "July" => "Julio",
            "August" => "Agosto",
            "September" => "Septiembre",
            "October " => "Octubre",
            "November" => "Noviembre",
            "December" => "Diciembre",
        };
        
        $year = date("Y");
        $dia = date("j");

        echo "$semana $dia de $mes de $year";
    ?>
</body>
</html>