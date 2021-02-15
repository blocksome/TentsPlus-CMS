//Script for TentsPlus CMS

//Variables to store selected data row
var selectedCaseWorker;
var selectedConsumables;
var selectedCotenant;
var selectedDonor;
var selectedItem;
var selectedItemHistory;
var selectedPayment;
var selectedTenant;
var selectedTenantItem;
var selectedTenantUtility;
var selectedUnit;
var selectedUnitHistory;

//Variables to store selected data id
var selectedCaseWorkerID;
var selectedConsumablesID;
var selectedCotenantID;
var selectedDonorID;
var selectedItemID;
var selectedItemHistoryID;
var selectedPaymentID;
var selectedTenantID;
var selectedTenantItemID;
var selectedTenantUtilityID;
var selectedUnitID;
var selectedUnitHistoryID;

$(document).ready(function () {
    $("#load-div").load("inc/modules/tenant-module.php", function () {
        moveModals();
    });
    moveModals();

    //Login
    $("#login-btn").click(function () {

        $.ajax({
            type: "POST",
            url: `inc/crud/login.php?
            username=${$("#login-username").val()}&
            password=${$("#login-password").val()}`,
            success: function (response) {
                if (response == "success") {
                    //Redirect to home
                    location.href = "home.php";
                }

                else{
                    $("#error-msg").text(response);
                }
                console.log(response);
            }
        });


    });

    //Logout
    $("#logout-btn").click(function () {
        location.href = "index.php";
        console.log("logged out");
    });

    //========================================================================
    //Move all modals to end of body tag
    function moveModals() {
        $("#page-content").after($(".modal"));
    }

    //Remove old modals
    function removeModals() {
        $(".modal").remove();
    }
    //========================================================================

    //========================================================================
    //Routing interactions
    //Modules
    $(".tab-btn").click(function () {
        $(".tab-btn").removeClass("mm-active");
    });

    //Tenants
    $("#tenant-tab-btn").click(function () {
        $("#tenant-tab-btn").addClass("mm-active");
        removeModals();
        $("#load-div").load("inc/modules/tenant-module.php", function () {
            moveModals();
        });
    });

    //Inventory Listing
    $("#inventory-tab-btn").click(function () {
        $("#inventory-tab-btn").addClass("mm-active");
        removeModals();
        $("#load-div").load("inc/modules/item-module.php", function () {
            moveModals();
        });
    });

    //Case Workers
    $("#case-worker-tab-btn").click(function () {
        $("#case-worker-tab-btn").addClass("mm-active");
        removeModals();
        $("#load-div").load("inc/modules/case-worker-module.php", function () {
            moveModals();
        });
    });

    //Consumables
    $("#consumable-tab-btn").click(function () {
        $("#consumable-tab-btn").addClass("mm-active");
        removeModals();
        $("#load-div").load("inc/modules/consumable-module.php", function () {
            moveModals();
        });
    });

    //Co-Tenants
    $("#cotenant-tab-btn").click(function () {
        $("#cotenant-tab-btn").addClass("mm-active");
        removeModals();
        $("#load-div").load("inc/modules/cotenant-module.php", function () {
            moveModals();
        });
    });

    //Donor
    $("#donor-tab-btn").click(function () {
        $("#donor-tab-btn").addClass("mm-active");
        removeModals();
        $("#load-div").load("inc/modules/donor-module.php", function () {
            moveModals();
        });
    });

    //Views
    //Tenants
    $("#tenant-view-btn").click(function () {
        $("#tenant-view-btn").addClass("mm-active");
        removeModals();
        $("#load-div").load("inc/modules/tenant-view.php", function () {
            moveModals();
        });
    });

    //Donors
    $("#donor-view-btn").click(function () {
        $("#donor-view-btn").addClass("mm-active");
        removeModals();
        $("#load-div").load("inc/modules/donor-view.php", function () {
            moveModals();
        });
    });

    //Unit
    $("#unit-view-btn").click(function () {
        $("#unit-view-btn").addClass("mm-active");
        removeModals();
        $("#load-div").load("inc/modules/unit-view.php", function () {
            moveModals();
        });
    });
    //========================================================================

    //========================================================================
    //Tenant Module

    //Fill relevant detail in edit tenant modal
    $("body").on("click", ".tenant-edit-btn", function () {
        selectedTenantID = $(this).attr("data-tenant-id");
        selectedTenant = $(`#tenant-row-${selectedTenantID} .tenant-id`).text();

        $("#tenant-modal-title").text(`Edit ${selectedTenantID}`);
        $("#tenant-modal-id").val(selectedTenant);
        //$("#tenant-modal-unit-num").val($(`#tenant-row-${selectedID} .tenant-unit-num`).text());
        //$("#tenant-modal-cotenant-num").val(parseInt($(`#tenant-row-${selectedID} .tenant-cotenant-number`).text()));
        //$("#tenant-modal-rental-status").val($(`#tenant-row-${selectedID} .tenant-rental-status`).text());

        var rentalAmount = $(`#tenant-row-${selectedTenantID} .tenant-rental-amount`);
        var amountSpent = $(`#tenant-row-${selectedTenantID} .tenant-amount-spent`);

        $("#tenant-modal-rental-amount").val(rentalAmount.text().slice(1, rentalAmount.text().length));
        $("#tenant-modal-amount-spent").val(amountSpent.text().slice(1, amountSpent.text().length));
    });

    //Create Tenant
    $("body").on("click", "#tenant-insert-cfm", function () {
        //Form validation
        if ($("#tenant-modal-insert-id").val() == "" ||
            $("#tenant-insert-unit-num").val() == "" ||
            $("#tenant-insert-cotenant-num").val() == "" ||
            $("#tenant-insert-rental-status").val() == "" ||
            $("#tenant-insert-rental-amount").val() == "" ||
            $("#tenant-insert-amount-spent").val() == "") {

            alert("You can't leave required fields empty.");
        }

        else {
            $.ajax({
                type: "POST",
                url: `inc/crud/insert.php?
            tenantID=${$("#tenant-modal-insert-id").val()}&
            tenantUnitID=${$("#tenant-insert-unit-num").val()}&
            tenantCotenantNum=${$("#tenant-insert-cotenant-num").val()}&
            tenantRentalStatus=${$("#tenant-insert-rental-status").val()}&
            tenantRentalAmount=${$("#tenant-insert-rental-amount").val()}&
            tenantAmountSpent=${$("#tenant-insert-amount-spent").val()}`,
                success: function (response) {
                    if (response == "success") {
                        location.reload(true);
                    }

                    console.log(response);
                }
            });
        }


    });

    //Update Tenant
    $("body").on("click", "#tenant-update-cfm", function () {
        //Form validation
        if ($("#tenant-modal-id").val() == "" ||
            $("#tenant-modal-unit-num").val() == "" ||
            $("#tenant-modal-cotenant-num").val() == "" ||
            $("#tenant-modal-rental-status").val() == "" ||
            $("#tenant-modal-rental-amount").val() == "" ||
            $("#tenant-modal-amount-spent").val() == "") {

            alert("You can't leave required fields empty.");
        }
        else {
            $.ajax({
                type: "POST",
                url: `inc/crud/update.php?
            tenantID=${$("#tenant-modal-id").val()}&
            tenantUnitID=${$("#tenant-modal-unit-num").val()}&
            tenantCotenantNum=${$("#tenant-modal-cotenant-num").val()}&
            tenantRentalStatus=${$("#tenant-modal-rental-status").val()}&
            tenantRentalAmount=${$("#tenant-modal-rental-amount").val()}&
            tenantAmountSpent=${$("#tenant-modal-amount-spent").val()}`,
                success: function (response) {
                    if (response == "success") {
                        location.reload(true);
                    }

                    console.log(response);
                }
            });
        }

    });

    //Delete Tenant
    $("body").on("click", "#tenant-delete-cfm", function () {
        $.ajax({
            type: "POST",
            url: `inc/crud/delete.php?tenantID=${selectedTenantID}`,
            success: function (response) {
                if (response == "success") {
                    location.reload(true);
                }

                console.log(response);
            }
        });
    });


    //========================================================================

    //========================================================================
    //Inventory Module

    //Fill relevant detail in edit item modal
    $("body").on("click", ".item-edit-btn", function () {
        selectedItemID = $(this).attr("data-item-id");
        selectedItem = $(`#item-row-${selectedItemID} .item-id`).text();

        $("#item-modal-title").text(`Edit ${selectedItemID}`);
        $("#item-modal-id").val(selectedItem);

        var itemName = $(`#item-row-${selectedItemID} .item-name`);

        $("#item-modal-name").val(itemName.text());
    });

    //Create Item
    $("body").on("click", "#item-insert-cfm", function () {
        //Form validation
        if ($("#item-insert-id").val() == "" ||
            $("#item-insert-name").val() == "" ||
            $("#item-donor-id").val() == "") {

            alert("You can't leave required fields empty.");
        }

        else {
            $.ajax({
                type: "POST",
                url: `inc/crud/insert.php?
            itemID=${$("#item-insert-id").val()}&
            itemName=${$("#item-insert-name").val()}&
            itemDonorID=${$("#item-insert-donor-id").val()}`,
                success: function (response) {
                    if (response == "success") {
                        location.reload(true);
                    }

                    console.log(response);
                }
            });
        }


    });

    //Update Item
    $("body").on("click", "#item-update-cfm", function () {
        //Form validation
        if ($("#item-modal-id").val() == "" ||
            $("#item-modal-name").val() == "" ||
            $("#item-modal-donor-id").val() == "") {

            alert("You can't leave required fields empty.");
        }
        else {
            $.ajax({
                type: "POST",
                url: `inc/crud/update.php?
            itemID=${$("#item-modal-id").val()}&
            itemName=${$("#item-modal-name").val()}&
            itemDonorID=${$("#item-modal-donor-id").val()}`,
                success: function (response) {
                    if (response == "success") {
                        location.reload(true);
                    }

                    console.log(response);
                }
            });
        }

    });

    //Delete Item
    $("body").on("click", "#item-delete-cfm", function () {
        $.ajax({
            type: "POST",
            url: `inc/crud/delete.php?itemID=${selectedItemID}`,
            success: function (response) {
                if (response == "success") {
                    location.reload(true);
                }

                console.log(response);
            }
        });
    });

    //========================================================================

    //========================================================================
    //Case Worker Module

    //Fill relevant detail in edit case worker modal
    $("body").on("click", ".case-worker-edit-btn", function () {
        selectedCaseWorkerID = $(this).attr("data-case-worker-id");
        selectedCaseWorker = $(`#case-worker-row-${selectedCaseWorkerID} .case-worker-id`).text();

        $("#case-worker-modal-title").text(`Edit ${selectedCaseWorkerID}`);
        $("#case-worker-modal-id").val(selectedCaseWorker);

        var caseWorkerName = $(`#case-worker-row-${selectedCaseWorkerID} .case-worker-name`);
        var tenantID = $(`#case-worker-row-${selectedCaseWorkerID} .case-worker-tenant-id`);

        $("#case-worker-modal-name").val(caseWorkerName.text());
        $("#case-worker-modal-tenant-id").val(tenantID.text());
    });

    //Create Case Worker
    $("body").on("click", "#case-worker-insert-cfm", function () {
        //Form validation
        if ($("#case-worker-insert-id").val() == "" ||
            $("#case-worker-insert-name").val() == "" ||
            $("#case-worker-insert-tenant-id").val() == "") {

            alert("You can't leave required fields empty.");
        }

        else {
            $.ajax({
                type: "POST",
                url: `inc/crud/insert.php?
            caseWorkerID=${$("#case-worker-insert-id").val()}&
            caseWorkerName=${$("#case-worker-insert-name").val()}&
            caseWorkerTenantID=${$("#case-worker-insert-tenant-id").val()}`,
                success: function (response) {
                    if (response == "success") {
                        location.reload(true);
                    }

                    console.log(response);
                }
            });
        }


    });

    //Update Case Worker
    $("body").on("click", "#case-worker-update-cfm", function () {
        //Form validation
        if ($("#case-worker-modal-id").val() == "" ||
            $("#case-worker-modal-name").val() == "" ||
            $("#case-worker-modal-tenant-id").val() == "") {

            alert("You can't leave required fields empty.");
        }
        else {
            $.ajax({
                type: "POST",
                url: `inc/crud/update.php?
            caseWorkerID=${$("#case-worker-modal-id").val()}&
            caseWorkerName=${$("#case-worker-modal-name").val()}&
            caseWorkerTenantID=${$("#case-worker-modal-tenant-id").val()}`,
                success: function (response) {
                    if (response == "success") {
                        location.reload(true);
                    }

                    console.log(response);
                }
            });
        }

    });

    //Delete Case Worker
    $("body").on("click", "#case-worker-delete-cfm", function () {
        $.ajax({
            type: "POST",
            url: `inc/crud/delete.php?caseWorkerID=${selectedCaseWorkerID}`,
            success: function (response) {
                if (response == "success") {
                    location.reload(true);
                }

                console.log(response);
            }
        });
    });
    //========================================================================

    //========================================================================
    //Consumable Module

    //Fill relevant detail in edit tenant modal
    $("body").on("click", ".consumable-edit-btn", function () {
        selectedConsumableID = $(this).attr("data-consumable-id");
        selectedConsumable = $(`#consumable-row-${selectedConsumableID} .consumable-id`).text();

        $("#consumable-modal-title").text(`Edit ${selectedConsumableID}`);
        $("#consumable-modal-id").val(selectedConsumable);

        var consumableName = $(`#consumable-row-${selectedConsumableID} .consumable-name`);
        var consumableLabel = $(`#consumable-row-${selectedConsumableID} .consumable-label`);
        var consumableComment = $(`#consumable-row-${selectedConsumableID} .consumable-comment`);

        $("#consumable-modal-name").val(consumableName.text());

        $("#consumable-modal-label").val(consumableLabel.text());
        $("#consumable-modal-comment").val(consumableComment.text());
    });

    //Create Consumable
    $("body").on("click", "#consumable-insert-cfm", function () {
        //Form validation
        if ($("#consumable-modal-insert-id").val() == "" ||
            $("#consumable-insert-name").val() == "" ||
            $("#consumable-insert-status").val() == "") {

            alert("You can't leave required fields empty.");
        }

        else {
            $.ajax({
                type: "POST",
                url: `inc/crud/insert.php?
            consumableID=${$("#consumable-modal-insert-id").val()}&
            consumableName=${$("#consumable-insert-name").val()}&
            consumableStatus=${$("#consumable-insert-status").val()}&
            consumableLabel=${$("#consumable-insert-label").val()}&
            consumableTenantID=${$("#consumable-insert-tenant-id").val()}&
            consumableComment=${$("#consumable-insert-comment").val()}`,
                success: function (response) {
                    if (response == "success") {
                        location.reload(true);
                    }

                    console.log(response);
                }
            });
        }


    });

    //Update Consumable
    $("body").on("click", "#consumable-update-cfm", function () {
        //Form validation
        if ($("#consumable-modal-id").val() == "" ||
            $("#consumable-modal-name").val() == "" ||
            $("#consumable-modal-tenant-id").val() == "") {

            alert("You can't leave required fields empty.");
        }
        else {
            $.ajax({
                type: "POST",
                url: `inc/crud/update.php?
                consumableID=${$("#consumable-modal-id").val()}&
                consumableName=${$("#consumable-modal-name").val()}&
                consumableStatus=${$("#consumable-modal-status").val()}&
                consumableLabel=${$("#consumable-modal-label").val()}&
                consumableTenantID=${$("#consumable-modal-tenant-id").val()}&
                consumableComment=${$("#consumable-modal-comment").val()}`,
                success: function (response) {
                    if (response == "success") {
                        location.reload(true);
                    }

                    console.log(response);
                }
            });
        }

    });

    //Delete Consumable
    $("body").on("click", "#consumable-delete-cfm", function () {
        $.ajax({
            type: "POST",
            url: `inc/crud/delete.php?consumableID=${selectedConsumableID}`,
            success: function (response) {
                if (response == "success") {
                    location.reload(true);
                }

                console.log(response);
            }
        });
    });


    //========================================================================

    //========================================================================
    //Co-Tenant Module

    //Fill relevant detail in edit cotenant modal
    $("body").on("click", ".cotenant-edit-btn", function () {
        selectedCotenantID = $(this).attr("data-cotenant-id");
        selectedCotenant = $(`#cotenant-row-${selectedCotenantID} .cotenant-id`).text();

        $("#cotenant-modal-title").text(`Edit ${selectedCotenantID}`);
        $("#cotenant-modal-id").val(selectedCotenant);

        var phone = $(`#cotenant-row-${selectedCotenantID} .cotenant-phone`);
        var tenantID = $(`#cotenant-row-${selectedCotenantID} .cotenant-tenant-id`);
        var name = $(`#cotenant-row-${selectedCotenantID} .cotenant-name`);
        var citizenship = $(`#cotenant-row-${selectedCotenantID} .cotenant-citizenship`);
        var dob = $(`#cotenant-row-${selectedCotenantID} .cotenant-dob`);

        $("#cotenant-modal-phone").val(phone.text());
        $("#cotenant-modal-tenant-id").val(tenantID.text());
        $("#cotenant-modal-name").val(name.text());
        $("#cotenant-modal-citizenship").val(citizenship.text());
        $("#cotenant-modal-dob").val(dob.text());
    });

    //Create Tenant
    $("body").on("click", "#cotenant-insert-cfm", function () {
        //Form validation
        if ($("#cotenant-insert-id").val() == "" ||
            $("#cotenant-insert-phone").val() == "" ||
            $("#cotenant-insert-tenant-id").val() == "" ||
            $("#cotenant-insert-name").val() == "" ||
            $("#cotenant-insert-citizenship").val() == "" ||
            $("#cotenant-insert-dob").val() == "") {

            alert("You can't leave required fields empty.");
        }

        else {
            $.ajax({
                type: "POST",
                url: `inc/crud/insert.php?
            cotenantID=${$("#cotenant-insert-id").val()}&
            cotenantPhone=${$("#cotenant-insert-phone").val()}&
            cotenantTenantID=${$("#cotenant-insert-tenant-id").val()}&
            cotenantName=${$("#cotenant-insert-name").val()}&
            cotenantCitizenship=${$("#cotenant-insert-citizenship").val()}&
            cotenantDOB=${$("#cotenant-insert-dob").val()}`,
                success: function (response) {
                    if (response == "success") {
                        location.reload(true);
                    }

                    console.log(response);
                }
            });
        }


    });

    //Update Tenant
    $("body").on("click", "#cotenant-update-cfm", function () {
        //Form validation
        if ($("#cotenant-modal-id").val() == "" ||
            $("#cotenant-modal-phone").val() == "" ||
            $("#cotenant-modal-tenant-id").val() == "" ||
            $("#cotenant-modal-name").val() == "" ||
            $("#cotenant-modal-citizenship").val() == "" ||
            $("#cotenant-modal-dob").val() == "") {

            alert("You can't leave required fields empty.");
        }
        else {
            $.ajax({
                type: "POST",
                url: `inc/crud/update.php?
                cotenantID=${$("#cotenant-modal-id").val()}&
                cotenantPhone=${$("#cotenant-modal-phone").val()}&
                cotenantTenantID=${$("#cotenant-modal-tenant-id").val()}&
                cotenantName=${$("#cotenant-modal-name").val()}&
                cotenantCitizenship=${$("#cotenant-modal-citizenship").val()}&
                cotenantDOB=${$("#cotenant-modal-dob").val()}`,
                success: function (response) {
                    if (response == "success") {
                        location.reload(true);
                    }

                    console.log(response);
                }
            });
        }

    });

    //Delete Tenant
    $("body").on("click", "#cotenant-delete-cfm", function () {
        $.ajax({
            type: "POST",
            url: `inc/crud/delete.php?cotenantID=${selectedCotenantID}`,
            success: function (response) {
                if (response == "success") {
                    location.reload(true);
                }

                console.log(response);
            }
        });
    });


    //========================================================================

    //========================================================================
    //Donor Module

    //Fill relevant detail in edit donor modal
    $("body").on("click", ".donor-edit-btn", function () {
        selectedDonorID = $(this).attr("data-donor-id");
        selectedDonor = $(`#donor-row-${selectedDonorID} .donor-id`).text();

        $("#donor-modal-title").text(`Edit ${selectedDonorID}`);
        $("#donor-modal-id").val(selectedDonor);

        var donorName = $(`#donor-row-${selectedDonorID} .donor-name`);

        $("#donor-modal-name").val(donorName.text());
    });

    //Create Donor
    $("body").on("click", "#donor-insert-cfm", function () {
        //Form validation
        if ($("#donor-insert-id").val() == "" ||
            $("#donor-insert-name").val() == "") {

            alert("You can't leave required fields empty.");
        }

        else {
            $.ajax({
                type: "POST",
                url: `inc/crud/insert.php?
                donorID=${$("#donor-insert-id").val()}&
                donorName=${$("#donor-insert-name").val()}`,
                success: function (response) {
                    if (response == "success") {
                        location.reload(true);
                    }

                    console.log(response);
                }
            });
        }


    });

    //Update Donor
    $("body").on("click", "#donor-update-cfm", function () {
        //Form validation
        if ($("#donor-modal-id").val() == "" ||
            $("#donor-modal-name").val() == "") {

            alert("You can't leave required fields empty.");
        }
        else {
            $.ajax({
                type: "POST",
                url: `inc/crud/update.php?
                donorID=${$("#donor-modal-id").val()}&
                donorName=${$("#donor-modal-name").val()}`,
                success: function (response) {
                    if (response == "success") {
                        location.reload(true);
                    }

                    console.log(response);
                }
            });
        }

    });

    //Delete Donor
    $("body").on("click", "#donor-delete-cfm", function () {
        $.ajax({
            type: "POST",
            url: `inc/crud/delete.php?donorID=${selectedDonorID}`,
            success: function (response) {
                if (response == "success") {
                    location.reload(true);
                }

                console.log(response);
            }
        });
    });

    //========================================================================
});


