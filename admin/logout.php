<?php
require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/auth.php';
logout();
header('Location: login.php');
