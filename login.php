<?php  require_once './private/initialize.php';  ?>

<?php require_once SHARED_PATH.'/general_header.php'; ?>

<?php  

$errors = [];
$username = "";
$password = "";

$user = Admin::find_by_username($logged_user->username ?? "");

if ($session->is_logged_in()) {

  Whiz::redirect_to(Whiz::url_for("/"));

}

if(Whiz::is_post_request()) {
  $Login_error_messages = "Your Credentials doesn't match our Record";
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  if (Whiz::is_blank($username)) {
    $errors[] = 'Username cannot be blank..';
  }

  if (Whiz::is_blank($password)) {
    $errors[] = 'password cannot be blank..';
  }

  if (empty($errors)) {
    $user = Admin::find_by_username($username);
    if ($user != false && $user->verify_password($password)) {
        $session->login($user);
        
        Whiz::redirect_to(Whiz::url_for("/"));

    }else {
      $errors[] = $Login_error_messages;
    }
  }
}

?>

<main class="auth layout">
      <div class="container">
        <div class="layout__box">
          <div class="layout__boxHeader">
            <div class="layout__boxTitle">
              <h3>Login</h3>
            </div>
          </div>
          <div class="layout__body">
            <h2 class="auth__tagline">Find your story partners</h2>
            <div class="container layout__body"><?php print Whiz::display_errors($errors); ?></div>
            <form class="form" action="<?php print Whiz::h($_SERVER['PHP_SELF']) ?>" method="POST">
              <div class="form__group form__group">
                <label for="room_name">Username</label>
                <input id="username" name="username" type="text" placeholder="e.g. dennis_ivy" />
              </div>
              <div class="form__group">
                <label for="password">Password</label>
                <input
                  id="password"
                  name="password"
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

                Login
              </button>
            </form>

            <div class="auth__action">
              <p>Haven't signed up yet?</p>
              <a href="<?php print Whiz::url_for("register") ?>" class="btn btn--link">Sign Up</a>
            </div>
          </div>
        </div>
      </div>
    </main>

<?php require_once SHARED_PATH.'/general_footer.php'; ?>
