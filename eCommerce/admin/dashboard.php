<?php 
    session_start();
    if(isset($_SESSION['UserSession']))
    {
        $pageTitle = 'Dashboard';
       include 'init.php';
    }else
    {
        header('location: index.php');
    }