<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="" enctype="multipart/form-data">
        <label for="uploadedFileInput">
            Wybierz plik do wgrania na serwer:
        </label>
        <input type="file" name="uploadedFile" id="uploadedFileInput">
        <input type="submit" value="Wyślij plik" name="submit">
    </form>

    <?php
    if(isset($_POST['submit']))
    {
        $targetDir = "img/";
        $sourceFileName = $_FILES['uploadedFile']['name'];
        $tempURL = $_FILES['uploadedFile']['tmp_name'];
        $targetURL = $targetDir . $sourceFileName;
        move_uploaded_file($tempURL, $targetURL);
    }
    ?>
</body>
</html>