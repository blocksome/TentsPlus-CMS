<?php

include("db-login.php");

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

    //Item
    else if (isset($_GET["itemID"])) {

        $itemID = $_GET["itemID"];
        $itemName = $_GET["itemName"];
        $itemDonorID = $_GET["itemDonorID"];

        $sql = "INSERT INTO item ";
        $sql .= "(item_id, item_name, donor_id) ";
        $sql .= "VALUES (";
        $sql .= "'$itemID', ";
        $sql .= "'$itemName', ";
        $sql .= "'$itemDonorID');";

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
        $caseWorkerName = $_GET["caseWorkerName"];
        $caseWorkerTenantID = $_GET["caseWorkerTenantID"];

        $sql = "INSERT INTO case_worker ";
        $sql .= "(case_id, case_name, tenant_id) ";
        $sql .= "VALUES (";
        $sql .= "'$caseWorkerID', ";
        $sql .= "'$caseWorkerName', ";
        $sql .= "'$caseWorkerTenantID');";

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
        $consumableName = $_GET["consumableName"];
        $consumableStatus = $_GET["consumableStatus"];
        $consumableLabel = $_GET["consumableLabel"];
        $consumableTenantID = $_GET["consumableTenantID"];
        $consumableComment = $_GET["consumableComment"];

        $sql = "INSERT INTO consumable ";
        $sql .= "(cons_id, cons_name, cons_status, cons_label, tenant_id, cons_comment) ";
        $sql .= "VALUES (";
        $sql .= "'$consumableID', ";
        $sql .= "'$consumableName', ";
        $sql .= "'$consumableStatus', ";
        $sql .= "'$consumableLabel', ";
        $sql .= "'$consumableTenantID', ";
        $sql .= "'$consumableComment');";

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
        $cotenantPhone = $_GET["cotenantPhone"];
        $cotenantTenantID = $_GET["cotenantTenantID"];
        $cotenantName = $_GET["cotenantName"];
        $cotenantCitizenship = $_GET["cotenantCitizenship"];
        $cotenantDOB = $_GET["cotenantDOB"];

        $sql = "INSERT INTO cotenant ";
        $sql .= "(cot_id, cot_phone, tenant_id, cot_name, cot_citizenship, cot_dob) ";
        $sql .= "VALUES (";
        $sql .= "'$cotenantID', ";
        $sql .= "'$cotenantPhone', ";
        $sql .= "'$cotenantTenantID', ";
        $sql .= "'$cotenantName', ";
        $sql .= "'$cotenantCitizenship', ";
        $sql .= "'$cotenantDOB');";

        $result = $con->query($sql);
        if ($con->error) {
            $statusMsg = "Query failed: %s\n, $con->error";
        } else {
            $statusMsg = "success";
        }

    }

    //Donor
    else if (isset($_GET["donorID"])) {

        $donorID = $_GET["donorID"];
        $donorName = $_GET["donorName"];

        $sql = "INSERT INTO donor ";
        $sql .= "(donor_id, donor_name) ";
        $sql .= "VALUES (";
        $sql .= "'$donorID', ";
        $sql .= "'$donorName');";

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
