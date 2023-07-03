<?php
include '.././Interface/Sharelayouts/header.php';
include '../Interface/config/db.php';
include '../Interface/services/common.php';
include '../CSSRes/dashboard.php';
include '../Interface/services/calllink.php'
?>
<style>
    body {
        background: #FFEFBA;
        /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #FFFFFF, #FFEFBA);
        /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #FFFFFF, #FFEFBA);
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    }
</style>



<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="./Dashboard.php">Shaminda Jewelers</a>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link" href="./loginpage.php"><i class="bi bi-door-open"></i> out</a>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block  sidebar collapse">
            <div class="position-sticky pt-3 sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./../Interface/prodcutcategory.php">
                            <span data-feather="home" class="align-text-bottom"></span>
                            Product and Category Info
                        </a>
                    </li>
                    <hr>
                    <li class="nav-item">
                        <a class="nav-link" href="../Inventory/inventorydash.php">
                            <span data-feather="file" class="align-text-bottom"></span>
                            Inventory Info
                        </a>
                    </li>
                    <hr>
                    <li class="nav-item">
                        <a class="nav-link" href="./../Customer/customerRegister.php">
                            <span data-feather="shopping-cart" class="align-text-bottom"></span>
                            Customer Info
                        </a>
                    </li>
                    <hr>
                    <li class="nav-item">
                        <a class="nav-link" href="./../Orders/DashboardOrdersandPayments.php">
                            <span data-feather="users" class="align-text-bottom"></span>
                            Order Info
                        </a>
                    </li>
                    <hr>
                    <li class="nav-item">
                        <a class="nav-link" href="./../Returnorders/dashboardretrunorder.php">
                            <span data-feather="users" class="align-text-bottom"></span>
                            Retrun Order
                        </a>
                    </li>
                    <hr>
                    <li class="nav-item">
                        <a class="nav-link" href="./../Employee/employeedashboard.php">
                            <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                            Employee Info
                        </a>
                    </li>
                    <hr>
                </ul>
            </div>
        </nav>
    </div>
</div>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="text-align: center;">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Oder Request Summary</h1>
    </div>
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-xl-3 col-md-6" id="left">
                <div class="card box-shawdow bg-secondary text-white mb-4">
                    <div class="card-body">Orders to the payament processed</div>
                    <div class=' row mx-0 d-flex jusitify-content-center'>
                        <div class='col-md-12 d-flex justify-content-center'>
                            <label class="text-center " id="size"><?php echo $ProcessedPaymentsCount ?></label>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-center">
                        <a class="small text-white stretched-link" href="../Orders/order.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6" id="left">
                <div class="card box-shawdow bg-secondary text-white mb-4">
                    <div class="card-body">Cancel Orders </div>
                    <div class=' row mx-0 d-flex jusitify-content-center'>
                        <div class='col-md-12 d-flex justify-content-center'>
                            <label class="text-center " id="size"><?php echo $cancelCount ?></label>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-center">
                        <a class="small text-white stretched-link" href="../Orders/order.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="text-align: center;">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Oder Payment Summary</h1>
    </div>
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-xl-3 col-md-6" id="left">
                <div class="card box-shawdow bg-secondary text-white mb-4">
                    <div class="card-body">Pending not complete so far Payments</div>
                    <div class=' row mx-0 d-flex jusitify-content-center'>
                        <div class='col-md-12 d-flex justify-content-center'>
                            <label class="text-center " id="size"><?php echo $pendingPaymentsCount ?></label>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-center">
                        <a class="small text-white stretched-link" href="../Orders/payment.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6" id="left">
                <div class="card box-shawdow bg-secondary text-white mb-4">
                    <div class="card-body">Complete Payments<br></div>
                    <div class=' row mx-0 d-flex jusitify-content-center'>
                        <div class='col-md-12 d-flex justify-content-center'>
                            <label class="text-center " id="size"><?php echo $completePaymentsCount ?></label>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-center">
                        <a class="small text-white stretched-link" href="../Orders/payment.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6" id="left">
                <div class="card box-shawdow bg-secondary text-white mb-4">
                    <div class="card-body">Payment done in Full </div>
                    <div class=' row mx-0 d-flex jusitify-content-center'>
                        <div class='col-md-12 d-flex justify-content-center'>
                            <label class="text-center " id="size"><?php echo $FullPaymentsCount ?></label>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-center">
                        <a class="small text-white stretched-link" href="../Orders/payment.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6" id="left">
                <div class="card box-shawdow bg-secondary text-white mb-4">
                    <div class="card-body">Payment done in Advance or Due Payments</div>
                    <div class=' row mx-0 d-flex jusitify-content-center'>
                        <div class='col-md-12 d-flex justify-content-center'>
                            <label class="text-center " id="size"><?php echo $advacnePaymentsCount ?></label>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-center">
                        <a class="small text-white stretched-link" href="../Orders/payment.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="text-align: center;">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Inventory Summary </h1>
    </div>
    <div>
        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
    </div><br>
