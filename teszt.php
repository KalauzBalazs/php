<?php

if(isset($_FILES["fileToUpload"])){
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);


    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "A ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " fájl feltöltve.";
    } else {
        echo "Hiba történt a feltöltés során.";
    }}
?>
<!DOCTYPE html>
<html>
<body>

<form action="teszt.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">

</form>
</body>
</html>