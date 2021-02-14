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
    moveModals();

    //========================================================================
    //Move all modals to end of body tag
    function moveModals() {
        $("#page-content").after($(".modal"));
        console.log("moved");
    }

    //Remove old modals
    function removeModals() {
        $(".modal").remove();
    }
    //========================================================================

    //========================================================================
    //Routing interactions
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
        $("#load-div").load("inc/modules/inventory-module.php", function () {
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
                        location.reload();
                    }
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
                        location.reload();
                    }
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
                    location.reload();
                }
            }
        });
    });


    //========================================================================
});
