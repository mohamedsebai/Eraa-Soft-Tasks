<?php 

$main_string = "EraaSoft Learn by practice";


// ⦁ Get the length of this sentence. 
echo 'Length with space : ' . strlen($main_string) . '<br>';
// ⦁ Get the length of this sentence without space
echo 'Length without space : ' . strlen($main_string) - substr_count($main_string, ' ') . '<br>';
// ⦁	Get the number of words in this sentence. 
echo 'Word count is : ' . str_word_count($main_string) . '<br>';


// . Check if this word (by) exists in the string or not.
if (str_contains($main_string, 'by')) { 
    echo 'the word (by) is exists is this string<br>';
}else{
    echo 'the word (by) is not exists <br></br>';
}


// ⦁ Get the word (EraaSoft) from the string and print it.
$search_by_word = 'EraaSoft';
$array_of_words = explode(" ", $main_string);
foreach($array_of_words as $word){
    if($word === $search_by_word){
        echo $search_by_word;
    }
}
echo '<br>';


// ⦁ Remove the word (by) from the string and print the string with and without (by)
$remove_by_word = 'by';
$array_of_words = explode(" ", $main_string);
$word_without_removable = [];
foreach($array_of_words as $word){
    if($word !== $remove_by_word){
        array_push($word_without_removable, $word);
    }
}

// with 
echo $main_string . "<br>";
// without
echo implode(" ", $word_without_removable);