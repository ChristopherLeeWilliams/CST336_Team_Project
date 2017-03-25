<?php 
    require_once('connection.php');
    session_start();
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
                            echo '<td><a href="/Team Project/Component Selection Data/psuSelectData.php?remove=true">X</a></td>';
                        }
                        
                        $i = 0;
                        for($i; $i < count($_SESSION["errors"]); $i++) {
                            echo $_SESSION["errors"][$i].'</br>';
                        }
                    ?>
            </tr>
        </table>
        
         <form name="compatabilityForm" method="GET" action="compatabilityCheck.php">
             <input type="submit" name="submit" value="Check Compatability">
         </form>
    </body>
</html>