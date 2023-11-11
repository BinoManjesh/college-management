<?php
require_once __DIR__ . '/../src/bootstrap.php';
?>

<?php view('header', ['title' => 'Dashboard']) ?>

<h1> Welcome <?= $_SESSION['username'] ?> </h1>

<?php view('footer') ?>