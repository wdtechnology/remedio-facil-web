<?php
session_start();
unset($_SESSION['user_farmacia']);
unset($_SESSION['token']);
header("Location: ".BASE_URL.'login');
exit;