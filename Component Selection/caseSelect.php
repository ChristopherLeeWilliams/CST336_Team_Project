<?php
    require_once('../connection.php');
    session_start();
?>

<html>
    <title>Cases</title>
    <link rel="stylesheet" type="text/css"  href="../CSS/tp.css">
    <!-- Create form to select PC parts -->
    <form name="caseForm" method="GET" action="/Team Project/Component Selection Data/caseSelectData.php">
        <table>
            <!-- Put column names on top of the table -->
            <tr>
                <td>Name</td>
                <td>Form Factor (Motherboard)</td>
                <td>Maximum GPU Length (Inches)</td>
                <td>Total 2.5" Bays</td>
                <td>Total 3.5" Bays</td>
                <td>Price</td>
            </tr>
            
            <?php
                // Print out hardware parts with relevant information
                $case = getCases($dbConn);
                $i = 0;
                for($i; $i < count($case); $i++) {
                    echo '<tr>';
                    echo '<td>'.$case[$i]["caseName"].'</td>';
                    echo '<td>'.$case[$i]["caseFFType"].'</td>';
                    echo '<td>'.$case[$i]["maxGPULengthInches"].'</td>';
                    echo '<td>'.$case[$i]["caseNum25Bays"].'</td>';
                    echo '<td>'.$case[$i]["caseNum35Bays"].'</td>';
                    echo '<td>$'.$case[$i]["casePrice"].'</td>';
                    echo '<td><a href="/Team Project/Component Selection Data/caseSelectData.php?caseId='.$case[$i]["caseId"].
                         '&remove=false">add</a></td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </form>
    
</html>

<?php
    // Retrieves hardware information from PCParts DB
    function getCases($dbConn) {
        // Create sql statement
        $sql = "SELECT `Case`.*, MBFormFactors.*
                FROM `Case`
                LEFT JOIN MBFormFactors
                    ON `Case`.caseFFId=MBFormFactors.mbFFId
                ORDER BY `Case`.caseName";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) {
            $component["caseId"] = $row["caseId"];
            $component["caseName"] = $row["caseName"];
            $component["caseFFType"] = $row["mbFFType"];
            $component["maxGPULengthInches"] = $row["maxGPULengthInches"];
            $component["caseNum25Bays"] = $row["caseNum25Bays"];
            $component["caseNum35Bays"] = $row["caseNum35Bays"];
            $component["casePrice"] = $row["casePrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }

?>