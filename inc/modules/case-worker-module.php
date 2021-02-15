<?php include("../crud/db-login.php"); ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-smile icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <!--Page Title-->
                <div>Case Workers
                    <div class="page-title-subheading">List of Case Workers in TentsPlus' Employ.
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
                <div class="card-header">Case Worker
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button class="active btn btn-focus" data-toggle='modal' data-target='#case-worker-modal-insert'>
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
                                <th class="text-center">Attached Tenant</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="case-worker-tbody">

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
                                $sql .= "FROM case_worker ";
                                $sql .= "ORDER BY case_id;";
                                $result = $con->query($sql);
                                if ($result->num_rows > 0) {

                                    $i = 0;
                                    //Display rows
                                    while ($row = mysqli_fetch_assoc($result)) {

                                        $i++;
                                        echo "<tr id='case-worker-row-" . $row["case_id"] . "'>";
                                        echo "<td class='text-center text-muted case-worker-id'>" . $row["case_id"] . "</td>";
                                        echo "<td class='text-center text-muted case-worker-name'>" . $row["case_name"] . "</td>";
                                        echo "<td class='text-center text-muted case-worker-tenant-id'>" . $row["tenant_id"] . "</td>";
                                        echo "<td class='text-center case-worker-edit-btn' data-case-worker-id='" . $row["case_id"] . "'> <button type='button' id'PopoverCustomT-1' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#case-worker-modal'>Edit</button> </td>";
                                        echo "</tr>";
                                    }
                                } else if ($con->error) {
                                    printf("Query failed: %s\n", $con->error);
                                } else {

                                    echo "No results!";
                                }
                            } ?>
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
                                    <span class="pl-1">[Name of Case Worker]</span>
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
<div class="modal fade" id="case-worker-modal" tabindex="-1" role="dialog" aria-labelledby="case-worker-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="case-worker-modal-title">Edit Case Worker Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    <label for="case-worker-id">Case Worker ID <span class="text-danger">*</span></label><br>
                    <input type="text" name="case-worker-id" id="case-worker-modal-id" value="" placeholder="e.g. CW1234"><br>

                    <label for="case-worker-name">Case Worker Name <span class="text-danger">*</span></label><br>
                    <input type="text" name="case-worker-name" id="case-worker-modal-name" value="" placeholder="e.g. Joe Kurr"><br>

                    <label for="case-worker-tenant-id">Attached Tenant ID <span class="text-danger">*</span></label><br>
                    <input type="text" name="case-worker-tenant-id" id="case-worker-modal-tenant-id" value="" placeholder="e.g. Joe Kurr"><br>

                    <br>
                    <h6 class="text-danger">Required Field *</h6>
                </form>
            </div>

            <div class="modal-footer">
                <button class="mr-2 btn-icon btn-icon-only btn btn-danger" id="case-worker-delete-btn" style="position: absolute; left: 1vw;" data-toggle='modal' data-target='#case-worker-modal-delete'>
                    <i class="pe-7s-trash btn-icon-wrapper"></i>
                    Delete Case Worker
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="case-worker-update-cfm">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!--Delete Confirmation-->
<div class="modal fade" id="case-worker-modal-delete" tabindex="-1" role="dialog" aria-labelledby="case-worker-modal-delete-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="case-worker-modal-delete-title">Hold On!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <h5>You're about to delete this Case Worker. This data will be lost forever! (A very long time!)</h5>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <?php ob_start(); ?>

                <button type="button" class="btn btn-danger" id="case-worker-delete-cfm">Delete</button>
            </div>
        </div>
    </div>
</div>

<!--Modal for Insert-->
<div class="modal fade" id="case-worker-modal-insert" tabindex="-1" role="dialog" aria-labelledby="case-worker-insert-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="case-worker-insert-title">Insert Case Worker Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    <label for="case-worker-id">ID <span class="text-danger">*</span></label><br>
                    <input type="text" name="case-worker-id" id="case-worker-insert-id" value="" placeholder="e.g. CW1234"><br>

                    <label for="case-worker-name">Name <span class="text-danger">*</span></label><br>
                    <input type="text" name="case-worker-name" id="case-worker-insert-name" value="" placeholder="e.g. Joe Kurr"><br>

                    <label for="case-worker-tenant-id">Attached Tenant ID<span class="text-danger">*</span></label><br>
                    <input type="text" name="case-worker-tenant-id" id="case-worker-insert-tenant-id" value="" placeholder="e.g. TT0001"><br>

                    <br>
                    <h6 class="text-danger">Required Fields *</h6>
                </form>
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="case-worker-insert-cfm">Insert Data</button>
            </div>
        </div>
    </div>
</div>