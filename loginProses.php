<?php 
    session_start();

    $_SESSION['username'] = true;
    $_SESSION['password'] = true;

    $USERNAME = 'admin';
    $PASSWORD = 'republicvisual';

    if($_POST["username"] != $USERNAME){
        echo "Username Salah";
        $_SESSION['username'] = false;
        header('Location: login.php');
    } else if ($_POST["password"] != $PASSWORD){
        echo "Password Salah";
        $_SESSION['password'] = false;
        header('Location: login.php');
    } else {
        header('Location: index.php');
    }


?>