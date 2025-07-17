<?php
require 'dompdf/autoload.inc.php';
include 'koneksi.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$no = 1;

// Tambahkan CSS agar tabel lebih kecil dan tidak terpotong
$style = '
<style>
    body {
        font-family: sans-serif;
        font-size: 10px;
    }
    h3, p {
        text-align: center;
        margin: 0;
        padding: 4px;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 10px;
    }
    table, th, td {
        border: 1px solid #000;
    }
    th, td {
        padding: 4px;
        text-align: left;
        vertical-align: top;
        word-wrap: break-word;
        font-size: 9px;
    }
    thead {
        background-color: #f2f2f2;
    }
    tr {
        page-break-inside: avoid;
    }
</style>
';

$output = $style;
$output .= '<h3>Laporan Tamu - BPS Kefamenanu</h3>';

// Ambil tanggal dari GET
$tanggal_dari = isset($_GET['tanggal_dari']) ? $_GET['tanggal_dari'] : '';
$tanggal_sampai = isset($_GET['tanggal_sampai']) ? $_GET['tanggal_sampai'] : '';

$judul_periode = '';
if (!empty($tanggal_dari) && !empty($tanggal_sampai)) {
    $judul_periode = "<p>Periode: " . date('d/m/Y', strtotime($tanggal_dari)) . " s.d. " . date('d/m/Y', strtotime($tanggal_sampai)) . "</p>";
}
$output .= $judul_periode;

$output .= '
<table>
<thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>No HP</th>
        <th>Gender</th>
        <th>Pendidikan</th>
        <th>Pekerjaan</th>
        <th>Instansi</th>
        <th>Pemanfaatan</th>
        <th>Layanan</th>
        <th>Detail Layanan</th>
        <th>Tanggal</th>
    </tr>
</thead>
<tbody>';

// Query berdasarkan tanggal (gunakan DATE())
if (!empty($tanggal_dari) && !empty($tanggal_sampai)) {
    $query = mysqli_query($host, "SELECT * FROM tamu WHERE DATE(tanggal) BETWEEN '$tanggal_dari' AND '$tanggal_sampai' ORDER BY tanggal ASC");
} else {
    $query = mysqli_query($host, "SELECT * FROM tamu ORDER BY tanggal ASC");
}

// Loop data
while($data = mysqli_fetch_assoc($query)) {
    $detail = '';
    if (!empty($data['perpustakaan']))    $detail .= "Perpustakaan: " . $data['perpustakaan'] . "<br>";
    if (!empty($data['permintaan_data'])) $detail .= "Permintaan Data: " . $data['permintaan_data'] . "<br>";
    if (!empty($data['konsultasi']))      $detail .= "Konsultasi: " . $data['konsultasi'] . "<br>";
    if (!empty($data['rekomendasi']))     $detail .= "Rekomendasi: " . $data['rekomendasi'];

    $output .= "<tr>
        <td>{$no}</td>
        <td>{$data['nama']}</td>
        <td>{$data['email']}</td>
        <td>{$data['hp']}</td>
        <td>{$data['gender']}</td>
        <td>{$data['pendidikan']}</td>
        <td>{$data['pekerjaan']}</td>
        <td>{$data['kategori_instansi']}<br>{$data['nama_instansi']}</td>
        <td>{$data['pemanfaatan']}</td>
        <td>{$data['layanan']}</td>
        <td>{$detail}</td>
        <td>" . date('d/m/Y H:i', strtotime($data['tanggal'])) . "</td>
    </tr>";
    $no++;
}

$output .= '</tbody></table>';

// Tampilkan PDF
$dompdf->loadHtml($output);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("laporan_tamu_bps.pdf", array("Attachment" => false));
exit;
?>
