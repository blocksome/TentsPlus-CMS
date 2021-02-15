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
    if (isset($_GET["tenantID"])) {

        $tenantID = $_GET["tenantID"];

        $sql = "DELETE ";
        $sql .= "FROM tenant ";
        $sql .= "WHERE tenant_id = '$tenantID';";

        $result = $con->query($sql);
        if ($con->error) {
            $statusMsg = "Query failed: %s\n, $con->error";
        } else {
            $statusMsg = "success";
        }

    }

    //Item
    else if (isset($_GET["itemID"])) {

        $itemID = $_GET["itemID"];

        $sql = "DELETE ";
        $sql .= "FROM item ";
        $sql .= "WHERE item_id = '$itemID';";

        $result = $con->query($sql);
        if ($con->error) {
            $statusMsg = "Query failed: %s\n, $con->error";
        } else {
            $statusMsg = "success";
        }

    }

    //Case Worker
    else if (isset($_GET["caseWorkerID"])) {

        $caseWorkerID = $_GET["caseWorkerID"];

        $sql = "DELETE ";
        $sql .= "FROM case_worker ";
        $sql .= "WHERE case_id = '$caseWorkerID';";

        $result = $con->query($sql);
        if ($con->error) {
            $statusMsg = "Query failed: %s\n, $con->error";
        } else {
            $statusMsg = "success";
        }

    }

    //Consumable
    else if (isset($_GET["consumableID"])) {

        $consumableID = $_GET["consumableID"];

        $sql = "DELETE ";
        $sql .= "FROM consumable ";
        $sql .= "WHERE cons_id = '$consumableID';";

        $result = $con->query($sql);
        if ($con->error) {
            $statusMsg = "Query failed: %s\n, $con->error";
        } else {
            $statusMsg = "success";
        }

    }

    //Co-Tenant
    else if (isset($_GET["cotenantID"])) {

        $cotenantID = $_GET["cotenantID"];

        $sql = "DELETE ";
        $sql .= "FROM cotenant ";
        $sql .= "WHERE cot_id = '$cotenantID';";

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
