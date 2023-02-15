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
    $db = new mysqli('localhost', 'root', '', 'bazacms');

    if(isset($_POST['submit']))
    {
        $targetDir = "img/";

        $sourceFileName = $_FILES['uploadedFile']['name'];

        $tempURL = $_FILES['uploadedFile']['tmp_name'];

        $imgInfo = @getimagesize($tempURL);
        if(!is_array($imgInfo)) 
        {
            die("BŁĄD: Przekazany plik nie jest obrazem!");
        }

        $hash = hash("sha256", $sourceFileName . hrtime(true));
        $newFileName = $hash . ".webp";

        $imageStrig = file_get_contents($tempURL);

        $gdImage = imagecreatefromstring($imageStrig);

        $targetURL = $targetDir . $newFileName;

        if(file_exists($targetURL)) 
        {
            die("BŁĄD: Podany plik już istnieje!");
        }

        imagewebp($gdImage, $targetURL);

        $dateTime = date("Y-m-d H:i:s");

        $sql = "INSERT INTO post (timestamp, filename) VALUE ('$dateTime', '$hash')";
        echo "Plik został pomyślnie wgrany na serwer";

        $db->query($sql);
        $db->close();
    }
    ?>
</body>
</html>