<?php 
//koneksi ke database
        //variable conn dibawah merepresentasikan function mysqli connect agar mudah digunakkan berkali1
        $conn = mysqli_connect("localhost","root","","siapwolu");
        
        function query($query) {
            global $conn;   
            $result = mysqli_query($conn,$query);
            $rows = [];
            while($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            return $rows;
        } 

        function tambah($data) {
            //mengambil data dari tiap elemen dalam form
            global $conn;

            $tanggal_pembuatan = date('Y-m-d', strtotime($data["tanggal"]));
            $nomor_surat = htmlspecialchars($data["nomor_surat"]);
            $kepada = htmlspecialchars($data["kepada"]);
            $keperluan = htmlspecialchars($data["keperluan"]);

            $result = mysqli_query($conn, "SELECT nomor_surat FROM surat_keluar WHERE nomor_surat = '$nomor_surat'");
            if (mysqli_fetch_assoc($result)) {
                echo "<script>
                        alert('Nomor surat sudah ada');
                    </script>";
                return false;
            }   
            //upload gambar
            $file_surat = upload();
            if (!$file_surat) {
                return false;
            }

            $laporan = upload_laporan();

            //query insert data
            $query = "INSERT INTO surat_keluar VALUES
                        ('','$tanggal_pembuatan','$nomor_surat','$kepada','$keperluan','$file_surat','$laporan')";
            mysqli_query($conn, $query);

            //agar mengembalikan nilai 
            return mysqli_affected_rows($conn);
        }

        function upload() {
            $namaFile = $_FILES['file_surat']['name'];
            $ukuranFile = $_FILES['file_surat']['size'];
            $error = $_FILES['file_surat']['error'];
            $tmpName = $_FILES['file_surat']['tmp_name'];

            //cek apakah tidak ada file yang diupload
            if($error === 4) {
                echo "<script>
                        alert('Pilih gambar terlebih dahulu');
                    </script>";
                return false;
            }

            $ekstensiFileValid = ['pdf'];

            $ekstensiFile = explode('.', $namaFile);

            $ekstensiFile = strtolower(end($ekstensiFile));

            if(!in_array($ekstensiFile, $ekstensiFileValid)) {
                echo "<script>
                    alert('Ekstensi file harus PDF!');
                </script>";
                return false;
            }

            if($ukuranFile > 1000000000 ) {
                echo "<script>
                        alert('ukuran file terlalu besar');
                    </script>";
                return false;
            }

            

            move_uploaded_file($tmpName, '../assets/file_sk/' . $namaFile);

            return $namaFile;
        }   

        function upload_laporan() {
            $namaFile = $_FILES['laporan']['name'];
            $ukuranFile = $_FILES['laporan']['size'];
            $error = $_FILES['laporan']['error'];
            $tmpName = $_FILES['laporan']['tmp_name'];

            if($error === 4) {
                return "Tidak ada";
            }

            $ekstensiFileValid = ['pdf'];

            $ekstensiFile = explode('.', $namaFile);

            $ekstensiFile = strtolower(end($ekstensiFile));

            if(!in_array($ekstensiFile, $ekstensiFileValid)) {
                echo "<script>
                    alert('Ekstensi file harus PDF!');
                </script>";
                return false;
            }

            if($ukuranFile > 1000000000 ) {
                echo "<script>
                        alert('ukuran file terlalu besar');
                    </script>";
                return false;
            }

            

            move_uploaded_file($tmpName, '../assets/laporan/' . $namaFile);

            return $namaFile;
        }   

        function hapus($id){
            global $conn;
            mysqli_query($conn , "DELETE FROM surat_keluar WHERE id = $id");
            //agar mengembalikan nilai 
            return mysqli_affected_rows($conn);
        }

        function ubah($data){
            global $conn;
            $id = $data["id"]; 
            $tanggal_pembuatan = date('Y-m-d', strtotime($data["tanggal"]));
            $nomor_surat = htmlspecialchars($data["nomor_surat"]);
            $kepada = htmlspecialchars($data["kepada"]);
            $keperluan = htmlspecialchars($data["keperluan"]);
            $fileLama = htmlspecialchars($data["fileLama"]);
            
            
            if ($_FILES['file_surat']['error'] === 4) {

                $file_surat = $fileLama;
            }else {
                $file_surat = upload();
            }
                $laporan = upload_laporan();

            //query insert data
            $query = "UPDATE surat_keluar SET 
                    tanggal = '$tanggal_pembuatan' , 
                    nomor_surat = '$nomor_surat' ,
                    kepada = '$kepada' ,
                    keperluan = '$keperluan' ,
                    file_surat = '$file_surat',
                    laporan = '$laporan'
                    WHERE id = $id
                    ";
            mysqli_query($conn, $query);

            //agar mengembalikan nilai 
            return mysqli_affected_rows($conn);
        }

        function cari($keyword) {
            //guna function LIKE disini kita mencari data namun tidak perlu menulis secara rinci ,contoh untuk mencari data Sandhika kita bisa dengan menulis san dan data sandhika akan muncul
            $query = "SELECT * FROM surat_keluar WHERE 
                        nomor_surat LIKE '%$keyword%' OR 
                        kepada LIKE '%$keyword%' OR
                        tanggal LIKE '%$keyword%' ORDER BY id DESC";
            return query($query);
        }
?>