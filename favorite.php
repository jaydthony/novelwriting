<?php  require_once 'private/initialize.php';  ?>

<?php 

Whiz::require_login();

$id = $_GET['story_id'];

$story = Story::find_by_id($id);

if (!$story) {
	
	$session->message("Story Not Found");

	Whiz::redirect_to(Whiz::url_for("room?id=".Whiz::h($id)));
}

if (Whiz::is_get_request()) {
  $args = [];

  $args['user_id'] = $logged_user->id;

  $args['story_id'] = $id;

  $args['date_created'] = $date_only;

  $args['time_created'] = $time_only;

// print_r($args);
// die();

  $favorite = new Favorite($args);
  $result = $favorite->save();
  if ($result === true) {
    $new_id = $favorite->id;
    $session->message('Story added to Favorites.');
    Whiz::redirect_to(Whiz::url_for("room?id=".$id));
  }

}