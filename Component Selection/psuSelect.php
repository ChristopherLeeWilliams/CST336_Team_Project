<?php
    require_once('../connection.php');
    require_once('../descriptionFunctions.php');
    session_start();
    
         // Create sql statement
    $sql = "SELECT psuId, psuName, psuWatts, psuModularity, psuPrice, psuEfficiency
            FROM PSU WHERE (psuId = psuId) ";
    
    // Save variables to session so data persists through submits, and apply filters
    // We only want to append to our search query if the value isn't null
    if ($_GET["minWatts"] > 0) {
        $_SESSION["minWatts"] = $_GET["minWatts"];
        $sql .= "AND (PSU.psuWatts >= '" . $_GET["minWatts"] . "') ";
    }
    else {
        $_SESSION["minWatts"] = $_GET["minWatts"];
    }
    
    if ($_GET["modularity"] != null) {
        $_SESSION["modularity"] = $_GET["modularity"];
        $sql .= "AND (PSU.psuModularity = '" . $_GET["modularity"] . "') ";
    }
    else {
        $_SESSION["modularity"] = $_GET["modularity"];
    }
    
    if ($_GET["maxPrice"] != null) {
        $_SESSION["maxPrice"] = $_GET["maxPrice"];
        $sql .= "AND (PSU.psuPrice <= '" . $_GET["maxPrice"] . "') ";
    }
    else {
        $_SESSION["maxPrice"] = $_GET["maxPrice"];
    }
    
    if ($_GET["orderBy"] != null) {
        $_SESSION["orderBy"] = $_GET["orderBy"];
        $sql .= "ORDER BY " . $_GET["orderBy"];
    }
    else if ($_GET["orderBy"] == null) {
        $sql .= "ORDER BY PSU.psuName";
    }
    
    if ($_GET["sortOrder"] != null) {
        $_SESSION["sortOrder"] = $_GET["sortOrder"];
        $sql .= " " . $_GET["sortOrder"];
    }
    
    $_SESSION["sql"] = $sql;
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
                <td>Efficiency</td>
                <td>Modularity</td>
                <td>Price</td>
                <td>Add</td>
            </tr>
            
            <?php
                // Print out hardware parts with relevant information
                $psu = getPSUs($dbConn, $_SESSION["sql"]);
                $i = 0;
                for($i; $i < count($psu); $i++) {
                    echo '<tr>';
                    //echo '<td>'.$psu[$i]["psuName"].'</td>';
                    echo '<td><a href="psuSelect.php?selectDescId='.$psu[$i]["psuId"].'">'.$psu[$i]["psuName"].'</a></td>';
                    echo '<td>'.$psu[$i]["psuWatts"].'</td>';
                    echo '<td>'.$psu[$i]["psuEfficiency"].'</td>';
                    echo '<td>'.$psu[$i]["psuModularity"].'</td>';
                    echo '<td>$'.$psu[$i]["psuPrice"].'</td>';
                    echo '<td><a href="/Team Project/Component Selection Data/psuSelectData.php?psuId='.$psu[$i]["psuId"].
                         '&remove=false">add</a></td>';
                    echo '</tr>';
                }
                
                if($_GET["selectDescId"]!=NULL) {
                    printPSUDescription($dbConn, $_GET["selectDescId"]);
                }
            ?>
        </table>
    </form>
    
        <!-- Displays the form data -->
         <!-- Help saving form data across states: http://stackoverflow.com/a/2246244 -->
        <div class="form" style="padding-left: 15px;">
            <form action="psuSelect.php" method="GET">
                <!-- Select Minimum Watts -->
                <p><label for="minWatts">Minimum Watts:</label>
                <select name="minWatts" style="width:50px">
                    <option <?php if ($_SESSION['minWatts'] == '') { ?>selected="true" <?php }; ?> value=''></option>
                    <option <?php if ($_SESSION['minWatts'] == 500) { ?>selected="true" <?php }; ?> value="500">500</option>
                    <option <?php if ($_SESSION['minWatts'] == 750) { ?>selected="true" <?php }; ?> value="750">750</option>
                    <option <?php if ($_SESSION['minWatts'] == 1000) { ?>selected="true" <?php }; ?> value="1000">1000</option>
                    <option <?php if ($_SESSION['minWatts'] == 1250) { ?>selected="true" <?php }; ?> value="1250">1250</option>
                    <option <?php if ($_SESSION['minWatts'] == 1500) { ?>selected="true" <?php }; ?> value="1500">1500</option>
                </select></p>
                
                <!-- Select Modularity-->
                <p><label for="modularity">Modularity:</label>
                <select name="modularity" style="width:150px">
                    <option <?php if ($_SESSION['modularity'] == '') { ?>selected="true" <?php }; ?> value=''></option>
                    <option <?php if ($_SESSION['modularity'] == 'Semi') { ?>selected="true" <?php }; ?> value="Semi">Semi</option>
                    <option <?php if ($_SESSION['modularity'] == 'Full') { ?>selected="true" <?php }; ?> value="Full">Full</option>
                    <option <?php if ($_SESSION['modularity'] == 'No') { ?>selected="true" <?php }; ?> value="No">No</option>
                </select></p>
                
                <!-- Select maximum price -->
                <p><label for="maxPrice">Max Price: </label>
                <input type="number" name="maxPrice" min="0" max="1000" step=".01" style="width:100px;" value="<?php echo isset($_SESSION['maxPrice']) ? $_SESSION['maxPrice'] : '' ?>" />
                
                <!-- Select table order -->
                <p><label for="orderBy">Order By:</label>
                <select name="orderBy" style="width:150px">
                    <option <?php if ($_SESSION['orderBy'] == 'psuName') { ?>selected="true" <?php }; ?> value="psuName">Name</option>
                    <option <?php if ($_SESSION['orderBy'] == 'psuPrice') { ?>selected="true" <?php }; ?> value="psuPrice">Price</option>
                </select></p>
                
                <p><label for="sortOrder" style="width: 125px">Sort Order:</label>
                <input type="radio" name="sortOrder" checked <?php if ($_SESSION['sortOrder'] == 'asc') { ?>checked <?php }; ?> value="asc">Ascending &nbsp &nbsp &nbsp
                <input type="radio" name="sortOrder" <?php if ($_SESSION['sortOrder'] == 'desc') { ?>checked <?php }; ?> value="desc">Descending</p>
                
                <p><input type="submit" name="searchPSUs" value="Search PSUs"/></p>
            </form>

</html>

<?php
    // Retrieves hardware information from PCParts DB
    function getPSUs($dbConn, $sql) {
        /*// Create sql statement
        $sql = "SELECT psuId, psuName, psuWatts, psuModularity, psuPrice, psuEfficiency
                FROM PSU ORDER BY psuName";
        */
        
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
            $component["psuEfficiency"] = $row["psuEfficiency"];
            $component["psuModularity"] = $row["psuModularity"];
            $component["psuPrice"] = $row["psuPrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }

?>