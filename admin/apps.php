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
    <title>Apps - Logify</title>
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
                        <a class="nav-link" aria-current="page" href="dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="apps.php">Apps</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="token.php">API Tokens</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="api-doc.php">API Ref</a>
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

    <div class="row mt-5 mb-5">
        <div class="col-md-6">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="App Name">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2">Create</button>
            </div>
        </div>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th scope="col">APP ID</th>
                <th scope="col">Name</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $user_id = $_SESSION['id'];
                $apps_query = "SELECT * FROM `apps` WHERE user = '$user_id' ORDER BY `apps`.`id` DESC";
                $result = mysqli_query($conn, $apps_query);
                while($row = $result->fetch_assoc()) {
                    echo '<tr>
                        <th scope="row">'.$row['id'].'</th>
                        <td>'.$row['name'].'</td>
                        <td>'.$row['date'].'</td>
                  </tr>';
                }
            ?>            
        </tbody>
    </table>

</body>
</html>