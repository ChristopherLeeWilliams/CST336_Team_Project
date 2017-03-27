<?php
    require_once('../connection.php');
    session_start();

    // Create sql statement
    $sql = "SELECT RAM.*, RamType.*
            FROM RAM, RamType
            WHERE (RAM.ramTypeId=RamType.ramTypeId) ";

    // Save variables to session so data persists through submits, and apply filters
    // We only want to append to our search query if the value isn't null
    if ($_GET["sizeGB"] > 0) {
        $_SESSION["sizeGB"] = $_GET["sizeGB"];
        $sql .= "AND (RAM.ramSizeGB = '" . $_GET["sizeGB"] . "') ";
    }
    else {
        $_SESSION["sizeGB"] = $_GET["sizeGB"];
    }
    
    if ($_GET["maxPrice"] != null) {
        $_SESSION["maxPrice"] = $_GET["maxPrice"];
        $sql .= "AND (RAM.ramPrice <= '" . $_GET["maxPrice"] . "') ";
    }
    else {
        $_SESSION["maxPrice"] = $_GET["maxPrice"];
    }
    
    if ($_GET["orderBy"] != null) {
        $_SESSION["orderBy"] = $_GET["orderBy"];
        $sql .= "ORDER BY " . $_GET["orderBy"];
    }
    else if ($_GET["orderBy"] == null) {
        $sql .= "ORDER BY RAM.ramName";
    }
    
    if ($_GET["sortOrder"] != null) {
        $_SESSION["sortOrder"] = $_GET["sortOrder"];
        $sql .= " " . $_GET["sortOrder"];
    }
    
    $_SESSION["sql"] = $sql;    
?>

<html>
    <title>RAM</title>
    <link rel="stylesheet" type="text/css"  href="../CSS/tp.css">
    <form name="ramForm" method="GET" action="/Team Project/Component Selection Data/ramSelectData.php">
        <table>
            <tr>
                <td>Name</td>
                <td>Type</td>
                <td>Size (GB)</td>
                <td>Speed</td>
                <td>Cas</td>
                <td>Price</td>
                <td>Add</td>
            </tr>
            
            <?php
                $ram = getRam($dbConn, $_SESSION["sql"]);
                $i = 0;
                for($i; $i < count($ram); $i++) {
                    echo '<tr>';
                    echo '<td>'.$ram[$i]["ramName"].'</td>';
                    echo '<td>'.$ram[$i]["ramType"].'</td>';
                    echo '<td>'.$ram[$i]["ramSizeGB"].'</td>';
                    echo '<td>'.$ram[$i]["ramSpeed"].'</td>';
                    echo '<td>'.$ram[$i]["ramCas"].'</td>';
                    echo '<td>$'.$ram[$i]["ramPrice"].'</td>';
                    echo '<td><a href="/Team Project/Component Selection Data/ramSelectData.php?ramId='.$ram[$i]["ramId"].
                         '&remove=false">add</a></td>';   
                    echo '</tr>';
                }
            ?>
        </table>
    </form>
    
         <!-- Displays the form data -->
         <!-- Help saving form data across states: http://stackoverflow.com/a/2246244 -->
        <div class="form" style="padding-left: 15px;">
            <form action="ramSelect.php" method="GET">
                
                <!-- Select Size (GB) -->
                <p><label for="sizeGB">Size (GB):</label>
                <select name="sizeGB" style="width:50px">
                    <option <?php if ($_SESSION['sizeGB'] == '') { ?>selected="true" <?php }; ?> value=''></option>
                    <option <?php if ($_SESSION['sizeGB'] == 2) { ?>selected="true" <?php }; ?> value="2">2</option>
                    <option <?php if ($_SESSION['sizeGB'] == 4) { ?>selected="true" <?php }; ?> value="4">4</option>
                    <option <?php if ($_SESSION['sizeGB'] == 8) { ?>selected="true" <?php }; ?> value="8">8</option>
                    <option <?php if ($_SESSION['sizeGB'] == 16) { ?>selected="true" <?php }; ?> value="16">16</option>
                </select></p>
                
                <!-- Select maximum price -->
                <p><label for="maxPrice">Max Price: </label>
                <input type="number" name="maxPrice" min="0" max="1000" step=".01" style="width:50px;" value="<?php echo isset($_SESSION['maxPrice']) ? $_SESSION['maxPrice'] : '' ?>" />
                
                <!-- Select table order -->
                <p><label for="orderBy">Order By:</label>
                <select name="orderBy" style="width:150px">
                    <option <?php if ($_SESSION['orderBy'] == 'ramName') { ?>selected="true" <?php }; ?> value="ramName">Name</option>
                    <option <?php if ($_SESSION['orderBy'] == 'ramPrice') { ?>selected="true" <?php }; ?> value="ramPrice">Price</option>
                </select></p>
                
                <p><label for="sortOrder" style="width: 125px">Sort Order:</label>
                <input type="radio" name="sortOrder" checked <?php if ($_SESSION['sortOrder'] == 'asc') { ?>checked <?php }; ?> value="asc">Ascending &nbsp &nbsp &nbsp
                <input type="radio" name="sortOrder" <?php if ($_SESSION['sortOrder'] == 'desc') { ?>checked <?php }; ?> value="desc">Descending</p>
                
                <p><input type="submit" name="searchRAM" value="Search RAM"/></p>
            </form>
    

</html>


<?php
    function getRam($dbConn, $sql) {
         /*// Create sql statement
        $sql = "SELECT RAM.*, RamType.*
                FROM RAM 
                LEFT JOIN RamType
                    ON RAM.ramTypeId=RamType.ramTypeId
                ORDER BY RAM.ramName";
        */
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) { 
            $component["ramId"] = $row["ramId"];
            $component["ramName"] = $row["ramName"];
            $component["ramType"] = $row["ramType"];
            $component["ramSizeGB"] = $row["ramSizeGB"];
            $component["ramSpeed"] = $row["ramSpeed"];
            $component["ramCas"] = $row["ramCas"];
            $component["ramPrice"] = $row["ramPrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }

?>