<?php
    session_start();

    function checkCurrentFile($filename) {
        if($filename == 'index.php')
            return TRUE;
        else
            return FALSE;
    }

    if(checkCurrentFile(basename($_SERVER['PHP_SELF'])))
        require_once 'util/functions.php';
    else
        require_once '../util/functions.php';

    if(checkCurrentFile(basename($_SERVER['PHP_SELF']))) {
        echo <<<_INIT
                <!DOCTYPE html>
                <html>
                    <head>
                        <meta charset='utf-8'>
                        <meta name='viewport' content='width=device-width, initial-scale=1'>
                        <link rel='stylesheet' href='https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css'>
                        <link rel='stylesheet' href='css/styles.css' type='text/css'>
                        <link rel='stylesheet' href='css/styles.css' type='text/css'>
                        <script src='js/javascript.js'></script>
                        <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js'></script>
                        <script src='https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js'></script>
        _INIT;
    } else {
        echo <<<_INIT
                <!DOCTYPE html>
                <html>
                    <head>
                        <meta charset='utf-8'>
                        <meta name='viewport' content='width=device-width, initial-scale=1'>
                        <link rel='stylesheet' href='https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css'>
                        <link rel='stylesheet' href='css/styles.css' type='text/css'>
                        <link rel='stylesheet' href='../css/styles.css' type='text/css'>
                        <script src='js/javascript.js'></script>
                        <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js'></script>
                        <script src='https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js'></script>
        _INIT;
    }

    $userstr = 'Welcome Guest';

    if(isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $loggedin = TRUE;
        $userstr = "Logged in as: $user";
    } else
        $loggedin = FALSE;


    echo <<<_MAIN
                        <title>Robin's Nest: $userstr</title>
                    </head>
                    <body>
                        <div data-role='page'>
                            <div data-role='header'>
                                <div id='logo' class='center'>Edgardo's Social Network</div>
                                <div class='username'>$userstr</div>
                            </div>
                            <div data-role='content'>        
    _MAIN;
   
    if($loggedin) {
        if(checkCurrentFile(basename($_SERVER['PHP_SELF']))) {
            echo <<<_LOGGEDIN
                                <div class='center'>
                                    <a data-role='button' data-inline='true' data-icon='home' data-transition='slide' href='members/members.php?view=$user'>Home</a>
                                    <a data-role='button' data-inline='true' data-icon='user' data-transition='slide' href='members/members.php'>Members</a>
                                    <a data-role='button' data-inline='true' data-icon='heart' data-transition='slide' href='/friends/friends.php'>Friends</a>
                                    <a data-role='button' data-inline='true' data-icon='mail' data-transition='slide' href='messages/messages.php'>Messages</a>
                                    <a data-role='button' data-inline='true' data-icon='edit' data-transition='slide' href='profile/profile.php'>Edit Profile</a>
                                    <a data-role='button' data-inline='true' data-icon='action' data-transition='slide' href='logout/logout.php'>Log Out</a>
                                </div>
            _LOGGEDIN;
        } else {
            echo <<<_LOGGEDIN
                                <div class='center'>
                                    <a data-role='button' data-inline='true' data-icon='home' data-transition='slide' href='../members/members.php?view=$user'>Home</a>
                                    <a data-role='button' data-inline='true' data-icon='user' data-transition='slide' href='../members/members.php'>Members</a>
                                    <a data-role='button' data-inline='true' data-icon='heart' data-transition='slide' href='../friends/friends.php'>Friends</a>
                                    <a data-role='button' data-inline='true' data-icon='mail' data-transition='slide' href='../messages/messages.php'>Messages</a>
                                    <a data-role='button' data-inline='true' data-icon='edit' data-transition='slide' href='../profile/profile.php'>Edit Profile</a>
                                    <a data-role='button' data-inline='true' data-icon='action' data-transition='slide' href='../logout/logout.php'>Log Out</a>
                                </div>
            _LOGGEDIN;
        }
       
    } else {
        if(checkCurrentFile(basename($_SERVER['PHP_SELF']))) {
            echo <<<_GUEST
                                <div class='center'>
                                    <a data-role='button' data-inline='true' data-icon='home' data-transition='slide' href='index.php'>Home</a>
                                    <a data-role='button' data-inline='true' data-icon='plus' data-transition='slide' href='signup/signup.php'>Sign Up</a>
                                    <a data-role='button' data-inline='true' data-icon='check' data-transition='slide' href='login/login.php'>Log In</a>
                                </div>
                                <p class='info'>(You must be logged in to use this app)</p>
            _GUEST;
        } else {
            echo <<<_GUEST
                                <div class='center'>
                                    <a data-role='button' data-inline='true' data-icon='home' data-transition='slide' href='../index.php'>Home</a>
                                    <a data-role='button' data-inline='true' data-icon='plus' data-transition='slide' href='../signup/signup.php'>Sign Up</a>
                                    <a data-role='button' data-inline='true' data-icon='check' data-transition='slide' href='../login/login.php'>Log In</a>
                                </div>
                                <p class='info'>(You must be logged in to use this app)</p>
            _GUEST;
        }
        
    }
?>