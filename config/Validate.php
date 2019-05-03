<?php

namespace Config;

class Validate{

  /**
    *
    * Checks if a specific input type exists
    *
    * @param string|int|boolean $type  input type to check for - INPUT_GET, INPUT_POST, INPUT_COOKIE, INPUT_SERVER, INPUT_ENV
    * @param string $type  variable name to check
    * @return boolean
    */
  public static function hasInputVariable($type, $variable){
    return filter_has_var($type, $variable);
  }


  /**
    *
    * Checks if a specific input type exists
    *
    * @param string|int|boolean $type     input type to check for - INPUT_GET, INPUT_POST, INPUT_COOKIE, INPUT_SERVER, INPUT_ENV
    * @param string $type     variable name to check
    * @param string $filter   name of the filter to use
    * @param string $options  one or more flags to use
    * @return boolean
    */
  public static function filterInputVariable($type, $variable, $filter = 'FILTER_DEFAULT', $options = null){
    return filter_input($type, $variable, $filter, $options) ? true : false;
  }


  /**
    *
    * General Sanatize method - used to sanatise inputs from various filters
    *
    * @param string $str     variable to check
    * @param string $filter  filter to use
    * @return string
    */
  public static function filterSanatize($str, $filter = 'FILTER_DEFAULT'){
    return filter_var($str, $filter);
  }


  /**
    *
    * Sanatises a string - removes all tags
    *
    * @param string $str  variable to check
    * @return string
    */
  public static function sanatizeString($str){
    return filter_var($str, FILTER_SANITIZE_STRING);
  }


  /**
    *
    * Sanatises an email address - remove all illegal characters from email
    *
    * @param string $email  email address to check
    * @return string
    */
  public static function sanatizeEmail($email){
    return filter_var($email, FILTER_SANITIZE_EMAIL);
  }


  /**
    *
    * Sanatises an url - remove all illegal characters from url
    *
    * @param string $url  url to check
    * @return string
    */
  public static function sanatizeUrl($url){
    return filter_var($url, FILTER_SANITIZE_URL);
  }


  /**
    *
    * Sanatises number - remove all illegal characters from a number
    *
    * @param int $int  variable to check
    * @return int
    */
  public static function sanatizeInt($int){
    return filter_var($int, FILTER_SANITIZE_NUMBER_INT);
  }


  /**
    *
    * validate integer - determin if integer is a valid number
    *
    * @param int $number  variable to check
    * @return boolean
    */
  public static function validateInt($number){
    return filter_var($number, FILTER_VALIDATE_INT);
  }


  /**
    *
    * validate email - determin if email address is valid
    *
    * @param string $email  variable to check
    * @return boolean
    */
  public static function validateEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }


  /**
    *
    * validate a url - determin if url is a valid url
    *
    * @param string $url  variable to check
    * @return boolean
    */
  public static function validateUrl($url){
    return filter_var($url, FILTER_VALIDATE_URL);
  }


  /**
    *
    * validate an boolean value - determin if boolean is valid
    *
    * @param boolean $value  variable to check
    * @return boolean
    */
  public static function validateBoolean($value){
    return filter_var($value, FILTER_VALIDATE_BOOLEAN);
  }


  /**
    *
    * validate the minimum length of a string - determin if the length of the string is greter than the min length
    *
    * @param string $value   string to check
    * @param int $minlen  length to check against
    * @return boolean
    */
  public static function validateMinLength($value, $minlen = 0){
    return (is_string($value) && strlen($value) > $minlen ? true : false);
  }


  /**
    *
    * validate the max length of a string - determin if the length of the string is less than the max length
    *
    * @param string $value   string to check
    * @param int $maxlen  length to check against
    * @return boolean
    */
  public static function validateMaxLength($value, $maxlen = 0){
    return (is_string($value) && strlen($value) <= $maxlen ? true : false);
  }


  /**
    *
    * validate the min and max length of a string - determin if the length of the string is greter than the min length and less than the max length
    *
    * @param string $value   string to check
    * @param int $minlen  minlength to check against
    * @param int $maxlen  maxlength to check against
    * @return boolean
    */
  public static function validateLengthBetween($value, $minlen = 0, $maxlen = 0){
    return ((is_string($value) && strlen($value) >= $minlen && strlen($value) <= $maxlen) ? true : false);
  }


  /**
    *
    * check if a value is required - determin if a variable is empty or not
    *
    * @param string $val   value to check
    * @return boolean
    */
  public static function isRequired($val){
    return empty($val) ? false : true;
  }

  /**
    *
    * validate variable type - check the type of variable is what is specified
    *
    * @param string $var  variable to check
    * @param int $type    type to check against
    * @return boolean
    */
  public static function isType($var, $type){
    return gettype($var) === $type ? true : false;
  }

  /**
    *
    * check to see if a date is before another date
    *
    * @param string $date     date to check
    * @param string $maxDate  date to check against
    * @return boolean
    */
  public static function isBeforeDate($date, $maxDate){
    $date = new DateTime($date);
    $maxDate = new DateTime($maxDate);
    return $date < $maxDate;
  }


  /**
    *
    * check to see if a date is after another date
    *
    * @param string $date     date to check
    * @param string $minDate  date to check against
    * @return boolean
    */
  public static function isAfterDate($date, $minDate){
    $date = new DateTime($date);
    $minDate = new DateTime($minDate);
    return $date > $minDate;
  }


  /**
    *
    * check to see if a date is a valid date
    *
    * @param string $date    date to check
    * @param string $format  format to check against
    * @return boolean
    */
  public static function isValidateDate($date, $format = 'Y-m-d'){
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
  }

  /**
    *
    * check to see if a date matches another date
    *
    * @param string $date       date to check
    * @param string $matchDate  date to check against
    * @return boolean
    */
  public static function isSameDate($date, $matchDate){
    $date = new DateTime($date);
    $matchDate = new DateTime($matchDate);
    return $date == $matchDate;
  }

  /**
    *
    * check to see if a string is a string or matches another string
    *
    * @param string $str           string to check
    * @param string|null $maxDate  string to check against if present
    * @return boolean
    */
  public static function validateString($str, $matchStr = null){
    if(!is_string($str)) return false;
    if(isset($matchStr) && $str !== $matchStr) return false;
    return true;
  }

  /**
    *
    * check to see if a file exists
    *
    * @param string $file  file to check
    * @return boolean
    */
  public static function fileExists($file){
    return file_exists($file) ? true : false;
  }

  /**
    *
    * check to see if a array has a given length, or has a length greater than or less than specified
    *
    * @param array $arr         array to check
    * @param int|null $len      length to check against
    * @param int|null $min      min length to check against
    * @param int|null $max      max length to check against
    * @return boolean
    */
  public static function validateArrayLength($arr, $len = null, $min = null, $max = null){
    if(empty($arr)) return false;
    if(isset($min) && count($arr) < $min) return false;
    if(isset($max) && count($arr) > $max) return false;
    if(isset($len) && count($arr) !== $len) return false;
    return true;
  }


}

?>
