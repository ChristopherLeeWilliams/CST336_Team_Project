<?php
    require_once('../connection.php');
    session_start();
?>

<html>
    <title>mbs</title>
    <link rel="stylesheet" type="text/css"  href="../CSS/tp.css">
    <form name="motherboardForm" method="GET" action="/Team Project/Component Selection Data/motherboardSelectData.php">
        <table>
            <tr>
                <td><B>Name</b></td>
                <td>Socket</td>
                <td>Form Factor</td>
                <td>#Ram Slots</td>
                <td>Ram Type</td>
                <td>Price</td>
                <td>Add</td>
            </tr>
            
            <?php
                $mbs = getMotherboards($dbConn);
                $i = 0;
                for($i; $i < count($mbs); $i++) {
                    echo '<tr>';
                    echo '<td>'.$mbs[$i]["mbName"].'</td>';
                    echo '<td>'.$mbs[$i]["socketType"].'</td>';
                    echo '<td>'.$mbs[$i]["mbFFType"].'</td>';
                    echo '<td>'.$mbs[$i]["mbNumRamSlots"].'</td>';
                    echo '<td>'.$mbs[$i]["ramType"].'</td>';
                    echo '<td>$'.$mbs[$i]["mbPrice"].'</td>';
                    echo '<td><a href="/Team Project/Component Selection Data/motherboardSelectData.php?mbId='.$mbs[$i]["mbId"].
                         '&remove=false">add</a></td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </form>
    
</html>


<?php
    function getMotherboards($dbConn) {
         // Create sql statement
        $sql = "SELECT Motherboard.*, Socket.*, MBFormFactors.*, RamType.* 
                FROM Motherboard
                LEFT JOIN Socket
                    ON Motherboard.mbSocketId=Socket.socketId
                LEFT JOIN MBFormFactors
                    ON Motherboard.mbFFId=MBFormFactors.mbFFId
                LEFT JOIN RamType
                    ON Motherboard.mbRamTypeId=RamType.ramTypeId";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;

        while($row = $stmt->fetch()) { 
            $component["mbId"] = $row["mbId"];
            $component["mbName"] = $row["mbName"];
            $component["socketType"] = $row["socketType"];
            $component["mbFFType"] = $row["mbFFType"];
            $component["mbNumRamSlots"] = $row["mbNumRamSlots"];
            $component["ramType"] = $row["ramType"];
            $component["mbPrice"] = $row["mbPrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        return $componentArr;
    }
?>