<?php

$servername = "localhost";
$username = "php_teszter";
$password = "a_(!._i2G)3*rNpm";
$dbname = "php_teszt";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST["felhasznalonev"]) and isset($_POST["jelszo"])){
    $sql = "SELECT id, nev, jelszo FROM osztaly WhERE felhasznalonev=\"".$_POST[""]."\"";
    $result = $conn->query($sql);
    if($reult->num_rows>0){
        $row=$result->fetch_assoc();
        if($row["jelzo"] === hash("sha256",$_POST["jelszo"])){
            $valasz="Belépett";
        }
        else{
            $valasz="Hibás jelszó";
        }
    }
    else{
        $valasz="Nincs ilyen felhasznalo";
    }
}

?>
<!DOCTYPE html>
<html>
<body>
<?php
if(isset($valasz))echo $valasz;
?>
<form action="login.php" method="post">

  <input type="text" name="felhasznalonev" placeholder="Felhasználó név">
  <input type="passwor" name="jelszo" placeholder="Jelszó">

  <input type="submit" value="BELÉPÉS" name="submit">

</form>
</body>
</html>