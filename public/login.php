<?php
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/libs/login.php';
?>

<?php view('header', ['title' => 'Login']) ?>

<!-- Error message for wrong password -->
<?php if (isset($error)): ?>
<p>Wrong password or username </p>
<?php endif ?>

<form action="login.php" method="post">
    <label for="username">Username:</label>
    <input name="username" id="username" type="text">
    <label for="password">Password:</label>
    <input name="password", id="password" type="password">
    <button type="submit"> Login</button>
</form>

<?php view('footer') ?>
