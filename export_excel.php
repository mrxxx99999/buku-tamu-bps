<?php
include 'koneksi.php';

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_tamu_bps.xls");

echo "<h3>Laporan Tamu - BPS Kefamenanu</h3>";

$tanggal_dari = $_GET['tanggal_dari'] ?? '';
$tanggal_sampai = $_GET['tanggal_sampai'] ?? '';

if ($tanggal_dari && $tanggal_sampai) {
    echo "<p>Periode: " . date('d/m/Y', strtotime($tanggal_dari)) . " s.d. " . date('d/m/Y', strtotime($tanggal_sampai)) . "</p>";
}

echo "<table border='1' cellpadding='5' cellspacing='0'>
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
<tbody>";

$no = 1;
if ($tanggal_dari && $tanggal_sampai) {
    $query = mysqli_query($host, "SELECT * FROM tamu WHERE DATE(tanggal) BETWEEN '$tanggal_dari' AND '$tanggal_sampai' ORDER BY tanggal ASC");
} else {
    $query = mysqli_query($host, "SELECT * FROM tamu ORDER BY tanggal ASC");
}

while($data = mysqli_fetch_assoc($query)) {
    $detail = '';
    if (!empty($data['perpustakaan']))    $detail .= "Perpustakaan: " . $data['perpustakaan'] . " | ";
    if (!empty($data['permintaan_data'])) $detail .= "Permintaan Data: " . $data['permintaan_data'] . " | ";
    if (!empty($data['konsultasi']))      $detail .= "Konsultasi: " . $data['konsultasi'] . " | ";
    if (!empty($data['rekomendasi']))     $detail .= "Rekomendasi: " . $data['rekomendasi'];

    echo "<tr>
        <td>{$no}</td>
        <td>{$data['nama']}</td>
        <td>{$data['email']}</td>
        <td>{$data['hp']}</td>
        <td>{$data['gender']}</td>
        <td>{$data['pendidikan']}</td>
        <td>{$data['pekerjaan']}</td>
        <td>{$data['kategori_instansi']} - {$data['nama_instansi']}</td>
        <td>{$data['pemanfaatan']}</td>
        <td>{$data['layanan']}</td>
        <td>{$detail}</td>
        <td>" . date('d/m/Y H:i', strtotime($data['tanggal'])) . "</td>
    </tr>";
    $no++;
}

echo "</tbody></table>";
?>
