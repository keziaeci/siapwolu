<?php 
  session_start();

  if (!isset($_SESSION["login"])) {
    header("Location: ../welcome.php");
    exit;
    
  }
    if($_SESSION['role'] !== 'admin') {
    header("Location: ../user/index.php");
    exit;
  }
  require '../functions.php';
 
  $jumlah_sm = count(query('SELECT * from surat_masuk'));
  $jumlah_sk = count(query('SELECT * from surat_keluar'));

  $dataSM = [];
  $year = date('Y');
  for ($i = 1; $i <= 12; $i++) {
    $sm = "SELECT COUNT(*) as jumlah FROM surat_masuk WHERE MONTH(tanggal) = $i AND YEAR(tanggal) = $year;";

    $result = mysqli_query($conn, $sm);
    $dataSM[$i] = mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['jumlah'];
  }

  $bulanSM = array_keys($dataSM);
  $jumlahSM = array_values($dataSM);

  $dataSK = [];
  for ($i = 1; $i <= 12; $i++) {
    $sm = "SELECT COUNT(*) as jumlah FROM surat_keluar WHERE MONTH(tanggal) = $i AND YEAR(tanggal) = $year;";
    // var_dump($dataSK['jumla);

    $result = mysqli_query($conn, $sm);
    $dataSK[$i] = mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['jumlah'];
  }

  $bulanSK = array_keys($dataSK);
  $jumlahSK = array_values($dataSK);
  ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../styles/sidebar.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="../assets/img/logo_siapwolu.png">
  </head>
    <body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <span><?= $_SESSION['username'] ?></span>
    </header>
    <div class="l-navbar bg-primary min-width-100vw  rounded-end" id="nav-bar">
        <nav class="nav">
            <div> 
              <a href="#"  class="nav_logo px-3"> 
                <img  src="../assets/img/new_logo.png" style="width: 35px;" alt="">
                <span class="nav_logo-name">SiapWolu</span> 
              </a>
                <div class="nav_list"> 
                  <a href="#" class="nav_link active">
                    <img class="nav_icon" src="../assets/icon/dsh.svg" style="height: 20px;" alt="">  
                    <span class="nav_name">Dashboard</span> 
                  </a> 
                  <a href="./surat_masuk.php" class="nav_link text-light">
                    <img class="nav_icon" src="../assets/icon/sm.svg" style="height: 20px;" alt="">  
                    <span class="nav_name">Surat Masuk</span> 
                  </a> 
                  <a href="./surat_keluar.php" class="nav_link text-light">
                    <img class="nav_icon" src="../assets/icon/sk.svg" style="height: 20px;" alt="">  
                    <span class="nav_name">Surat Keluar</span> 
                  </a> 
                  <a href="../laporan.php" class="nav_link text-light">
                    <img class="nav_icon" src="../assets/icon/lpr.svg" style="height: 25px;" alt="">  
                    <span class="nav_name">Laporan</span> 
                  </a> 
                </div>
            </div> <a href="../logout.php" class="nav_link text-light"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">LogOut</span> </a>
        </nav>
    </div>
    <br>
    
    <?php 
          $y = date('Y');
    ?>
    
    <!--Container Main start-->
    <div class="row" id="chart">
      <div class="col-xl-12 col-lg-8">
        <div class="card shadow mb-4">
          <div class="card-header p-3">
            <h6 class="m-0 font-weight-bold text-primary">Grafik Surat Masuk & Surat Keluar Tahun <?= $y ?></h6>
          </div>
          <div class="card-body">
            <canvas id="myChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Container Main end -->
    <!-- Content Row -->
    <div class="row">

      <!-- jumlah surat masuk -->
      <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a class="link  text-xs font-weight-bold text-primary text-uppercase mb-1" href="./surat_masuk.php">
                                Jumlah Surat Masuk</a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_sm ?></div>
                            </div>
                            <div class="col-auto card-image">
                            <img src="../assets/icon/mail_icon.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        <!-- jumlah surat keluar -->
          <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                  <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                              <a class="link text-xs font-weight-bold text-danger text-uppercase mb-1" href="./surat_keluar.php">
                                  Jumlah Surat Keluar</a>
                              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_sk ?></div>
                            </div>
                              <div class="col-auto card-image">
                                  <img src="../assets/icon/send_icon.png">
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    <div class="row bottom-0 m-2">
      <hr class="border-dark border-opacity-100">
      <div class="d-flex justify-content-center align-items-center bg-ft col">
        <em class="text-muted text-center m-2 fs-6">2022  &#169;	SIAPWOLU</em>
      </div>
    </div>

    <script>
      const labels = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli','Agustus','September','Oktober','November','Desember'
      ];

      const data = {
        labels: labels,
        datasets: [{
          label: 'Surat Masuk',
          fontFamily: 'Poppins' ,
          backgroundColor: 'rgb(0, 99, 132)',
          borderColor:  'rgb(0, 99, 132)',
          data: <?= json_encode($jumlahSM)?>,
        }
      ,{
          label: 'Surat Keluar',
          backgroundColor: 'rgb(255, 0, 0)',
          borderColor: 'rgb(255, 0, 0)',
          data: <?= json_encode($jumlahSK)?>,
        }]
      };

      const config = {
        type: 'bar',
        data: data,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      };
</script>
<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </body>
</html>