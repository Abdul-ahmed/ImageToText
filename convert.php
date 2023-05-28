<?php

if (isset($_FILES['image'])) {
    $file_name = $_FILES['image']['name'];
    $file_temp = $_FILES['image']['tmp_name'];
    move_uploaded_file($file_temp, "images/".$file_name);

    echo "<h3>Uploaded Image</h3>";
    echo '<img src="images/'.$file_name.'">';

    shell_exec('"C:\\Program Files (x86)\\Tesseract-OCR\\tesseract" "C:\\laragon\\www\\ocrtessarat\\images\\'.$file_name.'" out');

}

