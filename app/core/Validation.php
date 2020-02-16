<?php

/**
 *
 */
class Validation
{

  function __construct()
  {

  }

  public function validate($data)
  {
    $error = [];
    foreach (($data) as $fildName => $typeValidate) {
      $error = array_merge($error, self::checkFild($fildName, $typeValidate));
    }
    Message::setMessage('errors', $error, 'error');
    return $error;
  }


  private function checkFild($fildName, $validation)
  {
    $errors = [];
    foreach ($validation[0] as $typeValidate => $data) {
      $formData = @$_REQUEST[$fildName];
      switch ($typeValidate) {
        case 'required':
          if (strlen($formData) < 1)
            $errors[$fildName][$typeValidate] = $fildName . ' is required ';
          break;
        case 'imageRequired':
          if (($_FILES[$fildName]['name']) == '')
            $errors[$fildName][$typeValidate] = $fildName . ' is required ';
          break;
        case 'hasElements':
          if (!(isset($_REQUEST[$fildName]) ))
            $errors[$fildName][$typeValidate] = $fildName . ' must be has at less  ' . $data . 'element';
          break;
        case 'min':
          if (strlen($formData) < $data)
            $errors[$fildName][$typeValidate] = $fildName . '  must be more than ' . $data;
          break;
        case 'minVal':
          if (($formData) < $data)
            $errors[$fildName][$typeValidate] = $fildName . '  must be more than ' . $data;
          break;
        case 'minWords':
          if (str_word_count($formData) < $data)
            $errors[$fildName][$typeValidate] = $fildName . '  must be more than ' . $data . 'words';
          break;
        case 'max':
          if (strlen($formData) > $data)
            $errors[$fildName][$typeValidate] = $fildName . '  must be less than ' . $data;
          break;
        case 'maxVal':
          if (($formData) > $data)
            $errors[$fildName][$typeValidate] = $fildName . '  must be less than ' . $data;
          break;
        case 'maxWords':
          if (str_word_count($formData) > $data)
            $errors[$fildName][$typeValidate] = $fildName . '  must be less than ' . $data . 'words';
          break;
        case 'confirmed':
          if ($_REQUEST[$data] != $formData)
            $errors[$fildName][$typeValidate] = 'password not equall';
          break;
        case 'select':
          if (!isset($_REQUEST[$fildName]))
            $errors[$fildName][$typeValidate] = 'must be select 1 at less';
          break;
        case 'unique':
          if (Helper::uniqueFild(array('table' => $data[0], 'input' => $data[1], 'data' => $_REQUEST[$fildName], 'id' => isset($data[2]) ? $data[2] : '0')))
//                        var_dump(Helper::uniqueFild(array('table' => $data[0], 'input' => $data[1], 'data' => $_REQUEST[$fildName])));
            $errors[$fildName][$typeValidate] = ' this ' . $fildName . ' is not allowed to used';
          break;
      }
    }
    return $errors;

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
