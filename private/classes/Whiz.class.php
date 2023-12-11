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

  class Whiz{



    static public function url_for($script_path) {

  // add the leading '/' if not present

  if($script_path[0] != '/') {

    $script_path = "/" . $script_path;

  }

  return WWW_ROOT."/writing". $script_path;

  }



  static public function is_post_request() {

  return $_SERVER['REQUEST_METHOD'] == 'POST';

}



  static public function is_get_request()

{

  return $_SERVER['REQUEST_METHOD'] == 'GET';

}



  static public function redirect_to($location)

    {

    header("Location: " . $location);

    exit;

    }



  static public function h($string){

  return htmlspecialchars($string);

  }

  static public function u($string)

  {

    return urlencode($string);

  }

  static public function r($string)

  {

    return rawurlencode($string);

  }

  static public function e($string)

  {

    global $db;

    return $db->escape_string(trim($string));

  }

static public function f($string)

  {

    return ucfirst(strtolower(Whiz::h($string)));

  }




  static public function display_errors($errors=array()) {

  $output = '';

  if(!empty($errors)) {

    $output .= "<div class='alert alert-danger'>";

    $output .= "Please fix the following errors:";

    $output .= "<ul>";

    foreach($errors as $error) {

      $output .= "<li>" . Whiz::h($error) . "</li>";

    }

    $output .= "</ul>";

    $output .= "</div>";

  }

  return $output;

}



static public function display_session_message()

{

  global $session;

  $msg = $session->message();

  if (isset($msg) && !empty($msg)) {

    $session->clear_message();

    return '<div class="container btn btn--main" style="z-index: 999;" role="alert">'

    .Whiz::h($msg). '</div>';

  }

}



  // Call require_login() at the top of any page which needs to

  // require a valid login before granting acccess to the page.

  static public function require_login() {

    global $session;

    if(!$session->is_logged_in()) {

      Whiz::redirect_to(Whiz::url_for('/'));

    } else {

      // Do nothing, let the rest of the page proceed

    }

  }


  static public function active_user()
  {
    global $logged_user;

    if ($logged_user->status == '0') {
      print "<script>alert('Your account has been deactivated')</script>";
      Whiz::redirect_to(Whiz::url_for("/logout.php"));
    }
  }

    static public function is_barman() {

    global $session;
    global $logged_user;

    if ($logged_user->rank == "Bar Man") {

  } else {

      Whiz::redirect_to(Whiz::url_for("/"));

    }

  }


  // is_blank('abcd')

  // * validate data presence

  // * uses trim() so empty spaces don't count

  // * uses === to avoid false positives

  // * better than empty() which considers "0" to be empty

  static public function is_blank($value) {

    return !isset($value) || trim($value) === '';

  }



  // has_presence('abcd')

  // * validate data presence

  // * reverse of is_blank()

  // * I prefer validation names with "has_"

  static public function has_presence($value) {

    return !Whiz::is_blank($value);

  }



  // has_length_greater_than('abcd', 3)

  // * validate string length

  // * spaces count towards length

  // * use trim() if spaces should not count

  static public function has_length_greater_than($value, $min) {

    $length = strlen($value);

    return $length > $min;

  }



  // has_length_less_than('abcd', 5)

  // * validate string length

  // * spaces count towards length

  // * use trim() if spaces should not count

  static public function has_length_less_than($value, $max) {

    $length = strlen($value);

    return $length < $max;

  }



  // has_length_exactly('abcd', 4)

  // * validate string length

  // * spaces count towards length

  // * use trim() if spaces should not count

  static public function has_length_exactly($value, $exact) {

    $length = strlen($value);

    return $length == $exact;

  }



  // has_length('abcd', ['min' => 3, 'max' => 5])

  // * validate string length

  // * combines functions_greater_than, _less_than, _exactly

  // * spaces count towards length

  // * use trim() if spaces should not count

  static public function has_length($value, $options) {

    if(isset($options['min']) && !Whiz::has_length_greater_than($value, $options['min'])) {

      return false;

    } elseif(isset($options['max']) && !Whiz::has_length_less_than($value, $options['max'])) {

      return false;

    } elseif(isset($options['exact']) && !Whiz::has_length_exactly($value, $options['exact'])) {

      return false;

    } else {

      return true;

    }

  }



  // has_inclusion_of( 5, [1,3,5,7,9] )

  // * validate inclusion in a set

  static public function has_inclusion_of($value, $set) {

  	return in_array($value, $set);

  }



  // has_exclusion_of( 5, [1,3,5,7,9] )

  // * validate exclusion from a set

  static public function has_exclusion_of($value, $set) {

    return !in_array($value, $set);

  }



  // has_string('nobody@nowhere.com', '.com')

  // * validate inclusion of character(s)

  // * strpos returns string start position or false

  // * uses !== to prevent position 0 from being considered false

  // * strpos is faster than preg_match()

  static public function has_string($value, $required_string) {

    return strpos($value, $required_string) !== false;

  }



  // has_valid_email_format('nobody@nowhere.com')

  // * validate correct format for email addresses

  // * format: [chars]@[chars].[2+ letters]

  // * preg_match is helpful, uses a regular expression

  //    returns 1 for a match, 0 for no match

  //    http://php.net/manual/en/function.preg-match.php

  static public function has_valid_email_format($value) {

    // $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';

    $email_regex = '/^[\w.%+\-]+@[\w.\-]+\.([A-Za-z]{2}|aero|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|xxx)$/';



    return preg_match($email_regex, $value) === 1;

  }

  static public function has_valid_username($value) {

    // $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';

    $username_regex = '/^[a-z\d_]{5,20}$/i';



    return preg_match($username_regex, $value) === 1;

  }



  // has_unique_page_menu_name('History')

  // * Validates uniqueness of pages.menu_name

  // * For new records, provide only the menu_name.

  // * For existing records, provide current ID as second arugment

  //   has_unique_page_menu_name('History', 4)

  static public function has_unique_topic_name($name, $current_id="0") {

    global $db;



    $sql = "SELECT * FROM news ";

    $sql .= "WHERE name='" . $db->escape_string($name) . "' ";

    $sql .= "AND id != '" . $db->escape_string($current_id) . "'";

    // echo $sql;

    $category_set = $db->query($sql);

    $category_count = mysqli_num_rows($category_set);

    mysqli_free_result($category_set);

    return $category_count === 0;

  }



  static public function has_unique_admin_username($username, $current_admin_id="0") {

    $admin = Admin::find_by_username($username);

    if ($admin === false || $admin->id == $current_admin_id) {

      return true;

    }else {

      return false;

    }

  }


  static public function has_unique_email($email, $current_admin_id="0") {

    $admin = Admin::find_by_email($email);

    if ($admin === false || $admin->id == $current_admin_id) {

      return true;

    }else {

      return false;

    }

  }


  static public function has_unique_password($password, $current_admin_id="0") {

    $admin = Admin::find_by_password($password);

    if ($admin === false || $admin->id == $current_admin_id) {

      return true;

    }else {

      return false;

    }

  }


    static public function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
      $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
  }


   public static function random_number($length = 13) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return strtolower($randomString);
}

  public static function forum_slug($id,$string)
 {
      $slug = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($string."-".Whiz::random_number(10))));
      return "/forum/".$id."-".$slug.".html";
 }


   public static function music_slug($id,$string)
 {
      $slug = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($string."-".Whiz::random_number(10))));
      return "/music/".$id."-".$slug.".html";
 }


   public static function video_slug($id,$string)
 {
      $slug = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($string."-".Whiz::random_number(10))));
      return "/videos/".$id."-".$slug.".html";
 }



