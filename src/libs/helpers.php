<?php

function view(string $filename, array $data = []): void {
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    require_once __DIR__ . '/../inc/' . $filename . '.php';
}

function is_post_request(): bool {
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
}

function is_get_request(): bool {
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'GET';
}

function redirect_to(string $url): void {
    header('Location:' . $url);
    exit;
}

function ensureLogin() {
    if (!isset($_SESSION['user_data'])){
        redirect_to('login.php');
        exit();
    }
}
