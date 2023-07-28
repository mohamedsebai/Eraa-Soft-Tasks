<?php 

$description = "no pain , no gain ";


/*
* Check from this string If the string has “gain” Print ( success word ) 
If the string has ( peen ) Print ( success word )  Else ( wrong word )
*/

if (str_contains($description, 'gain')) {
    echo 'success word<br>';
}else{
    echo 'wrong word<br>';
}

if (str_contains($description, 'peen')) {
    echo 'success word<br>';
}else{
    echo 'wrong word<br>';
}


/*
⦁	 
A Boolean is a data type that has only two values true or false. 
These values often correspond to 1 (true) or 0 (false).
When a 1 or a 0 is used, it's called an int Boolean.
Write a PHP script that stores an int Boolean and outputs its opposite
    (1 becomes 0 and 0 becomes 1) .

*/

function oppositeBoolean($int){
    if($int == 0){
        return 1;
    }elseif( $int == 1){
        return 0;
    }
}

echo oppositeBoolean(0);
echo '<br>'; 
// anthor example 
function validatePwd($pwd1, $pwd2) {
    if (strcasecmp($pwd1, $pwd2) == 0) 
    {
        echo 0;
    }
    else 
    {
        echo 1;
    }
}

validatePwd('NO', 'MO');
echo '<br>';

/*
⦁ Write a PHP script that stores a word and determines Is the Word is Singular or Plural?
    (A plural word is one that ends in "s". )

*/

function checkWordStatus($word){
    $last_char_of_word = mb_substr($word, -1);
    if($last_char_of_word === 's'){
        echo 'Plural';
    }else{
        echo 'Singular';
    }
}

checkWordStatus('words'); // will echo Plural becouse it end with s.



