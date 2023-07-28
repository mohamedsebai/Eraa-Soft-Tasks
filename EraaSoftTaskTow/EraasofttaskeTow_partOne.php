<?php 

echo '<h1 style="background: red; text-align: center">Task Tow Part One</h1>';

//  average nubmer in array
echo '<h2>1- average nubmer in array</h2>';
$numbers = [1, 2, 3, 4, 5]; // random numbers
$average = array_sum($numbers) / count($numbers);
echo $average . '<br>';


// iam sorry i donot get it right understand so i get the result from my miss understanding
// Check if an array contains another array with PHP [duplicate]

echo '<h2>2- check if an array contains another array with PHP [duplicate]</h2>';
$GroupOfEight = array(
        array(0,1,3,2,4,5,7,6),
        array(4,5,6,7,15,12,13,14),
        array(12,13,15,14,8,9,11,10),
        array(2,6,14,10,3,7,15,11),
        array(1,3,5,7,13,15,9,11),
        array(0,4,12,8,1,5,13,9),
        array(0,1,3,2,8,9,11,10)
);

$stackArray = array(0,4,12,1,9,8,5,13,9,2,5,2,10);

function searcheight($stackArray, $GroupOfEight) {
    $list = array();
    for($i = 0; $i < count($GroupOfEight); $i ++) {
        $intercept = array_intersect($GroupOfEight[$i], $stackArray);
        $len = count($intercept);
        if ($len % 4 == 0) {
            $list[$i] = $len;
        }
    }
    arsort($list);
    if (empty($list))
        return - 1;
    return key($list);
}
echo searcheight($stackArray, $GroupOfEight) . '<br>';

// smalles and laraget numbers of an array 
echo '<h2>3- smallest and largest numbers of an array </h2>';
$array = array(1,10,11,5,2);
$smallest = min ( $array );// prints 1
$largest = max ( $array  );// prints 11
echo 'laragest number is : ' . $largest . '<br>';
echo 'smallest number is : ' . $smallest;

// 
echo '<h2>4-Array push number</h2>';
$array = [1,10,11,5,2];
$array_count = max($array);
$add_to_array = 3;
    array_push($array, $add_to_array);
    sort($array);
echo '<pre>';
print_r($array);
echo '</pre>';


$new_array_greater = [];
$new_array_smallest = [];
for($i = 0; $i <= $array_count; $i++){
    if($i > 3 && in_array($i, $array)){
        array_push($new_array_greater, $i);
    }
    if($i < 3 && in_array($i, $array)){
        array_push($new_array_smallest, $i);
    }
}

echo 'number smallest than (3) is = ' . count($new_array_smallest) . '<br>';
echo 'number greater than (3) is = ' . count($new_array_greater) . '<br>';


// 4  capitalize array by function
echo '<h2>5- capitalize array by function </h2>';
function capitalize_words($arr){
    $j = 0;
    foreach( $arr as $element ) {
        $arr[$j] = ucwords($element);
        $j++;
    }
    print_r($arr);
}
capitalize_words(array('eraaSoft', 'backEnd', 'group313'));