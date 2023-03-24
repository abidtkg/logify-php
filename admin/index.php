<?php
session_start();
if(isset($_SESSION['id'])){
    header('Location: dashboard.php');
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Logify - PHP based log API solution.">
    <meta name="author" content="Abid Hasan"">
    <meta name="generator" content="Logify">
    <title>Logify Login</title>
    <link rel="stylesheet" href="../assets/css/bootstrap5.3.0-alpha1.min.css">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <main>
        <div class="container col-xl-10 col-xxl-8 px-4 py-5">
            <div class="row align-items-center g-lg-5 py-5">
                <div class="col-lg-7 text-center text-lg-start">
                    <h1 class="display-4 fw-bold lh-1 mb-3">Logify - Log System</h1>
                    <p class="col-lg-10 fs-4">Logify is a PHP and MySQL-based logging system that allows logging data from 3rd application using APIs</p>
                </div>
                <div class="col-md-10 mx-auto col-lg-5">
                    <form class="p-4 p-md-5 border rounded-3 bg-light" action="core.php" method="POST">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Login</button>

                        <?php
                        // PROCESS ERROR MESSAGE
                        if(isset($_GET['error'])){
                            $message = $_GET['error'];
                            $template = '<div class="alert alert-danger mt-3" role="alert">'.$message.'</div>';
                          echo($template);
                        }
                        ?>
                        <hr class="my-4">
                        <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="../assets/js/5.3.0-alpha1bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
