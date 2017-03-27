<?php
    require_once('../connection.php');
    session_start();
    
        $sql = "SELECT Motherboard.*, Socket.*, MBFormFactors.*, RamType.* 
                FROM Motherboard, Socket, MBFormFactors, RamType
                WHERE (Motherboard.mbSocketId=Socket.socketId) 
                AND (Motherboard.mbFFId=MBFormFactors.mbFFId) 
                AND (Motherboard.mbRamTypeId=RamType.ramTypeId) ";
    
    // Save variables to session so data persists through submits, and apply filters
    // We only want to append to our search query if the value isn't null
    if ($_GET["formFactor"] != null) {
        $_SESSION["formFactor"] = $_GET["formFactor"];
        $sql .= "AND (MBFormFactors.mbFFType = '" . $_GET["formFactor"] . "') ";
    }
    else {
        $_SESSION["formFactor"] = $_GET["formFactor"];
    }    

    if ($_GET["ramSlots"] > 0) {
        $_SESSION["ramSlots"] = $_GET["ramSlots"];
        $sql .= "AND (Motherboard.mbNumRamSlots = '" . $_GET["ramSlots"] . "') ";
    }
    else {
        $_SESSION["ramSlots"] = $_GET["ramSlots"];
    }
    
    if ($_GET["ramType"] != null) {
        $_SESSION["ramType"] = $_GET["ramType"];
        $sql .= "AND (RamType.ramType = '" . $_GET["ramType"] . "') ";
    }
    else {
        $_SESSION["ramType"] = $_GET["ramType"];
    }
    
    if ($_GET["maxPrice"] != null) {
        $_SESSION["maxPrice"] = $_GET["maxPrice"];
        $sql .= "AND (Motherboard.mbPrice <= '" . $_GET["maxPrice"] . "') ";
    }
    else {
        $_SESSION["maxPrice"] = $_GET["maxPrice"];
    }
    
    if ($_GET["orderBy"] != null) {
        $_SESSION["orderBy"] = $_GET["orderBy"];
        $sql .= "ORDER BY " . $_GET["orderBy"];
    }
    else if ($_GET["orderBy"] == null) {
        $sql .= "ORDER BY Motherboard.mbName";
    }
    
    if ($_GET["sortOrder"] != null) {
        $_SESSION["sortOrder"] = $_GET["sortOrder"];
        $sql .= " " . $_GET["sortOrder"];
    }
    
    $_SESSION["sql"] = $sql;
?>

