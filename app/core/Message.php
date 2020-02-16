<?php

/**
 *
 */
abstract class Message

{

    function __construct()
    {

    }

    /**
     * @param $msg
     * @return null
     */

    public static function getMessage($msg)
    {
        if (Session::has($msg)) {
            $message = Session::get($msg);
            if ($msg != 'msgState') {
                Session::delete($msg);
            }
            return $message;
        } else {
            return '';
        }
    }
    public static function getInputErrorMessage($input)
    {
        $all = '';
        $m = '';
        if (Session::has('errors')) {
            $all = Session::get('errors');
            if (isset($all[$input])) {
                $m = '<span class="btn-block badge badge-danger">';
                foreach ($all[$input] as $error)
                    $m .= $error . '<br>';
                $m .= '</span>';
            }
        }
        return $m;
    }


    /**
     * @param $key
     * @param $msg
     */
    public static function setMessage($key, $msg, $type)
    {
        Session::set($key,$msg);
        Session::set('msgState',$type);
    }

    /**
     * @param $key
     * @return $view
     */



/**
     * @param $msg
     * @return null
     */

    /*public static function getMessage($msg)
    {
      if (Session::has($msg)) {
        $message=Session::get($msg);
        if ($msg!='msgState') {
            Session::delete($msg);
        }

        return $message;
      }
      else {
        return '';
      }

    }
    */

    /**
     * @param $state
     * @param $key
     * @param $msg
     */
    /*public static function setMessage($state,$key,$msg)
    {

        Session::set($key,$msg);
        Session::set('msgState',$state);

    }

    /**
     * @param $key
     * @return $view
     */
    public static function check($key)
    {
      $view='';
      #check if state of Message is exit or return null
      if (!Session::has('msgState')) {
        return '';
      }
      #check if state of Message is exit or return null
      if (!Session::has($key)) {
        return '';
      }
      switch (Message::getMessage('msgState')) {
        case 0:
            if ($key=='main') {
                $view='<div class="alert alert-danger" role="alert">'.Message::getMessage('main').'</div>';
            }
            else {
              $view='<div class="alert alert-danger" role="alert">'.Message::getMessage($key).'</div>';
            }
          break;
        case 1:
                $view='<div class="alert alert-success" role="alert">'.Message::getMessage($key).'</div>';
          break;
      }
    return $view;
    }
}
?>