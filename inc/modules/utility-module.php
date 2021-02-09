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
                    <i class="fas fa-dollar-sign icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <!--Page Title-->
                <div>Tenants & Utilities
                    <div class="page-title-subheading">List of Tenants and their Utility Charges over time.
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
                                <th class="text-center">Rental Status</th>
                                <th class="text-center">Rental Amount</th>
                                <th class="text-center">Rental Deposit</th>
                                <th class="text-center">Display Graph</th>
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
                                $sql = "SELECT * "; //Select everything
                                $sql .= "FROM tenant "; //Reading from Projects table
                                $sql .= "ORDER BY tenant_id;"; //Sort by id
                                $result = $con->query($sql);
                                if ($result->num_rows > 0) { //Output data of each row

                                    $i = 0;
                                    //Display rows
                                    while ($row = mysqli_fetch_assoc($result)) {

                                        echo "<tr>";
                                        echo "<td class='text-center text-muted'>" . $row["tenant_id"] . "</td>";
                                        echo "<td>#" . $row["unit_num"] . "</td>";

                                        if ($row["rental_status"] == "Pending") {
                                            echo "<td class='text-center'> <div class='badge badge-warning'>Pending</div> </td>";
                                        } 
                                        
                                        else {
                                            echo "<td class='text-center'> <div class='badge badge-warning'>Unknown</div> </td>";
                                        }

                                        echo "<td class='text-center'>$" . $row["rental_amount"] . "</td>";
                                        echo "<td class='text-center'>$" . $row["rental_deposit"] . "</td>";
                                        echo "<td class='text-center'> <button type='button' id'PopoverCustomT-1' class='btn btn-info btn-sm'>Display</button> </td>";
                                        echo "<td class='text-center'> <button type='button' id'PopoverCustomT-1' class='btn btn-primary btn-sm'>Edit</button> </td>";
                                        echo "</tr>";
                                        $i++;
                                    }

                                    //echo "<span>Query complete, fetched " . $i . " result(s).</span>";
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
                                <canvas id="line-chart"></canvas>
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