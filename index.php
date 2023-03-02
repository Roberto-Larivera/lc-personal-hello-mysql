<?php

define("DB_SERVERNAME", "localhost:8889");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");
define("DB_NAME", "db-university");

var_dump(DB_SERVERNAME);
var_dump(DB_USERNAME);
var_dump(DB_PASSWORD);
var_dump(DB_NAME);

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

echo '<h1> CONN </h1>';
var_dump($conn);


if ($conn && $conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
} else {
    $sql = "SELECT *  FROM departments";

    $result = $conn->query($sql);
    echo '<h1> RESULT </h1>';
    var_dump($result);

    if ($result && $result->num_rows > 0) {
        // output data of each row
        echo '<h1> ROW </h1>';

        $keysRow = [];
        while ($row = $result->fetch_assoc()) {
            //echo "Stanza N. " . $row[' room number'] . " piano: " . $row[' floor'];
            var_dump($row);
            $keysRow =  array_keys($row);
        }
        var_dump($keysRow);
    } elseif ($result) {
        echo "<h2>*** 0 results ***</h2>";
    } else {
        echo "<h2>*** query error ***</h2>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello Word! mysqli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <table class="table">
        <thead>
            <tr>
                <?php
                //inserimento delle chiavi dinamico
                foreach ($keysRow as $keyRow) {
                ?>
                    <th scope="col"><?php echo $keyRow; ?></th>
                <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
            </tr>
        </tbody>
    </table>
</body>

</html>