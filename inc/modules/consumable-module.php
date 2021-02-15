<?php include("../crud/db-login.php"); ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-apple-alt icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <!--Page Title-->
                <div>Consumables
                    <div class="page-title-subheading">List of Consumables in TentsPlus' Inventory.
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--Table and Graph-->
    <div class="row">

        <!--Table-->
        <div class="col-md-12 col-lg-7">
            <div class="main-card mb-3 card">
                <div class="card-header">Consumables
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button class="active btn btn-focus" data-toggle='modal' data-target='#consumable-modal-insert'>
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
                                <th class="text-center">Name</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Label</th>
                                <th class="text-center">Tenant ID</th>
                                <th class="text-center">Comments</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="consumable-tbody">

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
                                $sql .= "FROM consumable ";
                                $sql .= "ORDER BY cons_id;";
                                $result = $con->query($sql);
                                if ($result->num_rows > 0) {

                                    $i = 0;
                                    //Display rows
                                    while ($row = mysqli_fetch_assoc($result)) {

                                        $i++;
                                        echo "<tr id='consumable-row-" . $row["cons_id"] . "'>";
                                        echo "<td class='text-center text-muted consumable-id'>" . $row["cons_id"] . "</td>";
                                        echo "<td class='text-center text-muted consumable-name'>" . $row["cons_name"] . "</td>";
                                        
                                        //Display different badges for different statuses
                                        if ($row["cons_status"] == "Taken") {
                                            echo "<td class='text-center consumable-status'> <div class='badge badge-warning'>Taken</div> </td>";
                                        } else if ($row["cons_status"] == "Available") {
                                            echo "<td class='text-center consumable-status'> <div class='badge badge-success'>Available</div> </td>";
                                        } else {
                                            echo "<td class='text-center consumable-status'> <div class='badge badge-danger'>" . $row["cons_status"] . "</div> </td>";
                                        }
                                        
                                        //Display different badges for different labels
                                        if ($row["cons_label"] == "Fee Waived") {
                                            echo "<td class='text-center consumable-label'> <div class='badge badge-success'>Fee Waived</div> </td>";
                                        } else if ($row["cons_label"] == "Discounted") {
                                            echo "<td class='text-center consumable-label'> <div class='badge badge-warning'>Discounted</div> </td>";
                                        } else {
                                            echo "<td class='text-center consumable-label'> <div class='badge badge-danger'>" . $row["cons_label"] . "</div> </td>";
                                        }

                                        //Check if tenant_id is null
                                        echo "<td class='text-center consumable-tenant-id'>" . $row["tenant_id"] . "</td>";

                                        echo "<td class='text-center consumable-comment'>" . $row["cons_comment"] . "</td>";
                                        echo "<td class='text-center consumable-edit-btn' data-consumable-id='" . $row["cons_id"] . "'> <button type='button' id'PopoverCustomT-1' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#consumable-modal'>Edit</button> </td>";
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

        <!--Graph-->
        <div class="col-md-12 col-lg-5">
            <div class="mb-3 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
                        Utility Charges Over Time
                    </div>

                </div>

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="tab-eg-55">
                        <div class="widget-chart p-3">
                            <div style="height: 350px">
                                <canvas id="utility-chart"></canvas>
                            </div>

                            <div class="widget-chart-content text-center mt-5">
                                <div class="widget-description mt-0 text-warning">
                                    <span class="pl-1">[Name of Consumable]</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-m-6">
                            <div class="card mb-2 widget-content bg-arielle-smile">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Clients</div>
                                        <div class="widget-subheading">Total Clients Profit</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span>$ 568</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-m-6">
                            <div class="card mb-2 widget-content bg-grow-early">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Followers</div>
                                        <div class="widget-subheading">People Interested</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span>46%</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--Coloured Tabs-->
    <div class="row">

        <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-premium-dark">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Products Sold</div>
                        <div class="widget-subheading">Revenue streams</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-warning"><span>$14M</span></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<!--Modal for Edits-->
<div class="modal fade" id="consumable-modal" tabindex="-1" role="dialog" aria-labelledby="consumable-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="consumable-modal-title">Edit Consumable Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    <label for="consumable-id">Consumable ID <span class="text-danger">*</span></label><br>
                    <input disabled="true" type="text" name="consumable-id" id="consumable-modal-id" value="" placeholder="e.g. CS0001"><br>

                    <label for="consumable-name">Name <span class="text-danger">*</span></label><br>
                    <input type="text" name="consumable-name" id="consumable-modal-name" value="" placeholder="e.g. 3 Pack Oreo"><br>

                    <label for="consumable-status">Status <span class="text-danger">*</span></label><br>
                    <select name="consumable-status" id="consumable-modal-status">
                        <option value="">Select a Status</option>
                        <option value="Taken">Taken</option>
                        <option value="Available">Available</option>
                    </select><br>

                    <label for="consumable-label">Label</label><br>
                    <input type="text" name="consumable-label" id="consumable-modal-label" value="" placeholder="e.g. Fee Waived"><br>
                    
                    <label for="consumable-tenant-id">Tenant ID</label><br>
                    <select name="consumable-modal-tenant-id" id="consumable-modal-tenant-id">
                        <option value="">Select a Tenant</option>
                        <option value="None">None</option>
                        <?php
                        $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); // Test if connection occurred.

                        if (mysqli_connect_errno()) {

                            die("Database connection failed: " .
                                " mysqli_connect_error()" .
                                "(" . mysqli_connect_errno() . ")");
                        } else {
                            //Run MYSQL request upon successful connection
                            $sql = "SELECT * ";
                            $sql .= "FROM tenant ";
                            $sql .= "ORDER BY tenant_id;";
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {

                                $i = 0;
                                //Display rows
                                while ($row = mysqli_fetch_assoc($result)) {

                                    echo '<option value="' . $row["tenant_id"] . '">' . $row["tenant_id"] . '</option>';
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

                    <label for="consumable-comment">Comments</label><br>
                    <input type="text" name="consumable-comment" id="consumable-modal-comment" value="" placeholder="e.g. Newly Stocked"><br>

                    <br>
                    <h6 class="text-danger">Required Field *</h6>
                </form>
            </div>

            <div class="modal-footer">
                <button class="mr-2 btn-icon btn-icon-only btn btn-danger" id="consumable-delete-btn" style="position: absolute; left: 1vw;" data-toggle='modal' data-target='#consumable-modal-delete'>
                    <i class="pe-7s-trash btn-icon-wrapper"></i>
                    Delete Consumable
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="consumable-update-cfm">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!--Delete Confirmation-->
<div class="modal fade" id="consumable-modal-delete" tabindex="-1" role="dialog" aria-labelledby="consumable-modal-delete-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="consumable-modal-delete-title">Hold On!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <h5>You're about to delete this Consumable. This data will be lost forever! (A very long time!)</h5>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <?php ob_start(); ?>

                <button type="button" class="btn btn-danger" id="consumable-delete-cfm">Delete</button>
            </div>
        </div>
    </div>
</div>

<!--Modal for Insert-->
<div class="modal fade" id="consumable-modal-insert" tabindex="-1" role="dialog" aria-labelledby="consumable-modal-insert-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="consumable-modal-insert-title">Insert Consumable Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    <label for="consumable-id">Consumable ID <span class="text-danger">*</span></label><br>
                    <input type="text" name="consumable-id" id="consumable-modal-insert-id" value="" placeholder="e.g. CS0001"><br>

                    <label for="consumable-name">Name <span class="text-danger">*</span></label><br>
                    <input type="text" name="consumable-name" id="consumable-insert-name" value="" placeholder="e.g. 3 Pack Oreo"><br>

                    <label for="consumable-status">Status <span class="text-danger">*</span></label><br>
                    <select name="consumable-status" id="consumable-insert-status">
                        <option value="">Select a Status</option>
                        <option value="Taken">Taken</option>
                        <option value="Available">Available</option>
                    </select><br>

                    <label for="consumable-label">Label</label><br>
                    <input type="text" name="consumable-label" id="consumable-insert-label" value="" placeholder="e.g. Fee Waived"><br>
                    
                    <label for="consumable-tenant-id">Tenant ID</label><br>
                    <select name="consumable-tenant-id" id="consumable-insert-tenant-id">
                        <option value="">Select a Tenant</option>
                        <option value="None">None</option>
                        <?php
                        $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); // Test if connection occurred.

                        if (mysqli_connect_errno()) {

                            die("Database connection failed: " .
                                " mysqli_connect_error()" .
                                "(" . mysqli_connect_errno() . ")");
                        } else {
                            //Run MYSQL request upon successful connection
                            $sql = "SELECT * ";
                            $sql .= "FROM tenant ";
                            $sql .= "ORDER BY tenant_id;";
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {

                                $i = 0;
                                //Display rows
                                while ($row = mysqli_fetch_assoc($result)) {

                                    echo '<option value="' . $row["tenant_id"] . '">' . $row["tenant_id"] . '</option>';
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

                    <label for="consumable-comment">Comments</label><br>
                    <input type="text" name="consumable-comment" id="consumable-insert-comment" value="" placeholder="e.g. Newly Stocked"><br>

                    <br>
                    <h6 class="text-danger">Required Field *</h6>
                </form>
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="consumable-insert-cfm">Insert Data</button>
            </div>
        </div>
    </div>
</div>