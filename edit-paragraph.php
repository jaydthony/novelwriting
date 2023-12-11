<?php  require_once 'private/initialize.php';  ?>

<?php require_once SHARED_PATH.'/general_header.php'; ?>

<?php 

Whiz::require_login();

$id = $_GET['id'];
$room = $_GET['room'];

$paragraph = Paragraph::find_by_id($id);

if (!$paragraph) {
	
	$session->message("Paragraph Not Found");

	Whiz::redirect_to(Whiz::url_for("room?id=".Whiz::h($room)));
}

if (Whiz::is_post_request()) {

  $args = $_POST['paragraph'];
  
   $paragraph->merge_attributes($args);
  
   $result = $paragraph->save();
  
   if ($result) {
       
    $session->message('Paragraph was Edited successfully.');
  
    Whiz::redirect_to(Whiz::url_for("room?id=".Whiz::h($room)));
  
   }
   
}

?>

<main class="update-account layout">
        <div class="container">
            <div class="layout__box">
                <div class="layout__boxHeader">
                    <div class="layout__boxTitle">
                        <a href="<?php print Whiz::url_for("room?id=".Whiz::h($room)) ?>">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                viewBox="0 0 32 32">
                                <title>arrow-left</title>
                                <path
                                    d="M13.723 2.286l-13.723 13.714 13.719 13.714 1.616-1.611-10.96-10.96h27.625v-2.286h-27.625l10.965-10.965-1.616-1.607z">
                                </path>
                            </svg>
                        </a>
                        <h3>Edit your contribution</h3>
                    </div>
                </div>
                <div class="layout__body">
                <form class="form"  action="<?php print Whiz::h($_SERVER['PHP_SELF']."?id=".Whiz::h($id)."&room=".Whiz::h($room)) ?>" method="POST">
                <div class="form__group">
                <label for="body">Paragraph</label>
                <textarea name="paragraph[body]" id="about" value="<?php print Whiz::h($paragraph->body) ?>" placeholder="Contribution"><?php print Whiz::h($paragraph->body) ?></textarea>
              </div>
              <div class="form__action">
                            <a class="btn btn--dark" href="<?php print Whiz::url_for("room?id=".Whiz::h($room)) ?>">Cancel</a>
                            <button class="btn btn--main" type="submit">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </main>

<?php require_once SHARED_PATH.'/general_footer.php'; ?>