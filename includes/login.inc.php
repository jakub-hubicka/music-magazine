<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $login = $post['login'];
    $password = $post['password'];

    $Login = new App\controllers\LoginController;
    
    if ($Login->checkLogin($login, $password) === true) {
        $_SESSION['login'] = $login;
        $_SESSION['logged'] = true;

        if ($_SESSION['login'] === ':)' || $_SESSION['login'] === ':)') {
            $_SESSION['role'] = 1;
        } else {
            $_SESSION['role'] = 2;
        }
    } else {
        include 'html/login-form.html';
        die;
    }
} else {
    if (isset($_SESSION['logged'])) {
        if ($_SESSION['logged'] !== true) {
            include 'html/login-form.html';
            die;
        }
    } else {
        include 'html/login-form.html';
        die;
    }
}