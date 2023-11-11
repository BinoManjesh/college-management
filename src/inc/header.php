<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        foreach ($stylesheets as $sheet) 
        {
            echo "<link rel=\"stylesheet\" href=\"styles/$sheet.css\">\n";
        }
    ?>
    <title><?= $title ?? 'Home' ?></title>
</head>
<body>
<main>