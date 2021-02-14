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

        $selectedTenantID = $_GET["tenantID"];

        $sql = "DELETE ";
        $sql .= "FROM tenant ";
        $sql .= "WHERE tenant_id = '$selectedTenantID';";

        $result = $con->query($sql);
        if ($con->error) {
            printf("Query failed: %s\n", $con->error);
        } else {
            echo "success";
        }

    }
}

$con->close();
