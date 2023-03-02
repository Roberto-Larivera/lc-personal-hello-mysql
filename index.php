<?php

define("DB_SERVERNAME","localhost:8889");
define("DB_USERNAME","root");
define("DB_PASSWORD","root");
define("DB_NAME","db-university");

var_dump(DB_SERVERNAME);
var_dump(DB_USERNAME);
var_dump(DB_PASSWORD);
var_dump(DB_NAME);

$conn= new mysqli(DB_SERVERNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);


var_dump($conn);


if($conn && $conn->connect_error){
    echo "Connection failed: " . $conn->connect_error;
}

$sql = "SELECT room number, floor FROM stanze";

$result = $conn->query( $sql) ;

if ($result && $result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
    echo "Stanza N. ". $row[' room number']. " piano: ". $row[' floor'];
    }
    } elseif ($result) {
    echo "0 results";
    } else {
    echo "query error";
    }