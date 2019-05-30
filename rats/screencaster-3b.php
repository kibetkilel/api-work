<?php
/**
* $string - the string to be converted
* $name_sep - the name separator
* $val_sep - the value (name,numbers) separator
* $flip -  whether to flip the names or not
* $str_split - whether to split every item of array
*/
function convatah($string,$name_sep,$num_sep,$val_sep,$flip=true,$str_split=false){

  $split_val = explode($val_sep,$string);
  $names = $split_val[0];
  $amounts = $split_val[1];

  /*clean names*/
  $names_ar = explode($name_sep,$names);
  //get the title
  $title = '('.substr($names_ar[0],0,1).substr($names_ar[0],-1,1).'.)';
  //remove it from the array
  unset($names_ar[0]);
  $new_names = [];
  foreach($names_ar as $n){
    //clean the values
    $clean = preg_replace('/[^A-Za-z\-]/', '', $n);
    $new_names[] = ucwords(strtolower($clean));
  }
  //flip the names
  if($flip):
    $new_names = array_reverse($new_names);
  endif;

  $names_final = implode(',',$new_names).' '.$title;

  //the numbers
  if($str_split):
    $numbers_array = str_split($amounts);
  else:
    $numbers_array = explode($num_sep,$amounts);
  endif;
  $numbers_final = implode(',',$numbers_array);
  $numbers_sum = '<b>'.array_sum($numbers_array).'</b>';

  return $names_final .' '.$numbers_final.' '.$numbers_sum;

}

//testing
echo convatah("Engineer-Wairuri-Kamau|20.00,15,6","-",',','|');
echo '<br/>';
echo convatah("Doctor WaMvua Ka12mbua`12040102010"," ",'0','`');
echo '<br/>';
echo convatah("Miss#t0opoi#susan£3311","#",'','£',false,true);
echo '<br/>';
echo convatah("Mister%Jotham%Wafula_7+7","%",'+','_');
 ?>
