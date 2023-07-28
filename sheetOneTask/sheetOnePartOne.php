<?php 

/*
⦁ Write a php script that records 3 digits and prints the total of the first two digits multiplied by the third digit.
*/

function sumAndMultiplied($num_1, $num_2, $num_3){
    return ($num_1 +  $num_2) * $num_3;
}
echo sumAndMultiplied(4,2,3);
echo '<br>';



/*
php A program that calculates the size of a box whose length and width are fixed with a value of 5
and 10 and the height is variable (size = length x width x height)
*/

function sizeOfTheBox($height){
    $length = 10;
    $width = 10;
    return $length * $width * $height;
}
echo sizeOfTheBox(10);
echo '<br>';


/*
⦁ Write a PHP script that takes a number integer representing the hours and converts it to seconds.
*/
function secendsOfHours($countOfHours){
    $minutes = $countOfHours * 60;
    $secendsOfHours = $minutes * 60;
    return  $secendsOfHours;
}
echo secendsOfHours(5);
echo '<br>';


/*
⦁ Write a PHP script that calculates the Area of a Triangle store the base and height Print the area.
*/
function areaOfTriangle($base, $height){
    return "Area of Triangle having base $base and height $height= " . ( $base * $height ) / 2;
}
echo areaOfTriangle(10, 15);
echo '<br>';


/*
⦁ Write a PHP script that takes the age in years and prints the age in days.
*/
function getDaysByYear($age_by_years){
    $age_in_days = $age_by_years * 365;
    return $age_in_days;
}
echo getDaysByYear(1);
echo '<br>';


