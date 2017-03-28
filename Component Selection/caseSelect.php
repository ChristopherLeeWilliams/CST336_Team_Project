<?php
    require_once('../connection.php');
    require_once('../descriptionFunctions.php');
    session_start();
    
    // Create sql statement
    $sql = "SELECT `Case`.*, MBFormFactors.*
            FROM `Case`, MBFormFactors
            WHERE (`Case`.caseFFId=MBFormFactors.mbFFId) ";
            
    // Save variables to session so data persists through submits, and apply filters
    // We only want to append to our search query if the value isn't null
    if ($_GET["min25Bays"] > 0) {
        $_SESSION["min25Bays"] = $_GET["min25Bays"];
        $sql .= "AND (`Case`.caseNum25Bays >= '" . $_GET["min25Bays"] . "') ";
    }
    else {
        $_SESSION["min25Bays"] = $_GET["min25Bays"];
    }
    
    if ($_GET["min35Bays"] > 0) {
        $_SESSION["min35Bays"] = $_GET["min35Bays"];
        $sql .= "AND (`Case`.caseNum35Bays >= '" . $_GET["min35Bays"] . "') ";
    }
    else {
        $_SESSION["min35Bays"] = $_GET["min35Bays"];
    }
    
    if ($_GET["maxPrice"] != null) {
        $_SESSION["maxPrice"] = $_GET["maxPrice"];
        $sql .= "AND (`Case`.casePrice <= '" . $_GET["maxPrice"] . "') ";
    }
    else {
        $_SESSION["maxPrice"] = $_GET["maxPrice"];
    }
    
    if ($_GET["orderBy"] != null) {
        $_SESSION["orderBy"] = $_GET["orderBy"];
        $sql .= "ORDER BY " . $_GET["orderBy"];
    }
    else if ($_GET["orderBy"] == null) {
        $sql .= "ORDER BY `Case`.caseName";
    }
    
    if ($_GET["sortOrder"] != null) {
        $_SESSION["sortOrder"] = $_GET["sortOrder"];
        $sql .= " " . $_GET["sortOrder"];
    }
    
    $_SESSION["sql"] = $sql;
?>

<html>
    <title>Cases</title>
    <link rel="stylesheet" type="text/css"  href="../CSS/tp.css">
    <!-- Create form to select PC parts -->
    <form name="caseForm" method="GET" action="/Team Project/Component Selection Data/caseSelectData.php">
        <div class="displayMain">
            <div class="displayInline">
                <table>
                    <!-- Put column names on top of the table -->
                    <tr>
                        <td><b>Name</b></td>
                        <td><b>Form Factor (Motherboard)</b></td>
                        <td><b>Maximum GPU Length (Inches)</b></td>
                        <td><b>2.5" Bays</b></td>
                        <td><b>3.5" Bays</b></td>
                        <td><b>Price</b></td>
                        <td></td>
                    </tr>
                    
                    <?php
                        // Print out hardware parts with relevant information
                        $case = getCases($dbConn, $_SESSION["sql"]);
                        $i = 0;
                        for($i; $i < count($case); $i++) {
                            echo '<tr>';
                            //echo '<td>'.$case[$i]["caseName"].'</td>';
                            echo '<td><a href="caseSelect.php?selectDescId='.$case[$i]["caseId"].'">'.$case[$i]["caseName"].'</a></td>';
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
            </div>
            <?php
                if($_GET["selectDescId"]!=NULL) {
                    echo '<div class="displayInlineDescription">';
                    printCaseDescription($dbConn, $_GET["selectDescId"]);
                    echo '</div>';
                }
            ?>
        </div>
    </form>
    
         <!-- Displays the form data -->
         <!-- Help saving form data across states: http://stackoverflow.com/a/2246244 -->
        <div class="form" style="padding-left: 15px;">
            <form action="caseSelect.php" method="GET">
                
                <!-- Select Minimum Number of 2.5" Bays -->
                <p><label for="min25Bays">Min. # 2.5" Bays:</label>
                <select name="min25Bays" style="width:50px">
                    <option <?php if ($_SESSION['min25Bays'] == '') { ?>selected="true" <?php }; ?> value=''></option>
                    <option <?php if ($_SESSION['min25Bays'] == 1) { ?>selected="true" <?php }; ?> value="1">1</option>
                    <option <?php if ($_SESSION['min25Bays'] == 2) { ?>selected="true" <?php }; ?> value="2">2</option>
                    <option <?php if ($_SESSION['min25Bays'] == 4) { ?>selected="true" <?php }; ?> value="4">4</option>
                    <option <?php if ($_SESSION['min25Bays'] == 6) { ?>selected="true" <?php }; ?> value="6">6</option>
                    <option <?php if ($_SESSION['min25Bays'] == 8) { ?>selected="true" <?php }; ?> value="8">8</option>
                </select></p>
                
                <!-- Select Minimum Number of 3.5" Bays -->
                <p><label for="min35Bays">Min. # 3.5" Bays:</label>
                <select name="min35Bays" style="width:50px">
                    <option <?php if ($_SESSION['min35Bays'] == '') { ?>selected="true" <?php }; ?> value=''></option>
                    <option <?php if ($_SESSION['min35Bays'] == 2) { ?>selected="true" <?php }; ?> value="2">2</option>
                    <option <?php if ($_SESSION['min35Bays'] == 4) { ?>selected="true" <?php }; ?> value="4">4</option>
                    <option <?php if ($_SESSION['min35Bays'] == 6) { ?>selected="true" <?php }; ?> value="6">6</option>
                    <option <?php if ($_SESSION['min35Bays'] == 8) { ?>selected="true" <?php }; ?> value="8">8</option>
                </select></p>
                
                <!-- Select maximum price -->
                <p><label for="maxPrice">Max Price: </label>
                <input type="number" name="maxPrice" min="0" max="1000" step=".01" style="width:100px;" value="<?php echo isset($_SESSION['maxPrice']) ? $_SESSION['maxPrice'] : '' ?>" />
                
                <!-- Select table order -->
                <p><label for="orderBy">Order By:</label>
                <select name="orderBy" style="width:150px">
                    <option <?php if ($_SESSION['orderBy'] == 'caseName') { ?>selected="true" <?php }; ?> value="caseName">Name</option>
                    <option <?php if ($_SESSION['orderBy'] == 'casePrice') { ?>selected="true" <?php }; ?> value="casePrice">Price</option>
                </select></p>
                
                <p><label for="sortOrder" style="width: 125px">Sort Order:</label>
                <input type="radio" name="sortOrder" checked <?php if ($_SESSION['sortOrder'] == 'asc') { ?>checked <?php }; ?> value="asc">Ascending &nbsp &nbsp &nbsp
                <input type="radio" name="sortOrder" <?php if ($_SESSION['sortOrder'] == 'desc') { ?>checked <?php }; ?> value="desc">Descending</p>
                
                <p><input type="submit" name="searchCases" value="Search Cases"/></p>
            </form>
    

</html>

<?php
    // Retrieves hardware information from PCParts DB
    function getCases($dbConn, $sql) {
        /*// Create sql statement
        $sql = "SELECT `Case`.*, MBFormFactors.*
                FROM `Case`
                LEFT JOIN MBFormFactors
                    ON `Case`.caseFFId=MBFormFactors.mbFFId
                ORDER BY `Case`.caseName";
        */
        
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