<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "tents_plus_database";

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); // Test if connection occurred.

if (mysqli_connect_errno()) {

    die("Database connection failed: " .
        " mysqli_connect_error()" .
        "(" . mysqli_connect_errno() . ")");
} else {
    //Run MYSQL request upon successful connection

    //Tenant
    if ($_GET["tenantID"] != null || $_GET["tenantID"] != "") {

        $tenantID = $_GET["tenantID"];
        $tenantUnitID = $_GET["tenantUnitID"];
        $tenantCotenantNum = $_GET["tenantCotenantNum"];
        $tenantRentalStatus = $_GET["tenantRentalStatus"];
        $tenantRentalAmount = $_GET["tenantRentalAmount"];
        $tenantAmountSpent = $_GET["tenantAmountSpent"];

        $sql = "UPDATE tenant ";
        $sql .= "SET tenant_id = '$tenantID', ";
        $sql .= "unit_id = '$tenantUnitID', ";
        $sql .= "cotenant_num = '$tenantCotenantNum', ";
        $sql .= "rental_status = '$tenantRentalStatus', ";
        $sql .= "rental_amount = '$tenantRentalAmount', ";
        $sql .= "amount_spent = '$tenantAmountSpent' ";
        $sql .= "WHERE tenant_id = '$tenantID';";

        $result = $con->query($sql);
        if ($con->error) {
            printf("Query failed: %s\n", $con->error);
        } else {
            echo "success";
        }

    }
}

$con->close();
