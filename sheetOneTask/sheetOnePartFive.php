<?php 

/*
⦁	Make a calculator with these operations using if and else if
o Submission 
o Subtraction 
o Multiplication 
o Division 
o Power 
o Modulus 

*/
?>
<!DOCTYPE html>
<html>
<body>
    
<div style="background-color: red; padding: 5px">
    <h1 style="color: black">Sheet One last Part</h1>
</div>
<?php
ini_set('display_errors',0);

if( isset( $_REQUEST['calculate'] )){
    $operator=$_REQUEST['operator'];
    $n1 = $_REQUEST['first_value'];
    $n2 = $_REQUEST['second_value'];
    
    if($operator=="+"){
        $res= $n1+$n2;
    }elseif($operator=="-"){
        $res= $n1-$n2;
    }elseif($operator=="*"){
        $res =$n1*$n2;
    }  elseif($operator=="/"){
        $res= $n1/$n2;
    }elseif($operator=="^"){
        $res= pow($n1,$n2);
    }

    if($_REQUEST['first_value'] == NULL || $_REQUEST['second_value']==NULL){
        echo "<script language=javascript> alert(\"Please Enter Correct values.\");</script>";
    }
}
?>

<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
    <table style="border:groove #00FF99">
    
    <tr>
        <td style="background-color:turquoise; color:black; font-family:'Times New Roman'">Enter Number</td>
        <td colspan="1">
        <input name="first_value" type="text" style="color:red"/></td>
    </tr>
        
    <tr>
        <td style="color:red; font-family:'Times New Roman'">Select Operator</td>
        <td>
        <select name="operator" style="width: 63px">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
            <option value="^">^</option>
        </select>
        </td>
    </tr>

    <tr>
        <td style="background-color:turquoise; color:black; font-family:'Times New Roman'">Enter Number</td>
        <td class="auto-style5">
        <input name="second_value" type="text"  style="color:red"/></td> 
    </tr>

    <tr>
        <td></td>
        <td><input type="submit" name="calculate" value="Calculate" style="color:wheat;background-color:rosybrown" /></td>	 
    </tr>

    <tr>
        <td style="background-color:turquoise;color:black">Output = </td>
        <td style="color:darkblue"><?php echo $res;?></td>
    </tr>	

    </table>
</form>

</body>
</html>