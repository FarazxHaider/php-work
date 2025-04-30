<?php  declare(strict_types=1);

// For Loop

/*
for($x = 1;$x <=5;$x++){
  echo "The number is: $x <br>";
}*/


// While Loop

$start = 1;


/*
while($start<=5){
  echo $start;
  
  $start++;
}*/


// Do-While Loop

$i = 1;


/*
do{
  echo "Hi <br>";
  $i++;
}while($i<=5);
*/

// PHP Array

$names = array("Wali", "Noor", "Rafeel", "Ali","Wajid");


// Foreach Loop

/*
foreach($names as $i){
  echo "$i <br>";   
}*/


// PHP Functions

/*
function greet($name = "Faraz"){
  echo "Hello, $name ";
}*/

function add(int $num1, int $num2){
  $total = $num1 + $num2;
  return $total;
}

// greet();

// echo add(2,"2");






?>