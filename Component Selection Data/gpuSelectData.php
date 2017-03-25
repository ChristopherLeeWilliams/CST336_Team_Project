<?php
    require_once('../connection.php');
    session_start();
    
    // Used to display information on hub page
    if($_GET["remove"] == true) {
        $_SESSION["gpuSelected"] = NULL;
    }
    
    if ($_GET["gpuId"] != NULL) {
        $_SESSION["gpuSelected"]= getGPUData($dbConn,$_GET["gpuId"]);
        
    } 
    header("Location: /Team Project/index.php");
    
    function getGPUData($dbConn, $id) {
        // Create sql statement
        $sql = "SELECT gpuId, gpuName, gpuManufacturer, gpuLengthInches, gpuPrice 
                FROM GPU WHERE gpuId=$id";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        $gpu = [];
        $row = $stmt->fetch();
        $gpu["gpuName"] = $row["gpuName"];
        $gpu["gpuPrice"] = $row["gpuPrice"];
        
        return $gpu;
    }
?>