<?php include 'includes/functions.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <title>EraaSoftShop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300, 400,700|Inconsolata:400,700" rel="stylesheet">
    <link rel="stylesheet" href="asset/css/bootstrap.css">
    <link rel="stylesheet" href="asset/css/animate.css">
    <link rel="stylesheet" href="asset/css/owl.carousel.min.css">
    <link rel="stylesheet" href="asset/fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="asset/fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="asset/fonts/flaticon/font/flaticon.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="asset/css/style.css">
  </head>
  <body>

  <!-- include all classes -->
  <?php 
    spl_autoload_register(function($class){
      include "classes/$class.class.php";
    });

    $db = new DBConnect();
    $session = new Session();
    $auth = new Auth();
    $validation = new Validation();
    $product = new Products();
    $order   = new Orders();
    $cart    = new Cart();
    
  ?>