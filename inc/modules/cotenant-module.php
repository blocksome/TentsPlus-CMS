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
                <div>Co-Tenants
                    <div class="page-title-subheading">List of Co-Tenants under TentsPlus.
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
                <div class="card-header">Co-Tenants
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button class="active btn btn-focus" data-toggle='modal' data-target='#cotenant-modal-insert'>
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
                                <th class="text-center">Phone Number</th>
                                <th class="text-center">Tenant ID</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Citizenship</th>
                                <th class="text-center">Date of Birth</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="cotenant-tbody">

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
                                $sql .= "FROM cotenant ";
                                $sql .= "ORDER BY cot_id;";
                                $result = $con->query($sql);
                                if ($result->num_rows > 0) {

                                    $i = 0;
                                    //Display rows
                                    while ($row = mysqli_fetch_assoc($result)) {

                                        $i++;
                                        echo "<tr id='cotenant-row-" . $row["cot_id"] . "'>";
                                        echo "<td class='text-center text-muted cotenant-id'>" . $row["cot_id"] . "</td>";
                                        echo "<td class='text-center cotenant-phone'>" . $row["cot_phone"] . "</td>";
                                        echo "<td class='text-center text-muted cotenant-tenant-id'>" . $row["tenant_id"] . "</td>";
                                        echo "<td class='text-center text-muted cotenant-name'>" . $row["cot_name"] . "</td>";
                                        echo "<td class='text-center text-muted cotenant-citizenship'>" . $row["cot_citizenship"] . "</td>";
                                        echo "<td class='text-center text-muted cotenant-dob'>" . $row["cot_dob"] . "</td>";

                                        echo "<td class='text-center cotenant-edit-btn' data-cotenant-id='" . $row["cot_id"] . "'> <button type='button' id'PopoverCustomT-1' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#cotenant-modal'>Edit</button> </td>";
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
                                    <span class="pl-1">[Name of Tenant]</span>
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
<div class="modal fade" id="cotenant-modal" tabindex="-1" role="dialog" aria-labelledby="cotenant-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cotenant-modal-title">Edit Co-Tenant Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    <label for="cotenant-id">Co-Tenant ID <span class="text-danger">*</span></label><br>
                    <input disabled="true" type="text" name="cotenant-id" id="cotenant-modal-id" value="" placeholder="e.g. CT1234"><br>

                    <label for="cotenant-phone">Phone No. <span class="text-danger">*</span></label><br>
                    <input type="text" name="cotenant-phone" id="cotenant-modal-phone" value="" placeholder="e.g. 90705271"><br>

                    <label for="tenant-id">Tenant ID <span class="text-danger">*</span></label><br>
                    <input type="text" name="tenant-id" id="cotenant-modal-tenant-id" value="" placeholder="e.g. TT1234"><br>

                    <label for="cotenant-name">Name <span class="text-danger">*</span></label><br>
                    <input type="text" name="cotenant-name" id="cotenant-modal-name" value="" placeholder="e.g. Joses Kang Junwei"><br>

                    <label for="cotenant-citizenship">Citizenship <span class="text-danger">*</span></label><br>
                    <input type="text" name="cotenant-citizenship" id="cotenant-modal-citizenship" value="" placeholder="e.g. Singapore"><br>

                    <label for="cotenant-dob">Date of Birth <span class="text-danger">*</span></label><br>
                    <input type="text" name="cotenant-dob" id="cotenant-modal-dob" value="" placeholder="e.g. 2002-07-13"><br>

                    <br>
                    <h6 class="text-danger">Required Field *</h6>
                </form>
            </div>

            <div class="modal-footer">
                <button class="mr-2 btn-icon btn-icon-only btn btn-danger" id="cotenant-delete-btn" style="position: absolute; left: 1vw;" data-toggle='modal' data-target='#cotenant-modal-delete'>
                    <i class="pe-7s-trash btn-icon-wrapper"></i>
                    Delete Tenant
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="cotenant-update-cfm">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!--Delete Confirmation-->
<div class="modal fade" id="cotenant-modal-delete" tabindex="-1" role="dialog" aria-labelledby="cotenant-modal-delete-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cotenant-modal-delete-title">Hold On!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <h5>You're about to delete this Co-Tenant. This data will be lost forever! (A very long time!)</h5>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <?php ob_start(); ?>

                <button type="button" class="btn btn-danger" id="cotenant-delete-cfm">Delete</button>
            </div>
        </div>
    </div>
</div>

<!--Modal for Insert-->
<div class="modal fade" id="cotenant-modal-insert" tabindex="-1" role="dialog" aria-labelledby="cotenant-modal-insert-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cotenant-modal-insert-title">Insert Co-Tenant Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    <label for="cotenant-id">Co-Tenant ID <span class="text-danger">*</span></label><br>
                    <input type="text" name="cotenant-id" id="cotenant-insert-id" value="" placeholder="e.g. CT1234"><br>

                    <label for="cotenant-phone">Phone No. <span class="text-danger">*</span></label><br>
                    <input type="text" name="cotenant-phone" id="cotenant-insert-phone" value="" placeholder="e.g. 90705271"><br>

                    <label for="tenant-id">Tenant ID <span class="text-danger">*</span></label><br>
                    <input type="text" name="tenant-id" id="cotenant-insert-tenant-id" value="" placeholder="e.g. TT1234"><br>

                    <label for="cotenant-name">Name <span class="text-danger">*</span></label><br>
                    <input type="text" name="cotenant-name" id="cotenant-insert-name" value="" placeholder="e.g. Joses Kang Junwei"><br>

                    <label for="cotenant-citizenship">Citizenship <span class="text-danger">*</span></label><br>
                    <input type="text" name="cotenant-citizenship" id="cotenant-insert-citizenship" value="" placeholder="e.g. Singapore"><br>

                    <label for="cotenant-dob">Date of Birth <span class="text-danger">*</span></label><br>
                    <input type="text" name="cotenant-dob" id="cotenant-insert-dob" value="" placeholder="e.g. 2002-07-13"><br>

                    <br>
                    <h6 class="text-danger">Required Field *</h6>
                </form>
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="cotenant-insert-cfm">Insert Data</button>
            </div>
        </div>
    </div>
</div>