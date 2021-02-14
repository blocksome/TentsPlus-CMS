//Script for TentsPlus CMS

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

    
    //========================================================================
});
