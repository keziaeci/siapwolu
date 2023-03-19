<?php 
  require '../functions.php';
  $id = $_GET["id"];
  $srt = query("SELECT * FROM surat_masuk WHERE id = $id")[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/print.css">
  <title>Print</title>
<body>
<div class="container">
  <div id="#viewPDF">
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.8/pdfobject.min.js" integrity="sha512-MoP2OErV7Mtk4VL893VYBFq8yJHWQtqJxTyIAsCVKzILrvHyKQpAwJf9noILczN6psvXUxTr19T5h+ndywCoVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  var view = $("#viewPDF");
  PDFObject.embed("../assets/file_sm/<?= $srt["file_surat"]; ?>", view);
</script>   
</body>
</html>