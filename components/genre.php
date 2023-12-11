<!-- Topics Start -->
<div class="topics">
          <div class="topics__header">
            <h2>Browse Genres</h2>
          </div>
          <ul class="topics__list">
            <li>
              <a href="<?php print Whiz::url_for("/") ?>" class="active">All <span><?php print count(Story::find_all()); ?></span></a>
            </li>
            <?php foreach (Story::find_distinct_genre("5") as $key) : ?>
            <li>
              <a href="<?php print Whiz::url_for("/?q=".$key->genre) ?>"><?php print $key->genre ?><span>
                <?php 
    
                $sql = "SELECT * FROM stories WHERE `genre` = '".Whiz::e($key->genre)."'";

                $result = $db->query($sql);

                print mysqli_num_rows($result); ?>

              </span></a>
            </li>
            <?php endforeach; ?>
          </ul>
          <a class="btn btn--link" href="<?php print Whiz::url_for("genres") ?>">
            More
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
              <title>chevron-down</title>
              <path d="M16 21l-13-13h-3l16 16 16-16h-3l-13 13z"></path>
            </svg>
          </a>
        </div>
        <!-- Topics End -->
