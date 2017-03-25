<?php
    require_once('../connection.php');
    session_start();
?>

<html>
    <title>CPUs</title>
    <link rel="stylesheet" type="text/css"  href="../CSS/tp.css">
    <form name="ramForm" method="GET" action="/Team Project/Component Selection Data/ramSelectData.php">
        <table>
            <tr>
                <td>Name</td>
                <td>Type</td>
                <td>Size</td>
                <td>Speed</td>
                <td>Cas</td>
                <td>Price</td>
                <td>Add</td>
            </tr>
            
            <?php
                $ram = getRam($dbConn);
                $i = 0;
                for($i; $i < count($ram); $i++) {
                    echo '<tr>';
                    echo '<td>'.$ram[$i]["ramName"].'</td>';
                    echo '<td>'.$ram[$i]["ramType"].'</td>';
                    echo '<td>'.$ram[$i]["ramSize"].'</td>';
                    echo '<td>'.$ram[$i]["ramSpeed"].'</td>';
                    echo '<td>'.$ram[$i]["ramCas"].'</td>';
                    echo '<td>$'.$ram[$i]["ramPrice"].'</td>';
                    echo '<td><a href="/Team Project/Component Selection Data/ramSelectData.php?ramId='.$ram[$i]["ramId"].
                         '&remove=false">add</a></td>';   
                    echo '</tr>';
                }
            ?>
        </table>
    </form>
    
</html>


<?php
    function getRam($dbConn) {
         // Create sql statement
        $sql = "SELECT RAM.*, RamType.*
                FROM RAM 
                LEFT JOIN RamType
                    ON RAM.ramTypeId=RamType.ramTypeId
                ORDER BY RAM.ramName";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) { 
            $component["ramId"] = $row["ramId"];
            $component["ramName"] = $row["ramName"];
            $component["ramType"] = $row["ramType"];
            $component["ramSize"] = $row["ramSize"];
            $component["ramSpeed"] = $row["ramSpeed"];
            $component["ramCas"] = $row["ramCas"];
            $component["ramPrice"] = $row["ramPrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }

?>