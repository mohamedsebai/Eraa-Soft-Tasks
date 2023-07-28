<?php 

echo '<h1 style="background: red; text-align: center">Task Tow Part Tow</h1>';

//  arange the array with 0 in end of it
echo '<h2>6- arange the array with 0 in end of it</h2>';

$array = [0,1,0,3,12];
asort($array); // sorting for array
$zero_array = array_filter($array, static function ($element) {
    return $element == 0;
});
$array_without_zero_element = array_filter($array, static function ($element) {
    return $element !== 0;
});

$array_merege = array_merge($array_without_zero_element, $zero_array);
echo '<pre>';
print_r($array_merege);
echo '</pre>';


//  arange the array with 0 in end of it
echo '<h2>7- check if name Bob exists</h2>';

function check_name_exists($name, $names){
    if(!array_search($name, $names)){
        return  -1;
    }else{
        return 1;
    }
}
echo check_name_exists('Bob', ['Alice', "Bob",'Charlie', 'Dave']) . '<br>';
echo check_name_exists('Bob', ['Alice','Charlie', 'Dave']) . '<br>';

// secend laragest number 

echo '<h2>8- Get the secend laragest number of array</h2>';
function findSecondLargest(array $arr){
    //sort the array in ascending order
    sort($arr);
    //save the element from the second last position of sorted array
    $secondLargest = $arr[sizeof($arr)-2];
    //return second-largest number
    return $secondLargest;
}

//create an array of numbers
$arr = array(11,55,2,3,5,6,7,8);

// call the function and print output
echo "Second-largest number : ".findSecondLargest($arr);
