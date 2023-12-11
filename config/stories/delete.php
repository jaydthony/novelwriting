<?php  require_once '../../private/initialize.php';  ?>

<?php 

Whiz::require_login();

$id = $_GET['id'];

$story = Story::find_by_id($id);

if (!$story) {
	
	$session->message("Story Not Found");

	Whiz::redirect_to(Whiz::url_for("config/stories/"));
}

$result = $story->delete($id);

if ($result) {
	
  $session->message('Story was deleted successfully.');
  Whiz::redirect_to(Whiz::url_for("config/stories/"));
}

