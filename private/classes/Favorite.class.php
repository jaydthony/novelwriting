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

class Favorite extends DatabaseObject {
  static protected $db_columns = ["id",
   "user_id",
   "story_id",
   "date_created", 
   "time_created"];

  static protected $table_name="favorite";

public $id;
public $user_id;  
public $story_id; 
public $date_created;  
public $time_created;  

    public function __construct($args=[]){
      $this->user_id = $args['user_id'] ?? '';
      $this->story_id = $args['story_id'] ?? '';
      $this->date_created = $args['date_created'] ?? '';
      $this->time_created = $args['time_created'] ?? '';
    }

    static public function find_by_user_id($id)
    {
  
      $sql ="SELECT * FROM ".static::$table_name ." ";
      
      $sql .="WHERE user_id = '".self::$db->escape_string($id)."' ";
  
      // print $sql;
  
        $obj_array = static::find_by_sql($sql);
  
          return $obj_array;
    
    }

    static public function find_favorite_in_story($user, $story)
  {

    $sql ="SELECT * FROM ".static::$table_name ." ";
    
    $sql .="WHERE user_id = '".self::$db->escape_string($user)."' ";

    $sql .="AND story_id = '".self::$db->escape_string($story)."' ";

    // print $sql;

      $obj_array = static::find_by_sql($sql);

      if (!empty($obj_array)) {
          return array_shift($obj_array);
      } else {
        return false;
      }

  }

  
}