public static function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}


public static function time_ago($time)
{
   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

   $time = strtotime($time);

       $difference     = $now - $time;
       $tense         = "ago";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$j].= "s";
   }

   return "$difference $periods[$j] ago ";
}

   public static function ago($timestamp)
 {
      $time_ago = strtotime($timestamp);
      $current_time = time();
      $time_difference = $current_time - $time_ago;
      $seconds = $time_difference;
      $minutes      = round($seconds / 60 );           // value 60 is seconds
      $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec
      $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;
      $weeks          = round($seconds / 604800);          // 7*24*60*60;
      $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60
      $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60
      if($seconds <= 60)
      {
     return "Just Now";
   }
      else if($minutes <= 60)
      {
     if($minutes==1)
           {
       return "one minute ago";
     }
     else
           {
       return "$minutes minutes ago";
     }
   }
      else if($hours <= 24)
      {
     if($hours==1)
           {
       return "an hour ago";
     }
           else
           {
       return "$hours hrs ago";
     }
   }else if($days <= 7)
      {
     if($days==1)
           {
       return "yesterday";
     }
           else
           {
       return "$days days ago";
     }
   }
        else if($months <= 12)
      {
     if($months==1)
           {
       return "a month ago";
     }
           else
           {
       return "$months months ago";
     }
   }
        else if($months >12)
      {
     if($years==1)
           {
       return "a year ago";
     }
           else
           {
       return "$years years ago";
     }
   }
 }

}
