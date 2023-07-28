<?php 

$string_one = "Eraa";
$string_two = "Soft";

/*
⦁	Make a new variable called (Full_string) that concatenate string_one and string_two
*/
$Full_string = $string_one . $string_two;
echo $Full_string . "<br>";

/*
⦁ Compare the full_string and this string (EraaSoft).
*/
echo strcmp($Full_string, 'EraaSoft'); // three is no difference
echo '<br>';

/*
⦁ Write a PHP script to split the following string. 
    Sample string: 'ErraSoft'
    Expected Output: Er/ra/So/ft
*/
$array = str_split('ErraSoft' , 2);
echo implode('/', $array);
echo '<br>';


/*
⦁ Write a PHP script that stores the number as a variable and checks if it is odd or even.
*/
function checkNumber($number){
    if($number % 2 == 0){
        echo "Even"; 
    }
    else{
        echo "Odd";
    }
}
checkNumber(2);
echo '<br>';
/*
⦁ Write a PHP script that stores the string as a variable and checks if the length is odd or even.
*/


function checkStrLengthStatus($string){
    $strProperty = strlen($string)%2 == 0 ? "even" : "odd";
    echo $strProperty;
}
checkStrLengthStatus("errsoft");
echo '<br>';