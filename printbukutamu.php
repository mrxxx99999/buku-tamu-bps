<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="assets/css/bootstrap.min.css">
 <title>Form Export Buku Tamu</title>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-3">
  <div class="col-md-6 offset-md-3">
    <div class="card">
      <div class="card-header">
        Export Buku Tamu
      </div>
      <div class="card-body">

        <form id="exportForm" method="GET">
          <div class="form-group">
            <label for="tanggal_dari">Dari Tanggal</label>
            <input type="date" class="form-control" id="tanggal_dari" name="tanggal_dari" required>
          </div>

          <div class="form-group mt-2">
            <label for="tanggal_sampai">Sampai Tanggal</label>
            <input type="date" class="form-control" id="tanggal_sampai" name="tanggal_sampai" required>
          </div>

          <div class="d-flex justify-content-between mt-4">
            <a href="#" onclick="submitTo('export_pdf.php')" class="btn btn-danger">Export PDF</a>
            <a href="#" onclick="submitTo('export_excel.php')" class="btn btn-success">Export Excel</a>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>

<script src="assets/js/jquery-3.3.1.slim.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script>
  function submitTo(actionUrl) {
    const form = document.getElementById('exportForm');
    form.action = actionUrl;
    form.submit();
  }
</script>

</body>
</html>
