
        <!-- Activities Start -->
        <div class="activities">
          <div class="activities__header">
            <h2>Recent Activities</h2>
          </div>
          <?php foreach (Paragraph::find_few_paragraph("3") as $key): 
            
            $user = Admin::find_by_id($key->user_id);

            $story = Story::find_by_id($key->story_id);

            ?>
            <div class="activities__box">
              <div class="activities__boxHeader roomListRoom__header">
                <a href="<?php print Whiz::url_for("profile?id=".Whiz::h($user->id)) ?>" class="roomListRoom__author">
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
        <!-- Activities End -->
