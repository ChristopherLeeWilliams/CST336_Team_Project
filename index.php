<?php 
    require_once('connection.php');
    session_start();
    
    $_SESSION["totalPrice"] = 0;
    
    // Reset sorting/filtering variables when returning to hub
    $_SESSION["sql"] = null;
    $_SESSION["cores"] = null;
    $_SESSION["maxPrice"] = null;
    $_SESSION["orderBy"] = null;
    $_SESSION["sortOrder"] = null;
    
    $_SESSION["formFactor"] = null;
    $_SESSION["ramSlots"] = null;
    $_SESSION['ramType'] = null;
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css"  href="/Team Project/CSS/tp.css">
    <head>
        <title> Team Project</title>
    </head>
    <body>
        <table>
            <tr>
                <td><b>Component</b></t>
                <td><b>Selection</b></td>
                <td><b>Price</b></td>
                <td></td>
            </tr>
            <tr>
                <td>CPU</td>
                    <?php 
                        if ($_SESSION["cpuSelected"] == NULL) {
                            echo '<td colspan=3>';
                            echo '<a href="/Team Project/Component Selection/cpuSelect.php"> Choose A CPU </a>';
                            echo '</td>';
                        } else {
                            echo '<td>'.$_SESSION["cpuSelected"]["cpuName"].'</td>';
                            echo '<td>'.$_SESSION["cpuSelected"]["cpuPrice"].'</td>';
                            $_SESSION["totalPrice"] += $_SESSION["cpuSelected"]["cpuPrice"];
                            echo '<td><a href="/Team Project/Component Selection Data/cpuSelectData.php?remove=true">X</a></td>';
                        }
                    ?>
            </tr>
            <tr>
                <td>Motherboard</td>
                <?php 
                        if ($_SESSION["mbSelected"] == NULL) {
                            echo '<td colspan=3>';
                            echo '<a href="/Team Project/Component Selection/motherboardSelect.php"> Choose A Motherboard</a>';
                            echo '</td>';
                        } else {
                            echo '<td>'.$_SESSION["mbSelected"]["mbName"].'</td>';
                            echo '<td>'.$_SESSION["mbSelected"]["mbPrice"].'</td>';
                            $_SESSION["totalPrice"] += $_SESSION["mbSelected"]["mbPrice"];
                            echo '<td><a href="/Team Project/Component Selection Data/motherboardSelectData.php?remove=true">X</a></td>';
                        }
                    ?>
            </tr>
            <tr>
                <td>Memory</td>
                    <?php 
                        if ($_SESSION["ramSelected"] == NULL) {
                            echo '<td colspan=3>';
                            echo '<a href="/Team Project/Component Selection/ramSelect.php"> Choose Memory </a>';
                            echo '</td>';
                        } else {
                            echo '<td>'.$_SESSION["ramSelected"]["ramName"].'</td>';
                            echo '<td>'.$_SESSION["ramSelected"]["ramPrice"].'</td>';
                            $_SESSION["totalPrice"] += $_SESSION["ramSelected"]["ramPrice"];
                            echo '<td><a href="/Team Project/Component Selection Data/ramSelectData.php?remove=true">X</a></td>';
                        }
                    ?>
            </tr>
            <tr>
                <td>Storage</td>
                    <?php 
                        if ($_SESSION["storageSelected"] == NULL) {
                            echo '<td colspan=3>';
                            echo '<a href="/Team Project/Component Selection/storageSelect.php"> Choose Storage</a>';
                            echo '</td>';
                        } else {
                            echo '<td>'.$_SESSION["storageSelected"]["storageName"].'</td>';
                            echo '<td>'.$_SESSION["storageSelected"]["storagePrice"].'</td>';
                            $_SESSION["totalPrice"] += $_SESSION["storageSelected"]["storagePrice"];
                            echo '<td><a href="/Team Project/Component Selection Data/storageSelectData.php?remove=true">X</a></td>';
                        }
                    ?>
            </tr>
                <td>Video Card</td>
                    <?php 
                        if ($_SESSION["gpuSelected"] == NULL) {
                            echo '<td colspan=3>';
                            echo '<a href="/Team Project/Component Selection/gpuSelect.php"> Choose A Video Card</a>';
                            echo '</td>';
                        } else {
                            echo '<td>'.$_SESSION["gpuSelected"]["gpuName"].'</td>';
                            echo '<td>'.$_SESSION["gpuSelected"]["gpuPrice"].'</td>';
                            $_SESSION["totalPrice"] += $_SESSION["gpuSelected"]["gpuPrice"];
                            echo '<td><a href="/Team Project/Component Selection Data/gpuSelectData.php?remove=true">X</a></td>';
                        }
                    ?>
            </tr>
            <tr>
                <td>Case</td>
                    <?php 
                        if ($_SESSION["caseSelected"] == NULL) {
                            echo '<td colspan=3>';
                            echo '<a href="/Team Project/Component Selection/caseSelect.php"> Choose A Case</a>';
                            echo '</td>';
                        } else {
                            echo '<td>'.$_SESSION["caseSelected"]["caseName"].'</td>';
                            echo '<td>'.$_SESSION["caseSelected"]["casePrice"].'</td>';
                            $_SESSION["totalPrice"] += $_SESSION["caseSelected"]["casePrice"];
                            echo '<td><a href="/Team Project/Component Selection Data/caseSelectData.php?remove=true">X</a></td>';
                        }
                    ?>
            </tr>
            <tr>
                <td>Power Supply</td>
                    <?php 
                        if ($_SESSION["psuSelected"] == NULL) {
                            echo '<td colspan=3>';
                            echo '<a href="/Team Project/Component Selection/psuSelect.php"> Choose A Power Supply</a>';
                            echo '</td>';
                        } else {
                            echo '<td>'.$_SESSION["psuSelected"]["psuName"].'</td>';
                            echo '<td>'.$_SESSION["psuSelected"]["psuPrice"].'</td>';
                            $_SESSION["totalPrice"] += $_SESSION["psuSelected"]["psuPrice"];
                            echo '<td><a href="/Team Project/Component Selection Data/psuSelectData.php?remove=true">X</a></td>';
                        }
                        
                        $i = 0;
                        for($i; $i < count($_SESSION["errors"]); $i++) {
                            echo $_SESSION["errors"][$i].'</br>';
                        }
                    ?>
            </tr>
            <tr>
                <td></td>
                <td>Total: </td>
                <?php 
                    echo '<td>$'.$_SESSION["totalPrice"].'</td>';
                ?>
            </tr>
        </table>
        
         <form name="compatibilityForm" method="GET" action="compatibilityCheck.php">
             <input type="submit" name="submit" value="Check compatibility">
         </form>
         
         <form name="checkoutForm" method="POST" action="checkout.php">
             <input type="submit" name="submit" value="Checkout">
         </form>
    </body>
</html>