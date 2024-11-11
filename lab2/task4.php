<?php

$num1=10;
$num2=20;
$num3=30;

if($num1>$num2 && $num2>$num3){
    echo("The largest number is $num1 <br>");
}

elseif($num2>$num1 && $num1>$num3){
    echo("The largest number is $num2 <br>");
}

else{
    echo("The largest number is $num3 <br>");
}

for($i=10; $i<=100; $i++){
    if($i%2!==0){
        echo(("$i <br>"));
    }
}

?>