<?php

function fomatah($array,$str_sep=',',$is_assoc=false){
  if($is_assoc):
    $company_name = $array["name"];
    $amounts = $array["amount"];
  else:
    $company_name = $array[0];
    $amounts = $array[1];
  endif;

  //deal with names
  $c_name_array = explode(' ',$company_name);
  $temp = $c_name_array[1];
  $str_length = (int)(strlen($temp) / 2);

  $mid_char = substr($temp,$str_length,-$str_length);
  $second = substr($temp,0,1).$mid_char.substr($temp,-1,1);
  $combined = ucwords(strtolower(
    $c_name_array[0] .' '.$second.'.'
  ));

  $clean_amounts = [];
  $debits = [];
  $balance = 0;
  if(!is_array($amounts)):
    //for strings...
    $amounts = explode($str_sep,$amounts);
  endif;
  foreach($amounts as $a){
    //remove any unwanted numbers..
    ///notice that the debits are the max and min..hmhh..
    $clean = preg_replace('/[^0-9]/','',$a);
    $clean_amounts[] = $clean;
  }
  $debits = [max($clean_amounts),min($clean_amounts)];
  $balance = array_sum($clean_amounts) - array_sum($debits);

  return '<i>'.$combined.'</i> '.implode(',',$clean_amounts).' <u>'.implode(',',$debits).'</u> <b>'.$balance.'</b>';
}

//testing function
$array1 = ["archeNland Limtded",["£100",'-1','200','300','-700',678]];
echo fomatah($array1);
echo '<br/>';
$array2 = ["narnIa Geselmlchab","$530,-23,670,3,negative1299"];
echo fomatah($array2);
echo '<br/>';
$array3 = ["name" => "loneIslands proprtieary","amount" => "7568-39-49-37-3000-98"];
echo fomatah($array3,"-",true);
?>
