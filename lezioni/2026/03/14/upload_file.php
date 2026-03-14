<?php
$tmp_path = $_FILES["documento"]["tmp_name"];
$original_name = basename($_FILES["documento"]["name"]);
$destination = "uploads/".$original_name;
move_uploaded_file($tmp_path, $destination);