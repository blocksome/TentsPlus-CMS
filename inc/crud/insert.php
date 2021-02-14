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

        $sql = "INSERT INTO tenant ";
        $sql .= "(tenant_id, unit_id, cotenant_num, rental_status, rental_amount, amount_spent) ";
        $sql .= "VALUES (";
        $sql .= "'$tenantID', ";
        $sql .= "'$tenantUnitID', ";
        $sql .= "'$tenantCotenantNum', ";
        $sql .= "'$tenantRentalStatus', ";
        $sql .= "'$tenantRentalAmount', ";
        $sql .= "'$tenantAmountSpent');";

        $result = $con->query($sql);
        if ($con->error) {
            $statusMsg = "Query failed: %s\n, $con->error";
        } else {
            $statusMsg = "success";
        }

    }

    else{
       $statusMsg = "No query selected";
    }
}

echo $statusMsg;
$con->close();