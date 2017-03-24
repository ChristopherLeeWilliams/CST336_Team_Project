<?php
    require_once('../connection.php');
    session_start();
?>

<html>
    <title>CPUs</title>
    <form name="cpuForm" metdod="GET" action="/Team Project/Component Selection Data/cpuSelectData.php">
        <table>
            <tr>
                <td>Name</td>
                <td>Base Clock</td>
                <td>#Cores</td>
                <td>Price</td>
                <td>Add</td>
            </tr>
            
            <?php
                $CPUs = getCPUs($dbConn);
                $i = 0;
                for($i; $i < count($CPUs); $i++) {
                    echo '<tr>';
                    echo '<td>'.$CPUs[$i]["name"].'</td>';
                    echo '<td>'.$CPUs[$i]["baseClock"].'</td>';
                    echo '<td>'.$CPUs[$i]["cores"].'</td>';
                    echo '<td>$'.$CPUs[$i]["price"].'</td>';
                    echo '<td><a href="/Team Project/Component Selection Data/cpuSelectData.php?cpuId='.$CPUs[$i]["cpuId"].
                         '&remove=false">add</a></td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </form>
    
</html>


<?php
    function getCPUs($dbConn) {
         // Create sql statement
        $sql = "SELECT CPU.cpuId, CPU.name, CPU.baseClock, CPU.cores, CPU.price
                FROM CPU ORDER BY CPU.name";
        
        // prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) { 
            $component["cpuId"] = $row["cpuId"];
            $component["name"] = $row["name"];
            $component["baseClock"] = $row["baseClock"];
            $component["cores"] = $row["cores"];
            $component["price"] = $row["price"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }

?>