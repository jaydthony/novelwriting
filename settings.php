<?php  require_once './private/initialize.php';  ?>

<?php require_once SHARED_PATH.'/general_header.php'; ?>

<?php

$id = $_GET['id'] ?? "";

$admin = Admin::find_by_id($id);

if ($admin == false) {

  Whiz::redirect_to(Whiz::url_for("/"));

}

if (Whiz::is_post_request()) {

$args = $_POST['admin'];

if (empty($_FILES['file']['name'])) { 

 $args['file'] = $admin->file;

 $admin->merge_attributes($args);

 $result = $admin->save();

 if ($result) {
     
  $_SESSION['username'] = $admin->username;

  $session->message('Profile was Updated successfully.');

  Whiz::redirect_to(Whiz::url_for("profile?id=".$id));

 }
 
}    

    // =============  File Upload Code d  ===========================================
    $target_dir = "/assets/images/profile/";
    // unlink($target_dir);

    // $_FILES["file"]["name"] = Whiz::random_number();
    $target_file = $target_dir.basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $ext = pathinfo($target_file,PATHINFO_EXTENSION);
    $newFileName = Whiz::h($logged_user->username).Whiz::random_number().".$ext";
    // $_FILES["file"]["size"];

    // Check if file already exists
    if (file_exists($target_file)) {
        $session->message("Sorry, file already exists.");
        Whiz::redirect_to(Whiz::url_for("settings?id=".$id));
        $uploadOk = 0;
    }

     // Check file size -- Kept for 7Mb
    if ($_FILES["file"]["size"] > 3000000) {
        $session->message("Sorry, your file is too large, Maximum size is 1mb.");
        Whiz::redirect_to(Whiz::url_for("settings?id=".$id));
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($ext != "jpg" && $ext != "jpeg" && $ext != "png" && $ext != "gif") {
        $session->message("Sorry, only jpeg, jpg, png & gif images are allowed.");
        Whiz::redirect_to(Whiz::url_for("settings?id=".$id));
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $session->message("Sorry, your file was not uploaded.");
        Whiz::redirect_to(Whiz::url_for("settings?id=".$id));
    // if everything is ok, try to upload file

    } else {

        if (move_uploaded_file($_FILES["file"]["tmp_name"], "./assets/images/profile/".$newFileName)) {

          $args['file'] = $newFileName;

          $admin->merge_attributes($args);

          $result = $admin->save();

          if ($result) {
              
            $_SESSION['username'] = $admin->username;

            $session->message('Profile was Updated successfully.');
          
            Whiz::redirect_to(Whiz::url_for("profile?id=".$id));
          
          }

        } else {

            $session->message('Sorry, there was an error uploading your file.');

            Whiz::redirect_to(Whiz::url_for("settings?id=".$id));

        }
  }


 }else {

  // Display the form

 }


?>

<main class="create-room layout">
      <div class="container">
        <div class="layout__box">
          <div class="layout__boxHeader">
            <div class="layout__boxTitle">
              <a href="<?php print Whiz::url_for("/") ?>">
                <svg
                  version="1.1"
                  xmlns="http://www.w3.org/2000/svg"
                  width="32"
                  height="32"
                  viewBox="0 0 32 32"
                >
                  <title>arrow-left</title>
                  <path
                    d="M13.723 2.286l-13.723 13.714 13.719 13.714 1.616-1.611-10.96-10.96h27.625v-2.286h-27.625l10.965-10.965-1.616-1.607z"
                  ></path>
                </svg>
              </a>
              <h3>Settings</h3>
            </div>
          </div>

          <div class="settings layout__body">
            <div class="settings__avatar">
              <div class="avatar avatar--large active">
                <img src="assets/avatar.svg" id="preview-avatar" />
              </div>
            </div>
            <form class="form"  action="<?php print Whiz::h($_SERVER['PHP_SELF']."?id=".Whiz::h($admin->id)) ?>" method="POST" enctype="multipart/form-data">
              <div class="form__group form__avatar">
                <label for="avatar">Upload Avatar</label>
                <input
                  class="form__hide"
                  type="file"
                  name="file"
                  id="avatar"
                />
              </div>
                <div class="container layout__body">
                  <?php print Whiz::display_errors($admin->errors); ?>    
              </div>
              <div class="form__group">
                <label for="name">Full Name</label>
                <input
                  id="fullname"
                  name="admin[fullname]"
                  type="text"
                  placeholder="e.g. Dennis Ivy"
                  value="<?php print Whiz::h($admin->fullname) ?>"
                />
              </div>
              <div class="form__group">
                <label for="username">Username</label>
                <input
                  id="username"
                  name="admin[username]"
                  type="text"
                  placeholder="e.g. @dennis_ivy"
                  value="<?php print Whiz::h($admin->username) ?>"
                />
              </div>
              <div class="form__group">
                <label for="email">Email</label>
                <input id="email" name="admin[email]" value="<?php print Whiz::h($admin->email) ?>" type="email" placeholder="e.g. user@domain.com" />
              </div>
              <div class="form__group">
                <label for="about">About</label>
                <textarea name="admin[bio]" id="about" value="<?php print Whiz::h($admin->bio) ?>" placeholder="Write about yourself..."><?php print Whiz::h($admin->bio) ?></textarea>
              </div>
              <div class="form__action">
                <a class="btn btn--dark" href="<?php print Whiz::url_for("profile?id=".$id) ?>">Cancel</a>
                <button class="btn btn--main" type="submit">Update Settings</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>

<?php require_once SHARED_PATH.'/general_footer.php'; ?>
