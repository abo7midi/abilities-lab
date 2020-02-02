<?php

/**
 *
 */
class Validation
{

  function __construct()
  {

  }
  public static function required($input=[])
  {
   //print_r($input);
    //print_r($_REQUEST);
    $error='all field ok';
    $status=1;
    foreach ($_REQUEST as $key => $value) {
      if (array_search($key,$input)!==false) {
        if (empty($value)) {
          $error="* This ".$key." Field Is Reqired";
          Message::setMessage(0,'main','You Should Fill all Fields');
          Message::setMessage(0,$key,$error);
          $status=0;
          return(['status'=>$status]);
        }
      }
    }
    return (['status'=>$status,'error'=>$error]);
  }


  public static function logicCheck($first,$tool,$second,$errorMsg){
    switch ($tool){
      case "<":if($first < $second){
        Message::setMessage(0,'logicError',$errorMsg);
        return false;
      };break;
      case "<=":if($first <= $second){
        Message::setMessage(0,'logicError',$errorMsg);
        return false;
      };break;
      case ">":if($first > $second){
        Message::setMessage(0,'logicError',$errorMsg);
        return false;
      };break;
      case ">=":if($first >= $second){
        Message::setMessage(0,'logicError',$errorMsg);
        return false;
      };break;
      case "==":if($first == $second){
        Message::setMessage(0,'logicError',$errorMsg);
        return false;
      };break;
      case "!=":if($first != $second){
        Message::setMessage(0,'logicError',$errorMsg);
        return false;
      };break;
      default:Message::setMessage(0,'logicError',"<p style='color:red'>enter a comparision in true way</p>");
        return true;break;
    }

  }

public static function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
}


 ?>
