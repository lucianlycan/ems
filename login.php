<?php
session_start();

$enteredPassword = $_POST['password'];
$correctPassword = 'secret';

if ($enteredPassword === $correctPassword) {
  $_SESSION['authenticated'] = true;
  header("Location: dashboard.html");
  exit();
} else {
  header("Location: login.html?error=1");
  exit();
}
