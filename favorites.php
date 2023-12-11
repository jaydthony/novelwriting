<?php  require_once './private/initialize.php';  ?>

<?php require_once SHARED_PATH.'/general_header.php'; ?>

<?php

$id = $_GET['id'];

$admin = Admin::find_by_id($id);

?>

<main class="create-room layout">
      <div class="container">
        <div class="layout__box">
          <div class="layout__boxHeader">
            <div class="layout__boxTitle">
              <a href="<?php print Whiz::url_for("profile?id=".Whiz::h($id)) ?>">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                  <title>arrow-left</title>
                  <path
                    d="M13.723 2.286l-13.723 13.714 13.719 13.714 1.616-1.611-10.96-10.96h27.625v-2.286h-27.625l10.965-10.965-1.616-1.607z"
                  ></path>
                </svg>
              </a>
              <h3>Favorites</h3>
            </div>
          </div>

          <div class="topics-page layout__body">
            <form class="header__search" action="<?php print Whiz::url_for("/") ?>" method="GET">
              <label>
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                  <title>search</title>
                  <path
                    d="M32 30.586l-10.845-10.845c1.771-2.092 2.845-4.791 2.845-7.741 0-6.617-5.383-12-12-12s-12 5.383-12 12c0 6.617 5.383 12 12 12 2.949 0 5.649-1.074 7.741-2.845l10.845 10.845 1.414-1.414zM12 22c-5.514 0-10-4.486-10-10s4.486-10 10-10c5.514 0 10 4.486 10 10s-4.486 10-10 10z"
                  ></path>
                </svg>
                <input placeholder="Search for stories" name="q" />
              </label>
            </form>
            <ul class="topics__list">
            <li>
            <a href="javascript:void(0)" class="active">All <span>stories added</span></a>
            </li>
            <?php foreach (Favorite::find_by_user_id($admin->id) as $key) : 
                
                $user = Admin::find_by_id($key->user_id);

                $story = Story::find_by_id($key->story_id);
                
                ?>
            <li class="thread__details" style="justify-content: space-between;">
              <a href="<?php print Whiz::url_for("/?q=".$story->name) ?>"><?php print $story->name ?></a>
              <?php if ($logged_user->id == $admin->id) : ?>
              <a href="<?php print Whiz::url_for("fav-delete?id=".Whiz::h($key->id)) ?>" style="color: inherit;" class="delete_btn">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 32 32">
                      <title>remove</title>
                      <path
                        d="M27.314 6.019l-1.333-1.333-9.98 9.981-9.981-9.981-1.333 1.333 9.981 9.981-9.981 9.98 1.333 1.333 9.981-9.98 9.98 9.98 1.333-1.333-9.98-9.98 9.98-9.981z"
                      ></path>
                    </svg>
                  </a>
                  <?php endif; ?>
            </li>
            <?php endforeach; ?>
          </ul>
          </div>
        </div>
      </div>
    </main>

<?php require_once SHARED_PATH.'/general_footer.php'; ?>

<script type="text/javascript">
$(".delete_btn").click(function(){
    if(confirm("Are you sure you want to take this action?")){
    }
    else{
        return false;
    }
});          
  </script>