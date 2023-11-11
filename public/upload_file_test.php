<?php
require_once __DIR__ . '/../src/bootstrap.php';
if (is_post_request()) {
    upload_file('course-material');
}
?>

<?php view('header', ['title' => 'Profile Pic Test']); ?>

<form action="upload_file_test.php" method="post" enctype="multipart/form-data">
    <label for="course-material">Profile Picture</label>
    <input type="file" id="course-material" name="course-material">
    <button type="submit">Submit</button>
</form>

<?php view('footer'); ?>
