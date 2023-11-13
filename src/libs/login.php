<?php

if (is_post_request()) {
    //Attempt to login
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = '
        SELECT Password
        FROM user
        WHERE Username = :username
    ';
    $result = make_query($sql, [":username" => $username], true);
    $actual_pwd = $result ? $result['Password'] : null;
    if ($actual_pwd === $password) {
        session_regenerate_id();
        $_SESSION['username'] = $username;
        redirect_to('dashboard.php');
    } else {
        $error = true;
    }
}