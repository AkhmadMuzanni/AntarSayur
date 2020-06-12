<?php 
    session_start();

    $_SESSION['username'] = true;
    $_SESSION['password'] = true;

    $USERNAME = 'admin';
    $PASSWORD = 'republicvisual';

    if($_POST["username"] != $USERNAME){
        $_SESSION['username'] = false;
        header('Location: login.php');
    } else if ($_POST["password"] != $PASSWORD){
        $_SESSION['password'] = false;
        header('Location: login.php');
    } else {
        header('Location: admin.php');
    }


?>