</main>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="text-align: center;">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daily raw_metiral Cost and Leftovers </h1>
    </div>
    <div>
        <main style="text-align: center;">
            <div class="container-fluid px-4">
                <div class="row">
                    <div class="col-xl-3 col-md-6" id="left">
                        <div class="card box-shawdow bg-secondary text-white mb-4">
                            <div class="card-body">Payment Pending Count</div>
                            <div class=' row mx-0 d-flex jusitify-content-center'>
                                <div class='col-md-12 d-flex justify-content-center'>
                                    <label class="text-center " id="size"><?php echo $pendingCount ?></label>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-center">
                                <a class="small text-white stretched-link" href="../Inventory/stockfullcost.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6" id="left">
                        <div class="card box-shawdow bg-secondary text-white mb-4">
                            <div class="card-body">Complete Payments Count</div>
                            <div class=' row mx-0 d-flex jusitify-content-center'>
                                <div class='col-md-12 d-flex justify-content-center'>
                                    <label class="text-center " id="size"><?php echo $approvalCount ?></label>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-center">
                                <a class="small text-white stretched-link" href="../Inventory/stockfullcost.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

        </main>

        <?php
        include '../mysqldbconnection.php';
        $rawlist = "[";
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } else {

            $sql = "SELECT *  From raw_metiral group by name";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $rawlist .= "'" . $row['name'] . "',";
                }
            }
            $rawlist .= "]";
        }
        ?>
        <?php
        include '../mysqldbconnection.php';
        $rawData = "[";
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } else {
            $sql = "SELECT *  From stockcall";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $rawData .= "'" . $row['unit'] . "',";
                }
            }
            $rawData .= "]";
        }
        ?>

        <?php
        include '../mysqldbconnection.php';
        $Production = "[";
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } else {
            $sql = "SELECT *  From productionstock";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $Production .= "'" . $row['unittaken'] . "',";
                }
            }
            $Production .= "]";
        }
        ?>

        <?php
        include '../mysqldbconnection.php';
        $Daily = "[";
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } else {
            $sql = "SELECT *  From dailyleft";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $Daily .= "'" . $row['qyt'] . "',";
                }
            }
            $Daily .= "]";
        }


        ?>
        <script>
            var xValues = <?php echo  $rawlist; ?>;
            var yValues = <?php echo  $rawData; ?>;
            var barColors = [
                "#b91d47",
                "#00aba9",
                "#2b5797",
                "#e8c3b9",
                "#1e7145",
                "#3F51B5",
                "#009688",
                "#FF5722",
                "#607D8B",
                "#FF9800",
                "#9C27B0",
                "#2196F3",
                "#EA676C",
                "#E41A4A",
                "#5978BB",
                "#018790",
                "#0E3441",
                "#00B0AD",
                "#721D47",
                "#EA4833",
                "#EF937E",
                "#F37521",
                "#A12059",
                "#126881",
                "#8BC240",
                "#364D5B",
                "#C7DC5B",
                "#0094BC",
                "#E4126B",
                "#43B76E",
                "#7BCFE9",
                "#B71C46"

            ];

            new Chart("myChart", {
                type: "pie",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    title: {
                        display: true,
                    }
                }
            });
        </script>


        <?php include './../Interface/Sharelayouts/Footer.php';
