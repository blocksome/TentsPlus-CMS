<!--TentsPlus CMS-->
<!doctype html>
<html lang="en">

<!--Head-->
<?php include("inc/general/head.php"); ?>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">

        <!--Header-->
        <?php include("inc/general/header.php") ?>

        <!--Right Scrollable Layout Options-->
        <?php //include("inc/general/layout-options.php") 
        ?>

        <div class="app-main">
            <!--Scrollable Left Sidebar-->
            <?php include("inc/general/sidebar.php") ?>

            <div class="app-main__outer">
                <div class="load-div">
                    <!--Page Module Content (replace for each page)-->
                    <?php include("inc/modules/utility-module.php"); ?>
                </div>

                <!--Footer-->
                <?php include("inc/general/footer.php"); ?>
            </div>

            <!--Google Maps API-->
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>

    <!--CMS Template Script-->
    <script type="text/javascript" src="./assets/scripts/main.js"></script>
</body>

</html>