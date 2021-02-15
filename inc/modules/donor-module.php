<?php include("../crud/db-login.php"); ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-user-tie icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <!--Page Title-->
                <div>Donors
                    <div class="page-title-subheading">List of Donors Who Have Donated to TentsPlus.
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
                <div class="card-header">Donors
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button class="active btn btn-focus" data-toggle='modal' data-target='#donor-modal-insert'>
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
                                <th class="text-center">Donor Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="donor-tbody">

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
                                $sql .= "FROM donor ";
                                $sql .= "ORDER BY donor_id;";
                                $result = $con->query($sql);
                                if ($result->num_rows > 0) {

                                    $i = 0;
                                    //Display rows
                                    while ($row = mysqli_fetch_assoc($result)) {

                                        $i++;
                                        echo "<tr id='donor-row-" . $row["donor_id"] . "'>";
                                        echo "<td class='text-center text-muted donor-id'>" . $row["donor_id"] . "</td>";
                                        echo "<td class='text-center text-muted donor-name'>" . $row["donor_name"] . "</td>";
                                        echo "<td class='text-center donor-edit-btn' data-donor-id='" . $row["donor_id"] . "'> <button type='button' id'PopoverCustomT-1' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#donor-modal'>Edit</button> </td>";
                                        echo "</tr>";
                                    }
                                } else if ($con->error) {
                                    printf("Query failed: %s\n", $con->error);
                                } else {

                                    echo "No results!";
                                }
                            } 
                            
                            $con->close();?>
                        </tbody>
                    </table>
                </div>

                <div class="d-block text-center card-footer">


                </div>
            </div>
        </div>

</div>

<!--Modal for Edits-->
<div class="modal fade" id="donor-modal" tabindex="-1" role="dialog" aria-labelledby="donor-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="donor-modal-title">Edit Donor Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    <label for="donor-id">ID <span class="text-danger">*</span></label><br>
                    <input disabled="true" type="text" name="donor-id" id="donor-modal-id" value="" placeholder="e.g. DR1234"><br>

                    <label for="donor-name">Donor Name <span class="text-danger">*</span></label><br>
                    <input type="text" name="donor-name" id="donor-modal-name" value="" placeholder="e.g. Malcolm Yam"><br>

                    <br>
                    <h6 class="text-danger">Required Field *</h6>
                </form>
            </div>

            <div class="modal-footer">
                <button class="mr-2 btn-icon btn-icon-only btn btn-danger" id="donor-delete-btn" style="position: absolute; left: 1vw;" data-toggle='modal' data-target='#donor-modal-delete'>
                    <i class="pe-7s-trash btn-icon-wrapper"></i>
                    Delete Donor
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="donor-update-cfm">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!--Delete Confirmation-->
<div class="modal fade" id="donor-modal-delete" tabindex="-1" role="dialog" aria-labelledby="donor-modal-delete-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="donor-modal-delete-title">Hold On!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <h5>You're about to delete this Donor. This data will be lost forever! (A very long time!)</h5>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <?php ob_start(); ?>

                <button type="button" class="btn btn-danger" id="donor-delete-cfm">Delete</button>
            </div>
        </div>
    </div>
</div>

<!--Modal for Insert-->
<div class="modal fade" id="donor-modal-insert" tabindex="-1" role="dialog" aria-labelledby="donor-insert-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="donor-insert-title">Insert Donor Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    <label for="donor-id">ID <span class="text-danger">*</span></label><br>
                    <input type="text" name="donor-id" id="donor-insert-id" value="" placeholder="e.g. DR1234"><br>

                    <label for="donor-name">Donor Name <span class="text-danger">*</span></label><br>
                    <input type="text" name="donor-name" id="donor-insert-name" value="" placeholder="e.g. Malcolm Yam"><br>

                    <br>
                    <h6 class="text-danger">Required Fields *</h6>
                </form>
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="donor-insert-cfm">Insert Data</button>
            </div>
        </div>
    </div>
</div>