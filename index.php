<?php
// https://cst336-spring17-cwiltrams4.c9users.io/phpmyadmin
$dbHost = getenv("IP");
$dbPort = 3306;
$dbName = "PCBuilder";
$dbUsername = getenv("C9_USER");
$dbPassword = "";

// Connect to database
$dbConn = new PDO("mysql:host=$dbHost;dbname=$dbName; port=$dbPort", $dbUsername, $dbPassword);

// Start Session
session_start();

?>

<!DOCTYPE html>
<html>
    <trnk rel="stylesheet" type="text/css"  href="/Team Project/CSS/tp.css">
    <head>
        <title> Team Project</title>
    </head>
    <body>
        <table>
            <tr>
                <td><b>Component</b></t>
                <td><b>Selection</b></td>
                <td><b>Price</b></td>
                <td><b>Remove</b></td>
            </tr>
            <tr>
                <td>CPU</td>
                <td>
                    <?php 
                        if ($_SESSION["cpuSelected"] == NULL) {
                            echo '<a href="/Team Project/Component Selection/cpuSelect.php"> Choose A CPU </a>';
                        } else {
                            echo 'CPU Selected';
                        }
                    ?> 
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Motherboard</td>
                <td>
                    <?php 
                        if ($_SESSION["mbSelected"] == NULL) {
                            echo '<a href="/Team Project/Component Selection/motherboardSelect.php"> Choose A Motherboard </a>';
                        } else {
                            echo 'Motherboard Selected';
                        }
                    ?>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Memory</td>
                <td>
                    <?php 
                        if ($_SESSION["ramSelected"] == NULL) {
                            echo '<a href="/Team Project/Component Selection/ramSelect.php"> Choose Memory </a>';
                        } else {
                            echo 'Memory Selected';
                        }
                    ?>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Storage</td>
                  <td>
                    <?php 
                        if ($_SESSION["storageSelected"] == NULL) {
                            echo '<a href="/Team Project/Component Selection/storageSelect.php"> Choose Storage</a>';
                        } else {
                            echo 'Storage Selected';
                        }
                    ?>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Video Card</td>
                  <td>
                    <?php 
                        if ($_SESSION["gpuSelected"] == NULL) {
                            echo '<a href="/Team Project/Component Selection/gpuSelect.php"> Choose A Video Card</a>';
                        } else {
                            echo 'Video Card Selected';
                        }
                    ?>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Case</td>
                  <td>
                    <?php 
                        if ($_SESSION["caseSelected"] == NULL) {
                            echo '<a href="/Team Project/Component Selection/caseSelect.php"> Choose A Case</a>';
                        } else {
                            echo 'Case Selected';
                        }
                    ?>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Power Supply</td>
                  <td>
                    <?php 
                        if ($_SESSION["psuSelected"] == NULL) {
                            echo '<a href="/Team Project/Component Selection/psuSelect.php"> Choose A Power Supply</a>';
                        } else {
                            echo 'Power Supply Selected';
                        }
                    ?>
                </td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </body>
</html>