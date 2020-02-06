<?php

    //Routes


    //Include The Important Files
    include 'includes/functions/function.php';
    include'includes/languages/english.php';
    include 'includes/templates/header.php';

    // Include Navbar On All Pages Expect The One Wuth $noNavbar Variable
    if(!isset($noNavbar)){ include 'includes/templates/navbar.php'; }
?>