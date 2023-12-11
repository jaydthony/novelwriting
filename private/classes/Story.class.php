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

class Story extends DatabaseObject {
  static protected $db_columns = ["id",  "name", "host_id", "username", "genre", "tags", "wpp", "ppc", "sector", "about", "date_created", "time_created"];
  static protected $table_name="stories";
    public $id;
    public $name;
    public $host_id;
    public $username;
    public $genre;
    public $tags;
    public $wpp;
    public $ppc;
    public $sector;
    public $about;
    public $date_created;
    public $time_created;


    public function __construct($args=[]){

      global $logged_user;

      $this->name = $args['name'] ?? '';

      $this->host_id = $args['host_id'] ?? '';
      
      $this->username = $args['username'] ?? '';

      $this->genre = $args['genre'] ?? '';

      $this->tags = $args['tags'] ?? '';

      $this->wpp = $args['wpp'] ?? '';

      $this->ppc = $args['ppc'] ?? '';

      $this->sector = $args['sector'] ?? '';

      $this->about = $args['about'] ?? '';

      $this->date_created = $args['date_created'] ?? '';

      $this->time_created = $args['time_created'] ?? '';

    }

    static public function find_by_name($name)
  {

    $sql ="SELECT * FROM ".static::$table_name ." ";
    
    $sql .="WHERE name = '".self::$db->escape_string($name)."' ";

    // print $sql;

      $obj_array = static::find_by_sql($sql);

      if (!empty($obj_array)) {
          return array_shift($obj_array);
      }else {
        return false;
      }
  }

    static public function find_by_host_id($id)
  {

    $sql ="SELECT * FROM ".static::$table_name ." ";
    
    $sql .="WHERE host_id = '".self::$db->escape_string($id)."' ";

    // print $sql;

      $obj_array = static::find_by_sql($sql);

        return $obj_array;
  
  }

    static public function find_by_genre($genre)
  {

    $sql ="SELECT * FROM ".static::$table_name ." ";
    
    $sql .="WHERE genre = '".self::$db->escape_string($genre)."' ";

    // print $sql;

      $obj_array = static::find_by_sql($sql);

      if (!empty($obj_array)) {
          return array_shift($obj_array);
      }else {
        return false;
      }
  }

  static public function find_distinct_genre($limit){

    $limit = $limit ?? false;

    $sql ="SELECT DISTINCT genre FROM ".static::$table_name ." ";

    if ($limit) {

      $sql .= "LIMIT  " . Whiz::e($limit) . " ";

    } else {
        $sql .= "LIMIT 1000 ";
    }

    // print $sql;
    return static::find_by_sql($sql) ;

  }

  static public function search_story($q)

  {

    $sql ="SELECT * FROM ".static::$table_name ." ";

    $sql .="WHERE name LIKE '%".self::$db->escape_string($q)."%' ";
    
    $sql .="OR genre LIKE '%".self::$db->escape_string($q)."%' ";
    
    $sql .="OR tags LIKE '%".self::$db->escape_string($q)."%' ";
    
    $sql .="OR username LIKE '%".self::$db->escape_string($q)."%' ";
    
    $sql .="ORDER BY id DESC ";
    
  if (static::find_by_sql($sql) < 1 ) {

      print "<h4 class=''>" ."No result found" . "</h4>";

  }

    // print $sql;
    return static::find_by_sql($sql) ;

  }


    protected function validate()
    {
      $this->errors = [];
      if(Whiz::is_blank( $this->name)) {
        $this->errors[] = "Story Name cannot be blank.";
      }elseif(!Whiz::has_length( $this->name, ['min' => 1, 'max' => 305])) {
        $this->errors[] = "Story Name must be between 10 and 300 characters.";
      }
      
      if(Whiz::is_blank( $this->genre)) {
        $this->errors[] = "Story genre cannot be blank.";
      }elseif(!Whiz::has_length( $this->genre, ['min' => 1, 'max' => 305])) {
        $this->errors[] = "Story genre must be between 10 and 300 characters.";
      }

      if(Whiz::is_blank( $this->tags)) {
        $this->errors[] = "Story tags cannot be blank.";
      }elseif(!Whiz::has_length( $this->tags, ['min' => 1, 'max' => 305])) {
        $this->errors[] = "Story tags must be between 10 and 300 characters.";
      }

      if(Whiz::is_blank( $this->wpp)) {
        $this->errors[] = "Story wpp cannot be blank.";
      }

      if(Whiz::is_blank( $this->ppc)) {
        $this->errors[] = "Story ppc cannot be blank.";
      }

      if(Whiz::is_blank( $this->sector)) {
        $this->errors[] = "Story sector cannot be blank.";
      }elseif(!Whiz::has_length( $this->sector, ['min' => 1, 'max' => 305])) {
        $this->errors[] = "Story sector must be between 10 and 300 characters.";
      }

      if(Whiz::is_blank( $this->about)) {
        $this->errors[] = "Story about cannot be blank.";
      }elseif(!Whiz::has_length( $this->about, ['min' => 1, 'max' => 305])) {
        $this->errors[] = "Story about must be between 10 and 300 characters.";
      }

      return $this->errors;
    }

}

