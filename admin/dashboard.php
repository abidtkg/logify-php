<?php
session_start();
include('../configs/dbconfig.php');
if(!isset($_SESSION['id'])){
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logify - Admin</title>
    <link rel="stylesheet" href="../assets/css/bootstrap5.3.0-alpha1.min.css">
</head>
<body class="container">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Logify</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">API Ref</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">API Tokens</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="core.php?logout=true">Logout</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <?php
        // DATA QUERY FOR DASHBOARD
        $date_today = date("y-m-d");
        $week_date = date("y-m-d", strtotime("-1 Week"));
        $week_query = "SELECT COUNT(*) as weektotal FROM logs WHERE date BETWEEN '$week_date' AND '$date_today'";
        $week_data = mysqli_query($conn, $week_query);
        $week_total_query = mysqli_fetch_assoc($week_data)['weektotal'];

        $month_date = date("y-m-d", strtotime("-1 Month"));
        $month_query = "SELECT COUNT(*) as monthtotal FROM logs WHERE date BETWEEN '$month_date' AND '$date_today'";
        $month_data = mysqli_query($conn, $month_query);
        $month_total_query = mysqli_fetch_assoc($month_data)['monthtotal'];

        $lifetime_query = "SELECT COUNT(*) as total FROM logs";
        $lifetime_data = mysqli_query($conn, $lifetime_query);
        $liftime_total_queries = mysqli_fetch_assoc($lifetime_data)['total'];
    ?>
    <!-- DASHBOARD -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title"><?php echo($week_total_query); ?></h1>
                    <h6 class="card-subtitle mb-2 text-muted">Last 7 Days Logs</h6>
                    <a href="#" class="card-link">See logs</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title"><?php echo($month_total_query); ?></h1>
                    <h6 class="card-subtitle mb-2 text-muted">Last 30 Day Logs</h6>
                    <a href="#" class="card-link">See logs</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title"><?php echo($liftime_total_queries); ?></h1>
                    <h6 class="card-subtitle mb-2 text-muted">Total Lifetime Logs</h6>
                    <a href="#" class="card-link">See logs</a>
                </div>
            </div>
        </div>
    </div>


    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">APP</th>
                <th scope="col">Message</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $table_query = "SELECT * FROM `logs` ORDER BY `logs`.`id` DESC LIMIT 20";
                $result = mysqli_query($conn, $table_query);
                while($row = $result->fetch_assoc()) {
                    echo '<tr>
                        <th scope="row">'.$row['id'].'</th>
                        <td>'.$row['app'].'</td>
                        <td>'.$row['message'].'</td>
                        <td>'.$row['date'].'</td>
                  </tr>';
                }
            ?>
        </tbody>
    </table>

</body>
</html>