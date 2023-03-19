<?php

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
            
            $tanggal_terima = date('Y-m-d', strtotime($data["tanggal_terima"]));
            $nomor_surat = htmlspecialchars($data["nomor_surat"]);
            $asal_surat = htmlspecialchars($data["asal_surat"]);
            $nomor_tanggal_surat = htmlspecialchars($data["nomor_tanggal_surat"]);
            $perihal = htmlspecialchars($data["perihal"]);

            $result = mysqli_query($conn, "SELECT nomor_surat FROM surat_masuk WHERE nomor_surat = '$nomor_surat'");
            if (mysqli_fetch_assoc($result)) {
                echo "<script>
                        alert('Nomor surat sudah ada');
                    </script>";
                return false;
            }   
            
            $file_surat = upload();
            if (!$file_surat) {
                return false;
            }
            
            $file_disposisi = upload_disposisi();

            //query insert data
            $query = "INSERT INTO surat_masuk VALUES
                        ('','$tanggal_terima','$nomor_surat','$asal_surat','$nomor_tanggal_surat','$perihal','$file_surat','$file_disposisi')";
            mysqli_query($conn, $query);

            //agar mengembalikan nilai 
            return mysqli_affected_rows($conn);
        }

        function upload() {
            $namaFile = $_FILES['file_surat']['name'];
            $ukuranFile = $_FILES['file_surat']['size'];
            $error = $_FILES['file_surat']['error'];
            $tmpName = $_FILES['file_surat']['tmp_name'];

            if($error === 4) {
                echo "<script>
                        alert('Pilih file terlebih dahulu');
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

            move_uploaded_file($tmpName, '../assets/file_sm/' . $namaFile);

            return $namaFile;
        }

        function upload_disposisi() {
            $namaFile = $_FILES['file_disposisi']['name'];
            $ukuranFile = $_FILES['file_disposisi']['size'];
            $error = $_FILES['file_disposisi']['error'];
            $tmpName = $_FILES['file_disposisi']['tmp_name'];
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

            move_uploaded_file($tmpName, '../assets/file_dp/' . $namaFile);

            return $namaFile;
        }

        function hapus($id){
            global $conn;
            mysqli_query($conn , "DELETE FROM surat_masuk WHERE id = $id");
            //agar mengembalikan nilai 
            return mysqli_affected_rows($conn);
        }

        function ubah($data){
            global $conn;
            $id = $data["id"]; 
            $tanggal_terima = date('Y-m-d', strtotime($data["tanggal_terima"]));
            $nomor_surat = htmlspecialchars($data["nomor_surat"]);
            $asal_surat = htmlspecialchars($data["asal_surat"]);
            $nomor_tanggal_surat = htmlspecialchars($data["nomor_tanggal_surat"]);
            $perihal = htmlspecialchars($data["perihal"]);
            $fileLama = htmlspecialchars($data["fileLama"]);

            
            if ($_FILES['file_surat']['error'] === 4) {

                $file_surat = $fileLama;
            }else {
                $file_surat = upload();
            }

            //query insert data
            $query = "UPDATE surat_masuk SET 
                    tanggal = '$tanggal_terima' , 
                    nomor_surat = '$nomor_surat' ,
                    asal_surat = '$asal_surat' ,
                    nomor_tanggal_surat = '$nomor_tanggal_surat' ,
                    perihal = '$perihal' ,
                    file_surat = '$file_surat'
                    WHERE id = $id
                    ";
            mysqli_query($conn, $query);

            //agar mengembalikan nilai 
            return mysqli_affected_rows($conn);
        }

        function cari($keyword) {
                    
            $query = "SELECT * FROM surat_masuk WHERE 
                        nomor_surat LIKE '%$keyword%' OR 
                        asal_surat LIKE '%$keyword%' OR
                        tanggal LIKE '%$keyword%' ORDER BY id DESC";
            return query($query);
        
        }        
?>