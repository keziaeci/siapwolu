<?php 
    session_start();

    if (!isset($_SESSION["login"])) {
      header("Location: ../welcome.php");
      exit;
    }
    if($_SESSION['role'] !== 'user') {
      header("Location: ../admin/index.php");
      exit;
    }

    require '../functions.php';

    //pagination
    //konfigurasi
    $jumlahDataPerHalaman = 10;
    $jumlahData = count(query("SELECT * FROM surat_masuk")); //menghitung jumlah data pada array menggunakan count
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman); //membulatkan keatas
    $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1; //jika halaman tidak ada maka akan diisi 1
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman; 
    $surat = query("SELECT * FROM surat_masuk ORDER BY id DESC LIMIT $awalData, $jumlahDataPerHalaman ");

    //tombol cari ditekan
    if (isset($_POST["cari"])) {
        $surat = cari($_POST["keyword"]);
    }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Surat Masuk - User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/sidebar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="../assets/img/logo_siapwolu.png">
    <style>
      .bg-primary {
    background-color: #27447f !important;
      } 
    </style>
  </head>
  <body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="" alt=""> </div>
        <span><?php echo $_SESSION['username'] ?></span>
    </header>
    <div class="l-navbar bg-primary min-width-100vw  rounded-end" id="nav-bar">
        <nav class="nav">
            <div> 
            <a href="./index.php"  class="nav_logo px-3"> 
                <img  src="../assets/img/new_logo.png" style="width: 35px;" alt="">
                <span class="nav_logo-name">SiapWolu</span> 
              </a>
                <div class="nav_list"> 
                  <a href="./index.php" class="nav_link ">
                    <img class="nav_icon" src="../assets/icon/dsh.svg" style="height: 20px;" alt="">  
                    <span class="nav_name">Dashboard</span> 
                  </a> 
                  <a href="#  " class="nav_link active">
                    <img class="nav_icon" src="../assets/icon/sm.svg" style="height: 20px;" alt="">  
                    <span class="nav_name">Surat Masuk</span> 
                  </a> 
                  <a href="./surat_keluar.php" class="nav_link">
                    <img class="nav_icon" src="../assets/icon/sk.svg" style="height: 20px;" alt="">  
                    <span class="nav_name">Surat Keluar</span> 
                  </a> 
                  <a href="../laporan.php" class="nav_link">
                    <img class="nav_icon" src="../assets/icon/lpr.svg" style="height: 25px;" alt="">  
                    <span class="nav_name">Laporan</span> 
                  </a> 
                </div>
            </div> <a href="../logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">LogOut</span> </a>
        </nav>
    </div>
    <!--Container Main start-->
      <div class="col-12">
        <div class="row">
          <div class="col mt-4">
            <h3 class="fw-semibold">Daftar Surat Masuk</h3>
          </div>
        </div>
            <div class="card shadow-2">
              <div class="card-header">
                <div class="row">
                  <!-- <a  class="col-sm-2 btn text-light bg-primary" href="tambah.php">Tambah Surat</a> -->
                  <form class="col-sm-4 d-flex " action="" method="POST">
                        
                        <input class="form-control me-2 " type="text" name="keyword" autofocus placeholder="Cari berdasarkan Nomor Surat/Asal/Tanggal" autocomplete="off" size="30">
                        <button class="btn btn-dark" type="submit" name="cari">Cari</button>
                    </form>
                    </div>
                  </div>
                  <div class="card-body p-1 m-0 table table-responsive">
                    <table  data-aos-duration="1200" data-aos="fade-up"  class="table  table-striped display nowrap w-100  aos-init aos-animate" border="5" cellpadding="10" cellspacing="0">
                        <tr>
                            <th>No. Urut</th>
                            <th>Tanggal</th>
                            <th>Nomor Surat</th>
                            <th>Asal Surat</th>
                            <th>Nomor & Tanggal Surat</th>
                            <th>Perihal </th>
                            <th>File  </th>
                            <th>Disposisi</th>
                        </tr>
                        <?php if(empty($surat)) : ?>
                          <tr class="table-danger">
                            <td colspan="9">
                              <p class="text-danger fw-semibold fst-italic">Data surat tidak ditemukan!</p>
                            </td>
                          </tr>
                        <?php endif; ?>
                        <?php $i = 1; ?>
                    <?php foreach($surat as $row) : ?>
                        <tr>
                            <td><?= $i;  ?></td>  
                            <td><?= date("d-m-Y" , strtotime($row["tanggal"])); ?></td>
                            <td><?= $row["nomor_surat"]; ?></td>
                            <td><?= $row["asal_surat"]; ?></td>
                            <td><?= $row["nomor_tanggal_surat"]; ?></td>
                            <td><?= $row["perihal"]; ?></td>
                            <td>
                                <a class="btn btn-success" href="../page/prev_sm.php?id=<?= $row['id']; ?>" target="_blank">Preview</a>
                            </td>
                            <?php if($row["file_disposisi"] === "Tidak ada") : ?>
                              <td>
                                <p>tidak ada</p>
                              </td>
                              <?php else: ?>
                              <td>
                                <a class="btn btn-success" href="../page/prev_dispo.php?id=<?= $row['id']; ?>">Preview</a>
                              </td>
                            <?php endif; ?>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
                <!-- pagination -->
                <div class="card-footer"> 
                  <ul class="pagination m-0">
                    <?php if($halamanAktif > 1) : ?>
                    <li class="page-item">
                      <a class="page-link" href="?halaman=<?= $halamanAktif - 1;?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                    <?php endif; ?>
                    <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                      <?php if($i == $halamanAktif) : ?>
                        <li class="page-item"><a class="page-link link-dark fw-bold" href="?halaman=<?= $i; ?>"><?= $i ; ?></a></li>
                        <?php else : ?>
                        <li class="page-item"><a class="page-link link-secondary" href="?halaman=<?= $i; ?>"><?= $i ; ?></a></li>
                      <?php endif; ?>
                    <?php endfor; ?>
                    <?php if($halamanAktif >= 1) : ?>
                      <?php if($jumlahHalaman > $halamanAktif) : ?>
                        <li class="page-item">
                                <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>" aria-label="Next">
                                  <span aria-hidden="true">&raquo;</span>
                                </a>
                        </li>
                      <?php endif; ?>
                    <?php endif; ?> 
                  </ul>
                </div>
                <!-- end pagination -->
              </div>
            </div>
    <!--Container Main end-->
    <!-- footer -->
    <div class="row bottom-0 m-2">
      <hr class="border-dark border-opacity-100">
      <div class="d-flex justify-content-center align-items-center bg-ft col">
          <em class="text-muted text-center m-2 fs-6">2022  &#169;	SIAPWOLU</em>
      </div>
    </div>
    
    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </body>
</html>