<?php

$num1 = $_GET["num1"];
$num2 = $_GET["num2"];
$sum = $num1 + $num2;
$product = $num1 * $num2;
$difference = $num1 - $num2;
$quotient = $num1/$num2; 
if($num1 == ""){
$num1 = 0;
}
if($num2 == ""){
$num2 = 0;
}
  if(isset($_GET['calculation'])){
	$calculation= $_GET['calculation'];
} else {
	$calculation = "Pick an operation";
	echo $calculation;
}

 
if( $calculation == 'add'){
	echo $num1 ." + " .$num2 ." = " .$sum;
	} 
if($calculation == 'subtract')	{
	echo $num1 ." - " .$num2 ." = " .$difference;
	}
if($calculation == 'divide'){
		if($num2 == 0){
		echo "Can't divide by 0" ;
		}
		else{ echo $num1 ." / " .$num2 ." = " .$quotient ;
		} 
		}
if($calculation == 'multiply'){
		echo $num1 ." * " .$num2 ." = " .$product;
		}
?> 