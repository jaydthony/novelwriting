<?php  require_once '../../private/initialize.php';  ?>

<?php 

Whiz::require_login();

$id = $_GET['id'];

$user = Admin::find_by_id($id);

if (!$user) {
	
	$session->message("User Not Found");

	Whiz::redirect_to(Whiz::url_for("config/users/"));
}

$result = $user->delete($id);

if ($result) {
	
  $session->message('User was deleted successfully.');
  Whiz::redirect_to(Whiz::url_for("config/users/"));
}

