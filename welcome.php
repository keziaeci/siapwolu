<?php
    session_start();

    require 'functions.php'; 
?>
<!DOCTYPE html>
<html style="width:100%;" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- <link rel="stylesheet" href="../styles/sidebar.css"> -->
    <link rel="stylesheet" href="styles/style.css">
    <!-- <link rel="stylesheet" href="styles/admin.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="assets/img/logo_siapwolu.png">
</head>
<style>
    .text-primary{
    color: #27447F !important;
}
.btn-danger:hover{
    background-color: white;
    color: red;
    border: none;
}
.bg-ft {
    background-color: #1a3161;
    color: white;
    /* opacity: 0.10; */
}
</style>
<body>
    <div class="container-fluid">
        <div class="row min-vh-100">
            <div class="d-flex justify-content-center align-items-center col-lg-6 col-sm-4">
                <img class="w-75" src="assets/img/login.png" alt="login">   
            </div>
            <div class="d-flex justify-content-center align-items-center col-lg-6 col-sm-4 bg-primary">
                <div class="card border-0  bg-transparent rounded-3 w-50">
                    <div class="card-body text-light text-center">
                        <h1 class="card-text fw-bold m-0 p-0" style="font-size: 65px;">WELCOME</h1>
                        <p class="card-text m-0">Buat dan kirimkan surat anda</p>
                        <a class="btn btn-danger m-2 px-4" href="login.php">Sign In</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer -->
        <div class="row d-flex justify-content-center align-items-center bg-ft fixed-bottom">
            <p class="text-muted text-center m-2 ">2022 &#169;   SIAPWOLU</p>
        </div>
    </div>
    <script src="script.js"></script>
    <!-- script popper js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
            AOS.init();
    </script>
</body>
</html>