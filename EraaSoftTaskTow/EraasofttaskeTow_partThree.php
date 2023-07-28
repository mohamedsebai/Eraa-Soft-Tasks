<?php 

echo '<h1 style="background: red; text-align: center">Task Tow Part Three</h1>';
// Get number all status
echo '<h2>9- Get number all status</h2>';


$array = [11,545, 20, 44, 1200, 345]; // my random array
$num = 545;

// search found number 
if(array_search($num, $array)){
    echo 'Found ,';
}else{
    echo 'Not Found ,';
}
// nigative or positive
if ( $num > 1 ) {
    echo 'positive , ';
}else{
    echo 'negitave , ';
}

// check if number is prime or not
function check_prime($num){
    if ($num == 1)
    return 0;
    for ($i = 2; $i <= $num/2; $i++){
        if ($num % $i == 0)
        return 0;
    }
    return 1;
}
$flag_val = check_prime($num);
if ($flag_val == 1){
    echo "prime number , ";
    
}else{
    echo "Not prime , ";
}

// get the length of digits
$numlength = strlen((string)$num);
echo $numlength , ' digits in this number,';

if($num%2==0)  {  
    echo " $num is Even Number , ";   
} else {
    echo " $num is Odd Number , ";  
} 

// accesability for reading the number right as left
function reverse($num)  
{  
   /* writes number into string. */  
    $num = (string) $num;  
    /* Reverse the string. */  
    $revstr = strrev($num);  
    /* writes string into int. */  
    $reverse = (int) $revstr;   
    return $reverse;
}  
$num_reversed =  reverse($num);
if($num == $num_reversed){
    echo 'Yes I can read number from right as left';
}else{
    echo 'No I can Not read number from right as left';
}