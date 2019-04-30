<?php

use Config\Validate;

include 'config/Validate.php';

$string = 'this is <strong>string</strong>';

$validatedString = Validate::sanatizeString($string);

echo '<p>' . $string . '</p>';
echo '<p>' . $validatedString . '</p>';

$islong = Validate::validateMaxLength($string, 100);

// if($islong){
//   echo 'true';
// } else {
//   echo 'false';
// }


$arr = array(
  1 => true,
  2 => true,
  3 => true,
);

$isValid = Validate::validateArrayLength($arr, null, null, 2);


$isValidString = Validate::validateString('boo');


if($isValidString){
  echo 'true';
} else {
  echo 'false';
}






?>
