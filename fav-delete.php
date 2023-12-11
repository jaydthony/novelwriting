<?php  require_once 'private/initialize.php';  ?>

<?php 

Whiz::require_login();

$id = $_GET['id'];

$favorite = Favorite::find_by_id($id);

if (!$favorite) {
	
	$session->message("Favorite Not Found");

	Whiz::redirect_to(Whiz::url_for("profile?id=".Whiz::h($logged_user->id)));
}

$result = $favorite->delete($id);

if ($result) {
	
  $session->message('Favorite was deleted successfully.');
  Whiz::redirect_to(Whiz::url_for("profile?id=".Whiz::h($logged_user->id)));
}

