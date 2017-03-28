<?php
    require_once('../connection.php');
    require_once('../descriptionFunctions.php');
    session_start();
    
    // Create sql statement
    $sql = "SELECT Storage.*, StorageFormFactors.*
        FROM Storage, StorageFormFactors
        WHERE (Storage.storageFFId=StorageFormFactors.storageFFId) ";
    
    // Save variables to session so data persists through submits, and apply filters
    // We only want to append to our search query if the value isn't null
    if ($_GET["storageType"] != null) {
        $_SESSION["storageType"] = $_GET["storageType"];
        $sql .= "AND (Storage.storageType = '" . $_GET["storageType"] . "') ";
    }
    else {
        $_SESSION["storageType"] = $_GET["storageType"];
    }
    
    if ($_GET["maxPrice"] != null) {
        $_SESSION["maxPrice"] = $_GET["maxPrice"];
        $sql .= "AND (Storage.storagePrice <= '" . $_GET["maxPrice"] . "') ";
    }
    else {
        $_SESSION["maxPrice"] = $_GET["maxPrice"];
    }
    
    if ($_GET["orderBy"] != null) {
        $_SESSION["orderBy"] = $_GET["orderBy"];
        $sql .= "ORDER BY " . $_GET["orderBy"];
    }
    else if ($_GET["orderBy"] == null) {
        $sql .= "ORDER BY Storage.storageName";
    }
    
    if ($_GET["sortOrder"] != null) {
        $_SESSION["sortOrder"] = $_GET["sortOrder"];
        $sql .= " " . $_GET["sortOrder"];
    }
    
    $_SESSION["sql"] = $sql;
?>

<html>
    <title>Storages</title>
    <link rel="stylesheet" type="text/css"  href="../CSS/tp.css">
    <!-- Create form to select PC parts -->
    <form name="storageForm" method="GET" action="/Team Project/Component Selection Data/storageSelectData.php">
        <div class="displayMain">
            <div class="displayInline">
                <table>
                    <!-- Put column names on top of the table -->
                    <tr>
                        <td><b>Name</b></td>
                        <td><b>Size</b></td>
                        <td><b>Type</b></td>
                        <td><b>RPM</b></td>
                        <td><b>Form Factor</b></td>
                        <td><b>Price</b></td>
                        <td>Add</td>
                    </tr>
                    
                    <?php
                        // Print out hardware parts with relevant information
                        $storage = getStorages($dbConn, $_SESSION["sql"]);
                        $i = 0;
                        for($i; $i < count($storage); $i++) {
                            echo '<tr>';
                            //echo '<td>'.$storage[$i]["storageName"].'</td>';
                            echo '<td><a href="storageSelect.php?selectDescId='.$storage[$i]["storageId"].'">'.$storage[$i]["storageName"].'</a></td>';
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
            </div>    
            <?php
                if($_GET["selectDescId"]!=NULL) {
                    echo '<div class="displayInlineDescription">';
                    printStorageDescription($dbConn, $_GET["selectDescId"]);
                    echo '</div>';
                }
            ?>
        </div>
    </form>
    
         <!-- Displays the form data -->
         <!-- Help saving form data across states: http://stackoverflow.com/a/2246244 -->
        <div class="form" style="padding-left: 15px;">
            <form action="storageSelect.php" method="GET">
                
                <!-- Select Storage Type-->
                <p><label for="storageType">Storage Type:</label>
                <select name="storageType" style="width:50px">
                    <option <?php if ($_SESSION['storageType'] == '') { ?>selected="true" <?php }; ?> value=''></option>
                    <option <?php if ($_SESSION['storageType'] == 'HDD') { ?>selected="true" <?php }; ?> value="HDD">HDD</option>
                    <option <?php if ($_SESSION['storageType'] == 'SSD') { ?>selected="true" <?php }; ?> value="SSD">SSD</option>
                </select></p>
                
                <!-- Select maximum price -->
                <p><label for="maxPrice">Max Price: </label>
                <input type="number" name="maxPrice" min="0" max="1000" step=".01" style="width:100px;" value="<?php echo isset($_SESSION['maxPrice']) ? $_SESSION['maxPrice'] : '' ?>" />
                
                <!-- Select table order -->
                <p><label for="orderBy">Order By:</label>
                <select name="orderBy" style="width:150px">
                    <option <?php if ($_SESSION['orderBy'] == 'storageName') { ?>selected="true" <?php }; ?> value="storageName">Name</option>
                    <option <?php if ($_SESSION['orderBy'] == 'storagePrice') { ?>selected="true" <?php }; ?> value="storagePrice">Price</option>
                </select></p>
                
                <p><label for="sortOrder" style="width: 125px">Sort Order:</label>
                <input type="radio" name="sortOrder" checked <?php if ($_SESSION['sortOrder'] == 'asc') { ?>checked <?php }; ?> value="asc">Ascending &nbsp &nbsp &nbsp
                <input type="radio" name="sortOrder" <?php if ($_SESSION['sortOrder'] == 'desc') { ?>checked <?php }; ?> value="desc">Descending</p>
                
                <p><input type="submit" name="searchStorages" value="Search Storages"/></p>
            </form>    
    
</html>

<?php
    // Retrieves hardware information from PCParts DB
    function getStorages($dbConn, $sql) {
        /*// Create sql statement
        $sql = "SELECT Storage.*, StorageFormFactors.*
                FROM Storage 
                LEFT JOIN StorageFormFactors
                    ON Storage.storageFFId=StorageFormFactors.storageFFId
                ORDER BY Storage.storageName";
        */
        
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