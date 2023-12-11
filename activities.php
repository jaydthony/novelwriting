<?php  require_once './private/initialize.php';  ?>

<?php require_once SHARED_PATH.'/general_header.php'; ?>

<main class="layout">
      <div class="container">
        <div class="layout__box">
          <div class="layout__boxHeader">
            <div class="layout__boxTitle">
              <a href="<?php print Whiz::url_for("/") ?>">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                  <title>arrow-left</title>
                  <path
                    d="M13.723 2.286l-13.723 13.714 13.719 13.714 1.616-1.611-10.96-10.96h27.625v-2.286h-27.625l10.965-10.965-1.616-1.607z"
                  ></path>
                </svg>
              </a>
              <h3>Recent Activities</h3>
            </div>
          </div>

          <div class="activities-page layout__body">
          <?php foreach (Paragraph::find_few_paragraph("3") as $key): 
            
            $user = Admin::find_by_id($key->user_id);

            $story = Story::find_by_id($key->story_id);

            ?>
            <div class="activities__box">
              <div class="activities__boxHeader roomListRoom__header">
                <a href="profile.html" class="roomListRoom__author">
                  <div class="avatar avatar--small">
                    <img src="<?php print Whiz::url_for("assets/images/profile/".$user->file) ?>" />
                  </div>
                  <p>
                    <?php print Whiz::h($user->username) ?>
                    <span><?php print Whiz::time_ago($key->date_created ." ". $key->time_created) ?></span>
                  </p>
                </a>
              </div>
              <div class="activities__boxContent">
                <p>contributed to story “<a href="<?php print Whiz::url_for("room?id=".$key->id) ?>"><?php print Whiz::h($story->name) ?></a>”</p>
                <div class="activities__boxRoomContent">
                <?php print Whiz::h($key->body) ?>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </main>

<?php require_once SHARED_PATH.'/general_footer.php'; ?>
