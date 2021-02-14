//Script for TentsPlus CMS

$(document).ready(function () {
    moveModals();

    //Move all modals to end of body tag
    function moveModals() {
        for (var i = 0; i < $(".modal").length; i++) {
            $("#page-content").after($(".table-responsive .modal:nth-child(1)"));
            console.log(i);
        }
    }

    //Remove old modals
    function removeModals() {
        $(".modal").remove();
    }

    //Routing interactions
    $(".tab-btn").click(function () {
        $(".tab-btn").removeClass("mm-active");
    });

    //Tenants & Utility
    $("#tenant-tab-btn").click(function () {
        $("#tenant-tab-btn").addClass("mm-active");
        removeModals();
        $("#load-div").load("inc/modules/utility-module.php", function () {
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

});
