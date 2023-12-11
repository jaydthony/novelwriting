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

class DatabaseObject{

  static protected $db;
  static protected $table_name = "";
  static protected $columns = [];
  public $errors = [];


  static public function set_database($db) {
    self::$db = $db;
  }


  static public function find_by_sql($sql) {
    $result = static::$db->query($sql);
    // print $sql;
    if(!$result) {
      exit("Database query failed.");
    }

    // results into objects
    $object_array = [];
    while($record = $result->fetch_assoc()) {
      $object_array[] = static::instantiate($record);
    }

    $result->free();

    return $object_array;
  }

  static public function find_all($option=[]){
    $order_by = $option['order_by'] ?? FALSE;

    $rank = $option['rank'] ?? FALSE;

    $assigned_to = $option['assigned_to'] ?? FALSE;


    $sql ="SELECT * FROM ".static::$table_name ." ";


  if ($assigned_to) {
      $sql .="WHERE assigned_to = '".self::$db->escape_string($assigned_to)."' ";
    }

    if ($rank) {

      $sql .= "WHERE rank  = '".Whiz::e($rank)."' ";

    }

    if ($order_by) {
      $sql .="ORDER BY  ".self::$db->escape_string(trim($order_by))." ";
    }

    // print $sql;
    return static::find_by_sql($sql) ;
  }


    static function find_by_date($start, $end,$option = []){

    $user_id = $option['user_id'] ?? FALSE;

    $limit = $option['limit'] ?? FALSE;

    $sql ="SELECT * FROM ".static::$table_name ." ";

    $sql .= " WHERE (date_only BETWEEN '".Whiz::e($start)."' AND '".Whiz::e($end)."') ";

    if ($user_id) {

    $sql.= "AND sold_by = ".Whiz::e($user_id)." ";

    }

    $sql .="ORDER BY  id DESC ";

    if ($limit) {

    $sql.= "LIMIT  ".Whiz::e($limit)." ";

    }else{
      $sql .= "LIMIT 1000 ";
    }

    // print $sql;
    return static::find_by_sql($sql) ;
  }


      static function sum_find_by_date($start, $end){

    $user_id = $option['user_id'] ?? FALSE;

    $sql ="SELECT sum(amount) FROM ".static::$table_name ." ";

    $sql .= " WHERE (date_only BETWEEN '".Whiz::e($start)."' AND '".Whiz::e($end)."') ";

    if ($user_id) {

    $sql.= "AND sold_by = ".Whiz::e($user_id)." ";

    }

    $sql .="ORDER BY  id DESC ";

    $sql .= "LIMIT 1000 ";

    // print $sql;
    return static::find_by_sql($sql) ;
  }


  static public function find_by_id($id)
  {

    $sql ="SELECT * FROM  " .static::$table_name ." ";

    $sql .="WHERE id = '".self::$db->escape_string($id)."' ";

  // print $sql;
      $obj_array = static::find_by_sql($sql);

      if (!empty($obj_array)) {
          return array_shift($obj_array);
      }else {
        return false;
      }
  }



  static protected function instantiate($record) {
  $object = new static;
  // Could manually assign values to properties
  // but automatically assignment is easier and re-usable
  foreach($record as $property => $value) {
    if(property_exists($object, $property)) {
      $object->$property = $value;
    }
  }
  return $object;
}

  protected function validate()
  {
    $this->errors = [];
    //Add custom validations
    return $this->errors;
  }

  protected function create()
  {
    $this->validate();
    if (!empty($this->errors)) {return false;}
    $attributes = $this->sanitized_attributes();
    $sql = "INSERT INTO " . static::$table_name . " (";
    $sql .=join(', ',array_keys($attributes));
    $sql .=") VALUES('";
    $sql .=join("', '", array_values($attributes));
    $sql .="') ";
    // print $sql;
    $result = self::$db->query($sql);
    if ($result) {
      $this->id = self::$db->insert_id;
    }
    return $result;
  }

  protected function update()
  {
    $this->validate();
    if (!empty($this->errors)) {return false;}
    $attributes = $this->sanitized_attributes();
    $attribute_pairs = [];
    foreach ($attributes as $key => $value) {
      $attribute_pairs[] = "{$key}='{$value}'";
    }
    $sql ="UPDATE ".static::$table_name ."  SET ";
    $sql .= join(', ', $attribute_pairs);
    $sql .=" WHERE id = '".self::$db->escape_string(trim($this->id))."' ";
    $sql .="LIMIT 1 ";
    // print $sql;
    $result = self::$db->query($sql);
    return $result;
  }

  
  public function save()
  {
    if (isset($this->id)) {
      return $this->update();
    }else {
      return $this->create();
    }
  }



  public function merge_attributes($args=[])
  {
    foreach ($args as $key => $value) {
      if (property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }
  // properties which have database column excluding ID
  public function attributes(){
    $attributes = [];

    foreach (static::$db_columns as $column) {
      if ($column == 'id') {continue;}
      $attributes[$column] = $this->$column;
    }
    return $attributes;
  }

  //Sanitizing the input coming the user.
  protected function sanitized_attributes()
  {
    $sanitized = [];
    foreach ($this->attributes() as $key => $value) {
      $sanitized[$key] = self::$db->escape_string(trim($value));
    }
    return $sanitized;
  }

  public function delete()
  {
    $sql = "DELETE FROM " .static::$table_name ." ";
    $sql .="WHERE id = '".self::$db->escape_string(trim($this->id))."' " ;
    $sql .="LIMIT 1 ";
    // print $sql;
    $result = self::$db->query($sql);
    return $result;
  }

}
