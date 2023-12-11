<?php  require_once '../../private/initialize.php';  ?>

<?php Whiz::require_login(); ?>

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
                                    <h4 class="page-title my-2">All Users
</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card m-b-20">
                                    <div class="card-body">
     
<div class="table-responsive">
<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Full Name</th>
                                                <th>Username</th>
                                                <th>Rank</th>
                                                <th>Joined</th>
                                                <th class="invisible"></th>
                                                <th class="invisible"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
<?php

    $i = 1;

 foreach (Admin::find_all() as $key): ?>
    
    <tr>
        <td><?php print $i++; ?></td>
        <td><img class="img-fluid mr-3" style="width: 70px; height:70px;" src="<?php print Whiz::url_for("assets/images/profile/".$key->file) ?>" alt="">&nbsp;&nbsp;&nbsp;</td>
        <td><?php print Whiz::h($key->fullname) ?></td>
        <td><?php print Whiz::h($key->username) ?></td>
        <td><?php 
        
        if ($logged_user->username =="Admin") {
            print "Admin";
        } else {
            print "Writer";
        }

        ?>

        </td>
        <td><?php print Whiz::time_ago($key->date_created ." ". $key->time_created) ?></td>
        <td>
            <a href="<?php print Whiz::url_for("config/users/edit?id=".Whiz::h($key->id)) ?>" class="btn btn-success">Edit</a>
        </td>

        <td>
            <a href="<?php print Whiz::url_for("config/users/delete?id=".Whiz::h($key->id)) ?>" class="btn btn-success delete_btn">Delete</a>
        </td>        
    </tr>


<?php endforeach ?>
                                               

                                        </tbody>
                                    </table>
</div>                                                                        

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
        

                    </div> <!-- container-fluid -->

                </div> <!-- content -->

<?php require_once '../footer.php'; ?>
<?php require_once SHARED_PATH.'/table_footer.php'; ?>

<script type="text/javascript">
$(".delete_btn").click(function(){
    if(confirm("Are you sure you want to take this action?")){
    }
    else{
        return false;
    }
});          
  </script>