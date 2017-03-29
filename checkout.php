<?php
    session_start();
    $checkoutError = [];
    $_SESSION["checkoutRun"] = true;
    if ($_SESSION["compatibilityChecked"] == false){
        $checkoutError[0] = 'Checkout will not be performed until a compatibility check is performed on current components.';
        $_SESSION["errors"] = $checkoutError;
        header("Location: index.php");
    } elseif($_SESSION["errors"][0] != "Parts Are Compatible!") {
        $checkoutError[0] = 'Checkout will not be performed until all items are selected and found to be compatible.';
        $_SESSION["errors"] = $checkoutError;
        header("Location: index.php");
    }
?>

<html>
    <link rel="stylesheet" type="text/css"  href="/Team Project/CSS/tp.css">
    <div class="pageTitle" >
        Checkout Details
    </div>
    <div class="border"></div>
    <div class="body">
<div class="checkoutDisplay">
        <table>

            <tr>
                <td>CPU</td>
                    <?php 
                        echo '<td>'.$_SESSION["cpuSelected"]["cpuName"].'</td>';
                        echo '<td>$'.$_SESSION["cpuSelected"]["cpuPrice"].'</td>';
                        
                    ?>
            </tr>
            <tr>
                <td>Motherboard</td>
                <?php 
                        echo '<td>'.$_SESSION["mbSelected"]["mbName"].'</td>';
                        echo '<td>$'.$_SESSION["mbSelected"]["mbPrice"].'</td>';
                    ?>
            </tr>
            <tr>
                <td>Memory</td>
                    <?php 
                        echo '<td>'.$_SESSION["ramSelected"]["ramName"].'</td>';
                        echo '<td>$'.$_SESSION["ramSelected"]["ramPrice"].'</td>';
                    ?>
            </tr>
            <tr>
                <td>Storage</td>
                    <?php 
                        echo '<td>'.$_SESSION["storageSelected"]["storageName"].'</td>';
                        echo '<td>$'.$_SESSION["storageSelected"]["storagePrice"].'</td>';
                    ?>
            </tr>
                <td>Video Card</td>
                    <?php 
                        echo '<td>'.$_SESSION["gpuSelected"]["gpuName"].'</td>';
                        echo '<td>$'.$_SESSION["gpuSelected"]["gpuPrice"].'</td>';
                    ?>
            </tr>
            <tr>
                <td>Case</td>
                    <?php 
                        echo '<td>'.$_SESSION["caseSelected"]["caseName"].'</td>';
                        echo '<td>$'.$_SESSION["caseSelected"]["casePrice"].'</td>';
                    ?>
            </tr>
            <tr>
                <td>Power Supply</td>
                    <?php
                        echo '<td>'.$_SESSION["psuSelected"]["psuName"].'</td>';
                        echo '<td>$'.$_SESSION["psuSelected"]["psuPrice"].'</td>';
                    ?>
            </tr>
            <tr class="totalRow">
                <td></td>
                <th>Total: </th>
                <?php 
                    echo '<th>$'.$_SESSION["totalPrice"].'</th>';
                ?>
            </tr>
            </table>
    </div>
    </div>
    <div class="border"></div>
</html>