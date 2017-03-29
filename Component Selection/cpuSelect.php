<?php
    require_once('../connection.php');
    require_once('../descriptionFunctions.php');
    session_start();
    
    // Create sql statement
    $sql = "SELECT CPU.*, Socket.*
            FROM CPU, Socket
            WHERE (CPU.cpuSocketId=Socket.socketId) ";
    
    // Save variables to session so data persists through submits, and apply filters
    // We only want to append to our search query if the value isn't null
    if ($_GET["cores"] > 0) {
        $_SESSION["cores"] = $_GET["cores"];
        $sql .= "AND (CPU.cpuNumCores = '" . $_GET["cores"] . "') ";
    }
    else {
        $_SESSION["cores"] = $_GET["cores"];
    }
    
    if ($_GET["maxPrice"] != null) {
        $_SESSION["maxPrice"] = $_GET["maxPrice"];
        $sql .= "AND (CPU.cpuPrice <= '" . $_GET["maxPrice"] . "') ";
    }
    else {
        $_SESSION["maxPrice"] = $_GET["maxPrice"];
    }
    
    if ($_GET["orderBy"] != null) {
        $_SESSION["orderBy"] = $_GET["orderBy"];
        $sql .= "ORDER BY " . $_GET["orderBy"];
    }
    else if ($_GET["orderBy"] == null) {
        $sql .= "ORDER BY CPU.cpuName";
    }
    
    if ($_GET["sortOrder"] != null) {
        $_SESSION["sortOrder"] = $_GET["sortOrder"];
        $sql .= " " . $_GET["sortOrder"];
    }
    
    $_SESSION["sql"] = $sql;
?>

<html>
    <title>CPUs</title>
    <link rel="stylesheet" type="text/css"  href="../CSS/tp.css">
    <div class="pageTitle" >
        Select CPU
    </div>
    <div class="border"></div>
    <div class="body">
    <!-- Create form to select PC parts -->

    <form name="cpuForm" method="GET" action="/Team Project/Component Selection Data/cpuSelectData.php">
        <div class="displayMain">
            <div class="displayInline">
                <table class="selectTable">
                    <!-- Put column names on top of the table -->
                    <tr>
                        <td><b>Name</b></td>
                        <td><b>Socket</b></td>
                        <td><b>Base Clock</b></td>
                        <td><b># Cores</b></td>
                        <td><b>TDP (Watts)</b></td>
                        <td><b>Price</b></td>
                        <td></td>
                    </tr>
                    
                    <?php
                    // Print out hardware parts with relevant information
                        $CPUs = getCPUs($dbConn, $_SESSION["sql"]);
                        $i = 0;
                        for($i; $i < count($CPUs); $i++) {
                            echo '<tr>';
                            //echo '<td>'.$CPUs[$i]["cpuName"].'</td>';
                            
                            echo '<td><a href="cpuSelect.php?selectDescId='.$CPUs[$i]["cpuId"].'">'.$CPUs[$i]["cpuName"].'</a></td>';
                            
                            echo '<td>'.$CPUs[$i]["socketType"].'</td>';
                            echo '<td>'.$CPUs[$i]["cpuBaseClock"].'</td>';
                            echo '<td>'.$CPUs[$i]["cpuNumCores"].'</td>';
                            echo '<td>'.$CPUs[$i]["cpuTDP"].'</td>';
                            echo '<td>$'.$CPUs[$i]["cpuPrice"].'</td>';
                            echo '<td class="addSelect"><a href="/Team Project/Component Selection Data/cpuSelectData.php?cpuId='.$CPUs[$i]["cpuId"].
                                 '&remove=false">add</a></td>';
                            echo '</tr>';
                        }          
                    ?>
                </table>
            </div>
            <?php
                if($_GET["selectDescId"]!=NULL) {
                    echo '<div class="displayInlineDescription">';
                    printCPUDescription($dbConn, $_GET["selectDescId"]);
                    echo '</div>';
                }
            ?>
        </div>
    </form>
    
         <!-- Displays the form data -->
         <!-- Help saving form data across states: http://stackoverflow.com/a/2246244 -->
        <div class="form" style="padding-left: 15px;">
            <form action="cpuSelect.php" method="GET">
                
                <!-- Select # of cores -->
                <p><label for="cores">Cores:</label>
                <select name="cores" style="width:50px">
                    <option <?php if ($_SESSION['cores'] == '') { ?>selected="true" <?php }; ?> value=''></option>
                    <option <?php if ($_SESSION['cores'] == 2) { ?>selected="true" <?php }; ?> value="2">2</option>
                    <option <?php if ($_SESSION['cores'] == 4) { ?>selected="true" <?php }; ?> value="4">4</option>
                    <option <?php if ($_SESSION['cores'] == 6) { ?>selected="true" <?php }; ?> value="6">6</option>
                    <option <?php if ($_SESSION['cores'] == 8) { ?>selected="true" <?php }; ?> value="8">8</option>
                </select></p>
                
                <!-- Select maximum price -->
                <p><label for="maxPrice">Max Price: </label>
                <input type="number" name="maxPrice" min="0" max="1000" step=".01" style="width:100px;" value="<?php echo isset($_SESSION['maxPrice']) ? $_SESSION['maxPrice'] : '' ?>" />
                
                <!-- Select table order -->
                <p><label for="orderBy">Order By:</label>
                <select name="orderBy" style="width:150px">
                    <option <?php if ($_SESSION['orderBy'] == 'cpuName') { ?>selected="true" <?php }; ?> value="cpuName">Name</option>
                    <option <?php if ($_SESSION['orderBy'] == 'cpuPrice') { ?>selected="true" <?php }; ?> value="cpuPrice">Price</option>
                </select></p>
                
                <p><label for="sortOrder" style="width: 125px">Sort Order:</label>
                <input type="radio" name="sortOrder" checked <?php if ($_SESSION['sortOrder'] == 'asc') { ?>checked <?php }; ?> value="asc">Ascending &nbsp &nbsp &nbsp
                <input type="radio" name="sortOrder" <?php if ($_SESSION['sortOrder'] == 'desc') { ?>checked <?php }; ?> value="desc">Descending</p>
                
                <p><input type="submit" name="searchCPUs" value="Search CPUs"/></p>
            </form>
        </div>
    <div class="border"></div>
</html>

<?php
    // Retrieves hardware information from PCParts DB
    function getCPUs($dbConn, $sql) {
         /*// Create sql statement
        $sql = "SELECT CPU.*, Socket.*
                FROM CPU 
                LEFT JOIN Socket
                    ON CPU.cpuSocketId=Socket.socketId
                ORDER BY CPU.cpuName";
        */
        
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
