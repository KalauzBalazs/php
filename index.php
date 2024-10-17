<?php

    $servername = "localhost";
    $username = "php_teszter";
    $password = "3bjmyQi4AyjhHwpr";
    $dbname = "php_teszt";


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


/*
        foreach ($osztaly as $kulcs => $sor){
            foreach ($sor as $oszlop=>$nev){
                $sql = "INSERT INTO osztaly (nev, sor, oszlop) VALUES ('$nev', $kulcs, $oszlop)";

                if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }
        }}
*/
    

    $name="";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["keresett_nev"])) {
          $nameErr = "Nem írtál be nevet";
        } else {
            if(strlen($_POST["keresett_nev"])<2){
                $nameErr = "Nem írtál be legalább két karaktert!";
            }
            else{
                $name = $_POST["keresett_nev"];

            }
        }
    }      
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Ülésrend</title>
    </head>


<body>
    <div>
        <h1>Ülésrend</h1>
    </div>
    <?php

        if(isset($nameErr))echo $nameErr;
    ?>
    <form action="index.php" method="post">
        <div>
            <input type="text" name="keresett_nev" value="<?php echo $name?>">
            <input type="submit" value="KERESÉS">
        </div>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Első Oszlop</th>
                <th scope="col">Folyosó</th>
                <th scope="col">Második Oszlop</th>
                <th scope="col">Harmadik Oszlop </th>
                <th scope="col">Folyosó</th>
                <th scope="col">Negyedik Oszlop</th>
                <th scope="col">Ötödik Oszlop</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $sor = NULL;

            $sql = "SELECT id, nev, sor, oszlop FROM osztaly ORDER BY sor, oszlop";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                // output data of each row
                while($row = $result->fetch_assoc()) {
                    // echo "id: " . $row["id"]. " - Name: " . $row["nev"]. " " . $row["sor"]. "  " . $row["oszlop"]." <br>";

                    if($sor !== $row["sor"]) {
                        if($sor !== NULL) {
                            echo "</tr>";
                        }
                        ?>
                        <tr>
                            <th scope="row"><?php echo $row["sor"] + 1; ?></th>
                            <?php
                        $sor = $row["sor"];
                    }
                    $class="";
                    if(!empty($name)){
                        if(strpos($row["nev"],$name)!==false){
                            $class='class="border border-info"';
                        }
                    }
                    echo "<td $class>" . $row["nev"]. "</td>";
                    if($row["oszlop"] == 0 or $row["oszlop"] == 2) {
                        echo "<td> </td>";
                    }
                }
            } 
            else {
                echo "0 results";
            }

            ?>
            </tr>
        </tbody>
    </table>

    <style>
        body {
            padding: 60px;
            text-align: center;
            background-color: rgba(236, 232, 227, 0.842);
        }
    </style>

</body>

</html>
<?php
$conn->close();
?>