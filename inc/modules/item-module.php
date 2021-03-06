<?php include("../crud/db-login.php"); ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-archive icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <!--Page Title-->
                <div>Inventory Listing
                    <div class="page-title-subheading">List of Items in TentsPlus' Inventory.
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--Table and Graph-->
    <div class="row">

        <!--Table-->
        <div class="col-md-12 col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Items
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button class="active btn btn-focus" data-toggle='modal' data-target='#item-modal-insert'>
                                <i class="fas fa-plus">
                                </i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Item Name</th>
                                <th class="text-center">Donor</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="item-tbody">

                            <!--Run connection to populate data-->
                            <?php
                            $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); // Test if connection occurred.

                            if (mysqli_connect_errno()) {

                                die("Database connection failed: " .
                                    " mysqli_connect_error()" .
                                    "(" . mysqli_connect_errno() . ")");
                            } else {
                                //Run MYSQL request upon successful connection
                                $sql = "SELECT * ";
                                $sql .= "FROM item as i ";
                                $sql .= "INNER JOIN donor as d ";
                                $sql .= "ON i.donor_id = d.donor_id ";
                                $sql .= "ORDER BY item_id;";
                                $result = $con->query($sql);
                                if ($result->num_rows > 0) {

                                    $i = 0;
                                    //Display rows
                                    while ($row = mysqli_fetch_assoc($result)) {

                                        $i++;
                                        echo "<tr id='item-row-" . $row["item_id"] . "'>";
                                        echo "<td class='text-center text-muted item-id'>" . $row["item_id"] . "</td>";
                                        echo "<td class='text-center text-muted item-name'>" . $row["item_name"] . "</td>";
                                        echo "<td class='text-center text-muted item-donor-id'>" . $row["donor_name"] . "</td>";
                                        echo "<td class='text-center item-edit-btn' data-item-id='" . $row["item_id"] . "'> <button type='button' id'PopoverCustomT-1' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#item-modal'>Edit</button> </td>";
                                        echo "</tr>";
                                    }
                                } else if ($con->error) {
                                    printf("Query failed: %s\n", $con->error);
                                } else {

                                    echo "No results!";
                                }
                            } 
                            $con->close();
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-block text-center card-footer">


                </div>
            </div>
        </div>

</div>

<!--Modal for Edits-->
<div class="modal fade" id="item-modal" tabindex="-1" role="dialog" aria-labelledby="item-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="item-modal-title">Edit Item Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    <label for="item-id">Item ID <span class="text-danger">*</span></label><br>
                    <input disabled="true" type="text" name="item-id" id="item-modal-id" value="" placeholder="e.g. IT1234"><br>

                    <label for="item-name">Item Name <span class="text-danger">*</span></label><br>
                    <input type="text" name="item-name" id="item-modal-name" value="" placeholder="e.g. Coffee Table"><br>

                    <label for="donor-id">Donor <span class="text-danger">*</span></label><br>
                    <select name="donor-id" id="item-modal-donor-id">
                        <option value="">Select a Donor</option>
                        <?php
                        $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); // Test if connection occurred.

                        if (mysqli_connect_errno()) {

                            die("Database connection failed: " .
                                " mysqli_connect_error()" .
                                "(" . mysqli_connect_errno() . ")");
                        } else {
                            //Run MYSQL request upon successful connection
                            $sql = "SELECT * ";
                            $sql .= "FROM donor ";
                            $sql .= "ORDER BY donor_id;";
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {

                                $i = 0;
                                //Display rows
                                while ($row = mysqli_fetch_assoc($result)) {

                                    echo '<option value="' . $row["donor_id"] . '">' . $row["donor_name"] . '</option>';
                                }
                            } else if ($con->error) {
                                printf("Query failed: %s\n", $con->error);
                            } else {

                                echo "No results!";
                            }
                        }

                        $con->close();
                        ?>
                    </select><br>

                    <br>
                    <h6 class="text-danger">Required Field *</h6>
                </form>
            </div>

            <div class="modal-footer">
                <button class="mr-2 btn-icon btn-icon-only btn btn-danger" id="item-delete-btn" style="position: absolute; left: 1vw;" data-toggle='modal' data-target='#item-modal-delete'>
                    <i class="pe-7s-trash btn-icon-wrapper"></i>
                    Delete Item
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="item-update-cfm">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!--Delete Confirmation-->
<div class="modal fade" id="item-modal-delete" tabindex="-1" role="dialog" aria-labelledby="item-modal-delete-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="item-modal-delete-title">Hold On!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <h5>You're about to delete this Item. This data will be lost forever! (A very long time!)</h5>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <?php ob_start(); ?>

                <button type="button" class="btn btn-danger" id="item-delete-cfm">Delete</button>
            </div>
        </div>
    </div>
</div>

<!--Modal for Insert-->
<div class="modal fade" id="item-modal-insert" tabindex="-1" role="dialog" aria-labelledby="item-insert-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="item-insert-title">Insert Item Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    <label for="item-id">ID <span class="text-danger">*</span></label><br>
                    <input type="text" name="item-id" id="item-insert-id" value="" placeholder="e.g. IT1234"><br>

                    <label for="item-name">Item Name <span class="text-danger">*</span></label><br>
                    <input type="text" name="item-name" id="item-insert-name" value="" placeholder="e.g. Coffee Table"><br>

                    <label for="donor-id">Donor <span class="text-danger">*</span></label><br>
                    <select name="donor-id" id="item-insert-donor-id">
                        <option value="">Select a Donor</option>
                        <?php
                        $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); // Test if connection occurred.

                        if (mysqli_connect_errno()) {

                            die("Database connection failed: " .
                                " mysqli_connect_error()" .
                                "(" . mysqli_connect_errno() . ")");
                        } else {
                            //Run MYSQL request upon successful connection
                            $sql = "SELECT * ";
                            $sql .= "FROM donor ";
                            $sql .= "ORDER BY donor_id;";
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {

                                $i = 0;
                                //Display rows
                                while ($row = mysqli_fetch_assoc($result)) {

                                    echo '<option value="' . $row["donor_id"] . '">' . $row["donor_name"] . '</option>';
                                }
                            } else if ($con->error) {
                                printf("Query failed: %s\n", $con->error);
                            } else {

                                echo "No results!";
                            }
                        }

                        $con->close();
                        ?>
                    </select><br>
                    <br>
                    <h6 class="text-danger">Required Fields *</h6>
                </form>
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="item-insert-cfm">Insert Data</button>
            </div>
        </div>
    </div>
</div>