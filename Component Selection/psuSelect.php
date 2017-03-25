<?php
    require_once('../connection.php');
    session_start();
?>

<html>
    <title>PSUs</title>
    <link rel="stylesheet" type="text/css"  href="../CSS/tp.css">
    <!-- Create form to select PC parts -->
    <form name="psuForm" method="GET" action="/Team Project/Component Selection Data/psuSelectData.php">
        <table>
            <!-- Put column names on top of the table -->
            <tr>
                <td>Name</td>
                <td>Watts</td>
                <td>Modularity</td>
                <td>Price</td>
                <td>Add</td>
            </tr>
            
            <?php
                // Print out hardware parts with relevant information
                $psu = getPSUs($dbConn);
                $i = 0;
                for($i; $i < count($psu); $i++) {
                    echo '<tr>';
                    echo '<td>'.$psu[$i]["psuName"].'</td>';
                    echo '<td>'.$psu[$i]["psuWatts"].'</td>';
                    echo '<td>'.$psu[$i]["psuModularity"].'</td>';
                    echo '<td>$'.$psu[$i]["psuPrice"].'</td>';
                    echo '<td><a href="/Team Project/Component Selection Data/psuSelectData.php?psuId='.$psu[$i]["psuId"].
                         '&remove=false">add</a></td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </form>
    
</html>

<?php
    // Retrieves hardware information from PCParts DB
    function getPSUs($dbConn) {
         // Create sql statement
        $sql = "SELECT psuId, psuName, psuWatts, psuModularity, psuPrice 
                FROM PSU ORDER BY psuName";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) { 
            $component["psuId"] = $row["psuId"];
            $component["psuName"] = $row["psuName"];
            $component["psuWatts"] = $row["psuWatts"];
            $component["psuModularity"] = $row["psuModularity"];
            $component["psuPrice"] = $row["psuPrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }

?>