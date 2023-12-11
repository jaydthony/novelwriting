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
                                    <h4 class="page-title my-2">All Stories
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
                                                <th>Story Name</th>
                                                <th>Writer Name</th>
                                                <th>Tags</th>
                                                <th>Created</th>
                                                <th class="invisible"></th>
                                                <th class="invisible"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
<?php

    $i = 1;

 foreach (Story::find_all() as $key):
 
    $user = Admin::find_by_id($key->host_id);

 ?>
    
    <tr>
        <td><?php print $i++; ?></td>
        <td><?php print Whiz::h($key->name) ?></td>
        <td><?php print Whiz::h($user->username) ?></td>
        <td><?php print Whiz::h($key->tags) ?></td>
        <td><?php print Whiz::time_ago($key->date_created ." ". $key->time_created) ?></td>
        <td>
            <a href="<?php print Whiz::url_for("config/stories/edit?id=".Whiz::h($key->id)) ?>" class="btn btn-success">Edit</a>
        </td>

        <td>
            <a href="<?php print Whiz::url_for("config/stories/delete?id=".Whiz::h($key->id)) ?>" class="btn btn-success delete_btn">Delete</a>
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