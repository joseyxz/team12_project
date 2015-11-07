<?php
$sql = "SELECT j.carPlate, j.originalLocation, j.currentDestination, p.name FROM driverjourney j, drivercar c, userprofile p WHERE j.carPlate = c.carPlate AND c.driverID = p.userID";

if ($statement = mysqli_prepare($connection, $sql)) {
    mysqli_stmt_execute($statement);

    mysqli_stmt_bind_result($statement, $carplate, $origin, $destination, $drivername);
    while (mysqli_stmt_fetch($statement)) {
        echo '<div ng-click="showPopup()" style="width:80%" ng-init="setCars(\''.$origin.'\',\''.$drivername.'\',\''.$carplate.'\',\''.$destination.'\')"></div>';
    }
}

?>