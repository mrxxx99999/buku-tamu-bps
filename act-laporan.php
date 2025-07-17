<title>Laporan Tamu - BPS Kefamenanu</title>
<?php include 'koneksi.php'; ?>
<style type="text/css">
	body {
		font-size: 12px!important;
		color: #212121;
	}
	.header {
		text-align: center;
		margin: -.5rem 0;
	}
	.text {
		font-size: 15px!important;
		font-weight: bold;
		text-transform: uppercase;
	}
	#table tr th {
		font-size: 11px;
	}
	#table tr td {
		font-size: 10px;
	}
	#lead {
		width: auto;
		position: fixed;
		bottom: 0;
		right: 0 ;
		margin: 15px 0 0 75%;
		margin-right: auto;
	}
	.lead {
		font-weight: bold;
		text-decoration: underline;
		margin-bottom: -10px;
	}
	hr {
		height: 5px;
		border: 0;
		border-top: 3px double #8c8c8c;
		box-shadow: 0 5px 5px -5px #8c8c8c inset;
	}
	#box{
		width: 180px;
		height: 100px;
		border : solid 1px;
		margin-bottom: 30px;
	}
</style>

<center>
	<div id="box">
		<h4><strong>Laporan Data Tamu <br>
			Badan Pusat Statistik <br>
			Kefamenanu</strong></h4>
	</div>
</center>

<table id="table" border="1" cellspacing="0" cellpadding="5" width="100%">
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
	<tbody>
	<?php
	$no = 1;
	$query = mysqli_query($host, "SELECT * FROM tamu ORDER BY tanggal DESC");
	while($data = mysqli_fetch_assoc($query)) {
	?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $data['nama'] ?></td>
			<td><?= $data['email'] ?></td>
			<td><?= $data['hp'] ?></td>
			<td><?= $data['gender'] ?></td>
			<td><?= $data['pendidikan'] ?></td>
			<td><?= $data['pekerjaan'] ?></td>
			<td><?= $data['kategori_instansi'] ?><br><?= $data['nama_instansi'] ?></td>
			<td><?= $data['pemanfaatan'] ?></td>
			<td><?= $data['layanan'] ?></td>
			<td>
				<?php
				if ($data['perpustakaan']) echo "Perpustakaan: " . $data['perpustakaan'] . "<br>";
				if ($data['permintaan_data']) echo "Permintaan Data: " . $data['permintaan_data'] . "<br>";
				if ($data['konsultasi']) echo "Konsultasi: " . $data['konsultasi'] . "<br>";
				if ($data['rekomendasi']) echo "Rekomendasi: " . $data['rekomendasi'];
				?>
			</td>
			<td><?= $data['tanggal'] ?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>

<br>
<div id="lead">
	<p>Kepala BPS Kefamenanu,<br>
		<div style="height: 50px"></div>
		<p class="lead">[Nama Pejabat]</p>
		<p>NIP. [NIP Pejabat]</p>
	</div>
</div>

<script type="text/javascript">
	window.print();
</script>
