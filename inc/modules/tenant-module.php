<?php
//Connect to database

//School db login
/*
$dbhost = "localhost";
$dbuser = "amphibis_joses";
$dbpass = "miGLzU*S.xJV";
$dbname = "amphibis_joses";
*/

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "tents_plus_database";
?>


<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-male icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <!--Page Title-->
                <div>Tenants
                    <div class="page-title-subheading">List of Tenants under TentsPlus.
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
                <div class="card-header">Tenants
                    <div class="btn-actions-pane-right">
                        <!--
                        <div role="group" class="btn-group-sm btn-group">
                            <button class="active btn btn-focus">Last Week</button>
                            <button class="btn btn-focus">All Month</button>
                        </div>
                        -->
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th>Unit Number</th>
                                <th class="text-center">No. of Co-Tenants</th>
                                <th class="text-center">Rental Status</th>
                                <th class="text-center">Rental Amount</th>
                                <th class="text-center">Rental Deposit</th>
                                <th class="text-center">Amount Spent</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

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
                                $sql .= "FROM tenant as t ";
                                $sql .= "INNER JOIN unit as u ";
                                $sql .= "ON t.unit_id = u.unit_id ";
                                $sql .= "ORDER BY tenant_id;";
                                $result = $con->query($sql);
                                if ($result->num_rows > 0) {

                                    $i = 0;
                                    //Display rows
                                    while ($row = mysqli_fetch_assoc($result)) {

                                        $i++;
                                        echo "<tr data-tenant-row='" . $i . "'>";
                                        echo "<td class='text-center text-muted tenant-id'>" . $row["tenant_id"] . "</td>";
                                        echo "<td class='tenant-unit-num'>" . $row["unit_num"] . "</td>";
                                        echo "<td class='text-center text-muted cotenant-number'>" . $row["cotenant_num"] . "</td>";

                                        //Display different badges for different rental statuses
                                        if ($row["rental_status"] == "Delayed") {
                                            echo "<td class='text-center tenant-rental-status'> <div class='badge badge-warning'>Delayed</div> </td>";
                                        } else if ($row["rental_status"] == "Fully Paid") {
                                            echo "<td class='text-center tenant-rental-status'> <div class='badge badge-success'>Paid</div> </td>";
                                        } else if ($row["rental_status"] == "Installment") {
                                            echo "<td class='text-center tenant-rental-status'> <div class='badge badge-danger'>Installment</div> </td>";
                                        } else {
                                            echo "<td class='text-center tenant-rental-status'> <div class='badge badge-warning'>Other</div> </td>";
                                        }

                                        echo "<td class='text-center tenant-rental-amount'>$" . $row["rental_amount"] . "</td>";
                                        echo "<td class='text-center tenant-rental-deposit'>$" . $row["rental_deposit"] . "</td>";
                                        echo "<td class='text-center tenant-amount_spent'>$" . $row["amount_spent"] . "</td>";
                                        echo "<td class='text-center tenant-edit-btn'> <button type='button' id'PopoverCustomT-1' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#tenant-modal'>Edit</button> </td>";
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
                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger">
                        <i class="pe-7s-trash btn-icon-wrapper"></i>
                        Truncate All Data
                    </button>

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
                    <div class="btn-actions-pane-right">
                        <div class="nav">
                            <a href="javascript:void(0);" class="border-0 btn-pill btn-wide btn-transition active btn btn-outline-alternate">Tab 1</a>
                            <a href="javascript:void(0);" class="ml-1 btn-pill btn-wide border-0 btn-transition  btn btn-outline-alternate second-tab-toggle-alt">Tab 2</a>
                        </div>
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
<div class="modal fade" id="tenant-modal" tabindex="-1" role="dialog" aria-labelledby="tenant-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tenant-modal-title">Edit Tenant Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    <label for="tenant-id">Tenant ID</label><br>
                    <input type="text" name="tenant-id" value=""><br>

                    <label for="unit-number">Unit No.</label><br>
                    <select name="unit-number">
                    <option value="">Select a Unit</option>
                        <?php
                        $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); // Test if connection occurred.

                        if (mysqli_connect_errno()) {

                            die("Database connection failed: " .
                                " mysqli_connect_error()" .
                                "(" . mysqli_connect_errno() . ")");
                        } else {
                            //Run MYSQL request upon successful connection
                            $sql = "SELECT * ";
                            $sql .= "FROM unit ";
                            $sql .= "ORDER BY unit_id;";
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {

                                $i = 0;
                                //Display rows
                                while ($row = mysqli_fetch_assoc($result)) {

                                    echo '<option value="' . $row["unit_id"] . '">' . $row["unit_num"] . '</option>';
                                    
                                }
                            } else if ($con->error) {
                                printf("Query failed: %s\n", $con->error);
                            } else {

                                echo "No results!";
                            }
                        }
                        ?>
                    </select><br>

                    <label for="cotenant-num">No. of Co-Tenants</label><br>
                    <input type="number" name="cotenant-num" min="1" max="5" value="1"><br>

                    <label for="rental-status">Rental Status</label><br>
                    <select name="rental-status">
                        <option value="">Select a Status</option>
                        <option value="Fully Paid">Fully Paid</option>
                        <option value="Delayed">Delayed</option>
                        <option value="Installment">Installment</option>
                    </select><br>

                    <label for="rental-amount">Rental Amount ($)</label><br>
                    <input type="text" name="rental-amount" value=""><br>

                    <label for="rental-deposit">Rental Deposit ($)</label><br>
                    <input type="text" name="rental-deposit" value=""><br>

                    <label for="amount-spent">Amount Spent ($)</label><br>
                    <input type="text" name="amount-spent" value=""><br>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>