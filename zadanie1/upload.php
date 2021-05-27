<?php

$name = $_POST["file_name"];

$target_dir = "../files/";
$uploadOk = 1;

// Check if file already exists
if (file_exists($target_dir.$name)) {
    $tmp = explode(".",$name);
    $tmp[sizeof($tmp)-1] = ".".$tmp[sizeof($tmp)-1];
    $name = str_replace($tmp[sizeof($tmp)-1],"", $name);
    $name = $name."_".date("Ymd_H:i:s"). $tmp[sizeof($tmp)-1];
}

$target_file = $target_dir . basename($name);

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Súbor sa neuploadol";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $name)). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

<a href="index.php">Home</a>
<a href="upload.html">Another file</a>
