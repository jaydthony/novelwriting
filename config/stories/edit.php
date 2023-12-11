<?php  require_once '../../private/initialize.php';  ?>

<?php Whiz::require_login(); ?>

<?php 

 $id = (($_GET['id']));

   $story = Story::find_by_id($id);

   if ($story == false) {

     Whiz::redirect_to(Whiz::url_for("/config/stories/"));

   }


 if (Whiz::is_post_request()) {

   $args = $_POST['story'];

    $story->merge_attributes($args);

    $result = $story->save();

    if ($result) {
        
     $session->message('Story was Updated successfully.');

     Whiz::redirect_to(Whiz::url_for("config/stories/"));
    }
    
}    


else {

  // Display the form

 }


 ?>

<?php require_once '../header.php'; ?>

<?php require_once SHARED_PATH.'/table_header.php'; ?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <h4 class="page-title my-2">
Edit Story                                    
</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card m-b-20">
                                    <div class="card-body">
<?php echo Whiz::display_errors($story->errors); ?>                                                                    
                                <form class="needs-validation"  
                                action="<?php print Whiz::h($_SERVER['PHP_SELF']."?id=".Whiz::h($story->id)) ?>" method="POST">

                            <?php require_once 'formFields.php'; ?>

                                    <button class="btn btn-danger mb-4 mt-3" type="submit">Edit</button>
                                </form>   
                                       

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
        

                    </div> <!-- container-fluid -->

                </div> <!-- content -->

<?php require_once '../footer.php'; ?>