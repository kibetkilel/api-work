<?php

function multi_add($number1,$number2,$to_words = false){

  //check if numeric
  if( !is_numeric($number1)):
    return "$number1 is not a number";
  elseif(!is_numeric($number2)):
    return "$number2 is not a number";
  else:
    $result = 0;
    //the multiplication
    //we need to cast number2 to int
    $number2 = (int) $number2;
    while($number2 > 0){
      $result = $result + $number1;
      $number2--;
    }

    if($to_words):
      //converting number to words..
      $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
      $result = ucwords($f->format($result));
    endif;

    return $result;
  endif;
}

//test cases
echo multi_add(1,3);
echo '<br/>';
echo multi_add(4,5,true);
echo '<br/>';
echo multi_add(1, "raten",false);
echo '<br/>';
echo multi_add(5,4.5);
echo '<br/>';
echo multi_add(3.4,5,"$$");

 ?>
