<?php  require_once './private/initialize.php';  ?>

<?php require_once SHARED_PATH.'/general_header.php'; ?>

<?php

$q = $_GET['q'] ?? "";

?>

<main class="layout layout--3">
<div class="container">
    <?php  require_once './components/genre.php';  ?>
    <?php  require_once './components/rooms.php';  ?>
    <?php  require_once './components/activity.php';  ?>
</div>
</main>

<?php require_once SHARED_PATH.'/general_footer.php'; ?>
