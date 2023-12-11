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

class Admin extends DatabaseObject

{


  static protected $db_columns = ["id","username","hashed_password","fullname","email","bio","date_created","time_created","file"];

  static protected $table_name="users";

public $id;
public $username;
public $password;
public $confirm_password;
protected $hashed_password;
public $fullname;
public $email;
public $bio;
public $date_created;
public $time_created;
public $file;
protected $password_required = true;

  public function __construct($args=[]){

    $this->username = $args['username'] ?? '';
    
    $this->password = $args['password'] ?? '';

    $this->confirm_password = $args['confirm_password'] ?? '';

    $this->fullname = $args['fullname'] ?? '';

    $this->email = $args['email'] ?? '';

    $this->bio = $args['bio'] ?? '';

    $this->date_created = $args['date_created'] ?? '';

    $this->time_created = $args['time_created'] ?? '';

    $this->file = $args['file'] ?? '';

  }


  protected function set_hash_password()

  {

    $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);

  }

  public function verify_password($password)

  {

    return password_verify($password,$this->hashed_password);

  }



  //Overiding and Create and Calling the Parent....

  protected function create()

  {

    $this->set_hash_password();

    return parent::create();

  }

  //Overiding and Update and Calling the Parent....

  protected function update()

  {

    if ($this->password != "") {

      $this->set_hash_password();

    }else {

      $this->password_required=false;

    }

    return parent::update();

  }


  // validate method for Admin class

  protected function validate() {

    $this->errors = [];


    if(Whiz::is_blank($this->fullname)) {

      $this->errors[] = "Full name cannot be blank.";

    } elseif (!Whiz::has_length($this->fullname, array('max' => 50))) {

      $this->errors[] = "Full Name  must be less than 50 characters.";

    }

    if (!Whiz::has_length($this->bio, array('max' => 500))) {

      $this->errors[] = "Your about must be less than 500 characters.";

    }

     if(Whiz::is_blank($this->username)) {

       $this->errors[] = "Name cannot be blank.";

     } elseif (!Whiz::has_length($this->username, array('min' => 0, 'max' => 255))) {

       $this->errors[] = "Name must be between 3 and 255 characters.";

     }elseif (!Whiz::has_unique_admin_username($this->username,$this->id ?? 0)) {

       $this->errors[] = "Name already exist try another.";

     }
     elseif (!Whiz::has_valid_username($this->username)) {

      // $this->errors[] = "Username is in an incorrect format.";

    }


    if ($this->email) {

      if(Whiz::is_blank($this->email)) {

        $this->errors[] = "Email cannot be blank.";

      } elseif (!Whiz::has_valid_email_format($this->email)) {

        $this->errors[] = "Please enter a valid Email Address";

      } elseif (!Whiz::has_unique_email($this->email,$this->id ?? 0)) {

        $this->errors[] = "Email already exist try another.";

    }

  }


  if ($this->password_required) {

    if(Whiz::is_blank($this->password)) {

      $this->errors[] = "Password cannot be blank.";

    } elseif (!Whiz::has_length($this->password, array('min' => 1))) {

      $this->errors[] = "Password must contain 2 or more characters";

    }



    if(Whiz::is_blank($this->confirm_password)) {

      $this->errors[] = "Confirm password cannot be blank.";

    } elseif ($this->password !== $this->confirm_password) {

      $this->errors[] = "Password and confirm password must match.";

    }

  }

    return $this->errors;

  }


  static public function find_by_username($username)

  {

    $sql ="SELECT * FROM  " .static::$table_name ." ";

    $sql .="WHERE username = '".self::$db->escape_string($username)."' ";

      $obj_array = static::find_by_sql($sql);



      if (!empty($obj_array)) {

          return array_shift($obj_array);

      }else {

        return false;

      }

  }

  
  static public function find_by_password($password)

  {

    $sql ="SELECT * FROM  " .static::$table_name ." ";

    $sql .="WHERE password = '".self::$db->escape_string($password)."' ";

      $obj_array = static::find_by_sql($sql);



      if (!empty($obj_array)) {

          return array_shift($obj_array);

      }else {

        return false;

      }

  }


  static public function find_by_email($email)

  {

    $sql ="SELECT * FROM  " .static::$table_name ." ";

    $sql .="WHERE email = '".self::$db->escape_string($email)."' ";

      $obj_array = static::find_by_sql($sql);



      if (!empty($obj_array)) {

          return array_shift($obj_array);

      }else {

        return false;

      }

  }

}

