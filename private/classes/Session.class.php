<?php

/*

This Web Application was developed by WHIZ ON JAN 2023.

-----------WHIZ'S CONTATCT----------

FULLNAME:   TIJANI ABDULLATEEF BLESSING (WHIZ)
FACEBOOK:   https://web.facebook.com/lateefblessing/
TWITTER:    https://twitter.com/whizolad/
INSTAGRAM:  https://www.instagram.com/whizolad
EMAIL:      lateeftijani66@gmail.com / oladojablessing66@gmail.com 
PHONE:      +2348025197159 / +2347049994640
WEBSITE:    https://www.whiz.website/

-----------WARNING----------

This Web App should not be used in any form without the prior notice written to the above contact

*/

class Session{
  private $id;
  public $username;
  public $last_login;

  public const MAX_AGE_LOGIN = 60*60*24;

  public function __construct()
  {
    session_start();
    $this->checked_stored_login();
  }

  public function login($admin)
  {
    if ($admin) {
      session_regenerate_id();
      $this->id = $_SESSION['id'] = $admin->id;
      $this->username = $_SESSION['username']  = $admin->username;
      $this->last_login = $_SESSION['last_login']  = time();
    }
    return true;
  }
  
  public function is_logged_in()
  {
    // return isset($this->id);
    return isset($this->id) && ($this->last_login_is_recent());
  }

  public function logout()
  {
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['last_login']);
    unset($this->id);
    unset($this->username);
    unset($this->last_login);
    return true;
  }

  private function checked_stored_login()
  {
    if (isset($_SESSION['id'])) {
      $this->id = $_SESSION['id'];
      $this->username = $_SESSION['username'];
      $this->last_login = $_SESSION['last_login'];
    }
  }

  private function last_login_is_recent()
  {
    if (!isset($this->last_login)) {
      return false;
    }elseif(($this->last_login + self::MAX_AGE_LOGIN) < time()){
      return false;
    }else {
      return true;
    }
  }

  public function message($msg="")
  {
    if (!empty($msg)) {
      $_SESSION['message'] = $msg;
      return true;
    }else {
      return $_SESSION['message'] ?? '';
    }
  }

  public function clear_message()
  {
    unset($_SESSION['message']);
  }
}
