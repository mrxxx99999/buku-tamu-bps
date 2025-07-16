<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .sidebar {
      height: 100vh;
      width: 240px;
      position: fixed;
      left: 0;
      top: 0;
      background-color: #0d6efd;
      padding-top: 20px;
      color: white;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 12px 20px;
      font-weight: 500;
      transition: all 0.2s ease;
    }
    .sidebar a:hover {
      background-color: #0b5ed7;
    }
    .sidebar .sidebar-header {
      font-size: 1.3rem;
      font-weight: bold;
      text-align: center;
      margin-bottom: 1rem;
    }
    .content {
      margin-left: 250px;
      padding: 20px;
    }

    @media (max-width: 768px) {
      .sidebar {
        position: relative;
        width: 100%;
        height: auto;
      }
      .content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <div class="sidebar-header">
    <i class="bi bi-journal-bookmark-fill"></i> Buku Tamu
  </div>
  
  <?php if (!isset($_SESSION['username'])): ?>
    <a href="index.php"><i class="bi bi-house-door"></i> Home</a>
    <a href="login.php" target="_blank"><i class="bi bi-box-arrow-in-right"></i> Login</a>
  <?php else: ?>
    <a href="adminpage.php"><i class="bi bi-people-fill"></i> Data Tamu</a>
    <a href="printbukutamu.php"><i class="bi bi-printer-fill"></i> Laporan</a>
    <a href="logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a>
  <?php endif; ?>
</div>
