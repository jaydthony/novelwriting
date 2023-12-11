<?php  require_once './private/initialize.php';  ?>

<?php require_once SHARED_PATH.'/general_header.php'; ?>

<?php

if (Whiz::is_post_request()) {

  $args = $_POST['story'];

  $args['host_id'] = $logged_user->id;

  $args['username'] = $logged_user->username;

  $args['date_created'] = $date_only;

  $args['time_created'] = $time_only;

// print_r($args);
// die();

  $story = new Story($args);
  $result = $story->save();
  if ($result === true) {
    $new_id = $story->id;
    $session->message('Story started successfully.');
    Whiz::redirect_to(Whiz::url_for("room?id=".Whiz::h($new_id)));
  }else {
   // $errors = $result;
  }
}
else {
  $story = new Story;
}


?>

<main class="create-room layout">
    <div class="container">
      <div class="layout__box">
        <div class="layout__boxHeader">
          <div class="layout__boxTitle">
            <a href="<?php print Whiz::url_for("/") ?>">
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                <title>arrow-left</title>
                <path
                  d="M13.723 2.286l-13.723 13.714 13.719 13.714 1.616-1.611-10.96-10.96h27.625v-2.286h-27.625l10.965-10.965-1.616-1.607z">
                </path>
              </svg>
            </a>
            <h3>Create Novel Room</h3>
          </div>
        </div>
        <div class="layout__body">
        <form class="needs-validation" novalidate 
                                action="<?php print Whiz::h($_SERVER['PHP_SELF']) ?>" method="POST">
            <div class="form__group">
              <label for="room_name">Novel Name</label>
              <input id="room_name" name="story[name]" type="text" placeholder="E.g. Mastering Python + Django" />
            </div>

            <div class="form__group">
              <label for="room_topic">Genre</label>
              <input required type="text" name="story[genre]" id="room_topic" list="topic-list" />
              <datalist id="topic-list">
                <select id="room_topic">
                  <option value="">Select your Genre</option>
                  <?php foreach (Story::find_distinct_genre(5) as $key) : ?>
                  <option value="<?php print $key->genre ?>"><?php print $key->genre ?></option>
                  <?php endforeach; ?>
                </select>
              </datalist>
            </div>

            <div class="form__group">
              <label for="room_name">Novel Tags [Comma Separated Value]</label>
              <input id="room_name" name="story[tags]" type="text" placeholder="E.g. love,drama,action,scifi" />
            </div>

            <div class="form__group">
              <label for="room_name">Max Characters per Paragraph</label>
              <input id="room_name" name="story[wpp]" type="number" placeholder="E.g. 50" />
            </div>

            <div class="form__group">
              <label for="room_name">Paragraphs Per Chapter</label>
              <input id="room_name" name="story[ppc]" type="number" placeholder="E.g. 50" />
            </div>

            <div class="form__group">
              <label for="room_topic">Story Sector</label>
                <select id="room_topic" name="story[sector]">
                  <option value="public">Public</option>
                  <option value="private">Private</option>
                </select>
            </div>

            <div class="form__group">
              <label for="room_about">About</label>
              <textarea name="story[about]" id="room_about" placeholder="Write about your story..."></textarea>
            </div>

            <div class="form__action">
              <a class="btn btn--dark" href="<?php print Whiz::url_for("/") ?>">Cancel</a>
              <button class="btn btn--main" type="submit">Create Room</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
  
<?php require_once SHARED_PATH.'/general_footer.php'; ?>
