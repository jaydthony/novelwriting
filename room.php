<?php  require_once './private/initialize.php';  ?>

<?php require_once SHARED_PATH.'/general_header.php'; ?>

<?php

$id = $_GET['id'] ?? "";

$story = Story::find_by_id($id);

 // setting the start from, value.
 $start = 0;

 // setting the number of paragraphs to display per chapter
 $ppc = $story->ppc;

 // get the total number of paragraphs
 $records = $db->query("SELECT * FROM paragraphs WHERE story_id = '".Whiz::e($story->id)."' ");
 
 $number_of_rows = $records->num_rows;

 // calculating the number of chapters
 $chapters = ceil($number_of_rows / $ppc);

if(isset($_GET['chapter'])) {

  $chapter = $_GET['chapter'] - 1;

  $start = $chapter * $ppc;

};

$user = Admin::find_by_id($story->host_id);

if (Whiz::is_post_request()) {

  $args = $_POST['paragraph'];

  $args['story_id'] = $story->id;

  $args['user_id'] = $logged_user->id;

  $args['username'] = $logged_user->username;

  $args['date_created'] = $date_only;

  $args['time_created'] = $time_only;

// print_r($args);
// die();

  $paragraph = new Paragraph($args);
  $result = $paragraph->save();
  if ($result === true) {
    $new_id = $paragraph->id;
    $session->message('Paragraph added successfully.');
    Whiz::redirect_to(Whiz::url_for("room?id=".$id));
  }else {
   // $errors = $result;
  }
}
else {
  $paragraph = new Paragraph;
}


?>

<?php 

if(isset($_GET['chapter'])) {
  $uid = $_GET['chapter'];
} else {
  $uid = 1;
}

