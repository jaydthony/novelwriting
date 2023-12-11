<?php  require_once 'private/initialize.php';  ?>

<?php 

Whiz::require_login();

$id = $_GET['id'];
$room = $_GET['room'];

$paragraph = Paragraph::find_by_id($id);

if (!$paragraph) {
	
	$session->message("Paragraph Not Found");

	Whiz::redirect_to(Whiz::url_for("room?id=".Whiz::h($id)));
}

$result = $paragraph->delete($id);

if ($result) {
	
  $session->message('Paragraph was deleted successfully.');
  Whiz::redirect_to(Whiz::url_for("room?id=".Whiz::h($room)));
}

