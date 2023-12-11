<?php  require_once '../../private/initialize.php';  ?>

<?php Whiz::require_login(); ?>

<?php 

$site = Site::find_by_id(1);

if (!$site) {
    
    $session->message("There was a problem");

    Whiz::redirect_to(Whiz::url_for("/config/users/"));

}

 if (Whiz::is_post_request()) {

   $args = $_POST['site'];

//    print_r($args);

//    die();

if (empty($_FILES['file']['name'])) { 

    $args['logo'] = $site->logo;

    $site->merge_attributes($args);

    $result = $site->save();

    if ($result) {
        
     $session->message('Site  Updated successfully.');

     Whiz::redirect_to(Whiz::url_for("/config/users/"));
    }
    
}    

    // =============  File Upload Code d  ===========================================
    $target_dir = "../../assets/images/logos/";
    // unlink($target_dir);

    // $_FILES["file"]["name"] = Whiz::random_number();
    $target_file = $target_dir.basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $ext = pathinfo($target_file,PATHINFO_EXTENSION);
    $newFileName = Whiz::h($logged_user->username).Whiz::random_number().".$ext";
    // $_FILES["file"]["size"];

    // Check if file already exists
    if (file_exists($target_file)) {
        $session->message("Sorry, file already exists.");
        Whiz::redirect_to(Whiz::url_for("/config/users/"));
        $uploadOk = 0;
    }

     // Check file size -- Kept for 7Mb
    if ($_FILES["file"]["size"] > 3000000) {
        $session->message("Sorry, your file is too large, Maximum size is 1mb.");
        Whiz::redirect_to(Whiz::url_for("/config/users/"));
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($ext != "jpg" && $ext != "jpeg" && $ext != "png" && $ext != "gif") {
        $session->message("Sorry, only jpeg, jpg, png & gif images are allowed.");
        Whiz::redirect_to(Whiz::url_for("/config/users/"));
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $session->message("Sorry, your file was not uploaded.");
        Whiz::redirect_to(Whiz::url_for("/config/users/"));
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], "../../assets/images/logos/".$newFileName)) {

    $args['logo'] = $newFileName;

    $site->merge_attributes($args);

    $result = $site->save();

    if ($result) {
        
     $session->message('Site  Updated successfully.');

     Whiz::redirect_to(Whiz::url_for("/config/users/"));
    }

        } else {
            $session->message('Sorry, there was an error uploading your file.');
            Whiz::redirect_to(Whiz::url_for("/config/users/"));
        }
    }




 }else {

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
                                    <h4 class="page-title">Site Settings
</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card m-b-20">
                                    <div class="card-body">
            <?php echo Whiz::display_errors($site->errors); ?>                                   
                    <form class="needs-validation"  
                    action="<?php print Whiz::h($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="col-md-6 mb-4">
                                <label for="validationCustom01">Application name</label>
                                <input value="<?php print Whiz::h($site->company_name) ?>" name="site[company_name]" type="text" class="form-control" id="validationCustom01"  required>
                                <div class="invalid-feedback">
                                    Please enter a site name!
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="validationCustomUsername">Phone</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">+234</span>
                                    </div>
                                    <input value="<?php print Whiz::h($site->phone) ?>" name="site[phone]" type="number" class="form-control" id="validationCustomUsername" placeholder="Phone" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please enter a valid phone number.
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-6 mb-4">
                                <label for="validationCustom01">Address </label>
                                <input value="<?php print Whiz::h($site->company_address) ?>" name="site[company_address]" type="text" class="form-control" id="validationCustom01"  >
                                <div class="invalid-feedback">
                                    Please enter Company Address
                                </div>
                            </div>                                
                        <div class="col-md-6 mb-4">
                                <label for="validationCustom01">Owner name</label>
                                <input value="<?php print Whiz::h($site->owner_name) ?>" name="site[owner_name]" type="text" class="form-control" id="validationCustom01"  required>
                                <div class="invalid-feedback">
                                    Please enter your name name!
                                </div>
                            </div>
                        </div>

<div class="form-row">
  <div class="form-group">
    <label for="exampleFormControlFile1">Company Logo (Leave empty if not available.)</label>
    <input name="file" type="file" class="form-control-file" id="exampleFormControlFile1">
  </div>     
  </div>                        


                        <button class="btn btn-danger mb-4 mt-3" type="submit">Update</button>
                    </form>   
                                    

   

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
        

                    </div> <!-- container-fluid -->

                </div> <!-- content -->

<?php require_once '../footer.php'; ?>
<?php require_once SHARED_PATH.'/table_footer.php'; ?>