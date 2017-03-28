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
        $sql = "SELECT Storage.*, StorageFormFactors.*
                FROM Storage
                LEFT JOIN StorageFormFactors
                    ON Storage.storageFFId=StorageFormFactors.storageFFId
                WHERE Storage.storageId=$id";
        
        // prepare SQL
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch();
        
        echo '<table><tr><th colspan=2>Storage Description</th></tr>';
        echo '<tr><td>Name:</td><td>'.$row["storageName"].'</td></tr>';
        echo '<tr><td>Size:</td><td>'.$row["storageSize"].'</td></tr>';
        echo '<tr><td>Storage Type:</td><td>'.$row["storageType"].'</td></tr>';
        if (strcmp($row["storageType"],"SSD") != 0 ){
            echo '<tr><td>RPM:</td><td>'.$row["storageRPM"].'</td></tr>';
            echo '<tr><td>Cache:</td><td>'.$row["storageCache"].'</td></tr>';
        }
        echo '<tr><td> Price:</td><td>$'.$row["storagePrice"].'</td></tr>';
        echo '</table>';
    }
    
    function printGPUDescription($dbConn, $id) {
        $sql = "SELECT GPU.*
                FROM GPU
                WHERE GPU.gpuId=$id";
        
        // prepare SQL
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch();
        
        echo '<table><tr><th colspan=2>GPU Description</th></tr>';
        echo '<tr><td>Name:</td><td>'.$row["gpuName"].'</td></tr>';
        echo '<tr><td>GPU Memory Size:</td><td>'.$row["gpuMemSize"].'</td></tr>';
        echo '<tr><td>Base Clock:</td><td>'.$row["gpuBaseClock"].'</td></tr>';
        echo '<tr><td>Length (Inches):</td><td>'.$row["gpuLengthInches"].'</td></tr>';
        echo '<tr><td>TDP (Watts):</td><td>'.$row["gpuTDP"].'</td></tr>';
        echo '<tr><td>Manufacturer:</td><td>'.$row["gpuManufacturer"].'</td></tr>';
        echo '<tr><td>Price:</td><td>$'.$row["gpuPrice"].'</td></tr>';
        echo '</table>';
    }
    
    function printCaseDescription($dbConn, $id) {
        $sql = "SELECT `Case`.*, MBFormFactors.*
                FROM `Case`
                LEFT JOIN MBFormFactors
                    ON `Case`.caseFFId=MBFormFactors.mbFFId
                WHERE `Case`.caseId=$id";
        
        // prepare SQL
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch();
        
        echo '<table><tr><th colspan=2>Case Description</th></tr>';
        echo '<tr><td>Name:</td><td>'.$row["caseName"].'</td></tr>';
        echo '<tr><td>Compatible Motherboard:</td><td>'.$row["mbFFType"].' or smaller</td></tr>';
        echo '<tr><td>Max GPU Length (Inches):</td><td>'.$row["maxGPULengthInches"].'</td></tr>';
        echo '<tr><td>Number of 2.5" Bays:</td><td>'.$row["caseNum25Bays"].'</td></tr>';
        echo '<tr><td>Number of 3.5" Bays:</td><td>'.$row["caseNum35Bays"].'</td></tr>';
        echo '<tr><td>Price:</td><td>$'.$row["casePrice"].'</td></tr>';
        echo '</table>';
    }
    
    function printPSUDescription($dbConn, $id) {
         $sql = "SELECT PSU.*
                FROM PSU
                WHERE PSU.psuId=$id";
        
        // prepare SQL
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch();
        
        echo '<table><tr><th colspan=2>PSU Description</th></tr>';
        echo '<tr><td>Name:</td><td>'.$row["psuName"].'</td></tr>';
        echo '<tr><td>Watts:</td><td>'.$row["psuWatts"].'</td></tr>';
        echo '<tr><td>Modularity:</td><td>'.$row["psuModularity"].'</td></tr>';
        echo '<tr><td>Efficiency:</td><td>'.$row["psuEfficiency"].'</td></tr>';
        echo '<tr><td>Price:</td><td>$'.$row["psuPrice"].'</td></tr>';
        echo '</table>';
    }


?>