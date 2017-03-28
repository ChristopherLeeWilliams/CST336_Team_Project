<?php
    require_once('connection.php');
    
    function printCPUDescription($dbConn, $id) {
        // Create sql statement
        $sql = "SELECT CPU.*, Socket.*
                FROM CPU 
                LEFT JOIN Socket
                    ON CPU.cpuSocketId=Socket.socketId
                WHERE CPU.cpuId=$id";
        
        // prepare SQL
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch();
        
        echo '<table><tr><th colspan=2>CPU Description</th></tr>';
        echo '<tr><td>Name:</td><td>'.$row["cpuName"].'</td></tr>';
        echo '<tr><td>Base Clock:</td><td>'.$row["cpuBaseClock"].'</td></tr>';
        echo '<tr><td> Number of Cores:</td><td>'.$row["cpuNumCores"].'</td></tr>';
        echo '<tr><td> TDP (Watts):</td><td>'.$row["cpuTDP"].'</td></tr>';
        echo '<tr><td> Price:</td><td>$'.$row["cpuPrice"].'</td></tr>';
        echo '<tr><td> Socket:</td><td>'.$row["socketType"].'</td></tr>';
        echo '<tr><td> Manufacturer:</td><td>'.$row["cpuManufacturer"].'</td></tr>';
        echo '</table>';
    }

    function printMotherboardDescription($dbConn, $id) {
        // Create sql statement
        $sql = "SELECT Motherboard.*, Socket.*, MBFormFactors.*, RamType.* 
                FROM Motherboard
                LEFT JOIN Socket
                    ON Motherboard.mbSocketId=Socket.socketId
                LEFT JOIN MBFormFactors
                    ON Motherboard.mbFFId=MBFormFactors.mbFFId
                LEFT JOIN RamType
                    ON Motherboard.mbRamTypeId=RamType.ramTypeId
                WHERE Motherboard.mbId=$id";
        
        // prepare SQL
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch();
        
        echo '<table><tr><th colspan=2>Motherboard Description</th></tr>';
        echo '<tr><td>Name:</td><td>'.$row["mbName"].'</td></tr>';
        echo '<tr><td>Socket:</td><td>'.$row["socketType"].'</td></tr>';
        echo '<tr><td>Form Factor:</td><td>'.$row["mbFFType"].'</td></tr>';
        echo '<tr><td>Number of Memory Slots:</td><td>'.$row["mbNumRamSlots"].'</td></tr>';
        echo '<tr><td>Max Memory:</td><td>'.$row["maxRamGB"]. 'GB</td></tr>';
        echo '<tr><td>Memory Type:</td><td>'.$row["ramType"].'</td></tr>';
        echo '<tr><td>Number of Sata Ports:</td><td>'.$row["mbNumSata3Ports"].'</td></tr>';
        echo '<tr><td>Price:</td><td>$'.$row["mbPrice"].'</td></tr>';
        echo '</table>';
    }

    function printRamDescription($dbConn, $id) {
                // Create sql statement
        $sql = "SELECT RAM.*, RamType.*
                FROM RAM 
                LEFT JOIN RamType
                    ON RAM.ramTypeId=RamType.ramTypeId
                WHERE RAM.ramId=$id";
        
        // prepare SQL
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch();
        
        echo '<table><tr><th colspan=2>Memory Description</th></tr>';
        echo '<tr><td>Name:</td><td>'.$row["ramName"].'</td></tr>';
        echo '<tr><td>Memory Type:</td><td>'.$row["ramType"].'</td></tr>';
        echo '<tr><td>Speed:</td><td>'.$row["ramSpeed"].'</td></tr>';
        echo '<tr><td>CAS:</td><td>'.$row["ramCas"].'</td></tr>';
        echo '<tr><td>Size:</td><td>'.$row["ramSizeGB"].'GB</td></tr>';
        echo '<tr><td> Price:</td><td>$'.$row["ramPrice"].'</td></tr>';
        echo '</table>';
    }
    
    function printStorageDescription($dbConn, $id) {
        
    }
    
    function printGPUDescription($dbConn, $id) {
        
    }
    
    function printCaseDescription($dbConn, $id) {
        
    }
    
    function printPSUDescription($dbConn, $id) {
        
    }


?>