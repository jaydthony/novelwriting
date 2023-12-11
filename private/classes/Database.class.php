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

//Connecting the database
class Database
{
    public static function db_connect()
    {
        $connection = new mysqli(Db_Credentials::set_locahost(),
            Db_Credentials::set_username(), Db_Credentials::set_password(),
            Db_Credentials::set_Dbname());
        self::confirm_db_connect($connection);
        return $connection;
    }

    // confirm Database Connection
    public static function confirm_db_connect($connection)
    {
        if ($connection->connect_errno) {
            $msg = "Database connection failed: ";
            $msg .= $connection->connect_error;
            $msg .= " (" . $connection->connect_errno . ")";
            exit($msg);
        }
    }

    // disconnect from database
    public static function db_disconnect($connection)
    {
        if (isset($connection)) {
            $connection->close();
        }
    }
}