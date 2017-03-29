<?php
    require_once('../connection.php');
    require_once('../descriptionFunctions.php');
    session_start();

    // Create sql statement
    $sql = "SELECT GPU.*
            FROM GPU WHERE (GPU.gpuId = GPU.gpuId) ";
    
    // Save variables to session so data persists through submits, and apply filters
    // We only want to append to our search query if the value isn't null
    if ($_GET["gpuManufacturer"] != null) {
        $_SESSION["gpuManufacturer"] = $_GET["gpuManufacturer"];
        $sql .= "AND (GPU.gpuManufacturer = '" . $_GET["gpuManufacturer"] . "') ";
    }
    else {
        $_SESSION["gpuManufacturer"] = $_GET["gpuManufacturer"];
    }

    if ($_GET["maxPrice"] != null) {
        $_SESSION["maxPrice"] = $_GET["maxPrice"];
        $sql .= "AND (GPU.gpuPrice <= '" . $_GET["maxPrice"] . "') ";
    }
    else {
        $_SESSION["maxPrice"] = $_GET["maxPrice"];
    }
    
    if ($_GET["orderBy"] != null) {
        $_SESSION["orderBy"] = $_GET["orderBy"];
        $sql .= "ORDER BY " . $_GET["orderBy"];
    }
    else if ($_GET["orderBy"] == null) {
        $sql .= "ORDER BY GPU.gpuName";
    }
    
    if ($_GET["sortOrder"] != null) {
        $_SESSION["sortOrder"] = $_GET["sortOrder"];
        $sql .= " " . $_GET["sortOrder"];
    }
    
    $_SESSION["sql"] = $sql;
?>

<html>
    <title>GPUs</title>
    <link rel="stylesheet" type="text/css"  href="../CSS/tp.css">
    <div class="pageTitle" >
        Select Video Card
    </div>
    <div class="border"></div>
    <div class="body">
        
    <!-- Create form to select PC parts -->
    <form name="gpuForm" method="GET" action="/Team Project/Component Selection Data/gpuSelectData.php">
        <div class="displayMain">
            <div class="displayInline">
                <table class="selectTable">
                    <!-- Put column names on top of the table -->
                    <tr>
                        <td><b>Name</b></td>
                        <td><b>Manufacturer</b></td>
                        <td><b>Base Clock</b></td>
                        <td><b>Memory</b></td>
                        <td><b>Length (Inches)</b></td>
                        <td><b>TDP (Watts)</b></td>
                        <td><b>Price</td>
                        <td></td>
                    </tr>
                    
                    <?php
                        // Print out hardware parts with relevant information
                        $gpu = getGPUs($dbConn, $_SESSION["sql"]);
                        $i = 0;
                        for($i; $i < count($gpu); $i++) {
                            echo '<tr>';
                            //echo '<td>'.$gpu[$i]["gpuName"].'</td>';
                            echo '<td><a href="gpuSelect.php?selectDescId='.$gpu[$i]["gpuId"].'">'.$gpu[$i]["gpuName"].'</a></td>';
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
            </div>
            <?php
                if($_GET["selectDescId"]!=NULL) {
                    echo '<div class="displayInlineDescription">';
                    printGPUDescription($dbConn, $_GET["selectDescId"]);
                    echo '</div>';
                }
            ?>
        </div>
    </form>
    
         <!-- Displays the form data -->
         <!-- Help saving form data across states: http://stackoverflow.com/a/2246244 -->
        <div class="form" style="padding-left: 15px;">
            <form action="gpuSelect.php" method="GET">
                
                <!-- Select Manufacturer-->
                <p><label for="gpuManufacturer">Manufacturer:</label>
                <select name="gpuManufacturer" style="width:150px">
                    <option <?php if ($_SESSION['gpuManufacturer'] == '') { ?>selected="true" <?php }; ?> value=''></option>
                    <option <?php if ($_SESSION['gpuManufacturer'] == 'AMD') { ?>selected="true" <?php }; ?> value="AMD">AMD</option>
                    <option <?php if ($_SESSION['gpuManufacturer'] == 'NVIDIA') { ?>selected="true" <?php }; ?> value="NVIDIA">NVIDIA</option>
                </select></p>
                
                <!-- Select maximum price -->
                <p><label for="maxPrice">Max Price: </label>
                <input type="number" name="maxPrice" min="0" max="1000" step=".01" style="width:100px;" value="<?php echo isset($_SESSION['maxPrice']) ? $_SESSION['maxPrice'] : '' ?>" />
                
                <!-- Select table order -->
                <p><label for="orderBy">Order By:</label>
                <select name="orderBy" style="width:150px">
                    <option <?php if ($_SESSION['orderBy'] == 'gpuName') { ?>selected="true" <?php }; ?> value="gpuName">Name</option>
                    <option <?php if ($_SESSION['orderBy'] == 'gpuPrice') { ?>selected="true" <?php }; ?> value="gpuPrice">Price</option>
                </select></p>
                
                <p><label for="sortOrder" style="width: 125px">Sort Order:</label>
                <input type="radio" name="sortOrder" checked <?php if ($_SESSION['sortOrder'] == 'asc') { ?>checked <?php }; ?> value="asc">Ascending &nbsp &nbsp &nbsp
                <input type="radio" name="sortOrder" <?php if ($_SESSION['sortOrder'] == 'desc') { ?>checked <?php }; ?> value="desc">Descending</p>
                
                <p><input type="submit" name="searchGPUs" value="Search GPUs"/></p>
            </form>        
        </div>
    <div class="border"></div>
</html>

<?php
    // Retrieves hardware information from PCParts DB
    function getGPUs($dbConn, $sql) {
        /*// Create sql statement
        $sql = "SELECT GPU.*
                FROM GPU ORDER BY gpuName";
        */
        
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