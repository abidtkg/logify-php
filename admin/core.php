<?php
session_start();
include('../configs/dbconfig.php');
if(isset($_POST['login'])){
    // PROCESS LOGIN
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // CHECK IF EMPTY
    if(empty($email) || empty($password)){
        header('Location: index.php?error=Email and password required');
        exit();
    }

    $user_query = "SELECT * FROM `admin` WHERE email='$email'";
    if($result = mysqli_query($conn, $user_query)){
        $total_rows = mysqli_num_rows($result);

        if($total_rows < 1){
            header('Location: index.php?error=No user exist!');
            exit();
        }
        // RETRIVE DATA AND VERIFY PASSWORD
        $row = mysqli_fetch_assoc($result);
        $is_verified = password_verify($password, $row['password']);
        if($is_verified == false){
            header('Location: index.php?error=Password Error!');
            exit();
        }
        
        // SET SESSION DATA
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $orw['email'];

        // REDIRECT TO HOME PAGE
        header('Location: dashboard.php');
        exit();

    }else{
        header('Location: index.php?error=Database Error');
        exit();
    }		
}else if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}