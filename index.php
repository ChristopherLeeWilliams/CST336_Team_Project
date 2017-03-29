<?php 
    require_once('connection.php');
    require_once('descriptionFunctions.php');
    session_start();
    
    $_SESSION["totalPrice"] = 0;
    
    // Reset sorting/filtering variables when returning to hub
    // General variables
    $_SESSION["sql"] = null;
    $_SESSION["maxPrice"] = null;
    $_SESSION["orderBy"] = null;
    $_SESSION["sortOrder"] = null;
    
    // CPU
    $_SESSION["cores"] = null;
    
    //Motherboard
    $_SESSION["formFactor"] = null;
    $_SESSION["ramSlots"] = null;
    $_SESSION['ramType'] = null;
    
    // RAM
    $_SESSION['sizeGB'] = null;
    
    // Storage
    $_SESSION["storageType"] = null;
    
    // GPU
    $_SESSION["gpuManufacturer"] = null;
    
    // Case
    $_SESSION["min25Bays"] = null;
    $_SESSION["min35Bays"] = null;
    
    // PSU
    $_SESSION["minWatts"] = null;
    $_SESSION["modularity"] = null;
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css"  href="/Team Project/CSS/tp.css">
    
    <div class="pageTitle" >
        Build A PC
    </div>
    <div class="border"></div>
    
    <head>
        <title> Team Project</title>
    </head>
    <div class="body">
        <div class="displayMain">
        <div class="displayInline">
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
                            //echo '<td>'.$_SESSION["cpuSelected"]["cpuName"].'</td>';
                            
                            echo '<td><a href="/Team Project/index.php?descId='.$_SESSION["cpuSelected"]["cpuId"].
                                        '&descComponent=CPU">'.$_SESSION["cpuSelected"]["cpuName"].'</a></td>';
                                        
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
                            echo '<td><a href="/Team Project/index.php?descId='.$_SESSION["mbSelected"]["mbId"].
                                        '&descComponent=Motherboard">'.$_SESSION["mbSelected"]["mbName"].'</a></td>';
                            
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
                            echo '<td><a href="/Team Project/index.php?descId='.$_SESSION["ramSelected"]["ramId"].
                                        '&descComponent=RAM">'.$_SESSION["ramSelected"]["ramName"].'</a></td>';
                                        
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
                            echo '<td><a href="/Team Project/index.php?descId='.$_SESSION["storageSelected"]["storageId"].
                                        '&descComponent=Storage">'.$_SESSION["storageSelected"]["storageName"].'</a></td>';
                            
                            echo '<td>'.$_SESSION["storageSelected"]["storagePrice"].'</td>';
                            $_SESSION["totalPrice"] += $_SESSION["storageSelected"]["storagePrice"];
                            echo '<td><a href="/Team Project/Component Selection Data/storageSelectData.php?remove=true">X</a></td>';
                        }
                    ?>
            </tr>
            <tr>
                <td>Video Card</td>
                    <?php 
                        if ($_SESSION["gpuSelected"] == NULL) {
                            echo '<td colspan=3>';
                            echo '<a href="/Team Project/Component Selection/gpuSelect.php"> Choose A Video Card</a>';
                            echo '</td>';
                        } else {
                            echo '<td><a href="/Team Project/index.php?descId='.$_SESSION["gpuSelected"]["gpuId"].
                                        '&descComponent=GPU">'.$_SESSION["gpuSelected"]["gpuName"].'</a></td>';
                                        
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
                            echo '<td><a href="/Team Project/index.php?descId='.$_SESSION["caseSelected"]["caseId"].
                                        '&descComponent=Case">'.$_SESSION["caseSelected"]["caseName"].'</a></td>';
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
                            echo '<td><a href="/Team Project/index.php?descId='.$_SESSION["psuSelected"]["psuId"].
                                        '&descComponent=PSU">'.$_SESSION["psuSelected"]["psuName"].'</a></td>';
                            echo '<td>'.$_SESSION["psuSelected"]["psuPrice"].'</td>';
                            $_SESSION["totalPrice"] += $_SESSION["psuSelected"]["psuPrice"];
                            echo '<td><a href="/Team Project/Component Selection Data/psuSelectData.php?remove=true">X</a></td>';
                        }
                    ?>
            </tr>
            <tr>
                <td></td>
                <?php 
                    if ($_SESSION["totalPrice"] != 0) {
                        echo '<td>Total: </td>';
                        echo '<td>$'.$_SESSION["totalPrice"].'</td>';
                    } else {
                        echo '<td></td>';
                    }
                ?>
            </tr>
        </table>
        
        <div class="errorMessage">
            <?php
                // DISPLAY COMPATIBILITY ERRORS
                if(($_SESSION["compatibilityChecked"] == false) && ($_SESSION["checkoutRun"] == false)) {
                    $_SESSION["errors"] = NULL;
                }
                $i = 0;
                for($i; $i < count($_SESSION["errors"]); $i++) {
                    echo $_SESSION["errors"][$i].'</br>';
                }
            ?>
        </div>
        </div>
        <?php
        if ($_GET["descComponent"] != NULL) {
            echo '<div class="displayInlineDescription">';
                if ((strcmp($_GET["descComponent"],"CPU") == 0)) {
                    printCPUDescription($dbConn, $_GET["descId"]);
                } elseif( strcmp($_GET["descComponent"],"Motherboard") == 0 )  {
                    printMotherboardDescription($dbConn, $_GET["descId"]);
                } elseif ( strcmp($_GET["descComponent"],"RAM") == 0 )  {
                    printRamDescription($dbConn, $_GET["descId"]);
                } elseif ( strcmp($_GET["descComponent"],"Storage") == 0 ) {
                    printStorageDescription($dbConn, $_GET["descId"]);
                } elseif ( strcmp($_GET["descComponent"],"GPU") == 0 ) {
                    printGPUDescription($dbConn, $_GET["descId"]);
                } elseif ( strcmp($_GET["descComponent"],"Case") == 0 ) {
                    printCaseDescription($dbConn, $_GET["descId"]);
                } elseif ( strcmp($_GET["descComponent"],"PSU") == 0 ) {
                    printPSUDescription($dbConn, $_GET["descId"]);
                }
            echo '</div>';
        }
        ?>
        </div>
        </br>
        <div class="displayMain">
            <div class="displayInline">
                <form name="compatibilityForm" method="GET" action="compatibilityCheck.php">
                    <input type="submit" name="submit" value="Check compatibility">
                </form>
            </div>
            <div class="displayInline">
                <form name="checkoutForm" method="GET" action="checkout.php">
                    <input type="submit" name="submit" value="Checkout">
                </form>
            </div>
         </div>
    </div>
    <div class="border"></div>
</html>