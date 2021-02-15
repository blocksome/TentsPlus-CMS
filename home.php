<!--TentsPlus CMS-->

<!doctype html>
<?php include("inc/crud/db-login.php"); ?>

<html lang="en">

<!--Head-->
<?php include("inc/general/head.php"); ?>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header" id="page-content">

        <!--Header-->
        <?php include("inc/general/header.php") ?>

        <!--Right Scrollable Layout Options-->
        <?php //include("inc/general/layout-options.php") 
        ?>

        <div class="app-main">
            <!--Scrollable Left Sidebar-->
            <?php include("inc/general/sidebar.php") ?>

            <div class="app-main__outer">
                <div id="load-div">
                    <!--Page Module Content (replace for each page)-->
                </div>

                <!--Footer-->
                <?php //include("inc/general/footer.php"); ?>
            </div>

            <!--Google Maps API-->
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>

    <div id="mysql-loader"></div>

    <!--jQquery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous">
    </script>

    <!--CMS Template Script-->
    <script type="text/javascript" src="./assets/scripts/main.js"></script>

    <!--Local Script-->
    <script type="text/javascript" src="js/script.js"></script>

</body>

</html>