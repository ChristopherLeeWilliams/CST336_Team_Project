<?php
    require_once('../connection.php');
    session_start();
    
    if($_GET["remove"] == true) {
        $_SESSION["mbSelected"] = NULL;
    }
    
    if ($_GET["mbId"] != NULL) {
        $_SESSION["mbSelected"]= getMbData($dbConn,$_GET["mbId"]);
        
    } 
    header("Location: /Team Project/index.php");
    
    function getMbData($dbConn, $id) {
        // Create sql statement
        $sql = "SELECT Motherboard.mbId, Motherboard.mbName, Motherboard.mbPrice
                FROM Motherboard WHERE Motherboard.mbId=$id";
        
        // prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        $mb = [];
        $row = $stmt->fetch();
        $mb["mbName"] = $row["mbName"];
        $mb["mbPrice"] = $row["mbPrice"];
        
        return $mb;
    }
?>