<?php

require_once './private/initialize.php';

// $message = " logs out of the application";

// Notification::postNotification($logged_user,$message);

$session->logout();

Whiz::redirect_to(Whiz::url_for('/'));
