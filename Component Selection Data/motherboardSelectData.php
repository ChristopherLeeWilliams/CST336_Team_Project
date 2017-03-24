<?php
    require_once('../connection.php');
    session_start();
    
    if($_GET["remove"] == true) {
        $_SESSION["cpuSelected"] = NULL;
    }
    
    if ($_GET["cpuId"] != NULL) {
        $_SESSION["cpuSelected"]= getCPUData($dbConn,$_GET["cpuId"]);
        
    } 
    header("Location: /Team Project/index.php");
    
    function getCPUData($dbConn, $id) {
        // Create sql statement
        $sql = "SELECT CPU.cpuId, CPU.name, CPU.price
                FROM CPU WHERE CPU.cpuId=$id";
        
        // prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        $cpu = [];
        $row = $stmt->fetch();
        $cpu["name"] = $row["name"];
        $cpu["price"] = $row["price"];
        
        return $cpu;
    }
?>