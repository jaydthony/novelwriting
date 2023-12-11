<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <link href="<?php print Whiz::url_for("assets/css/bootstrap.min.css")?>" rel="stylesheet" type="text/css">
    
     
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <!-- <link rel="stylesheet" href="<?php print Whiz::url_for("assets/css/style.css") ?>" /> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>WRITING - Find novels around the world!</title>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <a class="navbar-brand py-1" href="<?php print Whiz::url_for("/") ?>">
            <img class="img-fluid" src="<?php print Whiz::url_for("assets/images/logos/" . $siteinfo->logo)?>" width="70" height="12" title="Logo" alt="Logo">
        </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav d-flex ms-auto">
      <li class="dashboard-home nav-item px-2 py-3 py-sm-4 ">
                    <a class="text-grey-400 nav-link py-0 text-center" href="<?php print Whiz::url_for("config/users/") ?>">Users</a>
                </li>
                            <li class="requests nav-item px-2 py-3 py-sm-4">
                    <a class="text-grey-400 nav-link py-0 text-center" href="<?php print Whiz::url_for("config/stories/") ?>">Stories</a>
                </li>
                            <li class="requests nav-item px-2 py-3 py-sm-4">
                    <a class="text-grey-400 nav-link py-0 text-center" href="<?php print Whiz::url_for("config/site/") ?>">Site-settings</a>
                </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container bg-primary text-white"><?php echo Whiz::display_session_message(); ?></div>

