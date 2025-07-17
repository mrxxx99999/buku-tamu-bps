<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sidebar Responsive</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      margin: 0;
      padding: 0;
    }

   .sidebar {
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 250px;
  background-color: #0d6efd;
  padding-top: 20px;
  color: white;
  transition: width 0.3s ease, transform 0.3s ease; /* <-- tambahan halus */
  overflow-x: hidden; /* <-- agar konten tidak meluber */
}

    .sidebar.collapsed {
      width: 70px;
    }

    .sidebar .nav-link {
      color: white;
      padding: 10px 20px;
      display: flex;
      align-items: center;
    }

    .sidebar .nav-link i {
      margin-right: 10px;
    }

    .sidebar.collapsed .nav-link span {
      display: none;
    }

    .toggle-btn {
      position: fixed;
      top: 15px;
      left: 260px;
      z-index: 1050;
      background-color: #0d6efd;
      color: white;
      border: none;
      padding: 8px 10px;
      border-radius: 5px;
    }

    .sidebar.collapsed + .toggle-btn {
      left: 80px;
    }

    .content {
      margin-left: 250px;
      padding: 20px;
      transition: margin-left 0.3s ease;
    }

    .sidebar.collapsed ~ .content {
      margin-left: 90px;
    }

   /* Mobile */
@media (max-width: 768px) {
  .sidebar {
    transform: translateX(-100%);
    transition: transform 0.3s ease; /* <-- pastikan ada */
  }

  .sidebar.show {
    transform: translateX(0);
  }

  .content {
    margin-left: 0 !important;
    transition: margin-left 0.3s ease; /* <-- tambahan agar halus di mobile */
  }
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <div class="text-center mb-4 fw-bold">
    <i class="bi bi-journal-bookmark-fill"></i> <span>Buku Tamu</span>
  </div>
  <a href="dashboard.php" class="nav-link"><i class="bi bi-house-door"></i> <span>Home</span></a>
  <a href="adminpage.php" class="nav-link"><i class="bi bi-people-fill"></i> <span>Data Tamu</span></a>
  <a href="printbukutamu.php" class="nav-link"><i class="bi bi-file-earmark-text"></i> <span>Laporan</span></a>
  <a href="logout.php" class="nav-link"><i class="bi bi-box-arrow-left"></i> <span>Logout</span></a>
</div>

<!-- Toggle Button -->
<button class="toggle-btn" onclick="toggleSidebar()">
  <i class="bi bi-list"></i>
</button>

<script>
  function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const screenWidth = window.innerWidth;

    if (screenWidth <= 768) {
      sidebar.classList.toggle("show");
    } else {
      sidebar.classList.toggle("collapsed");
    }
  }
</script>

</body>
</html>
