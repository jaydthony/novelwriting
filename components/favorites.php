<!-- Favorites Start -->
<div class="topics">
          <div class="topics__header">
            <h2>Favorites</h2>
          </div>
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
        <!-- Favorites End -->

        