<?php
require('./../src/config.php');

?>

<form method="post" action="" enctype="multipart/form-data">
        <label for="uploadedFileInput">
            Wybierz plik do wgrania na serwer:
        </label>
        <input type="file" name="uploadedFile" id="uploadedFileInput">
        <input type="submit" value="Wyślij plik" name="submit">
</form>

<?php
 if(isset($_POST['submit'])){
    Post::upload($_FILES['uploadedFile']['tmp_name']);
 }
?>

Ostatni post:
<?php
var_dump(Post::getLast());
?>