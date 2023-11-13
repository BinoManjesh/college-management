<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        foreach ($stylesheets as $sheet) 
        {
            if (str_starts_with($sheet, 'https')) {
                echo "<link rel=\"stylesheet\" href=\"$sheet\">";
            } else {
                echo "<link rel=\"stylesheet\" href=\"styles/$sheet.css\">";
            }
        }
    ?>
    <title><?= $title ?? 'Home' ?></title>
</head>
<body>
<main>