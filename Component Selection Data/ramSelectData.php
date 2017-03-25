<?php
    require_once('../connection.php');
    session_start();
    
    if($_GET["remove"] == true) {
        $_SESSION["ramSelected"] = NULL;
    }
    
    if ($_GET["ramId"] != NULL) {
        $_SESSION["ramSelected"]= getRAMData($dbConn,$_GET["ramId"]);
        
    } 
    //var_dump(getRAMData($dbConn,$_GET["ramId"]));
    header("Location: /Team Project/index.php");
    
    function getRAMData($dbConn, $id) {
        // Create sql statement
        $sql = "SELECT RAM.ramId, RAM.ramName, RAM.ramPrice
                FROM RAM WHERE RAM.ramId=$id";
        
        // prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        $ram = [];
        $row = $stmt->fetch();
        $ram["ramName"] = $row["ramName"];
        $ram["ramPrice"] = $row["ramPrice"];
        
        return $ram;
    }
?>