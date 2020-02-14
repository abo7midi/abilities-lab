<?php
abstract class Session
{
    /**
     * @param $key
     * @param $value
     */


    public static function set($key, $value)
    {
            $_SESSION[$key] = $value;

    }


    public static function loggIn(array $user)
    {
            $_SESSION['userID'] = $user[0];
            $_SESSION['userName'] = $user[1];
            $_SESSION['userGroup'] = $user[2];
            $_SESSION['userImg'] = $user[3];


    }

    public static function  logged()
    {
      if (self::has('userID')) {
          return $_SESSION['userID'];
      }
      return null;
    }

    /**
     * @param $key
     * @return null
     */
    public static function get($key)
    {
        if (self::has($key)) {
            return $_SESSION[$key];
        }
        return null;
    }

    /**
     * @param $key
     * @return bool
     */
    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }

    /**
     * @param $key
     */
    public static function delete($key)
    {

        unset($_SESSION[$key]);
    }

    public static function isAdmin()
    {
      if (!isset($_SESSION['type'])) {
        return false;
      }
  

        if ($_SESSION['type']=='Admin') {
        return true;
        }
        else {
          return false;
        }
    }


    /**
     * destroy
     */
    public static function destroy()
    {
        session_destroy();
    }
}
