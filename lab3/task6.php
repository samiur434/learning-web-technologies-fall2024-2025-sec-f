<?php

$arr2=array(10,20,30,40,50,60,);

$search=30;

foreach($arr2 as $value){
    if($value==$search){
        echo("$value is found in the array <br>");
        break;
    }
    
}

?>