?>
<main class="profile-page layout layout--2" id="<?php print $uid ?>">
      <div class="container">
        <!-- Room Start -->
        <div class="room" >
          <div class="room__top">
            <div class="room__topLeft">
              <a href="<?php print Whiz::url_for("/") ?>">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                  <title>arrow-left</title>
                  <path
                    d="M13.723 2.286l-13.723 13.714 13.719 13.714 1.616-1.611-10.96-10.96h27.625v-2.286h-27.625l10.965-10.965-1.616-1.607z"
                  ></path>
                </svg>
              </a>
              <h3>Story Room</h3>
            </div>

            <!-- <?php // if($story->sector == "private" && $logged_user->id == $story->host_id) : ?>
            <div class="room__topRight">
            <a class="" href="<?php // print Whiz::url_for("add-participants?id=".$story->id) ?>">
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                <title>add</title>
                <path
                  d="M16.943 0.943h-1.885v14.115h-14.115v1.885h14.115v14.115h1.885v-14.115h14.115v-1.885h-14.115v-14.115z"
                ></path>
              </svg>
            </a>
            <h3>Add Participants</h3>
          </div>
          <?php // endif; ?> -->

            <!-- <button class="action-button" data-id="120" data-delete-url="https://randomuser.me/api/3324923"
            data-edit-url="profile.html">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
              <title>ellipsis-horizontal</title>
              <path
                d="M16 7.843c-2.156 0-3.908-1.753-3.908-3.908s1.753-3.908 3.908-3.908c2.156 0 3.908 1.753 3.908 3.908s-1.753 3.908-3.908 3.908zM16 1.98c-1.077 0-1.954 0.877-1.954 1.954s0.877 1.954 1.954 1.954c1.077 0 1.954-0.877 1.954-1.954s-0.877-1.954-1.954-1.954z">
              </path>
              <path
                d="M16 19.908c-2.156 0-3.908-1.753-3.908-3.908s1.753-3.908 3.908-3.908c2.156 0 3.908 1.753 3.908 3.908s-1.753 3.908-3.908 3.908zM16 14.046c-1.077 0-1.954 0.877-1.954 1.954s0.877 1.954 1.954 1.954c1.077 0 1.954-0.877 1.954-1.954s-0.877-1.954-1.954-1.954z">
              </path>
              <path
                d="M16 31.974c-2.156 0-3.908-1.753-3.908-3.908s1.753-3.908 3.908-3.908c2.156 0 3.908 1.753 3.908 3.908s-1.753 3.908-3.908 3.908zM16 26.111c-1.077 0-1.954 0.877-1.954 1.954s0.877 1.954 1.954 1.954c1.077 0 1.954-0.877 1.954-1.954s-0.877-1.954-1.954-1.954z">
              </path>
            </svg>
          </button> -->
          </div>
          <div class="room__box scroll">
            <div class="room__header scroll">
              <div class="room__info">
                <h3><?php print $story->name ?></h3>
                <span><?php print Whiz::time_ago($story->date_created ." ". $story->time_created) ?></span>
              </div>
              <div class="room__hosted">
                <p>Hosted By</p>
                <a href="<?php print Whiz::url_for("profile?id=".$user->id) ?>" class="room__author">
                  <div class="avatar avatar--small">
                    <img src="<?php print Whiz::url_for("assets/images/profile/".$user->file) ?>" />
                  </div>
                  <span><?php print Whiz::h($user->username) ?></span>
                </a>
              </div>
              <div class="room__details">
              <?php print Whiz::h($story->about) ?>
              </div>
              <span class="room__topics"><?php print Whiz::h($story->wpp) ?> words </span>
              <span class="room__topics"><?php print Whiz::h($story->genre) ?></span>
              <span class="room__topics"><?php print Whiz::h($story->tags) ?></span>
              <?php if($logged_user && !Favorite::find_favorite_in_story($logged_user->id, $story->id)) : ?>
              <span class="room__topics">
              <a style="color: inherit;" href="<?php print Whiz::url_for("favorite?story_id=".Whiz::h($story->id)) ?>">add to favorites</a>
              </span>
            <?php endif; ?>
            </div>
            <div class="room__conversation">
              <div class="threads scroll">

              <?php foreach (Paragraph::find_by_story_id_and_limit($story->id, $start, $ppc) as $key): 
            
              $user = Admin::find_by_id($key->user_id);

            	$vote = 0;

              $sql = "SELECT vote FROM uservotes WHERE paragraph_id = '".Whiz::e($key->id)."' AND user_id =  '".Whiz::e($logged_user->id)."' ";

              $result = $db->query($sql);

              $rows = $result->fetch_all();

              $up = "";
              $down = "";
              
              foreach($rows as $rowv){
                $rowv['vote'];
              }

              if(!empty($rowv["vote"])) {
                $vote = $rowv["vote"];
                if($vote == -1) {
                $up = "enabled";
                $down = "disabled";
                }
                if($vote == 1) {
                $up = "disabled";
                $down = "enabled";
                }
              }

              ?>
                <div class="thread">
                  <div class="thread__top">
                    <div class="thread__author">
                      <a href="<?php print Whiz::url_for("profile?id=".Whiz::h($user->id)) ?>" class="thread__authorInfo">
                        <div class="avatar avatar--small">
                          <img src="<?php print Whiz::url_for("assets/images/profile/".$user->file) ?>" />
                        </div>
                        <span><?php print Whiz::h($user->username) ?></span>
                      </a>
                      <span class="thread__date"><?php print Whiz::time_ago($key->date_created ." ". $key->time_created) ?></span>
                    </div>
                    <?php if ($logged_user->id == $key->user_id || $logged_user->id == $story->host_id || $logged_user->username == "gm") : ?>
                    <div class="thread__delete" style="display: flex; gap: 10px;">
                    <a href="<?php print Whiz::url_for("edit-paragraph?id=".Whiz::h($key->id."&room=".Whiz::h($story->id))) ?>">
                <svg
                  enable-background="new 0 0 24 24"
                  height="32"
                  viewBox="0 0 24 24"
                  width="32"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <title>edit</title>
                  <g>
                    <path d="m23.5 22h-15c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h15c.276 0 .5.224.5.5s-.224.5-.5.5z" />
                  </g>
                  <g>
                    <g>
                      <path
                        d="m2.5 22c-.131 0-.259-.052-.354-.146-.123-.123-.173-.3-.133-.468l1.09-4.625c.021-.09.067-.173.133-.239l14.143-14.143c.565-.566 1.554-.566 2.121 0l2.121 2.121c.283.283.439.66.439 1.061s-.156.778-.439 1.061l-14.142 14.141c-.065.066-.148.112-.239.133l-4.625 1.09c-.038.01-.077.014-.115.014zm1.544-4.873-.872 3.7 3.7-.872 14.042-14.041c.095-.095.146-.22.146-.354 0-.133-.052-.259-.146-.354l-2.121-2.121c-.19-.189-.518-.189-.707 0zm3.081 3.283h.01z"
                      />
                    </g>
                    <g>
                      <path
                        d="m17.889 10.146c-.128 0-.256-.049-.354-.146l-3.535-3.536c-.195-.195-.195-.512 0-.707s.512-.195.707 0l3.536 3.536c.195.195.195.512 0 .707-.098.098-.226.146-.354.146z"
                      />
                    </g>
                  </g>
                </svg>
              </a>
                      <a href="<?php print Whiz::url_for("delete?id=".Whiz::h($key->id."&room=".Whiz::h($story->id))) ?>" class="delete_btn">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                          <title>remove</title>
                          <path
                            d="M27.314 6.019l-1.333-1.333-9.98 9.981-9.981-9.981-1.333 1.333 9.981 9.981-9.981 9.98 1.333 1.333 9.981-9.98 9.98 9.98 1.333-1.333-9.98-9.98 9.98-9.981z"
                          ></path>
                        </svg>
                      </a>
                    </div>
                    <?php endif; ?>
                  </div>
                  <div class="thread__details" id="links-<?php print $key->id ?>">
                  <?php if($logged_user) : ?>
                  <div class="btn-vote">
                    <input type="button" title="Vote Up " class="up" onClick="addVote(<?php echo $key->id; ?>,'1')" <?php print $up; ?> /> 
                    
                    <div class="label-vote"><?php print $key->netvotes ?></div>
                    
                    <input type="button" title="Vote Down" class="down" onClick="addVote(<?php print $key->id; ?>,'-1')" <?php print $down; ?> />
                  </div>
                  <?php endif; ?>
                  <div>
                    <?php print Whiz::h($key->body) ?>
                  </div>
                </div>
                <?php if($logged_user && $logged_user->id != $key->user_id) : ?>
                <div class="comment--link">
                  <a href=""></a>
                  <a href="<?php print Whiz::url_for("comment?id=".Whiz::h($key->id."&room=".Whiz::h($story->id))) ?>" class="btn--right">Comment</a>
                </div>
                <?php endif; ?>
                
                                <!-- comments sections -->
                                <?php 
                                
                                $sql = "SELECT * FROM comments WHERE paragraph_id = '".Whiz::e($key->id)."' ";
                
                                $result = $db->query($sql);
                
                                if (mysqli_num_rows($result) >= 1) : ?>
                
                                <?php while ($row = $result->fetch_assoc()) : 
                                
                                 $user = Admin::find_by_id($row['user_id']) 
                
                                ?>
                            <div class="room__conversation__coment">
                              <div class="threads__comment scroll">
                                <div class="thread__comment">
                                  <div class="thread__top">
                                    <div class="thread__author">
                                      <a href="<?php print Whiz::url_for("profile?id=".Whiz::h($user->id)) ?>" class="thread__authorInfo">
                                        <div class="avatar avatar--small">
                                          <img src="<?php print Whiz::url_for("assets/images/profile/".$user->file) ?>" />
                                        </div>
                                        <span><?php print Whiz::h($user->username) ?></span>
                                      </a>
                                      <span class="thread__date"><?php print Whiz::time_ago($row['date_created'] ." ". $row['time_created']) ?></span>
                                    </div>
                                  
                                  </div>
                                    <?php print Whiz::h($row['body']) ?>
                                  </div>
                                </div>
                                </div>
                
                                <?php endwhile; ?>
                                <?php endif; ?>
                                <!-- !comments sections -->
                </div>
                <?php endforeach ?>

            <!-- Displaying the chapter info text -->

            <div class="page-info">
              <?php if(!isset($_GET['chapter'])) {
                $story_chapter = 1; 
              } else {
                $story_chapter = $_GET['chapter'];
              } ?>
              Chapter <?php print $story_chapter ?> of <?php print $chapters ?>
            </div>

            <!-- Displaying the pagination buttons -->
            <div class="pagination">
              <a href="<?php print Whiz::url_for("room?id=".Whiz::h($story->id."&chapter=".Whiz::h(1))) ?>">First</a>
              <?php if(isset($_GET['chapter']) && $_GET['chapter'] > 1) : ?>
                      <a href="<?php print Whiz::url_for("room?id=".Whiz::h($story->id."&chapter=".Whiz::h($_GET['chapter'] -1))) ?>">Prev</a>
              <?php else : ?>
                <a>Prev</a>
              <?php endif;  ?>

              <div class="page-numbers">
              <?php for($counter = 1; $counter <= $chapters; $counter ++) { ?>
                <a href="<?php print Whiz::url_for("room?id=".Whiz::h($story->id."&chapter=".Whiz::h($counter))) ?>"><?php print $counter ?></a>
              <?php } ?>
              </div>

              <?php if(!isset($_GET['chapter'])) { ?>
                      <a href="<?php print Whiz::url_for("room?id=".Whiz::h($story->id."&chapter=".Whiz::h(2))) ?>">Next</a>
              <?php }else{
                              if($_GET['chapter'] >= $chapters) { ?>
                  <a>Next</a>
                <?php } else { ?>
                  <a href="<?php print Whiz::url_for("room?id=".Whiz::h($story->id."&chapter=".Whiz::h($_GET['chapter'] + 1))) ?>">Next</a>
                <?php } 
                      }  
                  ?>
              <a href="<?php print Whiz::url_for("room?id=".Whiz::h($story->id."&chapter=".Whiz::h($chapters))) ?>">Last</a>
            </div>

            <!-- !Displaying the chapter info text -->

              </div>
            </div>
          </div>
          <?php 

             $sql = "SELECT * FROM paragraphs WHERE `story_id` = '".Whiz::e($story->id)."'";

             $result = $db->query($sql);

             if(mysqli_num_rows($result) < $story->ppc) : ?>
          <?php if ($logged_user) : ?>
          <div class="room__message">
            <form action="<?php print Whiz::h($_SERVER['PHP_SELF']."?id=".Whiz::h($story->id)) ?>" method="POST"><input name="paragraph[body]" placeholder="Enter your contribution here... " maxlength="<?php print $story->wpp ?>" /></form>
          </div>
          <?php endif; ?>
          <?php endif; ?>
        </div>
        <!-- Room End -->

        <!--   Start -->
        <div class="participants">
          <h3 class="participants__top">Participants <span>(<?php print count(Paragraph::find_by_story_id($story->id)) ?> Joined)</span></h3>
          <div class="participants__list scroll">
          <?php foreach (Paragraph::find_by_story_id($story->id) as $key): 
            
            $user = Admin::find_by_id($key->user_id)

            ?>
            <a href="<?php print Whiz::url_for("profile?id=".$user->id) ?>" class="participant">
              <div class="avatar avatar--medium">
                <img src="<?php print Whiz::url_for("assets/images/profile/".$user->file) ?>" />
              </div>
              <p>
              <?php print Whiz::h($user->fullname) ?>
                <span><?php print Whiz::h($user->username) ?></span>
              </p>
            </a>
            <?php endforeach ?>
          </div>
        </div>
        <!--  End -->
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