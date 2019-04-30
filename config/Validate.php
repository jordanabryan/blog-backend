<?php

namespace Config;

class Validate{

  // types include: INPUT_GET, INPUT_POST, INPUT_COOKIE, INPUT_SERVER, INPUT_ENV
  public static function hasInputVariable($type, $variable){
    return filter_has_var($type, $variable);
  }

  //sanatize string - remove all tags
  public static function sanatizeString($str){
    return filter_var($str, FILTER_SANITIZE_STRING);
  }

  //sanatize email - remove all illegal characters from email
  public static function sanatizeEmail($email){
    return filter_var($email, FILTER_SANITIZE_EMAIL);
  }

  //sanatize url - remove all illegal characters from url
  public static function sanatizeUrl($url){
    return filter_var($url, FILTER_SANITIZE_URL);
  }

  //sanatize number - remove all illegal characters from number
  public static function sanatizeInt($int){
    return filter_var($int, FILTER_SANITIZE_NUMBER_INT);
  }

  //validate integer - determin if integer is valid
  public static function validateInt($number){
    return filter_var($number, FILTER_VALIDATE_INT);
  }

  //validate email - determin if email is valid
  public static function validateEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }



  //validate url - determin if url is valid
  public static function validateUrl($url){
    return filter_var($url, FILTER_VALIDATE_URL);
  }

  //validate boolean - determin if boolean is valid
  public static function validateBoolean($value){
    return filter_var($value, FILTER_VALIDATE_BOOLEAN);
  }

  public static function validateMinLength($value, $minlen = 0){
    return (strlen($value) > $minlen ? true : false);
  }

  public static function validateMaxLength($value, $maxlen = 0){
    return (strlen($value) <= $maxlen ? true : false);
  }

  public static function isRequired($val){
    return empty($val) ? false : true;
  }

  public static function isType($var, $type){
    return gettype($var) === $type ? true : false;
  }

  public static function isBeforeDate($date, $maxDate){
    $date = new DateTime($date);
    $maxDate = new DateTime($maxDate);
    return $date < $maxDate;
  }

  public static function isAfterDate($date, $minDate){
    $date = new DateTime($date);
    $minDate = new DateTime($minDate);
    return $date > $minDate;
  }

  public static function isValidateDate($date, $format = 'Y-m-d'){
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
  }

  public static function isSameDate($date, $matchDate){
    $date = new DateTime($date);
    $matchDate = new DateTime($matchDate);
    return $date == $matchDate;
  }

  public static function validateString($str, $matchStr = null){
    if(!is_string($str)) return false;
    if(isset($matchStr) && $str !== $matchStr) return false;
    return true;
  }

  public static function fileExists($file){
    return file_exists($file) ? true : false;
  }

  public static function isImage($path){}

  public static function validateArrayLength($arr, $len = null, $min = null, $max = null){
    if(empty($arr)) return false;
    if(isset($min) && count($arr) < $min) return false;
    if(isset($max) && count($arr) > $max) return false;
    if(isset($len) && count($arr) !== $len) return false;
    return true;
  }


}

?>
