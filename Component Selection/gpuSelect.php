<?php
    require_once('../connection.php');
    session_start();
?>

<html>
    <title>GPUs</title>
    <link rel="stylesheet" type="text/css"  href="../CSS/tp.css">
    <!-- Create form to select PC parts -->
    <form name="gpuForm" method="GET" action="/Team Project/Component Selection Data/gpuSelectData.php">
        <table>
            <!-- Put column names on top of the table -->
            <tr>
                <td>Name</td>
                <td>Manufacturer</td>
                <td>Base Clock</td>
                <td>Memory</td>
                <td>Length (Inches)</td>
                <td>TDP (Watts)</td>
                <td>Price</td>
                <td>Add</td>
            </tr>
            
            <?php
                // Print out hardware parts with relevant information
                $gpu = getGPUs($dbConn);
                $i = 0;
                for($i; $i < count($gpu); $i++) {
                    echo '<tr>';
                    echo '<td>'.$gpu[$i]["gpuName"].'</td>';
                    echo '<td>'.$gpu[$i]["gpuManufacturer"].'</td>';
                    echo '<td>'.$gpu[$i]["gpuBaseClock"].'</td>';
                    echo '<td>'.$gpu[$i]["gpuMemSize"].'</td>';
                    echo '<td>'.$gpu[$i]["gpuLengthInches"].'</td>';
                    echo '<td>'.$gpu[$i]["gpuTDP"].'</td>';
                    echo '<td>$'.$gpu[$i]["gpuPrice"].'</td>';
                    echo '<td><a href="/Team Project/Component Selection Data/gpuSelectData.php?gpuId='.$gpu[$i]["gpuId"].
                         '&remove=false">add</a></td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </form>
    
</html>

<?php
    // Retrieves hardware information from PCParts DB
    function getGPUs($dbConn) {
         // Create sql statement
        $sql = "SELECT GPU.*
                FROM GPU ORDER BY gpuName";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) { 
            $component["gpuId"] = $row["gpuId"];
            $component["gpuName"] = $row["gpuName"];
            $component["gpuManufacturer"] = $row["gpuManufacturer"];
            $component["gpuBaseClock"] = $row["gpuBaseClock"];
            $component["gpuMemSize"] = $row["gpuMemSize"];
            $component["gpuLengthInches"] = $row["gpuLengthInches"];
            $component["gpuTDP"] = $row["gpuTDP"];
            $component["gpuPrice"] = $row["gpuPrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }

?>