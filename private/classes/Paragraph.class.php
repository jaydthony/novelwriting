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

class Paragraph extends DatabaseObject {
  static protected $db_columns = ["id",  "story_id", "user_id", "username", "body", "netvotes", "date_created", "time_created"];
  static protected $table_name="paragraphs";
    public $id;
    public $story_id;
    public $user_id;
    public $username;
    public $body;
    public $netvotes;
    public $date_created;
    public $time_created;


    public function __construct($args=[]){

      global $logged_user;

      $this->story_id = $args['story_id'] ?? '';

      $this->user_id = $args['user_id'] ?? '';
      
      $this->username = $args['username'] ?? '';

      $this->body = $args['body'] ?? '';

      $this->netvotes = $args['netvotes'] ?? '';

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


    static public function find_by_story_id($id)
  {

    $sql ="SELECT * FROM ".static::$table_name ." ";
    
    $sql .="WHERE story_id = '".self::$db->escape_string($id)."' ";

    // print $sql;

      $obj_array = static::find_by_sql($sql);

        return $obj_array;
  
  }

    static public function find_by_story_id_and_limit($id, $start, $end)
  {

    $sql ="SELECT * FROM ".static::$table_name ." ";
    
    $sql .="WHERE story_id = '".self::$db->escape_string($id)."' ";

    $sql .=" LIMIT $start, $end ";

    // print $sql;

      $obj_array = static::find_by_sql($sql);

        return $obj_array;
  
  }

  static public function find_paragraph_in_story($user, $story)
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

  static public function find_few_paragraph($limit){

    $limit = $limit ?? false;

    $sql ="SELECT * FROM ".static::$table_name ." ";

    $sql .= "ORDER BY id DESC ";

    if ($limit) {

      $sql .= "LIMIT  " . Whiz::e($limit) . " ";

    } else {
        $sql .= "LIMIT 1000 ";

    }

    // print $sql;
    return static::find_by_sql($sql) ;

  }



    protected function validate()
    {
      $this->errors = [];
      if(Whiz::is_blank( $this->body)) {
        $this->errors[] = "Body cannot be blank.";
      }

      return $this->errors;
    }

}

