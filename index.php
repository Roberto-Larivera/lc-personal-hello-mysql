<?php

define("DB_SERVERNAME", "localhost:8889");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");
define("DB_NAME", "db-university");
/*
var_dump(DB_SERVERNAME);
var_dump(DB_USERNAME);
var_dump(DB_PASSWORD);
var_dump(DB_NAME);
*/
$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
/*
echo '<h1> CONN </h1>';
var_dump($conn);
*/

if ($conn && $conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
} else {
    if($_GET && is_array($_GET)){
        if(isset($_GET['id']) && is_numeric($_GET['id'])) {

            //var_dump($_GET['id']);
            $resultGet = intval($_GET['id']);
    
            // ********** utilizzo SENZA Prepared statements
            //$sql = "SELECT *  FROM departments WHERE id = $resultGet ";

             // ********** utilizzo CON Prepared statements
             $stmt = $conn->prepare("SELECT *  FROM departments WHERE id = ? ");
             $stmt->bind_param('i', $getId);

             $getId = $resultGet;

             $stmt->execute();

             $result = $stmt->get_result();

        }
    }
    else{
        $sql = "SELECT *  FROM departments";
        $result = $conn->query($sql);

    }

    //echo '<h1> RESULT </h1>';
    //var_dump($result);

    if ($result && $result->num_rows > 0) {
        // output data of each row
        //echo '<h1> ROW </h1>';

        $keysRow = [];
        $resultRow = [];
        //*************** utilizzo la funzione  fetch_fields()
        $keysRow[] = $result->fetch_fields();
        //var_dump($keysRow);

        while ($row = $result->fetch_assoc()) {   
            //var_dump($row);
            //*************** utilizzo la funzione  array_keys()
            //$keysRow =  array_keys($row);
            $resultsRow[] = $row;
        }
        //var_dump($resultsRow);
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
        <h1>
            <?php echo $keysRow[0][0]->table; ?>
        </h1>
        <?php
            if(isset($_GET['id']) && is_numeric($_GET['id'])) {
                echo '<a href="index.php" > Torna Indietro</a>';
            }
        ?>
        <thead>
            <tr>
                <!-- *************** utilizzo la funzione  array_keys()-->
                <!-- <?php
                        //inserimento delle chiavi dinamico
                        // foreach ($keysRow as $keyRow) {
                        ?>
                    <th scope="col"><?php //echo $keyRow; 
                                    ?></th>
                <?php
                // }
                ?> -->
                <!-- *************** utilizzo la funzione  fetch_fields()-->
                <?php
                //inserimento delle chiavi dinamico
                foreach ($keysRow as $keyRow) {
                    foreach ($keyRow as $element) {

                ?>
                        <th scope="col"><?php echo $element->name; ?></th>
                <?php
                    }
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            //inserimento delle chiavi dinamico
            foreach ($resultsRow as $resultRowKey => $resultRow) {
            ?>
                <tr>
                    <?php
                    //inserimento delle chiavi dinamico
                    foreach ($resultsRow[$resultRowKey] as $key => $singleResultRow) {
                        if($key === 'name'){
                            echo '<td> <a href="index.php/?id='.$resultRow['id'].'" >'.$singleResultRow.'</td>';
                        }else{
                    ?>
                        <td><?php echo $singleResultRow; ?></td>
                    <?php
                    }
                    }
                    ?>
                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>
</body>

</html>