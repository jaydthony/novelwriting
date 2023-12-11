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

// Database Settings
  class Db_Credentials{
    protected const DB_SERVER = ('localhost');
    protected const DB_USER = ('root');
    protected const DB_PASS = ('');
    protected const DB_NAME = ('writing');    

    static public function set_locahost()
    {
      return self::DB_SERVER;
    }

    static public function set_username()
    {
      return self::DB_USER;
    }

    static public function set_password()
    {
      return self::DB_PASS;
    }

    static public function set_Dbname()
    {
      return self::DB_NAME;
    }

  }
