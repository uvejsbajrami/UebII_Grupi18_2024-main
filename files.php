<?php
include 'db.php';

$file = fopen("example.txt", "w") or die("Unable to open file!");

fwrite($file, "Hello World!");

fclose($file);


$file = fopen("example.txt", "r") or die("Unable to open file!");

$content = fread($file, filesize("example.txt"));
if ($content === false) {
    die("Error reading file!");
}

fclose($file);


?>
