<?php
    require_once('../connection.php');
    session_start();
?>

<html>
    <title>Storage</title>
    <link rel="stylesheet" type="text/css"  href="../CSS/tp.css">
    <!-- Create form to select PC parts -->
    <form name="storageForm" method="GET" action="/Team Project/Component Selection Data/storageSelectData.php">
        <table>
            <!-- Put column names on top of the table -->
            <tr>
                <td>Name</td>
                <td>Size</td>
                <td>Type</td>
                <td>RPM</td>
                <td>Form Factor</td>
                <td>Price</td>
                <td>Add</td>
            </tr>
            
            <?php
                // Print out hardware parts with relevant information
                $storage = getStorages($dbConn);
                $i = 0;
                for($i; $i < count($storage); $i++) {
                    echo '<tr>';
                    echo '<td>'.$storage[$i]["storageName"].'</td>';
                    echo '<td>'.$storage[$i]["storageSize"].'</td>';
                    echo '<td>'.$storage[$i]["storageType"].'</td>';
                    echo '<td>'.$storage[$i]["storageRPM"].'</td>';
                    echo '<td>'.$storage[$i]["storageFFType"].'</td>';
                    echo '<td>$'.$storage[$i]["storagePrice"].'</td>';
                    echo '<td><a href="/Team Project/Component Selection Data/storageSelectData.php?storageId='.$storage[$i]["storageId"].
                         '&remove=false">add</a></td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </form>
    
</html>

<?php
    // Retrieves hardware information from PCParts DB
    function getStorages($dbConn) {
         // Create sql statement
        $sql = "SELECT Storage.* FROM Storage ORDER BY Storage.storageName";
        
        $sql = "SELECT Storage.*, StorageFormFactors.*
        FROM Storage 
        LEFT JOIN StorageFormFactors
            ON Storage.storageFFId=StorageFormFactors.storageFFId
        ORDER BY Storage.storageName";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) { 
            $component["storageId"] = $row["storageId"];
            $component["storageName"] = $row["storageName"];
            $component["storageSize"] = $row["storageSize"];
            $component["storageType"] = $row["storageType"];
            $component["storageRPM"] = $row["storageRPM"];
            $component["storageFFType"] = $row["storageFFType"];
            $component["storagePrice"] = $row["storagePrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }

?>