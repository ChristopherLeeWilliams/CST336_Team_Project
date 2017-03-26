<?php
    require_once('../connection.php');
    session_start();
?>

<html>
    <title>CPUs</title>
    <link rel="stylesheet" type="text/css"  href="../CSS/tp.css">
    <!-- Create form to select PC parts -->

    <form name="cpuForm" method="GET" action="/Team Project/Component Selection Data/cpuSelectData.php">
        <table>
            <!-- Put column names on top of the table -->
            <tr>
                <td>Name</td>
                <td>Socket</td>
                <td>Base Clock</td>
                <td>#Cores</td>
                <td>TDP (Watts)</td>
                <td>Price</td>
                <td>Add</td>
            </tr>
            
            <?php
            // Print out hardware parts with relevant information
                $CPUs = getCPUs($dbConn);
                $i = 0;
                for($i; $i < count($CPUs); $i++) {
                    echo '<tr>';
                    echo '<td>'.$CPUs[$i]["cpuName"].'</td>';
                    echo '<td>'.$CPUs[$i]["socketType"].'</td>';
                    echo '<td>'.$CPUs[$i]["cpuBaseClock"].'</td>';
                    echo '<td>'.$CPUs[$i]["cpuNumCores"].'</td>';
                    echo '<td>'.$CPUs[$i]["cpuTDP"].'</td>';
                    echo '<td>$'.$CPUs[$i]["cpuPrice"].'</td>';
                    echo '<td><a href="/Team Project/Component Selection Data/cpuSelectData.php?cpuId='.$CPUs[$i]["cpuId"].
                         '&remove=false">add</a></td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </form>
    
</html>

<?php
    // Retrieves hardware information from PCParts DB
    function getCPUs($dbConn) {
         // Create sql statement
        $sql = "SELECT CPU.*, Socket.*
                FROM CPU 
                LEFT JOIN Socket
                    ON CPU.cpuSocketId=Socket.socketId
                ORDER BY CPU.cpuName";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) { 
            $component["cpuId"] = $row["cpuId"];
            $component["cpuName"] = $row["cpuName"];
            $component["cpuBaseClock"] = $row["cpuBaseClock"];
            $component["socketType"] = $row["socketType"];
            $component["cpuNumCores"] = $row["cpuNumCores"];
            $component["cpuTDP"] = $row["cpuTDP"];
            $component["cpuPrice"] = $row["cpuPrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }

?>
