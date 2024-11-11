<?php
function vat($amount){
    return $amount*0.15+$amount;
}

$amount=200;
echo(vat($amount));



?>