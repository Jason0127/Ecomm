<?php

    if(isset($_GET['getAdminCookie'])){
        if(isset($_COOKIE['username'])){
            echo $_COOKIE['username'];
        }else{
            echo false;
        }
    }

    if(isset($_GET['getUserCookie'])){
        if(isset($_COOKIE['userAuth'])){
            echo $_COOKIE['userAuth'];
        }else{
            echo false;
        }
    }
    
?>