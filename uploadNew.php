<?php

if (isset($_POST['submit'])) {
    $file = $_FILES['image'];

    $file_name = $_FILES['image']['name'];
    $file_temp = $_FILES['image']['tmp_name'];
    $file_size = $_FILES['image']['size'];
    $file_error = $_FILES['image']['error'];
    $file_type = $_FILES['image']['type'];

    $file_ext = explode('.', $file_name);
    $file_actual_ext = strtolower(end($file_ext));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($file_actual_ext, $allowed)) {

        if ($file_error === 0) {

            if ($file_size < 1000000) {
                $new_file_name = uniqid('', true).".".$file_actual_ext;
                $file_destination = 'images/'.$new_file_name;
                $moved = move_uploaded_file($file_temp, $file_destination);

                echo "<h1>UPLOADED IMAGE</h1>";
                echo '<img src="images/'.$new_file_name.'" width="500px">';

                shell_exec('"Tesseract-OCR/tesseract" "images/'.$new_file_name.'" out');

                echo "<br><br><h1>TEXT RESULT</h1><h1><pre>";

                $text_file = fopen('out.txt', 'r') or die('Unable to read file');
                $result = fread($text_file, filesize("out.txt"));


                // $replace = str_replace(" ", ",", $result);
                // $replace = str_replace(["\r", "\n"], ",", $result);
                // $replace = str_replace([" ", "\n", ",,"], ",", $result);
                $replace = str_replace([" ", "\n", "  "], " ", $result);
                $replaceOfReplace = str_replace(["BVN ", "FIRST ", "NAME ", "MIDDLE ", "LAST ", "DATE ", "OF ", "BIRTH ", "REGISTRATION ", "DATE ", "PHONE ", "NUMBER ", "GENDER "], "", trim($replace, " "));

                $exploded = explode(' ', $replaceOfReplace);

                print_r($exploded);
                echo $replace."<br>";
                echo $replaceOfReplace;
                fclose($text_file);

                echo "</pre></h1>";

            } else {
                echo "File too large";
            }

        } else {
            echo "Error uploading file";
        }

    } else {
        echo "You cannot upload this type of file";
    }

}

