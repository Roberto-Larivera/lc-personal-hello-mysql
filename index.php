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
        while ($row = $result->fetch_assoc()) {
            //echo "Stanza N. " . $row[' room number'] . " piano: " . $row[' floor'];
            var_dump($row);
        }
    } elseif ($result) {
        echo "<h2>*** 0 results ***</h2>";
    } else {
        echo "<h2>*** query error ***</h2>";
    }
}
?>

