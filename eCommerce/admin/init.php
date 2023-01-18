<?php

    include 'connect.php';
    $tpl = 'includes/templates/';
    $funcs = 'includes/functions/';
    $lang = 'includes/languages/';
    include $lang.'english.php';
    include $funcs.'functions.php';
    include $tpl.'header.php';
    if(!isset($noNavbar)){include $tpl.'navbar.php';};
    
