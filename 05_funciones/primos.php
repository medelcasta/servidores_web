<?php 

function calcularPrimos(int $num1, int $num2): string{
    if($num1 > $num2){
        $menor = $num2;
        $mayor = $num1;
    }else{
        $menor = $num1;
        $mayor = $num2;
    }
    echo "Los numeros primos son: ";
    for($j = $menor; $j<= $mayor; $j++){
        if ($j == 2){
            return $j . " ";
            $cont++;  
        }
        else{   
            for($i = $menor; $i < $j; $i++){
                if($j % $i == 0){
                    $esPrimo = false;
                    break;
                }
            }
            if($esPrimo){
                return $j . " ";
                $cont++;
            }
            else{
                $esPrimo = true;
            }
        }        
    }
}

?>