<?php  require_once './private/initialize.php';  ?>

<?php require_once SHARED_PATH.'/general_header.php'; ?>

<?php  

if (Whiz::is_post_request()) {

  $args = $_POST['admin'];

  $args['date_created'] = $date_only;

  $args['time_created'] = $time_only;

  $args['file'] = 'avatar.svg';

 // print_r($args);
 // die();
 
    $admin = new Admin($args);
    $result = $admin->save();
    if ($result === true) {
      $new_id = $admin->id;
      Whiz::redirect_to(Whiz::url_for("login"));
    }else {
      
    }
  }
  else {
    $admin = new Admin;
  }

?>

<main class="auth layout">
      <div class="container">
        <div class="layout__box">
          <div class="layout__boxHeader">
            <div class="layout__boxTitle">
              <h3>Sign up</h3>
            </div>
          </div>
          <div class="layout__body">
            <h2 class="auth__tagline">Find your story partners</h2>
            <?php echo Whiz::display_errors($admin->errors); ?>                                   
            <form class="form" action="<?php print Whiz::h($_SERVER['PHP_SELF']) ?>" method="POST">
              <div class="form__group form__group">
                <label for="fullname">Full Name</label>
                <input id="fullname" name="admin[fullname]" type="text" placeholder="e.g. Dennis Ivy" />
              </div>
              <div class="form__group form__group">
                <label for="room_name">Username</label>
                <input id="username" name="admin[username]" type="text" placeholder="e.g. dennis_ivy" />
              </div>
              <!-- <div class="form__group form__group">
                <label for="room_name">Email</label>
                <input id="email" name="admin[email]" type="text" placeholder="e.g. dennis_ivy@gmail.com" />
              </div> -->
              <div class="form__group">
                <label for="password">Password</label>
                <input
                  id="password"
                  name="admin[password]"
                  type="password"
                  placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                />
              </div>

              <div class="form__group">
                <label for="confirm_password">Confirm Password</label>
                <input
                  id="confirm_password"
                  name="admin[confirm_password]"
                  type="password"
                  placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                />
              </div>

              <button class="btn btn--main" type="submit">
                <svg
                  version="1.1"
                  xmlns="http://www.w3.org/2000/svg"
                  width="32"
                  height="32"
                  viewBox="0 0 32 32"
                >
                  <title>lock</title>
                  <path
                    d="M27 12h-1v-2c0-5.514-4.486-10-10-10s-10 4.486-10 10v2h-1c-0.553 0-1 0.447-1 1v18c0 0.553 0.447 1 1 1h22c0.553 0 1-0.447 1-1v-18c0-0.553-0.447-1-1-1zM8 10c0-4.411 3.589-8 8-8s8 3.589 8 8v2h-16v-2zM26 30h-20v-16h20v16z"
                  ></path>
                  <path
                    d="M15 21.694v4.306h2v-4.306c0.587-0.348 1-0.961 1-1.694 0-1.105-0.895-2-2-2s-2 0.895-2 2c0 0.732 0.413 1.345 1 1.694z"
                  ></path>
                </svg>

                Sign Up
              </button>
            </form>

            <div class="auth__action">
              <p>Already have an account?</p>
              <a href="<?php print Whiz::url_for("login") ?>" class="btn btn--link">Log In</a>
            </div>
          </div>
        </div>
      </div>
    </main>

<?php require_once SHARED_PATH.'/general_footer.php'; ?>
