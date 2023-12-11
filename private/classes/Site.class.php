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

class Site extends DatabaseObject {
  static protected $db_columns = ["id",
   "company_name",
   "phone",
   "company_address", 
   "owner_name",
   'logo'];

  static protected $table_name="site_settings";

public $id;
public $company_name;  
public $phone; 
public $company_address;  
public $owner_name;  
public $logo;

    public function __construct($args=[]){
      $this->company_name = $args['company_name'] ?? '';
      $this->phone = $args['phone'] ?? '';
      $this->company_address = $args['company_address'] ?? '';
      $this->owner_name = $args['owner_name'] ?? '';
      $this->logo = $args['logo'] ?? 'default.png';
    }

    protected function validate()
    {
      $this->errors = [];
      if(Whiz::is_blank( $this->company_name)) {
        $this->errors[] = "Company Name cannot be blank.";
      }elseif(!Whiz::has_length( $this->company_name, ['min' => 1, 'max' => 305])) {
        $this->errors[] = "Company Name must be between 10 and 300 characters.";
      }
      if(Whiz::is_blank( $this->phone)) {
        $this->errors[] = "Company phone cannot be blank.";
      }elseif(!Whiz::has_length( $this->phone, ['min' => 1, 'max' => 305])) {
        $this->errors[] = "Company phone must be between 10 and 300 characters.";
      }if(Whiz::is_blank( $this->owner_name)) {
        $this->errors[] = "owner name cannot be blank.";
      }
      return $this->errors;
    }
}
