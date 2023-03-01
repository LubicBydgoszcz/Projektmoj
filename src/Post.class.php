<?php
class Post {
    static function upload(string $tempFileName) {
        $targetDir = "img/";

        $imgInfo = @getimagesize($tempFileName);
        if(!is_array($imgInfo)) 
        {
            die("BŁĄD: Przekazany plik nie jest obrazem!");
        }
        $randomNumber = rand(10000, 99999) . hrtime(true);
        $hash = hash("sha256" , $randomNumber);
        $newFileName = $targetDir . $hash . ".webp";
        if(file_exists($newFileName)) 
        {
            die("BŁĄD: Podany plik już istnieje!");
        }
        $imageString = file_get_contents($tempFileName);
        $gdImage = @imagecreatefromstring($imageString);
        imagewebp($gdImage, $newFileName);
        global $db;
        $query = $db->prepare("INSERT INTO post VALUES(NULL, ?, ?)");
        $dbTimestamp = date("Y-m-d H:i:s");
        $query->bind_param("ss", $dbTimestamp, $newFileName);
        if(!$query->execute())
            die("Błąd zapisu do bazy danych");

    }
}
?>