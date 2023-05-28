<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OCR</title>
    <style>
table, td {
  border: 1px solid;
}

table {
  width: 40%;
  border-collapse: collapse;
}
</style>
</head>
<body>
    <center>
        <h1>OCR Image to Text by Abdulahmed</h1>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="file"  name="image" required/>
            <input type="submit" name="submit"/>
        </form>
    </center>
</body>
</html>