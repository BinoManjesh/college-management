<?php

function logout(){
    session_destroy();
    unset($_SESSION['user_data']);
    session_start();
}

if (isset($_GET['logout'])) {
    logout();
    redirect_to('login.php');
}

if (is_post_request()) {
    logout();
    //Attempt to login
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = '
        SELECT *
        FROM user
        WHERE Username = :username
    ';
    $result = make_query($sql, [":username" => $username], true,true);
    $actual_pwd = $result ? $result['Password'] : null;
    if ($actual_pwd === $password) {
        session_regenerate_id();
        $_SESSION['user_data'] = $result;
        redirect_to('dashboard.php');
    } else {
        $error = true;
    }
}