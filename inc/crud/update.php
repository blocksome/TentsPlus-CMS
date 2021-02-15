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

        $sql = "UPDATE item ";
        $sql .= "SET item_id = '$itemID', ";
        $sql .= "item_name = '$itemName', ";
        $sql .= "donor_id = '$itemDonorID' ";
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
        $caseWorkerName = $_GET["caseWorkerName"];
        $caseWorkerTenantID = $_GET["caseWorkerTenantID"];

        $sql = "UPDATE case_worker ";
        $sql .= "SET case_id = '$caseWorkerID', ";
        $sql .= "case_name = '$caseWorkerName', ";
        $sql .= "tenant_id = '$caseWorkerTenantID' ";
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
        $consumableName = $_GET["consumableName"];
        $consumableStatus = $_GET["consumableStatus"];
        $consumableLabel = $_GET["consumableLabel"];
        $consumableTenantID = $_GET["consumableTenantID"];
        $consumableComment = $_GET["consumableComment"];

        $sql = "UPDATE consumable ";
        $sql .= "SET cons_id = '$consumableID', ";
        $sql .= "cons_name = '$consumableName', ";
        $sql .= "cons_status = '$consumableStatus', ";
        $sql .= "cons_label = '$consumableLabel', ";
        $sql .= "tenant_id = '$consumableTenantID', ";
        $sql .= "cons_comment = '$consumableComment' ";
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
        $cotenantPhone = $_GET["cotenantPhone"];
        $cotenantTenantID = $_GET["cotenantTenantID"];
        $cotenantName = $_GET["cotenantName"];
        $cotenantCitizenship = $_GET["cotenantCitizenship"];
        $cotenantDOB = $_GET["cotenantDOB"];

        $sql = "UPDATE cotenant ";
        $sql .= "SET cot_id = '$cotenantID', ";
        $sql .= "cot_phone = '$cotenantPhone', ";
        $sql .= "tenant_id = '$cotenantTenantID', ";
        $sql .= "cot_name = '$cotenantName', ";
        $sql .= "cot_citizenship = '$cotenantCitizenship', ";
        $sql .= "cot_dob = '$cotenantDOB' ";
        $sql .= "WHERE cot_id = '$cotenantID';";

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

        $sql = "UPDATE donor ";
        $sql .= "SET donor_id = '$donorID', ";
        $sql .= "donor_name = '$donorName' ";
        $sql .= "WHERE donor_id = '$donorID';";

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
