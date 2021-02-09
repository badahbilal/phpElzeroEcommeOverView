<?php


$fileName = "bilal.PNG";

$tab = ["png1","jpg"];


/*$tab2= ["png1","jpg2","png","jpg4","png5","jpg6","png7","jpg8"];

echo "<pre>";
print_r($tab2);
echo "</pre>";
$varLast = end($tab2);

echo "<pre>";
print_r($tab2);
echo "</pre>";

echo "<br> $varLast";*/


$tab3 = explode('.',$fileName);

$extFile = strtolower(end($tab3));

print_r( $extFile);



?>