<html>
    <title>Motherboards</title>
    <link rel="stylesheet" type="text/css"  href="../CSS/tp.css">
    <form name="motherboardForm" method="GET" action="/Team Project/Component Selection Data/motherboardSelectData.php">
        <table>
            <tr>
                <td>Name</td>
                <td>Socket</td>
                <td>Form Factor</td>
                <td># Ram Slots</td>
                <td>Ram Type</td>
                <td>Price</td>
                <td>Add</td>
            </tr>
            
            <?php
                $mbs = getMotherboards($dbConn, $_SESSION["sql"]);
                $i = 0;
                for($i; $i < count($mbs); $i++) {
                    echo '<tr>';
                    echo '<td>'.$mbs[$i]["mbName"].'</td>';
                    echo '<td>'.$mbs[$i]["socketType"].'</td>';
                    echo '<td>'.$mbs[$i]["mbFFType"].'</td>';
                    echo '<td>'.$mbs[$i]["mbNumRamSlots"].'</td>';
                    echo '<td>'.$mbs[$i]["ramType"].'</td>';
                    echo '<td>$'.$mbs[$i]["mbPrice"].'</td>';
                    echo '<td><a href="/Team Project/Component Selection Data/motherboardSelectData.php?mbId='.$mbs[$i]["mbId"].
                         '&remove=false">add</a></td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </form>

         <!-- Displays the form data -->
         <!-- Help saving form data across states: http://stackoverflow.com/a/2246244 -->
        <div class="form" style="padding-left: 15px;">
            <form action="motherboardSelect.php" method="GET">
               
                <!-- Select Form Factor -->
                <p><label for="formFactor">Form Factor:</label>
                <select name="formFactor" style="width:150px">
                    <option <?php if ($_SESSION['formFactor'] == '') { ?>selected="true" <?php }; ?> value=''></option>
                    <option <?php if ($_SESSION['formFactor'] == 'Mini-ITX') { ?>selected="true" <?php }; ?> value="Mini-ITX">Mini-ITX</option>
                    <option <?php if ($_SESSION['formFactor'] == 'Micro-ATX') { ?>selected="true" <?php }; ?> value="Micro-ATX">Micro-ATX</option>
                    <option <?php if ($_SESSION['formFactor'] == 'Standard-ATX') { ?>selected="true" <?php }; ?> value="Standard-ATX">Standard-ATX</option>
                </select></p>
                
                <!-- Select # of RAM Slots -->
                <p><label for="ramSlots">Ram Slots:</label>
                <select name="ramSlots" style="width:50px">
                    <option <?php if ($_SESSION['ramSlots'] == '') { ?>selected="true" <?php }; ?> value=''></option>
                    <option <?php if ($_SESSION['ramSlots'] == 2) { ?>selected="true" <?php }; ?> value="2">2</option>
                    <option <?php if ($_SESSION['ramSlots'] == 4) { ?>selected="true" <?php }; ?> value="4">4</option>
                    <option <?php if ($_SESSION['ramSlots'] == 6) { ?>selected="true" <?php }; ?> value="6">6</option>
                    <option <?php if ($_SESSION['ramSlots'] == 8) { ?>selected="true" <?php }; ?> value="8">8</option>
                </select></p>
                
                <!-- Select RAM Type -->
                <p><label for="ramType">Ram Type:</label>
                <select name="ramType" style="width:150px">
                    <option <?php if ($_SESSION['ramType'] == '') { ?>selected="true" <?php }; ?> value=''></option>
                    <option <?php if ($_SESSION['ramType'] == 'DDR2') { ?>selected="true" <?php }; ?> value="DDR2">DDR2</option>
                    <option <?php if ($_SESSION['ramType'] == 'DDR3') { ?>selected="true" <?php }; ?> value="DDR3">DDR3</option>
                    <option <?php if ($_SESSION['ramType'] == 'DDR4') { ?>selected="true" <?php }; ?> value="DDR4">DDR4</option>
                </select></p>
                
                <!-- Select maximum price -->
                <p><label for="maxPrice">Max Price: </label>
                <input type="number" name="maxPrice" min="0" max="1000" step=".01" style="width:50px;" value="<?php echo isset($_SESSION['maxPrice']) ? $_SESSION['maxPrice'] : '' ?>" />
                
                <!-- Select table order -->
                <p><label for="orderBy">Order By:</label>
                <select name="orderBy" style="width:150px">
                    <option <?php if ($_SESSION['orderBy'] == 'mbName') { ?>selected="true" <?php }; ?> value="mbName">Name</option>
                    <option <?php if ($_SESSION['orderBy'] == 'mbPrice') { ?>selected="true" <?php }; ?> value="mbPrice">Price</option>
                </select></p>
                
                <p><label for="sortOrder" style="width: 125px">Sort Order:</label>
                <input type="radio" name="sortOrder" checked <?php if ($_SESSION['sortOrder'] == 'asc') { ?>checked <?php }; ?> value="asc">Ascending &nbsp &nbsp &nbsp
                <input type="radio" name="sortOrder" <?php if ($_SESSION['sortOrder'] == 'desc') { ?>checked <?php }; ?> value="desc">Descending</p>
                
                <p><input type="submit" name="searchCPUs" value="Search CPUs"/></p>
            </form>
    

</html>


<?php
    function getMotherboards($dbConn, $sql) {
         /*// Create sql statement
        $sql = "SELECT Motherboard.*, Socket.*, MBFormFactors.*, RamType.* 
                FROM Motherboard
                LEFT JOIN Socket
                    ON Motherboard.mbSocketId=Socket.socketId
                LEFT JOIN MBFormFactors
                    ON Motherboard.mbFFId=MBFormFactors.mbFFId
                LEFT JOIN RamType
                    ON Motherboard.mbRamTypeId=RamType.ramTypeId";
        */
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;

        while($row = $stmt->fetch()) { 
            $component["mbId"] = $row["mbId"];
            $component["mbName"] = $row["mbName"];
            $component["socketType"] = $row["socketType"];
            $component["mbFFType"] = $row["mbFFType"];
            $component["mbNumRamSlots"] = $row["mbNumRamSlots"];
            $component["ramType"] = $row["ramType"];
            $component["mbPrice"] = $row["mbPrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        return $componentArr;
    }
?>