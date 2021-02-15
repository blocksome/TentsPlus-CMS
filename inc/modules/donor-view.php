<?php include("../crud/db-login.php"); ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-male icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <!--Page Title-->
                <div>Donors View
                    <div class="page-title-subheading">List of Items Donated per Donor.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); // Test if connection occurred.
    if (mysqli_connect_errno()) {

        die("Database connection failed: " .
            " mysqli_connect_error()" .
            "(" . mysqli_connect_errno() . ")");
    } else {
        $sql1 = "SELECT *
        FROM donor
        ORDER BY donor_id;
        ";

        $sql2 = "SELECT *
        FROM item
        ORDER BY item_id;
        ";

        $result1 = $con->query($sql1);
        if ($result1->num_rows > 0) {
            while ($row1 = mysqli_fetch_assoc($result1)) {
                echo '<div class="row">

        <!--Table-->
        <div class="col-md-12 col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-header">' . $row1["donor_name"] . '
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Item Name</th>
                            </tr>
                        </thead>
                        <tbody>';

                $result2 = $con->query($sql2);
                if ($result2->num_rows > 0) {
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        if ($row2["donor_id"] == $row1["donor_id"]) {
                            echo "<tr>";
                            echo "<td class='text-center text-muted'>" . $row2["item_id"] . "</td>";
                            echo "<td class='text-center'>" . $row2["item_name"] . "</td>";
                            echo "</tr>";
                        }
                    }
                }

                echo '</tbody>
                    </table>
                </div>

                <div class="d-block text-center card-footer">


                </div>
            </div>
        </div>

    </div>';
            }
        }
    }

    ?>

