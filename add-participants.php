<?php  require_once './private/initialize.php';  ?>

<link rel="stylesheet" href="assets/css./bootstrap.min.css">

<?php

$id = $_GET['id'] ?? "";

$story = Story::find_by_id($id);

$admin = Admin::find_by_id($story->host_id);

$query = "SELECT * FROM users ";
// $query .= " ORDER BY product_name ASC ";
// print $query;
$result = mysqli_query($db, $query);
?>

<?php Whiz::require_login(); ?>

<?php require_once SHARED_PATH.'/general_header.php'; ?>

<?php require_once SHARED_PATH.'/table_header.php'; ?>

<main class="update-account layout">
        <div class="container">
            <div class="layout__box">
                <div class="layout__boxHeader">
                    <div class="layout__boxTitle">
                        <a href="<?php print Whiz::url_for("room?id=".Whiz::h($room)) ?>">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                viewBox="0 0 32 32">
                                <title>arrow-left</title>
                                <path
                                    d="M13.723 2.286l-13.723 13.714 13.719 13.714 1.616-1.611-10.96-10.96h27.625v-2.286h-27.625l10.965-10.965-1.616-1.607z">
                                </path>
                            </svg>
                        </a>
                        <h3>Story " <?php print $story->name ?> "</h3>
                    </div>
                </div>
                <div class="layout__body">
                <!-- <form class="form"  action="<?php print Whiz::h($_SERVER['PHP_SELF']."?id=".Whiz::h($id)."&room=".Whiz::h($room)) ?>" method="POST">
                -->
                <div class="table-responsive mb-4">
                    <span class="tbl" id="<?php print Whiz::h($admin->username); ?>"></span>
                    <table id="html5-extension" class="table table-striped table-bordered table-hover" style="width:100%">
                
                 <button type="button" name="btn_assign" id="btn_assign" class="btn btn--pill">Add Participants</button>

                 <br>                                        
            <thead>
                <br>
                <tr>
                    <th>
            &nbsp;                       

                    </th>
                    <th style="color: white;">Username</th>
                </tr>
            </thead>
            <tbody>
                       
                       <span id="fdbk"></span>   
<?php

    $i = 1;

 while($assign = mysqli_fetch_assoc($result)):?>
    
    <tr id="<?php echo $assign["id"]; ?>">
        <td>

        <label class="">
  <input type="checkbox" name="user_id[]" class="checkall_inpt" value="<?php echo $assign["id"]; ?>" />
</label>
                
        </td>
        <td style="color: white;"><?php print Whiz::h($assign['username']) ?></td>      
    </tr>


<?php endwhile; ?>
                                               

                                        </tbody>
                                    </table>                                                                      
                    <!-- </form> -->
                </div>
            </div>
        </div>
      </div>
    </main>

               
<?php require_once SHARED_PATH.'/general_footer.php'; ?>
<?php require_once SHARED_PATH.'/table_footer.php'; ?>

<script>
$(document).ready(function(){
 
 $('#btn_assign').click(function(){
  var username = $(".tbl").attr('id');
  
  if(confirm("Are you sure you want to assign this?"))
  {
   var id = [];
   
   $(':checkbox:checked').each(function(i){
    id[i] = $(this).val();
   });
   
   if(id.length === 0) //tell you if the array is empty
   {
    alert("Please Select atleast one checkbox");
   }
   else
   {
    $.ajax({
     url:'assign_ajax.php?id='+username,
     method:'POST',
     data:{id:id,username:username},
     success:function(data)
     {
      for(var i=0; i<id.length; i++)
      {
       $('tr#'+id[i]+'').css('background-color', '#ccc');
       $('tr#'+id[i]+'').fadeOut('slow');
      }
      $("#fdbk").text(data)
      window.location.href = "<?php print Whiz::url_for("/users/") ?>";
     }
     
    });
   }
   
  }
  else
  {
   return false;
  }
 });
 
});
</script>



